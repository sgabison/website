<?php
use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;
use Website\Tool\Reponse;

class GuestController extends Useraware {

	public $id;
	public function getGuestTelAction(){
		//$this->disableLayout();
		//$this->disableViewAutoRender();
		$reponse = new Reponse();
		$tel=$this->getParam('search');
		$guestlist=$this->societe->getResource()->getGuests( $tel );
		if( $guestlist ){
			foreach( $guestlist as $guest){
				if( $guest instanceof Object\Guest ){
					$guestarray[]= $guest->toSpecialArray();
				}
			}
			$reponse->data=$guestarray;
			$reponse->message=$date;
			$reponse->success=true;
		}else{
			$reponse->data="";
			$reponse->message="NO CUSTOMER";
			$reponse->success=false;			
		}
		$this->render($reponse);
	}
	public function getguestAction(){
		$reponse = new Reponse();
		$this->disableLayout();
		$tel=$this->getParam('tel');
		$guest=Object\Guest::getByTel($tel, 1);
		if( $guest instanceof Object\Guest){
			$data=$guest->toArray();
			if($data) {
				$reponse->message='TXT_GUEST_LIST';
				$reponse->success=true;
				$reponse->data =$data;
				$reponse->debug =$this->getParam("q");
			} else {
				$reponse->message='TXT_NO_GUEST';
				$reponse->success=false;
				$reponse->data =$data;
			}
		} else {
			$reponse->message='TXT_NO_GUEST';
			$reponse->success=false;
			$reponse->data =$data;		
		}
		$this->render($reponse);
	}
	public function getGuestListAction(){
		try {
			$reponse = new Reponse();
			$data=array();
			if ($this->getParam("q")) {
				$data =$this->societe->getGuests($this->getParam("q"));
			} 
			if($data) {
				$reponse->message='TXT_GUEST_LIST';
				$reponse->success=true;
				$reponse->data =$data;
				$reponse->debug =$this->getParam("q");
			} else {
				$reponse->message='TXT_NO_GUEST';
				$reponse->success=false;
				$reponse->data =$data;
			}
			$this->render($reponse);
			
		} catch (\Exception $e) {
			// something went wrong: eg. limit exceeded, wrong configuration, ...
			\Logger::err($e);
			echo $e->getMessage();exit;
		}
	}
	public function sendmailmessageAction () {
		$this->disableLayout();
		if( $this->getParam('sendmail')=="send" ){
			$resaid=$this->getParam('resaid');
			$reservation = Object\Reservation::getById($resaid,1);
			if( $reservation instanceof Object\Reservation){
				$locationname=$reservation->getLocation()->getName();
				$resa=$reservation->getId();
				$email=$reservation->getGuest()->getEmail();
				$guestname=$reservation->getGuest()->getLastname();
				$parameters = array(
					'location'=>$locationname,  
					'bookingref'=>$resa, 
					'message'=>$this->getParam('message'),
					'guestname'=>$guestname);
				$mail = new Pimcore_Mail ();
				$subject='Message ResaExpress - '.$locationname;
				$mail->setParams($parameters);
				$mail->setReplyTo('info@resaexpress.com');
				$mail->setSubject($subject);
				$mail->setDocument('/fr/booking/standardmail');
				// $mail->setBody($body);
				$mail->addTo($email);
				$mail->addBcc('didier.rechatin@gmail.com');
				$mail->Send();
			}
		}
	}
	public function sendtextmessageAction () {
		//$this->layout ()->setLayout ( 'portal' );
		$this->disableLayout();		
	}
	public function sendsmstextAction () {
		$this->disableLayout();	
		$this->disableViewAutoRender();
		$smstext= $this->getParam('smstext');
		$resaid= $this->getParam('resaid');
		$reservation=Object\Reservation::getById( $resaid );
		if( $reservation instanceof Object\Reservation){ 
			$smstext = "Votre+resa+Nr:".$resaid."+a+".$reservation->getLocation()->getName()." ".$smstext." www.resaexpress.com";
			$smstext = str_replace(' ', '+', $smstext);
			$dest= $this->getParam('tel');
			$dest = "33".substr($dest, 1);
			$api= "pub-f9157fe82c8377b08b2cd47a8b395dfb";
			$ch = curl_init();	
			$url="http://api.smsbox.fr/1.1/api.php?apikey=".$api."&msg=".$smstext."&dest=".$dest."&mode=Standard&charset=utf-8";
			// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			// grab URL and pass it to the browser
			curl_exec($ch);
			// close cURL resource, and free up system resources
			curl_close($ch);
		}else{
			die("incorrect reservation");
		}	
	}
	public function searchAction () {
		$this->layout ()->setLayout ( 'portal' );
		$this->view->q= $this->getParam("q");
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/table-guest-list.js');
		$this->view->inlineScript()->appendScript(
				'jQuery(document).ready(function() {
					Main.init();
					GuestList.init();
				});',
				'text/javascript',
				array('noescape' => true)); // Disable CDATA comments
	}
	public function profileAction () {
	
		$this->layout ()->setLayout ( 'portal' );
		$this->view->guest= ($this->getParam("id"))?\Object\Guest::getById($this->getParam("id")) : null ;
	
		// $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/table-guest-list.js');
	
		$this->view->inlineScript()->appendScript(
				'jQuery(document).ready(function() {
					Main.init();
				});',
				'text/javascript',
				array('noescape' => true)); // Disable CDATA comments
	}
	public function getDataAction () {
		// Get Request methode json decode
		$this->getAnswer();
	}
	
	public function getAnswer ($tree=false) {
		$this->requete=new Request ( )	;
		$method = $this->requete->method; //$this->getParam('METHOD',$_SERVER["REQUEST_METHOD"]) ;
		$this->id = $this->requete->id;
		if($this->id>0):
		switch ($method) {
			case 'PUT':
				$reponse= $this->update();
				break;
			case 'DELETE':
				$reponse= $this->destroy();
				break;
			case 'GET':
				$reponse= $this->view();
				break;
			default:
				$reponse = new Reponse();
				$res->message = "Affichage des informations impossible avec id";
				$reponse->data=$this->requete->params;
		}
		else:
		switch ($method) {
			case 'GET':
				$reponse= $this->view();
				break;
			case 'POST':
				$reponse= $this->create();
				if ($reponse->success) :
				//   do something
				endif;
				break;
			default:
				$reponse = new Reponse();
				$reponse->data=$this->requete->params;
				$reponse->message = "Affichage des informations impossible";
		}
		endif;
		$this->render($reponse);
	}
	/**
	 * view
	 */
	public function view($keyterm ='') {
		$res = new Reponse();
		$res->isTree = false;
		$res->data = $this->getArray($this->getList());
		$res->success = true;
		$res->message = "Affichage des informations";
		return $res;
	}
	/**
	 * update
	 */
	public function update() {
		$res = new Reponse();
		$serving=\Object\Serving::getById($this->id);
		if ($serving instanceof Pimcore\Model\Object\Serving) {
			$serving->setValues( $this->requete->params );
			$serving->save();
			$res->data =  $serving->toArray();
			$res->success = true;
			$res->message ="TXT_UPDATE_OK";
		} else {
			$res->data =  $this->requete->params;
			$res->success = false;
			$res->message = "TXT_UPDATE_ERROR" ;
		}
		return $res;
	}
	/**
	 * destroy
	 */
	public function destroy() {
		$res = new Reponse();
		$rec= \Object\Serving::getById($this->id);
		if ($rec ) {
			$rec->delete();
			$res->success = true;
			$res->message = 'Destroyed';
		} else {
			$res->message = "Failed to destroy";
		}
		return $res;
	}
	
}

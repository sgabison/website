<?php
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use Website\Tool\Reponse;
use Website\Tool\Request;
use Website\Tool\Requestjsonp;

class UserreservationController extends Action
{
	
	public function termsAction(){
		$this->layout ()->setLayout ( 'portal' );	
	}
	public function resaserveringsAction() {  
		$this->disableLayout();  
		if( $this->getParam('locationid') ){ 
			$locationid=$this->getParam('locationid');
		}else{
			//get default location from URL !!!! should be linked to societe
			$locationid=55;	
		}
		$location=Object_Location::getById($locationid, 1);
		if( $location instanceof Object_Location ){
			$servings=$location->getServings();
			$unit=$location->getResaunit();
			$reponse = new Reponse();
			$array=array();
//			foreach( $servings as $serving ){
//				array_push($array, $serving->toArray());
//			}
//			$reponse->data=$array;
//			$reponse->message="TXT_LOCATIONS_SENT";
//			$reponse->success=true;	  
//		    $this->render($reponse);
			$resatime=array();
			foreach( $servings as $myserving ){
				if( $myserving instanceof Object_Serving ){
					$mealduration=(int)$myserving->getMealduration();
					$timestart=strtotime( $myserving->getTimestartmonday() );
					$timeend=strtotime( $myserving->getTimeendmonday() );
					$unit=$unit*60;
					$mealduration=($mealduration*60);
					$slots=0;
					while($timestart+$slots < $timeend-$mealduration){
						$timeslotunix=new Zend_date($timestart+$slots);
						$timeslot=$timeslotunix->get(Zend_Date::HOUR).":".$timeslotunix->get(Zend_Date::MINUTE);
						array_push($resatime, $timeslot);
						$slots=$slots+$unit;
					}
		        }
			}			
			$reponse = new Reponse();
			$reponse->data=$resatime;
			$reponse->message="TXT_LOCATIONS_SENT";
			$reponse->success=true;	  
		    $this->render($reponse);
		}
	}

	public function resaservingsAction() { 
		$this->disableLayout();   
		if( $this->getParam('locationid') ){ 
			$locationid=$this->getParam('locationid');
		}else{
			//get default location from URL !!!! should be linked to societe
			$locationid=55;	
		}
		$location=Object_Location::getById($locationid, 1);
		if( $location instanceof Object_Location ){
			$servings=$location->getServings();
			
			$reponse = new Reponse();
			$array=array();
			foreach( $servings as $serving ){
				array_push($array, $serving->toArray());
			}
			$reponse->data=$array;
			$reponse->message="TXT_LOCATIONS_SENT";
			$reponse->success=true;	  
		    $this->render($reponse);
		}
	}

	public function timeslotToMinutes($selectedtimeslot){
		sscanf($selectedtimeslot, "%d:%d", $hours, $minutes);
		$result= $hours * 3600 + $minutes * 60;
		return $result;
	}
	  
    public function formatDateAndTimeslot($date,$timeslot){
    	return new Zend_Date($date.' '.$timeslot.':00', 'dd-MM-YYYY HH:mm:ss');
    }  
    
    public function resaslotAction() {
    	$this->disableLayout();
    	$this->view->doc = $document;
    	$dateres=$this->getParam('date');
    	$reservationid=$this->getParam('reservationid');  	
    	if( $reservationid ){
    		$reservation=Object\Reservation::getById($reservationid);
    		if( $reservation instanceof Object\Reservation){
    			$myreservationstartslot=$reservation->getStart()->get(Zend_Date::HOUR).":".$reservation->getStart()->get(Zend_Date::MINUTE);
    			$myreservationservingid=$reservation->getServing()->getId();
    		}
    	}
		if( $this->getParam('locationid') ){ 
			$locationid=$this->getParam('locationid');
		}else{
			//get default location from URL !!!! should be linked to societe
			$locationid=55;	
		}
		$location=Object_Location::getById($locationid, 1);
    	$datetounix=new Zend_Date( $dateres, 'dd-MM-YYYY HH:mm:ss');
    	$datestart=$datetounix->getTimestamp();
		$d=$datetounix->get(Zend_Date::WEEKDAY);	
		//First get a list of Reservation objects for the day for this location
		$dailyorders = new Object\Reservation\Listing();
		$dailyorders->setCondition("location__id =".$locationid." AND start >= '".$datestart."'" );
		if( $location instanceof Object_Location ){
			//get unit of time for that location
			$unit=( $location->getResaunit() )*60;
			$maxresaperunit=$location->getMaxresaperunit();
			$maxseats=$location->getMaxseats();
			//get all servings for that location
			$servings=$location->getServings();
			$resafinal=array();
			foreach ( $servings as $myserving ){
        		$resa=array();
		       // if( $myserving instanceof Object_Serving ){   	
					$mealduration=( $myserving->getMealduration() )*60;
					$week=array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
					//foreach( $week as $d ){
					if($d=='Monday'){
						$closed=$myserving->getClosedmonday();
						if( $myserving->getTimestartmonday() ){
							$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartmonday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendmonday() ){
							$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendmonday());
						}else{$timeend=$datestart;}
					}elseif($d=='Tuesday'){
						$closed=$myserving->getClosedtuesday();
						if( $myserving->getTimestarttuesday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestarttuesday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendtuesday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendtuesday());
						}else{$timeend=$datestart;}
					}elseif($d=='Wednesday'){
						$closed=$myserving->getClosedwednesday();
						if( $myserving->getTimestartwednesday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartwednesday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendwednesday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendwednesday());
						}else{$timeend=$datestart;}
					}elseif($d=='Thursday'){
						$closed=$myserving->getClosedthursday();
						if( $myserving->getTimestartthursday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartthursday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendthursday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendthursday());
						}else{$timeend=$datestart;}
					}elseif($d=='Friday'){
						$closed=$myserving->getClosedfriday();
						if( $myserving->getTimestartfriday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartfriday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendfriday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendfriday());	
						}else{$timeend=$datestart;}
					}elseif($d=='Saturday'){
						$closed=$myserving->getClosedsaturday();
						if( $myserving->getTimestartsaturday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartsaturday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendsaturday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendsaturday());
						}else{$timeend=$datestart;}
					}elseif($d=='Sunday'){
						$closed=$myserving->getClosedsunday();
						if( $myserving->getTimestartsunday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartsunday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendsunday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendsunday());
						}else{$timeend=$datestart;}
					}
					if($closed == 1){$closed='closed';}else{$closed="";}
					$endtime=$timeend-$mealduration;
					$resatime=array();
					$i=0;
					while($timestart<=$endtime){
						$i++;
						$timeslot=date("H", $timestart).":".date("i", $timestart);
						$orderswarning="";
						$seatswarning="";
						$o=0; //initiate o number of orders already taken during this timeslot
						$p=0; //initiate p number of seats already occupied during this timeslot
						
						//Check if we have too many orders for this timeslot
						foreach($dailyorders as $order){
							if( $order->getStart()->getTimestamp() == $timestart ){ $o++;} //calculate number of orders in this timeslot
						}
						if( $o >= $maxresaperunit){ $orderswarning='-'.$o; }else{ $orderswarning='-ok'; } //set warning is number exceeds max reservation per slot
						//Check if we have available seats for this timeslot
						
						$startslot=$timestart;//First let s identify timestamp for startlost and endlot
						$timestart=$timestart+$unit;//Add unit of time to timestart
						$endslot=$timestart;
						
						//let's identify all orders that start after the start of the slot or that finish before the end of the slot
						foreach($dailyorders as $order){
							if( ( $order->getStart()->getTimestamp() <= $startslot AND $order->getEnd()->getTimestamp()>$endslot ) OR ( ($order->getStart()->getTimestamp()) > ( $startslot + ( (int)$meal*60 ) ) ) ){ 
								$size=$order->getPartysize();
								$p=$p+$size;
							}
						}
						if( $p >= $maxseats){ $seatswarning='-'.$p; }else{ $seatswarning='-ok'; }
						
						//Feed the data
						if( $timeslot == $myreservationstartslot ){$slotselected='-selected';}else{$slotselected='';}
						$resatime['shift-'.$i.$orderswarning.$seatswarning.$slotselected]=$timeslot;

					}
					if ( $myserving->getId() == $myreservationservingid ){
						$resafinal[$myserving->getTitle().'_-_'.$myserving->getId().'_-_selected_-_'.$closed]=$resatime;
					}else{
						$resafinal[$myserving->getTitle().'_-_'.$myserving->getId().'_-_'.$closed]=$resatime;
					}
			}
			//exit;
			$reponse = new Reponse();
			$reponse->data=$resafinal;
			$reponse->message=$date;
			$reponse->success=true;	  
		    $this->render($reponse);
		}
    }
	public function getAllDays($start, $end){
		$array=array();
		while( $start->compareDate($end) ){
			array_push( $array, $start->get('dd-MM-YYYY'));
			$start->addDay('1');
		}
		array_push( $array, $end->get('dd-MM-YYYY'));
		return $array;
	}
	public function arrayToString($array){
		$result = implode(',', $array);
		return $result;		
	}
	public function cancelreservationAction() {
		$this->layout()->setLayout('portal');
		if( $this->getParam('reservationid') ){
			$reservationid=$this->getParam('reservationid');
			$reservation=Object\Reservation::getById($reservationid,1);
			if( $reservation instanceof Object\Reservation ){
				$this->view->warning="off";
				$this->view->reservation=$reservation;
				if( $this->getParam("confirmcancellation") =="yes" ){
					$reservation->setStatus('Cancelled');
					$reservation->save();
					$reservationarray=$reservation->toArray();
					$this->sendCancellation($reservationarray);
				}
			}else{
				$this->view->warning="on";
			}
		}else{
			$this->view->warning="on";
		}
	}
	public function sendCancellation($array){
		$email=$array['email'];
		$sellocation=Object\Location::getById($array['locationid'],1);
		$parameters = array(
			'bookingref'=>$array['id'], 
			'partysize'=>$array['partysize'], 
			'serving'=>$array['servingtitle'], 
			'location'=>$array['locationname'],  
			'date'=>$array['start']->get('dd-MM-YYYY'), 
			'slot'=>$array['start']->get('HH:mm'), 
			'locationaddress'=>$sellocation->getAddress(),
			'locationzip'=>$sellocation->getZip(),
			'locationcity'=>$sellocation->getCity(),
			'locationtel'=>$sellocation->getTel(), 
			'locationemail'=>$sellocation->getEmail(), 
			'locationcity'=>$sellocation->getCity(), 
			'locationurl'=>$sellocation->getUrl(), 
			'guestname'=>$array['firstlastname']);
		$mail = new Pimcore_Mail ();
		$subject='Cancellation of Reservation';
		$mail->setParams($parameters);
		$mail->setReplyTo('info@demo.gabison.com', $name=NULL);
		$mail->setSubject($subject);
		$mail->setDocument('/fr/booking/cancellation-confirmation');
		// $mail->setBody($body);
		$mail->addTo($email);
		$mail->addBcc('didier.rechatin@gmail.com');
		$mail->Send();
	}
	public function checkClosedServings(){
		$servings=$this->selectedLocation->getServings();
		$weekClose[0]=1; $weekClose[1]=1; $weekClose[2]=1; $weekClose[3]=1; $weekClose[4]=1; $weekClose[5]=1; $weekClose[6]=1;
		foreach($servings as $myserving){
			$weekClose[0]=$myserving->getClosedmonday()*$weekClose[0];
			$weekClose[1]=$myserving->getClosedtuesday()*$weekClose[1];
			$weekClose[2]=$myserving->getClosedwednesday()*$weekClose[2];
			$weekClose[3]=$myserving->getClosedthursday()*$weekClose[3];
			$weekClose[4]=$myserving->getClosedfriday()*$weekClose[4];
			$weekClose[5]=$myserving->getClosedsaturday()*$weekClose[5];
			$weekClose[6]=$myserving->getClosedsunday()*$weekClose[6];
		}
		$week="";
		$week=array();
		foreach( $weekClose as $key=>$day ){
			if( $day == 1 ){ array_push($week,$key); }
		}
		return $this->arrayToString($week);
	}
    public function userreservationAction() {
		//SET RESACHANGE TO FALSE
		if ( $this->getParam("lg") ){
    		$locale = new \Zend_Locale($this->_getParam ( "lg" ));
    		\Zend_Registry::set("Zend_Locale", $locale);
    		$this->mySessionSite->Locale=$locale;
		}
		if( $this->getParam("selectedLocationid") ){
			$selectedLocationid=$this->getParam("selectedLocationid");
		} else {
			$selectedLocationid=79;
		}
		$selectedLocation=Object\Location::getById( $selectedLocationid, 1);
		if( $selectedLocation instanceof Object\Location ){
			$this->selectedLocation=$selectedLocation;
			$today=new zend_date();
			$sixmonthsfromnow=$today->add('6', Zend_Date::MONTH);
			$fulltext="";
			foreach( $selectedLocation->getShifts($today, $sixmonthsfromnow) as $dayoff ){
				if( $dayoff->getAllDay()==1 ){
					$fulltext=$this->arrayToString( $this->getAllDays( $dayoff->getStart(), $dayoff->getEnd() ) ).",".$fulltext;
				}
			}
			$this->view->offdaysrange=$fulltext;
			$this->view->closeddays=json_encode( $this->checkClosedServings() );
			$this->view->selectedLocation=$selectedLocation;
			$this->view->resachange=false;			

			$this->view->selectedlocationid=$this->selectedLocation->getId();

       		$this->view->lat=$this->selectedLocation->getGeolocalisation()->getLatitude();
       		$this->view->long=$this->selectedLocation->getGeolocalisation()->getLongitude();
			if( $this->getParam('resadate') ){
				$this->view->resadate=$this->getParam('resadate');
			}
		} else {
			$this->view->warning="This is not a correct location";
		}
	}
	public function selectiongroupAction(){
		$societe=$this->societe;
		if ($societe instanceof Object_Societe ) {
			$this->view->locations = $societe->getLocations();
		}
		$this->view->selectedlocationid=$this->getParam('locationid');
		$location=Object\Location::getById( $this->getParam('locationid') );
		if ( $location ){
			$this->view->selectedLocation=$location;
		}
		$this->view->resadate=$this->getParam('resadate');
		$this->disableLayout();

	}

	public function getDataAction () {
		// Get Request methode json decode
		$this->getAnswer();
	}
 	public function getAnswer ($tree=false) {
		$this->requete=new Requestjsonp()	;
		$method = $this->requete->method; //$this->getParam('METHOD',$_SERVER["REQUEST_METHOD"]) ;
		$this->id = $this->requete->id;
		$data=$this->requete->params;
		if($this->id>0):
		switch ($method) {
			case 'PUT':
				$reponse= $this->update();
				break;
			case 'CHANGE':
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
					$this->sendConfirmation($reponse->data);
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
	public function sendConfirmation($array){
		$email=$array['email'];
		$sellocation=Object\Location::getById($array['locationid'],1);
		$parameters = array(
			'bookingref'=>$array['id'], 
			'partysize'=>$array['partysize'], 
			'serving'=>$array['servingtitle'], 
			'location'=>$array['locationname'],  
			'date'=>$array['start']->get('dd-MM-YYYY'), 
			'slot'=>$array['start']->get('HH:mm'), 
			'locationaddress'=>$sellocation->getAddress(),
			'locationzip'=>$sellocation->getZip(),
			'locationcity'=>$sellocation->getCity(),
			'locationtel'=>$sellocation->getTel(), 
			'locationemail'=>$sellocation->getEmail(), 
			'locationcity'=>$sellocation->getCity(), 
			'locationurl'=>$sellocation->getUrl(), 
			'guestname'=>$array['firstlastname']);
		$mail = new Pimcore_Mail ();
		$subject='Reservation confirmation';
		$mail->setParams($parameters);
		$mail->setReplyTo('info@demo.gabison.com', $name=NULL);
		$mail->setSubject($subject);
		$mail->setDocument('/fr/booking/reservation-confirmation');
		// $mail->setBody($body);
		$mail->addTo($email);
		$mail->addBcc('didier.rechatin@gmail.com');
		$mail->Send();
	}
	/**
	 * create
	 */
	public function create() {
		$res = new Reponse();
		$data=$this->requete->params;
		if($data['callback']){$res->callback=true;}
		if( $this->person ){ $data['person']=$this->person; }
		$rec = new \Object\Reservation();
		$formattedData=\Object\Reservation::formatData($data); 
		$result=$rec->updateData( $formattedData );
		if ($result instanceof \Object\Reservation) {
			$res->success = true;
			$res->message = "TXT_CREATE_OK" ;
			$res->data = $result->toArray();
			$res->debug = $formattedData;
			
		} else {
			$res->message = "TXT_CREATE_ERROR"  ;
			$res->data = $result;
			$res->debug = $formattedData;
		}
		return $res;
	}
	/**
	 * view
	 */
	public function view($keyterm ='') {
		$res = new Reponse();
		$res->isTree    = false;
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
		$data=$this->requete->params;
		if( $this->person ){ $data['person']=$this->person; }
		$formattedData=\Object\Reservation::formatData($data); 
		$reservation=Object\Reservation::getById($data['id']);
		if ($reservation instanceof Object\Reservation) {
			$reservation->setValues( $formattedData );
			$reservation->save();
			$res->data = $reservation->toArray();
			$res->success = true;
			$res->message ="TXT_UPDATE_OK";
			$res->debug = $formattedData;
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
		$rec=Object\Reservation::getById($this->id);
		if ($rec ) {
			$rec->delete();
			$res->success = true;
			$res->message = 'Destroyed';
		} else {
			$res->message = "Failed to destroy";
		}
		return $res;
	}
	public function listreservationsearchAction(){
		$this->layout()->setLayout('portal');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/search-reservation-list.js');
		$societe=$this->societe;
		$locationarray=$societe->getLocations();
		$this->view->selectedLocation=$this->selectedLocation;
		$this->view->selectedLocationId=$this->selectedLocation->getId();
	}
	public function listreservationAction(){
		$this->layout()->setLayout('portal'); // listreservation_layout
		$guesttext=$this->getParam('guesttext');
		$calendar=$this->getParam('calendar');
		if( $calendar=='' ){ $date=new Zend_date(); $calendar=$date->get('dd-MM-YYYY'); }
		$this->view->calendar=$calendar;
		$myservingid=$this->getParam('servingid');
		$servingsearch=Object\Serving::getById( $myservingid , 1 );
		if( $servingsearch instanceof Object\Serving ){
			$servingname=$servingsearch->getTitle();
			$this->view->servingname=$servingname;
		}
		if ( $myservingid=='' || $calendar=="" ){
			$this->view->warning="search";
		}else{
			$this->view->warning="nosearch";
		}
		$this->reservationsArray();
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/table-reservation-list.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js');
		$this->view->inlineScript ()->appendScript ( 'jQuery(document).ready(function() {
					Main.init();
					TableReservationList.init();
        			SVExamples.init();
        			PagesUserProfile.init();
				});', 'text/javascript', array (
								'noescape' => true
		) );
	}
	public function reservationsArray(){
		//get societe/location and serving
		$reponse = new Reponse();
		$date=new Zend_Date();
		$dateres=$date->get('dd-MM-YYYY');
		$datestart=new Zend_Date( $dateres.' 00:00:00', 'dd-MM-YYYY HH:mm:ss');
		$dateend=new Zend_Date( $dateres.' 23:59:59', 'dd-MM-YYYY HH:mm:ss');
		$start=$datestart->getTimestamp();
		$end=$dateend->getTimestamp();

		$mylocation = $this->selectedLocation;
		if( $mylocation instanceof Object_Location ){
			$this->view->reservations= $mylocation->getResource()->getReservationsByDate($start,$end);
		}
	}
	public function reformatDate($data){
		$chosenresa=Object\Reservation::getById( $data['id'], 1 );
		$chosenday=$chosenresa->getStart()->get('dd-MM-YYYY');
		$start=new \Zend_Date( $chosenday.' '.$data['start'], 'dd-MM-YYYY HH:mm' );
		return $data['id'];
	}
	public function getListAction(){
		//get societe/location and serving
		$reponse = new Reponse();
		$mylocationid= $this->getParam('locationid');
		$myservingid= $this->getParam('servingid');
		$calendar= $this->getParam('calendar');
		$guestid= $this->getParam('guestid');
		$mylocation=Object\Location::getById( $mylocationid, 1 );
		if( $mylocation instanceof Object\Location ){
			//we check if we are in the Editor
			if( $_POST['action'] ){
				//if REMOVE
				if($_POST['action'] =="remove"){
					foreach( $_POST['id'] as $id){
						$myreservation=Object\Reservation::getById( $id, 1);
						if( $myreservation instanceof Object\Reservation){
							$myreservation->SetStatus('Cancelled');
							$myreservation->save();
						}
					}
					$reponse->message='TXT_RESERVATION_LIST';
					$reponse->success=true;
					$reponse->data ='';
				}
				//if EDIT
				if($_POST['action'] =="edit"){
					$myreservation=Object_Reservation::getById( $_POST['data']['id'], 1 );
					if( $_POST['data']['guestid'] ){
						$guest=Object_Guest::getById( $_POST['data']['guestid'], 1);
						if($guest instanceof Object_Guest){
							$guest->setLastname($_POST['data']['guestname']);
							$guest->setTel($_POST['data']['guesttel']);
							$guest->save();
						}
					}
					//date update needs to be reworked
					//$myreservation->setStart( $this->reformatDate($_POST['data']) );
					$myreservation->setPartysize($_POST['data']['partysize']);
					$myreservation->setBookingref($_POST['data']['bookingref']);
					$myreservation->setBookingnotes($_POST['data']['bookingnotes']);
					$myreservation->setStatus($_POST['data']['status']);
					if( $_POST['data']['arrived'] == '1' ){ $arrived = 1; }else{ $arrived = 0; }
					$myreservation->setArrived($_POST['data']['arrived']);
					$myreservation->save();
					$data=$_POST['data'];
					$data['DT_RowId']="row_".$_POST['data']['id'];
					$reponse->message='TXT_RESERVATION_LIST';
					$reponse->success=true;
					$reponse->row =$data;
					$reponse->debug= $this->reformatDate($_POST['data']);
				}
			}else{
				if( !$calendar ){ $date=new Zend_date(); $calendar=$date->get('dd-MM-YYYY'); }
				$calendarstart=$calendar.' '.'00:00:00';
				$calendarend=$calendar.' '.'23:59:59';
				$calendarstart=new Zend_Date( $calendarstart, 'dd-MM-YYYY HH:mm:ss');
				$calendarend=new Zend_Date( $calendarend, 'dd-MM-YYYY HH:mm:ss');
				$reservations=$mylocation->getResource()->getReservationsByDate( $calendarstart->getTimestamp(), $calendarend->getTimestamp() );
				$data=array();
				$i=0;
				foreach( $reservations as $key=>$reservation ){
					$i++;
					$resa=$this->formatReservation( $reservation );
					array_push($data, $resa);
				}
				$reponse->message='TXT_RESERVATION_LIST';
				$reponse->success=true;
				$reponse->data =$data;
			}
		} else {
			$data=array();
			$reponse->message='TXT_NOT_RESERVATION_LIST';
			$reponse->success=false;
			$reponse->data =$data;
			$reponse->debug = 'debug:'.$this->getParam('q');;
		}
		$this->render($reponse);
	}
	public function formatReservation( $reservation ){
		if( $reservation->getLocation() instanceof Object_Location ){
			$resa['locationid']=$reservation->getLocation()->getId();
			$resa['locationname']=$reservation->getLocation()->getName();
		}else{
			$resa['locationid']=''; $resa['locationname']='';
		}
		if( $reservation->getGuest() instanceof Object_Guest ){
			$resa['guestid']=$reservation->getGuest()->getId();
			$resa['guestname']=$reservation->getGuest()->getLastname();
			$resa['guestemail']=$reservation->getGuest()->getEmail();
			$resa['guesttel']=$reservation->getGuest()->getTel();
		}else{
			$resa['guestid']=''; $resa['guestname']=''; $resa['guestemail']='';$resa['guesttel']='';
		}
		if( $reservation->getPerson() instanceof Object_Person ){
			$resa['personid']=$reservation->getPerson()->getId();
			$resa['personfirstname']=$reservation->getPerson()->getFirstname();
			$resa['personlastname']=$reservation->getPerson()->getLastname();
		}else{
			$resa['personid']=''; $resa['personfirstname']=''; $resa['personlastname']='';
		}
		if( $reservation->getServing() instanceof Object_Serving ){
			$resa['servingid']=$reservation->getServing()->getId();
			$resa['servingtitle']=$reservation->getServing()->getTitle();
		}else{
			$resa['servingid']=''; $resa['servingtitle']='';
		}
		$resa['datereservation']=$reservation->getDatereservation()->get('dd-MM-YYY');
		$resa['start']=$reservation->getStart()->get('HH:mm');
		//DT_RowId identifies the id for the datatable
		$resa['DT_RowId']=$reservation->getId();
		$resa['id']=$reservation->getId();
		$resa['status']=$reservation->getStatus();
		$resa['arrived']=$reservation->getArrived();
		$resa['partysize']=$reservation->getPartysize();
		$resa['bookingref']=$reservation->getBookingref();
		$resa['bookingnotes']=$reservation->getBookingnotes();
		return $resa;
	}
}
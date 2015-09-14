<?php
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use Website\Tool\Reponse;
use Website\Tool\Request;

class AdvancedguestController extends Action
{
    public function init() {
        parent::init();

        // do something on initialization //-> see Zend Framework

        // in our case we enable the layout engine (Zend_Layout) for all actions
        $this->enableLayout();
    }

    public function preDispatch() {
        parent::preDispatch();

        // do something before the action is called //-> see Zend Framework
    }

    public function postDispatch() {
        parent::postDispatch();

        // do something after the action is called //-> see Zend Framework
    }

    public function indexAction() {

        $list = new Document\Listing();
        $list->setCondition("parentId = ? AND type IN ('link','page')", [$this->document->getId()]);
        $list->load();
        $this->view->documents = $list;
				

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
    
    public function resaslotAction() {
    	$this->disableLayout();
    	$this->view->doc = $document;
    	$dateres=$this->getParam('date');
		if( $this->getParam('locationid') ){ 
			$locationid=$this->getParam('locationid');
		}else{
			//get default location from URL !!!! should be linked to societe
			$locationid=55;	
		}
		$location=Object_Location::getById($locationid, 1);
    	$datetounix=new Zend_Date( $dateres, 'dd-MM-YYYY HH:mm:ss');
    	$datestart=new Zend_Date( $dateres.' 00:00:00', 'dd-MM-YYYY HH:mm:ss');
    	$dateend=new Zend_Date( $dateres.' 23:59:59', 'dd-MM-YYYY HH:mm:ss');
		$d=$datetounix->get(Zend_Date::WEEKDAY);
		//First get a list of Reservation objects for the day for this location
		$dailyorders = new Object\Reservation\Listing();
		$dailyorders->setCondition("location__id =".$locationid." AND start >= '".$datestart->getTimestamp()."' AND end <= '".$dateend->getTimestamp()."'" );
		if( $location instanceof Object_Location ){
			//get unit of time for that location
			$unit=$location->getResaunit();
			$maxresaperunit=$location->getMaxresaperunit();
			$maxseats=$location->getMaxseats();
        	$unit='00:'.$unit.':00';
			//get all servings for that location
			$servings=$location->getServings();
			$resafinal=array();
			foreach ( $servings as $myserving ){
        		$resa=array();
		       // if( $myserving instanceof Object_Serving ){
					$meal=$myserving->getMealduration();
					//echo $meal;  echo "<BR>";     	
					$mealduration='00:'.$meal.':00';
					$week=array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
					//foreach( $week as $d ){
					if($d=='Monday'){
						$timestart=new Zend_Date($dateres.' '.$myserving->getTimestartmonday().':00', 'dd-MM-YYYY HH:mm:ss');
						$timeend=new Zend_Date($dateres.' '.$myserving->getTimeendmonday().':00', 'dd-MM-YYYY HH:mm:ss');
					}elseif($d=='Tuesday'){
						$timestart=new Zend_Date($dateres.' '.$myserving->getTimestarttuesday().':00', 'dd-MM-YYYY HH:mm:ss');
						$timeend=new Zend_Date($dateres.' '.$myserving->getTimeendtuesday().':00', 'dd-MM-YYYY HH:mm:ss');
					}elseif($d=='Wednesday'){
						$timestart=new Zend_Date($dateres.' '.$myserving->getTimestartwednesday().':00', 'dd-MM-YYYY HH:mm:ss');
						$timeend=new Zend_Date($dateres.' '.$myserving->getTimeendwednesday().':00', 'dd-MM-YYYY HH:mm:ss');
					}elseif($d=='Thursday'){
						$timestart=new Zend_Date($dateres.' '.$myserving->getTimestartthursday().':00', 'dd-MM-YYYY HH:mm:ss');
						$timeend=new Zend_Date($dateres.' '.$myserving->getTimeendthursday().':00', 'dd-MM-YYYY HH:mm:ss');
					}elseif($d=='Friday'){
						$timestart=new Zend_Date($dateres.' '.$myserving->getTimestartfriday().':00', 'dd-MM-YYYY HH:mm:ss');
						$timeend=new Zend_Date($dateres.' '.$myserving->getTimeendfriday().':00', 'dd-MM-YYYY HH:mm:ss');	
					}elseif($d=='Saturday'){
						$timestart=new Zend_Date($dateres.' '.$myserving->getTimestartsaturday().':00', 'dd-MM-YYYY HH:mm:ss');
						$timeend=new Zend_Date($dateres.' '.$myserving->getTimeendsaturday().':00', 'dd-MM-YYYY HH:mm:ss');
					}elseif($d=='Sunday'){
						$timestart=new Zend_Date($dateres.' '.$myserving->getTimestartsunday().':00', 'dd-MM-YYYY HH:mm:ss');
						$timeend=new Zend_Date($dateres.' '.$myserving->getTimeendsunday().':00', 'dd-MM-YYYY HH:mm:ss');
					}
					$endtime=$timeend->sub($mealduration, Zend_Date::TIMES);
					$resatime=array();
					$i=0;
					while($timestart->compare( $endtime, Zend_Date::TIMES) == -1){
						$i++;
						$timeslot=$timestart->get(Zend_Date::HOUR).":".$timestart->get(Zend_Date::MINUTE);
						$orderswarning="";
						$seatswarning="";
						$o=0; //initiate o number of orders already taken during this timeslot
						$p=0; //initiate p number of seats already occupied during this timeslot
						
						//Check if we have too many orders for this timeslot
						foreach($dailyorders as $order){
							if( $order->getStart()->getTimestamp() == $timestart->getTimestamp() ){ $o++;} //calculate number of orders in this timeslot
						}
						if( $o >= $maxresaperunit){ $orderswarning='-'.$o; }else{ $orderswarning='-ok'; } //set warning is number exceeds max reservation per slot
						//Check if we have available seats for this timeslot
						
						$startslot=$timestart->getTimestamp();//First let s identify timestamp for startlost and endlot
						$timestart->add($unit, Zend_Date::TIMES);//Add unit of time to timestart
						
						$endslot=$timestart->getTimestamp();
						
						//let's identify all orders that start after the start of the slot or that finish before the end of the slot
						foreach($dailyorders as $order){
							if( ( $order->getStart()->getTimestamp() <= $startslot AND $order->getEnd()->getTimestamp()>$endslot ) OR ( ($order->getStart()->getTimestamp()) > ( $startslot + ( (int)$meal*60 ) ) ) ){ 
								$size=$order->getPartysize();
								$p=$p+$size;
							}
						}
						if( $p >= $maxseats){ $seatswarning='-'.$p; }else{ $seatswarning='-ok'; }
						
						//Feed the data
						$resatime['shift-'.$i.$orderswarning.$seatswarning]=$timeslot;
					}
					$resafinal[$myserving->getTitle().'_-_'.$myserving->getId()]=$resatime;
			}
			//exit;
			$reponse = new Reponse();
			$reponse->data=$resafinal;
			$reponse->message=$date;
			$reponse->success=true;	  
		    $this->render($reponse);
		}
    }
   
	public function testouille( $data ){
		$data='this is a test';
	}

    public function reservationAction() {
        $this->layout()->setLayout('did_layout_registration');
        $this->view->doc = $document;
        //Find a way to fetch the societe value
        $societe=Object_Societe::getByReference('30000', 1);
        if ($societe instanceof Object_Societe ) {
    	   $locations = $societe->getLocations();
        }
		$this->view->locations=$locations;
    }

	public function getDataAction () {
		// Get Request methode json decode
		$this->getAnswer();
	}
 	public function getAnswer ($tree=false) {
		$this->requete=new Request ( )	;
		$method = $this->requete->method; //$this->getParam('METHOD',$_SERVER["REQUEST_METHOD"]) ;
		$this->id = $this->requete->id;
		$data=$this->requete->params;
		
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
	 * create
	 */
	public function create() {
		$res = new Reponse();
		$data=$this->requete->params;
		$rec = new \Object\Reservation();
		$formattedData=\Object\Reservation::formatData($data); 
		$result=$rec->updateData( $formattedData );
		if ($result instanceof \Object\Reservation) {
			$res->success = true;
			$res->message = "TXT_CREATE_OK" ;
			$res->data = $result;
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
		$person=Object\Reservation::getById($this->id);
		if ($person instanceof Object\Reservation) {
			$person->setValues( $this->requete->params );
			$person->save();
			$res->data =  $person->toArray();
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
}

<?php
use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use Website\Tool\Reponse;
use Website\Tool\Request;

class ReservationController extends Useraware
{

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

	public function timeslotToMinutes($timeslotvar){
		sscanf($timeslotvar, "%d:%d", $hours, $minutes);
		$result=$hours * 3600 + $minutes * 60 + $seconds;
		return $result;
	}

    public function formatDateAndTimeslot($date,$timeslot){
    	return new Zend_Date($date.' '.$timeslot.':00', 'dd-MM-YYYY HH:mm:ss');
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
    	$datestart=$datetounix->getTimestamp();
		$d=$datetounix->get(Zend_Date::WEEKDAY);
		//First get a list of Reservation objects for the day for this location
		$dailyorders = new Object\Reservation\Listing();
		$dailyorders->setCondition("location__id =".$locationid." AND start >= '".$datestart->getTimestamp()."' AND end <= '".$dateend->getTimestamp()."'" );
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
						if( $myserving->getTimestartmonday() ){
							$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartmonday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendmonday() ){
							$timeend=$this->formatDateAndTimeslot($dateres,$myserving->getTimeendmonday());
						}else{$timeend=$datestart;}
					}elseif($d=='Tuesday'){
						if( $myserving->getTimestarttuesday() ){
						$timestart=$this->formatDateAndTimeslot($dateres,$myserving->getTimestarttuesday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendtuesday() ){
						$timeend=$this->formatDateAndTimeslot($dateres,$myserving->getTimeendtuesday());
						}else{$timeend=$datestart;}
					}elseif($d=='Wednesday'){
						if( $myserving->getTimestartwednesday() ){
						$timestart=$this->formatDateAndTimeslot($dateres,$myserving->getTimestartwednesday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendwednesday() ){
						$timeend=$this->formatDateAndTimeslot($dateres,$myserving->getTimeendwednesday());
						}else{$timeend=$datestart;}
					}elseif($d=='Thursday'){
						if( $myserving->getTimestartthursday() ){
						$timestart=$this->formatDateAndTimeslot($dateres,$myserving->getTimestartthursday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendthursday() ){
						$timeend=$this->formatDateAndTimeslot($dateres,$myserving->getTimeendthursday());
						}else{$timeend=$datestart;}
					}elseif($d=='Friday'){
						if( $myserving->getTimestartfriday() ){
						$timestart=$this->formatDateAndTimeslot($dateres,$myserving->getTimestartfriday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendfriday() ){
						$timeend=$this->formatDateAndTimeslot($dateres,$myserving->getTimeendfriday());	
						}else{$timeend=$datestart;}
					}elseif($d=='Saturday'){
						if( $myserving->getTimestartsaturday() ){
						$timestart=$this->formatDateAndTimeslot($dateres,$myserving->getTimestartsaturday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendsaturday() ){
						$timeend=$this->formatDateAndTimeslot($dateres,$myserving->getTimeendsaturday());
						}else{$timeend=$datestart;}
					}elseif($d=='Sunday'){
						if( $myserving->getTimestartsunday() ){
						$timestart=$this->formatDateAndTimeslot($dateres,$myserving->getTimestartsunday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendsunday() ){
						$timeend=$this->formatDateAndTimeslot($dateres,$myserving->getTimeendsunday());
						}else{$timeend=$datestart;}
					}
					$endtime=$timeend-$mealduration;
					$resatime=array();
					$i=0;
					while($timestart<=$endtime){
						$i++;
						$timeslot=$timestart->get(Zend_Date::HOUR).":".$timestart->get(Zend_Date::MINUTE);
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
						$endslot=$timestart
						
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

    public function reservationAction() {
        $this->layout()->setLayout('portal');

        //Find a way to fetch the societe value
	    if( $this->societe ){
	    	$societe=$this->societe;
	    } else {
	    	$societe=Object\Societe::getById( 56, 1 );
	    }
        if ($societe instanceof Object_Societe ) {
    	   $locations = $societe->getLocations();
        }
		$this->view->locations=$locations;
		if( $this->getParam('reservationid') ){
			$reservationid=$this->getParam('reservationid');
			$reservation=Object\Reservation::getById( $reservationid, 1 );
			//Controls
			if( $reservation instanceof Object\Reservation ){
				if( $reservation->getLocation()->getSociete()->getId()==$societe->getId() ){
					$reservationarray=$reservation->toArray();
			       	foreach ($reservationarray as $key=>$val){
			       		//SET RESACHANGE TO TRUE
			       		$this->view->resachange=true;
			       		$this->view->selectedlocationid=$reservation->getLocation()->getId();
			       		$this->view->$key=$val;
			        }
			        //var_dump($reservationarray);exit;
				} else {
					$authorisation=false;
				}
			} else {
				$authorisation=false;
			}
		}else{
			//SET RESACHANGE TO FALSE
			$this->view->resachange=false;
			if( $this->getParam('locationid') ){
				$this->view->selectedlocationid=$this->getParam('locationid');
			}
			if( $this->getParam('resadate') ){
				$this->view->resadate=$this->getParam('resadate');
			}
		}
		$this->view->headLink()->appendStylesheet(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css');
		
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/reservationform-validation.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/form-elements.js');

		$this->view->inlineScript ()->appendScript ( 'jQuery(document).ready(function() {
			Main.init();
			var newresa;
			ReservationFormValidator.init(newresa);
			$("body").on("click", ".locationlinkfinal", function(){
				var newresa="newresa";
				$.ajax({url: "/fr/booking/selectiongroup?locationid="+$("#select_location").val()+"&resadate="+moment( $(".mycalendar").datepicker("getDate") ).format("DD-MM-YYYY")+"&method=CHANGE", success: function(result){
					$(".selectiongroup").html(result);
					ReservationFormValidator.init(newresa);
				}});
			}); 
      		SVExamples.init();
      		PagesUserProfile.init();
			});', 'text/javascript', array (
			'noescape' => true 
		) );
	}
	public function selectiongroupAction(){
		//FIND A WAY TO FETCH THE SOCIETE VALUE

		$societe=$this->societe;

		if ($societe instanceof Object_Societe ) {
			$this->view->locations = $societe->getLocations();
		}
		$this->view->selectedlocationid=$this->getParam('locationid');
		$this->view->resadate=$this->getParam('resadate');
		$this->disableLayout();

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
		if( $this->person ){ $data['person']=$this->person; }
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
		$reservation=Object\Reservation::getById($this->id);
		if ($reservation instanceof Object\Reservation) {
			$reservation->setValues( $this->requete->params );
			$reservation->save();
			$res->data =  $reservation->toArray();
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
	public function listreservationAction(){
		$this->layout()->setLayout('portal'); // listreservation_layout

		$this->reservationsArray();
		

		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/pages-reservation-list.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/initiate-reservation-list.js');
		
		$this->view->inlineScript ()->appendScript ( 'jQuery(document).ready(function() {
			
					Main.init();
		
					InitiateReservationList.init();
				
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
		$societe=$this->societe;
		$locations=$societe->getLocations();
		$initiallocationid=$locations[0]->getId();
		if( $this->getParam('locationid') ){ $locationid = $this->getParam('locationid'); }else{ $locationid = $initiallocationid; }
		$this->view->locations=$locations;
		$mylocation=Object_Location::getById( $locationid, 1);
		if( $mylocation instanceof Object_Location ){
			$this->view->reservations= $mylocation->getResource()->getReservationsByDate($start,$end);
		}
	}
	public function reservationListAction(){
		//get societe/location and serving
		$reponse = new Reponse();
		$societe=$this->societe;
		$locations=$societe->getLocations();
		//if location is not defined we take the first in the list
		$initiallocationid=$locations[0]->getId();
		if( $this->getParam('locationid') ){ $locationid = $this->getParam('locationid'); }else{ $locationid = $initiallocationid; }
		$this->view->locations=$locations;
		$mylocation=Object_Location::getById( $locationid, 1);
		if( $mylocation instanceof Object_Location ){
			//we check if we are in the Editor
			if( $_POST['action'] ){
				//if REMOVE
				if($_POST['action'] =="remove"){
					foreach( $_POST['id'] as $id){
						$myreservation=Object_Reservation::getById( $id, 1);
						if( $myreservation instanceof Object_Reservation){
							$myreservation->SetStatus('cancelled');
							$myreservation->save();
						}
					}
					$reponse->message='TXT_RESERVATION_LIST';
					$reponse->success=true;
					$reponse->data ='';
				}
				//if EDIT
				if($_POST['action'] =="edit"){
					$myreservation=Object_Reservation::getById( $_POST['id'], 1 );
					if( $_POST['data']['guestid'] ){
						$guest=Object_Guest::getById( $_POST['data']['guestid'], 1);
						if($guest instanceof Object_Guest){
							$guest->setLastname($_POST['data']['guestname']);
							$guest->setTel($_POST['data']['guesttel']);
							$guest->save();
						}
					}
					//date update needs to be reworked
					//$myreservation->setStart($_POST['data']['start']);
					$myreservation->setPartysize($_POST['data']['partysize']);
					$myreservation->setBookingref($_POST['data']['bookingref']);
					$myreservation->setBookingnotes($_POST['data']['bookingnotes']);
					$myreservation->setStatus($_POST['data']['status']);
					$myreservation->save();
					$data=$_POST['data'];
					$data['DT_RowId']="row_".$_POST['data']['id'];
					$reponse->message='TXT_RESERVATION_LIST';
					$reponse->success=true;
					$reponse->row =$data;
				}
			}else{
	
				$reservations=$mylocation->getReservations();
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
		}
		$this->render($reponse);
	}
}

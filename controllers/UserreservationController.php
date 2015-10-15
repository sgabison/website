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
	
	public function introAction(){
		$this->layout ()->setLayout ( 'introduction_layout' );
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/introduction.js');
		$this->view->inlineScript ()->appendScript ( 'jQuery(document).ready(function() {
			console.log("initiating IntroductionPanel");
			IntroductionPanel.init();
			});', 'text/javascript', array (
			'noescape' => true 
		) );
		$societes= new Object\Societe\Listing();
		//LIMIT TO LA CRIEE
		$societes->setCondition("oo_id = 554");
		$this->view->societes=$societes;
		if( $this->getParam('selectedLocationid') ){
			$location=Object\Location::getById( $this->getParam('selectedLocationid'), 1);
			if( $location instanceof Object\Location ){
				$this->view->selectedLocation = $location;
			}else{
				die('Wrong location');
			}
		} else {
			foreach( $this->view->societes as $societe ){
				$locations=$societe->getLocations();
			}
			$this->view->selectedLocation=$locations[0];
		}
	}
	public function landingpageAction(){
		$this->layout ()->setLayout ( 'introduction_layout' );
		//$this->view->headScript()->appendFile('http://maps.google.com/maps/api/js?sensor=true');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/gmaps/gmaps.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/landingpage.js');
		$this->view->inlineScript ()->appendScript ( 'jQuery(document).ready(function() {
			console.log("initiating IntroductionPanel");
			Maps.init();
			});', 'text/javascript', array (
			'noescape' => true 
		) );
		$societes= new Object\Societe\Listing();
		//LIMIT TO LA CRIEE
		$societes->setCondition("oo_id = 554");
		$this->view->societes=$societes;
		$locarray=array();
		foreach( $societes as $societe){
			foreach( $societe->getLocations() as $location ){
				if( $location->getGeolocalisation() ){
					$loc['lat']=$location->getGeolocalisation()->getLatitude();
					$loc['lng']=$location->getGeolocalisation()->getLongitude();
				}
				$loc['name']=$location->getName();
				$loc['address']=$location->getAddress();
				$loc['zip']=$location->getZip();
				$loc['City']=$location->getCity();
				$loc['Id']=$location->getId();
				array_push( $locarray, $loc ); 
			}
			$restaurants['data']=$locarray;
		}
		$this->view->restaurants = json_encode($restaurants);
		if( $this->getParam('selectedLocationid') ){
			$location=Object\Location::getById( $this->getParam('selectedLocationid'), 1);
			if( $location instanceof Object\Location ){
				$this->view->selectedLocation = $location;
			}else{
				die('Wrong location');
			}
		} else {
			foreach( $this->view->societes as $societe ){
				$locations=$societe->getLocations();
			}
			$this->view->selectedLocation=$locations[0];
		}
	}
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
    	$dateend=$datestart+86400;
		$d=$datetounix->get(Zend_Date::WEEKDAY_DIGIT);
		//First get a list of Reservation objects for the day for this location
		$dailyorders = new Object\Reservation\Listing();
		$dailyorders->setCondition("location__id =".$locationid." AND start >= ".$datestart." AND end <= ".$dateend );
//		var_dump( $dailyorders ); exit;
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
					if($d=='1' ){
						$closed=$myserving->getClosedmonday();
						$servingstart=$myserving->getTimestartmonday();
						$servingend=$myserving->getTimeendmonday();
						if( $myserving->getTimestartmonday() ){
							$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartmonday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendmonday() ){
							$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendmonday());
						}else{$timeend=$datestart;}
					}elseif($d=='2'){
						$closed=$myserving->getClosedtuesday();
						$servingstart=$myserving->getTimestarttuesday();
						$servingend=$myserving->getTimeendtuesday();
						if( $myserving->getTimestarttuesday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestarttuesday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendtuesday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendtuesday());
						}else{$timeend=$datestart;}
					}elseif($d=='3'){
						$closed=$myserving->getClosedwednesday();
						$servingstart=$myserving->getTimestartwednesday();
						$servingend=$myserving->getTimeendwednesday();
						if( $myserving->getTimestartwednesday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartwednesday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendwednesday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendwednesday());
						}else{$timeend=$datestart;}
					}elseif($d=='4'){
						$closed=$myserving->getClosedthursday();
						$servingstart=$myserving->getTimestartthursday();
						$servingend=$myserving->getTimeendthursday();
						if( $myserving->getTimestartthursday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartthursday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendthursday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendthursday());
						}else{$timeend=$datestart;}
					}elseif($d=='5'){
						$closed=$myserving->getClosedfriday();
						$servingstart=$myserving->getTimestartfriday();
						$servingend=$myserving->getTimeendfriday();
						if( $myserving->getTimestartfriday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartfriday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendfriday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendfriday());	
						}else{$timeend=$datestart;}
					}elseif($d=='6'){
						$closed=$myserving->getClosedsaturday();
						$servingstart=$myserving->getTimestartsaturday();
						$servingend=$myserving->getTimeendsaturday();
						if( $myserving->getTimestartsaturday() ){
						$timestart=$datestart+$this->timeslotToMinutes($myserving->getTimestartsaturday());
						}else{$timestart=$datestart;}
						if( $myserving->getTimeendsaturday() ){
						$timeend=$datestart+$this->timeslotToMinutes($myserving->getTimeendsaturday());
						}else{$timeend=$datestart;}
					}elseif($d=='0'){
						$closed=$myserving->getClosedsunday();
						$servingstart=$myserving->getTimestartsunday();
						$servingend=$myserving->getTimeendsunday();
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
							if( ( (  $startslot <= $order->getStart()->getTimestamp() ) && ( $endslot >= $order->getEnd()->getTimestamp() ) ) ||  ( ( $startslot >= $order->getStart()->getTimestamp() ) && ( $endslot <= ( $order->getStart()->getTimestamp() + $mealduration ) ) ) ){
								$size=$order->getPartysize();
								$p=$p+$size;
							}
							//echo $order->getId(); echo "<br>";
						}
						if( $p >= $maxseats){ $seatswarning='-'.$p; }else{ $seatswarning='-ok'; }
						//Feed the data
						if( $timeslot == $myreservationstartslot ){$slotselected='-selected';}else{$slotselected='';}
						$resatime['shift-'.$i.$orderswarning.$seatswarning.$slotselected]=$timeslot;
						//echo "<br>";echo "<br>";
					}
					if ( $myserving->getId() == $myreservationservingid ){
						$resafinal[$myserving->getTitle().'_-_'.$myserving->getId().'_-_selected_-_'.$closed.'_-_'.$servingstart.'_-_'.$servingend]=$resatime;
					}else{
						$resafinal[$myserving->getTitle().'_-_'.$myserving->getId().'_-_notselected_-_'.$closed.'_-_'.$servingstart.'_-_'.$servingend]=$resatime;
					}
			}
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
	public function checkClosedServings(){
		$servings=$this->selectedLocation->getServings();
    	$date=new Zend_Date();
		$weekClose[0]=1; $weekClose[1]=1; $weekClose[2]=1; $weekClose[3]=1; $weekClose[4]=1; $weekClose[5]=1; $weekClose[6]=1;
		//$date=new Zend_Date();
		//echo $date->get(Zend_Date::WEEKDAY_DIGIT);
		//exit;
		foreach($servings as $myserving){
			$weekClose[1]=$myserving->getClosedmonday()*$weekClose[1];
			$weekClose[2]=$myserving->getClosedtuesday()*$weekClose[2];
			$weekClose[3]=$myserving->getClosedwednesday()*$weekClose[3];
			$weekClose[4]=$myserving->getClosedthursday()*$weekClose[4];
			$weekClose[5]=$myserving->getClosedfriday()*$weekClose[5];
			$weekClose[6]=$myserving->getClosedsaturday()*$weekClose[6];
			$weekClose[0]=$myserving->getClosedsunday()*$weekClose[0];
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
		$this->layout()->setLayout('reservation_layout_registration');
		$this->view->headLink()->appendStylesheet(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/intl-tel-input-master/build/css/intlTelInput.css');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/select2/select2.min.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/intl-tel-input-master/build/js/intlTelInput.js');
		if ( $this->getParam("lg") ){
    		$locale = new \Zend_Locale($this->_getParam ( "lg" ));
    		\Zend_Registry::set("Zend_Locale", $locale);
    		$this->mySessionSite->Locale=$locale;
		}
		$societes= new Object\Societe\Listing();
		$this->view->societes=$societes;
		if( $this->getParam("selectedLocationid") ){
			$selectedLocationid=$this->getParam("selectedLocationid");
		} else {
			$selectedLocationid=944;
		}
		$selectedLocation=Object\Location::getById( $selectedLocationid, 1);
		if( $selectedLocation instanceof Object\Location ){
			$this->selectedLocation=$selectedLocation;
			$today=new zend_date();
			$sixmonthsfromnow=$today->add('6', Zend_Date::MONTH);
			$fulltext="";
			$this->view->societe=$this->selectedLocation->getSociete();
			foreach( $selectedLocation->getShifts($today, $sixmonthsfromnow) as $dayoff ){
				if( $dayoff->getAllDay()==1 ){
					$fulltext=$this->arrayToString( $this->getAllDays( $dayoff->getStart(), $dayoff->getEnd() ) ).",".$fulltext;
				}
			}
			$this->view->offdaysrange=$fulltext;
			$this->view->closeddays=$this->checkClosedServings();
			$this->view->selectedLocation=$selectedLocation;
			$this->view->resachange=false;			

			$this->view->selectedlocationid=$this->selectedLocation->getId();
			if( $this->selectedLocation->getGeolocalisation() ){
	       		$this->view->lat=$this->selectedLocation->getGeolocalisation()->getLatitude();
	       		$this->view->long=$this->selectedLocation->getGeolocalisation()->getLongitude();
			}else{
				$this->view->lat=0;
				$this->view->long=0;
			}	
			if( $this->getParam('resadate') ){
				$this->view->resadate=$this->getParam('resadate');
			}
		} else {
			$this->view->warning="This is not a correct location";
		}
		$this->view->inlineScript ()->appendScript ( 'jQuery(document).ready(function() {
			Main.init();
			ReservationFormValidator.init();
			var newresa="newresa";
			var	today=new Date();
			var getMonth2=function(date) {
			   var month = date.getMonth() + 1;
			   return month < 10 ? "0" + month : "" + month;
			}
			var getDate2=function(date) {
			   var day = date.getDate();
			   return day < 10 ? "0" + day : "" + day;
			} 
			$("body").on("click", ".locationlinkfinal", function(){
				$.blockUI({
					message: "<i class=\"fa fa-spinner fa-spin\"></i> "+t("js_please_wait")
				});
				$(".registergroup").addClass("no-display");
				$(".registergroup1").addClass("no-display");
				$(".registergroup2").addClass("no-display");
				$(".selectgroup").addClass("no-display");
				$(".slotgroup").addClass("no-display");
				$("#calendarbox").removeClass("no-display");
				var newresa="newresa";
				$.ajax({url: "/fr/booking/userselectiongroup?locationid="+$("#select_location").val()+"&partysize="+ $("#party").val()+"&resadate="+ $("#mycalendar").val() +"&slot="+ $("#slotlinkdata").text()+"&method=CHANGE", success: function(result){
					$(".selectiongroup").html(result);
					ReservationFormValidator1.init();
					$(".locationlinkfinal").css( "cursor", "pointer" );
					$.unblockUI();
				}});
			});
			});', 'text/javascript', array (
			'noescape' => true 
		) );
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
		$this->view->partysize=$this->getParam('partysize');
		$this->view->slot=$this->getParam('slot');
		$this->view->resadate=$this->getParam('resadate');
		$this->disableLayout();

	}

	public function getDataAction () {
		// Get Request methode json decode
		$this->getAnswer();
	}
 	public function getAnswer ($tree=false) {
		$this->requete=new Request()	;
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
		$mail->setReplyTo('resaexpress.com@gmail.com', $name=NULL);
		$mail->setSubject($subject);
		if( $array['preferredlanguage'] != "fr" || $array['preferredlanguage'] != "" ){
			$mail->setDocument('/fr/booking/reservation-confirmation-en');
		}else{
			$mail->setDocument('/fr/booking/reservation-confirmation');
		}
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
}
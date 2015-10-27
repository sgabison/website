<?php
	use Website\Controller\Useraware;
	use Pimcore\Model\Document;
	use Pimcore\Model\Asset;
	use Pimcore\Model\Object;
	use Pimcore\Mail;
	use Pimcore\Tool;	
	use Website\Tool\Reponse;
	use Website\Tool\Request;
class EventController extends Useraware {

	public function ajaxcontentAction() {
		$this->layout ()->setLayout ( 'portal' );
		
		$this->view->doc = $document;
	}
	public function preDispatch() {
		parent::preDispatch();
		$this->view->categories = $this->categories = array("job","home","cancelled","offsite","overtime","todo","generic");
	}
	public function calendarAction() {
	    $this->layout ()->setLayout ( 'portal' );
	     
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/pages-events.js');
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jquery.pulsate/jquery.pulsate.min.js');
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/pages-user-profile.js');

        $this->view->inlineScript()->appendScript(
        		'jQuery(document).ready(function() {
					$(".toolbar-subview").removeClass("hidden");
        			Main.init();
 					Events.init();
					PagesUserProfile.init();
        			SVExamples.init();
        			
				});',
        		'text/javascript',
        		array('noescape' => true));
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
				$reponse->message = "Affichage des informations impossible avec id";
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
		$dataFormatted = \Object\Shift::format_to_pim($data);
		$rec = $this->selectedLocation->createShift($dataFormatted);
		if ($rec instanceof \Object\Shift) {
			$res->success = true;
			$res->message = "TXT_EVENT_CREATE_OK" ;
			$res->data = $rec->toArray();
			$res->debug = $this->selectedLocation->getName();
		} else {
			$res->message = "TXT_EVENT_CREATE_ERROR"  ;
			$res->data = $rec;
			$res->debug = $data;
		}
		return $res;
	}
	/**
	 * view
	 */
	public function view($keyterm ='') {
		$res = new Reponse();
		$res->isTree    = false;
		if ($this->id>0):
		$rec=\Object\Shift::getById($this->id);
		$res->data =($rec instanceof Object\Shift)? $rec->toArray():"";
		else:
		$res->data =  $this->getArray($this->getList());
		endif;
		$res->success = true;
		$res->message = "Affichage des informations";
		return $res;
	}
	
	/**
	 * update
	 */
	public function update() {
		$res = new Reponse();
		$shift=Object\Shift::getById($this->id);
		if ($shift instanceof Object\Shift) {
			$data=$this->requete->params;
			$dataFormatted = \Object\Shift::format_to_pim($data);
			$shift->setValues( $dataFormatted );
			$shift->save();
			$res->data =  $shift->toArray();
			$res->success = true;
			$res->message ="TXT_EVENT_CREATE_OK";
			$res->debug=$dataFormatted;
		} else {
			$res->data =  $this->requete->params;
			$res->success = false;
			$res->message = "TXT_EVENT_UPDATE_FAIL" ;
		}
		return $res;
	}
	/**
	 * destroy
	 */
	public function destroy() {
		$res = new Reponse();
		$rec=Object\Shift::getById($this->id);
		if ($rec ) {
			$rec->delete();
			$res->success = true;
			$res->message = 'TXT_EVENT_DESTROY';
		} else {
			$res->message = "TXT_EVENT_DESTROY_FAIL";
		}
		return $res;
	}
	public function getArray($list){
		$listarray=array();
		if($list) :
		Foreach($list as $object):
		$listarray[]= $object->toArray();
		endforeach;
		endif;
		return $listarray;
	}
	public function getList () {
	
		if  ($this->selectedLocation) :
			return $this->view->events=$this->selectedLocation->getShifts();
		else :
			return $this->view->events=array();
		endif;

	}
	public function createArray( $type, $start, $end, $title ){
		$array=array();
		$array["id"]=$type; 
		$array["title"]=$title;
		$array["allDay"]= true;
		$array["className"]="generic";
		$array["category"]="generic";
		$array["content"]="";
		$array["bookable"]=NULL;
		$array["start"]=$start;
		$array["end"]=$end;
		$array["person"]="";
		return $array;
	}
	public function toStartDate($date){
		return new Zend_Date( $date.'T02:00:00', 'YYYY-MM-DDTHH:mm:ss' );
	}
	public function toEndDate($date){
		return new Zend_Date( $date.'T03:00:00', 'YYYY-MM-DDTHH:mm:ss' );
	}
	public function getEventsAction() {
		$this->requete=new Request ( )	;
		$data=$this->requete->params;
		$METHOD= $this->requete->method;
 
		
		// Short-circuit if the client did not give us a date range.
		if (! isset ( $data ['start'] ) || ! isset ( $data ['end'] )) {
			die ( "Veuillez indiquer une plage de dates/Please provide a date range." );
		}

		if($data ['timezone']) : date_default_timezone_set ( $data ['timezone'] );
		else: date_default_timezone_set ( 'Europe/Paris' );
		endif;
 
		
		// Parse the start/end parameters.
		// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
		// Since no timezone will be present, they will parsed as UTC.
		$range_start = Object\Shift::parseDateTime ( $data ['start'] );
		$range_end = Object\Shift::parseDateTime ( $data ['end'] );
		$data [] = $range_start->toString ( \Zend_Date::ISO_8601 );
		$data [] = $range_end->toString ( \Zend_Date::ISO_8601 );
		// Parse the timezone parameter if it is present.
		$input_arrays = ($this->selectedLocation)? $this->selectedLocation->getShifts( $range_start, $range_end ): array(); //new Object\Shift\Listing (); // json_decode($json, true);
		                                             
		// Accumulate an output array of event data arrays.
		$output_arrays = array ();
		foreach ( $input_arrays as $event ) {
			if ($event->isWithinDayRange ( $range_start, $range_end )) {
				$output_arrays [] = $event->toCalendar ();
			}
		}
		// Send JSON to the client.
		$reponse = new Reponse ();

		$start=new Zend_date( $range_start );
		$end=new Zend_date( $range_end );	
		$holidays=[];
		$holidays['newyear']=$start->get('YYYY').'-01-01';
		$holidays['firstmay']=$start->get('YYYY').'-05-01';
		$holidays['eightmay']=$start->get('YYYY').'-05-08';
		$holidays['bastille']=$start->get('YYYY').'-07-16';
		$holidays['virginmary']=$start->get('YYYY').'-08-15';
		$holidays['allsaints']=$start->get('YYYY').'-11-01';
		$holidays['rememberance']=$start->get('YYYY').'-11-11';
		$holidays['xmas']=$start->get('YYYY').'-12-25';
		$holidays['easter2016']='2016-03-27';
		$holidays['easter2017']='2017-03-16';
		$holidays['easter2018']='2018-04-01';
		$holidays['easter2019']='2019-04-21';
		$holidays['easter2020']='2020-04-12';
		$holidays['eastermonday2016']='2016-03-28';
		$holidays['eastermonday2017']='2017-03-17';
		$holidays['eastermonday2018']='2018-04-02';
		$holidays['eastermonday2019']='2019-04-22';
		$holidays['eastermonday2020']='2020-04-13';
		$holidays['ascension2016']='2016-05-05';
		$holidays['ascension2017']='2017-05-25';
		$holidays['ascension2018']='2018-05-10';
		$holidays['ascension2019']='2019-05-30';
		$holidays['ascension2020']='2020-05-21';
		$holidays['whitmonday2016']='2016-05-16';
		$holidays['whitmonday2017']='2017-06-05';
		$holidays['whitmonday2018']='2018-05-21';
		$holidays['whitmonday2019']='2019-06-10';
		$holidays['whitmonday2020']='2020-06-01';
		$extradays=[];
		$extradays['mothersday2016']='2016-05-29';
		$extradays['mothersday2017']='2017-05-28';
		$extradays['mothersday2018']='2018-05-27';
		$extradays['fathersday2016']='2016-06-21';
		$extradays['fathersday2017']='2017-06-18';
		$extradays['fathersday2018']='2018-06-15';
		$extradays['grandfathersday2016']='2016-10-02';
		$extradays['grandfathersday2017']='2017-10-01';
		$extradays['grandfathersday2018']='2018-10-07';
		$extradays['grandmothersday2016']='2016-03-06';
		$extradays['grandmothersday2017']='2017-03-05';
		$extradays['grandmothersday2018']='2018-03-04';
		$extradays['epiphany']=$start->get('YYYY').'-01-06';
		$extradays['mardi_gras']=$start->get('YYYY').'-02-09';
		$extradays['st_valentin']=$start->get('YYYY').'-02-14';
		$extradays['womans_day']=$start->get('YYYY').'-03-08';
		$extradays['st_patrick']=$start->get('YYYY').'-03-17';
		$extradays['fete_musique']=$start->get('YYYY').'-06-21';
		$extradays['halloween']=$start->get('YYYY').'-10-31';
		
		foreach($holidays as $key=>$holiday){
			if( $this->toStartDate($holiday)->isLater($start) && $this->toStartDate($holiday)->isEarlier($end) ){
				array_push( $output_arrays, $this->createArray( 'statutory', $this->toStartDate( $holiday )->toString(\Zend_Date::ISO_8601), $this->toEndDate( $holiday )->toString(\Zend_Date::ISO_8601), $key ) );
			}
		} 
		foreach($extradays as $key=>$extraday){
			if( $this->toStartDate($extraday)->isLater($start) && $this->toStartDate($extraday)->isEarlier($end) ){
				array_push( $output_arrays, $this->createArray( 'extraday', $this->toStartDate( $extraday )->toString(\Zend_Date::ISO_8601), $this->toEndDate( $extraday )->toString(\Zend_Date::ISO_8601), $key ) );
			}
		} 		
		$reponse->data = $output_arrays; // $input_arrays;
		$reponse->message = "TXT_SHIFTS_SENT";
		$reponse->success = true;		
		$this->render ( $reponse );

	}
}

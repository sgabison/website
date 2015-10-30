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
		$this->requete=new Request();
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
		// var_dump( $output_arrays ); exit;
		// Send JSON to the client.
		$reponse = new Reponse ();
		$output_arrays=$this->getSpecialEventsAction($range_start, $range_end, $output_arrays);
		//exit;
		$reponse->data = $output_arrays; // $input_arrays;
		$reponse->message = "TXT_SHIFTS_SENT";
		$reponse->success = true;		
		$this->render ( $reponse );
	}
	public function getHolidaysAction() {
		$this->requete=new Request();
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
		$output_arrays = array ();
		$reponse = new Reponse ();
		$output_arrays=$this->getSpecialEventsAction($range_start, $range_end, $output_arrays);
		//exit;
		$reponse->data = $output_arrays; // $input_arrays;
		$reponse->message = "TXT_SHIFTS_SENT";
		$reponse->success = true;		
		$this->render ( $reponse );
	}
	public function getSpecialEventsAction($range_start, $range_end, $output_arrays){
		$start=new Zend_Date( $range_start );
		$end=new Zend_Date( $range_end );
		$holidays=[];
		$extradays=[];
		if( $this->language != 'fr'){
			$holidays['Newyear']=$start->get('YYYY').'-01-01';
			$holidays['Newyear.']=$end->get('YYYY').'-01-01';
			$holidays['Firstmay']=$start->get('YYYY').'-05-01';
			$holidays['Eightmay']=$start->get('YYYY').'-05-08';
			$holidays['Bastille']=$start->get('YYYY').'-07-16';
			$holidays['Virginmary']=$start->get('YYYY').'-08-15';
			$holidays['Allsaints']=$start->get('YYYY').'-11-01';
			$holidays['Rememberance']=$start->get('YYYY').'-11-11';
			$holidays['Xmas']=$start->get('YYYY').'-12-25';
			$holidays['Easter2016']='2016-03-27';
			$holidays['Easter2017']='2017-03-16';
			$holidays['Easter2018']='2018-04-01';
			$holidays['Easter2019']='2019-04-21';
			$holidays['Easter2020']='2020-04-12';
			$holidays['Eastermonday2016']='2016-03-28';
			$holidays['Eastermonday2017']='2017-03-17';
			$holidays['Eastermonday2018']='2018-04-02';
			$holidays['Eastermonday2019']='2019-04-22';
			$holidays['Eastermonday2020']='2020-04-13';
			$holidays['Ascension2016']='2016-05-05';
			$holidays['Ascension2017']='2017-05-25';
			$holidays['Ascension2018']='2018-05-10';
			$holidays['Ascension2019']='2019-05-30';
			$holidays['Ascension2020']='2020-05-21';
			$holidays['Whitmonday2016']='2016-05-16';
			$holidays['Whitmonday2017']='2017-06-05';
			$holidays['Whitmonday2018']='2018-05-21';
			$holidays['Whitmonday2019']='2019-06-10';
			$holidays['Whitmonday2020']='2020-06-01';
			$extradays['Mothersday2016']='2016-05-29';
			$extradays['Mothersday2017']='2017-05-28';
			$extradays['Mothersday2018']='2018-05-27';
			$extradays['Fathersday2016']='2016-06-21';
			$extradays['Fathersday2017']='2017-06-18';
			$extradays['Fathersday2018']='2018-06-15';
			$extradays['Grandfathers.2016']='2016-10-02';
			$extradays['Grandfathersday2017']='2017-10-01';
			$extradays['Grandfathers.2018']='2018-10-07';
			$extradays['Grandmothers.2016']='2016-03-06';
			$extradays['Grandmothers.2017']='2017-03-05';
			$extradays['Grandmothers.2018']='2018-03-04';
			$extradays['Epiphany']=$start->get('YYYY').'-01-06';
			$extradays['Epiphany.']=$end->get('YYYY').'-01-06';
			$extradays['Mardi_gras']=$start->get('YYYY').'-02-09';
			$extradays['St_valentin']=$start->get('YYYY').'-02-14';
			$extradays['Womans_day']=$start->get('YYYY').'-03-08';
			$extradays['St_patrick']=$start->get('YYYY').'-03-17';
			$extradays['Fete_musique']=$start->get('YYYY').'-06-21';
			$extradays['Halloween']=$start->get('YYYY').'-10-31';
		}else{
			$holidays['Nouvel.an']=$start->get('YYYY').'-01-01';
			$holidays['Nouvel.an.']=$end->get('YYYY').'-01-01';
			$holidays['1.Mai']=$start->get('YYYY').'-05-01';
			$holidays['8.Mai']=$start->get('YYYY').'-05-08';
			$holidays['Fet.Nat.']=$start->get('YYYY').'-07-16';
			$holidays['Assomption']=$start->get('YYYY').'-08-15';
			$holidays['Toussaint']=$start->get('YYYY').'-11-01';
			$holidays['11.Nov']=$start->get('YYYY').'-11-11';
			$holidays['Noel']=$start->get('YYYY').'-12-25';
			$holidays['Paque.16']='2016-03-27';
			$holidays['Paque.17']='2017-03-16';
			$holidays['Paque.18']='2018-04-01';
			$holidays['Paque.19']='2019-04-21';
			$holidays['Paque.20']='2020-04-12';
			$holidays['Lundi.Paque.16']='2016-03-28';
			$holidays['Lundi.Paque.17']='2017-03-17';
			$holidays['Lundi.Paque.18']='2018-04-02';
			$holidays['Lundi.Paque.19']='2019-04-22';
			$holidays['Lundi.Paque.20']='2020-04-13';
			$holidays['Ascension.16']='2016-05-05';
			$holidays['Ascension.17']='2017-05-25';
			$holidays['Ascension.18']='2018-05-10';
			$holidays['Ascension.19']='2019-05-30';
			$holidays['Ascension.20']='2020-05-21';
			$holidays['Pentecote.16']='2016-05-16';
			$holidays['Pentecote.17']='2017-06-05';
			$holidays['Pentecote.18']='2018-05-21';
			$holidays['Pentecote.19']='2019-06-10';
			$holidays['Pentecote.20']='2020-06-01';
			$extradays['Fete.Mere.16']='2016-05-29';
			$extradays['Fete.Mere.17']='2017-05-28';
			$extradays['Fete.Mere.18']='2018-05-27';
			$extradays['Fete.Mere.16']='2016-06-21';
			$extradays['Fete.Mere.7']='2017-06-18';
			$extradays['Fete.Mere.18']='2018-06-15';
			$extradays['GrandPeres.16']='2016-10-02';
			$extradays['GrandPeres.17']='2017-10-01';
			$extradays['GrandPeres.18']='2018-10-07';
			$extradays['GrandMeres.16']='2016-03-06';
			$extradays['GrandMeres.17']='2017-03-05';
			$extradays['GrandMeres.18']='2018-03-04';
			$extradays['Epiphanie']=$start->get('YYYY').'-01-06';
			$extradays['Epiphanie.']=$end->get('YYYY').'-01-06';
			$extradays['mardi.gras']=$start->get('YYYY').'-02-09';
			$extradays['St.valentin']=$start->get('YYYY').'-02-14';
			$extradays['Womans.day']=$start->get('YYYY').'-03-08';
			$extradays['St.Patrick']=$start->get('YYYY').'-03-17';
			$extradays['Fete_musique']=$start->get('YYYY').'-06-21';
			$extradays['Halloween']=$start->get('YYYY').'-10-31';		
		}
		foreach($holidays as $key=>$holiday){
			if( $this->toStartDate($holiday)->isLater($start) && $this->toStartDate($holiday)->isEarlier($end) ){
				array_push( $output_arrays, $this->createArray( 'statutory', $this->toStartDate( $holiday )->toString(\Zend_Date::ISO_8601), $this->toEndDate( $holiday )->toString(\Zend_Date::ISO_8601), $key ) );
				//var_dump( $this->createArray( 'statutory', $this->toStartDate( $holiday )->toString(\Zend_Date::ISO_8601), $this->toEndDate( $holiday )->toString(\Zend_Date::ISO_8601), $key ) );
			}
		} 
		foreach($extradays as $key=>$extraday){
			if( $this->toStartDate($extraday)->isLater($start) && $this->toStartDate($extraday)->isEarlier($end) ){
				array_push( $output_arrays, $this->createArray( 'extraday', $this->toStartDate( $extraday )->toString(\Zend_Date::ISO_8601), $this->toEndDate( $extraday )->toString(\Zend_Date::ISO_8601), $key ) );
				//var_dump( $this->createArray( 'extraday', $this->toStartDate( $extraday )->toString(\Zend_Date::ISO_8601), $this->toEndDate( $extraday )->toString(\Zend_Date::ISO_8601), $key ) );
			}
		}
		//var_dump( $output_arrays ); exit;
		return $output_arrays;
	}
}

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
		$this->layout ()->setLayout ( 'layouts_single_page' );
		
		$this->view->doc = $document;
	}
	public function preDispatch() {
		parent::preDispatch();
		$this->view->categories = $this->categories = array("job","home","cancelled","offsite","overtime","todo","generic");
	}
	public function calendarAction() {
	    $this->layout ()->setLayout ( 'portal' );
	     
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/pages-calendar.js');
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jquery.pulsate/jquery.pulsate.min.js');
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/pages-user-profile.js');
        
        $this->view->inlineScript()->appendScript(
        		'jQuery(document).ready(function() {
					Main.init();
 					Calendar.init();
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
			$res->message = "TXT_CREATE_OK" ;
			$res->data = $rec->toArray();
			$res->debug = $this->selectedLocation->getName();
		} else {
			$res->message = "TXT_CREATE_ERROR"  ;
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
			$res->message ="TXT_UPDATE_OK";
			$res->debug=$dataFormatted;
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
		$rec=Object\Shift::getById($this->id);
		if ($rec ) {
			$rec->delete();
			$res->success = true;
			$res->message = 'Destroyed';
		} else {
			$res->message = "Failed to destroy";
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
	public function getEventsAction() {
		$this->requete=new Request ( )	;
		$data=$this->requete->params;
		$METHOD= $this->requete->method;
 
		// PHP will fatal error if we attempt to use the DateTime class without this being set.
		date_default_timezone_set ( 'UTC' );
		
		// Short-circuit if the client did not give us a date range.
		if (! isset ( $data ['start'] ) || ! isset ( $data ['end'] )) {
			die ( "Veuillez indiquer une plage de dates/Please provide a date range." );
		}
		
		// Parse the start/end parameters.
		// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
		// Since no timezone will be present, they will parsed as UTC.
		$range_start = Object\Shift::parseDateTime ( $data ['start'] );
		$range_end = Object\Shift::parseDateTime ( $data ['end'] );
		$data [] = $range_start->toString ( \Zend_Date::ISO_8601 );
		$data [] = $range_end->toString ( \Zend_Date::ISO_8601 );
		// Parse the timezone parameter if it is present.
		$timezone = null;
		if (isset ( $data ['timezone'] )) {
			$timezone = new DateTimeZone ( $data ['timezone'] );
		}
		
		// Read and parse our events JSON file into an array of event data arrays.
		$json = file_get_contents ( PIMCORE_LAYOUTS_DIRECTORY . '/assets/json/events.json' );
		$input_arrays = ($this->selectedLocation)? $this->selectedLocation->getShifts( $range_start, $range_end ): array(); //new Object\Shift\Listing (); // json_decode($json, true);
		                                             
		// Accumulate an output array of event data arrays.
		$output_arrays = array ();
		foreach ( $input_arrays as $event ) {
			
			// Convert the input array into a useful Event object
			// $event2 = Object\Shift::create($event->toArray());
			// $event2->setKey(Pimcore_File::getValidFilename('New Name 10'));
			// $event2->setParentId(53);
			// $event2->save();
			// $output_arrays['new'] = $event2 ;
			
			// $data[]= $event->getEnd()->toString(\Zend_Date::ISO_8601);
			// If the event is in-bounds, add it to the output
			if ($event->isWithinDayRange ( $range_start, $range_end )) {
				$output_arrays [] = $event->toCalendar ();
			}
		}
		
		// Send JSON to the client.
		$reponse = new Reponse ();
		
		$reponse->data = $output_arrays; // $input_arrays;
		$reponse->message = "TXT_SHIFTS_SENT";
		$reponse->success = true;
		
		$this->render ( $reponse );
		// echo json_encode($output_arrays);
	}
}

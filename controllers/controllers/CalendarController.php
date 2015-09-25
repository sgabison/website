<?php
	use Website\Controller\Useraware;
	use Pimcore\Model\Document;
	use Pimcore\Model\Asset;
	use Pimcore\Model\Object;
	use Pimcore\Mail;
	use Pimcore\Tool;	
	use Website\Tool\Reponse;
	use Website\Tool\Request;
	class CalendarController extends Useraware {


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
//		$data=$this->getAllParams();
 
		// PHP will fatal error if we attempt to use the DateTime class without this being set.
		if($data ['timezone']) : date_default_timezone_set ( $data ['timezone'] );
		else: date_default_timezone_set ( 'Europe/Paris' );
		endif;
		// Short-circuit if the client did not give us a date range.
		if (! isset ( $data ['start'] ) || ! isset ( $data ['end'] )) {
			
			 $data ['start'] = (! isset ( $data ['start'] ))? \Zend_Date::now()->toString('YYYY-MM-dd') :  $data ['start'] ;
			 $data ['end'] = (! isset ( $data ['end'] )) ? \Zend_Date::now()->toString('YYYY-MM-dd') : $data ['end'] ;
			 //die ( "Veuillez indiquer une plage de dates/Please provide a date range." );
		}
		
		// Parse the start/end parameters.
		// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
		// Since no timezone will be present, they will parsed as UTC.
		$range_start = new \Zend_Date($data ['start'],'YYYY-MM-dd'); 
		$range_end = new \Zend_Date($data ['end'],'YYYY-MM-dd');
		$input_arrays = ($this->selectedLocation)? (array) $this->selectedLocation->getRapportReservations( $range_start, $range_end ): array(); 
		// Accumulate an output array of event data arrays.
		$output_arrays = array ();
		$format  = \Zend_Date::ISO_8601;
		if($input_arrays):
		$i=1;
		foreach ( $input_arrays as  $input ) {
			$array=array();
			$array['id'] = $i++;
			$array['title'] = $input['serving_name']." ".$input['nbre']." ".\Zend_Registry::get('Zend_Translate')->translate("reservations");
			$array['serving_id'] = $input['serving_id'];
			$array['allDay'] = false ;
			$array['location_id'] = $this->selectedLocation->getId();
			$array['className'] = "event-generic" ;
			$array['category'] = "generic";
			$array['content'] = $input['couverts']." ".\Zend_Registry::get('Zend_Translate')->translate("couverts");
			$array['statut'] = $input['statut'];
			$start = new \Zend_Date($input['date_start'], \Zend_Date::TIMESTAMP);
			$end= new \Zend_Date($input['date_end'], \Zend_Date::TIMESTAMP);
			$array['start'] = $start->toString($format);
			$array['end'] = $end->toString($format);
			if ($array['statut'] != "cancelled") $output_arrays [] = $array;		
		}
		endif;
		// Send JSON to the client.
		$reponse = new Reponse () ;		
		$reponse->data = $output_arrays;//$output_arrays; 
		$reponse->message = "TXT_RAPPORT_SENT";
		$reponse->success = true;
		$reponse->debug=   $this->selectedLocation->getRapportReservations( $range_start, $range_end );//$input_arrays;
		
		$this->render ( $reponse );
		// echo json_encode($output_arrays);
	}
}

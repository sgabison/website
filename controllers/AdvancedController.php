<?php
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use Website\Tool\Reponse;
class AdvancedController extends Action {
	public function init() {
		parent::init ();
		
		// do something on initialization //-> see Zend Framework
		
		// in our case we enable the layout engine (Zend_Layout) for all actions
		$this->enableLayout ();
	}
	public function preDispatch() {
		parent::preDispatch ();
		// do something before the action is called //-> see Zend Framework
		\Pimcore\Tool\Authentication::authenticateSession() ;
		$adminSession = new \Zend_Session_Namespace ( "pimcore_admin" );

		if ( ! $adminSession->user instanceof \User ) {
			$auth = Zend_Auth::getInstance ();		
			if ($auth->hasIdentity ()) {
				// We have a login session (user is logged in)
				$this->view->person = $this->person = $auth->getIdentity ();
				$this->view->societe = $this->societe = \Object\Societe::getById ( $this->person->getSociete ()->getId () );
			} else {
				$this->forward ( "form-login", "login" );
			}
		} else {
			$this->view->person = $this->person = \Object\Person::getById(248) ;
			$this->view->societe = $this->societe = \Object\Societe::getById ( $this->person->getSociete ()->getId () );			
		}
	}

	public function testAction() {
		
		// Send JSON to the client.
		$reponse = new Reponse ();
		
		$reponse->data = $this->person->toArray (); // $input_arrays;
		                                            // $this->societe->save();
		
		$reponse->message = "TXT_PERSON_SENT";
		$reponse->success = true;
		
		$this->render ( $reponse );
	}
	public function indexAction() {
		$list = new Document\Listing ();
		$list->setCondition ( "parentId = ? AND type IN ('link','page')", [ 
				$this->document->getId () 
		] );
		$list->load ();
		$this->view->documents = $list;
	}
	public function searchAction() {
		if ($this->getParam ( "q" )) {
			try {
				$page = $this->getParam ( 'page' );
				if (empty ( $page )) {
					$page = 1;
				}
				$perPage = 10;
				
				$result = \Pimcore\Google\Cse::search ( $this->getParam ( "q" ), (($page - 1) * $perPage), null, [ 
						"cx" => "002859715628130885299:baocppu9mii" 
				], $this->getParam ( "facet" ) );
				
				$paginator = \Zend_Paginator::factory ( $result );
				$paginator->setCurrentPageNumber ( $page );
				$paginator->setItemCountPerPage ( $perPage );
				$this->view->paginator = $paginator;
				$this->view->result = $result;
			} catch ( \Exception $e ) {
				// something went wrong: eg. limit exceeded, wrong configuration, ...
				\Logger::err ( $e );
				echo $e->getMessage ();
				exit ();
			}
		}
	}
	public function sitemapAction() {
		set_time_limit ( 900 );
		
		$this->view->initial = false;
		
		if ($this->getParam ( "doc" )) {
			$doc = $this->getParam ( "doc" );
		} else {
			$doc = $this->document->getProperty ( "mainNavStartNode" );
			$this->view->initial = true;
		}
		
		Pimcore::collectGarbage ();
		
		$this->view->doc = $doc;
	}
	public function assetThumbnailListAction() {
		
		// try to get the tag where the parent folder is specified
		$parentFolder = $this->document->getElement ( "parentFolder" );
		if ($parentFolder) {
			$parentFolder = $parentFolder->getElement ();
		}
		
		if (! $parentFolder) {
			// default is the home folder
			$parentFolder = Asset::getById ( 1 );
		}
		
		// get all children of the parent
		$list = new \Asset\Listing ();
		$list->setCondition ( "path like ?", $parentFolder->getFullpath () . "%" );
		
		$this->view->list = $list;
	}
	public function ajaxcontentAction() {
		$this->layout ()->setLayout ( 'layouts_single_page' );
		
		$this->view->doc = $document;
	}
	public function calendarAction() {
		$this->layout ()->setLayout ( 'layouts_single_page' );
	}
	public function getEventsAction() {
		// PHP will fatal error if we attempt to use the DateTime class without this being set.
		date_default_timezone_set ( 'UTC' );
		
		// Short-circuit if the client did not give us a date range.
		if (! isset ( $_GET ['start'] ) || ! isset ( $_GET ['end'] )) {
			die ( "Please provide a date range." );
		}
		
		// Parse the start/end parameters.
		// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
		// Since no timezone will be present, they will parsed as UTC.
		$range_start = Object\Shift::parseDateTime ( $_GET ['start'] );
		$range_end = Object\Shift::parseDateTime ( $_GET ['end'] );
		$data [] = $range_start->toString ( \Zend_Date::ISO_8601 );
		$data [] = $range_end->toString ( \Zend_Date::ISO_8601 );
		// Parse the timezone parameter if it is present.
		$timezone = null;
		if (isset ( $_GET ['timezone'] )) {
			$timezone = new DateTimeZone ( $_GET ['timezone'] );
		}
		
		// Read and parse our events JSON file into an array of event data arrays.
		$json = file_get_contents ( PIMCORE_LAYOUTS_DIRECTORY . '/assets/json/events.json' );
		$input_arrays = new Object\Shift\Listing (); // json_decode($json, true);
		                                             
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

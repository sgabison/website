<?php
use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;
use Website\Tool\Reponse;

class StatsController extends Useraware {
	public function init() {
		parent::init ();
		$this->enableLayout ();
	}
	public function preDispatch() {
		parent::preDispatch ();
	}
	public function postDispatch() {
		parent::postDispatch ();
		// $this->view->locations = $this->societe->getLocations() ;
		
		// do something after the action is called //-> see Zend Framework
	}
	public function defaultAction() {
		// Send JSON to the client.
		$reponse = new Reponse ();
		
		$reponse->data = $this->person->toArray (); // $input_arrays;
		                                            // $this->societe->save();
		
		$reponse->message = "TXT_PERSON_SENT";
		$reponse->success = true;
		
		$this->render ( $reponse );
	}
	public function errorAction() {
		$this->layout ()->setLayout ( 'portal' );
		$this->view->error=$this->getParam('error');
	}
	public function mysql_protect($value) {
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}
		if (!is_numeric($value)) {
			$value = "'" . mysql_real_escape_string($value) . "'";
		}
		return $value;
	}
	public function dailystatsAction() {
		$this->disableLayout();
		$this->disableViewAutoRender();
		$today=new Zend_date();
		$day=$today->get('dd-MM-YYYY');
		$start=new Zend_Date($day.' 00:00:00', 'dd-MM-YYYY HH:mm:ss');
		$end=new Zend_Date($day.' 23:59:59', 'dd-MM-YYYY HH:mm:ss');
		$todayts=$today->getTimeStamp();
		$locations=$this->societe->getLocations();
		foreach( $locations as $location ){
			//$reservations=new Object\Reservation\Listing();
			//$reservations->setCondition("location__id =".$location->getId()." AND start >= ".$start." AND end <= ".$end );
			//$reservations->setCondition("location__id =".$location->getId() );
			//foreach( $reservations as $reservation){
			//	echo $reservation->getId(); echo "<br>";
			//}
		}
		$this->view->reservations=$reservations;
	}
	public function statisticsAction() {
		$this->disableLayout();
		$this->disableViewAutoRender();
				
	}
}
<?php
use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;
use Website\Tool\Reponse;
use Website\Tool\Request;

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
	public function weeklystatsAction() {
		$this->disableLayout();
		$this->disableViewAutoRender();
		$type=$this->getParam('type');
		$timeline=$this->getParam('timeline');
		if($timeline=="past"){
			$end= new Zend_Date();
			$end->setTime('23:59:59');
			$date = new Zend_Date();
			$date->sub(6, Zend_Date::DAY);
		}else{
			$start= new Zend_Date();
			$start->setTime('00:00:01');
			$date = new Zend_Date();
			$end = new Zend_Date();
		}
		$date->setTime('00:00:01');
		//Build reference array
		$i=0;
		//echo $end->getTimestamp(); echo "<br>";
		while($i<=6){
			$referencearray[ $date->get('dd-MM-YYYY') ]=0;
			$date->add(1, Zend_Date::DAY);
			$i++;
		}
		//Get the results array
		$start = new Zend_date;
		if($timeline=="past"){
			$start->sub(6, Zend_Date::DAY);
			$start->setTime('00:00:01');
		}else{
			$end->add(6, Zend_Date::DAY);
			$end->setTime('23:59:59');
		}
		$stat= new \Object\Stats;
		$results=$stat->getStatistics( $this->selectedLocation->getId(), $start, $end );
		$startoftheweek=$start->get('dd-MM-YYYY');
		//echo $start->getTimestamp(); echo "<br>";exit;
		foreach ( $this->selectedLocation->getServings() as $serving ){
			//initiate orderarray and seatsarray
			$orderarray=$referencearray;
			$seatsarray=$referencearray;			
			foreach( $results as $result ){
				$datein=date("d-m-Y",$result["date_start"]);
				if( $serving->getId() == $result['serving_id'] ){
					$servingid=$result['serving_id'];
					if ( array_key_exists( $datein , $referencearray ) ){
						$orderarray[ $datein ] = $result["nbre"];
						$seatsarray[ $datein ] = $result["couverts"];
					}
				}
			}
			if( $type == 'seats'){	
				$servingarray[ $serving->getTitle() ]=$seatsarray;			
			}else{
				$servingarray[ $serving->getTitle() ]=$orderarray;
			}
		}
		$reponse = new Reponse ();
		$reponse->data = $servingarray; 
		$reponse->message = "TXT_STATS_SENT";
		$reponse->success = true;
		$this->render ( $reponse );
	}
	public function statisticsAction() {
		$this->layout()->setLayout('portal');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jquery.sparkline/jquery.sparkline.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/stats.js');
		$this->view->inlineScript ()->appendScript ( 'jQuery(document).ready(function() {
					StatisticsForm.init();
				});', 'text/javascript', array (
								'noescape' => true
		) ); 
	}
}
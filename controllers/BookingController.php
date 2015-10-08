<?php
use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;
use Website\Tool\Reponse;

class BookingController extends Useraware {
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
	public function portalAction() {

		$this->view->location=$this->selectedLocation;
		$this->layout ()->setLayout ( 'portal' );
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jquery.sparkline/jquery.sparkline.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jquery-mockjax/jquery.mockjax.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js');
// 		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/nvd3/lib/d3.v3.js');
// 		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/nvd3/src/models/stackedAreaChart.js');
// 		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/nvd3/src/models/stackedArea.js');
//		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/nvd3/nv.d3.min.js');
//		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/nvd3/src/models/historicalBarChart.js');
//		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/nvd3/src/models/historicalBar.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/bootbox/bootbox.min.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/easy-pie-chart/dist/jquery.easypiechart.min.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jquery-cookie/jquery.cookie.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jquery.appear/jquery.appear.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/setupform-validation.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/timepicker-form-elements.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/index.js');		
		// ex css	$this->view->headLink()->appendStylesheet(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/select2/select2.css');
		$this->view->inlineScript()->appendScript(
				'jQuery(document).ready(function() { 
					Main.init();
					//TimePickerFormElements.init();
					//SetupFormValidator.init(); 
					Index.init();
				});',
				'text/javascript',
				array('noescape' => true)); // Disable CDATA comments


	}
	public function getGuestListAction(){
		
			try {
				$reponse = new Reponse();
				$data=array();
				if ($this->getParam("q")) {
					$data =$this->societe->getGuests($this->getParam("q"));
				} 
				if($data) {
					$reponse->message='TXT_GUEST_LIST';
					$reponse->success=true;
					$reponse->data =$data;
					$reponse->debug =$this->getParam("q");
				} else {
					$reponse->message='TXT_NO_GUEST';
					$reponse->success=false;
					$reponse->data =$data;
				}
				$this->render($reponse);
				
			} catch (\Exception $e) {
				// something went wrong: eg. limit exceeded, wrong configuration, ...
				\Logger::err($e);
				echo $e->getMessage();exit;
			}
	}
	public function introductionAction() {
		$this->layout ()->setLayout ( 'introduction_layout' );
		$this->view->societes= new Object\Societe\Listing();
	}
	public function searchAction () {

		$this->layout ()->setLayout ( 'portal' );
		$this->view->q= $this->getParam("q");
		
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/table-guest-list.js');
		
		$this->view->inlineScript()->appendScript(
				'jQuery(document).ready(function() {
					Main.init();
					GuestList.init();
				});',
				'text/javascript',
				array('noescape' => true)); // Disable CDATA comments
	}
	
}

<?php
use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use Website\Tool\Reponse;
use Website\Tool\Request;

class LocationController extends Useraware
{

    public function locationSetupAction() {
        $societe=$this->societe;
        if( $this->person->getPermits() != 1 ){ $this->_forward('error', 'booking',null,array('error'=>'TXT_NO_ACCESS_SCREEN') ); }
        //GET SELECTEDLOCATION
        if( $this->getParam('selectedLocationId') ){
			$locationid=$this->getParam('selectedLocationId');
   		}else{
   			die("you need to specify a location");
   		}
        $mylocation=\Object\Location::getById( $locationid, 1);
        if( $mylocation instanceof \Object\Location ){	
        	//CHEK IF AUTHORISATION
        	if( ! in_array( $mylocation, $societe->getLocations() ) ){ $this->_forward('error', 'booking',null,array('error'=>'TXT_NO_ACCESS_LOCATION') ); }
        	$mylocationarray = $mylocation->toArray();
	       	foreach ($mylocationarray as $key=>$val){
	       		if( $key=="geolocalisation" ){
	       			if($val instanceof \Pimcore\Model\Object\Data\Geopoint){
		       			$this->view->lat=$val->getLatitude();
	       			}else{
	       				$this->view->lat=2;
	       			}
	       		}
	       		if( $key=="geolocalisation" ){
	       			if($val instanceof \Pimcore\Model\Object\Data\Geopoint){
	       				$this->view->long=$val->getLongitude();
	       			}else{
	       				$this->view->long=48;
	       			}
	       		}
	       		$this->view->$key=$val;
	        }
        }else{
        	die("Incorrect location");
        }
        $this->layout ()->setLayout ( 'portal' );
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/locationform-validation.js');
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/timepicker-form-elements.js');
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/autosize/jquery.autosize.min.js');
        
        $this->view->inlineScript()->appendScript(
        		'jQuery(document).ready(function() {
					Main.init();
        			TimePickerFormElements.init();
					LocationFormValidator.init();
        			SVExamples.init();
        			PagesUserProfile.init();
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

	public function view($keyterm ='') {
		$res = new Reponse();
		$res->isTree = false;
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
		$location=Object\Location::getById($this->id, 1);
		if ($location instanceof Object\Location) {
			if( $this->requete->params['latresult'] && $this->requete->params['lngresult'] ){
				$this->requete->params['geolocalisation'] = new \Pimcore\Model\Object\Data\Geopoint( $this->requete->params['lngresult'],  $this->requete->params['latresult'] );
			}
			$location->setValues( $this->requete->params );
			$location->save();
			$res->data = $location->toArray();
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
		$rec=Object\Location::getById($this->id);
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

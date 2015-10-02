<?php
use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;
use Website\Tool\Reponse;
use Website\Tool\Request;

class ServingController extends Useraware
{
	public $id;
	public function getServingData( $serv ){
		$array = get_object_vars( $serv );
		$week=array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
       	foreach( $array as $key => $val ){
       		if( substr($key,0,2) != 'o_' AND substr($key,0,2) != '__' ){
       			$i=0;
				foreach($week as $day){
					$i++;
					$timestart='timestart'.$day;$timeend='timeend'.$day;$maxseats='maxseats'.$day;$maxtables='maxtables'.$day;
					if($key==$timestart){$variable['timestart']=$val;}
					if($key==$timeend){$variable['timeend']=$val;}
					if($key==$maxseats){$variable['maxseats']=$val;}
					if($key==$maxtables){$variable['maxtables']=$val;}
					$variable['id']=$i;
					$variable['locationid']=$serv->getId();
					$variable['day']=$day;
					$$day=$variable;
				}
       		}
       	}
		$servingdata=array($monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);
       	return $servingdata;	
	}
	
    public function servingListAction() {
    	$reponse = new Reponse();
    	$locationid=$this->getParam('locationid');
        $location=\Object\Location::getById( $locationid, 1);
        if( $location instanceof \Object\Location ){
        	$servings=$location->getServings();
			if( $_POST['action'] ){
				//if REMOVE
				if($_POST['action'] =="remove"){
					foreach( $_POST['id'] as $id){
						$serving=\Object\Serving::getById( $id, 1);
						if( $serving instanceof \Object\Serving){
							$serving->delete();
						}
					}
					$reponse->message='TXT_RESERVATION_LIST';
					$reponse->success=true;
					$reponse->data ='';	
				}
				//if EDIT
				if($_POST['action'] =="edit"){
					$serving=\Object\Serving::getById( $_POST['id'], 1 );
					if($serving instanceof \Object\Serving){
						$serving->setTitle($_POST['data']['title']);
						$serving->setMaxSeats($_POST['data']['maxseats']);
						$serving->setMaxTables($_POST['data']['maxtables']);
						$serving->setMealduration($_POST['data']['mealduration']);
						$serving->save();
					}
					$data=$_POST['data'];
					$data['DT_RowId']="row_".$_POST['data']['id'];
					$reponse->message='TXT_SERVING_LIST';
					$reponse->success=true;
					$reponse->row =$data;	
				}
				//if CREATE
				if($_POST['action'] =="create"){
					//SET DEFAULT DATA FROM LOCATION
					$row['maxseats']=$location->getMaxSeats();
					$row['maxseatsmonday']=$location->getMaxSeats();
					$row['maxseatstuesday']=$location->getMaxSeats();
					$row['maxseatswednesday']=$location->getMaxSeats();
					$row['maxseatsthursday']=$location->getMaxSeats();
					$row['maxseatsfriday']=$location->getMaxSeats();
					$row['maxseatssaturday']=$location->getMaxSeats();
					$row['maxseatssunday']=$location->getMaxSeats();
					$row['maxtables']=$location->getMaxTables();
					$row['maxtablesmonday']=$location->getMaxTables();
					$row['maxtablestuesday']=$location->getMaxTables();
					$row['maxtableswednesday']=$location->getMaxTables();
					$row['maxtablesthursday']=$location->getMaxTables();
					$row['maxtablesfriday']=$location->getMaxTables();
					$row['maxtablessaturday']=$location->getMaxTables();
					$row['maxtablessunday']=$location->getMaxTables();
					$row['mealduration']=$location->getMealduration();
					//COLECT DATA FROM DATATABLE EDITOR
					$row['title']=$_POST['data']['title'];
					$result=$location->createServing($row);
					if ($result instanceof \Object\Serving) {
						$row['DT_RowId']=$result->getId();
						$row['id']=$result->getId();
						$reponse->success = true;
						$reponse->message = "TXT_CREATE_OK" ;
						$reponse->row = $row;
						$reponse->debug = $data;
					} else {
						$reponse->success = false;
						$reponse->message = "TXT_CREATE_ERROR"  ;
						$reponse->row = $result;
						$reponse->debug = $result;
					}
				}
			}else{
				$data=array();
				foreach( $servings as $key=>$serving ){
					$i++;
					$array=array();
					$array=$serving->toArray();
					$array['id']=$serving->getId();
					$array['DT_RowId']=$serving->getId();;
			        array_push($data, $array);
				}
				$reponse->message='TXT_SERVING_LIST';
				$reponse->success=true;
				$reponse->data =$data;	
			}
        } else {
			$reponse->message='TXT_SERVING_LIST';
			$reponse->success=false;
			$reponse->data =$data;	        
        }	
        $this->render($reponse);	    
    } 
	
    public function servingSetupAction() {
        $societe=$this->societe;
        if( $this->person->getPermits() != 1 ){ die('You do not have access to this screen'); }
		$this->view->locations= $locations= $societe->getLocations();
		$myserving=\Object\Serving::getById( $this->getParam('servingid',false));
		if( $myserving instanceof Pimcore\Model\Object\Serving ){
			if( ($myserving->getTimestartmonday()=="") && ($myserving->getTimestarttuesday()=="") && ($myserving->getTimestartwednesday()=="") && ($myserving->getTimestartthursday()=="") && ($myserving->getTimestartfriday()=="") && ($myserving->getTimestartsaturday()=="") && ($myserving->getTimestartsunday()=="") ){
				$this->view->noserving="noserving";
			}
			$myservingarray = $myserving->toArray();
			$this->view->myservingarray=$myservingarray;
			foreach( $myservingarray as $key => $val ){
				$this->view->$key=$val;
			}
	        $mylocation=$myserving->getLocation();
	        if( $mylocation instanceof Pimcore\Model\Object\Location ){
	        	$servings=$mylocation->getServings();
	        	$mylocationarray = $mylocation->toArray();
	        	$this->view->mylocationarray=$mylocationarray;
	        	foreach( $mylocationarray as $key => $val ){
					$this->view->$key=$val;
	        	}
	        } else {
	         	$this->view->warning='Incorrect location';
	         	//var_dump($mylocation); exit;
	        }
        } else {
        	$this->view->warning='Incorrect serving';
        	//var_dump($myserving); exit;
        }
        $this->view->serving=$myserving;
        $this->layout ()->setLayout ( 'portal' );
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/timepicker-form-elements.js');
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/servingform-validation.js');
        	
        $this->view->inlineScript()->appendScript(
        		'jQuery(document).ready(function() {
					Main.init();
        			TimePickerFormElements.init();

        			ServingFormValidator.init();

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
	/**
	 * view
	 */
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
		$serving=\Object\Serving::getById($this->id);
		if ($serving instanceof Pimcore\Model\Object\Serving) {
			$serving->setValues( $this->requete->params );
			$serving->save();
			$res->data =  $serving->toArray();
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
		$rec= \Object\Serving::getById($this->id);
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
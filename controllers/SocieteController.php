<?php
use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;
use Website\Tool\Reponse;
use Website\Tool\Request;
 
class SocieteController extends Useraware
{
	public function offersAction() {
		$this->layout ()->setLayout ( 'portal' );	
	}
	public function communicationAction() {
		$this->layout ()->setLayout ( 'portal' );
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/communication.js');
        $this->view->inlineScript()->appendScript(
        		'jQuery(document).ready(function() {
        			FormCommunications.init();
				});',
        		'text/javascript',
        		array('noescape' => true));
	}
    public function setupAction() {
    	$this->layout ()->setLayout ( 'portal' );
        $societe=$this->societe;
        $this->view->societe=$this->societe;
        if( $this->person->getPermits() != 1 ){ die('You do not have access to this screen'); }
        //Check number of locations
        $locations=$this->societe->getLocations();
        $this->view->copyinfo=0;
        if( count( $this->societe->getLocations() ) <= 1 ){
        	if( ($locations[0]->getMaxSeats()=="") && ($locations[0]->getMaxTables()=="") && ($locations[0]->getMaxResaPerUnit()=="") && ($locations[0]->getResaUnit()=="") ){
        	//No information on Location: We propose to copy data from Societe
        		$this->view->copyinfo="1";
        		if( $this->getParam("copydata")=='yes' ){
        			$locations[0]->setName( $this->societe->getName() );
        			$locations[0]->setAddress( $this->societe->getAddress() );
        			$locations[0]->setZip( $this->societe->getZip() );
        			$locations[0]->setCity( $this->societe->getCity() );
        			$locations[0]->setEmail( $this->societe->getEmail() );
        			$locations[0]->setTel( $this->societe->getTel() );
        			$locations[0]->setFax( $this->societe->getFax() );
        			$locations[0]->setGeolocalisation( $this->societe->getLatlngresult() );
        			$locations[0]->setMaxSeats( $this->societe->getMaxSeats() );
        			$locations[0]->setMaxTables( $this->societe->getMaxTables() );
        			$locations[0]->setMaxResaPerUnit( $this->societe->getMaxResaPerUnit() );
        			$locations[0]->setResaUnit( $this->societe->getResaUnit() );
        			$locations[0]->setMealduration( $this->societe->getMealduration() );
        			$locations[0]->save();
        			$this->view->copyinfo="0";
        		}	
        	}
        }
       	$societearray = $societe->toArray();
       	foreach ($societearray as $key=>$val){
       		if( $key=="latlngresult" ){
       			if($val instanceof \Pimcore\Model\Object\Data\Geopoint){
	       			$this->view->lat=$val->getLatitude();
       			}else{
       				$this->view->lat=2;
       			}
       		}
       		if( $key=="latlngresult" ){
       			if($val instanceof \Pimcore\Model\Object\Data\Geopoint){
       				$this->view->long=$val->getLongitude();
       			}else{
       				$this->view->long=48;
       			}
       		}
       		$this->view->$key=$val;
        }
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/societeform_validation.js');
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/form-wizard.js');
        $this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/autosize/jquery.autosize.min.js');
        $this->view->inlineScript()->appendScript(
        		'jQuery(document).ready(function() {
					Main.init();
					SocieteSetupFormValidator.init();
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
	 * create
	 */
	public function create() {
		$res = new Reponse();
		$data=$this->requete->params;
		$rec = $this->societe->createSociete($data);
		if ($rec instanceof \Object\Societe) {
			$res->success = true;
			$res->message = "TXT_CREATE_OK" ;
			$res->data = $rec;
			$res->debug = $data;
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
		$societe=Object\Societe::getById($this->id);
		if ($societe instanceof Object\Societe) {
			if( $this->requete->params['latresult'] && $this->requete->params['lngresult'] ){
				$this->requete->params['latlngresult'] = new \Pimcore\Model\Object\Data\Geopoint( $this->requete->params['lngresult'],  $this->requete->params['latresult'] );
			}
			$societe->setValues( $this->requete->params );
			$societe->save();
			$res->data =  $societe->toArray();
			$res->success = true;
			$res->debug=$this->requete->params;
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
		$rec=Object\Societe::getById($this->id);
		if ($rec ) {
			$rec->delete();
			$res->success = true;
			$res->message = 'Destroyed';
		} else {
			$res->message = "Failed to destroy";
		}
		return $res;
	}
	public function personsListAction(){
		//get societe/location and serving
		$reponse = new Reponse();
        $societe=$this->societe;
		$persons=$societe->getPersons();
       	//we check if we are in the Editor
		if( $_POST['action'] ){
			//if REMOVE
			if($_POST['action'] =="remove"){
				foreach( $_POST['id'] as $id){
					$person=Object_Person::getById( $id, 1);
					if( $person instanceof \Object\Person){
						$person->delete();
					}
				}
				$reponse->message='TXT_RESERVATION_LIST';
				$reponse->success=true;
				$reponse->data ='';	
			}
			//if EDIT
			if($_POST['action'] =="edit"){
				$person=\Object\Person::getById( $_POST['id'] );
				if($person instanceof Object_Person){
					$person->setFirstname($_POST['data']['firstname']);
					$person->setLastname($_POST['data']['lastname']);
					$person->setEmail($_POST['data']['email']);
					$person->setPhone($_POST['data']['phone']);
					$person->setPermits($_POST['data']['permits']);
					$location=Object\Location::getById( $_POST['data']['locationid'], 1 );
					$person->setLocation( $location );
					$person->setPassword(md5($_POST['data']['password']));
					$person->save();
				}
				$data=$_POST['data'];
				$data['DT_RowId']="row_".$_POST['data']['id'];
				$reponse->message='TXT_RESERVATION_LIST';
				$reponse->success=true;
				$reponse->row =$data;	
			}
			//if CREATE
			if($_POST['action'] =="create"){
				$row['firstname']=$_POST['data']['firstname'];
				$row['lastname']=$_POST['data']['lastname'];
				$row['email']=$_POST['data']['email'];
				$row['phone']=$_POST['data']['phone'];
				$row['permits']=$_POST['data']['permits'];
				$location=Object\Location::getById( $row['locationid'], 1 );
				$row['location']=$location;
				$row['password']=md5($_POST['data']['password']);
				$current=Object\Person::getByEmail($row['email'],1);
				if( $current instanceof Object\Person ){
					$error['name']="email";
					$error['status']="Email already exists";
					$reponse->fieldErrors = array($error);				
				}else{
					$result=$societe->createPerson($row);
					if ($result instanceof \Object\Person) {
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
			}
		}else{
			$data=array();
			foreach( $persons as $key=>$person ){
				$i++;
				$array=array();
				$array=$person->toArray();
				$array['id']=$person->getId();
				$array['DT_RowId']=$person->getId();;
		        array_push($data, $array);
			}
			$reponse->message='TXT_RESERVATION_LIST';
			$reponse->success=true;
			$reponse->data =$data;	
		}
        $this->render($reponse);
	}
	public function locationsListAction(){
		//get societe/location and serving
		$reponse = new Reponse();
        $societe=$this->societe;
		$locations=$societe->getLocations();
       	//we check if we are in the Editor
		if( $_POST['action'] ){
			//if REMOVE
			if($_POST['action'] =="remove"){
				foreach( $_POST['id'] as $id){
					$location=\Object_Location::getById( $id, 1);
					if( $location instanceof Object\Location){
						$location->delete();
					}
				}
				$reponse->message='TXT_RESERVATION_LIST';
				$reponse->success=true;
				$reponse->data ='';	
			}
			//if EDIT
			if($_POST['action'] =="edit"){
				$location=\Object\Location::getById( $_POST['id'], 1 );
				if($location instanceof \Object\Location){
					$location->setName($_POST['data']['name']);
					$location->setMaxSeats($_POST['data']['maxSeats']);
					$location->setMaxTables($_POST['data']['maxTables']);
					$location->setResaUnit($_POST['data']['resaUnit']);
					$location->setMaxResaPerUnit($_POST['data']['maxResaPerUnit']);
					$location->save();
				}
				$data=$_POST['data'];
				$data['DT_RowId']="row_".$_POST['data']['id'];
				$reponse->message='TXT_RESERVATION_LIST';
				$reponse->success=true;
				$reponse->row =$data;	
			}
			//if CREATE
			if($_POST['action'] =="create"){
				$societe=$this->societe;
				//SET DEFAULT DATA FROM SOCIETE
				$row['address']=$societe->getAddress();
				$row['zip']=$societe->getZip();
				$row['city']=$societe->getCity();
				$row['email']=$societe->getEmail();
				$row['tel']=$societe->getTel();
				$row['fax']=$societe->getFax();
				$row['email']=$societe->getEmail();
				$row['maxSeats']=$societe->getMaxSeats();
				$row['maxTables']=$societe->getMaxTables();
				$row['maxResaPerUnit']=$societe->getMaxResaPerUnit();
				$row['mealduration']=$societe->getMealduration();
				$row['resaUnit']=$societe->getResaUnit();
				$row['description']=$societe->getDescription();
				//COLECT DATA FROM DATATABLE EDITOR
				$row['name']=$_POST['data']['name'];
				//CREATE THE LOCATION
				$result=$societe->createLocation($row);
				if ($result instanceof \Object\Location) {
					//CREATE NEW SERVING
					$newserving['title']='Nouveau Service';
					$newserving['maxseats']=$societe->getMaxSeats();
					$newserving['maxtables']=$societe->getMaxTables();
					$newserving['mealduration']=$societe->getMealduration();
					$serving=$result->createServing($newserving);
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
			foreach( $locations as $key=>$location ){
				$i++;
				$array=array();
				$array=$location->toArray();
				$servingarray=array();
				foreach( $location->getServings() as $serving ){
					array_push( $servingarray, $serving->getTitle().'----'.$serving->getId() );
				}
				$array['servings']=implode('____', $servingarray);
				$array['id']=$location->getId();
				$array['DT_RowId']=$location->getId();;
		        array_push($data, $array);
			}
			$reponse->message='TXT_RESERVATION_LIST';
			$reponse->success=true;
			$reponse->data =$data;	
		}
        $this->render($reponse);
	}
}

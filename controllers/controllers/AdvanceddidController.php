<?php
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use Website\Tool\Reponse;
use Website\Tool\Request;

class AdvanceddidController extends Action
{
    public function init() {
        parent::init();

        // do something on initialization //-> see Zend Framework

        // in our case we enable the layout engine (Zend_Layout) for all actions
        $this->enableLayout();
        
    }

    public function preDispatch() {
        parent::preDispatch();
        // do something before the action is called //-> see Zend Framework		
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) { 
				// We have a login session (user is logged in)
				$this->view->person = $this->person = $auth->getIdentity();
				$this->view->societe = $this->societe = \Object\Societe::getById($this->person->getSociete()->getId());
				
		}  else {
				$this->forward("form-login", "login");	
		}

    }

    public function postDispatch() {
        parent::postDispatch();

        // do something after the action is called //-> see Zend Framework
    }

    public function indexAction() {
        $list = new Document\Listing();
        $list->setCondition("parentId = ? AND type IN ('link','page')", [$this->document->getId()]);
        $list->load();
        $this->view->documents = $list;
				

    }

    public function contactFormAction() {
        $success = false;
        if($this->getParam("provider")) {
            $adapter = Tool\HybridAuth::authenticate($this->getParam("provider"));
            if($adapter) {
                $user_data = $adapter->getUserProfile();
                if($user_data) {
                    $this->setParam("firstname", $user_data->firstName);
                    $this->setParam("lastname", $user_data->lastName);
                    $this->setParam("email", $user_data->email);
                    $this->setParam("gender", $user_data->gender);
                }
            }
        }

        // getting parameters is very easy ... just call $this->getParam("yorParamKey"); regardless if's POST or GET
        if($this->getParam("firstname") && $this->getParam("lastname") && $this->getParam("email") && $this->getParam("message")) {
            $success = true;

            $mail = new Mail();
            $mail->setIgnoreDebugMode(true);

            // To is used from the email document, but can also be set manually here (same for subject, CC, BCC, ...)
            //$mail->addTo("bernhard.rusch@pimcore.org");

            $emailDocument = $this->document->getProperty("email");
            if(!$emailDocument) {
                $emailDocument = Document::getById(38);
            }

            $mail->setDocument($emailDocument);
            $mail->setParams($this->getAllParams());
            $mail->send();
        }

        // do some validation & assign the parameters to the view
        foreach (["firstname", "lastname", "email", "message", "gender"] as $key) {
            if($this->getParam($key)) {
                $this->view->$key = htmlentities(strip_tags($this->getParam($key)));
            }
        }

        // assign the status to the view
        $this->view->success = $success;
    }

    public function searchAction () {
        if ($this->getParam("q")) {
            try {
                $page = $this->getParam('page');
                if (empty($page)) {
                    $page = 1;
                }
                $perPage = 10;

                $result = \Pimcore\Google\Cse::search($this->getParam("q"), (($page - 1) * $perPage), null, [
                    "cx" => "002859715628130885299:baocppu9mii"
                ], $this->getParam("facet"));

                $paginator = \Zend_Paginator::factory($result);
                $paginator->setCurrentPageNumber($page);
                $paginator->setItemCountPerPage($perPage);
                $this->view->paginator = $paginator;
                $this->view->result = $result;
            } catch (\Exception $e) {
                // something went wrong: eg. limit exceeded, wrong configuration, ...
                \Logger::err($e);
                echo $e->getMessage();exit;
            }
        }
    }

    public function objectFormAction() {

        $success = false;

        // getting parameters is very easy ... just call $this->getParam("yorParamKey"); regardless if's POST or GET
        if($this->getParam("firstname") && $this->getParam("lastname") && $this->getParam("email") && $this->getParam("terms")) {
            $success = true;

            // for this example the class "person" and "inquiry" is used
            // first we create a person, then we create an inquiry object and link them together

            // check for an existing person with this name
            $person = Object\Person::getByEmail($this->getParam("email"),1);

            if(!$person) {
                // if there isn't an existing, ... create one
                $filename = \Pimcore\File::getValidFilename($this->getParam("email"));

                // first we need to create a new object, and fill some system-related information
                $person = new Object\Person();
                $person->setParent(Object::getByPath("/crm/inquiries")); // we store all objects in /crm
                $person->setKey($filename); // the filename of the object
                $person->setPublished(true); // yep, it should be published :)

                // of course this needs some validation here in production...
                $person->setGender($this->getParam("gender"));
                $person->setFirstname($this->getParam("firstname"));
                $person->setLastname($this->getParam("lastname"));
                $person->setEmail($this->getParam("email"));
                $person->setDateRegister(\Zend_Date::now());
                $person->save();
            }

            // now we create the inquiry object and link the person in it
            $inquiryFilename = \Pimcore\File::getValidFilename(Zend_Date::now()->get(Zend_Date::DATETIME_MEDIUM) . "~" . $person->getEmail());
            $inquiry = new Object\Inquiry();
            $inquiry->setParent(Object::getByPath("/inquiries")); // we store all objects in /inquiries
            $inquiry->setKey($inquiryFilename); // the filename of the object
            $inquiry->setPublished(true); // yep, it should be published :)

            // now we fill in the data
            $inquiry->setMessage($this->getParam("message"));
            $inquiry->setPerson($person);
            $inquiry->setDate(\Zend_Date::now());
            $inquiry->setTerms((bool) $this->getParam("terms"));
            $inquiry->save();
        } else if ($this->getRequest()->isPost()) {
            $this->view->error = true;
        }

        // do some validation & assign the parameters to the view
        foreach (["firstname", "lastname", "email", "message", "terms"] as $key) {
            if($this->getParam($key)) {
                $this->view->$key = htmlentities(strip_tags($this->getParam($key)));
            }
        }

        // assign the status to the view
        $this->view->success = $success;
    }

    public function sitemapAction () {

        set_time_limit(900);

        $this->view->initial = false;

        if($this->getParam("doc")) {
            $doc = $this->getParam("doc");
        } else {
            $doc = $this->document->getProperty("mainNavStartNode");
            $this->view->initial = true;
        }

        Pimcore::collectGarbage();

        $this->view->doc = $doc;
		
		
    }

    public function assetThumbnailListAction() {
    
    	// try to get the tag where the parent folder is specified
    	$parentFolder = $this->document->getElement("parentFolder");
    	if($parentFolder) {
    		$parentFolder = $parentFolder->getElement();
    	}
    	if(!$parentFolder) {
    		// default is the home folder
    		$parentFolder = Asset::getById(1);
    	}
    	// get all children of the parent
    	$list = new Asset\Listing();
    	$list->setCondition("path like ?", $parentFolder->getFullpath() . "%");
    	$this->view->list = $list;
    }
    public function ajaxcontentAction() {
	$this->layout()->setLayout('layouts_single_page');
        $this->view->doc = $document;
    }
    public function calendarAction() {
	$this->layout()->setLayout('layouts_single_page');
        $this->view->doc = $document;
    }
    public function servingsetupAction() {
    	$this->layout()->setLayout('did_layout_registration');
    	//$this->disableLayout();
        $this->view->doc = $document;
        $societe=$this->societe;
		$locations=$societe->getLocations();
		$this->view->locations=$locations;
		$initiallocationid=$locations[0]->getId();
		$mylocation=Object_Location::getById( $initiallocationid, 1);
		$servings=$mylocation->getServings();
		$initialservingid=$servings[0]->getId();
        if( $this->getParam('servingid') ){
        	$servingid=$this->getParam('servingid');
        	$myserving=Object_Serving::getById( $servingid, 1);
        	if( $myserving instanceof Object_Serving ){
        		$locationid=$myserving->getLocation()->getId();
        	}
        }else{
        	$servingid=$initialservingid;
        	$locationid=$initiallocationid;
        }
        $this->view->locationid=$locationid;
        $this->view->servingid=$servingid; 
        $mylocation=Object_Location::getById( $locationid, 1);
        if( $mylocation instanceof Object_Location ){
        	$servings=$mylocation->getServings();
        	$this->view->servings=$servings;
        	$initialservingid=$servings[0]->getId();
			$myserving=Object_Serving::getById( $servingid, 1);
	        $this->view->servingid=$myserving->getId();
	        if( $myserving instanceof Object_Serving ){
	        	$myservingarray = $myserving->toArray();
	        	foreach ($myservingarray as $key=>$val){
	        		$this->view->$key=$val;
	        	}
	        }
        }
    }

	public function reservationsArrayAction(){
		//get societe/location and serving
		$reponse = new Reponse();
		$date=new Zend_Date();
		$dateres=$date->get('dd-MM-YYYY');
    	$datestart=new Zend_Date( $dateres.' 00:00:00', 'dd-MM-YYYY HH:mm:ss');
    	$dateend=new Zend_Date( $dateres.' 23:59:59', 'dd-MM-YYYY HH:mm:ss');
    	$start=$datestart->getTimestamp(); 
    	$end=$dateend->getTimestamp();
        $societe=$this->societe;
		$locations=$societe->getLocations();
		$initiallocationid=$locations[0]->getId();
		if( $this->getParam('locationid') ){ $locationid = $this->getParam('locationid'); }else{ $locationid = $initiallocationid; }
		$this->view->locations=$locations;
        $mylocation=Object_Location::getById( $locationid, 1);
        if( $mylocation instanceof Object_Location ){
			$this->view->reservations= $mylocation->getResource()->getReservationsByDate($start,$end);
        } 
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
		$rec = $this->societe->createReservation($data);

		if ($rec instanceof \Object\Reservation) {
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
		$serving=Object\Serving::getById($this->id, 1);
		if ($serving instanceof Object\Serving) {
			$serving->setValues( $this->requete->params );
			$serving->save();
			$res->data = $serving->toArray();
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
		$rec=Object\Serving::getById($this->id);
		if ($rec ) {
			$rec->delete();
			$res->success = true;
			$res->message = 'Destroyed';
		} else {
			$res->message = "Failed to destroy";
		}
		return $res;
	}
    
  	public function initialsetupAction() {
		$this->layout()->setLayout('did_layout_registration');
	    $this->view->doc = $document;
	}
  	public function listreservationAction(){
		$this->layout()->setLayout('listreservation_layout');
	    $this->view->doc = $document;
	    $this->reservationsArrayAction();
  	}

	public function formatReservation( $reservation ){
		if( $reservation->getLocation() instanceof Object_Location ){
			$resa['locationid']=$reservation->getLocation()->getId(); 
			$resa['locationname']=$reservation->getLocation()->getName();
		}else{
			$resa['locationid']=''; $resa['locationname']='';
		}
		if( $reservation->getGuest() instanceof Object_Guest ){
			$resa['guestid']=$reservation->getGuest()->getId(); 
			$resa['guestname']=$reservation->getGuest()->getLastname(); 
			$resa['guestemail']=$reservation->getGuest()->getEmail();
			$resa['guesttel']=$reservation->getGuest()->getTel(); 
		}else{
			$resa['guestid']=''; $resa['guestname']=''; $resa['guestemail']='';$resa['guesttel']='';
		}
		if( $reservation->getPerson() instanceof Object_Person ){
			$resa['personid']=$reservation->getPerson()->getId(); 
			$resa['personfirstname']=$reservation->getPerson()->getFirstname(); 
			$resa['personlastname']=$reservation->getPerson()->getLastname();
		}else{
			$resa['personid']=''; $resa['personfirstname']=''; $resa['personlastname']='';
		}
		if( $reservation->getServing() instanceof Object_Serving ){
			$resa['servingid']=$reservation->getServing()->getId(); 
			$resa['servingtitle']=$reservation->getServing()->getTitle();
		}else{
			$resa['servingid']=''; $resa['servingtitle']='';
		}
 		$resa['datereservation']=$reservation->getDatereservation()->get('dd-MM-YYY'); 
		$resa['start']=$reservation->getStart()->get('HH:mm');
		//DT_RowId identifies the id for the datatable
		$resa['DT_RowId']=$reservation->getId();
		$resa['id']=$reservation->getId(); 
		$resa['status']=$reservation->getStatus(); 
		$resa['partysize']=$reservation->getPartysize(); 
		$resa['bookingref']=$reservation->getBookingref(); 
		$resa['bookingnotes']=$reservation->getBookingnotes();
        return $resa;	
	}

	public function reservationListAction(){
		//get societe/location and serving
		$reponse = new Reponse();
        $societe=$this->societe;
		$locations=$societe->getLocations();
		//if location is not defined we take the first in the list
		$initiallocationid=$locations[0]->getId();
		if( $this->getParam('locationid') ){ $locationid = $this->getParam('locationid'); }else{ $locationid = $initiallocationid; }
		$this->view->locations=$locations;
        $mylocation=Object_Location::getById( $locationid, 1);
        if( $mylocation instanceof Object_Location ){
        	//we check if we are in the Editor
			if( $_POST['action'] ){
				//if REMOVE
				if($_POST['action'] =="remove"){
					foreach( $_POST['id'] as $id){
						$myreservation=Object_Reservation::getById( $id, 1);
						if( $myreservation instanceof Object_Reservation){
							$myreservation->SetStatus('cancelled');
							$myreservation->save();
						}
					}
					$reponse->message='TXT_RESERVATION_LIST';
					$reponse->success=true;
					$reponse->data ='';	
				}
				//if EDIT
				if($_POST['action'] =="edit"){
					$myreservation=Object_Reservation::getById( $_POST['id'], 1 );
					if( $_POST['data']['guestid'] ){
						$guest=Object_Guest::getById( $_POST['data']['guestid'], 1);
						if($guest instanceof Object_Guest){
							$guest->setLastname($_POST['data']['guestname']);
							$guest->setTel($_POST['data']['guesttel']);
							$guest->save();
						}
					}
					//date update needs to be reworked
					//$myreservation->setStart($_POST['data']['start']);
					$myreservation->setPartysize($_POST['data']['partysize']);
					$myreservation->setBookingref($_POST['data']['bookingref']);
					$myreservation->setBookingnotes($_POST['data']['bookingnotes']);
					$myreservation->setStatus($_POST['data']['status']);
					$myreservation->save();
					$data=$_POST['data'];
					$data['DT_RowId']="row_".$_POST['data']['id'];
					$reponse->message='TXT_RESERVATION_LIST';
					$reponse->success=true;
					$reponse->row =$data;	
				}
			}else{
	
	        	$reservations=$mylocation->getReservations();
				$data=array();
				$i=0;
				foreach( $reservations as $key=>$reservation ){
					$i++;
					$resa=$this->formatReservation( $reservation );
			        array_push($data, $resa);
				}
				$reponse->message='TXT_RESERVATION_LIST';
				$reponse->success=true;
				$reponse->data =$data;	
			}
        } else {
        	$data=array();
			$reponse->message='TXT_NOT_RESERVATION_LIST';
			$reponse->success=false;
			$reponse->data =$data;	
        }
        $this->render($reponse);
	}
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
}

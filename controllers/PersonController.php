<?php

use Website\Controller\Useraware;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use Website\Tool\Reponse;
use Website\Tool\Request;
use Website\Tool\UploadHandler;

class PersonController extends Useraware
{
    public function init() {
        parent::init();

        // do something on initialization //-> see Zend Framework

        // in our case we enable the layout engine (Zend_Layout) for all actions
        $this->enableLayout();
    }

    public function preDispatch() {
        parent::preDispatch();

    }

    public function postDispatch() {
        parent::postDispatch();


        // do something after the action is called //-> see Zend Framework
    }
	public function testAction(){
	
				// Send JSON to the client.
		$reponse = new Reponse();
 
		$reponse->data=$this->person->toArray(); //$input_arrays;
		// $this->societe->save();

		$reponse->message="TXT_PERSON_SENT";
		$reponse->success=true;
 
		$this->render($reponse);

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
		if ( !($data['avatar'] instanceof \Asset) and $data['avatar'] )
		$data['avatar'] = $this->convertToAsset($data['avatar']);
			
		$rec = $this->societe->createPerson($data);

		if ($rec instanceof \Object\Person) {
			$res->success = true;
			$res->message = "TXT_CREATE_OK" ;
			$res->data = $rec->toArray();
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
		if ($this->id>0):
			$rec=\Object\Person::getById($this->id);
			$res->data =($rec instanceof Object\Person)? $rec->toArray():"";
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
		$person=Object\Person::getById($this->id);
		if ($person instanceof Object\Person) {
			$data=$this->requete->params;
			$customer=Object\Person::getById( $data['id'], 1);
			if( $customer instanceof Object\Person ){
				if( ( $customer->getAvatar() !='' ) || ( basename( $data['avatar'] ) != basename( $customer->getAvatar() ) ) ){
					if ( !($data['avatar'] instanceof \Asset) and $data['avatar'] )
					$data['avatar'] = $this->convertToAsset($data['avatar']);
				}else{
					$data['avatar'] = $this->convertToAsset($data['avatar']);
					unset($data['avatar']);
				}
			}
			if( $data['password'] =="" ){ $data['password']=$person->getPassword();}
			$person->setValues( $data );
			$person->save();
			$res->data =  $person->toArray();
			$res->success = true;
			$res->message ="TXT_UPDATE_OK";
			$res->debug=$data;
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
		$rec=Object\Person::getById($this->id);
		if ($rec ) {
			$rec->delete();
			$res->success = true;
			$res->message = 'Destroyed';
		} else {
			$res->message = "Failed to destroy";
		}
		return $res;
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
	public function personsAction(){
		$this->layout()->setLayout('layouts_single_page');

		$this->view->locations=$this->societe->getLocations();
		$this->view->employes= $this->societe->getPersons();
	}
	public function profilAction(){
		$this->layout()->setLayout('portal');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/userprofile-validation.js');
		$this->view->inlineScript ()->appendScript ( 'jQuery(document).ready(function() {
					Main.init();
        			SVExamples.init();
        			UserProfileValidation.init();
				});', 'text/javascript', array (
								'noescape' => true
		) );
		$this->view->locations=$this->societe->getLocations();
		$this->view->employes= $this->societe->getPersons();
	}
	public function personListAction(){
		$reponse = new Reponse();
		$data=array();
		$employes= $this->societe->getPersons();
		if($employes):
		foreach($employes as $e):
		$data[]=$e->toArray();
		endforeach;
		endif;
		$reponse->message='TXT_PERSONS_UPDATED';
		$reponse->success=true;
		$reponse->data =$data;
		$this->render($reponse);
	}
	public function setPositionAction(){
		$reponse = new Reponse();
		$personId=$this->getParam("personId");
		$positionId=$this->getParam("positionId");
		$value=$this->getParam("value",0);
		$person=\Object\Person::getById($personId);
		if($person instanceof \Object\Person and $positionId>0) :
		$person->setPosition($positionId,$value);
		$person->save();
		$reponse->data = $person->getPositions();
		endif;

		$reponse->message='TXT_PERSON_UPDATED';
		$reponse->success=true;

		$this->render($reponse);
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

		$list = new Object\Person\Listing();

		if($this->id) : $list->setCondition("o_id = " . $list->quote($this->id));
		elseif  ($this->societe) : return $this->view->persons=$this->societe->getPersons();
		endif;
//		pagination
		$list=  $this->_getList($list);
		return $this->view->persons= $list->getObjects();
	}

	public function _getList($liste_avant_pagination)
	{
		$list = $liste_avant_pagination ;
			
		$sort=json_decode ($this->getParam('sort'),true);
		if($sort){
			$list->setOrderKey($sort['property']);
			$list->setOrder($sort['direction']);
		} else {
			$list->setOrderKey(array('lastname', 'o_id'));
			$list->setOrder(array('ASC', 'DESC'));
		}
		$start = $this->getParam('start', 0);
		$perPage = $this->getParam('limit', 10);
		$limit= $start  + $perPage;
		$currentpage= $this->getParam('page', 1);
		$list->setOffset($start);
		$list->setLimit($limit);
		return $list;
	}

	/**
	 * @param Object_Medecine_List $list
	 * @param integer $page
	 * @param integer $perPage
	 * @return Zend_Paginator
	 */
	public function _paginate(Object\Person\Listing
	$list)
	{

		$start = $this->getParam('start', 0);
		$perPage = $this->getParam('limit', 10);
		$currentpage= $this->getParam('page', 1);

		$paginator = new \Zend_Paginator($list);
		$paginator->setItemCountPerPage((int) $perPage);
		$paginator->setCurrentPageNumber((int) $page);
		$paginator->setPageRange((int) 10);
		return $paginator;
	}
	/**
	 * @param string base64
	 * @return Asset
	 */	
	public function convertToAsset($imgstr){
	
		$uploadDir = PIMCORE_TMP_DIRECTORY.'/asset-temporary/';
		$content =  base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgstr));
		$name= uniqid() . '.png';
		$file = $uploadDir . $name;
		$success = file_put_contents($file, $content);
		if($success){
			$parentAsset = Asset_Folder::getById(71);
			$asset = Asset::create($parentAsset->getId(), array(
					"filename" => $name,
					"data" => file_get_contents($file)
			));
			return $asset;
		} else {
			return false;
		}
	}

}

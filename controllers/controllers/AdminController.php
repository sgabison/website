<?php

use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use Website\Tool\Reponse;
use Website\Tool\Request;

class AdminController extends  Action {

    public function preDispatch() {
    	parent::preDispatch ();
    	// do something before the action is called //-> see Zend Framework
    	\Pimcore\Tool\Authentication::authenticateSession() ;
    	$adminSession = new \Zend_Session_Namespace ( "pimcore_admin" );
    
    	if ( ! $adminSession->user instanceof \User ) {
    		
    		//	$this->forward ( "form-login", "login" );
    		 
    	} 
    }

	public function defaultAction() {

		$this->layout ()->setLayout ( 'admin' );
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/ckeditor/ckeditor.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/plugins/ckeditor/adapters/jquery.js');
		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS.'/assets/js/form-societe-creation.js');
		$this->view->inlineScript()->appendScript(
				'jQuery(document).ready(function() {
					Main.init();
					FormSocieteCreation.init();
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
		$soc = new \Object\Societe;
		$rec =$soc->updateData($data);
		if ($rec instanceof \Object\Societe) {
			$rec->createLocation($data);
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
	/*
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
		$Societe=Object\Societe::getById($this->id, 1);
		if ($Societe instanceof Object\Societe) {
			if( $this->requete->params['closingDateStart'] ){ $this->requete->params['closingDateStart']=new Zend_Date($this->requete->params['closingDateStart'], "dd-MM-yyyy");}
			if( $this->requete->params['closingDateEnd'] ){ $this->requete->params['closingDateEnd']=new Zend_Date($this->requete->params['closingDateEnd'], "dd-MM-yyyy");}
			$Societe->setValues( $this->requete->params );
			$Societe->save();
			$res->data = $Societe->toArray();
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
	
	public function checkReferenceAction(){
		$reponse = new Reponse();
		if($this->getRequest()->isGet() or $this->getRequest()->isPost()){
			$ref = $this->getParam('reference');
			$societe = Object\Societe::getByReference($ref,1);
			if ($societe instanceof Object\Societe ) {
				$reponse->message='TXT_SOCIETE_EXIST';
				$reponse->success=true;

			}else {
				$reponse->message='TXT_SOCIETE_UNKNOWN';
				$reponse->success=false;
			}
		} else {
			$reponse->message='TXT_SOCIETE_NOTRECEIVED';
			$reponse->success=false;
		}
		$this->render($reponse,'success');
	}
}

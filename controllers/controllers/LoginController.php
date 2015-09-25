<?php

use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use Website\Tool\Reponse;

class LoginController extends  Action {

    public function postDispatch() {
        $this->enableLayout();
		$this->layout()->setLayout('login');
 
 		$this->view->headScript()->appendFile(PIMCORE_WEBSITE_LAYOUTS."/assets/js/login.js");
 		$this->view->inlineScript ()->appendScript ( '
					Main.init();
					Login.init();
					var php_message = "'.$this->view->error.'";
					if (php_message.length) toastr.warning( php_message );
					'
		);
		 
    }

	public function defaultAction() {
		
	}
	public function servicesAction() {
				$reponse = new Reponse();
				$member = Object\Person::getByEmail($email,1);
				if ($member instanceof Object\Person ) {
					$reponse->data= $member;
				}
				$reponse->message='LOGIN_EMAIL_EXIST';
				$reponse->success=true;
				$this->render($reponse);
	}
	public function formLoginAction(){
 
		$this->view->email=$this->getParam("email",null);
		$this->view->password=$this->getParam("password",null);
		$this->view->error=$this->getParam("error",null);
	}
	public function loginAction(){
		$email=$this->getParam("email",null);
		$password=$this->getParam("password",null);
//		$this->flash->addMessage('We did something in the last request');
//		var_dump($email , $password); exit;
		if (!$email and $password) {
			$error = "TXT_EMAIL_NOT_PRESENT";
			$this->forward("form-login", "login", null, array("email" => $email, "error" => $error));
		} elseif ($email and !$password) {
			$error = "TXT_PASSWORD_NOT_PRESENT";
			$this->forward("form-login", "login", null, array("email" => $email, "error" => $error));

		} elseif (!$email and !$password) {
			$error = "";
			$this->forward("form-login", "login");

		} else {
			$result=$this->authenticate($email,$password);
			if ($result->isValid()) {
				// Login successful	
 				 $this->redirect("/booking");
 			} else {
				// Login failed
				$error ="TXT_LOGIN_FAILED";
				$this->forward("form-login", "login", null, array("email" => $email, "error" => $error));
			}
		}	

	}
	public function authenticate($email,$password){
		// Setup auth adapter
		$authAdapter = new Website\Auth\ObjectAdapter('\Object\Person', 'email', 'password');
		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
		// Authenticate
		$authAdapter->setIdentity($email)->setCredential($password);
		
		return $auth->authenticate($authAdapter);
		
	}
	public function emailAction() {
		$this->disableLayout();
	}
    public function registerAction() {
		$array=array();
        if($this->getRequest()->isPost() or $this->getRequest()->isGet()) {
           $field=array( 'firstname','lastname','gender','address','email','password', 'city','phone' );
		   foreach ($field as $f) {
					$array[$f] = $this->getParam($f);
		   }
		   $societe =\Object\Societe::getByReference($this->getParam('reference'),1);
		   if( ! ($societe instanceof \Object\Societe)) {
                throw new \Exception("TXT_REFERENCE_NOT_VALID");
            } else {
            	
            	$person = Object\Person::getByEmail($email,1);
            	if(count($person) > 0) {
              	  throw new \Exception('TXT_EMAIL_EXIST_ALREADY');
          		 }
           		 	$societe->createPerson($array);
          		 }
			
 //         $person =  Object\Person::create($array);
 //         $person->setKey(\Pimcore\File::getValidFilename($person->getEmail()));
 //         $person->setPublished(true);
 //         $person->setParent(Object\Folder::getByPath("/"));
 //         $person->save();

            $this->forward("login", "login", null, array("email" => $email, "password" => $password));
        }
    }

    public function logoutAction() {
        $auth = \Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->redirect("/login");
    }
    public function mynewpassAction(){
		$email = $this->getParam('email');
		$person = \Object\Person::getByEmail($email,1);
		if ($person instanceof \Object\Person ) {
			$realpass = $person->getPassword();
			$userpass = $this->getParam('password');
 
			if ( $userpass == $realpass ) {
				$newPassword= $this->getParam('newpassword');
				if ($newPassword) {
					$person->setPassword($newPassword);
					$person->save();
				}
				$this->view->person=$this->person=$person;   						
				$this->forward("login", "login", null, array("email" => $email, "password" => $newPassword, "error"=>'TXT_PASSWORD_CHANGED_MESSAGE' ));
			} else {
				$this->forward("form-login", "login", null, array("email" => $email, "password" => $userpass, "error"=>'TXT_PASSWORD_INCORRECT' ));
			}
		} else {
			$this->forward("form-login", "login",null, array("email" => $email,  "error"=>'TXT_EMAIL_UNKNOWN' ));
		}
 
    }
	public function getpassforgottenAction(){
		$reponse = new Reponse();
		if($this->getRequest()->isGet() or $this->getRequest()->isPost()){
			$email = $this->getParam('email');
			$member = Object\Person::getByEmail($email,1);
			if ($member instanceof Object\Person ) {
				$this->disableLayout();
				$password = $member->getPassword();
				$doc_change_pass="/data/login/form-login";
				$url="http://".$_SERVER['SERVER_NAME'].$doc_change_pass."?box=remind&email=".$email."&password=".urlencode($password);
				// sending the email
				$parameters = array('url' => $url, 'id'=>$member->getId() , 'name'=> $member->getFirstname()." ".$member->getLastname(), 'email'=>$email, 'password'=>$password);
				$mail = new Pimcore\Mail ();
				$mail->setParams($parameters);
				$mail->setDocument('/email/login_forgotten');
				$mail->AddTo( $email);
				$mail->Send();
				$reponse->data=$parameters;
				$reponse->message='TXT_SENT_PASSWORD_MESSAGE';
				$reponse->success=true;

			}else {
				$reponse->message='TXT_EMAIL_INCORRECT';
				$reponse->success=false;
			}
		} else {
			$reponse->message='TXT_EMAIL_NOTRECEIVED';
			$reponse->success=false;
		}
		// $this->render($reponse);
		$this->forward("form-login", "login", null, array("email" => $email, "password" => $password, "error"=>$reponse->message));

	}
	public function checkEmailAction(){
		$reponse = new Reponse();
		if($this->getRequest()->isGet() or $this->getRequest()->isPost()){
			$email = $this->getParam('email');
			$member = Object\Person::getByEmail($email,1);
			if ($member instanceof Object\Person ) {
				$reponse->message='TXT_EMAIL_EXIST';
				$reponse->success=true;

			}else {
				$reponse->message='TXT_EMAIL_UNKNOWN';
				$reponse->success=false;
			}
		} else {
			$reponse->message='TXT_EMAIL_NOTRECEIVED';
			$reponse->success=false;
		}
		$this->render($reponse,'success');
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

<?php

namespace Website\Controller;

use Website\Controller\Action;

class Useraware extends Action {

	public $societe, $person, $user, $selectedLocation;
    public function init () {
        parent::init();
        
        
    }
    public function preDispatch() {
    	parent::preDispatch ();
    	// do something before the action is called //-> see Zend Framework
    	\Pimcore\Tool\Authentication::authenticateSession() ;
    	$adminSession = new \Zend_Session_Namespace ( "pimcore_admin" );
    
    	if ( ! $adminSession->user instanceof \User ) {
    		$auth = \Zend_Auth::getInstance ();
    		if ($auth->hasIdentity ()) {
    			// We have a login session (user is logged in)			
	    			$cached_person = $auth->getIdentity ();
	    			$id= $cached_person->getId();
	    			$this->view->person = $this->person = \Object\Person::getById($id) ;
    		} else {
    			$this->forward ( "form-login", "login" );
    		}
    	} else {    		
    		$this->view->person = $this->person = \Object\Person::getById(248) ;   		
    	}
    	if($this->person)  {
    		
    		$this->view->user = $this->user = $this->person;
    		$this->view->societe = $this->societe = $this->person->getSociete ();
    		$this->view->locations = $this->locations = $this->societe->getLocations();
    		$this->storeLocation();
    	}
    }
    private function storeLocation() {
    	
    	if ($this->mySessionSite->selectedLocation)
    		\Zend_Registry::set ( "selectedLocation", $this->mySessionSite->selectedLocation );
    	 
    	if ($this->_getParam ( "selectedLocationId" )) {
    		$location = \Object\Location::getById($this->_getParam ( "selectedLocationId" ));
    		\Zend_Registry::set("selectedLocation", $location);
    		$this->mySessionSite->selectedLocation=$location;
    	}
    	 
    	if(\Zend_Registry::isRegistered("selectedLocation")) {
    		$location = \Zend_Registry::get("selectedLocation");
    	} else {
    		$location = $this->societe->getDefaultLocation();
    		\Zend_Registry::set("selectedLocation", $location);
    	}
		if( $this->person->getPermits() == 2 ){
			$this->view->selectedLocation = $this->selectedLocation = $this->person->getLocation();
		}else{
			if( $location->getSociete()->getName() == $this->person->getSociete()->getName() ){
    			$this->view->selectedLocation = $this->selectedLocation =$location;
			}else{
				$locations=$this->person->getSociete()->getLocations();
				$this->view->selectedLocation = $this->selectedLocation =$locations[0];
			}
		}
    }
    
}

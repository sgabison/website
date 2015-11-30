<?php

namespace Website\Controller;

use Pimcore\Controller\Action\Frontend;

class Action extends Frontend {

    public function init () {

        parent::init();
        $this->createWebsiteSession ( "SITE" );
        $this->storeLanguage();
     
    }
    private function createWebsiteSession($name) {
    	$mySessionSite = new \Zend_Session_Namespace ( $name );
    	$this->mySessionSite = $mySessionSite;
    	$this->view->mySessionSite = $mySessionSite;  
    }
    private function storeLanguage() {
    	if ($this->mySessionSite->Locale)
    		\Zend_Registry::set ( "Zend_Locale", $this->mySessionSite->Locale );
    	
    	if ($this->_getParam ( "lg" )) {
    		$locale = new \Zend_Locale($this->_getParam ( "lg" ));
    		\Zend_Registry::set("Zend_Locale", $locale);
     	}
    	
    	if(\Zend_Registry::isRegistered("Zend_Locale") and $this->mySessionSite->Locale ) {  //init forcée à french à reprendre
    		$locale = \Zend_Registry::get("Zend_Locale");
    	} else {
    		$locale = new \Zend_Locale("fr_FR");
    		\Zend_Registry::set("Zend_Locale", $locale);
    	}

    	$this->mySessionSite->Locale=$locale;   	 
    	$this->view->language = $this->language = $locale->getLanguage();
    	
        $languages = \Pimcore\Tool::getValidLanguages();
    	$languageOptions = array();
    	foreach ($languages as $short ) {
 
    		if(!empty($short)) {
    			$languageOptions[] = array(
    					"language" => $short,
    					"display" => \Zend_Locale::getTranslation(($short=="fr_FR")?"fr":$short, 'Language', $locale)
    			);
    			$validLanguages[] = $short;
    		}
    	}
    	
    	$this->view->languageOptions= $languageOptions;
    	$this->view->isAjax = $this->isAjax();
    }

    // function to destroy the session-namespace
    public function destroyWebsiteSession() {
    	$this->mySessionSite->unsetAll (); // destroys the namespace
    }
    public function isAjax(){
    	$this->isAjax= !empty($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']);
    	return $this->isAjax;
       }
	public function render( $response,$field=null ){
		$this->disableLayout();
		$this->disableViewAutoRender();		
		try{
			if($field):
				$this->getResponse()
				->setHeader('Content-Type', 'text/javascript')
				->appendBody( \Zend_Json::encode( $response->$field ) );
			elseif( $response->format =='xml' or $this->getParam('XML') ):
				$this->getResponse()
				->setHeader('Content-Type', 'text/xml')
				->appendBody( $response->to_xml() );
			elseif ( $response->format =='html' ):
				$this->getResponse()
				->setHeader('Content-Type', 'text/html')
				->appendBody( $response->to_html() );
			else:
				$response->callback = $_REQUEST['callback'];
				$this->getResponse()
				->setHeader('Content-Type', 'text/javascript')
				->appendBody( $response->to_jsonP() );
			endif;
		} catch ( Exception $e ){}
	}
}

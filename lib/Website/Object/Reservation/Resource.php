<?php

namespace Website\Object\Reservation;

class Resource extends \Object\Concrete\Resource {
	public $folderRoot;
	/**
	 *
	 * @see Object_Abstract_Resource::init
	 */
	public function getClassName() {
		return $this->model->getClassName ();
	}
	public function init() {
		parent::init ();
	}

    public function getFolderRoot() {
		$societe = ($this->model->getLocation ()) ? $this->model->getLocation ()->getSociete () : "";
    	$parent=($societe)? $societe->getParent():\Object\Folder::getById ( 1 );
    	$name=strtolower($this->model->getClassName());
    	return  $this->folderRoot = $this->createFolder($name, $parent);
    }

	public function getFolderLocation() {
		$parent = $this->getFolderRoot();
		$name = ($this->model->getLocation ()) ? $this->model->getLocation ()->getName () : "Location";
	    	return  $this->createFolder($name, $parent);
    }
    
    public function getFolderDay(){
    	$parent= $this->getFolderLocation();
    	$name =($this->model->getDatereservation())? $this->model->getDatereservation()->toString("YYYY-MM-dd"):"date";
    	return  $this->createFolder($name, $parent);
    }
    
    protected function createFolder($name, $parent){
    	$parentId= $parent->getId();
    	$fdata ["o_key"] = $this->correctClassname($name);
    	$data = $this->db->fetchRow ( sprintf("SELECT o.* FROM objects o WHERE o.o_key ='%s' and o.o_type='folder' and o.o_parentId=%s",$fdata ['o_key'] ,$parentId ) );
    	if ($data ["o_id"]) {
    		$folder = \Object\Folder::getById ( $data ["o_id"] );
    		return $folder;
    	} else {
    		$fdata ["o_parentId"] = $parentId;
    		$folder = \Object\Folder::create ( $fdata );
    		return $folder;
    	}   	
    }

    public static function correctClassname($name) {
    	$tmpFilename = strtolower($name);
    	$validChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_.";
    	$filenameParts = array ();
    	for($i = 0; $i < strlen ( $tmpFilename ); $i ++) {
    		if (strpos ( $validChars, $tmpFilename [$i] ) !== false) {
    			$filenameParts [] = $tmpFilename [$i];
    		}
    	}
    	return implode ( "", $filenameParts );
    }

    public  function replace($data=array()) {
    	try {
    		if ($this->model->getId () > 0) {
    			$object = $this->model;
    		} elseif ($data ['id'] > 0 and $data ['id'] != "") {
    			$object = \Object\Reservation::getById ( $data ['id'] );
    		} elseif ($data ['o_id'] > 0 and $data ['o_id'] != "") {
    			$object = \Object\Reservation::getById ( $data ['o_id'] );
    		} else {
    			$object = $this->model;
    			$date = new \Zend_Date ();
    			$object->setCreationDate ( $date->get () );
    			$object->setUserOwner ( 1 );
    			$object->setUserModification ( 1 );
    			if (method_exists ( $object, "setDateregister" )) $object->setDateregister( $date->get () );
    			$object->setPublished ( 1 );
    		}
    			
    		if ($object instanceof \Object\Reservation) {
    			$object->setValues ( $data );
    			$date = new \Zend_Date ();
    			$object->setModificationDate ( $date );
    			if (! $object->getO_key ()) {
    				$folder = $this->getFolderDay ( );
    				$object->setParent ( $folder );
    				$key1 =  $this->model->getClassName ();   				
    				$numero = $date->get(\Zend_Date::TIMESTAMP);
    				$object_key = $this->correctClassname ( $key1 ) . '-' . $numero ;
    				$object->setO_key ( strtolower ( $object_key ) );
    			}
    
    			return $object;
    		} else {
    			\Logger::warning ( "Erreur :  Classe de l'objet erronnée" ) ;
    			return false;
    		}
    	} catch ( \Exception $e ) {
    			
    		\Logger::warning ( $e->getMessage () );
    		return false;
    
    	}
    } 
}
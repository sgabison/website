<?php 

namespace Website\Object\Tags;

class Resource extends \Object\Concrete\Resource {

    protected function getFolderRoot() {
    	$parent=   ($this->model->getSociete())? $this->model->getSociete()->getParent():\Object\Folder::getById(1);
    	$name=strtolower($this->model->getClassName());
    	return  $this->folderRoot = $this->createFolder($name, $parent);
    }
    
    protected function getFolderAlpha(){
    	$parent=$this->getFolderRoot();
    	$name= strtolower( substr(ucfirst($this->model->getCode()),0,1) ) ;
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
    			$object = \Object\Tags::getById ( $data ['id'] );
    		} elseif ($data ['o_id'] > 0 and $data ['o_id'] != "") {
    			$object = \Object\Tags::getById ( $data ['o_id'] );
    		} else {
    			$object = $this->model;
    			$date = new \Zend_Date ();
    			$object->setCreationDate ( $date->get () );
    			//todo
    			$object->setUserOwner ( 1 );
    			$object->setUserModification ( 1 );
    			if (method_exists ( $object, "setDateRegister" )) $object->setDateRegister( $date->get () );

    			$object->setPublished ( 1 );
    		}			
    		if ($object instanceof \Object\Tags) {
    			$object->setValues ( $data );
    			$object->setTag( $data['name_fr'], 'fr_FR' );
    			$object->setTag( $data['name_en'], 'en' );
    			$date = new \Zend_Date ();
    			$object->setModificationDate ( $date );
    			if (! $object->getO_key ()) {
    				$folder = $this->getFolderRoot ( );
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
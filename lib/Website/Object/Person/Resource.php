<?php 

namespace Website\Object\Person;

class Resource extends \Object\Concrete\Resource {


    /**
     * @see Object_Abstract_Resource::init
     */
    public  function getClassName(){
    	return $this->model->getClassName() ;
    }
    public  function getDefaultImage(){
    	$defaultImage = \Asset::getById(73);
    	return $defaultImage;
    }
	public function init() {  
        parent::init();
     }
     
    public function checkPosition($id=null){
		$rep=false;
		if($this->model->getId() >0 ):
		 $sql = sprintf("SELECT * FROM `object_relations_4` where src_id='%d' and dest_id='%d' and fieldname='positions'  limit 0,1",$this->model->getId(),$id);
		 $data =$this->db->FetchRow($sql);
		 if ($data) $rep=true;
		endif;
    	return $data;
    }
	public function setPosition($positionId,$value=1){
			if($positionId>0 and $this->model->getId()>0):
				if($value>0):
				$sql = sprintf(" replace INTO  object_relations_4 
					(`src_id`, `dest_id`, `type`, `fieldname`, `index`, `ownertype`, `ownername`, `position`) 
					select '%d','%d', 'object', 'positions', 1, 'object', '', ''  				
					" ,$this->model->getId(), $positionId );
				$this->db->query ( $sql); 
				else:
				$sql = sprintf(" 
					delete from  object_relations_4 
					where `src_id`='%d' and  `dest_id`='%d' and `fieldname`='positions'
					" ,$this->model->getId(), $positionId );
				$this->db->query ( $sql); 
				endif;
			endif;
			return $this->model;
	}

    public  function replace($data=array()) {
		try {
			if ($this->model->getId () > 0) {
				$object = $this->model;
			} elseif ($data ['id'] > 0 and $data ['id'] != "") {
				$object = \Object\Person::getById ( $data ['id'] );
			} elseif ($data ['o_id'] > 0 and $data ['o_id'] != "") {
				$object = \Object\Person::getById ( $data ['o_id'] );
			} else {
				$object = $this->model;
				$date = new \Zend_Date ();
				$object->setCreationDate ( $date->get () );
				//todo
				$object->setUserOwner ( 1 );
				$object->setUserModification ( 1 );
				if (method_exists ( $object, "setAvatar" ))
					echo $object->getAvatar (); exit;
					$object->setAvatar ( $this->getDefaultImage () );
				$object->setPublished ( 1 );
			}
			
			if ($object instanceof \Object\Person) {
				$object->setValues ( $data );
				$date = new \Zend_Date ();
				$object->setModificationDate ( $date );
				if (! $object->getO_key ()) {
					$folder = $this->getFolderRoot ( );
					$object->setParent ( $folder );
						
					if (! method_exists ( $object, getEmail )) {
						$key1 = $this->model->getClassName ();
					} else {
						$key1 = ($object->getEmail ()) ? $object->getEmail () : $this->model->getClassName ();
					}
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

    public function getFolderRoot() {
		$societe = ($this->model->getSociete ()) ? $this->model->getSociete () : "";
    	$parent=($societe)? $societe->getParent():\Object\Folder::getById ( 1 );
    	$name=strtolower($this->model->getClassName());
    	return  $this->folderRoot = $this->createFolder($name, $parent);
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
    
}
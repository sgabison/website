<?php 

namespace Website\Object\Position;

class Resource extends \Object\Concrete\Resource {

	public $folderRoot;
    /**
     * @see Object_Abstract_Resource::init
     */
    public  function getClassName(){
    	return $this->model->getClassName() ;
    }
    public  function getDefaultImage(){
    	$defaultImage = Asset::getById(49);
    	return $defaultImage;
    }
	public function init() {  
        parent::init();
     }
     
    public function getPersons(){
		$result=array();
		if($this->model->getId() >0 ):
		$sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_4` r join object_query_4 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'positions' " , $this->model->getId());
		$data =$this->db->FetchAll($sql);
		endif;
		foreach ($data as $key=>$row){
			$loc = \Object\Person::getById( $row["src_id"] );
			if (  $loc instanceof \Object\Person )	$result[]= $loc ;
		}
    	return $result;
    }



    public function setFolderRoot() {
    	$data = $this->db->fetchRow ( "SELECT o.* FROM objects o WHERE (o.o_key ='" .strtolower($this->model->getClassName()) . "' ) and o.o_type='folder' and o.o_parentId=1 order by o_id desc" );
    	if ($data ["o_id"]) {
    		$folder = Object_Folder::getById ( $data ["o_id"] );
    	} else {
    		$fdata ["o_parentId"] = 1;
    		$fdata ["o_key"] = strtolower($this->model->getClassName());
    		$folder = Object_Folder::create ( $fdata );
    	}
    	return 	$this->folderRoot = $folder;
    }
    
    public function getFolderRoot() {
    	if(!$this->folderRoot): $this->setFolderRoot(); endif;
    	return $this->folderRoot;
    }
    
    public function getFolderWithName($name){
    	$fdata ["o_key"] =  $this->correctClassname($name);
    	$folderAlpha = $this->getFolderAlpha($name);
    	$data = $this->db->fetchRow ( sprintf("SELECT o.* FROM objects o WHERE o.o_key ='%s' and o.o_type='folder' and o.o_parentId=%s",$fdata ['o_key'] , $folderAlpha->getId()) );
    	if ($data ["o_id"]) {
    		$folder = Object_Folder::getById ( $data ["o_id"] );
    		return $folder;
    	} else {
    		$fdata ["o_parentId"] = $folderAlpha->getId();
    		$folder = Object_Folder::create ( $fdata );
    		return $folder;
    	}
    }
    
    public function getFolderAlpha($name){

    	$fdata ["o_key"] = strtolower( substr($name,0,1) ) ;
    	$root=$this->getFolderRoot();
    	$data = $this->db->fetchRow ( sprintf("SELECT o.* FROM objects o WHERE o.o_key ='%s' and o.o_type='folder' and o.o_parentId=%s",array($fdata ['o_key'] , $root->getId()) ) );
    	if ($data ["o_id"]) {
    		$folder = Object_Folder::getById ( $data ["o_id"] );
    		return $folder;
    	} else {
    		$fdata ["o_parentId"] = $root->getId();
    		$folder = Object_Folder::create ( $fdata );
    		return $folder;
    	}
    }
    
    public static function correctClassname($name) {
    	$tmpFilename = $name;
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
<?php 

namespace Website\Object\Societe;

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

	public function getLocations(){
		$result=array();
		if($this->model->getId() >0 ):
		$sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_9` r join object_query_9 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'societe' " , $this->model->getId());
		$data =$this->db->FetchAll($sql);
		endif;
		foreach ($data as $key=>$row){
			$loc = \Object\Location::getById( $row["src_id"] );
			if (  $loc instanceof \Object\Location )	$result[]= $loc ;
		}
		return $result;
	}
	public function getDefaultLocation(){
		$loc=false;
		if($this->model->getId() >0 ):
		$sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_9` r join object_query_9 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'societe' " , $this->model->getId());
		$row =$this->db->FetchRow($sql);
		$loc = \Object\Location::getById( $row["src_id"] );
		endif;
			
		return $loc;
	}
	public function getPersons(){
		$result=array();
		try{
			if($this->model->getId() >0 ):
			$sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_4` r join object_query_4 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'societe' " , $this->model->getId());
			$data =$this->db->FetchAll($sql);
			endif;
 
			foreach ($data as $key=>$row){

				$loc =  \Object\Person::getById( $row["src_id"] );
				
				if (  $loc instanceof \Object\Person )	$result[]= $loc ;
			}
		} catch ( \Exception $e ) {
			// something went wrong: eg. limit exceeded, wrong configuration, ...
			\Logger::err ( $e );
			echo $e->getMessage ();
		}
	 
		return $result;
	}

	public function getGuests($q=null ){
		$result=array();
		if($this->model->getId() >0 ):
		$searchCondition="";
		if( $q):
		$qlike= "%". $q ."%";
		$searchCondition=  " and ( o.lastname like '{$qlike}' or o.tel like '{$qlike}' or o.email like '{$qlike}') ";
		endif;
		$sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_12` r join object_query_12 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'societe' " , $this->model->getId()).$searchCondition ;
		$data =$this->db->FetchAll($sql);

		endif;
		foreach ($data as $key=>$row){
			$g = \Object\Guest::getById( $row["src_id"] );
			if (  $g instanceof \Object\Guest )	$result[]= $g ;
		}
		return $result;
	}
	public  function setNameSpace() {
		if ($this->model->getId()) {
			$object=$this->model;
		}
		if ($object ) {
			if ( $object->getO_key ()) {
				if (! method_exists ( $object, getName )) {
					$key1 = $this->model->getClassName();
					$folder = $this->getFolderRoot();
					$object->setParentId ( $folder->getId ());
				} else {
					$key1 = ($object->getName ()) ? $object->getName () : $this->model->getClassName();
					$folder = $this->getFolderWithName (strtolower ($key1 ));
					$object->setParentId ( $folder->getId ());
				}
				$numero= $object->getId ();
				$object_key = $this->correctClassname ( $key1 ) . '-' . $numero;
				$object->setO_key ( strtolower ( $object_key ) );
			}
			return $object;
		} else {
			return false ;
		}
	}

	public function getFolderWithName(){
		$parent=$this->getFolderAlpha();
		$name=$this->model->getName();
		return  $this->createFolder($name, $parent);
	}
	protected function getFolderRoot() {
		$parent=\Object\Folder::getById ( 1 );
		$name=strtolower($this->model->getClassName());
		return  $this->folderRoot = $this->createFolder($name, $parent);
	}
	protected function getFolderAlpha(){
		$parentId=$this->getFolderRoot()->getId();
		$name= strtolower( substr($this->model->getName(),0,1) ) ;
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
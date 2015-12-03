<?php 

namespace Website\Object\Location;

class Resource extends \Object\Concrete\Resource {


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

	/*
	 * retourne un tableau format mysql a convertir (timestamp)
	 * $start et $end sont zend_date
	 */
	public function getRapportReservations (  $start= null, $end = null ){
		if(!$start) $start= \Zend_Date::now();
		if(!$end) $end=$start;
		$locationId = $this->model->getId ();
		$result=array("location_id"=>$locationId);
		if($locationId >0 ):
		$sql = sprintf(" SELECT count(o.oo_id) as nbre, sum(o.partysize) as couverts,
				min(o.start) as date_start, max(o.end) as date_end,  YEAR(FROM_UNIXTIME(o.start)) as y,  MONTH(FROM_UNIXTIME(o.start)) as m,  DAY(FROM_UNIXTIME(o.start)) as d,
				o.location__id as location_id, o.serving__id as serving_id, s.title as serving_name
				FROM object_query_11 o join object_query_13 s on s.oo_id = o.serving__id 
				WHERE  o.`start`>= '%d' AND o.`start`<= '%d' AND o.`location__id` = '%d' and (lower(o.status) <>'cancelled' or o.status is null) "
					,  $start->getTimestamp(), $end->getTimestamp(), $locationId);
		$sql .= "group by   YEAR(FROM_UNIXTIME(o.start)),  MONTH(FROM_UNIXTIME(o.start)),  DAY(FROM_UNIXTIME(o.start)),  o.location__id, o.serving__id
				 order by o.location__id,   YEAR(FROM_UNIXTIME(o.start)),  MONTH(FROM_UNIXTIME(o.start)),  DAY(FROM_UNIXTIME(o.start)), o.serving__id,  s.title " ;
	//	var_dump($sql); exit;
		$result =$this->db->FetchAll($sql);
		endif;
		return $result;
	}
        
    public function getReservations(){
		$result=array();
		if($this->model->getId() >0 ):
		$sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_11` r join object_query_11 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'location' " , $this->model->getId());
		$data =$this->db->FetchAll($sql);
		endif;
		foreach ($data as $key=>$row){
			$resa = \Object\Reservation::getById( $row["src_id"] );
			if (  $resa instanceof \Object\Reservation )	$result[]= $resa ;
		}
    	return $result;
    }
    public function getReservationsByDate( $start, $end ){
		$result=array();
		if($this->model->getId() >0 ):
		$sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_11` r join object_query_11 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND o.`start`>= '%d' AND o.`start`<= '%d' AND r.`fieldname` = 'location' " , $this->model->getId(), $start, $end);
		$data =$this->db->FetchAll($sql);
		endif;
		foreach ($data as $key=>$row){
			$loc = \Object\Reservation::getById( $row["src_id"] );
			if (  $loc instanceof \Object\Reservation )	$result[]= $loc ;
		}
    	return $result;
    } 
    public function getReservationsByDateForTables( $start, $end ){
        $result=array();
        if($this->model->getId() >0 ):
        $sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_11` r join object_query_11 o on o.oo_id=r.src_id WHERE ( r.`dest_id` = '%d' AND r.`fieldname` = 'location' AND o.`start`>= '%d' AND o.`start`<= '%d' ) OR ( r.`dest_id` = '%d' AND r.`fieldname` = 'location' AND  o.`end`>= '%d' AND o.`end`<= '%d' ) " , $this->model->getId(), $start, $end, $this->model->getId(), $start, $end);
        $data =$this->db->FetchAll($sql);
        endif;
        foreach ($data as $key=>$row){
            $loc = \Object\Reservation::getById( $row["src_id"] );
            if (  $loc instanceof \Object\Reservation ) $result[]= $loc ;
        }
        return $result;
    }   
    public function getServings(){
		$result=array();
		if($this->model->getId() >0 ):
		$sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_13` r join object_query_13 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'location' ORDER BY o.`title`" , $this->model->getId());
		$data =$this->db->FetchAll($sql);
		endif;
		foreach ($data as $key=>$row){
			$loc = \Object\Serving::getById( $row["src_id"] );
			if (  $loc instanceof \Object\Serving )	$result[]= $loc ;
		}
    	return $result;
    }

   public function getTables(){
        $result=array();
        if($this->model->getId() >0 ):
        $sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_20` r join object_query_20 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'location' ORDER BY o.`salle`" , $this->model->getId());
        $data =$this->db->FetchAll($sql);
        endif;
        foreach ($data as $key=>$row){
            $loc = \Object\Table::getById( $row["src_id"] );
            if (  $loc instanceof \Object\Table ) $result[]= $loc ;
        }
        return $result;
    }

   public function checkTable($roomid,$tablenr){
        if($this->model->getId() >0 ):
        $sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_20` r join object_query_20 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'location' AND o.`salle`= '%s' AND o.`table`='%d'" , $this->model->getId(), $roomid, $tablenr);
        $data =$this->db->FetchAll($sql);
        endif;
        if($data){return true;}else{return false;}
    }

   public function getTable($roomid,$tablenr){
        if($this->model->getId() >0 ):
        $sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_20` r join object_query_20 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'location' AND o.`salle`= '%s' AND o.`table`='%d'" , $this->model->getId(), $roomid, $tablenr);
        $data =$this->db->FetchAll($sql);
        endif;
        foreach ($data as $key=>$row){
            $loc = \Object\Table::getById( $row["src_id"] );
            if (  $loc instanceof \Object\Table ) $result= $loc ;
        }
        return $result;
    }

    public function getShifts($from=null , $to=null){
    	$result=array();
    	$condition="";
    	if($from) $condition .= " AND o.start >= '".$from->toString(\Zend_Date::TIMESTAMP)."' ";
    	if($to) $condition .= " AND o.end <= '".$from->toString(\Zend_Date::TIMESTAMP)."' ";
    	if($this->model->getId() >0 ):
    	$sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_7` r join object_query_7 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'location' " , $this->model->getId());
    	$data =$this->db->FetchAll($sql.$condtion);
    	endif;
    	foreach ($data as $key=>$row){
    		$loc = \Object\Shift::getById( $row["src_id"] );
    		if (  $loc instanceof \Object\Shift )	$result[]= $loc ;
    	}
    	return $result;
    }

	public function getPositions(){
		$result=array();
		if($this->model->getId() >0 ):
		$sql = sprintf(" SELECT distinct r.src_id FROM `object_relations_10` r join object_query_10 o on o.oo_id=r.src_id WHERE r.`dest_id` = '%d' AND r.`fieldname` = 'location' " , $this->model->getId());
		$data =$this->db->FetchAll($sql);
		endif;
		foreach ($data as $key=>$row){
			$loc = \Object\Position::getById( $row["src_id"] );
			if (  $loc instanceof \Object\Position )	$result[]= $loc ;
		}
    	return $result;
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

    public  function replace($data=array()) {
    	try {
    		if ($this->model->getId () > 0) {
    			$object = $this->model;
    		} elseif ($data ['id'] > 0 and $data ['id'] != "") {
    			$object = \Object\Location::getById ( $data ['id'] );
    		} elseif ($data ['o_id'] > 0 and $data ['o_id'] != "") {
    			$object = \Object\Location::getById ( $data ['o_id'] );
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
    		if ($object instanceof \Object\Location) {
    			$object->setValues ( $data );
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
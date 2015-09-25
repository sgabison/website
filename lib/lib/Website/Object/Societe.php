<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Societe extends \Object\Concrete {

	// Tests whether the given ISO8601 string has a time-of-day or not

	// Constructs an Event object from the given array of key=>values.
	// You can optionally force the timezone of the parsed dates.
	
	public function getLocations(){
		return (array) $this->getResource()->getLocations();
	}
	public function getDefaultLocation(){
		return  $this->getResource()->getDefaultLocation();
	}
	public function getPersons(){
		return (array) $this->getResource()->getPersons();
	}
	public function getGuests($q=null){
		return (array) $this->getResource()->getGuests($q);
	}
/*
	public function getGuestsbytel($q=null,$tel){
		return (array) $this->getResource()->getGuests($q);
	}
*/
	public function getPositionsByLoc($id=null){
		$result=array();
		$locs=$this->getLocations();
		if($locs):
		foreach ($locs as $l):
			$result[$l->getId()]=$l->getPositions();
		endforeach;
		endif;
		if($id>0) :
		return $result[$id];
		else:
    	return $result;
		endif;
    }
	public function toArray() {
$fields=array('id','name','description','address','zip','city','tel','email','fax','maxSeats','maxTables','resaUnit','maxResaPerUnit','maxResaSeats','mealduration','latlngresult');
		Foreach($fields as $field){
			$getter= 'get'.ucfirst($field);
			$array[$field]=$this->$getter();
		}
		return $array;
	}
	public function setNameSpace(){
		return (array) $this->getResource()->setNameSpace();
	}
			/* return object or false*/
	public function createPerson($data=array()){
		$object = new \Object\Person(); 		
 		$object->setSociete($this);
		return $object->updateData($data);
	}
	public function createGuest($data=array()){
		$object = new \Object\Guest(); 		
 		$object->setSociete($this);
		return $object->updateData($data);
	}
	public function createLocation($data=array()){
		$object = new \Object\Location(); 		
 		$object->setSociete($this);
		return $object->updateData($data);
	}
	public function createTag($data=array()){
		$object = new \Object\Tags(); 		
 		$object->setSociete($this);
		return $object->updateData($data);
	}
}


// Date Utilities
//----------------------------------------------------------------------------------------------





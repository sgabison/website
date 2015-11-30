<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Location extends \Object\Concrete {

	// Tests whether the given ISO8601 string has a time-of-day or not

	// Constructs an Event object from the given array of key=>values.
	// You can optionally force the timezone of the parsed dates.
	
	public function getTables(){
		return (array) $this->getResource()->getTables();
	}
	public function getAvailableTables(){
		return (array) $this->getResource()->getAvailableTables();
	}
	public function getServings(){
		return (array) $this->getResource()->getServings();
	}
	public function getShifts($from=null,$to=null){
		return (array) $this->getResource()->getShifts($from,$to);
	}
	public function getPositions(){
		return (array) $this->getResource()->getPositions();
	}
	public function toArray() {
		$fields=array('id', 'name', 'address', 'zip', 'city', 'email', 'tel', 'fax', 'description', 'nrOfRooms', 'maxSeats', 'maxTables', 'maxResaPerUnit', 'resaUnit', 'closingDateStart', 'closingDateEnd', 'mealduration', 'geolocalisation', 'url');
		Foreach($fields as $field){
			$getter= 'get'.ucfirst($field);
			$array[$field]=$this->$getter();
		}
		return $array;
	}
	public function getRapportReservations ( $start, $end ){
		$result=array();
		$result=$this->getResource()->getRapportReservations( $start, $end );
		
		return $result;
	}
	public function createServing($data=array()){
		$object = new \Object\Serving(); 		
 		$object->setLocation($this);
		return $object->updateData($data);
	}
	public function createTable($data=array()){
		$object = new \Object\Table(); 		
 		$object->setLocation($this);
		return $object->updateData($data);
	}
	public function createShift($data=array()){
		$object = new \Object\Shift();
		$object->setLocation($this);
		return $object->updateData($data);
	}
	public function updateData($data=array()){
 		Try {		
		if ($data)	$object=$this->getResource()->replace($data);
		if($object instanceof \Object\Location):
			$object->save();
			return $object;
		else:
			return false;
		endif;

		} catch ( Exception $e){
			Logger::error($e->getMessage());
			Logger::error($e);
			return false;
		}
	}
}
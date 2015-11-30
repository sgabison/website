<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Table extends \Object\Concrete {

	// Tests whether the given ISO8601 string has a time-of-day or not

	// Constructs an Event object from the given array of key=>values.
	// You can optionally force the timezone of the parsed dates.
	
	// Converts this Event object back to a plain data array, to be used for generating JSON
	public function toArray() {
		$array = $this->properties;
		$array['id'] = $this->getTable();
		$fields=array('salle', 'table', 'seats', 'description');
		Foreach($fields as $field){
			$array[$field]=$this->$field;
		}
		return $array;
	}

	public function updateData($data=array()){
 		Try {		
		if ($data)	$object=$this->getResource()->replace($data);
		if($object instanceof \Object\Table):
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

<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Tags extends \Object\Concrete {

	public $name;
	public $properties = array(); // an array of other misc properties
	// Converts this Event object back to a plain data array, to be used for generating JSON
	public function toArray() {
		$fields=array('id','code','icon');
		Foreach($fields as $field){
			$getter= 'get'.ucfirst($field);
			$array[$field]=$this->$getter();
		}
		$array['name_fr']=$this->getTag('fr_FR');
		$array['name_en']=$this->getTag('en');
		return $array;
	}
	public function updateData($data=array()){
 		Try {		
		if ($data)	$object=$this->getResource()->replace($data);
		if($object instanceof \Object\Tags):
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
	public function createTag($data=array()){
		$object = new \Object\Tags(); 		
 		$object->setSociete($this);
		return $object->updateData($data);
	}
}
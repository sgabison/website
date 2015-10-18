<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Person extends \Object\Concrete {

	public $name;
	public $properties = array(); // an array of other misc properties


	public function getFullName(){
		return  $this->getFirstname().' '.$this->getLastname();
	}
	public function getName(){
		return  $this->getFirstname().' '.$this->getLastname();
	}
	public function checkPosition($id=null){
		return  $this->getResource()->checkPosition($id);
	}
	public function setPosition($positionId,$value=1){
		return $this->getResource()->setPosition($positionId,$value);
	}
	// Converts this Event object back to a plain data array, to be used for generating JSON
	public function toArray() {
		$fields = array (
				"id",
				"gender",
				"firstname",
				"lastname",
				"email",
				"newsletterActive",
				"newsletterConfirmed",
			//	"dateRegister",
			//	"positions",
				"password",
				"rating",
				"location",
				"phone",
				"address",
				"city",
				"accesslocations",
				"permits" 
		);
// 		$fieldDefinitions = $this->geto_class ()->getFieldDefinitions ();
// 		foreach ( $fieldDefinitions as $key => $field ) {
// 			$fields [] = $key;
// 		}
		Foreach($fields as $field){
			$getter= 'get'.ucfirst($field);
			$array[$field]=$this->$getter();
		}
		$array['avatar']=(method_exists($this->getAvatar() ,getFullpath))? $this->getAvatar()->getFullpath() :'';
		$array['societe']=(method_exists($this->getSociete() ,getName))? $this->getSociete()->getName() :'';
		$array['locationid']=( $array['location'] )? $array['location']->getId() :'';
		$array['locationname']=( $array['location'] )? $array['location']->getName() :'';
		$array['dateRegister']=(method_exists($this->getDateRegister(),toString))?$this->getDateRegister()->toString("YYYY-MM-DD"):"";
		return $array;
	}
	public function fromRequest($array){
		// transfore donnees Js en Pimcore
		if(isset($array['dateRegister'])) $array['dateRegister']=parseDateTime($array['dateRegister']);
		return $array();
	}

	public function updateData($data=array()){
 		Try {		
		if ($data)	$object=$this->getResource()->replace($data);
		if($object instanceof \Object\Person):
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
	function parseDateTime($string) {
		$date = new \Zend_Date (
				$string,
				'YYYY-mm-dd'
		);
		return $date;
	}
			
}


// Date Utilities
//----------------------------------------------------------------------------------------------





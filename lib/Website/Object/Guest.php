<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Guest extends \Object\Concrete {

	public $name;
	public $properties = array(); // an array of other misc properties
	// Converts this Event object back to a plain data array, to be used for generating JSON
	public function getFullName(){
		return  ucfirst($this->getFirstname()).' '.ucfirst($this->getLastname());
	}
	public function getName(){
		return  $this->getFullName();
	}
	public function toArray() {
		$fields=array('id','lastname','email','tel','bookingnotes','countrycode','preferredlanguage','newsletterConfirmed', 'newsLetter' );
		Foreach($fields as $field){
			$getter= 'get'.ucfirst($field);
			$array[$field]=$this->$getter();
		}
		$array['avatar']=(method_exists($this->getAvatar() ,getFullpath))? $this->getAvatar()->getFullpath() :'';
		return $array;
	}
	public function toSpecialArray() {
		$fields=array('id','lastname','email','tel','bookingnotes','countrycode');
		Foreach($fields as $field){
			$getter= 'get'.ucfirst($field);
			$array[$field]=$this->$getter();
		}
		$array['full']=$this->getTel().' - '.$this->getLastname();
		$array['complete']=$this->getTel().'----'.$this->getLastname().'----'.$this->getEmail().'----'.$this->getBookingnotes().'----'.$this->getPreferredlanguage().'----'.$this->getNewsletterConfirmed();
		return $array;
	}

	public function updateData($data=array()){
 		Try {		
		if ($data)	$object=$this->getResource()->replace($data);
		if($object instanceof \Object\Guest):
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


// Date Utilities
//----------------------------------------------------------------------------------------------

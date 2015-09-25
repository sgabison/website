<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Serving extends \Object\Concrete {

	// Tests whether the given ISO8601 string has a time-of-day or not

	// Constructs an Event object from the given array of key=>values.
	// You can optionally force the timezone of the parsed dates.
	


	// Converts this Event object back to a plain data array, to be used for generating JSON
	public function toArray() {
		$array = $this->properties;
		$array['id'] = $this->getId();
		$fields=array('title', 'mealduration', 'servingstart', 'servingend', 'maxseats', 'maxtables', 'closedmonday', 'timestartmonday', 'timeendmonday', 'maxseatsmonday', 'maxtablesmonday', 'closedtuesday', 'timestarttuesday', 'timeendtuesday', 'maxseatstuesday', 'maxtablestuesday', 'closedwednesday', 'timestartwednesday', 'timeendwednesday', 'maxseatswednesday', 'maxtableswednesday', 'closedthursday', 'timestartthursday', 'timeendthursday', 'maxseatsthursday', 'maxtablesthursday', 'closedfriday', 'timestartfriday', 'timeendfriday', 'maxseatsfriday', 'maxtablesfriday', 'closedsaturday', 'timestartsaturday', 'timeendsaturday', 'maxseatssaturday', 'maxtablessaturday', 'closedsunday', 'timestartsunday', 'timeendsunday', 'maxseatssunday', 'maxtablessunday');
		Foreach($fields as $field){
			$array[$field]=$this->$field;
		}
		return $array;
	}

	public function updateData($data=array()){
 		Try {		
		if ($data)	$object=$this->getResource()->replace($data);
		if($object instanceof \Object\Serving):
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

	public function getServingData(){
		$array = $this->properties;
		$servingdata=array();
		$week=array('-6'=>'monday', '-7'=>'tuesday', '-9'=>'wednesday', '-8'=>'thursday', '-6'=>'friday', '-8'=>'saturday', '-6'=>'sunday');
       	foreach( $array as $key => $val ){
       		if( substr($key,0,2) != 'o_' AND substr($key,0,2) != '__' ){
       			foreach( $week as $number=>$day){
					if( substr( $key, $number ) == $day ){
						$dayarray[$key]=$val;
						$dayarray['id']=$day;
						array_push($servingdata, $dayarray);
					}
       			}
       		}
       	}
       	return $servingdata;	
	}

	public function formatData( $data ){
		$date = \Zend_Date::now();
        $timestart=new \Zend_Date($data['calendar'].' '.$data['slotinput'].':00', 'dd-MM-YYYY HH:mm:ss');
        //$timestart = \Zend_Date::now();
        $location=\Object\Location::getById($data['locationid'], 1);
        if ( $location instanceof \Object\Location ){
			$societe=$location->getSociete();
			$serving = \Object\Serving::getById($data['servinginput'], 1);
			if ( $serving instanceof \Object\Serving ){
				$mealduration=$serving->getMealduration();
			}
			$end=$timestart->getTimestamp()+($mealduration*60);
			$timeend=new \Zend_Date( $end );
	        $guest=\Object\Guest::getByEmail($data['email'], 1);
	        if ( ! $guest instanceof \Object\Guest ){ 
	        	$guest = new \Object\Guest();
	        	$guest->updateData( array('tel'=>$data['tel'], 'email'=>$data['email'], 'lastname'=>$data['lastname'], 'societe'=>$societe, 'dateregister'=>$date , 'location'=>$location ) );
	        }
        }
        $result=array();
        $result['id']=$data['id'];
        $result['method']=$data['method'];
        $result['tel']=$data['tel'];
        $result['email']=$data['email'];
        $result['lastname']=$data['lastname'];
        $result['partysize']=$data['partysize'];
        $result['person']=$data['person'];
        $result['societe']=$societe;
        $result['location']=$location;
        $result['guest']=$guest;
        $result['serving']=$serving;
        $result['start']=$timestart;
        $result['datereservation']=$timestart;
        $result['end']=$timeend;
        return $result;
	}
}
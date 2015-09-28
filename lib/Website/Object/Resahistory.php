<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Resahistory extends \Object\Concrete {
	
	public function toArray() {
		$array = $this->properties;
		$array['id'] = $this->getId();
		$fields=array('action', 'reservation', 'person', 'communication', 'partysize', 'start');
		Foreach($fields as $field){
			$array[$field]=$this->$field;
		}
		return $array;
	}

	public function updateData($data=array()){
 		Try {		
		if ($data)	$object=$this->getResource()->replace($data);
		if($object instanceof \Object\Resahistory):
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
	public function formatData($action, $reservation, $person, $communication, $partysize, $start){
		if( $start ){
			$chosenday=$reservation->getStart()->get('dd-MM-YYYY');
			$start=self::parseDateTime( $chosenday.' '.$data['start'], 'dd-MM-YYYY HH:mm' );
		}
        $result=array();
        $result['reservation']=$reservation;
        $result['person']=$person;
        $result['action']=$action;
        $result['communication']=$communication;
        $result['partysize']=$partysize;
        $result['start']=$start;
        var_dump( $result ); exit;
        return $result;
	}

}
<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Stats extends \Object\Concrete {

	
	public $properties = array(); // an array of other misc properties
	// Converts this Event object back to a plain data array, to be used for generating JSON

	public function getStatistics( $locationid ){
		return (array) $this->getResource()->getStatistics( $locationid );
	}
}
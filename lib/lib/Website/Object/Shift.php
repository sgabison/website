<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Shift extends \Object\Concrete {

	// Tests whether the given ISO8601 string has a time-of-day or not
	const ALL_DAY_REGEX = "#^\d{4}-\d\d-\d\d$#"; // matches strings like "2013-12-29"

	public $format;
	public $properties = array(); // an array of other misc properties


	// Constructs an Event object from the given array of key=>values.
	// You can optionally force the timezone of the parsed dates.
	public function __construct($array=array(), $timezone=null) {
		// Record misc properties
		foreach ($array as $name => $value) {
			if (!in_array($name, array('title', 'allDay', 'start', 'end','css','category','content'))) {
				$this->properties[$name] = $value;
			}
		}
	}
	public function updateData($data=array()){
		Try {
			if ($data)	$object=$this->getResource()->replace($data);
			if($object instanceof \Object\Shift):
			 $object->save();
			// var_dump($object); exit;
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

	// Returns whether the date range of our event intersects with the given all-day range.
	// $rangeStart and $rangeEnd are assumed to be dates in zend_date with 00:00:00 time.
	public function isWithinDayRange($rangeStart, $rangeEnd) {

		// Normalize our event's dates for comparison with the all-day range.
		$eventStart = $this->getStart() ;
		$eventEnd = ($this->getEnd()) ? $this->getEnd() : null;

		if (!$eventEnd) {
			// No end time? Only check if the start is within range.
			return ($eventStart->compare($rangeEnd)==-1) && ($eventStart->compare($rangeStart)>=0) ;
		}
		else {
			// Check if the two ranges intersect.
			return ($eventStart->compare($rangeEnd)==-1)  && ($eventEnd->compare($rangeStart)>=0);
		}
	}
	public function getFormat($string=null){
		// Figure out the date format. This essentially encodes allDay into the date string.
		if ($string and preg_match("#^\d{4}-\d\d-\d\d$#", $string, $matches)) :
			if(! $matches[1]) :
			$format = 'YYYY-mm-dd'; // output like "2013-12-29"
			else :
			$format  = \Zend_Date::ISO_8601; // full ISO8601 output, like "2013-12-29T09:00:00+08:00"
			endif;
		else : $format  = \Zend_Date::ISO_8601; 
		endif;
		return $format ;
	}
	public function format_to_pim($data=array()){
		
		foreach ($data as $name => $value) {
			if (in_array($name, array('start', 'end'))) {
				$dataFormatted[$name] =self::parseDateTime($value);
			} else if ($name == 'className' ) {
				$dataFormatted["css"] = $value ; //className mot clé dans fullCalendar et dans Pimcore avec un sens different
			} else $dataFormatted[$name] = $value;
		}
		return $dataFormatted; 
	}
	// Converts this Event object back to a plain data array, to be used for generating JSON
	public function toArray() {
		return $this->toCalendar();
	}
		// Converts this Event object back to a plain data array, to be used for generating JSON
	public function toCalendar() {

		// Start with the misc properties (don't worry, PHP won't affect the original array)
		$array = $this->properties;
		$array['id'] = $this->getId();
		$array['title'] = $this->getTitle();
		$array['allDay'] = $this->getAllDay();
		$array['className'] = $this->getCss();
		$array['category'] = $this->getCategory();
		$array['content'] = $this->getContent();
		
		$format=$this->getFormat();

		// Serialize dates into strings
		if ($this->getStart())
			$array['start'] = $this->getStart()->toString($format);
		if ($this->getEnd()) 
			$array['end'] = $this->getEnd()->toString($format);
		

		$array['person']= ($this->person)? $this->person->getFirstName().' '.$this->person->getLastName():""; //Firstname();
	
		$fields=array('location');
		Foreach($fields as $field){
			$array[$field]=($this->$field)? $this->$field->getName():"";
		}
		return $array;
	}
	// Parses a string into a DateTime object, optionally forced into the given timezone.
	function parseDateTime($string, $day =null, $timezone=null) {
		$date = new \Zend_Date (  
			$string,
			self::getFormat($string)
		);
		if ($timezone) {
			// If our timezone was ignored above, force it.
			$date->setTimezone($timezone);
		}
		return $date;
	}
	
	public function getPersonData(){
		return (array) $this->getResource()->getPersonData();
	}


}


// Date Utilities
//----------------------------------------------------------------------------------------------





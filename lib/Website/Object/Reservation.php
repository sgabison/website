<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
namespace Website\Object;

class Reservation extends \Object\Concrete {

	public $name;
	public $properties = array(); // an array of other misc properties
	public function toArray() {
		$fields=array('id', 'bookingref', 'bookingnotes', 'status', 'partysize', 'actualpartysize', 'datereservation', 'actualstart', 'start', 'end', 'arrived', 'custname' );
		Foreach($fields as $field){
			$getter= 'get'.ucfirst($field);
			$array[$field]=$this->$getter();
		}
		$array['servingid']=($this->getServing())?$this->getServing()->getId():"";
		$array['servingtitle']=($this->getServing())?$this->getServing()->getTitle():"";
		$array['locationid']=($this->getLocation())?$this->getLocation()->getId():"";
		$array['locationname']=($this->getLocation())?$this->getLocation()->getName():"";
		$array['personid']=($this->getPerson())?$this->getPerson()->getId():"";
		$array['personfirstname']=($this->getPerson())?$this->getPerson()->getFirstname():"";
		$array['personlastname']=($this->getPerson())?$this->getPerson()->getLastname():"";
		$array['firstlastname']=($this->getGuest())?$this->getGuest()->getLastname():"";
		$array['tel']=($this->getGuest())?$this->getGuest()->getTel():"";
		$array['email']=($this->getGuest())?$this->getGuest()->getEmail():"";
		$array['preferredlanguage']=($this->getGuest())?$this->getGuest()->getPreferredlanguage():"";
		$array['newsLetter']=($this->getGuest())?$this->getGuest()->getNewsLetter():"";
		return $array;
	}

	public function updateData($data=array()){
 		Try {		
		if ($data)	$object=$this->getResource()->replace($data);
		if($object instanceof \Object\Reservation):
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
	public function timeslotToMinutes($selectedtimeslot){
		sscanf($selectedtimeslot, "%d:%d", $hours, $minutes);
		$result= $hours * 3600 + $minutes * 60;
		return $result;
	}	
	public function parseDateTime($string, $format) {
	  $date = new \Zend_Date ( $string, $format);
	  return $date;
	 }
	public function formatData( $data ){
		$data['tel']=preg_replace("/[^0-9]/","",$data['tel']);
		if( $data['datereservation'] ){
			$datereservation=self::parseDateTime( $data['datereservation'], 'dd-MM-YYYY' );
			$start=self::parseDateTime( $data['reservationdate'].' '.$data['start'], 'dd-MM-YYYY HH:mm' );
			if( $data['arrived'] == 1 ){
				$actualstart=self::parseDateTime( $data['reservationdate'].' '.$data['start'], 'dd-MM-YYYY HH:mm' );
			}
		}else{
			$chosenresa=Object\Reservation::getById( $data['id'], 1 );
			$chosenday=$chosenresa->getStart()->get('dd-MM-YYYY');
			$start=self::parseDateTime( $chosenday.' '.$data['start'], 'dd-MM-YYYY HH:mm' );
			if( $data['arrived'] == 1 ){
				$actualstart=self::parseDateTime( $data['reservationdate'].' '.$data['start'], 'dd-MM-YYYY HH:mm' );
			}
		}
		if( $data['arrived']== 1 ){
			$data['actualpartysize']=$data['partysize'];
			$data['actualstart']=$data['start'];
		}
        $location=\Object\Location::getById($data['locationid'], 1);
        if ( $location instanceof \Object\Location ){
			$societe=$location->getSociete();
			$serving = \Object\Serving::getById($data['servinginput'], 1);
			if ( $serving instanceof \Object\Serving ){
				$mealduration=$serving->getMealduration();
			}
			$end=new \Zend_date( $start->getTimeStamp()+($mealduration*60) );
			if( $data['tel'] ){
		        $guest=\Object\Guest::getByTel($data['tel'], 1);
		        if ( ! $guest instanceof \Object\Guest ){ 
		        	$guest = new \Object\Guest();
		        	$guest->updateData( array('tel'=>$data['tel'], 'email'=>$data['email'], 'lastname'=>$data['lastname'], 'societe'=>$societe, 'dateregister'=>$date, 'location'=>$location, 'bookingnotes'=>$data['bookingnotes'], 'countrycode'=>$data['countrycode'], 'preferredlanguage'=>$data['preferredlanguage'], 'newsLetter'=>$data['newsLetter'] ) );
		        } else {
		        	$guest->setPreferredlanguage( $data['preferredlanguage'] );
		        	$guest->setNewsLetter( $data['newsLetter'] );
		        	$guest->setLastname( $data['lastname'] );
		        	$guest->setBookingnotes( $data['bookingnotes'] );
		        	$guest->setEmail( $data['email'] );
		        	$guest->save();
		        }
			}elseif( $data['email'] ){
		        $guest=\Object\Guest::getByTel($data['email'], 1);
		        if ( ! $guest instanceof \Object\Guest ){ 
		        	$guest = new \Object\Guest();
		        	$guest->updateData( array('tel'=>$data['tel'], 'email'=>$data['email'], 'lastname'=>$data['lastname'], 'societe'=>$societe, 'dateregister'=>$date, 'location'=>$location, 'bookingnotes'=>$data['bookingnotes'], 'countrycode'=>$data['countrycode'], 'preferredlanguage'=>$data['preferredlanguage'], 'newsLetter'=>$data['newsLetter'] ) );
		        } else {
		        	$guest->setPreferredlanguage( $data['preferredlanguage'] );
		        	$guest->setNewsLetter( $data['newsLetter'] );
		        	$guest->setLastname( $data['lastname'] );
		        	$guest->setBookingnotes( $data['bookingnotes'] );
		        	$guest->setTel( $data['tel'] );
		        	$guest->save();	
		        }		
			}
        }
        $result=array();
        $result['id']=$data['id'];
        $result['method']=$data['method'];
        $result['tel']=$data['tel'];
        $result['countrycode']=$data['countrycode'];
        $result['email']=$data['email'];
        $result['lastname']=$data['lastname'];
        $result['custname']=$data['custname'];
        $result['actualpartysize']=$data['actualpartysize'];
        $result['partysize']=$data['partysize'];
        $result['status']=$data['status'];
        $result['arrived']=$data['arrived'];
        $result['person']=$data['person'];
        $result['societe']=$societe;
        $result['location']=$location;
        $result['guest']=$guest;
        $result['serving']=$serving;
        $result['actualstart']=$actualstart;
        $result['start']=$start;
        $result['datereservation']=$datereservation;
        $result['end']=$end;
        $result['bookingref']=$data['bookingref'];
        $result['bookingnotes']=$data['bookingnotes'];
        $result['newsLetter']=$data['newsLetter'];
        return $result;
	}

}


// Date Utilities
//----------------------------------------------------------------------------------------------


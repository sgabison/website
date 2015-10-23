<?php
//Christmas
public function createArray( $start, $end, $title ){
	$array=array();
	$array["id"]="statutory"; 
	$array["title"]=$title;
	$array["allDay"]= true;
	$array["className"]="generic";
	$array["category"]="generic";
	$array["content"]="";
	$array["bookable"]=NULL;
	$array["start"]=$start;
	$array["end"]=$end;
	$array["person"]="";
	return $array;
}
public function toStartDate($date){
	return new Zend_Date( $date.'T02:00:00', 'YYYY-MM-DDTHH:mm:ss' );
}
public function toEndDate($date){
	$varend=new Zend_Date( $var['end'].'T02:00:00', 'YYYY-MM-DDTHH:mm:ss' );
}
$start=new Zend_date( $range_start );
$end=new Zend_date( $range_end );

$holidays=[];
$holidays['noel']=$start->get('YYYY').'-12-25';
$holidays['newyear']=$start->get('YYYY').'-01-01';
$holidays['epihany']=$start->get('YYYY').'-01-06';
$holidays['firstmay']=$start->get('YYYY').'-05-01';
$holidays['eightmay']=$start->get('YYYY').'-05-08';
$holidays['bastille']=$start->get('YYYY').'-07-16';
$holidays['allsaints']=$start->get('YYYY').'-11-01';

foreach($holidays as $key=>$holiday){
	if( isLater($start, $holiday) && isEarlier($end, $holiday) ){
		array_push( $eventarray, $this->createArray( $this->toStartDate( $holiday )->toString(\Zend_Date::ISO_8601), $this->toEndDate( $holiday )->toString(\Zend_Date::ISO_8601), $key );
	}
} 


<?php 

namespace Website\Object\Stats;

class Resource extends \Object\Concrete\Resource {


    /**
     * @see Object_Abstract_Resource::init
     */
    public  function getClassName(){
    	return $this->model->getClassName() ;
    }
	public function getStatistics (  $locationId, $start= null, $end = null ){
		if(!$start) $start= \Zend_Date::now();
		if(!$end) $end=$start;
		if($locationId >0 ):
		$sql = sprintf(" SELECT count(o.oo_id) as nbre, sum(o.partysize) as couverts,
				min(o.start) as date_start, max(o.end) as date_end,  YEAR(FROM_UNIXTIME(o.start)) as y,  MONTH(FROM_UNIXTIME(o.start)) as m,  DAY(FROM_UNIXTIME(o.start)) as d,
				o.location__id as location_id, o.serving__id as serving_id, s.title as serving_name
				FROM object_query_11 o join object_query_13 s on s.oo_id = o.serving__id 
				WHERE  o.`start`>= '%d' AND o.`start`<= '%d' AND o.`location__id` = '%d' and (lower(o.status) <>'cancelled' or o.status is null) "
					,  $start->getTimestamp(), $end->getTimestamp(), $locationId);
		$sql .= "group by   YEAR(FROM_UNIXTIME(o.start)),  MONTH(FROM_UNIXTIME(o.start)),  DAY(FROM_UNIXTIME(o.start)),  o.location__id, o.serving__id
				 order by o.location__id,   YEAR(FROM_UNIXTIME(o.start)),  MONTH(FROM_UNIXTIME(o.start)),  DAY(FROM_UNIXTIME(o.start)), o.serving__id,  s.title " ;
	//	var_dump($sql); exit;
		$result =$this->db->FetchAll($sql);
		endif;
		return $result;
	}
}
 
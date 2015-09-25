<?php
namespace Website\Tool;

/**
 * @class Request
 */
class Requestjsonp {
    public  $method, $id, $params;

    public function __construct() {
         $this->parseRequest();
    }
    protected function parseRequest() {
            $input = file_get_contents('php://input');
			
			if($input): $params = \Zend_Json::decode(\Zend_Json::encode($input));
			else : $params = \Zend_Json::decode(array_keys( $_REQUEST )[1]) ;
			endif;

			if (isset($params['METHOD'])) {
                $this->method =  $params['METHOD'];     
            } 
            if (isset($params['data'])) {
                $this->params =  $params['data'] ;		
            } else {
                $this->params = $params;
            }  
			if (isset($params['id'])) {
                $this->id =  $params['id'];     
            } else {
				$this->id =  $params['data']['id'];
			}
//		var_dump( $this->params ); echo "<br>"; echo "<br>"; exit;

    }
}
<?php
namespace Website\Tool;

/**
 * @class Request
 */
class Request {
    public  $method, $id, $params;

    public function __construct() {
         $this->parseRequest();
    }

    protected function parseRequest() {
        

            $input = file_get_contents('php://input');
			if($input): $params = \Zend_Json::decode($input);
			else : $params = $_REQUEST ;
			endif;

			if (isset($params['METHOD'])) {
                $this->method =  $params['METHOD'];     
            } else {
				$this->method =  $params['data']['METHOD'];
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
			
    }
}


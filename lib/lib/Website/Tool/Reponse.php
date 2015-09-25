<?php
/**
 * @class Response
 * A simple JSON Response class.
 */
namespace Website\Tool;


class Reponse {
    public $success, $data, $row, $debug, $message, $errors, $tid, $trace, $callback,$items, $isTree,$format ;

    public function __construct($params = array()) {
        $this->success  = isset($params["success"]) ? $params["success"] : false;
        $this->format  = isset($params["format"]) ? $params["format"] : 'jsonp';
        $this->message  = isset($params["message"]) ? $params["message"] : '';
        $this->data     = isset($params["data"])    ? $params["data"]    : array();
        $this->row     = isset($params["row"])    ? $params["row"]    : array();
        $this->error     = isset($params["error"])    ? $params["error"]    : array();
        $this->fieldErrors     = isset($params["fieldErrors"])    ? $params["fieldErrors"]    : array();
        $this->callback = isset($params["callback"]) ? $params["callback"]    : array();
        $this->items    = isset($params["items"]) ? $params["items"]    : array();
        $this->isTree    = isset($params["isTree"]) ? $params["isTree"]    : false ;
        $this->debug    = isset($params["debug"]) ? $params["debug"]    : '' ;
    }

    public function to_json() {
        return \Zend_Json::encode( $this->to_array() );
    }

    public function to_datatable() {
        return \Zend_Json::encode( $this->to_array() );
    }
	
	public function to_array() {
		if(! $this->isTree):
			if( !empty($this->error) ){
				if( !empty($this->fieldErrors) ){
					return array(
			            'success'   => $this->success,
			            'message'   => \Zend_Registry::get('Zend_Translate')->translate($this->message),
			            'fieldErrors' => $this->fieldErrors,
						'debug'      => $this->debug
			        );
				} else {
					return array(
			            'success'   => $this->success,
			            'message'   => \Zend_Registry::get('Zend_Translate')->translate($this->message),
			            'error'      => $this->error,
						'debug'      => $this->debug
			        );				
				}
			} else {
				if( !empty($this->fieldErrors) ){				
					return array(
			            'fieldErrors' => $this->fieldErrors
			        );
				} else {
					return array(
			            'success'   => $this->success,
			            'message'   => \Zend_Registry::get('Zend_Translate')->translate($this->message),
			            'data'      => $this->data,
			            'row'      => $this->row,
						'debug'      => $this->debug
			        );				
				}			
			}
		else:
		return array(
            'success'   => $this->success,
            'message'   => \Zend_Registry::get('Zend_Translate')->translate($this->message),
            'data'      => $this->data,
            'row'      => $this->row,
			'items'     => $this->items,
			'debug'      => $this->debug
        );
		endif;
    }
    public function to_xml() {
    	// XML-related routine
    	$xml = new DOMDocument('1.0', 'utf-8');
    	$xml->appendChild($xml->createElement('foo', 'bar'));
    	$output = $xml->saveXML();
    	return $output;   	 	
     }
     public function to_html() {
     	// XML-related routine
     	$html = new DOMDocument('1.0', 'utf-8');
     	$html->appendChild($html->createElement($this->data));
     	$output = $html->saveHtML();
     	return $output;
     }
    
    public function to_jsonP () {

    //start output
	    if ($this->callback) {
	    	return $this->callback . '(' . $this->to_json() . ');';
	    } else {
	    	return $this->to_json();
	    }
    }
    
}

<?php

namespace Http;

class Request
{
	private $method;
	private $uri;
	private $parameters;
	
	const GET    = 'GET';
    const POST   = 'POST';
    const PUT    = 'PUT';
    const DELETE = 'DELETE';
    
    
    public static function createFromGlobals(){
		return new self($_GET,$_POST);
	}
	
	function __construct(array $query = array(), array $request = array()){
		
		//setting method
		$this->method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::GET;
		//setting uri
		$uri= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		if ($pos = strpos($uri, '?')) {
			$uri = substr($uri, 0, $pos);
		}
		$this->uri= $uri;
		//setting parameters
		$this->parameters= array_merge($query,$request);
	
	}
	/**
	 * Get the method of the request 
	 * @returns method 
	 **/
	function getMethod(){
		//if client doesn't support the put or delete, _method added in parameters as hidden field.
		if (self::POST === $this->method) {
			return $this->getParameter('_method', $this->method);
		}
		return $this->method;
	}
	
	/**
	 * Get the request uri
	 * */
	function getUri(){
		return $this->uri;
	}
	
	/**
	 * get the $name parameter
	 * 
	 * @returns the $name parameter or null if $name is not set 
	 **/
	function getParameter($name,$default = null){
		if( isset($this->parameters[$name]) ){
			return $this->parameters[$name];
		}
		else{
			return $default;
		}
	}
		
	
		
}

<?php

namespace Http;

class Request
{
    private $method;
    private $uri;
    private $parameters;
    private $requestAccept;

    const GET    = 'GET';
    const POST   = 'POST';
    const PUT    = 'PUT';
    const DELETE = 'DELETE';


    public static function createFromGlobals()
    {
        if ((isset($_SERVER['CONTENT_TYPE']))||(isset($_SERVER['HTTP_CONTENT_TYPE']))) {
            if (($_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')||($_SERVER['CONTENT_TYPE']==='application/json')) {
                $_JSONPOST=array();
                $_JSONPOST= json_decode(file_get_contents('php://input'), true);
                return new self($_GET, $_JSONPOST);
            }
        }
        return new self($_GET, $_POST);
    }

    public function __construct($query = array(), $request = array())
    {
        //setting method
        $this->method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::GET;
        //setting uri
        $uri= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        if ($pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $this->uri= $uri;
        //setting parameters
        $this->parameters= array_merge($query, $request);
        //guessing best format to return
        $this->guessBestFormat($_SERVER['HTTP_ACCEPT']);
    }
    /**
     * Get the method of the request
     * @returns method
     **/
    public function getMethod()
    {
        //if client doesn't support the put or delete, _method added in parameters as hidden field.
        if (self::POST === $this->method) {
            return $this->getParameter('_method', $this->method);
        }
        return $this->method;
    }

    /**
     * Get the request uri
     *
     * @return the request uri
     * */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * get the $name parameter
     *
     * @returns the $name parameter or null if $name is not set
     **/
    public function getParameter($name, $default = null)
    {
        if (isset($this->parameters[$name])) {
            return $this->parameters[$name];
        } else {
            return $default;
        }
    }

    /**
     * guess the best format to return, if no formats match, then return a plain/text document
     *
     * */
    public function guessBestFormat($accept = null)
    {
        $negotiator = new \Negotiation\Negotiator();
        $priorities   = array('text/html; charset=UTF-8', 'application/json');
        $mediaType = $negotiator->getBest($accept, $priorities);
        if ($mediaType==null) {
            $this->requestAccept=null;
        } else {
            $bestFormat = $mediaType->getValue();
            $this->requestAccept=$bestFormat;
        }
    }

    /**
     * Get the request uri
     *
     * @return the request uri
     * */
    public function getRequestAccept()
    {
        return $this->requestAccept;
    }
}

<?php

namespace Routing;

class Route
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $pattern;

    /**
     * @var callable
     */
    private $callable;

    /**
     * @var array
     */
    private $arguments;

    /**
     * @param string   $method
     * @param string   $pattern
     * @param callable $callable
     */
    public function __construct($method, $pattern, $callable)
    {
        $this->method    = $method;
        $this->pattern   = $pattern;
        $this->callable  = $callable;
        $this->arguments = array();
    }

    /**
     * @param string $method
     * @param string $uri
     *
     * @return boolean
     */
    public function match($method, $uri)
    {
        if ($method !== $this->method) {
            return false;
        }

        if (preg_match($this->compilePattern(), $uri, $this->arguments)) {
            array_shift($this->arguments);

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @return callable
     */
    public function getCallable()
    {
        return $this->callable;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    private function compilePattern()
    {
        return sprintf('#^%s$#', $this->pattern);
    }
}

<?php

namespace Model;


class JsonFinder implements FinderInterface
{
	private $statuses;
	
	/**
	 * Read the file data/statuses.json, encode it in json and store it in statuses variable 
	 **/
	function __construct()
	{
		$this->statuses = json_decode(file_get_contents(__DIR__ ."/../../data/statuses.json", "w"), true);
	}
	
	/**
     * Returns all elements.
     *
     * @return json
     */
    public function findAll(){
		return $this->statuses;
	}

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return null|mixed
     */
    public function findOneById($id){
		return $this->statuses[$id];
	}
	
}

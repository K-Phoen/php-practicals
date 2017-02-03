<?php
namespace Model;

class inMemoryFinder implements FinderInterface
{
	private $_statuses;
	
	function __construct(){
	//array containing all statuses
	$this->_statuses= array();
	$this->_statuses[0]="Test1";
	$this->_statuses[1]="Test2";
	$this->_statuses[2]="Test3";
	}
	/**
     * Returns all elements.
     *
     * @return array
     */
    public function findAll(){
		return $this->_statuses;
	}

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return null|mixed
     */
    public function findOneById($id){
		if($id >= count($this->_statuses)){
			throw new \Exception\HttpException(404,"Not found");
		}
		return $this->_statuses[$id];
	}
}

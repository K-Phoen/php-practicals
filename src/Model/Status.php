<?php

namespace Model;

class Status
{
	private $id;
	private $user;
	private $title;
	private $message;
	private $date;
	
	public function __construct($user,$title,$message,$id= null)
    {
		$this->id =$id;
        $this->user=$user;
        $this->title=$title;
        $this->message=$message;
        $this->date= date("YYY-mm-dd HH:ii:ss");
    }
	
	public function isNew(){
		return $this->id === null;
	}
	
	public function getUser(){
		return $this->user;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function getMessage(){
		return $this->message;
	}
	
	public function getDate(){
		return $this->date;
	}
	
}

<?php

namespace Model;

class Status
{
    private $id;
    private $user;
    private $title;
    private $message;
    private $date;

    public function __construct($user, $title, $message, $date=null, $id= null)
    {
        $this->id =$id;
        $this->user=$user;
        $this->title=$title;
        $this->message=$message;
        if ($date==null) {
            date_default_timezone_set('Europe/Paris');
            $this->date= date("Y-m-d H:i:s");
        } else {
            $this->date=$date;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setId($id)
    {
        $this->id= $id;
    }

    public function toArray()
    {
        return array(
        'id' => $this->id,
        'user' => $this->user,
        'title' => $this->title,
        'message' => $this->message,
        'date' => $this->date
        );
    }
}

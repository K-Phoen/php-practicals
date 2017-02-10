<?php

namespace Model;

class StatusMapper
{
	private $con;
	
	public function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    public function persist(Status $status)
    {
        if($status->isNew()){
			$stmt=$this->con->prepare('INSERT INTO statuses (user, title, message, date) VALUES (:user,:title,:message,:date)');
			return $stmt->execute([':user'=> $status->getUser(), ':title' => $status->getTitle(), ':message' => $status->getMessage(), ':date'=> $status->getDate()]);
		}
		else{
			$this->update($status);
		}
    }
    
    public function update(Status $status){
		//$this->con->prepare('INSERT INTO statuses (user, title, message, date) VALUES ('.$status->user.','.$status->title.','.$status->message.','.$status.id.')');
	}

    public function remove(Status $status)
    {
        $stmt = $this->con->prepare('DELETE FROM statuses WHERE id = :id');
		return $stmt->execute([':id' => $status->id]);
    }
	
}

<?php

namespace Model;

class StatusMapper
{
    private $con;
    
    public function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    /**
     * insert or update the given status in db
     *
     * @parameter  Status   $status
     */
    public function persist(Status $status)
    {
        if ($status->getId()==null) {
            $stmt=$this->con->prepare('INSERT INTO statuses (user, title, message, date) VALUES (:user,:title,:message,:date)');
            $created=$stmt->execute([':user'=> $status->getUser(), ':title' => $status->getTitle(), ':message' => $status->getMessage(), ':date'=> $status->getDate()]);
            if (!$created) {
                throw new Exception\HttpException(500, "Internal Server Error");
            }
            return $this->con->lastInsertId();
        } else {
            $this->update($status);
            return $status->getId();
        }
    }
    /**
     * private function called by persist() to update the given status in db
     *
     * @parameter  Status   $status
     */
    private function update(Status $status)
    {
        $this->con->prepare('UPDATE statuses SET user = :user, title =:title, message = :message , date= :date WHERE id = :id');
        $created = $stmt->execute([':user'=> $status->getUser(), ':title' => $status->getTitle(), ':message' => $status->getMessage(), ':date'=> $status->getDate(), ':id' =>$statuses->getId()]);
    }
    
    /**
     * remove the given status from db
     *
     * @parameter  Status   $status
     */
    public function remove(Status $status)
    {
        $stmt = $this->con->prepare('DELETE FROM statuses WHERE id = :id');
        return $stmt->execute([':id' => $status->getId()]);
    }
}

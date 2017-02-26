<?php

namespace Model;

class StatusFinder implements FinderInterface
{
    private $con;

    public function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    /*
     * Find all statuses in db
     *
     * @return array  ->   statuses in array
     */
    public function findAll($criteria=null)
    {
        if ($criteria == null) {
            $stmt = $this->con->prepare('SELECT * FROM statuses;');
            $stmt->execute();
            $result = $stmt->fetchAll();
            $statuses=array();
            foreach ($result as $key => $row) {
                $status= new Status($row['user'], $row['title'], $row['message'], $row['date'], $row['id']);
                array_push($statuses, $status);
            }
            return $statuses;
        } else {
            $stmt = $this->con->prepare('SELECT * FROM statuses ORDER BY :order DESC LIMIT 0,:limit;');
            $stmt->execute([':order'=> $criteria['orderBy'], ':limit'=> $criteria['limit']]);
            $result = $stmt->fetchAll();
            $statuses=array();
            foreach ($result as $key => $row) {
                $status= new Status($row['user'], $row['title'], $row['message'], $row['date'], $row['id']);
                array_push($statuses, $status);
            }
            return $statuses;
        }
    }

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return object     $status
     */
    public function findOneById($id)
    {
        $stmt = $this->con->prepare('SELECT * FROM statuses WHERE id= :id;');
        if (!$stmt->execute([':id'=>$id])) {
            throw new Exception\HttpException(500, "Internal server error while finding element");
        }
        $queryResult= $stmt->fetch();
        $status= new Status($queryResult['user'], $queryResult['title'], $queryResult['message'], $queryResult['date'], $queryResult['id']);
        return $status;
    }
}

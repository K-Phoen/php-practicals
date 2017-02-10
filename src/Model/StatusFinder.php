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
    public function findAll(){
		$stmt = $this->con->prepare('SELECT * FROM statuses;');
		$stmt->execute();
		$result = $stmt->fetchAll();
		$statuses=array();
		forEach($result as $key => $row){
			$status= new Status($row['user'],$row['title'],$row['message'],$row['date'],$row['id']);
			array_push($statuses,$status);
		}
		return $statuses;
	}

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return object     $status
     */
    public function findOneById($id){
		$stmt = $this->con->prepare('SELECT * FROM statuses WHERE id= :id;');
		if($stmt->execute([':id'=>$id])){
			$queryResult= $stmt->fetch();
			var_dump($queryResult);
			$status= new Status($queryResult['user'],$queryResult['title'],$queryResult['message'],$queryResult['date'],$queryResult['id']);
		}
		else{
			throw new Exception\
		}
		return $status;
	}
	
}

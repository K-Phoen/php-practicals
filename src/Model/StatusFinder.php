<?php

namespace Model;

class StatusFinder implements FinderInterface
{
	private $con;
	
	public function __construct(Connexion $con)
    {
        $this->con = $con;
    }
	
    public function findAll(){
		$stmt = $this->con->prepare('SELECT * FROM statuses;');
		$stmt->execute();
		return $stmt->fetchAll();
	}

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return null|mixed
     */
    public function findOneById($id){
		$stmt = $this->con->prepare('SELECT * FROM statuses WHERE id= :id;');
		$stmt->execute([':id'=>$id]);
		return $stmt->fetch();
	}
	
}

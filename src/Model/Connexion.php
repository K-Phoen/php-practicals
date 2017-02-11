<?php

namespace Model;

class Connexion extends \PDO
{
    public function __construct($connexion, $username, $password, $options)
    {
        try {
            parent::__construct($connexion, $username, $password, $options);
        } catch (exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function executeQuery($query, array $parameters =[])
    {
        $stmt = $this->prepare($query);
        $stmt->execute($parameters);
        return $stmt->fetch();
    }
}

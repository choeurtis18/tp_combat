<?php

class Dbconnexion{

    private $db;

    public function connection() {
        $this->db = new PDO("mysql:host=localhost;dbname=tp_combat", "root", "root");
    }

    
}

?>
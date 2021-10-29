<?php

class Dbconnexion{

    public function connection() {
        try {
            $db = new PDO("mysql:host=db;dbname=tp_combat", "root", "password");
            return $db;
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
            return "error";
        }
    }
}

?>
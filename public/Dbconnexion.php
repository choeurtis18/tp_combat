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

    public function editURL_parameter($url, $param_string){
        $query = parse_url($url, PHP_URL_QUERY);
        // Returns a string if the URL has parameters or NULL if not
        if ($query) {
            $url .= '&'.$param_string;
        } else {
            $url .= '?'.$param_string;
        }
      
        return $url;
      }
    
}

?>
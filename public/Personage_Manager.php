<?php

spl_autoload_register(function($className){
    require $className.".php";
});


class Personage_Manager {
    private $db;

    public function __construct(PDO $db){
        $this->setDb($db);
    }

    public function setDb($db){
        $this->db = $db;
        return $this;
    }

    public function addPersonage(string $nom, string $type){
        $db = $this->db;

        if($type == "magicien"){
            $query = "INSERT INTO `personnage` (`id`, `nom`, `hp`, `attack`, `defence`, `type`, `sleep`, `mana`) VALUES (NULL, :nom, :hp, :attack, :defence, :typee, :sleep, :mana)";
            $req = $db->prepare($query);
        
            if(!$this->verifNom($nom)) {
                $req->bindValue(':nom', $nom);
                $req->bindValue(':hp', 100);
                $req->bindValue(':attack', random_int(5, 10));
                $req->bindValue(':defence', 0);
                $req->bindValue(':typee', 'magicien');
                $req->bindValue(':sleep', date("Y-m-d H:i:s"));
                $req->bindValue(':mana', random_int(15, 30));

                
                $req->execute();
                return "creation magicien : ".$nom;
            }else {
                return "ce magicien existe déjà";
            }
        }elseif ($type == "guerrier"){
            $query = "INSERT INTO `personnage` (`id`, `nom`, `hp`, `attack`, `defence`, `type`, `sleep`) VALUES (NULL, :nom, :hp, :attack, :defence, :typee, :sleep)";
            $req = $db->prepare($query);
        
            if(!$this->verifNom($nom)) {
                $req->bindValue(':nom', $nom);
                $req->bindValue(':hp', 100);
                $req->bindValue(':attack', random_int(20, 40));
                $req->bindValue(':defence', random_int(10, 19));
                $req->bindValue(':typee', 'guerrier');
                $req->bindValue(':sleep', date());

                
                $req->execute();
                return "creation guerrier : ".$nom;
            }else {
                return "ce gerrier existe déjà";
            }
        }

    }

    public function getPersonnages(){
        $db = $this->db;
        $query = "SELECT * FROM `personnage`";

        $req = $db->prepare($query);
        $req->execute();
        
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            if($row['type'] == "magicien"){
                $personnage = new Magicien($row);
            }elseif($row['type'] == "guerrier"){
                $personnage = new Guerrier($row);
            }
            $personnages[] = $personnage;
        };
        return $personnages;
    }

    public function getPersonnage($ID){
        $db = $this->db;
        $query = "SELECT * FROM `personnage` WHERE id = :ID";

        $req = $db->prepare($query);
        $req->bindValue(':ID', $ID, PDO::PARAM_INT);

        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);
        if($row['type'] == "magicien"){
            $personnage = new Magicien($row);
        }elseif($row['type'] == "guerrier"){
            $personnage = new Guerrier($row);
        }

        return $personnage;
    }

    public function updatePersonnage($ID, $attr, $value) {
        $p = $this->getPersonnage($ID);
        $db = $this->db;

        $query = "UPDATE `personnage` SET $attr = $value WHERE `personnage`.`id` = $ID";
        $req = $db->prepare($query);
        $req->execute();
    }

    public function deletePersonnage($ID){
        /*** accès au model ***/
        $db = $this->db;
        $query = "DELETE FROM personnage WHERE id = :ID";

        $req = $db->prepare($query);
        $req->bindValue(':ID', $ID, PDO::PARAM_INT);

        $req->execute();
    }

    function verifNom($nom) {
        /*** accès au model ***/
        $db = $this->db;
        $query="SELECT * FROM personnage WHERE nom = :nom ";
        
        //verifie si le nom existe
        try {
            $req = $db->prepare($query);
            $req->bindValue(':nom', $nom);
            $bool = $req->execute();
            if ($bool) {
                $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        catch (PDOException $e) {
            echo utf8_encode("Echec de select nom Ajout : " . $e->getMessage() . "\n");
        }		
    
        
        if(count($resultat) == 0) return false;
        else return true;
    }
}

?>
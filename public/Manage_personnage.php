<?php

use function PHPSTORM_META\type;

spl_autoload_register(function($className){
    require $className.".php";
});

class Manage_personnage {
    private $db;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }


    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    public function addPersonage(string $nom, string $type){
        $db = $this->db;

        if($type == "magicien"){
            $query = "INSERT INTO `magiciens` (`id`, `nom`, `hp`, `attack`, `defence`, `type`, `mana`) VALUES (NULL, :nom, :hp, :attack, :defence, :mana)";
            $req = $db->prepare($query);
        
            if(!verifNom($nom)) {
                $req->bindValue(':nom', $nom);
                $req->bindValue(':hp', 100);
                $req->bindValue(':attack', random_int(5, 10));
                $req->bindValue(':defence', 0);
                $req->bindValue(':type', 'magicien');
                $req->bindValue(':mana', random_int(15000, 30000));

                
                $req->execute();
                return "creation ".$nom;
            }else {
                return "ce magicien existe déjà";
            }
        }elseif ($type == "guerrier"){
            $query = "INSERT INTO `guerriers` (`id`, `nom`, `hp`, `attack`, `defence`, `type`) VALUES (NULL, :nom, :hp, :attack, :defence)";
            $req = $db->prepare($query);
        
            if(!verifNom($nom)) {
                $req->bindValue(':nom', $nom);
                $req->bindValue(':hp', 100);
                $req->bindValue(':attack', random_int(20, 40));
                $req->bindValue(':defence', random_int(10, 19));
                $req->bindValue(':type', 'guerrier');

                
                $req->execute();
                return "creation ".$nom;
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

    private function verifNom($nom, $type) {
		/*** accès au model ***/
        $db = $this->db;
        $query = "";
        
        if($type == "magicien"){
		    $query="SELECT * FROM magiciens WHERE nom = :nom ";
        } elseif ($type == "guerrier"){
            $query="SELECT * FROM guerriers WHERE nom = :nom ";
        }
		
		//verifie si le nom existe
		try {
			$req = $db->prepare($query);
			$req->bindValue(':nom', $nom, PDO::PARAM_INT);
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
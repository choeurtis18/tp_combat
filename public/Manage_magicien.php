<?php

spl_autoload_register(function($className){
    require $className.".php";
});

class Manage_magicien {
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

    public function addMagicien(string $nom){
        $db = $this->db;
        $query = "INSERT INTO `magiciens` (`id`, `nom`, `hp`, `attack`, `defence`, `mana`) VALUES (NULL, :nom, :hp, :attack, :defence, :mana)";

        $req = $db->prepare($query);
        
        if(!verifNom($nom)) {
            $req->bindValue(':nom', $nom);
            $req->bindValue(':hp', 100);
            $req->bindValue(':attack', random_int(5, 10));
            $req->bindValue(':defence', 0);
            $req->bindValue(':mana', random_int(15000, 30000));

            
            $req->execute();
            return "creation ".$nom;
        }else {
            return "ce magicien existe déjà";
        }
        
    }

    public function getAllMagicien(){
        $db = $this->db;
        $query = "SELECT * FROM `magiciens`";

        $req = $db->prepare($query);
        $req->execute();
        
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $magicien = new Magicien($row);

            $magiciens[] = $magicien;
        };
        
        return $magiciens;
    }

    private function verifNom($nom) {
		/*** accès au model ***/
        $db = $this->db;

		//selectionner le nom
		$query="SELECT * FROM magiciens WHERE nom = :nom ";
		
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
			echo utf8_encode("Echec de select nom Ajout Magicien : " . $e->getMessage() . "\n");
		}		

		
		if(count($resultat) == 0) return false;
		else return true;
	}
}

?>
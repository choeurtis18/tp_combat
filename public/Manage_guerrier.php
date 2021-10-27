<?php

spl_autoload_register(function($className){
    require $className.".php";
});

class Manage_guerrier {
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

    public function addGuerrier(string $nom){
        $db = $this->db;
        $query = "INSERT INTO `guerriers` (`id`, `nom`, `hp`, `attack`, `defence`) VALUES (NULL, :nom, :hp, :attack, :defence)";

        $req = $db->prepare($query);
        
        if(!verifNom($nom)) {
            $req->bindValue(':nom', $nom);
            $req->bindValue(':hp', 100);
            $req->bindValue(':attack', random_int(20, 40));
            $req->bindValue(':defence', random_int(10, 19));

            
            $req->execute();
            return "creation ".$nom;
        }else {
            return "ce gerrier existe déjà";
        }
        
    }

    public function getAllGuerrier(){
        $db = $this->db;
        $query = "SELECT * FROM `guerriers`";

        $req = $db->prepare($query);
        $req->execute();
        
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $guerrier = new Guerrier($row);

            $guerriers[] = $guerrier;
        };
        
        return $guerriers;
    }

    private function verifNom($nom) {
		/*** accès au model ***/
        $db = $this->db;

		//selectionner le nom
		$query="SELECT * FROM guerriers WHERE nom = :nom ";
		
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
			echo utf8_encode("Echec de select nom Ajout guerrier : " . $e->getMessage() . "\n");
		}		

		
		if(count($resultat) == 0) return false;
		else return true;
	}
}

?>
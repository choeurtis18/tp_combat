<?php
    spl_autoload_register(function($className){
        require $className.".php";
    });
    //connection a la data base
    $db = new Dbconnexion();
    $manage = new Personage_Manager($db->connection());

    //recuperer les persos
    $perso1 = $manage->getPersonnage(intval(htmlspecialchars($_GET["id_attaque"])));
    $perso2 = $manage->getPersonnage(intval(htmlspecialchars($_GET["id_defense"])));
    
    if(htmlspecialchars($_GET["action"]) == "attaquer"){
        //si les perso sont differents
        if( htmlspecialchars($_GET["id_attaque"]) != htmlspecialchars($_GET["id_defense"]) ) {
            $perso1->attack($perso2);
            $manage->updatePersonnage($perso2->getID(), 'hp', $perso2->getHp());

            $url = "./InfosPerso.php?id=".$perso1->getID();
            header("Location: $url");
        } else{
            $url = "./InfosPerso.php?id=".$perso1->getID()."&error=tu vas pas de frapper toi meme";
            header("Location: $url");
        }
    }elseif(htmlspecialchars($_GET["action"]) == "dodo"){
        //si les perso sont differents
        if( htmlspecialchars($_GET["id_attaque"]) != htmlspecialchars($_GET["id_defense"]) ) {
            $perso1->endormir($perso2);
            $url = "./InfosPerso.php?id=".$perso1->getID();
            header("Location: $url");
        } else{
            $url = "./InfosPerso.php?id=".$perso1->getID()."&error=tu vas pas t'endormir toi meme";
            header("Location: $url");
        }
    }

?>
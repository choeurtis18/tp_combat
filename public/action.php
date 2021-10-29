<?php
    spl_autoload_register(function($className){
        require $className.".php";
    });
    if(htmlspecialchars($_GET["action"]) == "attaquer"){
        $db = new Dbconnexion();
        $manage = new Manage_personnage($db->connection());
        $perso1 = $manage->getPersonnage(intval(htmlspecialchars($_GET["id_attaque"])));
        $perso2 = $manage->getPersonnage(intval(htmlspecialchars($_GET["id_defense"])));
        if( htmlspecialchars($_GET["id_attaque"]) != htmlspecialchars($_GET["id_defense"]) ) {
            $perso1->attack($perso2);
            $manage->updatePersonnage($perso2->getID(), 'hp', $perso2->getHp());
            $url = "./InfosPerso.php?id=".$perso1->getID();
            header("Location: $url");
        } else{
            $url = "./InfosPerso.php?id=".$perso1->getID()."&error=tu vas pas de frapper toi meme";
            header("Location: $url");
        }
    }
?>
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
            
            $url = "./InfosPerso.php?id=".$perso1->getID();
            header("Location: $url");
        } else{
            $url = "./InfosPerso.php?id=".$perso1->getID()."&error=tu vas pas t'endormir toi meme";
            header("Location: $url");
        }
    }

    function addTime($date, Personage $p) {
        $db = new Dbconnexion();
        $db = $db->connection();
      
        $query = "INSERT INTO `time` SET  `date` = :datee)";
        $req = $db->prepare($query);
      
        $req->bindValue(':datee', $date);
        $req->execute();
        $p->setSleep(getTime());
      }
      
      function getTime() {
        $db = new Dbconnexion();
        $db = $db->connection();
      
        $query = "SELECT `date` FROM `time`";
      
        $req = $db->prepare($query);
        $req->execute();
      
        $row = $req->fetch(PDO::FETCH_ASSOC);
      
        return htmlspecialchars($row['date']);
      
      }
      
      function deleteTime($date) {
        $db = new Dbconnexion();
        $db = $db->connection();
      
        $query = "DELETE FROM `time` WHERE `date`= $date";
      
      }
?>
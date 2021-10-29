<?php
spl_autoload_register(function($className){
    require $className.".php";
});
class Magicien extends Personage {
    private int $mana;

    function __construct($data){
        $this->hydrate($data);
    }

    public function endormir(Personage $p){
        $sDate = date("Y-m-d H:i:s");
        $this->addTime($sDate, $p);
        if((strtotime(date($this->getSleep())) + 120) > $sDate) {
            return "Tu l'as déjà endormi il y a moins de 2 minutes. Attend encore un peu.";
        }
        else {

        }
    }
    /**
     * Get the value of mana
     */ 
    public function getMana(){
        return $this->mana;
    }

    /**
     * Set the value of mana
     *
     * @return  self
     */ 
    public function setMana($mana){
        $this->mana = $mana;
        return $this;
    }
    
    function addTime($date, Personage $p) {
        $db = new Dbconnexion();
        $db = $db->connection();
      
        $query = "INSERT INTO `time` (`id`, `time`) VALUES (NULL, :datee)";
        $req = $db->prepare($query);
      
        $req->bindValue(':datee', $date);
        $req->execute();
        
        $time_tab = $this->getTime();
        $p->setSleep($time_tab['time']);
        $this->deleteTime($time_tab['id']);
    }
      
    function getTime() {
        $db = new Dbconnexion();
        $db = $db->connection();
      
        $query = "SELECT * FROM `time`";
      
        $req = $db->prepare($query);
        $req->execute();
      
        $row = $req->fetch(PDO::FETCH_ASSOC);
        return $row;   
    }
      
    function deleteTime($id) {
        $db = new Dbconnexion();
        $db = $db->connection();
        
        $query = "DELETE FROM `time` WHERE `id`= $id";
        
        $req = $db->prepare($query);
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();
    }
}

?>
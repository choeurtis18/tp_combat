<?php

class Magicien extends Personage {
    private int $mana;

    function __construct($data){
        $this->hydrate($data);
    }

    public function endormir(Personage $p){
        $sDate = date("Y-m-d H:i:s");
        addTime($sDate, $p);
        deleteTime($this->getSleep());
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
}

?>
<?php

class Magicien extends Personage {
    private int $mana;

    public function dododo(Personage $p){
        
    }
    /**
     * Get the value of mana
     */ 
    public function getMana()
    {
        return $this->mana;
    }

    /**
     * Set the value of mana
     *
     * @return  self
     */ 
    public function setMana($mana)
    {
        $this->mana = $mana;

        return $this;
    }
}

?>
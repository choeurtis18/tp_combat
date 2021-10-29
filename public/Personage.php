<?php

class Personage{
        private int $ID;
        private string $nom;
        private int $hp;
        private int $attack;
        private int $defence;
        private string $type;
        //mana

        function __construct($data){
                $this->hydrate($data);
        }

        public function hydrate($data){
                foreach ($data as $key => $value) {
                        $method = 'set'.ucfirst($key);
                        if (is_callable([$this, $method])) {
                                $this->$method($value);
                        }
                }      
        }

        public function attack(Personage $p){
            $p->setHp($p->getHp() - ($this->getAttack() - $p->getDefence()));
            if($p->getHp() <= 0){
                $db = new Dbconnexion();
                $db = $db->connection();
                $a = new Manage_personnage($db);
                $a->deletePersonnage($p->getID());
            }
        }

        
        
        /**
         * Get the value of ID
         */ 
        public function setID($ID)
        {
                $this->ID = $ID;

                return $this;
        }

        /**
         * Get the value of ID
         */ 
        public function getID()
        {
                return $this->ID;
        }

        /**
         * Get the value of hp
         */ 
        public function getHp()
        {
                return $this->hp;
        }

        /**
         * Set the value of hp
         *
         * @return  self
         */ 
        public function setHp($hp)
        {
                $this->hp = $hp;

                return $this;
        }

        /**
         * Get the value of attak
         */ 
        public function getAttack()
        {
                return $this->attack;
        }

        /**
         * Set the value of attack
         *
         * @return  self
         */ 
        public function setAttack($attack)
        {
                $this->attack = $attack;

                return $this;
        }

        /**
         * Get the value of defence
         */ 
        public function getDefence()
        {
                return $this->defence;
        }

        /**
         * Set the value of defence
         *
         * @return  self
         */ 
        public function setDefence($defence)
        {
                $this->defence = $defence;

                return $this;
        }


        /**
         * Get the value of nom
         */ 
        public function getNom()
        {
                return $this->nom;
        }

        /**
         * Set the value of nom
         *
         * @return  self
         */ 
        public function setNom($nom)
        {
                $this->nom = $nom;

                return $this;
        }

        public function getType()
        {
                return $this->type;
        }
        public function setType($type)
        {
                $this->type = $type;

                return $this;
        }
        
    }
?>
<?php

    class User{
        private $id;
        private $userName;
        private $password;

        public function __construct($userName, $password){
            $this->userName = $userName;
            $this->password = $password;
        }

        public function getId(){
            return $this->id;
        }

        public function getUserName(){
            return $this->userName;
        }

        public function setPassword($password){
            $this->password = $password;
        }
    }
    
?>

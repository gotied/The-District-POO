<?php
class Utilisateur {
        private $table = "utilisateur";

        private $id;
        private $nom_prenom;
        private $email;
        private $password;

        public function __construct($id, $nom_prenom, $email, $password){
            $this->$id;
            $this->$nom_prenom = $nom_prenom;
            $this->email = $email;
            $this->password = $password;
        }

        public function getId() {
            return $this->id;
        }
    
        public function setId($id) {
            $this->id = $id;
        }
    
        public function getNomPrenom() {
            return $this->nom_prenom;
        }
    
        public function setNomPrenom($nom_prenom) {
            $this->nom_prenom = $nom_prenom;
        }
    
        public function getEmail() {
            return $this->email;
        }
    
        public function setEmail($email) {
            $this->email = $email;
        }
    
        public function getPassword() {
            return $this->password;
        }
    
        public function setPassword($password) {
            $this->password = $password;
        }
    }
?>
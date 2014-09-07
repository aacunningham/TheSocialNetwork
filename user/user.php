<?php

    require_once "../assets/functions.php";

    class user {
        //properties 
        public $email, $password, $name, $picture, $interests, $hobbies, $bio, $rel;
        public $message;
        public $userDB = "users.json";
        public $usersJSON = array ();
        
        //methods
        public function user () {
            $this->usersJSON = decodeJSON($this->userDB);
        }
        
        public function add () {
            $this->usersJSON[$this->email] = array (
                "password" => md5($this->password),
                "name" => $this->name,
                "picture" => empty($this->picture) ? 
                    "../assets/icons/default.png" : 
                    $this->picture,
                "interests" => $this->interests,
                "hobbies" => $this->hobbies,
                "bio" => $this->bio,
                "rel" => $this->rel
            );
            encodeJSON($this->userDB, $this->usersJSON);
        } 
        
        public function delete () {
            delete($this->email, $this->usersJSON); //remove user from JSON DB
            encodeJSON($this->userDB, $this->usersJSON); //save JSON DB
            deleteFolder ("assets/$this->email"); //delete user's uploaded content (picture)
        }
        
        
        
        
        
        
        
        
        
        
        
        
    }
?>
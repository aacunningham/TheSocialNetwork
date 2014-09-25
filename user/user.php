<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once "../assets/functions.php";
    require_once "../sql/sql.php";

    class user {
        //properties 
        public $email, $password, $fname, $lname, $picture, $interests, $hobbies, $bio, $rel;
        private $identifier = "uid";
        public $table = "users";
        public $uid, $message;
        
        //methods
        public function user () {
            if ($this->loggedIn()) {
                $this->uid = $_SESSION['uid'];
                $this->get ();
            }
        }
                
        public function get ($identifier=null, $id=null) {
            if (empty($identifier)) $identifier = $this->identifier;
            if (empty($id)) $id = $this->uid;
            $dao = new SQL ();
            $results = $dao->select ($this->table, $identifier, $id);
            foreach ($results[0] as $key => $value) {
                if (property_exists($this, $key)) { //if it's a property of the object (must be same names)
                    $this->$key = $value; //set object's properties
                }
            }
        }
        
        public function create () {
            $columns = array ("password", "email", "fname", "lname", "picture", "interests", "hobbies", "bio", "rel");
            $values = array ($this->password, $this->email, $this->fname, $this->lname, $this->picture, $this->interests, $this->hobbies, $this->bio, $this->rel);
            $dao = new SQL ();
            $this->uid = $dao->insert ($this->table, $columns, $values);
            $this->message = "User created!";
        } 
        
        public function edit () {
            $columns = array ("email", "fname", "lname", "picture", "interests", "hobbies", "bio", "rel");
            $values = array ($this->email, $this->fname, $this->lname, $this->picture, $this->interests, $this->hobbies, $this->bio, $this->rel);
            $dao = new SQL ();
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->uid);
            if ($success) {
                $this->message = "User updated!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function delete () {
            $dao = new SQL ();
            $success = $dao->delete ($this->table, $this->identifier, $_SESSION['uid']);
            if ($success) {
                $this->message = "User deleted!";
                $this->logout (); //user deleted their account, log them out
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function login () {
            $dao = new SQL (); 
            $result = $dao->select ($this->table, "email", $this->email);
            if ($result[0]["password"] == $this->password) {
                $_SESSION['uid'] = $result[0]["uid"];
                $this->message = "User logged in!";
            }
        }
        
        public function logout () {
            $_SESSION['uid'] = NULL;
            $this->message = "User logged out!";
        }
        
        public function loggedIn () {
            return !empty($_SESSION['uid']);
        }
        
        public function listAll () {
            $dao = new SQL ();
            return $dao->selectAll($this->table);
        }
        
        
        
        
    }
?>
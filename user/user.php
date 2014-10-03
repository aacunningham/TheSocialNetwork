<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); //for login and logout using session vars
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
        public function user () { //get current user's info at initialization of object
            if ($this->loggedIn()) {
                $this->uid = $_SESSION['uid'];
                $this->get ();
            }
        }
                
        public function get ($identifier=null, $id=null) { //fetch user's info from SQL using id(s) at identifier(s) (can be arrays)
            if (empty($identifier)) $identifier = $this->identifier; //if none provided, use uid as default
            if (empty($id)) $id = $this->uid; //if none provided, use uid as default
            
            $dao = new SQL (); //data access object
            $results = $dao->select ($this->table, $identifier, $id); //send query to SQL
            
            if (empty($results)) { //if empty
                return NULL; //so we don't print errors
            }
            
            foreach ($results[0] as $key => $value) { //if results
                if (property_exists($this, $key)) { //if it's a property of the object (must be same names)
                    $this->$key = $value; //set object's properties
                }
            }
            
            return $results;
        }
        
        public function create () { //creates a new user in the SQL
            $columns = array ("password", "email", "fname", "lname", "picture", "interests", "hobbies", "bio", "rel");
            $values = array ($this->password, $this->email, $this->fname, $this->lname, $this->picture, $this->interests, $this->hobbies, $this->bio, $this->rel);
            
            $dao = new SQL (); //data access object
            $this->uid = $dao->insert ($this->table, $columns, $values); //send insert to SQL
            $this->message = "User created!";
        } 
        
        public function edit () { //updates a user in the SQL
            $columns = array ("email", "fname", "lname", "picture", "interests", "hobbies", "bio", "rel");
            $values = array ($this->email, $this->fname, $this->lname, $this->picture, $this->interests, $this->hobbies, $this->bio, $this->rel);
            
            $dao = new SQL (); //data access object
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->uid); //send update query
            
            if ($success) {
                $this->message = "User updated!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function delete () { //deletes a row in the SQL
            $dao = new SQL (); //data access object
            $success = $dao->delete ($this->table, $this->identifier, $_SESSION['uid']);
            
            if ($success) {
                $this->message = "User deleted!";
                $this->logout (); //user deleted their account, log them out
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function login () { //log the user into the system
            $dao = new SQL ();  //data access object
            $result = $dao->select ($this->table, "email", $this->email); //get their password by their email
            
            if ($result[0]["password"] == $this->password) { //if their password is valid
                $_SESSION['uid'] = $result[0]["uid"]; //save their uid in session for use everywhere
                $this->message = "User logged in!"; 
            }
        }
        
        public function logout () { //log the user out of the system
            $_SESSION['uid'] = NULL; //nullify their session info
            $this->message = "User logged out!";
        }
        
        public function loggedIn () { //check if a valid user is logged in
            return !empty($_SESSION['uid']);
        }
        
        public function listAll () { //list all users
            $dao = new SQL (); //data access object
            return $dao->selectAll($this->table); //select all of them
        }
        
        
        
        
    }
?>
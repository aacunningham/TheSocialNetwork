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
        private $table = "users";
        private $friends = "friends";
        public $uid, $message;
        
        //methods
        public function user ($blank=false) { //get current user's info at initialization of object
            if (!$blank and $this->loggedIn()) {
                $this->uid = $_SESSION['uid'];
                $this->get ();
            }
        }
                
        public function get ($identifier=null, $id=null, $set=true) { //fetch user's info from SQL using id(s) at identifier(s) (can be arrays)
            if (empty($identifier)) $identifier = $this->identifier; //if none provided, use uid as default
            if (empty($id)) $id = $this->uid; //if none provided, use uid as default
            
            $dao = new SQL (); //data access object
            $results = $dao->select ($this->table, $identifier, $id); //send query to SQL
            
            if (empty($results)) { //if empty
                return NULL; //so we don't print errors
            }
            
            if ($set) {
                foreach ($results[0] as $key => $value) { //if results
                    if (property_exists($this, $key)) { //if it's a property of the object (must be same names)
                        $this->$key = $value; //set object's properties
                    }
                }
            }
            
            return $results;
        }
        
        public function create () { //creates a new user in the SQL
            $columns = array ("password", "email", "fname", "lname", "picture", "interests", "hobbies", "bio", "rel");
            $values = array ($this->password, $this->email, $this->fname, $this->lname, $this->picture, $this->interests, $this->hobbies, $this->bio, $this->rel);
            
            $dao = new SQL (); //data access object
            $this->uid = $dao->insert ($this->table, $columns, $values); //send insert to SQL
            $this->create_default ($this->uid);
            $this->message = "User created!";
        } 

        public function create_default ($userid) {
            $columns = array ("uid", "name", "side", "sequence", "background", "fontColor");
            $values = array ($userid, "about me", 0, 0, "#FF00FF", "#000000");
            $dao = new SQL ();
            $dao->insert ("modules", $columns, $values);
            $values = array ($userid, "contact", 1, 0, "#FF00FF", "#000000");
            $dao->insert ("modules", $columns, $values);
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
            $module_success = $dao->delete ("modules", $this->identifier, $_SESSION['uid']);
            if ($module_success) {
                $user_success = $dao->delete ($this->table, $this->identifier, $_SESSION['uid']);
                if ($user_success) {
                    $this->message = "User deleted!";
                    $this->logout ();
                } else {
                    $this->message = "User could not be deleted.";
                }
            } else {
                $this->message = "Modules could not be deleted.";
            }
        }
        
        public function login () { //log the user into the system
            $dao = new SQL ();  //data access object
            $result = $dao->select ($this->table, "email", $this->email); //get their password by their email
            
            //if ($result[0]["password"] == $this->password) { //if their password is valid
            if (password_verify($this->password, $result[0]["password"])) { //if their password is valid
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
        
        public function makeFriend ($email) {
            $user = new User ();
            $user->get ("email", $email);
            $dao = new SQL ();
            $dao->insert ($this->friends, array ("uid1", "uid2"), array ($this->uid, $user->uid));
            $this->message = "Friend added!";
        }
        
        public function unFriend ($email) {
            $user = new User ();
            $user->get ("email", $email);
            $dao = new SQL ();
            $dao->delete ($this->friends, array ("uid1", "uid2"), array ($this->uid, $user->uid));
            $this->message = "Friend removed!";
        }
        
        public function search ($search) {
            if (strpos($search, "@") === false) { //the string is a name - could be first or last or both
                $space = strpos($search, " ");
                if ($space === false) { //no spaces - just one name
                    $results = $this->get ("fname", $search, false);
                    $results2 = $this->get ("lname", $search, false);
                    if (count($results2) > 0) {
                        $results = $results2;
                    }
                } else {
                    $first = ucwords (substr ($search, 0, $space));
                    $last = ucwords (substr ($search, $space, strlen($search) - $space));
                    $results = $this->get (array("fname", "lname"), array($first, $last), false);
                }
            } else {
                $results = $this->get ("email", $search, false); //string is a name
            }
            return $results;
        }
        
        
        
    }
?>

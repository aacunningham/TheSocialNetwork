<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); //for login and logout using session vars
    }
    require_once "../assets/functions.php";
    require_once "../sql/sql.php";

    class user {
        //properties 
        public $email, $password, $fname, $lname, $picture, $interests, $hobbies, $bio, $rel, $privacy;
        public $school, $work;
        private $identifier = "uid";
        private $table = "users";
        private $friends = "friends";
        public $publicToUsers = "Public, signed in";
        public $public = "Public, not signed in";
        public $friendsOnly = "Friends only";
        public $uid, $message;
        
        //methods
        public function user ($blank=false) { //get current user's info at initialization of object
            if (!$blank and $this->loggedIn()) {
                $this->uid = $_SESSION['uid'];
                $this->get ();
            }
        }
        
        public function getUser () {
            return $_SESSION['uid'];
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
            $columns = array ("password", "email", "fname", "lname", "picture", "interests", "hobbies", "bio", "rel", "privacy");
            $values = array ($this->password, $this->email, $this->fname, $this->lname, $this->picture, $this->interests, $this->hobbies, $this->bio, $this->rel, $this->privacy);
            
            $dao = new SQL (); //data access object
            $this->uid = $dao->insert ($this->table, $columns, $values); //send insert to SQL
            $this->create_default ($this->uid);
            if (!empty($this->uid)) {
                $this->message = "User created!";
                return true;
            } else {
                $this->message = "Oops - an error occurred.";
                return false;
            }
        } 

        //Create default modules on user creation
        public function create_default ($uid) {
            $dao = new SQL ();
            $columns = array ("uid", "name", "side", "sequence", "background", "fontColor");
            $values = array ($uid, "about me", 0, 0, "#FF00FF", "#000000");
            $dao->insert ("modules", $columns, $values);
            $values = array ($uid, "contact", 1, 0, "#FF00FF", "#000000");
            $dao->insert ("modules", $columns, $values);
            $values = array ($uid, "schools", 1, 0, "#FF00FF", "#000000");
            $dao->insert ("modules", $columns, $values);
            $values = array ($uid, "work", 1, 0, "#FF00FF", "#000000");
            $dao->insert ("modules", $columns, $values);
            $values = array ($uid, "friends", 1, 0, "#FF00FF", "#000000");
            $dao->insert ("modules", $columns, $values);
            $values = array ($uid, "posts", 1, 0, "#FF00FF", "#000000");
            $dao->insert ("modules", $columns, $values);
            $values = array ($uid, "profile background", 1, 0, "#FFFFFF", "#000000");
            $dao->insert ("modules", $columns, $values);
            return true;
        }

        public function edit () { //updates a user in the SQL
            $columns = array ("email", "fname", "lname", "picture", "interests", "hobbies", "bio", "rel", "privacy");
            $values = array ($this->email, $this->fname, $this->lname, $this->picture, $this->interests, $this->hobbies, $this->bio, $this->rel, $this->privacy);
            
            $dao = new SQL (); //data access object
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->uid); //send update query
            
            if ($success) {
                $this->message = "User updated!";
                return true;
            } else {
                $this->message = "Oops - an error occurred.";
                return false;
            }
        }
		
		public function update_password($uid=NULL) { //update the user password in SQL
		    if (empty($uid)) $uid = $_SESSION['uid'];
			$columns = array("password");
			$values = array($this->password);
			
			$dao = new SQL();
			$success = $dao->update($this->table, $columns, $values, $this->identifier, $uid);
			
            if ($success) {
                $this->message = "Password changed!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
			return $success;
		}
        
        public function delete () { //deletes a row in the SQL
            $dao = new SQL (); //data access object
            $module_success = $dao->delete ("modules", $this->identifier, $_SESSION['uid']);
            if ($module_success) {
                $user_success = $dao->delete ($this->table, $this->identifier, $_SESSION['uid']);
                if ($user_success) {
                    $this->message = "User deleted!";
                    $this->logout ();
                    return true;
                } else {
                    $this->message = "User could not be deleted.";
                    return false;
                }
            } else {
                $this->message = "Modules could not be deleted.";
                return false;
            }
        }
        
        public function login () { //log the user into the system
            $dao = new SQL ();  //data access object
            $result = $dao->select ($this->table, "email", $this->email); //get their password by their email
            if (empty($result)) {
                $this->message = "Error - email not in database.";
                return false;
            } 
            if (password_verify($this->password, $result[0]["password"])) { //if their password is valid
                $_SESSION['uid'] = $result[0]["uid"]; //save their uid in session for use everywhere
                $_SESSION['bLoggedIn'] = true;
                $this->message = "User logged in!"; 
                return true;
            }
        }
        
        public function logout () { //log the user out of the system
            $_SESSION['uid'] = NULL; //nullify their session info
            $_SESSION['bLoggedIn'] = NULL;
            $this->message = "User logged out!";
            return true;
        }
		
		public function forgot_password() { //start the password reset process
			$dao = new SQL();
			$result = $dao->select ($this->table, "email", $this->email); //get their password by their email

			if(empty($result)){
				$this->message = "User not found";
				return FALSE;
			} else {
				$this->message = "User found";
				$_SESSION['uid'] = $result[0]["uid"]; //save their uid in session for use everywhere
				return TRUE;
			}
		}

		public function get_challenge_question($uid=NULL) {
		    if (empty($uid)) $uid = $_SESSION['uid'];
			$dao = new SQL();
            $result = $dao->select ("security_questions", "uid", $uid); //go to the security table and get their challenge question
            if (empty($result)) {
                $this->message = "Oops - an error occurred.";
            } else {
                $this->message = "Found Question"; 
            }		
            return $result;
		}
        
        public function loggedIn () { //check if a valid user is logged in
            return !empty($_SESSION['uid']) and !empty($_SESSION['bLoggedIn']);
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
            return true;
        }
        
        public function unFriend ($email) {
            $user = new User ();
            $user->get ("email", $email);
            $dao = new SQL ();
            $dao->delete ($this->friends, array ("uid1", "uid2"), array ($this->uid, $user->uid));
            $this->message = "Friend removed!";
            return true;
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
        
        public function getFriends () {
            $dao = new SQL ();
            $results1 = $dao->select ("friends", "uid1", $this->uid);
            $results2 = $dao->select ("friends", "uid2", $this->uid);
            $results = array ();
            foreach ($results1 as $r) {
                $results[] = $r['uid2'];
            }
            foreach ($results2 as $r) {
                $results[] = $r['uid1'];
            }
            return $results;
        }
        
        public function toArray () {
            return array(
                "uid" => $this->uid,
                "email" => $this->email,
                "password" => $this->password,
                "fname" => $this->fname,
                "lname" => $this->lname,
                "picture" => $this->picture,
                "interests" => $this->interests,
                "hobbies" => $this->hobbies,
                "bio" => $this->bio,
                "rel" => $this->rel
            );
        }
        
        public function getPublic () {
            $arr = $this->get ("privacy", $this->publicToUsers, false);
            $arr2 = $this->get ("privacy", $this->public, false);
            return array_merge ($arr, $arr2);
        }
        
        //This will get very time-intensive when many users! use suggestions instead
        public function getOthers () {
            $friends = $this->getFriends();
            $all = $this->getPublic ();
            $notFriends = array ();
            foreach ($all as $user) {
                if (!in_array($user['uid'], $friends) and $user['uid'] != $this->uid) {
                    $notFriends[] = $user;
                }
            }
            return $notFriends;
        }
        
        public function getSuggestions () {
            $suggestions = array();
            $friends = $this->getFriends();
            foreach ($friends as $fid) {
                $u = new user();
                $u->uid = $fid;
                $sugg = $u->getFriends();
                foreach ($sugg as $sid) {
                    if (!in_array($sid, $friends) and $sid != $this->uid) {
                        $s = new user();
                        $s->uid = $sid;
                        $s->get();
                        $suggestions[] = $s;
                    }
                }
            }
            return $suggestions;
        }
        
        public function getMostPopular () {
            $users = array();
            $ppl = $this->getPublic();
            foreach ($ppl as $person) {
                if ($person['uid'] != $this->uid) {
                    $u = new user();
                    $u->uid = $person['uid'];
                    if (count($u->getFriends()) > 2) { //above a threshold number
                        $u->get();
                        $users[] = $u;
                    }
                }
            }
            return $users;
        }
        
    }
?>

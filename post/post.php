<?php
    require_once "../assets/functions.php";
    date_default_timezone_set("America/Los_Angeles");

    class post {
        //Properties
        public $content, $dateTime;
        private $identifier = "pid";
        public $table = "posts";
        public $pid, $uid;
        
        //Methods
        public function get ($identifier=null, $id=null, $set=true) { //get post info from SQL by id(s) at identifier(s) (can be arrays)
            if (empty($identifier)) $identifier = $this->identifier; //default to pid
            if (empty($id)) $id = $this->pid; //default to pid
            
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
        
        public function create () { //create a new post in the SQL
            $columns = array ("uid", "content");
            $values = array ($_SESSION['uid'], $this->content);
            
            $dao = new SQL (); //data access object
            $this->pid = $dao->insert ($this->table, $columns, $values); //send insert command
            $this->message = "Post created!";
        
        }
        
        public function delete () { //delete a row in the SQL
            $dao = new SQL (); //data access object
            $success = $dao->delete ($this->table, $this->identifier, $this->pid); //send delete command
            
            if ($success) {
                $this->message = "Post deleted!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function edit () { //Updates a post in the SQL
            $columns = array ("content");
            $values = array ($this->content);
            
            $dao = new SQL (); //data access object
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->pid); //send update command
            
            if ($success) {
                $this->message = "Post updated!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function listAll () { //list all posts for all users 
            $dao = new SQL (); //data access object
            return $dao->selectAll($this->table); //select all rows and columns of the table
        }
        
        public function listPosts ($uid=NULL) { //list all posts for this user
            if (empty($uid)) $uid = $_SESSION['uid'];
            return $this->get ('uid', $uid, false); //get this user's posts
        }
        
        public function sortPosts ($posts) { //sort posts by date and time of creation for display
            if (empty($posts)) { //if empty
                return NULL; //so we don't print errors
            }
            
            usort ($posts, function ($a, $b) {
                return strcmp ($b['dateTime'], $a['dateTime']);
            });
            return $posts;
        }
        
        public function display ($uid=NULL) { //returns list of posts for this user for display
            return $this->sortPosts($this->listPosts($uid));
        }
        
        
        
    }
?>
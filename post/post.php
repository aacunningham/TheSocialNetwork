<?php

    require_once "../assets/functions.php";
    date_default_timezone_set("America/Los_Angeles");

    class post {
        //Properties
        public $user, $content, $dateTime;
        private $identifier = "pid";
        public $table = "posts";
        public $pid, $uid;
        
        //Methods
        public function get ($identifier=null, $id=null) {
            if (empty($identifier)) $identifier = $this->identifier;
            if (empty($id)) $id = $this->pid;
            $dao = new SQL ();
            $results = $dao->select ($this->table, $identifier, $id);
            foreach ($results[0] as $key => $value) {
                if (property_exists($this, $key)) { //if it's a property of the object (must be same names)
                    $this->$key = $value; //set object's properties
                }
            }
        }
        
        public function create () {
            $columns = array ("uid", "content");
            $values = array ($_SESSION['uid'], $this->content);
            $dao = new SQL ();
            $this->pid = $dao->insert ($this->table, $columns, $values);
            $this->message = "Post created!";
        
        }
        
        public function delete () {
            $dao = new SQL ();
            $success = $dao->delete ($this->table, $this->identifier, $this->pid);
            if ($success) {
                $this->message = "Post deleted!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function edit () {
            $columns = array ("content");
            $values = array ($this->content);
            $dao = new SQL ();
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->pid);
            if ($success) {
                $this->message = "Post updated!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function listAll () {
            $dao = new SQL ();
            return $dao->selectAll($this->table);
        }
        
        public function sortPosts () {
            
        }
        
        
        public function display () {
            
        }
        
        
        
    }
?>
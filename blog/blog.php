<?php

    require_once "../assets/functions.php";
    date_default_timezone_set("America/Los_Angeles");

    class blog {
        public $user, $title, $content, $dateTime, $category, $folder;
        private $identifier = "bid";
        public $table = "blogs";
        public $bid;
        
        //Methods
        public function get ($identifier=null, $id=null) {
            if (empty($identifier)) $identifier = $this->identifier;
            if (empty($id)) $id = $this->bid;
            $dao = new SQL ();
            $results = $dao->select ($this->table, $identifier, $id);
            foreach ($results[0] as $key => $value) {
                if (property_exists($this, $key)) { //if it's a property of the object (must be same names)
                    $this->$key = $value; //set object's properties
                }
            }
        }
        
        public function create () {
            $columns = array ("uid", "title", "content", "category", "folder");
            $values = array ($_SESSION['uid'], $this->title, $this->content, $this->category, $this->folder);
            $dao = new SQL ();
            $this->bid = $dao->insert ($this->table, $columns, $values);
            $this->message = "Blog created!";
        }
        
        public function edit () {
            $columns = array ("title", "content", "category", "folder");
            $values = array ($this->title, $this->content, $this->category, $this->folder);
            $dao = new SQL ();
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->bid);
            if ($success) {
                $this->message = "Blog updated!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function delete () {
            $dao = new SQL ();
            $success = $dao->delete ($this->table, $this->identifier, $this->bid);
            if ($success) {
                $this->message = "Blog deleted!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function listAll () {
            $dao = new SQL ();
            return $dao->selectAll($this->table);
        }
        
        public function display () {
            
        }
        
        
        
    }
?>
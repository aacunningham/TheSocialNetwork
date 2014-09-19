<?php

    require_once "../assets/functions.php";
    require_once "../sql/sql.php";

    class folder {
        //properties 
        private $identifier = "fid";
        public $table = "folders";
        public $name;
        public $id, $message;
        
        
        //methods
        public function get () {
            $dao = new SQL ();
            $results = $dao->select ($this->table, $this->identifier, $this->id);
            foreach ($results[0] as $key => $value) {
                if (property_exists($this, $key)) { //if it's a property of user (must be same names)
                    $this->$key = $value; //set object's properties
                }
            }
        }
        
        public function create () {
            $columns = array ("uid", "name");
            $values = array ($_SESSION['uid'], $this->name);
            $dao = new SQL ();
            $this->id = $dao->insert ($this->table, $columns, $values);
            $this->message = "Folder created!";
        } 
        
        public function edit () {
            $columns = array ("name");
            $values = array ($this->name);
            $dao = new SQL ();
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->id);
            if ($success) {
                $this->message = "Folder updated!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function delete () {
            $dao = new SQL ();
            $success = $dao->delete ($this->table, $this->identifier, $this->id);
            if ($success) {
                $this->message = "Folder deleted!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function listAll () {
            $dao = new SQL ();
            return $dao->selectAll($this->table);
        }
        
        
        
        
        
        
        
        
    }
?>
<?php

    require_once "../assets/functions.php";
    require_once "../sql/sql.php";

    class category {
        //properties 
        private $identifier = "cid";
        public $table = "categories";
        public $name;
        public $cid, $message;
        
        
        //methods
        public function get ($identifier=null, $id=null) {
            if (empty($identifier)) $identifier = $this->identifier;
            if (empty($id)) $id = $this->cid;
            $dao = new SQL ();
            $results = $dao->select ($this->table, $identifier, $id);
            foreach ($results[0] as $key => $value) {
                if (property_exists($this, $key)) { //if it's a property of the object (must be same names)
                    $this->$key = $value; //set object's properties
                }
            }
        }
        
        public function create () {
            $columns = array ("name");
            $values = array ($this->name);
            $dao = new SQL ();
            $this->cid = $dao->insert ($this->table, $columns, $values);
            $this->message = "Category created!";
        } 
        
        public function edit () {
            $columns = array ("name");
            $values = array ($this->name);
            $dao = new SQL ();
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->cid);
            if ($success) {
                $this->message = "Category updated!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function delete () {
            $dao = new SQL ();
            $success = $dao->delete ($this->table, $this->identifier, $this->cid);
            if ($success) {
                $this->message = "Category deleted!";
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
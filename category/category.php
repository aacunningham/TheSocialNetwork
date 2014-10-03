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
        public function get ($identifier=null, $id=null) { //get category info from SQL using id(s) at identifier(s) (can be arrays)
            if (empty($identifier)) $identifier = $this->identifier; //default to cid
            if (empty($id)) $id = $this->cid; //default to cid
            
            $dao = new SQL (); //data access object
            $results = $dao->select ($this->table, $identifier, $id); //send query
            
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
        
        public function create () { //create a new category in the SQL
            $columns = array ("name");
            $values = array ($this->name);
            
            $dao = new SQL (); //data access object
            $this->cid = $dao->insert ($this->table, $columns, $values); //send insert command
            $this->message = "Category created!";
        } 
        
        public function edit () { //Update a category in the SQL
            $columns = array ("name");
            $values = array ($this->name);
           
            $dao = new SQL (); //data access object
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->cid); //send update command
            
            if ($success) {
                $this->message = "Category updated!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function delete () { //delete a row in the SQL
            $dao = new SQL (); //data access object
            $success = $dao->delete ($this->table, $this->identifier, $this->cid); //send delete command
            
            if ($success) {
                $this->message = "Category deleted!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function listAll () { //list all sitewide categories
            $dao = new SQL (); //data access object
            return $dao->selectAll($this->table); //select all columns and rows in the table
        }
        
        public function sortCategories ($categories) { //sorts categories by name for display
            if (empty($categories)) { //if empty
                return NULL; //so we don't print errors
            }
            
            usort ($categories, function ($a, $b) {
                return $b['name'] - $a['name'];
            });
            return $categories;
        }
        
        public function display () { //returns list of sitewide categories sorted by name for display 
            return $this->sortCategories ($this->listAll());
        }
        
        
        
        
        
    }
?>
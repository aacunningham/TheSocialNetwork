<?php

    require_once "../assets/functions.php";
    require_once "../sql/sql.php";

    class folder {
        //properties 
        private $identifier = "fid";
        public $table = "folders";
        public $name;
        public $fid, $message;
        
        
        //methods
        public function get ($identifier=null, $id=null, $set=true) { //fetch folder info from SQL using id(s) at identifier(s) (can be arrays)
            if (empty($identifier)) $identifier = $this->identifier; //default to fid
            if (empty($id)) $id = $this->fid; //default to fid
            
            $dao = new SQL (); //data access object
            $results = $dao->select ($this->table, $identifier, $id); //send query
            
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
        
        public function create ($uid=NULL) { //create a new folder in the SQL
            if (empty($uid)) $uid = $_SESSION['uid'];
            $columns = array ("uid", "name");
            $values = array ($uid, $this->name);
           
            $dao = new SQL (); //data access object
            $this->fid = $dao->insert ($this->table, $columns, $values); //send insert command
            if (!empty($this->fid)) {
                $this->message = "Folder created!";
                return true;  
            } else {
                $this->message = "Oops - an error occurred.";
                return false;  
            }
            
        } 
        
        public function edit () { //update a folder in the SQL
            $columns = array ("name");
            $values = array ($this->name);
           
            $dao = new SQL (); //data access object
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->fid); //send update command
           
            if ($success) {
                $this->message = "Folder updated!";
                return true;  
            } else {
                $this->message = "Oops - an error occurred.";
                return false;  
            }
        }
        
        public function delete () { //delete a folder in the SQL
            $dao = new SQL (); //data access object
            $success = $dao->delete ($this->table, $this->identifier, $this->fid); //send delete command
           
            if ($success) {
                $this->message = "Folder deleted!";
                return true;  
            } else {
                $this->message = "Oops - an error occurred.";
                return false;  
            }
        }
        
        public function listAll () { //list all folders for all users
            $dao = new SQL (); //data access object
            return $dao->selectAll($this->table); //select all columns and rows in the table
        }
        
        public function listFolders ($uid=NULL) { //list all folders for this user
            if (empty($uid)) $uid = $_SESSION['uid'];
            return $this->get ('uid', $uid, false);
        }
        
        public function sortFolders ($folders) { //sorts folders by name for display
            if (empty($folders)) { //if empty
                return NULL; //so we don't print errors
            }
            
            usort ($folders, function ($a, $b) {
                return $b['name'] - $a['name'];
            });
            return $folders;
        }
        
        public function display ($uid=NULL) { //returns list of this user's folders sorted by name for display
            return $this->sortFolders ($this->listFolders($uid));
        }
        
    }
?>
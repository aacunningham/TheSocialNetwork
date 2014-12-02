<?php
    require_once "../assets/functions.php";
    require_once "../sql/sql.php";

    class school {
        //Properties 
        public $name, $type, $address, $city, $state, $zipCode, $startDate, $endDate, $major, $minor, $degree;
        public $sid, $uid;
        private $table = "schools";
        private $identifier = "sid";
        public $message;
        
        //Methods
        public function get ($identifier=null, $id=null, $set=true) { //fetch School info from SQL using id(s) at identifier(s) (can be arrays)
            if (empty($identifier)) $identifier = $this->identifier; //default to sid
            if (empty($id)) $id = $this->sid; //default to sid
            
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
        
        public function create ($uid=NULL) { //create a new School in the SQL
            if (empty($uid)) $uid = $_SESSION['uid'];
            $columns = array ("uid", "name", "type", "address", "city", "state", "zipCode", "startDate", "endDate", "major", "minor", "degree");
            $values = array ($uid, $this->name, $this->type, $this->address, $this->city, $this->state, $this->zipCode, $this->startDate, $this->endDate, $this->major, $this->minor, $this->degree);
           
            $dao = new SQL (); //data access object
            $this->sid = $dao->insert ($this->table, $columns, $values); //send insert command
            if (!empty($this->sid)) {
                $this->message = "School created!"; 
                return true;
            } else {
                $this->message = "Oops - an error occurred.";
                return false;
            }
            
        } 
        
        public function edit () { //update a School in the SQL
            $columns = array ("name", "type", "address", "city", "state", "zipCode", "startDate", "endDate", "major", "minor", "degree");
            $values = array ($this->name, $this->type, $this->address, $this->city, $this->state, $this->zipCode, $this->startDate, $this->endDate, $this->major, $this->minor, $this->degree);
           
            $dao = new SQL (); //data access object
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->sid); //send update command
           
            if ($success) {
                $this->message = "School updated!";
                return true;
            } else {
                $this->message = "Oops - an error occurred.";
                return false;
            }
        }
        
        public function delete () { //delete a School in the SQL
            $dao = new SQL (); //data access object
            $success = $dao->delete ($this->table, $this->identifier, $this->sid); //send delete command
           
            if ($success) {
                $this->message = "School deleted!";
                return true;
            } else {
                $this->message = "Oops - an error occurred.";
                return false;
            }
        }
        
        public function listAll () { //list all schools for all users
            $dao = new SQL (); //data access object
            return $dao->selectAll($this->table); //select all columns and rows in the table
        }
        
        public function listSchools ($uid=NULL) { //list all schools for this user
            if(empty($uid)) $uid = $_SESSION['uid'];
            return $this->get ('uid', $uid, false);
        }
        
        public function sortSchools ($schools) { //sorts schools by name for display
            if (empty($schools)) { //if empty
                return NULL; //so we don't print errors
            }
            
            usort ($schools, function ($a, $b) {
                return $b['name'] - $a['name'];
            });
            return $schools;
        }
        
        public function display ($uid=NULL) { //returns list of this user's schools sorted by name for display
            return $this->sortSchools($this->listSchools($uid));
        }
        
        
    }
?>
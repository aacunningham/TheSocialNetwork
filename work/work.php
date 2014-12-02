<?php
    require_once "../assets/functions.php";
    require_once "../sql/sql.php";

    class work {
        //Properties 
        public $company, $position, $address, $city, $state, $zipCode, $startDate, $endDate, $phone, $boss, $duties;
        public $wid, $uid;
        private $table = "workplaces";
        private $identifier = "wid";
        public $message;
        
        //Methods
        public function get ($identifier=null, $id=null ,$set=true) { //fetch Work info from SQL using id(s) at identifier(s) (can be arrays)
            if (empty($identifier)) $identifier = $this->identifier; //default to wid
            if (empty($id)) $id = $this->wid; //default to wid
            
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
        
        public function create ($uid=NULL) { //create a new Work in the SQL
            if (empty($uid)) $uid = $_SESSION['uid'];
            $columns = array ("uid", "company", "position", "address", "city", "state", "zipCode", "startDate", "endDate", "phone", "boss", "duties");
            $values = array ($uid, $this->company, $this->position, $this->address, $this->city, $this->state, $this->zipCode, $this->startDate, $this->endDate, $this->phone, $this->boss, $this->duties);
           
            $dao = new SQL (); //data access object
            $this->wid = $dao->insert ($this->table, $columns, $values); //send insert command
            if (!empty($this->wid)) {
                $this->message = "Work history created!";
                return true;
            } else {
                $this->message = "Oops - an error occurred";
                return false;
            }
        } 
        
        public function edit () { //update a Work in the SQL
            $columns = array ("company", "position", "address", "city", "state", "zipCode", "startDate", "endDate", "phone", "boss", "duties");
            $values = array ($this->company, $this->position, $this->address, $this->city, $this->state, $this->zipCode, $this->startDate, $this->endDate, $this->phone, $this->boss, $this->duties);
           
            $dao = new SQL (); //data access object
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->wid); //send update command
           
            if ($success) {
                $this->message = "Work history updated!";
                return true;
            } else {
                $this->message = "Oops - an error occurred.";
                return false;
            }
        }
        
        public function delete () { //delete a Work in the SQL
            $dao = new SQL (); //data access object
            $success = $dao->delete ($this->table, $this->identifier, $this->wid); //send delete command
           
            if ($success) {
                $this->message = "Work history deleted!";
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
        
        public function listWorks ($uid=NULL) { //list all schools for this user
            $uid = empty($uid) ? $_SESSION['uid'] : $uid;
            return $this->get ('uid', $uid, false);
        }
        
        public function sortWorks ($works) { //sorts schools by company for display
            if (empty($works)) { //if empty
                return NULL; //so we don't print errors
            }
            
            usort ($works, function ($a, $b) {
                return $b['company'] - $a['company'];
            });
            return $works;
        }
        
        public function display ($uid=NULL) { //returns list of this user's schools sorted by company for display
            return $this->sortWorks($this->listWorks($uid));
        }
        
        
    }
?>
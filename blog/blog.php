<?php
    require_once "../assets/functions.php";
    date_default_timezone_set("America/Los_Angeles");

    class blog {
        public $title, $content, $dateTime; //blog title, content, and date/time of creation
        public $cid, $fid; //category and folder IDs, respectively
        private $identifier = "bid";
        public $table = "blogs";
        public $bid; //blog ID
        
        //Methods
        public function get ($identifier=null, $id=null, $set=true) { //fetch blog info from SQL using id(s) at identifier(s) (can be arrays for specific results)
            if (empty($identifier)) $identifier = $this->identifier; //none provided, use bid as default
            if (empty($id)) $id = $this->bid; //none provided, use bid as default
           
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
           
            return $results; //useful for later fxns
        }
        
        public function create ($uid=NULL) { //saves a new blog in the SQL
            if (empty($uid)) $uid = $_SESSION['uid'];
            $columns = array ("uid", "title", "content", "cid", "fid");
            $values = array ($uid, $this->title, $this->content, $this->cid, $this->fid);
           
            $dao = new SQL (); //data access object
            $this->bid = $dao->insert ($this->table, $columns, $values); //insert to SQL
            if (!empty($this->bid)) {
                $this->message = "Blog created!";
                return true;
            } else {
                $this->message = "Oops - an error occurred.";
                return false;
            }
            
        }
        
        public function edit () { //updates a blog in the SQL
            $columns = array ("title", "content", "cid", "fid");
            $values = array ($this->title, $this->content, $this->cid, $this->fid);
           
            $dao = new SQL (); //data access object
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->bid);
           
            if ($success) {
                $this->message = "Blog updated!";
                return true;
            } else {
                $this->message = "Oops - an error occurred.";
                return false;
            }
        }
        
        public function delete () { //deletes a row in the SQL
            $dao = new SQL (); //data access object
            $success = $dao->delete ($this->table, $this->identifier, $this->bid);
           
            if ($success) {
                $this->message = "Blog deleted!";
                return true;
            } else {
                $this->message = "Oops - an error occurred.";
                return false;
            }
        }
        
        public function listAll () {
            $dao = new SQL (); //data access object
            return $dao->selectAll($this->table);
        }
        
        public function listBlogs ($fid=NULL, $uid=NULL) { //list all Blogs for this user in this folder (or, if none provided, for that user in all folders)
            if (empty($uid)) $uid = $_SESSION['uid'];
            if (!empty($fid)) {
                return $this->get (array ('uid', 'fid'), array ($uid, $fid));
            } else {
                return $this->get ('uid', $uid, false);
            }
            
        }
        
        public function sortBlogs ($blogs) { //sorts blogs by title for display
            if (empty($blogs)) { //so we don't print errors
                return NULL;
            }
            
            usort ($blogs, function ($a, $b) {
                return $b['title'] - $a['title'];
            });
            return $blogs;
        }
        
        public function display ($fid, $uid=NULL) { //returns list of blogs for this user in this folder for display
            return $this->sortBlogs ($this->listBlogs($fid, $uid));
        }
        
        
        
    }
?>
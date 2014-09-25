<?php

    require_once "../assets/functions.php";
    require_once "../user/user.php";
    date_default_timezone_set("America/Los_Angeles");

    class module {
        //Properties
        public $name, $location, $background, $fontColor;
        private $identifier = "mid";
        public $table = "modules";
        public $mid, $uid;
        
        //Methods
        public function module () {
            $this->user = !empty($_SESSION['uid']) ? $_SESSION['uid'] : '';
        }
        
        public function get ($identifier=null, $id=null) {
            if (empty($identifier)) $identifier = $this->identifier;
            if (empty($id)) $id = $this->mid;
            $dao = new SQL ();
            $results = $dao->select ($this->table, $identifier, $id);
            print_r($results[0]);
            foreach ($results[0] as $key => $value) {
                if (property_exists($this, $key)) { //if it's a property of the object (must be same names)
                    $this->$key = $value; //set object's properties
                }
            }
        }
        
        public function create () {
            $columns = array ("uid", "name", "location", "background", "fontColor");
            $values = array ($_SESSION['uid'], $this->name, $this->location, $this->background, $this->fontColor);
            $dao = new SQL ();
            $this->mid = $dao->insert ($this->table, $columns, $values);
            $this->message = "Module created!";
        }
        
        public function delete () {
            $dao = new SQL ();
            $success = $dao->delete ($this->table, $this->identifier, $this->mid);
            if ($success) {
                $this->message = "Module deleted!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function edit () {
            $columns = array ("location", "background", "fontColor");
            $values = array ($this->location, $this->background, $this->fontColor);
            $dao = new SQL ();
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->mid);
            if ($success) {
                $this->message = "Module updated!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }
        
        public function listAll () {
            $dao = new SQL ();
            return $dao->selectAll($this->table);
        }
        
        public function getName ($location) {
            $this->get (array("uid", "location"), array($this->user, $location));
            return $this->name;
        }
        
        //attempt at polymorphism
        public function display ($object, $location) {
            $class = get_class ($object);
            $type = $this->get (array("uid", "location"), array($this->user, $location));
            switch ($class) {
                case "user":
                    $this->display_user ($object, $type);
                    break;
                case "photo":
                    $this->display_blog ($object, $type);
                    break;
                case "post":
                    $this->display_post ($object, $type);
                    break;
            }
        }
        
        private function display_user ($user, $type) {
            switch ($type) {
                case "about_me":
                    $this->display_about_me ($user);
                    break;
                case "contact":
                    $this->display_contact ($user);
            }
        }
        
        private function display_about_me ($user) { 
            $this->get(array("uid", "name"), array($user->id, "about me")); ?>
            <div class="module" id="about_me" style="background:<?php echo $this->background; ?>;color:<?php echo $this->fontColor; ?>;">
                <h1 class="title">About Me</h1>
                <table>
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $user->fname.' '.$user->lname; ?></td>
                    </tr>
                </table>
            </div>
        <?php }
        
        private function display_contact ($user) {
            $this->get(array("uid", "name"), array($user->id, "contact")); ?>
            <div class="module" id="about_me" style="background:<?php echo $this->background; ?>;color:<?php echo $this->fontColor; ?>;">
                <h1 class="title">Contact</h1>
                <table>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $user->email; ?></td>
                    </tr>
                </table>
            </div>
            
        <?php }
        
        
    }
?>
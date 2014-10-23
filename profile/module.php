<?php

    require_once "../assets/functions.php";
    require_once "../user/user.php";
    require_once "../post/post.php";
    date_default_timezone_set("America/Los_Angeles");

    $post = new post ();

    class module {
        //Properties
        public $name, $background, $fontColor, $side, $order;
        private $identifier = "mid";
        public $table = "modules";
        public $mid, $uid;
        
        //Methods
        public function module () {
            $this->uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : '';
        }
        
        public function get ($identifier=null, $id=null) {
            if (empty($identifier)) $identifier = $this->identifier;
            if (empty($id)) $id = $this->mid;
            $dao = new SQL ();
            $results = $dao->select ($this->table, $identifier, $id);
            if (empty($results)) {
                echo "An error occurred in get in the module class - empty results.";
                return false;
            }
            foreach ($results[0] as $key => $value) {
                if (property_exists($this, $key)) { //if it's a property of the object (must be same names)
                    $this->$key = $value; //set object's properties
                }
            }
        }

        public function create () {
            $columns = array ("uid", "name", "side", "order", "background", "fontColor");            $values = array ($_SESSION['uid'], $this->name, $this->side, $this->order, $this->background, $this->fontColor);
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
            $columns = array ("background", "fontColor");
            $values = array ($this->background, $this->fontColor);
            $dao = new SQL ();
            $success = $dao->update ($this->table, $columns, $values, $this->identifier, $this->mid);
            if ($success) {
                $this->message = "Module updated!";
            } else {
                $this->message = "Oops - an error occurred.";
            }
        }

        public function print_page ($user) {
            $dao = new SQL ();
            $left_side = $dao->select ("modules", array("uid", "side"), array($user->uid, 0), "sequence");
            $right_side = $dao->select ("modules", array("uid", "side"), array($user->uid, 1), "sequence");
            echo "<div style=\"width:30%; float:left\">";
            foreach ($left_side as $module) {
                $this->print_module ($user, $module);
            }
            echo "</div>";
            echo "<div style=\"width:30%; float:right\">";
            foreach ($right_side as $modules) {
                echo $modules[1];
            }
            echo "</div>";
        }

        public function print_module ($user, $module) {
            switch ($module[1]) {
            case "about me":
                $this->display_about_me ($user);
                break;
            case "contact":
                $this->display_contact ($user);
                break;
            case "friends":
                $this->dislpay_friends ($user);
                break;
            }
        }

        public function listAll () {
            $dao = new SQL ();
            return $dao->selectAll($this->table);
        }
        
        public function getName () {
            $this->get (array("uid"), array($this->uid));
            return $this->name;
        }
        
        //attempt at polymorphism
        public function display ($object, $location) {
            $class = get_class ($object);
            $type = $this->getName ($location);
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
        
        public function display_about_me ($user) { 
            $this->get(array("uid", "name"), array($user->uid, "about me")); ?>
        <div class="module" id="about_me" style="background:#<?php echo $this->background; ?>;color:#<?php echo $this->fontColor; ?>;">
                <h1 class="title">About Me</h1>
                <table>
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $user->fname.' '.$user->lname; ?></td>
                    </tr>
                    <tr>
                        <td>Bio:</td>
                        <td><?php echo $user->bio; ?></td>
                    </tr>
                    <tr>
                        <td>Relationship Status:</td>
                        <td><?php echo $user->rel; ?></td>
                    </tr>
                    <tr>
                        <td>Interests:</td>
                        <td><?php echo $user->interests; ?></td>
                    </tr>
                    <tr>
                        <td>Hobbies:</td>
                        <td><?php echo $user->hobbies; ?></td>
                    </tr>
                </table>
            </div>
        <?php }
        
        public function display_contact ($user) {
            $this->get(array("uid", "name"), array($user->uid, "contact")); ?>
        <div class="module" id="contact" style="background:#<?php echo $this->background; ?>;color:#<?php echo $this->fontColor; ?>;"?>
                <h1 class="title">Contact</h1>
                <table>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $user->email; ?></td>
                    </tr>
                </table>
            </div>
        <?php }
        
        //Replace this with a gallery view
        public function display_friends ($user) {
            $this->get(array("uid", "name"), array($user->uid, "friends")); ?>
            <div class="module" id="friends" style="background:#<?php echo $this->background; ?>;color:#<?php echo $this->fontColor; ?>;"?>
                <h1 class="title">Friends</h1>
                <table>
                    <?php foreach ($user->getFriends() as $id) : 
                        $user->get("uid", $id);
                    ?>
                    <tr>
                        <a href="profile.php?<?php echo $id; ?>" target="_self">
                        <td><img src="<?php echo $user->picture; ?>"></td>
                    </tr>
                    <tr>
                        <td><?php echo $user->fname." ".$user->lname; ?></td>
                    </tr>
                    </a>
                    <tr></tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php }
        
        public function display_posts ($user) {
            global $post;
            $this->get(array("uid", "name"), array($user->uid, "posts")); ?>
            <div class="module" id="posts" style="background:#<?php echo $this->background; ?>;color:#<?php echo $this->fontColor; ?>;"?>
                <h1 class="title">Posts</h1>
                <table>
                    <?php foreach ($post->display() as $p) : ?>
                    <tr>
                        <td><?php echo $p['dateTime']; ?></td>
                        <td><?php echo $p['content']; ?></td>
                    </tr>
                    </a>
                    <tr></tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php }
        
        
    }
?>

<?php

    require_once "../assets/functions.php";
    require_once "../user/user.php";
    require_once "../post/post.php";
    require_once "../work/work.php";
    require_once "../school/school.php";
    date_default_timezone_set("America/Los_Angeles");

    $post = new post ();
    $school = new school ();
    $work = new work();

    class module {
        //Properties
        public $name, $background, $fontColor, $side, $sequence;
        private $identifier = "mid";
        public $table = "modules";
        public $mid, $uid;
        
        //Methods
        public function module () {
            $this->uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : '';
        }
        
        public function get ($identifier=null, $id=null, $set=true) {
            if (empty($identifier)) $identifier = $this->identifier;
            if (empty($id)) $id = $this->mid;
            
            $dao = new SQL ();
            $results = $dao->select ($this->table, $identifier, $id);
            
            if (empty($results)) {
                echo "An error occurred - that module does not exist in the database.";
                return NULL;
            }
            
            if ($set) {
                foreach ($results[0] as $key => $value) {
                    if (property_exists($this, $key)) { //if it's a property of the object (must be same names)
                        $this->$key = $value; //set object's properties
                    }
                }
            }
            return $results;
        }

        public function create () {
            $columns = array ("uid", "name", "side", "sequence", "background", "fontColor");
            $values = array ($_SESSION['uid'], $this->name, $this->side, $this->order, $this->background, $this->fontColor);
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

        public function print_left ($user) {
            $dao = new SQL ();
            $left_side = $dao->select ("modules", array("uid", "side"), array($user->uid, 0), "sequence");
            foreach ($left_side as $module) {
                $this->print_module ($user, $module);
            }
        }

        public function print_right ($user) {
            $dao = new SQL ();
            $right_side = $dao->select ("modules", array("uid", "side"), array($user->uid, 1), "sequence");
            foreach ($right_side as $module) {
                $this->print_module ($user, $module);
            }
        }

        public function print_module ($user, $module) {
            switch ($module[2]) {
            case "about me":
                $this->display_about_me ($user);
                break;
            case "contact":
                $this->display_contact ($user);
                break;
            case "friends":
                $this->display_friends ($user);
                break;
            }
        }

        public function listAll () {
            $dao = new SQL ();
            return $dao->selectAll($this->table);
        }
        
        public function listModules ($uid=NULL) {
            $uid = empty($uid) ? $_SESSION['uid'] : $uid;
            return $this->get ('uid', $uid, false);
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
        <div class="module" id="about_me" style="background:<?php echo $this->background; ?>;color:<?php echo $this->fontColor; ?>;">
            <h1 class="title">About Me</h1>
            <table style="width:100%">
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
        <div class="module" id="contact" style="background:<?php echo $this->background; ?>;color:<?php echo $this->fontColor; ?>;">
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
            $friend = new user();
            $this->get(array("uid", "name"), array($user->uid, "friends")); ?>
            <div class="module" id="friends" style="background:<?php echo $this->background; ?>;color:<?php echo $this->fontColor; ?>;"?>
                <h1 class="title">Friends</h1>
                <table>
                    <?php foreach ($user->getFriends() as $id) : 
                        $friend->get("uid", $id);
                    ?>
                    <tr>
                        <a href="profile.php?<?php echo $id; ?>" target="_self">
                        <td><img src="<?php echo $friend->picture; ?>"></td>
                    </tr>
                    <tr>
                        <td><?php echo $friend->fname." ".$friend->lname; ?></td>
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
            <div class="module" id="posts" style="background:<?php echo $this->background; ?>;color:<?php echo $this->fontColor; ?>;"?>
                <h1 class="title">Posts</h1>
                <table>
                    <?php foreach ($post->display($user->uid) as $p) : ?>
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
        
        public function display_schools ($user) {
            global $school; 
            $this->get(array("uid", "name"), array($user->uid, "schools")); ?>
            <div class="module" id="schools" style="background:<?php echo $this->background; ?>;color:<?php echo $this->fontColor; ?>;"?>
                <h1 class="title">Schools</h1>
            <table>
                <?php foreach ($school->display($user->uid) as $s) : ?>
                <tr>
                    <td><b>Name:</b></td>
                    <td><?php echo $s['name']; ?></td>
                </tr>
                <tr>
                    <td><b>Type:</b></td>
                    <td><?php echo $s['type']; ?></td>
                </tr>
                <tr>
                    <td><b>Address:</b></td>
                    <td><?php echo $s['address']; ?></td>
                </tr>
                <tr>
                    <td><b>City:</b></td>
                    <td><?php echo $s['city']; ?></td>
                </tr>
                <tr>
                    <td><b>State:</b></td>
                    <td><?php echo $s['state']; ?></td>
                </tr>
                <tr>
                    <td><b>Zip Code:</b></td>
                    <td><?php echo $s['zipCode']; ?></td>
                </tr>
                <tr>
                    <td><b>Major:</b></td>
                    <td><?php echo $s['major']; ?></td>
                </tr>
                <tr>
                    <td><b>Minor:</b></td>
                    <td><?php echo $s['minor']; ?></td>
                </tr>
                <tr>
                    <td><b>Start Date:</b></td>
                    <td><?php echo $s['startDate']; ?></td>
                </tr>
                <tr>
                    <td><b>End Date:</b></td>
                    <td><?php echo $s['endDate']; ?></td>
                </tr>
                <tr>
                    <td><b>Degree:</b></td>
                    <td><?php echo $s['degree']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            </div>
        <?php }

        public function display_work ($user) {
            global $work;
            $this->get(array("uid", "name"), array($user->uid, "work")); ?>
            <div class="module" id="work" style="background:<?php echo $this->background; ?>;color:<?php echo $this->fontColor; ?>;"?>
                <h1 class="title">Work History</h1>
                <table>
                    <?php foreach ($work->display($user->uid) as $w) : ?>
                    <tr>
                        <td><b>Company:</b></td>
                        <td><?php echo $w['company']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Position:</b></td>
                        <td><?php echo $w['position']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Address:</b></td>
                        <td><?php echo $w['address']; ?></td>
                    </tr>
                    <tr>
                        <td><b>City:</b></td>
                        <td><?php echo $w['city']; ?></td>
                    </tr>
                    <tr>
                        <td><b>State:</b></td>
                        <td><?php echo $w['state']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Zip Code:</b></td>
                        <td><?php echo $w['zipCode']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Phone:</b></td>
                        <td><?php echo $w['phone']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Boss:</b></td>
                        <td><?php echo $w['boss']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Duties:</b></td>
                        <td><?php echo $w['duties']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Start Date:</b></td>
                        <td><?php echo $w['startDate']; ?></td>
                    </tr>
                    <tr>
                        <td><b>End Date:</b></td>
                        <td><?php if ($w["endDate"] == "0000-00-00") echo "Current"; else echo $w['endDate']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
        <?php }
        
        
    }
?>

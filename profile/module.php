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
        public $name, $background, $fontColor, $side, $sequence, $font_normal, $font_header;
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
            $columns = array ("uid", "name", "side", "sequence", "background", "fontColor", "font_normal", "font_header");
            $values = array ($_SESSION['uid'], $this->name, $this->side, $this->order, $this->background, $this->fontColor, $this->font_normal, $this->font_header);
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
            $columns = array ("background", "fontColor", "font_normal", "font_header");
            $values = array ($this->background, $this->fontColor, $this->font_normal, $this->font_header);
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
            $this->display_profile_background($user);
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
            case "profile picture":
                $this->display_profile_picture ($user);
                break;
            case "about me":
                $this->display_about_me ($user);
                break;
            case "contact":
                $this->display_contact ($user);
                break;
            case "friends":
                $this->display_friends ($user);
                break;
            case "posts":
                $this->display_posts ($user);
                break;
            case "schools":
                $this->display_schools ($user);
                break;
            case "work":
                $this->display_work ($user);
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
        
        public function display_about_me ($user) { 
            $this->get(array("uid", "name"), array($user->uid, "about me")); ?>
            <div class="module" id="about_me" style="font-size:<?php echo $this->font_normal; ?>;background<?php echo substr($this->background, 0, 1) == "#" ? ':'.$this->background : "-image: url('".$this->background."')"; ?>;color:<?php echo $this->fontColor; ?>;">
                <?php if ($user->uid == $user->getUser()) : ?>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='../user/edit.php'">Edit</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='../profile/edit.php?m=about_me'">Personalize</button>
                <?php endif; ?>
                <h1 class="title" style="font-size:<?php echo $this->font_header; ?>">About Me</h1>
                <table class="about_me">
                    <tr class="name">
                        <td class="bolden">Name:</td>
                        <td><?php echo $user->fname.' '.$user->lname; ?></td>
                    </tr>
                    <tr class="bio">
                        <td class="bolden">Bio:</td>
                        <td><?php echo $user->bio; ?></td>
                    </tr>
                    <tr class="rel">
                        <td class="bolden">Relationship Status:</td>
                        <td><?php echo $user->rel; ?></td>
                    </tr>
                    <tr class="interests">
                        <td class="bolden">Interests:</td>
                        <td><?php echo $user->interests; ?></td>
                    </tr>
                    <tr class="hobbies">
                        <td class="bolden">Hobbies:</td>
                        <td><?php echo $user->hobbies; ?></td>
                    </tr>
                </table>
            </div>
        <?php }
        
        public function display_contact ($user) {
            $this->get(array("uid", "name"), array($user->uid, "contact")); ?>
            <div class="module" id="contact" style="font-size:<?php echo $this->font_normal; ?>;background<?php echo substr($this->background, 0, 1) == "#" ? ':'.$this->background : "-image: url('".$this->background."')"; ?>;color:<?php echo $this->fontColor; ?>;">
                <?php if ($user->uid == $user->getUser()) : ?>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='../user/edit.php'">Edit</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='../profile/edit.php?m=contact'">Personalize</button>
                <?php endif; ?>
                <h1 class="title" style="font-size:<?php echo $this->font_header; ?>">Contact</h1>
                <table>
                    <tr>
                        <td class="bolden">Email:</td>
                        <td><?php echo $user->email; ?></td>
                    </tr>
                </table>
            </div>
        <?php }
        
        //Replace this with a gallery view
        public function display_friends ($user) {
            $friend = new user();
            $this->get(array("uid", "name"), array($user->uid, "friends")); ?>
            <div class="module" id="friends" style="font-size:<?php echo $this->font_normal; ?>;background<?php echo substr($this->background, 0, 1) == "#" ? ':'.$this->background : "-image: url('".$this->background."')"; ?>;color:<?php echo $this->fontColor; ?>;"?>
                <?php if ($user->uid == $user->getUser()) : ?>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='../profile/edit.php?m=friends'">Personalize</button>
                <?php endif; ?>
                <h1 class="title" style="font-size:<?php echo $this->font_header; ?>">Friends</h1>
                    <?php foreach ($user->getFriends() as $id) : 
                        $friend->get("uid", $id);
                    ?>
                    <table class='friend'>
                    <tr>
                        <td><a target="_self"><?php $this->display_picture($friend->picture); ?></a></td>
                    </tr>
                    <tr>
                        <td><button class="btn btn-primary" onclick="window.location.href='profile.php?u=<?php echo $id; ?>'"><?php echo $friend->fname." ".$friend->lname; ?></a><br>
                        <button type="button" class="btn btn-danger" onclick="deleteFn('../user/unFriend.php?f=<?php echo $id; ?>')">UnFriend</button></td>
                    </tr>
                    </table>
                    <?php endforeach; ?>
            </div>
        <?php }
        
        public function display_posts ($user) {
            global $post;
            $this->get(array("uid", "name"), array($user->uid, "posts")); ?>
            <div class="module" id="posts" style="font-size:<?php echo $this->font_normal; ?>;background<?php echo substr($this->background, 0, 1) == "#" ? ':'.$this->background : "-image: url('".$this->background."')"; ?>;color:<?php echo $this->fontColor; ?>;"?>
                <?php if ($user->uid == $user->getUser()) : ?>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='../profile/edit.php?m=posts'">Personalize</button>
                <?php endif; ?>
                <h1 class="title" style="font-size:<?php echo $this->font_header; ?>">Posts</h1>
                <table class='posts table table-striped table-hover'>
                    <tbody>
                    <?php foreach ($post->display($user->uid) as $p) : ?>
                    <tr class='postContent'>
                        <td><?php echo $p['content']; ?></td>
                        <?php if ($user->uid == $user->getUser()) : ?>
                            <td id="edit_post"><button type="button" class="btn btn-primary" onclick="window.location.href='../post/edit.php?p=<?php echo $p["pid"]; ?>&u'">Edit</button></td>
                        <?php endif; ?>
                    </tr>
                    <tr class='postDate'>
                        <td><?php echo formatDate($p['dateTime']); ?></td>
                        <td></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php }
        
        public function display_schools ($user) {
            global $school; 
            $this->get(array("uid", "name"), array($user->uid, "schools")); ?>
            <div class="module" id="schools" style="font-size:<?php echo $this->font_normal; ?>;background<?php echo substr($this->background, 0, 1) == "#" ? ':'.$this->background : "-image: url('".$this->background."')"; ?>;color:<?php echo $this->fontColor; ?>;"?>
                <?php if ($user->uid == $user->getUser()) : ?>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='../profile/edit.php?m=schools'">Personalize</button>
                <?php endif; ?>
                <h1 class="title" style="font-size:<?php echo $this->font_header; ?>">Schools</h1>
                <table>
                    <?php foreach ($school->display($user->uid) as $s) : ?>
                    <tr>
                        <?php if ($user->uid == $user->getUser()) : ?>
                            <td><button type="button" class="btn btn-primary" onclick="window.location.href='../school/edit.php?s=<?php echo $s['sid']; ?>&u'">Edit</button></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td class="bolden">Name:</td>
                        <td><?php echo $s['name']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Type:</td>
                        <td><?php echo $s['type']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Address:</td>
                        <td><?php echo $s['address']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">City:</td>
                        <td><?php echo $s['city']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">State:</td>
                        <td><?php echo $s['state']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Zip Code:</td>
                        <td><?php echo $s['zipCode']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Major:</td>
                        <td><?php echo $s['major']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Minor:</td>
                        <td><?php echo $s['minor']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Start Date:</td>
                        <td><?php echo formatDate2($s['startDate']); ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">End Date:</td>
                        <td><?php echo formatDate2($s['endDate']); ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Degree:</td>
                        <td><?php echo $s['degree']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php }

        public function display_work ($user) {
            global $work;
            $this->get(array("uid", "name"), array($user->uid, "work")); ?>
            <div class="module" id="work" style="font-size:<?php echo $this->font_normal; ?>;background<?php echo substr($this->background, 0, 1) == "#" ? ':'.$this->background : "-image: url('".$this->background."')"; ?>;color:<?php echo $this->fontColor; ?>;"?>
                <?php if ($user->uid == $user->getUser()) : ?>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='../profile/edit.php?m=work'">Personalize</button>
                <?php endif; ?>
                <h1 class="title" style="font-size:<?php echo $this->font_header; ?>">Work History</h1>
                <table>
                    <?php foreach ($work->display($user->uid) as $w) : ?>
                    <tr>
                        <?php if ($user->uid == $user->getUser()) : ?>
                            <td><button type="button" class="btn btn-primary" onclick="window.location.href='../work/edit.php?w=<?php echo $w['wid']; ?>&u'">Edit</button></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td class="bolden">Company:</td>
                        <td><?php echo $w['company']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Position:</td>
                        <td><?php echo $w['position']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Address:</td>
                        <td><?php echo $w['address']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">City:</td>
                        <td><?php echo $w['city']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">State:</td>
                        <td><?php echo $w['state']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Zip Code:</td>
                        <td><?php echo $w['zipCode']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Phone:</td>
                        <td><?php echo $w['phone']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Boss:</td>
                        <td><?php echo $w['boss']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Duties:</td>
                        <td><?php echo $w['duties']; ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">Start Date:</td>
                        <td><?php echo formatDate2($w['startDate']); ?></td>
                    </tr>
                    <tr>
                        <td class="bolden">End Date:</td>
                        <td><?php if ($w["endDate"] == "0000-00-00") echo "Current"; else echo formatDate2($w['endDate']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php }

        public function display_picture ($picture) { ?>
            <img src="<?php echo empty($picture) ? "../assets/icons/default.png" : $picture; ?>" class='img-responsive profile-image'>
        <?php }
        
        public function display_thumbnail ($picture) { ?>
            <img src="<?php echo empty($picture) ? "../assets/icons/default.png" : $picture; ?>" class='img-responsive profile-image thumb thumbnail'>
        <?php }
        
        public function display_profile_picture ($user) {
            $this->get(array("uid", "name"), array($user->uid, "profile picture")); ?>
            <div class="module" id="profile_picture" style="font-size:<?php echo $this->font_normal; ?>;background<?php echo substr($this->background, 0, 1) == "#" ? ':'.$this->background : "-image: url('".$this->background."')"; ?>;color:<?php echo $this->fontColor; ?>;">
                <?php if ($user->uid == $user->getUser()) : ?>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='../user/edit.php'">Edit</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='../profile/edit.php?m=profile_picture'">Personalize</button>
                <?php endif; ?>
                <h1 class="title" style="font-size:<?php echo $this->font_header; ?>"><?php echo $user->fname." ".$user->lname; ?></h1>
                <table class="profile_picture">
                    <tr>
                        <td><?php $this->display_picture ($user->picture); ?></td>
                    </tr>
                </table>
            </div>
        <?php }
        
        public function display_profile_background ($user) {
            $this->get(array("uid", "name"), array($user->uid, "profile background")); ?>
            <script type="text/javascript">
                <?php if (substr($this->background, 0, 1) == "#") : ?>
                    document.getElementsByTagName("body")[0].style.background = "<?php echo $this->background; ?>";
                <?php else : ?>
                    document.body.style.backgroundImage="url('<?php echo $this->background; ?>')";
                <?php endif; ?>
                document.getElementsByTagName("body")[0].style.color = "<?php echo $this->fontColor; ?>";
            </script>
        <?php }
        
    }
?>

<?php
    
    include_once "../Layout/header.php";

    $dao = new SQL ();

    if (isset($_FILES['picture'])) {
        $user->picture = saveFile ('picture', "../assets/$user->email");
        if ($dao->update ("users", ["picture"], [$user->picture], "uid", $user->uid)) {}
    } else {
        if ($dao->update ("users", ["picture"], ["../assets/icons/default.png"], "uid", $user->uid)) {}
    }

?>

    <title>About You</title>
</head>
<body>
    <?php nav_bar(); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-2 col-xs-8">
                <div class="rounded" style="background-color: #EEE">
                    <h1>Tell us about yourself...</h1>
                    <form class="form-horizontal" action="aboutschool.php" method="POST" enctype="multipart/form-data" role="form" style="padding-top: 10px">
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="Biography">Biography</label>
                            <div class="col-xs-8">
                                <textarea class="form-control" name="bio" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="Interests">Interests</label>
                            <div class="col-xs-8">
                                <textarea class="form-control" name="int" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="Hobbies">Hobbies</label>
                            <div class="col-xs-8">
                                <textarea class="form-control" name="hob" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="radio col-xs-12" style="padding-bottom: 10px; padding-top: 0px">
                            <label class="radio-inline" for="single"><input type="radio" name="rel" value="Single">Single</label>
                            <label class="radio-inline" for="taken"><input type="radio" name="rel" value="Taken">Taken</label>
                        </div>
                        <div class="col-xs-offset-4 col-xs-4" style="padding-bottom: 10px !important;">
                            <select class="form-control" name="privacy">
                                <option value="Public, not signed in">Public, not signed in</option>
                                <option value="Public, signed in">Public, signed in users</option>
                                <option value="Friends only">Friends Only</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-4">
                                <button class="btn btn-success" style="margin: 0px !important" type="submit">Submit</button>
                            </div>
                            <div class="col-xs-4" style="padding-top: 6px">
                                <a href="aboutschool.php">Skip</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

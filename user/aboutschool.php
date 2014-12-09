<?php

    include_once "../Layout/header.php";
    $dao = new SQL();
    $user->interests = test_input($_POST['int']);
    $user->bio = test_input($_POST['bio']);
    $user->hobbies = test_input($_POST['hob']);
    if (empty($_POST['rel'])) {
        $user->rel = "Single";
    } else {
        $user->rel = test_input($_POST['rel']);
    }
    if (empty($_POST['privacy'])) {
        $user->privacy = "Friends only";
    } else {
        $user->privacy = test_input($_POST['privacy']);
    }

    if ($dao->update ("users", ['interests'], [$user->interests], "uid", $user->uid)) {}
    if ($dao->update ("users", ['bio'], [$user->bio], "uid", $user->uid)) {}
    if ($dao->update ("users", ['hobbies'], [$user->hobbies], "uid", $user->uid)) {}
    if ($dao->update ("users", ['rel'], [$user->rel], "uid", $user->uid)) {}
    if ($dao->update ("users", ['privacy'], [$user->privacy], "uid", $user->uid)) {}

    $states = ["AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY"];

    $degrees = ["N/A", "GED", "High School Diploma", "A.A.", "A.S.", "A.A.S.", "A.E.", "A.A.A.", "A.P.S.", "B.S.", "B.A.", "B.F.A.", "B.B.A.", "B.Arch.", "M.A.", "M.S.", "M.Res.", "M.Phil.", "LL.M.", "M.B.A.", "PhD", "M.D.", "Ed.D.", "J.D.", "D.O."];

?>
    <title>Your Schools</title>
</head>
<body>
    <?php nav_bar(); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-2 col-xs-8">
                <div class="rounded" style="background-color: #EEE">
                    <h1>Where did you go to school?</h1>
                    <form class="form-horizontal" action="aboutwork.php" method="POST" enctype="multipart/form-data" role="form" style="padding-top: 10px">
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Name">Name:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Type">Type:</label>
                            <div class="col-xs-4">
                                <select class="form-control" name="type">
                                    <option value="University/College">University/College</option>
                                    <option value="High School">High School</option>
                                    <option value="Elementary School">Elementary School</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Address">Address:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="City">City:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="city">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="State">State:</label>
                            <div class="col-xs-4">
                                <select class="form-control" name="state">
                                    <?php
                                        foreach ($states as $s) {
                                            print "<option value=\"".$s."\">".$s."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Zip Code">Zip Code:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="number" name="zipcode">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Major">Major:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="major">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Minor">Minor:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="minor">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Degree">Degree:</label>
                            <div class="col-xs-4">
                                <select class="form-control" name="degree">
                                    <?php
                                        foreach ($degrees as $d) {
                                            print "<option value=\"".$d."\">".$d."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Start Date">Start Date:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="date" name="startdate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="End Date">End Date:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="date" name="enddate">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-4 col-xs-1">
                                <button class="btn btn-success" style="margin: 0px !important" type="submit">Submit</button>
                            </div>
                            <div class="col-xs-4" style="padding-top: 6px">
                                <a href="aboutwork.php">Skip</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

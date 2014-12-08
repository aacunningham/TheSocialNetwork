<?php

    include_once "../Layout/header.php";

    if (isset($_POST['name'])) {
        $school->name = test_input($_POST['name']);
        $school->type = test_input($_POST['type']);
        $school->address = test_input($_POST['address']);
        $school->city = test_input($_POST['city']);
        $school->state = test_input($_POST['state']);
        $school->zipCode = test_input($_POST['zipCode']);
        $school->startDate = test_input($_POST['startDate']);
        $school->endDate = test_input($_POST['endDate']);
        $school->major = test_input($_POST['major']);
        $school->minor = test_input($_POST['minor']);
        $school->degree = test_input($_POST['degree']);
        $school->create ();
    }

    $states = ["AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY"];

?>

    <title>Your Work</title>
</head>
<body>
    <?php nav_bar(); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-2 col-xs-8">
                <div class="rounded" style="background-color: #EEE">
                    <h1>Where do you work?</h1>
                    <form class="form-horizontal" action="security.php" method="POST" enctype="multipart/form-data" role="form" style="padding-top: 10px">
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Company">Company:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="company">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Position">Position:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="position">
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
                                <input class="form-control" type="number" name="zipCode">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Phone">Phone:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Boss">Boss:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="boss">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Duties">Duties:</label>
                            <div class="col-xs-4">
                                <textarea class="form-control" name="duties" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="Start Date">Start Date:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="date" name="startDate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-2 col-xs-2 control-label" for="End Date">End Date:</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="date" name="endDate">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-4 col-xs-1">
                                <button class="btn btn-success" style="margin: 0px !important" type="submit">Submit</button>
                            </div>
                            <div class="col-xs-4" style="padding-top: 6px">
                                <a href="security.php">Skip</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

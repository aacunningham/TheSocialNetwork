<?php

    include_once "../Layout/header.php";

    if (isset($_POST['company'])) {
        $work->company = test_input($_POST['company']);
        $work->position = test_input($_POST['position']);
        $work->address = test_input($_POST['address']);
        $work->city = test_input($_POST['city']);
        $work->state = test_input($_POST['state']);
        $work->zipCode = test_input($_POST['zipCode']);
        $work->startDate = test_input($_POST['startDate']);
        $work->endDate = test_input($_POST['endDate']);
        $work->phone = test_input($_POST['phone']);
        $work->boss = test_input($_POST['boss']);
        $work->duties = test_input($_POST['duties']);
        $work->create ();
    }
    
    $all_tables = ['blogs', 'folders', 'posts', 'schools', 'security_questions', 'workplaces'];
?>

    <title>Security</title>
</head>
<body>
    <?php nav_bar(); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-2 col-xs-8">
                <div class="rounded" style="background-color: #EEE">
                    <h1>Set a security question</h1>
                    <div class="row">
                        <div class="col-xs-offset-3 col-xs-6">
                            <p>Please enter a security question and an answer, in case you forget your password. Make sure your answer is memorable!</p>
                        </div>
                    </div>
                    <form class="form-horizontal" action="complete.php" method="POST" enctype="multipart/form-data" role="form" style="padding-top: 10px">
                        <div class="form-group">
                            <label class="col-xs-offset-1 col-xs-2" for="Security Question">Security Question:</label>
                            <div class="col-xs-6">
                                <input required class="form-control" type="text" name="question">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-offset-1 col-xs-2" style="margin-top: 8px" for="Answer">Answer:</label>
                            <div class="col-xs-4">
                                <input required class="form-control" type="text" name="answer">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button class="btn btn-success" style="margin: 0px !important" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

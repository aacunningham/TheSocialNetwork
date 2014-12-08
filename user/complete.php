<?php

    include_once "../Layout/header.php";

    if (isset($_POST['question'])) {
        $dao = new SQL ();
        $columns = ['uid', 'challenge', 'answer'];
        $values = [$user->uid, test_input($_POST['question']), password_hash($_POST['answer'], PASSWORD_BCRYPT)];
        if ($dao->insert('security_questions', $columns, $values)) {}
    }

?>

    <title>Your Account is Set!</title>
</head>
<body>
    <?php nav_bar(); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-2 col-xs-8">
                <div class="rounded" style="background-color: #EEE">
                    <div class="row">
                        <div class="col-xs-12">
                            <h1>You're all set up!</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-offset-3 col-xs-6">
                            <p>Now that your account is setup and ready to go, click below to access your home page!</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-success" onclick="window.location.href='../profile/home.php'">Home!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

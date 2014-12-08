<?php

    require_once "../Layout/header.php";
    
    if (isset($_POST['submit'])) { //if login info submitted
       $user->password = test_input($_POST['password']);
       $user->email = test_input($_POST['email']);
       $user->login (); //log the user in
    }
    if ($user->loggedIn()) { ?>
        <script type="text/javascript">
            redirect ("../profile/home.php"); //redirect to user interface after login
        </script>
    <?php }

    if (isset($_POST['fname'])) {
        $dao = new SQL();
        $result = $dao->select ('users', 'email', test_input($_POST['email']));
        if (isset($result[0])) {
            $user->message = "That email is already taken, please use another one.";
        } else {
            $user->password = test_input($_POST['password0']);
            $user->email = test_input($_POST['email']);
            $user->fname = test_input($_POST['fname']);
            $user->lname = test_input($_POST['lname']);
            $user->create ();
            $user->login ();
            header ("Location: addphoto.php");
        }
    }
?>

<!-- Title -->
<title>Login</title>
</head>

<body>
<?php nav_bar(); ?>
    <div class="container">
        <!-- Errors -->
        <?php if (!empty($user->message)) : ?>
            <h3><?php echo $user->message; ?></h3>
        <?php endif; ?>

        <!-- Login Form -->
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <h1>Create an account!</h1>
                <form class="form-horizontal" action="login.php" method="POST" enctype="multipart/form-data" role="form" id="registrationForm">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="form-group some-gutter">
                                <input name="fname" class="form-control" type="text" placeholder="First Name"
                                    data-bv-notempty="true"
                                    data-bv-notempty-message="Your first name is required and cannot be empty"

                                    data-bv-regexp="true"
                                    data-bv-regexp-regexp="^[a-zA-Z]+$"
                                    data-bv-regexp-message="Your name can only consist of letters within the alphabet" />
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="form-group some-gutter">
                                <input name="lname" class="form-control" type="text" placeholder="Last Name"
                                    data-bv-notempty="true"
                                    data-bv-notempty-message="Your last name is required and cannot be empty"

                                    data-bv-regexp="true"
                                    data-bv-regexp-regexp="^[a-zA-Z]+$"
                                    data-bv-regexp-message="Your name can only consist of letters within the alphabet" />
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group some-gutter">
                                <input name="email" class="form-control" type="email" placeholder="Email Address"
                                    data-bv-notempty="true"
                                    data-bv-notempty-message="Your email is required and cannot be empty"

                                    data-bv-emailaddress="true"
                                    data-bv-emailaddress-message="The email address is not valid" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group some-gutter">
                                <input name="password0" class="form-control" type="password" placeholder="Enter Password"
                                    data-bv-notempty="true"
                                    data-bv-notempty-message="Your password is required and cannot be empty"

                                    data-bv-stringlength="true"
                                    data-bv-stringlength-min="6"
                                    data-bv-stringlength-message="Your password must be longer than 6 characters" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group some-gutter">
                                <input name="password1" class="form-control" type="password" placeholder="Re-enter Password"
                                    data-bv-notempty="true"
                                    data-bv-notempty-message="Your password is required and cannot be empty"

                                    data-bv-identical="true"
                                    data-bv-identical-field="password0"
                                    data-bv-identical-message="Your passwords do not match" />
                            </div>
                        </div>
                        <div class="col-xs-12"><button class="btn btn-success" type="submit" name="create" value="submit">Continue!</button></div>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <script src="../Layout/js/bootstrapValidator.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registrationForm').bootstrapValidator();
        });
    </script>

</body>

<?php
    require_once "../Layout/header.php";
	
    if (isset($_POST['sub'])) { //change password submitted
        if (test_input($_POST['password0']) == test_input($_POST['password1'])) {
            $user->password = test_input(password_hash($_POST['password0'], PASSWORD_BCRYPT));
            $success = $user->update_password();
        } else {
            $user->message = "Error: passwords don't match";
        }
		
		if ($success) {
			header('Location: ../profile/home.php');	//send to users page
		}
    }	
?>
    <title>Change Password</title>
</head>
<body>
    <?php nav_bar(); ?>

    <!-- Heading -->
    <h1>Change password</h1>

    <?php if (!empty($user->message)) : ?>
        <h3><?php echo $user->message; ?></h3>
    <?php endif; ?>
    
    <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="change_password_form">
        <div class="form-group col-xs-offset-4 col-xs-4">
            <input class="form-control" type="password" name="password0" placeholder="Password"
                data-bv-notempty="true"
                data-bv-notempty-message="Your password is required and cannot be empty"

                data-bv-stringlength="true"
                data-bv-stringlength-min="6"
                data-bv-stringlength-message="Your password must be longer than 6 characters" >
        </div>
        <div class="form-group col-xs-offset-4 col-xs-4">
            <input class="form-control" type="password" name="password1" placeholder="Retype Password"
                data-bv-notempty="true"
                data-bv-notempty-message="Your password is required and cannot be empty"

                data-bv-identical="true"
                data-bv-identical-field="password0"
                data-bv-identical-message="Your passwords do not match!" >
        <div class="form-group col-xs-12">
            <button class="btn btn-success" type="submit" name="sub">Change</button>
        </div>
    </form>
    <script src="../Layout/js/bootstrapValidator.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#change_password_form').bootstrapValidator();
    });
    </script>
</body>

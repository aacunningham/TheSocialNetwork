<?php
    require_once "../Layout/header.php";
    
    if (isset($_POST['email'])) {
       $user->email = test_input($_POST['email']);
       $check_res = $user->forgot_password(); 	//User submits email for account check
       if( $check_res ) {
       		header('Location: password_challenge.php');
       		/*echo "Found User";
			echo "User ID ", $_SESSION['uid'], ":", $user->uid, ":";
			$result = $user->get_challenge_question();
			echo $result[0]['uid'];
			echo $result[0]['challenge'];
			echo $result[0]['answer'];
			echo $user->message;*/
       }
	}
?>
    <title>Forgot Password?</title>
</head>
<body>
    <?php nav_bar() ?>
    <?php if (!empty($user->message)) : ?>
        <h3><?php echo $user->message; ?></h3>
    <?php endif; ?>
    <div class="row">
        <div class="col-xs-12">
            <h1>Forgot my password</h1>
        </div>
        <div class="col-xs-12">
            <h3>Please don't forget your password again, it's a lot of work for me...</h3>
        </div>
        <form class="form"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
            <div class="form-group col-xs-offset-4 col-xs-3" style="padding-top: 10px">
                <input required class="form-control" type="email" name="email" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>" placeholder="Email">
            </div>
            <!-- Submit -->
            <div class="form-group col-xs-1">
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

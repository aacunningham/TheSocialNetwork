<?php

    require_once "../Layout/header.php";
	if(!isset($_SESSION['attempts'])) {
		$_SESSION['attempts'] = 0;
	}

	$result = $user->get_challenge_question();
	$answer_solution = $result[0]['answer'];
	
	/*echo $result[0]['uid'];
	echo $result[0]['challenge'];
	echo $result[0]['answer'];*/
			
    if (isset($_POST['submit'])) {
    	$submit_answer = test_input($_POST['challenge_answer']);
		
		if (password_verify($submit_answer, $answer_solution)) {
			header('Location: /user/change_password.php');	//on a successful question go to the change password page
		}else{
			$_SESSION['attempts'] += 1;				//count bad attempts
			echo $_SESSION['attempts'];
		}
		if( $_SESSION['attempts'] >= 5) {			//after so many failures destroy the session
			session_destroy();						//and return to the landing page
			header('Location: ../post/login.php');
		}
	}			
?>
    <title>Challenge Question</title>
</head>
<body>
    <?php nav_bar() ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Security Question</h1>
            </div>
            <div class="col-xs-12">
                <h3><?php echo $result[0]['challenge']?></h2>
            </div>
            <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
                <div class="form-group col-xs-offset-4 col-xs-3" style="padding-top: 10px">
                    <input required class="form-control" type="password" name="challenge_answer" value="<?php if (!empty($_POST['challenge_answer'])) echo $_POST['challenge_answer']; ?>" placeholder="Answer">
                </div>
                <div class="form-group col-xs-1">
                    <button class="btn btn-success" type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Heading -->

</body>

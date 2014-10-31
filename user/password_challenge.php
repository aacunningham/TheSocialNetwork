<?php if (!empty($_SESSION['uid'])) : ?>
    <!-- Back Navigtion -->
    <a href="interface.php" target="_self">Home</a>
<?php endif; ?>

<?php
    require_once "../layout/header.php";
	if(!isset($_SESSION['attempts'])) {
		$_SESSION['attempts'] = 0;
	}

	$result = $user->get_challenge_question();
	$answer_solution = $result[0]['answer'];
	
	/*echo $result[0]['uid'];
	echo $result[0]['challenge'];
	echo $result[0]['answer'];*/
			
    if (!empty($_POST['submit'])) {
    	$submit_answer = test_input($_POST['challenge_answer']);
		
		if ($submit_answer == $answer_solution) {
			header('Location: /user/change_password.php');	//on a successful question go to the change password page
		}else{
			$_SESSION['attempts'] += 1;				//count bad attempts
			echo $_SESSION['attempts'];
		}
		if( $_SESSION['attempts'] >= 5) {			//after so many failures destroy the session
			session_destroy();						//and return to the landing page
			header('Location: /user/login.php');
		}
	}			
?>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Security Question</h1>
<h2><?php echo $result[0]['challenge']?></h2>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Email -->
        <tr>
            <td><b>Answer:<b></td>
            <td><input required type="text" name="challenge_answer" value="<?php if (!empty($_POST['challenge_answer'])) echo $_POST['challenge_answer']; ?>"></td>
        </tr>
            
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit" value="Submit"></td>
        </tr>
    </table>
</form>

<!-- a href="login.php" target="_self">Login.</a> -->
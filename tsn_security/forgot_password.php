<?php if (!empty($_SESSION['uid'])) : ?>
    <!-- Back Navigtion -->
    <a href="interface.php" target="_self">Home</a>
<?php endif; ?>

<!-- Errors -->
<?php if (!empty($user->message)) : ?>
    <h3><?php echo $user->message; ?></h3>
<?php endif; ?>

<?php
    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) {
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

<!-- Back Navigtion -->
<button type="button" class="btn btn-primary" onclick="window.location.href='../user/login.php'">Back</button>

<!-- Heading -->
<h1>Forgot my password</h1>
<h3>Please don't forget your password again, it's a lot of work for me...</h3>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Email -->
        <tr>
            <td><b>Email:<b></td>
            <td><input required type="email" name="email" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>"></td>
        </tr>
            
        <!-- Submit -->
        <tr>
            <td><button type="submit" class="btn btn-success" name="submit" value="Reset Password">Reset Password</button></td>
        </tr>
    </table>
</form>

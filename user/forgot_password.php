<?php if (!empty($_SESSION['uid'])) : ?>
    <!-- Back Navigtion -->
    <a href="interface.php" target="_self">Home</a>
<?php endif; ?>

<!-- Errors -->
<?php if (!empty($user->message)) : ?>
    <h3><?php echo $user->messa;ge; ?></h3>
<?php endif; ?>

<?php
    require_once "../layout/header.php";
    
    if (!empty($_POST['submit'])) {
       $user->email = test_input($_POST['email']);
       $check_res = $user->forgot_password(); 	//User submits email for account check
       if( $check_res ) {
       		echo "found";
       } else {
       	echo "not found";
       }
	}
?>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

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
            <td><input type="submit" name="submit" value="Send New Password"></td>
        </tr>
    </table>
</form>

<?php
//<a href="login.php" target="_self">Login.</a>
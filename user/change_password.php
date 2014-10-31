<?php if (!empty($_SESSION['uid'])) : ?>
    <!-- Back Navigtion -->
    <a href="interface.php" target="_self">Home</a>
<?php endif; ?>

<?php
    require_once "../layout/header.php";
	
    if (!empty($_POST['submit'])) { //change password submitted
        if (test_input($_POST['password1']) == test_input($_POST['password2'])) {
            $user->password = test_input(password_hash($_POST['password1'], PASSWORD_BCRYPT));
            $success = $user->update_password();
        } else {
            $user->message = "Error: passwords don't match";
        }
		
		if ($success ) {
			header('Location: /user/interface.php');	//send to users page
		}
    }	
?>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Change password</h1>

<!-- Errors -->
<?php if (!empty($user->message)) : ?>
    <h3><?php echo $user->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Password -->
        <tr>
            <td><b>Password:</b></td>
            <td><input required type="password" name="password1"></td>
        </tr>
        
        <!-- Retype Password -->
        <tr>
            <td><b>Retype Password:</b></td>
            <td><input required type="password" name="password2"></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

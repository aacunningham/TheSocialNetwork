<?php

    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //if login info submitted
       $user->password = test_input($_POST['password']);
       $user->email = test_input($_POST['email']);
       $user->login (); //log the user in
       if ($user->loggedIn()) { ?>
           <script type="text/javascript">
               redirect ("interface.php"); //redirec to user interface after login
           </script>
   <?php }
    }
?>

<!-- Title -->
<title>Login</title>

<?php if (!empty($_SESSION['uid'])) : ?>
    <!-- Back Navigtion -->
    <a href="interface.php" target="_self">Home</a>
<?php endif; ?>

<!-- Heading -->
<h1>Login</h1>

<!-- Errors -->
<?php if (!empty($user->message)) : ?>
    <h3><?php echo $user->message; ?></h3>
<?php endif; ?>

<!-- Login Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Email -->
        <tr>
            <td><b>Email:<b></td>
            <td><input required type="email" name="email" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>"></td>
        </tr>
        
        <!-- Password -->
        <tr>
            <td><b>Password:</b></td>
            <td><input required type="password" name="password"></td>
        </tr>
    
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit" value="Login"></td>
        </tr>
    </table>
</form>

<a href="new.php" target="_self">Create an account.</a>
<a href="../security/forgot_password.php" target="_self"> Forgot password.</a>

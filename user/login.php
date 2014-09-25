<?php

    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    require_once "user.php";
    
    $user = new user ();
    
    if (!empty($_POST['submit'])) {
       $user->password = test_input($_POST['password']);
       $user->email = test_input($_POST['email']);
       $user->login ();
       if ($user->loggedIn()) { ?>
           <script type="text/javascript">
               redirect ("interface.php");
           </script>
   <?php }
    }
?>

<!-- Title -->
<title>Login</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Login</h1>

<?php if (!empty($user->message)) : ?>
    <h3><?php echo $user->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
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
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

<a href="new.php" target="_self">Create an account.</a>

<?php if (!empty($_SESSION['uid'])) : ?>
    <!-- Back Navigtion -->
    <a href="interface.php" target="_self">Home</a>
<?php endif; ?>

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
            <td><input type="submit" name="submit" value="Login"></td>
        </tr>
    </table>
</form>
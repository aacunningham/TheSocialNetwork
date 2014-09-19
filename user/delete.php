<?php
    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    $user->delete ();
    if (empty($_SESSION['uid'])) { ?>
        <script type="text/javascript">
            redirect("login.php"); //redirect to landing page
        </script>
    <?php }
?>
    
<!-- Title -->
<title>Delete User</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Delete User</h1>

<?php if (!empty($user->message)) : ?>
    <h3><?php echo $user->message; ?></h3>
<?php endif; ?>
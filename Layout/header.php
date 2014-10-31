<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once "../config/config.php";
    require_once "../assets/functions.php";
    require_once "../user/user.php";
    require_once "../post/post.php";
    require_once "../blog/blog.php";
    require_once "../folder/folder.php";
    require_once "../category/category.php";
    require_once "../profile/module.php";

    $user = new user ();
    $post = new post ();
    $blog = new blog ();
    $folder = new folder ();
    $category = new category ();
    $module = new module ();

    if (!$user->loggedIn() and $_SERVER['PHP_SELF'] != "/user/login.php" 
    	and $_SERVER['PHP_SELF'] != "/user/new.php" 
    	and $_SERVER['PHP_SELF'] != "/security/forgot_password.php"
		and $_SERVER['PHP_SELF'] != "/security/password_challenge.php"
		and $_SERVER['PHP_SELF'] != "/user/change_password.php") { ?>
        <script type="text/javascript">
            redirect ("../user/login.php");
        </script>
    <?php } ?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="../Layout/style.css">
</head>

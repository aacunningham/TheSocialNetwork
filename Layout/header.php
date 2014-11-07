<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../Layout/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Layout/style.css">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
    <script src="../Layout/js/jquery-1.11.1.min.js"></script>
    <script src="../Layout/js/bootstrap.min.js"></script>
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
    require_once "../school/school.php";
    require_once "../work/work.php";

    $user = new user ();
    $post = new post ();
    $blog = new blog ();
    $folder = new folder ();
    $category = new category ();
    $module = new module ();
    $school = new school ();
    $work = new work ();

    if (!$user->loggedIn() and $_SERVER['PHP_SELF'] != "/user/login.php" 
    	and $_SERVER['PHP_SELF'] != "/user/new.php" 
    	and $_SERVER['PHP_SELF'] != "/tsn_security/forgot_password.php"
		and $_SERVER['PHP_SELF'] != "/tsn_security/password_challenge.php"
		and $_SERVER['PHP_SELF'] != "/user/change_password.php") { ?>
        <script type="text/javascript">
            redirect ("../user/login.php");
        </script>
    <?php }

    function nav_bar () { ?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../user/interface.php" target="_self">The Social Network</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <form action="../user/friends.php" method="POST" class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input name="search" class="form-control" type="text" placeholder="Search Users"></input>
                        </div>
                        <button class="btn btn-default" name="submit" type="submit" value="submit">Search</button>
                    </form>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Go to... <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="../profile/profile.php">Your Profile</a></li>
                            <li><a href="../profile/home.php">Home</a></li>
                            <li><a href="../post/interface.php">Posts</a></li>
                            <li><a href="../blog/interface.php">Blogs</a></li>
                            <li><a href="../folder/interface.php">Folders</a></li>
                            <li><a href="../category/interface.php">Categories</a></li>
                            <li><a href="../school/interface.php">Schools</a></li>
                            <li><a href="../work/interface.php">Work</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">User <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="../user/edit.php">Edit Profile</a></li>
                            <li><a href="../user/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php } ?> 
    <div class="container">

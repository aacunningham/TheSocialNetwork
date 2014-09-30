<?php
    require_once "module.php";
    require_once "../Layout/header.php"; 
    
    if (!empty($_SESSION['uid'])) {
        //Get User Information
        $user->uid = $_SESSION['uid'];
        $user->get (); //get user info
        $module->display($user, "top right"); 
        $module->display($user, "top left"); 
    }
?>

<?php
    require_once "module.php";
    require_once "../Layout/header.php"; 
    
    
    //Get User Information
    $user->id = $_SESSION['uid']; //replace later with method to get user id
    $user->get (); //get user info
    
    $module->display($user, "about_me"); 
    $module->display($user, "contact"); ?>

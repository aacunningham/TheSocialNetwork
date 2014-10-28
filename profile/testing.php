<?php
    require_once "module.php";
    require_once "../Layout/header.php"; 
    
    
    //Get User Information
    $user->uid = $_SESSION['uid']; //replace later with method to get user id
    $user->get (); //get user info
    
    $module->display_about_me($user); 
    $module->display_contact($user); 
    $module->display_friends($user);
    $module->display_posts($user);
    $module->display_schools($user);
?>

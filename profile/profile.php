<?php
    require_once "module.php";
    require_once "../Layout/header.php"; 
    
    if (!empty($_SESSION['uid'])) {
        //Get User Information
        $user->id = $_SESSION['uid'];
        $user->get (); //get user info
        $module->user = $user->id;
        
        $name = $module->getName("top left");
        $module->display($user, $name); 
        
        $name = $module->getName("top right");
        $module->display($user, $name); 
    }
?>

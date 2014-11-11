<?php
    require_once "module.php";
    require_once "../Layout/header.php"; ?>
    
<title>Testing Modules</title>
<body>
<h1>Testing Modules</h1>

<?php
    //Get User Information
    $user->uid = 1; //replace later with method to get user id
    $user->get (); //get user info

    $module->display_about_me($user); 
    $module->display_contact($user); 
    $module->display_friends($user);
    $module->display_posts($user);
    $module->display_schools($user);
    $module->display_work($user);
    $module->display_profile_background($user);
?>
</body>
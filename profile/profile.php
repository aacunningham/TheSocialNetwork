<?php
    require_once "../Layout/header.php"; 
    require_once "module.php";
    
    if (!empty($_GET['u'])) {
        $user->uid = $_GET['u'];
        $user->get ();
    } elseif (!empty($_SESSION['uid'])) {
        //Get User Information
        $user->uid = $_SESSION['uid'];
        $user->get (); //get user info 
    } ?>
    <title>Your Profile!</title>
</head>
<body style="padding-top:70px">
<?php nav_bar(); ?>
    <div class="container">
        <?php if ($user->uid == $user->getUser()) : ?>
            <button type="button" class="btn btn-primary" onclick="window.location.href='edit.php?m=profile_background'">Personalize</button>
        <?php endif; ?>
        <div class="row">
            <div class="col-sm-4">
                <?php $module->print_left ($user); ?>
            </div>
            <div class="col-sm-4">
                <?php $module->display_posts ($user); ?>
            </div>
            <div class="col-sm-4">
                <?php $module->print_right ($user); ?>
            </div>
        </div>
    </div>
</body>
</html>

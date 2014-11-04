<?php
    require_once "../Layout/header.php"; 
    require_once "module.php";
    
    if (!empty($_GET['uid'])) {
        $user->uid = $_GET['uid'];
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
        <div class="row">
            <div class="col-sm-5">
                <?php $module->print_left ($user); ?>
            </div>
            <div class="col-sm-5 col-sm-offset-2">
                <?php $module->print_right ($user); ?>
            </div>
        </div>
    </div>
    <script src="../Layout/js/jquery-1.11.1.min.js"></script>
    <script src="../Layout/js/bootstrap.min.js"></script>
</body>
</html>

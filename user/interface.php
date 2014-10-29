
<?php require_once "../Layout/header.php"; ?>
    
    <title>Users</title>
</head>

<body style="padding-top:50px">
<?php nav_bar(); ?>
    <h1>Users</h1>

    <a href="login.php" target="_self">Login</a>
    <br>
    <a href="logout.php" target="_self">Logout</a>
    <br>
    <a href="new.php" target="_self">Create New</a>
    <br>
    <a href="edit.php" target="_self">Edit User</a>
    <br>
    <a href="friends.php" target="_self">Make Friends</a>
    <br>
    <a href="browse.php" target="_self">Browse Users</a>
    <br>
    <a href="../profile/feed.php" target="_self">View My Feed</a>
    <br>
    <a href="delete.php" target="_self" onclick="return confirm('Are you sure you want to delete your account?');">Delete User</a>
    <br>
    <a href="../post/interface.php" target="_self">Go to Posts</a>
    <br>
    <a href="../blog/interface.php" target="_self">Go to Blogs</a>
    <br>
    <a href="../folder/interface.php" target="_self">Go to Folders</a>
    <br>
    <a href="../category/interface.php" target="_self">Go to Categories</a>
    <br>
    <a href="../profile/profile.php" target="_self">Go to Profile</a>
    <script src="../Layout/js/jquery-1.11.1.min.js"></script>
    <script src="../Layout/js/bootstrap.min.js"></script>
</body>
</html>

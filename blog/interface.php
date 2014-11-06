
<?php require_once "../Layout/header.php"; ?>
    
<title>Blogs</title>
</head>


<body style="padding-top:50px">
<?php nav_bar(); ?>
    <h1>Blogs</h1>
    
<?php 
    $folders = $folder->listFolders();
    foreach ($folders as $folder) : ?>
       <div class="icon_container"> 
           <a href="edit.php?f=<?php echo $folder['fid']; ?>" target="_self"><img class="folder icon" src="../assets/icons/folder.png"></a>
           <span class='caption'><?php echo $folder["name"]; ?></span>
       </div>
    <?php endforeach;

?>
<br>
<br>
<br>
    <a href="new.php" target="_self">Create New</a>
    <br>
    <a href="edit.php" target="_self">Edit Blog</a>
    <br>
    <a href="delete.php" target="_self">Delete Blog</a>
    <br>
    <a href="view.php" target="_self">View Blogs</a>
    <br>
    <a href="../post/interface.php" target="_self">Go to Posts</a>
    <br>
    <a href="../school/interface.php" target="_self">Go to Schools</a>
    <br>
    <a href="../work/interface.php" target="_self">Go to Work History</a>
    <br>
    <a href="../user/interface.php" target="_self">Go to User</a>
    <br>
    <a href="../folder/interface.php" target="_self">Go to Folders</a>
    <br>
    <a href="../category/interface.php" target="_self">Go to Categories</a>
    <br>
    <a href="../profile/profile.php" target="_self">Go to Profile</a>
    <br>
    <a href="../profile/interface.php" target="_self">Go to Profile Modules</a>
    <script src="../Layout/js/jquery-1.11.1.min.js"></script>
    <script src="../Layout/js/bootstrap.min.js"></script>
</body>
</html>




















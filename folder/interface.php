
<?php require_once "../Layout/header.php"; ?>
    
<title>Folders</title>
</head>

<body style="padding-top:50px">
<?php nav_bar(); ?>
    <h1>Folders</h1>
    
<!-- Create New -->
<div class="icon_container">
    <a href="new.php" target="_self"><img class="new icon" src="../assets/icons/create_new_doc.png"></a>
    <span class="caption">Create New Folder</span>
</div>
<?php $folders = $folder->listFolders();
    foreach ($folders as $folder) : ?>
       <div class="icon_container"> 
           <a href="edit.php?f=<?php echo $folder['fid']; ?>" target="_self"><img class="folder icon" src="../assets/icons/folder.png"></a>
           <span class='caption'><?php echo $folder["name"]; ?></span>
       </div>
    <?php endforeach; ?>
    
    <!--<a href="new.php" target="_self">Create New</a>
    <br>
    <a href="edit.php" target="_self">Edit Folder</a>
    <br>
    <a href="delete.php" target="_self">Delete Folder</a>
    <br>
    <a href="view.php" target="_self">View Folders</a>
    <br>
    <!--<a href="../post/interface.php" target="_self">Go to Posts</a>
    <br>
    <a href="../school/interface.php" target="_self">Go to Schools</a>
    <br>
    <a href="../work/interface.php" target="_self">Go to Work History</a>
    <br>
    <a href="../user/interface.php" target="_self">Go to User</a>
    <br>
    <a href="../blog/interface.php" target="_self">Go to Blogs</a>
    <br>
    <a href="../category/interface.php" target="_self">Go to Categories</a>
    <br>
    <a href="../profile/profile.php" target="_self">Go to Profile</a>
    <br>
    <a href="../profile/interface.php" target="_self">Go to Profile Modules</a>-->
    <script src="../Layout/js/jquery-1.11.1.min.js"></script>
    <script src="../Layout/js/bootstrap.min.js"></script>
</body>
</html>






















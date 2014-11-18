
<?php require_once "../Layout/header.php"; ?>
    
<title>Folders</title>
</head>

<body style="padding-top:70px">
<?php nav_bar(); ?>
    <h1>Folders</h1>
    
<!-- Create New -->
<div class="icon_container">
    <a href="new.php" target="_self"><img class="new icon" src="../assets/icons/create_new_doc.png"></a>
    <span class="caption">Create New Folder</span>
</div>
<?php 
    $folders = $folder->listFolders();
    if (!empty($folders)) :
        foreach ($folders as $folder) : ?>
           <div class="icon_container"> 
               <a href="edit.php?f=<?php echo $folder['fid']; ?>" target="_self"><img class="folder icon" src="../assets/icons/folder.png"></a>
               <span class='caption'><?php echo $folder["name"]; ?></span>
           </div>
        <?php endforeach; 
    endif; ?>
</body>
</html>






















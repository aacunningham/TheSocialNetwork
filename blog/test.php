<?php
    require_once "../Layout/header.php";
    
    $blogs = array ();
    if (!empty($_POST['choose'])) { //they've chosen a folder to view
        $blogs = $blog->display ($_POST['fid']); //get blog info
    }
    $folderList = $folder->listFolders (); //get user's list of folders
?>
    
<title>Blogs</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Errors -->
<?php if (!empty($blog->message)) : ?>
    <h3><?php echo $blog->message; ?></h3>
<?php endif; ?>

<?php if (!empty($blogs)) : ?>
    
<h1>test from Isaac</h1>

<?php endif; ?>

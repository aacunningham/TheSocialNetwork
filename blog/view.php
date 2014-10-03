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
    
<h1>Blogs</h1>

<!-- Display Blog -->
<table>
    <tr>
        <th>Title</th>
        <th>Content</th>
    </tr>
    <?php foreach ($blogs as $b) : ?>
    <tr>
        <td><?php echo $b['title']; ?></td>
        <td><?php echo $b['content']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php else: ?>
    
<h1>Choose Folder</h1>

<!-- If empty -->
<?php if (!empty($_POST['fid']) and empty($blogs)) : ?>
    <h3>That folder does not have any blogs yet!</h3>
<?php endif; ?>

<?php if (!empty($folderList)) : ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <table>
            <!-- Choose Folder -->
            <tr>
                <td><b>Folder:</b></td>
                <td><select required name="fid">
                    <?php foreach ($folderList as $f) : ?>
                        <option value="<?php echo $f["fid"]; ?>"><?php echo $f["name"]; ?></option>
                    <?php endforeach; ?>
                </select></td>
            </tr>
            
            <!-- Submit -->
            <tr>
                <td><input type="submit" name="choose" value="View"></td>
            </tr>
        </table>
    </form>
<?php else : ?>
    
    <h3>You do not have any folders or blogs yet!</h3>
<?php endif; ?>

<?php endif; ?>
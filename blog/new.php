<?php
    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //new blog submitted
        $blog->title = test_input($_POST['title']);
        $blog->content = test_input($_POST['content']);
        $blog->category = test_input ($_POST['category']);
        $blog->folder = test_input ($_POST['folder']);
        $blog->create ();
    }
    
    $categoryList = $category->listAll (); //list all sitewide categories
    $folderList = $folder->listFolders (); //list this user's folders
?>

<!-- Title -->
<title>New Blog</title>

<!-- Back Navigtion -->
<?php if (empty($_GET['f'])) : ?>
    <a class='back' href="interface.php" target="_self">Home</a>
<?php else : 
        $folder->fid = $_GET['f'];
        $folder->get();
    ?>
    <a class='back' href="edit.php?f=<?php echo $_GET['f']; ?>" target="_self"><?php echo $folder->name; ?></a>
<?php endif; ?>
<!-- Heading -->
<h1>New Blog</h1>

<!-- Errors -->
<?php if (!empty($blog->message)) : ?>
    <h3><?php echo $blog->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Title -->
        <tr>
            <td><b>Title:</b></td>
            <td><input type="text" name="title" required value="<?php printPost('title'); ?>"</td>
        </tr>
        
        <!-- Content -->
        <tr>
            <td><b>Content:</b></td>
            <td><textarea required name="content"><?php printPost('content'); ?></textarea></td>
        </tr>
        
        <!-- Category -->
        <tr>
            <td><b>Category:</b></td>
            <td><select required name="category">
                <?php foreach ($categoryList as $c) : ?>
                    <option value="<?php echo $c["cid"]; ?>"><?php echo $c["name"]; ?></option>
                <?php endforeach; ?>
            </select></td>
        </tr>
        
        <!-- Folder -->
        <tr>
            <td><b>Folder:</b></td>
            <td><select required name="folder">
                <?php foreach ($folderList as $f) : ?>
                    <option value="<?php echo $f["fid"]; ?>" <?php if (!empty($_GET['f']) and $_GET['f'] == $f["fid"]) echo 'selected'; ?>><?php echo $f["name"]; ?></option>
                <?php endforeach; ?>
            </select></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

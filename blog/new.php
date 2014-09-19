<?php
    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['submit'])) {
        $blog->title = test_input($_POST['title']);
        $blog->content = test_input($_POST['content']);
        $blog->category = test_input ($_POST['category']);
        $blog->folder = test_input ($_POST['folder']);
        $blog->create ();
    }
    
    $categoryList = $category->listCategories (); ////////////////////
    $folderList = $folder->listFolders ();
?>

<!-- Title -->
<title>New Blog</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>New Blog</h1>

<?php if (!empty($blog->message)) : ?>
    <h3><?php echo $blog->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <table>
        <!-- Title -->
        <tr>
            <td><b>Title:</b></td>
            <td><input type="text" name="title" required value="<?php if (!empty($_POST['title'])) echo $_POST['title']; ?>"</td>
        </tr>
        
        <!-- Content -->
        <tr>
            <td><b>Content:</b></td>
            <td><textarea required name="content"><?php if (!empty($_POST['content'])) echo $_POST['content']; ?></textarea></td>
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
                    <option value="<?php echo $f["fid"]; ?>"><?php echo $f["name"]; ?></option>
                <?php endforeach; ?>
            </select></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

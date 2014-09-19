<?php
    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['choose'])) {
        $blog->id = $_POST['id'];
        $blog->get (); //get blog info
    } elseif (!empty($_POST['submit'])) {
        //Form Validation
        $blog->id = $_POST['bid'];
        $blog->title = test_input($_POST['title']);
        $blog->content = test_input($_POST['content']);
        $blog->category = test_input($_POST['category']);
        $blog->folder = test_input($_POST['folder']);
        $blog->edit ();
    }
    $categoryList = $category->listAll ();
    $folderList = $folder->listAll ();
    $blogList = $blog->listAll();
?>

<!-- Title -->
<title>Edit Blog</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Edit Blog</h1>

<?php if (!empty($blog->message)) : ?>
    <h3><?php echo $blog->message; ?></h3>
<?php endif; ?>

<?php if (!empty($blog->id)) : ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <table>
        <!-- Hidden - User ID -->
        <input type="hidden" name="bid" value="<?php echo $blog->id; ?>">
        
        <!-- Title -->
        <tr>
            <td><b>Title:</b></td>
            <td><input type="text" name="title" required value="<?php if (!empty($blog->title)) echo $blog->title; elseif (!empty($_POST['title'])) echo $_POST['title']; ?>"</td>
        </tr>
        
        <!-- Content -->
        <tr>
            <td><b>Content:</b></td>
            <td><textarea required name="content"><?php if (!empty($blog->content)) echo $blog->content; elseif (!empty($_POST['content'])) echo $_POST['content']; ?></textarea></td>
        </tr>
        
        <!-- Category -->
        <tr>
            <td><b>Category:</b></td>
            <td><select required name="category">
                <?php foreach ($categoryList as $cat) : ?>
                    <option value="<?php echo $cat["cid"]; ?>"><?php echo $cat["name"]; ?></option>
                <?php endforeach; ?>
            </select></td>
        </tr>
        
        <!-- Folder -->
        <tr>
            <td><b>Folder:</b></td>
            <td><select required name="folder">
                <?php foreach ($folderList as $folder) : ?>
                    <option value="<?php echo $folder["fid"]; ?>"><?php echo $folder["name"]; ?></option>
                <?php endforeach; ?>
            </select></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>
<?php else: ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <table>
        <!-- Blog -->
        <tr>
            <td><b>Blog:</b></td>
            <td><select required name="id">
                <?php foreach ($blogList as $b) : ?>
                    <option value="<?php echo $b["bid"]; ?>"><?php echo $b["title"]; ?></option>
                <?php endforeach; ?>
            </select></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="choose" value="Edit"></td>
        </tr>
    </table>
</form>
<?php endif; ?>

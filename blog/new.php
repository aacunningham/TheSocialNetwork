<?php
    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //new blog submitted
        $blog->title = test_input($_POST['title']);
        $blog->content = test_input($_POST['content']);
        $blog->cid = test_input ($_POST['category']);
        $blog->fid = test_input ($_POST['folder']);
        $blog->create ();
        header ("Location: ../blog/edit.php?f=".$_POST['folder']);
    }
    
    $categoryList = $category->listAll (); //list all sitewide categories
    $folderList = $folder->listFolders (); //list this user's folders
?>

<!-- Title -->
<title>New Blog</title>

<body style="padding-top:70px">
<?php nav_bar(); ?>

<!-- Back Navigtion -->
<?php if (empty($_GET['f'])) : ?>
    <button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">Blogs</button>
<?php else : 
        $folder->fid = $_GET['f'];
        $folder->get();
?>
    <button type="button" class="left btn btn-primary" onclick="window.location.href='edit.php?f=<?php echo $_GET['f']; ?>'"><?php echo $folder->name; ?></button>
<?php endif; ?>
<!-- Heading -->
<h1>New Blog</h1>

<!-- Errors -->
<?php if (!empty($blog->message)) : ?>
    <h3><?php echo $blog->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class='form'>
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
        </table>
    </div>
    
    <!-- Submit -->
    <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
</form>
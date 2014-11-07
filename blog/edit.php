<?php
    require_once "../Layout/header.php";
    
    if (!empty($_GET['b'])) {
        $blog->bid = $_GET['b'];
        $blog->get (); //get blog info
        if (isset($_GET['del'])) {
            $blog->delete();
            header ("Location: ?f=".$_GET['f']);
        }
    }
    if (!empty($_GET['f'])) { //they've chosen a blog to edit
        $folder->fid = $_GET['f'];
        $folder->get ();
    }
    
    if (!empty($_POST['submit'])) { //they've submitted an edit
        //Form Validation
        $blog->bid = $_POST['bid'];
        $blog->title = test_input($_POST['title']);
        $blog->content = test_input($_POST['content']);
        $blog->cid = test_input($_POST['category']);
        $blog->fid = test_input($_POST['folder']);
        $blog->edit ();
    }
    $categoryList = $category->listAll (); //list all categories (sitewide)
    $folderList = $folder->listFolders (); //list this user's folders
?>

<!-- Title -->
<title>Edit Blog</title>

<body style="padding-top:70px">
<?php nav_bar(); ?>

<!-- Back Navigtion -->
<?php if (!empty($_GET['b'])) : 
    $folder->fid = $_GET['f'];
    $folder->get();
?>
    <button type="button" class="left btn btn-primary" onclick="window.location.href='edit.php?f=<?php echo $_GET['f']; ?>'"><?php echo $folder->name; ?></button>
<?php elseif (!empty($_GET['f'])) : ?>
    <button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">Folders</button>
<?php endif; ?>

<!-- Heading -->
<h1>Edit Blog</h1>

<!-- Errors -->
<?php if (!empty($blog->message)) : ?>
    <h3><?php echo $blog->message; ?></h3>
<?php endif; ?>

<?php if (!empty($blog->bid)) : ?>
    <button type="button" class="btn btn-danger" onclick="deleteFn('?f=<?php echo $_GET['f']; ?>&b=<?php echo $blog->bid; ?>&del')">Delete</button>
    <!-- Edit Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); echo "?f=".$_GET['f']; ?>" method="POST">
        <div class='form'>
            <table>
                <!-- Hidden - User ID -->
                <input type="hidden" name="bid" value="<?php echo $blog->bid; ?>">
                
                <!-- Title -->
                <tr>
                    <td><b>Title:</b></td>
                    <td><input type="text" name="title" required value="<?php echoInput($blog, 'title'); ?>"</td>
                </tr>
                
                <!-- Content -->
                <tr>
                    <td><b>Content:</b></td>
                    <td><textarea required name="content"><?php echoInput($blog, 'content'); ?></textarea></td>
                </tr>
                
                <!-- Category -->
                <tr>
                    <td><b>Category:</b></td>
                    <td><select required name="category">
                        <?php foreach ($categoryList as $cat) : ?>
                            <option value="<?php echo $cat["cid"]; ?>" <?php if (!empty($blog->cid) and $blog->cid == $cat['cid']) echo "selected"; ?>><?php echo $cat["name"]; ?></option>
                        <?php endforeach; ?>
                    </select></td>
                </tr>
                
                <!-- Folder -->
                <tr>
                    <td><b>Folder:</b></td>
                    <td><select required name="folder">
                        <?php foreach ($folderList as $folder) : ?>
                            <option value="<?php echo $folder["fid"]; ?>" <?php if (!empty($blog->fid) and $blog->fid == $folder['fid']) echo "selected"; ?>><?php echo $folder["name"]; ?></option>
                        <?php endforeach; ?>
                    </select></td>
                </tr>
            </table>
        </div>
        <!-- Submit -->
        <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
    </form>
<?php elseif (!empty($folder->fid)): 
    $blogs = $blog->listBlogs($folder->fid);
    if (empty($blogs)) : ?>
        <h2>You have no blogs in this folder yet!</h2>
        
        <!-- Create New -->
        <div class="icon_container">
            <a href="new.php?f=<?php echo $_GET['f']; ?>" target="_self"><img class="new icon" src="../assets/icons/create_new_doc.png"></a>
            <span class="caption">Create New Blog</span>
        </div>
  <?php else: ?>
              
        <!-- Create New -->
        <div class="icon_container">
            <a href="new.php?f=<?php echo $_GET['f']; ?>" target="_self"><img class="new icon" src="../assets/icons/create_new_doc.png"></a>
            <span class="caption">Create New</span>
        </div>
    <?php foreach ($blogs as $b) : ?>
        <div class="icon_container">
            <a href="edit.php?f=<?php echo $_GET['f']; ?>&b=<?php echo $b['bid']; ?>" target="_self"><img class="document icon" src="../assets/icons/document.png"></a>
            <span class='caption'><?php echo $b["title"]; ?></span>
        </div>
    <?php endforeach;
    endif; 
endif; ?>

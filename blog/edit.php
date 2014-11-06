<?php
    require_once "../Layout/header.php";
    
    if (!empty($_GET['b'])) {
        $blog->bid = $_GET['b'];
        $blog->get (); //get blog info
    } elseif (!empty($_GET['f'])) { //they've chosen a blog to edit
        $folder->fid = $_GET['f'];
        $folder->get ();
    } elseif (!empty($_POST['submit'])) { //they've submitted an edit
        //Form Validation
        $blog->bid = $_POST['bid'];
        $blog->title = test_input($_POST['title']);
        $blog->content = test_input($_POST['content']);
        $blog->category = test_input($_POST['category']);
        $blog->folder = test_input($_POST['folder']);
        $blog->edit ();
    }
    $categoryList = $category->listAll (); //list all categories (sitewide)
    $folderList = $folder->listFolders (); //list this user's folders
?>

<!-- Title -->
<title>Edit Blog</title>

<!-- Back Navigtion -->
<?php if (!empty($_GET['b'])) : ?>
    <a class='back' href="edit.php?f=<?php echo $_GET['f']; ?>" target="_self">Blogs</a>
<?php elseif (!empty($_GET['f'])) : ?>
    <a class='back' href="interface.php" target="_self">Home</a>
<?php endif; ?>

<!-- Heading -->
<h1>Edit Blog</h1>

<!-- Errors -->
<?php if (!empty($blog->message)) : ?>
    <h3><?php echo $blog->message; ?></h3>
<?php endif; ?>

<?php if (!empty($blog->bid)) : ?>
    <!-- Edit Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
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

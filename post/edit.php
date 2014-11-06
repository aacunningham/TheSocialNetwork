<?php

    require_once "../Layout/header.php";
    
    if (!empty($_GET['p'])) {
        $post->pid = $_GET['p'];
        $post->get ();
    } elseif (!empty($_POST['choose'])) { //if post selected for editing
        $post->pid = $_POST['id'];
        $post->get (); //get post info
    } elseif (!empty($_POST['submit'])) { //if edited post submitted
        //Form Validation
        $post->pid = $_POST['pid'];
        $post->content = test_input($_POST['content']);
        $post->edit ();
        if ($_POST['redirect']) {
            header ("Location: ../profile/profile.php");
        }
    } elseif (!empty($_POST['cancel'])) {
          header ("Location: ../profile/profile.php");
    }
    $list = $post->listPosts(); //list this user's posts
?>

<!-- Title -->
<title>Edit Post</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Edit Post</h1>

<!-- Errors -->
<?php if (!empty($post->message)) : ?>
    <h3><?php echo $post->message; ?></h3>
<?php endif; ?>

<?php if (!empty($post->pid)) : ?>
    <a class="delete" href="delete.php?p=<?php echo $_GET['p']; ?>" target="_self" onclick="return confirm ('Are you sure you want to delete this post?');">Delete Post</a>
    <!-- Edit Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
            <!-- Hidden - Post ID -->
            <input type="hidden" name="pid" value="<?php echo $post->pid; ?>">
            <!-- Redirect to Profile? -->
            <input type="hidden" name="redirect" value="<?php echo isset($_GET['p']); ?>">
            
            <!-- Content -->
            <tr>
                <td><b>Content:</b></td>
                <td><textarea required name="content"><?php echoInput($post, 'content'); ?></textarea></td>
            </tr>
            
            <!-- Submit -->
            <tr>
                <td><input type="submit" name="submit"></td>
                <?php if (isset($_GET['p'])) : ?>
                    <td><button type="submit" name="cancel" value="Cancel">Cancel</button></td>
                <?php endif; ?>
            </tr>
        </table>
    </form>
<?php else: ?>
    <!-- Choose Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <table>
            <!-- Post -->
            <tr>
                <td><b>Post:</b></td>
                <td><select required name="id">
                    <?php foreach ($list as $p) : ?>
                        <option value="<?php echo $p["pid"]; ?>"><?php echo $p["content"]; ?></option>
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
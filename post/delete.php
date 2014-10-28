<?php
    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //if post selected for deletion
        $post->pid = $_POST['id'];
        $post->delete();
    }
    $list = $post->listPosts(); //list this user's posts
?>
    
<!-- Title -->
<title>Delete Post</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Delete Post</h1>

<!-- Errors -->
<?php if (!empty($post->message)) : ?>
    <h3><?php echo $post->message; ?></h3>
<?php endif; ?>

<!-- New Post Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- post -->
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
            <td><input type="submit" name="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this post?');"></td>
        </tr>
    </table>
</form>
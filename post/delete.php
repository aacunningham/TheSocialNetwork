<?php
    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['submit'])) {
        $post->id = $_POST['id'];
        $post->delete();
    }
    $list = $post->listAll();
    
?>
    
<!-- Title -->
<title>Delete Post</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Delete Post</h1>

<?php if (!empty($post->message)) : ?>
    <h3><?php echo $post->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
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
            <td><input type="submit" name="submit" value="Delete" onclick="confirm('Are you sure you want to delete this post?');"></td>
        </tr>
    </table>
</form>
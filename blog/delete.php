<?php
    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['submit'])) {
        $blog->id = $_POST['id'];
        $blog->delete();
    }
    $list = $blog->listAll();
    
?>
    
<!-- Title -->
<title>Delete Blog</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Delete Blog</h1>

<?php if (!empty($blog->message)) : ?>
    <h3><?php echo $blog->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <table>
        <!-- Blog -->
        <tr>
            <td><b>Blog:</b></td>
            <td><select required name="id">
                <?php foreach ($list as $b) : ?>
                    <option value="<?php echo $b["bid"]; ?>"><?php echo $b["title"]; ?></option>
                <?php endforeach; ?>
            </select></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this blog?');"></td>
        </tr>
    </table>
</form>
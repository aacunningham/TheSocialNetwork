<?php

    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['submit'])) {
        $post->content = test_input($_POST['content']);
        $post->dateTime = date("m-d-Y H:i:s");
        $post->create ();
    }
?>

<!-- Title -->
<title>New Post</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>New Post</h1>

<?php if (!empty($post->message)) : ?>
    <h3><?php echo $post->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <table>
        <!-- Content -->
        <tr>
            <td><b>Content:</b></td>
            <td><textarea required name="content"><?php if (!empty($_POST['content'])) echo $_POST['content']; ?></textarea></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

<?php

    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //new post submitted
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

<!-- Errors -->
<?php if (!empty($post->message)) : ?>
    <h3><?php echo $post->message; ?></h3>
<?php endif; ?>

<!-- New Post Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Content -->
        <tr>
            <td><b>Content:</b></td>
            <td><textarea required name="content"><?php printPost('content'); ?></textarea></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

<?php

    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['submit'])) {
        //Form Validation
        $post->id = $_POST['pid'];
        $post->content = test_input($_POST['content']);
        $post->edit ();
    } else {
        //Get User Information
        $post->id = 0; //replace later with method to get post id
        $post->get (); //get user info
    }
?>

<!-- Title -->
<title>Edit Post</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Edit Post</h1>

<?php if (!empty($post->message)) : ?>
    <h3><?php echo $post->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <table>
        <!-- Hidden - User ID -->
        <input type="hidden" name="pid" value="<?php echo $post->id; ?>">
        
        <!-- Content -->
        <tr>
            <td><b>Content:</b></td>
            <td><textarea required name="content"><?php if (!empty($user->content)) echo $user->content; elseif (!empty($_POST['content'])) echo $_POST['content']; ?></textarea></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

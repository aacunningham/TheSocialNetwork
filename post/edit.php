<?php

    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['choose'])) {
        $post->id = $_POST['id'];
        $post->get (); //get post info
    } elseif (!empty($_POST['submit'])) {
        //Form Validation
        $post->id = $_POST['pid'];
        $post->content = test_input($_POST['content']);
        $post->edit ();
    }
    $list = $post->listAll();
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

<?php if (!empty($post->id)) : ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <table>
        <!-- Hidden - Post ID -->
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
<?php else: ?>
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
<?php

    require_once "../Layout/header.php";
    
    if (!empty($_GET['p'])) {
        $post->pid = $_GET['p'];
        $post->get ();
        if (isset($_GET['del'])) {
            $post->delete();
            header ("Location: interface.php");
        }
    }
    if (!empty($_POST['submit'])) { //if edited post submitted
        //Form Validation
        $post->pid = $_POST['pid'];
        $post->content = test_input($_POST['content']);
        $post->edit ();
        if ($_POST['redirect']) {
            header ("Location: interface.php");
        }
    } elseif (!empty($_POST['cancel'])) {
          header ("Location: interface.php");
    }
    $list = $post->listPosts(); //list this user's posts
?>

<!-- Title -->
<title>Edit Post</title>

<body style="padding-top:70px">
<?php nav_bar(); ?>

<!-- Back Navigtion -->
<?php if (isset($_GET['u'])) : ?>
    <button type="button" class="left btn btn-primary" onclick="window.location.href='../profile/profile.php'">My Profile</button>
<?php else : ?>
    <button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">Posts</button>
<?php endif; ?>

<!-- Heading -->
<h1>Edit Post</h1>

<!-- Errors -->
<?php if (!empty($post->message)) : ?>
    <h3><?php echo $post->message; ?></h3>
<?php endif; ?>

<?php if (!empty($post->pid)) : ?>
    <button type="button" class="btn btn-danger" onclick="deleteFn('?p=<?php echo $_GET['p']; ?>&del')">Delete</button>
    
    <!-- Edit Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class='form'>
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
            </table>
        </div>
        
        <!-- Submit -->
        <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
        <button class="btn btn-warning" type="submit" name="cancel" value="Cancel">Cancel</button>
    </form>
<?php endif; ?>
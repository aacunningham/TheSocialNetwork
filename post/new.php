<?php

    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //new post submitted
        $post->content = test_input($_POST['content']);
        $post->dateTime = date("m-d-Y H:i:s");
        $post->create ();
        header ("Location: ../profile/profile.php");
    }
?>

<!-- Title -->
<title>New Post</title>

<body style="padding-top:70px">
<?php nav_bar(); ?>

<!-- Back Navigtion -->
<button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">Posts</button>

<!-- Heading -->
<h1>New Post</h1>

<!-- Errors -->
<?php if (!empty($post->message)) : ?>
    <h3><?php echo $post->message; ?></h3>
<?php endif; ?>

<!-- New Post Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class='form'>
        <table>
            <!-- Content -->
            <tr>
                <td><b>Content:</b></td>
                <td><textarea required name="content"><?php printPost('content'); ?></textarea></td>
            </tr>
        </table>
    </div>
    
    <!-- Submit -->
    <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
</form>

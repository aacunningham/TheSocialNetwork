<?php
    require_once "../Layout/header.php";
    
    $posts = $post->display(); //list all posts for this user, sorted by most recent first
?>


<!-- Title -->
<title>View Posts</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>View Posts</h1>

<?php if (!empty($posts)) : ?>
    <!-- Display Posts -->
    <table>
        <tr>
            <th>Date and Time</th>
            <th>Content</th>
        </tr>
        <?php foreach ($posts as $p) : ?>
        <tr>
            <td><?php echo $p['dateTime']; ?></td>
            <td><?php echo $p['content']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <!-- No Posts to Display -->
    <h3>You have no posts yet!</h3>
<?php endif; ?>
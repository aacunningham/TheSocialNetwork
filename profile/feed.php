<?php

    require_once "../Layout/header.php";
    
    $friends = $user->getFriends();
    $feed = array ();
    foreach ($friends as $f) {
        $feed = array_merge ($feed, (array)$post->listPosts($f));
    }
    $feed = $post->sortPosts($feed);
    //print_r($feed);
?>
    <title>Feed</title>
    
    <!-- Back Navigtion -->
    <a href="interface.php" target="_self">Home</a>

    <h1>Feed</h1>
    
    <!-- Errors -->
    <?php if (!empty($user->message)) : ?>
        <h3><?php echo $user->message; ?></h3>
    <?php endif; ?>
    
    <table>
        <tr>
            <th>Friend</th>
            <th>Post</th>
            <th>Date and Time</th>
        </tr>
        <?php foreach ($feed as $post) : ?>
        <tr>
            <td><?php $user->get ("uid", $post['uid'], true); echo $user->fname." ".$user->lname; ?></td>
            <td><?php echo $post['content']; ?></td>
            <td><?php echo $post['dateTime']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
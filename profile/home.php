<?php

    require_once "../Layout/header.php";
    
    $notFriends = $user->getOthers ();
    $friends = $user->getFriends();
    $feed = array ();
    foreach ($friends as $f) {
        $feed = array_merge ($feed, (array)$post->listPosts($f));
    }
    $feed = $post->sortPosts($feed);
?>
    <title>Feed</title>
    
    <body style="padding-top:70px">
    <?php nav_bar(); ?>

    <h1>Home</h1>

    <div class="rounded container-fluid" id="feed">
        <h2>Feed</h2>
        
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
    </div>
    
    <div class="rounded container-fluid" id="browse">
        <h2>Browse for Users</h2>
        
        <!-- Errors -->
        <?php if (!empty($user->message)) : ?>
            <h3><?php echo $user->message; ?></h3>
        <?php endif; ?>
        
        <table>
            <tr>
                <th>Name</th>
                <th>Profile</th>
            </tr>
            <?php foreach ($notFriends as $u) : ?>
            <tr>
                <td><?php echo $u['fname']." ".$u['lname']; ?></td>
                <td><button type="button" class="left btn btn-primary" onclick="window.location.href='profile.php?u=<?php echo $u['uid']; ?>'">View</button></td>
            </tr>
            <?php endforeach; ?>
        </table>  
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<?php

    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //new post submitted
        $post->content = test_input($_POST['content']);
        $post->dateTime = date("m-d-Y H:i:s");
        $post->create ();
    }
    
    $notFriends = $user->getOthers ();
    $friends = $user->getFriends();
    $feed = array ();
    foreach ($friends as $f) {
        $feed = array_merge ($feed, (array)$post->listPosts($f));
    }
    $feed = $post->sortPosts($feed);
    $popular = $user->getMostPopular();
    $suggestions = $user->getSuggestions();
?>
    <title>Feed</title>
    
    <body style="padding-top:70px">
    <?php nav_bar(); ?>

    <h1>Home</h1>
    
    <div class="rounded container-fluid" id="post">
        <!-- Heading -->
        <h2>What's happening?</h2>
        
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
                        <td><b>New Post:</b></td>
                        <td><textarea required name="content"><?php printPost('content'); ?></textarea></td>
                    </tr>
                </table>
            </div>
            
            <!-- Submit -->
            <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
        </form>
    </div>

    <?php if (!empty($feed)) : ?>
    <div class="rounded container-fluid" id="feed">
        <h2>Feed</h2>
        
        <table>
            <tr>
                <th>Picture</th>
                <th>Friend</th>
                <th>Post</th>
                <th>Date and Time</th>
            </tr>
            <?php foreach ($feed as $post) : 
                $user->get ("uid", $post['uid'], true); ?>
            <tr>
                <td><?php $module->display_thumbnail ($user->picture); ?></td>
                <td><?php echo $user->fname." ".$user->lname; ?></td>
                <td><?php echo $post['content']; ?></td>
                <td><?php echo $post['dateTime']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($suggestions)) : ?>
    <div class="rounded container-fluid" id="suggestions">
        <h2>Suggestions For You</h2>
        
        <table>
            <tr>
                <th>Picture</th>
                <th>Name</th>
                <th>Profile</th>
            </tr>
            <?php foreach ($suggestions as $u) : ?>
            <tr>
                <td><?php $module->display_thumbnail ($u->picture); ?></td>
                <td><?php echo $u->fname." ".$u->lname; ?></td>
                <td><button type="button" class="btn btn-primary" onclick="window.location.href='profile.php?u=<?php echo $u->uid; ?>'">View</button></td>
            </tr>
            <?php endforeach; ?>
        </table>  
    </div>
    <?php endif; ?>
    
    <?php if (!empty($popular)) : ?>
    <div class="rounded container-fluid" id="popular">
        <h2>Most Popular Users</h2>
        
        <table>
            <tr>
                <th>Picture</th>
                <th>Name</th>
                <th>Profile</th>
            </tr>
            <?php foreach ($popular as $u) : ?>
            <tr>
                <td><?php $module->display_thumbnail ($u->picture); ?></td>
                <td><?php echo $u->fname." ".$u->lname; ?></td>
                <td><button type="button" class="btn btn-primary" onclick="window.location.href='profile.php?u=<?php echo $u->uid; ?>'">View</button></td>
            </tr>
            <?php endforeach; ?>
        </table>  
    </div>
    <?php endif; ?>
    
    <?php if (!empty($notFriends)) : ?>
    <div class="rounded container-fluid" id="browse">
        <h2>Browse for Users</h2>
        
        <table>
            <tr>
                <th>Picture</th>
                <th>Name</th>
                <th>Profile</th>
            </tr>
            <?php foreach ($notFriends as $u) : ?>
            <tr>
                <td><?php $module->display_thumbnail($u['picture']); ?></td>
                <td><?php echo $u['fname']." ".$u['lname']; ?></td>
                <td><button type="button" class="btn btn-primary" onclick="window.location.href='profile.php?u=<?php echo $u['uid']; ?>'">View</button></td>
            </tr>
            <?php endforeach; ?>
        </table>  
    </div>
    <?php endif; ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<?php
    require_once "../Layout/header.php";
    $limit = 10;
    $counter = 0;
    $page = empty($_GET['p']) ? 1 : $_GET['p']; 
    $posts = $post->display(); //list all posts for this user, sorted by most recent first
    $count = count ($posts);
?>

<!-- Title -->
<title>Posts</title>

<?php nav_bar(); ?>

<body style="padding-top:70px">
<!-- Heading -->
<h1>Posts</h1>

<button type="button" class="btn btn-success" onclick="window.location.href='new.php'">Create New</button>
<?php if (!empty($posts)) : ?>
    <!-- Display Posts -->
    <div class="rounded">
        <table id="width80" class="table table-striped table-hover">
            <tr>
                <th>Date and Time</th>
                <th>Content</th>
                <th>Edit</th>
            </tr>
            <?php foreach ($posts as $p) : 
                    $counter++;
                    if ($counter <= $page*$limit) :
                        if ($page == 1 or ($page > 1 and $counter > ($page-1)*$limit)) :
                ?>
            <tr>
                <td><?php echo $p['dateTime']; ?></td>
                <td><?php echo $p['content']; ?></td>
                <td><button type="button" class="btn btn-primary" onclick="window.location.href='edit.php?p=<?php echo $p['pid']; ?>'">Edit</button></td>
            </tr>
            <?php endif; 
                endif; 
                endforeach; ?>
        </table>
    </div>
    
    <div class="page">
    <?php if ($page > 1) : ?>
        <button type="button" class="left btn btn-info" onclick="window.location.href='?p=<?php echo $page-1; ?>'">Previous</button>
    <?php endif; 
    if ($limit*$page < $count) : ?>
        <button type="button" class="right btn btn-info" onclick="window.location.href='?p=<?php echo $page+1; ?>'">Next</button>
    <?php endif; ?>
    </div>
<?php else : ?>
    <!-- No Posts to Display -->
    <h3>You have no posts yet!</h3>
<?php endif; ?>
</body>
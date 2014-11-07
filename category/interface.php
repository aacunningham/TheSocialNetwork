<?php
    require_once "../Layout/header.php";
    $limit = 10;
    $counter = 0;
    $page = empty($_GET['p']) ? 1 : $_GET['p']; 
    $categories = $category->display(); //list all categories
    $count = count ($categories);
?>

<!-- Title -->
<title>Categories</title>

<?php nav_bar(); ?>

<body style="padding-top:70px">
<!-- Heading -->
<h1>Categories</h1>

<button type="button" class="btn btn-success" onclick="window.location.href='new.php'">Create New</button>
<?php if (!empty($categories)) : ?>
    <!-- Display Categories -->
    <div class="rounded">
        <table id="width80" class="table table-striped table-hover">
            <tr>
                <th>Name</th>
                <th>Edit</th>
            </tr>
            <?php foreach ($categories as $c) : 
                    $counter++;
                    if ($counter <= $page*$limit) :
                        if ($page == 1 or ($page > 1 and $counter > ($page-1)*$limit)) :
                ?>
            <tr>
                <td><?php echo $c['name']; ?></td>
                <td><button type="button" class="btn btn-primary" onclick="window.location.href='edit.php?c=<?php echo $c['cid']; ?>'">Edit</button></td>
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
    <!-- No Categories to Display -->
    <h3>There are no categories yet!</h3>
<?php endif; ?>
</body>
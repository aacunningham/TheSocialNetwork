<?php
    require_once "../Layout/header.php";
    
    $categories = $category->display();
?>

<!-- Title -->
<title>View Categories</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>View Categories</h1>

<?php if (!empty($categories)) : ?>
    <!-- Display Categories -->
    <table>
        <tr>
            <th>Name</th>
        </tr>
        <?php foreach ($categories as $c) : ?>
        <tr>
            <td><?php echo $c['name']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php else : ?>
    <!-- No Categories to Display -->
    <h3>There are no categories yet!</h3>
<?php endif; ?>
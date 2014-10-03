<?php
    require_once "../Layout/header.php";
    
    $folders = $folder->display(); //list all folders for this user, sorted by folder name
?>


<!-- Title -->
<title>View Folders</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>View Folders</h1>

<?php if (!empty($folders)) : ?>
    <!-- Display Folders -->
    <table>
        <tr>
            <th>Name</th>
        </tr>
        <?php foreach ($folders as $f) : ?>
        <tr>
            <td><?php echo $f['name']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php else : ?>
    <!-- No Folders to Display -->
    <h3>You have no folders yet!</h3>
<?php endif; ?>
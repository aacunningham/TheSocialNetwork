<?php
    require_once "../Layout/header.php";
    
    $schools = $school->display(); //list all folders for this user, sorted by folder name
?>


<!-- Title -->
<title>View Schools</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>View Schools</h1>

<?php if (!empty($schools)) : ?>
    <!-- Display Schools -->
    <table>
        <?php foreach ($schools as $s) : ?>
        <tr>
            <td><b>Name:</b></td>
            <td><?php echo $s['name']; ?></td>
        </tr>
        <tr>
            <td><b>Type:</b></td>
            <td><?php echo $s['type']; ?></td>
        </tr>
        <tr>
            <td><b>Address:</b></td>
            <td><?php echo $s['address']; ?></td>
        </tr>
        <tr>
            <td><b>City:</b></td>
            <td><?php echo $s['city']; ?></td>
        </tr>
        <tr>
            <td><b>State:</b></td>
            <td><?php echo $s['state']; ?></td>
        </tr>
        <tr>
            <td><b>Zip Code:</b></td>
            <td><?php echo $s['zipCode']; ?></td>
        </tr>
        <tr>
            <td><b>Major:</b></td>
            <td><?php echo $s['major']; ?></td>
        </tr>
        <tr>
            <td><b>Minor:</b></td>
            <td><?php echo $s['minor']; ?></td>
        </tr>
        <tr>
            <td><b>Start Date:</b></td>
            <td><?php echo $s['startDate']; ?></td>
        </tr>
        <tr>
            <td><b>End Date:</b></td>
            <td><?php echo $s['endDate']; ?></td>
        </tr>
        <tr>
            <td><b>Degree:</b></td>
            <td><?php echo $s['degree']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php else : ?>
    <!-- No Schools to Display -->
    <h3>You have no schools yet!</h3>
<?php endif; ?>
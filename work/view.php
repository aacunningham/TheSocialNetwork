<?php
    require_once "../Layout/header.php";
    
    $works = $work->display(); //list all folders for this user, sorted by folder name
?>


<!-- Title -->
<title>View Work History</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>View Work History</h1>

<?php if (!empty($works)) : ?>
    <!-- Display Work History -->
    <table>
        <tr>
            <th>Company</th>
        </tr>
        <?php foreach ($works as $w) : ?>
        <tr>
            <td><b>Name:</b></td>
            <td><?php echo $w['company']; ?></td>
        </tr>
        <tr>
            <td><b>Position:</b></td>
            <td><?php echo $w['position']; ?></td>
        </tr>
        <tr>
            <td><b>Address:</b></td>
            <td><?php echo $w['address']; ?></td>
        </tr>
        <tr>
            <td><b>City:</b></td>
            <td><?php echo $w['city']; ?></td>
        </tr>
        <tr>
            <td><b>State:</b></td>
            <td><?php echo $w['state']; ?></td>
        </tr>
        <tr>
            <td><b>Zip Code:</b></td>
            <td><?php echo $w['zipCode']; ?></td>
        </tr>
        <tr>
            <td><b>Phone:</b></td>
            <td><?php echo $w['phone']; ?></td>
        </tr>
        <tr>
            <td><b>Boss:</b></td>
            <td><?php echo $w['boss']; ?></td>
        </tr>
        <tr>
            <td><b>Duties:</b></td>
            <td><?php echo $w['duties']; ?></td>
        </tr>
        <tr>
            <td><b>Start Date:</b></td>
            <td><?php echo $w['startDate']; ?></td>
        </tr>
        <tr>
            <td><b>End Date:</b></td>
            <td><?php echo $w['endDate']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php else : ?>
    <!-- No Workplaces to Display -->
    <h3>You have no work history yet!</h3>
<?php endif; ?>
<?php
    require_once "../Layout/header.php";
    
    function echoState ($state) {
        if (!empty($_POST['state']) and $_POST['state'] == $state) 
            echo 'selected';
    }

    $states = array ("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", 
    "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", 
    "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");
    
    if (!empty($_POST['submit'])) { //if new folder submitted
        $work->company = test_input($_POST['company']);
        $work->position = test_input($_POST['position']);
        $work->address = test_input($_POST['address']);
        $work->city = test_input($_POST['city']);
        $work->state = test_input($_POST['state']);
        $work->zipCode = test_input($_POST['zipCode']);
        $work->startDate = test_input($_POST['startDate']);
        $work->endDate = test_input($_POST['endDate']);
        $work->phone = test_input($_POST['phone']);
        $work->boss = test_input($_POST['boss']);
        $work->duties = test_input($_POST['duties']);
        $work->create ();
    }
?>

<!-- Title -->
<title>New Workplace</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>New Workplace</h1>

<!-- Errors -->
<?php if (!empty($work->message)) : ?>
    <h3><?php echo $work->message; ?></h3>
<?php endif; ?>

<!-- New Folder Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Content -->
        <tr>
            <td><b>Company:</b></td>
            <td><input required type="text" name="company" value="<?php printPost('company'); ?>"></td>
        </tr>
        <tr>
            <td><b>Position:</b></td>
            <td><input required type="text" name="position" value="<?php printPost("position"); ?>"></td>
        </tr>
        <tr>
            <td><b>Address:</b></td>
            <td><input required type="text" name="address" value="<?php printPost('address'); ?>"></td>
        </tr>
        <tr>
            <td><b>City:</b></td>
            <td><input required type="text" name="city" value="<?php printPost('city'); ?>"></td>
        </tr>
        <tr>
            <td><b>State:</b></td>
            <td><select name="state" required>
                <?php foreach ($states as $s) :?>
                    <option value="<?php echo $s; ?>" <?php echoState($s); ?>><?php echo $s; ?></option>
                <?php endforeach; ?>
            </select></td>
        </tr>
        <tr>
            <td><b>Zip Code:</b></td>
            <td><input required type="number" name="zipCode" value="<?php printPost('zipCode'); ?>"></td>
        </tr>
        <tr>
            <td><b>Phone:</b></td>
            <td><input type="text" name="phone" value="<?php printPost('phone'); ?>"></td>
        </tr>
        <tr>
            <td><b>Boss:</b></td>
            <td><input type="text" name="boss" value="<?php printPost('boss'); ?>"></td>
        </tr>
        <tr>
            <td><b>Duties: </b></td>
            <td><textarea required name="duties"><?php printPost("duties"); ?></textarea></td>
        </tr>
        <tr>
            <td><b>Start Date:</b></td>
            <td><input required type="date" name="startDate" value="<?php printPost('startDate'); ?>"></td>
        </tr>
        <tr>
            <td><b>End Date:</b></td>
            <td><input type="date" name="endDate" value="<?php printPost('endDate'); ?>"></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

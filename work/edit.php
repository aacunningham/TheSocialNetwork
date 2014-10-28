<?php
    require_once "../Layout/header.php";
    
    function echoState ($input) {
        if ((!empty($work->state) and $work->state == $input) or (!empty($_POST['state']) and $_POST['state'] == $input)) 
            echo 'selected';
    }
    
    $states = array ("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", 
    "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", 
    "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");
    
    if (!empty($_POST['choose'])) { //if work chosen for editing
        $work->wid = $_POST['id'];
        $work->get (); //get work info
    } elseif (!empty($_POST['submit'])) { //if edited work submitted
        //Form Validation
        $work->wid = $_POST['wid'];
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
        $work->edit ();
    }
    $list = $work->listWorks (); //list all of this user's folders
?>

<!-- Title -->
<title>Edit Work History</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Edit Work History</h1>

<!-- Errors -->
<?php if (!empty($work->message)) : ?>
    <h3><?php echo $work->message; ?></h3>
<?php endif; ?>

<?php if (!empty($work->wid)) : ?>
    <!-- Edit Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
            <!-- Hidden - User ID -->
            <input type="hidden" name="fid" value="<?php echo $work->wid; ?>">
            
            <!-- Content -->
            <tr>
                <td><b>Company:</b></td>
                <td><input required type="text" name="company" value="<?php echoInput($work, "company"); ?>"></td>
            </tr>
            <tr>
                <td><b>Position:</b></td>
                <td><input required type="text" name="position" value="<?php echoInput($work, "position"); ?>"></td>
            </tr>
            <tr>
                <td><b>Address:</b></td>
                <td><input required type="text" name="address" value="<?php echoInput($work, "address"); ?>"></td>
            </tr>
            <tr>
                <td><b>City:</b></td>
                <td><input required type="text" name="city" value="<?php echoInput($work, "city"); ?>"></td>
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
                <td><input required type="number" name="zipCode" value="<?php echoInput($work, "zipCode"); ?>"></td>
            </tr>
            <tr>
                <td><b>Phone:</b></td>
                <td><input type="text" name="phone" value="<?php echoInput($work, "phone"); ?>"></td>
            </tr>
            <tr>
                <td><b>Boss:</b></td>
                <td><input type="text" name="boss" value="<?php echoInput($work, "boss"); ?>"></td>
            </tr>
            <tr>
                <td><b>Duties: </b></td>
                <td><textarea required name="duties"><?php echoInput($work, "duties"); ?></textarea></td>
            </tr>
            <tr>
                <td><b>Start Date:</b></td>
                <td><input required type="date" name="startDate" value="<?php echoInput($work, "startDate"); ?>"></td>
            </tr>
            <tr>
                <td><b>End Date:</b></td>
                <td><input type="date" name="endDate" value="<?php echoInput($work, "endDate"); ?>"></td>
            </tr>
            
            <!-- Submit -->
            <tr>
                <td><input type="submit" name="submit"></td>
            </tr>
        </table>
    </form>
<?php else: ?>
    <!-- Choose Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <table>
            <!-- Work -->
            <tr>
                <td><b>Work:</b></td>
                <td><select required name="id">
                    <?php foreach ($list as $w) : ?>
                        <option value="<?php echo $w["wid"]; ?>"><?php echo $w["company"]; ?></option>
                    <?php endforeach; ?>
                </select></td>
            </tr>
            
            <!-- Submit -->
            <tr>
                <td><input type="submit" name="choose" value="Edit"></td>
            </tr>
        </table>
    </form>
<?php endif; ?>
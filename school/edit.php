<?php
    require_once "../Layout/header.php";
    
    function echoDegree ($input) {
        if ((!empty($school->degree) and $school->degree == $input) or (!empty($_POST['degree']) and $_POST['degree'] == $input)) 
            echo 'selected';
    }
    
    function echoState ($input) {
        if ((!empty($school->state) and $school->state == $input) or (!empty($_POST['state']) and $_POST['state'] == $input)) 
            echo 'selected';
    }
    
    function echoType ($type) {
        if ((!empty($school->type) and $school->type == $input) or !empty($_POST['type']) and $_POST['type'] == $type) 
            echo 'selected'; 
    }
    
    $states = array ("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", 
    "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", 
    "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");
    
    $degrees = array ("N/A", "GED", "High School Diploma", "A.A.", "A.S.", "A.A.S.", "A.E.", "A.A.A.", "A.P.S.", "B.S.", "B.A.", 
    "B.F.A.", "B.B.A.", "B.Arch.", "M.A.", "M.S.", "M.Res.", "M.Phil.", "LL.M.", "M.B.A.", "PhD", "M.D.", "Ed.D.", "J.D.", "D.O.");
    
    if (!empty($_GET['s'])) {
        $school->sid = $_GET['s'];
        $school->get (); //get school info
        if (isset($_GET['del'])) {
            $school->delete();
            header ("Location: interface.php");
        }
    }
    if (!empty($_POST['submit'])) { //if edited school submitted
        //Form Validation
        $school->sid = $_POST['sid'];
        $school->name = test_input($_POST['name']);
        $school->type = test_input($_POST['type']);
        $school->address = test_input($_POST['address']);
        $school->city = test_input($_POST['city']);
        $school->state = test_input($_POST['state']);
        $school->zipCode = test_input($_POST['zipCode']);
        $school->startDate = test_input($_POST['startDate']);
        $school->endDate = test_input($_POST['endDate']);
        $school->major = test_input($_POST['major']);
        $school->minor = test_input($_POST['minor']);
        $school->degree = test_input($_POST['degree']);
        $school->edit ();
        if ($_POST['redirect']) {
            header ("Location: interface.php");
        }
    } elseif (!empty($_POST['cancel'])) {
          header ("Location: interface.php");
    }
    $list = $school->listSchools (); //list all of this user's folders
?>

<!-- Title -->
<title>Edit School</title>

<body style="padding-top:70px">
<?php nav_bar(); ?>

<!-- Back Navigtion -->
<?php if (isset($_GET['u'])) : ?>
    <button type="button" class="left btn btn-primary" onclick="window.location.href='../profile/profile.php'">My Profile</button>
<?php else : ?>
    <button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">Schools</button>
<?php endif; ?>

<!-- Heading -->
<h1>Edit School</h1>

<!-- Errors -->
<?php if (!empty($school->message)) : ?>
    <h3><?php echo $school->message; ?></h3>
<?php endif; ?>

<?php if (!empty($school->sid)) : ?>
    <button type="button" class="btn btn-danger" onclick="deleteFn('?s=<?php echo $school->sid; ?>&del')">Delete</button>
    <!-- Edit Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class='form'>
            <table>
                <!-- Hidden - User ID -->
                <input type="hidden" name="sid" value="<?php echo $school->sid; ?>">
                <!-- Redirect to Profile? -->
                <input type="hidden" name="redirect" value="<?php echo isset($_GET['s']); ?>">
                
                <!-- Content -->
                <tr>
                    <td><b>Name:</b></td>
                    <td><input required type="text" name="name" value="<?php echoInput($school, "name"); ?>"></td>
                </tr>
                <tr>
                    <td><b>Type:</b></td>
                    <td><select required name="type">
                        <option value="University/College" <?php echoType("University/College"); ?>>University/College</option>
                        <option value="High School" <?php echoType("High School"); ?>>High School</option>
                        <option value="Elementary School" <?php echoType("Elementary School"); ?>>Elementary School</option>
                    </select></td>
                </tr>
                <tr>
                    <td><b>Address:</b></td>
                    <td><input required type="text" name="address" value="<?php echoInput($school, "address"); ?>"></td>
                </tr>
                <tr>
                    <td><b>City:</b></td>
                    <td><input required type="text" name="city" value="<?php echoInput($school, "city"); ?>"></td>
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
                    <td><input required type="number" name="zipCode" value="<?php echoInput($school, "zipCode"); ?>"></td>
                </tr>
                <tr>
                    <td><b>Major:</b></td>
                    <td><input type="text" name="major" value="<?php echoInput($school, "major"); ?>"></td>
                </tr>
                <tr>
                    <td><b>Minor:</b></td>
                    <td><input type="text" name="minor" value="<?php echoInput($school, "minor"); ?>"></td>
                </tr>
                <tr>
                    <td><b>Degree:</b></td>
                    <td><select required name="degree">
                        <?php foreach ($degrees as $d) : ?>
                            <option value="<?php echo $d; ?>" <?php echoDegree($d); ?>><?php echo $d; ?></option>
                        <?php endforeach; ?>
                </select></td>
                </tr>
                <tr>
                    <td><b>Start Date:</b></td>
                    <td><input required type="date" name="startDate" value="<?php echoInput($school, "startDate"); ?>"></td>
                </tr>
                <tr>
                    <td><b>End Date:</b></td>
                    <td><input required type="date" name="endDate" value="<?php echoInput($school, "endDate"); ?>"></td>
                </tr>
            </table>
        </div>
        <!-- Submit -->
        <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
        <button class="btn btn-warning" type="submit" name="cancel" value="Cancel">Cancel</button>
    </form>
<?php endif; ?>
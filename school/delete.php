<?php
    require_once "../Layout/header.php";

    if (!empty($_POST['submit'])) { //if school selected for deletion
        $school->sid = $_POST['id'];
        $school->delete();
    }
    $list = $school->listSchools(); //list this user's schools
?>
    
<!-- Title -->
<title>Delete School</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Delete School</h1>

<!-- Errors -->
<?php if (!empty($school->message)) : ?>
    <h3><?php echo $school->message; ?></h3>
<?php endif; ?>

<!-- Choose Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- School -->
        <tr>
            <td><b>School:</b></td>
            <td><select required name="id">
                <?php foreach ($list as $s) : ?>
                    <option value="<?php echo $s["sid"]; ?>"><?php echo $s["name"]; ?></option>
                <?php endforeach; ?>
            </select></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this school?');"></td>
        </tr>
    </table>
</form>
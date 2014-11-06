<?php
    require_once "../Layout/header.php";

    if (!empty($_GET['w'])) {
        $work->wid = $_GET['w'];
        $work->delete();
        header ("Location: interface.php");
    } elseif (!empty($_POST['submit'])) { //if work selected for deletion
        $work->wid = $_POST['id'];
        $work->delete();
    }
    $list = $work->listWorks(); //list this user's workplaces
?>
    
<!-- Title -->
<title>Delete Workplace</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Delete Workplace</h1>

<!-- Errors -->
<?php if (!empty($work->message)) : ?>
    <h3><?php echo $work->message; ?></h3>
<?php endif; ?>

<!-- Choose Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
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
            <td><input type="submit" name="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this workplace?');"></td>
        </tr>
    </table>
</form>
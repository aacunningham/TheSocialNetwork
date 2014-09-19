<?php
    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['choose'])) {
        $folder->id = $_POST['id'];
        $folder->get (); //get folder info
    } elseif (!empty($_POST['submit'])) {
        //Form Validation
        $folder->id = $_POST['fid'];
        $folder->name = test_input($_POST['name']);
        $folder->edit ();
    }
    $list = $folder->listAll ();
?>

<!-- Title -->
<title>Edit Folder</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Edit Folder</h1>

<?php if (!empty($folder->message)) : ?>
    <h3><?php echo $folder->message; ?></h3>
<?php endif; ?>

<?php if (!empty($folder->id)) : ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Hidden - User ID -->
        <input type="hidden" name="fid" value="<?php echo $folder->id; ?>">
        
        <!-- Content -->
        <tr>
            <td><b>Name:</b></td>
            <td><input required name="name" value="<?php if (!empty($folder->name)) echo $folder->name; elseif (!empty($_POST['name'])) echo $_POST['name']; ?>"></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>
<?php else: ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <table>
        <!-- Folder -->
        <tr>
            <td><b>Folder:</b></td>
            <td><select required name="id">
                <?php foreach ($list as $f) : ?>
                    <option value="<?php echo $f["fid"]; ?>"><?php echo $f["name"]; ?></option>
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
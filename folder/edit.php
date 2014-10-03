<?php
    require_once "../Layout/header.php";
    
    if (!empty($_POST['choose'])) { //if folder chosen for editing
        $folder->id = $_POST['id'];
        $folder->get (); //get folder info
    } elseif (!empty($_POST['submit'])) { //if edited folder submitted
        //Form Validation
        $folder->id = $_POST['fid'];
        $folder->name = test_input($_POST['name']);
        $folder->edit ();
    }
    $list = $folder->listAll (); //list all of this user's folders
?>

<!-- Title -->
<title>Edit Folder</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Edit Folder</h1>

<!-- Errors -->
<?php if (!empty($folder->message)) : ?>
    <h3><?php echo $folder->message; ?></h3>
<?php endif; ?>

<?php if (!empty($folder->id)) : ?>
    <!-- Edit Form -->
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
    <!-- Choose Form -->
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
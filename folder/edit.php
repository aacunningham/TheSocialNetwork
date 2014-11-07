<?php
    require_once "../Layout/header.php";
    
    if (!empty($_GET['f'])) {
        $folder->fid = $_GET['f'];
        $folder->get (); //get blog info
    } elseif (!empty($_POST['submit'])) { //if edited folder submitted
        //Form Validation
        $folder->fid = $_POST['fid'];
        $folder->name = test_input($_POST['name']);
        $folder->edit ();
    }
    $list = $folder->listFolders (); //list all of this user's folders
?>

<!-- Title -->
<title>Edit Folder</title>

<!-- Back Navigtion -->
<button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">Folders</button>

<!-- Heading -->
<h1>Edit Folder</h1>

<!-- Errors -->
<?php if (!empty($folder->message)) : ?>
    <h3><?php echo $folder->message; ?></h3>
<?php endif; ?>

<?php if (!empty($folder->fid)) : ?>
    <button type="button" class="btn btn-danger" onclick="deleteFn('delete.php?f=<?php echo $folder->fid; ?>')">Delete</button>
    
    <!-- Edit Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
            <!-- Hidden - User ID -->
            <input type="hidden" name="fid" value="<?php echo $folder->fid; ?>">
            
            <!-- Content -->
            <tr>
                <td><b>Name:</b></td>
                <td><input required type="text" name="name" value="<?php echoInput ($folder, 'name'); ?>"></td>
            </tr>
        </table>
            
        <!-- Submit -->
        <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
    </form>
<?php endif; ?>
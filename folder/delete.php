<?php
    require_once "../Layout/header.php";
    
    if (!empty($_GET['f'])) {
        $folder->fid = $_GET['f'];
        $folder->delete();
        header ("Location: interface.php");
    } elseif (!empty($_POST['submit'])) { //if folder selected for deletion
        $folder->fid = $_POST['id'];
        $folder->delete();
    }
    $list = $folder->listFolders(); //list this user's folders
?>
    
<!-- Title -->
<title>Delete Folder</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Delete Folder</h1>

<!-- Errors -->
<?php if (!empty($folder->message)) : ?>
    <h3><?php echo $folder->message; ?></h3>
<?php endif; ?>

<!-- Choose Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
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
            <td><input type="submit" name="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this folder?');"></td>
        </tr>
    </table>
</form>
<?php
    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['submit'])) {
        $folder->id = $_POST['id'];
        $folder->delete();
    }
    $list = $folder->listAll();
    
?>
    
<!-- Title -->
<title>Delete Folder</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Delete Folder</h1>

<?php if (!empty($folder->message)) : ?>
    <h3><?php echo $folder->message; ?></h3>
<?php endif; ?>

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
            <td><input type="submit" name="submit" value="Delete" onclick="confirm('Are you sure you want to delete this folder?');"></td>
        </tr>
    </table>
</form>
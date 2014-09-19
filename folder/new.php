<?php
    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['submit'])) {
        $folder->name = test_input ($_POST['name']);
        $folder->create ();
    }
?>

<!-- Title -->
<title>New Folder</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>New Folder</h1>

<?php if (!empty($folder->message)) : ?>
    <h3><?php echo $folder->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Content -->
        <tr>
            <td><b>Name:</b></td>
            <td><input required name="name" type="text" value="<?php if (!empty($_POST['name'])) echo $_POST['name']; ?>"></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

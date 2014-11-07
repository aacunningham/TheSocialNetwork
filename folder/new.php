<?php
    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //if new folder submitted
        $folder->name = test_input ($_POST['name']);
        $folder->create ();
        header ("Location: interface.php");
    }
?>

<!-- Title -->
<title>New Folder</title>

<body style="padding-top:70px">
<?php nav_bar(); ?>

<!-- Back Navigtion -->
<button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">Folders</button>

<!-- Heading -->
<h1>New Folder</h1>

<!-- Errors -->
<?php if (!empty($folder->message)) : ?>
    <h3><?php echo $folder->message; ?></h3>
<?php endif; ?>

<!-- New Folder Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class='form'>
        <table>
            <!-- Content -->
            <tr>
                <td><b>Name:</b></td>
                <td><input required name="name" type="text" value="<?php printPost('name'); ?>"></td>
            </tr>
        </table>
    </div>
    <!-- Submit -->
    <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
</form>

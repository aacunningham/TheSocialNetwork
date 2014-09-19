<?php
    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['submit'])) {
        $category->name = test_input ($_POST['name']);
        $category->create ();
    }
?>

<!-- Title -->
<title>New Category</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>New Category</h1>

<?php if (!empty($category->message)) : ?>
    <h3><?php echo $category->message; ?></h3>
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

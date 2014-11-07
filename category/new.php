<?php
    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //if new category submitted
        $category->name = test_input ($_POST['name']);
        $category->create ();
        header ("Location: interface.php");
    }
?>

<!-- Title -->
<title>New Category</title>

<body style="padding-top:70px">
<?php nav_bar(); ?>

<!-- Back Navigtion -->
<button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">Categories</button>

<!-- Heading -->
<h1>New Category</h1>

<!-- Errors -->
<?php if (!empty($category->message)) : ?>
    <h3><?php echo $category->message; ?></h3>
<?php endif; ?>

<!-- Category Form -->
<div class='form'>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Content -->
        <tr>
            <td><b>Name:</b></td>
            <td><input required name="name" type="text" value="<?php printPost('name'); ?>"></td>
        </tr>
    </table>
    <!-- Submit -->
    <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
</form>
</div>

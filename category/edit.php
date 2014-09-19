<?php
    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_POST['choose'])) {
        $category->id = $_POST['id'];
        $category->get (); //get category info
    } elseif (!empty($_POST['submit'])) {
        //Form Validation
        $category->id = $_POST['cid'];
        $category->name = test_input($_POST['name']);
        $category->edit ();
    }
    
    $categoryList = $category->listAll ();
?>

<!-- Title -->
<title>Edit Category</title>

<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Edit Category</h1>

<?php if (!empty($category->message)) : ?>
    <h3><?php echo $category->message; ?></h3>
<?php endif; ?>

<?php if (!empty($category->id)) : ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <table>
        <!-- Hidden - User ID -->
        <input type="hidden" name="cid" value="<?php echo $category->id; ?>">
        
        <!-- Content -->
        <tr>
            <td><b>Name:</b></td>
            <td><input required name="name" value="<?php if (!empty($category->name)) echo $category->name; elseif (!empty($_POST['name'])) echo $_POST['name']; ?>"></td>
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
        <!-- Blog -->
        <tr>
            <td><b>Blog:</b></td>
            <td><select required name="id">
                <?php foreach ($categoryList as $c) : ?>
                    <option value="<?php echo $c["cid"]; ?>"><?php echo $c["name"]; ?></option>
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

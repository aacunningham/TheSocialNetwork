<?php
    require_once "../Layout/header.php";
    
    if (!empty($_POST['choose'])) { //if category chosen for editing
        $category->cid = $_POST['id'];
        $category->get (); //get category info
    } elseif (!empty($_POST['submit'])) { //if edited category submitted
        //Form Validation
        $category->cid = $_POST['cid'];
        $category->name = test_input($_POST['name']);
        $category->edit ();
    }
    
    $categoryList = $category->listAll (); //list all sitewide categories
?>

<!-- Title -->
<title>Edit Category</title>

<!-- Back Navigtion -->
<button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">Categories</button>

<!-- Heading -->
<h1>Edit Category</h1>

<!-- Errors -->
<?php if (!empty($category->message)) : ?>
    <h3><?php echo $category->message; ?></h3>
<?php endif; ?>

<?php if (!empty($category->cid)) : ?>
    <button type="button" class="btn btn-danger" onclick="deleteFn('delete.php?c=<?php echo $category->cid; ?>');">Delete</button>
    <!-- Edit Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
            <!-- Hidden - User ID -->
            <input type="hidden" name="cid" value="<?php echo $category->cid; ?>">
            
            <!-- Content -->
            <tr>
                <td><b>Name:</b></td>
                <td><input required name="name" value="<?php echoInput($category, 'name'); ?>"></td>
            </tr>
        </table>
        
        <!-- Submit -->
        <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
    </form>
<?php else: ?>
    <!-- Choose Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <table>
            <!-- Category -->
            <tr>
                <td><b>Category:</b></td>
                <td><select required name="id">
                    <?php foreach ($categoryList as $c) : ?>
                        <option value="<?php echo $c["cid"]; ?>"><?php echo $c["name"]; ?></option>
                    <?php endforeach; ?>
                </select></td>
            </tr>
        </table>
        
        <!-- Submit -->
        <button class="btn btn-success" type="submit" name="choose" value="Edit">Submit</button>
    </form>
<?php endif; ?>

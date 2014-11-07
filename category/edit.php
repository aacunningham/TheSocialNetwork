<?php
    require_once "../Layout/header.php";
    
    if (!empty($_GET['c'])) {
        $category->cid = $_GET['c'];
        $category->get (); //get category info
        if (isset($_GET['del'])) {
            $category->delete();
            header ("Location: interface.php");
        }
    } 
    if (!empty($_POST['submit'])) { //if edited category submitted
        //Form Validation
        $category->cid = $_POST['cid'];
        $category->name = test_input($_POST['name']);
        $category->edit ();
        header ("Location: interface.php");
    }
    
    $categoryList = $category->listAll (); //list all sitewide categories
?>

<!-- Title -->
<title>Edit Category</title>

<body style="padding-top:70px">
<?php nav_bar(); ?>

<!-- Back Navigtion -->
<button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">Categories</button>

<!-- Heading -->
<h1>Edit Category</h1>

<!-- Errors -->
<?php if (!empty($category->message)) : ?>
    <h3><?php echo $category->message; ?></h3>
<?php endif; ?>

<?php if (!empty($category->cid)) : ?>
    <button type="button" class="btn btn-danger" onclick="deleteFn('?c=<?php echo $category->cid; ?>&del');">Delete</button>
    <!-- Edit Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class='form'> 
            <table>
                <!-- Hidden - User ID -->
                <input type="hidden" name="cid" value="<?php echo $category->cid; ?>">
                
                <!-- Content -->
                <tr>
                    <td><b>Name:</b></td>
                    <td><input required name="name" value="<?php echoInput($category, 'name'); ?>"></td>
                </tr>
            </table>
        </div>
        <!-- Submit -->
        <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
    </form>
<?php endif; ?>

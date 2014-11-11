<?php

    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_GET['m'])) {
        $module->get (array("name", "uid"), array(str_replace("_", " ", $_GET['m']), $user->uid), true);
    } 
    if (!empty($_POST['submit'])) {
        //Form Validation
        $module->mid = test_input($_POST['mid']);
        $module->name = test_input($_POST['name']);
        $module->background = !empty($_POST['backgroundLink']) ? test_input($_POST['backgroundLink']) : test_input($_POST['backgroundColor']);
        $module->fontColor = test_input($_POST['fontColor']);
        $module->edit ();
        header ("Location: profile.php");
    }
    $list = $module->listModules();
?>

<!-- Title -->
<title>Edit Module</title>

<body style="padding-top:70px">
<?php nav_bar(); ?>

<!-- Back Navigtion -->
<button type="button" class="left btn btn-primary" onclick="window.location.href='profile.php'">My Profile</button>

<!-- Heading -->
<h1>Edit <?php if (!empty($module->name)) echo ucwords($module->name); ?> Module</h1>

<?php if (!empty($module->message)) : ?>
    <h3><?php echo $module->message; ?></h3>
<?php endif; ?>

<?php if (!empty($module->mid)) : ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <div class='form'>
            <table>
                <!-- Hidden - Module ID -->
                <input type="hidden" name="mid" value="<?php echo $module->mid; ?>">
                
                <!-- Hidden - Module ID -->
                <input type="hidden" name="name" value="<?php echo $module->name; ?>">
                
                <!-- Background -->
                <tr>
                    <td><b>Background Color:</b></td>
                    <td><input type='color' name="backgroundColor" value="<?php echo (!empty($module->background) and substr($module->background, 0, 1) == "#") ? $module->background : '#FFFFFF'; ?>"><?php if (!empty($_POST['background'])) echo $_POST['background']; ?></td>
                </tr>
                
                <!-- Background Image -->
                <tr>
                    <td><b>Background Image:</b></td>
                    <td><input type="text" name="backgroundLink" value="<?php echo (!empty($module->background) and !(substr($module->background, 0, 1) == "#")) ? $module->background : ''; ?>"></td>
                </tr>
                
                <!-- Font Color -->
                <tr>
                    <td><b>Font Color:</b></td>
                    <td><input type='color' required name="fontColor" value="<?php echo !empty($module->fontColor) ? $module->fontColor : ''; ?>"><?php if (!empty($_POST['fontColor'])) echo $_POST['fontColor']; ?></td>
                </tr>
            </table>
        </div>
        
        <!-- Submit -->
        <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
    </form>
<?php endif; ?>

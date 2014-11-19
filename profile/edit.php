<?php

    require_once "../Layout/header.php";
    require_once "../assets/functions.php";
    
    if (!empty($_GET['m'])) {
        $module->get (array("name", "uid"), array(str_replace("_", " ", $_GET['m']), $user->uid), true);
    } 
    if (!empty($_POST['submit'])) {
        //Form Validation
        $module->mid = test_input($_POST['mid']);
        $module->font_normal = test_input($_POST['font-normal']);
        $module->font_header = test_input($_POST['font-header']);
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
                
                <!-- Font size of normal text -->
                <tr>
                    <td><b>Font Size (Normal Text):</b></td>
                    <td><select name='font-normal'>
                        <option value="12px" <?php echo (!empty($module->font_normal) and $module->font_normal == "12px") ? 'selected' : ''; ?>>Small</option>
                        <option value="14px" <?php echo (empty($module->font_normal) or $module->font_normal == "14px") ? 'selected' : ''; ?>>Normal</option>
                        <option value="16px" <?php echo (!empty($module->font_normal) and $module->font_normal == "16px") ? 'selected' : ''; ?>>Large</option>
                        <option value="18px" <?php echo (!empty($module->font_normal) and $module->font_normal == "18px") ? 'selected' : ''; ?>>Larger</option>
                        <option value="20px" <?php echo (!empty($module->font_normal) and $module->font_normal == "20px") ? 'selected' : ''; ?>>Largest</option>
                    </select></td>
                </tr>
                
                <!-- Font size of header -->
                <tr>
                    <td><b>Font Size (Header):</b></td>
                    <td><select name='font-header'>
                        <option value="20px" <?php echo (!empty($module->font_header) and $module->font_header == "20px") ? 'selected' : ''; ?>>Small</option>
                        <option value="22px" <?php echo (empty($module->font_header) or $module->font_header == "22px") ? 'selected' : ''; ?>>Normal</option>
                        <option value="24px" <?php echo (!empty($module->font_header) and $module->font_header == "24px") ? 'selected' : ''; ?>>Large</option>
                        <option value="28px" <?php echo (!empty($module->font_header) and $module->font_header == "26px") ? 'selected' : ''; ?>>Larger</option>
                        <option value="30px" <?php echo (!empty($module->font_header) and $module->font_header == "28px") ? 'selected' : ''; ?>>Largest</option>
                    </select></td>
                </tr>
                
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

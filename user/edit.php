<?php

    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //if edited user submitted
        //Form Validation
        $user->uid = $_POST['uid'];
        $user->email = test_input($_POST['email']);
        $user->fname = test_input($_POST['fname']);
        $user->lname = test_input($_POST['lname']);
        if (!empty($_FILES['picture']['tmp_name'])) {
            $user->picture = saveFile ('picture', "../assets/$user->email");
        }
        $user->interests = test_input($_POST['interests']);
        $user->hobbies = test_input($_POST['hobbies']);
        $user->bio = test_input($_POST['bio']);
        $user->rel = test_input($_POST['rel']);
        $user->privacy = test_input($_POST['privacy']);
        $user->edit ();
        if ($_POST['redirect']) {
            header ("Location: ../profile/profile.php");
        }
    } elseif (!empty($_POST['cancel'])) {
          header ("Location: ../profile/profile.php");
    } else {
        //Get User Information
        $user->uid = $_SESSION['uid'];
        $user->get (); //get user info
    }
?>

<!-- Title -->
<title>Edit User</title>
</head>
<!-- Back Navigtion -->
<a href="interface.php" target="_self">Home</a>

<!-- Heading -->
<h1>Edit User</h1>

<!-- Errors -->
<?php if (!empty($user->message)) : ?>
    <h3><?php echo $user->message; ?></h3>
<?php endif; ?>

<!-- Edit User Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <!-- Hidden - User ID -->
    <input type="hidden" name="uid" value="<?php echo $user->uid; ?>">
    <!-- Redirect to Profile? -->
    <input type="hidden" name="redirect" value="<?php echo isset($_GET['u']); ?>">
    <table>
        <!-- First Name -->
        <tr>
            <td><b>First Name:</b></td>
            <td><input required type="text" name="fname" value="<?php echoInput ($user, 'fname'); ?>"></td>
        </tr>
        
        <!-- Last Name -->
        <tr>
            <td><b>Last Name:</b></td>
            <td><input required type="text" name="lname" value="<?php echoInput ($user, 'lname'); ?>"></td>
        </tr>
        
        <!-- Email -->
        <tr>
            <td><b>Email:<b></td>
            <td><input required type="email" name="email" value="<?php echoInput ($user, 'email'); ?>"></td>
        </tr>
        
        <!-- Picture -->
        <tr>
            <td><b>Picture:<b></td>
            <td><input type="file" name="picture" value="<?php if (!empty($user->picture)) echo $user->picture; elseif (!empty($_FILES['picture'])) echo $_FILES['picture']; ?>"></td>
        </tr>
        
        <!-- Interests -->
        <tr>
            <td><b>Interests:<b></td>
            <td><textarea name="interests"><?php echoInput ($user, 'interests'); ?></textarea></td>
        </tr>
        
        <!-- Hobbies -->
        <tr>
            <td><b>Hobbies:<b></td>
            <td><textarea name="hobbies"><?php echoInput ($user, 'hobbies'); ?></textarea></td>
        </tr>
        
        <!-- Bio -->
        <tr>
            <td><b>Bio:<b></td>
            <td><textarea name="bio"><?php echoInput ($user, 'bio'); ?></textarea></td>
        </tr>
        
        <!-- Relationship Status -->
        <tr>
            <td><b>Relationship Status:<b></td>
            <td><input type="radio" name="rel" value="single" <?php if ((!empty($user->rel) and strtolower($user->rel) == "single") or (!empty($_POST['rel']) and $_POST['rel'] == "single")) echo "checked";?>>Single
            <input type="radio" name="rel" value="taken" <?php if ((!empty($user->rel) and strtolower($user->rel) == "taken") or (!empty($_POST['rel']) and $_POST['rel'] == "taken")) echo "checked";?>>Taken</td>
        </tr>
        
        <!-- Privacy Settings -->
        <tr>
            <td><b>Privacy Setting:</b></td>
            <td><select name='privacy'>
                <option value="<?php echo $user->public; ?>" <?php if (!empty($user->privacy) and $user->privacy == $user->public) echo "selected"; ?>>Public, not signed in</option>
                <option value="<?php echo $user->publicToUsers; ?>" <?php if (!empty($user->privacy) and $user->privacy == $user->publicToUsers) echo "selected"; ?>>Public, signed in users</option>
                <option value="<?php echo $user->friendsOnly; ?>" <?php if (!empty($user->privacy) and $user->privacy == $user->friendsOnly) echo "selected"; ?>>Friends Only</option>
            </select></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
            <?php if (isset($_GET['u'])) : ?>
                <td><button type="submit" name="cancel" value="Cancel">Cancel</button></td>
            <?php endif; ?>
        </tr>
    </table>
</form>

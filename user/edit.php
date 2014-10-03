<?php

    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //if edited user submitted
        //Form Validation
        $user->id = $_POST['uid'];
        $user->email = test_input($_POST['email']);
        $user->fname = test_input($_POST['fname']);
        $user->lname = test_input($_POST['lname']);
        if (!empty($_FILES['picture']['tmp_name'])) {
            $user->picture = saveFile ('picture', "assets/$user->email");
        }
        $user->interests = test_input($_POST['interests']);
        $user->hobbies = test_input($_POST['hobbies']);
        $user->bio = test_input($_POST['bio']);
        $user->rel = test_input($_POST['rel']);
        $user->edit ();
    } else {
        //Get User Information
        $user->id = $_SESSION['uid'];
        $user->get (); //get user info
    }
?>

<!-- Title -->
<title>Edit User</title>

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
    <table>
        <!-- Hidden - User ID -->
        <input type="hidden" name="uid" value="<?php echo $user->id; ?>">
        
        <!-- First Name -->
        <tr>
            <td><b>First Name:</b></td>
            <td><input required type="text" name="fname" value="<?php if (!empty($user->fname)) echo $user->fname; elseif (!empty($_POST['fname'])) echo $_POST['fname']; ?>"></td>
        </tr>
        
        <!-- Last Name -->
        <tr>
            <td><b>Last Name:</b></td>
            <td><input required type="text" name="lname" value="<?php if (!empty($user->lname)) echo $user->lname; elseif (!empty($_POST['lname'])) echo $_POST['lname']; ?>"></td>
        </tr>
        
        <!-- Email -->
        <tr>
            <td><b>Email:<b></td>
            <td><input required type="email" name="email" value="<?php if (!empty($user->email)) echo $user->email; elseif (!empty($_POST['email'])) echo $_POST['email']; ?>"></td>
        </tr>
        
        <!-- Picture -->
        <tr>
            <td><b>Picture:<b></td>
            <td><input type="file" name="picture" value="<?php if (!empty($user->picture)) echo $user->picture; elseif (!empty($_FILES['picture'])) echo $_FILES['picture']; ?>"></td>
        </tr>
        
        <!-- Interests -->
        <tr>
            <td><b>Interests:<b></td>
            <td><textarea name="interests"><?php if (!empty($user->interests)) echo $user->interests; elseif (!empty($_POST['interests'])) echo $_POST['interests']; ?></textarea></td>
        </tr>
        
        <!-- Hobbies -->
        <tr>
            <td><b>Hobbies:<b></td>
            <td><textarea name="hobbies"><?php if (!empty($user->hobbies)) echo $user->hobbies; elseif (!empty($_POST['hobbies'])) echo $_POST['hobbies']; ?></textarea></td>
        </tr>
        
        <!-- Bio -->
        <tr>
            <td><b>Bio:<b></td>
            <td><textarea name="bio"><?php if (!empty($user->bio)) echo $user->bio; elseif (!empty($_POST['bio'])) echo $_POST['bio']; ?></textarea></td>
        </tr>
        
        <!-- Relationship Status -->
        <tr>
            <td><b>Relationship Status:<b></td>
            <td><input type="radio" name="rel" value="single" <?php if ((!empty($user->rel) and strtolower($user->rel) == "single") or (!empty($_POST['rel']) and $_POST['rel'] == "single")) echo "checked";?>>Single
            <input type="radio" name="rel" value="taken" <?php if ((!empty($user->rel) and strtolower($user->rel) == "taken") or (!empty($_POST['rel']) and $_POST['rel'] == "taken")) echo "checked";?>>Taken</td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

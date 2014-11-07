<?php

    require_once "../Layout/header.php";
    
    if (!empty($_POST['submit'])) { //new user submitted
        if (test_input($_POST['password1']) == test_input($_POST['password2'])) {
            $user->password = test_input(password_hash($_POST['password1'], PASSWORD_BCRYPT));
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
            $user->create ();
        } else {
            $user->message = "Error: passwords don't match";
        }
    }
?>

<!-- Title -->
<title>New User</title>

<!-- Back Navigtion -->
<button type="button" class="left btn btn-primary" onclick="window.location.href='interface.php'">User</button>

<!-- Heading -->
<h1>New User</h1>

<!-- Errors -->
<?php if (!empty($user->message)) : ?>
    <h3><?php echo $user->message; ?></h3>
<?php endif; ?>

<!-- New User Form -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <table>
        <!-- First Name -->
        <tr>
            <td><b>First Name:</b></td>
            <td><input required type="text" name="fname" value="<?php printPost('fname'); ?>"></td>
        </tr>
        
        <!-- Last Name -->
        <tr>
            <td><b>Last Name:</b></td>
            <td><input required type="text" name="lname" value="<?php printPost('lname'); ?>"></td>
        </tr>
        
        <!-- Email -->
        <tr>
            <td><b>Email:<b></td>
            <td><input required type="email" name="email" value="<?php printPost('email'); ?>"></td>
        </tr>
        
        <!-- Password -->
        <tr>
            <td><b>Password:</b></td>
            <td><input required type="password" name="password1"></td>
        </tr>
        
        <!-- Retype Password -->
        <tr>
            <td><b>Retype Password:</b></td>
            <td><input required type="password" name="password2"></td>
        </tr>
        
        <!-- Picture -->
        <tr>
            <td><b>Picture:<b></td>
            <td><input type="file" name="picture" value="<?php printPost($_FILES['picture']); ?>"></td>
        </tr>
        
        <!-- Interests -->
        <tr>
            <td><b>Interests:<b></td>
            <td><textarea name="interests"><?php printPost('interests'); ?></textarea></td>
        </tr>
        
        <!-- Hobbies -->
        <tr>
            <td><b>Hobbies:<b></td>
            <td><textarea name="hobbies"><?php printPost('hobbies'); ?></textarea></td>
        </tr>
        
        <!-- Bio -->
        <tr>
            <td><b>Bio:<b></td>
            <td><textarea name="bio"><?php printPost('bio'); ?></textarea></td>
        </tr>
        
        <!-- Relationship Status -->
        <tr>
            <td><b>Relationship Status:<b></td>
            <td><input type="radio" name="rel" value="single" <?php if (!empty($_POST['rel']) and $_POST['rel'] == "single") echo "checked"; ?>>Single
            <input type="radio" name="rel" value="taken" <?php if (!empty($_POST['rel']) and $_POST['rel'] == "taken") echo "checked"; ?>>Taken</td>
        </tr>
        
        <!-- Privacy Settings -->
        <tr>
            <td><b>Privacy Setting:</b></td>
            <td><select name='privacy'>
                <option value="<?php echo $user->public; ?>">Public, not signed in</option>
                <option value="<?php echo $user->publicToUsers; ?>">Public, signed in users</option>
                <option value="<?php echo $user->friendsOnly; ?>">Friends Only</option>
            </select></td>
        </tr>
    </table>
    
    <!-- Submit -->
    <button class="btn btn-success" type="submit" name="submit" value="submit">Submit</button>
</form>

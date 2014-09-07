<?php

    require_once "../Layout/header.php";

    if (!empty($_POST['newUser'])) {
        if ($_POST['password1'] == $_POST['password2']) {
            $user->password = $_POST['password1'];
            $user->email = $_POST['email'];
            $user->name = $_POST['name'];
            if (!empty($_FILES['picture']['tmp_name'])) {
                $user->picture = saveFile ('picture', "assets/$user->email");
            }
            $user->interests = $_POST['interests'];
            $user->hobbies = $_POST['hobbies'];
            $user->bio = $_POST['bio'];
            $user->rel = $_POST['rel'];
            $user->add ();
        } else {
            $user->message = "Error: passwords don't match";
        }
    }
?>


<title>New User</title>

<h1>New User</h1>

<?php if (!empty($user->message)) : ?>
    <h3><?php echo $user->message; ?></h3>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td><b>Name:</b></td>
            <td><input required type="text" name="name" value="<?php if (!empty($_POST['name'])) echo $_POST['name']; ?>"></td>
        </tr>
        <tr>
            <td><b>Email:<b></td>
            <td><input required type="email" name="email" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>"></td>
        </tr>
        <tr>
            <td><b>Password:</b></td>
            <td><input required type="password" name="password1"></td>
        </tr>
        <tr>
            <td><b>Retype Password:</b></td>
            <td><input required type="password" name="password2"></td>
        </tr>
        <tr>
            <td><b>Picture:<b></td>
            <td><input type="file" name="picture" value="<?php if (!empty($_FILES['picture'])) echo $_FILES['picture']; ?>"></td>
        </tr>
        <tr>
            <td><b>Interests:<b></td>
            <td><textarea name="interests"><?php if (!empty($_POST['interests'])) echo $_POST['interests']; ?></textarea></td>
        </tr>
        <tr>
            <td><b>Hobbies:<b></td>
            <td><textarea name="hobbies"><?php if (!empty($_POST['hobbies'])) echo $_POST['hobbies']; ?></textarea></td>
        </tr>
        <tr>
            <td><b>Bio:<b></td>
            <td><textarea name="bio"><?php if (!empty($_POST['bio'])) echo $_POST['bio']; ?></textarea></td>
        </tr>
        <tr>
            <td><b>Relationship Status:<b></td>
            <td><input type="radio" name="rel" value="single" <?php if (!empty($_POST['rel']) and $_POST['rel'] == "single") echo "selected"; ?>>Single
            <input type="radio" name="rel" value="taken" <?php if (!empty($_POST['rel']) and $_POST['rel'] == "taken") echo "selected"; ?>>Taken</td>
        </tr>
        <tr>
            <td><input type="submit" name="newUser"></td>
        </tr>
    </table>
</form>

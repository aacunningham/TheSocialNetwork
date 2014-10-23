<?php

    //try to integrate with aaron's code
    //add ability to link to a photo for profile photo

    require_once "../Layout/header.php";
    
    $results = array ();
    
    if (!empty($_POST['submit'])) { //new search submitted
        $results = $user->search($_POST['search']);
    }
    
    if (!empty($_POST['friend'])) {
        $user->makeFriend($_POST['email']);
    }
    
?>

    <title>Make Friends</title>
    
    <!-- Back Navigtion -->
    <a href="interface.php" target="_self">Home</a>

    <h1>Search for friends by email or name!</h1>
    
    <!-- Errors -->
    <?php if (!empty($user->message)) : ?>
        <h3><?php echo $user->message; ?></h3>
    <?php endif; ?>
    
    <!-- New User Form -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
            <!-- Email or Name -->
            <tr>
                <td><b>Email or Name:</b></td>
                <td><input required type="text" name="search" value="<?php if (!empty($_POST['search'])) echo $_POST['search']; ?>">
                
                <!-- Submit -->
                <input type="submit" name="submit" value="Search">
                </td>
            </tr>
        </table>
    </form>

<?php if (!empty($results)) : ?>
    <h3 class='center'>Results Found!</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Friend</th>
        </tr>
        <?php foreach ($results as $friend) : ?>
        <tr>
            <td><?php echo $friend['fname']." ".$friend['lname']; ?></td>
            <td><?php echo $friend['email']; ?></td>
            <td><form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type='hidden' name='email' value="<?php echo $friend['email']; ?>">
                    <input type='submit' name='friend' value="Friend This User">
                </form></td>
        </tr>
        <?php endforeach; ?>
    </table>  
<?php endif; ?>



















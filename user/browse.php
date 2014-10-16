<?php

    require_once "../Layout/header.php";
    
    $notFriends = $user->getOthers ();
?>
    <title>Browse</title>
    
    <!-- Back Navigtion -->
    <a href="interface.php" target="_self">Home</a>

    <h1>Browse for Users</h1>
    
    <!-- Errors -->
    <?php if (!empty($user->message)) : ?>
        <h3><?php echo $user->message; ?></h3>
    <?php endif; ?>
    
    <table>
        <tr>
            <th>Name</th>
            <th>Profile</th>
        </tr>
        <?php foreach ($notFriends as $u) : ?>
        <tr>
            <td><?php echo $u['fname']." ".$u['lname']; ?></td>
            <td><a href="../profile/profile.php?u=<?php echo $u['uid']; ?>" target="_self">View Their Profile</a></td>
        </tr>
        <?php endforeach; ?>
    </table>  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<?php
    require_once "../Layout/header.php";
    
    if (!empty($_GET['f'])) {
        $friend = new user ();
        $friend->uid = $_GET['f'];
        $friend->get ();
        $user->unFriend ($friend->email);
    }
?>

<script type="text/javascript">
    redirect ("/profile/profile.php");
</script>

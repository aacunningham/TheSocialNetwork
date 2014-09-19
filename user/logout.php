<?php

    require_once "../assets/functions.php";
    require_once "user.php";

    $user = new user ();
    $user->logout ();
?>

    <script type="text/javascript">
        redirect ("login.php");
    </script>

<?php

    require_once "../assets/functions.php";
    require_once "user.php";

    $user = new user ();
    $user->logout (); //log the user out
?>

    <script type="text/javascript">
        redirect ("login.php"); //redirect to login page
    </script>

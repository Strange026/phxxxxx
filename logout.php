<?php
require('connection.inc.php');
require('functions.inc.php');
        unset($_SESSION['USER_LOGIN']);
        unset($_SESSION['USER_ID']);
        unset($_SESSION['USER_NAME']);
        echo '<script>alert("Logged Out");
        window.location.href="index.php";
        </script>';
        die();
?>
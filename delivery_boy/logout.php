<?php
    session_start();
    unset($_SESSION['DELIVERY_LOGIN']);
    unset($_SESSION['DELIVERY_EMAIL']);
    unset($_SESSION['DELIVERY_ID']);
    header('location:login.php');
    die();
?>
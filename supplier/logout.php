<?php
    session_start();
    unset($_SESSION['SUPPLIER_LOGIN']);
    unset($_SESSION['SUPPLIER_EMAIL']);
    unset($_SESSION['SUPPLIER_ID']);
    header('location:index.php');
    die();
?>
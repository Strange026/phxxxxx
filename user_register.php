<?php
require('connection.inc.php');
require('functions.inc.php');
$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$password=get_safe_value($con,$_POST['password']);
$confirm_password=get_safe_value($con,$_POST['confirmpassword']);

$check_user=mysqli_num_rows(mysqli_query($con,"select * from customer where email='$email'"));
    if($check_user>0){
            echo '<script>alert("Email Already Exist!!");
            window.location.href="login.php";
            </script>';

    }else{
        mysqli_query($con,"insert into customer(first_name,email,password) values('$name','$email','$password')");
        echo '<script>alert("Registration Successful");
        // window.location.href="login.php";
        </script>';
    }
?>
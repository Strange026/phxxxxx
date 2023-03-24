<?php
require('connection.inc.php');
require('functions.inc.php');

    $email=get_safe_value($con,$_POST['login_email']);
    $password=get_safe_value($con,$_POST['login_password']);
    $res=mysqli_query($con,"select * from customer where email='$email' and password='$password'");

    $check_user=mysqli_num_rows($res);
        if($check_user>0){
            $row=mysqli_fetch_assoc($res);
            $_SESSION['USER_LOGIN']='yes';
            $_SESSION['USER_ID']=$row['customer_id'];
            $_SESSION['USER_NAME']=$row['first_name'];
            echo '<script>alert("Successfully Logged in.");
            window.location.href="index.php";
            </script>';

        }else{
            echo '<script>alert("Please Enter Valid Credentials.");
            window.location.href="login.php";
            </script>';
        }
        
?>
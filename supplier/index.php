<?php
    require('connection.inc.php');
    require('functions.inc.php');
    $msg='';
    if(isset($_POST['submit'])){
        $email=get_safe_value($con,$_POST['email']);
        $password=get_safe_value($con,$_POST['password']);
        $sql="select * from suppliers where email='$email' and password='$password'";
        $res=mysqli_query($con,$sql);

        $check_user=mysqli_num_rows($res);
        if($check_user>0){
            $row=mysqli_fetch_assoc($res);
            if($row['status']==0){
               echo '<script>alert("Account Deactivated!!");
               window.location.href="index.php";
               </script>';
            }else{
               $_SESSION['SUPPLIER_LOGIN']='yes';
            $_SESSION['SUPPLIER_EMAIL']=$row['email'];
            $_SESSION['SUPPLIER_ID']=$row['supplier_id'];
            echo '<script>alert("Successfully Logged in.");
            window.location.href="product.php";
            </script>';
            }
            

        }else{
            echo '<script>alert("Please Enter Valid Credentials.");
            window.location.href="login.php";
            </script>';
        }




      //   $count=mysqli_num_rows($res);
      //   if($count>0){
      //       $_SESSION['DELIVERY_LOGIN']='yes';
      //       $_SESSION['DELIVERY_EMAIL']=$email;
      //       $_SESSION['DELIVERY_ID']=$row['db_id'];
      //       header('location:index.php');
      //       die();
      //   }else{
      //       $msg="Please enter correct login details";
      //   }
    }
?>  

<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Supplier Login</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../admin/assets/css/normalize.css">
      <link rel="stylesheet" href="../admin/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="../admin/assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="../admin/assets/css/themify-icons.css">
      <link rel="stylesheet" href="../admin/assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="../admin/assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="../admin/assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form method="post">
                     <h3 align="center" class="login-head">Supplier Login</h3>
                     <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
					</form>
                    <div class="field_error"><?php echo $msg?></div>
               </div>
            </div>
         </div>
      </div>
      <script src="../admin/assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="../admin/assets/js/popper.min.js" type="text/javascript"></script>
      <script src="../admin/assets/js/plugins.js" type="text/javascript"></script>
      <script src="../admin/assets/js/main.js" type="text/javascript"></script>
   </body>
</html>
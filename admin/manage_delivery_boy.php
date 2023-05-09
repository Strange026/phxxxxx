
<?php
require('top.inc.php');
$name='';
$email='';
$password='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from delivery_boy where db_id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
    $row=mysqli_fetch_assoc($res);
    $name=$row['delivery_boy_name'];
    $email=$row['email'];
    $password=$row['password'];
    }else{
        header('location:delivery_boy.php');
    }

}


if(isset($_POST['submit'])){
    $name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $password=get_safe_value($con,$_POST['password']);
    $added_on=date('Y-m-d h:i:s');
    $res=mysqli_query($con,"select * from delivery_boy where email='$email'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['db_id']){

            }else{
                $msg="Delivery Boy already exist";
            }
        }else{
            $msg="Delivery Boy already exist";
        }
    }
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            mysqli_query($con,"update delivery_boy set delivery_boy_name='$name', email='$email',password='$password' where db_id='$id'");
        }else{
            mysqli_query($con,"insert into delivery_boy(delivery_boy_name,email,password,added_on,status) values('$name','$email','$password','$added_on','1')");
        }
        header('location:delivery_boy.php');
        die();
    }

}


?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Delivery Boy Form</strong></div>
                    <form method="post">
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="categories" class=" form-control-label">Name</label>
                            <input title="Please Enter Only Alphabets" type="text" name="name" placeholder="Enter Name" class="form-control" required value="<?php echo $name?>">
                        </div>


                        <div class="form-group">
                            <label for="categories" class=" form-control-label">Email</label>
                            <input title="Please Enter Only Alphabets" type="email" name="email" placeholder="Enter Emial" class="form-control" required value="<?php echo $email?>">
                        </div>



                        <div class="form-group">
                            <label for="categories" class=" form-control-label">Password</label>
                            <input title="Please Enter Only Alphabets" type="password" name="password" placeholder="Enter Password" class="form-control" required value="<?php echo $password?>">
                        </div>



                        <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount" name="submit">Submit</span>
                        </button>
                        <div class="field_error"><?php echo $msg?></div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.inc.php')
?>
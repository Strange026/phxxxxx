<html>
    <head>
        <title>Manage Categories</title>
    </head>    
</html>

<?php
require('top.inc.php');
$categories='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from category where category_id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
    $row=mysqli_fetch_assoc($res);
    $categories=$row['category_name'];
    }else{
        header('location:categories.php');
    }

}


if(isset($_POST['submit'])){
    $categories=get_safe_value($con,$_POST['categories']);
    $res=mysqli_query($con,"select * from category where category_name='$categories'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['category_id']){

            }else{
                $msg="Category already exist";
            }
        }else{
            $msg="Category already exist";
        }
    }
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            mysqli_query($con,"update category set category_name='$categories' where category_id='$id'");
        }else{
            mysqli_query($con,"insert into category(category_name,status) values('$categories','1')");
        }
        header('location:categories.php');
        die();
    }

}


?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Categories Form</strong></div>
                    <form method="post">
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="categories" class=" form-control-label">Category</label>
                            <input title="Please Enter Only Alphabets" type="text" name="categories" placeholder="Enter category name" class="form-control" required value="<?php echo $categories?>">
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
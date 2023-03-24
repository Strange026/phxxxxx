<html>
    <head>
        <title>Manage Categories</title>
    </head>    
</html>

<?php
require('top.inc.php');
$categories='';
$sub_category='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from sub_category where category_id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
    $row=mysqli_fetch_assoc($res);
    $sub_category=$row['sub_category'];
    $categories=$row['category_id'];
    }else{
        header('location:sub_categories.php');
    }

}


if(isset($_POST['submit'])){
    $categories=get_safe_value($con,$_POST['category_id']);
    $sub_categories=get_safe_value($con,$_POST['sub_category']);
    $res=mysqli_query($con,"select * from sub_category where category_id='$categories' and sub_category='$sub_categories'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['sub_category_id']){

            }else{
                $msg="Sub Category already exist";
            }
        }else{
            $msg="Sub Category already exist";
        }
    }
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            mysqli_query($con,"update sub_category set category_id='$categories',sub_category='$sub_categories' where category_id='$id'");
        }else{
            mysqli_query($con,"insert into sub_category(category_id,sub_category,status) values('$categories','$sub_categories','1')");
        }
        header('location:sub_categories.php');
        die();
    }

}


?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Sub Categories Form</strong></div>
                    <form method="post">
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="categories" class=" form-control-label">Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select Categories</option>
                                <?php
                                    $res=mysqli_query($con,"select * from category where status='1'");
                                    while($row=mysqli_fetch_assoc($res)){
                                        if($row['category_id']==$categories){
                                            echo "<option value=".$row['category_id']." selected>".$row['category_name']."</option>";
                                        }else{
                                            echo "<option value=".$row['category_id'].">".$row['category_name']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                                <label for="categories" class=" form-control-label">Sub Categories</label>
                                <input pattern="[A-Za-z]+*" title="Please Enter Only Alphabets Between A to Z" type="text" name="sub_category" placeholder="Enter Sub Categories" class="form-control" required value="<?php echo $sub_category ?>">
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
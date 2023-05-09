<?php
require('top.inc.php');
$category_id = '';
$sub_category_id='';
$supplier_id = '';
$name = '';
$mrp = '';
$price = '';
$quantity = '';
$img = '';
$short_desc = '';
$description = '';
$msg = '';
$best_seller='';


$img_required = 'required';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $img_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from product where product_id='$id' and added_by='".$_SESSION['SUPPLIER_ID']."'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $category_id = $row['category_id'];
        $sub_category_id = $row['sub_category_id'];
        $supplier_id = $row['supplier_id'];
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $img = $row['img'];
        $short_desc = $row['short_desc'];
        $description = $row['description'];
        $best_seller=$row['best_seller'];
    } else {
        header('location:product.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $category_id = get_safe_value($con, $_POST['category_id']);
    $sub_category_id = get_safe_value($con, $_POST['sub_category_id']);
    $supplier_id = get_safe_value($con, $_POST['supplier_id']);
    $name = get_safe_value($con, $_POST['name']);
    $mrp = get_safe_value($con, $_POST['mrp']);
    $price = get_safe_value($con, $_POST['price']);
    $quantity = get_safe_value($con, $_POST['quantity']);
    // $img = get_safe_value($con, $_POST['img']);
    $short_desc = get_safe_value($con, $_POST['short_desc']);
    $description = get_safe_value($con, $_POST['description']);
    $best_seller = get_safe_value($con, $_POST['best_seller']);
    $res = mysqli_query($con, "select * from product where name='$name' and added_by='".$_SESSION['SUPPLIER_ID']."'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['product_id']) {
            } else {
                $msg = "Product already exist";
            }
        } else {
            $msg = "Product already exist";
        }
    }

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            if ($_FILES['image']['name'] != '') {
                $img = rand(1111111111, 9999999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/' . $img);
                $update_sql = "update product set category_id='$category_id',supplier_id='$supplier_id',name='$name',img='$img',mrp='$mrp',price='$price',quantity='$quantity',img='$img',short_desc='$short_desc',description='$description',best_seller='$best_seller',sub_category_id='$sub_category_id' where product_id='$id'";
            } else {
                $update_sql = "update product set category_id='$category_id',supplier_id='$supplier_id',name='$name',mrp='$mrp',price='$price',quantity='$quantity',short_desc='$short_desc',description='$description',best_seller='$best_seller',sub_category_id='$sub_category_id' where product_id='$id'";
            }
            mysqli_query($con, $update_sql);
        } else {
            $img = rand(1111111111, 9999999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/' . $img);
            mysqli_query($con, "INSERT INTO product(category_id,supplier_id,name,mrp,price,quantity,img,short_desc,description,status,best_seller,sub_category_id,added_by) 
            VALUES('$category_id','".$_SESSION['SUPPLIER_ID']."','$name','$mrp','$price','$quantity','$img','$short_desc','$description','1','$best_seller','$sub_category_id','".$_SESSION['SUPPLIER_ID']."')");
        }
        header('location:product.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Product Form</strong></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Category</label>
                                <select class="form-control" name="category_id" id="category_id" onchange="get_sub_cat('')" required>
                                    <option>Select Category</option>
                                    <?php
                                    $res = mysqli_query($con, "select category_id,category_name from category order by category_name asc");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        if ($row['category_id'] == $category_id) {
                                            echo "<option selected value=" . $row['category_id'] . ">" . $row['category_name'] . "</option>";
                                        } else {
                                            echo "<option value=" . $row['category_id'] . ">" . $row['category_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Sub Category</label>
                                <select class="form-control" name="sub_category_id" id="sub_category_id">
                                    <option>Select Sub Category</option>
                                </select>
                            </div>


                            <!-- <div class="form-group">
                                <label for="suppliers" class=" form-control-label">Supplier</label>
                                <select class="form-control" name="supplier_id">
                                    <option>Select Supplier</option>
                                    <?php
                                    $res = mysqli_query($con, "select supplier_id,company_name from suppliers where supplier_id='$supplier_id'");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        if ($row['supplier_id'] == $supplier_id) {
                                            echo "<option selected value=" . $row['supplier_id'] . ">" . $row['company_name'] . "</option>";
                                        } else {
                                            echo "<option value=" . $row['supplier_id'] . ">" . $row['company_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div> -->





                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Product Name</label>
                                <input pattern="[A-Za-z]+*" title="Please Enter Only Alphabets Between A to Z" type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name ?>">
                            </div>

                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Best Seller</label>
                                <select class="form-control" name="best_seller" required>
                                    <option value="">Select</option>
                                    <?php
                                        if($best_seller==1){
                                            echo '<option value="1" selected>Yes</option>
                                            <option value="0">No</option>'; 
                                        }elseif($best_seller==0){
                                            echo '<option value="1">Yes</option>
                                            <option value="0" selected>No</option>'; 
                                        }else{
                                            echo '<option value="1">Yes</option>
                                            <option value="0">No</option>'; 
                                        }
                                    ?>
                                    
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="categories" class=" form-control-label">MRP</label>
                                <input type="number" min="0" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp ?>">
                            </div>

                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Price</label>
                                <input type="number" min="0" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price ?>">
                            </div>

                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Qty</label>
                                <input type="number" min="1" max="20" name="quantity" placeholder="Enter Qty" class="form-control" required value="<?php echo $quantity ?>">
                            </div>

                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Image</label>
                                <input type="file" name="image" class="form-control" <?php echo $img_required ?>>
                            </div>

                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Short Description</label>
                                <input type="text" name="short_desc" placeholder="Enter product short description" class="form-control" required value="<?php echo $short_desc ?>">
                                </input>
                            </div>

                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Description</label>
                                <input type="text" name="description" placeholder="Enter product description" class="form-control" required value="<?php echo $description ?>">
                                </input>
                            </div>




                            <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount" name="submit">Submit</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


                                        <script>
                                            function get_sub_cat(sub_cat_id){
                                                var category_id=jQuery('#category_id').val();
                                                jQuery.ajax({
                                                    url:'get_sub_cat.php',
                                                    type:'post',
                                                    data:'category_id='+category_id+'&sub_cat_id='+sub_cat_id,
                                                    success:function(result){
                                                        jQuery('#sub_category_id').html(result);
                                                    }
                                                });
                                            }
                                        </script>
<?php
require('footer.inc.php');
?>

<script>
    <?php
    if(isset($_GET['id'])){
        ?>
            get_sub_cat('<?php echo $sub_category_id?>');
            <?php } ?>
</script>
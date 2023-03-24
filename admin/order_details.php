<?php
require('top.inc.php');
$order_id=get_safe_value($con,$_GET['id']);
if(isset($_POST['update_order_status'])){
    $update_order_status=$_POST['update_order_status'];
    mysqli_query($con,"update `order_` set order_status='$update_order_status' where order_id='$order_id'");
}
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <dic class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Detail</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Product Name</th>
                                        <th class="product-thumbnail">Product Image</th>
                                        <th class="product-name">Quantity</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-price">Total Price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res = mysqli_query($con,"select distinct(`order_details`.`order_details_id`)
                                    ,order_details.*,product.name,product.img from order_details,product,`order_` where order_details.order_id='$order_id' and order_details.product_id=product.product_id");
                                    $total_price = 0;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $total_price = $total_price + ($row['quantity'] * $row['price']);
                                    ?>
                                    <tr>
                                            <td class="product-name"><?php echo $row['name'] ?></td>
                                            <td class="product-name"><img src="<?php echo '../media/product/'.$row['img'] ?>"></td>
                                            <td class="product-name"><?php echo $row['quantity'] ?></td>
                                            <td class="product-name"><?php echo '₹' . $row['price'] ?></td>
                                            <td class="product-name"><?php echo '₹' . $row['quantity'] * $row['price'] ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="product-name">Total Price</td>
                                        <td class="product-name"><?php echo '₹' . $total_price ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        
                        <div id="address_details">
                            <!-- <strong>Address:</strong> -->
                            <!-- <?php echo $address ?>, <?php echo $city ?>, <?php echo $pincode ?></br></br> -->
                            <strong>Order Status:</strong>
                            <?php
                            $order_status_arr = mysqli_fetch_assoc(mysqli_query($con, "select order_status.name from order_status,`order_` where `order_`.order_id='$order_id' and `order_`.order_status=order_status.id"));
                            echo $order_status_arr['name'];
                            ?>
                        
                            <div>
                                <form method="post">
                                    <select class="form-control" name="update_order_status">
                                        <option>Select Status</option>
                                        <?php
                                        $res = mysqli_query($con, "select * from order_status");
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            if ($row['id'] == $order_id) {
                                                echo "<option selected value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                            } else {
                                                echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="submit" class="form-control">
                                </form>
                            
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </dic>
        </div>
    </div>

</div>

<?php
require('footer.inc.php');
?>
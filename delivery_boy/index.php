<?php
require('top.inc.php');

if(!isset($_SESSION['DELIVERY_LOGIN'])){
    header('location:login.php');
}

// $order_id=get_safe_value($con,$_GET['id']);
// if(isset($_POST['update_order_status'])){
//     $update_order_status=$_POST['update_order_status'];
//     mysqli_query($con,"update `order_` set order_status='$update_order_status' where order_id='$order_id'");
// }



if(isset($_GET['complete_order_id'])){
    $complete_order_id=get_safe_value($con,$_GET['complete_order_id']);
    mysqli_query($con,"update order_ set order_status=5 where order_id='$complete_order_id' and delivery_boy_id='".$_SESSION['DELIVERY_ID']."'");
}



?>
   <div class="content pb-0">
        <div class="orders">
            <div class="row">
                <dic class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Order</h4>
                        </div>
                        <div class="card-body--">
                            <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Order ID</th>
                                        <th class="product-name"><span class="nobr">Order Date</span></th>
                                        <th class="product-price"><span class="nobr">Address</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Payment Type</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Payment Status</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Order Status</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php      
                                    $delivery_id=$_SESSION['DELIVERY_ID'];
                                    $res = mysqli_query($con,"select order_.*,order_status.name as order_status from order_,order_status where order_.order_status=order_status.id and order_.delivery_boy_id='$delivery_id' and order_.order_status!=5 order by order_.order_id desc");     
                                    while($row = mysqli_fetch_assoc($res)){
                                    ?>
                                        <tr>
                                            <td class="product-add-to-cart"><a href="order_details.php?id=<?php echo $row['order_id']?>"><?php echo $row['order_id']?></a>
                                            <br>
                                            <a href="../invoice.php?id=<?php echo $row['order_id']?>">Invoice</a>
                                        
                                        </td>
                                            <td class="product-name"><?php echo $row['added_on']?></td>
                                            <td class="product-name">
                                                <?php echo $row['address']?><br/>
                                                <?php echo $row['city']?><br/>
                                                <?php echo $row['pincode']?>
                                            </td>
                                            <td class="product-name"><?php echo $row['payment_type']?></td>
                                            <td class="product-name"><?php echo $row['payment_status']?></td>
                                            <td class="product-name"><a href="?complete_order_id=<?php echo $row['order_id']?>"class="badge badge-complete">Set Delivered</a></td>
                                        <!-- <td class="product-name">
                                        <form method="post">
                                        <select name="update_order_status">
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
                                    <input type="submit">
                                    </form>

                                    </td> -->
                                    </tr>
                                    <?php 
                                    }

                                    ?>
                                </tbody>
                            </table>
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
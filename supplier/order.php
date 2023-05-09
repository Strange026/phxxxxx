<?php
    require('top.inc.php');

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
                                        <th class="product-name"><span class="nobr">Product Name/Qty</span></th>
                                        <th class="product-price"><span class="nobr">Address</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Payment Type</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Payment Status</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Order Status</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php      
                                     $res =mysqli_query($con,"select order_details.quantity,product.name,order_.*,order_status.name as order_status from order_details,product,order_,order_status where order_status.id=order_.order_status and product.product_id=order_details.product_id and order_.order_id=order_details.order_id and product.added_by='".$_SESSION['SUPPLIER_ID']."'  order by order_.order_id desc");     
                                    while($row = mysqli_fetch_assoc($res)){
                                    ?>
                                        <tr>
                                            <td class="product-add-to-cart"><?php echo $row['order_id']?></a>
                                            <br>
                                            
                                        
                                        </td>
                                            <td class="product-name"><?php echo $row['name']?><br>
                                            <?php echo 'Qty :'.$row['quantity']?>
                                            </td>
                                            <td class="product-name">
                                                <?php echo $row['address']?><br/>
                                                <?php echo $row['city']?><br/>
                                                <?php echo $row['pincode']?>
                                            </td>
                                            <td class="product-name"><?php echo $row['payment_type']?></td>
                                            <td class="product-name"><?php echo $row['payment_status']?></td>
                                            <td class="product-name"><?php echo $row['order_status']?></td>
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
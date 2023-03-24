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
                                        <th class="product-name"><span class="nobr">Order Date</span></th>
                                        <th class="product-price"><span class="nobr">Address</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Payment Type</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Payment Status</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Order Status</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php      
                                    $res = mysqli_query($con,"select order_.*,order_status.name as order_status from order_,order_status where order_status.id=order_.order_status");     
                                    while($row = mysqli_fetch_assoc($res)){
                                    ?>
                                        <tr>
                                            <td class="product-add-to-cart"><a href="order_details.php?id=<?php echo $row['order_id']?>"><?php echo $row['order_id']?></a></td>
                                            <td class="product-name"><?php echo $row['added_on']?></td>
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
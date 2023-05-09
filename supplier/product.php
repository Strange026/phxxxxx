<?php
require('top.inc.php');
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'status') {
        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status = "update product set status='$status' where product_id='$id' and added_by='".$_SESSION['SUPPLIER_ID']."'";
        mysqli_query($con, $update_status);
    }

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete = "delete from product where product_id='$id' and added_by='".$_SESSION['SUPPLIER_ID']."'";
        mysqli_query($con, $delete);
    }
}


$sql = "select product.*,category.category_name from product,category where product.category_id=category.category_id and product.added_by='".$_SESSION['SUPPLIER_ID']."' order by product.product_id desc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Products </h4>
                        <h4 class="box-link"><a href="manage_product.php">Add Product</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">Sr.No</th>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td class="serial"><?php echo $i++ ?></td>
                                            <td><?php echo $row['product_id'] ?></td>
                                            <td><?php echo $row['category_name'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><img src="../media/product/<?php echo $row['img'] ?>"/></td>
                                            <td><?php echo $row['mrp'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td><?php echo $row['quantity'] ?><br>

                                            <?php 
                                            $productSoldQtyByProductId=productSoldQtyByProductId($con,$row['product_id']);
                                            $row['product_id'];
                                            $pending_qty=$row['quantity']-$productSoldQtyByProductId;

                                            ?>
                                        Remaining Qty <?php echo $pending_qty?>
                                            </td>
                                            <td>
                                                <?php
                                                // if ($row['status'] == 1) {
                                                //     echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=" . $row['product_id'] . "'>Active</a> 
                                                //     </span>&nbsp";
                                                // } else {
                                                //     echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=" . $row['product_id'] . "'>Deactive</a>
                                                //     </span>&nbsp";
                                                // }
                                                echo "<span class='badge badge-edit'><a href='manage_product.php?&id=" . $row['product_id'] . "'>Edit</a></span>&nbsp;";
                                                // echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['product_id'] . "'>Delete</a></span>";


                                                //echo "&nbsp<a href='?type=edit&id=".$row['category_id']."'>Edit</a>";
                                                ?>
                                                <a href="?id=<?php echo $row['product_id']?>&type=delete" onclick="return confirm('Are You Sure!');"><label class="badge badge-delete">Delete</label></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.inc.php')
?>
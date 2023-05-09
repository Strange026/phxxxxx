<?php
    require('top.inc.php');


    if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
        $type=get_safe_value($con,$_GET['type']);
        $id=get_safe_value($con,$_GET['id']);
        
        if ($type=='active' || $type=='deactive'){
        $status=1;
        if ($type=='deactive'){
        $status=0;
        
        }
        mysqli_query($con,"update delivery_boy set status='$status' where db_id='$id'");
    }
    }
    $sql="select * from delivery_boy order by db_id";
    $res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
        <div class="orders">
            <div class="row">
                <dic class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Delivery Boy</h4>
                            <h4 class="box-link"><a href="manage_delivery_boy.php">Add Delivery Boy</a></h4>
                        </div>
                        <div class="card-body--">
                            <div class="table-stats order-table ov-h">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="serial">Sr.No</th>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Email</th>
                                            <th>Added on</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                            while($row=mysqli_fetch_assoc($res)){?>
                                            <tr>
                                                <td class="serial"><?php echo $i++?></td>
                                                <td><?php echo $row['db_id']?></td>
                                                <td><?php echo $row['delivery_boy_name']?></td>
                                                <td><?php echo $row['email']?></td>
                                                <td><?php echo $row['added_on']?></td>
                                                <td>
                                                    <a href="manage_delivery_boy.php?id=<?php echo $row['db_id']?>"><label class="badge badge-edit">Edit</label></a>
                                                    <?php
                                                        // echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['customer_id']."'>Delete</a></span>";
                                                        if ($row['status'] == 1) {
                                                    ?>
                                                    <a href="?id=<?php echo $row['db_id']?>&type=deactive"><label class="badge badge-complete">Active</label></a>
                                                    <?php
                                                        }else{
                                                            ?>
                                                            <a href="?id=<?php echo $row['db_id']?>&type=active"><label class="badge badge-pending">Deactive</label></a>
                                                            <?php 
                                                            }
                                                            ?>
                                                        


                                                            <!-- // echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=" . $row['db_id'] . "'>Active</a> 
                                                            // </span>&nbsp";
                                                        } else {
                                                            echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=" . $row['db_id'] . "'>Deactive</a>
                                                            </span>&nbsp";
                                                        }
                                                    ?> -->
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        
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
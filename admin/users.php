<?php
    require('top.inc.php');

    $sql="select * from customer order by customer_id desc";
    $res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
        <div class="orders">
            <div class="row">
                <dic class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Users</h4>
                        </div>
                        <div class="card-body--">
                            <div class="table-stats order-table ov-h">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="serial">Sr.No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Contact No</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                            while($row=mysqli_fetch_assoc($res)){?>
                                            <tr>
                                                <td class="serial"><?php echo $i++?></td>
                                                <td><?php echo $row['first_name']?></td>
                                                <td><?php echo $row['last_name']?></td>
                                                <td><?php echo $row['username']?></td>
                                                <td><?php echo $row['email']?></td>
                                                <td><?php echo $row['contact_no']?></td>
                                                <td>
                                                    <?php
                                                        echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['customer_id']."'>Delete</a></span>";
                                                    ?>
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
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
        $update_status = "update category set status='$status' where category_id='$id'";
        mysqli_query($con, $update_status);
    }
    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete = "delete from category where category_id='$id'";
        mysqli_query($con, $delete);
    }
}

$sql = "select * from category order by category_id";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Categories</h4>
                        <h4 class="box-link"><a href="manage_categories.php">Add Categories</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">Sr.No</th>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td class="serial"><?php echo $i++ ?></td>
                                            <td><?php echo $row['category_id'] ?></td>
                                            <td><?php echo $row['category_name'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=" . $row['category_id'] . "'>Active</a></span>&nbsp";
                                                } else {
                                                    echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=" . $row['category_id'] . "'>Deactive</a></span>&nbsp";
                                                }
                                                echo "<span class='badge badge-edit'><a href='manage_categories.php?&id=" . $row['category_id'] . "'>Edit</a></span>&nbsp;";

                                                echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['category_id'] . "'>Delete</a></span>";
                                                // echo "&nbsp<a href='?type=edit&id=".$row['category_id']."'>Edit</a>";
                                                ?>
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
require('footer.inc.php');
?>
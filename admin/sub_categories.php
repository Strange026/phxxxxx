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
        $update_status = "update sub_category set status='$status' where sub_category_id='$id'";
        mysqli_query($con, $update_status);
    }
    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete = "delete from sub_category where sub_category_id='$id'";
        mysqli_query($con, $delete);
    }
}

$sql = "select sub_category.*,category.category_name from sub_category,category where category.category_id=sub_category.category_id order by sub_category.sub_category asc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Sub Categories</h4>
                        <h4 class="box-link"><a href="manage_sub_categories.php">Add Sub-Categories</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">Sr.No</th>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td class="serial"><?php echo $i++ ?></td>
                                            <td><?php echo $row['sub_category_id'] ?></td>
                                            <td><?php echo $row['category_name'] ?></td>
                                            <td><?php echo $row['sub_category'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=" . $row['sub_category_id'] . "'>Active</a></span>&nbsp";
                                                } else {
                                                    echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=" . $row['sub_category_id'] . "'>Deactive</a></span>&nbsp";
                                                }
                                                echo "<span class='badge badge-edit'><a href='manage_sub_categories.php?&id=" . $row['category_id'] . "'>Edit</a></span>&nbsp;";

                                                // echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['sub_category_id'] . "'>Delete</a></span>";
                                                // echo "&nbsp<a href='?type=edit&id=".$row['category_id']."'>Edit</a>";
                                                ?>
                                                <a href="?id=<?php echo $row['sub_category_id']?>&type=delete" onclick="return confirm('Are You Sure!');"><label class="badge badge-delete">Delete</label></a>
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
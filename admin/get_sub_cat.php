<?php
require('connection.inc.php');
require('functions.inc.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

}else{
    header('location:index.php');
    die();
}
$category_id=get_safe_value($con,$_POST['category_id']);
$sub_cat_id=get_safe_value($con,$_POST['sub_cat_id']);
$res=mysqli_query($con,"select * from sub_category where category_id='$category_id' and status='1'");
if(mysqli_num_rows($res)>0){
    $html='';
    while($row=mysqli_fetch_assoc($res)){
        if($sub_cat_id==$row['sub_category_id']){
            $html.="<option value=".$row['sub_category_id']." selected>".$row['sub_category']."</option>";
        }else{
            $html.="<option value=".$row['sub_category_id'].">".$row['sub_category']."</option>";
        }

    }
    echo $html;
}else{
    echo "<option value=''>No Sub Category Found</option>";
}
?>
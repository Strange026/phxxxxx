<?php
    function pr($arr){
        echo '<pre>';
        print_r($arr);
    }

    function prx($arr){
        echo '<pre>';
        print_r($arr);
        die();
    }

    function get_safe_value($con,$str){
        if(($str!='')){
        $str=trim($str);
        return mysqli_real_escape_string($con,$str);
        }
    }

    function productSoldQtyByProductId($con,$product_id){
        $sql="select sum(order_details.quantity) as quantity from order_details,`order_` where `order_`.order_id=order_details.order_id and order_details.product_id=$product_id and `order_`.order_status!=4";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($res);
        return $row['quantity'];
    }
?>
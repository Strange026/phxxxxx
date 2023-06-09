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

    function get_product($con,$limit='',$cat_id='',$product_id='',$sort_order='',$is_best_seller='',$sub_category=''){
        $sql="select product.*,category.category_name from product,category where product.status=1";
        if($cat_id!=''){
            $sql.=" and product.category_id=$cat_id";
        }
        if($sub_category!=''){
            $sql.=" and product.sub_category_id=$sub_category";
        }
        if($product_id!=''){
            $sql.=" and product.product_id=$product_id";
        }
        if($is_best_seller!=''){
            $sql.=" and product.best_seller=1";
        }
        $sql.=" and product.category_id=category.category_id";
        if($sort_order!=''){
            $sql.=$sort_order;
        }else{
            $sql.=" order by product.product_id desc";

        }
        if($limit!=''){
            $sql.=" limit $limit";
        }
        $res=mysqli_query($con,$sql);
        $data=array();
        while($row=mysqli_fetch_assoc($res)){
            $data[]=$row;
        }
        return $data;
    }

    function productSoldQtyByProductId($con,$product_id){
        $sql="select sum(order_details.quantity) as quantity from order_details,`order_` where `order_`.order_id=order_details.order_id and order_details.product_id=$product_id and `order_`.order_status!=4";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($res);
        return $row['quantity'];
    }


    function productQty($con,$product_id){
        $sql="select quantity from product where product_id='$product_id'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($res);
        return $row['quantity'];
    }
?>
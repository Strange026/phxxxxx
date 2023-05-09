<?php
include('vendor/autoload.php');
require('connection.inc.php');
require('functions.inc.php');
$order_id = get_safe_value($con, $_GET['id']);




if(!$_SESSION['ADMIN_LOGIN']){
    if(!isset($_SESSION['USER_ID'])){
        die();
    }
    
}



//get invoices data
$query=mysqli_query($con,"select order_.*,customer.first_name,customer.contact_no from order_,customer where  order_id='".$_GET['id']."'");
$invoice=mysqli_fetch_array($query);

$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage();


$mpdf->SetFont('Arial', 'B', 14);
//Cell(width,height,text,border,new line,[align])
$mpdf->Cell(130, 5, 'Phoenix Computers', 0, 0,);
$mpdf->Cell(59, 5, 'INVOICE', 0, 1); //end of line     

$mpdf->SetFont('Arial', '', 12);
$mpdf->Cell(130, 5, '', 0, 0);
$mpdf->Cell(59, 5, '', 0, 1); //end of line

$mpdf->Cell(130, 5, '', 0, 0);
$mpdf->Cell(25, 5, 'Date:', 0, 0,);
$mpdf->Cell(34, 5, $invoice['added_on'], 0, 1); //end of line


$mpdf->Cell(130, 5, '', 0, 0);
$mpdf->Cell(25, 5, 'Order ID:', 0, 0,);
$mpdf->Cell(34, 5, $invoice['order_id'], 0, 1,'C'); //end of line

$mpdf->Cell(130, 5, '', 0, 0);
$mpdf->Cell(25, 5, 'Customer ID:', 0, 0,);
$mpdf->Cell(34, 5,$invoice['customer_id'], 0, 1,'C'); //end of line

$mpdf->Cell(130, 5, '', 0, 0);
$mpdf->Cell(25, 5, 'Customer Name:', 0, 0,);
$mpdf->Cell(34, 5,$invoice['customer_name'], 0, 1,'C'); //end of line

//make dummy empty cell as a vertical spacer
$mpdf->Cell(189, 10, '', 0, 1); //end of line

//billing address
$mpdf->Cell(100, 5, 'Shippped To:', 0, 1); //end of line


//add dummt cell at beginnig of each line for indention
// $mpdf->Cell(10, 5, '', 0, 0);
// $mpdf->Cell(90, 5,$invoice['first_name'], 0, 1);

$mpdf->Cell(10, 5, '', 0, 0);
$mpdf->Cell(90, 5,$invoice['address'], 0, 1);

$mpdf->Cell(10, 5, '', 0, 0);
$mpdf->Cell(90, 5,$invoice['city'], 0, 1);

$mpdf->Cell(10, 5, '', 0, 0);
$mpdf->Cell(90, 5, $invoice['pincode'], 0, 1);

// $mpdf->Cell(10, 5, '', 0, 0);
// $mpdf->Cell(90, 5, $invoice['contact_no'], 0, 1);


//make dummy empty cell as a vertical spacer
$mpdf->Cell(189, 10, '', 0, 1); //end of line

//invoice content
$mpdf->SetFont('Arial', '', 12);

// $mpdf->Cell(99,5,'Product Name',1,0,);
// $mpdf->Cell(30,5,'Quantity',1,0,);
// $mpdf->Cell(30,5,'Price',1,0,);
// $mpdf->Cell(30,5,'Total Price',1,1,);



//numbers are right-aligned so we give 'R' after new line parameter.
// $mpdf->Cell(99,5,'AMD Ryzen 5 4500',1,0);
// $mpdf->Cell(30,5,'1',1,0,'C');
// $mpdf->Cell(30,5,'8290',1,0,'R');
// $mpdf->Cell(30,5,'8290',1,1,'R');


//summery
// $mpdf->Cell(99,5,'',0,0);
// $mpdf->Cell(30,5,'',0,0,'C');
// $mpdf->Cell(30,5,'Total',0,0,'R');
// $mpdf->Cell(30,5,'8290',1,0,'R');


$mpdf->Cell(180, 10, '', 0, 1);
$html = '<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="style.css" />
<div class="wishlist-table table-responsive">
<table>
<thead>
<tr>
<th class="product-thumbnail">Product Name</th>
<th class="product-name">Quantity</th>
<th class="product-price">Price</th>
<th class="product-price">Total Price</th>
</tr>
</thead>
<tbody>';
                                        
                                    if(isset($_SESSION['ADMIN_LOGIN'])){
                                        $res = mysqli_query($con,"select distinct(order_details.order_details_id),order_details.*,product.name,product.img from order_details,product,order_ where order_details.order_id='$order_id' and order_details.product_id=product.product_id"); 

                                    }else{
                                        $uid=$_SESSION['USER_ID']; 
                                        $res = mysqli_query($con,"select distinct(order_details.order_details_id),order_details.*,product.name,product.img from order_details,product,order_ where order_details.order_id='$order_id' and order_.customer_id='$uid' and order_details.product_id=product.product_id"); 
                                    }
                                    
                                    
                                    $total_price=0;
                                    if(mysqli_num_rows($res)==0){
                                        die();
                                    }    
                                    while ($row = mysqli_fetch_assoc($res)){ 
                                    $total_price=$total_price+($row['quantity']*$row['price']);
                                    if(mysqli_num_rows($res)==0){
                                        die();
                                    }


$html.='<tr>
<td class="product-name">'.$row['name'].'</td>
<td class="product-name">'.$row['quantity'].'</td>
<td class="product-name">'.$row['price'].'</td>
<td class="product-name">'.$row['quantity']*$row['price'].'</td>
</tr>';
}

$html.='<tr>
<td colspan="2"></td>
<td class="product-name">Total</td>
<td class="product-name">'.$total_price.'</td>
</tr>';
$html.='</tbody>
</table>
</div>';

$mpdf->WriteHTML($html);
$file=time().'.pdf';
$mpdf->Output($file,'D');
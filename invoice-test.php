<?php

use Mpdf\Mpdf;

    include('vendor/autoload.php');
    $mpdf=new Mpdf();

    $mpdf->AddPage();

    $mpdf->SetFont('Arial',16);

    $mpdf->Cell(180,10,'INVOICE',1,1,'C');

    $mpdf->Cell(150,10,'Date:',0,1,'L');
    $mpdf->Cell(150,10,'Order ID:',0,1,'L');
    $mpdf->Cell(150,10,'Customer ID:',0,1,'L');



    $mpdf->Output();


?>


$html='<link rel="stylesheet" href="css/bootstrap.min.css" />
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
<tbody>
<tr>
<td class="product-name">AMD Ryzen 5 4500</td>
<td class="product-name">1</td>
<td class="product-name">₹8290</td>
<td class="product-name">₹8290</td>
</tr>
<tr>
<td class="product-name">Ant Esports GM610 RGB Gaming Mouse</td>
<td class="product-name">1</td>
<td class="product-name">₹1290</td>
<td class="product-name">₹1290</td>
</tr>
<tr>
<td colspan="2"></td>
<td class="product-name">Total Price</td>
<td class="product-name">₹9580</td>
</tr>
</tbody>
</table>
</div>';
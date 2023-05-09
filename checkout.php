<?php
require('top.php');
$cart_total_tax = 0;
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
    <?php
}

$cart_total = 0;



if (isset($_POST['submit'])) {
    $address = get_safe_value($con, $_POST['address']);
    $city = get_safe_value($con, $_POST['city']);
    $pincode = get_safe_value($con, $_POST['pincode']);
    $number = get_safe_value($con, $_POST['number']);
    $payment_type = get_safe_value($con, $_POST['payment_type']);
    $user_id = $_SESSION['USER_ID'];
    $user_name=$_SESSION['USER_NAME'];
    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];
        $cart_total = $cart_total + ($price * $qty);
        $cart_total_tax = $cart_total + ($cart_total * 0.18);
    }
    $total_price = $cart_total_tax;
    $payment_status = 'pending';
    if ($payment_type == 'COD') {
        $payment_status = 'Success';
    }
    $order_status = '1';
    $added_on = date('y-m-d');

    mysqli_query($con, "insert into `order_`(customer_id,customer_name,address,city,pincode,number,payment_type,total_price,payment_status,order_status,added_on) values('$user_id','$user_name','$address','$city','$pincode','$number','$payment_type','$total_price','$payment_status','$order_status','$added_on')");

   






    $order_id = mysqli_insert_id($con);
    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];
        mysqli_query($con, "insert into order_details(order_id,product_id,quantity,price) values('$order_id','$key','$qty','$price')");
    }

    unset($_SESSION['cart']);



    
    if ($payment_type == 'PayU') {

        $MERCHANT_KEY = "gtKFFx";
        $SALT = "eCwWELxi";
        $hash_string = '';
        //$PAYU_BASE_URL = "https://secure.payu.in";
        $PAYU_BASE_URL = "https://test.payu.in";
        $action = '';
        $posted = array();
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $posted[$key] = $value;
            }
        }

        $userArr=mysqli_fetch_assoc(mysqli_query($con,"select * from customer where customer_id='$user_id'"));


        $formError = 0;
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $posted['txnid'] = $txnid;
        $posted['amount'] = $total_price;
        $posted['firstname'] =$userArr['first_name'];
        $posted['email'] = $userArr['email'];
        $posted['phone'] = $userArr['contact_no'];
        $posted['productinfo'] = "productinfo";
        $posted['key'] = $MERCHANT_KEY;
        $posted['SALT'] = $SALT;
        $hash='';
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||SALT";
        if (empty($posted['hash']) && sizeof($posted) > 0) {
            if (
                empty($posted['key'])
                || empty($posted['txnid'])
                || empty($posted['amount'])
                || empty($posted['firstname'])
                || empty($posted['email'])
                || empty($posted['phone'])
                || empty($posted['productinfo'])

            ) {
                $formError = 1;
            } else {
                $hashVarsSeq = explode('|', $hashSequence);
                foreach ($hashVarsSeq as $hash_var) {
                    $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                    $hash_string .= '|';
                }
                $hash_string .= $SALT;
                $hash = strtolower(hash('sha512', $hash_string));
                $action = $PAYU_BASE_URL . '/_payment';
            }
        } elseif (!empty($posted['hash'])) {
            $hash = $posted['hash'];
            $action = $PAYU_BASE_URL . '/_payment';
        }


        $formHtml = '<form method="post" name="payuForm" id="payuForm" action="' . $action . '"><input type="hidden" name="key" value="' . $MERCHANT_KEY . '" /><input type="hidden" name="hash" value="' . $hash . '"/><input type="hidden" name="txnid" value="' . $posted['txnid'] . '" /><input name="amount" type="hidden" value="' . $posted['amount'] . '" /><input type="hidden" name="firstname" id="firstname" value="' . $posted['firstname'] . '" /><input type="hidden" name="email" id="email" value="' . $posted['email'] . '" /><input type="hidden" name="phone" value="' . $posted['phone'] . '" /><textarea name="productinfo" style="display:none;">' . $posted['productinfo'] . '</textarea><input type="hidden" name="surl" value="http://localhost/Phoenix/payment_complete.php" /><input type="hidden" name="furl" value="http://localhost/payment_fail.php"/><input type="submit" style="display:none;"/></form>';
        echo $formHtml;
        echo '<script>document.getElementById("payuForm").submit();</script>';
    } else {
    ?>
        <script>
            alert("Your order has been placed successfully");
            window.location.href = 'order.php';
        </script>
<?php
    }
}

?>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: #f7f7f7 no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">
                            <?php
                            $accordion_class = 'accordion__title';
                            if (!isset($_SESSION['USER_LOGIN'])) {
                                $accordion_class = 'accordion__hide';
                            ?>
                                <div class="accordion__title">
                                    Checkout Method
                                </div>

                                <div class="accordion__body">
                                    <div class="accordion__body__form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form id="login-form" action="user_login.php" method="post">
                                                        <h5 class="checkout-method__title">Login</h5>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="email" name="login_email" id="login_email" placeholder="Enter Your Email*" style="width:100%" required>
                                                        </div>
                                                        <span class="field_error" id="login_email_error"></span>

                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" name="login_password" id="login_password" class="password" placeholder="Enter Your Password*" style="width:100%" required>
                                                        </div>
                                                        <span class="field_error" id="login_password_error"></span>
                                                        <!-- <p class="require">* Required fields</p> -->
                                                        <div class="dark-btn">
                                                            <button type="submit" class="fv-btn" onclick="user_login()">Login</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form action="#">
                                                        <h5 class="checkout-method__title">Register</h5>
                                                        <div class="single-input">
                                                            <label for="user-email">Name</label>
                                                            <input type="text" id="name" placeholder="Enter Your Name*" name="name" style="width:100%" required>
                                                        </div>
                                                        <span class="field_error" id="name_error"></span>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="email" id="email" placeholder="Enter Your Email*" name="email" style="width:100%" required>
                                                        </div>
                                                        <span class="field_error" id="email_error"></span>
                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" id="password" name="password" placeholder="Enter Your Password*" name="password" style="width:100%" required>
                                                        </div>
                                                        <span class="field_error" id="password_error"></span>
                                                        <div class="single-input">
                                                            <label for="user-pass">Confirm Password</label>
                                                            <input type="password" id="confirm_password" name="confirmpassword" placeholder="Confirm Password*" style="width:100%" required>
                                                        </div>
                                                        <span class="field_error" id="confirmpassword_error"></span>
                                                        <div class="dark-btn">
                                                            <button type="submit" class="fv-btn" onclick="user_register()">Register</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="<?php echo $accordion_class ?>">
                                Address Information
                            </div>
                            <form method="post">
                                <div class="accordion__body">
                                    <div class="bilinfo">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" name="address" placeholder="Address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="city" placeholder="City/State" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="number" placeholder="Phone number" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="<?php echo $accordion_class ?>">
                                    Payment information
                                </div>
                                <div class="accordion__body">
                                    <div class="paymentinfo">
                                        <div class="single-method">
                                            COD <input type="radio" name="payment_type" value="COD" required>
                                            &nbsp;&nbsp;PayU <input type="radio" name="payment_type" value="PayU" required>
                                        </div>
                                        <div class="single-method">
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">
                        <?php
                        $cart_total = 0;
                        foreach ($_SESSION['cart'] as $key => $val) {
                            $productArr = get_product($con, '', '', $key);
                            $pname = $productArr[0]['name'];
                            $mrp = $productArr[0]['mrp'];
                            $price = $productArr[0]['price'];
                            $image = $productArr[0]['img'];
                            $qty = $val['qty'];
                            $cart_total = $cart_total + ($price * $qty);
                            $cart_total_tax = $cart_total + ($cart_total * 0.18);
                        ?>
                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="<?php echo 'media/product/' . $image ?>">
                                </div>
                                <div class="single-item__content">
                                    <a href="#"><?php echo $pname ?></a>
                                    <span class="price"><?php echo '₹' . $price * $qty ?></span>
                                    <span class="price"><?php echo 'Qty: ' . $qty ?></span>
                                    <td class="product-quantity"><input type="number" min="1" max="10" id="<?php echo $key ?>qty" value="<?php echo $qty ?>" />
                                        <br /><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')">Update</a>
                                </div>
                                <div class="single-item__remove">
                                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="icon-trash icons"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="order-details__count">
                        <div class="order-details__count__single">
                            <h5>sub total</h5>
                            <span class="price"><?php echo $cart_total ?></span>
                        </div>
                        <div class="order-details__count__single">
                            <h5>Tax</h5>
                            <span class="price">18%</span>
                        </div>
                    </div>
                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price"><?php echo '₹' . $cart_total_tax ?></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->

<?php
require('footer.php');
?>
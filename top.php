<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');
$cat_res = mysqli_query($con, "select * from category where status=1 order by category_id asc");
$cat_arr = array();
while ($row = mysqli_fetch_assoc($cat_res)) {
  $cat_arr[] = $row;
}
$obj = new add_to_cart();
$totalProduct = $obj->totalProduct();

?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Phoenix Computers</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Place favicon.ico in the root directory -->
  <!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png"> -->

  <!-- All css files are included here. -->
  <!-- Bootstrap fremwork main css -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <!-- Owl Carousel min css -->
  <link rel="stylesheet" href="css/owl.carousel.min.css" />
  <link rel="stylesheet" href="css/owl.theme.default.min.css" />
  <!-- This core.css file contents all plugings css file. -->
  <link rel="stylesheet" href="css/core.css" />
  <!-- Theme shortcodes/elements style -->
  <link rel="stylesheet" href="css/shortcode/shortcodes.css" />
  <!-- Theme main style -->
  <link rel="stylesheet" href="style.css" />
  <!-- Responsive css -->
  <link rel="stylesheet" href="css/responsive.css" />
  <!-- User style -->
  <link rel="stylesheet" href="css/custom.css" />
  <!-- Custom Style Sheet Css -->
  <link rel="stylesheet" href="cus_style.css" />

  <!-- Modernizr JS -->
  <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
  <!--[if lt IE 8]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="http://browsehappy.com/">upgrade your browser</a> to improve
        your experience.
      </p>
    <![endif]-->

  <!-- Body main wrapper start -->
  <class="wrapper">
    <!-- Start Header Style -->
    <header id="htc__header" class="htc__header__area header--one">
      <!-- Start Mainmenu Area -->
      <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
        <div class="container">
          <div class="row">
            <div class="menumenu__container clearfix">
              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                <div class="logo">
                  <a href="index.php"><img src="images/logo/logo.svg" alt="logo images" class="logo" /></a>
                </div>
              </div>
              <div class="col-md-7 col-lg-7 col-sm-5 col-xs-3">
                <nav class="main__menu__nav hidden-xs hidden-sm">
                  <ul class="main__menu">
                    <li><a href="index.php">Home</a></li>
                    <?php
                    foreach ($cat_arr as $list) {
                    ?>
                      <li class="drop"><a href="categories.php?id=<?php echo $list['category_id'] ?>"><?php echo $list['category_name'] ?></a>
                      <?php
                      $cat_id=$list['category_id'];
                          $sub_cat_res=mysqli_query($con,"select * from sub_category where status='1' and category_id='$cat_id'");
                          if(mysqli_num_rows($sub_cat_res)>0){
                      ?>
                          <ul class="dropdown">                            
                            <?php
                                while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
                                  echo '<li><a href="categories.php?id='.$list['category_id'].'&sub_category='.$sub_cat_rows['sub_category_id'].'">'.$sub_cat_rows['sub_category'].'</a></li>';

                                }
                            ?>
                          </ul>
                          <?php }
                          ?>
                      </li>
                    <?php
                    }
                    ?>
                    <li><a href="contact.php">Contact</a></li>
                  </ul>
                </nav>

                <div class="mobile-menu clearfix visible-xs visible-sm">
                  <nav id="mobile_dropdown">
                    <ul>
                      <li><a href="index.php">Home</a></li>
                      <?php
                      foreach ($cat_arr as $list) {
                      ?>
                        <li class="drop"><a href="categories.php?id=<?php echo $list['category_id'] ?>"><?php echo $list['category_name'] ?></a>
                        <ul class="dropdown">
                            <li><a>Processor</a></li>
                          </ul>
                      </li>
                      <?php
                      }
                      ?>
                      <li><a href="contact.php">contact</a></li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div class="col-md-3 col-lg-3 col-sm-4 col-xs-4">
                <div class="header__right">
                  <div class="header__search search search__open">
                    <!-- <a href="#"><i class="icon-magnifier icons"></i></a> -->
                  </div>
                  <div class="header__account">
                    <?php if (isset($_SESSION['USER_LOGIN'])) {
                      echo '<a href="logout.php">Logout</a>';
                      // echo $_SESSION['USER_NAME'];
                      echo '<a href="order.php">Order</a>';
                      echo '<a href="profile.php" <i class="icon-user icons"></i></a>';
                    } else {
                      echo '<a href="login.php"><i class="icon-user icons">Login</i></a>';
                    }
                    ?>
                  </div>
                  <div class="htc__shopping__cart">
                    <a class="cart_menu" href="cart.php"><i class="icon-handbag icons"></i></a> <!--class="cart__menu(for popup)" -->
                    <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct ?></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mobile-menu-area"></div>
        </div>
      </div>
      <!-- End Mainmenu Area -->
    </header>
    <!-- End Header Area -->
<?php
require('top.php');
?>
<!-- Home Section -->


<div class="main-home">
  <img src="images/custom-pc-2.webp">
  <h1>WHY US?</h1>
  <p>We have Great amount of experience in Building Gaming PC, Editing PC & Workstation PC for our clients. We build with love and we know what your PC means to you 🖤</p>
  <p>Just give us a chance to serve you and get your Dream Gaming PC Build or Editing PC Build from us. So if you’re looking to buy PC online then you’re at the right place. </p>
  <p>For best Online PC Build services and prices shop Phoenix Computers!</p>
  <a href="categories.php?id=28" class="main-btn">Shop Now<i class='bx bx-right-arrow-alt'></i></a>
</div>


<div>
  <div class="body__overlay"></div>
  <!-- Start Offset Wrapper -->
  <!-- <div class="offset__wrapper"> -->
  <!-- Start Search Popap -->
  <!-- <div class="search__area">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="search__inner">
                  <form action="#" method="get">
                    <input placeholder="Search here... " type="text" />
                    <button type="submit"></button>
                  </form>
                  <div class="search__close__btn">
                    <span class="search__close__btn_icon"
                      ><i class="zmdi zmdi-close"></i
                    ></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
  <!-- End Search Popap -->
  <!-- Start Cart Panel -->
  <!-- <div class="shopping__cart">
          <div class="shopping__cart__inner">
            <div class="offsetmenu__close__btn">
              <a href="#"><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="shp__cart__wrap">
              <div class="shp__single__product">
                <div class="shp__pro__thumb">
                  <a href="#">
                    <img
                      src="images/product-2/sm-smg/1.jpg"
                      alt="product images"
                    />
                  </a>
                </div>
                <div class="shp__pro__details">
                  <h2>
                    <a href="product-details.html">BO&Play Wireless Speaker</a>
                  </h2>
                  <span class="quantity">QTY: 1</span>
                  <span class="shp__price">$105.00</span>
                </div>
                <div class="remove__btn">
                  <a href="#" title="Remove this item"
                    ><i class="zmdi zmdi-close"></i
                  ></a>
                </div>
              </div>
              <div class="shp__single__product">
                <div class="shp__pro__thumb">
                  <a href="#">
                    <img
                      src="images/product-2/sm-smg/2.jpg"
                      alt="product images"
                    />
                  </a>
                </div>
                <div class="shp__pro__details">
                  <h2><a href="product-details.html">Brone Candle</a></h2>
                  <span class="quantity">QTY: 1</span>
                  <span class="shp__price">$25.00</span>
                </div>
                <div class="remove__btn">
                  <a href="#" title="Remove this item"
                    ><i class="zmdi zmdi-close"></i
                  ></a>
                </div>
              </div>
            </div>
            <ul class="shoping__total">
              <li class="subtotal">Subtotal:</li>
              <li class="total__price">$130.00</li>
            </ul>
            <ul class="shopping__btn">
              <li><a href="cart.html">View Cart</a></li>
              <li class="shp__checkout">
                <a href="checkout.html">Checkout</a>
              </li>
            </ul>
          </div>
        </div> -->
  <!-- End Cart Panel -->
  <!-- </div> -->
  <!-- End Offset Wrapper -->


  <!-- Feature Section -->
  <div class="features">
    <div class="feature">
      <img src="images/feature-1.webp" alt="" class="featureImg">
      <span class="featureTitle">SAFE DELIVERY</span>
      <span class="featureDesc">All packages are safely packed & shipped.</span>
    </div>

    <div class="feature">
      <img src="images/feature-2.webp" alt="" class="featureImg">
      <span class="featureTitle">BEST PRICES</span>
      <span class="featureDesc">We offer the best prices! Just shop from the wide variety available!</span>
    </div>

    <div class="feature">
      <img src="images/feature-3.webp" alt="" class="featureImg">
      <span class="featureTitle">GENUINE PRODUCTS</span>
      <span class="featureDesc">All our products are 100% Genuine.Guranteed.</span>
    </div>

    <div class="feature">
      <img src="images/feature-4.webp" alt="" class="featureImg">
      <span class="featureTitle">TECH SUPPORT</span>
      <span class="featureDesc">Stuck anywhere? Don't worry we're here to help you.</span>
    </div>
  </div>
  <!-- Feature Section Ends -->

















  <!-- Start Category Area -->
  <section class="htc__category__area ptb--100">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="section__title--2 text-center">
            <h2 class="title__line">Latest Products</h2>
            <p>Checkout our recent products</p>
          </div>
        </div>
      </div>
      <div class="htc__product__container">
        <div class="row">
          <div class="product__list clearfix mt--30">
            <?php
            $get_product = get_product($con, 8);

            foreach ($get_product as $list) {
            ?>
              <!-- Start Single Category -->
              <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                <div class="category">
                  <div class="ht__cat__thumb">
                    <a href="product.php?id=<?php echo $list['product_id'] ?>">
                      <img src="<?php echo 'media/product/' . $list['img'] ?>" alt="product images" />
                    </a>
                  </div>
                  <div class="fr__product__inner">
                    <h4>
                      <a href="product-details.html"><?php echo $list['name'] ?></a>
                    </h4>
                    <ul class="fr__pro__prize">
                      <li class="old__prize"><?php echo '₹' . $list['mrp'] ?></li>
                      <li><?php echo '₹' . $list['price'] ?></li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- End Single Category -->
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Category Area -->
  <!-- Start Product Area -->
  <section class="ftr__product__area ptb--100">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="section__title--2 text-center">
            <h2 class="title__line">Best Seller</h2>
            <p>Have a Look on our BEST SELLER</p>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="product__list clearfix mt--30">
            <?php
            $get_product = get_product($con, 4,'','','','$is_best_seller');

            foreach ($get_product as $list) {
            ?>
              <!-- Start Single Category -->
              <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                <div class="category">
                  <div class="ht__cat__thumb">
                    <a href="product.php?id=<?php echo $list['product_id'] ?>">
                      <img src="<?php echo 'media/product/' . $list['img'] ?>" alt="product images" />
                    </a>
                  </div>
                  <div class="fr__product__inner">
                    <h4>
                      <a href="product-details.html"><?php echo $list['name'] ?></a>
                    </h4>
                    <ul class="fr__pro__prize">
                      <li class="old__prize"><?php echo '₹' . $list['mrp'] ?></li>
                      <li><?php echo '₹' . $list['price'] ?></li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- End Single Category -->
            <?php } ?>
          </div>
      </div>
    </div>
  </section>
  <!-- End Product Area -->

  <?php
  require('footer.php');
  ?>
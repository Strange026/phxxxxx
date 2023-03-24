<?php
    require('top.php');
	if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
		?>
		<script>
			window.location.href='order.php';
		</script>
		<?php
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
                                  <span class="breadcrumb-item active">Forget Password</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- End Bradcaump area -->

        <!-- Start Contact Area -->
		<section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Forget Password</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="login-form" action="user_login.php" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="email" name="email" id="email" placeholder="Enter Your Email*" style="width:100%" required>
										</div>
										<span class="field_error" id="login_email_error"></span>
									</div>
									
									<div class="contact-btn">
										<button type="submit" class="fv-btn" onclick="forget_password()">Submit</button>
									</div>
                                
								</form>
								<div class="form-output login_msg">
									<p class="form-messege field_error"></p>
								</div>
							</div>
						</div> 
				</div>					
            </div>
        </section>
        <!-- End Contact Area -->
<?php
    require('footer.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Toko Daging Saldas Jakarta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/animate.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/magnific-popup.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/aos.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/ionicons.min.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/jquery.timepicker.css">


  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/flaticon.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/icomoon.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/frontend/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body class="goto-here">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-end">
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">

                </div>
                
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <form action="<?php echo base_url('Login/do_reset'); ?>" method="post" class="info">
                    <div class="cart-total mb-3">
                        <h3>Reset Password</h3>
                        <?php echo $this->session->flashdata('message');?>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" required class="form-control text-left px-3" name="resetpass" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">Konfirmasi Password</label>
                                <input type="password" required class="form-control text-left px-3" name="resetpass2" placeholder="">
                            </div>
                        
                    <p><button type="submit" class="btn btn-primary py-3 px-4">Reset Password</button></p>
                    </div>
                </form>
                </div>
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                </div>
            </div>
        </div>
    </section>
</body>
<?php
if(!isset($_SESSION['logged_in']['username'])){                                
            // redirect('Login');
} else { ?>
	<script src="<?php echo base_url() ?>/assets/backend/js/general.js"></script>
	<script src="<?php echo base_url() ?>/assets/backend/js/product.js"></script>
	<script type="text/javascript">
		getUserLastOrder('CART.SUMMARY', <?php echo $_SESSION['logged_in']['id_user']; ?>);
		setInterval(interval, 3000);
		function interval() {
			getUserLastOrder('CART.SUMMARY', <?php echo $_SESSION['logged_in']['id_user']; ?>);
		}
		getDataUser(<?php echo $_SESSION['logged_in']['id_user']; ?>);
	</script>
	<?php } ?>


  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="<?php echo base_url() ?>assets/frontend/js/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/popper.min.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/jquery.easing.1.3.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/jquery.stellar.min.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/jquery.magnific-popup.min.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/aos.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/jquery.animateNumber.min.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/scrollax.min.js"></script>
  <script src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15861.759201862938!2d106.8299132398065!3d-6.337035211851748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69edcd85173fd1%3A0x97405f1872d88f91!2sLili%20Tailor!5e0!3m2!1sen!2sid!4v1617730556672!5m2!1sen!2sid"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/google-map.js"></script>
  <script src="<?php echo base_url() ?>assets/frontend/js/main.js"></script>
    
  </body>
</html>
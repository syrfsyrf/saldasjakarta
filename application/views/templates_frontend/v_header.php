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

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body class="goto-here">
  <div class="py-1 bg-primary">
   <div class="container">
    <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
     <div class="col-lg-12 d-block">
      <div class="row d-flex">
       <div class="col-md pr-4 d-flex topper align-items-center">
        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
        <span class="text text-lowercase">08121610680</span>
      </div>
      <div class="col-md pr-4 d-flex topper align-items-center">
        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
        <span class="text text-lowercase">tokodagingsaldas@gmail.com</span>
      </div>
      <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
        <span class="text text-lowercase">Produk Kami Berkualitas dan &amp; Halal</span>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
 <div class="container">
   <a class="navbar-brand" href="<?php echo base_url('Main'); ?>">Toko Daging Saldas Jakarta</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="oi oi-menu"></span> Menu
   </button>

   <div class="collapse navbar-collapse" id="ftco-nav">
     <ul class="navbar-nav ml-auto">
       <li class="nav-item active"><a href="<?php echo base_url('Main'); ?>" class="nav-link">Beranda</a></li>
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori Produk</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="<?php echo base_url('Main/kategori_produk'); ?>">All Category</a>
            <?php foreach($getKategori->result() as $row): ?>
              <a class="dropdown-item" href="<?php echo base_url('Main/kategori_produk/').$row->id; ?>"><?php echo $row->jenis;?></a>
            <?php endforeach; ?>
          </div>
        </li>
       <li class="nav-item"><a href="<?php echo base_url('Main/tentang_kami'); ?>" class="nav-link">Tentang Kami</a></li>
       <li class="nav-item"><a href="<?php echo base_url('Main/kontak_kami'); ?>" class="nav-link">Kontak Kami</a></li>
       <li class="nav-item dropdown cta cta-colored">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-shopping_cart" id="total_cart"></span></a>
        <div class="dropdown-menu" aria-labelledby="dropdown04">
          <a class="dropdown-item" href="<?php echo base_url('Main/keranjang'); ?>">Cart</a>
          <a class="dropdown-item" href="<?php echo base_url('Main/myOrder'); ?>">My Order</a>
        </div>
     </li>
     <?php if(!isset($_SESSION['logged_in']['username'])){ ?>
      <li class="nav-item"><a href="<?php echo base_url('Login'); ?>" class="nav-link">Login</a></li>
      <?php } else { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['logged_in']['username']; ?></a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="<?php echo base_url('Main/profile/').$_SESSION['logged_in']['username']; ?>">Profile</a>
            <a class="dropdown-item" href="<?php echo base_url('Login/logout'); ?>">Logout</a>
          </div>
        </li>
      <?php } ?>
  </ul>
</div>
</div>

</nav>
<!-- END nav -->
<?php
if(!isset($_SESSION['logged_in']['username'])){                                
            // redirect('Login');
} else { ?>
 <script src="<?php echo base_url() ?>/assets/backend/js/general.js"></script>
 <script src="<?php echo base_url() ?>/assets/backend/js/product.js"></script>
 <script type="text/javascript">
            /*getUserLastOrder('SUM', <?php echo $_SESSION['logged_in']['id_user']; ?>);
            getUserAvailablity(<?php echo $_SESSION['logged_in']['id_user']; ?>);
            setInterval(interval, 3000);
            function interval() {
              getUserAvailablity(<?php echo $_SESSION['logged_in']['id_user']; ?>);
            }*/
          </script>
          <?php } ?>
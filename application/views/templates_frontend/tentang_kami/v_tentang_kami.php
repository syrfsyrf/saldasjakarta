
    <section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
			<div class="container">
				<div class="row">
					<div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url('<?php echo base_url(); ?>assets/frontend/images/logo2.jpg');">
          <!--  <a href="https://vimeo.com/45830194" class="icon popup-vimeo d-flex justify-content-center align-items-center"> */
							<span class="icon-play"></span> -->
						</a>
					</div>
					<div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
	          <div class="heading-section-bold mb-4 mt-md-5">
	          	<div class="ml-md-0">
		            <h2 class="mb-4">Selamat Datang</h2>
                <h3 class="mb-4">Website Resmi Toko Daging Saldas Jakarta</h3>
	            </div>
	          </div>
	          <div class="pb-md-5">
	          	<p>Toko Daging Saldas Jakarta bergerak di bidang penjualan daging beku dan olahan frozen food berkualitas di Indonesia. Produk daging beku di Toko Daging Saldas Jakarta diantaranya adalah daging sapi, daging kambing, daging ayam, ikan, frozen food dan produk home made.</p>
							<p>Didirikan oleh Rizki Irwandi pada tahun 2019, Toko Daging Saldas Jakarta telah berkembang dan berekspansi dalam distribusi produk daging beku dan olahan frozen food kepada para wholesaler, perusahaan olahan daging, pasar tradisional, catering, dan restoran.</p>
              <?php if(!isset($_SESSION['logged_in']['username'])){ ?>
                <p><a href="<?php echo base_url('Login'); ?>" class="btn btn-primary">Belanja Sekarang!</a></p>
              <?php } else { ?>
                <p><a href="<?php echo base_url('Main/kategori_produk'); ?>" class="btn btn-primary">Belanja Sekarang!</a></p>
              <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-1">
          <div class="col-sm-12 heading-section text-center">
            <h2 class="mb-4">Pelanggan Kami</h2>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/90burnlogo.jpg"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/asfoodslogo.jpg"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/beefboxlogo.jpg"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/bestmeatlogo.jpg"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/caddielogo.jpg"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/furesushilogo.jpg"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/hanslogo.jpg"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/mercurehotellogo.png"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/ryoubeeflogo.png"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/santongkuotiehlogo.jpg"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/tokodagingkitalogo.jpg"></img>
                    <img src="<?php echo base_url() ?>/assets/frontend/images/satetaichanlogo.jpg"></img>
            </div>
          </div>
        </div>
                  
    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-sm-12 heading-section text-center">
            <h2 class="mb-4">Rekanan Kami</h2>
                     <img src="<?php echo base_url() ?>/assets/frontend/images/bulog.jpeg"></img>
                     <img src="<?php echo base_url() ?>/assets/frontend/images/indoguna.png"></img>
                     <img src="<?php echo base_url() ?>/assets/frontend/images/ppi.jpeg"></img>
                     <img src="<?php echo base_url() ?>/assets/frontend/images/siap.jpeg"></img>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
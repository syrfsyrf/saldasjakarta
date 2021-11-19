<form method="post" action="javascript:checkOut();">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-7 ftco-animate">
					<form action="#" class="billing-form">
						<h3 class="mb-4 billing-heading">Detail Penagihan</h3>
						<div class="row align-items-end">
							<div class="col-md-12">
								<div class="form-group">
									<label for="firstname">Nama</label>
									<input type="hidden" class="form-control" placeholder="" id="id_pesanan" name="id_pesanan" required>
									<input type="text" class="form-control" placeholder="" id="nama" name="nama" required>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname">Email</label>
									<input type="text" class="form-control" placeholder="" id="email" name="email" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lastname">No Telp</label>
									<input type="text" class="form-control" placeholder="" id="telp" name="telp" required>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="streetaddress">Jalan</label>
									<textarea class="form-control" rows="3"  placeholder="Jalan.." id="jalan" required name="jalan"></textarea>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="towncity">RT</label>
									<input type="text" class="form-control" placeholder="" id="rt" name="rt" value="-">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="postcodezip">RW</label>
									<input type="text" class="form-control" placeholder="" id="rw" name="rw" value="-">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="towncity">Kelurahan</label>
									<input type="text" class="form-control" placeholder="" id="kelurahan" name="kelurahan" value="-">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="postcodezip">Kecamatan</label>
									<input type="text" class="form-control" placeholder="" id="kecamatan" name="kecamatan" value="-">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="towncity">Kota</label>
									<input type="text" class="form-control" placeholder="" id="kota" name="kota" value="-">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="postcodezip">Provinsi</label>
									<input type="text" class="form-control" placeholder="" id="provinsi" name="provinsi" value="-">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="towncity">Kode Pos</label>
									<input type="text" class="form-control" placeholder="" id="kd_pos" name="kd_pos" value="-">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="postcodezip">Desa</label>
									<input type="text" class="form-control" placeholder="" id="desa" name="desa" value="-">
								</div>
							</div>
						</div>
					</form><!-- END -->
				</div>
				<div class="col-xl-5">
					<div class="row mt-5 pt-3">
						<div class="col-md-12 d-flex mb-5">
							<div class="cart-detail cart-total p-3 p-md-4">
								<h3 class="billing-heading mb-4">Ringkasan Keranjang</h3>
								<div id="cart_summary">
									
								</div>
								
								<p class="d-flex total-price">
									<span>Total</span>
									<span id="total_summary"></span>
								</p>
							</div>
						</div>
						<div class="col-md-12">
							<div class="cart-detail p-3 p-md-4">
								<h3 class="billing-heading mb-4">Metode Pembayaran</h3>
								<?php foreach($paymentMethod->result() as $row): ?>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
												<label><input type="radio" id="paymentMethod" name="paymentMethod" required value="<?php echo $row->id; ?>" class="mr-2"> <?php echo $row->jenis;?></label>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
								<p><button type="submit" class="btn btn-primary py-3 px-4">Buat Order</button></p>
							</div>
						</div>
					</div>
				</div> <!-- .col-md-8 -->
			</div>
		</div>
	</section>
</form>

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
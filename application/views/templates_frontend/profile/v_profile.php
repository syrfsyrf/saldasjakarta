<form method="post" action="javascript:checkOut();">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-12 ftco-animate">
					<form action="#" class="billing-form">
						<h3 class="mb-4 billing-heading">Profile Details</h3>
						<div class="row align-items-end">
							<?php foreach($getUserProfile->result() as $row): ?>
								<div class="col-md-6">
									<div class="form-group">
										<label for="firstname">Nama</label>
										<input type="text" class="form-control" placeholder="" id="email" name="email" required value="<?php echo $row->nama; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="lastname">Username</label>
										<input type="text" readonly class="form-control" placeholder="" id="telp" name="telp" required value="<?php echo $row->username; ?>">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="firstname">Email</label>
										<input type="text" class="form-control" placeholder="" id="email" name="email" required value="<?php echo $row->email; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="lastname">No Telp</label>
										<input type="text" class="form-control" placeholder="" id="telp" name="telp" required value="<?php echo $row->telp; ?>">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="streetaddress">Jalan</label>
										<textarea class="form-control" rows="3"  placeholder="Jalan.." id="jalan" required name="jalan"><?php echo $row->jalan; ?></textarea>
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="towncity">RT</label>
										<input type="text" class="form-control" placeholder="" id="rt" name="rt" value="<?php echo $row->rt; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="postcodezip">RW</label>
										<input type="text" class="form-control" placeholder="" id="rw" name="rw" value="<?php echo $row->rw; ?>">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="towncity">Kelurahan</label>
										<input type="text" class="form-control" placeholder="" id="kelurahan" name="kelurahan" value="<?php echo $row->kelurahan; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="postcodezip">Kecamatan</label>
										<input type="text" class="form-control" placeholder="" id="kecamatan" name="kecamatan" value="<?php echo $row->kecamatan; ?>">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="towncity">Kota</label>
										<input type="text" class="form-control" placeholder="" id="kota" name="kota" value="<?php echo $row->kota; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="postcodezip">Provinsi</label>
										<input type="text" class="form-control" placeholder="" id="provinsi" name="provinsi" value="<?php echo $row->provinsi; ?>">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="towncity">Kode Pos</label>
										<input type="text" class="form-control" placeholder="" id="kd_pos" name="kd_pos" value="<?php echo $row->kd_pos; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="postcodezip">Desa</label>
										<input type="text" class="form-control" placeholder="" id="desa" name="desa" value="<?php echo $row->desa; ?>">
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</form><!-- END -->
				</div>
			</div>
		</div>
	</section>
</form>

<?php
if(!isset($_SESSION['logged_in']['username'])){                                
	redirect('Login');
} else { ?>
	<script src="<?php echo base_url() ?>/assets/backend/js/general.js"></script>
	<script src="<?php echo base_url() ?>/assets/backend/js/product.js"></script>
	<script type="text/javascript">
		getUserLastOrder('CART.SUMMARY', <?php echo $_SESSION['logged_in']['id_user']; ?>);
		setInterval(interval, 3000);
		function interval() {
			getUserLastOrder('CART.SUMMARY', <?php echo $_SESSION['logged_in']['id_user']; ?>);
		}
	</script>
	<?php } ?>
<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody id="targetOrder">
						</tbody>
						<tfoot class="tfoot-primary">
							<tr class="text-center">
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Sub Total</th>
								<th id="sum_total"></th>
							</tr>
							<tr class="text-center">
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th><a href="<?php echo base_url('/main/bayar'); ?>" class="btn btn-primary py-3 px-4" id="checkbtn">Check Out</a></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>
</section>

<?php
if(!isset($_SESSION['logged_in']['username'])){                                
            // redirect('Login');
} else { ?>
	<script src="<?php echo base_url() ?>/assets/backend/js/general.js"></script>
	<script src="<?php echo base_url() ?>/assets/backend/js/product.js"></script>
	<script type="text/javascript">
		document.getElementById('checkbtn').style.display = 'none';
		getUserLastOrder('DETAIL', <?php echo $_SESSION['logged_in']['id_user']; ?>);
	</script>
	<?php } ?>
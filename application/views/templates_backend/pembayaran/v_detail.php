<?php foreach($getPesanan->result() as $row): ?>
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Detail Transaksi</h1>
		</div>
		<div>
	        <?php echo $this->session->flashdata('message');?>
	    </div>

		<!-- Content Row -->
		<form action="<?php echo base_url('data/Data_transaksi/approvePembayaran'); ?>" method="post">
			<div class="row">
				<!-- Content Column -->
				<div class="col-md-7">

					<div class="card shadow mb-4">

						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">Produk</h6>
						</div>

						<div class="card-body">
							<div class="form-group row">
								<label for="password" class="col-sm-12 col-form-label">ID Transaksi</label>
								<div class="col-sm-12">
									<input type="hidden" required class="form-control" id="id_pesanan" name="id_pesanan" placeholder="..." value="<?php echo $row->id_pesanan;?>">
									<input type="text" readonly class="form-control" name="transaction_id" id="transaction_id" placeholder="..." value="<?php echo $row->transaction_id;?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="password" class="col-sm-12 col-form-label">Metode Pembayaran</label>
								<div class="col-sm-12">
									<input type="text" readonly class="form-control" placeholder="..." value="<?php echo $row->metode_pembayaran;?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="user" class="col-sm-2 col-form-label">Status</label>
								<div class="col-sm-4">
									<input type="text" readonly class="form-control" placeholder="..." value="<?php echo $row->status;?>">
								</div>
								<label class="col-sm-2 col-form-label">Bukti Pembayaran</label>
								<div class="col-sm-4">
									<?php if ($row->file == NULL) { ?>
										<input type="text" readonly class="form-control" placeholder="..." value="Receipt Not Available">
									<?php } else { ?>
										<a href="<?php echo base_url('data/Data_order/download/'.$row->id_pesanan); ?>" class="btn btn-primary btn-icon-split form-control" type="Submit"><span class="text">Download Receipt</span></a>
									<?php } ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="password" class="col-sm-12 col-form-label">Tanggal Pembayaran</label>
								<div class="col-sm-12">
									<input type="date" class="form-control" placeholder="..." required id="tgl_pembayaran" name="tgl_pembayaran" value="<?php echo $row->dtgl_pembayaran; ?>">
								</div>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
				<div class="col-md-5">
					<div class="row">
						<div class="col-md-12">
							<div id="cart_items">

							</div>

							<div class="p-3 bg-warning text-white">
								<div class="row">
									<div class="col-md-6">
										Sub Total
									</div>
									<div class="col-md-2"></div>
									<div class="col-md-4"><div id="totalOrder">0</div></div>
								</div>
							</div>
						</div>
					</div>
					<br>
					<?php if ($row->dstatus == '3' && $row->file != NULL) { ?>
						<div class="row">
							<div class="col-md-12">
								<!-- <button class="btn btn-primary btn-block"><span class="text">Approve</span></button>   -->
								<input id="submit-approve" type="submit" class="btn btn-primary btn-block" name="submit" value="Approve">
							</div>
						</div>
					<?php } else { ?>

					<?php } ?>
				</div>
			</div>
		</form>
	</div>
<?php endforeach;?>

<script src="<?php echo base_url() ?>/assets/backend/js/cashier.js"></script>
<!-- /.container-fluid -->
<script type="text/javascript">
	getDetailOrder('<?php echo $this->uri->segment('3'); ?>', 'DETAIL');
</script>
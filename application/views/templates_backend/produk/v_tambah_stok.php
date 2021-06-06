<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Tambah Stok</h1>
	</div>

	<!-- Content Row -->
	<form action="<?php echo base_url('data/Data_produk/insertStock'); ?>" method="post">
		<div class="row">
			<!-- Content Column -->
			<div class="col-lg">
				<?php foreach($getproduk->result() as $row): ?>
					<div class="card shadow mb-4">

						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">Produk</h6>
						</div>

						<div class="card-body">
							<div class="form-group row">
								<label for="user" class="col-sm-2 col-form-label">Kategori</label>
								<div class="col-sm-4">
									<select class="form-control" name="param">
										<option value=""><?php echo $row->kategori;?></option>
									</select>
								</div>
								<label class="col-sm-2 col-form-label">Nama Produk</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" placeholder="..." value="<?php echo $row->nama_produk;?>">
									<input type="hidden" required class="form-control" id="id_produk" name="id_produk" placeholder="..." value="<?php echo $row->id_produk;?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="password" class="col-sm-2 col-form-label">Deskripsi</label>
								<div class="col-sm-12">
									<textarea class="form-control" rows="3"><?php echo $row->deskripsi;?></textarea>
								</div>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
				<?php endforeach;?>

				<div class="card shadow mb-4">

					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Stok dan Harga</h6>
					</div>

					<div class="card-body">
						<div class="form-group row">
							<label for="user" class="col-sm-2 col-form-label">Jumlah Stok</label>
							<div class="col-sm-4">
								<input type="number" class="form-control" id="jumlah_stock" name="jumlah_stock" placeholder="..." value="">
							</div>
							<label class="col-sm-2 col-form-label">Tanggal Expired</label>
							<div class="col-sm-4">
								<input type="date" class="form-control" id="tgl_expired" name="tgl_expired" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="user" class="col-sm-2 col-form-label">Harga</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="harga" name="harga" placeholder="..." value="">
							</div>
							<label class="col-sm-2 col-form-label">Jenis Harga</label>
							<div class="col-sm-4">
								<select class="form-control" id="jenis_harga" name="jenis_harga">
									<option value="0">Jenis Harga</option>
									<?php foreach($getJenisHarga->result() as $row): ?>
										<option value="<?php echo $row->id;?>"><?php echo $row->jenis_harga;?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
					<!-- /.card-body -->
				</div>

				<div class="card shadow mb-4">
					<button class="btn btn-primary btn-icon-split" type="Submit"><span class="text">Submit Stock</span></button>
				</div>
			</div>
		</div>
	</form>
</div>
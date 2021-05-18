<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Produk</h1>
    </div>
        
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg">
		<?php foreach($getproduk->result() as $row): ?>
                                        
				<div class="card shadow mb-4">

					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Produk</h6>
					</div>

					<div class="card-body">
						<div class="form-group row">
							<label for="user" class="col-sm-2 col-form-label">Nama Produk</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="user" name="user" placeholder="..." value="<?php echo $row->nama_produk;?>">
							</div>
							<label for="KodeDermaga" class="col-sm-2 col-form-label">Kategori</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="KodeDermaga" name="KodeDermaga" placeholder="..." value="<?php echo $row->jenis_kategori;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-sm-2 col-form-label">Created By</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="password" name="password" placeholder="..." value="<?php echo $row->created_by;?>">
							</div>
                            <label for="password" class="col-sm-2 col-form-label">Insert Date</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="password" name="password" placeholder="..." value="<?php echo $row->insert_date;?>">
							</div>
						</div>
					</div>
					<!-- /.card-body -->
				</div>
                <div class="card shadow mb-4">

					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Harga & Stok</h6>
					</div>

					<div class="card-body">
						<div class="form-group row">
							<label for="user" class="col-sm-2 col-form-label">Harga</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="user" name="user" placeholder="..." value="<?php echo $row->harga;?>">
							</div>
							<label for="KodeDermaga" class="col-sm-2 col-form-label">Jumlah Stok</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="KodeDermaga" name="KodeDermaga" placeholder="..." value="<?php echo $row->jumlah_stok;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-sm-2 col-form-label">Jenis Harga</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="password" name="password" placeholder="..." value="<?php echo $row->jenis_harga;?>">
							</div>
                            <label for="password" class="col-sm-2 col-form-label">Tanggal Expired</label>
							<div class="col-sm-4">
								<input type="date" class="form-control" id="password" name="password" placeholder="..." value="<?php echo $row->tgl_expired;?>">
							</div>
						</div>
					</div>
					<!-- /.card-body -->
				</div>
				<?php endforeach; ?>
        </div>
    </div>
</div>
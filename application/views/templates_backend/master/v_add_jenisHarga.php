<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jenis Harga</h1>
    </div>
        
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg">
                                        
				<div class="card shadow mb-4">

					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Jenis Harga</h6>
					</div>
					<form action="<?php echo base_url('Master/insertjenisHarga'); ?>" method="post">

					<div class="card-body">
						<div class="form-group row">
							<label for="user" class="col-sm-2 col-form-label">Nama Jenis Harga</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="jenis" name="jenis" placeholder="500 Gr" value="">
							</div>
							<label for="user" class="col-sm-2 col-form-label">Jumlah</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="500" value="">
							</div>
						</div>
						<div class="form-group row">
							<label for="user" class="col-sm-2 col-form-label">Jenis Berat</label>
							<div class="col-sm-4">
								<select class="form-control" name="singkatan_berat" id="singkatan_berat">
									<option value="0">Jenis Berat</option>
									<?php foreach($getBerat->result() as $row): ?>
										<option value="<?php echo $row->singkatan_berat;?>"><?php echo $row->singkatan_berat;?></option>
									<?php endforeach;?>
								</select>
							</div>
							<label for="KodeDermaga" class="col-sm-2 col-form-label"></label>
							<div class="col-sm-4">
								<button class="btn btn-primary btn-icon-split" type="submit"><span class="text">Tambah Kategori</span></button>
							</div>
						</div>
					</div>
					</form>
					<!-- /.card-body -->
				</div>
        </div>
    </div>
</div>
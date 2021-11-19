<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kategori</h1>
    </div>
        
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg">
                                        
				<div class="card shadow mb-4">

					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Kategori</h6>
					</div>
					<form action="<?php echo base_url('Master/insertKategori'); ?>" method="post">

					<div class="card-body">
						<div class="form-group row">
							<label for="user" class="col-sm-2 col-form-label">Nama Kategori</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="jenis" name="jenis" placeholder="..." value="">
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
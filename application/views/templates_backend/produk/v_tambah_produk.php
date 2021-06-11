<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
	</div>
	<div>
        <?php echo $this->session->flashdata('message');?>
    </div>
	<form action="<?php echo base_url('data/Data_produk/insertProduk'); ?>" method="post">
	<!-- Content Row  -->
	<div class="row">

		<!-- Content Column -->
		<div class="col-lg">

			<div class="card shadow mb-4">

				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Kategori</h6>
				</div>

				<div class="card-body">
					<div class="form-group row">
						<label for="user" class="col-sm-2 col-form-label">Kategori</label>
						<div class="col-sm-4">
							<select class="form-control" name="id_kategori" id="id_kategori">
								<option value="0">-Pilih Kategori-</option>
								<?php foreach($getkategori->result() as $row): ?>
									<option value="<?php echo $row->id;?>"><?php echo $row->jenis;?></option>
								<?php endforeach;?>
							</select>
						</div>
						<label class="col-sm-2 col-form-label">Nama Produk</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="..." value="">
						</div>
					</div>
					<div class="form-group row">
						<label for="password" class="col-sm-2 col-form-label">Deskripsi</label>
						<div class="col-sm-12">
							<textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
						</div>
					</div>
				</div>
				<!-- /.card-body -->
			</div>

			<div class="card shadow mb-4">
				<button class="btn btn-primary btn-icon-split" type="Submit" id="submit_prod"><span class="text">Submit Produk</span></button>
			</div>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
	$('#submit_prod').on('click', function() {
		var id_kategori    =$('#id_kategori').val();
		if (id_kategori == '0') {
			alert('INVALID KATEGORI');
			return false;
		} else {
			return true;
		}
	});
</script>
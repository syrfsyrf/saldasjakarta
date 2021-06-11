<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Produk</h1>
    </div>
    <div>
        <?php echo $this->session->flashdata('message');?>
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
								<input type="text" readonly class="form-control" id="user" name="user" placeholder="..." value="<?php echo $row->nama_produk;?>">
							</div>
							<label for="KodeDermaga" class="col-sm-2 col-form-label">Kategori</label>
							<div class="col-sm-4">
								<input type="text" readonly class="form-control" id="KodeDermaga" name="KodeDermaga" placeholder="..." value="<?php echo $row->kategori;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-sm-2 col-form-label">Created By</label>
							<div class="col-sm-4">
								<input type="text" readonly class="form-control" id="password" name="password" placeholder="..." value="<?php echo $row->created_by;?>">
							</div>
                            <label for="password" class="col-sm-2 col-form-label">Insert Date</label>
							<div class="col-sm-4">
								<input type="text" readonly class="form-control" id="password" name="password" placeholder="..." value="<?php echo $row->insert_date;?>">
							</div>
						</div>
						<form method="post" action="<?php echo base_url('data/Data_produk/uploadProduk');?>" enctype="multipart/form-data">
						<div class="form-group row">
							<?php if ($row->file != NULL && $row->path != NULL) { ?>
								<a href="<?php echo base_url('data/Data_produk/download/').$row->id_produk;?>" class="form-control btn btn-primary">Download Gambar Produk</a>
							<?php } else { ?>
								
									<label for="password" class="col-sm-2 col-form-label">Gambar Produk</label>
									<div class="col-sm-4">
										<input type="file" required class="form-control" id="file_produk" name="file_produk" placeholder="...">
										<input type="hidden" class="form-control" id="id_produk" name="id_produk" placeholder="..." value="<?php echo $row->id_produk;?>">
									</div>
									<label for="password" class="col-sm-2 col-form-label"></label>
									<div class="col-sm-4">
										<button class="btn btn-primary btn-icon-split" type="Submit"><span class="text">Upload Gambar</span></button>
									</div>
							<?php } ?>
						</div>
								</form>
					</div>
					<!-- /.card-body -->
				</div>
				<?php endforeach; ?>
        </div>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Stock</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableProduk" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal Expired</th>
                                    <th>Jumlah Stock</th>
                                    <th>Sisa Stock</th>
                                    <th>Harga</th>
                                    <th>Jenis Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tanggal Expired</th>
                                    <th>Jumlah Stock</th>
                                    <th>Sisa Stock</th>
                                    <th>Harga</th>
                                    <th>Jenis Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            	<?php foreach($getproduk2->result() as $row): ?>
                            		<tr>
                            			<td><?php echo $row->tgl_expired;?></td>
                            			<td><?php echo $row->jumlah_stok;?></td>
                                        <td><?php echo $row->sisa_stok;?></td>
                            			<td><?php echo $row->harga;?></td>
                            			<td><?php echo $row->djenis_harga;?></td>
                            			<td><?php if($row->status == '1'){ echo "Aktif"; } else {echo "Non Aktif";}?></td>
                                        <td>
                                            <div class="dropdown no-arrow">
                                                <a href="#" class="dropdown-toggle btn btn-info btn-circle" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw "></i></a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="<?php echo base_url('Produk/detail_stok/'.$row->id_stock);?>">Detail Stok</a>
                                                </div>
                                            </div>
                                        </td>
                            		</tr>
                            	<?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
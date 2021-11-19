<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Stok</h1>
    </div>
    <div>
        <?php echo $this->session->flashdata('message');?>
    </div>
        
    <!-- Content Row -->
        <div class="row">

        <!-- Content Column -->
        <div class="col-lg">
        <?php foreach($getStock->result() as $row): ?>
                                        
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
                            <label for="password" class="col-sm-2 col-form-label">Jumlah Stok</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control" id="password" name="password" placeholder="..." value="<?php echo $row->jumlah_stok;?>">
                            </div>
                            <label for="password" class="col-sm-2 col-form-label">Tanggal Expired</label>
                            <div class="col-sm-4">
                                <input type="date" readonly class="form-control" id="password" name="password" placeholder="..." value="<?php echo $row->tgl_expired;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control" id="password" name="password" placeholder="..." value="<?php echo $row->harga;?>">
                            </div>
                            <label for="password" class="col-sm-2 col-form-label">Jenis Harga</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control" id="password" name="password" placeholder="..." value="<?php echo $row->djenis_harga;?>">
                            </div>
                        </div>
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
                                    <th>Transaction ID</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Kuantitas</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Kuantitas</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            	<?php foreach($getDetailStock->result() as $row): ?>
                            		<tr>
                            			<td><?php echo $row->transaction_id;?></td>
                            			<td><?php echo $row->metode_pembayaran;?></td>
                                        <td><?php echo $row->tgl_pembayaran;?></td>
                            			<td><?php echo $row->kuantitas;?></td>
                            			<td><?php echo $row->harga;?></td>
                                        <td><?php echo $row->total_produk;?></td>
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
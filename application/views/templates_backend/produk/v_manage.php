<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach($getCountTotalProd->result() as $row): echo $row->total_produk; endforeach;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Stok Hampir Kadaluarsa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach($getHampirExpProd->result() as $row): echo $row->jumlah_prod_exp.' Produk'; endforeach;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Stok Hampir Habis</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach($getHampirHabisProd->result() as $row): echo $row->jumlah_prod_hampir_habis.' Produk'; endforeach;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
                    <div class="dropdown no-arrow">
                        <a href="<?php echo base_url('Produk/tambah_produk');?>" class="btn btn-primary btn-icon-split"><span class="text">Tambah Produk</span></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableProduk" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Expired</th>
                                    <th>Stock Tersedia</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Expired</th>
                                    <th>Stock Tersedia</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach($getproduk->result() as $row): ?>
                                    <tr>
                                        <td><?php echo $row->nama_produk;?></td>
                                        <td>
                                            <?php if ($row->harga == NULL) {
                                                echo "-";
                                            } else { ?>
                                                Rp <?php echo $row->harga.$row->jenis_harga_detail;?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($row->keterangan_exp == NULL) {
                                                echo "-";
                                            } else { ?>
                                                <?php echo $row->keterangan_exp;?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($row->keterangan_stock == NULL) {
                                                echo "-";
                                            } else { ?>
                                                <?php echo $row->keterangan_stock;?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="dropdown no-arrow">
                                                <a href="#" class="dropdown-toggle btn btn-info btn-circle" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw "></i></a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                    <?php if ($row->harga == NULL && $row->tgl_expired == NULL && $row->jumlah_stok == NULL) { ?>
                                                        <a class="dropdown-item" href="<?php echo base_url('Produk/tambah_stok/'.$row->id_produk);?>">Tambah Stok</a>
                                                    <?php } else { ?>
                                                        <a class="dropdown-item" href="<?php echo base_url('Produk/edit/'.$row->id_produk);?>">Edit</a>
                                                        <a class="dropdown-item" href="<?php echo base_url('Produk/tambah_stok/'.$row->id_produk);?>">Tambah Stok Baru</a>
                                                    <?php } ?>
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
<!-- /.container-fluid -->
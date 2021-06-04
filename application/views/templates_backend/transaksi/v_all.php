<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Produk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Metode</th>
                                    <th>Status Approved</th>
                                    <th>Tanggal Dibayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Metode</th>
                                    <th>Status Approved</th>
                                    <th>Tanggal Dibayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach($getTransaksi->result() as $row): ?>
                                    <tr>
                                        <td><?php echo $row->insert_date;?></td>
                                        <td>
                                            <?php if ($row->status == '0') { ?>
                                                <button class="btn btn-primary btn-icon-split"><span class="text"><?php echo $row->detail;?></span></button>
                                            <?php } elseif ($row->status == '1') { ?>
                                                <button class="btn btn-success btn-icon-split"><span class="text"><?php echo $row->detail;?></span></button>
                                            <?php } elseif ($row->status == '5') { ?>
                                                <button class="btn btn-warning btn-icon-split"><span class="text"><?php echo $row->detail;?></span></button>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $row->jenis;?></td>
                                        <td><?php echo $row->approved;?></td>
                                        <td><?php echo $row->tgl_pembayaran;?></td>
                                        <td>
                                            <div class="dropdown no-arrow">
                                                <a href="#" class="dropdown-toggle btn btn-info btn-circle" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw "></i></a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="<?php echo base_url('transaksi/detail/'.$row->id);?>">Detail</a>
                                                    <?php if ($row->is_approved == '2' || $row->is_approved == NULL) { ?>
                                                        <a class="dropdown-item" href="#">Review Pembayaran</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid
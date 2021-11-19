<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Menunggu persetujuan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableApprove" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach($getPendingPesanan->result() as $row): ?>
                                    <tr>
                                        <td><?php echo $row->transaction_id;?></td>
                                        <td><?php echo $row->metode_pembayaran;?></td>
                                        <td><?php echo $row->total;?></td>
                                        <td><?php echo $row->dstatus;?></td>
                                        <td>
                                            <?php if ($row->file == NULL) { ?>
                                                <button class="btn btn-danger btn-icon-split"><span class="text">Tanda Terima Tidak Tersedia</span></button>
                                            <?php } else { ?>
                                                <button class="btn btn-warning btn-icon-split"><span class="text">Tanda Terima Tersedia</span></button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="dropdown no-arrow">
                                                <a href="#" class="dropdown-toggle btn btn-info btn-circle" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw "></i></a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="<?php echo base_url('Pembayaran/detail/'.$row->id_pesanan);?>">Detail</a>
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
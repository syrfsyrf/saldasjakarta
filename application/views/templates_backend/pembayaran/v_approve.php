<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Disetujui</h1>
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
                            Disetujui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach($getAprovedTrans->result() as $row): echo $row->count_approved; endforeach;?></div>
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
                            Menunggu Pembayaran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach($getPendingTrans->result() as $row): echo $row->count_pending; endforeach;?></div>
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
                            Pesanan Ditolak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach($getRejectedTrans->result() as $row): echo $row->count_rejected; endforeach;?></div>
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
                    <h6 class="m-0 font-weight-bold text-primary">Pending Approval</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableApprove" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Receipt</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Receipt</th>
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
                                                <button class="btn btn-danger btn-icon-split"><span class="text">Receipt Not Available</span></button>
                                            <?php } else { ?>
                                                <button class="btn btn-warning btn-icon-split"><span class="text">Receipt Available</span></button>
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
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pendapatan <?php echo $param; ?></h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Report Pendapatan</h6>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="user" class="col-sm-2 col-form-label">Total Report</label>
                        <div class="col-sm-4">
                            <input type="type" class="form-control" id="monthReport" name="monthReport" value="Rp <?php foreach($getReportDetailD->result() as $row): echo $row->dtotal; endforeach; ?>">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Report</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataReport" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Insert Date</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; foreach($getReportDetail->result() as $row): $total = $total + $row->dtotal; ?>
                                    <tr>
                                        <td><?php echo $row->insert_date;?></td>
                                        <td>
                                            <?php if ($row->status == '0') { ?>
                                                <button class="btn btn-primary btn-icon-split"><span class="text"><?php echo $row->metode_pembayaran;?></span></button>
                                            <?php } elseif ($row->status == '1') { ?>
                                                <button class="btn btn-success btn-icon-split"><span class="text"><?php echo $row->metode_pembayaran;?></span></button>
                                            <?php } elseif ($row->status == '5') { ?>
                                                <button class="btn btn-warning btn-icon-split"><span class="text"><?php echo $row->metode_pembayaran;?></span></button>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $row->tgl_pembayaran;?></td>
                                        <td>Rp <?php echo $row->total;?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Insert Date</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Total</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Rp <?php echo $total; ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
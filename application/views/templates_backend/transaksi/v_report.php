<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Report Pendapatan</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Generate Report</h6>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="user" class="col-sm-2 col-form-label">Month</label>
                        <div class="col-sm-4">
                            <input type="month" class="form-control" id="monthReport" name="monthReport" value="">
                        </div>
                        <label for="KodeDermaga" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-4">
                            <button class="btn btn-primary btn-icon-split" onclick="generateReport()"><span class="text">Generate</span></button>
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
                                    <th>Periode</th>
                                    <th>Total Pendapatan</th>
                                    <th>Generate By</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Periode</th>
                                    <th>Total Pendapatan</th>
                                    <th>Generate By</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach($getReport->result() as $row): ?>
                                    <tr>
                                        <td><?php echo $row->date_period; ?></td>
                                        <td>Rp <?php echo $row->dtotal; ?></td>
                                        <td><?php echo $row->generate_by; ?></td>
                                        <td>
                                            <div class="dropdown no-arrow">
                                                <a href="#" class="dropdown-toggle btn btn-info btn-circle" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw "></i></a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="<?php echo base_url('transaksi/delete_report/'.$row->id);?>">Delete Report</a>
                                                    <a class="dropdown-item" href="<?php echo base_url('transaksi/detail_report/'.$row->ddate_period.'/'.$row->id);?>">Detail Report</a>
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

<script src="<?php echo base_url() ?>/assets/backend/js/audit.js"></script>
<script type="text/javascript">

    // getAuditData(dateStart, dateEnd);
</script>
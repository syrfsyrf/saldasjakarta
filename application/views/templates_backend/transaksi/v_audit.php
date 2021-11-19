<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pendapatan</h1>
    </div>
    <div>
        <?php echo $this->session->flashdata('message');?>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="user" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="dateStart" name="dateStart" value="">
                        </div>
                        <label for="KodeDermaga" class="col-sm-2 col-form-label">Tanggal Berakhir</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="dateEnd" name="dateEnd" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn-icon-split" onclick="getAuditData()"><span class="text">Pencarian</span></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><div id="summary"></div></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody id="t_audit">
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
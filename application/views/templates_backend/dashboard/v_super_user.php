<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Audit</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Audit</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataAudit" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Event</th>
                                    <th>Action</th>
                                    <th>Catatan</th>
                                    <th>Info</th>
                                    <th>Event Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>User</th>
                                    <th>Event</th>
                                    <th>Action</th>
                                    <th>Catatan</th>
                                    <th>Info</th>
                                    <th>Event Date</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach($getLogSummary->result() as $row): ?>
                                    <tr>
                                        <td><?php echo $row->user_info;?></td>
                                        <td><?php echo $row->jenis;?></td>
                                        <td><?php echo $row->aksi;?></td>
                                        <td><?php echo $row->catatan;?></td>
                                        <td><?php echo $row->info;?></td>
                                        <td><?php echo $row->insert_date;?></td>
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
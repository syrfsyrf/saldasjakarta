<div class="container-fluid">
    <div class="row">
        <div class="col-md-7">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Order</h1>
            </div>
            <div class="row">
                <?php foreach($getKategori->result() as $row): ?>
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card bg-info text-white shadow">
                            <button class="btn btn-info btn-block" onclick="getOrder(<?php echo $row->id;?>)"><span class="text"><?php echo $row->jenis;?></span></button> 
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="row">

                <!-- Content Column -->

                <div class="col-lg-12 mb-12">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" id="kategoriname"></h6>
                        </div>
                        <div class="card-body">
                            <div class="row" id="targetOrder">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Order List</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="cart_items">
                    </div>

                    <div class="p-3 bg-warning text-white">
                        <div class="row">
                            <div class="col-md-6">
                                Sub Total
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4"><div id="totalOrder">0</div></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                  <button class="btn btn-danger btn-block" onclick="doCancel()"><span class="text">Cancel</span></button>  
              </div>
              <div class="col-md-6">
                  <button class="btn btn-primary btn-block" onclick="doCheckOut()"><span class="text">Check Out</span></button>  
              </div>
          </div>
          <br>
          <div id="dibayar_text">
              <div class="row">
                <div class="col-md-12">
                    <div class="p-3 bg-white text-dark">
                        <div class="row">
                            <div class="col-md-4">
                                Dibayar
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required maxlength="10" id="dibayar_textbox" value=" ">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success btn-block" onclick="checkOut()"><span class="text"><i class="text-white fas fa-check"></i></span></button>  
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                Kembali
                            </div>
                            <div class="col-md-6">
                                <input type="text" readonly class="form-control calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required maxlength="10" id="kembalian" value=" ">
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Metode</th>
                                    <th>Tanggal Dibayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableTrans">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?php echo base_url() ?>/assets/backend/js/cashier.js"></script>
<!-- /.container-fluid -->
<script type="text/javascript">
    var x = document.getElementById("dibayar_text");
    x.style.display = "none";

    getUserLastOrder(<?php echo $_SESSION['logged_in']['id_user']; ?>);
    getTransaksi(<?php echo $_SESSION['logged_in']['id_user']; ?>);
</script>
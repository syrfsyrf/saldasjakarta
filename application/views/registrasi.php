<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                      <img class="col-lg-6 d-none d-lg-block" src="<?php echo base_url(); ?>assets/backend/img/TOKO DAGING SALDAS LOGO.jpg" alt="Card image cap"></img>
                    <div class="col-lg-5">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><strong>Buat Akun Anda Disini!</strong></h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Nama Depan">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Nama Belakang">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Alamat Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Masukan Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Ulangi Password">
                                    </div>
                                </div>
                                <a href="<?php echo base_url('/registrasi/v_registrasi'); ?>" class="btn btn-primary btn-user btn-block">
                                    Daftar Akun
                                </a>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Lupa Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?php echo base_url('/login/login'); ?>">Apakah Anda Sudah Memiliki Akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
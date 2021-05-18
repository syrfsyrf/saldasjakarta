<?php

class registrasi extends CI_Controller{

    public function __construct(){
        parent::__construct();

        /* if($this->session->userdata('role_id') != '1'){
            $this->session->set_flashdata('pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Anda Belum Login!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('auth/login');
        } */
    }

    public function registrasi()
    {
        $this->load->view('templates_backend/v_header');
        $this->load->view('registrasi');
        $this->load->view('templates_backend/v_footer');
    }
}
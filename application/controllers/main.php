<?php

class main extends CI_Controller{

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

    public function index()
    {
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/v_main');
        $this->load->view('templates_frontend/v_footer');
    }

    public function kategori_produk()
    {
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/kategori_produk/v_dagingsapi.php');
        $this->load->view('templates_frontend/kategori_produk/v_dagingayam.php');
        $this->load->view('templates_frontend/kategori_produk/v_dagingikan.php');
        $this->load->view('templates_frontend/kategori_produk/v_frozenfood.php');
        $this->load->view('templates_frontend/kategori_produk/v_homemade.php');
        $this->load->view('templates_frontend/v_footer');   
    }

    public function detail_produk()
    {
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/detail_produk/v_detail');
        $this->load->view('templates_frontend/v_footer');   
    }

    public function tentang_kami()
    {
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/tentang_kami/v_tentang_kami');
        $this->load->view('templates_frontend/v_footer');   
    }

    public function kontak_kami()
    {
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/kontak_kami/v_kontak_kami');
        $this->load->view('templates_frontend/v_footer');   
    }

    public function keranjang()
    {
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/keranjang/v_keranjang');
        $this->load->view('templates_frontend/v_footer');   
    }

    public function bayar()
    {
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/bayar/v_bayar');
        $this->load->view('templates_frontend/v_footer');   
    }
}
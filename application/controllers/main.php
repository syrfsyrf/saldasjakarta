<?php

class Main extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_order');
        $this->load->model('m_produk');
        $this->load->model('m_user');
    }

    public function index()
    {
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/v_main');
        $this->load->view('templates_frontend/v_footer');
    }

    public function kategori_produk()
    {
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/kategori_produk/v_kat_produk', $data);
        $this->load->view('templates_frontend/v_footer');   
    }

    public function detail_produk($id)
    {
        $data['GetDetailProdukFront'] = $this->m_produk->GetDetailProdukFront($id);
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/detail_produk/v_detail', $data);
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
        $data['paymentMethod'] = $this->m_order->paymentMethod();
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/bayar/v_bayar', $data);
        $this->load->view('templates_frontend/v_footer');   
    }

    public function myOrder()
    {
        $data['getUserOrder'] = $this->m_order->getUserOrder();
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/keranjang/v_myOrder', $data);
        $this->load->view('templates_frontend/v_footer');   
    }

    public function detail($param, $id)
    {
        $data['getPesanan'] = $this->m_order->getPesanan($id, $param);
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/keranjang/v_detail', $data);
        $this->load->view('templates_frontend/v_footer');   
    }

    public function profile($username){
        $data['getUserProfile'] = $this->m_user->getUserProfile($username);
        $this->load->view('templates_frontend/v_header');
        $this->load->view('templates_frontend/profile/v_profile', $data);
        $this->load->view('templates_frontend/v_footer');   
    }
}
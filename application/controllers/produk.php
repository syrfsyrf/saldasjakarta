<?php

class Produk extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_menu');
        $this->load->model('m_produk');
        $this->load->model('m_count');

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            if ($_SESSION['logged_in']['role'] == '5') {
                redirect();
            }
        }
    }

    public function manage()
    {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();

        $data['getproduk'] = $this->m_produk->GetProduk();

        $data['getCountTotalProd'] = $this->m_count->getCountTotalProd();
        $data['getHampirExpProd'] = $this->m_count->getHampirExpProd();
        $data['getHampirHabisProd'] = $this->m_count->getHampirHabisProd();
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/produk/v_manage', $data);
        $this->load->view('templates_backend/v_footer');
    }

    public function edit($value)
    {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();
        $data['getproduk'] = $this->m_produk->GetDetailProduk('edit', $value);
        $data['getproduk2'] = $this->m_produk->GetDetailProduk('stock_detail', $value);
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/produk/v_edit', $data);
        $this->load->view('templates_backend/v_footer');
    }

    public function tambah_produk()
    {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();
        $data['getkategori'] = $this->m_produk->GetKategori();
        $data['getJenisHarga'] = $this->m_produk->GetJenisHarga();
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/produk/v_tambah_produk', $data);
        $this->load->view('templates_backend/v_footer');
    }

    public function tambah_stok($value)
    {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();
        $data['getproduk'] = $this->m_produk->GetDetailProduk('edit', $value);
        $data['getJenisHarga'] = $this->m_produk->GetJenisHarga();
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/produk/v_tambah_stok', $data);
        $this->load->view('templates_backend/v_footer');
    }
}
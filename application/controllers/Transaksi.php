<?php

class Transaksi extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_menu');
        $this->load->model('m_transaksi');

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            if ($_SESSION['logged_in']['role'] == '5') {
                redirect();
            }
        }
    }

    public function index() {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();

        $data['getTransaksi'] = $this->m_transaksi->getTransaksi();
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/transaksi/v_all', $data);
        $this->load->view('templates_backend/v_footer');
    }
}
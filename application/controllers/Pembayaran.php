<?php

class Pembayaran extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_menu');
        $this->load->model('m_pembayaran');
        $this->load->model('m_count');
        $this->load->model('m_order');

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            if ($_SESSION['logged_in']['role'] == '5') {
                redirect();
            }
        }
    }

    public function approve() {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();

        $data['getPendingPesanan'] = $this->m_pembayaran->getPendingPesanan();

        $data['getAprovedTrans'] = $this->m_count->getAprovedTrans();
        $data['getRejectedTrans'] = $this->m_count->getRejectedTrans();
        $data['getPendingTrans'] = $this->m_count->getPendingTrans();
        
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/pembayaran/v_approve', $data);
        $this->load->view('templates_backend/v_footer');
    }

    public function detail($id) {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();

        $data['getPesanan'] = $this->m_order->getPesanan($id, 'BACKEND');
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/pembayaran/v_detail', $data);
        $this->load->view('templates_backend/v_footer');
    }
}
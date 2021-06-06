<?php

class Dashboard extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_menu');
        $this->load->model('m_order');
        $this->load->model('m_pembayaran');
        $this->load->model('m_count');

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

        $this->load->view('templates_backend/v_header', $array);
        switch ($_SESSION['logged_in']['role']) {
            case "1":
            $this->load->view('templates_backend/dashboard/v_super_user');
            break;

            case "2":
            $data['getPendingPesanan'] = $this->m_pembayaran->getPendingPesanan();
            $this->load->view('templates_backend/dashboard/v_admin', $data);
            break;

            case "3":
            $data['getTotalTransaction'] = $this->m_count->getTotalTransaction();
            $data['getTotalThisMonth'] = $this->m_count->getTotalThisMonth();
            $data['getTotalLastWeek'] = $this->m_count->getTotalLastWeek();
            $data['getTotalToday'] = $this->m_count->getTotalToday();
            $this->load->view('templates_backend/dashboard/v_manager', $data);
            break;
            
            case "4":
            $data['getKategori'] = $this->m_order->getKategori('PHP');
            $this->load->view('templates_backend/dashboard/v_kasir', $data);
            break;
            default:
            echo "Your favorite color is neither red, blue, nor green!";
        }
        $this->load->view('templates_backend/v_footer');
    }
}
<?php

class Data_dashboard extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_dashboard');

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){								
			redirect('Login');
		}
    }

    public function getDistinctMetodePembayaran(){
        $hasil = $this->m_dashboard->getDistinctMetodePembayaran();
        echo json_encode($hasil);
    }

    public function getValDistinct(){
        $hasil = $this->m_dashboard->getValDistinct();
        echo json_encode($hasil);
    }

    public function getChartManager(){
        $hasil = $this->m_dashboard->getChartManager();
        echo json_encode($hasil);
    }
}

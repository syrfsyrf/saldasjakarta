<?php

class Data_user extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_user');

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){								
			redirect('Login');
		}
    }

    public function getDataUser(){
    	$id_user = $this->input->post('id_user');
        $hasil = $this->m_user->getDataUser($id_user);
        echo json_encode($hasil);
    }
}

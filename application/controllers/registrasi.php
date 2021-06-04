<?php

class Registrasi extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            if ($_SESSION['logged_in']['role'] == '5') {
                redirect();
            }
        }
    }

    public function registrasi()
    {
        $this->load->view('templates_backend/v_header');
        $this->load->view('registrasi');
        $this->load->view('templates_backend/v_footer');
    }
}
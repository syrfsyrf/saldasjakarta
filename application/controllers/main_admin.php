<?php

class Main_admin extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        }
    }

    public function index()
    {
        $this->load->view('templates_backend/v_header');
        $this->load->view('templates_backend/v_main');
        $this->load->view('templates_backend/v_footer');

        
    }
}
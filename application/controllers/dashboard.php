<?php

class dashboard extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_menu');

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
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/v_main');
        $this->load->view('templates_backend/v_footer');
    }
}
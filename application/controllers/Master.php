<?php

class Master extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_menu');
        $this->load->model('m_master');

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            if ($_SESSION['logged_in']['role'] == '5') {
                redirect();
            }
        }
    }

    public function kategori() {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();
        
        $data['getMstKategori'] = $this->m_master->getMstKategori();
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/master/v_kategori', $data);
        $this->load->view('templates_backend/v_footer');
    }

    public function addKategori() {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();
        
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/master/v_add_kategori');
        $this->load->view('templates_backend/v_footer');
    }

    public function insertKategori(){
        $jenis = $this->input->post('jenis');
        $result = $this->m_master->insertKategori($jenis);
        if ($result == TRUE) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            // echo "sukses";
        } else {
            echo "gagal";
        }
    }

    public function jenisHarga() {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();
        
        $data['getMstKategori'] = $this->m_master->getMstKategori();
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/master/v_jenisHarga', $data);
        $this->load->view('templates_backend/v_footer');
    }

    public function addjenisHarga() {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();

        $data['getBerat'] = $this->m_master->getBerat();        
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/master/v_add_jenisHarga', $data);
        $this->load->view('templates_backend/v_footer');
    }

    public function insertjenisHarga(){
        $data = array(
            'jenis' => $this->input->post('jenis'),
            'jumlah' => $this->input->post('jumlah'),
            'singkatan_berat' => $this->input->post('singkatan_berat')
        );
        $result = $this->m_master->insertjenisHarga($data);
        if ($result == TRUE) {
            // echo "sukses";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "gagal";
        }
    }
}
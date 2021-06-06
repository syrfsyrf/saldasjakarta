<?php

class Data_produk extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_produk');
        $this->load->model('m_file');
        $this->load->helper(array('url','download'));   
        $this->load->model('GenerateID_model');

        $this->uploadPath = "./assets/uploaded/product";

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        }
    }

    public function insertStock(){
        $dataStock = array(
            'id_produk' => $this->input->post('id_produk'),
            'jumlah_stok' => $this->input->post('jumlah_stock'),
            'tgl_expired' => $this->input->post('tgl_expired'),
            'harga' => $this->input->post('harga'),
            'jenis_harga' => $this->input->post('jenis_harga'),
            'created_by' => $_SESSION['logged_in']['id_user']);

        // print_r($dataStock);

        $result = $this->m_produk->insertUpdateStock('INSERT', $dataStock);
        if ($result == TRUE) {
            redirect('Produk/manage');
        } else {

        }
    }

    public function insertProduk(){
        $dataProduk = array(
            'id_kategori' => $this->input->post('id_kategori'),
            'nama' => ucwords($this->input->post('nama')),
            'deskripsi' => $this->input->post('deskripsi'),
            'created_by' => $_SESSION['logged_in']['id_user']);

        // print_r($dataProduk);

        $result = $this->m_produk->insertUpdateProduk('INSERT', $dataProduk);
        if ($result == TRUE) {
            redirect('Produk/manage');
        } else {

        }
    }

    public function download($id)
    {
        // echo $id;
        $file = $this->m_file->get_produk_info($id);
        $row1 = $file->row_array();
        force_download($row1['path']."/".$row1['file'], NULL);
        // echo $row1['PATH']."/".$row1['FILE'];
    }

    public function uploadProduk(){
        $id_produk = $this->input->post('id_produk');
        // echo $id_produk;

        $file = $this->GenerateID_model->generateid();
        $path = $this->uploadPath;
        $config = array(
            'upload_path'     => $path,
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => false,
            'max_size' => "2048000",
            'file_name' => $file
        );
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file_produk')) {
            $status_sukses_file = 'GAGAL';
            echo $status_sukses_file;
        } else {
            $filename = $this->upload->data('file_name');
            $status_sukses_file = 'SUKSES';
            $result = $this->m_file->updateProduk($id_produk, $filename, $path);
            if ($result == TRUE) {
                echo $status_sukses_file;
            } else {
                echo "gagal";
            }
        }
    }
}
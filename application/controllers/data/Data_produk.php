<?php

class Data_produk extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_produk');

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
}
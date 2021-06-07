<?php

class Data_order extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_order');
        $this->load->model('GenerateID_model');
        $this->load->model('m_file');
        $this->load->helper(array('url','download'));   

        $this->uploadPath = "./assets/uploaded/receipt";

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        }
    }

    public function getKategori($param){
        $hasil = $this->m_order->getKategori($param);
        echo json_encode($hasil);
    }

    public function getOrder($id, $param = FALSE){
        $hasil = $this->m_order->getOrder($id, $param);
        echo json_encode($hasil);
    }

    public function getUserAvailablity($id){
        $hasil = $this->m_order->getUserAvailablity($id);
        echo json_encode($hasil);
    }

    public function getUserLastOrder($id){
        $hasil = $this->m_order->getUserLastOrder($id);
        echo json_encode($hasil);
    }

    public function getDetailOrder($id){
        $hasil = $this->m_order->getDetailOrder($id);
        echo json_encode($hasil);
    }

    public function getDetailPesanan($param, $id){
        $hasil = $this->m_order->getDetailPesanan($param, $id);
        echo json_encode($hasil);
    }

    public function addOrder(){
        $id_stock = $this->input->post('id_stock');
        $id_pesanan = $this->input->post('id_pesanan');

        $data = array(
            'id_stock' => $id_stock,
            'id_pesanan' => $id_pesanan);

        $cek = $this->m_order->cekAvailOrder($data)->num_rows();

        if ($cek > 0) {
            $hasil = $this->m_order->updateOrder($id_pesanan, $id_stock);
            echo json_encode($hasil);
        } else {
            $hasil = $this->m_order->insertOrder($id_pesanan, $id_stock);
            echo json_encode($hasil);
        }

    }

    public function generateOrder(){
        $id_user = $this->input->post('id_user');
        $metode_pembayaran = $this->input->post('metode_pembayaran');

        $data = array(
            'id_user' => $id_user,
            'metode_pembayaran' => $metode_pembayaran);

        $hasil = $this->m_order->generateOrder($data);
        echo json_encode($hasil);
    }

    public function deleteOrder(){
        $id_pesanan = $this->input->post('id_pesanan');
        $hasil = $this->m_order->deleteOrder($id_pesanan);
        echo json_encode($hasil);
    }

    public function sumOrder($id){
        $hasil = $this->m_order->sumOrder($id);
        echo json_encode($hasil);
    }

    public function sumPesanan($param, $id){
        $hasil = $this->m_order->sumPesanan($param, $id);
        echo json_encode($hasil);
    }

    public function cancelOrder(){
        $id_pesanan = $this->input->post('id_pesanan');
        $hasil = $this->m_order->cancelOrder($id_pesanan);
        echo json_encode($hasil);
    }

    public function checkOut($param){
        if ($param == 'KASIR') {
            $id_pesanan = $this->input->post('id_pesanan');
            $cek = $this->m_order->checkAvailablityStock($id_pesanan, 'CEK')->num_rows();
            $hasil = $this->m_order->checkAvailablityStock($id_pesanan, 'LAIN');
            if ($cek > 0) {
                echo json_encode($hasil);
            } else {
                $hasil2 = $this->m_order->checkOutCash($id_pesanan);
                echo json_encode($hasil2);
            }
        } elseif ($param == 'ORDER') {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $telp = $this->input->post('telp');
            $jalan = $this->input->post('jalan');
            $rt = $this->input->post('rt');
            $rw = $this->input->post('rw');
            $kecamatan = $this->input->post('kecamatan');
            $kelurahan = $this->input->post('kelurahan');
            $kota = $this->input->post('kota');
            $provinsi = $this->input->post('provinsi');
            $kd_pos = $this->input->post('kd_pos');
            $desa = $this->input->post('desa');
            $id_pesanan = $this->input->post('id_pesanan');
            $paymentMethod = $this->input->post('paymentMethod');
            $ketOrder = 'Nama: '.$nama. ' Email: '.$email.' Telp: '.$telp.' Alamat: '.$jalan.' RT/RW '.$rt.'/'.$rw.' Kec. '.$kecamatan.' Kel. '.$kelurahan.' Kota: '.$kota.' Provinsi: '.$provinsi.' Kode Pos: '.$kd_pos.' Desa: '.$desa;
            $cek = $this->m_order->checkAvailablityStock($id_pesanan, 'CEK')->num_rows();
            $hasil = $this->m_order->checkAvailablityStock($id_pesanan, 'LAIN');
            if ($cek > 0) {
                echo json_encode($hasil);
            } else {
                // echo "gaada";
                $hasil2 = $this->m_order->checkOut($id_pesanan, $ketOrder, $paymentMethod);
                echo json_encode($hasil2);
            }
        }
    }

    public function uploadReceipt(){
        $id_pesanan = $this->input->post('id_pesanan');
        $file = $this->GenerateID_model->generateid();
        $directory = $this->uploadPath;
        $config = array(
            'upload_path'     => $directory,
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => false,
            'max_size' => "2048000",
            'file_name' => $file
        );
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file_receipt')) {
            $status_sukses_file = 'GAGAL';
            echo $status_sukses_file;
        } else {
            $filename = $this->upload->data('file_name');
            $status_sukses_file = 'SUKSES';
            $result = $this->m_file->updateReceipt($id_pesanan, $filename, $directory);
            if ($result == TRUE) {
                // echo $status_sukses_file;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                echo "gagal";
            }
        }
    }

    public function download($id)
    {
        // echo $id;
        $file = $this->m_file->get_doc_info($id);
        $row1 = $file->row_array();
        force_download($row1['directory']."/".$row1['file'], NULL);
        // echo $row1['PATH']."/".$row1['FILE'];
    }
}
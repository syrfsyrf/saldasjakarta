<?php

class Data_transaksi extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_transaksi');
        $this->load->model('m_pembayaran');

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        }
    }

    public function getTransaksi(){
        // $id_user = $this->input->post('id_user');
        $id_user = '4';
        $hasil = $this->m_transaksi->getTransaksi($id_user, 'DETAIL');
        echo json_encode($hasil);
    }

    public function approvePembayaran(){
        $id_pesanan = $this->input->post('id_pesanan');
        $transaction_id = $this->input->post('transaction_id');
        $type = $this->input->post('submit');
        $tgl_pembayaran = $this->input->post('tgl_pembayaran');
        if ($type == 'Approve') {
            $status = 1;
        } elseif($type == 'Reject') {
            $status = 0;
        }
        $data = array(
            'status' => $status,
            'approved_by' => $_SESSION['logged_in']['id_user'],
            'approved_date' => date("Y-m-d H:i:s"));
        // print_r($data);
        $result = $this->m_pembayaran->approvePembayaran($id_pesanan, $data, $tgl_pembayaran);
        if ($result == TRUE) {
            // echo "sukses";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Gagal";
        }
    }

    public function getAuditData(){
        $dateStart = $this->input->post('dateStart');
        $dateEnd = $this->input->post('dateEnd');
        $hasil = $this->m_transaksi->getAuditData($dateStart, $dateEnd);
        echo json_encode($hasil);
    }

    public function generateReport(){
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $hasil = $this->m_transaksi->generateReport($year, $month);
        echo json_encode($hasil);
    }
}
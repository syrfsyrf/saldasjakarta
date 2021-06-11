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
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <i class="icon fas fa-check"></i> Sukses Approve Pembayaran
                   </div>');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <i class="icon fas fa-times"></i> Gagal Approve Pembayaran
                   </div>');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
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
        if ($hasil == TRUE) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <i class="icon fas fa-check"></i> Sukses Generate Report
                   </div>');
            echo json_encode($hasil);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <i class="icon fas fa-times"></i> Gagal Generate Report
                   </div>');
            echo json_encode($hasil);
        }
    }
}
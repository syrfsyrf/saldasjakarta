<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_transaksi extends CI_Model {

	public function getTransaksi($id = FALSE, $param = FALSE) {
		if ($id != NULL && $param == 'DETAIL') {
			$hasil = $this->db->query("SELECT a.id, a.insert_date, a.status, c.detail, b.jenis, CASE WHEN a.is_approved = 1 THEN 'APPROVED' WHEN a.is_approved = 2 THEN 'REJECTED' END AS 'approved', a.is_approved, a.tgl_pembayaran FROM pesanan a JOIN mst_metode_pembayaran b ON a.metode_pembayaran = b.id JOIN tb_status_pesanan c ON a.status = c.id WHERE a.id_user = '".$id."' ORDER BY a.insert_date desc LIMIT 10");
			return $hasil->result();
		} else if ($id == NULL) {
			$hasil = $this->db->query("SELECT a.id, a.insert_date, a.status, c.detail, b.jenis, CASE WHEN a.is_approved = 1 THEN 'APPROVED' WHEN a.is_approved = 2 THEN 'REJECTED' END AS 'approved', a.is_approved, a.tgl_pembayaran FROM pesanan a JOIN mst_metode_pembayaran b ON a.metode_pembayaran = b.id JOIN tb_status_pesanan c ON a.status = c.id ORDER BY a.insert_date desc");
			return $hasil;
		}
	}
}
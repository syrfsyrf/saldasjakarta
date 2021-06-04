<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_count extends CI_Model {

	public function getCountTotalProd() {
		$hasil = $this->db->query("SELECT COUNT(*) AS 'total_produk' FROM mst_produk");
		return $hasil;
	}

	public function getHampirExpProd() {
		$hasil = $this->db->query("SELECT COUNT(*) AS 'jumlah_prod_exp' FROM stock WHERE status = '1' and DATEDIFF(tgl_expired, SYSDATE()) <= 30");
		return $hasil;
	}

	public function getHampirHabisProd() {
		$hasil = $this->db->query("SELECT COUNT(*) AS 'jumlah_prod_hampir_habis' FROM stock WHERE status = '1' AND (jumlah_stok - used_stok) < (jumlah_stok * 0.25)");
		return $hasil;
	}

	public function getAprovedTrans() {
		$hasil = $this->db->query("SELECT COUNT(*) AS 'count_approved' FROM order_job WHERE status = '1'");
		return $hasil;
	}

	public function getRejectedTrans() {
		$hasil = $this->db->query("SELECT COUNT(*) AS 'count_rejected' FROM order_job WHERE status = '0'");
		return $hasil;
	}

	public function getPendingTrans() {
		$hasil = $this->db->query("SELECT COUNT(*) AS 'count_pending' FROM pesanan WHERE status = '3'");
		return $hasil;
	}
}
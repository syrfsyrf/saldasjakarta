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

	public function getAuditData($dateStart, $dateEnd) {
			$hasil = $this->db->query("SELECT id, transaction_id, (SELECT jenis FROM mst_metode_pembayaran WHERE id = metode_pembayaran) AS 'metode_pembayaran', DATE_FORMAT(tgl_pembayaran, '%d %M %Y') AS 'tgl_pembayaran', total, FORMAT(total, 'c') AS 'dtotal' FROM pesanan WHERE status = '1' AND ((DATE(tgl_pembayaran) BETWEEN '".$dateStart."' AND '".$dateEnd."'))");
			return $hasil->result();
	}

	public function generateReport($year, $month){
		$cek = $this->db->query("SELECT * FROM report WHERE bulan_tahun = '".$year."-".$month."-01'")->num_rows();

        if ($cek > 0) {
            $this->db->trans_start();
			// $this->db->insert('pesanan_detail', $data);
			$this->db->query("
				UPDATE report SET total = (SELECT
				    SUM(total)
				FROM pesanan WHERE status = '1' AND (YEAR(tgl_pembayaran) = '".$year."' AND MONTH(tgl_pembayaran) = '".$month."')) WHERE bulan_tahun = '".$year."-".$month."-01'");
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}
        } else {
            $this->db->trans_start();
			// $this->db->insert('pesanan_detail', $data);
			$this->db->query("
				INSERT INTO report 
				(bulan_tahun, tahun, total, generate_by)
				SELECT
				    '".$year."-".$month."-01' AS bulan_tahun,
				    '".$year."' AS tahun,
				    SUM(total) AS total,
				    '".$_SESSION['logged_in']['id_user']."' AS generate_by
				FROM pesanan WHERE status = '1' AND (YEAR(tgl_pembayaran) = '".$year."' AND MONTH(tgl_pembayaran) = '".$month."')");
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}
        }
	}

	public function getReport(){
		$hasil = $this->db->query("SELECT id, DATE_FORMAT(bulan_tahun, '%M %Y') as 'date_period', DATE_FORMAT(bulan_tahun, '%M-%Y') as 'ddate_period', FORMAT(total, 'c') as 'dtotal', total, (SELECT nama FROM mst_user WHERE id = generate_by) AS 'generate_by' FROM report ORDER BY bulan_tahun DESC");
		return $hasil;
	}

	public function getReportDetail($id){
		$hasil = $this->db->query("SELECT id, insert_date, status, transaction_id, (SELECT jenis FROM mst_metode_pembayaran WHERE id = metode_pembayaran) AS 'metode_pembayaran', DATE_FORMAT(tgl_pembayaran, '%d %M %Y') AS 'tgl_pembayaran', FORMAT(total, 'c') as 'total', total as 'dtotal' FROM pesanan WHERE status = '1' AND (YEAR(tgl_pembayaran) = (SELECT YEAR(bulan_tahun) FROM report WHERE id = '".$id."') AND MONTH(tgl_pembayaran) = (SELECT MONTH(bulan_tahun) FROM report WHERE id = '".$id."'))");
		return $hasil;
	}

	public function getReportDetailD($id){
		$hasil = $this->db->query("SELECT total, FORMAT(total, 'c') as 'dtotal' FROM report WHERE id = '".$id."'");
		return $hasil;
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

	public function getDistinctMetodePembayaran() {
		$hasil = $this->db->query("SELECT id, jenis FROM mst_metode_pembayaran WHERE is_active = '1' ORDER BY id ASC");
		return $hasil->result();
		// return $hasil;
	}
	public function getValDistinct() {

		$query = "";
        $hasil['metode_pembayaran'] = $this->db->query("SELECT id FROM mst_metode_pembayaran WHERE is_active = '1' ORDER BY id ASC");
        $count = $this->db->query("SELECT id FROM mst_metode_pembayaran WHERE is_active = '1' ORDER BY id ASC")->num_rows();
        $i = 1;
        foreach($hasil['metode_pembayaran']->result() as $row ):
            $query .= "SELECT CAST(COUNT(*) as UNSIGNED) AS 'count' FROM pesanan WHERE status = '1' AND metode_pembayaran = '".$row->id."' ";
            if ($i!=$count) {
                $query .= "UNION ALL ";
            }
            $i++;
        endforeach;

		$hasil = $this->db->query($query);
		return $hasil->result();
	}

	public function getChartManager(){
		$hasil = $this->db->query("SELECT DATE_FORMAT(bulan_tahun,'%M') AS 'bulan', total  FROM report WHERE tahun = YEAR(SYSDATE()) ORDER BY bulan_tahun ASC");
		return $hasil->result();
	}
}
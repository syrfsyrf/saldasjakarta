<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_master extends CI_Model {

	public function getMstKategori()
	{
		$hasil = $this->db->query("SELECT id, jenis, is_active, 
			CASE 
			WHEN is_active = '1' THEN '<button class=\'btn btn-success btn-icon-split\'><span class=\'text\'>Aktif</span></button>'
			WHEN is_active = '0' THEN '<button class=\'btn btn-warning btn-icon-split\'><span class=\'text\'>Non Aktif</span></button>'
			END AS dis_active
			FROM mst_kategori");
		return $hasil;
	}

	public function insertKategori($jenis){
		$this->db->trans_start();
		$this->db->query("
			INSERT INTO mst_kategori (jenis) VALUE ('".$jenis."')");
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

	public function getBerat(){
		$hasil = $this->db->query("SELECT id, singkatan_berat FROM tb_berat");
		return $hasil;
	}

	public function insertjenisHarga($data){ 
		$this->db->trans_start();
		$this->db->insert('mst_jenis_harga', $data);
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
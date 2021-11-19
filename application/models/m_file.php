<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_file extends CI_Model {

	public function updateReceipt($id_pesanan, $file, $directory){
		$this->db->trans_start();
		$this->db->query("
			UPDATE order_job SET file = '".$file."', directory = '".$directory."' WHERE id_pesanan = '".$id_pesanan."'");
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

	public function updateProduk($id_produk, $file, $path){
		$this->db->trans_start();
		$this->db->query("
			UPDATE mst_produk SET file = '".$file."', path = '".$path."' WHERE id = '".$id_produk."'");
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

	public function get_doc_info($id){
		$this->db->select('file, directory');
		$this->db->where('id_pesanan', $id);
		return $this->db->get('order_job');
	}

	public function get_produk_info($id){
		$this->db->select('file, path');
		$this->db->where('id', $id);
		return $this->db->get('mst_produk');
	}
}
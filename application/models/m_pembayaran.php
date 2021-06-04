<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pembayaran extends CI_Model {

	public function getPendingPesanan()
	{
		$hasil = $this->db->query("SELECT a.id as 'id_pesanan', a.transaction_id, (SELECT jenis FROM mst_metode_pembayaran WHERE id = a.metode_pembayaran) AS 'metode_pembayaran', a.total, a.status, (SELECT detail FROM tb_status_pesanan WHERE id = a.status) AS 'dstatus', b.file, b.directory FROM pesanan a JOIN order_job b ON a.id = b.id_pesanan WHERE a.status = '3' AND a.is_approved IS NULL");
		return $hasil;
	}

	public function approvePembayaran($id_pesanan, $data){
		$this->db->trans_start();
		$this->db->where('id_pesanan', $id_pesanan);
		$this->db->update('order_job', $data);
		if ($data['status'] == '1') {
			$this->db->query("
			UPDATE pesanan SET tgl_pembayaran = now(), status = '1', is_approved = 1 WHERE id = '".$id_pesanan."'");

			$array['data_stock'] = $this->db->query("SELECT id FROM pesanan_detail WHERE id_pesanan = '".$id_pesanan."'");
			foreach($array['data_stock']->result() as $row ):
				$this->db->query("UPDATE stock SET used_stok = used_stok + (SELECT kuantitas FROM pesanan_detail WHERE id = '".$row->id."') WHERE id = (SELECT id_stock FROM pesanan_detail WHERE id = '".$row->id."')");
			endforeach;
		} 
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
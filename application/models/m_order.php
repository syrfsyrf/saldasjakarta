<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_order extends CI_Model {

	public function getKategori($param) {
		$hasil = $this->db->query("SELECT id, jenis FROM mst_kategori WHERE is_active = '1'");
		if ($param == 'PHP') {
			return $hasil;
		} elseif ($param == 'JS') {
			return $hasil->result();
		}
	}

	public function getUserOrder() {
		$hasil = $this->db->query("SELECT a.id, a.transaction_id, (SELECT jenis FROM mst_metode_pembayaran WHERE id = a.metode_pembayaran) AS 'metode_pembayaran', (SELECT detail FROM tb_status_pesanan WHERE id = a.status) AS 'status', a.status AS 'dstatus', a.insert_date AS 'transaction_date', a.total, (SELECT approved_date FROM order_job WHERE id_pesanan = a.id) AS 'approved_date', (SELECT file FROM order_job WHERE id_pesanan = a.id) AS 'receipt' FROM pesanan a WHERE a.id_user = '".$_SESSION['logged_in']['id_user']."' AND a.status != '0' ORDER BY a.insert_date DESC");
		return $hasil;
	}

	public function getOrder($id, $param = FALSE) {
		if ($param == 'SPESIFIK') {
			$condition ="a.id_kategori = '".$id."' AND";
		} elseif ($param == 'ALL') {
			$condition ="";
		} else {
			$condition ="a.id_kategori = '".$id."' AND";
		}
		$hasil = $this->db->query("SELECT * FROM (SELECT (SELECT jenis FROM mst_kategori WHERE id = id_kategori) as 'kategori', a.nama, a.file, a.path, b.jumlah_stok, b.id AS 'id_stock', FORMAT(b.harga, 'c') as 'harga', (SELECT jenis FROM mst_jenis_harga WHERE id = b.jenis_harga) AS 'jenis_harga_detail', (jumlah_stok - used_stok) AS 'sisa_stok',
			CASE
			WHEN b.tgl_expired < SYSDATE() THEN 'EXPIRED'
			ELSE 'AVAILABLE'
			END AS expire, a.id as 'id_produk'
			FROM mst_produk a JOIN stock b ON a.id = b.id_produk WHERE ".$condition." b.status = '1' GROUP BY b.id_produk ORDER BY b.insert_date DESC) O WHERE expire != 'EXPIRED'");
		return $hasil->result();
	}

	public function getOrderNotFound($id) {
		$hasil = $this->db->query("SELECT jenis FROM mst_kategori WHERE id = '".$id."'");
		return $hasil->result();
	}

	public function getUserLastOrder($id) {
		$hasil = $this->db->query("SELECT id as 'id_pesanan', total as 'total' FROM pesanan WHERE id_user = '".$id."' and status = '0' ORDER BY insert_date desc LIMIT 1");
		return $hasil->result();
	}

	public function getUserAvailablity($id) {
		$hasil = $this->db->query("SELECT id as 'id_pesanan', total as 'total', status as 'status', CASE WHEN status = 3 THEN '0' ELSE '1' END as 'avail' FROM pesanan WHERE id_user = '".$id."' ORDER BY insert_date desc LIMIT 1");
		return $hasil->result();
	}

	public function getDetailOrder() {
		$hasil = $this->db->query("SELECT a.id as 'id', a.id_pesanan as 'id_pesanan', a.id_produk, FORMAT(a.harga_stock, 'c') as 'harga_stock', a.kuantitas, 
			FORMAT((a.harga_stock * a.kuantitas), 'c') as 'total_produk', b.file, b.path, b.nama as 'produk' 
			FROM pesanan_detail a JOIN mst_produk b ON a.id_produk = b.id JOIN stock c ON a.id_stock = c.id WHERE a.id_pesanan = (SELECT id FROM pesanan WHERE id_user = '".$_SESSION['logged_in']['id_user']."' ORDER BY insert_date DESC LIMIT 1)");
		return $hasil->result();
	}

	public function cekAvailOrder($data){
		return $this->db->get_where('pesanan_detail', $data);
	}

	public function addOrder($id_stock, $qty) {
		$this->db->query("CALL PROCaddOrder(".$id_stock.", ".$_SESSION['logged_in']['id_user'].", ".$qty.", @p5, @p6)");
		return $this->db->query("SELECT @p5 AS 'OUTcd', @p6 AS 'OUTmsg'");
	}

	/*public function insertOrder($id_pesanan_detail, $id_stock){
		$this->db->trans_start();
		// $this->db->insert('pesanan_detail', $data);
		$this->db->query("
			INSERT INTO pesanan_detail 
			(id_pesanan, id_produk, id_stock, harga_stock, kuantitas)
			SELECT
			'".$id_pesanan_detail."' AS id_pesanan,
			id_produk AS id_produk,
			id AS id_stock,
			harga AS harga_stock,
			1 AS kuantitas
			FROM stock WHERE id = '".$id_stock."'");
		$this->db->trans_complete(); 

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} 
		else {
			$this->db->trans_commit();
			return TRUE;
		}
	}*/

	/*public function updateOrder($id_pesanan, $id_stock){
		$this->db->trans_start();
		// $this->db->insert('pesanan_detail', $data);
		$this->db->query("
			UPDATE pesanan_detail SET kuantitas = kuantitas + 1 WHERE id_pesanan = '".$id_pesanan."' AND id_stock = '".$id_stock."'");
		$this->db->trans_complete(); 

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} 
		else {
			$this->db->trans_commit();
			return TRUE;
		}
	}*/

	public function cancelOrder($id_pesanan){
		$this->db->trans_start();
		// $this->db->insert('pesanan_detail', $data);
		$this->db->query("
			UPDATE pesanan SET status = '5' WHERE id = '".$id_pesanan."'");
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

	public function sumOrder() {
		$hasil = $this->db->query("SELECT CASE WHEN FORMAT(SUM((harga_stock * kuantitas)), 'c') IS NULL THEN 0 ELSE FORMAT(SUM((harga_stock * kuantitas)), 'c') END AS 'total_order', SUM((harga_stock * kuantitas)) as 'total_order_nof' FROM pesanan_detail WHERE id_pesanan = (SELECT id FROM pesanan WHERE id_user = '".$_SESSION['logged_in']['id_user']."' ORDER BY insert_date DESC LIMIT 1)");
		return $hasil->result();
	}

	public function deleteOrder($id) {
		$this->db->trans_start();
		// $this->db->insert('pesanan_detail', $data);
		$this->db->query("
			DELETE FROM pesanan_detail WHERE id = '".$id."'");
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

	public function generateOrder($data){
		$this->db->trans_start();
		$this->db->insert('pesanan', $data);
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


	public function checkOutCash($id_pesanan){
		/*$this->db->trans_start();
		$array['data_stock'] = $this->db->query("SELECT id FROM pesanan_detail WHERE id_pesanan = '".$id_pesanan."'");
		foreach($array['data_stock']->result() as $row ):
			$this->db->query("
				UPDATE stock SET used_stok = used_stok + (SELECT kuantitas FROM pesanan_detail WHERE id = '".$row->id."') WHERE id = (SELECT id_stock FROM pesanan_detail WHERE id = '".$row->id."')");
		endforeach;
		$this->db->query("
			UPDATE pesanan SET total = (SELECT SUM((harga_stock * kuantitas)) as 'total_order_nof' FROM pesanan_detail WHERE id_pesanan = '".$id_pesanan."'), status = '1', is_approved = 1, tgl_pembayaran = SYSDATE(), transaction_id = CASE WHEN metode_pembayaran = '1' THEN CONCAT('OF-".date("y").date("m").date("d")."', id) ELSE CONCAT('ON-".date("y").date("m").date("d")."', id) END WHERE id = '".$id_pesanan."'");
		$this->db->trans_complete(); 

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} 
		else {
			$this->db->trans_commit();
			return TRUE;
		}*/

		$this->db->query("CALL PROCcheckOutOrder('OF', ".$id_pesanan.", '1', '',@p5,@p6)");
		// if ($this->db->query("SELECT @p5 AS 'OUTcd'") == '200') {}
		return TRUE;
	}

	public function checkOut($id_pesanan, $ketOrder, $metode_pembayaran){
		/*$this->db->trans_start();
		$this->db->query("
			UPDATE pesanan SET total = (SELECT SUM((harga_stock * kuantitas)) as 'total_order_nof' FROM pesanan_detail WHERE id_pesanan = '".$id_pesanan."'), status = '3', metode_pembayaran = '".$metode_pembayaran."', transaction_id = CASE WHEN metode_pembayaran = '1' THEN CONCAT('OF-".date("y").date("m").date("d")."', id) ELSE CONCAT('ON-".date("y").date("m").date("d")."', id) END WHERE id = '".$id_pesanan."'");
		$this->db->query("
			INSERT INTO order_job (id_pesanan, ket_order) VALUES ('".$id_pesanan."', '".$ketOrder."');");
		$this->db->trans_complete(); 

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} 
		else {
			$this->db->trans_commit();
			return TRUE;
		}*/
		$this->db->query("CALL PROCcheckOutOrder('ON', ".$id_pesanan.", ".$metode_pembayaran.", '".$ketOrder."', @p5, @p6)");
		// if ($this->db->query("SELECT @p5 AS 'OUTcd'") == '200') {}
		return TRUE;
	}

	public function checkAvailablityStock($id_pesanan, $param){
		$query = "SELECT * FROM (SELECT a.id, c.nama, CASE WHEN a.kuantitas > (b.jumlah_stok - b.used_stok) THEN '0' ELSE '1' END AS 'available' FROM pesanan_detail a JOIN stock b ON a.id_stock = b.id JOIN mst_produk c ON b.id_produk = c.id WHERE a.id_pesanan = '".$id_pesanan."') AS O WHERE available = '0'";
		if ($param == 'CEK') {
			return $this->db->query($query);
		} else {
			$hasil = $this->db->query($query);
			return $hasil->result();		
		}
	}

	public function paymentMethod(){
		$hasil = $this->db->query("SELECT id, jenis, acc_number, acc_name FROM mst_metode_pembayaran WHERE metode = '1' AND offline_visibility IS FALSE AND acc_number IS NOT NULL AND acc_name IS NOT NULL AND is_active IS TRUE");
		return $hasil;
	}

	public function getDetailPesanan($param, $id){
		if ($param == 'IDpesanan') {
			$condition = $id;
		} elseif ($param == 'transactionID') {
			$condition = "(SELECT id FROM pesanan WHERE transaction_id = '".$id."')";
		}
		$hasil = $this->db->query("SELECT a.id as 'id', a.id_pesanan as 'id_pesanan', a.id_produk, FORMAT(a.harga_stock, 'c') as 'harga_stock', a.kuantitas, FORMAT((a.harga_stock * a.kuantitas), 'c') as 'total_produk', b.nama as 'produk' FROM pesanan_detail a JOIN mst_produk b ON a.id_produk = b.id JOIN stock c ON a.id_stock = c.id WHERE a.id_pesanan = ".$condition);
		return $hasil->result();	
	}

	public function sumPesanan($param, $id) {
		if ($param == 'IDpesanan') {
			$condition = $id;
		} elseif ($param == 'transactionID') {
			$condition = "(SELECT id FROM pesanan WHERE transaction_id = '".$id."')";
		}
		$hasil = $this->db->query("SELECT CASE WHEN FORMAT(SUM((harga_stock * kuantitas)), 'c') IS NULL THEN 0 ELSE FORMAT(SUM((harga_stock * kuantitas)), 'c') END AS 'total_order', SUM((harga_stock * kuantitas)) as 'total_order_nof' FROM pesanan_detail WHERE id_pesanan = ".$condition);
		return $hasil->result();
	}

	public function getPesanan($id, $param = FALSE){
		if ($param == 'BACKEND') {
			$hasil = $this->db->query("SELECT a.id AS 'id_pesanan', a.transaction_id, c.jenis AS 'metode_pembayaran', c.acc_number, c.acc_name, c.bank, a.total, (SELECT detail FROM tb_status_pesanan WHERE id = a.status) AS 'status', a.status AS 'dstatus', DATE_FORMAT(a.tgl_pembayaran, '%d %M %Y') as 'tgl_pembayaran', DATE_FORMAT(a.tgl_pembayaran, '%Y-%d-%m') as 'dtgl_pembayaran', b.file, b.directory FROM pesanan a JOIN mst_metode_pembayaran c ON a.metode_pembayaran = c.id LEFT JOIN order_job b ON a.id = b.id_pesanan WHERE a.id = '".$id."'");
		} else if($param == 'transactionID') {
			$hasil = $this->db->query("SELECT a.id AS 'id_pesanan', a.transaction_id, c.jenis AS 'metode_pembayaran', c.acc_number, c.acc_name, c.bank, a.total, (SELECT detail FROM tb_status_pesanan WHERE id = a.status) AS 'status', a.status AS 'dstatus', DATE_FORMAT(a.tgl_pembayaran, '%d %M %Y') as 'tgl_pembayaran', DATE_FORMAT(a.tgl_pembayaran, '%Y-%d-%m') as 'dtgl_pembayaran', b.file, b.directory FROM pesanan a JOIN mst_metode_pembayaran c ON a.metode_pembayaran = c.id LEFT JOIN order_job b ON a.id = b.id_pesanan WHERE a.transaction_id = '".$id."'");
		} else if ($param == 'IDpesanan') {
			$hasil = $this->db->query("SELECT a.id AS 'id_pesanan', a.transaction_id, c.jenis AS 'metode_pembayaran', c.acc_number, c.acc_name, c.bank, a.total, (SELECT detail FROM tb_status_pesanan WHERE id = a.status) AS 'status', a.status AS 'dstatus', DATE_FORMAT(a.tgl_pembayaran, '%d %M %Y') as 'tgl_pembayaran', DATE_FORMAT(a.tgl_pembayaran, '%Y-%d-%m') as 'dtgl_pembayaran', b.file, b.directory FROM pesanan a JOIN mst_metode_pembayaran c ON a.metode_pembayaran = c.id LEFT JOIN order_job b ON a.id = b.id_pesanan WHERE a.id = '".$id."'");
		}
		return $hasil;
	}
}
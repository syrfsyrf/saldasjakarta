<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk extends CI_Model {

	public function GetProduk()
	{
		$hasil = $this->db->query("SELECT a.id as 'id_produk', a.nama as 'nama_produk', c.jenis as 'kategori', FORMAT(b.harga, 'c') as 'harga', concat('/',b.jenis_harga_detail) as 'jenis_harga_detail', DATE_FORMAT(b.tgl_expired, '%d %M %Y') as 'tgl_expired', b.jumlah_stok, (b.jumlah_stok - b.used_stok) as 'stok_tersedia', b.status,
			CASE
			WHEN b.tgl_expired < SYSDATE() THEN '<button class=\'btn btn-danger btn-icon-split\'><span class=\'text\'>Expired</span></button>'
			WHEN DATEDIFF(b.tgl_expired, SYSDATE()) <= 30 THEN '<button class=\'btn btn-warning btn-icon-split\'><span class=\'text\'>Hampir Expired</span></button>'
			ELSE DATE_FORMAT(b.tgl_expired, '%d %M %Y')
			END AS keterangan_exp,
			CASE
			WHEN (jumlah_stok - used_stok) <= 0 THEN '<button class=\'btn btn-danger btn-icon-split\'><span class=\'text\'>Stok Habis</span></button>'
			WHEN (jumlah_stok - used_stok) < (jumlah_stok * 0.25) THEN '<button class=\'btn btn-warning btn-icon-split\'><span class=\'text\'>Stok Hampir Habis</span></button>'
			ELSE (b.jumlah_stok - b.used_stok)
			END AS keterangan_stock

			FROM mst_produk a LEFT JOIN stock b ON a.id = b.id_produk JOIN mst_kategori c ON a.id_kategori = c.id WHERE b.status != '0'
			UNION
			SELECT a.id as 'id_produk', a.nama as 'nama_produk', c.jenis as 'kategori', FORMAT(b.harga, 'c') as 'harga', concat('/',b.jenis_harga_detail) as 'jenis_harga_detail', DATE_FORMAT(b.tgl_expired, '%d %M %Y') as 'tgl_expired', b.jumlah_stok, (b.jumlah_stok - b.used_stok) as 'stok_tersedia', b.status,
			CASE
			WHEN b.tgl_expired < SYSDATE() THEN '<button class=\'btn btn-danger btn-icon-split\'><span class=\'text\'>Expired</span></button>'
			WHEN DATEDIFF(b.tgl_expired, SYSDATE()) <= 30 THEN '<button class=\'btn btn-danger btn-icon-split\'><span class=\'text\'>Hampir Expired</span></button>'
			ELSE DATE_FORMAT(b.tgl_expired, '%d %M %Y')
			END AS keterangan_exp,
			CASE
			WHEN (jumlah_stok - used_stok) <= 0 THEN '<button class=\'btn btn-warning btn-icon-split\'><span class=\'text\'>Stok Habis</span></button>'
			WHEN (jumlah_stok - used_stok) < (jumlah_stok * 0.25) THEN '<button class=\'btn btn-warning btn-icon-split\'><span class=\'text\'>Stok Hampir Habis</span></button>'
			ELSE (b.jumlah_stok - b.used_stok)
			END AS keterangan_stock
			FROM mst_produk a LEFT JOIN stock b ON a.id = b.id_produk JOIN mst_kategori c ON a.id_kategori = c.id WHERE b.status IS NULL");
		return $hasil;
	}

	public function GetDetailProduk($param, $value)
	{
		if ($param == 'edit') {
			$condition = "";
			$hasil = $this->db->query("SELECT a.id as 'id_produk', a.nama as 'nama_produk', b.jenis as 'kategori', c.id as 'id_stock', a.deskripsi, (SELECT nama FROM mst_user WHERE id = a.created_by) as 'created_by', DATE_FORMAT(a.insert_date, '%d %M %Y') as 'insert_date', a.file, a.path, c.jumlah_stok as 'jumlah_stok', c.harga as 'harga', c.jenis_harga_detail as 'jenis_harga_detail', c.jenis_harga as 'jenis_harga', c.tgl_expired as 'tgl_expired', c.status as 'status' FROM mst_produk a JOIN mst_kategori b ON a.id_kategori = b.id LEFT JOIN stock c ON a.id = c.id_produk WHERE a.id = '".$value."' AND c.status = '1'");
		} elseif($param == 'stock_detail') {
			$condition = "";
			$hasil = $this->db->query("SELECT a.id as 'id_produk', a.nama as 'nama_produk', b.jenis as 'kategori', c.id as 'id_stock', a.deskripsi, (SELECT nama FROM mst_user WHERE id = a.created_by) as 'created_by', DATE_FORMAT(a.insert_date, '%d %M %Y') as 'insert_date', a.file, a.path, c.jumlah_stok as 'jumlah_stok', c.harga as 'harga', c.jenis_harga_detail as 'jenis_harga_detail', c.jenis_harga as 'jenis_harga', c.tgl_expired as 'tgl_expired', c.status as 'status', (SELECT jenis FROM mst_jenis_harga WHERE id = jenis_harga) as 'djenis_harga', (c.jumlah_stok - c.used_stok) AS 'sisa_stok' FROM mst_produk a JOIN mst_kategori b ON a.id_kategori = b.id LEFT JOIN stock c ON a.id = c.id_produk WHERE a.id = '".$value."' LIMIT 1");
		} elseif($param == 'stock_detail1') {
			$condition = "";
			$hasil = $this->db->query("SELECT a.id as 'id_produk', a.nama as 'nama_produk', b.jenis as 'kategori', c.id as 'id_stock', a.deskripsi, (SELECT nama FROM mst_user WHERE id = a.created_by) as 'created_by', DATE_FORMAT(a.insert_date, '%d %M %Y') as 'insert_date', a.file, a.path, c.jumlah_stok as 'jumlah_stok', c.harga as 'harga', c.jenis_harga_detail as 'jenis_harga_detail', c.jenis_harga as 'jenis_harga', c.tgl_expired as 'tgl_expired', c.status as 'status', (SELECT jenis FROM mst_jenis_harga WHERE id = jenis_harga) as 'djenis_harga', (c.jumlah_stok - c.used_stok) AS 'sisa_stok' FROM mst_produk a JOIN mst_kategori b ON a.id_kategori = b.id LEFT JOIN stock c ON a.id = c.id_produk WHERE a.id = '".$value."'");
		}
		return $hasil;
	}

	public function GetKategori()
	{
		$hasil = $this->db->query("SELECT id, jenis FROM mst_kategori WHERE is_active = '1'");
		return $hasil;
	}

	public function GetJenisHarga()
	{
		$hasil = $this->db->query("SELECT id, concat(jumlah, ' ', singkatan_berat) AS jenis_harga FROM mst_jenis_harga");
		return $hasil;
	}

	public function insertUpdateStock($param, $dataStock){
		if ($param == 'INSERT') {
			$this->db->trans_start();
			$this->db->query("
			UPDATE stock SET status = '0' WHERE id_produk = '".$dataStock['id_produk']."'");
			$this->db->insert('stock', $dataStock);
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}
		} elseif ($param == 'UPDATE') {
			/*$this->db->trans_start();
			$this->db->where('ID', $id_data['ID_TKI']);
			$this->db->update('MST_TKI', $dataTki);

			$this->db->where('ID', $id_data['ALAMAT_ID']);
			$this->db->update('ALAMAT', $dataAlamat);
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}*/
		} else {
			return FALSE;
		}
	}

	public function insertUpdateProduk($param, $dataProduk){
		if ($param == 'INSERT') {
			$this->db->trans_start();
			$this->db->insert('mst_produk', $dataProduk);
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}
		} elseif ($param == 'UPDATE') {
			/*$this->db->trans_start();
			$this->db->where('ID', $id_data['ID_TKI']);
			$this->db->update('MST_TKI', $dataTki);

			$this->db->where('ID', $id_data['ALAMAT_ID']);
			$this->db->update('ALAMAT', $dataAlamat);
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}*/
		} else {
			return FALSE;
		}
	}

	public function GetDetailProdukFront($value){
		$hasil = $this->db->query("SELECT a.id as 'id_produk', a.nama as 'nama_produk', b.jenis as 'kategori', c.id as 'id_stock', a.deskripsi, (SELECT nama FROM mst_user WHERE id = a.created_by) as 'created_by', a.insert_date as 'insert_date', a.file, a.path, c.jumlah_stok as 'jumlah_stok', c.harga as 'harga', FORMAT(c.harga, 'c') as 'dharga', c.jenis_harga_detail as 'jenis_harga_detail', c.jenis_harga as 'jenis_harga', c.tgl_expired as 'tgl_expired', c.status as 'status', (SELECT jenis FROM mst_jenis_harga WHERE id = jenis_harga) as 'djenis_harga', (c.jumlah_stok - c.used_stok) AS 'sisa_stok' FROM mst_produk a JOIN mst_kategori b ON a.id_kategori = b.id JOIN stock c ON a.id = c.id_produk WHERE c.status = '1' AND a.id = '".$value."'");
		return $hasil;		
	}

	public function getDetailStock($param, $value){
		if ($param == 'qty') {
			$condition = "";
			$hasil = $this->db->query("SELECT a.transaction_id, (SELECT jenis FROM mst_metode_pembayaran WHERE id = a.metode_pembayaran) AS 'metode_pembayaran', a.tgl_pembayaran, b.kuantitas, c.harga, FORMAT((b.harga_stock * b.kuantitas), 'c') as 'total_produk' FROM pesanan a JOIN pesanan_detail b ON a.id = b.id_pesanan JOIN stock c ON b.id_stock = c.id WHERE c.id = '".$value."' AND a.status = '1'");
		} elseif($param == 'stock') {
			$condition = "";
			$hasil = $this->db->query("SELECT a.id as 'id_produk', a.nama as 'nama_produk', b.jenis as 'kategori', c.id as 'id_stock', a.deskripsi, (SELECT nama FROM mst_user WHERE id = a.created_by) as 'created_by', DATE_FORMAT(a.insert_date, '%d %M %Y') as 'insert_date', a.file, a.path, c.jumlah_stok as 'jumlah_stok', c.harga as 'harga', c.jenis_harga_detail as 'jenis_harga_detail', c.jenis_harga as 'jenis_harga', c.tgl_expired as 'tgl_expired', c.status as 'status', (SELECT jenis FROM mst_jenis_harga WHERE id = jenis_harga) as 'djenis_harga', (c.jumlah_stok - c.used_stok) AS 'sisa_stok' FROM mst_produk a JOIN mst_kategori b ON a.id_kategori = b.id LEFT JOIN stock c ON a.id = c.id_produk WHERE c.id = '".$value."' LIMIT 1");
		} 

		return $hasil;
	}

}
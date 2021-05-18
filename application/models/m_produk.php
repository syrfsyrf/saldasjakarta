<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_produk extends CI_Model {

	public function GetProduk()
	{
		$hasil = $this->db->query("SELECT a.id as 'id_produk', a.nama as 'nama_produk', c.jenis as 'kategori', c.jenis, FORMAT(b.harga, 'c') as 'harga', concat('/',b.jenis_harga) as 'jenis_harga', DATE_FORMAT(b.tgl_expired, '%d %M %Y') as 'tgl_expired', b.jumlah_stok, b.status FROM mst_produk a LEFT JOIN stock b ON a.id = b.id_produk 
		JOIN mst_kategori c ON a.id_kategori = c.id");
		return $hasil;
	}

	public function GetDetailProduk($param)
	{
		$hasil = $this->db->query("SELECT a.id as 'id_produk', a.nama as 'nama_produk', b.jenis as 'jenis_kategori', c.id as 'id_stock', 
		(SELECT nama FROM mst_user WHERE id = a.created_by) as 'created_by', a.insert_date as 'insert_date',
		c.jumlah_stok as 'jumlah_stok', c.harga as 'harga', c.jenis_harga as 'jenis_harga', c.tgl_expired as 'tgl_expired', c.status as 'status'
		FROM mst_produk a JOIN mst_kategori b ON a.id_kategori = b.id LEFT JOIN stock c ON a.id = c.id_produk 
		WHERE a.id = '".$param."' AND c.status = '1'");
		return $hasil;
	}
}






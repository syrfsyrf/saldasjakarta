<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_user extends CI_Model {

	public function getDataUser($id_user) {
		$hasil = $this->db->query("SELECT a.nama, a.email, a.telp, b.jalan, b.rt, b.rw, b.kecamatan, b.kelurahan, b.kota, b.kd_pos, b.provinsi, b.desa FROM data_user a JOIN alamat b ON a.id_user = b.id_user WHERE a.id_user = '".$id_user."'");
		return $hasil->result();
	}
}
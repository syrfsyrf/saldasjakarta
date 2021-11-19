<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_Model {

	public function GetMenuParent()
	{
		$hasil = $this->db->query("SELECT id, nama_menu, url, is_parent, parent, menu, child, menu_text, icon FROM tb_menu WHERE role LIKE '%".$_SESSION['logged_in']['role']."%' AND is_parent = 'Y' ORDER BY urutan ASC");
		return $hasil;
	}

	public function GetMenuChild()
	{
		$hasil = $this->db->query("SELECT id as 'id2', nama_menu as 'nama_menu2', url as 'url2', is_parent as 'is_parent2', parent as 'parent2', menu as 'menu2', child as 'child', menu_text as 'menu_text', icon as 'icon2' FROM tb_menu WHERE role LIKE '%".$_SESSION['logged_in']['role']."%' AND is_parent IS NULL ORDER BY urutan ASC");
		return $hasil;
	}
}
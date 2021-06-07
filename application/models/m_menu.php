<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_menu extends CI_Model {

	public function GetMenuParent()
	{
		$hasil = $this->db->query("SELECT id, nama_menu, url, is_parent, parent, menu, child, menu_text, icon FROM tb_menu WHERE role LIKE '%".$_SESSION['logged_in']['role']."%' AND is_parent = 'Y' ORDER BY urutan ASC");
		return $hasil;
	}

	public function GetMenuChild()
	{
		$hasil = $this->db->query("SELECT id as 'ID2', nama_menu as 'NAMA_MENU2', url as 'URL2', is_parent as 'IS_PARENT2', parent as 'PARENT2', menu as 'MENU2', child as 'CHILD', menu_text as 'MENU_TEXT', icon as 'ICON2' FROM tb_menu WHERE role LIKE '%".$_SESSION['logged_in']['role']."%' AND is_parent IS NULL ORDER BY urutan ASC");
		return $hasil;
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_menu extends CI_Model {

	public function GetMenuParent()
	{
		$hasil = $this->db->query("SELECT ID, NAMA_MENU, URL, IS_PARENT, PARENT, MENU, CHILD, MENU_TEXT, ICON FROM TB_MENU WHERE ROLE LIKE '%".$_SESSION['logged_in']['role']."%' AND IS_PARENT = 'Y' ORDER BY URUTAN ASC");
		return $hasil;
	}

	public function GetMenuChild()
	{
		$hasil = $this->db->query("SELECT ID as 'ID2', NAMA_MENU as 'NAMA_MENU2', URL as 'URL2', IS_PARENT as 'IS_PARENT2', PARENT as 'PARENT2', MENU as 'MENU2', CHILD as 'CHILD', MENU_TEXT as 'MENU_TEXT', ICON as 'ICON2' FROM TB_MENU WHERE ROLE LIKE '%".$_SESSION['logged_in']['role']."%' AND IS_PARENT IS NULL ORDER BY URUTAN ASC");
		return $hasil;
	}
}
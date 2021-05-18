<?php

class m_login extends CI_model{

    public function check_user($user){
        return $this->db->get_where('mst_user', $user);
    }

    public function get_user_info($username){
    $this->db->select('id, username, nama, password, role, status, aktivasi,');
    $this->db->where('username', $username);
    return $this->db->get('mst_user');
    }
}
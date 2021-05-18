<?php

class m_log extends CI_model{

    public function insert_log($data){
        $query = $this->db->insert('log', $data);
        return $query;
    }
}
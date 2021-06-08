<?php

class m_log extends CI_model{

    public function insert_log($data){
    	$this->load->library('user_agent');
    	$data['ip'] = $this->input->ip_address();
    	$data['browser'] = $this->agent->browser();
    	$data['version'] = $this->agent->version();
    	$data['platform'] = $this->agent->platform();

        $query = $this->db->insert('log', $data);
        return $query;
    }

    public function getLogSummary($param = FALSE) {
    	$hasil = $this->db->query("SELECT (SELECT jenis FROM mst_log WHERE id = a.jenis) AS 'jenis', a.aksi, a.status, a.catatan, CONCAT(a.ip, ' ', a.browser, ' ', a.version, ' ', a.platform, 'catatan') AS 'info', (SELECT nama FROM mst_user WHERE id = a.id_user) AS 'user_info', a.insert_date FROM log a ORDER BY a.insert_date DESC LIMIT 50");
		return $hasil;
    }
}
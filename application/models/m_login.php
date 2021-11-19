<?php

class M_login extends CI_model{

    public function check_user($user){
        return $this->db->get_where('mst_user', $user);
    }

    public function get_user_info($username){
	    $this->db->select('id, username, nama, password, role, status, aktivasi,');
	    $this->db->where('username', $username);
	    return $this->db->get('mst_user');
    }

    public function register($username, $data_diri, $data_alamat) {
		$cek = $this->db->query("SELECT * FROM mst_user WHERE username = '".$username."'")->num_rows();
		if ($cek > 0) {
			return FALSE;
		} else {
			$this->db->trans_start();
			$this->db->query("INSERT INTO mst_user (username, nama, role) VALUES ('".$username."', '".$data_diri['nama']."', '5')");
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				$this->db->trans_start();
				$this->db->query("
				INSERT INTO data_user 
				(id_user, nama, email, telp)
				SELECT
				    (SELECT id FROM mst_user WHERE username = '".$username."') AS id_user,
				    '".$data_diri['nama']."' AS nama,
				    '".$data_diri['email']."' AS email,
				    '".$data_diri['telp']."' AS telp
				FROM DUAL");

				$this->db->query("
				INSERT INTO alamat 
				(id_user, jalan, rt, rw, kecamatan, kelurahan, kota, kd_pos, provinsi, desa)
				SELECT
				    (SELECT id FROM mst_user WHERE username = '".$username."') AS id_user,
				    '".$data_alamat['jalan']."' AS jalan,
				    '".$data_alamat['rt']."' AS rt,
				    '".$data_alamat['rw']."' AS rw,
				    '".$data_alamat['kecamatan']."' AS kecamatan,
				    '".$data_alamat['kelurahan']."' AS kelurahan,
				    '".$data_alamat['kota']."' AS kota,
				    '".$data_alamat['kd_pos']."' AS kd_pos,
				    '".$data_alamat['provinsi']."' AS provinsi,
				    '".$data_alamat['desa']."' AS desa
				FROM DUAL");

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
		}
    }

    public function reset_password($id, $data){
		$query = $this->db->where('id', $id)
		->set($data)
		->update('mst_user');
		return $query;
	}
}
<?php

class Login extends CI_Controller{

    public function __construct(){
        parent::__construct();

        $this->load->model('m_login');
        $this->load->model('m_log');

    }

    public function index() {
        if(isset($_SESSION['logged_in']['username'])){
            if ($_SESSION['logged_in']['login'] == 'LOGGED' && $_SESSION['logged_in']['aktivasi'] == '0') {
                // redirect('Login/aktivasi');
            } elseif ($_SESSION['logged_in']['login'] == 'LOGGED' && $_SESSION['logged_in']['aktivasi'] == '1') {
                redirect(base_url('Dashboard'));
            }
        } else {
            $this->load->view('login');
        }
    }

    public function do_login()
    {
        $username = $this->input->post('username');
        $data = array(
            'username' => $username,
            'password' => md5($this->input->post('password')));

        $cek = $this->m_login->check_user($data)->num_rows();

        if ($cek > 0) {
            $pengguna = $this->m_login->get_user_info($username);
            $row1 = $pengguna->row_array();

            if ($row1['status'] == '0') {
                $this->session->set_flashdata('login_failed', '<div class="alert alert-warning alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <i class="icon fas fa-ban"></i> Akun tidak aktif, kontak administrator untuk mengaktifkan akun
                 </div>');
				// redirect('Login');
                echo "ga aktip";
            } else {
                $data_session = array(
                    'id_user' => $row1['id'],
                    'username' => $row1['username'],
                    'nama' => $row1['nama'],
                    'role' => $row1['role'],
                    'aktivasi' => $row1['aktivasi'],
                    'login' => 'LOGGED');
                $this->session->set_userdata('logged_in', $data_session);
                $data_log = array(
                 'id_user' => $_SESSION['logged_in']['id_user'],
                 'jenis' => '1',
                 'catatan' => 'sukses');
                $this->m_log->insert_log($data_log);
                if ($row1['aktivasi'] == '1') {
                 
                 if ($_SESSION['logged_in']['id_user'] == '5') {
                    redirect();
                } else {
                    redirect('Dashboard');
                }
             } else {
                redirect('Login/aktivasi');
            }
        }
    } else
    {
       $this->session->set_flashdata('login_failed', '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-ban"></i> Username atau Password salah
        </div>');
			// redirect('Login');
       echo "salah passadaszxword";

   }
}

public function aktivasi($param = FALSE){
    if(!isset($_SESSION['logged_in']['username'])){
        redirect('Login');
    } elseif ($_SESSION['logged_in']['aktivasi'] == '1') {
        redirect();
    } else {
        $this->load->view('login/v_aktivasi');
    }
}

public function do_reset(){
    $id_user = $_SESSION['logged_in']['id_user'];
    $password1 = md5($this->input->post('resetpass'));
    $password2 = md5($this->input->post('resetpass2'));
    if ($password1 == $password2) {
        $_SESSION['logged_in']['aktivasi'] = '1';
        $data = array(
            'PASSWORD' => $password2,
            'AKTIVASI' => '1');
        $result = $this->Login_model->reset_password($id_user, $data);
        if ($result == TRUE) {
            $this->session->set_flashdata('dashboard', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-check"></i> Sukses reset password
                </div>');
            $data_log = array(
                'id_user' => $id_user,
                'jenis' => '4',
                'aksi' => 'UPDATE',
                'catatan' => 'sukses');
            $this->Log_model->insert_log($data_log);
            redirect();
        } else {
            $this->session->set_flashdata('dashboard', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-ban"></i> Gagal reset password
                </div>');
            $data_log = array(
                'id_user' => $id_user,
                'jenis' => '4',
                'CATATAN' => 'GAGAL');
            $this->Log_model->insert_log($data_log);
            redirect();
        }
    } else {
        $this->session->set_flashdata('login_failed', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fas fa-ban"></i> Password tidak sama, silahkan ulangi lagi
            </div>');
        redirect('Login/aktivasi');
    }
}

public function logout(){
    $this->session->sess_destroy();
    redirect(base_url('Login'));
}

}
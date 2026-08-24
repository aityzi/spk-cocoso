<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model/database untuk table login
        $this->load->model('autentifikasi_model');
    }

    public function index()
    {
        $this->session->sess_destroy();
        $this->load->view('login/V_index');
    }

    public function auth_login()
    {
        // Validasi setiap inputan pada form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi error maka kembali kehalaman login
            return redirect(site_url('login'));
        } else {
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));

            // Definisikan Array untuk menampung nilai pada form
            $arrayData = [
                'Username' => $username,
                'Password' => md5($password)
            ];

            $SQL = $this->autentifikasi_model->validasi_login($arrayData)->num_rows();
            if ($SQL > 0) {
                // Jika username dan password ditemukan alihkan ke halaman dashboard
                $user = $this->autentifikasi_model->validasi_login($arrayData)->result();
                foreach ($user as $user_session) {
                }

                // Definisikan Array untuk menampung nilai session
                $array_session = [
                    'IDUser' => $user_session->KodeAkun,
                    'Username' => $user_session->Username,
                ];

                $this->session->set_userdata($array_session);
                return redirect(site_url('dashboard'));
            } else {
                // Jika tidak ditemukan maka kembali kehalaman login
                $this->session->set_flashdata('error', 'Login Gagal Username Atau Password Salah !');
                return redirect(site_url('login'));
            }
        }
    }

    public function auth_logout()
    {
        // Hancurkan session dan keluar dari sistem
        $this->session->sess_destroy();
        return redirect(site_url('login'));
    }
}

/* End of file Login.php and path \application\controllers\Login.php */

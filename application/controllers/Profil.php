<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model/database untuk table login
        $this->load->model('autentifikasi_model');
    }

    public function perbarui()
    {
        // Validasi setiap inputan pada form
        $this->form_validation->set_rules('Username', 'Username', 'required');
        $this->form_validation->set_rules('Password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi error maka kembali kehalaman profil
            $this->session->set_flashdata('error', 'Perhatikan nilai pengisian form anda !');
            return redirect(site_url('dashboard/profil'));
        } else {
            // Definisikan Array untuk menampung nilai pada form
            $arrayData = [
                'Username' => $this->security->xss_clean($this->input->post('Username')),
                'Password' => md5($this->security->xss_clean($this->input->post('Password')))
            ];

            $primaryKey = [
                'KodeAkun' => $this->session->userdata('IDUser')
            ];
            // Simpan pembaharuan username dan password
            $SQL = $this->autentifikasi_model->perbarui_profil($arrayData, $primaryKey);
            if ($SQL) {
                // Jika profil berhasil disimpan keluar sistem dan kehalaman login
                $this->session->set_flashdata('error', 'Username dan password telah diperbarui ');
                return redirect(site_url('login'));
            } else {
                // Jika validasi error maka kembali kehalaman profil
                $this->session->set_flashdata('error', 'Perhatikan nilai pengisian form anda !');
                return redirect(site_url('dashboard/profil'));
            }
        }
    }
}

/* End of file Profil.php and path \application\controllers\Profil.php */

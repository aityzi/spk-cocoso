<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* Helper untuk autentifikasi sistem
   Author   : Sarah Yuliah Hulwah
   Kelas    : 8SIC1 Sistem Informasi STMIK Triguna Dharma
*/

if (!function_exists('auth_user')) {

    function auth_user()
    {
        $CI = &get_instance();
        $CI->load->library('session');

        if ($CI->session->userdata('IDUser') == '') {
            // Jika tidak terdapat session maka kembali kehalaman login
            $CI->session->set_flashdata('error', 'Login terlebih dahulu !');
            return redirect(site_url('login'));
        }

    }
}

/* End of file auth_helper.php and path \application\helpers\auth_helper.php */

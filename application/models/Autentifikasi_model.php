<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autentifikasi_model extends CI_Model
{
    public function validasi_login($data = null)
    {
        // Query untuk mencari username dan password pada tabel login
        $query = $this->db->get_where('tbl_login', $data);
        return $query;
    }

    public function perbarui_profil($data = null, $primaryKey = null)
    {
        // Query untuk memperbarui username dan password pada tabel login
        $query = $this->db->update('tbl_login', $data, $primaryKey);
        return $query;
    }

}


/* End of file Autentifikasi_model.php and path \application\models\Autentifikasi_model.php */

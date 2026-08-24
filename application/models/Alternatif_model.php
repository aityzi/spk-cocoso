<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif_model extends CI_Model
{
    public function alternatif()
    {
        // Query untuk menampilkan alternatif
        $this->db->order_by('Tanggal', 'DESC');
        $query = $this->db->get('tbl_alternatif')->result();
        return $query;
    }

    public function alternatif_order_kode()
    {
        // Query untuk menampilkan alternatif dengan order kode alternatif
        $this->db->order_by('KodeAlternatif', 'ASC');
        $query = $this->db->get('tbl_alternatif')->result();
        return $query;
    }

    public function get_alternatif($primaryKey = null)
    {
        // Query untuk mencari alternatif berdasarkan kata kunci
        $query = $this->db->get_where('tbl_alternatif', $primaryKey);
        return $query;
    }

    public function countAlternatif()
    {
        // Query untuk menghitung jumlah alternatif
        $query = $this->db->count_all('tbl_alternatif');
        return $query;
    }

    public function max_alternatif($primaryKey = null)
    {
        // Query untuk mencari nilai maximum alternatif
        $this->db->select_max($primaryKey);
        $query = $this->db->get('tbl_alternatif');
        return $query;
    }

    public function min_alternatif($primaryKey = null)
    {
        // Query untuk mencari nilai minimum alternatif
        $this->db->select_min($primaryKey);
        $query = $this->db->get('tbl_alternatif');
        return $query;
    }

    public function simpan_alternatif($data = null)
    {
        // Query untuk menyimpan alternatif
        $query = $this->db->insert('tbl_alternatif', $data);
        return $query;
    }

    public function perbarui_alternatif($data = null, $primaryKey = null)
    {
        // Query untuk memperbarui alternatif berdasarkan kata kunci
        $query = $this->db->update('tbl_alternatif', $data, $primaryKey);
        return $query;
    }

    public function hapus_alternatif($primaryKey = null)
    {
        // Query untuk menghapus alternatif berdasarkan kata kunci
        $query = $this->db->delete('tbl_alternatif', $primaryKey);
        return $query;
    }

}

/* End of file Alternatif_model.php and path \application\models\Alternatif_model.php */

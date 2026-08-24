<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria_model extends CI_Model
{
    public function kriteria()
    {
        // Query untuk menampilkan kriteria
        $this->db->order_by('KodeKriteria', 'ASC');
        $query = $this->db->get('tbl_kriteria')->result();
        return $query;
    }

    public function get_kriteria($primaryKey = null)
    {
        // Query untuk menampilkan kriteria berdasarkan kata kunci
        // $this->db->from('tbl_kriteria');
        // $this->db->where($primaryKey);
        // $query = $this->db->get();
        // return $query;
        $query = $this->db->get_where('tbl_kriteria', $primaryKey)->result();
        return $query;
    }

    public function get_kriteriaUpdate($primaryKey = null)
    {
        // Query untuk menampilkan kriteria berdasarkan kata kunci
        $this->db->from('tbl_kriteria');
        $this->db->where($primaryKey);
        $query = $this->db->get();
        return $query;
        // $query = $this->db->get_where('tbl_kriteria', $primaryKey)->result();
        // return $query;
    }

    public function countKriteria()
    {
        // Query untuk menghitung jumlah kriteria
        $query = $this->db->count_all('tbl_kriteria');
        return $query;
    }

    public function simpan_kriteria($data = null)
    {
        // Query untuk menyimpan kriteria
        $query = $this->db->insert('tbl_kriteria', $data);
        return $query;
    }

    public function hapus_kriteria($primaryKey = null)
    {
        // Query untuk menghapus kriteria
        $query = $this->db->delete('tbl_kriteria', $primaryKey);
        return $query;
    }
}

/* End of file Kriteria_model.php and path \application\models\Kriteria_model.php */

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subkriteria_model extends CI_Model
{
    public function sub_kriteria()
    {
        // Query untuk menampilkan sub kriteria yang berelasi ke table kriteria
        $this->db->group_by('tbl_sub_kriteria.KodeKriteria');
        $this->db->select('tbl_sub_kriteria.KodeKriteria,tbl_kriteria.NamaKriteria');
        $this->db->from('tbl_sub_kriteria');
        $this->db->join('tbl_kriteria', 'tbl_kriteria.KodeKriteria=tbl_sub_kriteria.KodeKriteria', 'left');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_sub_kriteria($primaryKey = null)
    {
        // Query untuk menampilkan data sub kriteria yang berelasi ke table kriteria berdasarkan kata kunci
        $this->db->order_by('tbl_sub_kriteria.Nilai', 'ASC');
        $this->db->select('tbl_sub_kriteria.*,tbl_kriteria.NamaKriteria');
        $this->db->from('tbl_sub_kriteria');
        $this->db->join('tbl_kriteria', 'tbl_kriteria.KodeKriteria=tbl_sub_kriteria.KodeKriteria', 'left');
        $this->db->where($primaryKey);
        $query = $this->db->get();
        return $query;
    }

    public function simpan_sub_kriteria($data = null)
    {
        // Query untuk menyimpan sub kriteria
        $query = $this->db->insert('tbl_sub_kriteria', $data);
        return $query;
    }

    public function perbarui_sub_kriteria($data = null, $primaryKey = null)
    {
        // Query untuk memperbarui sub kriteria
        $query = $this->db->update('tbl_sub_kriteria', $data, $primaryKey);
        return $query;
    }

    public function hapus_sub_kriteria($primaryKey = null)
    {
        // Query untuk menghapus sub kriteria
        $query = $this->db->delete('tbl_sub_kriteria', $primaryKey);
        return $query;
    }
}

/* End of file Subkriteria_model.php and path \application\models\Subkriteria_model.php */

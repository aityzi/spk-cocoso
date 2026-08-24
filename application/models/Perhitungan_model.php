<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan_model extends CI_Model
{
    public function perhitungan()
    {
        // Query untuk menampilkan perhitungan cocoso
        $this->db->order_by('Tanggal', 'DESC');
        $this->db->group_by('Tanggal');
        $query = $this->db->get('tbl_proses_cocoso')->result();
        return $query;
    }

    public function get_perhitungan($primaryKey = null)
    {
        // Query untuk mencari perhitungan yang berelasi pada alternatif pada database
        $this->db->order_by('Rangking', 'ASC');
        $this->db->select('tbl_proses_cocoso.*, tbl_alternatif.NamaAlternatif');
        $this->db->from('tbl_proses_cocoso');
        $this->db->join('tbl_alternatif', 'tbl_proses_cocoso.KodeAlternatif=tbl_alternatif.KodeAlternatif', 'left');
        $this->db->where($primaryKey);
        $query = $this->db->get();
        return $query;
    }

    public function countPerhitungan()
    {
        // Query untuk menghitung jumlah perhitungan
        $query = $this->db->count_all('tbl_proses_cocoso');
        return $query;
    }

    public function simpan_perhitungan($data = null)
    {
        // Query untuk menyimpan perhitungan cocoso pada database
        $query = $this->db->insert_batch('tbl_proses_cocoso', $data);
        return $query;
    }

    public function hapus_perhitungan($primaryKey = null)
    {
        // Query untuk menghapus perhitungan cocoso pada database
        $query = $this->db->delete('tbl_proses_cocoso', $primaryKey);
        return $query;
    }

    public function cetak_perhitungan($primaryKey = null)
    {
        // Query untuk menampilkan data yang akan dicetak berdasarkan tanggal
        $query = $this->db->get_where('tbl_proses_cocoso', $primaryKey)->result();
        return $query;
    }

}

/* End of file Perhitungan_model.php and path \application\models\Perhitungan_model.php */

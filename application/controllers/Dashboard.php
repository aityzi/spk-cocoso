<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model/database untuk table kriteria
        $this->load->model('kriteria_model');

        // Load mode/database untuk table sub kriteria
        $this->load->model('subkriteria_model');

        // Load model/database untuk table alternatif
        $this->load->model('alternatif_model');

        // Load model/database untuk table perhitungan/proses cocoso
        $this->load->model('perhitungan_model');

        // Middleware/jembatan untuk autentifikasi
        auth_user();
    }

    public function index()
    {
        $data = [
            'c_kriteria' => $this->kriteria_model->countKriteria(),
            'c_alternatif' => $this->alternatif_model->countAlternatif(),
            'c_perhitungan' => $this->perhitungan_model->countPerhitungan(),
            'content' => 'dashboard/V_home',
            'title' => 'Sistem Pendukung Keputusan Optimalisasi Cabang UP Parfum dengan Menggunakan Metode Combined Compromise Solution (CoCoSo)'
        ];
        return $this->load->view('dashboard/V_index', $data);
    }

    public function kriteria()
    {
        $data = [
            'kriteria' => $this->kriteria_model->kriteria(),
            'countKriteria' => $this->kriteria_model->countKriteria(),
            'content' => 'dashboard/kriteria/V_kriteria',
            'title' => 'Manajemen Kriteria'
        ];

        return $this->load->view('dashboard/V_index', $data);
    }
    public function sub_kriteria()
    {
        $data = [
            'subKriteria' => $this->subkriteria_model->sub_kriteria(),
            'content' => 'dashboard/kriteria/V_sub_kriteria',
            'title' => 'Manajemen Sub Kriteria'
        ];

        return $this->load->view('dashboard/V_index', $data);
    }

    public function alternatif()
    {
        $data = [
            'alternatif' => $this->alternatif_model->alternatif(),
            'content' => 'dashboard/alternatif/V_alternatif',
            'title' => 'Manajemen Alternatif'
        ];
        return $this->load->view('dashboard/V_index', $data);
    }

    public function perhitungan()
    {
        $data = [
            'perhitungan' => $this->perhitungan_model->perhitungan(),
            'content' => 'dashboard/perhitungan/V_perhitungan',
            'title' => 'Manajemen Perhitungan'
        ];
        return $this->load->view('dashboard/V_index', $data);
    }

    public function profil()
    {
        $data = [
            'content' => 'dashboard/profil/V_profil',
            'title' => 'Perbarui Profil'
        ];
        return $this->load->view('dashboard/V_index', $data);
    }
}

/* End of file Dashboard.php and path \application\controllers\Dashboard.php */

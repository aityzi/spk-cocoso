<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model/database untuk table kriteria
        $this->load->model('kriteria_model');

        // Load mode/database untuk table sub kriteria
        $this->load->model('subkriteria_model');

        // Load mode/database untuk table alternatif
        $this->load->model('alternatif_model');

        // Load mode/database untuk table perhitungan
        $this->load->model('perhitungan_model');

        // Middleware/jembatan untuk autentifikasi
        auth_user();
    }

    public function proses()
    {
        // Validasi setiap inputan pada form
        $this->form_validation->set_rules('Tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi error maka kembali kehalaman perhitungan
            $this->session->set_flashdata('error', 'Perhatikan nilai pengisian form anda !');
            return redirect(site_url('dashboard/perhitungan'));
        } else {
            // Ubah konversi tanggal pada form menjadi tanggal pada database mysql
            $form_date = $this->input->post('Tanggal');
            $split_date = explode('/', $form_date);
            $merge_date = array($split_date[2], $split_date[0], $split_date[1]);
            $konversi_date = implode('-', $merge_date);
            $primaryKey = [
                'Tanggal' => $konversi_date
            ];

            // Cari data alternatif berdasarkan tanggal pada form
            $SQL = $this->alternatif_model->get_alternatif($primaryKey)->num_rows();
            if ($SQL > 0) {
                // Definisikan array untuk menampung nilai yang ditampilkan pada konten
                $data = [
                    'content' => 'dashboard/perhitungan/V_form_perhitungan',
                    'title' => 'Proses Perhitungan',
                    'title_form' => 'Proses Perhitungan',
                    'tanggal' => $this->input->post('Tanggal'),
                    'kriteria' => $this->kriteria_model->kriteria(),
                    'm_keputusan' => $this->alternatif_model->alternatif_order_kode(),
                    'n_matrik' => normalisasi_matrik($konversi_date),
                    'n_si' => nilai_si($konversi_date),
                    'n_pi' => nilai_pi($konversi_date),
                    'n_kia_kib_kic' => nilai_kia_kib_kic($konversi_date),
                    'n_ki' => nilai_ki($konversi_date)
                ];
                return $this->load->view('dashboard/V_index', $data);
            } else {
                // Jika data alternatif tidak ditemukan berdasarkan tanggal maka kembali kehalaman perhitungan
                $this->session->set_flashdata('error', 'Data alternatif tidak ditemukan pada tanggal tersebut !');
                return redirect(site_url('dashboard/perhitungan'));
            }
        }
    }

    public function detil_perhitungan($key = null)
    {
        // Definisikan array untuk menampung nilai yang ditampilkan pada konten
        $primaryKey = [
            'tbl_proses_cocoso.Tanggal' => $key
        ];

        $data = [
            'content' => 'dashboard/perhitungan/V_detil_perhitungan',
            'title' => 'Detil Perhitungan',
            'title_form' => 'Detil Perhitungan',
            'perhitungan' => $this->perhitungan_model->get_perhitungan($primaryKey)->result()
        ];
        return $this->load->view('dashboard/V_index', $data);
    }

    public function simpan_perhitungan()
    {
        // Validasi setiap inputan pada form
        $this->form_validation->set_rules('Tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi error maka kembali kehalaman perhitungan
            $this->session->set_flashdata('error', 'Kesalahan tanggal pada form anda !');
            return redirect(site_url('dashboard/perhitungan'));
        } else {
            // Ubah konversi tanggal pada form menjadi tanggal pada database mysql
            $form_date = $this->input->post('Tanggal');
            $split_date = explode('/', $form_date);
            $merge_date = array($split_date[2], $split_date[0], $split_date[1]);
            $konversi_date = implode('-', $merge_date);
            $primaryKey = [
                'tbl_proses_cocoso.Tanggal' => $konversi_date
            ];

            // Cari data perhitungan yang tersedia pada database
            $SQL = $this->perhitungan_model->get_perhitungan($primaryKey)->num_rows();
            if ($SQL > 0) {
                // Jika data perhitungan sudah ada maka kembali kehalaman perhitungan denga pesan data sudah ada
                $this->session->set_flashdata('error', 'Data sudah ada disimpan !');
                return redirect(site_url('dashboard/perhitungan'));
            } else {
                // Definisikan array untuk menampung hasil perhitungan nilai kia,kib,kic dan ki
                $arrayData = [];
                $nilaiKi = nilai_ki($konversi_date);
                foreach ($nilaiKi['KodeAlternatif'] as $key => $value) {
                    $arrayData[] = [
                        'KodePerhitungan' => 'P' . rand(1, 999) . rand(1, 99),
                        'Tanggal' => date('Y-m-d'),
                        'KodeAlternatif' => $nilaiKi['KodeAlternatif'][$key],
                        'Kia' => $nilaiKi['Kia'][$key],
                        'Kib' => $nilaiKi['Kib'][$key],
                        'Kic' => $nilaiKi['Kic'][$key],
                        'Ki' => $nilaiKi['Ki'][$key],
                        'Rangking' => $nilaiKi['RangkingKi'][$key],
                    ];
                }
                // Simpan data perhitungan pada database
                $SQL = $this->perhitungan_model->simpan_perhitungan($arrayData);
                if ($SQL) {
                    // Jika perhitungan berhasil disimpan kembali kehalaman perhitungan dengan pesan berhasil
                    $this->session->set_flashdata('pesan', 'Data Perhitungan berhasil disimpan !');
                    return redirect(site_url('dashboard/perhitungan'));
                } else {
                    // Jika perhitungan gagal disimpan kembali kehalaman perhitungan dengan pesan gagal
                    $this->session->set_flashdata('error', 'Data Perhitungan gagal disimpan !');
                    return redirect(site_url('dashboard/perhitungan'));
                }
            }
        }
    }

    public function hapus_perhitungan($key = null)
    {
        // Definisikan array berisi primary key untuk menghapus perhitungan
        $primaryKey = [
            'Tanggal' => $key
        ];
        $SQL = $this->perhitungan_model->hapus_perhitungan($primaryKey);
        if ($SQL) {
            // Jika perhitungan berhasil dihapus kembali kehalaman perhitungan dengan pesan berhasil
            $this->session->set_flashdata('pesan', 'Data Perhitungan berhasil dihapus !');
            return redirect(site_url('dashboard/perhitungan'));
        } else {
            // Jika perhitungan gagal dihapus kembali kehalaman perhitungan dengan pesan gagal
            $this->session->set_flashdata('error', 'Data Perhitungan gagal dihapus !');
            return redirect(site_url('dashboard/perhitungan'));
        }
    }

    public function cetak_perhitungan($key = null)
    {
        $primaryKey = [
            'tbl_proses_cocoso.Tanggal' => $key
        ];

        $data = [
            'title' => 'Laporan Perhitungan',
            'perhitungan' => $this->perhitungan_model->get_perhitungan($primaryKey)->result()
        ];

        return $this->load->view('dashboard/perhitungan/V_cetak_perhitungan', $data);
    }
}

/* End of file Perhitungan.php and path \application\controllers\Perhitungan.php */

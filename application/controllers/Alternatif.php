<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
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

        // Load mode/database untuk table perhitungan
        $this->load->model('perhitungan_model');

        // Middleware/jembatan untuk autentifikasi
        auth_user();
    }

    public function form_alternatif($param = null, $key = null)
    {
        if ($param == 'add') {
            error_reporting(0);
            // Definisikan array untuk menampung nilai yang ditampilkan pada konten
            $arraySubKriteria = [];
            $kriteria = $this->kriteria_model->kriteria();
            foreach ($kriteria as $itemKriteria) {
                $arraySubKriteria[] = $itemKriteria->KodeKriteria;
            }
            $data = [
                'content' => 'dashboard/alternatif/V_form_alternatif',
                'title' => 'Tambah Alternatif',
                'title_form' => 'Tambah Alternatif',
                'form' => 'Simpan',
                'alternatif' => '',
                'subKriteria1' => $this->subkriteria_model->get_sub_kriteria(array('tbl_sub_kriteria.KodeKriteria' => $arraySubKriteria[0]))->result(),
                'subKriteria2' => $this->subkriteria_model->get_sub_kriteria(array('tbl_sub_kriteria.KodeKriteria' => $arraySubKriteria[1]))->result(),
                'subKriteria3' => $this->subkriteria_model->get_sub_kriteria(array('tbl_sub_kriteria.KodeKriteria' => $arraySubKriteria[2]))->result(),
                'subKriteria4' => $this->subkriteria_model->get_sub_kriteria(array('tbl_sub_kriteria.KodeKriteria' => $arraySubKriteria[3]))->result(),
                'subKriteria5' => $this->subkriteria_model->get_sub_kriteria(array('tbl_sub_kriteria.KodeKriteria' => $arraySubKriteria[4]))->result()
            ];

            return $this->load->view('dashboard/V_index', $data);
        } elseif ($param == 'update') {
            // Definisikan array untuk menampung nilai yang ditampilkan pada konten
            $primaryKey = [
                'KodeAlternatif' => $key
            ];
            // Definisikan array untuk menampung nilai yang ditampilkan pada konten
            $arraySubKriteria = [];
            $kriteria = $this->kriteria_model->kriteria();
            foreach ($kriteria as $itemKriteria) {
                $arraySubKriteria[] = $itemKriteria->KodeKriteria;
            }
            $data = [
                'content' => 'dashboard/alternatif/V_form_alternatif',
                'title' => 'Perbarui Alternatif',
                'title_form' => 'Perbarui Alternatif',
                'form' => 'Perbarui',
                'alternatif' => $this->alternatif_model->get_alternatif($primaryKey)->result(),
                'subKriteria1' => $this->subkriteria_model->get_sub_kriteria(array('tbl_sub_kriteria.KodeKriteria' => $arraySubKriteria[0]))->result(),
                'subKriteria2' => $this->subkriteria_model->get_sub_kriteria(array('tbl_sub_kriteria.KodeKriteria' => $arraySubKriteria[1]))->result(),
                'subKriteria3' => $this->subkriteria_model->get_sub_kriteria(array('tbl_sub_kriteria.KodeKriteria' => $arraySubKriteria[2]))->result(),
                'subKriteria4' => $this->subkriteria_model->get_sub_kriteria(array('tbl_sub_kriteria.KodeKriteria' => $arraySubKriteria[3]))->result(),
                'subKriteria5' => $this->subkriteria_model->get_sub_kriteria(array('tbl_sub_kriteria.KodeKriteria' => $arraySubKriteria[4]))->result()
            ];
            $this->load->view('dashboard/V_index', $data);
        } else {
            // Jika parameter form tidak ditemukan maka kembali kehalaman alternatif dengan pesan error form parameter
            $this->session->set_flashdata('error', 'Form parameter tidak valid !');
            return redirect(site_url('dashboard/alternatif'));
        }
    }

    public function simpan_alternatif()
    {
        if ($this->input->post('FormParameter') == 'Simpan') {
            // Validasi setiap inputan pada form
            $this->form_validation->set_rules('Tanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('KodeAlternatif', 'Kode Alternatif', 'required|max_length[12]');
            $this->form_validation->set_rules('NamaAlternatif', 'Nama Alternatif', 'required');
            $this->form_validation->set_rules('SubKriteria1', 'Kriteria 1', 'required');
            $this->form_validation->set_rules('SubKriteria2', 'Kriteria 2', 'required');
            $this->form_validation->set_rules('SubKriteria3', 'Kriteria 3', 'required');
            $this->form_validation->set_rules('SubKriteria4', 'Kriteria 4', 'required');
            $this->form_validation->set_rules('SubKriteria5', 'Kriteria 5', 'required');

            if ($this->form_validation->run() == FALSE) {
                // Jika validasi error maka kembali kehalaman alternatif
                $this->session->set_flashdata('error', 'Perhatikan nilai pengisian form anda !');
                return redirect(site_url('dashboard/alternatif'));
            } else {
                // Ubah konversi tanggal pada form menjadi tanggal pada database mysql
                $form_date = $this->input->post('Tanggal');
                $split_date = explode('/', $form_date);
                $merge_date = array($split_date[2], $split_date[0], $split_date[1]);
                $konversi_date = implode('-', $merge_date);
                // Definisikan Array untuk menampung nilai pada form
                $arrayData = [
                    'Tanggal' => $konversi_date,
                    'KodeAlternatif' => strtoupper($this->security->xss_clean($this->input->post('KodeAlternatif'))),
                    'NamaAlternatif' => $this->security->xss_clean($this->input->post('NamaAlternatif')),
                    'C1' => $this->security->xss_clean($this->input->post('SubKriteria1')),
                    'C2' => $this->security->xss_clean($this->input->post('SubKriteria2')),
                    'C3' => $this->security->xss_clean($this->input->post('SubKriteria3')),
                    'C4' => $this->security->xss_clean($this->input->post('SubKriteria4')),
                    'C5' => $this->security->xss_clean($this->input->post('SubKriteria5'))
                ];
                // Simpan data alternatif pada database
                $SQL = $this->alternatif_model->simpan_alternatif($arrayData);
                if ($SQL) {
                    // Jika alternatif berhasil disimpan kembali kehalaman alternatif dengan pesan berhasil
                    $this->session->set_flashdata('pesan', 'Data Alternatif berhasil disimpan !');
                    return redirect(site_url('dashboard/alternatif'));
                } else {
                    // Jika alternatif gagal disimpan kembali kehalaman alternatif dengan pesan gagal
                    $this->session->set_flashdata('error', 'Data Alternatif gagal disimpan !');
                    return redirect(site_url('dashboard/alternatif'));
                }
            }
        } elseif ($this->input->post('FormParameter') == 'Perbarui') {
            // Validasi setiap inputan pada form
            $this->form_validation->set_rules('Tanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('KodeAlternatif', 'Kode Alternatif', 'required|max_length[12]');
            $this->form_validation->set_rules('NamaAlternatif', 'Nama Alternatif', 'required');
            $this->form_validation->set_rules('SubKriteria1', 'Kriteria 1', 'required');
            $this->form_validation->set_rules('SubKriteria2', 'Kriteria 2', 'required');
            $this->form_validation->set_rules('SubKriteria3', 'Kriteria 3', 'required');
            $this->form_validation->set_rules('SubKriteria4', 'Kriteria 4', 'required');
            $this->form_validation->set_rules('SubKriteria5', 'Kriteria 5', 'required');
            if ($this->form_validation->run() == FALSE) {
                // Jika validasi error maka kembali kehalaman alternatif
                $this->session->set_flashdata('error', 'Perhatikan nilai pengisian form anda !');
                return redirect(site_url('dashboard/alternatif'));
            } else {
                // Hapus data alternatif yang sudah ada
                $arrayDelete = [
                    'KodeAlternatif' => $this->security->xss_clean($this->input->post('KodeAlternatifD'))
                ];
                $SQLDelete = $this->alternatif_model->hapus_alternatif($arrayDelete);
                if ($SQLDelete) {
                    // Ubah konversi tanggal pada form menjadi tanggal pada database mysql
                    $form_date = $this->input->post('Tanggal');
                    $split_date = explode('/', $form_date);
                    $merge_date = array($split_date[2], $split_date[0], $split_date[1]);
                    $konversi_date = implode('-', $merge_date);
                    // Definisikan Array untuk menampung nilai pada form
                    $arrayData = [
                        'Tanggal' => $konversi_date,
                        'KodeAlternatif' => strtoupper($this->security->xss_clean($this->input->post('KodeAlternatif'))),
                        'NamaAlternatif' => $this->security->xss_clean($this->input->post('NamaAlternatif')),
                        'C1' => $this->security->xss_clean($this->input->post('SubKriteria1')),
                        'C2' => $this->security->xss_clean($this->input->post('SubKriteria2')),
                        'C3' => $this->security->xss_clean($this->input->post('SubKriteria3')),
                        'C4' => $this->security->xss_clean($this->input->post('SubKriteria4')),
                        'C5' => $this->security->xss_clean($this->input->post('SubKriteria5'))
                    ];
                    // Simpan data alternatif baru pada database
                    $SQL = $this->alternatif_model->simpan_alternatif($arrayData);
                    if ($SQL) {
                        // Jika alternatif berhasil disimpan kembali kehalaman alternatif dengan pesan berhasil
                        $this->session->set_flashdata('pesan', 'Data Alternatif berhasil disimpan !');
                        return redirect(site_url('dashboard/alternatif'));
                    } else {
                        // Jika alternatif gagal disimpan kembali kehalaman alternatif dengan pesan gagal
                        $this->session->set_flashdata('error', 'Data Alternatif gagal disimpan !');
                        return redirect(site_url('dashboard/alternatif'));
                    }
                } else {
                    // Jika alternatif gagal diperbarui kembali kehalaman alternatif dengan pesan gagal
                    $this->session->set_flashdata('error', 'Alternatif gagal dihapus, Data Alternatif gagal diperbarui !');
                    return redirect(site_url('dashboard/alternatif'));
                }
            }
        } else {
            // Jika parameter form tidak ditemukan maka kembali kehalaman alternatif dengan pesan error form parameter
            $this->session->set_flashdata('error', 'Form parameter tidak valid !');
            return redirect(site_url('dashboard/alternatif'));
        }
    }

    public function hapus_alternatif($key = null)
    {
        // Definisikan array berisi primary key untuk menghapus alternatif
        $primaryKey = [
            'tbl_alternatif.KodeAlternatif' => $key,
        ];
        // Cek apakah alternatif sudah diproses hitung
        $SQLAlternatif = $this->perhitungan_model->get_perhitungan($primaryKey)->num_rows();
        if ($SQLAlternatif > 0) {
            // Jika alternatif telah diproses hitung maka kembali ke halaman alternatif dengan pesan data tidak bisa dihapus
            $this->session->set_flashdata('error', 'Alternatif sudah diproses hitung, tidak bisa dihapus !');
            return redirect(site_url('dashboard/alternatif'));
        } else {
            // Hapus alternatif dari database
            $SQL = $this->alternatif_model->hapus_alternatif($primaryKey);
            if ($SQL) {
                // Jika alternatif berhasil dihapus kembali kehalaman alternatif dengan pesan berhasil
                $this->session->set_flashdata('pesan', 'Data Alternatif berhasil dihapus !');
                return redirect(site_url('dashboard/alternatif'));
            } else {
                // Jika alternatif gagal dihapus kembali kehalaman alternatif dengan pesan gagal
                $this->session->set_flashdata('error', 'Alternatif tidak ada, Data Alternatif gagal dihapus !');
                return redirect(site_url('dashboard/alternatif'));
            }
        }
    }
}

/* End of file Alternatif.php and path \application\controllers\Alternatif.php */

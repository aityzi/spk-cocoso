<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model/database untuk table kriteria
        $this->load->model('kriteria_model');

        // Load mode/database untuk table sub kriteria
        $this->load->model('subkriteria_model');

        // Middleware/jembatan untuk autentifikasi
        auth_user();
    }

    public function form_kriteria($param = null, $key = null)
    {
        if ($param == 'add') {
            // Definisikan array untuk menampung nilai yang ditampilkan pada konten
            $data = [
                'content' => 'dashboard/kriteria/V_form_kriteria',
                'title' => 'Tambah Kriteria',
                'title_form' => 'Tambah Kriteria',
                'form' => 'Simpan',
                'kriteria' => ''
            ];
            return $this->load->view('dashboard/V_index', $data);
        } elseif ($param == 'update') {
            // Definisikan array untuk menampung nilai yang ditampilkan pada konten
            $primaryKey = [
                'KodeKriteria' => $key,
            ];
            $data = [
                'content' => 'dashboard/kriteria/V_form_kriteria',
                'title' => 'Perbarui Kriteria',
                'title_form' => 'Perbarui Kriteria',
                'form' => 'Perbarui',
                'kriteria' => $this->kriteria_model->get_kriteriaUpdate($primaryKey)->result ()
                // 'kriteria' => $this->Kriteria_model->get_kriteria($primaryKey)-> result ()
            ];
            return $this->load->view('dashboard/V_index', $data);
        } else {
            // Jika parameter form tidak ditemukan maka kembali kehalaman kriteria dengan pesan error form parameter
            $this->session->set_flashdata('error', 'Form parameter tidak valid !');
            return redirect(site_url('dashboard/kriteria'));
        }
    }

    public function simpan_kriteria()
    {
        if ($this->input->post('FormParameter') == 'Simpan') {
            // Validasi setiap inputan pada form
            $this->form_validation->set_rules('KodeKriteria', 'Kode Kriteria', 'required|max_length[12]|is_unique[tbl_kriteria.KodeKriteria]');
            $this->form_validation->set_rules('NamaKriteria', 'Nama Kriteria', 'required|max_length[100]');
            $this->form_validation->set_rules('BobotKriteria', 'Bobot Kriteria', 'required|decimal');
            $this->form_validation->set_rules('JenisKriteria', 'Jenis Kriteria', 'required|max_length[10]');

            if ($this->form_validation->run() == FALSE) {
                // Jika validasi error maka kembali kehalaman kriteria
                $this->session->set_flashdata('error', 'Perhatikan nilai pengisian form anda !');
                return redirect(site_url('dashboard/kriteria'));
            } else {
                // Definisikan Array untuk menampung nilai pada form
                $arrayData = [
                    'KodeKriteria' => strtoupper($this->security->xss_clean($this->input->post('KodeKriteria'))),
                    'NamaKriteria' => ucwords($this->security->xss_clean($this->input->post('NamaKriteria'))),
                    'BobotKriteria' => $this->security->xss_clean($this->input->post('BobotKriteria')),
                    'JenisKriteria' => $this->security->xss_clean($this->input->post('JenisKriteria')),
                ];
                // Simpan data kriteria pada database
                $SQL = $this->kriteria_model->simpan_kriteria($arrayData);
                if ($SQL) {
                    // Jika kriteria berhasil disimpan kembali kehalaman kriteria dengan pesan berhasil
                    $this->session->set_flashdata('pesan', 'Data Kriteria berhasil disimpan !');
                    return redirect(site_url('dashboard/kriteria'));
                } else {
                    // Jika kriteria gagal disimpan kembali kehalaman kriteria dengan pesan gagal
                    $this->session->set_flashdata('error', 'Data Kriteria gagal disimpan !');
                    return redirect(site_url('dashboard/kriteria'));
                }
            }
        } elseif ($this->input->post('FormParameter') == 'Perbarui') {
            // Validasi setiap inputan pada form
            $this->form_validation->set_rules('KodeKriteria', 'Kode Kriteria', 'required|max_length[12]');
            $this->form_validation->set_rules('NamaKriteria', 'Nama Kriteria', 'required|max_length[100]');
            $this->form_validation->set_rules('BobotKriteria', 'Bobot Kriteria', 'required|decimal');
            $this->form_validation->set_rules('JenisKriteria', 'Jensi Kriteria', 'required|max_length[10]');

            if ($this->form_validation->run() == FALSE) {
                // Jika validasi error maka kembali kehalaman kriteria
                return redirect(site_url('dashboard/kriteria'));
            } else {
                // Hapus data kriteria yang sudah ada
                $arrayDelete = [
                    'KodeKriteria' => $this->security->xss_clean($this->input->post('KodeKriteriaD'))
                ];
                $SQLdelete = $this->kriteria_model->hapus_kriteria($arrayDelete);
                if ($SQLdelete) {
                    // Definisikan Array untuk menampung nilai pada form
                    $arrayData = [
                        'KodeKriteria' => strtoupper($this->security->xss_clean($this->input->post('KodeKriteria'))),
                        'NamaKriteria' => ucwords($this->security->xss_clean($this->input->post('NamaKriteria'))),
                        'BobotKriteria' => $this->security->xss_clean($this->input->post('BobotKriteria')),
                        'JenisKriteria' => $this->security->xss_clean($this->input->post('JenisKriteria')),
                    ];
                    // Simpan data kriteria baru pada database
                    $SQL = $this->kriteria_model->simpan_kriteria($arrayData);
                    if ($SQL) {
                        // Jika kriteria berhasil diperbarui kembali kehalaman kriteria dengan pesan berhasil
                        $this->session->set_flashdata('pesan', 'Data Kriteria berhasil diperbarui !');
                        return redirect(site_url('dashboard/kriteria'));
                    } else {
                        // Jika kriteria gagal diperbarui kembali kehalaman kriteria dengan pesan gagal
                        $this->session->set_flashdata('error', 'Data Kriteria gagal diperbarui !');
                        return redirect(site_url('dashboard/kriteria'));
                    }
                } else {
                    // Jika kriteria gagal diperbarui kembali kehalaman kriteria dengan pesan gagal
                    $this->session->set_flashdata('error', 'Kriteria gagal dihapus, Data Kriteria gagal diperbarui !');
                    return redirect(site_url('dashboard/kriteria'));
                }
            }
        } else {
            // Jika parameter form tidak ditemukan maka kembali kehalaman kriteria dengan pesan error form parameter
            $this->session->set_flashdata('error', 'Form parameter tidak valid !');
            return redirect(site_url('dashboard/kriteria'));
        }
    }

    public function hapus_kriteria($key = null)
    {
        // Cek apakah kriteria memiliki sub kriteria
        $subKriteria = $this->subkriteria_model->get_sub_kriteria(['tbl_sub_kriteria.KodeKriteria' => $key]);
        if ($subKriteria->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Kriteria tidak bisa dihapus karena memiliki sub kriteria !');
            return redirect(site_url('dashboard/kriteria'));
        } else {
            // Definisikan array berisi primary key untuk menghapus kriteria
            $primaryKey = [
                'KodeKriteria' => $key,
            ];
            $SQL = $this->kriteria_model->hapus_kriteria($primaryKey);
            if ($SQL) {
                // Jika kriteria berhasil dihapus kembali kehalaman kriteria dengan pesan berhasil
                $this->session->set_flashdata('pesan', 'Data Kriteria berhasil dihapus !');
                return redirect(site_url('dashboard/kriteria'));
            } else {
                // Jika kriteria gagal dihapus kembali kehalaman kriteria dengan pesan gagal
                $this->session->set_flashdata('error', 'Kriteria tidak ada, Data Kriteria gagal dihapus !');
                return redirect(site_url('dashboard/kriteria'));
            }
        }
    }

    public function form_sub_kriteria($param = null, $key = null)
    {
        if ($param == 'add') {
            // Definisikan array untuk menampung nilai yang ditampilkan pada konten
            $data = [
                'content' => 'dashboard/kriteria/V_form_sub_kriteria',
                'title' => 'Tambah Sub Kriteria',
                'title_form' => 'Tambah Sub Kriteria',
                'form' => 'Simpan',
                'kriteria' => $this->kriteria_model->kriteria(),
                'subKriteria' => ''
            ];
            return $this->load->view('dashboard/V_index', $data);
        } elseif ($param == 'update') {
            // Definisikan array untuk menampung nilai yang ditampilkan pada konten
            $primaryKey = [
                'KodeSubKriteria' => $key,
            ];
            $data = [
                'content' => 'dashboard/kriteria/V_form_sub_kriteria',
                'title' => 'Perbarui Sub Kriteria',
                'title_form' => 'Perbarui Sub Kriteria',
                'form' => 'Perbarui',
                'kriteria' => $this->kriteria_model->kriteria(),
                'subKriteria' => $this->subkriteria_model->get_sub_kriteria($primaryKey)->result()
            ];
            return $this->load->view('dashboard/V_index', $data);
        } else {
            // Jika parameter form tidak ditemukan maka kembali kehalaman sub kriteria dengan pesan error form parameter
            $this->session->set_flashdata('error', 'Form parameter tidak valid !');
            return redirect(site_url('dashboard/sub_kriteria'));
        }
    }

    public function detil_sub_kriteria($key = null)
    {
        // Definisikan array untuk menampung nilai yang ditampilkan pada konten
        $primaryKey = [
            'tbl_sub_kriteria.KodeKriteria' => $key,
        ];

        $data = [
            'content' => 'dashboard/kriteria/V_detil_sub_kriteria',
            'title' => 'Detil Sub Kriteria',
            'title_form' => 'Detil Sub Kriteria',
            'subKriteria' => $this->subkriteria_model->get_sub_kriteria($primaryKey)->result()
        ];
        return $this->load->view('dashboard/V_index', $data);
    }

    public function simpan_sub_kriteria()
    {
        if ($this->input->post('FormParameter') == 'Simpan') {
            // Validasi setiap inputan pada form
            $this->form_validation->set_rules('Kriteria', 'Kode Kriteria', 'required');
            $this->form_validation->set_rules('NilaiSubKriteria', 'Nilai Sub Kriteria', 'required');
            $this->form_validation->set_rules('Keterangan', 'Keterangan', 'required|max_length[500]');

            if ($this->form_validation->run() == FALSE) {
                // Jika validasi error maka kembali kehalaman sub kriteria
                $this->session->set_flashdata('error', 'Perhatikan nilai pengisian form anda !');
                return redirect(site_url('dashboard/sub_kriteria'));
            } else {
                // Definisikan Array untuk menampung nilai pada form
                $arrayData = [
                    'KodeSubKriteria' => 'S' . rand(1, 999) . rand(1, 99),
                    'KodeKriteria' => $this->security->xss_clean($this->input->post('Kriteria')),
                    'Nilai' => $this->security->xss_clean($this->input->post('NilaiSubKriteria')),
                    'Keterangan' => $this->security->xss_clean(nl2br($this->input->post('Keterangan'))),
                ];
                // Simpan sub kriteria pada database
                $SQL = $this->subkriteria_model->simpan_sub_kriteria($arrayData);
                if ($SQL) {
                    // Jika sub kriteria berhasil disimpan kembali kehalaman sub kriteria dengan pesan berhasil
                    $this->session->set_flashdata('pesan', 'Data Sub Kriteria berhasil disimpan !');
                    return redirect(site_url('dashboard/sub_kriteria'));
                } else {
                    // Jika sub kriteria gagal disimpan kembali kehalaman sub kriteria dengan pesan gagal
                    $this->session->set_flashdata('error', 'Data Sub Kriteria gagal disimpan !');
                    return redirect(site_url('dashboard/sub_kriteria'));
                }
            }
        } elseif ($this->input->post('FormParameter') == 'Perbarui') {
            // Validasi setiap inputan pada form
            $this->form_validation->set_rules('Kriteria', 'Kode Kriteria', 'required');
            $this->form_validation->set_rules('NilaiSubKriteria', 'Nilai Sub Kriteria', 'required');
            $this->form_validation->set_rules('Keterangan', 'Keterangan', 'required|max_length[500]');

            if ($this->form_validation->run() == FALSE) {
                // Jika validasi error maka kembali kehalaman sub kriteria
                $this->session->set_flashdata('error', 'Perhatikan nilai pengisian form anda !');
                return redirect(site_url('dashboard/sub_kriteria'));
            } else {
                // Definisikan Array untuk menampung nilai pada form
                $primaryKey = [
                    'KodeSubKriteria' => $this->security->xss_clean($this->input->post('KodeSubKriteria')),
                ];
                $arrayData = [
                    'KodeKriteria' => $this->security->xss_clean($this->input->post('Kriteria')),
                    'Nilai' => $this->security->xss_clean($this->input->post('NilaiSubKriteria')),
                    'Keterangan' => $this->security->xss_clean(nl2br($this->input->post('Keterangan'))),
                ];
                // Simpan pembaruan sub kriteria pada database
                $SQL = $this->subkriteria_model->perbarui_sub_kriteria($arrayData, $primaryKey);
                if ($SQL) {
                    // Jika sub kriteria berhasil disimpan kembali kehalaman sub kriteria dengan pesan berhasil
                    $this->session->set_flashdata('pesan', 'Data Sub Kriteria berhasil diperbarui !');
                    return redirect(site_url('dashboard/sub_kriteria'));
                } else {
                    // Jika sub kriteria gagal diperbarui kembali kehalaman sub kriteria dengan pesan gagal
                    $this->session->set_flashdata('error', 'Data Sub Kriteria gagal disimpan !');
                    return redirect(site_url('dashboard/sub_kriteria'));
                }
            }
        } else {
            // Jika parameter form tidak ditemukan maka kembali kehalaman sub kriteria dengan pesan error form parameter
            $this->session->set_flashdata('error', 'Form parameter tidak valid !');
            return redirect(site_url('dashboard/sub_kriteria'));
        }
    }

    public function hapus_sub_kriteria($key = null)
    {
        // Definisikan array berisi primary key untuk menghapus sub kriteria
        $primaryKey = [
            'KodeSubKriteria' => $key,
        ];
        $SQL = $this->subkriteria_model->hapus_sub_kriteria($primaryKey);
        if ($SQL) {
            // Jika sub kriteria berhasil dihapus kembali kehalaman sub kriteria dengan pesan berhasil
            $this->session->set_flashdata('pesan', 'Data Sub Kriteria berhasil dihapus !');
            return redirect(site_url('dashboard/sub_kriteria/'));
        } else {
            // Jika sub kriteria gagal dihapus kembali kehalaman sub kriteria dengan pesan gagal
            $this->session->set_flashdata('error', 'Sub Kriteria tidak ada, Data Sub Kriteria gagal dihapus !');
            return redirect(site_url('dashboard/sub_kriteria/'));
        }
    }
}

/* End of file Kriteria.php and path \application\controllers\Kriteria.php */

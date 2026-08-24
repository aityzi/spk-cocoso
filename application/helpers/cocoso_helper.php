<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* Helper untuk melakukan proses perhitungan metode Combined Compromise Solution
   Author   : Sarah Yuliah Hulwah
   Kelas    : 8SIC1 Sistem Informasi STMIK Triguna Dharma
*/

function matrik_keputusan($tanggal = null)
{
    // Definisikan Class instance
    $CI = &get_instance();
    // Definisikan library
    $CI->load->library('session');
    // Definisikan model/database
    $CI->load->model('alternatif_model');

    // Definisikan array untuk menampung data
    $arrayMatrik = [];
    $primaryKey = [
        'Tanggal' => $tanggal
    ];
    // Cari data alternatif
    $SQL = $CI->alternatif_model->get_alternatif($primaryKey)->num_rows();
    if ($SQL > 0) {
        return $SQL;
    } else {
        // Jika validasi error maka kembali kehalaman perhitungan
        $CI->session->set_flashdata('error', 'Kesalahan function matrik_keputusan pada helper perhitungan metode cocoso !');
        return redirect(site_url('dashboard/perhitungan'));
    }
}

function normalisasi_matrik($tanggal = null)
{
    // Definisikan Class instance
    $CI = &get_instance();
    // Definisikan library
    $CI->load->library('session');
    // Definisikan model/database
    $CI->load->model('kriteria_model');
    $CI->load->model('alternatif_model');

    // Definisikan array untuk menampung data
    $arrayMatrik1 = [];
    $arrayMatrik2 = [];
    $arrayMatrik3 = [];
    $arrayMatrik4 = [];
    $arrayMatrik5 = [];
    $arrayKodeAlternatif = [];
    $arrayNamaAlternatif = [];
    $mergeNormalisasi = [];
    $primaryKey = [
        'Tanggal' => $tanggal
    ];
    // Cari data alternatif
    $alternatifSQL = $CI->alternatif_model->get_alternatif($primaryKey)->result();
    if ($alternatifSQL) {

        foreach ($alternatifSQL as $alternatif) {
            // Tampung seluruh kode alternatif pada array
            $arrayKodeAlternatif[] = $alternatif->KodeAlternatif;
            // Tampung seluruh nama alternatif pada array
            $arrayNamaAlternatif[] = $alternatif->NamaAlternatif;
            // Mencari nilai untuk kriteria 1
            $kriteriaSQL1 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C1'));
            foreach ($kriteriaSQL1 as $kriteria1) {

                if ($kriteria1->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C1');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C1');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 1 (luas Tanah)
                    $op1 = $alternatif->C1 - $nilaiMin->row()->C1;
                    $op2 = $nilaiMax->row()->C1 - $nilaiMin->row()->C1;

                    if ($op2 != 0) {
                        $totalKriteria1 = $op1 / $op2;
                    } else {
                        $totalKriteria1 = 0;
                    }
                    $arrayMatrik1[] = number_format($totalKriteria1, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C1');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C1');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 1 (luas Tanah)
                    $op1 = $nilaiMax->row()->C1 - $alternatif->C1;
                    $op2 = $nilaiMax->row()->C1 - $nilaiMin->row()->C1;

                    if ($op2 != 0) {
                        $totalKriteria1 = $op1 / $op2;
                    } else {
                        $totalKriteria1 = 0;
                    }
                    $arrayMatrik1[] = number_format($totalKriteria1, 4);
                }
            }

            // Mencari nilai untuk kriteria 2
            $kriteriaSQL2 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C2'));
            foreach ($kriteriaSQL2 as $kriteria2) {

                if ($kriteria2->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C2');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C2');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $op1 = $alternatif->C2 - $nilaiMin->row()->C2;
                    $op2 = $nilaiMax->row()->C2 - $nilaiMin->row()->C2;

                    if ($op2 != 0) {
                        $totalKriteria2 = $op1 / $op2;
                    } else {
                        $totalKriteria2 = 0;
                    }
                    $arrayMatrik2[] = number_format($totalKriteria2, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C2');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C2');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $op1 = $nilaiMax->row()->C2 - $alternatif->C2;
                    $op2 = $nilaiMax->row()->C2 - $nilaiMin->row()->C2;

                    if ($op2 != 0) {
                        $totalKriteria2 = $op1 / $op2;
                    } else {
                        $totalKriteria2 = 0;
                    }
                    $arrayMatrik2[] = number_format($totalKriteria2, 4);
                }
            }

            // Mencari nilai untuk kriteria 3
            $kriteriaSQL3 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C3'));
            foreach ($kriteriaSQL3 as $kriteria3) {

                if ($kriteria3->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C3');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C3');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $op1 = $alternatif->C3 - $nilaiMin->row()->C3;
                    $op2 = $nilaiMax->row()->C3 - $nilaiMin->row()->C3;

                    if ($op2 != 0) {
                        $totalKriteria3 = $op1 / $op2;
                    } else {
                        $totalKriteria3 = 0;
                    }
                    $arrayMatrik3[] = number_format($totalKriteria3, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C3');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C3');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $op1 = $nilaiMax->row()->C3 - $alternatif->C3;
                    $op2 = $nilaiMax->row()->C3 - $nilaiMin->row()->C3;

                    if ($op2 != 0) {
                        $totalKriteria3 = $op1 / $op2;
                    } else {
                        $totalKriteria3 = 0;
                    }
                    $arrayMatrik3[] = number_format($totalKriteria3, 4);
                }
            }

            // Mencari nilai untuk kriteria 4
            $kriteriaSQL4 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C4'));
            foreach ($kriteriaSQL4 as $kriteria4) {

                if ($kriteria4->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C4');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C4');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $op1 = $alternatif->C4 - $nilaiMin->row()->C4;
                    $op2 = $nilaiMax->row()->C4 - $nilaiMin->row()->C4;

                    if ($op2 != 0) {
                        $totalKriteria4 = $op1 / $op2;
                    } else {
                        $totalKriteria4 = 0;
                    }
                    $arrayMatrik4[] = number_format($totalKriteria4, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C4');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C4');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $op1 = $nilaiMax->row()->C4 - $alternatif->C4;
                    $op2 = $nilaiMax->row()->C4 - $nilaiMin->row()->C4;

                    if ($op2 != 0) {
                        $totalKriteria4 = $op1 / $op2;
                    } else {
                        $totalKriteria4 = 0;
                    }
                    $arrayMatrik4[] = number_format($totalKriteria4, 4);
                }
            }

            // Mencari nilai untuk kriteria 5
            $kriteriaSQL5 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C5'));
            foreach ($kriteriaSQL5 as $kriteria5) {

                if ($kriteria5->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C5');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C5');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $op1 = $alternatif->C5 - $nilaiMin->row()->C5;
                    $op2 = $nilaiMax->row()->C5 - $nilaiMin->row()->C5;

                    if ($op2 != 0) {
                        $totalKriteria5 = $op1 / $op2;
                    } else {
                        $totalKriteria5 = 0;
                    }
                    $arrayMatrik5[] = number_format($totalKriteria5, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C5');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C5');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $op1 = $nilaiMax->row()->C5 - $alternatif->C5;
                    $op2 = $nilaiMax->row()->C5 - $nilaiMin->row()->C5;

                    if ($op2 != 0) {
                        $totalKriteria5 = $op1 / $op2;
                    } else {
                        $totalKriteria5 = 0;
                    }
                    $arrayMatrik5[] = number_format($totalKriteria5, 4);
                }
            }
        }

        $mergeNormalisasi = [
            'KodeAlternatif' => $arrayKodeAlternatif,
            'NamaAlternatif' => $arrayNamaAlternatif,
            'C1' => $arrayMatrik1,
            'C2' => $arrayMatrik2,
            'C3' => $arrayMatrik3,
            'C4' => $arrayMatrik4,
            'C5' => $arrayMatrik5
        ];

        return $mergeNormalisasi;
    } else {
        // Jika validasi error maka kembali kehalaman perhitungan
        $CI->session->set_flashdata('error', 'Kesalahan function normalisasi_matrik pada helper perhitungan metode cocoso !');
        return redirect(site_url('dashboard/perhitungan'));
    }
}

function nilai_si($tanggal = null)
{
    // Definisikan Class instance
    $CI = &get_instance();
    // Definisikan library
    $CI->load->library('session');
    // Definisikan model/database
    $CI->load->model('kriteria_model');
    $CI->load->model('alternatif_model');

    // Definisikan array untuk menampung data
    $arrayMatrik1 = [];
    $arrayMatrik2 = [];
    $arrayMatrik3 = [];
    $arrayMatrik4 = [];
    $arrayMatrik5 = [];
    $arrayKodeAlternatif = [];
    $arrayNamaAlternatif = [];
    $arraySumSi = [];
    $mergeSi = [];
    $primaryKey = [
        'Tanggal' => $tanggal
    ];
    // Cari data alternatif
    $alternatifSQL = $CI->alternatif_model->get_alternatif($primaryKey)->result();
    if ($alternatifSQL) {

        foreach ($alternatifSQL as $alternatif) {
            // Tampung seluruh kode alternatif pada array
            $arrayKodeAlternatif[] = $alternatif->KodeAlternatif;
            // Tampung seluruh nama alternatif pada array
            $arrayNamaAlternatif[] = $alternatif->NamaAlternatif;
            // Mencari nilai untuk kriteria 1
            $kriteriaSQL1 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C1'));
            foreach ($kriteriaSQL1 as $kriteria1) {

                if ($kriteria1->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C1');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C1');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 1 (luas Tanah)
                    $op1 = $alternatif->C1 - $nilaiMin->row()->C1;
                    $op2 = $nilaiMax->row()->C1 - $nilaiMin->row()->C1;

                    if ($op2 != 0) {
                        $totalKriteria1 = $op1 / $op2;
                    } else {
                        $totalKriteria1 = 0;
                    }

                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si1 = $kriteria1->BobotKriteria * $totalKriteria1;
                    $arrayMatrik1[] = number_format($nilai_si1, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C1');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C1');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 1 (luas Tanah)
                    $op1 = $nilaiMax->row()->C1 - $alternatif->C1;
                    $op2 = $nilaiMax->row()->C1 - $nilaiMin->row()->C1;

                    if ($op2 != 0) {
                        $totalKriteria1 = $op1 / $op2;
                    } else {
                        $totalKriteria1 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si1 = $kriteria1->BobotKriteria * $totalKriteria1;
                    $arrayMatrik1[] = number_format($nilai_si1, 4);
                }
            }

            // Mencari nilai untuk kriteria 2
            $kriteriaSQL2 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C2'));
            foreach ($kriteriaSQL2 as $kriteria2) {

                if ($kriteria2->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C2');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C2');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $op1 = $alternatif->C2 - $nilaiMin->row()->C2;
                    $op2 = $nilaiMax->row()->C2 - $nilaiMin->row()->C2;

                    if ($op2 != 0) {
                        $totalKriteria2 = $op1 / $op2;
                    } else {
                        $totalKriteria2 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si2 = $kriteria2->BobotKriteria * $totalKriteria2;
                    $arrayMatrik2[] = number_format($nilai_si2, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C2');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C2');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $op1 = $nilaiMax->row()->C2 - $alternatif->C2;
                    $op2 = $nilaiMax->row()->C2 - $nilaiMin->row()->C2;

                    if ($op2 != 0) {
                        $totalKriteria2 = $op1 / $op2;
                    } else {
                        $totalKriteria2 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si2 = $kriteria2->BobotKriteria * $totalKriteria2;
                    $arrayMatrik2[] = number_format($nilai_si2, 4);
                }
            }

            // Mencari nilai untuk kriteria 3
            $kriteriaSQL3 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C3'));
            foreach ($kriteriaSQL3 as $kriteria3) {

                if ($kriteria3->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C3');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C3');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $op1 = $alternatif->C3 - $nilaiMin->row()->C3;
                    $op2 = $nilaiMax->row()->C3 - $nilaiMin->row()->C3;

                    if ($op2 != 0) {
                        $totalKriteria3 = $op1 / $op2;
                    } else {
                        $totalKriteria3 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si3 = $kriteria3->BobotKriteria * $totalKriteria3;
                    $arrayMatrik3[] = number_format($nilai_si3, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C3');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C3');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $op1 = $nilaiMax->row()->C3 - $alternatif->C3;
                    $op2 = $nilaiMax->row()->C3 - $nilaiMin->row()->C3;

                    if ($op2 != 0) {
                        $totalKriteria3 = $op1 / $op2;
                    } else {
                        $totalKriteria3 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si3 = $kriteria3->BobotKriteria * $totalKriteria3;
                    $arrayMatrik3[] = number_format($nilai_si3, 4);
                }
            }

            // Mencari nilai untuk kriteria 4
            $kriteriaSQL4 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C4'));
            foreach ($kriteriaSQL4 as $kriteria4) {

                if ($kriteria4->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C4');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C4');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $op1 = $alternatif->C4 - $nilaiMin->row()->C4;
                    $op2 = $nilaiMax->row()->C4 - $nilaiMin->row()->C4;

                    if ($op2 != 0) {
                        $totalKriteria4 = $op1 / $op2;
                    } else {
                        $totalKriteria4 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si4 = $kriteria4->BobotKriteria * $totalKriteria4;
                    $arrayMatrik4[] = number_format($nilai_si4, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C4');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C4');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $op1 = $nilaiMax->row()->C4 - $alternatif->C4;
                    $op2 = $nilaiMax->row()->C4 - $nilaiMin->row()->C4;

                    if ($op2 != 0) {
                        $totalKriteria4 = $op1 / $op2;
                    } else {
                        $totalKriteria4 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si4 = $kriteria4->BobotKriteria * $totalKriteria4;
                    $arrayMatrik4[] = number_format($nilai_si4, 4);
                }
            }

            // Mencari nilai untuk kriteria 5
            $kriteriaSQL5 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C5'));
            foreach ($kriteriaSQL5 as $kriteria5) {

                if ($kriteria5->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C5');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C5');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $op1 = $alternatif->C5 - $nilaiMin->row()->C5;
                    $op2 = $nilaiMax->row()->C5 - $nilaiMin->row()->C5;

                    if ($op2 != 0) {
                        $totalKriteria5 = $op1 / $op2;
                    } else {
                        $totalKriteria5 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si5 = $kriteria5->BobotKriteria * $totalKriteria5;
                    $arrayMatrik5[] = number_format($nilai_si5, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C5');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C5');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $op1 = $nilaiMax->row()->C5 - $alternatif->C5;
                    $op2 = $nilaiMax->row()->C5 - $nilaiMin->row()->C5;

                    if ($op2 != 0) {
                        $totalKriteria5 = $op1 / $op2;
                    } else {
                        $totalKriteria5 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si5 = $kriteria5->BobotKriteria * $totalKriteria5;
                    $arrayMatrik5[] = number_format($nilai_si5, 4);
                }
            }
            // Jumlahkan nilai si seluruh kriteria dari keseluruhan alternatif
            $arraySumSi[] = number_format($nilai_si1 + $nilai_si2 + $nilai_si3 + $nilai_si4 + $nilai_si5, 4);
        }

        $mergeSi = [
            'KodeAlternatif' => $arrayKodeAlternatif,
            'NamaAlternatif' => $arrayNamaAlternatif,
            'C1' => $arrayMatrik1,
            'C2' => $arrayMatrik2,
            'C3' => $arrayMatrik3,
            'C4' => $arrayMatrik4,
            'C5' => $arrayMatrik5,
            'Total' => $arraySumSi
        ];

        return $mergeSi;
    } else {
        // Jika validasi error maka kembali kehalaman perhitungan
        $CI->session->set_flashdata('error', 'Kesalahan function nilai_si pada helper perhitungan metode cocoso !');
        return redirect(site_url('dashboard/perhitungan'));
    }
}

function nilai_pi($tanggal = null)
{
    // Definisikan Class instance
    $CI = &get_instance();
    // Definisikan library
    $CI->load->library('session');
    // Definisikan model/database
    $CI->load->model('kriteria_model');
    $CI->load->model('alternatif_model');

    // Definisikan array untuk menampung data
    $arrayMatrik1 = [];
    $arrayMatrik2 = [];
    $arrayMatrik3 = [];
    $arrayMatrik4 = [];
    $arrayMatrik5 = [];
    $arrayKodeAlternatif = [];
    $arrayNamaAlternatif = [];
    $arraySumPi = [];
    $mergePi = [];
    $primaryKey = [
        'Tanggal' => $tanggal
    ];
    // Cari data alternatif
    $alternatifSQL = $CI->alternatif_model->get_alternatif($primaryKey)->result();
    if ($alternatifSQL) {

        foreach ($alternatifSQL as $alternatif) {
            // Tampung seluruh kode alternatif pada array
            $arrayKodeAlternatif[] = $alternatif->KodeAlternatif;
            // Tampung seluruh nama alternatif pada array
            $arrayNamaAlternatif[] = $alternatif->NamaAlternatif;
            // Mencari nilai untuk kriteria 1
            $kriteriaSQL1 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C1'));
            foreach ($kriteriaSQL1 as $kriteria1) {

                if ($kriteria1->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C1');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C1');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 1 (luas Tanah)
                    $op1 = $alternatif->C1 - $nilaiMin->row()->C1;
                    $op2 = $nilaiMax->row()->C1 - $nilaiMin->row()->C1;

                    if ($op2 != 0) {
                        $totalKriteria1 = $op1 / $op2;
                    } else {
                        $totalKriteria1 = 0;
                    }

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi1 = pow($totalKriteria1, $kriteria1->BobotKriteria);
                    $arrayMatrik1[] = number_format($nilai_pi1, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C1');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C1');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 1 (luas Tanah)
                    $op1 = $nilaiMax->row()->C1 - $alternatif->C1;
                    $op2 = $nilaiMax->row()->C1 - $nilaiMin->row()->C1;

                    if ($op2 != 0) {
                        $totalKriteria1 = $op1 / $op2;
                    } else {
                        $totalKriteria1 = 0;
                    }
                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi1 = pow($totalKriteria1, $kriteria1->BobotKriteria);
                    $arrayMatrik1[] = number_format($nilai_pi1, 4);
                }
            }

            // Mencari nilai untuk kriteria 2
            $kriteriaSQL2 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C2'));
            foreach ($kriteriaSQL2 as $kriteria2) {

                if ($kriteria2->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C2');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C2');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $op1 = $alternatif->C2 - $nilaiMin->row()->C2;
                    $op2 = $nilaiMax->row()->C2 - $nilaiMin->row()->C2;

                    if ($op2 != 0) {
                        $totalKriteria2 = $op1 / $op2;
                    } else {
                        $totalKriteria2 = 0;
                    }
                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi2 = pow($totalKriteria2, $kriteria2->BobotKriteria);
                    $arrayMatrik2[] = number_format($nilai_pi2, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C2');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C2');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $op1 = $nilaiMax->row()->C2 - $alternatif->C2;
                    $op2 = $nilaiMax->row()->C2 - $nilaiMin->row()->C2;

                    if ($op2 != 0) {
                        $totalKriteria2 = $op1 / $op2;
                    } else {
                        $totalKriteria2 = 0;
                    }
                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi2 = pow($totalKriteria2, $kriteria2->BobotKriteria);
                    $arrayMatrik2[] = number_format($nilai_pi2, 4);
                }
            }

            // Mencari nilai untuk kriteria 3
            $kriteriaSQL3 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C3'));
            foreach ($kriteriaSQL3 as $kriteria3) {

                if ($kriteria3->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C3');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C3');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $op1 = $alternatif->C3 - $nilaiMin->row()->C3;
                    $op2 = $nilaiMax->row()->C3 - $nilaiMin->row()->C3;

                    if ($op2 != 0) {
                        $totalKriteria3 = $op1 / $op2;
                    } else {
                        $totalKriteria3 = 0;
                    }
                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi3 = pow($totalKriteria3, $kriteria3->BobotKriteria);
                    $arrayMatrik3[] = number_format($nilai_pi3, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C3');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C3');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $op1 = $nilaiMax->row()->C3 - $alternatif->C3;
                    $op2 = $nilaiMax->row()->C3 - $nilaiMin->row()->C3;

                    if ($op2 != 0) {
                        $totalKriteria3 = $op1 / $op2;
                    } else {
                        $totalKriteria3 = 0;
                    }
                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi3 = pow($totalKriteria3, $kriteria3->BobotKriteria);
                    $arrayMatrik3[] = number_format($nilai_pi3, 4);
                }
            }

            // Mencari nilai untuk kriteria 4
            $kriteriaSQL4 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C4'));
            foreach ($kriteriaSQL4 as $kriteria4) {

                if ($kriteria4->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C4');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C4');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $op1 = $alternatif->C4 - $nilaiMin->row()->C4;
                    $op2 = $nilaiMax->row()->C4 - $nilaiMin->row()->C4;

                    if ($op2 != 0) {
                        $totalKriteria4 = $op1 / $op2;
                    } else {
                        $totalKriteria4 = 0;
                    }
                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi4 = pow($totalKriteria4, $kriteria4->BobotKriteria);
                    $arrayMatrik4[] = number_format($nilai_pi4, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C4');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C4');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $op1 = $nilaiMax->row()->C4 - $alternatif->C4;
                    $op2 = $nilaiMax->row()->C4 - $nilaiMin->row()->C4;

                    if ($op2 != 0) {
                        $totalKriteria4 = $op1 / $op2;
                    } else {
                        $totalKriteria4 = 0;
                    }
                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi4 = pow($totalKriteria4, $kriteria4->BobotKriteria);
                    $arrayMatrik4[] = number_format($nilai_pi4, 4);
                }
            }

            // Mencari nilai untuk kriteria 5
            $kriteriaSQL5 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C5'));
            foreach ($kriteriaSQL5 as $kriteria5) {

                if ($kriteria5->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C5');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C5');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $op1 = $alternatif->C5 - $nilaiMin->row()->C5;
                    $op2 = $nilaiMax->row()->C5 - $nilaiMin->row()->C5;

                    if ($op2 != 0) {
                        $totalKriteria5 = $op1 / $op2;
                    } else {
                        $totalKriteria5 = 0;
                    }
                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi5 = pow($totalKriteria5, $kriteria5->BobotKriteria);
                    $arrayMatrik5[] = number_format($nilai_pi5, 4);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C5');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C5');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $op1 = $nilaiMax->row()->C5 - $alternatif->C5;
                    $op2 = $nilaiMax->row()->C5 - $nilaiMin->row()->C5;

                    if ($op2 != 0) {
                        $totalKriteria5 = $op1 / $op2;
                    } else {
                        $totalKriteria5 = 0;
                    }
                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi5 = pow($totalKriteria5, $kriteria5->BobotKriteria);
                    $arrayMatrik5[] = number_format($nilai_pi5, 4);
                }
            }
            // Jumlahkan nilai pi seluruh kriteria dari keseluruhan alternatif
            $arraySumPi[] = number_format($nilai_pi1 + $nilai_pi2 + $nilai_pi3 + $nilai_pi4 + $nilai_pi5, 4);

        }

        $mergePi = [
            'KodeAlternatif' => $arrayKodeAlternatif,
            'NamaAlternatif' => $arrayNamaAlternatif,
            'C1' => $arrayMatrik1,
            'C2' => $arrayMatrik2,
            'C3' => $arrayMatrik3,
            'C4' => $arrayMatrik4,
            'C5' => $arrayMatrik5,
            'Total' => $arraySumPi
        ];

        return $mergePi;
    } else {
        // Jika validasi error maka kembali kehalaman perhitungan
        $CI->session->set_flashdata('error', 'Kesalahan function nilai_si pada helper perhitungan metode cocoso !');
        return redirect(site_url('dashboard/perhitungan'));
    }
}

function nilai_kia_kib_kic($tanggal = null)
{
    // Definisikan Class instance
    $CI = &get_instance();
    // Definisikan library
    $CI->load->library('session');
    // Definisikan model/database
    $CI->load->model('kriteria_model');
    $CI->load->model('alternatif_model');

    // Definisikan array untuk menampung data
    $arrayKodeAlternatif = [];
    $arrayNamaAlternatif = [];
    $arraySumSi = [];
    $arraySumPi = [];
    $arraySumSiPi = [];
    $arrayKia = [];
    $arrayKib = [];
    $arrayKic = [];
    $mergeKiaKibKic = [];
    $primaryKey = [
        'Tanggal' => $tanggal
    ];
    // Cari data alternatif
    $alternatifSQL = $CI->alternatif_model->get_alternatif($primaryKey)->result();
    if ($alternatifSQL) {

        foreach ($alternatifSQL as $alternatif) {
            // Tampung seluruh kode alternatif pada array
            $arrayKodeAlternatif[] = $alternatif->KodeAlternatif;
            // Tampung seluruh nama alternatif pada array
            $arrayNamaAlternatif[] = $alternatif->NamaAlternatif;
            // Mencari nilai untuk kriteria 1
            $kriteriaSQL1 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C1'));
            foreach ($kriteriaSQL1 as $kriteria1) {

                if ($kriteria1->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C1');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C1');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 1 (luas Tanah)
                    $op1 = $alternatif->C1 - $nilaiMin->row()->C1;
                    $op2 = $nilaiMax->row()->C1 - $nilaiMin->row()->C1;

                    if ($op2 != 0) {
                        $totalKriteria1 = $op1 / $op2;
                    } else {
                        $totalKriteria1 = 0;
                    }

                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si1 = $kriteria1->BobotKriteria * $totalKriteria1;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi1 = pow($totalKriteria1, $kriteria1->BobotKriteria);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C1');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C1');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 1 (luas Tanah)
                    $op1 = $nilaiMax->row()->C1 - $alternatif->C1;
                    $op2 = $nilaiMax->row()->C1 - $nilaiMin->row()->C1;

                    if ($op2 != 0) {
                        $totalKriteria1 = $op1 / $op2;
                    } else {
                        $totalKriteria1 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si1 = $kriteria1->BobotKriteria * $totalKriteria1;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi1 = pow($totalKriteria1, $kriteria1->BobotKriteria);
                }
            }

            // Mencari nilai untuk kriteria 2
            $kriteriaSQL2 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C2'));
            foreach ($kriteriaSQL2 as $kriteria2) {

                if ($kriteria2->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C2');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C2');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $op1 = $alternatif->C2 - $nilaiMin->row()->C2;
                    $op2 = $nilaiMax->row()->C2 - $nilaiMin->row()->C2;

                    if ($op2 != 0) {
                        $totalKriteria2 = $op1 / $op2;
                    } else {
                        $totalKriteria2 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si2 = $kriteria2->BobotKriteria * $totalKriteria2;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi2 = pow($totalKriteria2, $kriteria2->BobotKriteria);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C2');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C2');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $op1 = $nilaiMax->row()->C2 - $alternatif->C2;
                    $op2 = $nilaiMax->row()->C2 - $nilaiMin->row()->C2;

                    if ($op2 != 0) {
                        $totalKriteria2 = $op1 / $op2;
                    } else {
                        $totalKriteria2 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si2 = $kriteria2->BobotKriteria * $totalKriteria2;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi2 = pow($totalKriteria2, $kriteria2->BobotKriteria);
                }
            }

            // Mencari nilai untuk kriteria 3
            $kriteriaSQL3 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C3'));
            foreach ($kriteriaSQL3 as $kriteria3) {

                if ($kriteria3->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C3');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C3');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $op1 = $alternatif->C3 - $nilaiMin->row()->C3;
                    $op2 = $nilaiMax->row()->C3 - $nilaiMin->row()->C3;

                    if ($op2 != 0) {
                        $totalKriteria3 = $op1 / $op2;
                    } else {
                        $totalKriteria3 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si3 = $kriteria3->BobotKriteria * $totalKriteria3;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi3 = pow($totalKriteria3, $kriteria3->BobotKriteria);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C3');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C3');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $op1 = $nilaiMax->row()->C3 - $alternatif->C3;
                    $op2 = $nilaiMax->row()->C3 - $nilaiMin->row()->C3;

                    if ($op2 != 0) {
                        $totalKriteria3 = $op1 / $op2;
                    } else {
                        $totalKriteria3 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si3 = $kriteria3->BobotKriteria * $totalKriteria3;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi3 = pow($totalKriteria3, $kriteria3->BobotKriteria);
                }
            }

            // Mencari nilai untuk kriteria 4
            $kriteriaSQL4 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C4'));
            foreach ($kriteriaSQL4 as $kriteria4) {

                if ($kriteria4->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C4');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C4');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $op1 = $alternatif->C4 - $nilaiMin->row()->C4;
                    $op2 = $nilaiMax->row()->C4 - $nilaiMin->row()->C4;

                    if ($op2 != 0) {
                        $totalKriteria4 = $op1 / $op2;
                    } else {
                        $totalKriteria4 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si4 = $kriteria4->BobotKriteria * $totalKriteria4;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi4 = pow($totalKriteria4, $kriteria4->BobotKriteria);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C4');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C4');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $op1 = $nilaiMax->row()->C4 - $alternatif->C4;
                    $op2 = $nilaiMax->row()->C4 - $nilaiMin->row()->C4;

                    if ($op2 != 0) {
                        $totalKriteria4 = $op1 / $op2;
                    } else {
                        $totalKriteria4 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si4 = $kriteria4->BobotKriteria * $totalKriteria4;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi4 = pow($totalKriteria4, $kriteria4->BobotKriteria);
                }
            }

            // Mencari nilai untuk kriteria 5
            $kriteriaSQL5 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C5'));
            foreach ($kriteriaSQL5 as $kriteria5) {

                if ($kriteria5->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C5');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C5');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $op1 = $alternatif->C5 - $nilaiMin->row()->C5;
                    $op2 = $nilaiMax->row()->C5 - $nilaiMin->row()->C5;

                    if ($op2 != 0) {
                        $totalKriteria5 = $op1 / $op2;
                    } else {
                        $totalKriteria5 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si5 = $kriteria5->BobotKriteria * $totalKriteria5;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi5 = pow($totalKriteria5, $kriteria5->BobotKriteria);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C5');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C5');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $op1 = $nilaiMax->row()->C5 - $alternatif->C5;
                    $op2 = $nilaiMax->row()->C5 - $nilaiMin->row()->C5;

                    if ($op2 != 0) {
                        $totalKriteria5 = $op1 / $op2;
                    } else {
                        $totalKriteria5 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si5 = $kriteria5->BobotKriteria * $totalKriteria5;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi5 = pow($totalKriteria5, $kriteria5->BobotKriteria);
                }
            }

            // Jumlahkan nilai si seluruh kriteria dari keseluruhan alternatif
            $arraySumSi[] = $nilai_si1 + $nilai_si2 + $nilai_si3 + $nilai_si4 + $nilai_si5;
            $total_sum_si = $nilai_si1 + $nilai_si2 + $nilai_si3 + $nilai_si4 + $nilai_si5;
            // Jumlahkan nilai pi seluruh kriteria dari keseluruhan alternatif
            $arraySumPi[] = $nilai_pi1 + $nilai_pi2 + $nilai_pi3 + $nilai_pi4 + $nilai_pi5;
            $total_sum_pi = $nilai_pi1 + $nilai_pi2 + $nilai_pi3 + $nilai_pi4 + $nilai_pi5;

            // Jumlakan seluruh nilai si + pi pada seluruh alternatif
            $arraySumSiPi[] = $total_sum_si + $total_sum_pi;
        }


        // Menghitung nilai kia dan rangking
        // Jumlah keseluruhan array si + pi
        $sumArraySiPi = array_sum($arraySumSiPi);
        foreach ($arraySumSiPi as $total_si_pi) {
            // Rumus menghitung nilai kia : total jumlah keseluruhan si + pi / jumlah si + pi dari alternatif
            $arrayKia[] = number_format($total_si_pi / $sumArraySiPi, 4);
        }

        // Buat salinan array asli untuk menyimpan indeksnya
        $sortedArrayKia = $arrayKia;

        // Urutkan array secara descending
        rsort($sortedArrayKia, SORT_NUMERIC);

        // Inisialisasi array untuk menyimpan peringkat
        $rankingKia = [];

        // Tentukan peringkat untuk setiap elemen dalam data asli
        foreach ($arrayKia as $value) {
            $rankingKia[] = array_search($value, $sortedArrayKia) + 1;
        }

        // ---------------------------------------------------------------------------------

        // Menghitung nilai kib dan rangking
        // Definisikan nilai min pada si dan nilai min pada pi
        $minSi = min($arraySumSi);
        $minPi = min($arraySumPi);

        $arrayCollectMinSiPiKib = [
            'si_kib' => $arraySumSi,
            'pi_kib' => $arraySumPi,
        ];

        foreach ($arrayCollectMinSiPiKib['si_kib'] as $key => $si_kib) {
            // Rumus menghitung nilai kib : nilai si dari alternatif / nilai minimum si + nilai pi alternatif / nilai minimum dari pi
            $op_kib1 = $si_kib / $minSi;
            $op_kib2 = $arrayCollectMinSiPiKib['pi_kib'][$key] / $minPi;

            $kib = $op_kib1 + $op_kib2;
            $arrayKib[] = number_format($kib, 4);
        }

        // Buat salinan array asli untuk menyimpan indeksnya
        $sortedArrayKib = $arrayKib;

        // Urutkan array secara descending
        rsort($sortedArrayKib, SORT_NUMERIC);

        // Inisialisasi array untuk menyimpan peringkat
        $rankingKib = [];

        // Tentukan peringkat untuk setiap elemen dalam data asli
        foreach ($arrayKib as $value) {
            $rankingKib[] = array_search($value, $sortedArrayKib) + 1;
        }

        // Menghitung nilai kic dan rangking
        // Definisikan nilai max pada si dan nilai max pada pi
        $maxSi = max($arraySumSi);
        $maxPi = max($arraySumPi);

        $arrayCollectMaxSiPiKic = [
            'si_kic' => $arraySumSi,
            'pi_kic' => $arraySumPi,
        ];

        foreach ($arrayCollectMaxSiPiKic['si_kic'] as $key => $si_kic) {

            // Rumus menghitung nilai kic ((0.5 * nilai si dari alternatif ) + ((1 - 0.5) * nilai pi dari alternatif)) / ((0.5 * nilai maksimum si) + ((1 - 0.5) * nilai maksimum pi));
            $kic = ((0.5 * $si_kic) + ((1 - 0.5) * $arrayCollectMaxSiPiKic['pi_kic'][$key])) / ((0.5 * $maxSi) + ((1 - 0.5) * $maxPi));

            $arrayKic[] = number_format($kic, 4);
        }

        // Buat salinan array asli untuk menyimpan indeksnya
        $sortedArrayKic = $arrayKic;

        // Urutkan array secara descending
        rsort($sortedArrayKic, SORT_NUMERIC);

        // Inisialisasi array untuk menyimpan peringkat
        $rankingKic = [];

        // Tentukan peringkat untuk setiap elemen dalam data asli
        foreach ($arrayKic as $value) {
            $rankingKic[] = array_search($value, $sortedArrayKic) + 1;
        }

        $mergeKiaKibKic = [
            'KodeAlternatif' => $arrayKodeAlternatif,
            'NamaAlternatif' => $arrayNamaAlternatif,
            'Kia' => $arrayKia,
            'RangkingKia' => $rankingKia,
            'Kib' => $arrayKib,
            'RangkingKib' => $rankingKib,
            'Kic' => $arrayKic,
            'RangkingKic' => $rankingKic
        ];

        return $mergeKiaKibKic;
    } else {
        // Jika validasi error maka kembali kehalaman perhitungan
        $CI->session->set_flashdata('error', 'Kesalahan function nilai_kia_kib_kic pada helper perhitungan metode cocoso !');
        return redirect(site_url('dashboard/perhitungan'));
    }
}

function nilai_ki($tanggal = null)
{
    // Definisikan Class instance
    $CI = &get_instance();
    // Definisikan library
    $CI->load->library('session');
    // Definisikan model/database
    $CI->load->model('kriteria_model');
    $CI->load->model('alternatif_model');

    // Definisikan array untuk menampung data
    $arrayKodeAlternatif = [];
    $arrayNamaAlternatif = [];
    $arraySumSi = [];
    $arraySumPi = [];
    $arraySumSiPi = [];
    $arrayKia = [];
    $arrayKib = [];
    $arrayKic = [];
    $arrayKi = [];
    $mergeKiaKibKic = [];
    $mergeKi = [];
    $primaryKey = [
        'Tanggal' => $tanggal
    ];
    // Cari data alternatif
    $alternatifSQL = $CI->alternatif_model->get_alternatif($primaryKey)->result();
    if ($alternatifSQL) {

        foreach ($alternatifSQL as $alternatif) {
            // Tampung seluruh kode alternatif pada array
            $arrayKodeAlternatif[] = $alternatif->KodeAlternatif;
            // Tampung seluruh nama alternatif pada array
            $arrayNamaAlternatif[] = $alternatif->NamaAlternatif;
            // Mencari nilai untuk kriteria 1
            $kriteriaSQL1 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C1'));
            foreach ($kriteriaSQL1 as $kriteria1) {

                if ($kriteria1->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C1');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C1');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 1 (luas Tanah)
                    $op1 = $alternatif->C1 - $nilaiMin->row()->C1;
                    $op2 = $nilaiMax->row()->C1 - $nilaiMin->row()->C1;

                    if ($op2 != 0) {
                        $totalKriteria1 = $op1 / $op2;
                    } else {
                        $totalKriteria1 = 0;
                    }

                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si1 = $kriteria1->BobotKriteria * $totalKriteria1;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi1 = pow($totalKriteria1, $kriteria1->BobotKriteria);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C1');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 1 (Luas Tanah)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C1');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 1 (luas Tanah)
                    $op1 = $nilaiMax->row()->C1 - $alternatif->C1;
                    $op2 = $nilaiMax->row()->C1 - $nilaiMin->row()->C1;

                    if ($op2 != 0) {
                        $totalKriteria1 = $op1 / $op2;
                    } else {
                        $totalKriteria1 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si1 = $kriteria1->BobotKriteria * $totalKriteria1;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi1 = pow($totalKriteria1, $kriteria1->BobotKriteria);
                }
            }

            // Mencari nilai untuk kriteria 2
            $kriteriaSQL2 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C2'));
            foreach ($kriteriaSQL2 as $kriteria2) {

                if ($kriteria2->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C2');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C2');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $op1 = $alternatif->C2 - $nilaiMin->row()->C2;
                    $op2 = $nilaiMax->row()->C2 - $nilaiMin->row()->C2;

                    if ($op2 != 0) {
                        $totalKriteria2 = $op1 / $op2;
                    } else {
                        $totalKriteria2 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si2 = $kriteria2->BobotKriteria * $totalKriteria2;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi2 = pow($totalKriteria2, $kriteria2->BobotKriteria);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C2');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C2');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 2 (Jarak Lokasi)
                    $op1 = $nilaiMax->row()->C2 - $alternatif->C2;
                    $op2 = $nilaiMax->row()->C2 - $nilaiMin->row()->C2;

                    if ($op2 != 0) {
                        $totalKriteria2 = $op1 / $op2;
                    } else {
                        $totalKriteria2 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si2 = $kriteria2->BobotKriteria * $totalKriteria2;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi2 = pow($totalKriteria2, $kriteria2->BobotKriteria);
                }
            }

            // Mencari nilai untuk kriteria 3
            $kriteriaSQL3 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C3'));
            foreach ($kriteriaSQL3 as $kriteria3) {

                if ($kriteria3->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C3');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C3');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $op1 = $alternatif->C3 - $nilaiMin->row()->C3;
                    $op2 = $nilaiMax->row()->C3 - $nilaiMin->row()->C3;

                    if ($op2 != 0) {
                        $totalKriteria3 = $op1 / $op2;
                    } else {
                        $totalKriteria3 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si3 = $kriteria3->BobotKriteria * $totalKriteria3;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi3 = pow($totalKriteria3, $kriteria3->BobotKriteria);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C3');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C3');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 3 (Harga Sewa)
                    $op1 = $nilaiMax->row()->C3 - $alternatif->C3;
                    $op2 = $nilaiMax->row()->C3 - $nilaiMin->row()->C3;

                    if ($op2 != 0) {
                        $totalKriteria3 = $op1 / $op2;
                    } else {
                        $totalKriteria3 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si3 = $kriteria3->BobotKriteria * $totalKriteria3;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi3 = pow($totalKriteria3, $kriteria3->BobotKriteria);
                }
            }

            // Mencari nilai untuk kriteria 4
            $kriteriaSQL4 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C4'));
            foreach ($kriteriaSQL4 as $kriteria4) {

                if ($kriteria4->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C4');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C4');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $op1 = $alternatif->C4 - $nilaiMin->row()->C4;
                    $op2 = $nilaiMax->row()->C4 - $nilaiMin->row()->C4;

                    if ($op2 != 0) {
                        $totalKriteria4 = $op1 / $op2;
                    } else {
                        $totalKriteria4 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si4 = $kriteria4->BobotKriteria * $totalKriteria4;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi4 = pow($totalKriteria4, $kriteria4->BobotKriteria);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C4');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C4');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 4 (Pesaing)
                    $op1 = $nilaiMax->row()->C4 - $alternatif->C4;
                    $op2 = $nilaiMax->row()->C4 - $nilaiMin->row()->C4;

                    if ($op2 != 0) {
                        $totalKriteria4 = $op1 / $op2;
                    } else {
                        $totalKriteria4 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si4 = $kriteria4->BobotKriteria * $totalKriteria4;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi4 = pow($totalKriteria4, $kriteria4->BobotKriteria);
                }
            }

            // Mencari nilai untuk kriteria 5
            $kriteriaSQL5 = $CI->kriteria_model->get_kriteria(array('KodeKriteria' => 'C5'));
            foreach ($kriteriaSQL5 as $kriteria5) {

                if ($kriteria5->JenisKriteria == 'Benefit') {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C5');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C5');

                    // Menghitung normalisasi benefit dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $op1 = $alternatif->C5 - $nilaiMin->row()->C5;
                    $op2 = $nilaiMax->row()->C5 - $nilaiMin->row()->C5;

                    if ($op2 != 0) {
                        $totalKriteria5 = $op1 / $op2;
                    } else {
                        $totalKriteria5 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si5 = $kriteria5->BobotKriteria * $totalKriteria5;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi5 = pow($totalKriteria5, $kriteria5->BobotKriteria);
                } else {
                    // Mencari nilai maksimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMax = $CI->alternatif_model->max_alternatif('C5');
                    // Mencari nilai minimum dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $nilaiMin = $CI->alternatif_model->min_alternatif('C5');

                    // Menghitung normalisasi cost dari seluruh alternatif untuk kriteria 5 (Akses Jalan)
                    $op1 = $nilaiMax->row()->C5 - $alternatif->C5;
                    $op2 = $nilaiMax->row()->C5 - $nilaiMin->row()->C5;

                    if ($op2 != 0) {
                        $totalKriteria5 = $op1 / $op2;
                    } else {
                        $totalKriteria5 = 0;
                    }
                    // Menghitung nilai si bobot kriteria x hasil normalisasi
                    $nilai_si5 = $kriteria5->BobotKriteria * $totalKriteria5;

                    // Menghitung nilai pi hasil normalisasi ^ bobot kriteria 
                    $nilai_pi5 = pow($totalKriteria5, $kriteria5->BobotKriteria);
                }
            }

            // Jumlahkan nilai si seluruh kriteria dari keseluruhan alternatif
            $arraySumSi[] = $nilai_si1 + $nilai_si2 + $nilai_si3 + $nilai_si4 + $nilai_si5;
            $total_sum_si = $nilai_si1 + $nilai_si2 + $nilai_si3 + $nilai_si4 + $nilai_si5;
            // Jumlahkan nilai pi seluruh kriteria dari keseluruhan alternatif
            $arraySumPi[] = $nilai_pi1 + $nilai_pi2 + $nilai_pi3 + $nilai_pi4 + $nilai_pi5;
            $total_sum_pi = $nilai_pi1 + $nilai_pi2 + $nilai_pi3 + $nilai_pi4 + $nilai_pi5;

            // Jumlakan seluruh nilai si + pi pada seluruh alternatif
            $arraySumSiPi[] = $total_sum_si + $total_sum_pi;
        }


        // Menghitung nilai kia dan rangking
        // Jumlah keseluruhan array si + pi
        $sumArraySiPi = array_sum($arraySumSiPi);
        foreach ($arraySumSiPi as $total_si_pi) {
            // Rumus menghitung nilai kia : total jumlah keseluruhan si + pi / jumlah si + pi dari alternatif
            $arrayKia[] = number_format($total_si_pi / $sumArraySiPi, 4);
        }

        // ----------------------------------------------------------------------------------------------

        // Menghitung nilai kib dan rangking
        // Definisikan nilai min pada si dan nilai min pada pi
        $minSi = min($arraySumSi);
        $minPi = min($arraySumPi);

        $arrayCollectMinSiPiKib = [
            'si_kib' => $arraySumSi,
            'pi_kib' => $arraySumPi,
        ];

        foreach ($arrayCollectMinSiPiKib['si_kib'] as $key => $si_kib) {
            // Rumus menghitung nilai kib : nilai si dari alternatif / nilai minimum si + nilai pi alternatif / nilai minimum dari pi
            $op_kib1 = $si_kib / $minSi;
            $op_kib2 = $arrayCollectMinSiPiKib['pi_kib'][$key] / $minPi;

            $kib = $op_kib1 + $op_kib2;
            $arrayKib[] = number_format($kib, 4);
        }


        // ----------------------------------------------------------------------------------------------

        // Menghitung nilai kic dan rangking
        // Definisikan nilai max pada si dan nilai max pada pi
        $maxSi = max($arraySumSi);
        $maxPi = max($arraySumPi);

        $arrayCollectMaxSiPiKic = [
            'si_kic' => $arraySumSi,
            'pi_kic' => $arraySumPi,
        ];

        foreach ($arrayCollectMaxSiPiKic['si_kic'] as $key => $si_kic) {

            // Rumus menghitung nilai kic ((0.5 * nilai si dari alternatif ) + ((1 - 0.5) * nilai pi dari alternatif)) / ((0.5 * nilai maksimum si) + ((1 - 0.5) * nilai maksimum pi));
            $kic = ((0.5 * $si_kic) + ((1 - 0.5) * $arrayCollectMaxSiPiKic['pi_kic'][$key])) / ((0.5 * $maxSi) + ((1 - 0.5) * $maxPi));

            $arrayKic[] = number_format($kic, 4);
        }

        // ----------------------------------------------------------------------------------------------
        // Menghitung nilai ki dan rangking
        // Definisikan array hasil perhitungan nilai kia, kib, kic
        $mergeKiaKibKic = [
            'Kia' => $arrayKia,
            'Kib' => $arrayKib,
            'Kic' => $arrayKic,
        ];


        foreach ($mergeKiaKibKic['Kia'] as $key => $kia) {
            // Hitung kia * kib * kic ^ 1 / 3
            $op_ki1 = $kia * $mergeKiaKibKic['Kib'][$key] * $mergeKiaKibKic['Kic'][$key];

            // Pangkat 1/3
            $pangkat_1per3 = 1 / 3;
            $op_ki2 = pow($op_ki1, $pangkat_1per3);

            // Hitung 1 / 3 * kia + kib + kic 
            $op_ki3 = $pangkat_1per3 * ($kia + $mergeKiaKibKic['Kib'][$key] + $mergeKiaKibKic['Kic'][$key]);
            $ki = $op_ki2 + $op_ki3;

            $arrayKi[] = number_format($ki, 4);
        }


        // Buat salinan array asli untuk menyimpan indeksnya
        $sortedArrayKi = $arrayKi;

        // Urutkan array secara descending
        rsort($sortedArrayKi, SORT_NUMERIC);

        // Inisialisasi array untuk menyimpan peringkat
        $rankingKi = [];

        // Tentukan peringkat untuk setiap elemen dalam data asli
        foreach ($arrayKi as $value) {
            $rankingKi[] = array_search($value, $sortedArrayKi) + 1;
        }

        $mergeKi = [
            'KodeAlternatif' => $arrayKodeAlternatif,
            'NamaAlternatif' => $arrayNamaAlternatif,
            'Kia' => $arrayKia,
            'Kib' => $arrayKib,
            'Kic' => $arrayKic,
            'Ki' => $arrayKi,
            'RangkingKi' => $rankingKi
        ];

        // Fungsi untuk mengurutkan array berdasarkan nilai ki secara ascending
        array_multisort($mergeKi['Ki'], SORT_DESC, $mergeKi['KodeAlternatif'], $mergeKi['NamaAlternatif'], $mergeKi['Kia'], $mergeKi['Kib'], $mergeKi['Kic'], $mergeKi['RangkingKi']);

        return $mergeKi;
    } else {
        // Jika validasi error maka kembali kehalaman perhitungan
        $CI->session->set_flashdata('error', 'Kesalahan function nilai_ki pada helper perhitungan metode cocoso !');
        return redirect(site_url('dashboard/perhitungan'));
    }
}
/* End of file cocoso_helper.php and path \application\helpers\cocoso_helper.php */

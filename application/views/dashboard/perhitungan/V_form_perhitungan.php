<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Manajemen Perhitungan </h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Kelola Perhitungan</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?php echo $title_form ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header"><i class="fas fa-book"></i> Data
                        <?php echo $title_form ?>
                    </h5>
                    <div class="card-body">
                        <blockquote class="blockquote">
                            <p class="mb-1">Menampilkan Seluruh Data Perhitungan Tanggal :
                                <?php echo $tanggal ?>
                            </p>
                            <footer class="blockquote-footer" style="font-size: 14px;">Sistem Pendukung Keputusan Sistem
                                Pendukung keputusan
                                Optimalisasi Lokasi Cabang UP Parfum Menggunakan <br>
                                <cite title="Source Title">Metode Combined Compromise Solution (COCOSO)</cite>
                            </footer>
                        </blockquote>
                    </div>
                    <div class="card-body border-top">
                        <div class="tab-vertical">
                            <ul class="nav nav-tabs" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="bobot-preferensi-tab" data-toggle="tab" href="#bobot-preferensi" role="tab" aria-controls="bobot-preferensi" aria-selected="false">Bobot Preferensi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="matrik-keputusan-tab" data-toggle="tab" href="#matrik-keputusan" role="tab" aria-controls="matrik-keputusan" aria-selected="false">Matrik Keputusan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="normalisasi-matrik-tab" data-toggle="tab" href="#normalisasi-matrik" role="tab" aria-controls="normalisasi-matrikk" aria-selected="true">Normalisasi Matrik</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nilai-si-pi-tab" data-toggle="tab" href="#nilai-si-pi" role="tab" aria-controls="nilai-si-pi" aria-selected="false">Nilai Si dan Pi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nilai-kiabc-tab" data-toggle="tab" href="#nilai-kiabc" role="tab" aria-controls="nilai-kiabc" aria-selected="false">Nilai Kia, Kib,
                                        Kic</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nilai-ki-tab" data-toggle="tab" href="#nilai-ki" role="tab" aria-controls="nilai-ki" aria-selected="false">Nilai Ki</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent3">
                                <div class="tab-pane fade active show" id="bobot-preferensi" role="tabpanel" aria-labelledby="bobot-preferensi-tab">
                                    <h3>Menampilkan Bobot Preferensi</h3>
                                    <div class="table-reponsive">
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Kriteria</th>
                                                    <th>Nama Kriteria</th>
                                                    <th>Bobot Kriteria</th>
                                                    <th>Jenis Kriteria</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($kriteria as $item_kriteria) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $no ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item_kriteria->KodeKriteria ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item_kriteria->NamaKriteria ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item_kriteria->BobotKriteria ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item_kriteria->JenisKriteria ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="matrik-keputusan" role="tabpanel" aria-labelledby="matrik-keputusan-tab">
                                    <h3>Menampilkan Matrik Keputusan</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Alternatif</th>
                                                    <th>Nama Alternatif</th>
                                                    <th>C1</th>
                                                    <th>C2</th>
                                                    <th>C3</th>
                                                    <th>C4</th>
                                                    <th>C5</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                function alphanum_compare($a, $b)
                                                {
                                                    return strnatcmp($a->KodeAlternatif, $b->KodeAlternatif);
                                                }
                                                usort($m_keputusan, 'alphanum_compare');
                                                foreach ($m_keputusan as $matrik_keputusan) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $no; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $matrik_keputusan->KodeAlternatif ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $matrik_keputusan->NamaAlternatif ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $matrik_keputusan->C1 ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $matrik_keputusan->C2 ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $matrik_keputusan->C3 ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $matrik_keputusan->C4 ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $matrik_keputusan->C5 ?>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="normalisasi-matrik" role="tabpanel" aria-labelledby="normalisasi-matrik-tab">
                                    <h3>Menampilkan Normalisasi Matrik</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Alternatif</th>
                                                    <th>Nama Alternatif</th>
                                                    <th>C1</th>
                                                    <th>C2</th>
                                                    <th>C3</th>
                                                    <th>C4</th>
                                                    <th>C5</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $kodeAlternatif = $n_matrik['KodeAlternatif'];
                                                natsort($kodeAlternatif);

                                                foreach ($kodeAlternatif as $kode) {
                                                    $index = array_search($kode, $n_matrik['KodeAlternatif']);
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $no; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_matrik['KodeAlternatif'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_matrik['NamaAlternatif'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_matrik['C1'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_matrik['C2'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_matrik['C3'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_matrik['C4'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_matrik['C5'][$index] ?>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nilai-si-pi" role="tabpanel" aria-labelledby="nilai-si-pi-tab">
                                    <h3>Menampilkan Nilai Si</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Alternatif</th>
                                                    <th>Nama Alternatif</th>
                                                    <th>C1</th>
                                                    <th>C2</th>
                                                    <th>C3</th>
                                                    <th>C4</th>
                                                    <th>C5</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $kodeAlternatif = $n_si['KodeAlternatif'];
                                                natsort($kodeAlternatif);

                                                foreach ($kodeAlternatif as $kode) {
                                                    $index = array_search($kode, $n_si['KodeAlternatif']);
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $no; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_si['KodeAlternatif'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_si['NamaAlternatif'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_si['C1'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_si['C2'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_si['C3'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_si['C4'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_si['C5'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_si['Total'][$index] ?>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <h3>Menampilkan Nilai Pi</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Alternatif</th>
                                                    <th>Nama Alternatif</th>
                                                    <th>C1</th>
                                                    <th>C2</th>
                                                    <th>C3</th>
                                                    <th>C4</th>
                                                    <th>C5</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $kodeAlternatif = $n_pi['KodeAlternatif'];
                                                natsort($kodeAlternatif);

                                                foreach ($kodeAlternatif as $kode) {
                                                    $index = array_search($kode, $n_pi['KodeAlternatif']);
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $no; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_pi['KodeAlternatif'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_pi['NamaAlternatif'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_pi['C1'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_pi['C2'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_pi['C3'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_pi['C4'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_pi['C5'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_pi['Total'][$index] ?>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nilai-kiabc" role="tabpanel" aria-labelledby="nilai-kiabc-tab">
                                    <h3>Menampilkan Nilai Kia, Kib, Kic</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first" style="font-size:13px;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Alternatif</th>
                                                    <th>Nama Alternatif</th>
                                                    <th>Kia</th>
                                                    <th>Rangking Kia</th>
                                                    <th>Kib</th>
                                                    <th>Rangking Kib</th>
                                                    <th>Kic</th>
                                                    <th>Rangking Kic</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $kodeAlternatif = $n_kia_kib_kic['KodeAlternatif'];
                                                natsort($kodeAlternatif);

                                                foreach ($kodeAlternatif as $kode) {
                                                    $index = array_search($kode, $n_kia_kib_kic['KodeAlternatif']);
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $no; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_kia_kib_kic['KodeAlternatif'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_kia_kib_kic['NamaAlternatif'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_kia_kib_kic['Kia'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_kia_kib_kic['RangkingKia'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_kia_kib_kic['Kib'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_kia_kib_kic['RangkingKib'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_kia_kib_kic['Kic'][$index] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_kia_kib_kic['RangkingKic'][$index] ?>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nilai-ki" role="tabpanel" aria-labelledby="nilai-ki-tab">
                                    <h3>Menampilkan Nilai Ki</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Alternatif</th>
                                                    <th>Nama Alternatif</th>
                                                    <th>Ki</th>
                                                    <th>Rangking Ki</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($n_ki['KodeAlternatif'] as $key => $value) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $no; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_ki['KodeAlternatif'][$key] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_ki['NamaAlternatif'][$key] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_ki['Ki'][$key] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $n_ki['RangkingKi'][$key] ?>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#modalSimpan" class="btn btn-primary btn-sm mt-2" style="float:right"><i class="fas fa-save"></i>
                            Simpan Perhitungan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    Copyright © 2024 Sarah Yuliah Hulwah | Prodi Sistem Informasi | STMIK Triguna Dharma
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalSimpan" tabindex="-1" role="dialog" aria-labelledby="modalSimpan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo form_open(site_url('perhitungan/simpan_perhitungan')) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalSimpan">
                    Simpan Perhitungan ?
                </h5>
            </div>
            <div class="modal-body">
                <div class="form-group" hidden>
                    <input class="form-control" type="text" value="<?php echo $tanggal ?>" readonly name="Tanggal">
                </div>
                <p>
                    Apakah anda ingin menyimpan proses perhitungan ini ?
                </p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-check"></i> Simpan
                </button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
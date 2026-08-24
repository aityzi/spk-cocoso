<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Manajemen Alternatif </h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Kelola Alternatif</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Alternatif</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header"><i class="fas fa-book"></i> Data Alternatif</h5>
                    <div class="card-body">
                        <blockquote class="blockquote">
                            <p class="mb-1">Menampilkan Seluruh Data Alternatif </p>
                            <footer class="blockquote-footer" style="font-size: 14px;">Sistem Pendukung Keputusan Sistem
                                Pendukung Keputusan
                                Optimalisasi Lokasi Cabang UP Parfum Menggunakan <br>
                                <cite title="Source Title">Metode Combined Compromise Solution (COCOSO)</cite>
                            </footer>
                            <a href="<?php echo site_url('alternatif/form_alternatif/add') ?>" class="btn btn-primary btn-sm mt-2"><i class="fas fa-plus-circle"></i> Tambah
                                Alternatif</a>
                        </blockquote>
                    </div>
                    <div class="card-body border-top">
                        <?php echo validation_errors() ?>
                        <?php
                        if ($this->session->flashdata('pesan')) {
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Pesan : </strong>
                                <?php echo $this->session->flashdata('pesan') ?>
                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </a>
                            </div>
                        <?php
                        } elseif ($this->session->flashdata('error')) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Pesan : </strong>
                                <?php echo $this->session->flashdata('error') ?>
                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kode Alternatif</th>
                                        <th>Nama Alternatif</th>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>Kelola</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($alternatif as $data) {
                                        // Ubah konversi tanggal pada form menjadi tanggal pada database mysql
                                        $form_date = $data->Tanggal;
                                        $split_date = explode('-', $form_date);
                                        $merge_date = array($split_date[2], $split_date[1], $split_date[0]);
                                        $konversi_date = implode('-', $merge_date);
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $no; ?>
                                            </td>
                                            <td>
                                                <?php echo $konversi_date ?>
                                            </td>
                                            <td>
                                                <?php echo $data->KodeAlternatif ?>
                                            </td>
                                            <td>
                                                <?php echo $data->NamaAlternatif ?>
                                            </td>
                                            <td>
                                                <?php echo $data->C1 ?>
                                            </td>
                                            <td>
                                                <?php echo $data->C2 ?>
                                            </td>
                                            <td>
                                                <?php echo $data->C3 ?>
                                            </td>
                                            <td>
                                                <?php echo $data->C4 ?>
                                            </td>
                                            <td>
                                                <?php echo $data->C5 ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('alternatif/form_alternatif/update') ?>/<?php echo $data->KodeAlternatif ?>" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalHapus<?php echo $no ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalHapus<?php echo $no ?>" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel<?php echo $no ?>" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalHapusLabel<?php echo $no ?>">
                                                                    Hapus
                                                                    Alternatif ?
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-striped">
                                                                    <tr>
                                                                        <td>Kode Alternatif</td>
                                                                        <td>:
                                                                            <?php echo $data->KodeAlternatif ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Nama Alternatif</td>
                                                                        <td>:
                                                                            <?php echo $data->NamaAlternatif ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Batal
                                                                </a>
                                                                <a href="<?php echo site_url('alternatif/hapus_alternatif') ?>/<?php echo $data->KodeAlternatif ?>" class="btn btn-primary btn-sm">
                                                                    <i class="fas fa-check"></i> Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
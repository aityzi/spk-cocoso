<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Manajemen Kriteria </h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Kelola Kriteria</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detil Sub Kriteria</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header"><i class="fas fa-book"></i> Detil Sub Kriteria</h5>
                    <div class="card-body">
                        <blockquote class="blockquote">
                            <?php
                            foreach ($subKriteria as $item) {
                            }
                            ?>
                            <p class="mb-1">Menampilkan Detil Sub Kriteria :
                                <b>
                                    <?php echo $item->NamaKriteria ?>
                                </b>
                            </p>
                            <footer class="blockquote-footer" style="font-size: 14px;">Sistem Pendukung Keputusan Sistem
                                Pendukung Keputusan
                                Optimalisasi Lokasi Cabang UP Parfum Menggunakan <br>
                                <cite title="Source Title">Metode Combined Compromise Solution (COCOSO)</cite>
                            </footer>
                        </blockquote>
                    </div>
                    <div class="card-body border-top">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="50px">No</td>
                                    <td width="150px">Nilai</td>
                                    <td>Keterangan</td>
                                    <td>Kelola</td>
                                </tr>
                                <?php $no = 1;
                                foreach ($subKriteria as $data) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $no ?>
                                        </td>
                                        <td>
                                            <?php echo $data->Nilai ?>
                                        </td>
                                        <td>
                                            <?php echo $data->Keterangan ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url('kriteria/form_sub_kriteria/update') ?>/<?php echo $data->KodeSubKriteria ?>" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></a>
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
                                                                Sub Kriteria ?
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda ingin menghapus kriteria :
                                                            <?php echo $data->NamaKriteria ?> dengan nilai :
                                                            <?php echo $data->Nilai ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Batal
                                                            </a>
                                                            <a href="<?php echo site_url('kriteria/hapus_sub_kriteria') ?>/<?php echo $data->KodeSubKriteria ?>" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-check"></i> Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="<?php echo site_url('dashboard/sub_kriteria') ?>" class="btn btn-danger btn-sm"><i class="fas fa-reply"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer" style="margin-top: 190px;">
        <div class=" container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    Copyright © 2024 Sarah Yuliah Hulwah | Prodi Sistem Informasi | STMIK Triguna Dharma
                </div>
            </div>
        </div>
    </div>
</div>
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
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Kriteria</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?php echo $title_form; ?>
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
                    <h5 class="card-header"><i class="fas fa-book"></i>
                        <?php echo $title_form; ?>
                    </h5>
                    <div class="card-body">
                        <blockquote class="blockquote">
                            <p class="mb-1">Form
                                <?php echo $title_form; ?>
                            </p>
                            <footer class="blockquote-footer" style="font-size: 14px;">Sistem Pendukung Keputusan Sistem
                                Pendukung Keputusan
                                Optimalisasi Lokasi Cabang UP Parfum Menggunakan <br>
                                <cite title="Source Title">Metode Combined Compromise Solution (COCOSO)</cite>
                            </footer>
                        </blockquote>
                    </div>
                    <div class="card-body border-top">
                        <?php echo validation_errors() ?>
                        <?php echo form_open(site_url('kriteria/simpan_kriteria')) ?>
                        <?php
                        if ($kriteria) {
                            foreach ($kriteria as $data) {
                        ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" hidden>
                                            <label for="FormParameter" class="col-form-label">
                                                Form Parameter <span style="color:red;">*</span>
                                            </label>
                                            <input id="FormParameter" type="text" class="form-control" autocomplete="off" placeholder="Masukan Kode Kriteria" name="FormParameter" required value="<?php echo $form ?>" readonly>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="KodeKriteriaD" class="col-form-label">
                                                Kode Kriteria <span style="color:red;">*</span>
                                            </label>
                                            <input id="KodeKriteriaD" type="text" class="form-control" autocomplete="off" placeholder="Masukan Kode Kriteria" name="KodeKriteriaD" required value="<?php echo $data->KodeKriteria ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="KodeKriteria" class="col-form-label">
                                                Kode Kriteria <span style="color:red;">*</span>
                                            </label>
                                            <input id="KodeKriteria" type="text" class="form-control" autocomplete="off" placeholder="Masukan Kode Kriteria" name="KodeKriteria" required value="<?php echo $data->KodeKriteria ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="NamaKriteria" class="col-form-label">
                                                Nama Kriteria <span style="color:red;">*</span>
                                            </label>
                                            <input id="NamaKriteria" type="text" class="form-control" autocomplete="off" placeholder="Masukan Nama Kriteria" name="NamaKriteria" required value="<?php echo $data->NamaKriteria ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="BobotKriteria" class="col-form-label">
                                                Bobot Kriteria <span style="color:red;">*</span>
                                            </label>
                                            <input id="BobotKriteria" type="text" class="form-control" autocomplete="off" placeholder="Masukan Bobot Kriteria" name="BobotKriteria" required value="<?php echo $data->BobotKriteria ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="JenisKriteria" class="col-form-label">
                                                Jenis Kriteria <span style="color:red;">*</span>
                                            </label>
                                            <select name="JenisKriteria" class="form-control" id="JenisKriteria" required>
                                                <option value="">-- Pilih Jenis Kriteria --</option>
                                                <?php
                                                if ($data->JenisKriteria == 'Benefit') {
                                                ?>
                                                    <option value="Benefit" selected>Benefit</option>
                                                    <option value="Cost">Cost</option>
                                                <?php
                                                } elseif ($data->JenisKriteria == 'Cost') {
                                                ?>
                                                    <option value="Benefit">Benefit</option>
                                                    <option value="Cost" selected>Cost</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" hidden>
                                        <label for="FormParameter" class="col-form-label">
                                            Form Parameter <span style="color:red;">*</span>
                                        </label>
                                        <input id="FormParameter" type="text" class="form-control" autocomplete="off" placeholder="Masukan Kode Kriteria" name="FormParameter" required value="<?php echo $form ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="KodeKriteria" class="col-form-label">
                                            Kode Kriteria <span style="color:red;">*</span>
                                        </label>
                                        <input id="KodeKriteria" type="text" class="form-control" autocomplete="off" placeholder="Masukan Kode Kriteria" name="KodeKriteria" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="NamaKriteria" class="col-form-label">
                                            Nama Kriteria <span style="color:red;">*</span>
                                        </label>
                                        <input id="NamaKriteria" type="text" class="form-control" autocomplete="off" placeholder="Masukan Nama Kriteria" name="NamaKriteria" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="BobotKriteria" class="col-form-label">
                                            Bobot Kriteria <span style="color:red;">*</span>
                                        </label>
                                        <input id="BobotKriteria" type="text" class="form-control" autocomplete="off" placeholder="Masukan Bobot Kriteria" name="BobotKriteria" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="JenisKriteria" class="col-form-label">
                                            Jenis Kriteria <span style="color:red;">*</span>
                                        </label>
                                        <select name="JenisKriteria" class="form-control" id="JenisKriteria" required>
                                            <option value="">-- Pilih Jenis Kriteria --</option>
                                            <option value="Benefit">Benefit</option>
                                            <option value="Cost">Cost</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <button type="reset" class="btn btn-warning btn-sm">
                                    <i class="fas fa-redo"></i>
                                    Reset
                                </button>
                                <a href="<?php echo site_url('dashboard/kriteria') ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-reply"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="footer" style="margin-top:170px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    Copyright © 2024 Sarah Yuliah Hulwah | Prodi Sistem Informasi | STMIK Triguna Dharma
                </div>
            </div>
        </div>
    </div>
</div>
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
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Sub Kriteria</a></li>
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
                                Pendukung keputusan
                                Optimalisasi Lokasi Cabang UP Parfum Menggunakan <br>
                                <cite title="Source Title">Metode Combined Compromise Solution (COCOSO)</cite>
                            </footer>
                        </blockquote>
                    </div>
                    <div class="card-body border-top">
                        <?php echo validation_errors() ?>
                        <?php echo form_open(site_url('kriteria/simpan_sub_kriteria')) ?>
                        <?php
                        if ($subKriteria) {
                            foreach ($subKriteria as $item) {
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
                                            <label for="KodeSubKriteria" class="col-form-label">
                                                Form Parameter <span style="color:red;">*</span>
                                            </label>
                                            <input id="KodeSubKriteria" type="text" class="form-control" autocomplete="off" placeholder="Masukan Kode Sub Kriteria" name="KodeSubKriteria" required value="<?php echo $item->KodeSubKriteria ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="Kriteria" class="col-form-label">
                                                Kriteria Kriteria <span style="color:red;">*</span>
                                            </label>
                                            <select name="Kriteria" class="form-control" id="Kriteria" required>
                                                <option value="">-- Pilih Kriteria -- </option>
                                                <?php
                                                foreach ($kriteria as $item_kriteria) {
                                                    if ($item->KodeKriteria == $item_kriteria->KodeKriteria) {
                                                ?>
                                                        <option selected value="<?php echo $item_kriteria->KodeKriteria ?>">
                                                            <?php echo $item_kriteria->KodeKriteria ?> |
                                                            <?php echo $item_kriteria->NamaKriteria ?>
                                                        </option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $item_kriteria->KodeKriteria ?>">
                                                            <?php echo $item_kriteria->KodeKriteria ?> |
                                                            <?php echo $item_kriteria->NamaKriteria ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="NilaiSubKriteria" class="col-form-label">
                                                Nilai Sub Kriteria <span style="color:red;">*</span>
                                            </label>
                                            <input id="NilaiSubKriteria" type="text" class="form-control" autocomplete="off" placeholder="Masukan Nilai Sub Kriteria" name="NilaiSubKriteria" required value="<?php echo $item->Nilai ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Keterangan" class="col-form-label">
                                                Keterangan <span style="color:red;">*</span>
                                            </label>
                                            <textarea name="Keterangan" id="Keterangan" class="form-control" required rows="4" placeholder="Masukan Keterangan Sub Kriteria"><?php echo $item->Keterangan ?></textarea>
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
                                        <label for="Kriteria" class="col-form-label">
                                            Kriteria Kriteria <span style="color:red;">*</span>
                                        </label>
                                        <select name="Kriteria" class="form-control" id="Kriteria" required>
                                            <option value="">-- Pilih Kriteria -- </option>
                                            <?php
                                            foreach ($kriteria as $item) {
                                            ?>
                                                <option value="<?php echo $item->KodeKriteria ?>">
                                                    <?php echo $item->KodeKriteria ?> |
                                                    <?php echo $item->NamaKriteria ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="NilaiSubKriteria" class="col-form-label">
                                            Nilai Sub Kriteria <span style="color:red;">*</span>
                                        </label>
                                        <input id="NilaiSubKriteria" type="text" class="form-control" autocomplete="off" placeholder="Masukan Nilai Sub Kriteria" name="NilaiSubKriteria" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Keterangan" class="col-form-label">
                                            Keterangan <span style="color:red;">*</span>
                                        </label>
                                        <textarea name="Keterangan" id="Keterangan" class="form-control" required rows="4" placeholder="Masukan Keterangan Sub Kriteria"></textarea>
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
                                <a href="<?php echo site_url('dashboard/sub_kriteria') ?>" class="btn btn-danger btn-sm">
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
    <div class="footer" style="margin-top:175px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    Copyright © 2024 Sarah Yuliah Hulwah | Prodi Sistem Informasi | STMIK Triguna Dharma
                </div>
            </div>
        </div>
    </div>
</div>
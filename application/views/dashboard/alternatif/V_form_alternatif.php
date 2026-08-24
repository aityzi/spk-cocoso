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
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Alternatif</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?php echo $title_form; ?> Alternatif
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
                        <?php echo validation_errors();
                        error_reporting(0) ?>
                        <?php echo form_open(site_url('alternatif/simpan_alternatif')) ?>
                        <?php
                        if ($alternatif) {
                            foreach ($alternatif as $item) {
                                // Ubah konversi tanggal pada form menjadi tanggal pada database mysql
                                $form_date = $item->Tanggal;
                                $split_date = explode('-', $form_date);
                                $merge_date = array($split_date[1], $split_date[2], $split_date[0]);
                                $konversi_date = implode('/', $merge_date);
                        ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" hidden>
                                            <label for="FormParameter" class="col-form-label">
                                                Form Parameter <span style="color:red;">*</span>
                                            </label>
                                            <input id="FormParameter" type="text" class="form-control" autocomplete="off" placeholder="Masukan Form Parameter" name="FormParameter" required value="<?php echo $form ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="Tanggal" class="col-form-label">
                                                Tanggal <span style="color:red;">*</span>
                                            </label>
                                            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" name="Tanggal" autocomplete="off" required value="<?php echo $konversi_date ?>">
                                                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="KodeAlternatifD" class="col-form-label">
                                                Kode Alternatif <span style="color:red;">*</span>
                                            </label>
                                            <input id="KodeAlternatifD" type="text" class="form-control" autocomplete="off" placeholder="Masukan Kode Alternatif" name="KodeAlternatifD" value="<?php echo $item->KodeAlternatif ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="KodeAlternatif" class="col-form-label">
                                                Kode Alternatif <span style="color:red;">*</span>
                                            </label>
                                            <input id="KodeAlternatif" type="text" class="form-control" autocomplete="off" placeholder="Masukan Kode Alternatif" name="KodeAlternatif" value="<?php echo $item->KodeAlternatif ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="NamaAlternatif" class="col-form-label">
                                                Nama Alternatif <span style="color:red;">*</span>
                                            </label>
                                            <input id="NamaAlternatif" type="text" class="form-control" autocomplete="off" placeholder="Masukan Nama Alternatif" name="NamaAlternatif" value="<?php echo $item->NamaAlternatif ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php foreach ($subKriteria1 as $namaSub1) {
                                            } ?>
                                            <label for="SubKriteria1" class="col-form-label">
                                                Kriteria :
                                                <?php echo $namaSub1->NamaKriteria ?> (
                                                <?php echo $namaSub1->KodeKriteria ?>) <span style="color:red;">*</span>
                                            </label>
                                            <select name="SubKriteria1" id="SubKriteria1" class="form-control" required>
                                                <option value="">-- Pilih Nilai -- </option>
                                                <?php
                                                foreach ($subKriteria1 as $sub1) {
                                                    if ($sub1->Nilai == $item->C1) {
                                                ?>
                                                        <option selected value="<?php echo $sub1->Nilai ?>">
                                                            <?php echo $sub1->Nilai ?> |
                                                            <?php echo $sub1->Keterangan ?>
                                                        </option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $sub1->Nilai ?>">
                                                            <?php echo $sub1->Nilai ?> |
                                                            <?php echo $sub1->Keterangan ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php foreach ($subKriteria2 as $namaSub2) {
                                            } ?>
                                            <label for="SubKriteria2" class="col-form-label">
                                                Kriteria :
                                                <?php echo $namaSub2->NamaKriteria ?> (
                                                <?php echo $namaSub2->KodeKriteria ?>) <span style="color:red;">*</span>
                                            </label>
                                            <select name="SubKriteria2" id="SubKriteria2" class="form-control" required>
                                                <option value="">-- Pilih Nilai -- </option>
                                                <?php
                                                foreach ($subKriteria2 as $sub2) {
                                                    if ($sub2->Nilai == $item->C2) {
                                                ?>
                                                        <option selected value="<?php echo $sub2->Nilai ?>">
                                                            <?php echo $sub2->Nilai ?> |
                                                            <?php echo $sub2->Keterangan ?>
                                                        </option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $sub2->Nilai ?>">
                                                            <?php echo $sub2->Nilai ?> |
                                                            <?php echo $sub2->Keterangan ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php foreach ($subKriteria3 as $namaSub3) {
                                            } ?>
                                            <label for="SubKriteria3" class="col-form-label">
                                                Kriteria :
                                                <?php echo $namaSub3->NamaKriteria ?> (
                                                <?php echo $namaSub3->KodeKriteria ?>) <span style="color:red;">*</span>
                                            </label>
                                            <select name="SubKriteria3" id="SubKriteria3" class="form-control" required>
                                                <option value="">-- Pilih Nilai -- </option>
                                                <?php
                                                foreach ($subKriteria3 as $sub3) {
                                                    if ($sub3->Nilai == $item->C3) {
                                                ?>
                                                        <option selected value="<?php echo $sub3->Nilai ?>">
                                                            <?php echo $sub3->Nilai ?> |
                                                            <?php echo $sub3->Keterangan ?>
                                                        </option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $sub3->Nilai ?>">
                                                            <?php echo $sub3->Nilai ?> |
                                                            <?php echo $sub3->Keterangan ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php foreach ($subKriteria4 as $namaSub4) {
                                            } ?>
                                            <label for="SubKriteria4" class="col-form-label">
                                                Kriteria :
                                                <?php echo $namaSub4->NamaKriteria ?> (
                                                <?php echo $namaSub4->KodeKriteria ?>) <span style="color:red;">*</span>
                                            </label>
                                            <select name="SubKriteria4" id="SubKriteria4" class="form-control" required>
                                                <option value="">-- Pilih Nilai -- </option>
                                                <?php
                                                foreach ($subKriteria4 as $sub4) {
                                                    if ($sub4->Nilai == $item->C4) {
                                                ?>
                                                        <option selected value="<?php echo $sub4->Nilai ?>">
                                                            <?php echo $sub4->Nilai ?> |
                                                            <?php echo $sub4->Keterangan ?>
                                                        </option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $sub4->Nilai ?>">
                                                            <?php echo $sub4->Nilai ?> |
                                                            <?php echo $sub4->Keterangan ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php foreach ($subKriteria5 as $namaSub5) {
                                            } ?>
                                            <label for="SubKriteria5" class="col-form-label">
                                                Kriteria :
                                                <?php echo $namaSub5->NamaKriteria ?> (
                                                <?php echo $namaSub5->KodeKriteria ?>) <span style="color:red;">*</span>
                                            </label>
                                            <select name="SubKriteria5" id="SubKriteria5" class="form-control" required>
                                                <option value="">-- Pilih Nilai -- </option>
                                                <?php
                                                foreach ($subKriteria5 as $sub5) {
                                                    if ($sub5->Nilai == $item->C5) {
                                                ?>
                                                        <option selected value="<?php echo $sub5->Nilai ?>">
                                                            <?php echo $sub5->Nilai ?> |
                                                            <?php echo $sub5->Keterangan ?>
                                                        </option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $sub5->Nilai ?>">
                                                            <?php echo $sub5->Nilai ?> |
                                                            <?php echo $sub5->Keterangan ?>
                                                        </option>
                                                <?php
                                                    }
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
                                <div class="col-md-12">
                                    <div class="form-group" hidden>
                                        <label for="FormParameter" class="col-form-label">
                                            Form Parameter <span style="color:red;">*</span>
                                        </label>
                                        <input id="FormParameter" type="text" class="form-control" autocomplete="off" placeholder="Masukan Form Parameter" name="FormParameter" required value="<?php echo $form ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="Tanggal" class="col-form-label">
                                            Tanggal <span style="color:red;">*</span>
                                        </label>
                                        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" name="Tanggal" autocomplete="off" required value="">
                                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="KodeAlternatif" class="col-form-label">
                                            Kode Alternatif <span style="color:red;">*</span>
                                        </label>
                                        <input id="KodeAlternatif" type="text" class="form-control" autocomplete="off" placeholder="Masukan Kode Alternatif" name="KodeAlternatif" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="NamaAlternatif" class="col-form-label">
                                            Nama Alternatif <span style="color:red;">*</span>
                                        </label>
                                        <input id="NamaAlternatif" type="text" class="form-control" autocomplete="off" placeholder="Masukan Nama Alternatif" name="NamaAlternatif" value="">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php foreach ($subKriteria1 as $namaSub1) {
                                        } ?>
                                        <label for="SubKriteria1" class="col-form-label">
                                            Kriteria :
                                            <?php echo $namaSub1->NamaKriteria ?> (
                                            <?php echo $namaSub1->KodeKriteria ?>) <span style="color:red;">*</span>
                                        </label>
                                        <select name="SubKriteria1" id="SubKriteria1" class="form-control" required>
                                            <option value="">-- Pilih Nilai -- </option>
                                            <?php
                                            foreach ($subKriteria1 as $sub1) {
                                            ?>
                                                <option value="<?php echo $sub1->Nilai ?>">
                                                    <?php echo $sub1->Nilai ?> |
                                                    <?php echo $sub1->Keterangan ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php foreach ($subKriteria2 as $namaSub2) {
                                        } ?>
                                        <label for="SubKriteria2" class="col-form-label">
                                            Kriteria :
                                            <?php echo $namaSub2->NamaKriteria ?> (
                                            <?php echo $namaSub2->KodeKriteria ?>) <span style="color:red;">*</span>
                                        </label>
                                        <select name="SubKriteria2" id="SubKriteria2" class="form-control" required>
                                            <option value="">-- Pilih Nilai -- </option>
                                            <?php
                                            foreach ($subKriteria2 as $sub2) {
                                            ?>
                                                <option value="<?php echo $sub2->Nilai ?>">
                                                    <?php echo $sub2->Nilai ?> |
                                                    <?php echo $sub2->Keterangan ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php foreach ($subKriteria3 as $namaSub3) {
                                        } ?>
                                        <label for="SubKriteria3" class="col-form-label">
                                            Kriteria :
                                            <?php echo $namaSub3->NamaKriteria ?> (
                                            <?php echo $namaSub3->KodeKriteria ?>) <span style="color:red;">*</span>
                                        </label>
                                        <select name="SubKriteria3" id="SubKriteria3" class="form-control" required>
                                            <option value="">-- Pilih Nilai -- </option>
                                            <?php
                                            foreach ($subKriteria3 as $sub3) {
                                            ?>
                                                <option value="<?php echo $sub3->Nilai ?>">
                                                    <?php echo $sub3->Nilai ?> |
                                                    <?php echo $sub3->Keterangan ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php foreach ($subKriteria4 as $namaSub4) {
                                        } ?>
                                        <label for="SubKriteria4" class="col-form-label">
                                            Kriteria :
                                            <?php echo $namaSub4->NamaKriteria ?> (
                                            <?php echo $namaSub4->KodeKriteria ?>) <span style="color:red;">*</span>
                                        </label>
                                        <select name="SubKriteria4" id="SubKriteria4" class="form-control" required>
                                            <option value="">-- Pilih Nilai -- </option>
                                            <?php
                                            foreach ($subKriteria4 as $sub4) {
                                            ?>
                                                <option value="<?php echo $sub4->Nilai ?>">
                                                    <?php echo $sub4->Nilai ?> |
                                                    <?php echo $sub4->Keterangan ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php foreach ($subKriteria5 as $namaSub5) {
                                        } ?>
                                        <label for="SubKriteria5" class="col-form-label">
                                            Kriteria :
                                            <?php echo $namaSub5->NamaKriteria ?> (
                                            <?php echo $namaSub5->KodeKriteria ?>) <span style="color:red;">*</span>
                                        </label>
                                        <select name="SubKriteria5" id="SubKriteria5" class="form-control" required>
                                            <option value="">-- Pilih Nilai -- </option>
                                            <?php
                                            foreach ($subKriteria5 as $sub5) {
                                            ?>
                                                <option value="<?php echo $sub5->Nilai ?>">
                                                    <?php echo $sub5->Nilai ?> |
                                                    <?php echo $sub5->Keterangan ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
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
                                <a href="<?php echo site_url('dashboard/alternatif') ?>" class="btn btn-danger btn-sm">
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
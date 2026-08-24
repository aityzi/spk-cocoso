<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Perbarui Profil </h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Profil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Perbarui Profil</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card influencer-profile-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="text-center">
                                    <img src="<?php echo site_url('assets/images/woman.png') ?>" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
                                <div class="user-avatar-info">
                                    <div class="m-b-20">
                                        <div class="user-avatar-name">
                                            <h2 class="mb-1">
                                                <?php echo $this->session->userdata('Username') ?>
                                            </h2>
                                        </div>
                                    </div>
                                    <!--  <div class="float-right"><a href="#" class="user-avatar-email text-secondary">www.henrybarbara.com</a></div> -->
                                    <div class="user-avatar-address">
                                        <p class="border-bottom pb-3">
                                            <span class="d-xl-inline-block d-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-primary "></i>Owner : UP Parfume</span>
                                        </p>
                                        <p>
                                            Sistem Pendukung Keputusan Optimalisasi Cabang UP Parfum dengan Menggunakan Metode Combined Compromise Solution (CoCoSo)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top user-social-box">
                        <div class="container mt-2">
                            <?php echo validation_errors() ?>
                            <?php echo form_open(site_url('profil/perbarui')) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Username <span style="color:red">*</span></label>
                                        <input type="text" name="Username" class="form-control" autocomplete="off" required value="<?php echo $this->session->userdata('Username') ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Password Baru <span style="color:red">*</span></label>
                                        <input type="password" name="Password" class="form-control" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-save"></i>
                                        Simpan</button>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer" style="margin-top:310px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    Copyright © 2024 Sarah Yuliah Hulwah | Prodi Sistem Informasi | STMIK Triguna Dharma
                </div>
            </div>
        </div>
    </div>
</div>
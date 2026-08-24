<!doctype html>
<html lang="id">

<head>
    <meta charset=" utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Sarah Yuliah Hulwah">
    <meta name="author" content="Sistem Informasi">
    <meta name="keywords" content="Sistem Pendukung Keputusan UP Parfume Metode Combined Compromise Solution">
    <meta name="description" content="Sistem Pendukung Keputuan Menentukan Lokasi Cabang UP Parfume">
    <link rel="icon" href="<?php echo site_url('assets/images/logoUP_Favicon.png') ?>" type="image/png">
    <title>Sistem Pendukung Keputusan Optimalisasi Cabang UP Parfum dengan Menggunakan Metode Combined Compromise Solution (CoCoSo)</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link href="<?php echo site_url('assets/vendor/fonts/circular-std/style.css" rel="stylesheet') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/libs/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') ?>">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
    <div class="splash-container">
        <?php
        if ($this->session->flashdata('error')) {
        ?>
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Peringatan !!!</h4>
                <p>
                    <?php
                    echo $this->session->flashdata('error');
                    ?>
                </p>
                <hr>
                <p class="mb-0" style="font-size:10px">Silahkan refresh halaman untuk menghilangkan pesan ini.</p>
            </div>
        <?php
        }
        ?>
        <div class="card ">
            <div class="card-header text-center"><a href="#"><img class="logo-img" src="<?php echo site_url('assets/images/logoUP_Favicon.png') ?>" alt="logo" width="100px" height="100px"></a>
                <span class="splash-description" style="font-size: 12px;">
                    Sistem Pendukung Keputusan Optimalisasi Cabang UP Parfum dengan Menggunakan Metode Combined Compromise Solution (CoCoSo)
                </span>
            </div>
            <div class="card-body">
                <?php echo validation_errors(); ?>
                <?php echo form_open(site_url('login/auth_login')) ?>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="username" type="text" placeholder="Username" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="password" type="password" placeholder="Password" autocomplete="off" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                <?php echo form_close() ?>
            </div>
            <div class="card-footer bg-white p-0">
                <span style="padding: 10px">
                    Copyright &copy; Sarah Yuliah Hulwah | Sistem Informasi
                </span>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <script src="<?php echo site_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/vendor/bootstrap/js/bootstrap.bundle.js') ?>"></script>
</body>

</html>
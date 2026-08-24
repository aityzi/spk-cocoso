<!doctype html>
<html lang="id">

<head>
    <meta charset=" utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Sarah Yuliah Hulwah">
    <meta name="author" content="Sistem Informasi">
    <meta name="keywords" content="Sistem Pendukung Keputusan, UP Parfume, Metode Combined Compromise Solution">
    <meta name="description" content="Sistem Pendukung Keputuan Menentukan Lokasi Cabang UP Parfume">
    <link rel="icon" href="<?php echo site_url('assets/images/logoUP_Favicon.png') ?>" type="image/png">
    <title>
        <?php echo $title; ?>
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link href="<?php echo site_url('assets/vendor/fonts/circular-std/style.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo site_url('assets/libs/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/vendor/datatables/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/vendor/datatables/css/buttons.bootstrap4.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/vendor/datatables/css/select.bootstrap4.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/vendor/datatables/css/fixedHeader.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/datepicker/tempusdominus-bootstrap-4.css') ?>" />

</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="<?php echo site_url('dashboard') ?>">
                    <img src="<?php echo site_url('assets/images/logoUP.png') ?>" width="80px" height="50px">
                    <span style="font-size: 12px; margin-left : 3em;">sistem Pendukung Keputusan Metode Combined Compromise Solution
                        (COCOSO)</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo site_url('assets/images/woman.png') ?>" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">
                                        <?php echo $this->session->userdata('Username') ?>
                                    </h5>
                                    <span class="status"></span><span class="ml-2">Online</span>
                                </div>
                                <a class="dropdown-item" href="<?php echo site_url('dashboard/profil') ?>"><i class="fas fa-user mr-2"></i>Profil</a>
                                <a class="dropdown-item" href="<?php echo site_url('login/auth_logout') ?>"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu Navigasi
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('dashboard') ?>">
                                    <i class="fas fa-home"></i>Dashboard</a>
                            </li>
                            <li class="nav-divider">
                                Manajemen Kriteria
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fas fa-book"></i>Kelola
                                    Kriteria</a>
                                <div id="submenu-1" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo site_url('dashboard/kriteria') ?>"><i class="fa fas fa-caret-right"></i> Kriteria</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo site_url('dashboard/sub_kriteria') ?>"><i class="fa fas fa-caret-right"></i> Sub Kriteria</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-divider">
                                Manajemen Alternatif
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('dashboard/alternatif') ?>">
                                    <i class="fas fa-cubes"></i>Alternatif</a>
                            </li>
                            <li class="nav-divider">
                                Manajemen Perhitungan
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('dashboard/perhitungan') ?>">
                                    <i class="fas fa-chart-pie"></i>Perhitungan</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <?php
        $this->load->view($content);
        ?>
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="<?php echo site_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/vendor/bootstrap/js/bootstrap.bundle.js') ?>"></script>
    <script src="<?php echo site_url('assets/vendor/slimscroll/jquery.slimscroll.js') ?>"></script>
    <script src="<?php echo site_url('assets/libs/js/main-js.js') ?>"></script>
    <script src="<?php echo site_url('assets/libs/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/libs/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/vendor/datatables/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/vendor/datatables/js/data-table.js') ?>"></script>
    <script src="<?php echo site_url('assets/vendor/datepicker/moment.js') ?>"></script>
    <script src="<?php echo site_url('assets/vendor/datepicker/tempusdominus-bootstrap-4.js') ?>"></script>
    <script src="<?php echo site_url('assets/vendor/datepicker/datepicker.js') ?>"></script>
</body>

</html>
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Selamat Datang,
                        <?php echo $this->session->userdata('Username') ?>
                    </h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce
                        sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Home</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="card border-3 border-top border-top-primary">
                            <div class="card-body">
                                <h5 class="text-muted">Total Kriteria</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1" style="font-size:25px;">
                                        <?php echo $c_kriteria ?> Kriteria
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="card border-3 border-top border-top-primary">
                            <div class="card-body">
                                <h5 class="text-muted">Total Alternatif</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1" style="font-size:25px;">
                                        <?php echo $c_alternatif ?> Alternatif
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="card border-3 border-top border-top-primary">
                            <div class="card-body">
                                <h5 class="text-muted">Total Perhitungan</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1" style="font-size:25px;">
                                        <?php echo $c_perhitungan ?> Perhitungan
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h5 class=" card-header">Deskripsi</h5>
                    <div class="card-body">
                        <blockquote class="blockquote">
                            <p class="mb-0" style="font-size:14px;" align="justify">
                                UP Parfum adalah perusahaan yang berjalan di industri parfum yang didirikan dengan visi untuk memberikan pengalaman parfum tak tertandingi. Fokus utama UP Parfum adalah menyajikan rangkaian Parfum yang tidak hanya memukau melalui aromanya yang istimewa tetapi juga melalui desain kemasan yang elegan. Setiap botol UP Parfum tidak hanya berisi aroma yang memikat, tetapi juga merupakan karya seni yang mencerminkan keanggunan merek ini.
                                <br><br>
                                UP Parfum memiliki keahlian khusus dalam meramu bahan-bahan berkualitas tinggi, setiap produk UP Parfum menggambarkan keahlian dalam seni <i>Perfumery</i>, memberikan nuansa yang tak terlupakan kepada para penggunanya. <br></br>
                                Sistem Pendukung Keputusan Optimalisasi Lokasi Cabang UP Parfun dengan Menggunakan Metode Combined Compromise Solution (CoCoSo) Tujuan utama dari penelitian ini adalah mengembangkan Sistem Pendukung Keputusan yang dapat membantu manajemen UP Parfume dalam menentukan lokasi ekspansi cabang yang optimal. Dengan menggunakan metode COCOSO, sistem ini diharapkan dapat memberikan rekomendasi lokasi berdasarkan analisis yang menyeluruh dan berimbang
                            </p>
                        </blockquote>
                    </div>
                    <div class="card-body border-top">
                        <blockquote class="blockquote">
                            <p class="mb-1">Metode Combined Compromise Solution</p>
                            <p style="font-size:14px;" align="justify">
                                Metode Combined Compromise Solution (COCOSO) merupakan metode
                                pengambilan keputusan multikriteria yang mengintegrasikan beberapa metode
                                agregasi untuk menghasilkan skor akhir bagi setiap alternatif. Pendekatan ini dapat
                                mengatasi kriteria-kriteria yang saling bertentangan dan memberikan hasil yang
                                lebih optimal dibandingkan dengan penggunaan metode agregasi tunggal
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer" style="margin-top:190px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    Copyright © 2024 Sarah Yuliah Hulwah | Prodi Sistem Informasi | STMIK Triguna Dharma
                </div>
            </div>
        </div>
    </div>
</div>
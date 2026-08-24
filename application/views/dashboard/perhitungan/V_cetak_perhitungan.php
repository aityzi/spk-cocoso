<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Sarah Yuliah Hulwah">
    <meta name="author" content="Sistem Informasi">
    <meta name="keywords" content="Sistem Pendukung Keputusan, UP Parfume Metode Combined Compromise Solution">
    <meta name="description" content="Sistem Pendukung Keputuan Menentukan Lokasi Cabang UP Parfume">
    <link rel="icon" href="<?php echo site_url('assets/images/logoUP_Favicon.png') ?>" type="image/png">
    <title>
        <?php echo $title ?>
    </title>
</head>

<style type="text/css">
    body {
        margin: 50px;
    }

    .header-content {
        text-align: center;
        margin-bottom: 25px;
    }

    .header-content>h3 {
        margin: 0;
    }

    .header-content>h4 {
        margin: 10px 0px 10px 0px;
    }

    .table-content {
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 12px;
    }

    .table-content>thead>tr>th {
        text-align: left;
        font-weight: bold;
    }
</style>

<body onload="window.print()">
    <header class="header-content">
        <img src="<?php echo site_url('assets/images/logoUP.png') ?>" width="300px">
        <h3>Sistem Pendukung Keputusan Optimalisasi Cabang UP Parfum dengan <br>Menggunakan Metode Combined Compromise Solution (CoCoSo)</h3>
        <h4>Laporan Perhitungan</h4>
        <hr>
    </header>
    <table class="table-content" border="1" cellpadding="5px">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Alternatif</th>
                <th>Nama Alternatif</th>
                <th>Kia</th>
                <th>Kib</th>
                <th>Kic</th>
                <th>Ki</th>
                <th>Rangking</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($perhitungan as $data) {
                // Ubah konversi tanggal pada form menjadi tanggal pada database mysql
                $form_date = $data->Tanggal;
                $split_date = explode('-', $form_date);
                $merge_date = array($split_date[2], $split_date[1], $split_date[0]);
                $tanggal = implode('-', $merge_date);
            ?>
                <tr>
                    <td>
                        <?php echo $no; ?>
                    </td>
                    <td>
                        <?php echo $data->KodeAlternatif ?>
                    </td>
                    <td>
                        <?php echo $data->NamaAlternatif ?>
                    </td>
                    <td>
                        <?php echo $data->Kia ?>
                    </td>
                    <td>
                        <?php echo $data->Kib ?>
                    </td>
                    <td>
                        <?php echo $data->Kic ?>
                    </td>
                    <td>
                        <?php echo $data->Ki ?>
                    </td>
                    <td>
                        <?php echo $data->Rangking ?>
                    </td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>

</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMKN 1 CIBATU | Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/dist/css/adminlte.min.css">

    <style>
        .table {
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }

        .table {
            border: 1px solid black;
        }

        .table,
        th,
        .table td {
            /* border: 1px solid #999; */
            padding: 1px 1px;
            text-align: center;

        }

        .table th,
        .table td,
        .table tr {
            border: 1px solid #999;
            padding: 1px 1px;
        }

        .table td {
            font-size: smaller;
        }

        /* .table thead {
            background-color: #8ba3ffdb;
        } */

        .tabel thead tr {
            border: 1px solid black;
        }

        #table {
            font-family: "Tahoma", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            border-bottom: 1px;
            width: 100%;

        }

        #table td,
        #table th {
            /* border: 1px solid #ddd; */
            padding: 10px;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            /* background-color: #008cff; */
            color: black;
        }

        .label {
            padding: 0px 7px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-lg-12">
                <table cellpadding="" id="table">
                    <tr>
                        <td>
                            <center>
                                <font size="4">PEMERINTAH DAERAH PROVINSI JAWA BARAT<br>DINAS PENDIDIKAN<br>CABANG DINAS PENDIDIKAN WILAYAH IV</font><br>
                                <font size="5"><b>SMK NEGERI 1 CIBATU</b></font><br>
                                <font size="1"><i>Jl. Raya Sadang-Subang Desa Cipinang Kecamatan Cibatu Purwakarta Jawa Barat 41182<br>Telp, (0264)8396042 Website : smkn1cibatu.sch.id Email : smkn1cibatu@yahoo.co.id</i></font>
                            </center>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- garis -->

        <hr>
        <div class="row mt-2">
            <div class="col-lg-12">
                <table cellpadding="" style="font-size: 0.8em;" id="detail">
                    <tr>
                        <td class="label">Periode</td>
                        <td>: <span><?= $date_periode ?? ''; ?></span></td>
                    </tr>
                    <tr>
                        <td class="label">Tingkatan </td>
                        <td>: <?= $nama_tingkatan ?? ''; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-lg-12 text-sm-center">
                <table class="table" align="center" style="font-size: 0.7rem;" style="width: 100%;">
                    <thead class="table table-light">
                        <tr class="text-center">
                            <th rowspan="4" class="align-middle">No</th>
                            <th rowspan="4" class="align-middle">Nama Kelas</th>
                            <th rowspan="4" width=20px class="align-middle">Jml Siswa</th>
                            <th colspan="35" class="text-center">Hari</th>
                        </tr>
                        <tr>
                            <!-- perulangan tanggal -->
                           
                            <th colspan="7">Senin</th>
                            <th colspan="7">Selasa</th>
                            <th colspan="7">Rabu</th>
                            <th colspan="7">Kamis</th>
                            <th colspan="7">Jum'at</th>
                        </tr>
                        <tr>
                            <?php $jmlHari = 5 ?>
                            <?php
                            for ($i = 0; $i < $jmlHari; $i++) :
                            ?>
                                <th colspan="2">Kehadiran</th>
                                <th colspan="5">Ketidakhadiran</th>
                            <?php endfor; ?>
                            <!-- <th colspan="2">Kehadiran</th>
                                <th colspan="5">Ketidakhadiran</th>
                                <th colspan="2">Kehadiran</th>
                                <th colspan="5">Ketidakhadiran</th>
                                <th colspan="2">Kehadiran</th>
                                <th colspan="5">Ketidakhadiran</th>
                                <th colspan="2">Kehadiran</th>
                                <th colspan="5">Ketidakhadiran</th> -->
                        </tr>
                        <tr>
                            <?php
                            for ($i = 0; $i < $jmlHari; $i++) :
                            ?>
                                <th>Jml</th>
                                <th>%</th>
                                <th>A</th>
                                <th>S</th>
                                <th>I</th>
                                <th width=3px>Jml</th>
                                <th>%</th>
                            <?php endfor; ?>

                        </tr>
                    </thead>
                    <tbody>

                        <!-- perulangan sesuai jumlah kelas -->
                        <?php
                        for ($d = 0; $d < $jmlHari; $d++) :
                        ?>
                            <tr>
                                <!-- no -->
                                <td><?= $d + 1; ?></td>

                                <!-- nama kelas -->
                                <td>X TKJ 2</td>

                                <!-- jumlah siswa -->
                                <td>18</td>


                                <!-- perulangan sesuai dengan tanggal range -->
                                <?php
                                for ($i = 0; $i < $jmlHari; $i++) :
                                ?>

                                    <!-- kehadiran jumlah-->
                                    <td>18</td>

                                    <!-- kehadiran % -->
                                    <td>100 %</td>

                                    <!-- ketidakhadiran alpa -->
                                    <td>1</td>

                                    <!-- ketidakhadiran sakit -->
                                    <td>0</td>

                                    <!-- ketidakhadiran izin -->
                                    <td>3</td>

                                    <!-- ketidakhadiran jumlah -->
                                    <td>4</td>

                                    <!-- ketidak hadiran % -->
                                    <td>17 %</td>
                                <?php endfor; ?>
                                <!-- ./perulangan berdaasrkan jumlah tanggal -->

                            </tr>
                        <?php endfor; ?>
                        <!-- ./perulangan berdasarkan kelas yang didapat -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>
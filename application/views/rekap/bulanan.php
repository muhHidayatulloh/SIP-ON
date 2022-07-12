<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMKN 1 CIBATU | <?php echo ucfirst($this->uri->segment(1)); ?></title>

    <!-- icon smk -->
    <link rel="icon" href="<?= base_url() ?>assets/logo/logo.ico" type="image/gif">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/dist/css/adminlte.min.css">

    <style>
        .table {
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }

        .table,
        th,
        .table td {
            border: 1px solid #999;
            padding: 3px 4px;
            text-align: center;

        }

        .table td {
            font-size: smaller;
        }

        .table thead {
            background-color: #8ba3ffdb;
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
        <hr class="col-lg-12">
        <div class="row mt-2">
            <div class="col-lg-12">
                <table cellpadding="" style="font-size: 0.8em;" id="detail">
                    <tr>
                        <td class="label">Periode</td>
                        <td>: <span><?= $filter ?? date('m/Y'); ?></span></td>
                    </tr>
                    <tr>
                        <td>
                    <tr>
                        <td class="label">Kelas </td>
                        <td>: <?= $kelas_where ?? ''; ?></td>
                    </tr>
                    </td>
                    <td>
                        <tr>
                            <td class="label">Jurusan</td>
                            <td>: <?= $jurusan ?? ''; ?></td>
                        </tr>
                    </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12" style="font-size: 0.8em;">
                <table>
                    <tr>
                        <td>
                            <p>Ket : <span class="float-right">
                                    <label class="badge badge-primary">N</label><span> : Netral |</span>
                                    <label class="text-success ml-2"><i class="fas fa-check"></i>H</label><span> : Hadir |</span>
                                    <label class="badge badge-info ml-2">I</label><span> : Izin |</span>
                                    <label class="badge badge-secondary ml-2">S</label><span> : Sakit |</span>
                                    <label class="badge badge-warning ml-2">A</label><span> : Tidak Hadir|</span>
                                    <label class="badge bg-teal ml-2">T</label><span> : Terlambat |</span>
                                    <label class="badge bg-fuchsia ml-2">B</label><span> : Bolos|</span>
                                    <label class="badge badge-danger ml-2">L</label><span> : Libur|</span>
                                </span>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive py-2" style="font-size: 0.6rem;">
                    <?= $table ?? '<div class="callout callout-info my-4">
                                            <h5><i class="icon fas fa-info"></i> Perhatian!!!</h5>
                                            <p>Tidak ada rekaman data kehadiran silahkan filter data terlebih dahulu</p>
                                           </div>'; ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<section class='content'>
    <div class='container-fluid'>
        <div class="row mb-2">
            <div class="col-lg-12">

                <a class="btn btn-warning btn-md" href="" data-toggle="modal" data-target="#modal-sm">
                    <i class="fas fa-filter mr-2"></i> Filter Data
                </a>
                <a class="btn btn-primary btn-md" href="" data-toggle="modal" data-target="#print">
                    <i class="fas fa-file-pdf mr-2"></i> Generate PDF
                </a>
                <a class="btn btn-danger btn-md" href="" data-toggle="modal" data-target="#laporan-week">
                    <i class="fas fa-file-pdf mr-2"></i> Generate PDF Range
                </a>
            </div>
        </div>
        <!-- tabel rekap kehadiran -->
        <div class='row'>
            <div class='col-lg-12'>
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i> Data Kehadiran 1 Bulan<b></b>

                        <span class="float-right">
                            <label class="badge badge-primary">N</label><span> : Netral</span>
                            <label class="text-success ml-2"><i class="fas fa-check"></i></label><span> : Hadir</span>
                            <label class="badge badge-info ml-2">I</label><span> : Izin </span>
                            <label class="badge badge-secondary ml-2">S</label><span> : Sakit </span>
                            <label class="badge badge-warning ml-2">A</label><span> : Tidak Hadir</span>
                            <label class="badge bg-teal ml-2">T</label><span> : Terlambat </span>
                            <label class="badge bg-fuchsia ml-2">B</label><span> : Bolos</span>
                            <label class="badge badge-danger ml-2">L</label><span> : Libur</span>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">Hari ini : <span class="badge badge-warning"><?php echo format_indo(date('Y-m-d')); ?></span></div>
                                <div class="col-lg-12 "></div>
                                <div class="col-md-12">Rekap Kehadiran <span class="badge badge-warning"><?= $filter ?? $tanggal; ?></span></div>
                            </div>
                        </div>


                        <div class="table-responsive py-2">
                            <?= $table ?? '<div class="callout callout-info my-4">
                                            <h5><i class="icon fas fa-info"></i> Perhatian!!!</h5>
                                            <p>Tidak ada rekaman data kehadiran silahkan filter data terlebih dahulu</p>
                                           </div>'; ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>
</section>

<!-- modal  filter -->
<div class="modal fade rounded-lg" id="modal-sm">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form action="<?= base_url('rekap') ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h4 class="modal-title text-lg">Filter Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="kelas">Kelas</label>
                            <select name="id_kelas" id="kelas" class="form-control">
                                <?php foreach ($kelas as $data) : ?>
                                    <option value="<?= $data->id; ?>"><?= $data->nama_tingkatan . " " . $data->nama_jurusan . " " . $data->nomor_kelas; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                <?php
                                $bulan = [1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

                                for ($i = 0; $i < 12; $i++) {
                                    $AmbilNamaBulan = strtotime(sprintf('%d months', $i));
                                    $LabelBulan     = $bulan[date('n', $AmbilNamaBulan)];
                                    $ValueBulan     = date('n', $AmbilNamaBulan);
                                ?>
                                    <option value="<?php echo $ValueBulan; ?>">
                                        <?php echo $LabelBulan; ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <?php
                                $tahun = date('Y');

                                for ($i = 1999; $i <= $tahun; $i++) {
                                ?>
                                    <option value="<?php echo $i; ?>" <?= $i == $tahun ? 'selected' : ''; ?>>
                                        <?php echo $i; ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="submit" name="filter" class="btn btn-warning col-md-12 rounded-pill">Filter</button>
                    <a href="" class="" data-dismiss="modal" role="button">Kembali</a>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal filter laporan bulanan -->
<div id="print" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('rekap/bulanan'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Filter Untuk Cetak</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="kelas">Kelas</label>
                            <select name="id_kelas" id="kelas" class="form-control">
                                <?php foreach ($kelas as $data) : ?>
                                    <option value="<?= $data->id; ?>"><?= $data->nama_tingkatan . " " . $data->nama_jurusan . " " . $data->nomor_kelas; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                <?php
                                $bulan = [1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

                                for ($i = 0; $i < 12; $i++) {
                                    $AmbilNamaBulan = strtotime(sprintf('%d months', $i));
                                    $LabelBulan     = $bulan[date('n', $AmbilNamaBulan)];
                                    $ValueBulan     = date('n', $AmbilNamaBulan);
                                ?>
                                    <option value="<?php echo $ValueBulan; ?>">
                                        <?php echo $LabelBulan; ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <?php
                                $tahun = date('Y');

                                for ($i = 1999; $i <= $tahun; $i++) {
                                ?>
                                    <option value="<?php echo $i; ?>" <?= $i == $tahun ? 'selected' : ''; ?>>
                                        <?php echo $i; ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="submit" name="print" class="btn btn-primary col-md-6 rounded-pill d-block"><i class="fas fa-file-pdf mr-2"></i>Generate PDF</button>
                    <div class="col-12 text-center">
                        <a href="" class="" data-dismiss="modal" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal generate date range -->
<div id="laporan-week" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="laporan-week-title" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('rekap/generate_pdf_range') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="laporan-week-title">Laporan</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Date range -->
                    <div class="form-group">
                        <small><i class="fas text-danger">*</i>Note : <i class="text-danger">Untuk rentang tanggal max 5 hari, untuk mencegah melebihi lebar kertas</i></small>
                        <label>Date range:</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="reservation" name="date">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <div class="form-group">
                            <label for="tingkatan-kelas">Tingkat Kelas</label>
                            <select id="tingkatan-kelas" class="form-control" name="tingkatan_kelas">
                                <?php foreach ($tingkatan as $data) : ?>
                                    <option value="<?= $data->kd_tingkatan; ?>"><?= $data->nama_tingkatan . ' (' . $data->deskripsi . ')'; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- ./modal-body -->

                <div class="modal-footer border-0 justify-content-center">
                    <button type="submit" name="generate" class="btn btn-danger col-md-6 rounded-pill d-block"><i class="fas fa-file-pdf mr-2"></i>Generate PDF</button>
                    <div class="col-12 text-center">
                        <a href="" class="" data-dismiss="modal" role="button">Cancel</a>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>

<!-- Bootstrap 4 -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('assets') ?>/plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url('assets') ?>/plugins/daterangepicker/daterangepicker.js"></script>

<script>
    $(function() {

        //Date range picker
        $('#reservation').daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            }
        })

    });
</script>
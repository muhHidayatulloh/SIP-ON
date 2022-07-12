<section class='content'>
    <div class='container-fluid'>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-app bg-warning" data-toggle="modal" data-target="#modal-sm">
                    <i class="fas fa-filter"></i> Filter Data
                </button>
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
                            <label class="text-success"><i class="fas fa-check"></i></label><span> : Hadir</span>
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
        <form action="<?= base_url('walikelas/rekap') ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h4 class="modal-title text-lg">Filter Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
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
                        <div class="form-group col-md-6">
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
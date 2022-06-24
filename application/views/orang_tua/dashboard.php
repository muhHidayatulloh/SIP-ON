<section class='content'>
    <div class='container-fluid'>
        <div class="row">
            <div class="col-lg-12">
                <div class="title h4">Catatan Kehadiran anak bulan Ini :</div>
            </div>
        </div>
        <div class='row'>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>89</h3>

                        <p>Alpa</p>
                    </div>
                    <div class="icon">
                        <i class="far">A</i>
                    </div>
                    <!-- <a href="<?= base_url('siswa'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>33</h3>

                        <p>Izin</p>
                    </div>
                    <div class="icon">
                        <i class="far">I</i>
                    </div>
                    <!-- <a href="<?= base_url('siswa'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>89</h3>

                        <p>Sakit</p>
                    </div>
                    <div class="icon">
                        <i class="far">S</i>
                    </div>
                    <!-- <a href="<?= base_url('siswa'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- ./row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                       <i class="far fa-check-square"></i> Kehadiran Anak Hari Ini
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?= $return ?? '<div class="callout callout-info my-4">
                                            <h5><i class="icon fas fa-info"></i> Perhatian!!!</h5>
                                            <p><b>Tidak ada</b> rekaman data kehadiran, siswa <b>belum</b> melakukan kehadiran hari ini</p>
                                           </div>'; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ./row -->

    </div>
    <!-- ./container fluid -->
</section>
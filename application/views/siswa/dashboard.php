<section class='content'>
    <div class='container-fluid'>
        <div class="row">
            <div class="col-lg-12">
                <div class="title h4">Bulan Ini :</div>
            </div>
        </div>
        <div class='row'>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $hadir; ?>/<?= $jumlahHari; ?></h3>

                        <p>Hadir/Total record</p>
                    </div>
                    <div class="icon">
                        <i class="far">H</i>
                    </div>
                    <!-- <a href="<?= base_url('siswa'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $alpa; ?></h3>

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
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3><?= $izin; ?></h3>

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
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3><?= $sakit; ?></h3>

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
                        <i class="far fa-check-square"></i> Kehadiran Hari Ini
                        <a href="" class="btn btn-md btn-warning float-right" data-toggle="modal" data-target="#filter">Minta Izin</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?= $return ?? '<div class="callout callout-info my-4">
                                            <h5><i class="icon fas fa-info"></i> Perhatian!!!</h5>
                                            <p>Tidak ada rekaman data kehadiran Hari ini silahkan melakukan kehadiran terlebih dahulu, klik scan QR dan arahkan ke monitor yang menampilkan QR Code yang sudah disediakan oleh pihak sekolah, Jika <b>tidak melakukan scan</b> masuk dan pulang sampai jam yang ditentukan akan dianggap <b>status alpa</b></p>
                                            <p>Jika berhalangan hadir, silahkan klik tombol <span class="badge badge-warning">Minta Izin</span>
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


<div id="filter" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">

                    <div class="card-header border-0">
                        Tanggal Izin
                    </div>

                    <form action="<?= base_url('siswa/mintaizin') ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="date" class="form-control" name="to_date">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="filter" class="btn btn-warning float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $siswa->num_rows; ?></h3>

                        <p>Siswa</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-user"></i>
                    </div>
                    <a href="<?= base_url('siswa'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?= $calendar ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?php

                $hari_ini = date('Ymd');

                echo tanggalMerah($hari_ini);

                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
            </div>
        </div>
    </div>
</section>
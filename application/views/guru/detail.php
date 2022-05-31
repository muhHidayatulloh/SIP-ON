<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col'>
                <!-- Profile Image -->
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title">Profile</h3>
                        <h3 class="card-title float-right"><a href="#"><i class="far fa-edit"></i></a></h3>
                    </div>
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/dist/img/profile/' . $guru->pas_foto) ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $guru->nama; ?></h3>

                        <p class="text-center text-bold"><?= $guru->nama_level; ?></p>

                        <p class="text-muted text-center"><?= $guru->ket ?? '-'; ?></p>

                        <!-- Riwayat Pendidikan -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Riwayat Pendidikan Terakhir</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <strong><i class="fas fa-graduation-cap mr-1"></i> Pendidikan</strong>

                                        <p class="text-muted">
                                            <?= $guru->pendidikan; ?>
                                        </p>

                                        <hr>

                                        <strong><i class="fas fa-book mr-1"></i> Jurusan</strong>

                                        <p class="text-muted"><?= $guru->jurusan; ?></p>

                                        <hr>

                                        <strong><i class="fas fa-calendar-check mr-1"></i> Tahun Ijazah</strong>

                                        <p class="text-muted">
                                            <span class="tag tag-danger"><?= $guru->pendidikan_th; ?></span>

                                        </p>

                                        <hr>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.row -->

                        <!-- jabatan -->
                        <div class="row">
                            <div class="col-lg-5">
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <?= $guru->ket == "PNS / LS" || $guru->ket == "PNS" ? '<b>NIP/NUPTK</b>' : '<b>NIK</b>'; ?> <i class="float-right"><?= $guru->nip; ?></i>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Karpeg</b> (Kartu Pegawai) <i class="float-right"><?= $guru->karpeg ?? '-'; ?></i>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Pangkat Golongan</b> <span class="float-right"><?= $guru->pangkat . ' ' . $guru->golongan ?? '-'; ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Mutasi Kepegawaian</b> <span class="float-right"><?= $guru->mutasi_kepeg ?? '-'; ?></span>
                                    </li>
                                    <li class="list-group-item">

                                        <b> Pelatihan Jabatan</b>

                                        <span class="float-right"><?= $guru->lat_jab_nama ?? '-'; ?></span>


                                    </li>
                                    <li class="list-group-item">
                                        <b>Tahun Pelatihan Jabatan</b> <span class="float-right"><?= $guru->lat_jab_bl . ' - ' . $guru->lat_jab_th; ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-5">
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Masa Kerja</b> <span class="float-right"><?= $guru->mk_th . ' Tahun ' . $guru->mk_bl . ' Bulan'; ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tambahan Masa Kerja</b> <span class="float-right"><?= $guru->tambahan_mk_th . ' Tahun ' . $guru->tambahan_mk_bl . ' Bulan'; ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Pot Masa Kerja</b> <span class="float-right"><?= $guru->mk_potongan ?? '-'; ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>PerTGL DSO</b> <span class="float-right"><?= $guru->pertgl_dso ?? '-'; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>,
</section>
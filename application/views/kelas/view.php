<section class="content">
    <div class='container-fluid'>
        <div class='row'>
            <div class="col-lg-3 col-sm-3 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Kelas</span>
                        <span class="info-box-number text-lg text-lg-center">
                            <?= $count; ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-sm-3 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-green elevation-1"><i class="fas">X</i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Kelas X</span>
                        <span class="info-box-number text-lg text-lg-center">
                            <?= $countX; ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-sm-3 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas">XI</i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Kelas XI</span>
                        <span class="info-box-number text-lg text-lg-center">
                            <?= $countXI; ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-sm-3 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas">XII</i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Kelas XII</span>
                        <span class="info-box-number text-lg text-lg-center">
                            <?= $countXII; ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="info-box shadow-none">
                    <div class="info-box-content ">
                        <?php
                        echo anchor('kelas/add', '<button class="btn btn-success btn-flat mb-1">Tambah Data</button>');
                        ?>
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <!-- semua kelas -->
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-semua-tab" data-toggle="pill" href="#custom-content-below-semua" role="tab" aria-controls="custom-content-below-semua" aria-selected="true">Semua Data</a>
                            </li>
                            <!-- ./semua kelas -->

                            <!-- kelas X -->
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-kelas-X-tab" data-toggle="pill" href="#custom-content-below-kelas-X" role="tab" aria-controls="custom-content-below-kelas-X" aria-selected="false">Kelas X</a>
                            </li>
                            <!-- ./ kelas X -->

                            <!-- kelas XI -->
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-kelas-XI-tab" data-toggle="pill" href="#custom-content-below-kelas-XI" role="tab" aria-controls="custom-content-below-kelas-XI" aria-selected="false">Kelas XI</a>
                            </li>
                            <!-- ./ kelas XI -->

                            <!-- kelas XII -->
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-kelas-XII-tab" data-toggle="pill" href="#custom-content-below-kelas-XII" role="tab" aria-controls="custom-content-below-kelas-XII" aria-selected="false">Kelas XII</a>
                            </li>
                            <!-- Kelas XII -->

                        </ul>
                        <div class="tab-content mt-4" id="custom-content-below-tabContent">
                            <!-- semua data kelas -->
                            <div class="tab-pane fade show active" id="custom-content-below-semua" role="tabpanel" aria-labelledby="custom-content-below-semua-tab">

                                <!-- tabel -->
                                <table class="table table-light table-responsive-sm" id="example1">
                                    <thead class="blue-navy-trans">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($kelas as $data) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $data->nama_tingkatan; ?> <?= $data->nama_jurusan; ?> <?= $data->nomor_kelas; ?></td>
                                                <td><?= $data->deskripsi ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    echo anchor('kelas/edit/' . $data->id, '<button class="btn btn-info btn-xs mx-1"><i class="fas fa-edit"></i></button>');
                                                    ?>
                                                    <a href="<?= base_url('kelas/delete/') . $data->id; ?>" class="btn btn-danger btn-xs alert_hapus"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- kelas X -->
                            <div class="tab-pane fade" id="custom-content-below-kelas-X" role="tabpanel" aria-labelledby="custom-content-below-kelas-X-tab">

                                <!-- tabel -->
                                <table class="table table-light" id="tabel1">
                                    <thead class="blue-navy-trans">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($kelasX as $data) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $data->nama_tingkatan; ?> <?= $data->nama_jurusan; ?> <?= $data->nomor_kelas; ?></td>
                                                <td><?= $data->deskripsi ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    echo anchor('kelas/edit/' . $data->id, '<button class="btn btn-info btn-xs mx-1"><i class="fas fa-edit"></i></button>');
                                                    ?>
                                                    <a href="<?= base_url('kelas/delete/') . $data->id; ?>" class="btn btn-danger btn-xs alert_hapus"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- ./ kelas X -->

                            <!-- kelas XI -->
                            <div class="tab-pane fade" id="custom-content-below-kelas-XI" role="tabpanel" aria-labelledby="custom-content-below-kelas-XI-tab">
                                <!-- tabel -->
                                <table class="table table-light" id="tabel2">
                                    <thead class="blue-navy-trans">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($kelasXI as $data) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $data->nama_tingkatan; ?> <?= $data->nama_jurusan; ?> <?= $data->nomor_kelas; ?></td>
                                                <td><?= $data->deskripsi ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    echo anchor('kelas/edit/' . $data->id, '<button class="btn btn-info btn-xs mx-1"><i class="fas fa-edit"></i></button>');
                                                    ?>
                                                    <a href="<?= base_url('kelas/delete/') . $data->id; ?>" class="btn btn-danger btn-xs alert_hapus"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-kelas-XII" role="tabpanel" aria-labelledby="custom-content-below-kelas-XII-tab">
                                <!-- tabel -->
                                <table class="table table-light" id="tabel3">
                                    <thead class="blue-navy-trans">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($kelasXII as $data) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $data->nama_tingkatan; ?> <?= $data->nama_jurusan; ?> <?= $data->nomor_kelas; ?></td>
                                                <td><?= $data->deskripsi ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    echo anchor('kelas/edit/' . $data->id, '<button class="btn btn-info btn-xs mx-1"><i class="fas fa-edit"></i></button>');
                                                    ?>
                                                    <a href="<?= base_url('kelas/delete/') . $data->id; ?>" class="btn btn-danger btn-xs alert_hapus"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
    </div>
</section>
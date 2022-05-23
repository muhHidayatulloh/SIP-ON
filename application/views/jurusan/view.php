<section class="content">
    <div class='container-fluid'>
        <div class='row'>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Jurusan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- tombol tambah data menu -->
                        <a href="<?= base_url('jurusan/add') ?>" class="badge badge-success p-2">Tambah data</a>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="12px">No</th>
                                    <th>Nama Jurusan</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($jurusan as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data->nama_jurusan; ?></td>
                                        <td><?= $data->deskripsi; ?></td>
                                        <td class="text-center text-xs">
                                            <?php
                                            // button edit
                                            echo anchor('jurusan/edit/' . $data->kd_jurusan, '<button class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></button>');

                                            ?>
                                            <!-- button delete -->
                                            <a href="<?= base_url('jurusan/delete/') . $data->kd_jurusan; ?>" class="btn btn-danger btn-xs alert_hapus"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
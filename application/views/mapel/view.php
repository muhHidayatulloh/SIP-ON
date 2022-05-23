<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Mata Pelajaran</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- tombol tambah data menu -->
                        <?php
                        echo anchor('mapel/add', '<button class="btn btn-success btn-flat btn-sm mb-1">Tambah Data</button>');
                        ?>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="12px">No</th>
                                    <th>Mata Pelelajaran</th>

                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($mapel as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data->nama_mapel; ?></td>

                                        <td class="text-center">

                                            <?php
                                            echo anchor('mapel/edit/' . $data->kd_mapel, '<button class="btn btn-warning btn-xs mx-1" title="Edit"><i class="fas fa-edit"></i></button>');
                                            ?>
                                            <a href="<?= base_url('mapel/delete/') . $data->kd_mapel; ?>" class="btn btn-danger btn-xs alert_hapus" title="Hapus"><i class="fas fa-trash"></i></a>
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
    </div>,
</section>
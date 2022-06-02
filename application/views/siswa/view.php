<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Siswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- tombol tambah data menu -->
                        <?php
                        echo anchor('siswa/add', '<button class="btn btn-success btn-flat btn-sm mb-1">Tambah Data</button>');
                        ?>

                        <table id="example2" class="table table-bordered table-hover text-sm">
                            <thead>
                                <tr>
                                    <th width="12px">No</th>
                                    <th>Nis</th>
                                    <th>Nisn</th>
                                    <th>Nama Siswa</th>
                                    <th>Foto</th>


                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($siswa as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data->nis; ?></td>
                                        <td><?= $data->nisn; ?></td>
                                        <td><?= $data->nama; ?></td>
                                        <td><?= $data->pas_foto; ?></td>


                                        <td class="text-center">

                                            <?php
                                            echo anchor('siswa/detail/' . $data->id_siswa, '<button class="btn btn-secondary btn-xs mx-1" title="detail"><i class="fas fa-eye"></i></button>');
                                            echo anchor('siswa/edit/' . $data->id_siswa, '<button class="btn btn-warning btn-xs mx-1" title="Edit"><i class="fas fa-edit"></i></button>');
                                            ?>
                                            <a href="<?= base_url('siswa/delete/') . $data->id_siswa; ?>" class="btn btn-danger btn-xs alert_hapus" title="Hapus"><i class="fas fa-trash"></i></a>
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
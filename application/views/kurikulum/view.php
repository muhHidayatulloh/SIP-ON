<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Kurikulum</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- tombol tambah data menu -->
                        <?php
                        echo anchor('kurikulum/add', '<button class="btn btn-success btn-flat btn-sm mb-1">Tambah Data</button>');
                        ?>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="12px">No</th>
                                    <th>Nama Kurikulum</th>
                                    <th>Status</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($kurikulum as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data->nama_kurikulum; ?></td>
                                        <td><?= $data->is_aktif == "Y" ? "<label class='badge badge-success'>aktif</label>" : "<label class='badge badge-danger'>Tidak Aktif</label>"; ?></td>


                                        <td class="text-center">
                                            <a href="<?= base_url('kurikulum/aktifkan/') . $data->id_kurikulum; ?>" class="btn btn-success btn-xs <?= $data->is_aktif == 'Y' ? 'disabled' : ''; ?>"><?= $data->is_aktif == 'Y' ? 'Sedang Aktif' : 'Aktifkan'; ?></a>
                                            <?php
                                            echo anchor('kurikulum/detail/' . $data->id_kurikulum, '<button class="btn btn-default btn-xs mx-1" title="View Detail"><i class="fas fa-eye"></i></button>');
                                            echo anchor('kurikulum/edit/' . $data->id_kurikulum, '<button class="btn btn-warning btn-xs mx-1" title="Edit"><i class="fas fa-edit"></i></button>');
                                            ?>
                                            <a href="<?= base_url('kurikulum/delete/') . $data->id_kurikulum; ?>" class="btn btn-danger btn-xs alert_hapus <?= $data->is_aktif == 'Y' ? 'disabled' : ''; ?>" title="Hapus"><i class="fas fa-trash"></i></a>
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
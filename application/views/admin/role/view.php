<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Role</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- tombol tambah data menu -->
                        <?php
                        echo anchor('role/add_role', '<button class="btn btn-success btn-flat mb-1 mr-1">Tambah Data</button>');
                        

                        ?>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="12px">No</th>
                                    <th>Nama Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($role as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data->nama_level; ?></td>
                                        <td class="text-center text-xs">
                                            <?php
                                            // button edit
                                            echo anchor('role/edit_role/' . $data->id_level_user, '<button class="btn btn-info btn-xs"><i class="fas fa-edit"></i></button>');

                                            // button change access
                                            echo anchor('role/access_role/' . $data->id_level_user, '<button class="btn btn-warning btn-xs mx-1"><i class="fas fa-check"></i>Access</button>');

                                            ?>
                                            <!-- button delete -->
                                            <a href="<?= base_url('role/delete_role/') . $data->id_level_user; ?>" class="btn btn-danger btn-xs alert_hapus"><i class="fas fa-trash"></i></a>
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
<section class="content">
    <div class='container-fluid'>
        <?= $this->session->flashdata('message'); ?>
        <div class='row'>
            <div class='col-sm-4'>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Role</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>User Role dipilih :</td>
                                    <td class="text-bold"><?= $role->nama_level; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <?php
                        echo anchor('role', '<button class="btn btn-danger float-lg-right">Kembali</button>');
                        ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Menu Permission</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered" id="example2">
                            <thead>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Link</th>
                                <th>Access</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($menu as $m) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $m->nama_menu; ?></td>
                                        <td><?= $m->link; ?></td>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" <?= check_access($role->id_level_user, $m->id); ?> data-role="<?= $role->id_level_user; ?>" data-menu="<?= $m->id; ?>">
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>


        </div>
    </div>
</section>
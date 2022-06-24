<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Role</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    echo form_open('role/edit_role/' . $role['id_level_user'], 'role="form" class="form-horizontal"');
                    echo form_hidden('id', $role['id_level_user']);
                    ?>
                    <div class="card-body col-sm-10 text-right">
                        <div class="form-group row">
                            <label for="nama_role" class="col-sm-2 col-form-label">Nama Role</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_role" placeholder="Nama Role" value="<?= $role['nama_level']; ?>" name="nama_level">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_role" class="col-sm-2 col-form-label"></label>

                            <button type="submit" class="btn btn-info mx-1 alert_ubah" name="submit">Update</button>
                            <?php
                            echo anchor('role', 'Kembali', array('class' => 'btn btn-danger'));
                            ?>

                        </div>
                    </div>
                    <!-- /.card-body -->

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Role</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    echo form_open('role/add_role', 'role="form" class="form-horizontal"');
                    ?>
                    <div class="card-body col-sm-11 text-right">
                        <div class="form-group row">
                            <label for="nama_level" class="col-sm-2 col-form-label">Nama Role</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_level" placeholder="Nama Role" name="nama_level">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <button type="submit" class="btn btn-info mx-2" name="submit">Simpan</button>
                            <?php
                            echo anchor('role', 'Kembali', array('class' => 'btn btn-danger'));
                            ?>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
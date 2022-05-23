<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Mata Pelajaran</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    echo form_open('mapel/add', 'role="form" class="form-horizontal"');
                    ?>
                    <div class="card-body col-sm-11">
                        <div class="form-group row">
                            <label for="nama_mapel" class="col-sm-2 col-form-label text-lg-right">Mata Pelajaran</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= (validation_errors()) ? 'is-invalid' : ''; ?>" placeholder="Masukkan Nama Mata Pelajaran" name="nama_mapel" value="<?php echo set_value('nama_mapel'); ?>" id="inputError">
                                <div class="invalid-feedback">
                                    <?= form_error('nama_mapel') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <button type="submit" class="btn btn-success mx-2" name="submit">Simpan</button>
                            <?php
                            echo anchor('mapel', 'Kembali', array('class' => 'btn btn-danger'));
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
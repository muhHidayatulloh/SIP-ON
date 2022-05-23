<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Form Update Kurikulum</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    echo form_open('kurikulum/edit', 'role="form" class="form-horizontal"');
                    ?>
                    <input type="hidden" name="id" value="<?= $kurikulum->id_kurikulum; ?>">
                    <div class="card-body col-sm-11">
                        <div class="form-group row">
                            <label for="nama_kurikulum" class="col-sm-2 col-form-label text-lg-right">Nama Kurikulum</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= (validation_errors()) ? 'is-invalid' : ''; ?>" placeholder="Masukkan Nama Kurikulum" name="nama_kurikulum" value="<?php echo set_value('nama_kurikulum'); ?> <?= $kurikulum->nama_kurikulum; ?>" id="inputError">

                                <div class="invalid-feedback">
                                    <?= form_error('nama_kurikulum') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_aktif" class="col-sm-2 col-form-label text-lg-right">Status</label>
                            <div class="col-sm-4">
                                <select name="is_aktif" class="form-control" id="is_aktif">
                                    <option value="0">pilih status</option>
                                    <option value="Y" <?= ($kurikulum->is_aktif == 'Y' ? 'selected' : ''); ?>>Aktif</option>
                                    <option value="N" <?= ($kurikulum->is_aktif == 'N' ? 'selected' : ''); ?>>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <button type="submit" class="btn btn-success mx-2" name="submit">Update</button>
                            <?php
                            echo anchor('kurikulum', 'Kembali', array('class' => 'btn btn-danger'));
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
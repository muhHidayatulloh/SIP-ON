<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Tahun Akademik</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    echo form_open('tahunAkademik/add', 'role="form" class="form-horizontal"');
                    ?>
                    <div class="card-body col-sm-11">

                        <div class="form-group row">
                            <label for="tahunAkademik" class="col-sm-2 col-form-label text-lg-right">Tahun Akademik</label>
                            <div class="col-sm-4">
                                <select name="tahun_akademik" class="form-control" id="tahunAkademik">
                                    <option value="0">Tahun</option>
                                    <?php for ($i = 1980; $i < date('Y') + 5; $i++) { ?>
                                        <option value="<?= $i . '/'; ?><?= $i + 1 ?>"><?= $i . '/'; ?><?= $i + 1 ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="is_aktif" class="col-sm-2 col-form-label text-lg-right">Status</label>
                            <div class="col-sm-4">
                                <select name="is_aktif" class="form-control" id="is_aktif">
                                    <option value="0">pilih status</option>
                                    <option value="Y">Aktif</option>
                                    <option value="N">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <button type="submit" class="btn btn-success mx-2" name="submit">Simpan</button>
                            <?php
                            echo anchor('tahunAkademik', 'Kembali', array('class' => 'btn btn-danger'));
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
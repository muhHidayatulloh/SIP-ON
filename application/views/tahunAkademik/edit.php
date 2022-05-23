<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Tahun Akademik</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    echo form_open('tahunAkademik/edit', 'role="form" class="form-horizontal"');
                    ?>
                    <div class="card-body col-sm-11">
                        <input type="hidden" name="id" value="<?= $this->uri->segment(3); ?>">
                        <div class="form-group row">
                            <label for="tahunAkademik" class="col-sm-2 col-form-label text-lg-right">Tahun Akademik</label>
                            <div class="col-sm-4">
                                <select name="tahun_akademik" class="form-control" id="tahunAkademik">
                                    <option value="0">Tahun</option>
                                    <?php for ($i = $tahun_akademik->tahun_akademik - 20; $i < date('Y') + 10; $i++) {
                                        $tahunplus = $i + 1;
                                        $tahunAkademik = $i . "/" . $tahunplus;
                                    ?>
                                        <option value="<?= $tahunAkademik ?>" <?= ($tahun_akademik->tahun_akademik == $tahunAkademik) ? 'selected' : '' ?>><?= $tahunAkademik; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="is_aktif" class="col-sm-2 col-form-label text-lg-right">Status</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="is_aktif" disabled="disabled">
                                    <option value="0">pilih semester</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="semester" class="col-sm-2 col-form-label text-lg-right">Semester</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="semester" name="semester">
                                    <option value="Ganjil" <?= ($tahun_akademik->semester == 'Ganjil') ? 'selected' : '' ?>>Ganjil</option>
                                    <option value="Genap" <?= ($tahun_akademik->semester == 'Genap') ? 'selected' : '' ?>>Genap</option>
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
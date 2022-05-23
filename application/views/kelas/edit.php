<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Kelas</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    echo form_open('kelas/edit', 'role="form" class="form-horizontal"');
                    ?>
                    <div class="card-body col-sm-11">
                        <input type="hidden" name="id" value="<?= $kelas->id; ?>">
                        <div class="form-group row">
                            <label for="tingkatan_kelas" class="col-sm-2 col-form-label text-lg-right">Tingkatan Kelas</label>
                            <div class="col-sm-4">
                                <select name="tingkatan_kelas" class="form-control" id="tingkatan_kelas">
                                    <?php
                                    foreach ($tingkatan_kelas as $row) {
                                    ?>
                                        <option value='<?= $row->kd_tingkatan ?>' <?= ($row->kd_tingkatan === $kelas->kd_tingkatan) ? 'selected' : '' ?>><?= $row->nama_tingkatan; ?></option>


                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jurusan" class="col-sm-2 col-form-label text-lg-right">Jurusan</label>
                            <div class="col-sm-4">
                                <select name="jurusan" class="form-control" id="jurusan">
                                    <?php
                                    foreach ($jurusan as $row) {

                                    ?>
                                        <option value='<?= $row->kd_jurusan ?>' <?= ($row->kd_jurusan === $kelas->kd_jurusan) ? 'selected' : '' ?>><?= $row->nama_jurusan . ' - ' . $row->deskripsi ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                echo anchor('kelas/jurusan/add', 'Tambah Jurusan', array('class' => 'btn btn-success'));
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nomor_kelas" class="col-sm-2 col-form-label text-lg-right">Nomor Kelas</label>
                            <div class="col-sm-4">
                                <select name="nomor_kelas" class="form-control" id="nomor_kelas">
                                    <?php
                                    for ($i = 1; $i < 6; $i++) {
                                    ?>
                                        <option value="<?= $i; ?>" <?= ($i === intval($kelas->nomor_kelas)) ? 'selected' : 'apa' ?>><?= $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <button type="submit" class="btn btn-success mx-2" name="submit">Update</button>
                            <?php
                            echo anchor('kelas', 'Kembali', array('class' => 'btn btn-danger'));
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
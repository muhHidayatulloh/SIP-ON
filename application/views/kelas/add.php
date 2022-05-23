<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Kelas</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    echo form_open('kelas/add', 'role="form" class="form-horizontal"');
                    ?>
                    <div class="card-body col-sm-11">
                        <div class="form-group row">
                            <label for="tingkatan_kelas" class="col-sm-2 col-form-label text-lg-right">Tingkatan Kelas</label>
                            <div class="col-sm-4">
                                <select name="tingkatan_kelas" class="form-control" id="tingkatan_kelas">
                                    <?php
                                    foreach ($tingkatan_kelas as $row) {
                                        echo "<option value='$row->kd_tingkatan'>$row->nama_tingkatan</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jurusan" class="col-sm-2 col-form-label text-lg-right">Jurusan</label>
                            <div class="col-sm-4">
                                <select name="jurusan" class="form-control" id="jurusan">
                                    <?php
                                    foreach ($jurusan as $row) {
                                        echo "<option value='$row->kd_jurusan'>$row->nama_jurusan ($row->deskripsi)</option>";
                                    }
                                    ?>
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
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <button type="submit" class="btn btn-success mx-2" name="submit">Simpan</button>
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
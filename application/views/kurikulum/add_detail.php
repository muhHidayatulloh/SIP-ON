<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Detail Kurikulum</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    echo form_open('kurikulum/add_detail/'.$this->uri->segment(3), 'role="form" class="form-horizontal"');
                    ?>
                    <div class="card-body col-sm-11">
                        <div class="form-group row">
                            <label for="is_aktif" class="col-sm-2 col-form-label text-lg-right">Kurikulum</label>
                            <input type="hidden" name="id_kurikulum" value="<?= $this->uri->segment(3); ?>">
                            <div class="col-sm-4">
                                <?php
                                echo cmb_dinamis('kurikulum', 'tbl_kurikulum', 'nama_kurikulum', 'id_kurikulum', $this->uri->segment(3), "disabled='disabled'");
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="is_aktif" class="col-sm-2 col-form-label text-lg-right">Mata Pelajaran</label>
                            <div class="col-sm-4">
                                <?php
                                echo cmb_dinamis('kd_mapel', 'tbl_mapel', 'nama_mapel', 'kd_mapel');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="is_aktif" class="col-sm-2 col-form-label text-lg-right">Jurusan</label>
                            <div class="col-sm-4">
                                <?php
                                echo cmb_dinamis('kd_jurusan', 'tbl_jurusan', 'nama_jurusan', 'kd_jurusan');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="is_aktif" class="col-sm-2 col-form-label text-lg-right">Tingkatan Kelas</label>
                            <div class="col-sm-4">
                                <?php
                                echo cmb_dinamis('kd_tingkatan', 'tbl_tingkatan_kelas', 'nama_tingkatan', 'kd_tingkatan');
                                ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <button type="submit" class="btn btn-success mx-2" name="submit">Simpan</button>
                            <?php
                            echo anchor('kurikulum/detail/'. $this->uri->segment(3), 'Kembali', array('class' => 'btn btn-danger'));
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
<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="d-flex justify-content-start">
                            <h3 class="card-title">Tambah Jurusan</h3>
                        </div>
                    </div>
                    <form action="<?php base_url('jurusan/add') ?>" method="POST">
                        <div class="card-body col-sm-11">
                            <div class="form-group row">
                                <label for="nama_jurusan" class="col-sm-3 col-form-label text-lg-right">Nama Jurusan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= (validation_errors()) ? 'is-invalid' : ''; ?>" id="nama_jurusan" placeholder="Nama Jurusan" name="nama_jurusan">
                                    <div class="invalid-feedback">
                                        <?= form_error('nama_jurusan') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desktipsi" class="col-sm-3 col-form-label text-lg-right">Kepanjangan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= (validation_errors()) ? 'is-invalid' : ''; ?>" id="desktipsi" placeholder="Kepanjangan Jurusan" name="deskripsi">
                                    <div class="invalid-feedback">
                                        <?= form_error('deskripsi') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <button type="submit" class="btn btn-info mx-2" name="submit">Simpan</button>
                                <?php
                                if ($this->uri->segment(1) == "kelas") {

                                    echo anchor('kelas/add', 'Kembali', array('class' => 'btn btn-danger'));
                                } else {
                                    echo anchor('jurusan', 'Kembali', array('class' => 'btn btn-danger'));
                                }
                                ?>
                            </div>
                        </div>
                </div>
                <!-- /.card -->
                </form>

            </div>
        </div>
    </div>,
</section>
<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Tingkatan Kelas</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('tingkatan/add') ?>">
                            <div class="form-group row">
                                <label for="nama_tingkatan" class="col-sm-3 col-form-label text-lg-right">Nama Tingkatan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= (validation_errors()) ? 'is-invalid' : ''; ?>" id="nama_tingkatan" placeholder="Nama Tingkatan @ex XI" name="nama_tingkatan">
                                    <div class="invalid-feedback">
                                        <?= form_error('nama_tingkatan') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-3 col-form-label text-lg-right">Deskripsi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= (validation_errors()) ? 'is-invalid' : ''; ?>" id="deskripsi" placeholder="Deskripsi" name="deskripsi">
                                    <div class="invalid-feedback">
                                        <?= form_error('deskripsi') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <button type="submit" class="btn btn-success mx-2" name="submit">Simpan</button>
                                <?php
                                echo anchor('tingkatan', 'Kembali', array('class' => 'btn btn-danger'));
                                ?>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>,
</section>
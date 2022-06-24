<!-- <?php var_dump($id_level_user) ?> -->
<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-12'>
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user mr-1"></i> Form tambah siswa
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('siswa/add') ?>" method="POST">
                            <input type="hidden" name="id_level_siswa" value="<?= $id_level_siswa[0]->id_level_user; ?>">
                            <input type="hidden" name="id_level_ortu" value="<?= $id_level_orang_tua[0]->id_level_user; ?>">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="nis">Nis</label>
                                    <input type="text" class="form-control" id="nis" placeholder="Nis" value="<?= $nis ?>" name="nis" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="nisn">Nisn</label>
                                    <input type="text" class="form-control <?= (form_error('nisn')) ? 'is-invalid' : ''; ?>" id="nisn" placeholder="Nisn" value="<?= set_value('nisn') ?>" name="nisn">
                                    <div class="invalid-feedback">
                                        <?= form_error('nisn'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control <?= (form_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="Nama Siswa" value="<?= set_value('nama') ?>" name="nama">
                                <div class="invalid-feedback">
                                    <?= form_error('nama'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control <?= (form_error('tempat_lahir')) ? 'is-invalid' : ''; ?>" id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir" value="<?= set_value('tempat_lahir') ?>">
                                    <div class="invalid-feedback">
                                        <?= form_error('tempat_lahir'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control <?= (form_error('tgl_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tgl_lahir" value="<?= set_value('tgl_lahir') ?>">
                                    <div class="invalid-feedback">
                                        <?= form_error('tgl_lahir'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" placeholder="JL. Contoh, Ds. Contoh, Kec. Contoh" name="alamat" value="<?= set_value('alamat') ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="no_tlp_siswa">No Tlp Siswa</label>
                                    <input type="text" class="form-control <?= (form_error('no_tlp_siswa')) ? 'is-invalid' : ''; ?>" id="no_tlp_siswa" placeholder="08xxxxxxxxx" name="no_tlp_siswa" value="<?= set_value('no_tlp_siswa') ?>">
                                    <div class="invalid-feedback">
                                        <?= form_error('no_tlp_siswa'); ?>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="gender1">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input <?= strlen(form_error('gender')) != 0 ? 'is-invalid' : ''; ?>" type="radio" name="gender" id="gender1" value="1" <?= set_radio('gender', '1') ?>>
                                    <label class="form-check-label" for="gender1">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input <?= strlen(form_error('gender')) != 0 ? 'is-invalid' : ''; ?>" type="radio" name="gender" id="gender2" value="2" <?= set_radio('gender', '2') ?>>
                                    <label class="form-check-label" for="gender2">Perempuan</label>
                                </div>

                                <?php echo form_error('gender'); ?>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="asal_sekolah">Asal Sekolah</label>
                                    <input type="text" class="form-control <?= (form_error('asal_sekolah')) ? 'is-invalid' : ''; ?>" id="asal_sekolah" name="asal_sekolah" value="<?= set_value('asal_sekolah') ?>" placeholder="SMP xxxxxxx">
                                    <div class="invalid-feedback">
                                        <?= form_error('asal_sekolah'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="kelas">Masuk Ke Kelas</label>

                                    <select name="kelas" id="kelas" class="form-control <?= strlen(form_error('kelas')) != 0 ? 'is-invalid' : ''; ?>">
                                        <option value="null" selected="selected">-- pilih Kelas --</option>
                                        <?php foreach ($kelas as $data) : ?>
                                            <option value="<?= $data->id; ?>" <?= set_select('kelas', $data->id); ?>><?= $data->nama_tingkatan . " " . $data->nama_jurusan . " " . $data->nomor_kelas; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('kelas'); ?>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12 border-bottom py-2">
                                    <div class="title"><i class="fas fa-user-friends mr-1"></i>Orang Tua</div>
                                </div>
                                <input type="hidden" class="form-control" name="id_orang_tua" value="<?= $id_orang_tua->id_orang_tua == null ? '0' : $id_orang_tua->id_orang_tua + 1 ?>" readonly>
                                <div class="form-group col-md-4">
                                    <label for="ayah">Ayah</label>
                                    <input type="text" class="form-control <?= (form_error('ayah')) ? 'is-invalid' : ''; ?>" id="ayah" name="ayah" value="<?= set_value('ayah') ?>" placeholder="Nama Ayah">
                                    <div class="invalid-feedback">
                                        <?= form_error('ayah'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="ibu">Ibu</label>
                                    <input type="text" class="form-control <?= (form_error('ibu')) ? 'is-invalid' : ''; ?>" id="ibu" name="ibu" value="<?= set_value('ibu') ?>" placeholder="Nama Ibu">
                                    <div class="invalid-feedback">
                                        <?= form_error('ibu'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="no_tlp_ortu">Nomor Tlp Orang Tua</label>
                                    <input type="text" class="form-control <?= (form_error('no_tlp_ortu')) ? 'is-invalid' : ''; ?>" id="no_tlp_ortu" placeholder="08xxxxxx" value="<?= set_value('no_tlp_ortu') ?>" name="no_tlp_ortu">
                                    <div class="invalid-feedback">
                                        <?= form_error('no_tlp_ortu'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="alamat_ortu">Alamat Orang Tua</label>
                                    <input type="text" class="form-control <?= (form_error('alamat_ortu')) ? 'is-invalid' : ''; ?>" id="alamat_ortu" name="alamat_ortu" value="<?= set_value('alamat_ortu') ?>" placeholder="JL. Contoh, Ds. Contoh, Kec. Contoh" name="alamat">
                                    <div class="invalid-feedback">
                                        <?= form_error('alamat_ortu'); ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>,
</section>
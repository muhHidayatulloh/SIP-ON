<section class='content'>
    <div class='container-fluid' style="font-family: 'Times New Roman', Times, serif;">
        <form action="<?= base_url('guru/edit/' . $guru->id) ?>" method="POST">
            <input type="hidden" name="id" value="<?= $guru->id; ?>">
            <div class="row">
                <div class="col-12">
                    <div class="info-box shadow-none">
                        <div class="info-box-content">
                            <div class="d-flex justify-content-center">
                                <h4 class="brand-text">Edit Data Guru</h4>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class='row'>
                <div class='col-lg-6 col-sm-12'>
                    <div class="info-box shadow-none">
                        <div class="info-box-content">
                            <div class="form-group">
                                <label for="nip">Nip <span class="text-muted text-sm">(untuk non pns menggunakan NIK)</span><i class="fas" style="color:red;">*</i></label>
                                <input type="text" class="form-control form-control-border <?= strlen(form_error('nip')) != 0 ? 'is-invalid' : ''; ?>" id="nip" placeholder="Nip" name="nip" value="<?= set_value('nip'); ?><?= $guru->nip; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nip') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama<i class="fas" style="color:red;">*</i></label>
                                <input type="text" class="form-control form-control-border <?= strlen(form_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="Nama" name="nama" value="<?= set_value('nama'); ?><?= $guru->nama; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nama'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir<span style="color: red;">*</span></label>
                                <input type="text" class="form-control <?= (validation_errors('tempat_lahir')) ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= set_value('tempat_lahir'); ?><?= $guru->tempat_lahir; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('tempat_lahir'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir <i class="fas" style="color:red;">*</i></label>
                                <input type="date" class="form-control col-5 <?= (validation_errors('tanggal_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= $guru->tgl_lahir; ?><?= set_value('tanggal_lahir'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('tanggal_lahir'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan Terakhir<i class="fas" style="color:red;">*</i></label>
                                <div class="row">
                                    <div class="col-5">
                                        <input type="text" class="form-control <?= (validation_errors('pendidikan')) ? 'is-invalid' : ''; ?>" id="pendidikan" placeholder="pendidikan" name="pendidikan" value="<?= set_value('pendidikan'); ?><?= $guru->pendidikan; ?>">
                                        <div class="invalid-feedback">
                                            <?= form_error('pendidikan'); ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control <?= (validation_errors('jurusan')) ? 'is-invalid' : ''; ?>" id="jurusan" placeholder="jurusan" name="jurusan" value="<?= set_value('jurusan'); ?><?= $guru->jurusan; ?>">
                                        <div class="invalid-feedback">
                                            <?= form_error('jurusan'); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control <?= (validation_errors('pendidikan_th')) ? 'is-invalid' : ''; ?>" id="pendidikan_th" placeholder="tahun_lulus" name="pendidikan_th" value="<?= set_value('pendidikan_th'); ?><?= $guru->pendidikan_th; ?>">
                                        <div class="invalid-feedback">
                                            <?= form_error('pendidikan_th'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pangkat">Pangkat Jabatan / Golongan</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="pangkat" placeholder="pangkat" name="pangkat" value="<?= set_value('pangkat'); ?><?= $guru->pangkat; ?>">
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control" type="text" name="golongan" placeholder="Golongan" value="<?= set_value('golongan'); ?><?= $guru->golongan; ?>">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label for="jabatan">Jabatan <i class="fas" style="color: red;">*</i></label>
                                    <select name="jabatan" id="jabatan" class="form-control <?= strlen(form_error('jabatan')) != 0 ? 'is-invalid' : ''; ?>">
                                        <option value="null" selected="selected">-- pilih Jabatan --</option>
                                        <?php foreach ($role as $data) : ?>
                                            <option value="<?= $data->id_level_user; ?>" class="<?= $data->nama_level == 'Admin' ? 'd-none' : ''; ?>" <?= set_select('jabatan', $data->id_level_user); ?> <?= ($data->id_level_user == $guru->jabatan) ? 'selected' : ''; ?>><?= $data->nama_level; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('jabatan'); ?>


                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan<i class="fas" style="color:red;">*</i></label>
                                <div class="row">
                                    <div class="col-8">
                                        <select name="ket" id="ket" class="form-control <?= strlen(form_error('ket')) != 0 ? 'is-invalid' : ''; ?>">
                                            <option value="null" selected="selected">-- pilih Ket --</option>
                                            <?php foreach ($keterangan as $data) : ?>

                                                <option value="<?= $data->id; ?>" <?= set_select('ket', $data->id); ?> <?= ($data->id == $guru->id_guru_keterangan) ? 'selected' : ''; ?>><?= $data->keterangan; ?></option>

                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('ket'); ?>
                                    </div>
                                    <div class="col-4">
                                        <a href="<?= base_url('guru/add_keterangan'); ?>" class="btn btn-success">Tambah</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Gender <span class="fas" style="color: red;">*</span></label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input <?= strlen(form_error('ket')) != 0 ? 'is-invalid' : ''; ?>" <?= $guru->gender == 1 ? 'checked' : ''; ?> type="radio" id="customRadio1" name="gender" value="1" <?= set_radio('gender', '1') ?>>
                                    <label for="customRadio1" class="custom-control-label">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input <?= strlen(form_error('ket')) != 0 ? 'is-invalid' : ''; ?>" <?= $guru->gender == 2 ? 'checked' : ''; ?> type="radio" id="customRadio2" name="gender" value="2" <?= set_radio('gender', '2'); ?>>
                                    <label for="customRadio2" class="custom-control-label">Perempuan</label>
                                </div>

                                <?= form_error('gender'); ?>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-6 col-sm-12">
                    <div class="info-box shadow-none">
                        <div class="info-box-content">
                            <div class="form-group">
                                <label for="karpeg">Karpeg</label>
                                <input type="text" class="form-control form-control-border" id="karpeg" placeholder="karpeg" name="karpeg" value="<?= set_value('karpeg'); ?><?= $guru->karpeg; ?>">
                            </div>
                            <div class="form-group">
                                <label for="pangkat">Latihan Jabatan</label>
                                <div class="row mb-1">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="lat" placeholder="Nama Lat. Jab" name="lat_jab_nama" value="<?= set_value('lat_jab_nama'); ?><?= $guru->lat_jab_nama; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <input class="form-control" type="text" name="lat_jab_th" placeholder="Lat. Jab Tahun" value="<?= set_value('lat_jab_th'); ?><?= $guru->lat_jab_th; ?>">
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control" type="text" name="lat_jab_bl" placeholder="Lat. Jab Bulan" value="<?= set_value('lat_jab_bl'); ?><?= $guru->lat_jab_bl; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mutasi_kepeg">Catatan Mutasi Kapegawaian</label>
                                <input type="text" class="form-control" id="mutasi_kepeg" placeholder="Catatan Mutasi Kepegawaian" name="mutasi_kepeg" value="<?= set_value('mutasi_kepeg'); ?><?= $guru->mutasi_kepeg; ?>">
                            </div>
                            <div class="form-group">
                                <label for="pertgl_dso">Per Tanggal DSO </label>
                                <input type="date" class="form-control col-5" id="pertgl_dso" name="pertgl_dso" value="<?= set_value('pertgl_dso'); ?><?= $guru->pertgl_dso; ?>">
                            </div>
                            <div class="form-group">
                                <label for="mk_th">Masa Kerja</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control form-control-border" id="mk_th" placeholder="tahun" name="mk_th" value="<?= set_value('mk_th'); ?><?= $guru->mk_th; ?>">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control form-control-border" id="mk_bl" placeholder="bulan" name="mk_bl" value="<?= set_value('mk_bl'); ?><?= $guru->mk_bl; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tambahan_mk">Tambahan Masa Kerja</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control form-control-border" id="tambahan_mk_th" placeholder="tahun" name="tambahan_mk_th" value="<?= set_value('tambahan_mk_th'); ?><?= $guru->tambahan_mk_th; ?>">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control form-control-border" id="tambahan_mk_bl" placeholder="bulan" name="tambahan_mk_bl" value="<?= set_value('tambahan_mk_bl'); ?><?= $guru->tambahan_mk_bl; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tambahan_mk">Potongan Masa Kerja</label>
                                <input type="text" class="form-control form-control-border col-6" id="mk_potongan" placeholder="" name="mk_potongan" value="<?= set_value('mk_potongan'); ?><?= $guru->mk_potongan; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="info-box shadow-none">
                        <div class="info-box-content">
                            <div class="form-group">
                                <label for="pertama">No Tanggal Surat Pengangkatan <span class="text-muted">(Non PNS)</span></label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="no_tgl_surat_pengangkatan_pertama" name="no_tgl_surat_pengangkatan_pertama" placeholder="Pertama" value="<?= set_value('no_tgl_surat_pengangkatan_pertama'); ?><?= $guru->no_tgl_surat_pengangkatan_pertama; ?>">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="no_tanggal_surat_pengangkatan_terakhir" name="no_tanggal_surat_pengangkatan_terakhir" placeholder="Terakhir" value="<?= set_value('no_tgl_surat_pengangkatan_terakhir'); ?><?= $guru->no_tgl_surat_pengangkatan_terakhir; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pejabat_yang_mengangkat">Pejabat Yang Mengangkat</label>
                                <input id="pejabat_yang_mengangkat" class="form-control" type="text" name="pejabat_yang_mengangkat" placeholder="Nama Pejabat" value="<?= set_value('pejabat_yang_mengangkat'); ?><?= $guru->pejabat_yang_mengangkat; ?>">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </div>
                        <!-- ./info-box-content -->
                    </div>
                    <!-- ./info-box -->
                </div>
                <!-- ./col -->


            </div>
            <!-- ./row -->
        </form>
    </div>
</section>
<section class='content'>
    <div class='container-fluid' style="font-family: 'Times New Roman', Times, serif;">
        <form action="<?= base_url('guru/add') ?>" method="POST">
            <div class="row">
                <div class="col-12">
                    <div class="info-box shadow-none">
                        <div class="info-box-content">
                            <div class="d-flex justify-content-center">
                                <h4 class="brand-text">Form Pengisian Data Guru</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12 col-sm-12'>
                    <div class="info-box shadow-none">
                        <div class="info-box-content">
                            <div class="form-group">
                                <label for="nip">Nip / NUPTK / NIK<i class="fas" style="color:red;">*</i></label>
                                <input type="text" class="form-control form-control-border <?= strlen(form_error('nip')) != 0 ? 'is-invalid' : ''; ?>" id="nip" placeholder="Nip" name="nip" value="<?= set_value('nip'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nip') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama<i class="fas" style="color:red;">*</i></label>
                                <input type="text" class="form-control form-control-border <?= strlen(form_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="Nama" name="nama" value="<?= set_value('nama'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nama'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir<span style="color: red;">*</span></label>
                                <input type="text" class="form-control <?= (validation_errors('tempat_lahir')) ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= set_value('tempat_lahir'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('tempat_lahir'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir <i class="fas" style="color:red;">*</i></label>
                                <input type="date" class="form-control col-5 <?= (validation_errors('tanggal_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= set_value('tanggal_lahir'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('tanggal_lahir'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="level">Pilih Level</label>
                                <select name="id_level_user" id="level" class="form-control col-5">
                                    <?php foreach($role as $data) : ?>
                                        <option value="<?= $data->id_level_user; ?>" class="<?= strtolower($data->nama_level) != 'admin' && strtolower($data->nama_level) != 'guru' ? 'd-none' : '' ; ?>"><?= $data->nama_level; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                                      
                            <div class="form-group">
                                <label>Gender <span class="fas" style="color: red;">*</span></label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input <?= strlen(form_error('gender')) != 0 ? 'is-invalid' : ''; ?>" type="radio" id="customRadio1" name="gender" value="1" <?= set_radio('gender', '1') ?>>
                                    <label for="customRadio1" class="custom-control-label">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input <?= strlen(form_error('gender')) != 0 ? 'is-invalid' : ''; ?>" type="radio" id="customRadio2" name="gender" value="2" <?= set_radio('gender', '2'); ?>>
                                    <label for="customRadio2" class="custom-control-label">Perempuan</label>
                                </div>

                                <?= form_error('gender'); ?>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

            </div>
            <!-- ./row -->

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="info-box shadow-none">
                        <div class="info-box-content">
                            <div class="d-flex justify-content-start">
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Keterangan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    echo form_open('guru/add_keterangan', 'role="form" class="form-horizontal"');
                    ?>
                    <div class="card-body col-sm-11">
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label text-lg-right">Nama Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= (validation_errors()) ? 'is-invalid' : ''; ?>" placeholder="Masukkan Nama Keterangan" name="keterangan" value="<?php echo set_value('keterangan'); ?>" id="inputError">
                                <div class="invalid-feedback">
                                    <?= form_error('keterangan') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <button type="submit" class="btn btn-success mx-2" name="submit">Simpan</button>
                            <?php
                            echo anchor('kurikulum', 'Kembali', array('class' => 'btn btn-danger'));
                            ?>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    </form>
                </div>
                <!-- /.card -->

                <div class="card card-warning card-outline">
                    <div class="card-header">
                        Data Keterangan
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover text-sm">
                            <thead>
                                <tr>
                                    <th width="12px">No</th>
                                    <th>Keterangan</th>


                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($keterangan as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data->keterangan; ?></td>


                                        <td class="text-center">

                                            <?php
                                            echo anchor('guru/detail/' . $data->id, '<button class="btn btn-secondary btn-xs mx-1" title="detail"><i class="fas fa-eye"></i></button>');
                                            echo anchor('guru/edit/' . $data->id, '<button class="btn btn-warning btn-xs mx-1" title="Edit"><i class="fas fa-edit"></i></button>');
                                            ?>
                                            <a href="<?= base_url('guru/delete/') . $data->id; ?>" class="btn btn-danger btn-xs alert_hapus" title="Hapus"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
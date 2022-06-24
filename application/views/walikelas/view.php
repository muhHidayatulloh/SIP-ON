<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class="card">
                    <div class="card-header">

                        <h3 class="card-title"><i class="icon fas fa-table"></i> Data Wali Kelas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- tombol tambah data menu -->
                        <button type="button" class="btn btn-success btn-flat mb-2" data-toggle="modal" data-target="#exampleModal">
                            Tambah Data
                        </button>

                        <table id="example2" class="table table-bordered table-hover text-sm">
                            <thead>
                                <tr>
                                    <th width="12px">No</th>
                                    <th>Nama Kelas</th>
                                    <th>Wali Kelas</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($walikelas as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data->nama_tingkatan . ' ' . $data->nama_jurusan . ' ' . $data->nomor_kelas; ?></td>
                                        <td><?= $data->nama; ?></td>

                                        <td class="text-center">

                                            <?php

                                            echo anchor('walikelas/edit/' . $data->id_wali_kelas, '<button class="btn btn-warning btn-xs mx-1" title="Edit"><i class="fas fa-edit"></i></button>');
                                            ?>
                                            <a href="<?= base_url('walikelas/delete/') . $data->id_wali_kelas; ?>" class="btn btn-danger btn-xs alert_hapus" title="Hapus"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>,
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('walikelas'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-diagnoses"></i>Tambah Wali Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="kelas">Pilih Kelas</label>
                            <select name="id_kelas" id="kelas" class="form-control">
                                <?php foreach ($kelas as $data) : ?>
                                    <option value="<?= $data->id; ?>"><?= $data->nama_tingkatan . ' ' . $data->nama_jurusan . ' ' . $data->nomor_kelas; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="guru">Pilih Guru</label>
                            <select name="id_guru" id="guru" class="form-control">
                                <?php foreach ($guru as $data) : ?>
                                    <option value="<?= $data->id; ?>"><?= $data->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="save_walikelas">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
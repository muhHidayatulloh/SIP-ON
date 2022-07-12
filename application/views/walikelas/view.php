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
                                <!-- <?php var_dump($walikelas) ?> -->
                                <?php $i = 1;
                                foreach ($walikelas as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data->nama_tingkatan . ' ' . $data->nama_jurusan . ' ' . $data->nomor_kelas; ?></td>
                                        <td><?= $data->nama; ?></td>

                                        <td class="text-center">
                                            <a href="" data-toggle="modal" data-target="#exampleModalUbah" class="btn btn-warning btn-xs edit" data-idguru="<?= $data->id_guru; ?>" data-idkelas="<?= $data->id_kelas; ?>" data-idwalikelas="<?= $data->id_wali_kelas; ?>" title="Edit"><i class="fas fa-edit"></i></a>
                                            <?php

                                            // echo anchor('walikelas/edit/' . $data->id_wali_kelas, '<button class="btn btn-warning btn-xs mx-1" title="Edit"><i class="fas fa-edit"></i></button>');
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
    </div>
</section>


<!-- Modal tambah -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('walikelas'); ?>" method="post" id="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-diagnoses"></i><span id="label">Tambah</span> Wali Kelas</h5>
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

                                    <?php
                                    // cek apakah id sudah ada di tabel walikelas
                                    $res = $this->db->get_where('tbl_walikelas', ['id_kelas' => $data->id])->num_rows();

                                    if ($res < 1) {
                                        ?>
                                        <option value="<?= $data->id; ?>"><?= $data->nama_tingkatan . ' ' . $data->nama_jurusan . ' ' . $data->nomor_kelas; ?></option>

                                        <?php }  ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="guru">Pilih Guru</label>
                            <select name="id_guru" id="guru" class="form-control">
                                <?php foreach ($guru as $data) : ?>
                                    <?php $res = $this->db->get_where('tbl_walikelas', ['id_guru' => $data->id])->num_rows(); 
                                    if ($res < 1) {
                                    ?>
                                    <option value="<?= $data->id; ?>"><?= $data->nama; ?></option>
                                    <?php }  ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="save_walikelas" id="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- modal ubah -->
<div class="modal fade" id="exampleModalUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('walikelas'); ?>" method="post" id="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-diagnoses"></i><span id="label">Ubah</span> Wali Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_wali_kelas" id="idwalikelas">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="kelas">Pilih Kelas</label>
                            <select name="id_kelas" id="kelasedit" class="form-control">
                                <?php foreach ($kelas as $data) : ?>
                                    <option value="<?= $data->id; ?>"><?= $data->nama_tingkatan . ' ' . $data->nama_jurusan . ' ' . $data->nomor_kelas; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="guru">Pilih Guru</label>
                            <select name="id_guru" id="guruedit" class="form-control">
                                <?php $guru = $this->guru_model->get() ?>
                                <?php foreach ($guru as $data) : ?>
                                    <option value="<?= $data->id; ?>"><?= $data->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update" id="submit">Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(function() {
        $('.edit').on('click', function() {
            var idguru = $(this).data('idguru');
            var idkelas = $(this).data('idkelas');
            var idwalikelas = $(this).data('idwalikelas');

            console.log(idguru);
            console.log(idkelas);

            $('#guruedit').val(idguru);
            $('#kelasedit').val(idkelas);
            $('#idwalikelas').val(idwalikelas);

        })
    });
</script>
<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Tingkatan kelas</h3>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url('tingkatan/add') ?>" class="btn badge-btn badge-success">Tambah data</a>
                        <table class="table table-bordered table-hover" id="example2">
                            <thead>
                                <th width=12>No</th>
                                <th>Nama Tingkatan</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($tingkatan as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data->nama_tingkatan; ?></td>
                                        <td><?= $data->deskripsi; ?></td>
                                        <td>
                                            <a href="<?= base_url('tingkatan/edit/' . $data->kd_tingkatan); ?>" class="badge badge-btn badge-success">Edit</a>
                                            <a href="<?= base_url('tingkatan/delete/' . $data->kd_tingkatan) ?>" class="badge badge-btn badge-danger alert_hapus">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>,
</section>
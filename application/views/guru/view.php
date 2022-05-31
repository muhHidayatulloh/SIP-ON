<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Guru</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- tombol tambah data menu -->
                        <?php
                        echo anchor('guru/add', '<button class="btn btn-success btn-flat btn-sm mb-1">Tambah Data</button>');
                        ?>

                        <table id="example2" class="table table-bordered table-hover text-sm">
                            <thead>
                                <tr>
                                    <th width="12px">No</th>
                                    <th>Nip</th>
                                    <th>Karpeg</th>
                                    <th>Nama Guru</th>
                                    <th>Keterangan</th>

                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($guru as $data) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data->nip; ?></td>
                                        <td><?= strlen($data->karpeg) != 0 ? $data->karpeg : '-'; ?></td>
                                        <td><?= $data->nama; ?></td>
                                        <td><?= $data->ket; ?></td>

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
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>,
</section>
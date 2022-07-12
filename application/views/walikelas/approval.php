<section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class="card shadow-lg">
                    <div class="card-header">
                        <i class="fas fa-check-double"></i> Permintaan Approval Izin Keperluan dan Izin Sakit
                    </div>
                    <div class="badge">
                        <p>Note <i class="fas text-danger text-bold">*</i> : Klik Icon di bagian approve untuk menyetujui siswa tersebut izin</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th width="10px">No</th>
                                        <th>Nama</th>
                                        <th>Subject</th>
                                        <th>Catatan</th>
                                        <th>Bukti</th>
                                        <th>Untuk Tanggal</th>
                                        <th>DI Buat</th>
                                        <th>Di Ubah</th>
                                        <th>Approved</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($izin as $no => $data) : ?>
                                        <tr>
                                            <td><?= $no + 1; ?></td>
                                            <td><?= $data->nama; ?></td>
                                            <td><?= $data->subject; ?></td>
                                            <td><?= $data->catatan; ?></td>
                                            <td><a href="<?= base_url('walikelas/approval?file_name=') . $data->bukti; ?>" data-file="<?= $data->bukti; ?>" class="badge badge-success">download</a></td>
                                            <td><?= $data->to_date; ?></td>
                                            <td><?= $data->created_at; ?></td>
                                            <td><?= $data->updated_at; ?></td>
                                            <td><a role="button" class="approval text-success i-<?= $data->id_izin ?>" data-idizin="<?= $data->id_izin; ?>"><i <?= approved($data->id_izin); ?>></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(function() {
        $('.approval').on('click', function() {
            var id_izin = $(this).data('idizin');

            console.log(id_izin);

            $.ajax({
                url: "<?= base_url('walikelas/approval'); ?>",
                method: 'post',
                type: 'json',
                data: {
                    id_izin: id_izin,
                    approval: ''
                },
                success: function(data) {
                    console.log(data);
                    $('.i-' + id_izin).html('<i class="fas fa-check"></i>')
                }
            });

        });
    });
</script>

<!-- <td><i <?= approved($data->id_izin); ?> id="approval" data-idizin="<?= $data->id_izin; ?>" data-subject="<?= $data->subject; ?>" data-todate="<?= $data->to_date; ?>"></i></td> -->
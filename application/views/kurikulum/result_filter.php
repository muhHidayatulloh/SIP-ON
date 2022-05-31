<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Mata Pelajaran</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($mapel as $data) : ?>

            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data->nama_mapel; ?></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
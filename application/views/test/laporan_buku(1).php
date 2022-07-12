<style>
    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        border-bottom: 1px;
        width: 100%;
    }

    #table td,
    #table th {
        border: 1px solid #ddd;
        padding: 10px;
    }

    #table tr:hover {
        background-color: #ddd;
    }

    #table th {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
        /* background-color: #008cff; */
        color: black;
    }
</style>

<table width="100%" cellpadding="">
    <tr>
        <td><img style="height: 40px" src="image" alt=""></td>
        <td>
            <center>
                <font size="4">PEMERINTAH DAERAH PROVINSI JAWA BARAT<br>DINAS PENDIDIKAN<br>CABANG DINAS PENDIDIKAN WILAYAH IV</font><br>
                <font size="5"><b>SMK NEGERI 1 CIBATU PURWAKARTA</b></font><br>
                <font size="2"><i>Jl. Raya Sadang-Subang Desa Cipinang Kecamatan Cibatu Purwakarta Jawa Barat 41182<br>Telp, (0264)8396042 Website : smkn1cibatu.sch.id Email : smkn1cibatu@yahoo.co.id</i><br>Teknik Pemesinan - Teknik Kendaraan Ringan Otomotif - Teknik Komputer dan Jaringan<br>Otomatisasi dan Tata Kelola Perkantoran - Akutansi dan Keuangan Lembaga</font>
            </center>
        </td>
        <td></td>
    </tr>
    <td colspan="3">
        <hr size="3px" color="black" style="margin-bottom:2px">
        <hr size="4px" color="black" style="margin-top:0px">
    </td>
</table>

<table border="1" width="100%" style="text-align:center;">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>ISBN</th>
        <th>Pengarang</th>
        <th>Judul Buku</th>
        <th>Jilid Edisi</th>
        <th>Jumlah</th>
        <th>Tempat</th>
        <th>Penebit</th>
        <th>Tahun Terbit</th>
        <th>Kelas</th>
    </tr>
    <?php
    $no = 1;
    if(!empty($buku)) {
    foreach ($buku as $bk) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $bk->tanggal; ?></td>
            <td><?= $bk->isbn; ?></td>
            <td><?= $bk->pengarang; ?></td>
            <td><?= $bk->judul_buku; ?></td>
            <td><?= $bk->jilid_edisi; ?></td>
            <td><?= $bk->jumlah; ?></td>
            <td><?= $bk->tempat_terbit; ?></td>
            <td><?= $bk->penerbit; ?></td>
            <td><?= $bk->thn_buku; ?></td>
            <td><?= $bk->kelas; ?></td>
        </tr>
    <?php
    } }
    ?>
</table>
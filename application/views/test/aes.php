<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Encryption Standard</title>
</head>
<body>
    <form action="<?= base_url('test/aes') ?>" method="post">
        <input type="text" name="aes" >
        <button type="submit" name="encrypt">Encrypt</button>
</form>
<?= 'hasil enkripsi :' . $this->session->flashdata('message'); ?>
<?= 'hasil Dekripsi :' . $this->session->flashdata('decrypt'); ?>
<p><?= $encrypt ?? 'Silahkan Masukan kata yang ingin di encripsi'; ?></p>


<p>Ini enkripan : <?= $nis ?></p>
<p>Ini dekripan : <?= $nisDecrypt ?></p>
<br>
<p>Ini enkripan : <?= $enkripsi ?></p>
<p>Ini dekripan : <?= $dekripsi ?></p>
</body>
</html>
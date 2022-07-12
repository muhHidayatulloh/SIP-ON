<!DOCTYPE html>
<html>

<head>

    <title>Kode QR - Sip-ON</title>



</head>

<body>
    <div class="example">
        <h1>SMKN 1 Cibatu</h1>
        <p>Scan QR Code untuk melakukan absensi hari <?php echo date('D, d M Y') ?> </p>
        <div class="flipclock" style="margin-left: 10%;"></div>
        <div class="center">
            <img src="https://chart.googleapis.com/chart?chs=600x300&cht=qr&chl=<?= $token->token; ?>">
        </div>
    </div>
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/countdown360/jquery.countdown360.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/countdown360/countdown.js'); ?>"></script>

</body>

</html>




<!-- <img style="height: 40px" src="<?= base64media('./assets/homepage/images/toor-logo.png') ?>"> -->
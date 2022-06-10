<!DOCTYPE html>
<html>

<head>

    <title>Kode QR - Sip-ON</title>
    <link rel="icon" href="<?= base_url() ?>assets/logo/logo.ico" type="image/gif">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .instansi {
            font-family: "Kaushan Script", cursive !important;
            color: black !important;
            font-weight: bold !important;
            text-shadow: 2px 3px 0px #002c9c81;
            font-style: italic !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="instansi mt-1">SMKN 1 CIBATU</h1>
                <p>Scan QR Code untuk melakukan absensi hari <?php echo format_indo(date('Y-m-d')); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                Renew QR Code in
                <span id="timer" class="badge" style="background-color: red;"></span>
                seconds
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="center">
                    <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?= $token->token; ?>">
                    <p class="text"></p>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/custom/count/countdownTimer.min.js'); ?>"></script>
    <script src="<?= base_url('assets/custom/count/timer.js'); ?>"></script>


</body>

</html>
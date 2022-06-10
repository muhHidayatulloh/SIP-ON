<!-- <section class='content'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-12'>
                <div id="qr-reader" style="width:600px"></div>
                <div id="qr-reader-results"></div>
                <p class="text"></p>
            </div>
        </div>
    </div>
</section> -->

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <!-- <h3 class="box-title"> <i class="fa fa-camera-retro"></i> Scan QR Code</h3> -->
                </div>
                <div class="card-body result">
                    <div id="reader"></div>
                </div>

                <p class="text"></p>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="<?= base_url('assets/custom/js/scan.js') ?>" type="text/javascript"></script>
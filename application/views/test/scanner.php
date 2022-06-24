<html>

<head>
    <title>Html-Qrcode Demo</title>

<body>
    <div id="qr-reader" style="width:600px"></div>
    <div id="qr-reader-results"></div>
    <p class="text"></p>
</body>
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete" ||
            document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function() {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                $.ajax({
                    url: "qr/validation_qr",
                    method: "POST",
                    data: {
                        token: lastResult
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        /** wtf */
                        console.log(data);
                        $('.text').html(data.result);
                    }
                });
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 30,
                qrbox: 300
            });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
</head>

</html>
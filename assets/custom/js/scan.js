var lastResult, countResults = 0;

    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        if (decodedText !== lastResult) {
            ++countResults;
            lastResult = decodedText;
            // Handle on success condition with the decoded message.
            $.ajax({
                url: "validation_qr",
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
                    Swal.fire(data.result);
                }
            });
        }

    }

    function onScanError(errorMessage) {
        // handle on error condition, with error message

    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 250
        });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
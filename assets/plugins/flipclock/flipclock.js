/** generate qrcode */
let clock = $('.flipclock').FlipClock(10, {
    countdown: true,
    callbacks: {
        stop: function () {
            setTimeout(function () {
                $.ajax({
                    url: "generate_qrcode",
                    method: "POST",
                    data: {},
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        /** wtf */
                        let url = "https://chart.googleapis.com/chart?chs=600x300&cht=qr&chl=" + data.token + "&choe=UTF-8";

                        clock.setTime(10);
                        clock.start();

                        $('.center img').attr('src', url);
                        $('.text').html(data.token);
                    }
                });
            }, 1000);
        }
    }
});

/** disabled refresh */
let ctrlKeyDown = false;

$(document).ready(function () {
    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);
});

function keydown(e) {
    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 10) {
        ctrlKeyDown = true;
    }
};

function keyup(e) {
    if ((e.which || e.keyCode) == 17)
        ctrlKeyDown = false;
};
let clock = $(".flipclock").countdown360({
    radius: 80,
    strokeStyle: "#477050",
    strokeWidth: undefined,
    fillStyle: "#8ac575",
    fontColor: "#477050", 
    fontFamily: "sans-serif",
    fontSize: undefined,
    fontWeight: 700,
    autostart: true,
    seconds: 10,
    label: ["second", "seconds"],
    startOverAfterAdding: true, 
    smooth: true,
    onComplete: function () {
        
            setTimeout(function () {
                $.ajax({
                    url: "test/generate_qrcode",
                    method: "POST",
                    data: {},
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        /** wtf */
                        let url = "https://chart.googleapis.com/chart?chs=600x300&cht=qr&chl=" + data.token + "&choe=UTF-8";

                        clock.start();

                        $('.center img').attr('src', url);
                        $('.text').html(data.token);
                    }
                });
            }, 1000);
        
    }
});
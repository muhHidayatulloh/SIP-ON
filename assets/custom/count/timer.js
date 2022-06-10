// generate qr-code
$('#timer').countdownTimer({
    seconds: 10,
    loop:true,
    callback: function(){
      // do something
      $.ajax({
        url: "qr/generate_qrcode",
        method: "POST",
        data: {},
        async: true,
        dataType: 'json',
        success: function (data) {
            /** wtf */
            let url = "https://chart.googleapis.com/chart?chs=600x300&cht=qr&chl=" + data.token + "&choe=UTF-8";

            $('.center img').attr('src', url);
            $('.text').html(data.token);
        }
    });
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
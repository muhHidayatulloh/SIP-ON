var lastResult,
	countResults = 0;

function onScanSuccess(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	if (decodedText !== lastResult) {
		++countResults;
		lastResult = decodedText;
		// Handle on success condition with the decoded message.
		$.ajax({
			url: "scanner/validation_qr",
			method: "POST",
			data: {
				token: lastResult,
			},
			async: true,
			dataType: "json",
			success: function (data) {
				/** fff */
				console.log(data);
				if (data.username) {
					Swal.fire({
						title: "<strong><u>Berhasil</u></strong>",
						icon: "success",
						html:
							"Nama : <b>" +
							data.nama +
							"</b><br>" +
							"Tanggal Melakukan Kehadiran : <b>" +
							data.tanggal +
							"</b><br>" +
							"Jam Melakukan Kehadiran : <b>" +
							data.jam +
							"</b><br>" +
							"Status : <b>" +
							data.status +
							"<b>",

						focusConfirm: true,
						confirmButtonText: '<i class="fa fa-thumbs-up"></i> OK!',
						confirmButtonAriaLabel: "Thumbs up, great!",
					}).then((result) => {
						/* Read more about isConfirmed, isDenied below */
						if (result.isConfirmed) {
							document.location.href = "siswa/dashboard";
						}
					});
					console.log(data);
				} else if (data.warning) {
					Swal.fire({
						title: "<strong><u>Berhasil</u></strong>",
						icon: data.icon,
						html: data.warning,

						focusConfirm: true,
						confirmButtonText: '<i class="fa fa-thumbs-up"></i> OK!',
						confirmButtonAriaLabel: "Thumbs up, great!",
					});
					console.log(data);
				} else if (data.info) {
					Swal.fire({
						icon: "info",
						title: "Informasi",
						text: data.info,
					});
					console.log(data);
				} else {
					Swal.fire({
						icon: "error",
						title: "Gagal",
						text: data.pesan,
					});
					console.log(data);
				}

				console.log(data);

				$(".text").html(data.nis);
			},
		});
	}
}

function onScanError(errorMessage) {
	// handle on error condition, with error message
}

var html5QrcodeScanner = new Html5QrcodeScanner("reader", {
	fps: 10,
	qrbox: 250,
});
html5QrcodeScanner.render(onScanSuccess, onScanError);

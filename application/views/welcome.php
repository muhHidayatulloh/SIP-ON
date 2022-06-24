<section class='content'>
	<div class='container-fluid'>
		<div class='row'>
			<div class='col'>
				<div class="jumbotron">
					<h1 class="display-4">Selamat Datang, <b><?= $user->nama; ?></b></h1>
					<hr class="my-4">
					<p>Hak akses anda sebagai <b><?= $user->nama_level ?? 'gagal mengambil data' ?></b> dalam sistem presensi online ini</p>
				</div>
			</div>
		</div>
	</div>
</section>
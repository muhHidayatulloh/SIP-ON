<section class='content'>
	<div class='container-fluid'>
		<?php var_dump($hasil) ?>
		<div class='row'>
			<div class='col-lg-4 col-sm-5'>
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Filter Data</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<form action="<?= base_url('kurikulum/detail/' . $idDetail) ?>" method="post">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td class="text-bold text-center">Tingkatan</td>
										<td class="text-bold">
											<?php
											echo cmb_dinamis('kd_tingkatan', 'tbl_tingkatan_kelas', 'nama_tingkatan', 'kd_tingkatan', !empty($kd_tingkatan) ? $kd_tingkatan : 'null');
											?>
										</td>
									</tr>
									<tr>
										<td class="text-bold text-center">Jurusan</td>
										<td class="text-bold">

											<?php
											echo cmb_dinamis('kd_jurusan', 'tbl_jurusan', 'nama_jurusan', 'kd_jurusan', !empty($kd_jurusan) ? $kd_jurusan : 'null');
											?>

										</td>
									</tr>
									<tr>

										<td colspan="2">
											<button type="submit" name="submit" class="btn btn-warning float-lg-right">Filter</button>
										</td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<?php
						echo anchor('kurikulum', '<button class="btn btn-danger">Kembali</button>');
						echo anchor('kurikulum/add_detail/' . $idDetail, '<button class="btn bg-navy float-lg-right">Tambah Mata Pelajaran</button>');
						?>
					</div>
				</div>
				<!-- /.card -->
			</div>

			<div class="col-lg-8 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Data Daftar Mata Pelajaran</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<?php if (!empty($hasil)) { ?>
							<table class="table table-light" id="example2">
								<thead class="thead-light">
									<tr>
										<th>#</th>
										<th>Mata Pelajaran</th>
									</tr>
								</thead>
								<tbody>

									<?php $no = 1;
									foreach ($hasil as $data) : ?>

										<tr>
											<td><?= $no++; ?></td>
											<td><?= $data->nama_mapel; ?></td>
										</tr>


									<?php endforeach; ?>

								</tbody>
							</table>
						<?php } else { ?>
							<div class="alert alert-warning" role="alert">
								<h4 class="alert-heading"><i class="fas fa-globe-americas"></i> Perhatian</h4>
								Filter Data Terlebih Dahulu
							</div>
						<?php } ?>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div>
</section>
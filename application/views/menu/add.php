<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Form Tambah Menu</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<?php
					echo form_open('menu/add', 'role="form" class="form-horizontal"');
					?>
					<div class="card-body col-sm-11">
						<div class="form-group row">
							<label for="nama_menu" class="col-sm-2 col-form-label text-lg-right">Nama Menu</label>
							<div class="col-sm-10">
								<input type="text" class="form-control <?= (validation_errors()) ? 'is-invalid' : ''; ?>" placeholder="Nama Menu" name="nama_menu" value="<?php echo set_value('nama_menu'); ?>" id="inputError">
								<div class="invalid-feedback">
									<?= form_error('nama_menu') ?>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="link" class="col-sm-2 col-form-label text-lg-right">Link</label>
							<div class="col-sm-10">
								<input type="text" class="form-control <?= (validation_errors()) ? 'is-invalid' : ''; ?>" id="link" placeholder="Link" name="link">
								<div class="invalid-feedback">
									<?= form_error('link') ?>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="Icon" class="col-sm-2 col-form-label text-lg-right">Icon</label>
							<div class="col-sm-10">
								<input type="text" class="form-control <?= (validation_errors()) ? 'is-invalid' : ''; ?>" id="Icon" placeholder="Icon" name="icon">
								<div class="invalid-feedback">
									<?= form_error('icon') ?>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="Icon" class="col-sm-2 col-form-label text-lg-right">Is Main Menu</label>
							<div class="col-sm-4">
								<select name="is_main_menu" class="form-control" id="icon">
									<option value="0">Main Menu</option>
									<?php
									foreach ($menu as $row) {
										echo "<option value='$row->id'>$row->nama_menu</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2"></label>
							<button type="submit" class="btn btn-info mx-2" name="submit">Simpan</button>
							<?php
							echo anchor('menu', 'Kembali', array('class' => 'btn btn-danger'));
							?>
						</div>

					</div>
					<!-- /.card-body -->

					</form>
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div>
</section>
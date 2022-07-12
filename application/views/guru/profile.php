<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/dist/img/profile/') . $user->pas_foto; ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $user->nama; ?></h3>

                        <p class="text-muted text-center"><?= $user->nama_level; ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <i class="fas fa-graduation-cap"></i><b> NIK/NUPTK/NIK</b> <span class="float-right text-muted"><?= $user->nip; ?></span>
                            </li>
                        </ul>

                        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger btn-block"><b>Log Out</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Ubah Password</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane active" id="timeline">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <i class="text-danger">*</i> note : <span class="badge badge-warning text-sm">Jangan Lupa klik tombol <span class="badge badge-info text-sm">simpan perubahan</span> untuk menyimpan perubahan</span>
                                    </div>
                                </div>
                                <!-- The User Profile -->
                                <div class="row border">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <form action="<?= base_url('guru/edit/' . $user->id_guru) ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $user->id_guru; ?>">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <label for="nip">Nip</label>
                                                            <input type="text" class="form-control" id="nip" value="<?= $user->nip ?>" readonly>
                                                        </div>
                                                       
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-9">
                                                            <label for="nama">Nama</label>
                                                            <input type="text" class="form-control" id="nama" value="<?= $user->nama ?>" placeholder="Masukkan Nama" name="nama">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="karpeg">Username</label>
                                                            <input type="text" class="form-control" id="karpeg" value="<?= $user->username ?>" name="username">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-5">
                                                            <label for="tempat_lahir">Tempat Lahir</label>
                                                            <input type="text" class="form-control" id="tempat_lahir" value="<?= $user->tempat_lahir ?>" placeholder="Tempat Lahir" name="tempat_lahir">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="tgl_lahir" value="<?= $user->tgl_lahir ?>" name="tgl_lahir">
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <img src="<?= base_url('assets/dist/img/profile/') . $user->pas_foto ?>" alt="Profile" id="priview" class="img-thumbnail img-fluid">
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                                                <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <button type="submit" name="profile_edit" class="btn btn-primary float-lg-right">Simpan Perubahan</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <!-- ./row -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal" oninput='password2.setCustomValidity(password2.value != password1.value ? "Kata Sandi tidak cocok." : "")' method="POST" action="<?= base_url('guru/edit/') . $user->id_guru ?>">
                                    <input type="hidden" name="id" value="<?= $user->id_guru; ?>">
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password Lama</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password Baru</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" name="password1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password2" class="col-sm-3 col-form-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password2" name="password2">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-warning" name="password_edit">Ubah Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>


<script>
    $(document).ready(() => {
        $('#customFile').change(function() {
            const file = this.files[0];
            console.log(file);
            if (file) {
                priview.src = URL.createObjectURL(file);
                // let reader = new FileReader();
                // reader.onload = function(event) {
                //     console.log(event.target.result);
                //     $('#preview').removeAttr('src');
                //     $('#preview').attr('src', event.target.result);
                // }
                // reader.readAsDataURL(file);

                $('.custom-file-label').html(file['name']);
            }
        });
    });
</script>
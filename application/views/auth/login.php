<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMKN 1 Cibatu | Login</title>

    <link rel="icon" href="<?= base_url() ?>assets/logo/logo.ico" type="image/gif">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/custom/css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/custom/css/color.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition login-page custom-biru-muda">

    <div class="container-fluid">
        <svg viewbox="0 0 800 300" class="wave1">
            <path fill="#400485" d="
        M 800 100
        Q 200 300 0 270
        L 0 0
        L 800 0
    " />

        </svg>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-5 col-xl-4">
                <div class="o-hidden border-0 shadow-lg my-5">
                    <div class="wrapper bg-white">
                        <div class="brand text-center"><img src="<?= base_url('assets/logo/logo.png') ?>" alt="Logo SMk"></div>
                        <div class="h2 text-center instansi mt-1">SMKN 1 CIBATU</div>
                        <div class="h4 text-muted text-center pt-2 judul">Login</div>


                        <?php
                        echo form_open('auth', 'role="form" class="pt-3"');
                        ?>
                        <div class="form-group py-2">
                            <div class="input-field"> <span class="far fa-user p-2"></span> <input type="text" placeholder="Username" required class="<?= (form_error('username')) ? 'is-invalid' : ''; ?>" name="username"> </div>
                            <div class="invalid-feedback">
                                <?= form_error('username'); ?>
                            </div>
                        </div>



                        <div class="form-group py-1 pb-2">
                            <div class="input-field">
                                <span class="fas fa-lock p-2"></span>
                                <input type="password" placeholder="password" required class="<?= (form_error('username')) ? 'is-invalid' : ''; ?>" name="password">
                                <!-- <button class="btn bg-white text-muted eye"> <span class="far fa-eye-slash"></span> </button> -->
                            </div>
                            <div class="invalid-feedback">
                                <?= form_error('password'); ?>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-block text-center my-3" name="submit">Login</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>


    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- sweet alert pesan  -->
    <?= $this->session->flashdata('pesan'); ?>
</body>

</html>
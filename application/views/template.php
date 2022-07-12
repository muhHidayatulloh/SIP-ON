<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SMKN 1 CIBATU | <?php echo ucfirst($this->uri->segment(1)); ?></title>

  <!-- icon smk -->
  <link rel="icon" href="<?= base_url() ?>assets/logo/logo.ico" type="image/gif">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/dist/css/adminlte.min.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/custom/css/setting.css"> -->

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url('') ?>/assets/plugins/summernote/summernote-bs4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url('') ?>/assets/plugins/daterangepicker/daterangepicker.css">


  <!-- kumpulan script -->
  <!-- ----------------------- -->
  <!-- ----------------------- -->
  <!-- ----------------------- -->

  <!-- jQuery -->
  <script src="<?php echo base_url(''); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(''); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="<?php echo base_url(''); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url(''); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url(''); ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>

  <!-- sweet alert pesan  -->
  <?= $this->session->flashdata('pesan'); ?>





</head>

<body class="hold-transition sidebar-mini text-md layout-navbar-fixed layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-1">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <h4 class="pt-1"><?php echo $title ?? ucfirst($this->uri->segment(1)); ?></h4 class="pt-1">
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">


        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link alert_logout" href="<?= base_url('auth/logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-1 text-sm">
      <!-- Brand Logo -->
      <a href="<?php echo base_url(''); ?>" class="brand-link">
        <img src="<?php echo base_url(''); ?>assets/logo/logo.png" alt="Logo Sekolah" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
          <h5>Sip-ON</h5>
        </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url(''); ?>assets/dist/img/profile/<?= $user->pas_foto ?? 'default.png'; ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $user->nama ?? 'Nama User'; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php
            $id_level_user = $this->session->userdata('id_level_user');

            $sql_menu = "SELECT * FROM `tabel_menu` WHERE id IN(SELECT id_menu FROM tbl_user_rule WHERE id_level_user = '$id_level_user') AND is_main_menu = 0";

            $main_menu  = $this->db->query($sql_menu)->result();

            foreach ($main_menu as $main) {
              // check apakah memiliki submenu?
              $submenu  = $this->db->get_where('tabel_menu', array('is_main_menu' => $main->id));

              if ($submenu->num_rows() > 0) {
                //submenu true
            ?>
                <li class="nav-item">
                  <a href="<?= $main->link; ?>" class="nav-link">
                    <i class="nav-icon <?= $main->icon; ?>"></i>
                    <p>
                      <?= $main->nama_menu; ?>
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <?php
                    foreach ($submenu->result() as $sub) {
                    ?>
                      <li class="nav-item pl-1">
                        <a href="<?= base_url() . $sub->link; ?>" class="nav-link">
                          <i class="<?= $sub->icon; ?> nav-icon"></i>
                          <p><?= $sub->nama_menu; ?></p>
                        </a>
                      </li>
                    <?php
                    }
                    ?>
                  </ul>
                </li>
              <?php

              } else {
                //submenu false dan main menu true

              ?>

                <li class="nav-item">
                  <a href="<?= base_url(); ?><?= $main->link; ?>" class="nav-link">
                    <i class="nav-icon <?= $main->icon; ?>"></i>
                    <p>
                      <?= $main->nama_menu; ?>

                    </p>
                  </a>
                </li>
            <?php
              }
            }
            ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-baby-blue">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-2">
                  <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                  <?php $segment1 = $this->uri->segment(1);
                  $segment2 = $this->uri->segment(2);

                  if (empty($segment2)) {
                  ?>
                    <li class="breadcrumb-item active"><?php echo ucfirst($segment1); ?></li>
                  <?php } else if (empty($title)) { ?>
                    <li class="breadcrumb-item"><a href="<?= base_url($segment1); ?>"><?php echo ucfirst($segment1); ?></a></li>
                    <li class="breadcrumb-item active"><?php echo ucfirst($segment2); ?></li>
                  <?php } else { ?>
                    <li class="breadcrumb-item"><a href="<?= base_url($segment1); ?>"><?php echo ucfirst($segment1); ?></a></li>
                    <li class="breadcrumb-item active"><?php echo ucfirst($title); ?></li>
                    <!-- <li class="breadcrumb-item active"><?php echo ucfirst($segment2); ?></li> -->
                  <?php } ?>
                </ol>
              </nav>
            </div>

          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <?php echo $contents; ?>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 0.0.5
      </div>
      <span>Copyright &copy; Muhhi's Comp 2021 - <?= date('Y') ?></span>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->





  <!-- script -->
  <!-- script -->
  <!-- script -->


  <!-- AdminLTE App -->
  <script src="<?php echo base_url(''); ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url(''); ?>assets/dist/js/demo.js"></script>





  <!-- ################ Custom script ################ -->


  <!-- DataTable script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
      $("#tabel1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#tabel1_wrapper .col-md-6:eq(0)');
      $("#tabel2").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#tabel2_wrapper .col-md-6:eq(0)');
      $("#tabel3").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#tabel3_wrapper .col-md-6:eq(0)');
    });
  </script>

  <!-- role script -->
  <script>
    $('.form-check-input').on('click', function() {
      const menuId = $(this).data('menu');
      const roleId = $(this).data('role');

      $.ajax({
        url: "<?= base_url('role/change_access'); ?>",
        type: 'post',
        data: {
          menuId: menuId,
          roleId: roleId
        },
        success: function(e) {
          console.log(e);
          document.location.href = "<?= base_url('role/access_role/'); ?>" + roleId;
        }
      });
    });
  </script>


  <!-- sweet alert -->
  <script>
    $('.alert_hapus').on('click', function() {
      var getLink = $(this).attr('href');
      Swal.fire({
        title: 'Information',
        icon: 'warning',
        text: 'Yakin ingin menghapus?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then(result => {
        if (result.isConfirmed) {
          'Deleted!',
          window.location.href = getLink,
          'Success'
        }
      })
      return false;
    })

    $('.alert_ubah').on('click', function() {
      var getLink = $(this).attr('href');
      Swal.fire({
        title: 'Information',
        icon: 'warning',
        text: 'Yakin ingin mengubah data?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Ubah',
        cancelButtonText: 'Batal'
      }).then(result => {
        if (result.isConfirmed) {
          'Update Change!',
          window.location.href = getLink,
          'Success'
        }
      })
      return false;
    })

    $('.alert_hapus_siswa').on('click', function() {
      var getLink = $(this).attr('href');
      Swal.fire({
        title: 'Information',
        icon: 'warning',
        text: 'Yakin ingin menghapus? Jika menghapus siswa maka data orang tua dari siswa tersebut juga akan terhapus.',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then(result => {
        if (result.isConfirmed) {
          'Deleted!',
          window.location.href = getLink,
          'Success'
        }
      })
      return false;
    })
    // sweet alert logout
    $('.alert_logout').on('click', function() {
      var getLink = $(this).attr('href');
      Swal.fire({
        title: 'Information',
        icon: 'warning',
        text: 'Yakin ingin Keluar?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Keluar',
        cancelButtonText: 'Batal'
      }).then(result => {
        if (result.isConfirmed) {
          'Deleted!',
          window.location.href = getLink,
          'Success'
        }
      })
      return false;
    })
  </script>

  <!-- script filter data pada halaman kurikulum -->
  <script>
    $(document).ready(function() {
      $('#formFilter').submit(function(e) {
        e.preventDefault();
        const kdJurusan = $('#kd_jurusan').val();
        const kdTingkatan = $('#kd_tingkatan').val();
        const idKurikulum = $('#idKurikulum').val();

        // console.log(kdJurusan + kdTingkatan + idKurikulum);

        var url = "<?= base_url('kurikulum/filter/') ?>" + idKurikulum + "/" + kdJurusan + "/" + kdTingkatan;

        $('#result').load(url);
      });
    });

    // $('.filter').on('click', function() {
    //   const kdJurusan = $('#kd_jurusan').val();
    //   const kdTingkatan = $('#kd_tingkatan').val();
    //   const idKurikulum = $('#idKurikulum').val();

    //   console.log(kdJurusan + kdTingkatan + idKurikulum);


    // })
  </script>

</body>

</html>
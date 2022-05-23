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


</head>

<body class="hold-transition sidebar-mini text-md">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <h4 class="pt-1"><?php echo ucfirst($this->uri->segment(1)); ?> Page</h4 class="pt-1">
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?php echo base_url(''); ?>assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?php echo base_url(''); ?>assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?php echo base_url(''); ?>assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
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
    <aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
      <!-- Brand Logo -->
      <a href="<?php echo base_url(''); ?>assets/index3.html" class="brand-link">
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
            <img src="<?php echo base_url(''); ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php
            $sql_menu = "SELECT * FROM `tabel_menu` WHERE id IN(SELECT id_menu FROM tbl_user_rule WHERE id_level_user = 1) AND is_main_menu = 0";

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
                      <li class="nav-item pl-4">
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
                  <li class="breadcrumb-item"><a href="<?= base_url($segment1 . '/' . $title); ?>"><?php echo ucfirst($title); ?></a></li>
                  <li class="breadcrumb-item active"><?php echo ucfirst($segment2); ?></li>
                <?php } ?>
              </ol>
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
        <b>Version</b> 3.1.0
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

  <!-- jQuery -->
  <script src="<?php echo base_url(''); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(''); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(''); ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url(''); ?>assets/dist/js/demo.js"></script>

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

  <!-- SweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- sweet alert pesan  -->
  <?= $this->session->flashdata('pesan'); ?>

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
        url: "<?= base_url('admin/change_access'); ?>",
        type: 'post',
        data: {
          menuId: menuId,
          roleId: roleId
        },
        success: function() {
          document.location.href = "<?= base_url('admin/access_role/'); ?>" + roleId;
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
  </script>

</body>

</html>
<?php
    $session = \Config\Services::session();
    $request = \Config\Services::request();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/maarif.ico">
  <title>Admin | Sistem Pengelolaan Kas PKK Griya Bangkalan</title>
  <!-- Custom CSS -->
  <link href="/assets/css/style.css" rel="stylesheet">
  <link href="/libs/morris.js/morris.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
  <div class="lds-ripple">
    <div class="lds-pos"></div>
    <div class="lds-pos"></div>
  </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
  <!-- ============================================================== -->
  <!-- Topbar header - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
      <div class="navbar-header" data-logobg="skin6">
        <!-- This is for the sidebar toggle which is visible on mobile only -->
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
            class="ti-menu ti-close"></i></a>
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-brand">
          <!-- Logo icon -->
          <a href="/">
            <!-- dark Logo text -->
            <img src="/assets/img/logo-icon.png" alt="homepage" />
            <img src="/assets/img/logo-light-text.png" alt="homepage" />
          </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Toggle which is visible on mobile only -->
        <!-- ============================================================== -->
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
           data-toggle="collapse" data-target="#navbarSupportedContent"
           aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
            class="ti-more"></i></a>
      </div>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      <div class="navbar-collapse collapse" id="navbarSupportedContent" style="border-bottom-width: 0;">
        <!-- ============================================================== -->
        <!-- Right side toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav ml-auto">
          <!-- ============================================================== -->
          <!-- Search -->
          <!-- ============================================================== -->
          <li class="nav-item d-none d-md-block">
            <a class="nav-link" href="javascript:void(0)">
              <form action="/">
                <div class="customize-input">
                  <input class="form-control custom-shadow custom-radius border-0 bg-white"
                         type="search" placeholder="Search" aria-label="Search" name="q">
                  <i class="form-control-icon" data-feather="search"></i>
                   <button type="submit" class="d-none"></button>
                </div>
              </form>
            </a>
          </li>
          <!-- ============================================================== -->
          <!-- User profile and search -->
          <!-- ============================================================== -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
              <img src="/assets/img/profile-pic.jpg" alt="user" class="rounded-circle"
                   width="40">
              <span class="ml-2 d-none d-lg-inline-block"><span
                  class="text-dark"><?= @$session->nama; ?></span> <i data-feather="chevron-down"
                                                        class="svg-icon"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
              <a class="dropdown-item" href="javascript:void(0)"><i data-feather="user"
                                                                    class="svg-icon mr-2 ml-1"></i>
                My Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/logout"><i data-feather="power"
                                                                    class="svg-icon mr-2 ml-1"></i>
                Logout</a>
            </div>
          </li>
          <!-- ============================================================== -->
          <!-- User profile and search -->
          <!-- ============================================================== -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- ============================================================== -->
  <!-- End Topbar header -->
  <!-- ============================================================== -->
  <?php
    if ($session->role == 'admin'):
      echo $this->include('layouts/navbar_admin');
      
    elseif ($session->role == 'anggota'):
      echo $this->include('layouts/navbar_anggota');

    endif;

      if ($session->has('error-message')):
    ?>
        <div class="fixed-top mt-sm-2 mr-sm-2 alert-toast toast-alert">
            <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
                <div class="toast fade show" data-autohide="false" style="position: absolute; top: 0; right: 0;">
                    <div class="toast-header">
                        <?php if ($session->getFlashdata('error-status') == 'success'){ ?>
                          <strong class="mr-auto ml-2 text-success">Success</strong>
                        <?php  } else { ?>
                          <strong class="mr-auto ml-2 text-danger">Alert</strong>
                        <?php } ?>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        <?= $session->getFlashdata('error-message') ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
        endif;
    ?>

  <!-- ============================================================== -->
  <!-- Page wrapper  -->
  <!-- ============================================================== -->
  <div class="page-wrapper">

    <?= $this->renderSection('content') ?>

    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center text-muted">
      &copy; 2021 Kas PKK
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Page wrapper  -->
  <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="/libs/bootstrap/bootstrap.min.js"></script>
<script src="/libs/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
<script src="/libs//feather/feather.min.js"></script>
<!--Morris JavaScript -->
<script src="/libs/raphael/raphael.min.js"></script>
<script src="/libs/morris.js/morris.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<!--Custom JavaScript-->
<script src="/assets/js/sidebarmenu.js"></script>
<script src="/assets/js/custom.js"></script>

<script>
  $(document).ready(function() {
      $('#datatabel').DataTable();
      $('#select-1').change(function() {
        $.post("<?= base_url('apiangsur') ?>", {nik : $(this).val()}, function(res, status){
          const respons = JSON.parse(res);
          
          if (respons.status===false)
          {
            alert('Data pinjaman anggota tidak ditemukan!')
            return 0;
          }

          $('#kode').val(respons.data.id_pinjam)
          $('#ke').val(respons.data.ke)
          $('#jumlah').val(respons.data.bayar)

        });
      });

      $('.close').click(function() {
        $('.toast-alert').slideUp()
      })

      setTimeout(function(){ 
        $('.toast-alert').slideUp()
      }, 3000);
  } );
</script>
</body>
</html>
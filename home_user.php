<?php 
require "konek.php";
require_once("auth.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Desicion Support System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/dist/css/styles.css">
	<script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
  <style>	
		.text-justify { text-align:center; }	
		.text-right { text-align:right; }	
		.bg1, .bg2, .bg3 { background-color:#CCFFCC; }
		.bg6, .bg7, .bg8 { background-color:#FFFFCC; }
		th, td { padding:.3em .5em; }
		/* th { background-color:#EEEEEE; } */
	</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
    <ul class="navbar-nav">
      <li>
        <a class="nav-link text-white"  href="#" role="button"> <large><b>Desicion Support System - Rekomendasi Laptop</b></large></a>
      </li>
    </ul>
	<ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="logout.php" role="button">
          Logout
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-light elevation-4">
    <a href="#" class="brand-link bg-light" aria-expanded="true">
      <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 38px;height:50px"><?php echo "" ?></span>
      <span class="brand-text text-primary"><?php echo $_SESSION["user"]["nama_lengkap"] ?></span>
    </a>
   	
    <div class="sidebar">
      <nav class="mt-2">
      <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active bg-primary text-light" aria-current="page" href="home_user.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="fuzzy2.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Rekomendasi Laptop
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="chatuser.php">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Live Chat
                  </a>
                </li>
                
              </ul>
        
      </nav>
    </div>
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light">
  	 <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
	    <div class="toast-body text-white">
	    </div>
	  </div>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="col-lg-12">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h3 class="h5">Dashboard</h3>
                        </div>
						<div class="card" style="margin-top:20px;">
              <div class="card-body">
                <h3 class="text-primary" align="center">Sistem Pendukung Keputusan</h3>
				<h2 class="text-primary" align="center"><strong>Pemilihan Rekomendasi Laptop</strong></h2>
				<br>
				<p style="margin-right:20px; margin-left:20px;" align="justify">Sistem pendukung keputusan ini dibuat untuk membantu pengguna dalam menentukan pilihan rekomendasi untuk pembelian laptop. Rekomendasi laptop didapatkan dengan menggunakan logika fuzzy dari beberapa kriteria spesifikasi laptop yang telah ditentukan, seperti ukuran layar, kapasitas RAM, kapasitas HDD, dan harga Laptop. Pengguna dapat memilih kriteria laptop sesuai dengan kebutuhan.</p>
				<p style="margin-right:20px; margin-left:20px;" align="justify">Sistem pendukung keputusan ini juga dilengkapi dengan fitur live chat. Pengguna dapat bertanya tentang rekomendasi laptop kepada admin melalui fitur live chat. Pengguna juga dapat berdiskusi dengan pengguna lain melalui fitur live chat untuk mendapatkan lebih banyak informasi.</p>
			</div>
            </div>
      
  </div>
          <!-- </main> -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
  
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
</div>
</body>

</html>
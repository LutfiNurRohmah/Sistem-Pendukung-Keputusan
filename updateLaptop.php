<?php 
require "konek.php";
require_once("auth_admin.php");
$find= mysqli_select_db($mysqli, $database);
$query="SELECT * FROM laptop";
$execute = mysqli_query($mysqli, $query);

$id = $_GET['IdLaptop'];
$sql_read = "SELECT * FROM laptop WHERE id='$id'";
$execute_read = mysqli_query($mysqli, $sql_read);
$result_read = mysqli_fetch_assoc($execute_read);

if(isset($_POST['update'])){
    $type = @$_POST["laptop"];
    $layar = @$_POST["layar"];
    $ram = @$_POST["ram"];
    $hdd = @$_POST["hdd"];
    $harga = @$_POST["harga"];
	
	$sql = "UPDATE laptop SET type='$type', 
                            layar='$layar', 
                            ram='$ram', 
                            hdd='$hdd', 
                            harga='$harga'
          WHERE id='$id'";
	$execute = mysqli_query($mysqli, $sql);
	
	if($execute){
		header('Location:kelola_data.php');
	}else{
		echo "GAGAL UPDATE DATA";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Update Data Laptop</title>

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

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
            <ul class="navbar-nav">
                <li>
                    <a class="nav-link text-white"  href="#" role="button"> <large><b>Desicion Support System - Penentuan Rekomendasi Laptop</b></large></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="logout_admin.php" role="button">
                    Logout
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-light elevation-4">
            <a href="#" class="brand-link bg-light" aria-expanded="true">
                <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 38px;height:50px"><?php echo "" ?></span>
                <span class="brand-text text-primary"><?php echo $_SESSION["admin"]["nama_admin"] ?></span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home_admin.php">
                            <span data-feather="home" class="align-text-bottom"></span>
                            Dashboard
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active bg-primary text-light" href="kelola_data.php">
                            <span data-feather="file" class="align-text-bottom"></span>
                            Data Laptop
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="fuzzy.php">
                            <span data-feather="shopping-cart" class="align-text-bottom"></span>
                            Metode Fuzzy
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="kelola_jadwal.php">
                            <span data-feather="users" class="align-text-bottom"></span>
                            Kelola Jadwal Tayang
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="kelola_transaksi_tiket.php">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Kelola Transaksi Tiket
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
                        <h3 class="h5">Data Laptop</h3>
                        </div>
                        <!-- input film -->
                                    <form method=post action="<?php $_SERVER['PHP_SELF']?>">
                                    <h6 class="h6">Update Jadwal</h6>
                                    <div class="row mb-3">
                                        <label for="inputJudul" class="col-sm-2 col-form-label">Type Laptop</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="laptop" class="form-control" id="inputJudul" value="<?=$result_read['type']?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputGenre" class="col-sm-2 col-form-label">Ukuran Layar</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="layar" class="form-control" id="inputGenre" value="<?=$result_read['layar']?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputDurasi" class="col-sm-2 col-form-label">Kapasitas RAM</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="ram" class="form-control" id="inputDurasi" value="<?=$result_read['ram']?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputGenre" class="col-sm-2 col-form-label">Kapasitas HDD</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="hdd" class="form-control" id="inputGenre" value="<?=$result_read['hdd']?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputGenre" class="col-sm-2 col-form-label">Harga</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="harga" class="form-control" id="inputGenre" value="<?=$result_read['harga']?>">
                                        </div>
                                    </div>
        <button type="submit" class="btn btn-primary" name="update">Simpan</button>
</form>

         

                        
                    </div>
                    <!-- </main> -->
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>
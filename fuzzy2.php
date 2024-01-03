<?php 
require "konek.php";
require_once("auth.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Rekomendasi Laptop</title>

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
		.bg1, .bg2 { background-color:#CCFFCC; }
        .bg3, .bg4, .bg5 { background-color:#FFFFCC; }
        .bg6, .bg7 { background-color:#CCFFCC; }
		.bg8, .bg9, .bg10 { background-color:#FFFFCC; }
		th, td { padding:.3em .5em; }
		/* th { background-color:#EEEEEE; } */
	</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
    <ul class="navbar-nav">
      <li>
        <a class="nav-link text-white"  href="#" role="button"> <large><b>Desicion Support System - Rekomendasi Laptop - Metode Fuzzy</b></large></a>
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
    <a href="#" class="brand-link" aria-expanded="true">
      <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 38px;height:50px"><?php echo "" ?></span>
      <span class="brand-text text-primary"><?php echo $_SESSION["user"]["nama_lengkap"] ?></span>
    </a>
   	
    <div class="sidebar">
      <nav class="mt-2">
      <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="home_user.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active bg-primary text-light" href="fuzzy2.php">
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
                        <h3 class="h5">Rekomendasi Laptop</h3>
                        </div>
                        <p>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Data Laptop dan Derajat Keanggotaan
            </button>
          </p>
          <div class="collapse" id="collapseExample">
            <div class="card card-body">
            
              <h6 class="h6">Data Laptop dan Derajat Keanggotaan</h6>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "dss_uas");

                    function cek_selected($cek, $value)	{
                        if($cek == $value) {
                            echo "selected=\"selected\"";
                        }		
                    }	
                        
                    function format_desimal($nn, $des) {
                        return number_format($nn, $des, ",", ".");
                    }

                    function get_namakelompok($id_kelompok, $con)	{
                        $hasil = mysqli_query($con, "SELECT * FROM kelompok WHERE id = '$id_kelompok'");
                        $row = mysqli_fetch_array($hasil);
                        return $row['nama_kelompok'];
                    }	
                        
                    function derajat_keanggotaan($nilai, $bawah, $tengah, $atas) {
                        $selisih = $atas - $bawah;	
                        if($nilai < $bawah) {
                            $DA = 0;	
                        } elseif (($nilai >= $bawah) && ($nilai <= $tengah)) {
                            if($bawah <= 0) {
                                $DA = 1;
                            } else {
                                $DA = ((float)$nilai - (float)$bawah) / ((float)$tengah - (float)$bawah);	
                            }
                        } elseif (($nilai > $tengah) && ($nilai <= $atas)) {
                            $DA = ((float)$atas - (float)$nilai) / ((float)$atas - (float)$tengah);
                        } elseif($nilai > $atas) {
                            $DA = 0;
                        }
                        return $DA;	
                    }
            
                    $ux[][] = NULL;  // variabel utk data derajat keanggotaaan
            
                    $kelompok = isset($_GET['kelompok']) ? $_GET['kelompok'] : 1;
                    $hasil_kelompok	= mysqli_query($con, "SELECT * FROM kelompok WHERE id = '$kelompok'");
                    $row_kelompok = mysqli_fetch_array($hasil_kelompok);
                    
                    $hasil = mysqli_query($con, "SELECT * FROM kriteria order by id asc");
                    $jumkol = mysqli_num_rows($hasil);
                    ?>

                    <table class="table table-bordered" style="margin-bottom:40px; font-size: 14px;">
                        <thead class="table-primary">
                            <tr>
                                <th rowspan="2">ID</th>
                                <th width="100" rowspan="2">Type Laptop</th>
                                <th rowspan="2">Ukuran Layar</th>
                                <th rowspan="2">Kapasitas RAM</th>
                                <th rowspan="2">Kapasitas HDD</th>
                                <th rowspan="2">Harga</th>
                                <th colspan="2">(&#956;[x]) <?= get_namakelompok(1, $con);?></th>
                                <th colspan="3">(&#956;[x]) <?= get_namakelompok(2, $con);?></th>
                                <th colspan="2">(&#956;[x]) <?= get_namakelompok(3, $con);?></th>
                                <th colspan="3">(&#956;[x]) <?= get_namakelompok(4, $con);?></th>
                            </tr>
                            <tr>
                                <?php
                                $hasil = mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok = '1' order by id asc");
                                while($row = mysqli_fetch_array($hasil)) {
                                    echo "<th>" . $row['nama_kriteria'] . "</th>";
                                }

                                $hasil = mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok = '2' order by id asc");
                                while($row = mysqli_fetch_array($hasil)) {
                                    echo "<th>" . $row['nama_kriteria'] ."</th>";
                                }

                                $hasil = mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok = '3' order by id asc");
                                while($row = mysqli_fetch_array($hasil)) {
                                    echo "<th>" . $row['nama_kriteria'] . "</th>";
                                }

                                $hasil = mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok = '4' order by id asc");
                                while($row = mysqli_fetch_array($hasil)) {
                                    echo "<th>" . $row['nama_kriteria'] . "</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $hasil = mysqli_query($con, "SELECT * FROM laptop");
                            while($row=mysqli_fetch_array($hasil)) {
                            ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['type']; ?></td>
                                <td class="text-right"><?= $row['layar']; ?></td>
                                <td class="text-right"><?= $row['ram']; ?></td>
                                <td class="text-right"><?= $row['hdd']; ?></td>
                                <td class="text-right"><?= format_desimal($row['harga'], 2); ?></td>
                                <?php
                                $hasil2	=mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok = '1' order by id asc");
                                while($row2 = mysqli_fetch_array($hasil2)) {
                                    $u = derajat_keanggotaan($row['layar'], $row2['bawah'], $row2['tengah'], $row2['atas']);
                                    $ux[$row['id']][$row2['id']] = $u;
                                    $bg = "text-right";
                                    if(isset($_GET['layar']) && ($row2['id'] == $_GET['layar'])) {
                                        $bg .= " bg" . $row2['id'];
                                    }
                                    ?>	
                                    <td class="<?= $bg; ?>"><?= format_desimal($u, 2); ?></td>
                                    <?php
                                }
                                ?>
                                <?php
                                $hasil2	= mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok='2' order by id asc");
                                while($row2 = mysqli_fetch_array($hasil2)) {
                                    $u = derajat_keanggotaan($row['ram'], $row2['bawah'], $row2['tengah'], $row2['atas']);
                                    $ux[$row['id']][$row2['id']] = $u;
                                    $bg = "text-right";
                                    if(isset($_GET['ram']) && ($row2['id'] == $_GET['ram'])) {
                                        $bg .= " bg" . $row2['id'];
                                    }
                                    ?>
                                    <td class="<?= $bg; ?>"><?= format_desimal($u, 2); ?></td>
                                    <?php
                                }

                                $hasil2	= mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok='3' order by id asc");
                                while($row2 = mysqli_fetch_array($hasil2)) {
                                    $u = derajat_keanggotaan($row['hdd'], $row2['bawah'], $row2['tengah'], $row2['atas']);
                                    $ux[$row['id']][$row2['id']] = $u;
                                    $bg = "text-right";
                                    if(isset($_GET['hdd']) && ($row2['id'] == $_GET['hdd'])) {
                                        $bg .= " bg" . $row2['id'];
                                    }
                                    ?>
                                    <td class="<?= $bg; ?>"><?= format_desimal($u, 2);  ?></td>
                                    <?php
                                }

                                $hasil2	= mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok='4' order by id asc");
                                while($row2 = mysqli_fetch_array($hasil2)) {
                                    $u = derajat_keanggotaan($row['harga'], $row2['bawah'], $row2['tengah'], $row2['atas']);
                                    $ux[$row['id']][$row2['id']] = $u;
                                    $bg = "text-right";
                                    if(isset($_GET['harga']) && ($row2['id'] == $_GET['harga'])) {
                                        $bg .= " bg" . $row2['id'];
                                    }
                                    ?>
                                    <td class="<?= $bg; ?>"><?= format_desimal($u,2); ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                        </div>
                        </div>
        <br>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-top border-bottom">
            <h3 class="h5"><strong>Query</strong></h3>
        </div>
        
        <form action="" method="GET">
            <div class="row mb-3">
                <label for="inputIDFilm" class="col-sm-2 col-form-label">Ukuran Layar</label>
                <div class="col-sm-5">
                    <select type="text" name="layar" class="form-select form-control" aria-label="Default select example">
                        <option value=" " selected>Pilih Ukuran Layar</option>
                        <option value="1" <?php if(isset($_GET['layar'])) cek_selected($_GET['layar'],1); ?>>Layar Kecil</option>
                        <option value="2" <?php if(isset($_GET['layar'])) cek_selected($_GET['layar'],2); ?>>Layar Besar</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
            <label for="inputIDFilm" class="col-sm-2 col-form-label">Kapasitas RAM</label>
            <div class="col-sm-5">
                <select type="text" name="ram" class="form-select form-control" aria-label="Default select example">
                    <option value=" " selected>Pilih Kapasitas RAM</option>
                    <option value="3" <?php if(isset($_GET['ram'])) cek_selected($_GET['ram'],3); ?>>RAM Kecil</option>
                    <option value="4" <?php if(isset($_GET['ram'])) cek_selected($_GET['ram'],4); ?>>RAM Sedang</option>
                    <option value="5" <?php if(isset($_GET['ram'])) cek_selected($_GET['ram'],5); ?>>RAM Besar</option>
                </select>
            </div>
            </div>
            <div class="row mb-3">
            <label for="inputIDFilm" class="col-sm-2 col-form-label">Kapasitas HDD</label>
            <div class="col-sm-5">
                <select type="text" name="hdd" class="form-select form-control" aria-label="Default select example">
                    <option value=" " selected>Pilih Kapasitas HDD</option>
                    <option value="6" <?php if(isset($_GET['hdd'])) cek_selected($_GET['hdd'],6); ?>>HDD Kecil</option>
                    <option value="7" <?php if(isset($_GET['hdd'])) cek_selected($_GET['hdd'],7); ?>>HDD Besar</option>
                </select>
            </div>
            </div>
            <div class="row mb-3">
            <label for="inputIDFilm" class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-5">
                <select type="text" name="harga" class="form-select form-control" aria-label="Default select example">
                    <option value=" " selected>Pilih Harga</option>
                    <option value="8" <?php if(isset($_GET['harga'])) cek_selected($_GET['harga'],8); ?>>Harga Murah</option>
                    <option value="9" <?php if(isset($_GET['harga'])) cek_selected($_GET['harga'],9); ?>>Harga Sedang</option>
                    <option value="10" <?php if(isset($_GET['harga'])) cek_selected($_GET['harga'],10); ?>>Harga Mahal</option> 
                </select>
            </div>
            </div>
            <div class="row mb-3">
                <label for="inputIDFilm" class="col-sm-2 col-form-label">Operator Logika</label>
                <div class="col-sm-5">
                    <select type="text" name="opr" class="form-select form-control" aria-label="Default select example">
                        <option value=" " selected>Pilih Operator</option>
                        <option value="OR" <?php if(isset($_GET['opr'])) cek_selected($_GET['opr'],"OR"); ?>>OR</option>
                        <option value="AND" <?php if(isset($_GET['opr'])) cek_selected($_GET['opr'],"AND"); ?>>AND</option>
                        </select>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="fuzzy2.php"><button type="button" class="btn btn-primary">Reset</button></a>
                        </form>
        

        <br>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-top border-bottom">
            <h3 class="h5"><strong>Hasil</strong></h3>
        </div>

        <table class="table table-bordered" style="margin-bottom:40px; font-size: 14px;">
                        <thead class="table-primary">
                            <tr>
                                <th >ID</th>
                                <th >Type Laptop</th>
                                <th >Ukuran Layar</th>
                                <th >Kapasitas RAM</th>
                                <th >Kapasitas HDD</th>
                                <th >Harga</th>
                                <th >Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['opr'])) {
                                $opr = $_GET['opr'];
                                $layar = $_GET['layar'];
                                $ram = $_GET['ram'];
                                $hdd = $_GET['hdd'];
                                $harga = $_GET['harga'];	
                                
                                $hasil = mysqli_query($con, "SELECT * FROM laptop");
                                
                                while($row = mysqli_fetch_array($hasil)) {
                                    // ambil data derajat keanggotaan	
                                    $c1 = $ux[$row['id']][$layar];
                                    $c2 = $ux[$row['id']][$ram];
                                    $c3 = $ux[$row['id']][$hdd];
                                    $c4 = $ux[$row['id']][$harga];
                                    
                                    // tentukan operasi
                                    if ($opr == "OR") {
                                        $cc = max($c1, $c2, $c3, $c4);
                                    } else {
                                        $cc = min($c1, $c2, $c3, $c4);
                                    }
                    
                                    if ($cc > 0) {
                                         ?>
                                        <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['type']; ?></td>
                                        <td class="text-right"><?= $row['layar']; ?></td>
                                        <td class="text-right"><?= $row['ram']; ?></td>
                                        <td class="text-right"><?= $row['hdd']; ?></td>
                                        <td class="text-right"><?= format_desimal($row['harga'], 2); ?></td>
                                        <td class="text-right"><?= format_desimal($cc, 2); ?></td>
                                        <?php
                                    }
                                    
                                }
                            }

                            
                            ?>
                            
                        </tbody>
                    </table>

        
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
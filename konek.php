<?php
 $user_name = "root";
 $password  = "";
 $database  = "dss_uas";
 $host_name = "localhost";

 $mysqli= mysqli_connect($host_name, $user_name, $password, $database) or die('Koneksi ke database gagal!');
 ?>
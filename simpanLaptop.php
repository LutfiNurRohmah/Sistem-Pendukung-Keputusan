<?php
require "konek.php";
require_once("auth_admin.php");
$find= mysqli_select_db($mysqli, $database);

$type = @$_POST["laptop"];
$layar = @$_POST["layar"];
$ram = @$_POST["ram"];
$hdd = @$_POST["hdd"];
$harga = @$_POST["harga"];


$query="INSERT INTO laptop (type, layar, ram, hdd, harga) 
        VALUES('$type', '$layar', '$ram', '$hdd', '$harga')";
$simpan= mysqli_query($mysqli, $query);
if($simpan){
    header("Location:kelola_data.php");
}else{
    echo "Data gagal disimpan";}

?>
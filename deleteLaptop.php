<?php
require "konek.php";
require_once("auth_admin.php");

$id = $_GET['IdLaptop'];
$sql = "DELETE FROM laptop WHERE id='$id'";
$execute= mysqli_query($mysqli, $sql);

if($execute){
	header("Location:kelola_data.php");
}
else{
	echo '<script>alert("Gagal Menghapus")</script>';
}
?>
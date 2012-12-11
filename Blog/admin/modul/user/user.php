<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])) {
	echo "Untuk Mengakses Modul ini, Anda harus login<br>";
	echo "<a href=../../index.php><b>Login Kembali</b></a>";
}else{
	$aksi = "modul/user/user.php";
}
?>
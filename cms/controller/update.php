<?php
	include '../config/koneksi.php';

	$iduser = $_POST['iduser'];
	$name = $_POST['username'];
	$pass = $_POST['password'];
	$nama = $_POST['namalengkap'];
	$email = $_POST['email'];

	mysql_query("UPDATE user set username = '$name', password = '$pass', namalengkap = '$nama', email = '$email' where iduser = '$iduser'");
	//echo "Berhasil DIPUPDATE";
	header('location:../admin/Tampil-User.php');

?>
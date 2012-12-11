<?php
	include '../config/koneksi.php';

	$id= $_POST['idusername'];
	$username = $_POST['username'];
	$pass = $_POST['password'];
	$nama = $_POST['namalengkap'];
	$email = $_POST['email'];

	if (empty($id)) {
		echo "Harap, Nama Terlebih dahulu di isi !";
	}elseif (empty($username)) {
		echo "Harap Username Diisi Terlebih Dahulu !";
	}elseif (empty($pass)) {
		echo "Harap Password terlbehi Dahulu Diisi !";
	}elseif (empty($nama)) {
		echo "Harap Nama Terlebih Dahulu Diisi";
	}elseif (empty($email)) {
		echo "Harap Email terlebih dahulu di isi";
	}else{
		mysql_query("INSERT into user (iduser,username,password,namalengkap,email) values('$id','$username','$pass','$nama','$email')");
		header("location:../admin/Tampil-User.php");

	}


	
?>
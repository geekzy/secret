<?php
session_start();
include "../../config/koneksi.php";

$module = $_GET[module];
$aksi = $_GET[act];


#### Hapus Data ####

if (isset($module) AND $act=='hapus') {
	mysql_query("DELETE FROM user WHERE username='$_GET[username]'");
	header("location:media.php?module=$module");
}


#### Input User ####

elseif ($module == 'user' AND $act == 'input') {
	$username = $_POST['username'];
	$pass = $_POST['password'];
	$nama = $_POST['namalengkap'];
	$email = $_POST['email'];
	$telp = $_POST['telp'];
	mysql_query("INSERT INTO user(username,password,namalengkap,email,no_telp) VALUES('$username','$pass','$nama','$email','$telp')");
	header("location:media.php?module=$module");
}


#### Update User ####

elseif ($module == 'user' AND $act == 'update') {
	$username = $_POST['username'];
	$pass = $_POST['password'];
	$nama = $_POST['namalengkap'];
	$email = $_POST['email'];
	$telp = $_POST['telp'];
	$blokir = $_POST['blokir'];

	mysql_query("UPDATE user set username='$username',password='$pass',namalengkap='$nama',email='$email',no_telp='$telp', blokir='$blokir' where username = '$username'").mysql_error();
	
	header("location:media.php?module=$module");
}

if (isset($module)AND $act =='delete') {
	mysql_query("DELETE FROM modul WHERE nama_modul='$_GET[nama_modul]'");
	header("location:media.php?module=$module");
}

#### Add Module ####

elseif ($module == 'module' AND $act =='addmodule') {
	$namamodul = $_POST['namamodule'];
	$link = $_POST['link'];
	// $publish = $_POST['publish'];
	// $status = $_POST['status'];

	mysql_query("INSERT INTO modul(nama_modul,link) VALUES('$namamodul','$link')".mysql_error());
	header("location:media.php?module=$module");
}


?>
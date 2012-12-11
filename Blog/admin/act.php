<?php
session_start();
include "../config/koneksi.php";

$module = $_GET[module];
$aksi = $_GET[act];



########################################
####	Bagian User Management	####
########################################


#### Hapus User ####

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

if (isset($module) AND $act1 =='delete') {
	mysql_query("DELETE * FROM modul WHERE nama_modul='$_GET[nama_modul]'");
	header("location:media.php?module=$module");
}



########################################
####	Bagian Module Management	####
########################################




#### Add Module ####

elseif ($module == 'modull' AND $act1 =='addmodule') {
	$namamodul = $_POST['namamodul'];
	$link = $_POST['link'];
	$pub = $_POST['publish'];
	$status = $_POST['status'];
	$urutan = $_POST['urutan'];
	mysql_query("INSERT INTO modul(nama_modul,link,publish,status,urutan) VALUES('$namamodul','$link','$pub','$status','$urutan')".mysql_error());
	header("location:media.php?module=$module");
}


?>
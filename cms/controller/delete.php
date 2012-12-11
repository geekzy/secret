<?php
	require '../config/koneksi.php';

	//$id = $_GET['iduser'];

	mysql_query("DELETE FROM user where iduser ='$_GET[iduser]'");
	header('location:../admin/Tampil-User.php');
?>
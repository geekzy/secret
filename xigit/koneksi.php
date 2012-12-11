<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "cms";


	$koneksi = mysql_connect($host,$user,$pass);
	if ($koneksi) {
		$sql = mysql_select_db($db);
		echo "Koneksi Sukses";
		if (!$sql) {
			echo "Database Tidak Ada";
		}
	}else{
		echo "Server Tidak Terhubung";
	}
?>
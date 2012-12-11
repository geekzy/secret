<?php
	// Inisialisasi
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "cms";

	$koneksi = mysql_connect($dbhost,$dbuser,$dbpass);
	if ($koneksi) {
		$buka = mysql_select_db($dbname);
		if (!$buka) {
			echo "Database Tidak Terhubung";
		}
		}else{
			die("Server Tidak Terhubung");
	}
?>
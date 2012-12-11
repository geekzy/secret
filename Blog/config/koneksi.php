<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "cms";

	$koneksi = mysql_connect($host,$user,$pass);
	if ($koneksi) {
		$pilih = mysql_select_db($db);
		if (!$pilih) {
			echo "Database Tidak Terhubung".mysql_error();
		}
	}else{
		echo "Server Tidak Terhubung".mysql_error();
	}

?>
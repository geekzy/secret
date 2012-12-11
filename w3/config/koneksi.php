<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "w3";
//koneksi dan memilih database server
mysql_connect($server,$username,$password) or die("gagal");
mysql_select_db($database) or die ("Database Tidak Ditemukan");

?>
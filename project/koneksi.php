<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "dbmedia";
//koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("gagal");
mysql_select_db("$database") or die("database tidak ditemukan");

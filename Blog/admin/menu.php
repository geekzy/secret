<?php
session_start();
include "../config/koneksi.php";

if ($_SESSION[level] =='admin') {
	$sql = mysql_query("SELECT * from modul order by urutan");
}else{
	$sql = mysql_query("SELECT * FROM modul where status = 'user' order by urutan");
}
while ($data = mysql_fetch_array($sql)) {
	echo "<li class=''><a href='$data[link]'>$data[nama_modul]</a></li>";
}
?>
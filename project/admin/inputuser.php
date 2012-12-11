<?php
include "../koneksi.php";
//enkripsi password sebelum  disimpan database
$pass=md5($_POST['password']);
mysql_query("insert into user(iduser,password,namalengkap,email) values ('$_POST[iduser]','$pass','$_POST[namalengkap]','$_POST[email]')");
header('location:tampiluser.php');
?>
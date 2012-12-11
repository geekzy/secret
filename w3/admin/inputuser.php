<?php
include '../config/koneksi.php';
//enkripsi password sebelum masuk database
$pass=md5($_POST[inputpassword]);
mysql_query("insert into user(username,password,nama,email) 
					values ('$_POST[inputusername]', '
							 $pass','$_POST[inputnama]',
						    '$_POST[inputemail]')");

header('location:tampiluser.php');
?>
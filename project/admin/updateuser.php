<?php
include "../koneksi.php";
//apabila pass tidak diubah
if (empty($_POST[password])){
	mysql_query("update user set iduser='$_POST[iduser]', 
								 namalengkap ='$_POST[namalengkap]', 
								 email = '$_POST[email]' 
				where 			 iduser ='$_POST[iduser]'");

}
//apabila password diubah
else{
	$pass=md5($_POST[password]);
	mysql_query("update user set iduser ='$_POST[iduser]', 	
								  password = '$pass', 
								  namalengkap = '$_POST[namalengkap]',
								  email = '$_POST[email]' 
				where 			  iduser ='$_POST[iduser]'");

}
header ('location:tampiluser.php');
?>
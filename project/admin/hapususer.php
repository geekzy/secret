<?php
include "../koneksi.php";
mysql_query (" Delete from user where iduser ='$_GET[iduser]'");
header ('location:tampiluser.php');
?>
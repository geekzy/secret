<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname = "localhost";
$database = "tulang";
$username = "root";
$password = "";
$koneksi = mysql_pconnect($hostname, $username, $password) or die(mysql_error());
mysql_select_db($database);
?>
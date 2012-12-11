<?php
require_once("../include/database.php");

if (isset($database)) {
		echo "True";
	}else{
		echo "False";
	}


	echo "<br>";
	echo $database->escape_value("It's Working <br>");

	$sql = "INSERT INTO users(id,username,password,firstname,lastname)";
	$sql .= "VALUES(1, 'bayu', 'secretpassword', 'Bayu', 'Nugroho')";
	$hasil = $database->query($sql); 

	$sql = "SELECT * from users where id = 1";
	$hasil_set = $database->query($sql);
	$ketemu = $database->mysql_fetch($hasil_set);
	echo $ketemu['username'];


?>
<?php
	session_start();
	require '../config/koneksi.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$username = stripslashes($username);
	$password = stripslashes($password);

	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);


	$sql = "SELECT * from user where username = '$username' AND password = '$password' ";
	$hasil = mysql_query($sql);
	$return = mysql_fetch_array($hasil);
	$count = mysql_num_rows($hasil);

	if (isset($username) == $return['username'] AND isset($password) == $return['password']) {
		$_SESSION['username'] = $return['username'];
		$_SESSION['password'] = $return['password'];
		$_SESSION['level'] = $return['level'];
		if ($_SESSION['level'] == "Admin") {
			header('location:Admin.php');
		}elseif ($_SESSION['level'] == "User") {
			header('location:Tampil-User.php');
		}
	}elseif (	empty($username)) {
		echo "Username Salah";
	}elseif (empty($password)) {
		echo "Password Salah";
	}else{
		echo "Username Dan Password harap Di isi";
	}

	ob_end_flush();
?>	
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
		if ($_SESSION['level'] == "admin") {
			header('location:dashboard.php');
		}elseif ($_SESSION['level'] == "User") {
			header('location:tampiluser.php');
		}
	}elseif (empty($username)) {
		echo "Username Harus Diisi";
	}elseif (empty($password)) {
		echo "Password Harus Diisi";
	}else{
		echo "<h2><em><font color = 'red'>Username ATAU Password Anda Salah </h2></em></font>";
	}

	ob_end_flush();
?>	
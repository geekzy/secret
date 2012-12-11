<?php
	require '../config/koneksi.php';

	$username = $_POST['username'];
	$pass = $_POST['password'];
	$sql = mysql_query("SELECT * from user where username = '$username' AND password = '$password'");

	$hasil = mysql_fetch_array($sql);
	if ($hasil ['username'] == $username and $hasil ['password' == $pass]) {
		// Set Data
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $pass;
		header('location:Admin.php');
	}else{
		$error = "";
		if (empty($username) and empty($_POST['password'])) {
			$error = "Username dan Password Tidak Boleh Kosong";
		}elseif (empty($username)) {
			$error = "<b> Username Kosong";
		}elseif (empty($pass)) {
			$error = "Password Tidak boleh Kosong";
		}else{
			$error = " Username dan Password Tidak Sesuai";
		}
		echo "<h4>Login Gagal</h4><p> $error.<br>
				<a href='index.php'>Login Kembali</a>	";
	}
?>





<?php
	session_start();
	echo "<pre>";
	var_dump($_SESSION);
	echo "</pre>";
	require_once '../config/koneksi.php';

	$username = $_POST['username'];
	$pass = $_POST['password'];
	
	// Validasi
	$error = 0;
	if (empty($username) && empty($pass)) {
		echo "Username dan Password tidak boleh kosong";
	/*}elseif (empty($username)) {
		echo "Username tidak boleh kosong";
	}elseif (empty($pass)) {
		echo("Password tidak boleh kosong");
		*/
		$error++;
	}else{
		$sql = "SELECT * FROM user where username= '$username' AND passowrd = '$pass'";
		$hasil = mysql_query($sql);

		if ($sukses = mysql_fetch_array($hasil)) {
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $pass;
			header('location:Admin.php');
			exit();
		}else{
			echo "<a href=index.php>Kembali</a>";
			exit();
		}
	}
?>




<?php
	session_start();
	include '../config/koneksi.php';

	$sql = mysql_query("SELECT * FROM user where username='$_POST[username]' AND password='$_POST[password]'");
	$ketemu = mysql_num_rows($sql);
	$sukses = mysql_fetch_array($ketemu);

	if ($ketemu) {
		session_start();

		$_SESSION['username'] = $sukses['username'];
		$_SESSION['password'] = $sukses['password'];
		header('location:Admin.php');
	}else{
		echo("<a href='index.php'> Kembali</a>");
			exit();
	
	}

?>


<?php
	session_start();
	require_once '../config/koneksi.php';

	//	$username = $_POST['username'];
	//	$pass = $_POST['password'];

	$login = mysql_query("SELECT * FROM user where username=$_POST[username] AND password = $_POST[password]");

	$rowcount = mysql_num_rows($login);
	if ($rowcount == 1) {
		$_SESSION['username'] = $_POST['username'];
		header('location:Admin.php');
	}else{
		echo "Maaf username atau password anda salah";
		echo "<a href=index.php>Login Kembali</a>";
	}
?>


<?php
	require '../config/koneksi.php';
	

	$username = $_POST['username'];
	$pass = $_POST['password'];
	$sql = mysql_query("SELECT * from user where username = '$username' AND password = '$pass'");

	$hasil = mysql_fetch_array($sql);
	if ($hasil ['username'] == $username and $hasil ['password'] == $pass) {
		// Set Data
		$_SESSION['username'] = $a;
		$_SESSION['password'] = $b;
		header('location:Admin.php');
	}else{
		$error = "";
		if (empty($username) && empty($pass)) {
			echo "Username dan Password Tidak Boleh Kosong";
		}elseif (empty($user)) {
			$error = "<b> Username Kosong";
		}elseif (empty($password)) {
			$error = "Password Tidak boleh Kosong";
		}else{
			$error = " Username dan Password Tidak Sesuai";
		}
		echo "<h4>Login Gagal</h4><p> $error.<br>
				<a href='index.php'>Login Kembali</a>	";
	}
?>	
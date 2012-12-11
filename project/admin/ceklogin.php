<?php
	session_start();
	include "../koneksi.php";
	
	// Ambil variabel	
	$userid = $_POST['iduser'];
	$pass = md5 ($_POST['password']);	
	
	// Validasi
	$error = 0;
	if (empty($userid) || empty($pass)){
		echo "<script>alert(\"Username dan Password tidak Boleh Kosong\");</script>";
		$error++;
	}else{
		$sql = "Select * from user where iduser='$iduser' AND password='$pass'";
		$query = mysql_query($sql);		
		// Daftarkan Ke server
		if($hasil = mysql_fetch_array($query)){
			$_SESSION['user'] = $iduser;
			$_SESSION['pass'] = $pass;
			//if()
			header('location:formberita.php');
			exit();
			}else{
			echo("<a href='formlogin.php'> Kembali</a>");
			exit();
	}
		
	}
	
?>
<?php
	include "../config/koneksi.php";

	function anti_injection($data){
		$saring = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
		return $saring;
	}

	$username = anti_injection($_POST['username']);
	$pass = anti_injection($_POST['password']);

	$login = mysql_query("SELECT * FROM user where username='$username' and password = '$pass' AND blokir='N'");
	$hasil = mysql_num_rows($login);
	$r = mysql_fetch_array($login);


	// apabila usernam dan password ditemukan
	if ($hasil > 0 ) {
		session_start();
		include "timeout.php";
		$_SESSION[username] = $r[username];
		$_SESSION[password] = $r[password];
		$_SESSION[namalengkap] = $r[namalengkap];
		$_SESSION[level] = $r[level];

		// session timeout

		$_SESSION[login] = 1;
		timer();

		$idlama = session_id();
		session_regenerate_id();
		$idbaru = session_id();

		mysql_query("UPDATE user set idsession = '$idbaru' where username='$username' ");
		header("location:media.php?module=home");
	}else{
		//header("location:index.php");
		echo "Gak Bisa Login";
	}

?>
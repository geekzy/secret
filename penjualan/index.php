<?
//harus pake session_start krn ada login
session_start();
//include file untuk koneksi database
include ("conn.inc.php");

//ini kalo tombol dengan nama btninput diklik (ini adalah tombol dengan tulisan 'Log In'
if(isset($_POST['btninput'])){
	//siapin variabel untuk queri
	//password di encrypt	
	$sql = "select username, nama from masteruser where username='".$_POST['txtuserid']."' and password=password('".$_POST['txtuserpass']."')";
	//quernya baru dijalankan
	$rs = mysql_query($sql);
	//datanya diambil dalam bentuk array
	if($data=mysql_fetch_row($rs)){
		//$data[0] -> menunjukkan field yang pertama diambil (dala hal ini adalah username (liat baris 11))
		//$data[1] -> field nama
		//siapin variabel session
		$_SESSION['suid'] = $data[0];
		$_SESSION['snama'] = $data[1];
		//balikin ke halaman utama
		echo "<script>document.location='main.php'</script>";
	} else {
		session_destroy();
		$err = "Username atau password salah!";
	}
}
//panggil bagian atas dokumen
include "header.inc.php";

?>
<!-- bikin form dengan method post -->
<form method="post">
<table border="0" width="30%" cellpadding="3" cellspacing="0" align="center" bgcolor="yellow">
<tr>
	<td colspan="2">
		<h2>Login User </h2>
		<?
		//jika variabel $err sudah dibuat, tampilkan 
		if(isset($err)) echo "<div id='error'>$err</div><br>";
		?>
	</td>
</tr>
<tr>
	<td width="45%" align="right">Username</td>
	<td><input type="text" name="txtuserid" size="10" maxlength="10" /></td>
</tr>
<tr>
	<td align="right">Password :</td>
	<td><input type="password" name="txtuserpass" size="10" maxlength="144" /></td>
</tr>
<tr>
	<td colspan="2" align="right">
		<input type="submit" name="btninput" value="Log In" />
	</td>
</tr>
</table>
</form>
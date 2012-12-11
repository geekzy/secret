<?
session_start();
//panggil halaman pengecekan login, koneksi dan header
include("ceklogin.inc.php");
include ("conn.inc.php");
include ("header.inc.php");
?>

<table border="0" width="100%" cellpadding="3" cellspacing="0" align="center" bgcolor="yellow">
<tr>
	<td>
		<h2>Selamat Datang, 
		<? //tampilkan isi session snama
		echo $_SESSION['snama']?></h2>
		<?
		//panggil menu
		include "menu.inc.php";
		?>
	</td>
</tr>
<tr>
	<td>
		Selamat Datang, <?  echo $_SESSION['snama'] ?>. <br/>
		Silahkan gunakan menu di atas untuk mengatur sistem <br /><br />
		Jika sudah selesai, pastikan Anda klik Logout<br /><br />
	</td>
</tr>
</table>
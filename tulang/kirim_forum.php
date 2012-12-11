<?
if (trim($nama)=="" || trim($email)=="" || trim($judul)=="" || trim($komentar)=="")
{
	print"<script>alert('Proses isi forum gagal');window.history.go(-1);</script>";
}
else {

	 include "includes/konek.php";
	$waktu=date("d-m-Y ; H:i:s");
	 $nama=htmlspecialchars($nama);
     $email=htmlspecialchars($email);
	 $judul=htmlspecialchars($judul);
     $komentar=htmlspecialchars($komentar);
	$query="insert into forum_tanya values('','$nama','$email','$judul','$komentar','$waktu')";
	if (!$hasil=mysql_query($query)){
		echo mysql_error();
		exit;
	}
	print"<meta http-equiv='refresh' content='0;url=forum.php'>";

}
?>
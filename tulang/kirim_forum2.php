<?
if (trim($nama)=="" || trim($email)=="" || trim($komentar)=="")
{
	print"<script>alert('Proses isi tanggapan forum gagal');window.history.go(-1);</script>";
}
else {
	 include "includes/konek.php";
	$waktu=date("d-m-Y ; H:i:s");
	$nama=htmlspecialchars($nama);
    $email=htmlspecialchars($email);
	$komentar=htmlspecialchars($komentar);
	$query="insert into forum_jawab values('','$id_forum','$nama','$email','$komentar','$waktu')";
	if (!$hasil=mysql_query($query)){
		echo mysql_error();
		exit;
	}
	print"<meta http-equiv='refresh' content='0;url=detail_forum.php?id_forum=$id_forum'>";

}
?>
<?
if (trim($tamu)=="" || trim($email)=="" || trim($koment)=="")
{
	print"<script>alert('Proses isi bukutamu gagal');window.history.go(-1);</script>";
}
else {
		include ("includes/konek.php");
        $nama=htmlspecialchars($tamu);
        $email=htmlspecialchars($email);
        $komentar=htmlspecialchars($koment);
        $waktu=date("d-m-Y, H:i:s");
        $sql="insert into tamu (nama,email,waktu,koment) values ('$nama','$email','$waktu','$komentar')";
		if  (!mysql_query($sql)) {
               echo mysql_error();
               exit();
        }
	
        print("<meta http-equiv='refresh' content='0;url=lihat_tamu.php'>");
}
?>
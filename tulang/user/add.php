<?
if (trim($nama)=="" || trim($email)=="" || trim($usulan)=="")
{
	print"<script>alert('Proses usulan penyakit gagal');window.history.go(-1);</script>";
}
else {
		include ("../includes/konek.php");
        $nama=htmlspecialchars($nama);
        $email=htmlspecialchars($email);
        $usulan=htmlspecialchars($usulan);
        $waktu=date("d-m-Y, H:i:s");
        $sql="insert into usulan (nama,email,waktu,usulan) values ('$nama','$email','$waktu','$usulan')";
		if  (!mysql_query($sql)) {
               echo mysql_error();
               exit();
        }
	
        print("<meta http-equiv='refresh' content='0;url=usulan_penyakit.php'>");
}
?>
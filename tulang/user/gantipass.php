<?php
 include "Otentik.inc";
  session_start();
  if (! empty($pemakai))
    $sesi_user = $pemakai;

  if (! empty($sandi))
    $sesi_pass = $sandi;
  
  if (! otentikasi($sesi_user, $sesi_pass))
  {
  	$p = md5("pakar");
  	$msg = "Harap diisi dengan benar";
    $alamat = "../login.php";
    header("Location: $alamat?msg=$msg");
    exit();
  }
  session_register("sesi_user");
  session_register("sesi_pass");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../default.css" media="screen"/>
<title>.:: Tulang Sehat ::.</title>
<script language="JavaScript" type="text/JavaScript">
	function konfirmasi(id,awal){
	   var tamp = confirm("Yakin anda akan menghapus?");
       if (tamp == true)
	   {
	      return location.href ="pakar_gejala.php?id="+id+"&hapus=hapus&awal="+awal;
	   }
	}
	
</script>
</head>

<body>
<? 
include "kepala.php"; 
include "../includes/konek.php";
?>

<div align="center">
<?
if($Submit=="Ubah")
{
	if (!empty($pass))
	{
		if ($pass=$pass2){
			$passwd = md5($pass);
			mysql_query("UPDATE user SET password='$passwd' WHERE username='$sesi_user'");
			header("location:gantipass.php");
			exit();
		}else {
			$peringatan = "Masukan password dengan benar!";
		}
	}
}
?>
<table width="800" height="107" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF">
	<div align="center">
	
	  <table width="780" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="564" align="left" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="61" align="left" valign="top">
			 <!-- Mulai ISI -->
<form name="forml" method="post" action="" enctype="multipart/form-data">
<table width="90%">
	<tr><td align="right">Password baru : </td><td align="left"><input type="password" name="pass" size="15"></td></tr>
	<tr><td align="right">Ulangi : </td><td align="left"><input type="password" name="pass2" size="15"></td></tr>
	<tr><td align="center" colspan="2"><input type="submit" name="Submit" value="Ubah"></td></tr>
</table>
</form>
<br>
<?
echo $peringatan;
?>
<!-- Akhir ISI -->
</td>
            </tr>
          </table>                     </td>
          <td width="210" align="left" valign="top" bgcolor="#F7F7F2">
		  
		  
<? include"kanan.php"; ?>

	  </td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top">
		  
		  	<div class="footer">
	
		Rudi Budi Dewanto 03018078

	</div>
	
		  </td>
          </tr>
      </table>
	  </div>
	  

	  <br />
	  	</td>
  </tr>
</table>
</div>
</body>
</html>

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

$q_cek = mysql_query("SELECT kode, nama FROM user WHERE username='$sesi_user'");
$r_cek = mysql_fetch_row($q_cek);
$kode_user = $r_cek[0];
$nama_user = $r_cek[1];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../default.css" media="screen"/>
<title>.:: Tulang Sehat ::.</title>
</head>

<body>
<? 
include "kepala.php"; 
include "../includes/konek.php";
?>

<div align="center">
<table width="800" height="107" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF">
	<div align="center">
	
	  <table width="780" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="564" align="left" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="61" align="left" valign="top">
<?
echo"<p>Usulan Penyakit</p><br>
$pesan";
echo"
<form method=POST action=\"add.php\" name=\"fmForm\" onsubmit=\"return evKirim ()\">";
echo"<table border=0 bordercolor=#000000 cellspacing=0 cellpadding=3 style=\"font-family:geneva; font-size: 10pt\"  width=80% ALIGN=CENTER>";
echo"    
          <tr><td width=15% height=25 >Nama</td>
      <td width=85% colspan=3 height=25><input type=text name=nama size=30 value=\"$nama\"></td>
    </tr>";
echo"    <tr>
      <td width=15% height=25>Email</td>
      <td width=85% colspan=3 height=25><input type=text name=email size=30 value=\"$email\"></td>
    </tr>";
echo"    <tr>
      <td width=15% height=25 valign=top >Usulan/Keluhan</td>
      <td width=85% colspan=3 height=25 valign=top><textarea  name=usulan rows=10 cols=40 wrap>$usulan</textarea></td>
    </tr>";
echo"    <tr>
      <td colspan=4 height=21 ><div align=center><input type=submit value=Kirim  name=tombol>
          <input type=reset value=Reset name=tombol2></div></td>
    </tr>

	";

echo"</form>";
echo"</table><BR><br>";


?>
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

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
			 <div align="left">
	<?
$query=mysql_query("SELECT * FROM penyakit WHERE kode_penyakit='$id'");
$row=mysql_fetch_row($query);
$q_gejala=mysql_query("SELECT b.nama_gejala from gejalapenyakit a, gejala b
						WHERE b.kode_gejala=a.kd_gejala and a.kd_penyakit='$row[0]'");

$gejala="";
while($r_gejala=mysql_fetch_row($q_gejala)){
	if ($gejala=="") $gejala=$r_gejala[0];
	else $gejala .=", ".$r_gejala[0];
}
$q_penyebab=mysql_query("SELECT b.nama_penyebab from penyebabpenyakit a, penyebab b
						WHERE b.kode_penyebab=a.kd_penyebab and a.kd_penyakit='$row[0]'");

$penyebab="";
while($r_penyebab=mysql_fetch_row($q_penyebab)){
	if ($penyebab=="") $penyebab=$r_penyebab[0];
	else $penyebab .=", ".$r_penyebab[0];
}
$q_solusi=mysql_query("SELECT b.nama_solusi from solusipenyakit a, solusi b
						WHERE b.kode_solusi=a.kd_solusi and a.kd_penyakit='$row[0]'");
$solusi="";
while($r_solusi=mysql_fetch_row($q_solusi)){
	if ($solusi=="") $solusi=$r_solusi[0];
	else $solusi .=", ".$r_solusi[0];
}

?>
            <table width="96%" border="0" bordercolor="#EEEEEE" align="center" cellspacing="0" cellpading="0">
<tr>
<td width="21%" align="left" valign="top">Nama Penyakit</td>
	<td width="79%" align="left" valign="top"><h3> <? echo $row[1]; ?></h3></td></tr>
<tr><td valign="top">Definisi</td><td><? echo $row[2]; ?></td></tr>
<tr><td valign="top">Keterangan</td><td><? echo $row[3]; ?></td></tr>
<tr><td valign="top">Gejala</td><td><? echo $gejala; ?></td></tr>
<tr><td valign="top">Penyebab</td><td><? echo $penyebab; ?></td></tr>
<tr><td valign="top">Solusi</td><td><? echo $solusi; ?></td></tr>
</table>  
              
			  <p>&nbsp;</p>


</div>
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

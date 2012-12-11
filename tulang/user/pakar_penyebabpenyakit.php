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
	function konfirmasi(penyakit,penyebab){
	   var tamp = confirm("Yakin anda akan menghapus?");
       if (tamp == true)
	   {
	      return location.href ="pakar_penyebabpenyakit.php?penyakit="+penyakit+"&penyebab="+penyebab+"&hapus=hapus";
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
if($Submit=="Insert")
{
	if (!empty($penyebab))
	{
	mysql_query("INSERT INTO penyebabpenyakit (kd_penyakit, kd_penyebab) VALUES ('$penyakit','$penyebab')");
	header("location:pakar_penyebabpenyakit.php?penyakit=$penyakit");
	 exit();
	 }
}

if($hapus=="hapus")
{
   $delete="DELETE FROM penyebabpenyakit WHERE kd_penyakit='$penyakit' AND kd_penyebab='$penyebab'";
   mysql_query($delete);
   header("location:pakar_penyebabpenyakit.php?penyakit=$penyakit");
	 exit();
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

<?
	if ($penyakit=="")
	{
		echo "<table width='550'><tr><td colspan='4' class='headertabel'>DAFTAR PENYAKIT</td></tr>
				<tr bgcolor='#ABBECA'>
				<td align='center'>Kode</td>
				<td align='center'>Nama Penyakit</td>
				<td align='center'>Definisi</td>
				<td align='center' width='60'>Penyebab</td></tr>";
		$q_penyakit=mysql_query("SELECT * FROM penyakit ORDER BY kode_penyakit");
		while ($row = mysql_fetch_row ($q_penyakit))
		{
			$n = $n+1;
			if ( $n % 2 >= 1)
			echo "<tr bgcolor='#F7F7F2' onMouseOver=this.style.backgroundColor='#F6C07B' onmouseout=this.style.backgroundColor=''>";
			else
			echo "<tr bgcolor='#FFFFFF' onMouseOver=this.style.backgroundColor='#F6C07B' onmouseout=this.style.backgroundColor=''>";
			echo "<td align='center' valign='top'>$row[0]";
			echo "<td valign='top'>$row[1]";
			$str=explode(" ",$row[2]);
			$def="";
			for($i=0;$i<5;$i++) $def=$def." ".$str[$i];
			if (!$str[$i]=="")
			$def=$def."....";
			echo "<td valign='top'>$def";
			echo "<td align='center' valign='top'><a href=pakar_penyebabpenyakit.php?penyakit=$row[0]><img src='../images/isi.gif' alt='penyebab' border=0></a>"; 
		}
		echo "</table>";
		echo "<br><div align='center'><a href='pakar_penyebabpenyakit.php#top'>
				<img src='../images/up.gif' alt='top' border='0'><br>Top</a></div><br>";
	}
	else
	{
		$nama_penyakit=mysql_fetch_row(mysql_query("SELECT * FROM penyakit WHERE kode_penyakit='$penyakit'"));
		$q_penyebab=mysql_query("SELECT * FROM penyebab");
		echo "<form name='forml' method='post' action='' enctype='multipart/form-data'>";
		echo "<table width='99%'>";
		echo "<tr><td align='right' valign='top'>Kode Penyakit : </td><td><input name='kd_penyakit' size='4' maxlength='4' value='$penyakit' disabled> $nama_penyakit[1]</td></tr>";
		echo "<tr><td align='right' valign='top'>penyebab : </td><td><select name='penyebab' size='15'>";
		while ($r_penyebab=mysql_fetch_row($q_penyebab)){
		$string=explode(" ",$r_penyebab[1]);
		$penggalan="";
		for($i=0;$i<8;$i++) $penggalan=$penggalan." ".$string[$i];
		if (!$string[$i]=="")
		$penggalan=$penggalan."....";
		echo "<option value=$r_penyebab[0]>$r_penyebab[0]-$penggalan</option>";
		}
		echo "</select></td></tr>";
		echo "<tr><td></td><td> <input type='submit' name='Submit' value='Insert' class='tombol'> </td></tr>";
		echo "</table>";
		echo "</form>";
		echo "<table ALIGN='CENTER' width='90%'>
				<tr bgcolor='#ABBECA'>
				<td align='center'>Kode penyebab</td>
				<td align='center'>Nama penyebab</td>
				<td align='center'>Delete</td></tr>";
		$q_gpenyakit=mysql_query("	SELECT a.kd_penyakit, a.kd_penyebab, b.nama_penyebab
									FROM penyebabpenyakit a, penyebab b 
									WHERE b.kode_penyebab=a.kd_penyebab AND a.kd_penyakit='$penyakit'");
		while ($rowgp = mysql_fetch_row ($q_gpenyakit))
		{
			$n = $n+1;
			if ( $n % 2 >= 1)
			echo "<tr bgcolor='#F7F7F2' onMouseOver=this.style.backgroundColor='#F6C07B' onmouseout=this.style.backgroundColor=''>";
			else
			echo "<tr bgcolor='#FFFFFF' onMouseOver=this.style.backgroundColor='#F6C07B' onmouseout=this.style.backgroundColor=''>";
			echo "<td align='center' valign='top'>$rowgp[1]";
			echo "<td valign='top'>$rowgp[2]";
			echo "<td align='center' valign='top'>
					<a href='javascript:konfirmasi(\"$penyakit\",\"$rowgp[1]\")'>
					<img src='../images/delete.gif' alt='Hapus' border='0'></a></tr>"; 
		}
		echo "</table>";
		echo "<br><div align='center'><a href='pakar_penyebabpenyakit.php?penyakit=$penyakit#top'>
				<img src='../images/up.gif' alt='top' border='0'><br>Top</a></div><br>";
	}
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

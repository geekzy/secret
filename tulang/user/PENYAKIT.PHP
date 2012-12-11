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
			  
		

<table width="90%" border="0" bordercolor="#EEEEEE" align="center" cellspacing="2" cellpading="0">
  <tr><td colspan="6" align="right">
  <form name="frmCariPenyakit" action="cari.php" method="post" enctype="multipart/form-data">
  Cari : <select name="kategori" size="1" style="height:inherit;">
          <option value="nama">Nama Penyakit</option>
          <option value="gejala">Gejala Penyakit</option>
        </select>
		<input name="key" type="text" size="20">
		<input type="submit" name="Submit2" value="Cari" class="tombol" >
  </form>
  </td></tr>
  <tr><td colspan="6" class="headertabel">DAFTAR PENYAKIT</td></tr>
  <tr bgcolor="#ABBECA"> 
    <td align="center">Penyakit<td align="center">Definisi
        </tr>
  <? 
  	if(empty($awal))	$awal=0;
	
    $sql=mysql_query ("select * from penyakit order by nama_penyakit asc limit $awal,20");
    while ($row = mysql_fetch_row ($sql))
	{
		$n = $n+1;
		if ( $n % 2 >= 1)
		echo "<tr bgcolor='#F7F7F2' onMouseOver=this.style.backgroundColor='#F6C07B' onmouseout=this.style.backgroundColor=''>";
		else
		echo "<tr bgcolor='#FFFFFF' onMouseOver=this.style.backgroundColor='#F6C07B' onmouseout=this.style.backgroundColor=''>";
		echo "<td valign='top'><a href='detail.php?id=$row[0]'>$row[1]</a>";
		$string=explode(" ",$row[2]);
		$penggalan="";
		for($i=0;$i<5;$i++) $penggalan=$penggalan." ".$string[$i];
		if (!$string[$i]=="")
		$penggalan=$penggalan."....";
		echo "<td valign='top'>$penggalan";
		echo "</tr>"; 
	}
?>

</table>
<?
$query2=mysql_query("select * from penyakit");
$jumlah=mysql_num_rows($query2);
$i=$jumlah/20;
$i=ceil($i);
echo("<center>");
print("Halaman :");
for($j=1;$j<=$i;$j++)
{
$awal=(($j-1)*19+$j)-1;
print("<a href='penyakit.php?awal=$awal'><font color=red>[$j</a>]\n");
}
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

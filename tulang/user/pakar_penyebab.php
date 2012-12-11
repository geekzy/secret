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
	      return location.href ="pakar_penyebab.php?id="+id+"&hapus=hapus&awal="+awal;
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
if($Submit=="Tambah")
{
	if (!empty($nama))
	{
	
	mysql_query("INSERT INTO penyebab(kode_penyebab, nama_penyebab)
 				values ('$kode','$nama')");
	header("location:pakar_penyebab.php?awal=$awal");
	 exit();
	 }
}

elseif ($Submit=="Edit")
{
	$rubah="update penyebab set kode_penyebab='$id', nama_penyebab='$nama' where kode_penyebab='$id'";
	mysql_query($rubah);
	header("location:pakar_penyebab.php?awal=$awal");
	exit();
}

if($hapus=="hapus")
{
   	$delete="delete from penyebab where kode_penyebab='$id'";
   	mysql_query($delete);
   	header("location:pakar_penyebab.php?awal=$awal");
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
<form name="forml" method="post" action="" enctype="multipart/form-data">
<?
if(!$kirim == edit)
{
	$qry_id = mysql_query("SELECT kode_penyebab FROM penyebab order by kode_penyebab desc");
	$row_id = mysql_fetch_row ($qry_id);
	$id_akhir = explode("S",$row_id[0]);
	
	//--------MULAI BUAT KODE------------------------------>
	$kode1=(int)$id_akhir[1];
	$kode2=$kode1+1;
	if ($kode2 <= 9)
		$kode3="00".$kode2;
	elseif ($kode2 <= 99)
		$kode3="0".$kode2;
	elseif ($kode2 <= 999)
		$kode3=$kode2;
	$kode_peny="S".$kode3;
	//----------------SELESAI BUAT KODE----------------|||
	
	echo "<table align='center' width='550' class='content1'>";
	echo "<tr><td colspan=2 align='left' class='title'>INPUT DATA PENYEBAB</td></tr>";
	echo "<tr><td align='right' width='150'>Kode penyebab</td><td><input type='text' name='kode' maxlength='4' size='4' value='$kode_peny'></td></tr>";
	echo "<tr><td align='right' valign='top' width='150'>Nama penyebab</td><td><textarea name='nama' cols='50' rows='2' id='nama'></textarea></td></tr>";
    echo "<tr><td></td><td><input type='submit' name='Submit' value='Tambah' class='tombol'> "; 
    echo "<input type='Reset' name='Reset' value='Reset' class='tombol'></td></tr>";
	echo "</table>";
}
else
	{
 	$sql1=mysql_query (" select * from penyebab where kode_penyebab='$id'");
 	$row1 = mysql_fetch_row ($sql1);
	echo "<table align='center' width='550' class='content1'>";
	echo "<tr><td colspan=2 align='left' class='title'>EDIT DATA PENYEBAB</td></tr>";
	echo "<tr><td align='right' width='150'>Kode penyebab</td><td><input type='text' name='id' maxlength='4' size='4' value='$row1[0]'></td></tr>";
	echo "<tr><td align='right' valign='top' width='150'>Nama penyebab</td><TD><textarea name='nama' cols='50' rows='2'>$row1[1]</textarea></td></tr>";
	echo "<tr><td></td><td><input type='submit' name='Submit' value='$kirim' class='tombol'>";
	echo "</table>";
	}
?>

</form>


<table width="550" border="1" bordercolor="#EEEEEE" align="center" cellspacing="0" cellpading="0">
	<tr><td colspan="4" class="headertabel">DAFTAR PENYEBAB PENYAKIT</td></tr>
  <tr bgcolor="#ABBECA"> 
    <td align="center">Kode 
        <td align="center">Nama 
        penyebab
        <td colspan=2 align="center">Perintah 
        </tr>
  <? 
  	if(empty($awal))	$awal=0;

    $sql=mysql_query ("select * from penyebab order by kode_penyebab asc limit $awal,20");
    while ($row = mysql_fetch_row ($sql))
	{
		$n = $n+1;
		if ( $n % 2 >= 1)
		echo "<tr bgcolor='#F7F7F2' onMouseOver=this.style.backgroundColor='#F6C07B' onmouseout=this.style.backgroundColor=''>";
		else
		echo "<tr bgcolor='#FFFFFF' onMouseOver=this.style.backgroundColor='#F6C07B' onmouseout=this.style.backgroundColor=''>";
		echo "<td align='center' valign='top'>$row[0]";
		echo "<td valign='top'>$row[1]";
		echo "<td align='center' valign='top'><a href=pakar_penyebab.php?id=$row[0]&kirim=Edit&awal=$awal><img src='../images/edit.gif' alt='Edit' border='0'></a>"; 
		echo "<td align='center' valign='top'><a href='javascript:konfirmasi(\"$row[0]\",\"$awal\")'><img src='../images/delete.gif' alt='Hapus' border='0'></a></tr>"; 
	}
?>
</table>
<?
$query2=mysql_query("select * from penyebab");
$jumlah=mysql_num_rows($query2);
$i=$jumlah/20;
$i=ceil($i);
echo("<center>");
print("Halaman :");
for($j=1;$j<=$i;$j++)
{
$awal=(($j-1)*19+$j)-1;
print("<a href='pakar_penyebab.php?awal=$awal'><font color=red>[$j</a>]\n");
}

echo "<br><div align='center'><a href='pakar_penyebab.php?awal=$awal#top'>
		<img src='../images/up.gif' alt='top' border='0'><br>Top</a></div><br>";
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

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
	function konfirmasi(penyakit,gejala){
	   var tamp = confirm("Yakin anda akan menghapus?");
       if (tamp == true)
	   {
	      return location.href ="pakar_gejalapenyakit.php?penyakit="+penyakit+"&gejala="+gejala+"&hapus=hapus";
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
	if (!empty($gejala))
	{
	mysql_query("INSERT INTO gejalapenyakit (kd_penyakit, kd_gejala, prob, urut) VALUES ('$penyakit','$gejala',$prob,$urut)");
	echo "penyakit : $kd_penyakit gejala : $gejala";
	header("location:pakar_gejalapenyakit.php?penyakit=$penyakit");
	exit();
	}
}
if($Submit=="Ubah")
{
	mysql_query("	UPDATE 	gejalapenyakit SET kd_penyakit='$penyakit', kd_gejala='$kd_gejala', prob='$prob', urut='$urut'
					WHERE 	kd_penyakit='$penyakit' AND kd_gejala='$gejala_awal'");
	header("location:pakar_gejalapenyakit.php?penyakit=$penyakit");
	exit();
	
}
if($hapus=="hapus")
{
   $delete="DELETE FROM gejalapenyakit WHERE kd_penyakit='$penyakit' AND kd_gejala='$gejala'";
   mysql_query($delete);
   header("location:pakar_gejalapenyakit.php?penyakit=$penyakit");
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
		//:::::::::::::::::::::::::::::: jika penyakit blm ditentukan maka muncul daftar penyakit ::::::::::::::::::::::::::::::\\
		echo "<table width='550'>
				<tr><td colspan='4' class='headertabel'>DAFTAR PENYAKIT</td></tr>
				<tr bgcolor='#ABBECA'><td align='center'>Kode</td><td align='center'>Nama Penyakit</td><td align='center'>Definisi</td><td align='center' width='60'>Gejala</td></tr>";
		$q_penyakit=mysql_query("SELECT * FROM penyakit");
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
			echo "<td align='center' valign='top'><a href=pakar_gejalapenyakit.php?penyakit=$row[0]><img src='../images/isi.gif' alt='gejala' border=0></a>"; 
		}
		echo "</table>";
		echo "<br><div align='center'><a href='pakar_gejalapenyakit.php#top'>
				<img src='../images/up.gif' alt='top' border='0'><br>Top</a></div><br>";
	}
	else
	{
		//:::::::::::::::::::::::::::::: buat basis aturan ::::::::::::::::::::::::::::::::::::::::\\
		$nama_penyakit=mysql_fetch_row(mysql_query("SELECT * FROM penyakit WHERE kode_penyakit='$penyakit'"));
		$q_gejala=mysql_query("SELECT * FROM gejala");
		$jgp=mysql_fetch_row(mysql_query("select count(*) from gejalapenyakit where kd_penyakit='$penyakit'"));
		/*echo "<table width='550' border='0' cellpadding='0' cellspacing='0'>
				<tr>
				<td background='../images/kotak_r1_c2.gif' height='6' width='6'><img src='../images/kotak_r1_c1.gif'></td>
				<td background='../images/kotak_r1_c2.gif'></td>
				<td background='../images/kotak_r1_c2.gif' height='6' width='6' align='right'><img src='../images/kotak_r1_c4.gif'></td></tr>
				<tr>
				<td background='../images/kotak_r2_c1.gif'></td>
				<td bgcolor='#ffffff'>";*/
		$i=0;
		$aturan="";
		$tutup="";
		while ($i < $jgp[0])
		{
			$i++;
			$gjl_t="";
			$q_gp=mysql_query("select * from gejalapenyakit where kd_penyakit='$penyakit' and urut='$i' order by kd_gejala asc");
			while ($r_gp=mysql_fetch_row($q_gp))
			{
				if ($gjl_t=="") $gjl_t=" IF ".$r_gp[1];
				else $gjl_t = $gjl_t." AND ".$r_gp[1];
			}
			if (!$gjl_t=="")
			{
				$j = $i + 1;
				$q_gp2=mysql_query("select * from gejalapenyakit where kd_penyakit='$penyakit' and urut='$j' order by kd_gejala asc");
				$r_gp2=mysql_fetch_row($q_gp2);
				if ($r_gp2[1] == "") $gjl_t = $gjl_t." THEN ".$penyakit;
				else $gjl_t = $gjl_t." THEN ".$r_gp2[1];
				//echo "$gjl_t<br>";
			}
		}
		/*echo "</td><td background='../images/kotak_r2_c4.gif'></td></tr>
				<tr>
				<td background='../images/kotak_r4_c2.gif'><img src='../images/kotak_r4_c1.gif'></td>
				<td background='../images/kotak_r4_c2.gif'></td>
				<td background='../images/kotak_r4_c2.gif' align='right'><img src='../images/kotak_r4_c4.gif'></td></tr>
				<tr>
				</table>";*/
		if(!$kirim == edit){
		//:::::::::::::::::::::::::::::: form input gejala penyakit ::::::::::::::::::::::::::::::\\
			echo "<form name='forml' method='post' action='' enctype='multipart/form-data'>";
			echo "<table width='99%'>";
			echo "<tr><td align='right' valign='top'>Kode Penyakit : </td><td><input name='kd_penyakit' size='4' maxlength='4' value='$penyakit' disabled> $nama_penyakit[1]</td></tr>";
			echo "<tr><td align='right' valign='top'>Gejala : </td><td><select name='gejala' size='15'>";
			while ($r_gejala=mysql_fetch_row($q_gejala))
			{	
				$str=explode(" ",$r_gejala[1]);
				$gejala_temp="";
				for($i=0;$i<10;$i++) $gejala_temp=$gejala_temp." ".$str[$i];
				if (!$str[$i]=="")
				$gejala_temp=$gejala_temp."....";
				echo "<option value=$r_gejala[0]>$r_gejala[0] - $gejala_temp</option>";
			}
			echo "</select></td></tr>";
			echo "<tr><td align='right' valign='top'>Probabilitas : </td><td><input name='prob' size='4' maxlength='4' ></td></tr>";
			/*echo "<tr><td align='right' valign='top'>Urut : </td><td><input type='hidden' name='urut' size='2' maxlength='2' ></td></tr>";*/
			echo "<tr><td></td><td> <input type='submit' name='Submit' value='Insert' class='tombol'> </td></tr>";
			echo "</table>";
			echo "</form>";
		}else{
		//:::::::::::::::::::::::::::::: form edit gejala penyakit ::::::::::::::::::::::::::::::\\
			$qedit="SELECT * FROM gejalapenyakit WHERE kd_penyakit='$penyakit' AND kd_gejala='$gejala'";
			$redit=mysql_fetch_row(mysql_query($qedit));
			echo "<form name='forml' method='post' action='' enctype='multipart/form-data'>";
			echo "<table width='99%'>";
			echo "<tr><td align='right' valign='top'>Kode Penyakit : </td><td>
					<input name='kd_penyakit' size='4' maxlength='4' value='$penyakit' disabled> $nama_penyakit[1]
				  </td></tr>";
			echo "<tr><td align='right' valign='top'>Gejala : </td><td><select name='kd_gejala' size='15'>";
			while ($r_gejala=mysql_fetch_row($q_gejala))
			{
				$str=explode(" ",$r_gejala[1]);
				$gejala_temp="";
				for($i=0;$i<10;$i++) $gejala_temp=$gejala_temp." ".$str[$i];
				if (!$str[$i]=="")
				$gejala_temp=$gejala_temp."....";
				if ($r_gejala[0] == $gejala) 
				echo "<option value=$r_gejala[0] selected>$r_gejala[0] - $gejala_temp</option>";
				else echo "<option value=$r_gejala[0]>$r_gejala[0] - $gejala_temp</option>";
			}
			echo "</select><input type='hidden' name='gejala_awal' value='$gejala'></td></tr>";
			echo "<tr><td align='right' valign='top'>Probabilitas : </td><td><input name='prob' size='4' maxlength='4' value='$redit[2]'></td></tr>";
			echo "<tr><td align='right' valign='top'>Urut : </td><td><input name='urut' size='2' maxlength='2' value='$redit[3]'></td></tr>";
			echo "<tr><td></td><td> <input type='submit' name='Submit' value='Ubah' class='tombol'> </td></tr>";
			echo "</table>";
			echo "</form>";
		}
		//:::::::::::::::::::::::::::::: tabel gejala penyakit ::::::::::::::::::::::::::::::\\
		echo "<table ALIGN='CENTER' width='90%'>
				<tr bgcolor='#ABBECA'>
				<td align='center'>Kode Gejala</td>
				<td align='center'>Nama Gejala</td>
				<td align='center'>Probabilitas</td>
				<td align='center'>Urut</td>
				<td align='center' colspan='2'>Perintah</td></tr>";
		//:::::::::::::::::::::::::::::: tabel gejala penyakit ::::::::::::::::::::::::::::::\\
		$query="	SELECT	a.kd_penyakit, a.kd_gejala, a.prob, a.urut, b.kode_gejala, b.nama_gejala 
					FROM	gejalapenyakit a LEFT JOIN gejala b ON a.kd_gejala=b.kode_gejala
					WHERE  	a.kd_penyakit='$penyakit'
					ORDER BY a.kd_gejala";
		$q_gpenyakit=mysql_query($query);
		//echo $query;
		while ($rowgp = mysql_fetch_row ($q_gpenyakit))
		{
			$n = $n+1;
			if ( $n % 2 >= 1)
			echo "<tr bgcolor='#F7F7F2' onMouseOver=this.style.backgroundColor='#F6C07B' onmouseout=this.style.backgroundColor=''>";
			else 
			echo "<tr bgcolor='#FFFFFF' onMouseOver=this.style.backgroundColor='#F6C07B' onmouseout=this.style.backgroundColor=''>";
			echo "	<td align='center' valign='top'>$rowgp[1]</td>
					<td valign='top'>$rowgp[5]</td>
					<td align='center' valign='top'>$rowgp[2]</td>
					<td align='center' valign='top'>$rowgp[3]</td>
					<td align='center' valign='top'>
					<a href=pakar_gejalapenyakit.php?gejala=$rowgp[1]&kirim=Edit&penyakit=$penyakit><img src='../images/edit.gif' alt='Edit' border='0'></a></td>
					<td align='center' valign='top'>
					<a href='javascript:konfirmasi(\"$penyakit\",\"$rowgp[1]\")'>
					<img src='../images/delete.gif' alt='Hapus' border='0'></a></td></tr>"; 
		}
		echo "</table>";
		echo "<br><div align='center'><a href='pakar_gejalapenyakit.php?penyakit=$penyakit#top'>
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

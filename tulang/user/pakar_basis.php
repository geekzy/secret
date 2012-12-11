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
	      return location.href ="pakar_basis.php?penyakit="+penyakit+"&hapus=hapus";
	   }
	}
	//function untuk menampilkan pilihan and jika dipilih AND
	function tampil_and(evt){
	evt = (evt) ? evt : event;
    var target = (evt.target) ? evt.target : evt.srcElement;
    var block = document.getElementById("blokand");
    if (target.id == "pil1") {
        block.style.display = "block";
    } else {
        block.style.display = "none";  
    }

	}
	//function untuk menampilkan pilihan then jika dipilih then penyakit yang muncul blokpenyakit dan sebaliknya
	function tampil_gjl(evt){
	evt = (evt) ? evt : event;
    var target = (evt.target) ? evt.target : evt.srcElement;
    var block = document.getElementById("blokgjl");
	var blockpeny = document.getElementById("blokpeny");
    if (target.id == "pil1") {
        block.style.display = "block";
		blockpeny.style.display = "none";
    } else {
        block.style.display = "none";  
		blockpeny.style.display = "block";
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
	//untuk menyimpan data
	if (!empty($gejala))
	{
	if ($pilihan1==1) $gjl2=$gejala2;
	else $gjl2="-";
	if ($pilihan2==1) $gjl3=$gejala3;
	else $gjl3=$penyakit;
	mysql_query("INSERT INTO basis_aturan (id, penyakit, gejala1, gejala2, gejala3) 
				VALUES ('', '$penyakit', '$gejala', '$gjl2', '$gjl3')");
	header("location:pakar_basis.php?penyakit=$penyakit");
	exit();
	}
	//selesai simpan
}
if($hapus=="hapus")
{
	$q_akhir = mysql_query("select max(id) from basis_aturan where penyakit='$penyakit'");
	$r_akhir = mysql_fetch_row($q_akhir);
	$akhir = $r_akhir[0];
	echo "-$akhir";
   	$delete="DELETE FROM basis_aturan WHERE penyakit='$penyakit' AND id='$akhir'";
   	mysql_query($delete);
   	header("location:pakar_basis.php?penyakit=$penyakit");
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
			echo "<td align='center' valign='top'><a href=pakar_basis.php?penyakit=$row[0]><img src='../images/isi.gif' alt='gejala' border=0></a>"; 
		}
		echo "</table>";
		echo "<br><div align='center'><a href='pakar_basis.php#top'>
				<img src='../images/up.gif' alt='top' border='0'><br>Top</a></div><br>";
	}
	else
	{
		
		//:::::::::::::::::::::::::::::: form input basis aturan ::::::::::::::::::::::::::::::\\
		?>
		<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
		Kode Penyakit &nbsp; : &nbsp;
		<input type="text" name="kd_penyakit" size="4" maxlength="4" value="<? echo $penyakit; ?>" /><? echo $$nama_penyakit[1]; ?>
		<br><br><div class="basis">
		IF &nbsp; : &nbsp;
		<?
			echo "<select name='gejala'>";
			$q_gejala = mysql_query("	SELECT a.kd_gejala, b.nama_gejala 
										FROM gejalapenyakit a, gejala b 
										WHERE b.kode_gejala=a.kd_gejala AND a.kd_penyakit='$penyakit'");
			while ($r_gejala=mysql_fetch_row($q_gejala))
			{	
				$str=explode(" ",$r_gejala[1]);
				$gejala_temp="";
				for($i=0;$i<10;$i++) $gejala_temp=$gejala_temp." ".$str[$i];
				if (!$str[$i]=="")
				$gejala_temp=$gejala_temp."....";
				echo "<option value=$r_gejala[0]>$r_gejala[0] - $gejala_temp</option>";
			}
			echo "</select>";
		?>
		</div><br>
		<input name="pilihan1" id="pil1" type="radio" value="1" onClick="tampil_and(event)" />
		AND
		<input name="pilihan1" id="pil2" type="radio" value="2" onClick="tampil_and(event)" checked="checked" />
		THEN
		<div id="blokand" style="display:none" class="basis">
		AND &nbsp; : &nbsp;
		<?
			echo "<select name='gejala2'>";
			$q_gejala = mysql_query("	SELECT a.kd_gejala, b.nama_gejala 
										FROM gejalapenyakit a, gejala b 
										WHERE b.kode_gejala=a.kd_gejala AND a.kd_penyakit='$penyakit'");
			while ($r_gejala=mysql_fetch_row($q_gejala))
			{	
				$str=explode(" ",$r_gejala[1]);
				$gejala_temp="";
				for($i=0;$i<10;$i++) $gejala_temp=$gejala_temp." ".$str[$i];
				if (!$str[$i]=="")
				$gejala_temp=$gejala_temp."....";
				echo "<option value=$r_gejala[0]>$r_gejala[0] - $gejala_temp</option>";
			}
			echo "</select>";
		?>
		</div>
	  	<br><br>
		<input name="pilihan2" id="pil1" type="radio" value="1" onClick="tampil_gjl(event)" checked="checked" />
		THEN Gejala
		<input name="pilihan2" id="pil2" type="radio" value="2" onClick="tampil_gjl(event)" />
		THEN Penyakit 
		<br><br>
		<div id="blokgjl" class="basis">
		THEN &nbsp; : &nbsp;
		<?
			echo "<select name='gejala3'>";
			$q_gejala = mysql_query("	SELECT a.kd_gejala, b.nama_gejala 
										FROM gejalapenyakit a, gejala b 
										WHERE b.kode_gejala=a.kd_gejala AND a.kd_penyakit='$penyakit'");
			while ($r_gejala=mysql_fetch_row($q_gejala))
			{	
				$str=explode(" ",$r_gejala[1]);
				$gejala_temp="";
				for($i=0;$i<10;$i++) $gejala_temp=$gejala_temp." ".$str[$i];
				if (!$str[$i]=="")
				$gejala_temp=$gejala_temp."....";
				echo "<option value=$r_gejala[0]>$r_gejala[0] - $gejala_temp</option>";
			}
			echo "</select>";
		?>
		</div>
		<div id="blokpeny" style="display:none" class="basis">
		THEN &nbsp; : &nbsp;
		<input type="text" name="penyakit" value="<? echo $penyakit; ?>" disabled />
		</div>
		<br>
		<input type="submit" name="Submit" value="Insert" class="tombol" />
		</form>
		<!--tutup form-->
		<?
		echo "<a href='javascript:konfirmasi(\"$penyakit\")'>Hapus data</a><br><br>";
		//buat tampilan basis aturan
		echo "<table width='400' cellpadding='10' cellspacing='1' border='1' bordercolor='#999999'><tr bgcolor='#FFFFFF'><td>";
		$sql=mysql_query ("select * from basis_aturan order by id asc");
		while ($row = mysql_fetch_row ($sql))
		{
			echo "IF <font color='#cc3333'>$row[2]</font>";
			if ($row[3]=="-") echo " THEN <font color='#cc3333'>$row[4]</font> <br>";
			else echo " AND <font color='#cc3333'>$row[3]</font> THEN <font color='#cc3333'>$row[4]</font> <br>";
		}
		echo "</tr></table>";
		//selesai basis aturan----------->
		echo "<br><div align='center'><a href='pakar_basis.php?penyakit=$penyakit#top'>
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

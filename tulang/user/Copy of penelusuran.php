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
<html>
<head>
<title>diagnosa penyakit infeksi pada anak</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
	function cek1(){
	   if (document.frm1.gejala.value == "")
	   {
	   		alert ("Gejala belum dipilih!");
			document.frm1.gejala.focus();
	      	return false;
	   }
	   if (document.frm1.prob.value == "")
	   {
	   		alert ("Probabilitas belum diisi!");
			document.frm1.prob.focus();
	      	return false;
	   }
	}
	function cek2(){
	   if (document.frm2.gejala2.value == "")
	   {
	   		alert ("Gejala belum dipilih!");
			document.frm2.gejala2.focus();
	      	return false;
	   }
	   if (document.frm2.prob.value == "")
	   {
	   		alert ("Probabilitas belum diisi!");
			document.frm2.prob.focus();
	      	return false;
	   }
	}
	function cek3(){
	   if (document.frm3.gejala2.value == "")
	   {
	   		alert ("Gejala belum dipilih!");
			document.frm3.gejala2.focus();
	      	return false;
	   }
	   if (document.frm3.prob.value == "")
	   {
	   		alert ("Probabilitas belum diisi!");
			document.frm3.prob.focus();
	      	return false;
	   }
	}
	function kofirmasi(){
	var konf = confirm("Anda akan lanjut?");
	if (konf == false){
		return location.href ="index.php";
	}
	}
</script>

<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
<? include("../includes/konek.php"); ?>
<div align="center">
<table width="770" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td class="kotakluar" width="770"><?php include("top_pakar.html"); ?></td>
  </tr>
  <tr>
    <td class="kotakluar" width="770"><table width="770" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="170" valign="top" class="menukiri2">
		<? include ("menupakar.php"); ?>
        </td>
        <td width="100%" height="400" align="center" valign="top">
		<!------- MULAI PENELUSURAN------------->
		
			<? 
			//::::::::::::::::::::::::::::: JIKA BELUM ADA GEJALA YANG DIPILIH ::::::::::::::::::::::::::\\
			if ($gejala == ""){ 
			 ?>
			 <div class="perhatian">Pilihlah Gejala yang dialami :</div>
			<form name="frm1" action="" method="post" enctype="multipart/form-data" onSubmit="return cek1()">
			Gejala :<br>
			<select name="gejala" size="10">
				<?
					$q_gejala=mysql_query("SELECT * FROM gejala");
					while ($r_gejala=mysql_fetch_row($q_gejala)) 
					echo "<option value='$r_gejala[0]'>[$r_gejala[0]] $r_gejala[1]</option>";
				?>
			</select>
			<br>Masukkan Nilai Probabilitas Antara 0 Sampai 1 :<br>
			<input name="prob" type="text" size="4"><br>
			<input name="step" type="hidden" value="1">
			<br><input name="submit" type="submit" value="Pilih" class="tombol">
			</form>
			<? 
			//::::::::::::::::::::::::::::: JIKA GEJALA SUDAH DIPILIH ::::::::::::::::::::::::::\\
			}else{ 
				if ($step < 2){
					$q_peny=mysql_query("select distinct kd_penyakit from gejalapenyakit where kd_gejala='$gejala'");
					$drt_penyakit="";
					while ($r_peny=mysql_fetch_row($q_peny)) $drt_penyakit =$drt_penyakit."-".$r_peny[0];
					$ar_peny=explode("-",$drt_penyakit);
					$i=1;
					while (!$ar_peny[$i]==""){
						$ambilurut = mysql_fetch_row(mysql_query("select urut from gejalapenyakit where kd_penyakit='$ar_peny[$i]' and kd_gejala='$gejala'"));
						$q_cari    = mysql_query("select * from gejalapenyakit where kd_penyakit='$ar_peny[$i]' and urut >= '$ambilurut[0]'");
						while ($r_cari=mysql_fetch_row($q_cari)) $ar_gejala=$ar_gejala."-".$r_cari[1];
					$i++;}
					//::::::::::::::::: HILANGKAN GEJALA YANG DOBEL ::::::::::::::::::::::\\
					$gejala_tmp=explode("-",$ar_gejala);
					$n=1;
					$y=0;
					while(!$gejala_tmp[$n]==""){
						if ($gejala_tmp[$n] <> $gejala)	{
								$y++;
								if ($y < 2) $temp1 = "WHERE kode_gejala='".$gejala_tmp[$n]."'";
								else{
									$m=1;
									$j=0;
									$t=explode("-",$temp1);
									while(!$t[$m]==""){
										if($t[$m]==$gejala_tmp[$n]) $j++;
									$m++;}
									if(!$j > 0) $temp1 .=" OR kode_gejala='".$gejala_tmp[$n]."'";
						}}
					$n++;}
					$drt_prob=$prob;
					echo "<div class='perhatian'>Pilihlah Gejala yang dialami :</div>";
					echo "	<form name='frm2' action='' method='post'  enctype='multipart/form-data' onSubmit='return cek2()'>
							<input type='hidden' name='gejala' value='$gejala'><input type='hidden' name='step' value='2'>
							<input type='hidden' name='penyakit' value='$drt_penyakit'>
							<br>Gejala :<br><select name='gejala2' size='10'>";
					$q_isiselect=mysql_query("select kode_gejala, nama_gejala from gejala ".$temp1);
					while ($r_isiselect=mysql_fetch_row($q_isiselect)) 
					echo "	<option value='$r_isiselect[0]'>[$r_isiselect[0]] $r_isiselect[1]</option>";
					echo "	</select><br>Masukkan Nilai Probabilitas Antara 0 Sampai 1 :<br><input type='text' name='prob' size='4'><br>
							<input type='hidden' name='d_prob' value='$drt_prob'><br>
							<input name='submit' type='Submit' value='Lanjut' class='tombol'>
							</form>";
					include ("peny_drt.php");
					echo "<form name='frm4' action='laporan.php' method='post' enctype='multipart/form-data'>
							<input type='hidden' name='gejala' value='$gejala'>
							<input type='hidden' name='penyakit' value='$drt_penyakit'>
							<input type='hidden' name='drt_prob' value='$drt_prob'>";
					echo "<input name='submit' type='Submit' value='Laporan Penelusuran' class='tombol2'></form>";
				}else{
					$drt_penyakit="";
					$w_peny=explode("-",$penyakit);
					$x=1;
					while(!$w_peny[$x]==""){
						if ($x < 2) $wherenya=" kd_penyakit = '".$w_peny[$x]."'";
						else $wherenya .=" or kd_penyakit = '".$w_peny[$x]."'";
					$x++;}
					$gejala=$gejala."-".$gejala2;
					$q_peny=mysql_query("select distinct kd_penyakit 
										from gejalapenyakit 
										where kd_gejala='$gejala2' and (".$wherenya.")");
					while ($r_peny=mysql_fetch_row($q_peny)) $drt_penyakit =$drt_penyakit."-".$r_peny[0];
					$ar_peny=explode("-",$drt_penyakit);
					$i=1;
					
					while (!$ar_peny[$i]==""){
						$ambilurut=mysql_fetch_row(mysql_query("
						select urut from gejalapenyakit where kd_penyakit='$ar_peny[$i]' and kd_gejala='$gejala2'"));
						$q_cari=mysql_query("select * from gejalapenyakit where kd_penyakit='$ar_peny[$i]' and urut > '$ambilurut[0]'");
						$ambiljumlah=mysql_fetch_row(mysql_query("
						select count(*) from gejalapenyakit where kd_penyakit='$ar_peny[$i]' and urut > '$ambilurut[0]'"));
						while ($r_cari=mysql_fetch_row($q_cari)) {
							$ar_gejala=$ar_gejala."-".$r_cari[1];
						}
					$i++;}
					
					//::::::::::::::::: HILANGKAN GEJALA YANG DOBEL ::::::::::::::::::::::\\
					$gejala_tmp=explode("-",$ar_gejala);
					$n=1;
					$y=0;
					while(!$gejala_tmp[$n]==""){
						if ($gejala_tmp[$n] <> $gejala)	{
								$y++;
								if ($y < 2) $temp1 = "WHERE kode_gejala='".$gejala_tmp[$n]."'";
								else{
									$m=1;
									$j=0;
									$t=explode("-",$temp1);
									while(!$t[$m]==""){
										if($t[$m]==$gejala_tmp[$n]) $j++;
									$m++;}
									if(!$j > 0) $temp1 .=" OR kode_gejala='".$gejala_tmp[$n]."'";
						}}
					$n++;}
					//::::::::::::::::::::::: JIKA JUMLAH REC GEJALA > 0 ::::::::::::::::::::::::::::\\
					if ($ambiljumlah[0] > 0){
						$drt_prob =$d_prob."-".$prob;
						echo "<div class='perhatian'>Pilihlah Gejala yang dialami :</div>";
						echo "	<form name='frm3' action='' method='post'  enctype='multipart/form-data' onSubmit='return cek3()'>
								<input type='hidden' name='gejala' value='$gejala'><input type='hidden' name='step' value='3'>
								<input type='hidden' name='penyakit' value='$drt_penyakit'>
								<br>Gejala :<br><select name='gejala2' size='10'>";
						$q_isiselect=mysql_query("select kode_gejala, nama_gejala from gejala ".$temp1);
						while ($r_isiselect=mysql_fetch_row($q_isiselect)) 
						echo "<option value='$r_isiselect[0]'>[$r_isiselect[0]] $r_isiselect[1]</option>";
						echo "	</select><br>Masukkan Nilai Probabilitas Antara 0 Sampai 1 :<br><input type='text' name='prob' size='4'><br>
								<input type='hidden' name='d_prob' value='$drt_prob'>
								<input name='submit' type='Submit' value='Lanjut' class='tombol'></form>";
						include ("peny_drt.php");
						echo "<form name='frm4' action='laporan.php' method='post'  enctype='multipart/form-data'>
								<input type='hidden' name='gejala' value='$gejala'>
								<input type='hidden' name='penyakit' value='$drt_penyakit'>
								<input type='hidden' name='drt_prob' value='$drt_prob'>";
						echo "<input name='submit' type='Submit' value='Laporan Penelusuran' class='tombol2'></form>";
						//include ("penelusuran_hsl.php");
					}
					//::::::::::::::::::::::: JIKA JUMLAH REC GEJALA = 0 ::::::::::::::::::::::::::::\\
					else
					{
						$drt_prob =$d_prob."-".$prob;
						include ("peny_drt.php");
						echo "<br> HASIL PERHITUNGAN <br><br>";
						include ("penelusuran_hsl.php");
						echo "<form name='frm4' action='laporan.php' method='post'  enctype='multipart/form-data'>
								<input type='hidden' name='gejala' value='$gejala'>
								<input type='hidden' name='penyakit' value='$drt_penyakit'>
								<input type='hidden' name='drt_prob' value='$drt_prob'>";
						echo "<input name='submit' type='Submit' value='Laporan Penelusuran' class='tombol2'></form>";
					}
					
				}
			} ?>
		<!------- SELESAI PENELUSURAN------------->
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="kotakluar"><? include("../footer.html"); ?></td>
  </tr>
</table>
</div>
</body>
</html>

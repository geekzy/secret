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

				  <P align="center"><h3>LAPORAN HASIL DIAGNOSA</h3></P>
				  <?
				  $jp = explode("-",$dr_penyakit2);
				  $j  = 1;
				  while(!$jp[$j]=="") $j++;
				  $jumlah=$j-1;
				  $q_user = mysql_query("SELECT nama, alamat FROM user WHERE username='$sesi_user'");
				  $d_user = mysql_fetch_row($q_user);
				  echo "<table width='550' align='center'>
				  		<tr><td width='100'>Nama</td><td>: $d_user[0]</td></tr>
						<tr><td width='100'>Alamat</td><td>: $d_user[1]</td></tr>
						</table><br>";
				  echo "<div class='isi'>Hasil diagnosa dari gejala yang anda pilih terdapat <font color='red'>$jumlah</font> penyakit yang terdeteksi :<br><br>";
				  $p = explode("-",$dr_penyakit2);
				  $n=1;
				  while(!$p[$n]==""){
					  $q_penyakit = mysql_query("SELECT * FROM penyakit WHERE kode_penyakit='$p[$n]'");
					  $d_penyakit = mysql_fetch_row($q_penyakit);
					  echo "Penyakit $n :<br><font color='#3366CC'>$d_penyakit[1]</font><br><br>
							Definisi :<br>$d_penyakit[2]<br><br>
							Keterangan :<br>$d_penyakit[3]<br><br>";
					  $q_penyebab = mysql_query("	SELECT a.kd_penyebab, b.nama_penyebab 
													FROM penyebabpenyakit a, penyebab b
													WHERE b.kode_penyebab=a.kd_penyebab
													AND a.kd_penyakit='$p[$n]'");
					  $penyebab="";
					  while($d_penyebab = mysql_fetch_row($q_penyebab)){
							if ($penyebab=="") $penyebab = $d_penyebab[1];
							else $penyebab .=", ".$d_penyebab[1];
					  }
					  echo "Penyebab :<br>$penyebab<br><br>";
					  $q_solusi = mysql_query("		SELECT a.kd_solusi, b.nama_solusi 
													FROM solusipenyakit a, solusi b
													WHERE b.kode_solusi=a.kd_solusi
													AND a.kd_penyakit='$p[$n]'");
					  $solusi="";
					  while($d_solusi = mysql_fetch_row($q_solusi)){
							if ($solusi=="") $solusi = $d_solusi[1];
							else $solusi .=", ".$d_solusi[1];
					  }
					  echo "solusi :<br>$solusi<hr>";
				  $n++;
				  }
				  include "penelusuran_hsl.php";
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

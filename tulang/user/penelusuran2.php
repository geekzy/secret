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

		<?php
		$drt_prob = $prob."-".$d_prob;
		$drt_gejala=$gejala."-".$d_gejala;
		if ($d_penyakit==""){
			$q_peny=mysql_query("select distinct kd_penyakit from gejalapenyakit where kd_gejala='$gejala'");
			$drt_penyakit="";
			while ($r_peny=mysql_fetch_row($q_peny)) $drt_penyakit =$drt_penyakit."-".$r_peny[0];
		}else{
			$drt_penyakit="";
			$w_peny=explode("-",$d_penyakit);
			$x=1;
			while(!$w_peny[$x]==""){
				$q_jml = mysql_query("select count(kd_penyakit) from gejalapenyakit 
									where kd_penyakit='$w_peny[$x]' and kd_gejala='$gejala'");
				$r_jml=mysql_fetch_row($q_jml);
				if($r_jml[0] > 0) $drt_penyakit .= "-".$w_peny[$x];
			$x++;}
			
		}		
		?>
			<p></p>
			<div align="center">Anda Ingin lanjut? :</div><p>&nbsp;</p><p></p>
			<table width="95%" border="0"><tr>
			<td align="right">
			<form name="frm1" action="penelusuran.php" method="post" enctype="multipart/form-data">
			<?
			echo "	<input type='hidden' name='dr_gejala' value='$drt_gejala'>
					<input type='hidden' name='dr_penyakit' value='$drt_penyakit'>
					<input type='hidden' name='dr_prob' value='$drt_prob'>";
			?>
			<input name="submit" type="submit" value="Lanjut" class="tombol">
			</form>
			</td>
			<td align="left">
			<form name="frm2" action="laporan.php" method="post" enctype="multipart/form-data">
			<?
			echo "	<input type='hidden' name='dr_gejala2' value='$drt_gejala'>
					<input type='hidden' name='dr_penyakit2' value='$drt_penyakit'>
					<input type='hidden' name='dr_prob2' value='$drt_prob'>";
			?>
			<input name="submit" type="submit" value="Tidak" class="tombol">
			</form>
			</td></tr></table>

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

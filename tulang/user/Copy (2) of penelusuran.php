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
		
			<div class="perhatian">Pilihlah Gejala yang dialami :</div>
			<form name="frm1" action="penelusuran2.php" method="post" enctype="multipart/form-data" onSubmit="return cek1()">
			Gejala :<br>
			<?
			if ($dr_penyakit==""){
				$q_gejala=mysql_query("SELECT * FROM gejala");
			}else{
				$wherenya = "";
				$pyk = explode("-",$dr_penyakit);
				$n=1;
				while (!$pyk[$n] == ""){
					if($wherenya == "") {
						$wherenya = " kd_penyakit = '".$pyk[$n]."'";
					}else{
						$wherenya .= " or kd_penyakit = '".$pyk[$n]."'";
					}
					$n++;
				}
				$andnya = "";
				$gjl = explode("-",$dr_gejala);
				$m=0;
				while (!$gjl[$m] == ""){
					$andnya .= " AND kd_gejala <> '".$gjl[$m]."'";
					$m++;
				}
				$qry = "SELECT distinct a.kd_gejala, b.nama_gejala 
						FROM gejalapenyakit a left join gejala b on a.kd_gejala=b.kode_gejala
						WHERE (".$wherenya.") ".$andnya;
				$q_gejala=mysql_query($qry);
			}
			?>
			<select name="gejala" size="10">
				<?
					while ($r_gejala=mysql_fetch_row($q_gejala)) 
					echo "<option value='$r_gejala[0]'>[$r_gejala[0]] $r_gejala[1]</option>";
				?>
			</select>
			<br>Masukkan Nilai Probabilitas Antara 0 Sampai 1 :<br>
			<input name="prob" type="text" size="4"><br>
			<?
				echo "	<input name='d_gejala' type='hidden' value='$dr_gejala'>
						<input name='d_penyakit' type='hidden' value='$dr_penyakit'>
						<input name='d_prob' type='hidden' value='$dr_prob'>";
			?>
			<br><input name="submit" type="submit" value="Pilih" class="tombol">
			</form>
			
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

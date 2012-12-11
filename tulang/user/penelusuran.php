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
          <td width="100%" align="left" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="61" align="left" valign="top">

		
			<div align="center">Pilihlah Gejala yang dialami : <?php echo"$dr_penyakit  | $dr_gejala"; ?>
			<form name="frm1" action="penelusuran2.php" method="post" enctype="multipart/form-data" onSubmit="return cek1()">
		
			<?php
			if ($dr_penyakit==""){
				$q_gejala=mysql_query("SELECT * FROM gejala");
			}else{
				$wherenya = "";
				$pyk = explode("-",$dr_penyakit);
				$n=1;
				while (!$pyk[$n] == ""){
					if($wherenya == "") {
						$wherenya = " penyakit = '".$pyk[$n]."'";
					}else{
						$wherenya .= " or penyakit = '".$pyk[$n]."'";
					}
					$n++;
				}
				$andnya = "";
				$gjl = explode("-",$dr_gejala);
				$m=0;
				while (!$gjl[$m] == ""){
					$andnya .= " AND gejala1 <> '".$gjl[$m]."'";
					$m++;
				}
				$qry = "SELECT distinct a.gejala1, b.nama_gejala 
						FROM basis_aturan a left join gejala b on a.gejala1=b.kode_gejala
						WHERE (".$wherenya.") ".$andnya;
				$q_gejala=mysql_query($qry);
			}
			?>
			<select name="gejala" size="5">
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

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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0"><div align="center">
<?
include ("../includes/konek.php");
?>
<table width="770" border="0" cellpadding="0" cellspacing="0">
   <tr>
   	<td width="770" class="kotakluar">
	<? include("top_pakar.html"); ?>
	</td>
   </tr>
   <tr>
   <td width="770" class="kotakluar"> 
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top" align="left" class="menukiri2">
				  
					  <?
					  	include("menupakar.php");
						
					  ?>
			
				  </td>
                  <td width="100%" height="400" valign="top" class="content">
				  <?
					$q_cek = mysql_query("SELECT kode, nama FROM user WHERE username='$sesi_user'");
					$r_cek = mysql_fetch_row($q_cek);
					$kode_user = $r_cek[0];
					$nama_user = $r_cek[1];
					
					if($kode_user=="pakar"){
						include ("aboutpakar.php");
					}else{
						include ("aboutuser.php");
					}
				  ?>
				  </td>
                </tr>
      		   </table>
   </td>
   </tr>
   <tr>
	    <td><? include "../footer.html"; ?></td></tr>
</table>
</div>
</body>
</html>

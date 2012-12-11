<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="default.css" media="screen"/>
<title>Untitled Document</title>
</head>

<body>
<? include "kepala.php"; ?>

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
			  <div align="center">
		<p>REGISTRASI USER</p>
              <?
			  	include "includes/konek.php";
				$cek=mysql_query("select count(username) from user where username='$usernm'");
				$bcek=mysql_fetch_row($cek);
				
				if ($bcek[0] < 1)
				{
				 	$sandi=md5($passwd);
				 	mysql_query("INSERT INTO user (username, password, kode, nama, alamat) 
								VALUES ('$usernm','$sandi','user','$nama','$alamat')");
					echo "Selamat anda telah menjadi user kami<br> anda dapat menggunakan hak akses anda untuk melakukan login dengan data sebagai berikut:";
					echo "<table width='90%' border='0'>
							<tr><td align='right'>Username : </td><td>$usernm</td></tr>
							<tr><td align='right'>Password : </td><td>$passwd</td></tr>
							<tr><td align='right'>Nama lengkap : </td><td>$nama</td></tr>
							<tr><td align='right'>Alamat : </td><td>$alamat</td></tr>
							
						  </table>";
					echo "<a href='login.php'>LOGIN</a>";
				}
				else
				{
					echo "Maaf username sudah ada, silahkan coba dengan username berbeda";
					
				}
			  ?>
              <p>&nbsp;</p>

</div>
				
				    </td>
            </tr>
          </table>            <h1>&nbsp;</h1>            </td>
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


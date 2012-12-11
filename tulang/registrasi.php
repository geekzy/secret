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
	<div align="left">
	
	  <table width="780" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="564" align="left" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="61" align="left" valign="top">
			<div align="left">
			    <p align="center"><b>REGISTRASI USER</b></p>
              <form action="inputuser.php" method="post" enctype="multipart/form-data" name="form2">
                <table width="75%" border="0" align="center">
                  <tr> 
                    <td width="31%">Username</td>
                    <td width="69%"><input name="usernm" type="text" id="usernm" size="20" maxlength="10"></td>
                  </tr>
                  <tr> 
                    <td>Password</td>
                    <td><input name="passwd" type="password" id="passwd" size="20" maxlength="10"></td>
                  </tr>
                  <tr> 
                    <td>Nama lengkap</td>
                    <td><input name="nama" type="text" id="nama" size="25" maxlength="25"></td>
                  </tr>
                  <tr> 
                    <td>Alamat</td>
                    <td><textarea name="alamat" cols="30" rows="2" id="alamat"></textarea></td>
                  </tr>
                  <tr> 
                    <td>&nbsp;</td>
                    <td><input type="submit" name="Submit2" value="Kirim"> <input type="reset" name="Submit3" value="Batal">
                    </td>
                  </tr>
                </table>
              </form>
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

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
	
LOGIN USER
		<FORM ACTION="user/index.php" METHOD="POST">
            <div align="center"> 
              
          <TABLE>
            <TR> 
              <TD><font size="3" face="Times New Roman, Times, serif"><strong>Pemakai</strong></font></TD>
              <TD> <font color="92001D"> 
                <INPUT TYPE="TEXT" NAME="pemakai">
                </font></TD>
            </TR>
            <TR> 
              <TD><strong>Password</strong></TD>
              <TD> <font color="92001D"> 
                <INPUT TYPE="PASSWORD" NAME="sandi">
                </font></TD>
            </TR>
            <TR>
              <TD>&nbsp;</TD>
              <TD> <INPUT TYPE="SUBMIT" VALUE="Login" class="tombol">
              <INPUT TYPE="RESET"  VALUE="Reset" class="tombol">
             <a href="registrasi.php">daftar</a></TD>
            </TR>
          </TABLE>
             
			</div>
          </FORM>
	<?
echo ("<div align=center>");
print("$msg<BR>\n");
?>

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


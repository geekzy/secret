<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="default.css" media="screen"/>
<title>Untitled Document</title>
<SCRIPT LANGUAGE = "JavaScript">
<!--

function IsEmailBenar (str)
{
  var cek1 = str.indexOf ("@");

  // Cek karakter titik
  if (cek1 == -1)
    return 1;

  // Memastikan sah tidaknya letak karakter "@"
  if  ((cek1 == 0) || (cek1 == str.length - 1) ||
       (cek1 != str.lastIndexOf ("@")))
    return 2;

  var cek2 = str.lastIndexOf (".");

  // Cek karakter titik
  if (cek2 == -1)
    return 3;

  if ((cek2 == 0) || (cek2 == str.length - 1))
    return 4;

  // Cek letak karakater @ dan titik
  if ((cek1 > cek2) || (cek1 == cek2 - 1) ||
      (cek1 == cek2 + 1))
    return 5;

  // Cek ada tidaknya spasi
  if (str.indexOf (" ") != -1)
    return 6;
  return 0;
}

function evKirim ()
{
  // Cek kotak teks sudah diisi atau belum
  if (document.fmForm.tamu.value == "")
  {
    alert ("Nama harus diisi");
    document.fmForm.tamu.focus ();
    return false;
  }
  if (document.fmForm.email.value == "")
  {
    alert ("Email harus diisi");
    document.fmForm.email.focus ();
    return false;
  }
   // Cek alamat email yang dimasukkan benar atau tidak  
  var Cek = IsEmailBenar (document.fmForm.email.value);
  if (Cek != 0)
  {
    if (Cek == 1)
      alert ("Alamat email tidak valid");
    else if (Cek == 2)
      alert ("Alamat email tidak valid");
    else if (Cek == 3)
      alert ("Alamat email tidak valid");
    else if (Cek == 4)
      alert ("Alamat email tidak valid");
    else if (Cek == 5)
      alert ("Alamat email tidak valid");
    else if (Cek == 6)
      alert ("Alamat email tidak valid");
    document.fmForm.email.focus ();
    return false;
  }
  if (document.fmForm.koment.value == "")
  {
    alert ("Komentar harus diisi");
    document.fmForm.koment.focus ();
    return false;
  }
  return true;
}

//-->
</SCRIPT>
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
			  <div align="left">
	
	<?
echo"<p>Buku Tamu</p><br>
$pesan";
echo"
<form method=POST action=\"add.php\" name=\"fmForm\" onsubmit=\"return evKirim ()\">";
echo"<table border=0 bordercolor=#000000 cellspacing=0 cellpadding=3 style=\"font-family:geneva; font-size: 10pt\"  width=80% ALIGN=CENTER>";
echo"    
          <tr><td width=15% height=25 >Nama</td>
      <td width=85% colspan=3 height=25><input type=text name=tamu size=30 value=\"$nama\"></td>
    </tr>";
echo"    <tr>
      <td width=15% height=25>Email</td>
      <td width=85% colspan=3 height=25><input type=text name=email size=30 value=\"$email\"></td>
    </tr>";
echo"    <tr>
      <td width=15% height=25 valign=top >Komentar</td>
      <td width=85% colspan=3 height=25 valign=top><textarea  name=koment rows=10 cols=40 wrap>$komentar</textarea></td>
    </tr>";
echo"    <tr>
      <td colspan=4 height=21 ><div align=center><input type=submit value=Kirim  name=tombol>
          <input type=reset value=Reset name=tombol2></div></td>
    </tr>

	";

echo"</form>";
echo"</table><BR><br>";
echo"<div align=center><a href=lihat_tamu.php>Lihat Daftar Tamu</a></div>";


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


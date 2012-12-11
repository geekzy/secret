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
  if (document.fmForm.nama.value == "")
  {
    alert ("Nama harus diisi");
    document.fmForm.nama.focus ();
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
  if (document.fmForm.komentar.value == "")
  {
    alert ("Komentar harus diisi");
    document.fmForm.komentar.focus ();
    return false;
  }
  return true;
}

//-->
</SCRIPT>
</head>

<body>
<? include "kepala.php"; 
 include "includes/konek.php";
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
			


<p class="boldtextblue">&nbsp;Forum Diskusi</p><br>

<p>&nbsp;<A HREF="forum.php">Kembali ke awal</A></p>
<?
$query="select * from forum_tanya where id_forum='$id_forum'";
if (!$hasil=mysql_query($query)){
	echo mysql_error();
	exit;
}
$baris=mysql_fetch_array($hasil);
$baris[komentar] = str_replace("\r\n","<br>",$baris[komentar]); 
print"<TABLE cellpadding=2 border=0 cellspacing=0 width=90% style=\"font-family:Arial;font-size:10pt\" align=center>
<TR valign=top>
	<TD width=10% ><strong>Judul</strong></TD>
	<TD width=40%><strong>$baris[judul]</strong></TD>
	<TD width=10%><strong>Nama</strong></TD>
	<TD>$baris[nama]</TD>
</TR>
<TR valign=top>
	<TD width=10% ><strong>Komentar</strong></TD>
	<TD width=40% class=paragraf>$baris[komentar]</TD>
	<TD width=10% ><strong>Email</strong></TD>
	<TD>$baris[email]</TD>
</TR>
<TR valign=top>
	
	<TD width=10% ><strong>Waktu Kirim</strong></TD>
	<TD>$baris[waktu]</TD>
	<TD colspan=2>&nbsp;</td>
</TR>
</TABLE><P><HR width=90% align=center><P>";
	$sql="select * from forum_jawab where id_forum='$id_forum'";
	if (!$result=mysql_query($sql)){
		echo mysql_error();
		exit;
	}
	$jml=mysql_num_rows($result);
if ($jml==0){
	print"<CENTER>Tidak Ada Tanggapan</CENTER>";
}
else{
	print"<CENTER><B>Daftar Tanggapan</B></CENTER>";
$no=0;
print"<table width=90% border=1 cellspacing=0 align=center>";
while ($row=mysql_fetch_array($result)){
	$row[komentar] = str_replace("\r\n","<br>",$row[komentar]); 

	$no++;
	print"<tr valign=top><td width=3%>$no.</td><td class=paragraf><FONT SIZE=\"2\" face=\"arial\"> $row[komentar] </td></tr><tr><td colspan=2 align=right>oleh $row[nama]<BR> $row[waktu]</FONT></td></tr>";
}
print"</table>";
}
print"<P><HR width=90% align=center>";
?>

<FORM name="fmForm" onSubmit="return evKirim ()" METHOD=POST ACTION="kirim_forum2.php">
<INPUT TYPE="hidden" name=id_forum value="<? print $id_forum ?>">
<TABLE style="font-family:Arial;font-size:10pt" align=center>
<TR>
	<TD>Nama</TD>
	<TD><INPUT TYPE="text" NAME="nama"></TD>
</TR>
<TR>
	<TD>Email</TD>
	<TD><INPUT TYPE="text" NAME="email"></TD>
</TR>

<TR valign=top>
	<TD>Komentar</TD>
	<TD><TEXTAREA NAME="komentar" ROWS="7" COLS="45" wrap></TEXTAREA></TD>
</TR>
<TR>
	<TD colspan=2><INPUT TYPE="submit" value="Kirim"><INPUT TYPE="reset" value="Batal"></TD>

</TR>
</TABLE>
</FORM>



				
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


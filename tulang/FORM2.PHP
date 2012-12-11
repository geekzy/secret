<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Forum </TITLE>
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
  if (document.fmForm.judul.value == "")
  {
    alert ("Judul harus diisi");
    document.fmForm.judul.focus ();
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
</HEAD>

<BODY onLoad="document.fmForm.nama.focus ();">
<div align="center"><FONT face=arial SIZE="2" COLOR="#660066"><B>Tulis Pertanyaan //</B></FONT>
</div>
<FORM name="fmForm" onSubmit="return evKirim ()" METHOD=POST ACTION="kirim_forum.php">
<TABLE align="center">
<TR>
	<TD>Nama</TD>
	<TD><INPUT TYPE="text" NAME="nama"></TD>
</TR>
<TR>
	<TD>Email</TD>
	<TD><INPUT TYPE="text" NAME="email"></TD>
</TR>
<TR>
	<TD>Judul</TD>
	<TD><INPUT TYPE="text" NAME="judul"></TD>
</TR>
<TR valign=top>
	<TD>Komentar</TD>
	<TD><TEXTAREA NAME="komentar" ROWS="9" COLS="45" wrap></TEXTAREA></TD>
</TR>
<TR>
	<TD colspan=2><div align="center">
	  <INPUT TYPE="submit" value="Kirim">
	  <INPUT TYPE="reset" value="Batal">
	  </div></TD>

</TR>
</TABLE>
</FORM>
</BODY>
</HTML>

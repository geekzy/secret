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
			  <div align="center">
	
	<?
include ("includes/konek.php");
echo"<p><B>Buku tamu</B></p><center>";
$item_tampil=7;
if (empty($index)){
	$index=0;
}
$tablename="tamu";
$stmt = "Select * from $tablename  order by no_id DESC limit $index,$item_tampil";
$stmt2 = "Select * from $tablename";

if (!($result=mysql_query($stmt))) {
	echo mysql_error();
	exit();
}
if (!($result2=mysql_query($stmt2))) {
	echo mysql_error();
	exit();
}
$row=mysql_num_rows($result);
$rows=mysql_num_rows($result2);
$nomor=$rows-$index;
$bagi=$rows % $item_tampil;
if ($bagi!=0){
$nomor2=floor($index/$item_tampil );
$nomor1=floor($nomor/$item_tampil );
}
else{
$nomor2=floor($index/$item_tampil);
$nomor1=floor($nomor/$item_tampil);
}
if($row==0){
        echo "Data kosong !<br>";
}
else{
	while (($baris = mysql_fetch_array($result))){
        $baris[koment] = str_replace("\r\n","<br>",$baris[koment]); 
        echo "<table  width=92% BORDER=1>";
        echo "<tr><td>";
        echo "<table  width=100% BORDER=1 CELLSPACING=0> ";
        echo "<tr><td><br>
		$baris[koment]<hr color=#f1f1f1>";
        echo "<div align=right>";
        echo "$name : <b>$baris[nama]</b><br>";
        echo "Email : <A HREF=\"mailto:$baris[email]\">$baris[email]</A><br>";
        echo "$baris[waktu] <BR>";
		echo "</div>";
        echo "</td></tr></table>";
        echo "</td></tr></table>";
        echo "";
        echo "<br>";
	}
}

	if ($index != 0) {

		echo"<a href=\"lihat_tamu.php?index=" .
       ($index - $item_tampil) . "\">  << Prev </A> | "; 
	}
	else{
	
		print"<< Prev |  ";

	}

	if (($row == $item_tampil) and ($rows != $index+$item_tampil) ) {		
			echo"<A HREF=\"lihat_tamu.php?index=" .($index + $item_tampil) . "\">Next >></A>";
	}
	else{
	
		print"Next >> ";
	
	}
	
	echo"<br><br><a href=\"bukutamu.php\">Isi Buku tamu</a>";
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


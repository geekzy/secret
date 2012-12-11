<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="default.css" media="screen"/>
<title>Untitled Document</title>
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
			  <div align="center">
	<?
include "includes/konek.php";
echo"<p class=\"contentheading\">&nbsp;Forum Diskusi</p><br>";
$item_tampil=15;
if (empty($index)){
$index=0;
}
$query="select * from forum_tanya order by id_forum DESC limit $index,$item_tampil";
$query2="select * from forum_tanya order by id_forum DESC";
if (!$hasil=mysql_query($query)){
	echo mysql_error();
	exit;
}
if (!$hasil2=mysql_query($query2)){
echo mysql_error();
exit;
}
$row=mysql_num_rows($hasil);
$rows=mysql_num_rows($hasil2);

$no=$index;
print"<table width=90% align=center>";
while ($baris=mysql_fetch_array($hasil)){
	$no++;
	$sql="select * from forum_jawab where id_forum='$baris[id_forum]'";
	if (!$result=mysql_query($sql)){
		echo mysql_error();
		exit;
	}
	$jml=mysql_num_rows($result);
	print"<tr valign=top><td>$no.</td><td> <P align=left><FONT SIZE=\"2\" Face=\"arial\"><A HREF=\"detail_forum.php?id_forum=$baris[id_forum]\">$baris[judul]</A> oleh <I><B>$baris[nama]</B></I> $baris[waktu] ada <B>$jml</B> tanggapan</FONT></P></td></tr>";
}
print"</table>";
if ($index != 0) {
                print "<a href=\"lihat_forum.php?index=" . ($index - $item_tampil) . "\"><< Previous</a> ";
        }
if ($row == $item_tampil && $rows != $item_tampil+$index) {
                print " <a href=\"lihat_forum.php?index=" . ($index + $item_tampil) . "\">Next >></a>";
        }

print"<HR width=90%><BR><BR>";
?>
</div>

<?
include"form2.php";
?>     
              
			  <p>&nbsp;</p>



				
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


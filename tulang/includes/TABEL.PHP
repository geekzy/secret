<?
echo "<link rel=stylesheet href=../style.css type=text/css>";

function opentable($lebar,$warna,$jd,$nmjdl)
{
   echo ("<table  width=$lebar border=0 cellspacing=0 cellpading=1 bgcolor=$warna>
          <tr><td>");

   echo ("<table width=100% border=1 cellspacing=0 cellpading=0 bordercolor=#cccccc>");

   if ($jd=='Y') echo ("<tr><td bgcolor=$warna align=center><marquee><font color=#FF6666><b>$nmjdl</b></td></tr>");
   echo ("<tr><td>");
}
function closetable(){
   echo ("</td></tr></table></td></tr></table>");
}
function kolom1($n,$lebar,$rata)
{
	if ( $n % 2 >= 1)
		echo ("<td width='$lebar' bgcolor='#DADAFE' align='$rata'>");
	else
		echo ("<td width='$lebar' bgcolor='#F5F5FE' align='$rata'>");
}
function kolom2($n,$lebar)
{
	if ( $n % 2 >= 1)
		echo ("<td width='$lebar' bgcolor='#FAFAEE' align='$rata'>");
	else
		echo ("<td width='$lebar' bgcolor='#FFFFFF' align='$rata'>");
}


function selek($nama, $tabel, $urut, $isi)
{
	echo ("<select name='$nama' value='$nama' size=\"1\">");
	$sqlselek=mysql_query("select * from ".$tabel." order by ".$urut."");
	echo "<option selected>$isi</option>";
	while ($isiselek = mysql_fetch_row($sqlselek))
		{
			echo "<option value=\"$isiselek[1]\"> $isiselek[1] </option>";
		}
	echo "</select>";
}
?>



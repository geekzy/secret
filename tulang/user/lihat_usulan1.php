<?
print"<H2><B>Usulan Penyakit</B></H2>";
$item_tampil=10;
if (empty($index)){
	$index=0;
}

$tablename="usulan";

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

if($row==0){
        echo "Data kosong !<br>";
}else{
	echo"<table width=95% border=1 cellspacing=0 align=center> <tr bgcolor=f1f1f1 align=center><td><B>No</B></td><td><B>Nama</B></td><td><B>Waktu isi</B></td><td><B>Komentar</B></td><td>&nbsp;</td>";
$no=$index;	
while (($baris = mysql_fetch_array($result))){
      $no++; 
	  $baris[koment] = str_replace("\r\n","<br>",$baris[koment]); 
        echo "<tr valign=top onmouseover=\"this.style.backgroundColor = '#f1f1f1' ;\"
    onmouseout=\"this.style.backgroundColor = 'white';\"><td>$no</td><td>&nbsp;<A HREF=\"$baris[email]\">$baris[nama]</A></td><td>&nbsp;$baris[waktu]</td><td>&nbsp;$baris[usulan]</td>
		<td><A HREF=\"hapusbt.php?id=$baris[no_id]&index=$index\" onClick=\"return confirmLink(this,'menghapus data GB pada : $baris[waktu]');\"><img src='../images/delete.gif' alt='Hapus' border='0'></A></td>
		</tr> ";
}
print("</TABLE>\n");
}
?><BR>
<CENTER><?
	if ($index != 0) {

		echo"<a href=\"lihat_usulan.php?pilih=2&index=" .
       ($index - $item_tampil) . "\"> << Prev </A>"; 
	}
	else{
	?>

<FONT SIZE="2" color="silver">  << Prev  

<?
	}
	?>

<?
if (($row == $item_tampil) and ($rows != $index+$item_tampil) ) {		
			echo"<A HREF=\"lihat_usulan.php?pilih=2&index=" .($index + $item_tampil) . "\"> Next > ></A> ";
	}
	else{
	?>

<FONT SIZE="2" color="silver">Next >> 
		<?
	}
?>
</CENTER>	<BR><BR>
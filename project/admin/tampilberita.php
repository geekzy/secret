<?php
session_start();
include "../koneksi.php";
include "../config/fungsiindotgl.php";
include "../config/fungsihari.php";

echo "<h2>Berita</h2>
<form method = 'post' action = 'formberita.php'>
	<input type ='submit' value = 'tambah berita'> 
</form>  

<table border = '1'>
<tr><th>No</th>
	<th>Judul</th> 
	<th>Tgl. posting</th>
	<th>Hari Sekarang</th>
	<th colspan = 2>Aksi</th></th></tr>";

	$tampil = mysql_query("select * from berita where iduser = '$_session[namauser]' order by idberita desc ");
	$no =1 ;
	while ($coba=mysql_fetch_array($tampil)) {
		$tglposting = tglindo($coba [tanggal]);
		$har = hari ($coba[hari]);
		echo "<tr><td>$no</td>
		          <td>$coba[judul]</td>
		          <td>$tglposting</td>
		          <td>$har</td>
		          <td><a href = editberita.php?id=$coba[idberita]>Edit</a>
		          <td><a href = hapusberita.php?id=$coba[idberita]> Hapus</a></td></tr>";
		$no++;
	}
echo "</table>";	
?>

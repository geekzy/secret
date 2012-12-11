<?php
session_start();
include "../koneksi.php";
// apabila variabel session masih kosong (user belom login)
if (empty($_SESSION[user]) AND empty($_SESSION[pass])){
	echo "<center>Untuk mengisikan Berita, Anda Harus Login<br>";
	echo("<a href = formlogin.php><b>LOGIN</b></a></center>");
}
	//apabila user sudah login dengan benar terbentuklah session
else{
	echo "<h2> Tambah Berita</h2>
		<form method = 'Post' action = 'inputberita.php' enctype ='multipart/form-data'>
			<table border = '1'>
				<tr><td>Judul</td>
					<td> : <input type = 'text' name = 'judul' size = '60'></td></tr>
				<tr><td>Kategori</td>
					<td> : <select name = kategori>
				<option value ='0' selected>- Pilih Kategori -</option>";
				$tampil = mysql_query("select * from kategori order by namakategori");
	while ($ktgri = mysql_fetch_array($tampil)) {
	echo "<option value = $ktgri[idkategori]>
			$ktgri[namakategori]</option>";
		}
	echo "</select></td></tr>
				<tr><td>Isi Berita </td>
					<td> : <textarea name = 'isiberita' cols = '80' rows = '18' > </textarea> </td></tr>
				<tr><td>Gambar</td>
					<td> : <input type = 'file' name = 'fupload' size = '40' ></td></tr>
				<tr><td colspan = '2'><input type = 'submit' value = 'simpan'>
						  			  <input type = 'button' value = 'batal' onclick = self.history.back()></td></tr>
	</table>
	</form>";
       }

?>
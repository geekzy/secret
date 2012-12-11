<?
$q_cek = mysql_query("SELECT kode, nama FROM user WHERE username='$sesi_user'");
$r_cek = mysql_fetch_row($q_cek);
$kode_user = $r_cek[0];
$nama_user = $r_cek[1];
?>

<table border="0" cellspacing="0" cellpadding="0" height="100%" width="169">
  <tr> 
    <td>
      </td>
  </tr>
   <tr> 
    <td valign="top">  
	<form action="cari.php" method="post" name="frmCari" onSubmit="return cek()">
	    <input name="key" type="text" size="20">
        <br>
		<select name="kategori" size="1" style="height:inherit;">
          <option value="nama">Nama Penyakit</option>
          <option value="gejala">Gejala Penyakit</option>
        </select>
        <br>
        <input type="submit" name="Submit2" value="Cari" class="tombol" >
      </form>
    </td>
    
  </tr>
  <tr> 
    <td valign="top"><br> 
	<?
		if ($kode_user=="pakar"){
	?>
		<a href="pakar_penyakit.php">Penyakit</a><br>
      	<a href="pakar_gejala.php">Gejala</a><br>
      	<a href="pakar_penyebab.php">Penyebab</a> <br>
	  	<a href="pakar_solusi.php">Solusi</a> <br>
      <br>
      	<a href="pakar_gejalapenyakit.php">Gejala Penyakit</a><br>
      	<a href="pakar_penyebabpenyakit.php">Penyebab Penyakit</a><br>
	  	<a href="pakar_solusipenyakit.php">Solusi Penyakit</a><br />
		<a href="pakar_basis.php">Basis Aturan</a><br />
		<a href="lihat_usulan.php">Lihat Usulan</a><br />
	  <br />
	  	<a href="gantipass.php">Ubah Password</a><br>
		<?
		}else if ($kode_user=="admin"){
	?>
	<a href="../tulang.rar">backup database</a>
		
	<? }else{ ?>
		<a href="gantipass.php">Ubah Password</a><br>
	<? } ?>
    <br />
	<br /></td>
  </tr>

 
</table>


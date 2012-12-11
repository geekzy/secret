<?
  include "koneksi.php";
//cek dulu apakah parameter kode ada atau tidak
if(isset($_GET['kode'])){
   $kode = $_GET['kode'];
} else {
	//kalo gak ada  parameternya
	echo "<script>alert('Kode Barang Belum Dipilih');document.location='daftarbarang.php'</script>";
}

//ambil data barang dengan kode yang dipilih dan tampilkan dalam form
   $sql = "SELECT * FROM barang WHERE kodebarang='$kode'";
   $kueri = mysql_query($sql);
   $data = mysql_fetch_array($kueri);
   //tampung masing-masing data ke dalam variabel
   $kodebrg = $data['kodebarang'];
   $namabrg = $data['namabarang'];
   $harga = $data['harga'];
   $persediaan = $data['persediaan'];
?>
<!-- sekarang bikin formnya -->
<html>
<head><title>Edit Data Barang</title>
<script language="javascript">
function cekform(){
	//ini untuk ngecek formnya (semua form tidak boleh kosong)
	if(document.frmbarang.txtkode.value==""){
		alert('Kode Barang Harus Diisi');
		document.frmbarang.txtkode.focus();
		return false;
	} else if(document.frmbarang.txtnama.value==""){
		alert('Nama Barang Harus Diisi');
		document.frmbarang.txtnama.focus();
		return false;
	} else if(document.frmbarang.txtharga.value==""){
		alert('Harga Barang Harus Diisi');
		document.frmbarang.txtharga.focus();
		return false;
	} else if(document.frmbarang.txtpersediaan.value==""){
		alert('Persediaan Barang Harus Diisi');
		document.frmbarang.txtpersediaan.focus();
		return false;
	} else {
		return true;
	}
}
</script>
</head>
<body>
Edit Barang
<form action="" method="post" name="frmbarang" onsubmit="return cekform()">
<table width="500" border="1">
  <tr>
    <td width="163">Kode Barang </td>
    <td width="321"><!-- textbox untuk kodebarang dibuat menjadi readonly. Ini karena field kodebarang adalah Primary Key, sehingga tidak boleh diedit--><input name="txtkode" type="text" id="txtkode" size="5" maxlength="5" value="<? echo $kodebrg?>" readonly/></td>
  </tr>
  <tr>
    <td>Nama Barang </td>
    <td><input name="txtnama" type="text" id="txtnama" value="<? echo $namabrg?>"/></td>
  </tr>
  <tr>
    <td>Harga</td>
    <td><input name="txtharga" type="text" id="txtharga" value="<? echo $harga?>"/></td>
  </tr>
  <tr>
    <td>Persediaan</td>
    <td><input name="txtpersediaan" type="text" id="txtpersediaan" value="<? echo $persediaan?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="tblEdit" type="submit" id="tblEdit" value="Edit Barang" /></td>
  </tr>
</table>

</form>
</body>
</html>
<?
//ini kalo tombol editnya diklik
//perhatikan nama dari tombol edit nya (tblEdit)
if(isset($_POST['tblEdit'])){
	//ini adalah variabel untuk menampung inputan dari form (nama variabel bebas)
	// yang ada di dalam $_POST[''] adalah nama dari masing-masing textbox
	$kode = $_POST['txtkode'];
	$nama = $_POST['txtnama'];
	$harga = $_POST['txtharga'];
	$persediaan = $_POST['txtpersediaan'];
	//siapkan sebuah variabel untuk menampung query mysql
	//yang ada di dalam VALUES harus berurutan sesuai dengan uturan field yang ada dalam tabel
	$sql = "UPDATE barang SET namabarang='$nama', harga='$harga', persediaan='$persediaan' WHERE kodebarang='$kode'";
	//jalankan kuerynya
	$kueri = mysql_query($sql);
	//cek apakah variabel $kueri bernilai TRUE atau FALSE
	if($kueri){
	//ini kalo TRUE
	//tampilin alert pake javascript aja deh
		echo "<script>alert('Data barang berhasil diedit'); document.location='daftarbarang.php'</script>";
	} else {
	//ini kalo FALSE
		echo "<script>alert('Data barang gagal diedit')</script>";
		//tampilkan pesan error mysqlnya
		echo mysql_error();
	}
}
?>

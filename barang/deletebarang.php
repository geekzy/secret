<?
//cek dulu apakah parameter kode ada atau tidak
if(isset($_GET['kode'])){
   include "koneksi.php";
   //kalo ada berarti lakukan perintah delete
   $kode = $_GET['kode'];
   $sql = "DELETE FROM barang WHERE kodebarang='$kode'";
   $kueri = mysql_query($sql);
   if($kueri){
   	//kalo deletenya berhasil
	//tampilkan alert dan pindah ke halaman daftar barang
	echo "<script>alert('Data barang berhasil dihapus');document.location='daftarbarang.php'</script>";
   } else{
   echo "<script>alert('Data barang Gagal dihapus');document.location='daftarbarang.php'</script>";
   }
} else {
	//kalo gak ada  parameternya
	echo "<script>alert('Kode Barang Belum Dipilih');document.location='daftarbarang.php'</script>";
}
?>
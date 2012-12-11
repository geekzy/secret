<?
//siapin variabel untuk konfigurasi database
$host = "localhost";
$user = "root";
$pass = "";
$db = "ujian";

$cn = mysql_connect($host,$user,$pass);
//cek apakah koneksi berhasil
if(!$cn){
    // kalo gagal
	die("<h2>Koneksi ke database gagal </h2>".mysql_error());
} else {
	//kalo berhasil. pilih database
	$pilih = mysql_select_db($db);
	//bisa gak ya pilih database
	if(!$pilih){
		//kalo gagal
		die("<h2>Database gagal dipilih </h2>".mysql_error());
	}	
}
mysql_select_db("ujian");
?>
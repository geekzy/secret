<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Daftar Barang</title>
<link href="style.css" rel="stylesheet" type="text/css">

</head>

<body >
<?
include "menubarang.php";
?>
<table align="center" width="519" border="4">
  <caption align="top">
    Daftar Barang <br />
  </caption>
  <tr>
    <th width="25" scope="col">No</th>
    <th width="103" scope="col">Kode Barang </th>
    <th width="128" scope="col">Nama Barang </th>
    <th width="60" scope="col">Harga</th>
    <th width="81" scope="col">Persediaan</th>
    <th width="82" scope="col">Action</th>
    <th width="83" scope="col">Bebas</th>
  </tr>
<?
//siapkan query untuk mengmbil semua data barang yang ada
include "koneksi.php";
$sql = "SELECT * FROM barang";
$kueri = mysql_query($sql);
//karena datanya lebih dari 1 record maka gunakan while
//semua data disimpan dalam array
//loopnr untuk menampilkan data barang
$no = 1;
while($data = mysql_fetch_array($kueri)){
	?>
	<tr>
		<td><? echo $no?></td>
		<td><? //tampilin data dari database
		//$data adalah nama array yg kita buat
		// kodebarang adalah nama field yang ada di tabel
		echo $data['kodebarang']?></td>
		<td><? echo $data['namabarang']?></td>
		<td><? echo $data['harga'];?></td>
		<td><? echo $data['persediaan']?></td>
		<td><!-- buat link untuk edit dan delete dan berikan parameter dgn nama "kode"--><a href="editbarang.php?kode=<? echo $data['kodebarang']?>">Edit</a> <a href="deletebarang.php?kode=<? echo $data['kodebarang']?>">Delete</a></td>
	</tr>
	<?
$no++;}
?>
</table>
</body>
</html>

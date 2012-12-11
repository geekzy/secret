
<html>
<head>
	<title>Diskon</title>
</head>
<body>
	<form>
		<table>
			<tr>
				<td>Nama Barang</td>
				<td>:</td>
				<td><input type="teks" name="nama"></td>
			</tr>
			<tr>
				<td>Harga Barang</td>
				<td>:</td>
				<td><input type="teks" name="harga"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Submit"></td>				
				<td><input type="reset"></td>
			</tr>
		</table>
	</form>
</body>

</html>
<?php
$diskon = 400000;
if ($harga >= $diskon) {
	$total = $harga * 0.23;
}else{
	$total = 0;
}
$gatot = $harga - $total;

echo "------------------------------------- <br>";
echo $_GET['nama']."<br>";
echo $gatot;
?>
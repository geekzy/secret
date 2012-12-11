<html>
<head>
	<title></title>
</head>
<body>
	<form action ='test.php' method = 'Get'>
			<table border = '1'>
				<tr><td>Nama pembeli</td>
					<td><input type = 'text' name = 'nama'></td></tr>
				<tr><td>Jenis Kain</td>
					<td><select name = 'jenis'>
							<option>--Pilih--</option>
							<option value ="ktn">Katun</option>
							<option value="str">Sutra</option>
						</select></td></tr>
				<tr><td>Kualitas</td>
					<td><input type = 'radio' name = 'kualitas' value="1"> 1</td></tr>
				<tr><td></td>
					<td><input type = 'radio' name = 'kualitas' value="2"> 2</td></tr>	
				<tr><td></td>
					<td><input type = 'radio' name = 'kualitas' value="3"> 3 </td></tr>
				<Tr><td>Jumlah beli</td>
					<td><input type = 'text' name = 'jumlah'></td></tr>
				<tr><td><input type = 'submit' value = 'lihat'> </td>
					<td><input type = 'reset' value = 'bersih'> </td></tr>			
			</table>
	</form>
</body>
</html>
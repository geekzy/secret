<?php
include "../koneksi.php";
$edit= mysql_query("select * from user where iduser='$_GET[iduser]'");
$coba = mysql_fetch_array($edit);
echo "<h2>EDIT USER</h2>
<form method = 'post' action = 'updateuser.php'>
<input type = 'hidden' name = 'id' value = '$coba[iduser]'>

	<table border = '1'>
		<tr><td>Username</td> 
			<td> :
		<input type = 'text' name ='iduser' value = '$coba[iduser]'></td</tr>
		<tr><td>Password</td>
			<td> :
		<input type ='text' name ='password'> *) </td></tr>
		<tr><td>Nama Lengkap</td>
			<td> : 
		<input type = 'text' name ='namalengkap' size = '30' value ='$coba[namalengkap]'></td</tr>
		<tr><td>Email</td> 
			<td> : 
		<input type = 'text' name = 'email' size 30 value = '$coba[email]'></td></tr>
		<tr><td colspan = '2' > *) apabila password tidak diubah, dikosongkan saja</td></tr>
			<tr><td colspan ='2'>
		<input type = 'submit' value = 'update'>
		<input type = 'button' value =' batal ' onclick = self.history.back()></td></tr>
	</table>
</form> ";

?>


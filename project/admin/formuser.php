<script languange="javascript">
var pesanberjalan=" selamat datang para user .";
var bmulai = 1 ;
function animasi(){
	if (bmulai ==1) {
		pesanberjalan ="       "+pesanberjalan+"         ";
		window.status=pesanberjalan;
		bmulai = 0;

	}else{
		pesanberjalan = pesanberjalan.substring(1)+ pesanberjalan.substring(0.1);
		window.status = pesanberjalan;
	}
	setTimeout('animasi()',200);

}
</script>



<link a href="../style/bootsrap/css/boostrap.css" type ="text/css" rel = "stylesheet"></link>
<link a href="../style/bootsrap/css/boostrap.min.css" type ="text/css" rel = "stylesheet"></link>
<link a href="../style/bootsrap/css/boostrap-responsive.css" type ="text/css" rel = "stylesheet"></link>
<link a href="../style/bootsrap/css/boostrap-responsive.min.css" type ="text/css" rel = "stylesheet"></link>
<link a href="../style/bootsrap/img/glyphicons-halflings.png" rel = "shortcut icon"></link>
<style type="text/css"></style>

<?php
echo "<h2 align ='center'><font = 'tahoma' color= red >Tambah User</h2>
<form method = 'post' action = 'inputuser.php'>
<table bacground color = red border = 3 align = 'center'>
<tr><td><font color = green >Username</td>
<td> : <input class = 'input-medium' placeholder = 'ID User' type = text name = iduser></td</tr>
<tr><td><font color = blue >Password</td>
<td> : <input placeholder ='Password' type ='password' name='password' >
<tr><td><font color = red> Nama Lengkap</td> 
<td> : <input placeholder = 'Nama Lengkap' type = text name='namalengkap' size = '20' ></td></tr>
<tr><td>Email</td>
<td> : <input type = 'text' name= 'email' placeholder = 'Email'></td><tr>
<tr><td colspan ='2'> <input type = 'submit' value = 'simpan' size ='10'>
 <input type = 'button' size ='10' value = 'batal' onclick=self.history.back()>
</td></tr>
</table>
</form>"

?>
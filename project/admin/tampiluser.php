<?php
echo "<h2>DATABASE USER</h2>
<form method = 'post' action = 'formuser.php'>
<input type = 'submit' value = 'tambah user'>
</form>
<table border = '1'>
<tr><th>no</th><th>username</th>
<th>nama lengkap</th><th>email</th><th>aksi</th></th></tr>";

include "../koneksi.php";
$tampil=mysql_query("select * from user order by iduser");
$no =1;
while ($r=mysql_fetch_array($tampil)){
	echo "<tr><td>$no</td>
			  <td>$r[iduser]</td>
	          <td>$r[namalengkap]</td>
	          <td><a href =mailto:$r[email]>$r[email]</a></td>
	          <td><a href =edituser.php?iduser=$r[iduser]>edit |
	              <a href =hapususer.php?iduser=$r[iduser]>delete</td></tr>";
	              $no++;
}
echo "</table>";
?>
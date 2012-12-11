<?php
include ("koneksi.php");
$hasil = mysql_query("select * from user");
while ($fetch = mysql_fetch_array($hasil))
{
    echo $fetch[0] . " " . $fetch["username"] . "<BR>";
}
?>
<?php
$db_hostname="localhost";
$db_username="root";
$db_password="";
$db_name="tulang";

mysql_connect($db_hostname,$db_username,$db_password);
mysql_select_db($db_name);


  
  function otentikasi($pemakai, $password)
  {
    $hasil = mysql_query("SELECT password FROM user WHERE username = '$pemakai' ");

    if (! $hasil)
      return FALSE;

    $kode_rahasia = md5($password);

    $baris = mysql_fetch_row($hasil);
    if ($baris[0] == $kode_rahasia)
      return TRUE;
    else
      return FALSE;
  }
?>

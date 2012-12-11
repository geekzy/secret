<?
 include "Otentik.inc";
$query="delete from usulan where no_id='$id'";
if (!mysql_query($query)){
echo mysql_error();
exit;
}

?>
<meta http-equiv="refresh" content="0; URL=lihat_usulan.php" />
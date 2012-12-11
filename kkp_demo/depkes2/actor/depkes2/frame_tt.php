<?
/* Iframe informasi */
print "
<html>
<head>
<style>
body	{font-family:tahoma,sans-serif; font-size:11px;color:#666666;font-weight: bold;}
</style>
</head>
<body bgcolor=#eeeeff topmargin=3 leftmargin=3>";

include ('init.php');
include ('auth.php');
//print $a;
$sql = eregi_replace("\\\'","'",$_REQUEST['sql']);
//print $sql;
//$sql = str_replace("\'","'",$sql);
//$adodb->debug = true;
$str = '';
if ($sql) {
	echo "<script language=javascript>\n";

	$q = $adodb->Execute($sql);
	while (! $q->EOF)
	{
		foreach ($q->fields as $key => $val) {
			echo "parent.document.theform.".$key.".value = '".$val."';\n";
		}
        	#$alm = $q->fields['alamat_pabrik'];
		#$prop = $q->fields['nama_propinsi_2'];
        	$q->movenext();
	}
	echo "</script>\n";
}
?>

<?
/* Iframe informasi */
print "<html>
<head>
<style>
body	{font-family:tahoma,sans-serif; font-size:11px;color:#666666;font-weight: bold;}
</style>
</head>
<body bgcolor=#eeeeff topmargin=3 leftmargin=3>";

include ('init.php');
include ('auth.php');
//print $a;
$sql = eregi_replace("\\\'","'",$sql);
print $sql;
//$sql = str_replace("\'","'",$sql);
//$adodb->debug = true;
$str = '';
if ($sql) {
$q = $adodb->Execute($sql);
while (! $q->EOF)
{
        $alm = $q->fields['alamat_pabrik'];
	$prop = $q->fields['nama_propinsi_2'];
        $q->movenext();
}

		print "<script language=javascript>
		parent.document.theform.alamat.value = '".$alm."';
		parent.document.theform.propinsi.value = '".$prop."';
		";
		print "</script>
		";


}
?>

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

$str = '';
	echo "<script language=javascript>\n";
	echo "parent.document.theform.id_sub_kategori.options.length = 0;\n";
	$rs = $adodb->Execute("SELECT * FROM ".$_GET[b]." WHERE id_kategori='".$_GET[a]."'");
	while (! $rs->EOF)
	{
		$val = $rs->fields[id_subkategori];
		$txt = $rs->fields[nama_subkategori];
		echo "parent.id_sub_kategori_add('$txt', '$val', 0);\n";
        	$rs->movenext();
	}
	echo "</script>\n";
?>

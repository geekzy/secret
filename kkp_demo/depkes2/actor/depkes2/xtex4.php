<?
include 'init.php';
include 'auth.php';
//print "<script language='javascript'>alert ('No Doc Tersebut tidak ada');</script>";
print "
<head>
<link rel='stylesheet' href=".$path_theme."/style.css type='text/css'>
<style type='text/css'>
body {
	margin-top: 0px;
	margin-bottom: 0px;
	background-color: #eeeeff;
}
</style>
";

$sqlx = "
	SELECT
		*
	FROM
		pendaftar
	WHERE
		 userid = '".$a."'
";
print $sqlx;
$nahx = $adodb->Execute($sqlx);
$userid = $nahx->fields['userid'];

if($userid){
print "<script language='javascript'>alert ('User name  ".$userid." sudah ada, Silahkan dengan nama user yang lain');
parent.document.theform.userid.focus();
</script>";
}
//$munet .= "</script>";
$munet .= "</body>
</html>";
print $munet;

?>

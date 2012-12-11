<?
/*
 * Require Initialization
 */
require 'init.php'
?>

<br>
<p align="center">
  <font size=+1>LAST LOGIN</font>
</p>
<hr size="1">

<table width="300" align="center" border="1">

<?
/*
 * Get USer ID
 */
$user_id = $ses->loginid;

/*
 * Define an SQL Query to gather information about last login
 */
/*
 $s  = "SELECT ";
$s .= "  *,";
$s .= "  EXTRACT(EPOCH FROM login_date) AS epoch ";
$s .= "FROM ";
$s .= "  login_history ";
$s .= "WHERE ";
$s .= "  user_id='$user_id' ";
$s .= "ORDER BY ";
$s .= "  login_date DESC ";
$s .= "LIMIT 20";
*/
$s = "SELECT login_date AS tanggal FROM login_history WHERE user_id='$user_id' ORDER BY history_id DESC LIMIT 15";
//$s .= "login_date FROM login_history WHERE user_id = '$user_id' ORDER BY login_date DESC LIMIT 10 ";
//print $s;
/*
 * Execute SQL Query
 */
$rs = $adodb->Execute($s);

/*
 * Get data
 */
$result = $adodb->GetAll($s);

/*
 * Show data
 */
foreach ($result AS $r) {
?>

  <tr>
    <td><?print $r['tanggal']; ?></td>
	
  </tr>

<?
} // end : foreach ($result AS $r)
?>

</table>

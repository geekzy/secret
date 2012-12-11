<?
/*
 * Require Initialization
 */
require 'init.php'
?>

<br>
<p align="center">
  <font size=+1>PENILAI</font>
</p>
<hr size="1">

<table align="center" border="1">
  <tr align="center" style="font-weight: bold">
    <td width="20">No.</td>
    <td width="100">User ID</td>
    <td width="300">Password</td>
    <td width="100">Name</td>
    <td width="120">Action</td>
  </tr>

<?
/*
 * Define an SQL Query to gather information about last login
 */
$s  = "SELECT ";
$s .= "  * ";
$s .= "FROM ";
$s .= "  penilai";

// SELECT p.*,k.userid AS koordinator FROM penilai AS p, penilai AS k WHERE p.userid=k.koordinator

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
$no = 0;
foreach ($result AS $r) {
  $no++;
?>

  <tr>
    <td width="20" align="center"><?= $no ?></td>
    <td width="100"><?= $r['userid'] ?></td>
    <td width="300"><?= $r['passwd'] ?></td>
    <td width="100"><?= $r['name'] ?></td>
    <td width="120" align="center">Edit - Delete</td>
  </tr>

<?
} // end : foreach ($result AS $r)
?>

</table>
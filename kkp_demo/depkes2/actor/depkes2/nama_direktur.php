<?php

require_once 'init.php';
require_once 'auth.php';

/*
 * If there is an Update request
 */
if (isset($_POST['txtNamaDirektur']) && isset($_POST['txtNIP'])) {
  $nama_direktur = $_POST['txtNamaDirektur'];
  $nip           = $_POST['txtNIP'];

  $sql = "UPDATE nama_direktur SET nama='$nama_direktur',nip='$nip'";

  $adodb->Execute($sql);

  header("location: ?success=1");
  exit();
} // end : if (isset($_POST['txtNamaDirektur']) && isset($_POST['txtNIP']))

/*
 * Get "nama_direktur"
 */
$sql = "SELECT * FROM nama_direktur LIMIT 1";

$row = $adodb->Execute($sql);
?>

<h2 style="text-align: center">Data Direktur</h2>
<hr size="1" />

<?
if (isset($_REQUEST['success'])) {
?>

<p align="center">
  <font color="blue">Data Direktur telah di Update</font>
</p>

<?
} // end : if (isset($_REQUEST['success']))
?>

<form name="f" method="post" action="?">
<table align="center" border="0">
  <tr>
    <td>Nama Direktur</td>
    <td width="10" align="center">:</td>
    <td><input type="text" name="txtNamaDirektur" size="40" value="<?= $row->fields['nama'] ?>"></td>
  </tr>
  <tr>
    <td>NIP</td>
    <td width="10" align="center">:</td>
    <td><input type="text" name="txtNIP" size="11" value="<?= $row->fields['nip'] ?>"></td>
  </tr>
  <tr>
    <td colspan="3" align="center">
      <br />
      <input type="submit" value="Update" />
      &nbsp;
      <input type="reset" value="Reset" />
    </td>
  </tr>
</table>
</form>

<?
$page_time_end = getmicrotime();
$page_time = $page_time_end - $page_time_start;
echo "<br><center><b>[ Page created in: <font color=red>{$page_time}</font> (seconds). ]</b>";
?>
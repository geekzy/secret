<?php
function jam()
{
global $jj,$mm;

$saat_ini=getdate();
$jj=$saat_ini['hours'];
$mm=$saat_ini['minutes'];
}
jam();
echo"$jj : $mm ";

?>

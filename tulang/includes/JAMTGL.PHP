<?php
function tgl()
{

global $bulanx,$harix,$tglx,$tahunx,$bulannomor;

$nmbulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
$nobulan=array("","01","02","03","04","05","06","07","08","09","10","11","12");
$nmhari=array("Ahad","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");

$hari_ini=getdate();
$bulanx=$nmbulan[$hari_ini['mon']];
$harix=$nmhari[$hari_ini['wday']];
$tglx=$hari_ini['mday'];
$tahunx=$hari_ini['year'];
$bulannomor=$nobulan[$hari_ini['mon']];
}

tgl();
echo"$harix, $tglx $bulanx $tahunx ";

?>

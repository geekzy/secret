<?php
$sekarang = getdate();
$hari = $sekarang['mday'];
$bulan = $sekarang['month'];
$tahun = $sekarang['year'];
$jam = $sekarang['hours'];
if ($jam < 11)
{
    echo "Selamat Pagi";
} elseif ($jam > 11 and $jam <= 15)
{
    echo "Selamat Siang";
} elseif ($jam > 15 and $jam <= 18)
{
    echo "Selamat Sore";
} elseif ($jam > 18)
{
    echo "Selamat Malam";
}
echo "<br>Hari ini adalah tanggal $hari $bulan $tahun";
?>
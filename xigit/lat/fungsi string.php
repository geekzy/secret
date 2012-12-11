<?php

// code written by Firmansyah Wahyudiarto
//============================================
$stringnya = "Firmansyah Wahyudiarto belajar bahasa pemrograman PHP";
// 1. Contoh fungsi strlen
$str_len = strlen($stringnya);
echo "Jumlah karakter dari \"$stringnya\" adalah $str_len <br /><hr><br />";
// 2. Contoh fungsi strrev(erse)
$str_rev = strrev($stringnya);
echo "Jika kalimat \"$stringnya\" dibalik adalah $str_rev <br /><hr><br />";
// 3. Contoh fungsi str_replace
$strreplace = str_replace("belajar", "bermain", $stringnya);
echo "Jika kalimat \"$stringnya\" diganti mjd $strreplace <br /><hr><br />";
// 4. Contoh fungsi substr
$sub_str = substr($stringnya, 3, 4);
echo "Diambil kata dari kalimat \"$stringnya\" mjd $sub_str <br /><hr><br />";
// 5. Contoh strtolower dan strtoupper
$kecilsemua = strtolower($stringnya);
$gedesemua = strtoupper($stringnya);
echo "kalimat \"$stringnya\" dibuat huruf kecil semua menjadi $kecilsemua <br /><br />";
echo "kalimat \"$stringnya\" dibuat huruf gede semua menjadi $gedesemua <br /><hr><br />";
// 6. Contoh fungsi strpos
$str_pos = strpos($stringnya, "i");
if ($str_pos === false)
{
    echo "Tidak Ditemukan";
} else
{
    echo "Ditemukan huruf pada huruf ke- $str_pos pada kalimat \"$stringnya\"";
}
echo "<br /><hr><br />";

?>
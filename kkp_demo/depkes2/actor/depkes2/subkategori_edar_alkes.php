<?php

$pre = 'subkategori';
$suf1 = 'pemutihan';
$suf2 = 'edar';
$suf3 = 'alkes';
$suf4 = 'import';

if ($suf3 && $suf4) $suf5 = '_'.$suf3.'_'.$suf4;
$suf6 = $suf3 ? $suf2."_".$suf3 : $suf2;

$my_table =             $pre.'_'.$suf6;
$my_kelas =             'kelas_'.$suf6;
$my_kelengkapan = 'kelengkapan_'.$suf1.'_'.$suf2.$suf5;
$my_pendaftar =     'pendaftar_'.$suf1.'_'.$suf2.$suf5;
$my_tt =                   'tt_'.$suf1.'_'.$suf2.$suf5;
$my_insubdit =   'inbox_subdit_'.$suf1.'_'.$suf2.$suf5;
$my_inseksi =     'inbox_seksi_'.$suf1.'_'.$suf2.$suf5;
$my_cek =                 'cek_'.$suf1.'_'.$suf2.$suf5;
$my_detail =        'cekdetail_'.$suf1.'_'.$suf2.$suf5;
$my_sk =                   'sk_'.$suf1.'_'.$suf2.$suf5;
$my_st =                   'st_'.$suf1.'_'.$suf2.$suf5;
$my_sp =                   'sp_'.$suf1.'_'.$suf2.$suf5;
$my_kat =            'kategori_'.$suf2.'_'.$suf3;
$my_kategori = $my_kat;
$my_subkat =      'subkategori_'.$suf2.'_'.$suf3;
$my_title = ucwords(str_replace('_', ' ', $suf6));

include_once "$pre.php";

?>

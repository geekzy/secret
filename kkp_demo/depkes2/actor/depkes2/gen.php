<?php

$fd = fopen('kelengkapan.sql', 'r');
$str = fread($fd, filesize('kelengkapan.sql'));
fclose($fd);

$fd = fopen('kelengkapan_registrasi_edar_alkes_import_admin.php', 'r');
$str2 = fread($fd, filesize('kelengkapan_registrasi_edar_alkes_import_admin.php'));
fclose($fd);


$arr1 = array('registrasi', 'ubah', 'pemutihan');
$arr2 = array('alkes', 'pkrt');
$arr3 = array('lokal', 'import');
$arr4 = array('a', 't');
$map4['a'] = 'Administratif';
$map4['t'] = 'Teknis';
$file4['a'] = 'admin';
$file4['t'] = 'teknis';


foreach ($arr1 as $v1)
	foreach ($arr2 as $v2)
		foreach ($arr3 as $v3) 
			foreach ($arr4 as $v4)
			{
				$out = str_replace('kelengkapan_ubah_edar_alkes_import_t', "kelengkapan_".$v1."_"."edar"."_".$v2."_".$v3."_".$v4."", $str);
				$fd = fopen('gen.sql', 'w');
				fwrite($fd, $out);
				fclose($fd);
				#`psql -h localhost -U depkes2 < gen.sql`;

				$out2 = str_replace('kelengkapan_registrasi_edar_alkes_import_a', "kelengkapan_".$v1."_"."edar"."_".$v2."_".$v3."_".$v4."", $str2);
				$out2 = str_replace('Administratif Registrasi Izin Edar Alkes Import', $map4[$v4]." ".ucwords($v1)." Izin Edar ".ucwords($v2)." ".ucwords($v3), $out2);
				$fd = fopen("kelengkapan_".$v1."_"."edar"."_".$v2."_".$v3."_".$file4[$v4].".php", "w");
				fwrite($fd, $out2);
				fclose($fd);


			}
			

?>

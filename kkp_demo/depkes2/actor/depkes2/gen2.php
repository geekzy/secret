<?php

include '../../adodb/adodb.inc.php';
$adodb = &ADONewConnection('postgres'); // load module driver
$adodb->Connect('localhost', 'depkes2', 'depkes123', 'depkes2');
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$adodb->debug = 1;

function create_php_sql($v1, $va, $v2, $v3) {
	global $adodb;

	###### PHP ######
	$arrvv = array (
	'kelas', 
	'kelengkapan',
	'pendaftar', 'tt', 
	'inbox_subdit', 'inbox_seksi', 
	'cek', 'cekdetail', 'laporan', 
	'sk', 'sp', 'st'
	);
	foreach ($arrvv as $val) { 
		$vv = $val;
		$str = fread(fopen('pendaftar_registrasi_produksi.php', 'r'),
		filesize('pendaftar_registrasi_produksi.php'));
		$out = str_replace("'pendaftar'", "'$vv'", $str);
		$out = str_replace("'registrasi'", "'$v1'", $out);
		$out = str_replace("'produksi'", "'$va'", $out);
		$out = str_replace("suf3 = ''", "suf3 = '$v2'", $out);
		$out = str_replace("suf4 = ''", "suf4 = '$v3'", $out);
		
		if (ereg('(kategori)|(subkategori)|(kelas)', $val)) {
			if ($v2) $table = $val."_".$va."_".$v2;
			else $table = $val."_".$va;
			
			$out = ereg_replace("\\\$my_table[^;]+;", 
			"\$my_table =             \$pre.'_'.\$suf6;",
			$out);
			
			$out = ereg_replace("\\\$my_title[^;]+;", 
			"\$my_title = ucwords(str_replace('_', ' ', \$suf6));",
			$out);
			
			if ($val == 'kelas' && $va == 'penyalur') continue;
		} else {
			if ($v2 && $v3) $table = $val."_".$v1."_".$va."_".$v2."_".$v3;
			else $table = $val."_".$v1."_".$va;
		}

		if (!ereg('cekdetail', $table)) fwrite(fopen($table.'.php', 'w'), $out);
		
		##### SQL #####
		if (ereg('(laporan)|(kelas)', $vv)) continue;
		$rs = $adodb->Execute("SELECT * FROM $table LIMIT 1");
		if (! $rs) {
			$str = fread(fopen($vv.'.sql', 'r'), filesize($vv.'.sql'));
			$out = str_replace($vv.'_registrasi_produksi', $table, $str);
			fwrite(fopen('gen.sql', 'w'), $out);
			`psql -h localhost -U depkes2 depkes2 < gen.sql`;
		}

		if (ereg('cek_', $table)) {
			$adodb->Execute("alter table $table add no_sk_lama varchar(255);");
			$adodb->Execute("alter table $table add date_sk_lama integer;");
			$adodb->Execute("alter table $table add lisensi text;");
			$adodb->Execute("alter table $table add lisensi2 text;");
			$adodb->Execute("alter table $table add nama_produk2 text;");
			$adodb->Execute("alter table $table add lisensi3 text;");
			$adodb->Execute("alter table $table add nama_produk3 text;");
			$adodb->Execute("alter table $table add lisensi4 text;");
			$adodb->Execute("alter table $table add nama_produk4 text;");
			$adodb->Execute("alter table $table add lisensi5 text;");
			$adodb->Execute("alter table $table add nama_produk5 text;");
			$adodb->Execute("alter table $table add jenis varchar(255);");
			$adodb->Execute("alter table $table add id_kategori integer;");
			$adodb->Execute("alter table $table add id_sub_kategori integer;");
			$adodb->Execute("alter table $table add ukuran varchar(255);");
			$adodb->Execute("alter table $table add kemasan varchar(255);");
			$adodb->Execute("alter table $table add perubahan varchar(255);");
		}
}
}

$arra = array('produksi', 'penyalur', 'edar');
$arr1 = array('registrasi', 'ubah', 'pemutihan', 'adendum');
$arr2 = array('alkes', 'pkrt');
$arr3 = array('lokal', 'import');
$arr4 = array('a', 't');
$map4['a'] = 'Administratif';
$map4['t'] = 'Teknis';
$file4['a'] = 'admin';
$file4['t'] = 'teknis';

foreach ($arra as $va) { // produksi, penyalur, edar
	$menustr .= ".|Izin ".ucwords($va)."||||\n"; // IZIN PRODUKSI / PENYALUR / EDAR
	
	// KELAS
	// Produksi ada kelas
	// Penyalur tidak ada kelas
	// Edar 
	// - Alkes ada kelas sendiri
	// - PKRT ada kelas sendiri
	if ($va == 'produksi') {
		
		## MENU
		$menustr .= "..|Kelas|kelas_".$va.".php?force_clean=1|||\n";
		
		## SQL
		/*
		$str = fread(fopen('kelas.sql', 'r'), filesize('kelas.sql'));
		$out = str_replace('kelas_produksi', "kelas_".$va, $str);
		fwrite(fopen('gen.sql', 'w'), $out);
		`psql -h localhost -U depkes2 < gen.sql`;
		*/
	}

	if ($va == 'edar') {
	
		// Pada IZIN EDAR terdapat kelas, kategori, sub-kategori
		foreach ($arr2 as $v2) { // alkes, pkrt
		
			$v22 = ucwords($v2);
			if ($v2=='pkrt') $v22 = strtoupper($v2);
			
			## MENU
			$menustr .= 
			"..|".ucwords($v22)."||||\n". // ALKES / PKRT
			// --
			"...|Kelas|kelas_".$va."_".$v2.".php?force_clean=1|||\n".
			// -- 
			"...|Kategori|kategori_".$va."_".$v2.".php?force_clean=1|||\n".
			// --
			"...|Sub Kategori|subkategori_".$va."_".$v2.".php?force_clean=1|||\n";

			## SQL
			/*
			$str = fread(fopen('kelas.sql', 'r'), filesize('kelas.sql'));
			$out = str_replace('kelas_produksi', "kelas_".$va."_".$v2, $str);
			fwrite(fopen('gen.sql', 'w'), $out);
			`psql -h localhost -U depkes2 < gen.sql`;
			*/

			foreach ($arr3 as $v3) { // lokal, import
			
				$menustr .= "...|".ucwords($v3)."||||\n"; // LOKAL / IMPORT
				
				foreach ($arr1 as $v1) { // registrasi, ubah, pemutihan, skip adendum
				
					if ($v1 == 'adendum') continue;
				
					$v11 = ucwords($v1);
					if ($v1=='ubah') $v11 = 'Perubahan';
					
					$menustr .= 
					"....|".ucwords($v11)."||||\n". // REGISTRASI, UBAH, PEMUTIHAN
					// -- 
					".....|Kelengkapan|kelengkapan_".$v1."_".$va."_".$v2."_".$v3.".php?".
					"force_clean=1|||\n".
					// --
					".....|Pemohon|pendaftar_".$v1."_".$va."_".$v2."_".$v3.".php?".
					"force_clean=1|||\n".
					// --
					".....|Tanda Terima|tt_".$v1."_".$va."_".$v2."_".$v3.".php?".
					"force_clean=1|||\n".
					// --
					".....|Inbox||||\n".
					// --
					"......|Subdit|inbox_subdit_".$v1."_".$va."_".$v2."_".$v3.".php?".
					"force_clean=1|||\n".
					// --
					"......|Seksi|inbox_seksi_".$v1."_".$va."_".$v2."_".$v3.".php?".
					"force_clean=1|||\n".
					// --
					".....|Cek Kelengkapan|cek_".$v1."_".$va."_".$v2."_".$v3.".php?".
					"force_clean=1|||\n".
					// --
					".....|Surat||||\n".
					// --
					"......|Surat Keputusan|sk_".$v1."_".$va."_".$v2."_".$v3.".php?".
					"force_clean=1|||\n".
					// --
					"......|Surat Tambah Data|st_".$v1."_".$va."_".$v2."_".$v3.".php?".
					"force_clean=1|||\n".
					// --
					"......|Surat Penolakan|sp_".$v1."_".$va."_".$v2."_".$v3.".php?".
					"force_clean=1|||\n".
					// --
					".....|Laporan|laporan_".$v1."_".$va."_".$v2."_".$v3.".php?".
					"force_clean=1|||\n";

					create_php_sql($v1, $va, $v2, $v3);

					# LOGIN PENDAFTAR
					/*
					$arrvv = array ('pendaftar');
					foreach ($arrvv as $val) {
						$table = $val."_".$v1."_".$va."_".$v2."_".$v3;
						echo  "'$table',\n";
					}
					*/

					# ALTER CEK
					$arrvv = array ('cek');
					foreach ($arrvv as $val) {
						$table = $val."_".$v1."_".$va."_".$v2."_".$v3;
				    
						$adodb->Execute("alter table $table add no_sk_lama varchar(255);");
						$adodb->Execute("alter table $table add date_sk_lama integer;");
						$adodb->Execute("alter table $table add lisensi text;");
						$adodb->Execute("alter table $table add lisensi2 text;");
						$adodb->Execute("alter table $table add nama_produk2 text;");
						$adodb->Execute("alter table $table add lisensi3 text;");
						$adodb->Execute("alter table $table add nama_produk3 text;");
						$adodb->Execute("alter table $table add lisensi4 text;");
						$adodb->Execute("alter table $table add nama_produk4 text;");
						$adodb->Execute("alter table $table add lisensi5 text;");
						$adodb->Execute("alter table $table add nama_produk5 text;");
						$adodb->Execute("alter table $table add jenis varchar(255);");
						$adodb->Execute("alter table $table add id_kategori integer;");
						$adodb->Execute("alter table $table add id_sub_kategori integer;");
						$adodb->Execute("alter table $table add ukuran varchar(255);");
						$adodb->Execute("alter table $table add kemasan varchar(255);");
						$adodb->Execute("alter table $table add perubahan varchar(255);");
					}
				}
			}
		}
	} else {
		foreach ($arr1 as $v1) {
		
			#if ($v1 == 'adendum') continue;

			$v11 = ucwords($v1);
			if ($v1=='ubah') $v11 = 'Perubahan';
			
			$menustr .= "..|".ucwords($v11)."||||\n";
			$menustr .= 
			"...|Kelengkapan|kelengkapan_".$v1."_".$va.".php?force_clean=1|||\n".
			"...|Pemohon|pendaftar_".$v1."_".$va.".php?force_clean=1|||\n".
			"...|Tanda Terima|tt_".$v1."_".$va.".php?force_clean=1|||\n".
			"...|Inbox||||\n".
			"....|Subdit|inbox_subdit_".$v1."_".$va.".php?force_clean=1|||\n".
			"....|Seksi|inbox_seksi_".$v1."_".$va.".php?force_clean=1|||\n".
			"...|Cek Kelengkapan|cek_".$v1."_".$va.".php?force_clean=1|||\n".
			"...|Surat||||\n".
			"....|Surat Keputusan|sk_".$v1."_".$va.".php?force_clean=1|||\n".
			"....|Surat Tambah Data|st_".$v1."_".$va.".php?force_clean=1|||\n".
			"....|Surat Penolakan|sp_".$v1."_".$va.".php?force_clean=1|||\n".
			"...|Laporan|laporan_".$v1."_".$va.".php?force_clean=1|||\n";

			create_php_sql($v1, $va, $v2, $v3);
			

			# LOGIN PENDAFTAR
			/*
			$arrvv = array ('pendaftar');
			foreach ($arrvv as $val) {
				$table = $val."_".$v1."_".$va;
				echo  "'$table',\n";
			}
			*/

			# ALTER CEK
			/*
			$arrvv = array ('cek');
			foreach ($arrvv as $val) {
				$table = $val."_".$v1."_".$va;
				$adodb->Execute("alter table $table add no_sk_lama varchar(255);");
				$adodb->Execute("alter table $table add date_sk_lama integer;");
				$adodb->Execute("alter table $table add lisensi text;");
				$adodb->Execute("alter table $table add lisensi2 text;");
				$adodb->Execute("alter table $table add nama_produk2 text;");
				$adodb->Execute("alter table $table add lisensi3 text;");
				$adodb->Execute("alter table $table add nama_produk3 text;");
				$adodb->Execute("alter table $table add lisensi4 text;");
				$adodb->Execute("alter table $table add nama_produk4 text;");
				$adodb->Execute("alter table $table add lisensi5 text;");
				$adodb->Execute("alter table $table add nama_produk5 text;");
				$adodb->Execute("alter table $table add jenis varchar(255);");
				$adodb->Execute("alter table $table add id_kategori integer;");
				$adodb->Execute("alter table $table add id_sub_kategori integer;");
				$adodb->Execute("alter table $table add ukuran varchar(255);");
				$adodb->Execute("alter table $table add kemasan varchar(255);");
				$adodb->Execute("alter table $table add perubahan varchar(255);");
			}
			*/
		}
	}
}

$menustr .= "".
".|General Setup||||
..|Propinsi|propinsi.php?force_clean=1|||
..|Subdit|subdit.php?force_clean=1|||
.|ADMINISTRATOR||||
..|Penilai|penilai.php?force_clean=1|||
..|Kasubdit|kasubdit.php?force_clean=1|||
..|Kaseksi|kaseksi.php?force_clean=1|||
..|Direktur|direktur.php?force_clean=1|||
..|Operator|operator.php?force_clean=1|||
..|Admin|admin.php?force_clean=1|||
..|Log Intern|log_intern.php?force_clean=1|||
..|Setting Menu|phplayersmenu.php?force_clean=1|||
.|Change Password|javascript:win=openIT('password.php?force_clean=1', 600, 400, null, null, 'changePassword');win.focus();|||
.|Logout|logout.php?force_clean=1|||
";

$parentId[1] = 1;
$currId = 1;
$pie = explode("\n", $menustr);
$adodb->Execute("DELETE FROM phplayersmenu");
$adodb->Execute("DELETE FROM phplayersmenu_cat");
$rs = $adodb->Execute("SELECT * FROM phplayersmenu LIMIT 1");
$rs2 = $adodb->Execute("SELECT * FROM phplayersmenu_cat LIMIT 1");
$arrCat = array ('operator', 'penilai', 'kaseksi', 'kasubdit', 'direktur', 'admin');
foreach ($pie as $k => $v) {
	$v = trim($v);
	if ($v) {
		$p2 = explode("|", $v);
		$parentId[strlen($p2[0])+1] = $currId*10;

		$record = array();
		$record['id'] = $currId*10;
		$record['parent_id'] = $parentId[strlen($p2[0])];
		$record['text'] = $p2[1];
		$record['href'] = $p2[2];
		$record['target'] = 'center';
		
		#echo $v."\n";
		if (!$adodb->Execute($adodb->GetInsertSQL($rs, $record))) 
			die($adodb->ErrorMsg());
		
		foreach ($arrCat as $key => $val) {
			$record['cat'] = $val;
			if 
			($val == 'operator'
			 && (empty($record['href']) 
			     || ($record['href'] 
			         && ereg('(pendaftar)|(tt)|(laporan)|(logout)|(password)', $record['href'])
			        )
			   )
			) {
				
				if (!eregi('(cek)|(inbox)|(surat)|(admin)|(setup)', $record['text'])) {
					if (!$adodb->Execute($adodb->GetInsertSQL($rs2, $record)))
						die($adodb->ErrorMsg());
				} 
			} 
			else if 
			($val == 'penilai'
			 && (empty($record['href']) 
			     || ($record['href'] 
			         && ereg('(cek)|(laporan)|(logout)|(password)', $record['href'])
			        )
			   )
			) {
				if (!eregi('(izin produksi)|(izin penyalur)|(pendaftar)|(tt)|(inbox)|(surat)|(admin)|(setup)', $record['text'])) {
					if (!$adodb->Execute($adodb->GetInsertSQL($rs2, $record)))
						die($adodb->ErrorMsg());
				} 
			} 
			else if 
			($val == 'kaseksi'
			 && (empty($record['href']) 
			     || ($record['href'] 
			         && ereg('(inbox_seksi)|(cek)|(sk_)|(st_)|(sp_)|(laporan)|(logout)|(password)',
				         $record['href'])
			        )
			   )
			) {
				if (!eregi('(pendaftar)|(tt)|(admin)|(setup)', $record['text'])) {
					if (!$adodb->Execute($adodb->GetInsertSQL($rs2, $record)))
						die($adodb->ErrorMsg());
				} 
			} 
			else if 
			($val == 'kasubdit'
			 && (empty($record['href']) 
			     || ($record['href'] 
			         && ereg('(kelas)|(kategori)|(kelengkapan)'.
				 '|(inbox_subdit)|(cek)|(sk_)|(st_)|(sp_)|(laporan)|(logout)|(password)',
				         $record['href'])
			        )
			   )
			) {
				if (!eregi('(pendaftar)|(tt)|(admin)|(setup)', $record['text'])) {
					if (!$adodb->Execute($adodb->GetInsertSQL($rs2, $record)))
						die($adodb->ErrorMsg());
				} 
			} 
			else if 
			($val == 'direktur'
			 && (empty($record['href']) 
			     || ($record['href'] 
			         && ereg('(kelas)|(kategori)|(kelengkapan)'.
				 '|(cek)|(sk_)|(st_)|(sp_)|(laporan)|(logout)|(password)',
				         $record['href'])
			        )
			   )
			) {
				if (!eregi('(pendaftar)|(tt)|(inbox)|(admin)|(setup)', $record['text'])) {
					if (!$adodb->Execute($adodb->GetInsertSQL($rs2, $record)))
						die($adodb->ErrorMsg());
				} 
			} else if ($val == 'admin') {
				if (!eregi('(inbox)', $record['text'])) {
					if (!$adodb->Execute($adodb->GetInsertSQL($rs2, $record)))
						die($adodb->ErrorMsg());
				} 
			}
		}
		
		
		
		$currId++;
	}
}

#echo $menustr;

?>

<?php

	require 'init.php';
	require 'auth.php';

/*
 * ADDED BY : 566
 * BELOW IS TO DEFINE PATH FOR SMARTY TEMPLATE ENGINE
 */
//$smarty_path   = '/var/www/html/depkes2/smarty/libs/Smarty.class.php';
//$template_path = '/var/www/html/depkes2/templates/';
//$compile_path  = '/var/www/html/depkes2/templates_c/';
$smarty_path   = 'D:/localhost/depkes2/smarty/libs/Smarty.class.php';
$template_path = 'D:/localhost/depkes2/templates';
$compile_path  = 'D:/localhost/depkes2/templates_c';

if (class_exists('sk_controller')) {
	// do nothing
} else if (defined('CLASS_sk_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_sk_CONTROLLER', TRUE);

include_once 'class.sk.inc.php';
class sk_controller extends depkes2_manager {
	var $sk_label;
	var $optional_arr;
	function sk_controller() {
		$this->sk_label = array (
			'id_sk' => 'Id Surat Keputusan',
			'no_sk' => 'Nomor Surat Keputusan',
			'id_cek_1' => 'Nama Pemohon',
			'nama' => 'Pengesah',
			'nip' => 'NIP pengesah',
			'izin_produksi' => 'Izin Produksi',
			'nama_pendaftar' => 'Nama Pemohon',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_sk' => TRUE,
			'sk' => FALSE,
			'keputusan' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	function id_cek_1_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['id_cek_1'];

		#include_once 'class.cek_1_alkes.inc.php';
		$fk_sql = ''.
		'SELECT
			cek.id_cek_1 as skey,
			tt.urut_no_tt as svalue,
			pendaftar.nama_pendaftar as svalue2
		FROM
			'.$GLOBALS[my_cek].' cek
			[sk]
			LEFT JOIN '.$GLOBALS[my_tt].' tt ON (tt.no_tt = cek.no_tt)
			LEFT JOIN '.$GLOBALS[my_pendaftar].' pendaftar ON (pendaftar.kode_pendaftar = tt.kode_pendaftar)
			LEFT JOIN '.$GLOBALS[my_sp].' sp ON (sp.id_cek_1 = cek.id_cek_1)
		WHERE
			[spsk]
			AND (cek.status_direktur = \'0\' OR cek.status_kasubdit = \'0\')
		ORDER BY
			cek.date_insert
			';
		if($_GET['action']=='edit'){
			$fk_sql = str_replace('[sk]', '', $fk_sql);
			$fk_sql = str_replace('[spsk]', 'sp.id_cek_1 IS NULL', $fk_sql);
		} else {
			$fk_sql = str_replace('[sk]', 'LEFT JOIN '.$GLOBALS[my_table].' sk ON (sk.id_cek_1 = cek.id_cek_1)', $fk_sql);
			$fk_sql = str_replace('[spsk]', '(sk.id_cek_1 IS NULL AND sp.id_cek_1 IS NULL)', $fk_sql);
		}

		#$result = cek_1_alkes::select($fk_sql);
		global $adodb; $rs = $adodb->Execute($fk_sql);
		$result = $rs->GetRows();
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('id_cek_1');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('No Tanda Terima - ').' '.$this->sk_label['id_cek_1']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['id_cek_1'] = 'user_defined';
		$value_arr['id_cek_1'] = $this->select_form('id_cek_1', $result, $selected);
		$optional_arr['id_cek_1_rule'] = "\n".
		"       if(theform.id_cek_1.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['id_cek_1']." ".__('empty').".');\n".
		"               theform.id_cek_1.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";


	}


	// create add sk form
	function add_sk_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		#$field_arr = sk::get_field_set();

                global $_SESSION, $_GET, $adodb, $ses;

		/*
		 * ADDED BY : 566
		 */
		$sql_nama_direktur_jenderal = "SELECT * FROM nama_direktur LIMIT 1";
		$rs_nama_direktur_jenderal  = $adodb->Execute($sql_nama_direktur_jenderal);
		$nama_direktur_jenderal     = $rs_nama_direktur_jenderal->fields['nama'];
		$nip_direktur_jenderal      = $rs_nama_direktur_jenderal->fields['nip'];

                $record = $_GET;
                $label_arr = $this->sk_label;
                $optional_arr = $this->optional_arr;


		include_once 'class.xform.inc.php';
		$field_arr[] = xform::xf('id_sk','C','255');
		$field_arr[] = xform::xf('no_sk','C','255');
		$field_arr[] = xform::xf('id_cek_1','C','255');
		$field_arr[] = xform::xf('nama','C','255');
		$field_arr[] = xform::xf('nip','C','255');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','C','255');
		$field_arr[] = xform::xf('izin_produksi','C','255');

                $rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_table]." sk WHERE id_sk='{$record['id_sk']}'");
                if ($rs && ! $rs->EOF) {
                        $value_arr = $rs->fields;
                        $optional_arr['id_sk'] = 'protect';
                        $mode = 'edit';
                } else {
                        $value_arr = array ();
                        $mode = 'add';
                }

		$optional_arr['nama'] = 'protect';
		$optional_arr['nip'] = 'protect';

		/*
		 * Modified By : 566
		 *
		 * BEFORE :
		 *   if (! $value_arr['nama']) $value_arr['nama'] = "DRS. H. TATO SUPRAPTO BASIR, APT.MM.";
		 *   if (! $value_arr['nip']) $value_arr['nip'] = "140 086 626";
		 *
		 * AFTER :
		 */
		$value_arr['nama'] = $nama_direktur_jenderal;
		$value_arr['nip'] = $nip_direktur_jenderal;

		list($suf1, $suf2, $suf3) = split(" ", strtolower($GLOBALS[my_title]));
		if ($suf2 == 'produksi') {
		} else {
			$optional_arr[izin_produksi] = TRUE;
		}
//		$value_arr = array ();
		$optional_arr['keputusan'] = 'user_defined';
		$value_arr['keputusan']= '<textarea rows="100" cols="75" name="keputusan" class="text"></textarea>';

		eval($this->save_config);
		$this->id_cek_1_form($config);
		$this->slip_field($config,'izin_produksi','after','no_sk');

                $label_arr['submit_val'] = "Submit";
                $label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
                $label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_sk']}'>";
                $label_arr['form_title'] = "Form ".ucwords($mode)." Surat Keputusan ".$GLOBALS[my_title]."";
                $label_arr['form_width'] = '100%';
                $label_arr['form_name'] = 'theform';

		if ($suf1 == 'adendum') {	
			$optional_arr[izin_produksi] = TRUE;
			$label_arr[no_sk] = 'Nomor Surat';
		}



		$_form = new form();
		$_form->set_config(
			array (
				'field_arr'	=> $field_arr,
				'label_arr'	=> $label_arr,
				'value_arr'	=> $value_arr,
				'optional_arr'	=> $optional_arr
			)
		);
		return $_form->parse_field();
	}

	// create update sk form
	function update_sk_form() {
		return $this->add_sk_form();
	}

	// handle event add sk
	function add_sk() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['post_vars']};

		global $adodb;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);

                // add record
                $rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_table]." WHERE id_sk='".intval($record['oldpkvalue'])."'");
                if ($rs && ! $rs->EOF) {
                        $adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
                        $st = "Updated";
                } else {
                        $record['insert_by'] = $ses->loginid;
                        $record['date_insert'] = time();
                        $adodb->Execute($adodb->GetInsertSQL($rs, $record));
                        $st = "Added";
                }

                $status = "Successfull $st SK ".$GLOBALS[my_title]." '<b>{$record['no_sk']}</b>'";
                $this->log($status);

                $_block = new block();
                $_block->set_config('title', 'Status');
                $_block->set_config('width', "90%");
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle event update sk
	function update_sk() {
		return $this->add_sk();
	}

	// handle delete sk
	function delete_sk() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['get_vars']}, ${$GLOBALS['post_vars']};

		global $adodb;
		$query = "";
		$query3 = "";
		for ($i=0;$i<count(${$GLOBALS['post_vars']}['pk_str']);$i++) {
			if ($query) $query .= " OR ";
			if ($query3) $query3 .= " OR ";

			$var_pie = explode("&", ${$GLOBALS['post_vars']}['pk_str'][$i]);
			$query2 = "";
			$query4 = "";
			foreach ($var_pie as $key => $value) {
				list($myvar, $myval) = explode("=", $value);
				if ($query2) $query2 .= " AND ";
				$query2 .= "$myvar='".urldecode($myval)."'";
				if ($myvar=='fill_this') {
					if ($query4) $query4 .= " AND ";
					$query4 .= "$myvar='$myval'";
				}
			}
			if ($query2) $query .= "($query2)";
			if ($query4) $query3 .= "($query4)";
		}


		if ($query)
			$success = $adodb->Execute("delete from ".$GLOBALS[my_table]." where ".$query);


                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'SK '.$GLOBALS[my_title].' <font color=red>'.$msg.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'SK '.$GLOBALS[my_title].' <font color=red>'.$msg.'</font>';
                }
                $this->log($status);

                $_block = new block();
                $_block->set_config('title', ('Delete SK '.$GLOBALS[my_title].' Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	function view_sk_form() {
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;

		/*
		 * ADDED BY : 566
		 */
		global $smarty_path, $template_path, $compile_path, $my_kat, $suf1, $suf2, $suf3, $suf4;

		$optional_arr = $this->optional_arr;
		$optional_arr['id_sk'] = 'protect';

		$record = array (
			'id_sk' => ${$GLOBALS['get_vars']}['id_sk']
		);

		$value_arr = $result[0];
		$label_arr = $this->sk_label;

		// SK
		$sqlA = "SELECT no_sk, id_cek_1 FROM ".$GLOBALS[my_table]." sk WHERE id_sk ='".$_GET['id_sk']."'";
		//print $sqlA;
		$hasil=$adodb->Execute($sqlA);
		WHILE(! $hasil->EOF){
			$no_sk = $hasil->fields['no_sk'];
			$id_cek_1 = $hasil->fields['id_cek_1'];
			$hasil->MoveNext();
		}

		/*
		 * ADDED BY : 566
		 *
		 * Build a query to get category based on $my_kat
		 */
		$sql_ = "SELECT id_kategori AS value_, nama_kategori AS caption_ FROM $my_kat ORDER BY nama_kategori ASC";
		$rs = $adodb->Execute($sql_);
		while(! $rs->EOF){
			$vv                 = $rs->fields['value_'];
			$r_['caption'][$vv] = $rs->fields['caption_'];
			$rs->MoveNext();
		}

		setlocale(LC_TIME, 'id_ID', 'id');

		$sqlB="
		select
		sk.id_sk,
		sk.no_sk,
		sk.nama,
		sk.izin_produksi,
		sk.nip,
		pendaftar.nama_pendaftar,
		pendaftar.nama_pabrik,
		pendaftar.npwp,
		pendaftar.alamat_pendaftar,
		pendaftar.alamat_pendaftar_2,
		pendaftar.namapenanggungjwb,
		pendaftar.alamatgudang,
		pendaftar.alamat_bengkel,
		pendaftar.alamat_pabrik,
		pendaftar.nama_propinsi_1,
		pendaftar.nama_propinsi_2,
		pendaftar.nama_direktur,
		kelas.golongan,
		tt.jenis_izin_produksi,
		tt.urut_no_tt,
		tt.kode_subdit,
		tt.date_insert,
		cek.no_rekomendasi,
		cek.date_rekomendasi,
		cek.nama_produk,
		cek.no_pemohon,
		cek.date_pemohon,
		cek.no_bap,
		cek.date_bap,
		cek.no_sk_lama,
		cek.date_sk_lama,
		cek.lisensi,
		cek.lisensi2,
		cek.nama_produk2,
		cek.lisensi3,
		cek.nama_produk3,
		cek.lisensi4,
		cek.nama_produk4,
		cek.lisensi5,
		cek.nama_produk5,
		cek.jenis,
		cek.id_kategori,
		cek.id_sub_kategori,
		cek.ukuran,
		cek.kemasan,
		cek.perubahan ";

		/*
		 * ADDED BY : 566
		 */
		if ($suf2!="penyalur") {
		$sqlB .=
		",__kategori_produk1,
		__nama_produk1,
		__kategori_produk2,
		__nama_produk2,
		__kategori_produk3,
		__nama_produk3,
		__kategori_produk4,
		__nama_produk4,
		__kategori_produk5,
		__nama_produk5,
		__kategori_produk6,
		__nama_produk6,
		__kategori_produk7,
		__nama_produk7,
		__kategori_produk8,
		__nama_produk8,
		__kategori_produk9,
		__nama_produk9,
		__kategori_produk10,
		__nama_produk10,
		__kategori_produk11,
		__nama_produk11,
		__kategori_produk12,
		__nama_produk12,
		__kategori_produk13,
		__nama_produk13,
		__kategori_produk14,
		__nama_produk14,
		__kategori_produk15,
		__nama_produk15,
		__kategori_produk16,
		__nama_produk16,
		__kategori_produk17,
		__nama_produk17 ";
		}

		$sqlB .= "FROM
		".$GLOBALS[my_table]." sk
		LEFT OUTER JOIN ".$GLOBALS[my_cek]." cek ON (cek.id_cek_1 = sk.id_cek_1)
		LEFT OUTER JOIN ".$GLOBALS[my_tt]." tt ON (tt.no_tt = cek.no_tt)
		LEFT OUTER JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON (pendaftar.kode_pendaftar = tt.kode_pendaftar)
		LEFT OUTER JOIN ".$GLOBALS[my_kelas]." kelas ON (kelas.id_golongan = cek.id_golongan)
		WHERE
		sk.id_cek_1 = '".$id_cek_1."'
		";

		$rsb = $adodb->Execute($sqlB);
		$golongan = $rsb->fields['golongan'];
		$nama_produk = $rsb->fields['nama_produk'];
		$no_sk = $rsb->fields['no_sk'];
		$jenis_izin_produksi = $rsb->fields['jenis_izin_produksi'];
		$izin_produksi = $rsb->fields['izin_produksi'];
		$nama_perusahaan = $rsb->fields['nama_pabrik'];
		$izin_produksi = $rsb->fields['izin_produksi'];
		$nama_propinsi_1 = $rsb->fields['nama_propinsi_1'];
		$alamat_pendaftar = $rsb->fields['alamat_pendaftar'];
		$alamat_pendaftar_2 = $rsb->fields['alamat_pendaftar_2'];
		$urut_no_tt = $rsb->fields['urut_no_tt'];
		$nama_penanggung = $rsb->fields['namapenanggungjwb'];
		$alamat_gudang = $rsb->fields['alamatgudang'];
		$alamat_bengkel = $rsb->fields['alamat_bengkel'];
		$nama_direktur = $rsb->fields['nama_direktur'];
		$date_insert = strftime("%d %B %G",strtotime(date('d F Y',$rsb->fields['date_insert'])));//date('d F Y',$rsb->fields['date_insert']);
		$no_rekomendasi = $rsb->fields['no_rekomendasi'];
		$no_pemohon = $rsb->fields['no_pemohon'];
		if ($rsb->fields[date_pemohon]) $date_pemohon = strftime("%d %B %G",strtotime(date('d F Y',$rsb->fields['date_pemohon'])));//date('d F Y',$rsb->fields['date_pemohon']);
		$alamat_pabrik = $rsb->fields['alamat_pabrik'];
		$nama_propinsi_2 = $rsb->fields['nama_propinsi_2'];
		$date_rekomendasi = strftime("%d %B %G",strtotime(date('d F Y',$rsb->fields['date_rekomendasi'])));//date('d F Y',$rsb->fields['date_rekomendasi']);
		$no_bap = $rsb->fields['no_bap'];
		$npwp = $rsb->fields['npwp'];
		$date_bap = strftime("%d %B %G",strtotime(date('d F Y',$rsb->fields['date_bap'])));// date('d F Y',$rsb->fields['date_bap']);
		$kode_subdit = $rsb->fields['kode_subdit'];
		$nama = $rsb->fields['nama'];
		$nip = $rsb->fields['nip'];
		$no_sk_lama = $rsb->fields[no_sk_lama];
		$date_sk_lama = strftime("%d %B %G",strtotime(date('d F Y',$rsb->fields[date_sk_lama])));// date('d F Y', $rsb->fields[date_sk_lama]);
		$lisensi = $rsb->fields[lisensi];
		$nama_produk = $rsb->fields[nama_produk];
		$lisensi2 = $rsb->fields[lisensi2];
		$nama_produk2 = $rsb->fields[nama_produk2];
		$lisensi3 = $rsb->fields[lisensi3];
		$nama_produk3 = $rsb->fields[nama_produk3];
		$lisensi4 = $rsb->fields[lisensi4];
		$nama_produk4 = $rsb->fields[nama_produk4];
		$lisensi5 = $rsb->fields[lisensi5];
		$nama_produk5 = $rsb->fields[nama_produk5];

		$jenis = $rsb->fields[jenis];
		$id_kategori = $rsb->fields[id_kategori];
		$id_sub_kategori = $rsb->fields[id_sub_kategori];
		$ukuran = $rsb->fields[ukuran];
		$kemasan = $rsb->fields[kemasan];
		$nama_pendaftar = $rsb->fields[nama_pendaftar];
		$nama_pabrik = $rsb->fields[nama_pabrik];

		$perubahan = $rsb->fields[perubahan];

		/*
		 * BEGIN : Get All Licenses
		 */
	if ($suf2=="penyalur") {
		$full_license__ = explode("+++",$lisensi);
		$default_license_to_show = count($full_license__);
		$maximum_category_to_show = 10;

		/*
		 * Set a blank pattern of license for initialization
		 */
		for ($i=1;$i<=$maximum_license_to_show;$i++) {
			$license_pattern['license_'.$i] = "";
			$default_show_category__[$i]    = 0;
			for ($j=1;$j<=$maximum_category_to_show;$j++) {
				$license_pattern['license_'.$i.'_category_'.$j] = 0;
				$license_pattern['license_'.$i.'_product_'.$j]  = "";
			}
		}

		/*
		 * Try to explode and then mapping the pattern of license
		 */
		for ($i=0;$i<$default_license_to_show;$i++) {
			$xplode = explode("==>",$full_license__[$i]);
			$license_pattern['license_'.($i+1)] = $xplode[0];

			$xplode_category_n_product = explode("***",$xplode[1]);
			$default_show_category__[$i+1] = count($xplode_category_n_product);
			foreach ($xplode_category_n_product as $index => $category_n_product) {
				$category_n_product__ = explode("===",$category_n_product);
				$license_pattern['license_'.($i+1).'_category_'.($index+1)] = $category_n_product__[0];

				$xplode_product = explode(",,,",$category_n_product__[1]);
				$break_line     = "~~~";
				$temp_product__ = "";
				foreach ($xplode_product as $product___) {
					$temp_product__ .= ($temp_product__=="") ? $product___ : $break_line.$product___ ;
				}
				$license_pattern['license_'.($i+1).'_product_'.($index+1)] = $temp_product__;
			}
		}

		/*
		 * Build a query to get category based on $my_kat
		 */
		$sql_cat_ = "SELECT id_kategori AS value_, nama_kategori AS caption_ FROM $my_kat ORDER BY nama_kategori ASC";

		$rs_cat_ = $adodb->Execute($sql_cat_);

		while(! $rs_cat_->EOF){
			$r_cat_['value'][]   = $rs_cat_->fields['value_'];
			$r_cat_['caption'][] = $rs_cat_->fields['caption_'];
			$rs_cat_->MoveNext();
		}

		$show_license = "";
		for ($i=1;$i<=$default_license_to_show;$i++) {
			if ($license_pattern['license_'.$i]!="") {
				$show_license .= "<b>".$license_pattern['license_'.$i]."</b>";
				$show_license .= "<ul type=square>";

				for ($j=1;$j<=$maximum_category_to_show;$j++) {
					if ($license_pattern['license_'.$i.'_category_'.$j]!="") {
						$caption_index__ = $license_pattern['license_'.$i.'_category_'.$j];
						$caption__       = $r_cat_['caption'][$caption_index__];
						$show_license .= "<li>".$caption__."</li>";

						$show_license .= "<ol>";
						$product_explode = explode("~~~",$license_pattern['license_'.$i.'_product_'.$j]);
						foreach ($product_explode as $product_) {
							$show_license .= "<li>".$product_."</li>";
						}
						$show_license .= "</ol>";
					}
				}
				$show_license .= "</ul>";
			}
		}
	}
		/*
		 * END : Get All Licenses
		 */

		/*
		 * ADDED BY : 566
		 */
		$__kategori_produk1  = $rsb->fields['__kategori_produk1'];
		$__kategori_produk2  = $rsb->fields['__kategori_produk2'];
		$__kategori_produk3  = $rsb->fields['__kategori_produk3'];
		$__kategori_produk4  = $rsb->fields['__kategori_produk4'];
		$__kategori_produk5  = $rsb->fields['__kategori_produk5'];
		$__kategori_produk6  = $rsb->fields['__kategori_produk6'];
		$__kategori_produk7  = $rsb->fields['__kategori_produk7'];
		$__kategori_produk8  = $rsb->fields['__kategori_produk8'];
		$__kategori_produk9  = $rsb->fields['__kategori_produk9'];
		$__kategori_produk10 = $rsb->fields['__kategori_produk10'];
		$__kategori_produk11 = $rsb->fields['__kategori_produk11'];
		$__kategori_produk12 = $rsb->fields['__kategori_produk12'];
		$__kategori_produk13 = $rsb->fields['__kategori_produk13'];
		$__kategori_produk14 = $rsb->fields['__kategori_produk14'];
		$__kategori_produk15 = $rsb->fields['__kategori_produk15'];
		$__kategori_produk16 = $rsb->fields['__kategori_produk16'];
		$__kategori_produk17 = $rsb->fields['__kategori_produk17'];

		/*
		 * ADDED BY : 566
		 */
		$__nama_produk1  = $rsb->fields['__nama_produk1'];
		$__nama_produk2  = $rsb->fields['__nama_produk2'];
		$__nama_produk3  = $rsb->fields['__nama_produk3'];
		$__nama_produk4  = $rsb->fields['__nama_produk4'];
		$__nama_produk5  = $rsb->fields['__nama_produk5'];
		$__nama_produk6  = $rsb->fields['__nama_produk6'];
		$__nama_produk7  = $rsb->fields['__nama_produk7'];
		$__nama_produk8  = $rsb->fields['__nama_produk8'];
		$__nama_produk9  = $rsb->fields['__nama_produk9'];
		$__nama_produk10 = $rsb->fields['__nama_produk10'];
		$__nama_produk11 = $rsb->fields['__nama_produk11'];
		$__nama_produk12 = $rsb->fields['__nama_produk12'];
		$__nama_produk13 = $rsb->fields['__nama_produk13'];
		$__nama_produk14 = $rsb->fields['__nama_produk14'];
		$__nama_produk15 = $rsb->fields['__nama_produk15'];
		$__nama_produk16 = $rsb->fields['__nama_produk16'];
		$__nama_produk17 = $rsb->fields['__nama_produk17'];

		/*
		 * ADDED BY : 566
		 */
		$sql_nama_direktur_jenderal = "SELECT * FROM nama_direktur LIMIT 1";
		$rs_nama_direktur_jenderal  = $adodb->Execute($sql_nama_direktur_jenderal);
		$nama_direktur_jenderal     = $rs_nama_direktur_jenderal->fields['nama'];
		$nip_direktur_jenderal      = $rs_nama_direktur_jenderal->fields['nip'];

		/*
		 * ADDED BY : 566
		 */
		$nama_kategori = "";
		if ($suf2=="edar") {
		  $sql_kategori = "SELECT nama_kategori FROM kategori_".$suf2."_".$suf3." WHERE id_kategori=$id_kategori";
		  $rs_kategori  = $adodb->Execute($sql_kategori);
		  $nama_kategori     = $rs_kategori->fields['nama_kategori'];
		}

		/*
		 * ADDED BY : 566
		 */
		$nama_sub_kategori = "";
		if ($suf2=="edar") {
		  $sql_sub_kategori = "SELECT nama_subkategori FROM ".$GLOBALS[my_subkat]." WHERE id_subkategori=$id_sub_kategori";
		  $rs_sub_kategori  = $adodb->Execute($sql_sub_kategori);
		  $nama_sub_kategori     = $rs_sub_kategori->fields['nama_subkategori'];
		}

		/*
		 * Begin of Modification by : 566
		 *
		 * Build Date          : Fri, Aug 04, 2006
		 * Script written by   : Sugeng Utomo
		 *
		 *`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*/

		/*
		 * Require Smarty Class
		 */
		require_once $smarty_path;

		/*
		 * Create an instance of Smarty Class
		 */
		$smarty = new Smarty;

		/*
		 * Define some configurations for new instance of Smarty Class
		 */
		$smarty->compile_check = true;
		$smarty->debugging = false;
		$smarty->template_dir = $template_path;
		$smarty->compile_dir  = $compile_path;

		/*
		 * Start Output Buffer
		 */
		ob_start();

		/*
		 * Define current date
		 */
		$tg = date('d F Y');

		/*
		 * Assign some Smarty variables
		 */
		$smarty->assign('no_sk',$no_sk);

		/*
		 * Assign some Smarty variables
		 */
		$smarty->assign('alamat_bengkel',$alamat_bengkel);
		$smarty->assign('alamat_gudang',$alamat_gudang);
		$smarty->assign('alamat_pabrik',$alamat_pabrik);
		$smarty->assign('alamat_pendaftar',$alamat_pendaftar);
		$smarty->assign('date_bap',$date_bap);
		$smarty->assign('date_pemohon',$date_pemohon);
		$smarty->assign('date_rekomendasi',$date_rekomendasi);
		$smarty->assign('golongan',$golongan);
		$smarty->assign('jenis_produk',$jenis);
		$smarty->assign('kategori',$nama_kategori);
		$smarty->assign('kemasan',$kemasan);
		$smarty->assign('kota_pendaftar',$alamat_pendaftar_2);

	if ($suf2=="penyalur") {
		$smarty->assign('lisensi',$show_license);
	}

		$smarty->assign('lisensi1',$lisensi);
		$smarty->assign('lisensi2',$lisensi2);
		$smarty->assign('lisensi3',$lisensi3);
		$smarty->assign('lisensi4',$lisensi4);
		$smarty->assign('lisensi5',$lisensi5);
		$smarty->assign('nama_direktur',$nama_direktur);
		$smarty->assign('nama_direktur_jenderal',$nama_direktur_jenderal);
		$smarty->assign('nama_pabrik',$nama_pabrik);
		$smarty->assign('nama_penanggung',$nama_penanggung);
		$smarty->assign('nama_pendaftar',$nama_pendaftar);
		$smarty->assign('nama_produk',$nama_produk);
		$smarty->assign('nama_produk1',$nama_produk);
		$smarty->assign('nama_produk2',$nama_produk2);
		$smarty->assign('nama_produk3',$nama_produk3);
		$smarty->assign('nama_produk4',$nama_produk4);
		$smarty->assign('nama_produk5',$nama_produk5);
		$smarty->assign('nama_propinsi_1',$nama_propinsi_1);
		$smarty->assign('nip_direktur_jenderal',$nip_direktur_jenderal);
		$smarty->assign('no_bap',$no_bap);
		$smarty->assign('no_pemohon',$no_pemohon);
		$smarty->assign('no_rekomendasi',$no_rekomendasi);
		$smarty->assign('no_sk',$no_sk);
		$smarty->assign('npwp',$npwp);
		$smarty->assign('sub_kategori',$nama_sub_kategori);
		$smarty->assign('tg',$tg);
		$smarty->assign('ukuran',$ukuran);

		/*
		 * Detail Kategori dan Nama Produk
		 */
	if ($suf2=="penyalur") {
		$smarty->assign('nama_produk',$show_license);
	} elseif ($suf2=="edar") {
		$smarty->assign('nama_produk',$nama_produk);
	} else {
		$__detail__ = "";
		for ($i=1;$i<=17;$i++) {
			$vv_kategori_produk = "__kategori_produk".$i;
			$vv_nama_produk     = "__nama_produk".$i;

			if ($$vv_nama_produk!="") {
				$__detail__ .= "<b>".$r_['caption'][$$vv_kategori_produk]."</b><br />";

				$__nama_produk_arr = explode("\n",$$vv_nama_produk);
				$number = 0;
				foreach ($__nama_produk_arr as $__nama_produk_) {
					$number++;
					$__detail__ .= " &nbsp; &nbsp; &nbsp;".$number.". ".$__nama_produk_."<br>";
				}
				$__detail__ .= "<br>";
			}
		}
		$smarty->assign('nama_produk',$__detail__);
	}
		/*
		 * Display template results
		 */
		switch ($suf1) {
		  case "registrasi" : switch($suf2) {
					case "produksi" : if ($jenis_izin_produksi=="0") {
							    $smarty->display('surat_keputusan_registrasi_izin_produksi_alkes.tpl');
							  } else {
							    $smarty->display('surat_keputusan_registrasi_izin_produksi_pkrt.tpl');
							  }
							  break;

					case "penyalur" : $smarty->display('surat_keputusan_registrasi_izin_penyalur.tpl');
							  break;

					case "edar" : switch ($suf3) {
							case "pkrt" : switch ($suf4) {
									case "import" : $smarty->display('surat_keputusan_registrasi_izin_edar_pkrt_import.tpl');
											break;
									case "lokal"  : $smarty->display('surat_keputusan_registrasi_izin_edar_pkrt_lokal.tpl');
											break;
								      }
								      break;

							case "alkes" : switch ($suf4) {
									case "import" : $smarty->display('surat_keputusan_registrasi_izin_edar_alkes_import.tpl');
											break;
									case "lokal"  : $smarty->display('surat_keputusan_registrasi_izin_edar_alkes_lokal.tpl');
											break;
								      }
								      break;
						      }
						      break;
				      } // end : switch($suf2)
				      break;

		  case "ubah" : switch($suf2) {
				  case "produksi" : $smarty->display('surat_keputusan_perubahan_izin_produksi_pkrt.tpl');
						    break;

				  case "edar" : switch ($suf3) {
						  case "pkrt" : switch ($suf4) {
								  case "import" : $smarty->display('surat_keputusan_perubahan_izin_edar_pkrt_import.tpl');
										  break;
								  case "lokal"  : $smarty->display('surat_keputusan_perubahan_izin_edar_pkrt_lokal.tpl');
										  break;
										}
								break;
						}
						break;
				} // end : switch($suf2)
				break;

		  case "pemutihan" : switch($suf2) {
				      case "produksi" : if ($jenis_izin_produksi=="0") {
							    $smarty->display('surat_keputusan_pemutihan_izin_produksi_alkes.tpl');
							  } else {
							    $smarty->display('surat_keputusan_pemutihan_izin_produksi_pkrt.tpl');
							  }
							break;

					case "penyalur" : $smarty->display('surat_keputusan_pemutihan_izin_penyalur.tpl');
							  break;
				     } // end : switch($suf2)
				     break;

		} // end : switch ($suf1)

		/*
		 * Define a temp folder
		 */
		$tmpfname = tempnam("/tmp", "FOO");

		/*
		 * Open a temp file with writeable mode
		 */
		$handle = fopen($tmpfname, "w");

		/*
		 * Write a temp file with Output Buffer Content
		 */
		fwrite($handle, ob_get_contents());

		/*
		 * End Output Buffer
		 */
		ob_end_clean();

		/*
		 * Close a temp file
		 */
		fclose($handle);
		putenv("HTMLDOC_NOCGI=1");
		/*
		 * Define a header with Content-Type: application/pdf
		 */
		header('Content-Type: application/pdf');
		flush();
		/*
		 * Execute an external program and then display raw output
		 */
		passthru('htmldoc -t pdf --webpage '.$tmpfname);

		/*
		 * Delete a temp file
		 */
		unlink($tmpfname);
		exit();

		/*
		 * End of Modification by : 566
		 */
	} // end : function view_sk_form()

	// handle list sk
	function list_sk($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};

		/*
		 * ADDED BY : 566
		 */
		$sql_nama_direktur_jenderal = "SELECT * FROM nama_direktur LIMIT 1";
		$rs_nama_direktur_jenderal  = $adodb->Execute($sql_nama_direktur_jenderal);
		$nama_direktur_jenderal     = $rs_nama_direktur_jenderal->fields['nama'];

		$sql = 'SELECT
		sk.id_sk,
		sk.no_sk,
		[produksi]
		pendaftar.nama_pendaftar,
		sk.nip,'.
/*
 * Modified By : 566
 *
 * BEFORE : 
 * sk.nama
 *
 * AFTER :
 */
		"'$nama_direktur_jenderal' AS nama ".

		'FROM	
		'.$GLOBALS[my_table].' sk
		LEFT JOIN '.$GLOBALS[my_cek].' cek ON (cek.id_cek_1 = sk.id_cek_1)
		LEFT JOIN '.$GLOBALS[my_tt].' tt ON (tt.no_tt = cek.no_tt)
		LEFT JOIN '.$GLOBALS[my_pendaftar].' pendaftar ON (pendaftar.kode_pendaftar = tt.kode_pendaftar)
		ORDER BY sk.no_sk DESC
		';

		list($suf1, $suf2, $suf3) = split(" ", strtolower($GLOBALS[my_title]));	
		if ($suf2 != 'produksi') {
			$optional_arr[izin_produksi] = TRUE;
		}
		if ($sufb == 'produksi') {
			$sql = str_replace('[produksi]', 'sk.izin_produksi,', $sql);
		} else {
			$sql = str_replace('[produksi]', '', $sql);
		}
	
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_sk' => TRUE,
			'sk' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'id_sk' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 600, 400, null, null, \'add_sk\');'.
			'win.focus()',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//			if ($this->get_permission('fill_this')) {	'no_rekomendasi' => $_POST['no_rekomendasi'],

//				$add_anchor .= pager::pager_button(array("link"=>'javascript:openIT(\'' . $GLOBALS['PHP_SELF'] .
//				'?action=import' .
//			}
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_sk\');'.
			'win.focus()',
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' . 
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_sk\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
			$view_anchor = pager::pager_button(array("link"=>'javascript:'.
			'location.href=\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\';'.
			'',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"button"));
//		}

		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_sk\');'.
			'win.focus()',
			"label"=>__('Print'),
			"type"=>"button",
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->sk_label;
		$config = array (
			'id'		=> 'sk',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $add_anchor,
			'edit_anchor'	=> "<nobr>".$edit_anchor." ".$view_anchor."</nobr>",
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Surat Keputusan '.$GLOBALS[my_title].' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);

		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print sk
	function print_sk() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_sk($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$sk_controller = new sk_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $sk_controller->add_sk_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $sk_controller->add_sk();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $sk_controller->update_sk_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $sk_controller->update_sk();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $sk_controller->view_sk_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $sk_controller->delete_sk();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $sk_controller->import_sk_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $sk_controller->import_sk();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $sk_controller->print_sk();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $sk_controller->list_sk();
			include 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Surat Keputusan '.$GLOBALS[my_title].' Administration';
	include 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>


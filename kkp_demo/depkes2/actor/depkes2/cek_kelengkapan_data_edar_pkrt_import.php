<?php




	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('cek_kelengkapan_data_edar_import_pkrt_controller')) {
	// do nothing
} else if (defined('CLASS_cek_kelengkapan_data_edar_import_pkrt_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_cek_kelengkapan_data_edar_import_pkrt_CONTROLLER', TRUE);

include_once 'class.cek_kelengkapan_data_edar_import_pkrt.inc.php';
class cek_kelengkapan_data_edar_import_pkrt_controller extends depkes2_manager {
	var $cek_kelengkapan_data_edar_import_pkrt_label;
	var $optional_arr;
	function cek_kelengkapan_data_edar_import_pkrt_controller() {
		$this->cek_kelengkapan_data_edar_import_pkrt_label = array (
			'id_cek_1' => 'Id Check pkrt',
			'id_golongan' => 'Kelas',
			'no_daftar' => 'No Daftar',
			'id_kategori_edar' => 'Kategori',
			'id_sub_kategori_edar' => 'Sub Kategori',
			'no_tt' => 'Nama Pabrik ',
			'read_kaseksi' => 'Read Kaseksi',
			'read_penilai' => 'Read Penilai',
			'read_kasubdit' => 'Read Kasubdit',
			'read_direktur' => 'Read Direktur',
			'indi_kasubdit' => 'Indikator Kasubdit',
			'indi_kaseksi' => 'Indikator Kaseksi',
			'indi_penilai' => 'Indikator Penilai',
			'indi_direktur' => 'Indikator Direktur',
			'kemasan' => 'Kemasan',
			'nama_produk' => ' Nama Alat Kesehatan',
			'nama_pabrik' => 'Nama Pabrik',
			'ukuran' => 'Type / Ukuran',
			'alamat' => 'Alamat Pabrik',
			'lisensi' => 'Licensi',
			'status_penilai' => 'Status Penilaian',
			'nama_penilai' => 'Nama Penilai',
			'urut_no_tt' => 'Nomor Tanda Terima',
			'subdit' => 'Subdit',
			'golongan' => 'Kelas',
			'date_1' => 'Tanggal Penilai',
			'status_kaseksi' => 'Status Kaseksi',
			'nama_kaseksi' => 'Nama Kaseksi',
			'date_2' => 'Tanggal Kaseksi',
			'status_kasubdit' => 'Status Kasubdit',
			'nama_kasubdit' => 'Nama Kasubdit',
			'date_3' => 'Tanggal Kasubdit',
			'no_pemohon' => 'Licensi',
			'date_pemohon' => 'Tanggal Pemohon',
			'status_direktur' =>'Status Direktur',
			'nama_direktur' => 'Nama Direktur',
			'date_4' => 'Tanggal Direktur',
			'keterangan' => 'Keterangan',
			'nama' => ' Nama ( Sesuai CFR )',
			'jenis' => ' Nomor Jenis ( Sesuai CFR )',
			'id_golongan' => 'Kelas',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_cek_1' => TRUE,
			'id_golongan' => FALSE,
			'no_daftar' => FALSE,
			'kemasan' => FALSE,
			'nama_produk' => FALSE,
			'nama_pabrik' => FALSE,
			'alamat' => FALSE,
			'lisensi' => FALSE,
			'status_penilai' => FALSE,
			'nama_penilai' => FALSE,
			'date_1' => FALSE,
			'status_kaseksi' => FALSE,
			'nama_kaseksi' => FALSE,
			'date_2' => FALSE,
			'status_kasubdit' => FALSE,
			'nama_kasubdit' => FALSE,
			'date_3' => FALSE,
			'status_direktur' => FALSE,
			'nama_direktur' => FALSE,
			'date_4' => FALSE,
			'keterangan' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE
		);
	}

	function no_tt_form(&$config) {
		global $ses;
		$userlog = $ses->loginid;
                eval($this->load_config);
                $selected = $value_arr['no_tt'];
    
		$bag = $ses->action;

		include_once 'class.pendaftar_edar_pkrt_import_pkrt.inc.php';
		if($_GET['id_cek_1']){
			if($bag=='kaseksi'){
				$fk_sql =
				"SELECT
					tt_1_edar_pkrt_import.no_tt as skey,
					tt_1_edar_pkrt_import.urut_no_tt as svalue,
					pendaftar_edar_pkrt_import_pkrt.nama_pabrik as svalue2
				FROM
				tt_1_edar_pkrt_import
				LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
				LEFT OUTER JOIN cek_kelengkapan_data_edar_import_pkrt ON(cek_kelengkapan_data_edar_import_pkrt.no_tt=tt_1_edar_pkrt_import.no_tt)
				LEFT OUTER JOIN pendaftar_edar_pkrt_import_pkrt ON(pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt = tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt )
				LEFT OUTER JOIN inbox_izin_pkrt_import_pkrt_subdit ON(inbox_izin_pkrt_import_pkrt_subdit.no_tt = tt_1_edar_pkrt_import.no_tt )
				LEFT OUTER JOIN inbox_izin_pkrt_import_pkrt_seksi ON(inbox_izin_pkrt_import_pkrt_seksi.id_inbox_izin_pkrt_import_pkrt_subdit = inbox_izin_pkrt_import_pkrt_subdit.id_inbox_izin_pkrt_import_pkrt_subdit)
				WHERE inbox_izin_pkrt_import_pkrt_seksi.insert_by='$userlog'
				ORDER BY
				tt_1_edar_pkrt_import.date_insert

				";
			}else{
				$fk_sql =
				"SELECT
					tt_1_edar_pkrt_import.no_tt as skey,
					tt_1_edar_pkrt_import.urut_no_tt as svalue,
					pendaftar_edar_pkrt_import_pkrt.nama_pabrik as svalue2
				FROM
				tt_1_edar_pkrt_import
				LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
				LEFT OUTER JOIN cek_kelengkapan_data_edar_import_pkrt ON(cek_kelengkapan_data_edar_import_pkrt.no_tt=tt_1_edar_pkrt_import.no_tt)
				LEFT OUTER JOIN pendaftar_edar_pkrt_import_pkrt ON(pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt = tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt )
				LEFT OUTER JOIN inbox_izin_pkrt_import_pkrt_subdit ON(inbox_izin_pkrt_import_pkrt_subdit.no_tt = tt_1_edar_pkrt_import.no_tt )
				RIGHT OUTER JOIN inbox_izin_pkrt_import_pkrt_seksi ON(inbox_izin_pkrt_import_pkrt_seksi.id_inbox_izin_pkrt_import_pkrt_subdit = inbox_izin_pkrt_import_pkrt_subdit.id_inbox_izin_pkrt_import_pkrt_subdit)
				ORDER BY
				tt_1_edar_pkrt_import.date_insert
				";
			}
		}else{
			$fk_sql =
			"SELECT
				tt_1_edar_pkrt_import.no_tt as skey,
				tt_1_edar_pkrt_import.urut_no_tt as svalue,
				pendaftar_edar_pkrt_import_pkrt.nama_pabrik as svalue2
			FROM
			tt_1_edar_pkrt_import
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
			LEFT OUTER JOIN cek_kelengkapan_data_edar_import_pkrt ON(cek_kelengkapan_data_edar_import_pkrt.no_tt=tt_1_edar_pkrt_import.no_tt)
			LEFT OUTER JOIN pendaftar_edar_pkrt_import_pkrt ON(pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt = tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt )
			LEFT OUTER JOIN inbox_izin_pkrt_import_pkrt_subdit ON(inbox_izin_pkrt_import_pkrt_subdit.no_tt = tt_1_edar_pkrt_import.no_tt )
			RIGHT OUTER JOIN inbox_izin_pkrt_import_pkrt_seksi ON(inbox_izin_pkrt_import_pkrt_seksi.id_inbox_izin_pkrt_import_pkrt_subdit = inbox_izin_pkrt_import_pkrt_subdit.id_inbox_izin_pkrt_import_pkrt_subdit)
			WHERE ((tt_1_edar_pkrt_import.no_tt IS NULL) OR (inbox_izin_pkrt_import_pkrt_seksi.insert_by='$userlog')) AND cek_kelengkapan_data_edar_import_pkrt.no_tt IS NULL
			ORDER BY
			tt_1_edar_pkrt_import.date_insert
			";

		}
		//print $fk_sql;

		$result = pendaftar_edar_pkrt_import_pkrt::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('no_tt');
		$default_value = array(
			array (
			'lisensi' => 'Licensi',
				'skey' => '',
				'svalue' => __('No Tanda terima - ').' Nama Pabrik'
			)
		);




  $jas ="
		b = document.theform.no_tt.value;
		sql = 'SELECT pendaftar_edar_pkrt_import_pkrt.alamat_pabrik,subdit.subdit as nama_propinsi_2 FROM pendaftar_edar_pkrt_import_pkrt LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt) LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)  WHERE tt_1_edar_pkrt_import.no_tt =\''+ b +'\'';

		jumpto1('frame_tt_1_pkrt.php?sql='+sql+'&a='+b)

		";

	$GLOBALS['out_before_footer'] = '
 	<iframe marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=auto name=\'iframe_entry1\' id=\'iframe_entry1\' style="width:0;height:0" src="frame_tt_1_pkrt.php"></iframe>
	<script language=javascript>
	function jumpto1(inputurl){
	document.getElementById(\'iframe_entry1\').src=inputurl
	}
	</script>
	'.$GLOBALS['out_before_footer']
			;
		$field_arr[] = array ('name' => 'alamat', 'type' => 'C', 'max_length'=>'0');
		$optional_arr['alamat']= 'user_defined';
		$label_arr['alamat'] = 'Alamat';
		$value_arr['alamat'] = '<input type=text name=alamat class=text size=50 disabled>';

		$field_arr[] = array ('name' => 'propinsi', 'type' => 'C', 'max_length'=>'0');
		$optional_arr['propinsi']= 'user_defined';
		$label_arr['propinsi'] = 'Subdit';
		$value_arr['propinsi'] = '<input type=text name=propinsi class=text size=30 disabled>';



		$result = array_merge($default_value, $result);
		$optional_arr['no_tt'] = 'user_defined';
		$value_arr['no_tt'] = $this->select_form('no_tt', $result, $selected,$multiple=FALSE,$jas);
		$optional_arr['no_tt_rule'] = "\n".
		"       if(theform.no_tt.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['no_tt']." ".__('empty').".');\n".
		"               theform.no_tt.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";
	}

	
	function id_kategori_edar_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['id_kategori_edar'];

		include_once 'class.kategori_edar.inc.php';
		$fk_sql = ''.
			'SELECT
				id_kategori_edar as skey,
				nama_kategori_edar as svalue2
			FROM
				kategori_edar
			ORDER BY
				id_kategori_edar
			';
		$result = kategori_edar::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('id_kategori_edar');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->sub_kategori_edar_label['id_kategori_edar']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['id_kategori_edar'] = 'user_defined';
		$value_arr['id_kategori_edar'] = $this->select_form('id_kategori_edar', $result, $selected);
		$optional_arr['id_kategori_edar_rule'] = "\n".
		"       if(theform.id_kategori_edar.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['id_kategori_edar']." ".__('empty').".');\n".
		"               theform.id_kategori_edar.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";



	}
	
	function id_sub_kategori_edar_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['id_sub_kategori_edar'];

		include_once 'class.kategori_edar.inc.php';
		$fk_sql = ''.
			'SELECT
				id_sub_kategori_edar as skey,
				nama_sub_kategori_edar as svalue2
			FROM
				sub_kategori_edar
			ORDER BY
				id_sub_kategori_edar
			';
		$result = kategori_edar::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('id_sub_kategori_edar');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->sub_kategori_edar_label['id_sub_kategori_edar']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['id_sub_kategori_edar'] = 'user_defined';
		$value_arr['id_sub_kategori_edar'] = $this->select_form('id_sub_kategori_edar', $result, $selected);
		$optional_arr['id_sub_kategori_edar_rule'] = "\n".
		"       if(theform.id_sub_kategori_edar.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['id_sub_kategori_edar']." ".__('empty').".');\n".
		"               theform.id_sub_kategori_edar.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";



	}
	// create add cek_kelengkapan_data_edar_import_pkrt form
	function add_cek_kelengkapan_data_edar_import_pkrt_form() {
		include_once 'class.xform.inc.php';
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		//print_r($_GET);exit();
		$record = $_GET;
		$label_arr = $this->cek_kelengkapan_data_edar_import_pkrt_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('no_tt','N','8');
		$field_arr[] = xform::xf('nama_produk','C','32');
		$field_arr[] = xform::xf('no_pemohon','C','32');
		$field_arr[] = xform::xf('kemasan','C','32');

		$field_arr[] = xform::xf('ukuran','C','32');
		$field_arr[] = xform::xf('id_kategori_edar','C','32');
		$field_arr[] = xform::xf('id_sub_kategori_edar','N','8');
		$field_arr[] = xform::xf('nama','C','32');
		$field_arr[] = xform::xf('jenis','C','32');
		$field_arr[] = xform::xf('id_golongan','N','8');


		$field_arr[] = xform::xf('kelengkapan','C','32');
		$field_arr[] = xform::xf('kelengkapan_2','C','32');
		$field_arr[] = xform::xf('indi_penilai','C','32');
		$field_arr[] = xform::xf('status_penilai','C','32');
		$field_arr[] = xform::xf('indi_kasubdit','C','32');

		$field_arr[] = xform::xf('nama_penilai','C','32');
		$field_arr[] = xform::xf('date_1','N','8');

		$field_arr[] = xform::xf('status_kaseksi','C','32');
		$field_arr[] = xform::xf('indi_kaseksi','C','32');
		$field_arr[] = xform::xf('nama_kaseksi','C','32');
		$field_arr[] = xform::xf('date_2','N','8');

		$field_arr[] = xform::xf('status_kasubdit','C','32');
		$field_arr[] = xform::xf('nama_kasubdit','C','32');
		$field_arr[] = xform::xf('date_3','N','8');

		$field_arr[] = xform::xf('indi_direktur','C','32');
  		$field_arr[] = xform::xf('status_direktur','C','32');
		$field_arr[] = xform::xf('nama_direktur','C','32');
		$field_arr[] = xform::xf('date_4','N','8');

		$field_arr[] = xform::xf('keterangan','C','32');
		$field_arr[] = xform::xf('read_penilai','C','32');
		$field_arr[] = xform::xf('read_kaseksi','C','32');
		$field_arr[] = xform::xf('read_kasubdit','C','32');
		$field_arr[] = xform::xf('read_direktur','C','32');


		$rs = $adodb->Execute("SELECT * FROM cek_kelengkapan_data_edar_import_pkrt WHERE id_cek_1='{$record['id_cek_1']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_cek_1'] = 'protect';
			$mode = 'edit';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}

		$optional_arr['kelengkapan_rule'] = '';
		$optional_arr['id_cek_1_rule'] = '';
		$optional_arr['id_golongan_rule'] = '';
		$optional_arr['no_daftar_rule'] = '';
		$optional_arr['kemasan_rule'] = '';
		$optional_arr['ukuran_rule'] = '';
		$optional_arr['no_pemohon_rule'] = '';
		$optional_arr['date_pemohon_rule'] = '';
		$optional_arr['nama_produk_rule'] = '';
		$optional_arr['nama_pabrik_rule'] = '';
		$optional_arr['alamat_rule'] = '';
		$optional_arr['lisensi_rule'] = '';
		$optional_arr['status_penilai_rule'] = '';
		$optional_arr['nama_penilai_rule'] = '';
		$optional_arr['dapendaftar_edar_pkrt_import_pkrtte_1_rule'] = '';
		$optional_arr['status_kaseksi_rule'] = '';
		$optional_arr['nama_kaseksi_rule'] = '';
		$optional_arr['date_2_rule'] = '';
		$optional_arr['status_kasubdit_rule'] = '';
		$optional_arr['nama_kasubdit_rule'] = '';
		$optional_arr['date_3_rule'] = '';
		$optional_arr['status_direktur_rule'] = '';
		$optional_arr['nama_direktur_rule'] = '';
		$optional_arr['date_4_rule'] = '';
		$optional_arr['keterangan_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';

		eval($this->save_config);
		$this->id_kategori_edar_form($config);
		$this->id_sub_kategori_edar_form($config);
		$optional_arr['nama_produk'] = 'user_defined';
		$value_arr['nama_produk'] = '<textarea name="nama_produk" class="text" rows="3" cols="50">'.$value_arr['nama_produk'].'</textarea>';
		
		$optional_arr['keterangan'] = 'user_defined';
		$value_arr['keterangan'] = '<textarea name="keterangan" class="text" rows="3" cols="50">'.$value_arr['keterangan'].'</textarea>';
		
		$optional_arr['no_pemohon'] = 'user_defined';
		$value_arr['no_pemohon'] = '<textarea name="no_pemohon" class="text" rows="3" cols="50">'.$value_arr['no_pemohon'].'</textarea>';

		$optional_arr['nama_penilai'] = 'user_defined';
		$optional_arr['date_1'] = 'user_defined';
		$optional_arr['status_penilai'] = 'user_defined';
		$optional_arr['nama_kaseksi'] = 'user_defined';
		$optional_arr['date_2'] = 'user_defined';
		$optional_arr['status_kaseksi'] = 'user_defined';
		$optional_arr['nama_kasubdit'] = 'user_defined';
		$optional_arr['date_3'] = 'user_defined';
		$optional_arr['status_kasubdit'] = 'user_defined';
		$optional_arr['nama_direktur'] = 'user_defined';
		$optional_arr['date_4'] = 'user_defined';
		$optional_arr['status_direktur'] = 'user_defined';
		$optional_arr['indi_penilai'] = 'user_defined';
		$optional_arr['indi_kaseksi'] = 'user_defined';
		$optional_arr['indi_kasubdit'] = 'user_defined';
		$optional_arr['indi_direktur'] = 'user_defined';
		$optional_arr['read_penilai'] = 'user_defined';
		$optional_arr['read_kaseksi'] = 'user_defined';
		$optional_arr['read_kasubdit'] = 'user_defined';
		$optional_arr['read_direktur'] = 'user_defined';


		if($value_arr['status_penilai'] == '0'){$ok1 = 'checked';$ok1text='0';$ok2='';$ok1t='Sudah Lengkap';}else{$ok1='';$ok2='checked';$ok1text='1';$ok1t='Belum Lengkap';}
		if($value_arr['status_kaseksi'] == '0'){$ok3 = 'checked';$ok2text='0';$ok4='';$ok2t='Sudah Lengkap';}else{$ok3='';$ok4='checked';$ok2text='1';$ok2t='Belum Lengkap';}
		if($value_arr['status_kasubdit'] == '0'){$ok5 = 'checked';$ok3text='0';$ok6='';$ok3t='Sudah Lengkap';}else{$ok5='';$ok6='checked';$ok3text='1';$ok3t='Belum Lengkap';}
		if($value_arr['status_direktur'] == '0'){$ok7 = 'checked';$ok4text='0';$ok8='';$ok4t='Sudah Lengkap';}else{$ok7='';$ok8='checked';$ok4text='1';$ok4t='Belum Lengkap';}

		if($value_arr['indi_penilai'] == '0'){$sel11 = 'selected';$sel22 ='';}else{$sel11='';$sel22='selected';}
		if($value_arr['indi_kaseksi'] == '0'){$sel1 = 'selected';$sel2 ='';}else{$sel1='';$sel2='selected';}
		if($value_arr['indi_kasubdit'] == '0'){$sel3 = 'selected';$sel4 ='';}else{$sel3='';$sel4='selected';}
		if($value_arr['indi_direktur'] == '0'){$sel5 = 'selected';$sel6 ='';}else{$sel5='';$sel6='selected';}

		if( $value_arr['date_1'] == '0'){ $tgl1 = '';}else{ if( $value_arr['date_1'] != ''){$tgl1 = date('d/m/Y',$value_arr['date_1']);}}
		if( $value_arr['date_2'] == '0'){ $tgl2 = '';}else{ if( $value_arr['date_2'] != ''){$tgl2 = date('d/m/Y',$value_arr['date_2']);}}
		if( $value_arr['date_3'] == '0'){ $tgl3 = '';}else{ if( $value_arr['date_3'] != ''){$tgl3 = date('d/m/Y',$value_arr['date_3']);}}
		if( $value_arr['date_4'] == '0'){ $tgl4 = '';}else{ if( $value_arr['date_4'] != ''){$tgl4 = date('d/m/Y',$value_arr['date_4']);}}

		if($ses->action == 'penilai'){
			$value_arr['nama_penilai'] = '<input type="text" name="nama_penilai" value="'.$ses->loginid.'" readonly size=11 class="text">';
			$value_arr['date_1'] = '<input type="text" name="date_1" value="'.date('d/m/Y').'" readonly size=11 class="text">';
			$value_arr['status_penilai'] = '<input type="radio" name="status_penilai" value="0" '.$ok1.' >Sudah Lengkap <input type="radio" name="status_penilai" value="1" '.$ok2.'>Belum Lengkap
			<input type="hidden" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'">
			<input type="hidden" name="date_2" value="'.$tgl2.'">
			<input type="hidden" name="status_kaseksi" value="'.$ok2text.'">
			<input type="hidden" name="nama_kasubdit" value="'.$value_arr['nama_kasubdit'].'">
			<input type="hidden" name="date_3" value="'.$tgl3.'">
			<input type="hidden" name="status_kasubdit" value="'.$ok3text.'">
			<input type="hidden" name="nama_direktur" value="'.$value_arr['nama_direktur'].'">
			<input type="hidden" name="date_4" value="'.$tgl4.'">
			<input type="hidden" name="status_direktur" value="'.$ok4text.'">
			';

			$read = $value_arr['read_penilai'];
				if($read == '1'){$select = "checked";}else{$select = "";}
				$value_arr['read_penilai']='<input type="checkbox" name="read_penilai" '.$select.' class="text">';

			$optional_arr['nama_kaseksi'] = TRUE;
			$optional_arr['date_2'] = TRUE;
			$optional_arr['status_kaseksi'] = TRUE;
			$optional_arr['nama_kasubdit'] = TRUE;
			$optional_arr['date_3'] = TRUE;
			$optional_arr['status_kasubdit'] = TRUE;
			$optional_arr['nama_direktur'] = TRUE;
			$optional_arr['date_4'] = TRUE;
			$optional_arr['status_direktur'] = TRUE;
		}else{
			if($ses->action == 'kaseksi'){
				$value_arr['status_penilai'] = ''.$ok1t.', '.$value_arr['nama_penilai'].', '.$tgl1.'';

				$value_arr['nama_kaseksi'] = '<input type="text" name="nama_kaseksi" value="'.$ses->loginid.'" readonly size=11 class="text">';
				$value_arr['indi_kasubdit'] ='<select name="indi_kasubdit" class="text"><option value="0" '.$sel3.'>Return</option><option value="1" '.$sel4.'>OK</option></select>';
				$value_arr['indi_kaseksi'] ='<select name="indi_kaseksi" class="text"><option value="0" '.$sel1.'>Return</option><option value="1" '.$sel2.'>OK</option></select>';
				$value_arr['indi_penilai'] ='<select name="indi_penilai" class="text"><option value="0" '.$sel11.'>Return</option><option value="1" '.$sel22.'>OK</option></select>';

				$read = $value_arr['read_kaseksi'];
				if($read == '1'){$select = "checked";}else{$select = "";}
				$value_arr['read_kaseksi']='<input type="checkbox" name="read_kaseksi" '.$select.' class="text">';


				$value_arr['date_2'] = '<input type="text" name="date_2" value="'.date('d/m/Y').'" readonly size=11 class="text">';
				$value_arr['status_kaseksi'] = '<input type="radio" name="status_kaseksi" value="0" '.$ok3.' >Sudah Lengkap <input type="radio" name="status_kaseksi" value="1" '.$ok4.'>Belum Lengkap
				<input type="hidden" name="nama_penilai" value="'.$value_arr['nama_penilai'].'">
				<input type="hidden" name="date_1" value="'.$tgl1.'">
				<input type="hidden" name="status_penilai" value="'.$ok1text.'">
				<input type="hidden" name="nama_kasubdit" value="'.$value_arr['nama_kasubdit'].'">
				<input type="hidden" name="date_3" value="'.$tgl3.'">
				<input type="hidden" name="status_kasubdit" value="'.$ok3text.'">
				<input type="hidden" name="nama_direktur" value="'.$value_arr['nama_direktur'].'">
				<input type="hidden" name="date_4" value="'.$tgl4.'">
				<input type="hidden" name="status_direktur" value="'.$ok4text.'">
				';

				$optional_arr['nama_penilai'] = TRUE;
				$optional_arr['date_1'] = TRUE;

				$optional_arr['nama_kasubdit'] = TRUE;
				$optional_arr['indi_direktur'] = TRUE;
				$optional_arr['date_3'] = TRUE;
				$optional_arr['status_kasubdit'] = TRUE;
				$optional_arr['nama_direktur'] = TRUE;
				$optional_arr['date_4'] = TRUE;
				$optional_arr['status_direktur'] = TRUE;
				$optional_arr['read_penilai'] = TRUE;
				$optional_arr['read_direktur'] = TRUE;
				$optional_arr['read_kasubdit'] = TRUE;;
			}else{
				if($ses->action == 'kasubdit'){
					$value_arr['status_penilai'] = ''.$ok1t.', '.$value_arr['nama_penilai'].', '.$tgl1.'';
					$value_arr['status_kaseksi'] = ''.$ok2t.', '.$value_arr['nama_kaseksi'].', '.$tgl2.'';

					$value_arr['nama_kasubdit'] = '<input type="text" name="nama_kasubdit" value="'.$ses->loginid.'" readonly size=11 class="text">';
					$value_arr['indi_kaseksi'] ='<select name="indi_kaseksi" class="text"><option value="0" '.$sel1.'>Return</option><option value="1" '.$sel2.'>OK</option></select>';

					$read = $value_arr['read_kasubdit'];
					if($read == '1'){$select = "checked";}else{$select = "";}
					$value_arr['read_kasubdit']='<input type="checkbox" name="read_kasubdit" '.$select.' class="text">';

					$value_arr['indi_kasubdit'] ='<select name="indi_kasubdit" class="text"><option value="0" '.$sel3.'>Return</option><option value="1" '.$sel4.'>OK</option></select>';
     					$value_arr['indi_direktur'] ='<select name="indi_direktur" class="text"><option value="0" '.$sel5.'>Return</option><option value="1" '.$sel6.'>OK</option></select>';
					$value_arr['date_3'] = '<input type="text" name="date_3" value="'.date('d/m/Y').'" readonly size=11 class="text">';
					$value_arr['status_kasubdit'] = '<input type="radio" name="status_kasubdit" value="0" '.$ok5.' >Sudah Lengkap <input type="radio" name="status_kasubdit" value="1" '.$ok6.'>Belum Lengkap
					<input type="hidden" name="nama_penilai" value="'.$value_arr['nama_penilai'].'">
					<input type="hidden" name="date_1" value="'.$tgl1.'">
					<input type="hidden" name="status_penilai" value="'.$ok1text.'">
					<input type="hidden" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'">
					<input type="hidden" name="date_2" value="'.$tgl2.'">
					<input type="hidden" name="status_kaseksi" value="'.$ok2text.'">
					<input type="hidden" name="nama_direktur" value="'.$value_arr['nama_direktur'].'">
					<input type="hidden" name="date_4" value="'.$tgl4.'">
					<input type="hidden" name="status_direktur" value="'.$ok4text.'">
					';
					$optional_arr['nama_penilai'] = TRUE;
					$optional_arr['date_1'] = TRUE;

					$optional_arr['nama_kaseksi'] = TRUE;
					$optional_arr['date_2'] = TRUE;

					$optional_arr['nama_direktur'] = TRUE;
					$optional_arr['date_4'] = TRUE;
					$optional_arr['status_direktur'] = TRUE;
					$optional_arr['read_direktur'] = TRUE;
					$optional_arr['read_kaseksi'] = TRUE;
					$optional_arr['read_penilai'] = TRUE;
				}else{
					if($ses->action == 'direktur'){
						$value_arr['status_penilai'] = ''.$ok1t.', '.$value_arr['nama_penilai'].', '.$tgl1.'';
						$value_arr['indi_kasubdit'] ='<select name="indi_kasubdit" class="text"><option value="0" '.$sel3.'>Return</option><option value="1" '.$sel4.'>OK</option></select>';
						$value_arr['indi_direktur'] ='<select name="indi_direktur" class="text"><option value="0" '.$sel5.'>Return</option><option value="1" '.$sel6.'>OK</option></select>';

						$read = $value_arr['read_direktur'];
						if($read == '1'){$select = "checked";}else{$select = "";}
						$value_arr['read_direktur']='<input type="checkbox" name="read_direktur" '.$select.' class="text">';

						$value_arr['status_kaseksi'] = ''.$ok2t.', '.$value_arr['nama_kaseksi'].', '.$tgl2.'';
						$value_arr['status_kasubdit'] = ''.$ok3t.', '.$value_arr['nama_kasubdit'].', '.$tgl3.'';

						$value_arr['nama_direktur'] = '<input type="text" name="nama_direktur" value="'.$ses->loginid.'" readonly size=11 class="text">';
						$value_arr['date_4'] = '<input type="text" name="date_4" value="'.date('d/m/Y').'" readonly size=11 class="text">';
						$value_arr['status_direktur'] = '<input type="radio" name="status_direktur" value="0" '.$ok7.' >Sudah Lengkap <input type="radio" name="status_direktur" value="1" '.$ok8.'>Belum Lengkap
						<input type="hidden" name="nama_penilai" value="'.$value_arr['nama_penilai'].'">
						<input type="hidden" name="date_1" value="'.$tgl1.'">
						<input type="hidden" name="status_penilai" value="'.$ok1text.'">
						<input type="hidden" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'">
						<input type="hidden" name="date_2" value="'.$tgl2.'">
						<input type="hidden" name="status_kaseksi" value="'.$ok2text.'">
						<input type="hidden" name="nama_kasubdit" value="'.$value_arr['nama_kasubdit'].'">
						<input type="hidden" name="date_3" value="'.$tgl3.'">
						<input type="hidden" name="status_kasubdit" value="'.$ok3text.'">
						';
						$optional_arr['nama_penilai'] = TRUE;
						$optional_arr['date_1'] = TRUE;

						$optional_arr['nama_kaseksi'] = TRUE;
						$optional_arr['date_2'] = TRUE;
						$optional_arr['indi_penilai'] = TRUE;
						$optional_arr['indi_kaseksi'] = TRUE;

						$optional_arr['nama_kasubdit'] = TRUE;
						$optional_arr['date_3'] = TRUE;
						$optional_arr['read_kaseksi'] = TRUE;
						$optional_arr['read_penilai'] = TRUE;
						$optional_arr['read_kasubdit'] = TRUE;
					}else{
						$value_arr['status_penilai'] = ''.$ok1t.', '.$value_arr['nama_penilai'].', '.$tgl1.'';
						$value_arr['status_kaseksi'] = ''.$ok2t.', '.$value_arr['nama_kaseksi'].', '.$tgl2.'';
						$value_arr['status_kasubdit'] = ''.$ok3t.', '.$value_arr['nama_kasubdit'].', '.$tgl3.'';
						$value_arr['status_direktur'] = ''.$ok4t.', '.$value_arr['nama_direktur'].', '.$tgl4.'';
						
						$optional_arr['nama_penilai'] = TRUE;
						$optional_arr['date_1'] = TRUE;

						$optional_arr['nama_kaseksi'] = TRUE;
						$optional_arr['date_2'] = TRUE;

						$optional_arr['nama_kasubdit'] = TRUE;
						$optional_arr['date_3'] = TRUE;

						$optional_arr['nama_direktur'] = TRUE;
						$optional_arr['date_4'] = TRUE;

					}
				}
			}
		}

		//$optional_arr['nama_penilai_format']='Nama Penilai : nama_penilai Tanggal Satu date_1';
		//$optional_arr['nama_kaseksi_format']='Nama Kaseksi : nama_kaseksi Tanggal Dua date_2';
		//$optional_arr['nama_kasubdit_format']='Nama Kasubdit : nama_kasubdit Tanggal Tiga date_3';
		//$optional_arr['nama_direktur_format']='Nama Direktur : nama_direktur Tanggal Empat date_4';


		$this->no_tt_form($config);
		
		/*AWAL MULAI KELENGKAPAN ADMINISTRASI*/
		$has ='';
		$has .='<table>';
		if($ses->action == 'penilai'){$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Status Penilai</td><td>Komentar Penilai</td></tr>';}
		if($ses->action == 'kaseksi'){$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Status Kaseksi</td><td>Komentar Kaseksi</td></tr>';}
		if($ses->action == 'kasubdit'){$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Status Kasubdit</td><td>Komentar Kasubdit</td></tr>';}
		if($ses->action == 'direktur'){$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Komentar Kasubdit</td><td>Status Direktur</td><td>Komentar Direktur</td></tr>';}
		if($ses->action == 'admin'){$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Komentar Kasubdit</td><td>Komentar Direktur</td></tr>';}
		global $adodb;
			$sqlx = "SELECT id_kelengkapan,nama_kelengkapan FROM kelengkapan_admin_import_pkrt ORDER BY id_kelengkapan";
			$rsx = $adodb->Execute($sqlx);
			$a=1;
			while(! $rsx->EOF){
				if($_GET['id_cek_1']){
				$sqld = "SELECT id_cek_1,id_kelengkapan,status_penilai,status_kaseksi,status_kasubdit,status_direktur,alasan_penilai,alasan_kaseksi,alasan_kasubdit,alasan_direktur FROM detail_cek_kelengkapan_data_edar_import_pkrt_admin WHERE id_cek_1='".$_GET['id_cek_1']."' AND id_kelengkapan='".$rsx->fields['id_kelengkapan']."'";

				$rsd = $adodb->Execute($sqld);
				$id_cek_1x = $rsd->fields['id_cek_1'];
				$id_kelengkapanx = $rsd->fields['id_kelengkapan'];
				$status_penilaix = $rsd->fields['status_penilai'];
				$status_kaseksix = $rsd->fields['status_kaseksi'];
				$status_kasubditx = $rsd->fields['status_kasubdit'];
				$status_direkturx = $rsd->fields['status_direktur'];
				$alasan_penilaix = $rsd->fields['alasan_penilai'];
				$alasan_kaseksix = $rsd->fields['alasan_kaseksi'];
				$alasan_kasubditx = $rsd->fields['alasan_kasubdit'];
				$alasan_direkturx = $rsd->fields['alasan_direktur'];
					if($id_kelengkapanx == $rsx->fields['id_kelengkapan']){
						if($status_penilaix == "1"){$check1 = "checked";$text1='Ada';}else{$check1 = "";$text1='Tidak';}
						if($status_kaseksix == "1"){$check2 = "checked";$text2='Ada';}else{$check2 = "";$text2='Tidak';}
						if($status_kasubditx == "1"){$check3 = "checked";$text3='Ada';}else{$check3 = "";$text3='Tidak';}
						if($status_direkturx == "1"){$check4 = "checked";$text4='Ada';}else{$check4 = "";$text4='Tidak';}
					}
				}
				$id_kelengkapan = $rsx->fields['id_kelengkapan'];
				$nama_kelengkapan = $rsx->fields['nama_kelengkapan'];
				$has .= "<tr><td>".$a."<input type=hidden name=id_kelengkapan[".$a."] value='".$id_kelengkapan."'</td><td>".$nama_kelengkapan."</td>";

				if($ses->action == 'penilai'){

				$has .= "<td><input type=checkbox name=status_penilaix[".$a."] value=1 class=text ".$check1."></td></td><td><textarea name=alasan_penilaix[".$a."] class='text'>".$alasan_penilaix."</textarea></td>
						<input type=hidden name=status_kaseksix[".$a."] value='".$status_kaseksix."'>
						<input type=hidden name=alasan_kaseksix[".$a."] value='".$alasan_kaseksix."'>
						<input type=hidden name=status_kasubditx[".$a."] value='".$status_kasubditx."'>
						<input type=hidden name=alasan_kasubditx[".$a."] value='".$alasan_kasubditx."'>
						<input type=hidden name=status_direkturx[".$a."] value='".$status_direkturx."'>
						<input type=hidden name=alasan_direkturx[".$a."] value='".$alasan_direkturx."'>
						";
				}else{
					if($ses->action == 'kaseksi'){
					if($check1 == "checked"){$has .= "<td><input type=hidden name=status_penilaix[".$a."] value='".$status_penilaix."'>".$text1.",<br><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>".$alasan_penilaix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'><nobr>&nbsp;".$text1.",</nobr><br><nobr>".$alasan_penilaix."</nobr></td>";}
					$has .= "<td><input type=checkbox name=status_kaseksix[".$a."] value=1 class=text ".$check2."></td><td><textarea name=alasan_kaseksix[".$a."] class='text'>".$alasan_kaseksix."</textarea>
						<input type=hidden name=status_kasubditx[".$a."] value='".$status_kasubditx."'>
						<input type=hidden name=alasan_kasubditx[".$a."] value='".$alasan_kasubditx."'>
						<input type=hidden name=status_direkturx[".$a."] value='".$status_direkturx."'>
						<input type=hidden name=alasan_direkturx[".$a."] value='".$alasan_direkturx."'>
					</td>";
					}else{
						if($ses->action == 'kasubdit'){
						if($check1 == "checked"){$has .= "<td><input type=hidden name=status_penilaix[".$a."] value='".$status_penilaix."'>".$text1.",<br><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>".$alasan_penilaix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'><nobr>&nbsp;".$text1.",</nobr><br><nobr>".$alasan_penilaix."</nobr></td>";}
						if($check2 == "checked"){$has .= "<td><input type=hidden name=status_kaseksix[".$a."] value='".$status_kaseksix."'>".$text2.",<br><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'>".$alasan_kaseksix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'><nobr>&nbsp;".$text2.",</nobr><br><nobr>".$alasan_kaseksix."</nobr></td>";}
						$has .= "<td><input type=checkbox name=status_kasubditx[".$a."] value=1 class=text ".$check3."></td><td><textarea name=alasan_kasubditx[".$a."] class='text'>".$alasan_kasubditx."</textarea>
							<input type=hidden name=status_direkturx[".$a."] value='".$status_direkturx."'>
							<input type=hidden name=alasan_direkturx[".$a."] value='".$alasan_direkturx."'>
						</td>";
						}else{
							if($ses->action == 'direktur'){
							if($check1 == "checked"){$has .= "<td><input type=hidden name=status_penilaix[".$a."] value='".$status_penilaix."'>".$text1.",<br><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>".$alasan_penilaix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'><nobr>&nbsp;".$text1.",</nobr><br><nobr>".$alasan_penilaix."</nobr></td>";}
							if($check2 == "checked"){$has .= "<td><input type=hidden name=status_kaseksix[".$a."] value='".$status_kaseksix."'>".$text2.",<br><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'>".$alasan_kaseksix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'><nobr>&nbsp;".$text2.",</nobr><br><nobr>".$alasan_kaseksix."</nobr></td>";}
							if($check3 == "checked"){$has .= "<td><input type=hidden name=status_kasubditx[".$a."] value='".$status_kasubditx."'>".$text3.",<br><input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".$alasan_kasubditx."'>".$alasan_kasubditx."</td>";}else{ $has .= "<td><input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".$alasan_kasubditx."'>&nbsp;".$text3.",</nobr><br>".$alasan_kasubditx."</nobr></td>";}
							$has .= "<td><input type=checkbox name=status_direkturx[".$a."] value=1 class=text ".$check4."></td><td><textarea name=alasan_direkturx[".$a."] class='text'>".$alasan_direkturx."</textarea></td></tr>";
							}else{
								if($ses->action == 'admin'){
								if($check1 == "checked"){$has .= "<td><input type=hidden name=status_penilaix[".$a."] value='".$status_penilaix."'>".$text1.",<br><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>".$alasan_penilaix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'><nobr>&nbsp;".$text1.",</nobr><br><nobr>".$alasan_penilaix."</nobr></td>";}
								if($check2 == "checked"){$has .= "<td><input type=hidden name=status_kaseksix[".$a."] value='".$status_kaseksix."'>".$text2.",<br><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'>".$alasan_kaseksix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'><nobr>&nbsp;".$text2.",</nobr><br><nobr>".$alasan_kaseksix."</nobr></td>";}
								if($check3 == "checked"){$has .= "<td><input type=hidden name=status_kasubditx[".$a."] value='".$status_kasubditx."'>".$text3.",<br><input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".$alasan_kasubditx."'>".$alasan_kasubditx."</td>";}else{ $has .= "<td><input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".$alasan_kasubditx."'><nobr>&nbsp;".$text3.",</nobr><br><nobr>".$alasan_kasubditx."</nobr></td>";}
								if($check4 == "checked"){$has .= "<td><input type=hidden name=status_direkturx[".$a."] value='".$status_direkturx."'>".$text4.",<br><input type=hidden name=alasan_direkturx[".$a."] class='text' value='".$alasan_direkturx."'>".$alasan_direkturx."</td>";}else{ $has .= "<td><input type=hidden name=alasan_direkturx[".$a."] class='text' value='".$alasan_direkturx."'><nobr>&nbsp;".$text4.",</nobr><br><nobr>".$alasan_direkturx."</nobr></td>";}
								}
							}

						}
					}
				}

				$a=$a+1;
				$rsx->MoveNext();
			}
		$has .= '</tr></table>';
		

		$optional_arr['kelengkapan']='user_defined';
		$label_arr['kelengkapan']='Kelengkapan Administrasi';
		$value_arr['kelengkapan'] = $has;
		/*AKHIR KELENGKAPAN ADMINISTRASI*/
		
		
		/*AWAL KELENGKAPAN TEKNIS*/
		
		$has2 ='';	$has2 ='';
		$has2 .='<table>';
		if($ses->action == 'penilai'){$has2 .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Status Penilai</td><td>Komentar Penilai</td></tr>';}
		if($ses->action == 'kaseksi'){$has2 .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Status Kaseksi</td><td>Komentar Kaseksi</td></tr>';}
		if($ses->action == 'kasubdit'){$has2 .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Status Kasubdit</td><td>Komentar Kasubdit</td></tr>';}
		if($ses->action == 'direktur'){$has2 .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Komentar Kasubdit</td><td>Status Direktur</td><td>Komentar Direktur</td></tr>';}
		if($ses->action == 'admin'){$has2 .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Komentar Kasubdit</td><td>Komentar Direktur</td></tr>';}
		global $adodb;
			$sqlx2 = "SELECT id_kelengkapan,nama_kelengkapan FROM kelengkapan_teknis_import_pkrt ORDER BY id_kelengkapan";
			$rsx2 = $adodb->Execute($sqlx2);
			$a=1;
			while(! $rsx2->EOF){
				if($_GET['id_cek_1']){
				$sqld = "SELECT id_cek_1,id_kelengkapan,status_penilai,status_kaseksi,status_kasubdit,status_direktur,alasan_penilai,alasan_kaseksi,alasan_kasubdit,alasan_direktur FROM detail_cek_kelengkapan_data_edar_import_pkrt_teknis WHERE id_cek_1='".$_GET['id_cek_1']."' AND id_kelengkapan='".$rsx2->fields['id_kelengkapan']."'";

				$rsd = $adodb->Execute($sqld);
				$id_cek_1x2 = $rsd->fields['id_cek_1'];
				$id_kelengkapanx2 = $rsd->fields['id_kelengkapan'];
				$status_penilaix2 = $rsd->fields['status_penilai'];
				$status_kaseksix2 = $rsd->fields['status_kaseksi'];
				$status_kasubditx2 = $rsd->fields['status_kasubdit'];
				$status_direkturx2 = $rsd->fields['status_direktur'];
				$alasan_penilaix2 = $rsd->fields['alasan_penilai'];
				$alasan_kaseksix2 = $rsd->fields['alasan_kaseksi'];
				$alasan_kasubditx2 = $rsd->fields['alasan_kasubdit'];
				$alasan_direkturx2 = $rsd->fields['alasan_direktur'];
					if($id_kelengkapanx2 == $rsx2->fields['id_kelengkapan']){
						if($status_penilaix2 == "1"){$check1 = "checked";$tex2t1='Ada';}else{$check1 = "";$tex2t1='Tidak';}
						if($status_kaseksix2 == "1"){$check2 = "checked";$tex2t2='Ada';}else{$check2 = "";$tex2t2='Tidak';}
						if($status_kasubditx2 == "1"){$check3 = "checked";$tex2t3='Ada';}else{$check3 = "";$tex2t3='Tidak';}
						if($status_direkturx2 == "1"){$check4 = "checked";$tex2t4='Ada';}else{$check4 = "";$tex2t4='Tidak';}
					}
				}
				$id_kelengkapan2 = $rsx2->fields['id_kelengkapan'];
				$nama_kelengkapan2 = $rsx2->fields['nama_kelengkapan'];
				$has2 .= "<tr><td>".$a."<input type=hidden name=id_kelengkapan2[".$a."] value='".$id_kelengkapan2."'</td><td>".$nama_kelengkapan2."</td>";

				if($ses->action == 'penilai'){

				$has2 .= "<td><input type=checkbox name=status_penilaix2[".$a."] value=1 class=tex2t ".$check1."></td></td><td><textarea name=alasan_penilaix2[".$a."] class='text'>".$alasan_penilaix2."</textarea></td>
						<input type=hidden name=status_kaseksix2[".$a."] value='".$status_kaseksix2."'>
						<input type=hidden name=alasan_kaseksix2[".$a."] value='".$alasan_kaseksix2."'>
						<input type=hidden name=status_kasubditx2[".$a."] value='".$status_kasubditx2."'>
						<input type=hidden name=alasan_kasubditx2[".$a."] value='".$alasan_kasubditx2."'>
						<input type=hidden name=status_direkturx2[".$a."] value='".$status_direkturx2."'>
						<input type=hidden name=alasan_direkturx2[".$a."] value='".$alasan_direkturx2."'>
						";
				}else{
					if($ses->action == 'kaseksi'){
					if($check1 == "checked"){$has2 .= "<td><input type=hidden name=status_penilaix2[".$a."] value='".$status_penilaix2."'>".$tex2t1.",<br><input type=hidden name=alasan_penilaix2[".$a."] class='text' value='".$alasan_penilaix2."'>".$alasan_penilaix2."</td>";}else{ $has2 .= "<td><input type=hidden name=alasan_penilaix2[".$a."] class='text' value='".$alasan_penilaix2."'><nobr>&nbsp;".$tex2t1.",</nobr><br><nobr>".$alasan_penilaix2."</nobr></td>";}
					$has2 .= "<td><input type=checkbox name=status_kaseksix2[".$a."] value=1 class=tex2t ".$check2."></td><td><textarea name=alasan_kaseksix2[".$a."] class='text'>".$alasan_kaseksix2."</textarea>
						<input type=hidden name=status_kasubditx2[".$a."] value='".$status_kasubditx2."'>
						<input type=hidden name=alasan_kasubditx2[".$a."] value='".$alasan_kasubditx2."'>
						<input type=hidden name=status_direkturx2[".$a."] value='".$status_direkturx2."'>
						<input type=hidden name=alasan_direktuSELECT id_kelengkapan,nama_kelengkapan FROM kelengkapan_teknis_import_pkrt ORDER BY id_kelengkapanrx2[".$a."] value='".$alasan_direkturx2."'>
					</td>";
					}else{
						if($ses->action == 'kasubdit'){
						if($check1 == "checked"){$has2 .= "<td><input type=hidden name=status_penilaix2[".$a."] value='".$status_penilaix2."'>".$tex2t1.",<br><input type=hidden name=alasan_penilaix2[".$a."] class='text' value='".$alasan_penilaix2."'>".$alasan_penilaix2."</td>";}else{ $has2 .= "<td><input type=hidden name=alasan_penilaix2[".$a."] class='text' value='".$alasan_penilaix2."'><nobr>&nbsp;".$tex2t1.",</nobr><br><nobr>".$alasan_penilaix2."</nobr></td>";}
						if($check2 == "checked"){$has2 .= "<td><input type=hidden name=status_kaseksix2[".$a."] value='".$status_kaseksix2."'>".$tex2t2.",<br><input type=hidden name=alasan_kaseksix2[".$a."] class='text' value='".$alasan_kaseksix2."'>".$alasan_kaseksix2."</td>";}else{ $has2 .= "<td><input type=hidden name=alasan_kaseksix2[".$a."] class='text' value='".$alasan_kaseksix2."'><nobr>&nbsp;".$tex2t2.",</nobr><br><nobr>".$alasan_kaseksix2."</nobr></td>";}
						$has2 .= "<td><input type=checkbox name=status_kasubditx2[".$a."] value=1 class=tex2t ".$check3."></td><td><textarea name=alasan_kasubditx2[".$a."] class='text'>".$alasan_kasubditx2."</textarea>
							<input type=hidden name=status_direkturx2[".$a."] value='".$status_direkturx2."'>
							<input type=hidden name=alasan_direkturx2[".$a."] value='".$alasan_direkturx2."'>
						</td>";
						}else{
							if($ses->action == 'direktur'){
							if($check1 == "checked"){$has2 .= "<td><input type=hidden name=status_penilaix2[".$a."] value='".$status_penilaix2."'>".$tex2t1.",<br><input type=hidden name=alasan_penilaix2[".$a."] class='text' value='".$alasan_penilaix2."'>".$alasan_penilaix2."</td>";}else{ $has2 .= "<td><input type=hidden name=alasan_penilaix2[".$a."] class='text' value='".$alasan_penilaix2."'><nobr>&nbsp;".$tex2t1.",</nobr><br><nobr>".$alasan_penilaix2."</nobr></td>";}
							if($check2 == "checked"){$has2 .= "<td><input type=hidden name=status_kaseksix2[".$a."] value='".$status_kaseksix2."'>".$tex2t2.",<br><input type=hidden name=alasan_kaseksix2[".$a."] class='text' value='".$alasan_kaseksix2."'>".$alasan_kaseksix2."</td>";}else{ $has2 .= "<td><input type=hidden name=alasan_kaseksix2[".$a."] class='text' value='".$alasan_kaseksix2."'><nobr>&nbsp;".$tex2t2.",</nobr><br><nobr>".$alasan_kaseksix2."</nobr></td>";}
							if($check3 == "checked"){$has2 .= "<td><input type=hidden name=status_kasubditx2[".$a."] value='".$status_kasubditx2."'>".$tex2t3.",<br><input type=hidden name=alasan_kasubditx2[".$a."] class='text' value='".$alasan_kasubditx2."'>".$alasan_kasubditx2."</td>";}else{ $has2 .= "<td><input type=hidden name=alasan_kasubditx2[".$a."] class='text' value='".$alasan_kasubditx2."'>&nbsp;".$tex2t3.",</nobr><br>".$alasan_kasubditx2."</nobr></td>";}
							$has2 .= "<td><input type=checkbox name=status_direkturx2[".$a."] value=1 class=tex2t ".$check4."></td><td><textarea name=alasan_direkturx2[".$a."] class='text'>".$alasan_direkturx2."</textarea></td></tr>";
							}else{
								if($ses->action == 'admin'){
								if($check1 == "checked"){$has2 .= "<td><input type=hidden name=status_penilaix2[".$a."] value='".$status_penilaix2."'>".$tex2t1.",<br><input type=hidden name=alasan_penilaix2[".$a."] class='text' value='".$alasan_penilaix2."'>".$alasan_penilaix2."</td>";}else{ $has2 .= "<td><input type=hidden name=alasan_penilaix2[".$a."] class='text' value='".$alasan_penilaix2."'><nobr>&nbsp;".$tex2t1.",</nobr><br><nobr>".$alasan_penilaix2."</nobr></td>";}
								if($check2 == "checked"){$has2 .= "<td><input type=hidden name=status_kaseksix2[".$a."] value='".$status_kaseksix2."'>".$tex2t2.",<br><input type=hidden name=alasan_kaseksix2[".$a."] class='text' value='".$alasan_kaseksix2."'>".$alasan_kaseksix2."</td>";}else{ $has2 .= "<td><input type=hidden name=alasan_kaseksix2[".$a."] class='text' value='".$alasan_kaseksix2."'><nobr>&nbsp;".$tex2t2.",</nobr><br><nobr>".$alasan_kaseksix2."</nobr></td>";}
								if($check3 == "checked"){$has2 .= "<td><input type=hidden name=status_kasubditx2[".$a."] value='".$status_kasubditx2."'>".$tex2t3.",<br><input type=hidden name=alasan_kasubditx2[".$a."] class='text' value='".$alasan_kasubditx2."'>".$alasan_kasubditx2."</td>";}else{ $has2 .= "<td><input type=hidden name=alasan_kasubditx2[".$a."] class='text' value='".$alasan_kasubditx2."'><nobr>&nbsp;".$tex2t3.",</nobr><br><nobr>".$alasan_kasubditx2."</nobr></td>";}
								if($check4 == "checked"){$has2 .= "<td><input type=hidden name=status_direkturx2[".$a."] value='".$status_direkturx2."'>".$tex2t4.",<br><input type=hidden name=alasan_direkturx2[".$a."] class='text' value='".$alasan_direkturx2."'>".$alasan_direkturx2."</td>";}else{ $has2 .= "<td><input type=hidden name=alasan_direkturx2[".$a."] class='text' value='".$alasan_direkturx2."'><nobr>&nbsp;".$tex2t4.",</nobr><br><nobr>".$alasan_direkturx2."</nobr></td>";}
								}
							}

						}
					}
				}

				$a=$a+1;
				$rsx2->MoveNext();
			}
		$has2 .= '</tr></table>';


		$optional_arr['kelengkapan_2']='user_defined';
		$label_arr['kelengkapan_2']='Kelengkapan Teknis';
		$value_arr['kelengkapan_2'] = $has2;

		/*AKHIR KELENGKAPAN TEKNIS*/

		$this -> slip_field($config,'alamat','after','no_tt');
		$this -> slip_field($config,'propinsi','after','alamat');

		/*$optional_arr['id_golongan'] = 'user_defined';
                $arr = array();
                $arr['name'] = 'id_golongan';
                $arr['selected'] = $value_arr['id_golongan'];
                $arr['sql'] = 'SELECT id_golongan as val, golongan as txt FROM gol_edar';
                $value_arr['id_golongan'] = xform::dbs($arr);*/

		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_cek_1']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Cek Kelengkapan Izin Edar PKRT Import";
		$label_arr['form_width'] = '100%';
		$label_arr['form_name'] = 'theform';

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

	// create update cek_kelengkapan_data_edar_import_pkrt form
	function update_cek_kelengkapan_data_edar_import_pkrt_form() {
		return $this->add_cek_kelengkapan_data_edar_import_pkrt_form();
	}

	function view_cek_kelengkapan_data_edar_import_pkrt_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		$field_arr = cek_kelengkapan_data_edar_import_pkrt::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_cek_1'] = 'protect';

		$record = array (
			'id_cek_1' => ${$GLOBALS['get_vars']}['id_cek_1']
		);
		$result = cek_kelengkapan_data_edar_import_pkrt::get($record);
		$value_arr = $result[0];
		$label_arr = $this->cek_kelengkapan_data_edar_import_pkrt_label;
		global $adodb;

		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','A4');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,'KELENGKAPAN IZIN pkrt','',0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(5);
		$sqlA = "SELECT
		cek_kelengkapan_data_edar_import_pkrt.id_cek_1,
		cek_kelengkapan_data_edar_import_pkrt.no_tt,
		cek_kelengkapan_data_edar_import_pkrt.kemasan,
		cek_kelengkapan_data_edar_import_pkrt.id_golongan,
		cek_kelengkapan_data_edar_import_pkrt.ukuran,
		kategori_edar.nama_kategori_edar,
		sub_kategori_edar.nama_sub_kategori_edar,
		cek_kelengkapan_data_edar_import_pkrt.nama,
		gol_edar.golongan as kelas,
		cek_kelengkapan_data_edar_import_pkrt.jenis,
		cek_kelengkapan_data_edar_import_pkrt.no_pemohon,
		cek_kelengkapan_data_edar_import_pkrt.nama_produk,
		cek_kelengkapan_data_edar_import_pkrt.id_golongan as golongan,
		CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_penilai ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_penilai,
		cek_kelengkapan_data_edar_import_pkrt.nama_penilai,
		cek_kelengkapan_data_edar_import_pkrt.date_1,
		CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kaseksi ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_kaseksi,
		cek_kelengkapan_data_edar_import_pkrt.nama_kaseksi,
		cek_kelengkapan_data_edar_import_pkrt.date_2,
		CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kasubdit ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_kasubdit,
		cek_kelengkapan_data_edar_import_pkrt.nama_kasubdit,
		cek_kelengkapan_data_edar_import_pkrt.date_3,
		CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_direktur ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_direktur,
		cek_kelengkapan_data_edar_import_pkrt.nama_direktur,
		cek_kelengkapan_data_edar_import_pkrt.date_4,
		cek_kelengkapan_data_edar_import_pkrt.keterangan,
		cek_kelengkapan_data_edar_import_pkrt.insert_by,
		cek_kelengkapan_data_edar_import_pkrt.date_insert
		FROM cek_kelengkapan_data_edar_import_pkrt
		LEFT OUTER JOIN kategori_edar ON(kategori_edar.id_kategori_edar = cek_kelengkapan_data_edar_import_pkrt.id_kategori_edar)
		LEFT OUTER JOIN sub_kategori_edar ON(sub_kategori_edar.id_sub_kategori_edar = cek_kelengkapan_data_edar_import_pkrt.id_sub_kategori_edar)
		LEFT OUTER JOIN gol_edar ON(gol_edar.id_golongan = cek_kelengkapan_data_edar_import_pkrt.id_golongan)
		WHERE
		cek_kelengkapan_data_edar_import_pkrt.id_cek_1 ='".$value_arr['id_cek_1']."'
		";
		$hasil=$adodb->Execute($sqlA);
		while(! $hasil->EOF){
			$id_cek_1 = $hasil->fields['id_cek_1'];
			$no_tt = $hasil->fields['no_tt'];
			$kemasan = $hasil->fields['kemasan'];
			$ukuran = $hasil->fields['ukuran'];
			$no_pemohon = $hasil->fields['no_pemohon'];
			$date_pemohon = $hasil->fields['date_pemohon'];
			$nama = $hasil->fields['nama'];
			$jenis =  $hasil->fields['jenis'];
			$kelas = $hasil->fields['kelas'];
			$no_pemohon = $hasil->fields['no_pemohon'];
			$date_pemohon = $hasil->fields['date_pemohon'];
			$id_golongan = $hasil->fields['id_golongan'];
			$nama_produk = $hasil->fields['nama_produk'];
			$kategori_edar = $hasil->fields['nama_kategori_edar'];
			$sub_kategori_edar = $hasil->fields['nama_sub_kategori_edar'];
			$status_penilai = $hasil->fields['status_penilai'];
			$nama_penilai = $hasil->fields['nama_penilai'];
			$status_kaseksi = $hasil->fields['status_kaseksi'];
			$nama_kaseksi = $hasil->fields['nama_kaseksi'];
			$status_kasubdit = $hasil->fields['status_kasubdit'];
			$nama_kasubdit = $hasil->fields['nama_kasubdit'];
			$status_direktur = $hasil->fields['status_direktur'];
			$nama_direktur = $hasil->fields['nama_direktur'];
			$keterangan = $hasil->fields['keterangan'];

			if( $value_arr['date_1'] == '0'){ $tgl1 = '';}else{ if( $value_arr['date_1'] != ''){$tgl1 = date('d/m/Y',$value_arr['date_1']);}}
			if( $value_arr['date_2'] == '0'){ $tgl2 = '';}else{ if( $value_arr['date_2'] != ''){$tgl2 = date('d/m/Y',$value_arr['date_2']);}}
			if( $value_arr['date_3'] == '0'){ $tgl3 = '';}else{ if( $value_arr['date_3'] != ''){$tgl3 = date('d/m/Y',$value_arr['date_3']);}}
			if( $value_arr['date_4'] == '0'){ $tgl4 = '';}else{ if( $value_arr['date_4'] != ''){$tgl4 = date('d/m/Y',$value_arr['date_4']);}}
			if( $value_arr['date_pemohon'] == '0'){ $date_pemohon = '';}else{ if( $value_arr['date_pemohon'] != ''){$date_pemohon = date('d/m/Y',$value_arr['date_pemohon']);}}


			$sqlB = "
			SELECT
			tt_1_edar_pkrt_import.urut_no_tt,
			pendaftar_edar_pkrt_import_pkrt.alamat_pabrik,
			pendaftar_edar_pkrt_import_pkrt.nama_pabrik
			FROM
			pendaftar_edar_pkrt_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
			WHERE tt_1_edar_pkrt_import.no_tt ='".$no_tt."'
			";

			$hasilB = $adodb->Execute($sqlB);
			$alamat_pabrik = $hasilB->fields['alamat_pabrik'];
			$urut_no_tt = $hasilB->fields['urut_no_tt'];

			$sqlG = "
			SELECT
			golongan
			FROM
			gol_pkrt
			WHERE id_golongan ='".$id_golongan."'";
			$hasilG = $adodb->Execute($sqlG);
			$golongan = $hasilG->fields['golongan'];


			$sqlC = "
			SELECT
			subdit.subdit
			FROM
			pendaftar_edar_pkrt_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
			WHERE tt_1_edar_pkrt_import.no_tt ='".$no_tt."'";
			$hasilC = $adodb->Execute($sqlC);
			$subdit = $hasilC->fields['subdit'];

			$sqlP = "
			SELECT
			pendaftar_edar_pkrt_import_pkrt.nama_pabrik
			FROM
			pendaftar_edar_pkrt_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
			WHERE tt_1_edar_pkrt_import.no_tt ='".$no_tt."'";
			$hasilP = $adodb->Execute($sqlP);
			$nama_pabrik = $hasilP->fields['nama_pabrik'];

			$pdf->Cell(50,7,'No Tanda Terima','',0,'L');$pdf->Cell(50,7,': '.$urut_no_tt.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Nama Pabrik','',0,'L');$pdf->Cell(50,7,': '.$nama_pabrik.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Alamat Pabrik'.$nama_direktur.'','',0,'L');$pdf->Cell(50,7,': '.$alamat_pabrik.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Subdit ','',0,'L');$pdf->Cell(50,7,': '.$subdit.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,' Nama Alat Kesehatan','',0,'L');$pdf->Cell(50,7,': '.$nama_produk.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,' Licensi','',0,'L');$pdf->Cell(50,7,': '.$no_pemohon.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Kemasan','',0,'L');$pdf->Cell(50,7,': '.$kemasan.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Type/Ukuran','',0,'L');$pdf->Cell(50,7,': '.$ukuran.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Kategori','',0,'L');$pdf->Cell(50,7,': '.$kategori_edar.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Sub Kategori','',0,'L');$pdf->Cell(50,7,': '.$sub_kategori_edar.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Nama (Sesuai CFR) ','',0,'L');$pdf->Cell(50,7,': '.$nama.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Nomor Jenis(Sesuai CFR)','',0,'L');$pdf->Cell(50,7,': '.$jenis.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Kelas','',0,'L');$pdf->Cell(50,7,': '.$kelas.'','',0,'L');
			$pdf->Ln(10);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(150,7,'Kelengkapan Administrasi','',0,'L');
			$pdf->Ln(5);
			$pdf->Ln(5);
			$pdf->Cell(6,7,'No','LRT',0,'L');
			$pdf->Cell(35,7,'Nama','LRT',0,'C');
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Ln();
			$pdf->Cell(6,7,'','LRB',0,'L');
			$pdf->Cell(35,7,'Kelengkapan','LRB',0,'C');
			$pdf->Cell(35,7,'Penilai','LRB',0,'C');
			$pdf->Cell(35,7,'Kaseksi','LRB',0,'C');
			$pdf->Cell(35,7,'Kasubdit','LRB',0,'C');
			$pdf->Cell(35,7,'Direktur','LRB',0,'C');
			$pdf->Ln();
			$sqlD = "
			SELECT
			kelengkapan_pkrt.nama_kelengkapan,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt_admin.status_penilai ='1' THEN 'Ada' else 'Tidak' END AS status_penilai,
			detail_cek_kelengkapan_data_edar_import_pkrt_admin.alasan_penilai,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt_admin.status_kaseksi ='1' THEN 'Ada' else 'Tidak' END AS status_kaseksi,
			detail_cek_kelengkapan_data_edar_import_pkrt_admin.alasan_kaseksi,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt_admin.status_kasubdit ='1' THEN 'Ada' else 'Tidak' END AS status_kasubdit,
			detail_cek_kelengkapan_data_edar_import_pkrt_admin.alasan_kasubdit,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt_admin.status_direktur ='1' THEN 'Ada' else 'Tidak' END AS status_direktur,
			detail_cek_kelengkapan_data_edar_import_pkrt_admin.alasan_direktur
			FROM
			detail_cek_kelengkapan_data_edar_import_pkrt_admin
			LEFT OUTER JOIN kelengkapan_pkrt ON(kelengkapan_pkrt.id_kelengkapan = detail_cek_kelengkapan_data_edar_import_pkrt_admin.id_kelengkapan)
			WHERE
			detail_cek_kelengkapan_data_edar_import_pkrt_admin.id_cek_1='".$id_cek_1."'
			";

			$hasilD = $adodb->Execute($sqlD);
			$no =1;
			while(! $hasilD->EOF){
				$pdf->Cell(6,3,'','LTR',0,'L');
				$pdf->Cell(35,3,'','LTR',0,'L');
    				$pdf->Cell(35,3,'','LTR',0,'L');
				$pdf->Cell(35,3,'','TRL',0,'L');
				$pdf->Cell(35,3,'','LTR',0,'L');
				$pdf->Cell(35,3,'','TRL',0,'L');
				$pdf->Ln();
				$nama_kelengkapan = $hasilD->fields['nama_kelengkapan'];
				$status_penilaix = $hasilD->fields['status_penilai'];
				$alasan_penilaix = $hasilD->fields['alasan_penilai'];
				$status_kaseksix = $hasilD->fields['status_kaseksi'];
				$alasan_kaseksix = $hasilD->fields['alasan_kaseksi'];
				$status_kasubditx = $hasilD->fields['status_kasubdit'];
				$alasan_kasubditx = $hasilD->fields['alasan_kasubdit'];
				$status_direkturx = $hasilD->fields['status_direktur'];
				$alasan_direkturx = $hasilD->fields['alasan_direktur'];
				$pdf->SetFont('Arial','',8);

					$jml_nama_kelengkapan = strlen($nama_kelengkapan);
					$jml_alasan_penilaix = strlen($alasan_penilaix);
					$jml_alasan_kaseksix = strlen($alasan_kaseksix);
					$jml_alasan_kasubditx = strlen($alasan_kasubditx);
					$jml_alasan_direkturx = strlen($alasan_direkturx);

					$max = max($jml_nama_kelengkapan,$jml_alasan_penilaix,$jml_alasan_kaseksix,$jml_alasan_kasubditx,$jml_alasan_direkturx);
					$jml_hight_arr = explode('.',$max/16);
					$jml_hight = $jml_hight_arr[0] * 7;

					for($a=0;$a<=$max;$a=$a+1){
						$g = $a%16;
						if(($g == 0)&&($a != 0)){
							$optional_arr['nama_penilai'] = TRUE;
							$optional_arr['date_1'] = TRUE;

							$optional_arr['nama_kaseksi'] = TRUE;
							$optional_arr['date_2'] = TRUE;

							$optional_arr['nama_direktur'] = TRUE;
							$optional_arr['date_4'] = TRUE;
							$optional_arr['status_direktur'] = TRUE;
							$noX=$no;
							if($noX==$noZ){
								$noX='';
							}else{
								$noZ=$noX;
							}

							$nama_kelengkapanY .= $nama_kelengkapan[$a];
							$status_penilaiY .= $status_penilaix[$a];
							$alasan_penilaiY .= $alasan_penilaix[$a];
							$status_kaseksiY .= $status_kaseksix[$a];
							$alasan_kaseksiY .= $alasan_kaseksix[$a];
							$status_kasubditY .= $status_kasubditx[$a];
							$alasan_kasubditY .= $alasan_kasubditx[$a];
							$status_direkturY .= $status_direkturz[$a];
							$alasan_direkturY .= $status_direkturz[$a];
							$pdf->Cell(6,3,''.$noX.'','LR',0,'L');
							$pdf->Cell(35,3,''.$nama_kelengkapanY.'1180','LR',0,'L');
							$pdf->Cell(35,3,''.$status_penilaiY.'','L',0,'L');
							$pdf->Cell(35,3,''.$status_kaseksiY.'','L',0,'L');
							$pdf->Cell(35,3,''.$status_kasubditY.'','LR',0,'L');
							$pdf->Cell(35,3,''.$status_direkturY.'','LR',0,'L');
							$pdf->Ln();
							$pdf->Cell(6,3,'','LR',0,'L');
							$pdf->Cell(35,3,'','L1280R',0,'L');
							$pdf->Cell(35,3,''.$alasan_penilaiY.'','LR',0,'L');
							$pdf->Cell(35,3,''.$alasan_kaseksiY.'','R',0,'L');
							$pdf->Cell(35,3,''.$alasan_kasubditY.'','R',0,'L');
							$pdf->Cell(35,3,''.$alasan_direkturY.'','R',0,'L');
							$pdf->Ln();
							$noY = '';
							$nama_kelengkapanY = '';
							$status_penilaiY = '';
							$alasan_penilaiY = '';
							$status_kaseksiY = '';
							$alasan_kaseksiY = '';
							$status_kasubditY = '';
							$alasan_kasubditY = '';
							$status_direkturY = '';
							$alasan_direkturY = '';
						}else{
							$noY .= $no[$a];
							$nama_kelengkapanY .= $nama_kelengkapan[$a];
							$status_penilaiY .= $status_penilaix[$a];
							$alasan_penilaiY .= $alasan_penilaix[$a];
							$status_kaseksiY .= $status_kaseksix[$a];
							$alasan_kaseksiY .= $alasan_kaseksix[$a];
							$status_kasubditY .= $status_kasubditx[$a];
							$alasan_kasubditY .= $alasan_kasubditx[$a];
							$status_direkturY .= $status_direkturx[$a];
       							$alasan_direkturY .= $alasan_direkturx[$a];
							$optional_arr['nama_penilai'] = TRUE;
							$optional_arr['date_1'] = TRUE;

							$optional_arr['nama_kaseksi'] = TRUE;
							$optional_arr['date_2'] = TRUE;

							$optional_arr['nama_direktur'] = TRUE;
							$optional_arr['date_4'] = TRUE;
							$optional_arr['status_direktur'] = TRUE;
						}
					}

					$noX=$no;
					if($noX==$noZ){
						$noX='';
					}else{
						$noZ=$noX;
					}

     							$pdf->Cell(6,3,''.$noX.'','LR',0,'L');
							$pdf->Cell(35,3,''.$nama_kelengkapanY.'','LR',0,'L');
							$pdf->Cell(35,3,''.$alasan_penilaiY.'','LR',0,'L');
							$pdf->Cell(35,3,''.$alasan_kaseksiY.'','R',0,'L');
							$pdf->Cell(35,3,''.$alasan_kasubditY.'','R',0,'L');
							$pdf->Cell(35,3,''.$alasan_direkturY.'','R',0,'L');

					$noY = '';
					$nama_kelengkapanY = '';
					$status_penilaiY = '';
					$alasan_penilaiY = '';
					$status_kaseksiY = '';
					$alasan_kaseksiY = '';
					$status_kasubditY = '';
					$alasan_kasubditY = '';
					$status_direkturY = '';
					$alasan_direkturY = '';
					$pdf->Ln();
					$pdf->Cell(6,3,'','LBR',0,'L');
					$pdf->Cell(35,3,'','LBR',0,'L');
					$pdf->Cell(35,3,'','LBR',0,'L');
					$pdf->Cell(35,3,'','BRL',0,'L');
					$pdf->Cell(35,3,'','LBR',0,'L');
					$pdf->Cell(35,3,'','BRL',0,'L');
					$pdf->Ln();

				$no = $no+1;
			$hasilD->MoveNext();
			}
			/* KELENGAKAPAN ADMINISTRASI AKHIR*/
			/* KELENGAKAPAN TEKNIS AWAL*/
			$pdf->Ln(10);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(150,7,'Kelengkapan Teknis','',0,'L');
			$pdf->Ln(5);
			$pdf->Ln(5);
			$pdf->Cell(6,7,'No','LRT',0,'L');
			$pdf->Cell(35,7,'Nama','LRT',0,'C');
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Cell(35,7,'Status','LRT',0,'C');
			$pdf->Ln();
			$pdf->Cell(6,7,'','LRB',0,'L');
			$pdf->Cell(35,7,'Kelengkapan','LRB',0,'C');
			$pdf->Cell(35,7,'Penilai','LRB',0,'C');
			$pdf->Cell(35,7,'Kaseksi','LRB',0,'C');
			$pdf->Cell(35,7,'Kasubdit','LRB',0,'C');
			$pdf->Cell(35,7,'Direktur','LRB',0,'C');
			$pdf->Ln();
			$sqlD = "
			SELECT
			kelengkapan_pkrt.nama_kelengkapan,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt_teknis.status_penilai ='1' THEN 'Ada' else 'Tidak' END AS status_penilai,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.alasan_penilai,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt_teknis.status_kaseksi ='1' THEN 'Ada' else 'Tidak' END AS status_kaseksi,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.alasan_kaseksi,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt_teknis.status_kasubdit ='1' THEN 'Ada' else 'Tidak' END AS status_kasubdit,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.alasan_kasubdit,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt_teknis.status_direktur ='1' THEN 'Ada' else 'Tidak' END AS status_direktur,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.alasan_direktur
			FROM
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis
			LEFT OUTER JOIN kelengkapan_pkrt ON(kelengkapan_pkrt.id_kelengkapan = detail_cek_kelengkapan_data_edar_import_pkrt_teknis.id_kelengkapan)
			WHERE
			detail_cek_kelengkapan_data_edar_import_pkrt_admin.id_cek_1='".$id_cek_1."'
			GROUP BY kelengkapan_pkrt.nama_kelengkapan,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.status_penilai,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.alasan_penilai,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.status_kaseksi,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.alasan_kaseksi,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.status_kasubdit,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.alasan_kasubdit,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.status_direktur,
			detail_cek_kelengkapan_data_edar_import_pkrt_teknis.alasan_direktur
			";

			$hasilD = $adodb->Execute($sqlD);
			$no =1;
			while(! $hasilD->EOF){
				$pdf->Cell(6,3,'','LTR',0,'L');
				$pdf->Cell(35,3,'','LTR',0,'L');
    				$pdf->Cell(35,3,'','LTR',0,'L');
				$pdf->Cell(35,3,'','TRL',0,'L');
				$pdf->Cell(35,3,'','LTR',0,'L');
				$pdf->Cell(35,3,'','TRL',0,'L');
				$pdf->Ln();
				$nama_kelengkapan = $hasilD->fields['nama_kelengkapan'];
				$status_penilaix = $hasilD->fields['status_penilai'];
				$alasan_penilaix = $hasilD->fields['alasan_penilai'];
				$status_kaseksix = $hasilD->fields['status_kaseksi'];
				$alasan_kaseksix = $hasilD->fields['alasan_kaseksi'];
				$status_kasubditx = $hasilD->fields['status_kasubdit'];
				$alasan_kasubditx = $hasilD->fields['alasan_kasubdit'];
				$status_direkturx = $hasilD->fields['status_direktur'];
				$alasan_direkturx = $hasilD->fields['alasan_direktur'];
				$pdf->SetFont('Arial','',8);

					$jml_nama_kelengkapan = strlen($nama_kelengkapan);
					$jml_alasan_penilaix = strlen($alasan_penilaix);
					$jml_alasan_kaseksix = strlen($alasan_kaseksix);
					$jml_alasan_kasubditx = strlen($alasan_kasubditx);
					$jml_alasan_direkturx = strlen($alasan_direkturx);

					$max = max($jml_nama_kelengkapan,$jml_alasan_penilaix,$jml_alasan_kaseksix,$jml_alasan_kasubditx,$jml_alasan_direkturx);
					$jml_hight_arr = explode('.',$max/16);
					$jml_hight = $jml_hight_arr[0] * 7;

					for($a=0;$a<=$max;$a=$a+1){
						$g = $a%16;
						if(($g == 0)&&($a != 0)){
							$optional_arr['nama_penilai'] = TRUE;
							$optional_arr['date_1'] = TRUE;

							$optional_arr['nama_kaseksi'] = TRUE;
							$optional_arr['date_2'] = TRUE;

							$optional_arr['nama_direktur'] = TRUE;
							$optional_arr['date_4'] = TRUE;
							$optional_arr['status_direktur'] = TRUE;
							$noX=$no;
							if($noX==$noZ){
								$noX='';
							}else{
								$noZ=$noX;
							}

							$nama_kelengkapanY .= $nama_kelengkapan[$a];
							$status_penilaiY .= $status_penilaix[$a];
							$alasan_penilaiY .= $alasan_penilaix[$a];
							$status_kaseksiY .= $status_kaseksix[$a];
							$alasan_kaseksiY .= $alasan_kaseksix[$a];
							$status_kasubditY .= $status_kasubditx[$a];
							$alasan_kasubditY .= $alasan_kasubditx[$a];
							$status_direkturY .= $status_direkturz[$a];
							$alasan_direkturY .= $status_direkturz[$a];
							$pdf->Cell(6,3,''.$noX.'','LR',0,'L');
							$pdf->Cell(35,3,''.$nama_kelengkapanY.'1180','LR',0,'L');
							$pdf->Cell(35,3,''.$status_penilaiY.'','L',0,'L');
							$pdf->Cell(35,3,''.$status_kaseksiY.'','L',0,'L');
							$pdf->Cell(35,3,''.$status_kasubditY.'','LR',0,'L');
							$pdf->Cell(35,3,''.$status_direkturY.'','LR',0,'L');
							$pdf->Ln();
							$pdf->Cell(6,3,'','LR',0,'L');
							$pdf->Cell(35,3,'','L1280R',0,'L');
							$pdf->Cell(35,3,''.$alasan_penilaiY.'','LR',0,'L');
							$pdf->Cell(35,3,''.$alasan_kaseksiY.'','R',0,'L');
							$pdf->Cell(35,3,''.$alasan_kasubditY.'','R',0,'L');
							$pdf->Cell(35,3,''.$alasan_direkturY.'','R',0,'L');
							$pdf->Ln();
							$noY = '';
							$nama_kelengkapanY = '';
							$status_penilaiY = '';
							$alasan_penilaiY = '';
							$status_kaseksiY = '';
							$alasan_kaseksiY = '';
							$status_kasubditY = '';
							$alasan_kasubditY = '';
							$status_direkturY = '';
							$alasan_direkturY = '';
						}else{
							$noY .= $no[$a];
							$nama_kelengkapanY .= $nama_kelengkapan[$a];
							$status_penilaiY .= $status_penilaix[$a];
							$alasan_penilaiY .= $alasan_penilaix[$a];
							$status_kaseksiY .= $status_kaseksix[$a];
							$alasan_kaseksiY .= $alasan_kaseksix[$a];
							$status_kasubditY .= $status_kasubditx[$a];
							$alasan_kasubditY .= $alasan_kasubditx[$a];
							$status_direkturY .= $status_direkturx[$a];
       							$alasan_direkturY .= $alasan_direkturx[$a];
							$optional_arr['nama_penilai'] = TRUE;
							$optional_arr['date_1'] = TRUE;

							$optional_arr['nama_kaseksi'] = TRUE;
							$optional_arr['date_2'] = TRUE;

							$optional_arr['nama_direktur'] = TRUE;
							$optional_arr['date_4'] = TRUE;
							$optional_arr['status_direktur'] = TRUE;
						}
					}

					$noX=$no;
					if($noX==$noZ){
						$noX='';
					}else{
						$noZ=$noX;
					}

     							$pdf->Cell(6,3,''.$noX.'','LR',0,'L');
							$pdf->Cell(35,3,''.$nama_kelengkapanY.'','LR',0,'L');
							$pdf->Cell(35,3,''.$alasan_penilaiY.'','LR',0,'L');
							$pdf->Cell(35,3,''.$alasan_kaseksiY.'','R',0,'L');
							$pdf->Cell(35,3,''.$alasan_kasubditY.'','R',0,'L');
							$pdf->Cell(35,3,''.$alasan_direkturY.'','R',0,'L');

					$noY = '';
					$nama_kelengkapanY = '';
					$status_penilaiY = '';
					$alasan_penilaiY = '';
					$status_kaseksiY = '';
					$alasan_kaseksiY = '';
					$status_kasubditY = '';
					$alasan_kasubditY = '';
					$status_direkturY = '';
					$alasan_direkturY = '';
					$pdf->Ln();
					$pdf->Cell(6,3,'','LBR',0,'L');
					$pdf->Cell(35,3,'','LBR',0,'L');
					$pdf->Cell(35,3,'','LBR',0,'L');
					$pdf->Cell(35,3,'','BRL',0,'L');
					$pdf->Cell(35,3,'','LBR',0,'L');
					$pdf->Cell(35,3,'','BRL',0,'L');
					$pdf->Ln();

				$no = $no+1;
			$hasilD->MoveNext();
			}

		$hasil->MoveNext();
		}
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Status Penilai','',0,'L');$pdf->Cell(50,7,': '.$status_penilai.', '.$nama_penilai.', '.$tgl1.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Status kaseksi','',0,'L');$pdf->Cell(50,7,': '.$status_kaseksi.', '.$nama_kaseksi.', '.$tgl2.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Status kasubdit','',0,'L');$pdf->Cell(50,7,': '.$status_kasubdit.', '.$nama_kasubdit.', '.$tgl3.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Status Direktur','',0,'L');$pdf->Cell(50,7,': '.$status_direktur.', '.$nama_direktur.', '.$tgl4.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'No SKK','',0,'L');$pdf->Cell(50,7,': ','',0,'L');
		$pdf->Output();


		$_form = $lamp;

		return $_form;
	}
	// handle event add cek_kelengkapan_data_edar_import_pkrt
	function add_cek_kelengkapan_data_edar_import_pkrt() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		//foreach ($record as $k => $v) $record[$k] = trim($v);
		$jml_kelengkapan = count($_POST['id_kelengkapan']);
		$jml_kelengkapan = $jml_kelengkapan +1;

		$jml_kelengkapan2 = count($_POST['id_kelengkapan2']);
		$jml_kelengkapan2 = $jml_kelengkapan2 +1;

		$read_penilai = $_POST['read_penilai'];
		if($read_penilai == 'on'){ $xread_penilai= '1';}else{ $xread_penilai='0';}

		$read_kaseksi = $_POST['read_kaseksi'];
		if($read_kaseksi == 'on'){ $xread_kaseksi= '1';}else{ $xread_kaseksi='0';}

		$read_kasubdit = $_POST['read_kasubdit'];
		if($read_kasubdit == 'on'){ $xread_kasubdit = '1';}else{ $xread_kasubdit ='0';}

		$read_direktur = $_POST['read_direktur'];
		if($read_direktur == 'on'){ $xread_direktur = '1';}else{ $xread_direktur ='0';}

			$record = array (
				'id_golongan' => $_POST['id_golongan'],
				'kemasan' => $_POST['kemasan'],
				'no_pemohon' => $_POST['no_pemohon'],
				'date_pemohon' => $this->parsedate(trim($_POST['date_pemohon'])),
				'status_penilai' => $_POST['status_penilai'],
				'nama_penilai' => $_POST['nama_penilai'],
				'date_1' => $this->parsedate(trim($_POST['date_1'])),
				'status_kaseksi' => $_POST['status_kaseksi'],
				'nama_kaseksi' => $_POST['nama_kaseksi'],
				'date_2' => $this->parsedate(trim($_POST['date_2'])),
				'status_kasubdit' => $_POST['status_kasubdit'],
				'nama_kasubdit' => $_POST['nama_kasubdit'],
				'date_3' => $this->parsedate(trim($_POST['date_3'])),
				'status_direktur' => $_POST['status_direktur'],
				'nama_direktur' => $_POST['nama_direktur'],
				'date_4' => $this->parsedate(trim($_POST['date_4'])),
				'keterangan' => $_POST['keterangan'],
				'ukuran' => $_POST['ukuran'],
				'nama_produk' => $_POST['nama_produk'],
				'id_kategori_edar' => $_POST['id_kategori_edar'],
				'id_sub_kategori_edar' => $_POST['id_sub_kategori_edar'],
				'nama' => $_POST['nama'],
				'jenis' => $_POST['jenis'],
				'no_tt' => $_POST['no_tt'],
				'indi_kaseksi' => $_POST['indi_kaseksi'],
				'indi_penilai' => $_POST['indi_penilai'],
				'indi_kasubdit' => $_POST['indi_kasubdit'],
				'indi_direktur' => $_POST['indi_direktur'],
				'read_penilai' => $xread_penilai,
				'read_kaseksi' => $xread_kaseksi,
				'read_kasubdit' => $xread_kasubdit,
				'read_direktur' => $xread_direktur,
				'insert_by' => $GLOBALS['ses']->loginid,
				'date_insert' => time()
			);
			cek_kelengkapan_data_edar_import_pkrt::add($record);

		$rsx = $adodb->Execute("SELECT id_cek_1 FROM cek_kelengkapan_data_edar_import_pkrt ORDER BY id_cek_1 DESC LIMIT 1");
		$id_cek_1 = $rsx->fields['id_cek_1'];

		include "class.detail_cek_kelengkapan_data_edar_import_pkrt_admin.inc.php";
		for($a=1;$a<=$jml_kelengkapan;$a++){
			$id_kelengkapanx = $_POST['id_kelengkapan'][$a];
			$status_penilaix = $_POST['status_penilaix'][$a];
			$status_kaseksix = $_POST['status_kaseksix'][$a];
			$status_kasubditx = $_POST['status_kasubditx'][$a];
			$status_direkturx = $_POST['status_direkturx'][$a];
			$alasan_penilaix = $_POST['alasan_penilaix'][$a];
			$alasan_kaseksix = $_POST['alasan_kaseksix'][$a];
			$alasan_kasubditx = $_POST['alasan_kasubditx'][$a];
			$alasan_direkturx = $_POST['alasan_direkturx'][$a];

				$record = array (
					'id_cek_1' => $id_cek_1,
					'id_kelengkapan' => $id_kelengkapanx,
					'status_penilai' => $status_penilaix,
					'status_kaseksi' => $status_kaseksix,
					'status_kasubdit' => $status_kasubditx,
					'status_direktur' => $status_direkturx,
					'alasan_penilai' => $alasan_penilaix,
					'alasan_kaseksi' => $alasan_kaseksix,
					'alasan_kasubdit' => $alasan_kasubditx,
					'alasan_direktur' => $alasan_direkturx
				);
				detail_cek_kelengkapan_data_edar_import_pkrt_admin::add($record);
		}
		
		
		

		include "class.detail_cek_kelengkapan_data_edar_import_pkrt_teknis.inc.php";
		for($a=1;$a<=$jml_kelengkapan2;$a++){
			$id_kelengkapanx2 = $_POST['id_kelengkapan2'][$a];
			$status_penilaix2 = $_POST['status_penilaix2'][$a];
			$status_kaseksix2 = $_POST['status_kaseksix2'][$a];
			$status_kasubditx2 = $_POST['status_kasubditx2'][$a];
			$status_direkturx2 = $_POSTgolongan['status_direkturx2'][$a];
			$alasan_penilaix2 = $_POST['alasan_penilaix2'][$a];
			$alasan_kaseksix2 = $_POST['alasan_kaseksix2'][$a];
			$alasan_kasubditx2 = $_POST['alasan_kasubditx2'][$a];
			$alasan_direkturx2 = $_POST['alasan_direkturx2'][$a];

				$record = array (
					'id_cek_1' => $id_cek_1,
					'id_kelengkapan' => $id_kelengkapanx2,
					'status_penilai' => $status_penilaix2,
					'status_kaseksi' => $status_kaseksix2,
					'status_kasubdit' => $status_kasubditx2,
					'status_direktur' => $status_direkturx2,
					'alasan_penilai' => $alasan_penilaix2,
					'alasan_kaseksi' => $alasan_kaseksix2,
					'alasan_kasubdit' => $alasan_kasubditx2,
					'alasan_direktur' => $alasan_direkturx2
				);
				detail_cek_kelengkapan_data_edar_import_pkrt_teknis::add($record);
		}


		$status = "Successfull $st '<b>{$record['id_cek_1']}</b>'";
		$this->log($status);

		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}

	// handle event update cek_kelengkapan_data_edar_import_pkrt
	function update_cek_kelengkapan_data_edar_import_pkrt() {
		//return $this->add_cek_kelengkapan_data_edar_import_pkrt();
		global ${$GLOBALS['post_vars']},$adodb,$ses;
		$bag = $ses->action;
		
		if($_POST['read_penilai']){
			$read_penilai = $_POST['read_penilai'];
			if($read_penilai == 'on'){ $xread_penilai= '1';}else{ $xread_penilai='0';}
		}else{
			if($bag=='penilai')$xread_golonganpenilai='0';

		}

		if($_POST['read_kaseksi']){
			$read_kaseksi = $_POST['read_kaseksi'];
			if($read_kaseksi == 'on'){ $xread_kaseksi= '1';}else{ $xread_kaseksi='0';}
		}else{
			if($bag=='kaseksi')$xread_kaseksi='0';

		}
		if($_POST['read_kasubdit']){
			$read_kasubdit = $_POST['read_kasubdit'];
			if($read_kasubdit == 'on'){ $xread_kasubdit = '1';}else{ $xread_kasubdit ='0';}
		}else{
			if($bag=='kasubdit')$xread_kasubdit='0';

		}

		if($_POST['read_direktur']){
			$read_direktur = $_POST['read_direktur'];
			if($read_direktur == 'on'){ $xread_direktur = '1';}else{ $xread_direktur ='0';}
		}else{
			if($bag=='direktur')$xread_direktur='0';

		}

		$record = array (
			'id_cek_1' => ${$GLOBALS['post_vars']}['oldpkvalue']
		);
		$jml_kelengkapan = count($_POST['id_kelengkapan']);
		$jml_kelengkapan = $jml_kelengkapan +1;

		$jml_kelengkapan2 = count($_POST['id_kelengkapan2']);
		$jml_kelengkapan2 = $jml_kelengkapan2 +1;

		$_block = new block();
		$_block->set_config('title', ('Update Cek Kelengkapan Izin Edar PKRT Import Status'));
		$_block->set_config('width', 595);
		if ($result = cek_kelengkapan_data_edar_import_pkrt::get($record)) {
			$record = $result[0];
			if (${$GLOBALS['post_vars']}['id_golongan']!='') $record['id_golongan'] = $_POST['id_golongan'];
			if (${$GLOBALS['post_vars']}['kemasan']!='') $record['kemasan'] = $_POST['kemasan'];
			if (${$GLOBALS['post_vars']}['no_pemohon']!='') $record['no_pemohon'] =  $_POST['no_pemohon'];
			if (${$GLOBALS['post_vars']}['date_pemohon']!='') $record['date_pemohon'] = $this->parsedate(trim($_POST['date_pemohon']));
			if (${$GLOBALS['post_vars']}['status_penilai']!='') $record['status_penilai'] = $_POST['status_penilai'];
			if (${$GLOBALS['post_vars']}['nama_penilai']!='') $record['nama_penilai'] = $_POST['nama_penilai'];
			if (${$GLOBALS['post_vars']}['date_1']!='') $record['date_1'] = $this->parsedate(trim($_POST['date_1']));
			if (${$GLOBALS['post_vars']}['status_kaseksi']!='') $record['status_kaseksi'] = $_POST['status_kaseksi'];
			if (${$GLOBALS['post_vars']}['nama_kaseksi']!='') $record['nama_kaseksi'] = $_POST['nama_kaseksi'];
			if (${$GLOBALS['post_vars']}['date_2']!='') $record['date_2'] = $this->parsedate(trim($_POST['date_2']));
			if (${$GLOBALS['post_vars']}['status_kasubdit']!='') $record['status_kasubdit'] = $_POST['status_kasubdit'];
			if (${$GLOBALS['post_vars']}['nama_kasubdit']!='') $record['nama_kasubdit'] = $_POST['nama_kasubdit'];
			if (${$GLOBALS['post_vars']}['date_3']!='') $record['date_3'] = $this->parsedate(trim($_POST['date_3']));
			if (${$GLOBALS['post_vars']}['status_direktur']!='') $record['status_direktur'] = $_POST['status_direktur'];
			if (${$GLOBALS['post_vars']}['nama_direktur']!='') $record['nama_direktur'] = $_POST['nama_direktur'];
			if (${$GLOBALS['post_vars']}['date_4']!='') $record['date_4'] = $this->parsedate(trim($_POST['date_4']));
			if (${$GLOBALS['post_vars']}['keterangan']!='') $record['keterangan'] = $_POST['keterangan'];
			if (${$GLOBALS['post_vars']}['ukuran']!='') $record['ukuran'] = $_POST['ukuran'];
			if (${$GLOBALS['post_vars']}['nama_produk']!='') $record['nama_produk'] = $_POST['nama_produk'];
			if (${$GLOBALS['post_vars']}['id_kategori_edar']!='') $record['id_kategori_edar'] = $_POST['id_kategori_edar'];
			if (${$GLOBALS['post_vars']}['id_sub_kategori_edar']!='') $record['id_sub_kategori_edar'] = $_POST['id_sub_kategori_edar'];
			if (${$GLOBALS['post_vars']}['nama']!='') $record['nama'] = $_POST['nama'];
			if (${$GLOBALS['post_vars']}['jenis']!='') $record['jenis'] = $_POST['jenis'];
			if (${$GLOBALS['post_vars']}['no_tt']!='') $record['no_tt'] = $_POST['no_tt'];
			if (${$GLOBALS['post_vars']}['indi_kaseksi']!='') $record['indi_kaseksi'] = $_POST['indi_kaseksi'];
			if (${$GLOBALS['post_vars']}['indi_penilai']!='') $record['indi_penilai'] = $_POST['indi_penilai'];
			if (${$GLOBALS['post_vars']}['indi_kasubdit']!='') $record['indi_kasubdit'] = $_POST['indi_kasubdit'];
			if (${$GLOBALS['post_vars']}['indi_direktur']!='') $record['indi_direktur'] = $_POST['indi_direktur'];
			if ($xread_penilai!='') $record['read_penilai'] = $xread_penilai;
			if ($xread_kaseksi!='') $record['read_kaseksi'] = $xread_kaseksi;
			if ($xread_kasubdit!='') $record['read_kasubdit'] = $xread_kasubdit;
			if ($xread_direktur!='') $record['read_direktur'] = $xread_direktur;
			if (${$GLOBALS['post_vars']}['insert_by']!='') $record['insert_by'] = $GLOBALS['ses']->loginid;
			if (${$GLOBALS['post_vars']}['date_insert']!='') $record['date_insert'] = time();
			eval($this->save_config);
			if (cek_kelengkapan_data_edar_import_pkrt::update($record)) {
				$adodb->Execute("DELETE FROM detail_cek_kelengkapan_data_edar_import_pkrt_admin WHERE id_cek_1 = '".$_POST['oldpkvalue']."'");
				$adodb->Execute("DELETE FROM detail_cek_kelengkapan_data_edar_import_pkrt_teknis WHERE id_cek_1 = '".$_POST['oldpkvalue']."'");
				//$rsx = $adodb->Execute("SELECT id_cek_1 FROM cek_kelengkapan_data_edar_import_pkrt ORDER BY id_cek_1 DESC LIMIT 1");
				$id_cek_1 = $_POST['oldpkvalue'];

			include "class.detail_cek_kelengkapan_data_edar_import_pkrt_admin.inc.php";
			for($a=1;$a<=$jml_kelengkapan;$a++){
			$id_kelengkapanx = $_POST['id_kelengkapan'][$a];
			$status_penilaix = $_POST['status_penilaix'][$a];
			$status_kaseksix = $_POST['status_kaseksix'][$a];
			$status_kasubditx = $_POST['status_kasubditx'][$a];
			$status_direkturx = $_POST['status_direkturx'][$a];
			$alasan_penilaix = $_POST['alasan_penilaix'][$a];
			$alasan_kaseksix = $_POST['alasan_kaseksix'][$a];
			$alasan_kasubditx = $_POST['alasan_kasubditx'][$a];
			$alasan_direkturx = $_POST['alasan_direkturx'][$a];

				$record = array (
					'id_cek_1' => $id_cek_1,
					'id_kelengkapan' => $id_kelengkapanx,
					'status_penilai' => $status_penilaix,
					'status_kaseksi' => $status_kaseksix,
					'status_kasubdit' => $status_kasubditx,
					'status_direktur' => $status_direkturx,
					'alasan_penilai' => $alasan_penilaix,
					'alasan_kaseksi' => $alasan_kaseksix,
					'alasan_kasubdit' => $alasan_kasubditx,
					'alasan_direktur' => $alasan_direkturx
				);
				detail_cek_kelengkapan_data_edar_import_pkrt_admin::add($record);
		}
		
		
		//print_r($_POST);exit();

		include "class.detail_cek_kelengkapan_data_edar_import_pkrt_teknis.inc.php";
		for($a=1;$a<=$jml_kelengkapan2;$a++){
			$id_kelengkapanx2 = $_POST['id_kelengkapan2'][$a];
			$status_penilaix2 = $_POST['status_penilaix2'][$a];
			$status_kaseksix2 = $_POST['status_kaseksix2'][$a];
			$status_kasubditx2 = $_POST['status_kasubditx2'][$a];
			$status_direkturx2 = $_POST['status_direkturx2'][$a];
			$alasan_penilaix2 = $_POST['alasan_penilaix2'][$a];
			$alasan_kaseksix2 = $_POST['alasan_kaseksix2'][$a];
			$alasan_kasubditx2 = $_POST['alasan_kasubditx2'][$a];
			$alasan_direkturx2 = $_POST['alasan_direkturx2'][$a];

				$record = array (
					'id_cek_1' => $id_cek_1,
					'id_kelengkapan' => $id_kelengkapanx2,
					'status_penilai' => $status_penilaix2,
					'status_kaseksi' => $status_kaseksix2,
					'status_kasubdit' => $status_kasubditx2,
					'status_direktur' => $status_direkturx2,
					'alasan_penilai' => $alasan_penilaix2,
					'alasan_kaseksi' => $alasan_kaseksix2,
					'alasan_kasubdit' => $alasan_kasubditx2,
					'alasan_direktur' => $alasan_direkturx2
				);
				detail_cek_kelengkapan_data_edar_import_pkrt_teknis::add($record);
		}


				$_block->parse(array('+<font color=green><b>'.__('Successfull Updated').'</b></font>'));
				return $_block->get_str();
			}
		}
		$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
		$_block->parse(array('+<font color=red><b>'.__('Failed Updated').'</b></font>'.' :'.__('Data doesn\'t exists')));
		return  $_block->get_str();
	}

	// handle delete cek_kelengkapan_data_edar_import_pkrt
	function delete_cek_kelengkapan_data_edar_import_pkrt() {
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
					$query4 .= "$myvar='".urldecode($myval)."'";
				}
			}
			if ($query2) $query .= "($query2)";
			if ($query4) $query3 .= "($query4)";
		}

		global $self_close_js;
		if ($query){$optional_arr['nama_penilai'] = TRUE;
					$optional_arr['date_1'] = TRUE;

					$optional_arr['nama_kaseksi'] = TRUE;
					$optional_arr['date_2'] = TRUE;

					$optional_arr['nama_direktur'] = TRUE;
					$optional_arr['date_4'] = TRUE;
					$optional_arr['status_direktur'] = TRUE;
            $success = $adodb->Execute("delete from cek_kelengkapan_data_edar_import_pkrt where ".$query);
            $success .= $adodb->Execute("DELETE FROM detail_cek_kelengkapan_data_edar_import_pkrt_admin WHERE id_cek_1 = '".$_POST['oldpkvalue']."'");
            $success .= $adodb->Execute("DELETE FROM detail_cek_kelengkapan_data_edar_import_pkrt_teknis WHERE id_cek_1 = '".$_POST['oldpkvalue']."'");
		}
                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'cek_kelengkapan_data_edar_import_pkrt <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'cek_kelengkapan_data_edar_import_pkrt <font color=red>'.$query.'</font>';
                }
                $this->log($status);

                $_block = new block();
                $_block->set_config('title', ('Delete Cek Kelengkapan Izin Edar PKRT Import Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list cek_kelengkapan_data_edar_import_pkrt
	function list_cek_kelengkapan_data_edar_import_pkrt($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']},$ses;
		$bag = $ses->action;
		$user = $ses->loginid;

		if($bag =='penilai'){
			$sql = "SELECT
			cek_kelengkapan_data_edar_import_pkrt.id_cek_1,
			cek_kelengkapan_data_edar_import_pkrt.no_tt,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as urut_no_tt,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as alamat,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as subdit,
			cek_kelengkapan_data_edar_import_pkrt.no_pemohon,
			cek_kelengkapan_data_edar_import_pkrt.kemasan,
			cek_kelengkapan_data_edar_import_pkrt.ukuran,
			cek_kelengkapan_data_edar_import_pkrt.nama_produk,
			cek_kelengkapan_data_edar_import_pkrt.id_golongan as golongan,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek_kelengkapan_data_edar_import_pkrt.nama_penilai,
			cek_kelengkapan_data_edar_import_pkrt.date_1,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek_kelengkapan_data_edar_import_pkrt.nama_kaseksi,
			cek_kelengkapan_data_edar_import_pkrt.date_2,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.nama_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.date_3,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			cek_kelengkapan_data_edar_import_pkrt.nama_direktur,
			cek_kelengkapan_data_edar_import_pkrt.date_4,
			cek_kelengkapan_data_edar_import_pkrt.keterangan,
			cek_kelengkapan_data_edar_import_pkrt.insert_by,
			cek_kelengkapan_data_edar_import_pkrt.date_insert,
			Case WHEN cek_kelengkapan_data_edar_import_pkrt.read_penilai='0' THEN 'Unread'
			else 'Read' END AS read_penilai,
			cek_kelengkapan_data_edar_import_pkrt.id_cek_1 as detail
			FROM cek_kelengkapan_data_edar_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.no_tt = cek_kelengkapan_data_edar_import_pkrt.no_tt)
			WHERE
			cek_kelengkapan_data_edar_import_pkrt.nama_penilai ='' OR cek_kelengkapan_data_edar_import_pkrt.nama_penilai = '$user'
			";
		}

		if($bag =='kaseksi'){
			$sql = "SELECT
			cek_kelengkapan_data_edar_import_pkrt.id_cek_1,
			cek_kelengkapan_data_edar_import_pkrt.no_tt,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as urut_no_tt,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as alamat,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as subdit,
			cek_kelengkapan_data_edar_import_pkrt.no_pemohon,
			cek_kelengkapan_data_edar_import_pkrt.kemasan,
			cek_kelengkapan_data_edar_import_pkrt.ukuran,
			cek_kelengkapan_data_edar_import_pkrt.nama_produk,
			cek_kelengkapan_data_edar_import_pkrt.id_golongan as golongan,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek_kelengkapan_data_edar_import_pkrt.nama_penilai,
			cek_kelengkapan_data_edar_import_pkrt.date_1,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek_kelengkapan_data_edar_import_pkrt.nama_kaseksi,
			cek_kelengkapan_data_edar_import_pkrt.date_2,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.nama_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.date_3,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			cek_kelengkapan_data_edar_import_pkrt.nama_direktur,
			cek_kelengkapan_data_edar_import_pkrt.date_4,
			cek_kelengkapan_data_edar_import_pkrt.keterangan,
			cek_kelengkapan_data_edar_import_pkrt.insert_by,
			cek_kelengkapan_data_edar_import_pkrt.date_insert,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.indi_kaseksi='0' THEN 'Return'
			else 'OK' END AS indi_kaseksi,
			Case WHEN cek_kelengkapan_data_edar_import_pkrt.read_kaseksi='0' THEN 'Unread'
			else 'Read' END AS read_kaseksi,
			Case WHEN cek_kelengkapan_data_edar_import_pkrt.read_penilai='0' THEN 'Unread'
			else 'Read' END AS read_penilai,
			cek_kelengkapan_data_edar_import_pkrt.id_cek_1 as detail
			FROM cek_kelengkapan_data_edar_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.no_tt = cek_kelengkapan_data_edar_import_pkrt.no_tt)
			WHERE
			cek_kelengkapan_data_edar_import_pkrt.nama_kaseksi ='' OR cek_kelengkapan_data_edar_import_pkrt.nama_kaseksi = '$user'
			ORDER BY cek_kelengkapan_data_edar_import_pkrt.read_kaseksi
			";
		}
		
		if($bag =='kasubdit'){
			$sql = "SELECT
			cek_kelengkapan_data_edar_import_pkrt.id_cek_1,
			cek_kelengkapan_data_edar_import_pkrt.no_tt,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as urut_no_tt,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as alamat,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as subdit,
			cek_kelengkapan_data_edar_import_pkrt.no_pemohon,
			cek_kelengkapan_data_edar_import_pkrt.kemasan,
			cek_kelengkapan_data_edar_import_pkrt.ukuran,
			cek_kelengkapan_data_edar_import_pkrt.nama_produk,
			cek_kelengkapan_data_edar_import_pkrt.id_golongan as golongan,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek_kelengkapan_data_edar_import_pkrt.nama_penilai,
			cek_kelengkapan_data_edar_import_pkrt.date_1,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek_kelengkapan_data_edar_import_pkrt.nama_kaseksi,
			cek_kelengkapan_data_edar_import_pkrt.date_2,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.nama_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.date_3,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			cek_kelengkapan_data_edar_import_pkrt.nama_direktur,
			cek_kelengkapan_data_edar_import_pkrt.date_4,
			cek_kelengkapan_data_edar_import_pkrt.keterangan,
			cek_kelengkapan_data_edar_import_pkrt.insert_by,
			cek_kelengkapan_data_edar_import_pkrt.date_insert,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.indi_kasubdit='0' THEN 'Return'
			else 'OK' END AS indi_kasubdit,
			Case WHEN cek_kelengkapan_data_edar_import_pkrt.read_kasubdit='0' THEN 'Unread'
			else 'Read' END AS read_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.id_cek_1 as detail
			FROM cek_kelengkapan_data_edar_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.no_tt = cek_kelengkapan_data_edar_import_pkrt.no_tt)
			WHERE
			cek_kelengkapan_data_edar_import_pkrt.nama_kasubdit ='' OR cek_kelengkapan_data_edar_import_pkrt.nama_kasubdit='$user'
			ORDER BY cek_kelengkapan_data_edar_import_pkrt.read_kasubdit
			";
		}

		if($bag =='direktur'){
			$sql = "SELECT
			cek_kelengkapan_data_edar_import_pkrt.id_cek_1,
			cek_kelengkapan_data_edar_import_pkrt.no_tt,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as urut_no_tt,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as alamat,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as subdit,
			cek_kelengkapan_data_edar_import_pkrt.no_pemohon,
			cek_kelengkapan_data_edar_import_pkrt.kemasan,
			cek_kelengkapan_data_edar_import_pkrt.ukuran,
			cek_kelengkapan_data_edar_import_pkrt.nama_produk,
			cek_kelengkapan_data_edar_import_pkrt.id_golongan as golongan,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek_kelengkapan_data_edar_import_pkrt.nama_penilai,
			cek_kelengkapan_data_edar_import_pkrt.date_1,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek_kelengkapan_data_edar_import_pkrt.nama_kaseksi,
			cek_kelengkapan_data_edar_import_pkrt.date_2,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.nama_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.date_3,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			cek_kelengkapan_data_edar_import_pkrt.nama_direktur,
			cek_kelengkapan_data_edar_import_pkrt.date_4,
			cek_kelengkapan_data_edar_import_pkrt.keterangan,
			cek_kelengkapan_data_edar_import_pkrt.insert_by,
			cek_kelengkapan_data_edar_import_pkrt.date_insert,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.indi_direktur='0' THEN 'Return'
			else 'OK' END AS indi_direktur,
			Case WHEN cek_kelengkapan_data_edar_import_pkrt.read_kasubdit='0' THEN 'Unread'
			else 'Read' END AS read_direktur,
			cek_kelengkapan_data_edar_import_pkrt.id_cek_1 as detail
			FROM cek_kelengkapan_data_edar_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.no_tt = cek_kelengkapan_data_edar_import_pkrt.no_tt)
			WHERE
			cek_kelengkapan_data_edar_import_pkrt.nama_direktur ='' OR cek_kelengkapan_data_edar_import_pkrt.nama_direktur ='$user'
			ORDER BY cek_kelengkapan_data_edar_import_pkrt.read_direktur
			";
		}

		if($bag =='admin'){
			$sql = "SELECT
			cek_kelengkapan_data_edar_import_pkrt.id_cek_1,
			cek_kelengkapan_data_edar_import_pkrt.no_tt,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as urut_no_tt,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as alamat,
			cek_kelengkapan_data_edar_import_pkrt.no_tt as subdit,
			cek_kelengkapan_data_edar_import_pkrt.no_pemohon,
			cek_kelengkapan_data_edar_import_pkrt.kemasan,
			cek_kelengkapan_data_edar_import_pkrt.ukuran,
			cek_kelengkapan_data_edar_import_pkrt.nama_produk,
			cek_kelengkapan_data_edar_import_pkrt.id_golongan as golongan,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek_kelengkapan_data_edar_import_pkrt.nama_penilai,
			cek_kelengkapan_data_edar_import_pkrt.date_1,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek_kelengkapan_data_edar_import_pkrt.nama_kaseksi,
			cek_kelengkapan_data_edar_import_pkrt.date_2,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.nama_kasubdit,
			cek_kelengkapan_data_edar_import_pkrt.date_3,
			CASE WHEN cek_kelengkapan_data_edar_import_pkrt.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			cek_kelengkapan_data_edar_import_pkrt.nama_direktur,
			cek_kelengkapan_data_edar_import_pkrt.date_4,
			cek_kelengkapan_data_edar_import_pkrt.keterangan,
			cek_kelengkapan_data_edar_import_pkrt.insert_by,
			cek_kelengkapan_data_edar_import_pkrt.date_insert,
			cek_kelengkapan_data_edar_import_pkrt.id_cek_1 as detail
			FROM cek_kelengkapan_data_edar_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.no_tt = cek_kelengkapan_data_edar_import_pkrt.no_tt)
			";
		}

		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;
		$optional_arr['detail'] = FALSE;

		$vsel_arr = array (
			'id_cek_1' => TRUE,
			'name' => TRUE,
			'detail' => FALSE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();

		$eval_arr['no_tt'] = '
		$f = "%s";

		$Aql = "
		SELECT
		pendaftar_edar_pkrt_import_pkrt.nama_pabrik
		FROM
		pendaftar_edar_pkrt_import_pkrt
		LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
		WHERE tt_1_edar_pkrt_import.no_tt =\'$f\'";

		global $adodb;
		$A = $adodb->Execute($Aql);
		$FA = $A->fields[\'nama_pabrik\'];
		$str .=$FA;
		';
		if($bag =='kaseksi'){

			$eval_arr['urut_no_tt'] = '
			$f = "%s";
			$Aql = "
			SELECT
			tt_1_edar_pkrt_import.urut_no_tt
			FROM
			pendaftar_edar_pkrt_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
			WHERE tt_1_edar_pkrt_import.no_tt =\'$f\'";

			global $adodb;
			$A = $adodb->Execute($Aql);
			$FA = $A->fields[\'urut_no_tt\'];
			
			$rsh=$adodb->Execute("SELECT indi_kaseksi,read_kaseksi FROM cek_kelengkapan_data_edar_import_pkrt WHERE no_tt=\'$f\'");
			$indi_kaseksi = $rsh->fields[indi_kaseksi];
			$read_kaseksi = $rsh->fields[read_kaseksi];

			if($read_kaseksi=="1"){
				if($indi_kaseksi=="1"){
					$str .="<div align=center>&nbsp;$FA</div>";
				}else{
					if($indi_kaseksi =="0"){
					$str .="<div align=center><font color=blue>&nbsp;$FA</font></div>";
					}else{
					$str .="<div align=center>&nbsp;$FA</div>";
					}
				}
			}else{
				$str .="<div align=center><font color=red>&nbsp;$FA</font></div>";
			}
			';
		}

		if($bag =='kasubdit'){

			$eval_arr['urut_no_tt'] = '
			$f = "%s";
			$Aql = "
			SELECT
			tt_1_edar_pkrt_import.urut_no_tt
			FROM
			pendaftar_edar_pkrt_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
			WHERE tt_1_edar_pkrt_import.no_tt =\'$f\'";

			global $adodb;
			$A = $adodb->Execute($Aql);
			$FA = $A->fields[\'urut_no_tt\'];

			$rsh=$adodb->Execute("SELECT indi_kasubdit,read_kasubdit FROM cek_kelengkapan_data_edar_import_pkrt WHERE no_tt=\'$f\'");
			$indi_kasubdit = $rsh->fields[indi_kasubdit];
			$read_kasubdit = $rsh->fields[read_kasubdit];

			if($read_kasubdit =="1"){
				if($indi_kasubdit =="1"){
					$str .="<div align=center>&nbsp;$FA</div>";
				}else{
					if($indi_kasubdit =="0"){
					$str .="<div align=center><font color=blue>&nbsp;$FA</font></div>";
					}else{
					$str .="<div align=center>&nbsp;$FA</div>";
					}
				}
			}else{
				$str .="<div align=center><font color=red>&nbsp;$FA</font></div>";
			}
			';
		}
		
		if($bag =='direktur'){

			$eval_arr['urut_no_tt'] = '
			$f = "%s";
			$Aql = "
			SELECT
			tt_1_edar_pkrt_import.urut_no_tt
			FROM
			pendaftar_edar_pkrt_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
			WHERE tt_1_edar_pkrt_import.no_tt =\'$f\'";

			global $adodb;
			$A = $adodb->Execute($Aql);
			$FA = $A->fields[\'urut_no_tt\'];

			$rsh=$adodb->Execute("SELECT indi_direktur,read_direktur FROM cek_kelengkapan_data_edar_import_pkrt WHERE no_tt=\'$f\'");
			$indi_direktur = $rsh->fields[indi_direktur];
			$read_k_1 = $rsx->fieldsdirektur = $rsh->fields[read_direktur];

			if($read_direktur =="1"){
				if($indi_direktur =="1"){
					$str .="<div align=center>&nbsp;$FA</div>";
				}else{
					if($indi_direktur =="0"){
					$str .="<div align=center><font color=blue>&nbsp;$FA</font></div>";
					}else{
					$str .="<div align=center>&nbsp;$FA</div>";
					}
				}
			}else{
				$str .="<div align=center><font color=red>&nbsp;$FA</font></div>";
			}
			';
		}
		
		if($bag =='admin'){

			$eval_arr['urut_no_tt'] = '
			$f = "%s";
			$Aql = "
			SELECT
			tt_1_ak_1 = $rsx->fieldslkes.urut_no_tt
			FROM
			pendaftar_edar_pkrt_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
			WHERE tt_1_edar_pkrt_import.no_tt =\'$f\'";

			global $adodb;
			$A = $adodb->Execute($Aql);
			$FA = $A->fields[\'urut_no_tt\'];
			$str .="<div align=center>&nbsp;$FA</div>";
			';
		}

		if($bag =='penilai'){

			$eval_arr['urut_no_tt'] = '
			$f = "%s";
			$Aql = "
			SELECT
			tt_1_ak_1 = $rsx->fieldslkes.urut_no_tt
			FROM
			pendaftar_edar_pkrt_import_pkrt
			LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
			WHERE tt_1_edar_pkrt_import.no_tt =\'$f\'";

			global $adodb;
			$A = $adodb->Execute($Aql);
			$FA = $A->fields[\'urut_no_tt\'];
			$str .="<div align=center>&nbsp;$FA</div>";
			';
		}


		$eval_arr['alamat'] = '
		$b = "%s";

		$Aql = "
		SELECT
		pendaftar_edar_pkrt_import_pkrt.alamat_pabrik
		FROM
		pendaftar_edar_pkrt_import_pkrt
		LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
		WHERE tt_1_edar_pkrt_import.no_tt =\'$b\'";

		global $adodb;
		$A = $adodb->Execute($Aql);
		$FA = $A->fields[\'alamat_pabrik\'];
		$str .=$FA;
		';

		$eval_arr['subdit'] = '
		$c = "%s";

		$Bql = "
		SELECT
		subdit.subdit
		FROM
		pendaftar_edar_pkrt_import_pkrt
		LEFT OUTER JOIN tt_1_edar_pkrt_import ON(tt_1_edar_pkrt_import.kode_pendaftar_edar_pkrt_import_pkrt = pendaftar_edar_pkrt_import_pkrt.kode_pendaftar_edar_pkrt_import_pkrt)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_edar_pkrt_import.kode_subdit)
		WHERE tt_1_edar_pkrt_import.no_tt =\'$c\'";

		global $adodb;
		$C = $adodb->Execute($Bql);
		$FC = $C->fields[\'subdit\'];
		$str .=$FC;
		';
		
		$eval_arr['golongan'] = '
		$E = "%s";

		$Aql = "
		SELECT
		golongan
		FROM
		gol_edar
		WHERE id_golongan =\'$E\'";

		global $adodb;
		$A = $adodb->Execute($Aql);
		$FA = $A->fields[\'golongan\'];
		$str .=$FA;
		';

		
		$eval_arr['detail'] = '
		$USql = "
			SELECT
			kelengkapan_pkrt.nama_kelengkapan,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt.status_penilai =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_penilai,
			detail_cek_kelengkapan_data_edar_import_pkrt.alasan_penilai,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt.status_kaseksi =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_kaseksi,
			detail_cek_kelengkapan_data_edar_import_pkrt.alasan_kaseksi,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt.status_kasubdit =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_kasubdit,
			detail_cek_kelengkapan_data_edar_import_pkrt.alasan_kasubdit,
			CASE WHEN detail_cek_kelengkapan_data_edar_import_pkrt.status_direktur =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_direktur,
			detail_cek_kelengkapan_data_edar_import_pkrt.alasan_direktur
			FROM
			detail_cek_kelengkapan_data_edar_import_pkrt
			LEFT OUTER JOIN kelengkapan_pkrt ON(kelengkapan_pkrt.id_kelengkapan = detail_cek_kelengkapan_data_edar_import_pkrt.id_kelengkapan)
			WHERE
			id_cek_1=\'%s\' AND detail_cek_kelengkapan_data_edar_import_pkrt.alasan_kaseksi IS NOT NULL
			";
			global $adodb;

      			$str .="<table cellspacing=1 cellpadding=1><tr align=center class=title_table><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Kelengkapan</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Status Penilai</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Alasan Penilai</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Status Kaseksi</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Alasan Kaseksi</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Status Kasubdit</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Alasan Kasubdit</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Status Direktur</b></td><td style=\'border-width:1px;border-style:solid;border-color:#000000\'><b></font>Alasan Direktur</b></td></tr>";
			$S = $adodb->Execute($USql);
			$c =0;
			while(! $S->EOF){
			$c= $c+1;
			$FA = $S->fields[\'nama_kelengkapan\'];
			$FB = $S->fields[\'status_penilai\'];
			$FC = $S->fields[\'alasan_penilai\'];
			$FD = $S->fields[\'status_kaseksi\'];
			$FE = $S->fields[\'alasan_kaseksi\'];
			$FF = $S->fields[\'status_kasubdit\'];
			$FG = $S->fields[\'alasan_kasubdit\'];
			$FH = $S->fields[\'status_direktur\'];
			$FI = $S->fields[\'alasan_direktur\'];

   			$str .= "<tr><td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$c.".".$FA."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FB."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FC."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FD."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FE."</td>";
			$str .= "<td style=\'border-width:1px;boder-style:solid;border-color:#000000\'>&nbsp;".$FF."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FG."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FH."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FI."</td></tr>";
			$S->MoveNext();
			}
   		$str .="</table>";
		';

		$pk = array (
			'id_cek_1' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
  		if($bag=='kaseksi'){
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 800, 600, null, null, \'add_cek_kelengkapan_data_edar_import_pkrt\');'.
			'win.focus()',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
		}

//		}
//		if ($this->get_permission('fill_this')) {

			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 800, 600, null, null, \'edit_cek_kelengkapan_data_edar_import_pkrt\');'.
			'win.focus()',
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));

			$view_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\', 640, 480, null, null, \'view_skk\');'.
			'win.focus()',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"link+"));
//		}
//		if ($this->get_permission('fill_this')) {

			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' .
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_cek_kelengkapan_data_edar_import_pkrt\')'.
			'win.focus()):' .
			'alert(\''.__('Cancelling Delete').'\');',
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_cek_kelengkapan_data_edar_import_pkrt\');'.
			'win.focus()',
			"label"=>__('Print'),
			"type"=>"button",
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->cek_kelengkapan_data_edar_import_pkrt_label;
		$config = array (
			'id'		=> 'cek_kelengkapan_data_edar_import_pkrt',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $add_anchor,
			'edit_anchor'	=> "<nobr>".$edit_anchor."|".$view_anchor,
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Cek Kelengkapan Izin Edar PKRT Import'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print cek_kelengkapan_data_edar_import_pkrt
	function print_cek_kelengkapan_data_edar_import_pkrt() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_cek_kelengkapan_data_edar_import_pkrt($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$cek_kelengkapan_data_edar_import_pkrt_controller = new cek_kelengkapan_data_edar_import_pkrt_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $cek_kelengkapan_data_edar_import_pkrt_controller->add_cek_kelengkapan_data_edar_import_pkrt_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $cek_kelengkapan_data_edar_import_pkrt_controller->add_cek_kelengkapan_data_edar_import_pkrt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad();OnChangeno_tt()"';
			$out_content = $cek_kelengkapan_data_edar_import_pkrt_controller->update_cek_kelengkapan_data_edar_import_pkrt_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $cek_kelengkapan_data_edar_import_pkrt_controller->update_cek_kelengkapan_data_edar_import_pkrt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $cek_kelengkapan_data_edar_import_pkrt_controller->view_cek_kelengkapan_data_edar_import_pkrt_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $cek_kelengkapan_data_edar_import_pkrt_controller->delete_cek_kelengkapan_data_edar_import_pkrt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import_pkrt':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $cek_kelengkapan_data_edar_import_pkrt_controller->import_pkrt_cek_kelengkapan_data_edar_import_pkrt_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport_pkrt':
			$out_content = $cek_kelengkapan_data_edar_import_pkrt_controller->import_pkrt_cek_kelengkapan_data_edar_import_pkrt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $cek_kelengkapan_data_edar_import_pkrt_controller->print_cek_kelengkapan_data_edar_import_pkrt();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $cek_kelengkapan_data_edar_import_pkrt_controller->list_cek_kelengkapan_data_edar_import_pkrt();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Cek Kelengkapan Izin Edar PKRT Import Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

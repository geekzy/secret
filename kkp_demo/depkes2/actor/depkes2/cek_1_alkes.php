<?php



	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('cek_1_alkes_controller')) {
	// do nothing
} else if (defined('CLASS_cek_1_alkes_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_cek_1_alkes_CONTROLLER', TRUE);

include_once 'class.cek_1_alkes.inc.php';
class cek_1_alkes_controller extends depkes2_manager {
	var $cek_1_alkes_label;
	var $optional_arr;
	function cek_1_alkes_controller() {
		$this->cek_1_alkes_label = array (
			'id_cek_1' => 'Id Check Alkes',
			'id_golongan' => 'Kelas',
			'no_daftar' => 'No Daftar',
			'no_tt' => 'Nama Pabrik ',
			'read_kaseksi' => 'Read Kaseksi',
			'read_kasubdit' => 'Read Kasubdit',
			'read_direktur' => 'Read Direktur',
			'indi_kasubdit' => 'Indikator Kasubdit',
			'indi_kaseksi' => 'Indikator Kaseksi',
			'jenis_izin_produksi' => 'Jenis Izin Produksi',
			'indi_direktur' => 'Indikator Direktur',
			'no_rekomendasi' => 'No Rekomendasi',
			'date_rekomendasi' => 'Tgl Rekomendasi',
			'nama_produk' => 'Jenis Alkes Yang Diproduksi',
			'nama_pabrik' => 'Nama Pabrik',
			'no_bap' => 'NO BAP',
			'date_bap' => 'Tgl BAP',
			'alamat' => 'Alamat Pabrik',
			'lisensi' => 'Licensi',
			'status_penilai' => 'Status Penilaian',
			'nama_penilai' => 'Nama Penilai',
			'urut_no_tt' => 'Nomor Tanda Terima',
			'subdit' => 'Subdit',
			'golongan' => 'Kelas',
			'date_1' => 'Tanggal Penilai',
			'date_rekomendasi' => 'Tanggal Rekomendasi',
			'date_bap' => 'Tanggal BAP',
			'status_kaseksi' => 'Status Kaseksi',
			'nama_kaseksi' => 'Nama Kaseksi',
			'date_2' => 'Tanggal Kaseksi',
			'status_kasubdit' => 'Status Kasubdit',
			'nama_kasubdit' => 'Nama Kasubdit',
			'date_3' => 'Tanggal Kasubdit',
			'no_pemohon' => 'Nomor Pemohon',
			'date_pemohon' => 'Tanggal Pemohon',
			'status_direktur' =>'Status Direktur',
			'nama_direktur' => 'Nama Direktur',
			'date_4' => 'Tanggal Direktur',
			'keterangan' => 'Keterangan',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_cek_1' => TRUE,
			'id_golongan' => FALSE,
			'no_daftar' => FALSE,
			'no_rekomendasi' => FALSE,
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

		include_once 'class.pendaftar.inc.php';
		if($_GET['id_cek_1']){
			if($bag=='kaseksi'){
				$fk_sql =
				"SELECT
					tt_1_alkes.no_tt as skey,
					tt_1_alkes.urut_no_tt as svalue,
					pendaftar.nama_pabrik as svalue2
				FROM
				tt_1_alkes
				LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
				LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.no_tt=tt_1_alkes.no_tt)
				LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar )
				LEFT OUTER JOIN inbox_produksi_subdit ON(inbox_produksi_subdit.no_tt = tt_1_alkes.no_tt )
				LEFT OUTER JOIN inbox_produksi_seksi ON(inbox_produksi_seksi.id_inbox_produksi_subdit = inbox_produksi_subdit.id_inbox_produksi_subdit)
				WHERE inbox_produksi_seksi.insert_by='$userlog'
				ORDER BY
				tt_1_alkes.date_insert

				";
			}else{
				$fk_sql =
				"SELECT
					tt_1_alkes.no_tt as skey,
					tt_1_alkes.urut_no_tt as svalue,
					pendaftar.nama_pabrik as svalue2
				FROM
				tt_1_alkes
				LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
				LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.no_tt=tt_1_alkes.no_tt)
				LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar )
				LEFT OUTER JOIN inbox_produksi_subdit ON(inbox_produksi_subdit.no_tt = tt_1_alkes.no_tt )
				RIGHT OUTER JOIN inbox_produksi_seksi ON(inbox_produksi_seksi.id_inbox_produksi_subdit = inbox_produksi_subdit.id_inbox_produksi_subdit)
				ORDER BY
				tt_1_alkes.date_insert
				";
			}
		}else{
			$fk_sql =
			"SELECT
				tt_1_alkes.no_tt as skey,
				tt_1_alkes.urut_no_tt as svalue,
				pendaftar.nama_pabrik as svalue2
			FROM
			tt_1_alkes
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
			LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.no_tt=tt_1_alkes.no_tt)
			LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar )
			LEFT OUTER JOIN inbox_produksi_subdit ON(inbox_produksi_subdit.no_tt = tt_1_alkes.no_tt )
			RIGHT OUTER JOIN inbox_produksi_seksi ON(inbox_produksi_seksi.id_inbox_produksi_subdit = inbox_produksi_subdit.id_inbox_produksi_subdit)
			WHERE ((tt_1_alkes.no_tt IS NULL) OR (inbox_produksi_seksi.insert_by='$userlog')) AND cek_1_alkes.no_tt IS NULL
			ORDER BY
			tt_1_alkes.date_insert
			";

		}
  
		$result = pendaftar::select($fk_sql);
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
		sql = 'SELECT pendaftar.alamat_pabrik,subdit.subdit as nama_propinsi_2 FROM pendaftar LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar) LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)  WHERE tt_1_alkes.no_tt =\''+ b +'\'';

		jumpto1('frame_tt_1_alkes.php?sql='+sql+'&a='+b)

		";

	$GLOBALS['out_before_footer'] = '
 	<iframe marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=auto name=\'iframe_entry1\' id=\'iframe_entry1\' style="width:0;height:0" src="frame_tt_1_alkes.php"></iframe>
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


	// create add cek_1_alkes form
	function add_cek_1_alkes_form() {
		include_once 'class.xform.inc.php';
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		//print_r($_GET);exit();
		$record = $_GET;
		$label_arr = $this->cek_1_alkes_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('no_tt','N','8');
		$field_arr[] = xform::xf('no_rekomendasi','C','32');
		$field_arr[] = xform::xf('date_rekomendasi','N','8');
		$field_arr[] = xform::xf('no_bap','C','32');
		$field_arr[] = xform::xf('date_bap','N','8');
		$field_arr[] = xform::xf('no_pemohon','C','32');
		$field_arr[] = xform::xf('date_pemohon','N','8');
		$field_arr[] = xform::xf('nama_produk','C','32');
		
		$field_arr[] = xform::xf('kelengkapan','C','32');
		$field_arr[] = xform::xf('id_golongan','N','8');
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
		$field_arr[] = xform::xf('read_kaseksi','C','32');
		$field_arr[] = xform::xf('read_kasubdit','C','32');
		$field_arr[] = xform::xf('read_direktur','C','32');


		$rs = $adodb->Execute("SELECT * FROM cek_1_alkes WHERE id_cek_1='{$record['id_cek_1']}'");
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
		$optional_arr['no_rekomendasi_rule'] = '';
		$optional_arr['date_rekomendasi_rule'] = '';
		$optional_arr['no_bap_rule'] = '';
		$optional_arr['date_bap_rule'] = '';
		$optional_arr['no_pemohon_rule'] = '';
		$optional_arr['date_pemohon_rule'] = '';
		$optional_arr['nama_produk_rule'] = '';
		$optional_arr['nama_pabrik_rule'] = '';
		$optional_arr['alamat_rule'] = '';
		$optional_arr['lisensi_rule'] = '';
		$optional_arr['status_penilai_rule'] = '';
		$optional_arr['nama_penilai_rule'] = '';
		$optional_arr['date_1_rule'] = '';
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
		$optional_arr['nama_produk'] = 'user_defined';
		$value_arr['nama_produk'] = '<textarea name="nama_produk" class="text" rows="3" cols="50">'.$value_arr['nama_produk'].'</textarea>';
		
		$optional_arr['keterangan'] = 'user_defined';
		$value_arr['keterangan'] = '<textarea name="keterangan" class="text" rows="3" cols="50">'.$value_arr['keterangan'].'</textarea>';

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
		$optional_arr['indi_kaseksi'] = 'user_defined';
		$optional_arr['indi_kasubdit'] = 'user_defined';
		$optional_arr['indi_direktur'] = 'user_defined';
		$optional_arr['read_kaseksi'] = 'user_defined';
		$optional_arr['read_kasubdit'] = 'user_defined';
		$optional_arr['read_direktur'] = 'user_defined';


		if($value_arr['status_penilai'] == '0'){$ok1 = 'checked';$ok1text='0';$ok2='';$ok1t='Sudah Lengkap';}else{$ok1='';$ok2='checked';$ok1text='1';$ok1t='Belum Lengkap';}
		if($value_arr['status_kaseksi'] == '0'){$ok3 = 'checked';$ok2text='0';$ok4='';$ok2t='Sudah Lengkap';}else{$ok3='';$ok4='checked';$ok2text='1';$ok2t='Belum Lengkap';}
		if($value_arr['status_kasubdit'] == '0'){$ok5 = 'checked';$ok3text='0';$ok6='';$ok3t='Sudah Lengkap';}else{$ok5='';$ok6='checked';$ok3text='1';$ok3t='Belum Lengkap';}
		if($value_arr['status_direktur'] == '0'){$ok7 = 'checked';$ok4text='0';$ok8='';$ok4t='Sudah Lengkap';}else{$ok7='';$ok8='checked';$ok4text='1';$ok4t='Belum Lengkap';}

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
						$optional_arr['indi_kaseksi'] = TRUE;

						$optional_arr['nama_kasubdit'] = TRUE;
						$optional_arr['date_3'] = TRUE;
						$optional_arr['read_kaseksi'] = TRUE;
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
		$has ='';
		$has .='<table>';
		if($ses->action == 'penilai'){$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Status Penilai</td><td>Komentar Penilai</td></tr>';}
		if($ses->action == 'kaseksi'){$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Status Kaseksi</td><td>Komentar Kaseksi</td></tr>';}
		if($ses->action == 'kasubdit'){$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Status Kasubdit</td><td>Komentar Kasubdit</td></tr>';}
		if($ses->action == 'direktur'){$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Komentar Kasubdit</td><td>Status Direktur</td><td>Komentar Direktur</td></tr>';}
		if($ses->action == 'admin'){$has .= '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Komentar Kasubdit</td><td>Komentar Direktur</td></tr>';}
		global $adodb;
			$sqlx = "SELECT id_kelengkapan,nama_kelengkapan FROM kelengkapan_alkes ORDER BY id_kelengkapan";
			$rsx = $adodb->Execute($sqlx);
			$a=1;
			while(! $rsx->EOF){
				if($_GET['id_cek_1']){
				$sqld = "SELECT id_cek_1,id_kelengkapan,status_penilai,status_kaseksi,status_kasubdit,status_direktur,alasan_penilai,alasan_kaseksi,alasan_kasubdit,alasan_direktur FROM detail_cek_1_alkes WHERE id_cek_1='".$_GET['id_cek_1']."' AND id_kelengkapan='".$rsx->fields['id_kelengkapan']."'";

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
		$label_arr['kelengkapan']='Kelengkapan';
		$value_arr['kelengkapan'] = $has;

		$this -> slip_field($config,'alamat','after','no_tt');
		$this -> slip_field($config,'propinsi','after','alamat');

		$optional_arr['id_golongan'] = 'user_defined';
                $arr = array();
                $arr['name'] = 'id_golongan';
                $arr['selected'] = $value_arr['id_golongan'];
                $arr['sql'] = 'SELECT id_golongan as val, golongan as txt FROM gol_alkes';
                $value_arr['id_golongan'] = xform::dbs($arr);

		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_cek_1']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Cek Kelengkapan Registrasi Izin Produksi";
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

	// create update cek_1_alkes form
	function update_cek_1_alkes_form() {
		return $this->add_cek_1_alkes_form();
	}

	function view_cek_1_alkes_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		$field_arr = cek_1_alkes::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_cek_1'] = 'protect';

		$record = array (
			'id_cek_1' => ${$GLOBALS['get_vars']}['id_cek_1']
		);
		$result = cek_1_alkes::get($record);
		$value_arr = $result[0];
		$label_arr = $this->cek_1_alkes_label;
		global $adodb;

		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','A4');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,'KELENGKAPAN IZIN ALKES','',0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(5);
		$sqlA = "SELECT
		id_cek_1,
		no_tt,
		no_rekomendasi,
		id_golongan,
		no_bap,
		no_pemohon,
		date_pemohon,
		nama_produk,
		id_golongan as golongan,
		CASE WHEN status_penilai ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_penilai,
		nama_penilai,
		date_1,
		CASE WHEN status_kaseksi ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_kaseksi,
		nama_kaseksi,
		date_2,
		CASE WHEN status_kasubdit ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_kasubdit,
		nama_kasubdit,
		date_3,
		CASE WHEN status_direktur ='0' THEN 'Sudah Lengkap'
				else 'Belum Lengkap'
		END AS status_direktur,
		nama_direktur,
		date_4,
		keterangan,
		insert_by,
		date_insert
		FROM cek_1_alkes
		WHERE
		id_cek_1 ='".$value_arr['id_cek_1']."'
		";
		$hasil=$adodb->Execute($sqlA);
		while(! $hasil->EOF){
			$id_cek_1 = $hasil->fields['id_cek_1'];
			$no_tt = $hasil->fields['no_tt'];
			$no_rekomendasi = $hasil->fields['no_rekomendasi'];
			$date_rekomendasi = $hasil->fields['date_rekomendasi'];
			$no_bap = $hasil->fields['no_bap'];
			$date_bap = $hasil->fields['date_bap'];
			$no_pemohon = $hasil->fields['no_pemohon'];
			$date_pemohon = $hasil->fields['date_pemohon'];
			$no_pemohon = $hasil->fields['no_pemohon'];
			$date_pemohon = $hasil->fields['date_pemohon'];
			$id_golongan = $hasil->fields['id_golongan'];
			$nama_produk = $hasil->fields['nama_produk'];
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
			if( $value_arr['date_rekomendasi'] == '0'){ $date_rekomendasi = '';}else{ if( $value_arr['date_rekomendasi'] != ''){$date_rekomendasi = date('d/m/Y',$value_arr['date_rekomendasi']);}}
			if( $value_arr['date_bap'] == '0'){ $date_bap = '';}else{ if( $value_arr['date_bap'] != ''){$date_bap = date('d/m/Y',$value_arr['date_bap']);}}
			if( $value_arr['date_pemohon'] == '0'){ $date_pemohon = '';}else{ if( $value_arr['date_pemohon'] != ''){$date_pemohon = date('d/m/Y',$value_arr['date_pemohon']);}}


			$sqlB = "
			SELECT
			tt_1_alkes.urut_no_tt,
			pendaftar.alamat_pabrik,
			pendaftar.nama_pabrik
			FROM
			pendaftar
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
			WHERE tt_1_alkes.no_tt ='".$no_tt."'
			";

			$hasilB = $adodb->Execute($sqlB);
			$alamat_pabrik = $hasilB->fields['alamat_pabrik'];
			$urut_no_tt = $hasilB->fields['urut_no_tt'];

			$sqlG = "
			SELECT
			golongan
			FROM
			gol_alkes
			WHERE id_golongan ='".$id_golongan."'";
			$hasilG = $adodb->Execute($sqlG);
			$golongan = $hasilG->fields['golongan'];


			$sqlC = "
			SELECT
			subdit.subdit
			FROM
			pendaftar
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
			WHERE tt_1_alkes.no_tt ='".$no_tt."'";
			$hasilC = $adodb->Execute($sqlC);
			$subdit = $hasilC->fields['subdit'];

			$sqlP = "
			SELECT
			pendaftar.nama_pabrik
			FROM
			pendaftar
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
			WHERE tt_1_alkes.no_tt ='".$no_tt."'";
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
			$pdf->Cell(50,7,'No Rekomendasi','',0,'L');$pdf->Cell(50,7,': '.$no_rekomendasi.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Tanggal Rekomendasi','',0,'L');$pdf->Cell(50,7,': '.$date_rekomendasi.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'No BAP','',0,'L');$pdf->Cell(50,7,': '.$no_bap.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Tanggal BAP','',0,'L');$pdf->Cell(50,7,': '.$date_bap.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'No Pemohon','',0,'L');$pdf->Cell(50,7,': '.$no_pemohon.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Tanggal Pemohon','',0,'L');$pdf->Cell(50,7,': '.$date_pemohon.'','',0,'L');
			$pdf->Ln(5);


			$pnama_produk = explode("\n", $nama_produk);
			$ii = 0;
			foreach ($pnama_produk as $key => $val) {
				if ($ii==0) $title = 'Jenis Produksi Alkes';
				else $title = ' ';
				if (trim($title)) $titik2 = ': ';
				else $titik2 = '  ';
				$pdf->Cell(50,7,$title,'',0,'L');$pdf->Cell(50,7,$titik2.$val.'','',0,'L');
				$pdf->Ln(5);
				$ii++;
			}
			#$pdf->Ln(5);
			$pdf->SetFont('Arial','B',11);
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
			kelengkapan_alkes.nama_kelengkapan,
			CASE WHEN detail_cek_1_alkes.status_penilai ='1' THEN 'Ada' else 'Tidak' END AS status_penilai,
			detail_cek_1_alkes.alasan_penilai,
			CASE WHEN detail_cek_1_alkes.status_kaseksi ='1' THEN 'Ada' else 'Tidak' END AS status_kaseksi,
			detail_cek_1_alkes.alasan_kaseksi,
			CASE WHEN detail_cek_1_alkes.status_kasubdit ='1' THEN 'Ada' else 'Tidak' END AS status_kasubdit,
			detail_cek_1_alkes.alasan_kasubdit,
			CASE WHEN detail_cek_1_alkes.status_direktur ='1' THEN 'Ada' else 'Tidak' END AS status_direktur,
			detail_cek_1_alkes.alasan_direktur
			FROM
			detail_cek_1_alkes
			RIGHT OUTER JOIN kelengkapan_alkes ON(kelengkapan_alkes.id_kelengkapan = detail_cek_1_alkes.id_kelengkapan)
			WHERE
			id_cek_1='".$id_cek_1."'
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


					$status_penilaix = $status_penilaix.", ".str_replace("\n", " ", $alasan_penilaix);
					$status_kaseksix = $status_kaseksix.", ".str_replace("\n", " ", $alasan_kaseksix);
					$status_kasubditx = $status_kasubditx.", ".str_replace("\n", " ", $alasan_kasubditx);
					$status_direkturx = $status_direkturx.", ".str_replace("\n", " ", $alasan_direkturx);

					$jml_nama_kelengkapan = strlen($nama_kelengkapan);
					$jml_alasan_penilaix = strlen($status_penilaix);
					$jml_alasan_kaseksix = strlen($status_kaseksix);
					$jml_alasan_kasubditx = strlen($status_kasubditx);
					$jml_alasan_direkturx = strlen($status_direkturx);

					$max = max($jml_nama_kelengkapan,$jml_alasan_penilaix,$jml_alasan_kaseksix,$jml_alasan_kasubditx,$jml_alasan_direkturx);
					
					if ($max<20) $x16 = $max;
					else $x16 = 20;
					
					$jml_hight_arr = explode('.',$max/$x16);
					$jml_hight = $jml_hight_arr[0] * 7;


					for($a=0;$a<=$max;$a=$a+1){
						$g = $a%$x16;
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

							#if ($a<=$x16) {
							#echo $nama_kelengkapanY."<br>\n";
							$pdf->Cell(6,4,''.$noX.'','LR',0,'L');
							$pdf->Cell(35,4,''.$nama_kelengkapanY.'','LR',0,'L');
							$pdf->Cell(35,4,''.$status_penilaiY.'','L',0,'L');
							$pdf->Cell(35,4,''.$status_kaseksiY.'','L',0,'L');
							$pdf->Cell(35,4,''.$status_kasubditY.'','LR',0,'L');
							$pdf->Cell(35,4,''.$status_direkturY.'','LR',0,'L');
							$pdf->Ln();
							#} else {
							#if (trim($alasan_penilaiY) && trim($alasan_kaseksiY) && trim($alasan_kasubditY) && trim($alasan_direkturY)) {
							#if ($a>$x16) {
							#$pdf->Cell(6,3,'','LR',0,'L');
							#$pdf->Cell(35,3,'','LR',0,'L');
							#$pdf->Cell(35,3,''.$alasan_penilaiY.'','LR',0,'L');
							#$pdf->Cell(35,3,''.$alasan_kaseksiY.'','R',0,'L');
							#$pdf->Cell(35,3,''.$alasan_kasubditY.'','R',0,'L');
							#$pdf->Cell(35,3,''.$alasan_direkturY.'','R',0,'L');
							#$pdf->Ln();
							#}
							#}
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

     					#		$pdf->Cell(6,3,''.$noX.'','LR',0,'L');
					#		$pdf->Cell(35,3,''.$nama_kelengkapanY.'','LR',0,'L');
					#		$pdf->Cell(35,3,''.$alasan_penilaiY.'','LR',0,'L');
					#		$pdf->Cell(35,3,''.$alasan_kaseksiY.'','R',0,'L');
					#		$pdf->Cell(35,3,''.$alasan_kasubditY.'','R',0,'L');
					#		$pdf->Cell(35,3,''.$alasan_direkturY.'','R',0,'L');

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
					#$pdf->Ln();
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
		$pdf->Cell(50,7,'Golongan','',0,'L');$pdf->Cell(50,7,': '.$golongan.'','',0,'L');
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
		$pdf->Ln(5);
		$pdf->Cell(50,7,'NO Izin produksi','',0,'L');$pdf->Cell(50,7,': ','',0,'L');

		$pdf->Output();


		$_form = $lamp;

		return $_form;
	}
	// handle event add cek_1_alkes
	function add_cek_1_alkes() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		//foreach ($record as $k => $v) $record[$k] = trim($v);
		$jml_kelengkapan = count($_POST['id_kelengkapan']);
		$jml_kelengkapan = $jml_kelengkapan +1;

		$read_kaseksi = $_POST['read_kaseksi'];
		if($read_kaseksi == 'on'){ $xread_kaseksi= '1';}else{ $xread_kaseksi='0';}

		$read_kasubdit = $_POST['read_kasubdit'];
		if($read_kasubdit == 'on'){ $xread_kasubdit = '1';}else{ $xread_kasubdit ='0';}

		$read_direktur = $_POST['read_direktur'];
		if($read_direktur == 'on'){ $xread_direktur = '1';}else{ $xread_direktur ='0';}

			$record = array (
				'id_golongan' => $_POST['id_golongan'],
				'no_rekomendasi' => $_POST['no_rekomendasi'],
				'date_rekomendasi' => $this->parsedate(trim($_POST['date_rekomendasi'])),
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
				'no_bap' => $_POST['no_bap'],
				'date_bap' => $this->parsedate(trim($_POST['date_bap'])),
				'nama_produk' => $_POST['nama_produk'],
				'no_tt' => $_POST['no_tt'],
				'indi_kaseksi' => $_POST['indi_kaseksi'],
				'indi_kasubdit' => $_POST['indi_kasubdit'],
				'indi_direktur' => $_POST['indi_direktur'],
				'read_kaseksi' => $xread_kaseksi,
				'read_kasubdit' => $xread_kasubdit,
				'read_direktur' => $xread_direktur,
				'insert_by' => $GLOBALS['ses']->loginid,
				'date_insert' => time()
			);
			cek_1_alkes::add($record);

		$rsx = $adodb->Execute("SELECT id_cek_1 FROM cek_1_alkes ORDER BY id_cek_1 DESC LIMIT 1");
		$id_cek_1 = $rsx->fields['id_cek_1'];

		include "class.detail_cek_1_alkes.inc.php";
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
				detail_cek_1_alkes::add($record);
		}

		$status = "Successfull $st '<b>{$record['id_cek_1']}</b>'";
		$this->log($status);

		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}

	// handle event update cek_1_alkes
	function update_cek_1_alkes() {
		//return $this->add_cek_1_alkes();
		global ${$GLOBALS['post_vars']},$adodb,$ses;
		$bag = $ses->action;

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

		$_block = new block();
		$_block->set_config('title', ('Update Cek Kelengkapan Registrasi Izin Produksi Status'));
		$_block->set_config('width', 595);
		if ($result = cek_1_alkes::get($record)) {
			$record = $result[0];
			if (${$GLOBALS['post_vars']}['id_golongan']!='') $record['id_golongan'] = $_POST['id_golongan'];
			if (${$GLOBALS['post_vars']}['no_rekomendasi']!='') $record['no_rekomendasi'] = $_POST['no_rekomendasi'];
			if (${$GLOBALS['post_vars']}['date_rekomendasi']!='') $record['date_rekomendasi'] = $this->parsedate(trim($_POST['date_rekomendasi']));
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
			if (${$GLOBALS['post_vars']}['no_bap']!='') $record['no_bap'] = $_POST['no_bap'];
			if (${$GLOBALS['post_vars']}['date_bap']!='') $record['date_bap'] = $this->parsedate(trim($_POST['date_bap']));
			if (${$GLOBALS['post_vars']}['nama_produk']!='') $record['nama_produk'] = $_POST['nama_produk'];
			if (${$GLOBALS['post_vars']}['no_tt']!='') $record['no_tt'] = $_POST['no_tt'];
			if (${$GLOBALS['post_vars']}['indi_kaseksi']!='') $record['indi_kaseksi'] = $_POST['indi_kaseksi'];
			if (${$GLOBALS['post_vars']}['indi_kasubdit']!='') $record['indi_kasubdit'] = $_POST['indi_kasubdit'];
			if (${$GLOBALS['post_vars']}['indi_direktur']!='') $record['indi_direktur'] = $_POST['indi_direktur'];
			if ($xread_kaseksi!='') $record['read_kaseksi'] = $xread_kaseksi;
			if ($xread_kasubdit!='') $record['read_kasubdit'] = $xread_kasubdit;
			if ($xread_direktur!='') $record['read_direktur'] = $xread_direktur;
			if (${$GLOBALS['post_vars']}['insert_by']!='') $record['insert_by'] = $GLOBALS['ses']->loginid;
			if (${$GLOBALS['post_vars']}['date_insert']!='') $record['date_insert'] = time();
			eval($this->save_config);
			if (cek_1_alkes::update($record)) {
				$adodb->Execute("DELETE FROM detail_cek_1_alkes WHERE id_cek_1 = '".$_POST['oldpkvalue']."'");
				//$rsx = $adodb->Execute("SELECT id_cek_1 FROM cek_1_alkes ORDER BY id_cek_1 DESC LIMIT 1");
				$id_cek_1 = $_POST['oldpkvalue'];

				include "class.detail_cek_1_alkes.inc.php";
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
						detail_cek_1_alkes::add($record);
				}

				$_block->parse(array('+<font color=green><b>'.__('Successfull Updated').'</b></font>'));
				return $_block->get_str();
			}
		}
		$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
		$_block->parse(array('+<font color=red><b>'.__('Failed Updated').'</b></font>'.' :'.__('Data doesn\'t exists')));
		return  $_block->get_str();
	}

	// handle delete cek_1_alkes
	function delete_cek_1_alkes() {
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
            $success = $adodb->Execute("delete from cek_1_alkes where ".$query);
			$success = $adodb->Execute("delete from detail_cek_1_alkes where ".$query);
		}
                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'cek_1_alkes <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'cek_1_alkes <font color=red>'.$query.'</font>';
                }
                $this->log($status);

                $_block = new block();
                $_block->set_config('title', ('Delete Cek Kelengkapan Registrasi Izin Produksi Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list cek_1_alkes
	function list_cek_1_alkes($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']},$ses;
		$bag = $ses->action;
		$user = $ses->loginid;

		if($bag =='penilai'){
			$sql = "SELECT
			cek_1_alkes.id_cek_1,
			cek_1_alkes.no_tt,
			cek_1_alkes.no_tt as urut_no_tt,
			CASE WHEN tt_1_alkes.jenis_izin_produksi='0' THEN 'Izin Produksi Alkes'
			ELSE
			'Izin Produksi PKRT' END as jenis_izin_produksi,
			cek_1_alkes.no_tt as alamat,
			cek_1_alkes.no_tt as subdit,
			cek_1_alkes.no_rekomendasi,
			cek_1_alkes.date_rekomendasi,
			cek_1_alkes.no_bap,
			cek_1_alkes.date_bap,
			cek_1_alkes.nama_produk,
			cek_1_alkes.id_golongan as golongan,
			CASE WHEN cek_1_alkes.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek_1_alkes.nama_penilai,
			cek_1_alkes.date_1,
			CASE WHEN cek_1_alkes.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek_1_alkes.nama_kaseksi,
			cek_1_alkes.date_2,
			CASE WHEN cek_1_alkes.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek_1_alkes.nama_kasubdit,
			cek_1_alkes.date_3,
			CASE WHEN cek_1_alkes.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			cek_1_alkes.nama_direktur,
			cek_1_alkes.date_4,
			cek_1_alkes.keterangan,
			cek_1_alkes.insert_by,
			cek_1_alkes.date_insert,
			cek_1_alkes.id_cek_1 as detail
			FROM cek_1_alkes
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
			WHERE
			cek_1_alkes.nama_penilai ='' OR cek_1_alkes.nama_penilai = '$user'
			";
		}

		if($bag =='kaseksi'){
			$sql = "SELECT
			cek_1_alkes.id_cek_1,
			cek_1_alkes.no_tt,
			cek_1_alkes.no_tt as urut_no_tt,
			CASE WHEN tt_1_alkes.jenis_izin_produksi='0' THEN 'Izin Produksi Alkes'
			ELSE
			'Izin Produksi PKRT' END as jenis_izin_produksi,
			cek_1_alkes.no_tt as alamat,
			cek_1_alkes.no_tt as subdit,
			cek_1_alkes.no_rekomendasi,
			cek_1_alkes.date_rekomendasi,
			cek_1_alkes.no_bap,
			cek_1_alkes.date_bap,
			cek_1_alkes.nama_produk,
			cek_1_alkes.id_golongan as golongan,
			CASE WHEN cek_1_alkes.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek_1_alkes.nama_penilai,
			cek_1_alkes.date_1,
			CASE WHEN cek_1_alkes.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek_1_alkes.nama_kaseksi,
			cek_1_alkes.date_2,
			CASE WHEN cek_1_alkes.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek_1_alkes.nama_kasubdit,
			cek_1_alkes.date_3,
			CASE WHEN cek_1_alkes.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			cek_1_alkes.nama_direktur,
			cek_1_alkes.date_4,
			cek_1_alkes.keterangan,
			cek_1_alkes.insert_by,
			cek_1_alkes.date_insert,
			CASE WHEN cek_1_alkes.indi_kaseksi='0' THEN 'Return'
			else 'OK' END AS indi_kaseksi,
			Case WHEN cek_1_alkes.read_kaseksi='0' THEN 'Unread'
			else 'Read' END AS read_kaseksi,
			cek_1_alkes.id_cek_1 as detail
			FROM cek_1_alkes
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
			WHERE
			cek_1_alkes.nama_kaseksi ='' OR cek_1_alkes.nama_kaseksi = '$user'
			ORDER BY cek_1_alkes.read_kaseksi
			";
		}
		
		if($bag =='kasubdit'){
			$sql = "SELECT
			cek_1_alkes.id_cek_1,
			cek_1_alkes.no_tt,
			cek_1_alkes.no_tt as urut_no_tt,
			CASE WHEN tt_1_alkes.jenis_izin_produksi='0' THEN 'Izin Produksi Alkes'
			ELSE
			'Izin Produksi PKRT' END as jenis_izin_produksi,
			cek_1_alkes.no_tt as alamat,
			cek_1_alkes.no_tt as subdit,
			cek_1_alkes.no_rekomendasi,
			cek_1_alkes.date_rekomendasi,
			cek_1_alkes.no_bap,
			cek_1_alkes.date_bap,
			cek_1_alkes.nama_produk,
			cek_1_alkes.id_golongan as golongan,
			CASE WHEN cek_1_alkes.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek_1_alkes.nama_penilai,
			cek_1_alkes.date_1,
			CASE WHEN cek_1_alkes.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek_1_alkes.nama_kaseksi,
			cek_1_alkes.date_2,
			CASE WHEN cek_1_alkes.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek_1_alkes.nama_kasubdit,
			cek_1_alkes.date_3,
			CASE WHEN cek_1_alkes.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			cek_1_alkes.nama_direktur,
			cek_1_alkes.date_4,
			cek_1_alkes.keterangan,
			cek_1_alkes.insert_by,
			cek_1_alkes.date_insert,
			CASE WHEN cek_1_alkes.indi_kasubdit='0' THEN 'Return'
			else 'OK' END AS indi_kasubdit,
			Case WHEN cek_1_alkes.read_kasubdit='0' THEN 'Unread'
			else 'Read' END AS read_kasubdit,
			cek_1_alkes.id_cek_1 as detail
			FROM cek_1_alkes
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
			WHERE
			cek_1_alkes.nama_kasubdit ='' OR cek_1_alkes.nama_kasubdit='$user'
			ORDER BY cek_1_alkes.read_kasubdit
			";
		}

		if($bag =='direktur'){
			$sql = "SELECT
			cek_1_alkes.id_cek_1,
			cek_1_alkes.no_tt,
			cek_1_alkes.no_tt as urut_no_tt,
			CASE WHEN tt_1_alkes.jenis_izin_produksi='0' THEN 'Izin Produksi Alkes'
			ELSE
			'Izin Produksi PKRT' END as jenis_izin_produksi,
			cek_1_alkes.no_tt as alamat,
			cek_1_alkes.no_tt as subdit,
			cek_1_alkes.no_rekomendasi,
			cek_1_alkes.date_rekomendasi,
			cek_1_alkes.no_bap,
			cek_1_alkes.date_bap,
			cek_1_alkes.nama_produk,
			cek_1_alkes.id_golongan as golongan,
			CASE WHEN cek_1_alkes.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek_1_alkes.nama_penilai,
			cek_1_alkes.date_1,
			CASE WHEN cek_1_alkes.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek_1_alkes.nama_kaseksi,
			cek_1_alkes.date_2,
			CASE WHEN cek_1_alkes.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek_1_alkes.nama_kasubdit,
			cek_1_alkes.date_3,
			CASE WHEN cek_1_alkes.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			cek_1_alkes.nama_direktur,
			cek_1_alkes.date_4,
			cek_1_alkes.keterangan,
			cek_1_alkes.insert_by,
			cek_1_alkes.date_insert,
			CASE WHEN cek_1_alkes.indi_direktur='0' THEN 'Return'
			else 'OK' END AS indi_direktur,
			Case WHEN cek_1_alkes.read_kasubdit='0' THEN 'Unread'
			else 'Read' END AS read_direktur,
			cek_1_alkes.id_cek_1 as detail
			FROM cek_1_alkes
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
			WHERE
			cek_1_alkes.nama_direktur ='' OR cek_1_alkes.nama_direktur ='$user'
			ORDER BY cek_1_alkes.read_direktur
			";
		}

		if($bag =='admin'){
			$sql = "SELECT
			cek_1_alkes.id_cek_1,
			cek_1_alkes.no_tt,
			cek_1_alkes.no_tt as urut_no_tt,
			CASE WHEN tt_1_alkes.jenis_izin_produksi='0' THEN 'Izin Produksi Alkes'
			ELSE
			'Izin Produksi PKRT' END as jenis_izin_produksi,
			cek_1_alkes.no_tt as alamat,
			cek_1_alkes.no_tt as subdit,
			cek_1_alkes.no_rekomendasi,
			cek_1_alkes.date_rekomendasi,
			cek_1_alkes.no_bap,
			cek_1_alkes.date_bap,
			cek_1_alkes.nama_produk,
			cek_1_alkes.id_golongan as golongan,
			CASE WHEN cek_1_alkes.status_penilai ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_penilai,
			cek_1_alkes.nama_penilai,
			cek_1_alkes.date_1,
			CASE WHEN cek_1_alkes.status_kaseksi ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kaseksi,
			cek_1_alkes.nama_kaseksi,
			cek_1_alkes.date_2,
			CASE WHEN cek_1_alkes.status_kasubdit ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_kasubdit,
			cek_1_alkes.nama_kasubdit,
			cek_1_alkes.date_3,
			CASE WHEN cek_1_alkes.status_direktur ='0' THEN 'Lengkap'
					else 'Belum Lengkap'
			END AS status_direktur,
			cek_1_alkes.nama_direktur,
			cek_1_alkes.date_4,
			cek_1_alkes.keterangan,
			cek_1_alkes.insert_by,
			cek_1_alkes.date_insert,
			cek_1_alkes.id_cek_1 as detail
			FROM cek_1_alkes
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
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
		pendaftar.nama_pabrik
		FROM
		pendaftar
		LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
		WHERE tt_1_alkes.no_tt =\'$f\'";

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
			tt_1_alkes.urut_no_tt
			FROM
			pendaftar
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
			WHERE tt_1_alkes.no_tt =\'$f\'";

			global $adodb;
			$A = $adodb->Execute($Aql);
			$FA = $A->fields[\'urut_no_tt\'];
			
			$rsh=$adodb->Execute("SELECT indi_kaseksi,read_kaseksi FROM cek_1_alkes WHERE no_tt=\'$f\'");
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
			tt_1_alkes.urut_no_tt
			FROM
			pendaftar
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
			WHERE tt_1_alkes.no_tt =\'$f\'";

			global $adodb;
			$A = $adodb->Execute($Aql);
			$FA = $A->fields[\'urut_no_tt\'];

			$rsh=$adodb->Execute("SELECT indi_kasubdit,read_kasubdit FROM cek_1_alkes WHERE no_tt=\'$f\'");
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
			tt_1_alkes.urut_no_tt
			FROM
			pendaftar
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
			WHERE tt_1_alkes.no_tt =\'$f\'";

			global $adodb;
			$A = $adodb->Execute($Aql);
			$FA = $A->fields[\'urut_no_tt\'];

			$rsh=$adodb->Execute("SELECT indi_direktur,read_direktur FROM cek_1_alkes WHERE no_tt=\'$f\'");
			$indi_direktur = $rsh->fields[indi_direktur];
			$read_direktur = $rsh->fields[read_direktur];

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
			pendaftar
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
			WHERE tt_1_alkes.no_tt =\'$f\'";

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
		pendaftar.alamat_pabrik
		FROM
		pendaftar
		LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
		WHERE tt_1_alkes.no_tt =\'$b\'";

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
		pendaftar
		LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.kode_pendaftar = pendaftar.kode_pendaftar)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_1_alkes.kode_subdit)
		WHERE tt_1_alkes.no_tt =\'$c\'";

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
		gol_alkes
		WHERE id_golongan =\'$E\'";

		global $adodb;
		$A = $adodb->Execute($Aql);
		$FA = $A->fields[\'golongan\'];
		$str .=$FA;
		';
		
		$eval_arr['detail'] = '
		$USql = "
			SELECT
			kelengkapan_alkes.nama_kelengkapan,
			CASE WHEN detail_cek_1_alkes.status_penilai =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_penilai,
			detail_cek_1_alkes.alasan_penilai,
			CASE WHEN detail_cek_1_alkes.status_kaseksi =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_kaseksi,
			detail_cek_1_alkes.alasan_kaseksi,
			CASE WHEN detail_cek_1_alkes.status_kasubdit =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_kasubdit,
			detail_cek_1_alkes.alasan_kasubdit,
			CASE WHEN detail_cek_1_alkes.status_direktur =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_direktur,
			detail_cek_1_alkes.alasan_direktur
			FROM
			detail_cek_1_alkes
			LEFT OUTER JOIN kelengkapan_alkes ON(kelengkapan_alkes.id_kelengkapan = detail_cek_1_alkes.id_kelengkapan)
			WHERE
			id_cek_1=\'%s\' AND detail_cek_1_alkes.alasan_kaseksi IS NOT NULL
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
			'\', 800, 600, null, null, \'add_cek_1_alkes\');'.
			'win.focus()',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
		}

//		}
//		if ($this->get_permission('fill_this')) {

			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 800, 600, null, null, \'edit_cek_1_alkes\');'.
			'win.focus()',
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));

			$view_anchor = pager::pager_button(array("link"=>'javascript:'.
			'location.href=\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\';'.
			'',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {

			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' .
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_cek_1_alkes\')'.
			'win.focus()):' .
			'alert(\''.__('Cancelling Delete').'\');',
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_cek_1_alkes\');'.
			'win.focus()',
			"label"=>__('Print'),
			"type"=>"button",
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->cek_1_alkes_label;
		$config = array (
			'id'		=> 'cek_1_alkes',
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
			'form_title'	=> __('List').' Cek Kelengkapan Registrasi Izin Produksi'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print cek_1_alkes
	function print_cek_1_alkes() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_cek_1_alkes($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$cek_1_alkes_controller = new cek_1_alkes_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $cek_1_alkes_controller->add_cek_1_alkes_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $cek_1_alkes_controller->add_cek_1_alkes();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad();OnChangeno_tt()"';
			$out_content = $cek_1_alkes_controller->update_cek_1_alkes_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $cek_1_alkes_controller->update_cek_1_alkes();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $cek_1_alkes_controller->view_cek_1_alkes_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $cek_1_alkes_controller->delete_cek_1_alkes();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $cek_1_alkes_controller->import_cek_1_alkes_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $cek_1_alkes_controller->import_cek_1_alkes();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $cek_1_alkes_controller->print_cek_1_alkes();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $cek_1_alkes_controller->list_cek_1_alkes();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Cek Kelengkapan Registrasi Izin Produksi Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

<?php

	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('cek_pemutih_penyalur_controller')) {
	// do nothing
} else if (defined('CLASS_cek_pemutih_penyalur_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_cek_pemutih_penyalur_CONTROLLER', TRUE);

include_once 'class.cek_pemutih_penyalur.inc.php';
class cek_pemutih_penyalur_controller extends depkes2_manager {
	var $cek_pemutih_penyalur_label;
	var $optional_arr;
	function cek_pemutih_penyalur_controller() {
		$this->cek_pemutih_penyalur_label = array (
			'id_cek_pemutih' => 'Id Check penyalur',
			'id_golongan' => 'Golongan',
			'nama_pendaftar_pemutih_penyalur' => 'Nama pendaftar_pemutih_penyalur',
			'status_pending' => 'Status Pending',
			'status_tolak' => 'Status Tolak',
			'status_selesai' => 'Status Selesai',
			'no_sk' => 'No SK',
			'no_izin' => 'No Izin penyalur',
			'no_daftar' => 'No Daftar',
			'status' => 'Status',
			'no_tt' => 'No Tanda Terima',
			'no_rekomendasi' => 'No Rekomendasi',
			'nama_produk' => 'Jenis penyalur Yang Dipenyalur',
			'nama_pabrik' => 'Nama Pabrik',
			'no_bap' => 'NO BAP',
			'alamat' => 'Alamat Pabrik',
			'lisensi' => 'Licensi',
			'status_penilai' => 'Status Penilaian',
			'nama_penilai' => 'Nama Penilai',
			'subdit' => 'Subdit',
			'golongan' => 'Golongan',
			'date_1' => 'Tanggal Satu',
			'status_kaseksi' => 'Status Kaseksi',
			'nama_kaseksi' => 'Nama Kaseksi',
			'date_2' => 'Tanggal Dua',
			'status_kasubdit' => 'Status Kasubdit',
			'nama_kasubdit' => 'Nama Kasubdit',
			'date_3' => 'Tanggal Tiga',
			'status_direktur' =>'Status Direktur',
			'nama_direktur' => 'Nama Direktur',
			'date_4' => 'Tanggal Empat',
			'keterangan' => 'Keterangan',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_cek_pemutih' => TRUE,
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
                eval($this->load_config);
                $selected = $value_arr['no_tt'];

		include_once 'class.pendaftar_pemutih_penyalur.inc.php';
		if($_GET['id_cek_pemutih']){
		
		$fk_sql = ''.
		'SELECT
				tt_pemutih_penyalur.no_tt as skey,
				tt_pemutih_penyalur.no_tt as svalue,
				pendaftar_pemutih_penyalur.nama_pabrik as svalue2
			FROM
			tt_pemutih_penyalur
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)
			LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.no_tt=tt_pemutih_penyalur.no_tt)
			LEFT OUTER JOIN pendaftar_pemutih_penyalur ON(pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur )
			ORDER BY
				tt_pemutih_penyalur.date_insert

			';
		}else{
		$fk_sql = ''.
			'SELECT
				tt_pemutih_penyalur.no_tt as skey,
				tt_pemutih_penyalur.no_tt as svalue,
				pendaftar_pemutih_penyalur.nama_pabrik as svalue2
			FROM
			tt_pemutih_penyalur
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)
			LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.no_tt=tt_pemutih_penyalur.no_tt)
			LEFT OUTER JOIN pendaftar_pemutih_penyalur ON(pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur )
			WHERE cek_pemutih_penyalur.no_tt IS NULL
			ORDER BY
				tt_pemutih_penyalur.date_insert

			';
		}

		$result = pendaftar_pemutih_penyalur::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('no_tt');
		$default_value = array(
			array (
			'lisensi' => 'Licensi',
				'skey' => '',
				'svalue' => __('Choose').' Nama Pabrik'
			)
		);




  $jas ="
		b = document.theform.no_tt.value;
		sql = 'SELECT pendaftar_pemutih_penyalur.alamat_pabrik,subdit.subdit as nama_propinsi_2 FROM pendaftar_pemutih_penyalur LEFT OUTER JOIN tt_pemutih_penyalur ON(tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur) LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)  WHERE tt_pemutih_penyalur.no_tt =\''+ b +'\'';

		jumpto1('frame_tt_pemutih_penyalur.php?sql='+sql+'&a='+b)

		";

	$GLOBALS['out_before_footer'] = '
 	<iframe marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=auto name=\'iframe_entry1\' id=\'iframe_entry1\' style="width:0;height:0" src="frame_tt_pemutih_penyalur.php"></iframe>
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


	// create add cek_pemutih_penyalur form
	function add_cek_pemutih_penyalur_form() {
		include_once 'class.xform.inc.php';
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		//print_r($_GET);exit();
		$record = $_GET;
		$label_arr = $this->cek_pemutih_penyalur_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('no_tt','N','8');
		$field_arr[] = xform::xf('no_rekomendasi','C','32');
		$field_arr[] = xform::xf('no_bap','C','32');
		$field_arr[] = xform::xf('nama_produk','C','32');
		$field_arr[] = xform::xf('kelengkapan','C','32');



		$field_arr[] = xform::xf('id_golongan','N','8');

		$field_arr[] = xform::xf('status_penilai','C','32');
		$field_arr[] = xform::xf('nama_penilai','C','32');
		$field_arr[] = xform::xf('date_1','N','8');

		$field_arr[] = xform::xf('status_kaseksi','C','32');
		$field_arr[] = xform::xf('nama_kaseksi','C','32');
		$field_arr[] = xform::xf('date_2','N','8');

		$field_arr[] = xform::xf('status_kasubdit','C','32');
		$field_arr[] = xform::xf('nama_kasubdit','C','32');
		$field_arr[] = xform::xf('date_3','N','8');

		$field_arr[] = xform::xf('status_direktur','C','32');
		$field_arr[] = xform::xf('nama_direktur','C','32');
		$field_arr[] = xform::xf('date_4','N','8');

		$field_arr[] = xform::xf('keterangan','C','32');


		$rs = $adodb->Execute("SELECT * FROM cek_pemutih_penyalur WHERE id_cek_pemutih='{$record['id_cek_pemutih']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_cek_pemutih'] = 'protect';
			$mode = 'edit';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}

		$optional_arr['kelengkapan'] = '';
		$optional_arr['id_cek_pemutih'] = '';
		$optional_arr['id_golongan'] = '';
		$optional_arr['no_daftar'] = '';
		$optional_arr['no_rekomendasi'] = '';
		$optional_arr['nama_produk'] = '';
		$optional_arr['nama_pabrik'] = '';
		$optional_arr['alamat'] = '';
		$optional_arr['lisensi'] = '';
		$optional_arr['status_penilai'] = '';
		$optional_arr['nama_penilai'] = '';
		$optional_arr['date_1'] = '';
		$optional_arr['status_kaseksi'] = '';
		$optional_arr['nama_kaseksi'] = '';
		$optional_arr['date_2'] = '';
		$optional_arr['status_kasubdit'] = '';
		$optional_arr['nama_kasubdit'] = '';
		$optional_arr['date_3'] = '';
		$optional_arr['status_direktur'] = '';
		$optional_arr['nama_direktur'] = '';
		$optional_arr['date_4'] = '';
		$optional_arr['keterangan'] = '';
		$optional_arr['insert_by'] = '';
		$optional_arr['date_insert'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';

		eval($this->save_config);

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


		if($value_arr['status_penilai'] == '0'){$ok1 = 'checked';$ok1text='0';$ok2='';$ok1t='Lengkap';}else{$ok1='';$ok2='checked';$ok1text='1';$ok1t='Belum Lengkap';}
		if($value_arr['status_kaseksi'] == '0'){$ok3 = 'checked';$ok2text='0';$ok4='';$ok2t='Lengkap';}else{$ok3='';$ok4='checked';$ok2text='1';$ok2t='Belum Lengkap';}
		if($value_arr['status_kasubdit'] == '0'){$ok5 = 'checked';$ok3text='0';$ok6='';$ok3t='Lengkap';}else{$ok5='';$ok6='checked';$ok3text='1';$ok3t='Belum Lengkap';}
		if($value_arr['status_direktur'] == '0'){$ok7 = 'checked';$ok4text='0';$ok8='';$ok4t='Lengkap';}else{$ok7='';$ok8='checked';$ok4text='1';$ok4t='Belum Lengkap';}

		if( $value_arr['date_1'] == '0'){ $tgl1 = '';}else{ if( $value_arr['date_1'] != ''){$tgl1 = date('d/m/Y',$value_arr['date_1']);}}
		if( $value_arr['date_2'] == '0'){ $tgl2 = '';}else{ if( $value_arr['date_2'] != ''){$tgl2 = date('d/m/Y',$value_arr['date_2']);}}
		if( $value_arr['date_3'] == '0'){ $tgl3 = '';}else{ if( $value_arr['date_3'] != ''){$tgl3 = date('d/m/Y',$value_arr['date_3']);}}
		if( $value_arr['date_4'] == '0'){ $tgl4 = '';}else{ if( $value_arr['date_4'] != ''){$tgl4 = date('d/m/Y',$value_arr['date_4']);}}

		if($ses->action == 'penilai'){
			$value_arr['nama_penilai'] = '<input type="text" name="nama_penilai" value="'.$ses->loginid.'" readonly size=11 class="text">';
			$value_arr['date_1'] = '<input type="text" name="date_1" value="'.date('d/m/Y').'" readonly size=11 class="text">';
			$value_arr['status_penilai'] = '<input type="radio" name="status_penilai" value="0" '.$ok1.' >Lengkap <input type="radio" name="status_penilai" value="1" '.$ok2.'>Belum Lengkap

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
				$value_arr['nama_penilai'] = '<input type="hidden" name="nama_penilai" value="'.$value_arr['nama_penilai'].'">'.$value_arr['nama_penilai'].'';
				$value_arr['date_1'] = '<input type="hidden" name="date_1" value="'.$tgl1.'">'.$tgl1.'';
				$value_arr['status_penilai'] = '<input type="hidden" name="status_penilai" value="'.$ok1text.'">'.$ok1t.'';

				$value_arr['nama_kaseksi'] = '<input type="text" name="nama_kaseksi" value="'.$ses->loginid.'" readonly size=11 class="text">';
				$value_arr['date_2'] = '<input type="text" name="date_2" value="'.date('d/m/Y').'" readonly size=11 class="text">';
				$value_arr['status_kaseksi'] = '<input type="radio" name="status_kaseksi" value="0" '.$ok3.' >Lengkap <input type="radio" name="status_kaseksi" value="1" '.$ok4.'>Belum Lengkap

				<input type="hidden" name="nama_kasubdit" value="'.$value_arr['nama_kasubdit'].'">
				<input type="hidden" name="date_3" value="'.$tgl3.'">
				<input type="hidden" name="status_kasubdit" value="'.$ok3text.'">
				<input type="hidden" name="nama_direktur" value="'.$value_arr['nama_direktur'].'">
				<input type="hidden" name="date_4" value="'.$tgl4.'">
				<input type="hidden" name="status_direktur" value="'.$ok4text.'">
				';

				$optional_arr['nama_kasubdit'] = TRUE;
				$optional_arr['date_3'] = TRUE;
				$optional_arr['status_kasubdit'] = TRUE;
				$optional_arr['nama_direktur'] = TRUE;
				$optional_arr['date_4'] = TRUE;
				$optional_arr['status_direktur'] = TRUE;
			}else{
				if($ses->action == 'kasubdit'){
					$value_arr['nama_penilai'] = '<input type="hidden" name="nama_penilai" value="'.$value_arr['nama_penilai'].'">'.$value_arr['nama_penilai'].'';
					$value_arr['date_1'] = '<input type="hidden" name="date_1" value="'.$tgl1.'">'.$tgl1.'';
					$value_arr['status_penilai'] = '<input type="hidden" name="status_penilai" value="'.$ok1text.'">'.$ok1t.'';

					$value_arr['nama_kaseksi'] = '<input type="hidden" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'">'.$value_arr['nama_kaseksi'].'';
					$value_arr['date_2'] = '<input type="hidden" name="date_2" value="'.$tgl2.'">'.$tgl2.'';
					$value_arr['status_kaseksi'] = '<input type="hidden" name="status_kaseksi" value="'.$ok2text.'">'.$ok2t.'';

					$value_arr['nama_kasubdit'] = '<input type="text" name="nama_kasubdit" value="'.$ses->loginid.'" readonly size=11 class="text">';
					$value_arr['date_3'] = '<input type="text" name="date_3" value="'.date('d/m/Y').'" readonly size=11 class="text">';
					$value_arr['status_kasubdit'] = '<input type="radio" name="status_kasubdit" value="0" '.$ok5.' >Lengkap <input type="radio" name="status_kasubdit" value="1" '.$ok6.'>Belum Lengkap
					
					<input type="hidden" name="nama_direktur" value="'.$value_arr['nama_direktur'].'">
					<input type="hidden" name="date_4" value="'.$tgl4.'">
					<input type="hidden" name="status_direktur" value="'.$ok4text.'">
					';

					$optional_arr['nama_direktur'] = TRUE;
					$optional_arr['date_4'] = TRUE;
					$optional_arr['status_direktur'] = TRUE;
				}else{
					if($ses->action == 'direktur'){
						$value_arr['nama_penilai'] = '<input type="hidden" name="nama_penilai" value="'.$value_arr['nama_penilai'].'">'.$value_arr['nama_penilai'].'';
						$value_arr['date_1'] = '<input type="hidden" name="date_1" value="'.$tgl1.'">'.$tgl1.'';
						$value_arr['status_penilai'] = '<input type="hidden" name="status_penilai" value="'.$ok1text.'">'.$ok1t.'';

						$value_arr['nama_kaseksi'] = '<input type="hidden" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'">'.$value_arr['nama_kaseksi'].'';
						$value_arr['date_2'] = '<input type="hidden" name="date_2" value="'.$tgl2.'">'.$tgl2.'';
						$value_arr['status_kaseksi'] = '<input type="hidden" name="status_kaseksi" value="'.$ok2text.'">'.$ok2t.'';

						$value_arr['nama_kasubdit'] = '<input type="hidden" name="nama_kasubdit" value="'.$value_arr['nama_kasubdit'].'">'.$value_arr['nama_penilai'].'';
						$value_arr['date_3'] = '<input type="hidden" name="date_3" value="'.$tgl3.'">'.$tgl3.'';
						$value_arr['status_kasubdit'] = '<input type="hidden" name="status_kasubdit" value="'.$ok3text.'">'.$ok3t.'';


						$value_arr['nama_direktur'] = '<input type="text" name="nama_direktur" value="'.$ses->loginid.'" readonly size=11 class="text">';
						$value_arr['date_4'] = '<input type="text" name="date_4" value="'.date('d/m/Y').'" readonly size=11 class="text">';
						$value_arr['status_direktur'] = '<input type="radio" name="status_direktur" value="0" '.$ok7.' >Lengkap <input type="radio" name="status_direktur" value="1" '.$ok8.'>Belum Lengkap';
					}else{
						$value_arr['nama_penilai'] = '<input type="hidden" name="nama_penilai" value="'.$value_arr['nama_penilai'].'">'.$value_arr['nama_penilai'].'';
						$value_arr['date_1'] = '<input type="hidden" name="date_1" value="'.$tgl1.'">'.$tgl1.'';
						$value_arr['status_penilai'] = '<input type="hidden" name="status_penilai" value="'.$ok1text.'">'.$ok1t.'';

						$value_arr['nama_kaseksi'] = '<input type="hidden" name="nama_kaseksi" value="'.$value_arr['nama_kaseksi'].'">'.$value_arr['nama_kaseksi'].'';
						$value_arr['date_2'] = '<input type="hidden" name="date_2" value="'.$tgl2.'">'.$tgl2.'';
						$value_arr['status_kaseksi'] = '<input type="hidden" name="status_kaseksi" value="'.$ok2text.'">'.$ok2t.'';

						$value_arr['nama_kasubdit'] = '<input type="hidden" name="nama_kasubdit" value="'.$value_arr['nama_kasubdit'].'">'.$value_arr['nama_penilai'].'';
						$value_arr['date_3'] = '<input type="hidden" name="date_3" value="'.$tgl3.'">'.$tgl3.'';
						$value_arr['status_kasubdit'] = '<input type="hidden" name="status_kasubdit" value="'.$ok3text.'">'.$ok3t.'';
						
						$value_arr['nama_direktur'] = '<input type="hidden" name="nama_direktur" value="'.$value_arr['nama_direktur'].'">'.$value_arr['nama_penilai'].'';
						$value_arr['date_4'] = '<input type="hidden" name="date_4" value="'.$tgl4.'">'.$tgl4.'';
						$value_arr['status_direktur'] = '<input type="hidden" name="status_direktur" value="'.$ok4text.'">'.$ok4t.'';

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
		if($ses->action == 'penilai'){$has = '<tr><td>No</td><td>Nama Kelengkapan</td><td>Status Penilai</td><td>Komentar Penilai</td></tr>';}
		if($ses->action == 'kaseksi'){$has = '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Status Kaseksi</td><td>Komentar Kaseksi</td></tr>';}
		if($ses->action == 'kasubdit'){$has = '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Status Kasubdit</td><td>Komentar Kasubdit</td></tr>';}
		if($ses->action == 'direktur'){$has = '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Komentar Kasubdit</td><td>Status Direktur</td><td>Komentar Direktur</td></tr>';}
		if($ses->action == 'admin'){$has = '<tr><td>No</td><td>Nama Kelengkapan</td><td>Komentar Penilai</td><td>Komentar Kaseksi</td><td>Komentar Kasubdit</td><td>Komentar Direktur</td></tr>';}
		global $adodb;
			$sqlx = "SELECT id_kelengkapan,nama_kelengkapan FROM kelengkapan_penyalur ORDER BY id_kelengkapan";
			$rsx = $adodb->Execute($sqlx);
			$a=1;
			while(! $rsx->EOF){
				if($_GET['id_cek_pemutih']){
				$sqld = "SELECT id_cek_pemutih,id_kelengkapan,status_penilai,status_kaseksi,status_kasubdit,status_direktur,alasan_penilai,alasan_kaseksi,alasan_kasubdit,alasan_direktur FROM detail_cek_pemutih_penyalur WHERE id_cek_pemutih='".$_GET['id_cek_pemutih']."' AND id_kelengkapan='".$rsx->fields['id_kelengkapan']."'";
				$rsd = $adodb->Execute($sqld);
				$id_cek_pemutihx = $rsd->fields['id_cek_pemutih'];
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
						if($status_penilaix == "1"){$check1 = "checked";$text1='Lengkap';}else{$check1 = "";$text1='Belum Lengkap';}
						if($status_kaseksix == "1"){$check2 = "checked";$text2='Lengkap';}else{$check2 = "";$text2='Belum Lengkap';}
						if($status_kasubditx == "1"){$check3 = "checked";$text3='Lengkap';}else{$check3 = "";$text3='Belum Lengkap';}
						if($status_direkturx == "1"){$check4 = "checked";$text4='Lengkap';}else{$check4 = "";$text4='Belum Lengkap';}
					}
				}
				$id_kelengkapan = $rsx->fields['id_kelengkapan'];
				$nama_kelengkapan = $rsx->fields['nama_kelengkapan'];
				$has .= "<tr><td>".$a."<input type=hidden name=id_kelengkapan[".$a."] value='".$id_kelengkapan."'</td><td>".$nama_kelengkapan."</td>";

				if($ses->action == 'penilai'){

				$has .= "<td><input type=checkbox name=status_penilaix[".$a."] value=1 class=text ".$check1."></td></td><td><textarea name=alasan_penilaix[".$a."] class='text'>".$alasan_penilaix."</textarea></td>";
				}else{
					if($ses->action == 'kaseksi'){
					if($check1 == "checked"){$has .= "<td><input type=hidden name=status_penilaix[".$a."] value='".$status_penilaix."'>".$text1.",<br><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>".$alasan_penilaix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>&nbsp;".$text1.",<br>".$alasan_penilaix."</td>";}
					$has .= "<td><input type=checkbox name=status_kaseksix[".$a."] value=1 class=text ".$check2."></td><td><textarea name=alasan_kaseksix[".$a."] class='text'>".$alasan_kaseksix."</textarea></td>";
					}else{
						if($ses->action == 'kasubdit'){
						if($check1 == "checked"){$has .= "<td><input type=hidden name=status_penilaix[".$a."] value='".$status_penilaix."'>".$text1.",<br><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>".$alasan_penilaix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>&nbsp;".$text1.",<br>".$alasan_penilaix."</td>";}
						if($check2 == "checked"){$has .= "<td><input type=hidden name=status_kaseksix[".$a."] value='".$status_kaseksix."'>".$text2.",<br><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'>".$alasan_kaseksix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'>&nbsp;".$text2.",<br>".$alasan_kaseksix."</td>";}
						$has .= "<td><input type=checkbox name=status_kasubditx[".$a."] value=1 class=text ".$check3."></td><td><textarea name=alasan_kasubditx[".$a."] class='text'>".$alasan_kasubditx."</textarea></td>";
						}else{
							if($ses->action == 'direktur'){
							if($check1 == "checked"){$has .= "<td><input type=hidden name=status_penilaix[".$a."] value='".$status_penilaix."'>".$text1.",<br><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>".$alasan_penilaix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>&nbsp;".$text1.",<br>".$alasan_penilaix."</td>";}
							if($check2 == "checked"){$has .= "<td><input type=hidden name=status_kaseksix[".$a."] value='".$status_kaseksix."'>".$text2.",<br><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'>".$alasan_kaseksix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'>&nbsp;".$text2.",<br>".$alasan_kaseksix."</td>";}
							if($check3 == "checked"){$has .= "<td><input type=hidden name=status_kasubditx[".$a."] value='".$status_kasubditx."'>".$text3.",<br><input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".$alasan_kasubditx."'>".$alasan_kasubditx."</td>";}else{ $has .= "<td><input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".$alasan_kasubditx."'>&nbsp;".$text3.",<br>".$alasan_kasubditx."</td>";}
							$has .= "<td><input type=checkbox name=status_direkturx[".$a."] value=1 class=text ".$check4."></td><td><textarea name=alasan_direkturx[".$a."] class='text'>".$alasan_direkturx."</textarea></td></tr>";
							}else{
								if($ses->action == 'admin'){
								if($check1 == "checked"){$has .= "<td><input type=hidden name=status_penilaix[".$a."] value='".$status_penilaix."'>".$text1.",<br><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>".$alasan_penilaix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_penilaix[".$a."] class='text' value='".$alasan_penilaix."'>&nbsp;".$text1.",<br>".$alasan_penilaix."</td>";}
								if($check2 == "checked"){$has .= "<td><input type=hidden name=status_kaseksix[".$a."] value='".$status_kaseksix."'>".$text2.",<br><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'>".$alasan_kaseksix."</td>";}else{ $has .= "<td><input type=hidden name=alasan_kaseksix[".$a."] class='text' value='".$alasan_kaseksix."'>&nbsp;".$text2.",<br>".$alasan_kaseksix."</td>";}
								if($check3 == "checked"){$has .= "<td><input type=hidden name=status_kasubditx[".$a."] value='".$status_kasubditx."'>".$text3.",<br><input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".$alasan_kasubditx."'>".$alasan_kasubditx."</td>";}else{ $has .= "<td><input type=hidden name=alasan_kasubditx[".$a."] class='text' value='".$alasan_kasubditx."'>&nbsp;".$text3.",<br>".$alasan_kasubditx."</td>";}
								if($check4 == "checked"){$has .= "<td><input type=hidden name=status_direkturx[".$a."] value='".$status_direkturx."'>".$text4.",<br><input type=hidden name=alasan_direkturx[".$a."] class='text' value='".$alasan_direkturx."'>".$alasan_direkturx."</td>";}else{ $has .= "<td><input type=hidden name=alasan_direkturx[".$a."] class='text' value='".$alasan_direkturx."'>&nbsp;".$text4.",<br>".$alasan_direkturx."</td>";}
								}
							}

						}
					}
				}

				$a=$a+1;
				$rsx->MoveNext();
			}

		$optional_arr['kelengkapan']='user_defined';
		$value_arr['kelengkapan'] = $has;

		$this -> slip_field($config,'alamat','after','no_tt');
		$this -> slip_field($config,'propinsi','after','alamat');

		$optional_arr['id_golongan'] = 'user_defined';
                $arr = array();
                $arr['name'] = 'id_golongan';
                $arr['selected'] = $value_arr['id_golongan'];
                $arr['sql'] = 'SELECT id_golongan as val, golongan as txt FROM gol_penyalur';
                $value_arr['id_golongan'] = xform::dbs($arr);

		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_cek_pemutih']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Laporan Pemutihan Izin Penyalur";
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

	// create update cek_pemutih_penyalur form
	function update_cek_pemutih_penyalur_form() {
		return $this->add_cek_pemutih_penyalur_form();
	}

	function view_cek_pemutih_penyalur_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		$field_arr = cek_pemutih_penyalur::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_cek_pemutih'] = 'protect';

		$record = array (
			'id_cek_pemutih' => ${$GLOBALS['get_vars']}['id_cek_pemutih']
		);
		$result = cek_pemutih_penyalur::get($record);
		$value_arr = $result[0];
		$label_arr = $this->cek_pemutih_penyalur_label;
		global $adodb;
		
		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','A4');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,'KELENGKAPAN IZIN penyalur','',0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(5);
		$sqlA = "SELECT
		id_cek_pemutih,
		no_tt,
		no_rekomendasi,
		no_bap,
		nama_produk,
		CASE WHEN status_penilai ='0' THEN 'Lengkap'
				else 'Belum Lengkap'
		END AS status_penilai,
		nama_penilai,
		date_1,
		CASE WHEN status_kaseksi ='0' THEN 'Lengkap'
				else 'Belum Lengkap'
		END AS status_kaseksi,
		nama_kaseksi,
		date_2,
		CASE WHEN status_kasubdit ='0' THEN 'Lengkap'
				else 'Belum Lengkap'
		END AS status_kasubdit,
		nama_kasubdit,
		date_3,
		CASE WHEN status_direktur ='0' THEN 'Lengkap'
				else 'Belum Lengkap'
		END AS status_direktur,
		nama_direktur,
		date_4,
		keterangan,
		insert_by,
		date_insert
		FROM cek_pemutih_penyalur
		WHERE
		id_cek_pemutih ='".$value_arr['id_cek_pemutih']."'
		";
		$hasil=$adodb->Execute($sqlA);
		while(! $hasil->EOF){
			$id_cek_pemutih = $hasil->fields['id_cek_pemutih'];
			$no_tt = $hasil->fields['no_tt'];
			$no_rekomendasi = $hasil->fields['no_rekomendasi'];
			$no_bap = $hasil->fields['no_bap'];
			$nama_produk = $hasil->fields['nama_produk'];
			$status_penilai = $hasil->fields['status_penilai'];
			$nama_penilai = $hasil->fields['nama_penilai'];
			$status_kaseksi = $hasil->fields['status_kaseksi'];
			$nama_kaseksi = $hasil->fields['nama_kaseksi'];
			$status_kasubdit = $hasil->fields['status_kaseksi'];
			$nama_kasubdit = $hasil->fields['nama_kasubdit'];
			$status_direktur = $hasil->fields['status_direktur'];
			$nama_direktur = $hasil->fields['nama_direktur'];
			$keterangan = $hasil->fields['keterangan'];

			if( $value_arr['date_1'] == '0'){ $tgl1 = '';}else{ if( $value_arr['date_1'] != ''){$tgl1 = date('d/m/Y',$value_arr['date_1']);}}
			if( $value_arr['date_2'] == '0'){ $tgl2 = '';}else{ if( $value_arr['date_2'] != ''){$tgl2 = date('d/m/Y',$value_arr['date_2']);}}
			if( $value_arr['date_3'] == '0'){ $tgl3 = '';}else{ if( $value_arr['date_3'] != ''){$tgl3 = date('d/m/Y',$value_arr['date_3']);}}
			if( $value_arr['date_4'] == '0'){ $tgl4 = '';}else{ if( $value_arr['date_4'] != ''){$tgl4 = date('d/m/Y',$value_arr['date_4']);}}

			$sqlB = "
			SELECT
			pendaftar_pemutih_penyalur.alamat_pabrik,
			pendaftar_pemutih_penyalur.nama_pabrik
			FROM
			pendaftar_pemutih_penyalur
			LEFT OUTER JOIN tt_pemutih_penyalur ON(tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)
			WHERE tt_pemutih_penyalur.no_tt ='".$no_tt."'
			";
			$hasilB = $adodb->Execute($sqlB);
			$alamat_pabrik = $hasilB->fields['alamat_pabrik'];
			
			$sqlG = "
			SELECT
			golongan
			FROM
			gol_penyalur
			WHERE id_golongan ='".$id_golongan."'";
			$hasilG = $adodb->Execute($sqlG);
			$golongan = $hasilG->fields['golongan'];


			$sqlC = "
			SELECT
			subdit.subdit
			FROM
			pendaftar_pemutih_penyalur
			LEFT OUTER JOIN tt_pemutih_penyalur ON(tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)
			WHERE tt_pemutih_penyalur.no_tt ='".$no_tt."'";
			$hasilC = $adodb->Execute($sqlC);
			$subdit = $hasilC->fields['subdit'];

			$sqlP = "
			SELECT
			pendaftar_pemutih_penyalur.nama_pabrik
			FROM
			pendaftar_pemutih_penyalur
			LEFT OUTER JOIN tt_pemutih_penyalur ON(tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur)
			LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)
			WHERE tt_pemutih_penyalur.no_tt ='".$no_tt."'";
			$hasilP = $adodb->Execute($sqlP);
			$nama_pabrik = $hasilP->fields['nama_pabrik'];

			$pdf->Cell(50,7,'No Tanda Terima','',0,'L');$pdf->Cell(50,7,': '.$no_tt.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Nama Pabrik','',0,'L');$pdf->Cell(50,7,': '.$nama_pabrik.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Alamat Pabrik','',0,'L');$pdf->Cell(50,7,': '.$alamat_pabrik.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Subdit ','',0,'L');$pdf->Cell(50,7,': '.$subdit.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'No Rekomendasi','',0,'L');$pdf->Cell(50,7,': '.$no_rekomendasi.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'No BAP','',0,'L');$pdf->Cell(50,7,': '.$no_bap.'','',0,'L');
			$pdf->Ln(5);
			$pdf->Cell(50,7,'Jenis penyalur penyalur','',0,'L');$pdf->Cell(50,7,': '.$nama_produk.'','',0,'L');
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln(5);
			$pdf->Cell(6,7,'No','LRT',0,'L');
			$pdf->Cell(25,7,'Nama','LRT',0,'C');
			$pdf->Cell(20,7,'Status','LRT',0,'C');
			$pdf->Cell(20,7,'Komentar','LRT',0,'C');
			$pdf->Cell(20,7,'Status','LRT',0,'C');
			$pdf->Cell(20,7,'komentar','LRT',0,'C');
			$pdf->Cell(20,7,'Status','LRT',0,'C');
			$pdf->Cell(20,7,'Komentar','LRT',0,'C');
			$pdf->Cell(20,7,'Status','LRT',0,'C');
			$pdf->Cell(20,7,'Komentar','LRT',0,'C');
			$pdf->Ln();
			$pdf->Cell(6,7,'','LRB',0,'L');
			$pdf->Cell(25,7,'Kelengkapan','LRB',0,'C');
			$pdf->Cell(20,7,'Penilai','LRB',0,'C');
			$pdf->Cell(20,7,'Penilai','LRB',0,'C');
			$pdf->Cell(20,7,'Kaseksi','LRB',0,'C');
			$pdf->Cell(20,7,'Kaseksi','LRB',0,'C');
			$pdf->Cell(20,7,'Kasubdit','LRB',0,'C');
			$pdf->Cell(20,7,'Kasubdit','LRB',0,'C');
			$pdf->Cell(20,7,'Direktur','LRB',0,'C');
			$pdf->Cell(20,7,'Direktur','LRB',0,'C');
			$pdf->Ln();
			$sqlD = "
			SELECT
			kelengkapan_penyalur.nama_kelengkapan,
			CASE WHEN detail_cek_pemutih_penyalur.status_penilai ='1' THEN 'Lengkap' else 'Belum Lengkap' END AS status_penilai,
			detail_cek_pemutih_penyalur.alasan_penilai,
			CASE WHEN detail_cek_pemutih_penyalur.status_kaseksi ='1' THEN 'Lengkap' else 'Belum Lengkap' END AS status_kaseksi,
			detail_cek_pemutih_penyalur.alasan_kaseksi,
			CASE WHEN detail_cek_pemutih_penyalur.status_kasubdit ='1' THEN 'Lengkap' else 'Belum Lengkap' END AS status_kasubdit,
			detail_cek_pemutih_penyalur.alasan_kasubdit,
			CASE WHEN detail_cek_pemutih_penyalur.status_direktur ='1' THEN 'Lengkap' else 'Belum Lengkap' END AS status_direktur,
			detail_cek_pemutih_penyalur.alasan_direktur
			FROM
			detail_cek_pemutih_penyalur
			LEFT OUTER JOIN kelengkapan_penyalur ON(kelengkapan_penyalur.id_kelengkapan = detail_cek_pemutih_penyalur.id_kelengkapan)
			WHERE
			id_cek_pemutih='".$id_cek_pemutih."' AND status_penilai IS NOT NULL
			";
			$hasilD = $adodb->Execute($sqlD);
			$no =1;
			while(! $hasilD->EOF){
				$pdf->Cell(6,1,'','LTR',0,'L');
				$pdf->Cell(25,1,'','LTR',0,'L');
				$pdf->Cell(20,1,'','LTR',0,'L');
				$pdf->Cell(20,1,'','LTR',0,'L');
				$pdf->Cell(20,1,'','LTR',0,'L');
				$pdf->Cell(20,1,'','LTR',0,'L');
				$pdf->Cell(20,1,'','LTR',0,'L');
				$pdf->Cell(20,1,'','LTR',0,'L');
				$pdf->Cell(20,1,'','LTR',0,'L');
				$pdf->Cell(20,1,'','LTR',0,'L');
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
				$pdf->SetFont('Arial','',7);

					$jml_nama_kelengkapan = strlen($nama_kelengkapan);
					$jml_alasan_penilaix = strlen($alasan_penilaix);
					$jml_alasan_kaseksix = strlen($alasan_kaseksix);
					$jml_alasan_kasubditx = strlen($alasan_kasubditx);
					$jml_alasan_direkturx = strlen($alasan_direkturx);

					$max = max($jml_nama_kelengkapan,$jml_alasan_penilaix,$jml_alasan_kaseksix,$jml_alasan_kasubditx,$jml_alasan_direkturx);
					$jml_hight_arr = explode('.',$max/15);
					$jml_hight = $jml_hight_arr[0] * 7;     
					
					for($a=0;$a<=$max;$a=$a+1){
						$g = $a%15;
						if(($g == 0)&&($a != 0)){
							
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
							$pdf->Cell(25,3,''.$nama_kelengkapanY.'','LR',0,'L');
							$pdf->Cell(20,3,''.$status_penilaiY.'','LR',0,'L');
							$pdf->Cell(20,3,''.$alasan_penilaiY.'','LR',0,'L');
							$pdf->Cell(20,3,''.$status_kaseksiY.'','LR',0,'L');
							$pdf->Cell(20,3,''.$alasan_kaseksiY.'','LR',0,'L');
							$pdf->Cell(20,3,''.$status_kasubditY.'','LR',0,'L');
							$pdf->Cell(20,3,''.$alasan_kasubditY.'','LR',0,'L');
							$pdf->Cell(20,3,''.$status_direkturY.'','LR',0,'L');
							$pdf->Cell(20,3,''.$alasan_direkturY.'','LR',0,'L');
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
							$status_direkturY .= $status_direkturz[$a];
							$alasan_direkturY .= $status_direkturz[$a];
						}
					}
					$noX=$no;
					if($noX==$noZ){
						$noX='';
					}else{
						$noZ=$noX;
					}

					$pdf->Cell(6,3,''.$noX.'','LR',0,'L');
					$pdf->Cell(25,3,''.$nama_kelengkapanY.'','LR',0,'L');
					$pdf->Cell(20,3,''.$status_penilaiY.'','LR',0,'L');
					$pdf->Cell(20,3,''.$alasan_penilaiY.'','LR',0,'L');
					$pdf->Cell(20,3,''.$status_kaseksiY.'','LR',0,'L');
					$pdf->Cell(20,3,''.$alasan_kaseksiY.'','LR',0,'L');
					$pdf->Cell(20,3,''.$status_kasubditY.'','LR',0,'L');
					$pdf->Cell(20,3,''.$alasan_kasubditY.'','LR',0,'L');
					$pdf->Cell(20,3,''.$status_direkturY.'','LR',0,'L');
					$pdf->Cell(20,3,''.$alasan_direkturY.'','LR',0,'L');
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
					$pdf->Cell(6,1,'','LBR',0,'L');
					$pdf->Cell(25,1,'','LBR',0,'L');
					$pdf->Cell(20,1,'','LBR',0,'L');
					$pdf->Cell(20,1,'','LBR',0,'L');
					$pdf->Cell(20,1,'','LBR',0,'L');
					$pdf->Cell(20,1,'','LBR',0,'L');
					$pdf->Cell(20,1,'','LBR',0,'L');
					$pdf->Cell(20,1,'','LBR',0,'L');
					$pdf->Cell(20,1,'','LBR',0,'L');
					$pdf->Cell(20,1,'','LBR',0,'L');
					$pdf->Ln();

				$no = $no+1;
			$hasilD->MoveNext();
			}

		$hasil->MoveNext();
		}
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(10);
		$pdf->Cell(50,7,'Golongan','',0,'L');$pdf->Cell(50,7,': '.$golongan.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(50,7,'Status Penilai','',0,'L');$pdf->Cell(50,7,': '.$status_penilai.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Nama Penilai','',0,'L');$pdf->Cell(50,7,': '.$nama_penilai.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Tanggal Satu','',0,'L');$pdf->Cell(50,7,': '.$tgl1.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(50,7,'Status kaseksi','',0,'L');$pdf->Cell(50,7,': '.$status_kaseksi.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Nama Kaseksi','',0,'L');$pdf->Cell(50,7,': '.$nama_kaseksi.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Tanggal Dua','',0,'L');$pdf->Cell(50,7,': '.$tgl2.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(50,7,'Status kasubdit','',0,'L');$pdf->Cell(50,7,': '.$status_kasubdit.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Nama Kasubdit','',0,'L');$pdf->Cell(50,7,': '.$nama_kasubdit.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Tanggal Tiga','',0,'L');$pdf->Cell(50,7,': '.$tgl3.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(50,7,'Status Direktur','',0,'L');$pdf->Cell(50,7,': '.$status_direktur.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Nama Direktur','',0,'L');$pdf->Cell(50,7,': '.$nama_direktur.'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'Tanggal Empat','',0,'L');$pdf->Cell(50,7,': '.$tgl4.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(50,7,'No SKK','',0,'L');$pdf->Cell(50,7,': ','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(50,7,'NO Izin penyalur','',0,'L');$pdf->Cell(50,7,': ','',0,'L');

		$pdf->Output();


		$_form = $lamp;

		return $_form;
	}
	// handle event add cek_pemutih_penyalur
	function add_cek_pemutih_penyalur() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		//foreach ($record as $k => $v) $record[$k] = trim($v);
		$jml_kelengkapan = count($_POST['id_kelengkapan']);
		 
		$adodb->Execute("DELETE FROM detail_cek_pemutih_penyalur WHERE id_cek_pemutih = '".$_POST['oldpkvalue']."'");
		$adodb->Execute("DELETE FROM cek_pemutih_penyalur WHERE id_cek_pemutih = '".$_POST['oldpkvalue']."'");

			$record = array (
				'id_golongan' => $_POST['id_golongan'],
				'no_rekomendasi' => $_POST['no_rekomendasi'],
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
				'nama_produk' => $_POST['nama_produk'],
				'no_tt' => $_POST['no_tt'],
				'insert_by' => $GLOBALS['ses']->loginid,
				'date_insert' => time()
			);

		cek_pemutih_penyalur::add($record);

		$rsx = $adodb->Execute("SELECT id_cek_pemutih FROM cek_pemutih_penyalur ORDER BY id_cek_pemutih DESC LIMIT 1");
		$id_cek_pemutih = $rsx->fields['id_cek_pemutih'];

		include "class.detail_cek_pemutih_penyalur.inc.php";
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
					'id_cek_pemutih' => $id_cek_pemutih,
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
				detail_cek_pemutih_penyalur::add($record);
		}

		$status = "Successfull $st '<b>{$record['id_cek_pemutih']}</b>'";
		$this->log($status);

		$_block = new block();
		$_block->set_config('title', 'Laporan Pemutihan Izin Penyalur');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}

	// handle event update cek_pemutih_penyalur
	function update_cek_pemutih_penyalur() {
		return $this->add_cek_pemutih_penyalur();
	}

	// handle delete cek_pemutih_penyalur
	function delete_cek_pemutih_penyalur() {
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
		if ($query){
                        $success = $adodb->Execute("delete from cek_pemutih_penyalur where ".$query);
			$success = $adodb->Execute("delete from detail_cek_pemutih_penyalur where ".$query);
		}
                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'cek_pemutih_penyalur <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'cek_pemutih_penyalur <font color=red>'.$query.'</font>';
                }
                $this->log($status);

                $_block = new block();
                $_block->set_config('title', ('Delete Laporan Pemutihan Izin Penyalur'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list cek_pemutih_penyalur
	function list_cek_pemutih_penyalur($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = "
		SELECT
		cek_pemutih_penyalur.id_cek_pemutih,
		subdit.subdit,
		tt_pemutih_penyalur.no_tt,
		pendaftar_pemutih_penyalur.nama_pendaftar_pemutih_penyalur,
		pendaftar_pemutih_penyalur.nama_pabrik,
		tt_pemutih_penyalur.no_tt as status,
		tt_pemutih_penyalur.no_tt as status_pending,
		tt_pemutih_penyalur.no_tt as status_tolak,
		tt_pemutih_penyalur.no_tt as status_selesai,
		cek_pemutih_penyalur.nama_penilai,
		cek_pemutih_penyalur.nama_kaseksi,
		cek_pemutih_penyalur.nama_kasubdit,
		cek_pemutih_penyalur.nama_direktur,
		cek_pemutih_penyalur.keterangan,
		cek_pemutih_penyalur.date_insert,
		cek_pemutih_penyalur.insert_by
		FROM
		tt_pemutih_penyalur
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.no_tt = tt_pemutih_penyalur.no_tt)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit = tt_pemutih_penyalur.kode_subdit)
		LEFT OUTER JOIN pendaftar_pemutih_penyalur ON(pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur)
		";

		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['subdit'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_cek_pemutih' => TRUE,
			'name' => TRUE,
			'insert_by' => FALSE,
			'subdit' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		
		$eval_arr['no_sk'] = '
		$sk = "%s";

		$Aql = "
		SELECT
		no_surat_keputusan_pemutih
		FROM
		surat_keputusan_pemutih
		WHERE id_cek_pemutih =\'$sk\'";

		global $adodb;
		$skA = $adodb->Execute($Aql);
		$skA = $skA->fields[\'no_surat_keputusan_pemutih\'];
		if($skA !=""){
		$str .= $skA;
		}else{
		$str .= "&nbsp;";
		}
		';

		$eval_arr['no_tt'] = '
		$f = "%s";
		$no_ttnya = "%s";

		$Aql = "
		SELECT
		tt_pemutih_penyalur.urut_no_tt
		FROM
		pendaftar_pemutih_penyalur
		LEFT OUTER JOIN tt_pemutih_penyalur ON(tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)
		WHERE tt_pemutih_penyalur.no_tt =\'$f\'";

		global $adodb;
		$A = $adodb->Execute($Aql);
		$FA = $A->fields[\'urut_no_tt\'];
		$str .=$FA;
		';
		
		$eval_arr['no_ttX'] = '1
		$f = "%s";

		$Aql = "
		SELECT
		pendaftar_pemutih_penyalur.nama_pabrik
		FROM
		pendaftar_pemutih_penyalur
		LEFT OUTER JOIN tt_pemutih_penyalur ON(tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)
		WHERE tt_pemutih_penyalur.no_tt =\'$f\'";

		global $adodb;
		$A = $adodb->Execute($Aql);
		$FA = $A->fields[\'nama_pabrik\'];
		$str .=$FA;
		';
		
		$eval_arr['alamat'] = '
		$b = "%s";

		$Aql = "
		SELECT
		pendaftar_pemutih_penyalur.alamat_pabrik
		FROM
		pendaftar_pemutih_penyalur
		LEFT OUTER JOIN tt_pemutih_penyalur ON(tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)
		WHERE tt_pemutih_penyalur.no_tt =\'$b\'";

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
		pendaftar_pemutih_penyalur
		LEFT OUTER JOIN tt_pemutih_penyalur ON(tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)
		WHERE tt_pemutih_penyalur.no_tt =\'$c\'";

		global $adodb;
		$C = $adodb->Execute($Bql);
		$FC = $C->fields[\'subdit\'];
		$str .=$FC;
		';
		
		/*$eval_arr['golongan'] = '
		$E = "%s";

		$Aql = "$eval_arr['no_tt'] = '
		$f = "%s";

		$Aql = "
		SELECT
		tt_pemutih_penyalur.urut_no_tt
		FROM
		pendaftar_pemutih_penyalur
		LEFT OUTER JOIN tt_pemutih_penyalur ON(tt_pemutih_penyalur.kode_pendaftar_pemutih_penyalur = pendaftar_pemutih_penyalur.kode_pendaftar_pemutih_penyalur)
		LEFT OUTER JOIN subdit ON(subdit.id_subdit=tt_pemutih_penyalur.kode_subdit)
		WHERE tt_pemutih_penyalur.no_tt =\'$f\'";

		global $adodb;
		$A = $adodb->Execute($Aql);
		$FA = $A->fields[\'urut_no_tt\'];
		$str .=$FA;
		';


		SELECT
		golongan
		FROM
		gol_penyalur
		WHERE id_golongan =\'$E\'";
2--
		global $adodb;
		$A = $adodb->Execute($Aql);
		$FA = $A->fields[\'golongan\'];2--
		$str .=$FA;
		';
		
		*/

		$eval_arr['detail'] = '
		$USql = "
			SELECT
			kelengkapan_penyalur.nama_kelengkapan,
			CASE WHEN detail_cek_pemutih_penyalur.status_penilai =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_penilai,
			detail_cek_pemutih_penyalur.alasan_penilai,
			CASE WHEN detail_cek_pemutih_penyalur.status_kaseksi =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_kaseksi,
			detail_cek_pemutih_penyalur.alasan_kaseks,
			CASE WHEN detail_cek_pemutih_penyalur.status_kasubdit =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_kasubdit,
			detail_cek_pemutih_penyalur.alasan_kasubdit,
			CASE WHEN detail_cek_pemutih_penyalur.status_direktur =\'1\' THEN \'Lengkap\' else \'Belum Lengkap\' END AS status_direktur,
			detail_cek_pemutih_penyalur.alasan_direktur
			FROM
			detail_cek_pemutih_penyalur
			LEFT OUTER JOIN kelengkapan_penyalur ON(kelengkapan_penyalur.id_kelengkapan = detail_cek_pemutih_penyalur.id_kelengkapan)
			WHERE
			id_cek_pemutih=\'%s\' AND detail_cek_pemutih_penyalur.alasan_kaseksi IS NOT NULL
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
			$FD = $S->fields[\'status_kaseksi\'];2--
			$FE = $S->fields[\'alasan_kaseksi\'];
			$FF = $S->fields[\'status_kasubdit\'];
			$FG = $S->fields[\'alasan_kasubdit\'];
			$FH = $S->fields[\'status_direktur\'];
			$FI = $S->fields[\'alasan_direktur\'];

   			$str .= "<tr><td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$c.".".$FA."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FB."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FC."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FD."</td>";
			$str .= "<td style=\'border-width1:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FE."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FF."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FG."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FH."</td>";
			$str .= "<td style=\'border-width:1px;border-style:solid;border-color:#000000\'>&nbsp;".$FI."</td></tr>";
			$S->MoveNext();
			}
   		$str .="</table>";
		';
		
		//PAKE NO_TT BUKAN PAKE ID_cek_pemutih JADI SENEN BENERIN YA OK
		$eval_arr['status'] = '
		global $adodb;
		$f = "%s";

		$Aql = "
		SELECT
		surat_keputusan_pemutih.id_cek_pemutih,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_keputusan_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_keputusan_pemutih.id_cek_pemutih)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsA = $adodb->Execute($Aql);
		$A = $rsA->fields[no_tt];

		$Bql = "
		SELECT
		surat_penolakan_pemutih.id_cek_pemutih,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_penolakan_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_penolakan_pemutih.id_cek_pemutih)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsB = $adodb->Execute($Bql);
		$B = $rsB->fields[no_tt];

		$Cql = "
		SELECT
		surat_tambahan_data_pemutih.kepada_surat,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_tambahan_data_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_tambahan_data_pemutih.kepada_surat)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsC = $adodb->Execute($Cql);
		$C = $rsC->fields[no_tt];

		$Dql = "
		SELECT
		id_cek_pemutih,
		no_tt
		FROM
		cek_pemutih_penyalur
		WHERE no_tt =\'$f\'";
		$rsD = $adodb->Execute($Dql);
		$D = $rsD->fields[no_tt];

		if((!$A) && (!$B) &&(!$C) &&(!$D)){
		 $rsU = $adodb->Execute("select urut_no_tt FROM tt_pemutih_penyalur WHERE no_tt=\'$f\'");
		 $str .= "&nbsp;".$rsU->fields[urut_no_tt];
		}else{
		 $str .= "&nbsp;";
		}

		';

		$eval_arr['status_pending'] = '
		global $adodb;
		$f = "%s";

		$Aql = "
		SELECT
		surat_keputusan_pemutih.id_cek_pemutih,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_keputusan_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_keputusan_pemutih.id_cek_pemutih)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsA = $adodb->Execute($Aql);
		$A = $rsA->fields[no_tt];

		$Bql = "
		SELECT
		surat_penolakan_pemutih.id_cek_pemutih,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_penolakan_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_penolakan_pemutih.id_cek_pemutih)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsB = $adodb->Execute($Bql);
		$B = $rsB->fields[no_tt];

		$Cql = "
		SELECT
		surat_tambahan_data_pemutih.kepada_surat,
		surat_tambahan_data_pemutih.nomor_surat,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_tambahan_data_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_tambahan_data_pemutih.kepada_surat)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsC = $adodb->Execute($Cql);
		$nomor_surat = $rsC->fields[nomor_surat];
		$C = $rsC->fields[no_tt];

		$Dql = "
		SELECT
		id_cek_pemutih,
		no_tt
		FROM
		cek_pemutih_penyalur
		WHERE no_tt =\'$f\'";
		$rsD = $adodb->Execute($Dql);
		$D = $rsD->fields[no_tt];
  		
		if($nomor_surat == ""){$surat = "Cek Kelengkapan";}else{$surat=$nomor_surat;}

		//print $A." -- ".$B." -- ".$C." -- ".$D." -- ";
		if((!$A) && (!$B)){
                 if($D ==""){$surat = "";}else{$surat = $surat;}
		 $str .= "&nbsp;".$surat;

		}else{
		 $str .= "&nbsp;";
		}
		';
		
		$eval_arr['status_tolak'] = '
		global $adodb;
		$f = "%s";

		$Aql = "
		SELECT
		surat_keputusan_pemutih.id_cek_pemutih,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_keputusan_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_keputusan_pemutih.id_cek_pemutih)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsA = $adodb->Execute($Aql);
		$A = $rsA->fields[no_tt];

		$Bql = "
		SELECT
		surat_penolakan_pemutih.id_cek_pemutih,
		surat_penolakan_pemutih.nomor_surat as nomor_surat_penolakan_pemutih,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_penolakan_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_penolakan_pemutih.id_cek_pemutih)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsB = $adodb->Execute($Bql);
		$nomor_surat_penolakan_pemutih = $rsB->fields[nomor_surat_penolakan_pemutih];
		$B = $rsB->fields[no_tt];

		$Cql = "
		SELECT
		surat_tambahan_data_pemutih.kepada_surat,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_tambahan_data_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_tambahan_data_pemutih.kepada_surat)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsC = $adodb->Execute($Cql);
		$C = $rsC->fields[no_tt];
		
		$Dql = "
		SELECT
		id_cek_pemutih,
		no_tt
		FROM
		cek_pemutih_penyalur
		WHERE no_tt =\'$f\'";
		$rsD = $adodb->Execute($Dql);
		$D = $rsD->fields[no_tt];

		//print $A." -- ".$B." -- ".$C." -- ".$D." -- ";
		if($B){
		 $str .= "&nbsp;".$nomor_surat_penolakan_pemutih;
		}else{
		 $str .= "&nbsp;";
		}
		';
		
		
		$eval_arr['status_selesai'] = '
		global $adodb;
		$f = "%s";

		$Aql = "
		SELECT
		surat_keputusan_pemutih.id_cek_pemutih,
		surat_keputusan_pemutih.no_surat_keputusan_pemutih,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_keputusan_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_keputusan_pemutih.id_cek_pemutih)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsA = $adodb->Execute($Aql);
		$no_surat_keputusan_pemutih = $rsA->fields[no_surat_keputusan_pemutih];
		$A = $rsA->fields[no_tt];

		$Bql = "
		SELECT
		surat_penolakan_pemutih.id_cek_pemutih,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_penolakan_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_penolakan_pemutih.id_cek_pemutih)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsB = $adodb->Execute($Bql);
		$B = $rsB->fields[no_tt];

		$Cql = "
		SELECT
		surat_tambahan_data_pemutih.kepada_surat,
		cek_pemutih_penyalur.no_tt
		FROM
		surat_tambahan_data_pemutih
		LEFT OUTER JOIN cek_pemutih_penyalur ON(cek_pemutih_penyalur.id_cek_pemutih = surat_tambahan_data_pemutih.kepada_surat)
		WHERE
		cek_pemutih_penyalur.no_tt =\'$f\'";
		$rsC = $adodb->Execute($Cql);
		$C = $rsC->fields[no_tt];
		
		$Dql = "
		SELECT
		id_cek_pemutih,
		no_tt
		FROM
		cek_pemutih_penyalur
		WHERE no_tt =\'$f\'";
		$rsD = $adodb->Execute($Dql);
		$D = $rsD->fields[no_tt];
		
		//print $A." -- ".$B." -- ".$C." -- ".$D." -- ";
		if(($A)){
		 $str .= "&nbsp;".$no_surat_keputusan_pemutih;
		}else{
		 $str .= "&nbsp;";
		}
		';


		$pk = array (
			'id_cek_pemutih' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
		/*	$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 800, 600, null, null, \'add_cek_pemutih_penyalur\');'.
			'win.focus()',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
		*/
//		}
//		if ($this->get_permission('fill_this')) {
		/*	$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 800, 600, null, null, \'edit_cek_pemutih_penyalur\');'.
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
		*/
//		}
//		if ($this->get_permission('fill_this')) {
		/*	$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' .
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_cek_pemutih_penyalur\')'.
			'win.focus()):' .
			'alert(\''.__('Cancelling Delete').'\');',
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
		*/
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_cek_pemutih_penyalur\');'.
			'win.focus()',
			"label"=>__('Print'),
			"type"=>"button",
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->cek_pemutih_penyalur_label;
		$config = array (
			'id'		=> 'cek_pemutih_penyalur',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $add_anchor,
			//'edit_anchor'	=> "<nobr>".$edit_anchor."|".$view_anchor,
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Laporan Pemutihan Izin Penyalur'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print cek_pemutih_penyalur
	function print_cek_pemutih_penyalur() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_cek_pemutih_penyalur($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$cek_pemutih_penyalur_controller = new cek_pemutih_penyalur_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $cek_pemutih_penyalur_controller->add_cek_pemutih_penyalur_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $cek_pemutih_penyalur_controller->add_cek_pemutih_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad();OnChangeno_tt()"';
			$out_content = $cek_pemutih_penyalur_controller->update_cek_pemutih_penyalur_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $cek_pemutih_penyalur_controller->update_cek_pemutih_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $cek_pemutih_penyalur_controller->view_cek_pemutih_penyalur_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $cek_pemutih_penyalur_controller->delete_cek_pemutih_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $cek_pemutih_penyalur_controller->import_cek_pemutih_penyalur_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $cek_pemutih_penyalur_controller->import_cek_pemutih_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $cek_pemutih_penyalur_controller->print_cek_pemutih_penyalur();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $cek_pemutih_penyalur_controller->list_cek_pemutih_penyalur();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Laporan Pemutihan Izin Penyalur';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

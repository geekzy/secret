<?php

	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('cek_controller')) {
	// do nothing
} else if (defined('CLASS_cek_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_cek_CONTROLLER', TRUE);

include_once 'class.cek.inc.php';
class cek_controller extends depkes2_manager {
	var $cek_label;
	var $optional_arr;
	function cek_controller() {
		$this->cek_label = array (
			'id_cek_1' => 'Id Check Alkes',
			'id_golongan' => 'Golongan',
			'nama_pendaftar' => 'Nama Pendaftar',
			'status_pending' => 'Status Pending',
			'status_tolak' => 'Status Tolak',
			'status_selesai' => 'Status Selesai',
			'no_sk' => 'No SK',
			'no_izin' => 'No Izin Produksi',
			'no_daftar' => 'No Daftar',
			'status' => 'Status',                     
			'jenis_izin_produksi' => 'Jenis Izin Produksi',
			'no_tt' => 'No Tanda Terima',
			'no_rekomendasi' => 'No Rekomendasi',
			'nama_produk' => 'Jenis Alkes Yang Diproduksi',
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

	// handle list cek
	function list_cek($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		#CASE WHEN tt.jenis_izin_produksi='0' THEN 'Izin Produksi Alkes'
		#ELSE
		#'Izin Produksi PKRT' END as jenis_izin_produksi,
		#tt.no_tt as status,
		#tt.no_tt as status_pending,
		$sql = "
		SELECT
		cek.id_cek_1,
		tt.urut_no_tt as no_tt,
		pendaftar.nama_pendaftar,
		pendaftar.nama_pabrik,
		
		CASE WHEN (sk.id_cek_1 IS NOT NULL) THEN 'SK'
		WHEN (sp.id_cek_1 IS NOT NULL) THEN 'TOLAK'
		WHEN (st.kepada_surat IS NOT NULL) THEN 'TAMBAH'
		WHEN (cek.id_cek_1 IS NOT NULL) THEN 'CEK' 
		WHEN (cek.id_cek_1 IS NULL) THEN 'INBOX'
		ELSE '' END as status,
		
		st.nomor_surat as status_pending,
		sp.nomor_surat as status_tolak,
		sk.no_sk as status_selesai,
		cek.nama_penilai,
		cek.nama_kaseksi,
		cek.nama_kasubdit,
		cek.nama_direktur,
		cek.keterangan,
		cek.date_insert,
		cek.insert_by
		FROM
		".$GLOBALS[my_tt]." tt
		LEFT OUTER JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON (pendaftar.kode_pendaftar = tt.kode_pendaftar)
		LEFT OUTER JOIN ".$GLOBALS[my_cek]." cek ON (tt.no_tt = cek.no_tt)
		LEFT OUTER JOIN ".$GLOBALS[my_st]." st ON (cek.id_cek_1 = st.kepada_surat)
		LEFT OUTER JOIN ".$GLOBALS[my_sk]." sk ON (cek.id_cek_1 = sk.id_cek_1)
		LEFT OUTER JOIN ".$GLOBALS[my_sp]." sp ON (cek.id_cek_1 = sp.id_cek_1)
		[where]
		ORDER BY tt.urut_no_tt DESC
		";

		global $ses;
		if (ereg('pendaftar', $ses->action)) {
			$sql = str_replace('[where]', "WHERE pendaftar.userid = '".$ses->loginid."'", $sql);
		} else {
			$sql = str_replace('[where]', "", $sql);
		}
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['subdit'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_cek_1' => TRUE,
			'name' => TRUE,
			'insert_by' => FALSE,
			'subdit' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		
		$pk = array (
			'id_cek_1' => TRUE
		);
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_cek\');'.
			'win.focus()',
			"label"=>__('Print'),
			"type"=>"button",
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->cek_label;
		$config = array (
			'id'		=> 'cek',
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
			'form_title'	=> __('List').' Laporan Izin Produksi'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print cek
	function print_cek() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_cek($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$cek_controller = new cek_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $cek_controller->add_cek_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $cek_controller->add_cek();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad();OnChangeno_tt()"';
			$out_content = $cek_controller->update_cek_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $cek_controller->update_cek();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $cek_controller->view_cek_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $cek_controller->delete_cek();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $cek_controller->import_cek_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $cek_controller->import_cek();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $cek_controller->print_cek();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $cek_controller->list_cek();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Laporan Izin Produksi';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

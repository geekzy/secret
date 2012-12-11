<?php


	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('pemohon_ubah_ijin_produksi_controller')) {
	// do nothing
} else if (defined('CLASS_pemohon_ubah_ijin_produksi_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_pemohon_ubah_ijin_produksi_CONTROLLER', TRUE);

include_once 'class.pemohon_ubah_ijin_produksi.inc.php';
class pemohon_ubah_ijin_produksi_controller extends depkes2_manager {
	var $pemohon_ubah_ijin_produksi_label;
	var $optional_arr;
	function pemohon_ubah_ijin_produksi_controller() {
		$this->pemohon_ubah_ijin_produksi_label = array (
			'id_pemohon_ubah_ijin_produksi' => 'id_pemohon_ubah_ijin_produksi',
			'kode_pemohon_ubah_ijin_produksi' => 'Kode Pemohon Ubah Ijin Produksi',
			'no_surat_keputusan' => 'No SK',
			'nama_pabrik' => 'Nama Pabrik',
			'alamat_pendaftar' => 'Kota Pemohon',
			'notelp_1' => 'No Telp Pemohon',
			'nama_propinsi_1' => 'Nama Propinsi Pemohon',
			'npwp' => 'NPWP',
			'nama_pabrik' => 'Nama Pabrik',
			'alamat_pabrik' => 'Alamat Pabrik',
			'notelp_2' => 'No Telp Pabrik',
			'nama_propinsi_2' => 'Nama Propinsi Pabrik',
			'alamat_bengkel' => 'ALamat Bengkel',
			'notelp_3' => 'No Tlp Bengkel',
			'alamatgudang' => 'Alamat Gudang',
			'notelp_4' => 'No Tlp Gudang',
			'nama_direktur' => 'Nama Direktur',
			'namapenanggungjwb' => 'Nama Penaggung Jwb',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_pemohon_ubah_ijin_produksi' => TRUE,
			'nama_pemohon_ubah_ijin_produksi' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}

	
	function no_surat_keputusan_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['no_surat_keputusan'];

		include_once 'class.surat_keputusan.inc.php';
		$fk_sql = ''.
			'SELECT
				surat_keputusan.no_surat_keputusan as skey,
				surat_keputusan.no_surat_keputusan as svalue,
				pendaftar.nama_pabrik as svalue2
			FROM
				surat_keputusan
			LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
			LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
			ORDER BY
		surat_keputusan.no_surat_keputusan
			';
		$result = surat_keputusan::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('no_surat_keputusan');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->pemohon_ubah_ijin_produksi_label['no_surat_keputusan'].' - Nama Pemohon'
			)
		);

	
	  $jas ="
		b = document.theform.no_surat_keputusan.value;
		jumpto1('frame_ubah_ijin_produksi.php?a='+b)
		";

		$GLOBALS['out_before_footer'] = '
	<script language=javascript>
	function jumpto1(inputurl){
	document.getElementById(\'iframe_ubah\').src=inputurl
	}
	</script>
	'.$GLOBALS['out_before_footer']
	;


		$result = array_merge($default_value, $result);

		$result = array_merge($default_value, $result);
		$optional_arr['no_surat_keputusan'] = 'user_defined';
		$value_arr['no_surat_keputusan'] = $this->select_form('no_surat_keputusan', $result, $selected,$multiple=FALSE,$jas).'
		<br><iframe marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=no name=\'iframe_ubah\' id=\'iframe_ubah\' style="width:100%;height:300" src="frame_ubah_ijin_produksi.php"></iframe>
		';
		$optional_arr['no_surat_keputusan_rule'] = "\n".
		"       if(theform.no_surat_keputusan.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['no_surat_keputusan']." ".__('empty').".');\n".
		"               theform.no_surat_keputusan.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";

	}


	// create add pemohon_ubah_ijin_produksi form
	function add_pemohon_ubah_ijin_produksi_form() {
		include_once 'class.xform.inc.php';

//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->pemohon_ubah_ijin_produksi_label;
		$optional_arr = $this->optional_arr;
		
		$field_arr[] = xform::xf('kode_pemohon_ubah_ijin_produksi','N','4');
		$field_arr[] = xform::xf('no_surat_keputusan','C','255');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');
		
		$rs = $adodb->Execute("SELECT * FROM pemohon_ubah_ijin_produksi WHERE id_pemohon_ubah_ijin_produksi='{$record['id_pemohon_ubah_ijin_produksi']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_pemohon_ubah_ijin_produksi'] = 'protect';
			$mode = 'edit';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}
		
		$optional_arr['kode_pemohon_ubah_ijin_produksi_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';
		
		eval($this->save_config);
		$this->no_surat_keputusan_form($config);		
		

		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_pemohon_ubah_ijin_produksi']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Pemohon Perubahan Ijin Produksi";
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

	// create update pemohon_ubah_ijin_produksi form
	function update_pemohon_ubah_ijin_produksi_form() {
		return $this->add_pemohon_ubah_ijin_produksi_form();
	}

	// handle event add pemohon_ubah_ijin_produksi
	function add_pemohon_ubah_ijin_produksi() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);
		
		
		$rs = $adodb->Execute("SELECT * FROM pemohon_ubah_ijin_produksi WHERE id_pemohon_ubah_ijin_produksi = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			if(${$GLOBALS['post_vars']}['passwd'])
				{$record['passwd'] = md5(${$GLOBALS['post_vars']}['passwd']);}else
				{$record['passwd'] = ${$GLOBALS['post_vars']}['oldpasswd'];}
			$st = "Updated";
		} else {
			$record['insert_by'] = $ses->loginid;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM pemohon_ubah_ijin_produksi WHERE id_pemohon_ubah_ijin_produksi = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st '<b>{$record['id_pemohon_ubah_ijin_produksi']}</b>'";
		$this->log($status);

		$_block = new block();
		$_block->set_config('title', ' Pemohon Perubahan Ijin Produksi Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}
	
	// handle event update pemohon_ubah_ijin_produksi
	function update_pemohon_ubah_ijin_produksi() {
		return $this->add_pemohon_ubah_ijin_produksi();
	}

	// handle delete pemohon_ubah_ijin_produksi
	function delete_pemohon_ubah_ijin_produksi() {
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
		if ($query)
                        $success = $adodb->Execute("delete from pemohon_ubah_ijin_produksi where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'pemohon_ubah_ijin_produksi <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'pemohon_ubah_ijin_produksi <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Pemohon Perubahan Ijin Produksi Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list pemohon_ubah_ijin_produksi
	function list_pemohon_ubah_ijin_produksi($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = "
		SELECT
		pemohon_ubah_ijin_produksi.id_pemohon_ubah_ijin_produksi,
		pemohon_ubah_ijin_produksi.kode_pemohon_ubah_ijin_produksi,
		pemohon_ubah_ijin_produksi.no_surat_keputusan,
		pendaftar.nama_pabrik,
		pendaftar.alamat_pendaftar,
		pendaftar.notelp_1,
		pendaftar.nama_propinsi_1,
		pendaftar.npwp,
		pendaftar.nama_pabrik,
		pendaftar.alamat_pabrik,
		pendaftar.notelp_2,
		pendaftar.nama_propinsi_2,
		pendaftar.alamat_bengkel,
		pendaftar.notelp_3,
		pendaftar.alamatgudang,
		pendaftar.notelp_4,
		pendaftar.nama_direktur,
		pendaftar.namapenanggungjwb
		FROM
		pemohon_ubah_ijin_produksi
		LEFT OUTER JOIN surat_keputusan ON(surat_keputusan.no_surat_keputusan = pemohon_ubah_ijin_produksi.no_surat_keputusan )
		LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
		LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
		LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
		LEFT OUTER JOIN tt_2_alkes ON(tt_2_alkes.kode_pendaftar = pemohon_ubah_ijin_produksi.kode_pemohon_ubah_ijin_produksi)
		";
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_pemohon_ubah_ijin_produksi' => TRUE,
			'nama_pemohon_ubah_ijin_produksi' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'id_pemohon_ubah_ijin_produksi' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 800, 500, null, null, \'add_pemohon_ubah_ijin_produksi\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\',800, 500, null, null, \'edit_pemohon_ubah_ijin_produksi\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_pemohon_ubah_ijin_produksi\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_pemohon_ubah_ijin_produksi\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->pemohon_ubah_ijin_produksi_label;
		$config = array (
			'id_pemohon_ubah_ijin_produksi'		=> 'pemohon_ubah_ijin_produksi',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $add_anchor,
			'edit_anchor'	=> $edit_anchor,
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Pemohon Perubahan Ijin Produksi '.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print pemohon_ubah_ijin_produksi
	function print_pemohon_ubah_ijin_produksi() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_pemohon_ubah_ijin_produksi($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$pemohon_ubah_ijin_produksi_controller = new pemohon_ubah_ijin_produksi_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $pemohon_ubah_ijin_produksi_controller->add_pemohon_ubah_ijin_produksi_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $pemohon_ubah_ijin_produksi_controller->add_pemohon_ubah_ijin_produksi();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad();OnChangeno_surat_keputusan()"';
			$out_content = $pemohon_ubah_ijin_produksi_controller->update_pemohon_ubah_ijin_produksi_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $pemohon_ubah_ijin_produksi_controller->update_pemohon_ubah_ijin_produksi();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $pemohon_ubah_ijin_produksi_controller->delete_pemohon_ubah_ijin_produksi();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $pemohon_ubah_ijin_produksi_controller->import_pemohon_ubah_ijin_produksi_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $pemohon_ubah_ijin_produksi_controller->import_pemohon_ubah_ijin_produksi();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $pemohon_ubah_ijin_produksi_controller->print_pemohon_ubah_ijin_produksi();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $pemohon_ubah_ijin_produksi_controller->list_pemohon_ubah_ijin_produksi();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Pemohon Perubahan Ijin Produksi Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

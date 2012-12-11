<?php

	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('inbox_pemutih_produksi_seksi_controller')) {
	// do nothing
} else if (defined('CLASS_inbox_pemutih_produksi_seksi_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_inbox_pemutih_produksi_seksi_CONTROLLER', TRUE);

include_once 'class.inbox_pemutih_produksi_seksi.inc.php';
class inbox_pemutih_produksi_seksi_controller extends depkes2_manager {
	var $inbox_pemutih_produksi_seksi_label;
	var $optional_arr;
	function inbox_pemutih_produksi_seksi_controller() {
		$this->inbox_pemutih_produksi_seksi_label = array (
			'id_inbox_pemutih_produksi_seksi' => 'id_inbox_pemutih_produksi_seksi',
			'urut_no_tt' => 'No Pemohon',
			'no_tt' => 'No Pemohon',
			'userid' => 'Seksi',
			'name' => 'Seksi',
			'keterangan' => 'Keterangan',
			'nama_pendaftar_pemutih' => 'Nama Pemohon',
			'read' => 'Read',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_inbox_pemutih_produksi_seksi' => TRUE,
			'nama_inbox_pemutih_produksi_seksi' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	// create add inbox_pemutih_produksi_seksi form
	function add_inbox_pemutih_produksi_seksi_form() {
		include_once 'class.xform.inc.php';

//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->inbox_pemutih_produksi_seksi_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('id_inbox_pemutih_produksi_seksi','C','32');
		$field_arr[] = xform::xf('no_tt','C','32');
		$field_arr[] = xform::xf('nama_pendaftar_pemutih','C','32');
		$field_arr[] = xform::xf('keterangan','C','32');
		$field_arr[] = xform::xf('read','C','32');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');


		$rs = $adodb->Execute("SELECT * FROM inbox_pemutih_produksi_seksi WHERE id_inbox_pemutih_produksi_seksi='{$record['id_inbox_pemutih_produksi_seksi']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_inbox_pemutih_produksi_seksi'] = 'protect';
			$mode = 'edit';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}

		$optional_arr['nama_inbox_pemutih_produksi_seksi_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';

		eval($this->save_config);

		$no_tt = $_GET['no_tt'];
		$sqlP = "
		SELECT
		tt_pemutih_alkes.no_tt,
		tt_pemutih_alkes.urut_no_tt,
  		pendaftar_pemutih.nama_pendaftar_pemutih,
		inbox_pemutih_produksi_subdit.id_inbox_pemutih_produksi_subdit,
		inbox_pemutih_produksi_seksi.keterangan,
		inbox_pemutih_produksi_seksi.read
		FROM
		inbox_pemutih_produksi_seksi
		RIGHT OUTER JOIN inbox_pemutih_produksi_subdit ON(inbox_pemutih_produksi_subdit.id_inbox_pemutih_produksi_subdit = inbox_pemutih_produksi_seksi.id_inbox_pemutih_produksi_subdit)
		RIGHT OUTER JOIN tt_pemutih_alkes ON(tt_pemutih_alkes.no_tt = inbox_pemutih_produksi_subdit.no_tt)
  		LEFT OUTER JOIN pendaftar_pemutih ON(pendaftar_pemutih.kode_pendaftar_pemutih = tt_pemutih_alkes.kode_pendaftar_pemutih)
		LEFT OUTER JOIN cek_pemutih_alkes ON(cek_pemutih_alkes.no_tt = tt_pemutih_alkes.no_tt)
		LEFT OUTER JOIN surat_keputusan_pemutih_penyalur ON(surat_keputusan_pemutih_penyalur.id_cek_pemutih = cek_pemutih_alkes.id_cek_pemutih)
  		WHERE
		tt_pemutih_alkes.no_tt = '".$no_tt."'
		";

		$rsP = $adodb->Execute($sqlP);

		$urut_no_tt = $rsP->fields['urut_no_tt'];
		$id_inbox_pemutih_produksi_subdit = $rsP->fields['id_inbox_pemutih_produksi_subdit'];
		$nama_pendaftar_pemutih = $rsP->fields['nama_pendaftar_pemutih'];
		$name = $rsP->fields['name'];
		$keterangan = $rsP->fields['keterangan'];
		$read = $rsP->fields['read'];

		$optional_arr['no_tt'] ='user_defined';
		$value_arr['no_tt'] = $urut_no_tt.'<input type="hidden" name="id_inbox_pemutih_produksi_subdit" value="'.$id_inbox_pemutih_produksi_subdit.'">';
		$optional_arr['nama_pendaftar_pemutih'] ='user_defined';
		$value_arr['nama_pendaftar_pemutih'] = $nama_pendaftar_pemutih;
		$optional_arr['keterangan'] ='user_defined';
		$value_arr['keterangan'] = '<input type="text" name="keterangan" value="'.$keterangan.'" class="text">';

		$optional_arr['read'] ='user_defined';
		if($read == '1'){$select = "checked";}else{$select = "";}
		$value_arr['read']='<input type="checkbox" name="read" '.$select.' class="text">';
		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$id_inbox_pemutih_produksi_subdit}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Inbox Pemutihan Izin Penyalur Seksi";
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

	// create update inbox_pemutih_produksi_seksi form
	function update_inbox_pemutih_produksi_seksi_form() {
		return $this->add_inbox_pemutih_produksi_seksi_form();
	}

	// handle event add inbox_pemutih_produksi_seksi
	function add_inbox_pemutih_produksi_seksi() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;

		$record['keterangan'] = $_POST['keterangan'];
		$record['id_inbox_pemutih_produksi_subdit'] = $_POST['id_inbox_pemutih_produksi_subdit'];
		$read = $_POST['read'];
		if($read == 'on'){ $xread= '1';}else{ $xread='0';}
		$record['read'] = $xread;
		$record['insert_by'] = $ses->loginid;
		$record['date_insert'] = time();


		$rs = $adodb->Execute("SELECT * FROM inbox_pemutih_produksi_seksi WHERE id_inbox_pemutih_produksi_subdit = '{$_POST['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$rs = $adodb->Execute("SELECT * FROM inbox_pemutih_produksi_seksi WHERE id_inbox_pemutih_produksi_seksi = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st '<b>{$record['id_inbox_pemutih_produksi_seksi']}</b>'";
		$this->log($status);
		
		$_block = new block();
		$_block->set_config('title', 'Inbox Pemutihan Izin Penyalur Seksi Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}
	
	// handle event update inbox_pemutih_produksi_seksi
	function update_inbox_pemutih_produksi_seksi() {
		return $this->add_inbox_pemutih_produksi_seksi();
	}

	// handle delete inbox_pemutih_produksi_seksi
	function delete_inbox_pemutih_produksi_seksi() {
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
                        $success = $adodb->Execute("delete from inbox_pemutih_produksi_seksi where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'inbox_pemutih_produksi_seksi <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'inbox_pemutih_produksi_seksi <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Inbox Pemutihan Izin Penyalur Seksi Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list inbox_pemutih_produksi_seksi
	function list_inbox_pemutih_produksi_seksi($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']},$ses;
		$userlog = $ses->loginid;
		$sql = "
		SELECT
		tt_pemutih_alkes.no_tt,
		tt_pemutih_alkes.urut_no_tt,
  		pendaftar_pemutih.nama_pendaftar_pemutih,
		inbox_pemutih_produksi_seksi.keterangan,
		inbox_pemutih_produksi_seksi.read
		FROM
		inbox_pemutih_produksi_seksi
		RIGHT OUTER JOIN inbox_pemutih_produksi_subdit ON(inbox_pemutih_produksi_subdit.id_inbox_pemutih_produksi_subdit = inbox_pemutih_produksi_seksi.id_inbox_pemutih_produksi_subdit)
		RIGHT OUTER JOIN tt_pemutih_alkes ON(tt_pemutih_alkes.no_tt = inbox_pemutih_produksi_subdit.no_tt)
  		LEFT OUTER JOIN pendaftar_pemutih ON(pendaftar_pemutih.kode_pendaftar_pemutih = tt_pemutih_alkes.kode_pendaftar_pemutih)
		LEFT OUTER JOIN cek_pemutih_alkes ON(cek_pemutih_alkes.no_tt = tt_pemutih_alkes.no_tt)
		LEFT JOIN surat_keputusan_pemutih_penyalur ON(surat_keputusan_pemutih_penyalur.id_cek_pemutih = cek_pemutih_alkes.id_cek_pemutih)
		WHERE
		(inbox_pemutih_produksi_subdit.userid='$userlog') AND surat_keputusan_pemutih_penyalur.no_surat_keputusan_pemutih_penyalur IS NULL
		";

		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;
		$optional_arr['no_tt'] = TRUE;

		$vsel_arr = array (
			'id_inbox_pemutih_produksi_seksi' => TRUE,
			'nama_inbox_pemutih_produksi_seksi' => TRUE,
			'no_tt' => FALSE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();


		$eval_arr['urut_no_tt'] = '
		$cUR = "%s";
		global $adodb;
		$sqlN = "SELECT no_tt FROM tt_pemutih_alkes WHERE urut_no_tt=\'$cUR\'";
		$rsN = $adodb->Execute($sqlN);
		$no_tt = $rsN->fields[no_tt];

  		$sqlM = "SELECT id_inbox_pemutih_produksi_subdit FROM inbox_pemutih_produksi_subdit WHERE no_tt=\'$no_tt\'";
   		$rsM = $adodb->Execute($sqlM);
		$id_inbox = $rsM->fields[id_inbox_pemutih_produksi_subdit];
		$sqlUR = "SELECT read FROM inbox_pemutih_produksi_seksi WHERE id_inbox_pemutih_produksi_subdit =\'$id_inbox\'";
		$rsUR = $adodb->Execute($sqlUR);
		$read = $rsUR->fields[read];
		$read = $rsUR->fields[read];
		if($read == "1" ){
			$str .="<div align=center>&nbsp;$cUR</div>";
		}else{
			$str .="<div align=center><font color=red>&nbsp;$cUR</font></div>";
		}
		';
		
		$eval_arr['read'] = '
		$cR = "%s";
		if($cR =="1"){
			$str .="Read";
		}else{
		
			$str .= "Unread";
		}
		';
		$pk = array (
			'no_tt' => TRUE,
		);
//		if ($this->get_permission('fill_this')) {
			/*$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 600, 400, null, null, \'add_inbox_pemutih_produksi_seksi\');'.
			'win.focus()',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
			*/
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_inbox_pemutih_produksi_seksi\');'.
			'win.focus()', 
			"label"=>__('Read'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			/*$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' . 
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_inbox_pemutih_produksi_seksi\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));*/
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_inbox_pemutih_produksi_seksi\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->inbox_pemutih_produksi_seksi_label;
		$config = array (
			'id_inbox_pemutih_produksi_seksi'		=> 'id_inbox_pemutih_produksi_seksi',
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
			'form_title'	=> __('List').' Inbox Pemutihan Izin Penyalur Seksi'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print inbox_pemutih_produksi_seksi
	function print_inbox_pemutih_produksi_seksi() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_inbox_pemutih_produksi_seksi($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$inbox_pemutih_produksi_seksi_controller = new inbox_pemutih_produksi_seksi_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $inbox_pemutih_produksi_seksi_controller->add_inbox_pemutih_produksi_seksi_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $inbox_pemutih_produksi_seksi_controller->add_inbox_pemutih_produksi_seksi();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $inbox_pemutih_produksi_seksi_controller->update_inbox_pemutih_produksi_seksi_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $inbox_pemutih_produksi_seksi_controller->update_inbox_pemutih_produksi_seksi();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $inbox_pemutih_produksi_seksi_controller->delete_inbox_pemutih_produksi_seksi();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $inbox_pemutih_produksi_seksi_controller->import_inbox_pemutih_produksi_seksi_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $inbox_pemutih_produksi_seksi_controller->import_inbox_pemutih_produksi_seksi();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $inbox_pemutih_produksi_seksi_controller->print_inbox_pemutih_produksi_seksi();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $inbox_pemutih_produksi_seksi_controller->list_inbox_pemutih_produksi_seksi();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Inbox Pemutihan Izin Penyalur Seksi Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

<?php

	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('inbox_ubah_izin_produksi_subdit_controller')) {
	// do nothing
} else if (defined('CLASS_inbox_ubah_izin_produksi_subdit_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_inbox_ubah_izin_produksi_subdit_CONTROLLER', TRUE);

include_once 'class.inbox_ubah_izin_produksi_subdit.inc.php';
class inbox_ubah_izin_produksi_subdit_controller extends depkes2_manager {
	var $inbox_ubah_izin_produksi_subdit_label;
	var $optional_arr;
	function inbox_ubah_izin_produksi_subdit_controller() {
		$this->inbox_ubah_izin_produksi_subdit_label = array (
			'id_inbox_ubah_izin_produksi_subdit' => 'id_inbox_ubah_izin_produksi_subdit',
			'urut_no_tt' => 'No Ubah Tanda Terima',
			'no_tt' => 'No Ubah Tanda Terima',
			'jenis_izin_produksi' => 'Jenis Izin Produksi',
			'userid' => 'Seksi',
			'name' => 'Seksi',
			'keterangan' => 'Keterangan',
			'nama_pendaftar' => 'Nama Pemohon',
			'read' => 'Read',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_inbox_ubah_izin_produksi_subdit' => TRUE,
			'nama_inbox_ubah_izin_produksi_subdit' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	// create add inbox_ubah_izin_produksi_subdit form
	function add_inbox_ubah_izin_produksi_subdit_form() {
		include_once 'class.xform.inc.php';

//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$userlog = $ses->loginid;
		$label_arr = $this->inbox_ubah_izin_produksi_subdit_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('id_inbox_ubah_izin_produksi_subdit','C','32');
		$field_arr[] = xform::xf('no_tt','C','32');
		$field_arr[] = xform::xf('nama_pendaftar','C','32');
		$field_arr[] = xform::xf('userid','C','32');
		$field_arr[] = xform::xf('keterangan','C','32');
		$field_arr[] = xform::xf('read','C','32');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');


		$rs = $adodb->Execute("SELECT * FROM inbox_ubah_izin_produksi_subdit WHERE id_inbox_ubah_izin_produksi_subdit='{$record['id_inbox_ubah_izin_produksi_subdit']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_inbox_ubah_izin_produksi_subdit'] = 'protect';
			$mode = 'edit';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}

		$optional_arr['nama_inbox_ubah_izin_produksi_subdit_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';

		eval($this->save_config);

		$no_tt = $_GET['no_tt'];
		$sqlP = "
		SELECT
		tt_2_alkes.no_tt,
		tt_2_alkes.urut_no_tt,
  		pendaftar.nama_pendaftar,
		kaseksi.name,
		inbox_ubah_izin_produksi_subdit.keterangan,
		inbox_ubah_izin_produksi_subdit.read
		FROM
		inbox_ubah_izin_produksi_subdit
		RIGHT OUTER JOIN kaseksi ON(kaseksi.userid = inbox_ubah_izin_produksi_subdit.userid)
		RIGHT OUTER JOIN tt_2_alkes ON(tt_2_alkes.no_tt = inbox_ubah_izin_produksi_subdit.no_tt)
		LEFT OUTER JOIN pemohon_ubah_ijin_produksi ON( pemohon_ubah_ijin_produksi.kode_pemohon_ubah_ijin_produksi = tt_2_alkes.kode_pendaftar)
		LEFT OUTER JOIN surat_keputusan ON(surat_keputusan.no_surat_keputusan = pemohon_ubah_ijin_produksi.no_surat_keputusan )
		LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
		LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
		LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
  		WHERE
		tt_2_alkes.no_tt = '".$no_tt."'
		";

		$rsP = $adodb->Execute($sqlP);

		$urut_no_tt = $rsP->fields['urut_no_tt'];
		$nama_pendaftar = $rsP->fields['nama_pendaftar'];
		$name = $rsP->fields['name'];
		$keterangan = $rsP->fields['keterangan'];
		$read = $rsP->fields['read'];

		$optional_arr['no_tt'] ='user_defined';
		$value_arr['no_tt'] = $urut_no_tt.'<input type="hidden" name="no_tt" value="'.$no_tt.'">';
		$optional_arr['nama_pendaftar'] ='user_defined';
		$value_arr['nama_pendaftar'] = $nama_pendaftar;

		$sqlk = "SELECT id_subdit FROM kasubdit WHERE userid = '$userlog'";
		//print $sqlk;
		$rsk = $adodb->Execute($sqlk);
		$idsubdit = $rsk->fields[id_subdit];
		if($idsubdit){$idsubdit = $idsubdit;}else{$idsubdit='10000';}

		$has ='';
		$rsx = $adodb->Execute("SELECT userid,name FROM kaseksi WHERE id_subdit='$idsubdit' ORDER BY name");
		while(! $rsx->EOF){
			$useridS = $rsx->fields['userid'];
			$nameS = $rsx->fields['name'];
				if($name == $nameS){$check1 = "checked";}else{$check1="";}
			$has .= '<input type="radio" name="userid" value="'.$useridS.'" '.$check1.'>'.$nameS.'';
		$rsx->MoveNext();
                }
		$optional_arr['userid'] ='user_defined';
		$value_arr['userid'] = $has;
		$optional_arr['keterangan'] ='user_defined';
		$value_arr['keterangan'] = '<input type="text" name="keterangan" value="'.$keterangan.'" class="text">';

		$optional_arr['read'] ='user_defined';
		if($read == '1'){$select = "checked";}else{$select = "";}
		$value_arr['read']='<input type="checkbox" name="read" '.$select.' class="text">';
		$rsD = $adodb->Execute("SELECT id_inbox_ubah_izin_produksi_subdit FROM inbox_ubah_izin_produksi_subdit WHERE no_tt='".$_GET[no_tt]."'");
		$id_inbox = $rsD->fields['id_inbox_ubah_izin_produksi_subdit'];
		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$id_inbox}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Inbox Perubahan Izin Produksi Subdit";
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

	// create update inbox_ubah_izin_produksi_subdit form
	function update_inbox_ubah_izin_produksi_subdit_form() {
		return $this->add_inbox_ubah_izin_produksi_subdit_form();
	}

	// handle event add inbox_ubah_izin_produksi_subdit
	function add_inbox_ubah_izin_produksi_subdit() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;

		$record['no_tt'] = $_POST['no_tt'];
		$record['userid'] = $_POST['userid'];
		$record['keterangan'] = $_POST['keterangan'];
		
		$read = $_POST['read'];
		if($read == 'on'){ $xread= '1';}else{ $xread='0';}
		$record['read'] = $xread;
		$record['insert_by'] = $ses->loginid;
		$record['date_insert'] = time();


		$rs = $adodb->Execute("SELECT * FROM inbox_ubah_izin_produksi_subdit WHERE id_inbox_ubah_izin_produksi_subdit = '{$_POST['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$rs = $adodb->Execute("SELECT * FROM inbox_ubah_izin_produksi_subdit WHERE id_inbox_ubah_izin_produksi_subdit = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st '<b>{$record['id_inbox_ubah_izin_produksi_subdit']}</b>'";
		$this->log($status);
		
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}
	
	// handle event update inbox_ubah_izin_produksi_subdit
	function update_inbox_ubah_izin_produksi_subdit() {
		return $this->add_inbox_ubah_izin_produksi_subdit();
	}

	// handle delete inbox_ubah_izin_produksi_subdit
	function delete_inbox_ubah_izin_produksi_subdit() {
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
                        $success = $adodb->Execute("delete from inbox_ubah_izin_produksi_subdit where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'inbox_ubah_izin_produksi_subdit <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'inbox_ubah_izin_produksi_subdit <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Inbox Perubahan Izin Produksi Subdit Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list inbox_ubah_izin_produksi_subdit
	function list_inbox_ubah_izin_produksi_subdit($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']},$ses;
		$userlog = $ses->loginid;
		$sqlk = "SELECT id_subdit FROM kasubdit WHERE userid = '$userlog'";
		$rsk = $adodb->Execute($sqlk);
		$idsubdit = $rsk->fields[id_subdit];
		if($idsubdit){$idsubdit = $idsubdit;}else{$idsubdit='10000';}

		$sql = "
		SELECT
		tt_2_alkes.no_tt,
		tt_2_alkes.urut_no_tt,
		CASE WHEN tt_2_alkes.jenis_izin_produksi='0' THEN 'Izin Produksi Alkes'
		ELSE
		'Izin Produksi PKRT' END as jenis_izin_produksi,
  		pendaftar.nama_pendaftar,
		kaseksi.name,
		inbox_ubah_izin_produksi_subdit.keterangan,
		inbox_ubah_izin_produksi_subdit.read
		FROM
		inbox_ubah_izin_produksi_subdit
		RIGHT OUTER JOIN kaseksi ON(kaseksi.userid = inbox_ubah_izin_produksi_subdit.userid)
		RIGHT OUTER JOIN tt_2_alkes ON(tt_2_alkes.no_tt = inbox_ubah_izin_produksi_subdit.no_tt)
		LEFT OUTER JOIN pemohon_ubah_ijin_produksi ON( pemohon_ubah_ijin_produksi.kode_pemohon_ubah_ijin_produksi = tt_2_alkes.kode_pendaftar)
		LEFT OUTER JOIN surat_keputusan ON(surat_keputusan.no_surat_keputusan = pemohon_ubah_ijin_produksi.no_surat_keputusan )
		LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
		LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
		LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
		LEFT OUTER JOIN kasubdit ON(kasubdit.id_subdit = tt_2_alkes.kode_subdit)
		LEFT OUTER JOIN cek_2_alkes ON(cek_2_alkes.no_tt = tt_2_alkes.no_tt)
		LEFT OUTER JOIN surat_ubah_keputusan ON(surat_ubah_keputusan.id_cek_2 = cek_2_alkes.id_cek_2)
		WHERE
		(kasubdit.id_subdit = '$idsubdit') AND surat_ubah_keputusan.id_cek_2 IS NULL
		GROUP BY
		tt_2_alkes.no_tt,
		tt_2_alkes.urut_no_tt,
  		pendaftar.nama_pendaftar,
		tt_1_alkes.jenis_izin_produksi,
		tt_2_alkes.jenis_izin_produksi,
		kaseksi.name,
		inbox_ubah_izin_produksi_subdit.keterangan,
		inbox_ubah_izin_produksi_subdit.read
		";
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;
		$optional_arr['no_tt'] = TRUE;

		$vsel_arr = array (
			'id_inbox_ubah_izin_produksi_subdit' => TRUE,
			'nama_inbox_ubah_izin_produksi_subdit' => TRUE,
			'no_tt' => FALSE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();


		$eval_arr['urut_no_tt'] = '
		$cUR = "%s";
		global $adodb;
		$sqlN = "SELECT no_tt FROM tt_2_alkes WHERE urut_no_tt=\'$cUR\'";
		$rsN = $adodb->Execute($sqlN);
		$no_tt = $rsN->fields[no_tt];
		$sqlUR = "SELECT read FROM inbox_ubah_izin_produksi_subdit WHERE no_tt =\'$no_tt\'";
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
			'\', 600, 400, null, null, \'add_inbox_ubah_izin_produksi_subdit\');'.
			'win.focus()',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
			*/
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_inbox_ubah_izin_produksi_subdit\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_inbox_ubah_izin_produksi_subdit\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));*/
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_inbox_ubah_izin_produksi_subdit\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->inbox_ubah_izin_produksi_subdit_label;
		$config = array (
			'id_inbox_ubah_izin_produksi_subdit'		=> 'id_inbox_ubah_izin_produksi_subdit',
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
			'form_title'	=> __('List').' Inbox Perubahan Izin Produksi Subdit'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print inbox_ubah_izin_produksi_subdit
	function print_inbox_ubah_izin_produksi_subdit() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_inbox_ubah_izin_produksi_subdit($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$inbox_ubah_izin_produksi_subdit_controller = new inbox_ubah_izin_produksi_subdit_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $inbox_ubah_izin_produksi_subdit_controller->add_inbox_ubah_izin_produksi_subdit_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $inbox_ubah_izin_produksi_subdit_controller->add_inbox_ubah_izin_produksi_subdit();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $inbox_ubah_izin_produksi_subdit_controller->update_inbox_ubah_izin_produksi_subdit_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $inbox_ubah_izin_produksi_subdit_controller->update_inbox_ubah_izin_produksi_subdit();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $inbox_ubah_izin_produksi_subdit_controller->delete_inbox_ubah_izin_produksi_subdit();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $inbox_ubah_izin_produksi_subdit_controller->import_inbox_ubah_izin_produksi_subdit_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $inbox_ubah_izin_produksi_subdit_controller->import_inbox_ubah_izin_produksi_subdit();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $inbox_ubah_izin_produksi_subdit_controller->print_inbox_ubah_izin_produksi_subdit();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $inbox_ubah_izin_produksi_subdit_controller->list_inbox_ubah_izin_produksi_subdit();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Inbox Perubahan Izin Produksi Subdit Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

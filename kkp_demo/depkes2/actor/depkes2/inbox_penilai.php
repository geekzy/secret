<?php


// my_table
// my_tt
// my_inseksi


	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('inbox_controller')) {
	// do nothing
} else if (defined('CLASS_inbox_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_inbox_CONTROLLER', TRUE);

#include_once 'class.inbox.inc.php';
class inbox_controller extends depkes2_manager {
	var $inbox_label;
	var $optional_arr;
	function inbox_controller() {
		$this->inbox_label = array (
			'id_inbox' => 'id_inbox',
			'urut_no_tt' => 'No Pemohon',
			'no_tt' => 'No Pemohon',
			'userid' => 'Penilai',
			'name' => 'Penilai',
			'keterangan' => 'Keterangan',
			'jenis_izin_produksi' => 'Jenis Izin Produksi',
			'nama_pendaftar' => 'Nama Pemohon',
			'baca' => 'Status',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_inbox' => TRUE,
			'nama_inbox' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	// create add inbox form
	function add_inbox_form() {
		include_once 'class.xform.inc.php';

//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->inbox_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('id_inbox','C','32');
		$field_arr[] = xform::xf('no_tt','C','32');
		$field_arr[] = xform::xf('nama_pendaftar','C','32');
		$field_arr[] = xform::xf('keterangan','C','32');
		$field_arr[] = xform::xf('baca','C','32');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');

		$rsx = $adodb->Execute("SELECT id_inbox, keterangan_koordinator AS keterangan FROM ".$GLOBALS[my_inseksi]." inbox_seksi WHERE id_inbox='".$record[no_tt]."'");
		$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_table]." inbox WHERE id_inbox_seksi='".$rsx->fields[id_inbox]."'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_inbox'] = 'protect';
			$mode = 'edit';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}
		$value_arr['keterangan'] = $rsx->fields['keterangan'];
		$keterangan_kaseksi = $rsx->fields['keterangan'];
		$optional_ar['keterangan'] = 'protect';

		$optional_arr['nama_inbox_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';

		eval($this->save_config);
		$no_tt = $_GET['no_tt'];
		
		/*
		 * BEGIN OF MODIFICATION BY : 566
		 */
		$sqlP = "
		SELECT
		tt.no_tt,
		tt.urut_no_tt,
  		pendaftar.nama_pendaftar,
		inbox_seksi.id_inbox AS id_inbox_seksi,
		inbox.id_inbox AS id_inbox_penilai,
		inbox.keterangan,
		inbox.baca 
		FROM
		".$GLOBALS[my_table]." inbox
		RIGHT JOIN ".$GLOBALS[my_inseksi]." inbox_seksi ON (inbox.id_inbox_seksi = inbox_seksi.id_inbox)
		RIGHT JOIN ".$GLOBALS[my_insubdit]." inbox_subdit ON (inbox_subdit.id_inbox = inbox_seksi.id_inbox_subdit)
		RIGHT JOIN ".$GLOBALS[my_tt]." tt ON (inbox_subdit.no_tt = tt.no_tt)
  		LEFT JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON (tt.kode_pendaftar = pendaftar.kode_pendaftar)
		LEFT JOIN ".$GLOBALS[my_cek]." cek ON (tt.no_tt = cek.no_tt)
		LEFT JOIN ".$GLOBALS[my_sk]." sk ON (cek.id_cek_1 = sk.id_cek_1)
  		WHERE
		tt.no_tt = '".$no_tt."'
		";
		/*
		 * END OF MODIFICATION BY : 566
		 */
		
		$rsP = $adodb->Execute($sqlP);
		$urut_no_tt = $rsP->fields['urut_no_tt'];
		$id_inbox_seksi = $rsP->fields['id_inbox_seksi'];
		$id_inbox_penilai = $rsP->fields['id_inbox_penilai'];
		$nama_pendaftar = $rsP->fields['nama_pendaftar'];
		$name = $rsP->fields['name'];
		$keterangan = $rsP->fields['keterangan'];
		$read = $rsP->fields['baca'];
		
		$optional_arr['no_tt'] ='user_defined';
		$value_arr['no_tt'] = $urut_no_tt.'<input type="hidden" name="no_tt" value="'.$no_tt.'">'.
		'<input type="hidden" name="id_inbox_seksi" value="'.$id_inbox_seksi.'">';
		$optional_arr['nama_pendaftar'] ='user_defined';
		$value_arr['nama_pendaftar'] = $nama_pendaftar;
		$optional_arr['keterangan'] ='user_defined';
		
		/*
		 * BEGIN OF MODIFICATION BY : 566
		 */
		$value_arr['keterangan'] = '<input type="text" name="keterangan" value="'.$keterangan_kaseksi.'" class="text">';
		$value_arr['id_inbox']   = $id_inbox_penilai;
		/*
		 * END OF MODIFICATION BY : 566
		 */
		
		$optional_arr['baca'] ='user_defined';
		if($read == '1'){$select = "checked";}else{$select = "";}
		$value_arr['baca']='<input type="checkbox" name="baca" '.$select.' class="text">';

		$Xs  = "SELECT userid,name FROM penilai ORDER BY name ASC";
		$Xrs = $adodb->GetAll($Xs);

		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='".$value_arr[id_inbox]."'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Inbox Penilai ".$GLOBALS[my_title];
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

	// create update inbox form
	function update_inbox_form() {
		return $this->add_inbox_form();
	}

	// handle event add inbox
	function add_inbox() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;

                $record['no_tt'] = $_POST['no_tt'];
		$record['keterangan'] = $_POST['keterangan'];
		$record['id_inbox_seksi'] = $_POST['id_inbox_seksi'];
		$read = $_POST['baca'];
		if($read == 'on'){ $xread= '1';}else{ $xread='0';}
		$record['baca'] = $xread;
		$record['insert_by'] = $ses->loginid;
		$record['date_insert'] = time();

		$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_table]." WHERE id_inbox = '{$_POST['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_table]." WHERE id_inbox = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}

		/*
		 * ADDED BY : 566
		 *
		 * Update keterangan kaseksi
		 */
		$ferdi = "SELECT * FROM ".$GLOBALS[my_inseksi]." WHERE id_inbox ='{$_POST['id_inbox_seksi']}'";
		print $ferdi;
		$r566 = $adodb->Execute($ferdi);
		$c566['keterangan_koordinator'] = $_POST['keterangan'];
		if ($r566 && ! $r566->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($r566, $c566, 1));
		}

                ($xread == 1) ? $sread = "Sudah Dibaca" : $sread = "Belum Dibaca";

                $rs = $adodb->Execute("SELECT urut_no_tt FROM ".$GLOBALS[my_tt]." WHERE no_tt='".$record[no_tt]."'");
                $status = "Successfull $sread Inbox Penilai '<b>".$rs->fields[urut_no_tt]."</b>'";
		$this->log($status);
		
		$_block = new block();
		$_block->set_config('title', 'Inbox Penilai '.$GLOBALS[my_title].' Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}
	
	// handle event update inbox
	function update_inbox() {
		return $this->add_inbox();
	}

	// handle list inbox
	function list_inbox($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']},$ses;
		$userlog = $ses->loginid;
		
		$sql = "
		SELECT
			tt.no_tt,
			tt.urut_no_tt,
			[produksi]
  			pendaftar.nama_pendaftar,
			inbox_seksi.keterangan_koordinator AS keterangan,
			CASE WHEN inbox_penilai.baca='1' THEN 'Sudah Dibaca' ELSE 'Belum Dibaca' END as Status
		FROM
			".$GLOBALS[my_tt]."                  tt 
			LEFT JOIN ".$GLOBALS[my_insubdit]."   inbox_subdit ON (tt.no_tt = inbox_subdit.no_tt)
			LEFT JOIN ".$GLOBALS[my_inseksi]."     inbox_seksi ON (inbox_seksi.id_inbox_subdit = inbox_subdit.id_inbox)
			LEFT JOIN ".$GLOBALS[my_table]."     inbox_penilai ON (inbox_penilai.id_inbox_seksi = inbox_seksi.id_inbox)
			LEFT JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON (tt.kode_pendaftar = pendaftar.kode_pendaftar)
			LEFT JOIN ".$GLOBALS[my_cek]."       cek ON (tt.no_tt = cek.no_tt)
			LEFT JOIN ".$GLOBALS[my_sk]."        sk ON (cek.id_cek_1 = sk.id_cek_1)
		[where]
		ORDER BY tt.no_tt DESC
		";

		if (0) { //eregi('produksi', $GLOBALS[my_title])) {
			$sql = str_replace('[produksi]', "CASE WHEN tt.jenis_izin_produksi='0' THEN 'Izin Produksi Alkes'".
			" ELSE 'Izin Produksi PKRT' END as jenis_izin_produksi, ", $sql);
		} else {
			$sql = str_replace('[produksi]', "", $sql);
		}

                if (0) { // $ses->action == 'admin') {
                        $sql = str_replace("[where]", "", $sql);
                } else {
                        $sql = str_replace("[where]", "WHERE inbox_seksi.koordinator='$userlog' AND sk.no_sk IS NULL", $sql);
                }

		/*
		 * ADDED BY : 566
		 */
		$rs566 = $adodb->Execute($sql);
		$read566 = $rs566->fields[Status];
		//print $read566;
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;
		$optional_arr['no_tt'] = TRUE;

		$vsel_arr = array (
			'id_inbox' => TRUE,
			'nama_inbox' => TRUE,
			'no_tt' => FALSE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$eval_arr['urut_no_tt'] = '
		$cUR = "%s";
		global $adodb;
		$sqlN = "SELECT no_tt FROM '.$GLOBALS[my_tt].' tt WHERE urut_no_tt=\'$cUR\'";
		$rsN = $adodb->Execute($sqlN);
		$no_tt = $rsN->fields[no_tt];
		
		$sqlX = "SELECT id_inbox FROM '.$GLOBALS[my_insubdit].' inbox_subdit WHERE no_tt=\'$no_tt\'";
  		$rsX  = $adodb->Execute($sqlX);
		$in_subdit = $rsX->fields[id_inbox];
		
		$sqlM = "SELECT id_inbox FROM '.$GLOBALS[my_inseksi].' inbox_seksi WHERE id_inbox_subdit=\'$in_subdit\'";
		$rsM = $adodb->Execute($sqlM);
		$id_inbox = $rsM->fields[id_inbox];
		$sqlUR = "SELECT baca FROM '.$GLOBALS[my_table].' inbox WHERE id_inbox_seksi =\'$id_inbox\'";
		//$str .= $sqlUR;
		$rsUR = $adodb->Execute($sqlUR);
		$read = $rsUR->fields[baca];
		//$read = $read566;
		if($read=="1"){
			$str .="<div align=center>$cUR</div>";
		}else{
			$str .="<div align=center><font color=red>&nbsp;$cUR</font></div>";
		}
		';
		
		$eval_arr['xxread'] = '
		$cR = "%s";
		if($cR =="1"){
			$str .="Sudah Dibaca";
		}else{
			$str .= "Belum Dibaca";
		}
		';
		$pk = array (
			'no_tt' => TRUE,
		);
//		if ($this->get_permission('fill_this')) {
			/*$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 600, 400, null, null, \'add_inbox\');'.
			'win.focus()',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
			*/
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_inbox\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_inbox\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));*/
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_inbox\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->inbox_label;
		$config = array (
			'id'		=> 'inbox',
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
			'form_title'	=> __('List').' Inbox Penilai '.$GLOBALS[my_title].' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print inbox
	function print_inbox() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_inbox($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$inbox_controller = new inbox_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $inbox_controller->add_inbox_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $inbox_controller->add_inbox();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $inbox_controller->update_inbox_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content  = $inbox_controller->update_inbox();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $inbox_controller->delete_inbox();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $inbox_controller->import_inbox_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $inbox_controller->import_inbox();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $inbox_controller->print_inbox();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $inbox_controller->list_inbox();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Inbox Penilai '.$GLOBALS[my_title].' Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

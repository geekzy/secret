<?php

	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('tt_1_penyalur_controller')) {
	// do nothing
} else if (defined('CLASS_tt_1_penyalur_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_tt_1_penyalur_CONTROLLER', TRUE);

include_once 'class.tt_1_penyalur.inc.php';
class tt_1_penyalur_controller extends depkes2_manager {
	var $tt_1_penyalur_label;
	var $optional_arr;
	function tt_1_penyalur_controller() {
		$this->tt_1_penyalur_label = array (
			'urut_no_tt' => 'No Tanda Terima',
			'subdit' => 'Subdit',
			'kode_subdit' => 'Kode Subdit',
			'nama_pabrik' => 'Nama Pabrik',
 			'kode_pendaftar_penyalur' => 'Nama pabrik / Nama Pemohon',
			'alamat_pabrik' => 'Alamat pabrik',
			'nama_propinsi_2' => 'Nama propinsi',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'no_tt' => FALSE,
			'kode_subdit' => FALSE,
 			'kode_pendaftar_penyalur' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	function subdit_form(&$config) {

                eval($this->load_config);
                $selected = $value_arr['kode_subdit'];

		include_once 'class.subdit.inc.php';
		$fk_sql = ''.
			'SELECT
				id_subdit as skey,
				subdit as svalue,
				keterangan as svalue2
			FROM
				subdit
			ORDER BY
				id_subdit
			';
		$result = subdit::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('kode_subdit');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->tt_1_penyalur_label['kode_subdit']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['kode_subdit'] = 'user_defined';
		$value_arr['kode_subdit'] = $this->select_form('kode_subdit', $result, $selected);
		$optional_arr['kode_subdit_rule'] = "\n".
		"       if(theform.kode_subdit.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['kode_subdit']." ".__('empty').".');\n".
		"               theform.id_subdit.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";


	}

function pendaftar_penyalur_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['kode_pendaftar_penyalur'];

		include_once 'class.pendaftar_penyalur.inc.php';
		$fk_sql = ''.
			'SELECT
				kode_pendaftar_penyalur as skey,
				nama_pabrik as svalue,
				nama_pendaftar_penyalur as svalue2
			FROM
				pendaftar_penyalur
			ORDER BY
				kode_pendaftar_penyalur
			';
		$result = pendaftar_penyalur::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('kode_pendaftar_penyalur');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->tt_1_penyalur_label['kode_pendaftar_penyalur']
			)
		);

		

  $jas ="
		b = document.theform.kode_pendaftar_penyalur.value;
		sql = 'SELECT alamat_pabrik,nama_propinsi_2 FROM pendaftar_penyalur  WHERE kode_pendaftar_penyalur=\''+ b +'\'';

		jumpto1('frame_tt_1_penyalur.php?sql='+sql+'&a='+b)

		";

	$GLOBALS['out_before_footer'] = '
 	<iframe marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=auto name=\'iframe_entry1\' id=\'iframe_entry1\' style="width:0;height:0" src="frame_tt_1_penyalur.php"></iframe>
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
		$value_arr['alamat'] = '<input type=text name=alamat class=text size=50 readonly>';

		$field_arr[] = array ('name' => 'propinsi', 'type' => 'C', 'max_length'=>'0');
		$optional_arr['propinsi']= 'user_defined';
		$label_arr['propinsi'] = 'Propinsi';
		$value_arr['propinsi'] = '<input type=text name=propinsi class=text size=30 readonly>';

		

		$result = array_merge($default_value, $result);
		$optional_arr['kode_pendaftar_penyalur'] = 'user_defined';
		$value_arr['kode_pendaftar_penyalur'] = $this->select_form('kode_pendaftar_penyalur', $result, $selected,$multiple=FALSE,$jas);
		$optional_arr['kode_pendaftar_penyalur_rule'] = "\n".
		"       if(theform.kode_pendaftar_penyalur.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['kode_pendaftar_penyalur']." ".__('empty').".');\n".
		"               theform.kode_pendaftar_penyalur.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";




	}


	// create add tt_1_penyalur form
	function add_tt_1_penyalur_form() {
		include_once 'class.xform.inc.php';
		//if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->tt_1_penyalur_label;
		$optional_arr = $this->optional_arr;

		if($_GET['no_tt']){$field_arr[] = xform::xf('urut_no_tt','C','255');}
		$field_arr[] = xform::xf('kode_subdit','C','255');
		$field_arr[] = xform::xf('kode_pendaftar_penyalur','C','255');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');

		$rs = $adodb->Execute("SELECT * FROM tt_1_penyalur WHERE no_tt='{$record['no_tt']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['no_tt'] = 'protect';
			$mode = 'edit';

		} else {
			$value_arr = array ();
			$mode = 'add';
		}

		$optional_arr['nama_tt_1_penyalur_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';
		
		global $adodb;
		$rsx = $adodb->Execute("SELECT no_tt FROM tt_1_penyalur ORDER BY no_tt DESC LIMIT 1");
		$no_ttx = $rsx->fields['no_tt'];
		$no_ttx = $no_ttx +1;
		eval($this->save_config);
		$optional_arr['urut_no_tt'] = 'user_defined';
		$value_arr['urut_no_tt'] = '<input type="text" name="urut_no_tt" value="'.$value_arr['urut_no_tt'].'" readonly class="text">';
		$this->subdit_form($config);
		$this->pendaftar_penyalur_form($config);



		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['no_tt']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Tanda Terima Izin Penyalur";
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

	// create update tt_1_penyalur form
	function update_tt_1_penyalur_form() {
		return $this->add_tt_1_penyalur_form();
	}

	// handle event add tt_1_penyalur
	function add_tt_1_penyalur() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);
		
		$rsx = $adodb->Execute("SELECT * FROM tt_1_penyalur ORDER by no_tt DESC LIMIT 1");
		$tahun_data = date('Y',$rsx->fields['date_insert']);
		$tahun_now = date('Y');
		

		if($rsx->fields['urut_no_tt'] == ''){
			$urut_no_tt = 1;
		}else{
			if($tahun_data == $tahun_now){
				$urut_no_tt = $rsx->fields['urut_no_tt'] + 1;
			}else{
				$urut_no_tt = 1;
			}
		}

		$sqly = "SELECT
			subdit
		FROM
			subdit
		WHERE
			id_subdit = '".$_POST['kode_subdit']."'
		";
		//print $sqly;
		$lastno = $rsx->fields['urut_no_tt'];
		$lastno = $lastno[2].$lastno[3].$lastno[4].$lastno[5].$lastno[6];
		$lastno = intval($lastno);
		$lastno = $lastno + $urut_no_tt;

		$rsy = $adodb->Execute($sqly);
		$subdit = $rsy->fields['subdit'];
		$a = date('d-m/Y');
		$no = str_pad($lastno, 5, "0", STR_PAD_LEFT);
		$urut_no_tt = $subdit."/".$no."/".$a;

  		$record['urut_no_tt'] = $urut_no_tt;


		$rs = $adodb->Execute("SELECT * FROM tt_1_penyalur WHERE no_tt = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$record['insert_by'] = $ses->loginid;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM tt_1_penyalur WHERE no_tt = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		//print_r($st);exit();
		$status = "Successfull $st '<b>{$record['no_tt']}</b>'";
		$this->log($status);
		
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}
	
	// handle event update tt_1_penyalur
	function update_tt_1_penyalur() {
		return $this->add_tt_1_penyalur();
	}

	// handle delete tt_1_penyalur
	function delete_tt_1_penyalur() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['get_vars']}, ${$GLOBALS['post_vars']},$adodb;

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
                        $success = $adodb->Execute("delete from tt_1_penyalur where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'tt_1_penyalur <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'tt_1_penyalur <font color=red>'.$query.'</font>';
                }
                $this->log($status);

                $_block = new block();
                $_block->set_config('title', ('Delete Tanda Terima Izin Penyalur Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list tt_1_penyalur
	function list_tt_1_penyalur($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'SELECT
		tt_1_penyalur.no_tt,
		tt_1_penyalur.urut_no_tt,
		subdit.subdit,
		tt_1_penyalur.date_insert,
		pendaftar_penyalur.nama_pabrik,
		pendaftar_penyalur.alamat_pabrik,
		pendaftar_penyalur.nama_propinsi_2,
		tt_1_penyalur.insert_by
		FROM tt_1_penyalur
		LEFT OUTER JOIN subdit ON(subdit.id_subdit = tt_1_penyalur.kode_subdit)
		LEFT OUTER JOIN pendaftar_penyalur ON(pendaftar_penyalur.kode_pendaftar_penyalur = tt_1_penyalur.kode_pendaftar_penyalur)
		GROUP BY
		tt_1_penyalur.no_tt,
		tt_1_penyalur.urut_no_tt,
		subdit.subdit,
		pendaftar_penyalur.nama_pabrik,
		tt_1_penyalur.kode_pendaftar_penyalur,
		pendaftar_penyalur.alamat_pabrik,
		pendaftar_penyalur.nama_propinsi_2,
		tt_1_penyalur.insert_by,
		tt_1_penyalur.date_insert

		';
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'no_tt' => FALSE,
			'nama_tt_1_penyalur' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => TRUE
		);
		$eval_arr = array ();
		$pk = array (
			'no_tt' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 600, 400, null, null, \'add_tt_1_penyalur\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_tt_1_penyalur\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_tt_1_penyalur\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_tt_1_penyalur\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->tt_1_penyalur_label;
		$config = array (
			'id'		=> 'tt_1_penyalur',
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
			'form_title'	=> __('List').' Tanda Terima Izin Penyalur'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print tt_1_penyalur
	function print_tt_1_penyalur() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_tt_1_penyalur($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$tt_1_penyalur_controller = new tt_1_penyalur_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $tt_1_penyalur_controller->add_tt_1_penyalur_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $tt_1_penyalur_controller->add_tt_1_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad();OnChangekode_pendaftar_penyalur()"';
			$out_content = $tt_1_penyalur_controller->update_tt_1_penyalur_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $tt_1_penyalur_controller->update_tt_1_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $tt_1_penyalur_controller->delete_tt_1_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $tt_1_penyalur_controller->import_tt_1_penyalur_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $tt_1_penyalur_controller->import_tt_1_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $tt_1_penyalur_controller->print_tt_1_penyalur();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $tt_1_penyalur_controller->list_tt_1_penyalur();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Tanda Terima Izin Penyalur Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

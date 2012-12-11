<?php


	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('sub_kategori_edar_pkrt_controller')) {
	// do nothing
} else if (defined('CLASS_sub_kategori_edar_pkrt_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_sub_kategori_edar_pkrt_CONTROLLER', TRUE);

include_once 'class.sub_kategori_edar_pkrt.inc.php';
class sub_kategori_edar_pkrt_controller extends depkes2_manager {
	var $sub_kategori_edar_pkrt_label;
	var $optional_arr;
	function sub_kategori_edar_pkrt_controller() {
		$this->sub_kategori_edar_pkrt_label = array (
			'id_sub_kategori_edar_pkrt' => 'Id Sub Kategori Edar',
			'nama_sub_kategori_edar_pkrt' => 'Nama Sub Kategori Edar',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert',
			'id_kategori_edar_pkrt' => 'Kategori',
			'nama_kategori_edar_pkrt' => 'Kategori'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_sub_kategori_edar_pkrt' => TRUE,
			'nama_sub_kategori_edar_pkrt' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE,
			'sifat' => FALSE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}
	
	function id_kategori_edar_pkrt_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['id_kategori_edar_pkrt'];

		include_once 'class.kategori_edar_pkrt.inc.php';
		$fk_sql = ''.
			'SELECT
				id_kategori_edar_pkrt as skey,
				nama_kategori_edar_pkrt as svalue2
			FROM
				kategori_edar_pkrt
			ORDER BY
				id_kategori_edar_pkrt
			';
		$result = kategori_edar_pkrt::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('id_kategori_edar_pkrt');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->sub_kategori_edar_pkrt_label['id_kategori_edar_pkrt']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['id_kategori_edar_pkrt'] = 'user_defined';
		$value_arr['id_kategori_edar_pkrt'] = $this->select_form('id_kategori_edar_pkrt', $result, $selected);
		$optional_arr['id_kategori_edar_pkrt_rule'] = "\n".
		"       if(theform.id_kategori_edar_pkrt.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['id_kategori_edar_pkrt']." ".__('empty').".');\n".
		"               theform.id_kategori_edar_pkrt.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";



	}


	// create add sub_kategori_edar_pkrt Perubahan Data Alkes form
	function add_sub_kategori_edar_pkrt_form() {
		include_once 'class.xform.inc.php';
	
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->sub_kategori_edar_pkrt_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('id_sub_kategori_edar_pkrt','N','4');
		$field_arr[] = xform::xf('nama_sub_kategori_edar_pkrt','X','-1');
		$field_arr[] = xform::xf('insert_by','C','16');
		$field_arr[] = xform::xf('date_insert','N','8');
		$field_arr[] = xform::xf('id_kategori_edar_pkrt','N','4');

		$rs = $adodb->Execute("SELECT * FROM sub_kategori_edar_pkrt WHERE id_sub_kategori_edar_pkrt='{$record['id_sub_kategori_edar_pkrt']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_sub_kategori_edar_pkrt'] = 'protect';
			$mode = 'edit';
			
		} else {
			$value_arr = array ();
			$mode = 'add';
		}
		
		$optional_arr['nama_sub_kategori_edar_pkrt_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';
		$optional_arr['sifat_rule'] = '';

		eval($this->save_config);
		$this->id_kategori_edar_pkrt_form($config);
				
                if($value_arr['sifat']=='perlu'){$check1='checked';$check2='';}else{$check1='';$check2='checked';}
                $optional_arr['sifat']='user_defined';
                $value_arr['sifat']='<input type="radio" name="sifat" value="perlu" class="text" '.$check1.'>Perlu <input type="radio" name="sifat" value="tidak perlu" class="text" '.$check2.'>Tidak perlu';


		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_sub_kategori_edar_pkrt']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Sub Kategori Izin Edar PKRT";
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

	// create update sub_kategori_edar_pkrt Perubahan Data Alkes form
	function update_sub_kategori_edar_pkrt_form() {
		return $this->add_sub_kategori_edar_pkrt_form();
	}

	// handle event add sub_kategori_edar_pkrt Perubahan Data Alkes
	function add_sub_kategori_edar_pkrt() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);
		
		
		$rs = $adodb->Execute("SELECT * FROM sub_kategori_edar_pkrt WHERE id_sub_kategori_edar_pkrt = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$record['insert_by'] = $ses->loginid;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM sub_kategori_edar_pkrt WHERE id_sub_kategori_edar_pkrt = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st '<b>{$record['id_sub_kategori_edar_pkrt']}</b>'";
		$this->log($status);
		
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}
	
	// handle event update sub_kategori_edar_pkrt Perubahan Data Alkes
	function update_sub_kategori_edar_pkrt() {
		return $this->add_sub_kategori_edar_pkrt();
	}

	// handle delete sub_kategori_edar_pkrt Perubahan Data Alkes
	function delete_sub_kategori_edar_pkrt() {
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
                        $success = $adodb->Execute("delete from sub_kategori_edar_pkrt where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'sub_kategori_edar_pkrt Perubahan Data Alkes <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'sub_kategori_edar_pkrt Perubahan Data Alkes <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Sub Kategori Izin Edar PKRT Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list sub_kategori_edar_pkrt Perubahan Data Alkes
	function list_sub_kategori_edar_pkrt($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'SELECT 
		sub_kategori_edar_pkrt.id_sub_kategori_edar_pkrt,
		kategori_edar_pkrt.nama_kategori_edar_pkrt,
		sub_kategori_edar_pkrt.nama_sub_kategori_edar_pkrt,
		sub_kategori_edar_pkrt.insert_by,
		sub_kategori_edar_pkrt.date_insert
		FROM sub_kategori_edar_pkrt
		LEFT OUTER JOIN kategori_edar_pkrt ON (kategori_edar_pkrt.id_kategori_edar_pkrt = sub_kategori_edar_pkrt.id_kategori_edar_pkrt)
		';
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;
		

		$vsel_arr = array (
			'id_sub_kategori_edar_pkrt' => TRUE,
			'nama_sub_kategori_edar_pkrt' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE,
			'sifat' => TRUE
		);
		$eval_arr = array ();
		$pk = array (
			'id_sub_kategori_edar_pkrt' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 600, 400, null, null, \'add_sub_kategori_edar_pkrt\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_sub_kategori_edar_pkrt\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_sub_kategori_edar_pkrt\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_sub_kategori_edar_pkrt\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->sub_kategori_edar_pkrt_label;
		$config = array (
			'id'		=> 'sub_kategori_edar_pkrt',
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
			'form_title'	=> __('List').' Sub Kategori Izin Edar PKRT'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print sub_kategori_edar_pkrt Perubahan Data Alkes
	function print_sub_kategori_edar_pkrt() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_sub_kategori_edar_pkrt($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$sub_kategori_edar_pkrt_controller = new sub_kategori_edar_pkrt_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $sub_kategori_edar_pkrt_controller->add_sub_kategori_edar_pkrt_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $sub_kategori_edar_pkrt_controller->add_sub_kategori_edar_pkrt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $sub_kategori_edar_pkrt_controller->update_sub_kategori_edar_pkrt_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $sub_kategori_edar_pkrt_controller->update_sub_kategori_edar_pkrt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $sub_kategori_edar_pkrt_controller->delete_sub_kategori_edar_pkrt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $sub_kategori_edar_pkrt_controller->import_sub_kategori_edar_pkrt_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $sub_kategori_edar_pkrt_controller->import_sub_kategori_edar_pkrt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $sub_kategori_edar_pkrt_controller->print_sub_kategori_edar_pkrt();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $sub_kategori_edar_pkrt_controller->list_sub_kategori_edar_pkrt();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Sub Kategori Izin Edar PKRT Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

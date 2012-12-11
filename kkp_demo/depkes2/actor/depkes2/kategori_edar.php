<?php

	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('kategori_edar_controller')) {
	// do nothing
} else if (defined('CLASS_kategori_edar_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_kategori_edar_CONTROLLER', TRUE);

include_once 'class.kategori_edar.inc.php';
class kategori_edar_controller extends depkes2_manager {
	var $kategori_edar_label;
	var $optional_arr;
	function kategori_edar_controller() {
		$this->kategori_edar_label = array (
			'id_kategori_edar' => 'Id kategori_edar',
			'nama_kategori_edar' => 'Nama kategori_edar',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert',
			'sifat' => 'Sifat'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_kategori_edar' => TRUE,
			'nama_kategori_edar' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE,
			'sifat' => FALSE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	// create add kategori_edar Perubahan Data Alkes form
	function add_kategori_edar_form() {
		include_once 'class.xform.inc.php';
	
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->kategori_edar_label;
		$optional_arr = $this->optional_arr;
		
		$field_arr[] = xform::xf('id_kategori_edar','N','4');
		$field_arr[] = xform::xf('nama_kategori_edar','X','-1');
		$field_arr[] = xform::xf('insert_by','C','16');
		$field_arr[] = xform::xf('date_insert','N','8');
		$field_arr[] = xform::xf('sifat','C','16');
		
		$rs = $adodb->Execute("SELECT * FROM kategori_edar WHERE id_kategori_edar='{$record['id_kategori_edar']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_kategori_edar'] = 'protect';
			$mode = 'edit';
			
		} else {
			$value_arr = array ();
			$mode = 'add';
		}
		
		$optional_arr['nama_kategori_edar_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';
		$optional_arr['sifat_rule'] = '';
		
		eval($this->save_config);
				
                if($value_arr['sifat']=='perlu'){$check1='checked';$check2='';}else{$check1='';$check2='checked';}
                $optional_arr['sifat']='user_defined';
                $value_arr['sifat']='<input type="radio" name="sifat" value="perlu" class="text" '.$check1.'>Perlu <input type="radio" name="sifat" value="tidak perlu" class="text" '.$check2.'>Tidak perlu';


		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_kategori_edar']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." kategori_edar Perubahan Data Izin Produksi";
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

	// create update kategori_edar Perubahan Data Alkes form
	function update_kategori_edar_form() {
		return $this->add_kategori_edar_form();
	}

	// handle event add kategori_edar Perubahan Data Alkes
	function add_kategori_edar() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);
		
		
		$rs = $adodb->Execute("SELECT * FROM kategori_edar WHERE id_kategori_edar = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$record['insert_by'] = $ses->loginid;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM kategori_edar WHERE id_kategori_edar = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st '<b>{$record['id_kategori_edar']}</b>'";
		$this->log($status);
		
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}
	
	// handle event update kategori_edar Perubahan Data Alkes
	function update_kategori_edar() {
		return $this->add_kategori_edar();
	}

	// handle delete kategori_edar Perubahan Data Alkes
	function delete_kategori_edar() {
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
                        $success = $adodb->Execute("delete from kategori_edar where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'kategori_edar Perubahan Data Alkes <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'kategori_edar Perubahan Data Alkes <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete kategori_edar Perubahan Data Izin Produksi Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list kategori_edar Perubahan Data Alkes
	function list_kategori_edar($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'SELECT 
		id_kategori_edar,
		nama_kategori_edar,
		insert_by,
		date_insert,
		sifat
		FROM kategori_edar';
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;
		

		$vsel_arr = array (
			'id_kategori_edar' => TRUE,
			'nama_kategori_edar' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE,
			'sifat' => TRUE
		);
		$eval_arr = array ();
		$pk = array (
			'id_kategori_edar' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 600, 400, null, null, \'add_kategori_edar\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_kategori_edar\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_kategori_edar\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_kategori_edar\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->kategori_edar_label;
		$config = array (
			'id'		=> 'kategori_edar',
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
			'form_title'	=> __('List').' kategori_edar Perubahan Data Izin Produksi'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print kategori_edar Perubahan Data Alkes
	function print_kategori_edar() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_kategori_edar($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$kategori_edar_controller = new kategori_edar_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $kategori_edar_controller->add_kategori_edar_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $kategori_edar_controller->add_kategori_edar();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $kategori_edar_controller->update_kategori_edar_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $kategori_edar_controller->update_kategori_edar();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $kategori_edar_controller->delete_kategori_edar();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $kategori_edar_controller->import_kategori_edar_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $kategori_edar_controller->import_kategori_edar();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $kategori_edar_controller->print_kategori_edar();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $kategori_edar_controller->list_kategori_edar();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'kategori_edar Perubahan Data Izin Produksi Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

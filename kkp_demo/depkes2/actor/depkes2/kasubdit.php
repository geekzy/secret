<?php

	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('kasubdit_controller')) {
	// do nothing
} else if (defined('CLASS_KASUBDIT_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_KASUBDIT_CONTROLLER', TRUE);

include_once 'class.kasubdit.inc.php';
class kasubdit_controller extends depkes2_manager {
	var $kasubdit_label;
	var $optional_arr;
	function kasubdit_controller() {
		$this->kasubdit_label = array (
			'userid' => 'Userid',
			'passwd' => 'Passwd',
			'id_subdit' => 'Subdit',
			'subdit' => 'Subdit',
			'keterangan' => 'Keterangan',
			'name' => 'Name',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'userid' => FALSE,
			'passwd' => FALSE,
			'name' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}

		function subdit_form(&$config) {

                eval($this->load_config);
                $selected = $value_arr['id_subdit'];

		include_once 'class.subdit.inc.php';
		$fk_sql = ''.
			'SELECT
				subdit.id_subdit as skey,
				subdit.subdit as svalue,
				subdit.keterangan as svalue2
			FROM
				subdit
			LEFT OUTER JOIN kasubdit ON(kasubdit.id_subdit = subdit.id_subdit)
			WHERE kasubdit.id_subdit IS NULL
			ORDER BY
				subdit.id_subdit
			';
		$result = subdit::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('id_subdit');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->tt_1_alkes_label['id_subdit']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['id_subdit'] = 'user_defined';
		$value_arr['id_subdit'] = $this->select_form('id_subdit', $result, $selected);
		$optional_arr['id_subdit_rule'] = "\n".
		"       if(theform.id_subdit.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['id_subdit']." ".__('empty').".');\n".
		"               theform.id_subdit.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";


	}

	// create add Kasubdit form
	function add_kasubdit_form() {
		include_once 'class.xform.inc.php';
	
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->kasubdit_label;
		$optional_arr = $this->optional_arr;
		
		$field_arr[] = xform::xf('userid','C','32');
		$field_arr[] = xform::xf('passwd','C','32');
		$field_arr[] = xform::xf('name','C','255');
		$field_arr[] = xform::xf('id_subdit','C','255');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');
		
		$rs = $adodb->Execute("SELECT * FROM kasubdit WHERE userid='{$record['userid']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['userid'] = 'protect';
			$mode = 'edit';
			$optional_arr['passwd_rule'] = '';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}
		$value_arr['passwd'] = '';
		$optional_arr['name_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';
		
		eval($this->save_config);
		$this->subdit_form($config);
				


		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['userid']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Kasubdit";
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

	// create update Kasubdit form
	function update_kasubdit_form() {
		return $this->add_kasubdit_form();
	}

	// handle event add Kasubdit
	function add_kasubdit() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);
		if ($record['passwd']) $record['passwd'] = md5($record['passwd']);
		else unset($record['passwd']);
		
		$rs = $adodb->Execute("SELECT * FROM kasubdit WHERE userid = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$record['insert_by'] = $ses->loginid;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM kasubdit WHERE userid = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st '<b>{$record['userid']}</b>'";
		$this->log($status);
		
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}
	
	// handle event update Kasubdit
	function update_kasubdit() {
		return $this->add_kasubdit();
	}

	// handle delete Kasubdit
	function delete_kasubdit() {
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
                        $success = $adodb->Execute("delete from kasubdit where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'Kasubdit <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'Kasubdit <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Kasubdit Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list Kasubdit
	function list_kasubdit($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'SELECT 
		kasubdit.userid,
		kasubdit.passwd,
		kasubdit.name,
		subdit.subdit,
		subdit.keterangan,
		kasubdit.insert_by,
		kasubdit.date_insert
		FROM
		kasubdit
		LEFT OUTER JOIN subdit ON(subdit.id_subdit = kasubdit.id_subdit)
		';
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'userid' => TRUE,
			'passwd' => TRUE,
			'name' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'userid' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 600, 400, null, null, \'add_kasubdit\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_kasubdit\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_kasubdit\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_kasubdit\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->kasubdit_label;
		$config = array (
			'id'		=> 'kasubdit',
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
			'form_title'	=> __('List').' Kasubdit'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print Kasubdit
	function print_kasubdit() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_kasubdit($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$kasubdit_controller = new kasubdit_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $kasubdit_controller->add_kasubdit_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $kasubdit_controller->add_kasubdit();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $kasubdit_controller->update_kasubdit_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $kasubdit_controller->update_kasubdit();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $kasubdit_controller->delete_kasubdit();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $kasubdit_controller->import_kasubdit_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $kasubdit_controller->import_kasubdit();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $kasubdit_controller->print_kasubdit();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $kasubdit_controller->list_kasubdit();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Kasubdit Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

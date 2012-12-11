<?php

	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('log_intern_controller')) {
	// do nothing
} else if (defined('CLASS_LOG_INTERN_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_LOG_INTERN_CONTROLLER', TRUE);

include_once 'class.log_intern.inc.php';
class log_intern_controller extends depkes2_manager {
	var $log_intern_label;
	var $optional_arr;
	function log_intern_controller() {
		$this->log_intern_label = array (
			'id' => 'Id',
			'username' => 'Username',
			'usertype' => 'Usertype',
			'activity' => 'Activity',
			'date_time' => 'Date Time'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id' => FALSE,
			'username' => FALSE,
			'usertype' => FALSE,
			'activity' => FALSE,
			'date_time' => FALSE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	// create add Log Intern form
	function add_log_intern_form() {
		include_once 'class.xform.inc.php';

//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->log_intern_label;
		$optional_arr = $this->optional_arr;
		
		$field_arr[] = xform::xf('id','N','4');
		$field_arr[] = xform::xf('username','C','32');
		$field_arr[] = xform::xf('usertype','C','32');
		$field_arr[] = xform::xf('activity','C','255');
		$field_arr[] = xform::xf('date_time','N','8');
		
		$rs = $adodb->Execute("SELECT * FROM log_intern WHERE id='{$record['id']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id'] = 'protect';
			$mode = 'edit';
			
		} else {
			$value_arr = array ();
			$mode = 'add';
		}
		
		$optional_arr['username_rule'] = '';
		$optional_arr['usertype_rule'] = '';
		$optional_arr['activity_rule'] = '';
		$optional_arr['date_time_rule'] = '';
		
		eval($this->save_config);
				


		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Log Intern";
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

	// create update Log Intern form
	function update_log_intern_form() {
		return $this->add_log_intern_form();
	}

	// handle event add Log Intern
	function add_log_intern() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);
		$record['date_time'] = $this->parsedate($record['date_time']);
		
		$rs = $adodb->Execute("SELECT * FROM log_intern WHERE id = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			
			$rs = $adodb->Execute("SELECT * FROM log_intern WHERE id = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st '<b>{$record['id']}</b>'";
		$this->log($status);
		
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}
	
	// handle event update Log Intern
	function update_log_intern() {
		return $this->add_log_intern();
	}

	// handle delete Log Intern
	function delete_log_intern() {
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
                        $success = $adodb->Execute("delete from log_intern where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'Log Intern <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'Log Intern <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Log Intern Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list Log Intern
	function list_log_intern($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'SELECT 
		id,
		username,
		usertype,
		activity,
		date_time
		FROM log_intern';
		$optional_arr = $this->optional_arr;
		

		$vsel_arr = array (
			'id' => TRUE,
			'username' => TRUE,
			'usertype' => TRUE,
			'activity' => TRUE,
			'date_time' => TRUE
		);
		$eval_arr = array ();
		$pk = array (
			'id' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 600, 400, null, null, \'add_log_intern\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_log_intern\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_log_intern\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_log_intern\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->log_intern_label;
		$config = array (
			'id'		=> 'log_intern',
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
			'form_title'	=> __('List').' Log Intern'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print Log Intern
	function print_log_intern() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_log_intern($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$log_intern_controller = new log_intern_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $log_intern_controller->add_log_intern_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $log_intern_controller->add_log_intern();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $log_intern_controller->update_log_intern_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $log_intern_controller->update_log_intern();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $log_intern_controller->delete_log_intern();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $log_intern_controller->import_log_intern_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $log_intern_controller->import_log_intern();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $log_intern_controller->print_log_intern();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $log_intern_controller->list_log_intern();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Log Intern Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

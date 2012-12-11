<?php


	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('phplayersmenu_controller')) {
	// do nothing
} else if (defined('CLASS_PHPLAYERSMENU_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_PHPLAYERSMENU_CONTROLLER', TRUE);

include_once 'class.phplayersmenu.inc.php';
class phplayersmenu_controller extends depkes2_manager {
	var $phplayersmenu_label;
	var $optional_arr;
	function phplayersmenu_controller() {
		$this->phplayersmenu_label = array (
			'id' => 'Id',
			'parent_id' => 'Parent Id',
			'text' => 'Text',
			'href' => 'Href',
			'title' => 'Title',
			'icon' => 'Icon',
			'target' => 'Target',
			'orderfield' => 'Orderfield',
			'expanded' => 'Expanded',
			'hide' => 'Status Hide'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id' => FALSE,
			'parent_id' => FALSE,
			'text' => FALSE,
			'href' => FALSE,
			'title' => FALSE,
			'icon' => FALSE,
			'target' => FALSE,
			'orderfield' => FALSE,
			'expanded' => FALSE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	// create add Phplayersmenu form
	function add_phplayersmenu_form() {
		include_once 'class.xform.inc.php';
	
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->phplayersmenu_label;
		$optional_arr = $this->optional_arr;
		
		$field_arr[] = xform::xf('id','N','720896');
		$field_arr[] = xform::xf('parent_id','N','720896');
		$field_arr[] = xform::xf('text','C','255');
		$field_arr[] = xform::xf('href','X','255');
		$field_arr[] = xform::xf('title','C','255');
		$field_arr[] = xform::xf('icon','X','255');
		$field_arr[] = xform::xf('target','C','255');
		$field_arr[] = xform::xf('orderfield','N','720896');
		$field_arr[] = xform::xf('expanded','N','720896');
		$field_arr[] = xform::xf('hide','N','720896');
		
		$rs = $adodb->Execute("SELECT * FROM phplayersmenu WHERE id='{$record['id']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id'] = 'protect';
			$mode = 'edit';
			
		} else {
			$value_arr = array ();
			$mode = 'add';
			$optional_arr['id'] = TRUE;
		}
		
		$optional_arr['parent_id_rule'] = '';
		$optional_arr['text_rule'] = '';
		$optional_arr['href_rule'] = '';
		$optional_arr['title_rule'] = '';
		$optional_arr['icon_rule'] = '';
		$optional_arr['target_rule'] = '';
		$optional_arr['orderfield_rule'] = '';
		$optional_arr['expanded_rule'] = '';
	
		$optional_arr[parent_id] = 'user_defined';
		$rs = $adodb->Execute("SELECT id, text  FROM phplayersmenu ORDER BY text");
		$str = "<select class=text name=parent_id>\n";
		$str .= "<option value=1>- Top Level - </option>\n";
		while ($rs && !$rs->EOF) {
			$Id = $rs->fields[id];
			$Text = $rs->fields[text];
			if ($Id == $value_arr[parent_id]) $selected = 'selected';
			else $selected = '';
			$str .= "<option value=$Id $selected>$Text</option>\n";
			$rs->MoveNext();
		}
		$str .= "</select>\n";
		$value_arr[parent_id] = $str;
		
		$optional_arr[expanded] = 'user_defined';
		$checked0 = $checked1 = '';
		if (intval($value_arr[expanded])==1) $checked1 = 'checked';
		else $checked0 = 'checked';
		$str = 	"<input id=expanded1 type=radio name=expanded value=1 $checked1>\n".
			"<label for=expanded1>Yes</label>\n".
			"&nbsp;&nbsp;&nbsp;&nbsp;\n".
			"<input id=expanded0 type=radio name=expanded value=0 $checked0>\n".
			"<label for=expanded0>No</label>\n";
		$value_arr[expanded] = $str;
		
		$optional_arr[hide] = 'user_defined';
		$checked0 = $checked1 = '';
		if (intval($value_arr[hide])==1) $checked1 = 'checked';
		else $checked0 = 'checked';
		$str = 	"<input id=hide1 type=radio name=hide value=1 $checked1>\n".
			"<label for=hide1>Yes</label>\n".
			"&nbsp;&nbsp;&nbsp;&nbsp;\n".
			"<input id=hide0 type=radio name=hide value=0 $checked0>\n".
			"<label for=hide0>No</label>\n";
			
		$value_arr[hide] = $str;
		
		eval($this->save_config);
		
		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra'] = "<input type=hidden name=action value='post$mode'>"; // default null
		$label_arr['form_title'] = "Form ".ucwords($mode)." Phplayersmenu";
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

	// create update Phplayersmenu form
	function update_phplayersmenu_form() {
		return $this->add_phplayersmenu_form();
	}

	// handle event add Phplayersmenu
	function add_phplayersmenu() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);
		
		$rs = $adodb->Execute("SELECT * FROM phplayersmenu WHERE id='".intval($record['id'])."'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$rs2 = $adodb->Execute("SELECT id FROM phplayersmenu ORDER BY id DESC LIMIT 1");
			$record[id] = intval($rs2->fields[id])+1;
			if ($record[id]==1) $record[id] = 2;
			if ($record[orderfield]=='') $record[orderfield] = $record[id]*10;
		
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st <b>{$record['id']}</b>";
		
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array($status));
		
		return $_block->get_str();
	}
	
	// handle event update Phplayersmenu
	function update_phplayersmenu() {
		return $this->add_phplayersmenu();
	}

        function getTableStr($start, $arrId, $arrText, $level=0) {
                global $adodb;
                $rs = $adodb->Execute("SELECT id, text, hide, orderfield FROM phplayersmenu WHERE parent_id='$start' AND hide=0 ORDER BY orderfield");
                while (! $rs->EOF) {
                        $parentId = $start;
                        $Id = $rs->fields[id];
                        $Text = $rs->fields[text];
                        $Hide = $rs->fields[hide];
                        $orderField = $rs->fields[orderfield];
                        $selectStr = "<select class=text name='parent_id[$Id]'>\n";
                        $selectStr .= "<option value=1>- Top Level -</option>\n";
                        foreach ($arrId as $val2) {
                                if ($Id == $val2) continue;
                                $Text2 = $arrText[$val2];
                                if ($parentId == $val2) $selected = 'selected';
                                else $selected = '';
                                $selectStr .= "<option value='$val2' $selected>$Text2</option>\n";
                        }
                        $selectStr .= "</select>\n";
                        $hideStr = "<input type=text name=hide[$Id] value=$Hide class=text size=1>";
                        $orderStr = "<input type=text name=orderfield[$Id] value='$orderField' class=text size=4>";
                        $tableStr .= "<tr><td>".str_repeat("&nbsp;", $level*5)."$Text</td><td>$selectStr</td><td>$hideStr</td><td>$orderStr</td></tr>\n";
                        $tableStr .= $this->getTableStr($Id, $arrId, $arrText, $level+1);
                        $rs->MoveNext();
                }
                return $tableStr;
        }

	function swap_phplayersmenu_form() {
		global $adodb;

		$rs = $adodb->Execute("SELECT * FROM phplayersmenu ORDER BY text");
		$arrId = array();
		$arrParentId = array();
		$arrText = array();
		while ($rs && !$rs->EOF) {
			$Id = $rs->fields['id'];
			$arrText[$Id] = $rs->fields['text'];
			$arrId[] = $Id;
			$rs->MoveNext();
		}

		$tableStr = 
			"<form name=theform method=post>\n".
			"<table class=in_table>\n".
			"<tr><td colspan=4 align=center>".
			"<input class=button type=submit name=submit value=Submit>\n".
			"<input class=button type=button name=close value=Close onClick='javascript:window.close()'>\n".
			"</td></tr>".
			"<tr class=title_table><td>Menu</td><td>Parent</td><td>Hide</td><td>Order</td></tr>\n".
			$this->getTableStr(1, &$arrId, &$arrText).
			"<tr><td colspan=4 align=center>".
			"<input class=text type=hidden name=action value=postswap>\n".
			"<input class=button type=submit name=submit value=Submit>\n".
			"<input class=button type=button name=close value=Close onClick='javascript:window.close()'>\n".
			"</table>\n".
			"</form>\n";
		return $tableStr;
	}

	function swap_phplayersmenu() {
		global $_POST, $adodb;
		foreach ($_POST[parent_id] as $k => $v) {
			$adodb->Execute("UPDATE phplayersmenu SET parent_id='$v',hide='".$_POST[hide][$k]."', orderfield='".$_POST[orderfield][$k]."' WHERE id='$k'");
		}
		$status .= "Successfull swaped.";
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array($status));
		return $_block->get_str();
	}
	
	function getTableStr_v02($start=1, $level=0, $arrcat=array(), $arrrs=array()) {
		global $adodb;
		if ($start==1 && $level==0) {
			$rs = $adodb->Execute("SELECT id FROM phplayersmenu_cat WHERE cat='{$_GET[cat]}'");
			while (!$rs->EOF) {
				$arrcat[$rs->fields[id]] = 1;
				$rs->MoveNext();
			}
#print_r($arrcat);
			$rs = $adodb->Execute("SELECT parent_id, id, text FROM phplayersmenu WHERE hide=0 ORDER BY orderfield");
		while (! $rs->EOF) {
				$arrrs[$rs->fields[parent_id]][] = $rs->fields;
				$rs->MoveNext();
			}
#print_r($rsfields);
			#echo $GLOBALS[my_xx]++;exit;
			#echo 'test';
			#if ($GLOBALS[my_xx]==2) exit;
		}
		
		#$rs = $adodb->Execute("SELECT id, text FROM phplayersmenu WHERE parent_id='$start' AND hide=0 ORDER BY orderfield");
		foreach ($arrrs[$start] as $rsfields) {
		#$rs = $rsfields[$start];
		#while (! $rs->EOF) {
			$parentId = $start;
			$Id = $rsfields[id];
			$Text = $rsfields[text];
			#$rs2 = $adodb->Execute("SELECT id FROM phplayersmenu WHERE parent_id='$Id'");
			#if ($rs2->EOF) {
			#$rs2 = $adodb->Execute("SELECT id FROM phplayersmenu_cat WHERE id='$Id' AND cat='{$_GET[cat]}'");
			#if ($rs2 && !$rs2->EOF) $checked = 'checked';
			#else $checked = '';
			if ($arrcat[$Id]==1) $checked = 'checked';
			else $checked = '';
			$tableStr .= 
			"<input $checked type=checkbox id='menu$Id' name='listID[$Id]' value=1> ".str_repeat("&nbsp;", $level*5).
			"<label for='menu$Id'>$Text</label><br>\n";
			#}
			$tableStr .= $this->getTableStr_v02($Id, $level+1, $arrcat, $arrrs);
			#$rs->MoveNext();
		}
		return $tableStr;
	}
	
	function cat_phplayersmenu_form() {
		global $adodb, $adodb_type;

		// -- get meta tables
		/*
		$result = array();
		if (eregi('postgre', $adodb_type)) {
			$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
			$rs = $adodb->Execute("SELECT tablename FROM pg_tables WHERE schemaname='public'");
			while (! $rs->EOF) {
				$result[] = $rs->fields[tablename];
				$rs->MoveNext();
			}
		} else {
			$result = $adodb->MetaTables();
		}
		*/
		$result = $GLOBALS[arr_login];

		$selectStr = "<select name=cat class=text onChange='oc_cat(this)'>\n";
		$selectStr .= "<option value=''>- TableName -</option>\n";
		foreach ($result as $k => $v) {
			#echo $v."<br>\n";
			#$result2 = $adodb->MetaColumns($v);
			#foreach ($result2 as $k2 => $v2) {
			#	if ($v2->name=='passwd') {
					if ($v == $_GET[cat]) $selected = 'selected';
					else $selected = '';
					$selectStr .= "<option value=$v $selected>$v</option>\n";
			#	}
			#}
				}
		#exit;
		$selectStr .= "</select>\n";
		$selectStr .= "<script language=javascript>function oc_cat(t) { location.href='$PHP_SELF?action=cat&cat='+t.value;} </script>";

		$tableStr = 
			"<form name=theform method=post>\n".
			"<table class=in_table>\n".
			"<tr class=title_table><th colspan=2>Form PHPLayersMenu Categori</th></tr>\n".
			"<tr><td>Kategori</td><td>$selectStr".
			"<input class=button type=submit name=submit value=Submit>\n".
			"<input class=button type=button name=close value=Close onClick='javascript:window.close()'>\n".
			"</td></tr>\n".
			"<tr><td>&nbsp;</td><td>".
			" <input id=checkall type=checkbox name=all ".
			"  onClick='for(i=0;i<document.theform.elements.length;i++){ ".
			"  e=document.theform.elements[i]; ".
			"  if(e.type==\"checkbox\"&&document.theform.all.checked) e.checked=true; ".
			"  else e.checked=false;}'> <label for=checkall>Check All</label><br>".
			$this->getTableStr_v02()."</td></tr>\n".
			"<tr><td colspan=2 align=center>".
			"<input class=text type=hidden name=action value=postcat>\n".
			"<input class=button type=submit name=submit value=Submit>\n".
			"<input class=button type=button name=close value=Close onClick='javascript:window.close()'>\n".
			"</td></tr>\n".
			"</table>\n".
			"</form>\n";
		
		return $tableStr;
	}
	
	function cat_phplayersmenu() {
		global $adodb, $_POST;

		$record = array();
		$record[cat] = $_POST[cat];
		$rs = $adodb->Execute("SELECT * FROM ".$record[cat]." LIMIT 1");
		#if (! $adodb->MetaColumns($record[cat])) {
		if (!$rs) {
			$status .= $record[cat]." can not be cated !";
		} else {
			$adodb->Execute("DELETE FROM phplayersmenu_cat WHERE cat='{$record[cat]}'");
			#$rs = $adodb->Execute("SELECT * FROM phplayersmenu_cat LIMIT 1");
			#$adodb->Execute("BEGIN");
			foreach ($_POST['listID'] as $k => $v) {
				if ($v==1) {
					$record[id] = trim($k);
					#$adodb->Execute($adodb->GetInsertSQL($rs, $record));
					if ($in) $in .= ",";
					$in .= trim($k);
				}
			}
			#$adodb->debug = 1;
			$adodb->Execute("INSERT INTO phplayersmenu_cat (id, cat) SELECT id, '".$_POST[cat]."' FROM phplayersmenu WHERE id IN ($in)");
			#exit;
			#$adodb->Execute("COMMIT");
			$status .= "Successfull ".$record[cat]." cated.";
		}
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array($status));
		return $_block->get_str();
	}

	function user_phplayersmenu_form() {
		global $adodb, $adodb_type;

		// -- get user record
		$field = 'user_name';
		$table = 'userlogin';
		$result = array();
		$rs = $adodb->Execute("SELECT $field FROM $table ORDER BY $field");
		while ($rs && ! $rs->EOF) {
			$result[] = $rs->fields[$field];
			$rs->MoveNext();
		}

		$selectStr = "<select name=cat class=text onChange='oc_cat(this)'>\n";
		$selectStr .= "<option value=''>- User -</option>\n";
		foreach ($result as $k => $v) {
			if ($v == $_GET[cat]) $selected = 'selected';
			else $selected = '';
			$selectStr .= "<option value=$v $selected>$v</option>\n";
		}
		$selectStr .= "</select>\n";
		$selectStr .= "<script language=javascript>function oc_cat(t) { location.href='$PHP_SELF?action=user&cat='+t.value;} </script>";

		$tableStr = 
			"<form name=theform method=post>\n".
			"<table class=in_table>\n".
			"<tr class=title_table><th colspan=2>Form PHPLayersMenu Categori</th></tr>\n".
			"<tr><td>Kategori</td><td>$selectStr".
			"<input class=button type=submit name=submit value=Submit>\n".
			"<input class=button type=button name=close value=Close onClick='javascript:window.close()'>\n".
			"</td></tr>\n".
			"<tr><td>&nbsp;</td><td>".
			" <input id=checkall type=checkbox name=all ".
			"  onClick='for(i=0;i<document.theform.elements.length;i++){ ".
			"  e=document.theform.elements[i]; ".
			"  if(e.type==\"checkbox\"&&document.theform.all.checked) e.checked=true; ".
			"  else e.checked=false;}'> <label for=checkall>Check All</label><br>".
			$this->getTableStr_v02()."</td></tr>\n".
			"<tr><td colspan=2 align=center>".
			"<input class=text type=hidden name=action value=postuser>\n".
			"<input class=button type=submit name=submit value=Submit>\n".
			"<input class=button type=button name=close value=Close onClick='javascript:window.close()'>\n".
			"</td></tr>\n".
			"</table>\n".
			"</form>\n";
		
		return $tableStr;
	}

	function user_phplayersmenu() {
		global $adodb, $_POST;

		$record = array();
		$record[cat] = $_POST[cat];
		$rs = $adodb->Execute("SELECT user_name FROM userlogin");
		if (! $rs->fields[user_name]) {
			$status .= $record[cat]." can not be cated !";
		} else {
			$adodb->Execute("DELETE FROM phplayersmenu_cat WHERE cat='{$record[cat]}'");
			$rs = $adodb->Execute("SELECT * FROM phplayersmenu_cat LIMIT 1");
			foreach ($_POST['listID'] as $k => $v) {
				if ($v==1) {
					$record[id] = $k;
					$adodb->Execute($adodb->GetInsertSQL($rs, $record));
				}
			}
			$status .= "Successfull ".$record[cat]." cated.";
		}
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array($status));
		return $_block->get_str();
	}

	// handle delete Phplayersmenu
	function delete_phplayersmenu() {
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

		if ($query)
			$success = $adodb->Execute("delete from phplayersmenu where ".$query);

		$_block = new block();
		$_block->set_config('title', ('Delete Phplayersmenu Status'));
		$_block->set_config('width', 595);
				$info[] = ('+Phplayersmenu <font color=red>'.$query.'</font> <font color=green><b>'.__('Successfull Deleted').'</b></font>');
//				$adodb->Execute('delete from fill_this where '.$query3);
		if ($success){
			$_block->parse(&$info);
			return $_block->get_str();
		} else {
			$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
			$_block->parse(array('+<font color=red><b>'.__('Failed Deleted').'</b></font>'));
			return $_block->get_str();
		}
	}

	// handle list Phplayersmenu
	function list_phplayersmenu($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'select * from phplayersmenu';// where vendor_code=\''.$vendor_code.'\'';
		$optional_arr = $this->optional_arr;
		

		$vsel_arr = array (
			'id' => TRUE,
			'parent_id' => TRUE,
			'text' => TRUE,
			'href' => TRUE,
			'title' => TRUE,
			'icon' => TRUE,
			'target' => TRUE,
			'orderfield' => TRUE,
			'expanded' => TRUE
		);
		$eval_arr = array ();
		$pk = array (
			'id' => TRUE
		);
			$swap_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=swap' . 
			'\', 600, 400, null, null, \'swap_phplayersmenu\');'.
			'win.focus()', 
			"label" => 'Swap',
			"type" => "button"));

			$cat_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=cat' . 
			'\', 600, 400, null, null, \'\');'.
			'win.focus()', 
			"label" => 'Table',
			"type" => "button"));
			
			$user_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=user' . 
			'\', 600, 400, null, null, \'user_phplayersmenu\');'.
			'win.focus()', 
			"label" => 'User',
			"type" => "button"));
			
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 600, 400, null, null, \'add_phplayersmenu\');'.
			'win.focus()', 
			"title"=>__("Add").' Phplayersmenu', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_phplayersmenu\');'.
			'win.focus()', 
			"title"=>__("Edit").' Phplayersmenu', 
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' . 
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_phplayersmenu\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"title"=>__('Delete').' Phplayersmenu', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_phplayersmenu\');'.
			'win.focus()', 
			"title"=>__('Print').' Phplayersmenu', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));


		$label_arr = $this->phplayersmenu_label;
		$config = array (
			'id'		=> 'phplayersmenu',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $cat_anchor.$swap_anchor.$add_anchor,
			'edit_anchor'	=> $edit_anchor,
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Phplayersmenu'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print Phplayersmenu
	function print_phplayersmenu() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_phplayersmenu($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$phplayersmenu_controller = new phplayersmenu_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $phplayersmenu_controller->add_phplayersmenu_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $phplayersmenu_controller->add_phplayersmenu();
			$out_content .= '<br>'.$phplayersmenu_controller->add_phplayersmenu_form();
			#$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $phplayersmenu_controller->update_phplayersmenu_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $phplayersmenu_controller->update_phplayersmenu();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $phplayersmenu_controller->delete_phplayersmenu();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'swap':
			$out_content = $phplayersmenu_controller->swap_phplayersmenu_form();
			$out_content .= $back_to_menu;
			break;
		case 'postswap':
			$out_content = $phplayersmenu_controller->swap_phplayersmenu();
			$out_content .= "<br>".$phplayersmenu_controller->swap_phplayersmenu_form();
			#$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'cat':
			$out_content = $phplayersmenu_controller->cat_phplayersmenu_form();
			$out_content .= $back_to_menu;
			break;
		case 'postcat':
			$out_content = $phplayersmenu_controller->cat_phplayersmenu();
			$out_content .= "<br>".$phplayersmenu_controller->cat_phplayersmenu_form();
			#$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'user':
			$out_content = $phplayersmenu_controller->user_phplayersmenu_form();
			$out_content .= $back_to_menu;
			break;
		case 'postuser':
			$out_content = $phplayersmenu_controller->user_phplayersmenu();
			$out_content .= "<br>".$phplayersmenu_controller->user_phplayersmenu_form();
			#$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $phplayersmenu_controller->print_phplayersmenu();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $phplayersmenu_controller->list_phplayersmenu();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Phplayersmenu Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

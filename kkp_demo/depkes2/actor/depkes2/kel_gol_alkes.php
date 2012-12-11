<?php


	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('kel_gol_alkes_controller')) {
	// do nothing
} else if (defined('CLASS_KEL_GOL_ALKES_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_KEL_GOL_ALKES_CONTROLLER', TRUE);

include_once 'class.kel_gol_alkes.inc.php';
class kel_gol_alkes_controller extends depkes2_manager {
	var $kel_gol_alkes_label;
	var $optional_arr;
	function kel_gol_alkes_controller() {
		$this->kel_gol_alkes_label = array (
			'id_golongan' => 'Id Golongan',
			'id_kelengkapan' => 'Id Kelengkapan',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_golongan' => TRUE,
			'id_kelengkapan' => TRUE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	// create add Kel Gol Alkes form
	function add_kel_gol_alkes_form() {
		include_once 'class.xform.inc.php';
	
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->kel_gol_alkes_label;
		$optional_arr = $this->optional_arr;
		
		$field_arr[] = xform::xf('id_golongan','N','4');
		$field_arr[] = xform::xf('id_kelengkapan','N','4');
		$field_arr[] = xform::xf('insert_by','C','16');
		$field_arr[] = xform::xf('date_insert','N','8');
		
		$rs = $adodb->Execute("SELECT * FROM kel_gol_alkes WHERE id_golongan='{$record['id_golongan']}' AND id_kelengkapan='{$record['id_kelengkapan']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_golongan'] = 'protect';
			$optional_arr['id_kelengkapan'] = 'protect';
			$mode = 'edit';
			
		} else {
			$value_arr = array ();
			$mode = 'add';
		}
		
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';
		
		eval($this->save_config);
				
		$optional_arr['id_golongan'] = 'user_defined';
                $arr = array();
                $arr['name'] = 'id_golongan';
                $arr['selected'] = $value_arr['id_golongan'];
                $arr['sql'] = 'SELECT id_golongan as val, golongan as txt FROM gol_alkes';
                $value_arr['id_golongan'] = xform::dbs($arr);

                $optional_arr['id_kelengkapan']='user_defined';
                global $adodb;
                $sqlx = "SELECT id_kelengkapan,nama_kelengkapan FROM kelengkapan_alkes ORDER BY id_kelengkapan";
                $rsx = $adodb->Execute($sqlx);
                $a=0;
                while(! $rsx->EOF){
                        $id_kelengkapan = $rsx->fields['id_kelengkapan'];
                        $nama_kelengkapan = $rsx->fields['nama_kelengkapan'];
                        $sql = "SELECT id_kelengkapan FROM kel_gol_alkes WHERE id_kelengkapan='".$id_kelengkapan."'";
                        $rs = $adodb->Execute($sql);
                        $xid_kelengkapan = $rs->fields['id_kelengkapan'];
                        if($id_kelengkapan==$xid_kelengkapan){
                                $has .= "<input type=checkbox name=id_kelengkapan[".$a."] value=".$id_kelengkapan." class=text checked>".$nama_kelengkapan."<br>";
                        }else{
                                $has .= "<input type=checkbox name=id_kelengkapan[".$a."] value=".$id_kelengkapan." class=text>".$nama_kelengkapan."<br>";
                        }
                        $a=$a+1;
                        $rsx->MoveNext();
                }
                $value_arr['id_kelengkapan'] = $has;

		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_golongan']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Kel Gol Alkes";
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

	// create update Kel Gol Alkes form
	function update_kel_gol_alkes_form() {
		return $this->add_kel_gol_alkes_form();
	}

	// handle event add Kel Gol Alkes
	function add_kel_gol_alkes() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;

		//foreach ($record as $k => $v) { $record[$k] = trim($v);print_r($record);}
		$jml_kelengkapan = count($_POST['id_kelengkapan']);
		$adodb->Execute("DELETE FROM kel_gol_alkes WHERE id_golongan='".$_POST['id_golongan']."'");
		for($a=0;$a<=$jml_kelengkapan;$a++){
			$id_kelengkapan = $_POST['id_kelengkapan'][$a];
			if($id_kelengkapan != ''){
				$record = array (
					'id_golongan' => $_POST['id_golongan'],
					'id_kelengkapan' => $id_kelengkapan,
					'insert_by' => $GLOBALS['ses']->loginid,
					'date_insert' => time()
				);
				kel_gol_alkes::add($record);
			}
		}


		$status = "Successfull $st '<b>{$record['id_golongan']} - {$record['id_kelengkapan']}</b>'";
		$this->log($status);

		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}

	// handle event update Kel Gol Alkes
	function update_kel_gol_alkes() {
		return $this->add_kel_gol_alkes();
	}

	// handle delete Kel Gol Alkes
	function delete_kel_gol_alkes() {
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
                        $success = $adodb->Execute("delete from kel_gol_alkes where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'Kel Gol Alkes <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'Kel Gol Alkes <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Kel Gol Alkes Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list Kel Gol Alkes
	function list_kel_gol_alkes($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = '
                select
                kel_gol_alkes.id_golongan,
                gol_alkes.golongan,
                kel_gol_alkes.id_kelengkapan,
                kelengkapan_alkes.nama_kelengkapan,
                kel_gol_alkes.insert_by,
                kel_gol_alkes.date_insert
                from kel_gol_alkes
                LEFT OUTER JOIN gol_alkes ON(gol_alkes.id_golongan = kel_gol_alkes.id_golongan)
                LEFT OUTER JOIN kelengkapan_alkes ON(kelengkapan_alkes.id_kelengkapan = kel_gol_alkes.id_kelengkapan)
                ';
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_golongan' => TRUE,
			'id_kelengkapan' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'id_golongan' => TRUE,
			'id_kelengkapan' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 600, 400, null, null, \'add_kel_gol_alkes\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_kel_gol_alkes\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_kel_gol_alkes\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_kel_gol_alkes\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->kel_gol_alkes_label;
		$config = array (
			'id'		=> 'kel_gol_alkes',
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
			'form_title'	=> __('List').' Kel Gol Alkes'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print Kel Gol Alkes
	function print_kel_gol_alkes() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_kel_gol_alkes($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$kel_gol_alkes_controller = new kel_gol_alkes_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $kel_gol_alkes_controller->add_kel_gol_alkes_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $kel_gol_alkes_controller->add_kel_gol_alkes();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $kel_gol_alkes_controller->update_kel_gol_alkes_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $kel_gol_alkes_controller->update_kel_gol_alkes();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $kel_gol_alkes_controller->delete_kel_gol_alkes();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $kel_gol_alkes_controller->import_kel_gol_alkes_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $kel_gol_alkes_controller->import_kel_gol_alkes();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $kel_gol_alkes_controller->print_kel_gol_alkes();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $kel_gol_alkes_controller->list_kel_gol_alkes();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Kel Gol Alkes Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

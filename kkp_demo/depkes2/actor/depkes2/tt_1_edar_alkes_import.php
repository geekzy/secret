<?php

	
	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('tt_1_edar_alkes_import_controller')) {
	// do nothing
} else if (defined('CLASS_tt_1_edar_alkes_import_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_tt_1_edar_alkes_import_CONTROLLER', TRUE);

include_once 'class.tt_1_edar_alkes_import.inc.php';
class tt_1_edar_alkes_import_controller extends depkes2_manager {
	var $tt_1_edar_alkes_import_label;
	var $optional_arr;
	function tt_1_edar_alkes_import_controller() {
		$this->tt_1_edar_alkes_import_label = array (
			'urut_no_tt' => 'No Tanda Terima',
			'subdit' => 'Subdit',
			'kode_subdit' => 'Kode Subdit',
			'nama_pabrik' => 'Nama Pabrik',
 			'kode_pendaftar_edar_alkes_import' => 'Nama pabrik / Nama Pemohon',
			'alamat_pabrik' => 'Alamat pabrik',
			'nama_propinsi_2' => 'Nama propinsi',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'no_tt' => FALSE,
			'kode_subdit' => FALSE,
 			'kode_pendaftar_edar_alkes_import' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}

        function view_tt_1_edar_form() {
//              if (! $this->get_permission('fill_this')) return $this->intruder();
                global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
                #$field_arr = tt_1_alkes::get_field_set();

                $optional_arr = $this->optional_arr;
                $optional_arr['no_tt'] = 'protect';

                $record = array (
                        'no_tt' => ${$GLOBALS['get_vars']}['no_tt']
                );
                #$result = tt_1_alkes::get($record);
                $value_arr = $result[0];
                $label_arr = $this->tt_1_alkes_label;
                global $adodb;

                define('FPDF_FONTPATH','fpdf/font/');
                require('fpdf/fpdf.php');
                $pdf=new FPDF('L','mm','A5');
                $pdf->Open();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',14);
                $pdf->Cell(180,7,'SURAT  TANDA  TERIMA UBAH IZIN PRODUKSI','',0,'L');
                $pdf->Ln(5);
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(180,7,'Departemen Kesehatan RI','',0,'L');
                $pdf->Ln(5);
                $pdf->Cell(180,7,'Tanda Terima Permohonan Ijin Produksi Alkes/PKRT','',0,'L');
                $pdf->Ln(5);
                $pdf->Cell(180,7,'( Berdasarkan subdit yang dipilih pada tanda terima )','',0,'L');
                $pdf->Ln(5);
                $pdf->Cell(180,7,'','B',0,'L');
                $pdf->Ln(10);
                $pdf->SetFont('Arial','',12);

                $sql = "SELECT
                a.no_tt,
                a.urut_no_tt,
                subdit.subdit,
                a.date_insert,
                c.nama_pabrik,
                c.nama_pendaftar_edar_alkes_import as nama_pendaftar,
                c.alamat_pendaftar_edar_alkes_import as alamat_pendaftar,
                c.alamat_pabrik,
                c.nama_propinsi_2,
                c.userid,
                c.tpwd,
                a.insert_by
                FROM tt_1_edar_alkes_import a
                LEFT OUTER JOIN subdit ON(subdit.id_subdit = a.kode_subdit)
                LEFT OUTER JOIN pendaftar_edar_alkes_import c ON(c.kode_pendaftar_edar_alkes_import = a.kode_pendaftar_edar_alkes_import)
                WHERE
                a.no_tt ='".$_GET['no_tt']."'
                GROUP BY
                a.no_tt,
                a.urut_no_tt,
                subdit.subdit,
                a.date_insert,
                c.nama_pabrik,
                c.nama_pendaftar_edar_alkes_import,
                c.alamat_pendaftar_edar_alkes_import,
                c.alamat_pabrik,
                c.nama_propinsi_2,
                c.userid,
                c.tpwd,
                a.insert_by
                ";
                //print $sql;
                $rs = $adodb->Execute($sql);
                $urut_no_tt = $rs->fields['urut_no_tt'];
                $nama_pendaftar = $rs->fields['nama_pendaftar'];
                $alamat_pendaftar = $rs->fields['alamat_pendaftar'];
                $nama_pabrik = $rs->fields['nama_pabrik'];
                $userid = $rs->fields['userid'];
                $pwd = $rs->fields['tpwd'];
                $pdf->Ln(10);
                $pdf->Cell(30,7,'No Tanda Terima','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$urut_no_tt
.'','',0,'L');
                $pdf->Ln(10);
                $pdf->Cell(30,7,'Nama Pemohon','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$nama_pendaftar.'','',0,'L');
                $pdf->Ln(10);
                $pdf->Cell(30,7,'Alamat Pemohon','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$alamat_pendaftar.'','',0,'L');
                $pdf->Ln(10);
                $pdf->Cell(30,7,'Nama Pabrik','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$nama_pabrik.'','',0,'L');
                $pdf->Ln(10);
                $pdf->Cell(30,7,'User ID','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$userid.'','',0,'L');
                $pdf->Ln(10);
                $pdf->Cell(30,7,'Password','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$pwd.'','',0,'L');
                $pdf->Ln(10);
                $pdf->Output();

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
				'svalue' => __('Choose').' '.$this->tt_1_edar_alkes_import_label['kode_subdit']
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

function pendaftar_edar_alkes_import_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['kode_pendaftar_edar_alkes_import'];

		include_once 'class.pendaftar_edar_alkes_import.inc.php';
		$fk_sql = ''.
			'SELECT
				kode_pendaftar_edar_alkes_import as skey,
				nama_pabrik as svalue,
				nama_pendaftar_edar_alkes_import as svalue2
			FROM
				pendaftar_edar_alkes_import
			ORDER BY
				kode_pendaftar_edar_alkes_import
			';
		$result = pendaftar_edar_alkes_import::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('kode_pendaftar_edar_alkes_import');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->tt_1_edar_alkes_import_label['kode_pendaftar_edar_alkes_import']
			)
		);

		

  $jas ="
		b = document.theform.kode_pendaftar_edar_alkes_import.value;
		sql = 'SELECT alamat_pabrik,nama_propinsi_2 FROM pendaftar_edar_alkes_import  WHERE kode_pendaftar_edar_alkes_import=\''+ b +'\'';

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
		$optional_arr['kode_pendaftar_edar_alkes_import'] = 'user_defined';
		$value_arr['kode_pendaftar_edar_alkes_import'] = $this->select_form('kode_pendaftar_edar_alkes_import', $result, $selected,$multiple=FALSE,$jas);
		$optional_arr['kode_pendaftar_edar_alkes_import_rule'] = "\n".
		"       if(theform.kode_pendaftar_edar_alkes_import.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['kode_pendaftar_edar_alkes_import']." ".__('empty').".');\n".
		"               theform.kode_pendaftar_edar_alkes_import.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";




	}


	// create add tt_1_edar_alkes_import form
	function add_tt_1_edar_alkes_import_form() {
		include_once 'class.xform.inc.php';
		//if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->tt_1_edar_alkes_import_label;
		$optional_arr = $this->optional_arr;

		if($_GET['no_tt']){$field_arr[] = xform::xf('urut_no_tt','C','255');}
		$field_arr[] = xform::xf('kode_subdit','C','255');
		$field_arr[] = xform::xf('kode_pendaftar_edar_alkes_import','C','255');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');

		$rs = $adodb->Execute("SELECT * FROM tt_1_edar_alkes_import WHERE no_tt='{$record['no_tt']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['no_tt'] = 'protect';
			$mode = 'edit';

		} else {
			$value_arr = array ();
			$mode = 'add';
		}

		$optional_arr['nama_tt_1_edar_alkes_import_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';
		
		global $adodb;
		$rsx = $adodb->Execute("SELECT no_tt FROM tt_1_edar_alkes_import ORDER BY no_tt DESC LIMIT 1");
		$no_ttx = $rsx->fields['no_tt'];
		$no_ttx = $no_ttx +1;
		eval($this->save_config);
		$optional_arr['urut_no_tt'] = 'user_defined';
		$value_arr['urut_no_tt'] = '<input type="text" name="urut_no_tt" value="'.$value_arr['urut_no_tt'].'" readonly class="text">';
		$this->subdit_form($config);
		$this->pendaftar_edar_alkes_import_form($config);



		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['no_tt']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Tanda Terima Izin Edar Import Alkes";
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

	// create update tt_1_edar_alkes_import form
	function update_tt_1_edar_alkes_import_form() {
		return $this->add_tt_1_edar_alkes_import_form();
	}

	// handle event add tt_1_edar_alkes_import
	function add_tt_1_edar_alkes_import() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);
		
		$rsx = $adodb->Execute("SELECT * FROM tt_1_edar_alkes_import ORDER by no_tt DESC LIMIT 1");
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


		$rs = $adodb->Execute("SELECT * FROM tt_1_edar_alkes_import WHERE no_tt = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$record['insert_by'] = $ses->loginid;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM tt_1_edar_alkes_import WHERE no_tt = NULL");
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
	
	// handle event update tt_1_edar_alkes_import
	function update_tt_1_edar_alkes_import() {
		return $this->add_tt_1_edar_alkes_import();
	}

	// handle delete tt_1_edar_alkes_import
	function delete_tt_1_edar_alkes_import() {
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
                        $success = $adodb->Execute("delete from tt_1_edar_alkes_import where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'tt_1_edar_alkes_import <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'tt_1_edar_alkes_import <font color=red>'.$query.'</font>';
                }
                $this->log($status);

                $_block = new block();
                $_block->set_config('title', ('Delete Tanda Terima Izin Edar Import Alkes Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list tt_1_edar_alkes_import
	function list_tt_1_edar_alkes_import($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'SELECT
		tt_1_edar_alkes_import.no_tt,
		tt_1_edar_alkes_import.urut_no_tt,
		subdit.subdit,
		tt_1_edar_alkes_import.date_insert,
		pendaftar_edar_alkes_import.nama_pabrik,
		pendaftar_edar_alkes_import.alamat_pabrik,
		pendaftar_edar_alkes_import.nama_propinsi_2,
		tt_1_edar_alkes_import.insert_by
		FROM tt_1_edar_alkes_import
		LEFT OUTER JOIN subdit ON(subdit.id_subdit = tt_1_edar_alkes_import.kode_subdit)
		LEFT OUTER JOIN pendaftar_edar_alkes_import ON(pendaftar_edar_alkes_import.kode_pendaftar_edar_alkes_import = tt_1_edar_alkes_import.kode_pendaftar_edar_alkes_import)
		GROUP BY
		tt_1_edar_alkes_import.no_tt,
		tt_1_edar_alkes_import.urut_no_tt,
		subdit.subdit,
		pendaftar_edar_alkes_import.nama_pabrik,
		tt_1_edar_alkes_import.kode_pendaftar_edar_alkes_import,
		pendaftar_edar_alkes_import.alamat_pabrik,
		pendaftar_edar_alkes_import.nama_propinsi_2,
		tt_1_edar_alkes_import.insert_by,
		tt_1_edar_alkes_import.date_insert

		';
		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'no_tt' => FALSE,
			'nama_tt_1_edar_alkes_import' => TRUE,
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
			'\', 600, 400, null, null, \'add_tt_1_edar_alkes_import\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_tt_1_edar_alkes_import\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_tt_1_edar_alkes_import\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_tt_1_edar_alkes_import\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

                $view_anchor = pager::pager_button(array("link"=>'javascript:'.
                        'location.href=\'' . $GLOBALS['PHP_SELF'] .
                        '?action=view%s\''.
                        '',
                        "label"=>__('View'),
                        "image"=>$GLOBALS['path_theme'].'/images/word.gif',
                        "type"=>"link+"));


		$label_arr = $this->tt_1_edar_alkes_import_label;
		$config = array (
			'id'		=> 'tt_1_edar_alkes_import',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $add_anchor,
			'edit_anchor'	=> '<nobr>'.$edit_anchor." ".$view_anchor.'</nobr>',
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Tanda Terima Izin Edar Alkes'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print tt_1_edar_alkes_import
	function print_tt_1_edar_alkes_import() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_tt_1_edar_alkes_import($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$tt_1_edar_alkes_import_controller = new tt_1_edar_alkes_import_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $tt_1_edar_alkes_import_controller->add_tt_1_edar_alkes_import_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $tt_1_edar_alkes_import_controller->add_tt_1_edar_alkes_import();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad();OnChangekode_pendaftar_edar_alkes_import()"';
			$out_content = $tt_1_edar_alkes_import_controller->update_tt_1_edar_alkes_import_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $tt_1_edar_alkes_import_controller->update_tt_1_edar_alkes_import();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $tt_1_edar_alkes_import_controller->delete_tt_1_edar_alkes_import();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $tt_1_edar_alkes_import_controller->import_tt_1_edar_alkes_import_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $tt_1_edar_alkes_import_controller->import_tt_1_edar_alkes_import();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $tt_1_edar_alkes_import_controller->print_tt_1_edar_alkes_import();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
                case 'view':
                        $out_extra_body =  'onLoad="DocumentLoad()"';
                        $out_content = $tt_1_edar_alkes_import_controller->view_tt_1_edar_form();
                        $out_content .= $back_to_menu;
                        echo $out_content;
                        exit;
                        break;
		case 'find':
		default:
			$out_content = $tt_1_edar_alkes_import_controller->list_tt_1_edar_alkes_import();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Tanda Terima Izin Edar Alkes Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

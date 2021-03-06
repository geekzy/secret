<?php


	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('tt_controller')) {
	// do nothing
} else if (defined('CLASS_tt_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_tt_CONTROLLER', TRUE);

#include_once 'class.tt.inc.php';
class tt_controller extends depkes2_manager {
	var $tt_label;
	var $optional_arr;
	function tt_controller() {
		$this->tt_label = array (
			'urut_no_tt' => 'No Tanda Terima',
			'subdit' => 'Subdit',
			'kode_subdit' => 'Kode Subdit',
			'nama_pabrik' => 'Nama Pabrik',
 			'nama_pendaftar' => 'Nama Pemohon',
 			'kode_pendaftar' => 'Nama Pabrik / Nama Pemohon',
			'jenis_izin_produksi' => 'Jenis Izin Produksi',
			'alamat_pabrik' => 'Alamat pabrik',
			'nama_propinsi_2' => 'Nama propinsi',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'no_tt' => FALSE,
			'kode_subdit' => FALSE,
 			'kode_pendaftar' => FALSE,
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
				svalue
			';
		$result = subdit::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('kode_subdit');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->tt_label['kode_subdit']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['kode_subdit'] = 'user_defined';
		$value_arr['kode_subdit'] = $this->select_form('kode_subdit', $result, $selected);
		$optional_arr['kode_subdit_rule'] = "\n".
		"       if(theform.kode_subdit.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['kode_subdit']." ".__('empty').".');\n".
		"               theform.kode_subdit.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";


	}

	function pendaftar_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['kode_pendaftar'];

		#include_once 'class.pendaftar.inc.php';
		if ($_GET['action'] == 'add') {
			$fk_sql = ''.
			'SELECT
				kode_pendaftar as skey,
				nama_pendaftar as svalue,
				nama_pabrik as svalue2
			FROM
				'.$GLOBALS[my_pendaftar].'
				LEFT JOIN '.$GLOBALS['my_table'].' USING (kode_pendaftar)
			WHERE
				'.$GLOBALS['my_table'].'.kode_pendaftar IS NULL
			ORDER BY
				svalue
			';
		} else {
			$fk_sql = ''.
			'SELECT
				kode_pendaftar as skey,
				nama_pendaftar as svalue,
				nama_pabrik as svalue2
			FROM
				'.$GLOBALS[my_pendaftar].'
			WHERE kode_pendaftar = \''.$selected.'\'
			ORDER BY
				svalue
			';
		}
		#$result = pendaftar::select($fk_sql);
		global $adodb;$rs = $adodb->Execute($fk_sql);
		$result = $rs->GetRows();
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('kode_pendaftar');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->tt_label['kode_pendaftar']
			)
		);
		
		

  $jas ="
		b = document.theform.kode_pendaftar.value;
		sql = 'SELECT alamat_pendaftar as alamat,nama_propinsi_1 as propinsi FROM ".$GLOBALS[my_pendaftar]."  WHERE kode_pendaftar=\''+ b +'\'';

		jumpto1('frame_tt.php?sql='+sql+'&a='+b)

		";

	$GLOBALS['out_before_footer'] = '
 	<iframe marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=auto name=\'iframe_entry1\' id=\'iframe_entry1\' style="width:0;height:0" src="frame_tt.php"></iframe>
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
		$optional_arr['kode_pendaftar'] = 'user_defined';
		$value_arr['kode_pendaftar'] = $this->select_form('kode_pendaftar', $result, $selected,$multiple=FALSE,$jas);
		$optional_arr['kode_pendaftar_rule'] = "\n".
		"       if(theform.kode_pendaftar.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['kode_pendaftar']." ".__('empty').".');\n".
		"               theform.kode_pendaftar.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";




	}


	// create add tt form
	function add_tt_form() {
		include_once 'class.xform.inc.php';
		//if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->tt_label;
		$optional_arr = $this->optional_arr;

		if($_GET['no_tt']){$field_arr[] = xform::xf('urut_no_tt','C','255');}
		$field_arr[] = xform::xf('kode_subdit','C','255');
		$field_arr[] = xform::xf('kode_pendaftar','C','255');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');

		$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_tt]." WHERE no_tt='{$record['no_tt']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['no_tt'] = 'protect';
			$mode = 'edit';

		} else {
			$value_arr = array ();
			$mode = 'add';
		}

		$optional_arr['nama_tt_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';
		
		global $adodb;
		$rsx = $adodb->Execute("SELECT no_tt FROM ".$GLOBALS[my_tt]." ORDER BY no_tt DESC LIMIT 1");
		$no_ttx = $rsx->fields['no_tt'];
		$no_ttx = $no_ttx +1;
		eval($this->save_config);
		$optional_arr['urut_no_tt'] = 'user_defined';
		$value_arr['urut_no_tt'] = '<input type="text" name="urut_no_tt" value="'.$value_arr['urut_no_tt'].'" readonly class="text">';

		if (eregi('produksi', $GLOBALS[my_title])) {
			$field_arr[] = xform::xf('jenis_izin_produksi','N','8');
			if($value_arr['jenis_izin_produksi']=="0"){$select1 = "selected";$select2 = "";}else{if($value_arr['jenis_izin_produksi']=="1"){$select1 = "";$select2 = "selected";}else{$select1 = "";$select2 = "";}}
			$optional_arr['jenis_izin_produksi'] = 'user_defined';
			$value_arr['jenis_izin_produksi'] = '<select name="jenis_izin_produksi" class="text"><option>- Jenis Izin Produksi -</option><option value="0" '.$select1.'>Izin Produksi Alkes</option><option value="1" '.$select2.'>Izin Produksi PKRT</option></select>';
		}
		$this->subdit_form($config);
		$this->pendaftar_form($config);



		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['no_tt']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Tanda Terima ".$GLOBALS[my_title]."";
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

	// create update tt form
	function update_tt_form() {
		return $this->add_tt_form();
	}
	

	function view_tt_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		#$field_arr = tt::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['no_tt'] = 'protect';

		$record = array (
			'no_tt' => ${$GLOBALS['get_vars']}['no_tt']
		);
		#$result = tt::get($record);
		$value_arr = $result[0];
		$label_arr = $this->tt_label;
		global $adodb;

		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('L','mm','A5');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',14);
		//$pdf->image("../depkes2/actor/depkes2/baner_depkes.jpg",10,10,180,40);
		$pdf->setxy(10,52);
		$pdf->Cell(180,7,'SURAT  TANDA  TERIMA '.strtoupper($GLOBALS[my_title]).'','',0,'L');
		$pdf->Ln(6);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,'DIREKTORAT BINA PRODUKSI DAN DISTRIBUSI ALAT KESEHATAN','',0,'L');
		$pdf->Ln(6);
		$pdf->Cell(180,7,'DIREKTORAT JENDERAL PELAYANAN KEFARMASIAN DAN ALAT KESEHATAN','',0,'L');
		$pdf->Ln(6);
		$pdf->Cell(180,7,'DEPARTEMEN KESEHATAN RI','',0,'L');
		$pdf->Ln(3);
		/*$pdf->Cell(180,7,'Tanda Terima Permohonan '.$GLOBALS[my_title].'','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(180,7,'( Berdasarkan subdit yang dipilih pada tanda terima )','',0,'L');
		$pdf->Ln(5);
		*/
		$pdf->Cell(180,3,'','B',0,'L');
		$pdf->SetFont('Arial','',12);

		$sql = "SELECT
		tt.no_tt,
		tt.urut_no_tt,
		subdit.subdit,
		tt.date_insert,
		pendaftar.nama_pabrik,
		pendaftar.nama_propinsi_1,
		pendaftar.nama_pendaftar,
		pendaftar.alamat_pendaftar,
		pendaftar.alamat_pabrik,
		pendaftar.nama_propinsi_2,
		pendaftar.userid,
		pendaftar.tpwd,
		tt.insert_by
		FROM ".$GLOBALS[my_tt]." as tt
		LEFT OUTER JOIN subdit ON(subdit.id_subdit = tt.kode_subdit)
		LEFT OUTER JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON(pendaftar.kode_pendaftar = tt.kode_pendaftar)
		WHERE
		tt.no_tt ='".$_GET['no_tt']."'
		";
		/*GROUP BY
		tt.no_tt,
		tt.urut_no_tt,
		subdit.subdit,
		tt.date_insert,
		pendaftar.nama_pabrik,
		pendaftar.nama_pendaftar,
		pendaftar.alamat_pendaftar,
		pendaftar.alamat_pabrik,
		pendaftar.nama_propinsi_2,
		pendaftar.userid,
		pendaftar.tpwd,
		tt.insert_by
		";
		*/
		//print $sql;
		$rs = $adodb->Execute($sql);
		$urut_no_tt = $rs->fields['urut_no_tt'];
		$nama_pendaftar = $rs->fields['nama_pendaftar'];
		$alamat_pendaftar = $rs->fields['alamat_pendaftar'];
		$nama_propinsi_1 = $rs->fields['nama_propinsi_1'];
		$nama_pabrik = $rs->fields['nama_pabrik'];
		$userid = $rs->fields['userid'];
		$pwd = $rs->fields['tpwd'];
		$pdf->Ln(5);
		$pdf->Cell(35,7,'No Tanda Terima','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$urut_no_tt.'','',0,'L');
		$pdf->Ln(7);
		$pdf->Cell(35,7,'Nama Pemohon','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$nama_pendaftar.'','',0,'L');
		$adres = "$alamat_pendaftar, $nama_propinsi_1";
		if(strlen($adres)>67)
			{
				$sk=substr($adres, 0, -(strlen($adres)-67));
				$posisi=strrpos($sk," ");
				$sk=substr($adres, 0, -(strlen($adres)-$posisi));
				$adres=substr($adres, $posisi);
				$pdf->Ln(7);
				$pdf->Cell(35,7,'Alamat Pemohon','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,"$sk",'',0,'L');
				$pdf->Ln(7);
				$pdf->Cell(35,7,'','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,"$adres",'',0,'L');
			}
		else
			{
				$pdf->Ln(7);
				$pdf->Cell(35,7,'Alamat Pemohon','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$adres.'','',0,'L');
			}
		$pdf->Ln(7);
		$pdf->Cell(35,7,'Nama Pabrik','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$nama_pabrik.'','',0,'L');
		$pdf->Ln(7);
		$pdf->Cell(35,7,'User ID','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$userid.'','',0,'L');
		$pdf->Ln(7);
		$pdf->Cell(35,7,'Password','',0,'L');$pdf->Cell(10,7,' : ','',0,'L');$pdf->Cell(140,7,''.$pwd.'','',0,'L');
		//$pdf->Ln(10);
		$pdf->Output();

	}
	// handle event add tt
	function add_tt() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);

		if (empty($_POST[urut_no_tt])) {
			$rsx = $adodb->Execute("SELECT urut_no_tt, date_insert FROM ".$GLOBALS[my_table]." ORDER by no_tt DESC LIMIT 1");
			$tahun_data = date('Y',$rsx->fields['date_insert']);
			$tahun_now = date('Y');
			if($rsx->fields['urut_no_tt'] == ''){
				$urut_no_tt = 1;
			} else {
				if($tahun_data == $tahun_now){
					$urut_no_tt = $rsx->fields['urut_no_tt'] + 1;
				} else {
					$urut_no_tt = 1;
				}
			}

			$lastno = $rsx->fields['urut_no_tt'];
			$lastno = $lastno[2].$lastno[3].$lastno[4].$lastno[5].$lastno[6];
			$lastno = intval($lastno);
			$lastno = $lastno + 1;
		} else {
			$lastno = $_POST['urut_no_tt'];
			$lastno = $lastno[2].$lastno[3].$lastno[4].$lastno[5].$lastno[6];
			$lastno = intval($lastno);
		}

		$sqly = "SELECT subdit FROM subdit WHERE id_subdit = '".$_POST['kode_subdit']."'";
		$rsy = $adodb->Execute($sqly);
		$subdit = $rsy->fields['subdit'];

		$a = date('d-m/Y');
		$no = sprintf("%05s", $lastno);
		#$no = str_pad($lastno, 5, "0", STR_PAD_LEFT);
		$urut_no_tt = $subdit."/".$no."/".$a;
  		$record['urut_no_tt'] = $urut_no_tt;

#$adodb->debug = 1;
		$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_tt]." WHERE no_tt = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$record['insert_by'] = $ses->loginid;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_tt]." WHERE no_tt = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}


		//print_r($st);exit();
		$status = "Successfull $st Tanda Terima ".$GLOBALS[my_title]." '<b>{$record['urut_no_tt']}</b>'";
		$this->log($status);

		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return ( $_block->get_str() );
	}

	// handle event update tt
	function update_tt() {
		return $this->add_tt();
	}

	// handle delete tt
	function delete_tt() {
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
		if ($query) {
                        $rs = $adodb->Execute("SELECT urut_no_tt FROM ".$GLOBALS[my_table]." WHERE $query");
                        while (!$rs->EOF) {
                                if ($msg) $msg .= ", ";
                                $msg .= "'".$rs->fields[urut_no_tt]."'";
                                $rs->MoveNext();
                        }
                        $success = $adodb->Execute("delete from ".$GLOBALS[my_tt]." where ".$query);
		}

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'Tanda Terima '.$GLOBALS[my_title].' <font color=red>'.$msg.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'Tanda Terima '.$GLOBALS[my_title].' <font color=red>'.$msg.'</font>';
                }
                $this->log($status);

                $_block = new block();
                $_block->set_config('title', ('Delete Tanda Terima '.$GLOBALS[my_title].' Status'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list tt
	function list_tt($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = "SELECT
		tt.no_tt,
		tt.urut_no_tt,
		subdit.subdit,
		[produksi]
		tt.date_insert,
		pendaftar.nama_pendaftar,
		pendaftar.nama_pabrik,
		pendaftar.alamat_pabrik,
		pendaftar.nama_propinsi_2,
		tt.insert_by
		FROM ".$GLOBALS[my_tt]." tt
		LEFT OUTER JOIN subdit ON(subdit.id_subdit = tt.kode_subdit)
		LEFT OUTER JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON(pendaftar.kode_pendaftar = tt.kode_pendaftar)
		ORDER BY tt.urut_no_tt DESC
		";
		/*GROUP BY
		tt.no_tt,
		tt.urut_no_tt,
		subdit.subdit,
		pendaftar.nama_pabrik,
		tt.kode_pendaftar,
		pendaftar.alamat_pabrik,
		pendaftar.nama_propinsi_2,
		tt.insert_by,
		tt.date_insert
		";
		*/
		if (eregi('produksi', $GLOBALS[my_title])) {
			$sql = str_replace('[produksi]', "CASE WHEN tt.jenis_izin_produksi='0' THEN 'Izin Produksi Alkes' ".
			" ELSE 'Izin Produksi PKRT' END as jenis_izin_produksi, ", $sql);
		} else {
			$sql = str_replace('[produksi]', "", $sql);
		}
		#tt.jenis_izin_produksi,

		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'no_tt' => FALSE,
			'nama_tt' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE,
			'alamat_pabrik' => FALSE,
			'nama_propinsi_2' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'no_tt' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 600, 400, null, null, \'add_tt\');'.
			'win.focus()',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_tt\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_tt\')'.
			'win.focus()):' .
			'alert(\''.__('Cancelling Delete').'\');',
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_tt\');'.
			'win.focus()',
			"label"=>__('Print'),
			"type"=>"button",
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		#$view_anchor = pager::pager_button(array("link"=>'javascript:'.
		#	'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
		$view_anchor = pager::pager_button(array("link"=>''.
			'location.href=\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\';',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"button"));

		$label_arr = $this->tt_label;
		$config = array (
			'id'		=> 'tt',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $add_anchor,
			'edit_anchor'	=> "<nobr>".$edit_anchor." ".$view_anchor."</nobr>",
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Tanda Terima '.$GLOBALS[my_title].' '.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print tt
	function print_tt() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_tt($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$tt_controller = new tt_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $tt_controller->add_tt_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $tt_controller->add_tt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad();OnChangekode_pendaftar()"';
			$out_content = $tt_controller->update_tt_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $tt_controller->update_tt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $tt_controller->delete_tt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $tt_controller->import_tt_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $tt_controller->import_tt();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $tt_controller->view_tt_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'print':
			$out_content = $tt_controller->print_tt();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $tt_controller->list_tt();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Tanda Terima '.$GLOBALS[my_title].' Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

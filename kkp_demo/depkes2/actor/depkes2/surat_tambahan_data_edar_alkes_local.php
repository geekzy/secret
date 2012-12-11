<?php



	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('surat_tambahan_edar_alkes_local_controller')) {
	// do nothing
} else if (defined('CLASS_surat_tambahan_edar_alkes_local_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_surat_tambahan_edar_alkes_local_CONTROLLER', TRUE);

include_once 'class.surat_tambahan_edar_alkes_local.inc.php';
class surat_tambahan_edar_alkes_local_controller extends depkes2_manager {
	var $surat_tambahan_edar_alkes_local_label;
	var $optional_arr;
	function surat_tambahan_edar_alkes_local_controller() {
		$this->surat_tambahan_edar_alkes_local_label = array (
			'id_surat_tambahan_edar_alkes_local' => 'Id Surat Tambahan Data Edar Alkes local',
			'nomor_menteri' => 'NOMOR',
			'tanggal_menteri' => 'TANGGAL',
			'nomor_surat' => 'Nomor',
			'lampiran_surat' => 'Lampiran',
			'alamat_pabrik' => 'Alamat Pabrik',
			'date_surat' => 'Tanggal Surat',
			'kepada_surat' => 'Kepada Yth',
			'alat' => 'Alat',
			'di_surat' => 'di',
			'header' => 'Header',
			'isi_1' => '1.',
			'nama_pabrik' => 'Nama Pabrik',
			'isi_2' => '2.',
			'isi_3' => '3.',
			'isi_4' => '4.',
			'isi_5' => '5.',
			'footer' => 'Footer',
			'nama' => 'Nama Pengesah',
			'nip' => 'NIP Pengesah.',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_surat_tambahan_edar_alkes_local' => FALSE,
			'passwd' => FALSE,
			'name' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	// create add surat_tambahan_edar_alkes_local form
	function add_surat_tambahan_edar_alkes_local_form() {
		include_once 'class.xform.inc.php';

//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->surat_tambahan_edar_alkes_local_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('nomor_surat','C','255');
		$field_arr[] = xform::xf('lampiran_surat','C','255');
		$field_arr[] = xform::xf('date_surat','C','255');
//		if (! $this->get_permission('fill_this')) return $this->intruder();

		$field_arr[] = xform::xf('kepada_surat','C','255');
		$field_arr[] = xform::xf('alat','C','255');
		$field_arr[] = xform::xf('isi_1','C','255');
		$field_arr[] = xform::xf('isi_2','C','255');
		$field_arr[] = xform::xf('isi_3','C','255');
		$field_arr[] = xform::xf('isi_4','C','255');
		$field_arr[] = xform::xf('isi_5','C','255');
		$field_arr[] = xform::xf('nama','C','255');
		$field_arr[] = xform::xf('nip','C','255');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');



		$rs = $adodb->Execute("SELECT * FROM surat_tambahan_edar_alkes_local WHERE id_surat_tambahan_edar_alkes_local='{$record['id_surat_tambahan_edar_alkes_local']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_surat_tambahan_edar_alkes_local'] = 'protect';
			$mode = 'edit';
			$optional_arr['passwd_rule'] = '';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}
		$optional_arr['name_rule'] = '';
		$optional_arr['nomor_surat_rule'] = '';
		$optional_arr['lampiran_surat_rule'] = '';
		$optional_arr['date_surat_rule'] = '';
		$optional_arr['kepada_surat_rule'] = '';
		$optional_arr['alat_rule'] = '';
		$optional_arr['di_surat_rule'] = '';
		$optional_arr['header_rule'] = '';
		$optional_arr['isi_1_rule'] = '';
		$optional_arr['isi_2_rule'] = 'adi';
		$optional_arr['isi_3_rule'] = '';
		$optional_arr['isi_4_rule'] = '';
		$optional_arr['isi_5_rule'] = '';
		$optional_arr['footer_rule'] = '';
		$optional_arr['nama_rule'] = '';
		$optional_arr['nip_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';

		eval($this->save_config);

		$optional_arr['kepada_surat'] = 'user_defined';
                $arr = array();
                $arr['name'] = 'kepada_surat';
                $arr['selected'] = $value_arr['kepada_surat'];
                $arr['sql'] = 'SELECT
				cek_kelengkapan_data_edar_local.id_cek_1 as val,
    				pendaftar_edar_alkes_local.nama_pabrik as txt
			FROM
				cek_kelengkapan_data_edar_local
			LEFT OUTER JOIN surat_tambahan_edar_alkes_local ON(surat_tambahan_edar_alkes_local.kepada_surat = cek_kelengkapan_data_edar_local.id_cek_1)
			LEFT OUTER JOIN tt_1_edar_alkes_local ON(tt_1_edar_alkes_local.no_tt = cek_kelengkapan_data_edar_local.no_tt)
			LEFT OUTER JOIN pendaftar_edar_alkes_local ON(pendaftar_edar_alkes_local.kode_pendaftar_edar_alkes_local = tt_1_edar_alkes_local.kode_pendaftar_edar_alkes_local)
			ORDER BY
			cek_kelengkapan_data_edar_local.date_insert
		';
                $value_arr['kepada_surat'] = xform::dbs($arr);
		
		$optional_arr['isi_1'] = 'user_defined';
		$value_arr['isi_1'] = '<input type="text" size="80" name="isi_1" class="text" value="'.$value_arr['isi_1'].'">';
		$optional_arr['isi_2'] = 'user_defined';
		$value_arr['isi_2'] = '<input type="text" size="80" name="isi_2" class="text" value="'.$value_arr['isi_2'].'">';
		$optional_arr['isi_3'] = 'user_defined';
		$value_arr['isi_3'] = '<input type="text" size="80" name="isi_3" class="text" value="'.$value_arr['isi_3'].'">';
		$optional_arr['isi_4'] = 'user_defined';
		$value_arr['isi_4'] = '<input type="text" size="80" name="isi_4" class="text" value="'.$value_arr['isi_4'].'">';
		$optional_arr['isi_5'] = 'user_defined';
		$value_arr['isi_5'] = '<input type="text" size="80" name="isi_5" class="text" value="'.$value_arr['isi_5'].'">';

		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_surat_tambahan_edar_alkes_local']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Surat Tambahan Data Edar Alkes Lokal";
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


	// create update surat_tambahan_edar_alkes_local form
	function update_surat_tambahan_edar_alkes_local_form() {
		return $this->add_surat_tambahan_edar_alkes_local_form();
	}

	
	function view_surat_tambahan_edar_alkes_local_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		$field_arr = surat_tambahan_edar_alkes_local::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_surat_tambahan_edar_alkes_local'] = 'protect';

		$record = array (
			'id_surat_tambahan_edar_alkes_local' => ${$GLOBALS['get_vars']}['id_surat_tambahan_edar_alkes_local']
		);
		$result = surat_tambahan_edar_alkes_local::get($record);
		$value_arr = $result[0];
		$label_arr = $this->surat_tambahan_edar_alkes_local_label;
		global $adodb;
		
		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','A4');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(180,7,'LAMPIRAN I','T',0,'R');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'LAMPIRAN PERATURAN MENTERI KESEHATAN RI','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'NOMOR','',0,'L');$pdf->cell(100,7,' : 140/MENKES/PER/III/1991','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'TANGGAL','',0,'L');$pdf->Cell(100,7,' : 4 MARET 1991','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(180,7,'','B',0,'C');
		$pdf->Ln(10);
		$sqlx = "
		SELECT
		surat_tambahan_edar_alkes_local.nomor_surat,
		surat_tambahan_edar_alkes_local.lampiran_surat,
		surat_tambahan_edar_alkes_local.date_surat,
		pendaftar_edar_alkes_local.nama_pabrik,
		pendaftar_edar_alkes_local.alamat_pabrik,
		surat_tambahan_edar_alkes_local.alat,
		surat_tambahan_edar_alkes_local.isi_1,
		surat_tambahan_edar_alkes_local.isi_2,
		surat_tambahan_edar_alkes_local.isi_3,
		surat_tambahan_edar_alkes_local.isi_4,
		surat_tambahan_edar_alkes_local.isi_5,
		surat_tambahan_edar_alkes_local.nama,
		surat_tambahan_edar_alkes_local.nip,
		surat_tambahan_edar_alkes_local.insert_by,
		surat_tambahan_edar_alkes_local.date_insert
		FROM surat_tambahan_edar_alkes_local
		LEFT OUTER JOIN cek_kelengkapan_data_edar_local ON(cek_kelengkapan_data_edar_local.id_cek_1 = surat_tambahan_edar_alkes_local.kepada_surat)
		LEFT OUTER JOIN tt_1_edar_alkes_local ON (tt_1_edar_alkes_local.no_tt = cek_kelengkapan_data_edar_local.no_tt)
		LEFT OUTER JOIN pendaftar_edar_alkes_local ON( pendaftar_edar_alkes_local.kode_pendaftar_edar_alkes_local= tt_1_edar_alkes_local.kode_pendaftar_edar_alkes_local)
		WHERE
		surat_tambahan_edar_alkes_local.id_surat_tambahan_edar_alkes_local ='".$value_arr['id_surat_tambahan_edar_alkes_local']."'
		";

		$rsx = $adodb->Execute($sqlx);
		$nomor_surat = $rsx->fields['nomor_surat'];
		$lampiran_surat = $rsx->fields['lampiran_surat'];
		$date_surat = $rsx->fields['date_surat'];
		$nama_pabrik = $rsx->fields['nama_pabrik'];
		$alamat_pabrik = $rsx->fields['alamat_pabrik'];
		if($rsx->fields['alat']==''){$alat = '...................';}else{ $alat=$rsx->fields['alat'];}
		$isi_1 = $rsx->fields['isi_1'];
		$isi_2 = $rsx->fields['isi_2'];
		$isi_3 = $rsx->fields['isi_3'];
		$isi_4 = $rsx->fields['isi_4'];
		$isi_5 = $rsx->fields['isi_5'];
		$nama = $rsx->fields['nama'];
		$nip = $rsx->fields['nip'];

		$pdf->Cell(30,7,'Nomor','',0,'L');$pdf->Cell(100,7,' : '.$nomor_surat.'','',0,'L');$pdf->Cell(40,7,'Jakarta, '.date('d M Y',$date_surat).'','',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'Lampiran','',0,'L');$pdf->Cell(100,7,' : '.$lampiran_surat.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'Perihal','',0,'L');$pdf->Cell(100,7,' : Permintaan tambahan data','',0,'L'); $pdf->Cell(40,7,'Kepada Yth,','',0,'L');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(130,7,'','',0,'L');$pdf->Cell(40,7,''.$nama_pabrik.'','',0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(5);
		$pdf->Cell(130,7,'','',0,'L');$pdf->Cell(40,7,'di','',0,'L');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(130,7,'','',0,'L');$pdf->Cell(40,7,''.$alamat_pabrik.'','',0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(20);
		$pdf->Cell(180,7,'     Sehubungan dengan pendaftaran alat kesehatan/ Kosmetik/ perbekalan  kesehatan   rumah','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'tangga *, '.$alat.'  dengan   ini   kami   beritahukan   bahwa  masih diperlukan tambahan ','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'data sebagai berikut :',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'1. '.$isi_1.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'2. '.$isi_2.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'3. '.$isi_3.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'4. '.$isi_4.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'5. '.$isi_5.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'        Sesuai dengan Peraturan  Menteri  Kesehatan   Nomor  140/Menkes/Per/III/1991  tentang ','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'Wajib Daftar Alat Kesehatan, Kosmetik dan Perbekalan Kesehatan Rumah Tangga, tambahan','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'data tersebut harus sudah diserahkan  kepada kami selambat - lambatnya 3 (tiga) bulan  sejak',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'tanggal surat ini .',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'        Demikian agar maklum','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'Direktur Jenderal Pengawasan','',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'Obat dan Makanan','',0,'C');
		$pdf->Ln(20);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'( '.$nama.' )','B',0,'C');
		$pdf->Ln(10);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'NIP. '.$nip.'','',0,'C');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'* Coret yang tidak perlu','B',0,'L');


		$pdf->Output();


	}

	// handle event add surat_tambahan_edar_alkes_local
	function add_surat_tambahan_edar_alkes_local() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;

		$rs = $adodb->Execute("SELECT * FROM surat_tambahan_edar_alkes_local WHERE id_surat_tambahan_edar_alkes_local = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$record['date_surat'] = $this->parsedate(trim($_POST['date_surat']));
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$record['date_surat'] = $this->parsedate(trim($_POST['date_surat']));
			$record['insert_by'] = $ses->loginid;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM surat_tambahan_edar_alkes_local WHERE id_surat_tambahan_edar_alkes_local = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st '<b>{$record['id_surat_tambahan_edar_alkes_local']}</b>'";
		$this->log($status);
		$_block = new block();
		$_block->set_config('title', 'Status Surat Tambahan Data Edar Alkes Lokal');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}


	// handle event update surat_tambahan_edar_alkes_local
	function update_surat_tambahan_edar_alkes_local() {
		return $this->add_surat_tambahan_edar_alkes_local();
	}

	// handle delete surat_tambahan_edar_alkes_local
	function delete_surat_tambahan_edar_alkes_local() {
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
                        $success = $adodb->Execute("delete from surat_tambahan_edar_alkes_local where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'surat_tambahan_edar_alkes_local <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'surat_tambahan_edar_alkes_local <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Surat Tambahan Data Edar Alkes Lokal'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list surat_tambahan_edar_alkes_local
	function list_surat_tambahan_edar_alkes_local($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'SELECT
		surat_tambahan_edar_alkes_local.id_surat_tambahan_edar_alkes_local,
		surat_tambahan_edar_alkes_local.nomor_surat,
		surat_tambahan_edar_alkes_local.lampiran_surat,
		surat_tambahan_edar_alkes_local.date_surat,
		pendaftar_edar_alkes_local.nama_pabrik,
		pendaftar_edar_alkes_local.alamat_pabrik,
		surat_tambahan_edar_alkes_local.alat,
		surat_tambahan_edar_alkes_local.isi_1,
		surat_tambahan_edar_alkes_local.isi_2,
		surat_tambahan_edar_alkes_local.isi_3,
		surat_tambahan_edar_alkes_local.isi_4,
		surat_tambahan_edar_alkes_local.isi_5,
		surat_tambahan_edar_alkes_local.nama,
		surat_tambahan_edar_alkes_local.nip,
		surat_tambahan_edar_alkes_local.insert_by,
		surat_tambahan_edar_alkes_local.date_insert
		FROM surat_tambahan_edar_alkes_local
		LEFT OUTER JOIN cek_kelengkapan_data_edar_local ON(cek_kelengkapan_data_edar_local.id_cek_1 = surat_tambahan_edar_alkes_local.kepada_surat)
		LEFT OUTER JOIN tt_1_edar_alkes_local ON (tt_1_edar_alkes_local.no_tt = cek_kelengkapan_data_edar_local.no_tt)
		LEFT OUTER JOIN pendaftar_edar_alkes_local ON( pendaftar_edar_alkes_local.kode_pendaftar_edar_alkes_local= tt_1_edar_alkes_local.kode_pendaftar_edar_alkes_local)
		';

		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_surat_tambahan_edar_alkes_local' => FALSE,
			'passwd' => TRUE,
			'name' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'id_surat_tambahan_edar_alkes_local' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 600, 400, null, null, \'add_surat_tambahan_edar_alkes_local\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_surat_tambahan_edar_alkes_local\');'.
			'win.focus()', 
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));
//
		$view_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\', 640, 480, null, null, \'view_skk\');'.
			'win.focus()',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"link+"));
//		}
//		if ($this->get_permission('fill_this')) {
			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' . 
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_surat_tambahan_edar_alkes_local\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_surat_tambahan_edar_alkes_local\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->surat_tambahan_edar_alkes_local_label;
		$config = array (
			'id'		=> 'surat_tambahan_edar_alkes_local',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $add_anchor,
			'edit_anchor'	=> "<nobr>".$edit_anchor."|".$view_anchor,
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Surat Tambahan Data Edar Alkes Lokal'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print surat_tambahan_edar_alkes_local
	function print_surat_tambahan_edar_alkes_local() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_surat_tambahan_edar_alkes_local($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$surat_tambahan_edar_alkes_local_controller = new surat_tambahan_edar_alkes_local_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_tambahan_edar_alkes_local_controller->add_surat_tambahan_edar_alkes_local_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $surat_tambahan_edar_alkes_local_controller->add_surat_tambahan_edar_alkes_local();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_tambahan_edar_alkes_local_controller->update_surat_tambahan_edar_alkes_local_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $surat_tambahan_edar_alkes_local_controller->update_surat_tambahan_edar_alkes_local();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $surat_tambahan_edar_alkes_local_controller->view_surat_tambahan_edar_alkes_local_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $surat_tambahan_edar_alkes_local_controller->delete_surat_tambahan_edar_alkes_local();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'local':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_tambahan_edar_alkes_local_controller->local_surat_tambahan_edar_alkes_local_form();
			$out_content .= $back_to_menu;
			break;
		case 'postlocal':
			$out_content = $surat_tambahan_edar_alkes_local_controller->local_surat_tambahan_edar_alkes_local();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $surat_tambahan_edar_alkes_local_controller->print_surat_tambahan_edar_alkes_local();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $surat_tambahan_edar_alkes_local_controller->list_surat_tambahan_edar_alkes_local();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Surat Tambahan Data Edar Alkes Lokal Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

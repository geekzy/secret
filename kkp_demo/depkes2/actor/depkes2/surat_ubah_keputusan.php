<?php


	require 'init.php';
	require 'auth.php';

if (class_exists('surat_ubah_keputusan_controller')) {
	// do nothing
} else if (defined('CLASS_surat_ubah_keputusan_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_surat_ubah_keputusan_CONTROLLER', TRUE);

include_once 'class.surat_ubah_keputusan.inc.php';
class surat_ubah_keputusan_controller extends depkes2_manager {
	var $surat_ubah_keputusan_label;
	var $optional_arr;
	function surat_ubah_keputusan_controller() {
		$this->surat_ubah_keputusan_label = array (
			'id_surat_ubah_keputusan' => 'Id Surat Keputusan',
			'no_surat_ubah_keputusan' => 'Nomor Surat Keputusan',
			'id_cek_2' => 'Nama Pabrik',
			'nama' => 'Pengesah',
			'nip' => 'NIP pengesah',
			'nama_pabrik' => 'Nama Pabrik',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_surat_ubah_keputusan' => TRUE,
			'surat_ubah_keputusan' => FALSE,
			'keputusan' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}

	
 function id_cek_2_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['id_cek_2'];

		include_once 'class.cek_2_alkes.inc.php';
		if($_GET['action']=='edit'){
		$fk_sql = ''.
			'SELECT
				cek_2_alkes.id_cek_2 as skey,
				tt_2_alkes.urut_no_tt as svalue,
				pendaftar.nama_pabrik as svalue2
			FROM
				cek_2_alkes
			LEFT OUTER JOIN tt_2_alkes ON(tt_2_alkes.no_tt = cek_2_alkes.no_tt)
			LEFT OUTER JOIN pemohon_ubah_ijin_produksi ON(pemohon_ubah_ijin_produksi.kode_pemohon_ubah_ijin_produksi = tt_2_alkes.kode_pendaftar)
			LEFT OUTER JOIN surat_keputusan ON(surat_keputusan.no_surat_keputusan = pemohon_ubah_ijin_produksi.no_surat_keputusan )
			LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
			LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
			LEFT OUTER JOIN surat_ubah_penolakan ON( surat_ubah_penolakan.id_cek_2 = cek_2_alkes.id_cek_2)
			WHERE
			surat_ubah_penolakan.id_cek_2 IS NULL AND
			(cek_2_alkes.status_kasubdit = \'0\' OR	cek_2_alkes.status_direktur = \'0\')
			ORDER BY
				cek_2_alkes.date_insert
			';
		}else{
			$fk_sql = ''.
			'SELECT
				cek_2_alkes.id_cek_2 as skey,
				tt_2_alkes.urut_no_tt as svalue,
				pendaftar.nama_pabrik as svalue2
			FROM
				cek_2_alkes
			LEFT OUTER JOIN tt_2_alkes ON(tt_2_alkes.no_tt = cek_2_alkes.no_tt)
			LEFT OUTER JOIN pemohon_ubah_ijin_produksi ON(pemohon_ubah_ijin_produksi.kode_pemohon_ubah_ijin_produksi = tt_2_alkes.kode_pendaftar)
			LEFT OUTER JOIN surat_keputusan ON(surat_keputusan.no_surat_keputusan = pemohon_ubah_ijin_produksi.no_surat_keputusan )
			LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
			LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
			LEFT OUTER JOIN surat_ubah_penolakan ON( surat_ubah_penolakan.id_cek_2 = cek_2_alkes.id_cek_2)
			LEFT OUTER JOIN surat_ubah_keputusan ON(surat_ubah_keputusan.id_cek_2 = cek_2_alkes.id_cek_2)
			WHERE
			(surat_ubah_penolakan.id_cek_2 IS NULL AND surat_ubah_keputusan.id_cek_2 IS NULL) AND
			(cek_2_alkes.status_kasubdit = \'0\' OR	cek_2_alkes.status_direktur = \'0\')
			ORDER BY
				cek_2_alkes.date_insert
			';
		}
		$result = cek_2_alkes::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('id_cek_2');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('No Tanda Terima - ').' '.$this->surat_ubah_keputusan_label['id_cek_2']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['id_cek_2'] = 'user_defined';
		$value_arr['id_cek_2'] = $this->select_form('id_cek_2', $result, $selected);
		$optional_arr['id_cek_2_rule'] = "\n".
		"       if(theform.id_cek_2.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['id_cek_2']." ".__('empty').".');\n".
		"               theform.id_cek_2.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";


	}


	// create add surat_ubah_keputusan form
	function add_surat_ubah_keputusan_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		$field_arr = surat_ubah_keputusan::get_field_set();

//		$value_arr = array ();
		$label_arr = $this->surat_ubah_keputusan_label;
		$optional_arr = $this->optional_arr;
		$optional_arr['keputusan'] = 'user_defined';
		$value_arr['keputusan']= '<textarea rows="100" cols="75" name="keputusan" class="text"></textarea>';

		eval($this->save_config);
		$this->id_cek_2_form($config);

//		$label_arr['submit_val'] = 'Submit';
		$label_arr['form_extra'] = '<input type=hidden name=action value="postadd">'; // default null
		$label_arr['form_extra'] .= '<input type=hidden name=opener value="'.$GLOBALS[$GLOBALS['get_vars']]['opener'].'">'; // default null
		$label_arr['form_extra'] .= '<input type=hidden name=opener_sql value="'.$GLOBALS[$GLOBALS['get_vars']]['opener_sql'].'">'; // default null
		$label_id_cek_2arr['form_extra'] .= '<input type=hidden name=opener_var value="'.$GLOBALS[$GLOBALS['get_vars']]['opener_var'].'">'; // default null
		$label_arr['form_title'] = __('Form').' '.__('Add').' Surat Keputusan Perubahan Izin Produksi'; // default null
		$label_arr['form_width'] = '100%'; // default 100%
		$label_arr['form_name'] = 'theform'; // default form

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

	// create update surat_ubah_keputusan form
	function update_surat_ubah_keputusan_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		$field_arr = surat_ubah_keputusan::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_surat_ubah_keputusan'] = 'protect';
		$record = array (
			'id_surat_ubah_keputusan' => ${$GLOBALS['get_vars']}['id_surat_ubah_keputusan']
		);
		$result = surat_ubah_keputusan::get($record);
		$value_arr = $result[0];
		$label_arr = $this->surat_ubah_keputusan_label;

		eval($this->save_config);
		$this->id_cek_2_form($config);
		$optional_arr['keputusan'] = 'user_defined';
		$value_arr['keputusan']= '<textarea rows="100" cols="75" name="keputusan" class="text">'.$value_arr['keputusan'].'</textarea>';
//		$label_arr['submit_val'] = 'Submit';
		$label_arr['form_extra'] = '<input type=hidden name=action value=postedit>'; // default null
		$label_arr['form_title'] = ('Update Surat Keputusan Perubahan Izin Produksi Form'); // default null
		$label_arr['form_width'] = '100%'; // default 100%
		$label_arr['form_name'] = 'theform'; // default form

		$_form = new form();    

		$_form->set_config(
			array (
				'field_arr'		=> $field_arr,
				'optional_arr'	=> $optional_arr,
				'value_arr'		=> $value_arr,
				'label_arr'		=> $label_arr
			)
		);
		return $_form->parse_field();
	}

	// create import surat_ubah_keputusan form
	function import_surat_ubah_keputusan_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		$field_arr[] = array ('name' => 'userfile');
		$optional_arr['userfile'] = 'user_defined';
		$value_arr['userfile'] = '<input class=text type=file name=userfile>';

		eval($this->save_config);
		$label_arr['userfile'] = 'Import File';
		$label_arr['submit_val'] = 'Import'; // default Submit
		$label_arr['form_extra'] = '<input type=hidden name=action value=postimport>'; // default null
		$label_arr['form_title'] = ('Import Surat Keputusan Perubahan Izin Produksi Form'); // default null
		$label_arr['form_width'] = '100%'; // default 100%
		$label_arr['form_name'] = 'theform'; // default form

		$_form = new form();
		$_form->set_config(
			array (
				'field_arr'		=> $field_arr,
				'label_arr'		=> $label_arr,
				'value_arr'		=> $value_arr,
				'optional_arr'	=> $optional_arr
			)
		);
		return $_form->parse_field();
	}

	// handle event add surat_ubah_keputusan
	function add_surat_ubah_keputusan() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['post_vars']};
		$record = array (
			'no_surat_ubah_keputusan' => ${$GLOBALS['post_vars']}['no_surat_ubah_keputusan'],
			'id_cek_2' => ${$GLOBALS['post_vars']}['id_cek_2'],
			'nama' => ${$GLOBALS['post_vars']}['nama'],
			'nip' => ${$GLOBALS['post_vars']}['nip'],
			'insert_by' => $GLOBALS['ses']->loginid,
			'date_insert' => time()
		);
		$_block = new block();
		$_block->set_config('title', __('Status').' '.__('Add').' Surat Keputusan Perubahan Izin Produksi');
		$_block->set_config('width', 595);
		if (! surat_ubah_keputusan::get($record)) {
			eval($this->save_config);
			if (surat_ubah_keputusan::add($record)) {


				if ($GLOBALS[$GLOBALS['post_vars']]['opener']) {
					$opener_sql = $GLOBALS[$GLOBALS['post_vars']]['opener_sql'];
					$opener_var = $GLOBALS[$GLOBALS['post_vars']]['opener_var'];
					if (! $record[$opener_var]) {
						if (eregi('postgre', $GLOBALS['adodb_type']))
							$last_id = $GLOBALS['adodb']->Execute(
							"SELECT
								currval('surat_ubah_keputusan_{$opener_var}_seq') AS last_id
							FROM
								surat_ubah_keputusan"
							);
						else if (eregi('mysql', $GLOBALS['adodb_type']))
							$last_id = $GLOBALS['adodb']->Execute(
							'SELECT last_insert_id() AS last_id'
							);
						$record[$opener_var] = $last_id->fields['last_id'];
					}
					$result = $GLOBALS['adodb']->Execute($opener_sql);
					$refresh_add_js = '';
					while (! $result->EOF) {
						$result_text = '';
						if (isset($result->fields['svalue'])) $result_text .= $result->fields['svalue'];
						if (isset($result->fields['svalue2'])) $result_text .= ' - '.$result->fields['svalue2'];
						if (isset($result->fields['svalue3'])) $result_text .= ' - '.$result->fields['svalue3'];
						if (isset($result->fields['svalue4'])) $result_text .= ' - '.$result->fields['svalue4'];
						if (isset($result->fields['svalue5'])) $result_text .= ' - '.$result->fields['svalue5'];
						$refresh_add_js .= "index=window.top.opener.{$opener_var}_add(".
							"'{$result_text}', ".
							"'{$result->fields['skey']}');\n";
						if ($result->fields['skey'] == $record[$opener_var])
							$refresh_add_js .= 'window.top.opener.document.theform.'.
								$opener_var.'.options[index].selected = true;';
						$result->MoveNext();
					}
					$refresh_js = <<< EOT
<script language=javascript>
	var q=window.top.opener.document.theform.{$opener_var}.options.length-1;
	for (;q>=1;q--)
		window.top.opener.document.theform.{$opener_var}.options[q] = null;
{$refresh_add_js}
</script>
EOT;
					$GLOBALS['self_close_js'] = <<< EOT
<script language=javascript>
self.setTimeout('window.top.opener.focus();window.top.close();', 500);
</script>
EOT;
				}

				$_block->parse(array('+<font color=green><b>'.__('Successfull Added').'</b></font>'));
				return $_block->get_str().$refresh_js;
			}
		}
		$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
		$_block->parse(array('+<font color=red><b>'.__('Failed Added').'</b></font>'.' :'.__('Data already exists')));
		return  $_block->get_str();
	}

	// handle event update surat_ubah_keputusan
	function update_surat_ubah_keputusan() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['post_vars']};
		$record = array (
			'id_surat_ubah_keputusan' => ${$GLOBALS['post_vars']}['id_surat_ubah_keputusan']
		);
		$_block = new block();
		$_block->set_config('title', ('Update Surat Keputusan Perubahan Izin Produksi Status'));
		$_block->set_config('width', 595);
		if ($result = surat_ubah_keputusan::get($record)) {
			$record = $result[0];
			if (${$GLOBALS['post_vars']}['surat_ubah_keputusan']!='') $record['surat_ubah_keputusan'] = ${$GLOBALS['post_vars']}['surat_ubah_keputusan'];
			if (${$GLOBALS['post_vars']}['keputusan']!='') $record['keputusan'] = ${$GLOBALS['post_vars']}['keputusan'];
			if (${$GLOBALS['post_vars']}['nama']!='') $record['nama'] = ${$GLOBALS['post_vars']}['nama'];
			if (${$GLOBALS['post_vars']}['nip']!='') $record['nip'] = ${$GLOBALS['post_vars']}['nip'];
			if (${$GLOBALS['post_vars']}['insert_by']!='') $record['insert_by'] = ${$GLOBALS['post_vars']}['insert_by'];
			if (${$GLOBALS['post_vars']}['date_insert']!='') $record['date_insert'] = $this->parsedate(trim(${$GLOBALS['post_vars']}['date_insert']));

			eval($this->save_config);
			if (surat_ubah_keputusan::update($record)) {

				$_block->parse(array('+<font color=green><b>'.__('Successfull Updated').'</b></font>'));
				return $_block->get_str();
			}
		}
		$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
		$_block->parse(array('+<font color=red><b>'.__('Failed Updated').'</b></font>'.' :'.__('Data doesn\'t exists')));
		return  $_block->get_str();
	}

	// handle delete surat_ubah_keputusan
	function delete_surat_ubah_keputusan() {
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
					$query4 .= "$myvar='$myval'";
				}
			}
			if ($query2) $query .= "($query2)";
			if ($query4) $query3 .= "($query4)";
		}


		if ($query)
			$success = $adodb->Execute("delete from surat_ubah_keputusan where ".$query);

		$_block = new block();
		$_block->set_config('title', ('Delete Surat Keputusan Perubahan Izin Produksi Status'));
		$_block->set_config('width', 595);
				$info[] = ('+surat_ubah_keputusan <font color=red>'.$query.'</font> <font color=green><b>'.__('Successfull Deleted').'</b></font>');
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



	function view_surat_ubah_keputusan_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		$field_arr = surat_ubah_keputusan::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_surat_ubah_keputusan'] = 'protect';

		$record = array (
			'id_surat_ubah_keputusan' => ${$GLOBALS['get_vars']}['id_surat_ubah_keputusan']
		);
		$result = surat_ubah_keputusan::get($record);
		$value_arr = $result[0];
		$label_arr = $this->surat_ubah_keputusan_label;

		$sqlA = "SELECT
		no_surat_ubah_keputusan,
		id_cek_2
		FROM
		surat_ubah_keputusan
		WHERE
		id_surat_ubah_keputusan ='".$value_arr['id_surat_ubah_keputusan']."'
		";

		$hasil=$adodb->Execute($sqlA);
		WHILE(! $hasil->EOF){
			$no_surat_ubah_keputusan = $hasil->fields['no_surat_ubah_keputusan'];
			$id_cek_2 = $hasil->fields['id_cek_2'];
		$hasil->MoveNext();
		}
		
		$sqlB="
		select
		surat_ubah_keputusan.id_surat_ubah_keputusan,
		surat_ubah_keputusan.no_surat_ubah_keputusan,
		surat_ubah_keputusan.nama,
		surat_ubah_keputusan.nip,
		pendaftar.nama_pabrik,
		pendaftar.npwp,
		pendaftar.namapenanggungjwb,
		pendaftar.alamatgudang,
		pendaftar.alamat_bengkel,
		pendaftar.alamat_pabrik,
		pendaftar.nama_propinsi_2,
		pendaftar.nama_direktur,
		tt_2_alkes.urut_no_tt,
		tt_2_alkes.kode_subdit,
		tt_2_alkes.date_insert,
		cek_2_alkes.no_rekomendasi,
		cek_2_alkes.date_rekomendasi,
		cek_2_alkes.no_pemohon,
		cek_2_alkes.date_pemohon,
		cek_2_alkes.no_bap,
		cek_2_alkes.date_bap
		from
		surat_ubah_keputusan
		LEFT OUTER JOIN cek_2_alkes ON(cek_2_alkes.id_cek_2 = surat_ubah_keputusan.id_cek_2)
		LEFT OUTER JOIN tt_2_alkes ON(tt_2_alkes.no_tt = cek_2_alkes.no_tt)
		LEFT OUTER JOIN pemohon_ubah_ijin_produksi ON(pemohon_ubah_ijin_produksi.kode_pemohon_ubah_ijin_produksi = tt_2_alkes.kode_pendaftar)
		LEFT OUTER JOIN surat_keputusan ON(surat_keputusan.no_surat_keputusan = pemohon_ubah_ijin_produksi.no_surat_keputusan )
		LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
		LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
		LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
		WHERE
		surat_ubah_keputusan.id_cek_2 = '".$id_cek_2."'
		";
		$rsb = $adodb->Execute($sqlB);
		$nama_perusahaan = $rsb->fields['nama_pabrik'];
		$urut_no_tt = $rsb->fields['urut_no_tt'];
		$nama_penanggung = $rsb->fields['namapenanggungjwb'];
		$alamat_gudang = $rsb->fields['alamatgudang'];
		$alamat_bengkel = $rsb->fields['alamat_bengkel'];
		$nama_direktur = $rsb->fields['nama_direktur'];
		$date_insert = date('d M Y',$rsb->fields['date_insert']);
		$no_rekomendasi = $rsb->fields['no_rekomendasi'];
		$no_pemohon = $rsb->fields['no_pemohon'];
		$date_pemohon = date('d M Y',$rsb->fields['date_pemohon']);
		$alamat_pabrik = $rsb->fields['alamat_pabrik'];
		$nama_propinsi_2 = $rsb->fields['nama_propinsi_2'];
		$date_rekomendasi = date('d M Y',$rsb->fields['date_rekomendasi']);
		$no_bap = $rsb->fields['no_bap'];
		$npwp = $rsb->fields['npwp'];
		$date_bap = date('d M Y',$rsb->fields['date_bap']);
		$kode_subdit = $rsb->fields['kode_subdit'];
		$nama = $rsb->fields['nama'];
		$nip = $rsb->fields['nip'];

		$rsS = $adodb->Execute("SELECT keterangan FROM subdit where id_subdit = '".$kode_subdit."'");
		$ketS = $rsS->fields[keterangan];


		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','legal');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,'UBAH KEPUTUSAN MENTERI KESEHATAN REPUBLIK INDONESIA','',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(180,7,'NOMOR : '.$no_surat_ubah_keputusan.'','',0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Ln(10);
		$pdf->Cell(180,7,'TENTANG','',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(180,7,'IZIN '.$ketS.'','',0,'C');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'MENTERI KESEHATAN REPUBLIK INDONESIA','',0,'C');
		$pdf->Ln(20);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(25,7,'MEMBACA','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(150,7,'1. Surat pemohonan '.$nama_perusahaan.', Jakarta No '.$no_pemohon.'',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    tanggal '.$date_pemohon.' tentang izin '.$ketS.'',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'2. Berita Acara Pemeriksaan Dinas Kesehatan Propinsi DKI Jakarta',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    NO.'.$no_bap.', tanggal '.$date_bap.'',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'3. Rekomendasi  Dinas  Kesehatan Propinsi DKI   Jakarta NO.'.$no_rekomendasi.',',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    tanggal '.$date_rekomendasi.'',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(25,7,'MENIMBANG','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(160,7,'1. Bahwa permohonan '.$nama_perusahaan.', '.$nama_propinsi_2.' tersebut telah',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    memenuhi persyaratan dan dapat disetujui.',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'2. Bahwa oleh karena itu dianggap perlu menerbitkan izin '.$ketS.'',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    dan perluasan keagenan untuk yang bersangkutan',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(25,7,'MENGINGAT','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(150,7,'1. Undang-undang Nomor 23 Tahun 1992 tentang Kesehatan (Lembaran Negara',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    Tahun 1992 Nomor : 100; Tambahan Lembaga Negara Nomor  : 3495).',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'2. Keputusan Presiden RI No. 102.Tahun 2001 Tentang Kedudukan, Tugas,',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    Fungsi, Kewenangan, Susunan Organisasi dan Tata Kerja Departemen.',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'3. Keputusan Menteri Kesehatan No. 1277/Menkes/SK/XI/2001 tahun 2001',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    tentang Organisasi dan Tata Kerja Departemen Kesehatan.',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'4. Peraturan Menteri Kesehatan Republik Indonesia Nomor : 142/Menkes/Per/III',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'     1991 tanggal 14 Maret 1991 tentang Penyaluran Alat Kesehatan.',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'MEMUTUSKAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(20,7,'MENETAPKAN','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');
		$pdf->Ln();
		$pdf->Cell(15,7,'Pertama','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(160,7,'Memberikan Izin Penyalur Alat Kesehatan Kepada :','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Nama perusahaan','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$nama_perusahaan.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'NPWP','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$npwp.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Alamat Perusahaan','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$alamat_pabrik.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Nama Direktur/Pimpinan','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$nama_direktur.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Nama Penanggung','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$nama_penanggung.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Alamat Gudang','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$alamat_gudang.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Alamat Bengkel','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$alamat_bengkel.'','',0,'L');

		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'dengan ketentuan sebagai berikut : ','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'1. Harus selalu diawasi oleh Penanggung Jawab Teknis yang namanya','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    tercantum pada surat keputusan ini.','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'2. Harus mematuhi peraturan perundang-undangan yang berlaku','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'3. Melaksanakan dokumentasi pengadaan, penyimpanan dan  penyaluran','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    alat kesehatan dengan sebaik-baiknya sesuai ketentuan yang berlaku.','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'4. Izin '.$ketS.' berlaku untuk seterusnya selama','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    perusahaan '.$ketS.' yang bersangkutan masih aktif','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    melakukan kegiatan usahanya dan berlaku untuk seluruh wilayah','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Republik Indonesia','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(20,7,'Kedua','',0,'L');$pdf->Cell(160,7,' : Surat Keputusan   ini   berlaku   sejak    tanggal  ditetapkan dengan','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    catatan bahwa akan  diadakan peninjauan atau perubahan sebagaimana','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    mestinya apabila  terdapat   kekurangan    atau    kekeliruan    dalam ','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    penetapan ini.','',0,'L');

		$pdf->Ln(20);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(30,7,'Ditetapkan di','',0,'L');$pdf->Cell(60,7,' : J a k a r t a ','',0,'L');
		$pdf->Ln();
		$tg = date('d M Y');
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(30,7,'Pada tanggal','B',0,'L');$pdf->Cell(40,7,' : '.$tg.'','B',0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$date_bap = date('d M Y');
		$kode_subdit = $rsb->fields['kode_subdit'];

		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'a.n MENTERI KESEHATAN REPUBLIK INDONESIA','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'DIREKTUR JENDERAL PELAYANAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'KEFARMASIAN DAN ALAT  KESEHATAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'u.b. DIREKTUR BINA PRODUKSI DAN DISTRIBUSI','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'ALAT KESEHATAN','',0,'C');
		$pdf->Ln(20);
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,''.$nama.'','B',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,'NIP .'.$nip.'','',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(180,7,'Salinan Keputusan ini disampaikan kepada Yth :','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'1. Dirjen Yan Far dan Alkes ( sebagai laporan )','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'2. Ka Dinas Kesehatan Prop. DKI Jakarta','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'3. Dit. Jen Bea dan Cukai Dep. Keuangan RI di Jakarta','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'4. Dep. Perindag RI Jakarta','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'5. GAKESLAB di Jakarta','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'6. Arsip','',0,'L');




		$pdf->Output();


		$_form = $lamp;

		return $_form;
	}






	// handle event import surat_ubah_keputusan
	function import_surat_ubah_keputusan() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['post_vars']}, ${$GLOBALS['files_vars']};
		$pk = array (
			'id_surat_ubah_keputusan' => TRUE
		);
		$label_arr = $this->surat_ubah_keputusan_label;

		$fd = fopen(${$GLOBALS['files_vars']}['userfile']['tmp_name'], "r");
		while (! feof($fd)) {
			$buffer = fgets($fd, 4096);
			$piece = split(",", $buffer);
			if (empty($field_arr)) {
				$insert_key = "";
				for ($i=0;$i<count($piece);$i++) {
					$buffer2 = trim(preg_replace("/^\"(.*)\"$/", "\\1", $piece[$i]), "\xA0 \t\n\r\0\x0B");
					$field_arr[$i] = array_search($buffer2, $label_arr);
					if ($field_arr[$i]) {
						if ($insert_key) $insert_key .= ',';
						$insert_key .= $field_arr[$i];
					}
					$count_piece++;
				}
				if ($insert_key) $insert_key = "(".$insert_key.")";
			} else if (count($piece) == $count_piece) {
				for ($i=0;$i<count($piece);$i++) {
			

		$buffer2 = trim(preg_replace("/^\"(.*)\"$/", "\\1", $piece[$i]), "\xA0 \t\n\r\0\x0B");
					if ($field_arr[$i]) {
						if ($insert_extra) $insert_extra .= ',';
						$insert_extra .= '\''.$buffer2.'\'';
						if ($pk[$field_arr[$i]]) {
							if ($delete_extra) $delete_extra .= " AND ";
							$delete_extra .= $field_arr[$i].'=\''.$buffer2.'\'';
						}
					}
				}
				if ($insert_extra) {
					$insert_extra = "(".$insert_extra.")";
					if ($insert_value) $insert_value .= ",";
					$insert_value .= $insert_extra;
					unset($insert_extra);
				}
				if ($delete_extra) {
					$delete_extra = "(".$delete_extra.")";
					if ($delete_where) $delete_where .= " OR ";
					$delete_where .= $delete_extra;
					unset($delete_extra);
				}
			}
		}
		fclose($fd);
		unlink(${$GLOBALS['files_vars']}['userfile']['tmp_name']);

		global $adodb;
		if ($delete_where) $delete_query = "DELETE FROM surat_ubah_keputusan WHERE ".$delete_where." ;";
		$adodb->Execute($delete_query);

		if ($insert_key && $insert_value) {

			srand((double)microtime()*1000000);
			$output_file = '/tmp/'.md5(rand()).'.output.txt';
			$all_query = $insert_value;

			$all_query = str_replace("),", ")\n", $all_query);
			if (strstr($GLOBALS['adodb_type'], 'mysql')) {
				$piece = explode("\n", $all_query);
				foreach ($piece as $key => $value) {
					$value = str_replace('(\'', '', $value);
					$value = str_replace('\',\'', "\t", $value);
					$value = str_replace('\')', '', $value);
					if ($data_file) $data_file .= "\n";
					$data_file .= $value;
				}
				$fl = fopen($output_file.'.mysql', 'w');
				fwrite($fl, $data_file);
				fclose($fl);
				$adodb->Execute('LOAD DATA INFILE \''.$output_file.'.mysql'.'\' INTO TABLE surat_ubah_keputusan '.$insert_key);
				unlink($output_file.'.mysql');
			} else if (strstr($GLOBALS['adodb_type'], 'postgres')) {

			        $piece = explode("\n", $all_query);
				foreach ($piece as $key => $value) {
					$value = str_replace('(\'', '', $value);
					$value = str_replace('\',\'', "\t", $value);
					$value = str_replace('\')', '', $value);
					if ($data_file) $data_file .= "\n";
					$data_file .= $value;
				}
				$fl = fopen($output_file.'.pgsql', 'w');
				fwrite($fl, $data_file);
				fclose($fl);
				$adodb->Execute('COPY surat_ubah_keputusan '.$insert_key.' FROM \''.$output_file.'.pgsql'.'\'');
				unlink($output_file.'.pgsql');
			} else {
				$piece = explode("\n", $all_query);
				foreach ($piece as $key => $value) {
					$adodb->Execute('INSERT INTO surat_ubah_keputusan '.$insert_key.' VALUES '.$value);
				}
			}
		}

		$_block = new block();
		$_block->set_config('title', ('Import Surat Keputusan Perubahan Izin Produksi Status'));
		$_block->set_config('width', 595);
		if (! $adodb->ErrorMsg()) {
			$_block->parse(array('+<font color=green><b>'.__('Successfull Import').'</b></font>'));
			return $_block->get_str();
		}
		$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
		$_block->parse(array('+<font color=red><b>'.__('Failed Import').'</b></font>'));
		return  $_block->get_str();
	}

	// handle list surat_ubah_keputusan
	function list_surat_ubah_keputusan($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'select
		surat_ubah_keputusan.id_surat_ubah_keputusan,
		surat_ubah_keputusan.no_surat_ubah_keputusan,
		pendaftar.nama_pabrik,
		surat_ubah_keputusan.nip,
		surat_ubah_keputusan.nama
		from
		surat_ubah_keputusan
		LEFT OUTER JOIN cek_2_alkes ON(cek_2_alkes.id_cek_2 = surat_ubah_keputusan.id_cek_2)
		LEFT OUTER JOIN tt_2_alkes ON(tt_2_alkes.no_tt = cek_2_alkes.no_tt)
		LEFT OUTER JOIN pemohon_ubah_ijin_produksi ON(pemohon_ubah_ijin_produksi.kode_pemohon_ubah_ijin_produksi = tt_2_alkes.kode_pendaftar)
		LEFT OUTER JOIN surat_keputusan ON(surat_keputusan.no_surat_keputusan = pemohon_ubah_ijin_produksi.no_surat_keputusan )
		LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
		LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
		LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
		';// where vendor_code=\''.$vendor_code.'\'';


		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_surat_ubah_keputusan' => TRUE,
			'surat_ubah_keputusan' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'id_surat_ubah_keputusan' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 600, 400, null, null, \'add_surat_ubah_keputusan\');'.
			'win.focus()',
			"title"=>__("Add").'Surat Keputusan Perubahan Izin Produksi',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//			if ($this->get_permission('fill_this')) {
//				$add_anchor .= pager::pager_button(array("link"=>'javascript:openIT(\'' . $GLOBALS['PHP_SELF'] .
//				'?action=import' .
//				'\', 600, 400, null, null, \'import_surat_ubah_keputusan\');', "title"=>__("Import").' surat_ubah_keputusan"', "label"=>__('(I)')));
//			}
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_surat_ubah_keputusan\');'.
			'win.focus()',
			"title"=>__("Edit").' Surat Keputusan Perubahan Izin Produksi',
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' . 
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_surat_ubah_keputusan\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"title"=>__('Delete').' Surat Keputusan Perubahan Izin Produksi', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
$view_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\', 640, 480, null, null, \'view_skk\');'.
			'win.focus()',
			"title"=>__("View").' Surat Keputusan Perubahan Izin Produksi',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"link+"));
//		}

		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_surat_ubah_keputusan\');'.
			'win.focus()',
			"title"=>__('Print').' Surat Keputusan Perubahan Izin Produksi',
			"label"=>__('Print'),
			"type"=>"button",
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->surat_ubah_keputusan_label;
		$config = array (
			'id'		=> 'surat_ubah_keputusan',
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
			'form_title'	=> __('List').' Surat Keputusan Perubahan Izin Produksi'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print surat_ubah_keputusan
	function print_surat_ubah_keputusan() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_surat_ubah_keputusan($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$surat_ubah_keputusan_controller = new surat_ubah_keputusan_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_ubah_keputusan_controller->add_surat_ubah_keputusan_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $surat_ubah_keputusan_controller->add_surat_ubah_keputusan();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_ubah_keputusan_controller->update_surat_ubah_keputusan_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $surat_ubah_keputusan_controller->update_surat_ubah_keputusan();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $surat_ubah_keputusan_controller->view_surat_ubah_keputusan_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $surat_ubah_keputusan_controller->delete_surat_ubah_keputusan();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_ubah_keputusan_controller->import_surat_ubah_keputusan_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $surat_ubah_keputusan_controller->import_surat_ubah_keputusan();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $surat_ubah_keputusan_controller->print_surat_ubah_keputusan();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $surat_ubah_keputusan_controller->list_surat_ubah_keputusan();
			include 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Surat Keputusan Perubahan Izin Produksi Administration';
	include 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

<?php

	require 'init.php';
	require 'auth.php';

if (class_exists('surat_keputusan_controller')) {
	// do nothing
} else if (defined('CLASS_surat_keputusan_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_surat_keputusan_CONTROLLER', TRUE);

include_once 'class.surat_keputusan.inc.php';
class surat_keputusan_controller extends depkes2_manager {
	var $surat_keputusan_label;
	var $optional_arr;
	function surat_keputusan_controller() {
		$this->surat_keputusan_label = array (
			'id_surat_keputusan' => 'Id Surat Keputusan',
			'no_surat_keputusan' => 'Nomor Surat Keputusan',
			'id_cek_1' => 'Nama Pabrik',
			'nama' => 'Pengesah',
			'nip' => 'NIP pengesah',
			'izin_produksi' => 'Izin Produksi',
			'nama_pabrik' => 'Nama Pabrik',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_surat_keputusan' => TRUE,
			'surat_keputusan' => FALSE,
			'keputusan' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}

	
 function id_cek_1_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['id_cek_1'];

		include_once 'class.cek_1_alkes.inc.php';
		if($_GET['action']=='edit'){
		$fk_sql = ''.
			'SELECT
				cek_1_alkes.id_cek_1 as skey,
				tt_1_alkes.urut_no_tt as svalue,
				pendaftar.nama_pabrik as svalue2
			FROM
				cek_1_alkes
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
			LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
			LEFT OUTER JOIN surat_penolakan ON( surat_penolakan.id_cek_1 = cek_1_alkes.id_cek_1)
			WHERE
			surat_penolakan.id_cek_1 IS NULL AND
   			(cek_1_alkes.status_direktur = \'0\' OR cek_1_alkes.status_kasubdit = \'0\')
			ORDER BY
				cek_1_alkes.date_insert
			';
		}else{
			$fk_sql = ''.
			'SELECT
				cek_1_alkes.id_cek_1 as skey,
				tt_1_alkes.urut_no_tt as svalue,
				pendaftar.nama_pabrik as svalue2
			FROM
				cek_1_alkes
			LEFT OUTER JOIN surat_keputusan ON(surat_keputusan.id_cek_1 = cek_1_alkes.id_cek_1)
			LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
			LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
			LEFT OUTER JOIN surat_penolakan ON( surat_penolakan.id_cek_1 = cek_1_alkes.id_cek_1)
			WHERE
			(surat_keputusan.id_cek_1 IS NULL AND surat_penolakan.id_cek_1 IS NULL) AND
			(cek_1_alkes.status_direktur = \'0\' OR	cek_1_alkes.status_kasubdit = \'0\')
			ORDER BY
				cek_1_alkes.date_insert
			';
		}
		//print $fk_sql;
		$result = cek_1_alkes::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('id_cek_1');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('No Tanda Terima - ').' '.$this->surat_keputusan_label['id_cek_1']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['id_cek_1'] = 'user_defined';
		$value_arr['id_cek_1'] = $this->select_form('id_cek_1', $result, $selected);
		$optional_arr['id_cek_1_rule'] = "\n".
		"       if(theform.id_cek_1.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['id_cek_1']." ".__('empty').".');\n".
		"               theform.id_cek_1.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";


	}


	// create add surat_keputusan form
	function add_surat_keputusan_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		$field_arr = surat_keputusan::get_field_set();

//		$value_arr = array ();
		$label_arr = $this->surat_keputusan_label;
		$optional_arr = $this->optional_arr;
		$optional_arr['keputusan'] = 'user_defined';
		$value_arr['keputusan']= '<textarea rows="100" cols="75" name="keputusan" class="text"></textarea>';

		eval($this->save_config);
		$this->id_cek_1_form($config);
		$this->slip_field($config,'izin_produksi','after','no_surat_keputusan');

//		$label_arr['submit_val'] = 'Submit';
		$label_arr['form_extra'] = '<input type=hidden name=action value="postadd">'; // default null
		$label_arr['form_extra'] .= '<input type=hidden name=opener value="'.$GLOBALS[$GLOBALS['get_vars']]['opener'].'">'; // default null
		$label_arr['form_extra'] .= '<input type=hidden name=opener_sql value="'.$GLOBALS[$GLOBALS['get_vars']]['opener_sql'].'">'; // default null
		$label_id_cek_1arr['form_extra'] .= '<input type=hidden name=opener_var value="'.$GLOBALS[$GLOBALS['get_vars']]['opener_var'].'">'; // default null
		$label_arr['form_title'] = __('Form').' '.__('Add').' Surat Keputusan Registrasi Izin Produksi'; // default null
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

	// create update surat_keputusan form
	function update_surat_keputusan_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		$field_arr = surat_keputusan::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_surat_keputusan'] = 'protect';
		$record = array (
			'id_surat_keputusan' => ${$GLOBALS['get_vars']}['id_surat_keputusan']
		);
		$result = surat_keputusan::get($record);
		$value_arr = $result[0];
		$label_arr = $this->surat_keputusan_label;

		eval($this->save_config);
		$this->id_cek_1_form($config);
		$this->slip_field($config,'izin_produksi','after','no_surat_keputusan');
		$optional_arr['keputusan'] = 'user_defined';
		$value_arr['keputusan']= '<textarea rows="100" cols="75" name="keputusan" class="text">'.$value_arr['keputusan'].'</textarea>';
//		$label_arr['submit_val'] = 'Submit';
		$label_arr['form_extra'] = '<input type=hidden name=action value=postedit>'; // default null
		$label_arr['form_title'] = ('Update Surat Keputusan Registrasi Izin Produksi Form'); // default null
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

	// create import surat_keputusan form
	function import_surat_keputusan_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		$field_arr[] = array ('name' => 'userfile');
		$optional_arr['userfile'] = 'user_defined';
		$value_arr['userfile'] = '<input class=text type=file name=userfile>';

		eval($this->save_config);
		$label_arr['userfile'] = 'Import File';
		$label_arr['submit_val'] = 'Import'; // default Submit
		$label_arr['form_extra'] = '<input type=hidden name=action value=postimport>'; // default null
		$label_arr['form_title'] = ('Import Surat Keputusan Registrasi Izin Produksi Form'); // default null
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

	// handle event add surat_keputusan
	function add_surat_keputusan() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['post_vars']};
		$record = array (
			'no_surat_keputusan' => ${$GLOBALS['post_vars']}['no_surat_keputusan'],
			'id_cek_1' => ${$GLOBALS['post_vars']}['id_cek_1'],
			'nama' => ${$GLOBALS['post_vars']}['nama'],
			'izin_produksi' => ${$GLOBALS['post_vars']}['izin_produksi'],
			'nip' => ${$GLOBALS['post_vars']}['nip'],
			'insert_by' => $GLOBALS['ses']->loginid,
			'date_insert' => time()
		);
		$_block = new block();
		$_block->set_config('title', __('Status').' '.__('Add').' Surat Keputusan Registrasi Izin Produksi');
		$_block->set_config('width', 595);
		if (! surat_keputusan::get($record)) {
			eval($this->save_config);
			if (surat_keputusan::add($record)) {


				if ($GLOBALS[$GLOBALS['post_vars']]['opener']) {
					$opener_sql = $GLOBALS[$GLOBALS['post_vars']]['opener_sql'];
					$opener_var = $GLOBALS[$GLOBALS['post_vars']]['opener_var'];
					if (! $record[$opener_var]) {
						if (eregi('postgre', $GLOBALS['adodb_type']))
							$last_id = $GLOBALS['adodb']->Execute(
							"SELECT
								currval('surat_keputusan_{$opener_var}_seq') AS last_id
							FROM
								surat_keputusan"
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

	// handle event update surat_keputusan
	function update_surat_keputusan() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['post_vars']};
		$record = array (
			'id_surat_keputusan' => ${$GLOBALS['post_vars']}['id_surat_keputusan']
		);
		$_block = new block();
		$_block->set_config('title', ('Update Surat Keputusan Registrasi Izin Produksi Status'));
		$_block->set_config('width', 595);
		if ($result = surat_keputusan::get($record)) {
			$record = $result[0];
			if (${$GLOBALS['post_vars']}['surat_keputusan']!='') $record['surat_keputusan'] = ${$GLOBALS['post_vars']}['surat_keputusan'];
			if (${$GLOBALS['post_vars']}['keputusan']!='') $record['keputusan'] = ${$GLOBALS['post_vars']}['keputusan'];
			if (${$GLOBALS['post_vars']}['nama']!='') $record['nama'] = ${$GLOBALS['post_vars']}['nama'];
			if (${$GLOBALS['post_vars']}['nip']!='') $record['nip'] = ${$GLOBALS['post_vars']}['nip'];
			if (${$GLOBALS['post_vars']}['izin_produksi']!='') $record['izin_produksi'] = ${$GLOBALS['post_vars']}['izin_produksi'];
			if (${$GLOBALS['post_vars']}['insert_by']!='') $record['insert_by'] = ${$GLOBALS['post_vars']}['insert_by'];
			if (${$GLOBALS['post_vars']}['date_insert']!='') $record['date_insert'] = $this->parsedate(trim(${$GLOBALS['post_vars']}['date_insert']));

			eval($this->save_config);
			if (surat_keputusan::update($record)) {

				$_block->parse(array('+<font color=green><b>'.__('Successfull Updated').'</b></font>'));
				return $_block->get_str();
			}
		}
		$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
		$_block->parse(array('+<font color=red><b>'.__('Failed Updated').'</b></font>'.' :'.__('Data doesn\'t exists')));
		return  $_block->get_str();
	}

	// handle delete surat_keputusan
	function delete_surat_keputusan() {
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
			$success = $adodb->Execute("delete from surat_keputusan where ".$query);

		$_block = new block();
		$_block->set_config('title', ('Delete Surat Keputusan Registrasi Izin Produksi Status'));
		$_block->set_config('width', 595);
				$info[] = ('+surat_keputusan <font color=red>'.$query.'</font> <font color=green><b>'.__('Successfull Deleted').'</b></font>');
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



	function view_surat_keputusan_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		$field_arr = surat_keputusan::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_surat_keputusan'] = 'protect';

		$record = array (
			'id_surat_keputusan' => ${$GLOBALS['get_vars']}['id_surat_keputusan']
		);
		$result = surat_keputusan::get($record);
		$value_arr = $result[0];
		$label_arr = $this->surat_keputusan_label;

		$sqlA = "SELECT
		no_surat_keputusan,
		id_cek_1
		FROM
		surat_keputusan
		WHERE
		id_surat_keputusan ='".$value_arr['id_surat_keputusan']."'
		";

		$hasil=$adodb->Execute($sqlA);
		WHILE(! $hasil->EOF){
			$no_surat_keputusan = $hasil->fields['no_surat_keputusan'];
			$id_cek_1 = $hasil->fields['id_cek_1'];
		$hasil->MoveNext();
		}
		
		$sqlB="
		select
		surat_keputusan.id_surat_keputusan,
		surat_keputusan.no_surat_keputusan,
		surat_keputusan.nama,
		surat_keputusan.izin_produksi,
		surat_keputusan.nip,
		pendaftar.nama_pabrik,
		pendaftar.npwp,
		pendaftar.alamat_pendaftar,
		pendaftar.namapenanggungjwb,
		pendaftar.alamatgudang,
		pendaftar.alamat_bengkel,
		pendaftar.alamat_pabrik,
		pendaftar.nama_propinsi_1,
		pendaftar.nama_propinsi_2,
		pendaftar.nama_direktur,
		gol_alkes.golongan,
		tt_1_alkes.jenis_izin_produksi,
		tt_1_alkes.urut_no_tt,
		tt_1_alkes.kode_subdit,
		tt_1_alkes.date_insert,
		cek_1_alkes.no_rekomendasi,
		cek_1_alkes.date_rekomendasi,
		cek_1_alkes.nama_produk,
		cek_1_alkes.no_pemohon,
		cek_1_alkes.date_pemohon,
		cek_1_alkes.no_bap,
		cek_1_alkes.date_bap
		from
		surat_keputusan
		LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
		LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
		LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
		LEFT OUTER JOIN gol_alkes ON(gol_alkes.id_golongan = cek_1_alkes.id_golongan)
		WHERE
		surat_keputusan.id_cek_1 = '".$id_cek_1."'
		";
		$rsb = $adodb->Execute($sqlB);
		$golongan = $rsb->fields['golongan'];
		$nama_produk = $rsb->fields['nama_produk'];
		$no_surat_keputusan = $rsb->fields['no_surat_keputusan'];
		$jenis_izin_produksi = $rsb->fields['jenis_izin_produksi'];
		$izin_produksi = $rsb->fields['izin_produksi'];
		$nama_perusahaan = $rsb->fields['nama_pabrik'];
		$izin_produksi = $rsb->fields['izin_produksi'];
		$nama_propinsi_1 = $rsb->fields['nama_propinsi_1'];
		$alamat_pendaftar = $rsb->fields['alamat_pendaftar'];
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
		
		if($jenis_izin_produksi == '0')$keterangan = 'PRODUKSI ALAT KESEHATAN'; else $keterangan = 'PRODUKSI PERBEKALAN KESEHATAN RUMAH TANGGA';
		if($jenis_izin_produksi == '0')$keterangan1 = 'Produksi Alat Kesehatan'; else $keterangan1 = 'Produksi Perbekalan Kesehatan Rumah Tangga';


		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','legal');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,'KEPUTUSAN MENTERI KESEHATAN REPUBLIK INDONESIA','',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(180,7,'NOMOR : '.$no_surat_keputusan.'','',0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Ln(10);
		$pdf->Cell(180,7,'TENTANG','',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(180,7,'IZIN '.$keterangan.'','',0,'C');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'MENTERI KESEHATAN REPUBLIK INDONESIA','',0,'C');
		$pdf->Ln(20);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(25,7,'MEMBACA','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(150,7,'1. Surat pemohonan Izin Produksi '.$nama_perusahaan.', '.$alamat_pendaftar.' '.$no_pemohon.'',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    tanggal '.$date_pemohon.' beserta lampirannya, perihal permohonan Izin ',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    '.$keterangan1.'',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'2. Berita Acara Pemeriksaan Dinas Kesehatan Propinsi '.$nama_propinsi_1.'',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    NO.'.$no_bap.', tanggal '.$date_bap.'',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'3. Rekomendasi  Kepala Dinas  Kesehatan Propinsi '.$nama_propinsi_1.' '.$no_rekomendasi.',',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    tanggal '.$date_rekomendasi.'',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(25,7,'MENIMBANG','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(160,7,'1. Bahwa permohonan '.$nama_perusahaan.', '.$alamat_pendaftar.' telah',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    memenuhi persyaratan dan dapat disetujui.',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'2. Bahwa oleh karena itu dianggap perlu menerbitkan izin '.$keterangan1.'',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    dan perluasan keagenan untuk yang bersangkutan',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(25,7,'MENGINGAT','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(150,7,'1. Undang-undang No.5 Tahun 1984 tentang Perindustrian',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'2. Undang-undang No.23 Tahun 1992 tentang Kesehatan (Lembaran Negara',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    Tahun 1992 No. : 100; Tambahan Lembaga Negara No.3495).',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'3. Undang-undang No.8 Tahun 1999 tentang Perlindungan Konsumen',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'4. Peraturan Pemerintah No. 72 tahun 1998 tentang Pengamanan',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'   Sediaan Farmasi dan Alat Kesehatan',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'5. Keputusan Presiden RI No. 102.Tahun 2001 Tentang Kedudukan, Tugas,',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    Fungsi, Kewenangan, Susunan Organisasi dan Tata Kerja Departemen.',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'6. Peraturan Menteri Kesehatan RI No.220/Menkes/Per/II/1976 tanggal',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'   6 September 1976 tentang Produksi dan Peredaran Kosmetik dan Alat Kesehatan.',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'7. Peraturan Menteri Kesehatan RI No.236/Menkes/Per/X/1977 tanggal',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'   5 Oktober 1977 tentang Perizinan Prosuksi Kosmetik dan Alat Kesehatan',0,'L');
		
		if($jenis_izin_produksi == '0'){
			$pdf->Ln();
			$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'8. Keputusan Menteri Kesehatan No. 1277/Menkes/SK/XI/2001 tahun 2001',0,'L');
			$pdf->Ln();
			$pdf->Cell(30,7,'','',0,'L');$pdf->Cell(150,7,'    tentang Organisasi dan Tata Kerja Departemen Kesehatan.',0,'L');
		}

		$pdf->Ln(10);
		$pdf->Cell(180,7,'MEMUTUSKAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(20,7,'MENETAPKAN','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');
		$pdf->Ln();
		$pdf->Cell(15,7,'Pertama','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(160,7,'Memberikan Izin '.$keterangan1.' Kepada :','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Nama perusahaan','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$nama_perusahaan.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'NPWP','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$npwp.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Alamat Perusahaan','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$alamat_pabrik.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Nama Direktur/Pimpinan','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$nama_direktur.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Nama Penanggung','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Jawab Teknis','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$nama_penanggung.'','',0,'L');
		$pdf->Ln();

		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Nomor Izin Produksi','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$izin_produksi.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(150,7,'Untuk memproduksi '.$keterangan1.' menurut daftar tercantum','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(150,7,'pada Lampiran Keputusan ini.','',0,'L');

		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->Cell(15,7,'Kedua','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(160,7,'Izin Produksi '.$keterangan1.' yang dimaksud dalam diktum','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'pertama termasuk golongan '.$golongan.' dengan ketentuan : ','',0,'L');
		$pdf->Ln();

		


		if($golongan == 'A'){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'1. Harus selalu dipimpin oleh seorang Penanggung Jawab Teknis yang','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    bekerja penuh, yang namanya tercantum pada surat keputusan ini.','',0,'L');
			$pdf->Ln();
		}
		if($golongan == 'B'){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'1. Harus selalu dipimpin oleh seorang Penanggung Jawab Teknis yang','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    bekerja penuh, yang namanya tercantum pada surat keputusan ini.','',0,'L');
			$pdf->Ln();
		}
		if($golongan == 'C'){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'1. Harus selalu dipimpin oleh seorang Penanggung Jawab Teknis yang','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    berpendidikan sekurang-kurangnya Asisten Apoteker atau yang sederajat','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    dengan keahliannya, yang bekerja penuh dan namanya tercantum pada','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    surat keputusan ini','',0,'L');
			$pdf->Ln();
		}



		if($golongan == 'A'){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'2. Harus mempunyai Laboratorium yang mampu melakukan pemeriksaan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    mutu bahan sampai produk jadi.','',0,'L');
			$pdf->Ln();
		}
		if($golongan == 'B'){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'2. Harus mempunyai Laboratorium yang mampu melakukan pemeriksaan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    mutu bahan sampai produk jadi.','',0,'L');
			$pdf->Ln();
		}
		if($golongan == 'C'){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'2. Harus memeriksakan bahan dan produk jadinya pada Laboratorium ','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    pemerintah/Laboratorium yang ditunjuk Pemerintah.','',0,'L');
			$pdf->Ln();
		}


		if(($golongan == 'A')&&($jenis_izin_produksi == '0')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'3. Harus memberi laporan tentang hasil produksi dan hasil pemeriksaan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Laboratorium setiap 3 (tiga) bulan sekali, kepada Menteri Kesehatan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    RI. Cq. Direktorat Jenderal Pelayanan Kefarmasian dan Alat Kesehatan,','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    , Jl. HR. Rasuna Said Blok X5 Kav. No. 4-9, Jakarta 12950','',0,'L');
			$pdf->Ln();

		}
		if(($golongan == 'B')&&($jenis_izin_produksi == '0')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'3. Harus memberi laporan tentang hasil produksi dan hasil pemeriksaan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Laboratorium setiap 3 (tiga) bulan sekali, kepada Menteri Kesehatan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    RI. Cq. Direktorat Jenderal Pelayanan Kefarmasian dan Alat Kesehatan,','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    , Jl. HR. Rasuna Said Blok X5 Kav. No. 4-9, Jakarta 12950','',0,'L');
			$pdf->Ln();
		}
		if(($golongan == 'C')&&($jenis_izin_produksi == '0')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'3. Hanya dapat memproduksi Alat Kesehatan sesuai dengan yang ','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    tercantum pada lampiran keputusan ini. (Apabila akan memproduksi','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Alat Kesehatan lain diluar lampiran, harus mengajukan permohonan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    dengan melampirkan daftar peralatan produksi) .','',0,'L');
			$pdf->Ln();
		}
		
		if(($golongan == 'A')&&($jenis_izin_produksi == '1')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'3. Hanya dapat memproduksi Perbekalan Kesehatan Rumah Tangga ','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    sesuai dengan yang tercantum pada lampiran keputusan ini. (Apabila','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    akan memproduksi Perbekalan Kesehatan Rumah Tangga lain diluar','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    lampiran, harus mengajukan permohonan dengan melampirkan daftar peralatan produksi) .','',0,'L');
			$pdf->Ln();
		}
		if(($golongan == 'B')&&($jenis_izin_produksi == '1')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'3. Hanya dapat memproduksi Perbekalan Kesehatan Rumah Tangga ','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    sesuai dengan yang tercantum pada lampiran keputusan ini. (Apabila','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    akan memproduksi Perbekalan Kesehatan Rumah Tangga lain diluar','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    lampiran, harus mengajukan permohonan dengan melampirkan daftar peralatan produksi) .','',0,'L');
			$pdf->Ln();
		}
		if(($golongan == 'C')&&($jenis_izin_produksi == '1')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'3. Hanya dapat memproduksi Perbekalan Kesehatan Rumah Tangga ','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    sesuai dengan yang tercantum pada lampiran keputusan ini. (Apabila','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    akan memproduksi Perbekalan Kesehatan Rumah Tangga lain diluar','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    lampiran, harus mengajukan permohonan dengan melampirkan daftar peralatan produksi) .','',0,'L');
			$pdf->Ln();
		}
		
		if(($golongan == 'A')&&($jenis_izin_produksi == '0')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'4. Harus mematuhi peraturan perundang-undangan yang berlaku.','',0,'L');
			$pdf->Ln();
		}
		if(($golongan == 'B')&&($jenis_izin_produksi == '0')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'4. Harus mematuhi peraturan perundang-undangan yang berlaku.','',0,'L');
			$pdf->Ln();
		}
		if(($golongan == 'C')&&($jenis_izin_produksi == '0')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'4. Harus memberi laporan tentang hasil produksi dan hasil pemeriksaan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Laboratorium setiap 3 (tiga) bulan sekali, kepada Menteri Kesehatan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    RI. Cq. Direktorat Jenderal Pelayanan Kefarmasian dan Alat Kesehatan,','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    , Jl. HR. Rasuna Said Blok X5 Kav. No. 4-9, Jakarta 12950','',0,'L');
			$pdf->Ln();

		}

		if(($golongan == 'A')&&($jenis_izin_produksi == '1')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'4. Harus memberi laporan tentang hasil produksi dan hasil pemeriksaan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Laboratorium setiap 3 (tiga) bulan sekali, kepada Menteri Kesehatan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    RI. Cq. Direktorat Jenderal Pelayanan Kefarmasian dan Alat Kesehatan,','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    , Jl. HR. Rasuna Said Blok X5 Kav. No. 4-9, Jakarta 12950','',0,'L');
			$pdf->Ln();
		}
		if(($golongan == 'B')&&($jenis_izin_produksi == '1')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'4. Harus memberi laporan tentang hasil produksi dan hasil pemeriksaan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Laboratorium setiap 3 (tiga) bulan sekali, kepada Menteri Kesehatan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    RI. Cq. Direktorat Jenderal Pelayanan Kefarmasian dan Alat Kesehatan,','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    , Jl. HR. Rasuna Said Blok X5 Kav. No. 4-9, Jakarta 12950','',0,'L');
			$pdf->Ln();
		}
		if(($golongan == 'C')&&($jenis_izin_produksi == '1')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'4. Harus memberi laporan tentang hasil produksi dan hasil pemeriksaan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Laboratorium setiap 3 (tiga) bulan sekali, kepada Menteri Kesehatan','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    RI. Cq. Direktorat Jenderal Pelayanan Kefarmasian dan Alat Kesehatan,','',0,'L');
			$pdf->Ln();
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    , Jl. HR. Rasuna Said Blok X5 Kav. No. 4-9, Jakarta 12950','',0,'L');
			$pdf->Ln();
		}

		
		if(($golongan == 'C')&&($jenis_izin_produksi == '0')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'5. Harus mematuhi perundang-undangan yang berlaku','',0,'L');
			$pdf->Ln();
		}


		if(($golongan == 'A')&&($jenis_izin_produksi == '1')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'5. Harus mematuhi perundang-undangan yang berlaku','',0,'L');
			$pdf->Ln();
		}
		if(($golongan == 'B')&&($jenis_izin_produksi == '1')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'5. Harus mematuhi perundang-undangan yang berlaku','',0,'L');
			$pdf->Ln();
		}
		if(($golongan == 'C')&&($jenis_izin_produksi == '1')){
			$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'5. Harus mematuhi perundang-undangan yang berlaku','',0,'L');
			$pdf->Ln();
		}
		$pdf->Ln();
		$pdf->Cell(15,7,'Ketiga','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(160,7,'Izin berlaku selama 4 (empat) tahun terhitung sejak tanggal','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'dikeluarkan Surat Keputusan ini.','',0,'L');
		$pdf->Ln(10);

		$pdf->Cell(15,7,'Keempat','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(160,7,'Keputusan ini ditinjau kembali apabila terdapat kekurangan atau','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'kekeliruan dalam penetapannya.','',0,'L');
		$pdf->Ln(10);

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
		$pdf->Ln(30);
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,''.$nama.'','B',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,'NIP .'.$nip.'','',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();

		if($jenis_izin_produksi == '0'){
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(180,7,'Salinan Keputusan ini disampaikan kepada Yth :','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'1. Bapak DirJen Yanfar dan Alkes ( sebagai laporan )','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'2. Kepala Dinas Kesehatan Propinsi '.$nama_propinsi_1.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'3. Dep. Perindag RI di Jakarta','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'4. Gakeslab di Jakarta','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'5. Arsip','',0,'L');
		}

		if($jenis_izin_produksi == '1'){
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(180,7,'Salinan Keputusan ini disampaikan kepada Yth :','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'1. Kepala Dinas Kesehatan Propinsi '.$nama_propinsi_1.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'2. Dep. Perindag RI di Jakarta','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'3. Gakeslab di Jakarta','',0,'L');
			if($golongan = 'A'){
			$pdf->Ln();
			$pdf->Cell(180,7,'4. Arsip','',0,'L');
			}
		}

		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->Cell(180,7,'LAMPIRAN','',0,'R');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,'KEPUTUSAN MENTERI KESEHATAN REPUBLIK INDONESIA','',0,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(90,7,''.$no_surat_keputusan.'','',0,'L');$pdf->Cell(90,7,'Tanggal '.$tg.'','',0,'R');
		$pdf->Ln(20);
		$pdf->Cell(180,7,'Tentang','',0,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(180,7,'IZIN '.$keterangan.'','',0,'C');
		$pdf->Ln(20);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(180,7,'Jenis '.$keterangan1.' yang diizinkan diproduksi : ','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,''.$nama_produk.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'Dengan ketentuan bahwa '.$keterangan1.' tersebut harus mendapatkan persetujuan izin edar','',0,'L');
		$pdf->Ln();
		$pdf->Cell(180,7,'sebelum di  edarkan',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'a.n MENTERI KESEHATAN REPUBLIK INDONESIA','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'DIREKTUR JENDERAL PELAYANAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'KEFARMASIAN DAN ALAT  KESEHATAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'u.b. DIREKTUR BINA PRODUKSI DAN DISTRIBUSI','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'ALAT KESEHATAN','',0,'C');
		$pdf->Ln(30);
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,''.$nama.'','B',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,'NIP .'.$nip.'','',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();





		$pdf->Output();


		$_form = $lamp;

		return $_form;
	}






	// handle event import surat_keputusan
	function import_surat_keputusan() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['post_vars']}, ${$GLOBALS['files_vars']};
		$pk = array (
			'id_surat_keputusan' => TRUE
		);
		$label_arr = $this->surat_keputusan_label;

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
		if ($delete_where) $delete_query = "DELETE FROM surat_keputusan WHERE ".$delete_where." ;";
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
				$adodb->Execute('LOAD DATA INFILE \''.$output_file.'.mysql'.'\' INTO TABLE surat_keputusan '.$insert_key);
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
				$adodb->Execute('COPY surat_keputusan '.$insert_key.' FROM \''.$output_file.'.pgsql'.'\'');
				unlink($output_file.'.pgsql');
			} else {
				$piece = explode("\n", $all_query);
				foreach ($piece as $key => $value) {
					$adodb->Execute('INSERT INTO surat_keputusan '.$insert_key.' VALUES '.$value);
				}
			}
		}

		$_block = new block();
		$_block->set_config('title', ('Import surat_keputusan Izin Produksi Status'));
		$_block->set_config('width', 595);
		if (! $adodb->ErrorMsg()) {
			$_block->parse(array('+<font color=green><b>'.__('Successfull Import').'</b></font>'));
			return $_block->get_str();
		}
		$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
		$_block->parse(array('+<font color=red><b>'.__('Failed Import').'</b></font>'));
		return  $_block->get_str();
	}

	// handle list surat_keputusan
	function list_surat_keputusan($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'select
		surat_keputusan.id_surat_keputusan,
		surat_keputusan.no_surat_keputusan,
		surat_keputusan.izin_produksi,
		pendaftar.nama_pabrik,
		surat_keputusan.nip,
		surat_keputusan.nama
		from
		surat_keputusan
		LEFT OUTER JOIN cek_1_alkes ON(cek_1_alkes.id_cek_1 = surat_keputusan.id_cek_1)
		LEFT OUTER JOIN tt_1_alkes ON(tt_1_alkes.no_tt = cek_1_alkes.no_tt)
		LEFT OUTER JOIN pendaftar ON(pendaftar.kode_pendaftar = tt_1_alkes.kode_pendaftar)
		';// where vendor_code=\''.$vendor_code.'\'';


		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_surat_keputusan' => TRUE,
			'surat_keputusan' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'id_surat_keputusan' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 600, 400, null, null, \'add_surat_keputusan\');'.
			'win.focus()',
			"title"=>__("Add").'Surat Keputusan Registrasi Izin Produksi',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//			if ($this->get_permission('fill_this')) {	'no_rekomendasi' => $_POST['no_rekomendasi'],

//				$add_anchor .= pager::pager_button(array("link"=>'javascript:openIT(\'' . $GLOBALS['PHP_SELF'] .
//				'?action=import' .
//				'\', 600, 400, null, null, \'import_surat_keputusan\');', "title"=>__("Import").' surat_keputusan"', "label"=>__('(I)')));
//			}
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_surat_keputusan\');'.
			'win.focus()',
			"title"=>__("Edit").' Surat Keputusan Registrasi Izin Produksi',
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' . 
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_surat_keputusan\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"title"=>__('Delete').' Surat Keputusan Registrasi Izin Produksi', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
			$view_anchor = pager::pager_button(array("link"=>'javascript:'.
			'location.href=\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\';'.
			'',
			"title"=>__("View").' Surat Keputusan Registrasi Izin Produksi',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"button"));
//		}

		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_surat_keputusan\');'.
			'win.focus()',
			"title"=>__('Print').' Surat Keputusan Registrasi Izin Produksi',
			"label"=>__('Print'),
			"type"=>"button",
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->surat_keputusan_label;
		$config = array (
			'id'		=> 'surat_keputusan',
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
			'form_title'	=> __('List').' Surat Keputusan Registrasi Izin Produksi'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print surat_keputusan
	function print_surat_keputusan() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_surat_keputusan($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$surat_keputusan_controller = new surat_keputusan_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_keputusan_controller->add_surat_keputusan_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $surat_keputusan_controller->add_surat_keputusan();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_keputusan_controller->update_surat_keputusan_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $surat_keputusan_controller->update_surat_keputusan();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $surat_keputusan_controller->view_surat_keputusan_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $surat_keputusan_controller->delete_surat_keputusan();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_keputusan_controller->import_surat_keputusan_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $surat_keputusan_controller->import_surat_keputusan();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $surat_keputusan_controller->print_surat_keputusan();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $surat_keputusan_controller->list_surat_keputusan();
			include 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Surat Keputusan Registrasi Izin Produksi Administration';
	include 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

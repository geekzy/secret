<?php


	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('pendaftar_penyalur_controller')) {
	// do nothing
} else if (defined('CLASS_pendaftar_penyalur_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_pendaftar_penyalur_CONTROLLER', TRUE);

include_once 'class.pendaftar_penyalur.inc.php';
class pendaftar_penyalur_controller extends depkes2_manager {
	var $pendaftar_penyalur_label;
	var $optional_arr;
	function pendaftar_penyalur_controller() {
		$this->pendaftar_penyalur_label = array (
			'kode_pendaftar_penyalur' => 'Kode Pemohon',
			'nama_pendaftar_penyalur' => 'Nama Pemohon',
			'alamat_pendaftar_penyalur' => 'Kota Pemohon',
			'notelp_1' => 'No Telp',
			'npwp' => 'NPWP',
			'nama_propinsi_1' => 'Nama Propinsi',
			'nama_pabrik' => 'Nama Pabrik',
			'alamat_pabrik' => 'Alamat Pabrik',
			'notelp_2' => 'No Telp',
			'nama_propinsi_2' => 'Nama Propinsi Pabrik',
			'alamat_bengkel' => 'Alamat Bengkel',
			'userid' => 'User Id',
			'passwd' => 'Password',
			'notelp_3' => 'No Telp',
			'alamatgudang' => 'Alamat Gudang',
			'nama_propinsi' => 'Nama Propinsi',
			'notelp_4' => 'No Telp',
			'nama_direktur' => 'Nama Direktur',
			'namapenanggungjwb' => 'Nama Penanggung Jawab Teknis',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'kode_pendaftar_penyalur' => FALSE,
			'nama_pendaftar_penyalur' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}

	function nama_propinsi_1_form(&$config) {
                eval($this->load_config);
               $selected = $value_arr['nama_propinsi_1'];

		include_once 'class.propinsi.inc.php';
		$fk_sql = ''.
			'SELECT
				nama_propinsi as skey,
				nama_propinsi as svalue2
			FROM
				propinsi
			ORDER BY
				id
			';

		$result = propinsi::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('nama_propinsi_1');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->pendaftar_penyalur_label['nama_propinsi_1']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['nama_propinsi_1'] = 'user_defined';
		$value_arr['nama_propinsi_1'] = $this->select_form('nama_propinsi_1', $result, $selected);
		$optional_arr['nama_propinsi_1_rule'] = "";
		#$optional_arr['nama_propinsi_1_rule'] = "\n".
		#"       if(theform.nama_propinsi_1.value == '')\n".
		#"       {\n".
		#"               alert('Field ".$label_arr['nama_propinsi_1']." ".__('empty').".');\n".
		#"               theform.nama_propinsi_1.focus();\n".
		#"               form_submitted=false;\n".
		#"               return false;\n".
		#"       }\n";



	}
	
	function nama_propinsi_2_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['nama_propinsi_2'];

		include_once 'class.propinsi.inc.php';
		$fk_sql = ''.
			'SELECT
				nama_propinsi as skey,
				nama_propinsi as svalue2
			FROM
				propinsi
			ORDER BY
				id
			';
		$result = propinsi::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('nama_propinsi_2');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('Choose').' '.$this->pendaftar_penyalur_label['nama_propinsi_2']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['nama_propinsi_2'] = 'user_defined';
		$value_arr['nama_propinsi_2'] = $this->select_form('nama_propinsi_2', $result, $selected);
		$optional_arr['nama_propinsi_2_rule'] = "";
		#$optional_arr['nama_propinsi_2_rule'] = "\n".
		#"       if(theform.nama_propinsi_2.value == '')\n".
		#"       {\n".
		#"               alert('Field ".$label_arr['nama_propinsi_2']." ".__('empty').".');\n".
		#"               theform.nama_propinsi_2.focus();\n".
		#"               form_submitted=false;\n".
		#"               return false;\n".
		#"       }\n";



	}

	// create add pendaftar_penyalur form
	function add_pendaftar_penyalur_form() {
		include_once 'class.xform.inc.php';

//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->pendaftar_penyalur_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('kode_pendaftar_penyalur','C','255');
		$field_arr[] = xform::xf('nama_pendaftar_penyalur','C','255');
		$field_arr[] = xform::xf('npwp','C','255');
		$field_arr[] = xform::xf('alamat_pendaftar_penyalur','C','255');
		$field_arr[] = xform::xf('notelp_1','C','255');
		$field_arr[] = xform::xf('nama_propinsi_1','C','255');
		$field_arr[] = xform::xf('nama_pabrik','C','255');
		$field_arr[] = xform::xf('alamat_pabrik','C','255');
		$field_arr[] = xform::xf('notelp_2','C','255');
		$field_arr[] = xform::xf('nama_propinsi_2','C','255');
		$field_arr[] = xform::xf('alamat_bengkel','C','255');
		$field_arr[] = xform::xf('notelp_3','C','255');
		$field_arr[] = xform::xf('alamatgudang','C','255');
		$field_arr[] = xform::xf('notelp_4','C','255');
		$field_arr[] = xform::xf('nama_direktur','C','255');
		$field_arr[] = xform::xf('namapenanggungjwb','C','255');
		$field_arr[] = xform::xf('userid','C','32');
		$field_arr[] = xform::xf('passwd','C','32');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');

		$rs = $adodb->Execute("SELECT * FROM pendaftar_penyalur WHERE kode_pendaftar_penyalur='{$record['kode_pendaftar_penyalur']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['kode_pendaftar_penyalur'] = 'protect';
			$mode = 'edit';

		} else {
			$value_arr = array ();
			$mode = 'add';
		}

                // added by rudych
                if ($mode == 'add') {
                        $rs = $adodb->Execute("SELECT kode_pendaftar FROM pendaftar WHERE kode_pendaftar LIKE 'P".date('my')."%' ORDER BY kode_pendaftar DESC LIMIT 1");
                        $p = explode('/', $rs->fields[kode_pendaftar]);
                        $value_arr[kode_pendaftar] = "P".date('my').'/'.sprintf('%03d', ($p[1]+1));
                }
                $value_arr[userid] = ereg_replace('[^0-9A-Za-z]', '', $value_arr[kode_pendaftar]);
                if (empty($value_arr[passwd])) $value_arr[passwd] = sprintf('%04d', rand(0,9999));

                $optional_arr['passwd']= 'user_defined';
                #$value_arr['passwd'] = '<input type="password" name="passwd" class="text">
                $value_arr['passwd'] = '<input type="text" name="passwd" class="text" value=\''.$value_arr[passwd].'\'>
                                                                <input type="hidden" name="olduser" value="'.$value_arr['userid'].'">
                                                                <input type="hidden" name="oldpasswd" value="'.$rsy->fields['passwd'].'">
                ';


                $optional_arr['userid']= 'user_defined';
                $value_arr['userid'] = '<input type="text" name="userid" class="text" value="'.$value_arr['userid'].'">';

		$optional_arr['kode_pendaftar_penyalur_rule'] = '';
		$optional_arr['nama_pendaftar_penyalur_rule'] = '';
		$optional_arr['alamat_pendaftar_penyalur_rule'] = '';
		$optional_arr['notelp_1_rule'] = '';
		$optional_arr['nama_propinsi_1_rule'] = '';
		$optional_arr['nama_pabrik_rule'] = '';
		$optional_arr['alamat_pabrik_rule'] = '';
		$optional_arr['notelp_2_rule'] = '';
		$optional_arr['nama_propinsi_2_rule'] = '';
		$optional_arr['alamat_bengkel_rule'] = '';
		$optional_arr['notelp_3_rule'] = '';
		$optional_arr['alamatgudang_rule'] = '';
		$optional_arr['notelp_4_rule'] = '';
		$optional_arr['nama_direktur_rule'] = '';
		$optional_arr['namapenanggungjwb_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';

		eval($this->save_config);

  		$this->nama_propinsi_1_form($config);
		$this->nama_propinsi_2_form($config);

		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['kode_pendaftar_penyalur']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Pemohon Izin Penyalur";
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

	// create update pendaftar_penyalur form
	function update_pendaftar_penyalur_form() {
		return $this->add_pendaftar_penyalur_form();
	}

	
	function import_pendaftar_penyalur_form() {
		$this->import_form();


//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		$field_arr[] = array ('name' => 'userfile');
		$optional_arr['userfile'] = 'user_defined';
		$value_arr['userfile'] = '<input class=text type=file name=userfile>';

		eval($this->save_config);
		$label_arr['userfile'] = 'Import File';
		$label_arr['submit_val'] = 'Import'; // default Submit
		$label_arr['form_extra'] = '<input type=hidden name=action value=postimport>'; // default null
		$label_arr['form_title'] = ('Import Pemohon Izin Penyalur'); // default null
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
	
	
	
	function import_form() {
		ini_set('max_execution_time', 0);
		if ($_POST[template]) {
			header("Content-type: text/comma-separated-values");
        	        header("Content-Disposition: attachment; filename=template_label.csv" );
                	header("Expires: 0");
	                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        	        header("Pragma: public");
			#echo '"kode_pendaftar_penyalur","nama_pendaftar_penyalur","alamat_pendaftar_penyalur","notelp_1","nama_propinsi_1","nama_pabrik","alamat_pabrik","notelp_2","nama_propinsi_2","alamat_bengkel","notelp_3","alamatgudang","notelp_4","nama_direktur","namapenanggungjwb"';
			echo '"nama_pendaftar_penyalur","alamat_pendaftar_penyalur","notelp_1","nama_propinsi_1","nama_pabrik","alamat_pabrik","notelp_2","nama_propinsi_2","alamat_bengkel","notelp_3","alamatgudang","notelp_4","nama_direktur","namapenanggungjwb"';
			exit;
		}
		if ($_POST[import]) {
			$uploaddir = '/tmp/';
			$file = $_FILES['csv_file']['tmp_name'];
			$fd = fopen($file, "r");
			$data = fgetcsv ($fd, 8000, ",");
			while ($data = fgetcsv ($fd, 8000, ",")) {
				$num = count ($data);
                                $num = count ($data);
                                foreach ($data as $k => $v) $data2[$k+1] = $v;
                                $data = $data2;
                                #$kode_pendaftar = $data[0];
				#$kode_pendaftar_penyalur = $data[0];
				$nama_pendaftar_penyalur = $data[1];
				$alamat_pendaftar_penyalur = $data[2];
				$notelp_1 = $data[3];
				$nama_propinsi_1 = $data[4];
				$nama_pabrik = $data[5];
				$alamat_pabrik = $data[6];
				$notelp_2 = $data[7];
				$nama_propinsi_2 = $data[8];
				$alamat_bengkel = $data[9];
				$notelp_3 = $data[10];
				$alamatgudang = $data[11];
				$notelp_4 = $data[12];
				$nama_direktur = $data[13];
				$namapenanggungjwb = $data[14];

				#if ($kode_pendaftar_penyalur=='') continue;

				global $ses;
				global $adodb;

                                // added by rudych
                                $rs = $adodb->Execute("SELECT kode_pendaftar_penyalur FROM pendaftar_penyalur WHERE kode_pendaftar_penyalur LIKE 'P".date('my')."%' ORDER BY kode_pendaftar_penyalur DESC LIMIT 1");
                                $p = explode('/', $rs->fields[kode_pendaftar_penyalur]);
                                $kode_pendaftar_penyalur = "P".date('my').'/'.sprintf('%03d', ($p[1]+1));
                                $userid = ereg_replace('[^0-9A-Za-z]', '', $kode_pendaftar_penyalur);
                                $passwd = sprintf('%04d', rand(0,9999));

				$record[kode_pendaftar_penyalur] = $kode_pendaftar_penyalur;
				$record[nama_pendaftar_penyalur] = $nama_pendaftar_penyalur;
				$record[alamat_pendaftar_penyalur] = $alamat_pendaftar_penyalur;
				$record[notelp_1] = $notelp_1;
				$record[nama_propinsi_1] = $nama_propinsi_1;
				$record[nama_pabrik] = $nama_pabrik;
				$record[alamat_pabrik] = $alamat_pabrik;
				$record[notelp_2] = $notelp_2;
				$record[nama_propinsi_2] = $nama_propinsi_2;
				$record[alamat_bengkel] = $alamat_bengkel;
				$record[notelp_3] = $no_telp3;
				$record[alamatgudang] = $alamatgudang;
				$record[notelp_4] = $notelp_4;
				$record[nama_direktur] = $nama_direktur;
				$record[namapenanggungjwb] = $namapenanggungjwb;
				$record[insert_by] = $ses->loginid;
				$record[date_insert] = time();
				$record[userid] = $userid;
				$record[passwd] = $passwd;
				$record[tpwd] = $passwd;

				$rs = $adodb->Execute("SELECT * FROM pendaftar_penyalur WHERE kode_pendaftar_penyalur = '".$kode_pendaftar_penyalur."'");
				if ($rs->fields[kode_pendaftar_penyalur]) {
					$adodb->Execute($adodb->GetUpdateSQL($rs, $record));
				} else {
					$adodb->Execute($adodb->GetInsertSQL($rs, $record));
				}

                                if ($rs) {
                                        $status = "Successfull Import '<b>{$record['kode_pendaftar_penyalur']} {$record[nama_pendaftar_penyalur]}</b>'";
                                        $this->log($status);
                                        echo $status."<br>";
                                } else {
                                        $status = "Failed Import '<b>{$record['kode_pendaftar_penyalur']} {$record[nama_pendaftar_penyalur]}</b>'";
                                        $this->log($status);
                                        echo $status."<br>";
                                }


				$kode_pendaftar_penyalur = '';
				$nama_pendaftar_penyalur = '';
				$alamat_pendaftar_penyalur = '';
				$notelp_1 = '';
				$nama_propinsi_1 = '';
				$nama_pabrik = '';
				$alamat_pabrik = '';
				$notelp_2 = '';
				$nama_propinsi_2 = '';
				$alamat_bengkel = '';
				$notelp_3 = '';
				$alamatgudang = '';
				$notelp_4 = '';
				$nama_direktur = '';
				$namapenanggungjwb = '';
				}
			}
		echo "
<html>
<head>
<title>Import Label Pemohon Izin Penyalur</title>
</head>
<body>
<div align=center>
<form method=post>
<input type=hidden name=action value=import>
<input type=submit name=template value='Get Template'>
</form>

<form method=post enctype='multipart/form-data'>
<input type=hidden name=action value=import>
<input type=file name=csv_file>
<input type=submit name=import value='Import'>
</form>
</div>
</body>
</html>
		";
		exit;
	}


	// handle event add pendaftar_penyalur
	function add_pendaftar_penyalur() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;
		foreach ($record as $k => $v) $record[$k] = trim($v);
		$record[tpwd] = $record[passwd];
		#if ($record['passwd']) $record['passwd'] = md5($record['passwd']);
		#else unset($record['passwd']);

		$rs = $adodb->Execute("SELECT * FROM pendaftar_penyalur WHERE kode_pendaftar_penyalur = '{$record['kode_pendaftar_penyalur']}'");
 		 if ($rs && ! $rs->EOF) {
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			#if(${$GLOBALS['post_vars']}['passwd'])
			#	{$record['passwd'] = md5(${$GLOBALS['post_vars']}['passwd']);}else
			#	{$record['passwd'] = ${$GLOBALS['post_vars']}['oldpasswd'];}
			$st = "Updated";
		} else {
			$record['insert_by'] = $ses->loginkode_pendaftar_penyalur;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM pendaftar_penyalur WHERE kode_pendaftar_penyalur = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		
		$status = "Successfull $st '<b>{$record['kode_pendaftar_penyalur']}</b>'";
		$this->log($status);
		
		$_block = new block();
		$_block->set_config('title', 'Status');
		$_block->set_config('Pemohon Penyalur', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}
	
	// handle event update pendaftar_penyalur
	function update_pendaftar_penyalur() {
		return $this->add_pendaftar_penyalur();
	}

	// handle delete pendaftar_penyalur
	function delete_pendaftar_penyalur() {
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
                        $success = $adodb->Execute("delete from pendaftar_penyalur where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'pendaftar_penyalur <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'pendaftar_penyalur <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Pemohon Izin Penyalur Status'));
                $_block->set_config('wkode_pendaftar_penyalurth', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list pendaftar_penyalur
	function list_pendaftar_penyalur($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'SELECT
		pendaftar_penyalur.kode_pendaftar_penyalur,
		pendaftar_penyalur.nama_pendaftar_penyalur,
		pendaftar_penyalur.npwp,
		pendaftar_penyalur.alamat_pendaftar_penyalur,
		pendaftar_penyalur.notelp_1,
		pendaftar_penyalur.nama_propinsi_1,
		pendaftar_penyalur.nama_pabrik,
		pendaftar_penyalur.alamat_pabrik,
		pendaftar_penyalur.notelp_2,
		pendaftar_penyalur.nama_propinsi_2,
		pendaftar_penyalur.alamat_bengkel,
		pendaftar_penyalur.notelp_3,
		pendaftar_penyalur.alamatgudang,
		pendaftar_penyalur.notelp_4,
		pendaftar_penyalur.nama_direktur,
		pendaftar_penyalur.namapenanggungjwb,
		pendaftar_penyalur.userid,
		pendaftar_penyalur.passwd,
		pendaftar_penyalur.date_insert,
		pendaftar_penyalur.insert_by
		FROM pendaftar_penyalur
		LEFT OUTER JOIN propinsi ON(propinsi.id = pendaftar_penyalur.nama_propinsi_1)
		';

		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'kode_pendaftar_penyalur' => TRUE,
			'nama_pendaftar_penyalur' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'kode_pendaftar_penyalur' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 600, 400, null, null, \'add_pendaftar_penyalur\');'.
			'win.focus()',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
			$add_anchor .= pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\''.$GLOBALS['PHP_SELF'] .
			'?action=import' .
			'\', 800, 600, null, null, \'import_pendaftar_penyalur\');'.
			'win.focus()',
			"title"=>__("Import").' Pemohon Izin Penyalur',
			"label"=>__("Import"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));

//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_pendaftar_penyalur\');'.
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
			'?action=del%s\', 600, 400, null, null, \'del_pendaftar_penyalur\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_pendaftar_penyalur\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->pendaftar_penyalur_label;
		$config = array (
			'kode_pendaftar_penyalur'		=> 'pendaftar_penyalur',
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
			'form_wkode_pendaftar_penyalurth'	=> 595,
			'form_title'	=> __('List').' Pemohon Izin Penyalur'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print pendaftar_penyalur
	function print_pendaftar_penyalur() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_pendaftar_penyalur($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$pendaftar_penyalur_controller = new pendaftar_penyalur_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $pendaftar_penyalur_controller->add_pendaftar_penyalur_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $pendaftar_penyalur_controller->add_pendaftar_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $pendaftar_penyalur_controller->update_pendaftar_penyalur_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $pendaftar_penyalur_controller->update_pendaftar_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'del':
			$out_content = $pendaftar_penyalur_controller->delete_pendaftar_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $pendaftar_penyalur_controller->import_pendaftar_penyalur_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $pendaftar_penyalur_controller->import_pendaftar_penyalur();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $pendaftar_penyalur_controller->print_pendaftar_penyalur();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $pendaftar_penyalur_controller->list_pendaftar_penyalur();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Pemohon Izin Penyalur Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>

<?php

if (defined('CLASS_DBASE_CONVERTER')) { return 0;} 
else { define('CLASS_DBASE_CONVERTER', TRUE); }

if (! function_exists('dbase_open')) {
	if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') dl('dbase.dll');
	else dl('dbase.so');
}

if (! function_exists(ADONewConnection)) die('Load ADOdb failed!');

// find writeable directory
$SSA = ini_get('session.save_path');
$SSP = $SSA;
if (strlen($SSP) > 1 && substr($SSP, -1) == $file_separator) $SSP = substr($SSP, 0, -1);
$SA = 0;
$SB = ord('c')-1;
if (strstr(strtolower(PHP_OS), 'win')) {
	while (! is_writeable($SSP) && ($SB != ord('z') || $SA & 1)) {
		if ($SA & 1) $SD = 'windows';
		else {
			$SD = 'winnt';
			$SB++;
		}
		$SSP = chr($SB).':\\'.$SD.'\\temp';
		$SA++;
	}
}
if (is_writeable($SSP)) {
	$ADODB_CACHE_DIR = $SSP;
	if (! ini_set('session.save_path', $SSP)) {
		die('Sets the value of a configuration option is FAILED.');
	}
	$SSP = '';
} else {
	die(
		'session.save_path in php.ini not writeable.'.'<br>'."\n".
		'session.save_path = '.$SSA.';'
	);
}

if (eregi('^win', PHP_OS)) {
	$include_separator = ';';
	$file_separator = '\\';
} else if (eregi('^linux', PHP_OS)) {
	$include_separator = ':';
	$file_separator = '/';
}

class dbase_converter {
	var $adodb;
	var $adodb_dict;
	var $dest_host;
	var $dest_user;
	var $dest_pass;
	var $dest_name;
	var $dbase_skip_delete;
	var $dbase_create_table;
	var $dbase_delete_data;
	var $dbase_limit;
	var $dbase_flag = 0;
	
	// define
	var $DBASE_READ_ONLY = 0;
	var $DBASE_WRITE_ONLY = 1;
	var $DBASE_READ_WRITE = 2;
	var $dbase_debug;
	var $adodb_debug;
	var $smbmount;
	var $smbumount;
	var $mount;
	var $umount;
	var $tmp_mount;
	
	// constructor
	function dbase_converter($config) {
		// dsn format mysql://user:pass@hostname/dbname
		if (ereg('^([^:]+)://([^:]+):([^@]*)@([^/]+)/(.*)$', $config['dest_dsn'], $regs)) {
			$config['dest_type'] = $regs[1];
			$config['dest_host'] = $regs[4];
			$config['dest_user'] = $regs[2];
			$config['dest_pass'] = $regs[3];
			$config['dest_name'] = $regs[5];
		}
		$this->load_file = $config['load_file'] ? $config['load_file'] : TRUE;
		$this->dest_type = $config['dest_type'];
		$this->dest_host = $config['dest_host'];
		$this->dest_user = $config['dest_user'];
		$this->dest_pass = $config['dest_pass'];
		$this->dest_name = $config['dest_name'];
		$this->dbase_skip_delete = $config['dbase_skip_delete'] ? $config['dbase_skip_delete'] : TRUE;
		$this->dbase_limit = $config['dbase_limit'] ? $config['dbase_limit'] : FALSE;
		$this->dbase_debug = $config['dbase_debug'] ? $config['dbase_debug'] : FALSE;
		$this->adodb_debug = $config['adodb_debug'] ? $config['adodb_debug'] : FALSE;
		$this->dbase_create_table = $config['dbase_create_table'] ? $config['dbase_create_table'] : TRUE;
		$this->dbase_delete_data = $config['dbase_delete_data'] ? $config['dbase_delete_data'] : TRUE;
		
		$adodb = &ADONewConnection($this->dest_type); // load module driver
		$adodb->PConnect($this->dest_host, $this->dest_user, $this->dest_pass, $this->dest_name);
		$adodb->debug = $this->adodb_debug; // set false when publish
		$adodb_dict =& NewDataDictionary($adodb);
		$this->adodb = $adodb;
		$this->adodb_dict = $adodb_dict;
		$this->smbmount = 'smbmount';
		$this->smbumount = 'smbumount';
		$this->mount = '[smbmount] '.
			'//[smb_host]/[smb_share] '.
			'[smb_mount] '.
			'-o username=[smb_user],password=[smb_pass],'.
			'debug=0,ro ';
		$this->umount = '[smbumount] '.
			'[smb_mount] ';
	}
	
	function get_mount($dbase_file, $user='', $pass='') {
		if (ereg('^smb://([^:]+):([^@]*)@([^/]+)/([^/]+)/(.*)$', $dbase_file, $regs)) {
			$user = $regs[1];
			$pass = $regs[2];
			$host = $regs[3];
			$share = $regs[4];
			$path = $regs[5];
		} else if (ereg('^smb://([^/]+)/([^/]+)/(.*)$', $dbase_file, $regs)) {
			$host = $regs[1];
			$share = $regs[2];
			$path = $regs[3];
		}
		
		if ($host && $share && $path) {
			$file = basename($path);
			$dir = str_replace($file, '', $path);
        		
			srand((double)microtime()*1000000);
		        $mount = '/tmp/'.md5(rand());
		        if (! is_dir($mount)) mkdir ($mount, 0700);
			$this->tmp_mount = $mount;
			if (empty($user)) $user = 'guest';
			$str = $this->mount;
			$str = str_replace('[smbmount]', $this->smbmount, $str);
			$str = str_replace('[smb_host]', $host, $str);
			$str = str_replace('[smb_share]', $share, $str);
			$str = str_replace('[smb_mount]', $mount, $str);
			$str = str_replace('[smb_user]', $user, $str);
			$str = str_replace('[smb_pass]', $pass, $str);

			popen($str, 'r');

			return $mount.'/'.$dir.$file;
		} else {
			die ('Error Format smb://');
		}
	}

	function get_umount() {
		$mount = $this->tmp_mount;
		
		$str = $this->umount;
		$str = str_replace('[smbumount]', $this->smbumount, $str);
		$str = str_replace('[smb_mount]', $mount, $str);
	
		popen($str, 'r');
		
		rmdir ($mount);
	}
	
	// get microtime
	function getmicrotime(){
		list($usec, $sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	}
	
	// convert directory
	function convert_dir($dirname) {
		global $file_separator, $include_separator;
		if ($dir = @opendir($dirname)) {
			while (($file = readdir($dir)) !== FALSE) {
				$full_path = "$dirname$file_separator$file";
				if ($file != '.' && $file != '..' && is_dir($full_path)) $this->convert_dir("$full_path");
				if (stristr($file, '.dbf')) {
					$this->convert_file($full_path);
				}
			}
			closedir($dir);
		}
	}	
	
	// convert file
	function convert_file($filename) {
		global $ADODB_CACHE_DIR, $file_separator, $include_separator;
		
		$total_start_exec = dbase_converter::getmicrotime();
		$dbase_start_exec = dbase_converter::getmicrotime();
		
		if (ereg('smb://', $filename)) {
			$dbase_file = $this->get_mount($filename);
		} else {
			$dbase_file = $filename;
		}
		
		$dbase_flag = $this->dbase_flag;
		$dbase_limit = $this->dbase_limit;
		$dbase_skip_delete = $this->dbase_skip_delete;
		
		// initialize
		if (! is_file($dbase_file)) {
			echo ("$dbase_file is not a file");
			return FALSE;
		}
		$dbase_conn = dbase_open($dbase_file, $dbase_flag);
		$dbase_nf = dbase_numfields($dbase_conn);
		$dbase_nr = dbase_numrecords($dbase_conn);
		if ($dbase_limit) $dbase_nr = $dbase_limit;
		$dbase_filename = substr($dbase_file, strrpos($dbase_file, $file_separator)+1);
		$dbase_name = substr($dbase_filename, 0, strpos($dbase_filename, "."));

		$tmp = $ADODB_CACHE_DIR;
		$fs = $file_separator;
		$dbase_dir = getcwd();
		$dbase_sql = str_replace('/', $fs, $tmp.'/'.$dbase_name.'.sql');
		$fp = fopen ($dbase_sql, "wb");
		
		for ($dbase_index=0;$dbase_index<$dbase_nr;$dbase_index++) {
			$dbase_record =& dbase_get_record_with_names($dbase_conn, $dbase_index);
			foreach ($dbase_record as $k => $v) {
				$strlen[$k] = max($strlen[$k], strlen($v)) ;
			}
			if ($dbase_record['deleted']) {
				$dbase_delete_count++;
				if ($dbase_skip_delete) continue;
			}
			fwrite($fp, implode("\t", $dbase_record)."\n");
		}
		fclose($fp);
		if ($dbase_nr) {
		  switch ($this->dest_type) {
		    case 'mysql':
			$sql_query_arr[] = 'LOAD DATA INFILE \''.$dbase_sql.'\' INTO TABLE '.$dbase_name;
			break;
		    case 'postgres':
			$sql_query_arr[] = 'COPY '.$dbase_name.' FROM \''.$dbase_sql.'\' ';
			break;
		  }
		}

		$dbase_record =& dbase_get_record_with_names($dbase_conn, 0);
		foreach ($dbase_record as $key => $value) {
			$dbase_field[$index][name] = $key;
			$dbase_field[$index][length] = $strlen[$key];
			switch ($this->dest_type) {
			  case 'mysql':
				$key = "`$key`";
				break;
			  case 'postgres':
				$key = "\"$key\"";
				break;
			}
			if ($dbase_ddl_table) $dbase_ddl_table .= ",\n";
			if (! strstr($key, 'deleted')) {
				$dbase_field_name[$index] = $key;
				$dbase_ddl_table .= "\t$key varchar({$dbase_field[$index][length]})";
				$fldarray[] = array("$key", 'C', $dbase_field[$index][length], 'default'=>'', 'notnull');
				$index++;
			}
		}
		dbase_close($dbase_conn);

		// calculate time process
		$dbase_stop_exec = dbase_converter::getmicrotime();
		$dbase_proc_exec = $dbase_stop_exec - $dbase_start_exec;

		## START CREATE TABLE AND INSERT DATA
		$sql_start_exec = dbase_converter::getmicrotime();
		if ($dbase_field_name) $sql_key = "(".implode(", ", $dbase_field_name).")";
		if ($this->dbase_create_table) {
			$sql_ddl_table_drop = "DROP TABLE $dbase_name";
			$this->adodb->Execute($sql_ddl_table_drop);
			$sqlarray = $this->adodb_dict->CreateTableSQL($dbase_name, $fldarray);
			$this->adodb_dict->ExecuteSQLArray($sqlarray);
		}
		if ($this->dbase_delete_data) {
			$sql_query_delete = "DELETE FROM $dbase_name";
			$this->adodb->Execute($sql_query_delete);
		}
		$sql_query_arr[] = '';
		foreach ($sql_query_arr as $k => $v) {
			if (! $v) continue;
			$this->adodb->Execute($v);
			$sql_error .= $this->adodb->ErrorMsg();
		}
		unlink($dbase_sql);
		## FINISH OF CREATE TABLE AND INSERT DATA

		// calculate time process
		$sql_stop_exec = dbase_converter::getmicrotime();
		$sql_proc_exec = $sql_stop_exec - $sql_start_exec;
			
		// calculate total time
		$total_stop_exec = dbase_converter::getmicrotime();
		$total_proc_exec = $total_stop_exec - $total_start_exec;

		// information for develope only
		$info['filename'] = $dbase_file;
		$info['total_fields'] = $dbase_nf;
		$info['total_records'] = $dbase_nr;
		$info['total_delete'] = $dbase_delete_count;
		if ($dbase_field_name) $info['field_name'] = implode(", ", $dbase_field_name);
		$info['dbase_prcoess'] = $dbase_proc_exec;
		$info['sql_process'] = $sql_proc_exec;
		$info['total_process'] = $total_proc_exec;
		$info['sql_error'] = $sql_error;

		$this->info = $info;
		if ($this->dbase_debug) print_r($this->info);

		if (ereg('smb://', $filename)) {
			$this->get_umount();
		}
	}
}

?>

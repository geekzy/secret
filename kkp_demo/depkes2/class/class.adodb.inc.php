<?php
	if (defined('CLASS_ADODB_INC')) {
		return 0;
	} else {
		define('CLASS_ADODB_INC', TRUE);
	}

	// set include_path
	//ini_set('include_path', '../adodb');
		  
	include ('adodb.inc.php');
	// or include ('../adodb/adodb.inc.php');
	
	// database configuration
	global $adodb_type, $adodb_host, $adodb_user, $adodb_pass, $adodb_name;

	$adodb_type = 'postgres7';
	$adodb_host = '192.168.104.26';
	$adodb_user = 'root';
	$adodb_pass = '';
	$adodb_name = 'depkes2';
	
	$adodb = &ADONewConnection($adodb_type); // load module driver
	$adodb->PConnect($adodb_host, $adodb_user, $adodb_pass, $adodb_name);
	$adodb->debug = FALSE; // set false when publish
	
	// other option ADODB_FETCH_NUM, default ADODB_FETCH_BOTH
	// or ADODBO_FETCH_DEFAULT
	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	
	
	if (! $adodb) {
		echo $adodb->ErrorMsg();
		exit;
	}

	// testing select
	/*
	$adodb2 = &ADONewConnection('mysql');
	$adodb2->PConnect('localhost', 'root', '', 'mysql');
	$recordSet2 = $adodb2->Execute('select * from user');
	echo '<pre>';
	print_r ($recordSet2->GetRows());
	echo '</pre>';
	*/
	
	// optional closing connection
	// $adodb->Close();
	// $recordSet->Close();
?>

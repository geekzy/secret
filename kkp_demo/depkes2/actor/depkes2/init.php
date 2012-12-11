<?php

	if (defined('INTERFACE_DEPKES2_INIT')) {
		return 0;
	} else {
		define('INTERFACE_DEPKES2_INIT', TRUE);
	}
		
	chdir('..');
	chdir('..');
	include('init.php');

	// set include_path
	$include_path = ini_get('include_path');
	$include_path .= ereg_replace(':', $include_separator, ':actor/depkes2');
	$include_path = ereg_replace('/', $file_separator, $include_path);
	ini_set('include_path', $include_path);
	
	$root_path = '../..';
	$old_path_theme = $path_theme;
	$path_theme = '../../'.$path_theme;
	$old_path_phplayersmenu = $path_phplayersmenu;
	$path_phplayersmenu = '../../'.$path_phplayersmenu;
	$depkes2_manager->depkes2_dir = '';

	$md5_js = ereg_replace($old_path_theme, $path_theme, $md5_js);
	$chromeless_js = ereg_replace($old_path_theme, $path_theme, $chromeless_js);
	$calendar_js = ereg_replace($old_path_theme, $path_theme, $calendar_js);
	$phplayersmenu_js = ereg_replace($old_path_phplayersmenu, $path_phplayersmenu, $phplayersmenu_js);
?>
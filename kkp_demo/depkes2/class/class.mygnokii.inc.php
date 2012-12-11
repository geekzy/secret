<?php

require_once 'class.hp_prefs.inc.php';
require_once 'class.sms_inbox.inc.php';
require_once 'class.sms_outbox.inc.php';
require_once 'class.sms_queue.inc.php';
require_once 'class.service.inc.php';
require_once 'class.service_manager.php';

// check already defined or not
if (class_exists('mygnokii')) {
	return 0;
} else if (defined('CLASS_MYGNOKII')) {
	return 0;
} else {
	define('CLASS_MYGNOKII', TRUE);
}

class mygnokii {
	var $hp_code;
	var $basic_command;
	var $identify_format; // show the most important phone data
	var $monitor_format; // get phone status
	var $reset_format; // reset phone
	var $cancelcall_format; // cancel incoming call
	var $getallsms_format; // get all sms
	var $deletesms_format; // delete sms
	var $sendsms_format; // send sms
	var $sendsms_text_format; // send sms text
	var $sendsms_ringtone_format; // send sms ringtone
	var $sendsms_operator_format; // send sms operator logo
	var $sendsms_caller_format; // send sms caller logo
	var $sendsms_picture_format; // send sms picture
	var $sendsms_emssound_format; // send sms ems sound
	var $sendsms_emsanimation_format; //send sms ems animation
	var $sendsms_emsbitmap_format; //send sms ems bitmap
	var $backup_format; // back non-sms setting
	var $restore_format; // restore non-sms setting
	var $backupsms_format; // back sms
	var $restoresms_format; // restore sms
	var $getsmsc_format; // get sms center
	var $sms_center; // sms center
	var $log_file; // log file
	var $simulation_inbox; // check whether inbox simulation
	var $simulation_send; // check whether send simulation
	var $simulation_access;
	var $sim_arr; // simulation record
	
	// constructor
	function mygnokii($cf='') {
		$this->simulation_inbox = $cf['simulation_inbox'] ? $cf['simulation_inbox'] : FALSE;
		$this->simulation_send = $cf['simulation_send'] ? $cf['simulation_send'] : FALSE;
		$this->simulation_access = $cf['simulation_access'] ? $cf['simulation_access'] : FALSE;
		$this->sim_arr = $cf['sim_arr'] ? $cf['sim_arr'] : FALSE;
		$this->hp_code = $cf['hp_code'] ? $cf['hp_code'] : '1';
		$this->basic_command = $cf['basic_command'];

		$BA = $this->basic_command;
		$BC = $BA;
		$BC = trim(str_replace('%s', '', $BC));
		if (! file_exists($BC) || ! $BC) {
			if (strstr(strtolower(PHP_OS), 'win')) {
				$BC = 'server\\win32\\gammu.exe';
			} else {
				$BC = './server/linux/gammu';
			}
			if (! file_exists($BC)) {
				die('Missing wrapper file at "'.$BA.'" !');
			}
		}

		$this->basic_command = $BC.' %s';
				
		$this->identify_format = $cf['identify_format'] ? sprintf($this->basic_command, $cf['identify_format']) : sprintf($this->basic_command, '--identify');
		$this->monitor_format = $cf['monitor_format'] ? sprintf($this->basic_command, $cf['monitor_format']) : sprintf($this->basic_command, '--monitor');
		$this->reset_format = $cf['reset_format'] ? sprintf($this->basic_command, $cf['reset_format']) : sprintf($this->basic_command, '--reset %s');
		$this->cancelcall_format = $cf['cancelcall_format'] ? sprintf($this->basic_command, $cf['cancelcall_format']) : sprintf($this->basic_command, '--cancelcall');
		$this->getallsms_format = $cf['getallsms_format'] ? sprintf($this->basic_command, $cf['getallsms_format']) : sprintf($this->basic_command, '--getallsms');
		$this->deletesms_format = $cf['deletesms_format'] ? sprintf($this->basic_command, $cf['deletesms_format']) : sprintf($this->basic_command, '--deletesms %s %s');
		$this->sendsms_text_format = $cf['sendsms_text_format'] ? sprintf($this->basic_command, $cf['sendsms_text_format']) : sprintf($this->basic_command, '--sendsms TEXT %s < %s');
		$this->sendsms_ringtone_format = $cf['sendsms_ringtone_format'] ? sprintf($this->basic_command, $cf['sendsms_ringtone_format']) : sprintf($this->basic_command, '--sendsms RINGTONE %s %s');
		$this->sendsms_operator_format = $cf['sendsms_operator_format'] ? sprintf($this->basic_command, $cf['sendsms_operator_format']) : sprintf($this->basic_command, '--sendsms OPERATOR %s %s');
		$this->sendsms_caller_format = $cf['sendsms_caller_format'] ? sprintf($this->basic_command, $cf['sendsms_caller_format']) : sprintf($this->basic_command, '--sendsms CALLER %s %s');
		$this->sendsms_picture_format = $cf['sendsms_picture_format'] ? sprintf($this->basic_command, $cf['sendsms_picture_format']) : sprintf($this->basic_command, '--sendsms PICTURE %s %s');
		$this->sendsms_emssound_format = $cf['sendsms_emssound_format'] ? sprintf($this->basic_command, $cf['sendsms_emssound_format']) : sprintf($this->basic_command, '--sendsms EMSSOUND %s -file %s');
		$this->sendsms_emsanimation_format = $cf['sendsms_emsanimation_format'] ? sprintf($this->basic_command, $cf['sendsms_emsanimation_format']) : sprintf($this->basic_command, '--sendsms EMSANIMATION %s -file %s');
		$this->sendsms_emsbitmap_format = $cf['sendsms_emsbitmap_format'] ? sprintf($this->basic_command, $cf['sendsms_emsbitmap_format']) : sprintf($this->basic_command, '--sendsms EMSBITMAP %s %s');
		$this->backup_format = $cf['bakup_format'] ? sprintf($this->basic_command, $cf['backup_format']) : sprintf($this->basic_command, '--backup %s');
		$this->restore_format = $cf['restore_format'] ? sprintf($this->basic_command, $cf['restore_format']) : sprintf($this->basic_command, '--restore %s');
		$this->backupsms_format = $cf['backupsms_format'] ? sprintf($this->basic_command, $cf['backupsms_format']) : sprintf($this->basic_command, '--backupsms %s');
		$this->restoresms_format = $cf['restoresms_format'] ? sprintf($this->basic_command, $cf['restoresms_format']) : sprintf($this->basic_command, '--restoresms %s');
		$this->getsmsc_format = $cf['getsmsc_format'] ? sprintf($this->basic_command, $cf['getsmsc_format']) : sprintf($this->basic_command, '--getsmsc 1');
		
	}
	
	function split_sms_smart($all_part, $max_part=160, $digit=1) {
		$real_part = $all_part;
		$sms_length = strlen($all_part);
		if ($digit > 0) {
			$ndigit = str_pad('', $digit, "n");
		}
		$curr_part = 1;
		$is_finished = FALSE;
		
		while (! $is_finished) {
			// header of sms
			if ($digit > 0) {
				$header = $curr_part.'/'.$ndigit."\n";
				$end_part = ($max_part-strlen($header));
			} else {
				$header = '';
				$end_part = $max_part;
			}
			
			// temporary replace # coz we need separator #
			$tmp = $all_part;
			$tmp = str_replace('#', 'n', $tmp);
			
			// find first wordwrap
			$tmp = wordwrap($tmp, $end_part, "#", 1);
			$end_wrap = strpos($tmp, '#');
			if (intval($end_wrap)==0) $end_wrap = $end_part;
			$curr_sms = substr($all_part, 0, $end_wrap);
			$end_part = strlen($curr_sms);

			// cut content
			$all_part = substr($all_part, $end_part, $sms_length);
			$sms_length = strlen($all_part);
			
			// bundle part
			$curr_sms = trim($curr_sms);
			$curr_sms = $header.$curr_sms;
			if ($GLOBALS['infosms_signature']) {
				$curr_sms .= "\n".$GLOBALS['infosms_signature'];
			}
			$sms_content[] = $curr_sms;
			
			// check finish
			if ($sms_length == 0) $is_finished = TRUE;
			else $curr_part++;
		}
		
		if ($digit > 0) {
			foreach ($sms_content as $k => $v) {
				$v = ereg_replace('(^[0-9]+/)'.$ndigit.'(.*)$', "\\1".$curr_part."\\2", $v);
				if (strlen($v)>160) $split_again = TRUE;
				else $sms_content[$k] = $v;
			}
		}
		
		if ($split_again) {
			$digit++;
			return $this->split_sms_smart($real_part, $max_part, $digit);
		} else {
			return $sms_content;
		}
	}
	
	function split_sms_normal($all_part, $max_part, $digit=1) {
		for ($i=0;$i<$sms_part;$i++) {
			$end_part = ($i+1) * $max_part;
			$curr_sms = substr($all_part, $start_part, $end_part);
			if ($GLOBALS['infosms_signature']) {
				$curr_sms .= "\n".$GLOBALS['infosms_signature'];
			}
			$sms_content[] = $curr_sms;
			$start_part = $end_part;
		}
		return $sms_content;
	}	
	
	function sendsms($sms) {
		cl_debug('[START] mygnokii::sendsms('.$record['remote_number'].') = '.$sms_status."\n");

		global $ADODB_CACHE_DIR;
		global $include_separator, $file_separator, $include_path;		
								
		// trim \r
		$sms['content'] = preg_replace("/\r/", "", $sms['content']);
		
		$sms_content = $sms['content'];
		$sms_to = $sms['destination'];
		
		// check number, message
		if (! $sms_to || ! $sms_content) {
			cl_debug('[FINISH] mygnokii::sendsms('.$record['remote_number'].') = '.$sms_status."\n");
			return FALSE;
		}
		
		// default: type:text, report:yes
		$sms['type'] = $sms['type'] ? $sms['type'] : 'TEXT';
		$sms['report'] = (isset($sms['report'])) ? $sms['report'] : TRUE;
		
		// if linked then no split, if split then split, default no split
		$sms['split'] = $sms['linked'] ? FALSE : ((isset($sms['split'])) ? $sms['split'] : FALSE);
		
		// set sms command
		switch ($sms['type']) {
			case 'TEXT': 
				$command = $this->sendsms_text_format;
				break;
			case 'RINGTONE':
				$command = $this->sendsms_ringtone_format;
				break;
			case 'OPERATOR':
				$command = $this->sendsms_operator_format;
				break;
			case 'CALLER':
				$command = $this->sendsms_caller_format;
				break;
			case 'PICTURE':
				$command = $this->sendsms_picture_format;
				break;
			case 'EMSSOUND':
				$command = $this->sendsms_emssound_format;
				break;
			case 'EMSANIMATION':
				$command = $this->sendsms_emsanimation_format;
				break;
			case 'EMSBITMAP':
				$command = $this->sendsms_emsbitmap_format;
				break;
			default:
				cl_debug('[FINISH] mygnokii::sendsms('.$record['remote_number'].') = '.$sms_status."\n");
				return FALSE;
		}
		
		// set flash sms command
		if ($sms['flash']) {
			$command = sprintf($command, '%s -flash', '%s');
		}
		
		// set report sms command
		if ($sms['report']) {
			$command = sprintf($command, '%s -report', '%s');
		}
		
		$simulation_c = $this->get_value('simulation_c');
		$sMailFrom = $this->get_value('mail_from');
		$sMailTo = $this->get_value('mail_to');
		switch ($simulation_c) {
			case 'm3access':
				$this->simulation_send = TRUE;
				$this->simulation_access = 'm3access';
				break;
			case 'satelindogsm':
				$this->simulation_send = TRUE;
				$this->simulation_access = 'satelindogsm';
				break;
			case 'any':
				$this->simulation_send = TRUE;
				$this->simulation_access = 'any';
				break;
			case 'no':
			default:
				$this->simulation_send = FALSE;
				$this->simulation_access = 'any';
				break;
		}
		
		$result = FALSE;
		$sms_ok = FALSE;
		if ($this->simulation_send) {
			$include_path .= ereg_replace(':', $include_separator, ':sms_web_sender');
			ini_set('include_path', $include_path);
			$prefix = substr($sms_to, 0, 3); // +62
			$number = substr($sms_to, 3); // 8128486425
			$message = $sms_content; // test sms
			$this->log_it("[sendsms.php] ");
			
			switch ($this->simulation_access) {
				case 'm3access':
					if (file_exists('sms_web_sender/sendsms.php')) {
						echo "\n";
						require 'sendsms.php';
						echo "\n\n";
					} else {
						$result = TRUE;
					}
					break;
				case 'satelindogsm':
					$to = $sMailTo;
					$subject = "ESMSis";
					$headers = "From: $sMailFrom\r\n";
					mail($to, $subject, $message, $headers);
					break;
				default:			
					$result = TRUE;
					break;
			}
			
			//$this->log_it($result."\n");
			
			// check result
			if ($result) {
				$sms_status = 'Sending OK';
				$sms_ok = TRUE;
			} else {
				$sms_status = 'Sending ERROR';
			}
		} else {
			if ($sms['split'] && $sms['type'] == 'TEXT') {
				$sms_ok = FALSE;
							
				$sms_length = strlen($sms_content); // set how many length
				$max_part = 160;
				if ($GLOBALS['infosms_signature']) {
					$max_part -= strlen($GLOBALS['infosms_signature']);
				}
				$sms_part = ceil($sms_length / $max_part); // set how many part
				$start_part = 0;
	
				if ($this->get_value('sms_number_c') && $sms_part > 1) {
					$sms_content = $this->split_sms_smart($sms_content, $max_part);
				} else {
					$sms_content = $this->split_sms_smart($sms_content, $max_part, 0);
				}				
						
				foreach ($sms_content as $k => $v) {
					$newsms = $sms;
					$newsms['content'] = $sms_content[$k];
					$newsms['split'] = FALSE;
					$newsms['continue'] = TRUE;
						
					$loop_send = TRUE;
					while ($loop_send && $this->status_daemon()) {
						ini_set('max_execution_time', 300); // 5 minutes
						$loop_send = ! $this->sendsms($newsms);
					}
				}
				
				$sms_ok = TRUE;
				$sms_status = 'All OK';

			} else {
				$sms_ok = FALSE;
		
				// random filename
				srand((double)microtime()*1000000);
				$temp_filename = $ADODB_CACHE_DIR.'/'.md5(rand()).'.txt';
				$temp_filename = ereg_replace('/', $file_separator, $temp_filename);
				
				// create file
				$fp = fopen($temp_filename, 'w');
				fwrite($fp, $sms_content);
				fclose($fp);
				
				// send sms
				$command = sprintf($command, $sms_to, $temp_filename);
				$this->log_it("[sendsms] \n");
				$result = $this->run_command($command);
				$this->log_it("[result] ".$result."\n");
				
				// delete file
				unlink($temp_filename);
				
				// check result
				if (ereg('Sending SMS.*OK', $result)) {
					$sms_status = 'Sending OK';
					$sms_ok = TRUE;
				} else {
					$sms_status = 'Sending ERROR';
				}
			}
		}

		// prepare record
		$record['remote_number'] = $sms_to;
		$record['sent_date'] = time();
		$record['content'] = $sms['content'];
		$record['delivery_status'] = $sms_status;
		$record['type'] = $sms['type'];
		$record['delivery_id'] = $sms['delivery_id'];
		$record['hp_code'] = $this->hp_code;
			
		// send to queue
		if (! $sms_ok) {
			// handle next queue
			if (! $GLOBALS['next_sent']) {
				$GLOBALS['next_sent'] = 30; // 30 sec
			}
			$record['sent_date'] += $GLOBALS['next_sent'];
			//sms_queue::insert($record);
			global $adodb;
			$adodb->Execute('UPDATE sms_queue SET sent_date=\''.$record['sent_date'].'\', status = 0 WHERE remote_number=\''.$record['remote_number'].'\' AND delivery_id=\''.$record['delivery_id'].'\'');
			
			$this->log_it("[insert_queue]...\n");
			
			// send to outbox
		} else {
			
			if ($sms['continue'] || $this->simulation_send) {
				srand(((double)microtime())*1000000);
				$record['sent_date'] += rand(-60,60);
				sms_outbox::insert($record);
				$this->log_it("[insert_outbox] ...\n");
			}
			if (! $sms['continue']) {
				global $adodb;
				$adodb->Execute('DELETE FROM sms_queue WHERE remote_number=\''.$record['remote_number'].'\' AND delivery_id=\''.$record['delivery_id'].'\'');
			}
		}

		cl_debug('[FINISH] mygnokii::sendsms('.$record['remote_number'].') = '.$sms_status."\n");
		return $sms_ok;
	}
		
	// identify phone
	function identify() {
		$command = $this->identify_format;
		$contents = $this->run_command($command);
		$this->log_it("[identify] ".$contents."\n");
		$this->insert_prefs($contents);
		cl_debug('mygnokii::identify() '."\n");
	}
	
	// log system
	function log_it($str) {
		fwrite($this->log_file, date("[Y-m-d H:i:s]")." ".$str);
		fflush($this->log_file);
	}
	
	// cancel incoming call
	function cancelcall() {
		$command = $this->cancelcall_format;
		$contents = $this->run_command($command);
		//$this->log_it("[cancelcall] ".$contents."\n");
	}
	
	// insert preference
	function insert_prefs($contents) {
		$pieces = explode("\n", $contents);
		foreach ($pieces as $key => $value) {
			$fields = explode(":", $value, 2);
			if ($fields[0] && $fields[1]) {
				$prefkey = trim($fields[0]);
				$prefvalue = trim($fields[1]);
				
				$record['hp_code'] = $this->hp_code;
				$record['prefkey'] = $prefkey;
				$record['prefvalue'] = $prefvalue;
				if (! hp_prefs::get($record)) {
					hp_prefs::insert($record);
				} else {
					hp_prefs::update($record);
				}
			}
		}
		$this->log_it("[update_prefs] ...\n");
	}
		
	// run command
	function run_command($command) {
		// clean port
		//$nyapu=`stty --file=/dev/ttyS0 500:5:cbd:8a3b:3:1c:7f:15:4:0:1:0:11:13:1a:0:12:f:17:16:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0`;
		if ($GLOBALS['count_error2'] % 5 == 0) {
			$record['hp_code'] = $this->hp_code;
			$record['prefkey'] = 'count_error';
			$record['prefvalue'] = $GLOBALS['count_error'];
			if (! hp_prefs::get($record)) {
				hp_prefs::insert($record);
			} else {
				hp_prefs::update($record);
			}
		}
		$GLOBALS['count_error2']++;		
		
		ini_set('max_execution_time', 300); // 5 minutes
		$start_exec = time();
		$fp = popen($command, 'r');
		$contents = '';
		while (! feof($fp)) {
			$content = fgets($fp, 4096);
			$contents .= $content;
		}
		pclose($fp);
		if (eregi('No response in specified timeout\. Probably phone not connected\.', $contents)) {
			//$contents = '';
			$error = TRUE;
		} else if (eregi('Error opening device\. Unknown or busy device\.', $contents)) {
			//$contents = '';
			$error = TRUE;
		} else if (eregi('Unknown response from phone\. See /readme, how to report it', $contents)) {
			//$contents = '';
			$error = TRUE;
		} else if (eregi('Error opening device. Some hardware not connected/wrong configured.', $contents)) {
			$error = TRUE;
		} else if (eregi('Permission to file/device required', $contents)) {
			die('Super User required to run this program.'.'<br>'."\n".$contents);
		}

		if ($error) {
			$GLOBALS['count_error']++;
		} else {
			$GLOBALS['count_error'] = 0;
		}

		return $contents;
	}
	
	// monitor phone
	function monitor() {
		$command = $this->monitor_format;
		$contents = $this->run_command($command);
		$this->log_it("[monitor] ".$contents."\n");
		$this->insert_prefs($contents);
	}
	
	// get all sms on phone
	function getallsms() {
		
		// initialize
		ini_set('max_execution_time', 300); // 1 minute 30 seconds
		
		$content = '';
		$sms_arr = array();
		$allsms_arr = array();
		
		//if ($this->simulation_inbox) {
		if ($this->get_value('inbox_c')) {
			if (count($this->sim_arr) == 0) {
				$default = array ('location' => '0', 'folder' => 'Inbox', 'type' => 'message', 'smsc_number' => '+62855000000', 'coding' => 'Default GSM alphabet', 'status' => 'UnRead');
				global $adodb;
				$rs = $adodb->Execute('SELECT * FROM sim_arr');
				while (! $rs->EOF) {
					$csa = count($allsms_arr);
					$allsms_arr[$csa] = $default;
					$allsms_arr[$csa]['sent_date'] = time();
					$allsms_arr[$csa]['remote_number'] = $rs->fields['remote_number'];
					$allsms_arr[$csa]['content'] = $rs->fields['content'];
					$adodb->Execute('DELETE FROM sim_arr WHERE remote_number = \''.$rs->fields['remote_number'].'\' AND content = \''.addslashes($rs->fields['content']).'\'');
					$rs->MoveNext();
				}
			} else {
				$allsms_arr = &$this->sim_arr;
			}
		} else {
			
			// run command
			$command = $this->getallsms_format;
			$contents = $this->run_command($command);
			//$this->log_it("[getallsms] ".$contents."\n");
			
			// parse into array
			$pieces = explode("\n", $contents);
			foreach ($pieces as $key => $value) {
				if (ereg('^Location ([0-9]+), folder "(.*)".*$', $value, $regs)
				|| ereg('^\*Location ([0-9]+), folder "(.*)".*$', $value, $regs)
				|| ereg('^Reading : Location ([0-9]+), folder "(.*)".*$', $value, $regs)
				) {
                                        if ($sms_arr['location'] && $sms_arr['folder'] == 'Inbox') {
						$sms_arr['content'] = substr($content, 0, -2);
						$allsms_arr[] = $sms_arr;
						$sms_arr = array();
						$content = '';
					}
					$sms_arr['location'] = $regs[1];
					$sms_arr['folder'] = $regs[2];
				} else if (ereg('^SMS (message|status report).*$', $value, $regs)) {
					$sms_arr['type'] = $regs[1];
				} else if (ereg('^SMSC number.*: "(.*)".*$', $value, $regs)) {
					$sms_arr['smsc_number'] = $regs[1];
				} else if (ereg('^Sent.*: (.*)$', $value, $regs)) {
					$sms_arr['sent_date'] = $this->parsedate($regs[1]);
				} else if (ereg('^Coding.*: (.*)$', $value, $regs)) {
					$sms_arr['coding'] = $regs[1];
				} else if (ereg('^Status.*: (.*)$', $value, $regs)) {
					$sms_arr['status'] = $regs[1];
				} else if (ereg('^Remote number.*: "(.*)".*$', $value, $regs)) {
					$sms_arr['remote_number'] = $regs[1];
				} else if (ereg('^SMSC response.*: (.*)$', $value, $regs)) {
					$sms_arr['smsc_response'] = $this->parsedate($regs[1]);
				} else if (ereg('^Delivery status.*: (.*)$', $value, $regs)) {
					$sms_arr['delivery_status'] = $regs[1];
                                } else if (ereg('^Name .*: (.*)$', $value, $regs) || $state_name) {
                                        $state_name = TRUE;
                                        if (ereg('.*"$', $value)) {
                                                $state_name = FALSE;
                                        } else {
                                                
                                        }
                                        $sms_arr['name'] = $regs[1];
				} else if (ereg('(^Empty.*$)|(^Invalid location.*$)', $value)) {
				} else {
					if (! $content && ! trim($value)) {
						// do nothing
					} else {
						$content .= $value."\n";
					}
				}
			}
                        if ($sms_arr['location'] && $sms_arr['folder'] == 'Inbox') {
				$sms_arr['content'] = substr($content, 0, -3);
				$allsms_arr[] = $sms_arr;
			}
		}
		
		// check all sms
		$this->auto_store_delete($allsms_arr);
	}
	
	// check all sms
	function auto_store_delete($allsms_arr) {
		
		// check content
		if (! is_array($allsms_arr)) {
			return FALSE;
		}
			
		// parse every sms
		foreach ($allsms_arr as $key => $value) {
			//$status = "=> {$value[location]} ";
			
			$sms = $value;
			$record = array();
			
			// check Inbox folder
			if ($sms['folder'] == 'Inbox' && $sms['type'] == 'message') {
				
				// prepare record
				$record['remote_number'] = $this->parse_number($sms['remote_number']);
				$record['sent_date'] = $sms['sent_date'];
				$record['content'] = $sms['content'];
				$record['smsc_number'] = $sms['smsc_number'];
				$record['hp_code'] = $this->hp_code;
				
				// handle service
				$record['request_id'] = $this->service_request($record);
				
				// insert record into sms_inbox
				sms_inbox::insert($record);
				$this->log_it("[insert_inbox] ...\n");
				
				global $adodb;
				$rsI = $adodb->Execute('SELECT name FROM internal_vendor WHERE mobile_phone = \''.$record['remote_number'].'\'');
				if (! $rsI->EOF) {
					$record['name'] = $rsI->fields['name'];
				}
				$record['sent_date'] = date('Y-m-d H:i:s');
				require_once 'class.inbox.inc.php';
				inbox::insert($record);
				
				cl_debug('mygnokii::auto_store_delete::sms_inbox = '.$record['remote_number']."\n");
				
				// check report sms
			} else if (eregi('report', $sms['type'])) {
				
				// get sms
				$result = sms_outbox::select('
			SELECT
				sms_outbox.*
			FROM
				sms_outbox
			WHERE
				remote_number=\''.$sms['remote_number'].'\'
				AND delivery_status <> \'Sending ERROR\'
				AND delivery_status <> \'Delivered\'
			ORDER BY
				sent_date DESC
			LIMIT 1
			');
				
				// update report sms
				if ($result[0]) {
					$record = $result[0];
					$record['delivery_status'] = $sms['delivery_status'];
					$record['smsc_number'] = $sms['smsc_number'];
					$record['smsc_response_date'] = $sms['smsc_response'];
					
					sms_outbox::update($record);
					$this->log_it("[update_report] ...\n");
					cl_debug('mygnokii::auto_store_delete::sms_outbox = '.$record['remote_number']."\n");
				}
				
				// no op
			} else {
				$this->log_it("[noop] ...\n");
			}
			
			// delete sms
			//if ($this->simulation_inbox) {
			if ($this->get_value('inbox_c')) {
				unset($this->sim_arr[$key]);
				cl_debug('mygnokii::deletesms(0,'.$key.')'."\n");
			} else {
				$this->deletesms($sms['folder'], $sms['location']);
			}
		}
	}
	
	// parse number
	// 6684079 -> +6221 6684079
	// 0 22xxx -> +62 22xxx
	// 0 8128486425 -> +62 8128486425
	// 001 628128486425 -> _ +628128486425
	function parse_number($str_number) {
		$country_code = $this->get_value('prefix');
		if (empty($country_code)) $country_code = '+62';
		$area_code = $this->get_value('area_code');
		if (empty($area_code)) $area_code = '21';
		$str = $str_number;
		$str = preg_replace('/^([1-9][0-9])+/', $country_code.$area_code."\\1", $str);
		$str = preg_replace('/^0([^(01)]+)/', $country_code."\\1", $str);
		$str = preg_replace('/^([+]|(001))/', "+", $str);
		if (preg_match('/^[+][0-9]+$/', $str)) {
			if ($str == $country_code) return '';
			else if ($str == $country_code.$area_code)  return '';
			else return $str;
		} else {
			return '';
		}
	}
		
	// parse date gammu output
	function parsedate($str) {
		$month_arr = array (
		'1' => 'Jan',
		'2' => 'Feb',
		'3' => 'Mar',
		'4' => 'Apr',
		'5' => 'May',
		'6' => 'Jun',
		'7' => 'Jul',
		'8' => 'Aug',
		'9' => 'Sep',
		'10' => 'Oct',
		'11' => 'Nov',
		'12' => 'Dec'
		);
		$month2_arr = array (
		'1' => 'January',
		'2' => 'February',
		'3' => 'March',
		'4' => 'April',
		'5' => 'May',
		'6' => 'June',
		'7' => 'July',
		'8' => 'August',
		'9' => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December'
		);
		
		if (ereg('^[A-Za-z]+ ([0-9]+)/([0-9]+)/([0-9]+) ([0-9]+):([0-9]+):([0-9]+) [0-9]+$', $str, $regs)) {
			return mktime($regs[4], $regs[5], $regs[6], $regs[2], $regs[3], $regs[1]);
		} else if (ereg('^[A-Za-z]+ ([0-9]+) ([A-Za-z]+) ([0-9]+) ([0-9]+):([0-9]+):([0-9]+) ([AP]M)', $str, $regs)) {
			$month_val = array_search($regs[2], $month_arr);
			$hour_val = ($regs[7]=="PM")?$regs[4]+12:$regs[4];
			return mktime($hour_val, $regs[5], $regs[6], $month_val, $regs[1], $regs[3]);
		} else if (ereg('^[A-Za-z]+, ([A-Za-z]+) ([0-9]+), ([0-9]+) ([0-9]+):([0-9]+):([0-9]+) ([AP]M)', $str, $regs)) {
			$month_val = array_search($regs[1], $month2_arr);
			$hour_val = ($regs[7]=="PM")?$regs[4]+12:$regs[4];
			return mktime($hour_val, $regs[5], $regs[6], $month_val, $regs[2], $regs[3]);
		} else if (ereg('^[A-Za-z]+ ([A-Za-z]+) +([0-9]+) ([0-9]+):([0-9]+):([0-9]+) ([0-9]+) \+[0-9]+', $str, $regs)) {
			$month_val = array_search($regs[1], $month_arr);
			return mktime($regs[3], $regs[4], $regs[5], $month_val, $regs[2], $regs[6]);
		} else {
			die("Wrong format. Please change another version of Gammu."."\n".$str);
		}
	}
		
	// delete sms
	function deletesms($folder, $location) {
		if (! $location) return FALSE;
		$command = sprintf($this->deletesms_format, $folder, $location);
		$contents = $this->run_command($command);
		$this->log_it("[deletesms_$location] ".$contents."\n");
		cl_debug('mygnokii::deletesms('.$folder.','.$location.')'."\n");
		return TRUE;
	}
	
	// backup profile
	function backup() {
		global $include_separator, $file_separator;
		$backupfile = getcwd().'/'."backup-".date("YmdHis").".txt";
		$backupfile = ereg_replace('/', $file_separator, $backupfile);
		$command = sprintf($this->backup_format, $backupfile);
		$contents = $this->run_command($command);
		$this->log_it("[backup_$backupfile] ".$contents."\n");
		return TRUE;
	}
	
	// restore profile
	function restore($restorefile) {
		if (! $restorefile) return FALSE;
		$command = sprintf($this->restore_format, $restorefile);
		$contents = $this->run_command($command);
		$this->log_it("[restore_$restorefile] ".$contents."\n");
		return TRUE;
	}
		
	// backup sms
	function backupsms() {
		global $include_separator, $file_separator;
		$backupsmsfile = getcwd().'/'."backupsms-".date("YmdHis").".txt";
		$backupsmsfile = ereg_replace('/', $file_separator, $backupsmsfile);
		$command = sprintf($this->backupsms_format, $backupsmsfile);
		$contents = $this->run_command($command);
		$this->log_it("[backupsms_$backupsmsfile] ".$contents."\n");
		return TRUE;
	}
	
	// restore sms
	function restoresms($restoresmsfile) {
		if (! $restoresmsfile) return FALSE;
		$command = sprintf($this->restoresms_format, $restoresmsfile);
		$contents = $this->run_command($command);
		$this->log_it("[restoresms_$restoresmsfile] ".$contents."\n");
		return TRUE;
	}
	
	// last backup profile
	function lastbackupfile() {
		global $include_separator, $file_separator;
		$files = array();
		if ($handle = opendir('.')) {
			/* This is the correct way to loop over the directory. */
			while (false !== ($file = readdir($handle))) {
				if (ereg('^backup-[0-9]+.txt', $file)) $files[] = $file;
			}
			closedir($handle);
		}
		arsort($files);
		list($key, $lastfile) = each($files);
		$lastfile = getcwd().'/'.$lastfile;
		$lastfile = ereg_replace('/', $file_separator, $lastfile);
		return $lastfile;
	}
		
	// last backup sms
	function lastbackupsmsfile() {
		global $include_separator, $file_separator;
		$files = array();
		if ($handle = opendir('.')) {
			/* This is the correct way to loop over the directory. */
			while (false !== ($file = readdir($handle))) {
				if (ereg('^backupsms-[0-9]+.txt', $file)) $files[] = $file;
			}
			closedir($handle);
		}
		arsort($files);
		list($key, $lastfile) = each($files);
		$lastfile = getcwd().'/'.$lastfile;
		$lastfile = ereg_replace('/', $file_separator, $lastfile);
		return $lastfile;
	}
	
	// get sms center
	function getsmsc() {
		$command = $this->getsmsc_format;
		$contents = $this->run_command($command);
		$this->log_it("[getsmsc] ".$contents."\n");
		$this->insert_prefs($contents);
		$this->set_sms_center();
		cl_debug('mygnokii::getsmsc()'."\n");
	}
	
	// alias get status daemon
	function status_daemon() {
		$record['hp_code'] = $this->hp_code;
		$record['prefkey'] = 'last_access';
		$record['prefvalue'] = time();
		if (! hp_prefs::get($record)) {
			hp_prefs::insert($record);
		} else {
			hp_prefs::update($record);
		}
		//if (! $this->simulation_inbox) {
		if (! $this->get_value('inbox_c')) {
			$this->check_gammurc();
		}
		return $this->get_status_daemon();
	}
	
	// get status daemon
	function get_status_daemon() {
		$record['hp_code'] = $this->hp_code;
		$record['prefkey'] = 'status_daemon';
		$record['prefvalue'] = TRUE;
		$result = hp_prefs::get($record);
		if (! $result) {
			hp_prefs::insert($record);
			$result = hp_prefs::get($record);
		}
		return $result[0]['prefvalue'];
	}
	
	// set status daemon
	function set_status_daemon($status=TRUE) {
		$record['hp_code'] = $this->hp_code;
		$record['prefkey'] = 'status_daemon';
		$record['prefvalue'] = $status;
		$result = hp_prefs::get($record);
		if (! $result) {
			hp_prefs::insert($record);
		} else {
			hp_prefs::update($record);
		}
	}
		
	// set sms center
	function set_sms_center() {
		$record['hp_code'] = $this->hp_code;
		$record['prefkey'] = 'Number';
		$result = hp_prefs::get($record);
		$sms_center = $result[0];
		if (ereg('^"(\+?[0-9]+)".*$', $sms_center['prefvalue'], $regs)) {
			$this->sms_center = $regs[1];
		}
	}
	
	// get sms queue
	function get_queue() {
		global $adodb;
		
		// noop
		//if ($this->simulation_inbox) {
		//if ($this->get_value('inbox_c')) {
			// do nothing
			
			// telkomsel => simpati and halo
		//} else 
		if (ereg('81100000', $this->sms_center)) {
			$queue_regex = '^((([+]|(001))62)|0)81[123][0-9]+$';
			
			// check satelindo => mentari and matrix
		} else if (ereg('(81615)|(816124)', $this->sms_center)) {
			$queue_regex = '^((([+]|(001))62)|0)81[56][0-9]+$';
			
			// check proxl
		} else if (ereg('818445009', $this->sms_center)) {
			$queue_regex = '^((([+]|(001))62)|0)81[78][0-9]+$';
			
			// check im3
		} else if (ereg('855000000', $this->sms_center)) {
			$queue_regex = '^((([+]|(001))62)|0)85[56][0-9]+$';
		}
			
		// keyword regex
		if (strstr($GLOBALS['adodb_type'], 'postgres')) $regexp = '~';
		else $regexp = 'REGEXP';
		
		// SQL
		$sql_pre = 'SELECT * FROM sms_queue WHERE sent_date < '.time().' AND ('.time().' - status) > 60 ';
		$sql_regex = $queue_regex ? ' AND remote_number '.$regexp.' \''.$queue_regex.'\' ' : '';
		$sql_post = ' ORDER BY sent_date LIMIT 1';
		
		$basic_sql = $sql_pre.$sql_post;
		$advance_sql = $sql_pre.$sql_regex.$sql_post;
		
		// lock read
		if (strstr($GLOBALS['adodb_type'], 'postgres')) {
			$adodb->BeginTrans();
			$adodb->Execute('LOCK TABLE sms_queue');
		} else if (strstr($GLOBALS['adodb_type'], 'mysql')) {
			sms_queue::lock('WRITE');
		} else {
			die('mygnokii::get_queue : database lock not supported');
		}
		
		// get queue with same sms center
		$rs = $adodb->Execute($advance_sql);
		//$result = sms_queue::select($advance_sql);
		
		if ($rs->EOF) {
			// get queue other sms center
			//$count = sms_queue::select('SELECT count(*) As count_record FROM sms_queue');
			//$count_record = $count[0]['count_record'];
			//if ($count_record>50) {
			$rs = $adodb->Execute($basic_sql);
			//}
		}
		
		while (! $rs->EOF) {
			$result[] = $rs->fields;
			
			// delete queue
			//sms_queue::remove($result);
			
			cl_debug('mygnokii::get_queue::delete_sms_queue = '.count($result)."\n");
			$rs->MoveNext();
		}
		
		$rs->MoveFirst();
		while (! $rs->EOF) {
			$adodb->Execute('UPDATE sms_queue SET status = \''.time().'\' WHERE '.
			'remote_number=\''.$rs->fields['remote_number'].'\' '.
			'AND sent_date=\''.$rs->fields['sent_date'].'\' '.
			'AND delivery_id=\''.$rs->fields['delivery_id'].'\' '
			);
			$rs->MoveNext();
		}
		
		if (strstr($GLOBALS['adodb_type'], 'postgres')) {
			$adodb->CommitTrans();
		} else if (strstr($GLOBALS['adodb_type'], 'mysql')) {
			sms_queue::unlock();
		}
		
		// return queue
		return $result;
	}
		
	// send queue
	function send_queue() {
		$result = $this->get_queue();
		for ($i=0;$i<count($result);$i++) {
			$record = $result[$i];
			$sms['destination'] = $this->parse_number($record['remote_number']);
			$sms['type'] = $record['type'] ? $record['type'] : 'TEXT';
			$sms['content'] = $record['content'];
			$sms['delivery_id'] = $record['delivery_id'];
			
			$sms['split'] = TRUE;
			
			$this->sendsms($sms);
		}
	}
	
	// run service
	function service_request($record) {
		if (! $record) return FALSE;
		
		// get service
		global $adodb;
		$rs = $adodb->Execute('
		SELECT
			service_code,
			service_command,
			module_path
		FROM
			service
		ORDER BY
			service_command DESC
		');
			
		while (! $rs->EOF) {
			$piece = split(' +', trim($rs->fields['service_command']));
			$se = '';
			$sf = '';
			$first_key = FALSE;
			foreach ($piece as $k => $v) {
				if ($se) {
					if (! $sf) $sf = $se;
					if (! $first_key) { $se .= ' +'; $first_key = TRUE; }
					else $se .= ' *';
					//$se .= ' +';
					//$se .= ereg_replace("<[A-Za-z0-9_]+>", "([A-Za-z0-9_+-]+)", $v);
					$se .= ereg_replace("<[^>]+>", "([A-Za-z0-9_+-]+)", $v);
				} else {
					$se = $v;
				}
			}
			$service_ereg = $se;//if ($rs->fields['service_code']=='SSRCPR') { echo $se;exit;}
			if (eregi("^".$se.'(.*)', trim($record['content']), $regs)
			&& $record['remote_number'] && $record['sent_date']) {
				
				$service_request = array();
				$service_request = $record;
				$service_request['action'] = 'request';
				$service_request['from_number'] = $service_request['remote_number'];
				
				$service_request['service_code'] = $rs->fields['service_code'];
				$service_request['result_ereg'] =& $regs;
				$service_request['ereg'] = $se;
				if ($rs->fields['module_path']) {
					include ($rs->fields['module_path']);
					$this->log_it("[service_request] ...\n");
				}
				return $service_request['request_id'];
			}
			$rs->MoveNext();
		}
			
		$service_request = array();
		$service_request = $record;
		$service_request['action'] = 'request';
		$service_request['from_number'] = $service_request['remote_number'];
		
		if ($GLOBALS['SERVICE_GET_PG']) {
			include 'get_pg.php'; // for p&g only
		}
		
		if ($this->get_value('response_c')) {
			include 'unknown.php';
		}
		
		if ($service_request['request_id']) {
			return $service_request['request_id'];
		} else {
			return FALSE;
		}
	}
		
	function get_value($str) {
		include_once 'class.hp_prefs.inc.php';
		
		$record['hp_code'] = 'ttyS0';
		$record['prefkey'] = $str;
		$result = hp_prefs::get($record);
		
		return $result[0]['prefvalue'];
	}
	
	function get_phonebook() {
		include 'class.internal_vendor.inc.php';
		$fd  = fopen('/tmp/test.txt', 'r');
		while (! feof($fd)) {
			$buffer = fgets($fd, 4096);
			echo $buffer;
			//continue;
			if (ereg('^Entry00Text = "(.*)"', $buffer, $regs)) {
				$no = $regs[1];
			} else if (ereg('^Entry01Text = "(.*)"', $buffer, $regs)) {
				$nama = $regs[1];
				if ($no && $nama) {
					$record['vendor_code'] = 'PNG';
					$record['mobile_phone'] = $this->parse_number($no);
					$record['name'] = $nama;
					unset($no);
					unset($nama);

					if (! internal_vendor::add($record)) 
						internal_vendor::update($record);
				}
			}
		}
		fclose($fd);
	}
	
	function send_schedule() {
		global $adodb;
		
		//$now_real = time();
		$now = time();
		$now_real = $now;
		$now_hour = date("H", $now_real);
		$now_minute = date("i", $now_real);
		$now_second = date("s", $now_real);
		$now_week = date("w", $now_real);
		$now_day = date("d", $now_real);		
		$now_month = date("m", $now_real);
		$now_year = date("Y", $now_real);

		//$now = mktime( $now_hour, $now_minute, 0, $now_month, $now_day, $now_year);
		
		if ($now - $GLOBALS['repeat_last_date'] >= 60) {
			$GLOBALS['repeat_last_date'] = $now;
		} else {
			return FALSE;
		}
		//cl_debug('[FINISH] mygnokii::send_schedule() '.date('H:i:s', $now)."\n");
				
		$rs = $adodb->Execute("SELECT * FROM sms_schedule WHERE ".
			"repeat_start_date <= $now AND ".
			"(repeat_end_date >= $now OR repeat_end_date = 0 OR repeat_end_date IS NULL)".
			"ORDER BY repeat_start_date");
		while (! $rs->EOF) {
			$schedule_match = FALSE;
			$schedule_type = $rs->fields['schedule_type'];
			
			$last = intval($rs->fields['repeat_last_date']);
			$last_hour = date("H", $last);
			$last_minute = date("i", $last);
			$last_second = date("s", $last);
			$last_week = date("w", $last);
			$last_day = date("d", $last);		
			$last_month = date("m", $last);
			$last_year = date("Y", $last);
			
			$check = $rs->fields['repeat_start_date'];
			$check_hour = date("H", $check);
			$check_minute = date("i", $check);
			$check_second = date("s", $check);
			$check_week = date("w", $check);
			$check_day = date("d", $check);		
			$check_month = date("m", $check);
			$check_year = date("Y", $check);
			
			if ($check_hour == $now_hour && $check_minute == $now_minute) {
				switch ($schedule_type) {
					case 'repeat_once':
						if ($last == 0) {
							$schedule_match = TRUE;
						}
						break;
					case 'repeat_day':
						$now_abs = mktime( 0, 0, 0, $now_month, $now_day, $now_year);
						$last_abs = mktime( 0, 0, 0, $last_month, $last_day, $last_year);
						$repeat_every = $rs->fields['repeat_every'];
						if ($last == 0 
						|| ($last > 0 && $now_abs > $last_abs && (($now_abs - $last_abs) / 86400) % $repeat_every == 0)) {
							//$repeat_every = explode(',', $rs->fields['repeat_every']);
							//foreach ($repeat_every as $k => $v) {
							//	if ($now_hour == $v) {
									$schedule_match = TRUE;
							//	}
							//}
						}
						break;
					case 'repeat_week':
						$now_abs = mktime( 0, 0, 0, $now_month, $now_day, $now_year);
						$now_abs -= $now_week * 86400;
						$last_abs = mktime( 0, 0, 0, $last_month, $last_day, $last_year);
						$last_abs -= $last_week * 86400;
						$piece = explode(":", $rs->fields['repeat_every']);
						$repeat_every = $piece[0];
						$repeat_week = explode(",", $piece[1]);
						if ($last == 0 
						|| ($last > 0 && $now_abs > $last_abs && (($now_abs - $last_abs) / (86400 * 7)) % $repeat_every == 0)) {
							//$repeat_every = explode(',', $rs->fields['repeat_every']);
							foreach ($repeat_week as $k => $v) {
								if ($now_week == $v) {
									$schedule_match = TRUE;
								}
							}
						}
						break;
					case 'repeat_month':
						if ($now_month < $last_month) $now_month += (12 * ($now_year - $last_year));
						$piece = explode(":", $rs->fields['repeat_every']);
						$repeat_every = $piece[0];
						$repeat_month = $piece[1];
						if ($last == 0 
						|| ($last > 0 && $now > $last && ($now_month - $last_month) % $repeat_every == 0)) {
							$repeat_every = explode(',', $rs->fields['repeat_every']);
							//foreach ($repeat_every as $k => $v) {
							//	if ($now_day == $v) {
							//if ($repeat_month == 'date') {	
								if ($now_day == $check_day) {
									$schedule_match = TRUE;
								}
							//} else if ($repeat_month == 'day') {
								// todo ...
							//}
						
							//	}
							//}
						}
						break;
					case 'repeat_year':
						$repeat_every = $rs->fields['repeat_every'];
						if ($last == 0 || 
						($last > 0 && $now > $last && ($now_year - $last_year) % $repeat_every == 0)) {
							//$repeat_every = explode(',', $rs->fields['repeat_every']);
							//foreach ($repeat_every as $k => $v) {
							//	if ($now_month == $v) {
								if ($now_day == $check_day && $now_month == $check_month) {
									$schedule_match = TRUE;
								}
							//	}
							//}
						}
						break;
				}
			}


			if ($schedule_match) {
				$service_request['schedule_id'] = $rs->fields['schedule_id'];
				$service_request['vendor_code'] = $rs->fields['vendor_code'];
				$service_request['service_code'] = $rs->fields['service_code'];
				$service_request['cast_type'] = $rs->fields['cast_type'];
				$service_request['cast_number'] = $rs->fields['cast_number'];
				$service_request['content'] = $rs->fields['content'];
				$service_request['action'] = 'schedule';
								
				$this->log_it("[match_schedule] => ".$rs->fields['schedule_id']."\n");
				
				$rs2 = $adodb->Execute('SELECT module_path, service_code FROM service');
				while (! $rs2->EOF) {
					if ($rs2->fields['service_code'] == $service_request['service_code']) {
						if ($rs2->fields['module_path']) {
							include $rs2->fields['module_path'];
							$adodb->Execute('UPDATE sms_schedule SET repeat_last_date = \''.$now.'\''.
							' WHERE schedule_id = \''.$rs->fields['schedule_id'].'\'');
						}
					}
					$rs2->MoveNext();
				}
			}
			$rs->MoveNext();
		}
	}

	function check_gammurc() {
		$GP = $this->get_value('port');
		$GC = $this->get_value('connection');

		if ($GLOBALS['GP'] != $GP || $GLOBALS['GC'] != $GC || ($GP == 'auto' && $GLOBALS['count_error'] > 0)) {
			$GLOBALS['GP'] = $GP;
			$GLOBALS['GC'] = $GC;

			if ($GP == 'auto') {

				if (strstr(strtolower(PHP_OS), 'win')) {
					$test_arr = array (
						'com1:', 
						'com2:', 
						'com3:', 
						'com4:', 
						'com5:', 
						'com6:', 
						'com7:', 
						'com8:'
					);
				} else {
					$test_arr = array (
						'/dev/ttyS0',
						'/dev/ttyS1',
						'/dev/ttyUSB0',
						'/dev/ttyUSB1'
					);
				}
				$command = $this->identify_format;
				foreach ($test_arr as $k => $v) {
					$GT = $v;
					$str = <<< EOT
[gammu]
port = {$GT}
connection = {$GC}
EOT;

					$this->write_gammurc($str);
					$result = $this->run_command($command);
					
					if (! stristr($result, 
					'Error opening device. Some hardware not connected/wrong configured.')) {
						$GP = $GT;
						break;
					}	
				}
			}

			$str = <<< EOT
[gammu]
port = {$GP}
connection = {$GC}
synchronizetime = no
#logfile = gammulog
#logformat = textall
#use_locking = yes
#gammuloc = locfile
startinfo = no

EOT;
			$this->write_gammurc($str);

		}
	}
	
	function write_gammurc($str) {
			if (is_writeable('gammurc')) {
				$fd = fopen('gammurc', "w");
				fwrite($fd, $str);
				fclose($fd);
			} else {
				die('gammurc is not writeable at directory '.getcwd().'.');
			}
	}

	// start daemon
	function start_daemon() {
		$GLOBALS['CL_DEBUG'] = TRUE;
		cl_debug('[START] mygnokii::start_daemon() '."\n");
		global $include_separator, $file_separator;
		global $ADODB_CACHE_DIR;

		if ($handle = opendir($ADODB_CACHE_DIR)) {
    		while (false !== ($file = readdir($handle))) { 
        		if ($file != '.' && $file != '..') {
        			if (strlen($file) == 36 && substr($file, -4) == '.txt') {
        				unlink($ADODB_CACHE_DIR.$file_separator.$file);
        			} else if (strstr($file, 'infosmsd_'.$this->hp_code)) {
        				unlink($ADODB_CACHE_DIR.$file_separator.$file);
        			}
        		}
    		}
    		closedir($handle); 
		}
				
		
		$RC = rand(ord('a'), ord('z'));
		$log_filename = $ADODB_CACHE_DIR.'/'.'infosmsd_'.$this->hp_code.'-'.date('Ymd').chr($RC).'.txt';
		$log_filename = ereg_replace('/', $file_separator, $log_filename);
		$fp = fopen($log_filename, 'w+');
		$this->log_file = &$fp;
		
		$this->log_it("[start_daemon] ...\n");
		$this->set_status_daemon(TRUE);
		//if (! $this->simulation_inbox) {
		if (! $this->get_value('inbox_c')) {
			$this->check_gammurc();
			$this->identify();
			$this->getsmsc();
		}
		while ($this->status_daemon()) {
			$start_sec = date('s');
			//if (! $this->simulation_inbox) {
			if (! $this->get_value('inbox_c')) {
				$this->cancelcall();
			}
			$this->getallsms();
			$this->get_outbox();
			$this->send_queue();
			$this->send_schedule();
			if (date('s')==$start_sec) sleep(1);
			//$this->check_gammurc();			
		}
		$this->log_it("[stop_daemon] ...\n");
		fclose($fp);
		cl_debug('[FINISH] mygnokii::start_daemon() '."\n");
	}
	
	function get_outbox() {
		require_once 'class.outbox.inc.php';
		global $adodb;
		$rsS = $adodb->Execute(
		'SELECT module_path FROM service '.
		'WHERE service_code = \'SPRCAS\''
		);
		if (! $rsS->EOF) {
			if ($rsS->fields['module_path']) {
				$rsO = $adodb->Execute(
				'SELECT * FROM outbox '.
				'WHERE sent_date <= \''.date('Y-m-d H:i:s').'\' '.
				'LIMIT 100'
				);
				while (! $rsO->EOF) {
					$service_request['service_code'] = 'SPRCAS';
					$service_request['vendor_code'] = 'PNG';
					$service_request['action'] = 'schedule';
					$service_request['cast_type'] = 'personalcast';
					$service_request['cast_number'] = $rsO->fields['remote_number'];
					$service_request['content'] = $rsO->fields['content'];
					include $rsS->fields['module_path'];
					
					$adodb->Execute(
					'DELETE FROM outbox '.
					'WHERE remote_number = \''.$rsO->fields['remote_number'].'\' '.
					'AND sent_date = \''.$rsO->fields['sent_date'].'\''
					);
					$rsO->MoveNext();
				}
			}
		}
	}
}
?>

<?php


	if (class_exists('session')) {
		return 0;
	} else if (defined('CLASS_SESSION')) {
	return 0;
} else {
		define('CLASS_SESSION', TRUE);
}
	
class session {

	var $sid;
	var $loginid;
	var $ip;
	var $logintim;
	var $lda;
	var $action;
	var $flags;

	
	// constructor
	function session() {
		global $session_name;
		$session_name = $session_name ? $session_name : 'INFOSMSSID';

		// PHP configuration variables
		ini_set('session.use_trans_sid', 0);
		//ini_set('session.save_handler', 'user');
		//ini_set('session.serialize_handler', 'php');
		ini_set('session.use_cookies', 1);
		ini_set('session.name', $session_name);
		//ini_set('session.cookie_lifetime', $lifetime); // default 0
		ini_set('session.cookie_path', session::base_dir());
        //$domain = ${$GLOBALS['server_vars']}['HTTP_HOST'];
        //if (empty($domain)) {
        //    $domain = getenv('HTTP_HOST');
        //}
		//$domain = preg_replace('/:.*/', '', $domain);
		//ini_set('session.cookie_domain', $domain);
        //ini_set('session.referer_check', "$domain$GLOBALS[base_dir]");
		//ini_set('session.gc_probability', 1);
		//ini_set('session.gc_maxlifetime', pnConfigGetVar('secinactivemins') * 60);
		//ini_set('session.auto_start', 1);

		session_start();

		global ${$GLOBALS['server_vars']}, ${$GLOBALS['session_vars']};

		$this->sid = '';
		$this->loginid = '';
		$this->ip = '';
		$this->logintim = '';
		$this->lda = '';
		$this->action = '';
		$this->flags = '';
		if (! empty(${$GLOBALS['session_vars']}['session_sid'])) {
			$this->resume();
		} else {
			$this->start();
		}

		// Have to re-write the cache control header to remove no-save, this
		// allows downloading of files to disk for application handlers
		// adam_baum - no-cache was stopping modules (andromeda) from caching the playlists, et al.
		// any strange behaviour encountered, revert to commented out code.
		//Header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
		Header('Cache-Control: cache');
	}
	
	function insert($record) {
		global $adodb;
		
		$sql = 'SELECT * FROM session LIMIT 1';
		$recordSet = $adodb->Execute($sql);
		$insertSQL = $adodb->GetInsertSQL($recordSet, $record);
		$recordSet2 = $adodb->Execute($insertSQL);
		if (! $recordSet2) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function update($record) {
		global $adodb;
	
		$sql = 'SELECT * FROM session WHERE '.
			' sid='.$adodb->qstr($record['sid']).' AND '.
			' 1=1 '.
			' LIMIT 1 ';
		$recordSet = $adodb->Execute($sql);
		$updateSQL = $adodb->GetUpdateSQL($recordSet, $record, TRUE);
		$recordSet2 = $adodb->Execute($updateSQL);

		if (! $recordSet2) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	function select($sql='') {
		global $adodb;

		if (empty($sql)) {
			$sql = 'SELECT * FROM session ';
		}
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return $recordSet->GetRows();
		}
	}

	function delete($record) {
		global $adodb;

		$sql = 'DELETE FROM session WHERE '.
			' sid='.$adodb->qstr($record['sid']).' AND '.
			' 1=1 '.
			'';
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function add($record) {
		if (is_array($record)) {
			if (is_array($record[0])) {
				for ($i=0;$i<count($record);$i++) {
					if (! session::insert($record[$i]))
						return FALSE;
				}
				return TRUE;
			} else {
				return session::insert($record);
			}
		}
		return FALSE;
	}

	function modify($record) {
		if (is_array($record)) {
			if (is_array($record[0])) {
				for ($i=0;$i<count($record);$i++) {
					if (! session::update($record[$i]))
						return FALSE;
				}
				return TRUE;
			} else {
				return session::update($record);
			}
		}
		return FALSE;
	}

	function get($record) {
		global $adodb;
		
		return session::select('SELECT * FROM session WHERE '.
			' sid='.$adodb->qstr($record['sid']).' AND '.
			' 1=1 '.
			'');
	}

	function remove($record) {
		if (is_array($record)) {
			if (is_array($record[0])) {
				for ($i=0;$i<count($record);$i++) {
					if (! session::delete($record[$i]))
						return FALSE;
				}
				return TRUE;
			} else {
				return session::delete($record);
			}
		}
		return FALSE;
	}

	function start($user_name='guest') {
		global ${$GLOBALS['session_vars']}; //, $session_loginid;

		unset(${$GLOBALS['session_vars']}['session_sid']);
		session_register('session_sid');
		//session_register('session_loginid');

		$sess_sid = md5(session::random_string(10));
		$session_loginid = $user_name;
		${$GLOBALS['session_vars']}['session_sid'] = $sess_sid;

		$record = array (
			'sid'		=> $sess_sid,
			'loginid'	=> $session_loginid,
			'ip'		=> session::user_ip(),
			'logintim'	=> time(),
			'lda'		=> time()
		);

		$this->sid = $record['sid'];
		$this->loginid = $record['loginid'];
		$this->ip = $record['ip'];
		$this->logintim = $record['logintim'];
		$this->lda = $record['lda'];
		$this->action = $record['action'];

		return session::insert($record);
	}

	function resume($user_name='guest') {
		global ${$GLOBALS['session_vars']};
		
		if (! session::is_expire()) {
			$record = session::get(array('sid' => ${$GLOBALS['session_vars']}['session_sid']));
			if ($user_name!='guest')
				$record[0]['loginid'] = $user_name;
			$record[0]['lda'] = time();

			$this->sid = $record[0]['sid'];
			$this->loginid = $record[0]['loginid'];
			$this->ip = $record[0]['ip'];
			$this->logintim = $record[0]['logintim'];
			$this->lda = $record[0]['lda'];
			$this->action = $record[0]['action'];
			
			return session::update($record[0]);
		} else {
			return session::start();
		}
	}
	
	function is_expire() {
		global ${$GLOBALS['session_vars']};

		session::clean();
		$result = session::get(array('sid' => ${$GLOBALS['session_vars']}['session_sid']));

		if (empty($result))
			return TRUE;
		else
			return FALSE;
	}
	
	function destroy() {
		global ${$GLOBALS['session_vars']}, $PHP_SELF;

		session::remove(array('sid'	=> ${$GLOBALS['session_vars']}['session_sid']));
		//session_destroy();
		session_unregister('session_sid');
		unset(${$GLOBALS['session_vars']}['session_sid']);

		session_register('err_msg');
		${$GLOBALS['session_vars']}['err_msg'] = (ereg('logout\.php', $PHP_SELF)) ? __('Logout Successfully') : __('Login Expire');
		session::redirect('login.php');
	}
	
	function clean() {
		global $adodb;
		$adodb->Execute('DELETE FROM session WHERE '.
			'lda < '.(time()-1800).'');
	}

	function random_string($size=32) {
		$s = '';
		srand((double)microtime()*1000000);
		$random_char = array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f',
			'g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v',
			'w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L',
			'M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

		for ($i=0; $i<$size; $i++) {
			$s .= $random_char[rand(1,61)];
		}
		return $s;    
	}

	function user_ip() {
		global ${$GLOBALS['server_vars']};
		
	    // Get (actual) client IP addr
		$ipaddr = ${$GLOBALS['server_vars']}['REMOTE_ADDR'];
	    if (empty($ipaddr)) {
			$ipaddr = getenv('REMOTE_ADDR');
		}
		if (!empty(${$GLOBALS['server_vars']}['HTTP_CLIENT_IP'])) {
			$ipaddr = ${$GLOBALS['server_vars']}['HTTP_CLIENT_IP'];
		}
		$tmpipaddr = getenv('HTTP_CLIENT_IP');
		if (!empty($tmpipaddr)) {
			$ipaddr = $tmpipaddr;
		}
		if  (!empty(${$GLOBALS['server_vars']}['HTTP_X_FORWARDED_FOR'])) {
			$ipaddr = preg_replace('/,.*/', '', ${$GLOBALS['server_vars']}['HTTP_X_FORWARDED_FOR']);
		}
		$tmpipaddr = getenv('HTTP_X_FORWARDED_FOR');
		if  (!empty($tmpipaddr)) {
			$ipaddr = preg_replace('/,.*/', '', $tmpipaddr);
		}
		return $ipaddr;
	}
	
	function redirect($url) {
		header('Location: '.$url);
	}

	function base_dir() {
		global ${$GLOBALS['server_vars']};
		
	    // Start of with REQUEST_URI
	    if (isset(${$GLOBALS['server_vars']}['REQUEST_URI'])) {
	        $base_dir = ${$GLOBALS['server_vars']}['REQUEST_URI'];
	    } else {
	        $base_dir = getenv('REQUEST_URI');
	    }
	    
		if ((empty($base_dir)) ||
	        (substr($base_dir, -1, 1) == '/')) {
	        // REQUEST_URI was empty or pointed to a path
	        // Try looking at PATH_INFO
	        $base_dir = getenv('PATH_INFO');
	        if (empty($base_dir)) {
	            // No luck there either
	            // Try SCRIPT_NAME
	            if (isset(${$GLOBALS['server_vars']}['SCRIPT_NAME'])) {
	                $base_dir = ${$GLOBALS['server_vars']}['SCRIPT_NAME'];
	            } else {
	                $base_dir = getenv('SCRIPT_NAME');
	            }
	        }
	    }
	
	    $base_dir = preg_replace('/[#\?].*/', '', $base_dir);
	    $base_dir = dirname($base_dir);
	
	    if (preg_match('!^[/\\\]*$!', $base_dir)) {
	        $base_dir = '';
	    }
		
		return $base_dir;
	}

	function lock($type='READ') {
		global $adodb;

		if ($type=='READ') {
			$sql = 'LOCK TABLES session READ';
		} else if ($type=='WRITE') {
			$sql = 'LOCK TABLES session WRITE';
		}
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	function unlock() {
		global $adodb;

		$sql = 'UNLOCK TABLES';
		$recordSet = $adodb->Execute($sql);

		if (! $recordSet) {
			echo $adodb->ErrorMsg();
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
?>

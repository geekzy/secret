<?php


	if (defined('INTERFACE_AUTH')) {
		return 0;
	} else {
		define('INTERFACE_AUTH', TRUE);
	}


	require_once 'init.php';
	
	$login_ok = FALSE;
	$pass_e = 'passwd_md5';
	$apps_m = 'actor/depkes2/welcome.php';

        $xusertype = isset($_POST[usertype]) ? $_POST[usertype] : $_SESSION['usertype'];
        if (! session_is_registered('usertype')) session_register('usertype');
        $_SESSION['usertype'] = $xusertype;
        $usertype = $_SESSION[usertype];
        unset($xusertype);
        $adodb->Execute("UPDATE session SET action='{$usertype}' WHERE sid='{$ses->sid}'");

        $user_f = 'userid';
        $pass_f = 'passwd';
        $userTable = $usertype;
	if (empty($userTable)) $userTable = 'admin';
        $basicQuery = "SELECT $pass_f FROM $userTable WHERE $user_f='[user]'";

	if ($ses->loginid && $ses->loginid != 'guest' && !isset($_POST[loginawal])) {
		if (ereg('(auth\.php)|(login\.php)', $GLOBALS['PHP_SELF'])) {
			$ses->redirect($apps_m);
		}

		$rs = $adodb->Execute(str_replace('[user]', $ses->loginid, $basicQuery));

		if ($rs && ! empty($rs->fields[$pass_f])) {
			/*
                        $sFile = basename($_SERVER[SCRIPT_FILENAME]);
                        if (ereg('(welcome.php)|(login.php)|(depkes2_menu.php)', $sFile, $regs)) {
                                $login_ok = TRUE;
                                return;
                        } else {
                                $rs = $adodb->Execute("SELECT href FROM phplayersmenu_cat a ".
                                " INNER JOIN phplayersmenu b ON a.id = b.id ".
                                " WHERE cat='".$_SESSION[usertype]."' AND hide=0 ".
                                " AND href ~ '".$sFile."'");
                                ereg('([A-Za-z0-9_]+\.php)', $rs->fields[href], $regs);
                                if ($regs[1]==$sFile) {
                                        $login_ok = TRUE;
                                        return;
                                } else {
                                       echo $manager->intruder();
                                       $ses->redirect('welcome.php');
                                }
                        }
			*/
			$login_ok = TRUE;
			return;
		} 
	} else {
		$rs = $adodb->Execute(str_replace('[user]', $_POST[$user_f], $basicQuery));
		if (ereg('pendaftar', $userTable)) $rs->fields[$pass_f] = md5($rs->fields[$pass_f]);
		$login_ok = ($rs->fields[$pass_f] && $rs->fields[$pass_f] == $_POST[$pass_e]);
	}

	if ($login_ok) {
	   $day = date('j F Y');
	   $hour = date('H')-1;
	   $minute = date('i:s');
       $today = $day.",".$hour.':'.$minute;
                $sqlf ="INSERT INTO login_history VALUES (('login_history_history_id_seq'),'".$_POST[$user_f]."','".$today."')";
				$rs = $adodb->Execute($sqlf); 
		$_SESSION['userid'] = $_POST[$user_f];
		$ses->resume($_POST[$user_f]);
		$ses->redirect($apps_m);
	} else {
		$_SESSION['err_msg'] = 'Login Failed';
		$ses->redirect('login.php');
	}
	
?>

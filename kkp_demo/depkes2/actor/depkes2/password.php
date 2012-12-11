<?php

	require_once 'init.php';
	require_once 'auth.php';

class password_controller {
	// create update password
	function change_password_form() {
		require_once 'class.xform.inc.php';

		global $ses;
		if (! $ses->loginid) return FALSE;

		$field_arr[] = xform::xf('old_password','C','32');
                $field_arr[] = xform::xf('new_password','C','255');
                $field_arr[] = xform::xf('retype_password','C','255');

		$label_arr['old_password'] = __('Old Password');
		$label_arr['new_password'] = __('New Password');
		$label_arr['retype_password'] = __('Re-Type Password');

                $label_arr['form_extra'] = "<input type=hidden name=action value='postedit'>";
                $label_arr['form_title'] = "Change Password";
                $label_arr['form_width'] = '90%';
                $label_arr['form_name'] = 'theform';

                $_form = new form();
                $_form->set_config(
                        array (
                                'field_arr'     => $field_arr,
                                'label_arr'     => $label_arr,
                                'value_arr'     => $value_arr,
                                'optional_arr'  => $optional_arr
                        )
                );
		return $_form->parse_field();
	}

	// handle event change password
	function change_password() {
		global $ses, $adodb, $_POST;
		$record['username'] = $ses->loginid;
		
		$userTable = $_SESSION['usertype'];
		if (empty($userTable)) $userTable = 'admin';
		$rs = $adodb->Execute("SELECT * FROM $userTable WHERE userid='".$record['username']."'");
		if ($rs && $rs->fields[passwd]) {
			$oldPassword = $rs->fields['passwd'];
			if (ereg('pendaftar', $userTable)) $oldpass = $_POST['old_password'];
			else $oldpass = md5($_POST['old_password']);
			
			if ($oldPassword == $oldpass) {
				if (empty($_POST['new_password']) || empty($_POST['retype_password'])) {
					$status = "Sorry, new password can't be empty !";
				} else if ($_POST['new_password'] == $_POST['retype_password']) {
					if (ereg('pendaftar', $userTable)) {
						$newpass = $_POST['new_password'];
					} else {
						$newpass = md5($_POST['new_password']);
					}
					$adodb->Execute("UPDATE $userTable SET".
					" passwd='".$newpass."'".
					" WHERE userid='".$record['username']."'");
					$status = "Password has been changed !";
				} else {
					$status = "Sorry, new passwords do not match !";
				}
			} else {
				$status = "Sorry, old password do not match !";
			}
		}

		$_block = new block();
                $_block->set_config('title', 'Status');
                $_block->set_config('width', "90%");
                $_block->parse(array($status."<script language=javascript>alert('$status');</script>"));
                return $_block->get_str();
        }
}

	$password_controller = new password_controller();
	$action = $_POST['action'] ? $_POST['action'] : $_GET['action'];
	switch ($action) {
		case 'postedit':
		        $self_close_js = "\n<script language=javascript>\n".
			"self.setTimeout('window.top.opener.focus();window.top.close();', 500);\n".
			"</script>\n";
			$out_content = $password_controller->change_password();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
		default:
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $password_controller->change_password_form();
			$out_content .= $back_to_menu;
			break;
	}
	
	$_title = 'Change Password';
	include_once 'depkes2_nonmenu.php';

?>

<?php


class Authen	{
	/**
	* no desc
	* @var Adodb
	*/
	var $adodb;

	/**
	* no desc
	* @var string
	*/
	var $table_user;
	
	/** 
	* function to display form login (string)
	* login_form must be simple, utilize global instance of Authen, and
	* post username, password or password_md5
	* 
	* 
	* prototype:
	* <code>
	* function my_login_form($username, $status) {
	* 
	* 	exit;
	* }</code>
	* 
	* @var string
	*/
	var $login_form;
	
	/**
	* how long user may idle in seconds before kicked out, default = 500s
	* @var int 
	*/
	var $expire;
	
	/**
	* constructor for Authen
	* <p>
	* DDL:<p>
	* <code>
	* CREATE TABLE public.authen
	* (
	* username varchar(50) NOT NULL,
	* password varchar(32),
	* role varchar(255),
	* CONSTRAINT authen_pkey PRIMARY KEY (username)
	* ) WITHOUT OIDS;
	* </code>
	* NOTE: field role is serialized array of roles
	*
	* @param Adodb $adodb prepared adodb connection
	* @param string $login_form callable function to display form login 
	* @see $login_form
	* @param int $expire how long user may idle in seconds before kicked out, default = 500s
	* @param string $table_user table name containing user and password, default authen
	* @param string sess_name = session name for internal storage
	*
	*/
	function Authen($adodb, $login_form='', $expire=500, $table_user="authen", $sess_name="authen_sess")	{
		
		//@session_name($sess_name);
		session_start();
		
		if ($login_form && function_exists($login_form)) {
			$this->login_form = $login_form;
		}
		
		$this->adodb=$adodb;
		$this->expire = $expire;
		$this->login_form = $login_form;
		$this->table_user = $table_user;
	}
	
	/**
	* Start the authentication...
	* @access public
	* @return boolean
	*/
	function start()	{
		if ($this->is_login())	{
			$_SESSION['authen_ts'] = time();
			return TRUE;
		} else {
			// user post data?
			if ($_POST['username'] && ($_POST['password']!='' || $_POST['password_md5']!=''))	{
				$_SESSION['authen_username'] = $_POST['username'];
				if ($r = $this->_checkpass($_POST['username'], $_POST['password'], $_POST['password_md5']))	{
					// login OK
					$_SESSION['authen_role'] = unserialize($r);
					//$_SESSION['authen_username'] = $_POST['username'];
					$_SESSION['authen_status'] = 'LOGIN';
					$_SESSION['authen_ts'] = time();
					return TRUE;
				} else {
					$_SESSION['authen_status'] = 'WRONGPASSWORD';
				}
			}
			$this->_draw_login();
		}
		
		return FALSE;
	}
	
	/**
	* Get current logged in user's roles, return array
	* @access public
	* @return array
	*/
	function getRole()	{
		return $this->getRoles();
	}
	function getRoles()	{
		return $_SESSION['authen_role'];
	}
	
	/**
	* default login form
	* 
	* @access private
	*/
	function _default_login_form($username, $status)	{
		if ($status == 'EXPIRED') {
			print "Login $username has expired, please login again";
		} elseif ($status == 'WRONGPASSWORD')	{
			print "Username or Password is invalid";
		}
		
		echo "<form method=\"post\" action=\"" . $server['PHP_SELF'] . "\">\n";
		echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\">\n";
		echo "<tr>\n";
		echo "    <td colspan=\"2\" bgcolor=\"#eeeeee\"><b>Login:</b></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "    <td>Username:</td>\n";
		echo "    <td><input type=\"text\" name=\"username\" value=\"" . $username . "\"></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "    <td>Password:</td>\n";
		echo "    <td><input type=\"password\" name=\"password\"></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "    <td colspan=\"2\" bgcolor=\"#eeeeee\"><input type=\"submit\"></td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</form>\n";
		echo "</center>\n\n";
		
		exit;
	}
	
	/** private: return user role if OK
	* check if username and password is correct (in md5)
	* @access private
	*/
	function _checkpass($u,$p,$p_md5)	{
		if ($p != '') $p=md5($p); else $p=$p_md5;
		$this->adodb->Execute("select role from ? where username=? and password=?", array($this->table_user, $u, $p) );
		while ( ! $this->adodb->EOF ) {
			return $this->adodb->fields [ "role" ];
		}
		return FALSE;
	}
	
	/**
	* get extended status
	*
	* return one of LOGIN,
	* NOTLOGIN,
	* WRONGPASSWORD,
	* EXPIRED
	* @access public
	* @return string
	*/
	function getStatus()	{
		if ($_SESSION['authen_status'] == 'LOGIN')	{
			// expired
			if (time() - $_SESSION['authen_ts'] > $this->expire)	{
				$_SESSION['authen_status'] = 'EXPIRED';
			}
		} elseif ($_SESSION['authen_status'] == '')	{
			$_SESSION['authen_status'] = 'NOTLOGIN';
		}
		
		return $_SESSION['authen_status'];
	}
	
	
	/**
	* check if current user have role $role
	* @param string $role role to check
	* @access public
	* @return bool
	*/
	function has_permission($role) {
		if (! $role) return FALSE;
		return in_array($role,$_SESSION['authen_role']);
	}
	
	/**
	* check if current user have role $role if not will call $this->login_form and exit
	* @access public
	* @see has_permission
	*/
	function check_permission($role) {
		if (! $this->has_permission($role))	{
			$this->_draw_login();
			//exit; // necessary?
		}
	}
	
	/**
	* @access private
	*/
	function _cekusername($u)	{
		if ($u='') return FALSE;
		return eregi('^[a-z][a-z0-9_.]+$',$u);
	}
	
	/** add a user
	*
	* Specify one of $p or $p_md5 
	*
	* @param  string $u username
	* @param  string $p unencrypted password
	* @param  string $p_md5 encrypted (md5) password
	* @param  array $r array of roles
	*
	* @access public
	* @return bool
	*/
	function addUser($u, $p, $p_md5, $r)	{
		if (! $this->_cekusername($u)) return FALSE;

		if ($p != "") $p=md5($p); else $p= $p_md5;
		$rs=serialize($r);
		return $this->adodb->Execute("insert into ? (username, password, role) values (?,?,?)",
			array($this->table_user, $u, $p, $r));
	}
	
	/** delete a user
	*
	* @param string $u username
	*
	* @access public
	* @return bool
	*
	*/
	function deleteUser($u)	{
		if (! $this->_cekusername($u)) return FALSE;
		return $this->adodb->Execute("delete from ? where username=?",
			array($this->table_user, $u));
	}
	
	/** list user
	*
	* not implemented<br>
	* return array of users
	*
	* @access public
	* @return array
	*
	*/
	function listUser()	{
		
		
	}
	
	/** change password
	* @access public
	* @return bool
	*
	* @see addUser
	*/
	function changePassword($u, $p, $p_md5)	{	
		return $this->modifyUser($u, $p, $p_md5, $this->getRoles());
	}
	
	/** modify user password and metadata (roles)
	*
	* @access public
	* @return bool
	*
	* @see addUser
	*/
	function modifyUser($u, $p, $p_md5, $r)	{
		if (! $this->_cekusername($u)) return FALSE;

		if ($p != "") $p=md5($p); else $p= $p_md5;
		$rs=serialize($r);
		return $this->adodb->Execute("update ? set password=?, role=? where username=?",
			array($this->table_user, $p, $r, $u));
	}
	
	/** get logged in username or last entered username
	*
	*
	* @access public
	* @return string
	*
	*/
	function getUsername()	{
		return $_SESSION['authen_username'];
	}
	
	/** ude login belom?
	*
	* @access public
	* @return bool
	*/
	function is_login()	{
		return $this->has_login();
	}
	function getauth()	{
		return $this->has_login();
	}
	function has_login()	{
		return $this->getStatus() == 'LOGIN';
	}

	/** return this class verson
	*
	* @access public
	* @return string
	*/
	function version()	{
		return "Authen version 1.0\n(c) 2003 Khadiyd Idris";
	}
	
	/** 
	* private: draw login form
	* @access private
	*/
	function _draw_login()	{
		if ($this->login_form)
		call_user_func( $this->login_form, $this->getUsername(), $this->getStatus() );
		else
		$this->_default_login_form($this->getUsername(), $this->getStatus());
	}
}

?>

<?php
/**
 * Description of Xldap
 *
 * @author Andi Susilo
 */
class Xldap_Exception extends Exception {
    public function __construct($message, $code = 1, $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class Xldap {
    var $hostname = '';
    var $port = 389;
    var $protocol_version = 3;
    var $base_dn = '';
    var $user_dn = '';
    var $password = '';
    var $user_base = '';
    var $query = '';
    var $fields = '';

    var $conn;

    function  __construct($params = array()) {
        $this->initialize($params);
    }

    function initialize($params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }

        $this->conn = ldap_connect($this->hostname, $this->port);
        if (!$this->conn) {
            throw new Xldap_Exception('Could not connect to '.$this->hostname);
        }

        ldap_set_option($this->conn, LDAP_OPT_PROTOCOL_VERSION, $this->protocol_version);

        $this->auth();
    }

    function auth($rdn = '', $pass = '') {
        if ($rdn === '') {
            $rdn = $this->user_dn;
        } else {
            $rdn = $this->search_user($rdn);
        }
        $pass = ($pass === '') ? $this->password : $pass;
//
//        print_r($rdn.':'.$pass."<br/>\n");
        $bind = @ldap_bind($this->conn, $rdn, $pass);

        if (!$bind) {
            throw new Xldap_Exception('Invalid credentials with rdn '.$this->user_dn);
        }
    }

    function search_user($rdn) {
        $sr = ldap_search($this->conn,$this->user_base,sprintf($this->query, $rdn),$this->fields);
        $records = ldap_get_entries($this->conn, $sr);

        if ($records["count"] != "1") {
            throw new Xldap_Exception('Wrong user '.$rdn);
        }

        return $records[0]["dn"];

    }

    function change_passwd($rdn, $pass, $new_pass) {
        $rdn = $this->search_user($rdn);
        $this->auth($rdn, $pass);
        $entry = array();
        $entry["userPassword"] = "{SHA}" . base64_encode( pack( "H*", sha1( $new_pass ) ) );
        if (ldap_modify($this->conn, $rdn, $entry) === false) {
            throw new Xldap_Exception('Your password cannot be change, please contact the administrator');
        }
    }
}

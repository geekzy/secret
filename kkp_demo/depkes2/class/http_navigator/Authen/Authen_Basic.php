<?php
// $Id: Authen_Basic.php,v 1.1.1.1 2004/06/27 18:34:45 rudi Exp $
// +----------------------------------------------------------------------+
// | Basic Authentication class 0.1                                       |
// +----------------------------------------------------------------------+
// | Author: Keyvan Minoukadeh - keyvan@k1m.com - http://www.keyvan.net   |
// +----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or        |
// | modify it under the terms of the GNU General Public License          |
// | as published by the Free Software Foundation; either version 2       |
// | of the License, or (at your option) any later version.               |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// +----------------------------------------------------------------------+

/**
* Basic Authentication
*
* This class is based on Basic.pm 
* <http://www.linpro.no/lwp/libwww-perl/lib/LWP/Authen/Basic.pm>
* from the libwww-perl collection <http://www.linpro.no/lwp/>.
*
* TODO:
*  - none yet
*
* @author Keyvan Minoukadeh <keyvan@k1m.com>
* @version 0.1
* @static
*/
class Authen_Basic
{
    function &authenticate(&$ua, $proxy, $challenge, &$response, &$request, $arg)
    {
        // find realm
        foreach ($challenge as $key => $val) {
            if (strtolower($key) == 'realm') {
                $realm = $val;
                break;
            }
        }
        if (!isset($realm)) return $response;

        $user_pass = $ua->get_basic_credentials($realm, $request->get_url(), $proxy);
        if (!is_array($user_pass) || (!isset($user_pass[0]) && !isset($user_pass[1]))) {
            return $response;
        }
        list($user, $pass) = $user_pass;
        $auth_header = ($proxy) ? 'Proxy-Authorization' : 'Authorization';
        $auth_value = 'Basic '.base64_encode("$user:$pass");

        // Need to check this isn't a repeated fail!
        $r =& $response;
        while ($r) {
            $auth = $r->request->get_header_string($auth_header, 1);
            if ($auth && ($auth == $auth_value)) {
                // here we know this failed before
                Debug::debug("Credentials for '$user' failed before", __FILE__, __LINE__);
                $response->set_header('Client-Warning', "Credentials for '$user' failed before");
                return $response;
            }
            $r = $r->get_previous();
        }

        $referral = $request->clone();
        $referral->set_header($auth_header, $auth_value);
        return $ua->request($referral, $arg, array(&$response));
    }
}
?>
<?php
 
	require_once 'class.template.inc.php';
	require_once 'class.block.inc.php';
	require_once 'class.country.inc.php';

//        if (! $GLOBALS['currency_js']) {
		$GLOBALS['currency_js'] = <<< EOT

<SCRIPT LANGUAGE="JavaScript">
function currencyFormat(fld, milSep, decSep, e, pre) {
//if (pre == null) pre = 2;
//else pre = parseInt(pre);
//var sep = 0;
var key = '';
var i = j = 0;
var len = len2 = 0;
var strCheck = '0123456789';
var aux = aux2 = '';
//var whichCode = (window.Event) ? e.which : e.keyCode;
var whichCode = (e.keyCode) ? e.keyCode: e.which;
if (whichCode == 13 // enter
|| whichCode == 9 // tab
|| whichCode == 8 || whichCode == 46 // backspace, delete
|| whichCode == 35 || whichCode == 36 // home, end
//|| whichCode == 127
//|| whichCode == 37 || whichCode == 39 // left, right
) return true;  // Enter
key = String.fromCharCode(whichCode);  // Get key value from key code
if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
//len = fld.value.length;
//for(i = 0; i < len; i++)
//if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
//aux = ''; // ex val: 1.234,56 aux: 123456 aux2: 432.1 val2:reverse(aux2)+substr(aux,strlen(aux)-2,strlen(aux));
//for(; i < len; i++)
//if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
//aux += key;
aux = fld.value + key;
fld.value = EnCurrency(aux, milSep, decSep, pre);
return false;
}

function EnCurrency(aux, milSep, decSep, pre) {
if (pre == null) pre = 2;
else pre = parseInt(pre);
var strCheck = '0123456789';
len = aux.length;
for(i = 0; i < len; i++)
if ((aux.charAt(i) != '0') && (aux.charAt(i) != decSep)) break;
aux3 = ''; // ex val: 1.234,56 aux: 123456 aux2: 432.1 val2:reverse(aux2)+substr(aux,strlen(aux)-2,strlen(aux));
for(; i < len; i++)
if (strCheck.indexOf(aux.charAt(i))!=-1) aux3 += aux.charAt(i);
aux = aux3;
fld = '';
len = aux.length;
//if (len == 0) fld.value = '';
//if (len == 1) fld.value = '0'+ decSep + '0' + aux;
//if (len == 2) fld.value = '0'+ decSep + aux;
if (len <= pre) {
//	fld.value = '0' + decSep;
	fld = '0' + decSep;
	for (i = 0; i < pre-len; i++)
//		fld.value += '0';
		fld += '0';
//	fld.value += aux;
	fld += aux;
}
//if (len > 2) {
if (len > pre) {
aux2 = '';
//for (j = 0, i = len - 3; i >= 0; i--) {
for (j = 0, i = len - (pre+1); i >= 0; i--) {
if (j == 3) {
aux2 += milSep;
j = 0;
}
aux2 += aux.charAt(i);
j++;
}
//fld.value = '';
fld = '';
len2 = aux2.length;
for (i = len2 - 1; i >= 0; i--)
//fld.value += aux2.charAt(i);
fld += aux2.charAt(i);
//fld.value += decSep + aux.substr(len - 2, len);
//fld.value += decSep + aux.substr(len - pre, len);
fld += decSep + aux.substr(len - pre, len);
}
return fld;
}
function DeCurrency(str, decSep) {
var strCheck = '0123456789';
var floatType = 0;
aux = str;
len = aux.length;
for(i = 0; i < len; i++)
if ((aux.charAt(i) != '0') && (aux.charAt(i) != decSep)) break;
aux3 = ''; // ex val: 1.234,56 aux: 123456 aux2: 432.1 val2:reverse(aux2)+substr(aux,strlen(aux)-2,strlen(aux));
for(; i < len; i++)
if (strCheck.indexOf(aux.charAt(i))!=-1) aux3 += aux.charAt(i);
else if (aux.charAt(i)==decSep) { aux3 += aux.charAt(i); floatType = 1; }
if (floatType == 1) return parseFloat(aux3);
else return parseInt(aux3);
}
//  End -->
</script>

EOT;
//	}

	// check already defined or not
	if (class_exists('form')) {
		return 0;
	} else if (defined('CLASS_FORM')) {
		return 0;
	} else {
		define('CLASS_FORM', TRUE);
	}

	// class definition
	class form {
		var $field_arr; // array of field name
		var $label_arr; // array of label name
		var $var_arr;   // array of variable name
		var $value_arr; // array of value of variable
		var $optional_arr; // array of rules
		var $date_format;  // format of date
		var $md5_js;       // md5 javascript function
		var $str_valid;

		// constructor
		function form($config='') {

			// save configuration
			$this->save_config = <<< EOT
				\$this->field_arr =& \$config['field_arr'];
				\$this->label_arr =& \$config['label_arr'];
				\$this->var_arr =& \$config['var_arr'];
				\$this->value_arr =& \$config['value_arr'];
				\$this->optional_arr =& \$config['optional_arr'];
				//\$this->date_format =& \$config['date_format'];
				\$this->md5_js =& \$config['md5_js'];
EOT;
			// load configuration
			$this->load_config = <<< EOT
				\$field_arr =& \$this->field_arr;
				\$label_arr =& \$this->label_arr;
				\$var_arr =& \$this->var_arr;
				\$value_arr =& \$this->value_arr;
				\$optional_arr =& \$this->optional_arr;
				\$date_format =& \$this->date_format;
				\$md5_js =& \$this->md5_js;
EOT;

			// default value
			$this->optional_arr = array();

			// set configuration
			$this->set_config($config);


		}

		// set configuration
		function set_config($config, $value='') {

			// if config is array
			if (is_array($config)) {

				// save configuration
				eval($this->save_config);

				// form name
				$this->label_arr['form_name'] = $config['form_name'] ? $config['form_name'] : $this->label_arr['form_name'];

                                // form extra attribute
				$this->label_arr['form_extra'] = $config['form_extra'] ? $config['form_extra'] : $this->label_arr['form_extra'];

                                // form title table
				$this->label_arr['form_title'] = $config['form_title'] ? $config['form_title'] : $this->label_arr['form_title'];

                                // form width table
				$this->label_arr['form_width'] = $config['form_width'] ? $config['form_width'] : $this->label_arr['form_width'];

				// form additional information
				$this->label_arr['form_info'] = $config['form_info'] ? $config['form_info'] : $this->label_arr['form_info'];

				// form action destination
				$this->label_arr['form_action'] = $config['form_action'] ? $config['form_action'] : $this->label_arr['form_action'];

				// formate of date
				$this->date_format = $GLOBALS['date_format'] ? $GLOBALS['date_format'] : 'Y-m-d';

                                // md5 javascript function
				$this->md5_js = $config['md5_js'];
			} else {

				// set config with value
				//$this->$config = $value;
			}
		}

		// generate form
		function parse_field() {

			// load configuration
			eval($this->load_config);

                        // label for alert information
			$only_label = __('only');
			$alphabet_label = __('alphabet');
			$and_label = __('and');
			$numeric_label = __('numeric');
			$must_label = __('must');
			$date_label = __('date');
			$time_label = __('time');
			$exist_label = __('exist');

			// set default size
			if ($label_arr['default_size'] <= 0) {
				$label_arr['default_size'] = 20;
			}

			// get form name
			$form_name = $label_arr['form_name'] ?
				$label_arr['form_name'] :
				'theform';

			// set class style
			$class_name = $label_arr['class_text'] ?
				$label_arr['class_text'] :
				'text';

			// parse every field
			//for ($i=0;$i<count($field_arr);$i++) {
			foreach ($field_arr as $kf => $vf) {
				$i = $kf;

                // reset some variable
				unset($str );
				unset($protect_check, $userd_check, $rule_check);
				unset($tolower_check, $toupper_check);
				unset($date_check, $country_check, $pass_check);
				unset($def_con, $def_val);


				// set $field_arr[$i]['size']
				if (isset($label_arr['force_size'])) {
					$optional_arr['force_size'] = $label_arr['force_size'];
				}
				if (isset($label_arr['default_size'])) {
					$optional_arr['default_size'] = $label_arr['default_size'];
				}
				if ($optional_arr['force_size']) {
					$field_arr[$i]['size'] = $optional_arr['default_size'];
				} else if (! isset($optional_arr['force_size'])) {
					$field_arr[$i]['size'] = -1;
				} else {
					// follow size of field
				}

                                if ($optional_arr['horizontal_form']) {
					$optional_arr['disable_submit'] = TRUE;
					$optional_arr['disable_form'] = TRUE;
				}

				// set label name
				$label_name = $label_arr[$field_arr[$i]['name']] ?
					$label_arr[$field_arr[$i]['name']] :
					$field_arr[$i]['name'];

                                // set variable name
				$var_name = $var_arr[$field_arr[$i]['name']] ?
					$var_arr[$field_arr[$i]['name']] :
					$field_arr[$i]['name'];

//				if ($this->optional_arr['multiple_form'])
//					$var_name .= '[]';

                                // slash it for javascript
				$label_name = addslashes($label_name);

				// deprecated, please use xxx_format
				if ($field_arr[$i]['before']) $before = $field_arr[$i]['before'];

                                // check rule of field
				switch ($optional_arr[$field_arr[$i]['name']]) {

					// protect value and visible
					case 'protect':
						$protect_check = TRUE;
						break;

					// user define create form
					case 'user_defined':
						$userd_check = TRUE;
						$field_arr[$i]['type'] = 'other';
						break;

					// force value to lower-case
					case 'tolower':
						$tolower_check = TRUE;
						break;

					// force value to upper-case
					case 'toupper':
						$toupper_check = TRUE;
						break;

                                        // deprecated, please use xxx_rule
					case 'user_rules':
					case 'user_rule':
						$urule_check = TRUE;
						break;

					// force to date format
					case 'todate':
						$date_check = TRUE;
						break;

					// force to country dropdown
					case 'tocountry':
						$country_check = TRUE;
						break;

                                        // for to password type
                                        case 'topass':
						$pass_check = TRUE;
						break;

				}

				// ignore rule
				if ($optional_arr[$field_arr[$i]['name']] == 1 &&
					strlen($optional_arr[$field_arr[$i]['name']]) == 1) {
					continue;
				}

				// check whether date type
				if (eregi('(date)|(lda)', $field_arr[$i]['name'])) {
					$date_check = TRUE;
				}
				// check whether country type
				else if (eregi('(negara)|(country)', $field_arr[$i]['name'])) {
					$country_check = TRUE;
				}
				// check whether password type
				else if (eregi('pass(_|(wd))?(word)?', $field_arr[$i]['name'])) {
					$pass_check = TRUE;
				}

                                // check date format
				if ($date_check) {
					if ($optional_arr[$field_arr[$i]['name'].'_dateformat']) {
						$ori_date_format = $date_format;
						$date_format = $optional_arr[$field_arr[$i]['name'].'_dateformat'];
					} else if ($ori_date_format) {
						$date_format = $ori_date_format;
					} else if (! $date_format) {
						$date_format = 'Y-m-d';
					}
					$mlt = 0; $mle = '';
					for ($cc=0;$cc<strlen($date_format);$cc++) {
						switch($date_format[$cc]) {
							case 'Y': $mlt += 4; $mle .= '[0-9][0-9][0-9][0-9]'; break;
							case 'y': $mlt += 2; $mle .= '[0-9][0-9]'; break;
							case 'm': $mlt += 2; $mle .= '[0-1][0-9]'; break;
							case 'd': $mlt += 2; $mle .= '[0-3][0-9]'; break;
							case 'H': $mlt += 2; $mle .= '[0-2][0-9]'; break;
							case 'i': $mlt += 2; $mle .= '[0-5][0-9]'; break;
							case 's': $mlt += 2; $mle .= '[0-5][0-9]'; break;
							default : $mlt += 1; $mle .= "\\".$date_format[$cc]; break;
						}
					}
					$date_ereg = '^'.$mle.'$';
					$field_arr[$i]['size'] = $mlt;
					$field_arr[$i]['max_length'] = $mlt;
				}

				// generate country drop down
				if ($country_check && !$userd_check) {
					// force type other
					$field_arr[$i]['type'] = 'other';

					// create country object
					if (! $country) {
						$country = new country();
					}

                                        // default country is 'indonesia'
					if (! isset($value_arr[$field_arr[$i]['name']])) {
						$value_arr[$field_arr[$i]['name']] = 'ID';
					}

					// set default content
					if ($protect_check) {
						$def_con = '<input type=hidden '.
							'name="'.$var_name.'" '.
							'value="'.$value_arr[$field_arr[$i]['name']].'">'.
							htmlentities($value_arr[$field_arr[$i]['name']]);
					} else {
						$def_con = $country->form_select(
							$value_arr[$field_arr[$i]['name']],
							$var_name);

						// set default validation
/////////////////////////////////////////////// START EOT
						$def_val = <<< EOT

	if({$form_name}.{$var_name}.value=='')
	{
		alert('Field {$label_name} {$must_label} {$exist_label}.');
		{$form_name}.{$var_name}.focus();
		form_submitted=false;
		return false;
	}
EOT;
/////////////////////////////////////////////// END EOT
					}
				}

                                // parse base on type
				switch($field_arr[$i]['type']) {
					// integer type
					case 'I':
						if (! $date_check) {

						// define class attribute
						$int_class_name = 'right_text';

						if ($GLOBALS['currency_js']) {
							$urule_check = FALSE;
							unset($optional_arr[$field_arr[$i]['name'].'_rule']);

							$GLOBALS['i_need_currency_js'] = TRUE;
							if ($GLOBALS['i_need_currency_js'] && !$GLOBALS['currency_js_included']) {
								$GLOBALS['extra_header'] .= $GLOBALS['currency_js'];
								$GLOBALS['currency_js_included'] = TRUE;
							}

							if ($protect_check) {
								$int_extra_con_protect = <<< EOT

<script language=javascript>
document.write(EnCurrency(document.{$form_name}.{$var_name}.value,',','.',0) + '');
</script>

EOT;
							} else {
								// define extra attribute
								$int_extra_attr = ''.
								'onKeyPress="'.
								'return(currencyFormat(this,\',\',\'.\',event,0));'.
								'" onBlur="'.
								'this.value=EnCurrency(this.value,\',\',\'.\',0);'.
								'"';

								// define extra content
/////////////////////////////////////////////////////////////// BEGIN EOT
								$int_extra_con = <<< EOT

<input type="hidden" name="{$var_name}" value="">
<script language=javascript>
document.{$form_name}.{$var_name}_view.value = EnCurrency(document.{$form_name}.{$var_name}_view.value,',','.',0) + '';
document.{$form_name}.{$var_name}.value = DeCurrency(document.{$form_name}.{$var_name}_view.value, '.') + '';
</script>

EOT;
/////////////////////////////////////////////////////////////// END EOT

/////////////////////////////////////////////////////////////// START EOT
								$int_def_val = <<< EOT

	document.{$form_name}.{$var_name}.value = DeCurrency(document.{$form_name}.{$var_name}_view.value, '.');
	if (isNaN(document.{$form_name}.{$var_name}.value)) document.{$form_name}.{$var_name}.value = '0';
	if({$form_name}.{$var_name}.value==''
	|| ({$form_name}.{$var_name}.value.search
	&& {$form_name}.{$var_name}.value.search(new RegExp("^[0-9]+\$","g"))<0))
	{
		alert('Field {$label_name} {$only_label} {$numeric_label}.');
		{$form_name}.{$var_name}_view.focus();
		form_submitted=false;
		return false;
	}
EOT;
/////////////////////////////////////////////////////////////// END EOT

								// define name attribute
								$var_name = $var_name.'_view';

								$int_max_length = '';
							}
						}
                                                }

					// numeric type
					case 'N':
						if ($field_arr[$i]['type'] == 'N') {
							$int_class_name = 'right_text';
							if (! $protect_check) {
/////////////////////////////////////////////////////////////// START EOT
								$int_def_val = <<< EOT

	if({$form_name}.{$var_name}.value==''
	|| ({$form_name}.{$var_name}.value.search
	&& {$form_name}.{$var_name}.value.search(new RegExp("^[0-9]+[.][0-9]+\$","g"))<0))
	{
		alert('Field {$label_name} {$must_label} numeric.'+"\\n"+'Example: 0.00');
		{$form_name}.{$var_name}.focus();
		form_submitted=false;
		return false;
	}
EOT;
/////////////////////////////////////////////////////////////// END EOT
							}
						}

					// character type
					case 'C':
						// set first element
						if (! $first_el && ! $protect_check ) {
							$first_el = $var_name;
						}

						// set class attribute
                                                if ($int_class_name) {
							$class = $int_class_name;
							$int_class_name = FALSE;
						} else {
							$class = $class_name;
						}
						$class_attr = "class=\"$class\"";

                                                // set max_length attribute
						if ($int_max_length) {
							$max_length = $int_max_length;
							$int_max_length = '';
						} else if (intval($field_arr[$i]['max_length']) > 0) {
							$max_length = $field_arr[$i]['max_length'];
						} else {
							$max_length = '';
						}
						if ($max_length && ! strstr('IN', $field_arr[$i]['type'])) {
							$max_attr = "maxlength=\"$max_length\"";
						} else {
							$max_attr = '';
						}

						if ($date_check && $value_arr[$field_arr[$i]['name']] == 0)
							unset($value_arr[$field_arr[$i]['name']]);
						
                                                // set value attribute
						if (! isset($value_arr[$field_arr[$i]['name']])) {
							if ($date_check) {
								$value = $date_format;
								$value = str_replace('Y', 'YYYY', $value);
								$value = str_replace('y', 'yy', $value);
								$value = str_replace('m', 'mm', $value);
								$value = str_replace('d', 'dd', $value);
								$value = str_replace('h', 'hh', $value);
								$value = str_replace('H', 'HH', $value);
								$value = str_replace('i', 'ii', $value);
								$value = str_replace('s', 'ss', $value);
							} else {
								$value = '';
							}
						} else {
							if ($date_check) {
								$value = htmlentities(date(
									$date_format ,
									$value_arr[$field_arr[$i]['name']]));
							} else {
								$value = htmlentities(
									$value_arr[$field_arr[$i]['name']]);
							}
						}
						$value_attr = "value=\"$value\"";

                                                // set type attribute
						if ($pass_check) {
							$type = 'password';
						} else if ($protect_check) {
							$type = 'hidden';
						} else {
							$type = 'text';
						}
						$type_attr = "type=\"$type\"";

                                                // set default validation
						if ($protect_check) {
							$def_val = '';
						} else if ($pass_check) {
/////////////////////////////////////////////////////// START EOT
							$def_val .= <<< EOT

	if({$form_name}.{$var_name}.value=='')
	{
		alert('Field {$label_name} {$must_label} {$exist_label}.')
		{$form_name}.{$var_name}.focus()
		form_submitted=false
		return false
	}
EOT;
							// check whether md5 javascript function
							if ($md5_js) {
                                                        	// password validation
/////////////////////////////////////////////////////////////// START EOT
								$str_valid_md5 .= <<< EOT

	if(loaded_MD5)
	{
		{$form_name}.{$var_name}_md5.value=MD5({$form_name}.{$var_name}.value);
		{$form_name}.{$var_name}.value='';
	}
EOT;
/////////////////////////////////////////////////////////////// END EOT
							}
/////////////////////////////////////////////////////// END EOT
						} else if (eregi('^user_?(name)?$', $field_arr[$i]['name'])) {
/////////////////////////////////////////////////////// START EOT
							$def_val = <<< EOT

	if({$form_name}.{$var_name}.value==''
	|| ({$form_name}.{$var_name}.value.search
	&& {$form_name}.{$var_name}.value.search(new RegExp("^[a-z][a-z0-9_.]+\$","g"))<0))
	{
		alert('Field {$label_name} {$only_label} {$alphabet_label} {$and_label} {$numeric_label}.');
		{$form_name}.{$var_name}.focus();
		form_submitted=false;
		return false;
	}
EOT;
/////////////////////////////////////////////////////// END EOT
						} else if ($tolower_check) {
/////////////////////////////////////////////////////// START EOT
							$def_val = <<< EOT

	if({$form_name}.{$var_name}.value==''
	|| ({$form_name}.{$var_name}.value.search
	&& {$form_name}.{$var_name}.value.search(new RegExp("^[a-z0-9_. ]+\$","g"))<0))
	{
		alert('Field {$label_name} {$must_label} lower-case.');
		{$form_name}.{$var_name}.focus();
		form_submitted=false;
		return false;
	}
EOT;
/////////////////////////////////////////////////////// END EOT
						} else if ($toupper_check) {
/////////////////////////////////////////////////////// START EOT
							$def_val = <<< EOT

	if({$form_name}.{$var_name}.value==''
	|| ({$form_name}.{$var_name}.value.search
	&& {$form_name}.{$var_name}.value.search(new RegExp("^[A-Z0-9_. ]+\$","g"))<0))
	{
		alert('Field {$label_name} {$must_label} upper-case.');
		{$form_name}.{$var_name}.focus();
		form_submitted=false;
		return false;
	}
EOT;
/////////////////////////////////////////////////////// END EOT
						} else if ($urule_check) {

							$alert_str = $optional_arr[$field_arr[$i]['name'].'_alert'] ? $optional_arr[$field_arr[$i]['name'].'_alert'] : '';
							$str_now = $optional_arr[$field_arr[$i]['name'].'_default_value'] ? $optional_arr[$field_arr[$i]['name'].'_default_value'] : '';
							$def_val = <<< EOT

	if({$form_name}.{$var_name}.value==''
	|| ({$form_name}.{$var_name}.value.search
	&& {$form_name}.{$var_name}.value.search(new RegExp("{$user_rule}","g"))<0))
	{
		alert('Field {$must_label} {$alert_str}.');
		{$form_name}.{$var_name}.focus();
		form_submitted=false;
		return false;
	}
EOT;
						/* user rule deprecated */
						} else if ($date_check) {
							$str_now = date($date_format);
/////////////////////////////////////////////////////// START EOT
							$def_val = <<< EOT

	if({$form_name}.{$var_name}.value==''
	|| ({$form_name}.{$var_name}.value.search
	&& {$form_name}.{$var_name}.value.search(new RegExp("^{$date_ereg}\$","g"))<0))
	{
		alert('Field {$label_name} {$must_label} {$date_label}.');
		{$form_name}.{$var_name}.value='{$str_now}';
		{$form_name}.{$var_name}.focus();
		form_submitted=false;
		return false;
	}
EOT;
/////////////////////////////////////////////////////// END EOT
						} else if ($int_def_val) {
							$def_val = $int_def_val;
							$int_def_val = FALSE;
						} else {
/////////////////////////////////////////////////////// START EOT
							$def_val = <<< EOT

	if({$form_name}.{$var_name}.value=='')
	{
		alert('Field {$label_name} {$must_label} {$exist_label}.')
		{$form_name}.{$var_name}.focus()
		form_submitted=false
		return false
	}
EOT;
/////////////////////////////////////////////////////// END EOT
						}

						// set size attribute
						if (intval($field_arr[$i]['size']) > 0) {
							$size = $field_arr[$i]['size'];
						} else if ($field_arr[$i]['size'] == 0) {
                                                	$size = $field_arr[$i]['max_length'];
						} else {
							$size = '';
						}
						if ($size) {
							$size_attr = "size=\"$size\"";
						} else {
							$size_attr = '';
						}

                                                // set extra attribute
						if ($protect_check) {
                                                       $extra_attr = '';
						} else if (eregi('^user_?(name)?$', $field_arr[$i]['name']) || $tolower_check) {
							$extra_attr = "".
								" onBlur=\"".
								"	value=value.toLowerCase();".
								" if(value.indexOf &amp;&amp; value.substring)".
								" { ".
								"	space=value.indexOf(' ');".
								" 	if(1<space) ".
								"		value=value.substring(0,space)".
								" }".
								"\"";
						} else if ($toupper_check) {
							$extra_attr = "".
								" onBlur=\"".
								"	value=value.toUpperCase();".
								" if(value.indexOf &amp;&amp; value.substring)".
								" { ".
								"	space=value.indexOf(' ');".
								" 	if(1<space) ".
								"		value=value.substring(0,space)".
								" }".
								"\"";
						} else if ($int_extra_attr) {
                                                	$extra_attr = $int_extra_attr;
							$int_extra_attr = FALSE;
						} else {
							$extra_attr = '';
						}

						// set extra content
						if ($int_extra_con_protect) {
                                                	$extra_con = $int_extra_con_protect;
							$int_extra_con_protect = FALSE;
						} else if ($protect_check) {
							$extra_con = $value;
						} else if ($date_check) {
							if ($GLOBALS['calendar_js']) {
								$GLOBALS['i_need_calendar_js'] = TRUE;
								$extra_con = '<a href="#" onclick="ppcDF=\''.$date_format.'\';getCalendarFor(document.'.$label_arr['form_name'].'.'.$var_name.');return false"><img src='.$GLOBALS['path_theme'].'/images/calendar.gif border=0 />'.'</a>';
							}
						} else if ($pass_check) {
							if ($md5_js) {
								$pass_var_name = ereg_replace('\[\]$', '', $var_name).'_md5';
//								if ($this->optional_arr['multiple_form'])
//									$pass_var_name .= '[]';
								$extra_con = '<input type=hidden '.
									'name="'.$pass_var_name.'">'.
									$md5_js;
							} else {
								$extra_con = '';
							}
						} else if (eregi('^user_?(name)?$', $field_arr[$i]['name']) || $tolower_check) {
/////////////////////////////////////////////////////// START EOT
							$extra_con = <<< EOT
<script language=javascript>
{$var_name}_string = document.{$form_name}.{$var_name};
{$var_name}_string.value = {$var_name}_string.value.toLowerCase();
</script>
EOT;
/////////////////////////////////////////////////////// END EOT
						} else if ($toupper_check) {
/////////////////////////////////////////////////////// START EOT
							$extra_con = <<< EOT
<script language=javascript>
{$var_name}_string = document.{$form_name}.{$var_name};
{$var_name}_string.value = {$var_name}_string.value.toUpperCase();
</script>
EOT;
/////////////////////////////////////////////////////// END EOT
						} else if ($int_extra_con) {
							$extra_con = $int_extra_con;
							$int_extra_con = FALSE;
						} else {
							$extra_con = '';
						}

						// set default content
						$def_con = "<input ".
							"id=\"$var_name\" ".
							"name=\"$var_name\" ".
							"$class_attr ".
							"$max_attr ".
							"$value_attr ".
							"$type_attr ".
							"$size_attr ".
							"$extra_attr>".
							"$extra_con";

						break;

					// text type
					case 'X':
					// blob type
					case 'B':

                                                // set first element
						if (! $first_el && ! $protect_check ) {
							$first_el = $var_name;
						}

						// set class attribute
						$class = $class_name;
						$class_attr = "class=\"$class\"";

                                                // set value attribute
						if (isset($value_arr[$field_arr[$i]['name']])) {
	                                                $value = htmlentities($value_arr[$field_arr[$i]['name']]);
						} else {
							$value = '';
						}

						// set extra attribute
						if (intval($field_arr[$i]['max_length']) > 0) {
							$max_length = $field_arr[$i]['max_length'];
							$extra_attr = "".
								" onKeyUp=\"".
								" if(value.length > {$max_length}) { ".
								"	value = value.substring(0, {$max_length});".
								"	alert('Maximum length {$label_name}: {$max_length}');".
								"}".
								"\"";
						} else {
							$max_length = '';
							$extra_attr = '';
						}

						// set default content
						if ($protect_check) {
							$def_con = "<input name=\"$var_name\" ".
								"type=\"hidden\" ".
								"value=\"$value\" >".
								"$value\n";
						} else {
							$def_con = "<textarea ".
								"id=\"$var_name\" ".
								"name=\"$var_name\" ".
								"cols=40 ".
								"rows=2 ".
								"wrap=\"physical\" ".
								"$extra_attr ".
								"$class_attr >".
								"$value".
								"</textarea>\n";

							// set default validation
/////////////////////////////////////////////////////// START EOT
							$def_val = <<< EOT

	if(document.{$form_name}.{$var_name}.value=='')
	{
		alert('Field {$label_name} {$must_label} {$exist_label}.');
		{$form_name}.{$var_name}.focus();
		form_submitted=false;
		return false;
	}
EOT;
/////////////////////////////////////////////////////// END EOT
						}
						break;

					// date type,  //date, plz use varchar with field-name xxx_date or date_xxx
					case 'D':
						break;

					// timestamp type
					case 'T':
                                                // set first element
						if (! $first_el && ! $protect_check ) {
							$first_el = $var_name;
						}


						// set name attribute
						$var2_name = ereg_replace('\[\]$', '', $var_name)."_hour";
//						if ($this->optional_arr['multiple_form']) $var2_name .= '[]';
						$var3_name = ereg_replace('\[\]$', '', $var_name)."_minute";
//						if ($this->optional_arr['multiple_form']) $var3_name .= '[]';

						$var_attr = "name=\"$var_name\"";
						$var2_attr = "name=\"$var2_name\"";
						$var3_attr = "name=\"$var3_name\"";

						// set class attribute
						$class = $class_name;
						$class_attr = "class=\"$class\"";

                                                // set max_length attribute
						$max_attr = "maxlength=2";

                                                // set value attribute
						if (isset($value_arr[$field_arr[$i]['name']])) {

							$value_attr = <<< EOT

<script language=javascript>
	{$var_name}_string = '{$value_arr[$field_arr[$i]['name']]}';
	{$var_name}_split = {$var_name}_string.split(':');
	document.{$form_name}.{$var_name}_hour.value = {$var_name}_split[0];
	document.{$form_name}.{$var_name}_minute.value = {$var_name}_split[1];
	{$var_name}_onkeyup();
</script>

EOT;
						} else {
							$value_attr = '';
						}

                                                // set type attribute
						// thereis 2 type: hidden and text

                                                // set size attribute
						$size_attr = 'size=2';

                                                // set extra attribute
						$extra_attr = "onKeyUp=\"javascript:{$var_name}_onkeyup();\"";

                                                // set extra content
						$extra_con = <<< EOT

<script language=javascript>
	function {$var_name}_onkeyup() {
		a = document.{$form_name}.{$var_name};
		b = document.{$form_name}.{$var_name}_hour;
		c = document.{$form_name}.{$var_name}_minute;
		if (b.value.length==1) d = '0' + b.value; else d = b.value;
		if (c.value.length==1) e = '0' + c.value; else e = c.value;
		if (d == '') d = '00';
		if (e == '') e = '00';
		a.value = d + ':' + e;
	}
</script>

EOT;
						if ($protect_check) {

							// set default content
							$def_con = $value_arr[$field_arr[$i]['name']];

						} else {

                                                	// set default content
							$def_con = <<< EOT

<input type="hidden" {$var_attr} />
<input type="text" id="{$var_name}" {$var2_attr} {$class_attr} {$size_attr} {$max_attr} {$extra_attr} />:<input
type="text" {$var3_attr} {$class_attr} {$size_attr} {$max_attr} {$extra_attr} />
{$extra_con}
{$value_attr}

EOT;

	                                                // set default validation
							$def_val = <<< EOT

	if({$form_name}.{$var_name}.value==''
	|| ({$form_name}.{$var_name}.value.search
	&& {$form_name}.{$var_name}.value.search(new RegExp("^[0-2][0-9]:[0-5][0-9]\$","g"))<0))
	{
		alert('Field {$label_name} {$must_label} {$time_label}.');
		{$form_name}.{$var_name}_hour.focus();
		form_submitted=false;
		return false;
	}

EOT;
						}
						break;
					case 'L': //logical, not implemented
						break;
					case 'R': //serial, plz use int with field-name id, control by actor
						break;
					case 'other': //other, use on some condition of field name
						if (! $def_con) {
							$def_con = $value_arr[$field_arr[$i]['name']];
						}
						break;
				}

				// user validation
				if (isset($optional_arr[$field_arr[$i]['name'].'_rule'])) {
					$def_val = $optional_arr[$field_arr[$i]['name'].'_rule'];
				}

				//if ($str_md5) $str .= $str_md5;
				//if ($str_hide) $str .= $str_hide;

                                // deprecated, please xxx_format
				if ($field_arr[$i]['after']) $after = $field_arr[$i]['after'];

				// save buffer content table
				$content = $before.$def_con.$after;
				$str = "<nobr><div align=right><b>$label_name : </b></div></nobr>|*$content";
				//$arr_str[] = $str;
				$arr_str2[$field_arr[$i]['name']] = $str;
				$arr_str[] =& $arr_str2[$field_arr[$i]['name']];

				// save buffer validation
				$str_valid .= $def_val;
			}

			if (is_array($optional_arr)) {
				reset ($optional_arr);
			}

			foreach ($optional_arr as $kop => $vop) {
				if (strstr($kop, "_format")) {
					if (! ereg("([A-Za-z0-9_]+)_format", $kop, $rop)) continue;
					$bpop = explode(":", $optional_arr[$kop], 2);
					$pop = explode(" ", $bpop[1]);
					if (count($pop)) $new_arr_str2 = '';
					for($popi=0;$popi<count($pop);$popi++) {
						//if ($pop[$popi] == $rop[1]) continue;
						if (ereg("([^|]+)\|(.*)", $arr_str2[$pop[$popi]], $rarr)) {
							if (ereg('^\*', $rarr[2])) $rarr[2] = substr($rarr[2], 1);
							$new_arr_str2 .= " ".$rarr[2];
							$arr_str2[$pop[$popi]] = FALSE;
						} else {
							if (ereg('^\*', $pop[$popi])) $pop[$popi] = substr($pop[$popi], 1);
							$new_arr_str2 .= " ".$pop[$popi];
						}
					}
					if (count($pop)) {
						$arr_str2[$rop[1]] = '<nobr><div align=right><b>'.$bpop[0].' : </b></div></nobr>'.'|*'.$new_arr_str2;
					}
					//echo $rop[1]."<br>\n";
				}
			}

			$submit_str = '*+<input type=submit title="Submit" class=';
			$submit_str .= $label_arr['class_button'] ? $label_arr['class_button'] : 'button';
			$submit_str .= ' name=';
			$submit_str .= $label_arr['submit_var'] ? $label_arr['submit_var'] : 'submit';
			$submit_str .= ' value="';
			$submit_str .= $label_arr['submit_val'] ? $label_arr['submit_val'] : 'Submit';
			$submit_str .= '" ';
			$submit_str .= <<< EOT
 onclick="if(this.disabled || typeof(this.disabled)=='boolean') this.disabled=true ; form_submitted_test=form_submitted ; form_submitted=true ; form_submitted=(!form_submitted_test || confirm('Are you sure you want to submit this form again?')) ; if(this.disabled || typeof(this.disabled)=='boolean') this.disabled=false ; sub_form='' ; return true"
EOT;
			$submit_str .= '>';
//			$submit_str .= ' <input type=submit title="Next" class=';
//			$submit_str .= $label_arr['class_button'] ? $label_arr['class_button'] : 'button';
//			$submit_str .= ' name=';
//			$submit_str .= '"next"';
//			$submit_str .= ' value=';
//			$submit_str .= '"Next"';
//			$submit_str .= <<< EOT
// onclick="if(this.disabled || typeof(this.disabled)=='boolean') this.disabled=true ; form_submitted_test=form_submitted ; form_submitted=true ; form_submitted=(!form_submitted_test || confirm('Are you sure you want to submit this form again?')) ; if(this.disabled || typeof(this.disabled)=='boolean') this.disabled=false ; sub_form='' ; document.theform.action.value = 'nextadd'; return true"
//EOT;
//			$submit_str .= '>';
			$submit_str .= ' <input type="reset" value="Reset" title="Reset" class=';
			//$submit_str .= ' <input type="button" onClick="javascript:window.self.close()" value="Cancel" title="Cancel" class=';
			$submit_str .= $label_arr['class_button'] ? $label_arr['class_button'] : 'button';
			$submit_str .= '>';
			if (! $optional_arr['disable_submit']) {
//			&& !$this->optional_arr['multiple_form']) {
				$arr_str[] = $submit_str;
			}

			$form_str = '<form enctype="multipart/form-data" name=';
			$form_str .= $form_name;
			$form_str .= ' action=';
			$form_str .= $label_arr['form_action'] ? $label_arr['form_action'] : $GLOBALS['PHP_SELF'];
			$form_str .= ' onSubmit="return Validate'.$form_name.'(this)"';
			$form_str .= ' method=post>';

			if ($first_el) {
				$fel_str = <<< EOT
	document.{$form_name}.{$first_el}.focus();
//	document.{$form_name}.{$first_el}.select();
EOT;
			}
			$str_valid_extra = $optional_arr['str_valid_extra'];
			$str_valid2 = <<< EOT

<script language=javascript>
form_submitted=false
function Validate{$form_name}({$form_name})
{
{$str_valid}
{$str_valid_md5}
{$str_valid_extra}
	return true
}
function DocumentLoad()
{
{$fel_str}
}
</script>
EOT;
			$form_str .= $str_valid2;
			$form_str .= $label_arr['form_extra'] ? $label_arr['form_extra'] : '';

			$_block = new block();
			$_block->set_config('cell_extra', ' valign=top ');
			if ($optional_arr['horizontal_form']) {
				for ($i=0;$i<count($arr_str);$i++) {
					if (! $arr_str[$i]) continue;
					$hpiece = explode("|", $arr_str[$i], 2);
					$hpiece[1] = ereg_replace('^\*+', '', $hpiece[1]);
					if ($htit_str) $htit_str .= '</td><td class=title_table>';
					$htit_str .= '<nobr>'.$hpiece[0].'</nobr>';
					if ($hcon_str) $hcon_str .= '</td><td>';
					$hcon_str .= '<nobr>'.$hpiece[1].'</nobr>';
				}
				if (! $optional_arr['disable_title'])
					$_block->set_title(array($htit_str));
				//$hc = 2;
				//for ($i=0;$i<$hc;$i++) {
					$hcon_arr[] = $hcon_str;
				//}
				$_block->parse($hcon_arr);
//				print_r($hcon_str);exit;
				$optional_arr['str_valid_extra'] = $str_valid.$str_valid_md5;
			} else {
				if (! $optional_arr['disable_title'])
					$label_arr['form_title'] ? $_block->set_config('title', $label_arr['form_title']) : '';
				$label_arr['form_width'] ? $_block->set_config('width', $label_arr['form_width']) : '100%';
				$_block->parse($arr_str);
			}
                        if (! $optional_arr['disable_form']) {
				$_block->set_var('info', $form_str);
				$_block->set_var('row', $_block->tpl->get_var('row').'</form>');
			}

			$label_arr['form_info'] ? $_block->set_info($label_arr['form_info'], TRUE) : '';
			return $_block->get_str();
		}

	}
?>

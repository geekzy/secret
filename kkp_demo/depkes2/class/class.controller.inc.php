<?php

	if (class_exists('controller')) {
		return 0;
	} else if (defined('CLASS_CONTROLLER')) {
		return 0;
	} else {
		define('CLASS_CONTROLLER', TRUE);
	}

class controller {
	var $load_config;
	var $save_config;
	var $tree_menu;
	var $horizontal_menu;
	var $rule;

	// constructor
	function controller() {
		$this->load_config = ''.
		'		$field_arr =& $config[\'field_arr\'];'.
		'		$label_arr =& $config[\'label_arr\'];'.
		'		$value_arr =& $config[\'value_arr\'];'.
		'		$optional_arr =& $config[\'optional_arr\'];'.
		'		$record =& $config[\'record\'];';
		$this->save_config = ''.
		'		$config[\'field_arr\'] =& $field_arr;'.
		'		$config[\'optional_arr\'] =& $optional_arr;'.
		'		$config[\'value_arr\'] =& $value_arr;'.
		'		$config[\'label_arr\'] =& $label_arr;'.
		'		$config[\'record\'] =& $record;';

	}

	// intruder warning
	// ouput: see below
	function intruder() {
		echo 'You don\'t have permission access to this page';
		echo '<script language=javascript> self.setTimeout(\'window.location="login.php";\', 1000);</script>';
		exit;
	}

	function select_form_v01($name, $arr, $selected='') {
                if (is_array($arr[0]))
                        for ($i=0;$i<count($arr);$i++) {
                                $arr2[$arr[$i]['skey']] = $arr[$i]['svalue'];
                                if (isset($arr[$i]['svalue2'])) $arr2[$arr[$i]['skey']] .= ' - '.$arr[$i]['svalue2'];
                                if (isset($arr[$i]['svalue3'])) $arr2[$arr[$i]['skey']] .= ' - '.$arr[$i]['svalue3'];
                                if (isset($arr[$i]['svalue4'])) $arr2[$arr[$i]['skey']] .= ' - '.$arr[$i]['svalue4'];
                                if (isset($arr[$i]['svalue5'])) $arr2[$arr[$i]['skey']] .= ' - '.$arr[$i]['svalue5'];
                        }
                $arr =& $arr2;
                //if (count($arr)>50) return $this->select2_form($name, $arr, $selected);
                //else return $this->select1_form($name, $arr, $selected);
                return $this->select1_form($name, $arr, $selected);
        }


	// generate select form
	// input: $name, $arr, $selected, $multiple
	// output:
	// <select name=$name $multiple>
	//  <option $selected value=$arr[skey]> $arr[svalue] </option>
	// </select>
	function select_form($name, $arr, $selected='', $multiple=0, $js='') {
		return $this->select1_form($name, $arr, $selected, $multiple, $js);
	}

	// warning .......
	// rebuild arr // need to reduce cost ...
	function rebuild_arr(&$arr) {
//echo '<br>'.getmicrotime();
		if (is_array($arr[0]))
			//for ($i=0;$i<count($arr);$i++) {
			//while ($arr) {
				//$element = array_pop($arr);
				//$element = $arr[$i];
			foreach ($arr as $key => $element) {
				$arr2[$element['skey']] = $element['svalue'];
				if (isset($element['svalue2'])) $arr2[$element['skey']] .= ' - '.$element['svalue2'];
				if (isset($element['svalue3'])) $arr2[$element['skey']] .= ' - '.$element['svalue3'];
				if (isset($element['svalue4'])) $arr2[$element['skey']] .= ' - '.$element['svalue4'];
				if (isset($element['svalue5'])) $arr2[$element['skey']] .= ' - '.$element['svalue5'];
				unset($arr[$key]);
			}
//echo '<br>'.getmicrotime();
		$arr =& $arr2;
		return $arr;
	}

	// generate select form
	/*
	{Khad}
    Suggestion:
	These methods: select_form* select_arr* should be moved to class.form or VIEW class (think MVC)
	because output some html, and its purpose is not in model

    Suggestion 2:
    This class namanya seharusnya Model, class.model.php
    Controller adalah di bagian bawah file-file yang di direktory aktor, yaitu yang case postadd: etc.

    Suggestion 3:
    Directory actor harusnya namanya action,
    nah nanti kalau sudah keren kita bisa buat direktori view... khusus untuk presentation layer

	function select1_form($name, $arr, $selected='', $multiple=0) {
		print "ERROR: Old method, now use $form->select1_form()";
	}
	*/

	function select1_form_v01($name, $arr, $selected='', $multiple=0) {
                if ($multiple) $extra_select = 'multiple';
                $str = '<select class=text name="'.$name.'" '.$extra_select.'>';
                foreach ($arr as $key => $value) {
                        $str .= '<option value=\''.$key.'\'';
                        if ($selected==$key) $str .= ' selected';
                        $str .= '>'.$value.'</option>';
                }
                $str .= '</select>';
                return $str;
        }


	function select1_form($name, $arr, $selected='', $multiple=0, $js='') {
		$arr = $this->rebuild_arr($arr);
		if ($multiple) $extra_attr = 'multiple';
		if ($js) $extra_attr .= ' onchange="OnChange'.$name.'()"';
		$str = '<select class=text name="'.$name.'" '.$extra_attr.'>';
		foreach ($arr as $key => $value) {
			if ($selected==$key) { 
				$extra = ' selected'; 
			} else {
				$extra = '';
			}
			$str .= '<option value=\''.htmlspecialchars($key, ENT_QUOTES).'\''.$extra.'>'.$value.'</option>';
		}
		$str .= '</select>';
		$str .= $this->onchange_js($name, $js);
		return $str;
	}
	
	function protect_form($name, $arr, $selected='', $js='', $hidden='') {
		$arr = $this->rebuild_arr($arr);
		if (is_array($arr) && count($arr)) {
			if (is_array($selected) && count($selected)) {
				foreach ($arr as $key => $value) {
					if ($selected[$key] == $key) {
						if ($str) $str .= '<br>';
						$str .= '<input type="hidden" name="'.$name.'" value="'.htmlspecialchars($key, ENT_QUOTES).'">';
						if (! $hidden) $str .= $value;
					}
				}
			} else {
				foreach ($arr as $key => $value) {				
					if ($selected == $key) {
						if ($str) $str .= '<br>';
						$str .= '<input type="hidden" name="'.$name.'" value="'.htmlspecialchars($key, ENT_QUOTES).'">';
						if (! $hidden) $str .= $value;						
					}
				}				
			}
		} else {
			$key = $selected;
			$value = $selected;
			if ($str) $str .= '<br>';
			$str .= '<input type="hidden" name="'.$name.'" value="'.htmlspecialchars($key, ENT_QUOTES).'">';
			if (! $hidden) $str .= $value;			
		}
		$str .= $this->onchange_js($name, $js);
		return $str;
	}
	
	function hidden_form($name, $arr, $selected='', $js='') {
		return $this->protect_form($name, $arr, $selected, $js, 1);
	}
	
	function text_form($name, $selected='') {
		$str = '<input type="text" name="'.$name.'" value="'.htmlspecialchars($selected, ENT_QUOTES).'" class="text">';
		return $str;
	}
	
	function checkbox_form($name, $selected='', $js='') {
		if ($selected == '1') $extra_attr = ' checked ';
		if ($js) $extra_attr .= ' onClick="OnChange'.$name.'();" ';
		$str = '<input type="checkbox" name="'.$name.'" '.$extra_attr.'>';
		$str .= $this->onchange_js($name, $js);
		return $str;
	}	
	
	function onchange_js($name, $js) {
		if ($js) {
			$str .= '
        	<script language="javascript">
        		function OnChange'.$name.'() {
        		'.$js.'
        	}
        	</script>
			';
		}				
		return $str;		
	}
	
	function calendar_form($name, $selected='', $extra_attr='') {
		$date_format = $GLOBALS['date_format'];
		
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
		$size = $mlt;
		$max_length = $mlt;
		if (! $selected) {
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
			$value = htmlentities(date($date_format ,$selected));
		}
		if ($GLOBALS['calendar_js']) {
			$GLOBALS['i_need_calendar_js'] = TRUE;
			$extra_con = 
				'<a href="#" onclick=" ppcDF=\''.$date_format.'\'; getCalendarFor(document.theform.'.$name.'); return false;">'.
				'<img src='.$GLOBALS['path_theme'].'/images/calendar.gif border=0 />'.'</a>';
		}
		$str = '<input type="text" name="'.$name.'" value="'.htmlspecialchars($value, ENT_QUOTES).'" class="text" size="'.$size.'" maxlength="'.$max_length.'" '.$extra_attr.'>'.$extra_con;
		return $str;
	}

	function select2_form_v01($name, $arr, $selected='', $multiple=0) {
                $md5_name = 'A'.substr(session::random_string(), 0, 2);
                $str = '<div style="width:200px;height:50px;overflow:auto;border:1px inset;" name="'.$md5_name.'_list">';
                $i = 0;

                if ($multiple) {
                $select_js = <<< EOT
<script language=javascript>
function {$md5_name}ToggleAll(e,f){ if(e.checked){ {$md5_name}CheckAll(f);}else{ {$md5_name}ClearAll(f);}}
function {$md5_name}CheckAll(f){ var ml=f;var len=ml.elements.length;for(var i=0;i<len;i++){ var e=ml.elements[i];if(e.name=="{$name}[]"){ {$md5_name}Check(e);}}ml.{$md5_name}toggleAll.checked=true;}
function {$md5_name}ClearAll(f){ var ml=f;var len=ml.elements.length;for(var i=0;i<len;i++){ var e=ml.elements[i];if(e.name=="{$name}[]"){ {$md5_name}Clear(e);}}ml.{$md5_name}toggleAll.checked=false;}
function {$md5_name}Check(e){ e.checked=true;}
function {$md5_name}Clear(e){ e.checked=false;}
function {$md5_name}Toggle(e,f){ if(e.checked){ f.{$md5_name}toggleAll.checked={$md5_name}AllChecked(f);}else{ f.{$md5_name}toggleAll.checked=false;}}
function {$md5_name}AllChecked(f){ ml=f;len=ml.elements.length;for(var i=0;i<len;i++){ if(ml.elements[i].name=="{$name}[]"&&!ml.elements[i].checked){ return false;}}return true;}
function {$md5_name}CheckMe(f,c){ var ml=f;var len=ml.elements.length;for(var i=0;i<len;i++){ var e=ml.elements[i];if(e.value==c){ if (e.checked){ {$md5_name}Clear(e);} else{ {$md5_name}Check(e);} {$md5_name}Toggle(e,f);}}}
</script>
EOT;

                $str .= $select_js.'<input type=checkbox name='.$md5_name.'toggleAll onclick="javascript:'.$md5_name.'ToggleAll(this,document.theform);"><a href="#" onClick="javascript:document.theform.'.$md5_name.'toggleAll.checked=!document.theform.'.$md5_name.'toggleAll.checked       ;'.$md5_name.'ToggleAll(document.theform.'.$md5_name.'toggleAll,document.theform);">Check All</a><br>';
                $input_type = 'checkbox';
                } else {
                $input_type = 'radio';
                }
                foreach ($arr as $key => $value) {
                        $str .= '<input type='.$input_type.' onClick="javascript:'.$md5_name.'Toggle(this, document.theform);" name=\''.$name.'[]\' value=\''.$key.'\'';
                        if ($selected[$key]) $str .= ' checked';
                        $str .= '><a href="#" onClick="javascript:'.$md5_name.'CheckMe(document.theform, \''.$key.'\');">'.$value.'</a><br>';
                        $i++;
                }
                $str .= '</select>';
                return $str;
        }

	// generate another select form with inset
	function select2_form($name, $arr, $selected='', $multiple=0, $js='', $column_split=1) {
		$arr = $this->rebuild_arr($arr);
		$md5_name = 'A'.substr(session::random_string(), 0, 2);

		if ($multiple) {
			$select_js = <<< EOT
<script language=javascript>
function {$md5_name}ToggleAll(e,f){ if(e.checked){ {$md5_name}CheckAll(f);}else{ {$md5_name}ClearAll(f);}}
function {$md5_name}CheckAll(f){ var ml=f;var len=ml.elements.length;for(var i=0;i<len;i++){ var e=ml.elements[i];if(e.name=="{$name}[]"){ {$md5_name}Check(e);}}ml.{$md5_name}toggleAll.checked=true;}
function {$md5_name}ClearAll(f){ var ml=f;var len=ml.elements.length;for(var i=0;i<len;i++){ var e=ml.elements[i];if(e.name=="{$name}[]"){ {$md5_name}Clear(e);}}ml.{$md5_name}toggleAll.checked=false;}
function {$md5_name}Check(e){ e.checked=true;}
function {$md5_name}Clear(e){ e.checked=false;}
function {$md5_name}Toggle(e,f){ if(e.checked){ f.{$md5_name}toggleAll.checked={$md5_name}AllChecked(f);}else{ f.{$md5_name}toggleAll.checked=false;}}
function {$md5_name}AllChecked(f){ ml=f;len=ml.elements.length;for(var i=0;i<len;i++){ if(ml.elements[i].name=="{$name}[]"&&!ml.elements[i].checked){ return false;}}return true;}
function {$md5_name}CheckMe(f,c){ var ml=f;var len=ml.elements.length;for(var i=0;i<len;i++){ var e=ml.elements[i];if(e.value==c){ if (e.checked){ {$md5_name}Clear(e);} else{ {$md5_name}Check(e);} {$md5_name}Toggle(e,f);}}}
</script>
EOT;
			$multi = $select_js.
				'<input type="checkbox" '.
				'name="'.$md5_name.'toggleAll" '.
				'id="'.$md5_name.'toggleAll" '.
				'onclick="javascript:'.
				$md5_name.'ToggleAll(this,document.theform);">'.
				'<label for="'.$md5_name.'toggleAll">'.
				'Check All</label><br>';
			$input_type = 'checkbox';
			$name = $name.'[]';
			$count_arr = 1;
		} else {
			$input_type = 'radio';
			$count_arr = 0;
		}

		//$column_split = 1;
		$total_element = count($arr);
		$per_column = ceil(($total_element+1)/$column_split);
		//echo $per_column.'<br>';//exit;
		$curr_column = 0;
		if ($multi) $cstr[$curr_column] .= $multi;// $curr_column++;
		//print_r($arr);exit;
		//print_r($selected);exit;
		if (is_array($arr)&&count($arr)) {
			foreach ($arr as $key => $value) {
				if (($count_arr%$per_column) == 0) {
					$curr_column++;
				}			
				if ($key === '') continue;
				$cstr[$curr_column] .= '<input type='.$input_type.' onClick="javascript:'.$md5_name.'Toggle(this, document.theform);" id="'.$md5_name.$count_arr.'" name=\''.$name.'\' value=\''.htmlspecialchars($key, ENT_QUOTES).'\'';
				if ($multi && $selected[$key] === TRUE) $cstr[$curr_column] .= ' checked';
				if ($selected === $key) $cstr[$curr_column] .= ' checked';
				$cstr[$curr_column] .= '><label for="'.$md5_name.$count_arr.'">'.$value.'</label><br>';
				$count_arr ++;
				//if (($count_arr%$per_column) == 0) {
				//	$curr_column++;
				//}
			}
		}
		//print_r($cstr);exit;
		$str .= '<table border=0 cellpadding=0 cellspacing=0 width="100%"><tr>';
		$width_column = ceil(100 / $column_split);
		for($i=0;$i<$column_split;$i++) {
			$str .= '<td valign="top" width="'.$width_column.'%"><nobr>'.$cstr[$i].'</nobr></td>';
		}
		$str .= '</table>';
		
		$str .= '</select>';
		$str .= '</div>';
		$total_height = $per_column * 19;
		if ($total_height > 125) $total_height = 125;
		$str = '<div style="width:100%;'.
//			'height:'.(($count_arr+1)*19).'px;'.
//			'height:'.(($per_column)*20).'px;'.
			'height:'.($total_height).'px;'.
			'overflow:auto;border:0px inset;" '.
			'name="'.$md5_name.'_list">'.
			$str;

		return $str;
	}

	function select3_form($name, $arr, $selected='', $multiple=0, $js='', $column_split=1) {
		//echo '<BR>'.getmicrotime();exit;
		$arr = $this->rebuild_arr($arr);
		//echo '<BR>'.getmicrotime();exit;		
		$md5_name = 'A'.substr(session::random_string(), 0, 2);
		if (is_array($arr)&&count($arr)) {
			foreach ($arr as $key => $value) {
				$value = strtolower($value);
				//$js_data .= 'Ff'.$md5_name.'.push("'.$value.'#'.$key.'");'."\n";
				if ($selected[$key] === TRUE) {
					//$js_data2 .= 'Ft'.$md5_name.'.push("'.$value.'#'.$key.'");'."\n";
					$chosen .= 
						'<option value="'.htmlspecialchars($key, ENT_QUOTES).'">'.
						htmlentities($value).
						'</option>';
				}// else {
					$possible .= 
					'<option value="'.htmlspecialchars($key, ENT_QUOTES).'">'.
					htmlentities($value).
					'</option>';
				//}
			}
			$this->rule = "\n".'asSL'.$md5_name.'()';
/*
<!-- <input type=text class=text name="to_{$md5_name}" width=200 style="width:200px"><br> -->
*/
			$str = <<< EOT
<table border=0 width=100% cellpadding=0 cellspacing=0>
	<tr>
		<td width=30% align=left valign=top>
			<div align=center>Selected List</div>
			<select class=text name="{$name}[]" size="7" multiple width=200 style="width:200px">
			{$chosen}
			</select>
		</td>
		<td width=30% align=center valign=middle>
			<input type=button class=button 
			onClick="RtL_{$md5_name}()" value="&lt;--"><br>
			<input type=button class=button 
			onClick="LtR_{$md5_name}()" value="--&gt;">
		</td>
		<td width=30% align=right valign=top>
			<div align=center>All List</div>
			<input type=text class=text name="from_{$md5_name}" width=200 style="width:200px"><br>	
			
			<div id="AL{$md5_name}" style="DISPLAY:block">
			<select class=text name="AL{$md5_name}[]" size="6" multiple width=200 style="width:200px">
			$possible
			</select>
			</div>
			
			<div id="AP{$md5_name}" style="DISPLAY:none">
			<select class=text name="AP{$md5_name}[]" size="6" multiple width=200 style="width:200px">
			</select>
			</div>
		</td>
	</tr>
</table>

<script language="javascript" src="{$GLOBALS['path_theme']}/javascript/search.js"></script>
<script language="javascript">
	// move selected Left to Right
	function LtR_{$md5_name}() {
		fromList = t{$md5_name};
		toList = f{$md5_name};
		for (i=0;i<fromList.options.length;i++) {
			current = fromList.options[i];
			if (current.selected) {
				sel = true;
				fromList.options[i] = null;
				i--;
			}
		}
		if (!sel) alert ('You haven\'t selected any options!');		
	}

	// move selected Right to Left
	function RtL_{$md5_name}() {
		//ALtPL{$md5_name}();
		sel = false;
		Fua = gE('AL{$md5_name}');
		Fuas = Fua.style;
		Fuasd = Fuas.display;
		if (Fuasd == 'block') {
			fromList = P{$md5_name};
		} else {
			fromList = f{$md5_name};
		}
		toList = t{$md5_name};
		for (i=0;i<fromList.options.length;i++) {
			current = fromList.options[i];
			if (current.selected) {
				sel = true;
				toList.options[toList.length] = new Option(current.text,current.value);
				fromList.options[i] = null;
				i--;
			}
		}
		if (!sel) alert ('You haven\'t selected any options!');
		else sSL{$md5_name}();
	}

	// sort SelectedList
	function sSL{$md5_name}() {
		toList = t{$md5_name};
		Fk = new Array();
		for (i=0;i<toList.options.length;i++) {
			Fk.push(toList.options[i].text+'#'+toList.options[i].value);
		}
		Fk = Fk.sort().toString().split(',');
		toList.options.length = 0;
		prev = '';
		while (Fk.length > 0) {
			str = Fk.shift();
			if (prev != str) {
				pstr = str.split('#');
				txt = pstr[0];
				val = pstr[1];
				toList.options[toList.length] = new Option(pstr[0],pstr[1]);
				prev = str;
			}
		}
		Fk = null;
	}
	
	// move selected in AllList to PossibleList
	/*
	function ALtPL{$md5_name}(){
		Fua = gE('AL{$md5_name}');
		if (Fua.style.display == 'block') {
			for (i=0;i<P{$md5_name}.options.length;i++) {
				current = P{$md5_name}.options[i];
				if (current.selected) {
					txt = current.text;
					val = current.value;			
					f{$md5_name}.options[f{$md5_name}.length] = new Option(txt,val,true);
				}
			}
		}
	}
	*/

	// all selected on SelectedList
	function asSL{$md5_name}() {
		toList = t{$md5_name};
		for (i=0;i<toList.options.length;i++) { current = toList.options[i].selected = true; }
	}
	
	// mapping element needed
	ml=Fu.theform;
    len=ml.elements.length;
    for(i=0;i<len;i++) {
            e=ml.elements[i];
            if (e.name=='AP{$md5_name}[]') { f{$md5_name} = e; }
            else if (e.name=='{$name}[]') { t{$md5_name} = e; }
            else if (e.name=='AL{$md5_name}[]') { P{$md5_name} = e; }
    }

	// build array from options all list
    //Ff{$md5_name} = new Array();	
	//for (i=0;i<P{$md5_name}.options.length;i++) {
	//	Ff{$md5_name}.push(P{$md5_name}.options[i].text+'#'+P{$md5_name}.options[i].value);
	//}

	// initialize
	var Fmf{$md5_name} = new Array();
	var Fgf{$md5_name} = 0;
	var Fcf{$md5_name} = 0;
	var FCf{$md5_name} = "";
	var FNf{$md5_name} = "";
	var fFa{$md5_name} = Fu.theform.from_{$md5_name};

    function a{$md5_name}() { 
    	cList = f{$md5_name};
    	PList = P{$md5_name};
    	amd5  = "AL{$md5_name}";
    	bmd5  = "AP{$md5_name}";
    	
    	//Ff = Ff{$md5_name};
    	Ff = P{$md5_name}
    	Fm = Fmf{$md5_name};
    	Fg = Fgf{$md5_name};
    	Fc = Fcf{$md5_name};
    	FC = FCf{$md5_name};
    	FN = FNf{$md5_name};
    	Fa = fFa{$md5_name};
    }
	function az{$md5_name}() {
		Ff{$md5_name}  = Ff;
		Fmf{$md5_name} = Fm;
		Fgf{$md5_name} = Fg;
		Fcf{$md5_name} = Fc;
		FCf{$md5_name} = FC;
		FNf{$md5_name} = FN;
		fFa{$md5_name} = Fa;
	}
	
    function aFU_{$md5_name}(evt) { a{$md5_name}(); FU(evt); az{$md5_name}(); }
	function aFFe_{$md5_name}() {   a{$md5_name}(); FFe();   az{$md5_name}(); }
	function aFFd_{$md5_name}() {   a{$md5_name}(); FFd();   az{$md5_name}(); }
	function aFX_{$md5_name}(evt) { a{$md5_name}(); FX(evt); az{$md5_name}(); }
	function aFY_{$md5_name}(evt) { a{$md5_name}(); FY(evt); az{$md5_name}(); }
	
	//fFa{$md5_name}.onkeypress=aFU_{$md5_name};
	//fFa{$md5_name}.onfocus=aFFe_{$md5_name};
	//fFa{$md5_name}.onblur=aFFd_{$md5_name};
	//fFa{$md5_name}.onkeydown=aFX_{$md5_name};
	fFa{$md5_name}.onkeyup=aFY_{$md5_name};	
	
</script>

EOT;
		}

		return $str;
	}
	
	// generate welcome content
	// output: <table><tr><td>Welcome $login_id</td></tr></table>
	// {khad} this is OK for simplicity
        function welcome_content() {
		global $ses, $adodb;
                $_block = new block();
                $_block->set_config('title', 'Welcome Message');
                $_block->set_config('width', '90%');
		$rs = $adodb->Execute("SELECT * FROM ".$ses->action." WHERE userid='".$ses->loginid."'");
		if (ereg('pendaftar', $ses->action)) $who = $rs->fields[nama_pendaftar];
		else $who = $ses->loginid;
                $_block->parse(array('Welcome '.$who.' ...'));
                return $_block->get_str();
        }

	// exit from system
	function logout() {
		session::destroy();
	}

	// parse currency
	// input: 200.000, output: 200000
	function parsecurrency($str) {
		if (number_format(str_replace('.', '', $str), 0, '', '.')==$str)
			return str_replace('.', '', $str);
		else
			return $str;
	}

	// parse date
	function parsedate($str) {
		// parsedate function definition on class pager
		require_once 'class.pager.inc.php';
		return parsedate($str);
	}

	// formatted integer value
	// input: 200000, output: 200.000
	// input: -10000, output: -10.000
	function format_value($str) {
		$str .= "";
		if ($str<0) {
			$negative = TRUE;
			$str = substr($str, 1);
		}
		$newstr = '';
		for ($i=strlen($str)-1;$i>=0;$i=$i-3) {
			if ($i>2) {
				$newstr = '.'.$str[$i-2].$str[$i-1].$str[$i].$newstr;
			} else {
				for ($j=$i;$j>=0;$j--) {
					$newstr = $str[$j].$newstr;
				}
			}
		}
		if ($negative) $newstr = "-".$newstr."";

		return $newstr;
	}

	// slip element $field_arr
	// before: $field_arr = *field_a, field_b, +field_c
	// input: $config, field_c, before, field_a
	// after: $field_arr = +field_c, *field_a, field_b
	function slip_field(&$config, $a, $rule, $b) {
		eval($this->load_config);
		//$tmp = $field_arr[$a];
		$new_arr = array();
		foreach ($field_arr as $k => $v) {
			if ($v['name'] == $a)
				$index = $k;
		}
		$value = $field_arr[$index];
		unset($field_arr[$index]);
		foreach ($field_arr as $k => $v) {
			if ($v['name'] == $b)
				if ($rule == 'before')
					$new_arr[] = $value;
			$new_arr[] =& $field_arr[$k];
			if ($v['name'] == $b)
				if ($rule == 'after')
					$new_arr[] = $value;
		}
		$field_arr = $new_arr;
	}

	// swap element $field_arr
	// before: $field_arr = *field_a, field_b, +field_c
	// input: $config, field_c, field_c
	// after: $field_arr = +field_c, field_b, *field_a
	function swap_field(&$config, $a, $b) {
		eval($this->load_config);
		$tmp = $field_arr[$a];
		$field_arr[$a] = $field_arr[$b];
		$field_arr[$b] = $tmp;
	}
	
	function delete_field(&$config, $a) {
		eval($this->load_config);
		foreach ($field_arr as $k => $v) {
			if ($v['name'] == $a) {
				unset ($field_arr[$k]);
			}
		}
	}
	
	function search_field(&$config, $a) {
		eval($this->load_config);
		foreach ($field_arr as $k => $v) {
			if ($v['name'] == $a) {
				return TRUE;
			}
		}
		return FALSE;
	}

	// change property of element property
	// before: $field_arr ['vendor_code']['max_length'] = -1
	// input: $config, vendor_code, max_length, 3
	// after: $field_arr ['vendor_code']['max_length'] = 3
	function change_field(&$config, $a, $b, $c) {
		eval($this->load_config);
		for ($i=0;$i<count($field_arr);$i++) {
			if ($field_arr[$i]['name'] == $a) {
				$field_arr[$i][$b] = $c;
			}
		}
	}
	
	function select_form_advance($c) {
		$config =& $c['config'];
        eval($this->load_config);
        $selected = $value_arr[$c['var']];
		include_once 'class.'.$c['table'].'.inc.php';
		$fk_sql = 'SELECT '.$c['value'].' as skey, '.$c['text'].' as svalue FROM '.$c['table'].' ORDER BY svalue';
		eval('$result = '.$c['table'].'::select($fk_sql);');
		if ($c['value0'] || $c['text0']) 
			$default_value = array(array ('skey' => $c['value0'],'svalue' => $c['text0']));
		$result = array_merge($default_value, $result);
		$optional_arr[$c['var']] = 'user_defined';
		$value_arr[$c['var']] = $this->select_form($c['var'], $result, $selected);
		
	}

        function log($str) {
                global $adodb, $ses;
                $str = strip_tags($str);
                $record = array();
                $record[username] = $ses->loginid;
                $record[usertype] = $_SESSION[usertype];
                $record[activity] = $str;
                $record[date_time] = time();
                $rs = $adodb->Execute("SELECT * FROM log_intern LIMIT 1");
                $adodb->Execute($adodb->GetInsertSQL($rs, $record));
        }

}
?>

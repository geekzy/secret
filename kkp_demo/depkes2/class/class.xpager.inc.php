<?php

class xpager {
	function xpager() {}
	function render($arr) {
		global $adodb, $date_format;
		$sql = $arr[sql];
		$opt = $arr[opt];
		$label = $arr[label];
		$auto = isset($arr[auto]) ? $arr[auto] : TRUE;
		$eval = $arr['eval'];
		
		$xtable = "<table [attr]>\n";
		$xtr = "<tr [attr]>\n";
		$th = "<th [attr]>[data]</th>\n";
		$td = "<td [attr]>[data]</td>\n";
		$ztr = "</tr>\n";
		$ztable = "</table>\n";
		
		$rs = $adodb->Execute($sql);

		include_once 'class.xform.inc.php';
		xform::start();
		echo str_replace('[attr]', 'class=in_table width=90%', $xtable);
		echo str_replace('[attr]', 'class=title_table', $xtr);
               	foreach ($rs->fields as $k => $v) {
			if ($opt[$k]===TRUE) continue;
			$data = $label[$k] ? $label[$k] : $k;
                       	$xth = str_replace('[attr]', '', $th);
			$xth = str_replace('[data]', $data, $xth);
			echo $xth;
		}
		echo $ztr;
		while (! $rs->EOF) {
			$tr = $xtr;
			$data = '';
			foreach ($rs->fields as $k => $v) {
				if ($opt[$k]===TRUE) continue;
				if ($eval[$k]) {
					$str = '';
					eval(str_replace('%s', $v, $eval[$k]));
					$v = $str;
				} else if ($auto) {
					if (strpos($k, '_date') !== false
					|| strpos($k, 'date_') !== false) {
						$v = date($date_format, $v);
					}
				}
	                       	$xtd = str_replace('[attr]', '', $td);
				$xtd = str_replace('[data]', $v, $xtd);
				$data .= $xtd;
			}
			$tr = str_replace('[attr]', '', $tr);
			echo $tr.$data.$ztr;
			$rs->MoveNext();
		}
		echo $ztable;
		return xform::stop();
	}
}

?>

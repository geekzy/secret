<?php
	
	#require_once 'class.template.inc.php';
	#require_once 'class.block.inc.php';

	if (! function_exists('_stripspaces')) {
		function stripspaces($str)
		{
			$str = trim($str);
			$str = ereg_replace(" +", " ", $str);
			return $str;
		}
	}


	
	if (! function_exists('__')) {
        	function __($str) {
			return $str;
        	}
        }

	if (! isset($GLOBALS['chromeless_js'])) {
        $pager_chromeless_js = <<< EOT
<script language=javascript>
var win = null;
function openIT(u,W,H,X,Y,n,b,x,m,r) {
//LeftPosition = (screen.width) ? (screen.width-W)/2 : 0;
//TopPosition = (screen.height) ? (screen.height-H)/2 : 0;
W = screen.width;
H = screen.height;
LeftPosition = TopPosition = 0;
settings = 'height='+H+',width='+W+',top='+TopPosition+',left='+LeftPosition+ ',scrollbars=1,resizable=0,toolbar=0,location=0,directories=0,status=0,menubar=0';
win  = window.open(u,n,settings);
return win;
}
</script>
EOT;

	}

        if (! function_exists('getmicrotime')) {
	        function getmicrotime(){
       	        	list($usec, $sec) = explode(" ",microtime());
	       	        return ((float)$usec + (float)$sec);
        	}
		if (! isset($GLOBALS['page_time_start'])) $GLOBALS['page_time_start'] = getmicrotime();
        }


	if (! function_exists('next_action')) {
		function next_action($str) {
			global $PHP_SELF, $self_close_js, $sCJT;
			if ($sCJT) {
				$sCJS = $sCJT;
				$sCJS = str_replace('{PHP_SELF}', $PHP_SELF, $sCJS);
				$sCJS = str_replace('{next_action}', '', $sCJS);
				$self_close_js = $sCJS;
			} else {
				$self_close_js =
				'<script language=javascript>'.
				'self.setTimeout(\''.
				'window.top.opener.location = \\\''.
				$PHP_SELF.'?'.
				'action='.
				$str.
				'\\\';'.
				'window.top.opener.focus();'.
				'window.top.close();\', 500);'.
				'</script>';
			}
		}
	}
	
	// require parsedate function
	if (! function_exists('parsedate')) {
		function parsedate($str) {
                        if (! $GLOBALS['date_format']) {
                                $GLOBALS['date_format'] = 'Y-m-d H:i:s';
                        }

                        if (! $GLOBALS['date_ereg']) {
                                $GLOBALS['date_ereg'] = str_replace('Y', '([0-9][0-9][0-9][0-9])', $GLOBALS['date_format']);
                                $GLOBALS['date_ereg'] = str_replace('m', '([0-9][0-9])', $GLOBALS['date_ereg']);
                                $GLOBALS['date_ereg'] = str_replace('d', '([0-9][0-9])', $GLOBALS['date_ereg']);
                                $GLOBALS['date_ereg'] = str_replace('H', '([0-2][0-9])', $GLOBALS['date_ereg']);
                                $GLOBALS['date_ereg'] = str_replace('i', '([0-5][0-9])', $GLOBALS['date_ereg']);
                                $GLOBALS['date_ereg'] = str_replace('s', '([0-5][0-9])', $GLOBALS['date_ereg']);
                        }

                        if (! $GLOBALS['date_eval']) {
                                $GLOBALS['date_eval'] = 'mktime([H], [i], [s], [m], [d], [Y])';
                                $tmp_format = ereg_replace('[^HismdY]', '', $GLOBALS['date_format']);
                                for ($i=0;$i<strlen($tmp_format);$i++) {
                                        if ($tmp_format[$i]=='H') {
                                                $GLOBALS['date_eval'] = str_replace('[H]', '$regs['.($i+1).']', $GLOBALS['date_eval']);
                                        } else if ($tmp_format[$i]=='i') {
                                                $GLOBALS['date_eval'] = str_replace('[i]', '$regs['.($i+1).']', $GLOBALS['date_eval']);
                                        } else if ($tmp_format[$i]=='s') {
                                                $GLOBALS['date_eval'] = str_replace('[s]', '$regs['.($i+1).']', $GLOBALS['date_eval']);
                                        } else if ($tmp_format[$i]=='m') {
                                                $GLOBALS['date_eval'] = str_replace('[m]', '$regs['.($i+1).']', $GLOBALS['date_eval']);
                                        } else if ($tmp_format[$i]=='d') {
                                                $GLOBALS['date_eval'] = str_replace('[d]', '$regs['.($i+1).']', $GLOBALS['date_eval']);
                                        } else if ($tmp_format[$i]=='Y') {
                                                $GLOBALS['date_eval'] = str_replace('[Y]', '$regs['.($i+1).']', $GLOBALS['date_eval']);
                                        }
                                }
                        }

			if (ereg('^'.$GLOBALS['date_ereg'].'$', $str, $regs)) {
				eval('$timestamp = '.$GLOBALS['date_eval'].';');
			}
			$timestamp = intval($timestamp);
			return $timestamp;
		}
	}
/*
	if (! class_exists('PDF')) {
define('FPDF_FONTPATH','class/fpdf/font/');
require_once ('class/fpdf/fpdf.php');

class PDF extends FPDF
{
function FancyTable($arr)
{

    $w = $arr[width];
    $l = $arr[align];
    $header = $arr['header'];
    $body = $arr[data];
    
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial','B',8);

    foreach($header as $row) {
    	if (is_array($row)) $data =& $row;
    	else $data = explode('|', $row);
    	$a=0;
	foreach ($data as $col) {
		$col = pager::unhtmlentities(strip_tags($col));
	    	if ($w[$a]) $this->Cell($w[$a],7,$col,1,0,'C',1);
        	$a++;
	}
    }
    $this->Ln();

    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');

    $a=0;
    $fill=0;
    foreach($body as $row)
    {
    	if (is_array($row)) $data =& $row;
    	else $data = explode('|', $row);
        $a=0;
        foreach($data as $col) {
		$col = pager::unhtmlentities(strip_tags($col));
		if ($l[$a]) $li = $l[$a];
		else $li = '';
		if ($w[$a]) $this->Cell($w[$a],6,$col,'LR',0,$li,$fill);
		$a++;
        }
        $this->Ln();
	$fill=!$fill;
    }
}
function Footer($str)
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Text color in gray
    $this->SetTextColor(128);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
/*
function Header()
{
    global $company,$slogan;

    //$this->Image('logo_pb.png',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Calculate width of title and position
    $w=$this->GetStringWidth($company)+6;
    //$this->SetX((210-$w)/2);
    //Colors of frame, background and text
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,0);
    $this->SetTextColor(220,50,50);
    //Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    //Title
    $this->Cell($w,7,$company,'LRT',1,'',1);
    $this->Ln(0);
    $this->SetFont('Arial','',10);
    $this->Cell($w,4,$slogan,'LRB',1,'',1);
    //Line break
    $this->Ln(5);
}
* /
function ChapterTitle($label)
{
    //Arial 12
    $this->SetFont('Arial','',12);
    //Background color
    $this->SetFillColor(200,220,255);
    //Title
    $this->Cell(0,6,"$label",0,1,'C',1);
    //Line break
    $this->Ln(4);
}
function ChapterFooter($label)
{
    $this->Ln(4);
    $this->SetFont('Arial','',12);
    //Background color
    //$this->SetFillColor(200,220,255);
    //Title
    $this->Cell(0,6,"$label",0,0,'C',1);
    //Line break
}}
	}
*/

	if (class_exists('pager')) {
		return 0;
	} else if (defined('CLASS_PAGER')) {
		return 0;
	} else {
		define('CLASS_PAGER', TRUE);
	}

class pager {
	var $id; 	// unique id for pager (defaults to 'adodb')
	var $db; 	// ADODB connection object
	var $sql; 	// sql used
	var $rs;	// recordset generated
	var $curr_page;	// current page number before Render() called, calculated in constructor
	var $rows;	// number of rows per page

	var $cache = 10;  #secs to cache with CachePageExecute()
	var $input_arr;
	var $optional_arr;
	var $var_arr;
	var $field_arr;
	var $eval_arr;
	var $sum_arr;
	var $pdf_arr;
	
	var $orderby_sql;
	var $disorder;
	var $type_arr;
	var $keyword;

	var $header_view;
	var $search_view;
	var $date_search_view;
	var $order_view;
	var $export_view;

	var $excel_save;
	var $csv_save;
	var $pdf_save;

	var $fix_key;
	var $bad_key;
	var $hideS_arr;
	
	var $row_view;
	var $pager_arr;

	function parsedate2($str) {
		$tmp = $str;
		$piece = explode(" ", $tmp);
		$p1 = explode("-", $piece[0]);
		$p2 = explode(":", $piece[1]);
		$out = $GLOBALS['date_format'];
		$out = str_replace("d", sprintf("%02s", $p1[2]), $out);
		$out = str_replace("m", sprintf("%02s", $p1[1]), $out);
		$out = str_replace("Y", sprintf("%04s", $p1[0]), $out);
		$out = str_replace("H", sprintf("%02s", $p2[0]), $out);
		$out = str_replace("i", sprintf("%02s", $p2[1]), $out);
		$out = str_replace("s", sprintf("%02s", $p2[2]), $out);	
		return $out;
	}
	
	function parsedate3($str) {
		$value = $GLOBALS['date_format'];
		$value = str_replace('Y', 'YYYY', $value);
		$value = str_replace('y', 'yy', $value);
		$value = str_replace('m', 'mm', $value);
		$value = str_replace('d', 'dd', $value);
		$value = str_replace('h', 'hh', $value);
		$value = str_replace('H', 'HH', $value);
		$value = str_replace('i', 'ii', $value);
		$value = str_replace('s', 'ss', $value);	
		for ($i=0;$i<strlen($value);$i++) {
			switch ($value[$i]) {
				case 'd': $dd .= $str[$i]; break;
				case 'm': $mm .= $str[$i]; break;
				case 'Y': $yy .= $str[$i]; break;
				case 'H': $hh .= $str[$i]; break;
				case 'i': $ii .= $str[$i]; break;
				case 's': $ss .= $str[$i]; break;
			}
		}
		$out = "Y-m-d";
		$out = str_replace("Y", $yy, $out);
		$out = str_replace("m", $mm, $out);
		$out = str_replace("d", $dd, $out);
		return "'$out'";
	}
	
	function parsedate4($str) {
		for ($i=0;$i<strlen($str);$i++) {
			switch ($str[$i]) {
				case 'd': $dd .= $str[$i]; break;
				case 'm': $mm .= $str[$i]; break;
				case 'Y': $yy .= $str[$i]; break;
				case 'H': $hh .= $str[$i]; break;
				case 'i': $ii .= $str[$i]; break;
				case 's': $ss .= $str[$i]; break;
			}
		}
		$out = "Y-m-d H:i:s";
		$out = str_replace("Y", $yy, $out);
		$out = str_replace("m", $mm, $out);
		$out = str_replace("d", $dd, $out);
		$out = str_replace("H", $hh, $out);
		$out = str_replace("i", $ii, $out);
		$out = str_replace("s", $ss, $out);
		return "'$out'";
	}
		
	function load_session_vars() {
		global $adodb, $ses;
		$tmp = $_SESSION['session_sid'];
		$rs = $adodb->Execute('SELECT count(*) as count FROM session_vars WHERE loginid = \''.$ses->loginid.'\'');
		if ($rs->fields['count']) {
			$rs = $adodb->Execute('SELECT data FROM session_vars WHERE loginid = \''.$ses->loginid.'\'');
			$_SESSION = array_merge( unserialize(stripslashes($rs->fields['data'])), $_SESSION);
		}
		$_SESSION['session_sid'] = $tmp;
	}
	
	function save_session_vars() {
		global $adodb, $ses;
		$rs = $adodb->Execute('SELECT count(*) as count FROM session_vars WHERE loginid = \''.$ses->loginid.'\'');
		if ($rs->fields['count']) {
			$adodb->Execute('UPDATE session_vars SET data = \''.addslashes(serialize($_SESSION)).'\' WHERE loginid = \''.$ses->loginid.'\'');
		} else {
			$adodb->Execute('INSERT INTO session_vars VALUES (\''.$ses->loginid.'\', \''.addslashes(serialize($_SESSION)).'\')');
		}
	}

	function pager($config) {
	
		if (count($_SESSION)==0) session_start();
		
 		/*
		$this->odd_color = $config[odd_color];
		$this->even_color = $config[even_color];
		$this->col_color = $config[col_color];
		*/
	

		$this->pdf_arr = $config[pdf_arr];


		//$this->load_session_vars();
		$db = $config['db'] ? $config['db'] : $GLOBALS['adodb'];
		$sql = $config['sql'] ? $config['sql'] : '';
		$id = $config['id'] ? $config['id'] : 'adodb';
		$label_arr = $config['label_arr'] ? $config['label_arr'] : '';
		$optional_arr = $config['optional_arr'] ? $config['optional_arr'] : '';
		$var_arr = $config['var_arr'] ? $config['var_arr'] : '';
		$vsel_arr = $config['vsel_arr'];
		$eval_arr = $config['eval_arr'];
		$sum_arr = $config['sum_arr'];
		$hideS_arr = $config['hideS_arr'];
	
		// tombol add, edit, delete dan print
		$label_arr['add_anchor'] = $config['add_anchor'];
		$label_arr['edit_anchor'] = $config['edit_anchor'];
		$label_arr['del_anchor'] = $config['del_anchor'];
		$label_arr['print_anchor'] = $config['print_anchor'];

		// untuk tambahan extra parameter
		// misal di setiap page harus ada variable tertentu
		$label_arr['extra_param'] = $config['extra_param'];

		// buat judul ama lebar
		$label_arr['form_title'] = $config['form_title'];
		$label_arr['form_width'] = $config['form_width'];

		// biar tau primary key
		$label_arr['pk'] = $config['pk'];

		//$this->row_view = 0;
		//$this->row_view = 1; //test
		$this->pager_arr = array();

		// gw pake ini supaya user ga bikin crash
		$this->pager_arr['max_rows'] = 1000;
	
		// user ga bisa liat navigasi
		// biasanya gw pake buat nge-print
		$this->header_view =
			isset($config['header_view']) ?
			$config['header_view'] :
			TRUE;
			
		// user ga bisa search data tipe biasa
		$this->search_view =
			isset($config['search_view']) ?
			$config['search_view'] :
			TRUE;

		// user ga bisa search data tipe tanggal
		$this->date_search_view =
			isset($config['date_search_view']) ?
			$config['date_search_view'] :
			TRUE;
			
		// user ga bisa klik sort by
		$this->order_view =
			isset($config['order_view']) ?
			$config['order_view'] :
			TRUE;

		// ini khusus buat esmsis doank
		if ($GLOBALS['vendor_manager']) {
			if ($GLOBALS['vendor_manager']->get_permission('VADDAV')) {
				$default_export_view = TRUE;
			} else {
				$default_export_view = FALSE;
			}
		} else {
			$default_export_view = TRUE;
		}
	
		// user ga bisa export data
		$this->export_view = 
			isset($config['export_view']) ? 
			$config['export_view'] : 
			$default_export_view;

		$curr_page = $id.'_curr_page'; // current page
		$next_page = $id.'_next_page'; // next page what ?
		$orderby = $id.'_orderby'; // order by what ?
		$orderby_type = $id.'_orderby_type'; // type order by ? asc or desc
		//$sql_str = $id.'_sql';
		$key_str = $id.'_keyword'; // what keyword for search ?
		$fdat_str = $id.'_fdate';
		$tdat_str = $id.'_tdate';
		$fsel_str = $id.'_fselect';
		$vsel_str = $id.'_vselect';
		$asel_str = $id.'_aselect';
		$rsel_str = $id.'_rselect';
		$dsel_str = $id.'_dselect';
		$addv_str = $id.'_addview';
		$delv_str = $id.'_delview';
		$ppag_str = $id.'_per_page';
		$left_str = $id.'_left';
		$righ_str = $id.'_right';
		$diso_str = $id.'_disorder';

		$xls_str = $id.'_xls';
		$csv_str = $id.'_csv';
		$pdf_str = $id.'_pdf';

		// store some variable needed every page ...
		if (! session_is_registered($curr_page)) {	session_register ($curr_page); }
		if (! session_is_registered($orderby)) {	session_register ($orderby); }
		if (! session_is_registered($orderby_type)) { session_register ($orderby_type); }
		//if (! session_is_registered($sql_str)) {	session_register ($sql_str); }
		if (! session_is_registered($key_str)) {	session_register ($key_str); }
		if (! session_is_registered($fdat_str)) {	session_register ($fdat_str); }
		if (! session_is_registered($tdat_str)) {	session_register ($tdat_str); }
		if (! session_is_registered($fsel_str)) {	session_register ($fsel_str); }
		if (! session_is_registered($vsel_str)) {	session_register ($vsel_str); }
		if (! session_is_registered($dsel_str)) {	session_register ($dsel_str); }
		if (! session_is_registered($ppag_str)) {	session_register ($ppag_str); }
		if (! session_is_registered($diso_str)) {	session_register ($diso_str); }

		//global $_SESSION,$_GET, $_POST;

		$this->sql = $sql;
		$this->id = $id;
		$this->db = $db;
		$this->label_arr = $label_arr;
		$this->optional_arr = $optional_arr;
		$this->var_arr = $var_arr;
		$this->eval_arr = $eval_arr;
		$this->sum_arr = $sum_arr;
		$this->hideS_arr = $hideS_arr;

		$this->excel_save =  
			$_POST[$xls_str] ? $_POST[$xls_str] :
			( $_GET[$xls_str] ? $_GET[$xls_str] : FALSE );
		$this->csv_save =  
			$_POST[$csv_str] ? $_POST[$csv_str] :
			( $_GET[$csv_str] ? $_GET[$csv_str] : FALSE );
		$this->pdf_save =  
			$_POST[$pdf_str] ? $_POST[$pdf_str] :
			( $_GET[$pdf_str] ? $_GET[$pdf_str] : FALSE );
			

		if ($this->excel_save || $this->csv_save || $this->pdf_save) {
			$this->label_arr['add_anchor'] = FALSE;
			$this->label_arr['edit_anchor'] = FALSE;
			$this->label_arr['del_anchor'] = FALSE;
			$this->label_arr['print_anchor'] = FALSE;
			
			$this->header_view = FALSE;
			$this->search_view = FALSE;
			$this->date_search_view = FALSE;
			$this->order_view = FALSE;
			$this->export_view = FALSE;
		}

		$_SESSION[$key_str] = 
			isset($_POST[$key_str]) ? $_POST[$key_str] : 
			( isset($_GET[$key_str]) ? $_GET[$key_str] : 
			( isset($_SESSION[$key_str]) ? $_SESSION[$key_str] : '' ) );

		$_SESSION[$fdat_str] = 
			$_POST[$fdat_str] ? $_POST[$fdat_str] :
			( $_GET[$fdat_str] ? $_GET[$fdat_str] :
			( $_SESSION[$fdat_str] ? $_SESSION[$fdat_str] : '' ) );

		$_SESSION[$tdat_str] = 
			$_POST[$tdat_str] ? $_POST[$tdat_str] :
			( $_GET[$tdat_str] ? $_GET[$tdat_str] : 
			( $_SESSION[$tdat_str] ? $_SESSION[$tdat_str] : '' ) );

		$force_clean = $_GET['force_clean'] ? $_GET['force_clean'] : 0;
		$force_reset = $_GET['force_reset'] ? $_GET['force_reset'] : 0;

		if ($force_reset) {
			$_SESSION[$key_str] = '';
			$_SESSION[$fdat_str] = '';
			$_SESSION[$tdat_str] = '';			
		} else if ($force_clean || $_SESSION[$key_str]=='listall') {
			$_SESSION[$curr_page] = '';
			$_SESSION[$orderby] = '';
			$_SESSION[$orderby_type] = '';
			$_SESSION[$key_str] = '';
			$_SESSION[$fdat_str] = '';
			$_SESSION[$tdat_str] = '';
			$_SESSION[$fsel_str] = '';
			$_SESSION[$vsel_str] = '';
			$_SESSION[$dsel_str] = '';
			$_SESSION[$ppag_str] = '';
			$_SESSION[$diso_str] = 1;
		}

		$this->keyword = $_SESSION[$key_str];
		if ($GLOBALS[$GLOBALS['get_vars']][$id.'_template']) {
			$this->label_arr['add_anchor'] = FALSE;
			$this->label_arr['edit_anchor'] = FALSE;
			$this->label_arr['del_anchor'] = FALSE;
			$this->label_arr['print_anchor'] = FALSE;
			
			$this->header_view = FALSE;
			$this->search_view = FALSE;
			$this->date_search_view = FALSE;
			$this->order_view = FALSE;
			$this->export_view = FALSE;
			$this->csv_save = TRUE;
			$this->keyword = '12398cz809d8f09d834';
		}
		
		// current page
		$_SESSION[$curr_page] = 
			$_POST[$next_page] ? 
			$_POST[$next_page] :
			( 
				$_GET[$next_page] ? 
				$_GET[$next_page] :
				( 
					$_SESSION[$curr_page]?
					$_SESSION[$curr_page]:
					1
				) 
			);
			
		// order by
		$_SESSION[$orderby] = 
			$_GET[$orderby] ?
			$_GET[$orderby] : 
			( 
				$_SESSION[$orderby] ? 
				$_SESSION[$orderby] : 
				''
			);

		// order by type
		$_SESSION[$orderby_type] = 
			$_GET[$orderby_type] ? 
			$_GET[$orderby_type] :
			( 
				$_SESSION[$orderby_type] ? 
				$_SESSION[$orderby_type] :
				'ASC' 
			);
		$_SESSION[$orderby_type] = strtolower($_SESSION[$orderby_type]);

		//$_SESSION[$sql_str] = $sql;
		
		$_SESSION[$fsel_str] = 
			$_POST[$fsel_str] ? 
			$_POST[$fsel_str] :
			(
				$_GET[$fsel_str] ? 
				$_GET[$fsel_str] : 
				( 
					$_SESSION[$fsel_str]?
					$_SESSION[$fsel_str]:
					array()
				)
			);
			
		$_SESSION[$dsel_str] = 
			($_POST[$dsel_str]!="") ? 
			$_POST[$dsel_str] : 
			( 
				$_GET[$dsel_str] ? 
				$_GET[$dsel_str] :
				( 
					$_SESSION[$dsel_str]? 
					$_SESSION[$dsel_str]:
					array() 
				)
			);
			
		$_SESSION[$diso_str] = 
			isset($_GET[$diso_str]) ?
			$_GET[$diso_str] : 
			( 
				isset($_SESSION[$diso_str]) ?
				$_SESSION[$diso_str] :
				1 
			);

		$this->disorder = $_SESSION[$diso_str];
		$this->curr_page = $_SESSION[$curr_page];

		if ($_POST[$addv_str]) {
			$max_vsel = 0;
			foreach ($_SESSION[$vsel_str] as $key => $value) {
				if ($value > $max_vsel) {
					$max_vsel = $value;
				}
			}
			for ($i=0;$i<count($_POST[$asel_str]);$i++) {
				$_SESSION[$vsel_str][$_POST[$asel_str][$i]] = ++$max_vsel;
			}
		} else if ($_POST[$delv_str]) {
//		print_r($_SESSION[$vsel_str]);
			for ($i=0;$i<count($_POST[$rsel_str]);$i++) {
				$_SESSION[$vsel_str][$_POST[$rsel_str][$i]] = 0;
			}
		} else {
			$_SESSION[$vsel_str] = $_SESSION[$vsel_str] ? $_SESSION[$vsel_str] : $vsel_arr;
		}

		if ($_GET[$left_str] && ! $this->disorder) {
			$prev_key = '';
			foreach ($_SESSION[$vsel_str] as $key => $value) {
				if ($key == $_GET[$left_str]) {
					$_SESSION[$vsel_str][$key]--;
					$_SESSION[$vsel_str][$prev_key]++;
				}
				$prev_key = $key;
			}
		} else if ($_GET[$righ_str] && ! $this->disorder) {
			$prev_key = '';
			foreach ($_SESSION[$vsel_str] as $key => $value) {
				if ($prev_key == $_GET[$righ_str]) {
					$_SESSION[$vsel_str][$key]--;
					$_SESSION[$vsel_str][$prev_key]++;
				}
				$prev_key = $key;
			}
		}
		/*if ($_SESSION[$key_str]=='listall') {
			$_SESSION[$key_str] = '';
			$_SESSION[$fsel_str] = '';
		}*/

		#$orderby_sql = $_SESSION[$orderby] ? ' ORDER BY ' . $_SESSION[$orderby] . ' ' .
		#	$_SESSION[$orderby_type] : '';
		#$this->orderby_sql = $orderby_sql;

	}

	// generate button on browser
	function pager_button($arr) {
		$link = $arr['link'];
		$title = $arr['title'];
		$image = $arr['image'];
		$label = $arr['label'];
		$type = $arr['type'];
		$var = $arr['var'];
		$form = $arr['form'];
		$position = $arr['position'];

		if (! $link) {
			$href = "disabled";
		} else {
			$href = "onClick=\"$link\"";
		}

		if ($var) {
			$name=$var;
		} else {
			$GLOBALS['count_pager_button']++;
			$name="button".$GLOBALS['count_pager_button'];
		}

		if ($position) {
			$align = $position;
		} else {
			$align = 'top';
		}

		$type_arr = explode("+", $type);
		foreach ($type_arr as $k => $v) {
		if ($image==''&&$v=='link') $v='button';
		switch ($v) {
			case 'image':
				$str .= "<input type=\"image\" align=$align class=button src=\"$image\" $href name=\"$name\" title=\"$title\" />";
				break;
			case 'submit':
				if (! $link) $href = FALSE;
				$str .= "<input type=\"submit\" class=button $href name=\"$name\" value=\"$label\" title=\"$title\" />";
				break;
			case 'link':
				if ($image) {
					$str .= "<a href=# $href title=\"$title\"><img src=\"$image\" border=0 align=$align></a>";
				} else {
					$str .= "[<a href=# $href title=\"$title\">$label</a>]";
				}
				break;
			case 'button':
			default:
				$str .= "<input type=\"button\" class=button $href name=\"$name\" value=\"$label\" title=\"$title\" />";
				break;
		}
		}
		//return '<nobr>'.$str.'</nobr>';
		return $str;
	}

	// render navigation button
	function rnb($nav, $an) {
		$bt = array();
		$bt["type"] = "link";
		$bt["image"] = $GLOBALS['path_theme'];
		$curr =  $this->rs->AbsolutePage();
		$last = $this->rs->LastPageNo();
		switch ($nav) {
			case 'first':
				$next_page = 1;
				$bt["title"] = __("First Page");
				$bt["label"] = __("|<");
				if (isset($GLOBALS[path_theme])) {
					if ($an) $bt["image"] .= '/images/first.gif';
					else $bt["image"] .= '/images/firstoff.gif';
				}
				break;
			case 'prev':
				$next_page = $curr-1;
				$bt["title"] = __("Previous Page");
				$bt["label"] = __("<<");
				if (isset($GLOBALS[path_theme])) {
					if ($an) $bt["image"] .= '/images/prev.gif';
					else $bt["image"] .= '/images/prevoff.gif';
				}
				break;
			case 'next':
				$next_page = $curr+1;
				$bt["title"] = __("Next Page");
				$bt["label"] = __(">>");
				if (isset($GLOBALS[path_theme])) {
					if ($an) $bt["image"] .= '/images/next.gif';
					else $bt["image"] .= '/images/nextoff.gif';
				}
				break;
			case 'last':
				$next_page = $last;
				$bt["title"] = __("Last Page");
				$bt["label"] = __(">|");
				if (isset($GLOBALS[path_theme])) {
					if ($an) $bt["image"] .= '/images/last.gif';
					else $bt["image"] .= '/images/lastoff.gif';
				}
				break;
		}
		if ($an)
			$bt['link'] = 'window.location=\''.
				$GLOBALS['PHP_SELF'].'?'.
				$this->id.'_next_page='.$next_page.'&'.
				$this->label_arr['extra_param'].'\'';

		return $this->pager_button($bt);
	}
	
	// render first button
	function render_first($anchor=true) {
		return $this->rnb('first', $anchor);
	}
	
	// render previous button
	function render_prev($anchor=true) {
		return $this->rnb('prev', $anchor);
	}

	// render next button
	function render_next($anchor=true) {
		return $this->rnb('next', $anchor);
	}

	// render last button
	function render_last($anchor=true) {
		return $this->rnb('last', $anchor);
	}

	// render grid
	function render_grid()
	{
		global $PHP_SELF;
		$vsel_str = $this->id.'_vselect';

                // initialize
		$prs = $this->rs;
		$label_arr = $this->label_arr; // load label
		$optional_arr = $this->optional_arr; // load rule
		$eval_arr = $this->eval_arr; // load eval_arr
		$sum_arr = $this->sum_arr; // ???
		$hideS_arr = $this->hideS_arr;

		$str = 'No'.'|';
		$num_col = $prs->FieldCount(); // number of column
		$num_col++; // for field no.
		$label_arr['edit_anchor'] ? $num_col++ : '';
		$label_arr['del_anchor'] ? $num_col++ : '';

		$max_vsel = 0;
		for ($i=0;$i<count($this->field_arr);$i++) {
			$key = $this->field_arr[$i];
			if ($optional_arr[$key] == 1)
				continue;
			if (! isset($_SESSION[$vsel_str][$key])) {
				$_SESSION[$vsel_str][$key] = ++$max_vsel;
			}
		}

		$max_vsel = 0;
		if (! $this->disorder) {
			if (is_array($_SESSION[$vsel_str])	) {
				asort($_SESSION[$vsel_str]);
				foreach ($_SESSION[$vsel_str] as $key => $value) {
					if ($value > $max_vsel) {
						$_SESSION[$vsel_str][$key] = ++$max_vsel;
					}
				}
			}
			$i=0;
			foreach ($_SESSION[$vsel_str] as $key => $value) {
				$field_arr[$i++] = $key;
			}
		} else {
			$field_arr = $this->field_arr;
			for ($i=0;$i<count($this->field_arr);$i++) {
				$key = $this->field_arr[$i];
				if ($optional_arr[$key] == 1)
					continue;
				if ($_SESSION[$vsel_str][$key]) {
					$_SESSION[$vsel_str][$key] = ++$max_vsel;
				}
			}
		}
		$skey = 0;
		$sr = '&nbsp;|';
		//print_r($field_arr);
		//print_r($max_vsel);
		for ($i=0;$i<count($field_arr);$i++) {
			$pkey_str = '';
			$nkey_str = '';
			$key = $field_arr[$i];
			$fldname = $label_arr[$key] ? $label_arr[$key] : $key;
			if ($optional_arr[$key] == 1)
				continue;
			//if (! isset($_SESSION[$this->id.'_vselect'][$key])) {
			//	$_SESSION[$this->id.'_vselect'][$key] = ++$max_vsel;
			//}
			if (! $_SESSION[$vsel_str][$key])
				continue;
			$skey++;
			$ordimg = "";
			if ($_SESSION[$this->id.'_orderby']==$key) {
				if (isset($GLOBALS['path_theme'])) {
					$ordimg = '<img src='.$GLOBALS['path_theme'].'/images/'.$_SESSION[$this->id.'_orderby_type'].'.gif>';
				} else {
					if (strtolower($_SESSION[$this->id.'_orderby_type'])=='asc') $ordimg = "<input disabled type=button value='/\\'>";
					else $ordimg = "<input disabled type=button value='\\/'>";
				}
			}
			$ordtype = ($_SESSION[$this->id.'_orderby']==$key) ? ((strtolower($_SESSION[$this->id.'_orderby_type'])=='asc') ? 'desc' : 'asc') : 'asc';

			/*
			if (! $this->disorder && $skey>1) { $pkey_str = '<a href='.$PHP_SELF.'?'.$this->id.'_left='.$key."&{$this->label_arr['extra_param']} title=\"Move View to Left\">".'<img src='.$GLOBALS['path_theme'].'/images/left.gif border=0>'."</a>"; }
			if (! $this->disorder && $skey<$max_vsel) { $nkey_str = '<a href='.$PHP_SELF.'?'.$this->id.'_right='.$key."&{$this->label_arr['extra_param']} title=\"Move View to Right\">".'<img src='.$GLOBALS['path_theme'].'/images/right.gif border=0>'."</a>"; }
			*/
			
			$sort_by_label = __('Sort by');
		
			if ($this->order_view) {
				$cstr_pre =
					'<a href='.
					$PHP_SELF.'?'.
					$this->id.'_orderby='.
					$key.'&'.
					$this->id.'_orderby_type='.
					$ordtype.'&'.
					$this->label_arr['extra_param'].
					' title="'.
					$sort_by_label.' '.
					$fldname.'">';

				$cstr_suf = '</a>';
			}
			
			$cstr = 
				''.
				$pkey_str.' '.
				$cstr_pre.
				$fldname.
				$cstr_suf.' '.
				$ordimg.' '.
				$nkey_str.
				'';
				
			/*
			if (ereg('^purchase_[A-Za-z_]+$', $field_arr[$i]) || ereg('^sale_[A-Za-z_]+$', $field_arr[$i])) {
				$sr .= $cstr."|";
				if ($field_arr[$i]=='purchase_unit_price') {
					$str .= '<b>Pembelian</b>|';
				} else if ($field_arr[$i]=='sale_unit_price') {
					$str .= '<b>Penjualan</b>|';
				} else {
					$str .= '+';
				}
				$load_sr = TRUE;
			} else if (ereg('^[A-Za-z]+_total_price$', $field_arr[$i]) || ereg('^[A-Za-z]+_net_price$', $field_arr[$i])) {
				$sr .= $cstr."|";
				if ($field_arr[$i]=='card_total_price') {
					$str .= '<b>Total</b>|';
				} else if ($field_arr[$i]=='card_net_price') {
					$str .= '<b>Nilai Net</b>|';
				} else {
					$str .= '+';
				}
				$load_sr = TRUE;
			} else {
				if ($field_arr[$i]=='debit') {
					$sr .= '<div align=right>&nbsp;'.$GLOBALS['first_balance'].'&nbsp;</div>|';
				} else if ($field_arr[$i]=='credit') {
					$sr .= '<div align=right>&nbsp;0&nbsp;</div>|';
				} else {
			*/
					$sr .= '&nbsp;|';
			//	}
				$str .= $cstr;
				$str .= '|';
			//}
		}

		$form_del_anchor = ereg_replace('.*openIT\(\'([^\']+)\'.*', "\\1", $label_arr['del_anchor']);
		$form_del_anchor_before = ereg_replace('%s', '', $form_del_anchor);
		$del_func_js = '
<script language=javascript>
function ToggleAll(e,f){ if(e.checked){ CheckAll(f);}else{ ClearAll(f);}}
function CheckAll(f){ var ml=f;var len=ml.elements.length;for(var i=0;i<len;i++){ var e=ml.elements[i];if(e.name=="pk_str[]"){ Check(e);}}ml.toggleAll.checked=true;}
function ClearAll(f){ var ml=f;var len=ml.elements.length;for(var i=0;i<len;i++){ var e=ml.elements[i];if(e.name=="pk_str[]"){ Clear(e);}}ml.toggleAll.checked=false;}
function Check(e){ e.checked=true;Highlight(e);}
function Clear(e){ e.checked=false;Unhighlight(e);}
function Toggle(e,f){ if(e.checked){ Highlight(e);f.toggleAll.checked=AllChecked(f);}else{ Unhighlight(e);f.toggleAll.checked=false;}}
function AllChecked(f){ ml=f;len=ml.elements.length;for(var i=0;i<len;i++){ if(ml.elements[i].name=="pk_str[]"&&!ml.elements[i].checked){ return false;}}return true;}
function Highlight(e){ var r=null;if(e.parentNode&&e.parentNode.parentNode){ r=e.parentNode.parentNode;}else if(e.parentElement&&e.parentElement.parentElement){ r=e.parentElement.parentElement;}if(r){ r.className="title_table";}}
function Unhighlight(e){ var r=null;if(e.parentNode&&e.parentNode.parentNode){ r=e.parentNode.parentNode;}else if(e.parentElement&&e.parentElement.parentElement){ r=e.parentElement.parentElement;}if(r){ r.className="in_table";}}
</script>';

		$GLOBALS['count_delform']++;
		$delform_name = 'deleteform'.$GLOBALS['count_delform'];
		$form_del_anchor = '';
		if ($GLOBALS['count_delform']==1) $form_del_anchor = $del_func_js;
		$del_func2_js = '
<script language=javascript>
function DelSelected'.$delform_name.'(f){ var ml=f;var len=ml.elements.length;var url="";for(var i=0;i<len;i++){ var e=ml.elements[i];if(e.name=="pk_str[]" && e.checked){ url+="&pk_str[]="+escape(e.value);}}if(url!=""){ /*openIT("'.$form_del_anchor_before.'"+url,600,400,null,null,"del_selected");*/win=openIT("",600,400,null,null,"del_selected");html="<html><head><title>'.__('Status Selected Delete').'</title></head><body><form name=delform action='.$form_del_anchor_before.' method=post>";for (var i=0;i<len;i++){ var e=ml.elements[i];if(e.name=="pk_str[]"&&e.checked){ html+="<input type=hidden name=pk_str[] value=\""+e.value+"\">";}}html+="</form></body></html>";win.document.write(html);win.document.close();win.document.delform.submit();}else{ alert("At least need 1 element for deletion !!!");}}
</script>';
		$form_del_anchor .= $del_func2_js;
		$image_str = (isset($GLOBALS[path_theme]))?$GLOBALS[path_theme].'/images/delete.gif':'';
		$delete_button = pager::pager_button(array(
		"title"=>__("Selected Delete"),
		"label"=>__("Delete"),
		"link"=>'javascript:confirm(\''.__('Confirm').' '.__('Delete').
		'?\')?DelSelected'.$delform_name.'(document.'.
		$delform_name.'):alert(\''.__('Cancel').' '.__('Delete').'\');"',
		"image"=>$image_str,
		"type"=>"button"));
		$form_del_anchor .= <<< EOT
<table cellspacing=0 cellpadding=0 width=100% border=0 align=left>
<tr>
<form action="{$form_del_anchor_before}" method=post name={$delform_name} target={$delform_name}>
<td nowrap>
<input type=checkbox name=toggleAll onclick="ToggleAll(this,document.{$delform_name});">{$delete_button}
</td>
</tr>
</table>
EOT;
		$str = substr($str, 0, -1);
		$str .= $label_arr['edit_anchor'] ? '|'.$label_arr['edit_val'] : '';
		$str .= $label_arr['del_anchor'] ? '|'.$form_del_anchor.'</div>' : '';
		$sr .= $label_arr['edit_anchor'] ? '<div align=right>&nbsp;'.$GLOBALS['first_balance'].'&nbsp;</div>|' : '';
		$sr .= $label_arr['del_anchor'] ? '|' : '';
		$tit_str[] = $str;
		$sr_str[] = $sr;

		$date_format = $GLOBALS['date_format'] ? $GLOBALS['date_format'] : 'Y-m-d';

		$i=0;
		while (! $prs->EOF) {

			$str = '';
			$pk_str = '';
			$str = $i+1+(($this->curr_page-1)*$this->rows).'|';
			//for ($j=0;$j<$prs->FieldCount();$j++) {
			//foreach ($_SESSION[$this->id.'_vselect'] as $key => $value) {
			for ($j=0;$j<count($field_arr);$j++) {
			//}
				//$fld = $prs->FetchField($j);
				$key = $field_arr[$j];
				/*if ($optional_arr[$key])
					continue;
				if (! $value)
					continue;*/

				if ($label_arr['pk'][$key]) {
					$pk_str .= $key.'='.urlencode($prs->fields[$key]).'&';
				}
				if ($optional_arr[$key] == 1) {
					//$prs->MoveNext();
					//$i++;
					continue;
				}
				if (! $_SESSION[$vsel_str][$key]) {
					//$prs->MoveNext();
					//$i++;
					continue;
				}

				if ($sum_arr[$key]) {
					$my_sum[$key] += $prs->fields[$key];
				}

				$date_check = eregi('(^date$)|(^date_)|(_date$)|(^lda$)|(^tgl_)|(_tgl$)|(tanggal)', $key);

				if (strstr('IN', $this->type_arr[$key]) && ! $date_check) // integer or numeric
					$str .= '<div align=right>';
				//if ($prs->fields[$key]!="") {
					if ($eval_arr[$key]) {
						$str .= ' ';
						eval(preg_replace('/\%s/', addslashes($prs->fields[$key]), $eval_arr[$key]));
						$str .= '';
					} else if ($prs->fields[$key] && $date_check) {
						if (ereg('[0-9]{4}-[0-9]{2}-[0-9]{2}', $prs->fields[$key])) {
							$str .= "<nobr>".$this->parsedate2($prs->fields[$key])."</nobr>";
						} else {
							$str .= '<nobr>'.htmlentities(date($date_format,$prs->fields[$key])).'</nobr>';
						}
					} else {
						$tmp = nl2br(htmlentities($prs->fields[$key]));
						$tmp = str_replace('|', '&#124;', $tmp);
						if ($tmp=='') $tmp = '&nbsp;';
						$str .= ' '.$tmp.'';
					}
				//} else {
				//	$str .= '&nbsp;';
				//}
				if (strstr('IN', $this->type_arr[$key]) && ! $date_check)
					$str .= '</div>';
				$str .= '|';
			}
			$str = substr($str, 0, -1);
			$pk_str = substr($pk_str, 0, -1);

			$str .= $label_arr['edit_anchor'] ? '|'.ereg_replace("%s", '&' . $pk_str, $label_arr['edit_anchor']) : '';
			if ($eval_arr['edit_anchor']) {
				eval(preg_replace('/\%s/', $pk_str, $eval_arr['edit_anchor']));
			}

			//$str .= $label_arr['del_anchor'] ? '|'.sprintf($label_arr['del_anchor'], '&' . $pk_str) : '';
			$str .= $label_arr['del_anchor'] ? '|<input type=checkbox name=pk_str[] onClick="Toggle(this,document.'.$delform_name.')" value="'.$pk_str.'">' : '';
			//if (($i+1)==count($rows) && $label_arr['del_anchor']) $str .= '</form>';

			if ($eval_arr['del_anchor']) {
				eval(preg_replace('/\%s/', $pk_str, $eval_arr['del_anchor']));
			}
			$arr_str[] = $str;

			/*
			if ($this->odd_color&&$this->even_color&&$this->col_color&&isset($prs->fields[$this->col_color])){
				$CF = $prs->fields[$this->col_color];
				if ($CF!=$PF) {
					$PF = $CF;
					$FF++;
				}
				if ($FF&1) $arr_color[] = $this->even_color;
				else $arr_color[] = $this->odd_color;
			}
			*/

			$i++;
			$prs->MoveNext();
		}
		$count_rows = $i;

		$str = '&nbsp;|';
		for ($j=0;$j<count($field_arr);$j++) {
			$key = $field_arr[$j];
			if ($optional_arr[$key] == 1)
				continue;
			if (! $_SESSION[$vsel_str][$key])
				continue;
			if (!strcmp($sum_arr[$key],"average")) {
				$my_sum[$key] = $my_sum[$key]/$count_rows;
			} else if (ereg('^\$', $sum_arr[$key])) {
				eval($sum_arr[$key]);
			}

			if ($sum_arr[$key]) {
				if (! $sum_loaded) $sum_loaded = TRUE;
				if ($eval_arr[$key]) {
					$str .= ' ';
					eval(preg_replace('/\%s/', $my_sum[$key], $eval_arr[$key]));
					$str .= '|';
				} else {
					$str .= ' '.nl2br(htmlentities($my_sum[$key])).'|';
				}
			} else {
				$str .= '&nbsp;|';
			}
		}
		$str = substr($str, 0, -1);
		$str .= $label_arr['edit_anchor'] ? '|&nbsp;' : '';
		$str .= $label_arr['del_anchor'] ? '|&nbsp;' : '';
		if ($sum_loaded&&$count_rows)	$arr_str[] = $str;
		unset($str);

		unset($rows);
		//($err_msg) ? $_block->set_info($err_msg) : '';
		if ($this->excel_save) {
			$this->view_excel(&$arr_str, &$tit_str);
		} else if ($this->csv_save) {
			$this->view_csv(&$arr_str, &$tit_str);
		} else if ($this->pdf_save) {
			$this->view_pdf(&$arr_str, &$tit_str, &$label_arr, &$this->pdf_arr);
		} else {
//		global $page_time_start;
//		echo (getmicrotime()-$page_time_start);exit;
//print_r($tit_str);exit;
//print_r($this->render_nav_search());exit;
			return $this->view_html(&$arr_str, &$tit_str, &$label_arr);
		}
	}

	function view_html($arr_str, $tit_str, $label_arr, $html_arr='') {
		$arr_str2 = array(&$arr_str);
		$tit_str2 = array(&$tit_str);
		$label_arr2 = array(&$label_arr);
		$html_arr[align] = array($html_arr[align]);
		$html_arr[width] = array($html_arr[width]);

		return pager::view_html2(&$arr_str2, &$tit_str2, &$label_arr2, $html_arr);
			/*
			$_outside_block = new block();
			$_block = new block();
			$label_arr['form_title'] = str_replace('List ', '', $label_arr['form_title']);
			$label_arr['form_title'] = str_replace('Daftar ', '', $label_arr['form_title']);
			$label_arr['form_title'] ? $_outside_block->set_config('title', '<div align=left><font size="+1">'.$label_arr['form_title'].'</font></div>') : '';
			$label_arr['form_width'] ? $_outside_block->set_config('width', $label_arr['form_width']) : '';
			$_block->set_config('num_col', $num_col);
			$_block->set_config('width', '100%');
			$_block->set_config('cell_extra', ' valign=top ');
			$_block->set_title(&$tit_str);



			$_block->set_config('odd_color', $this->odd_color);
			$_block->set_config('even_color', $this->even_color);
			$_block->set_config('arr_color', $arr_color);

			if ($load_sr) {
				$_block->set_title(&$sr_str, TRUE);
			}
			$_block->parse(&$arr_str);
			$_out[] = $this->header_view ? '*'.$this->render_nav_search() : '';
			$_out[] = $_block->get_str();
			$_outside_block->parse(&$_out);
			if ($label_arr['del_anchor']) $extra_block = "</form>";
			
			//$this->save_session_vars();
			
			return $_outside_block->get_str().$extra_block;
			*/
	}
	//	}
	//}

	function view_html2($arr_str2, $tit_str2, $label_arr2, $html_arr='', $use_ob=TRUE) {
		if ($use_ob) ob_start();
		foreach ($arr_str2 as $k=>$v) {
		$l = $html_arr[align][$k];
		$w = $html_arr[width][$k];
			echo "<table width={$label_arr2[$k][form_width]} border=0 ";
			echo "cellpadding=0 cellspacing=0 ";
			echo "class=out_border>\n";
			echo "<tr><td>\n";
			echo "<table width=100% border=0 ";
			echo "cellpadding=0 cellspacing=0 class=in_table>\n";
			echo "<tr class=title_table><td><font size=+1>{$label_arr2[$k][form_title]}</font></td></tr>\n";
			echo "<tr><td>\n";
			if ($this->header_view) echo $this->render_nav_search()."\n";
			echo "<table width=100% border=0 ";
			echo "cellpadding=0 cellspacing=0 ";
			echo "class=out_border>\n";
			echo "<tr><td>\n";
			echo "<table width=100% border=0 cellpadding=1 ";
			echo "cellspacing=0 class=in_table>\n";
			foreach ($tit_str2[$k] as $row) {
				if (is_array($row)) $data =& $row;
				else $data = explode('|', $row);
				echo "<tr valign=to class=title_table>";
				$a = 0;
				foreach ($data as $col) {
					if ($col=='') $col = '&nbsp;';
					echo "<th style='border-width:1px;border-style:solid;border-color:#000000'";
					if ($w[$a]) echo "width=".round($w[$a]*4.5);
					echo ">{$col}</th>\n";
					$a++;
				}
				echo "</tr>\n";
			}
			$b = 0;
			global $color_arr;
			if (! is_array($arr_str2[$k])) $arr_str2[$k] = array();
			foreach ($arr_str2[$k] as $row) {
				if (is_array($row)) $data =& $row;
				else $data = explode('|', $row);
				echo "<tr valign=top ";
				if ($color_arr[$b])
					echo "bgcolor=$color_arr[$b]";
				echo ">";
				$a = 0;
				foreach ($data as $col) {
					if ($col=='') $col = '&nbsp;';
					echo "<td style='border-width:1px;border-style:solid;border-color:#000000'";
					if ($l[$a]=='R') echo "align=right";
					echo ">{$col}</td>\n";
					$a++;
				}
				echo "</tr>";
				$b++;
			}
			echo "</table>\n";
			echo "</td></tr>\n";
			echo "</table>\n";
			echo "</td></tr>\n";
			echo "</table>\n";
			echo "</td></tr>\n";
			echo "</table>\n";
			if ($label_arr2[$k]['del_anchor']) echo "</form>\n";
			echo '<br>';
		}
		if ($use_ob) {
			$str = ob_get_contents();
			ob_end_clean();
			return $str;
		}
		#exit;
	}

	function view_pdf($arr_str, $tit_str, $label_arr, $pdf_arr='', $f='output.pdf') {

		$arr_str2 = array(&$arr_str);
		$tit_str2 = array(&$tit_str);
		$label_arr2 = array(&$label_arr);
		$pdf_arr[align] = array($pdf_arr[align]);
		$pdf_arr[width] = array($pdf_arr[width]);
	
		return pager::view_pdf2(&$arr_str2, &$tit_str2, &$label_arr2, $pdf_arr, $f);
	}

	function view_pdf2($arr_str2, $tit_str2, $label_arr2, $pdf_arr=''
	, $f='output.pdf') {

		$w = $pdf_arr['width'];
		$l = $pdf_arr['align'];
		$o = $pdf_arr['orientation'] ? $pdf_arr['orientation'] : 'P';

		global $page_time_start;

		$pdf=new PDF($o);
		$pdf->Open();
		$pdf->SetFont('Arial','',8);
		foreach ($arr_str2 as $k=>$v) {
			$title = $label_arr2[$k][form_title];
			$arr['header'] =& $tit_str2[$k];
			$arr[data] =& $arr_str2[$k];
			$arr[width] =& $w[$k];
			$arr[align] =& $l[$k];

			$pdf->AddPage();
			$pdf->ChapterTitle($title);
			$pdf->FancyTable($arr);
		}
		#$pdf->ChapterFooter('page created in: '.
		#''.(getmicrotime()-$page_time_start));
		$pdf->Output();
		exit;
	}

	// convert &nbsp; to (space)
	function unhtmlentities ($string)
	{
		$trans_tbl = get_html_translation_table (HTML_ENTITIES);
		$trans_tbl = array_flip ($trans_tbl);
		return trim(strtr ($string, $trans_tbl), "?");
	}

        // export result to excel format
	function view_excel($arr_str, $tit_str, $filename='output.xls') {
		// set include_path
		global $include_separator;
		$include_path = ini_get('include_path');
		$include_path = ereg_replace(':', $include_separator,
			$include_path.':PEAR');
		ini_set('include_path', $include_path);
//error_reporting(E_ALL);
  		require_once 'Spreadsheet/Excel/Writer.php';

		// Creating a workbook
		$workbook = new Spreadsheet_Excel_Writer();

		// Creating the first worksheet
		$worksheet1 =& $workbook->addWorksheet();

		$formatot =& $workbook->addFormat();
		//$formatot->setTextWrap(1);
		$formatot->setSize(10);
		$formatot2 =& $workbook->addFormat();
		$formatot2->setBold();

		$i=0;
		foreach ($tit_str as $row) {
			$worksheet1->setRow($i,12);
			if (is_array($row)) $data =& $row;
			else $data = explode('|', $row);
			$j=0;
			foreach ($data as $col) {
				$col = pager::unhtmlentities(strip_tags($col));
				$worksheet1->write($i,$j,$col,$formatot2);
				$j++;
			}
			$i++;
		}
		foreach ($arr_str as $row) {
			$worksheet1->setRow($i,12);
			if (is_array($row)) $data =& $row;
			else $data = explode('|', $row);
			$j=0;
			foreach ($data as $col) {
				$col = pager::unhtmlentities(strip_tags($col));
				$worksheet1->write($i,$j,$col,$formatot);
				$j++;
			}
			$i++;
		}

		/*
		$formatot3 =& $workbook->addFormat();;
		$formatot3->setTextWrap(1);
		$formatot3->setSize(10);
		$formatot3->setAlign('merge');
		$max_width = array();
		for ($i=0;$i<count($tit_str);$i++) {
			$worksheet1->setRow($i,12);
			$tit_pie = explode("|", $tit_str[$i]);
			for ($j=0;$j<count($tit_pie);$j++) {
				$cell = pager::unhtmlentities(strip_tags(trim($tit_pie[$j])));
				$worksheet1->write($i,$j,$cell,$formatot2);
				if (strlen($cell)>$max_width[$j]) $max_width[$j] = strlen($cell)*1.2;
			}
		}

		$start_row = count($tit_str);
		for ($i=0;$i<count($arr_str);$i++) {
			$worksheet1->setRow($i+$start_row,12);
			$arr_pie = explode("|", $arr_str[$i]);
			for ($j=0;$j<count($arr_pie);$j++) {
				$count_plus = 0;
				if (ereg('^\++', $arr_pie[$j], $ereg)) {
					$count_plus = strlen(ereg_replace('[^\+]', '', $ereg[0]));
				}
				$arr_pie[$j] = ereg_replace('^\*?\+*', '', $arr_pie[$j]);

				$cell = pager::unhtmlentities(strip_tags(trim($arr_pie[$j])));
				if ($cell == number_format(ereg_replace('[^0-9.]', '', $cell),2)) {
					$cell = ereg_replace('[^0-9.]', '', $cell);
				}
				
				if ($count_plus > 0) {
					$worksheet1->write($i+$start_row,$j,$cell,$formatot3);
					for ($k=0;$k<$count_plus;$k++) {
						$worksheet1->write($i+$start_row,$j+$k+1,"",$formatot3);
					}
					$worksheet1->write($i+$start_row,$j,$cell,$formatot);
				} else {
					$worksheet1->write($i+$start_row,$j,$cell,$formatot);
				}
				if (strlen($cell)>$max_width[$j]) $max_width[$j] = strlen($cell)*1.2;
			}
		}
		for ($i=0;$i<count($max_width);$i++) {
			$worksheet1->setColumn(0,$i,$max_width[$i]);
		}
		*/
		$workbook->send($filename);
		$workbook->close();
		exit;
	}

        // export result to csv format
	function view_csv($arr_str, $tit_str, $filename='output.csv') {
		$arr_str2 = array(&$arr_str);
		$tit_str2 = array(&$tit_str);
		$label_arr2 = array(&$label_arr);
		//$pdf_arr[align] = array($pdf_arr[align]);
		//$pdf_arr[width] = array($pdf_arr[width]);
	
		return pager::view_csv2(&$arr_str2, &$tit_str2, &$label_arr2, $filename);
	}

        // export result to csv format
	function view_csv2($arr_str2, $tit_str2, $label_arr2, $filename='output.csv') {
		header("Content-type: text/comma-separated-values");
		header("Content-Disposition: attachment; filename=$filename" );
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Pragma: public");

		foreach ($arr_str2 as $k=>$v) {
		$col = $label_arr2[$k][form_title]; 
		$col = pager::unhtmlentities(strip_tags($col));
		if ($col) echo "\"'".trim($col)."\"\n";

		if (is_array($tit_str2[$k])) {
		foreach ($tit_str2[$k] as $row) {
			if (is_array($row)) $data =& $row;
			else $data = explode('|', $row);
			foreach ($data as $col) {
				$col = pager::unhtmlentities(strip_tags($col));
				echo "\"'".trim($col)."\",";
			}
			echo "\n";
		}
		}
		
		if (is_array($arr_str2[$k])) {
		foreach ($arr_str2[$k] as $row) {
			if (is_array($row)) $data =& $row;
			else $data = explode('|', $row);
			foreach ($data as $col) {
				$col = pager::unhtmlentities(strip_tags($col));
				echo "\"'".trim($col)."\",";
			}
			echo "\n";
		}
		}
		#echo "\n";
		}
		global $page_time_start;
		#echo "[ Page created in: ".(getmicrotime()-$page_time_start)." (seconds). ]";
		exit;
	}

	// render navigation
	function render_nav() {

		// initialize
		global $PHP_SELF;

		// button: first and previous ($a)
		if ($this->curr_page > 1) {
			$a = $this->render_first().$this->render_prev();
		} else {
			$a = $this->render_first(false).$this->render_prev(false);
		}

		// button: next and last ($b)
		if ($this->curr_page < $this->rs->LastPageNo()) {
			$b = $this->render_next().$this->render_last();
		} else {
			$b = $this->render_next(false).$this->render_last(false);
		}

		//if (!$this->db->pageExecuteCountRows) {
		//	$f = '';
		//}

		// dropdown: jump page ($f)
		$total = $this->rs->LastPageNo(); // total page
		$f = '<select class="text" name="'.$this->id.'_next_page" onChange="this.form.submit()">';
		for ($i=1;$i<=$total;$i++) {
			$fs = ($i==$this->curr_page) ? ' selected' : '';
			$f .= '<option value="'.$i.'" '.$fs.'>'.$i.'</option>';
		}
		$f .= '</select>';

                // set extra paramater as hidden variable
		$xp = split('&', $this->label_arr['extra_param']);
		$xs = '';
		for ($i=0;$i<count($xp);$i++) {
			list($xn, $xl) = split('=', $xp[$i]);
			$xs .= '<input type="hidden" name="'.$xn.'" value="'.$xl.'"> ';
		}

                // button: add
		$add_str = $this->label_arr['add_anchor'] ? $this->label_arr['add_anchor'] : '';

		// button: print
		$prn_str = $this->label_arr['print_anchor'] ? $this->label_arr['print_anchor'] : '';

		// order ??? (removed)
		$dis_str = $this->disorder ? $this->order_str : $this->disorder_str;
		$dis_num = $this->disorder ? 0 : 1;
		//<a href={$PHP_SELF}?{$this->id}_disorder={$dis_num}&{$this->label_arr['extra_param']} title="DisOrder / Order View">{$dis_str}</a>

		/*********************** Date Search ***********************/
		// dropdown: field selector for search by date
		reset($_SESSION[$this->id.'_dselect']);
		$el = each($_SESSION[$this->id.'_dselect']);

		// ... start
		$d = '<select class=\'text\' name=\''.$this->id.'_dselect[]\'>';// multiple size=1>';
		for ($i=0;$i<count($this->field_arr);$i++) {

                        // ... selected field
			if ($el['value']==$this->field_arr[$i]) {
				$sl = ' selected';
				$el = each($_SESSION[$this->id.'_dselect']);
			} else {
				$sl = '';
			}

			// ... ignore field name doesn't contain 'date' keyword
			if ($this->optional_arr[$this->field_arr[$i]] == 1
			|| ! ereg('(^date_)|(_date$)|(^lda$)|(^tgl_)|(_tgl$)|(tanggal)', $this->field_arr[$i])) {
				continue;
			}

			// ... set variable name
			$field_var = $this->var_arr[$this->field_arr[$i]] ? $this->var_arr[$this->field_arr[$i]] : $this->field_arr[$i];

			// ... set label name
			$label_name = $this->label_arr[$this->field_arr[$i]] ? $this->label_arr[$this->field_arr[$i]] : $this->field_arr[$i];

                        // ... set option tag
			$d .= '<option value='.$field_var.$sl.'>'.$label_name.'</option>';
			if (! $dse) $dse = TRUE;

		}
                $d .= '</select>';
                $dat_str = $d;

		//reset($_SESSION[$this->id.'_dselect']);

		// check calendar js
		if ($GLOBALS['calendar_js']) {
			$GLOBALS['i_need_calendar_js'] = TRUE;
			for ($cc=0;$cc<strlen($GLOBALS['date_format']);$cc++) {
				switch($GLOBALS['date_format'][$cc]) {
					case 'Y': $mlt += 4; break;
					case 'y': $mlt += 2; break;
					case 'm': $mlt += 2; break;
					case 'd': $mlt += 2; break;
					case 'H': $mlt += 2; break;
					case 'i': $mlt += 2; break;
					case 's': $mlt += 2; break;
					default : $mlt += 1; break;
				}
			}
			if (! $mlt) $mlt = 10;

			// label: From
			$from_label = __('From');

			// label: To
			$to_label = __('To');

			// button: Search
			$image_str = (isset($GLOBALS[path_theme]))?$GLOBALS[path_theme].'/images/search.gif':'';
			$search_button = pager::pager_button(array(
				"title"		=> __("Search by Date"),
				"label"		=> __("Find"),
				"link"		=> "this.form.submit()",
				"image"		=> $image_str,
				"type"		=> "submit",
				"position"	=>"bottom"
			));

                        // text: from date
			$fday = '<input class="text" id="'.$this->id.'_fdate" name="'.$this->id.'_fdate" maxlength="'.$mlt.'" size="'.$mlt.'" value="';
			$fday .=
				$_SESSION[$this->id.'_fdate'] ?
				$_SESSION[$this->id.'_fdate'] :
				date($GLOBALS['date_format']);
			$fday .= '">';

			// text: to date
			$tday = '<input class="text" id="'.$this->id.'_tdate" name="'.$this->id.'_tdate" maxlength="'.$mlt.'" size="'.$mlt.'" value="';
			$tday .=
				$_SESSION[$this->id.'_tdate'] ?
				$_SESSION[$this->id.'_tdate'] :
				date($GLOBALS['date_format']);
			$tday .= '"> ';

			// render from
			$fday = '<img src='.$GLOBALS['path_theme'].'/images/calender.gif border=0 id=triggerfday>'.$fday.'
<script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "'.$this->id.'_fdate",         // ID of the input field
      ifFormat    : "'.ereg_replace('([A-Za-z])', "%\\1", $GLOBALS['date_format']).'",    // the date format
      button      : "triggerfday"       // ID of the button
    }
  );
</script>';

			// render to
			$tday = 'To <img src='.$GLOBALS['path_theme'].'/images/calender.gif border=0 id=triggertday>'.$tday.'
<script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "'.$this->id.'_tdate",         // ID of the input field
      ifFormat    : "'.ereg_replace('([A-Za-z])', "%\\1", $GLOBALS['date_format']).'",    // the date format
      button      : "triggertday"       // ID of the button
    }
  );
</script>';

			// render date search
			if ($this->date_search_view && $dse) $alldat_str = $fday.' '.$tday.' '.$dat_str.$search_button;
		}
		/*********************** Date Search ***********************/

                // label: total
		$total_label =  '<small>'.
				__('Total').
				' : '.
				'</small>'.
				'<b>'.
				$this->rs->connection->_maxRecordCount.
				'</b>';

		// label: page
		$page_label = '<small>'.__('Page').'</small>';

		// label: 1 page
		$one_page_label = '<small>1 '.__('Page').'</small>';

		// button: rows
		$rows_button = pager::pager_button(array(
			"title"	=> __("Change Rows Per Page"),
			"label"	=> __("Rows"),
			"type"	=> "submit"
		));
		$rows_button = str_replace('<nobr>', '', $rows_button);
		$rows_button = str_replace('</nobr>', '', $rows_button);
		
		/// button: save
		$GLOBALS['count_jumpform']++;
	
		$reset_button = pager::pager_button(array(
			"title"	=> __("Reset"),
			"label"	=> __("Reset"),
			"link"	=> 'javascript:window.location=\''.
				$PHP_SELF.
				'?'.
				$this->id.
				'_keyword=listall&'.
				$this->label_arr['extra_param'].
				'\';',
			"type"	=> "button"));
		$save_button = str_replace('<nobr>', '', $save_button);
		$save_button = str_replace('</nobr>', '', $save_button);

		if ($this->export_view) {
			$image_str = (isset($GLOBALS[path_theme]))?$GLOBALS[path_theme].'/images/save.gif':'';
			$save_button = pager::pager_button(array(
				"title"	=> __("Save")." ".__("List")." ".__("Record"),
				"label"	=> __("Save"),
				"link"	=> 'javascript:window.location=\''.
					$PHP_SELF.
					'?'.
					$this->id.
					'_\'+document.jumpform'.$GLOBALS['count_jumpform'].'.pager_save.value+\'=1&'.
					$this->label_arr['extra_param'].
					'\';',
				"image"	=> $image_str,
				"type"	=> "link"));
			$save_button = str_replace('<nobr>', '', $save_button);
			$save_button = str_replace('</nobr>', '', $save_button);
	
	
			// dropdown: save format
			$save_select = '<select name=pager_save class=text>'.
					'<option value=csv>CSV</option>'.
					'<option value=xls>Spreadsheet</option>'.
					'</select>';
		}

		// render navigation
		$s = <<< EOT
<table border=0 cellspacing=0 cellpadding=0  width=100%>
	<tr class=title_table valign=top>
<td width="300"><b>Navigation</b></td>
<td width="100"><b>Export</b></td>
<td ><b>Manage</b></td>
	</tr>
	<form name=jumpform{$GLOBALS['count_jumpform']} action={$PHP_SELF} method=post>
	<tr>
		<td><nobr>
{$a} {$page_label}:{$f} {$b}
~ {$total_label}
~ {$one_page_label}:
<input type=text class=text name={$this->id}_per_page value='{$this->rows}' size=2>
{$rows_button}
		</nobr></td>
		<td><nobr>
{$reset_button}{$save_button}{$save_select}
		</nobr></td>
		<td><nobr>
{$xs} {$add_str} {$prn_str}
		<input type=button onClick='javascript:confirm("Compressed File ?")?compress=1:compress=0;win=openIT("{$PHP_SELF}?printall=1&&compress="+compress+"&&{$this->label_arr[extra_param]}",100,20,null,null,"downloadall");win.focus();' name=printall value='Save All'>
		</nobr> 
		</td>
	</tr>
	</form>

	<form name=dateform action={$PHP_SELF} method=post>
	<input type=hidden name=action value=find>
	<tr>
		<td colspan=3>
			{$alldat_str}
		</td>
	</tr>
	</form>
</table>
EOT;
		
/*
<!-- <input type=button onClick='javascript:confirm("Compressed File ?")?compress=1:compress=0;win=openIT("",200,50,null,null,"del_selected");html="<html><head><title>Downloading, Please wait ...</title><frameset rows=*,0><frame src=../../themes/default/images/await.gif /><frame src={$PHP_SELF}?printall=1&&compress="+compress+"&&{$this->label_arr[extra_param]} /></frameset></head></html>";win.document.write(html);' name=printall value='Save All'> -->
*/
		return $s.$GLOBALS[pager_chromeless_js];
	}

        // main render
	function render($rows=25) {

		// initialize
		global $ADODB_COUNTRECS;
		//global $_SESSION, $_GET;

		$_SESSION[$this->id.'_per_page'] =
			$_POST[$this->id.'_per_page'] ?
			$_POST[$this->id.'_per_page'] :
			(
				$_GET[$this->id.'_per_page'] ?
				$_GET[$this->id.'_per_page'] :
				(
					$_SESSION[$this->id.'_per_page'] ?
					$_SESSION[$this->id.'_per_page'] :
					( 
						isset($GLOBALS['rows_per_page']) ?
						$GLOBALS['rows_per_page'] :
						$rows
					)
				)
			);
		
		$rows = $_SESSION[$this->id.'_per_page'];
		$max_rows = $this->pager_arr['max_rows'];
		if ($rows > $max_rows) {
			$warning = '<script language="javascript">alert("Rows Per Page.\\nYour request: '.$rows.'.\\nMaximum Allowed:'.$max_rows.'.");</script>';
			$this->pager_arr['warning'] = $warning;
			$rows = $max_rows;
			$_SESSION[$this->id.'_per_page'] = $rows;
		}
		$this->rows = $rows;
		
		$savec = $ADODB_COUNTRECS;
		if ($this->db->pageExecuteCountRows) {
			$ADODB_COUNTRECS = true;
		}
		
		// Querye
		if (ereg('\*', $this->sql)) {
			$rs = &$this->db->CacheSelectLimit($this->cache, $this->sql, 0);
		} else {
			$rs = &$this->db->CacheSelectLimit($this->sql, 0);
		}

		// check error
		if ($this->db->ErrorMsg()) {
			die ('class.pager.inc.php: '.$this->db->ErrorMsg().'<br>'."\n".$this->sql);
		}

		// set field name dan type
		for ($i=0;$i<$rs->FieldCount();$i++) {
			$fld = $rs->FetchField($i);
			$field_arr[] = $fld->name;
			$type_arr[$fld->name] = ADORecordSet::MetaType($fld->type);
		}
		$this->field_arr = $field_arr;
		$this->type_arr = $type_arr;

                // modify sql query
		$sql = $this->sql;
		$sql = str_replace("\r", " ", $sql);
		$sql = str_replace("\n", " ", $sql);
		$sql = str_replace("\t", " ", $sql);
		$sql = stripspaces($sql);
		
		$realOrderBy = '';
		if ($pos=strpos(strtolower($sql), ' order by')) {
			$realOrderBy = substr($sql, $pos);
			$sql = substr($sql, 0, $pos);
		}
		
		
		
		# rudych: parsing group by
		if (eregi('select .* from .* group by .*', $sql)) {
			$mystring = strtolower($sql);
			$findme = 'group by';
			$pos = strpos($mystring, $findme);
			$groupby_sql = substr($sql,$pos+8);
			$sql = substr($sql,0,$pos);
		
			//$where_sql = eregi_replace('select .* from .* where (.*)', '\\1', $sql);
			//$sql = eregi_replace('(select .* from .*) where .*', '\\1', $sql);
		}
		
		if (eregi('select .* from .* where .*', $sql)) {
			$mystring = strtolower($sql);
			$findme = 'where';
			$pos = strpos($mystring, $findme);
			$where_sql = substr($sql,$pos+5);
			$sql = substr($sql,0,$pos);
		
			//$where_sql = eregi_replace('select .* from .* where (.*)', '\\1', $sql);
			//$sql = eregi_replace('(select .* from .*) where .*', '\\1', $sql);
		}

		// set fix key
		$fix_key = array();
		$bad_key = array();
		if (eregi('select (.*) from .*', $sql, $r1)) {
			$p1 = explode(',', $r1[1]);
			foreach ($p1 as $k => $v) {
				if (eregi('(.*) as (.*)', $v, $r2) ||
					eregi('(.*\.(.*))', $v, $r2)) {
					if (str_replace(' ', '', $r2[1])==trim($r2[1]))
						$fix_key[trim($r2[2])] = trim($r2[1]);
					else if (eregi('^case', trim($v))) $bad_key[trim($r2[2])] = '1';
				}
			}
			unset($p1);
			$this->fix_key =& $fix_key;
			$this->bad_key =& $bad_key;
		}

		// field selected
		$_SESSION[$this->id.'_fselect'] =
			$_SESSION[$this->id.'_fselect'] ?
			$_SESSION[$this->id.'_fselect'] :
			$field_arr;

		// field with keyword 'date' selected
		$_SESSION[$this->id.'_dselect'] =
			$_SESSION[$this->id.'_dselect'] ?
			$_SESSION[$this->id.'_dselect'] :
			array();

		$keyword = $this->keyword;
		if (ereg('"(.*)"', trim($keyword))) $key_arr[0] = $keyword;
		else $key_arr = split("[ \t]+",$keyword);
		$where_str = '';

		foreach ($key_arr as $key => $val) {
			if ($where_str) $where_str .= " AND ";
			$fill = 0;
			$tmp = '';
			foreach ($_SESSION[$this->id.'_fselect'] as $k => $v) {
				if ($hideS_arr[$v]) continue;
				if (! isset($type_arr[$v]))
					if (! array_search($v, $fix_key)) { 
						/*echo __LINE__."fix_key: ".$v."<br>\n";*/ 
						continue; 
					} else if (array_search($v, $bad_key)) { 
						/*echo __LINE__."bad_key: ".$v."<br>\n";*/
						continue; 
					}
				if (ereg('[a-zA-z]+\([^\)]+\)', $v)) {
					/*echo __LINE__."(...): ".$v."<br>\n";*/
					continue;
				}
				$fill = 1;
				$my_keyword = trim($val);
				if ($my_keyword!='') {
					if ($tmp) $tmp .= " OR ";
					if (ereg('"(.*)"', $my_keyword, $regs)) {
						$tmp .= ' '.$v . ' = \'' . $regs[1] . '\'';
					} else if (ereg('^[_A-Za-z0-9]+$', $my_keyword)) {
						if (strstr($this->db->dataProvider, 'postgres')) $like = 'ILIKE';
						else $like = 'LIKE';
						if (  $type_arr[$v] == 'L' )	{  // {khad} where support logical (maybe postgres only?)

/*
Valid literal values for the "true" state are:

TRUE
't'
'true'
'y'
'yes'
'1'

For the "false" state, the following values can be used:

FALSE
'f'
'false'
'n'
'no'
'0'
*/						
							switch ($my_keyword) {
								case 'TRUE':
								case 't':
								case 'true':
								case 'y':
								case 'yes':
								case '1':
								case 'FALSE':
								case 'f':
								case 'false':
								case 'n':
								case 'no':
								case '0':
									$tmp .= " $v = '$my_keyword' ";
									break;
							
								default:
									$tmp .= " $v = 't' ";
									break;
							}
						}
						else
							$tmp .= ' '.$v . ' '.$like.' \'%' . $my_keyword . '%\'';
					} else {
						if (strstr($this->db->dataProvider, 'postgres')) $regexp = '~';
						else $regexp = 'REGEXP';
						$tmp .= ' '.$v . ' '.$regexp.' \'' . $my_keyword . '\'';
					}
				}
			}
			if ($fill===0) $tmp .= " 1=1 ";
			if ($tmp) $where_str .= "($tmp)";
		}

		$fdate = $this->parsedate($_SESSION[$this->id.'_fdate']);
		$tdate = $this->parsedate($_SESSION[$this->id.'_tdate']);
		if ($tdate) {
			$tdate += 86400;
			$tdate--;
		}

		//if ($fdate && $tdate) {
		if ($_SESSION[$this->id.'_fdate'] && $_SESSION[$this->id.'_tdate']) {
			$where2_str = '';
				
			foreach ($_SESSION[$this->id.'_dselect'] as $k => $v) {
				if ($this->type_arr[$v] == 'D') {
					$sfdate = $this->parsedate3($_SESSION[$this->id.'_fdate']);
					$stdate = $this->parsedate3($_SESSION[$this->id.'_tdate']);
				} else {
					$sfdate = $fdate;
					$stdate = $tdate;
				}
				if ($fix_key[$v]) $v = $fix_key[$v];
				if ($where2_str) $where2_str .= " OR ";
				$where2_str .= ' (';
				$where2_str .= $v . ' >= ' . $sfdate;
				$where2_str .= ' AND ';
				$where2_str .= $v . ' <= ' . $stdate;
				$where2_str .= ' )';
			}
		}

		// set where sql
		if ($where_str) {
			if ($where_sql) $where_str = "($where_str) AND ($where_sql)";
			else $where_str = $where_str;
		} else {
			if ($where_sql) $where_str = $where_sql;
		}

		if ($where2_str) {
			if ($where_str) $where_str = "($where_str) AND ($where2_str)";
			else $where_str = $where2_str;
		}
		if ($where_str) $where_str = " WHERE $where_str";
		
		# rudych: add group by dari parsing

		//echo $where_str;
		$sql .= $where_str;

		if ($groupby_sql) {
			$sql .= " GROUP BY ".$groupby_sql." ";
		}

		#$sql .= $this->orderby_sql;

		
		
		$tmp1 = $_SESSION[$this->id.'_orderby'];
		$tmp2 = $_SESSION[$this->id.'_orderby_type'];
		if ($type_arr[$tmp1]) $orderby_sql = " ORDER BY $tmp1 $tmp2 ";
		
		if (empty($orderby_sql)) $orderby_sql = $realOrderBy;
		$sql .= $orderby_sql;

		// query
		if ($_GET[printall]) {
			set_time_limit(0);
			ignore_user_abort(TRUE);

			global $ADODB_FETCH_MODE;
			$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
			#ini_set('max_execution_time', 0);

			global $ADODB_CACHE_DIR;
        		$SSA = ini_get('session.save_path');
		        $SSP = $SSA;
		        if (strlen($SSP) > 1 && substr($SSP, -1) == $file_separator) $SSP = substr($SSP, 0, -1);
		        $SA = 0;
		        $SB = ord('c')-1;
		        if (strstr(strtolower(PHP_OS), 'win')) {
		                while (! is_writeable($SSP) && ($SB != ord('z') || $SA & 1)) {
                		        if ($SA & 1) $SD = 'windows';
		                        else {
                		                $SD = 'winnt';
                                		$SB++;
		                        }
                		        $SSP = chr($SB).':\\'.$SD.'\\temp';
		                        $SA++;
                		}
		        } else {
				$SSP = "/tmp";
			}
		        if (is_writeable($SSP)) {
                		$ADODB_CACHE_DIR = $SSP;
		                if (! ini_set('session.save_path', $SSP)) {
                		        die('Sets the value of a configuration option is FAILED.');
		                }
		                $SSP = '';
		        } else {
                		die(
		                        'session.save_path in php.ini not writeable.'.'<br>'."\n".
                		        'session.save_path = '.$SSA.';'
		                );
		        }

			if (strstr(strtolower(PHP_OS), 'win')) { $file_separator = '\\'; }
			else { $file_separator = '/'; 	}

			if ($dir = @opendir($ADODB_CACHE_DIR)) {
				while (($file = readdir($dir)) !== FALSE) {
					$file = $ADODB_CACHE_DIR.$file_separator.$file;
					if (stristr($file, 'output-')&&time()-filemtime($file)>600) {
						unlink($file);
					}
				}
				closedir($dir);
			}

			if ($_GET[fileName]) {
				if(isset($HTTP_ENV_VARS['HTTP_USER_AGENT']) and strpos($HTTP_ENV_VARS['HTTP_USER_AGENT'],'MSIE 5.5'))
                        	        Header('Content-Type: application/dummy');
                        	else
                        	        Header('Content-Type: application/octet-stream');
	        	        header("Content-disposition: attachment; filename=output.csv.gz" );
	        	        header("Expires: 0");
		        	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        		        header("Pragma: public");

				$fileName = $_GET[fileName];
				$fileName = $ADODB_CACHE_DIR.$file_separator.$fileName;

				#$fd = fopen($fileName, "r");
				#while (! feof($fd)) {
				#	echo fread($fd, 4096);
				#}
				readfile($fileName);
				unlink($fileName);
				exit;
			}

		

			#header("Content-type: text/comma-separated-values");
			$compress = $_GET[compress];
			if ($compress) {
				if (strstr(strtolower(PHP_OS), 'win')) { $file_separator = '\\'; }
				else { $file_separator = '/'; 	}

	        	        #header("Content-disposition: attachment; filename=output.csv.gz" );
				$fileName = $ADODB_CACHE_DIR.$file_separator."output-".substr(md5(time()), 0, 5).".csv";
				$fd = fopen($fileName, "w");
			} else {
				if(isset($HTTP_ENV_VARS['HTTP_USER_AGENT']) and strpos($HTTP_ENV_VARS['HTTP_USER_AGENT'],'MSIE 5.5'))
                        	        Header('Content-Type: application/dummy');
                        	else
                        	        Header('Content-Type: application/octet-stream');
	        	        header("Content-disposition: attachment; filename=output.csv" );
	        	        header("Expires: 0");
		        	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        		        header("Pragma: public");
			}

			if ($compress) {
				echo "<style type='text/css'>body,a,table,input,select{font-size:10px;}</style>\n";
				echo "<form name=theform>Compression<br>Status:<br><input size=10 name=a value='Please wait...'></form>\n";
				echo "<script language=javascript>b=document.theform.a;</script>\n";
				flush();
			}

			$rs = &$this->db->Execute($sql);
			$recordCount = $rs->RecordCount();

			if ($compress) echo "<script language=javascript>b.value='0 %';</script>\n";
			$optional_arr = $this->optional_arr;
			if ($rs && ! $rs->EOF) {
				$str = '';
				foreach ($rs->fields as $k => $v) {
					if ($optional_arr[$k] == 1) {
						continue;
					}
					if ($this->label_arr[$k]) $k = $this->label_arr[$k];
					if ($str) $str .= ",";
					$str .= "\"'".addslashes($k)."\"";
				}
				$oneLine = $str."\n";
				if ($compress) {
					fwrite($fd, $oneLine);
				} else {
					echo $oneLine;
					$oneLine = '';
				}
			}
			$eval_arr = $this->eval_arr;
			
			$i = 1;
			$prev = 0;		
			while ($rs && ! $rs->EOF) {
				$perc = $i*100/$recordCount;
				$perc = intval($perc);
				if ($prev!=$perc) {
			                flush();
					if (connection_status()!=0) {
						if ($compress) {
							fclose($fd);
							unlink($fileName);
						}
						exit;
					}
			                if ($compress) {
						echo "<script language=javascript>b.value='$perc %';</script>\n";
						fwrite($fd, $oneLine);
						$oneLine = '';
					}
				}
				$prev= $perc;
				$i++;

				$str1 = '';
				foreach ($rs->fields as $k => $v) {
					if ($optional_arr[$k] == 1) {
						continue;
					}
					if ($str1) $str1 .= ",";
					$date_check = eregi('(^date_)|(_date$)|(^lda$)|(^tgl_)|(_tgl$)|(tanggal)', $k);
					#if (strstr('IN', $this->type_arr[$k]) && ! $date_check)
					
					if ($eval_arr[$k]) {
						$str = '';
						eval(preg_replace('/\%s/', addslashes($v), $eval_arr[$k]));
						$v = pager::unhtmlentities(strip_tags($str));
					} else if ($date_check && $v) {
						
						if ($optional_arr[$k.'_dateformat']) {
							$old_date_format = $date_format;
							$date_format = $optional_arr[$k.'_dateformat'];
						} else {
							$date_format = $GLOBALS[date_format];
						}
						$v = date($date_format,$v);
						if ($old_date_format) {
							$date_format = $old_date_format;
							unset($old_date_format);
						}
					}
					$v = str_replace("\n", " ", $v);
					$v = str_replace("\r", "", $v);
					$str1 .= "\"'".addslashes($v)."\"";
				}
				$oneLine .= $str1."\n";
				if ($compress) {
					#if (strlen($oneLine)>500000) {
					#	fwrite($fd, $oneLine);
					#	$oneLine = '';
					#}
				} else {
					echo $oneLine;
					$oneLine = '';
				}
				$rs->MoveNext();
			}
			if ($compress) {
				if ($oneLine!='') fwrite($fd, $oneLine);
				fclose($fd);
				$fd = popen("gzip $fileName", "r");
				pclose($fd);
				$fileName .= ".gz";

				global $PHP_SELF;
			
				echo '<script language=javascript>b.value="Complete";</script>';
				sleep(1);
				echo '<script language=javascript>location.href="'.$PHP_SELF.'?printall=1&fileName='.urlencode(basename($fileName)).'&'.$this->label_arr[extra_param].'";</script>';
			}
			exit;
		} else {
			$rs = &$this->db->PageExecute($sql,$rows, $this->curr_page);
		}
		#echo $sql;
		//echo getmicrotime();
		$this->rs = &$rs;

		// check error
		if ($this->db->ErrorMsg()) {
			die ('class.pager.inc.php: '.$this->db->ErrorMsg().'<br>'."\n".$sql);
		} else if ($rs->EOF) {
			//return ('<font color=red size=+2><b>Empty Data !!!</b></font>');
		}

		// restore after query
		$ADODB_COUNTRECS = $savec;

                // set current page
		$this->curr_page = $this->rs->_currentPage;
		$_SESSION[$this->id.'_curr_page'] = $this->curr_page;

                // render grid data
		$s = $this->render_grid();

		// close result
		$rs->close();
		$this->rs = false;
		
		return $s.$this->pager_arr['warning'];
	}

	function render_nav_search() {
		global $PHP_SELF;
		$vsel_str = $this->id.'_vselect';

		$nav = $this->render_nav();
		$nav_row = <<< EOT

<!-- Navigation Block -->
	<tr>
		<td valign=bottom align=left colspan=4 nowrap>
			<table border=0 width=100% cellpadding=0  cellspacing=0>
				<tr>
					<td>{$nav}</td>
				</tr>
			</table></td>
	</tr>
<!-- Navigation Block -->

EOT;

		// dropdown: field selector for search engine
		reset($_SESSION[$this->id.'_fselect']);
		$el = each($_SESSION[$this->id.'_fselect']);
		$f = '<select class=text name='.$this->id.'_fselect[] multiple size=2>';
		for ($i=0;$i<count($this->field_arr);$i++) {
			if ($el['value']==$this->field_arr[$i]) {
				$sl = ' selected';
				$el = each($_SESSION[$this->id.'_fselect']);
			} else if ($this->fix_key[$this->field_arr[$i]]==$el['value'] && $el['value']){
				$sl = ' selected';
				$el = each($_SESSION[$this->id.'_fselect']);
			} else {
				$sl = '';
			}
			if ($this->hideS_arr[$this->field_arr[$i]]) { continue; }
			if ($this->optional_arr[$this->field_arr[$i]] == 1
			|| ereg('date', $this->field_arr[$i]))
				continue;
			else if ($this->bad_key[$this->field_arr[$i]]==1)
				continue;
			$field_var =
				$this->var_arr[$this->field_arr[$i]] ?
				$this->var_arr[$this->field_arr[$i]] :
				$this->field_arr[$i];

			$label_name =
				$this->label_arr[$this->field_arr[$i]] ?
				$this->label_arr[$this->field_arr[$i]] :
				$this->field_arr[$i];

			if (ereg('[a-zA-z]+\([^\)]+\)', $this->fix_key[$field_var])) continue;
                        else if ($this->fix_key[$field_var]) $field_var = $this->fix_key[$field_var];
			
			#if ($this->fix_key[$field_var]) $field_var = $this->fix_key[$field_var];
			$f .= '<option value='.$field_var.$sl.'>'.$label_name.'</option>';
		}
		$f .= '</select>';

                // dropdown: add view, remove view
		$b = '<select class=text name='.$this->id.'_aselect[] multiple size=2>';
		$c = '<select class=text name='.$this->id.'_rselect[] multiple size=2>';
		for ($i=0;$i<count($this->field_arr);$i++) {
			if ($this->optional_arr[$this->field_arr[$i]] == 1)
				continue;
			if ($_SESSION[$vsel_str][$this->field_arr[$i]]==TRUE) {
				$c .= '<option value='.$this->field_arr[$i].'>';
				$c .= $this->label_arr[$this->field_arr[$i]] ? $this->label_arr[$this->field_arr[$i]] : $this->field_arr[$i];
				$c .= '</option>';
			} else {
				$b .= '<option value='.$this->field_arr[$i].'>';
				$b .= $this->label_arr[$this->field_arr[$i]] ? $this->label_arr[$this->field_arr[$i]] : $this->field_arr[$i];
				$b .= '</option>';
			}
		}
		$b .= '</select>';
		$c .= '</select>';

		$k = $this->keyword;
		$k = htmlentities($k);

		$xp = split('&', $this->label_arr['extra_param']);
		$xs = '';
		for ($i=0;$i<count($xp);$i++) {
			list($xn, $xl) = split('=', $xp[$i]);
			$xs .= '<input type=hidden name='.$xn.' value='.$xl.'> ';
		}

		$keyword_label = '<b>'.__('Keyword').'</b>';
		$table_view_label = '<b>'.__('Table View').'</b>';

		// button: search
		$image_str = (isset($GLOBALS[path_theme]))?$GLOBALS[path_theme].'/images/search.gif':'';
		$search_button = pager::pager_button(array(
			"title"		=> __("Find")." ".__("Keyword"),
			"label"		=> __("Find"),
			"link"		=> "this.form.submit()",
			"image"		=> $GLOBALS['path_theme'].'/images/search.gif',
			"type"		=> "button",
			"position"	=> "bottom"));

		// button: add view
		$add_view_button = pager::pager_button(array(
			"title"		=> __("Add View"),
			"label"		=> ">>",
			"link"		=> "",
			"image"		=> "",
			"var"		=> $this->id."_addview",
			"type"		=> "submit"));

		// button: remove view
		$del_view_button = pager::pager_button(array(
			"title"		=> __("Remove View"),
			"label"		=> "<<",
			"link"		=> "",
			"image"		=> "",
			"var"		=> $this->id."_delview",
			"type"		=> "submit"));

		if ($this->search_view) {
/*
<!-- // fix me
<script language="JavaScript">
if (document.all||document.getElementById) {
 document.writeln("<div id=\"PopUpTableView\" style=\"position:absolute; left:0px; top:0px; z-index:7; width:200px; height:77px; overflow: visible; visibility: hidden; background-color: #FFFFFF; border: 1px none #000000\" onMouseOver=\"if(pptvTI){ clearTimeout(pptvTI);pptvTI=false;}\" onMouseOut=\"pptvTI=setTimeout(\'hideTableView()\',500)\">");}
else if (document.layers) {
 document.writeln("<layer id=\"PopUpTableView\" pagex=\"0\" pagey=\"0\" width=\"200\" height=\"200\" z-index=\"100\" visibility=\"hide\" bgcolor=\"#FFFFFF\" onMouseOver=\"if(pptvTI){ clearTimeout(pptvTI);pptvTI=false;}\" onMouseOut=\"pptvTI=setTimeout('hideTableView()',500)\">");}
else {
 document.writeln("<p><font color=\"#FF0000\"><b>Error ! The current browser is either too old or too modern (usind DOM document structure).</b></font></p>");}
</script>
<noscript><p><font color="#FF0000"><b>JavaScript is not activated !</b></font></p></noscript>
-->
<!-- // fix me
<script language="JavaScript">
if (document.all||document.getElementById) {
 document.writeln("</div>");}
else if (document.layers) {
 document.writeln("</layer>");
else {  }
</script>
-->
*/
			$search_row = <<< EOT
	<tr>
		<td>

			<!-- Begin Table View -->
			<table width=100% border=0 cellpaddin=1 cellspacing=0>
				<form name=tableview action={$PHP_SELF} method=post>
				<tr class=title_table>
<td colspan=3 valign=top>{$table_view_label}</td>
				</tr>
				<tr>
<td valign=bottom align=right>{$b}</td>
<td align=center nowrap>
<nobr>
&nbsp;<br>
{$add_view_button} {$del_view_button}
</nobr>
</td>
<td align=left>{$c}</td>
				</tr>
				{$xs}
				</form>
			</table>
			<!-- End Table View -->
		</td>
		<td>
			<!-- Begin Search Engine -->
			<table width=100% border=0 cellpadding=0  cellspacing=0>
				<form name=searchform action={$PHP_SELF} method=post>
				<tr class=title_table>
<td colspan=2 valign=top><b>Search</b></td>
				</tr>
				<tr>
<td valign=bottom align=center>
{$keyword_label}:<br>
<nobr>
<input
	type=text
	class=text
	name={$this->id}_keyword
	value="{$k}"
	maxlength=32
	size=8
/>
</nobr>
</td>
<td align=left>
<nobr>
{$f} {$search_button}
</nobr>
</td>
				</tr>
				{$xs}
				</form>
			</table>
			<!-- End Search Engine -->
		</td>
	</tr>

EOT;
		} // enf if this->search_view

		$s = <<< EOT
<table width=100% border=1 cellpadding=0  cellspacing=0>
	{$search_row}
	{$nav_row}
</table>

EOT;

		return $s;
	}

	function parsedate($str) {
		return parsedate($str);
	}
}

?>

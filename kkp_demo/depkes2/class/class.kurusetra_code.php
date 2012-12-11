<?php
if (! defined('CLASS_KURUSETRA_CODE')) {
    define('CLASS_KURUSETRA_CODE', TRUE);
    
class kurusetra_code {
	var $character = array();
	function kurusetra_code() {
		$character =& $this->character;
		$character['a'] = <<< EOT
...XX...
..XXXX..
.XX..XX.
XX....XX
XX....XX
XX....XX
XXXXXXXX
XX....XX
XX....XX
XX....XX

EOT;

		$character['b'] = <<< EOT
XXXXXX..
XX...XX.
XX....XX
XX...XX.
XXXXXX..
XX...XX.
XX....XX
XX....XX
XX...XX.
XXXXXX..

EOT;

		$character['c'] = <<< EOT
..XXXXX.
.XX...XX
XX.....X
XX......
XX......
XX......
XX......
XX.....X
.XX...XX
..XXXXX.

EOT;

		$character['d'] = <<< EOT
XXXXXX..
XX...XX.
XX....XX
XX....XX
XX....XX
XX....XX
XX....XX
XX....XX
XX...XX.
XXXXXX..

EOT;

		$character['e'] = <<< EOT
XXXXXXX.
XX......
XX......
XX......
XXXXXX..
XX......
XX......
XX......
XX......
XXXXXXX.

EOT;

		$character['f'] = <<< EOT
XXXXXXXX
XX......
XX......
XX......
XXXXXX..
XX......
XX......
XX......
XX......
XX......

EOT;

		$character['0'] = <<< EOT
...XX...
..XXXX..
.XX..XX.
XX....XX
XX....XX
XX....XX
XX....XX
.XX..XX.
..XXXX..
...XX...

EOT;

		$character['1'] = <<< EOT
...XX...
..XXX...
.XXXX...
...XX...
...XX...
...XX...
...XX...
...XX...
...XX...
.XXXXXX.

EOT;

		$character['2'] = <<< EOT
..XXXX..
.XX..XX.
XX....XX
......XX
.....XX.
....XX..
...XX...
..XX....
.XX.....
XXXXXXXX

EOT;

		$character['3'] = <<< EOT
.XXXXX..
XX...XX.
......XX
.....XX.
...XXX..
.....XX.
......XX
......XX
XX...XX.
.XXXXX..

EOT;

		$character['4'] = <<< EOT
.....XX.
....XXX.
...XXXX.
..XX.XX.
.XX..XX.
XX...XX.
XXXXXXXX
.....XX.
.....XX.
.....XX.

EOT;

		$character['5'] = <<< EOT
XXXXXXX.
XX......
XX......
XX.XXX..
XXX..XX.
......XX
......XX
XX....XX
.XX..XX.
..XXXX..

EOT;

		$character['6'] = <<< EOT
..XXXX..
.XX..XX.
XX....X.
XX......
XX.XXX..
XXX..XX.
XX....XX
XX....XX
.XX..XX.
..XXXX..

EOT;

		$character['7'] = <<< EOT
XXXXXXXX
......XX
......XX
.....XX.
....XX..
...XX...
..XX....
.XX.....
XX......
XX......

EOT;

		$character['8'] = <<< EOT
..XXXX..
.XX..XX.
XX....XX
.XX..XX.
..XXXX..
.XX..XX.
XX....XX
XX....XX
.XX..XX.
..XXXX..

EOT;

		$character['9'] = <<< EOT
..XXXX..
.XX..XX.
XX....XX
XX....XX
.XX..XXX
..XXX.XX
......XX
.X....XX
.XX..XX.
..XXXX..

EOT;

	}
	
	// load image
	function get_file($filename='kode.png') {

		// get file
		ob_implicit_flush(0);
		ob_start();
		readfile('http://perang.kurusetra.com/kode.php');
		$fcontents = ob_get_contents();
		ob_end_clean();

		// save file
		$fp = fopen ($filename, 'wb');
		fwrite($fp, $fcontents);
		fclose($fp);
	}

	// check image
	function get_code($filename='kode.png') {
	
		//$character = $GLOBALS['character'];
		$character =& $this->character;

		// load image
		$im = imagecreatefrompng ($filename);
		
		// get info
		$imx = imagesx ($im);
		$imy = imagesy ($im);

		// put into matrix
		for ($y=0;$y<$imy;$y++) {
			$line = array();
			$flat = '';
			for ($x=0;$x<$imx;$x++) {
				$char = imagecolorat ($im, $x, $y);
				$flat .= $char;
				if ($char) $char = 'X';
				else $char = '.';
				$line[] = $char;
			}
			if ((int)$flat) $square[] = $line;
		}

		// print matrix
		$output = '';
		for ($i=0;$i<count($square);$i++) {
			$line = '';
			for ($j=0;$j<count($square[$i]);$j++) {
				$line .= $square[$i][$j];
			}
			$output .= $line."\n";
		}
		//echo "Image: <img src=kode.png valign=middle><br>";
		//echo "Matrix:<br><pre>".$output."</pre>";
		//echo "".$output."";
		//exit;

		// check matrix
		$code = '';
		for ($x=0;$x<$imx-7;$x++) {
			for ($y=0;$y<count($square)-9;$y++) {
				$square8 = $this->load_square($x, $y, $square);
				$found = $this->check_square($square8, $character);
				//if ($found=='') {
				//	$lost_square = look_square($square8);
				//	if ($lost_square) $lost_arr[] = $lost_square;
				//}
				$code .= $found;
			}
		}
		//echo "\n";
		//if (count($lost_arr)) echo implode("\n", $lost_arr);
		return $code;
	}

	// find lost character
	function look_square(&$square8) {
		$piece = split("\n", $square8);
		$line = '';
		$line2 = '';
		for ($i=0;$i<10;$i++) $line .= $piece[$i][0];
		for ($i=0;$i<10;$i++) $line2 .= $piece[$i][7];
		$row1_match = strchr($piece[0], "X");
		$row2_match = strchr($piece[9], "X");
		$col1_match = strchr($line, "X");
		$col2_match = strchr($line2, "X");
		if ($row1_match && $row2_match && $col1_match && $col2_match) {
			return $square8;
		}
		return '';
	}

	function &load_square($x, $y, &$square) {
		$square8 = '';
		for ($j=$y;$j<$y+10;$j++) {
			for ($i=$x;$i<$x+8;$i++) {
				$square8 .= $square[$j][$i];
			}
			$square8 .= "\n";
		}
		return $square8;
	}

	function check_square(&$square8, &$character) {
		reset($character);
		foreach ($character as $key => $value) {
			if ($value==$square8) return "$key";
		}
		return '';
	}
}

} // end of define
//for ($i=0;$i<1000;$i++) {
//	load_file();
//	$code = check_file();
//	echo "Code is: ".$code."\n";
//	if (strlen($code)!=4) break;
//	ini_set('max_execution_time', 300); // 5 minute
//}

?>

<?php


	// check already defined or not
	if (class_exists('pg')) {
		return 0;
	} else if (defined('CLASS_PG')) {
		return 0;
	} else {
		define('CLASS_PG', TRUE);
	}

	class pg {
		var $data;
		var $command;

		function pg($cf='') {
			$this->command = $cf['command'] ? $cf['command'] : '';
			if (eregi('^win', PHP_OS)) { $this->command = $this->command ? $this->command : 'c: && cd c:\winnt && (xlhtml %s > %s)'; }
			else if (eregi('^linux', PHP_OS)) { $this->command = $this->command ? $this->command : '(/usr/local/bin/xlhtml %s > %s)'; }
		}

		function parsefile() {
			// initialize
			global ${$GLOBALS['files_vars']}, ${$GLOBALS['post_vars']};
			global $adodb;

			srand((double)microtime()*1000000);
			ini_set('max_execution_time', 300); // 1 minute 30 seconds
			if (eregi('^win', PHP_OS)) {$include_separator = ';';$file_separator = '\\';}
			else if (eregi('^linux', PHP_OS)) {$include_separator = ':';$file_separator = '/';}

			$worksheet_code = ${$GLOBALS['post_vars']}['worksheet_code'];
			$start_fetch = FALSE;
			$product_arrs = array();
			$market_arrs = array();
			$market_name = FALSE;
			$market_code = FALSE;
			$product_name = FALSE;
			$product_code = FALSE;
			$sheets_count = 0;
			$first_get = TRUE;

			// create filename
			$input_file = '/tmp/'.md5(rand()).'.cache.txt';
			$output_file = '/tmp/'.md5(rand()).'.output.txt';

			$input_file = ereg_replace('/', $file_separator, $input_file);
			$output_file = ereg_replace('/', $file_separator, $output_file);

			// check input file
			if (! move_uploaded_file(${$GLOBALS['files_vars']}['userfile']['tmp_name'], $input_file)) {
				return FALSE;
			}

			// exec command xlhtml
			$command = sprintf($this->command, $input_file, $output_file);
			$fp = popen($command, 'r');
			$contents = '';
			while (! feof($fp)) {
				$content = fgets($fp, 4096);
			}
			pclose($fp);

			// check output file
			if (! file_exists($output_file)) {
				return FALSE;
			}

			// get product data
			$result = $adodb->Execute('SELECT * FROM pg_product');
			while (! $result->EOF) {
				$product_arr[$result->fields['code']] = $result->fields['name'];
				$result->MoveNext();
			}
			unset($result);

			// get market data
			$result = $adodb->Execute('SELECT * FROM pg_market');
			while (! $result->EOF) {
				$market_arr[$result->fields['code']] = $result->fields['name'];
				$result->MoveNext();
			}
			unset($result);

			// delete data from database
			$adodb->Execute("DELETE FROM pg_market_product WHERE worksheet_code='$worksheet_code'");

			// parse output file
			$fd = fopen ($output_file, "r");
			while (! feof($fd)) {
				$buffer = trim(fgets($fd, 4096));
				$content = trim($this->my_strip_tags($buffer));

				if (ereg("<H1><CENTER>(.*)</CENTER></H1><br>", $buffer)) {
					; // do nothing
				} else if (in_array($content, $product_arr)) {
					// get product name into product_stat_arr
					$start_data = TRUE;
					$product_stat_arr = array();
					$product_stat_arr[] = array_search($content, $product_arr);
					$buffer2 = fgets($fd, 4096);
					while (! ereg("</TR", $buffer2)) {
						$content2 = trim($this->my_strip_tags($buffer2));
						if ($content2) {
							$product_stat_arr[] = array_search($content2, $product_arr);
							$pos_product++;
							$adodb->Execute('UPDATE pg_product SET pos=\''.($pos_product+100).'\' WHERE code=\''.$product_stat_arr[$pos_product-1].'\'');
						}
						$buffer2 = fgets($fd, 4096);
					}
				} else if ($start_data) {
					if (ereg("<TR", $buffer)) {
						// start fetch value
						$start_fetch = TRUE;
					} else if ($start_fetch) {
						// get market name and cell value
						$market_stat = array_search($content, $market_arr);
						$buffer2 = fgets($fd, 4096);
						$x=0;
						$stat_query = "";
						while (! ereg("</TR", $buffer2)) {
							$content2 = trim($this->my_strip_tags($buffer2));
							// check market
							if ($content2 != "" && $market_stat) {
								// check product
								if ($product_stat_arr[$x]) {
									// build query
									if ($stat_query) $stat_query .= ',';
									$stat_query .= "('{$product_stat_arr[$x]}','{$market_stat}','{$content2}','{$worksheet_code}')";
								}
								$x++;
							}
							$buffer2 = fgets($fd, 4096);
						}
						if ($market_stat) {
							$pos_market++;
							$adodb->Execute('UPDATE pg_market SET pos=\''.($pos_market+100).'\' WHERE code=\''.$market_stat.'\'');
						}
						if ($stat_query) {
							// join query
							if ($all_query) $all_query .= ',';
							$all_query .= $stat_query;
						}
						if (! $x) {
							$start_data = FALSE;
						}
						$start_fetch = FALSE;
					}
				}
				if (ereg("</table", $buffer)) {
					// stop data and insert data into database
					$start_data = FALSE;
//					$adodb->Execute("INSERT INTO pg_market_product VALUES ".$all_query.";");
					$all_query = str_replace("),", ")\n", $all_query);
					if (strstr('mysql', $GLOBALS['adodb_type'])) {
						$piece = explode("\n", $all_query);
						foreach ($piece as $key => $value) {
							$value = str_replace('(\'', '', $value);
							$value = str_replace('\',\'', "\t", $value);
							$value = str_replace('\')', '', $value);
							if ($data_file) $data_file .= "\n";
							$data_file .= $value;
						}
						$fl = fopen($output_file.'.mysql', 'w');
						fwrite($fl, $data_file);
						fclose($fl);
						$adodb->Execute('LOAD DATA INFILE \''.$output_file.'.mysql'.'\' INTO TABLE pg_market_product (product_code, market_code, value, worksheet_code)');
						unlink($output_file.'.mysql');
					} else if (strstr('postgres', $GLOBALS['adodb_type'])) {
						$piece = explode("\n", $all_query);
						foreach ($piece as $key => $value) {
							$value = str_replace('(\'', '', $value);
							$value = str_replace('\',\'', "\t", $value);
							$value = str_replace('\')', '', $value);
							if ($data_file) $data_file .= "\n";
							$data_file .= $value;
						}
						$fl = fopen($output_file.'.pgsql', 'w');
						fwrite($fl, $data_file);
						fclose($fl);
						$adodb->Execute('COPY pg_market_product (product_code, market_code, value, worksheet_code) FROM \''.$output_file.'.pgsql'.'\'');
						unlink($output_file.'.pgsql');
					} else {
						$piece = explode("\n", $all_query);
						foreach ($piece as $key => $value) {
							$adodb->Execute('INSERT INTO pg_market_product (product_code, market_code, value, worksheet_code) VALUES '.$value);
						}
					}
					unset($all_query);
				}
			}
			fclose ($fd);
			unlink($input_file);
			unlink($output_file);

			return TRUE;
		}

		function my_strip_tags($str) {
			$str = strip_tags($str);
			$search = array ("'&nbsp;'i", "'&amp;'i");
			$replace = array ("", "&");
			return preg_replace ($search, $replace, $str);
		}

		function parsedate($str) {
			if (ereg('^([0-9]+)-([0-9]+)-([0-9]+) ([0-9]+):([0-9]+):([0-9]+)$', $str, $regs)) {
				return mktime($regs[4], $regs[5], $regs[6], $regs[2], $regs[3], $regs[1]);
			}
		}

		function get_message($market_code, $product_code, $worksheet_code) {
			//cl_debug('[BEGIN] pg::get_message(\''.$market_code.'\',\''.$product_code.'\',\''.$worksheet_code.'\') = '.strlen($message)."\n");
			require_once 'class.pg_worksheet.inc.php';
			require_once 'class.pg_market_product.inc.php';

			$market_code = strtoupper($market_code);
			$product_code = strtoupper($product_code);
			$worksheet_code = strtoupper($worksheet_code);

			$result = pg_worksheet::get(array('worksheet_code' => $worksheet_code));
			$record = $result[0];
			//if (! $record) return FALSE;
			$message = $record['worksheet_template'];
			$date_d = date('d', $record['worksheet_date']);
			$date_m = date('m', $record['worksheet_date']);
			$date_y = date('y', $record['worksheet_date']);

			$record = array();
			$record['market_code'] = $market_code;
			$record['product_code'] = $product_code;
			$record['worksheet_code'] = $worksheet_code;
			$result = pg_market_product::get($record);
			$record = $result[0];
			if (! $record) {
				$message = FALSE;
			} else {
				$message = str_replace('%d', $date_d, $message);
				$message = str_replace('%m', $date_m, $message);
				$message = str_replace('%y', $date_y, $message);
				$message = str_replace('[[market_code]]', $record['market_code'], $message);
				$message = str_replace('[[product_code]]', $record['product_code'], $message);
				$message = str_replace('[[value]]', sprintf("%01.1f", $record['value']), $message);
			}
			cl_debug('pg::get_message(\''.$market_code.'\',\''.$product_code.'\',\''.$worksheet_code.'\') = '.strlen($message)."\n");
			return $message;
		}

		// print page worksheet
		function render($worksheet_code) {

			global $adodb;
			
			if (!$worksheet_code) {
				return FALSE;
			}

			$tmp_product = $adodb->Execute("SELECT DISTINCT(product_code) AS product_code FROM pg_market_product WHERE worksheet_code='".addslashes($worksheet_code)."'");
			$tmp_sql = "SELECT code AS product_code, name AS product_name FROM pg_product WHERE ";
			while (! $tmp_product->EOF) {
				$tmp_sql .= " code='".$tmp_product->fields['product_code']."' OR ";
				$tmp_product->MoveNext();
			}
			$tmp_sql .= " 1=0 ORDER BY pos";
			$product = $adodb->Execute($tmp_sql);

			$tmp_market = $adodb->Execute("SELECT DISTINCT(market_code) AS market_code FROM pg_market_product WHERE worksheet_code='".addslashes($worksheet_code)."'");
			$tmp_sql = "SELECT code AS market_code, name AS market_name FROM pg_market WHERE ";
			while (! $tmp_market->EOF) {
				$tmp_sql .= " code='".$tmp_market->fields['market_code']."' OR ";
				$tmp_market->MoveNext();
			}
			$tmp_sql .= " 1=0 ORDER BY pos";
			$market = $adodb->Execute($tmp_sql);

			$result = $adodb->Execute("SELECT * FROM pg_market_product WHERE worksheet_code='$worksheet_code'");
			while (! $result->EOF) {
				//$record = $result[$i];
				$pgmp[$result->fields['product_code']][$result->fields['market_code']] = $result->fields['value'];
				$result->MoveNext();
			}
			unset($result);

			$str = '|';
			$num_col++;
			while (! $product->EOF) {
				$str .= $product->fields['product_name'] .'|';
				$num_col++;
				$product->MoveNext();
			}
			$str = substr($str, 0, -1);
			$tit_str[] = $str;

			while (! $market->EOF) {
				$str = '<nobr>'.$market->fields['market_name'] .'</nobr>'.'|';
				$product->MoveFirst();
				while (! $product->EOF) {
					$str .= '<nobr><div align=right>';
					$str .= sprintf("%01.1f", $pgmp[$product->fields['product_code']][$market->fields['market_code']]);
					$str .= '</div></nobr>'.'|';
					$product->MoveNext();
				}
				$str = substr($str, 0, -1);
				$arr_str[] = $str;
				$market->MoveNext();
			}

			$_block = new block();
			$_block->set_config('num_col', $num_col);
			$_block->set_config('width', '100%');
			$_block->set_title($tit_str);
			$_block->parse($arr_str);
			return  '<b>'.$worksheet_code.'</b>'.$_block->get_str();
		}
	}
?>

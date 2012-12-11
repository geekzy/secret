<?php

	require_once 'class.template.inc.php';

	if (class_exists('block')) {
		return 0;
	} else if (defined('CLASS_BLOCK')) {
		return 0;
	} else {
		define('CLASS_BLOCK', TRUE);
	}

	class block {
		var $title;
		var $width=200;
		var $outer_class='class=out_border';
		var $outer_extra;
		var $inner_class='class=in_table';
		var $inner_extra;
		var $title_class='class=title_table';
		var $title_extra;
		var $cell_extra;
		var $num_col=2;
		var $tpl;
		var $odd_color;
		var $even_color;
		var $arr_color;

		function block($config='', $template='block.html') {

			// create template object
			if ($GLOBALS['tpl']) {
				$this->tpl = new template($GLOBALS['tpl']->root);
			} else {
				$this->tpl = new template('.');
			}

			$this->tpl->set_file(
				array(
					'PORTAL' => $template
				)
			);
			$this->tpl->set_unknowns('remove');
			$this->tpl->set_block('PORTAL','portal_box','portal_box');
			$this->tpl->set_block('PORTAL','portal_row','portal_row');
			$this->tpl->set_block('PORTAL','portal_listbox_header','portal_listbox_header');
			$this->tpl->set_block('PORTAL','portal_listbox_link','portal_listbox_link');
			$this->tpl->set_block('PORTAL','portal_listbox_footer','portal_listbox_footer');
			$this->tpl->set_block('PORTAL','portal_control','portal_control');
			$this->tpl->set_block('PORTAL','link_field','link_field');
			$this->set_config(&$config);
		}

		function set_config($config, $value='') {
			if (is_array($config)) {
				$this->title = $config['title']?$config['title']:'';
				$this->width = $config['width']?$config['width']:200;
				$this->outer_class = $config['outer_class']?'class='.$config['outer_class']:'class=out_border';
				$this->outer_extra = $config['outer_extra'];
				$this->inner_class = $config['inner_class']?'class='.$config['inner_class']:'class=in_table';
				$this->inner_extra = $config['inner_extra'];
				$this->title_class = $config['title_class']?'class='.$config['title_class']:'class=title_table';
				$this->title_extra = $config['title_extra'];
				$this->cell_extra = $config['cell_extra'];
				$this->num_col = $config['num_col']?$config['num_col']:2;
				$this->md5_js = $config['md5_js'];
			} else {
				$this->$config = $value;
			}
			$this->tpl->set_var(
				array(
					'outer_attr'	=> $this->outer_class.' '.$this->outer_extra,
					'inner_attr'	=> $this->inner_class.' '.$this->inner_extra,
					'title_attr'	=> $this->title_class.' '.$this->title_extra,
					'width'			=> $this->width,
				)
			);
		}
		function parse($str, $target='row', $cell_extra='', $append=TRUE) {
			$cell_extra = $cell_extra ? $cell_extra : $this->cell_extra;
			if (is_array($str)) {
				$trc = 0;
				foreach ($str as $key => $value) {
					$trc++;
					$cells = explode('|', $value);
					for ($j=0;$j<count($cells)&&$j<$this->num_col;$j++) {
						$count_plus = 0;
						if (ereg('^\*', $cells[$j]))
						{	$cells = explode('|', $value, $j+1);$count_plus=$this->num_col-$j-1;}
						if (ereg('^\++', $cells[$j], $ereg))
							$count_plus = strlen(ereg_replace('[^\+]', '', $ereg[0]));
						$cells[$j] = ereg_replace('^\*?\+*', '', $cells[$j]);
						if ($count_plus > 0) {
							$this->tpl->set_var('cell_extra', $cell_extra.' colspan='.($count_plus+1));
						} else {
							$this->tpl->set_var('cell_extra', $cell_extra);
						}
						$this->tpl->set_var('control_link', $cells[$j]);
						$this->tpl->parse('output', 'portal_control', TRUE);
					}
				
					if ($this->arr_color[$key]) { $this->tpl->set_var('tr_extra', 'bgcolor='.$this->arr_color[$key]);}
					else if ($trc&1&&$this->odd_color) { $this->tpl->set_var('tr_extra', 'bgcolor='.$this->odd_color);}
					else if ($this->even_color) { $this->tpl->set_var('tr_extra', 'bgcolor='.$this->even_color);}
					else { $this->tpl->set_var('tr_extra','');}
					$this->tpl->parse($target, 'portal_row', $append);
					$this->tpl->set_var('output', '');
				}
			}
		}

		function set_var($varname, $value) {
			return $this->tpl->set_var($varname, $value);
		}
		
		function set_title($info='',$append=FALSE) {
			$info = $info ? $info : $this->title;
			if (is_array($info)) {
				$info_arr = $info;
				$this->parse($info_arr, 'title', 'align=center '.$this->title_class.' '.$this->title_extra, $append);
			} else if ($info) {
				$info_arr = array ('<b>'.$info.'</b>');
				$this->parse($info_arr, 'title', 'align=center ' . $this->title_class . ' ' . $this->title_extra . '  colspan=' . $this->num_col, $append); 
			}
		}
		function set_info($info,$append=FALSE) {
			if (is_array($info)) {
				$info_arr = $info;
				$this->parse($info_arr, 'info', $append);
			} else {
				$info_arr = array ('<font color=red><b>'.$info.'</b></font>');
				$this->parse($info_arr, 'info', 'colspan=' . $this->num_col, $append); 
			}
		}
		
		function draw() {
			$this->set_title();
			$this->tpl->pfp('out', 'portal_box');
		}
		
		function get_str() {
			$this->set_title();
			return $this->tpl->fp('out', 'portal_box');
		}
	}

	/*
	include 'class.template.inc.php';
	$path_theme = '../themes/default';
	$block = new block(
		array(
			'title' => 'Login Form',
			'width' => 200,
			'outer_class' => 'outer_class',
			'outer_extra' => 'bgcolor=black',
			'inner_class' => 'inner_class',
			'inner_extra' => 'bgcolor=white',
			'title_class' => 'title_class',
			'title_extra' => 'bgcolor=yellow',
			'num_col' => 4
		), $path_theme.'/block.html'
	);
	$block->set_info('error');
	$block->parse(
		array(
			'Username|:<input type=text name=user_name>',
			'Password|:<input type=password name=password>',
			'+<input type=submit value=Login>'
		)
	);
	$block->draw();
	*/
?>

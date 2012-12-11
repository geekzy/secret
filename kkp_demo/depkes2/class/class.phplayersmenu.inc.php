<?php


        if (class_exists('phplayersmenu')) {
                return 0;
        } else if (defined('CLASS_PHPLAYERSMENU')) {
                return 0;
        } else {
                define('CLASS_PHPLAYERSMENU', TRUE);
        }


class phplayersmenu {
	var $myDirPath = "phplayersmenu/";
	var $myWwwPath = "phplayersmenu/";
	var $mid;
	var $midPre;
	var $midHead;
	var $midMenu;
	var $midFoot;
	var $authType;

	function phplayersmenu() {
		$this->authType = 'table';
		$myDirPath = $this->myDirPath;
		$myWwwPath = $this->myWwwPath;
		$mid =& $this->mid;
		$midPre =& $this->midPre;
		
		if (file_exists($myDirPath)) {
			$midPre = 
			"<script src='{$myWwwPath}libjs/layersmenu-browser_detection.js' language='javascript' type='text/javascript'></script>\n".
			"<script src='{$myWwwPath}libjs/layersmenu-library.js' language='javascript' type='text/javascript'></script>\n".
			"<script src='{$myWwwPath}libjs/layersmenu.js' language='javascript' type='text/javascript'></script>\n".
			"<script src='{$myWwwPath}libjs/layerstreemenu-cookies.js' language='javascript' type='text/javascript'></script>\n";

			include_once ($myDirPath . "lib/PHPLIB.php");
			include_once ($myDirPath . "lib/layersmenu-common.inc.php");
			include_once ($myDirPath . "lib/layersmenu.inc.php");

			$mid = new LayersMenu(6, 7, 2, 1);	// Gtk2-like
			$mid->setDirroot($myDirPath);
			$mid->setImgwww($myWwwPath . "images/");
		} else {
			die('PHPLayersMenu Module not completed ('.$myWwwPath.').');
		}
	}

	function horizontalMenu($menustring,$themes='gtk') {
		$menustring = $this->scanDB($menustring);
		$mid = $this->mid;
		$myWwwPath = $this->myWwwPath;
		$midPre =& $this->midPre;
		$midHead =& $this->midHead;
		$midMenu =& $this->midMenu;
		$midFoot =& $this->midFoot;

		//$mid->setMenuStructureFile($myDirPath . "layersmenu-horizontal-1.txt");
		$mid->setMenuStructureString($menustring);
		$mid->parseStructureForMenu("hormenu1");
		
		switch ($themes) {
			case 'gtk':
				$midPre .= "<link href='{$myWwwPath}layersmenu-gtk2.css' rel='stylesheet' type='text/css'></link>\n";

				$mid->setHorizontalMenuTpl("layersmenu-horizontal_menu-full.ihtml");
				break;
			case 'keramik':
				$midPre .= "<link href='{$myWwwPath}layersmenu-keramik.css' rel='stylesheet' type='text/css'></link>\n";
				$mid->setHorizontalMenuTpl("layersmenu-horizontal_menu-keramik.ihtml");
				$mid->setSubMenuTpl("layersmenu-sub_menu-keramik.ihtml");
				break;
		}
		$mid->newHorizontalMenu("hormenu1");

		$midHead = $mid->makeHeader();
		$midMenu = $mid->getMenu("hormenu1");
		$midFoot = $mid->makeFooter();

	}

	function verticalMenu($menustring, $themes='gtk') {
		$menustring = $this->scanDB($menustring);
		$mid = $this->mid;
		$midHead =& $this->midHead;
		$midMenu =& $this->midMenu;
		$midFoot =& $this->midFoot;
		$midPre =& $this->midPre;
		$myWwwPath = $this->myWwwPath;
		
		//$mid->setMenuStructureFile("layersmenu-vertical-2.txt");
		$mid->setMenuStructureString($menustring);
		$mid->parseStructureForMenu("vermenu1");
		$mid->setDownArrowImg("down-gtk2.png");
		$mid->setForwardArrowImg("forward-gtk2.png");
		$mid->setVerticalMenuTpl("layersmenu-vertical_menu.ihtml");
		$mid->setSubMenuTpl("layersmenu-sub_menu.ihtml");
		$mid->newVerticalMenu("vermenu1");
		
		switch ($themes) {
			case 'gtk':
				$midPre .= "<link href='{$myWwwPath}layersmenu-gtk2.css' rel='stylesheet' type='text/css'></link>\n";

				$mid->setHorizontalMenuTpl("layersmenu-horizontal_menu-full.ihtml");
				break;
			case 'keramik':
				$midPre .= "<link href='{$myWwwPath}layersmenu-keramik.css' rel='stylesheet' type='text/css'></link>\n";
				$mid->setHorizontalMenuTpl("layersmenu-horizontal_menu-keramik.ihtml");
				$mid->setSubMenuTpl("layersmenu-sub_menu-keramik.ihtml");
				break;
		}
		$midHead = $mid->makeHeader();
		$midMenu = $mid->getMenu("vermenu1");
		$midFoot = $mid->makeFooter();
	
	}

	function scanDB_v01($menustring='') {
		global $adodb_type, $adodb_host, $adodb_user, $adodb_pass, $adodb_name;
		
		$type = $adodb_type;
		$user = $adodb_user;
		$pass = $adodb_pass;
		$host = $adodb_host;
		$db = $adodb_name;
		if (ereg('postgres', $type)) $type = 'pgsql';

		include_once ($myDirPath . "lib/layersmenu-process.inc.php");
		$midx = new ProcessLayersMenu();
		$midx->setDBConnParms("$type://$user:$pass@$host/$db");
		$midx->scanTableForMenu("vermenu1");
		$midx->setTableName("phplayersmenu");
		$midx->setTableFields(array(
			"id"            => "id",
			"parent_id"     => "parent_id",
			"text"          => "text",
			"href"          => "href",
			"title"         => "title",
			"icon"          => "icon",
			"target"        => "target",
			"orderfield"    => "orderfield",
			"expanded"      => "expanded"
		));
		$midx->setTableName_i18n("phplayersmenu_i18n");
		$midx->setTableFields_i18n(array(
			"language"      => "language",
			"id"            => "id",
			"text"          => "text",
			"title"         => "title"
		));
		$menuStructure = $midx->getMenuStructure("vermenu1");
		if (! empty($menuStructure)) {
			$menustring = $menuStructure;
		}

		return $menustring;
	}

	function scanDB($menustring='') {
		#$fd = fopen('actor/depkes2/menustr.txt', 'r');
		#$menustring = fread($fd, filesize('actor/depkes2/menustr.txt'));
		#fclose($fd);
		#return $menustring;
		
		global $adodb;
		$rs = $adodb->Execute("SELECT parent_id, id, text, href, title, icon, target FROM phplayersmenu WHERE hide=0 ORDER BY orderfield");
		$rParent = array();
		while ($rs && !$rs->EOF) {
			$parentID = $rs->fields[parent_id];
			$ID = $rs->fields[id];
			$rParent[$parentID][$ID] = $rs->fields;
			$rs->MoveNext();
		}
		
		$rs2 = $adodb->Execute("SELECT id, cat FROM phplayersmenu_cat");
		while ($rs2 && !$rs2->EOF) {
			$Id = $rs2->fields[id];
			$Cat = $rs2->fields[cat];
			$rCat[$Id][$Cat] = 1;
			$rs2->MoveNext();
		}

		$currLevel = 2;
		$Icon = '../../phplayersmenu/images/tree_folder_open.png';
		$qString = $_SERVER['QUERY_STRING'];
		$qString = ereg_replace("&plmOpen=[0-9]+", "", $qString);
		
		$Target = "left";
		
		$Href = str_replace("|", rawurlencode("|"), $_SERVER['PHP_SELF']."?".$qString);
		$menuStr = str_repeat(".", 1)."|Top-Level|$Href||$Icon|$Target\n";
		
		if ($_REQUEST['plmOpen']) {
			$notFound = true;
			$arrTree = array($_REQUEST['plmOpen']);
			$currLeaf = $_REQUEST['plmOpen'];
			while ($notFound) {
				$rs = $adodb->Execute("SELECT parent_id FROM phplayersmenu ".
				" WHERE id = '".$currLeaf."'");
				$arrTree[] = $rs->fields['parent_id'];
				$currLeaf = $rs->fields['parent_id'];
				if ($rs->fields['parent_id'] == 1) $notFound = false;
			}

			for ($i=count($arrTree)-1;$i>=1;$i--) {
				$Href = $_SERVER['PHP_SELF']."?".$qString."&plmOpen=".$arrTree[$i-1];
				$c = $rParent[$arrTree[$i]][$arrTree[$i-1]];
				#print_r($arrTree);
				#print_r($c);
				#exit;
				if ($i==1) $Href = '';
				$menuStr .= str_repeat(".", $currLevel++).
				"|".$c['text']."|"."$Href||$Icon|$Target\n";
			}

			$GLOBALS['maxLevel'] = $rLevel[$_REQUEST['plmOpen']] = $currLevel;
			$menuStr .= $this->getMenuStr($_REQUEST['plmOpen'],$currLevel,&$rParent,&$rCat, &$rLevel);
		} else {
			$GLOBALS['maxLevel'] = $rLevel[1] = $currLevel;
			$menuStr .= $this->getMenuStr(1,$currLevel,&$rParent,&$rCat, &$rLevel);
		}
		if (! empty($menuStr)) {
			$menustring = $menuStr;
		}
		
		return $menustring;
	}

	function getMenuStr($start=1, $level=1, $rParent, $rCat, $rLevel) {
                global $adodb, $_SESSION, $ses;
		
		// added by chimera
		if ($level>$GLOBALS['maxLevel']) return;
		
		
		foreach ($rParent[$start] as $key => $rsfields) {
			$Id = $key;
			$Text = $rsfields[text];
			$Href = $rsfields[href];
			$Title = $rsfields[title];
			$Icon = $rsfields[icon];
			$Target = $rsfields[target];
			
			if (is_array($rParent[$Id]) && count($rParent[$Id])) {
				$Icon = '../../phplayersmenu/images/tree_folder_closed.png';
				$qString = $_SERVER['QUERY_STRING'];
				$qString = ereg_replace("&plmOpen=[0-9]+", "", $qString);
				$Href = $_SERVER['PHP_SELF']."?".$qString."&plmOpen=".$Id;
				$Target = "left";
			}

			if ($this->authType=='table') {
				$userCat = $_SESSION[usertype];
			} else if ($this->authType=='user') {
				$userCat = $ses->loginid;
			}
			
			if ($rCat[$Id][$userCat]) {
				if ($rLevel[$start] || $level==1) {
					$rLevel[$Id] = $level;
				} else {
					$rLevel[$Id] = 1;
				}
		                $menuStr .= "".str_repeat(".", $rLevel[$Id]).
				"|$Text|$Href|$Title|$Icon|$Target\n";
			}
			
			$menuStr .= $this->getMenuStr($Id, $level+1, $rParent, $rCat, $rLevel);
                }
                return $menuStr;
        }

	

	function treeMenu($menustring, $themes='gtk') {
	
		$menustring = $this->scanDB($menustring);
		$midHead =& $this->midHead;
		$midMenu =& $this->midMenu;
		$midFoot =& $this->midFoot;
		$midPre =& $this->midPre;
		$myDirPath = $this->myDirPath;
		$myWwwPath = $this->myWwwPath;
		
		include_once ($myDirPath . "lib/treemenu.inc.php");
		$mid = new TreeMenu();
		$mid->setDirroot($myDirPath);
		$mid->setImgwww($myWwwPath . "images/");
		
		$mid->setMenuStructureString($menustring);
		$mid->parseStructureForMenu("treemenu1");
		$midMenu = $mid->newTreeMenu("treemenu1");
		
		$midPre .= "<link href='{$myWwwPath}layerstreemenu-hidden.css' rel='stylesheet' type='text/css'></link>\n";
		$midPre .= "<script src='{$myWwwPath}libjs/layersmenu-browser_detection.js' language='javascript' type='text/javascript'></script>\n";
	
	}

	function phpTreeMenu($menustring, $themes='gtk') {

		$menustring = $this->scanDB($menustring);

		$midHead =& $this->midHead;
		$midMenu =& $this->midMenu;
		$midFoot =& $this->midFoot;
		$midPre =& $this->midPre;
		$myDirPath = $this->myDirPath;
		$myWwwPath = $this->myWwwPath;

		include_once ($myDirPath . "lib/phptreemenu.inc.php");
		$mid = new PHPTreeMenu();
		$mid->setDirroot($myDirPath);
		$mid->setImgwww($myWwwPath . "images/");
		#$mid->setPHPTreeMenuDefaultExpansion("3|4|18");
		$mid->setMenuStructureString($menustring);
		$mid->parseStructureForMenu("treemenu2");
		$midMenu = $mid->newPHPTreeMenu("treemenu2");

	}

	function verticalPlainMenu($menustring, $themes='gtk') {

		$menustring = $this->scanDB($menustring);
		$myDirPath = $this->myDirPath;
		$myWwwPath = $this->myWwwPath;
		$midHead =& $this->midHead;
		$midMenu =& $this->midMenu;
		$midFoot =& $this->midFoot;
	
		include_once ($myDirPath . "lib/plainmenu.inc.php");
		$plainmid = new PlainMenu();
		$plainmid->setDirroot($myDirPath);
		$plainmid->setImgwww($myWwwPath . "images/");
							       
		$plainmid->setMenuStructureString($menustring);
		$plainmid->parseStructureForMenu("treemenu1");

		$midHead = '';
		$midMenu = $plainmid->newPlainMenu("treemenu1");
		$midFoot = '';
	}

	function horizontalPlainMenu($menustring, $themes='gtk') {

		$menustring = $this->scanDB($menustring);
		$myDirPath = $this->myDirPath;
		$myWwwPath = $this->myWwwPath;
		$midHead =& $this->midHead;
		$midMenu =& $this->midMenu;
		$midFoot =& $this->midFoot;
	
		include_once ($myDirPath . "lib/plainmenu.inc.php");
		$plainmid = new PlainMenu();
		$plainmid->setDirroot($myDirPath);
		$plainmid->setImgwww($myWwwPath . "images/");
							       
		$plainmid->setMenuStructureString($menustring);
		$plainmid->parseStructureForMenu("treemenu1");

		$midHead = '';
		$midMenu = $plainmid->newHorizontalPlainMenu("treemenu1");
		$midFoot = '';
	}

	function plainMenu($menustring, $themes='gtk') {
		$menustring = $this->scanDB($menustring);
		$this->verticalPlainMenu($menustring);
	}

}
?>

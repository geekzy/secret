<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_cicilaninfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "keu_laporan_keuanganinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_cicilan_list = new ckeu_cicilan_list();
$Page =& $keu_cicilan_list;

// Page init
$keu_cicilan_list->Page_Init();

// Page main
$keu_cicilan_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($keu_cicilan->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var keu_cicilan_list = new ew_Page("keu_cicilan_list");

// page properties
keu_cicilan_list.PageID = "list"; // page ID
keu_cicilan_list.FormID = "fkeu_cicilanlist"; // form ID
var EW_PAGE_ID = keu_cicilan_list.PageID; // for backward compatibility

// extend page with ValidateForm function
keu_cicilan_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_cicilan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_cicilan->cicilan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_cicilan"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_cicilan->cicilan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_pembayaran"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_cicilan->tanggal_pembayaran->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_pembayaran"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_cicilan->tanggal_pembayaran->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_rek_kas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_cicilan->rek_kas->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_rek_pendapatan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_cicilan->rek_pendapatan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kode_otomatis_master"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_cicilan->kode_otomatis_master->FldCaption()) ?>");

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
keu_cicilan_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_cicilan_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_cicilan_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<style type="text/css">

/* main table preview row color */
.ewTablePreviewRow {
	background-color: inherit; /* preview row */
}
</style>
<script language="JavaScript" type="text/javascript">
<!--

// PreviewRow extension
var ew_AjaxDetailsTimer = null;
var EW_PREVIEW_SINGLE_ROW = false;
var EW_PREVIEW_IMAGE_CLASSNAME = "ewPreviewRowImage";
var EW_PREVIEW_SHOW_IMAGE = "phpimages/expand.gif";
var EW_PREVIEW_HIDE_IMAGE = "phpimages/collapse.gif";
var EW_PREVIEW_LOADING_IMAGE = "phpimages/loading.gif";
var EW_PREVIEW_LOADING_TEXT = ewLanguage.Phrase("Loading"); // lang phrase for loading

// add row
function ew_AddRowToTable(r) {
	var row, cell;
	var tb = ewDom.getAncestorByTagName(r, "TBODY");
	if (EW_PREVIEW_SINGLE_ROW) {
		row = ewDom.getElementBy(function(node) { return ewDom.hasClass(node, EW_TABLE_PREVIEW_ROW_CLASSNAME)}, "TR", tb);
		ew_RemoveRowFromTable(row);
	}
	var sr = ewDom.getNextSiblingBy(r, function(node) { return node.tagName == "TR"});
	if (sr && ewDom.hasClass(sr, EW_TABLE_PREVIEW_ROW_CLASSNAME)) {
		row = sr; // existing sibling row
		if (row && row.cells && row.cells[0])
			cell = row.cells[0];
	} else {
		row = tb.insertRow(r.rowIndex); // new row
		if (row) {
			row.className = EW_TABLE_PREVIEW_ROW_CLASSNAME;
			var cell = row.insertCell(0);
			cell.style.borderRight = "0";
			var colcnt = r.cells.length;
			if (r.cells) {
				var spancnt = 0;
				for (var i = 0; i < colcnt; i++)
					spancnt += r.cells[i].colSpan;
				if (spancnt > 0)
					cell.colSpan = spancnt;
			}
			var pt = ewDom.getAncestorByTagName(row, "TABLE");
			if (pt) ew_SetupTable(pt);
		}
	}
	if (cell)
		cell.innerHTML = "<img src=\"" + EW_PREVIEW_LOADING_IMAGE + "\" style=\"border: 0; vertical-align: middle;\"> " + EW_PREVIEW_LOADING_TEXT;
	return row;
}

// remove row
function ew_RemoveRowFromTable(r) {
	if (r && r.parentNode)
		r.parentNode.removeChild(r);
}

// show results in new table row
var ew_AjaxHandleSuccess2 = function(o) {
	if (o.responseText !== undefined) {
		var row = o.argument.row;
		if (!row || !row.cells || !row.cells[0]) return;
		row.cells[0].innerHTML = o.responseText;
		var ct = ewDom.getElementBy(function(node) { return ewDom.hasClass(node, EW_TABLE_CLASS)}, "TABLE", row);
		if (ct) ew_SetupTable(ct);

		//clearTimeout(ew_AjaxDetailsTimer);
		//setTimeout("alert(ew_AjaxDetailsTimer);", 500);

	}
}

// show error in new table row
var ew_AjaxHandleFailure2 = function(o) {
	var row = o.argument.row;
	if (!row || !row.cells || !row.cells[0]) return;
	row.cells[0].innerHTML = o.responseText;
}

// show detail preview by table row expansion
function ew_AjaxShowDetails2(ev, link, url) {
	var img = ewDom.getElementBy(function(node) { return true; }, "IMG", link);
	var r = ewDom.getAncestorByTagName(link, "TR");
	if (!img || !r)
		return;
	var show = (img.src.substr(img.src.length - EW_PREVIEW_SHOW_IMAGE.length) == EW_PREVIEW_SHOW_IMAGE);
	if (show) {
		if (ew_AjaxDetailsTimer)
			clearTimeout(ew_AjaxDetailsTimer);		
		var row = ew_AddRowToTable(r);
		ew_AjaxDetailsTimer = setTimeout(function() { ewConnect.asyncRequest('GET', url, {success: ew_AjaxHandleSuccess2, failure: ew_AjaxHandleFailure2, argument:{id: link, row: row}}) }, 200);
		ewDom.getElementsByClassName(EW_PREVIEW_IMAGE_CLASSNAME, "IMG", r, function(node) {node.src = EW_PREVIEW_SHOW_IMAGE});
		img.src = EW_PREVIEW_HIDE_IMAGE;
	} else {	 
		var sr = ewDom.getNextSiblingBy(r, function(node) { return node.tagName == "TR"});
		if (sr && ewDom.hasClass(sr, EW_TABLE_PREVIEW_ROW_CLASSNAME))
			ew_RemoveRowFromTable(sr);
		img.src = EW_PREVIEW_SHOW_IMAGE;
	}
}

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($keu_cicilan->Export == "") || (EW_EXPORT_MASTER_RECORD && $keu_cicilan->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "keu_laporan_keuanganlist.php";
if ($keu_cicilan_list->DbMasterFilter <> "" && $keu_cicilan->getCurrentMasterTable() == "keu_laporan_keuangan") {
	if ($keu_cicilan_list->MasterRecordExists) {
		if ($keu_cicilan->getCurrentMasterTable() == $keu_cicilan->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $keu_laporan_keuangan->TableCaption() ?>
&nbsp;&nbsp;<?php $keu_cicilan_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($keu_cicilan->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "keu_laporan_keuanganmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$keu_cicilan_list->TotalRecs = $keu_cicilan->SelectRecordCount();
	} else {
		if ($keu_cicilan_list->Recordset = $keu_cicilan_list->LoadRecordset())
			$keu_cicilan_list->TotalRecs = $keu_cicilan_list->Recordset->RecordCount();
	}
	$keu_cicilan_list->StartRec = 1;
	if ($keu_cicilan_list->DisplayRecs <= 0 || ($keu_cicilan->Export <> "" && $keu_cicilan->ExportAll)) // Display all records
		$keu_cicilan_list->DisplayRecs = $keu_cicilan_list->TotalRecs;
	if (!($keu_cicilan->Export <> "" && $keu_cicilan->ExportAll))
		$keu_cicilan_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$keu_cicilan_list->Recordset = $keu_cicilan_list->LoadRecordset($keu_cicilan_list->StartRec-1, $keu_cicilan_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_cicilan->TableCaption() ?>
<?php if ($keu_cicilan->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;<?php $keu_cicilan_list->ExportOptions->Render("body"); ?>
<?php } ?>
</p>
<?php $keu_cicilan_list->ShowPageHeader(); ?>
<?php
$keu_cicilan_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($keu_cicilan->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($keu_cicilan->CurrentAction <> "gridadd" && $keu_cicilan->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($keu_cicilan_list->Pager)) $keu_cicilan_list->Pager = new cNumericPager($keu_cicilan_list->StartRec, $keu_cicilan_list->DisplayRecs, $keu_cicilan_list->TotalRecs, $keu_cicilan_list->RecRange) ?>
<?php if ($keu_cicilan_list->Pager->RecordCount > 0) { ?>
	<?php if ($keu_cicilan_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $keu_cicilan_list->PageUrl() ?>start=<?php echo $keu_cicilan_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_cicilan_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $keu_cicilan_list->PageUrl() ?>start=<?php echo $keu_cicilan_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($keu_cicilan_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $keu_cicilan_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($keu_cicilan_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $keu_cicilan_list->PageUrl() ?>start=<?php echo $keu_cicilan_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_cicilan_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $keu_cicilan_list->PageUrl() ?>start=<?php echo $keu_cicilan_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_cicilan_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $keu_cicilan_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $keu_cicilan_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $keu_cicilan_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($keu_cicilan_list->SearchWhere == "0=101") { ?>
	<?php echo $Language->Phrase("EnterSearchCriteria") ?>
	<?php } else { ?>
	<?php echo $Language->Phrase("NoRecord") ?>
	<?php } ?>
	<?php } else { ?>
	<?php echo $Language->Phrase("NoPermission") ?>
	<?php } ?>
<?php } ?>
</span>
		</td>
<?php if ($keu_cicilan_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="keu_cicilan">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($keu_cicilan_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($keu_cicilan_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($keu_cicilan_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($keu_cicilan_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($keu_cicilan_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($keu_cicilan_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($keu_cicilan_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($keu_cicilan_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($keu_cicilan_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $keu_cicilan_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fkeu_cicilanlist" id="fkeu_cicilanlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="keu_cicilan">
<div id="gmp_keu_cicilan" class="ewGridMiddlePanel">
<?php if ($keu_cicilan_list->TotalRecs > 0 || $keu_cicilan->CurrentAction == "add" || $keu_cicilan->CurrentAction == "copy") { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $keu_cicilan->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$keu_cicilan_list->RenderListOptions();

// Render list options (header, left)
$keu_cicilan_list->ListOptions->Render("header", "left");
?>
<?php if ($keu_cicilan->cicilan->Visible) { // cicilan ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->cicilan) == "") { ?>
		<td><?php echo $keu_cicilan->cicilan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_cicilan->SortUrl($keu_cicilan->cicilan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->cicilan->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->cicilan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->cicilan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->tanggal_pembayaran->Visible) { // tanggal_pembayaran ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->tanggal_pembayaran) == "") { ?>
		<td><?php echo $keu_cicilan->tanggal_pembayaran->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_cicilan->SortUrl($keu_cicilan->tanggal_pembayaran) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->tanggal_pembayaran->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->tanggal_pembayaran->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->tanggal_pembayaran->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->rek_kas->Visible) { // rek_kas ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->rek_kas) == "") { ?>
		<td><?php echo $keu_cicilan->rek_kas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_cicilan->SortUrl($keu_cicilan->rek_kas) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->rek_kas->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->rek_kas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->rek_kas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->rek_pendapatan->Visible) { // rek_pendapatan ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->rek_pendapatan) == "") { ?>
		<td><?php echo $keu_cicilan->rek_pendapatan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_cicilan->SortUrl($keu_cicilan->rek_pendapatan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->rek_pendapatan->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->rek_pendapatan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->rek_pendapatan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->kode_otomatis) == "") { ?>
		<td><?php echo $keu_cicilan->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_cicilan->SortUrl($keu_cicilan->kode_otomatis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->kode_otomatis_tanggungan->Visible) { // kode_otomatis_tanggungan ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->kode_otomatis_tanggungan) == "") { ?>
		<td><?php echo $keu_cicilan->kode_otomatis_tanggungan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_cicilan->SortUrl($keu_cicilan->kode_otomatis_tanggungan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->kode_otomatis_tanggungan->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->kode_otomatis_tanggungan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->kode_otomatis_tanggungan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->kode_otomatis_master->Visible) { // kode_otomatis_master ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->kode_otomatis_master) == "") { ?>
		<td><?php echo $keu_cicilan->kode_otomatis_master->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_cicilan->SortUrl($keu_cicilan->kode_otomatis_master) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->kode_otomatis_master->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->kode_otomatis_master->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->kode_otomatis_master->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$keu_cicilan_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
	if ($keu_cicilan->CurrentAction == "add" || $keu_cicilan->CurrentAction == "copy") {
		$keu_cicilan_list->RowIndex = 1;
		$keu_cicilan_list->KeyCount = $keu_cicilan_list->RowIndex;
		if ($keu_cicilan->CurrentAction == "add")
			$keu_cicilan_list->LoadDefaultValues();
		if ($keu_cicilan->EventCancelled) // Insert failed
			$keu_cicilan_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$keu_cicilan->ResetAttrs();
		$keu_cicilan->CssClass = "ewTableEditRow";
		$keu_cicilan->RowAttrs = array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($keu_cicilan_list->RowIndex))
			$keu_cicilan->RowAttrs = array_merge($keu_cicilan->RowAttrs, array('data-rowindex'=>$keu_cicilan_list->RowIndex, 'id'=>'r' . $keu_cicilan_list->RowIndex . '_keu_cicilan'));
		$keu_cicilan->RowType = EW_ROWTYPE_ADD;

		// Render row
		$keu_cicilan_list->RenderRow();

		// Render list options
		$keu_cicilan_list->RenderListOptions();
?>
	<tr<?php echo $keu_cicilan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$keu_cicilan_list->ListOptions->Render("body", "left");
?>
	<?php if ($keu_cicilan->cicilan->Visible) { // cicilan ?>
		<td>
<input type="text" name="x<?php echo $keu_cicilan_list->RowIndex ?>_cicilan" id="x<?php echo $keu_cicilan_list->RowIndex ?>_cicilan" size="30" value="<?php echo $keu_cicilan->cicilan->EditValue ?>"<?php echo $keu_cicilan->cicilan->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $keu_cicilan_list->RowIndex ?>_cicilan" id="o<?php echo $keu_cicilan_list->RowIndex ?>_cicilan" value="<?php echo ew_HtmlEncode($keu_cicilan->cicilan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($keu_cicilan->tanggal_pembayaran->Visible) { // tanggal_pembayaran ?>
		<td>
<input type="text" name="x<?php echo $keu_cicilan_list->RowIndex ?>_tanggal_pembayaran" id="x<?php echo $keu_cicilan_list->RowIndex ?>_tanggal_pembayaran" value="<?php echo $keu_cicilan->tanggal_pembayaran->EditValue ?>"<?php echo $keu_cicilan->tanggal_pembayaran->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $keu_cicilan_list->RowIndex ?>_tanggal_pembayaran" name="cal_x<?php echo $keu_cicilan_list->RowIndex ?>_tanggal_pembayaran" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $keu_cicilan_list->RowIndex ?>_tanggal_pembayaran", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $keu_cicilan_list->RowIndex ?>_tanggal_pembayaran" // button id
});
</script>
<input type="hidden" name="o<?php echo $keu_cicilan_list->RowIndex ?>_tanggal_pembayaran" id="o<?php echo $keu_cicilan_list->RowIndex ?>_tanggal_pembayaran" value="<?php echo ew_HtmlEncode($keu_cicilan->tanggal_pembayaran->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($keu_cicilan->rek_kas->Visible) { // rek_kas ?>
		<td>
<select id="x<?php echo $keu_cicilan_list->RowIndex ?>_rek_kas" name="x<?php echo $keu_cicilan_list->RowIndex ?>_rek_kas"<?php echo $keu_cicilan->rek_kas->EditAttributes() ?>>
<?php
if (is_array($keu_cicilan->rek_kas->EditValue)) {
	$arwrk = $keu_cicilan->rek_kas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_cicilan->rek_kas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$keu_cicilan->rek_kas) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<input type="hidden" name="o<?php echo $keu_cicilan_list->RowIndex ?>_rek_kas" id="o<?php echo $keu_cicilan_list->RowIndex ?>_rek_kas" value="<?php echo ew_HtmlEncode($keu_cicilan->rek_kas->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($keu_cicilan->rek_pendapatan->Visible) { // rek_pendapatan ?>
		<td>
<select id="x<?php echo $keu_cicilan_list->RowIndex ?>_rek_pendapatan" name="x<?php echo $keu_cicilan_list->RowIndex ?>_rek_pendapatan"<?php echo $keu_cicilan->rek_pendapatan->EditAttributes() ?>>
<?php
if (is_array($keu_cicilan->rek_pendapatan->EditValue)) {
	$arwrk = $keu_cicilan->rek_pendapatan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_cicilan->rek_pendapatan->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$keu_cicilan->rek_pendapatan) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<input type="hidden" name="o<?php echo $keu_cicilan_list->RowIndex ?>_rek_pendapatan" id="o<?php echo $keu_cicilan_list->RowIndex ?>_rek_pendapatan" value="<?php echo ew_HtmlEncode($keu_cicilan->rek_pendapatan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis ?>
		<td>
<input type="hidden" name="x<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis" id="x<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis" id="o<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis_tanggungan->Visible) { // kode_otomatis_tanggungan ?>
		<td>
<?php if ($keu_cicilan->kode_otomatis_tanggungan->getSessionValue() <> "") { ?>
<input type="hidden" id="x<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis_tanggungan" name="x<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis_tanggungan" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis_tanggungan" id="x<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis_tanggungan" size="30" maxlength="50" value="<?php echo $keu_cicilan->kode_otomatis_tanggungan->EditValue ?>"<?php echo $keu_cicilan->kode_otomatis_tanggungan->EditAttributes() ?>>
<?php } ?>
<input type="hidden" name="o<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis_tanggungan" id="o<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis_tanggungan" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis_master->Visible) { // kode_otomatis_master ?>
		<td>
<input type="text" name="x<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis_master" id="x<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis_master" size="30" maxlength="50" value="<?php echo $keu_cicilan->kode_otomatis_master->EditValue ?>"<?php echo $keu_cicilan->kode_otomatis_master->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis_master" id="o<?php echo $keu_cicilan_list->RowIndex ?>_kode_otomatis_master" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_master->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$keu_cicilan_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
<?php
if ($keu_cicilan->ExportAll && $keu_cicilan->Export <> "") {
	$keu_cicilan_list->StopRec = $keu_cicilan_list->TotalRecs;
} else {

	// Set the last record to display
	if ($keu_cicilan_list->TotalRecs > $keu_cicilan_list->StartRec + $keu_cicilan_list->DisplayRecs - 1)
		$keu_cicilan_list->StopRec = $keu_cicilan_list->StartRec + $keu_cicilan_list->DisplayRecs - 1;
	else
		$keu_cicilan_list->StopRec = $keu_cicilan_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($keu_cicilan->CurrentAction == "gridadd" || $keu_cicilan->CurrentAction == "gridedit" || $keu_cicilan->CurrentAction == "F")) {
		$keu_cicilan_list->KeyCount = $objForm->GetValue("key_count");
		$keu_cicilan_list->StopRec = $keu_cicilan_list->KeyCount;
	}
}
$keu_cicilan_list->RecCnt = $keu_cicilan_list->StartRec - 1;
if ($keu_cicilan_list->Recordset && !$keu_cicilan_list->Recordset->EOF) {
	$keu_cicilan_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $keu_cicilan_list->StartRec > 1)
		$keu_cicilan_list->Recordset->Move($keu_cicilan_list->StartRec - 1);
} elseif (!$keu_cicilan->AllowAddDeleteRow && $keu_cicilan_list->StopRec == 0) {
	$keu_cicilan_list->StopRec = $keu_cicilan->GridAddRowCount;
}

// Initialize aggregate
$keu_cicilan->RowType = EW_ROWTYPE_AGGREGATEINIT;
$keu_cicilan->ResetAttrs();
$keu_cicilan_list->RenderRow();
$keu_cicilan_list->RowCnt = 0;
while ($keu_cicilan_list->RecCnt < $keu_cicilan_list->StopRec) {
	$keu_cicilan_list->RecCnt++;
	if (intval($keu_cicilan_list->RecCnt) >= intval($keu_cicilan_list->StartRec)) {
		$keu_cicilan_list->RowCnt++;

		// Set up key count
		$keu_cicilan_list->KeyCount = $keu_cicilan_list->RowIndex;

		// Init row class and style
		$keu_cicilan->ResetAttrs();
		$keu_cicilan->CssClass = "";
		if ($keu_cicilan->CurrentAction == "gridadd") {
			$keu_cicilan_list->LoadDefaultValues(); // Load default values
		} else {
			$keu_cicilan_list->LoadRowValues($keu_cicilan_list->Recordset); // Load row values
		}
		$keu_cicilan->RowType = EW_ROWTYPE_VIEW; // Render view
		$keu_cicilan->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$keu_cicilan_list->RenderRow();

		// Render list options
		$keu_cicilan_list->RenderListOptions();
?>
	<tr<?php echo $keu_cicilan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$keu_cicilan_list->ListOptions->Render("body", "left");
?>
	<?php if ($keu_cicilan->cicilan->Visible) { // cicilan ?>
		<td<?php echo $keu_cicilan->cicilan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->cicilan->ViewAttributes() ?>><?php echo $keu_cicilan->cicilan->ListViewValue() ?></div>
<a name="<?php echo $keu_cicilan_list->PageObjName . "_row_" . $keu_cicilan_list->RowCnt ?>" id="<?php echo $keu_cicilan_list->PageObjName . "_row_" . $keu_cicilan_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($keu_cicilan->tanggal_pembayaran->Visible) { // tanggal_pembayaran ?>
		<td<?php echo $keu_cicilan->tanggal_pembayaran->CellAttributes() ?>>
<div<?php echo $keu_cicilan->tanggal_pembayaran->ViewAttributes() ?>><?php echo $keu_cicilan->tanggal_pembayaran->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->rek_kas->Visible) { // rek_kas ?>
		<td<?php echo $keu_cicilan->rek_kas->CellAttributes() ?>>
<div<?php echo $keu_cicilan->rek_kas->ViewAttributes() ?>><?php echo $keu_cicilan->rek_kas->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->rek_pendapatan->Visible) { // rek_pendapatan ?>
		<td<?php echo $keu_cicilan->rek_pendapatan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->rek_pendapatan->ViewAttributes() ?>><?php echo $keu_cicilan->rek_pendapatan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $keu_cicilan->kode_otomatis->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis_tanggungan->Visible) { // kode_otomatis_tanggungan ?>
		<td<?php echo $keu_cicilan->kode_otomatis_tanggungan->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis_tanggungan->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_tanggungan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis_master->Visible) { // kode_otomatis_master ?>
		<td<?php echo $keu_cicilan->kode_otomatis_master->CellAttributes() ?>>
<div<?php echo $keu_cicilan->kode_otomatis_master->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_master->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$keu_cicilan_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($keu_cicilan->CurrentAction <> "gridadd")
		$keu_cicilan_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($keu_cicilan->CurrentAction == "add" || $keu_cicilan->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $keu_cicilan_list->KeyCount ?>">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($keu_cicilan_list->Recordset)
	$keu_cicilan_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($keu_cicilan->Export == "" && $keu_cicilan->CurrentAction == "") { ?>
<?php } ?>
<?php
$keu_cicilan_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($keu_cicilan->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$keu_cicilan_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_cicilan_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'keu_cicilan';

	// Page object name
	var $PageObjName = 'keu_cicilan_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_cicilan;
		if ($keu_cicilan->UseTokenInUrl) $PageUrl .= "t=" . $keu_cicilan->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $keu_cicilan;
		if ($keu_cicilan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_cicilan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_cicilan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_cicilan_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_cicilan)
		if (!isset($GLOBALS["keu_cicilan"])) {
			$GLOBALS["keu_cicilan"] = new ckeu_cicilan();
			$GLOBALS["Table"] =& $GLOBALS["keu_cicilan"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "keu_cicilanadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "keu_cicilandelete.php";
		$this->MultiUpdateUrl = "keu_cicilanupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (keu_laporan_keuangan)
		if (!isset($GLOBALS['keu_laporan_keuangan'])) $GLOBALS['keu_laporan_keuangan'] = new ckeu_laporan_keuangan();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_cicilan', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $keu_cicilan;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$keu_cicilan->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $keu_cicilan;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$keu_cicilan->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($keu_cicilan->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline add mode
				if ($keu_cicilan->CurrentAction == "add" || $keu_cicilan->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$keu_cicilan->CurrentAction = $_POST["a_list"]; // Get action

					// Insert Inline
					if ($keu_cicilan->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Hide all options
			if ($keu_cicilan->Export <> "" ||
				$keu_cicilan->CurrentAction == "gridadd" ||
				$keu_cicilan->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($keu_cicilan->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $keu_cicilan->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $keu_cicilan->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $keu_cicilan->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($keu_cicilan->getMasterFilter() <> "" && $keu_cicilan->getCurrentMasterTable() == "keu_laporan_keuangan") {
			global $keu_laporan_keuangan;
			$rsmaster = $keu_laporan_keuangan->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($keu_cicilan->getReturnUrl()); // Return to caller
			} else {
				$keu_laporan_keuangan->LoadListRowValues($rsmaster);
				$keu_laporan_keuangan->RowType = EW_ROWTYPE_MASTER; // Master row
				$keu_laporan_keuangan->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$keu_cicilan->setSessionWhere($sFilter);
		$keu_cicilan->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $keu_cicilan;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 20; // Non-numeric, load default
				}
			}
			$keu_cicilan->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $keu_cicilan;
		$keu_cicilan->LastAction = $keu_cicilan->CurrentAction; // Save last action
		$keu_cicilan->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $keu_cicilan;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$keu_cicilan->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError, $keu_cicilan;
		$this->LoadOldRecord(); // Load old recordset
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setFailureMessage($gsFormError); // Set validation error message
			$keu_cicilan->EventCancelled = TRUE; // Set event cancelled
			$keu_cicilan->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$keu_cicilan->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow($this->OldRecordset)) { // Add record
			$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$keu_cicilan->EventCancelled = TRUE; // Set event cancelled
			$keu_cicilan->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $keu_cicilan;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$keu_cicilan->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$keu_cicilan->CurrentOrderType = @$_GET["ordertype"];
			$keu_cicilan->UpdateSort($keu_cicilan->cicilan); // cicilan
			$keu_cicilan->UpdateSort($keu_cicilan->tanggal_pembayaran); // tanggal_pembayaran
			$keu_cicilan->UpdateSort($keu_cicilan->rek_kas); // rek_kas
			$keu_cicilan->UpdateSort($keu_cicilan->rek_pendapatan); // rek_pendapatan
			$keu_cicilan->UpdateSort($keu_cicilan->kode_otomatis); // kode_otomatis
			$keu_cicilan->UpdateSort($keu_cicilan->kode_otomatis_tanggungan); // kode_otomatis_tanggungan
			$keu_cicilan->UpdateSort($keu_cicilan->kode_otomatis_master); // kode_otomatis_master
			$keu_cicilan->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $keu_cicilan;
		$sOrderBy = $keu_cicilan->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($keu_cicilan->SqlOrderBy() <> "") {
				$sOrderBy = $keu_cicilan->SqlOrderBy();
				$keu_cicilan->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $keu_cicilan;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$keu_cicilan->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$keu_cicilan->kode_otomatis_tanggungan->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$keu_cicilan->setSessionOrderBy($sOrderBy);
				$keu_cicilan->cicilan->setSort("");
				$keu_cicilan->tanggal_pembayaran->setSort("");
				$keu_cicilan->rek_kas->setSort("");
				$keu_cicilan->rek_pendapatan->setSort("");
				$keu_cicilan->kode_otomatis->setSort("");
				$keu_cicilan->kode_otomatis_tanggungan->setSort("");
				$keu_cicilan->kode_otomatis_master->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $keu_cicilan;

		// "copy"
		$item =& $this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd() && ($keu_cicilan->CurrentAction == "add");
		$item->OnLeft = TRUE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = TRUE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $keu_cicilan, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if ($keu_cicilan->RowType == EW_ROWTYPE_ADD)
			$this->RowAction = "insert";
		else
			$this->RowAction = "";
		if (is_numeric($this->RowIndex)) {
			$objForm->Index = $this->RowIndex;
			if ($objForm->HasValue("k_action"))
				$this->RowAction = strval($objForm->GetValue("k_action"));
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_action\" id=\"k" . $this->RowIndex . "_action\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue("k_key");
				$this->SetupKeyValues($rowkey);
			}
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if (($keu_cicilan->CurrentAction == "add" || $keu_cicilan->CurrentAction == "copy") &&
			$keu_cicilan->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a class=\"ewGridLink\" href=\"\" onclick=\"return ew_SubmitForm(keu_cicilan_list, document.fkeu_cicilanlist);\">" . "<img src=\"phpimages/insert.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("InsertLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("InsertLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>&nbsp;" .
				"<a class=\"ewGridLink\" href=\"" . $this->PageUrl() . "a=cancel\">" . "<img src=\"phpimages/cancel.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("CancelLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("CancelLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $keu_cicilan;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $keu_cicilan;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$keu_cicilan->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$keu_cicilan->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $keu_cicilan->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$keu_cicilan->setStartRecordNumber($this->StartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $keu_cicilan;
		$keu_cicilan->cicilan->CurrentValue = isi_cicilan();
		$keu_cicilan->tanggal_pembayaran->CurrentValue = ew_CurrentDate();
		$keu_cicilan->rek_kas->CurrentValue = NULL;
		$keu_cicilan->rek_kas->OldValue = $keu_cicilan->rek_kas->CurrentValue;
		$keu_cicilan->rek_pendapatan->CurrentValue = NULL;
		$keu_cicilan->rek_pendapatan->OldValue = $keu_cicilan->rek_pendapatan->CurrentValue;
		$keu_cicilan->kode_otomatis->CurrentValue = unik();
		$keu_cicilan->kode_otomatis_tanggungan->CurrentValue = NULL;
		$keu_cicilan->kode_otomatis_tanggungan->OldValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
		$keu_cicilan->kode_otomatis_master->CurrentValue = "-";
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $keu_cicilan;
		if (!$keu_cicilan->cicilan->FldIsDetailKey) {
			$keu_cicilan->cicilan->setFormValue($objForm->GetValue("x_cicilan"));
		}
		if (!$keu_cicilan->tanggal_pembayaran->FldIsDetailKey) {
			$keu_cicilan->tanggal_pembayaran->setFormValue($objForm->GetValue("x_tanggal_pembayaran"));
			$keu_cicilan->tanggal_pembayaran->CurrentValue = ew_UnFormatDateTime($keu_cicilan->tanggal_pembayaran->CurrentValue, 7);
		}
		if (!$keu_cicilan->rek_kas->FldIsDetailKey) {
			$keu_cicilan->rek_kas->setFormValue($objForm->GetValue("x_rek_kas"));
		}
		if (!$keu_cicilan->rek_pendapatan->FldIsDetailKey) {
			$keu_cicilan->rek_pendapatan->setFormValue($objForm->GetValue("x_rek_pendapatan"));
		}
		if (!$keu_cicilan->kode_otomatis->FldIsDetailKey) {
			$keu_cicilan->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		if (!$keu_cicilan->kode_otomatis_tanggungan->FldIsDetailKey) {
			$keu_cicilan->kode_otomatis_tanggungan->setFormValue($objForm->GetValue("x_kode_otomatis_tanggungan"));
		}
		if (!$keu_cicilan->kode_otomatis_master->FldIsDetailKey) {
			$keu_cicilan->kode_otomatis_master->setFormValue($objForm->GetValue("x_kode_otomatis_master"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $keu_cicilan;
		$keu_cicilan->cicilan->CurrentValue = $keu_cicilan->cicilan->FormValue;
		$keu_cicilan->tanggal_pembayaran->CurrentValue = $keu_cicilan->tanggal_pembayaran->FormValue;
		$keu_cicilan->tanggal_pembayaran->CurrentValue = ew_UnFormatDateTime($keu_cicilan->tanggal_pembayaran->CurrentValue, 7);
		$keu_cicilan->rek_kas->CurrentValue = $keu_cicilan->rek_kas->FormValue;
		$keu_cicilan->rek_pendapatan->CurrentValue = $keu_cicilan->rek_pendapatan->FormValue;
		$keu_cicilan->kode_otomatis->CurrentValue = $keu_cicilan->kode_otomatis->FormValue;
		$keu_cicilan->kode_otomatis_tanggungan->CurrentValue = $keu_cicilan->kode_otomatis_tanggungan->FormValue;
		$keu_cicilan->kode_otomatis_master->CurrentValue = $keu_cicilan->kode_otomatis_master->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $keu_cicilan;

		// Call Recordset Selecting event
		$keu_cicilan->Recordset_Selecting($keu_cicilan->CurrentFilter);

		// Load List page SQL
		$sSql = $keu_cicilan->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$keu_cicilan->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_cicilan;
		$sFilter = $keu_cicilan->KeyFilter();

		// Call Row Selecting event
		$keu_cicilan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_cicilan->CurrentFilter = $sFilter;
		$sSql = $keu_cicilan->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $keu_cicilan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_cicilan->Row_Selected($row);
		$keu_cicilan->cicilan->setDbValue($rs->fields('cicilan'));
		$keu_cicilan->tanggal_pembayaran->setDbValue($rs->fields('tanggal_pembayaran'));
		$keu_cicilan->rek_kas->setDbValue($rs->fields('rek_kas'));
		$keu_cicilan->rek_pendapatan->setDbValue($rs->fields('rek_pendapatan'));
		$keu_cicilan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_cicilan->kode_otomatis_tanggungan->setDbValue($rs->fields('kode_otomatis_tanggungan'));
		$keu_cicilan->kode_otomatis_master->setDbValue($rs->fields('kode_otomatis_master'));
	}

	// Load old record
	function LoadOldRecord() {
		global $keu_cicilan;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($keu_cicilan->getKey("kode_otomatis")) <> "")
			$keu_cicilan->kode_otomatis->CurrentValue = $keu_cicilan->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$keu_cicilan->CurrentFilter = $keu_cicilan->KeyFilter();
			$sSql = $keu_cicilan->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_cicilan;

		// Initialize URLs
		$this->ViewUrl = $keu_cicilan->ViewUrl();
		$this->EditUrl = $keu_cicilan->EditUrl();
		$this->InlineEditUrl = $keu_cicilan->InlineEditUrl();
		$this->CopyUrl = $keu_cicilan->CopyUrl();
		$this->InlineCopyUrl = $keu_cicilan->InlineCopyUrl();
		$this->DeleteUrl = $keu_cicilan->DeleteUrl();

		// Call Row_Rendering event
		$keu_cicilan->Row_Rendering();

		// Common render codes for all row types
		// cicilan
		// tanggal_pembayaran
		// rek_kas
		// rek_pendapatan
		// kode_otomatis
		// kode_otomatis_tanggungan
		// kode_otomatis_master

		if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View row

			// cicilan
			$keu_cicilan->cicilan->ViewValue = $keu_cicilan->cicilan->CurrentValue;
			$keu_cicilan->cicilan->ViewCustomAttributes = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->ViewValue = $keu_cicilan->tanggal_pembayaran->CurrentValue;
			$keu_cicilan->tanggal_pembayaran->ViewValue = ew_FormatDateTime($keu_cicilan->tanggal_pembayaran->ViewValue, 7);
			$keu_cicilan->tanggal_pembayaran->ViewCustomAttributes = "";

			// rek_kas
			if (strval($keu_cicilan->rek_kas->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_cicilan->rek_kas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='1' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_cicilan->rek_kas->ViewValue = $rswrk->fields('Norek');
					$keu_cicilan->rek_kas->ViewValue .= ew_ValueSeparator(0,1,$keu_cicilan->rek_kas) . $rswrk->fields('Keterangan');
					$rswrk->Close();
				} else {
					$keu_cicilan->rek_kas->ViewValue = $keu_cicilan->rek_kas->CurrentValue;
				}
			} else {
				$keu_cicilan->rek_kas->ViewValue = NULL;
			}
			$keu_cicilan->rek_kas->ViewCustomAttributes = "";

			// rek_pendapatan
			if (strval($keu_cicilan->rek_pendapatan->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_cicilan->rek_pendapatan->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='4' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_cicilan->rek_pendapatan->ViewValue = $rswrk->fields('Norek');
					$keu_cicilan->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,1,$keu_cicilan->rek_pendapatan) . $rswrk->fields('Keterangan');
					$rswrk->Close();
				} else {
					$keu_cicilan->rek_pendapatan->ViewValue = $keu_cicilan->rek_pendapatan->CurrentValue;
				}
			} else {
				$keu_cicilan->rek_pendapatan->ViewValue = NULL;
			}
			$keu_cicilan->rek_pendapatan->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->ViewValue = $keu_cicilan->kode_otomatis->CurrentValue;
			$keu_cicilan->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->ViewValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
			$keu_cicilan->kode_otomatis_tanggungan->ViewCustomAttributes = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->ViewValue = $keu_cicilan->kode_otomatis_master->CurrentValue;
			$keu_cicilan->kode_otomatis_master->ViewCustomAttributes = "";

			// cicilan
			$keu_cicilan->cicilan->LinkCustomAttributes = "";
			$keu_cicilan->cicilan->HrefValue = "";
			$keu_cicilan->cicilan->TooltipValue = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->LinkCustomAttributes = "";
			$keu_cicilan->tanggal_pembayaran->HrefValue = "";
			$keu_cicilan->tanggal_pembayaran->TooltipValue = "";

			// rek_kas
			$keu_cicilan->rek_kas->LinkCustomAttributes = "";
			$keu_cicilan->rek_kas->HrefValue = "";
			$keu_cicilan->rek_kas->TooltipValue = "";

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->LinkCustomAttributes = "";
			$keu_cicilan->rek_pendapatan->HrefValue = "";
			$keu_cicilan->rek_pendapatan->TooltipValue = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis->HrefValue = "";
			$keu_cicilan->kode_otomatis->TooltipValue = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis_tanggungan->HrefValue = "";
			$keu_cicilan->kode_otomatis_tanggungan->TooltipValue = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->LinkCustomAttributes = "";
			$keu_cicilan->kode_otomatis_master->HrefValue = "";
			$keu_cicilan->kode_otomatis_master->TooltipValue = "";
		} elseif ($keu_cicilan->RowType == EW_ROWTYPE_ADD) { // Add row

			// cicilan
			$keu_cicilan->cicilan->EditCustomAttributes = "";
			$keu_cicilan->cicilan->EditValue = ew_HtmlEncode($keu_cicilan->cicilan->CurrentValue);

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->EditCustomAttributes = "";
			$keu_cicilan->tanggal_pembayaran->EditValue = ew_HtmlEncode(ew_FormatDateTime($keu_cicilan->tanggal_pembayaran->CurrentValue, 7));

			// rek_kas
			$keu_cicilan->rek_kas->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Norek`, `Norek` AS `DispFld`, `Keterangan` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='1' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$keu_cicilan->rek_kas->EditValue = $arwrk;

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Norek`, `Norek` AS `DispFld`, `Keterangan` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `rekening2`";
			$sWhereWrk = "";
			$lookuptblfilter = " kodePokok='4' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$keu_cicilan->rek_pendapatan->EditValue = $arwrk;

			// kode_otomatis
			$keu_cicilan->kode_otomatis->EditCustomAttributes = "";
			$keu_cicilan->kode_otomatis->CurrentValue = unik();

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->EditCustomAttributes = "";
			if ($keu_cicilan->kode_otomatis_tanggungan->getSessionValue() <> "") {
				$keu_cicilan->kode_otomatis_tanggungan->CurrentValue = $keu_cicilan->kode_otomatis_tanggungan->getSessionValue();
			$keu_cicilan->kode_otomatis_tanggungan->ViewValue = $keu_cicilan->kode_otomatis_tanggungan->CurrentValue;
			$keu_cicilan->kode_otomatis_tanggungan->ViewCustomAttributes = "";
			} else {
			$keu_cicilan->kode_otomatis_tanggungan->EditValue = ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->CurrentValue);
			}

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->EditCustomAttributes = "";
			$keu_cicilan->kode_otomatis_master->EditValue = ew_HtmlEncode($keu_cicilan->kode_otomatis_master->CurrentValue);

			// Edit refer script
			// cicilan

			$keu_cicilan->cicilan->HrefValue = "";

			// tanggal_pembayaran
			$keu_cicilan->tanggal_pembayaran->HrefValue = "";

			// rek_kas
			$keu_cicilan->rek_kas->HrefValue = "";

			// rek_pendapatan
			$keu_cicilan->rek_pendapatan->HrefValue = "";

			// kode_otomatis
			$keu_cicilan->kode_otomatis->HrefValue = "";

			// kode_otomatis_tanggungan
			$keu_cicilan->kode_otomatis_tanggungan->HrefValue = "";

			// kode_otomatis_master
			$keu_cicilan->kode_otomatis_master->HrefValue = "";
		}
		if ($keu_cicilan->RowType == EW_ROWTYPE_ADD ||
			$keu_cicilan->RowType == EW_ROWTYPE_EDIT ||
			$keu_cicilan->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$keu_cicilan->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($keu_cicilan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_cicilan->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $keu_cicilan;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($keu_cicilan->cicilan->FormValue) && $keu_cicilan->cicilan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_cicilan->cicilan->FldCaption());
		}
		if (!ew_CheckNumber($keu_cicilan->cicilan->FormValue)) {
			ew_AddMessage($gsFormError, $keu_cicilan->cicilan->FldErrMsg());
		}
		if (!is_null($keu_cicilan->tanggal_pembayaran->FormValue) && $keu_cicilan->tanggal_pembayaran->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_cicilan->tanggal_pembayaran->FldCaption());
		}
		if (!ew_CheckEuroDate($keu_cicilan->tanggal_pembayaran->FormValue)) {
			ew_AddMessage($gsFormError, $keu_cicilan->tanggal_pembayaran->FldErrMsg());
		}
		if (!is_null($keu_cicilan->rek_kas->FormValue) && $keu_cicilan->rek_kas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_cicilan->rek_kas->FldCaption());
		}
		if (!is_null($keu_cicilan->rek_pendapatan->FormValue) && $keu_cicilan->rek_pendapatan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_cicilan->rek_pendapatan->FldCaption());
		}
		if (!is_null($keu_cicilan->kode_otomatis_master->FormValue) && $keu_cicilan->kode_otomatis_master->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_cicilan->kode_otomatis_master->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $keu_cicilan;

		// Check if key value entered
		if ($keu_cicilan->kode_otomatis->CurrentValue == "" && $keu_cicilan->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $keu_cicilan->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $keu_cicilan->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($keu_cicilan->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($keu_cicilan->kode_otomatis->CurrentValue) . "')";
			$rsChk = $keu_cicilan->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $keu_cicilan->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// cicilan
		$keu_cicilan->cicilan->SetDbValueDef($rsnew, $keu_cicilan->cicilan->CurrentValue, 0, strval($keu_cicilan->cicilan->CurrentValue) == "");

		// tanggal_pembayaran
		$keu_cicilan->tanggal_pembayaran->SetDbValueDef($rsnew, ew_UnFormatDateTime($keu_cicilan->tanggal_pembayaran->CurrentValue, 7), ew_CurrentDate(), strval($keu_cicilan->tanggal_pembayaran->CurrentValue) == "");

		// rek_kas
		$keu_cicilan->rek_kas->SetDbValueDef($rsnew, $keu_cicilan->rek_kas->CurrentValue, "", strval($keu_cicilan->rek_kas->CurrentValue) == "");

		// rek_pendapatan
		$keu_cicilan->rek_pendapatan->SetDbValueDef($rsnew, $keu_cicilan->rek_pendapatan->CurrentValue, "", strval($keu_cicilan->rek_pendapatan->CurrentValue) == "");

		// kode_otomatis
		$keu_cicilan->kode_otomatis->SetDbValueDef($rsnew, $keu_cicilan->kode_otomatis->CurrentValue, "", FALSE);

		// kode_otomatis_tanggungan
		$keu_cicilan->kode_otomatis_tanggungan->SetDbValueDef($rsnew, $keu_cicilan->kode_otomatis_tanggungan->CurrentValue, "", FALSE);

		// kode_otomatis_master
		$keu_cicilan->kode_otomatis_master->SetDbValueDef($rsnew, $keu_cicilan->kode_otomatis_master->CurrentValue, "", strval($keu_cicilan->kode_otomatis_master->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $keu_cicilan->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($keu_cicilan->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($keu_cicilan->CancelMessage <> "") {
				$this->setFailureMessage($keu_cicilan->CancelMessage);
				$keu_cicilan->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$keu_cicilan->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $keu_cicilan;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "keu_laporan_keuangan") {
				$bValidMaster = TRUE;
				if (@$_GET["kode_otomatis"] <> "") {
					$GLOBALS["keu_laporan_keuangan"]->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
					$keu_cicilan->kode_otomatis_tanggungan->setQueryStringValue($GLOBALS["keu_laporan_keuangan"]->kode_otomatis->QueryStringValue);
					$keu_cicilan->kode_otomatis_tanggungan->setSessionValue($keu_cicilan->kode_otomatis_tanggungan->QueryStringValue);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$keu_cicilan->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$keu_cicilan->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "keu_laporan_keuangan") {
				if ($keu_cicilan->kode_otomatis_tanggungan->QueryStringValue == "") $keu_cicilan->kode_otomatis_tanggungan->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $keu_cicilan->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $keu_cicilan->getDetailFilter(); // Get detail filter
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
	}

		// Page Load event
	function Page_Load() {

		//echo "Page Load";        
		global $Language;
		$Language->setPhrase("InlineAddLink","Entri Cicilan Baru"); 
	}  

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>

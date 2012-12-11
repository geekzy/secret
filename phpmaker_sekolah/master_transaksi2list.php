<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "master_transaksi2info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "rekeningjuinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$master_transaksi2_list = new cmaster_transaksi2_list();
$Page =& $master_transaksi2_list;

// Page init
$master_transaksi2_list->Page_Init();

// Page main
$master_transaksi2_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($master_transaksi2->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var master_transaksi2_list = new ew_Page("master_transaksi2_list");

// page properties
master_transaksi2_list.PageID = "list"; // page ID
master_transaksi2_list.FormID = "fmaster_transaksi2list"; // form ID
var EW_PAGE_ID = master_transaksi2_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
master_transaksi2_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
master_transaksi2_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
master_transaksi2_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($master_transaksi2->Export == "") || (EW_EXPORT_MASTER_RECORD && $master_transaksi2->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$master_transaksi2_list->TotalRecs = $master_transaksi2->SelectRecordCount();
	} else {
		if ($master_transaksi2_list->Recordset = $master_transaksi2_list->LoadRecordset())
			$master_transaksi2_list->TotalRecs = $master_transaksi2_list->Recordset->RecordCount();
	}
	$master_transaksi2_list->StartRec = 1;
	if ($master_transaksi2_list->DisplayRecs <= 0 || ($master_transaksi2->Export <> "" && $master_transaksi2->ExportAll)) // Display all records
		$master_transaksi2_list->DisplayRecs = $master_transaksi2_list->TotalRecs;
	if (!($master_transaksi2->Export <> "" && $master_transaksi2->ExportAll))
		$master_transaksi2_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$master_transaksi2_list->Recordset = $master_transaksi2_list->LoadRecordset($master_transaksi2_list->StartRec-1, $master_transaksi2_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $master_transaksi2->TableCaption() ?>
&nbsp;&nbsp;<?php $master_transaksi2_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($master_transaksi2->Export == "" && $master_transaksi2->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(master_transaksi2_list);" style="text-decoration: none;"><img id="master_transaksi2_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="master_transaksi2_list_SearchPanel">
<form name="fmaster_transaksi2listsrch" id="fmaster_transaksi2listsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="master_transaksi2">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($master_transaksi2->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $master_transaksi2_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
	<a href="master_transaksi2srch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($master_transaksi2->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($master_transaksi2->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($master_transaksi2->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $master_transaksi2_list->ShowPageHeader(); ?>
<?php
$master_transaksi2_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($master_transaksi2->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($master_transaksi2->CurrentAction <> "gridadd" && $master_transaksi2->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($master_transaksi2_list->Pager)) $master_transaksi2_list->Pager = new cNumericPager($master_transaksi2_list->StartRec, $master_transaksi2_list->DisplayRecs, $master_transaksi2_list->TotalRecs, $master_transaksi2_list->RecRange) ?>
<?php if ($master_transaksi2_list->Pager->RecordCount > 0) { ?>
	<?php if ($master_transaksi2_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $master_transaksi2_list->PageUrl() ?>start=<?php echo $master_transaksi2_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($master_transaksi2_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $master_transaksi2_list->PageUrl() ?>start=<?php echo $master_transaksi2_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($master_transaksi2_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $master_transaksi2_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($master_transaksi2_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $master_transaksi2_list->PageUrl() ?>start=<?php echo $master_transaksi2_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($master_transaksi2_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $master_transaksi2_list->PageUrl() ?>start=<?php echo $master_transaksi2_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($master_transaksi2_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $master_transaksi2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $master_transaksi2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $master_transaksi2_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($master_transaksi2_list->SearchWhere == "0=101") { ?>
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
<?php if ($master_transaksi2_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="master_transaksi2">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($master_transaksi2_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($master_transaksi2_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($master_transaksi2_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($master_transaksi2_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($master_transaksi2_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($master_transaksi2_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($master_transaksi2_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($master_transaksi2_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($master_transaksi2_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $master_transaksi2_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($rekeningju->DetailAdd && $Security->AllowAdd('rekeningju')) { ?>
<a class="ewGridLink" href="<?php echo $master_transaksi2->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=rekeningju" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $master_transaksi2->TableCaption() ?>/<?php echo $rekeningju->TableCaption() ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fmaster_transaksi2list" id="fmaster_transaksi2list" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="master_transaksi2">
<div id="gmp_master_transaksi2" class="ewGridMiddlePanel">
<?php if ($master_transaksi2_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $master_transaksi2->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$master_transaksi2_list->RenderListOptions();

// Render list options (header, left)
$master_transaksi2_list->ListOptions->Render("header", "left");
?>
<?php if ($master_transaksi2->penjelasan->Visible) { // penjelasan ?>
	<?php if ($master_transaksi2->SortUrl($master_transaksi2->penjelasan) == "") { ?>
		<td><?php echo $master_transaksi2->penjelasan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_transaksi2->SortUrl($master_transaksi2->penjelasan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_transaksi2->penjelasan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_transaksi2->penjelasan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_transaksi2->penjelasan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_transaksi2->tanggal->Visible) { // tanggal ?>
	<?php if ($master_transaksi2->SortUrl($master_transaksi2->tanggal) == "") { ?>
		<td><?php echo $master_transaksi2->tanggal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_transaksi2->SortUrl($master_transaksi2->tanggal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_transaksi2->tanggal->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_transaksi2->tanggal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_transaksi2->tanggal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_transaksi2->tipe_transaksi->Visible) { // tipe_transaksi ?>
	<?php if ($master_transaksi2->SortUrl($master_transaksi2->tipe_transaksi) == "") { ?>
		<td><?php echo $master_transaksi2->tipe_transaksi->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_transaksi2->SortUrl($master_transaksi2->tipe_transaksi) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_transaksi2->tipe_transaksi->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_transaksi2->tipe_transaksi->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_transaksi2->tipe_transaksi->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_transaksi2->saldo_debet->Visible) { // saldo_debet ?>
	<?php if ($master_transaksi2->SortUrl($master_transaksi2->saldo_debet) == "") { ?>
		<td><?php echo $master_transaksi2->saldo_debet->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_transaksi2->SortUrl($master_transaksi2->saldo_debet) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_transaksi2->saldo_debet->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_transaksi2->saldo_debet->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_transaksi2->saldo_debet->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_transaksi2->saldo_kredit->Visible) { // saldo_kredit ?>
	<?php if ($master_transaksi2->SortUrl($master_transaksi2->saldo_kredit) == "") { ?>
		<td><?php echo $master_transaksi2->saldo_kredit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_transaksi2->SortUrl($master_transaksi2->saldo_kredit) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_transaksi2->saldo_kredit->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_transaksi2->saldo_kredit->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_transaksi2->saldo_kredit->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$master_transaksi2_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($master_transaksi2->ExportAll && $master_transaksi2->Export <> "") {
	$master_transaksi2_list->StopRec = $master_transaksi2_list->TotalRecs;
} else {

	// Set the last record to display
	if ($master_transaksi2_list->TotalRecs > $master_transaksi2_list->StartRec + $master_transaksi2_list->DisplayRecs - 1)
		$master_transaksi2_list->StopRec = $master_transaksi2_list->StartRec + $master_transaksi2_list->DisplayRecs - 1;
	else
		$master_transaksi2_list->StopRec = $master_transaksi2_list->TotalRecs;
}
$master_transaksi2_list->RecCnt = $master_transaksi2_list->StartRec - 1;
if ($master_transaksi2_list->Recordset && !$master_transaksi2_list->Recordset->EOF) {
	$master_transaksi2_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $master_transaksi2_list->StartRec > 1)
		$master_transaksi2_list->Recordset->Move($master_transaksi2_list->StartRec - 1);
} elseif (!$master_transaksi2->AllowAddDeleteRow && $master_transaksi2_list->StopRec == 0) {
	$master_transaksi2_list->StopRec = $master_transaksi2->GridAddRowCount;
}

// Initialize aggregate
$master_transaksi2->RowType = EW_ROWTYPE_AGGREGATEINIT;
$master_transaksi2->ResetAttrs();
$master_transaksi2_list->RenderRow();
$master_transaksi2_list->RowCnt = 0;
while ($master_transaksi2_list->RecCnt < $master_transaksi2_list->StopRec) {
	$master_transaksi2_list->RecCnt++;
	if (intval($master_transaksi2_list->RecCnt) >= intval($master_transaksi2_list->StartRec)) {
		$master_transaksi2_list->RowCnt++;

		// Set up key count
		$master_transaksi2_list->KeyCount = $master_transaksi2_list->RowIndex;

		// Init row class and style
		$master_transaksi2->ResetAttrs();
		$master_transaksi2->CssClass = "";
		if ($master_transaksi2->CurrentAction == "gridadd") {
		} else {
			$master_transaksi2_list->LoadRowValues($master_transaksi2_list->Recordset); // Load row values
		}
		$master_transaksi2->RowType = EW_ROWTYPE_VIEW; // Render view
		$master_transaksi2->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$master_transaksi2_list->RenderRow();

		// Render list options
		$master_transaksi2_list->RenderListOptions();
?>
	<tr<?php echo $master_transaksi2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$master_transaksi2_list->ListOptions->Render("body", "left");
?>
	<?php if ($master_transaksi2->penjelasan->Visible) { // penjelasan ?>
		<td<?php echo $master_transaksi2->penjelasan->CellAttributes() ?>>
<div<?php echo $master_transaksi2->penjelasan->ViewAttributes() ?>><?php echo $master_transaksi2->penjelasan->ListViewValue() ?></div>
<a name="<?php echo $master_transaksi2_list->PageObjName . "_row_" . $master_transaksi2_list->RowCnt ?>" id="<?php echo $master_transaksi2_list->PageObjName . "_row_" . $master_transaksi2_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($master_transaksi2->tanggal->Visible) { // tanggal ?>
		<td<?php echo $master_transaksi2->tanggal->CellAttributes() ?>>
<div<?php echo $master_transaksi2->tanggal->ViewAttributes() ?>><?php echo $master_transaksi2->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_transaksi2->tipe_transaksi->Visible) { // tipe_transaksi ?>
		<td<?php echo $master_transaksi2->tipe_transaksi->CellAttributes() ?>>
<div<?php echo $master_transaksi2->tipe_transaksi->ViewAttributes() ?>><?php echo $master_transaksi2->tipe_transaksi->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_transaksi2->saldo_debet->Visible) { // saldo_debet ?>
		<td<?php echo $master_transaksi2->saldo_debet->CellAttributes() ?>>
<div<?php echo $master_transaksi2->saldo_debet->ViewAttributes() ?>><?php echo $master_transaksi2->saldo_debet->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_transaksi2->saldo_kredit->Visible) { // saldo_kredit ?>
		<td<?php echo $master_transaksi2->saldo_kredit->CellAttributes() ?>>
<div<?php echo $master_transaksi2->saldo_kredit->ViewAttributes() ?>><?php echo $master_transaksi2->saldo_kredit->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$master_transaksi2_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($master_transaksi2->CurrentAction <> "gridadd")
		$master_transaksi2_list->Recordset->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$master_transaksi2->RowType = EW_ROWTYPE_AGGREGATE;
$master_transaksi2->ResetAttrs();
$master_transaksi2_list->RenderRow();
?>
<?php if ($master_transaksi2_list->TotalRecs > 0 && ($master_transaksi2->CurrentAction <> "gridadd" && $master_transaksi2->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$master_transaksi2_list->RenderListOptions();

// Render list options (footer, left)
$master_transaksi2_list->ListOptions->Render("footer", "left");
?>
	<?php if ($master_transaksi2->penjelasan->Visible) { // penjelasan ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($master_transaksi2->tanggal->Visible) { // tanggal ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($master_transaksi2->tipe_transaksi->Visible) { // tipe_transaksi ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($master_transaksi2->saldo_debet->Visible) { // saldo_debet ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $master_transaksi2->saldo_debet->ViewAttributes() ?>><?php echo $master_transaksi2->saldo_debet->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($master_transaksi2->saldo_kredit->Visible) { // saldo_kredit ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $master_transaksi2->saldo_kredit->ViewAttributes() ?>><?php echo $master_transaksi2->saldo_kredit->ViewValue ?></span> 
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$master_transaksi2_list->ListOptions->Render("footer", "right");
?>
	</tr>
</tfoot>	
<?php } ?>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($master_transaksi2_list->Recordset)
	$master_transaksi2_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($master_transaksi2->Export == "" && $master_transaksi2->CurrentAction == "") { ?>
<?php } ?>
<?php
$master_transaksi2_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($master_transaksi2->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$master_transaksi2_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmaster_transaksi2_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'master_transaksi2';

	// Page object name
	var $PageObjName = 'master_transaksi2_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $master_transaksi2;
		if ($master_transaksi2->UseTokenInUrl) $PageUrl .= "t=" . $master_transaksi2->TableVar . "&"; // Add page token
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
		global $objForm, $master_transaksi2;
		if ($master_transaksi2->UseTokenInUrl) {
			if ($objForm)
				return ($master_transaksi2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($master_transaksi2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmaster_transaksi2_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (master_transaksi2)
		if (!isset($GLOBALS["master_transaksi2"])) {
			$GLOBALS["master_transaksi2"] = new cmaster_transaksi2();
			$GLOBALS["Table"] =& $GLOBALS["master_transaksi2"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "master_transaksi2add.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "master_transaksi2delete.php";
		$this->MultiUpdateUrl = "master_transaksi2update.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (rekeningju)
		if (!isset($GLOBALS['rekeningju'])) $GLOBALS['rekeningju'] = new crekeningju();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'master_transaksi2', TRUE);

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
		global $master_transaksi2;

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

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$master_transaksi2->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $master_transaksi2;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($master_transaksi2->Export <> "" ||
				$master_transaksi2->CurrentAction == "gridadd" ||
				$master_transaksi2->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$master_transaksi2->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($master_transaksi2->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $master_transaksi2->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$master_transaksi2->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$master_transaksi2->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$master_transaksi2->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $master_transaksi2->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$master_transaksi2->setSessionWhere($sFilter);
		$master_transaksi2->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $master_transaksi2;
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
			$master_transaksi2->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$master_transaksi2->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $master_transaksi2;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $master_transaksi2->penjelasan, FALSE); // penjelasan
		$this->BuildSearchSql($sWhere, $master_transaksi2->tanggal, FALSE); // tanggal
		$this->BuildSearchSql($sWhere, $master_transaksi2->tipe_transaksi, FALSE); // tipe_transaksi
		$this->BuildSearchSql($sWhere, $master_transaksi2->saldo_debet, FALSE); // saldo_debet
		$this->BuildSearchSql($sWhere, $master_transaksi2->saldo_kredit, FALSE); // saldo_kredit

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($master_transaksi2->penjelasan); // penjelasan
			$this->SetSearchParm($master_transaksi2->tanggal); // tanggal
			$this->SetSearchParm($master_transaksi2->tipe_transaksi); // tipe_transaksi
			$this->SetSearchParm($master_transaksi2->saldo_debet); // saldo_debet
			$this->SetSearchParm($master_transaksi2->saldo_kredit); // saldo_kredit
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $master_transaksi2;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$master_transaksi2->setAdvancedSearch("x_$FldParm", $FldVal);
		$master_transaksi2->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$master_transaksi2->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$master_transaksi2->setAdvancedSearch("y_$FldParm", $FldVal2);
		$master_transaksi2->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $master_transaksi2;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $master_transaksi2->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $master_transaksi2->getAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $master_transaksi2;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $master_transaksi2->kode_otomatis, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_transaksi2->penjelasan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_transaksi2->tipe_transaksi, $Keyword);
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $master_transaksi2->saldo_debet, $Keyword);
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $master_transaksi2->saldo_kredit, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", $lFldDataType));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $master_transaksi2;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $master_transaksi2->BasicSearchKeyword;
		$sSearchType = $master_transaksi2->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$master_transaksi2->setSessionBasicSearchKeyword($sSearchKeyword);
			$master_transaksi2->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $master_transaksi2;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$master_transaksi2->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $master_transaksi2;
		$master_transaksi2->setSessionBasicSearchKeyword("");
		$master_transaksi2->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $master_transaksi2;
		$master_transaksi2->setAdvancedSearch("x_penjelasan", "");
		$master_transaksi2->setAdvancedSearch("z_penjelasan", "");
		$master_transaksi2->setAdvancedSearch("y_penjelasan", "");
		$master_transaksi2->setAdvancedSearch("x_tanggal", "");
		$master_transaksi2->setAdvancedSearch("z_tanggal", "");
		$master_transaksi2->setAdvancedSearch("y_tanggal", "");
		$master_transaksi2->setAdvancedSearch("x_tipe_transaksi", "");
		$master_transaksi2->setAdvancedSearch("z_tipe_transaksi", "");
		$master_transaksi2->setAdvancedSearch("y_tipe_transaksi", "");
		$master_transaksi2->setAdvancedSearch("x_saldo_debet", "");
		$master_transaksi2->setAdvancedSearch("z_saldo_debet", "");
		$master_transaksi2->setAdvancedSearch("y_saldo_debet", "");
		$master_transaksi2->setAdvancedSearch("x_saldo_kredit", "");
		$master_transaksi2->setAdvancedSearch("z_saldo_kredit", "");
		$master_transaksi2->setAdvancedSearch("y_saldo_kredit", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $master_transaksi2;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_penjelasan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_penjelasan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_tanggal"] <> "") $bRestore = FALSE;
		if (@$_GET["y_tanggal"] <> "") $bRestore = FALSE;
		if (@$_GET["x_tipe_transaksi"] <> "") $bRestore = FALSE;
		if (@$_GET["y_tipe_transaksi"] <> "") $bRestore = FALSE;
		if (@$_GET["x_saldo_debet"] <> "") $bRestore = FALSE;
		if (@$_GET["y_saldo_debet"] <> "") $bRestore = FALSE;
		if (@$_GET["x_saldo_kredit"] <> "") $bRestore = FALSE;
		if (@$_GET["y_saldo_kredit"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$master_transaksi2->BasicSearchKeyword = $master_transaksi2->getSessionBasicSearchKeyword();
			$master_transaksi2->BasicSearchType = $master_transaksi2->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($master_transaksi2->penjelasan);
			$this->GetSearchParm($master_transaksi2->tanggal);
			$this->GetSearchParm($master_transaksi2->tipe_transaksi);
			$this->GetSearchParm($master_transaksi2->saldo_debet);
			$this->GetSearchParm($master_transaksi2->saldo_kredit);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $master_transaksi2;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$master_transaksi2->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$master_transaksi2->CurrentOrderType = @$_GET["ordertype"];
			$master_transaksi2->UpdateSort($master_transaksi2->penjelasan); // penjelasan
			$master_transaksi2->UpdateSort($master_transaksi2->tanggal); // tanggal
			$master_transaksi2->UpdateSort($master_transaksi2->tipe_transaksi); // tipe_transaksi
			$master_transaksi2->UpdateSort($master_transaksi2->saldo_debet); // saldo_debet
			$master_transaksi2->UpdateSort($master_transaksi2->saldo_kredit); // saldo_kredit
			$master_transaksi2->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $master_transaksi2;
		$sOrderBy = $master_transaksi2->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($master_transaksi2->SqlOrderBy() <> "") {
				$sOrderBy = $master_transaksi2->SqlOrderBy();
				$master_transaksi2->setSessionOrderBy($sOrderBy);
				$master_transaksi2->tanggal->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $master_transaksi2;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$master_transaksi2->setSessionOrderBy($sOrderBy);
				$master_transaksi2->penjelasan->setSort("");
				$master_transaksi2->tanggal->setSort("");
				$master_transaksi2->tipe_transaksi->setSort("");
				$master_transaksi2->saldo_debet->setSort("");
				$master_transaksi2->saldo_kredit->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$master_transaksi2->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $master_transaksi2;

		// "detail_rekeningju"
		$item =& $this->ListOptions->Add("detail_rekeningju");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('rekeningju');
		$item->OnLeft = TRUE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $master_transaksi2, $objForm;
		$this->ListOptions->LoadDefault();

		// "detail_rekeningju"
		$oListOpt =& $this->ListOptions->Items["detail_rekeningju"];
		if ($Security->AllowList('rekeningju')) {
			$oListOpt->Body = "<img src=\"phpimages/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("rekeningju", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"rekeningjulist.php?" . EW_TABLE_SHOW_MASTER . "=master_transaksi2&kode_otomatis=" . urlencode(strval($master_transaksi2->kode_otomatis->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $master_transaksi2;
		$sSqlWrk = "`kode_otomatis_master`='" . ew_AdjustSql($master_transaksi2->kode_otomatis->CurrentValue) . "'";
		$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
		$sSqlWrk = str_replace("'", "\'", $sSqlWrk);
		$sHyperLinkParm = " href=\"rekeningjulist.php?" . EW_TABLE_SHOW_MASTER . "=master_transaksi2&kode_otomatis=" . urlencode(strval($master_transaksi2->kode_otomatis->CurrentValue)) . "\"";
		$oListOpt =& $this->ListOptions->Items["detail_rekeningju"];
		$oListOpt->Body = $Language->TablePhrase("rekeningju", "TblCaption");
		$oListOpt->Body = "<a class=\"ewRowLink\"" . $sHyperLinkParm . ">" . $oListOpt->Body . "</a>";
		$sHyperLinkParm = " href=\"javascript:void(0);\" name=\"dl%i_master_transaksi2_rekeningju\" id=\"dl%i_master_transaksi2_rekeningju\" onclick=\"ew_AjaxShowDetails2(event, this, 'rekeningjupreview.php?f=%s')\"";		
		$sHyperLinkParm = str_replace("%i", $this->RowCnt, $sHyperLinkParm);
		$sHyperLinkParm = str_replace("%s", $sSqlWrk, $sHyperLinkParm);
		$oListOpt->Body = "<a" . $sHyperLinkParm . "><img class=\"ewPreviewRowImage\" src=\"phpimages/expand.gif\" width=\"9\" height=\"9\" border=\"0\"></a>&nbsp;" . $oListOpt->Body;
		$links = "";
		if ($links <> "") $oListOpt->Body .= "<br>" . $links;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $master_transaksi2;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$master_transaksi2->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$master_transaksi2->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $master_transaksi2->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$master_transaksi2->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$master_transaksi2->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$master_transaksi2->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $master_transaksi2;
		$master_transaksi2->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$master_transaksi2->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $master_transaksi2;

		// Load search values
		// penjelasan

		$master_transaksi2->penjelasan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_penjelasan"]);
		$master_transaksi2->penjelasan->AdvancedSearch->SearchOperator = @$_GET["z_penjelasan"];
		$master_transaksi2->penjelasan->AdvancedSearch->SearchCondition = @$_GET["v_penjelasan"];
		$master_transaksi2->penjelasan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_penjelasan"]);
		$master_transaksi2->penjelasan->AdvancedSearch->SearchOperator2 = @$_GET["w_penjelasan"];

		// tanggal
		$master_transaksi2->tanggal->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_tanggal"]);
		$master_transaksi2->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];
		$master_transaksi2->tanggal->AdvancedSearch->SearchCondition = @$_GET["v_tanggal"];
		$master_transaksi2->tanggal->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_tanggal"]);
		$master_transaksi2->tanggal->AdvancedSearch->SearchOperator2 = @$_GET["w_tanggal"];

		// tipe_transaksi
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_tipe_transaksi"]);
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator = @$_GET["z_tipe_transaksi"];
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchCondition = @$_GET["v_tipe_transaksi"];
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_tipe_transaksi"]);
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator2 = @$_GET["w_tipe_transaksi"];

		// saldo_debet
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_saldo_debet"]);
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator = @$_GET["z_saldo_debet"];
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchCondition = @$_GET["v_saldo_debet"];
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_saldo_debet"]);
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator2 = @$_GET["w_saldo_debet"];

		// saldo_kredit
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_saldo_kredit"]);
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator = @$_GET["z_saldo_kredit"];
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchCondition = @$_GET["v_saldo_kredit"];
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_saldo_kredit"]);
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator2 = @$_GET["w_saldo_kredit"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $master_transaksi2;

		// Call Recordset Selecting event
		$master_transaksi2->Recordset_Selecting($master_transaksi2->CurrentFilter);

		// Load List page SQL
		$sSql = $master_transaksi2->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$master_transaksi2->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $master_transaksi2;
		$sFilter = $master_transaksi2->KeyFilter();

		// Call Row Selecting event
		$master_transaksi2->Row_Selecting($sFilter);

		// Load SQL based on filter
		$master_transaksi2->CurrentFilter = $sFilter;
		$sSql = $master_transaksi2->SQL();
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
		global $conn, $master_transaksi2;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$master_transaksi2->Row_Selected($row);
		$master_transaksi2->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$master_transaksi2->penjelasan->setDbValue($rs->fields('penjelasan'));
		$master_transaksi2->tanggal->setDbValue($rs->fields('tanggal'));
		$master_transaksi2->tipe_transaksi->setDbValue($rs->fields('tipe_transaksi'));
		$master_transaksi2->saldo_debet->setDbValue($rs->fields('saldo_debet'));
		$master_transaksi2->saldo_kredit->setDbValue($rs->fields('saldo_kredit'));
	}

	// Load old record
	function LoadOldRecord() {
		global $master_transaksi2;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($master_transaksi2->getKey("kode_otomatis")) <> "")
			$master_transaksi2->kode_otomatis->CurrentValue = $master_transaksi2->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$master_transaksi2->CurrentFilter = $master_transaksi2->KeyFilter();
			$sSql = $master_transaksi2->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $master_transaksi2;

		// Initialize URLs
		$this->ViewUrl = $master_transaksi2->ViewUrl();
		$this->EditUrl = $master_transaksi2->EditUrl();
		$this->InlineEditUrl = $master_transaksi2->InlineEditUrl();
		$this->CopyUrl = $master_transaksi2->CopyUrl();
		$this->InlineCopyUrl = $master_transaksi2->InlineCopyUrl();
		$this->DeleteUrl = $master_transaksi2->DeleteUrl();

		// Call Row_Rendering event
		$master_transaksi2->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis
		// penjelasan
		// tanggal
		// tipe_transaksi
		// saldo_debet
		// saldo_kredit
		// Accumulate aggregate value

		if ($master_transaksi2->RowType <> EW_ROWTYPE_AGGREGATEINIT && $master_transaksi2->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($master_transaksi2->saldo_debet->CurrentValue))
				$master_transaksi2->saldo_debet->Total += $master_transaksi2->saldo_debet->CurrentValue; // Accumulate total
			if (is_numeric($master_transaksi2->saldo_kredit->CurrentValue))
				$master_transaksi2->saldo_kredit->Total += $master_transaksi2->saldo_kredit->CurrentValue; // Accumulate total
		}
		if ($master_transaksi2->RowType == EW_ROWTYPE_VIEW) { // View row

			// penjelasan
			$master_transaksi2->penjelasan->ViewValue = $master_transaksi2->penjelasan->CurrentValue;
			$master_transaksi2->penjelasan->ViewCustomAttributes = "";

			// tanggal
			$master_transaksi2->tanggal->ViewValue = $master_transaksi2->tanggal->CurrentValue;
			$master_transaksi2->tanggal->ViewValue = ew_FormatDateTime($master_transaksi2->tanggal->ViewValue, 7);
			$master_transaksi2->tanggal->ViewCustomAttributes = "";

			// tipe_transaksi
			$master_transaksi2->tipe_transaksi->ViewValue = $master_transaksi2->tipe_transaksi->CurrentValue;
			$master_transaksi2->tipe_transaksi->ViewCustomAttributes = "";

			// saldo_debet
			$master_transaksi2->saldo_debet->ViewValue = $master_transaksi2->saldo_debet->CurrentValue;
			$master_transaksi2->saldo_debet->ViewCustomAttributes = "";

			// saldo_kredit
			$master_transaksi2->saldo_kredit->ViewValue = $master_transaksi2->saldo_kredit->CurrentValue;
			$master_transaksi2->saldo_kredit->ViewCustomAttributes = "";

			// penjelasan
			$master_transaksi2->penjelasan->LinkCustomAttributes = "";
			$master_transaksi2->penjelasan->HrefValue = "";
			$master_transaksi2->penjelasan->TooltipValue = "";

			// tanggal
			$master_transaksi2->tanggal->LinkCustomAttributes = "";
			$master_transaksi2->tanggal->HrefValue = "";
			$master_transaksi2->tanggal->TooltipValue = "";

			// tipe_transaksi
			$master_transaksi2->tipe_transaksi->LinkCustomAttributes = "";
			$master_transaksi2->tipe_transaksi->HrefValue = "";
			$master_transaksi2->tipe_transaksi->TooltipValue = "";

			// saldo_debet
			$master_transaksi2->saldo_debet->LinkCustomAttributes = "";
			$master_transaksi2->saldo_debet->HrefValue = "";
			$master_transaksi2->saldo_debet->TooltipValue = "";

			// saldo_kredit
			$master_transaksi2->saldo_kredit->LinkCustomAttributes = "";
			$master_transaksi2->saldo_kredit->HrefValue = "";
			$master_transaksi2->saldo_kredit->TooltipValue = "";
		} elseif ($master_transaksi2->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$master_transaksi2->saldo_debet->Total = 0; // Initialize total
			$master_transaksi2->saldo_kredit->Total = 0; // Initialize total
		} elseif ($master_transaksi2->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$master_transaksi2->saldo_debet->CurrentValue = $master_transaksi2->saldo_debet->Total;
			$master_transaksi2->saldo_debet->ViewValue = $master_transaksi2->saldo_debet->CurrentValue;
			$master_transaksi2->saldo_debet->ViewCustomAttributes = "";
			$master_transaksi2->saldo_debet->HrefValue = ""; // Clear href value
			$master_transaksi2->saldo_kredit->CurrentValue = $master_transaksi2->saldo_kredit->Total;
			$master_transaksi2->saldo_kredit->ViewValue = $master_transaksi2->saldo_kredit->CurrentValue;
			$master_transaksi2->saldo_kredit->ViewCustomAttributes = "";
			$master_transaksi2->saldo_kredit->HrefValue = ""; // Clear href value
		}

		// Call Row Rendered event
		if ($master_transaksi2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$master_transaksi2->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $master_transaksi2;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $master_transaksi2;
		$master_transaksi2->penjelasan->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_penjelasan");
		$master_transaksi2->penjelasan->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_penjelasan");
		$master_transaksi2->penjelasan->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_penjelasan");
		$master_transaksi2->tanggal->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_tanggal");
		$master_transaksi2->tanggal->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_tanggal");
		$master_transaksi2->tanggal->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_tanggal");
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_tipe_transaksi");
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_tipe_transaksi");
		$master_transaksi2->tipe_transaksi->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_tipe_transaksi");
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_saldo_debet");
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_saldo_debet");
		$master_transaksi2->saldo_debet->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_saldo_debet");
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue = $master_transaksi2->getAdvancedSearch("x_saldo_kredit");
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchOperator = $master_transaksi2->getAdvancedSearch("z_saldo_kredit");
		$master_transaksi2->saldo_kredit->AdvancedSearch->SearchValue2 = $master_transaksi2->getAdvancedSearch("y_saldo_kredit");
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
	}

		// Page Load event
function Page_Load() {
	// Bismillaah
	global $Language;
	$Language->setPhrase("ShowAll",""); 
	
	$Language->setPhrase("TblTypeVIEW","");
	
	$item =& $this->ExportOptions->Add("Reset");
	$item->Body = "<a href=master_transaksi2list.php?cmd=resetall>Reset Pencarian</a>";            
	$item->Visible = TRUE;     
	
	$judul= "Jurnal Umum "  ;
	   
	$Language->setTablePhrase(CurrentTable()->TableName, "TblCaption", $judul);
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

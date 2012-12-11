<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_master_pengajarinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_master_pengajar_list = new cst_master_pengajar_list();
$Page =& $st_master_pengajar_list;

// Page init
$st_master_pengajar_list->Page_Init();

// Page main
$st_master_pengajar_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($st_master_pengajar->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var st_master_pengajar_list = new ew_Page("st_master_pengajar_list");

// page properties
st_master_pengajar_list.PageID = "list"; // page ID
st_master_pengajar_list.FormID = "fst_master_pengajarlist"; // form ID
var EW_PAGE_ID = st_master_pengajar_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
st_master_pengajar_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_master_pengajar_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_master_pengajar_list.ValidateRequired = false; // no JavaScript validation
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
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($st_master_pengajar->Export == "") || (EW_EXPORT_MASTER_RECORD && $st_master_pengajar->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$st_master_pengajar_list->TotalRecs = $st_master_pengajar->SelectRecordCount();
	} else {
		if ($st_master_pengajar_list->Recordset = $st_master_pengajar_list->LoadRecordset())
			$st_master_pengajar_list->TotalRecs = $st_master_pengajar_list->Recordset->RecordCount();
	}
	$st_master_pengajar_list->StartRec = 1;
	if ($st_master_pengajar_list->DisplayRecs <= 0 || ($st_master_pengajar->Export <> "" && $st_master_pengajar->ExportAll)) // Display all records
		$st_master_pengajar_list->DisplayRecs = $st_master_pengajar_list->TotalRecs;
	if (!($st_master_pengajar->Export <> "" && $st_master_pengajar->ExportAll))
		$st_master_pengajar_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$st_master_pengajar_list->Recordset = $st_master_pengajar_list->LoadRecordset($st_master_pengajar_list->StartRec-1, $st_master_pengajar_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_master_pengajar->TableCaption() ?>
&nbsp;&nbsp;<?php $st_master_pengajar_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($st_master_pengajar->Export == "" && $st_master_pengajar->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(st_master_pengajar_list);" style="text-decoration: none;"><img id="st_master_pengajar_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="st_master_pengajar_list_SearchPanel">
<form name="fst_master_pengajarlistsrch" id="fst_master_pengajarlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="st_master_pengajar">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($st_master_pengajar->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $st_master_pengajar_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($st_master_pengajar->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($st_master_pengajar->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($st_master_pengajar->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $st_master_pengajar_list->ShowPageHeader(); ?>
<?php
$st_master_pengajar_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($st_master_pengajar->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($st_master_pengajar->CurrentAction <> "gridadd" && $st_master_pengajar->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($st_master_pengajar_list->Pager)) $st_master_pengajar_list->Pager = new cNumericPager($st_master_pengajar_list->StartRec, $st_master_pengajar_list->DisplayRecs, $st_master_pengajar_list->TotalRecs, $st_master_pengajar_list->RecRange) ?>
<?php if ($st_master_pengajar_list->Pager->RecordCount > 0) { ?>
	<?php if ($st_master_pengajar_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $st_master_pengajar_list->PageUrl() ?>start=<?php echo $st_master_pengajar_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($st_master_pengajar_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $st_master_pengajar_list->PageUrl() ?>start=<?php echo $st_master_pengajar_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($st_master_pengajar_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $st_master_pengajar_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($st_master_pengajar_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $st_master_pengajar_list->PageUrl() ?>start=<?php echo $st_master_pengajar_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($st_master_pengajar_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $st_master_pengajar_list->PageUrl() ?>start=<?php echo $st_master_pengajar_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($st_master_pengajar_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $st_master_pengajar_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $st_master_pengajar_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $st_master_pengajar_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($st_master_pengajar_list->SearchWhere == "0=101") { ?>
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
<?php if ($st_master_pengajar_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="st_master_pengajar">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($st_master_pengajar_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($st_master_pengajar_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($st_master_pengajar_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($st_master_pengajar_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($st_master_pengajar_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($st_master_pengajar_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($st_master_pengajar_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($st_master_pengajar_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($st_master_pengajar_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $st_master_pengajar_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fst_master_pengajarlist" id="fst_master_pengajarlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="st_master_pengajar">
<div id="gmp_st_master_pengajar" class="ewGridMiddlePanel">
<?php if ($st_master_pengajar_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $st_master_pengajar->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$st_master_pengajar_list->RenderListOptions();

// Render list options (header, left)
$st_master_pengajar_list->ListOptions->Render("header", "left");
?>
<?php if ($st_master_pengajar->nama->Visible) { // nama ?>
	<?php if ($st_master_pengajar->SortUrl($st_master_pengajar->nama) == "") { ?>
		<td><?php echo $st_master_pengajar->nama->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_pengajar->SortUrl($st_master_pengajar->nama) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_pengajar->nama->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($st_master_pengajar->nama->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_pengajar->nama->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_master_pengajar->kode_pengajar->Visible) { // kode_pengajar ?>
	<?php if ($st_master_pengajar->SortUrl($st_master_pengajar->kode_pengajar) == "") { ?>
		<td><?php echo $st_master_pengajar->kode_pengajar->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_pengajar->SortUrl($st_master_pengajar->kode_pengajar) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_pengajar->kode_pengajar->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($st_master_pengajar->kode_pengajar->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_pengajar->kode_pengajar->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_master_pengajar->password->Visible) { // password ?>
	<?php if ($st_master_pengajar->SortUrl($st_master_pengajar->password) == "") { ?>
		<td><?php echo $st_master_pengajar->password->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_pengajar->SortUrl($st_master_pengajar->password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_pengajar->password->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($st_master_pengajar->password->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_pengajar->password->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_master_pengajar->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
	<?php if ($st_master_pengajar->SortUrl($st_master_pengajar->kode_otomatis_tingkat) == "") { ?>
		<td><?php echo $st_master_pengajar->kode_otomatis_tingkat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_pengajar->SortUrl($st_master_pengajar->kode_otomatis_tingkat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_pengajar->kode_otomatis_tingkat->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_master_pengajar->kode_otomatis_tingkat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_pengajar->kode_otomatis_tingkat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_master_pengajar->hp->Visible) { // hp ?>
	<?php if ($st_master_pengajar->SortUrl($st_master_pengajar->hp) == "") { ?>
		<td><?php echo $st_master_pengajar->hp->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_pengajar->SortUrl($st_master_pengajar->hp) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_pengajar->hp->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($st_master_pengajar->hp->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_pengajar->hp->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_master_pengajar->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($st_master_pengajar->SortUrl($st_master_pengajar->kode_otomatis) == "") { ?>
		<td><?php echo $st_master_pengajar->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_pengajar->SortUrl($st_master_pengajar->kode_otomatis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_pengajar->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_master_pengajar->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_pengajar->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$st_master_pengajar_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($st_master_pengajar->ExportAll && $st_master_pengajar->Export <> "") {
	$st_master_pengajar_list->StopRec = $st_master_pengajar_list->TotalRecs;
} else {

	// Set the last record to display
	if ($st_master_pengajar_list->TotalRecs > $st_master_pengajar_list->StartRec + $st_master_pengajar_list->DisplayRecs - 1)
		$st_master_pengajar_list->StopRec = $st_master_pengajar_list->StartRec + $st_master_pengajar_list->DisplayRecs - 1;
	else
		$st_master_pengajar_list->StopRec = $st_master_pengajar_list->TotalRecs;
}
$st_master_pengajar_list->RecCnt = $st_master_pengajar_list->StartRec - 1;
if ($st_master_pengajar_list->Recordset && !$st_master_pengajar_list->Recordset->EOF) {
	$st_master_pengajar_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $st_master_pengajar_list->StartRec > 1)
		$st_master_pengajar_list->Recordset->Move($st_master_pengajar_list->StartRec - 1);
} elseif (!$st_master_pengajar->AllowAddDeleteRow && $st_master_pengajar_list->StopRec == 0) {
	$st_master_pengajar_list->StopRec = $st_master_pengajar->GridAddRowCount;
}

// Initialize aggregate
$st_master_pengajar->RowType = EW_ROWTYPE_AGGREGATEINIT;
$st_master_pengajar->ResetAttrs();
$st_master_pengajar_list->RenderRow();
$st_master_pengajar_list->RowCnt = 0;
while ($st_master_pengajar_list->RecCnt < $st_master_pengajar_list->StopRec) {
	$st_master_pengajar_list->RecCnt++;
	if (intval($st_master_pengajar_list->RecCnt) >= intval($st_master_pengajar_list->StartRec)) {
		$st_master_pengajar_list->RowCnt++;

		// Set up key count
		$st_master_pengajar_list->KeyCount = $st_master_pengajar_list->RowIndex;

		// Init row class and style
		$st_master_pengajar->ResetAttrs();
		$st_master_pengajar->CssClass = "";
		if ($st_master_pengajar->CurrentAction == "gridadd") {
		} else {
			$st_master_pengajar_list->LoadRowValues($st_master_pengajar_list->Recordset); // Load row values
		}
		$st_master_pengajar->RowType = EW_ROWTYPE_VIEW; // Render view
		$st_master_pengajar->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$st_master_pengajar_list->RenderRow();

		// Render list options
		$st_master_pengajar_list->RenderListOptions();
?>
	<tr<?php echo $st_master_pengajar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$st_master_pengajar_list->ListOptions->Render("body", "left");
?>
	<?php if ($st_master_pengajar->nama->Visible) { // nama ?>
		<td<?php echo $st_master_pengajar->nama->CellAttributes() ?>>
<div<?php echo $st_master_pengajar->nama->ViewAttributes() ?>><?php echo $st_master_pengajar->nama->ListViewValue() ?></div>
<a name="<?php echo $st_master_pengajar_list->PageObjName . "_row_" . $st_master_pengajar_list->RowCnt ?>" id="<?php echo $st_master_pengajar_list->PageObjName . "_row_" . $st_master_pengajar_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($st_master_pengajar->kode_pengajar->Visible) { // kode_pengajar ?>
		<td<?php echo $st_master_pengajar->kode_pengajar->CellAttributes() ?>>
<div<?php echo $st_master_pengajar->kode_pengajar->ViewAttributes() ?>><?php echo $st_master_pengajar->kode_pengajar->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($st_master_pengajar->password->Visible) { // password ?>
		<td<?php echo $st_master_pengajar->password->CellAttributes() ?>>
<div<?php echo $st_master_pengajar->password->ViewAttributes() ?>><?php echo $st_master_pengajar->password->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($st_master_pengajar->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<td<?php echo $st_master_pengajar->kode_otomatis_tingkat->CellAttributes() ?>>
<div<?php echo $st_master_pengajar->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $st_master_pengajar->kode_otomatis_tingkat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($st_master_pengajar->hp->Visible) { // hp ?>
		<td<?php echo $st_master_pengajar->hp->CellAttributes() ?>>
<div<?php echo $st_master_pengajar->hp->ViewAttributes() ?>><?php echo $st_master_pengajar->hp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($st_master_pengajar->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $st_master_pengajar->kode_otomatis->CellAttributes() ?>>
<div<?php echo $st_master_pengajar->kode_otomatis->ViewAttributes() ?>><?php echo $st_master_pengajar->kode_otomatis->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$st_master_pengajar_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($st_master_pengajar->CurrentAction <> "gridadd")
		$st_master_pengajar_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($st_master_pengajar_list->Recordset)
	$st_master_pengajar_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($st_master_pengajar->Export == "" && $st_master_pengajar->CurrentAction == "") { ?>
<?php } ?>
<?php
$st_master_pengajar_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($st_master_pengajar->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$st_master_pengajar_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_master_pengajar_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'st_master_pengajar';

	// Page object name
	var $PageObjName = 'st_master_pengajar_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_master_pengajar;
		if ($st_master_pengajar->UseTokenInUrl) $PageUrl .= "t=" . $st_master_pengajar->TableVar . "&"; // Add page token
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
		global $objForm, $st_master_pengajar;
		if ($st_master_pengajar->UseTokenInUrl) {
			if ($objForm)
				return ($st_master_pengajar->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_master_pengajar->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_master_pengajar_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_master_pengajar)
		if (!isset($GLOBALS["st_master_pengajar"])) {
			$GLOBALS["st_master_pengajar"] = new cst_master_pengajar();
			$GLOBALS["Table"] =& $GLOBALS["st_master_pengajar"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "st_master_pengajaradd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "st_master_pengajardelete.php";
		$this->MultiUpdateUrl = "st_master_pengajarupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_master_pengajar', TRUE);

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
		global $st_master_pengajar;

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
			$st_master_pengajar->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $st_master_pengajar;

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
			if ($st_master_pengajar->Export <> "" ||
				$st_master_pengajar->CurrentAction == "gridadd" ||
				$st_master_pengajar->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$st_master_pengajar->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($st_master_pengajar->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $st_master_pengajar->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$st_master_pengajar->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$st_master_pengajar->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$st_master_pengajar->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $st_master_pengajar->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$st_master_pengajar->setSessionWhere($sFilter);
		$st_master_pengajar->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $st_master_pengajar;
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
			$st_master_pengajar->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$st_master_pengajar->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $st_master_pengajar;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $st_master_pengajar->nama, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_master_pengajar->kode_pengajar, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_master_pengajar->password, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_master_pengajar->kode_otomatis_tingkat, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_master_pengajar->hp, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_master_pengajar->kode_otomatis, $Keyword);
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
		global $Security, $st_master_pengajar;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $st_master_pengajar->BasicSearchKeyword;
		$sSearchType = $st_master_pengajar->BasicSearchType;
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
			$st_master_pengajar->setSessionBasicSearchKeyword($sSearchKeyword);
			$st_master_pengajar->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $st_master_pengajar;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$st_master_pengajar->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $st_master_pengajar;
		$st_master_pengajar->setSessionBasicSearchKeyword("");
		$st_master_pengajar->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $st_master_pengajar;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$st_master_pengajar->BasicSearchKeyword = $st_master_pengajar->getSessionBasicSearchKeyword();
			$st_master_pengajar->BasicSearchType = $st_master_pengajar->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $st_master_pengajar;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$st_master_pengajar->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$st_master_pengajar->CurrentOrderType = @$_GET["ordertype"];
			$st_master_pengajar->UpdateSort($st_master_pengajar->nama); // nama
			$st_master_pengajar->UpdateSort($st_master_pengajar->kode_pengajar); // kode_pengajar
			$st_master_pengajar->UpdateSort($st_master_pengajar->password); // password
			$st_master_pengajar->UpdateSort($st_master_pengajar->kode_otomatis_tingkat); // kode_otomatis_tingkat
			$st_master_pengajar->UpdateSort($st_master_pengajar->hp); // hp
			$st_master_pengajar->UpdateSort($st_master_pengajar->kode_otomatis); // kode_otomatis
			$st_master_pengajar->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $st_master_pengajar;
		$sOrderBy = $st_master_pengajar->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($st_master_pengajar->SqlOrderBy() <> "") {
				$sOrderBy = $st_master_pengajar->SqlOrderBy();
				$st_master_pengajar->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $st_master_pengajar;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$st_master_pengajar->setSessionOrderBy($sOrderBy);
				$st_master_pengajar->nama->setSort("");
				$st_master_pengajar->kode_pengajar->setSort("");
				$st_master_pengajar->password->setSort("");
				$st_master_pengajar->kode_otomatis_tingkat->setSort("");
				$st_master_pengajar->hp->setSort("");
				$st_master_pengajar->kode_otomatis->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$st_master_pengajar->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $st_master_pengajar;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
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
		global $Security, $Language, $st_master_pengajar, $objForm;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
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
		global $Security, $Language, $st_master_pengajar;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $st_master_pengajar;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$st_master_pengajar->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$st_master_pengajar->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $st_master_pengajar->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$st_master_pengajar->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$st_master_pengajar->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$st_master_pengajar->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $st_master_pengajar;
		$st_master_pengajar->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$st_master_pengajar->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $st_master_pengajar;

		// Call Recordset Selecting event
		$st_master_pengajar->Recordset_Selecting($st_master_pengajar->CurrentFilter);

		// Load List page SQL
		$sSql = $st_master_pengajar->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$st_master_pengajar->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_master_pengajar;
		$sFilter = $st_master_pengajar->KeyFilter();

		// Call Row Selecting event
		$st_master_pengajar->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_master_pengajar->CurrentFilter = $sFilter;
		$sSql = $st_master_pengajar->SQL();
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
		global $conn, $st_master_pengajar;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_master_pengajar->Row_Selected($row);
		$st_master_pengajar->nama->setDbValue($rs->fields('nama'));
		$st_master_pengajar->kode_pengajar->setDbValue($rs->fields('kode_pengajar'));
		$st_master_pengajar->password->setDbValue($rs->fields('password'));
		$st_master_pengajar->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$st_master_pengajar->hp->setDbValue($rs->fields('hp'));
		$st_master_pengajar->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
	}

	// Load old record
	function LoadOldRecord() {
		global $st_master_pengajar;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($st_master_pengajar->getKey("kode_otomatis")) <> "")
			$st_master_pengajar->kode_otomatis->CurrentValue = $st_master_pengajar->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$st_master_pengajar->CurrentFilter = $st_master_pengajar->KeyFilter();
			$sSql = $st_master_pengajar->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_master_pengajar;

		// Initialize URLs
		$this->ViewUrl = $st_master_pengajar->ViewUrl();
		$this->EditUrl = $st_master_pengajar->EditUrl();
		$this->InlineEditUrl = $st_master_pengajar->InlineEditUrl();
		$this->CopyUrl = $st_master_pengajar->CopyUrl();
		$this->InlineCopyUrl = $st_master_pengajar->InlineCopyUrl();
		$this->DeleteUrl = $st_master_pengajar->DeleteUrl();

		// Call Row_Rendering event
		$st_master_pengajar->Row_Rendering();

		// Common render codes for all row types
		// nama
		// kode_pengajar
		// password
		// kode_otomatis_tingkat
		// hp
		// kode_otomatis

		if ($st_master_pengajar->RowType == EW_ROWTYPE_VIEW) { // View row

			// nama
			$st_master_pengajar->nama->ViewValue = $st_master_pengajar->nama->CurrentValue;
			$st_master_pengajar->nama->ViewCustomAttributes = "";

			// kode_pengajar
			$st_master_pengajar->kode_pengajar->ViewValue = $st_master_pengajar->kode_pengajar->CurrentValue;
			$st_master_pengajar->kode_pengajar->ViewCustomAttributes = "";

			// password
			$st_master_pengajar->password->ViewValue = $st_master_pengajar->password->CurrentValue;
			$st_master_pengajar->password->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$st_master_pengajar->kode_otomatis_tingkat->ViewValue = $st_master_pengajar->kode_otomatis_tingkat->CurrentValue;
			$st_master_pengajar->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// hp
			$st_master_pengajar->hp->ViewValue = $st_master_pengajar->hp->CurrentValue;
			$st_master_pengajar->hp->ViewCustomAttributes = "";

			// kode_otomatis
			$st_master_pengajar->kode_otomatis->ViewValue = $st_master_pengajar->kode_otomatis->CurrentValue;
			$st_master_pengajar->kode_otomatis->ViewCustomAttributes = "";

			// nama
			$st_master_pengajar->nama->LinkCustomAttributes = "";
			$st_master_pengajar->nama->HrefValue = "";
			$st_master_pengajar->nama->TooltipValue = "";

			// kode_pengajar
			$st_master_pengajar->kode_pengajar->LinkCustomAttributes = "";
			$st_master_pengajar->kode_pengajar->HrefValue = "";
			$st_master_pengajar->kode_pengajar->TooltipValue = "";

			// password
			$st_master_pengajar->password->LinkCustomAttributes = "";
			$st_master_pengajar->password->HrefValue = "";
			$st_master_pengajar->password->TooltipValue = "";

			// kode_otomatis_tingkat
			$st_master_pengajar->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$st_master_pengajar->kode_otomatis_tingkat->HrefValue = "";
			$st_master_pengajar->kode_otomatis_tingkat->TooltipValue = "";

			// hp
			$st_master_pengajar->hp->LinkCustomAttributes = "";
			$st_master_pengajar->hp->HrefValue = "";
			$st_master_pengajar->hp->TooltipValue = "";

			// kode_otomatis
			$st_master_pengajar->kode_otomatis->LinkCustomAttributes = "";
			$st_master_pengajar->kode_otomatis->HrefValue = "";
			$st_master_pengajar->kode_otomatis->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($st_master_pengajar->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_master_pengajar->Row_Rendered();
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

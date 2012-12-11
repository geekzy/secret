<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "saldo_rugilabainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$saldo_rugilaba_list = new csaldo_rugilaba_list();
$Page =& $saldo_rugilaba_list;

// Page init
$saldo_rugilaba_list->Page_Init();

// Page main
$saldo_rugilaba_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($saldo_rugilaba->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var saldo_rugilaba_list = new ew_Page("saldo_rugilaba_list");

// page properties
saldo_rugilaba_list.PageID = "list"; // page ID
saldo_rugilaba_list.FormID = "fsaldo_rugilabalist"; // form ID
var EW_PAGE_ID = saldo_rugilaba_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
saldo_rugilaba_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
saldo_rugilaba_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
saldo_rugilaba_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($saldo_rugilaba->Export == "") || (EW_EXPORT_MASTER_RECORD && $saldo_rugilaba->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$saldo_rugilaba_list->TotalRecs = $saldo_rugilaba->SelectRecordCount();
	} else {
		if ($saldo_rugilaba_list->Recordset = $saldo_rugilaba_list->LoadRecordset())
			$saldo_rugilaba_list->TotalRecs = $saldo_rugilaba_list->Recordset->RecordCount();
	}
	$saldo_rugilaba_list->StartRec = 1;
	if ($saldo_rugilaba_list->DisplayRecs <= 0 || ($saldo_rugilaba->Export <> "" && $saldo_rugilaba->ExportAll)) // Display all records
		$saldo_rugilaba_list->DisplayRecs = $saldo_rugilaba_list->TotalRecs;
	if (!($saldo_rugilaba->Export <> "" && $saldo_rugilaba->ExportAll))
		$saldo_rugilaba_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$saldo_rugilaba_list->Recordset = $saldo_rugilaba_list->LoadRecordset($saldo_rugilaba_list->StartRec-1, $saldo_rugilaba_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $saldo_rugilaba->TableCaption() ?>
&nbsp;&nbsp;<?php $saldo_rugilaba_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($saldo_rugilaba->Export == "" && $saldo_rugilaba->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(saldo_rugilaba_list);" style="text-decoration: none;"><img id="saldo_rugilaba_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="saldo_rugilaba_list_SearchPanel">
<form name="fsaldo_rugilabalistsrch" id="fsaldo_rugilabalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="saldo_rugilaba">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($saldo_rugilaba->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $saldo_rugilaba_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($saldo_rugilaba->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($saldo_rugilaba->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($saldo_rugilaba->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $saldo_rugilaba_list->ShowPageHeader(); ?>
<?php
$saldo_rugilaba_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($saldo_rugilaba->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($saldo_rugilaba->CurrentAction <> "gridadd" && $saldo_rugilaba->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($saldo_rugilaba_list->Pager)) $saldo_rugilaba_list->Pager = new cNumericPager($saldo_rugilaba_list->StartRec, $saldo_rugilaba_list->DisplayRecs, $saldo_rugilaba_list->TotalRecs, $saldo_rugilaba_list->RecRange) ?>
<?php if ($saldo_rugilaba_list->Pager->RecordCount > 0) { ?>
	<?php if ($saldo_rugilaba_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $saldo_rugilaba_list->PageUrl() ?>start=<?php echo $saldo_rugilaba_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($saldo_rugilaba_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $saldo_rugilaba_list->PageUrl() ?>start=<?php echo $saldo_rugilaba_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($saldo_rugilaba_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $saldo_rugilaba_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($saldo_rugilaba_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $saldo_rugilaba_list->PageUrl() ?>start=<?php echo $saldo_rugilaba_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($saldo_rugilaba_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $saldo_rugilaba_list->PageUrl() ?>start=<?php echo $saldo_rugilaba_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($saldo_rugilaba_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $saldo_rugilaba_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $saldo_rugilaba_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $saldo_rugilaba_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($saldo_rugilaba_list->SearchWhere == "0=101") { ?>
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
<?php if ($saldo_rugilaba_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="saldo_rugilaba">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($saldo_rugilaba_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($saldo_rugilaba_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($saldo_rugilaba_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($saldo_rugilaba_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($saldo_rugilaba_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($saldo_rugilaba_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($saldo_rugilaba_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($saldo_rugilaba_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($saldo_rugilaba_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
</span>
</div>
<?php } ?>
<form name="fsaldo_rugilabalist" id="fsaldo_rugilabalist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="saldo_rugilaba">
<div id="gmp_saldo_rugilaba" class="ewGridMiddlePanel">
<?php if ($saldo_rugilaba_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $saldo_rugilaba->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$saldo_rugilaba_list->RenderListOptions();

// Render list options (header, left)
$saldo_rugilaba_list->ListOptions->Render("header", "left");
?>
<?php if ($saldo_rugilaba->norek->Visible) { // norek ?>
	<?php if ($saldo_rugilaba->SortUrl($saldo_rugilaba->norek) == "") { ?>
		<td><?php echo $saldo_rugilaba->norek->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $saldo_rugilaba->SortUrl($saldo_rugilaba->norek) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $saldo_rugilaba->norek->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($saldo_rugilaba->norek->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($saldo_rugilaba->norek->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($saldo_rugilaba->keterangan->Visible) { // keterangan ?>
	<?php if ($saldo_rugilaba->SortUrl($saldo_rugilaba->keterangan) == "") { ?>
		<td><?php echo $saldo_rugilaba->keterangan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $saldo_rugilaba->SortUrl($saldo_rugilaba->keterangan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $saldo_rugilaba->keterangan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($saldo_rugilaba->keterangan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($saldo_rugilaba->keterangan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($saldo_rugilaba->tanggal->Visible) { // tanggal ?>
	<?php if ($saldo_rugilaba->SortUrl($saldo_rugilaba->tanggal) == "") { ?>
		<td><?php echo $saldo_rugilaba->tanggal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $saldo_rugilaba->SortUrl($saldo_rugilaba->tanggal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $saldo_rugilaba->tanggal->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($saldo_rugilaba->tanggal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($saldo_rugilaba->tanggal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($saldo_rugilaba->debet->Visible) { // debet ?>
	<?php if ($saldo_rugilaba->SortUrl($saldo_rugilaba->debet) == "") { ?>
		<td><?php echo $saldo_rugilaba->debet->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $saldo_rugilaba->SortUrl($saldo_rugilaba->debet) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $saldo_rugilaba->debet->FldCaption() ?></td><td style="width: 10px;"><?php if ($saldo_rugilaba->debet->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($saldo_rugilaba->debet->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($saldo_rugilaba->kredit->Visible) { // kredit ?>
	<?php if ($saldo_rugilaba->SortUrl($saldo_rugilaba->kredit) == "") { ?>
		<td><?php echo $saldo_rugilaba->kredit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $saldo_rugilaba->SortUrl($saldo_rugilaba->kredit) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $saldo_rugilaba->kredit->FldCaption() ?></td><td style="width: 10px;"><?php if ($saldo_rugilaba->kredit->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($saldo_rugilaba->kredit->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$saldo_rugilaba_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($saldo_rugilaba->ExportAll && $saldo_rugilaba->Export <> "") {
	$saldo_rugilaba_list->StopRec = $saldo_rugilaba_list->TotalRecs;
} else {

	// Set the last record to display
	if ($saldo_rugilaba_list->TotalRecs > $saldo_rugilaba_list->StartRec + $saldo_rugilaba_list->DisplayRecs - 1)
		$saldo_rugilaba_list->StopRec = $saldo_rugilaba_list->StartRec + $saldo_rugilaba_list->DisplayRecs - 1;
	else
		$saldo_rugilaba_list->StopRec = $saldo_rugilaba_list->TotalRecs;
}
$saldo_rugilaba_list->RecCnt = $saldo_rugilaba_list->StartRec - 1;
if ($saldo_rugilaba_list->Recordset && !$saldo_rugilaba_list->Recordset->EOF) {
	$saldo_rugilaba_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $saldo_rugilaba_list->StartRec > 1)
		$saldo_rugilaba_list->Recordset->Move($saldo_rugilaba_list->StartRec - 1);
} elseif (!$saldo_rugilaba->AllowAddDeleteRow && $saldo_rugilaba_list->StopRec == 0) {
	$saldo_rugilaba_list->StopRec = $saldo_rugilaba->GridAddRowCount;
}

// Initialize aggregate
$saldo_rugilaba->RowType = EW_ROWTYPE_AGGREGATEINIT;
$saldo_rugilaba->ResetAttrs();
$saldo_rugilaba_list->RenderRow();
$saldo_rugilaba_list->RowCnt = 0;
while ($saldo_rugilaba_list->RecCnt < $saldo_rugilaba_list->StopRec) {
	$saldo_rugilaba_list->RecCnt++;
	if (intval($saldo_rugilaba_list->RecCnt) >= intval($saldo_rugilaba_list->StartRec)) {
		$saldo_rugilaba_list->RowCnt++;

		// Set up key count
		$saldo_rugilaba_list->KeyCount = $saldo_rugilaba_list->RowIndex;

		// Init row class and style
		$saldo_rugilaba->ResetAttrs();
		$saldo_rugilaba->CssClass = "";
		if ($saldo_rugilaba->CurrentAction == "gridadd") {
		} else {
			$saldo_rugilaba_list->LoadRowValues($saldo_rugilaba_list->Recordset); // Load row values
		}
		$saldo_rugilaba->RowType = EW_ROWTYPE_VIEW; // Render view
		$saldo_rugilaba->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$saldo_rugilaba_list->RenderRow();

		// Render list options
		$saldo_rugilaba_list->RenderListOptions();
?>
	<tr<?php echo $saldo_rugilaba->RowAttributes() ?>>
<?php

// Render list options (body, left)
$saldo_rugilaba_list->ListOptions->Render("body", "left");
?>
	<?php if ($saldo_rugilaba->norek->Visible) { // norek ?>
		<td<?php echo $saldo_rugilaba->norek->CellAttributes() ?>>
<div<?php echo $saldo_rugilaba->norek->ViewAttributes() ?>><?php echo $saldo_rugilaba->norek->ListViewValue() ?></div>
<a name="<?php echo $saldo_rugilaba_list->PageObjName . "_row_" . $saldo_rugilaba_list->RowCnt ?>" id="<?php echo $saldo_rugilaba_list->PageObjName . "_row_" . $saldo_rugilaba_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($saldo_rugilaba->keterangan->Visible) { // keterangan ?>
		<td<?php echo $saldo_rugilaba->keterangan->CellAttributes() ?>>
<div<?php echo $saldo_rugilaba->keterangan->ViewAttributes() ?>><?php echo $saldo_rugilaba->keterangan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($saldo_rugilaba->tanggal->Visible) { // tanggal ?>
		<td<?php echo $saldo_rugilaba->tanggal->CellAttributes() ?>>
<div<?php echo $saldo_rugilaba->tanggal->ViewAttributes() ?>><?php echo $saldo_rugilaba->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($saldo_rugilaba->debet->Visible) { // debet ?>
		<td<?php echo $saldo_rugilaba->debet->CellAttributes() ?>>
<div<?php echo $saldo_rugilaba->debet->ViewAttributes() ?>><?php echo $saldo_rugilaba->debet->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($saldo_rugilaba->kredit->Visible) { // kredit ?>
		<td<?php echo $saldo_rugilaba->kredit->CellAttributes() ?>>
<div<?php echo $saldo_rugilaba->kredit->ViewAttributes() ?>><?php echo $saldo_rugilaba->kredit->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$saldo_rugilaba_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($saldo_rugilaba->CurrentAction <> "gridadd")
		$saldo_rugilaba_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($saldo_rugilaba_list->Recordset)
	$saldo_rugilaba_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($saldo_rugilaba->Export == "" && $saldo_rugilaba->CurrentAction == "") { ?>
<?php } ?>
<?php
$saldo_rugilaba_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($saldo_rugilaba->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$saldo_rugilaba_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csaldo_rugilaba_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'saldo_rugilaba';

	// Page object name
	var $PageObjName = 'saldo_rugilaba_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $saldo_rugilaba;
		if ($saldo_rugilaba->UseTokenInUrl) $PageUrl .= "t=" . $saldo_rugilaba->TableVar . "&"; // Add page token
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
		global $objForm, $saldo_rugilaba;
		if ($saldo_rugilaba->UseTokenInUrl) {
			if ($objForm)
				return ($saldo_rugilaba->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($saldo_rugilaba->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csaldo_rugilaba_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (saldo_rugilaba)
		if (!isset($GLOBALS["saldo_rugilaba"])) {
			$GLOBALS["saldo_rugilaba"] = new csaldo_rugilaba();
			$GLOBALS["Table"] =& $GLOBALS["saldo_rugilaba"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "saldo_rugilabaadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "saldo_rugilabadelete.php";
		$this->MultiUpdateUrl = "saldo_rugilabaupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'saldo_rugilaba', TRUE);

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
		global $saldo_rugilaba;

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
			$saldo_rugilaba->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $saldo_rugilaba;

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
			if ($saldo_rugilaba->Export <> "" ||
				$saldo_rugilaba->CurrentAction == "gridadd" ||
				$saldo_rugilaba->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$saldo_rugilaba->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($saldo_rugilaba->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $saldo_rugilaba->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$saldo_rugilaba->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$saldo_rugilaba->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$saldo_rugilaba->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $saldo_rugilaba->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$saldo_rugilaba->setSessionWhere($sFilter);
		$saldo_rugilaba->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $saldo_rugilaba;
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
			$saldo_rugilaba->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$saldo_rugilaba->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $saldo_rugilaba;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $saldo_rugilaba->norek, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $saldo_rugilaba->keterangan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $saldo_rugilaba->tanggal, $Keyword);
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
		global $Security, $saldo_rugilaba;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $saldo_rugilaba->BasicSearchKeyword;
		$sSearchType = $saldo_rugilaba->BasicSearchType;
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
			$saldo_rugilaba->setSessionBasicSearchKeyword($sSearchKeyword);
			$saldo_rugilaba->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $saldo_rugilaba;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$saldo_rugilaba->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $saldo_rugilaba;
		$saldo_rugilaba->setSessionBasicSearchKeyword("");
		$saldo_rugilaba->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $saldo_rugilaba;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$saldo_rugilaba->BasicSearchKeyword = $saldo_rugilaba->getSessionBasicSearchKeyword();
			$saldo_rugilaba->BasicSearchType = $saldo_rugilaba->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $saldo_rugilaba;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$saldo_rugilaba->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$saldo_rugilaba->CurrentOrderType = @$_GET["ordertype"];
			$saldo_rugilaba->UpdateSort($saldo_rugilaba->norek); // norek
			$saldo_rugilaba->UpdateSort($saldo_rugilaba->keterangan); // keterangan
			$saldo_rugilaba->UpdateSort($saldo_rugilaba->tanggal); // tanggal
			$saldo_rugilaba->UpdateSort($saldo_rugilaba->debet); // debet
			$saldo_rugilaba->UpdateSort($saldo_rugilaba->kredit); // kredit
			$saldo_rugilaba->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $saldo_rugilaba;
		$sOrderBy = $saldo_rugilaba->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($saldo_rugilaba->SqlOrderBy() <> "") {
				$sOrderBy = $saldo_rugilaba->SqlOrderBy();
				$saldo_rugilaba->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $saldo_rugilaba;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$saldo_rugilaba->setSessionOrderBy($sOrderBy);
				$saldo_rugilaba->norek->setSort("");
				$saldo_rugilaba->keterangan->setSort("");
				$saldo_rugilaba->tanggal->setSort("");
				$saldo_rugilaba->debet->setSort("");
				$saldo_rugilaba->kredit->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$saldo_rugilaba->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $saldo_rugilaba;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $saldo_rugilaba, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $saldo_rugilaba;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $saldo_rugilaba;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$saldo_rugilaba->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$saldo_rugilaba->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $saldo_rugilaba->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$saldo_rugilaba->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$saldo_rugilaba->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$saldo_rugilaba->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $saldo_rugilaba;
		$saldo_rugilaba->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$saldo_rugilaba->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $saldo_rugilaba;

		// Call Recordset Selecting event
		$saldo_rugilaba->Recordset_Selecting($saldo_rugilaba->CurrentFilter);

		// Load List page SQL
		$sSql = $saldo_rugilaba->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$saldo_rugilaba->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $saldo_rugilaba;
		$sFilter = $saldo_rugilaba->KeyFilter();

		// Call Row Selecting event
		$saldo_rugilaba->Row_Selecting($sFilter);

		// Load SQL based on filter
		$saldo_rugilaba->CurrentFilter = $sFilter;
		$sSql = $saldo_rugilaba->SQL();
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
		global $conn, $saldo_rugilaba;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$saldo_rugilaba->Row_Selected($row);
		$saldo_rugilaba->norek->setDbValue($rs->fields('norek'));
		$saldo_rugilaba->keterangan->setDbValue($rs->fields('keterangan'));
		$saldo_rugilaba->tanggal->setDbValue($rs->fields('tanggal'));
		$saldo_rugilaba->debet->setDbValue($rs->fields('debet'));
		$saldo_rugilaba->kredit->setDbValue($rs->fields('kredit'));
	}

	// Load old record
	function LoadOldRecord() {
		global $saldo_rugilaba;

		// Load key values from Session
		$bValidKey = TRUE;

		// Load old recordset
		if ($bValidKey) {
			$saldo_rugilaba->CurrentFilter = $saldo_rugilaba->KeyFilter();
			$sSql = $saldo_rugilaba->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $saldo_rugilaba;

		// Initialize URLs
		$this->ViewUrl = $saldo_rugilaba->ViewUrl();
		$this->EditUrl = $saldo_rugilaba->EditUrl();
		$this->InlineEditUrl = $saldo_rugilaba->InlineEditUrl();
		$this->CopyUrl = $saldo_rugilaba->CopyUrl();
		$this->InlineCopyUrl = $saldo_rugilaba->InlineCopyUrl();
		$this->DeleteUrl = $saldo_rugilaba->DeleteUrl();

		// Call Row_Rendering event
		$saldo_rugilaba->Row_Rendering();

		// Common render codes for all row types
		// norek
		// keterangan
		// tanggal
		// debet
		// kredit

		if ($saldo_rugilaba->RowType == EW_ROWTYPE_VIEW) { // View row

			// norek
			$saldo_rugilaba->norek->ViewValue = $saldo_rugilaba->norek->CurrentValue;
			$saldo_rugilaba->norek->ViewCustomAttributes = "";

			// keterangan
			$saldo_rugilaba->keterangan->ViewValue = $saldo_rugilaba->keterangan->CurrentValue;
			$saldo_rugilaba->keterangan->ViewCustomAttributes = "";

			// tanggal
			$saldo_rugilaba->tanggal->ViewValue = $saldo_rugilaba->tanggal->CurrentValue;
			$saldo_rugilaba->tanggal->ViewCustomAttributes = "";

			// debet
			$saldo_rugilaba->debet->ViewValue = $saldo_rugilaba->debet->CurrentValue;
			$saldo_rugilaba->debet->ViewCustomAttributes = "";

			// kredit
			$saldo_rugilaba->kredit->ViewValue = $saldo_rugilaba->kredit->CurrentValue;
			$saldo_rugilaba->kredit->ViewCustomAttributes = "";

			// norek
			$saldo_rugilaba->norek->LinkCustomAttributes = "";
			$saldo_rugilaba->norek->HrefValue = "";
			$saldo_rugilaba->norek->TooltipValue = "";

			// keterangan
			$saldo_rugilaba->keterangan->LinkCustomAttributes = "";
			$saldo_rugilaba->keterangan->HrefValue = "";
			$saldo_rugilaba->keterangan->TooltipValue = "";

			// tanggal
			$saldo_rugilaba->tanggal->LinkCustomAttributes = "";
			$saldo_rugilaba->tanggal->HrefValue = "";
			$saldo_rugilaba->tanggal->TooltipValue = "";

			// debet
			$saldo_rugilaba->debet->LinkCustomAttributes = "";
			$saldo_rugilaba->debet->HrefValue = "";
			$saldo_rugilaba->debet->TooltipValue = "";

			// kredit
			$saldo_rugilaba->kredit->LinkCustomAttributes = "";
			$saldo_rugilaba->kredit->HrefValue = "";
			$saldo_rugilaba->kredit->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($saldo_rugilaba->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$saldo_rugilaba->Row_Rendered();
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

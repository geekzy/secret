<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "lihat_peserta_kelompokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$lihat_peserta_kelompok_list = new clihat_peserta_kelompok_list();
$Page =& $lihat_peserta_kelompok_list;

// Page init
$lihat_peserta_kelompok_list->Page_Init();

// Page main
$lihat_peserta_kelompok_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($lihat_peserta_kelompok->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var lihat_peserta_kelompok_list = new ew_Page("lihat_peserta_kelompok_list");

// page properties
lihat_peserta_kelompok_list.PageID = "list"; // page ID
lihat_peserta_kelompok_list.FormID = "flihat_peserta_kelompoklist"; // form ID
var EW_PAGE_ID = lihat_peserta_kelompok_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
lihat_peserta_kelompok_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
lihat_peserta_kelompok_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
lihat_peserta_kelompok_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($lihat_peserta_kelompok->Export == "") || (EW_EXPORT_MASTER_RECORD && $lihat_peserta_kelompok->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$lihat_peserta_kelompok_list->TotalRecs = $lihat_peserta_kelompok->SelectRecordCount();
	} else {
		if ($lihat_peserta_kelompok_list->Recordset = $lihat_peserta_kelompok_list->LoadRecordset())
			$lihat_peserta_kelompok_list->TotalRecs = $lihat_peserta_kelompok_list->Recordset->RecordCount();
	}
	$lihat_peserta_kelompok_list->StartRec = 1;
	if ($lihat_peserta_kelompok_list->DisplayRecs <= 0 || ($lihat_peserta_kelompok->Export <> "" && $lihat_peserta_kelompok->ExportAll)) // Display all records
		$lihat_peserta_kelompok_list->DisplayRecs = $lihat_peserta_kelompok_list->TotalRecs;
	if (!($lihat_peserta_kelompok->Export <> "" && $lihat_peserta_kelompok->ExportAll))
		$lihat_peserta_kelompok_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$lihat_peserta_kelompok_list->Recordset = $lihat_peserta_kelompok_list->LoadRecordset($lihat_peserta_kelompok_list->StartRec-1, $lihat_peserta_kelompok_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $lihat_peserta_kelompok->TableCaption() ?>
&nbsp;&nbsp;<?php $lihat_peserta_kelompok_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($lihat_peserta_kelompok->Export == "" && $lihat_peserta_kelompok->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(lihat_peserta_kelompok_list);" style="text-decoration: none;"><img id="lihat_peserta_kelompok_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="lihat_peserta_kelompok_list_SearchPanel">
<form name="flihat_peserta_kelompoklistsrch" id="flihat_peserta_kelompoklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="lihat_peserta_kelompok">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($lihat_peserta_kelompok->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $lihat_peserta_kelompok_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($lihat_peserta_kelompok->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($lihat_peserta_kelompok->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($lihat_peserta_kelompok->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $lihat_peserta_kelompok_list->ShowPageHeader(); ?>
<?php
$lihat_peserta_kelompok_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($lihat_peserta_kelompok->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($lihat_peserta_kelompok->CurrentAction <> "gridadd" && $lihat_peserta_kelompok->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($lihat_peserta_kelompok_list->Pager)) $lihat_peserta_kelompok_list->Pager = new cNumericPager($lihat_peserta_kelompok_list->StartRec, $lihat_peserta_kelompok_list->DisplayRecs, $lihat_peserta_kelompok_list->TotalRecs, $lihat_peserta_kelompok_list->RecRange) ?>
<?php if ($lihat_peserta_kelompok_list->Pager->RecordCount > 0) { ?>
	<?php if ($lihat_peserta_kelompok_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $lihat_peserta_kelompok_list->PageUrl() ?>start=<?php echo $lihat_peserta_kelompok_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($lihat_peserta_kelompok_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $lihat_peserta_kelompok_list->PageUrl() ?>start=<?php echo $lihat_peserta_kelompok_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($lihat_peserta_kelompok_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $lihat_peserta_kelompok_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($lihat_peserta_kelompok_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $lihat_peserta_kelompok_list->PageUrl() ?>start=<?php echo $lihat_peserta_kelompok_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($lihat_peserta_kelompok_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $lihat_peserta_kelompok_list->PageUrl() ?>start=<?php echo $lihat_peserta_kelompok_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($lihat_peserta_kelompok_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $lihat_peserta_kelompok_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $lihat_peserta_kelompok_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $lihat_peserta_kelompok_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($lihat_peserta_kelompok_list->SearchWhere == "0=101") { ?>
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
<?php if ($lihat_peserta_kelompok_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="lihat_peserta_kelompok">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($lihat_peserta_kelompok_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($lihat_peserta_kelompok_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($lihat_peserta_kelompok_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($lihat_peserta_kelompok_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($lihat_peserta_kelompok_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($lihat_peserta_kelompok_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($lihat_peserta_kelompok_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($lihat_peserta_kelompok_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($lihat_peserta_kelompok_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
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
<form name="flihat_peserta_kelompoklist" id="flihat_peserta_kelompoklist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="lihat_peserta_kelompok">
<div id="gmp_lihat_peserta_kelompok" class="ewGridMiddlePanel">
<?php if ($lihat_peserta_kelompok_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $lihat_peserta_kelompok->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$lihat_peserta_kelompok_list->RenderListOptions();

// Render list options (header, left)
$lihat_peserta_kelompok_list->ListOptions->Render("header", "left");
?>
<?php if ($lihat_peserta_kelompok->kode_otomatis_kelompok->Visible) { // kode_otomatis_kelompok ?>
	<?php if ($lihat_peserta_kelompok->SortUrl($lihat_peserta_kelompok->kode_otomatis_kelompok) == "") { ?>
		<td><?php echo $lihat_peserta_kelompok->kode_otomatis_kelompok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $lihat_peserta_kelompok->SortUrl($lihat_peserta_kelompok->kode_otomatis_kelompok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $lihat_peserta_kelompok->kode_otomatis_kelompok->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($lihat_peserta_kelompok->kode_otomatis_kelompok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($lihat_peserta_kelompok->kode_otomatis_kelompok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($lihat_peserta_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($lihat_peserta_kelompok->SortUrl($lihat_peserta_kelompok->kode_otomatis) == "") { ?>
		<td><?php echo $lihat_peserta_kelompok->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $lihat_peserta_kelompok->SortUrl($lihat_peserta_kelompok->kode_otomatis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $lihat_peserta_kelompok->kode_otomatis->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($lihat_peserta_kelompok->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($lihat_peserta_kelompok->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($lihat_peserta_kelompok->identitas->Visible) { // identitas ?>
	<?php if ($lihat_peserta_kelompok->SortUrl($lihat_peserta_kelompok->identitas) == "") { ?>
		<td><?php echo $lihat_peserta_kelompok->identitas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $lihat_peserta_kelompok->SortUrl($lihat_peserta_kelompok->identitas) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $lihat_peserta_kelompok->identitas->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($lihat_peserta_kelompok->identitas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($lihat_peserta_kelompok->identitas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$lihat_peserta_kelompok_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($lihat_peserta_kelompok->ExportAll && $lihat_peserta_kelompok->Export <> "") {
	$lihat_peserta_kelompok_list->StopRec = $lihat_peserta_kelompok_list->TotalRecs;
} else {

	// Set the last record to display
	if ($lihat_peserta_kelompok_list->TotalRecs > $lihat_peserta_kelompok_list->StartRec + $lihat_peserta_kelompok_list->DisplayRecs - 1)
		$lihat_peserta_kelompok_list->StopRec = $lihat_peserta_kelompok_list->StartRec + $lihat_peserta_kelompok_list->DisplayRecs - 1;
	else
		$lihat_peserta_kelompok_list->StopRec = $lihat_peserta_kelompok_list->TotalRecs;
}
$lihat_peserta_kelompok_list->RecCnt = $lihat_peserta_kelompok_list->StartRec - 1;
if ($lihat_peserta_kelompok_list->Recordset && !$lihat_peserta_kelompok_list->Recordset->EOF) {
	$lihat_peserta_kelompok_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $lihat_peserta_kelompok_list->StartRec > 1)
		$lihat_peserta_kelompok_list->Recordset->Move($lihat_peserta_kelompok_list->StartRec - 1);
} elseif (!$lihat_peserta_kelompok->AllowAddDeleteRow && $lihat_peserta_kelompok_list->StopRec == 0) {
	$lihat_peserta_kelompok_list->StopRec = $lihat_peserta_kelompok->GridAddRowCount;
}

// Initialize aggregate
$lihat_peserta_kelompok->RowType = EW_ROWTYPE_AGGREGATEINIT;
$lihat_peserta_kelompok->ResetAttrs();
$lihat_peserta_kelompok_list->RenderRow();
$lihat_peserta_kelompok_list->RowCnt = 0;
while ($lihat_peserta_kelompok_list->RecCnt < $lihat_peserta_kelompok_list->StopRec) {
	$lihat_peserta_kelompok_list->RecCnt++;
	if (intval($lihat_peserta_kelompok_list->RecCnt) >= intval($lihat_peserta_kelompok_list->StartRec)) {
		$lihat_peserta_kelompok_list->RowCnt++;

		// Set up key count
		$lihat_peserta_kelompok_list->KeyCount = $lihat_peserta_kelompok_list->RowIndex;

		// Init row class and style
		$lihat_peserta_kelompok->ResetAttrs();
		$lihat_peserta_kelompok->CssClass = "";
		if ($lihat_peserta_kelompok->CurrentAction == "gridadd") {
		} else {
			$lihat_peserta_kelompok_list->LoadRowValues($lihat_peserta_kelompok_list->Recordset); // Load row values
		}
		$lihat_peserta_kelompok->RowType = EW_ROWTYPE_VIEW; // Render view
		$lihat_peserta_kelompok->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$lihat_peserta_kelompok_list->RenderRow();

		// Render list options
		$lihat_peserta_kelompok_list->RenderListOptions();
?>
	<tr<?php echo $lihat_peserta_kelompok->RowAttributes() ?>>
<?php

// Render list options (body, left)
$lihat_peserta_kelompok_list->ListOptions->Render("body", "left");
?>
	<?php if ($lihat_peserta_kelompok->kode_otomatis_kelompok->Visible) { // kode_otomatis_kelompok ?>
		<td<?php echo $lihat_peserta_kelompok->kode_otomatis_kelompok->CellAttributes() ?>>
<div<?php echo $lihat_peserta_kelompok->kode_otomatis_kelompok->ViewAttributes() ?>><?php echo $lihat_peserta_kelompok->kode_otomatis_kelompok->ListViewValue() ?></div>
<a name="<?php echo $lihat_peserta_kelompok_list->PageObjName . "_row_" . $lihat_peserta_kelompok_list->RowCnt ?>" id="<?php echo $lihat_peserta_kelompok_list->PageObjName . "_row_" . $lihat_peserta_kelompok_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($lihat_peserta_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $lihat_peserta_kelompok->kode_otomatis->CellAttributes() ?>>
<div<?php echo $lihat_peserta_kelompok->kode_otomatis->ViewAttributes() ?>><?php echo $lihat_peserta_kelompok->kode_otomatis->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($lihat_peserta_kelompok->identitas->Visible) { // identitas ?>
		<td<?php echo $lihat_peserta_kelompok->identitas->CellAttributes() ?>>
<div<?php echo $lihat_peserta_kelompok->identitas->ViewAttributes() ?>><?php echo $lihat_peserta_kelompok->identitas->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$lihat_peserta_kelompok_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($lihat_peserta_kelompok->CurrentAction <> "gridadd")
		$lihat_peserta_kelompok_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($lihat_peserta_kelompok_list->Recordset)
	$lihat_peserta_kelompok_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($lihat_peserta_kelompok->Export == "" && $lihat_peserta_kelompok->CurrentAction == "") { ?>
<?php } ?>
<?php
$lihat_peserta_kelompok_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($lihat_peserta_kelompok->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$lihat_peserta_kelompok_list->Page_Terminate();
?>
<?php

//
// Page class
//
class clihat_peserta_kelompok_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'lihat_peserta_kelompok';

	// Page object name
	var $PageObjName = 'lihat_peserta_kelompok_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $lihat_peserta_kelompok;
		if ($lihat_peserta_kelompok->UseTokenInUrl) $PageUrl .= "t=" . $lihat_peserta_kelompok->TableVar . "&"; // Add page token
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
		global $objForm, $lihat_peserta_kelompok;
		if ($lihat_peserta_kelompok->UseTokenInUrl) {
			if ($objForm)
				return ($lihat_peserta_kelompok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($lihat_peserta_kelompok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function clihat_peserta_kelompok_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (lihat_peserta_kelompok)
		if (!isset($GLOBALS["lihat_peserta_kelompok"])) {
			$GLOBALS["lihat_peserta_kelompok"] = new clihat_peserta_kelompok();
			$GLOBALS["Table"] =& $GLOBALS["lihat_peserta_kelompok"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "lihat_peserta_kelompokadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "lihat_peserta_kelompokdelete.php";
		$this->MultiUpdateUrl = "lihat_peserta_kelompokupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'lihat_peserta_kelompok', TRUE);

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
		global $lihat_peserta_kelompok;

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
			$lihat_peserta_kelompok->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $lihat_peserta_kelompok;

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
			if ($lihat_peserta_kelompok->Export <> "" ||
				$lihat_peserta_kelompok->CurrentAction == "gridadd" ||
				$lihat_peserta_kelompok->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$lihat_peserta_kelompok->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($lihat_peserta_kelompok->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $lihat_peserta_kelompok->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$lihat_peserta_kelompok->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$lihat_peserta_kelompok->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$lihat_peserta_kelompok->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $lihat_peserta_kelompok->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$lihat_peserta_kelompok->setSessionWhere($sFilter);
		$lihat_peserta_kelompok->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $lihat_peserta_kelompok;
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
			$lihat_peserta_kelompok->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$lihat_peserta_kelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $lihat_peserta_kelompok;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $lihat_peserta_kelompok->kode_otomatis_kelompok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $lihat_peserta_kelompok->kode_otomatis, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $lihat_peserta_kelompok->identitas, $Keyword);
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
		global $Security, $lihat_peserta_kelompok;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $lihat_peserta_kelompok->BasicSearchKeyword;
		$sSearchType = $lihat_peserta_kelompok->BasicSearchType;
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
			$lihat_peserta_kelompok->setSessionBasicSearchKeyword($sSearchKeyword);
			$lihat_peserta_kelompok->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $lihat_peserta_kelompok;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$lihat_peserta_kelompok->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $lihat_peserta_kelompok;
		$lihat_peserta_kelompok->setSessionBasicSearchKeyword("");
		$lihat_peserta_kelompok->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $lihat_peserta_kelompok;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$lihat_peserta_kelompok->BasicSearchKeyword = $lihat_peserta_kelompok->getSessionBasicSearchKeyword();
			$lihat_peserta_kelompok->BasicSearchType = $lihat_peserta_kelompok->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $lihat_peserta_kelompok;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$lihat_peserta_kelompok->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$lihat_peserta_kelompok->CurrentOrderType = @$_GET["ordertype"];
			$lihat_peserta_kelompok->UpdateSort($lihat_peserta_kelompok->kode_otomatis_kelompok); // kode_otomatis_kelompok
			$lihat_peserta_kelompok->UpdateSort($lihat_peserta_kelompok->kode_otomatis); // kode_otomatis
			$lihat_peserta_kelompok->UpdateSort($lihat_peserta_kelompok->identitas); // identitas
			$lihat_peserta_kelompok->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $lihat_peserta_kelompok;
		$sOrderBy = $lihat_peserta_kelompok->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($lihat_peserta_kelompok->SqlOrderBy() <> "") {
				$sOrderBy = $lihat_peserta_kelompok->SqlOrderBy();
				$lihat_peserta_kelompok->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $lihat_peserta_kelompok;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$lihat_peserta_kelompok->setSessionOrderBy($sOrderBy);
				$lihat_peserta_kelompok->kode_otomatis_kelompok->setSort("");
				$lihat_peserta_kelompok->kode_otomatis->setSort("");
				$lihat_peserta_kelompok->identitas->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$lihat_peserta_kelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $lihat_peserta_kelompok;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $lihat_peserta_kelompok, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $lihat_peserta_kelompok;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $lihat_peserta_kelompok;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$lihat_peserta_kelompok->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$lihat_peserta_kelompok->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $lihat_peserta_kelompok->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$lihat_peserta_kelompok->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$lihat_peserta_kelompok->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$lihat_peserta_kelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $lihat_peserta_kelompok;
		$lihat_peserta_kelompok->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$lihat_peserta_kelompok->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $lihat_peserta_kelompok;

		// Call Recordset Selecting event
		$lihat_peserta_kelompok->Recordset_Selecting($lihat_peserta_kelompok->CurrentFilter);

		// Load List page SQL
		$sSql = $lihat_peserta_kelompok->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$lihat_peserta_kelompok->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $lihat_peserta_kelompok;
		$sFilter = $lihat_peserta_kelompok->KeyFilter();

		// Call Row Selecting event
		$lihat_peserta_kelompok->Row_Selecting($sFilter);

		// Load SQL based on filter
		$lihat_peserta_kelompok->CurrentFilter = $sFilter;
		$sSql = $lihat_peserta_kelompok->SQL();
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
		global $conn, $lihat_peserta_kelompok;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$lihat_peserta_kelompok->Row_Selected($row);
		$lihat_peserta_kelompok->kode_otomatis_kelompok->setDbValue($rs->fields('kode_otomatis_kelompok'));
		$lihat_peserta_kelompok->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$lihat_peserta_kelompok->identitas->setDbValue($rs->fields('identitas'));
	}

	// Load old record
	function LoadOldRecord() {
		global $lihat_peserta_kelompok;

		// Load key values from Session
		$bValidKey = TRUE;

		// Load old recordset
		if ($bValidKey) {
			$lihat_peserta_kelompok->CurrentFilter = $lihat_peserta_kelompok->KeyFilter();
			$sSql = $lihat_peserta_kelompok->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $lihat_peserta_kelompok;

		// Initialize URLs
		$this->ViewUrl = $lihat_peserta_kelompok->ViewUrl();
		$this->EditUrl = $lihat_peserta_kelompok->EditUrl();
		$this->InlineEditUrl = $lihat_peserta_kelompok->InlineEditUrl();
		$this->CopyUrl = $lihat_peserta_kelompok->CopyUrl();
		$this->InlineCopyUrl = $lihat_peserta_kelompok->InlineCopyUrl();
		$this->DeleteUrl = $lihat_peserta_kelompok->DeleteUrl();

		// Call Row_Rendering event
		$lihat_peserta_kelompok->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis_kelompok
		// kode_otomatis
		// identitas

		if ($lihat_peserta_kelompok->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_otomatis_kelompok
			$lihat_peserta_kelompok->kode_otomatis_kelompok->ViewValue = $lihat_peserta_kelompok->kode_otomatis_kelompok->CurrentValue;
			$lihat_peserta_kelompok->kode_otomatis_kelompok->ViewCustomAttributes = "";

			// kode_otomatis
			$lihat_peserta_kelompok->kode_otomatis->ViewValue = $lihat_peserta_kelompok->kode_otomatis->CurrentValue;
			$lihat_peserta_kelompok->kode_otomatis->ViewCustomAttributes = "";

			// identitas
			$lihat_peserta_kelompok->identitas->ViewValue = $lihat_peserta_kelompok->identitas->CurrentValue;
			$lihat_peserta_kelompok->identitas->ViewCustomAttributes = "";

			// kode_otomatis_kelompok
			$lihat_peserta_kelompok->kode_otomatis_kelompok->LinkCustomAttributes = "";
			$lihat_peserta_kelompok->kode_otomatis_kelompok->HrefValue = "";
			$lihat_peserta_kelompok->kode_otomatis_kelompok->TooltipValue = "";

			// kode_otomatis
			$lihat_peserta_kelompok->kode_otomatis->LinkCustomAttributes = "";
			$lihat_peserta_kelompok->kode_otomatis->HrefValue = "";
			$lihat_peserta_kelompok->kode_otomatis->TooltipValue = "";

			// identitas
			$lihat_peserta_kelompok->identitas->LinkCustomAttributes = "";
			$lihat_peserta_kelompok->identitas->HrefValue = "";
			$lihat_peserta_kelompok->identitas->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($lihat_peserta_kelompok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$lihat_peserta_kelompok->Row_Rendered();
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

<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subduarekinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subduarek_list = new csubduarek_list();
$Page =& $subduarek_list;

// Page init
$subduarek_list->Page_Init();

// Page main
$subduarek_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($subduarek->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subduarek_list = new ew_Page("subduarek_list");

// page properties
subduarek_list.PageID = "list"; // page ID
subduarek_list.FormID = "fsubduareklist"; // form ID
var EW_PAGE_ID = subduarek_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subduarek_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
subduarek_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subduarek_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($subduarek->Export == "") || (EW_EXPORT_MASTER_RECORD && $subduarek->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$subduarek_list->TotalRecs = $subduarek->SelectRecordCount();
	} else {
		if ($subduarek_list->Recordset = $subduarek_list->LoadRecordset())
			$subduarek_list->TotalRecs = $subduarek_list->Recordset->RecordCount();
	}
	$subduarek_list->StartRec = 1;
	if ($subduarek_list->DisplayRecs <= 0 || ($subduarek->Export <> "" && $subduarek->ExportAll)) // Display all records
		$subduarek_list->DisplayRecs = $subduarek_list->TotalRecs;
	if (!($subduarek->Export <> "" && $subduarek->ExportAll))
		$subduarek_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$subduarek_list->Recordset = $subduarek_list->LoadRecordset($subduarek_list->StartRec-1, $subduarek_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subduarek->TableCaption() ?>
&nbsp;&nbsp;<?php $subduarek_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($subduarek->Export == "" && $subduarek->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(subduarek_list);" style="text-decoration: none;"><img id="subduarek_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="subduarek_list_SearchPanel">
<form name="fsubduareklistsrch" id="fsubduareklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="subduarek">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($subduarek->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $subduarek_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($subduarek->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($subduarek->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($subduarek->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $subduarek_list->ShowPageHeader(); ?>
<?php
$subduarek_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($subduarek->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($subduarek->CurrentAction <> "gridadd" && $subduarek->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($subduarek_list->Pager)) $subduarek_list->Pager = new cNumericPager($subduarek_list->StartRec, $subduarek_list->DisplayRecs, $subduarek_list->TotalRecs, $subduarek_list->RecRange) ?>
<?php if ($subduarek_list->Pager->RecordCount > 0) { ?>
	<?php if ($subduarek_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $subduarek_list->PageUrl() ?>start=<?php echo $subduarek_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($subduarek_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $subduarek_list->PageUrl() ?>start=<?php echo $subduarek_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($subduarek_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $subduarek_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($subduarek_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $subduarek_list->PageUrl() ?>start=<?php echo $subduarek_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($subduarek_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $subduarek_list->PageUrl() ?>start=<?php echo $subduarek_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($subduarek_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subduarek_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subduarek_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subduarek_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($subduarek_list->SearchWhere == "0=101") { ?>
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
<?php if ($subduarek_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subduarek">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($subduarek_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($subduarek_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($subduarek_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($subduarek_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subduarek_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($subduarek_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($subduarek_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($subduarek_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($subduarek_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $subduarek_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fsubduareklist" id="fsubduareklist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="subduarek">
<div id="gmp_subduarek" class="ewGridMiddlePanel">
<?php if ($subduarek_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $subduarek->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$subduarek_list->RenderListOptions();

// Render list options (header, left)
$subduarek_list->ListOptions->Render("header", "left");
?>
<?php if ($subduarek->kodePokok->Visible) { // kodePokok ?>
	<?php if ($subduarek->SortUrl($subduarek->kodePokok) == "") { ?>
		<td><?php echo $subduarek->kodePokok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subduarek->SortUrl($subduarek->kodePokok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subduarek->kodePokok->FldCaption() ?></td><td style="width: 10px;"><?php if ($subduarek->kodePokok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subduarek->kodePokok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subduarek->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<?php if ($subduarek->SortUrl($subduarek->kodeSubSatu) == "") { ?>
		<td><?php echo $subduarek->kodeSubSatu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subduarek->SortUrl($subduarek->kodeSubSatu) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subduarek->kodeSubSatu->FldCaption() ?></td><td style="width: 10px;"><?php if ($subduarek->kodeSubSatu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subduarek->kodeSubSatu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subduarek->kodeSubDua->Visible) { // kodeSubDua ?>
	<?php if ($subduarek->SortUrl($subduarek->kodeSubDua) == "") { ?>
		<td><?php echo $subduarek->kodeSubDua->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subduarek->SortUrl($subduarek->kodeSubDua) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subduarek->kodeSubDua->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subduarek->kodeSubDua->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subduarek->kodeSubDua->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subduarek->namaSubDua->Visible) { // namaSubDua ?>
	<?php if ($subduarek->SortUrl($subduarek->namaSubDua) == "") { ?>
		<td><?php echo $subduarek->namaSubDua->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subduarek->SortUrl($subduarek->namaSubDua) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subduarek->namaSubDua->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subduarek->namaSubDua->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subduarek->namaSubDua->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subduarek->id->Visible) { // id ?>
	<?php if ($subduarek->SortUrl($subduarek->id) == "") { ?>
		<td><?php echo $subduarek->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subduarek->SortUrl($subduarek->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subduarek->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($subduarek->id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subduarek->id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$subduarek_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($subduarek->ExportAll && $subduarek->Export <> "") {
	$subduarek_list->StopRec = $subduarek_list->TotalRecs;
} else {

	// Set the last record to display
	if ($subduarek_list->TotalRecs > $subduarek_list->StartRec + $subduarek_list->DisplayRecs - 1)
		$subduarek_list->StopRec = $subduarek_list->StartRec + $subduarek_list->DisplayRecs - 1;
	else
		$subduarek_list->StopRec = $subduarek_list->TotalRecs;
}
$subduarek_list->RecCnt = $subduarek_list->StartRec - 1;
if ($subduarek_list->Recordset && !$subduarek_list->Recordset->EOF) {
	$subduarek_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $subduarek_list->StartRec > 1)
		$subduarek_list->Recordset->Move($subduarek_list->StartRec - 1);
} elseif (!$subduarek->AllowAddDeleteRow && $subduarek_list->StopRec == 0) {
	$subduarek_list->StopRec = $subduarek->GridAddRowCount;
}

// Initialize aggregate
$subduarek->RowType = EW_ROWTYPE_AGGREGATEINIT;
$subduarek->ResetAttrs();
$subduarek_list->RenderRow();
$subduarek_list->RowCnt = 0;
while ($subduarek_list->RecCnt < $subduarek_list->StopRec) {
	$subduarek_list->RecCnt++;
	if (intval($subduarek_list->RecCnt) >= intval($subduarek_list->StartRec)) {
		$subduarek_list->RowCnt++;

		// Set up key count
		$subduarek_list->KeyCount = $subduarek_list->RowIndex;

		// Init row class and style
		$subduarek->ResetAttrs();
		$subduarek->CssClass = "";
		if ($subduarek->CurrentAction == "gridadd") {
		} else {
			$subduarek_list->LoadRowValues($subduarek_list->Recordset); // Load row values
		}
		$subduarek->RowType = EW_ROWTYPE_VIEW; // Render view
		$subduarek->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$subduarek_list->RenderRow();

		// Render list options
		$subduarek_list->RenderListOptions();
?>
	<tr<?php echo $subduarek->RowAttributes() ?>>
<?php

// Render list options (body, left)
$subduarek_list->ListOptions->Render("body", "left");
?>
	<?php if ($subduarek->kodePokok->Visible) { // kodePokok ?>
		<td<?php echo $subduarek->kodePokok->CellAttributes() ?>>
<div<?php echo $subduarek->kodePokok->ViewAttributes() ?>><?php echo $subduarek->kodePokok->ListViewValue() ?></div>
<a name="<?php echo $subduarek_list->PageObjName . "_row_" . $subduarek_list->RowCnt ?>" id="<?php echo $subduarek_list->PageObjName . "_row_" . $subduarek_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($subduarek->kodeSubSatu->Visible) { // kodeSubSatu ?>
		<td<?php echo $subduarek->kodeSubSatu->CellAttributes() ?>>
<div<?php echo $subduarek->kodeSubSatu->ViewAttributes() ?>><?php echo $subduarek->kodeSubSatu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subduarek->kodeSubDua->Visible) { // kodeSubDua ?>
		<td<?php echo $subduarek->kodeSubDua->CellAttributes() ?>>
<div<?php echo $subduarek->kodeSubDua->ViewAttributes() ?>><?php echo $subduarek->kodeSubDua->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subduarek->namaSubDua->Visible) { // namaSubDua ?>
		<td<?php echo $subduarek->namaSubDua->CellAttributes() ?>>
<div<?php echo $subduarek->namaSubDua->ViewAttributes() ?>><?php echo $subduarek->namaSubDua->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subduarek->id->Visible) { // id ?>
		<td<?php echo $subduarek->id->CellAttributes() ?>>
<div<?php echo $subduarek->id->ViewAttributes() ?>><?php echo $subduarek->id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subduarek_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($subduarek->CurrentAction <> "gridadd")
		$subduarek_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($subduarek_list->Recordset)
	$subduarek_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($subduarek->Export == "" && $subduarek->CurrentAction == "") { ?>
<?php } ?>
<?php
$subduarek_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($subduarek->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$subduarek_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csubduarek_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'subduarek';

	// Page object name
	var $PageObjName = 'subduarek_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subduarek;
		if ($subduarek->UseTokenInUrl) $PageUrl .= "t=" . $subduarek->TableVar . "&"; // Add page token
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
		global $objForm, $subduarek;
		if ($subduarek->UseTokenInUrl) {
			if ($objForm)
				return ($subduarek->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subduarek->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubduarek_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subduarek)
		if (!isset($GLOBALS["subduarek"])) {
			$GLOBALS["subduarek"] = new csubduarek();
			$GLOBALS["Table"] =& $GLOBALS["subduarek"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "subduarekadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "subduarekdelete.php";
		$this->MultiUpdateUrl = "subduarekupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subduarek', TRUE);

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
		global $subduarek;

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
			$subduarek->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $subduarek;

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
			if ($subduarek->Export <> "" ||
				$subduarek->CurrentAction == "gridadd" ||
				$subduarek->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$subduarek->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($subduarek->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $subduarek->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$subduarek->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$subduarek->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$subduarek->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $subduarek->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$subduarek->setSessionWhere($sFilter);
		$subduarek->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $subduarek;
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
			$subduarek->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$subduarek->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $subduarek;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $subduarek->kodePokok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subduarek->kodeSubSatu, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subduarek->kodeSubDua, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subduarek->namaSubDua, $Keyword);
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
		global $Security, $subduarek;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $subduarek->BasicSearchKeyword;
		$sSearchType = $subduarek->BasicSearchType;
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
			$subduarek->setSessionBasicSearchKeyword($sSearchKeyword);
			$subduarek->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $subduarek;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$subduarek->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $subduarek;
		$subduarek->setSessionBasicSearchKeyword("");
		$subduarek->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $subduarek;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$subduarek->BasicSearchKeyword = $subduarek->getSessionBasicSearchKeyword();
			$subduarek->BasicSearchType = $subduarek->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $subduarek;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$subduarek->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$subduarek->CurrentOrderType = @$_GET["ordertype"];
			$subduarek->UpdateSort($subduarek->kodePokok); // kodePokok
			$subduarek->UpdateSort($subduarek->kodeSubSatu); // kodeSubSatu
			$subduarek->UpdateSort($subduarek->kodeSubDua); // kodeSubDua
			$subduarek->UpdateSort($subduarek->namaSubDua); // namaSubDua
			$subduarek->UpdateSort($subduarek->id); // id
			$subduarek->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $subduarek;
		$sOrderBy = $subduarek->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($subduarek->SqlOrderBy() <> "") {
				$sOrderBy = $subduarek->SqlOrderBy();
				$subduarek->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $subduarek;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$subduarek->setSessionOrderBy($sOrderBy);
				$subduarek->kodePokok->setSort("");
				$subduarek->kodeSubSatu->setSort("");
				$subduarek->kodeSubDua->setSort("");
				$subduarek->namaSubDua->setSort("");
				$subduarek->id->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$subduarek->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $subduarek;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $subduarek, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $subduarek;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subduarek;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$subduarek->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$subduarek->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $subduarek->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$subduarek->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$subduarek->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$subduarek->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $subduarek;
		$subduarek->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$subduarek->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subduarek;

		// Call Recordset Selecting event
		$subduarek->Recordset_Selecting($subduarek->CurrentFilter);

		// Load List page SQL
		$sSql = $subduarek->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subduarek->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subduarek;
		$sFilter = $subduarek->KeyFilter();

		// Call Row Selecting event
		$subduarek->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subduarek->CurrentFilter = $sFilter;
		$sSql = $subduarek->SQL();
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
		global $conn, $subduarek;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subduarek->Row_Selected($row);
		$subduarek->kodePokok->setDbValue($rs->fields('kodePokok'));
		$subduarek->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$subduarek->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$subduarek->namaSubDua->setDbValue($rs->fields('namaSubDua'));
		$subduarek->id->setDbValue($rs->fields('id'));
	}

	// Load old record
	function LoadOldRecord() {
		global $subduarek;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($subduarek->getKey("id")) <> "")
			$subduarek->id->CurrentValue = $subduarek->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$subduarek->CurrentFilter = $subduarek->KeyFilter();
			$sSql = $subduarek->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subduarek;

		// Initialize URLs
		$this->ViewUrl = $subduarek->ViewUrl();
		$this->EditUrl = $subduarek->EditUrl();
		$this->InlineEditUrl = $subduarek->InlineEditUrl();
		$this->CopyUrl = $subduarek->CopyUrl();
		$this->InlineCopyUrl = $subduarek->InlineCopyUrl();
		$this->DeleteUrl = $subduarek->DeleteUrl();

		// Call Row_Rendering event
		$subduarek->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// kodeSubSatu
		// kodeSubDua
		// namaSubDua
		// id

		if ($subduarek->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			$subduarek->kodePokok->ViewValue = $subduarek->kodePokok->CurrentValue;
			$subduarek->kodePokok->ViewCustomAttributes = "";

			// kodeSubSatu
			$subduarek->kodeSubSatu->ViewValue = $subduarek->kodeSubSatu->CurrentValue;
			$subduarek->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubDua
			$subduarek->kodeSubDua->ViewValue = $subduarek->kodeSubDua->CurrentValue;
			$subduarek->kodeSubDua->ViewCustomAttributes = "";

			// namaSubDua
			$subduarek->namaSubDua->ViewValue = $subduarek->namaSubDua->CurrentValue;
			$subduarek->namaSubDua->ViewCustomAttributes = "";

			// id
			$subduarek->id->ViewValue = $subduarek->id->CurrentValue;
			$subduarek->id->ViewCustomAttributes = "";

			// kodePokok
			$subduarek->kodePokok->LinkCustomAttributes = "";
			$subduarek->kodePokok->HrefValue = "";
			$subduarek->kodePokok->TooltipValue = "";

			// kodeSubSatu
			$subduarek->kodeSubSatu->LinkCustomAttributes = "";
			$subduarek->kodeSubSatu->HrefValue = "";
			$subduarek->kodeSubSatu->TooltipValue = "";

			// kodeSubDua
			$subduarek->kodeSubDua->LinkCustomAttributes = "";
			$subduarek->kodeSubDua->HrefValue = "";
			$subduarek->kodeSubDua->TooltipValue = "";

			// namaSubDua
			$subduarek->namaSubDua->LinkCustomAttributes = "";
			$subduarek->namaSubDua->HrefValue = "";
			$subduarek->namaSubDua->TooltipValue = "";

			// id
			$subduarek->id->LinkCustomAttributes = "";
			$subduarek->id->HrefValue = "";
			$subduarek->id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subduarek->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subduarek->Row_Rendered();
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

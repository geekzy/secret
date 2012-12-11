<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subtigarekinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subtigarek_list = new csubtigarek_list();
$Page =& $subtigarek_list;

// Page init
$subtigarek_list->Page_Init();

// Page main
$subtigarek_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($subtigarek->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subtigarek_list = new ew_Page("subtigarek_list");

// page properties
subtigarek_list.PageID = "list"; // page ID
subtigarek_list.FormID = "fsubtigareklist"; // form ID
var EW_PAGE_ID = subtigarek_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subtigarek_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
subtigarek_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subtigarek_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($subtigarek->Export == "") || (EW_EXPORT_MASTER_RECORD && $subtigarek->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$subtigarek_list->TotalRecs = $subtigarek->SelectRecordCount();
	} else {
		if ($subtigarek_list->Recordset = $subtigarek_list->LoadRecordset())
			$subtigarek_list->TotalRecs = $subtigarek_list->Recordset->RecordCount();
	}
	$subtigarek_list->StartRec = 1;
	if ($subtigarek_list->DisplayRecs <= 0 || ($subtigarek->Export <> "" && $subtigarek->ExportAll)) // Display all records
		$subtigarek_list->DisplayRecs = $subtigarek_list->TotalRecs;
	if (!($subtigarek->Export <> "" && $subtigarek->ExportAll))
		$subtigarek_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$subtigarek_list->Recordset = $subtigarek_list->LoadRecordset($subtigarek_list->StartRec-1, $subtigarek_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subtigarek->TableCaption() ?>
&nbsp;&nbsp;<?php $subtigarek_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($subtigarek->Export == "" && $subtigarek->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(subtigarek_list);" style="text-decoration: none;"><img id="subtigarek_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="subtigarek_list_SearchPanel">
<form name="fsubtigareklistsrch" id="fsubtigareklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="subtigarek">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($subtigarek->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $subtigarek_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($subtigarek->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($subtigarek->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($subtigarek->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $subtigarek_list->ShowPageHeader(); ?>
<?php
$subtigarek_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($subtigarek->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($subtigarek->CurrentAction <> "gridadd" && $subtigarek->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($subtigarek_list->Pager)) $subtigarek_list->Pager = new cNumericPager($subtigarek_list->StartRec, $subtigarek_list->DisplayRecs, $subtigarek_list->TotalRecs, $subtigarek_list->RecRange) ?>
<?php if ($subtigarek_list->Pager->RecordCount > 0) { ?>
	<?php if ($subtigarek_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $subtigarek_list->PageUrl() ?>start=<?php echo $subtigarek_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($subtigarek_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $subtigarek_list->PageUrl() ?>start=<?php echo $subtigarek_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($subtigarek_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $subtigarek_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($subtigarek_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $subtigarek_list->PageUrl() ?>start=<?php echo $subtigarek_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($subtigarek_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $subtigarek_list->PageUrl() ?>start=<?php echo $subtigarek_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($subtigarek_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subtigarek_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subtigarek_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subtigarek_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($subtigarek_list->SearchWhere == "0=101") { ?>
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
<?php if ($subtigarek_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subtigarek">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($subtigarek_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($subtigarek_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($subtigarek_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($subtigarek_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subtigarek_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($subtigarek_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($subtigarek_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($subtigarek_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($subtigarek_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $subtigarek_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fsubtigareklist" id="fsubtigareklist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="subtigarek">
<div id="gmp_subtigarek" class="ewGridMiddlePanel">
<?php if ($subtigarek_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $subtigarek->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$subtigarek_list->RenderListOptions();

// Render list options (header, left)
$subtigarek_list->ListOptions->Render("header", "left");
?>
<?php if ($subtigarek->kodePokok->Visible) { // kodePokok ?>
	<?php if ($subtigarek->SortUrl($subtigarek->kodePokok) == "") { ?>
		<td><?php echo $subtigarek->kodePokok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subtigarek->SortUrl($subtigarek->kodePokok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subtigarek->kodePokok->FldCaption() ?></td><td style="width: 10px;"><?php if ($subtigarek->kodePokok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subtigarek->kodePokok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subtigarek->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<?php if ($subtigarek->SortUrl($subtigarek->kodeSubSatu) == "") { ?>
		<td><?php echo $subtigarek->kodeSubSatu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subtigarek->SortUrl($subtigarek->kodeSubSatu) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subtigarek->kodeSubSatu->FldCaption() ?></td><td style="width: 10px;"><?php if ($subtigarek->kodeSubSatu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subtigarek->kodeSubSatu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subtigarek->kodeSubDua->Visible) { // kodeSubDua ?>
	<?php if ($subtigarek->SortUrl($subtigarek->kodeSubDua) == "") { ?>
		<td><?php echo $subtigarek->kodeSubDua->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subtigarek->SortUrl($subtigarek->kodeSubDua) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subtigarek->kodeSubDua->FldCaption() ?></td><td style="width: 10px;"><?php if ($subtigarek->kodeSubDua->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subtigarek->kodeSubDua->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subtigarek->kodeSubTiga->Visible) { // kodeSubTiga ?>
	<?php if ($subtigarek->SortUrl($subtigarek->kodeSubTiga) == "") { ?>
		<td><?php echo $subtigarek->kodeSubTiga->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subtigarek->SortUrl($subtigarek->kodeSubTiga) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subtigarek->kodeSubTiga->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subtigarek->kodeSubTiga->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subtigarek->kodeSubTiga->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subtigarek->namaSubTiga->Visible) { // namaSubTiga ?>
	<?php if ($subtigarek->SortUrl($subtigarek->namaSubTiga) == "") { ?>
		<td><?php echo $subtigarek->namaSubTiga->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subtigarek->SortUrl($subtigarek->namaSubTiga) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subtigarek->namaSubTiga->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subtigarek->namaSubTiga->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subtigarek->namaSubTiga->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subtigarek->id->Visible) { // id ?>
	<?php if ($subtigarek->SortUrl($subtigarek->id) == "") { ?>
		<td><?php echo $subtigarek->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subtigarek->SortUrl($subtigarek->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subtigarek->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($subtigarek->id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subtigarek->id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$subtigarek_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($subtigarek->ExportAll && $subtigarek->Export <> "") {
	$subtigarek_list->StopRec = $subtigarek_list->TotalRecs;
} else {

	// Set the last record to display
	if ($subtigarek_list->TotalRecs > $subtigarek_list->StartRec + $subtigarek_list->DisplayRecs - 1)
		$subtigarek_list->StopRec = $subtigarek_list->StartRec + $subtigarek_list->DisplayRecs - 1;
	else
		$subtigarek_list->StopRec = $subtigarek_list->TotalRecs;
}
$subtigarek_list->RecCnt = $subtigarek_list->StartRec - 1;
if ($subtigarek_list->Recordset && !$subtigarek_list->Recordset->EOF) {
	$subtigarek_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $subtigarek_list->StartRec > 1)
		$subtigarek_list->Recordset->Move($subtigarek_list->StartRec - 1);
} elseif (!$subtigarek->AllowAddDeleteRow && $subtigarek_list->StopRec == 0) {
	$subtigarek_list->StopRec = $subtigarek->GridAddRowCount;
}

// Initialize aggregate
$subtigarek->RowType = EW_ROWTYPE_AGGREGATEINIT;
$subtigarek->ResetAttrs();
$subtigarek_list->RenderRow();
$subtigarek_list->RowCnt = 0;
while ($subtigarek_list->RecCnt < $subtigarek_list->StopRec) {
	$subtigarek_list->RecCnt++;
	if (intval($subtigarek_list->RecCnt) >= intval($subtigarek_list->StartRec)) {
		$subtigarek_list->RowCnt++;

		// Set up key count
		$subtigarek_list->KeyCount = $subtigarek_list->RowIndex;

		// Init row class and style
		$subtigarek->ResetAttrs();
		$subtigarek->CssClass = "";
		if ($subtigarek->CurrentAction == "gridadd") {
		} else {
			$subtigarek_list->LoadRowValues($subtigarek_list->Recordset); // Load row values
		}
		$subtigarek->RowType = EW_ROWTYPE_VIEW; // Render view
		$subtigarek->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$subtigarek_list->RenderRow();

		// Render list options
		$subtigarek_list->RenderListOptions();
?>
	<tr<?php echo $subtigarek->RowAttributes() ?>>
<?php

// Render list options (body, left)
$subtigarek_list->ListOptions->Render("body", "left");
?>
	<?php if ($subtigarek->kodePokok->Visible) { // kodePokok ?>
		<td<?php echo $subtigarek->kodePokok->CellAttributes() ?>>
<div<?php echo $subtigarek->kodePokok->ViewAttributes() ?>><?php echo $subtigarek->kodePokok->ListViewValue() ?></div>
<a name="<?php echo $subtigarek_list->PageObjName . "_row_" . $subtigarek_list->RowCnt ?>" id="<?php echo $subtigarek_list->PageObjName . "_row_" . $subtigarek_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($subtigarek->kodeSubSatu->Visible) { // kodeSubSatu ?>
		<td<?php echo $subtigarek->kodeSubSatu->CellAttributes() ?>>
<div<?php echo $subtigarek->kodeSubSatu->ViewAttributes() ?>><?php echo $subtigarek->kodeSubSatu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subtigarek->kodeSubDua->Visible) { // kodeSubDua ?>
		<td<?php echo $subtigarek->kodeSubDua->CellAttributes() ?>>
<div<?php echo $subtigarek->kodeSubDua->ViewAttributes() ?>><?php echo $subtigarek->kodeSubDua->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subtigarek->kodeSubTiga->Visible) { // kodeSubTiga ?>
		<td<?php echo $subtigarek->kodeSubTiga->CellAttributes() ?>>
<div<?php echo $subtigarek->kodeSubTiga->ViewAttributes() ?>><?php echo $subtigarek->kodeSubTiga->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subtigarek->namaSubTiga->Visible) { // namaSubTiga ?>
		<td<?php echo $subtigarek->namaSubTiga->CellAttributes() ?>>
<div<?php echo $subtigarek->namaSubTiga->ViewAttributes() ?>><?php echo $subtigarek->namaSubTiga->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subtigarek->id->Visible) { // id ?>
		<td<?php echo $subtigarek->id->CellAttributes() ?>>
<div<?php echo $subtigarek->id->ViewAttributes() ?>><?php echo $subtigarek->id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subtigarek_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($subtigarek->CurrentAction <> "gridadd")
		$subtigarek_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($subtigarek_list->Recordset)
	$subtigarek_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($subtigarek->Export == "" && $subtigarek->CurrentAction == "") { ?>
<?php } ?>
<?php
$subtigarek_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($subtigarek->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$subtigarek_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csubtigarek_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'subtigarek';

	// Page object name
	var $PageObjName = 'subtigarek_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subtigarek;
		if ($subtigarek->UseTokenInUrl) $PageUrl .= "t=" . $subtigarek->TableVar . "&"; // Add page token
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
		global $objForm, $subtigarek;
		if ($subtigarek->UseTokenInUrl) {
			if ($objForm)
				return ($subtigarek->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subtigarek->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubtigarek_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subtigarek)
		if (!isset($GLOBALS["subtigarek"])) {
			$GLOBALS["subtigarek"] = new csubtigarek();
			$GLOBALS["Table"] =& $GLOBALS["subtigarek"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "subtigarekadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "subtigarekdelete.php";
		$this->MultiUpdateUrl = "subtigarekupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subtigarek', TRUE);

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
		global $subtigarek;

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
			$subtigarek->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $subtigarek;

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
			if ($subtigarek->Export <> "" ||
				$subtigarek->CurrentAction == "gridadd" ||
				$subtigarek->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$subtigarek->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($subtigarek->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $subtigarek->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$subtigarek->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$subtigarek->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$subtigarek->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $subtigarek->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$subtigarek->setSessionWhere($sFilter);
		$subtigarek->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $subtigarek;
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
			$subtigarek->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$subtigarek->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $subtigarek;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $subtigarek->kodePokok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subtigarek->kodeSubSatu, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subtigarek->kodeSubDua, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subtigarek->kodeSubTiga, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subtigarek->namaSubTiga, $Keyword);
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
		global $Security, $subtigarek;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $subtigarek->BasicSearchKeyword;
		$sSearchType = $subtigarek->BasicSearchType;
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
			$subtigarek->setSessionBasicSearchKeyword($sSearchKeyword);
			$subtigarek->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $subtigarek;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$subtigarek->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $subtigarek;
		$subtigarek->setSessionBasicSearchKeyword("");
		$subtigarek->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $subtigarek;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$subtigarek->BasicSearchKeyword = $subtigarek->getSessionBasicSearchKeyword();
			$subtigarek->BasicSearchType = $subtigarek->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $subtigarek;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$subtigarek->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$subtigarek->CurrentOrderType = @$_GET["ordertype"];
			$subtigarek->UpdateSort($subtigarek->kodePokok); // kodePokok
			$subtigarek->UpdateSort($subtigarek->kodeSubSatu); // kodeSubSatu
			$subtigarek->UpdateSort($subtigarek->kodeSubDua); // kodeSubDua
			$subtigarek->UpdateSort($subtigarek->kodeSubTiga); // kodeSubTiga
			$subtigarek->UpdateSort($subtigarek->namaSubTiga); // namaSubTiga
			$subtigarek->UpdateSort($subtigarek->id); // id
			$subtigarek->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $subtigarek;
		$sOrderBy = $subtigarek->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($subtigarek->SqlOrderBy() <> "") {
				$sOrderBy = $subtigarek->SqlOrderBy();
				$subtigarek->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $subtigarek;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$subtigarek->setSessionOrderBy($sOrderBy);
				$subtigarek->kodePokok->setSort("");
				$subtigarek->kodeSubSatu->setSort("");
				$subtigarek->kodeSubDua->setSort("");
				$subtigarek->kodeSubTiga->setSort("");
				$subtigarek->namaSubTiga->setSort("");
				$subtigarek->id->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$subtigarek->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $subtigarek;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = TRUE;

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
		global $Security, $Language, $subtigarek, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . "<img src=\"phpimages/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

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
		global $Security, $Language, $subtigarek;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subtigarek;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$subtigarek->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$subtigarek->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $subtigarek->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$subtigarek->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$subtigarek->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$subtigarek->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $subtigarek;
		$subtigarek->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$subtigarek->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subtigarek;

		// Call Recordset Selecting event
		$subtigarek->Recordset_Selecting($subtigarek->CurrentFilter);

		// Load List page SQL
		$sSql = $subtigarek->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subtigarek->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subtigarek;
		$sFilter = $subtigarek->KeyFilter();

		// Call Row Selecting event
		$subtigarek->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subtigarek->CurrentFilter = $sFilter;
		$sSql = $subtigarek->SQL();
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
		global $conn, $subtigarek;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subtigarek->Row_Selected($row);
		$subtigarek->kodePokok->setDbValue($rs->fields('kodePokok'));
		$subtigarek->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$subtigarek->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$subtigarek->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$subtigarek->namaSubTiga->setDbValue($rs->fields('namaSubTiga'));
		$subtigarek->id->setDbValue($rs->fields('id'));
	}

	// Load old record
	function LoadOldRecord() {
		global $subtigarek;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($subtigarek->getKey("id")) <> "")
			$subtigarek->id->CurrentValue = $subtigarek->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$subtigarek->CurrentFilter = $subtigarek->KeyFilter();
			$sSql = $subtigarek->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subtigarek;

		// Initialize URLs
		$this->ViewUrl = $subtigarek->ViewUrl();
		$this->EditUrl = $subtigarek->EditUrl();
		$this->InlineEditUrl = $subtigarek->InlineEditUrl();
		$this->CopyUrl = $subtigarek->CopyUrl();
		$this->InlineCopyUrl = $subtigarek->InlineCopyUrl();
		$this->DeleteUrl = $subtigarek->DeleteUrl();

		// Call Row_Rendering event
		$subtigarek->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// kodeSubSatu
		// kodeSubDua
		// kodeSubTiga
		// namaSubTiga
		// id

		if ($subtigarek->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			$subtigarek->kodePokok->ViewValue = $subtigarek->kodePokok->CurrentValue;
			$subtigarek->kodePokok->ViewCustomAttributes = "";

			// kodeSubSatu
			$subtigarek->kodeSubSatu->ViewValue = $subtigarek->kodeSubSatu->CurrentValue;
			$subtigarek->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubDua
			$subtigarek->kodeSubDua->ViewValue = $subtigarek->kodeSubDua->CurrentValue;
			$subtigarek->kodeSubDua->ViewCustomAttributes = "";

			// kodeSubTiga
			$subtigarek->kodeSubTiga->ViewValue = $subtigarek->kodeSubTiga->CurrentValue;
			$subtigarek->kodeSubTiga->ViewCustomAttributes = "";

			// namaSubTiga
			$subtigarek->namaSubTiga->ViewValue = $subtigarek->namaSubTiga->CurrentValue;
			$subtigarek->namaSubTiga->ViewCustomAttributes = "";

			// id
			$subtigarek->id->ViewValue = $subtigarek->id->CurrentValue;
			$subtigarek->id->ViewCustomAttributes = "";

			// kodePokok
			$subtigarek->kodePokok->LinkCustomAttributes = "";
			$subtigarek->kodePokok->HrefValue = "";
			$subtigarek->kodePokok->TooltipValue = "";

			// kodeSubSatu
			$subtigarek->kodeSubSatu->LinkCustomAttributes = "";
			$subtigarek->kodeSubSatu->HrefValue = "";
			$subtigarek->kodeSubSatu->TooltipValue = "";

			// kodeSubDua
			$subtigarek->kodeSubDua->LinkCustomAttributes = "";
			$subtigarek->kodeSubDua->HrefValue = "";
			$subtigarek->kodeSubDua->TooltipValue = "";

			// kodeSubTiga
			$subtigarek->kodeSubTiga->LinkCustomAttributes = "";
			$subtigarek->kodeSubTiga->HrefValue = "";
			$subtigarek->kodeSubTiga->TooltipValue = "";

			// namaSubTiga
			$subtigarek->namaSubTiga->LinkCustomAttributes = "";
			$subtigarek->namaSubTiga->HrefValue = "";
			$subtigarek->namaSubTiga->TooltipValue = "";

			// id
			$subtigarek->id->LinkCustomAttributes = "";
			$subtigarek->id->HrefValue = "";
			$subtigarek->id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subtigarek->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subtigarek->Row_Rendered();
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

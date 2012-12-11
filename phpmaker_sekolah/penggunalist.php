<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pengguna_list = new cpengguna_list();
$Page =& $pengguna_list;

// Page init
$pengguna_list->Page_Init();

// Page main
$pengguna_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($pengguna->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pengguna_list = new ew_Page("pengguna_list");

// page properties
pengguna_list.PageID = "list"; // page ID
pengguna_list.FormID = "fpenggunalist"; // form ID
var EW_PAGE_ID = pengguna_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pengguna_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pengguna_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pengguna_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($pengguna->Export == "") || (EW_EXPORT_MASTER_RECORD && $pengguna->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pengguna_list->TotalRecs = $pengguna->SelectRecordCount();
	} else {
		if ($pengguna_list->Recordset = $pengguna_list->LoadRecordset())
			$pengguna_list->TotalRecs = $pengguna_list->Recordset->RecordCount();
	}
	$pengguna_list->StartRec = 1;
	if ($pengguna_list->DisplayRecs <= 0 || ($pengguna->Export <> "" && $pengguna->ExportAll)) // Display all records
		$pengguna_list->DisplayRecs = $pengguna_list->TotalRecs;
	if (!($pengguna->Export <> "" && $pengguna->ExportAll))
		$pengguna_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pengguna_list->Recordset = $pengguna_list->LoadRecordset($pengguna_list->StartRec-1, $pengguna_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pengguna->TableCaption() ?>
&nbsp;&nbsp;<?php $pengguna_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($pengguna->Export == "" && $pengguna->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(pengguna_list);" style="text-decoration: none;"><img id="pengguna_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="pengguna_list_SearchPanel">
<form name="fpenggunalistsrch" id="fpenggunalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="pengguna">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($pengguna->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $pengguna_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
	<a href="penggunasrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($pengguna->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($pengguna->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($pengguna->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $pengguna_list->ShowPageHeader(); ?>
<?php
$pengguna_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($pengguna->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($pengguna->CurrentAction <> "gridadd" && $pengguna->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($pengguna_list->Pager)) $pengguna_list->Pager = new cNumericPager($pengguna_list->StartRec, $pengguna_list->DisplayRecs, $pengguna_list->TotalRecs, $pengguna_list->RecRange) ?>
<?php if ($pengguna_list->Pager->RecordCount > 0) { ?>
	<?php if ($pengguna_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $pengguna_list->PageUrl() ?>start=<?php echo $pengguna_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pengguna_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $pengguna_list->PageUrl() ?>start=<?php echo $pengguna_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($pengguna_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $pengguna_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($pengguna_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $pengguna_list->PageUrl() ?>start=<?php echo $pengguna_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pengguna_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $pengguna_list->PageUrl() ?>start=<?php echo $pengguna_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pengguna_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pengguna_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pengguna_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pengguna_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($pengguna_list->SearchWhere == "0=101") { ?>
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
<?php if ($pengguna_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="pengguna">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($pengguna_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($pengguna_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($pengguna_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($pengguna_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($pengguna_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($pengguna_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($pengguna_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($pengguna_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($pengguna_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $pengguna_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fpenggunalist" id="fpenggunalist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="pengguna">
<div id="gmp_pengguna" class="ewGridMiddlePanel">
<?php if ($pengguna_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pengguna->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pengguna_list->RenderListOptions();

// Render list options (header, left)
$pengguna_list->ListOptions->Render("header", "left");
?>
<?php if ($pengguna->id->Visible) { // id ?>
	<?php if ($pengguna->SortUrl($pengguna->id) == "") { ?>
		<td><?php echo $pengguna->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pengguna->SortUrl($pengguna->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pengguna->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($pengguna->id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pengguna->id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pengguna->nama_pengguna->Visible) { // nama_pengguna ?>
	<?php if ($pengguna->SortUrl($pengguna->nama_pengguna) == "") { ?>
		<td><?php echo $pengguna->nama_pengguna->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pengguna->SortUrl($pengguna->nama_pengguna) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pengguna->nama_pengguna->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pengguna->nama_pengguna->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pengguna->nama_pengguna->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pengguna->password->Visible) { // password ?>
	<?php if ($pengguna->SortUrl($pengguna->password) == "") { ?>
		<td><?php echo $pengguna->password->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pengguna->SortUrl($pengguna->password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pengguna->password->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pengguna->password->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pengguna->password->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pengguna->username->Visible) { // username ?>
	<?php if ($pengguna->SortUrl($pengguna->username) == "") { ?>
		<td><?php echo $pengguna->username->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pengguna->SortUrl($pengguna->username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pengguna->username->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pengguna->username->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pengguna->username->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pengguna->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
	<?php if ($pengguna->SortUrl($pengguna->kode_otomatis_tingkat) == "") { ?>
		<td><?php echo $pengguna->kode_otomatis_tingkat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pengguna->SortUrl($pengguna->kode_otomatis_tingkat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pengguna->kode_otomatis_tingkat->FldCaption() ?></td><td style="width: 10px;"><?php if ($pengguna->kode_otomatis_tingkat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pengguna->kode_otomatis_tingkat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pengguna->user_level->Visible) { // user_level ?>
	<?php if ($pengguna->SortUrl($pengguna->user_level) == "") { ?>
		<td><?php echo $pengguna->user_level->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pengguna->SortUrl($pengguna->user_level) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pengguna->user_level->FldCaption() ?></td><td style="width: 10px;"><?php if ($pengguna->user_level->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pengguna->user_level->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pengguna_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($pengguna->ExportAll && $pengguna->Export <> "") {
	$pengguna_list->StopRec = $pengguna_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pengguna_list->TotalRecs > $pengguna_list->StartRec + $pengguna_list->DisplayRecs - 1)
		$pengguna_list->StopRec = $pengguna_list->StartRec + $pengguna_list->DisplayRecs - 1;
	else
		$pengguna_list->StopRec = $pengguna_list->TotalRecs;
}
$pengguna_list->RecCnt = $pengguna_list->StartRec - 1;
if ($pengguna_list->Recordset && !$pengguna_list->Recordset->EOF) {
	$pengguna_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $pengguna_list->StartRec > 1)
		$pengguna_list->Recordset->Move($pengguna_list->StartRec - 1);
} elseif (!$pengguna->AllowAddDeleteRow && $pengguna_list->StopRec == 0) {
	$pengguna_list->StopRec = $pengguna->GridAddRowCount;
}

// Initialize aggregate
$pengguna->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pengguna->ResetAttrs();
$pengguna_list->RenderRow();
$pengguna_list->RowCnt = 0;
while ($pengguna_list->RecCnt < $pengguna_list->StopRec) {
	$pengguna_list->RecCnt++;
	if (intval($pengguna_list->RecCnt) >= intval($pengguna_list->StartRec)) {
		$pengguna_list->RowCnt++;

		// Set up key count
		$pengguna_list->KeyCount = $pengguna_list->RowIndex;

		// Init row class and style
		$pengguna->ResetAttrs();
		$pengguna->CssClass = "";
		if ($pengguna->CurrentAction == "gridadd") {
		} else {
			$pengguna_list->LoadRowValues($pengguna_list->Recordset); // Load row values
		}
		$pengguna->RowType = EW_ROWTYPE_VIEW; // Render view
		$pengguna->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$pengguna_list->RenderRow();

		// Render list options
		$pengguna_list->RenderListOptions();
?>
	<tr<?php echo $pengguna->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pengguna_list->ListOptions->Render("body", "left");
?>
	<?php if ($pengguna->id->Visible) { // id ?>
		<td<?php echo $pengguna->id->CellAttributes() ?>>
<div<?php echo $pengguna->id->ViewAttributes() ?>><?php echo $pengguna->id->ListViewValue() ?></div>
<a name="<?php echo $pengguna_list->PageObjName . "_row_" . $pengguna_list->RowCnt ?>" id="<?php echo $pengguna_list->PageObjName . "_row_" . $pengguna_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($pengguna->nama_pengguna->Visible) { // nama_pengguna ?>
		<td<?php echo $pengguna->nama_pengguna->CellAttributes() ?>>
<div<?php echo $pengguna->nama_pengguna->ViewAttributes() ?>><?php echo $pengguna->nama_pengguna->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pengguna->password->Visible) { // password ?>
		<td<?php echo $pengguna->password->CellAttributes() ?>>
<div<?php echo $pengguna->password->ViewAttributes() ?>><?php echo $pengguna->password->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pengguna->username->Visible) { // username ?>
		<td<?php echo $pengguna->username->CellAttributes() ?>>
<div<?php echo $pengguna->username->ViewAttributes() ?>><?php echo $pengguna->username->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pengguna->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<td<?php echo $pengguna->kode_otomatis_tingkat->CellAttributes() ?>>
<div<?php echo $pengguna->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $pengguna->kode_otomatis_tingkat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pengguna->user_level->Visible) { // user_level ?>
		<td<?php echo $pengguna->user_level->CellAttributes() ?>>
<div<?php echo $pengguna->user_level->ViewAttributes() ?>><?php echo $pengguna->user_level->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pengguna_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($pengguna->CurrentAction <> "gridadd")
		$pengguna_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pengguna_list->Recordset)
	$pengguna_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($pengguna->Export == "" && $pengguna->CurrentAction == "") { ?>
<?php } ?>
<?php
$pengguna_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pengguna->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pengguna_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpengguna_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'pengguna';

	// Page object name
	var $PageObjName = 'pengguna_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pengguna;
		if ($pengguna->UseTokenInUrl) $PageUrl .= "t=" . $pengguna->TableVar . "&"; // Add page token
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
		global $objForm, $pengguna;
		if ($pengguna->UseTokenInUrl) {
			if ($objForm)
				return ($pengguna->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pengguna->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpengguna_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pengguna)
		if (!isset($GLOBALS["pengguna"])) {
			$GLOBALS["pengguna"] = new cpengguna();
			$GLOBALS["Table"] =& $GLOBALS["pengguna"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "penggunaadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "penggunadelete.php";
		$this->MultiUpdateUrl = "penggunaupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pengguna', TRUE);

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
		global $pengguna;

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
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate();
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$pengguna->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $pengguna;

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
			if ($pengguna->Export <> "" ||
				$pengguna->CurrentAction == "gridadd" ||
				$pengguna->CurrentAction == "gridedit") {
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
			$pengguna->Recordset_SearchValidated();

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
		if ($pengguna->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $pengguna->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$pengguna->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$pengguna->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$pengguna->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $pengguna->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$pengguna->setSessionWhere($sFilter);
		$pengguna->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $pengguna;
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
			$pengguna->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$pengguna->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $pengguna;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $pengguna->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $pengguna->nama_pengguna, FALSE); // nama_pengguna
		$this->BuildSearchSql($sWhere, $pengguna->password, FALSE); // password
		$this->BuildSearchSql($sWhere, $pengguna->username, FALSE); // username
		$this->BuildSearchSql($sWhere, $pengguna->kode_otomatis_tingkat, FALSE); // kode_otomatis_tingkat
		$this->BuildSearchSql($sWhere, $pengguna->user_level, FALSE); // user_level

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($pengguna->id); // id
			$this->SetSearchParm($pengguna->nama_pengguna); // nama_pengguna
			$this->SetSearchParm($pengguna->password); // password
			$this->SetSearchParm($pengguna->username); // username
			$this->SetSearchParm($pengguna->kode_otomatis_tingkat); // kode_otomatis_tingkat
			$this->SetSearchParm($pengguna->user_level); // user_level
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
		global $pengguna;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$pengguna->setAdvancedSearch("x_$FldParm", $FldVal);
		$pengguna->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$pengguna->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$pengguna->setAdvancedSearch("y_$FldParm", $FldVal2);
		$pengguna->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $pengguna;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $pengguna->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $pengguna->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $pengguna->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $pengguna->getAdvancedSearch("w_$FldParm");
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
		global $pengguna;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $pengguna->nama_pengguna, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pengguna->password, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pengguna->username, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pengguna->kode_otomatis_tingkat, $Keyword);
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
		global $Security, $pengguna;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $pengguna->BasicSearchKeyword;
		$sSearchType = $pengguna->BasicSearchType;
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
			$pengguna->setSessionBasicSearchKeyword($sSearchKeyword);
			$pengguna->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $pengguna;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$pengguna->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $pengguna;
		$pengguna->setSessionBasicSearchKeyword("");
		$pengguna->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $pengguna;
		$pengguna->setAdvancedSearch("x_id", "");
		$pengguna->setAdvancedSearch("x_nama_pengguna", "");
		$pengguna->setAdvancedSearch("x_password", "");
		$pengguna->setAdvancedSearch("x_username", "");
		$pengguna->setAdvancedSearch("x_kode_otomatis_tingkat", "");
		$pengguna->setAdvancedSearch("x_user_level", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $pengguna;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_nama_pengguna"] <> "") $bRestore = FALSE;
		if (@$_GET["x_password"] <> "") $bRestore = FALSE;
		if (@$_GET["x_username"] <> "") $bRestore = FALSE;
		if (@$_GET["x_kode_otomatis_tingkat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_user_level"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$pengguna->BasicSearchKeyword = $pengguna->getSessionBasicSearchKeyword();
			$pengguna->BasicSearchType = $pengguna->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($pengguna->id);
			$this->GetSearchParm($pengguna->nama_pengguna);
			$this->GetSearchParm($pengguna->password);
			$this->GetSearchParm($pengguna->username);
			$this->GetSearchParm($pengguna->kode_otomatis_tingkat);
			$this->GetSearchParm($pengguna->user_level);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pengguna;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pengguna->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pengguna->CurrentOrderType = @$_GET["ordertype"];
			$pengguna->UpdateSort($pengguna->id); // id
			$pengguna->UpdateSort($pengguna->nama_pengguna); // nama_pengguna
			$pengguna->UpdateSort($pengguna->password); // password
			$pengguna->UpdateSort($pengguna->username); // username
			$pengguna->UpdateSort($pengguna->kode_otomatis_tingkat); // kode_otomatis_tingkat
			$pengguna->UpdateSort($pengguna->user_level); // user_level
			$pengguna->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $pengguna;
		$sOrderBy = $pengguna->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($pengguna->SqlOrderBy() <> "") {
				$sOrderBy = $pengguna->SqlOrderBy();
				$pengguna->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $pengguna;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$pengguna->setSessionOrderBy($sOrderBy);
				$pengguna->id->setSort("");
				$pengguna->nama_pengguna->setSort("");
				$pengguna->password->setSort("");
				$pengguna->username->setSort("");
				$pengguna->kode_otomatis_tingkat->setSort("");
				$pengguna->user_level->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$pengguna->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $pengguna;

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
		global $Security, $Language, $pengguna, $objForm;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $this->ShowOptionLink() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $pengguna;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pengguna;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$pengguna->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$pengguna->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $pengguna->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$pengguna->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$pengguna->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$pengguna->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $pengguna;
		$pengguna->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$pengguna->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $pengguna;

		// Load search values
		// id

		$pengguna->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$pengguna->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// nama_pengguna
		$pengguna->nama_pengguna->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_nama_pengguna"]);
		$pengguna->nama_pengguna->AdvancedSearch->SearchOperator = @$_GET["z_nama_pengguna"];

		// password
		$pengguna->password->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_password"]);
		$pengguna->password->AdvancedSearch->SearchOperator = @$_GET["z_password"];

		// username
		$pengguna->username->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_username"]);
		$pengguna->username->AdvancedSearch->SearchOperator = @$_GET["z_username"];

		// kode_otomatis_tingkat
		$pengguna->kode_otomatis_tingkat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_kode_otomatis_tingkat"]);
		$pengguna->kode_otomatis_tingkat->AdvancedSearch->SearchOperator = @$_GET["z_kode_otomatis_tingkat"];

		// user_level
		$pengguna->user_level->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_user_level"]);
		$pengguna->user_level->AdvancedSearch->SearchOperator = @$_GET["z_user_level"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pengguna;

		// Call Recordset Selecting event
		$pengguna->Recordset_Selecting($pengguna->CurrentFilter);

		// Load List page SQL
		$sSql = $pengguna->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pengguna->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pengguna;
		$sFilter = $pengguna->KeyFilter();

		// Call Row Selecting event
		$pengguna->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pengguna->CurrentFilter = $sFilter;
		$sSql = $pengguna->SQL();
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
		global $conn, $pengguna;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pengguna->Row_Selected($row);
		$pengguna->id->setDbValue($rs->fields('id'));
		$pengguna->nama_pengguna->setDbValue($rs->fields('nama_pengguna'));
		$pengguna->password->setDbValue($rs->fields('password'));
		$pengguna->username->setDbValue($rs->fields('username'));
		$pengguna->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$pengguna->user_level->setDbValue($rs->fields('user_level'));
	}

	// Load old record
	function LoadOldRecord() {
		global $pengguna;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pengguna->getKey("id")) <> "")
			$pengguna->id->CurrentValue = $pengguna->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pengguna->CurrentFilter = $pengguna->KeyFilter();
			$sSql = $pengguna->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pengguna;

		// Initialize URLs
		$this->ViewUrl = $pengguna->ViewUrl();
		$this->EditUrl = $pengguna->EditUrl();
		$this->InlineEditUrl = $pengguna->InlineEditUrl();
		$this->CopyUrl = $pengguna->CopyUrl();
		$this->InlineCopyUrl = $pengguna->InlineCopyUrl();
		$this->DeleteUrl = $pengguna->DeleteUrl();

		// Call Row_Rendering event
		$pengguna->Row_Rendering();

		// Common render codes for all row types
		// id
		// nama_pengguna
		// password
		// username
		// kode_otomatis_tingkat
		// user_level

		if ($pengguna->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$pengguna->id->ViewValue = $pengguna->id->CurrentValue;
			$pengguna->id->ViewCustomAttributes = "";

			// nama_pengguna
			$pengguna->nama_pengguna->ViewValue = $pengguna->nama_pengguna->CurrentValue;
			$pengguna->nama_pengguna->ViewCustomAttributes = "";

			// password
			$pengguna->password->ViewValue = $pengguna->password->CurrentValue;
			$pengguna->password->ViewCustomAttributes = "";

			// username
			$pengguna->username->ViewValue = $pengguna->username->CurrentValue;
			$pengguna->username->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			if (strval($pengguna->kode_otomatis_tingkat->CurrentValue) <> "") {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pengguna->kode_otomatis_tingkat->CurrentValue) . "'";
			$sSqlWrk = "SELECT `tingkat` FROM `st_master_tingkat`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pengguna->kode_otomatis_tingkat->ViewValue = $rswrk->fields('tingkat');
					$rswrk->Close();
				} else {
					$pengguna->kode_otomatis_tingkat->ViewValue = $pengguna->kode_otomatis_tingkat->CurrentValue;
				}
			} else {
				$pengguna->kode_otomatis_tingkat->ViewValue = NULL;
			}
			$pengguna->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// user_level
			if ($Security->CanAdmin()) { // System admin
			if (strval($pengguna->user_level->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($pengguna->user_level->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pengguna->user_level->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$pengguna->user_level->ViewValue = $pengguna->user_level->CurrentValue;
				}
			} else {
				$pengguna->user_level->ViewValue = NULL;
			}
			} else {
				$pengguna->user_level->ViewValue = "********";
			}
			$pengguna->user_level->ViewCustomAttributes = "";

			// id
			$pengguna->id->LinkCustomAttributes = "";
			$pengguna->id->HrefValue = "";
			$pengguna->id->TooltipValue = "";

			// nama_pengguna
			$pengguna->nama_pengguna->LinkCustomAttributes = "";
			$pengguna->nama_pengguna->HrefValue = "";
			$pengguna->nama_pengguna->TooltipValue = "";

			// password
			$pengguna->password->LinkCustomAttributes = "";
			$pengguna->password->HrefValue = "";
			$pengguna->password->TooltipValue = "";

			// username
			$pengguna->username->LinkCustomAttributes = "";
			$pengguna->username->HrefValue = "";
			$pengguna->username->TooltipValue = "";

			// kode_otomatis_tingkat
			$pengguna->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$pengguna->kode_otomatis_tingkat->HrefValue = "";
			$pengguna->kode_otomatis_tingkat->TooltipValue = "";

			// user_level
			$pengguna->user_level->LinkCustomAttributes = "";
			$pengguna->user_level->HrefValue = "";
			$pengguna->user_level->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pengguna->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pengguna->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $pengguna;

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
		global $pengguna;
		$pengguna->id->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_id");
		$pengguna->nama_pengguna->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_nama_pengguna");
		$pengguna->password->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_password");
		$pengguna->username->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_username");
		$pengguna->kode_otomatis_tingkat->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_kode_otomatis_tingkat");
		$pengguna->user_level->AdvancedSearch->SearchValue = $pengguna->getAdvancedSearch("x_user_level");
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $pengguna;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($pengguna->username->CurrentValue);
			}
		}
		return TRUE;
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

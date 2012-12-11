<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "rekening2info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$rekening2_list = new crekening2_list();
$Page =& $rekening2_list;

// Page init
$rekening2_list->Page_Init();

// Page main
$rekening2_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($rekening2->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var rekening2_list = new ew_Page("rekening2_list");

// page properties
rekening2_list.PageID = "list"; // page ID
rekening2_list.FormID = "frekening2list"; // form ID
var EW_PAGE_ID = rekening2_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
rekening2_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
rekening2_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rekening2_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($rekening2->Export == "") || (EW_EXPORT_MASTER_RECORD && $rekening2->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$rekening2_list->TotalRecs = $rekening2->SelectRecordCount();
	} else {
		if ($rekening2_list->Recordset = $rekening2_list->LoadRecordset())
			$rekening2_list->TotalRecs = $rekening2_list->Recordset->RecordCount();
	}
	$rekening2_list->StartRec = 1;
	if ($rekening2_list->DisplayRecs <= 0 || ($rekening2->Export <> "" && $rekening2->ExportAll)) // Display all records
		$rekening2_list->DisplayRecs = $rekening2_list->TotalRecs;
	if (!($rekening2->Export <> "" && $rekening2->ExportAll))
		$rekening2_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rekening2_list->Recordset = $rekening2_list->LoadRecordset($rekening2_list->StartRec-1, $rekening2_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $rekening2->TableCaption() ?>
&nbsp;&nbsp;<?php $rekening2_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($rekening2->Export == "" && $rekening2->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(rekening2_list);" style="text-decoration: none;"><img id="rekening2_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="rekening2_list_SearchPanel">
<form name="frekening2listsrch" id="frekening2listsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="rekening2">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($rekening2->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $rekening2_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($rekening2->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($rekening2->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($rekening2->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $rekening2_list->ShowPageHeader(); ?>
<?php
$rekening2_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($rekening2->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($rekening2->CurrentAction <> "gridadd" && $rekening2->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($rekening2_list->Pager)) $rekening2_list->Pager = new cNumericPager($rekening2_list->StartRec, $rekening2_list->DisplayRecs, $rekening2_list->TotalRecs, $rekening2_list->RecRange) ?>
<?php if ($rekening2_list->Pager->RecordCount > 0) { ?>
	<?php if ($rekening2_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $rekening2_list->PageUrl() ?>start=<?php echo $rekening2_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($rekening2_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $rekening2_list->PageUrl() ?>start=<?php echo $rekening2_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($rekening2_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $rekening2_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($rekening2_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $rekening2_list->PageUrl() ?>start=<?php echo $rekening2_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($rekening2_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $rekening2_list->PageUrl() ?>start=<?php echo $rekening2_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($rekening2_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rekening2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rekening2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rekening2_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($rekening2_list->SearchWhere == "0=101") { ?>
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
<?php if ($rekening2_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="rekening2">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($rekening2_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($rekening2_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($rekening2_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($rekening2_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($rekening2_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($rekening2_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($rekening2_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($rekening2_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($rekening2_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $rekening2_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="frekening2list" id="frekening2list" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="rekening2">
<div id="gmp_rekening2" class="ewGridMiddlePanel">
<?php if ($rekening2_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $rekening2->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$rekening2_list->RenderListOptions();

// Render list options (header, left)
$rekening2_list->ListOptions->Render("header", "left");
?>
<?php if ($rekening2->kodePokok->Visible) { // kodePokok ?>
	<?php if ($rekening2->SortUrl($rekening2->kodePokok) == "") { ?>
		<td><?php echo $rekening2->kodePokok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->kodePokok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->kodePokok->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($rekening2->kodePokok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->kodePokok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<?php if ($rekening2->SortUrl($rekening2->kodeSubSatu) == "") { ?>
		<td><?php echo $rekening2->kodeSubSatu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->kodeSubSatu) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->kodeSubSatu->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($rekening2->kodeSubSatu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->kodeSubSatu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->kodeSubDua->Visible) { // kodeSubDua ?>
	<?php if ($rekening2->SortUrl($rekening2->kodeSubDua) == "") { ?>
		<td><?php echo $rekening2->kodeSubDua->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->kodeSubDua) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->kodeSubDua->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($rekening2->kodeSubDua->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->kodeSubDua->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->kodeSubTiga->Visible) { // kodeSubTiga ?>
	<?php if ($rekening2->SortUrl($rekening2->kodeSubTiga) == "") { ?>
		<td><?php echo $rekening2->kodeSubTiga->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->kodeSubTiga) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->kodeSubTiga->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($rekening2->kodeSubTiga->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->kodeSubTiga->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->Norek->Visible) { // Norek ?>
	<?php if ($rekening2->SortUrl($rekening2->Norek) == "") { ?>
		<td><?php echo $rekening2->Norek->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->Norek) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->Norek->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($rekening2->Norek->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->Norek->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->Keterangan->Visible) { // Keterangan ?>
	<?php if ($rekening2->SortUrl($rekening2->Keterangan) == "") { ?>
		<td><?php echo $rekening2->Keterangan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->Keterangan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->Keterangan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($rekening2->Keterangan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->Keterangan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->D2FK->Visible) { // D/K ?>
	<?php if ($rekening2->SortUrl($rekening2->D2FK) == "") { ?>
		<td><?php echo $rekening2->D2FK->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->D2FK) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->D2FK->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($rekening2->D2FK->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->D2FK->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->SaldoAwal->Visible) { // SaldoAwal ?>
	<?php if ($rekening2->SortUrl($rekening2->SaldoAwal) == "") { ?>
		<td><?php echo $rekening2->SaldoAwal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->SaldoAwal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->SaldoAwal->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekening2->SaldoAwal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->SaldoAwal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->Saldo->Visible) { // Saldo ?>
	<?php if ($rekening2->SortUrl($rekening2->Saldo) == "") { ?>
		<td><?php echo $rekening2->Saldo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->Saldo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->Saldo->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekening2->Saldo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->Saldo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->TanggalSaldo->Visible) { // TanggalSaldo ?>
	<?php if ($rekening2->SortUrl($rekening2->TanggalSaldo) == "") { ?>
		<td><?php echo $rekening2->TanggalSaldo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->TanggalSaldo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->TanggalSaldo->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekening2->TanggalSaldo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->TanggalSaldo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->target->Visible) { // target ?>
	<?php if ($rekening2->SortUrl($rekening2->target) == "") { ?>
		<td><?php echo $rekening2->target->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->target) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->target->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekening2->target->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->target->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->id->Visible) { // id ?>
	<?php if ($rekening2->SortUrl($rekening2->id) == "") { ?>
		<td><?php echo $rekening2->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekening2->id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->debet_kali->Visible) { // debet_kali ?>
	<?php if ($rekening2->SortUrl($rekening2->debet_kali) == "") { ?>
		<td><?php echo $rekening2->debet_kali->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->debet_kali) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->debet_kali->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekening2->debet_kali->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->debet_kali->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekening2->kredit_kali->Visible) { // kredit_kali ?>
	<?php if ($rekening2->SortUrl($rekening2->kredit_kali) == "") { ?>
		<td><?php echo $rekening2->kredit_kali->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekening2->SortUrl($rekening2->kredit_kali) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekening2->kredit_kali->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekening2->kredit_kali->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekening2->kredit_kali->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$rekening2_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($rekening2->ExportAll && $rekening2->Export <> "") {
	$rekening2_list->StopRec = $rekening2_list->TotalRecs;
} else {

	// Set the last record to display
	if ($rekening2_list->TotalRecs > $rekening2_list->StartRec + $rekening2_list->DisplayRecs - 1)
		$rekening2_list->StopRec = $rekening2_list->StartRec + $rekening2_list->DisplayRecs - 1;
	else
		$rekening2_list->StopRec = $rekening2_list->TotalRecs;
}
$rekening2_list->RecCnt = $rekening2_list->StartRec - 1;
if ($rekening2_list->Recordset && !$rekening2_list->Recordset->EOF) {
	$rekening2_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $rekening2_list->StartRec > 1)
		$rekening2_list->Recordset->Move($rekening2_list->StartRec - 1);
} elseif (!$rekening2->AllowAddDeleteRow && $rekening2_list->StopRec == 0) {
	$rekening2_list->StopRec = $rekening2->GridAddRowCount;
}

// Initialize aggregate
$rekening2->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rekening2->ResetAttrs();
$rekening2_list->RenderRow();
$rekening2_list->RowCnt = 0;
while ($rekening2_list->RecCnt < $rekening2_list->StopRec) {
	$rekening2_list->RecCnt++;
	if (intval($rekening2_list->RecCnt) >= intval($rekening2_list->StartRec)) {
		$rekening2_list->RowCnt++;

		// Set up key count
		$rekening2_list->KeyCount = $rekening2_list->RowIndex;

		// Init row class and style
		$rekening2->ResetAttrs();
		$rekening2->CssClass = "";
		if ($rekening2->CurrentAction == "gridadd") {
		} else {
			$rekening2_list->LoadRowValues($rekening2_list->Recordset); // Load row values
		}
		$rekening2->RowType = EW_ROWTYPE_VIEW; // Render view
		$rekening2->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$rekening2_list->RenderRow();

		// Render list options
		$rekening2_list->RenderListOptions();
?>
	<tr<?php echo $rekening2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rekening2_list->ListOptions->Render("body", "left");
?>
	<?php if ($rekening2->kodePokok->Visible) { // kodePokok ?>
		<td<?php echo $rekening2->kodePokok->CellAttributes() ?>>
<div<?php echo $rekening2->kodePokok->ViewAttributes() ?>><?php echo $rekening2->kodePokok->ListViewValue() ?></div>
<a name="<?php echo $rekening2_list->PageObjName . "_row_" . $rekening2_list->RowCnt ?>" id="<?php echo $rekening2_list->PageObjName . "_row_" . $rekening2_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($rekening2->kodeSubSatu->Visible) { // kodeSubSatu ?>
		<td<?php echo $rekening2->kodeSubSatu->CellAttributes() ?>>
<div<?php echo $rekening2->kodeSubSatu->ViewAttributes() ?>><?php echo $rekening2->kodeSubSatu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->kodeSubDua->Visible) { // kodeSubDua ?>
		<td<?php echo $rekening2->kodeSubDua->CellAttributes() ?>>
<div<?php echo $rekening2->kodeSubDua->ViewAttributes() ?>><?php echo $rekening2->kodeSubDua->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->kodeSubTiga->Visible) { // kodeSubTiga ?>
		<td<?php echo $rekening2->kodeSubTiga->CellAttributes() ?>>
<div<?php echo $rekening2->kodeSubTiga->ViewAttributes() ?>><?php echo $rekening2->kodeSubTiga->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->Norek->Visible) { // Norek ?>
		<td<?php echo $rekening2->Norek->CellAttributes() ?>>
<div<?php echo $rekening2->Norek->ViewAttributes() ?>><?php echo $rekening2->Norek->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->Keterangan->Visible) { // Keterangan ?>
		<td<?php echo $rekening2->Keterangan->CellAttributes() ?>>
<div<?php echo $rekening2->Keterangan->ViewAttributes() ?>><?php echo $rekening2->Keterangan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->D2FK->Visible) { // D/K ?>
		<td<?php echo $rekening2->D2FK->CellAttributes() ?>>
<div<?php echo $rekening2->D2FK->ViewAttributes() ?>><?php echo $rekening2->D2FK->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->SaldoAwal->Visible) { // SaldoAwal ?>
		<td<?php echo $rekening2->SaldoAwal->CellAttributes() ?>>
<div<?php echo $rekening2->SaldoAwal->ViewAttributes() ?>><?php echo $rekening2->SaldoAwal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->Saldo->Visible) { // Saldo ?>
		<td<?php echo $rekening2->Saldo->CellAttributes() ?>>
<div<?php echo $rekening2->Saldo->ViewAttributes() ?>><?php echo $rekening2->Saldo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->TanggalSaldo->Visible) { // TanggalSaldo ?>
		<td<?php echo $rekening2->TanggalSaldo->CellAttributes() ?>>
<div<?php echo $rekening2->TanggalSaldo->ViewAttributes() ?>><?php echo $rekening2->TanggalSaldo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->target->Visible) { // target ?>
		<td<?php echo $rekening2->target->CellAttributes() ?>>
<div<?php echo $rekening2->target->ViewAttributes() ?>><?php echo $rekening2->target->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->id->Visible) { // id ?>
		<td<?php echo $rekening2->id->CellAttributes() ?>>
<div<?php echo $rekening2->id->ViewAttributes() ?>><?php echo $rekening2->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->debet_kali->Visible) { // debet_kali ?>
		<td<?php echo $rekening2->debet_kali->CellAttributes() ?>>
<div<?php echo $rekening2->debet_kali->ViewAttributes() ?>><?php echo $rekening2->debet_kali->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rekening2->kredit_kali->Visible) { // kredit_kali ?>
		<td<?php echo $rekening2->kredit_kali->CellAttributes() ?>>
<div<?php echo $rekening2->kredit_kali->ViewAttributes() ?>><?php echo $rekening2->kredit_kali->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rekening2_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($rekening2->CurrentAction <> "gridadd")
		$rekening2_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rekening2_list->Recordset)
	$rekening2_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($rekening2->Export == "" && $rekening2->CurrentAction == "") { ?>
<?php } ?>
<?php
$rekening2_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($rekening2->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$rekening2_list->Page_Terminate();
?>
<?php

//
// Page class
//
class crekening2_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'rekening2';

	// Page object name
	var $PageObjName = 'rekening2_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rekening2;
		if ($rekening2->UseTokenInUrl) $PageUrl .= "t=" . $rekening2->TableVar . "&"; // Add page token
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
		global $objForm, $rekening2;
		if ($rekening2->UseTokenInUrl) {
			if ($objForm)
				return ($rekening2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rekening2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crekening2_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (rekening2)
		if (!isset($GLOBALS["rekening2"])) {
			$GLOBALS["rekening2"] = new crekening2();
			$GLOBALS["Table"] =& $GLOBALS["rekening2"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "rekening2add.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "rekening2delete.php";
		$this->MultiUpdateUrl = "rekening2update.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rekening2', TRUE);

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
		global $rekening2;

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
			$rekening2->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $rekening2;

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
			if ($rekening2->Export <> "" ||
				$rekening2->CurrentAction == "gridadd" ||
				$rekening2->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$rekening2->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($rekening2->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $rekening2->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$rekening2->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$rekening2->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$rekening2->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $rekening2->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$rekening2->setSessionWhere($sFilter);
		$rekening2->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $rekening2;
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
			$rekening2->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$rekening2->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $rekening2;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $rekening2->kodePokok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $rekening2->kodeSubSatu, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $rekening2->kodeSubDua, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $rekening2->kodeSubTiga, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $rekening2->Norek, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $rekening2->Keterangan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $rekening2->D2FK, $Keyword);
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
		global $Security, $rekening2;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $rekening2->BasicSearchKeyword;
		$sSearchType = $rekening2->BasicSearchType;
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
			$rekening2->setSessionBasicSearchKeyword($sSearchKeyword);
			$rekening2->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $rekening2;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$rekening2->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $rekening2;
		$rekening2->setSessionBasicSearchKeyword("");
		$rekening2->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $rekening2;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$rekening2->BasicSearchKeyword = $rekening2->getSessionBasicSearchKeyword();
			$rekening2->BasicSearchType = $rekening2->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $rekening2;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$rekening2->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$rekening2->CurrentOrderType = @$_GET["ordertype"];
			$rekening2->UpdateSort($rekening2->kodePokok); // kodePokok
			$rekening2->UpdateSort($rekening2->kodeSubSatu); // kodeSubSatu
			$rekening2->UpdateSort($rekening2->kodeSubDua); // kodeSubDua
			$rekening2->UpdateSort($rekening2->kodeSubTiga); // kodeSubTiga
			$rekening2->UpdateSort($rekening2->Norek); // Norek
			$rekening2->UpdateSort($rekening2->Keterangan); // Keterangan
			$rekening2->UpdateSort($rekening2->D2FK); // D/K
			$rekening2->UpdateSort($rekening2->SaldoAwal); // SaldoAwal
			$rekening2->UpdateSort($rekening2->Saldo); // Saldo
			$rekening2->UpdateSort($rekening2->TanggalSaldo); // TanggalSaldo
			$rekening2->UpdateSort($rekening2->target); // target
			$rekening2->UpdateSort($rekening2->id); // id
			$rekening2->UpdateSort($rekening2->debet_kali); // debet_kali
			$rekening2->UpdateSort($rekening2->kredit_kali); // kredit_kali
			$rekening2->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $rekening2;
		$sOrderBy = $rekening2->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($rekening2->SqlOrderBy() <> "") {
				$sOrderBy = $rekening2->SqlOrderBy();
				$rekening2->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $rekening2;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$rekening2->setSessionOrderBy($sOrderBy);
				$rekening2->kodePokok->setSort("");
				$rekening2->kodeSubSatu->setSort("");
				$rekening2->kodeSubDua->setSort("");
				$rekening2->kodeSubTiga->setSort("");
				$rekening2->Norek->setSort("");
				$rekening2->Keterangan->setSort("");
				$rekening2->D2FK->setSort("");
				$rekening2->SaldoAwal->setSort("");
				$rekening2->Saldo->setSort("");
				$rekening2->TanggalSaldo->setSort("");
				$rekening2->target->setSort("");
				$rekening2->id->setSort("");
				$rekening2->debet_kali->setSort("");
				$rekening2->kredit_kali->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$rekening2->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $rekening2;

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

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $rekening2, $objForm;
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
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $rekening2;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $rekening2;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$rekening2->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$rekening2->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $rekening2->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$rekening2->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$rekening2->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$rekening2->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $rekening2;
		$rekening2->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$rekening2->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $rekening2;

		// Call Recordset Selecting event
		$rekening2->Recordset_Selecting($rekening2->CurrentFilter);

		// Load List page SQL
		$sSql = $rekening2->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$rekening2->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $rekening2;
		$sFilter = $rekening2->KeyFilter();

		// Call Row Selecting event
		$rekening2->Row_Selecting($sFilter);

		// Load SQL based on filter
		$rekening2->CurrentFilter = $sFilter;
		$sSql = $rekening2->SQL();
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
		global $conn, $rekening2;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$rekening2->Row_Selected($row);
		$rekening2->kodePokok->setDbValue($rs->fields('kodePokok'));
		$rekening2->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$rekening2->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$rekening2->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$rekening2->Norek->setDbValue($rs->fields('Norek'));
		$rekening2->Keterangan->setDbValue($rs->fields('Keterangan'));
		$rekening2->D2FK->setDbValue($rs->fields('D/K'));
		$rekening2->SaldoAwal->setDbValue($rs->fields('SaldoAwal'));
		$rekening2->Saldo->setDbValue($rs->fields('Saldo'));
		$rekening2->TanggalSaldo->setDbValue($rs->fields('TanggalSaldo'));
		$rekening2->target->setDbValue($rs->fields('target'));
		$rekening2->id->setDbValue($rs->fields('id'));
		$rekening2->debet_kali->setDbValue($rs->fields('debet_kali'));
		$rekening2->kredit_kali->setDbValue($rs->fields('kredit_kali'));
	}

	// Load old record
	function LoadOldRecord() {
		global $rekening2;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($rekening2->getKey("id")) <> "")
			$rekening2->id->CurrentValue = $rekening2->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$rekening2->CurrentFilter = $rekening2->KeyFilter();
			$sSql = $rekening2->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $rekening2;

		// Initialize URLs
		$this->ViewUrl = $rekening2->ViewUrl();
		$this->EditUrl = $rekening2->EditUrl();
		$this->InlineEditUrl = $rekening2->InlineEditUrl();
		$this->CopyUrl = $rekening2->CopyUrl();
		$this->InlineCopyUrl = $rekening2->InlineCopyUrl();
		$this->DeleteUrl = $rekening2->DeleteUrl();

		// Call Row_Rendering event
		$rekening2->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// kodeSubSatu
		// kodeSubDua
		// kodeSubTiga
		// Norek
		// Keterangan
		// D/K
		// SaldoAwal
		// Saldo
		// TanggalSaldo
		// target
		// id
		// debet_kali
		// kredit_kali

		if ($rekening2->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			$rekening2->kodePokok->ViewValue = $rekening2->kodePokok->CurrentValue;
			$rekening2->kodePokok->ViewCustomAttributes = "";

			// kodeSubSatu
			$rekening2->kodeSubSatu->ViewValue = $rekening2->kodeSubSatu->CurrentValue;
			$rekening2->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubDua
			$rekening2->kodeSubDua->ViewValue = $rekening2->kodeSubDua->CurrentValue;
			$rekening2->kodeSubDua->ViewCustomAttributes = "";

			// kodeSubTiga
			$rekening2->kodeSubTiga->ViewValue = $rekening2->kodeSubTiga->CurrentValue;
			$rekening2->kodeSubTiga->ViewCustomAttributes = "";

			// Norek
			$rekening2->Norek->ViewValue = $rekening2->Norek->CurrentValue;
			$rekening2->Norek->ViewCustomAttributes = "";

			// Keterangan
			$rekening2->Keterangan->ViewValue = $rekening2->Keterangan->CurrentValue;
			$rekening2->Keterangan->ViewCustomAttributes = "";

			// D/K
			$rekening2->D2FK->ViewValue = $rekening2->D2FK->CurrentValue;
			$rekening2->D2FK->ViewCustomAttributes = "";

			// SaldoAwal
			$rekening2->SaldoAwal->ViewValue = $rekening2->SaldoAwal->CurrentValue;
			$rekening2->SaldoAwal->ViewCustomAttributes = "";

			// Saldo
			$rekening2->Saldo->ViewValue = $rekening2->Saldo->CurrentValue;
			$rekening2->Saldo->ViewCustomAttributes = "";

			// TanggalSaldo
			$rekening2->TanggalSaldo->ViewValue = $rekening2->TanggalSaldo->CurrentValue;
			$rekening2->TanggalSaldo->ViewValue = ew_FormatDateTime($rekening2->TanggalSaldo->ViewValue, 7);
			$rekening2->TanggalSaldo->ViewCustomAttributes = "";

			// target
			$rekening2->target->ViewValue = $rekening2->target->CurrentValue;
			$rekening2->target->ViewCustomAttributes = "";

			// id
			$rekening2->id->ViewValue = $rekening2->id->CurrentValue;
			$rekening2->id->ViewCustomAttributes = "";

			// debet_kali
			$rekening2->debet_kali->ViewValue = $rekening2->debet_kali->CurrentValue;
			$rekening2->debet_kali->ViewCustomAttributes = "";

			// kredit_kali
			$rekening2->kredit_kali->ViewValue = $rekening2->kredit_kali->CurrentValue;
			$rekening2->kredit_kali->ViewCustomAttributes = "";

			// kodePokok
			$rekening2->kodePokok->LinkCustomAttributes = "";
			$rekening2->kodePokok->HrefValue = "";
			$rekening2->kodePokok->TooltipValue = "";

			// kodeSubSatu
			$rekening2->kodeSubSatu->LinkCustomAttributes = "";
			$rekening2->kodeSubSatu->HrefValue = "";
			$rekening2->kodeSubSatu->TooltipValue = "";

			// kodeSubDua
			$rekening2->kodeSubDua->LinkCustomAttributes = "";
			$rekening2->kodeSubDua->HrefValue = "";
			$rekening2->kodeSubDua->TooltipValue = "";

			// kodeSubTiga
			$rekening2->kodeSubTiga->LinkCustomAttributes = "";
			$rekening2->kodeSubTiga->HrefValue = "";
			$rekening2->kodeSubTiga->TooltipValue = "";

			// Norek
			$rekening2->Norek->LinkCustomAttributes = "";
			$rekening2->Norek->HrefValue = "";
			$rekening2->Norek->TooltipValue = "";

			// Keterangan
			$rekening2->Keterangan->LinkCustomAttributes = "";
			$rekening2->Keterangan->HrefValue = "";
			$rekening2->Keterangan->TooltipValue = "";

			// D/K
			$rekening2->D2FK->LinkCustomAttributes = "";
			$rekening2->D2FK->HrefValue = "";
			$rekening2->D2FK->TooltipValue = "";

			// SaldoAwal
			$rekening2->SaldoAwal->LinkCustomAttributes = "";
			$rekening2->SaldoAwal->HrefValue = "";
			$rekening2->SaldoAwal->TooltipValue = "";

			// Saldo
			$rekening2->Saldo->LinkCustomAttributes = "";
			$rekening2->Saldo->HrefValue = "";
			$rekening2->Saldo->TooltipValue = "";

			// TanggalSaldo
			$rekening2->TanggalSaldo->LinkCustomAttributes = "";
			$rekening2->TanggalSaldo->HrefValue = "";
			$rekening2->TanggalSaldo->TooltipValue = "";

			// target
			$rekening2->target->LinkCustomAttributes = "";
			$rekening2->target->HrefValue = "";
			$rekening2->target->TooltipValue = "";

			// id
			$rekening2->id->LinkCustomAttributes = "";
			$rekening2->id->HrefValue = "";
			$rekening2->id->TooltipValue = "";

			// debet_kali
			$rekening2->debet_kali->LinkCustomAttributes = "";
			$rekening2->debet_kali->HrefValue = "";
			$rekening2->debet_kali->TooltipValue = "";

			// kredit_kali
			$rekening2->kredit_kali->LinkCustomAttributes = "";
			$rekening2->kredit_kali->HrefValue = "";
			$rekening2->kredit_kali->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($rekening2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$rekening2->Row_Rendered();
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

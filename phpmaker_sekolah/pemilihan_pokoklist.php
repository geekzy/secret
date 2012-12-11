<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pemilihan_pokokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pemilihan_pokok_list = new cpemilihan_pokok_list();
$Page =& $pemilihan_pokok_list;

// Page init
$pemilihan_pokok_list->Page_Init();

// Page main
$pemilihan_pokok_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($pemilihan_pokok->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pemilihan_pokok_list = new ew_Page("pemilihan_pokok_list");

// page properties
pemilihan_pokok_list.PageID = "list"; // page ID
pemilihan_pokok_list.FormID = "fpemilihan_pokoklist"; // form ID
var EW_PAGE_ID = pemilihan_pokok_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pemilihan_pokok_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pemilihan_pokok_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pemilihan_pokok_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($pemilihan_pokok->Export == "") || (EW_EXPORT_MASTER_RECORD && $pemilihan_pokok->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pemilihan_pokok_list->TotalRecs = $pemilihan_pokok->SelectRecordCount();
	} else {
		if ($pemilihan_pokok_list->Recordset = $pemilihan_pokok_list->LoadRecordset())
			$pemilihan_pokok_list->TotalRecs = $pemilihan_pokok_list->Recordset->RecordCount();
	}
	$pemilihan_pokok_list->StartRec = 1;
	if ($pemilihan_pokok_list->DisplayRecs <= 0 || ($pemilihan_pokok->Export <> "" && $pemilihan_pokok->ExportAll)) // Display all records
		$pemilihan_pokok_list->DisplayRecs = $pemilihan_pokok_list->TotalRecs;
	if (!($pemilihan_pokok->Export <> "" && $pemilihan_pokok->ExportAll))
		$pemilihan_pokok_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pemilihan_pokok_list->Recordset = $pemilihan_pokok_list->LoadRecordset($pemilihan_pokok_list->StartRec-1, $pemilihan_pokok_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $pemilihan_pokok->TableCaption() ?>
&nbsp;&nbsp;<?php $pemilihan_pokok_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($pemilihan_pokok->Export == "" && $pemilihan_pokok->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(pemilihan_pokok_list);" style="text-decoration: none;"><img id="pemilihan_pokok_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="pemilihan_pokok_list_SearchPanel">
<form name="fpemilihan_pokoklistsrch" id="fpemilihan_pokoklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="pemilihan_pokok">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($pemilihan_pokok->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $pemilihan_pokok_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($pemilihan_pokok->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($pemilihan_pokok->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($pemilihan_pokok->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $pemilihan_pokok_list->ShowPageHeader(); ?>
<?php
$pemilihan_pokok_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($pemilihan_pokok->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($pemilihan_pokok->CurrentAction <> "gridadd" && $pemilihan_pokok->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($pemilihan_pokok_list->Pager)) $pemilihan_pokok_list->Pager = new cNumericPager($pemilihan_pokok_list->StartRec, $pemilihan_pokok_list->DisplayRecs, $pemilihan_pokok_list->TotalRecs, $pemilihan_pokok_list->RecRange) ?>
<?php if ($pemilihan_pokok_list->Pager->RecordCount > 0) { ?>
	<?php if ($pemilihan_pokok_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_pokok_list->PageUrl() ?>start=<?php echo $pemilihan_pokok_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_pokok_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_pokok_list->PageUrl() ?>start=<?php echo $pemilihan_pokok_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($pemilihan_pokok_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $pemilihan_pokok_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_pokok_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_pokok_list->PageUrl() ?>start=<?php echo $pemilihan_pokok_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_pokok_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_pokok_list->PageUrl() ?>start=<?php echo $pemilihan_pokok_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_pokok_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pemilihan_pokok_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pemilihan_pokok_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pemilihan_pokok_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($pemilihan_pokok_list->SearchWhere == "0=101") { ?>
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
<?php if ($pemilihan_pokok_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="pemilihan_pokok">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($pemilihan_pokok_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($pemilihan_pokok_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($pemilihan_pokok_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($pemilihan_pokok_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($pemilihan_pokok_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($pemilihan_pokok_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($pemilihan_pokok_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($pemilihan_pokok_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($pemilihan_pokok_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $pemilihan_pokok_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fpemilihan_pokoklist" id="fpemilihan_pokoklist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="pemilihan_pokok">
<div id="gmp_pemilihan_pokok" class="ewGridMiddlePanel">
<?php if ($pemilihan_pokok_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pemilihan_pokok->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pemilihan_pokok_list->RenderListOptions();

// Render list options (header, left)
$pemilihan_pokok_list->ListOptions->Render("header", "left");
?>
<?php if ($pemilihan_pokok->kodePokok->Visible) { // kodePokok ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->kodePokok) == "") { ?>
		<td><?php echo $pemilihan_pokok->kodePokok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->kodePokok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->kodePokok->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->kodePokok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->kodePokok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->nama_pokok->Visible) { // nama_pokok ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->nama_pokok) == "") { ?>
		<td><?php echo $pemilihan_pokok->nama_pokok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->nama_pokok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->nama_pokok->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->nama_pokok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->nama_pokok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->kodeSubSatu) == "") { ?>
		<td><?php echo $pemilihan_pokok->kodeSubSatu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->kodeSubSatu) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->kodeSubSatu->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->kodeSubSatu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->kodeSubSatu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->nama_sub_satu->Visible) { // nama_sub_satu ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->nama_sub_satu) == "") { ?>
		<td><?php echo $pemilihan_pokok->nama_sub_satu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->nama_sub_satu) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->nama_sub_satu->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->nama_sub_satu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->nama_sub_satu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->kodeSubDua->Visible) { // kodeSubDua ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->kodeSubDua) == "") { ?>
		<td><?php echo $pemilihan_pokok->kodeSubDua->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->kodeSubDua) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->kodeSubDua->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->kodeSubDua->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->kodeSubDua->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->nama_sub_dua->Visible) { // nama_sub_dua ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->nama_sub_dua) == "") { ?>
		<td><?php echo $pemilihan_pokok->nama_sub_dua->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->nama_sub_dua) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->nama_sub_dua->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->nama_sub_dua->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->nama_sub_dua->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->kodeSubTiga->Visible) { // kodeSubTiga ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->kodeSubTiga) == "") { ?>
		<td><?php echo $pemilihan_pokok->kodeSubTiga->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->kodeSubTiga) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->kodeSubTiga->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->kodeSubTiga->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->kodeSubTiga->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->nama_sub_tiga->Visible) { // nama_sub_tiga ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->nama_sub_tiga) == "") { ?>
		<td><?php echo $pemilihan_pokok->nama_sub_tiga->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->nama_sub_tiga) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->nama_sub_tiga->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->nama_sub_tiga->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->nama_sub_tiga->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->Norek->Visible) { // Norek ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->Norek) == "") { ?>
		<td><?php echo $pemilihan_pokok->Norek->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->Norek) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->Norek->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->Norek->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->Norek->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->Keterangan->Visible) { // Keterangan ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->Keterangan) == "") { ?>
		<td><?php echo $pemilihan_pokok->Keterangan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->Keterangan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->Keterangan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->Keterangan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->Keterangan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->D2FK->Visible) { // D/K ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->D2FK) == "") { ?>
		<td><?php echo $pemilihan_pokok->D2FK->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->D2FK) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->D2FK->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->D2FK->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->D2FK->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->SaldoAwal->Visible) { // SaldoAwal ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->SaldoAwal) == "") { ?>
		<td><?php echo $pemilihan_pokok->SaldoAwal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->SaldoAwal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->SaldoAwal->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->SaldoAwal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->SaldoAwal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->TanggalSaldo->Visible) { // TanggalSaldo ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->TanggalSaldo) == "") { ?>
		<td><?php echo $pemilihan_pokok->TanggalSaldo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->TanggalSaldo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->TanggalSaldo->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->TanggalSaldo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->TanggalSaldo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->Saldo->Visible) { // Saldo ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->Saldo) == "") { ?>
		<td><?php echo $pemilihan_pokok->Saldo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->Saldo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->Saldo->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->Saldo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->Saldo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->target->Visible) { // target ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->target) == "") { ?>
		<td><?php echo $pemilihan_pokok->target->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->target) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->target->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->target->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->target->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_pokok->id->Visible) { // id ?>
	<?php if ($pemilihan_pokok->SortUrl($pemilihan_pokok->id) == "") { ?>
		<td><?php echo $pemilihan_pokok->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_pokok->SortUrl($pemilihan_pokok->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_pokok->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_pokok->id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_pokok->id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pemilihan_pokok_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($pemilihan_pokok->ExportAll && $pemilihan_pokok->Export <> "") {
	$pemilihan_pokok_list->StopRec = $pemilihan_pokok_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pemilihan_pokok_list->TotalRecs > $pemilihan_pokok_list->StartRec + $pemilihan_pokok_list->DisplayRecs - 1)
		$pemilihan_pokok_list->StopRec = $pemilihan_pokok_list->StartRec + $pemilihan_pokok_list->DisplayRecs - 1;
	else
		$pemilihan_pokok_list->StopRec = $pemilihan_pokok_list->TotalRecs;
}
$pemilihan_pokok_list->RecCnt = $pemilihan_pokok_list->StartRec - 1;
if ($pemilihan_pokok_list->Recordset && !$pemilihan_pokok_list->Recordset->EOF) {
	$pemilihan_pokok_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $pemilihan_pokok_list->StartRec > 1)
		$pemilihan_pokok_list->Recordset->Move($pemilihan_pokok_list->StartRec - 1);
} elseif (!$pemilihan_pokok->AllowAddDeleteRow && $pemilihan_pokok_list->StopRec == 0) {
	$pemilihan_pokok_list->StopRec = $pemilihan_pokok->GridAddRowCount;
}

// Initialize aggregate
$pemilihan_pokok->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pemilihan_pokok->ResetAttrs();
$pemilihan_pokok_list->RenderRow();
$pemilihan_pokok_list->RowCnt = 0;
while ($pemilihan_pokok_list->RecCnt < $pemilihan_pokok_list->StopRec) {
	$pemilihan_pokok_list->RecCnt++;
	if (intval($pemilihan_pokok_list->RecCnt) >= intval($pemilihan_pokok_list->StartRec)) {
		$pemilihan_pokok_list->RowCnt++;

		// Set up key count
		$pemilihan_pokok_list->KeyCount = $pemilihan_pokok_list->RowIndex;

		// Init row class and style
		$pemilihan_pokok->ResetAttrs();
		$pemilihan_pokok->CssClass = "";
		if ($pemilihan_pokok->CurrentAction == "gridadd") {
		} else {
			$pemilihan_pokok_list->LoadRowValues($pemilihan_pokok_list->Recordset); // Load row values
		}
		$pemilihan_pokok->RowType = EW_ROWTYPE_VIEW; // Render view
		$pemilihan_pokok->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$pemilihan_pokok_list->RenderRow();

		// Render list options
		$pemilihan_pokok_list->RenderListOptions();
?>
	<tr<?php echo $pemilihan_pokok->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pemilihan_pokok_list->ListOptions->Render("body", "left");
?>
	<?php if ($pemilihan_pokok->kodePokok->Visible) { // kodePokok ?>
		<td<?php echo $pemilihan_pokok->kodePokok->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->kodePokok->ViewAttributes() ?>><?php echo $pemilihan_pokok->kodePokok->ListViewValue() ?></div>
<a name="<?php echo $pemilihan_pokok_list->PageObjName . "_row_" . $pemilihan_pokok_list->RowCnt ?>" id="<?php echo $pemilihan_pokok_list->PageObjName . "_row_" . $pemilihan_pokok_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($pemilihan_pokok->nama_pokok->Visible) { // nama_pokok ?>
		<td<?php echo $pemilihan_pokok->nama_pokok->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->nama_pokok->ViewAttributes() ?>><?php echo $pemilihan_pokok->nama_pokok->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->kodeSubSatu->Visible) { // kodeSubSatu ?>
		<td<?php echo $pemilihan_pokok->kodeSubSatu->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->kodeSubSatu->ViewAttributes() ?>><?php echo $pemilihan_pokok->kodeSubSatu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->nama_sub_satu->Visible) { // nama_sub_satu ?>
		<td<?php echo $pemilihan_pokok->nama_sub_satu->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->nama_sub_satu->ViewAttributes() ?>><?php echo $pemilihan_pokok->nama_sub_satu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->kodeSubDua->Visible) { // kodeSubDua ?>
		<td<?php echo $pemilihan_pokok->kodeSubDua->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->kodeSubDua->ViewAttributes() ?>><?php echo $pemilihan_pokok->kodeSubDua->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->nama_sub_dua->Visible) { // nama_sub_dua ?>
		<td<?php echo $pemilihan_pokok->nama_sub_dua->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->nama_sub_dua->ViewAttributes() ?>><?php echo $pemilihan_pokok->nama_sub_dua->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->kodeSubTiga->Visible) { // kodeSubTiga ?>
		<td<?php echo $pemilihan_pokok->kodeSubTiga->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->kodeSubTiga->ViewAttributes() ?>><?php echo $pemilihan_pokok->kodeSubTiga->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->nama_sub_tiga->Visible) { // nama_sub_tiga ?>
		<td<?php echo $pemilihan_pokok->nama_sub_tiga->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->nama_sub_tiga->ViewAttributes() ?>><?php echo $pemilihan_pokok->nama_sub_tiga->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->Norek->Visible) { // Norek ?>
		<td<?php echo $pemilihan_pokok->Norek->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->Norek->ViewAttributes() ?>><?php echo $pemilihan_pokok->Norek->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->Keterangan->Visible) { // Keterangan ?>
		<td<?php echo $pemilihan_pokok->Keterangan->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->Keterangan->ViewAttributes() ?>><?php echo $pemilihan_pokok->Keterangan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->D2FK->Visible) { // D/K ?>
		<td<?php echo $pemilihan_pokok->D2FK->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->D2FK->ViewAttributes() ?>><?php echo $pemilihan_pokok->D2FK->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->SaldoAwal->Visible) { // SaldoAwal ?>
		<td<?php echo $pemilihan_pokok->SaldoAwal->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->SaldoAwal->ViewAttributes() ?>><?php echo $pemilihan_pokok->SaldoAwal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->TanggalSaldo->Visible) { // TanggalSaldo ?>
		<td<?php echo $pemilihan_pokok->TanggalSaldo->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->TanggalSaldo->ViewAttributes() ?>><?php echo $pemilihan_pokok->TanggalSaldo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->Saldo->Visible) { // Saldo ?>
		<td<?php echo $pemilihan_pokok->Saldo->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->Saldo->ViewAttributes() ?>><?php echo $pemilihan_pokok->Saldo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->target->Visible) { // target ?>
		<td<?php echo $pemilihan_pokok->target->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->target->ViewAttributes() ?>><?php echo $pemilihan_pokok->target->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_pokok->id->Visible) { // id ?>
		<td<?php echo $pemilihan_pokok->id->CellAttributes() ?>>
<div<?php echo $pemilihan_pokok->id->ViewAttributes() ?>><?php echo $pemilihan_pokok->id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pemilihan_pokok_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($pemilihan_pokok->CurrentAction <> "gridadd")
		$pemilihan_pokok_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pemilihan_pokok_list->Recordset)
	$pemilihan_pokok_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($pemilihan_pokok->Export == "" && $pemilihan_pokok->CurrentAction == "") { ?>
<?php } ?>
<?php
$pemilihan_pokok_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pemilihan_pokok->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pemilihan_pokok_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpemilihan_pokok_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'pemilihan_pokok';

	// Page object name
	var $PageObjName = 'pemilihan_pokok_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pemilihan_pokok;
		if ($pemilihan_pokok->UseTokenInUrl) $PageUrl .= "t=" . $pemilihan_pokok->TableVar . "&"; // Add page token
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
		global $objForm, $pemilihan_pokok;
		if ($pemilihan_pokok->UseTokenInUrl) {
			if ($objForm)
				return ($pemilihan_pokok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pemilihan_pokok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpemilihan_pokok_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pemilihan_pokok)
		if (!isset($GLOBALS["pemilihan_pokok"])) {
			$GLOBALS["pemilihan_pokok"] = new cpemilihan_pokok();
			$GLOBALS["Table"] =& $GLOBALS["pemilihan_pokok"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "pemilihan_pokokadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pemilihan_pokokdelete.php";
		$this->MultiUpdateUrl = "pemilihan_pokokupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pemilihan_pokok', TRUE);

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
		global $pemilihan_pokok;

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
			$pemilihan_pokok->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $pemilihan_pokok;

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
			if ($pemilihan_pokok->Export <> "" ||
				$pemilihan_pokok->CurrentAction == "gridadd" ||
				$pemilihan_pokok->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$pemilihan_pokok->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($pemilihan_pokok->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $pemilihan_pokok->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$pemilihan_pokok->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$pemilihan_pokok->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$pemilihan_pokok->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $pemilihan_pokok->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$pemilihan_pokok->setSessionWhere($sFilter);
		$pemilihan_pokok->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $pemilihan_pokok;
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
			$pemilihan_pokok->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$pemilihan_pokok->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $pemilihan_pokok;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->kodePokok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->nama_pokok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->kodeSubSatu, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->nama_sub_satu, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->kodeSubDua, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->nama_sub_dua, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->kodeSubTiga, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->nama_sub_tiga, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->Norek, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->Keterangan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pemilihan_pokok->D2FK, $Keyword);
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
		global $Security, $pemilihan_pokok;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $pemilihan_pokok->BasicSearchKeyword;
		$sSearchType = $pemilihan_pokok->BasicSearchType;
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
			$pemilihan_pokok->setSessionBasicSearchKeyword($sSearchKeyword);
			$pemilihan_pokok->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $pemilihan_pokok;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$pemilihan_pokok->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $pemilihan_pokok;
		$pemilihan_pokok->setSessionBasicSearchKeyword("");
		$pemilihan_pokok->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $pemilihan_pokok;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$pemilihan_pokok->BasicSearchKeyword = $pemilihan_pokok->getSessionBasicSearchKeyword();
			$pemilihan_pokok->BasicSearchType = $pemilihan_pokok->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pemilihan_pokok;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pemilihan_pokok->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pemilihan_pokok->CurrentOrderType = @$_GET["ordertype"];
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->kodePokok); // kodePokok
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->nama_pokok); // nama_pokok
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->kodeSubSatu); // kodeSubSatu
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->nama_sub_satu); // nama_sub_satu
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->kodeSubDua); // kodeSubDua
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->nama_sub_dua); // nama_sub_dua
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->kodeSubTiga); // kodeSubTiga
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->nama_sub_tiga); // nama_sub_tiga
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->Norek); // Norek
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->Keterangan); // Keterangan
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->D2FK); // D/K
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->SaldoAwal); // SaldoAwal
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->TanggalSaldo); // TanggalSaldo
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->Saldo); // Saldo
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->target); // target
			$pemilihan_pokok->UpdateSort($pemilihan_pokok->id); // id
			$pemilihan_pokok->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $pemilihan_pokok;
		$sOrderBy = $pemilihan_pokok->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($pemilihan_pokok->SqlOrderBy() <> "") {
				$sOrderBy = $pemilihan_pokok->SqlOrderBy();
				$pemilihan_pokok->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $pemilihan_pokok;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$pemilihan_pokok->setSessionOrderBy($sOrderBy);
				$pemilihan_pokok->setSessionOrderByList($sOrderBy);
				$pemilihan_pokok->kodePokok->setSort("");
				$pemilihan_pokok->nama_pokok->setSort("");
				$pemilihan_pokok->kodeSubSatu->setSort("");
				$pemilihan_pokok->nama_sub_satu->setSort("");
				$pemilihan_pokok->kodeSubDua->setSort("");
				$pemilihan_pokok->nama_sub_dua->setSort("");
				$pemilihan_pokok->kodeSubTiga->setSort("");
				$pemilihan_pokok->nama_sub_tiga->setSort("");
				$pemilihan_pokok->Norek->setSort("");
				$pemilihan_pokok->Keterangan->setSort("");
				$pemilihan_pokok->D2FK->setSort("");
				$pemilihan_pokok->SaldoAwal->setSort("");
				$pemilihan_pokok->TanggalSaldo->setSort("");
				$pemilihan_pokok->Saldo->setSort("");
				$pemilihan_pokok->target->setSort("");
				$pemilihan_pokok->id->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$pemilihan_pokok->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $pemilihan_pokok;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $pemilihan_pokok, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $pemilihan_pokok;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pemilihan_pokok;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$pemilihan_pokok->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$pemilihan_pokok->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $pemilihan_pokok->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$pemilihan_pokok->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$pemilihan_pokok->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$pemilihan_pokok->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $pemilihan_pokok;
		$pemilihan_pokok->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$pemilihan_pokok->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pemilihan_pokok;

		// Call Recordset Selecting event
		$pemilihan_pokok->Recordset_Selecting($pemilihan_pokok->CurrentFilter);

		// Load List page SQL
		$sSql = $pemilihan_pokok->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pemilihan_pokok->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pemilihan_pokok;
		$sFilter = $pemilihan_pokok->KeyFilter();

		// Call Row Selecting event
		$pemilihan_pokok->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pemilihan_pokok->CurrentFilter = $sFilter;
		$sSql = $pemilihan_pokok->SQL();
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
		global $conn, $pemilihan_pokok;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pemilihan_pokok->Row_Selected($row);
		$pemilihan_pokok->kodePokok->setDbValue($rs->fields('kodePokok'));
		if (array_key_exists('EV__kodePokok', $rs->fields)) {
			$pemilihan_pokok->kodePokok->VirtualValue = $rs->fields('EV__kodePokok'); // Set up virtual field value
		} else {
			$pemilihan_pokok->kodePokok->VirtualValue = ""; // Clear value
		}
		$pemilihan_pokok->nama_pokok->setDbValue($rs->fields('nama_pokok'));
		$pemilihan_pokok->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$pemilihan_pokok->nama_sub_satu->setDbValue($rs->fields('nama_sub_satu'));
		$pemilihan_pokok->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$pemilihan_pokok->nama_sub_dua->setDbValue($rs->fields('nama_sub_dua'));
		$pemilihan_pokok->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$pemilihan_pokok->nama_sub_tiga->setDbValue($rs->fields('nama_sub_tiga'));
		$pemilihan_pokok->Norek->setDbValue($rs->fields('Norek'));
		$pemilihan_pokok->Keterangan->setDbValue($rs->fields('Keterangan'));
		$pemilihan_pokok->D2FK->setDbValue($rs->fields('D/K'));
		$pemilihan_pokok->SaldoAwal->setDbValue($rs->fields('SaldoAwal'));
		$pemilihan_pokok->TanggalSaldo->setDbValue($rs->fields('TanggalSaldo'));
		$pemilihan_pokok->Saldo->setDbValue($rs->fields('Saldo'));
		$pemilihan_pokok->target->setDbValue($rs->fields('target'));
		$pemilihan_pokok->id->setDbValue($rs->fields('id'));
	}

	// Load old record
	function LoadOldRecord() {
		global $pemilihan_pokok;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pemilihan_pokok->getKey("id")) <> "")
			$pemilihan_pokok->id->CurrentValue = $pemilihan_pokok->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pemilihan_pokok->CurrentFilter = $pemilihan_pokok->KeyFilter();
			$sSql = $pemilihan_pokok->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pemilihan_pokok;

		// Initialize URLs
		$this->ViewUrl = $pemilihan_pokok->ViewUrl();
		$this->EditUrl = $pemilihan_pokok->EditUrl();
		$this->InlineEditUrl = $pemilihan_pokok->InlineEditUrl();
		$this->CopyUrl = $pemilihan_pokok->CopyUrl();
		$this->InlineCopyUrl = $pemilihan_pokok->InlineCopyUrl();
		$this->DeleteUrl = $pemilihan_pokok->DeleteUrl();

		// Call Row_Rendering event
		$pemilihan_pokok->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// nama_pokok
		// kodeSubSatu
		// nama_sub_satu
		// kodeSubDua
		// nama_sub_dua
		// kodeSubTiga
		// nama_sub_tiga
		// Norek
		// Keterangan
		// D/K
		// SaldoAwal
		// TanggalSaldo
		// Saldo
		// target
		// id

		if ($pemilihan_pokok->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			if ($pemilihan_pokok->kodePokok->VirtualValue <> "") {
				$pemilihan_pokok->kodePokok->ViewValue = $pemilihan_pokok->kodePokok->VirtualValue;
			} else {
			if (strval($pemilihan_pokok->kodePokok->CurrentValue) <> "") {
				$sFilterWrk = "`kodePokok` = '" . ew_AdjustSql($pemilihan_pokok->kodePokok->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kodePokok`, `namaPokok` FROM `pokokrek`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_pokok->kodePokok->ViewValue = $rswrk->fields('kodePokok');
					$pemilihan_pokok->kodePokok->ViewValue .= ew_ValueSeparator(0,1,$pemilihan_pokok->kodePokok) . $rswrk->fields('namaPokok');
					$rswrk->Close();
				} else {
					$pemilihan_pokok->kodePokok->ViewValue = $pemilihan_pokok->kodePokok->CurrentValue;
				}
			} else {
				$pemilihan_pokok->kodePokok->ViewValue = NULL;
			}
			}
			$pemilihan_pokok->kodePokok->ViewCustomAttributes = "";

			// nama_pokok
			if (strval($pemilihan_pokok->nama_pokok->CurrentValue) <> "") {
				$sFilterWrk = "`namaPokok` = '" . ew_AdjustSql($pemilihan_pokok->nama_pokok->CurrentValue) . "'";
			$sSqlWrk = "SELECT `namaPokok` FROM `pokokrek`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_pokok->nama_pokok->ViewValue = $rswrk->fields('namaPokok');
					$rswrk->Close();
				} else {
					$pemilihan_pokok->nama_pokok->ViewValue = $pemilihan_pokok->nama_pokok->CurrentValue;
				}
			} else {
				$pemilihan_pokok->nama_pokok->ViewValue = NULL;
			}
			$pemilihan_pokok->nama_pokok->ViewCustomAttributes = "";

			// kodeSubSatu
			if (strval($pemilihan_pokok->kodeSubSatu->CurrentValue) <> "") {
				$sFilterWrk = "`kodeSubSatu` = '" . ew_AdjustSql($pemilihan_pokok->kodeSubSatu->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kodeSubSatu`, `namaSubSatu` FROM `subsaturek`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_pokok->kodeSubSatu->ViewValue = $rswrk->fields('kodeSubSatu');
					$pemilihan_pokok->kodeSubSatu->ViewValue .= ew_ValueSeparator(0,1,$pemilihan_pokok->kodeSubSatu) . $rswrk->fields('namaSubSatu');
					$rswrk->Close();
				} else {
					$pemilihan_pokok->kodeSubSatu->ViewValue = $pemilihan_pokok->kodeSubSatu->CurrentValue;
				}
			} else {
				$pemilihan_pokok->kodeSubSatu->ViewValue = NULL;
			}
			$pemilihan_pokok->kodeSubSatu->ViewCustomAttributes = "";

			// nama_sub_satu
			$pemilihan_pokok->nama_sub_satu->ViewValue = $pemilihan_pokok->nama_sub_satu->CurrentValue;
			$pemilihan_pokok->nama_sub_satu->ViewCustomAttributes = "";

			// kodeSubDua
			$pemilihan_pokok->kodeSubDua->ViewValue = $pemilihan_pokok->kodeSubDua->CurrentValue;
			$pemilihan_pokok->kodeSubDua->ViewCustomAttributes = "";

			// nama_sub_dua
			$pemilihan_pokok->nama_sub_dua->ViewValue = $pemilihan_pokok->nama_sub_dua->CurrentValue;
			$pemilihan_pokok->nama_sub_dua->ViewCustomAttributes = "";

			// kodeSubTiga
			$pemilihan_pokok->kodeSubTiga->ViewValue = $pemilihan_pokok->kodeSubTiga->CurrentValue;
			$pemilihan_pokok->kodeSubTiga->ViewCustomAttributes = "";

			// nama_sub_tiga
			$pemilihan_pokok->nama_sub_tiga->ViewValue = $pemilihan_pokok->nama_sub_tiga->CurrentValue;
			$pemilihan_pokok->nama_sub_tiga->ViewCustomAttributes = "";

			// Norek
			$pemilihan_pokok->Norek->ViewValue = $pemilihan_pokok->Norek->CurrentValue;
			$pemilihan_pokok->Norek->ViewCustomAttributes = "";

			// Keterangan
			$pemilihan_pokok->Keterangan->ViewValue = $pemilihan_pokok->Keterangan->CurrentValue;
			$pemilihan_pokok->Keterangan->ViewCustomAttributes = "";

			// D/K
			$pemilihan_pokok->D2FK->ViewValue = $pemilihan_pokok->D2FK->CurrentValue;
			$pemilihan_pokok->D2FK->ViewCustomAttributes = "";

			// SaldoAwal
			$pemilihan_pokok->SaldoAwal->ViewValue = $pemilihan_pokok->SaldoAwal->CurrentValue;
			$pemilihan_pokok->SaldoAwal->ViewCustomAttributes = "";

			// TanggalSaldo
			$pemilihan_pokok->TanggalSaldo->ViewValue = $pemilihan_pokok->TanggalSaldo->CurrentValue;
			$pemilihan_pokok->TanggalSaldo->ViewValue = ew_FormatDateTime($pemilihan_pokok->TanggalSaldo->ViewValue, 7);
			$pemilihan_pokok->TanggalSaldo->ViewCustomAttributes = "";

			// Saldo
			$pemilihan_pokok->Saldo->ViewValue = $pemilihan_pokok->Saldo->CurrentValue;
			$pemilihan_pokok->Saldo->ViewCustomAttributes = "";

			// target
			$pemilihan_pokok->target->ViewValue = $pemilihan_pokok->target->CurrentValue;
			$pemilihan_pokok->target->ViewCustomAttributes = "";

			// id
			$pemilihan_pokok->id->ViewValue = $pemilihan_pokok->id->CurrentValue;
			$pemilihan_pokok->id->ViewCustomAttributes = "";

			// kodePokok
			$pemilihan_pokok->kodePokok->LinkCustomAttributes = "";
			$pemilihan_pokok->kodePokok->HrefValue = "";
			$pemilihan_pokok->kodePokok->TooltipValue = "";

			// nama_pokok
			$pemilihan_pokok->nama_pokok->LinkCustomAttributes = "";
			$pemilihan_pokok->nama_pokok->HrefValue = "";
			$pemilihan_pokok->nama_pokok->TooltipValue = "";

			// kodeSubSatu
			$pemilihan_pokok->kodeSubSatu->LinkCustomAttributes = "";
			$pemilihan_pokok->kodeSubSatu->HrefValue = "";
			$pemilihan_pokok->kodeSubSatu->TooltipValue = "";

			// nama_sub_satu
			$pemilihan_pokok->nama_sub_satu->LinkCustomAttributes = "";
			$pemilihan_pokok->nama_sub_satu->HrefValue = "";
			$pemilihan_pokok->nama_sub_satu->TooltipValue = "";

			// kodeSubDua
			$pemilihan_pokok->kodeSubDua->LinkCustomAttributes = "";
			$pemilihan_pokok->kodeSubDua->HrefValue = "";
			$pemilihan_pokok->kodeSubDua->TooltipValue = "";

			// nama_sub_dua
			$pemilihan_pokok->nama_sub_dua->LinkCustomAttributes = "";
			$pemilihan_pokok->nama_sub_dua->HrefValue = "";
			$pemilihan_pokok->nama_sub_dua->TooltipValue = "";

			// kodeSubTiga
			$pemilihan_pokok->kodeSubTiga->LinkCustomAttributes = "";
			$pemilihan_pokok->kodeSubTiga->HrefValue = "";
			$pemilihan_pokok->kodeSubTiga->TooltipValue = "";

			// nama_sub_tiga
			$pemilihan_pokok->nama_sub_tiga->LinkCustomAttributes = "";
			$pemilihan_pokok->nama_sub_tiga->HrefValue = "";
			$pemilihan_pokok->nama_sub_tiga->TooltipValue = "";

			// Norek
			$pemilihan_pokok->Norek->LinkCustomAttributes = "";
			$pemilihan_pokok->Norek->HrefValue = "";
			$pemilihan_pokok->Norek->TooltipValue = "";

			// Keterangan
			$pemilihan_pokok->Keterangan->LinkCustomAttributes = "";
			$pemilihan_pokok->Keterangan->HrefValue = "";
			$pemilihan_pokok->Keterangan->TooltipValue = "";

			// D/K
			$pemilihan_pokok->D2FK->LinkCustomAttributes = "";
			$pemilihan_pokok->D2FK->HrefValue = "";
			$pemilihan_pokok->D2FK->TooltipValue = "";

			// SaldoAwal
			$pemilihan_pokok->SaldoAwal->LinkCustomAttributes = "";
			$pemilihan_pokok->SaldoAwal->HrefValue = "";
			$pemilihan_pokok->SaldoAwal->TooltipValue = "";

			// TanggalSaldo
			$pemilihan_pokok->TanggalSaldo->LinkCustomAttributes = "";
			$pemilihan_pokok->TanggalSaldo->HrefValue = "";
			$pemilihan_pokok->TanggalSaldo->TooltipValue = "";

			// Saldo
			$pemilihan_pokok->Saldo->LinkCustomAttributes = "";
			$pemilihan_pokok->Saldo->HrefValue = "";
			$pemilihan_pokok->Saldo->TooltipValue = "";

			// target
			$pemilihan_pokok->target->LinkCustomAttributes = "";
			$pemilihan_pokok->target->HrefValue = "";
			$pemilihan_pokok->target->TooltipValue = "";

			// id
			$pemilihan_pokok->id->LinkCustomAttributes = "";
			$pemilihan_pokok->id->HrefValue = "";
			$pemilihan_pokok->id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pemilihan_pokok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pemilihan_pokok->Row_Rendered();
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

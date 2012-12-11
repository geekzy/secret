<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tahap5info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tahap5_list = new ctahap5_list();
$Page =& $tahap5_list;

// Page init
$tahap5_list->Page_Init();

// Page main
$tahap5_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($tahap5->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tahap5_list = new ew_Page("tahap5_list");

// page properties
tahap5_list.PageID = "list"; // page ID
tahap5_list.FormID = "ftahap5list"; // form ID
var EW_PAGE_ID = tahap5_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tahap5_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tahap5_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tahap5_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($tahap5->Export == "") || (EW_EXPORT_MASTER_RECORD && $tahap5->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tahap5_list->TotalRecs = $tahap5->SelectRecordCount();
	} else {
		if ($tahap5_list->Recordset = $tahap5_list->LoadRecordset())
			$tahap5_list->TotalRecs = $tahap5_list->Recordset->RecordCount();
	}
	$tahap5_list->StartRec = 1;
	if ($tahap5_list->DisplayRecs <= 0 || ($tahap5->Export <> "" && $tahap5->ExportAll)) // Display all records
		$tahap5_list->DisplayRecs = $tahap5_list->TotalRecs;
	if (!($tahap5->Export <> "" && $tahap5->ExportAll))
		$tahap5_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$tahap5_list->Recordset = $tahap5_list->LoadRecordset($tahap5_list->StartRec-1, $tahap5_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $tahap5->TableCaption() ?>
&nbsp;&nbsp;<?php $tahap5_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tahap5->Export == "" && $tahap5->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tahap5_list);" style="text-decoration: none;"><img id="tahap5_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tahap5_list_SearchPanel">
<form name="ftahap5listsrch" id="ftahap5listsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tahap5">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tahap5->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $tahap5_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tahap5->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tahap5->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tahap5->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $tahap5_list->ShowPageHeader(); ?>
<?php
$tahap5_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tahap5->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tahap5->CurrentAction <> "gridadd" && $tahap5->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($tahap5_list->Pager)) $tahap5_list->Pager = new cNumericPager($tahap5_list->StartRec, $tahap5_list->DisplayRecs, $tahap5_list->TotalRecs, $tahap5_list->RecRange) ?>
<?php if ($tahap5_list->Pager->RecordCount > 0) { ?>
	<?php if ($tahap5_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $tahap5_list->PageUrl() ?>start=<?php echo $tahap5_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tahap5_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $tahap5_list->PageUrl() ?>start=<?php echo $tahap5_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($tahap5_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $tahap5_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($tahap5_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $tahap5_list->PageUrl() ?>start=<?php echo $tahap5_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tahap5_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $tahap5_list->PageUrl() ?>start=<?php echo $tahap5_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tahap5_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tahap5_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tahap5_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tahap5_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($tahap5_list->SearchWhere == "0=101") { ?>
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
<?php if ($tahap5_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tahap5">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($tahap5_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($tahap5_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($tahap5_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($tahap5_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($tahap5_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($tahap5_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($tahap5_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($tahap5_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($tahap5_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $tahap5_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftahap5list" id="ftahap5list" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="tahap5">
<div id="gmp_tahap5" class="ewGridMiddlePanel">
<?php if ($tahap5_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tahap5->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tahap5_list->RenderListOptions();

// Render list options (header, left)
$tahap5_list->ListOptions->Render("header", "left");
?>
<?php if ($tahap5->id->Visible) { // id ?>
	<?php if ($tahap5->SortUrl($tahap5->id) == "") { ?>
		<td><?php echo $tahap5->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tahap5->SortUrl($tahap5->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tahap5->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($tahap5->id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tahap5->id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tahap5->Norek->Visible) { // Norek ?>
	<?php if ($tahap5->SortUrl($tahap5->Norek) == "") { ?>
		<td><?php echo $tahap5->Norek->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tahap5->SortUrl($tahap5->Norek) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tahap5->Norek->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tahap5->Norek->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tahap5->Norek->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tahap5->Keterangan->Visible) { // Keterangan ?>
	<?php if ($tahap5->SortUrl($tahap5->Keterangan) == "") { ?>
		<td><?php echo $tahap5->Keterangan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tahap5->SortUrl($tahap5->Keterangan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tahap5->Keterangan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tahap5->Keterangan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tahap5->Keterangan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tahap5->D2FK->Visible) { // D/K ?>
	<?php if ($tahap5->SortUrl($tahap5->D2FK) == "") { ?>
		<td><?php echo $tahap5->D2FK->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tahap5->SortUrl($tahap5->D2FK) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tahap5->D2FK->FldCaption() ?></td><td style="width: 10px;"><?php if ($tahap5->D2FK->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tahap5->D2FK->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tahap5->kodePokok->Visible) { // kodePokok ?>
	<?php if ($tahap5->SortUrl($tahap5->kodePokok) == "") { ?>
		<td><?php echo $tahap5->kodePokok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tahap5->SortUrl($tahap5->kodePokok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tahap5->kodePokok->FldCaption() ?></td><td style="width: 10px;"><?php if ($tahap5->kodePokok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tahap5->kodePokok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tahap5->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<?php if ($tahap5->SortUrl($tahap5->kodeSubSatu) == "") { ?>
		<td><?php echo $tahap5->kodeSubSatu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tahap5->SortUrl($tahap5->kodeSubSatu) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tahap5->kodeSubSatu->FldCaption() ?></td><td style="width: 10px;"><?php if ($tahap5->kodeSubSatu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tahap5->kodeSubSatu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tahap5->kodeSubDua->Visible) { // kodeSubDua ?>
	<?php if ($tahap5->SortUrl($tahap5->kodeSubDua) == "") { ?>
		<td><?php echo $tahap5->kodeSubDua->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tahap5->SortUrl($tahap5->kodeSubDua) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tahap5->kodeSubDua->FldCaption() ?></td><td style="width: 10px;"><?php if ($tahap5->kodeSubDua->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tahap5->kodeSubDua->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tahap5->kodeSubTiga->Visible) { // kodeSubTiga ?>
	<?php if ($tahap5->SortUrl($tahap5->kodeSubTiga) == "") { ?>
		<td><?php echo $tahap5->kodeSubTiga->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tahap5->SortUrl($tahap5->kodeSubTiga) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tahap5->kodeSubTiga->FldCaption() ?></td><td style="width: 10px;"><?php if ($tahap5->kodeSubTiga->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tahap5->kodeSubTiga->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tahap5->debet_kali->Visible) { // debet_kali ?>
	<?php if ($tahap5->SortUrl($tahap5->debet_kali) == "") { ?>
		<td><?php echo $tahap5->debet_kali->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tahap5->SortUrl($tahap5->debet_kali) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tahap5->debet_kali->FldCaption() ?></td><td style="width: 10px;"><?php if ($tahap5->debet_kali->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tahap5->debet_kali->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tahap5->kredit_kali->Visible) { // kredit_kali ?>
	<?php if ($tahap5->SortUrl($tahap5->kredit_kali) == "") { ?>
		<td><?php echo $tahap5->kredit_kali->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tahap5->SortUrl($tahap5->kredit_kali) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tahap5->kredit_kali->FldCaption() ?></td><td style="width: 10px;"><?php if ($tahap5->kredit_kali->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tahap5->kredit_kali->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tahap5_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($tahap5->ExportAll && $tahap5->Export <> "") {
	$tahap5_list->StopRec = $tahap5_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tahap5_list->TotalRecs > $tahap5_list->StartRec + $tahap5_list->DisplayRecs - 1)
		$tahap5_list->StopRec = $tahap5_list->StartRec + $tahap5_list->DisplayRecs - 1;
	else
		$tahap5_list->StopRec = $tahap5_list->TotalRecs;
}
$tahap5_list->RecCnt = $tahap5_list->StartRec - 1;
if ($tahap5_list->Recordset && !$tahap5_list->Recordset->EOF) {
	$tahap5_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $tahap5_list->StartRec > 1)
		$tahap5_list->Recordset->Move($tahap5_list->StartRec - 1);
} elseif (!$tahap5->AllowAddDeleteRow && $tahap5_list->StopRec == 0) {
	$tahap5_list->StopRec = $tahap5->GridAddRowCount;
}

// Initialize aggregate
$tahap5->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tahap5->ResetAttrs();
$tahap5_list->RenderRow();
$tahap5_list->RowCnt = 0;
while ($tahap5_list->RecCnt < $tahap5_list->StopRec) {
	$tahap5_list->RecCnt++;
	if (intval($tahap5_list->RecCnt) >= intval($tahap5_list->StartRec)) {
		$tahap5_list->RowCnt++;

		// Set up key count
		$tahap5_list->KeyCount = $tahap5_list->RowIndex;

		// Init row class and style
		$tahap5->ResetAttrs();
		$tahap5->CssClass = "";
		if ($tahap5->CurrentAction == "gridadd") {
		} else {
			$tahap5_list->LoadRowValues($tahap5_list->Recordset); // Load row values
		}
		$tahap5->RowType = EW_ROWTYPE_VIEW; // Render view
		$tahap5->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$tahap5_list->RenderRow();

		// Render list options
		$tahap5_list->RenderListOptions();
?>
	<tr<?php echo $tahap5->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tahap5_list->ListOptions->Render("body", "left");
?>
	<?php if ($tahap5->id->Visible) { // id ?>
		<td<?php echo $tahap5->id->CellAttributes() ?>>
<div<?php echo $tahap5->id->ViewAttributes() ?>><?php echo $tahap5->id->ListViewValue() ?></div>
<a name="<?php echo $tahap5_list->PageObjName . "_row_" . $tahap5_list->RowCnt ?>" id="<?php echo $tahap5_list->PageObjName . "_row_" . $tahap5_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($tahap5->Norek->Visible) { // Norek ?>
		<td<?php echo $tahap5->Norek->CellAttributes() ?>>
<div<?php echo $tahap5->Norek->ViewAttributes() ?>><?php echo $tahap5->Norek->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tahap5->Keterangan->Visible) { // Keterangan ?>
		<td<?php echo $tahap5->Keterangan->CellAttributes() ?>>
<div<?php echo $tahap5->Keterangan->ViewAttributes() ?>><?php echo $tahap5->Keterangan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tahap5->D2FK->Visible) { // D/K ?>
		<td<?php echo $tahap5->D2FK->CellAttributes() ?>>
<div<?php echo $tahap5->D2FK->ViewAttributes() ?>><?php echo $tahap5->D2FK->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tahap5->kodePokok->Visible) { // kodePokok ?>
		<td<?php echo $tahap5->kodePokok->CellAttributes() ?>>
<div<?php echo $tahap5->kodePokok->ViewAttributes() ?>><?php echo $tahap5->kodePokok->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tahap5->kodeSubSatu->Visible) { // kodeSubSatu ?>
		<td<?php echo $tahap5->kodeSubSatu->CellAttributes() ?>>
<div<?php echo $tahap5->kodeSubSatu->ViewAttributes() ?>><?php echo $tahap5->kodeSubSatu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tahap5->kodeSubDua->Visible) { // kodeSubDua ?>
		<td<?php echo $tahap5->kodeSubDua->CellAttributes() ?>>
<div<?php echo $tahap5->kodeSubDua->ViewAttributes() ?>><?php echo $tahap5->kodeSubDua->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tahap5->kodeSubTiga->Visible) { // kodeSubTiga ?>
		<td<?php echo $tahap5->kodeSubTiga->CellAttributes() ?>>
<div<?php echo $tahap5->kodeSubTiga->ViewAttributes() ?>><?php echo $tahap5->kodeSubTiga->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tahap5->debet_kali->Visible) { // debet_kali ?>
		<td<?php echo $tahap5->debet_kali->CellAttributes() ?>>
<div<?php echo $tahap5->debet_kali->ViewAttributes() ?>><?php echo $tahap5->debet_kali->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tahap5->kredit_kali->Visible) { // kredit_kali ?>
		<td<?php echo $tahap5->kredit_kali->CellAttributes() ?>>
<div<?php echo $tahap5->kredit_kali->ViewAttributes() ?>><?php echo $tahap5->kredit_kali->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tahap5_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($tahap5->CurrentAction <> "gridadd")
		$tahap5_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($tahap5_list->Recordset)
	$tahap5_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($tahap5->Export == "" && $tahap5->CurrentAction == "") { ?>
<?php } ?>
<?php
$tahap5_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($tahap5->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tahap5_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctahap5_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tahap5';

	// Page object name
	var $PageObjName = 'tahap5_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tahap5;
		if ($tahap5->UseTokenInUrl) $PageUrl .= "t=" . $tahap5->TableVar . "&"; // Add page token
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
		global $objForm, $tahap5;
		if ($tahap5->UseTokenInUrl) {
			if ($objForm)
				return ($tahap5->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tahap5->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctahap5_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tahap5)
		if (!isset($GLOBALS["tahap5"])) {
			$GLOBALS["tahap5"] = new ctahap5();
			$GLOBALS["Table"] =& $GLOBALS["tahap5"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "tahap5add.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tahap5delete.php";
		$this->MultiUpdateUrl = "tahap5update.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tahap5', TRUE);

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
		global $tahap5;

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
			$tahap5->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $tahap5;

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
			if ($tahap5->Export <> "" ||
				$tahap5->CurrentAction == "gridadd" ||
				$tahap5->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$tahap5->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($tahap5->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $tahap5->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$tahap5->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$tahap5->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$tahap5->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $tahap5->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$tahap5->setSessionWhere($sFilter);
		$tahap5->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $tahap5;
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
			$tahap5->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$tahap5->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $tahap5;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tahap5->Norek, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tahap5->Keterangan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tahap5->D2FK, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tahap5->kodePokok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tahap5->kodeSubSatu, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tahap5->kodeSubDua, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tahap5->kodeSubTiga, $Keyword);
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
		global $Security, $tahap5;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $tahap5->BasicSearchKeyword;
		$sSearchType = $tahap5->BasicSearchType;
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
			$tahap5->setSessionBasicSearchKeyword($sSearchKeyword);
			$tahap5->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tahap5;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$tahap5->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tahap5;
		$tahap5->setSessionBasicSearchKeyword("");
		$tahap5->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tahap5;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tahap5->BasicSearchKeyword = $tahap5->getSessionBasicSearchKeyword();
			$tahap5->BasicSearchType = $tahap5->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tahap5;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tahap5->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tahap5->CurrentOrderType = @$_GET["ordertype"];
			$tahap5->UpdateSort($tahap5->id); // id
			$tahap5->UpdateSort($tahap5->Norek); // Norek
			$tahap5->UpdateSort($tahap5->Keterangan); // Keterangan
			$tahap5->UpdateSort($tahap5->D2FK); // D/K
			$tahap5->UpdateSort($tahap5->kodePokok); // kodePokok
			$tahap5->UpdateSort($tahap5->kodeSubSatu); // kodeSubSatu
			$tahap5->UpdateSort($tahap5->kodeSubDua); // kodeSubDua
			$tahap5->UpdateSort($tahap5->kodeSubTiga); // kodeSubTiga
			$tahap5->UpdateSort($tahap5->debet_kali); // debet_kali
			$tahap5->UpdateSort($tahap5->kredit_kali); // kredit_kali
			$tahap5->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tahap5;
		$sOrderBy = $tahap5->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tahap5->SqlOrderBy() <> "") {
				$sOrderBy = $tahap5->SqlOrderBy();
				$tahap5->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tahap5;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tahap5->setSessionOrderBy($sOrderBy);
				$tahap5->id->setSort("");
				$tahap5->Norek->setSort("");
				$tahap5->Keterangan->setSort("");
				$tahap5->D2FK->setSort("");
				$tahap5->kodePokok->setSort("");
				$tahap5->kodeSubSatu->setSort("");
				$tahap5->kodeSubDua->setSort("");
				$tahap5->kodeSubTiga->setSort("");
				$tahap5->debet_kali->setSort("");
				$tahap5->kredit_kali->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$tahap5->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $tahap5;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tahap5, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $tahap5;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tahap5;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$tahap5->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$tahap5->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $tahap5->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$tahap5->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$tahap5->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$tahap5->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tahap5;
		$tahap5->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tahap5->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tahap5;

		// Call Recordset Selecting event
		$tahap5->Recordset_Selecting($tahap5->CurrentFilter);

		// Load List page SQL
		$sSql = $tahap5->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tahap5->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tahap5;
		$sFilter = $tahap5->KeyFilter();

		// Call Row Selecting event
		$tahap5->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tahap5->CurrentFilter = $sFilter;
		$sSql = $tahap5->SQL();
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
		global $conn, $tahap5;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tahap5->Row_Selected($row);
		$tahap5->id->setDbValue($rs->fields('id'));
		$tahap5->Norek->setDbValue($rs->fields('Norek'));
		$tahap5->Keterangan->setDbValue($rs->fields('Keterangan'));
		$tahap5->D2FK->setDbValue($rs->fields('D/K'));
		$tahap5->kodePokok->setDbValue($rs->fields('kodePokok'));
		$tahap5->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$tahap5->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$tahap5->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$tahap5->debet_kali->setDbValue($rs->fields('debet_kali'));
		$tahap5->kredit_kali->setDbValue($rs->fields('kredit_kali'));
	}

	// Load old record
	function LoadOldRecord() {
		global $tahap5;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($tahap5->getKey("id")) <> "")
			$tahap5->id->CurrentValue = $tahap5->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$tahap5->CurrentFilter = $tahap5->KeyFilter();
			$sSql = $tahap5->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tahap5;

		// Initialize URLs
		$this->ViewUrl = $tahap5->ViewUrl();
		$this->EditUrl = $tahap5->EditUrl();
		$this->InlineEditUrl = $tahap5->InlineEditUrl();
		$this->CopyUrl = $tahap5->CopyUrl();
		$this->InlineCopyUrl = $tahap5->InlineCopyUrl();
		$this->DeleteUrl = $tahap5->DeleteUrl();

		// Call Row_Rendering event
		$tahap5->Row_Rendering();

		// Common render codes for all row types
		// id
		// Norek
		// Keterangan
		// D/K
		// kodePokok
		// kodeSubSatu
		// kodeSubDua
		// kodeSubTiga
		// debet_kali
		// kredit_kali

		if ($tahap5->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$tahap5->id->ViewValue = $tahap5->id->CurrentValue;
			$tahap5->id->ViewCustomAttributes = "";

			// Norek
			$tahap5->Norek->ViewValue = $tahap5->Norek->CurrentValue;
			$tahap5->Norek->ViewCustomAttributes = "";

			// Keterangan
			$tahap5->Keterangan->ViewValue = $tahap5->Keterangan->CurrentValue;
			$tahap5->Keterangan->ViewCustomAttributes = "";

			// D/K
			if (strval($tahap5->D2FK->CurrentValue) <> "") {
				switch ($tahap5->D2FK->CurrentValue) {
					case "D":
						$tahap5->D2FK->ViewValue = $tahap5->D2FK->FldTagCaption(1) <> "" ? $tahap5->D2FK->FldTagCaption(1) : $tahap5->D2FK->CurrentValue;
						break;
					case "K":
						$tahap5->D2FK->ViewValue = $tahap5->D2FK->FldTagCaption(2) <> "" ? $tahap5->D2FK->FldTagCaption(2) : $tahap5->D2FK->CurrentValue;
						break;
					default:
						$tahap5->D2FK->ViewValue = $tahap5->D2FK->CurrentValue;
				}
			} else {
				$tahap5->D2FK->ViewValue = NULL;
			}
			$tahap5->D2FK->ViewCustomAttributes = "";

			// kodePokok
			$tahap5->kodePokok->ViewValue = $tahap5->kodePokok->CurrentValue;
			$tahap5->kodePokok->ViewCustomAttributes = "";

			// kodeSubSatu
			$tahap5->kodeSubSatu->ViewValue = $tahap5->kodeSubSatu->CurrentValue;
			$tahap5->kodeSubSatu->ViewCustomAttributes = "";

			// kodeSubDua
			$tahap5->kodeSubDua->ViewValue = $tahap5->kodeSubDua->CurrentValue;
			$tahap5->kodeSubDua->ViewCustomAttributes = "";

			// kodeSubTiga
			$tahap5->kodeSubTiga->ViewValue = $tahap5->kodeSubTiga->CurrentValue;
			$tahap5->kodeSubTiga->ViewCustomAttributes = "";

			// debet_kali
			$tahap5->debet_kali->ViewValue = $tahap5->debet_kali->CurrentValue;
			$tahap5->debet_kali->ViewCustomAttributes = "";

			// kredit_kali
			$tahap5->kredit_kali->ViewValue = $tahap5->kredit_kali->CurrentValue;
			$tahap5->kredit_kali->ViewCustomAttributes = "";

			// id
			$tahap5->id->LinkCustomAttributes = "";
			$tahap5->id->HrefValue = "";
			$tahap5->id->TooltipValue = "";

			// Norek
			$tahap5->Norek->LinkCustomAttributes = "";
			$tahap5->Norek->HrefValue = "";
			$tahap5->Norek->TooltipValue = "";

			// Keterangan
			$tahap5->Keterangan->LinkCustomAttributes = "";
			$tahap5->Keterangan->HrefValue = "";
			$tahap5->Keterangan->TooltipValue = "";

			// D/K
			$tahap5->D2FK->LinkCustomAttributes = "";
			$tahap5->D2FK->HrefValue = "";
			$tahap5->D2FK->TooltipValue = "";

			// kodePokok
			$tahap5->kodePokok->LinkCustomAttributes = "";
			$tahap5->kodePokok->HrefValue = "";
			$tahap5->kodePokok->TooltipValue = "";

			// kodeSubSatu
			$tahap5->kodeSubSatu->LinkCustomAttributes = "";
			$tahap5->kodeSubSatu->HrefValue = "";
			$tahap5->kodeSubSatu->TooltipValue = "";

			// kodeSubDua
			$tahap5->kodeSubDua->LinkCustomAttributes = "";
			$tahap5->kodeSubDua->HrefValue = "";
			$tahap5->kodeSubDua->TooltipValue = "";

			// kodeSubTiga
			$tahap5->kodeSubTiga->LinkCustomAttributes = "";
			$tahap5->kodeSubTiga->HrefValue = "";
			$tahap5->kodeSubTiga->TooltipValue = "";

			// debet_kali
			$tahap5->debet_kali->LinkCustomAttributes = "";
			$tahap5->debet_kali->HrefValue = "";
			$tahap5->debet_kali->TooltipValue = "";

			// kredit_kali
			$tahap5->kredit_kali->LinkCustomAttributes = "";
			$tahap5->kredit_kali->HrefValue = "";
			$tahap5->kredit_kali->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tahap5->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tahap5->Row_Rendered();
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

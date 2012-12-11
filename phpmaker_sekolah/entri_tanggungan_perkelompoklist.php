<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "entri_tanggungan_perkelompokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$entri_tanggungan_perkelompok_list = new centri_tanggungan_perkelompok_list();
$Page =& $entri_tanggungan_perkelompok_list;

// Page init
$entri_tanggungan_perkelompok_list->Page_Init();

// Page main
$entri_tanggungan_perkelompok_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($entri_tanggungan_perkelompok->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var entri_tanggungan_perkelompok_list = new ew_Page("entri_tanggungan_perkelompok_list");

// page properties
entri_tanggungan_perkelompok_list.PageID = "list"; // page ID
entri_tanggungan_perkelompok_list.FormID = "fentri_tanggungan_perkelompoklist"; // form ID
var EW_PAGE_ID = entri_tanggungan_perkelompok_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entri_tanggungan_perkelompok_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
entri_tanggungan_perkelompok_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
entri_tanggungan_perkelompok_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entri_tanggungan_perkelompok_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($entri_tanggungan_perkelompok->Export == "") || (EW_EXPORT_MASTER_RECORD && $entri_tanggungan_perkelompok->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$entri_tanggungan_perkelompok_list->TotalRecs = $entri_tanggungan_perkelompok->SelectRecordCount();
	} else {
		if ($entri_tanggungan_perkelompok_list->Recordset = $entri_tanggungan_perkelompok_list->LoadRecordset())
			$entri_tanggungan_perkelompok_list->TotalRecs = $entri_tanggungan_perkelompok_list->Recordset->RecordCount();
	}
	$entri_tanggungan_perkelompok_list->StartRec = 1;
	if ($entri_tanggungan_perkelompok_list->DisplayRecs <= 0 || ($entri_tanggungan_perkelompok->Export <> "" && $entri_tanggungan_perkelompok->ExportAll)) // Display all records
		$entri_tanggungan_perkelompok_list->DisplayRecs = $entri_tanggungan_perkelompok_list->TotalRecs;
	if (!($entri_tanggungan_perkelompok->Export <> "" && $entri_tanggungan_perkelompok->ExportAll))
		$entri_tanggungan_perkelompok_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$entri_tanggungan_perkelompok_list->Recordset = $entri_tanggungan_perkelompok_list->LoadRecordset($entri_tanggungan_perkelompok_list->StartRec-1, $entri_tanggungan_perkelompok_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $entri_tanggungan_perkelompok->TableCaption() ?>
&nbsp;&nbsp;<?php $entri_tanggungan_perkelompok_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($entri_tanggungan_perkelompok->Export == "" && $entri_tanggungan_perkelompok->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(entri_tanggungan_perkelompok_list);" style="text-decoration: none;"><img id="entri_tanggungan_perkelompok_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="entri_tanggungan_perkelompok_list_SearchPanel">
<form name="fentri_tanggungan_perkelompoklistsrch" id="fentri_tanggungan_perkelompoklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="entri_tanggungan_perkelompok">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($entri_tanggungan_perkelompok->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $entri_tanggungan_perkelompok_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($entri_tanggungan_perkelompok->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($entri_tanggungan_perkelompok->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($entri_tanggungan_perkelompok->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $entri_tanggungan_perkelompok_list->ShowPageHeader(); ?>
<?php
$entri_tanggungan_perkelompok_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($entri_tanggungan_perkelompok->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($entri_tanggungan_perkelompok->CurrentAction <> "gridadd" && $entri_tanggungan_perkelompok->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($entri_tanggungan_perkelompok_list->Pager)) $entri_tanggungan_perkelompok_list->Pager = new cNumericPager($entri_tanggungan_perkelompok_list->StartRec, $entri_tanggungan_perkelompok_list->DisplayRecs, $entri_tanggungan_perkelompok_list->TotalRecs, $entri_tanggungan_perkelompok_list->RecRange) ?>
<?php if ($entri_tanggungan_perkelompok_list->Pager->RecordCount > 0) { ?>
	<?php if ($entri_tanggungan_perkelompok_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $entri_tanggungan_perkelompok_list->PageUrl() ?>start=<?php echo $entri_tanggungan_perkelompok_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($entri_tanggungan_perkelompok_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $entri_tanggungan_perkelompok_list->PageUrl() ?>start=<?php echo $entri_tanggungan_perkelompok_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($entri_tanggungan_perkelompok_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $entri_tanggungan_perkelompok_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($entri_tanggungan_perkelompok_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $entri_tanggungan_perkelompok_list->PageUrl() ?>start=<?php echo $entri_tanggungan_perkelompok_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($entri_tanggungan_perkelompok_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $entri_tanggungan_perkelompok_list->PageUrl() ?>start=<?php echo $entri_tanggungan_perkelompok_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($entri_tanggungan_perkelompok_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $entri_tanggungan_perkelompok_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $entri_tanggungan_perkelompok_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $entri_tanggungan_perkelompok_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($entri_tanggungan_perkelompok_list->SearchWhere == "0=101") { ?>
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
<?php if ($entri_tanggungan_perkelompok_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="entri_tanggungan_perkelompok">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($entri_tanggungan_perkelompok_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($entri_tanggungan_perkelompok_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($entri_tanggungan_perkelompok_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($entri_tanggungan_perkelompok_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($entri_tanggungan_perkelompok_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($entri_tanggungan_perkelompok_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($entri_tanggungan_perkelompok_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($entri_tanggungan_perkelompok_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($entri_tanggungan_perkelompok_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($entri_tanggungan_perkelompok_list->TotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fentri_tanggungan_perkelompoklist, '<?php echo $entri_tanggungan_perkelompok_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fentri_tanggungan_perkelompoklist" id="fentri_tanggungan_perkelompoklist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="entri_tanggungan_perkelompok">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_entri_tanggungan_perkelompok" class="ewGridMiddlePanel">
<?php if ($entri_tanggungan_perkelompok_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $entri_tanggungan_perkelompok->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$entri_tanggungan_perkelompok_list->RenderListOptions();

// Render list options (header, left)
$entri_tanggungan_perkelompok_list->ListOptions->Render("header", "left");
?>
<?php if ($entri_tanggungan_perkelompok->tahun->Visible) { // tahun ?>
	<?php if ($entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->tahun) == "") { ?>
		<td><?php echo $entri_tanggungan_perkelompok->tahun->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->tahun) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entri_tanggungan_perkelompok->tahun->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($entri_tanggungan_perkelompok->tahun->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entri_tanggungan_perkelompok->tahun->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entri_tanggungan_perkelompok->kelas->Visible) { // kelas ?>
	<?php if ($entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->kelas) == "") { ?>
		<td><?php echo $entri_tanggungan_perkelompok->kelas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->kelas) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entri_tanggungan_perkelompok->kelas->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($entri_tanggungan_perkelompok->kelas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entri_tanggungan_perkelompok->kelas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entri_tanggungan_perkelompok->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
	<?php if ($entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->nama_kelas_kelompok) == "") { ?>
		<td><?php echo $entri_tanggungan_perkelompok->nama_kelas_kelompok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->nama_kelas_kelompok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entri_tanggungan_perkelompok->nama_kelas_kelompok->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($entri_tanggungan_perkelompok->nama_kelas_kelompok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entri_tanggungan_perkelompok->nama_kelas_kelompok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entri_tanggungan_perkelompok->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->kode_otomatis) == "") { ?>
		<td><?php echo $entri_tanggungan_perkelompok->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->kode_otomatis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entri_tanggungan_perkelompok->kode_otomatis->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($entri_tanggungan_perkelompok->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entri_tanggungan_perkelompok->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entri_tanggungan_perkelompok->apakah_valid->Visible) { // apakah_valid ?>
	<?php if ($entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->apakah_valid) == "") { ?>
		<td><?php echo $entri_tanggungan_perkelompok->apakah_valid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->apakah_valid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entri_tanggungan_perkelompok->apakah_valid->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($entri_tanggungan_perkelompok->apakah_valid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entri_tanggungan_perkelompok->apakah_valid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entri_tanggungan_perkelompok->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
	<?php if ($entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->kode_otomatis_tingkat) == "") { ?>
		<td><?php echo $entri_tanggungan_perkelompok->kode_otomatis_tingkat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entri_tanggungan_perkelompok->SortUrl($entri_tanggungan_perkelompok->kode_otomatis_tingkat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entri_tanggungan_perkelompok->kode_otomatis_tingkat->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($entri_tanggungan_perkelompok->kode_otomatis_tingkat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entri_tanggungan_perkelompok->kode_otomatis_tingkat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$entri_tanggungan_perkelompok_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($entri_tanggungan_perkelompok->ExportAll && $entri_tanggungan_perkelompok->Export <> "") {
	$entri_tanggungan_perkelompok_list->StopRec = $entri_tanggungan_perkelompok_list->TotalRecs;
} else {

	// Set the last record to display
	if ($entri_tanggungan_perkelompok_list->TotalRecs > $entri_tanggungan_perkelompok_list->StartRec + $entri_tanggungan_perkelompok_list->DisplayRecs - 1)
		$entri_tanggungan_perkelompok_list->StopRec = $entri_tanggungan_perkelompok_list->StartRec + $entri_tanggungan_perkelompok_list->DisplayRecs - 1;
	else
		$entri_tanggungan_perkelompok_list->StopRec = $entri_tanggungan_perkelompok_list->TotalRecs;
}
$entri_tanggungan_perkelompok_list->RecCnt = $entri_tanggungan_perkelompok_list->StartRec - 1;
if ($entri_tanggungan_perkelompok_list->Recordset && !$entri_tanggungan_perkelompok_list->Recordset->EOF) {
	$entri_tanggungan_perkelompok_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $entri_tanggungan_perkelompok_list->StartRec > 1)
		$entri_tanggungan_perkelompok_list->Recordset->Move($entri_tanggungan_perkelompok_list->StartRec - 1);
} elseif (!$entri_tanggungan_perkelompok->AllowAddDeleteRow && $entri_tanggungan_perkelompok_list->StopRec == 0) {
	$entri_tanggungan_perkelompok_list->StopRec = $entri_tanggungan_perkelompok->GridAddRowCount;
}

// Initialize aggregate
$entri_tanggungan_perkelompok->RowType = EW_ROWTYPE_AGGREGATEINIT;
$entri_tanggungan_perkelompok->ResetAttrs();
$entri_tanggungan_perkelompok_list->RenderRow();
$entri_tanggungan_perkelompok_list->RowCnt = 0;
while ($entri_tanggungan_perkelompok_list->RecCnt < $entri_tanggungan_perkelompok_list->StopRec) {
	$entri_tanggungan_perkelompok_list->RecCnt++;
	if (intval($entri_tanggungan_perkelompok_list->RecCnt) >= intval($entri_tanggungan_perkelompok_list->StartRec)) {
		$entri_tanggungan_perkelompok_list->RowCnt++;

		// Set up key count
		$entri_tanggungan_perkelompok_list->KeyCount = $entri_tanggungan_perkelompok_list->RowIndex;

		// Init row class and style
		$entri_tanggungan_perkelompok->ResetAttrs();
		$entri_tanggungan_perkelompok->CssClass = "";
		if ($entri_tanggungan_perkelompok->CurrentAction == "gridadd") {
		} else {
			$entri_tanggungan_perkelompok_list->LoadRowValues($entri_tanggungan_perkelompok_list->Recordset); // Load row values
		}
		$entri_tanggungan_perkelompok->RowType = EW_ROWTYPE_VIEW; // Render view
		$entri_tanggungan_perkelompok->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$entri_tanggungan_perkelompok_list->RenderRow();

		// Render list options
		$entri_tanggungan_perkelompok_list->RenderListOptions();
?>
	<tr<?php echo $entri_tanggungan_perkelompok->RowAttributes() ?>>
<?php

// Render list options (body, left)
$entri_tanggungan_perkelompok_list->ListOptions->Render("body", "left");
?>
	<?php if ($entri_tanggungan_perkelompok->tahun->Visible) { // tahun ?>
		<td<?php echo $entri_tanggungan_perkelompok->tahun->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->tahun->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->tahun->ListViewValue() ?></div>
<a name="<?php echo $entri_tanggungan_perkelompok_list->PageObjName . "_row_" . $entri_tanggungan_perkelompok_list->RowCnt ?>" id="<?php echo $entri_tanggungan_perkelompok_list->PageObjName . "_row_" . $entri_tanggungan_perkelompok_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($entri_tanggungan_perkelompok->kelas->Visible) { // kelas ?>
		<td<?php echo $entri_tanggungan_perkelompok->kelas->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->kelas->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->kelas->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entri_tanggungan_perkelompok->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
		<td<?php echo $entri_tanggungan_perkelompok->nama_kelas_kelompok->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->nama_kelas_kelompok->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->nama_kelas_kelompok->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entri_tanggungan_perkelompok->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $entri_tanggungan_perkelompok->kode_otomatis->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->kode_otomatis->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->kode_otomatis->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entri_tanggungan_perkelompok->apakah_valid->Visible) { // apakah_valid ?>
		<td<?php echo $entri_tanggungan_perkelompok->apakah_valid->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->apakah_valid->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->apakah_valid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entri_tanggungan_perkelompok->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<td<?php echo $entri_tanggungan_perkelompok->kode_otomatis_tingkat->CellAttributes() ?>>
<div<?php echo $entri_tanggungan_perkelompok->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $entri_tanggungan_perkelompok->kode_otomatis_tingkat->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$entri_tanggungan_perkelompok_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($entri_tanggungan_perkelompok->CurrentAction <> "gridadd")
		$entri_tanggungan_perkelompok_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($entri_tanggungan_perkelompok_list->Recordset)
	$entri_tanggungan_perkelompok_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($entri_tanggungan_perkelompok->Export == "" && $entri_tanggungan_perkelompok->CurrentAction == "") { ?>
<?php } ?>
<?php
$entri_tanggungan_perkelompok_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($entri_tanggungan_perkelompok->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$entri_tanggungan_perkelompok_list->Page_Terminate();
?>
<?php

//
// Page class
//
class centri_tanggungan_perkelompok_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'entri_tanggungan_perkelompok';

	// Page object name
	var $PageObjName = 'entri_tanggungan_perkelompok_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entri_tanggungan_perkelompok;
		if ($entri_tanggungan_perkelompok->UseTokenInUrl) $PageUrl .= "t=" . $entri_tanggungan_perkelompok->TableVar . "&"; // Add page token
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
		global $objForm, $entri_tanggungan_perkelompok;
		if ($entri_tanggungan_perkelompok->UseTokenInUrl) {
			if ($objForm)
				return ($entri_tanggungan_perkelompok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entri_tanggungan_perkelompok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centri_tanggungan_perkelompok_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (entri_tanggungan_perkelompok)
		if (!isset($GLOBALS["entri_tanggungan_perkelompok"])) {
			$GLOBALS["entri_tanggungan_perkelompok"] = new centri_tanggungan_perkelompok();
			$GLOBALS["Table"] =& $GLOBALS["entri_tanggungan_perkelompok"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "entri_tanggungan_perkelompokadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "entri_tanggungan_perkelompokdelete.php";
		$this->MultiUpdateUrl = "entri_tanggungan_perkelompokupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entri_tanggungan_perkelompok', TRUE);

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
		global $entri_tanggungan_perkelompok;

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

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$entri_tanggungan_perkelompok->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$entri_tanggungan_perkelompok->Export = $_POST["exporttype"];
		} else {
			$entri_tanggungan_perkelompok->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $entri_tanggungan_perkelompok->Export; // Get export parameter, used in header
		$gsExportFile = $entri_tanggungan_perkelompok->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$entri_tanggungan_perkelompok->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $entri_tanggungan_perkelompok;

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
			if ($entri_tanggungan_perkelompok->Export <> "" ||
				$entri_tanggungan_perkelompok->CurrentAction == "gridadd" ||
				$entri_tanggungan_perkelompok->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$entri_tanggungan_perkelompok->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($entri_tanggungan_perkelompok->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $entri_tanggungan_perkelompok->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$entri_tanggungan_perkelompok->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$entri_tanggungan_perkelompok->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$entri_tanggungan_perkelompok->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $entri_tanggungan_perkelompok->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$entri_tanggungan_perkelompok->setSessionWhere($sFilter);
		$entri_tanggungan_perkelompok->CurrentFilter = "";

		// Export selected records
		if ($entri_tanggungan_perkelompok->Export <> "")
			$entri_tanggungan_perkelompok->CurrentFilter = $this->BuildExportSelectedFilter();
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $entri_tanggungan_perkelompok;
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
			$entri_tanggungan_perkelompok->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$entri_tanggungan_perkelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $entri_tanggungan_perkelompok;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $entri_tanggungan_perkelompok->tahun, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $entri_tanggungan_perkelompok->kelas, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $entri_tanggungan_perkelompok->nama_kelas_kelompok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $entri_tanggungan_perkelompok->kode_otomatis, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $entri_tanggungan_perkelompok->apakah_valid, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $entri_tanggungan_perkelompok->kode_otomatis_tingkat, $Keyword);
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
		global $Security, $entri_tanggungan_perkelompok;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $entri_tanggungan_perkelompok->BasicSearchKeyword;
		$sSearchType = $entri_tanggungan_perkelompok->BasicSearchType;
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
			$entri_tanggungan_perkelompok->setSessionBasicSearchKeyword($sSearchKeyword);
			$entri_tanggungan_perkelompok->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $entri_tanggungan_perkelompok;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$entri_tanggungan_perkelompok->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $entri_tanggungan_perkelompok;
		$entri_tanggungan_perkelompok->setSessionBasicSearchKeyword("");
		$entri_tanggungan_perkelompok->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $entri_tanggungan_perkelompok;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$entri_tanggungan_perkelompok->BasicSearchKeyword = $entri_tanggungan_perkelompok->getSessionBasicSearchKeyword();
			$entri_tanggungan_perkelompok->BasicSearchType = $entri_tanggungan_perkelompok->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $entri_tanggungan_perkelompok;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$entri_tanggungan_perkelompok->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$entri_tanggungan_perkelompok->CurrentOrderType = @$_GET["ordertype"];
			$entri_tanggungan_perkelompok->UpdateSort($entri_tanggungan_perkelompok->tahun); // tahun
			$entri_tanggungan_perkelompok->UpdateSort($entri_tanggungan_perkelompok->kelas); // kelas
			$entri_tanggungan_perkelompok->UpdateSort($entri_tanggungan_perkelompok->nama_kelas_kelompok); // nama_kelas_kelompok
			$entri_tanggungan_perkelompok->UpdateSort($entri_tanggungan_perkelompok->kode_otomatis); // kode_otomatis
			$entri_tanggungan_perkelompok->UpdateSort($entri_tanggungan_perkelompok->apakah_valid); // apakah_valid
			$entri_tanggungan_perkelompok->UpdateSort($entri_tanggungan_perkelompok->kode_otomatis_tingkat); // kode_otomatis_tingkat
			$entri_tanggungan_perkelompok->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $entri_tanggungan_perkelompok;
		$sOrderBy = $entri_tanggungan_perkelompok->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($entri_tanggungan_perkelompok->SqlOrderBy() <> "") {
				$sOrderBy = $entri_tanggungan_perkelompok->SqlOrderBy();
				$entri_tanggungan_perkelompok->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $entri_tanggungan_perkelompok;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$entri_tanggungan_perkelompok->setSessionOrderBy($sOrderBy);
				$entri_tanggungan_perkelompok->tahun->setSort("");
				$entri_tanggungan_perkelompok->kelas->setSort("");
				$entri_tanggungan_perkelompok->nama_kelas_kelompok->setSort("");
				$entri_tanggungan_perkelompok->kode_otomatis->setSort("");
				$entri_tanggungan_perkelompok->apakah_valid->setSort("");
				$entri_tanggungan_perkelompok->kode_otomatis_tingkat->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$entri_tanggungan_perkelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $entri_tanggungan_perkelompok;

		// "checkbox"
		$item =& $this->ListOptions->Add("checkbox");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"entri_tanggungan_perkelompok_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $entri_tanggungan_perkelompok, $objForm;
		$this->ListOptions->LoadDefault();

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($entri_tanggungan_perkelompok->kode_otomatis->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $entri_tanggungan_perkelompok;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $entri_tanggungan_perkelompok;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$entri_tanggungan_perkelompok->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$entri_tanggungan_perkelompok->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $entri_tanggungan_perkelompok->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$entri_tanggungan_perkelompok->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$entri_tanggungan_perkelompok->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$entri_tanggungan_perkelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $entri_tanggungan_perkelompok;
		$entri_tanggungan_perkelompok->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$entri_tanggungan_perkelompok->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $entri_tanggungan_perkelompok;

		// Call Recordset Selecting event
		$entri_tanggungan_perkelompok->Recordset_Selecting($entri_tanggungan_perkelompok->CurrentFilter);

		// Load List page SQL
		$sSql = $entri_tanggungan_perkelompok->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$entri_tanggungan_perkelompok->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entri_tanggungan_perkelompok;
		$sFilter = $entri_tanggungan_perkelompok->KeyFilter();

		// Call Row Selecting event
		$entri_tanggungan_perkelompok->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entri_tanggungan_perkelompok->CurrentFilter = $sFilter;
		$sSql = $entri_tanggungan_perkelompok->SQL();
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
		global $conn, $entri_tanggungan_perkelompok;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$entri_tanggungan_perkelompok->Row_Selected($row);
		$entri_tanggungan_perkelompok->tahun->setDbValue($rs->fields('tahun'));
		$entri_tanggungan_perkelompok->kelas->setDbValue($rs->fields('kelas'));
		$entri_tanggungan_perkelompok->nama_kelas_kelompok->setDbValue($rs->fields('nama_kelas_kelompok'));
		$entri_tanggungan_perkelompok->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$entri_tanggungan_perkelompok->apakah_valid->setDbValue($rs->fields('apakah_valid'));
		$entri_tanggungan_perkelompok->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
	}

	// Load old record
	function LoadOldRecord() {
		global $entri_tanggungan_perkelompok;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($entri_tanggungan_perkelompok->getKey("kode_otomatis")) <> "")
			$entri_tanggungan_perkelompok->kode_otomatis->CurrentValue = $entri_tanggungan_perkelompok->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$entri_tanggungan_perkelompok->CurrentFilter = $entri_tanggungan_perkelompok->KeyFilter();
			$sSql = $entri_tanggungan_perkelompok->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entri_tanggungan_perkelompok;

		// Initialize URLs
		$this->ViewUrl = $entri_tanggungan_perkelompok->ViewUrl();
		$this->EditUrl = $entri_tanggungan_perkelompok->EditUrl();
		$this->InlineEditUrl = $entri_tanggungan_perkelompok->InlineEditUrl();
		$this->CopyUrl = $entri_tanggungan_perkelompok->CopyUrl();
		$this->InlineCopyUrl = $entri_tanggungan_perkelompok->InlineCopyUrl();
		$this->DeleteUrl = $entri_tanggungan_perkelompok->DeleteUrl();

		// Call Row_Rendering event
		$entri_tanggungan_perkelompok->Row_Rendering();

		// Common render codes for all row types
		// tahun
		// kelas
		// nama_kelas_kelompok
		// kode_otomatis
		// apakah_valid
		// kode_otomatis_tingkat

		if ($entri_tanggungan_perkelompok->RowType == EW_ROWTYPE_VIEW) { // View row

			// tahun
			$entri_tanggungan_perkelompok->tahun->ViewValue = $entri_tanggungan_perkelompok->tahun->CurrentValue;
			$entri_tanggungan_perkelompok->tahun->ViewCustomAttributes = "";

			// kelas
			$entri_tanggungan_perkelompok->kelas->ViewValue = $entri_tanggungan_perkelompok->kelas->CurrentValue;
			$entri_tanggungan_perkelompok->kelas->ViewCustomAttributes = "";

			// nama_kelas_kelompok
			$entri_tanggungan_perkelompok->nama_kelas_kelompok->ViewValue = $entri_tanggungan_perkelompok->nama_kelas_kelompok->CurrentValue;
			$entri_tanggungan_perkelompok->nama_kelas_kelompok->ViewCustomAttributes = "";

			// kode_otomatis
			$entri_tanggungan_perkelompok->kode_otomatis->ViewValue = $entri_tanggungan_perkelompok->kode_otomatis->CurrentValue;
			$entri_tanggungan_perkelompok->kode_otomatis->ViewCustomAttributes = "";

			// apakah_valid
			$entri_tanggungan_perkelompok->apakah_valid->ViewValue = $entri_tanggungan_perkelompok->apakah_valid->CurrentValue;
			$entri_tanggungan_perkelompok->apakah_valid->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$entri_tanggungan_perkelompok->kode_otomatis_tingkat->ViewValue = $entri_tanggungan_perkelompok->kode_otomatis_tingkat->CurrentValue;
			$entri_tanggungan_perkelompok->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// tahun
			$entri_tanggungan_perkelompok->tahun->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->tahun->HrefValue = "";
			$entri_tanggungan_perkelompok->tahun->TooltipValue = "";

			// kelas
			$entri_tanggungan_perkelompok->kelas->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->kelas->HrefValue = "";
			$entri_tanggungan_perkelompok->kelas->TooltipValue = "";

			// nama_kelas_kelompok
			$entri_tanggungan_perkelompok->nama_kelas_kelompok->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->nama_kelas_kelompok->HrefValue = "";
			$entri_tanggungan_perkelompok->nama_kelas_kelompok->TooltipValue = "";

			// kode_otomatis
			$entri_tanggungan_perkelompok->kode_otomatis->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->kode_otomatis->HrefValue = "";
			$entri_tanggungan_perkelompok->kode_otomatis->TooltipValue = "";

			// apakah_valid
			$entri_tanggungan_perkelompok->apakah_valid->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->apakah_valid->HrefValue = "";
			$entri_tanggungan_perkelompok->apakah_valid->TooltipValue = "";

			// kode_otomatis_tingkat
			$entri_tanggungan_perkelompok->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$entri_tanggungan_perkelompok->kode_otomatis_tingkat->HrefValue = "";
			$entri_tanggungan_perkelompok->kode_otomatis_tingkat->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entri_tanggungan_perkelompok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entri_tanggungan_perkelompok->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $entri_tanggungan_perkelompok;
		$sWrkFilter = "";
		if ($entri_tanggungan_perkelompok->Export <> "") {
			$sWrkFilter = $entri_tanggungan_perkelompok->GetKeyFilter();
		}
		return $sWrkFilter;
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $entri_tanggungan_perkelompok;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fentri_tanggungan_perkelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','print');\">" . "<img src=\"phpimages/print.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fentri_tanggungan_perkelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','excel');\">" . "<img src=\"phpimages/exportxls.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fentri_tanggungan_perkelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','word');\">" . "<img src=\"phpimages/exportdoc.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fentri_tanggungan_perkelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','html');\">" . "<img src=\"phpimages/exporthtml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fentri_tanggungan_perkelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','xml');\">" . "<img src=\"phpimages/exportxml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fentri_tanggungan_perkelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','csv');\">" . "<img src=\"phpimages/exportcsv.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fentri_tanggungan_perkelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','pdf');\">" . "<img src=\"phpimages/exportpdf.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_entri_tanggungan_perkelompok\" id=\"emf_entri_tanggungan_perkelompok\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_entri_tanggungan_perkelompok',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fentri_tanggungan_perkelompoklist,sel:true});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($entri_tanggungan_perkelompok->Export <> "" ||
			$entri_tanggungan_perkelompok->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
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

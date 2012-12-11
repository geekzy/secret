<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_master_tanggunganinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_master_tanggungan_list = new ckeu_master_tanggungan_list();
$Page =& $keu_master_tanggungan_list;

// Page init
$keu_master_tanggungan_list->Page_Init();

// Page main
$keu_master_tanggungan_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($keu_master_tanggungan->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var keu_master_tanggungan_list = new ew_Page("keu_master_tanggungan_list");

// page properties
keu_master_tanggungan_list.PageID = "list"; // page ID
keu_master_tanggungan_list.FormID = "fkeu_master_tanggunganlist"; // form ID
var EW_PAGE_ID = keu_master_tanggungan_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
keu_master_tanggungan_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_master_tanggungan_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_master_tanggungan_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($keu_master_tanggungan->Export == "") || (EW_EXPORT_MASTER_RECORD && $keu_master_tanggungan->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$keu_master_tanggungan_list->TotalRecs = $keu_master_tanggungan->SelectRecordCount();
	} else {
		if ($keu_master_tanggungan_list->Recordset = $keu_master_tanggungan_list->LoadRecordset())
			$keu_master_tanggungan_list->TotalRecs = $keu_master_tanggungan_list->Recordset->RecordCount();
	}
	$keu_master_tanggungan_list->StartRec = 1;
	if ($keu_master_tanggungan_list->DisplayRecs <= 0 || ($keu_master_tanggungan->Export <> "" && $keu_master_tanggungan->ExportAll)) // Display all records
		$keu_master_tanggungan_list->DisplayRecs = $keu_master_tanggungan_list->TotalRecs;
	if (!($keu_master_tanggungan->Export <> "" && $keu_master_tanggungan->ExportAll))
		$keu_master_tanggungan_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$keu_master_tanggungan_list->Recordset = $keu_master_tanggungan_list->LoadRecordset($keu_master_tanggungan_list->StartRec-1, $keu_master_tanggungan_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_master_tanggungan->TableCaption() ?>
&nbsp;&nbsp;<?php $keu_master_tanggungan_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($keu_master_tanggungan->Export == "" && $keu_master_tanggungan->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(keu_master_tanggungan_list);" style="text-decoration: none;"><img id="keu_master_tanggungan_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="keu_master_tanggungan_list_SearchPanel">
<form name="fkeu_master_tanggunganlistsrch" id="fkeu_master_tanggunganlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="keu_master_tanggungan">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($keu_master_tanggungan->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $keu_master_tanggungan_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($keu_master_tanggungan->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($keu_master_tanggungan->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($keu_master_tanggungan->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $keu_master_tanggungan_list->ShowPageHeader(); ?>
<?php
$keu_master_tanggungan_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($keu_master_tanggungan->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($keu_master_tanggungan->CurrentAction <> "gridadd" && $keu_master_tanggungan->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($keu_master_tanggungan_list->Pager)) $keu_master_tanggungan_list->Pager = new cNumericPager($keu_master_tanggungan_list->StartRec, $keu_master_tanggungan_list->DisplayRecs, $keu_master_tanggungan_list->TotalRecs, $keu_master_tanggungan_list->RecRange) ?>
<?php if ($keu_master_tanggungan_list->Pager->RecordCount > 0) { ?>
	<?php if ($keu_master_tanggungan_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $keu_master_tanggungan_list->PageUrl() ?>start=<?php echo $keu_master_tanggungan_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_master_tanggungan_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $keu_master_tanggungan_list->PageUrl() ?>start=<?php echo $keu_master_tanggungan_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($keu_master_tanggungan_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $keu_master_tanggungan_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($keu_master_tanggungan_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $keu_master_tanggungan_list->PageUrl() ?>start=<?php echo $keu_master_tanggungan_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_master_tanggungan_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $keu_master_tanggungan_list->PageUrl() ?>start=<?php echo $keu_master_tanggungan_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_master_tanggungan_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $keu_master_tanggungan_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $keu_master_tanggungan_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $keu_master_tanggungan_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($keu_master_tanggungan_list->SearchWhere == "0=101") { ?>
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
<?php if ($keu_master_tanggungan_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="keu_master_tanggungan">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($keu_master_tanggungan_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($keu_master_tanggungan_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($keu_master_tanggungan_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($keu_master_tanggungan_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($keu_master_tanggungan_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($keu_master_tanggungan_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($keu_master_tanggungan_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($keu_master_tanggungan_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($keu_master_tanggungan_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $keu_master_tanggungan_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fkeu_master_tanggunganlist" id="fkeu_master_tanggunganlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="keu_master_tanggungan">
<div id="gmp_keu_master_tanggungan" class="ewGridMiddlePanel">
<?php if ($keu_master_tanggungan_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $keu_master_tanggungan->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$keu_master_tanggungan_list->RenderListOptions();

// Render list options (header, left)
$keu_master_tanggungan_list->ListOptions->Render("header", "left");
?>
<?php if ($keu_master_tanggungan->nama_biaya->Visible) { // nama_biaya ?>
	<?php if ($keu_master_tanggungan->SortUrl($keu_master_tanggungan->nama_biaya) == "") { ?>
		<td><?php echo $keu_master_tanggungan->nama_biaya->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_master_tanggungan->SortUrl($keu_master_tanggungan->nama_biaya) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_master_tanggungan->nama_biaya->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($keu_master_tanggungan->nama_biaya->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_master_tanggungan->nama_biaya->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_master_tanggungan->apakah_disembunyikan->Visible) { // apakah_disembunyikan ?>
	<?php if ($keu_master_tanggungan->SortUrl($keu_master_tanggungan->apakah_disembunyikan) == "") { ?>
		<td><?php echo $keu_master_tanggungan->apakah_disembunyikan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_master_tanggungan->SortUrl($keu_master_tanggungan->apakah_disembunyikan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_master_tanggungan->apakah_disembunyikan->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_master_tanggungan->apakah_disembunyikan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_master_tanggungan->apakah_disembunyikan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_master_tanggungan->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($keu_master_tanggungan->SortUrl($keu_master_tanggungan->kode_otomatis) == "") { ?>
		<td><?php echo $keu_master_tanggungan->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_master_tanggungan->SortUrl($keu_master_tanggungan->kode_otomatis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_master_tanggungan->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_master_tanggungan->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_master_tanggungan->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_master_tanggungan->rek_pendapatan->Visible) { // rek_pendapatan ?>
	<?php if ($keu_master_tanggungan->SortUrl($keu_master_tanggungan->rek_pendapatan) == "") { ?>
		<td><?php echo $keu_master_tanggungan->rek_pendapatan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_master_tanggungan->SortUrl($keu_master_tanggungan->rek_pendapatan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_master_tanggungan->rek_pendapatan->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_master_tanggungan->rek_pendapatan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_master_tanggungan->rek_pendapatan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_master_tanggungan->rek_kas->Visible) { // rek_kas ?>
	<?php if ($keu_master_tanggungan->SortUrl($keu_master_tanggungan->rek_kas) == "") { ?>
		<td><?php echo $keu_master_tanggungan->rek_kas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_master_tanggungan->SortUrl($keu_master_tanggungan->rek_kas) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_master_tanggungan->rek_kas->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_master_tanggungan->rek_kas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_master_tanggungan->rek_kas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$keu_master_tanggungan_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($keu_master_tanggungan->ExportAll && $keu_master_tanggungan->Export <> "") {
	$keu_master_tanggungan_list->StopRec = $keu_master_tanggungan_list->TotalRecs;
} else {

	// Set the last record to display
	if ($keu_master_tanggungan_list->TotalRecs > $keu_master_tanggungan_list->StartRec + $keu_master_tanggungan_list->DisplayRecs - 1)
		$keu_master_tanggungan_list->StopRec = $keu_master_tanggungan_list->StartRec + $keu_master_tanggungan_list->DisplayRecs - 1;
	else
		$keu_master_tanggungan_list->StopRec = $keu_master_tanggungan_list->TotalRecs;
}
$keu_master_tanggungan_list->RecCnt = $keu_master_tanggungan_list->StartRec - 1;
if ($keu_master_tanggungan_list->Recordset && !$keu_master_tanggungan_list->Recordset->EOF) {
	$keu_master_tanggungan_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $keu_master_tanggungan_list->StartRec > 1)
		$keu_master_tanggungan_list->Recordset->Move($keu_master_tanggungan_list->StartRec - 1);
} elseif (!$keu_master_tanggungan->AllowAddDeleteRow && $keu_master_tanggungan_list->StopRec == 0) {
	$keu_master_tanggungan_list->StopRec = $keu_master_tanggungan->GridAddRowCount;
}

// Initialize aggregate
$keu_master_tanggungan->RowType = EW_ROWTYPE_AGGREGATEINIT;
$keu_master_tanggungan->ResetAttrs();
$keu_master_tanggungan_list->RenderRow();
$keu_master_tanggungan_list->RowCnt = 0;
while ($keu_master_tanggungan_list->RecCnt < $keu_master_tanggungan_list->StopRec) {
	$keu_master_tanggungan_list->RecCnt++;
	if (intval($keu_master_tanggungan_list->RecCnt) >= intval($keu_master_tanggungan_list->StartRec)) {
		$keu_master_tanggungan_list->RowCnt++;

		// Set up key count
		$keu_master_tanggungan_list->KeyCount = $keu_master_tanggungan_list->RowIndex;

		// Init row class and style
		$keu_master_tanggungan->ResetAttrs();
		$keu_master_tanggungan->CssClass = "";
		if ($keu_master_tanggungan->CurrentAction == "gridadd") {
		} else {
			$keu_master_tanggungan_list->LoadRowValues($keu_master_tanggungan_list->Recordset); // Load row values
		}
		$keu_master_tanggungan->RowType = EW_ROWTYPE_VIEW; // Render view
		$keu_master_tanggungan->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$keu_master_tanggungan_list->RenderRow();

		// Render list options
		$keu_master_tanggungan_list->RenderListOptions();
?>
	<tr<?php echo $keu_master_tanggungan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$keu_master_tanggungan_list->ListOptions->Render("body", "left");
?>
	<?php if ($keu_master_tanggungan->nama_biaya->Visible) { // nama_biaya ?>
		<td<?php echo $keu_master_tanggungan->nama_biaya->CellAttributes() ?>>
<div<?php echo $keu_master_tanggungan->nama_biaya->ViewAttributes() ?>><?php echo $keu_master_tanggungan->nama_biaya->ListViewValue() ?></div>
<a name="<?php echo $keu_master_tanggungan_list->PageObjName . "_row_" . $keu_master_tanggungan_list->RowCnt ?>" id="<?php echo $keu_master_tanggungan_list->PageObjName . "_row_" . $keu_master_tanggungan_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($keu_master_tanggungan->apakah_disembunyikan->Visible) { // apakah_disembunyikan ?>
		<td<?php echo $keu_master_tanggungan->apakah_disembunyikan->CellAttributes() ?>>
<div<?php echo $keu_master_tanggungan->apakah_disembunyikan->ViewAttributes() ?>><?php echo $keu_master_tanggungan->apakah_disembunyikan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_master_tanggungan->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $keu_master_tanggungan->kode_otomatis->CellAttributes() ?>>
<div<?php echo $keu_master_tanggungan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_master_tanggungan->kode_otomatis->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_master_tanggungan->rek_pendapatan->Visible) { // rek_pendapatan ?>
		<td<?php echo $keu_master_tanggungan->rek_pendapatan->CellAttributes() ?>>
<div<?php echo $keu_master_tanggungan->rek_pendapatan->ViewAttributes() ?>><?php echo $keu_master_tanggungan->rek_pendapatan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_master_tanggungan->rek_kas->Visible) { // rek_kas ?>
		<td<?php echo $keu_master_tanggungan->rek_kas->CellAttributes() ?>>
<div<?php echo $keu_master_tanggungan->rek_kas->ViewAttributes() ?>><?php echo $keu_master_tanggungan->rek_kas->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$keu_master_tanggungan_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($keu_master_tanggungan->CurrentAction <> "gridadd")
		$keu_master_tanggungan_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($keu_master_tanggungan_list->Recordset)
	$keu_master_tanggungan_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($keu_master_tanggungan->Export == "" && $keu_master_tanggungan->CurrentAction == "") { ?>
<?php } ?>
<?php
$keu_master_tanggungan_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($keu_master_tanggungan->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$keu_master_tanggungan_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_master_tanggungan_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'keu_master_tanggungan';

	// Page object name
	var $PageObjName = 'keu_master_tanggungan_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_master_tanggungan;
		if ($keu_master_tanggungan->UseTokenInUrl) $PageUrl .= "t=" . $keu_master_tanggungan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_master_tanggungan;
		if ($keu_master_tanggungan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_master_tanggungan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_master_tanggungan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_master_tanggungan_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_master_tanggungan)
		if (!isset($GLOBALS["keu_master_tanggungan"])) {
			$GLOBALS["keu_master_tanggungan"] = new ckeu_master_tanggungan();
			$GLOBALS["Table"] =& $GLOBALS["keu_master_tanggungan"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "keu_master_tanggunganadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "keu_master_tanggungandelete.php";
		$this->MultiUpdateUrl = "keu_master_tanggunganupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_master_tanggungan', TRUE);

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
		global $keu_master_tanggungan;

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
			$keu_master_tanggungan->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $keu_master_tanggungan;

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
			if ($keu_master_tanggungan->Export <> "" ||
				$keu_master_tanggungan->CurrentAction == "gridadd" ||
				$keu_master_tanggungan->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$keu_master_tanggungan->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($keu_master_tanggungan->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $keu_master_tanggungan->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$keu_master_tanggungan->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$keu_master_tanggungan->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$keu_master_tanggungan->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $keu_master_tanggungan->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$keu_master_tanggungan->setSessionWhere($sFilter);
		$keu_master_tanggungan->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $keu_master_tanggungan;
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
			$keu_master_tanggungan->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$keu_master_tanggungan->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $keu_master_tanggungan;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $keu_master_tanggungan->nama_biaya, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $keu_master_tanggungan->apakah_disembunyikan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $keu_master_tanggungan->kode_otomatis, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $keu_master_tanggungan->rek_pendapatan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $keu_master_tanggungan->rek_kas, $Keyword);
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
		global $Security, $keu_master_tanggungan;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $keu_master_tanggungan->BasicSearchKeyword;
		$sSearchType = $keu_master_tanggungan->BasicSearchType;
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
			$keu_master_tanggungan->setSessionBasicSearchKeyword($sSearchKeyword);
			$keu_master_tanggungan->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $keu_master_tanggungan;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$keu_master_tanggungan->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $keu_master_tanggungan;
		$keu_master_tanggungan->setSessionBasicSearchKeyword("");
		$keu_master_tanggungan->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $keu_master_tanggungan;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$keu_master_tanggungan->BasicSearchKeyword = $keu_master_tanggungan->getSessionBasicSearchKeyword();
			$keu_master_tanggungan->BasicSearchType = $keu_master_tanggungan->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $keu_master_tanggungan;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$keu_master_tanggungan->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$keu_master_tanggungan->CurrentOrderType = @$_GET["ordertype"];
			$keu_master_tanggungan->UpdateSort($keu_master_tanggungan->nama_biaya); // nama_biaya
			$keu_master_tanggungan->UpdateSort($keu_master_tanggungan->apakah_disembunyikan); // apakah_disembunyikan
			$keu_master_tanggungan->UpdateSort($keu_master_tanggungan->kode_otomatis); // kode_otomatis
			$keu_master_tanggungan->UpdateSort($keu_master_tanggungan->rek_pendapatan); // rek_pendapatan
			$keu_master_tanggungan->UpdateSort($keu_master_tanggungan->rek_kas); // rek_kas
			$keu_master_tanggungan->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $keu_master_tanggungan;
		$sOrderBy = $keu_master_tanggungan->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($keu_master_tanggungan->SqlOrderBy() <> "") {
				$sOrderBy = $keu_master_tanggungan->SqlOrderBy();
				$keu_master_tanggungan->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $keu_master_tanggungan;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$keu_master_tanggungan->setSessionOrderBy($sOrderBy);
				$keu_master_tanggungan->nama_biaya->setSort("");
				$keu_master_tanggungan->apakah_disembunyikan->setSort("");
				$keu_master_tanggungan->kode_otomatis->setSort("");
				$keu_master_tanggungan->rek_pendapatan->setSort("");
				$keu_master_tanggungan->rek_kas->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$keu_master_tanggungan->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $keu_master_tanggungan;

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
		global $Security, $Language, $keu_master_tanggungan, $objForm;
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
		global $Security, $Language, $keu_master_tanggungan;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $keu_master_tanggungan;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$keu_master_tanggungan->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$keu_master_tanggungan->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $keu_master_tanggungan->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$keu_master_tanggungan->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$keu_master_tanggungan->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$keu_master_tanggungan->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $keu_master_tanggungan;
		$keu_master_tanggungan->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$keu_master_tanggungan->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $keu_master_tanggungan;

		// Call Recordset Selecting event
		$keu_master_tanggungan->Recordset_Selecting($keu_master_tanggungan->CurrentFilter);

		// Load List page SQL
		$sSql = $keu_master_tanggungan->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$keu_master_tanggungan->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_master_tanggungan;
		$sFilter = $keu_master_tanggungan->KeyFilter();

		// Call Row Selecting event
		$keu_master_tanggungan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_master_tanggungan->CurrentFilter = $sFilter;
		$sSql = $keu_master_tanggungan->SQL();
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
		global $conn, $keu_master_tanggungan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_master_tanggungan->Row_Selected($row);
		$keu_master_tanggungan->nama_biaya->setDbValue($rs->fields('nama_biaya'));
		$keu_master_tanggungan->apakah_disembunyikan->setDbValue($rs->fields('apakah_disembunyikan'));
		$keu_master_tanggungan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_master_tanggungan->rek_pendapatan->setDbValue($rs->fields('rek_pendapatan'));
		$keu_master_tanggungan->rek_kas->setDbValue($rs->fields('rek_kas'));
	}

	// Load old record
	function LoadOldRecord() {
		global $keu_master_tanggungan;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($keu_master_tanggungan->getKey("kode_otomatis")) <> "")
			$keu_master_tanggungan->kode_otomatis->CurrentValue = $keu_master_tanggungan->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$keu_master_tanggungan->CurrentFilter = $keu_master_tanggungan->KeyFilter();
			$sSql = $keu_master_tanggungan->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_master_tanggungan;

		// Initialize URLs
		$this->ViewUrl = $keu_master_tanggungan->ViewUrl();
		$this->EditUrl = $keu_master_tanggungan->EditUrl();
		$this->InlineEditUrl = $keu_master_tanggungan->InlineEditUrl();
		$this->CopyUrl = $keu_master_tanggungan->CopyUrl();
		$this->InlineCopyUrl = $keu_master_tanggungan->InlineCopyUrl();
		$this->DeleteUrl = $keu_master_tanggungan->DeleteUrl();

		// Call Row_Rendering event
		$keu_master_tanggungan->Row_Rendering();

		// Common render codes for all row types
		// nama_biaya
		// apakah_disembunyikan
		// kode_otomatis
		// rek_pendapatan
		// rek_kas

		if ($keu_master_tanggungan->RowType == EW_ROWTYPE_VIEW) { // View row

			// nama_biaya
			$keu_master_tanggungan->nama_biaya->ViewValue = $keu_master_tanggungan->nama_biaya->CurrentValue;
			$keu_master_tanggungan->nama_biaya->ViewCustomAttributes = "";

			// apakah_disembunyikan
			if (strval($keu_master_tanggungan->apakah_disembunyikan->CurrentValue) <> "") {
				switch ($keu_master_tanggungan->apakah_disembunyikan->CurrentValue) {
					case "y":
						$keu_master_tanggungan->apakah_disembunyikan->ViewValue = $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(1) <> "" ? $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(1) : $keu_master_tanggungan->apakah_disembunyikan->CurrentValue;
						break;
					case "t":
						$keu_master_tanggungan->apakah_disembunyikan->ViewValue = $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(2) <> "" ? $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(2) : $keu_master_tanggungan->apakah_disembunyikan->CurrentValue;
						break;
					default:
						$keu_master_tanggungan->apakah_disembunyikan->ViewValue = $keu_master_tanggungan->apakah_disembunyikan->CurrentValue;
				}
			} else {
				$keu_master_tanggungan->apakah_disembunyikan->ViewValue = NULL;
			}
			$keu_master_tanggungan->apakah_disembunyikan->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_master_tanggungan->kode_otomatis->ViewValue = $keu_master_tanggungan->kode_otomatis->CurrentValue;
			$keu_master_tanggungan->kode_otomatis->ViewCustomAttributes = "";

			// rek_pendapatan
			if (strval($keu_master_tanggungan->rek_pendapatan->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_master_tanggungan->rek_pendapatan->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan`, `D/K` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_master_tanggungan->rek_pendapatan->ViewValue = $rswrk->fields('Norek');
					$keu_master_tanggungan->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,1,$keu_master_tanggungan->rek_pendapatan) . $rswrk->fields('Keterangan');
					$keu_master_tanggungan->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,2,$keu_master_tanggungan->rek_pendapatan) . $rswrk->fields('D/K');
					$rswrk->Close();
				} else {
					$keu_master_tanggungan->rek_pendapatan->ViewValue = $keu_master_tanggungan->rek_pendapatan->CurrentValue;
				}
			} else {
				$keu_master_tanggungan->rek_pendapatan->ViewValue = NULL;
			}
			$keu_master_tanggungan->rek_pendapatan->ViewCustomAttributes = "";

			// rek_kas
			if (strval($keu_master_tanggungan->rek_kas->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_master_tanggungan->rek_kas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan`, `D/K` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_master_tanggungan->rek_kas->ViewValue = $rswrk->fields('Norek');
					$keu_master_tanggungan->rek_kas->ViewValue .= ew_ValueSeparator(0,1,$keu_master_tanggungan->rek_kas) . $rswrk->fields('Keterangan');
					$keu_master_tanggungan->rek_kas->ViewValue .= ew_ValueSeparator(0,2,$keu_master_tanggungan->rek_kas) . $rswrk->fields('D/K');
					$rswrk->Close();
				} else {
					$keu_master_tanggungan->rek_kas->ViewValue = $keu_master_tanggungan->rek_kas->CurrentValue;
				}
			} else {
				$keu_master_tanggungan->rek_kas->ViewValue = NULL;
			}
			$keu_master_tanggungan->rek_kas->ViewCustomAttributes = "";

			// nama_biaya
			$keu_master_tanggungan->nama_biaya->LinkCustomAttributes = "";
			$keu_master_tanggungan->nama_biaya->HrefValue = "";
			$keu_master_tanggungan->nama_biaya->TooltipValue = "";

			// apakah_disembunyikan
			$keu_master_tanggungan->apakah_disembunyikan->LinkCustomAttributes = "";
			$keu_master_tanggungan->apakah_disembunyikan->HrefValue = "";
			$keu_master_tanggungan->apakah_disembunyikan->TooltipValue = "";

			// kode_otomatis
			$keu_master_tanggungan->kode_otomatis->LinkCustomAttributes = "";
			$keu_master_tanggungan->kode_otomatis->HrefValue = "";
			$keu_master_tanggungan->kode_otomatis->TooltipValue = "";

			// rek_pendapatan
			$keu_master_tanggungan->rek_pendapatan->LinkCustomAttributes = "";
			$keu_master_tanggungan->rek_pendapatan->HrefValue = "";
			$keu_master_tanggungan->rek_pendapatan->TooltipValue = "";

			// rek_kas
			$keu_master_tanggungan->rek_kas->LinkCustomAttributes = "";
			$keu_master_tanggungan->rek_kas->HrefValue = "";
			$keu_master_tanggungan->rek_kas->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($keu_master_tanggungan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_master_tanggungan->Row_Rendered();
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

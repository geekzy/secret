<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_tanggunganinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_tanggungan_list = new ckeu_tanggungan_list();
$Page =& $keu_tanggungan_list;

// Page init
$keu_tanggungan_list->Page_Init();

// Page main
$keu_tanggungan_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($keu_tanggungan->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var keu_tanggungan_list = new ew_Page("keu_tanggungan_list");

// page properties
keu_tanggungan_list.PageID = "list"; // page ID
keu_tanggungan_list.FormID = "fkeu_tanggunganlist"; // form ID
var EW_PAGE_ID = keu_tanggungan_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
keu_tanggungan_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_tanggungan_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_tanggungan_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($keu_tanggungan->Export == "") || (EW_EXPORT_MASTER_RECORD && $keu_tanggungan->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$keu_tanggungan_list->TotalRecs = $keu_tanggungan->SelectRecordCount();
	} else {
		if ($keu_tanggungan_list->Recordset = $keu_tanggungan_list->LoadRecordset())
			$keu_tanggungan_list->TotalRecs = $keu_tanggungan_list->Recordset->RecordCount();
	}
	$keu_tanggungan_list->StartRec = 1;
	if ($keu_tanggungan_list->DisplayRecs <= 0 || ($keu_tanggungan->Export <> "" && $keu_tanggungan->ExportAll)) // Display all records
		$keu_tanggungan_list->DisplayRecs = $keu_tanggungan_list->TotalRecs;
	if (!($keu_tanggungan->Export <> "" && $keu_tanggungan->ExportAll))
		$keu_tanggungan_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$keu_tanggungan_list->Recordset = $keu_tanggungan_list->LoadRecordset($keu_tanggungan_list->StartRec-1, $keu_tanggungan_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_tanggungan->TableCaption() ?>
&nbsp;&nbsp;<?php $keu_tanggungan_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($keu_tanggungan->Export == "" && $keu_tanggungan->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(keu_tanggungan_list);" style="text-decoration: none;"><img id="keu_tanggungan_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="keu_tanggungan_list_SearchPanel">
<form name="fkeu_tanggunganlistsrch" id="fkeu_tanggunganlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="keu_tanggungan">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($keu_tanggungan->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $keu_tanggungan_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($keu_tanggungan->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($keu_tanggungan->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($keu_tanggungan->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $keu_tanggungan_list->ShowPageHeader(); ?>
<?php
$keu_tanggungan_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($keu_tanggungan->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($keu_tanggungan->CurrentAction <> "gridadd" && $keu_tanggungan->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($keu_tanggungan_list->Pager)) $keu_tanggungan_list->Pager = new cNumericPager($keu_tanggungan_list->StartRec, $keu_tanggungan_list->DisplayRecs, $keu_tanggungan_list->TotalRecs, $keu_tanggungan_list->RecRange) ?>
<?php if ($keu_tanggungan_list->Pager->RecordCount > 0) { ?>
	<?php if ($keu_tanggungan_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $keu_tanggungan_list->PageUrl() ?>start=<?php echo $keu_tanggungan_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_tanggungan_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $keu_tanggungan_list->PageUrl() ?>start=<?php echo $keu_tanggungan_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($keu_tanggungan_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $keu_tanggungan_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($keu_tanggungan_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $keu_tanggungan_list->PageUrl() ?>start=<?php echo $keu_tanggungan_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_tanggungan_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $keu_tanggungan_list->PageUrl() ?>start=<?php echo $keu_tanggungan_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_tanggungan_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $keu_tanggungan_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $keu_tanggungan_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $keu_tanggungan_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($keu_tanggungan_list->SearchWhere == "0=101") { ?>
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
<?php if ($keu_tanggungan_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="keu_tanggungan">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($keu_tanggungan_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($keu_tanggungan_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($keu_tanggungan_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($keu_tanggungan_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($keu_tanggungan_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($keu_tanggungan_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($keu_tanggungan_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($keu_tanggungan_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($keu_tanggungan_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $keu_tanggungan_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fkeu_tanggunganlist" id="fkeu_tanggunganlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="keu_tanggungan">
<div id="gmp_keu_tanggungan" class="ewGridMiddlePanel">
<?php if ($keu_tanggungan_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $keu_tanggungan->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$keu_tanggungan_list->RenderListOptions();

// Render list options (header, left)
$keu_tanggungan_list->ListOptions->Render("header", "left");
?>
<?php if ($keu_tanggungan->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($keu_tanggungan->SortUrl($keu_tanggungan->kode_otomatis) == "") { ?>
		<td><?php echo $keu_tanggungan->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_tanggungan->SortUrl($keu_tanggungan->kode_otomatis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_tanggungan->kode_otomatis->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($keu_tanggungan->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_tanggungan->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_tanggungan->kode_otomatis_master_tanggungan->Visible) { // kode_otomatis_master_tanggungan ?>
	<?php if ($keu_tanggungan->SortUrl($keu_tanggungan->kode_otomatis_master_tanggungan) == "") { ?>
		<td><?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_tanggungan->SortUrl($keu_tanggungan->kode_otomatis_master_tanggungan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($keu_tanggungan->kode_otomatis_master_tanggungan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_tanggungan->kode_otomatis_master_tanggungan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_tanggungan->identitas->Visible) { // identitas ?>
	<?php if ($keu_tanggungan->SortUrl($keu_tanggungan->identitas) == "") { ?>
		<td><?php echo $keu_tanggungan->identitas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_tanggungan->SortUrl($keu_tanggungan->identitas) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_tanggungan->identitas->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($keu_tanggungan->identitas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_tanggungan->identitas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_tanggungan->diskon_sosial->Visible) { // diskon_sosial ?>
	<?php if ($keu_tanggungan->SortUrl($keu_tanggungan->diskon_sosial) == "") { ?>
		<td><?php echo $keu_tanggungan->diskon_sosial->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_tanggungan->SortUrl($keu_tanggungan->diskon_sosial) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_tanggungan->diskon_sosial->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_tanggungan->diskon_sosial->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_tanggungan->diskon_sosial->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_tanggungan->diskon_waktu->Visible) { // diskon_waktu ?>
	<?php if ($keu_tanggungan->SortUrl($keu_tanggungan->diskon_waktu) == "") { ?>
		<td><?php echo $keu_tanggungan->diskon_waktu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_tanggungan->SortUrl($keu_tanggungan->diskon_waktu) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_tanggungan->diskon_waktu->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_tanggungan->diskon_waktu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_tanggungan->diskon_waktu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_tanggungan->diskon_prestasi->Visible) { // diskon_prestasi ?>
	<?php if ($keu_tanggungan->SortUrl($keu_tanggungan->diskon_prestasi) == "") { ?>
		<td><?php echo $keu_tanggungan->diskon_prestasi->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_tanggungan->SortUrl($keu_tanggungan->diskon_prestasi) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_tanggungan->diskon_prestasi->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_tanggungan->diskon_prestasi->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_tanggungan->diskon_prestasi->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_tanggungan->diskon_internal->Visible) { // diskon_internal ?>
	<?php if ($keu_tanggungan->SortUrl($keu_tanggungan->diskon_internal) == "") { ?>
		<td><?php echo $keu_tanggungan->diskon_internal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_tanggungan->SortUrl($keu_tanggungan->diskon_internal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_tanggungan->diskon_internal->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_tanggungan->diskon_internal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_tanggungan->diskon_internal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_tanggungan->diskon_lain_lain->Visible) { // diskon_lain_lain ?>
	<?php if ($keu_tanggungan->SortUrl($keu_tanggungan->diskon_lain_lain) == "") { ?>
		<td><?php echo $keu_tanggungan->diskon_lain_lain->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_tanggungan->SortUrl($keu_tanggungan->diskon_lain_lain) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_tanggungan->diskon_lain_lain->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_tanggungan->diskon_lain_lain->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_tanggungan->diskon_lain_lain->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_tanggungan->nilai_tanggungan->Visible) { // nilai_tanggungan ?>
	<?php if ($keu_tanggungan->SortUrl($keu_tanggungan->nilai_tanggungan) == "") { ?>
		<td><?php echo $keu_tanggungan->nilai_tanggungan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_tanggungan->SortUrl($keu_tanggungan->nilai_tanggungan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_tanggungan->nilai_tanggungan->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_tanggungan->nilai_tanggungan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_tanggungan->nilai_tanggungan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_tanggungan->tanggal_rencana_bayar->Visible) { // tanggal_rencana_bayar ?>
	<?php if ($keu_tanggungan->SortUrl($keu_tanggungan->tanggal_rencana_bayar) == "") { ?>
		<td><?php echo $keu_tanggungan->tanggal_rencana_bayar->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_tanggungan->SortUrl($keu_tanggungan->tanggal_rencana_bayar) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_tanggungan->tanggal_rencana_bayar->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_tanggungan->tanggal_rencana_bayar->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_tanggungan->tanggal_rencana_bayar->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$keu_tanggungan_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($keu_tanggungan->ExportAll && $keu_tanggungan->Export <> "") {
	$keu_tanggungan_list->StopRec = $keu_tanggungan_list->TotalRecs;
} else {

	// Set the last record to display
	if ($keu_tanggungan_list->TotalRecs > $keu_tanggungan_list->StartRec + $keu_tanggungan_list->DisplayRecs - 1)
		$keu_tanggungan_list->StopRec = $keu_tanggungan_list->StartRec + $keu_tanggungan_list->DisplayRecs - 1;
	else
		$keu_tanggungan_list->StopRec = $keu_tanggungan_list->TotalRecs;
}
$keu_tanggungan_list->RecCnt = $keu_tanggungan_list->StartRec - 1;
if ($keu_tanggungan_list->Recordset && !$keu_tanggungan_list->Recordset->EOF) {
	$keu_tanggungan_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $keu_tanggungan_list->StartRec > 1)
		$keu_tanggungan_list->Recordset->Move($keu_tanggungan_list->StartRec - 1);
} elseif (!$keu_tanggungan->AllowAddDeleteRow && $keu_tanggungan_list->StopRec == 0) {
	$keu_tanggungan_list->StopRec = $keu_tanggungan->GridAddRowCount;
}

// Initialize aggregate
$keu_tanggungan->RowType = EW_ROWTYPE_AGGREGATEINIT;
$keu_tanggungan->ResetAttrs();
$keu_tanggungan_list->RenderRow();
$keu_tanggungan_list->RowCnt = 0;
while ($keu_tanggungan_list->RecCnt < $keu_tanggungan_list->StopRec) {
	$keu_tanggungan_list->RecCnt++;
	if (intval($keu_tanggungan_list->RecCnt) >= intval($keu_tanggungan_list->StartRec)) {
		$keu_tanggungan_list->RowCnt++;

		// Set up key count
		$keu_tanggungan_list->KeyCount = $keu_tanggungan_list->RowIndex;

		// Init row class and style
		$keu_tanggungan->ResetAttrs();
		$keu_tanggungan->CssClass = "";
		if ($keu_tanggungan->CurrentAction == "gridadd") {
		} else {
			$keu_tanggungan_list->LoadRowValues($keu_tanggungan_list->Recordset); // Load row values
		}
		$keu_tanggungan->RowType = EW_ROWTYPE_VIEW; // Render view
		$keu_tanggungan->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$keu_tanggungan_list->RenderRow();

		// Render list options
		$keu_tanggungan_list->RenderListOptions();
?>
	<tr<?php echo $keu_tanggungan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$keu_tanggungan_list->ListOptions->Render("body", "left");
?>
	<?php if ($keu_tanggungan->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $keu_tanggungan->kode_otomatis->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_tanggungan->kode_otomatis->ListViewValue() ?></div>
<a name="<?php echo $keu_tanggungan_list->PageObjName . "_row_" . $keu_tanggungan_list->RowCnt ?>" id="<?php echo $keu_tanggungan_list->PageObjName . "_row_" . $keu_tanggungan_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($keu_tanggungan->kode_otomatis_master_tanggungan->Visible) { // kode_otomatis_master_tanggungan ?>
		<td<?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->ViewAttributes() ?>><?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_tanggungan->identitas->Visible) { // identitas ?>
		<td<?php echo $keu_tanggungan->identitas->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->identitas->ViewAttributes() ?>><?php echo $keu_tanggungan->identitas->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_tanggungan->diskon_sosial->Visible) { // diskon_sosial ?>
		<td<?php echo $keu_tanggungan->diskon_sosial->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_sosial->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_sosial->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_tanggungan->diskon_waktu->Visible) { // diskon_waktu ?>
		<td<?php echo $keu_tanggungan->diskon_waktu->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_waktu->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_waktu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_tanggungan->diskon_prestasi->Visible) { // diskon_prestasi ?>
		<td<?php echo $keu_tanggungan->diskon_prestasi->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_prestasi->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_prestasi->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_tanggungan->diskon_internal->Visible) { // diskon_internal ?>
		<td<?php echo $keu_tanggungan->diskon_internal->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_internal->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_internal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_tanggungan->diskon_lain_lain->Visible) { // diskon_lain_lain ?>
		<td<?php echo $keu_tanggungan->diskon_lain_lain->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->diskon_lain_lain->ViewAttributes() ?>><?php echo $keu_tanggungan->diskon_lain_lain->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_tanggungan->nilai_tanggungan->Visible) { // nilai_tanggungan ?>
		<td<?php echo $keu_tanggungan->nilai_tanggungan->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->nilai_tanggungan->ViewAttributes() ?>><?php echo $keu_tanggungan->nilai_tanggungan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_tanggungan->tanggal_rencana_bayar->Visible) { // tanggal_rencana_bayar ?>
		<td<?php echo $keu_tanggungan->tanggal_rencana_bayar->CellAttributes() ?>>
<div<?php echo $keu_tanggungan->tanggal_rencana_bayar->ViewAttributes() ?>><?php echo $keu_tanggungan->tanggal_rencana_bayar->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$keu_tanggungan_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($keu_tanggungan->CurrentAction <> "gridadd")
		$keu_tanggungan_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($keu_tanggungan_list->Recordset)
	$keu_tanggungan_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($keu_tanggungan->Export == "" && $keu_tanggungan->CurrentAction == "") { ?>
<?php } ?>
<?php
$keu_tanggungan_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($keu_tanggungan->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$keu_tanggungan_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_tanggungan_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'keu_tanggungan';

	// Page object name
	var $PageObjName = 'keu_tanggungan_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_tanggungan;
		if ($keu_tanggungan->UseTokenInUrl) $PageUrl .= "t=" . $keu_tanggungan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_tanggungan;
		if ($keu_tanggungan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_tanggungan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_tanggungan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_tanggungan_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_tanggungan)
		if (!isset($GLOBALS["keu_tanggungan"])) {
			$GLOBALS["keu_tanggungan"] = new ckeu_tanggungan();
			$GLOBALS["Table"] =& $GLOBALS["keu_tanggungan"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "keu_tanggunganadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "keu_tanggungandelete.php";
		$this->MultiUpdateUrl = "keu_tanggunganupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_tanggungan', TRUE);

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
		global $keu_tanggungan;

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
			$keu_tanggungan->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $keu_tanggungan;

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
			if ($keu_tanggungan->Export <> "" ||
				$keu_tanggungan->CurrentAction == "gridadd" ||
				$keu_tanggungan->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$keu_tanggungan->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($keu_tanggungan->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $keu_tanggungan->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$keu_tanggungan->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$keu_tanggungan->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$keu_tanggungan->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $keu_tanggungan->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$keu_tanggungan->setSessionWhere($sFilter);
		$keu_tanggungan->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $keu_tanggungan;
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
			$keu_tanggungan->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$keu_tanggungan->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $keu_tanggungan;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $keu_tanggungan->kode_otomatis, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $keu_tanggungan->kode_otomatis_master_tanggungan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $keu_tanggungan->identitas, $Keyword);
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
		global $Security, $keu_tanggungan;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $keu_tanggungan->BasicSearchKeyword;
		$sSearchType = $keu_tanggungan->BasicSearchType;
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
			$keu_tanggungan->setSessionBasicSearchKeyword($sSearchKeyword);
			$keu_tanggungan->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $keu_tanggungan;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$keu_tanggungan->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $keu_tanggungan;
		$keu_tanggungan->setSessionBasicSearchKeyword("");
		$keu_tanggungan->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $keu_tanggungan;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$keu_tanggungan->BasicSearchKeyword = $keu_tanggungan->getSessionBasicSearchKeyword();
			$keu_tanggungan->BasicSearchType = $keu_tanggungan->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $keu_tanggungan;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$keu_tanggungan->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$keu_tanggungan->CurrentOrderType = @$_GET["ordertype"];
			$keu_tanggungan->UpdateSort($keu_tanggungan->kode_otomatis); // kode_otomatis
			$keu_tanggungan->UpdateSort($keu_tanggungan->kode_otomatis_master_tanggungan); // kode_otomatis_master_tanggungan
			$keu_tanggungan->UpdateSort($keu_tanggungan->identitas); // identitas
			$keu_tanggungan->UpdateSort($keu_tanggungan->diskon_sosial); // diskon_sosial
			$keu_tanggungan->UpdateSort($keu_tanggungan->diskon_waktu); // diskon_waktu
			$keu_tanggungan->UpdateSort($keu_tanggungan->diskon_prestasi); // diskon_prestasi
			$keu_tanggungan->UpdateSort($keu_tanggungan->diskon_internal); // diskon_internal
			$keu_tanggungan->UpdateSort($keu_tanggungan->diskon_lain_lain); // diskon_lain_lain
			$keu_tanggungan->UpdateSort($keu_tanggungan->nilai_tanggungan); // nilai_tanggungan
			$keu_tanggungan->UpdateSort($keu_tanggungan->tanggal_rencana_bayar); // tanggal_rencana_bayar
			$keu_tanggungan->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $keu_tanggungan;
		$sOrderBy = $keu_tanggungan->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($keu_tanggungan->SqlOrderBy() <> "") {
				$sOrderBy = $keu_tanggungan->SqlOrderBy();
				$keu_tanggungan->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $keu_tanggungan;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$keu_tanggungan->setSessionOrderBy($sOrderBy);
				$keu_tanggungan->kode_otomatis->setSort("");
				$keu_tanggungan->kode_otomatis_master_tanggungan->setSort("");
				$keu_tanggungan->identitas->setSort("");
				$keu_tanggungan->diskon_sosial->setSort("");
				$keu_tanggungan->diskon_waktu->setSort("");
				$keu_tanggungan->diskon_prestasi->setSort("");
				$keu_tanggungan->diskon_internal->setSort("");
				$keu_tanggungan->diskon_lain_lain->setSort("");
				$keu_tanggungan->nilai_tanggungan->setSort("");
				$keu_tanggungan->tanggal_rencana_bayar->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$keu_tanggungan->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $keu_tanggungan;

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

		// "copy"
		$item =& $this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
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
		global $Security, $Language, $keu_tanggungan, $objForm;
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

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->CanAdd() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->CopyUrl . "\">" . "<img src=\"phpimages/copy.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("CopyLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("CopyLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
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
		global $Security, $Language, $keu_tanggungan;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $keu_tanggungan;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$keu_tanggungan->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$keu_tanggungan->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $keu_tanggungan->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$keu_tanggungan->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$keu_tanggungan->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$keu_tanggungan->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $keu_tanggungan;
		$keu_tanggungan->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$keu_tanggungan->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $keu_tanggungan;

		// Call Recordset Selecting event
		$keu_tanggungan->Recordset_Selecting($keu_tanggungan->CurrentFilter);

		// Load List page SQL
		$sSql = $keu_tanggungan->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$keu_tanggungan->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_tanggungan;
		$sFilter = $keu_tanggungan->KeyFilter();

		// Call Row Selecting event
		$keu_tanggungan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_tanggungan->CurrentFilter = $sFilter;
		$sSql = $keu_tanggungan->SQL();
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
		global $conn, $keu_tanggungan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_tanggungan->Row_Selected($row);
		$keu_tanggungan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_tanggungan->kode_otomatis_master_tanggungan->setDbValue($rs->fields('kode_otomatis_master_tanggungan'));
		$keu_tanggungan->identitas->setDbValue($rs->fields('identitas'));
		$keu_tanggungan->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$keu_tanggungan->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$keu_tanggungan->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$keu_tanggungan->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$keu_tanggungan->diskon_lain_lain->setDbValue($rs->fields('diskon_lain_lain'));
		$keu_tanggungan->nilai_tanggungan->setDbValue($rs->fields('nilai_tanggungan'));
		$keu_tanggungan->tanggal_rencana_bayar->setDbValue($rs->fields('tanggal_rencana_bayar'));
	}

	// Load old record
	function LoadOldRecord() {
		global $keu_tanggungan;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($keu_tanggungan->getKey("kode_otomatis")) <> "")
			$keu_tanggungan->kode_otomatis->CurrentValue = $keu_tanggungan->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$keu_tanggungan->CurrentFilter = $keu_tanggungan->KeyFilter();
			$sSql = $keu_tanggungan->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_tanggungan;

		// Initialize URLs
		$this->ViewUrl = $keu_tanggungan->ViewUrl();
		$this->EditUrl = $keu_tanggungan->EditUrl();
		$this->InlineEditUrl = $keu_tanggungan->InlineEditUrl();
		$this->CopyUrl = $keu_tanggungan->CopyUrl();
		$this->InlineCopyUrl = $keu_tanggungan->InlineCopyUrl();
		$this->DeleteUrl = $keu_tanggungan->DeleteUrl();

		// Call Row_Rendering event
		$keu_tanggungan->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis
		// kode_otomatis_master_tanggungan
		// identitas
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain_lain
		// nilai_tanggungan
		// tanggal_rencana_bayar

		if ($keu_tanggungan->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_otomatis
			$keu_tanggungan->kode_otomatis->ViewValue = $keu_tanggungan->kode_otomatis->CurrentValue;
			$keu_tanggungan->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_master_tanggungan
			$keu_tanggungan->kode_otomatis_master_tanggungan->ViewValue = $keu_tanggungan->kode_otomatis_master_tanggungan->CurrentValue;
			$keu_tanggungan->kode_otomatis_master_tanggungan->ViewCustomAttributes = "";

			// identitas
			$keu_tanggungan->identitas->ViewValue = $keu_tanggungan->identitas->CurrentValue;
			$keu_tanggungan->identitas->ViewCustomAttributes = "";

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->ViewValue = $keu_tanggungan->diskon_sosial->CurrentValue;
			$keu_tanggungan->diskon_sosial->ViewCustomAttributes = "";

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->ViewValue = $keu_tanggungan->diskon_waktu->CurrentValue;
			$keu_tanggungan->diskon_waktu->ViewCustomAttributes = "";

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->ViewValue = $keu_tanggungan->diskon_prestasi->CurrentValue;
			$keu_tanggungan->diskon_prestasi->ViewCustomAttributes = "";

			// diskon_internal
			$keu_tanggungan->diskon_internal->ViewValue = $keu_tanggungan->diskon_internal->CurrentValue;
			$keu_tanggungan->diskon_internal->ViewCustomAttributes = "";

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->ViewValue = $keu_tanggungan->diskon_lain_lain->CurrentValue;
			$keu_tanggungan->diskon_lain_lain->ViewCustomAttributes = "";

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->ViewValue = $keu_tanggungan->nilai_tanggungan->CurrentValue;
			$keu_tanggungan->nilai_tanggungan->ViewCustomAttributes = "";

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->ViewValue = $keu_tanggungan->tanggal_rencana_bayar->CurrentValue;
			$keu_tanggungan->tanggal_rencana_bayar->ViewValue = ew_FormatDateTime($keu_tanggungan->tanggal_rencana_bayar->ViewValue, 7);
			$keu_tanggungan->tanggal_rencana_bayar->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_tanggungan->kode_otomatis->LinkCustomAttributes = "";
			$keu_tanggungan->kode_otomatis->HrefValue = "";
			$keu_tanggungan->kode_otomatis->TooltipValue = "";

			// kode_otomatis_master_tanggungan
			$keu_tanggungan->kode_otomatis_master_tanggungan->LinkCustomAttributes = "";
			$keu_tanggungan->kode_otomatis_master_tanggungan->HrefValue = "";
			$keu_tanggungan->kode_otomatis_master_tanggungan->TooltipValue = "";

			// identitas
			$keu_tanggungan->identitas->LinkCustomAttributes = "";
			$keu_tanggungan->identitas->HrefValue = "";
			$keu_tanggungan->identitas->TooltipValue = "";

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_sosial->HrefValue = "";
			$keu_tanggungan->diskon_sosial->TooltipValue = "";

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_waktu->HrefValue = "";
			$keu_tanggungan->diskon_waktu->TooltipValue = "";

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_prestasi->HrefValue = "";
			$keu_tanggungan->diskon_prestasi->TooltipValue = "";

			// diskon_internal
			$keu_tanggungan->diskon_internal->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_internal->HrefValue = "";
			$keu_tanggungan->diskon_internal->TooltipValue = "";

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_lain_lain->HrefValue = "";
			$keu_tanggungan->diskon_lain_lain->TooltipValue = "";

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->LinkCustomAttributes = "";
			$keu_tanggungan->nilai_tanggungan->HrefValue = "";
			$keu_tanggungan->nilai_tanggungan->TooltipValue = "";

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->LinkCustomAttributes = "";
			$keu_tanggungan->tanggal_rencana_bayar->HrefValue = "";
			$keu_tanggungan->tanggal_rencana_bayar->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($keu_tanggungan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_tanggungan->Row_Rendered();
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

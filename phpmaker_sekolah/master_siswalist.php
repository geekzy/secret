<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "master_siswainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$master_siswa_list = new cmaster_siswa_list();
$Page =& $master_siswa_list;

// Page init
$master_siswa_list->Page_Init();

// Page main
$master_siswa_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($master_siswa->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var master_siswa_list = new ew_Page("master_siswa_list");

// page properties
master_siswa_list.PageID = "list"; // page ID
master_siswa_list.FormID = "fmaster_siswalist"; // form ID
var EW_PAGE_ID = master_siswa_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
master_siswa_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
master_siswa_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
master_siswa_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
master_siswa_list.ValidateRequired = false; // no JavaScript validation
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
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($master_siswa->Export == "") || (EW_EXPORT_MASTER_RECORD && $master_siswa->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$master_siswa_list->TotalRecs = $master_siswa->SelectRecordCount();
	} else {
		if ($master_siswa_list->Recordset = $master_siswa_list->LoadRecordset())
			$master_siswa_list->TotalRecs = $master_siswa_list->Recordset->RecordCount();
	}
	$master_siswa_list->StartRec = 1;
	if ($master_siswa_list->DisplayRecs <= 0 || ($master_siswa->Export <> "" && $master_siswa->ExportAll)) // Display all records
		$master_siswa_list->DisplayRecs = $master_siswa_list->TotalRecs;
	if (!($master_siswa->Export <> "" && $master_siswa->ExportAll))
		$master_siswa_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$master_siswa_list->Recordset = $master_siswa_list->LoadRecordset($master_siswa_list->StartRec-1, $master_siswa_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $master_siswa->TableCaption() ?>
&nbsp;&nbsp;<?php $master_siswa_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($master_siswa->Export == "" && $master_siswa->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(master_siswa_list);" style="text-decoration: none;"><img id="master_siswa_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="master_siswa_list_SearchPanel">
<form name="fmaster_siswalistsrch" id="fmaster_siswalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="master_siswa">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($master_siswa->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $master_siswa_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
	<a href="master_siswasrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($master_siswa->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($master_siswa->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($master_siswa->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $master_siswa_list->ShowPageHeader(); ?>
<?php
$master_siswa_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($master_siswa->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($master_siswa->CurrentAction <> "gridadd" && $master_siswa->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($master_siswa_list->Pager)) $master_siswa_list->Pager = new cNumericPager($master_siswa_list->StartRec, $master_siswa_list->DisplayRecs, $master_siswa_list->TotalRecs, $master_siswa_list->RecRange) ?>
<?php if ($master_siswa_list->Pager->RecordCount > 0) { ?>
	<?php if ($master_siswa_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $master_siswa_list->PageUrl() ?>start=<?php echo $master_siswa_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($master_siswa_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $master_siswa_list->PageUrl() ?>start=<?php echo $master_siswa_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($master_siswa_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $master_siswa_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($master_siswa_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $master_siswa_list->PageUrl() ?>start=<?php echo $master_siswa_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($master_siswa_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $master_siswa_list->PageUrl() ?>start=<?php echo $master_siswa_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($master_siswa_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $master_siswa_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $master_siswa_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $master_siswa_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($master_siswa_list->SearchWhere == "0=101") { ?>
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
<?php if ($master_siswa_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="master_siswa">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($master_siswa_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($master_siswa_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($master_siswa_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($master_siswa_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($master_siswa_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $master_siswa_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fmaster_siswalist" id="fmaster_siswalist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="master_siswa">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_master_siswa" class="ewGridMiddlePanel">
<?php if ($master_siswa_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $master_siswa->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$master_siswa_list->RenderListOptions();

// Render list options (header, left)
$master_siswa_list->ListOptions->Render("header", "left");
?>
<?php if ($master_siswa->no_absen->Visible) { // no_absen ?>
	<?php if ($master_siswa->SortUrl($master_siswa->no_absen) == "") { ?>
		<td><?php echo $master_siswa->no_absen->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->no_absen) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->no_absen->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->no_absen->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->no_absen->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_nis_nasional->Visible) { // A_nis_nasional ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_nis_nasional) == "") { ?>
		<td><?php echo $master_siswa->A_nis_nasional->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_nis_nasional) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_nis_nasional->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->A_nis_nasional->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_nis_nasional->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_nama_Lengkap->Visible) { // A_nama_Lengkap ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_nama_Lengkap) == "") { ?>
		<td><?php echo $master_siswa->A_nama_Lengkap->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_nama_Lengkap) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_nama_Lengkap->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->A_nama_Lengkap->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_nama_Lengkap->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_nama_panggilan->Visible) { // A_nama_panggilan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_nama_panggilan) == "") { ?>
		<td><?php echo $master_siswa->A_nama_panggilan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_nama_panggilan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_nama_panggilan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->A_nama_panggilan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_nama_panggilan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_jenis_kelamin->Visible) { // A_jenis_kelamin ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_jenis_kelamin) == "") { ?>
		<td><?php echo $master_siswa->A_jenis_kelamin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_jenis_kelamin) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_jenis_kelamin->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->A_jenis_kelamin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_jenis_kelamin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_tempat_lahir->Visible) { // A_tempat_lahir ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_tempat_lahir) == "") { ?>
		<td><?php echo $master_siswa->A_tempat_lahir->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_tempat_lahir) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_tempat_lahir->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->A_tempat_lahir->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_tempat_lahir->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_tanggal_lahir->Visible) { // A_tanggal_lahir ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_tanggal_lahir) == "") { ?>
		<td><?php echo $master_siswa->A_tanggal_lahir->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_tanggal_lahir) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_tanggal_lahir->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->A_tanggal_lahir->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_tanggal_lahir->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_agama->Visible) { // A_agama ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_agama) == "") { ?>
		<td><?php echo $master_siswa->A_agama->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_agama) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_agama->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->A_agama->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_agama->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_kewarganegaraan->Visible) { // A_kewarganegaraan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_kewarganegaraan) == "") { ?>
		<td><?php echo $master_siswa->A_kewarganegaraan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_kewarganegaraan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_kewarganegaraan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->A_kewarganegaraan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_kewarganegaraan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_anak_keberapa->Visible) { // A_anak_keberapa ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_anak_keberapa) == "") { ?>
		<td><?php echo $master_siswa->A_anak_keberapa->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_anak_keberapa) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_anak_keberapa->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->A_anak_keberapa->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_anak_keberapa->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_jumlah_saudara_kandung->Visible) { // A_jumlah_saudara_kandung ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_jumlah_saudara_kandung) == "") { ?>
		<td><?php echo $master_siswa->A_jumlah_saudara_kandung->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_jumlah_saudara_kandung) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_jumlah_saudara_kandung->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->A_jumlah_saudara_kandung->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_jumlah_saudara_kandung->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_jumlah_saudara_tiri->Visible) { // A_jumlah_saudara_tiri ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_jumlah_saudara_tiri) == "") { ?>
		<td><?php echo $master_siswa->A_jumlah_saudara_tiri->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_jumlah_saudara_tiri) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_jumlah_saudara_tiri->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->A_jumlah_saudara_tiri->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_jumlah_saudara_tiri->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_jumlah_saudara_angkat->Visible) { // A_jumlah_saudara_angkat ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_jumlah_saudara_angkat) == "") { ?>
		<td><?php echo $master_siswa->A_jumlah_saudara_angkat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_jumlah_saudara_angkat) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_jumlah_saudara_angkat->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->A_jumlah_saudara_angkat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_jumlah_saudara_angkat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_status_yatim->Visible) { // A_status_yatim ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_status_yatim) == "") { ?>
		<td><?php echo $master_siswa->A_status_yatim->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_status_yatim) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_status_yatim->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->A_status_yatim->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_status_yatim->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->A_bahasa->Visible) { // A_bahasa ?>
	<?php if ($master_siswa->SortUrl($master_siswa->A_bahasa) == "") { ?>
		<td><?php echo $master_siswa->A_bahasa->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->A_bahasa) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->A_bahasa->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->A_bahasa->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->A_bahasa->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->B_alamat->Visible) { // B_alamat ?>
	<?php if ($master_siswa->SortUrl($master_siswa->B_alamat) == "") { ?>
		<td><?php echo $master_siswa->B_alamat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->B_alamat) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->B_alamat->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->B_alamat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->B_alamat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->B_telepon_rumah->Visible) { // B_telepon_rumah ?>
	<?php if ($master_siswa->SortUrl($master_siswa->B_telepon_rumah) == "") { ?>
		<td><?php echo $master_siswa->B_telepon_rumah->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->B_telepon_rumah) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->B_telepon_rumah->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->B_telepon_rumah->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->B_telepon_rumah->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->B_tinggal->Visible) { // B_tinggal ?>
	<?php if ($master_siswa->SortUrl($master_siswa->B_tinggal) == "") { ?>
		<td><?php echo $master_siswa->B_tinggal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->B_tinggal) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->B_tinggal->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->B_tinggal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->B_tinggal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->B_jarak->Visible) { // B_jarak ?>
	<?php if ($master_siswa->SortUrl($master_siswa->B_jarak) == "") { ?>
		<td><?php echo $master_siswa->B_jarak->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->B_jarak) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->B_jarak->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->B_jarak->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->B_jarak->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->B_hp->Visible) { // B_hp ?>
	<?php if ($master_siswa->SortUrl($master_siswa->B_hp) == "") { ?>
		<td><?php echo $master_siswa->B_hp->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->B_hp) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->B_hp->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->B_hp->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->B_hp->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->C_golongan_darah->Visible) { // C_golongan_darah ?>
	<?php if ($master_siswa->SortUrl($master_siswa->C_golongan_darah) == "") { ?>
		<td><?php echo $master_siswa->C_golongan_darah->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->C_golongan_darah) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->C_golongan_darah->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->C_golongan_darah->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->C_golongan_darah->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->C_penyakit->Visible) { // C_penyakit ?>
	<?php if ($master_siswa->SortUrl($master_siswa->C_penyakit) == "") { ?>
		<td><?php echo $master_siswa->C_penyakit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->C_penyakit) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->C_penyakit->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->C_penyakit->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->C_penyakit->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->C_jasmani->Visible) { // C_jasmani ?>
	<?php if ($master_siswa->SortUrl($master_siswa->C_jasmani) == "") { ?>
		<td><?php echo $master_siswa->C_jasmani->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->C_jasmani) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->C_jasmani->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->C_jasmani->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->C_jasmani->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->C_tinggi->Visible) { // C_tinggi ?>
	<?php if ($master_siswa->SortUrl($master_siswa->C_tinggi) == "") { ?>
		<td><?php echo $master_siswa->C_tinggi->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->C_tinggi) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->C_tinggi->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->C_tinggi->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->C_tinggi->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->C_berat->Visible) { // C_berat ?>
	<?php if ($master_siswa->SortUrl($master_siswa->C_berat) == "") { ?>
		<td><?php echo $master_siswa->C_berat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->C_berat) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->C_berat->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->C_berat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->C_berat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_tamatan_dari->Visible) { // D_tamatan_dari ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_tamatan_dari) == "") { ?>
		<td><?php echo $master_siswa->D_tamatan_dari->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_tamatan_dari) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_tamatan_dari->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_tamatan_dari->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_tamatan_dari->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_sttb->Visible) { // D_sttb ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_sttb) == "") { ?>
		<td><?php echo $master_siswa->D_sttb->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_sttb) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_sttb->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_sttb->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_sttb->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_tanggal_sttb->Visible) { // D_tanggal_sttb ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_tanggal_sttb) == "") { ?>
		<td><?php echo $master_siswa->D_tanggal_sttb->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_tanggal_sttb) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_tanggal_sttb->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->D_tanggal_sttb->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_tanggal_sttb->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_danum->Visible) { // D_danum ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_danum) == "") { ?>
		<td><?php echo $master_siswa->D_danum->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_danum) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_danum->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_danum->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_danum->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_tanggal_danum->Visible) { // D_tanggal_danum ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_tanggal_danum) == "") { ?>
		<td><?php echo $master_siswa->D_tanggal_danum->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_tanggal_danum) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_tanggal_danum->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->D_tanggal_danum->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_tanggal_danum->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_lama_belajar->Visible) { // D_lama_belajar ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_lama_belajar) == "") { ?>
		<td><?php echo $master_siswa->D_lama_belajar->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_lama_belajar) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_lama_belajar->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->D_lama_belajar->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_lama_belajar->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_dari_sekolah->Visible) { // D_dari_sekolah ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_dari_sekolah) == "") { ?>
		<td><?php echo $master_siswa->D_dari_sekolah->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_dari_sekolah) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_dari_sekolah->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_dari_sekolah->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_dari_sekolah->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_alasan->Visible) { // D_alasan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_alasan) == "") { ?>
		<td><?php echo $master_siswa->D_alasan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_alasan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_alasan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_alasan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_alasan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_kelas->Visible) { // D_kelas ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_kelas) == "") { ?>
		<td><?php echo $master_siswa->D_kelas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_kelas) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_kelas->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_kelas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_kelas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_kelompok->Visible) { // D_kelompok ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_kelompok) == "") { ?>
		<td><?php echo $master_siswa->D_kelompok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_kelompok) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_kelompok->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_kelompok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_kelompok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_tanggal->Visible) { // D_tanggal ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_tanggal) == "") { ?>
		<td><?php echo $master_siswa->D_tanggal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_tanggal) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_tanggal->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->D_tanggal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_tanggal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_saat_ini_tingkat->Visible) { // D_saat_ini_tingkat ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_saat_ini_tingkat) == "") { ?>
		<td><?php echo $master_siswa->D_saat_ini_tingkat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_saat_ini_tingkat) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_saat_ini_tingkat->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->D_saat_ini_tingkat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_saat_ini_tingkat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_saat_ini_kelas->Visible) { // D_saat_ini_kelas ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_saat_ini_kelas) == "") { ?>
		<td><?php echo $master_siswa->D_saat_ini_kelas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_saat_ini_kelas) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_saat_ini_kelas->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_saat_ini_kelas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_saat_ini_kelas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_saat_ini_kelompok->Visible) { // D_saat_ini_kelompok ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_saat_ini_kelompok) == "") { ?>
		<td><?php echo $master_siswa->D_saat_ini_kelompok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_saat_ini_kelompok) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_saat_ini_kelompok->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_saat_ini_kelompok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_saat_ini_kelompok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_no_psb->Visible) { // D_no_psb ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_no_psb) == "") { ?>
		<td><?php echo $master_siswa->D_no_psb->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_no_psb) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_no_psb->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_no_psb->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_no_psb->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_nilai_danum_sd->Visible) { // D_nilai_danum_sd ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_nilai_danum_sd) == "") { ?>
		<td><?php echo $master_siswa->D_nilai_danum_sd->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_nilai_danum_sd) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_nilai_danum_sd->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->D_nilai_danum_sd->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_nilai_danum_sd->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_jumlah_pelajaran_danum->Visible) { // D_jumlah_pelajaran_danum ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_jumlah_pelajaran_danum) == "") { ?>
		<td><?php echo $master_siswa->D_jumlah_pelajaran_danum->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_jumlah_pelajaran_danum) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_jumlah_pelajaran_danum->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->D_jumlah_pelajaran_danum->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_jumlah_pelajaran_danum->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_nilai_ujian_psb->Visible) { // D_nilai_ujian_psb ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_nilai_ujian_psb) == "") { ?>
		<td><?php echo $master_siswa->D_nilai_ujian_psb->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_nilai_ujian_psb) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_nilai_ujian_psb->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->D_nilai_ujian_psb->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_nilai_ujian_psb->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_tahun_psb->Visible) { // D_tahun_psb ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_tahun_psb) == "") { ?>
		<td><?php echo $master_siswa->D_tahun_psb->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_tahun_psb) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_tahun_psb->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_tahun_psb->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_tahun_psb->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_diterima->Visible) { // D_diterima ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_diterima) == "") { ?>
		<td><?php echo $master_siswa->D_diterima->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_diterima) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_diterima->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_diterima->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_diterima->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_spp->Visible) { // D_spp ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_spp) == "") { ?>
		<td><?php echo $master_siswa->D_spp->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_spp) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_spp->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->D_spp->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_spp->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_spp_potongan->Visible) { // D_spp_potongan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_spp_potongan) == "") { ?>
		<td><?php echo $master_siswa->D_spp_potongan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_spp_potongan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_spp_potongan->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->D_spp_potongan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_spp_potongan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->D_status_lama_baru->Visible) { // D_status_lama_baru ?>
	<?php if ($master_siswa->SortUrl($master_siswa->D_status_lama_baru) == "") { ?>
		<td><?php echo $master_siswa->D_status_lama_baru->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->D_status_lama_baru) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->D_status_lama_baru->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->D_status_lama_baru->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->D_status_lama_baru->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_nama_ayah->Visible) { // E_nama_ayah ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_nama_ayah) == "") { ?>
		<td><?php echo $master_siswa->E_nama_ayah->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_nama_ayah) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_nama_ayah->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->E_nama_ayah->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_nama_ayah->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_tempat_lahir->Visible) { // E_tempat_lahir ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_tempat_lahir) == "") { ?>
		<td><?php echo $master_siswa->E_tempat_lahir->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_tempat_lahir) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_tempat_lahir->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->E_tempat_lahir->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_tempat_lahir->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_tanggal_lahir->Visible) { // E_tanggal_lahir ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_tanggal_lahir) == "") { ?>
		<td><?php echo $master_siswa->E_tanggal_lahir->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_tanggal_lahir) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_tanggal_lahir->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->E_tanggal_lahir->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_tanggal_lahir->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_agama->Visible) { // E_agama ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_agama) == "") { ?>
		<td><?php echo $master_siswa->E_agama->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_agama) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_agama->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->E_agama->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_agama->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_kewarganegaraan->Visible) { // E_kewarganegaraan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_kewarganegaraan) == "") { ?>
		<td><?php echo $master_siswa->E_kewarganegaraan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_kewarganegaraan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_kewarganegaraan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->E_kewarganegaraan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_kewarganegaraan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_pendidikan->Visible) { // E_pendidikan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_pendidikan) == "") { ?>
		<td><?php echo $master_siswa->E_pendidikan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_pendidikan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_pendidikan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->E_pendidikan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_pendidikan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_pekerjaan->Visible) { // E_pekerjaan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_pekerjaan) == "") { ?>
		<td><?php echo $master_siswa->E_pekerjaan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_pekerjaan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_pekerjaan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->E_pekerjaan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_pekerjaan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_pengeluaran->Visible) { // E_pengeluaran ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_pengeluaran) == "") { ?>
		<td><?php echo $master_siswa->E_pengeluaran->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_pengeluaran) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_pengeluaran->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->E_pengeluaran->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_pengeluaran->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_alamat->Visible) { // E_alamat ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_alamat) == "") { ?>
		<td><?php echo $master_siswa->E_alamat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_alamat) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_alamat->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->E_alamat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_alamat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_telepon->Visible) { // E_telepon ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_telepon) == "") { ?>
		<td><?php echo $master_siswa->E_telepon->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_telepon) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_telepon->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->E_telepon->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_telepon->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_hp->Visible) { // E_hp ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_hp) == "") { ?>
		<td><?php echo $master_siswa->E_hp->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_hp) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_hp->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->E_hp->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_hp->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->E_hidup->Visible) { // E_hidup ?>
	<?php if ($master_siswa->SortUrl($master_siswa->E_hidup) == "") { ?>
		<td><?php echo $master_siswa->E_hidup->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->E_hidup) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->E_hidup->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->E_hidup->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->E_hidup->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_nama_ibu->Visible) { // F_nama_ibu ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_nama_ibu) == "") { ?>
		<td><?php echo $master_siswa->F_nama_ibu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_nama_ibu) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_nama_ibu->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->F_nama_ibu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_nama_ibu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_tempat_lahir->Visible) { // F_tempat_lahir ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_tempat_lahir) == "") { ?>
		<td><?php echo $master_siswa->F_tempat_lahir->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_tempat_lahir) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_tempat_lahir->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->F_tempat_lahir->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_tempat_lahir->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_tanggal_lahir->Visible) { // F_tanggal_lahir ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_tanggal_lahir) == "") { ?>
		<td><?php echo $master_siswa->F_tanggal_lahir->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_tanggal_lahir) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_tanggal_lahir->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->F_tanggal_lahir->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_tanggal_lahir->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_agama->Visible) { // F_agama ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_agama) == "") { ?>
		<td><?php echo $master_siswa->F_agama->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_agama) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_agama->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->F_agama->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_agama->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_kewarganegaraan->Visible) { // F_kewarganegaraan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_kewarganegaraan) == "") { ?>
		<td><?php echo $master_siswa->F_kewarganegaraan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_kewarganegaraan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_kewarganegaraan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->F_kewarganegaraan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_kewarganegaraan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_pendidikan->Visible) { // F_pendidikan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_pendidikan) == "") { ?>
		<td><?php echo $master_siswa->F_pendidikan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_pendidikan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_pendidikan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->F_pendidikan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_pendidikan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_pekerjaan->Visible) { // F_pekerjaan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_pekerjaan) == "") { ?>
		<td><?php echo $master_siswa->F_pekerjaan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_pekerjaan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_pekerjaan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->F_pekerjaan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_pekerjaan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_pengeluaran->Visible) { // F_pengeluaran ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_pengeluaran) == "") { ?>
		<td><?php echo $master_siswa->F_pengeluaran->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_pengeluaran) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_pengeluaran->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->F_pengeluaran->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_pengeluaran->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_alamat->Visible) { // F_alamat ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_alamat) == "") { ?>
		<td><?php echo $master_siswa->F_alamat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_alamat) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_alamat->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->F_alamat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_alamat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_telepon->Visible) { // F_telepon ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_telepon) == "") { ?>
		<td><?php echo $master_siswa->F_telepon->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_telepon) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_telepon->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->F_telepon->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_telepon->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_hp->Visible) { // F_hp ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_hp) == "") { ?>
		<td><?php echo $master_siswa->F_hp->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_hp) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_hp->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->F_hp->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_hp->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->F_hidup->Visible) { // F_hidup ?>
	<?php if ($master_siswa->SortUrl($master_siswa->F_hidup) == "") { ?>
		<td><?php echo $master_siswa->F_hidup->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->F_hidup) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->F_hidup->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->F_hidup->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->F_hidup->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_nama_wali->Visible) { // G_nama_wali ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_nama_wali) == "") { ?>
		<td><?php echo $master_siswa->G_nama_wali->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_nama_wali) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_nama_wali->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->G_nama_wali->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_nama_wali->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_tempat_lahir->Visible) { // G_tempat_lahir ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_tempat_lahir) == "") { ?>
		<td><?php echo $master_siswa->G_tempat_lahir->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_tempat_lahir) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_tempat_lahir->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->G_tempat_lahir->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_tempat_lahir->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_tanggal_lahir->Visible) { // G_tanggal_lahir ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_tanggal_lahir) == "") { ?>
		<td><?php echo $master_siswa->G_tanggal_lahir->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_tanggal_lahir) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_tanggal_lahir->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->G_tanggal_lahir->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_tanggal_lahir->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_agama->Visible) { // G_agama ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_agama) == "") { ?>
		<td><?php echo $master_siswa->G_agama->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_agama) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_agama->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->G_agama->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_agama->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_kewarganegaraan->Visible) { // G_kewarganegaraan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_kewarganegaraan) == "") { ?>
		<td><?php echo $master_siswa->G_kewarganegaraan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_kewarganegaraan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_kewarganegaraan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->G_kewarganegaraan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_kewarganegaraan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_pendidikan->Visible) { // G_pendidikan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_pendidikan) == "") { ?>
		<td><?php echo $master_siswa->G_pendidikan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_pendidikan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_pendidikan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->G_pendidikan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_pendidikan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_pekerjaan->Visible) { // G_pekerjaan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_pekerjaan) == "") { ?>
		<td><?php echo $master_siswa->G_pekerjaan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_pekerjaan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_pekerjaan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->G_pekerjaan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_pekerjaan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_pengeluaran->Visible) { // G_pengeluaran ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_pengeluaran) == "") { ?>
		<td><?php echo $master_siswa->G_pengeluaran->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_pengeluaran) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_pengeluaran->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->G_pengeluaran->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_pengeluaran->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_alamat->Visible) { // G_alamat ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_alamat) == "") { ?>
		<td><?php echo $master_siswa->G_alamat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_alamat) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_alamat->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->G_alamat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_alamat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_telepon->Visible) { // G_telepon ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_telepon) == "") { ?>
		<td><?php echo $master_siswa->G_telepon->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_telepon) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_telepon->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->G_telepon->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_telepon->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->G_hp->Visible) { // G_hp ?>
	<?php if ($master_siswa->SortUrl($master_siswa->G_hp) == "") { ?>
		<td><?php echo $master_siswa->G_hp->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->G_hp) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->G_hp->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->G_hp->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->G_hp->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->H_kesenian->Visible) { // H_kesenian ?>
	<?php if ($master_siswa->SortUrl($master_siswa->H_kesenian) == "") { ?>
		<td><?php echo $master_siswa->H_kesenian->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->H_kesenian) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->H_kesenian->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->H_kesenian->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->H_kesenian->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->H_olahraga->Visible) { // H_olahraga ?>
	<?php if ($master_siswa->SortUrl($master_siswa->H_olahraga) == "") { ?>
		<td><?php echo $master_siswa->H_olahraga->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->H_olahraga) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->H_olahraga->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->H_olahraga->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->H_olahraga->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->H_kemasyarakatan->Visible) { // H_kemasyarakatan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->H_kemasyarakatan) == "") { ?>
		<td><?php echo $master_siswa->H_kemasyarakatan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->H_kemasyarakatan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->H_kemasyarakatan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->H_kemasyarakatan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->H_kemasyarakatan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->H_lainlain->Visible) { // H_lainlain ?>
	<?php if ($master_siswa->SortUrl($master_siswa->H_lainlain) == "") { ?>
		<td><?php echo $master_siswa->H_lainlain->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->H_lainlain) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->H_lainlain->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->H_lainlain->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->H_lainlain->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_tanggal_meninggalkan->Visible) { // I_tanggal_meninggalkan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_tanggal_meninggalkan) == "") { ?>
		<td><?php echo $master_siswa->I_tanggal_meninggalkan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_tanggal_meninggalkan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_tanggal_meninggalkan->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->I_tanggal_meninggalkan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_tanggal_meninggalkan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_alasan->Visible) { // I_alasan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_alasan) == "") { ?>
		<td><?php echo $master_siswa->I_alasan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_alasan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_alasan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_alasan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_alasan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_tanggal_lulus->Visible) { // I_tanggal_lulus ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_tanggal_lulus) == "") { ?>
		<td><?php echo $master_siswa->I_tanggal_lulus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_tanggal_lulus) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_tanggal_lulus->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->I_tanggal_lulus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_tanggal_lulus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_sttb->Visible) { // I_sttb ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_sttb) == "") { ?>
		<td><?php echo $master_siswa->I_sttb->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_sttb) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_sttb->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_sttb->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_sttb->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_danum->Visible) { // I_danum ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_danum) == "") { ?>
		<td><?php echo $master_siswa->I_danum->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_danum) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_danum->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_danum->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_danum->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_nilai_danum_smp->Visible) { // I_nilai_danum_smp ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_nilai_danum_smp) == "") { ?>
		<td><?php echo $master_siswa->I_nilai_danum_smp->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_nilai_danum_smp) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_nilai_danum_smp->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->I_nilai_danum_smp->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_nilai_danum_smp->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_tahun1->Visible) { // I_tahun1 ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_tahun1) == "") { ?>
		<td><?php echo $master_siswa->I_tahun1->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_tahun1) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_tahun1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_tahun1->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_tahun1->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_tahun2->Visible) { // I_tahun2 ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_tahun2) == "") { ?>
		<td><?php echo $master_siswa->I_tahun2->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_tahun2) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_tahun2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_tahun2->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_tahun2->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_tahun3->Visible) { // I_tahun3 ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_tahun3) == "") { ?>
		<td><?php echo $master_siswa->I_tahun3->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_tahun3) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_tahun3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_tahun3->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_tahun3->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_tk1->Visible) { // I_tk1 ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_tk1) == "") { ?>
		<td><?php echo $master_siswa->I_tk1->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_tk1) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_tk1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_tk1->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_tk1->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_tk2->Visible) { // I_tk2 ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_tk2) == "") { ?>
		<td><?php echo $master_siswa->I_tk2->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_tk2) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_tk2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_tk2->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_tk2->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_tk3->Visible) { // I_tk3 ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_tk3) == "") { ?>
		<td><?php echo $master_siswa->I_tk3->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_tk3) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_tk3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_tk3->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_tk3->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_dari1->Visible) { // I_dari1 ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_dari1) == "") { ?>
		<td><?php echo $master_siswa->I_dari1->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_dari1) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_dari1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_dari1->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_dari1->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_dari2->Visible) { // I_dari2 ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_dari2) == "") { ?>
		<td><?php echo $master_siswa->I_dari2->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_dari2) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_dari2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_dari2->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_dari2->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->I_dari3->Visible) { // I_dari3 ?>
	<?php if ($master_siswa->SortUrl($master_siswa->I_dari3) == "") { ?>
		<td><?php echo $master_siswa->I_dari3->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->I_dari3) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->I_dari3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->I_dari3->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->I_dari3->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->J_melanjutkan->Visible) { // J_melanjutkan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->J_melanjutkan) == "") { ?>
		<td><?php echo $master_siswa->J_melanjutkan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->J_melanjutkan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->J_melanjutkan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->J_melanjutkan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->J_melanjutkan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->J_tanggal_bekerja->Visible) { // J_tanggal_bekerja ?>
	<?php if ($master_siswa->SortUrl($master_siswa->J_tanggal_bekerja) == "") { ?>
		<td><?php echo $master_siswa->J_tanggal_bekerja->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->J_tanggal_bekerja) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->J_tanggal_bekerja->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->J_tanggal_bekerja->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->J_tanggal_bekerja->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->J_nama_perusahaan->Visible) { // J_nama_perusahaan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->J_nama_perusahaan) == "") { ?>
		<td><?php echo $master_siswa->J_nama_perusahaan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->J_nama_perusahaan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->J_nama_perusahaan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($master_siswa->J_nama_perusahaan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->J_nama_perusahaan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->J_penghasilan->Visible) { // J_penghasilan ?>
	<?php if ($master_siswa->SortUrl($master_siswa->J_penghasilan) == "") { ?>
		<td><?php echo $master_siswa->J_penghasilan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->J_penghasilan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->J_penghasilan->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->J_penghasilan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->J_penghasilan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($master_siswa->SortUrl($master_siswa->kode_otomatis) == "") { ?>
		<td><?php echo $master_siswa->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->kode_otomatis) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($master_siswa->apakah_valid->Visible) { // apakah_valid ?>
	<?php if ($master_siswa->SortUrl($master_siswa->apakah_valid) == "") { ?>
		<td><?php echo $master_siswa->apakah_valid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $master_siswa->SortUrl($master_siswa->apakah_valid) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $master_siswa->apakah_valid->FldCaption() ?></td><td style="width: 10px;"><?php if ($master_siswa->apakah_valid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($master_siswa->apakah_valid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$master_siswa_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($master_siswa->ExportAll && $master_siswa->Export <> "") {
	$master_siswa_list->StopRec = $master_siswa_list->TotalRecs;
} else {

	// Set the last record to display
	if ($master_siswa_list->TotalRecs > $master_siswa_list->StartRec + $master_siswa_list->DisplayRecs - 1)
		$master_siswa_list->StopRec = $master_siswa_list->StartRec + $master_siswa_list->DisplayRecs - 1;
	else
		$master_siswa_list->StopRec = $master_siswa_list->TotalRecs;
}
$master_siswa_list->RecCnt = $master_siswa_list->StartRec - 1;
if ($master_siswa_list->Recordset && !$master_siswa_list->Recordset->EOF) {
	$master_siswa_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $master_siswa_list->StartRec > 1)
		$master_siswa_list->Recordset->Move($master_siswa_list->StartRec - 1);
} elseif (!$master_siswa->AllowAddDeleteRow && $master_siswa_list->StopRec == 0) {
	$master_siswa_list->StopRec = $master_siswa->GridAddRowCount;
}

// Initialize aggregate
$master_siswa->RowType = EW_ROWTYPE_AGGREGATEINIT;
$master_siswa->ResetAttrs();
$master_siswa_list->RenderRow();
$master_siswa_list->RowCnt = 0;
while ($master_siswa_list->RecCnt < $master_siswa_list->StopRec) {
	$master_siswa_list->RecCnt++;
	if (intval($master_siswa_list->RecCnt) >= intval($master_siswa_list->StartRec)) {
		$master_siswa_list->RowCnt++;

		// Set up key count
		$master_siswa_list->KeyCount = $master_siswa_list->RowIndex;

		// Init row class and style
		$master_siswa->ResetAttrs();
		$master_siswa->CssClass = "";
		if ($master_siswa->CurrentAction == "gridadd") {
		} else {
			$master_siswa_list->LoadRowValues($master_siswa_list->Recordset); // Load row values
		}
		$master_siswa->RowType = EW_ROWTYPE_VIEW; // Render view
		$master_siswa->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$master_siswa_list->RenderRow();

		// Render list options
		$master_siswa_list->RenderListOptions();
?>
	<tr<?php echo $master_siswa->RowAttributes() ?>>
<?php

// Render list options (body, left)
$master_siswa_list->ListOptions->Render("body", "left");
?>
	<?php if ($master_siswa->no_absen->Visible) { // no_absen ?>
		<td<?php echo $master_siswa->no_absen->CellAttributes() ?>>
<div<?php echo $master_siswa->no_absen->ViewAttributes() ?>><?php echo $master_siswa->no_absen->ListViewValue() ?></div>
<a name="<?php echo $master_siswa_list->PageObjName . "_row_" . $master_siswa_list->RowCnt ?>" id="<?php echo $master_siswa_list->PageObjName . "_row_" . $master_siswa_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($master_siswa->A_nis_nasional->Visible) { // A_nis_nasional ?>
		<td<?php echo $master_siswa->A_nis_nasional->CellAttributes() ?>>
<div<?php echo $master_siswa->A_nis_nasional->ViewAttributes() ?>><?php echo $master_siswa->A_nis_nasional->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_nama_Lengkap->Visible) { // A_nama_Lengkap ?>
		<td<?php echo $master_siswa->A_nama_Lengkap->CellAttributes() ?>>
<div<?php echo $master_siswa->A_nama_Lengkap->ViewAttributes() ?>><?php echo $master_siswa->A_nama_Lengkap->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_nama_panggilan->Visible) { // A_nama_panggilan ?>
		<td<?php echo $master_siswa->A_nama_panggilan->CellAttributes() ?>>
<div<?php echo $master_siswa->A_nama_panggilan->ViewAttributes() ?>><?php echo $master_siswa->A_nama_panggilan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_jenis_kelamin->Visible) { // A_jenis_kelamin ?>
		<td<?php echo $master_siswa->A_jenis_kelamin->CellAttributes() ?>>
<div<?php echo $master_siswa->A_jenis_kelamin->ViewAttributes() ?>><?php echo $master_siswa->A_jenis_kelamin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_tempat_lahir->Visible) { // A_tempat_lahir ?>
		<td<?php echo $master_siswa->A_tempat_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->A_tempat_lahir->ViewAttributes() ?>><?php echo $master_siswa->A_tempat_lahir->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_tanggal_lahir->Visible) { // A_tanggal_lahir ?>
		<td<?php echo $master_siswa->A_tanggal_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->A_tanggal_lahir->ViewAttributes() ?>><?php echo $master_siswa->A_tanggal_lahir->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_agama->Visible) { // A_agama ?>
		<td<?php echo $master_siswa->A_agama->CellAttributes() ?>>
<div<?php echo $master_siswa->A_agama->ViewAttributes() ?>><?php echo $master_siswa->A_agama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_kewarganegaraan->Visible) { // A_kewarganegaraan ?>
		<td<?php echo $master_siswa->A_kewarganegaraan->CellAttributes() ?>>
<div<?php echo $master_siswa->A_kewarganegaraan->ViewAttributes() ?>><?php echo $master_siswa->A_kewarganegaraan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_anak_keberapa->Visible) { // A_anak_keberapa ?>
		<td<?php echo $master_siswa->A_anak_keberapa->CellAttributes() ?>>
<div<?php echo $master_siswa->A_anak_keberapa->ViewAttributes() ?>><?php echo $master_siswa->A_anak_keberapa->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_jumlah_saudara_kandung->Visible) { // A_jumlah_saudara_kandung ?>
		<td<?php echo $master_siswa->A_jumlah_saudara_kandung->CellAttributes() ?>>
<div<?php echo $master_siswa->A_jumlah_saudara_kandung->ViewAttributes() ?>><?php echo $master_siswa->A_jumlah_saudara_kandung->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_jumlah_saudara_tiri->Visible) { // A_jumlah_saudara_tiri ?>
		<td<?php echo $master_siswa->A_jumlah_saudara_tiri->CellAttributes() ?>>
<div<?php echo $master_siswa->A_jumlah_saudara_tiri->ViewAttributes() ?>><?php echo $master_siswa->A_jumlah_saudara_tiri->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_jumlah_saudara_angkat->Visible) { // A_jumlah_saudara_angkat ?>
		<td<?php echo $master_siswa->A_jumlah_saudara_angkat->CellAttributes() ?>>
<div<?php echo $master_siswa->A_jumlah_saudara_angkat->ViewAttributes() ?>><?php echo $master_siswa->A_jumlah_saudara_angkat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_status_yatim->Visible) { // A_status_yatim ?>
		<td<?php echo $master_siswa->A_status_yatim->CellAttributes() ?>>
<div<?php echo $master_siswa->A_status_yatim->ViewAttributes() ?>><?php echo $master_siswa->A_status_yatim->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->A_bahasa->Visible) { // A_bahasa ?>
		<td<?php echo $master_siswa->A_bahasa->CellAttributes() ?>>
<div<?php echo $master_siswa->A_bahasa->ViewAttributes() ?>><?php echo $master_siswa->A_bahasa->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->B_alamat->Visible) { // B_alamat ?>
		<td<?php echo $master_siswa->B_alamat->CellAttributes() ?>>
<div<?php echo $master_siswa->B_alamat->ViewAttributes() ?>><?php echo $master_siswa->B_alamat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->B_telepon_rumah->Visible) { // B_telepon_rumah ?>
		<td<?php echo $master_siswa->B_telepon_rumah->CellAttributes() ?>>
<div<?php echo $master_siswa->B_telepon_rumah->ViewAttributes() ?>><?php echo $master_siswa->B_telepon_rumah->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->B_tinggal->Visible) { // B_tinggal ?>
		<td<?php echo $master_siswa->B_tinggal->CellAttributes() ?>>
<div<?php echo $master_siswa->B_tinggal->ViewAttributes() ?>><?php echo $master_siswa->B_tinggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->B_jarak->Visible) { // B_jarak ?>
		<td<?php echo $master_siswa->B_jarak->CellAttributes() ?>>
<div<?php echo $master_siswa->B_jarak->ViewAttributes() ?>><?php echo $master_siswa->B_jarak->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->B_hp->Visible) { // B_hp ?>
		<td<?php echo $master_siswa->B_hp->CellAttributes() ?>>
<div<?php echo $master_siswa->B_hp->ViewAttributes() ?>><?php echo $master_siswa->B_hp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->C_golongan_darah->Visible) { // C_golongan_darah ?>
		<td<?php echo $master_siswa->C_golongan_darah->CellAttributes() ?>>
<div<?php echo $master_siswa->C_golongan_darah->ViewAttributes() ?>><?php echo $master_siswa->C_golongan_darah->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->C_penyakit->Visible) { // C_penyakit ?>
		<td<?php echo $master_siswa->C_penyakit->CellAttributes() ?>>
<div<?php echo $master_siswa->C_penyakit->ViewAttributes() ?>><?php echo $master_siswa->C_penyakit->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->C_jasmani->Visible) { // C_jasmani ?>
		<td<?php echo $master_siswa->C_jasmani->CellAttributes() ?>>
<div<?php echo $master_siswa->C_jasmani->ViewAttributes() ?>><?php echo $master_siswa->C_jasmani->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->C_tinggi->Visible) { // C_tinggi ?>
		<td<?php echo $master_siswa->C_tinggi->CellAttributes() ?>>
<div<?php echo $master_siswa->C_tinggi->ViewAttributes() ?>><?php echo $master_siswa->C_tinggi->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->C_berat->Visible) { // C_berat ?>
		<td<?php echo $master_siswa->C_berat->CellAttributes() ?>>
<div<?php echo $master_siswa->C_berat->ViewAttributes() ?>><?php echo $master_siswa->C_berat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_tamatan_dari->Visible) { // D_tamatan_dari ?>
		<td<?php echo $master_siswa->D_tamatan_dari->CellAttributes() ?>>
<div<?php echo $master_siswa->D_tamatan_dari->ViewAttributes() ?>><?php echo $master_siswa->D_tamatan_dari->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_sttb->Visible) { // D_sttb ?>
		<td<?php echo $master_siswa->D_sttb->CellAttributes() ?>>
<div<?php echo $master_siswa->D_sttb->ViewAttributes() ?>><?php echo $master_siswa->D_sttb->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_tanggal_sttb->Visible) { // D_tanggal_sttb ?>
		<td<?php echo $master_siswa->D_tanggal_sttb->CellAttributes() ?>>
<div<?php echo $master_siswa->D_tanggal_sttb->ViewAttributes() ?>><?php echo $master_siswa->D_tanggal_sttb->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_danum->Visible) { // D_danum ?>
		<td<?php echo $master_siswa->D_danum->CellAttributes() ?>>
<div<?php echo $master_siswa->D_danum->ViewAttributes() ?>><?php echo $master_siswa->D_danum->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_tanggal_danum->Visible) { // D_tanggal_danum ?>
		<td<?php echo $master_siswa->D_tanggal_danum->CellAttributes() ?>>
<div<?php echo $master_siswa->D_tanggal_danum->ViewAttributes() ?>><?php echo $master_siswa->D_tanggal_danum->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_lama_belajar->Visible) { // D_lama_belajar ?>
		<td<?php echo $master_siswa->D_lama_belajar->CellAttributes() ?>>
<div<?php echo $master_siswa->D_lama_belajar->ViewAttributes() ?>><?php echo $master_siswa->D_lama_belajar->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_dari_sekolah->Visible) { // D_dari_sekolah ?>
		<td<?php echo $master_siswa->D_dari_sekolah->CellAttributes() ?>>
<div<?php echo $master_siswa->D_dari_sekolah->ViewAttributes() ?>><?php echo $master_siswa->D_dari_sekolah->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_alasan->Visible) { // D_alasan ?>
		<td<?php echo $master_siswa->D_alasan->CellAttributes() ?>>
<div<?php echo $master_siswa->D_alasan->ViewAttributes() ?>><?php echo $master_siswa->D_alasan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_kelas->Visible) { // D_kelas ?>
		<td<?php echo $master_siswa->D_kelas->CellAttributes() ?>>
<div<?php echo $master_siswa->D_kelas->ViewAttributes() ?>><?php echo $master_siswa->D_kelas->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_kelompok->Visible) { // D_kelompok ?>
		<td<?php echo $master_siswa->D_kelompok->CellAttributes() ?>>
<div<?php echo $master_siswa->D_kelompok->ViewAttributes() ?>><?php echo $master_siswa->D_kelompok->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_tanggal->Visible) { // D_tanggal ?>
		<td<?php echo $master_siswa->D_tanggal->CellAttributes() ?>>
<div<?php echo $master_siswa->D_tanggal->ViewAttributes() ?>><?php echo $master_siswa->D_tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_saat_ini_tingkat->Visible) { // D_saat_ini_tingkat ?>
		<td<?php echo $master_siswa->D_saat_ini_tingkat->CellAttributes() ?>>
<div<?php echo $master_siswa->D_saat_ini_tingkat->ViewAttributes() ?>><?php echo $master_siswa->D_saat_ini_tingkat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_saat_ini_kelas->Visible) { // D_saat_ini_kelas ?>
		<td<?php echo $master_siswa->D_saat_ini_kelas->CellAttributes() ?>>
<div<?php echo $master_siswa->D_saat_ini_kelas->ViewAttributes() ?>><?php echo $master_siswa->D_saat_ini_kelas->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_saat_ini_kelompok->Visible) { // D_saat_ini_kelompok ?>
		<td<?php echo $master_siswa->D_saat_ini_kelompok->CellAttributes() ?>>
<div<?php echo $master_siswa->D_saat_ini_kelompok->ViewAttributes() ?>><?php echo $master_siswa->D_saat_ini_kelompok->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_no_psb->Visible) { // D_no_psb ?>
		<td<?php echo $master_siswa->D_no_psb->CellAttributes() ?>>
<div<?php echo $master_siswa->D_no_psb->ViewAttributes() ?>><?php echo $master_siswa->D_no_psb->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_nilai_danum_sd->Visible) { // D_nilai_danum_sd ?>
		<td<?php echo $master_siswa->D_nilai_danum_sd->CellAttributes() ?>>
<div<?php echo $master_siswa->D_nilai_danum_sd->ViewAttributes() ?>><?php echo $master_siswa->D_nilai_danum_sd->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_jumlah_pelajaran_danum->Visible) { // D_jumlah_pelajaran_danum ?>
		<td<?php echo $master_siswa->D_jumlah_pelajaran_danum->CellAttributes() ?>>
<div<?php echo $master_siswa->D_jumlah_pelajaran_danum->ViewAttributes() ?>><?php echo $master_siswa->D_jumlah_pelajaran_danum->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_nilai_ujian_psb->Visible) { // D_nilai_ujian_psb ?>
		<td<?php echo $master_siswa->D_nilai_ujian_psb->CellAttributes() ?>>
<div<?php echo $master_siswa->D_nilai_ujian_psb->ViewAttributes() ?>><?php echo $master_siswa->D_nilai_ujian_psb->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_tahun_psb->Visible) { // D_tahun_psb ?>
		<td<?php echo $master_siswa->D_tahun_psb->CellAttributes() ?>>
<div<?php echo $master_siswa->D_tahun_psb->ViewAttributes() ?>><?php echo $master_siswa->D_tahun_psb->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_diterima->Visible) { // D_diterima ?>
		<td<?php echo $master_siswa->D_diterima->CellAttributes() ?>>
<div<?php echo $master_siswa->D_diterima->ViewAttributes() ?>><?php echo $master_siswa->D_diterima->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_spp->Visible) { // D_spp ?>
		<td<?php echo $master_siswa->D_spp->CellAttributes() ?>>
<div<?php echo $master_siswa->D_spp->ViewAttributes() ?>><?php echo $master_siswa->D_spp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_spp_potongan->Visible) { // D_spp_potongan ?>
		<td<?php echo $master_siswa->D_spp_potongan->CellAttributes() ?>>
<div<?php echo $master_siswa->D_spp_potongan->ViewAttributes() ?>><?php echo $master_siswa->D_spp_potongan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->D_status_lama_baru->Visible) { // D_status_lama_baru ?>
		<td<?php echo $master_siswa->D_status_lama_baru->CellAttributes() ?>>
<div<?php echo $master_siswa->D_status_lama_baru->ViewAttributes() ?>><?php echo $master_siswa->D_status_lama_baru->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_nama_ayah->Visible) { // E_nama_ayah ?>
		<td<?php echo $master_siswa->E_nama_ayah->CellAttributes() ?>>
<div<?php echo $master_siswa->E_nama_ayah->ViewAttributes() ?>><?php echo $master_siswa->E_nama_ayah->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_tempat_lahir->Visible) { // E_tempat_lahir ?>
		<td<?php echo $master_siswa->E_tempat_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->E_tempat_lahir->ViewAttributes() ?>><?php echo $master_siswa->E_tempat_lahir->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_tanggal_lahir->Visible) { // E_tanggal_lahir ?>
		<td<?php echo $master_siswa->E_tanggal_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->E_tanggal_lahir->ViewAttributes() ?>><?php echo $master_siswa->E_tanggal_lahir->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_agama->Visible) { // E_agama ?>
		<td<?php echo $master_siswa->E_agama->CellAttributes() ?>>
<div<?php echo $master_siswa->E_agama->ViewAttributes() ?>><?php echo $master_siswa->E_agama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_kewarganegaraan->Visible) { // E_kewarganegaraan ?>
		<td<?php echo $master_siswa->E_kewarganegaraan->CellAttributes() ?>>
<div<?php echo $master_siswa->E_kewarganegaraan->ViewAttributes() ?>><?php echo $master_siswa->E_kewarganegaraan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_pendidikan->Visible) { // E_pendidikan ?>
		<td<?php echo $master_siswa->E_pendidikan->CellAttributes() ?>>
<div<?php echo $master_siswa->E_pendidikan->ViewAttributes() ?>><?php echo $master_siswa->E_pendidikan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_pekerjaan->Visible) { // E_pekerjaan ?>
		<td<?php echo $master_siswa->E_pekerjaan->CellAttributes() ?>>
<div<?php echo $master_siswa->E_pekerjaan->ViewAttributes() ?>><?php echo $master_siswa->E_pekerjaan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_pengeluaran->Visible) { // E_pengeluaran ?>
		<td<?php echo $master_siswa->E_pengeluaran->CellAttributes() ?>>
<div<?php echo $master_siswa->E_pengeluaran->ViewAttributes() ?>><?php echo $master_siswa->E_pengeluaran->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_alamat->Visible) { // E_alamat ?>
		<td<?php echo $master_siswa->E_alamat->CellAttributes() ?>>
<div<?php echo $master_siswa->E_alamat->ViewAttributes() ?>><?php echo $master_siswa->E_alamat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_telepon->Visible) { // E_telepon ?>
		<td<?php echo $master_siswa->E_telepon->CellAttributes() ?>>
<div<?php echo $master_siswa->E_telepon->ViewAttributes() ?>><?php echo $master_siswa->E_telepon->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_hp->Visible) { // E_hp ?>
		<td<?php echo $master_siswa->E_hp->CellAttributes() ?>>
<div<?php echo $master_siswa->E_hp->ViewAttributes() ?>><?php echo $master_siswa->E_hp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->E_hidup->Visible) { // E_hidup ?>
		<td<?php echo $master_siswa->E_hidup->CellAttributes() ?>>
<div<?php echo $master_siswa->E_hidup->ViewAttributes() ?>><?php echo $master_siswa->E_hidup->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_nama_ibu->Visible) { // F_nama_ibu ?>
		<td<?php echo $master_siswa->F_nama_ibu->CellAttributes() ?>>
<div<?php echo $master_siswa->F_nama_ibu->ViewAttributes() ?>><?php echo $master_siswa->F_nama_ibu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_tempat_lahir->Visible) { // F_tempat_lahir ?>
		<td<?php echo $master_siswa->F_tempat_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->F_tempat_lahir->ViewAttributes() ?>><?php echo $master_siswa->F_tempat_lahir->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_tanggal_lahir->Visible) { // F_tanggal_lahir ?>
		<td<?php echo $master_siswa->F_tanggal_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->F_tanggal_lahir->ViewAttributes() ?>><?php echo $master_siswa->F_tanggal_lahir->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_agama->Visible) { // F_agama ?>
		<td<?php echo $master_siswa->F_agama->CellAttributes() ?>>
<div<?php echo $master_siswa->F_agama->ViewAttributes() ?>><?php echo $master_siswa->F_agama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_kewarganegaraan->Visible) { // F_kewarganegaraan ?>
		<td<?php echo $master_siswa->F_kewarganegaraan->CellAttributes() ?>>
<div<?php echo $master_siswa->F_kewarganegaraan->ViewAttributes() ?>><?php echo $master_siswa->F_kewarganegaraan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_pendidikan->Visible) { // F_pendidikan ?>
		<td<?php echo $master_siswa->F_pendidikan->CellAttributes() ?>>
<div<?php echo $master_siswa->F_pendidikan->ViewAttributes() ?>><?php echo $master_siswa->F_pendidikan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_pekerjaan->Visible) { // F_pekerjaan ?>
		<td<?php echo $master_siswa->F_pekerjaan->CellAttributes() ?>>
<div<?php echo $master_siswa->F_pekerjaan->ViewAttributes() ?>><?php echo $master_siswa->F_pekerjaan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_pengeluaran->Visible) { // F_pengeluaran ?>
		<td<?php echo $master_siswa->F_pengeluaran->CellAttributes() ?>>
<div<?php echo $master_siswa->F_pengeluaran->ViewAttributes() ?>><?php echo $master_siswa->F_pengeluaran->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_alamat->Visible) { // F_alamat ?>
		<td<?php echo $master_siswa->F_alamat->CellAttributes() ?>>
<div<?php echo $master_siswa->F_alamat->ViewAttributes() ?>><?php echo $master_siswa->F_alamat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_telepon->Visible) { // F_telepon ?>
		<td<?php echo $master_siswa->F_telepon->CellAttributes() ?>>
<div<?php echo $master_siswa->F_telepon->ViewAttributes() ?>><?php echo $master_siswa->F_telepon->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_hp->Visible) { // F_hp ?>
		<td<?php echo $master_siswa->F_hp->CellAttributes() ?>>
<div<?php echo $master_siswa->F_hp->ViewAttributes() ?>><?php echo $master_siswa->F_hp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->F_hidup->Visible) { // F_hidup ?>
		<td<?php echo $master_siswa->F_hidup->CellAttributes() ?>>
<div<?php echo $master_siswa->F_hidup->ViewAttributes() ?>><?php echo $master_siswa->F_hidup->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_nama_wali->Visible) { // G_nama_wali ?>
		<td<?php echo $master_siswa->G_nama_wali->CellAttributes() ?>>
<div<?php echo $master_siswa->G_nama_wali->ViewAttributes() ?>><?php echo $master_siswa->G_nama_wali->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_tempat_lahir->Visible) { // G_tempat_lahir ?>
		<td<?php echo $master_siswa->G_tempat_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->G_tempat_lahir->ViewAttributes() ?>><?php echo $master_siswa->G_tempat_lahir->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_tanggal_lahir->Visible) { // G_tanggal_lahir ?>
		<td<?php echo $master_siswa->G_tanggal_lahir->CellAttributes() ?>>
<div<?php echo $master_siswa->G_tanggal_lahir->ViewAttributes() ?>><?php echo $master_siswa->G_tanggal_lahir->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_agama->Visible) { // G_agama ?>
		<td<?php echo $master_siswa->G_agama->CellAttributes() ?>>
<div<?php echo $master_siswa->G_agama->ViewAttributes() ?>><?php echo $master_siswa->G_agama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_kewarganegaraan->Visible) { // G_kewarganegaraan ?>
		<td<?php echo $master_siswa->G_kewarganegaraan->CellAttributes() ?>>
<div<?php echo $master_siswa->G_kewarganegaraan->ViewAttributes() ?>><?php echo $master_siswa->G_kewarganegaraan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_pendidikan->Visible) { // G_pendidikan ?>
		<td<?php echo $master_siswa->G_pendidikan->CellAttributes() ?>>
<div<?php echo $master_siswa->G_pendidikan->ViewAttributes() ?>><?php echo $master_siswa->G_pendidikan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_pekerjaan->Visible) { // G_pekerjaan ?>
		<td<?php echo $master_siswa->G_pekerjaan->CellAttributes() ?>>
<div<?php echo $master_siswa->G_pekerjaan->ViewAttributes() ?>><?php echo $master_siswa->G_pekerjaan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_pengeluaran->Visible) { // G_pengeluaran ?>
		<td<?php echo $master_siswa->G_pengeluaran->CellAttributes() ?>>
<div<?php echo $master_siswa->G_pengeluaran->ViewAttributes() ?>><?php echo $master_siswa->G_pengeluaran->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_alamat->Visible) { // G_alamat ?>
		<td<?php echo $master_siswa->G_alamat->CellAttributes() ?>>
<div<?php echo $master_siswa->G_alamat->ViewAttributes() ?>><?php echo $master_siswa->G_alamat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_telepon->Visible) { // G_telepon ?>
		<td<?php echo $master_siswa->G_telepon->CellAttributes() ?>>
<div<?php echo $master_siswa->G_telepon->ViewAttributes() ?>><?php echo $master_siswa->G_telepon->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->G_hp->Visible) { // G_hp ?>
		<td<?php echo $master_siswa->G_hp->CellAttributes() ?>>
<div<?php echo $master_siswa->G_hp->ViewAttributes() ?>><?php echo $master_siswa->G_hp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->H_kesenian->Visible) { // H_kesenian ?>
		<td<?php echo $master_siswa->H_kesenian->CellAttributes() ?>>
<div<?php echo $master_siswa->H_kesenian->ViewAttributes() ?>><?php echo $master_siswa->H_kesenian->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->H_olahraga->Visible) { // H_olahraga ?>
		<td<?php echo $master_siswa->H_olahraga->CellAttributes() ?>>
<div<?php echo $master_siswa->H_olahraga->ViewAttributes() ?>><?php echo $master_siswa->H_olahraga->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->H_kemasyarakatan->Visible) { // H_kemasyarakatan ?>
		<td<?php echo $master_siswa->H_kemasyarakatan->CellAttributes() ?>>
<div<?php echo $master_siswa->H_kemasyarakatan->ViewAttributes() ?>><?php echo $master_siswa->H_kemasyarakatan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->H_lainlain->Visible) { // H_lainlain ?>
		<td<?php echo $master_siswa->H_lainlain->CellAttributes() ?>>
<div<?php echo $master_siswa->H_lainlain->ViewAttributes() ?>><?php echo $master_siswa->H_lainlain->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_tanggal_meninggalkan->Visible) { // I_tanggal_meninggalkan ?>
		<td<?php echo $master_siswa->I_tanggal_meninggalkan->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tanggal_meninggalkan->ViewAttributes() ?>><?php echo $master_siswa->I_tanggal_meninggalkan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_alasan->Visible) { // I_alasan ?>
		<td<?php echo $master_siswa->I_alasan->CellAttributes() ?>>
<div<?php echo $master_siswa->I_alasan->ViewAttributes() ?>><?php echo $master_siswa->I_alasan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_tanggal_lulus->Visible) { // I_tanggal_lulus ?>
		<td<?php echo $master_siswa->I_tanggal_lulus->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tanggal_lulus->ViewAttributes() ?>><?php echo $master_siswa->I_tanggal_lulus->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_sttb->Visible) { // I_sttb ?>
		<td<?php echo $master_siswa->I_sttb->CellAttributes() ?>>
<div<?php echo $master_siswa->I_sttb->ViewAttributes() ?>><?php echo $master_siswa->I_sttb->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_danum->Visible) { // I_danum ?>
		<td<?php echo $master_siswa->I_danum->CellAttributes() ?>>
<div<?php echo $master_siswa->I_danum->ViewAttributes() ?>><?php echo $master_siswa->I_danum->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_nilai_danum_smp->Visible) { // I_nilai_danum_smp ?>
		<td<?php echo $master_siswa->I_nilai_danum_smp->CellAttributes() ?>>
<div<?php echo $master_siswa->I_nilai_danum_smp->ViewAttributes() ?>><?php echo $master_siswa->I_nilai_danum_smp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_tahun1->Visible) { // I_tahun1 ?>
		<td<?php echo $master_siswa->I_tahun1->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tahun1->ViewAttributes() ?>><?php echo $master_siswa->I_tahun1->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_tahun2->Visible) { // I_tahun2 ?>
		<td<?php echo $master_siswa->I_tahun2->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tahun2->ViewAttributes() ?>><?php echo $master_siswa->I_tahun2->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_tahun3->Visible) { // I_tahun3 ?>
		<td<?php echo $master_siswa->I_tahun3->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tahun3->ViewAttributes() ?>><?php echo $master_siswa->I_tahun3->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_tk1->Visible) { // I_tk1 ?>
		<td<?php echo $master_siswa->I_tk1->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tk1->ViewAttributes() ?>><?php echo $master_siswa->I_tk1->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_tk2->Visible) { // I_tk2 ?>
		<td<?php echo $master_siswa->I_tk2->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tk2->ViewAttributes() ?>><?php echo $master_siswa->I_tk2->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_tk3->Visible) { // I_tk3 ?>
		<td<?php echo $master_siswa->I_tk3->CellAttributes() ?>>
<div<?php echo $master_siswa->I_tk3->ViewAttributes() ?>><?php echo $master_siswa->I_tk3->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_dari1->Visible) { // I_dari1 ?>
		<td<?php echo $master_siswa->I_dari1->CellAttributes() ?>>
<div<?php echo $master_siswa->I_dari1->ViewAttributes() ?>><?php echo $master_siswa->I_dari1->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_dari2->Visible) { // I_dari2 ?>
		<td<?php echo $master_siswa->I_dari2->CellAttributes() ?>>
<div<?php echo $master_siswa->I_dari2->ViewAttributes() ?>><?php echo $master_siswa->I_dari2->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->I_dari3->Visible) { // I_dari3 ?>
		<td<?php echo $master_siswa->I_dari3->CellAttributes() ?>>
<div<?php echo $master_siswa->I_dari3->ViewAttributes() ?>><?php echo $master_siswa->I_dari3->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->J_melanjutkan->Visible) { // J_melanjutkan ?>
		<td<?php echo $master_siswa->J_melanjutkan->CellAttributes() ?>>
<div<?php echo $master_siswa->J_melanjutkan->ViewAttributes() ?>><?php echo $master_siswa->J_melanjutkan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->J_tanggal_bekerja->Visible) { // J_tanggal_bekerja ?>
		<td<?php echo $master_siswa->J_tanggal_bekerja->CellAttributes() ?>>
<div<?php echo $master_siswa->J_tanggal_bekerja->ViewAttributes() ?>><?php echo $master_siswa->J_tanggal_bekerja->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->J_nama_perusahaan->Visible) { // J_nama_perusahaan ?>
		<td<?php echo $master_siswa->J_nama_perusahaan->CellAttributes() ?>>
<div<?php echo $master_siswa->J_nama_perusahaan->ViewAttributes() ?>><?php echo $master_siswa->J_nama_perusahaan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->J_penghasilan->Visible) { // J_penghasilan ?>
		<td<?php echo $master_siswa->J_penghasilan->CellAttributes() ?>>
<div<?php echo $master_siswa->J_penghasilan->ViewAttributes() ?>><?php echo $master_siswa->J_penghasilan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $master_siswa->kode_otomatis->CellAttributes() ?>>
<div<?php echo $master_siswa->kode_otomatis->ViewAttributes() ?>><?php echo $master_siswa->kode_otomatis->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($master_siswa->apakah_valid->Visible) { // apakah_valid ?>
		<td<?php echo $master_siswa->apakah_valid->CellAttributes() ?>>
<div<?php echo $master_siswa->apakah_valid->ViewAttributes() ?>><?php echo $master_siswa->apakah_valid->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$master_siswa_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($master_siswa->CurrentAction <> "gridadd")
		$master_siswa_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($master_siswa_list->Recordset)
	$master_siswa_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($master_siswa->Export == "" && $master_siswa->CurrentAction == "") { ?>
<?php } ?>
<?php
$master_siswa_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($master_siswa->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$master_siswa_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmaster_siswa_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'master_siswa';

	// Page object name
	var $PageObjName = 'master_siswa_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $master_siswa;
		if ($master_siswa->UseTokenInUrl) $PageUrl .= "t=" . $master_siswa->TableVar . "&"; // Add page token
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
		global $objForm, $master_siswa;
		if ($master_siswa->UseTokenInUrl) {
			if ($objForm)
				return ($master_siswa->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($master_siswa->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmaster_siswa_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (master_siswa)
		if (!isset($GLOBALS["master_siswa"])) {
			$GLOBALS["master_siswa"] = new cmaster_siswa();
			$GLOBALS["Table"] =& $GLOBALS["master_siswa"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "master_siswaadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "master_siswadelete.php";
		$this->MultiUpdateUrl = "master_siswaupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'master_siswa', TRUE);

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
		global $master_siswa;

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
			$master_siswa->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$master_siswa->Export = $_POST["exporttype"];
		} else {
			$master_siswa->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $master_siswa->Export; // Get export parameter, used in header
		$gsExportFile = $master_siswa->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($master_siswa->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($master_siswa->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$master_siswa->GridAddRowCount = $gridaddcnt;

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
	var $DisplayRecs = 10;
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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $master_siswa;

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
			if ($master_siswa->Export <> "" ||
				$master_siswa->CurrentAction == "gridadd" ||
				$master_siswa->CurrentAction == "gridedit") {
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
			$master_siswa->Recordset_SearchValidated();

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
		if ($master_siswa->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $master_siswa->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 10; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$master_siswa->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$master_siswa->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$master_siswa->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $master_siswa->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$master_siswa->setSessionWhere($sFilter);
		$master_siswa->CurrentFilter = "";

		// Export selected records
		if ($master_siswa->Export <> "")
			$master_siswa->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($master_siswa->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($master_siswa->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $master_siswa;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 10; // Non-numeric, load default
				}
			}
			$master_siswa->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$master_siswa->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $master_siswa;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $master_siswa->no_absen, FALSE); // no_absen
		$this->BuildSearchSql($sWhere, $master_siswa->A_nis_nasional, FALSE); // A_nis_nasional
		$this->BuildSearchSql($sWhere, $master_siswa->A_nama_Lengkap, FALSE); // A_nama_Lengkap
		$this->BuildSearchSql($sWhere, $master_siswa->A_nama_panggilan, FALSE); // A_nama_panggilan
		$this->BuildSearchSql($sWhere, $master_siswa->A_jenis_kelamin, FALSE); // A_jenis_kelamin
		$this->BuildSearchSql($sWhere, $master_siswa->A_tempat_lahir, FALSE); // A_tempat_lahir
		$this->BuildSearchSql($sWhere, $master_siswa->A_tanggal_lahir, FALSE); // A_tanggal_lahir
		$this->BuildSearchSql($sWhere, $master_siswa->A_agama, FALSE); // A_agama
		$this->BuildSearchSql($sWhere, $master_siswa->A_kewarganegaraan, FALSE); // A_kewarganegaraan
		$this->BuildSearchSql($sWhere, $master_siswa->A_anak_keberapa, FALSE); // A_anak_keberapa
		$this->BuildSearchSql($sWhere, $master_siswa->A_jumlah_saudara_kandung, FALSE); // A_jumlah_saudara_kandung
		$this->BuildSearchSql($sWhere, $master_siswa->A_jumlah_saudara_tiri, FALSE); // A_jumlah_saudara_tiri
		$this->BuildSearchSql($sWhere, $master_siswa->A_jumlah_saudara_angkat, FALSE); // A_jumlah_saudara_angkat
		$this->BuildSearchSql($sWhere, $master_siswa->A_status_yatim, FALSE); // A_status_yatim
		$this->BuildSearchSql($sWhere, $master_siswa->A_bahasa, FALSE); // A_bahasa
		$this->BuildSearchSql($sWhere, $master_siswa->B_alamat, FALSE); // B_alamat
		$this->BuildSearchSql($sWhere, $master_siswa->B_telepon_rumah, FALSE); // B_telepon_rumah
		$this->BuildSearchSql($sWhere, $master_siswa->B_tinggal, FALSE); // B_tinggal
		$this->BuildSearchSql($sWhere, $master_siswa->B_jarak, FALSE); // B_jarak
		$this->BuildSearchSql($sWhere, $master_siswa->B_hp, FALSE); // B_hp
		$this->BuildSearchSql($sWhere, $master_siswa->C_golongan_darah, FALSE); // C_golongan_darah
		$this->BuildSearchSql($sWhere, $master_siswa->C_penyakit, FALSE); // C_penyakit
		$this->BuildSearchSql($sWhere, $master_siswa->C_jasmani, FALSE); // C_jasmani
		$this->BuildSearchSql($sWhere, $master_siswa->C_tinggi, FALSE); // C_tinggi
		$this->BuildSearchSql($sWhere, $master_siswa->C_berat, FALSE); // C_berat
		$this->BuildSearchSql($sWhere, $master_siswa->D_tamatan_dari, FALSE); // D_tamatan_dari
		$this->BuildSearchSql($sWhere, $master_siswa->D_sttb, FALSE); // D_sttb
		$this->BuildSearchSql($sWhere, $master_siswa->D_tanggal_sttb, FALSE); // D_tanggal_sttb
		$this->BuildSearchSql($sWhere, $master_siswa->D_danum, FALSE); // D_danum
		$this->BuildSearchSql($sWhere, $master_siswa->D_tanggal_danum, FALSE); // D_tanggal_danum
		$this->BuildSearchSql($sWhere, $master_siswa->D_lama_belajar, FALSE); // D_lama_belajar
		$this->BuildSearchSql($sWhere, $master_siswa->D_dari_sekolah, FALSE); // D_dari_sekolah
		$this->BuildSearchSql($sWhere, $master_siswa->D_alasan, FALSE); // D_alasan
		$this->BuildSearchSql($sWhere, $master_siswa->D_kelas, FALSE); // D_kelas
		$this->BuildSearchSql($sWhere, $master_siswa->D_kelompok, FALSE); // D_kelompok
		$this->BuildSearchSql($sWhere, $master_siswa->D_tanggal, FALSE); // D_tanggal
		$this->BuildSearchSql($sWhere, $master_siswa->D_saat_ini_tingkat, FALSE); // D_saat_ini_tingkat
		$this->BuildSearchSql($sWhere, $master_siswa->D_saat_ini_kelas, FALSE); // D_saat_ini_kelas
		$this->BuildSearchSql($sWhere, $master_siswa->D_saat_ini_kelompok, FALSE); // D_saat_ini_kelompok
		$this->BuildSearchSql($sWhere, $master_siswa->D_no_psb, FALSE); // D_no_psb
		$this->BuildSearchSql($sWhere, $master_siswa->D_nilai_danum_sd, FALSE); // D_nilai_danum_sd
		$this->BuildSearchSql($sWhere, $master_siswa->D_jumlah_pelajaran_danum, FALSE); // D_jumlah_pelajaran_danum
		$this->BuildSearchSql($sWhere, $master_siswa->D_nilai_ujian_psb, FALSE); // D_nilai_ujian_psb
		$this->BuildSearchSql($sWhere, $master_siswa->D_tahun_psb, FALSE); // D_tahun_psb
		$this->BuildSearchSql($sWhere, $master_siswa->D_diterima, FALSE); // D_diterima
		$this->BuildSearchSql($sWhere, $master_siswa->D_spp, FALSE); // D_spp
		$this->BuildSearchSql($sWhere, $master_siswa->D_spp_potongan, FALSE); // D_spp_potongan
		$this->BuildSearchSql($sWhere, $master_siswa->D_status_lama_baru, FALSE); // D_status_lama_baru
		$this->BuildSearchSql($sWhere, $master_siswa->E_nama_ayah, FALSE); // E_nama_ayah
		$this->BuildSearchSql($sWhere, $master_siswa->E_tempat_lahir, FALSE); // E_tempat_lahir
		$this->BuildSearchSql($sWhere, $master_siswa->E_tanggal_lahir, FALSE); // E_tanggal_lahir
		$this->BuildSearchSql($sWhere, $master_siswa->E_agama, FALSE); // E_agama
		$this->BuildSearchSql($sWhere, $master_siswa->E_kewarganegaraan, FALSE); // E_kewarganegaraan
		$this->BuildSearchSql($sWhere, $master_siswa->E_pendidikan, FALSE); // E_pendidikan
		$this->BuildSearchSql($sWhere, $master_siswa->E_pekerjaan, FALSE); // E_pekerjaan
		$this->BuildSearchSql($sWhere, $master_siswa->E_pengeluaran, FALSE); // E_pengeluaran
		$this->BuildSearchSql($sWhere, $master_siswa->E_alamat, FALSE); // E_alamat
		$this->BuildSearchSql($sWhere, $master_siswa->E_telepon, FALSE); // E_telepon
		$this->BuildSearchSql($sWhere, $master_siswa->E_hp, FALSE); // E_hp
		$this->BuildSearchSql($sWhere, $master_siswa->E_hidup, FALSE); // E_hidup
		$this->BuildSearchSql($sWhere, $master_siswa->F_nama_ibu, FALSE); // F_nama_ibu
		$this->BuildSearchSql($sWhere, $master_siswa->F_tempat_lahir, FALSE); // F_tempat_lahir
		$this->BuildSearchSql($sWhere, $master_siswa->F_tanggal_lahir, FALSE); // F_tanggal_lahir
		$this->BuildSearchSql($sWhere, $master_siswa->F_agama, FALSE); // F_agama
		$this->BuildSearchSql($sWhere, $master_siswa->F_kewarganegaraan, FALSE); // F_kewarganegaraan
		$this->BuildSearchSql($sWhere, $master_siswa->F_pendidikan, FALSE); // F_pendidikan
		$this->BuildSearchSql($sWhere, $master_siswa->F_pekerjaan, FALSE); // F_pekerjaan
		$this->BuildSearchSql($sWhere, $master_siswa->F_pengeluaran, FALSE); // F_pengeluaran
		$this->BuildSearchSql($sWhere, $master_siswa->F_alamat, FALSE); // F_alamat
		$this->BuildSearchSql($sWhere, $master_siswa->F_telepon, FALSE); // F_telepon
		$this->BuildSearchSql($sWhere, $master_siswa->F_hp, FALSE); // F_hp
		$this->BuildSearchSql($sWhere, $master_siswa->F_hidup, FALSE); // F_hidup
		$this->BuildSearchSql($sWhere, $master_siswa->G_nama_wali, FALSE); // G_nama_wali
		$this->BuildSearchSql($sWhere, $master_siswa->G_tempat_lahir, FALSE); // G_tempat_lahir
		$this->BuildSearchSql($sWhere, $master_siswa->G_tanggal_lahir, FALSE); // G_tanggal_lahir
		$this->BuildSearchSql($sWhere, $master_siswa->G_agama, FALSE); // G_agama
		$this->BuildSearchSql($sWhere, $master_siswa->G_kewarganegaraan, FALSE); // G_kewarganegaraan
		$this->BuildSearchSql($sWhere, $master_siswa->G_pendidikan, FALSE); // G_pendidikan
		$this->BuildSearchSql($sWhere, $master_siswa->G_pekerjaan, FALSE); // G_pekerjaan
		$this->BuildSearchSql($sWhere, $master_siswa->G_pengeluaran, FALSE); // G_pengeluaran
		$this->BuildSearchSql($sWhere, $master_siswa->G_alamat, FALSE); // G_alamat
		$this->BuildSearchSql($sWhere, $master_siswa->G_telepon, FALSE); // G_telepon
		$this->BuildSearchSql($sWhere, $master_siswa->G_hp, FALSE); // G_hp
		$this->BuildSearchSql($sWhere, $master_siswa->H_kesenian, FALSE); // H_kesenian
		$this->BuildSearchSql($sWhere, $master_siswa->H_olahraga, FALSE); // H_olahraga
		$this->BuildSearchSql($sWhere, $master_siswa->H_kemasyarakatan, FALSE); // H_kemasyarakatan
		$this->BuildSearchSql($sWhere, $master_siswa->H_lainlain, FALSE); // H_lainlain
		$this->BuildSearchSql($sWhere, $master_siswa->I_tanggal_meninggalkan, FALSE); // I_tanggal_meninggalkan
		$this->BuildSearchSql($sWhere, $master_siswa->I_alasan, FALSE); // I_alasan
		$this->BuildSearchSql($sWhere, $master_siswa->I_tanggal_lulus, FALSE); // I_tanggal_lulus
		$this->BuildSearchSql($sWhere, $master_siswa->I_sttb, FALSE); // I_sttb
		$this->BuildSearchSql($sWhere, $master_siswa->I_danum, FALSE); // I_danum
		$this->BuildSearchSql($sWhere, $master_siswa->I_nilai_danum_smp, FALSE); // I_nilai_danum_smp
		$this->BuildSearchSql($sWhere, $master_siswa->I_tahun1, FALSE); // I_tahun1
		$this->BuildSearchSql($sWhere, $master_siswa->I_tahun2, FALSE); // I_tahun2
		$this->BuildSearchSql($sWhere, $master_siswa->I_tahun3, FALSE); // I_tahun3
		$this->BuildSearchSql($sWhere, $master_siswa->I_tk1, FALSE); // I_tk1
		$this->BuildSearchSql($sWhere, $master_siswa->I_tk2, FALSE); // I_tk2
		$this->BuildSearchSql($sWhere, $master_siswa->I_tk3, FALSE); // I_tk3
		$this->BuildSearchSql($sWhere, $master_siswa->I_dari1, FALSE); // I_dari1
		$this->BuildSearchSql($sWhere, $master_siswa->I_dari2, FALSE); // I_dari2
		$this->BuildSearchSql($sWhere, $master_siswa->I_dari3, FALSE); // I_dari3
		$this->BuildSearchSql($sWhere, $master_siswa->J_melanjutkan, FALSE); // J_melanjutkan
		$this->BuildSearchSql($sWhere, $master_siswa->J_tanggal_bekerja, FALSE); // J_tanggal_bekerja
		$this->BuildSearchSql($sWhere, $master_siswa->J_nama_perusahaan, FALSE); // J_nama_perusahaan
		$this->BuildSearchSql($sWhere, $master_siswa->J_penghasilan, FALSE); // J_penghasilan
		$this->BuildSearchSql($sWhere, $master_siswa->kode_otomatis, FALSE); // kode_otomatis
		$this->BuildSearchSql($sWhere, $master_siswa->apakah_valid, FALSE); // apakah_valid

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($master_siswa->no_absen); // no_absen
			$this->SetSearchParm($master_siswa->A_nis_nasional); // A_nis_nasional
			$this->SetSearchParm($master_siswa->A_nama_Lengkap); // A_nama_Lengkap
			$this->SetSearchParm($master_siswa->A_nama_panggilan); // A_nama_panggilan
			$this->SetSearchParm($master_siswa->A_jenis_kelamin); // A_jenis_kelamin
			$this->SetSearchParm($master_siswa->A_tempat_lahir); // A_tempat_lahir
			$this->SetSearchParm($master_siswa->A_tanggal_lahir); // A_tanggal_lahir
			$this->SetSearchParm($master_siswa->A_agama); // A_agama
			$this->SetSearchParm($master_siswa->A_kewarganegaraan); // A_kewarganegaraan
			$this->SetSearchParm($master_siswa->A_anak_keberapa); // A_anak_keberapa
			$this->SetSearchParm($master_siswa->A_jumlah_saudara_kandung); // A_jumlah_saudara_kandung
			$this->SetSearchParm($master_siswa->A_jumlah_saudara_tiri); // A_jumlah_saudara_tiri
			$this->SetSearchParm($master_siswa->A_jumlah_saudara_angkat); // A_jumlah_saudara_angkat
			$this->SetSearchParm($master_siswa->A_status_yatim); // A_status_yatim
			$this->SetSearchParm($master_siswa->A_bahasa); // A_bahasa
			$this->SetSearchParm($master_siswa->B_alamat); // B_alamat
			$this->SetSearchParm($master_siswa->B_telepon_rumah); // B_telepon_rumah
			$this->SetSearchParm($master_siswa->B_tinggal); // B_tinggal
			$this->SetSearchParm($master_siswa->B_jarak); // B_jarak
			$this->SetSearchParm($master_siswa->B_hp); // B_hp
			$this->SetSearchParm($master_siswa->C_golongan_darah); // C_golongan_darah
			$this->SetSearchParm($master_siswa->C_penyakit); // C_penyakit
			$this->SetSearchParm($master_siswa->C_jasmani); // C_jasmani
			$this->SetSearchParm($master_siswa->C_tinggi); // C_tinggi
			$this->SetSearchParm($master_siswa->C_berat); // C_berat
			$this->SetSearchParm($master_siswa->D_tamatan_dari); // D_tamatan_dari
			$this->SetSearchParm($master_siswa->D_sttb); // D_sttb
			$this->SetSearchParm($master_siswa->D_tanggal_sttb); // D_tanggal_sttb
			$this->SetSearchParm($master_siswa->D_danum); // D_danum
			$this->SetSearchParm($master_siswa->D_tanggal_danum); // D_tanggal_danum
			$this->SetSearchParm($master_siswa->D_lama_belajar); // D_lama_belajar
			$this->SetSearchParm($master_siswa->D_dari_sekolah); // D_dari_sekolah
			$this->SetSearchParm($master_siswa->D_alasan); // D_alasan
			$this->SetSearchParm($master_siswa->D_kelas); // D_kelas
			$this->SetSearchParm($master_siswa->D_kelompok); // D_kelompok
			$this->SetSearchParm($master_siswa->D_tanggal); // D_tanggal
			$this->SetSearchParm($master_siswa->D_saat_ini_tingkat); // D_saat_ini_tingkat
			$this->SetSearchParm($master_siswa->D_saat_ini_kelas); // D_saat_ini_kelas
			$this->SetSearchParm($master_siswa->D_saat_ini_kelompok); // D_saat_ini_kelompok
			$this->SetSearchParm($master_siswa->D_no_psb); // D_no_psb
			$this->SetSearchParm($master_siswa->D_nilai_danum_sd); // D_nilai_danum_sd
			$this->SetSearchParm($master_siswa->D_jumlah_pelajaran_danum); // D_jumlah_pelajaran_danum
			$this->SetSearchParm($master_siswa->D_nilai_ujian_psb); // D_nilai_ujian_psb
			$this->SetSearchParm($master_siswa->D_tahun_psb); // D_tahun_psb
			$this->SetSearchParm($master_siswa->D_diterima); // D_diterima
			$this->SetSearchParm($master_siswa->D_spp); // D_spp
			$this->SetSearchParm($master_siswa->D_spp_potongan); // D_spp_potongan
			$this->SetSearchParm($master_siswa->D_status_lama_baru); // D_status_lama_baru
			$this->SetSearchParm($master_siswa->E_nama_ayah); // E_nama_ayah
			$this->SetSearchParm($master_siswa->E_tempat_lahir); // E_tempat_lahir
			$this->SetSearchParm($master_siswa->E_tanggal_lahir); // E_tanggal_lahir
			$this->SetSearchParm($master_siswa->E_agama); // E_agama
			$this->SetSearchParm($master_siswa->E_kewarganegaraan); // E_kewarganegaraan
			$this->SetSearchParm($master_siswa->E_pendidikan); // E_pendidikan
			$this->SetSearchParm($master_siswa->E_pekerjaan); // E_pekerjaan
			$this->SetSearchParm($master_siswa->E_pengeluaran); // E_pengeluaran
			$this->SetSearchParm($master_siswa->E_alamat); // E_alamat
			$this->SetSearchParm($master_siswa->E_telepon); // E_telepon
			$this->SetSearchParm($master_siswa->E_hp); // E_hp
			$this->SetSearchParm($master_siswa->E_hidup); // E_hidup
			$this->SetSearchParm($master_siswa->F_nama_ibu); // F_nama_ibu
			$this->SetSearchParm($master_siswa->F_tempat_lahir); // F_tempat_lahir
			$this->SetSearchParm($master_siswa->F_tanggal_lahir); // F_tanggal_lahir
			$this->SetSearchParm($master_siswa->F_agama); // F_agama
			$this->SetSearchParm($master_siswa->F_kewarganegaraan); // F_kewarganegaraan
			$this->SetSearchParm($master_siswa->F_pendidikan); // F_pendidikan
			$this->SetSearchParm($master_siswa->F_pekerjaan); // F_pekerjaan
			$this->SetSearchParm($master_siswa->F_pengeluaran); // F_pengeluaran
			$this->SetSearchParm($master_siswa->F_alamat); // F_alamat
			$this->SetSearchParm($master_siswa->F_telepon); // F_telepon
			$this->SetSearchParm($master_siswa->F_hp); // F_hp
			$this->SetSearchParm($master_siswa->F_hidup); // F_hidup
			$this->SetSearchParm($master_siswa->G_nama_wali); // G_nama_wali
			$this->SetSearchParm($master_siswa->G_tempat_lahir); // G_tempat_lahir
			$this->SetSearchParm($master_siswa->G_tanggal_lahir); // G_tanggal_lahir
			$this->SetSearchParm($master_siswa->G_agama); // G_agama
			$this->SetSearchParm($master_siswa->G_kewarganegaraan); // G_kewarganegaraan
			$this->SetSearchParm($master_siswa->G_pendidikan); // G_pendidikan
			$this->SetSearchParm($master_siswa->G_pekerjaan); // G_pekerjaan
			$this->SetSearchParm($master_siswa->G_pengeluaran); // G_pengeluaran
			$this->SetSearchParm($master_siswa->G_alamat); // G_alamat
			$this->SetSearchParm($master_siswa->G_telepon); // G_telepon
			$this->SetSearchParm($master_siswa->G_hp); // G_hp
			$this->SetSearchParm($master_siswa->H_kesenian); // H_kesenian
			$this->SetSearchParm($master_siswa->H_olahraga); // H_olahraga
			$this->SetSearchParm($master_siswa->H_kemasyarakatan); // H_kemasyarakatan
			$this->SetSearchParm($master_siswa->H_lainlain); // H_lainlain
			$this->SetSearchParm($master_siswa->I_tanggal_meninggalkan); // I_tanggal_meninggalkan
			$this->SetSearchParm($master_siswa->I_alasan); // I_alasan
			$this->SetSearchParm($master_siswa->I_tanggal_lulus); // I_tanggal_lulus
			$this->SetSearchParm($master_siswa->I_sttb); // I_sttb
			$this->SetSearchParm($master_siswa->I_danum); // I_danum
			$this->SetSearchParm($master_siswa->I_nilai_danum_smp); // I_nilai_danum_smp
			$this->SetSearchParm($master_siswa->I_tahun1); // I_tahun1
			$this->SetSearchParm($master_siswa->I_tahun2); // I_tahun2
			$this->SetSearchParm($master_siswa->I_tahun3); // I_tahun3
			$this->SetSearchParm($master_siswa->I_tk1); // I_tk1
			$this->SetSearchParm($master_siswa->I_tk2); // I_tk2
			$this->SetSearchParm($master_siswa->I_tk3); // I_tk3
			$this->SetSearchParm($master_siswa->I_dari1); // I_dari1
			$this->SetSearchParm($master_siswa->I_dari2); // I_dari2
			$this->SetSearchParm($master_siswa->I_dari3); // I_dari3
			$this->SetSearchParm($master_siswa->J_melanjutkan); // J_melanjutkan
			$this->SetSearchParm($master_siswa->J_tanggal_bekerja); // J_tanggal_bekerja
			$this->SetSearchParm($master_siswa->J_nama_perusahaan); // J_nama_perusahaan
			$this->SetSearchParm($master_siswa->J_penghasilan); // J_penghasilan
			$this->SetSearchParm($master_siswa->kode_otomatis); // kode_otomatis
			$this->SetSearchParm($master_siswa->apakah_valid); // apakah_valid
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
		global $master_siswa;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$master_siswa->setAdvancedSearch("x_$FldParm", $FldVal);
		$master_siswa->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$master_siswa->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$master_siswa->setAdvancedSearch("y_$FldParm", $FldVal2);
		$master_siswa->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $master_siswa;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $master_siswa->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $master_siswa->getAdvancedSearch("w_$FldParm");
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
		global $master_siswa;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->A_nis_nasional, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->A_nama_Lengkap, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->A_nama_panggilan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->A_jenis_kelamin, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->A_tempat_lahir, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->A_agama, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->A_kewarganegaraan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->A_status_yatim, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->A_bahasa, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->B_alamat, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->B_telepon_rumah, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->B_tinggal, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->B_hp, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->C_golongan_darah, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->C_penyakit, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->C_jasmani, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_tamatan_dari, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_sttb, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_danum, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_dari_sekolah, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_alasan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_kelas, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_kelompok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_saat_ini_tingkat, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_saat_ini_kelas, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_saat_ini_kelompok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_no_psb, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_tahun_psb, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_diterima, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->D_status_lama_baru, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->E_nama_ayah, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->E_tempat_lahir, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->E_agama, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->E_kewarganegaraan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->E_pendidikan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->E_pekerjaan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->E_alamat, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->E_telepon, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->E_hp, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->E_hidup, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->F_nama_ibu, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->F_tempat_lahir, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->F_agama, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->F_kewarganegaraan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->F_pendidikan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->F_pekerjaan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->F_alamat, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->F_telepon, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->F_hp, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->F_hidup, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->G_nama_wali, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->G_tempat_lahir, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->G_agama, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->G_kewarganegaraan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->G_pendidikan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->G_pekerjaan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->G_alamat, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->G_telepon, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->G_hp, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->H_kesenian, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->H_olahraga, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->H_kemasyarakatan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->H_lainlain, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_alasan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_sttb, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_danum, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_tahun1, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_tahun2, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_tahun3, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_tk1, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_tk2, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_tk3, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_dari1, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_dari2, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->I_dari3, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->J_melanjutkan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->J_nama_perusahaan, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->kode_otomatis, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $master_siswa->apakah_valid, $Keyword);
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
		global $Security, $master_siswa;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $master_siswa->BasicSearchKeyword;
		$sSearchType = $master_siswa->BasicSearchType;
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
			$master_siswa->setSessionBasicSearchKeyword($sSearchKeyword);
			$master_siswa->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $master_siswa;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$master_siswa->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $master_siswa;
		$master_siswa->setSessionBasicSearchKeyword("");
		$master_siswa->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $master_siswa;
		$master_siswa->setAdvancedSearch("x_no_absen", "");
		$master_siswa->setAdvancedSearch("z_no_absen", "");
		$master_siswa->setAdvancedSearch("y_no_absen", "");
		$master_siswa->setAdvancedSearch("x_A_nis_nasional", "");
		$master_siswa->setAdvancedSearch("z_A_nis_nasional", "");
		$master_siswa->setAdvancedSearch("y_A_nis_nasional", "");
		$master_siswa->setAdvancedSearch("x_A_nama_Lengkap", "");
		$master_siswa->setAdvancedSearch("z_A_nama_Lengkap", "");
		$master_siswa->setAdvancedSearch("y_A_nama_Lengkap", "");
		$master_siswa->setAdvancedSearch("x_A_nama_panggilan", "");
		$master_siswa->setAdvancedSearch("z_A_nama_panggilan", "");
		$master_siswa->setAdvancedSearch("y_A_nama_panggilan", "");
		$master_siswa->setAdvancedSearch("x_A_jenis_kelamin", "");
		$master_siswa->setAdvancedSearch("z_A_jenis_kelamin", "");
		$master_siswa->setAdvancedSearch("y_A_jenis_kelamin", "");
		$master_siswa->setAdvancedSearch("x_A_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("z_A_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("y_A_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("x_A_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("z_A_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("y_A_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("x_A_agama", "");
		$master_siswa->setAdvancedSearch("z_A_agama", "");
		$master_siswa->setAdvancedSearch("y_A_agama", "");
		$master_siswa->setAdvancedSearch("x_A_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("z_A_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("y_A_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("x_A_anak_keberapa", "");
		$master_siswa->setAdvancedSearch("z_A_anak_keberapa", "");
		$master_siswa->setAdvancedSearch("y_A_anak_keberapa", "");
		$master_siswa->setAdvancedSearch("x_A_jumlah_saudara_kandung", "");
		$master_siswa->setAdvancedSearch("z_A_jumlah_saudara_kandung", "");
		$master_siswa->setAdvancedSearch("y_A_jumlah_saudara_kandung", "");
		$master_siswa->setAdvancedSearch("x_A_jumlah_saudara_tiri", "");
		$master_siswa->setAdvancedSearch("z_A_jumlah_saudara_tiri", "");
		$master_siswa->setAdvancedSearch("y_A_jumlah_saudara_tiri", "");
		$master_siswa->setAdvancedSearch("x_A_jumlah_saudara_angkat", "");
		$master_siswa->setAdvancedSearch("z_A_jumlah_saudara_angkat", "");
		$master_siswa->setAdvancedSearch("y_A_jumlah_saudara_angkat", "");
		$master_siswa->setAdvancedSearch("x_A_status_yatim", "");
		$master_siswa->setAdvancedSearch("z_A_status_yatim", "");
		$master_siswa->setAdvancedSearch("y_A_status_yatim", "");
		$master_siswa->setAdvancedSearch("x_A_bahasa", "");
		$master_siswa->setAdvancedSearch("z_A_bahasa", "");
		$master_siswa->setAdvancedSearch("y_A_bahasa", "");
		$master_siswa->setAdvancedSearch("x_B_alamat", "");
		$master_siswa->setAdvancedSearch("z_B_alamat", "");
		$master_siswa->setAdvancedSearch("y_B_alamat", "");
		$master_siswa->setAdvancedSearch("x_B_telepon_rumah", "");
		$master_siswa->setAdvancedSearch("z_B_telepon_rumah", "");
		$master_siswa->setAdvancedSearch("y_B_telepon_rumah", "");
		$master_siswa->setAdvancedSearch("x_B_tinggal", "");
		$master_siswa->setAdvancedSearch("z_B_tinggal", "");
		$master_siswa->setAdvancedSearch("y_B_tinggal", "");
		$master_siswa->setAdvancedSearch("x_B_jarak", "");
		$master_siswa->setAdvancedSearch("z_B_jarak", "");
		$master_siswa->setAdvancedSearch("y_B_jarak", "");
		$master_siswa->setAdvancedSearch("x_B_hp", "");
		$master_siswa->setAdvancedSearch("z_B_hp", "");
		$master_siswa->setAdvancedSearch("y_B_hp", "");
		$master_siswa->setAdvancedSearch("x_C_golongan_darah", "");
		$master_siswa->setAdvancedSearch("z_C_golongan_darah", "");
		$master_siswa->setAdvancedSearch("y_C_golongan_darah", "");
		$master_siswa->setAdvancedSearch("x_C_penyakit", "");
		$master_siswa->setAdvancedSearch("z_C_penyakit", "");
		$master_siswa->setAdvancedSearch("y_C_penyakit", "");
		$master_siswa->setAdvancedSearch("x_C_jasmani", "");
		$master_siswa->setAdvancedSearch("z_C_jasmani", "");
		$master_siswa->setAdvancedSearch("y_C_jasmani", "");
		$master_siswa->setAdvancedSearch("x_C_tinggi", "");
		$master_siswa->setAdvancedSearch("z_C_tinggi", "");
		$master_siswa->setAdvancedSearch("y_C_tinggi", "");
		$master_siswa->setAdvancedSearch("x_C_berat", "");
		$master_siswa->setAdvancedSearch("z_C_berat", "");
		$master_siswa->setAdvancedSearch("y_C_berat", "");
		$master_siswa->setAdvancedSearch("x_D_tamatan_dari", "");
		$master_siswa->setAdvancedSearch("z_D_tamatan_dari", "");
		$master_siswa->setAdvancedSearch("y_D_tamatan_dari", "");
		$master_siswa->setAdvancedSearch("x_D_sttb", "");
		$master_siswa->setAdvancedSearch("z_D_sttb", "");
		$master_siswa->setAdvancedSearch("y_D_sttb", "");
		$master_siswa->setAdvancedSearch("x_D_tanggal_sttb", "");
		$master_siswa->setAdvancedSearch("z_D_tanggal_sttb", "");
		$master_siswa->setAdvancedSearch("y_D_tanggal_sttb", "");
		$master_siswa->setAdvancedSearch("x_D_danum", "");
		$master_siswa->setAdvancedSearch("z_D_danum", "");
		$master_siswa->setAdvancedSearch("y_D_danum", "");
		$master_siswa->setAdvancedSearch("x_D_tanggal_danum", "");
		$master_siswa->setAdvancedSearch("z_D_tanggal_danum", "");
		$master_siswa->setAdvancedSearch("y_D_tanggal_danum", "");
		$master_siswa->setAdvancedSearch("x_D_lama_belajar", "");
		$master_siswa->setAdvancedSearch("z_D_lama_belajar", "");
		$master_siswa->setAdvancedSearch("y_D_lama_belajar", "");
		$master_siswa->setAdvancedSearch("x_D_dari_sekolah", "");
		$master_siswa->setAdvancedSearch("z_D_dari_sekolah", "");
		$master_siswa->setAdvancedSearch("y_D_dari_sekolah", "");
		$master_siswa->setAdvancedSearch("x_D_alasan", "");
		$master_siswa->setAdvancedSearch("z_D_alasan", "");
		$master_siswa->setAdvancedSearch("y_D_alasan", "");
		$master_siswa->setAdvancedSearch("x_D_kelas", "");
		$master_siswa->setAdvancedSearch("z_D_kelas", "");
		$master_siswa->setAdvancedSearch("y_D_kelas", "");
		$master_siswa->setAdvancedSearch("x_D_kelompok", "");
		$master_siswa->setAdvancedSearch("z_D_kelompok", "");
		$master_siswa->setAdvancedSearch("y_D_kelompok", "");
		$master_siswa->setAdvancedSearch("x_D_tanggal", "");
		$master_siswa->setAdvancedSearch("z_D_tanggal", "");
		$master_siswa->setAdvancedSearch("y_D_tanggal", "");
		$master_siswa->setAdvancedSearch("x_D_saat_ini_tingkat", "");
		$master_siswa->setAdvancedSearch("z_D_saat_ini_tingkat", "");
		$master_siswa->setAdvancedSearch("y_D_saat_ini_tingkat", "");
		$master_siswa->setAdvancedSearch("x_D_saat_ini_kelas", "");
		$master_siswa->setAdvancedSearch("z_D_saat_ini_kelas", "");
		$master_siswa->setAdvancedSearch("y_D_saat_ini_kelas", "");
		$master_siswa->setAdvancedSearch("x_D_saat_ini_kelompok", "");
		$master_siswa->setAdvancedSearch("z_D_saat_ini_kelompok", "");
		$master_siswa->setAdvancedSearch("y_D_saat_ini_kelompok", "");
		$master_siswa->setAdvancedSearch("x_D_no_psb", "");
		$master_siswa->setAdvancedSearch("z_D_no_psb", "");
		$master_siswa->setAdvancedSearch("y_D_no_psb", "");
		$master_siswa->setAdvancedSearch("x_D_nilai_danum_sd", "");
		$master_siswa->setAdvancedSearch("z_D_nilai_danum_sd", "");
		$master_siswa->setAdvancedSearch("y_D_nilai_danum_sd", "");
		$master_siswa->setAdvancedSearch("x_D_jumlah_pelajaran_danum", "");
		$master_siswa->setAdvancedSearch("z_D_jumlah_pelajaran_danum", "");
		$master_siswa->setAdvancedSearch("y_D_jumlah_pelajaran_danum", "");
		$master_siswa->setAdvancedSearch("x_D_nilai_ujian_psb", "");
		$master_siswa->setAdvancedSearch("z_D_nilai_ujian_psb", "");
		$master_siswa->setAdvancedSearch("y_D_nilai_ujian_psb", "");
		$master_siswa->setAdvancedSearch("x_D_tahun_psb", "");
		$master_siswa->setAdvancedSearch("z_D_tahun_psb", "");
		$master_siswa->setAdvancedSearch("y_D_tahun_psb", "");
		$master_siswa->setAdvancedSearch("x_D_diterima", "");
		$master_siswa->setAdvancedSearch("z_D_diterima", "");
		$master_siswa->setAdvancedSearch("y_D_diterima", "");
		$master_siswa->setAdvancedSearch("x_D_spp", "");
		$master_siswa->setAdvancedSearch("z_D_spp", "");
		$master_siswa->setAdvancedSearch("y_D_spp", "");
		$master_siswa->setAdvancedSearch("x_D_spp_potongan", "");
		$master_siswa->setAdvancedSearch("z_D_spp_potongan", "");
		$master_siswa->setAdvancedSearch("y_D_spp_potongan", "");
		$master_siswa->setAdvancedSearch("x_D_status_lama_baru", "");
		$master_siswa->setAdvancedSearch("z_D_status_lama_baru", "");
		$master_siswa->setAdvancedSearch("y_D_status_lama_baru", "");
		$master_siswa->setAdvancedSearch("x_E_nama_ayah", "");
		$master_siswa->setAdvancedSearch("z_E_nama_ayah", "");
		$master_siswa->setAdvancedSearch("y_E_nama_ayah", "");
		$master_siswa->setAdvancedSearch("x_E_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("z_E_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("y_E_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("x_E_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("z_E_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("y_E_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("x_E_agama", "");
		$master_siswa->setAdvancedSearch("z_E_agama", "");
		$master_siswa->setAdvancedSearch("y_E_agama", "");
		$master_siswa->setAdvancedSearch("x_E_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("z_E_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("y_E_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("x_E_pendidikan", "");
		$master_siswa->setAdvancedSearch("z_E_pendidikan", "");
		$master_siswa->setAdvancedSearch("y_E_pendidikan", "");
		$master_siswa->setAdvancedSearch("x_E_pekerjaan", "");
		$master_siswa->setAdvancedSearch("z_E_pekerjaan", "");
		$master_siswa->setAdvancedSearch("y_E_pekerjaan", "");
		$master_siswa->setAdvancedSearch("x_E_pengeluaran", "");
		$master_siswa->setAdvancedSearch("z_E_pengeluaran", "");
		$master_siswa->setAdvancedSearch("y_E_pengeluaran", "");
		$master_siswa->setAdvancedSearch("x_E_alamat", "");
		$master_siswa->setAdvancedSearch("z_E_alamat", "");
		$master_siswa->setAdvancedSearch("y_E_alamat", "");
		$master_siswa->setAdvancedSearch("x_E_telepon", "");
		$master_siswa->setAdvancedSearch("z_E_telepon", "");
		$master_siswa->setAdvancedSearch("y_E_telepon", "");
		$master_siswa->setAdvancedSearch("x_E_hp", "");
		$master_siswa->setAdvancedSearch("z_E_hp", "");
		$master_siswa->setAdvancedSearch("y_E_hp", "");
		$master_siswa->setAdvancedSearch("x_E_hidup", "");
		$master_siswa->setAdvancedSearch("z_E_hidup", "");
		$master_siswa->setAdvancedSearch("y_E_hidup", "");
		$master_siswa->setAdvancedSearch("x_F_nama_ibu", "");
		$master_siswa->setAdvancedSearch("z_F_nama_ibu", "");
		$master_siswa->setAdvancedSearch("y_F_nama_ibu", "");
		$master_siswa->setAdvancedSearch("x_F_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("z_F_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("y_F_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("x_F_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("z_F_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("y_F_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("x_F_agama", "");
		$master_siswa->setAdvancedSearch("z_F_agama", "");
		$master_siswa->setAdvancedSearch("y_F_agama", "");
		$master_siswa->setAdvancedSearch("x_F_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("z_F_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("y_F_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("x_F_pendidikan", "");
		$master_siswa->setAdvancedSearch("z_F_pendidikan", "");
		$master_siswa->setAdvancedSearch("y_F_pendidikan", "");
		$master_siswa->setAdvancedSearch("x_F_pekerjaan", "");
		$master_siswa->setAdvancedSearch("z_F_pekerjaan", "");
		$master_siswa->setAdvancedSearch("y_F_pekerjaan", "");
		$master_siswa->setAdvancedSearch("x_F_pengeluaran", "");
		$master_siswa->setAdvancedSearch("z_F_pengeluaran", "");
		$master_siswa->setAdvancedSearch("y_F_pengeluaran", "");
		$master_siswa->setAdvancedSearch("x_F_alamat", "");
		$master_siswa->setAdvancedSearch("z_F_alamat", "");
		$master_siswa->setAdvancedSearch("y_F_alamat", "");
		$master_siswa->setAdvancedSearch("x_F_telepon", "");
		$master_siswa->setAdvancedSearch("z_F_telepon", "");
		$master_siswa->setAdvancedSearch("y_F_telepon", "");
		$master_siswa->setAdvancedSearch("x_F_hp", "");
		$master_siswa->setAdvancedSearch("z_F_hp", "");
		$master_siswa->setAdvancedSearch("y_F_hp", "");
		$master_siswa->setAdvancedSearch("x_F_hidup", "");
		$master_siswa->setAdvancedSearch("z_F_hidup", "");
		$master_siswa->setAdvancedSearch("y_F_hidup", "");
		$master_siswa->setAdvancedSearch("x_G_nama_wali", "");
		$master_siswa->setAdvancedSearch("z_G_nama_wali", "");
		$master_siswa->setAdvancedSearch("y_G_nama_wali", "");
		$master_siswa->setAdvancedSearch("x_G_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("z_G_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("y_G_tempat_lahir", "");
		$master_siswa->setAdvancedSearch("x_G_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("z_G_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("y_G_tanggal_lahir", "");
		$master_siswa->setAdvancedSearch("x_G_agama", "");
		$master_siswa->setAdvancedSearch("z_G_agama", "");
		$master_siswa->setAdvancedSearch("y_G_agama", "");
		$master_siswa->setAdvancedSearch("x_G_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("z_G_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("y_G_kewarganegaraan", "");
		$master_siswa->setAdvancedSearch("x_G_pendidikan", "");
		$master_siswa->setAdvancedSearch("z_G_pendidikan", "");
		$master_siswa->setAdvancedSearch("y_G_pendidikan", "");
		$master_siswa->setAdvancedSearch("x_G_pekerjaan", "");
		$master_siswa->setAdvancedSearch("z_G_pekerjaan", "");
		$master_siswa->setAdvancedSearch("y_G_pekerjaan", "");
		$master_siswa->setAdvancedSearch("x_G_pengeluaran", "");
		$master_siswa->setAdvancedSearch("z_G_pengeluaran", "");
		$master_siswa->setAdvancedSearch("y_G_pengeluaran", "");
		$master_siswa->setAdvancedSearch("x_G_alamat", "");
		$master_siswa->setAdvancedSearch("z_G_alamat", "");
		$master_siswa->setAdvancedSearch("y_G_alamat", "");
		$master_siswa->setAdvancedSearch("x_G_telepon", "");
		$master_siswa->setAdvancedSearch("z_G_telepon", "");
		$master_siswa->setAdvancedSearch("y_G_telepon", "");
		$master_siswa->setAdvancedSearch("x_G_hp", "");
		$master_siswa->setAdvancedSearch("z_G_hp", "");
		$master_siswa->setAdvancedSearch("y_G_hp", "");
		$master_siswa->setAdvancedSearch("x_H_kesenian", "");
		$master_siswa->setAdvancedSearch("z_H_kesenian", "");
		$master_siswa->setAdvancedSearch("y_H_kesenian", "");
		$master_siswa->setAdvancedSearch("x_H_olahraga", "");
		$master_siswa->setAdvancedSearch("z_H_olahraga", "");
		$master_siswa->setAdvancedSearch("y_H_olahraga", "");
		$master_siswa->setAdvancedSearch("x_H_kemasyarakatan", "");
		$master_siswa->setAdvancedSearch("z_H_kemasyarakatan", "");
		$master_siswa->setAdvancedSearch("y_H_kemasyarakatan", "");
		$master_siswa->setAdvancedSearch("x_H_lainlain", "");
		$master_siswa->setAdvancedSearch("z_H_lainlain", "");
		$master_siswa->setAdvancedSearch("y_H_lainlain", "");
		$master_siswa->setAdvancedSearch("x_I_tanggal_meninggalkan", "");
		$master_siswa->setAdvancedSearch("z_I_tanggal_meninggalkan", "");
		$master_siswa->setAdvancedSearch("y_I_tanggal_meninggalkan", "");
		$master_siswa->setAdvancedSearch("x_I_alasan", "");
		$master_siswa->setAdvancedSearch("z_I_alasan", "");
		$master_siswa->setAdvancedSearch("y_I_alasan", "");
		$master_siswa->setAdvancedSearch("x_I_tanggal_lulus", "");
		$master_siswa->setAdvancedSearch("z_I_tanggal_lulus", "");
		$master_siswa->setAdvancedSearch("y_I_tanggal_lulus", "");
		$master_siswa->setAdvancedSearch("x_I_sttb", "");
		$master_siswa->setAdvancedSearch("z_I_sttb", "");
		$master_siswa->setAdvancedSearch("y_I_sttb", "");
		$master_siswa->setAdvancedSearch("x_I_danum", "");
		$master_siswa->setAdvancedSearch("z_I_danum", "");
		$master_siswa->setAdvancedSearch("y_I_danum", "");
		$master_siswa->setAdvancedSearch("x_I_nilai_danum_smp", "");
		$master_siswa->setAdvancedSearch("z_I_nilai_danum_smp", "");
		$master_siswa->setAdvancedSearch("y_I_nilai_danum_smp", "");
		$master_siswa->setAdvancedSearch("x_I_tahun1", "");
		$master_siswa->setAdvancedSearch("z_I_tahun1", "");
		$master_siswa->setAdvancedSearch("y_I_tahun1", "");
		$master_siswa->setAdvancedSearch("x_I_tahun2", "");
		$master_siswa->setAdvancedSearch("z_I_tahun2", "");
		$master_siswa->setAdvancedSearch("y_I_tahun2", "");
		$master_siswa->setAdvancedSearch("x_I_tahun3", "");
		$master_siswa->setAdvancedSearch("z_I_tahun3", "");
		$master_siswa->setAdvancedSearch("y_I_tahun3", "");
		$master_siswa->setAdvancedSearch("x_I_tk1", "");
		$master_siswa->setAdvancedSearch("z_I_tk1", "");
		$master_siswa->setAdvancedSearch("y_I_tk1", "");
		$master_siswa->setAdvancedSearch("x_I_tk2", "");
		$master_siswa->setAdvancedSearch("z_I_tk2", "");
		$master_siswa->setAdvancedSearch("y_I_tk2", "");
		$master_siswa->setAdvancedSearch("x_I_tk3", "");
		$master_siswa->setAdvancedSearch("z_I_tk3", "");
		$master_siswa->setAdvancedSearch("y_I_tk3", "");
		$master_siswa->setAdvancedSearch("x_I_dari1", "");
		$master_siswa->setAdvancedSearch("z_I_dari1", "");
		$master_siswa->setAdvancedSearch("y_I_dari1", "");
		$master_siswa->setAdvancedSearch("x_I_dari2", "");
		$master_siswa->setAdvancedSearch("z_I_dari2", "");
		$master_siswa->setAdvancedSearch("y_I_dari2", "");
		$master_siswa->setAdvancedSearch("x_I_dari3", "");
		$master_siswa->setAdvancedSearch("z_I_dari3", "");
		$master_siswa->setAdvancedSearch("y_I_dari3", "");
		$master_siswa->setAdvancedSearch("x_J_melanjutkan", "");
		$master_siswa->setAdvancedSearch("z_J_melanjutkan", "");
		$master_siswa->setAdvancedSearch("y_J_melanjutkan", "");
		$master_siswa->setAdvancedSearch("x_J_tanggal_bekerja", "");
		$master_siswa->setAdvancedSearch("z_J_tanggal_bekerja", "");
		$master_siswa->setAdvancedSearch("y_J_tanggal_bekerja", "");
		$master_siswa->setAdvancedSearch("x_J_nama_perusahaan", "");
		$master_siswa->setAdvancedSearch("z_J_nama_perusahaan", "");
		$master_siswa->setAdvancedSearch("y_J_nama_perusahaan", "");
		$master_siswa->setAdvancedSearch("x_J_penghasilan", "");
		$master_siswa->setAdvancedSearch("z_J_penghasilan", "");
		$master_siswa->setAdvancedSearch("y_J_penghasilan", "");
		$master_siswa->setAdvancedSearch("x_kode_otomatis", "");
		$master_siswa->setAdvancedSearch("z_kode_otomatis", "");
		$master_siswa->setAdvancedSearch("y_kode_otomatis", "");
		$master_siswa->setAdvancedSearch("x_apakah_valid", "");
		$master_siswa->setAdvancedSearch("z_apakah_valid", "");
		$master_siswa->setAdvancedSearch("y_apakah_valid", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $master_siswa;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_no_absen"] <> "") $bRestore = FALSE;
		if (@$_GET["y_no_absen"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_nis_nasional"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_nis_nasional"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_nama_Lengkap"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_nama_Lengkap"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_nama_panggilan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_nama_panggilan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_jenis_kelamin"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_jenis_kelamin"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_tempat_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_tempat_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_tanggal_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_tanggal_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_agama"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_agama"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_kewarganegaraan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_kewarganegaraan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_anak_keberapa"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_anak_keberapa"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_jumlah_saudara_kandung"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_jumlah_saudara_kandung"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_jumlah_saudara_tiri"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_jumlah_saudara_tiri"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_jumlah_saudara_angkat"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_jumlah_saudara_angkat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_status_yatim"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_status_yatim"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_bahasa"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_bahasa"] <> "") $bRestore = FALSE;
		if (@$_GET["x_B_alamat"] <> "") $bRestore = FALSE;
		if (@$_GET["y_B_alamat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_B_telepon_rumah"] <> "") $bRestore = FALSE;
		if (@$_GET["y_B_telepon_rumah"] <> "") $bRestore = FALSE;
		if (@$_GET["x_B_tinggal"] <> "") $bRestore = FALSE;
		if (@$_GET["y_B_tinggal"] <> "") $bRestore = FALSE;
		if (@$_GET["x_B_jarak"] <> "") $bRestore = FALSE;
		if (@$_GET["y_B_jarak"] <> "") $bRestore = FALSE;
		if (@$_GET["x_B_hp"] <> "") $bRestore = FALSE;
		if (@$_GET["y_B_hp"] <> "") $bRestore = FALSE;
		if (@$_GET["x_C_golongan_darah"] <> "") $bRestore = FALSE;
		if (@$_GET["y_C_golongan_darah"] <> "") $bRestore = FALSE;
		if (@$_GET["x_C_penyakit"] <> "") $bRestore = FALSE;
		if (@$_GET["y_C_penyakit"] <> "") $bRestore = FALSE;
		if (@$_GET["x_C_jasmani"] <> "") $bRestore = FALSE;
		if (@$_GET["y_C_jasmani"] <> "") $bRestore = FALSE;
		if (@$_GET["x_C_tinggi"] <> "") $bRestore = FALSE;
		if (@$_GET["y_C_tinggi"] <> "") $bRestore = FALSE;
		if (@$_GET["x_C_berat"] <> "") $bRestore = FALSE;
		if (@$_GET["y_C_berat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_tamatan_dari"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_tamatan_dari"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_sttb"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_sttb"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_tanggal_sttb"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_tanggal_sttb"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_danum"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_danum"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_tanggal_danum"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_tanggal_danum"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_lama_belajar"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_lama_belajar"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_dari_sekolah"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_dari_sekolah"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_alasan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_alasan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_kelas"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_kelas"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_kelompok"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_kelompok"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_tanggal"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_tanggal"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_saat_ini_tingkat"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_saat_ini_tingkat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_saat_ini_kelas"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_saat_ini_kelas"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_saat_ini_kelompok"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_saat_ini_kelompok"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_no_psb"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_no_psb"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_nilai_danum_sd"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_nilai_danum_sd"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_jumlah_pelajaran_danum"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_jumlah_pelajaran_danum"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_nilai_ujian_psb"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_nilai_ujian_psb"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_tahun_psb"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_tahun_psb"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_diterima"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_diterima"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_spp"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_spp"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_spp_potongan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_spp_potongan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_D_status_lama_baru"] <> "") $bRestore = FALSE;
		if (@$_GET["y_D_status_lama_baru"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_nama_ayah"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_nama_ayah"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_tempat_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_tempat_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_tanggal_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_tanggal_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_agama"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_agama"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_kewarganegaraan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_kewarganegaraan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_pendidikan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_pendidikan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_pekerjaan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_pekerjaan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_pengeluaran"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_pengeluaran"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_alamat"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_alamat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_telepon"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_telepon"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_hp"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_hp"] <> "") $bRestore = FALSE;
		if (@$_GET["x_E_hidup"] <> "") $bRestore = FALSE;
		if (@$_GET["y_E_hidup"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_nama_ibu"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_nama_ibu"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_tempat_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_tempat_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_tanggal_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_tanggal_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_agama"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_agama"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_kewarganegaraan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_kewarganegaraan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_pendidikan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_pendidikan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_pekerjaan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_pekerjaan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_pengeluaran"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_pengeluaran"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_alamat"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_alamat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_telepon"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_telepon"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_hp"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_hp"] <> "") $bRestore = FALSE;
		if (@$_GET["x_F_hidup"] <> "") $bRestore = FALSE;
		if (@$_GET["y_F_hidup"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_nama_wali"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_nama_wali"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_tempat_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_tempat_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_tanggal_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_tanggal_lahir"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_agama"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_agama"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_kewarganegaraan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_kewarganegaraan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_pendidikan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_pendidikan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_pekerjaan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_pekerjaan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_pengeluaran"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_pengeluaran"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_alamat"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_alamat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_telepon"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_telepon"] <> "") $bRestore = FALSE;
		if (@$_GET["x_G_hp"] <> "") $bRestore = FALSE;
		if (@$_GET["y_G_hp"] <> "") $bRestore = FALSE;
		if (@$_GET["x_H_kesenian"] <> "") $bRestore = FALSE;
		if (@$_GET["y_H_kesenian"] <> "") $bRestore = FALSE;
		if (@$_GET["x_H_olahraga"] <> "") $bRestore = FALSE;
		if (@$_GET["y_H_olahraga"] <> "") $bRestore = FALSE;
		if (@$_GET["x_H_kemasyarakatan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_H_kemasyarakatan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_H_lainlain"] <> "") $bRestore = FALSE;
		if (@$_GET["y_H_lainlain"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_tanggal_meninggalkan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_tanggal_meninggalkan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_alasan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_alasan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_tanggal_lulus"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_tanggal_lulus"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_sttb"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_sttb"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_danum"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_danum"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_nilai_danum_smp"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_nilai_danum_smp"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_tahun1"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_tahun1"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_tahun2"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_tahun2"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_tahun3"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_tahun3"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_tk1"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_tk1"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_tk2"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_tk2"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_tk3"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_tk3"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_dari1"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_dari1"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_dari2"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_dari2"] <> "") $bRestore = FALSE;
		if (@$_GET["x_I_dari3"] <> "") $bRestore = FALSE;
		if (@$_GET["y_I_dari3"] <> "") $bRestore = FALSE;
		if (@$_GET["x_J_melanjutkan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_J_melanjutkan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_J_tanggal_bekerja"] <> "") $bRestore = FALSE;
		if (@$_GET["y_J_tanggal_bekerja"] <> "") $bRestore = FALSE;
		if (@$_GET["x_J_nama_perusahaan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_J_nama_perusahaan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_J_penghasilan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_J_penghasilan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_kode_otomatis"] <> "") $bRestore = FALSE;
		if (@$_GET["y_kode_otomatis"] <> "") $bRestore = FALSE;
		if (@$_GET["x_apakah_valid"] <> "") $bRestore = FALSE;
		if (@$_GET["y_apakah_valid"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$master_siswa->BasicSearchKeyword = $master_siswa->getSessionBasicSearchKeyword();
			$master_siswa->BasicSearchType = $master_siswa->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($master_siswa->no_absen);
			$this->GetSearchParm($master_siswa->A_nis_nasional);
			$this->GetSearchParm($master_siswa->A_nama_Lengkap);
			$this->GetSearchParm($master_siswa->A_nama_panggilan);
			$this->GetSearchParm($master_siswa->A_jenis_kelamin);
			$this->GetSearchParm($master_siswa->A_tempat_lahir);
			$this->GetSearchParm($master_siswa->A_tanggal_lahir);
			$this->GetSearchParm($master_siswa->A_agama);
			$this->GetSearchParm($master_siswa->A_kewarganegaraan);
			$this->GetSearchParm($master_siswa->A_anak_keberapa);
			$this->GetSearchParm($master_siswa->A_jumlah_saudara_kandung);
			$this->GetSearchParm($master_siswa->A_jumlah_saudara_tiri);
			$this->GetSearchParm($master_siswa->A_jumlah_saudara_angkat);
			$this->GetSearchParm($master_siswa->A_status_yatim);
			$this->GetSearchParm($master_siswa->A_bahasa);
			$this->GetSearchParm($master_siswa->B_alamat);
			$this->GetSearchParm($master_siswa->B_telepon_rumah);
			$this->GetSearchParm($master_siswa->B_tinggal);
			$this->GetSearchParm($master_siswa->B_jarak);
			$this->GetSearchParm($master_siswa->B_hp);
			$this->GetSearchParm($master_siswa->C_golongan_darah);
			$this->GetSearchParm($master_siswa->C_penyakit);
			$this->GetSearchParm($master_siswa->C_jasmani);
			$this->GetSearchParm($master_siswa->C_tinggi);
			$this->GetSearchParm($master_siswa->C_berat);
			$this->GetSearchParm($master_siswa->D_tamatan_dari);
			$this->GetSearchParm($master_siswa->D_sttb);
			$this->GetSearchParm($master_siswa->D_tanggal_sttb);
			$this->GetSearchParm($master_siswa->D_danum);
			$this->GetSearchParm($master_siswa->D_tanggal_danum);
			$this->GetSearchParm($master_siswa->D_lama_belajar);
			$this->GetSearchParm($master_siswa->D_dari_sekolah);
			$this->GetSearchParm($master_siswa->D_alasan);
			$this->GetSearchParm($master_siswa->D_kelas);
			$this->GetSearchParm($master_siswa->D_kelompok);
			$this->GetSearchParm($master_siswa->D_tanggal);
			$this->GetSearchParm($master_siswa->D_saat_ini_tingkat);
			$this->GetSearchParm($master_siswa->D_saat_ini_kelas);
			$this->GetSearchParm($master_siswa->D_saat_ini_kelompok);
			$this->GetSearchParm($master_siswa->D_no_psb);
			$this->GetSearchParm($master_siswa->D_nilai_danum_sd);
			$this->GetSearchParm($master_siswa->D_jumlah_pelajaran_danum);
			$this->GetSearchParm($master_siswa->D_nilai_ujian_psb);
			$this->GetSearchParm($master_siswa->D_tahun_psb);
			$this->GetSearchParm($master_siswa->D_diterima);
			$this->GetSearchParm($master_siswa->D_spp);
			$this->GetSearchParm($master_siswa->D_spp_potongan);
			$this->GetSearchParm($master_siswa->D_status_lama_baru);
			$this->GetSearchParm($master_siswa->E_nama_ayah);
			$this->GetSearchParm($master_siswa->E_tempat_lahir);
			$this->GetSearchParm($master_siswa->E_tanggal_lahir);
			$this->GetSearchParm($master_siswa->E_agama);
			$this->GetSearchParm($master_siswa->E_kewarganegaraan);
			$this->GetSearchParm($master_siswa->E_pendidikan);
			$this->GetSearchParm($master_siswa->E_pekerjaan);
			$this->GetSearchParm($master_siswa->E_pengeluaran);
			$this->GetSearchParm($master_siswa->E_alamat);
			$this->GetSearchParm($master_siswa->E_telepon);
			$this->GetSearchParm($master_siswa->E_hp);
			$this->GetSearchParm($master_siswa->E_hidup);
			$this->GetSearchParm($master_siswa->F_nama_ibu);
			$this->GetSearchParm($master_siswa->F_tempat_lahir);
			$this->GetSearchParm($master_siswa->F_tanggal_lahir);
			$this->GetSearchParm($master_siswa->F_agama);
			$this->GetSearchParm($master_siswa->F_kewarganegaraan);
			$this->GetSearchParm($master_siswa->F_pendidikan);
			$this->GetSearchParm($master_siswa->F_pekerjaan);
			$this->GetSearchParm($master_siswa->F_pengeluaran);
			$this->GetSearchParm($master_siswa->F_alamat);
			$this->GetSearchParm($master_siswa->F_telepon);
			$this->GetSearchParm($master_siswa->F_hp);
			$this->GetSearchParm($master_siswa->F_hidup);
			$this->GetSearchParm($master_siswa->G_nama_wali);
			$this->GetSearchParm($master_siswa->G_tempat_lahir);
			$this->GetSearchParm($master_siswa->G_tanggal_lahir);
			$this->GetSearchParm($master_siswa->G_agama);
			$this->GetSearchParm($master_siswa->G_kewarganegaraan);
			$this->GetSearchParm($master_siswa->G_pendidikan);
			$this->GetSearchParm($master_siswa->G_pekerjaan);
			$this->GetSearchParm($master_siswa->G_pengeluaran);
			$this->GetSearchParm($master_siswa->G_alamat);
			$this->GetSearchParm($master_siswa->G_telepon);
			$this->GetSearchParm($master_siswa->G_hp);
			$this->GetSearchParm($master_siswa->H_kesenian);
			$this->GetSearchParm($master_siswa->H_olahraga);
			$this->GetSearchParm($master_siswa->H_kemasyarakatan);
			$this->GetSearchParm($master_siswa->H_lainlain);
			$this->GetSearchParm($master_siswa->I_tanggal_meninggalkan);
			$this->GetSearchParm($master_siswa->I_alasan);
			$this->GetSearchParm($master_siswa->I_tanggal_lulus);
			$this->GetSearchParm($master_siswa->I_sttb);
			$this->GetSearchParm($master_siswa->I_danum);
			$this->GetSearchParm($master_siswa->I_nilai_danum_smp);
			$this->GetSearchParm($master_siswa->I_tahun1);
			$this->GetSearchParm($master_siswa->I_tahun2);
			$this->GetSearchParm($master_siswa->I_tahun3);
			$this->GetSearchParm($master_siswa->I_tk1);
			$this->GetSearchParm($master_siswa->I_tk2);
			$this->GetSearchParm($master_siswa->I_tk3);
			$this->GetSearchParm($master_siswa->I_dari1);
			$this->GetSearchParm($master_siswa->I_dari2);
			$this->GetSearchParm($master_siswa->I_dari3);
			$this->GetSearchParm($master_siswa->J_melanjutkan);
			$this->GetSearchParm($master_siswa->J_tanggal_bekerja);
			$this->GetSearchParm($master_siswa->J_nama_perusahaan);
			$this->GetSearchParm($master_siswa->J_penghasilan);
			$this->GetSearchParm($master_siswa->kode_otomatis);
			$this->GetSearchParm($master_siswa->apakah_valid);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $master_siswa;

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$master_siswa->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$master_siswa->CurrentOrderType = @$_GET["ordertype"];
			$master_siswa->UpdateSort($master_siswa->no_absen, $bCtrl); // no_absen
			$master_siswa->UpdateSort($master_siswa->A_nis_nasional, $bCtrl); // A_nis_nasional
			$master_siswa->UpdateSort($master_siswa->A_nama_Lengkap, $bCtrl); // A_nama_Lengkap
			$master_siswa->UpdateSort($master_siswa->A_nama_panggilan, $bCtrl); // A_nama_panggilan
			$master_siswa->UpdateSort($master_siswa->A_jenis_kelamin, $bCtrl); // A_jenis_kelamin
			$master_siswa->UpdateSort($master_siswa->A_tempat_lahir, $bCtrl); // A_tempat_lahir
			$master_siswa->UpdateSort($master_siswa->A_tanggal_lahir, $bCtrl); // A_tanggal_lahir
			$master_siswa->UpdateSort($master_siswa->A_agama, $bCtrl); // A_agama
			$master_siswa->UpdateSort($master_siswa->A_kewarganegaraan, $bCtrl); // A_kewarganegaraan
			$master_siswa->UpdateSort($master_siswa->A_anak_keberapa, $bCtrl); // A_anak_keberapa
			$master_siswa->UpdateSort($master_siswa->A_jumlah_saudara_kandung, $bCtrl); // A_jumlah_saudara_kandung
			$master_siswa->UpdateSort($master_siswa->A_jumlah_saudara_tiri, $bCtrl); // A_jumlah_saudara_tiri
			$master_siswa->UpdateSort($master_siswa->A_jumlah_saudara_angkat, $bCtrl); // A_jumlah_saudara_angkat
			$master_siswa->UpdateSort($master_siswa->A_status_yatim, $bCtrl); // A_status_yatim
			$master_siswa->UpdateSort($master_siswa->A_bahasa, $bCtrl); // A_bahasa
			$master_siswa->UpdateSort($master_siswa->B_alamat, $bCtrl); // B_alamat
			$master_siswa->UpdateSort($master_siswa->B_telepon_rumah, $bCtrl); // B_telepon_rumah
			$master_siswa->UpdateSort($master_siswa->B_tinggal, $bCtrl); // B_tinggal
			$master_siswa->UpdateSort($master_siswa->B_jarak, $bCtrl); // B_jarak
			$master_siswa->UpdateSort($master_siswa->B_hp, $bCtrl); // B_hp
			$master_siswa->UpdateSort($master_siswa->C_golongan_darah, $bCtrl); // C_golongan_darah
			$master_siswa->UpdateSort($master_siswa->C_penyakit, $bCtrl); // C_penyakit
			$master_siswa->UpdateSort($master_siswa->C_jasmani, $bCtrl); // C_jasmani
			$master_siswa->UpdateSort($master_siswa->C_tinggi, $bCtrl); // C_tinggi
			$master_siswa->UpdateSort($master_siswa->C_berat, $bCtrl); // C_berat
			$master_siswa->UpdateSort($master_siswa->D_tamatan_dari, $bCtrl); // D_tamatan_dari
			$master_siswa->UpdateSort($master_siswa->D_sttb, $bCtrl); // D_sttb
			$master_siswa->UpdateSort($master_siswa->D_tanggal_sttb, $bCtrl); // D_tanggal_sttb
			$master_siswa->UpdateSort($master_siswa->D_danum, $bCtrl); // D_danum
			$master_siswa->UpdateSort($master_siswa->D_tanggal_danum, $bCtrl); // D_tanggal_danum
			$master_siswa->UpdateSort($master_siswa->D_lama_belajar, $bCtrl); // D_lama_belajar
			$master_siswa->UpdateSort($master_siswa->D_dari_sekolah, $bCtrl); // D_dari_sekolah
			$master_siswa->UpdateSort($master_siswa->D_alasan, $bCtrl); // D_alasan
			$master_siswa->UpdateSort($master_siswa->D_kelas, $bCtrl); // D_kelas
			$master_siswa->UpdateSort($master_siswa->D_kelompok, $bCtrl); // D_kelompok
			$master_siswa->UpdateSort($master_siswa->D_tanggal, $bCtrl); // D_tanggal
			$master_siswa->UpdateSort($master_siswa->D_saat_ini_tingkat, $bCtrl); // D_saat_ini_tingkat
			$master_siswa->UpdateSort($master_siswa->D_saat_ini_kelas, $bCtrl); // D_saat_ini_kelas
			$master_siswa->UpdateSort($master_siswa->D_saat_ini_kelompok, $bCtrl); // D_saat_ini_kelompok
			$master_siswa->UpdateSort($master_siswa->D_no_psb, $bCtrl); // D_no_psb
			$master_siswa->UpdateSort($master_siswa->D_nilai_danum_sd, $bCtrl); // D_nilai_danum_sd
			$master_siswa->UpdateSort($master_siswa->D_jumlah_pelajaran_danum, $bCtrl); // D_jumlah_pelajaran_danum
			$master_siswa->UpdateSort($master_siswa->D_nilai_ujian_psb, $bCtrl); // D_nilai_ujian_psb
			$master_siswa->UpdateSort($master_siswa->D_tahun_psb, $bCtrl); // D_tahun_psb
			$master_siswa->UpdateSort($master_siswa->D_diterima, $bCtrl); // D_diterima
			$master_siswa->UpdateSort($master_siswa->D_spp, $bCtrl); // D_spp
			$master_siswa->UpdateSort($master_siswa->D_spp_potongan, $bCtrl); // D_spp_potongan
			$master_siswa->UpdateSort($master_siswa->D_status_lama_baru, $bCtrl); // D_status_lama_baru
			$master_siswa->UpdateSort($master_siswa->E_nama_ayah, $bCtrl); // E_nama_ayah
			$master_siswa->UpdateSort($master_siswa->E_tempat_lahir, $bCtrl); // E_tempat_lahir
			$master_siswa->UpdateSort($master_siswa->E_tanggal_lahir, $bCtrl); // E_tanggal_lahir
			$master_siswa->UpdateSort($master_siswa->E_agama, $bCtrl); // E_agama
			$master_siswa->UpdateSort($master_siswa->E_kewarganegaraan, $bCtrl); // E_kewarganegaraan
			$master_siswa->UpdateSort($master_siswa->E_pendidikan, $bCtrl); // E_pendidikan
			$master_siswa->UpdateSort($master_siswa->E_pekerjaan, $bCtrl); // E_pekerjaan
			$master_siswa->UpdateSort($master_siswa->E_pengeluaran, $bCtrl); // E_pengeluaran
			$master_siswa->UpdateSort($master_siswa->E_alamat, $bCtrl); // E_alamat
			$master_siswa->UpdateSort($master_siswa->E_telepon, $bCtrl); // E_telepon
			$master_siswa->UpdateSort($master_siswa->E_hp, $bCtrl); // E_hp
			$master_siswa->UpdateSort($master_siswa->E_hidup, $bCtrl); // E_hidup
			$master_siswa->UpdateSort($master_siswa->F_nama_ibu, $bCtrl); // F_nama_ibu
			$master_siswa->UpdateSort($master_siswa->F_tempat_lahir, $bCtrl); // F_tempat_lahir
			$master_siswa->UpdateSort($master_siswa->F_tanggal_lahir, $bCtrl); // F_tanggal_lahir
			$master_siswa->UpdateSort($master_siswa->F_agama, $bCtrl); // F_agama
			$master_siswa->UpdateSort($master_siswa->F_kewarganegaraan, $bCtrl); // F_kewarganegaraan
			$master_siswa->UpdateSort($master_siswa->F_pendidikan, $bCtrl); // F_pendidikan
			$master_siswa->UpdateSort($master_siswa->F_pekerjaan, $bCtrl); // F_pekerjaan
			$master_siswa->UpdateSort($master_siswa->F_pengeluaran, $bCtrl); // F_pengeluaran
			$master_siswa->UpdateSort($master_siswa->F_alamat, $bCtrl); // F_alamat
			$master_siswa->UpdateSort($master_siswa->F_telepon, $bCtrl); // F_telepon
			$master_siswa->UpdateSort($master_siswa->F_hp, $bCtrl); // F_hp
			$master_siswa->UpdateSort($master_siswa->F_hidup, $bCtrl); // F_hidup
			$master_siswa->UpdateSort($master_siswa->G_nama_wali, $bCtrl); // G_nama_wali
			$master_siswa->UpdateSort($master_siswa->G_tempat_lahir, $bCtrl); // G_tempat_lahir
			$master_siswa->UpdateSort($master_siswa->G_tanggal_lahir, $bCtrl); // G_tanggal_lahir
			$master_siswa->UpdateSort($master_siswa->G_agama, $bCtrl); // G_agama
			$master_siswa->UpdateSort($master_siswa->G_kewarganegaraan, $bCtrl); // G_kewarganegaraan
			$master_siswa->UpdateSort($master_siswa->G_pendidikan, $bCtrl); // G_pendidikan
			$master_siswa->UpdateSort($master_siswa->G_pekerjaan, $bCtrl); // G_pekerjaan
			$master_siswa->UpdateSort($master_siswa->G_pengeluaran, $bCtrl); // G_pengeluaran
			$master_siswa->UpdateSort($master_siswa->G_alamat, $bCtrl); // G_alamat
			$master_siswa->UpdateSort($master_siswa->G_telepon, $bCtrl); // G_telepon
			$master_siswa->UpdateSort($master_siswa->G_hp, $bCtrl); // G_hp
			$master_siswa->UpdateSort($master_siswa->H_kesenian, $bCtrl); // H_kesenian
			$master_siswa->UpdateSort($master_siswa->H_olahraga, $bCtrl); // H_olahraga
			$master_siswa->UpdateSort($master_siswa->H_kemasyarakatan, $bCtrl); // H_kemasyarakatan
			$master_siswa->UpdateSort($master_siswa->H_lainlain, $bCtrl); // H_lainlain
			$master_siswa->UpdateSort($master_siswa->I_tanggal_meninggalkan, $bCtrl); // I_tanggal_meninggalkan
			$master_siswa->UpdateSort($master_siswa->I_alasan, $bCtrl); // I_alasan
			$master_siswa->UpdateSort($master_siswa->I_tanggal_lulus, $bCtrl); // I_tanggal_lulus
			$master_siswa->UpdateSort($master_siswa->I_sttb, $bCtrl); // I_sttb
			$master_siswa->UpdateSort($master_siswa->I_danum, $bCtrl); // I_danum
			$master_siswa->UpdateSort($master_siswa->I_nilai_danum_smp, $bCtrl); // I_nilai_danum_smp
			$master_siswa->UpdateSort($master_siswa->I_tahun1, $bCtrl); // I_tahun1
			$master_siswa->UpdateSort($master_siswa->I_tahun2, $bCtrl); // I_tahun2
			$master_siswa->UpdateSort($master_siswa->I_tahun3, $bCtrl); // I_tahun3
			$master_siswa->UpdateSort($master_siswa->I_tk1, $bCtrl); // I_tk1
			$master_siswa->UpdateSort($master_siswa->I_tk2, $bCtrl); // I_tk2
			$master_siswa->UpdateSort($master_siswa->I_tk3, $bCtrl); // I_tk3
			$master_siswa->UpdateSort($master_siswa->I_dari1, $bCtrl); // I_dari1
			$master_siswa->UpdateSort($master_siswa->I_dari2, $bCtrl); // I_dari2
			$master_siswa->UpdateSort($master_siswa->I_dari3, $bCtrl); // I_dari3
			$master_siswa->UpdateSort($master_siswa->J_melanjutkan, $bCtrl); // J_melanjutkan
			$master_siswa->UpdateSort($master_siswa->J_tanggal_bekerja, $bCtrl); // J_tanggal_bekerja
			$master_siswa->UpdateSort($master_siswa->J_nama_perusahaan, $bCtrl); // J_nama_perusahaan
			$master_siswa->UpdateSort($master_siswa->J_penghasilan, $bCtrl); // J_penghasilan
			$master_siswa->UpdateSort($master_siswa->kode_otomatis, $bCtrl); // kode_otomatis
			$master_siswa->UpdateSort($master_siswa->apakah_valid, $bCtrl); // apakah_valid
			$master_siswa->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $master_siswa;
		$sOrderBy = $master_siswa->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($master_siswa->SqlOrderBy() <> "") {
				$sOrderBy = $master_siswa->SqlOrderBy();
				$master_siswa->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $master_siswa;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$master_siswa->setSessionOrderBy($sOrderBy);
				$master_siswa->no_absen->setSort("");
				$master_siswa->A_nis_nasional->setSort("");
				$master_siswa->A_nama_Lengkap->setSort("");
				$master_siswa->A_nama_panggilan->setSort("");
				$master_siswa->A_jenis_kelamin->setSort("");
				$master_siswa->A_tempat_lahir->setSort("");
				$master_siswa->A_tanggal_lahir->setSort("");
				$master_siswa->A_agama->setSort("");
				$master_siswa->A_kewarganegaraan->setSort("");
				$master_siswa->A_anak_keberapa->setSort("");
				$master_siswa->A_jumlah_saudara_kandung->setSort("");
				$master_siswa->A_jumlah_saudara_tiri->setSort("");
				$master_siswa->A_jumlah_saudara_angkat->setSort("");
				$master_siswa->A_status_yatim->setSort("");
				$master_siswa->A_bahasa->setSort("");
				$master_siswa->B_alamat->setSort("");
				$master_siswa->B_telepon_rumah->setSort("");
				$master_siswa->B_tinggal->setSort("");
				$master_siswa->B_jarak->setSort("");
				$master_siswa->B_hp->setSort("");
				$master_siswa->C_golongan_darah->setSort("");
				$master_siswa->C_penyakit->setSort("");
				$master_siswa->C_jasmani->setSort("");
				$master_siswa->C_tinggi->setSort("");
				$master_siswa->C_berat->setSort("");
				$master_siswa->D_tamatan_dari->setSort("");
				$master_siswa->D_sttb->setSort("");
				$master_siswa->D_tanggal_sttb->setSort("");
				$master_siswa->D_danum->setSort("");
				$master_siswa->D_tanggal_danum->setSort("");
				$master_siswa->D_lama_belajar->setSort("");
				$master_siswa->D_dari_sekolah->setSort("");
				$master_siswa->D_alasan->setSort("");
				$master_siswa->D_kelas->setSort("");
				$master_siswa->D_kelompok->setSort("");
				$master_siswa->D_tanggal->setSort("");
				$master_siswa->D_saat_ini_tingkat->setSort("");
				$master_siswa->D_saat_ini_kelas->setSort("");
				$master_siswa->D_saat_ini_kelompok->setSort("");
				$master_siswa->D_no_psb->setSort("");
				$master_siswa->D_nilai_danum_sd->setSort("");
				$master_siswa->D_jumlah_pelajaran_danum->setSort("");
				$master_siswa->D_nilai_ujian_psb->setSort("");
				$master_siswa->D_tahun_psb->setSort("");
				$master_siswa->D_diterima->setSort("");
				$master_siswa->D_spp->setSort("");
				$master_siswa->D_spp_potongan->setSort("");
				$master_siswa->D_status_lama_baru->setSort("");
				$master_siswa->E_nama_ayah->setSort("");
				$master_siswa->E_tempat_lahir->setSort("");
				$master_siswa->E_tanggal_lahir->setSort("");
				$master_siswa->E_agama->setSort("");
				$master_siswa->E_kewarganegaraan->setSort("");
				$master_siswa->E_pendidikan->setSort("");
				$master_siswa->E_pekerjaan->setSort("");
				$master_siswa->E_pengeluaran->setSort("");
				$master_siswa->E_alamat->setSort("");
				$master_siswa->E_telepon->setSort("");
				$master_siswa->E_hp->setSort("");
				$master_siswa->E_hidup->setSort("");
				$master_siswa->F_nama_ibu->setSort("");
				$master_siswa->F_tempat_lahir->setSort("");
				$master_siswa->F_tanggal_lahir->setSort("");
				$master_siswa->F_agama->setSort("");
				$master_siswa->F_kewarganegaraan->setSort("");
				$master_siswa->F_pendidikan->setSort("");
				$master_siswa->F_pekerjaan->setSort("");
				$master_siswa->F_pengeluaran->setSort("");
				$master_siswa->F_alamat->setSort("");
				$master_siswa->F_telepon->setSort("");
				$master_siswa->F_hp->setSort("");
				$master_siswa->F_hidup->setSort("");
				$master_siswa->G_nama_wali->setSort("");
				$master_siswa->G_tempat_lahir->setSort("");
				$master_siswa->G_tanggal_lahir->setSort("");
				$master_siswa->G_agama->setSort("");
				$master_siswa->G_kewarganegaraan->setSort("");
				$master_siswa->G_pendidikan->setSort("");
				$master_siswa->G_pekerjaan->setSort("");
				$master_siswa->G_pengeluaran->setSort("");
				$master_siswa->G_alamat->setSort("");
				$master_siswa->G_telepon->setSort("");
				$master_siswa->G_hp->setSort("");
				$master_siswa->H_kesenian->setSort("");
				$master_siswa->H_olahraga->setSort("");
				$master_siswa->H_kemasyarakatan->setSort("");
				$master_siswa->H_lainlain->setSort("");
				$master_siswa->I_tanggal_meninggalkan->setSort("");
				$master_siswa->I_alasan->setSort("");
				$master_siswa->I_tanggal_lulus->setSort("");
				$master_siswa->I_sttb->setSort("");
				$master_siswa->I_danum->setSort("");
				$master_siswa->I_nilai_danum_smp->setSort("");
				$master_siswa->I_tahun1->setSort("");
				$master_siswa->I_tahun2->setSort("");
				$master_siswa->I_tahun3->setSort("");
				$master_siswa->I_tk1->setSort("");
				$master_siswa->I_tk2->setSort("");
				$master_siswa->I_tk3->setSort("");
				$master_siswa->I_dari1->setSort("");
				$master_siswa->I_dari2->setSort("");
				$master_siswa->I_dari3->setSort("");
				$master_siswa->J_melanjutkan->setSort("");
				$master_siswa->J_tanggal_bekerja->setSort("");
				$master_siswa->J_nama_perusahaan->setSort("");
				$master_siswa->J_penghasilan->setSort("");
				$master_siswa->kode_otomatis->setSort("");
				$master_siswa->apakah_valid->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$master_siswa->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $master_siswa;

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

		// "checkbox"
		$item =& $this->ListOptions->Add("checkbox");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"master_siswa_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $master_siswa, $objForm;
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

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($master_siswa->kode_otomatis->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $master_siswa;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $master_siswa;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$master_siswa->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$master_siswa->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $master_siswa->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$master_siswa->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$master_siswa->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$master_siswa->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $master_siswa;
		$master_siswa->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$master_siswa->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $master_siswa;

		// Load search values
		// no_absen

		$master_siswa->no_absen->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_no_absen"]);
		$master_siswa->no_absen->AdvancedSearch->SearchOperator = @$_GET["z_no_absen"];
		$master_siswa->no_absen->AdvancedSearch->SearchCondition = @$_GET["v_no_absen"];
		$master_siswa->no_absen->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_no_absen"]);
		$master_siswa->no_absen->AdvancedSearch->SearchOperator2 = @$_GET["w_no_absen"];

		// A_nis_nasional
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_nis_nasional"]);
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator = @$_GET["z_A_nis_nasional"];
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchCondition = @$_GET["v_A_nis_nasional"];
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_nis_nasional"]);
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator2 = @$_GET["w_A_nis_nasional"];

		// A_nama_Lengkap
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_nama_Lengkap"]);
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator = @$_GET["z_A_nama_Lengkap"];
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchCondition = @$_GET["v_A_nama_Lengkap"];
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_nama_Lengkap"]);
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator2 = @$_GET["w_A_nama_Lengkap"];

		// A_nama_panggilan
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_nama_panggilan"]);
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator = @$_GET["z_A_nama_panggilan"];
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchCondition = @$_GET["v_A_nama_panggilan"];
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_nama_panggilan"]);
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator2 = @$_GET["w_A_nama_panggilan"];

		// A_jenis_kelamin
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_jenis_kelamin"]);
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator = @$_GET["z_A_jenis_kelamin"];
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchCondition = @$_GET["v_A_jenis_kelamin"];
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_jenis_kelamin"]);
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator2 = @$_GET["w_A_jenis_kelamin"];

		// A_tempat_lahir
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_tempat_lahir"]);
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator = @$_GET["z_A_tempat_lahir"];
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchCondition = @$_GET["v_A_tempat_lahir"];
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_tempat_lahir"]);
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator2 = @$_GET["w_A_tempat_lahir"];

		// A_tanggal_lahir
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_tanggal_lahir"]);
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator = @$_GET["z_A_tanggal_lahir"];
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchCondition = @$_GET["v_A_tanggal_lahir"];
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_tanggal_lahir"]);
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator2 = @$_GET["w_A_tanggal_lahir"];

		// A_agama
		$master_siswa->A_agama->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_agama"]);
		$master_siswa->A_agama->AdvancedSearch->SearchOperator = @$_GET["z_A_agama"];
		$master_siswa->A_agama->AdvancedSearch->SearchCondition = @$_GET["v_A_agama"];
		$master_siswa->A_agama->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_agama"]);
		$master_siswa->A_agama->AdvancedSearch->SearchOperator2 = @$_GET["w_A_agama"];

		// A_kewarganegaraan
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_kewarganegaraan"]);
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator = @$_GET["z_A_kewarganegaraan"];
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchCondition = @$_GET["v_A_kewarganegaraan"];
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_kewarganegaraan"]);
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator2 = @$_GET["w_A_kewarganegaraan"];

		// A_anak_keberapa
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_anak_keberapa"]);
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator = @$_GET["z_A_anak_keberapa"];
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchCondition = @$_GET["v_A_anak_keberapa"];
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_anak_keberapa"]);
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator2 = @$_GET["w_A_anak_keberapa"];

		// A_jumlah_saudara_kandung
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_jumlah_saudara_kandung"]);
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator = @$_GET["z_A_jumlah_saudara_kandung"];
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchCondition = @$_GET["v_A_jumlah_saudara_kandung"];
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_jumlah_saudara_kandung"]);
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator2 = @$_GET["w_A_jumlah_saudara_kandung"];

		// A_jumlah_saudara_tiri
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_jumlah_saudara_tiri"]);
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator = @$_GET["z_A_jumlah_saudara_tiri"];
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchCondition = @$_GET["v_A_jumlah_saudara_tiri"];
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_jumlah_saudara_tiri"]);
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator2 = @$_GET["w_A_jumlah_saudara_tiri"];

		// A_jumlah_saudara_angkat
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_jumlah_saudara_angkat"]);
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator = @$_GET["z_A_jumlah_saudara_angkat"];
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchCondition = @$_GET["v_A_jumlah_saudara_angkat"];
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_jumlah_saudara_angkat"]);
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator2 = @$_GET["w_A_jumlah_saudara_angkat"];

		// A_status_yatim
		$master_siswa->A_status_yatim->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_status_yatim"]);
		$master_siswa->A_status_yatim->AdvancedSearch->SearchOperator = @$_GET["z_A_status_yatim"];
		$master_siswa->A_status_yatim->AdvancedSearch->SearchCondition = @$_GET["v_A_status_yatim"];
		$master_siswa->A_status_yatim->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_status_yatim"]);
		$master_siswa->A_status_yatim->AdvancedSearch->SearchOperator2 = @$_GET["w_A_status_yatim"];

		// A_bahasa
		$master_siswa->A_bahasa->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_bahasa"]);
		$master_siswa->A_bahasa->AdvancedSearch->SearchOperator = @$_GET["z_A_bahasa"];
		$master_siswa->A_bahasa->AdvancedSearch->SearchCondition = @$_GET["v_A_bahasa"];
		$master_siswa->A_bahasa->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_bahasa"]);
		$master_siswa->A_bahasa->AdvancedSearch->SearchOperator2 = @$_GET["w_A_bahasa"];

		// B_alamat
		$master_siswa->B_alamat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_B_alamat"]);
		$master_siswa->B_alamat->AdvancedSearch->SearchOperator = @$_GET["z_B_alamat"];
		$master_siswa->B_alamat->AdvancedSearch->SearchCondition = @$_GET["v_B_alamat"];
		$master_siswa->B_alamat->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_B_alamat"]);
		$master_siswa->B_alamat->AdvancedSearch->SearchOperator2 = @$_GET["w_B_alamat"];

		// B_telepon_rumah
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_B_telepon_rumah"]);
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator = @$_GET["z_B_telepon_rumah"];
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchCondition = @$_GET["v_B_telepon_rumah"];
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_B_telepon_rumah"]);
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator2 = @$_GET["w_B_telepon_rumah"];

		// B_tinggal
		$master_siswa->B_tinggal->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_B_tinggal"]);
		$master_siswa->B_tinggal->AdvancedSearch->SearchOperator = @$_GET["z_B_tinggal"];
		$master_siswa->B_tinggal->AdvancedSearch->SearchCondition = @$_GET["v_B_tinggal"];
		$master_siswa->B_tinggal->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_B_tinggal"]);
		$master_siswa->B_tinggal->AdvancedSearch->SearchOperator2 = @$_GET["w_B_tinggal"];

		// B_jarak
		$master_siswa->B_jarak->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_B_jarak"]);
		$master_siswa->B_jarak->AdvancedSearch->SearchOperator = @$_GET["z_B_jarak"];
		$master_siswa->B_jarak->AdvancedSearch->SearchCondition = @$_GET["v_B_jarak"];
		$master_siswa->B_jarak->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_B_jarak"]);
		$master_siswa->B_jarak->AdvancedSearch->SearchOperator2 = @$_GET["w_B_jarak"];

		// B_hp
		$master_siswa->B_hp->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_B_hp"]);
		$master_siswa->B_hp->AdvancedSearch->SearchOperator = @$_GET["z_B_hp"];
		$master_siswa->B_hp->AdvancedSearch->SearchCondition = @$_GET["v_B_hp"];
		$master_siswa->B_hp->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_B_hp"]);
		$master_siswa->B_hp->AdvancedSearch->SearchOperator2 = @$_GET["w_B_hp"];

		// C_golongan_darah
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_C_golongan_darah"]);
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator = @$_GET["z_C_golongan_darah"];
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchCondition = @$_GET["v_C_golongan_darah"];
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_C_golongan_darah"]);
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator2 = @$_GET["w_C_golongan_darah"];

		// C_penyakit
		$master_siswa->C_penyakit->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_C_penyakit"]);
		$master_siswa->C_penyakit->AdvancedSearch->SearchOperator = @$_GET["z_C_penyakit"];
		$master_siswa->C_penyakit->AdvancedSearch->SearchCondition = @$_GET["v_C_penyakit"];
		$master_siswa->C_penyakit->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_C_penyakit"]);
		$master_siswa->C_penyakit->AdvancedSearch->SearchOperator2 = @$_GET["w_C_penyakit"];

		// C_jasmani
		$master_siswa->C_jasmani->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_C_jasmani"]);
		$master_siswa->C_jasmani->AdvancedSearch->SearchOperator = @$_GET["z_C_jasmani"];
		$master_siswa->C_jasmani->AdvancedSearch->SearchCondition = @$_GET["v_C_jasmani"];
		$master_siswa->C_jasmani->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_C_jasmani"]);
		$master_siswa->C_jasmani->AdvancedSearch->SearchOperator2 = @$_GET["w_C_jasmani"];

		// C_tinggi
		$master_siswa->C_tinggi->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_C_tinggi"]);
		$master_siswa->C_tinggi->AdvancedSearch->SearchOperator = @$_GET["z_C_tinggi"];
		$master_siswa->C_tinggi->AdvancedSearch->SearchCondition = @$_GET["v_C_tinggi"];
		$master_siswa->C_tinggi->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_C_tinggi"]);
		$master_siswa->C_tinggi->AdvancedSearch->SearchOperator2 = @$_GET["w_C_tinggi"];

		// C_berat
		$master_siswa->C_berat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_C_berat"]);
		$master_siswa->C_berat->AdvancedSearch->SearchOperator = @$_GET["z_C_berat"];
		$master_siswa->C_berat->AdvancedSearch->SearchCondition = @$_GET["v_C_berat"];
		$master_siswa->C_berat->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_C_berat"]);
		$master_siswa->C_berat->AdvancedSearch->SearchOperator2 = @$_GET["w_C_berat"];

		// D_tamatan_dari
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_tamatan_dari"]);
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator = @$_GET["z_D_tamatan_dari"];
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchCondition = @$_GET["v_D_tamatan_dari"];
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_tamatan_dari"]);
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator2 = @$_GET["w_D_tamatan_dari"];

		// D_sttb
		$master_siswa->D_sttb->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_sttb"]);
		$master_siswa->D_sttb->AdvancedSearch->SearchOperator = @$_GET["z_D_sttb"];
		$master_siswa->D_sttb->AdvancedSearch->SearchCondition = @$_GET["v_D_sttb"];
		$master_siswa->D_sttb->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_sttb"]);
		$master_siswa->D_sttb->AdvancedSearch->SearchOperator2 = @$_GET["w_D_sttb"];

		// D_tanggal_sttb
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_tanggal_sttb"]);
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator = @$_GET["z_D_tanggal_sttb"];
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchCondition = @$_GET["v_D_tanggal_sttb"];
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_tanggal_sttb"]);
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator2 = @$_GET["w_D_tanggal_sttb"];

		// D_danum
		$master_siswa->D_danum->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_danum"]);
		$master_siswa->D_danum->AdvancedSearch->SearchOperator = @$_GET["z_D_danum"];
		$master_siswa->D_danum->AdvancedSearch->SearchCondition = @$_GET["v_D_danum"];
		$master_siswa->D_danum->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_danum"]);
		$master_siswa->D_danum->AdvancedSearch->SearchOperator2 = @$_GET["w_D_danum"];

		// D_tanggal_danum
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_tanggal_danum"]);
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator = @$_GET["z_D_tanggal_danum"];
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchCondition = @$_GET["v_D_tanggal_danum"];
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_tanggal_danum"]);
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator2 = @$_GET["w_D_tanggal_danum"];

		// D_lama_belajar
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_lama_belajar"]);
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator = @$_GET["z_D_lama_belajar"];
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchCondition = @$_GET["v_D_lama_belajar"];
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_lama_belajar"]);
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator2 = @$_GET["w_D_lama_belajar"];

		// D_dari_sekolah
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_dari_sekolah"]);
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator = @$_GET["z_D_dari_sekolah"];
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchCondition = @$_GET["v_D_dari_sekolah"];
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_dari_sekolah"]);
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator2 = @$_GET["w_D_dari_sekolah"];

		// D_alasan
		$master_siswa->D_alasan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_alasan"]);
		$master_siswa->D_alasan->AdvancedSearch->SearchOperator = @$_GET["z_D_alasan"];
		$master_siswa->D_alasan->AdvancedSearch->SearchCondition = @$_GET["v_D_alasan"];
		$master_siswa->D_alasan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_alasan"]);
		$master_siswa->D_alasan->AdvancedSearch->SearchOperator2 = @$_GET["w_D_alasan"];

		// D_kelas
		$master_siswa->D_kelas->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_kelas"]);
		$master_siswa->D_kelas->AdvancedSearch->SearchOperator = @$_GET["z_D_kelas"];
		$master_siswa->D_kelas->AdvancedSearch->SearchCondition = @$_GET["v_D_kelas"];
		$master_siswa->D_kelas->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_kelas"]);
		$master_siswa->D_kelas->AdvancedSearch->SearchOperator2 = @$_GET["w_D_kelas"];

		// D_kelompok
		$master_siswa->D_kelompok->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_kelompok"]);
		$master_siswa->D_kelompok->AdvancedSearch->SearchOperator = @$_GET["z_D_kelompok"];
		$master_siswa->D_kelompok->AdvancedSearch->SearchCondition = @$_GET["v_D_kelompok"];
		$master_siswa->D_kelompok->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_kelompok"]);
		$master_siswa->D_kelompok->AdvancedSearch->SearchOperator2 = @$_GET["w_D_kelompok"];

		// D_tanggal
		$master_siswa->D_tanggal->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_tanggal"]);
		$master_siswa->D_tanggal->AdvancedSearch->SearchOperator = @$_GET["z_D_tanggal"];
		$master_siswa->D_tanggal->AdvancedSearch->SearchCondition = @$_GET["v_D_tanggal"];
		$master_siswa->D_tanggal->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_tanggal"]);
		$master_siswa->D_tanggal->AdvancedSearch->SearchOperator2 = @$_GET["w_D_tanggal"];

		// D_saat_ini_tingkat
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_saat_ini_tingkat"]);
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator = @$_GET["z_D_saat_ini_tingkat"];
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchCondition = @$_GET["v_D_saat_ini_tingkat"];
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_saat_ini_tingkat"]);
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator2 = @$_GET["w_D_saat_ini_tingkat"];

		// D_saat_ini_kelas
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_saat_ini_kelas"]);
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator = @$_GET["z_D_saat_ini_kelas"];
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchCondition = @$_GET["v_D_saat_ini_kelas"];
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_saat_ini_kelas"]);
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator2 = @$_GET["w_D_saat_ini_kelas"];

		// D_saat_ini_kelompok
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_saat_ini_kelompok"]);
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator = @$_GET["z_D_saat_ini_kelompok"];
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchCondition = @$_GET["v_D_saat_ini_kelompok"];
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_saat_ini_kelompok"]);
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator2 = @$_GET["w_D_saat_ini_kelompok"];

		// D_no_psb
		$master_siswa->D_no_psb->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_no_psb"]);
		$master_siswa->D_no_psb->AdvancedSearch->SearchOperator = @$_GET["z_D_no_psb"];
		$master_siswa->D_no_psb->AdvancedSearch->SearchCondition = @$_GET["v_D_no_psb"];
		$master_siswa->D_no_psb->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_no_psb"]);
		$master_siswa->D_no_psb->AdvancedSearch->SearchOperator2 = @$_GET["w_D_no_psb"];

		// D_nilai_danum_sd
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_nilai_danum_sd"]);
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator = @$_GET["z_D_nilai_danum_sd"];
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchCondition = @$_GET["v_D_nilai_danum_sd"];
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_nilai_danum_sd"]);
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator2 = @$_GET["w_D_nilai_danum_sd"];

		// D_jumlah_pelajaran_danum
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_jumlah_pelajaran_danum"]);
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator = @$_GET["z_D_jumlah_pelajaran_danum"];
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchCondition = @$_GET["v_D_jumlah_pelajaran_danum"];
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_jumlah_pelajaran_danum"]);
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator2 = @$_GET["w_D_jumlah_pelajaran_danum"];

		// D_nilai_ujian_psb
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_nilai_ujian_psb"]);
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator = @$_GET["z_D_nilai_ujian_psb"];
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchCondition = @$_GET["v_D_nilai_ujian_psb"];
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_nilai_ujian_psb"]);
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator2 = @$_GET["w_D_nilai_ujian_psb"];

		// D_tahun_psb
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_tahun_psb"]);
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator = @$_GET["z_D_tahun_psb"];
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchCondition = @$_GET["v_D_tahun_psb"];
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_tahun_psb"]);
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator2 = @$_GET["w_D_tahun_psb"];

		// D_diterima
		$master_siswa->D_diterima->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_diterima"]);
		$master_siswa->D_diterima->AdvancedSearch->SearchOperator = @$_GET["z_D_diterima"];
		$master_siswa->D_diterima->AdvancedSearch->SearchCondition = @$_GET["v_D_diterima"];
		$master_siswa->D_diterima->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_diterima"]);
		$master_siswa->D_diterima->AdvancedSearch->SearchOperator2 = @$_GET["w_D_diterima"];

		// D_spp
		$master_siswa->D_spp->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_spp"]);
		$master_siswa->D_spp->AdvancedSearch->SearchOperator = @$_GET["z_D_spp"];
		$master_siswa->D_spp->AdvancedSearch->SearchCondition = @$_GET["v_D_spp"];
		$master_siswa->D_spp->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_spp"]);
		$master_siswa->D_spp->AdvancedSearch->SearchOperator2 = @$_GET["w_D_spp"];

		// D_spp_potongan
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_spp_potongan"]);
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator = @$_GET["z_D_spp_potongan"];
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchCondition = @$_GET["v_D_spp_potongan"];
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_spp_potongan"]);
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator2 = @$_GET["w_D_spp_potongan"];

		// D_status_lama_baru
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_D_status_lama_baru"]);
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator = @$_GET["z_D_status_lama_baru"];
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchCondition = @$_GET["v_D_status_lama_baru"];
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_D_status_lama_baru"]);
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator2 = @$_GET["w_D_status_lama_baru"];

		// E_nama_ayah
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_nama_ayah"]);
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator = @$_GET["z_E_nama_ayah"];
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchCondition = @$_GET["v_E_nama_ayah"];
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_nama_ayah"]);
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator2 = @$_GET["w_E_nama_ayah"];

		// E_tempat_lahir
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_tempat_lahir"]);
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator = @$_GET["z_E_tempat_lahir"];
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchCondition = @$_GET["v_E_tempat_lahir"];
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_tempat_lahir"]);
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator2 = @$_GET["w_E_tempat_lahir"];

		// E_tanggal_lahir
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_tanggal_lahir"]);
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator = @$_GET["z_E_tanggal_lahir"];
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchCondition = @$_GET["v_E_tanggal_lahir"];
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_tanggal_lahir"]);
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator2 = @$_GET["w_E_tanggal_lahir"];

		// E_agama
		$master_siswa->E_agama->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_agama"]);
		$master_siswa->E_agama->AdvancedSearch->SearchOperator = @$_GET["z_E_agama"];
		$master_siswa->E_agama->AdvancedSearch->SearchCondition = @$_GET["v_E_agama"];
		$master_siswa->E_agama->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_agama"]);
		$master_siswa->E_agama->AdvancedSearch->SearchOperator2 = @$_GET["w_E_agama"];

		// E_kewarganegaraan
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_kewarganegaraan"]);
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator = @$_GET["z_E_kewarganegaraan"];
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchCondition = @$_GET["v_E_kewarganegaraan"];
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_kewarganegaraan"]);
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator2 = @$_GET["w_E_kewarganegaraan"];

		// E_pendidikan
		$master_siswa->E_pendidikan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_pendidikan"]);
		$master_siswa->E_pendidikan->AdvancedSearch->SearchOperator = @$_GET["z_E_pendidikan"];
		$master_siswa->E_pendidikan->AdvancedSearch->SearchCondition = @$_GET["v_E_pendidikan"];
		$master_siswa->E_pendidikan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_pendidikan"]);
		$master_siswa->E_pendidikan->AdvancedSearch->SearchOperator2 = @$_GET["w_E_pendidikan"];

		// E_pekerjaan
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_pekerjaan"]);
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_E_pekerjaan"];
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchCondition = @$_GET["v_E_pekerjaan"];
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_pekerjaan"]);
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator2 = @$_GET["w_E_pekerjaan"];

		// E_pengeluaran
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_pengeluaran"]);
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator = @$_GET["z_E_pengeluaran"];
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchCondition = @$_GET["v_E_pengeluaran"];
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_pengeluaran"]);
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator2 = @$_GET["w_E_pengeluaran"];

		// E_alamat
		$master_siswa->E_alamat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_alamat"]);
		$master_siswa->E_alamat->AdvancedSearch->SearchOperator = @$_GET["z_E_alamat"];
		$master_siswa->E_alamat->AdvancedSearch->SearchCondition = @$_GET["v_E_alamat"];
		$master_siswa->E_alamat->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_alamat"]);
		$master_siswa->E_alamat->AdvancedSearch->SearchOperator2 = @$_GET["w_E_alamat"];

		// E_telepon
		$master_siswa->E_telepon->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_telepon"]);
		$master_siswa->E_telepon->AdvancedSearch->SearchOperator = @$_GET["z_E_telepon"];
		$master_siswa->E_telepon->AdvancedSearch->SearchCondition = @$_GET["v_E_telepon"];
		$master_siswa->E_telepon->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_telepon"]);
		$master_siswa->E_telepon->AdvancedSearch->SearchOperator2 = @$_GET["w_E_telepon"];

		// E_hp
		$master_siswa->E_hp->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_hp"]);
		$master_siswa->E_hp->AdvancedSearch->SearchOperator = @$_GET["z_E_hp"];
		$master_siswa->E_hp->AdvancedSearch->SearchCondition = @$_GET["v_E_hp"];
		$master_siswa->E_hp->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_hp"]);
		$master_siswa->E_hp->AdvancedSearch->SearchOperator2 = @$_GET["w_E_hp"];

		// E_hidup
		$master_siswa->E_hidup->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_E_hidup"]);
		$master_siswa->E_hidup->AdvancedSearch->SearchOperator = @$_GET["z_E_hidup"];
		$master_siswa->E_hidup->AdvancedSearch->SearchCondition = @$_GET["v_E_hidup"];
		$master_siswa->E_hidup->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_E_hidup"]);
		$master_siswa->E_hidup->AdvancedSearch->SearchOperator2 = @$_GET["w_E_hidup"];

		// F_nama_ibu
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_nama_ibu"]);
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator = @$_GET["z_F_nama_ibu"];
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchCondition = @$_GET["v_F_nama_ibu"];
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_nama_ibu"]);
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator2 = @$_GET["w_F_nama_ibu"];

		// F_tempat_lahir
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_tempat_lahir"]);
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator = @$_GET["z_F_tempat_lahir"];
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchCondition = @$_GET["v_F_tempat_lahir"];
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_tempat_lahir"]);
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator2 = @$_GET["w_F_tempat_lahir"];

		// F_tanggal_lahir
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_tanggal_lahir"]);
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator = @$_GET["z_F_tanggal_lahir"];
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchCondition = @$_GET["v_F_tanggal_lahir"];
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_tanggal_lahir"]);
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator2 = @$_GET["w_F_tanggal_lahir"];

		// F_agama
		$master_siswa->F_agama->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_agama"]);
		$master_siswa->F_agama->AdvancedSearch->SearchOperator = @$_GET["z_F_agama"];
		$master_siswa->F_agama->AdvancedSearch->SearchCondition = @$_GET["v_F_agama"];
		$master_siswa->F_agama->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_agama"]);
		$master_siswa->F_agama->AdvancedSearch->SearchOperator2 = @$_GET["w_F_agama"];

		// F_kewarganegaraan
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_kewarganegaraan"]);
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator = @$_GET["z_F_kewarganegaraan"];
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchCondition = @$_GET["v_F_kewarganegaraan"];
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_kewarganegaraan"]);
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator2 = @$_GET["w_F_kewarganegaraan"];

		// F_pendidikan
		$master_siswa->F_pendidikan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_pendidikan"]);
		$master_siswa->F_pendidikan->AdvancedSearch->SearchOperator = @$_GET["z_F_pendidikan"];
		$master_siswa->F_pendidikan->AdvancedSearch->SearchCondition = @$_GET["v_F_pendidikan"];
		$master_siswa->F_pendidikan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_pendidikan"]);
		$master_siswa->F_pendidikan->AdvancedSearch->SearchOperator2 = @$_GET["w_F_pendidikan"];

		// F_pekerjaan
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_pekerjaan"]);
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_F_pekerjaan"];
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchCondition = @$_GET["v_F_pekerjaan"];
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_pekerjaan"]);
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator2 = @$_GET["w_F_pekerjaan"];

		// F_pengeluaran
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_pengeluaran"]);
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator = @$_GET["z_F_pengeluaran"];
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchCondition = @$_GET["v_F_pengeluaran"];
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_pengeluaran"]);
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator2 = @$_GET["w_F_pengeluaran"];

		// F_alamat
		$master_siswa->F_alamat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_alamat"]);
		$master_siswa->F_alamat->AdvancedSearch->SearchOperator = @$_GET["z_F_alamat"];
		$master_siswa->F_alamat->AdvancedSearch->SearchCondition = @$_GET["v_F_alamat"];
		$master_siswa->F_alamat->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_alamat"]);
		$master_siswa->F_alamat->AdvancedSearch->SearchOperator2 = @$_GET["w_F_alamat"];

		// F_telepon
		$master_siswa->F_telepon->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_telepon"]);
		$master_siswa->F_telepon->AdvancedSearch->SearchOperator = @$_GET["z_F_telepon"];
		$master_siswa->F_telepon->AdvancedSearch->SearchCondition = @$_GET["v_F_telepon"];
		$master_siswa->F_telepon->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_telepon"]);
		$master_siswa->F_telepon->AdvancedSearch->SearchOperator2 = @$_GET["w_F_telepon"];

		// F_hp
		$master_siswa->F_hp->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_hp"]);
		$master_siswa->F_hp->AdvancedSearch->SearchOperator = @$_GET["z_F_hp"];
		$master_siswa->F_hp->AdvancedSearch->SearchCondition = @$_GET["v_F_hp"];
		$master_siswa->F_hp->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_hp"]);
		$master_siswa->F_hp->AdvancedSearch->SearchOperator2 = @$_GET["w_F_hp"];

		// F_hidup
		$master_siswa->F_hidup->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_F_hidup"]);
		$master_siswa->F_hidup->AdvancedSearch->SearchOperator = @$_GET["z_F_hidup"];
		$master_siswa->F_hidup->AdvancedSearch->SearchCondition = @$_GET["v_F_hidup"];
		$master_siswa->F_hidup->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_F_hidup"]);
		$master_siswa->F_hidup->AdvancedSearch->SearchOperator2 = @$_GET["w_F_hidup"];

		// G_nama_wali
		$master_siswa->G_nama_wali->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_nama_wali"]);
		$master_siswa->G_nama_wali->AdvancedSearch->SearchOperator = @$_GET["z_G_nama_wali"];
		$master_siswa->G_nama_wali->AdvancedSearch->SearchCondition = @$_GET["v_G_nama_wali"];
		$master_siswa->G_nama_wali->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_nama_wali"]);
		$master_siswa->G_nama_wali->AdvancedSearch->SearchOperator2 = @$_GET["w_G_nama_wali"];

		// G_tempat_lahir
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_tempat_lahir"]);
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator = @$_GET["z_G_tempat_lahir"];
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchCondition = @$_GET["v_G_tempat_lahir"];
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_tempat_lahir"]);
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator2 = @$_GET["w_G_tempat_lahir"];

		// G_tanggal_lahir
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_tanggal_lahir"]);
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator = @$_GET["z_G_tanggal_lahir"];
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchCondition = @$_GET["v_G_tanggal_lahir"];
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_tanggal_lahir"]);
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator2 = @$_GET["w_G_tanggal_lahir"];

		// G_agama
		$master_siswa->G_agama->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_agama"]);
		$master_siswa->G_agama->AdvancedSearch->SearchOperator = @$_GET["z_G_agama"];
		$master_siswa->G_agama->AdvancedSearch->SearchCondition = @$_GET["v_G_agama"];
		$master_siswa->G_agama->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_agama"]);
		$master_siswa->G_agama->AdvancedSearch->SearchOperator2 = @$_GET["w_G_agama"];

		// G_kewarganegaraan
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_kewarganegaraan"]);
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator = @$_GET["z_G_kewarganegaraan"];
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchCondition = @$_GET["v_G_kewarganegaraan"];
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_kewarganegaraan"]);
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator2 = @$_GET["w_G_kewarganegaraan"];

		// G_pendidikan
		$master_siswa->G_pendidikan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_pendidikan"]);
		$master_siswa->G_pendidikan->AdvancedSearch->SearchOperator = @$_GET["z_G_pendidikan"];
		$master_siswa->G_pendidikan->AdvancedSearch->SearchCondition = @$_GET["v_G_pendidikan"];
		$master_siswa->G_pendidikan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_pendidikan"]);
		$master_siswa->G_pendidikan->AdvancedSearch->SearchOperator2 = @$_GET["w_G_pendidikan"];

		// G_pekerjaan
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_pekerjaan"]);
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator = @$_GET["z_G_pekerjaan"];
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchCondition = @$_GET["v_G_pekerjaan"];
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_pekerjaan"]);
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator2 = @$_GET["w_G_pekerjaan"];

		// G_pengeluaran
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_pengeluaran"]);
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator = @$_GET["z_G_pengeluaran"];
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchCondition = @$_GET["v_G_pengeluaran"];
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_pengeluaran"]);
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator2 = @$_GET["w_G_pengeluaran"];

		// G_alamat
		$master_siswa->G_alamat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_alamat"]);
		$master_siswa->G_alamat->AdvancedSearch->SearchOperator = @$_GET["z_G_alamat"];
		$master_siswa->G_alamat->AdvancedSearch->SearchCondition = @$_GET["v_G_alamat"];
		$master_siswa->G_alamat->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_alamat"]);
		$master_siswa->G_alamat->AdvancedSearch->SearchOperator2 = @$_GET["w_G_alamat"];

		// G_telepon
		$master_siswa->G_telepon->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_telepon"]);
		$master_siswa->G_telepon->AdvancedSearch->SearchOperator = @$_GET["z_G_telepon"];
		$master_siswa->G_telepon->AdvancedSearch->SearchCondition = @$_GET["v_G_telepon"];
		$master_siswa->G_telepon->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_telepon"]);
		$master_siswa->G_telepon->AdvancedSearch->SearchOperator2 = @$_GET["w_G_telepon"];

		// G_hp
		$master_siswa->G_hp->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_G_hp"]);
		$master_siswa->G_hp->AdvancedSearch->SearchOperator = @$_GET["z_G_hp"];
		$master_siswa->G_hp->AdvancedSearch->SearchCondition = @$_GET["v_G_hp"];
		$master_siswa->G_hp->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_G_hp"]);
		$master_siswa->G_hp->AdvancedSearch->SearchOperator2 = @$_GET["w_G_hp"];

		// H_kesenian
		$master_siswa->H_kesenian->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_H_kesenian"]);
		$master_siswa->H_kesenian->AdvancedSearch->SearchOperator = @$_GET["z_H_kesenian"];
		$master_siswa->H_kesenian->AdvancedSearch->SearchCondition = @$_GET["v_H_kesenian"];
		$master_siswa->H_kesenian->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_H_kesenian"]);
		$master_siswa->H_kesenian->AdvancedSearch->SearchOperator2 = @$_GET["w_H_kesenian"];

		// H_olahraga
		$master_siswa->H_olahraga->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_H_olahraga"]);
		$master_siswa->H_olahraga->AdvancedSearch->SearchOperator = @$_GET["z_H_olahraga"];
		$master_siswa->H_olahraga->AdvancedSearch->SearchCondition = @$_GET["v_H_olahraga"];
		$master_siswa->H_olahraga->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_H_olahraga"]);
		$master_siswa->H_olahraga->AdvancedSearch->SearchOperator2 = @$_GET["w_H_olahraga"];

		// H_kemasyarakatan
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_H_kemasyarakatan"]);
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator = @$_GET["z_H_kemasyarakatan"];
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchCondition = @$_GET["v_H_kemasyarakatan"];
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_H_kemasyarakatan"]);
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator2 = @$_GET["w_H_kemasyarakatan"];

		// H_lainlain
		$master_siswa->H_lainlain->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_H_lainlain"]);
		$master_siswa->H_lainlain->AdvancedSearch->SearchOperator = @$_GET["z_H_lainlain"];
		$master_siswa->H_lainlain->AdvancedSearch->SearchCondition = @$_GET["v_H_lainlain"];
		$master_siswa->H_lainlain->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_H_lainlain"]);
		$master_siswa->H_lainlain->AdvancedSearch->SearchOperator2 = @$_GET["w_H_lainlain"];

		// I_tanggal_meninggalkan
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_tanggal_meninggalkan"]);
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator = @$_GET["z_I_tanggal_meninggalkan"];
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchCondition = @$_GET["v_I_tanggal_meninggalkan"];
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_tanggal_meninggalkan"]);
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator2 = @$_GET["w_I_tanggal_meninggalkan"];

		// I_alasan
		$master_siswa->I_alasan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_alasan"]);
		$master_siswa->I_alasan->AdvancedSearch->SearchOperator = @$_GET["z_I_alasan"];
		$master_siswa->I_alasan->AdvancedSearch->SearchCondition = @$_GET["v_I_alasan"];
		$master_siswa->I_alasan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_alasan"]);
		$master_siswa->I_alasan->AdvancedSearch->SearchOperator2 = @$_GET["w_I_alasan"];

		// I_tanggal_lulus
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_tanggal_lulus"]);
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator = @$_GET["z_I_tanggal_lulus"];
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchCondition = @$_GET["v_I_tanggal_lulus"];
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_tanggal_lulus"]);
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator2 = @$_GET["w_I_tanggal_lulus"];

		// I_sttb
		$master_siswa->I_sttb->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_sttb"]);
		$master_siswa->I_sttb->AdvancedSearch->SearchOperator = @$_GET["z_I_sttb"];
		$master_siswa->I_sttb->AdvancedSearch->SearchCondition = @$_GET["v_I_sttb"];
		$master_siswa->I_sttb->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_sttb"]);
		$master_siswa->I_sttb->AdvancedSearch->SearchOperator2 = @$_GET["w_I_sttb"];

		// I_danum
		$master_siswa->I_danum->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_danum"]);
		$master_siswa->I_danum->AdvancedSearch->SearchOperator = @$_GET["z_I_danum"];
		$master_siswa->I_danum->AdvancedSearch->SearchCondition = @$_GET["v_I_danum"];
		$master_siswa->I_danum->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_danum"]);
		$master_siswa->I_danum->AdvancedSearch->SearchOperator2 = @$_GET["w_I_danum"];

		// I_nilai_danum_smp
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_nilai_danum_smp"]);
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator = @$_GET["z_I_nilai_danum_smp"];
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchCondition = @$_GET["v_I_nilai_danum_smp"];
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_nilai_danum_smp"]);
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator2 = @$_GET["w_I_nilai_danum_smp"];

		// I_tahun1
		$master_siswa->I_tahun1->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_tahun1"]);
		$master_siswa->I_tahun1->AdvancedSearch->SearchOperator = @$_GET["z_I_tahun1"];
		$master_siswa->I_tahun1->AdvancedSearch->SearchCondition = @$_GET["v_I_tahun1"];
		$master_siswa->I_tahun1->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_tahun1"]);
		$master_siswa->I_tahun1->AdvancedSearch->SearchOperator2 = @$_GET["w_I_tahun1"];

		// I_tahun2
		$master_siswa->I_tahun2->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_tahun2"]);
		$master_siswa->I_tahun2->AdvancedSearch->SearchOperator = @$_GET["z_I_tahun2"];
		$master_siswa->I_tahun2->AdvancedSearch->SearchCondition = @$_GET["v_I_tahun2"];
		$master_siswa->I_tahun2->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_tahun2"]);
		$master_siswa->I_tahun2->AdvancedSearch->SearchOperator2 = @$_GET["w_I_tahun2"];

		// I_tahun3
		$master_siswa->I_tahun3->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_tahun3"]);
		$master_siswa->I_tahun3->AdvancedSearch->SearchOperator = @$_GET["z_I_tahun3"];
		$master_siswa->I_tahun3->AdvancedSearch->SearchCondition = @$_GET["v_I_tahun3"];
		$master_siswa->I_tahun3->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_tahun3"]);
		$master_siswa->I_tahun3->AdvancedSearch->SearchOperator2 = @$_GET["w_I_tahun3"];

		// I_tk1
		$master_siswa->I_tk1->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_tk1"]);
		$master_siswa->I_tk1->AdvancedSearch->SearchOperator = @$_GET["z_I_tk1"];
		$master_siswa->I_tk1->AdvancedSearch->SearchCondition = @$_GET["v_I_tk1"];
		$master_siswa->I_tk1->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_tk1"]);
		$master_siswa->I_tk1->AdvancedSearch->SearchOperator2 = @$_GET["w_I_tk1"];

		// I_tk2
		$master_siswa->I_tk2->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_tk2"]);
		$master_siswa->I_tk2->AdvancedSearch->SearchOperator = @$_GET["z_I_tk2"];
		$master_siswa->I_tk2->AdvancedSearch->SearchCondition = @$_GET["v_I_tk2"];
		$master_siswa->I_tk2->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_tk2"]);
		$master_siswa->I_tk2->AdvancedSearch->SearchOperator2 = @$_GET["w_I_tk2"];

		// I_tk3
		$master_siswa->I_tk3->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_tk3"]);
		$master_siswa->I_tk3->AdvancedSearch->SearchOperator = @$_GET["z_I_tk3"];
		$master_siswa->I_tk3->AdvancedSearch->SearchCondition = @$_GET["v_I_tk3"];
		$master_siswa->I_tk3->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_tk3"]);
		$master_siswa->I_tk3->AdvancedSearch->SearchOperator2 = @$_GET["w_I_tk3"];

		// I_dari1
		$master_siswa->I_dari1->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_dari1"]);
		$master_siswa->I_dari1->AdvancedSearch->SearchOperator = @$_GET["z_I_dari1"];
		$master_siswa->I_dari1->AdvancedSearch->SearchCondition = @$_GET["v_I_dari1"];
		$master_siswa->I_dari1->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_dari1"]);
		$master_siswa->I_dari1->AdvancedSearch->SearchOperator2 = @$_GET["w_I_dari1"];

		// I_dari2
		$master_siswa->I_dari2->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_dari2"]);
		$master_siswa->I_dari2->AdvancedSearch->SearchOperator = @$_GET["z_I_dari2"];
		$master_siswa->I_dari2->AdvancedSearch->SearchCondition = @$_GET["v_I_dari2"];
		$master_siswa->I_dari2->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_dari2"]);
		$master_siswa->I_dari2->AdvancedSearch->SearchOperator2 = @$_GET["w_I_dari2"];

		// I_dari3
		$master_siswa->I_dari3->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_I_dari3"]);
		$master_siswa->I_dari3->AdvancedSearch->SearchOperator = @$_GET["z_I_dari3"];
		$master_siswa->I_dari3->AdvancedSearch->SearchCondition = @$_GET["v_I_dari3"];
		$master_siswa->I_dari3->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_I_dari3"]);
		$master_siswa->I_dari3->AdvancedSearch->SearchOperator2 = @$_GET["w_I_dari3"];

		// J_melanjutkan
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_J_melanjutkan"]);
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator = @$_GET["z_J_melanjutkan"];
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchCondition = @$_GET["v_J_melanjutkan"];
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_J_melanjutkan"]);
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator2 = @$_GET["w_J_melanjutkan"];

		// J_tanggal_bekerja
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_J_tanggal_bekerja"]);
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator = @$_GET["z_J_tanggal_bekerja"];
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchCondition = @$_GET["v_J_tanggal_bekerja"];
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_J_tanggal_bekerja"]);
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator2 = @$_GET["w_J_tanggal_bekerja"];

		// J_nama_perusahaan
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_J_nama_perusahaan"]);
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator = @$_GET["z_J_nama_perusahaan"];
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchCondition = @$_GET["v_J_nama_perusahaan"];
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_J_nama_perusahaan"]);
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator2 = @$_GET["w_J_nama_perusahaan"];

		// J_penghasilan
		$master_siswa->J_penghasilan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_J_penghasilan"]);
		$master_siswa->J_penghasilan->AdvancedSearch->SearchOperator = @$_GET["z_J_penghasilan"];
		$master_siswa->J_penghasilan->AdvancedSearch->SearchCondition = @$_GET["v_J_penghasilan"];
		$master_siswa->J_penghasilan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_J_penghasilan"]);
		$master_siswa->J_penghasilan->AdvancedSearch->SearchOperator2 = @$_GET["w_J_penghasilan"];

		// kode_otomatis
		$master_siswa->kode_otomatis->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_kode_otomatis"]);
		$master_siswa->kode_otomatis->AdvancedSearch->SearchOperator = @$_GET["z_kode_otomatis"];
		$master_siswa->kode_otomatis->AdvancedSearch->SearchCondition = @$_GET["v_kode_otomatis"];
		$master_siswa->kode_otomatis->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_kode_otomatis"]);
		$master_siswa->kode_otomatis->AdvancedSearch->SearchOperator2 = @$_GET["w_kode_otomatis"];

		// apakah_valid
		$master_siswa->apakah_valid->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_apakah_valid"]);
		$master_siswa->apakah_valid->AdvancedSearch->SearchOperator = @$_GET["z_apakah_valid"];
		$master_siswa->apakah_valid->AdvancedSearch->SearchCondition = @$_GET["v_apakah_valid"];
		$master_siswa->apakah_valid->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_apakah_valid"]);
		$master_siswa->apakah_valid->AdvancedSearch->SearchOperator2 = @$_GET["w_apakah_valid"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $master_siswa;

		// Call Recordset Selecting event
		$master_siswa->Recordset_Selecting($master_siswa->CurrentFilter);

		// Load List page SQL
		$sSql = $master_siswa->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$master_siswa->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $master_siswa;
		$sFilter = $master_siswa->KeyFilter();

		// Call Row Selecting event
		$master_siswa->Row_Selecting($sFilter);

		// Load SQL based on filter
		$master_siswa->CurrentFilter = $sFilter;
		$sSql = $master_siswa->SQL();
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
		global $conn, $master_siswa;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$master_siswa->Row_Selected($row);
		$master_siswa->no_absen->setDbValue($rs->fields('no_absen'));
		$master_siswa->A_nis_nasional->setDbValue($rs->fields('A_nis_nasional'));
		$master_siswa->A_nama_Lengkap->setDbValue($rs->fields('A_nama_Lengkap'));
		$master_siswa->A_nama_panggilan->setDbValue($rs->fields('A_nama_panggilan'));
		$master_siswa->A_jenis_kelamin->setDbValue($rs->fields('A_jenis_kelamin'));
		$master_siswa->A_tempat_lahir->setDbValue($rs->fields('A_tempat_lahir'));
		$master_siswa->A_tanggal_lahir->setDbValue($rs->fields('A_tanggal_lahir'));
		$master_siswa->A_agama->setDbValue($rs->fields('A_agama'));
		$master_siswa->A_kewarganegaraan->setDbValue($rs->fields('A_kewarganegaraan'));
		$master_siswa->A_anak_keberapa->setDbValue($rs->fields('A_anak_keberapa'));
		$master_siswa->A_jumlah_saudara_kandung->setDbValue($rs->fields('A_jumlah_saudara_kandung'));
		$master_siswa->A_jumlah_saudara_tiri->setDbValue($rs->fields('A_jumlah_saudara_tiri'));
		$master_siswa->A_jumlah_saudara_angkat->setDbValue($rs->fields('A_jumlah_saudara_angkat'));
		$master_siswa->A_status_yatim->setDbValue($rs->fields('A_status_yatim'));
		$master_siswa->A_bahasa->setDbValue($rs->fields('A_bahasa'));
		$master_siswa->B_alamat->setDbValue($rs->fields('B_alamat'));
		$master_siswa->B_telepon_rumah->setDbValue($rs->fields('B_telepon_rumah'));
		$master_siswa->B_tinggal->setDbValue($rs->fields('B_tinggal'));
		$master_siswa->B_jarak->setDbValue($rs->fields('B_jarak'));
		$master_siswa->B_hp->setDbValue($rs->fields('B_hp'));
		$master_siswa->C_golongan_darah->setDbValue($rs->fields('C_golongan_darah'));
		$master_siswa->C_penyakit->setDbValue($rs->fields('C_penyakit'));
		$master_siswa->C_jasmani->setDbValue($rs->fields('C_jasmani'));
		$master_siswa->C_tinggi->setDbValue($rs->fields('C_tinggi'));
		$master_siswa->C_berat->setDbValue($rs->fields('C_berat'));
		$master_siswa->D_tamatan_dari->setDbValue($rs->fields('D_tamatan_dari'));
		$master_siswa->D_sttb->setDbValue($rs->fields('D_sttb'));
		$master_siswa->D_tanggal_sttb->setDbValue($rs->fields('D_tanggal_sttb'));
		$master_siswa->D_danum->setDbValue($rs->fields('D_danum'));
		$master_siswa->D_tanggal_danum->setDbValue($rs->fields('D_tanggal_danum'));
		$master_siswa->D_lama_belajar->setDbValue($rs->fields('D_lama_belajar'));
		$master_siswa->D_dari_sekolah->setDbValue($rs->fields('D_dari_sekolah'));
		$master_siswa->D_alasan->setDbValue($rs->fields('D_alasan'));
		$master_siswa->D_kelas->setDbValue($rs->fields('D_kelas'));
		$master_siswa->D_kelompok->setDbValue($rs->fields('D_kelompok'));
		$master_siswa->D_tanggal->setDbValue($rs->fields('D_tanggal'));
		$master_siswa->D_saat_ini_tingkat->setDbValue($rs->fields('D_saat_ini_tingkat'));
		$master_siswa->D_saat_ini_kelas->setDbValue($rs->fields('D_saat_ini_kelas'));
		$master_siswa->D_saat_ini_kelompok->setDbValue($rs->fields('D_saat_ini_kelompok'));
		$master_siswa->D_no_psb->setDbValue($rs->fields('D_no_psb'));
		$master_siswa->D_nilai_danum_sd->setDbValue($rs->fields('D_nilai_danum_sd'));
		$master_siswa->D_jumlah_pelajaran_danum->setDbValue($rs->fields('D_jumlah_pelajaran_danum'));
		$master_siswa->D_nilai_ujian_psb->setDbValue($rs->fields('D_nilai_ujian_psb'));
		$master_siswa->D_tahun_psb->setDbValue($rs->fields('D_tahun_psb'));
		$master_siswa->D_diterima->setDbValue($rs->fields('D_diterima'));
		$master_siswa->D_spp->setDbValue($rs->fields('D_spp'));
		$master_siswa->D_spp_potongan->setDbValue($rs->fields('D_spp_potongan'));
		$master_siswa->D_status_lama_baru->setDbValue($rs->fields('D_status_lama_baru'));
		$master_siswa->E_nama_ayah->setDbValue($rs->fields('E_nama_ayah'));
		$master_siswa->E_tempat_lahir->setDbValue($rs->fields('E_tempat_lahir'));
		$master_siswa->E_tanggal_lahir->setDbValue($rs->fields('E_tanggal_lahir'));
		$master_siswa->E_agama->setDbValue($rs->fields('E_agama'));
		$master_siswa->E_kewarganegaraan->setDbValue($rs->fields('E_kewarganegaraan'));
		$master_siswa->E_pendidikan->setDbValue($rs->fields('E_pendidikan'));
		$master_siswa->E_pekerjaan->setDbValue($rs->fields('E_pekerjaan'));
		$master_siswa->E_pengeluaran->setDbValue($rs->fields('E_pengeluaran'));
		$master_siswa->E_alamat->setDbValue($rs->fields('E_alamat'));
		$master_siswa->E_telepon->setDbValue($rs->fields('E_telepon'));
		$master_siswa->E_hp->setDbValue($rs->fields('E_hp'));
		$master_siswa->E_hidup->setDbValue($rs->fields('E_hidup'));
		$master_siswa->F_nama_ibu->setDbValue($rs->fields('F_nama_ibu'));
		$master_siswa->F_tempat_lahir->setDbValue($rs->fields('F_tempat_lahir'));
		$master_siswa->F_tanggal_lahir->setDbValue($rs->fields('F_tanggal_lahir'));
		$master_siswa->F_agama->setDbValue($rs->fields('F_agama'));
		$master_siswa->F_kewarganegaraan->setDbValue($rs->fields('F_kewarganegaraan'));
		$master_siswa->F_pendidikan->setDbValue($rs->fields('F_pendidikan'));
		$master_siswa->F_pekerjaan->setDbValue($rs->fields('F_pekerjaan'));
		$master_siswa->F_pengeluaran->setDbValue($rs->fields('F_pengeluaran'));
		$master_siswa->F_alamat->setDbValue($rs->fields('F_alamat'));
		$master_siswa->F_telepon->setDbValue($rs->fields('F_telepon'));
		$master_siswa->F_hp->setDbValue($rs->fields('F_hp'));
		$master_siswa->F_hidup->setDbValue($rs->fields('F_hidup'));
		$master_siswa->G_nama_wali->setDbValue($rs->fields('G_nama_wali'));
		$master_siswa->G_tempat_lahir->setDbValue($rs->fields('G_tempat_lahir'));
		$master_siswa->G_tanggal_lahir->setDbValue($rs->fields('G_tanggal_lahir'));
		$master_siswa->G_agama->setDbValue($rs->fields('G_agama'));
		$master_siswa->G_kewarganegaraan->setDbValue($rs->fields('G_kewarganegaraan'));
		$master_siswa->G_pendidikan->setDbValue($rs->fields('G_pendidikan'));
		$master_siswa->G_pekerjaan->setDbValue($rs->fields('G_pekerjaan'));
		$master_siswa->G_pengeluaran->setDbValue($rs->fields('G_pengeluaran'));
		$master_siswa->G_alamat->setDbValue($rs->fields('G_alamat'));
		$master_siswa->G_telepon->setDbValue($rs->fields('G_telepon'));
		$master_siswa->G_hp->setDbValue($rs->fields('G_hp'));
		$master_siswa->H_kesenian->setDbValue($rs->fields('H_kesenian'));
		$master_siswa->H_olahraga->setDbValue($rs->fields('H_olahraga'));
		$master_siswa->H_kemasyarakatan->setDbValue($rs->fields('H_kemasyarakatan'));
		$master_siswa->H_lainlain->setDbValue($rs->fields('H_lainlain'));
		$master_siswa->I_tanggal_meninggalkan->setDbValue($rs->fields('I_tanggal_meninggalkan'));
		$master_siswa->I_alasan->setDbValue($rs->fields('I_alasan'));
		$master_siswa->I_tanggal_lulus->setDbValue($rs->fields('I_tanggal_lulus'));
		$master_siswa->I_sttb->setDbValue($rs->fields('I_sttb'));
		$master_siswa->I_danum->setDbValue($rs->fields('I_danum'));
		$master_siswa->I_nilai_danum_smp->setDbValue($rs->fields('I_nilai_danum_smp'));
		$master_siswa->I_tahun1->setDbValue($rs->fields('I_tahun1'));
		$master_siswa->I_tahun2->setDbValue($rs->fields('I_tahun2'));
		$master_siswa->I_tahun3->setDbValue($rs->fields('I_tahun3'));
		$master_siswa->I_tk1->setDbValue($rs->fields('I_tk1'));
		$master_siswa->I_tk2->setDbValue($rs->fields('I_tk2'));
		$master_siswa->I_tk3->setDbValue($rs->fields('I_tk3'));
		$master_siswa->I_dari1->setDbValue($rs->fields('I_dari1'));
		$master_siswa->I_dari2->setDbValue($rs->fields('I_dari2'));
		$master_siswa->I_dari3->setDbValue($rs->fields('I_dari3'));
		$master_siswa->J_melanjutkan->setDbValue($rs->fields('J_melanjutkan'));
		$master_siswa->J_tanggal_bekerja->setDbValue($rs->fields('J_tanggal_bekerja'));
		$master_siswa->J_nama_perusahaan->setDbValue($rs->fields('J_nama_perusahaan'));
		$master_siswa->J_penghasilan->setDbValue($rs->fields('J_penghasilan'));
		$master_siswa->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$master_siswa->apakah_valid->setDbValue($rs->fields('apakah_valid'));
	}

	// Load old record
	function LoadOldRecord() {
		global $master_siswa;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($master_siswa->getKey("kode_otomatis")) <> "")
			$master_siswa->kode_otomatis->CurrentValue = $master_siswa->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$master_siswa->CurrentFilter = $master_siswa->KeyFilter();
			$sSql = $master_siswa->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $master_siswa;

		// Initialize URLs
		$this->ViewUrl = $master_siswa->ViewUrl();
		$this->EditUrl = $master_siswa->EditUrl();
		$this->InlineEditUrl = $master_siswa->InlineEditUrl();
		$this->CopyUrl = $master_siswa->CopyUrl();
		$this->InlineCopyUrl = $master_siswa->InlineCopyUrl();
		$this->DeleteUrl = $master_siswa->DeleteUrl();

		// Call Row_Rendering event
		$master_siswa->Row_Rendering();

		// Common render codes for all row types
		// no_absen
		// A_nis_nasional
		// A_nama_Lengkap
		// A_nama_panggilan
		// A_jenis_kelamin
		// A_tempat_lahir
		// A_tanggal_lahir
		// A_agama
		// A_kewarganegaraan
		// A_anak_keberapa
		// A_jumlah_saudara_kandung
		// A_jumlah_saudara_tiri
		// A_jumlah_saudara_angkat
		// A_status_yatim
		// A_bahasa
		// B_alamat
		// B_telepon_rumah
		// B_tinggal
		// B_jarak
		// B_hp
		// C_golongan_darah
		// C_penyakit
		// C_jasmani
		// C_tinggi
		// C_berat
		// D_tamatan_dari
		// D_sttb
		// D_tanggal_sttb
		// D_danum
		// D_tanggal_danum
		// D_lama_belajar
		// D_dari_sekolah
		// D_alasan
		// D_kelas
		// D_kelompok
		// D_tanggal
		// D_saat_ini_tingkat
		// D_saat_ini_kelas
		// D_saat_ini_kelompok
		// D_no_psb
		// D_nilai_danum_sd
		// D_jumlah_pelajaran_danum
		// D_nilai_ujian_psb
		// D_tahun_psb
		// D_diterima
		// D_spp
		// D_spp_potongan
		// D_status_lama_baru
		// E_nama_ayah
		// E_tempat_lahir
		// E_tanggal_lahir
		// E_agama
		// E_kewarganegaraan
		// E_pendidikan
		// E_pekerjaan
		// E_pengeluaran
		// E_alamat
		// E_telepon
		// E_hp
		// E_hidup
		// F_nama_ibu
		// F_tempat_lahir
		// F_tanggal_lahir
		// F_agama
		// F_kewarganegaraan
		// F_pendidikan
		// F_pekerjaan
		// F_pengeluaran
		// F_alamat
		// F_telepon
		// F_hp
		// F_hidup
		// G_nama_wali
		// G_tempat_lahir
		// G_tanggal_lahir
		// G_agama
		// G_kewarganegaraan
		// G_pendidikan
		// G_pekerjaan
		// G_pengeluaran
		// G_alamat
		// G_telepon
		// G_hp
		// H_kesenian
		// H_olahraga
		// H_kemasyarakatan
		// H_lainlain
		// I_tanggal_meninggalkan
		// I_alasan
		// I_tanggal_lulus
		// I_sttb
		// I_danum
		// I_nilai_danum_smp
		// I_tahun1
		// I_tahun2
		// I_tahun3
		// I_tk1
		// I_tk2
		// I_tk3
		// I_dari1
		// I_dari2
		// I_dari3
		// J_melanjutkan
		// J_tanggal_bekerja
		// J_nama_perusahaan
		// J_penghasilan
		// kode_otomatis
		// apakah_valid

		if ($master_siswa->RowType == EW_ROWTYPE_VIEW) { // View row

			// no_absen
			$master_siswa->no_absen->ViewValue = $master_siswa->no_absen->CurrentValue;
			$master_siswa->no_absen->ViewCustomAttributes = "";

			// A_nis_nasional
			$master_siswa->A_nis_nasional->ViewValue = $master_siswa->A_nis_nasional->CurrentValue;
			$master_siswa->A_nis_nasional->ViewCustomAttributes = "";

			// A_nama_Lengkap
			$master_siswa->A_nama_Lengkap->ViewValue = $master_siswa->A_nama_Lengkap->CurrentValue;
			$master_siswa->A_nama_Lengkap->ViewCustomAttributes = "";

			// A_nama_panggilan
			$master_siswa->A_nama_panggilan->ViewValue = $master_siswa->A_nama_panggilan->CurrentValue;
			$master_siswa->A_nama_panggilan->ViewCustomAttributes = "";

			// A_jenis_kelamin
			$master_siswa->A_jenis_kelamin->ViewValue = $master_siswa->A_jenis_kelamin->CurrentValue;
			$master_siswa->A_jenis_kelamin->ViewCustomAttributes = "";

			// A_tempat_lahir
			$master_siswa->A_tempat_lahir->ViewValue = $master_siswa->A_tempat_lahir->CurrentValue;
			$master_siswa->A_tempat_lahir->ViewCustomAttributes = "";

			// A_tanggal_lahir
			$master_siswa->A_tanggal_lahir->ViewValue = $master_siswa->A_tanggal_lahir->CurrentValue;
			$master_siswa->A_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->A_tanggal_lahir->ViewValue, 7);
			$master_siswa->A_tanggal_lahir->ViewCustomAttributes = "";

			// A_agama
			if (strval($master_siswa->A_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->A_agama->CurrentValue) . "'";
			$sSqlWrk = "SELECT `agama` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$master_siswa->A_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->A_agama->ViewValue = $master_siswa->A_agama->CurrentValue;
				}
			} else {
				$master_siswa->A_agama->ViewValue = NULL;
			}
			$master_siswa->A_agama->ViewCustomAttributes = "";

			// A_kewarganegaraan
			$master_siswa->A_kewarganegaraan->ViewValue = $master_siswa->A_kewarganegaraan->CurrentValue;
			$master_siswa->A_kewarganegaraan->ViewCustomAttributes = "";

			// A_anak_keberapa
			$master_siswa->A_anak_keberapa->ViewValue = $master_siswa->A_anak_keberapa->CurrentValue;
			$master_siswa->A_anak_keberapa->ViewCustomAttributes = "";

			// A_jumlah_saudara_kandung
			$master_siswa->A_jumlah_saudara_kandung->ViewValue = $master_siswa->A_jumlah_saudara_kandung->CurrentValue;
			$master_siswa->A_jumlah_saudara_kandung->ViewCustomAttributes = "";

			// A_jumlah_saudara_tiri
			$master_siswa->A_jumlah_saudara_tiri->ViewValue = $master_siswa->A_jumlah_saudara_tiri->CurrentValue;
			$master_siswa->A_jumlah_saudara_tiri->ViewCustomAttributes = "";

			// A_jumlah_saudara_angkat
			$master_siswa->A_jumlah_saudara_angkat->ViewValue = $master_siswa->A_jumlah_saudara_angkat->CurrentValue;
			$master_siswa->A_jumlah_saudara_angkat->ViewCustomAttributes = "";

			// A_status_yatim
			$master_siswa->A_status_yatim->ViewValue = $master_siswa->A_status_yatim->CurrentValue;
			$master_siswa->A_status_yatim->ViewCustomAttributes = "";

			// A_bahasa
			$master_siswa->A_bahasa->ViewValue = $master_siswa->A_bahasa->CurrentValue;
			$master_siswa->A_bahasa->ViewCustomAttributes = "";

			// B_alamat
			$master_siswa->B_alamat->ViewValue = $master_siswa->B_alamat->CurrentValue;
			$master_siswa->B_alamat->ViewCustomAttributes = "";

			// B_telepon_rumah
			$master_siswa->B_telepon_rumah->ViewValue = $master_siswa->B_telepon_rumah->CurrentValue;
			$master_siswa->B_telepon_rumah->ViewCustomAttributes = "";

			// B_tinggal
			$master_siswa->B_tinggal->ViewValue = $master_siswa->B_tinggal->CurrentValue;
			$master_siswa->B_tinggal->ViewCustomAttributes = "";

			// B_jarak
			$master_siswa->B_jarak->ViewValue = $master_siswa->B_jarak->CurrentValue;
			$master_siswa->B_jarak->ViewCustomAttributes = "";

			// B_hp
			$master_siswa->B_hp->ViewValue = $master_siswa->B_hp->CurrentValue;
			$master_siswa->B_hp->ViewCustomAttributes = "";

			// C_golongan_darah
			$master_siswa->C_golongan_darah->ViewValue = $master_siswa->C_golongan_darah->CurrentValue;
			$master_siswa->C_golongan_darah->ViewCustomAttributes = "";

			// C_penyakit
			$master_siswa->C_penyakit->ViewValue = $master_siswa->C_penyakit->CurrentValue;
			$master_siswa->C_penyakit->ViewCustomAttributes = "";

			// C_jasmani
			$master_siswa->C_jasmani->ViewValue = $master_siswa->C_jasmani->CurrentValue;
			$master_siswa->C_jasmani->ViewCustomAttributes = "";

			// C_tinggi
			$master_siswa->C_tinggi->ViewValue = $master_siswa->C_tinggi->CurrentValue;
			$master_siswa->C_tinggi->ViewCustomAttributes = "";

			// C_berat
			$master_siswa->C_berat->ViewValue = $master_siswa->C_berat->CurrentValue;
			$master_siswa->C_berat->ViewCustomAttributes = "";

			// D_tamatan_dari
			$master_siswa->D_tamatan_dari->ViewValue = $master_siswa->D_tamatan_dari->CurrentValue;
			$master_siswa->D_tamatan_dari->ViewCustomAttributes = "";

			// D_sttb
			$master_siswa->D_sttb->ViewValue = $master_siswa->D_sttb->CurrentValue;
			$master_siswa->D_sttb->ViewCustomAttributes = "";

			// D_tanggal_sttb
			$master_siswa->D_tanggal_sttb->ViewValue = $master_siswa->D_tanggal_sttb->CurrentValue;
			$master_siswa->D_tanggal_sttb->ViewValue = ew_FormatDateTime($master_siswa->D_tanggal_sttb->ViewValue, 7);
			$master_siswa->D_tanggal_sttb->ViewCustomAttributes = "";

			// D_danum
			$master_siswa->D_danum->ViewValue = $master_siswa->D_danum->CurrentValue;
			$master_siswa->D_danum->ViewCustomAttributes = "";

			// D_tanggal_danum
			$master_siswa->D_tanggal_danum->ViewValue = $master_siswa->D_tanggal_danum->CurrentValue;
			$master_siswa->D_tanggal_danum->ViewValue = ew_FormatDateTime($master_siswa->D_tanggal_danum->ViewValue, 7);
			$master_siswa->D_tanggal_danum->ViewCustomAttributes = "";

			// D_lama_belajar
			$master_siswa->D_lama_belajar->ViewValue = $master_siswa->D_lama_belajar->CurrentValue;
			$master_siswa->D_lama_belajar->ViewCustomAttributes = "";

			// D_dari_sekolah
			$master_siswa->D_dari_sekolah->ViewValue = $master_siswa->D_dari_sekolah->CurrentValue;
			$master_siswa->D_dari_sekolah->ViewCustomAttributes = "";

			// D_alasan
			$master_siswa->D_alasan->ViewValue = $master_siswa->D_alasan->CurrentValue;
			$master_siswa->D_alasan->ViewCustomAttributes = "";

			// D_kelas
			$master_siswa->D_kelas->ViewValue = $master_siswa->D_kelas->CurrentValue;
			$master_siswa->D_kelas->ViewCustomAttributes = "";

			// D_kelompok
			$master_siswa->D_kelompok->ViewValue = $master_siswa->D_kelompok->CurrentValue;
			$master_siswa->D_kelompok->ViewCustomAttributes = "";

			// D_tanggal
			$master_siswa->D_tanggal->ViewValue = $master_siswa->D_tanggal->CurrentValue;
			$master_siswa->D_tanggal->ViewValue = ew_FormatDateTime($master_siswa->D_tanggal->ViewValue, 7);
			$master_siswa->D_tanggal->ViewCustomAttributes = "";

			// D_saat_ini_tingkat
			$master_siswa->D_saat_ini_tingkat->ViewValue = $master_siswa->D_saat_ini_tingkat->CurrentValue;
			$master_siswa->D_saat_ini_tingkat->ViewCustomAttributes = "";

			// D_saat_ini_kelas
			$master_siswa->D_saat_ini_kelas->ViewValue = $master_siswa->D_saat_ini_kelas->CurrentValue;
			$master_siswa->D_saat_ini_kelas->ViewCustomAttributes = "";

			// D_saat_ini_kelompok
			$master_siswa->D_saat_ini_kelompok->ViewValue = $master_siswa->D_saat_ini_kelompok->CurrentValue;
			$master_siswa->D_saat_ini_kelompok->ViewCustomAttributes = "";

			// D_no_psb
			$master_siswa->D_no_psb->ViewValue = $master_siswa->D_no_psb->CurrentValue;
			$master_siswa->D_no_psb->ViewCustomAttributes = "";

			// D_nilai_danum_sd
			$master_siswa->D_nilai_danum_sd->ViewValue = $master_siswa->D_nilai_danum_sd->CurrentValue;
			$master_siswa->D_nilai_danum_sd->ViewCustomAttributes = "";

			// D_jumlah_pelajaran_danum
			$master_siswa->D_jumlah_pelajaran_danum->ViewValue = $master_siswa->D_jumlah_pelajaran_danum->CurrentValue;
			$master_siswa->D_jumlah_pelajaran_danum->ViewCustomAttributes = "";

			// D_nilai_ujian_psb
			$master_siswa->D_nilai_ujian_psb->ViewValue = $master_siswa->D_nilai_ujian_psb->CurrentValue;
			$master_siswa->D_nilai_ujian_psb->ViewCustomAttributes = "";

			// D_tahun_psb
			$master_siswa->D_tahun_psb->ViewValue = $master_siswa->D_tahun_psb->CurrentValue;
			$master_siswa->D_tahun_psb->ViewCustomAttributes = "";

			// D_diterima
			$master_siswa->D_diterima->ViewValue = $master_siswa->D_diterima->CurrentValue;
			$master_siswa->D_diterima->ViewCustomAttributes = "";

			// D_spp
			$master_siswa->D_spp->ViewValue = $master_siswa->D_spp->CurrentValue;
			$master_siswa->D_spp->ViewCustomAttributes = "";

			// D_spp_potongan
			$master_siswa->D_spp_potongan->ViewValue = $master_siswa->D_spp_potongan->CurrentValue;
			$master_siswa->D_spp_potongan->ViewCustomAttributes = "";

			// D_status_lama_baru
			$master_siswa->D_status_lama_baru->ViewValue = $master_siswa->D_status_lama_baru->CurrentValue;
			$master_siswa->D_status_lama_baru->ViewCustomAttributes = "";

			// E_nama_ayah
			$master_siswa->E_nama_ayah->ViewValue = $master_siswa->E_nama_ayah->CurrentValue;
			$master_siswa->E_nama_ayah->ViewCustomAttributes = "";

			// E_tempat_lahir
			$master_siswa->E_tempat_lahir->ViewValue = $master_siswa->E_tempat_lahir->CurrentValue;
			$master_siswa->E_tempat_lahir->ViewCustomAttributes = "";

			// E_tanggal_lahir
			$master_siswa->E_tanggal_lahir->ViewValue = $master_siswa->E_tanggal_lahir->CurrentValue;
			$master_siswa->E_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->E_tanggal_lahir->ViewValue, 7);
			$master_siswa->E_tanggal_lahir->ViewCustomAttributes = "";

			// E_agama
			if (strval($master_siswa->E_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->E_agama->CurrentValue) . "'";
			$sSqlWrk = "SELECT `agama` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$master_siswa->E_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->E_agama->ViewValue = $master_siswa->E_agama->CurrentValue;
				}
			} else {
				$master_siswa->E_agama->ViewValue = NULL;
			}
			$master_siswa->E_agama->ViewCustomAttributes = "";

			// E_kewarganegaraan
			$master_siswa->E_kewarganegaraan->ViewValue = $master_siswa->E_kewarganegaraan->CurrentValue;
			$master_siswa->E_kewarganegaraan->ViewCustomAttributes = "";

			// E_pendidikan
			$master_siswa->E_pendidikan->ViewValue = $master_siswa->E_pendidikan->CurrentValue;
			$master_siswa->E_pendidikan->ViewCustomAttributes = "";

			// E_pekerjaan
			$master_siswa->E_pekerjaan->ViewValue = $master_siswa->E_pekerjaan->CurrentValue;
			$master_siswa->E_pekerjaan->ViewCustomAttributes = "";

			// E_pengeluaran
			$master_siswa->E_pengeluaran->ViewValue = $master_siswa->E_pengeluaran->CurrentValue;
			$master_siswa->E_pengeluaran->ViewCustomAttributes = "";

			// E_alamat
			$master_siswa->E_alamat->ViewValue = $master_siswa->E_alamat->CurrentValue;
			$master_siswa->E_alamat->ViewCustomAttributes = "";

			// E_telepon
			$master_siswa->E_telepon->ViewValue = $master_siswa->E_telepon->CurrentValue;
			$master_siswa->E_telepon->ViewCustomAttributes = "";

			// E_hp
			$master_siswa->E_hp->ViewValue = $master_siswa->E_hp->CurrentValue;
			$master_siswa->E_hp->ViewCustomAttributes = "";

			// E_hidup
			$master_siswa->E_hidup->ViewValue = $master_siswa->E_hidup->CurrentValue;
			$master_siswa->E_hidup->ViewCustomAttributes = "";

			// F_nama_ibu
			$master_siswa->F_nama_ibu->ViewValue = $master_siswa->F_nama_ibu->CurrentValue;
			$master_siswa->F_nama_ibu->ViewCustomAttributes = "";

			// F_tempat_lahir
			$master_siswa->F_tempat_lahir->ViewValue = $master_siswa->F_tempat_lahir->CurrentValue;
			$master_siswa->F_tempat_lahir->ViewCustomAttributes = "";

			// F_tanggal_lahir
			$master_siswa->F_tanggal_lahir->ViewValue = $master_siswa->F_tanggal_lahir->CurrentValue;
			$master_siswa->F_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->F_tanggal_lahir->ViewValue, 7);
			$master_siswa->F_tanggal_lahir->ViewCustomAttributes = "";

			// F_agama
			if (strval($master_siswa->F_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->F_agama->CurrentValue) . "'";
			$sSqlWrk = "SELECT `agama` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$master_siswa->F_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->F_agama->ViewValue = $master_siswa->F_agama->CurrentValue;
				}
			} else {
				$master_siswa->F_agama->ViewValue = NULL;
			}
			$master_siswa->F_agama->ViewCustomAttributes = "";

			// F_kewarganegaraan
			$master_siswa->F_kewarganegaraan->ViewValue = $master_siswa->F_kewarganegaraan->CurrentValue;
			$master_siswa->F_kewarganegaraan->ViewCustomAttributes = "";

			// F_pendidikan
			$master_siswa->F_pendidikan->ViewValue = $master_siswa->F_pendidikan->CurrentValue;
			$master_siswa->F_pendidikan->ViewCustomAttributes = "";

			// F_pekerjaan
			$master_siswa->F_pekerjaan->ViewValue = $master_siswa->F_pekerjaan->CurrentValue;
			$master_siswa->F_pekerjaan->ViewCustomAttributes = "";

			// F_pengeluaran
			$master_siswa->F_pengeluaran->ViewValue = $master_siswa->F_pengeluaran->CurrentValue;
			$master_siswa->F_pengeluaran->ViewCustomAttributes = "";

			// F_alamat
			$master_siswa->F_alamat->ViewValue = $master_siswa->F_alamat->CurrentValue;
			$master_siswa->F_alamat->ViewCustomAttributes = "";

			// F_telepon
			$master_siswa->F_telepon->ViewValue = $master_siswa->F_telepon->CurrentValue;
			$master_siswa->F_telepon->ViewCustomAttributes = "";

			// F_hp
			$master_siswa->F_hp->ViewValue = $master_siswa->F_hp->CurrentValue;
			$master_siswa->F_hp->ViewCustomAttributes = "";

			// F_hidup
			$master_siswa->F_hidup->ViewValue = $master_siswa->F_hidup->CurrentValue;
			$master_siswa->F_hidup->ViewCustomAttributes = "";

			// G_nama_wali
			$master_siswa->G_nama_wali->ViewValue = $master_siswa->G_nama_wali->CurrentValue;
			$master_siswa->G_nama_wali->ViewCustomAttributes = "";

			// G_tempat_lahir
			$master_siswa->G_tempat_lahir->ViewValue = $master_siswa->G_tempat_lahir->CurrentValue;
			$master_siswa->G_tempat_lahir->ViewCustomAttributes = "";

			// G_tanggal_lahir
			$master_siswa->G_tanggal_lahir->ViewValue = $master_siswa->G_tanggal_lahir->CurrentValue;
			$master_siswa->G_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->G_tanggal_lahir->ViewValue, 7);
			$master_siswa->G_tanggal_lahir->ViewCustomAttributes = "";

			// G_agama
			if (strval($master_siswa->G_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->G_agama->CurrentValue) . "'";
			$sSqlWrk = "SELECT `agama` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$master_siswa->G_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->G_agama->ViewValue = $master_siswa->G_agama->CurrentValue;
				}
			} else {
				$master_siswa->G_agama->ViewValue = NULL;
			}
			$master_siswa->G_agama->ViewCustomAttributes = "";

			// G_kewarganegaraan
			$master_siswa->G_kewarganegaraan->ViewValue = $master_siswa->G_kewarganegaraan->CurrentValue;
			$master_siswa->G_kewarganegaraan->ViewCustomAttributes = "";

			// G_pendidikan
			$master_siswa->G_pendidikan->ViewValue = $master_siswa->G_pendidikan->CurrentValue;
			$master_siswa->G_pendidikan->ViewCustomAttributes = "";

			// G_pekerjaan
			$master_siswa->G_pekerjaan->ViewValue = $master_siswa->G_pekerjaan->CurrentValue;
			$master_siswa->G_pekerjaan->ViewCustomAttributes = "";

			// G_pengeluaran
			$master_siswa->G_pengeluaran->ViewValue = $master_siswa->G_pengeluaran->CurrentValue;
			$master_siswa->G_pengeluaran->ViewCustomAttributes = "";

			// G_alamat
			$master_siswa->G_alamat->ViewValue = $master_siswa->G_alamat->CurrentValue;
			$master_siswa->G_alamat->ViewCustomAttributes = "";

			// G_telepon
			$master_siswa->G_telepon->ViewValue = $master_siswa->G_telepon->CurrentValue;
			$master_siswa->G_telepon->ViewCustomAttributes = "";

			// G_hp
			$master_siswa->G_hp->ViewValue = $master_siswa->G_hp->CurrentValue;
			$master_siswa->G_hp->ViewCustomAttributes = "";

			// H_kesenian
			$master_siswa->H_kesenian->ViewValue = $master_siswa->H_kesenian->CurrentValue;
			$master_siswa->H_kesenian->ViewCustomAttributes = "";

			// H_olahraga
			$master_siswa->H_olahraga->ViewValue = $master_siswa->H_olahraga->CurrentValue;
			$master_siswa->H_olahraga->ViewCustomAttributes = "";

			// H_kemasyarakatan
			$master_siswa->H_kemasyarakatan->ViewValue = $master_siswa->H_kemasyarakatan->CurrentValue;
			$master_siswa->H_kemasyarakatan->ViewCustomAttributes = "";

			// H_lainlain
			$master_siswa->H_lainlain->ViewValue = $master_siswa->H_lainlain->CurrentValue;
			$master_siswa->H_lainlain->ViewCustomAttributes = "";

			// I_tanggal_meninggalkan
			$master_siswa->I_tanggal_meninggalkan->ViewValue = $master_siswa->I_tanggal_meninggalkan->CurrentValue;
			$master_siswa->I_tanggal_meninggalkan->ViewValue = ew_FormatDateTime($master_siswa->I_tanggal_meninggalkan->ViewValue, 7);
			$master_siswa->I_tanggal_meninggalkan->ViewCustomAttributes = "";

			// I_alasan
			$master_siswa->I_alasan->ViewValue = $master_siswa->I_alasan->CurrentValue;
			$master_siswa->I_alasan->ViewCustomAttributes = "";

			// I_tanggal_lulus
			$master_siswa->I_tanggal_lulus->ViewValue = $master_siswa->I_tanggal_lulus->CurrentValue;
			$master_siswa->I_tanggal_lulus->ViewValue = ew_FormatDateTime($master_siswa->I_tanggal_lulus->ViewValue, 7);
			$master_siswa->I_tanggal_lulus->ViewCustomAttributes = "";

			// I_sttb
			$master_siswa->I_sttb->ViewValue = $master_siswa->I_sttb->CurrentValue;
			$master_siswa->I_sttb->ViewCustomAttributes = "";

			// I_danum
			$master_siswa->I_danum->ViewValue = $master_siswa->I_danum->CurrentValue;
			$master_siswa->I_danum->ViewCustomAttributes = "";

			// I_nilai_danum_smp
			$master_siswa->I_nilai_danum_smp->ViewValue = $master_siswa->I_nilai_danum_smp->CurrentValue;
			$master_siswa->I_nilai_danum_smp->ViewCustomAttributes = "";

			// I_tahun1
			$master_siswa->I_tahun1->ViewValue = $master_siswa->I_tahun1->CurrentValue;
			$master_siswa->I_tahun1->ViewCustomAttributes = "";

			// I_tahun2
			$master_siswa->I_tahun2->ViewValue = $master_siswa->I_tahun2->CurrentValue;
			$master_siswa->I_tahun2->ViewCustomAttributes = "";

			// I_tahun3
			$master_siswa->I_tahun3->ViewValue = $master_siswa->I_tahun3->CurrentValue;
			$master_siswa->I_tahun3->ViewCustomAttributes = "";

			// I_tk1
			$master_siswa->I_tk1->ViewValue = $master_siswa->I_tk1->CurrentValue;
			$master_siswa->I_tk1->ViewCustomAttributes = "";

			// I_tk2
			$master_siswa->I_tk2->ViewValue = $master_siswa->I_tk2->CurrentValue;
			$master_siswa->I_tk2->ViewCustomAttributes = "";

			// I_tk3
			$master_siswa->I_tk3->ViewValue = $master_siswa->I_tk3->CurrentValue;
			$master_siswa->I_tk3->ViewCustomAttributes = "";

			// I_dari1
			$master_siswa->I_dari1->ViewValue = $master_siswa->I_dari1->CurrentValue;
			$master_siswa->I_dari1->ViewCustomAttributes = "";

			// I_dari2
			$master_siswa->I_dari2->ViewValue = $master_siswa->I_dari2->CurrentValue;
			$master_siswa->I_dari2->ViewCustomAttributes = "";

			// I_dari3
			$master_siswa->I_dari3->ViewValue = $master_siswa->I_dari3->CurrentValue;
			$master_siswa->I_dari3->ViewCustomAttributes = "";

			// J_melanjutkan
			$master_siswa->J_melanjutkan->ViewValue = $master_siswa->J_melanjutkan->CurrentValue;
			$master_siswa->J_melanjutkan->ViewCustomAttributes = "";

			// J_tanggal_bekerja
			$master_siswa->J_tanggal_bekerja->ViewValue = $master_siswa->J_tanggal_bekerja->CurrentValue;
			$master_siswa->J_tanggal_bekerja->ViewValue = ew_FormatDateTime($master_siswa->J_tanggal_bekerja->ViewValue, 7);
			$master_siswa->J_tanggal_bekerja->ViewCustomAttributes = "";

			// J_nama_perusahaan
			$master_siswa->J_nama_perusahaan->ViewValue = $master_siswa->J_nama_perusahaan->CurrentValue;
			$master_siswa->J_nama_perusahaan->ViewCustomAttributes = "";

			// J_penghasilan
			$master_siswa->J_penghasilan->ViewValue = $master_siswa->J_penghasilan->CurrentValue;
			$master_siswa->J_penghasilan->ViewCustomAttributes = "";

			// kode_otomatis
			$master_siswa->kode_otomatis->ViewValue = $master_siswa->kode_otomatis->CurrentValue;
			$master_siswa->kode_otomatis->ViewCustomAttributes = "";

			// apakah_valid
			if (strval($master_siswa->apakah_valid->CurrentValue) <> "") {
				switch ($master_siswa->apakah_valid->CurrentValue) {
					case "y":
						$master_siswa->apakah_valid->ViewValue = $master_siswa->apakah_valid->FldTagCaption(1) <> "" ? $master_siswa->apakah_valid->FldTagCaption(1) : $master_siswa->apakah_valid->CurrentValue;
						break;
					case "t":
						$master_siswa->apakah_valid->ViewValue = $master_siswa->apakah_valid->FldTagCaption(2) <> "" ? $master_siswa->apakah_valid->FldTagCaption(2) : $master_siswa->apakah_valid->CurrentValue;
						break;
					default:
						$master_siswa->apakah_valid->ViewValue = $master_siswa->apakah_valid->CurrentValue;
				}
			} else {
				$master_siswa->apakah_valid->ViewValue = NULL;
			}
			$master_siswa->apakah_valid->ViewCustomAttributes = "";

			// no_absen
			$master_siswa->no_absen->LinkCustomAttributes = "";
			$master_siswa->no_absen->HrefValue = "";
			$master_siswa->no_absen->TooltipValue = "";

			// A_nis_nasional
			$master_siswa->A_nis_nasional->LinkCustomAttributes = "";
			$master_siswa->A_nis_nasional->HrefValue = "";
			$master_siswa->A_nis_nasional->TooltipValue = "";

			// A_nama_Lengkap
			$master_siswa->A_nama_Lengkap->LinkCustomAttributes = "";
			$master_siswa->A_nama_Lengkap->HrefValue = "";
			$master_siswa->A_nama_Lengkap->TooltipValue = "";

			// A_nama_panggilan
			$master_siswa->A_nama_panggilan->LinkCustomAttributes = "";
			$master_siswa->A_nama_panggilan->HrefValue = "";
			$master_siswa->A_nama_panggilan->TooltipValue = "";

			// A_jenis_kelamin
			$master_siswa->A_jenis_kelamin->LinkCustomAttributes = "";
			$master_siswa->A_jenis_kelamin->HrefValue = "";
			$master_siswa->A_jenis_kelamin->TooltipValue = "";

			// A_tempat_lahir
			$master_siswa->A_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->A_tempat_lahir->HrefValue = "";
			$master_siswa->A_tempat_lahir->TooltipValue = "";

			// A_tanggal_lahir
			$master_siswa->A_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->A_tanggal_lahir->HrefValue = "";
			$master_siswa->A_tanggal_lahir->TooltipValue = "";

			// A_agama
			$master_siswa->A_agama->LinkCustomAttributes = "";
			$master_siswa->A_agama->HrefValue = "";
			$master_siswa->A_agama->TooltipValue = "";

			// A_kewarganegaraan
			$master_siswa->A_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->A_kewarganegaraan->HrefValue = "";
			$master_siswa->A_kewarganegaraan->TooltipValue = "";

			// A_anak_keberapa
			$master_siswa->A_anak_keberapa->LinkCustomAttributes = "";
			$master_siswa->A_anak_keberapa->HrefValue = "";
			$master_siswa->A_anak_keberapa->TooltipValue = "";

			// A_jumlah_saudara_kandung
			$master_siswa->A_jumlah_saudara_kandung->LinkCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_kandung->HrefValue = "";
			$master_siswa->A_jumlah_saudara_kandung->TooltipValue = "";

			// A_jumlah_saudara_tiri
			$master_siswa->A_jumlah_saudara_tiri->LinkCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_tiri->HrefValue = "";
			$master_siswa->A_jumlah_saudara_tiri->TooltipValue = "";

			// A_jumlah_saudara_angkat
			$master_siswa->A_jumlah_saudara_angkat->LinkCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_angkat->HrefValue = "";
			$master_siswa->A_jumlah_saudara_angkat->TooltipValue = "";

			// A_status_yatim
			$master_siswa->A_status_yatim->LinkCustomAttributes = "";
			$master_siswa->A_status_yatim->HrefValue = "";
			$master_siswa->A_status_yatim->TooltipValue = "";

			// A_bahasa
			$master_siswa->A_bahasa->LinkCustomAttributes = "";
			$master_siswa->A_bahasa->HrefValue = "";
			$master_siswa->A_bahasa->TooltipValue = "";

			// B_alamat
			$master_siswa->B_alamat->LinkCustomAttributes = "";
			$master_siswa->B_alamat->HrefValue = "";
			$master_siswa->B_alamat->TooltipValue = "";

			// B_telepon_rumah
			$master_siswa->B_telepon_rumah->LinkCustomAttributes = "";
			$master_siswa->B_telepon_rumah->HrefValue = "";
			$master_siswa->B_telepon_rumah->TooltipValue = "";

			// B_tinggal
			$master_siswa->B_tinggal->LinkCustomAttributes = "";
			$master_siswa->B_tinggal->HrefValue = "";
			$master_siswa->B_tinggal->TooltipValue = "";

			// B_jarak
			$master_siswa->B_jarak->LinkCustomAttributes = "";
			$master_siswa->B_jarak->HrefValue = "";
			$master_siswa->B_jarak->TooltipValue = "";

			// B_hp
			$master_siswa->B_hp->LinkCustomAttributes = "";
			$master_siswa->B_hp->HrefValue = "";
			$master_siswa->B_hp->TooltipValue = "";

			// C_golongan_darah
			$master_siswa->C_golongan_darah->LinkCustomAttributes = "";
			$master_siswa->C_golongan_darah->HrefValue = "";
			$master_siswa->C_golongan_darah->TooltipValue = "";

			// C_penyakit
			$master_siswa->C_penyakit->LinkCustomAttributes = "";
			$master_siswa->C_penyakit->HrefValue = "";
			$master_siswa->C_penyakit->TooltipValue = "";

			// C_jasmani
			$master_siswa->C_jasmani->LinkCustomAttributes = "";
			$master_siswa->C_jasmani->HrefValue = "";
			$master_siswa->C_jasmani->TooltipValue = "";

			// C_tinggi
			$master_siswa->C_tinggi->LinkCustomAttributes = "";
			$master_siswa->C_tinggi->HrefValue = "";
			$master_siswa->C_tinggi->TooltipValue = "";

			// C_berat
			$master_siswa->C_berat->LinkCustomAttributes = "";
			$master_siswa->C_berat->HrefValue = "";
			$master_siswa->C_berat->TooltipValue = "";

			// D_tamatan_dari
			$master_siswa->D_tamatan_dari->LinkCustomAttributes = "";
			$master_siswa->D_tamatan_dari->HrefValue = "";
			$master_siswa->D_tamatan_dari->TooltipValue = "";

			// D_sttb
			$master_siswa->D_sttb->LinkCustomAttributes = "";
			$master_siswa->D_sttb->HrefValue = "";
			$master_siswa->D_sttb->TooltipValue = "";

			// D_tanggal_sttb
			$master_siswa->D_tanggal_sttb->LinkCustomAttributes = "";
			$master_siswa->D_tanggal_sttb->HrefValue = "";
			$master_siswa->D_tanggal_sttb->TooltipValue = "";

			// D_danum
			$master_siswa->D_danum->LinkCustomAttributes = "";
			$master_siswa->D_danum->HrefValue = "";
			$master_siswa->D_danum->TooltipValue = "";

			// D_tanggal_danum
			$master_siswa->D_tanggal_danum->LinkCustomAttributes = "";
			$master_siswa->D_tanggal_danum->HrefValue = "";
			$master_siswa->D_tanggal_danum->TooltipValue = "";

			// D_lama_belajar
			$master_siswa->D_lama_belajar->LinkCustomAttributes = "";
			$master_siswa->D_lama_belajar->HrefValue = "";
			$master_siswa->D_lama_belajar->TooltipValue = "";

			// D_dari_sekolah
			$master_siswa->D_dari_sekolah->LinkCustomAttributes = "";
			$master_siswa->D_dari_sekolah->HrefValue = "";
			$master_siswa->D_dari_sekolah->TooltipValue = "";

			// D_alasan
			$master_siswa->D_alasan->LinkCustomAttributes = "";
			$master_siswa->D_alasan->HrefValue = "";
			$master_siswa->D_alasan->TooltipValue = "";

			// D_kelas
			$master_siswa->D_kelas->LinkCustomAttributes = "";
			$master_siswa->D_kelas->HrefValue = "";
			$master_siswa->D_kelas->TooltipValue = "";

			// D_kelompok
			$master_siswa->D_kelompok->LinkCustomAttributes = "";
			$master_siswa->D_kelompok->HrefValue = "";
			$master_siswa->D_kelompok->TooltipValue = "";

			// D_tanggal
			$master_siswa->D_tanggal->LinkCustomAttributes = "";
			$master_siswa->D_tanggal->HrefValue = "";
			$master_siswa->D_tanggal->TooltipValue = "";

			// D_saat_ini_tingkat
			$master_siswa->D_saat_ini_tingkat->LinkCustomAttributes = "";
			$master_siswa->D_saat_ini_tingkat->HrefValue = "";
			$master_siswa->D_saat_ini_tingkat->TooltipValue = "";

			// D_saat_ini_kelas
			$master_siswa->D_saat_ini_kelas->LinkCustomAttributes = "";
			$master_siswa->D_saat_ini_kelas->HrefValue = "";
			$master_siswa->D_saat_ini_kelas->TooltipValue = "";

			// D_saat_ini_kelompok
			$master_siswa->D_saat_ini_kelompok->LinkCustomAttributes = "";
			$master_siswa->D_saat_ini_kelompok->HrefValue = "";
			$master_siswa->D_saat_ini_kelompok->TooltipValue = "";

			// D_no_psb
			$master_siswa->D_no_psb->LinkCustomAttributes = "";
			$master_siswa->D_no_psb->HrefValue = "";
			$master_siswa->D_no_psb->TooltipValue = "";

			// D_nilai_danum_sd
			$master_siswa->D_nilai_danum_sd->LinkCustomAttributes = "";
			$master_siswa->D_nilai_danum_sd->HrefValue = "";
			$master_siswa->D_nilai_danum_sd->TooltipValue = "";

			// D_jumlah_pelajaran_danum
			$master_siswa->D_jumlah_pelajaran_danum->LinkCustomAttributes = "";
			$master_siswa->D_jumlah_pelajaran_danum->HrefValue = "";
			$master_siswa->D_jumlah_pelajaran_danum->TooltipValue = "";

			// D_nilai_ujian_psb
			$master_siswa->D_nilai_ujian_psb->LinkCustomAttributes = "";
			$master_siswa->D_nilai_ujian_psb->HrefValue = "";
			$master_siswa->D_nilai_ujian_psb->TooltipValue = "";

			// D_tahun_psb
			$master_siswa->D_tahun_psb->LinkCustomAttributes = "";
			$master_siswa->D_tahun_psb->HrefValue = "";
			$master_siswa->D_tahun_psb->TooltipValue = "";

			// D_diterima
			$master_siswa->D_diterima->LinkCustomAttributes = "";
			$master_siswa->D_diterima->HrefValue = "";
			$master_siswa->D_diterima->TooltipValue = "";

			// D_spp
			$master_siswa->D_spp->LinkCustomAttributes = "";
			$master_siswa->D_spp->HrefValue = "";
			$master_siswa->D_spp->TooltipValue = "";

			// D_spp_potongan
			$master_siswa->D_spp_potongan->LinkCustomAttributes = "";
			$master_siswa->D_spp_potongan->HrefValue = "";
			$master_siswa->D_spp_potongan->TooltipValue = "";

			// D_status_lama_baru
			$master_siswa->D_status_lama_baru->LinkCustomAttributes = "";
			$master_siswa->D_status_lama_baru->HrefValue = "";
			$master_siswa->D_status_lama_baru->TooltipValue = "";

			// E_nama_ayah
			$master_siswa->E_nama_ayah->LinkCustomAttributes = "";
			$master_siswa->E_nama_ayah->HrefValue = "";
			$master_siswa->E_nama_ayah->TooltipValue = "";

			// E_tempat_lahir
			$master_siswa->E_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->E_tempat_lahir->HrefValue = "";
			$master_siswa->E_tempat_lahir->TooltipValue = "";

			// E_tanggal_lahir
			$master_siswa->E_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->E_tanggal_lahir->HrefValue = "";
			$master_siswa->E_tanggal_lahir->TooltipValue = "";

			// E_agama
			$master_siswa->E_agama->LinkCustomAttributes = "";
			$master_siswa->E_agama->HrefValue = "";
			$master_siswa->E_agama->TooltipValue = "";

			// E_kewarganegaraan
			$master_siswa->E_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->E_kewarganegaraan->HrefValue = "";
			$master_siswa->E_kewarganegaraan->TooltipValue = "";

			// E_pendidikan
			$master_siswa->E_pendidikan->LinkCustomAttributes = "";
			$master_siswa->E_pendidikan->HrefValue = "";
			$master_siswa->E_pendidikan->TooltipValue = "";

			// E_pekerjaan
			$master_siswa->E_pekerjaan->LinkCustomAttributes = "";
			$master_siswa->E_pekerjaan->HrefValue = "";
			$master_siswa->E_pekerjaan->TooltipValue = "";

			// E_pengeluaran
			$master_siswa->E_pengeluaran->LinkCustomAttributes = "";
			$master_siswa->E_pengeluaran->HrefValue = "";
			$master_siswa->E_pengeluaran->TooltipValue = "";

			// E_alamat
			$master_siswa->E_alamat->LinkCustomAttributes = "";
			$master_siswa->E_alamat->HrefValue = "";
			$master_siswa->E_alamat->TooltipValue = "";

			// E_telepon
			$master_siswa->E_telepon->LinkCustomAttributes = "";
			$master_siswa->E_telepon->HrefValue = "";
			$master_siswa->E_telepon->TooltipValue = "";

			// E_hp
			$master_siswa->E_hp->LinkCustomAttributes = "";
			$master_siswa->E_hp->HrefValue = "";
			$master_siswa->E_hp->TooltipValue = "";

			// E_hidup
			$master_siswa->E_hidup->LinkCustomAttributes = "";
			$master_siswa->E_hidup->HrefValue = "";
			$master_siswa->E_hidup->TooltipValue = "";

			// F_nama_ibu
			$master_siswa->F_nama_ibu->LinkCustomAttributes = "";
			$master_siswa->F_nama_ibu->HrefValue = "";
			$master_siswa->F_nama_ibu->TooltipValue = "";

			// F_tempat_lahir
			$master_siswa->F_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->F_tempat_lahir->HrefValue = "";
			$master_siswa->F_tempat_lahir->TooltipValue = "";

			// F_tanggal_lahir
			$master_siswa->F_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->F_tanggal_lahir->HrefValue = "";
			$master_siswa->F_tanggal_lahir->TooltipValue = "";

			// F_agama
			$master_siswa->F_agama->LinkCustomAttributes = "";
			$master_siswa->F_agama->HrefValue = "";
			$master_siswa->F_agama->TooltipValue = "";

			// F_kewarganegaraan
			$master_siswa->F_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->F_kewarganegaraan->HrefValue = "";
			$master_siswa->F_kewarganegaraan->TooltipValue = "";

			// F_pendidikan
			$master_siswa->F_pendidikan->LinkCustomAttributes = "";
			$master_siswa->F_pendidikan->HrefValue = "";
			$master_siswa->F_pendidikan->TooltipValue = "";

			// F_pekerjaan
			$master_siswa->F_pekerjaan->LinkCustomAttributes = "";
			$master_siswa->F_pekerjaan->HrefValue = "";
			$master_siswa->F_pekerjaan->TooltipValue = "";

			// F_pengeluaran
			$master_siswa->F_pengeluaran->LinkCustomAttributes = "";
			$master_siswa->F_pengeluaran->HrefValue = "";
			$master_siswa->F_pengeluaran->TooltipValue = "";

			// F_alamat
			$master_siswa->F_alamat->LinkCustomAttributes = "";
			$master_siswa->F_alamat->HrefValue = "";
			$master_siswa->F_alamat->TooltipValue = "";

			// F_telepon
			$master_siswa->F_telepon->LinkCustomAttributes = "";
			$master_siswa->F_telepon->HrefValue = "";
			$master_siswa->F_telepon->TooltipValue = "";

			// F_hp
			$master_siswa->F_hp->LinkCustomAttributes = "";
			$master_siswa->F_hp->HrefValue = "";
			$master_siswa->F_hp->TooltipValue = "";

			// F_hidup
			$master_siswa->F_hidup->LinkCustomAttributes = "";
			$master_siswa->F_hidup->HrefValue = "";
			$master_siswa->F_hidup->TooltipValue = "";

			// G_nama_wali
			$master_siswa->G_nama_wali->LinkCustomAttributes = "";
			$master_siswa->G_nama_wali->HrefValue = "";
			$master_siswa->G_nama_wali->TooltipValue = "";

			// G_tempat_lahir
			$master_siswa->G_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->G_tempat_lahir->HrefValue = "";
			$master_siswa->G_tempat_lahir->TooltipValue = "";

			// G_tanggal_lahir
			$master_siswa->G_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->G_tanggal_lahir->HrefValue = "";
			$master_siswa->G_tanggal_lahir->TooltipValue = "";

			// G_agama
			$master_siswa->G_agama->LinkCustomAttributes = "";
			$master_siswa->G_agama->HrefValue = "";
			$master_siswa->G_agama->TooltipValue = "";

			// G_kewarganegaraan
			$master_siswa->G_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->G_kewarganegaraan->HrefValue = "";
			$master_siswa->G_kewarganegaraan->TooltipValue = "";

			// G_pendidikan
			$master_siswa->G_pendidikan->LinkCustomAttributes = "";
			$master_siswa->G_pendidikan->HrefValue = "";
			$master_siswa->G_pendidikan->TooltipValue = "";

			// G_pekerjaan
			$master_siswa->G_pekerjaan->LinkCustomAttributes = "";
			$master_siswa->G_pekerjaan->HrefValue = "";
			$master_siswa->G_pekerjaan->TooltipValue = "";

			// G_pengeluaran
			$master_siswa->G_pengeluaran->LinkCustomAttributes = "";
			$master_siswa->G_pengeluaran->HrefValue = "";
			$master_siswa->G_pengeluaran->TooltipValue = "";

			// G_alamat
			$master_siswa->G_alamat->LinkCustomAttributes = "";
			$master_siswa->G_alamat->HrefValue = "";
			$master_siswa->G_alamat->TooltipValue = "";

			// G_telepon
			$master_siswa->G_telepon->LinkCustomAttributes = "";
			$master_siswa->G_telepon->HrefValue = "";
			$master_siswa->G_telepon->TooltipValue = "";

			// G_hp
			$master_siswa->G_hp->LinkCustomAttributes = "";
			$master_siswa->G_hp->HrefValue = "";
			$master_siswa->G_hp->TooltipValue = "";

			// H_kesenian
			$master_siswa->H_kesenian->LinkCustomAttributes = "";
			$master_siswa->H_kesenian->HrefValue = "";
			$master_siswa->H_kesenian->TooltipValue = "";

			// H_olahraga
			$master_siswa->H_olahraga->LinkCustomAttributes = "";
			$master_siswa->H_olahraga->HrefValue = "";
			$master_siswa->H_olahraga->TooltipValue = "";

			// H_kemasyarakatan
			$master_siswa->H_kemasyarakatan->LinkCustomAttributes = "";
			$master_siswa->H_kemasyarakatan->HrefValue = "";
			$master_siswa->H_kemasyarakatan->TooltipValue = "";

			// H_lainlain
			$master_siswa->H_lainlain->LinkCustomAttributes = "";
			$master_siswa->H_lainlain->HrefValue = "";
			$master_siswa->H_lainlain->TooltipValue = "";

			// I_tanggal_meninggalkan
			$master_siswa->I_tanggal_meninggalkan->LinkCustomAttributes = "";
			$master_siswa->I_tanggal_meninggalkan->HrefValue = "";
			$master_siswa->I_tanggal_meninggalkan->TooltipValue = "";

			// I_alasan
			$master_siswa->I_alasan->LinkCustomAttributes = "";
			$master_siswa->I_alasan->HrefValue = "";
			$master_siswa->I_alasan->TooltipValue = "";

			// I_tanggal_lulus
			$master_siswa->I_tanggal_lulus->LinkCustomAttributes = "";
			$master_siswa->I_tanggal_lulus->HrefValue = "";
			$master_siswa->I_tanggal_lulus->TooltipValue = "";

			// I_sttb
			$master_siswa->I_sttb->LinkCustomAttributes = "";
			$master_siswa->I_sttb->HrefValue = "";
			$master_siswa->I_sttb->TooltipValue = "";

			// I_danum
			$master_siswa->I_danum->LinkCustomAttributes = "";
			$master_siswa->I_danum->HrefValue = "";
			$master_siswa->I_danum->TooltipValue = "";

			// I_nilai_danum_smp
			$master_siswa->I_nilai_danum_smp->LinkCustomAttributes = "";
			$master_siswa->I_nilai_danum_smp->HrefValue = "";
			$master_siswa->I_nilai_danum_smp->TooltipValue = "";

			// I_tahun1
			$master_siswa->I_tahun1->LinkCustomAttributes = "";
			$master_siswa->I_tahun1->HrefValue = "";
			$master_siswa->I_tahun1->TooltipValue = "";

			// I_tahun2
			$master_siswa->I_tahun2->LinkCustomAttributes = "";
			$master_siswa->I_tahun2->HrefValue = "";
			$master_siswa->I_tahun2->TooltipValue = "";

			// I_tahun3
			$master_siswa->I_tahun3->LinkCustomAttributes = "";
			$master_siswa->I_tahun3->HrefValue = "";
			$master_siswa->I_tahun3->TooltipValue = "";

			// I_tk1
			$master_siswa->I_tk1->LinkCustomAttributes = "";
			$master_siswa->I_tk1->HrefValue = "";
			$master_siswa->I_tk1->TooltipValue = "";

			// I_tk2
			$master_siswa->I_tk2->LinkCustomAttributes = "";
			$master_siswa->I_tk2->HrefValue = "";
			$master_siswa->I_tk2->TooltipValue = "";

			// I_tk3
			$master_siswa->I_tk3->LinkCustomAttributes = "";
			$master_siswa->I_tk3->HrefValue = "";
			$master_siswa->I_tk3->TooltipValue = "";

			// I_dari1
			$master_siswa->I_dari1->LinkCustomAttributes = "";
			$master_siswa->I_dari1->HrefValue = "";
			$master_siswa->I_dari1->TooltipValue = "";

			// I_dari2
			$master_siswa->I_dari2->LinkCustomAttributes = "";
			$master_siswa->I_dari2->HrefValue = "";
			$master_siswa->I_dari2->TooltipValue = "";

			// I_dari3
			$master_siswa->I_dari3->LinkCustomAttributes = "";
			$master_siswa->I_dari3->HrefValue = "";
			$master_siswa->I_dari3->TooltipValue = "";

			// J_melanjutkan
			$master_siswa->J_melanjutkan->LinkCustomAttributes = "";
			$master_siswa->J_melanjutkan->HrefValue = "";
			$master_siswa->J_melanjutkan->TooltipValue = "";

			// J_tanggal_bekerja
			$master_siswa->J_tanggal_bekerja->LinkCustomAttributes = "";
			$master_siswa->J_tanggal_bekerja->HrefValue = "";
			$master_siswa->J_tanggal_bekerja->TooltipValue = "";

			// J_nama_perusahaan
			$master_siswa->J_nama_perusahaan->LinkCustomAttributes = "";
			$master_siswa->J_nama_perusahaan->HrefValue = "";
			$master_siswa->J_nama_perusahaan->TooltipValue = "";

			// J_penghasilan
			$master_siswa->J_penghasilan->LinkCustomAttributes = "";
			$master_siswa->J_penghasilan->HrefValue = "";
			$master_siswa->J_penghasilan->TooltipValue = "";

			// kode_otomatis
			$master_siswa->kode_otomatis->LinkCustomAttributes = "";
			$master_siswa->kode_otomatis->HrefValue = "";
			$master_siswa->kode_otomatis->TooltipValue = "";

			// apakah_valid
			$master_siswa->apakah_valid->LinkCustomAttributes = "";
			$master_siswa->apakah_valid->HrefValue = "";
			$master_siswa->apakah_valid->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($master_siswa->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$master_siswa->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $master_siswa;

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
		global $master_siswa;
		$master_siswa->no_absen->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_no_absen");
		$master_siswa->no_absen->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_no_absen");
		$master_siswa->no_absen->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_no_absen");
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_nis_nasional");
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_nis_nasional");
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_nis_nasional");
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_nama_Lengkap");
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_nama_Lengkap");
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_nama_Lengkap");
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_nama_panggilan");
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_nama_panggilan");
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_nama_panggilan");
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_jenis_kelamin");
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_jenis_kelamin");
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_jenis_kelamin");
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_tempat_lahir");
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_tempat_lahir");
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_tempat_lahir");
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_tanggal_lahir");
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_tanggal_lahir");
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_tanggal_lahir");
		$master_siswa->A_agama->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_agama");
		$master_siswa->A_agama->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_agama");
		$master_siswa->A_agama->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_agama");
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_kewarganegaraan");
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_kewarganegaraan");
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_kewarganegaraan");
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_anak_keberapa");
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_anak_keberapa");
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_anak_keberapa");
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_jumlah_saudara_kandung");
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_jumlah_saudara_kandung");
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_jumlah_saudara_kandung");
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_jumlah_saudara_tiri");
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_jumlah_saudara_tiri");
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_jumlah_saudara_tiri");
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_jumlah_saudara_angkat");
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_jumlah_saudara_angkat");
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_jumlah_saudara_angkat");
		$master_siswa->A_status_yatim->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_status_yatim");
		$master_siswa->A_status_yatim->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_status_yatim");
		$master_siswa->A_status_yatim->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_status_yatim");
		$master_siswa->A_bahasa->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_bahasa");
		$master_siswa->A_bahasa->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_bahasa");
		$master_siswa->A_bahasa->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_bahasa");
		$master_siswa->B_alamat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_B_alamat");
		$master_siswa->B_alamat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_B_alamat");
		$master_siswa->B_alamat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_B_alamat");
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_B_telepon_rumah");
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_B_telepon_rumah");
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_B_telepon_rumah");
		$master_siswa->B_tinggal->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_B_tinggal");
		$master_siswa->B_tinggal->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_B_tinggal");
		$master_siswa->B_tinggal->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_B_tinggal");
		$master_siswa->B_jarak->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_B_jarak");
		$master_siswa->B_jarak->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_B_jarak");
		$master_siswa->B_jarak->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_B_jarak");
		$master_siswa->B_hp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_B_hp");
		$master_siswa->B_hp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_B_hp");
		$master_siswa->B_hp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_B_hp");
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_C_golongan_darah");
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_C_golongan_darah");
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_C_golongan_darah");
		$master_siswa->C_penyakit->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_C_penyakit");
		$master_siswa->C_penyakit->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_C_penyakit");
		$master_siswa->C_penyakit->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_C_penyakit");
		$master_siswa->C_jasmani->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_C_jasmani");
		$master_siswa->C_jasmani->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_C_jasmani");
		$master_siswa->C_jasmani->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_C_jasmani");
		$master_siswa->C_tinggi->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_C_tinggi");
		$master_siswa->C_tinggi->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_C_tinggi");
		$master_siswa->C_tinggi->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_C_tinggi");
		$master_siswa->C_berat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_C_berat");
		$master_siswa->C_berat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_C_berat");
		$master_siswa->C_berat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_C_berat");
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_tamatan_dari");
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_tamatan_dari");
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_tamatan_dari");
		$master_siswa->D_sttb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_sttb");
		$master_siswa->D_sttb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_sttb");
		$master_siswa->D_sttb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_sttb");
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_tanggal_sttb");
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_tanggal_sttb");
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_tanggal_sttb");
		$master_siswa->D_danum->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_danum");
		$master_siswa->D_danum->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_danum");
		$master_siswa->D_danum->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_danum");
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_tanggal_danum");
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_tanggal_danum");
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_tanggal_danum");
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_lama_belajar");
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_lama_belajar");
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_lama_belajar");
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_dari_sekolah");
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_dari_sekolah");
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_dari_sekolah");
		$master_siswa->D_alasan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_alasan");
		$master_siswa->D_alasan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_alasan");
		$master_siswa->D_alasan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_alasan");
		$master_siswa->D_kelas->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_kelas");
		$master_siswa->D_kelas->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_kelas");
		$master_siswa->D_kelas->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_kelas");
		$master_siswa->D_kelompok->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_kelompok");
		$master_siswa->D_kelompok->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_kelompok");
		$master_siswa->D_kelompok->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_kelompok");
		$master_siswa->D_tanggal->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_tanggal");
		$master_siswa->D_tanggal->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_tanggal");
		$master_siswa->D_tanggal->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_tanggal");
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_saat_ini_tingkat");
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_saat_ini_tingkat");
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_saat_ini_tingkat");
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_saat_ini_kelas");
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_saat_ini_kelas");
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_saat_ini_kelas");
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_saat_ini_kelompok");
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_saat_ini_kelompok");
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_saat_ini_kelompok");
		$master_siswa->D_no_psb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_no_psb");
		$master_siswa->D_no_psb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_no_psb");
		$master_siswa->D_no_psb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_no_psb");
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_nilai_danum_sd");
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_nilai_danum_sd");
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_nilai_danum_sd");
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_jumlah_pelajaran_danum");
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_jumlah_pelajaran_danum");
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_jumlah_pelajaran_danum");
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_nilai_ujian_psb");
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_nilai_ujian_psb");
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_nilai_ujian_psb");
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_tahun_psb");
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_tahun_psb");
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_tahun_psb");
		$master_siswa->D_diterima->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_diterima");
		$master_siswa->D_diterima->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_diterima");
		$master_siswa->D_diterima->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_diterima");
		$master_siswa->D_spp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_spp");
		$master_siswa->D_spp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_spp");
		$master_siswa->D_spp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_spp");
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_spp_potongan");
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_spp_potongan");
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_spp_potongan");
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_status_lama_baru");
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_status_lama_baru");
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_status_lama_baru");
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_nama_ayah");
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_nama_ayah");
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_nama_ayah");
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_tempat_lahir");
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_tempat_lahir");
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_tempat_lahir");
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_tanggal_lahir");
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_tanggal_lahir");
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_tanggal_lahir");
		$master_siswa->E_agama->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_agama");
		$master_siswa->E_agama->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_agama");
		$master_siswa->E_agama->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_agama");
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_kewarganegaraan");
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_kewarganegaraan");
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_kewarganegaraan");
		$master_siswa->E_pendidikan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_pendidikan");
		$master_siswa->E_pendidikan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_pendidikan");
		$master_siswa->E_pendidikan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_pendidikan");
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_pekerjaan");
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_pekerjaan");
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_pekerjaan");
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_pengeluaran");
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_pengeluaran");
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_pengeluaran");
		$master_siswa->E_alamat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_alamat");
		$master_siswa->E_alamat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_alamat");
		$master_siswa->E_alamat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_alamat");
		$master_siswa->E_telepon->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_telepon");
		$master_siswa->E_telepon->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_telepon");
		$master_siswa->E_telepon->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_telepon");
		$master_siswa->E_hp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_hp");
		$master_siswa->E_hp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_hp");
		$master_siswa->E_hp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_hp");
		$master_siswa->E_hidup->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_hidup");
		$master_siswa->E_hidup->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_hidup");
		$master_siswa->E_hidup->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_hidup");
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_nama_ibu");
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_nama_ibu");
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_nama_ibu");
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_tempat_lahir");
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_tempat_lahir");
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_tempat_lahir");
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_tanggal_lahir");
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_tanggal_lahir");
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_tanggal_lahir");
		$master_siswa->F_agama->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_agama");
		$master_siswa->F_agama->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_agama");
		$master_siswa->F_agama->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_agama");
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_kewarganegaraan");
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_kewarganegaraan");
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_kewarganegaraan");
		$master_siswa->F_pendidikan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_pendidikan");
		$master_siswa->F_pendidikan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_pendidikan");
		$master_siswa->F_pendidikan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_pendidikan");
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_pekerjaan");
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_pekerjaan");
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_pekerjaan");
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_pengeluaran");
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_pengeluaran");
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_pengeluaran");
		$master_siswa->F_alamat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_alamat");
		$master_siswa->F_alamat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_alamat");
		$master_siswa->F_alamat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_alamat");
		$master_siswa->F_telepon->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_telepon");
		$master_siswa->F_telepon->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_telepon");
		$master_siswa->F_telepon->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_telepon");
		$master_siswa->F_hp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_hp");
		$master_siswa->F_hp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_hp");
		$master_siswa->F_hp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_hp");
		$master_siswa->F_hidup->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_hidup");
		$master_siswa->F_hidup->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_hidup");
		$master_siswa->F_hidup->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_hidup");
		$master_siswa->G_nama_wali->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_nama_wali");
		$master_siswa->G_nama_wali->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_nama_wali");
		$master_siswa->G_nama_wali->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_nama_wali");
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_tempat_lahir");
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_tempat_lahir");
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_tempat_lahir");
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_tanggal_lahir");
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_tanggal_lahir");
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_tanggal_lahir");
		$master_siswa->G_agama->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_agama");
		$master_siswa->G_agama->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_agama");
		$master_siswa->G_agama->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_agama");
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_kewarganegaraan");
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_kewarganegaraan");
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_kewarganegaraan");
		$master_siswa->G_pendidikan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_pendidikan");
		$master_siswa->G_pendidikan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_pendidikan");
		$master_siswa->G_pendidikan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_pendidikan");
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_pekerjaan");
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_pekerjaan");
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_pekerjaan");
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_pengeluaran");
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_pengeluaran");
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_pengeluaran");
		$master_siswa->G_alamat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_alamat");
		$master_siswa->G_alamat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_alamat");
		$master_siswa->G_alamat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_alamat");
		$master_siswa->G_telepon->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_telepon");
		$master_siswa->G_telepon->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_telepon");
		$master_siswa->G_telepon->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_telepon");
		$master_siswa->G_hp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_hp");
		$master_siswa->G_hp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_hp");
		$master_siswa->G_hp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_hp");
		$master_siswa->H_kesenian->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_H_kesenian");
		$master_siswa->H_kesenian->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_H_kesenian");
		$master_siswa->H_kesenian->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_H_kesenian");
		$master_siswa->H_olahraga->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_H_olahraga");
		$master_siswa->H_olahraga->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_H_olahraga");
		$master_siswa->H_olahraga->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_H_olahraga");
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_H_kemasyarakatan");
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_H_kemasyarakatan");
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_H_kemasyarakatan");
		$master_siswa->H_lainlain->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_H_lainlain");
		$master_siswa->H_lainlain->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_H_lainlain");
		$master_siswa->H_lainlain->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_H_lainlain");
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tanggal_meninggalkan");
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tanggal_meninggalkan");
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tanggal_meninggalkan");
		$master_siswa->I_alasan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_alasan");
		$master_siswa->I_alasan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_alasan");
		$master_siswa->I_alasan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_alasan");
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tanggal_lulus");
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tanggal_lulus");
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tanggal_lulus");
		$master_siswa->I_sttb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_sttb");
		$master_siswa->I_sttb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_sttb");
		$master_siswa->I_sttb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_sttb");
		$master_siswa->I_danum->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_danum");
		$master_siswa->I_danum->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_danum");
		$master_siswa->I_danum->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_danum");
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_nilai_danum_smp");
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_nilai_danum_smp");
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_nilai_danum_smp");
		$master_siswa->I_tahun1->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tahun1");
		$master_siswa->I_tahun1->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tahun1");
		$master_siswa->I_tahun1->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tahun1");
		$master_siswa->I_tahun2->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tahun2");
		$master_siswa->I_tahun2->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tahun2");
		$master_siswa->I_tahun2->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tahun2");
		$master_siswa->I_tahun3->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tahun3");
		$master_siswa->I_tahun3->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tahun3");
		$master_siswa->I_tahun3->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tahun3");
		$master_siswa->I_tk1->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tk1");
		$master_siswa->I_tk1->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tk1");
		$master_siswa->I_tk1->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tk1");
		$master_siswa->I_tk2->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tk2");
		$master_siswa->I_tk2->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tk2");
		$master_siswa->I_tk2->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tk2");
		$master_siswa->I_tk3->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tk3");
		$master_siswa->I_tk3->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tk3");
		$master_siswa->I_tk3->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tk3");
		$master_siswa->I_dari1->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_dari1");
		$master_siswa->I_dari1->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_dari1");
		$master_siswa->I_dari1->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_dari1");
		$master_siswa->I_dari2->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_dari2");
		$master_siswa->I_dari2->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_dari2");
		$master_siswa->I_dari2->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_dari2");
		$master_siswa->I_dari3->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_dari3");
		$master_siswa->I_dari3->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_dari3");
		$master_siswa->I_dari3->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_dari3");
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_J_melanjutkan");
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_J_melanjutkan");
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_J_melanjutkan");
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_J_tanggal_bekerja");
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_J_tanggal_bekerja");
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_J_tanggal_bekerja");
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_J_nama_perusahaan");
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_J_nama_perusahaan");
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_J_nama_perusahaan");
		$master_siswa->J_penghasilan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_J_penghasilan");
		$master_siswa->J_penghasilan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_J_penghasilan");
		$master_siswa->J_penghasilan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_J_penghasilan");
		$master_siswa->kode_otomatis->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_kode_otomatis");
		$master_siswa->kode_otomatis->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_kode_otomatis");
		$master_siswa->kode_otomatis->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_kode_otomatis");
		$master_siswa->apakah_valid->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_apakah_valid");
		$master_siswa->apakah_valid->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_apakah_valid");
		$master_siswa->apakah_valid->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_apakah_valid");
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $master_siswa;
		$sWrkFilter = "";
		if ($master_siswa->Export <> "") {
			$sWrkFilter = $master_siswa->GetKeyFilter();
		}
		return $sWrkFilter;
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $master_siswa;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fmaster_siswalist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','print');\">" . "<img src=\"phpimages/print.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fmaster_siswalist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','excel');\">" . "<img src=\"phpimages/exportxls.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fmaster_siswalist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','word');\">" . "<img src=\"phpimages/exportdoc.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fmaster_siswalist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','html');\">" . "<img src=\"phpimages/exporthtml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fmaster_siswalist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','xml');\">" . "<img src=\"phpimages/exportxml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fmaster_siswalist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','csv');\">" . "<img src=\"phpimages/exportcsv.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fmaster_siswalist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','pdf');\">" . "<img src=\"phpimages/exportpdf.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_master_siswa\" id=\"emf_master_siswa\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_master_siswa',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fmaster_siswalist,sel:true});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($master_siswa->Export <> "" ||
			$master_siswa->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $master_siswa;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $master_siswa->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($master_siswa->ExportAll) {
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs < 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($master_siswa->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($master_siswa, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($master_siswa->Export == "xml") {
			$master_siswa->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$master_siswa->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($master_siswa->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($master_siswa->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($master_siswa->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($master_siswa->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($master_siswa->ExportReturnUrl());
		} elseif ($master_siswa->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
	}

		// Page Load event
function Page_Load() {  
	global $Language;  
	$Language->setPhrase("showall","");
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

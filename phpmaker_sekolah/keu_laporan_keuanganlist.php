<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_laporan_keuanganinfo.php" ?>
<?php include_once "keu_cicilaninfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_laporan_keuangan_list = new ckeu_laporan_keuangan_list();
$Page =& $keu_laporan_keuangan_list;

// Page init
$keu_laporan_keuangan_list->Page_Init();

// Page main
$keu_laporan_keuangan_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($keu_laporan_keuangan->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var keu_laporan_keuangan_list = new ew_Page("keu_laporan_keuangan_list");

// page properties
keu_laporan_keuangan_list.PageID = "list"; // page ID
keu_laporan_keuangan_list.FormID = "fkeu_laporan_keuanganlist"; // form ID
var EW_PAGE_ID = keu_laporan_keuangan_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
keu_laporan_keuangan_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_laporan_keuangan_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_laporan_keuangan_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
keu_laporan_keuangan_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
keu_laporan_keuangan_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if (($keu_laporan_keuangan->Export == "") || (EW_EXPORT_MASTER_RECORD && $keu_laporan_keuangan->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$keu_laporan_keuangan_list->TotalRecs = $keu_laporan_keuangan->SelectRecordCount();
	} else {
		if ($keu_laporan_keuangan_list->Recordset = $keu_laporan_keuangan_list->LoadRecordset())
			$keu_laporan_keuangan_list->TotalRecs = $keu_laporan_keuangan_list->Recordset->RecordCount();
	}
	$keu_laporan_keuangan_list->StartRec = 1;
	if ($keu_laporan_keuangan_list->DisplayRecs <= 0 || ($keu_laporan_keuangan->Export <> "" && $keu_laporan_keuangan->ExportAll)) // Display all records
		$keu_laporan_keuangan_list->DisplayRecs = $keu_laporan_keuangan_list->TotalRecs;
	if (!($keu_laporan_keuangan->Export <> "" && $keu_laporan_keuangan->ExportAll))
		$keu_laporan_keuangan_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$keu_laporan_keuangan_list->Recordset = $keu_laporan_keuangan_list->LoadRecordset($keu_laporan_keuangan_list->StartRec-1, $keu_laporan_keuangan_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $keu_laporan_keuangan->TableCaption() ?>
&nbsp;&nbsp;<?php $keu_laporan_keuangan_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($keu_laporan_keuangan->Export == "" && $keu_laporan_keuangan->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(keu_laporan_keuangan_list);" style="text-decoration: none;"><img id="keu_laporan_keuangan_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="keu_laporan_keuangan_list_SearchPanel">
<form name="fkeu_laporan_keuanganlistsrch" id="fkeu_laporan_keuanganlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="keu_laporan_keuangan">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $keu_laporan_keuangan_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
	<a href="keu_laporan_keuangansrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
	<?php if ($keu_laporan_keuangan_list->SearchWhere <> "" && $keu_laporan_keuangan_list->TotalRecs > 0) { ?>
	<a href="javascript:void(0);" onclick="ew_ToggleHighlight(keu_laporan_keuangan_list, this, '<?php echo $keu_laporan_keuangan->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
	<?php } ?>
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($keu_laporan_keuangan->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($keu_laporan_keuangan->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($keu_laporan_keuangan->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $keu_laporan_keuangan_list->ShowPageHeader(); ?>
<?php
$keu_laporan_keuangan_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($keu_laporan_keuangan->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($keu_laporan_keuangan->CurrentAction <> "gridadd" && $keu_laporan_keuangan->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($keu_laporan_keuangan_list->Pager)) $keu_laporan_keuangan_list->Pager = new cNumericPager($keu_laporan_keuangan_list->StartRec, $keu_laporan_keuangan_list->DisplayRecs, $keu_laporan_keuangan_list->TotalRecs, $keu_laporan_keuangan_list->RecRange) ?>
<?php if ($keu_laporan_keuangan_list->Pager->RecordCount > 0) { ?>
	<?php if ($keu_laporan_keuangan_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $keu_laporan_keuangan_list->PageUrl() ?>start=<?php echo $keu_laporan_keuangan_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_laporan_keuangan_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $keu_laporan_keuangan_list->PageUrl() ?>start=<?php echo $keu_laporan_keuangan_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($keu_laporan_keuangan_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $keu_laporan_keuangan_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($keu_laporan_keuangan_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $keu_laporan_keuangan_list->PageUrl() ?>start=<?php echo $keu_laporan_keuangan_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_laporan_keuangan_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $keu_laporan_keuangan_list->PageUrl() ?>start=<?php echo $keu_laporan_keuangan_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($keu_laporan_keuangan_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $keu_laporan_keuangan_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $keu_laporan_keuangan_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $keu_laporan_keuangan_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($keu_laporan_keuangan_list->SearchWhere == "0=101") { ?>
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
<?php if ($keu_laporan_keuangan_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="keu_laporan_keuangan">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($keu_laporan_keuangan_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($keu_laporan_keuangan_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($keu_laporan_keuangan_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($keu_laporan_keuangan_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($keu_laporan_keuangan_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
</span>
</div>
<?php } ?>
<form name="fkeu_laporan_keuanganlist" id="fkeu_laporan_keuanganlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="keu_laporan_keuangan">
<div id="gmp_keu_laporan_keuangan" class="ewGridMiddlePanel">
<?php if ($keu_laporan_keuangan_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $keu_laporan_keuangan->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$keu_laporan_keuangan_list->RenderListOptions();

// Render list options (header, left)
$keu_laporan_keuangan_list->ListOptions->Render("header", "left");
?>
<?php if ($keu_laporan_keuangan->identitas->Visible) { // identitas ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->identitas) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->identitas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->identitas) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->identitas->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->identitas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->identitas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->A_nama_lengkap->Visible) { // A_nama_lengkap ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->A_nama_lengkap) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->A_nama_lengkap->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->A_nama_lengkap) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->A_nama_lengkap->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->A_nama_lengkap->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->A_nama_lengkap->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->nama_biaya->Visible) { // nama_biaya ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->nama_biaya) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->nama_biaya->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->nama_biaya) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->nama_biaya->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->nama_biaya->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->nama_biaya->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->nilai_tanggungan_bruto->Visible) { // nilai_tanggungan_bruto ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->nilai_tanggungan_bruto) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->nilai_tanggungan_bruto) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->nilai_tanggungan_bruto->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->nilai_tanggungan_bruto->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->tanggal_rencana_bayar->Visible) { // tanggal_rencana_bayar ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->tanggal_rencana_bayar) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->tanggal_rencana_bayar) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->tanggal_rencana_bayar->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->tanggal_rencana_bayar->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->diskon_sosial->Visible) { // diskon_sosial ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->diskon_sosial) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->diskon_sosial->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->diskon_sosial) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->diskon_sosial->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->diskon_sosial->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->diskon_sosial->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->diskon_waktu->Visible) { // diskon_waktu ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->diskon_waktu) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->diskon_waktu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->diskon_waktu) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->diskon_waktu->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->diskon_waktu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->diskon_waktu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->diskon_prestasi->Visible) { // diskon_prestasi ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->diskon_prestasi) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->diskon_prestasi->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->diskon_prestasi) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->diskon_prestasi->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->diskon_prestasi->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->diskon_prestasi->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->diskon_internal->Visible) { // diskon_internal ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->diskon_internal) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->diskon_internal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->diskon_internal) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->diskon_internal->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->diskon_internal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->diskon_internal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->diskon_lain_lain->Visible) { // diskon_lain_lain ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->diskon_lain_lain) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->diskon_lain_lain->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->diskon_lain_lain) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->diskon_lain_lain->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->diskon_lain_lain->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->diskon_lain_lain->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->nilai_tanggungan_netto->Visible) { // nilai_tanggungan_netto ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->nilai_tanggungan_netto) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->nilai_tanggungan_netto) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->nilai_tanggungan_netto->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->nilai_tanggungan_netto->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->jum_cicilan->Visible) { // jum_cicilan ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->jum_cicilan) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->jum_cicilan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->jum_cicilan) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->jum_cicilan->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->jum_cicilan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->jum_cicilan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_laporan_keuangan->kekurangan_pembayaran->Visible) { // kekurangan_pembayaran ?>
	<?php if ($keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->kekurangan_pembayaran) == "") { ?>
		<td><?php echo $keu_laporan_keuangan->kekurangan_pembayaran->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $keu_laporan_keuangan->SortUrl($keu_laporan_keuangan->kekurangan_pembayaran) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_laporan_keuangan->kekurangan_pembayaran->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_laporan_keuangan->kekurangan_pembayaran->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_laporan_keuangan->kekurangan_pembayaran->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$keu_laporan_keuangan_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($keu_laporan_keuangan->ExportAll && $keu_laporan_keuangan->Export <> "") {
	$keu_laporan_keuangan_list->StopRec = $keu_laporan_keuangan_list->TotalRecs;
} else {

	// Set the last record to display
	if ($keu_laporan_keuangan_list->TotalRecs > $keu_laporan_keuangan_list->StartRec + $keu_laporan_keuangan_list->DisplayRecs - 1)
		$keu_laporan_keuangan_list->StopRec = $keu_laporan_keuangan_list->StartRec + $keu_laporan_keuangan_list->DisplayRecs - 1;
	else
		$keu_laporan_keuangan_list->StopRec = $keu_laporan_keuangan_list->TotalRecs;
}
$keu_laporan_keuangan_list->RecCnt = $keu_laporan_keuangan_list->StartRec - 1;
if ($keu_laporan_keuangan_list->Recordset && !$keu_laporan_keuangan_list->Recordset->EOF) {
	$keu_laporan_keuangan_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $keu_laporan_keuangan_list->StartRec > 1)
		$keu_laporan_keuangan_list->Recordset->Move($keu_laporan_keuangan_list->StartRec - 1);
} elseif (!$keu_laporan_keuangan->AllowAddDeleteRow && $keu_laporan_keuangan_list->StopRec == 0) {
	$keu_laporan_keuangan_list->StopRec = $keu_laporan_keuangan->GridAddRowCount;
}

// Initialize aggregate
$keu_laporan_keuangan->RowType = EW_ROWTYPE_AGGREGATEINIT;
$keu_laporan_keuangan->ResetAttrs();
$keu_laporan_keuangan_list->RenderRow();
$keu_laporan_keuangan_list->RowCnt = 0;
while ($keu_laporan_keuangan_list->RecCnt < $keu_laporan_keuangan_list->StopRec) {
	$keu_laporan_keuangan_list->RecCnt++;
	if (intval($keu_laporan_keuangan_list->RecCnt) >= intval($keu_laporan_keuangan_list->StartRec)) {
		$keu_laporan_keuangan_list->RowCnt++;

		// Set up key count
		$keu_laporan_keuangan_list->KeyCount = $keu_laporan_keuangan_list->RowIndex;

		// Init row class and style
		$keu_laporan_keuangan->ResetAttrs();
		$keu_laporan_keuangan->CssClass = "";
		if ($keu_laporan_keuangan->CurrentAction == "gridadd") {
		} else {
			$keu_laporan_keuangan_list->LoadRowValues($keu_laporan_keuangan_list->Recordset); // Load row values
		}
		$keu_laporan_keuangan->RowType = EW_ROWTYPE_VIEW; // Render view
		$keu_laporan_keuangan->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$keu_laporan_keuangan_list->RenderRow();

		// Render list options
		$keu_laporan_keuangan_list->RenderListOptions();
?>
	<tr<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$keu_laporan_keuangan_list->ListOptions->Render("body", "left");
?>
	<?php if ($keu_laporan_keuangan->identitas->Visible) { // identitas ?>
		<td<?php echo $keu_laporan_keuangan->identitas->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->identitas->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->identitas->ListViewValue() ?></div>
<a name="<?php echo $keu_laporan_keuangan_list->PageObjName . "_row_" . $keu_laporan_keuangan_list->RowCnt ?>" id="<?php echo $keu_laporan_keuangan_list->PageObjName . "_row_" . $keu_laporan_keuangan_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->A_nama_lengkap->Visible) { // A_nama_lengkap ?>
		<td<?php echo $keu_laporan_keuangan->A_nama_lengkap->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->A_nama_lengkap->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->A_nama_lengkap->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->nama_biaya->Visible) { // nama_biaya ?>
		<td<?php echo $keu_laporan_keuangan->nama_biaya->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->nama_biaya->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->nama_biaya->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->nilai_tanggungan_bruto->Visible) { // nilai_tanggungan_bruto ?>
		<td<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->tanggal_rencana_bayar->Visible) { // tanggal_rencana_bayar ?>
		<td<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->diskon_sosial->Visible) { // diskon_sosial ?>
		<td<?php echo $keu_laporan_keuangan->diskon_sosial->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_sosial->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_sosial->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->diskon_waktu->Visible) { // diskon_waktu ?>
		<td<?php echo $keu_laporan_keuangan->diskon_waktu->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_waktu->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_waktu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->diskon_prestasi->Visible) { // diskon_prestasi ?>
		<td<?php echo $keu_laporan_keuangan->diskon_prestasi->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_prestasi->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_prestasi->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->diskon_internal->Visible) { // diskon_internal ?>
		<td<?php echo $keu_laporan_keuangan->diskon_internal->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_internal->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_internal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->diskon_lain_lain->Visible) { // diskon_lain_lain ?>
		<td<?php echo $keu_laporan_keuangan->diskon_lain_lain->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->diskon_lain_lain->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_lain_lain->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->nilai_tanggungan_netto->Visible) { // nilai_tanggungan_netto ?>
		<td<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->jum_cicilan->Visible) { // jum_cicilan ?>
		<td<?php echo $keu_laporan_keuangan->jum_cicilan->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->jum_cicilan->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->jum_cicilan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($keu_laporan_keuangan->kekurangan_pembayaran->Visible) { // kekurangan_pembayaran ?>
		<td<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->CellAttributes() ?>>
<div<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->kekurangan_pembayaran->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$keu_laporan_keuangan_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($keu_laporan_keuangan->CurrentAction <> "gridadd")
		$keu_laporan_keuangan_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($keu_laporan_keuangan_list->Recordset)
	$keu_laporan_keuangan_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($keu_laporan_keuangan->Export == "" && $keu_laporan_keuangan->CurrentAction == "") { ?>
<?php } ?>
<?php
$keu_laporan_keuangan_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($keu_laporan_keuangan->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$keu_laporan_keuangan_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_laporan_keuangan_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'keu_laporan_keuangan';

	// Page object name
	var $PageObjName = 'keu_laporan_keuangan_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_laporan_keuangan;
		if ($keu_laporan_keuangan->UseTokenInUrl) $PageUrl .= "t=" . $keu_laporan_keuangan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_laporan_keuangan;
		if ($keu_laporan_keuangan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_laporan_keuangan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_laporan_keuangan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_laporan_keuangan_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_laporan_keuangan)
		if (!isset($GLOBALS["keu_laporan_keuangan"])) {
			$GLOBALS["keu_laporan_keuangan"] = new ckeu_laporan_keuangan();
			$GLOBALS["Table"] =& $GLOBALS["keu_laporan_keuangan"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "keu_laporan_keuanganadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "keu_laporan_keuangandelete.php";
		$this->MultiUpdateUrl = "keu_laporan_keuanganupdate.php";

		// Table object (keu_cicilan)
		if (!isset($GLOBALS['keu_cicilan'])) $GLOBALS['keu_cicilan'] = new ckeu_cicilan();

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_laporan_keuangan', TRUE);

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
		global $keu_laporan_keuangan;

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
			$keu_laporan_keuangan->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $keu_laporan_keuangan;

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
			if ($keu_laporan_keuangan->Export <> "" ||
				$keu_laporan_keuangan->CurrentAction == "gridadd" ||
				$keu_laporan_keuangan->CurrentAction == "gridedit") {
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
			$keu_laporan_keuangan->Recordset_SearchValidated();

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
		if ($keu_laporan_keuangan->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $keu_laporan_keuangan->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$keu_laporan_keuangan->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$keu_laporan_keuangan->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$keu_laporan_keuangan->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $keu_laporan_keuangan->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$keu_laporan_keuangan->setSessionWhere($sFilter);
		$keu_laporan_keuangan->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $keu_laporan_keuangan;
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
			$keu_laporan_keuangan->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$keu_laporan_keuangan->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $keu_laporan_keuangan;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->identitas, FALSE); // identitas
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->A_nama_lengkap, FALSE); // A_nama_lengkap
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->nama_biaya, FALSE); // nama_biaya
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->nilai_tanggungan_bruto, FALSE); // nilai_tanggungan_bruto
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->tanggal_rencana_bayar, FALSE); // tanggal_rencana_bayar
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->diskon_sosial, FALSE); // diskon_sosial
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->diskon_waktu, FALSE); // diskon_waktu
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->diskon_prestasi, FALSE); // diskon_prestasi
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->diskon_internal, FALSE); // diskon_internal
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->diskon_lain_lain, FALSE); // diskon_lain_lain
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->nilai_tanggungan_netto, FALSE); // nilai_tanggungan_netto
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->jum_cicilan, FALSE); // jum_cicilan
		$this->BuildSearchSql($sWhere, $keu_laporan_keuangan->kekurangan_pembayaran, FALSE); // kekurangan_pembayaran

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($keu_laporan_keuangan->identitas); // identitas
			$this->SetSearchParm($keu_laporan_keuangan->A_nama_lengkap); // A_nama_lengkap
			$this->SetSearchParm($keu_laporan_keuangan->nama_biaya); // nama_biaya
			$this->SetSearchParm($keu_laporan_keuangan->nilai_tanggungan_bruto); // nilai_tanggungan_bruto
			$this->SetSearchParm($keu_laporan_keuangan->tanggal_rencana_bayar); // tanggal_rencana_bayar
			$this->SetSearchParm($keu_laporan_keuangan->diskon_sosial); // diskon_sosial
			$this->SetSearchParm($keu_laporan_keuangan->diskon_waktu); // diskon_waktu
			$this->SetSearchParm($keu_laporan_keuangan->diskon_prestasi); // diskon_prestasi
			$this->SetSearchParm($keu_laporan_keuangan->diskon_internal); // diskon_internal
			$this->SetSearchParm($keu_laporan_keuangan->diskon_lain_lain); // diskon_lain_lain
			$this->SetSearchParm($keu_laporan_keuangan->nilai_tanggungan_netto); // nilai_tanggungan_netto
			$this->SetSearchParm($keu_laporan_keuangan->jum_cicilan); // jum_cicilan
			$this->SetSearchParm($keu_laporan_keuangan->kekurangan_pembayaran); // kekurangan_pembayaran
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
		global $keu_laporan_keuangan;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$keu_laporan_keuangan->setAdvancedSearch("x_$FldParm", $FldVal);
		$keu_laporan_keuangan->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$keu_laporan_keuangan->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$keu_laporan_keuangan->setAdvancedSearch("y_$FldParm", $FldVal2);
		$keu_laporan_keuangan->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $keu_laporan_keuangan;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $keu_laporan_keuangan->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $keu_laporan_keuangan->getAdvancedSearch("w_$FldParm");
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
		global $keu_laporan_keuangan;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $keu_laporan_keuangan->kode_otomatis, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $keu_laporan_keuangan->identitas, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $keu_laporan_keuangan->A_nama_lengkap, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $keu_laporan_keuangan->nama_biaya, $Keyword);
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
		global $Security, $keu_laporan_keuangan;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $keu_laporan_keuangan->BasicSearchKeyword;
		$sSearchType = $keu_laporan_keuangan->BasicSearchType;
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
			$keu_laporan_keuangan->setSessionBasicSearchKeyword($sSearchKeyword);
			$keu_laporan_keuangan->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $keu_laporan_keuangan;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$keu_laporan_keuangan->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $keu_laporan_keuangan;
		$keu_laporan_keuangan->setSessionBasicSearchKeyword("");
		$keu_laporan_keuangan->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $keu_laporan_keuangan;
		$keu_laporan_keuangan->setAdvancedSearch("x_identitas", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_identitas", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_identitas", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_A_nama_lengkap", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_A_nama_lengkap", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_A_nama_lengkap", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_nama_biaya", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_nama_biaya", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_nama_biaya", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_nilai_tanggungan_bruto", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_nilai_tanggungan_bruto", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_nilai_tanggungan_bruto", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_tanggal_rencana_bayar", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_tanggal_rencana_bayar", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_tanggal_rencana_bayar", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_diskon_sosial", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_diskon_sosial", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_diskon_sosial", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_diskon_waktu", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_diskon_waktu", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_diskon_waktu", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_diskon_prestasi", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_diskon_prestasi", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_diskon_prestasi", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_diskon_internal", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_diskon_internal", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_diskon_internal", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_diskon_lain_lain", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_diskon_lain_lain", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_diskon_lain_lain", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_nilai_tanggungan_netto", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_nilai_tanggungan_netto", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_nilai_tanggungan_netto", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_jum_cicilan", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_jum_cicilan", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_jum_cicilan", "");
		$keu_laporan_keuangan->setAdvancedSearch("x_kekurangan_pembayaran", "");
		$keu_laporan_keuangan->setAdvancedSearch("z_kekurangan_pembayaran", "");
		$keu_laporan_keuangan->setAdvancedSearch("y_kekurangan_pembayaran", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $keu_laporan_keuangan;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_identitas"] <> "") $bRestore = FALSE;
		if (@$_GET["y_identitas"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_nama_lengkap"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_nama_lengkap"] <> "") $bRestore = FALSE;
		if (@$_GET["x_nama_biaya"] <> "") $bRestore = FALSE;
		if (@$_GET["y_nama_biaya"] <> "") $bRestore = FALSE;
		if (@$_GET["x_nilai_tanggungan_bruto"] <> "") $bRestore = FALSE;
		if (@$_GET["y_nilai_tanggungan_bruto"] <> "") $bRestore = FALSE;
		if (@$_GET["x_tanggal_rencana_bayar"] <> "") $bRestore = FALSE;
		if (@$_GET["y_tanggal_rencana_bayar"] <> "") $bRestore = FALSE;
		if (@$_GET["x_diskon_sosial"] <> "") $bRestore = FALSE;
		if (@$_GET["y_diskon_sosial"] <> "") $bRestore = FALSE;
		if (@$_GET["x_diskon_waktu"] <> "") $bRestore = FALSE;
		if (@$_GET["y_diskon_waktu"] <> "") $bRestore = FALSE;
		if (@$_GET["x_diskon_prestasi"] <> "") $bRestore = FALSE;
		if (@$_GET["y_diskon_prestasi"] <> "") $bRestore = FALSE;
		if (@$_GET["x_diskon_internal"] <> "") $bRestore = FALSE;
		if (@$_GET["y_diskon_internal"] <> "") $bRestore = FALSE;
		if (@$_GET["x_diskon_lain_lain"] <> "") $bRestore = FALSE;
		if (@$_GET["y_diskon_lain_lain"] <> "") $bRestore = FALSE;
		if (@$_GET["x_nilai_tanggungan_netto"] <> "") $bRestore = FALSE;
		if (@$_GET["y_nilai_tanggungan_netto"] <> "") $bRestore = FALSE;
		if (@$_GET["x_jum_cicilan"] <> "") $bRestore = FALSE;
		if (@$_GET["y_jum_cicilan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_kekurangan_pembayaran"] <> "") $bRestore = FALSE;
		if (@$_GET["y_kekurangan_pembayaran"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$keu_laporan_keuangan->BasicSearchKeyword = $keu_laporan_keuangan->getSessionBasicSearchKeyword();
			$keu_laporan_keuangan->BasicSearchType = $keu_laporan_keuangan->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($keu_laporan_keuangan->identitas);
			$this->GetSearchParm($keu_laporan_keuangan->A_nama_lengkap);
			$this->GetSearchParm($keu_laporan_keuangan->nama_biaya);
			$this->GetSearchParm($keu_laporan_keuangan->nilai_tanggungan_bruto);
			$this->GetSearchParm($keu_laporan_keuangan->tanggal_rencana_bayar);
			$this->GetSearchParm($keu_laporan_keuangan->diskon_sosial);
			$this->GetSearchParm($keu_laporan_keuangan->diskon_waktu);
			$this->GetSearchParm($keu_laporan_keuangan->diskon_prestasi);
			$this->GetSearchParm($keu_laporan_keuangan->diskon_internal);
			$this->GetSearchParm($keu_laporan_keuangan->diskon_lain_lain);
			$this->GetSearchParm($keu_laporan_keuangan->nilai_tanggungan_netto);
			$this->GetSearchParm($keu_laporan_keuangan->jum_cicilan);
			$this->GetSearchParm($keu_laporan_keuangan->kekurangan_pembayaran);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $keu_laporan_keuangan;

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$keu_laporan_keuangan->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$keu_laporan_keuangan->CurrentOrderType = @$_GET["ordertype"];
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->identitas, $bCtrl); // identitas
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->A_nama_lengkap, $bCtrl); // A_nama_lengkap
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->nama_biaya, $bCtrl); // nama_biaya
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->nilai_tanggungan_bruto, $bCtrl); // nilai_tanggungan_bruto
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->tanggal_rencana_bayar, $bCtrl); // tanggal_rencana_bayar
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->diskon_sosial, $bCtrl); // diskon_sosial
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->diskon_waktu, $bCtrl); // diskon_waktu
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->diskon_prestasi, $bCtrl); // diskon_prestasi
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->diskon_internal, $bCtrl); // diskon_internal
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->diskon_lain_lain, $bCtrl); // diskon_lain_lain
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->nilai_tanggungan_netto, $bCtrl); // nilai_tanggungan_netto
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->jum_cicilan, $bCtrl); // jum_cicilan
			$keu_laporan_keuangan->UpdateSort($keu_laporan_keuangan->kekurangan_pembayaran, $bCtrl); // kekurangan_pembayaran
			$keu_laporan_keuangan->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $keu_laporan_keuangan;
		$sOrderBy = $keu_laporan_keuangan->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($keu_laporan_keuangan->SqlOrderBy() <> "") {
				$sOrderBy = $keu_laporan_keuangan->SqlOrderBy();
				$keu_laporan_keuangan->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $keu_laporan_keuangan;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$keu_laporan_keuangan->setSessionOrderBy($sOrderBy);
				$keu_laporan_keuangan->identitas->setSort("");
				$keu_laporan_keuangan->A_nama_lengkap->setSort("");
				$keu_laporan_keuangan->nama_biaya->setSort("");
				$keu_laporan_keuangan->nilai_tanggungan_bruto->setSort("");
				$keu_laporan_keuangan->tanggal_rencana_bayar->setSort("");
				$keu_laporan_keuangan->diskon_sosial->setSort("");
				$keu_laporan_keuangan->diskon_waktu->setSort("");
				$keu_laporan_keuangan->diskon_prestasi->setSort("");
				$keu_laporan_keuangan->diskon_internal->setSort("");
				$keu_laporan_keuangan->diskon_lain_lain->setSort("");
				$keu_laporan_keuangan->nilai_tanggungan_netto->setSort("");
				$keu_laporan_keuangan->jum_cicilan->setSort("");
				$keu_laporan_keuangan->kekurangan_pembayaran->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$keu_laporan_keuangan->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $keu_laporan_keuangan;

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

		// "detail_keu_cicilan"
		$item =& $this->ListOptions->Add("detail_keu_cicilan");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('keu_cicilan');
		$item->OnLeft = TRUE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $keu_laporan_keuangan, $objForm;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . " onclick=\"ew_ClickDelete(this);return ew_ConfirmDelete(ewLanguage.Phrase('DeleteConfirmMsg'), this);\"" . " href=\"" . $this->DeleteUrl . "\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "detail_keu_cicilan"
		$oListOpt =& $this->ListOptions->Items["detail_keu_cicilan"];
		if ($Security->AllowList('keu_cicilan')) {
			$oListOpt->Body = "<img src=\"phpimages/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("keu_cicilan", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"keu_cicilanlist.php?" . EW_TABLE_SHOW_MASTER . "=keu_laporan_keuangan&kode_otomatis=" . urlencode(strval($keu_laporan_keuangan->kode_otomatis->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($GLOBALS["keu_cicilan"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit('keu_cicilan'))
				$links .= "<a class=\"ewRowLink\" href=\"" . $keu_laporan_keuangan->EditUrl(EW_TABLE_SHOW_DETAIL . "=keu_cicilan") . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>&nbsp;";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $keu_laporan_keuangan;
		$sSqlWrk = "`kode_otomatis_tanggungan`='" . ew_AdjustSql($keu_laporan_keuangan->kode_otomatis->CurrentValue) . "'";
		$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
		$sSqlWrk = str_replace("'", "\'", $sSqlWrk);
		$sHyperLinkParm = " href=\"keu_cicilanlist.php?" . EW_TABLE_SHOW_MASTER . "=keu_laporan_keuangan&kode_otomatis=" . urlencode(strval($keu_laporan_keuangan->kode_otomatis->CurrentValue)) . "\"";
		$oListOpt =& $this->ListOptions->Items["detail_keu_cicilan"];
		$oListOpt->Body = $Language->TablePhrase("keu_cicilan", "TblCaption");
		$oListOpt->Body = "<a class=\"ewRowLink\"" . $sHyperLinkParm . ">" . $oListOpt->Body . "</a>";
		$sHyperLinkParm = " href=\"javascript:void(0);\" name=\"dl%i_keu_laporan_keuangan_keu_cicilan\" id=\"dl%i_keu_laporan_keuangan_keu_cicilan\" onclick=\"ew_AjaxShowDetails2(event, this, 'keu_cicilanpreview.php?f=%s')\"";		
		$sHyperLinkParm = str_replace("%i", $this->RowCnt, $sHyperLinkParm);
		$sHyperLinkParm = str_replace("%s", $sSqlWrk, $sHyperLinkParm);
		$oListOpt->Body = "<a" . $sHyperLinkParm . "><img class=\"ewPreviewRowImage\" src=\"phpimages/expand.gif\" width=\"9\" height=\"9\" border=\"0\"></a>&nbsp;" . $oListOpt->Body;
		$links = "";
		if ($GLOBALS["keu_cicilan"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit('keu_cicilan'))
			$links .= "<a class=\"ewRowLink\" href=\"" . $keu_laporan_keuangan->EditUrl(EW_TABLE_SHOW_DETAIL . "=keu_cicilan") . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>&nbsp;";
		if ($links <> "") $oListOpt->Body .= "<br>" . $links;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $keu_laporan_keuangan;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$keu_laporan_keuangan->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$keu_laporan_keuangan->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $keu_laporan_keuangan->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$keu_laporan_keuangan->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$keu_laporan_keuangan->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$keu_laporan_keuangan->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $keu_laporan_keuangan;
		$keu_laporan_keuangan->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$keu_laporan_keuangan->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $keu_laporan_keuangan;

		// Load search values
		// identitas

		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_identitas"]);
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator = @$_GET["z_identitas"];
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchCondition = @$_GET["v_identitas"];
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_identitas"]);
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator2 = @$_GET["w_identitas"];

		// A_nama_lengkap
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_nama_lengkap"]);
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator = @$_GET["z_A_nama_lengkap"];
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchCondition = @$_GET["v_A_nama_lengkap"];
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_nama_lengkap"]);
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator2 = @$_GET["w_A_nama_lengkap"];

		// nama_biaya
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_nama_biaya"]);
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator = @$_GET["z_nama_biaya"];
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchCondition = @$_GET["v_nama_biaya"];
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_nama_biaya"]);
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator2 = @$_GET["w_nama_biaya"];

		// nilai_tanggungan_bruto
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_nilai_tanggungan_bruto"]);
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator = @$_GET["z_nilai_tanggungan_bruto"];
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchCondition = @$_GET["v_nilai_tanggungan_bruto"];
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_nilai_tanggungan_bruto"]);
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator2 = @$_GET["w_nilai_tanggungan_bruto"];

		// tanggal_rencana_bayar
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_tanggal_rencana_bayar"]);
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator = @$_GET["z_tanggal_rencana_bayar"];
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchCondition = @$_GET["v_tanggal_rencana_bayar"];
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_tanggal_rencana_bayar"]);
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator2 = @$_GET["w_tanggal_rencana_bayar"];

		// diskon_sosial
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_diskon_sosial"]);
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator = @$_GET["z_diskon_sosial"];
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchCondition = @$_GET["v_diskon_sosial"];
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_diskon_sosial"]);
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator2 = @$_GET["w_diskon_sosial"];

		// diskon_waktu
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_diskon_waktu"]);
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator = @$_GET["z_diskon_waktu"];
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchCondition = @$_GET["v_diskon_waktu"];
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_diskon_waktu"]);
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator2 = @$_GET["w_diskon_waktu"];

		// diskon_prestasi
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_diskon_prestasi"]);
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator = @$_GET["z_diskon_prestasi"];
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchCondition = @$_GET["v_diskon_prestasi"];
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_diskon_prestasi"]);
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator2 = @$_GET["w_diskon_prestasi"];

		// diskon_internal
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_diskon_internal"]);
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator = @$_GET["z_diskon_internal"];
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchCondition = @$_GET["v_diskon_internal"];
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_diskon_internal"]);
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator2 = @$_GET["w_diskon_internal"];

		// diskon_lain_lain
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_diskon_lain_lain"]);
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator = @$_GET["z_diskon_lain_lain"];
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchCondition = @$_GET["v_diskon_lain_lain"];
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_diskon_lain_lain"]);
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator2 = @$_GET["w_diskon_lain_lain"];

		// nilai_tanggungan_netto
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_nilai_tanggungan_netto"]);
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator = @$_GET["z_nilai_tanggungan_netto"];
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchCondition = @$_GET["v_nilai_tanggungan_netto"];
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_nilai_tanggungan_netto"]);
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator2 = @$_GET["w_nilai_tanggungan_netto"];

		// jum_cicilan
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_jum_cicilan"]);
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator = @$_GET["z_jum_cicilan"];
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchCondition = @$_GET["v_jum_cicilan"];
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_jum_cicilan"]);
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator2 = @$_GET["w_jum_cicilan"];

		// kekurangan_pembayaran
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_kekurangan_pembayaran"]);
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator = @$_GET["z_kekurangan_pembayaran"];
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchCondition = @$_GET["v_kekurangan_pembayaran"];
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_kekurangan_pembayaran"]);
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator2 = @$_GET["w_kekurangan_pembayaran"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $keu_laporan_keuangan;

		// Call Recordset Selecting event
		$keu_laporan_keuangan->Recordset_Selecting($keu_laporan_keuangan->CurrentFilter);

		// Load List page SQL
		$sSql = $keu_laporan_keuangan->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$keu_laporan_keuangan->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_laporan_keuangan;
		$sFilter = $keu_laporan_keuangan->KeyFilter();

		// Call Row Selecting event
		$keu_laporan_keuangan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_laporan_keuangan->CurrentFilter = $sFilter;
		$sSql = $keu_laporan_keuangan->SQL();
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
		global $conn, $keu_laporan_keuangan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_laporan_keuangan->Row_Selected($row);
		$keu_laporan_keuangan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_laporan_keuangan->identitas->setDbValue($rs->fields('identitas'));
		$keu_laporan_keuangan->A_nama_lengkap->setDbValue($rs->fields('A_nama_lengkap'));
		$keu_laporan_keuangan->nama_biaya->setDbValue($rs->fields('nama_biaya'));
		$keu_laporan_keuangan->nilai_tanggungan_bruto->setDbValue($rs->fields('nilai_tanggungan_bruto'));
		$keu_laporan_keuangan->tanggal_rencana_bayar->setDbValue($rs->fields('tanggal_rencana_bayar'));
		$keu_laporan_keuangan->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$keu_laporan_keuangan->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$keu_laporan_keuangan->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$keu_laporan_keuangan->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$keu_laporan_keuangan->diskon_lain_lain->setDbValue($rs->fields('diskon_lain_lain'));
		$keu_laporan_keuangan->nilai_tanggungan_netto->setDbValue($rs->fields('nilai_tanggungan_netto'));
		$keu_laporan_keuangan->jum_cicilan->setDbValue($rs->fields('jum_cicilan'));
		$keu_laporan_keuangan->kekurangan_pembayaran->setDbValue($rs->fields('kekurangan_pembayaran'));
	}

	// Load old record
	function LoadOldRecord() {
		global $keu_laporan_keuangan;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($keu_laporan_keuangan->getKey("kode_otomatis")) <> "")
			$keu_laporan_keuangan->kode_otomatis->CurrentValue = $keu_laporan_keuangan->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$keu_laporan_keuangan->CurrentFilter = $keu_laporan_keuangan->KeyFilter();
			$sSql = $keu_laporan_keuangan->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_laporan_keuangan;

		// Initialize URLs
		$this->ViewUrl = $keu_laporan_keuangan->ViewUrl();
		$this->EditUrl = $keu_laporan_keuangan->EditUrl();
		$this->InlineEditUrl = $keu_laporan_keuangan->InlineEditUrl();
		$this->CopyUrl = $keu_laporan_keuangan->CopyUrl();
		$this->InlineCopyUrl = $keu_laporan_keuangan->InlineCopyUrl();
		$this->DeleteUrl = $keu_laporan_keuangan->DeleteUrl();

		// Call Row_Rendering event
		$keu_laporan_keuangan->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis
		// identitas
		// A_nama_lengkap
		// nama_biaya
		// nilai_tanggungan_bruto
		// tanggal_rencana_bayar
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain_lain
		// nilai_tanggungan_netto
		// jum_cicilan
		// kekurangan_pembayaran

		if ($keu_laporan_keuangan->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_otomatis
			$keu_laporan_keuangan->kode_otomatis->ViewValue = $keu_laporan_keuangan->kode_otomatis->CurrentValue;
			$keu_laporan_keuangan->kode_otomatis->ViewCustomAttributes = "";

			// identitas
			$keu_laporan_keuangan->identitas->ViewValue = $keu_laporan_keuangan->identitas->CurrentValue;
			$keu_laporan_keuangan->identitas->ViewCustomAttributes = "";

			// A_nama_lengkap
			$keu_laporan_keuangan->A_nama_lengkap->ViewValue = $keu_laporan_keuangan->A_nama_lengkap->CurrentValue;
			$keu_laporan_keuangan->A_nama_lengkap->ViewCustomAttributes = "";

			// nama_biaya
			$keu_laporan_keuangan->nama_biaya->ViewValue = $keu_laporan_keuangan->nama_biaya->CurrentValue;
			$keu_laporan_keuangan->nama_biaya->ViewCustomAttributes = "";

			// nilai_tanggungan_bruto
			$keu_laporan_keuangan->nilai_tanggungan_bruto->ViewValue = $keu_laporan_keuangan->nilai_tanggungan_bruto->CurrentValue;
			$keu_laporan_keuangan->nilai_tanggungan_bruto->ViewCustomAttributes = "";

			// tanggal_rencana_bayar
			$keu_laporan_keuangan->tanggal_rencana_bayar->ViewValue = $keu_laporan_keuangan->tanggal_rencana_bayar->CurrentValue;
			$keu_laporan_keuangan->tanggal_rencana_bayar->ViewValue = ew_FormatDateTime($keu_laporan_keuangan->tanggal_rencana_bayar->ViewValue, 7);
			$keu_laporan_keuangan->tanggal_rencana_bayar->ViewCustomAttributes = "";

			// diskon_sosial
			$keu_laporan_keuangan->diskon_sosial->ViewValue = $keu_laporan_keuangan->diskon_sosial->CurrentValue;
			$keu_laporan_keuangan->diskon_sosial->ViewCustomAttributes = "";

			// diskon_waktu
			$keu_laporan_keuangan->diskon_waktu->ViewValue = $keu_laporan_keuangan->diskon_waktu->CurrentValue;
			$keu_laporan_keuangan->diskon_waktu->ViewCustomAttributes = "";

			// diskon_prestasi
			$keu_laporan_keuangan->diskon_prestasi->ViewValue = $keu_laporan_keuangan->diskon_prestasi->CurrentValue;
			$keu_laporan_keuangan->diskon_prestasi->ViewCustomAttributes = "";

			// diskon_internal
			$keu_laporan_keuangan->diskon_internal->ViewValue = $keu_laporan_keuangan->diskon_internal->CurrentValue;
			$keu_laporan_keuangan->diskon_internal->ViewCustomAttributes = "";

			// diskon_lain_lain
			$keu_laporan_keuangan->diskon_lain_lain->ViewValue = $keu_laporan_keuangan->diskon_lain_lain->CurrentValue;
			$keu_laporan_keuangan->diskon_lain_lain->ViewCustomAttributes = "";

			// nilai_tanggungan_netto
			$keu_laporan_keuangan->nilai_tanggungan_netto->ViewValue = $keu_laporan_keuangan->nilai_tanggungan_netto->CurrentValue;
			$keu_laporan_keuangan->nilai_tanggungan_netto->ViewCustomAttributes = "";

			// jum_cicilan
			$keu_laporan_keuangan->jum_cicilan->ViewValue = $keu_laporan_keuangan->jum_cicilan->CurrentValue;
			$keu_laporan_keuangan->jum_cicilan->ViewCustomAttributes = "";

			// kekurangan_pembayaran
			$keu_laporan_keuangan->kekurangan_pembayaran->ViewValue = $keu_laporan_keuangan->kekurangan_pembayaran->CurrentValue;
			$keu_laporan_keuangan->kekurangan_pembayaran->ViewCustomAttributes = "";

			// identitas
			$keu_laporan_keuangan->identitas->LinkCustomAttributes = "";
			$keu_laporan_keuangan->identitas->HrefValue = "";
			$keu_laporan_keuangan->identitas->TooltipValue = "";
			if ($keu_laporan_keuangan->Export == "")
				$keu_laporan_keuangan->identitas->ViewValue = ew_Highlight($keu_laporan_keuangan->HighlightName(), $keu_laporan_keuangan->identitas->ViewValue, $keu_laporan_keuangan->getSessionBasicSearchKeyword(), $keu_laporan_keuangan->getSessionBasicSearchType(), $keu_laporan_keuangan->getAdvancedSearch("x_identitas"));

			// A_nama_lengkap
			$keu_laporan_keuangan->A_nama_lengkap->LinkCustomAttributes = "";
			$keu_laporan_keuangan->A_nama_lengkap->HrefValue = "";
			$keu_laporan_keuangan->A_nama_lengkap->TooltipValue = "";
			if ($keu_laporan_keuangan->Export == "")
				$keu_laporan_keuangan->A_nama_lengkap->ViewValue = ew_Highlight($keu_laporan_keuangan->HighlightName(), $keu_laporan_keuangan->A_nama_lengkap->ViewValue, $keu_laporan_keuangan->getSessionBasicSearchKeyword(), $keu_laporan_keuangan->getSessionBasicSearchType(), $keu_laporan_keuangan->getAdvancedSearch("x_A_nama_lengkap"));

			// nama_biaya
			$keu_laporan_keuangan->nama_biaya->LinkCustomAttributes = "";
			$keu_laporan_keuangan->nama_biaya->HrefValue = "";
			$keu_laporan_keuangan->nama_biaya->TooltipValue = "";
			if ($keu_laporan_keuangan->Export == "")
				$keu_laporan_keuangan->nama_biaya->ViewValue = ew_Highlight($keu_laporan_keuangan->HighlightName(), $keu_laporan_keuangan->nama_biaya->ViewValue, $keu_laporan_keuangan->getSessionBasicSearchKeyword(), $keu_laporan_keuangan->getSessionBasicSearchType(), $keu_laporan_keuangan->getAdvancedSearch("x_nama_biaya"));

			// nilai_tanggungan_bruto
			$keu_laporan_keuangan->nilai_tanggungan_bruto->LinkCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_bruto->HrefValue = "";
			$keu_laporan_keuangan->nilai_tanggungan_bruto->TooltipValue = "";

			// tanggal_rencana_bayar
			$keu_laporan_keuangan->tanggal_rencana_bayar->LinkCustomAttributes = "";
			$keu_laporan_keuangan->tanggal_rencana_bayar->HrefValue = "";
			$keu_laporan_keuangan->tanggal_rencana_bayar->TooltipValue = "";

			// diskon_sosial
			$keu_laporan_keuangan->diskon_sosial->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_sosial->HrefValue = "";
			$keu_laporan_keuangan->diskon_sosial->TooltipValue = "";

			// diskon_waktu
			$keu_laporan_keuangan->diskon_waktu->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_waktu->HrefValue = "";
			$keu_laporan_keuangan->diskon_waktu->TooltipValue = "";

			// diskon_prestasi
			$keu_laporan_keuangan->diskon_prestasi->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_prestasi->HrefValue = "";
			$keu_laporan_keuangan->diskon_prestasi->TooltipValue = "";

			// diskon_internal
			$keu_laporan_keuangan->diskon_internal->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_internal->HrefValue = "";
			$keu_laporan_keuangan->diskon_internal->TooltipValue = "";

			// diskon_lain_lain
			$keu_laporan_keuangan->diskon_lain_lain->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_lain_lain->HrefValue = "";
			$keu_laporan_keuangan->diskon_lain_lain->TooltipValue = "";

			// nilai_tanggungan_netto
			$keu_laporan_keuangan->nilai_tanggungan_netto->LinkCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_netto->HrefValue = "";
			$keu_laporan_keuangan->nilai_tanggungan_netto->TooltipValue = "";

			// jum_cicilan
			$keu_laporan_keuangan->jum_cicilan->LinkCustomAttributes = "";
			$keu_laporan_keuangan->jum_cicilan->HrefValue = "";
			$keu_laporan_keuangan->jum_cicilan->TooltipValue = "";

			// kekurangan_pembayaran
			$keu_laporan_keuangan->kekurangan_pembayaran->LinkCustomAttributes = "";
			$keu_laporan_keuangan->kekurangan_pembayaran->HrefValue = "";
			$keu_laporan_keuangan->kekurangan_pembayaran->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($keu_laporan_keuangan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_laporan_keuangan->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $keu_laporan_keuangan;

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
		global $keu_laporan_keuangan;
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_identitas");
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_identitas");
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_identitas");
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_A_nama_lengkap");
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_A_nama_lengkap");
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_A_nama_lengkap");
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_nama_biaya");
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_nama_biaya");
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_nama_biaya");
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_nilai_tanggungan_bruto");
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_nilai_tanggungan_bruto");
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_nilai_tanggungan_bruto");
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_tanggal_rencana_bayar");
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_tanggal_rencana_bayar");
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_tanggal_rencana_bayar");
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_diskon_sosial");
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_diskon_sosial");
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_diskon_sosial");
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_diskon_waktu");
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_diskon_waktu");
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_diskon_waktu");
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_diskon_prestasi");
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_diskon_prestasi");
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_diskon_prestasi");
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_diskon_internal");
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_diskon_internal");
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_diskon_internal");
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_diskon_lain_lain");
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_diskon_lain_lain");
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_diskon_lain_lain");
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_nilai_tanggungan_netto");
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_nilai_tanggungan_netto");
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_nilai_tanggungan_netto");
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_jum_cicilan");
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_jum_cicilan");
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_jum_cicilan");
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_kekurangan_pembayaran");
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_kekurangan_pembayaran");
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_kekurangan_pembayaran");
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
	}

		// Page Load event
function Page_Load() {
	// Bismillaah
	global $Language;
	$Language->setPhrase("ShowAll",""); 
	
	$Language->setPhrase("TblTypeVIEW","");
	
	$item =& $this->ExportOptions->Add("Reset");
	$item->Body = "<a href=keu_laporan_keuanganlist.php?cmd=resetall>Reset Pencarian</a>";            
	$item->Visible = TRUE;      
	
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

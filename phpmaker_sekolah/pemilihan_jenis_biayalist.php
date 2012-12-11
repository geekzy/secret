<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pemilihan_jenis_biayainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pemilihan_jenis_biaya_list = new cpemilihan_jenis_biaya_list();
$Page =& $pemilihan_jenis_biaya_list;

// Page init
$pemilihan_jenis_biaya_list->Page_Init();

// Page main
$pemilihan_jenis_biaya_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($pemilihan_jenis_biaya->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pemilihan_jenis_biaya_list = new ew_Page("pemilihan_jenis_biaya_list");

// page properties
pemilihan_jenis_biaya_list.PageID = "list"; // page ID
pemilihan_jenis_biaya_list.FormID = "fpemilihan_jenis_biayalist"; // form ID
var EW_PAGE_ID = pemilihan_jenis_biaya_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pemilihan_jenis_biaya_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pemilihan_jenis_biaya_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pemilihan_jenis_biaya_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($pemilihan_jenis_biaya->Export == "") || (EW_EXPORT_MASTER_RECORD && $pemilihan_jenis_biaya->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pemilihan_jenis_biaya_list->TotalRecs = $pemilihan_jenis_biaya->SelectRecordCount();
	} else {
		if ($pemilihan_jenis_biaya_list->Recordset = $pemilihan_jenis_biaya_list->LoadRecordset())
			$pemilihan_jenis_biaya_list->TotalRecs = $pemilihan_jenis_biaya_list->Recordset->RecordCount();
	}
	$pemilihan_jenis_biaya_list->StartRec = 1;
	if ($pemilihan_jenis_biaya_list->DisplayRecs <= 0 || ($pemilihan_jenis_biaya->Export <> "" && $pemilihan_jenis_biaya->ExportAll)) // Display all records
		$pemilihan_jenis_biaya_list->DisplayRecs = $pemilihan_jenis_biaya_list->TotalRecs;
	if (!($pemilihan_jenis_biaya->Export <> "" && $pemilihan_jenis_biaya->ExportAll))
		$pemilihan_jenis_biaya_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pemilihan_jenis_biaya_list->Recordset = $pemilihan_jenis_biaya_list->LoadRecordset($pemilihan_jenis_biaya_list->StartRec-1, $pemilihan_jenis_biaya_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $pemilihan_jenis_biaya->TableCaption() ?>
&nbsp;&nbsp;<?php $pemilihan_jenis_biaya_list->ExportOptions->Render("body"); ?>
</p>
<?php $pemilihan_jenis_biaya_list->ShowPageHeader(); ?>
<?php
$pemilihan_jenis_biaya_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($pemilihan_jenis_biaya->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($pemilihan_jenis_biaya->CurrentAction <> "gridadd" && $pemilihan_jenis_biaya->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($pemilihan_jenis_biaya_list->Pager)) $pemilihan_jenis_biaya_list->Pager = new cNumericPager($pemilihan_jenis_biaya_list->StartRec, $pemilihan_jenis_biaya_list->DisplayRecs, $pemilihan_jenis_biaya_list->TotalRecs, $pemilihan_jenis_biaya_list->RecRange) ?>
<?php if ($pemilihan_jenis_biaya_list->Pager->RecordCount > 0) { ?>
	<?php if ($pemilihan_jenis_biaya_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_jenis_biaya_list->PageUrl() ?>start=<?php echo $pemilihan_jenis_biaya_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_jenis_biaya_list->PageUrl() ?>start=<?php echo $pemilihan_jenis_biaya_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($pemilihan_jenis_biaya_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $pemilihan_jenis_biaya_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_jenis_biaya_list->PageUrl() ?>start=<?php echo $pemilihan_jenis_biaya_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_jenis_biaya_list->PageUrl() ?>start=<?php echo $pemilihan_jenis_biaya_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pemilihan_jenis_biaya_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pemilihan_jenis_biaya_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pemilihan_jenis_biaya_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($pemilihan_jenis_biaya_list->SearchWhere == "0=101") { ?>
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
<?php if ($pemilihan_jenis_biaya_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="pemilihan_jenis_biaya">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($pemilihan_jenis_biaya_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($pemilihan_jenis_biaya_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($pemilihan_jenis_biaya_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($pemilihan_jenis_biaya_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($pemilihan_jenis_biaya_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($pemilihan_jenis_biaya_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($pemilihan_jenis_biaya_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($pemilihan_jenis_biaya_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($pemilihan_jenis_biaya_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $pemilihan_jenis_biaya_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fpemilihan_jenis_biayalist" id="fpemilihan_jenis_biayalist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="pemilihan_jenis_biaya">
<div id="gmp_pemilihan_jenis_biaya" class="ewGridMiddlePanel">
<?php if ($pemilihan_jenis_biaya_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pemilihan_jenis_biaya->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pemilihan_jenis_biaya_list->RenderListOptions();

// Render list options (header, left)
$pemilihan_jenis_biaya_list->ListOptions->Render("header", "left");
?>
<?php if ($pemilihan_jenis_biaya->apakah_disembunyikan->Visible) { // apakah_disembunyikan ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->apakah_disembunyikan) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->apakah_disembunyikan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->apakah_disembunyikan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->apakah_disembunyikan->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->apakah_disembunyikan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->apakah_disembunyikan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->kode_biaya->Visible) { // kode_biaya ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->kode_biaya) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->kode_biaya->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->kode_biaya) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->kode_biaya->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->kode_biaya->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->kode_biaya->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->nama_kelas_kelompok) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->nama_kelas_kelompok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->nama_kelas_kelompok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->nama_kelas_kelompok->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->nama_kelas_kelompok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->nama_kelas_kelompok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->kode_kelompok->Visible) { // kode_kelompok ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->kode_kelompok) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->kode_kelompok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->kode_kelompok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->kode_kelompok->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->kode_kelompok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->kode_kelompok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->tanggal_bayar1->Visible) { // tanggal_bayar1 ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->tanggal_bayar1) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->tanggal_bayar1->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->tanggal_bayar1) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->tanggal_bayar1->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->tanggal_bayar1->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->tanggal_bayar1->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->diskon_sosial->Visible) { // diskon_sosial ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->diskon_sosial) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->diskon_sosial->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->diskon_sosial) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->diskon_sosial->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->diskon_sosial->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->diskon_sosial->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->diskon_waktu->Visible) { // diskon_waktu ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->diskon_waktu) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->diskon_waktu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->diskon_waktu) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->diskon_waktu->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->diskon_waktu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->diskon_waktu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->diskon_prestasi->Visible) { // diskon_prestasi ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->diskon_prestasi) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->diskon_prestasi->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->diskon_prestasi) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->diskon_prestasi->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->diskon_prestasi->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->diskon_prestasi->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->diskon_internal->Visible) { // diskon_internal ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->diskon_internal) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->diskon_internal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->diskon_internal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->diskon_internal->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->diskon_internal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->diskon_internal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->diskon_lain->Visible) { // diskon_lain ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->diskon_lain) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->diskon_lain->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->diskon_lain) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->diskon_lain->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->diskon_lain->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->diskon_lain->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->langkah->Visible) { // langkah ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->langkah) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->langkah->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->langkah) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->langkah->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->langkah->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->langkah->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_jenis_biaya->jumlah->Visible) { // jumlah ?>
	<?php if ($pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->jumlah) == "") { ?>
		<td><?php echo $pemilihan_jenis_biaya->jumlah->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_jenis_biaya->SortUrl($pemilihan_jenis_biaya->jumlah) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_jenis_biaya->jumlah->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_jenis_biaya->jumlah->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_jenis_biaya->jumlah->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pemilihan_jenis_biaya_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($pemilihan_jenis_biaya->ExportAll && $pemilihan_jenis_biaya->Export <> "") {
	$pemilihan_jenis_biaya_list->StopRec = $pemilihan_jenis_biaya_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pemilihan_jenis_biaya_list->TotalRecs > $pemilihan_jenis_biaya_list->StartRec + $pemilihan_jenis_biaya_list->DisplayRecs - 1)
		$pemilihan_jenis_biaya_list->StopRec = $pemilihan_jenis_biaya_list->StartRec + $pemilihan_jenis_biaya_list->DisplayRecs - 1;
	else
		$pemilihan_jenis_biaya_list->StopRec = $pemilihan_jenis_biaya_list->TotalRecs;
}
$pemilihan_jenis_biaya_list->RecCnt = $pemilihan_jenis_biaya_list->StartRec - 1;
if ($pemilihan_jenis_biaya_list->Recordset && !$pemilihan_jenis_biaya_list->Recordset->EOF) {
	$pemilihan_jenis_biaya_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $pemilihan_jenis_biaya_list->StartRec > 1)
		$pemilihan_jenis_biaya_list->Recordset->Move($pemilihan_jenis_biaya_list->StartRec - 1);
} elseif (!$pemilihan_jenis_biaya->AllowAddDeleteRow && $pemilihan_jenis_biaya_list->StopRec == 0) {
	$pemilihan_jenis_biaya_list->StopRec = $pemilihan_jenis_biaya->GridAddRowCount;
}

// Initialize aggregate
$pemilihan_jenis_biaya->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pemilihan_jenis_biaya->ResetAttrs();
$pemilihan_jenis_biaya_list->RenderRow();
$pemilihan_jenis_biaya_list->RowCnt = 0;
while ($pemilihan_jenis_biaya_list->RecCnt < $pemilihan_jenis_biaya_list->StopRec) {
	$pemilihan_jenis_biaya_list->RecCnt++;
	if (intval($pemilihan_jenis_biaya_list->RecCnt) >= intval($pemilihan_jenis_biaya_list->StartRec)) {
		$pemilihan_jenis_biaya_list->RowCnt++;

		// Set up key count
		$pemilihan_jenis_biaya_list->KeyCount = $pemilihan_jenis_biaya_list->RowIndex;

		// Init row class and style
		$pemilihan_jenis_biaya->ResetAttrs();
		$pemilihan_jenis_biaya->CssClass = "";
		if ($pemilihan_jenis_biaya->CurrentAction == "gridadd") {
		} else {
			$pemilihan_jenis_biaya_list->LoadRowValues($pemilihan_jenis_biaya_list->Recordset); // Load row values
		}
		$pemilihan_jenis_biaya->RowType = EW_ROWTYPE_VIEW; // Render view
		$pemilihan_jenis_biaya->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$pemilihan_jenis_biaya_list->RenderRow();

		// Render list options
		$pemilihan_jenis_biaya_list->RenderListOptions();
?>
	<tr<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pemilihan_jenis_biaya_list->ListOptions->Render("body", "left");
?>
	<?php if ($pemilihan_jenis_biaya->apakah_disembunyikan->Visible) { // apakah_disembunyikan ?>
		<td<?php echo $pemilihan_jenis_biaya->apakah_disembunyikan->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->apakah_disembunyikan->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->apakah_disembunyikan->ListViewValue() ?></div>
<a name="<?php echo $pemilihan_jenis_biaya_list->PageObjName . "_row_" . $pemilihan_jenis_biaya_list->RowCnt ?>" id="<?php echo $pemilihan_jenis_biaya_list->PageObjName . "_row_" . $pemilihan_jenis_biaya_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->kode_biaya->Visible) { // kode_biaya ?>
		<td<?php echo $pemilihan_jenis_biaya->kode_biaya->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->kode_biaya->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->kode_biaya->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
		<td<?php echo $pemilihan_jenis_biaya->nama_kelas_kelompok->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->nama_kelas_kelompok->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->nama_kelas_kelompok->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->kode_kelompok->Visible) { // kode_kelompok ?>
		<td<?php echo $pemilihan_jenis_biaya->kode_kelompok->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->kode_kelompok->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->kode_kelompok->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->tanggal_bayar1->Visible) { // tanggal_bayar1 ?>
		<td<?php echo $pemilihan_jenis_biaya->tanggal_bayar1->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->tanggal_bayar1->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->tanggal_bayar1->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->diskon_sosial->Visible) { // diskon_sosial ?>
		<td<?php echo $pemilihan_jenis_biaya->diskon_sosial->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->diskon_sosial->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->diskon_sosial->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->diskon_waktu->Visible) { // diskon_waktu ?>
		<td<?php echo $pemilihan_jenis_biaya->diskon_waktu->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->diskon_waktu->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->diskon_waktu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->diskon_prestasi->Visible) { // diskon_prestasi ?>
		<td<?php echo $pemilihan_jenis_biaya->diskon_prestasi->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->diskon_prestasi->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->diskon_prestasi->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->diskon_internal->Visible) { // diskon_internal ?>
		<td<?php echo $pemilihan_jenis_biaya->diskon_internal->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->diskon_internal->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->diskon_internal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->diskon_lain->Visible) { // diskon_lain ?>
		<td<?php echo $pemilihan_jenis_biaya->diskon_lain->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->diskon_lain->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->diskon_lain->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->langkah->Visible) { // langkah ?>
		<td<?php echo $pemilihan_jenis_biaya->langkah->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->langkah->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->langkah->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_jenis_biaya->jumlah->Visible) { // jumlah ?>
		<td<?php echo $pemilihan_jenis_biaya->jumlah->CellAttributes() ?>>
<div<?php echo $pemilihan_jenis_biaya->jumlah->ViewAttributes() ?>><?php echo $pemilihan_jenis_biaya->jumlah->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pemilihan_jenis_biaya_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($pemilihan_jenis_biaya->CurrentAction <> "gridadd")
		$pemilihan_jenis_biaya_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pemilihan_jenis_biaya_list->Recordset)
	$pemilihan_jenis_biaya_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($pemilihan_jenis_biaya->Export == "" && $pemilihan_jenis_biaya->CurrentAction == "") { ?>
<?php } ?>
<?php
$pemilihan_jenis_biaya_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pemilihan_jenis_biaya->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pemilihan_jenis_biaya_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpemilihan_jenis_biaya_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'pemilihan_jenis_biaya';

	// Page object name
	var $PageObjName = 'pemilihan_jenis_biaya_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pemilihan_jenis_biaya;
		if ($pemilihan_jenis_biaya->UseTokenInUrl) $PageUrl .= "t=" . $pemilihan_jenis_biaya->TableVar . "&"; // Add page token
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
		global $objForm, $pemilihan_jenis_biaya;
		if ($pemilihan_jenis_biaya->UseTokenInUrl) {
			if ($objForm)
				return ($pemilihan_jenis_biaya->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pemilihan_jenis_biaya->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpemilihan_jenis_biaya_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pemilihan_jenis_biaya)
		if (!isset($GLOBALS["pemilihan_jenis_biaya"])) {
			$GLOBALS["pemilihan_jenis_biaya"] = new cpemilihan_jenis_biaya();
			$GLOBALS["Table"] =& $GLOBALS["pemilihan_jenis_biaya"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "pemilihan_jenis_biayaadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pemilihan_jenis_biayadelete.php";
		$this->MultiUpdateUrl = "pemilihan_jenis_biayaupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pemilihan_jenis_biaya', TRUE);

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
		global $pemilihan_jenis_biaya;

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
			$pemilihan_jenis_biaya->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $pemilihan_jenis_biaya;

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
			if ($pemilihan_jenis_biaya->Export <> "" ||
				$pemilihan_jenis_biaya->CurrentAction == "gridadd" ||
				$pemilihan_jenis_biaya->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($pemilihan_jenis_biaya->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $pemilihan_jenis_biaya->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$pemilihan_jenis_biaya->setSessionWhere($sFilter);
		$pemilihan_jenis_biaya->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $pemilihan_jenis_biaya;
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
			$pemilihan_jenis_biaya->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$pemilihan_jenis_biaya->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pemilihan_jenis_biaya;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pemilihan_jenis_biaya->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pemilihan_jenis_biaya->CurrentOrderType = @$_GET["ordertype"];
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->apakah_disembunyikan); // apakah_disembunyikan
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->kode_biaya); // kode_biaya
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->nama_kelas_kelompok); // nama_kelas_kelompok
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->kode_kelompok); // kode_kelompok
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->tanggal_bayar1); // tanggal_bayar1
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->diskon_sosial); // diskon_sosial
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->diskon_waktu); // diskon_waktu
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->diskon_prestasi); // diskon_prestasi
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->diskon_internal); // diskon_internal
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->diskon_lain); // diskon_lain
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->langkah); // langkah
			$pemilihan_jenis_biaya->UpdateSort($pemilihan_jenis_biaya->jumlah); // jumlah
			$pemilihan_jenis_biaya->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $pemilihan_jenis_biaya;
		$sOrderBy = $pemilihan_jenis_biaya->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($pemilihan_jenis_biaya->SqlOrderBy() <> "") {
				$sOrderBy = $pemilihan_jenis_biaya->SqlOrderBy();
				$pemilihan_jenis_biaya->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $pemilihan_jenis_biaya;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$pemilihan_jenis_biaya->setSessionOrderBy($sOrderBy);
				$pemilihan_jenis_biaya->apakah_disembunyikan->setSort("");
				$pemilihan_jenis_biaya->kode_biaya->setSort("");
				$pemilihan_jenis_biaya->nama_kelas_kelompok->setSort("");
				$pemilihan_jenis_biaya->kode_kelompok->setSort("");
				$pemilihan_jenis_biaya->tanggal_bayar1->setSort("");
				$pemilihan_jenis_biaya->diskon_sosial->setSort("");
				$pemilihan_jenis_biaya->diskon_waktu->setSort("");
				$pemilihan_jenis_biaya->diskon_prestasi->setSort("");
				$pemilihan_jenis_biaya->diskon_internal->setSort("");
				$pemilihan_jenis_biaya->diskon_lain->setSort("");
				$pemilihan_jenis_biaya->langkah->setSort("");
				$pemilihan_jenis_biaya->jumlah->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$pemilihan_jenis_biaya->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $pemilihan_jenis_biaya;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $pemilihan_jenis_biaya, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $pemilihan_jenis_biaya;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pemilihan_jenis_biaya;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$pemilihan_jenis_biaya->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$pemilihan_jenis_biaya->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $pemilihan_jenis_biaya->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$pemilihan_jenis_biaya->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$pemilihan_jenis_biaya->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$pemilihan_jenis_biaya->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pemilihan_jenis_biaya;

		// Call Recordset Selecting event
		$pemilihan_jenis_biaya->Recordset_Selecting($pemilihan_jenis_biaya->CurrentFilter);

		// Load List page SQL
		$sSql = $pemilihan_jenis_biaya->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pemilihan_jenis_biaya->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pemilihan_jenis_biaya;
		$sFilter = $pemilihan_jenis_biaya->KeyFilter();

		// Call Row Selecting event
		$pemilihan_jenis_biaya->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pemilihan_jenis_biaya->CurrentFilter = $sFilter;
		$sSql = $pemilihan_jenis_biaya->SQL();
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
		global $conn, $pemilihan_jenis_biaya;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pemilihan_jenis_biaya->Row_Selected($row);
		$pemilihan_jenis_biaya->apakah_disembunyikan->setDbValue($rs->fields('apakah_disembunyikan'));
		$pemilihan_jenis_biaya->kode_biaya->setDbValue($rs->fields('kode_biaya'));
		$pemilihan_jenis_biaya->nama_kelas_kelompok->setDbValue($rs->fields('nama_kelas_kelompok'));
		$pemilihan_jenis_biaya->kode_kelompok->setDbValue($rs->fields('kode_kelompok'));
		$pemilihan_jenis_biaya->tanggal_bayar1->setDbValue($rs->fields('tanggal_bayar1'));
		$pemilihan_jenis_biaya->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$pemilihan_jenis_biaya->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$pemilihan_jenis_biaya->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$pemilihan_jenis_biaya->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$pemilihan_jenis_biaya->diskon_lain->setDbValue($rs->fields('diskon_lain'));
		$pemilihan_jenis_biaya->langkah->setDbValue($rs->fields('langkah'));
		$pemilihan_jenis_biaya->jumlah->setDbValue($rs->fields('jumlah'));
	}

	// Load old record
	function LoadOldRecord() {
		global $pemilihan_jenis_biaya;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pemilihan_jenis_biaya->getKey("apakah_disembunyikan")) <> "")
			$pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue = $pemilihan_jenis_biaya->getKey("apakah_disembunyikan"); // apakah_disembunyikan
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pemilihan_jenis_biaya->CurrentFilter = $pemilihan_jenis_biaya->KeyFilter();
			$sSql = $pemilihan_jenis_biaya->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pemilihan_jenis_biaya;

		// Initialize URLs
		$this->ViewUrl = $pemilihan_jenis_biaya->ViewUrl();
		$this->EditUrl = $pemilihan_jenis_biaya->EditUrl();
		$this->InlineEditUrl = $pemilihan_jenis_biaya->InlineEditUrl();
		$this->CopyUrl = $pemilihan_jenis_biaya->CopyUrl();
		$this->InlineCopyUrl = $pemilihan_jenis_biaya->InlineCopyUrl();
		$this->DeleteUrl = $pemilihan_jenis_biaya->DeleteUrl();

		// Call Row_Rendering event
		$pemilihan_jenis_biaya->Row_Rendering();

		// Common render codes for all row types
		// apakah_disembunyikan
		// kode_biaya
		// nama_kelas_kelompok
		// kode_kelompok
		// tanggal_bayar1
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain
		// langkah
		// jumlah

		if ($pemilihan_jenis_biaya->RowType == EW_ROWTYPE_VIEW) { // View row

			// apakah_disembunyikan
			if (strval($pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue) <> "") {
				$sFilterWrk = "`nama_biaya` = '" . ew_AdjustSql($pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nama_biaya` FROM `keu_master_tanggungan`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_jenis_biaya->apakah_disembunyikan->ViewValue = $rswrk->fields('nama_biaya');
					$rswrk->Close();
				} else {
					$pemilihan_jenis_biaya->apakah_disembunyikan->ViewValue = $pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue;
				}
			} else {
				$pemilihan_jenis_biaya->apakah_disembunyikan->ViewValue = NULL;
			}
			$pemilihan_jenis_biaya->apakah_disembunyikan->ViewCustomAttributes = "";

			// kode_biaya
			if (strval($pemilihan_jenis_biaya->kode_biaya->CurrentValue) <> "") {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pemilihan_jenis_biaya->kode_biaya->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kode_otomatis` FROM `keu_master_tanggungan`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_jenis_biaya->kode_biaya->ViewValue = $rswrk->fields('kode_otomatis');
					$rswrk->Close();
				} else {
					$pemilihan_jenis_biaya->kode_biaya->ViewValue = $pemilihan_jenis_biaya->kode_biaya->CurrentValue;
				}
			} else {
				$pemilihan_jenis_biaya->kode_biaya->ViewValue = NULL;
			}
			$pemilihan_jenis_biaya->kode_biaya->ViewCustomAttributes = "";

			// nama_kelas_kelompok
			if (strval($pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue) <> "") {
				$sFilterWrk = "`nama_kelas_kelompok` = '" . ew_AdjustSql($pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nama_kelas_kelompok` FROM `st_master_kelas_kelompok`";
			$sWhereWrk = "";
			$lookuptblfilter = " kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND apakah_valid='y' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_jenis_biaya->nama_kelas_kelompok->ViewValue = $rswrk->fields('nama_kelas_kelompok');
					$rswrk->Close();
				} else {
					$pemilihan_jenis_biaya->nama_kelas_kelompok->ViewValue = $pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue;
				}
			} else {
				$pemilihan_jenis_biaya->nama_kelas_kelompok->ViewValue = NULL;
			}
			$pemilihan_jenis_biaya->nama_kelas_kelompok->ViewCustomAttributes = "";

			// kode_kelompok
			if (strval($pemilihan_jenis_biaya->kode_kelompok->CurrentValue) <> "") {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pemilihan_jenis_biaya->kode_kelompok->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kode_otomatis` FROM `st_master_kelas_kelompok`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_jenis_biaya->kode_kelompok->ViewValue = $rswrk->fields('kode_otomatis');
					$rswrk->Close();
				} else {
					$pemilihan_jenis_biaya->kode_kelompok->ViewValue = $pemilihan_jenis_biaya->kode_kelompok->CurrentValue;
				}
			} else {
				$pemilihan_jenis_biaya->kode_kelompok->ViewValue = NULL;
			}
			$pemilihan_jenis_biaya->kode_kelompok->ViewCustomAttributes = "";

			// tanggal_bayar1
			$pemilihan_jenis_biaya->tanggal_bayar1->ViewValue = $pemilihan_jenis_biaya->tanggal_bayar1->CurrentValue;
			$pemilihan_jenis_biaya->tanggal_bayar1->ViewCustomAttributes = "";

			// diskon_sosial
			$pemilihan_jenis_biaya->diskon_sosial->ViewValue = $pemilihan_jenis_biaya->diskon_sosial->CurrentValue;
			$pemilihan_jenis_biaya->diskon_sosial->ViewCustomAttributes = "";

			// diskon_waktu
			$pemilihan_jenis_biaya->diskon_waktu->ViewValue = $pemilihan_jenis_biaya->diskon_waktu->CurrentValue;
			$pemilihan_jenis_biaya->diskon_waktu->ViewValue = ew_FormatDateTime($pemilihan_jenis_biaya->diskon_waktu->ViewValue, 7);
			$pemilihan_jenis_biaya->diskon_waktu->ViewCustomAttributes = "";

			// diskon_prestasi
			$pemilihan_jenis_biaya->diskon_prestasi->ViewValue = $pemilihan_jenis_biaya->diskon_prestasi->CurrentValue;
			$pemilihan_jenis_biaya->diskon_prestasi->ViewCustomAttributes = "";

			// diskon_internal
			$pemilihan_jenis_biaya->diskon_internal->ViewValue = $pemilihan_jenis_biaya->diskon_internal->CurrentValue;
			$pemilihan_jenis_biaya->diskon_internal->ViewCustomAttributes = "";

			// diskon_lain
			$pemilihan_jenis_biaya->diskon_lain->ViewValue = $pemilihan_jenis_biaya->diskon_lain->CurrentValue;
			$pemilihan_jenis_biaya->diskon_lain->ViewCustomAttributes = "";

			// langkah
			$pemilihan_jenis_biaya->langkah->ViewValue = $pemilihan_jenis_biaya->langkah->CurrentValue;
			$pemilihan_jenis_biaya->langkah->ViewCustomAttributes = "";

			// jumlah
			$pemilihan_jenis_biaya->jumlah->ViewValue = $pemilihan_jenis_biaya->jumlah->CurrentValue;
			$pemilihan_jenis_biaya->jumlah->ViewCustomAttributes = "";

			// apakah_disembunyikan
			$pemilihan_jenis_biaya->apakah_disembunyikan->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->apakah_disembunyikan->HrefValue = "";
			$pemilihan_jenis_biaya->apakah_disembunyikan->TooltipValue = "";

			// kode_biaya
			$pemilihan_jenis_biaya->kode_biaya->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->kode_biaya->HrefValue = "";
			$pemilihan_jenis_biaya->kode_biaya->TooltipValue = "";

			// nama_kelas_kelompok
			$pemilihan_jenis_biaya->nama_kelas_kelompok->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->nama_kelas_kelompok->HrefValue = "";
			$pemilihan_jenis_biaya->nama_kelas_kelompok->TooltipValue = "";

			// kode_kelompok
			$pemilihan_jenis_biaya->kode_kelompok->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->kode_kelompok->HrefValue = "";
			$pemilihan_jenis_biaya->kode_kelompok->TooltipValue = "";

			// tanggal_bayar1
			$pemilihan_jenis_biaya->tanggal_bayar1->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->tanggal_bayar1->HrefValue = "";
			$pemilihan_jenis_biaya->tanggal_bayar1->TooltipValue = "";

			// diskon_sosial
			$pemilihan_jenis_biaya->diskon_sosial->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_sosial->HrefValue = "";
			$pemilihan_jenis_biaya->diskon_sosial->TooltipValue = "";

			// diskon_waktu
			$pemilihan_jenis_biaya->diskon_waktu->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_waktu->HrefValue = "";
			$pemilihan_jenis_biaya->diskon_waktu->TooltipValue = "";

			// diskon_prestasi
			$pemilihan_jenis_biaya->diskon_prestasi->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_prestasi->HrefValue = "";
			$pemilihan_jenis_biaya->diskon_prestasi->TooltipValue = "";

			// diskon_internal
			$pemilihan_jenis_biaya->diskon_internal->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_internal->HrefValue = "";
			$pemilihan_jenis_biaya->diskon_internal->TooltipValue = "";

			// diskon_lain
			$pemilihan_jenis_biaya->diskon_lain->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_lain->HrefValue = "";
			$pemilihan_jenis_biaya->diskon_lain->TooltipValue = "";

			// langkah
			$pemilihan_jenis_biaya->langkah->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->langkah->HrefValue = "";
			$pemilihan_jenis_biaya->langkah->TooltipValue = "";

			// jumlah
			$pemilihan_jenis_biaya->jumlah->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->jumlah->HrefValue = "";
			$pemilihan_jenis_biaya->jumlah->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pemilihan_jenis_biaya->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pemilihan_jenis_biaya->Row_Rendered();
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

<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pemilihan_kelasinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pemilihan_kelas_list = new cpemilihan_kelas_list();
$Page =& $pemilihan_kelas_list;

// Page init
$pemilihan_kelas_list->Page_Init();

// Page main
$pemilihan_kelas_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($pemilihan_kelas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pemilihan_kelas_list = new ew_Page("pemilihan_kelas_list");

// page properties
pemilihan_kelas_list.PageID = "list"; // page ID
pemilihan_kelas_list.FormID = "fpemilihan_kelaslist"; // form ID
var EW_PAGE_ID = pemilihan_kelas_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pemilihan_kelas_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pemilihan_kelas_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pemilihan_kelas_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($pemilihan_kelas->Export == "") || (EW_EXPORT_MASTER_RECORD && $pemilihan_kelas->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pemilihan_kelas_list->TotalRecs = $pemilihan_kelas->SelectRecordCount();
	} else {
		if ($pemilihan_kelas_list->Recordset = $pemilihan_kelas_list->LoadRecordset())
			$pemilihan_kelas_list->TotalRecs = $pemilihan_kelas_list->Recordset->RecordCount();
	}
	$pemilihan_kelas_list->StartRec = 1;
	if ($pemilihan_kelas_list->DisplayRecs <= 0 || ($pemilihan_kelas->Export <> "" && $pemilihan_kelas->ExportAll)) // Display all records
		$pemilihan_kelas_list->DisplayRecs = $pemilihan_kelas_list->TotalRecs;
	if (!($pemilihan_kelas->Export <> "" && $pemilihan_kelas->ExportAll))
		$pemilihan_kelas_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pemilihan_kelas_list->Recordset = $pemilihan_kelas_list->LoadRecordset($pemilihan_kelas_list->StartRec-1, $pemilihan_kelas_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $pemilihan_kelas->TableCaption() ?>
&nbsp;&nbsp;<?php $pemilihan_kelas_list->ExportOptions->Render("body"); ?>
</p>
<?php $pemilihan_kelas_list->ShowPageHeader(); ?>
<?php
$pemilihan_kelas_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($pemilihan_kelas->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($pemilihan_kelas->CurrentAction <> "gridadd" && $pemilihan_kelas->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($pemilihan_kelas_list->Pager)) $pemilihan_kelas_list->Pager = new cNumericPager($pemilihan_kelas_list->StartRec, $pemilihan_kelas_list->DisplayRecs, $pemilihan_kelas_list->TotalRecs, $pemilihan_kelas_list->RecRange) ?>
<?php if ($pemilihan_kelas_list->Pager->RecordCount > 0) { ?>
	<?php if ($pemilihan_kelas_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_kelas_list->PageUrl() ?>start=<?php echo $pemilihan_kelas_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_kelas_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_kelas_list->PageUrl() ?>start=<?php echo $pemilihan_kelas_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($pemilihan_kelas_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $pemilihan_kelas_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_kelas_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_kelas_list->PageUrl() ?>start=<?php echo $pemilihan_kelas_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_kelas_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $pemilihan_kelas_list->PageUrl() ?>start=<?php echo $pemilihan_kelas_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pemilihan_kelas_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pemilihan_kelas_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pemilihan_kelas_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pemilihan_kelas_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($pemilihan_kelas_list->SearchWhere == "0=101") { ?>
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
<?php if ($pemilihan_kelas_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="pemilihan_kelas">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($pemilihan_kelas_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($pemilihan_kelas_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($pemilihan_kelas_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($pemilihan_kelas_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($pemilihan_kelas_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($pemilihan_kelas_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($pemilihan_kelas_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($pemilihan_kelas_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($pemilihan_kelas_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $pemilihan_kelas_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fpemilihan_kelaslist" id="fpemilihan_kelaslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="pemilihan_kelas">
<div id="gmp_pemilihan_kelas" class="ewGridMiddlePanel">
<?php if ($pemilihan_kelas_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pemilihan_kelas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pemilihan_kelas_list->RenderListOptions();

// Render list options (header, left)
$pemilihan_kelas_list->ListOptions->Render("header", "left");
?>
<?php if ($pemilihan_kelas->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
	<?php if ($pemilihan_kelas->SortUrl($pemilihan_kelas->nama_kelas_kelompok) == "") { ?>
		<td><?php echo $pemilihan_kelas->nama_kelas_kelompok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_kelas->SortUrl($pemilihan_kelas->nama_kelas_kelompok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_kelas->nama_kelas_kelompok->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_kelas->nama_kelas_kelompok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_kelas->nama_kelas_kelompok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_kelas->apakah_valid->Visible) { // apakah_valid ?>
	<?php if ($pemilihan_kelas->SortUrl($pemilihan_kelas->apakah_valid) == "") { ?>
		<td><?php echo $pemilihan_kelas->apakah_valid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_kelas->SortUrl($pemilihan_kelas->apakah_valid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_kelas->apakah_valid->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_kelas->apakah_valid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_kelas->apakah_valid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_kelas->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
	<?php if ($pemilihan_kelas->SortUrl($pemilihan_kelas->kode_otomatis_tingkat) == "") { ?>
		<td><?php echo $pemilihan_kelas->kode_otomatis_tingkat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_kelas->SortUrl($pemilihan_kelas->kode_otomatis_tingkat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_kelas->kode_otomatis_tingkat->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_kelas->kode_otomatis_tingkat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_kelas->kode_otomatis_tingkat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_kelas->tahun->Visible) { // tahun ?>
	<?php if ($pemilihan_kelas->SortUrl($pemilihan_kelas->tahun) == "") { ?>
		<td><?php echo $pemilihan_kelas->tahun->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_kelas->SortUrl($pemilihan_kelas->tahun) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_kelas->tahun->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_kelas->tahun->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_kelas->tahun->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_kelas->kelas->Visible) { // kelas ?>
	<?php if ($pemilihan_kelas->SortUrl($pemilihan_kelas->kelas) == "") { ?>
		<td><?php echo $pemilihan_kelas->kelas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_kelas->SortUrl($pemilihan_kelas->kelas) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_kelas->kelas->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_kelas->kelas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_kelas->kelas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pemilihan_kelas->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($pemilihan_kelas->SortUrl($pemilihan_kelas->kode_otomatis) == "") { ?>
		<td><?php echo $pemilihan_kelas->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pemilihan_kelas->SortUrl($pemilihan_kelas->kode_otomatis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pemilihan_kelas->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($pemilihan_kelas->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pemilihan_kelas->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pemilihan_kelas_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($pemilihan_kelas->ExportAll && $pemilihan_kelas->Export <> "") {
	$pemilihan_kelas_list->StopRec = $pemilihan_kelas_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pemilihan_kelas_list->TotalRecs > $pemilihan_kelas_list->StartRec + $pemilihan_kelas_list->DisplayRecs - 1)
		$pemilihan_kelas_list->StopRec = $pemilihan_kelas_list->StartRec + $pemilihan_kelas_list->DisplayRecs - 1;
	else
		$pemilihan_kelas_list->StopRec = $pemilihan_kelas_list->TotalRecs;
}
$pemilihan_kelas_list->RecCnt = $pemilihan_kelas_list->StartRec - 1;
if ($pemilihan_kelas_list->Recordset && !$pemilihan_kelas_list->Recordset->EOF) {
	$pemilihan_kelas_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $pemilihan_kelas_list->StartRec > 1)
		$pemilihan_kelas_list->Recordset->Move($pemilihan_kelas_list->StartRec - 1);
} elseif (!$pemilihan_kelas->AllowAddDeleteRow && $pemilihan_kelas_list->StopRec == 0) {
	$pemilihan_kelas_list->StopRec = $pemilihan_kelas->GridAddRowCount;
}

// Initialize aggregate
$pemilihan_kelas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pemilihan_kelas->ResetAttrs();
$pemilihan_kelas_list->RenderRow();
$pemilihan_kelas_list->RowCnt = 0;
while ($pemilihan_kelas_list->RecCnt < $pemilihan_kelas_list->StopRec) {
	$pemilihan_kelas_list->RecCnt++;
	if (intval($pemilihan_kelas_list->RecCnt) >= intval($pemilihan_kelas_list->StartRec)) {
		$pemilihan_kelas_list->RowCnt++;

		// Set up key count
		$pemilihan_kelas_list->KeyCount = $pemilihan_kelas_list->RowIndex;

		// Init row class and style
		$pemilihan_kelas->ResetAttrs();
		$pemilihan_kelas->CssClass = "";
		if ($pemilihan_kelas->CurrentAction == "gridadd") {
		} else {
			$pemilihan_kelas_list->LoadRowValues($pemilihan_kelas_list->Recordset); // Load row values
		}
		$pemilihan_kelas->RowType = EW_ROWTYPE_VIEW; // Render view
		$pemilihan_kelas->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$pemilihan_kelas_list->RenderRow();

		// Render list options
		$pemilihan_kelas_list->RenderListOptions();
?>
	<tr<?php echo $pemilihan_kelas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pemilihan_kelas_list->ListOptions->Render("body", "left");
?>
	<?php if ($pemilihan_kelas->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
		<td<?php echo $pemilihan_kelas->nama_kelas_kelompok->CellAttributes() ?>>
<div<?php echo $pemilihan_kelas->nama_kelas_kelompok->ViewAttributes() ?>><?php echo $pemilihan_kelas->nama_kelas_kelompok->ListViewValue() ?></div>
<a name="<?php echo $pemilihan_kelas_list->PageObjName . "_row_" . $pemilihan_kelas_list->RowCnt ?>" id="<?php echo $pemilihan_kelas_list->PageObjName . "_row_" . $pemilihan_kelas_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($pemilihan_kelas->apakah_valid->Visible) { // apakah_valid ?>
		<td<?php echo $pemilihan_kelas->apakah_valid->CellAttributes() ?>>
<div<?php echo $pemilihan_kelas->apakah_valid->ViewAttributes() ?>><?php echo $pemilihan_kelas->apakah_valid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_kelas->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<td<?php echo $pemilihan_kelas->kode_otomatis_tingkat->CellAttributes() ?>>
<div<?php echo $pemilihan_kelas->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $pemilihan_kelas->kode_otomatis_tingkat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_kelas->tahun->Visible) { // tahun ?>
		<td<?php echo $pemilihan_kelas->tahun->CellAttributes() ?>>
<div<?php echo $pemilihan_kelas->tahun->ViewAttributes() ?>><?php echo $pemilihan_kelas->tahun->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_kelas->kelas->Visible) { // kelas ?>
		<td<?php echo $pemilihan_kelas->kelas->CellAttributes() ?>>
<div<?php echo $pemilihan_kelas->kelas->ViewAttributes() ?>><?php echo $pemilihan_kelas->kelas->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pemilihan_kelas->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $pemilihan_kelas->kode_otomatis->CellAttributes() ?>>
<div<?php echo $pemilihan_kelas->kode_otomatis->ViewAttributes() ?>><?php echo $pemilihan_kelas->kode_otomatis->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pemilihan_kelas_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($pemilihan_kelas->CurrentAction <> "gridadd")
		$pemilihan_kelas_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pemilihan_kelas_list->Recordset)
	$pemilihan_kelas_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($pemilihan_kelas->Export == "" && $pemilihan_kelas->CurrentAction == "") { ?>
<?php } ?>
<?php
$pemilihan_kelas_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pemilihan_kelas->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pemilihan_kelas_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpemilihan_kelas_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'pemilihan_kelas';

	// Page object name
	var $PageObjName = 'pemilihan_kelas_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pemilihan_kelas;
		if ($pemilihan_kelas->UseTokenInUrl) $PageUrl .= "t=" . $pemilihan_kelas->TableVar . "&"; // Add page token
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
		global $objForm, $pemilihan_kelas;
		if ($pemilihan_kelas->UseTokenInUrl) {
			if ($objForm)
				return ($pemilihan_kelas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pemilihan_kelas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpemilihan_kelas_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pemilihan_kelas)
		if (!isset($GLOBALS["pemilihan_kelas"])) {
			$GLOBALS["pemilihan_kelas"] = new cpemilihan_kelas();
			$GLOBALS["Table"] =& $GLOBALS["pemilihan_kelas"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "pemilihan_kelasadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pemilihan_kelasdelete.php";
		$this->MultiUpdateUrl = "pemilihan_kelasupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pemilihan_kelas', TRUE);

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
		global $pemilihan_kelas;

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
			$pemilihan_kelas->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $pemilihan_kelas;

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
			if ($pemilihan_kelas->Export <> "" ||
				$pemilihan_kelas->CurrentAction == "gridadd" ||
				$pemilihan_kelas->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($pemilihan_kelas->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $pemilihan_kelas->getRecordsPerPage(); // Restore from Session
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
		$pemilihan_kelas->setSessionWhere($sFilter);
		$pemilihan_kelas->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $pemilihan_kelas;
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
			$pemilihan_kelas->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$pemilihan_kelas->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pemilihan_kelas;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pemilihan_kelas->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pemilihan_kelas->CurrentOrderType = @$_GET["ordertype"];
			$pemilihan_kelas->UpdateSort($pemilihan_kelas->nama_kelas_kelompok); // nama_kelas_kelompok
			$pemilihan_kelas->UpdateSort($pemilihan_kelas->apakah_valid); // apakah_valid
			$pemilihan_kelas->UpdateSort($pemilihan_kelas->kode_otomatis_tingkat); // kode_otomatis_tingkat
			$pemilihan_kelas->UpdateSort($pemilihan_kelas->tahun); // tahun
			$pemilihan_kelas->UpdateSort($pemilihan_kelas->kelas); // kelas
			$pemilihan_kelas->UpdateSort($pemilihan_kelas->kode_otomatis); // kode_otomatis
			$pemilihan_kelas->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $pemilihan_kelas;
		$sOrderBy = $pemilihan_kelas->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($pemilihan_kelas->SqlOrderBy() <> "") {
				$sOrderBy = $pemilihan_kelas->SqlOrderBy();
				$pemilihan_kelas->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $pemilihan_kelas;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$pemilihan_kelas->setSessionOrderBy($sOrderBy);
				$pemilihan_kelas->nama_kelas_kelompok->setSort("");
				$pemilihan_kelas->apakah_valid->setSort("");
				$pemilihan_kelas->kode_otomatis_tingkat->setSort("");
				$pemilihan_kelas->tahun->setSort("");
				$pemilihan_kelas->kelas->setSort("");
				$pemilihan_kelas->kode_otomatis->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$pemilihan_kelas->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $pemilihan_kelas;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $pemilihan_kelas, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $pemilihan_kelas;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pemilihan_kelas;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$pemilihan_kelas->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$pemilihan_kelas->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $pemilihan_kelas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$pemilihan_kelas->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$pemilihan_kelas->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$pemilihan_kelas->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pemilihan_kelas;

		// Call Recordset Selecting event
		$pemilihan_kelas->Recordset_Selecting($pemilihan_kelas->CurrentFilter);

		// Load List page SQL
		$sSql = $pemilihan_kelas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pemilihan_kelas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pemilihan_kelas;
		$sFilter = $pemilihan_kelas->KeyFilter();

		// Call Row Selecting event
		$pemilihan_kelas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pemilihan_kelas->CurrentFilter = $sFilter;
		$sSql = $pemilihan_kelas->SQL();
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
		global $conn, $pemilihan_kelas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pemilihan_kelas->Row_Selected($row);
		$pemilihan_kelas->nama_kelas_kelompok->setDbValue($rs->fields('nama_kelas_kelompok'));
		$pemilihan_kelas->apakah_valid->setDbValue($rs->fields('apakah_valid'));
		$pemilihan_kelas->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$pemilihan_kelas->tahun->setDbValue($rs->fields('tahun'));
		$pemilihan_kelas->kelas->setDbValue($rs->fields('kelas'));
		$pemilihan_kelas->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
	}

	// Load old record
	function LoadOldRecord() {
		global $pemilihan_kelas;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pemilihan_kelas->getKey("nama_kelas_kelompok")) <> "")
			$pemilihan_kelas->nama_kelas_kelompok->CurrentValue = $pemilihan_kelas->getKey("nama_kelas_kelompok"); // nama_kelas_kelompok
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pemilihan_kelas->CurrentFilter = $pemilihan_kelas->KeyFilter();
			$sSql = $pemilihan_kelas->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pemilihan_kelas;

		// Initialize URLs
		$this->ViewUrl = $pemilihan_kelas->ViewUrl();
		$this->EditUrl = $pemilihan_kelas->EditUrl();
		$this->InlineEditUrl = $pemilihan_kelas->InlineEditUrl();
		$this->CopyUrl = $pemilihan_kelas->CopyUrl();
		$this->InlineCopyUrl = $pemilihan_kelas->InlineCopyUrl();
		$this->DeleteUrl = $pemilihan_kelas->DeleteUrl();

		// Call Row_Rendering event
		$pemilihan_kelas->Row_Rendering();

		// Common render codes for all row types
		// nama_kelas_kelompok
		// apakah_valid
		// kode_otomatis_tingkat
		// tahun
		// kelas
		// kode_otomatis

		if ($pemilihan_kelas->RowType == EW_ROWTYPE_VIEW) { // View row

			// nama_kelas_kelompok
			if (strval($pemilihan_kelas->nama_kelas_kelompok->CurrentValue) <> "") {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pemilihan_kelas->nama_kelas_kelompok->CurrentValue) . "'";
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
			$sSqlWrk .= " ORDER BY `nama_kelas_kelompok` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_kelas->nama_kelas_kelompok->ViewValue = $rswrk->fields('nama_kelas_kelompok');
					$rswrk->Close();
				} else {
					$pemilihan_kelas->nama_kelas_kelompok->ViewValue = $pemilihan_kelas->nama_kelas_kelompok->CurrentValue;
				}
			} else {
				$pemilihan_kelas->nama_kelas_kelompok->ViewValue = NULL;
			}
			$pemilihan_kelas->nama_kelas_kelompok->ViewCustomAttributes = "";

			// apakah_valid
			$pemilihan_kelas->apakah_valid->ViewValue = $pemilihan_kelas->apakah_valid->CurrentValue;
			$pemilihan_kelas->apakah_valid->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$pemilihan_kelas->kode_otomatis_tingkat->ViewValue = $pemilihan_kelas->kode_otomatis_tingkat->CurrentValue;
			$pemilihan_kelas->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// tahun
			$pemilihan_kelas->tahun->ViewValue = $pemilihan_kelas->tahun->CurrentValue;
			$pemilihan_kelas->tahun->ViewCustomAttributes = "";

			// kelas
			if (strval($pemilihan_kelas->kelas->CurrentValue) <> "") {
				$sFilterWrk = "`kelas` = '" . ew_AdjustSql($pemilihan_kelas->kelas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kelas` FROM `st_master_kelas`";
			$sWhereWrk = "";
			$lookuptblfilter = " kode_otomatis_tingkat ='" . $_SESSION['kode_otomatis_tingkat'] . "' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `kelas` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_kelas->kelas->ViewValue = $rswrk->fields('kelas');
					$rswrk->Close();
				} else {
					$pemilihan_kelas->kelas->ViewValue = $pemilihan_kelas->kelas->CurrentValue;
				}
			} else {
				$pemilihan_kelas->kelas->ViewValue = NULL;
			}
			$pemilihan_kelas->kelas->ViewCustomAttributes = "";

			// kode_otomatis
			$pemilihan_kelas->kode_otomatis->ViewValue = $pemilihan_kelas->kode_otomatis->CurrentValue;
			$pemilihan_kelas->kode_otomatis->ViewCustomAttributes = "";

			// nama_kelas_kelompok
			$pemilihan_kelas->nama_kelas_kelompok->LinkCustomAttributes = "";
			$pemilihan_kelas->nama_kelas_kelompok->HrefValue = "";
			$pemilihan_kelas->nama_kelas_kelompok->TooltipValue = "";

			// apakah_valid
			$pemilihan_kelas->apakah_valid->LinkCustomAttributes = "";
			$pemilihan_kelas->apakah_valid->HrefValue = "";
			$pemilihan_kelas->apakah_valid->TooltipValue = "";

			// kode_otomatis_tingkat
			$pemilihan_kelas->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$pemilihan_kelas->kode_otomatis_tingkat->HrefValue = "";
			$pemilihan_kelas->kode_otomatis_tingkat->TooltipValue = "";

			// tahun
			$pemilihan_kelas->tahun->LinkCustomAttributes = "";
			$pemilihan_kelas->tahun->HrefValue = "";
			$pemilihan_kelas->tahun->TooltipValue = "";

			// kelas
			$pemilihan_kelas->kelas->LinkCustomAttributes = "";
			$pemilihan_kelas->kelas->HrefValue = "";
			$pemilihan_kelas->kelas->TooltipValue = "";

			// kode_otomatis
			$pemilihan_kelas->kode_otomatis->LinkCustomAttributes = "";
			$pemilihan_kelas->kode_otomatis->HrefValue = "";
			$pemilihan_kelas->kode_otomatis->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pemilihan_kelas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pemilihan_kelas->Row_Rendered();
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

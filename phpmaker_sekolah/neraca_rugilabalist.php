<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "neraca_rugilabainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$neraca_rugilaba_list = new cneraca_rugilaba_list();
$Page =& $neraca_rugilaba_list;

// Page init
$neraca_rugilaba_list->Page_Init();

// Page main
$neraca_rugilaba_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($neraca_rugilaba->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var neraca_rugilaba_list = new ew_Page("neraca_rugilaba_list");

// page properties
neraca_rugilaba_list.PageID = "list"; // page ID
neraca_rugilaba_list.FormID = "fneraca_rugilabalist"; // form ID
var EW_PAGE_ID = neraca_rugilaba_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
neraca_rugilaba_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
neraca_rugilaba_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
neraca_rugilaba_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($neraca_rugilaba->Export == "") || (EW_EXPORT_MASTER_RECORD && $neraca_rugilaba->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$neraca_rugilaba_list->TotalRecs = $neraca_rugilaba->SelectRecordCount();
	} else {
		if ($neraca_rugilaba_list->Recordset = $neraca_rugilaba_list->LoadRecordset())
			$neraca_rugilaba_list->TotalRecs = $neraca_rugilaba_list->Recordset->RecordCount();
	}
	$neraca_rugilaba_list->StartRec = 1;
	if ($neraca_rugilaba_list->DisplayRecs <= 0 || ($neraca_rugilaba->Export <> "" && $neraca_rugilaba->ExportAll)) // Display all records
		$neraca_rugilaba_list->DisplayRecs = $neraca_rugilaba_list->TotalRecs;
	if (!($neraca_rugilaba->Export <> "" && $neraca_rugilaba->ExportAll))
		$neraca_rugilaba_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$neraca_rugilaba_list->Recordset = $neraca_rugilaba_list->LoadRecordset($neraca_rugilaba_list->StartRec-1, $neraca_rugilaba_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $neraca_rugilaba->TableCaption() ?>
&nbsp;&nbsp;<?php $neraca_rugilaba_list->ExportOptions->Render("body"); ?>
</p>
<?php $neraca_rugilaba_list->ShowPageHeader(); ?>
<?php
$neraca_rugilaba_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($neraca_rugilaba->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($neraca_rugilaba->CurrentAction <> "gridadd" && $neraca_rugilaba->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($neraca_rugilaba_list->Pager)) $neraca_rugilaba_list->Pager = new cNumericPager($neraca_rugilaba_list->StartRec, $neraca_rugilaba_list->DisplayRecs, $neraca_rugilaba_list->TotalRecs, $neraca_rugilaba_list->RecRange) ?>
<?php if ($neraca_rugilaba_list->Pager->RecordCount > 0) { ?>
	<?php if ($neraca_rugilaba_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $neraca_rugilaba_list->PageUrl() ?>start=<?php echo $neraca_rugilaba_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($neraca_rugilaba_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $neraca_rugilaba_list->PageUrl() ?>start=<?php echo $neraca_rugilaba_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($neraca_rugilaba_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $neraca_rugilaba_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($neraca_rugilaba_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $neraca_rugilaba_list->PageUrl() ?>start=<?php echo $neraca_rugilaba_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($neraca_rugilaba_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $neraca_rugilaba_list->PageUrl() ?>start=<?php echo $neraca_rugilaba_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($neraca_rugilaba_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $neraca_rugilaba_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $neraca_rugilaba_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $neraca_rugilaba_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($neraca_rugilaba_list->SearchWhere == "0=101") { ?>
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
<?php if ($neraca_rugilaba_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="neraca_rugilaba">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($neraca_rugilaba_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($neraca_rugilaba_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($neraca_rugilaba_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($neraca_rugilaba_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($neraca_rugilaba_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($neraca_rugilaba_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($neraca_rugilaba_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($neraca_rugilaba_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($neraca_rugilaba_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
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
<form name="fneraca_rugilabalist" id="fneraca_rugilabalist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="neraca_rugilaba">
<div id="gmp_neraca_rugilaba" class="ewGridMiddlePanel">
<?php if ($neraca_rugilaba_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $neraca_rugilaba->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$neraca_rugilaba_list->RenderListOptions();

// Render list options (header, left)
$neraca_rugilaba_list->ListOptions->Render("header", "left");
?>
<?php if ($neraca_rugilaba->Norek->Visible) { // Norek ?>
	<?php if ($neraca_rugilaba->SortUrl($neraca_rugilaba->Norek) == "") { ?>
		<td><?php echo $neraca_rugilaba->Norek->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $neraca_rugilaba->SortUrl($neraca_rugilaba->Norek) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $neraca_rugilaba->Norek->FldCaption() ?></td><td style="width: 10px;"><?php if ($neraca_rugilaba->Norek->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($neraca_rugilaba->Norek->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($neraca_rugilaba->Keterangan->Visible) { // Keterangan ?>
	<?php if ($neraca_rugilaba->SortUrl($neraca_rugilaba->Keterangan) == "") { ?>
		<td><?php echo $neraca_rugilaba->Keterangan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $neraca_rugilaba->SortUrl($neraca_rugilaba->Keterangan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $neraca_rugilaba->Keterangan->FldCaption() ?></td><td style="width: 10px;"><?php if ($neraca_rugilaba->Keterangan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($neraca_rugilaba->Keterangan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($neraca_rugilaba->tanggal->Visible) { // tanggal ?>
	<?php if ($neraca_rugilaba->SortUrl($neraca_rugilaba->tanggal) == "") { ?>
		<td><?php echo $neraca_rugilaba->tanggal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $neraca_rugilaba->SortUrl($neraca_rugilaba->tanggal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $neraca_rugilaba->tanggal->FldCaption() ?></td><td style="width: 10px;"><?php if ($neraca_rugilaba->tanggal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($neraca_rugilaba->tanggal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($neraca_rugilaba->saldo_debet->Visible) { // saldo_debet ?>
	<?php if ($neraca_rugilaba->SortUrl($neraca_rugilaba->saldo_debet) == "") { ?>
		<td><?php echo $neraca_rugilaba->saldo_debet->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $neraca_rugilaba->SortUrl($neraca_rugilaba->saldo_debet) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $neraca_rugilaba->saldo_debet->FldCaption() ?></td><td style="width: 10px;"><?php if ($neraca_rugilaba->saldo_debet->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($neraca_rugilaba->saldo_debet->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($neraca_rugilaba->saldo_kredit->Visible) { // saldo_kredit ?>
	<?php if ($neraca_rugilaba->SortUrl($neraca_rugilaba->saldo_kredit) == "") { ?>
		<td><?php echo $neraca_rugilaba->saldo_kredit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $neraca_rugilaba->SortUrl($neraca_rugilaba->saldo_kredit) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $neraca_rugilaba->saldo_kredit->FldCaption() ?></td><td style="width: 10px;"><?php if ($neraca_rugilaba->saldo_kredit->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($neraca_rugilaba->saldo_kredit->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$neraca_rugilaba_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($neraca_rugilaba->ExportAll && $neraca_rugilaba->Export <> "") {
	$neraca_rugilaba_list->StopRec = $neraca_rugilaba_list->TotalRecs;
} else {

	// Set the last record to display
	if ($neraca_rugilaba_list->TotalRecs > $neraca_rugilaba_list->StartRec + $neraca_rugilaba_list->DisplayRecs - 1)
		$neraca_rugilaba_list->StopRec = $neraca_rugilaba_list->StartRec + $neraca_rugilaba_list->DisplayRecs - 1;
	else
		$neraca_rugilaba_list->StopRec = $neraca_rugilaba_list->TotalRecs;
}
$neraca_rugilaba_list->RecCnt = $neraca_rugilaba_list->StartRec - 1;
if ($neraca_rugilaba_list->Recordset && !$neraca_rugilaba_list->Recordset->EOF) {
	$neraca_rugilaba_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $neraca_rugilaba_list->StartRec > 1)
		$neraca_rugilaba_list->Recordset->Move($neraca_rugilaba_list->StartRec - 1);
} elseif (!$neraca_rugilaba->AllowAddDeleteRow && $neraca_rugilaba_list->StopRec == 0) {
	$neraca_rugilaba_list->StopRec = $neraca_rugilaba->GridAddRowCount;
}

// Initialize aggregate
$neraca_rugilaba->RowType = EW_ROWTYPE_AGGREGATEINIT;
$neraca_rugilaba->ResetAttrs();
$neraca_rugilaba_list->RenderRow();
$neraca_rugilaba_list->RowCnt = 0;
while ($neraca_rugilaba_list->RecCnt < $neraca_rugilaba_list->StopRec) {
	$neraca_rugilaba_list->RecCnt++;
	if (intval($neraca_rugilaba_list->RecCnt) >= intval($neraca_rugilaba_list->StartRec)) {
		$neraca_rugilaba_list->RowCnt++;

		// Set up key count
		$neraca_rugilaba_list->KeyCount = $neraca_rugilaba_list->RowIndex;

		// Init row class and style
		$neraca_rugilaba->ResetAttrs();
		$neraca_rugilaba->CssClass = "";
		if ($neraca_rugilaba->CurrentAction == "gridadd") {
		} else {
			$neraca_rugilaba_list->LoadRowValues($neraca_rugilaba_list->Recordset); // Load row values
		}
		$neraca_rugilaba->RowType = EW_ROWTYPE_VIEW; // Render view
		$neraca_rugilaba->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$neraca_rugilaba_list->RenderRow();

		// Render list options
		$neraca_rugilaba_list->RenderListOptions();
?>
	<tr<?php echo $neraca_rugilaba->RowAttributes() ?>>
<?php

// Render list options (body, left)
$neraca_rugilaba_list->ListOptions->Render("body", "left");
?>
	<?php if ($neraca_rugilaba->Norek->Visible) { // Norek ?>
		<td<?php echo $neraca_rugilaba->Norek->CellAttributes() ?>>
<div<?php echo $neraca_rugilaba->Norek->ViewAttributes() ?>><?php echo $neraca_rugilaba->Norek->ListViewValue() ?></div>
<a name="<?php echo $neraca_rugilaba_list->PageObjName . "_row_" . $neraca_rugilaba_list->RowCnt ?>" id="<?php echo $neraca_rugilaba_list->PageObjName . "_row_" . $neraca_rugilaba_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($neraca_rugilaba->Keterangan->Visible) { // Keterangan ?>
		<td<?php echo $neraca_rugilaba->Keterangan->CellAttributes() ?>>
<div<?php echo $neraca_rugilaba->Keterangan->ViewAttributes() ?>><?php echo $neraca_rugilaba->Keterangan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($neraca_rugilaba->tanggal->Visible) { // tanggal ?>
		<td<?php echo $neraca_rugilaba->tanggal->CellAttributes() ?>>
<div<?php echo $neraca_rugilaba->tanggal->ViewAttributes() ?>><?php echo $neraca_rugilaba->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($neraca_rugilaba->saldo_debet->Visible) { // saldo_debet ?>
		<td<?php echo $neraca_rugilaba->saldo_debet->CellAttributes() ?>>
<div<?php echo $neraca_rugilaba->saldo_debet->ViewAttributes() ?>><?php echo $neraca_rugilaba->saldo_debet->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($neraca_rugilaba->saldo_kredit->Visible) { // saldo_kredit ?>
		<td<?php echo $neraca_rugilaba->saldo_kredit->CellAttributes() ?>>
<div<?php echo $neraca_rugilaba->saldo_kredit->ViewAttributes() ?>><?php echo $neraca_rugilaba->saldo_kredit->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$neraca_rugilaba_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($neraca_rugilaba->CurrentAction <> "gridadd")
		$neraca_rugilaba_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($neraca_rugilaba_list->Recordset)
	$neraca_rugilaba_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($neraca_rugilaba->Export == "" && $neraca_rugilaba->CurrentAction == "") { ?>
<?php } ?>
<?php
$neraca_rugilaba_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($neraca_rugilaba->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$neraca_rugilaba_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cneraca_rugilaba_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'neraca_rugilaba';

	// Page object name
	var $PageObjName = 'neraca_rugilaba_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $neraca_rugilaba;
		if ($neraca_rugilaba->UseTokenInUrl) $PageUrl .= "t=" . $neraca_rugilaba->TableVar . "&"; // Add page token
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
		global $objForm, $neraca_rugilaba;
		if ($neraca_rugilaba->UseTokenInUrl) {
			if ($objForm)
				return ($neraca_rugilaba->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($neraca_rugilaba->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cneraca_rugilaba_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (neraca_rugilaba)
		if (!isset($GLOBALS["neraca_rugilaba"])) {
			$GLOBALS["neraca_rugilaba"] = new cneraca_rugilaba();
			$GLOBALS["Table"] =& $GLOBALS["neraca_rugilaba"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "neraca_rugilabaadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "neraca_rugilabadelete.php";
		$this->MultiUpdateUrl = "neraca_rugilabaupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'neraca_rugilaba', TRUE);

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
		global $neraca_rugilaba;

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
			$neraca_rugilaba->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$neraca_rugilaba->Export = $_POST["exporttype"];
		} else {
			$neraca_rugilaba->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $neraca_rugilaba->Export; // Get export parameter, used in header
		$gsExportFile = $neraca_rugilaba->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($neraca_rugilaba->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($neraca_rugilaba->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$neraca_rugilaba->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $neraca_rugilaba;

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
			if ($neraca_rugilaba->Export <> "" ||
				$neraca_rugilaba->CurrentAction == "gridadd" ||
				$neraca_rugilaba->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($neraca_rugilaba->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $neraca_rugilaba->getRecordsPerPage(); // Restore from Session
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
		$neraca_rugilaba->setSessionWhere($sFilter);
		$neraca_rugilaba->CurrentFilter = "";

		// Export data only
		if (in_array($neraca_rugilaba->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($neraca_rugilaba->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $neraca_rugilaba;
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
			$neraca_rugilaba->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$neraca_rugilaba->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $neraca_rugilaba;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$neraca_rugilaba->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$neraca_rugilaba->CurrentOrderType = @$_GET["ordertype"];
			$neraca_rugilaba->UpdateSort($neraca_rugilaba->Norek); // Norek
			$neraca_rugilaba->UpdateSort($neraca_rugilaba->Keterangan); // Keterangan
			$neraca_rugilaba->UpdateSort($neraca_rugilaba->tanggal); // tanggal
			$neraca_rugilaba->UpdateSort($neraca_rugilaba->saldo_debet); // saldo_debet
			$neraca_rugilaba->UpdateSort($neraca_rugilaba->saldo_kredit); // saldo_kredit
			$neraca_rugilaba->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $neraca_rugilaba;
		$sOrderBy = $neraca_rugilaba->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($neraca_rugilaba->SqlOrderBy() <> "") {
				$sOrderBy = $neraca_rugilaba->SqlOrderBy();
				$neraca_rugilaba->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $neraca_rugilaba;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$neraca_rugilaba->setSessionOrderBy($sOrderBy);
				$neraca_rugilaba->Norek->setSort("");
				$neraca_rugilaba->Keterangan->setSort("");
				$neraca_rugilaba->tanggal->setSort("");
				$neraca_rugilaba->saldo_debet->setSort("");
				$neraca_rugilaba->saldo_kredit->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$neraca_rugilaba->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $neraca_rugilaba;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $neraca_rugilaba, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $neraca_rugilaba;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $neraca_rugilaba;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$neraca_rugilaba->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$neraca_rugilaba->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $neraca_rugilaba->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$neraca_rugilaba->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$neraca_rugilaba->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$neraca_rugilaba->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $neraca_rugilaba;

		// Call Recordset Selecting event
		$neraca_rugilaba->Recordset_Selecting($neraca_rugilaba->CurrentFilter);

		// Load List page SQL
		$sSql = $neraca_rugilaba->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$neraca_rugilaba->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $neraca_rugilaba;
		$sFilter = $neraca_rugilaba->KeyFilter();

		// Call Row Selecting event
		$neraca_rugilaba->Row_Selecting($sFilter);

		// Load SQL based on filter
		$neraca_rugilaba->CurrentFilter = $sFilter;
		$sSql = $neraca_rugilaba->SQL();
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
		global $conn, $neraca_rugilaba;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$neraca_rugilaba->Row_Selected($row);
		$neraca_rugilaba->Norek->setDbValue($rs->fields('Norek'));
		$neraca_rugilaba->Keterangan->setDbValue($rs->fields('Keterangan'));
		$neraca_rugilaba->tanggal->setDbValue($rs->fields('tanggal'));
		$neraca_rugilaba->saldo_debet->setDbValue($rs->fields('saldo_debet'));
		$neraca_rugilaba->saldo_kredit->setDbValue($rs->fields('saldo_kredit'));
	}

	// Load old record
	function LoadOldRecord() {
		global $neraca_rugilaba;

		// Load key values from Session
		$bValidKey = TRUE;

		// Load old recordset
		if ($bValidKey) {
			$neraca_rugilaba->CurrentFilter = $neraca_rugilaba->KeyFilter();
			$sSql = $neraca_rugilaba->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $neraca_rugilaba;

		// Initialize URLs
		$this->ViewUrl = $neraca_rugilaba->ViewUrl();
		$this->EditUrl = $neraca_rugilaba->EditUrl();
		$this->InlineEditUrl = $neraca_rugilaba->InlineEditUrl();
		$this->CopyUrl = $neraca_rugilaba->CopyUrl();
		$this->InlineCopyUrl = $neraca_rugilaba->InlineCopyUrl();
		$this->DeleteUrl = $neraca_rugilaba->DeleteUrl();

		// Call Row_Rendering event
		$neraca_rugilaba->Row_Rendering();

		// Common render codes for all row types
		// Norek
		// Keterangan
		// tanggal
		// saldo_debet
		// saldo_kredit

		if ($neraca_rugilaba->RowType == EW_ROWTYPE_VIEW) { // View row

			// Norek
			$neraca_rugilaba->Norek->ViewValue = $neraca_rugilaba->Norek->CurrentValue;
			$neraca_rugilaba->Norek->ViewCustomAttributes = "";

			// Keterangan
			$neraca_rugilaba->Keterangan->ViewValue = $neraca_rugilaba->Keterangan->CurrentValue;
			$neraca_rugilaba->Keterangan->ViewCustomAttributes = "";

			// tanggal
			$neraca_rugilaba->tanggal->ViewValue = $neraca_rugilaba->tanggal->CurrentValue;
			$neraca_rugilaba->tanggal->ViewValue = ew_FormatDateTime($neraca_rugilaba->tanggal->ViewValue, 7);
			$neraca_rugilaba->tanggal->ViewCustomAttributes = "";

			// saldo_debet
			$neraca_rugilaba->saldo_debet->ViewValue = $neraca_rugilaba->saldo_debet->CurrentValue;
			$neraca_rugilaba->saldo_debet->ViewCustomAttributes = "";

			// saldo_kredit
			$neraca_rugilaba->saldo_kredit->ViewValue = $neraca_rugilaba->saldo_kredit->CurrentValue;
			$neraca_rugilaba->saldo_kredit->ViewCustomAttributes = "";

			// Norek
			$neraca_rugilaba->Norek->LinkCustomAttributes = "";
			$neraca_rugilaba->Norek->HrefValue = "";
			$neraca_rugilaba->Norek->TooltipValue = "";

			// Keterangan
			$neraca_rugilaba->Keterangan->LinkCustomAttributes = "";
			$neraca_rugilaba->Keterangan->HrefValue = "";
			$neraca_rugilaba->Keterangan->TooltipValue = "";

			// tanggal
			$neraca_rugilaba->tanggal->LinkCustomAttributes = "";
			$neraca_rugilaba->tanggal->HrefValue = "";
			$neraca_rugilaba->tanggal->TooltipValue = "";

			// saldo_debet
			$neraca_rugilaba->saldo_debet->LinkCustomAttributes = "";
			$neraca_rugilaba->saldo_debet->HrefValue = "";
			$neraca_rugilaba->saldo_debet->TooltipValue = "";

			// saldo_kredit
			$neraca_rugilaba->saldo_kredit->LinkCustomAttributes = "";
			$neraca_rugilaba->saldo_kredit->HrefValue = "";
			$neraca_rugilaba->saldo_kredit->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($neraca_rugilaba->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$neraca_rugilaba->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $neraca_rugilaba;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\">" . "<img src=\"phpimages/print.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\">" . "<img src=\"phpimages/exportxls.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\">" . "<img src=\"phpimages/exportdoc.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\">" . "<img src=\"phpimages/exporthtml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\">" . "<img src=\"phpimages/exportxml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\">" . "<img src=\"phpimages/exportcsv.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\">" . "<img src=\"phpimages/exportpdf.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_neraca_rugilaba\" id=\"emf_neraca_rugilaba\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_neraca_rugilaba',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fneraca_rugilabalist,sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($neraca_rugilaba->Export <> "" ||
			$neraca_rugilaba->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $neraca_rugilaba;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $neraca_rugilaba->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($neraca_rugilaba->ExportAll) {
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
		if ($neraca_rugilaba->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($neraca_rugilaba, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($neraca_rugilaba->Export == "xml") {
			$neraca_rugilaba->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$neraca_rugilaba->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($neraca_rugilaba->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($neraca_rugilaba->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($neraca_rugilaba->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($neraca_rugilaba->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($neraca_rugilaba->ExportReturnUrl());
		} elseif ($neraca_rugilaba->Export == "pdf") {
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
	// Bismillaah
	global $Language;
	
	
		  
	$Language->setPhrase("TblTypeVIEW","");
	
	$judul= "Neraca Rugi/Laba ";
	   
	$Language->setTablePhrase(CurrentTable()->TableName, "TblCaption", $judul); 
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

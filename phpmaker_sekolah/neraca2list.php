<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "neraca2info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$neraca2_list = new cneraca2_list();
$Page =& $neraca2_list;

// Page init
$neraca2_list->Page_Init();

// Page main
$neraca2_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($neraca2->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var neraca2_list = new ew_Page("neraca2_list");

// page properties
neraca2_list.PageID = "list"; // page ID
neraca2_list.FormID = "fneraca2list"; // form ID
var EW_PAGE_ID = neraca2_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
neraca2_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
neraca2_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
neraca2_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($neraca2->Export == "") || (EW_EXPORT_MASTER_RECORD && $neraca2->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$neraca2_list->TotalRecs = $neraca2->SelectRecordCount();
	} else {
		if ($neraca2_list->Recordset = $neraca2_list->LoadRecordset())
			$neraca2_list->TotalRecs = $neraca2_list->Recordset->RecordCount();
	}
	$neraca2_list->StartRec = 1;
	if ($neraca2_list->DisplayRecs <= 0 || ($neraca2->Export <> "" && $neraca2->ExportAll)) // Display all records
		$neraca2_list->DisplayRecs = $neraca2_list->TotalRecs;
	if (!($neraca2->Export <> "" && $neraca2->ExportAll))
		$neraca2_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$neraca2_list->Recordset = $neraca2_list->LoadRecordset($neraca2_list->StartRec-1, $neraca2_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $neraca2->TableCaption() ?>
&nbsp;&nbsp;<?php $neraca2_list->ExportOptions->Render("body"); ?>
</p>
<?php $neraca2_list->ShowPageHeader(); ?>
<?php
$neraca2_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($neraca2->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($neraca2->CurrentAction <> "gridadd" && $neraca2->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($neraca2_list->Pager)) $neraca2_list->Pager = new cNumericPager($neraca2_list->StartRec, $neraca2_list->DisplayRecs, $neraca2_list->TotalRecs, $neraca2_list->RecRange) ?>
<?php if ($neraca2_list->Pager->RecordCount > 0) { ?>
	<?php if ($neraca2_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $neraca2_list->PageUrl() ?>start=<?php echo $neraca2_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($neraca2_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $neraca2_list->PageUrl() ?>start=<?php echo $neraca2_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($neraca2_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $neraca2_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($neraca2_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $neraca2_list->PageUrl() ?>start=<?php echo $neraca2_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($neraca2_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $neraca2_list->PageUrl() ?>start=<?php echo $neraca2_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($neraca2_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $neraca2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $neraca2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $neraca2_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($neraca2_list->SearchWhere == "0=101") { ?>
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
<?php if ($neraca2_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="neraca2">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="2000"<?php if ($neraca2_list->DisplayRecs == 2000) { ?> selected="selected"<?php } ?>>2000</option>
<option value="ALL"<?php if ($neraca2->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
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
<form name="fneraca2list" id="fneraca2list" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="neraca2">
<div id="gmp_neraca2" class="ewGridMiddlePanel">
<?php if ($neraca2_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $neraca2->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$neraca2_list->RenderListOptions();

// Render list options (header, left)
$neraca2_list->ListOptions->Render("header", "left");
?>
<?php if ($neraca2->Norek->Visible) { // Norek ?>
	<?php if ($neraca2->SortUrl($neraca2->Norek) == "") { ?>
		<td><?php echo $neraca2->Norek->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $neraca2->SortUrl($neraca2->Norek) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $neraca2->Norek->FldCaption() ?></td><td style="width: 10px;"><?php if ($neraca2->Norek->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($neraca2->Norek->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($neraca2->Keterangan->Visible) { // Keterangan ?>
	<?php if ($neraca2->SortUrl($neraca2->Keterangan) == "") { ?>
		<td><?php echo $neraca2->Keterangan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $neraca2->SortUrl($neraca2->Keterangan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $neraca2->Keterangan->FldCaption() ?></td><td style="width: 10px;"><?php if ($neraca2->Keterangan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($neraca2->Keterangan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($neraca2->saldo_debet->Visible) { // saldo_debet ?>
	<?php if ($neraca2->SortUrl($neraca2->saldo_debet) == "") { ?>
		<td><?php echo $neraca2->saldo_debet->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $neraca2->SortUrl($neraca2->saldo_debet) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $neraca2->saldo_debet->FldCaption() ?></td><td style="width: 10px;"><?php if ($neraca2->saldo_debet->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($neraca2->saldo_debet->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($neraca2->saldo_kredit->Visible) { // saldo_kredit ?>
	<?php if ($neraca2->SortUrl($neraca2->saldo_kredit) == "") { ?>
		<td><?php echo $neraca2->saldo_kredit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $neraca2->SortUrl($neraca2->saldo_kredit) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $neraca2->saldo_kredit->FldCaption() ?></td><td style="width: 10px;"><?php if ($neraca2->saldo_kredit->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($neraca2->saldo_kredit->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$neraca2_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($neraca2->ExportAll && $neraca2->Export <> "") {
	$neraca2_list->StopRec = $neraca2_list->TotalRecs;
} else {

	// Set the last record to display
	if ($neraca2_list->TotalRecs > $neraca2_list->StartRec + $neraca2_list->DisplayRecs - 1)
		$neraca2_list->StopRec = $neraca2_list->StartRec + $neraca2_list->DisplayRecs - 1;
	else
		$neraca2_list->StopRec = $neraca2_list->TotalRecs;
}
$neraca2_list->RecCnt = $neraca2_list->StartRec - 1;
if ($neraca2_list->Recordset && !$neraca2_list->Recordset->EOF) {
	$neraca2_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $neraca2_list->StartRec > 1)
		$neraca2_list->Recordset->Move($neraca2_list->StartRec - 1);
} elseif (!$neraca2->AllowAddDeleteRow && $neraca2_list->StopRec == 0) {
	$neraca2_list->StopRec = $neraca2->GridAddRowCount;
}

// Initialize aggregate
$neraca2->RowType = EW_ROWTYPE_AGGREGATEINIT;
$neraca2->ResetAttrs();
$neraca2_list->RenderRow();
$neraca2_list->RowCnt = 0;
while ($neraca2_list->RecCnt < $neraca2_list->StopRec) {
	$neraca2_list->RecCnt++;
	if (intval($neraca2_list->RecCnt) >= intval($neraca2_list->StartRec)) {
		$neraca2_list->RowCnt++;

		// Set up key count
		$neraca2_list->KeyCount = $neraca2_list->RowIndex;

		// Init row class and style
		$neraca2->ResetAttrs();
		$neraca2->CssClass = "";
		if ($neraca2->CurrentAction == "gridadd") {
		} else {
			$neraca2_list->LoadRowValues($neraca2_list->Recordset); // Load row values
		}
		$neraca2->RowType = EW_ROWTYPE_VIEW; // Render view
		$neraca2->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$neraca2_list->RenderRow();

		// Render list options
		$neraca2_list->RenderListOptions();
?>
	<tr<?php echo $neraca2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$neraca2_list->ListOptions->Render("body", "left");
?>
	<?php if ($neraca2->Norek->Visible) { // Norek ?>
		<td<?php echo $neraca2->Norek->CellAttributes() ?>>
<div<?php echo $neraca2->Norek->ViewAttributes() ?>><?php echo $neraca2->Norek->ListViewValue() ?></div>
<a name="<?php echo $neraca2_list->PageObjName . "_row_" . $neraca2_list->RowCnt ?>" id="<?php echo $neraca2_list->PageObjName . "_row_" . $neraca2_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($neraca2->Keterangan->Visible) { // Keterangan ?>
		<td<?php echo $neraca2->Keterangan->CellAttributes() ?>>
<div<?php echo $neraca2->Keterangan->ViewAttributes() ?>><?php echo $neraca2->Keterangan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($neraca2->saldo_debet->Visible) { // saldo_debet ?>
		<td<?php echo $neraca2->saldo_debet->CellAttributes() ?>>
<div<?php echo $neraca2->saldo_debet->ViewAttributes() ?>><?php echo $neraca2->saldo_debet->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($neraca2->saldo_kredit->Visible) { // saldo_kredit ?>
		<td<?php echo $neraca2->saldo_kredit->CellAttributes() ?>>
<div<?php echo $neraca2->saldo_kredit->ViewAttributes() ?>><?php echo $neraca2->saldo_kredit->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$neraca2_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($neraca2->CurrentAction <> "gridadd")
		$neraca2_list->Recordset->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$neraca2->RowType = EW_ROWTYPE_AGGREGATE;
$neraca2->ResetAttrs();
$neraca2_list->RenderRow();
?>
<?php if ($neraca2_list->TotalRecs > 0 && ($neraca2->CurrentAction <> "gridadd" && $neraca2->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$neraca2_list->RenderListOptions();

// Render list options (footer, left)
$neraca2_list->ListOptions->Render("footer", "left");
?>
	<?php if ($neraca2->Norek->Visible) { // Norek ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($neraca2->Keterangan->Visible) { // Keterangan ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($neraca2->saldo_debet->Visible) { // saldo_debet ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $neraca2->saldo_debet->ViewAttributes() ?>><?php echo $neraca2->saldo_debet->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($neraca2->saldo_kredit->Visible) { // saldo_kredit ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $neraca2->saldo_kredit->ViewAttributes() ?>><?php echo $neraca2->saldo_kredit->ViewValue ?></span> 
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$neraca2_list->ListOptions->Render("footer", "right");
?>
	</tr>
</tfoot>	
<?php } ?>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($neraca2_list->Recordset)
	$neraca2_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($neraca2->Export == "" && $neraca2->CurrentAction == "") { ?>
<?php } ?>
<?php
$neraca2_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($neraca2->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$neraca2_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cneraca2_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'neraca2';

	// Page object name
	var $PageObjName = 'neraca2_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $neraca2;
		if ($neraca2->UseTokenInUrl) $PageUrl .= "t=" . $neraca2->TableVar . "&"; // Add page token
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
		global $objForm, $neraca2;
		if ($neraca2->UseTokenInUrl) {
			if ($objForm)
				return ($neraca2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($neraca2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cneraca2_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (neraca2)
		if (!isset($GLOBALS["neraca2"])) {
			$GLOBALS["neraca2"] = new cneraca2();
			$GLOBALS["Table"] =& $GLOBALS["neraca2"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "neraca2add.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "neraca2delete.php";
		$this->MultiUpdateUrl = "neraca2update.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'neraca2', TRUE);

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
		global $neraca2;

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
			$neraca2->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$neraca2->Export = $_POST["exporttype"];
		} else {
			$neraca2->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $neraca2->Export; // Get export parameter, used in header
		$gsExportFile = $neraca2->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($neraca2->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($neraca2->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$neraca2->GridAddRowCount = $gridaddcnt;

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
	var $DisplayRecs = 2000;
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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $neraca2;

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
			if ($neraca2->Export <> "" ||
				$neraca2->CurrentAction == "gridadd" ||
				$neraca2->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($neraca2->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $neraca2->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 2000; // Load default
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
		$neraca2->setSessionWhere($sFilter);
		$neraca2->CurrentFilter = "";

		// Export data only
		if (in_array($neraca2->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($neraca2->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $neraca2;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 2000; // Non-numeric, load default
				}
			}
			$neraca2->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$neraca2->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $neraca2;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$neraca2->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$neraca2->CurrentOrderType = @$_GET["ordertype"];
			$neraca2->UpdateSort($neraca2->Norek); // Norek
			$neraca2->UpdateSort($neraca2->Keterangan); // Keterangan
			$neraca2->UpdateSort($neraca2->saldo_debet); // saldo_debet
			$neraca2->UpdateSort($neraca2->saldo_kredit); // saldo_kredit
			$neraca2->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $neraca2;
		$sOrderBy = $neraca2->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($neraca2->SqlOrderBy() <> "") {
				$sOrderBy = $neraca2->SqlOrderBy();
				$neraca2->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $neraca2;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$neraca2->setSessionOrderBy($sOrderBy);
				$neraca2->Norek->setSort("");
				$neraca2->Keterangan->setSort("");
				$neraca2->saldo_debet->setSort("");
				$neraca2->saldo_kredit->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$neraca2->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $neraca2;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $neraca2, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $neraca2;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $neraca2;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$neraca2->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$neraca2->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $neraca2->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$neraca2->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$neraca2->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$neraca2->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $neraca2;

		// Call Recordset Selecting event
		$neraca2->Recordset_Selecting($neraca2->CurrentFilter);

		// Load List page SQL
		$sSql = $neraca2->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$neraca2->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $neraca2;
		$sFilter = $neraca2->KeyFilter();

		// Call Row Selecting event
		$neraca2->Row_Selecting($sFilter);

		// Load SQL based on filter
		$neraca2->CurrentFilter = $sFilter;
		$sSql = $neraca2->SQL();
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
		global $conn, $neraca2;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$neraca2->Row_Selected($row);
		$neraca2->Norek->setDbValue($rs->fields('Norek'));
		$neraca2->Keterangan->setDbValue($rs->fields('Keterangan'));
		$neraca2->tanggal->setDbValue($rs->fields('tanggal'));
		$neraca2->saldo_debet->setDbValue($rs->fields('saldo_debet'));
		$neraca2->saldo_kredit->setDbValue($rs->fields('saldo_kredit'));
	}

	// Load old record
	function LoadOldRecord() {
		global $neraca2;

		// Load key values from Session
		$bValidKey = TRUE;

		// Load old recordset
		if ($bValidKey) {
			$neraca2->CurrentFilter = $neraca2->KeyFilter();
			$sSql = $neraca2->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $neraca2;

		// Initialize URLs
		$this->ViewUrl = $neraca2->ViewUrl();
		$this->EditUrl = $neraca2->EditUrl();
		$this->InlineEditUrl = $neraca2->InlineEditUrl();
		$this->CopyUrl = $neraca2->CopyUrl();
		$this->InlineCopyUrl = $neraca2->InlineCopyUrl();
		$this->DeleteUrl = $neraca2->DeleteUrl();

		// Call Row_Rendering event
		$neraca2->Row_Rendering();

		// Common render codes for all row types
		// Norek
		// Keterangan
		// tanggal
		// saldo_debet
		// saldo_kredit
		// Accumulate aggregate value

		if ($neraca2->RowType <> EW_ROWTYPE_AGGREGATEINIT && $neraca2->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($neraca2->saldo_debet->CurrentValue))
				$neraca2->saldo_debet->Total += $neraca2->saldo_debet->CurrentValue; // Accumulate total
			if (is_numeric($neraca2->saldo_kredit->CurrentValue))
				$neraca2->saldo_kredit->Total += $neraca2->saldo_kredit->CurrentValue; // Accumulate total
		}
		if ($neraca2->RowType == EW_ROWTYPE_VIEW) { // View row

			// Norek
			$neraca2->Norek->ViewValue = $neraca2->Norek->CurrentValue;
			$neraca2->Norek->ViewCustomAttributes = "";

			// Keterangan
			$neraca2->Keterangan->ViewValue = $neraca2->Keterangan->CurrentValue;
			$neraca2->Keterangan->ViewCustomAttributes = "";

			// tanggal
			$neraca2->tanggal->ViewValue = $neraca2->tanggal->CurrentValue;
			$neraca2->tanggal->ViewCustomAttributes = "";

			// saldo_debet
			$neraca2->saldo_debet->ViewValue = $neraca2->saldo_debet->CurrentValue;
			$neraca2->saldo_debet->ViewCustomAttributes = "";

			// saldo_kredit
			$neraca2->saldo_kredit->ViewValue = $neraca2->saldo_kredit->CurrentValue;
			$neraca2->saldo_kredit->ViewCustomAttributes = "";

			// Norek
			$neraca2->Norek->LinkCustomAttributes = "";
			$neraca2->Norek->HrefValue = "";
			$neraca2->Norek->TooltipValue = "";

			// Keterangan
			$neraca2->Keterangan->LinkCustomAttributes = "";
			$neraca2->Keterangan->HrefValue = "";
			$neraca2->Keterangan->TooltipValue = "";

			// saldo_debet
			$neraca2->saldo_debet->LinkCustomAttributes = "";
			$neraca2->saldo_debet->HrefValue = "";
			$neraca2->saldo_debet->TooltipValue = "";

			// saldo_kredit
			$neraca2->saldo_kredit->LinkCustomAttributes = "";
			$neraca2->saldo_kredit->HrefValue = "";
			$neraca2->saldo_kredit->TooltipValue = "";
		} elseif ($neraca2->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$neraca2->saldo_debet->Total = 0; // Initialize total
			$neraca2->saldo_kredit->Total = 0; // Initialize total
		} elseif ($neraca2->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$neraca2->saldo_debet->CurrentValue = $neraca2->saldo_debet->Total;
			$neraca2->saldo_debet->ViewValue = $neraca2->saldo_debet->CurrentValue;
			$neraca2->saldo_debet->ViewCustomAttributes = "";
			$neraca2->saldo_debet->HrefValue = ""; // Clear href value
			$neraca2->saldo_kredit->CurrentValue = $neraca2->saldo_kredit->Total;
			$neraca2->saldo_kredit->ViewValue = $neraca2->saldo_kredit->CurrentValue;
			$neraca2->saldo_kredit->ViewCustomAttributes = "";
			$neraca2->saldo_kredit->HrefValue = ""; // Clear href value
		}

		// Call Row Rendered event
		if ($neraca2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$neraca2->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $neraca2;

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
		$item->Body = "<a name=\"emf_neraca2\" id=\"emf_neraca2\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_neraca2',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fneraca2list,sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($neraca2->Export <> "" ||
			$neraca2->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $neraca2;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $neraca2->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($neraca2->ExportAll) {
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
		if ($neraca2->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($neraca2, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($neraca2->Export == "xml") {
			$neraca2->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$neraca2->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($neraca2->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($neraca2->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($neraca2->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($neraca2->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($neraca2->ExportReturnUrl());
		} elseif ($neraca2->Export == "pdf") {
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
	
	$judul= "Neraca Saldo ";
	   
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

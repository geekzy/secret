<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pokokrekinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pokokrek_list = new cpokokrek_list();
$Page =& $pokokrek_list;

// Page init
$pokokrek_list->Page_Init();

// Page main
$pokokrek_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($pokokrek->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pokokrek_list = new ew_Page("pokokrek_list");

// page properties
pokokrek_list.PageID = "list"; // page ID
pokokrek_list.FormID = "fpokokreklist"; // form ID
var EW_PAGE_ID = pokokrek_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pokokrek_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pokokrek_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pokokrek_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($pokokrek->Export == "") || (EW_EXPORT_MASTER_RECORD && $pokokrek->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pokokrek_list->TotalRecs = $pokokrek->SelectRecordCount();
	} else {
		if ($pokokrek_list->Recordset = $pokokrek_list->LoadRecordset())
			$pokokrek_list->TotalRecs = $pokokrek_list->Recordset->RecordCount();
	}
	$pokokrek_list->StartRec = 1;
	if ($pokokrek_list->DisplayRecs <= 0 || ($pokokrek->Export <> "" && $pokokrek->ExportAll)) // Display all records
		$pokokrek_list->DisplayRecs = $pokokrek_list->TotalRecs;
	if (!($pokokrek->Export <> "" && $pokokrek->ExportAll))
		$pokokrek_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pokokrek_list->Recordset = $pokokrek_list->LoadRecordset($pokokrek_list->StartRec-1, $pokokrek_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pokokrek->TableCaption() ?>
&nbsp;&nbsp;<?php $pokokrek_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($pokokrek->Export == "" && $pokokrek->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(pokokrek_list);" style="text-decoration: none;"><img id="pokokrek_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="pokokrek_list_SearchPanel">
<form name="fpokokreklistsrch" id="fpokokreklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="pokokrek">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($pokokrek->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $pokokrek_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($pokokrek->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($pokokrek->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($pokokrek->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $pokokrek_list->ShowPageHeader(); ?>
<?php
$pokokrek_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($pokokrek->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($pokokrek->CurrentAction <> "gridadd" && $pokokrek->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($pokokrek_list->Pager)) $pokokrek_list->Pager = new cNumericPager($pokokrek_list->StartRec, $pokokrek_list->DisplayRecs, $pokokrek_list->TotalRecs, $pokokrek_list->RecRange) ?>
<?php if ($pokokrek_list->Pager->RecordCount > 0) { ?>
	<?php if ($pokokrek_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $pokokrek_list->PageUrl() ?>start=<?php echo $pokokrek_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pokokrek_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $pokokrek_list->PageUrl() ?>start=<?php echo $pokokrek_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($pokokrek_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $pokokrek_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($pokokrek_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $pokokrek_list->PageUrl() ?>start=<?php echo $pokokrek_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pokokrek_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $pokokrek_list->PageUrl() ?>start=<?php echo $pokokrek_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pokokrek_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pokokrek_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pokokrek_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pokokrek_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($pokokrek_list->SearchWhere == "0=101") { ?>
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
<?php if ($pokokrek_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="pokokrek">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($pokokrek_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($pokokrek_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($pokokrek_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($pokokrek_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($pokokrek_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($pokokrek_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($pokokrek_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($pokokrek_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($pokokrek_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
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
<form name="fpokokreklist" id="fpokokreklist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="pokokrek">
<div id="gmp_pokokrek" class="ewGridMiddlePanel">
<?php if ($pokokrek_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pokokrek->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pokokrek_list->RenderListOptions();

// Render list options (header, left)
$pokokrek_list->ListOptions->Render("header", "left");
?>
<?php if ($pokokrek->kodePokok->Visible) { // kodePokok ?>
	<?php if ($pokokrek->SortUrl($pokokrek->kodePokok) == "") { ?>
		<td><?php echo $pokokrek->kodePokok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pokokrek->SortUrl($pokokrek->kodePokok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pokokrek->kodePokok->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pokokrek->kodePokok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pokokrek->kodePokok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pokokrek->namaPokok->Visible) { // namaPokok ?>
	<?php if ($pokokrek->SortUrl($pokokrek->namaPokok) == "") { ?>
		<td><?php echo $pokokrek->namaPokok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pokokrek->SortUrl($pokokrek->namaPokok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pokokrek->namaPokok->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pokokrek->namaPokok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pokokrek->namaPokok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pokokrek_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($pokokrek->ExportAll && $pokokrek->Export <> "") {
	$pokokrek_list->StopRec = $pokokrek_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pokokrek_list->TotalRecs > $pokokrek_list->StartRec + $pokokrek_list->DisplayRecs - 1)
		$pokokrek_list->StopRec = $pokokrek_list->StartRec + $pokokrek_list->DisplayRecs - 1;
	else
		$pokokrek_list->StopRec = $pokokrek_list->TotalRecs;
}
$pokokrek_list->RecCnt = $pokokrek_list->StartRec - 1;
if ($pokokrek_list->Recordset && !$pokokrek_list->Recordset->EOF) {
	$pokokrek_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $pokokrek_list->StartRec > 1)
		$pokokrek_list->Recordset->Move($pokokrek_list->StartRec - 1);
} elseif (!$pokokrek->AllowAddDeleteRow && $pokokrek_list->StopRec == 0) {
	$pokokrek_list->StopRec = $pokokrek->GridAddRowCount;
}

// Initialize aggregate
$pokokrek->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pokokrek->ResetAttrs();
$pokokrek_list->RenderRow();
$pokokrek_list->RowCnt = 0;
while ($pokokrek_list->RecCnt < $pokokrek_list->StopRec) {
	$pokokrek_list->RecCnt++;
	if (intval($pokokrek_list->RecCnt) >= intval($pokokrek_list->StartRec)) {
		$pokokrek_list->RowCnt++;

		// Set up key count
		$pokokrek_list->KeyCount = $pokokrek_list->RowIndex;

		// Init row class and style
		$pokokrek->ResetAttrs();
		$pokokrek->CssClass = "";
		if ($pokokrek->CurrentAction == "gridadd") {
		} else {
			$pokokrek_list->LoadRowValues($pokokrek_list->Recordset); // Load row values
		}
		$pokokrek->RowType = EW_ROWTYPE_VIEW; // Render view
		$pokokrek->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$pokokrek_list->RenderRow();

		// Render list options
		$pokokrek_list->RenderListOptions();
?>
	<tr<?php echo $pokokrek->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pokokrek_list->ListOptions->Render("body", "left");
?>
	<?php if ($pokokrek->kodePokok->Visible) { // kodePokok ?>
		<td<?php echo $pokokrek->kodePokok->CellAttributes() ?>>
<div<?php echo $pokokrek->kodePokok->ViewAttributes() ?>><?php echo $pokokrek->kodePokok->ListViewValue() ?></div>
<a name="<?php echo $pokokrek_list->PageObjName . "_row_" . $pokokrek_list->RowCnt ?>" id="<?php echo $pokokrek_list->PageObjName . "_row_" . $pokokrek_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($pokokrek->namaPokok->Visible) { // namaPokok ?>
		<td<?php echo $pokokrek->namaPokok->CellAttributes() ?>>
<div<?php echo $pokokrek->namaPokok->ViewAttributes() ?>><?php echo $pokokrek->namaPokok->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pokokrek_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($pokokrek->CurrentAction <> "gridadd")
		$pokokrek_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pokokrek_list->Recordset)
	$pokokrek_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($pokokrek->Export == "" && $pokokrek->CurrentAction == "") { ?>
<?php } ?>
<?php
$pokokrek_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pokokrek->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pokokrek_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpokokrek_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'pokokrek';

	// Page object name
	var $PageObjName = 'pokokrek_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pokokrek;
		if ($pokokrek->UseTokenInUrl) $PageUrl .= "t=" . $pokokrek->TableVar . "&"; // Add page token
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
		global $objForm, $pokokrek;
		if ($pokokrek->UseTokenInUrl) {
			if ($objForm)
				return ($pokokrek->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pokokrek->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpokokrek_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pokokrek)
		if (!isset($GLOBALS["pokokrek"])) {
			$GLOBALS["pokokrek"] = new cpokokrek();
			$GLOBALS["Table"] =& $GLOBALS["pokokrek"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "pokokrekadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pokokrekdelete.php";
		$this->MultiUpdateUrl = "pokokrekupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pokokrek', TRUE);

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
		global $pokokrek;

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
			$pokokrek->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $pokokrek;

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
			if ($pokokrek->Export <> "" ||
				$pokokrek->CurrentAction == "gridadd" ||
				$pokokrek->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$pokokrek->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($pokokrek->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $pokokrek->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$pokokrek->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$pokokrek->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$pokokrek->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $pokokrek->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$pokokrek->setSessionWhere($sFilter);
		$pokokrek->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $pokokrek;
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
			$pokokrek->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$pokokrek->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $pokokrek;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $pokokrek->kodePokok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pokokrek->namaPokok, $Keyword);
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
		global $Security, $pokokrek;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $pokokrek->BasicSearchKeyword;
		$sSearchType = $pokokrek->BasicSearchType;
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
			$pokokrek->setSessionBasicSearchKeyword($sSearchKeyword);
			$pokokrek->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $pokokrek;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$pokokrek->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $pokokrek;
		$pokokrek->setSessionBasicSearchKeyword("");
		$pokokrek->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $pokokrek;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$pokokrek->BasicSearchKeyword = $pokokrek->getSessionBasicSearchKeyword();
			$pokokrek->BasicSearchType = $pokokrek->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pokokrek;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pokokrek->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pokokrek->CurrentOrderType = @$_GET["ordertype"];
			$pokokrek->UpdateSort($pokokrek->kodePokok); // kodePokok
			$pokokrek->UpdateSort($pokokrek->namaPokok); // namaPokok
			$pokokrek->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $pokokrek;
		$sOrderBy = $pokokrek->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($pokokrek->SqlOrderBy() <> "") {
				$sOrderBy = $pokokrek->SqlOrderBy();
				$pokokrek->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $pokokrek;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$pokokrek->setSessionOrderBy($sOrderBy);
				$pokokrek->kodePokok->setSort("");
				$pokokrek->namaPokok->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$pokokrek->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $pokokrek;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $pokokrek, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $pokokrek;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pokokrek;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$pokokrek->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$pokokrek->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $pokokrek->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$pokokrek->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$pokokrek->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$pokokrek->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $pokokrek;
		$pokokrek->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$pokokrek->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pokokrek;

		// Call Recordset Selecting event
		$pokokrek->Recordset_Selecting($pokokrek->CurrentFilter);

		// Load List page SQL
		$sSql = $pokokrek->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pokokrek->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pokokrek;
		$sFilter = $pokokrek->KeyFilter();

		// Call Row Selecting event
		$pokokrek->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pokokrek->CurrentFilter = $sFilter;
		$sSql = $pokokrek->SQL();
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
		global $conn, $pokokrek;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pokokrek->Row_Selected($row);
		$pokokrek->kodePokok->setDbValue($rs->fields('kodePokok'));
		$pokokrek->namaPokok->setDbValue($rs->fields('namaPokok'));
	}

	// Load old record
	function LoadOldRecord() {
		global $pokokrek;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pokokrek->getKey("kodePokok")) <> "")
			$pokokrek->kodePokok->CurrentValue = $pokokrek->getKey("kodePokok"); // kodePokok
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pokokrek->CurrentFilter = $pokokrek->KeyFilter();
			$sSql = $pokokrek->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pokokrek;

		// Initialize URLs
		$this->ViewUrl = $pokokrek->ViewUrl();
		$this->EditUrl = $pokokrek->EditUrl();
		$this->InlineEditUrl = $pokokrek->InlineEditUrl();
		$this->CopyUrl = $pokokrek->CopyUrl();
		$this->InlineCopyUrl = $pokokrek->InlineCopyUrl();
		$this->DeleteUrl = $pokokrek->DeleteUrl();

		// Call Row_Rendering event
		$pokokrek->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// namaPokok

		if ($pokokrek->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			$pokokrek->kodePokok->ViewValue = $pokokrek->kodePokok->CurrentValue;
			$pokokrek->kodePokok->ViewCustomAttributes = "";

			// namaPokok
			$pokokrek->namaPokok->ViewValue = $pokokrek->namaPokok->CurrentValue;
			$pokokrek->namaPokok->ViewCustomAttributes = "";

			// kodePokok
			$pokokrek->kodePokok->LinkCustomAttributes = "";
			$pokokrek->kodePokok->HrefValue = "";
			$pokokrek->kodePokok->TooltipValue = "";

			// namaPokok
			$pokokrek->namaPokok->LinkCustomAttributes = "";
			$pokokrek->namaPokok->HrefValue = "";
			$pokokrek->namaPokok->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pokokrek->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pokokrek->Row_Rendered();
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

<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "view_peserta2info.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$view_peserta2_list = new cview_peserta2_list();
$Page =& $view_peserta2_list;

// Page init
$view_peserta2_list->Page_Init();

// Page main
$view_peserta2_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($view_peserta2->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var view_peserta2_list = new ew_Page("view_peserta2_list");

// page properties
view_peserta2_list.PageID = "list"; // page ID
view_peserta2_list.FormID = "fview_peserta2list"; // form ID
var EW_PAGE_ID = view_peserta2_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
view_peserta2_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
view_peserta2_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
view_peserta2_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
view_peserta2_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($view_peserta2->Export == "") || (EW_EXPORT_MASTER_RECORD && $view_peserta2->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$view_peserta2_list->TotalRecs = $view_peserta2->SelectRecordCount();
	} else {
		if ($view_peserta2_list->Recordset = $view_peserta2_list->LoadRecordset())
			$view_peserta2_list->TotalRecs = $view_peserta2_list->Recordset->RecordCount();
	}
	$view_peserta2_list->StartRec = 1;
	if ($view_peserta2_list->DisplayRecs <= 0 || ($view_peserta2->Export <> "" && $view_peserta2->ExportAll)) // Display all records
		$view_peserta2_list->DisplayRecs = $view_peserta2_list->TotalRecs;
	if (!($view_peserta2->Export <> "" && $view_peserta2->ExportAll))
		$view_peserta2_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$view_peserta2_list->Recordset = $view_peserta2_list->LoadRecordset($view_peserta2_list->StartRec-1, $view_peserta2_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $view_peserta2->TableCaption() ?>
&nbsp;&nbsp;<?php $view_peserta2_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($view_peserta2->Export == "" && $view_peserta2->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(view_peserta2_list);" style="text-decoration: none;"><img id="view_peserta2_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="view_peserta2_list_SearchPanel">
<form name="fview_peserta2listsrch" id="fview_peserta2listsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="view_peserta2">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($view_peserta2->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $view_peserta2_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
	<a href="view_peserta2srch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($view_peserta2->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($view_peserta2->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($view_peserta2->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $view_peserta2_list->ShowPageHeader(); ?>
<?php
$view_peserta2_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($view_peserta2->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($view_peserta2->CurrentAction <> "gridadd" && $view_peserta2->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($view_peserta2_list->Pager)) $view_peserta2_list->Pager = new cNumericPager($view_peserta2_list->StartRec, $view_peserta2_list->DisplayRecs, $view_peserta2_list->TotalRecs, $view_peserta2_list->RecRange) ?>
<?php if ($view_peserta2_list->Pager->RecordCount > 0) { ?>
	<?php if ($view_peserta2_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $view_peserta2_list->PageUrl() ?>start=<?php echo $view_peserta2_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($view_peserta2_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $view_peserta2_list->PageUrl() ?>start=<?php echo $view_peserta2_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($view_peserta2_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $view_peserta2_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($view_peserta2_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $view_peserta2_list->PageUrl() ?>start=<?php echo $view_peserta2_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($view_peserta2_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $view_peserta2_list->PageUrl() ?>start=<?php echo $view_peserta2_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($view_peserta2_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $view_peserta2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $view_peserta2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $view_peserta2_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($view_peserta2_list->SearchWhere == "0=101") { ?>
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
<?php if ($view_peserta2_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="view_peserta2">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($view_peserta2_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($view_peserta2_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($view_peserta2_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($view_peserta2_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($view_peserta2_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($view_peserta2_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($view_peserta2_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($view_peserta2_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($view_peserta2_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($view_peserta2->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($view_peserta2_list->TotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fview_peserta2list, '<?php echo $view_peserta2_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fview_peserta2list" id="fview_peserta2list" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="view_peserta2">
<div id="gmp_view_peserta2" class="ewGridMiddlePanel">
<?php if ($view_peserta2_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $view_peserta2->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$view_peserta2_list->RenderListOptions();

// Render list options (header, left)
$view_peserta2_list->ListOptions->Render("header", "left");
?>
<?php if ($view_peserta2->A_nama_Lengkap->Visible) { // A_nama_Lengkap ?>
	<?php if ($view_peserta2->SortUrl($view_peserta2->A_nama_Lengkap) == "") { ?>
		<td><?php echo $view_peserta2->A_nama_Lengkap->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_peserta2->SortUrl($view_peserta2->A_nama_Lengkap) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_peserta2->A_nama_Lengkap->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_peserta2->A_nama_Lengkap->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_peserta2->A_nama_Lengkap->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_peserta2->A_nis_nasional->Visible) { // A_nis_nasional ?>
	<?php if ($view_peserta2->SortUrl($view_peserta2->A_nis_nasional) == "") { ?>
		<td><?php echo $view_peserta2->A_nis_nasional->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_peserta2->SortUrl($view_peserta2->A_nis_nasional) ?>',2);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_peserta2->A_nis_nasional->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_peserta2->A_nis_nasional->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_peserta2->A_nis_nasional->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$view_peserta2_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($view_peserta2->ExportAll && $view_peserta2->Export <> "") {
	$view_peserta2_list->StopRec = $view_peserta2_list->TotalRecs;
} else {

	// Set the last record to display
	if ($view_peserta2_list->TotalRecs > $view_peserta2_list->StartRec + $view_peserta2_list->DisplayRecs - 1)
		$view_peserta2_list->StopRec = $view_peserta2_list->StartRec + $view_peserta2_list->DisplayRecs - 1;
	else
		$view_peserta2_list->StopRec = $view_peserta2_list->TotalRecs;
}
$view_peserta2_list->RecCnt = $view_peserta2_list->StartRec - 1;
if ($view_peserta2_list->Recordset && !$view_peserta2_list->Recordset->EOF) {
	$view_peserta2_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $view_peserta2_list->StartRec > 1)
		$view_peserta2_list->Recordset->Move($view_peserta2_list->StartRec - 1);
} elseif (!$view_peserta2->AllowAddDeleteRow && $view_peserta2_list->StopRec == 0) {
	$view_peserta2_list->StopRec = $view_peserta2->GridAddRowCount;
}

// Initialize aggregate
$view_peserta2->RowType = EW_ROWTYPE_AGGREGATEINIT;
$view_peserta2->ResetAttrs();
$view_peserta2_list->RenderRow();
$view_peserta2_list->RowCnt = 0;
while ($view_peserta2_list->RecCnt < $view_peserta2_list->StopRec) {
	$view_peserta2_list->RecCnt++;
	if (intval($view_peserta2_list->RecCnt) >= intval($view_peserta2_list->StartRec)) {
		$view_peserta2_list->RowCnt++;

		// Set up key count
		$view_peserta2_list->KeyCount = $view_peserta2_list->RowIndex;

		// Init row class and style
		$view_peserta2->ResetAttrs();
		$view_peserta2->CssClass = "";
		if ($view_peserta2->CurrentAction == "gridadd") {
		} else {
			$view_peserta2_list->LoadRowValues($view_peserta2_list->Recordset); // Load row values
		}
		$view_peserta2->RowType = EW_ROWTYPE_VIEW; // Render view
		$view_peserta2->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$view_peserta2_list->RenderRow();

		// Render list options
		$view_peserta2_list->RenderListOptions();
?>
	<tr<?php echo $view_peserta2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$view_peserta2_list->ListOptions->Render("body", "left");
?>
	<?php if ($view_peserta2->A_nama_Lengkap->Visible) { // A_nama_Lengkap ?>
		<td<?php echo $view_peserta2->A_nama_Lengkap->CellAttributes() ?>>
<div<?php echo $view_peserta2->A_nama_Lengkap->ViewAttributes() ?>><?php echo $view_peserta2->A_nama_Lengkap->ListViewValue() ?></div>
<a name="<?php echo $view_peserta2_list->PageObjName . "_row_" . $view_peserta2_list->RowCnt ?>" id="<?php echo $view_peserta2_list->PageObjName . "_row_" . $view_peserta2_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($view_peserta2->A_nis_nasional->Visible) { // A_nis_nasional ?>
		<td<?php echo $view_peserta2->A_nis_nasional->CellAttributes() ?>>
<div<?php echo $view_peserta2->A_nis_nasional->ViewAttributes() ?>><?php echo $view_peserta2->A_nis_nasional->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_peserta2_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($view_peserta2->CurrentAction <> "gridadd")
		$view_peserta2_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($view_peserta2_list->Recordset)
	$view_peserta2_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($view_peserta2->Export == "" && $view_peserta2->CurrentAction == "") { ?>
<?php } ?>
<?php
$view_peserta2_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($view_peserta2->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$view_peserta2_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cview_peserta2_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'view_peserta2';

	// Page object name
	var $PageObjName = 'view_peserta2_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $view_peserta2;
		if ($view_peserta2->UseTokenInUrl) $PageUrl .= "t=" . $view_peserta2->TableVar . "&"; // Add page token
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
		global $objForm, $view_peserta2;
		if ($view_peserta2->UseTokenInUrl) {
			if ($objForm)
				return ($view_peserta2->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($view_peserta2->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cview_peserta2_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (view_peserta2)
		if (!isset($GLOBALS["view_peserta2"])) {
			$GLOBALS["view_peserta2"] = new cview_peserta2();
			$GLOBALS["Table"] =& $GLOBALS["view_peserta2"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "view_peserta2add.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "view_peserta2delete.php";
		$this->MultiUpdateUrl = "view_peserta2update.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view_peserta2', TRUE);

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
		global $view_peserta2;

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
			$view_peserta2->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $view_peserta2;

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
			if ($view_peserta2->Export <> "" ||
				$view_peserta2->CurrentAction == "gridadd" ||
				$view_peserta2->CurrentAction == "gridedit") {
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
			$view_peserta2->Recordset_SearchValidated();

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
		if ($view_peserta2->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $view_peserta2->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$view_peserta2->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$view_peserta2->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$view_peserta2->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $view_peserta2->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$view_peserta2->setSessionWhere($sFilter);
		$view_peserta2->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $view_peserta2;
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
			$view_peserta2->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$view_peserta2->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $view_peserta2;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $view_peserta2->A_nama_Lengkap, FALSE); // A_nama_Lengkap
		$this->BuildSearchSql($sWhere, $view_peserta2->A_nis_nasional, FALSE); // A_nis_nasional

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($view_peserta2->A_nama_Lengkap); // A_nama_Lengkap
			$this->SetSearchParm($view_peserta2->A_nis_nasional); // A_nis_nasional
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
		global $view_peserta2;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$view_peserta2->setAdvancedSearch("x_$FldParm", $FldVal);
		$view_peserta2->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$view_peserta2->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$view_peserta2->setAdvancedSearch("y_$FldParm", $FldVal2);
		$view_peserta2->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $view_peserta2;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $view_peserta2->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $view_peserta2->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $view_peserta2->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $view_peserta2->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $view_peserta2->getAdvancedSearch("w_$FldParm");
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
		global $view_peserta2;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $view_peserta2->A_nama_Lengkap, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_peserta2->A_nis_nasional, $Keyword);
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
		global $Security, $view_peserta2;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $view_peserta2->BasicSearchKeyword;
		$sSearchType = $view_peserta2->BasicSearchType;
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
			$view_peserta2->setSessionBasicSearchKeyword($sSearchKeyword);
			$view_peserta2->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $view_peserta2;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$view_peserta2->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $view_peserta2;
		$view_peserta2->setSessionBasicSearchKeyword("");
		$view_peserta2->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $view_peserta2;
		$view_peserta2->setAdvancedSearch("x_A_nama_Lengkap", "");
		$view_peserta2->setAdvancedSearch("z_A_nama_Lengkap", "");
		$view_peserta2->setAdvancedSearch("y_A_nama_Lengkap", "");
		$view_peserta2->setAdvancedSearch("x_A_nis_nasional", "");
		$view_peserta2->setAdvancedSearch("z_A_nis_nasional", "");
		$view_peserta2->setAdvancedSearch("y_A_nis_nasional", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $view_peserta2;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_nama_Lengkap"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_nama_Lengkap"] <> "") $bRestore = FALSE;
		if (@$_GET["x_A_nis_nasional"] <> "") $bRestore = FALSE;
		if (@$_GET["y_A_nis_nasional"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$view_peserta2->BasicSearchKeyword = $view_peserta2->getSessionBasicSearchKeyword();
			$view_peserta2->BasicSearchType = $view_peserta2->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($view_peserta2->A_nama_Lengkap);
			$this->GetSearchParm($view_peserta2->A_nis_nasional);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $view_peserta2;

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$view_peserta2->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$view_peserta2->CurrentOrderType = @$_GET["ordertype"];
			$view_peserta2->UpdateSort($view_peserta2->A_nama_Lengkap, $bCtrl); // A_nama_Lengkap
			$view_peserta2->UpdateSort($view_peserta2->A_nis_nasional, $bCtrl); // A_nis_nasional
			$view_peserta2->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $view_peserta2;
		$sOrderBy = $view_peserta2->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($view_peserta2->SqlOrderBy() <> "") {
				$sOrderBy = $view_peserta2->SqlOrderBy();
				$view_peserta2->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $view_peserta2;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$view_peserta2->setSessionOrderBy($sOrderBy);
				$view_peserta2->A_nama_Lengkap->setSort("");
				$view_peserta2->A_nis_nasional->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$view_peserta2->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $view_peserta2;

		// "checkbox"
		$item =& $this->ListOptions->Add("checkbox");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"view_peserta2_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $view_peserta2, $objForm;
		$this->ListOptions->LoadDefault();

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($view_peserta2->A_nama_Lengkap->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $view_peserta2;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $view_peserta2;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$view_peserta2->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$view_peserta2->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $view_peserta2->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$view_peserta2->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$view_peserta2->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$view_peserta2->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $view_peserta2;
		$view_peserta2->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$view_peserta2->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $view_peserta2;

		// Load search values
		// A_nama_Lengkap

		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_nama_Lengkap"]);
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator = @$_GET["z_A_nama_Lengkap"];
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchCondition = @$_GET["v_A_nama_Lengkap"];
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_nama_Lengkap"]);
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator2 = @$_GET["w_A_nama_Lengkap"];

		// A_nis_nasional
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_A_nis_nasional"]);
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator = @$_GET["z_A_nis_nasional"];
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchCondition = @$_GET["v_A_nis_nasional"];
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_A_nis_nasional"]);
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator2 = @$_GET["w_A_nis_nasional"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $view_peserta2;

		// Call Recordset Selecting event
		$view_peserta2->Recordset_Selecting($view_peserta2->CurrentFilter);

		// Load List page SQL
		$sSql = $view_peserta2->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$view_peserta2->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $view_peserta2;
		$sFilter = $view_peserta2->KeyFilter();

		// Call Row Selecting event
		$view_peserta2->Row_Selecting($sFilter);

		// Load SQL based on filter
		$view_peserta2->CurrentFilter = $sFilter;
		$sSql = $view_peserta2->SQL();
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
		global $conn, $view_peserta2;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$view_peserta2->Row_Selected($row);
		$view_peserta2->A_nama_Lengkap->setDbValue($rs->fields('A_nama_Lengkap'));
		$view_peserta2->A_nis_nasional->setDbValue($rs->fields('A_nis_nasional'));
	}

	// Load old record
	function LoadOldRecord() {
		global $view_peserta2;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($view_peserta2->getKey("A_nama_Lengkap")) <> "")
			$view_peserta2->A_nama_Lengkap->CurrentValue = $view_peserta2->getKey("A_nama_Lengkap"); // A_nama_Lengkap
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$view_peserta2->CurrentFilter = $view_peserta2->KeyFilter();
			$sSql = $view_peserta2->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $view_peserta2;

		// Initialize URLs
		$this->ViewUrl = $view_peserta2->ViewUrl();
		$this->EditUrl = $view_peserta2->EditUrl();
		$this->InlineEditUrl = $view_peserta2->InlineEditUrl();
		$this->CopyUrl = $view_peserta2->CopyUrl();
		$this->InlineCopyUrl = $view_peserta2->InlineCopyUrl();
		$this->DeleteUrl = $view_peserta2->DeleteUrl();

		// Call Row_Rendering event
		$view_peserta2->Row_Rendering();

		// Common render codes for all row types
		// A_nama_Lengkap
		// A_nis_nasional

		if ($view_peserta2->RowType == EW_ROWTYPE_VIEW) { // View row

			// A_nama_Lengkap
			$view_peserta2->A_nama_Lengkap->ViewValue = $view_peserta2->A_nama_Lengkap->CurrentValue;
			$view_peserta2->A_nama_Lengkap->ViewCustomAttributes = "";

			// A_nis_nasional
			$view_peserta2->A_nis_nasional->ViewValue = $view_peserta2->A_nis_nasional->CurrentValue;
			$view_peserta2->A_nis_nasional->ViewCustomAttributes = "";

			// A_nama_Lengkap
			$view_peserta2->A_nama_Lengkap->LinkCustomAttributes = "";
			$view_peserta2->A_nama_Lengkap->HrefValue = "";
			$view_peserta2->A_nama_Lengkap->TooltipValue = "";

			// A_nis_nasional
			$view_peserta2->A_nis_nasional->LinkCustomAttributes = "";
			$view_peserta2->A_nis_nasional->HrefValue = "";
			$view_peserta2->A_nis_nasional->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($view_peserta2->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$view_peserta2->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $view_peserta2;

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
		global $view_peserta2;
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchValue = $view_peserta2->getAdvancedSearch("x_A_nama_Lengkap");
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchOperator = $view_peserta2->getAdvancedSearch("z_A_nama_Lengkap");
		$view_peserta2->A_nama_Lengkap->AdvancedSearch->SearchValue2 = $view_peserta2->getAdvancedSearch("y_A_nama_Lengkap");
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchValue = $view_peserta2->getAdvancedSearch("x_A_nis_nasional");
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchOperator = $view_peserta2->getAdvancedSearch("z_A_nis_nasional");
		$view_peserta2->A_nis_nasional->AdvancedSearch->SearchValue2 = $view_peserta2->getAdvancedSearch("y_A_nis_nasional");
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
	}

		// Page Load event                             
	function Page_Load() {  
		if ($_SESSION['kode_otomatis_kelompok']==NULL)       
		{                                                          
			header("Location: pemilihan_kelasadd.php");
		}                                                             
		global $Language;
		$Language->setPhrase("deletesuccess","");   
		$Language->setPhrase("Add",""); 
		$judul="Silahkan Anda Pilih Siswa Yang Akan Dientri Ke Dalam Kelas 
			Kelompok <FONT COLOR=#0000FF>" . $_SESSION["nama_kelas"] . "</FONT><BR>"  ;
		$Language->setPhrase("DeleteSelectedLink","PILIH SISWA");      
		$Language->setPhrase("ShowAll",""); 
		$Language->setTablePhrase(CurrentTable()->TableName, "TblCaption", $judul);
		$item =& $this->ExportOptions->Add("Reset");
		$item->Body = "<a href=view_peserta2list.php?cmd=resetall>Reset Pencarian</a>";            
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
		if ($type == 'success') $msg = "";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

		// Page Data Rendered event
	function Page_DataRendered(&$footer) { 

		//echo "aaa:  " . $_SESSION['array_siswa2'][0];  
		if ($_SESSION['array_siswa2'][0] != NULL )
		 {

				//echo  'Nilai: ' . $_SESSION['array_siswa'][0];
				//echo  'Jumlah: ' . count($_SESSION['array_siswa']) ;

				global $conn;    
				$conn->BeginTrans();
				$i=0;
				$katasql='';
				$tanda_salah=FALSE;             

				/*
				$connection = mysql_connect('localhost', 'root', '') 
					or die ("ERROR: Cannot connect");

					// select database          
				*/       
				for($i=0;$i<count($_SESSION['array_siswa2']);$i++)
				{           
						$katasql="INSERT INTO st_peserta_kelas_kelompok(kode_otomatis,kode_otomatis_kelompok,identitas) " . 
							" VALUES('" . unik() . "','" .  $_SESSION["kode_otomatis_kelompok"] . "','" . 
							 $_SESSION['array_siswa2'][$i] . "') ";
						$rs=$conn->Execute($katasql);  
						$conn->raiseErrorFn = ''; 
						if ($rs == FALSE) 
						{      
							echo "Terdapat Kesalahan";
							$conn->RollBackTrans();
							$_SESSION['array_siswa']=array();
							unset($_SESSION['array_siswa']);
							$tanda_salah=TRUE;
							break;
						}    
					$_SESSION['array_siswa2'][$i]="" ;  
				}    // dari for($i=0;$i<count($_SESSION['array_siswa']);$i++)
				if ($tanda_salah==FALSE )
				{
					$conn->CommitTrans(); 
					$_SESSION['array_siswa2']=array();       
					unset($_SESSION['array_siswa2']); 
					$pesan=$_GET["pesan"];
					if (trim($pesan) !== "")
					{
						echo "<font color=#0000FF><strong>Entri Kelompok Berhasil Dilakukan .... </font></strong>" ;
					}
					header("Location: view_peserta2list.php?pesan=Data_Berhasil_Dientri...");  
				}
			}
			else
			{
			}                                                                
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

<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subsaturekinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subsaturek_list = new csubsaturek_list();
$Page =& $subsaturek_list;

// Page init
$subsaturek_list->Page_Init();

// Page main
$subsaturek_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($subsaturek->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subsaturek_list = new ew_Page("subsaturek_list");

// page properties
subsaturek_list.PageID = "list"; // page ID
subsaturek_list.FormID = "fsubsatureklist"; // form ID
var EW_PAGE_ID = subsaturek_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subsaturek_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
subsaturek_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subsaturek_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($subsaturek->Export == "") || (EW_EXPORT_MASTER_RECORD && $subsaturek->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$subsaturek_list->TotalRecs = $subsaturek->SelectRecordCount();
	} else {
		if ($subsaturek_list->Recordset = $subsaturek_list->LoadRecordset())
			$subsaturek_list->TotalRecs = $subsaturek_list->Recordset->RecordCount();
	}
	$subsaturek_list->StartRec = 1;
	if ($subsaturek_list->DisplayRecs <= 0 || ($subsaturek->Export <> "" && $subsaturek->ExportAll)) // Display all records
		$subsaturek_list->DisplayRecs = $subsaturek_list->TotalRecs;
	if (!($subsaturek->Export <> "" && $subsaturek->ExportAll))
		$subsaturek_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$subsaturek_list->Recordset = $subsaturek_list->LoadRecordset($subsaturek_list->StartRec-1, $subsaturek_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subsaturek->TableCaption() ?>
&nbsp;&nbsp;<?php $subsaturek_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($subsaturek->Export == "" && $subsaturek->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(subsaturek_list);" style="text-decoration: none;"><img id="subsaturek_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="subsaturek_list_SearchPanel">
<form name="fsubsatureklistsrch" id="fsubsatureklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="subsaturek">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($subsaturek->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $subsaturek_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($subsaturek->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($subsaturek->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($subsaturek->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $subsaturek_list->ShowPageHeader(); ?>
<?php
$subsaturek_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($subsaturek->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($subsaturek->CurrentAction <> "gridadd" && $subsaturek->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($subsaturek_list->Pager)) $subsaturek_list->Pager = new cNumericPager($subsaturek_list->StartRec, $subsaturek_list->DisplayRecs, $subsaturek_list->TotalRecs, $subsaturek_list->RecRange) ?>
<?php if ($subsaturek_list->Pager->RecordCount > 0) { ?>
	<?php if ($subsaturek_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $subsaturek_list->PageUrl() ?>start=<?php echo $subsaturek_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($subsaturek_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $subsaturek_list->PageUrl() ?>start=<?php echo $subsaturek_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($subsaturek_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $subsaturek_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($subsaturek_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $subsaturek_list->PageUrl() ?>start=<?php echo $subsaturek_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($subsaturek_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $subsaturek_list->PageUrl() ?>start=<?php echo $subsaturek_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($subsaturek_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subsaturek_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subsaturek_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subsaturek_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($subsaturek_list->SearchWhere == "0=101") { ?>
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
<?php if ($subsaturek_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subsaturek">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($subsaturek_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($subsaturek_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($subsaturek_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($subsaturek_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subsaturek_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($subsaturek_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($subsaturek_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($subsaturek_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($subsaturek_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $subsaturek_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fsubsatureklist" id="fsubsatureklist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="subsaturek">
<div id="gmp_subsaturek" class="ewGridMiddlePanel">
<?php if ($subsaturek_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $subsaturek->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$subsaturek_list->RenderListOptions();

// Render list options (header, left)
$subsaturek_list->ListOptions->Render("header", "left");
?>
<?php if ($subsaturek->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<?php if ($subsaturek->SortUrl($subsaturek->kodeSubSatu) == "") { ?>
		<td><?php echo $subsaturek->kodeSubSatu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subsaturek->SortUrl($subsaturek->kodeSubSatu) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subsaturek->kodeSubSatu->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subsaturek->kodeSubSatu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subsaturek->kodeSubSatu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subsaturek->namaSubSatu->Visible) { // namaSubSatu ?>
	<?php if ($subsaturek->SortUrl($subsaturek->namaSubSatu) == "") { ?>
		<td><?php echo $subsaturek->namaSubSatu->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subsaturek->SortUrl($subsaturek->namaSubSatu) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subsaturek->namaSubSatu->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subsaturek->namaSubSatu->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subsaturek->namaSubSatu->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subsaturek->kodePokok->Visible) { // kodePokok ?>
	<?php if ($subsaturek->SortUrl($subsaturek->kodePokok) == "") { ?>
		<td><?php echo $subsaturek->kodePokok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subsaturek->SortUrl($subsaturek->kodePokok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subsaturek->kodePokok->FldCaption() ?></td><td style="width: 10px;"><?php if ($subsaturek->kodePokok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subsaturek->kodePokok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subsaturek->id->Visible) { // id ?>
	<?php if ($subsaturek->SortUrl($subsaturek->id) == "") { ?>
		<td><?php echo $subsaturek->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subsaturek->SortUrl($subsaturek->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subsaturek->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($subsaturek->id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subsaturek->id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$subsaturek_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($subsaturek->ExportAll && $subsaturek->Export <> "") {
	$subsaturek_list->StopRec = $subsaturek_list->TotalRecs;
} else {

	// Set the last record to display
	if ($subsaturek_list->TotalRecs > $subsaturek_list->StartRec + $subsaturek_list->DisplayRecs - 1)
		$subsaturek_list->StopRec = $subsaturek_list->StartRec + $subsaturek_list->DisplayRecs - 1;
	else
		$subsaturek_list->StopRec = $subsaturek_list->TotalRecs;
}
$subsaturek_list->RecCnt = $subsaturek_list->StartRec - 1;
if ($subsaturek_list->Recordset && !$subsaturek_list->Recordset->EOF) {
	$subsaturek_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $subsaturek_list->StartRec > 1)
		$subsaturek_list->Recordset->Move($subsaturek_list->StartRec - 1);
} elseif (!$subsaturek->AllowAddDeleteRow && $subsaturek_list->StopRec == 0) {
	$subsaturek_list->StopRec = $subsaturek->GridAddRowCount;
}

// Initialize aggregate
$subsaturek->RowType = EW_ROWTYPE_AGGREGATEINIT;
$subsaturek->ResetAttrs();
$subsaturek_list->RenderRow();
$subsaturek_list->RowCnt = 0;
while ($subsaturek_list->RecCnt < $subsaturek_list->StopRec) {
	$subsaturek_list->RecCnt++;
	if (intval($subsaturek_list->RecCnt) >= intval($subsaturek_list->StartRec)) {
		$subsaturek_list->RowCnt++;

		// Set up key count
		$subsaturek_list->KeyCount = $subsaturek_list->RowIndex;

		// Init row class and style
		$subsaturek->ResetAttrs();
		$subsaturek->CssClass = "";
		if ($subsaturek->CurrentAction == "gridadd") {
		} else {
			$subsaturek_list->LoadRowValues($subsaturek_list->Recordset); // Load row values
		}
		$subsaturek->RowType = EW_ROWTYPE_VIEW; // Render view
		$subsaturek->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$subsaturek_list->RenderRow();

		// Render list options
		$subsaturek_list->RenderListOptions();
?>
	<tr<?php echo $subsaturek->RowAttributes() ?>>
<?php

// Render list options (body, left)
$subsaturek_list->ListOptions->Render("body", "left");
?>
	<?php if ($subsaturek->kodeSubSatu->Visible) { // kodeSubSatu ?>
		<td<?php echo $subsaturek->kodeSubSatu->CellAttributes() ?>>
<div<?php echo $subsaturek->kodeSubSatu->ViewAttributes() ?>><?php echo $subsaturek->kodeSubSatu->ListViewValue() ?></div>
<a name="<?php echo $subsaturek_list->PageObjName . "_row_" . $subsaturek_list->RowCnt ?>" id="<?php echo $subsaturek_list->PageObjName . "_row_" . $subsaturek_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($subsaturek->namaSubSatu->Visible) { // namaSubSatu ?>
		<td<?php echo $subsaturek->namaSubSatu->CellAttributes() ?>>
<div<?php echo $subsaturek->namaSubSatu->ViewAttributes() ?>><?php echo $subsaturek->namaSubSatu->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subsaturek->kodePokok->Visible) { // kodePokok ?>
		<td<?php echo $subsaturek->kodePokok->CellAttributes() ?>>
<div<?php echo $subsaturek->kodePokok->ViewAttributes() ?>><?php echo $subsaturek->kodePokok->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subsaturek->id->Visible) { // id ?>
		<td<?php echo $subsaturek->id->CellAttributes() ?>>
<div<?php echo $subsaturek->id->ViewAttributes() ?>><?php echo $subsaturek->id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subsaturek_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($subsaturek->CurrentAction <> "gridadd")
		$subsaturek_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($subsaturek_list->Recordset)
	$subsaturek_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($subsaturek->Export == "" && $subsaturek->CurrentAction == "") { ?>
<?php } ?>
<?php
$subsaturek_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($subsaturek->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$subsaturek_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csubsaturek_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'subsaturek';

	// Page object name
	var $PageObjName = 'subsaturek_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subsaturek;
		if ($subsaturek->UseTokenInUrl) $PageUrl .= "t=" . $subsaturek->TableVar . "&"; // Add page token
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
		global $objForm, $subsaturek;
		if ($subsaturek->UseTokenInUrl) {
			if ($objForm)
				return ($subsaturek->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subsaturek->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubsaturek_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subsaturek)
		if (!isset($GLOBALS["subsaturek"])) {
			$GLOBALS["subsaturek"] = new csubsaturek();
			$GLOBALS["Table"] =& $GLOBALS["subsaturek"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "subsaturekadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "subsaturekdelete.php";
		$this->MultiUpdateUrl = "subsaturekupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subsaturek', TRUE);

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
		global $subsaturek;

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
			$subsaturek->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $subsaturek;

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
			if ($subsaturek->Export <> "" ||
				$subsaturek->CurrentAction == "gridadd" ||
				$subsaturek->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$subsaturek->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($subsaturek->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $subsaturek->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$subsaturek->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$subsaturek->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$subsaturek->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $subsaturek->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$subsaturek->setSessionWhere($sFilter);
		$subsaturek->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $subsaturek;
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
			$subsaturek->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$subsaturek->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $subsaturek;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $subsaturek->kodeSubSatu, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subsaturek->namaSubSatu, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subsaturek->kodePokok, $Keyword);
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
		global $Security, $subsaturek;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $subsaturek->BasicSearchKeyword;
		$sSearchType = $subsaturek->BasicSearchType;
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
			$subsaturek->setSessionBasicSearchKeyword($sSearchKeyword);
			$subsaturek->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $subsaturek;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$subsaturek->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $subsaturek;
		$subsaturek->setSessionBasicSearchKeyword("");
		$subsaturek->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $subsaturek;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$subsaturek->BasicSearchKeyword = $subsaturek->getSessionBasicSearchKeyword();
			$subsaturek->BasicSearchType = $subsaturek->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $subsaturek;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$subsaturek->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$subsaturek->CurrentOrderType = @$_GET["ordertype"];
			$subsaturek->UpdateSort($subsaturek->kodeSubSatu); // kodeSubSatu
			$subsaturek->UpdateSort($subsaturek->namaSubSatu); // namaSubSatu
			$subsaturek->UpdateSort($subsaturek->kodePokok); // kodePokok
			$subsaturek->UpdateSort($subsaturek->id); // id
			$subsaturek->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $subsaturek;
		$sOrderBy = $subsaturek->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($subsaturek->SqlOrderBy() <> "") {
				$sOrderBy = $subsaturek->SqlOrderBy();
				$subsaturek->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $subsaturek;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$subsaturek->setSessionOrderBy($sOrderBy);
				$subsaturek->kodeSubSatu->setSort("");
				$subsaturek->namaSubSatu->setSort("");
				$subsaturek->kodePokok->setSort("");
				$subsaturek->id->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$subsaturek->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $subsaturek;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $subsaturek, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $subsaturek;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subsaturek;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$subsaturek->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$subsaturek->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $subsaturek->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$subsaturek->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$subsaturek->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$subsaturek->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $subsaturek;
		$subsaturek->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$subsaturek->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subsaturek;

		// Call Recordset Selecting event
		$subsaturek->Recordset_Selecting($subsaturek->CurrentFilter);

		// Load List page SQL
		$sSql = $subsaturek->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subsaturek->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subsaturek;
		$sFilter = $subsaturek->KeyFilter();

		// Call Row Selecting event
		$subsaturek->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subsaturek->CurrentFilter = $sFilter;
		$sSql = $subsaturek->SQL();
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
		global $conn, $subsaturek;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subsaturek->Row_Selected($row);
		$subsaturek->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$subsaturek->namaSubSatu->setDbValue($rs->fields('namaSubSatu'));
		$subsaturek->kodePokok->setDbValue($rs->fields('kodePokok'));
		$subsaturek->id->setDbValue($rs->fields('id'));
	}

	// Load old record
	function LoadOldRecord() {
		global $subsaturek;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($subsaturek->getKey("id")) <> "")
			$subsaturek->id->CurrentValue = $subsaturek->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$subsaturek->CurrentFilter = $subsaturek->KeyFilter();
			$sSql = $subsaturek->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subsaturek;

		// Initialize URLs
		$this->ViewUrl = $subsaturek->ViewUrl();
		$this->EditUrl = $subsaturek->EditUrl();
		$this->InlineEditUrl = $subsaturek->InlineEditUrl();
		$this->CopyUrl = $subsaturek->CopyUrl();
		$this->InlineCopyUrl = $subsaturek->InlineCopyUrl();
		$this->DeleteUrl = $subsaturek->DeleteUrl();

		// Call Row_Rendering event
		$subsaturek->Row_Rendering();

		// Common render codes for all row types
		// kodeSubSatu
		// namaSubSatu
		// kodePokok
		// id

		if ($subsaturek->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodeSubSatu
			$subsaturek->kodeSubSatu->ViewValue = $subsaturek->kodeSubSatu->CurrentValue;
			$subsaturek->kodeSubSatu->ViewCustomAttributes = "";

			// namaSubSatu
			$subsaturek->namaSubSatu->ViewValue = $subsaturek->namaSubSatu->CurrentValue;
			$subsaturek->namaSubSatu->ViewCustomAttributes = "";

			// kodePokok
			$subsaturek->kodePokok->ViewValue = $subsaturek->kodePokok->CurrentValue;
			$subsaturek->kodePokok->ViewCustomAttributes = "";

			// id
			$subsaturek->id->ViewValue = $subsaturek->id->CurrentValue;
			$subsaturek->id->ViewCustomAttributes = "";

			// kodeSubSatu
			$subsaturek->kodeSubSatu->LinkCustomAttributes = "";
			$subsaturek->kodeSubSatu->HrefValue = "";
			$subsaturek->kodeSubSatu->TooltipValue = "";

			// namaSubSatu
			$subsaturek->namaSubSatu->LinkCustomAttributes = "";
			$subsaturek->namaSubSatu->HrefValue = "";
			$subsaturek->namaSubSatu->TooltipValue = "";

			// kodePokok
			$subsaturek->kodePokok->LinkCustomAttributes = "";
			$subsaturek->kodePokok->HrefValue = "";
			$subsaturek->kodePokok->TooltipValue = "";

			// id
			$subsaturek->id->LinkCustomAttributes = "";
			$subsaturek->id->HrefValue = "";
			$subsaturek->id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subsaturek->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subsaturek->Row_Rendered();
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

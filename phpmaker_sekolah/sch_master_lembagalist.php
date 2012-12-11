<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "sch_master_lembagainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$sch_master_lembaga_list = new csch_master_lembaga_list();
$Page =& $sch_master_lembaga_list;

// Page init
$sch_master_lembaga_list->Page_Init();

// Page main
$sch_master_lembaga_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($sch_master_lembaga->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var sch_master_lembaga_list = new ew_Page("sch_master_lembaga_list");

// page properties
sch_master_lembaga_list.PageID = "list"; // page ID
sch_master_lembaga_list.FormID = "fsch_master_lembagalist"; // form ID
var EW_PAGE_ID = sch_master_lembaga_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
sch_master_lembaga_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sch_master_lembaga_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sch_master_lembaga_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($sch_master_lembaga->Export == "") || (EW_EXPORT_MASTER_RECORD && $sch_master_lembaga->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$sch_master_lembaga_list->TotalRecs = $sch_master_lembaga->SelectRecordCount();
	} else {
		if ($sch_master_lembaga_list->Recordset = $sch_master_lembaga_list->LoadRecordset())
			$sch_master_lembaga_list->TotalRecs = $sch_master_lembaga_list->Recordset->RecordCount();
	}
	$sch_master_lembaga_list->StartRec = 1;
	if ($sch_master_lembaga_list->DisplayRecs <= 0 || ($sch_master_lembaga->Export <> "" && $sch_master_lembaga->ExportAll)) // Display all records
		$sch_master_lembaga_list->DisplayRecs = $sch_master_lembaga_list->TotalRecs;
	if (!($sch_master_lembaga->Export <> "" && $sch_master_lembaga->ExportAll))
		$sch_master_lembaga_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$sch_master_lembaga_list->Recordset = $sch_master_lembaga_list->LoadRecordset($sch_master_lembaga_list->StartRec-1, $sch_master_lembaga_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $sch_master_lembaga->TableCaption() ?>
&nbsp;&nbsp;<?php $sch_master_lembaga_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($sch_master_lembaga->Export == "" && $sch_master_lembaga->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(sch_master_lembaga_list);" style="text-decoration: none;"><img id="sch_master_lembaga_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="sch_master_lembaga_list_SearchPanel">
<form name="fsch_master_lembagalistsrch" id="fsch_master_lembagalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="sch_master_lembaga">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($sch_master_lembaga->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $sch_master_lembaga_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($sch_master_lembaga->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($sch_master_lembaga->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($sch_master_lembaga->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $sch_master_lembaga_list->ShowPageHeader(); ?>
<?php
$sch_master_lembaga_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($sch_master_lembaga->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($sch_master_lembaga->CurrentAction <> "gridadd" && $sch_master_lembaga->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($sch_master_lembaga_list->Pager)) $sch_master_lembaga_list->Pager = new cNumericPager($sch_master_lembaga_list->StartRec, $sch_master_lembaga_list->DisplayRecs, $sch_master_lembaga_list->TotalRecs, $sch_master_lembaga_list->RecRange) ?>
<?php if ($sch_master_lembaga_list->Pager->RecordCount > 0) { ?>
	<?php if ($sch_master_lembaga_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $sch_master_lembaga_list->PageUrl() ?>start=<?php echo $sch_master_lembaga_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($sch_master_lembaga_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $sch_master_lembaga_list->PageUrl() ?>start=<?php echo $sch_master_lembaga_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($sch_master_lembaga_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $sch_master_lembaga_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($sch_master_lembaga_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $sch_master_lembaga_list->PageUrl() ?>start=<?php echo $sch_master_lembaga_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($sch_master_lembaga_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $sch_master_lembaga_list->PageUrl() ?>start=<?php echo $sch_master_lembaga_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($sch_master_lembaga_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $sch_master_lembaga_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $sch_master_lembaga_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $sch_master_lembaga_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($sch_master_lembaga_list->SearchWhere == "0=101") { ?>
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
<?php if ($sch_master_lembaga_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="sch_master_lembaga">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($sch_master_lembaga_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($sch_master_lembaga_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($sch_master_lembaga_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($sch_master_lembaga_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($sch_master_lembaga_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($sch_master_lembaga_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($sch_master_lembaga_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($sch_master_lembaga_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($sch_master_lembaga_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $sch_master_lembaga_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fsch_master_lembagalist" id="fsch_master_lembagalist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="sch_master_lembaga">
<div id="gmp_sch_master_lembaga" class="ewGridMiddlePanel">
<?php if ($sch_master_lembaga_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $sch_master_lembaga->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$sch_master_lembaga_list->RenderListOptions();

// Render list options (header, left)
$sch_master_lembaga_list->ListOptions->Render("header", "left");
?>
<?php if ($sch_master_lembaga->kode_lembaga->Visible) { // kode_lembaga ?>
	<?php if ($sch_master_lembaga->SortUrl($sch_master_lembaga->kode_lembaga) == "") { ?>
		<td><?php echo $sch_master_lembaga->kode_lembaga->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sch_master_lembaga->SortUrl($sch_master_lembaga->kode_lembaga) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sch_master_lembaga->kode_lembaga->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($sch_master_lembaga->kode_lembaga->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sch_master_lembaga->kode_lembaga->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sch_master_lembaga->nama_lembaga->Visible) { // nama_lembaga ?>
	<?php if ($sch_master_lembaga->SortUrl($sch_master_lembaga->nama_lembaga) == "") { ?>
		<td><?php echo $sch_master_lembaga->nama_lembaga->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sch_master_lembaga->SortUrl($sch_master_lembaga->nama_lembaga) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sch_master_lembaga->nama_lembaga->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($sch_master_lembaga->nama_lembaga->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sch_master_lembaga->nama_lembaga->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$sch_master_lembaga_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($sch_master_lembaga->ExportAll && $sch_master_lembaga->Export <> "") {
	$sch_master_lembaga_list->StopRec = $sch_master_lembaga_list->TotalRecs;
} else {

	// Set the last record to display
	if ($sch_master_lembaga_list->TotalRecs > $sch_master_lembaga_list->StartRec + $sch_master_lembaga_list->DisplayRecs - 1)
		$sch_master_lembaga_list->StopRec = $sch_master_lembaga_list->StartRec + $sch_master_lembaga_list->DisplayRecs - 1;
	else
		$sch_master_lembaga_list->StopRec = $sch_master_lembaga_list->TotalRecs;
}
$sch_master_lembaga_list->RecCnt = $sch_master_lembaga_list->StartRec - 1;
if ($sch_master_lembaga_list->Recordset && !$sch_master_lembaga_list->Recordset->EOF) {
	$sch_master_lembaga_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $sch_master_lembaga_list->StartRec > 1)
		$sch_master_lembaga_list->Recordset->Move($sch_master_lembaga_list->StartRec - 1);
} elseif (!$sch_master_lembaga->AllowAddDeleteRow && $sch_master_lembaga_list->StopRec == 0) {
	$sch_master_lembaga_list->StopRec = $sch_master_lembaga->GridAddRowCount;
}

// Initialize aggregate
$sch_master_lembaga->RowType = EW_ROWTYPE_AGGREGATEINIT;
$sch_master_lembaga->ResetAttrs();
$sch_master_lembaga_list->RenderRow();
$sch_master_lembaga_list->RowCnt = 0;
while ($sch_master_lembaga_list->RecCnt < $sch_master_lembaga_list->StopRec) {
	$sch_master_lembaga_list->RecCnt++;
	if (intval($sch_master_lembaga_list->RecCnt) >= intval($sch_master_lembaga_list->StartRec)) {
		$sch_master_lembaga_list->RowCnt++;

		// Set up key count
		$sch_master_lembaga_list->KeyCount = $sch_master_lembaga_list->RowIndex;

		// Init row class and style
		$sch_master_lembaga->ResetAttrs();
		$sch_master_lembaga->CssClass = "";
		if ($sch_master_lembaga->CurrentAction == "gridadd") {
		} else {
			$sch_master_lembaga_list->LoadRowValues($sch_master_lembaga_list->Recordset); // Load row values
		}
		$sch_master_lembaga->RowType = EW_ROWTYPE_VIEW; // Render view
		$sch_master_lembaga->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$sch_master_lembaga_list->RenderRow();

		// Render list options
		$sch_master_lembaga_list->RenderListOptions();
?>
	<tr<?php echo $sch_master_lembaga->RowAttributes() ?>>
<?php

// Render list options (body, left)
$sch_master_lembaga_list->ListOptions->Render("body", "left");
?>
	<?php if ($sch_master_lembaga->kode_lembaga->Visible) { // kode_lembaga ?>
		<td<?php echo $sch_master_lembaga->kode_lembaga->CellAttributes() ?>>
<div<?php echo $sch_master_lembaga->kode_lembaga->ViewAttributes() ?>><?php echo $sch_master_lembaga->kode_lembaga->ListViewValue() ?></div>
<a name="<?php echo $sch_master_lembaga_list->PageObjName . "_row_" . $sch_master_lembaga_list->RowCnt ?>" id="<?php echo $sch_master_lembaga_list->PageObjName . "_row_" . $sch_master_lembaga_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($sch_master_lembaga->nama_lembaga->Visible) { // nama_lembaga ?>
		<td<?php echo $sch_master_lembaga->nama_lembaga->CellAttributes() ?>>
<div<?php echo $sch_master_lembaga->nama_lembaga->ViewAttributes() ?>><?php echo $sch_master_lembaga->nama_lembaga->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sch_master_lembaga_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($sch_master_lembaga->CurrentAction <> "gridadd")
		$sch_master_lembaga_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($sch_master_lembaga_list->Recordset)
	$sch_master_lembaga_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($sch_master_lembaga->Export == "" && $sch_master_lembaga->CurrentAction == "") { ?>
<?php } ?>
<?php
$sch_master_lembaga_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($sch_master_lembaga->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$sch_master_lembaga_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csch_master_lembaga_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'sch_master_lembaga';

	// Page object name
	var $PageObjName = 'sch_master_lembaga_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sch_master_lembaga;
		if ($sch_master_lembaga->UseTokenInUrl) $PageUrl .= "t=" . $sch_master_lembaga->TableVar . "&"; // Add page token
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
		global $objForm, $sch_master_lembaga;
		if ($sch_master_lembaga->UseTokenInUrl) {
			if ($objForm)
				return ($sch_master_lembaga->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sch_master_lembaga->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csch_master_lembaga_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (sch_master_lembaga)
		if (!isset($GLOBALS["sch_master_lembaga"])) {
			$GLOBALS["sch_master_lembaga"] = new csch_master_lembaga();
			$GLOBALS["Table"] =& $GLOBALS["sch_master_lembaga"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "sch_master_lembagaadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "sch_master_lembagadelete.php";
		$this->MultiUpdateUrl = "sch_master_lembagaupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sch_master_lembaga', TRUE);

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
		global $sch_master_lembaga;

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
			$sch_master_lembaga->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $sch_master_lembaga;

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
			if ($sch_master_lembaga->Export <> "" ||
				$sch_master_lembaga->CurrentAction == "gridadd" ||
				$sch_master_lembaga->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$sch_master_lembaga->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($sch_master_lembaga->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $sch_master_lembaga->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$sch_master_lembaga->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$sch_master_lembaga->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$sch_master_lembaga->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $sch_master_lembaga->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$sch_master_lembaga->setSessionWhere($sFilter);
		$sch_master_lembaga->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $sch_master_lembaga;
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
			$sch_master_lembaga->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$sch_master_lembaga->setStartRecordNumber($this->StartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $sch_master_lembaga;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $sch_master_lembaga->kode_lembaga, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $sch_master_lembaga->nama_lembaga, $Keyword);
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
		global $Security, $sch_master_lembaga;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $sch_master_lembaga->BasicSearchKeyword;
		$sSearchType = $sch_master_lembaga->BasicSearchType;
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
			$sch_master_lembaga->setSessionBasicSearchKeyword($sSearchKeyword);
			$sch_master_lembaga->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $sch_master_lembaga;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$sch_master_lembaga->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $sch_master_lembaga;
		$sch_master_lembaga->setSessionBasicSearchKeyword("");
		$sch_master_lembaga->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $sch_master_lembaga;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$sch_master_lembaga->BasicSearchKeyword = $sch_master_lembaga->getSessionBasicSearchKeyword();
			$sch_master_lembaga->BasicSearchType = $sch_master_lembaga->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $sch_master_lembaga;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$sch_master_lembaga->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$sch_master_lembaga->CurrentOrderType = @$_GET["ordertype"];
			$sch_master_lembaga->UpdateSort($sch_master_lembaga->kode_lembaga); // kode_lembaga
			$sch_master_lembaga->UpdateSort($sch_master_lembaga->nama_lembaga); // nama_lembaga
			$sch_master_lembaga->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $sch_master_lembaga;
		$sOrderBy = $sch_master_lembaga->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($sch_master_lembaga->SqlOrderBy() <> "") {
				$sOrderBy = $sch_master_lembaga->SqlOrderBy();
				$sch_master_lembaga->setSessionOrderBy($sOrderBy);
				$sch_master_lembaga->nama_lembaga->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $sch_master_lembaga;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$sch_master_lembaga->setSessionOrderBy($sOrderBy);
				$sch_master_lembaga->kode_lembaga->setSort("");
				$sch_master_lembaga->nama_lembaga->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$sch_master_lembaga->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $sch_master_lembaga;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = TRUE;

		// "copy"
		$item =& $this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
		$item->OnLeft = TRUE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $sch_master_lembaga, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . "<img src=\"phpimages/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->CanAdd() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->CopyUrl . "\">" . "<img src=\"phpimages/copy.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("CopyLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("CopyLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $sch_master_lembaga;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $sch_master_lembaga;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$sch_master_lembaga->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$sch_master_lembaga->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $sch_master_lembaga->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$sch_master_lembaga->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$sch_master_lembaga->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$sch_master_lembaga->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $sch_master_lembaga;
		$sch_master_lembaga->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$sch_master_lembaga->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $sch_master_lembaga;

		// Call Recordset Selecting event
		$sch_master_lembaga->Recordset_Selecting($sch_master_lembaga->CurrentFilter);

		// Load List page SQL
		$sSql = $sch_master_lembaga->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$sch_master_lembaga->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sch_master_lembaga;
		$sFilter = $sch_master_lembaga->KeyFilter();

		// Call Row Selecting event
		$sch_master_lembaga->Row_Selecting($sFilter);

		// Load SQL based on filter
		$sch_master_lembaga->CurrentFilter = $sFilter;
		$sSql = $sch_master_lembaga->SQL();
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
		global $conn, $sch_master_lembaga;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$sch_master_lembaga->Row_Selected($row);
		$sch_master_lembaga->kode_lembaga->setDbValue($rs->fields('kode_lembaga'));
		$sch_master_lembaga->nama_lembaga->setDbValue($rs->fields('nama_lembaga'));
	}

	// Load old record
	function LoadOldRecord() {
		global $sch_master_lembaga;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($sch_master_lembaga->getKey("kode_lembaga")) <> "")
			$sch_master_lembaga->kode_lembaga->CurrentValue = $sch_master_lembaga->getKey("kode_lembaga"); // kode_lembaga
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$sch_master_lembaga->CurrentFilter = $sch_master_lembaga->KeyFilter();
			$sSql = $sch_master_lembaga->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sch_master_lembaga;

		// Initialize URLs
		$this->ViewUrl = $sch_master_lembaga->ViewUrl();
		$this->EditUrl = $sch_master_lembaga->EditUrl();
		$this->InlineEditUrl = $sch_master_lembaga->InlineEditUrl();
		$this->CopyUrl = $sch_master_lembaga->CopyUrl();
		$this->InlineCopyUrl = $sch_master_lembaga->InlineCopyUrl();
		$this->DeleteUrl = $sch_master_lembaga->DeleteUrl();

		// Call Row_Rendering event
		$sch_master_lembaga->Row_Rendering();

		// Common render codes for all row types
		// kode_lembaga
		// nama_lembaga

		if ($sch_master_lembaga->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_lembaga
			$sch_master_lembaga->kode_lembaga->ViewValue = $sch_master_lembaga->kode_lembaga->CurrentValue;
			$sch_master_lembaga->kode_lembaga->ViewCustomAttributes = "";

			// nama_lembaga
			$sch_master_lembaga->nama_lembaga->ViewValue = $sch_master_lembaga->nama_lembaga->CurrentValue;
			$sch_master_lembaga->nama_lembaga->ViewCustomAttributes = "";

			// kode_lembaga
			$sch_master_lembaga->kode_lembaga->LinkCustomAttributes = "";
			$sch_master_lembaga->kode_lembaga->HrefValue = "";
			$sch_master_lembaga->kode_lembaga->TooltipValue = "";

			// nama_lembaga
			$sch_master_lembaga->nama_lembaga->LinkCustomAttributes = "";
			$sch_master_lembaga->nama_lembaga->HrefValue = "";
			$sch_master_lembaga->nama_lembaga->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($sch_master_lembaga->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$sch_master_lembaga->Row_Rendered();
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

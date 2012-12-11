<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_peserta_kelas_kelompokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_peserta_kelas_kelompok_list = new cst_peserta_kelas_kelompok_list();
$Page =& $st_peserta_kelas_kelompok_list;

// Page init
$st_peserta_kelas_kelompok_list->Page_Init();

// Page main
$st_peserta_kelas_kelompok_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($st_peserta_kelas_kelompok->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var st_peserta_kelas_kelompok_list = new ew_Page("st_peserta_kelas_kelompok_list");

// page properties
st_peserta_kelas_kelompok_list.PageID = "list"; // page ID
st_peserta_kelas_kelompok_list.FormID = "fst_peserta_kelas_kelompoklist"; // form ID
var EW_PAGE_ID = st_peserta_kelas_kelompok_list.PageID; // for backward compatibility

// extend page with ValidateForm function
st_peserta_kelas_kelompok_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_identitas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_peserta_kelas_kelompok->identitas->FldCaption()) ?>");

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
st_peserta_kelas_kelompok_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_peserta_kelas_kelompok_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_peserta_kelas_kelompok_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($st_peserta_kelas_kelompok->Export == "") || (EW_EXPORT_MASTER_RECORD && $st_peserta_kelas_kelompok->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$st_peserta_kelas_kelompok_list->TotalRecs = $st_peserta_kelas_kelompok->SelectRecordCount();
	} else {
		if ($st_peserta_kelas_kelompok_list->Recordset = $st_peserta_kelas_kelompok_list->LoadRecordset())
			$st_peserta_kelas_kelompok_list->TotalRecs = $st_peserta_kelas_kelompok_list->Recordset->RecordCount();
	}
	$st_peserta_kelas_kelompok_list->StartRec = 1;
	if ($st_peserta_kelas_kelompok_list->DisplayRecs <= 0 || ($st_peserta_kelas_kelompok->Export <> "" && $st_peserta_kelas_kelompok->ExportAll)) // Display all records
		$st_peserta_kelas_kelompok_list->DisplayRecs = $st_peserta_kelas_kelompok_list->TotalRecs;
	if (!($st_peserta_kelas_kelompok->Export <> "" && $st_peserta_kelas_kelompok->ExportAll))
		$st_peserta_kelas_kelompok_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$st_peserta_kelas_kelompok_list->Recordset = $st_peserta_kelas_kelompok_list->LoadRecordset($st_peserta_kelas_kelompok_list->StartRec-1, $st_peserta_kelas_kelompok_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_peserta_kelas_kelompok->TableCaption() ?>
&nbsp;&nbsp;<?php $st_peserta_kelas_kelompok_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($st_peserta_kelas_kelompok->Export == "" && $st_peserta_kelas_kelompok->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(st_peserta_kelas_kelompok_list);" style="text-decoration: none;"><img id="st_peserta_kelas_kelompok_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="st_peserta_kelas_kelompok_list_SearchPanel">
<form name="fst_peserta_kelas_kelompoklistsrch" id="fst_peserta_kelas_kelompoklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="st_peserta_kelas_kelompok">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $st_peserta_kelas_kelompok_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
	<a href="st_peserta_kelas_kelompoksrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($st_peserta_kelas_kelompok->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($st_peserta_kelas_kelompok->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($st_peserta_kelas_kelompok->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $st_peserta_kelas_kelompok_list->ShowPageHeader(); ?>
<?php
$st_peserta_kelas_kelompok_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($st_peserta_kelas_kelompok->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($st_peserta_kelas_kelompok->CurrentAction <> "gridadd" && $st_peserta_kelas_kelompok->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($st_peserta_kelas_kelompok_list->Pager)) $st_peserta_kelas_kelompok_list->Pager = new cNumericPager($st_peserta_kelas_kelompok_list->StartRec, $st_peserta_kelas_kelompok_list->DisplayRecs, $st_peserta_kelas_kelompok_list->TotalRecs, $st_peserta_kelas_kelompok_list->RecRange) ?>
<?php if ($st_peserta_kelas_kelompok_list->Pager->RecordCount > 0) { ?>
	<?php if ($st_peserta_kelas_kelompok_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $st_peserta_kelas_kelompok_list->PageUrl() ?>start=<?php echo $st_peserta_kelas_kelompok_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($st_peserta_kelas_kelompok_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $st_peserta_kelas_kelompok_list->PageUrl() ?>start=<?php echo $st_peserta_kelas_kelompok_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($st_peserta_kelas_kelompok_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $st_peserta_kelas_kelompok_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($st_peserta_kelas_kelompok_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $st_peserta_kelas_kelompok_list->PageUrl() ?>start=<?php echo $st_peserta_kelas_kelompok_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($st_peserta_kelas_kelompok_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $st_peserta_kelas_kelompok_list->PageUrl() ?>start=<?php echo $st_peserta_kelas_kelompok_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($st_peserta_kelas_kelompok_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $st_peserta_kelas_kelompok_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $st_peserta_kelas_kelompok_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $st_peserta_kelas_kelompok_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($st_peserta_kelas_kelompok_list->SearchWhere == "0=101") { ?>
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
<?php if ($st_peserta_kelas_kelompok_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="st_peserta_kelas_kelompok">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($st_peserta_kelas_kelompok_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($st_peserta_kelas_kelompok_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($st_peserta_kelas_kelompok_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($st_peserta_kelas_kelompok_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($st_peserta_kelas_kelompok_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($st_peserta_kelas_kelompok_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($st_peserta_kelas_kelompok_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($st_peserta_kelas_kelompok_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($st_peserta_kelas_kelompok_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $st_peserta_kelas_kelompok_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fst_peserta_kelas_kelompoklist" id="fst_peserta_kelas_kelompoklist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="st_peserta_kelas_kelompok">
<div id="gmp_st_peserta_kelas_kelompok" class="ewGridMiddlePanel">
<?php if ($st_peserta_kelas_kelompok_list->TotalRecs > 0 || $st_peserta_kelas_kelompok->CurrentAction == "add" || $st_peserta_kelas_kelompok->CurrentAction == "copy") { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $st_peserta_kelas_kelompok->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$st_peserta_kelas_kelompok_list->RenderListOptions();

// Render list options (header, left)
$st_peserta_kelas_kelompok_list->ListOptions->Render("header", "left");
?>
<?php if ($st_peserta_kelas_kelompok->identitas->Visible) { // identitas ?>
	<?php if ($st_peserta_kelas_kelompok->SortUrl($st_peserta_kelas_kelompok->identitas) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $st_peserta_kelas_kelompok->identitas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_peserta_kelas_kelompok->SortUrl($st_peserta_kelas_kelompok->identitas) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $st_peserta_kelas_kelompok->identitas->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_peserta_kelas_kelompok->identitas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_peserta_kelas_kelompok->identitas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_peserta_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($st_peserta_kelas_kelompok->SortUrl($st_peserta_kelas_kelompok->kode_otomatis) == "") { ?>
		<td><?php echo $st_peserta_kelas_kelompok->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_peserta_kelas_kelompok->SortUrl($st_peserta_kelas_kelompok->kode_otomatis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_peserta_kelas_kelompok->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_peserta_kelas_kelompok->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_peserta_kelas_kelompok->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$st_peserta_kelas_kelompok_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
	if ($st_peserta_kelas_kelompok->CurrentAction == "add" || $st_peserta_kelas_kelompok->CurrentAction == "copy") {
		$st_peserta_kelas_kelompok_list->RowIndex = 1;
		$st_peserta_kelas_kelompok_list->KeyCount = $st_peserta_kelas_kelompok_list->RowIndex;
		if ($st_peserta_kelas_kelompok->CurrentAction == "add")
			$st_peserta_kelas_kelompok_list->LoadDefaultValues();
		if ($st_peserta_kelas_kelompok->EventCancelled) // Insert failed
			$st_peserta_kelas_kelompok_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$st_peserta_kelas_kelompok->ResetAttrs();
		$st_peserta_kelas_kelompok->CssClass = "ewTableEditRow";
		$st_peserta_kelas_kelompok->RowAttrs = array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($st_peserta_kelas_kelompok_list->RowIndex))
			$st_peserta_kelas_kelompok->RowAttrs = array_merge($st_peserta_kelas_kelompok->RowAttrs, array('data-rowindex'=>$st_peserta_kelas_kelompok_list->RowIndex, 'id'=>'r' . $st_peserta_kelas_kelompok_list->RowIndex . '_st_peserta_kelas_kelompok'));
		$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_ADD;

		// Render row
		$st_peserta_kelas_kelompok_list->RenderRow();

		// Render list options
		$st_peserta_kelas_kelompok_list->RenderListOptions();
?>
	<tr<?php echo $st_peserta_kelas_kelompok->RowAttributes() ?>>
<?php

// Render list options (body, left)
$st_peserta_kelas_kelompok_list->ListOptions->Render("body", "left");
?>
	<?php if ($st_peserta_kelas_kelompok->identitas->Visible) { // identitas ?>
		<td>
<select id="x<?php echo $st_peserta_kelas_kelompok_list->RowIndex ?>_identitas" name="x<?php echo $st_peserta_kelas_kelompok_list->RowIndex ?>_identitas"<?php echo $st_peserta_kelas_kelompok->identitas->EditAttributes() ?>>
<?php
if (is_array($st_peserta_kelas_kelompok->identitas->EditValue)) {
	$arwrk = $st_peserta_kelas_kelompok->identitas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_peserta_kelas_kelompok->identitas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$st_peserta_kelas_kelompok->identitas) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<input type="hidden" name="o<?php echo $st_peserta_kelas_kelompok_list->RowIndex ?>_identitas" id="o<?php echo $st_peserta_kelas_kelompok_list->RowIndex ?>_identitas" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->identitas->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($st_peserta_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
		<td>
<input type="hidden" name="x<?php echo $st_peserta_kelas_kelompok_list->RowIndex ?>_kode_otomatis" id="x<?php echo $st_peserta_kelas_kelompok_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_peserta_kelas_kelompok_list->RowIndex ?>_kode_otomatis" id="o<?php echo $st_peserta_kelas_kelompok_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$st_peserta_kelas_kelompok_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
<?php
if ($st_peserta_kelas_kelompok->ExportAll && $st_peserta_kelas_kelompok->Export <> "") {
	$st_peserta_kelas_kelompok_list->StopRec = $st_peserta_kelas_kelompok_list->TotalRecs;
} else {

	// Set the last record to display
	if ($st_peserta_kelas_kelompok_list->TotalRecs > $st_peserta_kelas_kelompok_list->StartRec + $st_peserta_kelas_kelompok_list->DisplayRecs - 1)
		$st_peserta_kelas_kelompok_list->StopRec = $st_peserta_kelas_kelompok_list->StartRec + $st_peserta_kelas_kelompok_list->DisplayRecs - 1;
	else
		$st_peserta_kelas_kelompok_list->StopRec = $st_peserta_kelas_kelompok_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($st_peserta_kelas_kelompok->CurrentAction == "gridadd" || $st_peserta_kelas_kelompok->CurrentAction == "gridedit" || $st_peserta_kelas_kelompok->CurrentAction == "F")) {
		$st_peserta_kelas_kelompok_list->KeyCount = $objForm->GetValue("key_count");
		$st_peserta_kelas_kelompok_list->StopRec = $st_peserta_kelas_kelompok_list->KeyCount;
	}
}
$st_peserta_kelas_kelompok_list->RecCnt = $st_peserta_kelas_kelompok_list->StartRec - 1;
if ($st_peserta_kelas_kelompok_list->Recordset && !$st_peserta_kelas_kelompok_list->Recordset->EOF) {
	$st_peserta_kelas_kelompok_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $st_peserta_kelas_kelompok_list->StartRec > 1)
		$st_peserta_kelas_kelompok_list->Recordset->Move($st_peserta_kelas_kelompok_list->StartRec - 1);
} elseif (!$st_peserta_kelas_kelompok->AllowAddDeleteRow && $st_peserta_kelas_kelompok_list->StopRec == 0) {
	$st_peserta_kelas_kelompok_list->StopRec = $st_peserta_kelas_kelompok->GridAddRowCount;
}

// Initialize aggregate
$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_AGGREGATEINIT;
$st_peserta_kelas_kelompok->ResetAttrs();
$st_peserta_kelas_kelompok_list->RenderRow();
$st_peserta_kelas_kelompok_list->RowCnt = 0;
while ($st_peserta_kelas_kelompok_list->RecCnt < $st_peserta_kelas_kelompok_list->StopRec) {
	$st_peserta_kelas_kelompok_list->RecCnt++;
	if (intval($st_peserta_kelas_kelompok_list->RecCnt) >= intval($st_peserta_kelas_kelompok_list->StartRec)) {
		$st_peserta_kelas_kelompok_list->RowCnt++;

		// Set up key count
		$st_peserta_kelas_kelompok_list->KeyCount = $st_peserta_kelas_kelompok_list->RowIndex;

		// Init row class and style
		$st_peserta_kelas_kelompok->ResetAttrs();
		$st_peserta_kelas_kelompok->CssClass = "";
		if ($st_peserta_kelas_kelompok->CurrentAction == "gridadd") {
			$st_peserta_kelas_kelompok_list->LoadDefaultValues(); // Load default values
		} else {
			$st_peserta_kelas_kelompok_list->LoadRowValues($st_peserta_kelas_kelompok_list->Recordset); // Load row values
		}
		$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_VIEW; // Render view
		$st_peserta_kelas_kelompok->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$st_peserta_kelas_kelompok_list->RenderRow();

		// Render list options
		$st_peserta_kelas_kelompok_list->RenderListOptions();
?>
	<tr<?php echo $st_peserta_kelas_kelompok->RowAttributes() ?>>
<?php

// Render list options (body, left)
$st_peserta_kelas_kelompok_list->ListOptions->Render("body", "left");
?>
	<?php if ($st_peserta_kelas_kelompok->identitas->Visible) { // identitas ?>
		<td<?php echo $st_peserta_kelas_kelompok->identitas->CellAttributes() ?>>
<div<?php echo $st_peserta_kelas_kelompok->identitas->ViewAttributes() ?>><?php echo $st_peserta_kelas_kelompok->identitas->ListViewValue() ?></div>
<a name="<?php echo $st_peserta_kelas_kelompok_list->PageObjName . "_row_" . $st_peserta_kelas_kelompok_list->RowCnt ?>" id="<?php echo $st_peserta_kelas_kelompok_list->PageObjName . "_row_" . $st_peserta_kelas_kelompok_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($st_peserta_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $st_peserta_kelas_kelompok->kode_otomatis->CellAttributes() ?>>
<div<?php echo $st_peserta_kelas_kelompok->kode_otomatis->ViewAttributes() ?>><?php echo $st_peserta_kelas_kelompok->kode_otomatis->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$st_peserta_kelas_kelompok_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($st_peserta_kelas_kelompok->CurrentAction <> "gridadd")
		$st_peserta_kelas_kelompok_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($st_peserta_kelas_kelompok->CurrentAction == "add" || $st_peserta_kelas_kelompok->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $st_peserta_kelas_kelompok_list->KeyCount ?>">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($st_peserta_kelas_kelompok_list->Recordset)
	$st_peserta_kelas_kelompok_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($st_peserta_kelas_kelompok->Export == "" && $st_peserta_kelas_kelompok->CurrentAction == "") { ?>
<?php } ?>
<?php
$st_peserta_kelas_kelompok_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($st_peserta_kelas_kelompok->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$st_peserta_kelas_kelompok_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_peserta_kelas_kelompok_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'st_peserta_kelas_kelompok';

	// Page object name
	var $PageObjName = 'st_peserta_kelas_kelompok_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_peserta_kelas_kelompok;
		if ($st_peserta_kelas_kelompok->UseTokenInUrl) $PageUrl .= "t=" . $st_peserta_kelas_kelompok->TableVar . "&"; // Add page token
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
		global $objForm, $st_peserta_kelas_kelompok;
		if ($st_peserta_kelas_kelompok->UseTokenInUrl) {
			if ($objForm)
				return ($st_peserta_kelas_kelompok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_peserta_kelas_kelompok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_peserta_kelas_kelompok_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_peserta_kelas_kelompok)
		if (!isset($GLOBALS["st_peserta_kelas_kelompok"])) {
			$GLOBALS["st_peserta_kelas_kelompok"] = new cst_peserta_kelas_kelompok();
			$GLOBALS["Table"] =& $GLOBALS["st_peserta_kelas_kelompok"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "st_peserta_kelas_kelompokadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "st_peserta_kelas_kelompokdelete.php";
		$this->MultiUpdateUrl = "st_peserta_kelas_kelompokupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_peserta_kelas_kelompok', TRUE);

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
		global $st_peserta_kelas_kelompok;

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

		// Create form object
		$objForm = new cFormObj();

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$st_peserta_kelas_kelompok->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $st_peserta_kelas_kelompok;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$st_peserta_kelas_kelompok->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($st_peserta_kelas_kelompok->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline add mode
				if ($st_peserta_kelas_kelompok->CurrentAction == "add" || $st_peserta_kelas_kelompok->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$st_peserta_kelas_kelompok->CurrentAction = $_POST["a_list"]; // Get action

					// Insert Inline
					if ($st_peserta_kelas_kelompok->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Hide all options
			if ($st_peserta_kelas_kelompok->Export <> "" ||
				$st_peserta_kelas_kelompok->CurrentAction == "gridadd" ||
				$st_peserta_kelas_kelompok->CurrentAction == "gridedit") {
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
			$st_peserta_kelas_kelompok->Recordset_SearchValidated();

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
		if ($st_peserta_kelas_kelompok->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $st_peserta_kelas_kelompok->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$st_peserta_kelas_kelompok->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$st_peserta_kelas_kelompok->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$st_peserta_kelas_kelompok->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $st_peserta_kelas_kelompok->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$st_peserta_kelas_kelompok->setSessionWhere($sFilter);
		$st_peserta_kelas_kelompok->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $st_peserta_kelas_kelompok;
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
			$st_peserta_kelas_kelompok->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$st_peserta_kelas_kelompok->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $st_peserta_kelas_kelompok;
		$st_peserta_kelas_kelompok->LastAction = $st_peserta_kelas_kelompok->CurrentAction; // Save last action
		$st_peserta_kelas_kelompok->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $st_peserta_kelas_kelompok;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$st_peserta_kelas_kelompok->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError, $st_peserta_kelas_kelompok;
		$this->LoadOldRecord(); // Load old recordset
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setFailureMessage($gsFormError); // Set validation error message
			$st_peserta_kelas_kelompok->EventCancelled = TRUE; // Set event cancelled
			$st_peserta_kelas_kelompok->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$st_peserta_kelas_kelompok->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow($this->OldRecordset)) { // Add record
			$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$st_peserta_kelas_kelompok->EventCancelled = TRUE; // Set event cancelled
			$st_peserta_kelas_kelompok->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $st_peserta_kelas_kelompok;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $st_peserta_kelas_kelompok->identitas, FALSE); // identitas
		$this->BuildSearchSql($sWhere, $st_peserta_kelas_kelompok->kode_otomatis_kelompok, FALSE); // kode_otomatis_kelompok
		$this->BuildSearchSql($sWhere, $st_peserta_kelas_kelompok->kode_otomatis, FALSE); // kode_otomatis

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($st_peserta_kelas_kelompok->identitas); // identitas
			$this->SetSearchParm($st_peserta_kelas_kelompok->kode_otomatis_kelompok); // kode_otomatis_kelompok
			$this->SetSearchParm($st_peserta_kelas_kelompok->kode_otomatis); // kode_otomatis
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
		global $st_peserta_kelas_kelompok;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$st_peserta_kelas_kelompok->setAdvancedSearch("x_$FldParm", $FldVal);
		$st_peserta_kelas_kelompok->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$st_peserta_kelas_kelompok->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$st_peserta_kelas_kelompok->setAdvancedSearch("y_$FldParm", $FldVal2);
		$st_peserta_kelas_kelompok->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $st_peserta_kelas_kelompok;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $st_peserta_kelas_kelompok->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $st_peserta_kelas_kelompok->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $st_peserta_kelas_kelompok->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $st_peserta_kelas_kelompok->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $st_peserta_kelas_kelompok->getAdvancedSearch("w_$FldParm");
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
		global $st_peserta_kelas_kelompok;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $st_peserta_kelas_kelompok->identitas, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_peserta_kelas_kelompok->kode_otomatis_kelompok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_peserta_kelas_kelompok->kode_otomatis, $Keyword);
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
		global $Security, $st_peserta_kelas_kelompok;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $st_peserta_kelas_kelompok->BasicSearchKeyword;
		$sSearchType = $st_peserta_kelas_kelompok->BasicSearchType;
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
			$st_peserta_kelas_kelompok->setSessionBasicSearchKeyword($sSearchKeyword);
			$st_peserta_kelas_kelompok->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $st_peserta_kelas_kelompok;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$st_peserta_kelas_kelompok->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $st_peserta_kelas_kelompok;
		$st_peserta_kelas_kelompok->setSessionBasicSearchKeyword("");
		$st_peserta_kelas_kelompok->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $st_peserta_kelas_kelompok;
		$st_peserta_kelas_kelompok->setAdvancedSearch("x_identitas", "");
		$st_peserta_kelas_kelompok->setAdvancedSearch("x_kode_otomatis_kelompok", "");
		$st_peserta_kelas_kelompok->setAdvancedSearch("x_kode_otomatis", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $st_peserta_kelas_kelompok;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_identitas"] <> "") $bRestore = FALSE;
		if (@$_GET["x_kode_otomatis_kelompok"] <> "") $bRestore = FALSE;
		if (@$_GET["x_kode_otomatis"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$st_peserta_kelas_kelompok->BasicSearchKeyword = $st_peserta_kelas_kelompok->getSessionBasicSearchKeyword();
			$st_peserta_kelas_kelompok->BasicSearchType = $st_peserta_kelas_kelompok->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($st_peserta_kelas_kelompok->identitas);
			$this->GetSearchParm($st_peserta_kelas_kelompok->kode_otomatis_kelompok);
			$this->GetSearchParm($st_peserta_kelas_kelompok->kode_otomatis);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $st_peserta_kelas_kelompok;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$st_peserta_kelas_kelompok->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$st_peserta_kelas_kelompok->CurrentOrderType = @$_GET["ordertype"];
			$st_peserta_kelas_kelompok->UpdateSort($st_peserta_kelas_kelompok->identitas); // identitas
			$st_peserta_kelas_kelompok->UpdateSort($st_peserta_kelas_kelompok->kode_otomatis); // kode_otomatis
			$st_peserta_kelas_kelompok->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $st_peserta_kelas_kelompok;
		$sOrderBy = $st_peserta_kelas_kelompok->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($st_peserta_kelas_kelompok->SqlOrderBy() <> "") {
				$sOrderBy = $st_peserta_kelas_kelompok->SqlOrderBy();
				$st_peserta_kelas_kelompok->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $st_peserta_kelas_kelompok;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$st_peserta_kelas_kelompok->setSessionOrderBy($sOrderBy);
				$st_peserta_kelas_kelompok->identitas->setSort("");
				$st_peserta_kelas_kelompok->kode_otomatis->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$st_peserta_kelas_kelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $st_peserta_kelas_kelompok;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item =& $this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd() && ($st_peserta_kelas_kelompok->CurrentAction == "add");
		$item->OnLeft = TRUE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = TRUE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $st_peserta_kelas_kelompok, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_ADD)
			$this->RowAction = "insert";
		else
			$this->RowAction = "";
		if (is_numeric($this->RowIndex)) {
			$objForm->Index = $this->RowIndex;
			if ($objForm->HasValue("k_action"))
				$this->RowAction = strval($objForm->GetValue("k_action"));
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_action\" id=\"k" . $this->RowIndex . "_action\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue("k_key");
				$this->SetupKeyValues($rowkey);
			}
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if (($st_peserta_kelas_kelompok->CurrentAction == "add" || $st_peserta_kelas_kelompok->CurrentAction == "copy") &&
			$st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a class=\"ewGridLink\" href=\"\" onclick=\"return ew_SubmitForm(st_peserta_kelas_kelompok_list, document.fst_peserta_kelas_kelompoklist);\">" . "<img src=\"phpimages/insert.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("InsertLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("InsertLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>&nbsp;" .
				"<a class=\"ewGridLink\" href=\"" . $this->PageUrl() . "a=cancel\">" . "<img src=\"phpimages/cancel.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("CancelLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("CancelLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $st_peserta_kelas_kelompok;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $st_peserta_kelas_kelompok;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$st_peserta_kelas_kelompok->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$st_peserta_kelas_kelompok->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $st_peserta_kelas_kelompok->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$st_peserta_kelas_kelompok->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$st_peserta_kelas_kelompok->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$st_peserta_kelas_kelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $st_peserta_kelas_kelompok;
		$st_peserta_kelas_kelompok->identitas->CurrentValue = NULL;
		$st_peserta_kelas_kelompok->identitas->OldValue = $st_peserta_kelas_kelompok->identitas->CurrentValue;
		$st_peserta_kelas_kelompok->kode_otomatis->CurrentValue = unik();
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $st_peserta_kelas_kelompok;
		$st_peserta_kelas_kelompok->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$st_peserta_kelas_kelompok->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $st_peserta_kelas_kelompok;

		// Load search values
		// identitas

		$st_peserta_kelas_kelompok->identitas->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_identitas"]);
		$st_peserta_kelas_kelompok->identitas->AdvancedSearch->SearchOperator = @$_GET["z_identitas"];

		// kode_otomatis_kelompok
		$st_peserta_kelas_kelompok->kode_otomatis_kelompok->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_kode_otomatis_kelompok"]);
		$st_peserta_kelas_kelompok->kode_otomatis_kelompok->AdvancedSearch->SearchOperator = @$_GET["z_kode_otomatis_kelompok"];

		// kode_otomatis
		$st_peserta_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_kode_otomatis"]);
		$st_peserta_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchOperator = @$_GET["z_kode_otomatis"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $st_peserta_kelas_kelompok;
		if (!$st_peserta_kelas_kelompok->identitas->FldIsDetailKey) {
			$st_peserta_kelas_kelompok->identitas->setFormValue($objForm->GetValue("x_identitas"));
		}
		if (!$st_peserta_kelas_kelompok->kode_otomatis->FldIsDetailKey) {
			$st_peserta_kelas_kelompok->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $st_peserta_kelas_kelompok;
		$st_peserta_kelas_kelompok->identitas->CurrentValue = $st_peserta_kelas_kelompok->identitas->FormValue;
		$st_peserta_kelas_kelompok->kode_otomatis->CurrentValue = $st_peserta_kelas_kelompok->kode_otomatis->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $st_peserta_kelas_kelompok;

		// Call Recordset Selecting event
		$st_peserta_kelas_kelompok->Recordset_Selecting($st_peserta_kelas_kelompok->CurrentFilter);

		// Load List page SQL
		$sSql = $st_peserta_kelas_kelompok->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$st_peserta_kelas_kelompok->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_peserta_kelas_kelompok;
		$sFilter = $st_peserta_kelas_kelompok->KeyFilter();

		// Call Row Selecting event
		$st_peserta_kelas_kelompok->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_peserta_kelas_kelompok->CurrentFilter = $sFilter;
		$sSql = $st_peserta_kelas_kelompok->SQL();
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
		global $conn, $st_peserta_kelas_kelompok;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_peserta_kelas_kelompok->Row_Selected($row);
		$st_peserta_kelas_kelompok->identitas->setDbValue($rs->fields('identitas'));
		$st_peserta_kelas_kelompok->kode_otomatis_kelompok->setDbValue($rs->fields('kode_otomatis_kelompok'));
		$st_peserta_kelas_kelompok->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
	}

	// Load old record
	function LoadOldRecord() {
		global $st_peserta_kelas_kelompok;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($st_peserta_kelas_kelompok->getKey("kode_otomatis")) <> "")
			$st_peserta_kelas_kelompok->kode_otomatis->CurrentValue = $st_peserta_kelas_kelompok->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$st_peserta_kelas_kelompok->CurrentFilter = $st_peserta_kelas_kelompok->KeyFilter();
			$sSql = $st_peserta_kelas_kelompok->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_peserta_kelas_kelompok;

		// Initialize URLs
		$this->ViewUrl = $st_peserta_kelas_kelompok->ViewUrl();
		$this->EditUrl = $st_peserta_kelas_kelompok->EditUrl();
		$this->InlineEditUrl = $st_peserta_kelas_kelompok->InlineEditUrl();
		$this->CopyUrl = $st_peserta_kelas_kelompok->CopyUrl();
		$this->InlineCopyUrl = $st_peserta_kelas_kelompok->InlineCopyUrl();
		$this->DeleteUrl = $st_peserta_kelas_kelompok->DeleteUrl();

		// Call Row_Rendering event
		$st_peserta_kelas_kelompok->Row_Rendering();

		// Common render codes for all row types
		// identitas

		$st_peserta_kelas_kelompok->identitas->CellCssStyle = "white-space: nowrap;";

		// kode_otomatis_kelompok
		// kode_otomatis

		if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View row

			// identitas
			if (strval($st_peserta_kelas_kelompok->identitas->CurrentValue) <> "") {
				$sFilterWrk = "`A_nis_nasional` = '" . ew_AdjustSql($st_peserta_kelas_kelompok->identitas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `A_nis_nasional`, `A_nama_Lengkap` FROM `master_siswa`";
			$sWhereWrk = "";
			$lookuptblfilter = " D_saat_ini_tingkat ='" . $_SESSION['kode_otomatis_tingkat'] . "' "  . " AND apakah_valid='y' " . " AND NOT EXISTS (SELECT identitas,apakah_valid FROM st_peserta_kelas_kelompok,st_master_kelas_kelompok WHERE st_peserta_kelas_kelompok.kode_otomatis_kelompok=st_master_kelas_kelompok.kode_otomatis AND apakah_valid='y' AND kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND A_nis_nasional=identitas "  . ") ";
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
					$st_peserta_kelas_kelompok->identitas->ViewValue = $rswrk->fields('A_nis_nasional');
					$st_peserta_kelas_kelompok->identitas->ViewValue .= ew_ValueSeparator(0,1,$st_peserta_kelas_kelompok->identitas) . $rswrk->fields('A_nama_Lengkap');
					$rswrk->Close();
				} else {
					$st_peserta_kelas_kelompok->identitas->ViewValue = $st_peserta_kelas_kelompok->identitas->CurrentValue;
				}
			} else {
				$st_peserta_kelas_kelompok->identitas->ViewValue = NULL;
			}
			$st_peserta_kelas_kelompok->identitas->ViewCustomAttributes = "";

			// kode_otomatis_kelompok
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->ViewValue = $st_peserta_kelas_kelompok->kode_otomatis_kelompok->CurrentValue;
			$st_peserta_kelas_kelompok->kode_otomatis_kelompok->ViewCustomAttributes = "";

			// kode_otomatis
			$st_peserta_kelas_kelompok->kode_otomatis->ViewValue = $st_peserta_kelas_kelompok->kode_otomatis->CurrentValue;
			$st_peserta_kelas_kelompok->kode_otomatis->ViewCustomAttributes = "";

			// identitas
			$st_peserta_kelas_kelompok->identitas->LinkCustomAttributes = "";
			$st_peserta_kelas_kelompok->identitas->HrefValue = "";
			$st_peserta_kelas_kelompok->identitas->TooltipValue = "";

			// kode_otomatis
			$st_peserta_kelas_kelompok->kode_otomatis->LinkCustomAttributes = "";
			$st_peserta_kelas_kelompok->kode_otomatis->HrefValue = "";
			$st_peserta_kelas_kelompok->kode_otomatis->TooltipValue = "";
		} elseif ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add row

			// identitas
			$st_peserta_kelas_kelompok->identitas->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `A_nis_nasional`, `A_nis_nasional` AS `DispFld`, `A_nama_Lengkap` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_siswa`";
			$sWhereWrk = "";
			$lookuptblfilter = " D_saat_ini_tingkat ='" . $_SESSION['kode_otomatis_tingkat'] . "' "  . " AND apakah_valid='y' " . " AND NOT EXISTS (SELECT identitas,apakah_valid FROM st_peserta_kelas_kelompok,st_master_kelas_kelompok WHERE st_peserta_kelas_kelompok.kode_otomatis_kelompok=st_master_kelas_kelompok.kode_otomatis AND apakah_valid='y' AND kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND A_nis_nasional=identitas "  . ") ";
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
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$st_peserta_kelas_kelompok->identitas->EditValue = $arwrk;

			// kode_otomatis
			$st_peserta_kelas_kelompok->kode_otomatis->EditCustomAttributes = "";
			$st_peserta_kelas_kelompok->kode_otomatis->CurrentValue = unik();

			// Edit refer script
			// identitas

			$st_peserta_kelas_kelompok->identitas->HrefValue = "";

			// kode_otomatis
			$st_peserta_kelas_kelompok->kode_otomatis->HrefValue = "";
		}
		if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_ADD ||
			$st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_EDIT ||
			$st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$st_peserta_kelas_kelompok->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($st_peserta_kelas_kelompok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_peserta_kelas_kelompok->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $st_peserta_kelas_kelompok;

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

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $st_peserta_kelas_kelompok;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($st_peserta_kelas_kelompok->identitas->FormValue) && $st_peserta_kelas_kelompok->identitas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_peserta_kelas_kelompok->identitas->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $st_peserta_kelas_kelompok;

		// Check if key value entered
		if ($st_peserta_kelas_kelompok->kode_otomatis->CurrentValue == "" && $st_peserta_kelas_kelompok->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $st_peserta_kelas_kelompok->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $st_peserta_kelas_kelompok->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_peserta_kelas_kelompok->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($st_peserta_kelas_kelompok->kode_otomatis->CurrentValue) . "')";
			$rsChk = $st_peserta_kelas_kelompok->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_peserta_kelas_kelompok->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// identitas
		$st_peserta_kelas_kelompok->identitas->SetDbValueDef($rsnew, $st_peserta_kelas_kelompok->identitas->CurrentValue, "", FALSE);

		// kode_otomatis
		$st_peserta_kelas_kelompok->kode_otomatis->SetDbValueDef($rsnew, $st_peserta_kelas_kelompok->kode_otomatis->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $st_peserta_kelas_kelompok->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($st_peserta_kelas_kelompok->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($st_peserta_kelas_kelompok->CancelMessage <> "") {
				$this->setFailureMessage($st_peserta_kelas_kelompok->CancelMessage);
				$st_peserta_kelas_kelompok->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$st_peserta_kelas_kelompok->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $st_peserta_kelas_kelompok;
		$st_peserta_kelas_kelompok->identitas->AdvancedSearch->SearchValue = $st_peserta_kelas_kelompok->getAdvancedSearch("x_identitas");
		$st_peserta_kelas_kelompok->kode_otomatis_kelompok->AdvancedSearch->SearchValue = $st_peserta_kelas_kelompok->getAdvancedSearch("x_kode_otomatis_kelompok");
		$st_peserta_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchValue = $st_peserta_kelas_kelompok->getAdvancedSearch("x_kode_otomatis");
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

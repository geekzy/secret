<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_master_kelas_kelompokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "st_peserta2info.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_master_kelas_kelompok_list = new cst_master_kelas_kelompok_list();
$Page =& $st_master_kelas_kelompok_list;

// Page init
$st_master_kelas_kelompok_list->Page_Init();

// Page main
$st_master_kelas_kelompok_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($st_master_kelas_kelompok->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var st_master_kelas_kelompok_list = new ew_Page("st_master_kelas_kelompok_list");

// page properties
st_master_kelas_kelompok_list.PageID = "list"; // page ID
st_master_kelas_kelompok_list.FormID = "fst_master_kelas_kelompoklist"; // form ID
var EW_PAGE_ID = st_master_kelas_kelompok_list.PageID; // for backward compatibility

// extend page with ValidateForm function
st_master_kelas_kelompok_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	var addcnt = 0;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		var chkthisrow = true;
		if (fobj.a_list && fobj.a_list.value == "gridinsert")
			chkthisrow = !(this.EmptyRow(fobj, infix));
		else
			chkthisrow = true;
		if (chkthisrow) {
			addcnt += 1;
		elm = fobj.elements["x" + infix + "_tahun"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_kelas_kelompok->tahun->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kelas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_kelas_kelompok->kelas->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nama_kelas_kelompok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_kelas_kelompok->nama_kelas_kelompok->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_apakah_valid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_kelas_kelompok->apakah_valid->FldCaption()) ?>");

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
		} // End Grid Add checking
	}
	if (fobj.a_list && fobj.a_list.value == "gridinsert" && addcnt == 0) { // No row added
		alert(ewLanguage.Phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Extend page with empty row check
st_master_kelas_kelompok_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "tahun", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kelas", false)) return false;
	if (ew_ValueChanged(fobj, infix, "nama_kelas_kelompok", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kode_otomatis", false)) return false;
	if (ew_ValueChanged(fobj, infix, "apakah_valid", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kode_otomatis_tingkat", false)) return false;
	return true;
}

// extend page with validate function for search
st_master_kelas_kelompok_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
st_master_kelas_kelompok_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
st_master_kelas_kelompok_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
st_master_kelas_kelompok_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_master_kelas_kelompok_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($st_master_kelas_kelompok->Export == "") || (EW_EXPORT_MASTER_RECORD && $st_master_kelas_kelompok->Export == "print")) { ?>
<?php } ?>
<?php
if ($st_master_kelas_kelompok->CurrentAction == "gridadd") {
	$st_master_kelas_kelompok->CurrentFilter = "0=1";
	$st_master_kelas_kelompok_list->StartRec = 1;
	$st_master_kelas_kelompok_list->DisplayRecs = $st_master_kelas_kelompok->GridAddRowCount;
	$st_master_kelas_kelompok_list->TotalRecs = $st_master_kelas_kelompok_list->DisplayRecs;
	$st_master_kelas_kelompok_list->StopRec = $st_master_kelas_kelompok_list->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$st_master_kelas_kelompok_list->TotalRecs = $st_master_kelas_kelompok->SelectRecordCount();
	} else {
		if ($st_master_kelas_kelompok_list->Recordset = $st_master_kelas_kelompok_list->LoadRecordset())
			$st_master_kelas_kelompok_list->TotalRecs = $st_master_kelas_kelompok_list->Recordset->RecordCount();
	}
	$st_master_kelas_kelompok_list->StartRec = 1;
	if ($st_master_kelas_kelompok_list->DisplayRecs <= 0 || ($st_master_kelas_kelompok->Export <> "" && $st_master_kelas_kelompok->ExportAll)) // Display all records
		$st_master_kelas_kelompok_list->DisplayRecs = $st_master_kelas_kelompok_list->TotalRecs;
	if (!($st_master_kelas_kelompok->Export <> "" && $st_master_kelas_kelompok->ExportAll))
		$st_master_kelas_kelompok_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$st_master_kelas_kelompok_list->Recordset = $st_master_kelas_kelompok_list->LoadRecordset($st_master_kelas_kelompok_list->StartRec-1, $st_master_kelas_kelompok_list->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_master_kelas_kelompok->TableCaption() ?>
&nbsp;&nbsp;<?php $st_master_kelas_kelompok_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($st_master_kelas_kelompok->Export == "" && $st_master_kelas_kelompok->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(st_master_kelas_kelompok_list);" style="text-decoration: none;"><img id="st_master_kelas_kelompok_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="st_master_kelas_kelompok_list_SearchPanel">
<form name="fst_master_kelas_kelompoklistsrch" id="fst_master_kelas_kelompoklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return st_master_kelas_kelompok_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="st_master_kelas_kelompok">
<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$st_master_kelas_kelompok_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$st_master_kelas_kelompok->RowType = EW_ROWTYPE_SEARCH;

// Render row
$st_master_kelas_kelompok->ResetAttrs();
$st_master_kelas_kelompok_list->RenderRow();
?>
<div id="xsr_1" class="ewCssTableRow">
	<span id="xsc_tahun" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $st_master_kelas_kelompok->tahun->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_tahun" id="z_tahun" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" name="x_tahun" id="x_tahun" size="30" maxlength="4" value="<?php echo $st_master_kelas_kelompok->tahun->EditValue ?>"<?php echo $st_master_kelas_kelompok->tahun->EditAttributes() ?>>
</span>
	</span>
</div>
<div id="xsr_2" class="ewCssTableRow">
	<span id="xsc_apakah_valid" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $st_master_kelas_kelompok->apakah_valid->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_apakah_valid" id="z_apakah_valid" value="LIKE"></span>
		<span class="ewSearchField">
<select id="x_apakah_valid" name="x_apakah_valid"<?php echo $st_master_kelas_kelompok->apakah_valid->EditAttributes() ?>>
<?php
if (is_array($st_master_kelas_kelompok->apakah_valid->EditValue)) {
	$arwrk = $st_master_kelas_kelompok->apakah_valid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_master_kelas_kelompok->apakah_valid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $st_master_kelas_kelompok->apakah_valid->OldValue = "";
?>
</select>
</span>
	</span>
</div>
<div id="xsr_3" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $st_master_kelas_kelompok_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
	<a href="st_master_kelas_kelompoksrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
</div>
<div id="xsr_4" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($st_master_kelas_kelompok->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($st_master_kelas_kelompok->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($st_master_kelas_kelompok->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $st_master_kelas_kelompok_list->ShowPageHeader(); ?>
<?php
$st_master_kelas_kelompok_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($st_master_kelas_kelompok->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($st_master_kelas_kelompok->CurrentAction <> "gridadd" && $st_master_kelas_kelompok->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($st_master_kelas_kelompok_list->Pager)) $st_master_kelas_kelompok_list->Pager = new cNumericPager($st_master_kelas_kelompok_list->StartRec, $st_master_kelas_kelompok_list->DisplayRecs, $st_master_kelas_kelompok_list->TotalRecs, $st_master_kelas_kelompok_list->RecRange) ?>
<?php if ($st_master_kelas_kelompok_list->Pager->RecordCount > 0) { ?>
	<?php if ($st_master_kelas_kelompok_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $st_master_kelas_kelompok_list->PageUrl() ?>start=<?php echo $st_master_kelas_kelompok_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($st_master_kelas_kelompok_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $st_master_kelas_kelompok_list->PageUrl() ?>start=<?php echo $st_master_kelas_kelompok_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($st_master_kelas_kelompok_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $st_master_kelas_kelompok_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($st_master_kelas_kelompok_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $st_master_kelas_kelompok_list->PageUrl() ?>start=<?php echo $st_master_kelas_kelompok_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($st_master_kelas_kelompok_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $st_master_kelas_kelompok_list->PageUrl() ?>start=<?php echo $st_master_kelas_kelompok_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($st_master_kelas_kelompok_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $st_master_kelas_kelompok_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $st_master_kelas_kelompok_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $st_master_kelas_kelompok_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($st_master_kelas_kelompok_list->SearchWhere == "0=101") { ?>
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
<?php if ($st_master_kelas_kelompok_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="st_master_kelas_kelompok">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($st_master_kelas_kelompok_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($st_master_kelas_kelompok_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($st_master_kelas_kelompok_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($st_master_kelas_kelompok_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($st_master_kelas_kelompok_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($st_master_kelas_kelompok_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($st_master_kelas_kelompok_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($st_master_kelas_kelompok_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($st_master_kelas_kelompok_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($st_master_kelas_kelompok->CurrentAction <> "gridadd" && $st_master_kelas_kelompok->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $st_master_kelas_kelompok_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a class="ewGridLink" href="<?php echo $st_master_kelas_kelompok_list->GridAddUrl ?>"><?php echo $Language->Phrase("GridAddLink") ?></a>&nbsp;&nbsp;
<?php if ($st_peserta2->DetailAdd && $Security->AllowAdd('st_peserta2')) { ?>
<a class="ewGridLink" href="<?php echo $st_master_kelas_kelompok->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=st_peserta2" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $st_master_kelas_kelompok->TableCaption() ?>/<?php echo $st_peserta2->TableCaption() ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($st_master_kelas_kelompok->CurrentAction == "gridadd") { ?>
<?php if ($st_master_kelas_kelompok->AllowAddDeleteRow) { ?>
<a class="ewGridLink" href="javascript:void(0);" onclick="ew_AddGridRow(this);"><img src='phpimages/addblankrow.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("AddBlankRow")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("AddBlankRow")) ?>' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<a class="ewGridLink" href="" onclick="return ew_SubmitForm(st_master_kelas_kelompok_list, document.fst_master_kelas_kelompoklist);"><img src='phpimages/insert.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("GridInsertLink")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("GridInsertLink")) ?>' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<a class="ewGridLink" href="<?php echo $st_master_kelas_kelompok_list->PageUrl() ?>a=cancel"><img src='phpimages/cancel.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("GridCancelLink")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("GridCancelLink")) ?>' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fst_master_kelas_kelompoklist" id="fst_master_kelas_kelompoklist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="st_master_kelas_kelompok">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_st_master_kelas_kelompok" class="ewGridMiddlePanel">
<?php if ($st_master_kelas_kelompok_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $st_master_kelas_kelompok->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$st_master_kelas_kelompok_list->RenderListOptions();

// Render list options (header, left)
$st_master_kelas_kelompok_list->ListOptions->Render("header", "left");
?>
<?php if ($st_master_kelas_kelompok->tahun->Visible) { // tahun ?>
	<?php if ($st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->tahun) == "") { ?>
		<td><?php echo $st_master_kelas_kelompok->tahun->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->tahun) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_kelas_kelompok->tahun->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($st_master_kelas_kelompok->tahun->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_kelas_kelompok->tahun->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_master_kelas_kelompok->kelas->Visible) { // kelas ?>
	<?php if ($st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->kelas) == "") { ?>
		<td><?php echo $st_master_kelas_kelompok->kelas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->kelas) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_kelas_kelompok->kelas->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_master_kelas_kelompok->kelas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_kelas_kelompok->kelas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_master_kelas_kelompok->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
	<?php if ($st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->nama_kelas_kelompok) == "") { ?>
		<td><?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->nama_kelas_kelompok) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($st_master_kelas_kelompok->nama_kelas_kelompok->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_kelas_kelompok->nama_kelas_kelompok->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_master_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->kode_otomatis) == "") { ?>
		<td><?php echo $st_master_kelas_kelompok->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->kode_otomatis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_kelas_kelompok->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_master_kelas_kelompok->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_kelas_kelompok->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_master_kelas_kelompok->apakah_valid->Visible) { // apakah_valid ?>
	<?php if ($st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->apakah_valid) == "") { ?>
		<td><?php echo $st_master_kelas_kelompok->apakah_valid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->apakah_valid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_kelas_kelompok->apakah_valid->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_master_kelas_kelompok->apakah_valid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_kelas_kelompok->apakah_valid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_master_kelas_kelompok->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
	<?php if ($st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->kode_otomatis_tingkat) == "") { ?>
		<td><?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $st_master_kelas_kelompok->SortUrl($st_master_kelas_kelompok->kode_otomatis_tingkat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_master_kelas_kelompok->kode_otomatis_tingkat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_master_kelas_kelompok->kode_otomatis_tingkat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$st_master_kelas_kelompok_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($st_master_kelas_kelompok->ExportAll && $st_master_kelas_kelompok->Export <> "") {
	$st_master_kelas_kelompok_list->StopRec = $st_master_kelas_kelompok_list->TotalRecs;
} else {

	// Set the last record to display
	if ($st_master_kelas_kelompok_list->TotalRecs > $st_master_kelas_kelompok_list->StartRec + $st_master_kelas_kelompok_list->DisplayRecs - 1)
		$st_master_kelas_kelompok_list->StopRec = $st_master_kelas_kelompok_list->StartRec + $st_master_kelas_kelompok_list->DisplayRecs - 1;
	else
		$st_master_kelas_kelompok_list->StopRec = $st_master_kelas_kelompok_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($st_master_kelas_kelompok->CurrentAction == "gridadd" || $st_master_kelas_kelompok->CurrentAction == "gridedit" || $st_master_kelas_kelompok->CurrentAction == "F")) {
		$st_master_kelas_kelompok_list->KeyCount = $objForm->GetValue("key_count");
		$st_master_kelas_kelompok_list->StopRec = $st_master_kelas_kelompok_list->KeyCount;
	}
}
$st_master_kelas_kelompok_list->RecCnt = $st_master_kelas_kelompok_list->StartRec - 1;
if ($st_master_kelas_kelompok_list->Recordset && !$st_master_kelas_kelompok_list->Recordset->EOF) {
	$st_master_kelas_kelompok_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $st_master_kelas_kelompok_list->StartRec > 1)
		$st_master_kelas_kelompok_list->Recordset->Move($st_master_kelas_kelompok_list->StartRec - 1);
} elseif (!$st_master_kelas_kelompok->AllowAddDeleteRow && $st_master_kelas_kelompok_list->StopRec == 0) {
	$st_master_kelas_kelompok_list->StopRec = $st_master_kelas_kelompok->GridAddRowCount;
}

// Initialize aggregate
$st_master_kelas_kelompok->RowType = EW_ROWTYPE_AGGREGATEINIT;
$st_master_kelas_kelompok->ResetAttrs();
$st_master_kelas_kelompok_list->RenderRow();
$st_master_kelas_kelompok_list->RowCnt = 0;
if ($st_master_kelas_kelompok->CurrentAction == "gridadd")
	$st_master_kelas_kelompok_list->RowIndex = 0;
while ($st_master_kelas_kelompok_list->RecCnt < $st_master_kelas_kelompok_list->StopRec) {
	$st_master_kelas_kelompok_list->RecCnt++;
	if (intval($st_master_kelas_kelompok_list->RecCnt) >= intval($st_master_kelas_kelompok_list->StartRec)) {
		$st_master_kelas_kelompok_list->RowCnt++;
		if ($st_master_kelas_kelompok->CurrentAction == "gridadd" || $st_master_kelas_kelompok->CurrentAction == "gridedit" || $st_master_kelas_kelompok->CurrentAction == "F")
			$st_master_kelas_kelompok_list->RowIndex++;

		// Set up key count
		$st_master_kelas_kelompok_list->KeyCount = $st_master_kelas_kelompok_list->RowIndex;

		// Init row class and style
		$st_master_kelas_kelompok->ResetAttrs();
		$st_master_kelas_kelompok->CssClass = "";
		if ($st_master_kelas_kelompok->CurrentAction == "gridadd") {
			$st_master_kelas_kelompok_list->LoadDefaultValues(); // Load default values
		} else {
			$st_master_kelas_kelompok_list->LoadRowValues($st_master_kelas_kelompok_list->Recordset); // Load row values
		}
		$st_master_kelas_kelompok->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($st_master_kelas_kelompok->CurrentAction == "gridadd") // Grid add
			$st_master_kelas_kelompok->RowType = EW_ROWTYPE_ADD; // Render add
		if ($st_master_kelas_kelompok->CurrentAction == "gridadd" && $st_master_kelas_kelompok->EventCancelled) // Insert failed
			$st_master_kelas_kelompok_list->RestoreCurrentRowFormValues($st_master_kelas_kelompok_list->RowIndex); // Restore form values
		$st_master_kelas_kelompok->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$st_master_kelas_kelompok_list->RenderRow();

		// Render list options
		$st_master_kelas_kelompok_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($st_master_kelas_kelompok_list->RowAction <> "delete" && $st_master_kelas_kelompok_list->RowAction <> "insertdelete" && !($st_master_kelas_kelompok_list->RowAction == "insert" && $st_master_kelas_kelompok->CurrentAction == "F" && $st_master_kelas_kelompok_list->EmptyRow())) {
?>
	<tr<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
<?php

// Render list options (body, left)
$st_master_kelas_kelompok_list->ListOptions->Render("body", "left");
?>
	<?php if ($st_master_kelas_kelompok->tahun->Visible) { // tahun ?>
		<td<?php echo $st_master_kelas_kelompok->tahun->CellAttributes() ?>>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_tahun" id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_tahun" size="30" maxlength="4" value="<?php echo $st_master_kelas_kelompok->tahun->EditValue ?>"<?php echo $st_master_kelas_kelompok->tahun->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_tahun" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_tahun" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->tahun->OldValue) ?>">
<?php } ?>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $st_master_kelas_kelompok->tahun->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->tahun->ListViewValue() ?></div>
<?php } ?>
<a name="<?php echo $st_master_kelas_kelompok_list->PageObjName . "_row_" . $st_master_kelas_kelompok_list->RowCnt ?>" id="<?php echo $st_master_kelas_kelompok_list->PageObjName . "_row_" . $st_master_kelas_kelompok_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($st_master_kelas_kelompok->kelas->Visible) { // kelas ?>
		<td<?php echo $st_master_kelas_kelompok->kelas->CellAttributes() ?>>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kelas" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kelas"<?php echo $st_master_kelas_kelompok->kelas->EditAttributes() ?>>
<?php
if (is_array($st_master_kelas_kelompok->kelas->EditValue)) {
	$arwrk = $st_master_kelas_kelompok->kelas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_master_kelas_kelompok->kelas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $st_master_kelas_kelompok->kelas->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kelas" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kelas" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kelas->OldValue) ?>">
<?php } ?>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $st_master_kelas_kelompok->kelas->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->kelas->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($st_master_kelas_kelompok->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
		<td<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->CellAttributes() ?>>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_nama_kelas_kelompok" id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_nama_kelas_kelompok" size="30" maxlength="50" value="<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->EditValue ?>"<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_nama_kelas_kelompok" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_nama_kelas_kelompok" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->nama_kelas_kelompok->OldValue) ?>">
<?php } ?>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($st_master_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $st_master_kelas_kelompok->kode_otomatis->CellAttributes() ?>>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis" id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis->OldValue) ?>">
<?php } ?>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $st_master_kelas_kelompok->kode_otomatis->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->kode_otomatis->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($st_master_kelas_kelompok->apakah_valid->Visible) { // apakah_valid ?>
		<td<?php echo $st_master_kelas_kelompok->apakah_valid->CellAttributes() ?>>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_apakah_valid" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_apakah_valid"<?php echo $st_master_kelas_kelompok->apakah_valid->EditAttributes() ?>>
<?php
if (is_array($st_master_kelas_kelompok->apakah_valid->EditValue)) {
	$arwrk = $st_master_kelas_kelompok->apakah_valid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_master_kelas_kelompok->apakah_valid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $st_master_kelas_kelompok->apakah_valid->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_apakah_valid" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_apakah_valid" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->apakah_valid->OldValue) ?>">
<?php } ?>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $st_master_kelas_kelompok->apakah_valid->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->apakah_valid->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($st_master_kelas_kelompok->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<td<?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->CellAttributes() ?>>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis_tingkat" id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis_tingkat" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis_tingkat->OldValue) ?>">
<?php } ?>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $st_master_kelas_kelompok->kode_otomatis_tingkat->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$st_master_kelas_kelompok_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($st_master_kelas_kelompok->CurrentAction <> "gridadd")
		if (!$st_master_kelas_kelompok_list->Recordset->EOF) $st_master_kelas_kelompok_list->Recordset->MoveNext();
}
?>
<?php
	if ($st_master_kelas_kelompok->CurrentAction == "gridadd" || $st_master_kelas_kelompok->CurrentAction == "gridedit") {
		$st_master_kelas_kelompok_list->RowIndex = '$rowindex$';
		$st_master_kelas_kelompok_list->LoadDefaultValues();

		// Set row properties
		$st_master_kelas_kelompok->ResetAttrs();
		$st_master_kelas_kelompok->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($st_master_kelas_kelompok_list->RowIndex))
			$st_master_kelas_kelompok->RowAttrs = array_merge($st_master_kelas_kelompok->RowAttrs, array('data-rowindex'=>$st_master_kelas_kelompok_list->RowIndex, 'id'=>'r' . $st_master_kelas_kelompok_list->RowIndex . '_st_master_kelas_kelompok'));
		$st_master_kelas_kelompok->RowType = EW_ROWTYPE_ADD;

		// Render row
		$st_master_kelas_kelompok_list->RenderRow();

		// Render list options
		$st_master_kelas_kelompok_list->RenderListOptions();

		// Add id and class to the template row
		$st_master_kelas_kelompok->RowAttrs["id"] = "r0_st_master_kelas_kelompok";
		ew_AppendClass($st_master_kelas_kelompok->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $st_master_kelas_kelompok->RowAttributes() ?>>
<?php

// Render list options (body, left)
$st_master_kelas_kelompok_list->ListOptions->Render("body", "left");
?>
	<?php if ($st_master_kelas_kelompok->tahun->Visible) { // tahun ?>
		<td>
<input type="text" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_tahun" id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_tahun" size="30" maxlength="4" value="<?php echo $st_master_kelas_kelompok->tahun->EditValue ?>"<?php echo $st_master_kelas_kelompok->tahun->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_tahun" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_tahun" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->tahun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($st_master_kelas_kelompok->kelas->Visible) { // kelas ?>
		<td>
<select id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kelas" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kelas"<?php echo $st_master_kelas_kelompok->kelas->EditAttributes() ?>>
<?php
if (is_array($st_master_kelas_kelompok->kelas->EditValue)) {
	$arwrk = $st_master_kelas_kelompok->kelas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_master_kelas_kelompok->kelas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $st_master_kelas_kelompok->kelas->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kelas" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kelas" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kelas->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($st_master_kelas_kelompok->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
		<td>
<input type="text" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_nama_kelas_kelompok" id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_nama_kelas_kelompok" size="30" maxlength="50" value="<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->EditValue ?>"<?php echo $st_master_kelas_kelompok->nama_kelas_kelompok->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_nama_kelas_kelompok" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_nama_kelas_kelompok" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->nama_kelas_kelompok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($st_master_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
		<td>
<input type="hidden" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis" id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($st_master_kelas_kelompok->apakah_valid->Visible) { // apakah_valid ?>
		<td>
<select id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_apakah_valid" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_apakah_valid"<?php echo $st_master_kelas_kelompok->apakah_valid->EditAttributes() ?>>
<?php
if (is_array($st_master_kelas_kelompok->apakah_valid->EditValue)) {
	$arwrk = $st_master_kelas_kelompok->apakah_valid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_master_kelas_kelompok->apakah_valid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $st_master_kelas_kelompok->apakah_valid->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_apakah_valid" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_apakah_valid" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->apakah_valid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($st_master_kelas_kelompok->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<td>
<input type="hidden" name="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis_tingkat" id="x<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis_tingkat" id="o<?php echo $st_master_kelas_kelompok_list->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis_tingkat->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$st_master_kelas_kelompok_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($st_master_kelas_kelompok->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $st_master_kelas_kelompok_list->KeyCount ?>">
<?php echo $st_master_kelas_kelompok_list->MultiSelectKey ?>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($st_master_kelas_kelompok_list->Recordset)
	$st_master_kelas_kelompok_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($st_master_kelas_kelompok->Export == "" && $st_master_kelas_kelompok->CurrentAction == "") { ?>
<?php } ?>
<?php
$st_master_kelas_kelompok_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($st_master_kelas_kelompok->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$st_master_kelas_kelompok_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_master_kelas_kelompok_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'st_master_kelas_kelompok';

	// Page object name
	var $PageObjName = 'st_master_kelas_kelompok_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_master_kelas_kelompok;
		if ($st_master_kelas_kelompok->UseTokenInUrl) $PageUrl .= "t=" . $st_master_kelas_kelompok->TableVar . "&"; // Add page token
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
		global $objForm, $st_master_kelas_kelompok;
		if ($st_master_kelas_kelompok->UseTokenInUrl) {
			if ($objForm)
				return ($st_master_kelas_kelompok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_master_kelas_kelompok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_master_kelas_kelompok_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_master_kelas_kelompok)
		if (!isset($GLOBALS["st_master_kelas_kelompok"])) {
			$GLOBALS["st_master_kelas_kelompok"] = new cst_master_kelas_kelompok();
			$GLOBALS["Table"] =& $GLOBALS["st_master_kelas_kelompok"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "st_master_kelas_kelompokadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "st_master_kelas_kelompokdelete.php";
		$this->MultiUpdateUrl = "st_master_kelas_kelompokupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (st_peserta2)
		if (!isset($GLOBALS['st_peserta2'])) $GLOBALS['st_peserta2'] = new cst_peserta2();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_master_kelas_kelompok', TRUE);

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
		global $st_master_kelas_kelompok;

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

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$st_master_kelas_kelompok->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$st_master_kelas_kelompok->Export = $_POST["exporttype"];
		} else {
			$st_master_kelas_kelompok->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $st_master_kelas_kelompok->Export; // Get export parameter, used in header
		$gsExportFile = $st_master_kelas_kelompok->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($st_master_kelas_kelompok->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($st_master_kelas_kelompok->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$st_master_kelas_kelompok->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $st_master_kelas_kelompok;

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
				$st_master_kelas_kelompok->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($st_master_kelas_kelompok->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid add mode
				if ($st_master_kelas_kelompok->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$st_master_kelas_kelompok->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Insert
					if ($st_master_kelas_kelompok->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd") {
						if ($this->ValidateGridForm()) {
							$this->GridInsert();
						} else {
							$this->setFailureMessage($gsFormError);
							$st_master_kelas_kelompok->EventCancelled = TRUE;
							$st_master_kelas_kelompok->CurrentAction = "gridadd"; // Stay in Grid Add mode
						}
					}
				}
			}

			// Hide all options
			if ($st_master_kelas_kelompok->Export <> "" ||
				$st_master_kelas_kelompok->CurrentAction == "gridadd" ||
				$st_master_kelas_kelompok->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($st_master_kelas_kelompok->AllowAddDeleteRow) {
				if ($st_master_kelas_kelompok->CurrentAction == "gridadd" ||
					$st_master_kelas_kelompok->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
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
			$st_master_kelas_kelompok->Recordset_SearchValidated();

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
		if ($st_master_kelas_kelompok->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $st_master_kelas_kelompok->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$st_master_kelas_kelompok->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$st_master_kelas_kelompok->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $st_master_kelas_kelompok->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$st_master_kelas_kelompok->setSessionWhere($sFilter);
		$st_master_kelas_kelompok->CurrentFilter = "";

		// Export selected records
		if ($st_master_kelas_kelompok->Export <> "")
			$st_master_kelas_kelompok->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($st_master_kelas_kelompok->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($st_master_kelas_kelompok->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $st_master_kelas_kelompok;
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
			$st_master_kelas_kelompok->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $st_master_kelas_kelompok;
		$st_master_kelas_kelompok->LastAction = $st_master_kelas_kelompok->CurrentAction; // Save last action
		$st_master_kelas_kelompok->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $st_master_kelas_kelompok;
		$rowindex = 1;
		$bGridInsert = FALSE;

		// Begin transaction
		$conn->BeginTrans();

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$st_master_kelas_kelompok->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $st_master_kelas_kelompok->kode_otomatis->CurrentValue;

					// Add filter for this record
					$sFilter = $st_master_kelas_kelompok->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->Phrase("NoAddRecord"));
			$bGridInsert = FALSE;
		}
		if ($bGridInsert) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$st_master_kelas_kelompok->CurrentFilter = $sWrkFilter;
			$sSql = $st_master_kelas_kelompok->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->setSuccessMessage($Language->Phrase("InsertSuccess")); // Set insert success message
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$st_master_kelas_kelompok->EventCancelled = TRUE; // Set event cancelled
			$st_master_kelas_kelompok->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $st_master_kelas_kelompok, $objForm;
		if ($objForm->HasValue("x_tahun") && $objForm->HasValue("o_tahun") && $st_master_kelas_kelompok->tahun->CurrentValue <> $st_master_kelas_kelompok->tahun->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kelas") && $objForm->HasValue("o_kelas") && $st_master_kelas_kelompok->kelas->CurrentValue <> $st_master_kelas_kelompok->kelas->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_nama_kelas_kelompok") && $objForm->HasValue("o_nama_kelas_kelompok") && $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue <> $st_master_kelas_kelompok->nama_kelas_kelompok->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_otomatis") && $objForm->HasValue("o_kode_otomatis") && $st_master_kelas_kelompok->kode_otomatis->CurrentValue <> $st_master_kelas_kelompok->kode_otomatis->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_apakah_valid") && $objForm->HasValue("o_apakah_valid") && $st_master_kelas_kelompok->apakah_valid->CurrentValue <> $st_master_kelas_kelompok->apakah_valid->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_otomatis_tingkat") && $objForm->HasValue("o_kode_otomatis_tingkat") && $st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue <> $st_master_kelas_kelompok->kode_otomatis_tingkat->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $st_master_kelas_kelompok;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $st_master_kelas_kelompok;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $st_master_kelas_kelompok->tahun, FALSE); // tahun
		$this->BuildSearchSql($sWhere, $st_master_kelas_kelompok->kelas, FALSE); // kelas
		$this->BuildSearchSql($sWhere, $st_master_kelas_kelompok->nama_kelas_kelompok, FALSE); // nama_kelas_kelompok
		$this->BuildSearchSql($sWhere, $st_master_kelas_kelompok->kode_otomatis, FALSE); // kode_otomatis
		$this->BuildSearchSql($sWhere, $st_master_kelas_kelompok->apakah_valid, FALSE); // apakah_valid
		$this->BuildSearchSql($sWhere, $st_master_kelas_kelompok->kode_otomatis_tingkat, FALSE); // kode_otomatis_tingkat

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($st_master_kelas_kelompok->tahun); // tahun
			$this->SetSearchParm($st_master_kelas_kelompok->kelas); // kelas
			$this->SetSearchParm($st_master_kelas_kelompok->nama_kelas_kelompok); // nama_kelas_kelompok
			$this->SetSearchParm($st_master_kelas_kelompok->kode_otomatis); // kode_otomatis
			$this->SetSearchParm($st_master_kelas_kelompok->apakah_valid); // apakah_valid
			$this->SetSearchParm($st_master_kelas_kelompok->kode_otomatis_tingkat); // kode_otomatis_tingkat
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
		global $st_master_kelas_kelompok;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$st_master_kelas_kelompok->setAdvancedSearch("x_$FldParm", $FldVal);
		$st_master_kelas_kelompok->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$st_master_kelas_kelompok->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$st_master_kelas_kelompok->setAdvancedSearch("y_$FldParm", $FldVal2);
		$st_master_kelas_kelompok->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $st_master_kelas_kelompok;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $st_master_kelas_kelompok->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $st_master_kelas_kelompok->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $st_master_kelas_kelompok->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $st_master_kelas_kelompok->getAdvancedSearch("w_$FldParm");
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
		global $st_master_kelas_kelompok;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $st_master_kelas_kelompok->tahun, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_master_kelas_kelompok->kelas, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_master_kelas_kelompok->nama_kelas_kelompok, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_master_kelas_kelompok->kode_otomatis, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_master_kelas_kelompok->apakah_valid, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $st_master_kelas_kelompok->kode_otomatis_tingkat, $Keyword);
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
		global $Security, $st_master_kelas_kelompok;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $st_master_kelas_kelompok->BasicSearchKeyword;
		$sSearchType = $st_master_kelas_kelompok->BasicSearchType;
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
			$st_master_kelas_kelompok->setSessionBasicSearchKeyword($sSearchKeyword);
			$st_master_kelas_kelompok->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $st_master_kelas_kelompok;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$st_master_kelas_kelompok->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $st_master_kelas_kelompok;
		$st_master_kelas_kelompok->setSessionBasicSearchKeyword("");
		$st_master_kelas_kelompok->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $st_master_kelas_kelompok;
		$st_master_kelas_kelompok->setAdvancedSearch("x_tahun", "");
		$st_master_kelas_kelompok->setAdvancedSearch("x_kelas", "");
		$st_master_kelas_kelompok->setAdvancedSearch("x_nama_kelas_kelompok", "");
		$st_master_kelas_kelompok->setAdvancedSearch("x_kode_otomatis", "");
		$st_master_kelas_kelompok->setAdvancedSearch("x_apakah_valid", "");
		$st_master_kelas_kelompok->setAdvancedSearch("x_kode_otomatis_tingkat", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $st_master_kelas_kelompok;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_tahun"] <> "") $bRestore = FALSE;
		if (@$_GET["x_kelas"] <> "") $bRestore = FALSE;
		if (@$_GET["x_nama_kelas_kelompok"] <> "") $bRestore = FALSE;
		if (@$_GET["x_kode_otomatis"] <> "") $bRestore = FALSE;
		if (@$_GET["x_apakah_valid"] <> "") $bRestore = FALSE;
		if (@$_GET["x_kode_otomatis_tingkat"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$st_master_kelas_kelompok->BasicSearchKeyword = $st_master_kelas_kelompok->getSessionBasicSearchKeyword();
			$st_master_kelas_kelompok->BasicSearchType = $st_master_kelas_kelompok->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($st_master_kelas_kelompok->tahun);
			$this->GetSearchParm($st_master_kelas_kelompok->kelas);
			$this->GetSearchParm($st_master_kelas_kelompok->nama_kelas_kelompok);
			$this->GetSearchParm($st_master_kelas_kelompok->kode_otomatis);
			$this->GetSearchParm($st_master_kelas_kelompok->apakah_valid);
			$this->GetSearchParm($st_master_kelas_kelompok->kode_otomatis_tingkat);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $st_master_kelas_kelompok;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$st_master_kelas_kelompok->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$st_master_kelas_kelompok->CurrentOrderType = @$_GET["ordertype"];
			$st_master_kelas_kelompok->UpdateSort($st_master_kelas_kelompok->tahun); // tahun
			$st_master_kelas_kelompok->UpdateSort($st_master_kelas_kelompok->kelas); // kelas
			$st_master_kelas_kelompok->UpdateSort($st_master_kelas_kelompok->nama_kelas_kelompok); // nama_kelas_kelompok
			$st_master_kelas_kelompok->UpdateSort($st_master_kelas_kelompok->kode_otomatis); // kode_otomatis
			$st_master_kelas_kelompok->UpdateSort($st_master_kelas_kelompok->apakah_valid); // apakah_valid
			$st_master_kelas_kelompok->UpdateSort($st_master_kelas_kelompok->kode_otomatis_tingkat); // kode_otomatis_tingkat
			$st_master_kelas_kelompok->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $st_master_kelas_kelompok;
		$sOrderBy = $st_master_kelas_kelompok->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($st_master_kelas_kelompok->SqlOrderBy() <> "") {
				$sOrderBy = $st_master_kelas_kelompok->SqlOrderBy();
				$st_master_kelas_kelompok->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $st_master_kelas_kelompok;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$st_master_kelas_kelompok->setSessionOrderBy($sOrderBy);
				$st_master_kelas_kelompok->tahun->setSort("");
				$st_master_kelas_kelompok->kelas->setSort("");
				$st_master_kelas_kelompok->nama_kelas_kelompok->setSort("");
				$st_master_kelas_kelompok->kode_otomatis->setSort("");
				$st_master_kelas_kelompok->apakah_valid->setSort("");
				$st_master_kelas_kelompok->kode_otomatis_tingkat->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $st_master_kelas_kelompok;

		// "griddelete"
		if ($st_master_kelas_kelompok->AllowAddDeleteRow) {
			$item =& $this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

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

		// "detail_st_peserta2"
		$item =& $this->ListOptions->Add("detail_st_peserta2");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('st_peserta2');
		$item->OnLeft = TRUE;

		// "checkbox"
		$item =& $this->ListOptions->Add("checkbox");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"st_master_kelas_kelompok_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $st_master_kelas_kelompok, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD)
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

		// "delete"
		if ($st_master_kelas_kelompok->AllowAddDeleteRow) {
			if ($st_master_kelas_kelompok->CurrentAction == "gridadd" || $st_master_kelas_kelompok->CurrentAction == "gridedit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, st_master_kelas_kelompok_list, " . $this->RowIndex . ");\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
				}
			}
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

		// "detail_st_peserta2"
		$oListOpt =& $this->ListOptions->Items["detail_st_peserta2"];
		if ($Security->AllowList('st_peserta2')) {
			$oListOpt->Body = "<img src=\"phpimages/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("st_peserta2", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"st_peserta2list.php?" . EW_TABLE_SHOW_MASTER . "=st_master_kelas_kelompok&kode_otomatis=" . urlencode(strval($st_master_kelas_kelompok->kode_otomatis->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($GLOBALS["st_peserta2"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit('st_peserta2'))
				$links .= "<a class=\"ewRowLink\" href=\"" . $st_master_kelas_kelompok->EditUrl(EW_TABLE_SHOW_DETAIL . "=st_peserta2") . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>&nbsp;";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $st_master_kelas_kelompok;
		$sSqlWrk = "st_peserta_kelas_kelompok.kode_otomatis_kelompok='" . ew_AdjustSql($st_master_kelas_kelompok->kode_otomatis->CurrentValue) . "'";
		$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
		$sSqlWrk = str_replace("'", "\'", $sSqlWrk);
		$sHyperLinkParm = " href=\"st_peserta2list.php?" . EW_TABLE_SHOW_MASTER . "=st_master_kelas_kelompok&kode_otomatis=" . urlencode(strval($st_master_kelas_kelompok->kode_otomatis->CurrentValue)) . "\"";
		$oListOpt =& $this->ListOptions->Items["detail_st_peserta2"];
		$oListOpt->Body = $Language->TablePhrase("st_peserta2", "TblCaption");
		$oListOpt->Body = "<a class=\"ewRowLink\"" . $sHyperLinkParm . ">" . $oListOpt->Body . "</a>";
		$sHyperLinkParm = " href=\"javascript:void(0);\" name=\"dl%i_st_master_kelas_kelompok_st_peserta2\" id=\"dl%i_st_master_kelas_kelompok_st_peserta2\" onclick=\"ew_AjaxShowDetails2(event, this, 'st_peserta2preview.php?f=%s')\"";		
		$sHyperLinkParm = str_replace("%i", $this->RowCnt, $sHyperLinkParm);
		$sHyperLinkParm = str_replace("%s", $sSqlWrk, $sHyperLinkParm);
		$oListOpt->Body = "<a" . $sHyperLinkParm . "><img class=\"ewPreviewRowImage\" src=\"phpimages/expand.gif\" width=\"9\" height=\"9\" border=\"0\"></a>&nbsp;" . $oListOpt->Body;
		$links = "";
		if ($GLOBALS["st_peserta2"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit('st_peserta2'))
			$links .= "<a class=\"ewRowLink\" href=\"" . $st_master_kelas_kelompok->EditUrl(EW_TABLE_SHOW_DETAIL . "=st_peserta2") . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>&nbsp;";
		if ($links <> "") $oListOpt->Body .= "<br>" . $links;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $st_master_kelas_kelompok;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $st_master_kelas_kelompok->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$st_master_kelas_kelompok->setStartRecordNumber($this->StartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $st_master_kelas_kelompok;
		$st_master_kelas_kelompok->tahun->CurrentValue = NULL;
		$st_master_kelas_kelompok->tahun->OldValue = $st_master_kelas_kelompok->tahun->CurrentValue;
		$st_master_kelas_kelompok->kelas->CurrentValue = NULL;
		$st_master_kelas_kelompok->kelas->OldValue = $st_master_kelas_kelompok->kelas->CurrentValue;
		$st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue = NULL;
		$st_master_kelas_kelompok->nama_kelas_kelompok->OldValue = $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue;
		$st_master_kelas_kelompok->kode_otomatis->CurrentValue = unik();
		$st_master_kelas_kelompok->kode_otomatis->OldValue = $st_master_kelas_kelompok->kode_otomatis->CurrentValue;
		$st_master_kelas_kelompok->apakah_valid->CurrentValue = NULL;
		$st_master_kelas_kelompok->apakah_valid->OldValue = $st_master_kelas_kelompok->apakah_valid->CurrentValue;
		$st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue = $_SESSION["kode_otomatis_tingkat"];
		$st_master_kelas_kelompok->kode_otomatis_tingkat->OldValue = $st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue;
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $st_master_kelas_kelompok;
		$st_master_kelas_kelompok->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$st_master_kelas_kelompok->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $st_master_kelas_kelompok;

		// Load search values
		// tahun

		$st_master_kelas_kelompok->tahun->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_tahun"]);
		$st_master_kelas_kelompok->tahun->AdvancedSearch->SearchOperator = @$_GET["z_tahun"];

		// kelas
		$st_master_kelas_kelompok->kelas->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_kelas"]);
		$st_master_kelas_kelompok->kelas->AdvancedSearch->SearchOperator = @$_GET["z_kelas"];

		// nama_kelas_kelompok
		$st_master_kelas_kelompok->nama_kelas_kelompok->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_nama_kelas_kelompok"]);
		$st_master_kelas_kelompok->nama_kelas_kelompok->AdvancedSearch->SearchOperator = @$_GET["z_nama_kelas_kelompok"];

		// kode_otomatis
		$st_master_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_kode_otomatis"]);
		$st_master_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchOperator = @$_GET["z_kode_otomatis"];

		// apakah_valid
		$st_master_kelas_kelompok->apakah_valid->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_apakah_valid"]);
		$st_master_kelas_kelompok->apakah_valid->AdvancedSearch->SearchOperator = @$_GET["z_apakah_valid"];

		// kode_otomatis_tingkat
		$st_master_kelas_kelompok->kode_otomatis_tingkat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_kode_otomatis_tingkat"]);
		$st_master_kelas_kelompok->kode_otomatis_tingkat->AdvancedSearch->SearchOperator = @$_GET["z_kode_otomatis_tingkat"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $st_master_kelas_kelompok;
		if (!$st_master_kelas_kelompok->tahun->FldIsDetailKey) {
			$st_master_kelas_kelompok->tahun->setFormValue($objForm->GetValue("x_tahun"));
		}
		$st_master_kelas_kelompok->tahun->setOldValue($objForm->GetValue("o_tahun"));
		if (!$st_master_kelas_kelompok->kelas->FldIsDetailKey) {
			$st_master_kelas_kelompok->kelas->setFormValue($objForm->GetValue("x_kelas"));
		}
		$st_master_kelas_kelompok->kelas->setOldValue($objForm->GetValue("o_kelas"));
		if (!$st_master_kelas_kelompok->nama_kelas_kelompok->FldIsDetailKey) {
			$st_master_kelas_kelompok->nama_kelas_kelompok->setFormValue($objForm->GetValue("x_nama_kelas_kelompok"));
		}
		$st_master_kelas_kelompok->nama_kelas_kelompok->setOldValue($objForm->GetValue("o_nama_kelas_kelompok"));
		if (!$st_master_kelas_kelompok->kode_otomatis->FldIsDetailKey) {
			$st_master_kelas_kelompok->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		$st_master_kelas_kelompok->kode_otomatis->setOldValue($objForm->GetValue("o_kode_otomatis"));
		if (!$st_master_kelas_kelompok->apakah_valid->FldIsDetailKey) {
			$st_master_kelas_kelompok->apakah_valid->setFormValue($objForm->GetValue("x_apakah_valid"));
		}
		$st_master_kelas_kelompok->apakah_valid->setOldValue($objForm->GetValue("o_apakah_valid"));
		if (!$st_master_kelas_kelompok->kode_otomatis_tingkat->FldIsDetailKey) {
			$st_master_kelas_kelompok->kode_otomatis_tingkat->setFormValue($objForm->GetValue("x_kode_otomatis_tingkat"));
		}
		$st_master_kelas_kelompok->kode_otomatis_tingkat->setOldValue($objForm->GetValue("o_kode_otomatis_tingkat"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $st_master_kelas_kelompok;
		$st_master_kelas_kelompok->tahun->CurrentValue = $st_master_kelas_kelompok->tahun->FormValue;
		$st_master_kelas_kelompok->kelas->CurrentValue = $st_master_kelas_kelompok->kelas->FormValue;
		$st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue = $st_master_kelas_kelompok->nama_kelas_kelompok->FormValue;
		$st_master_kelas_kelompok->kode_otomatis->CurrentValue = $st_master_kelas_kelompok->kode_otomatis->FormValue;
		$st_master_kelas_kelompok->apakah_valid->CurrentValue = $st_master_kelas_kelompok->apakah_valid->FormValue;
		$st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue = $st_master_kelas_kelompok->kode_otomatis_tingkat->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $st_master_kelas_kelompok;

		// Call Recordset Selecting event
		$st_master_kelas_kelompok->Recordset_Selecting($st_master_kelas_kelompok->CurrentFilter);

		// Load List page SQL
		$sSql = $st_master_kelas_kelompok->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$st_master_kelas_kelompok->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_master_kelas_kelompok;
		$sFilter = $st_master_kelas_kelompok->KeyFilter();

		// Call Row Selecting event
		$st_master_kelas_kelompok->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_master_kelas_kelompok->CurrentFilter = $sFilter;
		$sSql = $st_master_kelas_kelompok->SQL();
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
		global $conn, $st_master_kelas_kelompok;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_master_kelas_kelompok->Row_Selected($row);
		$st_master_kelas_kelompok->tahun->setDbValue($rs->fields('tahun'));
		$st_master_kelas_kelompok->kelas->setDbValue($rs->fields('kelas'));
		$st_master_kelas_kelompok->nama_kelas_kelompok->setDbValue($rs->fields('nama_kelas_kelompok'));
		$st_master_kelas_kelompok->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$st_master_kelas_kelompok->apakah_valid->setDbValue($rs->fields('apakah_valid'));
		$st_master_kelas_kelompok->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
	}

	// Load old record
	function LoadOldRecord() {
		global $st_master_kelas_kelompok;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($st_master_kelas_kelompok->getKey("kode_otomatis")) <> "")
			$st_master_kelas_kelompok->kode_otomatis->CurrentValue = $st_master_kelas_kelompok->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$st_master_kelas_kelompok->CurrentFilter = $st_master_kelas_kelompok->KeyFilter();
			$sSql = $st_master_kelas_kelompok->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_master_kelas_kelompok;

		// Initialize URLs
		$this->ViewUrl = $st_master_kelas_kelompok->ViewUrl();
		$this->EditUrl = $st_master_kelas_kelompok->EditUrl();
		$this->InlineEditUrl = $st_master_kelas_kelompok->InlineEditUrl();
		$this->CopyUrl = $st_master_kelas_kelompok->CopyUrl();
		$this->InlineCopyUrl = $st_master_kelas_kelompok->InlineCopyUrl();
		$this->DeleteUrl = $st_master_kelas_kelompok->DeleteUrl();

		// Call Row_Rendering event
		$st_master_kelas_kelompok->Row_Rendering();

		// Common render codes for all row types
		// tahun
		// kelas
		// nama_kelas_kelompok
		// kode_otomatis
		// apakah_valid
		// kode_otomatis_tingkat

		if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View row

			// tahun
			$st_master_kelas_kelompok->tahun->ViewValue = $st_master_kelas_kelompok->tahun->CurrentValue;
			$st_master_kelas_kelompok->tahun->ViewCustomAttributes = "";

			// kelas
			if (strval($st_master_kelas_kelompok->kelas->CurrentValue) <> "") {
				$sFilterWrk = "`kelas` = '" . ew_AdjustSql($st_master_kelas_kelompok->kelas->CurrentValue) . "'";
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
					$st_master_kelas_kelompok->kelas->ViewValue = $rswrk->fields('kelas');
					$rswrk->Close();
				} else {
					$st_master_kelas_kelompok->kelas->ViewValue = $st_master_kelas_kelompok->kelas->CurrentValue;
				}
			} else {
				$st_master_kelas_kelompok->kelas->ViewValue = NULL;
			}
			$st_master_kelas_kelompok->kelas->ViewCustomAttributes = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->ViewValue = $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue;
			$st_master_kelas_kelompok->nama_kelas_kelompok->ViewCustomAttributes = "";

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->ViewValue = $st_master_kelas_kelompok->kode_otomatis->CurrentValue;
			$st_master_kelas_kelompok->kode_otomatis->ViewCustomAttributes = "";

			// apakah_valid
			if (strval($st_master_kelas_kelompok->apakah_valid->CurrentValue) <> "") {
				switch ($st_master_kelas_kelompok->apakah_valid->CurrentValue) {
					case "y":
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) : $st_master_kelas_kelompok->apakah_valid->CurrentValue;
						break;
					case "t":
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) : $st_master_kelas_kelompok->apakah_valid->CurrentValue;
						break;
					default:
						$st_master_kelas_kelompok->apakah_valid->ViewValue = $st_master_kelas_kelompok->apakah_valid->CurrentValue;
				}
			} else {
				$st_master_kelas_kelompok->apakah_valid->ViewValue = NULL;
			}
			$st_master_kelas_kelompok->apakah_valid->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->ViewValue = $st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue;
			$st_master_kelas_kelompok->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// tahun
			$st_master_kelas_kelompok->tahun->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->tahun->HrefValue = "";
			$st_master_kelas_kelompok->tahun->TooltipValue = "";

			// kelas
			$st_master_kelas_kelompok->kelas->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kelas->HrefValue = "";
			$st_master_kelas_kelompok->kelas->TooltipValue = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->HrefValue = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->TooltipValue = "";

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis->HrefValue = "";
			$st_master_kelas_kelompok->kode_otomatis->TooltipValue = "";

			// apakah_valid
			$st_master_kelas_kelompok->apakah_valid->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->apakah_valid->HrefValue = "";
			$st_master_kelas_kelompok->apakah_valid->TooltipValue = "";

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->HrefValue = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->TooltipValue = "";
		} elseif ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add row

			// tahun
			$st_master_kelas_kelompok->tahun->EditCustomAttributes = "";
			$st_master_kelas_kelompok->tahun->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->tahun->CurrentValue);

			// kelas
			$st_master_kelas_kelompok->kelas->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kelas`, `kelas` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `st_master_kelas`";
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
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$st_master_kelas_kelompok->kelas->EditValue = $arwrk;

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->EditCustomAttributes = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue);

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->EditCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis->CurrentValue = unik();

			// apakah_valid
			$st_master_kelas_kelompok->apakah_valid->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("y", $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) : "y");
			$arwrk[] = array("t", $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) : "t");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$st_master_kelas_kelompok->apakah_valid->EditValue = $arwrk;

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->EditCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue = $_SESSION["kode_otomatis_tingkat"];

			// Edit refer script
			// tahun

			$st_master_kelas_kelompok->tahun->HrefValue = "";

			// kelas
			$st_master_kelas_kelompok->kelas->HrefValue = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->HrefValue = "";

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->HrefValue = "";

			// apakah_valid
			$st_master_kelas_kelompok->apakah_valid->HrefValue = "";

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->HrefValue = "";
		} elseif ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// tahun
			$st_master_kelas_kelompok->tahun->EditCustomAttributes = "";
			$st_master_kelas_kelompok->tahun->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->tahun->AdvancedSearch->SearchValue);

			// kelas
			$st_master_kelas_kelompok->kelas->EditCustomAttributes = "";

			// nama_kelas_kelompok
			$st_master_kelas_kelompok->nama_kelas_kelompok->EditCustomAttributes = "";
			$st_master_kelas_kelompok->nama_kelas_kelompok->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->nama_kelas_kelompok->AdvancedSearch->SearchValue);

			// kode_otomatis
			$st_master_kelas_kelompok->kode_otomatis->EditCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchValue);

			// apakah_valid
			$st_master_kelas_kelompok->apakah_valid->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("y", $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(1) : "y");
			$arwrk[] = array("t", $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) <> "" ? $st_master_kelas_kelompok->apakah_valid->FldTagCaption(2) : "t");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$st_master_kelas_kelompok->apakah_valid->EditValue = $arwrk;

			// kode_otomatis_tingkat
			$st_master_kelas_kelompok->kode_otomatis_tingkat->EditCustomAttributes = "";
			$st_master_kelas_kelompok->kode_otomatis_tingkat->EditValue = ew_HtmlEncode($st_master_kelas_kelompok->kode_otomatis_tingkat->AdvancedSearch->SearchValue);
		}
		if ($st_master_kelas_kelompok->RowType == EW_ROWTYPE_ADD ||
			$st_master_kelas_kelompok->RowType == EW_ROWTYPE_EDIT ||
			$st_master_kelas_kelompok->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$st_master_kelas_kelompok->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($st_master_kelas_kelompok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_master_kelas_kelompok->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $st_master_kelas_kelompok;

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
		global $Language, $gsFormError, $st_master_kelas_kelompok;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($st_master_kelas_kelompok->tahun->FormValue) && $st_master_kelas_kelompok->tahun->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_kelas_kelompok->tahun->FldCaption());
		}
		if (!is_null($st_master_kelas_kelompok->kelas->FormValue) && $st_master_kelas_kelompok->kelas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_kelas_kelompok->kelas->FldCaption());
		}
		if (!is_null($st_master_kelas_kelompok->nama_kelas_kelompok->FormValue) && $st_master_kelas_kelompok->nama_kelas_kelompok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_kelas_kelompok->nama_kelas_kelompok->FldCaption());
		}
		if (!is_null($st_master_kelas_kelompok->apakah_valid->FormValue) && $st_master_kelas_kelompok->apakah_valid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_kelas_kelompok->apakah_valid->FldCaption());
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $st_master_kelas_kelompok;
		$DeleteRows = TRUE;
		$sSql = $st_master_kelas_kelompok->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $st_master_kelas_kelompok->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['kode_otomatis'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($st_master_kelas_kelompok->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($st_master_kelas_kelompok->CancelMessage <> "") {
				$this->setFailureMessage($st_master_kelas_kelompok->CancelMessage);
				$st_master_kelas_kelompok->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$st_master_kelas_kelompok->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $st_master_kelas_kelompok;

		// Check if key value entered
		if ($st_master_kelas_kelompok->kode_otomatis->CurrentValue == "" && $st_master_kelas_kelompok->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $st_master_kelas_kelompok->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $st_master_kelas_kelompok->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(nama_kelas_kelompok = '" . ew_AdjustSql($st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue) . "')";
			$rsChk = $st_master_kelas_kelompok->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'nama_kelas_kelompok', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_master_kelas_kelompok->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($st_master_kelas_kelompok->kode_otomatis->CurrentValue) . "')";
			$rsChk = $st_master_kelas_kelompok->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_master_kelas_kelompok->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// tahun
		$st_master_kelas_kelompok->tahun->SetDbValueDef($rsnew, $st_master_kelas_kelompok->tahun->CurrentValue, "", FALSE);

		// kelas
		$st_master_kelas_kelompok->kelas->SetDbValueDef($rsnew, $st_master_kelas_kelompok->kelas->CurrentValue, "", FALSE);

		// nama_kelas_kelompok
		$st_master_kelas_kelompok->nama_kelas_kelompok->SetDbValueDef($rsnew, $st_master_kelas_kelompok->nama_kelas_kelompok->CurrentValue, "", FALSE);

		// kode_otomatis
		$st_master_kelas_kelompok->kode_otomatis->SetDbValueDef($rsnew, $st_master_kelas_kelompok->kode_otomatis->CurrentValue, "", FALSE);

		// apakah_valid
		$st_master_kelas_kelompok->apakah_valid->SetDbValueDef($rsnew, $st_master_kelas_kelompok->apakah_valid->CurrentValue, "", FALSE);

		// kode_otomatis_tingkat
		$st_master_kelas_kelompok->kode_otomatis_tingkat->SetDbValueDef($rsnew, $st_master_kelas_kelompok->kode_otomatis_tingkat->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $st_master_kelas_kelompok->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($st_master_kelas_kelompok->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($st_master_kelas_kelompok->CancelMessage <> "") {
				$this->setFailureMessage($st_master_kelas_kelompok->CancelMessage);
				$st_master_kelas_kelompok->CancelMessage = "";
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
			$st_master_kelas_kelompok->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $st_master_kelas_kelompok;
		$st_master_kelas_kelompok->tahun->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_tahun");
		$st_master_kelas_kelompok->kelas->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_kelas");
		$st_master_kelas_kelompok->nama_kelas_kelompok->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_nama_kelas_kelompok");
		$st_master_kelas_kelompok->kode_otomatis->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_kode_otomatis");
		$st_master_kelas_kelompok->apakah_valid->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_apakah_valid");
		$st_master_kelas_kelompok->kode_otomatis_tingkat->AdvancedSearch->SearchValue = $st_master_kelas_kelompok->getAdvancedSearch("x_kode_otomatis_tingkat");
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $st_master_kelas_kelompok;
		$sWrkFilter = "";
		if ($st_master_kelas_kelompok->Export <> "") {
			$sWrkFilter = $st_master_kelas_kelompok->GetKeyFilter();
		}
		return $sWrkFilter;
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $st_master_kelas_kelompok;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fst_master_kelas_kelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','print');\">" . "<img src=\"phpimages/print.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fst_master_kelas_kelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','excel');\">" . "<img src=\"phpimages/exportxls.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fst_master_kelas_kelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','word');\">" . "<img src=\"phpimages/exportdoc.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fst_master_kelas_kelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','html');\">" . "<img src=\"phpimages/exporthtml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fst_master_kelas_kelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','xml');\">" . "<img src=\"phpimages/exportxml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fst_master_kelas_kelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','csv');\">" . "<img src=\"phpimages/exportcsv.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"javascript:void(0);\" onclick=\"var f=document.fst_master_kelas_kelompoklist;ew_SubmitSelectedExport(f,'" . ew_CurrentPage() . "','pdf');\">" . "<img src=\"phpimages/exportpdf.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_st_master_kelas_kelompok\" id=\"emf_st_master_kelas_kelompok\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_st_master_kelas_kelompok',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fst_master_kelas_kelompoklist,sel:true});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($st_master_kelas_kelompok->Export <> "" ||
			$st_master_kelas_kelompok->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $st_master_kelas_kelompok;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $st_master_kelas_kelompok->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($st_master_kelas_kelompok->ExportAll) {
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
		if ($st_master_kelas_kelompok->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($st_master_kelas_kelompok, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($st_master_kelas_kelompok->Export == "xml") {
			$st_master_kelas_kelompok->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$st_master_kelas_kelompok->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($st_master_kelas_kelompok->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($st_master_kelas_kelompok->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($st_master_kelas_kelompok->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($st_master_kelas_kelompok->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($st_master_kelas_kelompok->ExportReturnUrl());
		} elseif ($st_master_kelas_kelompok->Export == "pdf") {
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

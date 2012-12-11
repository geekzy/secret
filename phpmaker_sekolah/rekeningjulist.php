<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "rekeningjuinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "master_transaksi2info.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$rekeningju_list = new crekeningju_list();
$Page =& $rekeningju_list;

// Page init
$rekeningju_list->Page_Init();

// Page main
$rekeningju_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($rekeningju->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var rekeningju_list = new ew_Page("rekeningju_list");

// page properties
rekeningju_list.PageID = "list"; // page ID
rekeningju_list.FormID = "frekeningjulist"; // form ID
var EW_PAGE_ID = rekeningju_list.PageID; // for backward compatibility

// extend page with ValidateForm function
rekeningju_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_NoRek"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekeningju->NoRek->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_debet"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekeningju->debet->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_debet"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rekeningju->debet->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_kredit"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekeningju->kredit->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kredit"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rekeningju->kredit->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekeningju->tanggal->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rekeningju->tanggal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_nota"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekeningju->tanggal_nota->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_nota"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rekeningju->tanggal_nota->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_apakah_original"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($rekeningju->apakah_original->FldCaption()) ?>");

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
rekeningju_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "NoRek", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Keterangan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "debet", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kredit", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kode_bukti", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tanggal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tanggal_nota", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kode_otomatis", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kode_otomatis_tingkat", false)) return false;
	if (ew_ValueChanged(fobj, infix, "apakah_original", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
rekeningju_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
rekeningju_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rekeningju_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($rekeningju->Export == "") || (EW_EXPORT_MASTER_RECORD && $rekeningju->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "master_transaksi2list.php";
if ($rekeningju_list->DbMasterFilter <> "" && $rekeningju->getCurrentMasterTable() == "master_transaksi2") {
	if ($rekeningju_list->MasterRecordExists) {
		if ($rekeningju->getCurrentMasterTable() == $rekeningju->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $master_transaksi2->TableCaption() ?>
&nbsp;&nbsp;<?php $rekeningju_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($rekeningju->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "master_transaksi2master.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
if ($rekeningju->CurrentAction == "gridadd") {
	$rekeningju->CurrentFilter = "0=1";
	$rekeningju_list->StartRec = 1;
	$rekeningju_list->DisplayRecs = $rekeningju->GridAddRowCount;
	$rekeningju_list->TotalRecs = $rekeningju_list->DisplayRecs;
	$rekeningju_list->StopRec = $rekeningju_list->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$rekeningju_list->TotalRecs = $rekeningju->SelectRecordCount();
	} else {
		if ($rekeningju_list->Recordset = $rekeningju_list->LoadRecordset())
			$rekeningju_list->TotalRecs = $rekeningju_list->Recordset->RecordCount();
	}
	$rekeningju_list->StartRec = 1;
	if ($rekeningju_list->DisplayRecs <= 0 || ($rekeningju->Export <> "" && $rekeningju->ExportAll)) // Display all records
		$rekeningju_list->DisplayRecs = $rekeningju_list->TotalRecs;
	if (!($rekeningju->Export <> "" && $rekeningju->ExportAll))
		$rekeningju_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rekeningju_list->Recordset = $rekeningju_list->LoadRecordset($rekeningju_list->StartRec-1, $rekeningju_list->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $rekeningju->TableCaption() ?>
<?php if ($rekeningju->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;<?php $rekeningju_list->ExportOptions->Render("body"); ?>
<?php } ?>
</p>
<?php $rekeningju_list->ShowPageHeader(); ?>
<?php
$rekeningju_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($rekeningju->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($rekeningju->CurrentAction <> "gridadd" && $rekeningju->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($rekeningju_list->Pager)) $rekeningju_list->Pager = new cNumericPager($rekeningju_list->StartRec, $rekeningju_list->DisplayRecs, $rekeningju_list->TotalRecs, $rekeningju_list->RecRange) ?>
<?php if ($rekeningju_list->Pager->RecordCount > 0) { ?>
	<?php if ($rekeningju_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $rekeningju_list->PageUrl() ?>start=<?php echo $rekeningju_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($rekeningju_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $rekeningju_list->PageUrl() ?>start=<?php echo $rekeningju_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($rekeningju_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $rekeningju_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($rekeningju_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $rekeningju_list->PageUrl() ?>start=<?php echo $rekeningju_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($rekeningju_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $rekeningju_list->PageUrl() ?>start=<?php echo $rekeningju_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($rekeningju_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rekeningju_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rekeningju_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rekeningju_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($rekeningju_list->SearchWhere == "0=101") { ?>
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
<?php if ($rekeningju_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="rekeningju">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($rekeningju_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($rekeningju_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="30"<?php if ($rekeningju_list->DisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="50"<?php if ($rekeningju_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($rekeningju_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($rekeningju_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($rekeningju_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="400"<?php if ($rekeningju_list->DisplayRecs == 400) { ?> selected="selected"<?php } ?>>400</option>
<option value="500"<?php if ($rekeningju_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($rekeningju->CurrentAction <> "gridadd" && $rekeningju->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $rekeningju_list->GridAddUrl ?>"><?php echo $Language->Phrase("GridAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($rekeningju->CurrentAction == "gridadd") { ?>
<?php if ($rekeningju->AllowAddDeleteRow) { ?>
<a class="ewGridLink" href="javascript:void(0);" onclick="ew_AddGridRow(this);"><img src='phpimages/addblankrow.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("AddBlankRow")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("AddBlankRow")) ?>' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<a class="ewGridLink" href="" onclick="return ew_SubmitForm(rekeningju_list, document.frekeningjulist);"><img src='phpimages/insert.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("GridInsertLink")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("GridInsertLink")) ?>' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<a class="ewGridLink" href="<?php echo $rekeningju_list->PageUrl() ?>a=cancel"><img src='phpimages/cancel.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("GridCancelLink")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("GridCancelLink")) ?>' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="frekeningjulist" id="frekeningjulist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="rekeningju">
<div id="gmp_rekeningju" class="ewGridMiddlePanel">
<?php if ($rekeningju_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $rekeningju->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$rekeningju_list->RenderListOptions();

// Render list options (header, left)
$rekeningju_list->ListOptions->Render("header", "left");
?>
<?php if ($rekeningju->NoRek->Visible) { // NoRek ?>
	<?php if ($rekeningju->SortUrl($rekeningju->NoRek) == "") { ?>
		<td><?php echo $rekeningju->NoRek->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekeningju->SortUrl($rekeningju->NoRek) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->NoRek->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->NoRek->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->NoRek->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->Keterangan->Visible) { // Keterangan ?>
	<?php if ($rekeningju->SortUrl($rekeningju->Keterangan) == "") { ?>
		<td><?php echo $rekeningju->Keterangan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekeningju->SortUrl($rekeningju->Keterangan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->Keterangan->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->Keterangan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->Keterangan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->debet->Visible) { // debet ?>
	<?php if ($rekeningju->SortUrl($rekeningju->debet) == "") { ?>
		<td><?php echo $rekeningju->debet->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekeningju->SortUrl($rekeningju->debet) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->debet->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->debet->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->debet->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->kredit->Visible) { // kredit ?>
	<?php if ($rekeningju->SortUrl($rekeningju->kredit) == "") { ?>
		<td><?php echo $rekeningju->kredit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekeningju->SortUrl($rekeningju->kredit) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->kredit->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->kredit->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->kredit->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->kode_bukti->Visible) { // kode_bukti ?>
	<?php if ($rekeningju->SortUrl($rekeningju->kode_bukti) == "") { ?>
		<td><?php echo $rekeningju->kode_bukti->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekeningju->SortUrl($rekeningju->kode_bukti) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->kode_bukti->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->kode_bukti->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->kode_bukti->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->tanggal->Visible) { // tanggal ?>
	<?php if ($rekeningju->SortUrl($rekeningju->tanggal) == "") { ?>
		<td><?php echo $rekeningju->tanggal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekeningju->SortUrl($rekeningju->tanggal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->tanggal->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->tanggal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->tanggal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->tanggal_nota->Visible) { // tanggal_nota ?>
	<?php if ($rekeningju->SortUrl($rekeningju->tanggal_nota) == "") { ?>
		<td><?php echo $rekeningju->tanggal_nota->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekeningju->SortUrl($rekeningju->tanggal_nota) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->tanggal_nota->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->tanggal_nota->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->tanggal_nota->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($rekeningju->SortUrl($rekeningju->kode_otomatis) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $rekeningju->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekeningju->SortUrl($rekeningju->kode_otomatis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $rekeningju->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
	<?php if ($rekeningju->SortUrl($rekeningju->kode_otomatis_tingkat) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $rekeningju->kode_otomatis_tingkat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekeningju->SortUrl($rekeningju->kode_otomatis_tingkat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $rekeningju->kode_otomatis_tingkat->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->kode_otomatis_tingkat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->kode_otomatis_tingkat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->apakah_original->Visible) { // apakah_original ?>
	<?php if ($rekeningju->SortUrl($rekeningju->apakah_original) == "") { ?>
		<td><?php echo $rekeningju->apakah_original->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rekeningju->SortUrl($rekeningju->apakah_original) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->apakah_original->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->apakah_original->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->apakah_original->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$rekeningju_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($rekeningju->ExportAll && $rekeningju->Export <> "") {
	$rekeningju_list->StopRec = $rekeningju_list->TotalRecs;
} else {

	// Set the last record to display
	if ($rekeningju_list->TotalRecs > $rekeningju_list->StartRec + $rekeningju_list->DisplayRecs - 1)
		$rekeningju_list->StopRec = $rekeningju_list->StartRec + $rekeningju_list->DisplayRecs - 1;
	else
		$rekeningju_list->StopRec = $rekeningju_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($rekeningju->CurrentAction == "gridadd" || $rekeningju->CurrentAction == "gridedit" || $rekeningju->CurrentAction == "F")) {
		$rekeningju_list->KeyCount = $objForm->GetValue("key_count");
		$rekeningju_list->StopRec = $rekeningju_list->KeyCount;
	}
}
$rekeningju_list->RecCnt = $rekeningju_list->StartRec - 1;
if ($rekeningju_list->Recordset && !$rekeningju_list->Recordset->EOF) {
	$rekeningju_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $rekeningju_list->StartRec > 1)
		$rekeningju_list->Recordset->Move($rekeningju_list->StartRec - 1);
} elseif (!$rekeningju->AllowAddDeleteRow && $rekeningju_list->StopRec == 0) {
	$rekeningju_list->StopRec = $rekeningju->GridAddRowCount;
}

// Initialize aggregate
$rekeningju->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rekeningju->ResetAttrs();
$rekeningju_list->RenderRow();
$rekeningju_list->RowCnt = 0;
if ($rekeningju->CurrentAction == "gridadd")
	$rekeningju_list->RowIndex = 0;
while ($rekeningju_list->RecCnt < $rekeningju_list->StopRec) {
	$rekeningju_list->RecCnt++;
	if (intval($rekeningju_list->RecCnt) >= intval($rekeningju_list->StartRec)) {
		$rekeningju_list->RowCnt++;
		if ($rekeningju->CurrentAction == "gridadd" || $rekeningju->CurrentAction == "gridedit" || $rekeningju->CurrentAction == "F")
			$rekeningju_list->RowIndex++;

		// Set up key count
		$rekeningju_list->KeyCount = $rekeningju_list->RowIndex;

		// Init row class and style
		$rekeningju->ResetAttrs();
		$rekeningju->CssClass = "";
		if ($rekeningju->CurrentAction == "gridadd") {
			$rekeningju_list->LoadDefaultValues(); // Load default values
		} else {
			$rekeningju_list->LoadRowValues($rekeningju_list->Recordset); // Load row values
		}
		$rekeningju->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($rekeningju->CurrentAction == "gridadd") // Grid add
			$rekeningju->RowType = EW_ROWTYPE_ADD; // Render add
		if ($rekeningju->CurrentAction == "gridadd" && $rekeningju->EventCancelled) // Insert failed
			$rekeningju_list->RestoreCurrentRowFormValues($rekeningju_list->RowIndex); // Restore form values
		$rekeningju->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$rekeningju_list->RenderRow();

		// Render list options
		$rekeningju_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($rekeningju_list->RowAction <> "delete" && $rekeningju_list->RowAction <> "insertdelete" && !($rekeningju_list->RowAction == "insert" && $rekeningju->CurrentAction == "F" && $rekeningju_list->EmptyRow())) {
?>
	<tr<?php echo $rekeningju->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rekeningju_list->ListOptions->Render("body", "left");
?>
	<?php if ($rekeningju->NoRek->Visible) { // NoRek ?>
		<td<?php echo $rekeningju->NoRek->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $rekeningju_list->RowIndex ?>_NoRek" name="x<?php echo $rekeningju_list->RowIndex ?>_NoRek"<?php echo $rekeningju->NoRek->EditAttributes() ?>>
<?php
if (is_array($rekeningju->NoRek->EditValue)) {
	$arwrk = $rekeningju->NoRek->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rekeningju->NoRek->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$rekeningju->NoRek) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $rekeningju->NoRek->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_NoRek" id="o<?php echo $rekeningju_list->RowIndex ?>_NoRek" value="<?php echo ew_HtmlEncode($rekeningju->NoRek->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->NoRek->ViewAttributes() ?>><?php echo $rekeningju->NoRek->ListViewValue() ?></div>
<?php } ?>
<a name="<?php echo $rekeningju_list->PageObjName . "_row_" . $rekeningju_list->RowCnt ?>" id="<?php echo $rekeningju_list->PageObjName . "_row_" . $rekeningju_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($rekeningju->Keterangan->Visible) { // Keterangan ?>
		<td<?php echo $rekeningju->Keterangan->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_Keterangan" id="x<?php echo $rekeningju_list->RowIndex ?>_Keterangan" size="30" maxlength="100" value="<?php echo $rekeningju->Keterangan->EditValue ?>"<?php echo $rekeningju->Keterangan->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_Keterangan" id="o<?php echo $rekeningju_list->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($rekeningju->Keterangan->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->Keterangan->ViewAttributes() ?>><?php echo $rekeningju->Keterangan->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->debet->Visible) { // debet ?>
		<td<?php echo $rekeningju->debet->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_debet" id="x<?php echo $rekeningju_list->RowIndex ?>_debet" size="30" value="<?php echo $rekeningju->debet->EditValue ?>"<?php echo $rekeningju->debet->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_debet" id="o<?php echo $rekeningju_list->RowIndex ?>_debet" value="<?php echo ew_HtmlEncode($rekeningju->debet->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->debet->ViewAttributes() ?>><?php echo $rekeningju->debet->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kredit->Visible) { // kredit ?>
		<td<?php echo $rekeningju->kredit->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_kredit" id="x<?php echo $rekeningju_list->RowIndex ?>_kredit" size="30" value="<?php echo $rekeningju->kredit->EditValue ?>"<?php echo $rekeningju->kredit->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_kredit" id="o<?php echo $rekeningju_list->RowIndex ?>_kredit" value="<?php echo ew_HtmlEncode($rekeningju->kredit->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->kredit->ViewAttributes() ?>><?php echo $rekeningju->kredit->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_bukti->Visible) { // kode_bukti ?>
		<td<?php echo $rekeningju->kode_bukti->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_kode_bukti" id="x<?php echo $rekeningju_list->RowIndex ?>_kode_bukti" size="30" maxlength="50" value="<?php echo $rekeningju->kode_bukti->EditValue ?>"<?php echo $rekeningju->kode_bukti->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_kode_bukti" id="o<?php echo $rekeningju_list->RowIndex ?>_kode_bukti" value="<?php echo ew_HtmlEncode($rekeningju->kode_bukti->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->kode_bukti->ViewAttributes() ?>><?php echo $rekeningju->kode_bukti->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->tanggal->Visible) { // tanggal ?>
		<td<?php echo $rekeningju->tanggal->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_tanggal" id="x<?php echo $rekeningju_list->RowIndex ?>_tanggal" value="<?php echo $rekeningju->tanggal->EditValue ?>"<?php echo $rekeningju->tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal" name="cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $rekeningju_list->RowIndex ?>_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal" // button id
});
</script>
<input type="hidden" name="fo<?php echo $rekeningju_list->RowIndex ?>_tanggal" id="fo<?php echo $rekeningju_list->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($rekeningju->tanggal->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_tanggal" id="o<?php echo $rekeningju_list->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($rekeningju->tanggal->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->tanggal->ViewAttributes() ?>><?php echo $rekeningju->tanggal->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->tanggal_nota->Visible) { // tanggal_nota ?>
		<td<?php echo $rekeningju->tanggal_nota->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" id="x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" value="<?php echo $rekeningju->tanggal_nota->EditValue ?>"<?php echo $rekeningju->tanggal_nota->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" name="cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" // button id
});
</script>
<input type="hidden" name="fo<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" id="fo<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($rekeningju->tanggal_nota->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" id="o<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" value="<?php echo ew_HtmlEncode($rekeningju->tanggal_nota->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->tanggal_nota->ViewAttributes() ?>><?php echo $rekeningju->tanggal_nota->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $rekeningju->kode_otomatis->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="x<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis" id="x<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis" id="o<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->kode_otomatis->ViewAttributes() ?>><?php echo $rekeningju->kode_otomatis->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<td<?php echo $rekeningju->kode_otomatis_tingkat->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="x<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis_tingkat" id="x<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis_tingkat" id="o<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $rekeningju->kode_otomatis_tingkat->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->apakah_original->Visible) { // apakah_original ?>
		<td<?php echo $rekeningju->apakah_original->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_apakah_original" id="x<?php echo $rekeningju_list->RowIndex ?>_apakah_original" size="30" maxlength="1" value="<?php echo $rekeningju->apakah_original->EditValue ?>"<?php echo $rekeningju->apakah_original->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_apakah_original" id="o<?php echo $rekeningju_list->RowIndex ?>_apakah_original" value="<?php echo ew_HtmlEncode($rekeningju->apakah_original->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->apakah_original->ViewAttributes() ?>><?php echo $rekeningju->apakah_original->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rekeningju_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($rekeningju->CurrentAction <> "gridadd")
		if (!$rekeningju_list->Recordset->EOF) $rekeningju_list->Recordset->MoveNext();
}
?>
<?php
	if ($rekeningju->CurrentAction == "gridadd" || $rekeningju->CurrentAction == "gridedit") {
		$rekeningju_list->RowIndex = '$rowindex$';
		$rekeningju_list->LoadDefaultValues();

		// Set row properties
		$rekeningju->ResetAttrs();
		$rekeningju->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($rekeningju_list->RowIndex))
			$rekeningju->RowAttrs = array_merge($rekeningju->RowAttrs, array('data-rowindex'=>$rekeningju_list->RowIndex, 'id'=>'r' . $rekeningju_list->RowIndex . '_rekeningju'));
		$rekeningju->RowType = EW_ROWTYPE_ADD;

		// Render row
		$rekeningju_list->RenderRow();

		// Render list options
		$rekeningju_list->RenderListOptions();

		// Add id and class to the template row
		$rekeningju->RowAttrs["id"] = "r0_rekeningju";
		ew_AppendClass($rekeningju->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $rekeningju->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rekeningju_list->ListOptions->Render("body", "left");
?>
	<?php if ($rekeningju->NoRek->Visible) { // NoRek ?>
		<td>
<select id="x<?php echo $rekeningju_list->RowIndex ?>_NoRek" name="x<?php echo $rekeningju_list->RowIndex ?>_NoRek"<?php echo $rekeningju->NoRek->EditAttributes() ?>>
<?php
if (is_array($rekeningju->NoRek->EditValue)) {
	$arwrk = $rekeningju->NoRek->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rekeningju->NoRek->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$rekeningju->NoRek) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $rekeningju->NoRek->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_NoRek" id="o<?php echo $rekeningju_list->RowIndex ?>_NoRek" value="<?php echo ew_HtmlEncode($rekeningju->NoRek->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rekeningju->Keterangan->Visible) { // Keterangan ?>
		<td>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_Keterangan" id="x<?php echo $rekeningju_list->RowIndex ?>_Keterangan" size="30" maxlength="100" value="<?php echo $rekeningju->Keterangan->EditValue ?>"<?php echo $rekeningju->Keterangan->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_Keterangan" id="o<?php echo $rekeningju_list->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($rekeningju->Keterangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rekeningju->debet->Visible) { // debet ?>
		<td>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_debet" id="x<?php echo $rekeningju_list->RowIndex ?>_debet" size="30" value="<?php echo $rekeningju->debet->EditValue ?>"<?php echo $rekeningju->debet->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_debet" id="o<?php echo $rekeningju_list->RowIndex ?>_debet" value="<?php echo ew_HtmlEncode($rekeningju->debet->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rekeningju->kredit->Visible) { // kredit ?>
		<td>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_kredit" id="x<?php echo $rekeningju_list->RowIndex ?>_kredit" size="30" value="<?php echo $rekeningju->kredit->EditValue ?>"<?php echo $rekeningju->kredit->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_kredit" id="o<?php echo $rekeningju_list->RowIndex ?>_kredit" value="<?php echo ew_HtmlEncode($rekeningju->kredit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_bukti->Visible) { // kode_bukti ?>
		<td>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_kode_bukti" id="x<?php echo $rekeningju_list->RowIndex ?>_kode_bukti" size="30" maxlength="50" value="<?php echo $rekeningju->kode_bukti->EditValue ?>"<?php echo $rekeningju->kode_bukti->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_kode_bukti" id="o<?php echo $rekeningju_list->RowIndex ?>_kode_bukti" value="<?php echo ew_HtmlEncode($rekeningju->kode_bukti->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rekeningju->tanggal->Visible) { // tanggal ?>
		<td>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_tanggal" id="x<?php echo $rekeningju_list->RowIndex ?>_tanggal" value="<?php echo $rekeningju->tanggal->EditValue ?>"<?php echo $rekeningju->tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal" name="cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $rekeningju_list->RowIndex ?>_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal" // button id
});
</script>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_tanggal" id="o<?php echo $rekeningju_list->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($rekeningju->tanggal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rekeningju->tanggal_nota->Visible) { // tanggal_nota ?>
		<td>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" id="x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" value="<?php echo $rekeningju->tanggal_nota->EditValue ?>"<?php echo $rekeningju->tanggal_nota->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" name="cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" // button id
});
</script>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" id="o<?php echo $rekeningju_list->RowIndex ?>_tanggal_nota" value="<?php echo ew_HtmlEncode($rekeningju->tanggal_nota->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_otomatis->Visible) { // kode_otomatis ?>
		<td>
<input type="hidden" name="x<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis" id="x<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis" id="o<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<td>
<input type="hidden" name="x<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis_tingkat" id="x<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis_tingkat" id="o<?php echo $rekeningju_list->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rekeningju->apakah_original->Visible) { // apakah_original ?>
		<td>
<input type="text" name="x<?php echo $rekeningju_list->RowIndex ?>_apakah_original" id="x<?php echo $rekeningju_list->RowIndex ?>_apakah_original" size="30" maxlength="1" value="<?php echo $rekeningju->apakah_original->EditValue ?>"<?php echo $rekeningju->apakah_original->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_list->RowIndex ?>_apakah_original" id="o<?php echo $rekeningju_list->RowIndex ?>_apakah_original" value="<?php echo ew_HtmlEncode($rekeningju->apakah_original->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rekeningju_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($rekeningju->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $rekeningju_list->KeyCount ?>">
<?php echo $rekeningju_list->MultiSelectKey ?>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rekeningju_list->Recordset)
	$rekeningju_list->Recordset->Close();
?>
</td></tr></table>
<?php if ($rekeningju->Export == "" && $rekeningju->CurrentAction == "") { ?>
<?php } ?>
<?php
$rekeningju_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($rekeningju->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$rekeningju_list->Page_Terminate();
?>
<?php

//
// Page class
//
class crekeningju_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'rekeningju';

	// Page object name
	var $PageObjName = 'rekeningju_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rekeningju;
		if ($rekeningju->UseTokenInUrl) $PageUrl .= "t=" . $rekeningju->TableVar . "&"; // Add page token
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
		global $objForm, $rekeningju;
		if ($rekeningju->UseTokenInUrl) {
			if ($objForm)
				return ($rekeningju->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rekeningju->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crekeningju_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (rekeningju)
		if (!isset($GLOBALS["rekeningju"])) {
			$GLOBALS["rekeningju"] = new crekeningju();
			$GLOBALS["Table"] =& $GLOBALS["rekeningju"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "rekeningjuadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "rekeningjudelete.php";
		$this->MultiUpdateUrl = "rekeningjuupdate.php";

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Table object (master_transaksi2)
		if (!isset($GLOBALS['master_transaksi2'])) $GLOBALS['master_transaksi2'] = new cmaster_transaksi2();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rekeningju', TRUE);

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
		global $rekeningju;

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
			$rekeningju->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $rekeningju;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$rekeningju->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($rekeningju->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid add mode
				if ($rekeningju->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$rekeningju->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Insert
					if ($rekeningju->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd") {
						if ($this->ValidateGridForm()) {
							$this->GridInsert();
						} else {
							$this->setFailureMessage($gsFormError);
							$rekeningju->EventCancelled = TRUE;
							$rekeningju->CurrentAction = "gridadd"; // Stay in Grid Add mode
						}
					}
				}
			}

			// Hide all options
			if ($rekeningju->Export <> "" ||
				$rekeningju->CurrentAction == "gridadd" ||
				$rekeningju->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($rekeningju->AllowAddDeleteRow) {
				if ($rekeningju->CurrentAction == "gridadd" ||
					$rekeningju->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($rekeningju->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $rekeningju->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $rekeningju->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $rekeningju->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($rekeningju->getMasterFilter() <> "" && $rekeningju->getCurrentMasterTable() == "master_transaksi2") {
			global $master_transaksi2;
			$rsmaster = $master_transaksi2->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($rekeningju->getReturnUrl()); // Return to caller
			} else {
				$master_transaksi2->LoadListRowValues($rsmaster);
				$master_transaksi2->RowType = EW_ROWTYPE_MASTER; // Master row
				$master_transaksi2->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$rekeningju->setSessionWhere($sFilter);
		$rekeningju->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $rekeningju;
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
			$rekeningju->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$rekeningju->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $rekeningju;
		$rekeningju->LastAction = $rekeningju->CurrentAction; // Save last action
		$rekeningju->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $rekeningju;
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
				$rekeningju->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $rekeningju->kode_otomatis->CurrentValue;

					// Add filter for this record
					$sFilter = $rekeningju->KeyFilter();
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
			$rekeningju->CurrentFilter = $sWrkFilter;
			$sSql = $rekeningju->SQL();
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
			$rekeningju->EventCancelled = TRUE; // Set event cancelled
			$rekeningju->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $rekeningju, $objForm;
		if ($objForm->HasValue("x_NoRek") && $objForm->HasValue("o_NoRek") && $rekeningju->NoRek->CurrentValue <> $rekeningju->NoRek->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Keterangan") && $objForm->HasValue("o_Keterangan") && $rekeningju->Keterangan->CurrentValue <> $rekeningju->Keterangan->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_debet") && $objForm->HasValue("o_debet") && $rekeningju->debet->CurrentValue <> $rekeningju->debet->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kredit") && $objForm->HasValue("o_kredit") && $rekeningju->kredit->CurrentValue <> $rekeningju->kredit->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_bukti") && $objForm->HasValue("o_kode_bukti") && $rekeningju->kode_bukti->CurrentValue <> $rekeningju->kode_bukti->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tanggal") && $objForm->HasValue("o_tanggal") && $rekeningju->tanggal->CurrentValue <> $rekeningju->tanggal->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tanggal_nota") && $objForm->HasValue("o_tanggal_nota") && $rekeningju->tanggal_nota->CurrentValue <> $rekeningju->tanggal_nota->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_otomatis") && $objForm->HasValue("o_kode_otomatis") && $rekeningju->kode_otomatis->CurrentValue <> $rekeningju->kode_otomatis->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kode_otomatis_tingkat") && $objForm->HasValue("o_kode_otomatis_tingkat") && $rekeningju->kode_otomatis_tingkat->CurrentValue <> $rekeningju->kode_otomatis_tingkat->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_apakah_original") && $objForm->HasValue("o_apakah_original") && $rekeningju->apakah_original->CurrentValue <> $rekeningju->apakah_original->OldValue)
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
		global $objForm, $rekeningju;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $rekeningju;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$rekeningju->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$rekeningju->CurrentOrderType = @$_GET["ordertype"];
			$rekeningju->UpdateSort($rekeningju->NoRek); // NoRek
			$rekeningju->UpdateSort($rekeningju->Keterangan); // Keterangan
			$rekeningju->UpdateSort($rekeningju->debet); // debet
			$rekeningju->UpdateSort($rekeningju->kredit); // kredit
			$rekeningju->UpdateSort($rekeningju->kode_bukti); // kode_bukti
			$rekeningju->UpdateSort($rekeningju->tanggal); // tanggal
			$rekeningju->UpdateSort($rekeningju->tanggal_nota); // tanggal_nota
			$rekeningju->UpdateSort($rekeningju->kode_otomatis); // kode_otomatis
			$rekeningju->UpdateSort($rekeningju->kode_otomatis_tingkat); // kode_otomatis_tingkat
			$rekeningju->UpdateSort($rekeningju->apakah_original); // apakah_original
			$rekeningju->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $rekeningju;
		$sOrderBy = $rekeningju->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($rekeningju->SqlOrderBy() <> "") {
				$sOrderBy = $rekeningju->SqlOrderBy();
				$rekeningju->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $rekeningju;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$rekeningju->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$rekeningju->kode_otomatis_master->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$rekeningju->setSessionOrderBy($sOrderBy);
				$rekeningju->NoRek->setSort("");
				$rekeningju->Keterangan->setSort("");
				$rekeningju->debet->setSort("");
				$rekeningju->kredit->setSort("");
				$rekeningju->kode_bukti->setSort("");
				$rekeningju->tanggal->setSort("");
				$rekeningju->tanggal_nota->setSort("");
				$rekeningju->kode_otomatis->setSort("");
				$rekeningju->kode_otomatis_tingkat->setSort("");
				$rekeningju->apakah_original->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$rekeningju->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $rekeningju;

		// "griddelete"
		if ($rekeningju->AllowAddDeleteRow) {
			$item =& $this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $rekeningju, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if ($rekeningju->RowType == EW_ROWTYPE_ADD)
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
		if ($rekeningju->AllowAddDeleteRow) {
			if ($rekeningju->CurrentAction == "gridadd" || $rekeningju->CurrentAction == "gridedit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, rekeningju_list, " . $this->RowIndex . ");\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
				}
			}
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $rekeningju;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $rekeningju;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$rekeningju->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$rekeningju->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $rekeningju->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$rekeningju->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$rekeningju->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$rekeningju->setStartRecordNumber($this->StartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $rekeningju;
		$rekeningju->NoRek->CurrentValue = "sementara";
		$rekeningju->NoRek->OldValue = $rekeningju->NoRek->CurrentValue;
		$rekeningju->Keterangan->CurrentValue = "-";
		$rekeningju->Keterangan->OldValue = $rekeningju->Keterangan->CurrentValue;
		$rekeningju->debet->CurrentValue = 0;
		$rekeningju->debet->OldValue = $rekeningju->debet->CurrentValue;
		$rekeningju->kredit->CurrentValue = 0;
		$rekeningju->kredit->OldValue = $rekeningju->kredit->CurrentValue;
		$rekeningju->kode_bukti->CurrentValue = "-";
		$rekeningju->kode_bukti->OldValue = $rekeningju->kode_bukti->CurrentValue;
		$rekeningju->tanggal->CurrentValue = "1970-01-01 00:00:00";
		$rekeningju->tanggal->OldValue = $rekeningju->tanggal->CurrentValue;
		$rekeningju->tanggal_nota->CurrentValue = "1970-01-01";
		$rekeningju->tanggal_nota->OldValue = $rekeningju->tanggal_nota->CurrentValue;
		$rekeningju->kode_otomatis->CurrentValue = unik();
		$rekeningju->kode_otomatis->OldValue = $rekeningju->kode_otomatis->CurrentValue;
		$rekeningju->kode_otomatis_tingkat->CurrentValue = $_SESSION["kode_otomatis_tingkat"];
		$rekeningju->kode_otomatis_tingkat->OldValue = $rekeningju->kode_otomatis_tingkat->CurrentValue;
		$rekeningju->apakah_original->CurrentValue = "y";
		$rekeningju->apakah_original->OldValue = $rekeningju->apakah_original->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $rekeningju;
		if (!$rekeningju->NoRek->FldIsDetailKey) {
			$rekeningju->NoRek->setFormValue($objForm->GetValue("x_NoRek"));
		}
		$rekeningju->NoRek->setOldValue($objForm->GetValue("o_NoRek"));
		if (!$rekeningju->Keterangan->FldIsDetailKey) {
			$rekeningju->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		$rekeningju->Keterangan->setOldValue($objForm->GetValue("o_Keterangan"));
		if (!$rekeningju->debet->FldIsDetailKey) {
			$rekeningju->debet->setFormValue($objForm->GetValue("x_debet"));
		}
		$rekeningju->debet->setOldValue($objForm->GetValue("o_debet"));
		if (!$rekeningju->kredit->FldIsDetailKey) {
			$rekeningju->kredit->setFormValue($objForm->GetValue("x_kredit"));
		}
		$rekeningju->kredit->setOldValue($objForm->GetValue("o_kredit"));
		if (!$rekeningju->kode_bukti->FldIsDetailKey) {
			$rekeningju->kode_bukti->setFormValue($objForm->GetValue("x_kode_bukti"));
		}
		$rekeningju->kode_bukti->setOldValue($objForm->GetValue("o_kode_bukti"));
		if (!$rekeningju->tanggal->FldIsDetailKey) {
			$rekeningju->tanggal->setFormValue($objForm->GetValue("x_tanggal"));
			$rekeningju->tanggal->CurrentValue = ew_UnFormatDateTime($rekeningju->tanggal->CurrentValue, 7);
		}
		$rekeningju->tanggal->setOldValue($objForm->GetValue("o_tanggal"));
		if (!$rekeningju->tanggal_nota->FldIsDetailKey) {
			$rekeningju->tanggal_nota->setFormValue($objForm->GetValue("x_tanggal_nota"));
			$rekeningju->tanggal_nota->CurrentValue = ew_UnFormatDateTime($rekeningju->tanggal_nota->CurrentValue, 7);
		}
		$rekeningju->tanggal_nota->setOldValue($objForm->GetValue("o_tanggal_nota"));
		if (!$rekeningju->kode_otomatis->FldIsDetailKey) {
			$rekeningju->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		$rekeningju->kode_otomatis->setOldValue($objForm->GetValue("o_kode_otomatis"));
		if (!$rekeningju->kode_otomatis_tingkat->FldIsDetailKey) {
			$rekeningju->kode_otomatis_tingkat->setFormValue($objForm->GetValue("x_kode_otomatis_tingkat"));
		}
		$rekeningju->kode_otomatis_tingkat->setOldValue($objForm->GetValue("o_kode_otomatis_tingkat"));
		if (!$rekeningju->apakah_original->FldIsDetailKey) {
			$rekeningju->apakah_original->setFormValue($objForm->GetValue("x_apakah_original"));
		}
		$rekeningju->apakah_original->setOldValue($objForm->GetValue("o_apakah_original"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $rekeningju;
		$rekeningju->NoRek->CurrentValue = $rekeningju->NoRek->FormValue;
		$rekeningju->Keterangan->CurrentValue = $rekeningju->Keterangan->FormValue;
		$rekeningju->debet->CurrentValue = $rekeningju->debet->FormValue;
		$rekeningju->kredit->CurrentValue = $rekeningju->kredit->FormValue;
		$rekeningju->kode_bukti->CurrentValue = $rekeningju->kode_bukti->FormValue;
		$rekeningju->tanggal->CurrentValue = $rekeningju->tanggal->FormValue;
		$rekeningju->tanggal->CurrentValue = ew_UnFormatDateTime($rekeningju->tanggal->CurrentValue, 7);
		$rekeningju->tanggal_nota->CurrentValue = $rekeningju->tanggal_nota->FormValue;
		$rekeningju->tanggal_nota->CurrentValue = ew_UnFormatDateTime($rekeningju->tanggal_nota->CurrentValue, 7);
		$rekeningju->kode_otomatis->CurrentValue = $rekeningju->kode_otomatis->FormValue;
		$rekeningju->kode_otomatis_tingkat->CurrentValue = $rekeningju->kode_otomatis_tingkat->FormValue;
		$rekeningju->apakah_original->CurrentValue = $rekeningju->apakah_original->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $rekeningju;

		// Call Recordset Selecting event
		$rekeningju->Recordset_Selecting($rekeningju->CurrentFilter);

		// Load List page SQL
		$sSql = $rekeningju->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$rekeningju->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $rekeningju;
		$sFilter = $rekeningju->KeyFilter();

		// Call Row Selecting event
		$rekeningju->Row_Selecting($sFilter);

		// Load SQL based on filter
		$rekeningju->CurrentFilter = $sFilter;
		$sSql = $rekeningju->SQL();
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
		global $conn, $rekeningju;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$rekeningju->Row_Selected($row);
		$rekeningju->NoRek->setDbValue($rs->fields('NoRek'));
		$rekeningju->Keterangan->setDbValue($rs->fields('Keterangan'));
		$rekeningju->debet->setDbValue($rs->fields('debet'));
		$rekeningju->kredit->setDbValue($rs->fields('kredit'));
		$rekeningju->kode_bukti->setDbValue($rs->fields('kode_bukti'));
		$rekeningju->tanggal->setDbValue($rs->fields('tanggal'));
		$rekeningju->kode_otomatis_master->setDbValue($rs->fields('kode_otomatis_master'));
		$rekeningju->tanggal_nota->setDbValue($rs->fields('tanggal_nota'));
		$rekeningju->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$rekeningju->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$rekeningju->id->setDbValue($rs->fields('id'));
		$rekeningju->apakah_original->setDbValue($rs->fields('apakah_original'));
	}

	// Load old record
	function LoadOldRecord() {
		global $rekeningju;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($rekeningju->getKey("kode_otomatis")) <> "")
			$rekeningju->kode_otomatis->CurrentValue = $rekeningju->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$rekeningju->CurrentFilter = $rekeningju->KeyFilter();
			$sSql = $rekeningju->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $rekeningju;

		// Initialize URLs
		$this->ViewUrl = $rekeningju->ViewUrl();
		$this->EditUrl = $rekeningju->EditUrl();
		$this->InlineEditUrl = $rekeningju->InlineEditUrl();
		$this->CopyUrl = $rekeningju->CopyUrl();
		$this->InlineCopyUrl = $rekeningju->InlineCopyUrl();
		$this->DeleteUrl = $rekeningju->DeleteUrl();

		// Call Row_Rendering event
		$rekeningju->Row_Rendering();

		// Common render codes for all row types
		// NoRek
		// Keterangan
		// debet
		// kredit
		// kode_bukti
		// tanggal
		// kode_otomatis_master

		$rekeningju->kode_otomatis_master->CellCssStyle = "white-space: nowrap;";

		// tanggal_nota
		// kode_otomatis

		$rekeningju->kode_otomatis->CellCssStyle = "white-space: nowrap;";

		// kode_otomatis_tingkat
		$rekeningju->kode_otomatis_tingkat->CellCssStyle = "white-space: nowrap;";

		// id
		$rekeningju->id->CellCssStyle = "white-space: nowrap;";

		// apakah_original
		if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View row

			// NoRek
			if (strval($rekeningju->NoRek->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($rekeningju->NoRek->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rekeningju->NoRek->ViewValue = $rswrk->fields('Norek');
					$rekeningju->NoRek->ViewValue .= ew_ValueSeparator(0,1,$rekeningju->NoRek) . $rswrk->fields('Keterangan');
					$rswrk->Close();
				} else {
					$rekeningju->NoRek->ViewValue = $rekeningju->NoRek->CurrentValue;
				}
			} else {
				$rekeningju->NoRek->ViewValue = NULL;
			}
			$rekeningju->NoRek->ViewCustomAttributes = "";

			// Keterangan
			$rekeningju->Keterangan->ViewValue = $rekeningju->Keterangan->CurrentValue;
			$rekeningju->Keterangan->ViewCustomAttributes = "";

			// debet
			$rekeningju->debet->ViewValue = $rekeningju->debet->CurrentValue;
			$rekeningju->debet->ViewCustomAttributes = "";

			// kredit
			$rekeningju->kredit->ViewValue = $rekeningju->kredit->CurrentValue;
			$rekeningju->kredit->ViewCustomAttributes = "";

			// kode_bukti
			$rekeningju->kode_bukti->ViewValue = $rekeningju->kode_bukti->CurrentValue;
			$rekeningju->kode_bukti->ViewCustomAttributes = "";

			// tanggal
			$rekeningju->tanggal->ViewValue = $rekeningju->tanggal->CurrentValue;
			$rekeningju->tanggal->ViewValue = ew_FormatDateTime($rekeningju->tanggal->ViewValue, 7);
			$rekeningju->tanggal->ViewCustomAttributes = "";

			// tanggal_nota
			$rekeningju->tanggal_nota->ViewValue = $rekeningju->tanggal_nota->CurrentValue;
			$rekeningju->tanggal_nota->ViewValue = ew_FormatDateTime($rekeningju->tanggal_nota->ViewValue, 7);
			$rekeningju->tanggal_nota->ViewCustomAttributes = "";

			// kode_otomatis
			$rekeningju->kode_otomatis->ViewValue = $rekeningju->kode_otomatis->CurrentValue;
			$rekeningju->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_tingkat
			$rekeningju->kode_otomatis_tingkat->ViewValue = $rekeningju->kode_otomatis_tingkat->CurrentValue;
			$rekeningju->kode_otomatis_tingkat->ViewCustomAttributes = "";

			// apakah_original
			$rekeningju->apakah_original->ViewValue = $rekeningju->apakah_original->CurrentValue;
			$rekeningju->apakah_original->ViewCustomAttributes = "";

			// NoRek
			$rekeningju->NoRek->LinkCustomAttributes = "";
			$rekeningju->NoRek->HrefValue = "";
			$rekeningju->NoRek->TooltipValue = "";

			// Keterangan
			$rekeningju->Keterangan->LinkCustomAttributes = "";
			$rekeningju->Keterangan->HrefValue = "";
			$rekeningju->Keterangan->TooltipValue = "";

			// debet
			$rekeningju->debet->LinkCustomAttributes = "";
			$rekeningju->debet->HrefValue = "";
			$rekeningju->debet->TooltipValue = "";

			// kredit
			$rekeningju->kredit->LinkCustomAttributes = "";
			$rekeningju->kredit->HrefValue = "";
			$rekeningju->kredit->TooltipValue = "";

			// kode_bukti
			$rekeningju->kode_bukti->LinkCustomAttributes = "";
			$rekeningju->kode_bukti->HrefValue = "";
			$rekeningju->kode_bukti->TooltipValue = "";

			// tanggal
			$rekeningju->tanggal->LinkCustomAttributes = "";
			$rekeningju->tanggal->HrefValue = "";
			$rekeningju->tanggal->TooltipValue = "";

			// tanggal_nota
			$rekeningju->tanggal_nota->LinkCustomAttributes = "";
			$rekeningju->tanggal_nota->HrefValue = "";
			$rekeningju->tanggal_nota->TooltipValue = "";

			// kode_otomatis
			$rekeningju->kode_otomatis->LinkCustomAttributes = "";
			$rekeningju->kode_otomatis->HrefValue = "";
			$rekeningju->kode_otomatis->TooltipValue = "";

			// kode_otomatis_tingkat
			$rekeningju->kode_otomatis_tingkat->LinkCustomAttributes = "";
			$rekeningju->kode_otomatis_tingkat->HrefValue = "";
			$rekeningju->kode_otomatis_tingkat->TooltipValue = "";

			// apakah_original
			$rekeningju->apakah_original->LinkCustomAttributes = "";
			$rekeningju->apakah_original->HrefValue = "";
			$rekeningju->apakah_original->TooltipValue = "";
		} elseif ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add row

			// NoRek
			$rekeningju->NoRek->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Norek`, `Norek` AS `DispFld`, `Keterangan` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Norek` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$rekeningju->NoRek->EditValue = $arwrk;

			// Keterangan
			$rekeningju->Keterangan->EditCustomAttributes = "";
			$rekeningju->Keterangan->EditValue = ew_HtmlEncode($rekeningju->Keterangan->CurrentValue);

			// debet
			$rekeningju->debet->EditCustomAttributes = "";
			$rekeningju->debet->EditValue = ew_HtmlEncode($rekeningju->debet->CurrentValue);

			// kredit
			$rekeningju->kredit->EditCustomAttributes = "";
			$rekeningju->kredit->EditValue = ew_HtmlEncode($rekeningju->kredit->CurrentValue);

			// kode_bukti
			$rekeningju->kode_bukti->EditCustomAttributes = "";
			$rekeningju->kode_bukti->EditValue = ew_HtmlEncode($rekeningju->kode_bukti->CurrentValue);

			// tanggal
			$rekeningju->tanggal->EditCustomAttributes = "";
			$rekeningju->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($rekeningju->tanggal->CurrentValue, 7));

			// tanggal_nota
			$rekeningju->tanggal_nota->EditCustomAttributes = "";
			$rekeningju->tanggal_nota->EditValue = ew_HtmlEncode(ew_FormatDateTime($rekeningju->tanggal_nota->CurrentValue, 7));

			// kode_otomatis
			$rekeningju->kode_otomatis->EditCustomAttributes = "";
			$rekeningju->kode_otomatis->CurrentValue = unik();

			// kode_otomatis_tingkat
			$rekeningju->kode_otomatis_tingkat->EditCustomAttributes = "";
			$rekeningju->kode_otomatis_tingkat->CurrentValue = $_SESSION["kode_otomatis_tingkat"];

			// apakah_original
			$rekeningju->apakah_original->EditCustomAttributes = "";
			$rekeningju->apakah_original->EditValue = ew_HtmlEncode($rekeningju->apakah_original->CurrentValue);

			// Edit refer script
			// NoRek

			$rekeningju->NoRek->HrefValue = "";

			// Keterangan
			$rekeningju->Keterangan->HrefValue = "";

			// debet
			$rekeningju->debet->HrefValue = "";

			// kredit
			$rekeningju->kredit->HrefValue = "";

			// kode_bukti
			$rekeningju->kode_bukti->HrefValue = "";

			// tanggal
			$rekeningju->tanggal->HrefValue = "";

			// tanggal_nota
			$rekeningju->tanggal_nota->HrefValue = "";

			// kode_otomatis
			$rekeningju->kode_otomatis->HrefValue = "";

			// kode_otomatis_tingkat
			$rekeningju->kode_otomatis_tingkat->HrefValue = "";

			// apakah_original
			$rekeningju->apakah_original->HrefValue = "";
		}
		if ($rekeningju->RowType == EW_ROWTYPE_ADD ||
			$rekeningju->RowType == EW_ROWTYPE_EDIT ||
			$rekeningju->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$rekeningju->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($rekeningju->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$rekeningju->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $rekeningju;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($rekeningju->NoRek->FormValue) && $rekeningju->NoRek->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->NoRek->FldCaption());
		}
		if (!is_null($rekeningju->debet->FormValue) && $rekeningju->debet->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->debet->FldCaption());
		}
		if (!ew_CheckNumber($rekeningju->debet->FormValue)) {
			ew_AddMessage($gsFormError, $rekeningju->debet->FldErrMsg());
		}
		if (!is_null($rekeningju->kredit->FormValue) && $rekeningju->kredit->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->kredit->FldCaption());
		}
		if (!ew_CheckNumber($rekeningju->kredit->FormValue)) {
			ew_AddMessage($gsFormError, $rekeningju->kredit->FldErrMsg());
		}
		if (!is_null($rekeningju->tanggal->FormValue) && $rekeningju->tanggal->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->tanggal->FldCaption());
		}
		if (!ew_CheckEuroDate($rekeningju->tanggal->FormValue)) {
			ew_AddMessage($gsFormError, $rekeningju->tanggal->FldErrMsg());
		}
		if (!is_null($rekeningju->tanggal_nota->FormValue) && $rekeningju->tanggal_nota->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->tanggal_nota->FldCaption());
		}
		if (!ew_CheckEuroDate($rekeningju->tanggal_nota->FormValue)) {
			ew_AddMessage($gsFormError, $rekeningju->tanggal_nota->FldErrMsg());
		}
		if (!is_null($rekeningju->apakah_original->FormValue) && $rekeningju->apakah_original->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $rekeningju->apakah_original->FldCaption());
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
		global $conn, $Language, $Security, $rekeningju;
		$DeleteRows = TRUE;
		$sSql = $rekeningju->SQL();
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
				$DeleteRows = $rekeningju->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($rekeningju->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($rekeningju->CancelMessage <> "") {
				$this->setFailureMessage($rekeningju->CancelMessage);
				$rekeningju->CancelMessage = "";
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
				$rekeningju->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $rekeningju;

		// Check if key value entered
		if ($rekeningju->kode_otomatis->CurrentValue == "" && $rekeningju->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $rekeningju->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $rekeningju->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($rekeningju->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($rekeningju->kode_otomatis->CurrentValue) . "')";
			$rsChk = $rekeningju->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $rekeningju->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// NoRek
		$rekeningju->NoRek->SetDbValueDef($rsnew, $rekeningju->NoRek->CurrentValue, "", strval($rekeningju->NoRek->CurrentValue) == "");

		// Keterangan
		$rekeningju->Keterangan->SetDbValueDef($rsnew, $rekeningju->Keterangan->CurrentValue, NULL, strval($rekeningju->Keterangan->CurrentValue) == "");

		// debet
		$rekeningju->debet->SetDbValueDef($rsnew, $rekeningju->debet->CurrentValue, 0, strval($rekeningju->debet->CurrentValue) == "");

		// kredit
		$rekeningju->kredit->SetDbValueDef($rsnew, $rekeningju->kredit->CurrentValue, 0, strval($rekeningju->kredit->CurrentValue) == "");

		// kode_bukti
		$rekeningju->kode_bukti->SetDbValueDef($rsnew, $rekeningju->kode_bukti->CurrentValue, NULL, strval($rekeningju->kode_bukti->CurrentValue) == "");

		// tanggal
		$rekeningju->tanggal->SetDbValueDef($rsnew, ew_UnFormatDateTime($rekeningju->tanggal->CurrentValue, 7), ew_CurrentDate(), strval($rekeningju->tanggal->CurrentValue) == "");

		// tanggal_nota
		$rekeningju->tanggal_nota->SetDbValueDef($rsnew, ew_UnFormatDateTime($rekeningju->tanggal_nota->CurrentValue, 7), ew_CurrentDate(), strval($rekeningju->tanggal_nota->CurrentValue) == "");

		// kode_otomatis
		$rekeningju->kode_otomatis->SetDbValueDef($rsnew, $rekeningju->kode_otomatis->CurrentValue, "", FALSE);

		// kode_otomatis_tingkat
		$rekeningju->kode_otomatis_tingkat->SetDbValueDef($rsnew, $rekeningju->kode_otomatis_tingkat->CurrentValue, "", FALSE);

		// apakah_original
		$rekeningju->apakah_original->SetDbValueDef($rsnew, $rekeningju->apakah_original->CurrentValue, "", strval($rekeningju->apakah_original->CurrentValue) == "");

		// kode_otomatis_master
		if ($rekeningju->kode_otomatis_master->getSessionValue() <> "") {
			$rsnew['kode_otomatis_master'] = $rekeningju->kode_otomatis_master->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $rekeningju->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($rekeningju->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($rekeningju->CancelMessage <> "") {
				$this->setFailureMessage($rekeningju->CancelMessage);
				$rekeningju->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$rekeningju->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $rekeningju->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$rekeningju->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $rekeningju;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "master_transaksi2") {
				$bValidMaster = TRUE;
				if (@$_GET["kode_otomatis"] <> "") {
					$GLOBALS["master_transaksi2"]->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
					$rekeningju->kode_otomatis_master->setQueryStringValue($GLOBALS["master_transaksi2"]->kode_otomatis->QueryStringValue);
					$rekeningju->kode_otomatis_master->setSessionValue($rekeningju->kode_otomatis_master->QueryStringValue);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$rekeningju->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$rekeningju->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "master_transaksi2") {
				if ($rekeningju->kode_otomatis_master->QueryStringValue == "") $rekeningju->kode_otomatis_master->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $rekeningju->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $rekeningju->getDetailFilter(); // Get detail filter
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
	 
		
	$Language->setPhrase("tbltypetable",""); 
	$Language->setPhrase("masterrecord","");
	
	
	
	
	$judul= "Silahkan Anda Entri Ayat-ayat Akuntansi Manual... "  ;
	   
	$Language->setTablePhrase(CurrentTable()->TableName, "TblCaption", $judul);  
	$Language->setTablePhrase("master_transaksi2", "TblCaption", "Penjelasan Transaksi");
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

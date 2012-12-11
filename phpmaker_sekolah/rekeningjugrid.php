<?php include_once "penggunainfo.php" ?>
<?php

// Create page object
$rekeningju_grid = new crekeningju_grid();
$MasterPage =& $Page;
$Page =& $rekeningju_grid;

// Page init
$rekeningju_grid->Page_Init();

// Page main
$rekeningju_grid->Page_Main();
?>
<?php if ($rekeningju->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var rekeningju_grid = new ew_Page("rekeningju_grid");

// page properties
rekeningju_grid.PageID = "grid"; // page ID
rekeningju_grid.FormID = "frekeningjugrid"; // form ID
var EW_PAGE_ID = rekeningju_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
rekeningju_grid.ValidateForm = function(fobj) {
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
	return true;
}

// Extend page with empty row check
rekeningju_grid.EmptyRow = function(fobj, infix) {
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
rekeningju_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
rekeningju_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rekeningju_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<?php } ?>
<?php
if ($rekeningju->CurrentAction == "gridadd") {
	if ($rekeningju->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$rekeningju_grid->TotalRecs = $rekeningju->SelectRecordCount();
			$rekeningju_grid->Recordset = $rekeningju_grid->LoadRecordset($rekeningju_grid->StartRec-1, $rekeningju_grid->DisplayRecs);
		} else {
			if ($rekeningju_grid->Recordset = $rekeningju_grid->LoadRecordset())
				$rekeningju_grid->TotalRecs = $rekeningju_grid->Recordset->RecordCount();
		}
		$rekeningju_grid->StartRec = 1;
		$rekeningju_grid->DisplayRecs = $rekeningju_grid->TotalRecs;
	} else {
		$rekeningju->CurrentFilter = "0=1";
		$rekeningju_grid->StartRec = 1;
		$rekeningju_grid->DisplayRecs = $rekeningju->GridAddRowCount;
	}
	$rekeningju_grid->TotalRecs = $rekeningju_grid->DisplayRecs;
	$rekeningju_grid->StopRec = $rekeningju_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$rekeningju_grid->TotalRecs = $rekeningju->SelectRecordCount();
	} else {
		if ($rekeningju_grid->Recordset = $rekeningju_grid->LoadRecordset())
			$rekeningju_grid->TotalRecs = $rekeningju_grid->Recordset->RecordCount();
	}
	$rekeningju_grid->StartRec = 1;
	$rekeningju_grid->DisplayRecs = $rekeningju_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$rekeningju_grid->Recordset = $rekeningju_grid->LoadRecordset($rekeningju_grid->StartRec-1, $rekeningju_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($rekeningju->CurrentMode == "add" || $rekeningju->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($rekeningju->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $rekeningju->TableCaption() ?></p>
</p>
<?php $rekeningju_grid->ShowPageHeader(); ?>
<?php
$rekeningju_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if (($rekeningju->CurrentMode == "add" || $rekeningju->CurrentMode == "copy" || $rekeningju->CurrentMode == "edit") && $rekeningju->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridUpperPanel">
</div>
<?php } ?>
<div id="gmp_rekeningju" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $rekeningju->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$rekeningju_grid->RenderListOptions();

// Render list options (header, left)
$rekeningju_grid->ListOptions->Render("header", "left");
?>
<?php if ($rekeningju->NoRek->Visible) { // NoRek ?>
	<?php if ($rekeningju->SortUrl($rekeningju->NoRek) == "") { ?>
		<td><?php echo $rekeningju->NoRek->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->NoRek->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->NoRek->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->NoRek->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->Keterangan->Visible) { // Keterangan ?>
	<?php if ($rekeningju->SortUrl($rekeningju->Keterangan) == "") { ?>
		<td><?php echo $rekeningju->Keterangan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->Keterangan->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->Keterangan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->Keterangan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->debet->Visible) { // debet ?>
	<?php if ($rekeningju->SortUrl($rekeningju->debet) == "") { ?>
		<td><?php echo $rekeningju->debet->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->debet->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->debet->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->debet->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->kredit->Visible) { // kredit ?>
	<?php if ($rekeningju->SortUrl($rekeningju->kredit) == "") { ?>
		<td><?php echo $rekeningju->kredit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->kredit->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->kredit->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->kredit->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->kode_bukti->Visible) { // kode_bukti ?>
	<?php if ($rekeningju->SortUrl($rekeningju->kode_bukti) == "") { ?>
		<td><?php echo $rekeningju->kode_bukti->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->kode_bukti->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->kode_bukti->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->kode_bukti->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->tanggal->Visible) { // tanggal ?>
	<?php if ($rekeningju->SortUrl($rekeningju->tanggal) == "") { ?>
		<td><?php echo $rekeningju->tanggal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->tanggal->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->tanggal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->tanggal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->tanggal_nota->Visible) { // tanggal_nota ?>
	<?php if ($rekeningju->SortUrl($rekeningju->tanggal_nota) == "") { ?>
		<td><?php echo $rekeningju->tanggal_nota->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->tanggal_nota->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->tanggal_nota->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->tanggal_nota->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($rekeningju->SortUrl($rekeningju->kode_otomatis) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $rekeningju->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $rekeningju->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
	<?php if ($rekeningju->SortUrl($rekeningju->kode_otomatis_tingkat) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $rekeningju->kode_otomatis_tingkat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $rekeningju->kode_otomatis_tingkat->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->kode_otomatis_tingkat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->kode_otomatis_tingkat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rekeningju->apakah_original->Visible) { // apakah_original ?>
	<?php if ($rekeningju->SortUrl($rekeningju->apakah_original) == "") { ?>
		<td><?php echo $rekeningju->apakah_original->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rekeningju->apakah_original->FldCaption() ?></td><td style="width: 10px;"><?php if ($rekeningju->apakah_original->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rekeningju->apakah_original->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$rekeningju_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$rekeningju_grid->StartRec = 1;
$rekeningju_grid->StopRec = $rekeningju_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($rekeningju->CurrentAction == "gridadd" || $rekeningju->CurrentAction == "gridedit" || $rekeningju->CurrentAction == "F")) {
		$rekeningju_grid->KeyCount = $objForm->GetValue("key_count");
		$rekeningju_grid->StopRec = $rekeningju_grid->KeyCount;
	}
}
$rekeningju_grid->RecCnt = $rekeningju_grid->StartRec - 1;
if ($rekeningju_grid->Recordset && !$rekeningju_grid->Recordset->EOF) {
	$rekeningju_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $rekeningju_grid->StartRec > 1)
		$rekeningju_grid->Recordset->Move($rekeningju_grid->StartRec - 1);
} elseif (!$rekeningju->AllowAddDeleteRow && $rekeningju_grid->StopRec == 0) {
	$rekeningju_grid->StopRec = $rekeningju->GridAddRowCount;
}

// Initialize aggregate
$rekeningju->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rekeningju->ResetAttrs();
$rekeningju_grid->RenderRow();
$rekeningju_grid->RowCnt = 0;
if ($rekeningju->CurrentAction == "gridadd")
	$rekeningju_grid->RowIndex = 0;
if ($rekeningju->CurrentAction == "gridedit")
	$rekeningju_grid->RowIndex = 0;
while ($rekeningju_grid->RecCnt < $rekeningju_grid->StopRec) {
	$rekeningju_grid->RecCnt++;
	if (intval($rekeningju_grid->RecCnt) >= intval($rekeningju_grid->StartRec)) {
		$rekeningju_grid->RowCnt++;
		if ($rekeningju->CurrentAction == "gridadd" || $rekeningju->CurrentAction == "gridedit" || $rekeningju->CurrentAction == "F")
			$rekeningju_grid->RowIndex++;

		// Set up key count
		$rekeningju_grid->KeyCount = $rekeningju_grid->RowIndex;

		// Init row class and style
		$rekeningju->ResetAttrs();
		$rekeningju->CssClass = "";
		if ($rekeningju->CurrentAction == "gridadd") {
			if ($rekeningju->CurrentMode == "copy") {
				$rekeningju_grid->LoadRowValues($rekeningju_grid->Recordset); // Load row values
				$rekeningju_grid->SetRecordKey($rekeningju_grid->RowOldKey, $rekeningju_grid->Recordset); // Set old record key
			} else {
				$rekeningju_grid->LoadDefaultValues(); // Load default values
				$rekeningju_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($rekeningju->CurrentAction == "gridedit") {
			$rekeningju_grid->LoadRowValues($rekeningju_grid->Recordset); // Load row values
		}
		$rekeningju->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($rekeningju->CurrentAction == "gridadd") // Grid add
			$rekeningju->RowType = EW_ROWTYPE_ADD; // Render add
		if ($rekeningju->CurrentAction == "gridadd" && $rekeningju->EventCancelled) // Insert failed
			$rekeningju_grid->RestoreCurrentRowFormValues($rekeningju_grid->RowIndex); // Restore form values
		if ($rekeningju->CurrentAction == "gridedit") { // Grid edit
			if ($rekeningju->EventCancelled) {
				$rekeningju_grid->RestoreCurrentRowFormValues($rekeningju_grid->RowIndex); // Restore form values
			}
			if ($rekeningju_grid->RowAction == "insert")
				$rekeningju->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$rekeningju->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($rekeningju->CurrentAction == "gridedit" && ($rekeningju->RowType == EW_ROWTYPE_EDIT || $rekeningju->RowType == EW_ROWTYPE_ADD) && $rekeningju->EventCancelled) // Update failed
			$rekeningju_grid->RestoreCurrentRowFormValues($rekeningju_grid->RowIndex); // Restore form values
		if ($rekeningju->RowType == EW_ROWTYPE_EDIT) // Edit row
			$rekeningju_grid->EditRowCnt++;
		if ($rekeningju->CurrentAction == "F") // Confirm row
			$rekeningju_grid->RestoreCurrentRowFormValues($rekeningju_grid->RowIndex); // Restore form values
		if ($rekeningju->RowType == EW_ROWTYPE_ADD || $rekeningju->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($rekeningju->CurrentAction == "edit") {
				$rekeningju->RowAttrs = array();
				$rekeningju->CssClass = "ewTableEditRow";
			} else {
				$rekeningju->RowAttrs = array();
			}
			if (!empty($rekeningju_grid->RowIndex))
				$rekeningju->RowAttrs = array_merge($rekeningju->RowAttrs, array('data-rowindex'=>$rekeningju_grid->RowIndex, 'id'=>'r' . $rekeningju_grid->RowIndex . '_rekeningju'));
		} else {
			$rekeningju->RowAttrs = array();
		}

		// Render row
		$rekeningju_grid->RenderRow();

		// Render list options
		$rekeningju_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($rekeningju_grid->RowAction <> "delete" && $rekeningju_grid->RowAction <> "insertdelete" && !($rekeningju_grid->RowAction == "insert" && $rekeningju->CurrentAction == "F" && $rekeningju_grid->EmptyRow())) {
?>
	<tr<?php echo $rekeningju->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rekeningju_grid->ListOptions->Render("body", "left");
?>
	<?php if ($rekeningju->NoRek->Visible) { // NoRek ?>
		<td<?php echo $rekeningju->NoRek->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $rekeningju_grid->RowIndex ?>_NoRek" name="x<?php echo $rekeningju_grid->RowIndex ?>_NoRek"<?php echo $rekeningju->NoRek->EditAttributes() ?>>
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
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_NoRek" id="o<?php echo $rekeningju_grid->RowIndex ?>_NoRek" value="<?php echo ew_HtmlEncode($rekeningju->NoRek->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $rekeningju_grid->RowIndex ?>_NoRek" name="x<?php echo $rekeningju_grid->RowIndex ?>_NoRek"<?php echo $rekeningju->NoRek->EditAttributes() ?>>
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
</option>
<?php
	}
}
if (@$emptywrk) $rekeningju->NoRek->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->NoRek->ViewAttributes() ?>><?php echo $rekeningju->NoRek->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_NoRek" id="x<?php echo $rekeningju_grid->RowIndex ?>_NoRek" value="<?php echo ew_HtmlEncode($rekeningju->NoRek->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_NoRek" id="o<?php echo $rekeningju_grid->RowIndex ?>_NoRek" value="<?php echo ew_HtmlEncode($rekeningju->NoRek->OldValue) ?>">
<?php } ?>
<a name="<?php echo $rekeningju_grid->PageObjName . "_row_" . $rekeningju_grid->RowCnt ?>" id="<?php echo $rekeningju_grid->PageObjName . "_row_" . $rekeningju_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($rekeningju->Keterangan->Visible) { // Keterangan ?>
		<td<?php echo $rekeningju->Keterangan->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" id="x<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" size="30" maxlength="100" value="<?php echo $rekeningju->Keterangan->EditValue ?>"<?php echo $rekeningju->Keterangan->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" id="o<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($rekeningju->Keterangan->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" id="x<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" size="30" maxlength="100" value="<?php echo $rekeningju->Keterangan->EditValue ?>"<?php echo $rekeningju->Keterangan->EditAttributes() ?>>
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->Keterangan->ViewAttributes() ?>><?php echo $rekeningju->Keterangan->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" id="x<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($rekeningju->Keterangan->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" id="o<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($rekeningju->Keterangan->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->debet->Visible) { // debet ?>
		<td<?php echo $rekeningju->debet->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_debet" id="x<?php echo $rekeningju_grid->RowIndex ?>_debet" size="30" value="<?php echo $rekeningju->debet->EditValue ?>"<?php echo $rekeningju->debet->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_debet" id="o<?php echo $rekeningju_grid->RowIndex ?>_debet" value="<?php echo ew_HtmlEncode($rekeningju->debet->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_debet" id="x<?php echo $rekeningju_grid->RowIndex ?>_debet" size="30" value="<?php echo $rekeningju->debet->EditValue ?>"<?php echo $rekeningju->debet->EditAttributes() ?>>
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->debet->ViewAttributes() ?>><?php echo $rekeningju->debet->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_debet" id="x<?php echo $rekeningju_grid->RowIndex ?>_debet" value="<?php echo ew_HtmlEncode($rekeningju->debet->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_debet" id="o<?php echo $rekeningju_grid->RowIndex ?>_debet" value="<?php echo ew_HtmlEncode($rekeningju->debet->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kredit->Visible) { // kredit ?>
		<td<?php echo $rekeningju->kredit->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_kredit" id="x<?php echo $rekeningju_grid->RowIndex ?>_kredit" size="30" value="<?php echo $rekeningju->kredit->EditValue ?>"<?php echo $rekeningju->kredit->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_kredit" id="o<?php echo $rekeningju_grid->RowIndex ?>_kredit" value="<?php echo ew_HtmlEncode($rekeningju->kredit->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_kredit" id="x<?php echo $rekeningju_grid->RowIndex ?>_kredit" size="30" value="<?php echo $rekeningju->kredit->EditValue ?>"<?php echo $rekeningju->kredit->EditAttributes() ?>>
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->kredit->ViewAttributes() ?>><?php echo $rekeningju->kredit->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kredit" id="x<?php echo $rekeningju_grid->RowIndex ?>_kredit" value="<?php echo ew_HtmlEncode($rekeningju->kredit->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_kredit" id="o<?php echo $rekeningju_grid->RowIndex ?>_kredit" value="<?php echo ew_HtmlEncode($rekeningju->kredit->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_bukti->Visible) { // kode_bukti ?>
		<td<?php echo $rekeningju->kode_bukti->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" size="30" maxlength="50" value="<?php echo $rekeningju->kode_bukti->EditValue ?>"<?php echo $rekeningju->kode_bukti->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" id="o<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" value="<?php echo ew_HtmlEncode($rekeningju->kode_bukti->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" size="30" maxlength="50" value="<?php echo $rekeningju->kode_bukti->EditValue ?>"<?php echo $rekeningju->kode_bukti->EditAttributes() ?>>
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->kode_bukti->ViewAttributes() ?>><?php echo $rekeningju->kode_bukti->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" value="<?php echo ew_HtmlEncode($rekeningju->kode_bukti->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" id="o<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" value="<?php echo ew_HtmlEncode($rekeningju->kode_bukti->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->tanggal->Visible) { // tanggal ?>
		<td<?php echo $rekeningju->tanggal->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" id="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" value="<?php echo $rekeningju->tanggal->EditValue ?>"<?php echo $rekeningju->tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" name="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $rekeningju_grid->RowIndex ?>_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" // button id
});
</script>
<input type="hidden" name="fo<?php echo $rekeningju_grid->RowIndex ?>_tanggal" id="fo<?php echo $rekeningju_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($rekeningju->tanggal->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_tanggal" id="o<?php echo $rekeningju_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($rekeningju->tanggal->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" id="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" value="<?php echo $rekeningju->tanggal->EditValue ?>"<?php echo $rekeningju->tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" name="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $rekeningju_grid->RowIndex ?>_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" // button id
});
</script>
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->tanggal->ViewAttributes() ?>><?php echo $rekeningju->tanggal->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" id="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($rekeningju->tanggal->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_tanggal" id="o<?php echo $rekeningju_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($rekeningju->tanggal->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->tanggal_nota->Visible) { // tanggal_nota ?>
		<td<?php echo $rekeningju->tanggal_nota->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" id="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" value="<?php echo $rekeningju->tanggal_nota->EditValue ?>"<?php echo $rekeningju->tanggal_nota->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" name="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" // button id
});
</script>
<input type="hidden" name="fo<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" id="fo<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($rekeningju->tanggal_nota->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" id="o<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" value="<?php echo ew_HtmlEncode($rekeningju->tanggal_nota->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" id="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" value="<?php echo $rekeningju->tanggal_nota->EditValue ?>"<?php echo $rekeningju->tanggal_nota->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" name="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" // button id
});
</script>
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->tanggal_nota->ViewAttributes() ?>><?php echo $rekeningju->tanggal_nota->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" id="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" value="<?php echo ew_HtmlEncode($rekeningju->tanggal_nota->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" id="o<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" value="<?php echo ew_HtmlEncode($rekeningju->tanggal_nota->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $rekeningju->kode_otomatis->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" id="o<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->CurrentValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->kode_otomatis->ViewAttributes() ?>><?php echo $rekeningju->kode_otomatis->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" id="o<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<td<?php echo $rekeningju->kode_otomatis_tingkat->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" id="o<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->CurrentValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->kode_otomatis_tingkat->ViewAttributes() ?>><?php echo $rekeningju->kode_otomatis_tingkat->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" id="o<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->apakah_original->Visible) { // apakah_original ?>
		<td<?php echo $rekeningju->apakah_original->CellAttributes() ?>>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" id="x<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" size="30" maxlength="1" value="<?php echo $rekeningju->apakah_original->EditValue ?>"<?php echo $rekeningju->apakah_original->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" id="o<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" value="<?php echo ew_HtmlEncode($rekeningju->apakah_original->OldValue) ?>">
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" id="x<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" size="30" maxlength="1" value="<?php echo $rekeningju->apakah_original->EditValue ?>"<?php echo $rekeningju->apakah_original->EditAttributes() ?>>
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $rekeningju->apakah_original->ViewAttributes() ?>><?php echo $rekeningju->apakah_original->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" id="x<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" value="<?php echo ew_HtmlEncode($rekeningju->apakah_original->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" id="o<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" value="<?php echo ew_HtmlEncode($rekeningju->apakah_original->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rekeningju_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($rekeningju->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($rekeningju->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($rekeningju->CurrentAction <> "gridadd" || $rekeningju->CurrentMode == "copy")
		if (!$rekeningju_grid->Recordset->EOF) $rekeningju_grid->Recordset->MoveNext();
}
?>
<?php
	if ($rekeningju->CurrentMode == "add" || $rekeningju->CurrentMode == "copy" || $rekeningju->CurrentMode == "edit") {
		$rekeningju_grid->RowIndex = '$rowindex$';
		$rekeningju_grid->LoadDefaultValues();

		// Set row properties
		$rekeningju->ResetAttrs();
		$rekeningju->RowAttrs = array();
		if (!empty($rekeningju_grid->RowIndex))
			$rekeningju->RowAttrs = array_merge($rekeningju->RowAttrs, array('data-rowindex'=>$rekeningju_grid->RowIndex, 'id'=>'r' . $rekeningju_grid->RowIndex . '_rekeningju'));
		$rekeningju->RowType = EW_ROWTYPE_ADD;

		// Render row
		$rekeningju_grid->RenderRow();

		// Render list options
		$rekeningju_grid->RenderListOptions();

		// Add id and class to the template row
		$rekeningju->RowAttrs["id"] = "r0_rekeningju";
		ew_AppendClass($rekeningju->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $rekeningju->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rekeningju_grid->ListOptions->Render("body", "left");
?>
	<?php if ($rekeningju->NoRek->Visible) { // NoRek ?>
		<td>
<?php if ($rekeningju->CurrentAction <> "F") { ?>
<select id="x<?php echo $rekeningju_grid->RowIndex ?>_NoRek" name="x<?php echo $rekeningju_grid->RowIndex ?>_NoRek"<?php echo $rekeningju->NoRek->EditAttributes() ?>>
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
<?php } else { ?>
<div<?php echo $rekeningju->NoRek->ViewAttributes() ?>><?php echo $rekeningju->NoRek->ViewValue ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_NoRek" id="x<?php echo $rekeningju_grid->RowIndex ?>_NoRek" value="<?php echo ew_HtmlEncode($rekeningju->NoRek->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->Keterangan->Visible) { // Keterangan ?>
		<td>
<?php if ($rekeningju->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" id="x<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" size="30" maxlength="100" value="<?php echo $rekeningju->Keterangan->EditValue ?>"<?php echo $rekeningju->Keterangan->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $rekeningju->Keterangan->ViewAttributes() ?>><?php echo $rekeningju->Keterangan->ViewValue ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" id="x<?php echo $rekeningju_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($rekeningju->Keterangan->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->debet->Visible) { // debet ?>
		<td>
<?php if ($rekeningju->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_debet" id="x<?php echo $rekeningju_grid->RowIndex ?>_debet" size="30" value="<?php echo $rekeningju->debet->EditValue ?>"<?php echo $rekeningju->debet->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $rekeningju->debet->ViewAttributes() ?>><?php echo $rekeningju->debet->ViewValue ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_debet" id="x<?php echo $rekeningju_grid->RowIndex ?>_debet" value="<?php echo ew_HtmlEncode($rekeningju->debet->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kredit->Visible) { // kredit ?>
		<td>
<?php if ($rekeningju->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_kredit" id="x<?php echo $rekeningju_grid->RowIndex ?>_kredit" size="30" value="<?php echo $rekeningju->kredit->EditValue ?>"<?php echo $rekeningju->kredit->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $rekeningju->kredit->ViewAttributes() ?>><?php echo $rekeningju->kredit->ViewValue ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kredit" id="x<?php echo $rekeningju_grid->RowIndex ?>_kredit" value="<?php echo ew_HtmlEncode($rekeningju->kredit->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_bukti->Visible) { // kode_bukti ?>
		<td>
<?php if ($rekeningju->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" size="30" maxlength="50" value="<?php echo $rekeningju->kode_bukti->EditValue ?>"<?php echo $rekeningju->kode_bukti->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $rekeningju->kode_bukti->ViewAttributes() ?>><?php echo $rekeningju->kode_bukti->ViewValue ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_bukti" value="<?php echo ew_HtmlEncode($rekeningju->kode_bukti->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->tanggal->Visible) { // tanggal ?>
		<td>
<?php if ($rekeningju->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" id="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" value="<?php echo $rekeningju->tanggal->EditValue ?>"<?php echo $rekeningju->tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" name="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $rekeningju_grid->RowIndex ?>_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" // button id
});
</script>
<?php } else { ?>
<div<?php echo $rekeningju->tanggal->ViewAttributes() ?>><?php echo $rekeningju->tanggal->ViewValue ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" id="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal" value="<?php echo ew_HtmlEncode($rekeningju->tanggal->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->tanggal_nota->Visible) { // tanggal_nota ?>
		<td>
<?php if ($rekeningju->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" id="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" value="<?php echo $rekeningju->tanggal_nota->EditValue ?>"<?php echo $rekeningju->tanggal_nota->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" name="cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" // button id
});
</script>
<?php } else { ?>
<div<?php echo $rekeningju->tanggal_nota->ViewAttributes() ?>><?php echo $rekeningju->tanggal_nota->ViewValue ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" id="x<?php echo $rekeningju_grid->RowIndex ?>_tanggal_nota" value="<?php echo ew_HtmlEncode($rekeningju->tanggal_nota->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_otomatis->Visible) { // kode_otomatis ?>
		<td>
<?php if ($rekeningju->CurrentAction <> "F") { ?>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->CurrentValue) ?>">
<?php } else { ?>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->kode_otomatis_tingkat->Visible) { // kode_otomatis_tingkat ?>
		<td>
<?php if ($rekeningju->CurrentAction <> "F") { ?>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->CurrentValue) ?>">
<?php } else { ?>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" id="x<?php echo $rekeningju_grid->RowIndex ?>_kode_otomatis_tingkat" value="<?php echo ew_HtmlEncode($rekeningju->kode_otomatis_tingkat->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rekeningju->apakah_original->Visible) { // apakah_original ?>
		<td>
<?php if ($rekeningju->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" id="x<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" size="30" maxlength="1" value="<?php echo $rekeningju->apakah_original->EditValue ?>"<?php echo $rekeningju->apakah_original->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $rekeningju->apakah_original->ViewAttributes() ?>><?php echo $rekeningju->apakah_original->ViewValue ?></div>
<input type="hidden" name="x<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" id="x<?php echo $rekeningju_grid->RowIndex ?>_apakah_original" value="<?php echo ew_HtmlEncode($rekeningju->apakah_original->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rekeningju_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($rekeningju->CurrentMode == "add" || $rekeningju->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $rekeningju_grid->KeyCount ?>">
<?php echo $rekeningju_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rekeningju->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $rekeningju_grid->KeyCount ?>">
<?php echo $rekeningju_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="rekeningju_grid">
</div>
<?php

// Close recordset
if ($rekeningju_grid->Recordset)
	$rekeningju_grid->Recordset->Close();
?>
</td></tr></table>
<?php if ($rekeningju->Export == "" && $rekeningju->CurrentAction == "") { ?>
<?php } ?>
<?php
$rekeningju_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$rekeningju_grid->Page_Terminate();
$Page =& $MasterPage;
?>

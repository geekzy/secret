<?php include_once "penggunainfo.php" ?>
<?php

// Create page object
$st_peserta_kelas_kelompok_grid = new cst_peserta_kelas_kelompok_grid();
$MasterPage =& $Page;
$Page =& $st_peserta_kelas_kelompok_grid;

// Page init
$st_peserta_kelas_kelompok_grid->Page_Init();

// Page main
$st_peserta_kelas_kelompok_grid->Page_Main();
?>
<?php if ($st_peserta_kelas_kelompok->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var st_peserta_kelas_kelompok_grid = new ew_Page("st_peserta_kelas_kelompok_grid");

// page properties
st_peserta_kelas_kelompok_grid.PageID = "grid"; // page ID
st_peserta_kelas_kelompok_grid.FormID = "fst_peserta_kelas_kelompokgrid"; // form ID
var EW_PAGE_ID = st_peserta_kelas_kelompok_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
st_peserta_kelas_kelompok_grid.ValidateForm = function(fobj) {
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
		} // End Grid Add checking
	}
	return true;
}

// Extend page with empty row check
st_peserta_kelas_kelompok_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "identitas", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kode_otomatis", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
st_peserta_kelas_kelompok_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_peserta_kelas_kelompok_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_peserta_kelas_kelompok_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($st_peserta_kelas_kelompok->CurrentAction == "gridadd") {
	if ($st_peserta_kelas_kelompok->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$st_peserta_kelas_kelompok_grid->TotalRecs = $st_peserta_kelas_kelompok->SelectRecordCount();
			$st_peserta_kelas_kelompok_grid->Recordset = $st_peserta_kelas_kelompok_grid->LoadRecordset($st_peserta_kelas_kelompok_grid->StartRec-1, $st_peserta_kelas_kelompok_grid->DisplayRecs);
		} else {
			if ($st_peserta_kelas_kelompok_grid->Recordset = $st_peserta_kelas_kelompok_grid->LoadRecordset())
				$st_peserta_kelas_kelompok_grid->TotalRecs = $st_peserta_kelas_kelompok_grid->Recordset->RecordCount();
		}
		$st_peserta_kelas_kelompok_grid->StartRec = 1;
		$st_peserta_kelas_kelompok_grid->DisplayRecs = $st_peserta_kelas_kelompok_grid->TotalRecs;
	} else {
		$st_peserta_kelas_kelompok->CurrentFilter = "0=1";
		$st_peserta_kelas_kelompok_grid->StartRec = 1;
		$st_peserta_kelas_kelompok_grid->DisplayRecs = $st_peserta_kelas_kelompok->GridAddRowCount;
	}
	$st_peserta_kelas_kelompok_grid->TotalRecs = $st_peserta_kelas_kelompok_grid->DisplayRecs;
	$st_peserta_kelas_kelompok_grid->StopRec = $st_peserta_kelas_kelompok_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$st_peserta_kelas_kelompok_grid->TotalRecs = $st_peserta_kelas_kelompok->SelectRecordCount();
	} else {
		if ($st_peserta_kelas_kelompok_grid->Recordset = $st_peserta_kelas_kelompok_grid->LoadRecordset())
			$st_peserta_kelas_kelompok_grid->TotalRecs = $st_peserta_kelas_kelompok_grid->Recordset->RecordCount();
	}
	$st_peserta_kelas_kelompok_grid->StartRec = 1;
	$st_peserta_kelas_kelompok_grid->DisplayRecs = $st_peserta_kelas_kelompok_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$st_peserta_kelas_kelompok_grid->Recordset = $st_peserta_kelas_kelompok_grid->LoadRecordset($st_peserta_kelas_kelompok_grid->StartRec-1, $st_peserta_kelas_kelompok_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($st_peserta_kelas_kelompok->CurrentMode == "add" || $st_peserta_kelas_kelompok->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($st_peserta_kelas_kelompok->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_peserta_kelas_kelompok->TableCaption() ?></p>
</p>
<?php $st_peserta_kelas_kelompok_grid->ShowPageHeader(); ?>
<?php
$st_peserta_kelas_kelompok_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if (($st_peserta_kelas_kelompok->CurrentMode == "add" || $st_peserta_kelas_kelompok->CurrentMode == "copy" || $st_peserta_kelas_kelompok->CurrentMode == "edit") && $st_peserta_kelas_kelompok->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridUpperPanel">
</div>
<?php } ?>
<div id="gmp_st_peserta_kelas_kelompok" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $st_peserta_kelas_kelompok->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$st_peserta_kelas_kelompok_grid->RenderListOptions();

// Render list options (header, left)
$st_peserta_kelas_kelompok_grid->ListOptions->Render("header", "left");
?>
<?php if ($st_peserta_kelas_kelompok->identitas->Visible) { // identitas ?>
	<?php if ($st_peserta_kelas_kelompok->SortUrl($st_peserta_kelas_kelompok->identitas) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $st_peserta_kelas_kelompok->identitas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $st_peserta_kelas_kelompok->identitas->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_peserta_kelas_kelompok->identitas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_peserta_kelas_kelompok->identitas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_peserta_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($st_peserta_kelas_kelompok->SortUrl($st_peserta_kelas_kelompok->kode_otomatis) == "") { ?>
		<td><?php echo $st_peserta_kelas_kelompok->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_peserta_kelas_kelompok->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_peserta_kelas_kelompok->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_peserta_kelas_kelompok->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$st_peserta_kelas_kelompok_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$st_peserta_kelas_kelompok_grid->StartRec = 1;
$st_peserta_kelas_kelompok_grid->StopRec = $st_peserta_kelas_kelompok_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($st_peserta_kelas_kelompok->CurrentAction == "gridadd" || $st_peserta_kelas_kelompok->CurrentAction == "gridedit" || $st_peserta_kelas_kelompok->CurrentAction == "F")) {
		$st_peserta_kelas_kelompok_grid->KeyCount = $objForm->GetValue("key_count");
		$st_peserta_kelas_kelompok_grid->StopRec = $st_peserta_kelas_kelompok_grid->KeyCount;
	}
}
$st_peserta_kelas_kelompok_grid->RecCnt = $st_peserta_kelas_kelompok_grid->StartRec - 1;
if ($st_peserta_kelas_kelompok_grid->Recordset && !$st_peserta_kelas_kelompok_grid->Recordset->EOF) {
	$st_peserta_kelas_kelompok_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $st_peserta_kelas_kelompok_grid->StartRec > 1)
		$st_peserta_kelas_kelompok_grid->Recordset->Move($st_peserta_kelas_kelompok_grid->StartRec - 1);
} elseif (!$st_peserta_kelas_kelompok->AllowAddDeleteRow && $st_peserta_kelas_kelompok_grid->StopRec == 0) {
	$st_peserta_kelas_kelompok_grid->StopRec = $st_peserta_kelas_kelompok->GridAddRowCount;
}

// Initialize aggregate
$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_AGGREGATEINIT;
$st_peserta_kelas_kelompok->ResetAttrs();
$st_peserta_kelas_kelompok_grid->RenderRow();
$st_peserta_kelas_kelompok_grid->RowCnt = 0;
if ($st_peserta_kelas_kelompok->CurrentAction == "gridadd")
	$st_peserta_kelas_kelompok_grid->RowIndex = 0;
if ($st_peserta_kelas_kelompok->CurrentAction == "gridedit")
	$st_peserta_kelas_kelompok_grid->RowIndex = 0;
while ($st_peserta_kelas_kelompok_grid->RecCnt < $st_peserta_kelas_kelompok_grid->StopRec) {
	$st_peserta_kelas_kelompok_grid->RecCnt++;
	if (intval($st_peserta_kelas_kelompok_grid->RecCnt) >= intval($st_peserta_kelas_kelompok_grid->StartRec)) {
		$st_peserta_kelas_kelompok_grid->RowCnt++;
		if ($st_peserta_kelas_kelompok->CurrentAction == "gridadd" || $st_peserta_kelas_kelompok->CurrentAction == "gridedit" || $st_peserta_kelas_kelompok->CurrentAction == "F")
			$st_peserta_kelas_kelompok_grid->RowIndex++;

		// Set up key count
		$st_peserta_kelas_kelompok_grid->KeyCount = $st_peserta_kelas_kelompok_grid->RowIndex;

		// Init row class and style
		$st_peserta_kelas_kelompok->ResetAttrs();
		$st_peserta_kelas_kelompok->CssClass = "";
		if ($st_peserta_kelas_kelompok->CurrentAction == "gridadd") {
			if ($st_peserta_kelas_kelompok->CurrentMode == "copy") {
				$st_peserta_kelas_kelompok_grid->LoadRowValues($st_peserta_kelas_kelompok_grid->Recordset); // Load row values
				$st_peserta_kelas_kelompok_grid->SetRecordKey($st_peserta_kelas_kelompok_grid->RowOldKey, $st_peserta_kelas_kelompok_grid->Recordset); // Set old record key
			} else {
				$st_peserta_kelas_kelompok_grid->LoadDefaultValues(); // Load default values
				$st_peserta_kelas_kelompok_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($st_peserta_kelas_kelompok->CurrentAction == "gridedit") {
			$st_peserta_kelas_kelompok_grid->LoadRowValues($st_peserta_kelas_kelompok_grid->Recordset); // Load row values
		}
		$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($st_peserta_kelas_kelompok->CurrentAction == "gridadd") // Grid add
			$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_ADD; // Render add
		if ($st_peserta_kelas_kelompok->CurrentAction == "gridadd" && $st_peserta_kelas_kelompok->EventCancelled) // Insert failed
			$st_peserta_kelas_kelompok_grid->RestoreCurrentRowFormValues($st_peserta_kelas_kelompok_grid->RowIndex); // Restore form values
		if ($st_peserta_kelas_kelompok->CurrentAction == "gridedit") { // Grid edit
			if ($st_peserta_kelas_kelompok->EventCancelled) {
				$st_peserta_kelas_kelompok_grid->RestoreCurrentRowFormValues($st_peserta_kelas_kelompok_grid->RowIndex); // Restore form values
			}
			if ($st_peserta_kelas_kelompok_grid->RowAction == "insert")
				$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($st_peserta_kelas_kelompok->CurrentAction == "gridedit" && ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_EDIT || $st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_ADD) && $st_peserta_kelas_kelompok->EventCancelled) // Update failed
			$st_peserta_kelas_kelompok_grid->RestoreCurrentRowFormValues($st_peserta_kelas_kelompok_grid->RowIndex); // Restore form values
		if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_EDIT) // Edit row
			$st_peserta_kelas_kelompok_grid->EditRowCnt++;
		if ($st_peserta_kelas_kelompok->CurrentAction == "F") // Confirm row
			$st_peserta_kelas_kelompok_grid->RestoreCurrentRowFormValues($st_peserta_kelas_kelompok_grid->RowIndex); // Restore form values
		if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_ADD || $st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($st_peserta_kelas_kelompok->CurrentAction == "edit") {
				$st_peserta_kelas_kelompok->RowAttrs = array();
				$st_peserta_kelas_kelompok->CssClass = "ewTableEditRow";
			} else {
				$st_peserta_kelas_kelompok->RowAttrs = array();
			}
			if (!empty($st_peserta_kelas_kelompok_grid->RowIndex))
				$st_peserta_kelas_kelompok->RowAttrs = array_merge($st_peserta_kelas_kelompok->RowAttrs, array('data-rowindex'=>$st_peserta_kelas_kelompok_grid->RowIndex, 'id'=>'r' . $st_peserta_kelas_kelompok_grid->RowIndex . '_st_peserta_kelas_kelompok'));
		} else {
			$st_peserta_kelas_kelompok->RowAttrs = array();
		}

		// Render row
		$st_peserta_kelas_kelompok_grid->RenderRow();

		// Render list options
		$st_peserta_kelas_kelompok_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($st_peserta_kelas_kelompok_grid->RowAction <> "delete" && $st_peserta_kelas_kelompok_grid->RowAction <> "insertdelete" && !($st_peserta_kelas_kelompok_grid->RowAction == "insert" && $st_peserta_kelas_kelompok->CurrentAction == "F" && $st_peserta_kelas_kelompok_grid->EmptyRow())) {
?>
	<tr<?php echo $st_peserta_kelas_kelompok->RowAttributes() ?>>
<?php

// Render list options (body, left)
$st_peserta_kelas_kelompok_grid->ListOptions->Render("body", "left");
?>
	<?php if ($st_peserta_kelas_kelompok->identitas->Visible) { // identitas ?>
		<td<?php echo $st_peserta_kelas_kelompok->identitas->CellAttributes() ?>>
<?php if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" name="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas"<?php echo $st_peserta_kelas_kelompok->identitas->EditAttributes() ?>>
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
if (@$emptywrk) $st_peserta_kelas_kelompok->identitas->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" id="o<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->identitas->OldValue) ?>">
<?php } ?>
<?php if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" name="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas"<?php echo $st_peserta_kelas_kelompok->identitas->EditAttributes() ?>>
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
</option>
<?php
	}
}
if (@$emptywrk) $st_peserta_kelas_kelompok->identitas->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $st_peserta_kelas_kelompok->identitas->ViewAttributes() ?>><?php echo $st_peserta_kelas_kelompok->identitas->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" id="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->identitas->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" id="o<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->identitas->OldValue) ?>">
<?php } ?>
<a name="<?php echo $st_peserta_kelas_kelompok_grid->PageObjName . "_row_" . $st_peserta_kelas_kelompok_grid->RowCnt ?>" id="<?php echo $st_peserta_kelas_kelompok_grid->PageObjName . "_row_" . $st_peserta_kelas_kelompok_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($st_peserta_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $st_peserta_kelas_kelompok->kode_otomatis->CellAttributes() ?>>
<?php if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" id="o<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis->OldValue) ?>">
<?php } ?>
<?php if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="hidden" name="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis->CurrentValue) ?>">
<?php } ?>
<?php if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $st_peserta_kelas_kelompok->kode_otomatis->ViewAttributes() ?>><?php echo $st_peserta_kelas_kelompok->kode_otomatis->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" id="o<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$st_peserta_kelas_kelompok_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($st_peserta_kelas_kelompok->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($st_peserta_kelas_kelompok->CurrentAction <> "gridadd" || $st_peserta_kelas_kelompok->CurrentMode == "copy")
		if (!$st_peserta_kelas_kelompok_grid->Recordset->EOF) $st_peserta_kelas_kelompok_grid->Recordset->MoveNext();
}
?>
<?php
	if ($st_peserta_kelas_kelompok->CurrentMode == "add" || $st_peserta_kelas_kelompok->CurrentMode == "copy" || $st_peserta_kelas_kelompok->CurrentMode == "edit") {
		$st_peserta_kelas_kelompok_grid->RowIndex = '$rowindex$';
		$st_peserta_kelas_kelompok_grid->LoadDefaultValues();

		// Set row properties
		$st_peserta_kelas_kelompok->ResetAttrs();
		$st_peserta_kelas_kelompok->RowAttrs = array();
		if (!empty($st_peserta_kelas_kelompok_grid->RowIndex))
			$st_peserta_kelas_kelompok->RowAttrs = array_merge($st_peserta_kelas_kelompok->RowAttrs, array('data-rowindex'=>$st_peserta_kelas_kelompok_grid->RowIndex, 'id'=>'r' . $st_peserta_kelas_kelompok_grid->RowIndex . '_st_peserta_kelas_kelompok'));
		$st_peserta_kelas_kelompok->RowType = EW_ROWTYPE_ADD;

		// Render row
		$st_peserta_kelas_kelompok_grid->RenderRow();

		// Render list options
		$st_peserta_kelas_kelompok_grid->RenderListOptions();

		// Add id and class to the template row
		$st_peserta_kelas_kelompok->RowAttrs["id"] = "r0_st_peserta_kelas_kelompok";
		ew_AppendClass($st_peserta_kelas_kelompok->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $st_peserta_kelas_kelompok->RowAttributes() ?>>
<?php

// Render list options (body, left)
$st_peserta_kelas_kelompok_grid->ListOptions->Render("body", "left");
?>
	<?php if ($st_peserta_kelas_kelompok->identitas->Visible) { // identitas ?>
		<td>
<?php if ($st_peserta_kelas_kelompok->CurrentAction <> "F") { ?>
<select id="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" name="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas"<?php echo $st_peserta_kelas_kelompok->identitas->EditAttributes() ?>>
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
if (@$emptywrk) $st_peserta_kelas_kelompok->identitas->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $st_peserta_kelas_kelompok->identitas->ViewAttributes() ?>><?php echo $st_peserta_kelas_kelompok->identitas->ViewValue ?></div>
<input type="hidden" name="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" id="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_identitas" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->identitas->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($st_peserta_kelas_kelompok->kode_otomatis->Visible) { // kode_otomatis ?>
		<td>
<?php if ($st_peserta_kelas_kelompok->CurrentAction <> "F") { ?>
<input type="hidden" name="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis->CurrentValue) ?>">
<?php } else { ?>
<input type="hidden" name="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $st_peserta_kelas_kelompok_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta_kelas_kelompok->kode_otomatis->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$st_peserta_kelas_kelompok_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($st_peserta_kelas_kelompok->CurrentMode == "add" || $st_peserta_kelas_kelompok->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $st_peserta_kelas_kelompok_grid->KeyCount ?>">
<?php echo $st_peserta_kelas_kelompok_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($st_peserta_kelas_kelompok->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $st_peserta_kelas_kelompok_grid->KeyCount ?>">
<?php echo $st_peserta_kelas_kelompok_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="st_peserta_kelas_kelompok_grid">
</div>
<?php

// Close recordset
if ($st_peserta_kelas_kelompok_grid->Recordset)
	$st_peserta_kelas_kelompok_grid->Recordset->Close();
?>
</td></tr></table>
<?php if ($st_peserta_kelas_kelompok->Export == "" && $st_peserta_kelas_kelompok->CurrentAction == "") { ?>
<?php } ?>
<?php
$st_peserta_kelas_kelompok_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$st_peserta_kelas_kelompok_grid->Page_Terminate();
$Page =& $MasterPage;
?>

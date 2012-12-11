<?php include_once "penggunainfo.php" ?>
<?php

// Create page object
$st_peserta2_grid = new cst_peserta2_grid();
$MasterPage =& $Page;
$Page =& $st_peserta2_grid;

// Page init
$st_peserta2_grid->Page_Init();

// Page main
$st_peserta2_grid->Page_Main();
?>
<?php if ($st_peserta2->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var st_peserta2_grid = new ew_Page("st_peserta2_grid");

// page properties
st_peserta2_grid.PageID = "grid"; // page ID
st_peserta2_grid.FormID = "fst_peserta2grid"; // form ID
var EW_PAGE_ID = st_peserta2_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
st_peserta2_grid.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_peserta2->identitas->FldCaption()) ?>");

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
st_peserta2_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "identitas", false)) return false;
	if (ew_ValueChanged(fobj, infix, "A_nama_Lengkap", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
st_peserta2_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_peserta2_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_peserta2_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($st_peserta2->CurrentAction == "gridadd") {
	if ($st_peserta2->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$st_peserta2_grid->TotalRecs = $st_peserta2->SelectRecordCount();
			$st_peserta2_grid->Recordset = $st_peserta2_grid->LoadRecordset($st_peserta2_grid->StartRec-1, $st_peserta2_grid->DisplayRecs);
		} else {
			if ($st_peserta2_grid->Recordset = $st_peserta2_grid->LoadRecordset())
				$st_peserta2_grid->TotalRecs = $st_peserta2_grid->Recordset->RecordCount();
		}
		$st_peserta2_grid->StartRec = 1;
		$st_peserta2_grid->DisplayRecs = $st_peserta2_grid->TotalRecs;
	} else {
		$st_peserta2->CurrentFilter = "0=1";
		$st_peserta2_grid->StartRec = 1;
		$st_peserta2_grid->DisplayRecs = $st_peserta2->GridAddRowCount;
	}
	$st_peserta2_grid->TotalRecs = $st_peserta2_grid->DisplayRecs;
	$st_peserta2_grid->StopRec = $st_peserta2_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$st_peserta2_grid->TotalRecs = $st_peserta2->SelectRecordCount();
	} else {
		if ($st_peserta2_grid->Recordset = $st_peserta2_grid->LoadRecordset())
			$st_peserta2_grid->TotalRecs = $st_peserta2_grid->Recordset->RecordCount();
	}
	$st_peserta2_grid->StartRec = 1;
	$st_peserta2_grid->DisplayRecs = $st_peserta2_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$st_peserta2_grid->Recordset = $st_peserta2_grid->LoadRecordset($st_peserta2_grid->StartRec-1, $st_peserta2_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($st_peserta2->CurrentMode == "add" || $st_peserta2->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($st_peserta2->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $st_peserta2->TableCaption() ?></p>
</p>
<?php $st_peserta2_grid->ShowPageHeader(); ?>
<?php
$st_peserta2_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if (($st_peserta2->CurrentMode == "add" || $st_peserta2->CurrentMode == "copy" || $st_peserta2->CurrentMode == "edit") && $st_peserta2->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridUpperPanel">
<?php if ($st_peserta2->AllowAddDeleteRow) { ?>
<?php if ($Security->CanAdd()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><img src='phpimages/addblankrow.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("AddBlankRow")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("AddBlankRow")) ?>' width='16' height='16' border='0'></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
<div id="gmp_st_peserta2" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $st_peserta2->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$st_peserta2_grid->RenderListOptions();

// Render list options (header, left)
$st_peserta2_grid->ListOptions->Render("header", "left");
?>
<?php if ($st_peserta2->identitas->Visible) { // identitas ?>
	<?php if ($st_peserta2->SortUrl($st_peserta2->identitas) == "") { ?>
		<td><?php echo $st_peserta2->identitas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_peserta2->identitas->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_peserta2->identitas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_peserta2->identitas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($st_peserta2->A_nama_Lengkap->Visible) { // A_nama_Lengkap ?>
	<?php if ($st_peserta2->SortUrl($st_peserta2->A_nama_Lengkap) == "") { ?>
		<td><?php echo $st_peserta2->A_nama_Lengkap->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $st_peserta2->A_nama_Lengkap->FldCaption() ?></td><td style="width: 10px;"><?php if ($st_peserta2->A_nama_Lengkap->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($st_peserta2->A_nama_Lengkap->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$st_peserta2_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$st_peserta2_grid->StartRec = 1;
$st_peserta2_grid->StopRec = $st_peserta2_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($st_peserta2->CurrentAction == "gridadd" || $st_peserta2->CurrentAction == "gridedit" || $st_peserta2->CurrentAction == "F")) {
		$st_peserta2_grid->KeyCount = $objForm->GetValue("key_count");
		$st_peserta2_grid->StopRec = $st_peserta2_grid->KeyCount;
	}
}
$st_peserta2_grid->RecCnt = $st_peserta2_grid->StartRec - 1;
if ($st_peserta2_grid->Recordset && !$st_peserta2_grid->Recordset->EOF) {
	$st_peserta2_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $st_peserta2_grid->StartRec > 1)
		$st_peserta2_grid->Recordset->Move($st_peserta2_grid->StartRec - 1);
} elseif (!$st_peserta2->AllowAddDeleteRow && $st_peserta2_grid->StopRec == 0) {
	$st_peserta2_grid->StopRec = $st_peserta2->GridAddRowCount;
}

// Initialize aggregate
$st_peserta2->RowType = EW_ROWTYPE_AGGREGATEINIT;
$st_peserta2->ResetAttrs();
$st_peserta2_grid->RenderRow();
$st_peserta2_grid->RowCnt = 0;
if ($st_peserta2->CurrentAction == "gridadd")
	$st_peserta2_grid->RowIndex = 0;
if ($st_peserta2->CurrentAction == "gridedit")
	$st_peserta2_grid->RowIndex = 0;
while ($st_peserta2_grid->RecCnt < $st_peserta2_grid->StopRec) {
	$st_peserta2_grid->RecCnt++;
	if (intval($st_peserta2_grid->RecCnt) >= intval($st_peserta2_grid->StartRec)) {
		$st_peserta2_grid->RowCnt++;
		if ($st_peserta2->CurrentAction == "gridadd" || $st_peserta2->CurrentAction == "gridedit" || $st_peserta2->CurrentAction == "F")
			$st_peserta2_grid->RowIndex++;

		// Set up key count
		$st_peserta2_grid->KeyCount = $st_peserta2_grid->RowIndex;

		// Init row class and style
		$st_peserta2->ResetAttrs();
		$st_peserta2->CssClass = "";
		if ($st_peserta2->CurrentAction == "gridadd") {
			if ($st_peserta2->CurrentMode == "copy") {
				$st_peserta2_grid->LoadRowValues($st_peserta2_grid->Recordset); // Load row values
				$st_peserta2_grid->SetRecordKey($st_peserta2_grid->RowOldKey, $st_peserta2_grid->Recordset); // Set old record key
			} else {
				$st_peserta2_grid->LoadDefaultValues(); // Load default values
				$st_peserta2_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($st_peserta2->CurrentAction == "gridedit") {
			$st_peserta2_grid->LoadRowValues($st_peserta2_grid->Recordset); // Load row values
		}
		$st_peserta2->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($st_peserta2->CurrentAction == "gridadd") // Grid add
			$st_peserta2->RowType = EW_ROWTYPE_ADD; // Render add
		if ($st_peserta2->CurrentAction == "gridadd" && $st_peserta2->EventCancelled) // Insert failed
			$st_peserta2_grid->RestoreCurrentRowFormValues($st_peserta2_grid->RowIndex); // Restore form values
		if ($st_peserta2->CurrentAction == "gridedit") { // Grid edit
			if ($st_peserta2->EventCancelled) {
				$st_peserta2_grid->RestoreCurrentRowFormValues($st_peserta2_grid->RowIndex); // Restore form values
			}
			if ($st_peserta2_grid->RowAction == "insert")
				$st_peserta2->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$st_peserta2->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($st_peserta2->CurrentAction == "gridedit" && ($st_peserta2->RowType == EW_ROWTYPE_EDIT || $st_peserta2->RowType == EW_ROWTYPE_ADD) && $st_peserta2->EventCancelled) // Update failed
			$st_peserta2_grid->RestoreCurrentRowFormValues($st_peserta2_grid->RowIndex); // Restore form values
		if ($st_peserta2->RowType == EW_ROWTYPE_EDIT) // Edit row
			$st_peserta2_grid->EditRowCnt++;
		if ($st_peserta2->CurrentAction == "F") // Confirm row
			$st_peserta2_grid->RestoreCurrentRowFormValues($st_peserta2_grid->RowIndex); // Restore form values
		if ($st_peserta2->RowType == EW_ROWTYPE_ADD || $st_peserta2->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($st_peserta2->CurrentAction == "edit") {
				$st_peserta2->RowAttrs = array();
				$st_peserta2->CssClass = "ewTableEditRow";
			} else {
				$st_peserta2->RowAttrs = array();
			}
			if (!empty($st_peserta2_grid->RowIndex))
				$st_peserta2->RowAttrs = array_merge($st_peserta2->RowAttrs, array('data-rowindex'=>$st_peserta2_grid->RowIndex, 'id'=>'r' . $st_peserta2_grid->RowIndex . '_st_peserta2'));
		} else {
			$st_peserta2->RowAttrs = array();
		}

		// Render row
		$st_peserta2_grid->RenderRow();

		// Render list options
		$st_peserta2_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($st_peserta2_grid->RowAction <> "delete" && $st_peserta2_grid->RowAction <> "insertdelete" && !($st_peserta2_grid->RowAction == "insert" && $st_peserta2->CurrentAction == "F" && $st_peserta2_grid->EmptyRow())) {
?>
	<tr<?php echo $st_peserta2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$st_peserta2_grid->ListOptions->Render("body", "left");
?>
	<?php if ($st_peserta2->identitas->Visible) { // identitas ?>
		<td<?php echo $st_peserta2->identitas->CellAttributes() ?>>
<?php if ($st_peserta2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $st_peserta2_grid->RowIndex ?>_identitas" name="x<?php echo $st_peserta2_grid->RowIndex ?>_identitas"<?php echo $st_peserta2->identitas->EditAttributes() ?>>
<?php
if (is_array($st_peserta2->identitas->EditValue)) {
	$arwrk = $st_peserta2->identitas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_peserta2->identitas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $st_peserta2->identitas->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $st_peserta2_grid->RowIndex ?>_identitas" id="o<?php echo $st_peserta2_grid->RowIndex ?>_identitas" value="<?php echo ew_HtmlEncode($st_peserta2->identitas->OldValue) ?>">
<?php } ?>
<?php if ($st_peserta2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $st_peserta2_grid->RowIndex ?>_identitas" name="x<?php echo $st_peserta2_grid->RowIndex ?>_identitas"<?php echo $st_peserta2->identitas->EditAttributes() ?>>
<?php
if (is_array($st_peserta2->identitas->EditValue)) {
	$arwrk = $st_peserta2->identitas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_peserta2->identitas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $st_peserta2->identitas->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($st_peserta2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $st_peserta2->identitas->ViewAttributes() ?>><?php echo $st_peserta2->identitas->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $st_peserta2_grid->RowIndex ?>_identitas" id="x<?php echo $st_peserta2_grid->RowIndex ?>_identitas" value="<?php echo ew_HtmlEncode($st_peserta2->identitas->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_peserta2_grid->RowIndex ?>_identitas" id="o<?php echo $st_peserta2_grid->RowIndex ?>_identitas" value="<?php echo ew_HtmlEncode($st_peserta2->identitas->OldValue) ?>">
<?php } ?>
<a name="<?php echo $st_peserta2_grid->PageObjName . "_row_" . $st_peserta2_grid->RowCnt ?>" id="<?php echo $st_peserta2_grid->PageObjName . "_row_" . $st_peserta2_grid->RowCnt ?>"></a>
<?php if ($st_peserta2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="x<?php echo $st_peserta2_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $st_peserta2_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta2->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_peserta2_grid->RowIndex ?>_kode_otomatis" id="o<?php echo $st_peserta2_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta2->kode_otomatis->OldValue) ?>">
<?php } ?>
<?php if ($st_peserta2->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $st_peserta2_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $st_peserta2_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($st_peserta2->kode_otomatis->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($st_peserta2->A_nama_Lengkap->Visible) { // A_nama_Lengkap ?>
		<td<?php echo $st_peserta2->A_nama_Lengkap->CellAttributes() ?>>
<?php if ($st_peserta2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="x<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" id="x<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" value="<?php echo ew_HtmlEncode($st_peserta2->A_nama_Lengkap->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" id="o<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" value="<?php echo ew_HtmlEncode($st_peserta2->A_nama_Lengkap->OldValue) ?>">
<?php } ?>
<?php if ($st_peserta2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="hidden" name="x<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" id="x<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" value="<?php echo ew_HtmlEncode($st_peserta2->A_nama_Lengkap->CurrentValue) ?>">
<?php } ?>
<?php if ($st_peserta2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $st_peserta2->A_nama_Lengkap->ViewAttributes() ?>><?php echo $st_peserta2->A_nama_Lengkap->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" id="x<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" value="<?php echo ew_HtmlEncode($st_peserta2->A_nama_Lengkap->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" id="o<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" value="<?php echo ew_HtmlEncode($st_peserta2->A_nama_Lengkap->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$st_peserta2_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($st_peserta2->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($st_peserta2->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($st_peserta2->CurrentAction <> "gridadd" || $st_peserta2->CurrentMode == "copy")
		if (!$st_peserta2_grid->Recordset->EOF) $st_peserta2_grid->Recordset->MoveNext();
}
?>
<?php
	if ($st_peserta2->CurrentMode == "add" || $st_peserta2->CurrentMode == "copy" || $st_peserta2->CurrentMode == "edit") {
		$st_peserta2_grid->RowIndex = '$rowindex$';
		$st_peserta2_grid->LoadDefaultValues();

		// Set row properties
		$st_peserta2->ResetAttrs();
		$st_peserta2->RowAttrs = array();
		if (!empty($st_peserta2_grid->RowIndex))
			$st_peserta2->RowAttrs = array_merge($st_peserta2->RowAttrs, array('data-rowindex'=>$st_peserta2_grid->RowIndex, 'id'=>'r' . $st_peserta2_grid->RowIndex . '_st_peserta2'));
		$st_peserta2->RowType = EW_ROWTYPE_ADD;

		// Render row
		$st_peserta2_grid->RenderRow();

		// Render list options
		$st_peserta2_grid->RenderListOptions();

		// Add id and class to the template row
		$st_peserta2->RowAttrs["id"] = "r0_st_peserta2";
		ew_AppendClass($st_peserta2->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $st_peserta2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$st_peserta2_grid->ListOptions->Render("body", "left");
?>
	<?php if ($st_peserta2->identitas->Visible) { // identitas ?>
		<td>
<?php if ($st_peserta2->CurrentAction <> "F") { ?>
<select id="x<?php echo $st_peserta2_grid->RowIndex ?>_identitas" name="x<?php echo $st_peserta2_grid->RowIndex ?>_identitas"<?php echo $st_peserta2->identitas->EditAttributes() ?>>
<?php
if (is_array($st_peserta2->identitas->EditValue)) {
	$arwrk = $st_peserta2->identitas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_peserta2->identitas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $st_peserta2->identitas->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $st_peserta2->identitas->ViewAttributes() ?>><?php echo $st_peserta2->identitas->ViewValue ?></div>
<input type="hidden" name="x<?php echo $st_peserta2_grid->RowIndex ?>_identitas" id="x<?php echo $st_peserta2_grid->RowIndex ?>_identitas" value="<?php echo ew_HtmlEncode($st_peserta2->identitas->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($st_peserta2->A_nama_Lengkap->Visible) { // A_nama_Lengkap ?>
		<td>
<?php if ($st_peserta2->CurrentAction <> "F") { ?>
<input type="hidden" name="x<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" id="x<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" value="<?php echo ew_HtmlEncode($st_peserta2->A_nama_Lengkap->CurrentValue) ?>">
<?php } else { ?>
<input type="hidden" name="x<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" id="x<?php echo $st_peserta2_grid->RowIndex ?>_A_nama_Lengkap" value="<?php echo ew_HtmlEncode($st_peserta2->A_nama_Lengkap->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$st_peserta2_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($st_peserta2->CurrentMode == "add" || $st_peserta2->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $st_peserta2_grid->KeyCount ?>">
<?php echo $st_peserta2_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($st_peserta2->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $st_peserta2_grid->KeyCount ?>">
<?php echo $st_peserta2_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="st_peserta2_grid">
</div>
<?php

// Close recordset
if ($st_peserta2_grid->Recordset)
	$st_peserta2_grid->Recordset->Close();
?>
</td></tr></table>
<?php if ($st_peserta2->Export == "" && $st_peserta2->CurrentAction == "") { ?>
<?php } ?>
<?php
$st_peserta2_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$st_peserta2_grid->Page_Terminate();
$Page =& $MasterPage;
?>

<?php include_once "penggunainfo.php" ?>
<?php

// Create page object
$keu_cicilan_grid = new ckeu_cicilan_grid();
$MasterPage =& $Page;
$Page =& $keu_cicilan_grid;

// Page init
$keu_cicilan_grid->Page_Init();

// Page main
$keu_cicilan_grid->Page_Main();
?>
<?php if ($keu_cicilan->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var keu_cicilan_grid = new ew_Page("keu_cicilan_grid");

// page properties
keu_cicilan_grid.PageID = "grid"; // page ID
keu_cicilan_grid.FormID = "fkeu_cicilangrid"; // form ID
var EW_PAGE_ID = keu_cicilan_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
keu_cicilan_grid.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_cicilan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_cicilan->cicilan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_cicilan"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_cicilan->cicilan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_pembayaran"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_cicilan->tanggal_pembayaran->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_pembayaran"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_cicilan->tanggal_pembayaran->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_rek_kas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_cicilan->rek_kas->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_rek_pendapatan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_cicilan->rek_pendapatan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kode_otomatis_master"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_cicilan->kode_otomatis_master->FldCaption()) ?>");

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
keu_cicilan_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "cicilan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tanggal_pembayaran", false)) return false;
	if (ew_ValueChanged(fobj, infix, "rek_kas", false)) return false;
	if (ew_ValueChanged(fobj, infix, "rek_pendapatan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kode_otomatis", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kode_otomatis_tanggungan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kode_otomatis_master", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
keu_cicilan_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_cicilan_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_cicilan_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<?php } ?>
<?php
if ($keu_cicilan->CurrentAction == "gridadd") {
	if ($keu_cicilan->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$keu_cicilan_grid->TotalRecs = $keu_cicilan->SelectRecordCount();
			$keu_cicilan_grid->Recordset = $keu_cicilan_grid->LoadRecordset($keu_cicilan_grid->StartRec-1, $keu_cicilan_grid->DisplayRecs);
		} else {
			if ($keu_cicilan_grid->Recordset = $keu_cicilan_grid->LoadRecordset())
				$keu_cicilan_grid->TotalRecs = $keu_cicilan_grid->Recordset->RecordCount();
		}
		$keu_cicilan_grid->StartRec = 1;
		$keu_cicilan_grid->DisplayRecs = $keu_cicilan_grid->TotalRecs;
	} else {
		$keu_cicilan->CurrentFilter = "0=1";
		$keu_cicilan_grid->StartRec = 1;
		$keu_cicilan_grid->DisplayRecs = $keu_cicilan->GridAddRowCount;
	}
	$keu_cicilan_grid->TotalRecs = $keu_cicilan_grid->DisplayRecs;
	$keu_cicilan_grid->StopRec = $keu_cicilan_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$keu_cicilan_grid->TotalRecs = $keu_cicilan->SelectRecordCount();
	} else {
		if ($keu_cicilan_grid->Recordset = $keu_cicilan_grid->LoadRecordset())
			$keu_cicilan_grid->TotalRecs = $keu_cicilan_grid->Recordset->RecordCount();
	}
	$keu_cicilan_grid->StartRec = 1;
	$keu_cicilan_grid->DisplayRecs = $keu_cicilan_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$keu_cicilan_grid->Recordset = $keu_cicilan_grid->LoadRecordset($keu_cicilan_grid->StartRec-1, $keu_cicilan_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($keu_cicilan->CurrentMode == "add" || $keu_cicilan->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($keu_cicilan->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_cicilan->TableCaption() ?></p>
</p>
<?php $keu_cicilan_grid->ShowPageHeader(); ?>
<?php
$keu_cicilan_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if (($keu_cicilan->CurrentMode == "add" || $keu_cicilan->CurrentMode == "copy" || $keu_cicilan->CurrentMode == "edit") && $keu_cicilan->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridUpperPanel">
</div>
<?php } ?>
<div id="gmp_keu_cicilan" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $keu_cicilan->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$keu_cicilan_grid->RenderListOptions();

// Render list options (header, left)
$keu_cicilan_grid->ListOptions->Render("header", "left");
?>
<?php if ($keu_cicilan->cicilan->Visible) { // cicilan ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->cicilan) == "") { ?>
		<td><?php echo $keu_cicilan->cicilan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->cicilan->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->cicilan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->cicilan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->tanggal_pembayaran->Visible) { // tanggal_pembayaran ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->tanggal_pembayaran) == "") { ?>
		<td><?php echo $keu_cicilan->tanggal_pembayaran->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->tanggal_pembayaran->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->tanggal_pembayaran->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->tanggal_pembayaran->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->rek_kas->Visible) { // rek_kas ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->rek_kas) == "") { ?>
		<td><?php echo $keu_cicilan->rek_kas->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->rek_kas->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->rek_kas->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->rek_kas->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->rek_pendapatan->Visible) { // rek_pendapatan ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->rek_pendapatan) == "") { ?>
		<td><?php echo $keu_cicilan->rek_pendapatan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->rek_pendapatan->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->rek_pendapatan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->rek_pendapatan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->kode_otomatis) == "") { ?>
		<td><?php echo $keu_cicilan->kode_otomatis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->kode_otomatis->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->kode_otomatis->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->kode_otomatis->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->kode_otomatis_tanggungan->Visible) { // kode_otomatis_tanggungan ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->kode_otomatis_tanggungan) == "") { ?>
		<td><?php echo $keu_cicilan->kode_otomatis_tanggungan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->kode_otomatis_tanggungan->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->kode_otomatis_tanggungan->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->kode_otomatis_tanggungan->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($keu_cicilan->kode_otomatis_master->Visible) { // kode_otomatis_master ?>
	<?php if ($keu_cicilan->SortUrl($keu_cicilan->kode_otomatis_master) == "") { ?>
		<td><?php echo $keu_cicilan->kode_otomatis_master->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $keu_cicilan->kode_otomatis_master->FldCaption() ?></td><td style="width: 10px;"><?php if ($keu_cicilan->kode_otomatis_master->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($keu_cicilan->kode_otomatis_master->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$keu_cicilan_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$keu_cicilan_grid->StartRec = 1;
$keu_cicilan_grid->StopRec = $keu_cicilan_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($keu_cicilan->CurrentAction == "gridadd" || $keu_cicilan->CurrentAction == "gridedit" || $keu_cicilan->CurrentAction == "F")) {
		$keu_cicilan_grid->KeyCount = $objForm->GetValue("key_count");
		$keu_cicilan_grid->StopRec = $keu_cicilan_grid->KeyCount;
	}
}
$keu_cicilan_grid->RecCnt = $keu_cicilan_grid->StartRec - 1;
if ($keu_cicilan_grid->Recordset && !$keu_cicilan_grid->Recordset->EOF) {
	$keu_cicilan_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $keu_cicilan_grid->StartRec > 1)
		$keu_cicilan_grid->Recordset->Move($keu_cicilan_grid->StartRec - 1);
} elseif (!$keu_cicilan->AllowAddDeleteRow && $keu_cicilan_grid->StopRec == 0) {
	$keu_cicilan_grid->StopRec = $keu_cicilan->GridAddRowCount;
}

// Initialize aggregate
$keu_cicilan->RowType = EW_ROWTYPE_AGGREGATEINIT;
$keu_cicilan->ResetAttrs();
$keu_cicilan_grid->RenderRow();
$keu_cicilan_grid->RowCnt = 0;
if ($keu_cicilan->CurrentAction == "gridadd")
	$keu_cicilan_grid->RowIndex = 0;
if ($keu_cicilan->CurrentAction == "gridedit")
	$keu_cicilan_grid->RowIndex = 0;
while ($keu_cicilan_grid->RecCnt < $keu_cicilan_grid->StopRec) {
	$keu_cicilan_grid->RecCnt++;
	if (intval($keu_cicilan_grid->RecCnt) >= intval($keu_cicilan_grid->StartRec)) {
		$keu_cicilan_grid->RowCnt++;
		if ($keu_cicilan->CurrentAction == "gridadd" || $keu_cicilan->CurrentAction == "gridedit" || $keu_cicilan->CurrentAction == "F")
			$keu_cicilan_grid->RowIndex++;

		// Set up key count
		$keu_cicilan_grid->KeyCount = $keu_cicilan_grid->RowIndex;

		// Init row class and style
		$keu_cicilan->ResetAttrs();
		$keu_cicilan->CssClass = "";
		if ($keu_cicilan->CurrentAction == "gridadd") {
			if ($keu_cicilan->CurrentMode == "copy") {
				$keu_cicilan_grid->LoadRowValues($keu_cicilan_grid->Recordset); // Load row values
				$keu_cicilan_grid->SetRecordKey($keu_cicilan_grid->RowOldKey, $keu_cicilan_grid->Recordset); // Set old record key
			} else {
				$keu_cicilan_grid->LoadDefaultValues(); // Load default values
				$keu_cicilan_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($keu_cicilan->CurrentAction == "gridedit") {
			$keu_cicilan_grid->LoadRowValues($keu_cicilan_grid->Recordset); // Load row values
		}
		$keu_cicilan->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($keu_cicilan->CurrentAction == "gridadd") // Grid add
			$keu_cicilan->RowType = EW_ROWTYPE_ADD; // Render add
		if ($keu_cicilan->CurrentAction == "gridadd" && $keu_cicilan->EventCancelled) // Insert failed
			$keu_cicilan_grid->RestoreCurrentRowFormValues($keu_cicilan_grid->RowIndex); // Restore form values
		if ($keu_cicilan->CurrentAction == "gridedit") { // Grid edit
			if ($keu_cicilan->EventCancelled) {
				$keu_cicilan_grid->RestoreCurrentRowFormValues($keu_cicilan_grid->RowIndex); // Restore form values
			}
			if ($keu_cicilan_grid->RowAction == "insert")
				$keu_cicilan->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$keu_cicilan->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($keu_cicilan->CurrentAction == "gridedit" && ($keu_cicilan->RowType == EW_ROWTYPE_EDIT || $keu_cicilan->RowType == EW_ROWTYPE_ADD) && $keu_cicilan->EventCancelled) // Update failed
			$keu_cicilan_grid->RestoreCurrentRowFormValues($keu_cicilan_grid->RowIndex); // Restore form values
		if ($keu_cicilan->RowType == EW_ROWTYPE_EDIT) // Edit row
			$keu_cicilan_grid->EditRowCnt++;
		if ($keu_cicilan->CurrentAction == "F") // Confirm row
			$keu_cicilan_grid->RestoreCurrentRowFormValues($keu_cicilan_grid->RowIndex); // Restore form values
		if ($keu_cicilan->RowType == EW_ROWTYPE_ADD || $keu_cicilan->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($keu_cicilan->CurrentAction == "edit") {
				$keu_cicilan->RowAttrs = array();
				$keu_cicilan->CssClass = "ewTableEditRow";
			} else {
				$keu_cicilan->RowAttrs = array();
			}
			if (!empty($keu_cicilan_grid->RowIndex))
				$keu_cicilan->RowAttrs = array_merge($keu_cicilan->RowAttrs, array('data-rowindex'=>$keu_cicilan_grid->RowIndex, 'id'=>'r' . $keu_cicilan_grid->RowIndex . '_keu_cicilan'));
		} else {
			$keu_cicilan->RowAttrs = array();
		}

		// Render row
		$keu_cicilan_grid->RenderRow();

		// Render list options
		$keu_cicilan_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($keu_cicilan_grid->RowAction <> "delete" && $keu_cicilan_grid->RowAction <> "insertdelete" && !($keu_cicilan_grid->RowAction == "insert" && $keu_cicilan->CurrentAction == "F" && $keu_cicilan_grid->EmptyRow())) {
?>
	<tr<?php echo $keu_cicilan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$keu_cicilan_grid->ListOptions->Render("body", "left");
?>
	<?php if ($keu_cicilan->cicilan->Visible) { // cicilan ?>
		<td<?php echo $keu_cicilan->cicilan->CellAttributes() ?>>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" size="30" value="<?php echo $keu_cicilan->cicilan->EditValue ?>"<?php echo $keu_cicilan->cicilan->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" value="<?php echo ew_HtmlEncode($keu_cicilan->cicilan->OldValue) ?>">
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" size="30" value="<?php echo $keu_cicilan->cicilan->EditValue ?>"<?php echo $keu_cicilan->cicilan->EditAttributes() ?>>
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $keu_cicilan->cicilan->ViewAttributes() ?>><?php echo $keu_cicilan->cicilan->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" value="<?php echo ew_HtmlEncode($keu_cicilan->cicilan->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" value="<?php echo ew_HtmlEncode($keu_cicilan->cicilan->OldValue) ?>">
<?php } ?>
<a name="<?php echo $keu_cicilan_grid->PageObjName . "_row_" . $keu_cicilan_grid->RowCnt ?>" id="<?php echo $keu_cicilan_grid->PageObjName . "_row_" . $keu_cicilan_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($keu_cicilan->tanggal_pembayaran->Visible) { // tanggal_pembayaran ?>
		<td<?php echo $keu_cicilan->tanggal_pembayaran->CellAttributes() ?>>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" value="<?php echo $keu_cicilan->tanggal_pembayaran->EditValue ?>"<?php echo $keu_cicilan->tanggal_pembayaran->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" name="cal_x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" // button id
});
</script>
<input type="hidden" name="fo<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" id="fo<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($keu_cicilan->tanggal_pembayaran->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" value="<?php echo ew_HtmlEncode($keu_cicilan->tanggal_pembayaran->OldValue) ?>">
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" value="<?php echo $keu_cicilan->tanggal_pembayaran->EditValue ?>"<?php echo $keu_cicilan->tanggal_pembayaran->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" name="cal_x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" // button id
});
</script>
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $keu_cicilan->tanggal_pembayaran->ViewAttributes() ?>><?php echo $keu_cicilan->tanggal_pembayaran->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" value="<?php echo ew_HtmlEncode($keu_cicilan->tanggal_pembayaran->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" value="<?php echo ew_HtmlEncode($keu_cicilan->tanggal_pembayaran->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->rek_kas->Visible) { // rek_kas ?>
		<td<?php echo $keu_cicilan->rek_kas->CellAttributes() ?>>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas"<?php echo $keu_cicilan->rek_kas->EditAttributes() ?>>
<?php
if (is_array($keu_cicilan->rek_kas->EditValue)) {
	$arwrk = $keu_cicilan->rek_kas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_cicilan->rek_kas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$keu_cicilan->rek_kas) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $keu_cicilan->rek_kas->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" value="<?php echo ew_HtmlEncode($keu_cicilan->rek_kas->OldValue) ?>">
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas"<?php echo $keu_cicilan->rek_kas->EditAttributes() ?>>
<?php
if (is_array($keu_cicilan->rek_kas->EditValue)) {
	$arwrk = $keu_cicilan->rek_kas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_cicilan->rek_kas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $keu_cicilan->rek_kas->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $keu_cicilan->rek_kas->ViewAttributes() ?>><?php echo $keu_cicilan->rek_kas->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" value="<?php echo ew_HtmlEncode($keu_cicilan->rek_kas->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" value="<?php echo ew_HtmlEncode($keu_cicilan->rek_kas->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->rek_pendapatan->Visible) { // rek_pendapatan ?>
		<td<?php echo $keu_cicilan->rek_pendapatan->CellAttributes() ?>>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan"<?php echo $keu_cicilan->rek_pendapatan->EditAttributes() ?>>
<?php
if (is_array($keu_cicilan->rek_pendapatan->EditValue)) {
	$arwrk = $keu_cicilan->rek_pendapatan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_cicilan->rek_pendapatan->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$keu_cicilan->rek_pendapatan) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $keu_cicilan->rek_pendapatan->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" value="<?php echo ew_HtmlEncode($keu_cicilan->rek_pendapatan->OldValue) ?>">
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan"<?php echo $keu_cicilan->rek_pendapatan->EditAttributes() ?>>
<?php
if (is_array($keu_cicilan->rek_pendapatan->EditValue)) {
	$arwrk = $keu_cicilan->rek_pendapatan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_cicilan->rek_pendapatan->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $keu_cicilan->rek_pendapatan->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $keu_cicilan->rek_pendapatan->ViewAttributes() ?>><?php echo $keu_cicilan->rek_pendapatan->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" value="<?php echo ew_HtmlEncode($keu_cicilan->rek_pendapatan->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" value="<?php echo ew_HtmlEncode($keu_cicilan->rek_pendapatan->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis ?>
		<td<?php echo $keu_cicilan->kode_otomatis->CellAttributes() ?>>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis->OldValue) ?>">
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis->CurrentValue) ?>">
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $keu_cicilan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis_tanggungan->Visible) { // kode_otomatis_tanggungan ?>
		<td<?php echo $keu_cicilan->kode_otomatis_tanggungan->CellAttributes() ?>>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($keu_cicilan->kode_otomatis_tanggungan->getSessionValue() <> "") { ?>
<input type="hidden" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" size="30" maxlength="50" value="<?php echo $keu_cicilan->kode_otomatis_tanggungan->EditValue ?>"<?php echo $keu_cicilan->kode_otomatis_tanggungan->EditAttributes() ?>>
<?php } ?>
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->OldValue) ?>">
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($keu_cicilan->kode_otomatis_tanggungan->getSessionValue() <> "") { ?>
<input type="hidden" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->CurrentValue) ?>">
<?php } else { ?>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->CurrentValue) ?>">
<?php } ?>
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $keu_cicilan->kode_otomatis_tanggungan->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_tanggungan->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis_master->Visible) { // kode_otomatis_master ?>
		<td<?php echo $keu_cicilan->kode_otomatis_master->CellAttributes() ?>>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" size="30" maxlength="50" value="<?php echo $keu_cicilan->kode_otomatis_master->EditValue ?>"<?php echo $keu_cicilan->kode_otomatis_master->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_master->OldValue) ?>">
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" size="30" maxlength="50" value="<?php echo $keu_cicilan->kode_otomatis_master->EditValue ?>"<?php echo $keu_cicilan->kode_otomatis_master->EditAttributes() ?>>
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $keu_cicilan->kode_otomatis_master->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_master->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_master->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" id="o<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_master->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$keu_cicilan_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($keu_cicilan->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($keu_cicilan->CurrentAction <> "gridadd" || $keu_cicilan->CurrentMode == "copy")
		if (!$keu_cicilan_grid->Recordset->EOF) $keu_cicilan_grid->Recordset->MoveNext();
}
?>
<?php
	if ($keu_cicilan->CurrentMode == "add" || $keu_cicilan->CurrentMode == "copy" || $keu_cicilan->CurrentMode == "edit") {
		$keu_cicilan_grid->RowIndex = '$rowindex$';
		$keu_cicilan_grid->LoadDefaultValues();

		// Set row properties
		$keu_cicilan->ResetAttrs();
		$keu_cicilan->RowAttrs = array();
		if (!empty($keu_cicilan_grid->RowIndex))
			$keu_cicilan->RowAttrs = array_merge($keu_cicilan->RowAttrs, array('data-rowindex'=>$keu_cicilan_grid->RowIndex, 'id'=>'r' . $keu_cicilan_grid->RowIndex . '_keu_cicilan'));
		$keu_cicilan->RowType = EW_ROWTYPE_ADD;

		// Render row
		$keu_cicilan_grid->RenderRow();

		// Render list options
		$keu_cicilan_grid->RenderListOptions();

		// Add id and class to the template row
		$keu_cicilan->RowAttrs["id"] = "r0_keu_cicilan";
		ew_AppendClass($keu_cicilan->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $keu_cicilan->RowAttributes() ?>>
<?php

// Render list options (body, left)
$keu_cicilan_grid->ListOptions->Render("body", "left");
?>
	<?php if ($keu_cicilan->cicilan->Visible) { // cicilan ?>
		<td>
<?php if ($keu_cicilan->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" size="30" value="<?php echo $keu_cicilan->cicilan->EditValue ?>"<?php echo $keu_cicilan->cicilan->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $keu_cicilan->cicilan->ViewAttributes() ?>><?php echo $keu_cicilan->cicilan->ViewValue ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_cicilan" value="<?php echo ew_HtmlEncode($keu_cicilan->cicilan->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->tanggal_pembayaran->Visible) { // tanggal_pembayaran ?>
		<td>
<?php if ($keu_cicilan->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" value="<?php echo $keu_cicilan->tanggal_pembayaran->EditValue ?>"<?php echo $keu_cicilan->tanggal_pembayaran->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" name="cal_x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" // button id
});
</script>
<?php } else { ?>
<div<?php echo $keu_cicilan->tanggal_pembayaran->ViewAttributes() ?>><?php echo $keu_cicilan->tanggal_pembayaran->ViewValue ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_tanggal_pembayaran" value="<?php echo ew_HtmlEncode($keu_cicilan->tanggal_pembayaran->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->rek_kas->Visible) { // rek_kas ?>
		<td>
<?php if ($keu_cicilan->CurrentAction <> "F") { ?>
<select id="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas"<?php echo $keu_cicilan->rek_kas->EditAttributes() ?>>
<?php
if (is_array($keu_cicilan->rek_kas->EditValue)) {
	$arwrk = $keu_cicilan->rek_kas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_cicilan->rek_kas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$keu_cicilan->rek_kas) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $keu_cicilan->rek_kas->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $keu_cicilan->rek_kas->ViewAttributes() ?>><?php echo $keu_cicilan->rek_kas->ViewValue ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_kas" value="<?php echo ew_HtmlEncode($keu_cicilan->rek_kas->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->rek_pendapatan->Visible) { // rek_pendapatan ?>
		<td>
<?php if ($keu_cicilan->CurrentAction <> "F") { ?>
<select id="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan"<?php echo $keu_cicilan->rek_pendapatan->EditAttributes() ?>>
<?php
if (is_array($keu_cicilan->rek_pendapatan->EditValue)) {
	$arwrk = $keu_cicilan->rek_pendapatan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_cicilan->rek_pendapatan->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$keu_cicilan->rek_pendapatan) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $keu_cicilan->rek_pendapatan->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $keu_cicilan->rek_pendapatan->ViewAttributes() ?>><?php echo $keu_cicilan->rek_pendapatan->ViewValue ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_rek_pendapatan" value="<?php echo ew_HtmlEncode($keu_cicilan->rek_pendapatan->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis->Visible) { // kode_otomatis ?>
		<td>
<?php if ($keu_cicilan->CurrentAction <> "F") { ?>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis->CurrentValue) ?>">
<?php } else { ?>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis_tanggungan->Visible) { // kode_otomatis_tanggungan ?>
		<td>
<?php if ($keu_cicilan->CurrentAction <> "F") { ?>
<?php if ($keu_cicilan->kode_otomatis_tanggungan->getSessionValue() <> "") { ?>
<input type="hidden" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" size="30" maxlength="50" value="<?php echo $keu_cicilan->kode_otomatis_tanggungan->EditValue ?>"<?php echo $keu_cicilan->kode_otomatis_tanggungan->EditAttributes() ?>>
<?php } ?>
<?php } else { ?>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_tanggungan" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_tanggungan->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($keu_cicilan->kode_otomatis_master->Visible) { // kode_otomatis_master ?>
		<td>
<?php if ($keu_cicilan->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" size="30" maxlength="50" value="<?php echo $keu_cicilan->kode_otomatis_master->EditValue ?>"<?php echo $keu_cicilan->kode_otomatis_master->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $keu_cicilan->kode_otomatis_master->ViewAttributes() ?>><?php echo $keu_cicilan->kode_otomatis_master->ViewValue ?></div>
<input type="hidden" name="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" id="x<?php echo $keu_cicilan_grid->RowIndex ?>_kode_otomatis_master" value="<?php echo ew_HtmlEncode($keu_cicilan->kode_otomatis_master->FormValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$keu_cicilan_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($keu_cicilan->CurrentMode == "add" || $keu_cicilan->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $keu_cicilan_grid->KeyCount ?>">
<?php echo $keu_cicilan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($keu_cicilan->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $keu_cicilan_grid->KeyCount ?>">
<?php echo $keu_cicilan_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="keu_cicilan_grid">
</div>
<?php

// Close recordset
if ($keu_cicilan_grid->Recordset)
	$keu_cicilan_grid->Recordset->Close();
?>
</td></tr></table>
<?php if ($keu_cicilan->Export == "" && $keu_cicilan->CurrentAction == "") { ?>
<?php } ?>
<?php
$keu_cicilan_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$keu_cicilan_grid->Page_Terminate();
$Page =& $MasterPage;
?>

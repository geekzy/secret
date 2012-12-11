<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pemilihan_jenis_biayainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pemilihan_jenis_biaya_add = new cpemilihan_jenis_biaya_add();
$Page =& $pemilihan_jenis_biaya_add;

// Page init
$pemilihan_jenis_biaya_add->Page_Init();

// Page main
$pemilihan_jenis_biaya_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pemilihan_jenis_biaya_add = new ew_Page("pemilihan_jenis_biaya_add");

// page properties
pemilihan_jenis_biaya_add.PageID = "add"; // page ID
pemilihan_jenis_biaya_add.FormID = "fpemilihan_jenis_biayaadd"; // form ID
var EW_PAGE_ID = pemilihan_jenis_biaya_add.PageID; // for backward compatibility

// extend page with ValidateForm function
pemilihan_jenis_biaya_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_apakah_disembunyikan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->apakah_disembunyikan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kode_biaya"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->kode_biaya->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nama_kelas_kelompok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->nama_kelas_kelompok->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kode_kelompok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->kode_kelompok->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_bayar1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->tanggal_bayar1->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_bayar1"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_jenis_biaya->tanggal_bayar1->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_sosial"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->diskon_sosial->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_sosial"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_jenis_biaya->diskon_sosial->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_waktu"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->diskon_waktu->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_waktu"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_jenis_biaya->diskon_waktu->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_prestasi"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->diskon_prestasi->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_prestasi"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_jenis_biaya->diskon_prestasi->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_internal"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->diskon_internal->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_internal"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_jenis_biaya->diskon_internal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_lain"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->diskon_lain->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_lain"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_jenis_biaya->diskon_lain->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_langkah"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->langkah->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_langkah"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_jenis_biaya->langkah->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_jumlah"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_jenis_biaya->jumlah->FldCaption()) ?>");

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

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
pemilihan_jenis_biaya_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pemilihan_jenis_biaya_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pemilihan_jenis_biaya_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $pemilihan_jenis_biaya->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $pemilihan_jenis_biaya->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $pemilihan_jenis_biaya_add->ShowPageHeader(); ?>
<?php
$pemilihan_jenis_biaya_add->ShowMessage();
?>
<form name="fpemilihan_jenis_biayaadd" id="fpemilihan_jenis_biayaadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return pemilihan_jenis_biaya_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="pemilihan_jenis_biaya">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pemilihan_jenis_biaya->apakah_disembunyikan->Visible) { // apakah_disembunyikan ?>
	<tr id="r_apakah_disembunyikan"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->apakah_disembunyikan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->apakah_disembunyikan->CellAttributes() ?>><span id="el_apakah_disembunyikan">
<?php $pemilihan_jenis_biaya->apakah_disembunyikan->EditAttrs["onchange"] = "ew_UpdateOpt('x_kode_biaya','x_apakah_disembunyikan',true); " . @$pemilihan_jenis_biaya->apakah_disembunyikan->EditAttrs["onchange"]; ?>
<select id="x_apakah_disembunyikan" name="x_apakah_disembunyikan"<?php echo $pemilihan_jenis_biaya->apakah_disembunyikan->EditAttributes() ?>>
<?php
if (is_array($pemilihan_jenis_biaya->apakah_disembunyikan->EditValue)) {
	$arwrk = $pemilihan_jenis_biaya->apakah_disembunyikan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $pemilihan_jenis_biaya->apakah_disembunyikan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->kode_biaya->Visible) { // kode_biaya ?>
	<tr id="r_kode_biaya"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->kode_biaya->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->kode_biaya->CellAttributes() ?>><span id="el_kode_biaya">
<select id="x_kode_biaya" name="x_kode_biaya"<?php echo $pemilihan_jenis_biaya->kode_biaya->EditAttributes() ?>>
<?php
if (is_array($pemilihan_jenis_biaya->kode_biaya->EditValue)) {
	$arwrk = $pemilihan_jenis_biaya->kode_biaya->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pemilihan_jenis_biaya->kode_biaya->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `kode_otomatis`, `kode_otomatis` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `keu_master_tanggungan`";
$sWhereWrk = "`nama_biaya` IN ({filter_value})";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_kode_biaya" id="s_x_kode_biaya" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_kode_biaya" id="lft_x_kode_biaya" value="3">
</span><?php echo $pemilihan_jenis_biaya->kode_biaya->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->nama_kelas_kelompok->Visible) { // nama_kelas_kelompok ?>
	<tr id="r_nama_kelas_kelompok"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->nama_kelas_kelompok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->nama_kelas_kelompok->CellAttributes() ?>><span id="el_nama_kelas_kelompok">
<?php $pemilihan_jenis_biaya->nama_kelas_kelompok->EditAttrs["onchange"] = "ew_UpdateOpt('x_kode_kelompok','x_nama_kelas_kelompok',pemilihan_jenis_biaya_add.ar_x_kode_kelompok); " . @$pemilihan_jenis_biaya->nama_kelas_kelompok->EditAttrs["onchange"]; ?>
<select id="x_nama_kelas_kelompok" name="x_nama_kelas_kelompok"<?php echo $pemilihan_jenis_biaya->nama_kelas_kelompok->EditAttributes() ?>>
<?php
if (is_array($pemilihan_jenis_biaya->nama_kelas_kelompok->EditValue)) {
	$arwrk = $pemilihan_jenis_biaya->nama_kelas_kelompok->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $pemilihan_jenis_biaya->nama_kelas_kelompok->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->kode_kelompok->Visible) { // kode_kelompok ?>
	<tr id="r_kode_kelompok"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->kode_kelompok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->kode_kelompok->CellAttributes() ?>><span id="el_kode_kelompok">
<select id="x_kode_kelompok" name="x_kode_kelompok"<?php echo $pemilihan_jenis_biaya->kode_kelompok->EditAttributes() ?>>
<?php
if (is_array($pemilihan_jenis_biaya->kode_kelompok->EditValue)) {
	$arwrk = $pemilihan_jenis_biaya->kode_kelompok->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pemilihan_jenis_biaya->kode_kelompok->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php
$jswrk = "";
if (is_array($pemilihan_jenis_biaya->kode_kelompok->EditValue)) {
	$arwrk = $pemilihan_jenis_biaya->kode_kelompok->EditValue;
	$arwrkcnt = count($arwrk);
	for ($rowcntwrk = 1; $rowcntwrk < $arwrkcnt; $rowcntwrk++) {
		if ($jswrk <> "") $jswrk .= ",";
		$jswrk .= "['" . ew_JsEncode($arwrk[$rowcntwrk][0]) . "',"; // Value
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][1]) . "',"; // Display field 1
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][2]) . "',"; // Display field 2
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][3]) . "',"; // Display field 3
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][4]) . "',"; // Display field 4
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][5]) . "']"; // Filter field
	}
}
?>
<script type="text/javascript">
<!--
pemilihan_jenis_biaya_add.ar_x_kode_kelompok = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $pemilihan_jenis_biaya->kode_kelompok->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->tanggal_bayar1->Visible) { // tanggal_bayar1 ?>
	<tr id="r_tanggal_bayar1"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->tanggal_bayar1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->tanggal_bayar1->CellAttributes() ?>><span id="el_tanggal_bayar1">
<input type="text" name="x_tanggal_bayar1" id="x_tanggal_bayar1" size="30" maxlength="50" value="<?php echo $pemilihan_jenis_biaya->tanggal_bayar1->EditValue ?>"<?php echo $pemilihan_jenis_biaya->tanggal_bayar1->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_tanggal_bayar1" name="cal_x_tanggal_bayar1" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_tanggal_bayar1", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_tanggal_bayar1" // button id
});
</script>
</span><?php echo $pemilihan_jenis_biaya->tanggal_bayar1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->diskon_sosial->Visible) { // diskon_sosial ?>
	<tr id="r_diskon_sosial"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->diskon_sosial->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->diskon_sosial->CellAttributes() ?>><span id="el_diskon_sosial">
<input type="text" name="x_diskon_sosial" id="x_diskon_sosial" size="30" maxlength="50" value="<?php echo $pemilihan_jenis_biaya->diskon_sosial->EditValue ?>"<?php echo $pemilihan_jenis_biaya->diskon_sosial->EditAttributes() ?>>
</span><?php echo $pemilihan_jenis_biaya->diskon_sosial->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->diskon_waktu->Visible) { // diskon_waktu ?>
	<tr id="r_diskon_waktu"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->diskon_waktu->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->diskon_waktu->CellAttributes() ?>><span id="el_diskon_waktu">
<input type="text" name="x_diskon_waktu" id="x_diskon_waktu" size="30" maxlength="50" value="<?php echo $pemilihan_jenis_biaya->diskon_waktu->EditValue ?>"<?php echo $pemilihan_jenis_biaya->diskon_waktu->EditAttributes() ?>>
</span><?php echo $pemilihan_jenis_biaya->diskon_waktu->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->diskon_prestasi->Visible) { // diskon_prestasi ?>
	<tr id="r_diskon_prestasi"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->diskon_prestasi->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->diskon_prestasi->CellAttributes() ?>><span id="el_diskon_prestasi">
<input type="text" name="x_diskon_prestasi" id="x_diskon_prestasi" size="30" maxlength="50" value="<?php echo $pemilihan_jenis_biaya->diskon_prestasi->EditValue ?>"<?php echo $pemilihan_jenis_biaya->diskon_prestasi->EditAttributes() ?>>
</span><?php echo $pemilihan_jenis_biaya->diskon_prestasi->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->diskon_internal->Visible) { // diskon_internal ?>
	<tr id="r_diskon_internal"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->diskon_internal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->diskon_internal->CellAttributes() ?>><span id="el_diskon_internal">
<input type="text" name="x_diskon_internal" id="x_diskon_internal" size="30" maxlength="50" value="<?php echo $pemilihan_jenis_biaya->diskon_internal->EditValue ?>"<?php echo $pemilihan_jenis_biaya->diskon_internal->EditAttributes() ?>>
</span><?php echo $pemilihan_jenis_biaya->diskon_internal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->diskon_lain->Visible) { // diskon_lain ?>
	<tr id="r_diskon_lain"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->diskon_lain->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->diskon_lain->CellAttributes() ?>><span id="el_diskon_lain">
<input type="text" name="x_diskon_lain" id="x_diskon_lain" size="30" maxlength="50" value="<?php echo $pemilihan_jenis_biaya->diskon_lain->EditValue ?>"<?php echo $pemilihan_jenis_biaya->diskon_lain->EditAttributes() ?>>
</span><?php echo $pemilihan_jenis_biaya->diskon_lain->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->langkah->Visible) { // langkah ?>
	<tr id="r_langkah"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->langkah->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->langkah->CellAttributes() ?>><span id="el_langkah">
<input type="text" name="x_langkah" id="x_langkah" size="30" maxlength="50" value="<?php echo $pemilihan_jenis_biaya->langkah->EditValue ?>"<?php echo $pemilihan_jenis_biaya->langkah->EditAttributes() ?>>
</span><?php echo $pemilihan_jenis_biaya->langkah->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_jenis_biaya->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah"<?php echo $pemilihan_jenis_biaya->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_jenis_biaya->jumlah->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_jenis_biaya->jumlah->CellAttributes() ?>><span id="el_jumlah">
<input type="text" name="x_jumlah" id="x_jumlah" size="30" maxlength="50" value="<?php echo $pemilihan_jenis_biaya->jumlah->EditValue ?>"<?php echo $pemilihan_jenis_biaya->jumlah->EditAttributes() ?>>
</span><?php echo $pemilihan_jenis_biaya->jumlah->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_kode_biaya','x_apakah_disembunyikan',false],
['x_kode_kelompok','x_nama_kelas_kelompok',pemilihan_jenis_biaya_add.ar_x_kode_kelompok]]);

//-->
</script>
<?php
$pemilihan_jenis_biaya_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$pemilihan_jenis_biaya_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpemilihan_jenis_biaya_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'pemilihan_jenis_biaya';

	// Page object name
	var $PageObjName = 'pemilihan_jenis_biaya_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pemilihan_jenis_biaya;
		if ($pemilihan_jenis_biaya->UseTokenInUrl) $PageUrl .= "t=" . $pemilihan_jenis_biaya->TableVar . "&"; // Add page token
		return $PageUrl;
	}

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
		global $objForm, $pemilihan_jenis_biaya;
		if ($pemilihan_jenis_biaya->UseTokenInUrl) {
			if ($objForm)
				return ($pemilihan_jenis_biaya->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pemilihan_jenis_biaya->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpemilihan_jenis_biaya_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pemilihan_jenis_biaya)
		if (!isset($GLOBALS["pemilihan_jenis_biaya"])) {
			$GLOBALS["pemilihan_jenis_biaya"] = new cpemilihan_jenis_biaya();
			$GLOBALS["Table"] =& $GLOBALS["pemilihan_jenis_biaya"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pemilihan_jenis_biaya', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $pemilihan_jenis_biaya;

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("pemilihan_jenis_biayalist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $pemilihan_jenis_biaya;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$pemilihan_jenis_biaya->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$pemilihan_jenis_biaya->CurrentAction = "I"; // Form error, reset action
				$pemilihan_jenis_biaya->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["apakah_disembunyikan"] != "") {
				$pemilihan_jenis_biaya->apakah_disembunyikan->setQueryStringValue($_GET["apakah_disembunyikan"]);
				$pemilihan_jenis_biaya->setKey("apakah_disembunyikan", $pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue); // Set up key
			} else {
				$pemilihan_jenis_biaya->setKey("apakah_disembunyikan", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$pemilihan_jenis_biaya->CurrentAction = "C"; // Copy record
			} else {
				$pemilihan_jenis_biaya->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($pemilihan_jenis_biaya->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("pemilihan_jenis_biayalist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$pemilihan_jenis_biaya->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $pemilihan_jenis_biaya->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "pemilihan_jenis_biayaview.php")
						$sReturnUrl = $pemilihan_jenis_biaya->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$pemilihan_jenis_biaya->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$pemilihan_jenis_biaya->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$pemilihan_jenis_biaya->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $pemilihan_jenis_biaya;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $pemilihan_jenis_biaya;
		$pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue = NULL;
		$pemilihan_jenis_biaya->apakah_disembunyikan->OldValue = $pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue;
		$pemilihan_jenis_biaya->kode_biaya->CurrentValue = NULL;
		$pemilihan_jenis_biaya->kode_biaya->OldValue = $pemilihan_jenis_biaya->kode_biaya->CurrentValue;
		$pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue = NULL;
		$pemilihan_jenis_biaya->nama_kelas_kelompok->OldValue = $pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue;
		$pemilihan_jenis_biaya->kode_kelompok->CurrentValue = NULL;
		$pemilihan_jenis_biaya->kode_kelompok->OldValue = $pemilihan_jenis_biaya->kode_kelompok->CurrentValue;
		$pemilihan_jenis_biaya->tanggal_bayar1->CurrentValue = NULL;
		$pemilihan_jenis_biaya->tanggal_bayar1->OldValue = $pemilihan_jenis_biaya->tanggal_bayar1->CurrentValue;
		$pemilihan_jenis_biaya->diskon_sosial->CurrentValue = 0;
		$pemilihan_jenis_biaya->diskon_waktu->CurrentValue = 0;
		$pemilihan_jenis_biaya->diskon_prestasi->CurrentValue = 0;
		$pemilihan_jenis_biaya->diskon_internal->CurrentValue = 0;
		$pemilihan_jenis_biaya->diskon_lain->CurrentValue = 0;
		$pemilihan_jenis_biaya->langkah->CurrentValue = 1;
		$pemilihan_jenis_biaya->jumlah->CurrentValue = NULL;
		$pemilihan_jenis_biaya->jumlah->OldValue = $pemilihan_jenis_biaya->jumlah->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pemilihan_jenis_biaya;
		if (!$pemilihan_jenis_biaya->apakah_disembunyikan->FldIsDetailKey) {
			$pemilihan_jenis_biaya->apakah_disembunyikan->setFormValue($objForm->GetValue("x_apakah_disembunyikan"));
		}
		if (!$pemilihan_jenis_biaya->kode_biaya->FldIsDetailKey) {
			$pemilihan_jenis_biaya->kode_biaya->setFormValue($objForm->GetValue("x_kode_biaya"));
		}
		if (!$pemilihan_jenis_biaya->nama_kelas_kelompok->FldIsDetailKey) {
			$pemilihan_jenis_biaya->nama_kelas_kelompok->setFormValue($objForm->GetValue("x_nama_kelas_kelompok"));
		}
		if (!$pemilihan_jenis_biaya->kode_kelompok->FldIsDetailKey) {
			$pemilihan_jenis_biaya->kode_kelompok->setFormValue($objForm->GetValue("x_kode_kelompok"));
		}
		if (!$pemilihan_jenis_biaya->tanggal_bayar1->FldIsDetailKey) {
			$pemilihan_jenis_biaya->tanggal_bayar1->setFormValue($objForm->GetValue("x_tanggal_bayar1"));
		}
		if (!$pemilihan_jenis_biaya->diskon_sosial->FldIsDetailKey) {
			$pemilihan_jenis_biaya->diskon_sosial->setFormValue($objForm->GetValue("x_diskon_sosial"));
		}
		if (!$pemilihan_jenis_biaya->diskon_waktu->FldIsDetailKey) {
			$pemilihan_jenis_biaya->diskon_waktu->setFormValue($objForm->GetValue("x_diskon_waktu"));
		}
		if (!$pemilihan_jenis_biaya->diskon_prestasi->FldIsDetailKey) {
			$pemilihan_jenis_biaya->diskon_prestasi->setFormValue($objForm->GetValue("x_diskon_prestasi"));
		}
		if (!$pemilihan_jenis_biaya->diskon_internal->FldIsDetailKey) {
			$pemilihan_jenis_biaya->diskon_internal->setFormValue($objForm->GetValue("x_diskon_internal"));
		}
		if (!$pemilihan_jenis_biaya->diskon_lain->FldIsDetailKey) {
			$pemilihan_jenis_biaya->diskon_lain->setFormValue($objForm->GetValue("x_diskon_lain"));
		}
		if (!$pemilihan_jenis_biaya->langkah->FldIsDetailKey) {
			$pemilihan_jenis_biaya->langkah->setFormValue($objForm->GetValue("x_langkah"));
		}
		if (!$pemilihan_jenis_biaya->jumlah->FldIsDetailKey) {
			$pemilihan_jenis_biaya->jumlah->setFormValue($objForm->GetValue("x_jumlah"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pemilihan_jenis_biaya;
		$this->LoadOldRecord();
		$pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue = $pemilihan_jenis_biaya->apakah_disembunyikan->FormValue;
		$pemilihan_jenis_biaya->kode_biaya->CurrentValue = $pemilihan_jenis_biaya->kode_biaya->FormValue;
		$pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue = $pemilihan_jenis_biaya->nama_kelas_kelompok->FormValue;
		$pemilihan_jenis_biaya->kode_kelompok->CurrentValue = $pemilihan_jenis_biaya->kode_kelompok->FormValue;
		$pemilihan_jenis_biaya->tanggal_bayar1->CurrentValue = $pemilihan_jenis_biaya->tanggal_bayar1->FormValue;
		$pemilihan_jenis_biaya->diskon_sosial->CurrentValue = $pemilihan_jenis_biaya->diskon_sosial->FormValue;
		$pemilihan_jenis_biaya->diskon_waktu->CurrentValue = $pemilihan_jenis_biaya->diskon_waktu->FormValue;
		$pemilihan_jenis_biaya->diskon_prestasi->CurrentValue = $pemilihan_jenis_biaya->diskon_prestasi->FormValue;
		$pemilihan_jenis_biaya->diskon_internal->CurrentValue = $pemilihan_jenis_biaya->diskon_internal->FormValue;
		$pemilihan_jenis_biaya->diskon_lain->CurrentValue = $pemilihan_jenis_biaya->diskon_lain->FormValue;
		$pemilihan_jenis_biaya->langkah->CurrentValue = $pemilihan_jenis_biaya->langkah->FormValue;
		$pemilihan_jenis_biaya->jumlah->CurrentValue = $pemilihan_jenis_biaya->jumlah->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pemilihan_jenis_biaya;
		$sFilter = $pemilihan_jenis_biaya->KeyFilter();

		// Call Row Selecting event
		$pemilihan_jenis_biaya->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pemilihan_jenis_biaya->CurrentFilter = $sFilter;
		$sSql = $pemilihan_jenis_biaya->SQL();
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
		global $conn, $pemilihan_jenis_biaya;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pemilihan_jenis_biaya->Row_Selected($row);
		$pemilihan_jenis_biaya->apakah_disembunyikan->setDbValue($rs->fields('apakah_disembunyikan'));
		$pemilihan_jenis_biaya->kode_biaya->setDbValue($rs->fields('kode_biaya'));
		$pemilihan_jenis_biaya->nama_kelas_kelompok->setDbValue($rs->fields('nama_kelas_kelompok'));
		$pemilihan_jenis_biaya->kode_kelompok->setDbValue($rs->fields('kode_kelompok'));
		$pemilihan_jenis_biaya->tanggal_bayar1->setDbValue($rs->fields('tanggal_bayar1'));
		$pemilihan_jenis_biaya->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$pemilihan_jenis_biaya->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$pemilihan_jenis_biaya->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$pemilihan_jenis_biaya->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$pemilihan_jenis_biaya->diskon_lain->setDbValue($rs->fields('diskon_lain'));
		$pemilihan_jenis_biaya->langkah->setDbValue($rs->fields('langkah'));
		$pemilihan_jenis_biaya->jumlah->setDbValue($rs->fields('jumlah'));
	}

	// Load old record
	function LoadOldRecord() {
		global $pemilihan_jenis_biaya;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pemilihan_jenis_biaya->getKey("apakah_disembunyikan")) <> "")
			$pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue = $pemilihan_jenis_biaya->getKey("apakah_disembunyikan"); // apakah_disembunyikan
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pemilihan_jenis_biaya->CurrentFilter = $pemilihan_jenis_biaya->KeyFilter();
			$sSql = $pemilihan_jenis_biaya->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pemilihan_jenis_biaya;

		// Initialize URLs
		// Call Row_Rendering event

		$pemilihan_jenis_biaya->Row_Rendering();

		// Common render codes for all row types
		// apakah_disembunyikan
		// kode_biaya
		// nama_kelas_kelompok
		// kode_kelompok
		// tanggal_bayar1
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain
		// langkah
		// jumlah

		if ($pemilihan_jenis_biaya->RowType == EW_ROWTYPE_VIEW) { // View row

			// apakah_disembunyikan
			if (strval($pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue) <> "") {
				$sFilterWrk = "`nama_biaya` = '" . ew_AdjustSql($pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nama_biaya` FROM `keu_master_tanggungan`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_jenis_biaya->apakah_disembunyikan->ViewValue = $rswrk->fields('nama_biaya');
					$rswrk->Close();
				} else {
					$pemilihan_jenis_biaya->apakah_disembunyikan->ViewValue = $pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue;
				}
			} else {
				$pemilihan_jenis_biaya->apakah_disembunyikan->ViewValue = NULL;
			}
			$pemilihan_jenis_biaya->apakah_disembunyikan->ViewCustomAttributes = "";

			// kode_biaya
			if (strval($pemilihan_jenis_biaya->kode_biaya->CurrentValue) <> "") {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pemilihan_jenis_biaya->kode_biaya->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kode_otomatis` FROM `keu_master_tanggungan`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_jenis_biaya->kode_biaya->ViewValue = $rswrk->fields('kode_otomatis');
					$rswrk->Close();
				} else {
					$pemilihan_jenis_biaya->kode_biaya->ViewValue = $pemilihan_jenis_biaya->kode_biaya->CurrentValue;
				}
			} else {
				$pemilihan_jenis_biaya->kode_biaya->ViewValue = NULL;
			}
			$pemilihan_jenis_biaya->kode_biaya->ViewCustomAttributes = "";

			// nama_kelas_kelompok
			if (strval($pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue) <> "") {
				$sFilterWrk = "`nama_kelas_kelompok` = '" . ew_AdjustSql($pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nama_kelas_kelompok` FROM `st_master_kelas_kelompok`";
			$sWhereWrk = "";
			$lookuptblfilter = " kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND apakah_valid='y' ";
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
					$pemilihan_jenis_biaya->nama_kelas_kelompok->ViewValue = $rswrk->fields('nama_kelas_kelompok');
					$rswrk->Close();
				} else {
					$pemilihan_jenis_biaya->nama_kelas_kelompok->ViewValue = $pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue;
				}
			} else {
				$pemilihan_jenis_biaya->nama_kelas_kelompok->ViewValue = NULL;
			}
			$pemilihan_jenis_biaya->nama_kelas_kelompok->ViewCustomAttributes = "";

			// kode_kelompok
			if (strval($pemilihan_jenis_biaya->kode_kelompok->CurrentValue) <> "") {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pemilihan_jenis_biaya->kode_kelompok->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kode_otomatis` FROM `st_master_kelas_kelompok`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_jenis_biaya->kode_kelompok->ViewValue = $rswrk->fields('kode_otomatis');
					$rswrk->Close();
				} else {
					$pemilihan_jenis_biaya->kode_kelompok->ViewValue = $pemilihan_jenis_biaya->kode_kelompok->CurrentValue;
				}
			} else {
				$pemilihan_jenis_biaya->kode_kelompok->ViewValue = NULL;
			}
			$pemilihan_jenis_biaya->kode_kelompok->ViewCustomAttributes = "";

			// tanggal_bayar1
			$pemilihan_jenis_biaya->tanggal_bayar1->ViewValue = $pemilihan_jenis_biaya->tanggal_bayar1->CurrentValue;
			$pemilihan_jenis_biaya->tanggal_bayar1->ViewCustomAttributes = "";

			// diskon_sosial
			$pemilihan_jenis_biaya->diskon_sosial->ViewValue = $pemilihan_jenis_biaya->diskon_sosial->CurrentValue;
			$pemilihan_jenis_biaya->diskon_sosial->ViewCustomAttributes = "";

			// diskon_waktu
			$pemilihan_jenis_biaya->diskon_waktu->ViewValue = $pemilihan_jenis_biaya->diskon_waktu->CurrentValue;
			$pemilihan_jenis_biaya->diskon_waktu->ViewValue = ew_FormatDateTime($pemilihan_jenis_biaya->diskon_waktu->ViewValue, 7);
			$pemilihan_jenis_biaya->diskon_waktu->ViewCustomAttributes = "";

			// diskon_prestasi
			$pemilihan_jenis_biaya->diskon_prestasi->ViewValue = $pemilihan_jenis_biaya->diskon_prestasi->CurrentValue;
			$pemilihan_jenis_biaya->diskon_prestasi->ViewCustomAttributes = "";

			// diskon_internal
			$pemilihan_jenis_biaya->diskon_internal->ViewValue = $pemilihan_jenis_biaya->diskon_internal->CurrentValue;
			$pemilihan_jenis_biaya->diskon_internal->ViewCustomAttributes = "";

			// diskon_lain
			$pemilihan_jenis_biaya->diskon_lain->ViewValue = $pemilihan_jenis_biaya->diskon_lain->CurrentValue;
			$pemilihan_jenis_biaya->diskon_lain->ViewCustomAttributes = "";

			// langkah
			$pemilihan_jenis_biaya->langkah->ViewValue = $pemilihan_jenis_biaya->langkah->CurrentValue;
			$pemilihan_jenis_biaya->langkah->ViewCustomAttributes = "";

			// jumlah
			$pemilihan_jenis_biaya->jumlah->ViewValue = $pemilihan_jenis_biaya->jumlah->CurrentValue;
			$pemilihan_jenis_biaya->jumlah->ViewCustomAttributes = "";

			// apakah_disembunyikan
			$pemilihan_jenis_biaya->apakah_disembunyikan->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->apakah_disembunyikan->HrefValue = "";
			$pemilihan_jenis_biaya->apakah_disembunyikan->TooltipValue = "";

			// kode_biaya
			$pemilihan_jenis_biaya->kode_biaya->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->kode_biaya->HrefValue = "";
			$pemilihan_jenis_biaya->kode_biaya->TooltipValue = "";

			// nama_kelas_kelompok
			$pemilihan_jenis_biaya->nama_kelas_kelompok->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->nama_kelas_kelompok->HrefValue = "";
			$pemilihan_jenis_biaya->nama_kelas_kelompok->TooltipValue = "";

			// kode_kelompok
			$pemilihan_jenis_biaya->kode_kelompok->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->kode_kelompok->HrefValue = "";
			$pemilihan_jenis_biaya->kode_kelompok->TooltipValue = "";

			// tanggal_bayar1
			$pemilihan_jenis_biaya->tanggal_bayar1->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->tanggal_bayar1->HrefValue = "";
			$pemilihan_jenis_biaya->tanggal_bayar1->TooltipValue = "";

			// diskon_sosial
			$pemilihan_jenis_biaya->diskon_sosial->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_sosial->HrefValue = "";
			$pemilihan_jenis_biaya->diskon_sosial->TooltipValue = "";

			// diskon_waktu
			$pemilihan_jenis_biaya->diskon_waktu->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_waktu->HrefValue = "";
			$pemilihan_jenis_biaya->diskon_waktu->TooltipValue = "";

			// diskon_prestasi
			$pemilihan_jenis_biaya->diskon_prestasi->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_prestasi->HrefValue = "";
			$pemilihan_jenis_biaya->diskon_prestasi->TooltipValue = "";

			// diskon_internal
			$pemilihan_jenis_biaya->diskon_internal->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_internal->HrefValue = "";
			$pemilihan_jenis_biaya->diskon_internal->TooltipValue = "";

			// diskon_lain
			$pemilihan_jenis_biaya->diskon_lain->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_lain->HrefValue = "";
			$pemilihan_jenis_biaya->diskon_lain->TooltipValue = "";

			// langkah
			$pemilihan_jenis_biaya->langkah->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->langkah->HrefValue = "";
			$pemilihan_jenis_biaya->langkah->TooltipValue = "";

			// jumlah
			$pemilihan_jenis_biaya->jumlah->LinkCustomAttributes = "";
			$pemilihan_jenis_biaya->jumlah->HrefValue = "";
			$pemilihan_jenis_biaya->jumlah->TooltipValue = "";
		} elseif ($pemilihan_jenis_biaya->RowType == EW_ROWTYPE_ADD) { // Add row

			// apakah_disembunyikan
			$pemilihan_jenis_biaya->apakah_disembunyikan->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `nama_biaya`, `nama_biaya` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `keu_master_tanggungan`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$pemilihan_jenis_biaya->apakah_disembunyikan->EditValue = $arwrk;

			// kode_biaya
			$pemilihan_jenis_biaya->kode_biaya->EditCustomAttributes = "autoselect=true";
			if (trim(strval($pemilihan_jenis_biaya->kode_biaya->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`kode_otomatis` = '" . ew_AdjustSql($pemilihan_jenis_biaya->kode_biaya->CurrentValue) . "'";
			}
			$sSqlWrk = "SELECT `kode_otomatis`, `kode_otomatis` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `nama_biaya` AS `SelectFilterFld` FROM `keu_master_tanggungan`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$pemilihan_jenis_biaya->kode_biaya->EditValue = $arwrk;

			// nama_kelas_kelompok
			$pemilihan_jenis_biaya->nama_kelas_kelompok->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `nama_kelas_kelompok`, `nama_kelas_kelompok` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `st_master_kelas_kelompok`";
			$sWhereWrk = "";
			$lookuptblfilter = " kode_otomatis_tingkat='" . $_SESSION["kode_otomatis_tingkat"] . "' AND apakah_valid='y' ";
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
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$pemilihan_jenis_biaya->nama_kelas_kelompok->EditValue = $arwrk;

			// kode_kelompok
			$pemilihan_jenis_biaya->kode_kelompok->EditCustomAttributes = "autoselect=true";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kode_otomatis`, `kode_otomatis` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `nama_kelas_kelompok` AS `SelectFilterFld` FROM `st_master_kelas_kelompok`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$pemilihan_jenis_biaya->kode_kelompok->EditValue = $arwrk;

			// tanggal_bayar1
			$pemilihan_jenis_biaya->tanggal_bayar1->EditCustomAttributes = "";
			$pemilihan_jenis_biaya->tanggal_bayar1->EditValue = ew_HtmlEncode($pemilihan_jenis_biaya->tanggal_bayar1->CurrentValue);

			// diskon_sosial
			$pemilihan_jenis_biaya->diskon_sosial->EditCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_sosial->EditValue = ew_HtmlEncode($pemilihan_jenis_biaya->diskon_sosial->CurrentValue);

			// diskon_waktu
			$pemilihan_jenis_biaya->diskon_waktu->EditCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_waktu->EditValue = ew_HtmlEncode($pemilihan_jenis_biaya->diskon_waktu->CurrentValue);

			// diskon_prestasi
			$pemilihan_jenis_biaya->diskon_prestasi->EditCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_prestasi->EditValue = ew_HtmlEncode($pemilihan_jenis_biaya->diskon_prestasi->CurrentValue);

			// diskon_internal
			$pemilihan_jenis_biaya->diskon_internal->EditCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_internal->EditValue = ew_HtmlEncode($pemilihan_jenis_biaya->diskon_internal->CurrentValue);

			// diskon_lain
			$pemilihan_jenis_biaya->diskon_lain->EditCustomAttributes = "";
			$pemilihan_jenis_biaya->diskon_lain->EditValue = ew_HtmlEncode($pemilihan_jenis_biaya->diskon_lain->CurrentValue);

			// langkah
			$pemilihan_jenis_biaya->langkah->EditCustomAttributes = "";
			$pemilihan_jenis_biaya->langkah->EditValue = ew_HtmlEncode($pemilihan_jenis_biaya->langkah->CurrentValue);

			// jumlah
			$pemilihan_jenis_biaya->jumlah->EditCustomAttributes = "";
			$pemilihan_jenis_biaya->jumlah->EditValue = ew_HtmlEncode($pemilihan_jenis_biaya->jumlah->CurrentValue);

			// Edit refer script
			// apakah_disembunyikan

			$pemilihan_jenis_biaya->apakah_disembunyikan->HrefValue = "";

			// kode_biaya
			$pemilihan_jenis_biaya->kode_biaya->HrefValue = "";

			// nama_kelas_kelompok
			$pemilihan_jenis_biaya->nama_kelas_kelompok->HrefValue = "";

			// kode_kelompok
			$pemilihan_jenis_biaya->kode_kelompok->HrefValue = "";

			// tanggal_bayar1
			$pemilihan_jenis_biaya->tanggal_bayar1->HrefValue = "";

			// diskon_sosial
			$pemilihan_jenis_biaya->diskon_sosial->HrefValue = "";

			// diskon_waktu
			$pemilihan_jenis_biaya->diskon_waktu->HrefValue = "";

			// diskon_prestasi
			$pemilihan_jenis_biaya->diskon_prestasi->HrefValue = "";

			// diskon_internal
			$pemilihan_jenis_biaya->diskon_internal->HrefValue = "";

			// diskon_lain
			$pemilihan_jenis_biaya->diskon_lain->HrefValue = "";

			// langkah
			$pemilihan_jenis_biaya->langkah->HrefValue = "";

			// jumlah
			$pemilihan_jenis_biaya->jumlah->HrefValue = "";
		}
		if ($pemilihan_jenis_biaya->RowType == EW_ROWTYPE_ADD ||
			$pemilihan_jenis_biaya->RowType == EW_ROWTYPE_EDIT ||
			$pemilihan_jenis_biaya->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$pemilihan_jenis_biaya->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($pemilihan_jenis_biaya->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pemilihan_jenis_biaya->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $pemilihan_jenis_biaya;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($pemilihan_jenis_biaya->apakah_disembunyikan->FormValue) && $pemilihan_jenis_biaya->apakah_disembunyikan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->apakah_disembunyikan->FldCaption());
		}
		if (!is_null($pemilihan_jenis_biaya->kode_biaya->FormValue) && $pemilihan_jenis_biaya->kode_biaya->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->kode_biaya->FldCaption());
		}
		if (!is_null($pemilihan_jenis_biaya->nama_kelas_kelompok->FormValue) && $pemilihan_jenis_biaya->nama_kelas_kelompok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->nama_kelas_kelompok->FldCaption());
		}
		if (!is_null($pemilihan_jenis_biaya->kode_kelompok->FormValue) && $pemilihan_jenis_biaya->kode_kelompok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->kode_kelompok->FldCaption());
		}
		if (!is_null($pemilihan_jenis_biaya->tanggal_bayar1->FormValue) && $pemilihan_jenis_biaya->tanggal_bayar1->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->tanggal_bayar1->FldCaption());
		}
		if (!ew_CheckEuroDate($pemilihan_jenis_biaya->tanggal_bayar1->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_jenis_biaya->tanggal_bayar1->FldErrMsg());
		}
		if (!is_null($pemilihan_jenis_biaya->diskon_sosial->FormValue) && $pemilihan_jenis_biaya->diskon_sosial->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->diskon_sosial->FldCaption());
		}
		if (!ew_CheckInteger($pemilihan_jenis_biaya->diskon_sosial->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_jenis_biaya->diskon_sosial->FldErrMsg());
		}
		if (!is_null($pemilihan_jenis_biaya->diskon_waktu->FormValue) && $pemilihan_jenis_biaya->diskon_waktu->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->diskon_waktu->FldCaption());
		}
		if (!ew_CheckInteger($pemilihan_jenis_biaya->diskon_waktu->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_jenis_biaya->diskon_waktu->FldErrMsg());
		}
		if (!is_null($pemilihan_jenis_biaya->diskon_prestasi->FormValue) && $pemilihan_jenis_biaya->diskon_prestasi->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->diskon_prestasi->FldCaption());
		}
		if (!ew_CheckInteger($pemilihan_jenis_biaya->diskon_prestasi->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_jenis_biaya->diskon_prestasi->FldErrMsg());
		}
		if (!is_null($pemilihan_jenis_biaya->diskon_internal->FormValue) && $pemilihan_jenis_biaya->diskon_internal->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->diskon_internal->FldCaption());
		}
		if (!ew_CheckInteger($pemilihan_jenis_biaya->diskon_internal->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_jenis_biaya->diskon_internal->FldErrMsg());
		}
		if (!is_null($pemilihan_jenis_biaya->diskon_lain->FormValue) && $pemilihan_jenis_biaya->diskon_lain->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->diskon_lain->FldCaption());
		}
		if (!ew_CheckInteger($pemilihan_jenis_biaya->diskon_lain->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_jenis_biaya->diskon_lain->FldErrMsg());
		}
		if (!is_null($pemilihan_jenis_biaya->langkah->FormValue) && $pemilihan_jenis_biaya->langkah->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->langkah->FldCaption());
		}
		if (!ew_CheckInteger($pemilihan_jenis_biaya->langkah->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_jenis_biaya->langkah->FldErrMsg());
		}
		if (!is_null($pemilihan_jenis_biaya->jumlah->FormValue) && $pemilihan_jenis_biaya->jumlah->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_jenis_biaya->jumlah->FldCaption());
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
		global $conn, $Language, $Security, $pemilihan_jenis_biaya;

		// Check if key value entered
		if ($pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue == "" && $pemilihan_jenis_biaya->apakah_disembunyikan->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $pemilihan_jenis_biaya->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $pemilihan_jenis_biaya->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// apakah_disembunyikan
		$pemilihan_jenis_biaya->apakah_disembunyikan->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->apakah_disembunyikan->CurrentValue, "", FALSE);

		// kode_biaya
		$pemilihan_jenis_biaya->kode_biaya->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->kode_biaya->CurrentValue, "", FALSE);

		// nama_kelas_kelompok
		$pemilihan_jenis_biaya->nama_kelas_kelompok->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->nama_kelas_kelompok->CurrentValue, "", FALSE);

		// kode_kelompok
		$pemilihan_jenis_biaya->kode_kelompok->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->kode_kelompok->CurrentValue, "", FALSE);

		// tanggal_bayar1
		$pemilihan_jenis_biaya->tanggal_bayar1->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->tanggal_bayar1->CurrentValue, "", FALSE);

		// diskon_sosial
		$pemilihan_jenis_biaya->diskon_sosial->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->diskon_sosial->CurrentValue, "", FALSE);

		// diskon_waktu
		$pemilihan_jenis_biaya->diskon_waktu->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->diskon_waktu->CurrentValue, "", FALSE);

		// diskon_prestasi
		$pemilihan_jenis_biaya->diskon_prestasi->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->diskon_prestasi->CurrentValue, "", FALSE);

		// diskon_internal
		$pemilihan_jenis_biaya->diskon_internal->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->diskon_internal->CurrentValue, "", FALSE);

		// diskon_lain
		$pemilihan_jenis_biaya->diskon_lain->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->diskon_lain->CurrentValue, "", FALSE);

		// langkah
		$pemilihan_jenis_biaya->langkah->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->langkah->CurrentValue, "", FALSE);

		// jumlah
		$pemilihan_jenis_biaya->jumlah->SetDbValueDef($rsnew, $pemilihan_jenis_biaya->jumlah->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $pemilihan_jenis_biaya->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($pemilihan_jenis_biaya->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($pemilihan_jenis_biaya->CancelMessage <> "") {
				$this->setFailureMessage($pemilihan_jenis_biaya->CancelMessage);
				$pemilihan_jenis_biaya->CancelMessage = "";
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
			$pemilihan_jenis_biaya->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

		// Page Load event
	function Page_Load() {
		global $Language;
		$Language->setPhrase("GoBack","");   
		$Language->setPhrase("Add","");  
		$Language->setPhrase("AddBtn","Ketahap2-->Pemilihan Siswa");      
		$judul= "Silahkan Anda Pilih Jenis Biaya Dan Kelompok Yang Akan Diberi 
		   Tanggungan Biaya ..."  ;          
		$Language->setTablePhrase(CurrentTable()->TableName, "TblCaption", $judul); 
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
}
?>

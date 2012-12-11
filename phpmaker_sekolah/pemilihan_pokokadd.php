<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pemilihan_pokokinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pemilihan_pokok_add = new cpemilihan_pokok_add();
$Page =& $pemilihan_pokok_add;

// Page init
$pemilihan_pokok_add->Page_Init();

// Page main
$pemilihan_pokok_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pemilihan_pokok_add = new ew_Page("pemilihan_pokok_add");

// page properties
pemilihan_pokok_add.PageID = "add"; // page ID
pemilihan_pokok_add.FormID = "fpemilihan_pokokadd"; // form ID
var EW_PAGE_ID = pemilihan_pokok_add.PageID; // for backward compatibility

// extend page with ValidateForm function
pemilihan_pokok_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_kodePokok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->kodePokok->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nama_pokok"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->nama_pokok->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kodeSubSatu"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->kodeSubSatu->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nama_sub_satu"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->nama_sub_satu->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kodeSubDua"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->kodeSubDua->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nama_sub_dua"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->nama_sub_dua->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kodeSubTiga"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->kodeSubTiga->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nama_sub_tiga"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->nama_sub_tiga->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Norek"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->Norek->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Keterangan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->Keterangan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_D2FK"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pemilihan_pokok->D2FK->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_SaldoAwal"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_pokok->SaldoAwal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_TanggalSaldo"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_pokok->TanggalSaldo->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Saldo"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_pokok->Saldo->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_target"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pemilihan_pokok->target->FldErrMsg()) ?>");

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
pemilihan_pokok_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pemilihan_pokok_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pemilihan_pokok_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $pemilihan_pokok->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $pemilihan_pokok->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $pemilihan_pokok_add->ShowPageHeader(); ?>
<?php
$pemilihan_pokok_add->ShowMessage();
?>
<form name="fpemilihan_pokokadd" id="fpemilihan_pokokadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return pemilihan_pokok_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="pemilihan_pokok">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pemilihan_pokok->kodePokok->Visible) { // kodePokok ?>
	<tr id="r_kodePokok"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->kodePokok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->kodePokok->CellAttributes() ?>><span id="el_kodePokok">
<?php $pemilihan_pokok->kodePokok->EditAttrs["onchange"] = "ew_UpdateOpt('x_nama_pokok','x_kodePokok',pemilihan_pokok_add.ar_x_nama_pokok); " . @$pemilihan_pokok->kodePokok->EditAttrs["onchange"]; ?>
<select id="x_kodePokok" name="x_kodePokok"<?php echo $pemilihan_pokok->kodePokok->EditAttributes() ?>>
<?php
if (is_array($pemilihan_pokok->kodePokok->EditValue)) {
	$arwrk = $pemilihan_pokok->kodePokok->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pemilihan_pokok->kodePokok->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$pemilihan_pokok->kodePokok) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php if (AllowAdd("pokokrek")) { ?>
&nbsp;<a name="aol_x_kodePokok" id="aol_x_kodePokok" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:pemilihan_pokok_add,lnk:'aol_x_kodePokok',el:'x_kodePokok',hdr:this.innerHTML, url:'pokokrekaddopt.php',lf:'x_kodePokok',df:'x_kodePokok',df2:'x_namaPokok',df3:'',df4:'',pf:'',ff:''});"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $pemilihan_pokok->kodePokok->FldCaption() ?></a>
<?php } ?>
</span><?php echo $pemilihan_pokok->kodePokok->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->nama_pokok->Visible) { // nama_pokok ?>
	<tr id="r_nama_pokok"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->nama_pokok->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->nama_pokok->CellAttributes() ?>><span id="el_nama_pokok">
<select id="x_nama_pokok" name="x_nama_pokok"<?php echo $pemilihan_pokok->nama_pokok->EditAttributes() ?>>
<?php
if (is_array($pemilihan_pokok->nama_pokok->EditValue)) {
	$arwrk = $pemilihan_pokok->nama_pokok->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pemilihan_pokok->nama_pokok->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if (is_array($pemilihan_pokok->nama_pokok->EditValue)) {
	$arwrk = $pemilihan_pokok->nama_pokok->EditValue;
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
pemilihan_pokok_add.ar_x_nama_pokok = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $pemilihan_pokok->nama_pokok->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->kodeSubSatu->Visible) { // kodeSubSatu ?>
	<tr id="r_kodeSubSatu"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->kodeSubSatu->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->kodeSubSatu->CellAttributes() ?>><span id="el_kodeSubSatu">
<select id="x_kodeSubSatu" name="x_kodeSubSatu"<?php echo $pemilihan_pokok->kodeSubSatu->EditAttributes() ?>>
<?php
if (is_array($pemilihan_pokok->kodeSubSatu->EditValue)) {
	$arwrk = $pemilihan_pokok->kodeSubSatu->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($pemilihan_pokok->kodeSubSatu->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$pemilihan_pokok->kodeSubSatu) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php if (AllowAdd("subsaturek")) { ?>
&nbsp;<a name="aol_x_kodeSubSatu" id="aol_x_kodeSubSatu" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:pemilihan_pokok_add,lnk:'aol_x_kodeSubSatu',el:'x_kodeSubSatu',hdr:this.innerHTML, url:'subsaturekaddopt.php',lf:'x_kodeSubSatu',df:'x_kodeSubSatu',df2:'x_namaSubSatu',df3:'',df4:'',pf:'',ff:''});"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $pemilihan_pokok->kodeSubSatu->FldCaption() ?></a>
<?php } ?>
</span><?php echo $pemilihan_pokok->kodeSubSatu->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->nama_sub_satu->Visible) { // nama_sub_satu ?>
	<tr id="r_nama_sub_satu"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->nama_sub_satu->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->nama_sub_satu->CellAttributes() ?>><span id="el_nama_sub_satu">
<input type="text" name="x_nama_sub_satu" id="x_nama_sub_satu" size="30" maxlength="50" value="<?php echo $pemilihan_pokok->nama_sub_satu->EditValue ?>"<?php echo $pemilihan_pokok->nama_sub_satu->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->nama_sub_satu->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->kodeSubDua->Visible) { // kodeSubDua ?>
	<tr id="r_kodeSubDua"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->kodeSubDua->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->kodeSubDua->CellAttributes() ?>><span id="el_kodeSubDua">
<input type="text" name="x_kodeSubDua" id="x_kodeSubDua" size="30" maxlength="50" value="<?php echo $pemilihan_pokok->kodeSubDua->EditValue ?>"<?php echo $pemilihan_pokok->kodeSubDua->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->kodeSubDua->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->nama_sub_dua->Visible) { // nama_sub_dua ?>
	<tr id="r_nama_sub_dua"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->nama_sub_dua->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->nama_sub_dua->CellAttributes() ?>><span id="el_nama_sub_dua">
<input type="text" name="x_nama_sub_dua" id="x_nama_sub_dua" size="30" maxlength="50" value="<?php echo $pemilihan_pokok->nama_sub_dua->EditValue ?>"<?php echo $pemilihan_pokok->nama_sub_dua->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->nama_sub_dua->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->kodeSubTiga->Visible) { // kodeSubTiga ?>
	<tr id="r_kodeSubTiga"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->kodeSubTiga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->kodeSubTiga->CellAttributes() ?>><span id="el_kodeSubTiga">
<input type="text" name="x_kodeSubTiga" id="x_kodeSubTiga" size="30" maxlength="50" value="<?php echo $pemilihan_pokok->kodeSubTiga->EditValue ?>"<?php echo $pemilihan_pokok->kodeSubTiga->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->kodeSubTiga->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->nama_sub_tiga->Visible) { // nama_sub_tiga ?>
	<tr id="r_nama_sub_tiga"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->nama_sub_tiga->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->nama_sub_tiga->CellAttributes() ?>><span id="el_nama_sub_tiga">
<input type="text" name="x_nama_sub_tiga" id="x_nama_sub_tiga" size="30" maxlength="50" value="<?php echo $pemilihan_pokok->nama_sub_tiga->EditValue ?>"<?php echo $pemilihan_pokok->nama_sub_tiga->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->nama_sub_tiga->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->Norek->Visible) { // Norek ?>
	<tr id="r_Norek"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->Norek->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->Norek->CellAttributes() ?>><span id="el_Norek">
<input type="text" name="x_Norek" id="x_Norek" size="30" maxlength="50" value="<?php echo $pemilihan_pokok->Norek->EditValue ?>"<?php echo $pemilihan_pokok->Norek->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->Norek->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->Keterangan->Visible) { // Keterangan ?>
	<tr id="r_Keterangan"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->Keterangan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->Keterangan->CellAttributes() ?>><span id="el_Keterangan">
<input type="text" name="x_Keterangan" id="x_Keterangan" size="30" maxlength="50" value="<?php echo $pemilihan_pokok->Keterangan->EditValue ?>"<?php echo $pemilihan_pokok->Keterangan->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->Keterangan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->D2FK->Visible) { // D/K ?>
	<tr id="r_D2FK"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->D2FK->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pemilihan_pokok->D2FK->CellAttributes() ?>><span id="el_D2FK">
<input type="text" name="x_D2FK" id="x_D2FK" size="30" maxlength="2" value="<?php echo $pemilihan_pokok->D2FK->EditValue ?>"<?php echo $pemilihan_pokok->D2FK->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->D2FK->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->SaldoAwal->Visible) { // SaldoAwal ?>
	<tr id="r_SaldoAwal"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->SaldoAwal->FldCaption() ?></td>
		<td<?php echo $pemilihan_pokok->SaldoAwal->CellAttributes() ?>><span id="el_SaldoAwal">
<input type="text" name="x_SaldoAwal" id="x_SaldoAwal" size="30" value="<?php echo $pemilihan_pokok->SaldoAwal->EditValue ?>"<?php echo $pemilihan_pokok->SaldoAwal->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->SaldoAwal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->TanggalSaldo->Visible) { // TanggalSaldo ?>
	<tr id="r_TanggalSaldo"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->TanggalSaldo->FldCaption() ?></td>
		<td<?php echo $pemilihan_pokok->TanggalSaldo->CellAttributes() ?>><span id="el_TanggalSaldo">
<input type="text" name="x_TanggalSaldo" id="x_TanggalSaldo" value="<?php echo $pemilihan_pokok->TanggalSaldo->EditValue ?>"<?php echo $pemilihan_pokok->TanggalSaldo->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->TanggalSaldo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->Saldo->Visible) { // Saldo ?>
	<tr id="r_Saldo"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->Saldo->FldCaption() ?></td>
		<td<?php echo $pemilihan_pokok->Saldo->CellAttributes() ?>><span id="el_Saldo">
<input type="text" name="x_Saldo" id="x_Saldo" size="30" value="<?php echo $pemilihan_pokok->Saldo->EditValue ?>"<?php echo $pemilihan_pokok->Saldo->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->Saldo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pemilihan_pokok->target->Visible) { // target ?>
	<tr id="r_target"<?php echo $pemilihan_pokok->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pemilihan_pokok->target->FldCaption() ?></td>
		<td<?php echo $pemilihan_pokok->target->CellAttributes() ?>><span id="el_target">
<input type="text" name="x_target" id="x_target" size="30" value="<?php echo $pemilihan_pokok->target->EditValue ?>"<?php echo $pemilihan_pokok->target->EditAttributes() ?>>
</span><?php echo $pemilihan_pokok->target->CustomMsg ?></td>
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
ew_UpdateOpts([['x_nama_pokok','x_kodePokok',pemilihan_pokok_add.ar_x_nama_pokok]]);

//-->
</script>
<?php
$pemilihan_pokok_add->ShowPageFooter();
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
$pemilihan_pokok_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpemilihan_pokok_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'pemilihan_pokok';

	// Page object name
	var $PageObjName = 'pemilihan_pokok_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pemilihan_pokok;
		if ($pemilihan_pokok->UseTokenInUrl) $PageUrl .= "t=" . $pemilihan_pokok->TableVar . "&"; // Add page token
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
		global $objForm, $pemilihan_pokok;
		if ($pemilihan_pokok->UseTokenInUrl) {
			if ($objForm)
				return ($pemilihan_pokok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pemilihan_pokok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpemilihan_pokok_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pemilihan_pokok)
		if (!isset($GLOBALS["pemilihan_pokok"])) {
			$GLOBALS["pemilihan_pokok"] = new cpemilihan_pokok();
			$GLOBALS["Table"] =& $GLOBALS["pemilihan_pokok"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pemilihan_pokok', TRUE);

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
		global $pemilihan_pokok;

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
			$this->Page_Terminate("pemilihan_pokoklist.php");
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
		global $objForm, $Language, $gsFormError, $pemilihan_pokok;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$pemilihan_pokok->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$pemilihan_pokok->CurrentAction = "I"; // Form error, reset action
				$pemilihan_pokok->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$pemilihan_pokok->id->setQueryStringValue($_GET["id"]);
				$pemilihan_pokok->setKey("id", $pemilihan_pokok->id->CurrentValue); // Set up key
			} else {
				$pemilihan_pokok->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$pemilihan_pokok->CurrentAction = "C"; // Copy record
			} else {
				$pemilihan_pokok->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($pemilihan_pokok->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("pemilihan_pokoklist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$pemilihan_pokok->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $pemilihan_pokok->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "pemilihan_pokokview.php")
						$sReturnUrl = $pemilihan_pokok->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$pemilihan_pokok->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$pemilihan_pokok->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$pemilihan_pokok->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $pemilihan_pokok;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $pemilihan_pokok;
		$pemilihan_pokok->kodePokok->CurrentValue = NULL;
		$pemilihan_pokok->kodePokok->OldValue = $pemilihan_pokok->kodePokok->CurrentValue;
		$pemilihan_pokok->nama_pokok->CurrentValue = NULL;
		$pemilihan_pokok->nama_pokok->OldValue = $pemilihan_pokok->nama_pokok->CurrentValue;
		$pemilihan_pokok->kodeSubSatu->CurrentValue = NULL;
		$pemilihan_pokok->kodeSubSatu->OldValue = $pemilihan_pokok->kodeSubSatu->CurrentValue;
		$pemilihan_pokok->nama_sub_satu->CurrentValue = NULL;
		$pemilihan_pokok->nama_sub_satu->OldValue = $pemilihan_pokok->nama_sub_satu->CurrentValue;
		$pemilihan_pokok->kodeSubDua->CurrentValue = NULL;
		$pemilihan_pokok->kodeSubDua->OldValue = $pemilihan_pokok->kodeSubDua->CurrentValue;
		$pemilihan_pokok->nama_sub_dua->CurrentValue = NULL;
		$pemilihan_pokok->nama_sub_dua->OldValue = $pemilihan_pokok->nama_sub_dua->CurrentValue;
		$pemilihan_pokok->kodeSubTiga->CurrentValue = NULL;
		$pemilihan_pokok->kodeSubTiga->OldValue = $pemilihan_pokok->kodeSubTiga->CurrentValue;
		$pemilihan_pokok->nama_sub_tiga->CurrentValue = NULL;
		$pemilihan_pokok->nama_sub_tiga->OldValue = $pemilihan_pokok->nama_sub_tiga->CurrentValue;
		$pemilihan_pokok->Norek->CurrentValue = NULL;
		$pemilihan_pokok->Norek->OldValue = $pemilihan_pokok->Norek->CurrentValue;
		$pemilihan_pokok->Keterangan->CurrentValue = NULL;
		$pemilihan_pokok->Keterangan->OldValue = $pemilihan_pokok->Keterangan->CurrentValue;
		$pemilihan_pokok->D2FK->CurrentValue = NULL;
		$pemilihan_pokok->D2FK->OldValue = $pemilihan_pokok->D2FK->CurrentValue;
		$pemilihan_pokok->SaldoAwal->CurrentValue = 0;
		$pemilihan_pokok->TanggalSaldo->CurrentValue = "1970-01-01 00:00:00";
		$pemilihan_pokok->Saldo->CurrentValue = 0;
		$pemilihan_pokok->target->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pemilihan_pokok;
		if (!$pemilihan_pokok->kodePokok->FldIsDetailKey) {
			$pemilihan_pokok->kodePokok->setFormValue($objForm->GetValue("x_kodePokok"));
		}
		if (!$pemilihan_pokok->nama_pokok->FldIsDetailKey) {
			$pemilihan_pokok->nama_pokok->setFormValue($objForm->GetValue("x_nama_pokok"));
		}
		if (!$pemilihan_pokok->kodeSubSatu->FldIsDetailKey) {
			$pemilihan_pokok->kodeSubSatu->setFormValue($objForm->GetValue("x_kodeSubSatu"));
		}
		if (!$pemilihan_pokok->nama_sub_satu->FldIsDetailKey) {
			$pemilihan_pokok->nama_sub_satu->setFormValue($objForm->GetValue("x_nama_sub_satu"));
		}
		if (!$pemilihan_pokok->kodeSubDua->FldIsDetailKey) {
			$pemilihan_pokok->kodeSubDua->setFormValue($objForm->GetValue("x_kodeSubDua"));
		}
		if (!$pemilihan_pokok->nama_sub_dua->FldIsDetailKey) {
			$pemilihan_pokok->nama_sub_dua->setFormValue($objForm->GetValue("x_nama_sub_dua"));
		}
		if (!$pemilihan_pokok->kodeSubTiga->FldIsDetailKey) {
			$pemilihan_pokok->kodeSubTiga->setFormValue($objForm->GetValue("x_kodeSubTiga"));
		}
		if (!$pemilihan_pokok->nama_sub_tiga->FldIsDetailKey) {
			$pemilihan_pokok->nama_sub_tiga->setFormValue($objForm->GetValue("x_nama_sub_tiga"));
		}
		if (!$pemilihan_pokok->Norek->FldIsDetailKey) {
			$pemilihan_pokok->Norek->setFormValue($objForm->GetValue("x_Norek"));
		}
		if (!$pemilihan_pokok->Keterangan->FldIsDetailKey) {
			$pemilihan_pokok->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		if (!$pemilihan_pokok->D2FK->FldIsDetailKey) {
			$pemilihan_pokok->D2FK->setFormValue($objForm->GetValue("x_D2FK"));
		}
		if (!$pemilihan_pokok->SaldoAwal->FldIsDetailKey) {
			$pemilihan_pokok->SaldoAwal->setFormValue($objForm->GetValue("x_SaldoAwal"));
		}
		if (!$pemilihan_pokok->TanggalSaldo->FldIsDetailKey) {
			$pemilihan_pokok->TanggalSaldo->setFormValue($objForm->GetValue("x_TanggalSaldo"));
			$pemilihan_pokok->TanggalSaldo->CurrentValue = ew_UnFormatDateTime($pemilihan_pokok->TanggalSaldo->CurrentValue, 7);
		}
		if (!$pemilihan_pokok->Saldo->FldIsDetailKey) {
			$pemilihan_pokok->Saldo->setFormValue($objForm->GetValue("x_Saldo"));
		}
		if (!$pemilihan_pokok->target->FldIsDetailKey) {
			$pemilihan_pokok->target->setFormValue($objForm->GetValue("x_target"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pemilihan_pokok;
		$this->LoadOldRecord();
		$pemilihan_pokok->kodePokok->CurrentValue = $pemilihan_pokok->kodePokok->FormValue;
		$pemilihan_pokok->nama_pokok->CurrentValue = $pemilihan_pokok->nama_pokok->FormValue;
		$pemilihan_pokok->kodeSubSatu->CurrentValue = $pemilihan_pokok->kodeSubSatu->FormValue;
		$pemilihan_pokok->nama_sub_satu->CurrentValue = $pemilihan_pokok->nama_sub_satu->FormValue;
		$pemilihan_pokok->kodeSubDua->CurrentValue = $pemilihan_pokok->kodeSubDua->FormValue;
		$pemilihan_pokok->nama_sub_dua->CurrentValue = $pemilihan_pokok->nama_sub_dua->FormValue;
		$pemilihan_pokok->kodeSubTiga->CurrentValue = $pemilihan_pokok->kodeSubTiga->FormValue;
		$pemilihan_pokok->nama_sub_tiga->CurrentValue = $pemilihan_pokok->nama_sub_tiga->FormValue;
		$pemilihan_pokok->Norek->CurrentValue = $pemilihan_pokok->Norek->FormValue;
		$pemilihan_pokok->Keterangan->CurrentValue = $pemilihan_pokok->Keterangan->FormValue;
		$pemilihan_pokok->D2FK->CurrentValue = $pemilihan_pokok->D2FK->FormValue;
		$pemilihan_pokok->SaldoAwal->CurrentValue = $pemilihan_pokok->SaldoAwal->FormValue;
		$pemilihan_pokok->TanggalSaldo->CurrentValue = $pemilihan_pokok->TanggalSaldo->FormValue;
		$pemilihan_pokok->TanggalSaldo->CurrentValue = ew_UnFormatDateTime($pemilihan_pokok->TanggalSaldo->CurrentValue, 7);
		$pemilihan_pokok->Saldo->CurrentValue = $pemilihan_pokok->Saldo->FormValue;
		$pemilihan_pokok->target->CurrentValue = $pemilihan_pokok->target->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pemilihan_pokok;
		$sFilter = $pemilihan_pokok->KeyFilter();

		// Call Row Selecting event
		$pemilihan_pokok->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pemilihan_pokok->CurrentFilter = $sFilter;
		$sSql = $pemilihan_pokok->SQL();
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
		global $conn, $pemilihan_pokok;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pemilihan_pokok->Row_Selected($row);
		$pemilihan_pokok->kodePokok->setDbValue($rs->fields('kodePokok'));
		if (array_key_exists('EV__kodePokok', $rs->fields)) {
			$pemilihan_pokok->kodePokok->VirtualValue = $rs->fields('EV__kodePokok'); // Set up virtual field value
		} else {
			$pemilihan_pokok->kodePokok->VirtualValue = ""; // Clear value
		}
		$pemilihan_pokok->nama_pokok->setDbValue($rs->fields('nama_pokok'));
		$pemilihan_pokok->kodeSubSatu->setDbValue($rs->fields('kodeSubSatu'));
		$pemilihan_pokok->nama_sub_satu->setDbValue($rs->fields('nama_sub_satu'));
		$pemilihan_pokok->kodeSubDua->setDbValue($rs->fields('kodeSubDua'));
		$pemilihan_pokok->nama_sub_dua->setDbValue($rs->fields('nama_sub_dua'));
		$pemilihan_pokok->kodeSubTiga->setDbValue($rs->fields('kodeSubTiga'));
		$pemilihan_pokok->nama_sub_tiga->setDbValue($rs->fields('nama_sub_tiga'));
		$pemilihan_pokok->Norek->setDbValue($rs->fields('Norek'));
		$pemilihan_pokok->Keterangan->setDbValue($rs->fields('Keterangan'));
		$pemilihan_pokok->D2FK->setDbValue($rs->fields('D/K'));
		$pemilihan_pokok->SaldoAwal->setDbValue($rs->fields('SaldoAwal'));
		$pemilihan_pokok->TanggalSaldo->setDbValue($rs->fields('TanggalSaldo'));
		$pemilihan_pokok->Saldo->setDbValue($rs->fields('Saldo'));
		$pemilihan_pokok->target->setDbValue($rs->fields('target'));
		$pemilihan_pokok->id->setDbValue($rs->fields('id'));
	}

	// Load old record
	function LoadOldRecord() {
		global $pemilihan_pokok;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pemilihan_pokok->getKey("id")) <> "")
			$pemilihan_pokok->id->CurrentValue = $pemilihan_pokok->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pemilihan_pokok->CurrentFilter = $pemilihan_pokok->KeyFilter();
			$sSql = $pemilihan_pokok->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pemilihan_pokok;

		// Initialize URLs
		// Call Row_Rendering event

		$pemilihan_pokok->Row_Rendering();

		// Common render codes for all row types
		// kodePokok
		// nama_pokok
		// kodeSubSatu
		// nama_sub_satu
		// kodeSubDua
		// nama_sub_dua
		// kodeSubTiga
		// nama_sub_tiga
		// Norek
		// Keterangan
		// D/K
		// SaldoAwal
		// TanggalSaldo
		// Saldo
		// target
		// id

		if ($pemilihan_pokok->RowType == EW_ROWTYPE_VIEW) { // View row

			// kodePokok
			if ($pemilihan_pokok->kodePokok->VirtualValue <> "") {
				$pemilihan_pokok->kodePokok->ViewValue = $pemilihan_pokok->kodePokok->VirtualValue;
			} else {
			if (strval($pemilihan_pokok->kodePokok->CurrentValue) <> "") {
				$sFilterWrk = "`kodePokok` = '" . ew_AdjustSql($pemilihan_pokok->kodePokok->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kodePokok`, `namaPokok` FROM `pokokrek`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_pokok->kodePokok->ViewValue = $rswrk->fields('kodePokok');
					$pemilihan_pokok->kodePokok->ViewValue .= ew_ValueSeparator(0,1,$pemilihan_pokok->kodePokok) . $rswrk->fields('namaPokok');
					$rswrk->Close();
				} else {
					$pemilihan_pokok->kodePokok->ViewValue = $pemilihan_pokok->kodePokok->CurrentValue;
				}
			} else {
				$pemilihan_pokok->kodePokok->ViewValue = NULL;
			}
			}
			$pemilihan_pokok->kodePokok->ViewCustomAttributes = "";

			// nama_pokok
			if (strval($pemilihan_pokok->nama_pokok->CurrentValue) <> "") {
				$sFilterWrk = "`namaPokok` = '" . ew_AdjustSql($pemilihan_pokok->nama_pokok->CurrentValue) . "'";
			$sSqlWrk = "SELECT `namaPokok` FROM `pokokrek`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_pokok->nama_pokok->ViewValue = $rswrk->fields('namaPokok');
					$rswrk->Close();
				} else {
					$pemilihan_pokok->nama_pokok->ViewValue = $pemilihan_pokok->nama_pokok->CurrentValue;
				}
			} else {
				$pemilihan_pokok->nama_pokok->ViewValue = NULL;
			}
			$pemilihan_pokok->nama_pokok->ViewCustomAttributes = "";

			// kodeSubSatu
			if (strval($pemilihan_pokok->kodeSubSatu->CurrentValue) <> "") {
				$sFilterWrk = "`kodeSubSatu` = '" . ew_AdjustSql($pemilihan_pokok->kodeSubSatu->CurrentValue) . "'";
			$sSqlWrk = "SELECT `kodeSubSatu`, `namaSubSatu` FROM `subsaturek`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$pemilihan_pokok->kodeSubSatu->ViewValue = $rswrk->fields('kodeSubSatu');
					$pemilihan_pokok->kodeSubSatu->ViewValue .= ew_ValueSeparator(0,1,$pemilihan_pokok->kodeSubSatu) . $rswrk->fields('namaSubSatu');
					$rswrk->Close();
				} else {
					$pemilihan_pokok->kodeSubSatu->ViewValue = $pemilihan_pokok->kodeSubSatu->CurrentValue;
				}
			} else {
				$pemilihan_pokok->kodeSubSatu->ViewValue = NULL;
			}
			$pemilihan_pokok->kodeSubSatu->ViewCustomAttributes = "";

			// nama_sub_satu
			$pemilihan_pokok->nama_sub_satu->ViewValue = $pemilihan_pokok->nama_sub_satu->CurrentValue;
			$pemilihan_pokok->nama_sub_satu->ViewCustomAttributes = "";

			// kodeSubDua
			$pemilihan_pokok->kodeSubDua->ViewValue = $pemilihan_pokok->kodeSubDua->CurrentValue;
			$pemilihan_pokok->kodeSubDua->ViewCustomAttributes = "";

			// nama_sub_dua
			$pemilihan_pokok->nama_sub_dua->ViewValue = $pemilihan_pokok->nama_sub_dua->CurrentValue;
			$pemilihan_pokok->nama_sub_dua->ViewCustomAttributes = "";

			// kodeSubTiga
			$pemilihan_pokok->kodeSubTiga->ViewValue = $pemilihan_pokok->kodeSubTiga->CurrentValue;
			$pemilihan_pokok->kodeSubTiga->ViewCustomAttributes = "";

			// nama_sub_tiga
			$pemilihan_pokok->nama_sub_tiga->ViewValue = $pemilihan_pokok->nama_sub_tiga->CurrentValue;
			$pemilihan_pokok->nama_sub_tiga->ViewCustomAttributes = "";

			// Norek
			$pemilihan_pokok->Norek->ViewValue = $pemilihan_pokok->Norek->CurrentValue;
			$pemilihan_pokok->Norek->ViewCustomAttributes = "";

			// Keterangan
			$pemilihan_pokok->Keterangan->ViewValue = $pemilihan_pokok->Keterangan->CurrentValue;
			$pemilihan_pokok->Keterangan->ViewCustomAttributes = "";

			// D/K
			$pemilihan_pokok->D2FK->ViewValue = $pemilihan_pokok->D2FK->CurrentValue;
			$pemilihan_pokok->D2FK->ViewCustomAttributes = "";

			// SaldoAwal
			$pemilihan_pokok->SaldoAwal->ViewValue = $pemilihan_pokok->SaldoAwal->CurrentValue;
			$pemilihan_pokok->SaldoAwal->ViewCustomAttributes = "";

			// TanggalSaldo
			$pemilihan_pokok->TanggalSaldo->ViewValue = $pemilihan_pokok->TanggalSaldo->CurrentValue;
			$pemilihan_pokok->TanggalSaldo->ViewValue = ew_FormatDateTime($pemilihan_pokok->TanggalSaldo->ViewValue, 7);
			$pemilihan_pokok->TanggalSaldo->ViewCustomAttributes = "";

			// Saldo
			$pemilihan_pokok->Saldo->ViewValue = $pemilihan_pokok->Saldo->CurrentValue;
			$pemilihan_pokok->Saldo->ViewCustomAttributes = "";

			// target
			$pemilihan_pokok->target->ViewValue = $pemilihan_pokok->target->CurrentValue;
			$pemilihan_pokok->target->ViewCustomAttributes = "";

			// id
			$pemilihan_pokok->id->ViewValue = $pemilihan_pokok->id->CurrentValue;
			$pemilihan_pokok->id->ViewCustomAttributes = "";

			// kodePokok
			$pemilihan_pokok->kodePokok->LinkCustomAttributes = "";
			$pemilihan_pokok->kodePokok->HrefValue = "";
			$pemilihan_pokok->kodePokok->TooltipValue = "";

			// nama_pokok
			$pemilihan_pokok->nama_pokok->LinkCustomAttributes = "";
			$pemilihan_pokok->nama_pokok->HrefValue = "";
			$pemilihan_pokok->nama_pokok->TooltipValue = "";

			// kodeSubSatu
			$pemilihan_pokok->kodeSubSatu->LinkCustomAttributes = "";
			$pemilihan_pokok->kodeSubSatu->HrefValue = "";
			$pemilihan_pokok->kodeSubSatu->TooltipValue = "";

			// nama_sub_satu
			$pemilihan_pokok->nama_sub_satu->LinkCustomAttributes = "";
			$pemilihan_pokok->nama_sub_satu->HrefValue = "";
			$pemilihan_pokok->nama_sub_satu->TooltipValue = "";

			// kodeSubDua
			$pemilihan_pokok->kodeSubDua->LinkCustomAttributes = "";
			$pemilihan_pokok->kodeSubDua->HrefValue = "";
			$pemilihan_pokok->kodeSubDua->TooltipValue = "";

			// nama_sub_dua
			$pemilihan_pokok->nama_sub_dua->LinkCustomAttributes = "";
			$pemilihan_pokok->nama_sub_dua->HrefValue = "";
			$pemilihan_pokok->nama_sub_dua->TooltipValue = "";

			// kodeSubTiga
			$pemilihan_pokok->kodeSubTiga->LinkCustomAttributes = "";
			$pemilihan_pokok->kodeSubTiga->HrefValue = "";
			$pemilihan_pokok->kodeSubTiga->TooltipValue = "";

			// nama_sub_tiga
			$pemilihan_pokok->nama_sub_tiga->LinkCustomAttributes = "";
			$pemilihan_pokok->nama_sub_tiga->HrefValue = "";
			$pemilihan_pokok->nama_sub_tiga->TooltipValue = "";

			// Norek
			$pemilihan_pokok->Norek->LinkCustomAttributes = "";
			$pemilihan_pokok->Norek->HrefValue = "";
			$pemilihan_pokok->Norek->TooltipValue = "";

			// Keterangan
			$pemilihan_pokok->Keterangan->LinkCustomAttributes = "";
			$pemilihan_pokok->Keterangan->HrefValue = "";
			$pemilihan_pokok->Keterangan->TooltipValue = "";

			// D/K
			$pemilihan_pokok->D2FK->LinkCustomAttributes = "";
			$pemilihan_pokok->D2FK->HrefValue = "";
			$pemilihan_pokok->D2FK->TooltipValue = "";

			// SaldoAwal
			$pemilihan_pokok->SaldoAwal->LinkCustomAttributes = "";
			$pemilihan_pokok->SaldoAwal->HrefValue = "";
			$pemilihan_pokok->SaldoAwal->TooltipValue = "";

			// TanggalSaldo
			$pemilihan_pokok->TanggalSaldo->LinkCustomAttributes = "";
			$pemilihan_pokok->TanggalSaldo->HrefValue = "";
			$pemilihan_pokok->TanggalSaldo->TooltipValue = "";

			// Saldo
			$pemilihan_pokok->Saldo->LinkCustomAttributes = "";
			$pemilihan_pokok->Saldo->HrefValue = "";
			$pemilihan_pokok->Saldo->TooltipValue = "";

			// target
			$pemilihan_pokok->target->LinkCustomAttributes = "";
			$pemilihan_pokok->target->HrefValue = "";
			$pemilihan_pokok->target->TooltipValue = "";
		} elseif ($pemilihan_pokok->RowType == EW_ROWTYPE_ADD) { // Add row

			// kodePokok
			$pemilihan_pokok->kodePokok->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kodePokok`, `kodePokok` AS `DispFld`, `namaPokok` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `pokokrek`";
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
			$pemilihan_pokok->kodePokok->EditValue = $arwrk;

			// nama_pokok
			$pemilihan_pokok->nama_pokok->EditCustomAttributes = "autoselect=true";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `namaPokok`, `namaPokok` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `kodePokok` AS `SelectFilterFld` FROM `pokokrek`";
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
			$pemilihan_pokok->nama_pokok->EditValue = $arwrk;

			// kodeSubSatu
			$pemilihan_pokok->kodeSubSatu->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `kodeSubSatu`, `kodeSubSatu` AS `DispFld`, `namaSubSatu` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `subsaturek`";
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
			$pemilihan_pokok->kodeSubSatu->EditValue = $arwrk;

			// nama_sub_satu
			$pemilihan_pokok->nama_sub_satu->EditCustomAttributes = "";
			$pemilihan_pokok->nama_sub_satu->EditValue = ew_HtmlEncode($pemilihan_pokok->nama_sub_satu->CurrentValue);

			// kodeSubDua
			$pemilihan_pokok->kodeSubDua->EditCustomAttributes = "";
			$pemilihan_pokok->kodeSubDua->EditValue = ew_HtmlEncode($pemilihan_pokok->kodeSubDua->CurrentValue);

			// nama_sub_dua
			$pemilihan_pokok->nama_sub_dua->EditCustomAttributes = "";
			$pemilihan_pokok->nama_sub_dua->EditValue = ew_HtmlEncode($pemilihan_pokok->nama_sub_dua->CurrentValue);

			// kodeSubTiga
			$pemilihan_pokok->kodeSubTiga->EditCustomAttributes = "";
			$pemilihan_pokok->kodeSubTiga->EditValue = ew_HtmlEncode($pemilihan_pokok->kodeSubTiga->CurrentValue);

			// nama_sub_tiga
			$pemilihan_pokok->nama_sub_tiga->EditCustomAttributes = "";
			$pemilihan_pokok->nama_sub_tiga->EditValue = ew_HtmlEncode($pemilihan_pokok->nama_sub_tiga->CurrentValue);

			// Norek
			$pemilihan_pokok->Norek->EditCustomAttributes = "";
			$pemilihan_pokok->Norek->EditValue = ew_HtmlEncode($pemilihan_pokok->Norek->CurrentValue);

			// Keterangan
			$pemilihan_pokok->Keterangan->EditCustomAttributes = "";
			$pemilihan_pokok->Keterangan->EditValue = ew_HtmlEncode($pemilihan_pokok->Keterangan->CurrentValue);

			// D/K
			$pemilihan_pokok->D2FK->EditCustomAttributes = "";
			$pemilihan_pokok->D2FK->EditValue = ew_HtmlEncode($pemilihan_pokok->D2FK->CurrentValue);

			// SaldoAwal
			$pemilihan_pokok->SaldoAwal->EditCustomAttributes = "";
			$pemilihan_pokok->SaldoAwal->EditValue = ew_HtmlEncode($pemilihan_pokok->SaldoAwal->CurrentValue);

			// TanggalSaldo
			$pemilihan_pokok->TanggalSaldo->EditCustomAttributes = "";
			$pemilihan_pokok->TanggalSaldo->EditValue = ew_HtmlEncode(ew_FormatDateTime($pemilihan_pokok->TanggalSaldo->CurrentValue, 7));

			// Saldo
			$pemilihan_pokok->Saldo->EditCustomAttributes = "";
			$pemilihan_pokok->Saldo->EditValue = ew_HtmlEncode($pemilihan_pokok->Saldo->CurrentValue);

			// target
			$pemilihan_pokok->target->EditCustomAttributes = "";
			$pemilihan_pokok->target->EditValue = ew_HtmlEncode($pemilihan_pokok->target->CurrentValue);

			// Edit refer script
			// kodePokok

			$pemilihan_pokok->kodePokok->HrefValue = "";

			// nama_pokok
			$pemilihan_pokok->nama_pokok->HrefValue = "";

			// kodeSubSatu
			$pemilihan_pokok->kodeSubSatu->HrefValue = "";

			// nama_sub_satu
			$pemilihan_pokok->nama_sub_satu->HrefValue = "";

			// kodeSubDua
			$pemilihan_pokok->kodeSubDua->HrefValue = "";

			// nama_sub_dua
			$pemilihan_pokok->nama_sub_dua->HrefValue = "";

			// kodeSubTiga
			$pemilihan_pokok->kodeSubTiga->HrefValue = "";

			// nama_sub_tiga
			$pemilihan_pokok->nama_sub_tiga->HrefValue = "";

			// Norek
			$pemilihan_pokok->Norek->HrefValue = "";

			// Keterangan
			$pemilihan_pokok->Keterangan->HrefValue = "";

			// D/K
			$pemilihan_pokok->D2FK->HrefValue = "";

			// SaldoAwal
			$pemilihan_pokok->SaldoAwal->HrefValue = "";

			// TanggalSaldo
			$pemilihan_pokok->TanggalSaldo->HrefValue = "";

			// Saldo
			$pemilihan_pokok->Saldo->HrefValue = "";

			// target
			$pemilihan_pokok->target->HrefValue = "";
		}
		if ($pemilihan_pokok->RowType == EW_ROWTYPE_ADD ||
			$pemilihan_pokok->RowType == EW_ROWTYPE_EDIT ||
			$pemilihan_pokok->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$pemilihan_pokok->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($pemilihan_pokok->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pemilihan_pokok->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $pemilihan_pokok;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($pemilihan_pokok->kodePokok->FormValue) && $pemilihan_pokok->kodePokok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->kodePokok->FldCaption());
		}
		if (!is_null($pemilihan_pokok->nama_pokok->FormValue) && $pemilihan_pokok->nama_pokok->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->nama_pokok->FldCaption());
		}
		if (!is_null($pemilihan_pokok->kodeSubSatu->FormValue) && $pemilihan_pokok->kodeSubSatu->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->kodeSubSatu->FldCaption());
		}
		if (!is_null($pemilihan_pokok->nama_sub_satu->FormValue) && $pemilihan_pokok->nama_sub_satu->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->nama_sub_satu->FldCaption());
		}
		if (!is_null($pemilihan_pokok->kodeSubDua->FormValue) && $pemilihan_pokok->kodeSubDua->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->kodeSubDua->FldCaption());
		}
		if (!is_null($pemilihan_pokok->nama_sub_dua->FormValue) && $pemilihan_pokok->nama_sub_dua->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->nama_sub_dua->FldCaption());
		}
		if (!is_null($pemilihan_pokok->kodeSubTiga->FormValue) && $pemilihan_pokok->kodeSubTiga->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->kodeSubTiga->FldCaption());
		}
		if (!is_null($pemilihan_pokok->nama_sub_tiga->FormValue) && $pemilihan_pokok->nama_sub_tiga->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->nama_sub_tiga->FldCaption());
		}
		if (!is_null($pemilihan_pokok->Norek->FormValue) && $pemilihan_pokok->Norek->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->Norek->FldCaption());
		}
		if (!is_null($pemilihan_pokok->Keterangan->FormValue) && $pemilihan_pokok->Keterangan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->Keterangan->FldCaption());
		}
		if (!is_null($pemilihan_pokok->D2FK->FormValue) && $pemilihan_pokok->D2FK->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pemilihan_pokok->D2FK->FldCaption());
		}
		if (!ew_CheckNumber($pemilihan_pokok->SaldoAwal->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_pokok->SaldoAwal->FldErrMsg());
		}
		if (!ew_CheckEuroDate($pemilihan_pokok->TanggalSaldo->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_pokok->TanggalSaldo->FldErrMsg());
		}
		if (!ew_CheckNumber($pemilihan_pokok->Saldo->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_pokok->Saldo->FldErrMsg());
		}
		if (!ew_CheckNumber($pemilihan_pokok->target->FormValue)) {
			ew_AddMessage($gsFormError, $pemilihan_pokok->target->FldErrMsg());
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
		global $conn, $Language, $Security, $pemilihan_pokok;
		if ($pemilihan_pokok->Norek->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(Norek = '" . ew_AdjustSql($pemilihan_pokok->Norek->CurrentValue) . "')";
			$rsChk = $pemilihan_pokok->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'Norek', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $pemilihan_pokok->Norek->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// kodePokok
		$pemilihan_pokok->kodePokok->SetDbValueDef($rsnew, $pemilihan_pokok->kodePokok->CurrentValue, "", FALSE);

		// nama_pokok
		$pemilihan_pokok->nama_pokok->SetDbValueDef($rsnew, $pemilihan_pokok->nama_pokok->CurrentValue, "", FALSE);

		// kodeSubSatu
		$pemilihan_pokok->kodeSubSatu->SetDbValueDef($rsnew, $pemilihan_pokok->kodeSubSatu->CurrentValue, "", FALSE);

		// nama_sub_satu
		$pemilihan_pokok->nama_sub_satu->SetDbValueDef($rsnew, $pemilihan_pokok->nama_sub_satu->CurrentValue, "", FALSE);

		// kodeSubDua
		$pemilihan_pokok->kodeSubDua->SetDbValueDef($rsnew, $pemilihan_pokok->kodeSubDua->CurrentValue, "", FALSE);

		// nama_sub_dua
		$pemilihan_pokok->nama_sub_dua->SetDbValueDef($rsnew, $pemilihan_pokok->nama_sub_dua->CurrentValue, "", FALSE);

		// kodeSubTiga
		$pemilihan_pokok->kodeSubTiga->SetDbValueDef($rsnew, $pemilihan_pokok->kodeSubTiga->CurrentValue, "", FALSE);

		// nama_sub_tiga
		$pemilihan_pokok->nama_sub_tiga->SetDbValueDef($rsnew, $pemilihan_pokok->nama_sub_tiga->CurrentValue, "", FALSE);

		// Norek
		$pemilihan_pokok->Norek->SetDbValueDef($rsnew, $pemilihan_pokok->Norek->CurrentValue, "", FALSE);

		// Keterangan
		$pemilihan_pokok->Keterangan->SetDbValueDef($rsnew, $pemilihan_pokok->Keterangan->CurrentValue, "", FALSE);

		// D/K
		$pemilihan_pokok->D2FK->SetDbValueDef($rsnew, $pemilihan_pokok->D2FK->CurrentValue, "", FALSE);

		// SaldoAwal
		$pemilihan_pokok->SaldoAwal->SetDbValueDef($rsnew, $pemilihan_pokok->SaldoAwal->CurrentValue, 0, strval($pemilihan_pokok->SaldoAwal->CurrentValue) == "");

		// TanggalSaldo
		$pemilihan_pokok->TanggalSaldo->SetDbValueDef($rsnew, ew_UnFormatDateTime($pemilihan_pokok->TanggalSaldo->CurrentValue, 7), ew_CurrentDate(), strval($pemilihan_pokok->TanggalSaldo->CurrentValue) == "");

		// Saldo
		$pemilihan_pokok->Saldo->SetDbValueDef($rsnew, $pemilihan_pokok->Saldo->CurrentValue, 0, strval($pemilihan_pokok->Saldo->CurrentValue) == "");

		// target
		$pemilihan_pokok->target->SetDbValueDef($rsnew, $pemilihan_pokok->target->CurrentValue, 0, strval($pemilihan_pokok->target->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $pemilihan_pokok->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($pemilihan_pokok->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($pemilihan_pokok->CancelMessage <> "") {
				$this->setFailureMessage($pemilihan_pokok->CancelMessage);
				$pemilihan_pokok->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$pemilihan_pokok->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $pemilihan_pokok->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$pemilihan_pokok->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
}
?>

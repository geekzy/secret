<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_laporan_keuanganinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_laporan_keuangan_search = new ckeu_laporan_keuangan_search();
$Page =& $keu_laporan_keuangan_search;

// Page init
$keu_laporan_keuangan_search->Page_Init();

// Page main
$keu_laporan_keuangan_search->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var keu_laporan_keuangan_search = new ew_Page("keu_laporan_keuangan_search");

// page properties
keu_laporan_keuangan_search.PageID = "search"; // page ID
keu_laporan_keuangan_search.FormID = "fkeu_laporan_keuangansearch"; // form ID
var EW_PAGE_ID = keu_laporan_keuangan_search.PageID; // for backward compatibility

// extend page with validate function for search
keu_laporan_keuangan_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_nilai_tanggungan_bruto"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->nilai_tanggungan_bruto->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_rencana_bayar"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->tanggal_rencana_bayar->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_sosial"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_sosial->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_waktu"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_waktu->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_prestasi"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_prestasi->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_internal"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_internal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_lain_lain"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_lain_lain->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_nilai_tanggungan_netto"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->nilai_tanggungan_netto->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_jum_cicilan"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->jum_cicilan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_kekurangan_pembayaran"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->kekurangan_pembayaran->FldErrMsg()) ?>");

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
keu_laporan_keuangan_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_laporan_keuangan_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_laporan_keuangan_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
keu_laporan_keuangan_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
keu_laporan_keuangan_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $keu_laporan_keuangan->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $keu_laporan_keuangan->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></p>
<?php $keu_laporan_keuangan_search->ShowPageHeader(); ?>
<?php
$keu_laporan_keuangan_search->ShowMessage();
?>
<form name="fkeu_laporan_keuangansearch" id="fkeu_laporan_keuangansearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return keu_laporan_keuangan_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="keu_laporan_keuangan">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_identitas"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->identitas->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_identitas" id="z_identitas" onchange="ew_SrchOprChanged('z_identitas')"><option value="="<?php echo ($keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->identitas->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_identitas" id="x_identitas" size="30" maxlength="50" value="<?php echo $keu_laporan_keuangan->identitas->EditValue ?>"<?php echo $keu_laporan_keuangan->identitas->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_identitas" name="btw1_identitas">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_identitas" name="btw1_identitas">
<input type="text" name="y_identitas" id="y_identitas" size="30" maxlength="50" value="<?php echo $keu_laporan_keuangan->identitas->EditValue2 ?>"<?php echo $keu_laporan_keuangan->identitas->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_nama_lengkap"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->A_nama_lengkap->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_nama_lengkap" id="z_A_nama_lengkap" onchange="ew_SrchOprChanged('z_A_nama_lengkap')"><option value="="<?php echo ($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->A_nama_lengkap->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_nama_lengkap" id="x_A_nama_lengkap" size="30" maxlength="50" value="<?php echo $keu_laporan_keuangan->A_nama_lengkap->EditValue ?>"<?php echo $keu_laporan_keuangan->A_nama_lengkap->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_nama_lengkap" name="btw1_A_nama_lengkap">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_nama_lengkap" name="btw1_A_nama_lengkap">
<input type="text" name="y_A_nama_lengkap" id="y_A_nama_lengkap" size="30" maxlength="50" value="<?php echo $keu_laporan_keuangan->A_nama_lengkap->EditValue2 ?>"<?php echo $keu_laporan_keuangan->A_nama_lengkap->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_nama_biaya"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->nama_biaya->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_nama_biaya" id="z_nama_biaya" onchange="ew_SrchOprChanged('z_nama_biaya')"><option value="="<?php echo ($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->nama_biaya->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_nama_biaya" id="x_nama_biaya" size="30" maxlength="50" value="<?php echo $keu_laporan_keuangan->nama_biaya->EditValue ?>"<?php echo $keu_laporan_keuangan->nama_biaya->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_nama_biaya" name="btw1_nama_biaya">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_nama_biaya" name="btw1_nama_biaya">
<input type="text" name="y_nama_biaya" id="y_nama_biaya" size="30" maxlength="50" value="<?php echo $keu_laporan_keuangan->nama_biaya->EditValue2 ?>"<?php echo $keu_laporan_keuangan->nama_biaya->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_nilai_tanggungan_bruto"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_nilai_tanggungan_bruto" id="z_nilai_tanggungan_bruto" onchange="ew_SrchOprChanged('z_nilai_tanggungan_bruto')"><option value="="<?php echo ($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_nilai_tanggungan_bruto" id="x_nilai_tanggungan_bruto" size="30" value="<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->EditValue ?>"<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_nilai_tanggungan_bruto" name="btw1_nilai_tanggungan_bruto">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_nilai_tanggungan_bruto" name="btw1_nilai_tanggungan_bruto">
<input type="text" name="y_nilai_tanggungan_bruto" id="y_nilai_tanggungan_bruto" size="30" value="<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->EditValue2 ?>"<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_tanggal_rencana_bayar"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_tanggal_rencana_bayar" id="z_tanggal_rencana_bayar" onchange="ew_SrchOprChanged('z_tanggal_rencana_bayar')"><option value="="<?php echo ($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_tanggal_rencana_bayar" id="x_tanggal_rencana_bayar" value="<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->EditValue ?>"<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_tanggal_rencana_bayar" name="cal_x_tanggal_rencana_bayar" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_tanggal_rencana_bayar", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_tanggal_rencana_bayar" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_tanggal_rencana_bayar" name="btw1_tanggal_rencana_bayar">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_tanggal_rencana_bayar" name="btw1_tanggal_rencana_bayar">
<input type="text" name="y_tanggal_rencana_bayar" id="y_tanggal_rencana_bayar" value="<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->EditValue2 ?>"<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_tanggal_rencana_bayar" name="cal_y_tanggal_rencana_bayar" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_tanggal_rencana_bayar", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_tanggal_rencana_bayar" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_diskon_sosial"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_sosial->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_diskon_sosial" id="z_diskon_sosial" onchange="ew_SrchOprChanged('z_diskon_sosial')"><option value="="<?php echo ($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->diskon_sosial->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_diskon_sosial" id="x_diskon_sosial" size="30" value="<?php echo $keu_laporan_keuangan->diskon_sosial->EditValue ?>"<?php echo $keu_laporan_keuangan->diskon_sosial->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_diskon_sosial" name="btw1_diskon_sosial">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_diskon_sosial" name="btw1_diskon_sosial">
<input type="text" name="y_diskon_sosial" id="y_diskon_sosial" size="30" value="<?php echo $keu_laporan_keuangan->diskon_sosial->EditValue2 ?>"<?php echo $keu_laporan_keuangan->diskon_sosial->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_diskon_waktu"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_waktu->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_diskon_waktu" id="z_diskon_waktu" onchange="ew_SrchOprChanged('z_diskon_waktu')"><option value="="<?php echo ($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->diskon_waktu->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_diskon_waktu" id="x_diskon_waktu" size="30" value="<?php echo $keu_laporan_keuangan->diskon_waktu->EditValue ?>"<?php echo $keu_laporan_keuangan->diskon_waktu->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_diskon_waktu" name="btw1_diskon_waktu">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_diskon_waktu" name="btw1_diskon_waktu">
<input type="text" name="y_diskon_waktu" id="y_diskon_waktu" size="30" value="<?php echo $keu_laporan_keuangan->diskon_waktu->EditValue2 ?>"<?php echo $keu_laporan_keuangan->diskon_waktu->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_diskon_prestasi"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_prestasi->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_diskon_prestasi" id="z_diskon_prestasi" onchange="ew_SrchOprChanged('z_diskon_prestasi')"><option value="="<?php echo ($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->diskon_prestasi->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_diskon_prestasi" id="x_diskon_prestasi" size="30" value="<?php echo $keu_laporan_keuangan->diskon_prestasi->EditValue ?>"<?php echo $keu_laporan_keuangan->diskon_prestasi->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_diskon_prestasi" name="btw1_diskon_prestasi">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_diskon_prestasi" name="btw1_diskon_prestasi">
<input type="text" name="y_diskon_prestasi" id="y_diskon_prestasi" size="30" value="<?php echo $keu_laporan_keuangan->diskon_prestasi->EditValue2 ?>"<?php echo $keu_laporan_keuangan->diskon_prestasi->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_diskon_internal"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_internal->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_diskon_internal" id="z_diskon_internal" onchange="ew_SrchOprChanged('z_diskon_internal')"><option value="="<?php echo ($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->diskon_internal->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_diskon_internal" id="x_diskon_internal" size="30" value="<?php echo $keu_laporan_keuangan->diskon_internal->EditValue ?>"<?php echo $keu_laporan_keuangan->diskon_internal->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_diskon_internal" name="btw1_diskon_internal">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_diskon_internal" name="btw1_diskon_internal">
<input type="text" name="y_diskon_internal" id="y_diskon_internal" size="30" value="<?php echo $keu_laporan_keuangan->diskon_internal->EditValue2 ?>"<?php echo $keu_laporan_keuangan->diskon_internal->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_diskon_lain_lain"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_lain_lain->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_diskon_lain_lain" id="z_diskon_lain_lain" onchange="ew_SrchOprChanged('z_diskon_lain_lain')"><option value="="<?php echo ($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->diskon_lain_lain->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_diskon_lain_lain" id="x_diskon_lain_lain" size="30" value="<?php echo $keu_laporan_keuangan->diskon_lain_lain->EditValue ?>"<?php echo $keu_laporan_keuangan->diskon_lain_lain->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_diskon_lain_lain" name="btw1_diskon_lain_lain">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_diskon_lain_lain" name="btw1_diskon_lain_lain">
<input type="text" name="y_diskon_lain_lain" id="y_diskon_lain_lain" size="30" value="<?php echo $keu_laporan_keuangan->diskon_lain_lain->EditValue2 ?>"<?php echo $keu_laporan_keuangan->diskon_lain_lain->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_nilai_tanggungan_netto"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_nilai_tanggungan_netto" id="z_nilai_tanggungan_netto" onchange="ew_SrchOprChanged('z_nilai_tanggungan_netto')"><option value="="<?php echo ($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_nilai_tanggungan_netto" id="x_nilai_tanggungan_netto" size="30" value="<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->EditValue ?>"<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_nilai_tanggungan_netto" name="btw1_nilai_tanggungan_netto">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_nilai_tanggungan_netto" name="btw1_nilai_tanggungan_netto">
<input type="text" name="y_nilai_tanggungan_netto" id="y_nilai_tanggungan_netto" size="30" value="<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->EditValue2 ?>"<?php echo $keu_laporan_keuangan->nilai_tanggungan_netto->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_jum_cicilan"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->jum_cicilan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_jum_cicilan" id="z_jum_cicilan" onchange="ew_SrchOprChanged('z_jum_cicilan')"><option value="="<?php echo ($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->jum_cicilan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_jum_cicilan" id="x_jum_cicilan" size="30" value="<?php echo $keu_laporan_keuangan->jum_cicilan->EditValue ?>"<?php echo $keu_laporan_keuangan->jum_cicilan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_jum_cicilan" name="btw1_jum_cicilan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_jum_cicilan" name="btw1_jum_cicilan">
<input type="text" name="y_jum_cicilan" id="y_jum_cicilan" size="30" value="<?php echo $keu_laporan_keuangan->jum_cicilan->EditValue2 ?>"<?php echo $keu_laporan_keuangan->jum_cicilan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_kekurangan_pembayaran"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->kekurangan_pembayaran->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_kekurangan_pembayaran" id="z_kekurangan_pembayaran" onchange="ew_SrchOprChanged('z_kekurangan_pembayaran')"><option value="="<?php echo ($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_kekurangan_pembayaran" id="x_kekurangan_pembayaran" size="30" value="<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->EditValue ?>"<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_kekurangan_pembayaran" name="btw1_kekurangan_pembayaran">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_kekurangan_pembayaran" name="btw1_kekurangan_pembayaran">
<input type="text" name="y_kekurangan_pembayaran" id="y_kekurangan_pembayaran" size="30" value="<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->EditValue2 ?>"<?php echo $keu_laporan_keuangan->kekurangan_pembayaran->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_SrchOprChanged('z_identitas');
ew_SrchOprChanged('z_A_nama_lengkap');
ew_SrchOprChanged('z_nama_biaya');
ew_SrchOprChanged('z_nilai_tanggungan_bruto');
ew_SrchOprChanged('z_tanggal_rencana_bayar');
ew_SrchOprChanged('z_diskon_sosial');
ew_SrchOprChanged('z_diskon_waktu');
ew_SrchOprChanged('z_diskon_prestasi');
ew_SrchOprChanged('z_diskon_internal');
ew_SrchOprChanged('z_diskon_lain_lain');
ew_SrchOprChanged('z_nilai_tanggungan_netto');
ew_SrchOprChanged('z_jum_cicilan');
ew_SrchOprChanged('z_kekurangan_pembayaran');

//-->
</script>
<?php
$keu_laporan_keuangan_search->ShowPageFooter();
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
$keu_laporan_keuangan_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_laporan_keuangan_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'keu_laporan_keuangan';

	// Page object name
	var $PageObjName = 'keu_laporan_keuangan_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_laporan_keuangan;
		if ($keu_laporan_keuangan->UseTokenInUrl) $PageUrl .= "t=" . $keu_laporan_keuangan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_laporan_keuangan;
		if ($keu_laporan_keuangan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_laporan_keuangan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_laporan_keuangan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_laporan_keuangan_search() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_laporan_keuangan)
		if (!isset($GLOBALS["keu_laporan_keuangan"])) {
			$GLOBALS["keu_laporan_keuangan"] = new ckeu_laporan_keuangan();
			$GLOBALS["Table"] =& $GLOBALS["keu_laporan_keuangan"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_laporan_keuangan', TRUE);

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
		global $keu_laporan_keuangan;

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
		if (!$Security->CanSearch()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("keu_laporan_keuanganlist.php");
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $keu_laporan_keuangan;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$keu_laporan_keuangan->CurrentAction = $objForm->GetValue("a_search");
			switch ($keu_laporan_keuangan->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setFailureMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $keu_laporan_keuangan->UrlParm($sSrchStr);
						$this->Page_Terminate("keu_laporan_keuanganlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$keu_laporan_keuangan->RowType = EW_ROWTYPE_SEARCH;
		$keu_laporan_keuangan->ResetAttrs();
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $keu_laporan_keuangan;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->identitas); // identitas
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->A_nama_lengkap); // A_nama_lengkap
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->nama_biaya); // nama_biaya
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->nilai_tanggungan_bruto); // nilai_tanggungan_bruto
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->tanggal_rencana_bayar); // tanggal_rencana_bayar
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->diskon_sosial); // diskon_sosial
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->diskon_waktu); // diskon_waktu
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->diskon_prestasi); // diskon_prestasi
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->diskon_internal); // diskon_internal
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->diskon_lain_lain); // diskon_lain_lain
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->nilai_tanggungan_netto); // nilai_tanggungan_netto
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->jum_cicilan); // jum_cicilan
	$this->BuildSearchUrl($sSrchUrl, $keu_laporan_keuangan->kekurangan_pembayaran); // kekurangan_pembayaran
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $keu_laporan_keuangan;

		// Load search values
		// identitas

		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_identitas"));
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator = $objForm->GetValue("z_identitas");
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchCondition = $objForm->GetValue("v_identitas");
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_identitas"));
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_identitas");

		// A_nama_lengkap
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_nama_lengkap"));
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_nama_lengkap");
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_nama_lengkap");
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_nama_lengkap"));
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_nama_lengkap");

		// nama_biaya
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_nama_biaya"));
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator = $objForm->GetValue("z_nama_biaya");
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchCondition = $objForm->GetValue("v_nama_biaya");
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_nama_biaya"));
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_nama_biaya");

		// nilai_tanggungan_bruto
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_nilai_tanggungan_bruto"));
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator = $objForm->GetValue("z_nilai_tanggungan_bruto");
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchCondition = $objForm->GetValue("v_nilai_tanggungan_bruto");
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_nilai_tanggungan_bruto"));
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_nilai_tanggungan_bruto");

		// tanggal_rencana_bayar
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_tanggal_rencana_bayar"));
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tanggal_rencana_bayar");
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchCondition = $objForm->GetValue("v_tanggal_rencana_bayar");
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_tanggal_rencana_bayar"));
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_tanggal_rencana_bayar");

		// diskon_sosial
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_diskon_sosial"));
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator = $objForm->GetValue("z_diskon_sosial");
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchCondition = $objForm->GetValue("v_diskon_sosial");
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_diskon_sosial"));
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_diskon_sosial");

		// diskon_waktu
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_diskon_waktu"));
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator = $objForm->GetValue("z_diskon_waktu");
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchCondition = $objForm->GetValue("v_diskon_waktu");
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_diskon_waktu"));
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_diskon_waktu");

		// diskon_prestasi
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_diskon_prestasi"));
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator = $objForm->GetValue("z_diskon_prestasi");
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchCondition = $objForm->GetValue("v_diskon_prestasi");
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_diskon_prestasi"));
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_diskon_prestasi");

		// diskon_internal
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_diskon_internal"));
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator = $objForm->GetValue("z_diskon_internal");
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchCondition = $objForm->GetValue("v_diskon_internal");
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_diskon_internal"));
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_diskon_internal");

		// diskon_lain_lain
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_diskon_lain_lain"));
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator = $objForm->GetValue("z_diskon_lain_lain");
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchCondition = $objForm->GetValue("v_diskon_lain_lain");
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_diskon_lain_lain"));
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_diskon_lain_lain");

		// nilai_tanggungan_netto
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_nilai_tanggungan_netto"));
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator = $objForm->GetValue("z_nilai_tanggungan_netto");
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchCondition = $objForm->GetValue("v_nilai_tanggungan_netto");
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_nilai_tanggungan_netto"));
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_nilai_tanggungan_netto");

		// jum_cicilan
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_jum_cicilan"));
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_jum_cicilan");
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_jum_cicilan");
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_jum_cicilan"));
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_jum_cicilan");

		// kekurangan_pembayaran
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_kekurangan_pembayaran"));
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kekurangan_pembayaran");
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchCondition = $objForm->GetValue("v_kekurangan_pembayaran");
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_kekurangan_pembayaran"));
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_kekurangan_pembayaran");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_laporan_keuangan;

		// Initialize URLs
		// Call Row_Rendering event

		$keu_laporan_keuangan->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis
		// identitas
		// A_nama_lengkap
		// nama_biaya
		// nilai_tanggungan_bruto
		// tanggal_rencana_bayar
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain_lain
		// nilai_tanggungan_netto
		// jum_cicilan
		// kekurangan_pembayaran

		if ($keu_laporan_keuangan->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_otomatis
			$keu_laporan_keuangan->kode_otomatis->ViewValue = $keu_laporan_keuangan->kode_otomatis->CurrentValue;
			$keu_laporan_keuangan->kode_otomatis->ViewCustomAttributes = "";

			// identitas
			$keu_laporan_keuangan->identitas->ViewValue = $keu_laporan_keuangan->identitas->CurrentValue;
			$keu_laporan_keuangan->identitas->ViewCustomAttributes = "";

			// A_nama_lengkap
			$keu_laporan_keuangan->A_nama_lengkap->ViewValue = $keu_laporan_keuangan->A_nama_lengkap->CurrentValue;
			$keu_laporan_keuangan->A_nama_lengkap->ViewCustomAttributes = "";

			// nama_biaya
			$keu_laporan_keuangan->nama_biaya->ViewValue = $keu_laporan_keuangan->nama_biaya->CurrentValue;
			$keu_laporan_keuangan->nama_biaya->ViewCustomAttributes = "";

			// nilai_tanggungan_bruto
			$keu_laporan_keuangan->nilai_tanggungan_bruto->ViewValue = $keu_laporan_keuangan->nilai_tanggungan_bruto->CurrentValue;
			$keu_laporan_keuangan->nilai_tanggungan_bruto->ViewCustomAttributes = "";

			// tanggal_rencana_bayar
			$keu_laporan_keuangan->tanggal_rencana_bayar->ViewValue = $keu_laporan_keuangan->tanggal_rencana_bayar->CurrentValue;
			$keu_laporan_keuangan->tanggal_rencana_bayar->ViewValue = ew_FormatDateTime($keu_laporan_keuangan->tanggal_rencana_bayar->ViewValue, 7);
			$keu_laporan_keuangan->tanggal_rencana_bayar->ViewCustomAttributes = "";

			// diskon_sosial
			$keu_laporan_keuangan->diskon_sosial->ViewValue = $keu_laporan_keuangan->diskon_sosial->CurrentValue;
			$keu_laporan_keuangan->diskon_sosial->ViewCustomAttributes = "";

			// diskon_waktu
			$keu_laporan_keuangan->diskon_waktu->ViewValue = $keu_laporan_keuangan->diskon_waktu->CurrentValue;
			$keu_laporan_keuangan->diskon_waktu->ViewCustomAttributes = "";

			// diskon_prestasi
			$keu_laporan_keuangan->diskon_prestasi->ViewValue = $keu_laporan_keuangan->diskon_prestasi->CurrentValue;
			$keu_laporan_keuangan->diskon_prestasi->ViewCustomAttributes = "";

			// diskon_internal
			$keu_laporan_keuangan->diskon_internal->ViewValue = $keu_laporan_keuangan->diskon_internal->CurrentValue;
			$keu_laporan_keuangan->diskon_internal->ViewCustomAttributes = "";

			// diskon_lain_lain
			$keu_laporan_keuangan->diskon_lain_lain->ViewValue = $keu_laporan_keuangan->diskon_lain_lain->CurrentValue;
			$keu_laporan_keuangan->diskon_lain_lain->ViewCustomAttributes = "";

			// nilai_tanggungan_netto
			$keu_laporan_keuangan->nilai_tanggungan_netto->ViewValue = $keu_laporan_keuangan->nilai_tanggungan_netto->CurrentValue;
			$keu_laporan_keuangan->nilai_tanggungan_netto->ViewCustomAttributes = "";

			// jum_cicilan
			$keu_laporan_keuangan->jum_cicilan->ViewValue = $keu_laporan_keuangan->jum_cicilan->CurrentValue;
			$keu_laporan_keuangan->jum_cicilan->ViewCustomAttributes = "";

			// kekurangan_pembayaran
			$keu_laporan_keuangan->kekurangan_pembayaran->ViewValue = $keu_laporan_keuangan->kekurangan_pembayaran->CurrentValue;
			$keu_laporan_keuangan->kekurangan_pembayaran->ViewCustomAttributes = "";

			// identitas
			$keu_laporan_keuangan->identitas->LinkCustomAttributes = "";
			$keu_laporan_keuangan->identitas->HrefValue = "";
			$keu_laporan_keuangan->identitas->TooltipValue = "";

			// A_nama_lengkap
			$keu_laporan_keuangan->A_nama_lengkap->LinkCustomAttributes = "";
			$keu_laporan_keuangan->A_nama_lengkap->HrefValue = "";
			$keu_laporan_keuangan->A_nama_lengkap->TooltipValue = "";

			// nama_biaya
			$keu_laporan_keuangan->nama_biaya->LinkCustomAttributes = "";
			$keu_laporan_keuangan->nama_biaya->HrefValue = "";
			$keu_laporan_keuangan->nama_biaya->TooltipValue = "";

			// nilai_tanggungan_bruto
			$keu_laporan_keuangan->nilai_tanggungan_bruto->LinkCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_bruto->HrefValue = "";
			$keu_laporan_keuangan->nilai_tanggungan_bruto->TooltipValue = "";

			// tanggal_rencana_bayar
			$keu_laporan_keuangan->tanggal_rencana_bayar->LinkCustomAttributes = "";
			$keu_laporan_keuangan->tanggal_rencana_bayar->HrefValue = "";
			$keu_laporan_keuangan->tanggal_rencana_bayar->TooltipValue = "";

			// diskon_sosial
			$keu_laporan_keuangan->diskon_sosial->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_sosial->HrefValue = "";
			$keu_laporan_keuangan->diskon_sosial->TooltipValue = "";

			// diskon_waktu
			$keu_laporan_keuangan->diskon_waktu->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_waktu->HrefValue = "";
			$keu_laporan_keuangan->diskon_waktu->TooltipValue = "";

			// diskon_prestasi
			$keu_laporan_keuangan->diskon_prestasi->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_prestasi->HrefValue = "";
			$keu_laporan_keuangan->diskon_prestasi->TooltipValue = "";

			// diskon_internal
			$keu_laporan_keuangan->diskon_internal->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_internal->HrefValue = "";
			$keu_laporan_keuangan->diskon_internal->TooltipValue = "";

			// diskon_lain_lain
			$keu_laporan_keuangan->diskon_lain_lain->LinkCustomAttributes = "";
			$keu_laporan_keuangan->diskon_lain_lain->HrefValue = "";
			$keu_laporan_keuangan->diskon_lain_lain->TooltipValue = "";

			// nilai_tanggungan_netto
			$keu_laporan_keuangan->nilai_tanggungan_netto->LinkCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_netto->HrefValue = "";
			$keu_laporan_keuangan->nilai_tanggungan_netto->TooltipValue = "";

			// jum_cicilan
			$keu_laporan_keuangan->jum_cicilan->LinkCustomAttributes = "";
			$keu_laporan_keuangan->jum_cicilan->HrefValue = "";
			$keu_laporan_keuangan->jum_cicilan->TooltipValue = "";

			// kekurangan_pembayaran
			$keu_laporan_keuangan->kekurangan_pembayaran->LinkCustomAttributes = "";
			$keu_laporan_keuangan->kekurangan_pembayaran->HrefValue = "";
			$keu_laporan_keuangan->kekurangan_pembayaran->TooltipValue = "";
		} elseif ($keu_laporan_keuangan->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// identitas
			$keu_laporan_keuangan->identitas->EditCustomAttributes = "";
			$keu_laporan_keuangan->identitas->EditValue = ew_HtmlEncode($keu_laporan_keuangan->identitas->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->identitas->EditCustomAttributes = "";
			$keu_laporan_keuangan->identitas->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->identitas->AdvancedSearch->SearchValue2);

			// A_nama_lengkap
			$keu_laporan_keuangan->A_nama_lengkap->EditCustomAttributes = "";
			$keu_laporan_keuangan->A_nama_lengkap->EditValue = ew_HtmlEncode($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->A_nama_lengkap->EditCustomAttributes = "";
			$keu_laporan_keuangan->A_nama_lengkap->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchValue2);

			// nama_biaya
			$keu_laporan_keuangan->nama_biaya->EditCustomAttributes = "";
			$keu_laporan_keuangan->nama_biaya->EditValue = ew_HtmlEncode($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->nama_biaya->EditCustomAttributes = "";
			$keu_laporan_keuangan->nama_biaya->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchValue2);

			// nilai_tanggungan_bruto
			$keu_laporan_keuangan->nilai_tanggungan_bruto->EditCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_bruto->EditValue = ew_HtmlEncode($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->nilai_tanggungan_bruto->EditCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_bruto->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue2);

			// tanggal_rencana_bayar
			$keu_laporan_keuangan->tanggal_rencana_bayar->EditCustomAttributes = "";
			$keu_laporan_keuangan->tanggal_rencana_bayar->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue, 7), 7));
			$keu_laporan_keuangan->tanggal_rencana_bayar->EditCustomAttributes = "";
			$keu_laporan_keuangan->tanggal_rencana_bayar->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue2, 7), 7));

			// diskon_sosial
			$keu_laporan_keuangan->diskon_sosial->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_sosial->EditValue = ew_HtmlEncode($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->diskon_sosial->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_sosial->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue2);

			// diskon_waktu
			$keu_laporan_keuangan->diskon_waktu->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_waktu->EditValue = ew_HtmlEncode($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->diskon_waktu->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_waktu->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue2);

			// diskon_prestasi
			$keu_laporan_keuangan->diskon_prestasi->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_prestasi->EditValue = ew_HtmlEncode($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->diskon_prestasi->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_prestasi->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue2);

			// diskon_internal
			$keu_laporan_keuangan->diskon_internal->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_internal->EditValue = ew_HtmlEncode($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->diskon_internal->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_internal->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue2);

			// diskon_lain_lain
			$keu_laporan_keuangan->diskon_lain_lain->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_lain_lain->EditValue = ew_HtmlEncode($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->diskon_lain_lain->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_lain_lain->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue2);

			// nilai_tanggungan_netto
			$keu_laporan_keuangan->nilai_tanggungan_netto->EditCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_netto->EditValue = ew_HtmlEncode($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->nilai_tanggungan_netto->EditCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_netto->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue2);

			// jum_cicilan
			$keu_laporan_keuangan->jum_cicilan->EditCustomAttributes = "";
			$keu_laporan_keuangan->jum_cicilan->EditValue = ew_HtmlEncode($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->jum_cicilan->EditCustomAttributes = "";
			$keu_laporan_keuangan->jum_cicilan->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue2);

			// kekurangan_pembayaran
			$keu_laporan_keuangan->kekurangan_pembayaran->EditCustomAttributes = "";
			$keu_laporan_keuangan->kekurangan_pembayaran->EditValue = ew_HtmlEncode($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue);
			$keu_laporan_keuangan->kekurangan_pembayaran->EditCustomAttributes = "";
			$keu_laporan_keuangan->kekurangan_pembayaran->EditValue2 = ew_HtmlEncode($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue2);
		}
		if ($keu_laporan_keuangan->RowType == EW_ROWTYPE_ADD ||
			$keu_laporan_keuangan->RowType == EW_ROWTYPE_EDIT ||
			$keu_laporan_keuangan->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$keu_laporan_keuangan->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($keu_laporan_keuangan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_laporan_keuangan->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $keu_laporan_keuangan;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckNumber($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->nilai_tanggungan_bruto->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->nilai_tanggungan_bruto->FldErrMsg());
		}
		if (!ew_CheckEuroDate($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->tanggal_rencana_bayar->FldErrMsg());
		}
		if (!ew_CheckEuroDate($keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->tanggal_rencana_bayar->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->diskon_sosial->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->diskon_sosial->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->diskon_waktu->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->diskon_waktu->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->diskon_prestasi->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->diskon_prestasi->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->diskon_internal->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->diskon_internal->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->diskon_lain_lain->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->diskon_lain_lain->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->nilai_tanggungan_netto->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->nilai_tanggungan_netto->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->jum_cicilan->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->jum_cicilan->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->kekurangan_pembayaran->FldErrMsg());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $keu_laporan_keuangan->kekurangan_pembayaran->FldErrMsg());
		}

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

	// Load advanced search
	function LoadAdvancedSearch() {
		global $keu_laporan_keuangan;
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_identitas");
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_identitas");
		$keu_laporan_keuangan->identitas->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_identitas");
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_A_nama_lengkap");
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_A_nama_lengkap");
		$keu_laporan_keuangan->A_nama_lengkap->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_A_nama_lengkap");
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_nama_biaya");
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_nama_biaya");
		$keu_laporan_keuangan->nama_biaya->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_nama_biaya");
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_nilai_tanggungan_bruto");
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_nilai_tanggungan_bruto");
		$keu_laporan_keuangan->nilai_tanggungan_bruto->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_nilai_tanggungan_bruto");
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_tanggal_rencana_bayar");
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_tanggal_rencana_bayar");
		$keu_laporan_keuangan->tanggal_rencana_bayar->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_tanggal_rencana_bayar");
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_diskon_sosial");
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_diskon_sosial");
		$keu_laporan_keuangan->diskon_sosial->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_diskon_sosial");
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_diskon_waktu");
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_diskon_waktu");
		$keu_laporan_keuangan->diskon_waktu->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_diskon_waktu");
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_diskon_prestasi");
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_diskon_prestasi");
		$keu_laporan_keuangan->diskon_prestasi->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_diskon_prestasi");
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_diskon_internal");
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_diskon_internal");
		$keu_laporan_keuangan->diskon_internal->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_diskon_internal");
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_diskon_lain_lain");
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_diskon_lain_lain");
		$keu_laporan_keuangan->diskon_lain_lain->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_diskon_lain_lain");
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_nilai_tanggungan_netto");
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_nilai_tanggungan_netto");
		$keu_laporan_keuangan->nilai_tanggungan_netto->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_nilai_tanggungan_netto");
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_jum_cicilan");
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_jum_cicilan");
		$keu_laporan_keuangan->jum_cicilan->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_jum_cicilan");
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue = $keu_laporan_keuangan->getAdvancedSearch("x_kekurangan_pembayaran");
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchOperator = $keu_laporan_keuangan->getAdvancedSearch("z_kekurangan_pembayaran");
		$keu_laporan_keuangan->kekurangan_pembayaran->AdvancedSearch->SearchValue2 = $keu_laporan_keuangan->getAdvancedSearch("y_kekurangan_pembayaran");
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

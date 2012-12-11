<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "master_siswainfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$master_siswa_search = new cmaster_siswa_search();
$Page =& $master_siswa_search;

// Page init
$master_siswa_search->Page_Init();

// Page main
$master_siswa_search->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var master_siswa_search = new ew_Page("master_siswa_search");

// page properties
master_siswa_search.PageID = "search"; // page ID
master_siswa_search.FormID = "fmaster_siswasearch"; // form ID
var EW_PAGE_ID = master_siswa_search.PageID; // for backward compatibility

// extend page with validate function for search
master_siswa_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_no_absen"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->no_absen->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_tanggal_lahir"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->A_tanggal_lahir->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_anak_keberapa"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->A_anak_keberapa->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_jumlah_saudara_kandung"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->A_jumlah_saudara_kandung->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_jumlah_saudara_tiri"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->A_jumlah_saudara_tiri->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_A_jumlah_saudara_angkat"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->A_jumlah_saudara_angkat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_B_jarak"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->B_jarak->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_C_tinggi"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->C_tinggi->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_C_berat"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->C_berat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_tanggal_sttb"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_tanggal_sttb->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_tanggal_danum"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_tanggal_danum->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_lama_belajar"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_lama_belajar->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_tanggal"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_tanggal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_nilai_danum_sd"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_nilai_danum_sd->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_jumlah_pelajaran_danum"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_jumlah_pelajaran_danum->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_nilai_ujian_psb"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_nilai_ujian_psb->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_spp"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_spp->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_D_spp_potongan"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->D_spp_potongan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_E_tanggal_lahir"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->E_tanggal_lahir->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_E_pengeluaran"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->E_pengeluaran->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_F_tanggal_lahir"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->F_tanggal_lahir->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_F_pengeluaran"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->F_pengeluaran->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_G_tanggal_lahir"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->G_tanggal_lahir->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_G_pengeluaran"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->G_pengeluaran->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_I_tanggal_meninggalkan"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->I_tanggal_meninggalkan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_I_tanggal_lulus"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->I_tanggal_lulus->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_I_nilai_danum_smp"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->I_nilai_danum_smp->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_J_tanggal_bekerja"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->J_tanggal_bekerja->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_J_penghasilan"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($master_siswa->J_penghasilan->FldErrMsg()) ?>");

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
master_siswa_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
master_siswa_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
master_siswa_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
master_siswa_search.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $master_siswa->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $master_siswa->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></p>
<?php $master_siswa_search->ShowPageHeader(); ?>
<?php
$master_siswa_search->ShowMessage();
?>
<form name="fmaster_siswasearch" id="fmaster_siswasearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return master_siswa_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="master_siswa">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" cellpadding="0"><tr><td>
<div id="master_siswa_search" class="yui-navset">
	<ul class="yui-nav">
		<li class="selected"><a href="#tab_master_siswa_1"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(1) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_2"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(2) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_3"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(3) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_4"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(4) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_5"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(5) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_6"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(6) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_7"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(7) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_8"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(8) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_9"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(9) ?></span></em></a></li>
		<li><a href="#tab_master_siswa_10"><em><span class="phpmaker"><?php echo $master_siswa->PageCaption(10) ?></span></em></a></li>
	</ul>            
	<div class="yui-content">
		<div id="tab_master_siswa_1">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_no_absen"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->no_absen->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_no_absen" id="z_no_absen" onchange="ew_SrchOprChanged('z_no_absen')"><option value="="<?php echo ($master_siswa->no_absen->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->no_absen->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->no_absen->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->no_absen->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->no_absen->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->no_absen->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->no_absen->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->no_absen->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_no_absen" id="x_no_absen" size="30" value="<?php echo $master_siswa->no_absen->EditValue ?>"<?php echo $master_siswa->no_absen->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_no_absen" name="btw1_no_absen">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_no_absen" name="btw1_no_absen">
<input type="text" name="y_no_absen" id="y_no_absen" size="30" value="<?php echo $master_siswa->no_absen->EditValue2 ?>"<?php echo $master_siswa->no_absen->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_nis_nasional"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_nis_nasional->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_nis_nasional" id="z_A_nis_nasional" onchange="ew_SrchOprChanged('z_A_nis_nasional')"><option value="="<?php echo ($master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_nis_nasional->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_nis_nasional" id="x_A_nis_nasional" size="30" maxlength="20" value="<?php echo $master_siswa->A_nis_nasional->EditValue ?>"<?php echo $master_siswa->A_nis_nasional->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_nis_nasional" name="btw1_A_nis_nasional">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_nis_nasional" name="btw1_A_nis_nasional">
<input type="text" name="y_A_nis_nasional" id="y_A_nis_nasional" size="30" maxlength="20" value="<?php echo $master_siswa->A_nis_nasional->EditValue2 ?>"<?php echo $master_siswa->A_nis_nasional->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_nama_Lengkap"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_nama_Lengkap->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_nama_Lengkap" id="z_A_nama_Lengkap" onchange="ew_SrchOprChanged('z_A_nama_Lengkap')"><option value="="<?php echo ($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_nama_Lengkap->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_nama_Lengkap" id="x_A_nama_Lengkap" size="30" maxlength="50" value="<?php echo $master_siswa->A_nama_Lengkap->EditValue ?>"<?php echo $master_siswa->A_nama_Lengkap->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_nama_Lengkap" name="btw1_A_nama_Lengkap">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_nama_Lengkap" name="btw1_A_nama_Lengkap">
<input type="text" name="y_A_nama_Lengkap" id="y_A_nama_Lengkap" size="30" maxlength="50" value="<?php echo $master_siswa->A_nama_Lengkap->EditValue2 ?>"<?php echo $master_siswa->A_nama_Lengkap->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_nama_panggilan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_nama_panggilan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_nama_panggilan" id="z_A_nama_panggilan" onchange="ew_SrchOprChanged('z_A_nama_panggilan')"><option value="="<?php echo ($master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_nama_panggilan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_nama_panggilan" id="x_A_nama_panggilan" size="30" maxlength="50" value="<?php echo $master_siswa->A_nama_panggilan->EditValue ?>"<?php echo $master_siswa->A_nama_panggilan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_nama_panggilan" name="btw1_A_nama_panggilan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_nama_panggilan" name="btw1_A_nama_panggilan">
<input type="text" name="y_A_nama_panggilan" id="y_A_nama_panggilan" size="30" maxlength="50" value="<?php echo $master_siswa->A_nama_panggilan->EditValue2 ?>"<?php echo $master_siswa->A_nama_panggilan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_jenis_kelamin"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_jenis_kelamin->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_jenis_kelamin" id="z_A_jenis_kelamin" onchange="ew_SrchOprChanged('z_A_jenis_kelamin')"><option value="="<?php echo ($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_jenis_kelamin->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_jenis_kelamin" id="x_A_jenis_kelamin" size="30" maxlength="1" value="<?php echo $master_siswa->A_jenis_kelamin->EditValue ?>"<?php echo $master_siswa->A_jenis_kelamin->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_jenis_kelamin" name="btw1_A_jenis_kelamin">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_jenis_kelamin" name="btw1_A_jenis_kelamin">
<input type="text" name="y_A_jenis_kelamin" id="y_A_jenis_kelamin" size="30" maxlength="1" value="<?php echo $master_siswa->A_jenis_kelamin->EditValue2 ?>"<?php echo $master_siswa->A_jenis_kelamin->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_tempat_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_tempat_lahir->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_tempat_lahir" id="z_A_tempat_lahir" onchange="ew_SrchOprChanged('z_A_tempat_lahir')"><option value="="<?php echo ($master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_tempat_lahir->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_tempat_lahir" id="x_A_tempat_lahir" size="30" maxlength="20" value="<?php echo $master_siswa->A_tempat_lahir->EditValue ?>"<?php echo $master_siswa->A_tempat_lahir->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_tempat_lahir" name="btw1_A_tempat_lahir">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_tempat_lahir" name="btw1_A_tempat_lahir">
<input type="text" name="y_A_tempat_lahir" id="y_A_tempat_lahir" size="30" maxlength="20" value="<?php echo $master_siswa->A_tempat_lahir->EditValue2 ?>"<?php echo $master_siswa->A_tempat_lahir->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_tanggal_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_tanggal_lahir->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_tanggal_lahir" id="z_A_tanggal_lahir" onchange="ew_SrchOprChanged('z_A_tanggal_lahir')"><option value="="<?php echo ($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_tanggal_lahir->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_tanggal_lahir" id="x_A_tanggal_lahir" value="<?php echo $master_siswa->A_tanggal_lahir->EditValue ?>"<?php echo $master_siswa->A_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_A_tanggal_lahir" name="cal_x_A_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_A_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_A_tanggal_lahir" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_tanggal_lahir" name="btw1_A_tanggal_lahir">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_tanggal_lahir" name="btw1_A_tanggal_lahir">
<input type="text" name="y_A_tanggal_lahir" id="y_A_tanggal_lahir" value="<?php echo $master_siswa->A_tanggal_lahir->EditValue2 ?>"<?php echo $master_siswa->A_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_A_tanggal_lahir" name="cal_y_A_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_A_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_A_tanggal_lahir" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_agama"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_agama->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_agama" id="z_A_agama" onchange="ew_SrchOprChanged('z_A_agama')"><option value="="<?php echo ($master_siswa->A_agama->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_agama->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_agama->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_agama->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_agama->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_agama->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->A_agama->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->A_agama->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->A_agama->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_agama->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_agama->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<select id="x_A_agama" name="x_A_agama"<?php echo $master_siswa->A_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->A_agama->EditValue)) {
	$arwrk = $master_siswa->A_agama->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->A_agama->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_agama" name="btw1_A_agama">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_agama" name="btw1_A_agama">
<select id="y_A_agama" name="y_A_agama"<?php echo $master_siswa->A_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->A_agama->EditValue2)) {
	$arwrk = $master_siswa->A_agama->EditValue2;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->A_agama->AdvancedSearch->SearchValue2) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_kewarganegaraan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_kewarganegaraan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_kewarganegaraan" id="z_A_kewarganegaraan" onchange="ew_SrchOprChanged('z_A_kewarganegaraan')"><option value="="<?php echo ($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_kewarganegaraan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_kewarganegaraan" id="x_A_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->A_kewarganegaraan->EditValue ?>"<?php echo $master_siswa->A_kewarganegaraan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_kewarganegaraan" name="btw1_A_kewarganegaraan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_kewarganegaraan" name="btw1_A_kewarganegaraan">
<input type="text" name="y_A_kewarganegaraan" id="y_A_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->A_kewarganegaraan->EditValue2 ?>"<?php echo $master_siswa->A_kewarganegaraan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_anak_keberapa"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_anak_keberapa->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_anak_keberapa" id="z_A_anak_keberapa" onchange="ew_SrchOprChanged('z_A_anak_keberapa')"><option value="="<?php echo ($master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_anak_keberapa->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_anak_keberapa" id="x_A_anak_keberapa" size="30" value="<?php echo $master_siswa->A_anak_keberapa->EditValue ?>"<?php echo $master_siswa->A_anak_keberapa->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_anak_keberapa" name="btw1_A_anak_keberapa">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_anak_keberapa" name="btw1_A_anak_keberapa">
<input type="text" name="y_A_anak_keberapa" id="y_A_anak_keberapa" size="30" value="<?php echo $master_siswa->A_anak_keberapa->EditValue2 ?>"<?php echo $master_siswa->A_anak_keberapa->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_jumlah_saudara_kandung"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_jumlah_saudara_kandung->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_jumlah_saudara_kandung" id="z_A_jumlah_saudara_kandung" onchange="ew_SrchOprChanged('z_A_jumlah_saudara_kandung')"><option value="="<?php echo ($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_jumlah_saudara_kandung->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_jumlah_saudara_kandung" id="x_A_jumlah_saudara_kandung" size="30" value="<?php echo $master_siswa->A_jumlah_saudara_kandung->EditValue ?>"<?php echo $master_siswa->A_jumlah_saudara_kandung->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_jumlah_saudara_kandung" name="btw1_A_jumlah_saudara_kandung">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_jumlah_saudara_kandung" name="btw1_A_jumlah_saudara_kandung">
<input type="text" name="y_A_jumlah_saudara_kandung" id="y_A_jumlah_saudara_kandung" size="30" value="<?php echo $master_siswa->A_jumlah_saudara_kandung->EditValue2 ?>"<?php echo $master_siswa->A_jumlah_saudara_kandung->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_jumlah_saudara_tiri"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_jumlah_saudara_tiri->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_jumlah_saudara_tiri" id="z_A_jumlah_saudara_tiri" onchange="ew_SrchOprChanged('z_A_jumlah_saudara_tiri')"><option value="="<?php echo ($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_jumlah_saudara_tiri->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_jumlah_saudara_tiri" id="x_A_jumlah_saudara_tiri" size="30" value="<?php echo $master_siswa->A_jumlah_saudara_tiri->EditValue ?>"<?php echo $master_siswa->A_jumlah_saudara_tiri->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_jumlah_saudara_tiri" name="btw1_A_jumlah_saudara_tiri">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_jumlah_saudara_tiri" name="btw1_A_jumlah_saudara_tiri">
<input type="text" name="y_A_jumlah_saudara_tiri" id="y_A_jumlah_saudara_tiri" size="30" value="<?php echo $master_siswa->A_jumlah_saudara_tiri->EditValue2 ?>"<?php echo $master_siswa->A_jumlah_saudara_tiri->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_jumlah_saudara_angkat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_jumlah_saudara_angkat->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_jumlah_saudara_angkat" id="z_A_jumlah_saudara_angkat" onchange="ew_SrchOprChanged('z_A_jumlah_saudara_angkat')"><option value="="<?php echo ($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_jumlah_saudara_angkat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_jumlah_saudara_angkat" id="x_A_jumlah_saudara_angkat" size="30" value="<?php echo $master_siswa->A_jumlah_saudara_angkat->EditValue ?>"<?php echo $master_siswa->A_jumlah_saudara_angkat->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_jumlah_saudara_angkat" name="btw1_A_jumlah_saudara_angkat">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_jumlah_saudara_angkat" name="btw1_A_jumlah_saudara_angkat">
<input type="text" name="y_A_jumlah_saudara_angkat" id="y_A_jumlah_saudara_angkat" size="30" value="<?php echo $master_siswa->A_jumlah_saudara_angkat->EditValue2 ?>"<?php echo $master_siswa->A_jumlah_saudara_angkat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_status_yatim"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_status_yatim->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_status_yatim" id="z_A_status_yatim" onchange="ew_SrchOprChanged('z_A_status_yatim')"><option value="="<?php echo ($master_siswa->A_status_yatim->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_status_yatim->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_status_yatim->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_status_yatim->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_status_yatim->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_status_yatim->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->A_status_yatim->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->A_status_yatim->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->A_status_yatim->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_status_yatim->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_status_yatim->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_status_yatim" id="x_A_status_yatim" size="30" maxlength="15" value="<?php echo $master_siswa->A_status_yatim->EditValue ?>"<?php echo $master_siswa->A_status_yatim->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_status_yatim" name="btw1_A_status_yatim">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_status_yatim" name="btw1_A_status_yatim">
<input type="text" name="y_A_status_yatim" id="y_A_status_yatim" size="30" maxlength="15" value="<?php echo $master_siswa->A_status_yatim->EditValue2 ?>"<?php echo $master_siswa->A_status_yatim->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_A_bahasa"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->A_bahasa->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_A_bahasa" id="z_A_bahasa" onchange="ew_SrchOprChanged('z_A_bahasa')"><option value="="<?php echo ($master_siswa->A_bahasa->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->A_bahasa->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->A_bahasa->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->A_bahasa->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->A_bahasa->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->A_bahasa->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->A_bahasa->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->A_bahasa->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->A_bahasa->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->A_bahasa->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->A_bahasa->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_A_bahasa" id="x_A_bahasa" size="30" maxlength="50" value="<?php echo $master_siswa->A_bahasa->EditValue ?>"<?php echo $master_siswa->A_bahasa->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_A_bahasa" name="btw1_A_bahasa">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_A_bahasa" name="btw1_A_bahasa">
<input type="text" name="y_A_bahasa" id="y_A_bahasa" size="30" maxlength="50" value="<?php echo $master_siswa->A_bahasa->EditValue2 ?>"<?php echo $master_siswa->A_bahasa->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_kode_otomatis"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->kode_otomatis->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_kode_otomatis" id="z_kode_otomatis" onchange="ew_SrchOprChanged('z_kode_otomatis')"><option value="="<?php echo ($master_siswa->kode_otomatis->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->kode_otomatis->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->kode_otomatis->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->kode_otomatis->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->kode_otomatis->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->kode_otomatis->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->kode_otomatis->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->kode_otomatis->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->kode_otomatis->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->kode_otomatis->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->kode_otomatis->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_kode_otomatis" id="x_kode_otomatis" size="30" maxlength="50" value="<?php echo $master_siswa->kode_otomatis->EditValue ?>"<?php echo $master_siswa->kode_otomatis->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_kode_otomatis" name="btw1_kode_otomatis">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_kode_otomatis" name="btw1_kode_otomatis">
<input type="text" name="y_kode_otomatis" id="y_kode_otomatis" size="30" maxlength="50" value="<?php echo $master_siswa->kode_otomatis->EditValue2 ?>"<?php echo $master_siswa->kode_otomatis->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_apakah_valid"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->apakah_valid->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_apakah_valid" id="z_apakah_valid" onchange="ew_SrchOprChanged('z_apakah_valid')"><option value="="<?php echo ($master_siswa->apakah_valid->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->apakah_valid->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->apakah_valid->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->apakah_valid->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->apakah_valid->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->apakah_valid->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->apakah_valid->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->apakah_valid->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->apakah_valid->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->apakah_valid->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->apakah_valid->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<select id="x_apakah_valid" name="x_apakah_valid"<?php echo $master_siswa->apakah_valid->EditAttributes() ?>>
<?php
if (is_array($master_siswa->apakah_valid->EditValue)) {
	$arwrk = $master_siswa->apakah_valid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->apakah_valid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_apakah_valid" name="btw1_apakah_valid">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_apakah_valid" name="btw1_apakah_valid">
<select id="y_apakah_valid" name="y_apakah_valid"<?php echo $master_siswa->apakah_valid->EditAttributes() ?>>
<?php
if (is_array($master_siswa->apakah_valid->EditValue2)) {
	$arwrk = $master_siswa->apakah_valid->EditValue2;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->apakah_valid->AdvancedSearch->SearchValue2) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_2">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_B_alamat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->B_alamat->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_B_alamat" id="z_B_alamat" onchange="ew_SrchOprChanged('z_B_alamat')"><option value="="<?php echo ($master_siswa->B_alamat->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->B_alamat->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->B_alamat->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->B_alamat->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->B_alamat->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->B_alamat->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->B_alamat->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->B_alamat->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->B_alamat->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->B_alamat->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->B_alamat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_B_alamat" id="x_B_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->B_alamat->EditValue ?>"<?php echo $master_siswa->B_alamat->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_B_alamat" name="btw1_B_alamat">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_B_alamat" name="btw1_B_alamat">
<input type="text" name="y_B_alamat" id="y_B_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->B_alamat->EditValue2 ?>"<?php echo $master_siswa->B_alamat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_B_telepon_rumah"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->B_telepon_rumah->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_B_telepon_rumah" id="z_B_telepon_rumah" onchange="ew_SrchOprChanged('z_B_telepon_rumah')"><option value="="<?php echo ($master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->B_telepon_rumah->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_B_telepon_rumah" id="x_B_telepon_rumah" size="30" maxlength="15" value="<?php echo $master_siswa->B_telepon_rumah->EditValue ?>"<?php echo $master_siswa->B_telepon_rumah->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_B_telepon_rumah" name="btw1_B_telepon_rumah">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_B_telepon_rumah" name="btw1_B_telepon_rumah">
<input type="text" name="y_B_telepon_rumah" id="y_B_telepon_rumah" size="30" maxlength="15" value="<?php echo $master_siswa->B_telepon_rumah->EditValue2 ?>"<?php echo $master_siswa->B_telepon_rumah->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_B_tinggal"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->B_tinggal->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_B_tinggal" id="z_B_tinggal" onchange="ew_SrchOprChanged('z_B_tinggal')"><option value="="<?php echo ($master_siswa->B_tinggal->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->B_tinggal->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->B_tinggal->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->B_tinggal->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->B_tinggal->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->B_tinggal->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->B_tinggal->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->B_tinggal->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->B_tinggal->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->B_tinggal->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->B_tinggal->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_B_tinggal" id="x_B_tinggal" size="30" maxlength="20" value="<?php echo $master_siswa->B_tinggal->EditValue ?>"<?php echo $master_siswa->B_tinggal->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_B_tinggal" name="btw1_B_tinggal">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_B_tinggal" name="btw1_B_tinggal">
<input type="text" name="y_B_tinggal" id="y_B_tinggal" size="30" maxlength="20" value="<?php echo $master_siswa->B_tinggal->EditValue2 ?>"<?php echo $master_siswa->B_tinggal->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_B_jarak"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->B_jarak->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_B_jarak" id="z_B_jarak" onchange="ew_SrchOprChanged('z_B_jarak')"><option value="="<?php echo ($master_siswa->B_jarak->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->B_jarak->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->B_jarak->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->B_jarak->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->B_jarak->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->B_jarak->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->B_jarak->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->B_jarak->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_B_jarak" id="x_B_jarak" size="30" value="<?php echo $master_siswa->B_jarak->EditValue ?>"<?php echo $master_siswa->B_jarak->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_B_jarak" name="btw1_B_jarak">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_B_jarak" name="btw1_B_jarak">
<input type="text" name="y_B_jarak" id="y_B_jarak" size="30" value="<?php echo $master_siswa->B_jarak->EditValue2 ?>"<?php echo $master_siswa->B_jarak->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_B_hp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->B_hp->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_B_hp" id="z_B_hp" onchange="ew_SrchOprChanged('z_B_hp')"><option value="="<?php echo ($master_siswa->B_hp->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->B_hp->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->B_hp->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->B_hp->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->B_hp->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->B_hp->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->B_hp->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->B_hp->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->B_hp->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->B_hp->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->B_hp->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_B_hp" id="x_B_hp" size="30" maxlength="20" value="<?php echo $master_siswa->B_hp->EditValue ?>"<?php echo $master_siswa->B_hp->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_B_hp" name="btw1_B_hp">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_B_hp" name="btw1_B_hp">
<input type="text" name="y_B_hp" id="y_B_hp" size="30" maxlength="20" value="<?php echo $master_siswa->B_hp->EditValue2 ?>"<?php echo $master_siswa->B_hp->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_3">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_C_golongan_darah"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->C_golongan_darah->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_C_golongan_darah" id="z_C_golongan_darah" onchange="ew_SrchOprChanged('z_C_golongan_darah')"><option value="="<?php echo ($master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->C_golongan_darah->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_C_golongan_darah" id="x_C_golongan_darah" size="30" maxlength="2" value="<?php echo $master_siswa->C_golongan_darah->EditValue ?>"<?php echo $master_siswa->C_golongan_darah->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_C_golongan_darah" name="btw1_C_golongan_darah">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_C_golongan_darah" name="btw1_C_golongan_darah">
<input type="text" name="y_C_golongan_darah" id="y_C_golongan_darah" size="30" maxlength="2" value="<?php echo $master_siswa->C_golongan_darah->EditValue2 ?>"<?php echo $master_siswa->C_golongan_darah->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_C_penyakit"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->C_penyakit->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_C_penyakit" id="z_C_penyakit" onchange="ew_SrchOprChanged('z_C_penyakit')"><option value="="<?php echo ($master_siswa->C_penyakit->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->C_penyakit->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->C_penyakit->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->C_penyakit->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->C_penyakit->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->C_penyakit->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->C_penyakit->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->C_penyakit->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->C_penyakit->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->C_penyakit->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->C_penyakit->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_C_penyakit" id="x_C_penyakit" size="30" maxlength="100" value="<?php echo $master_siswa->C_penyakit->EditValue ?>"<?php echo $master_siswa->C_penyakit->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_C_penyakit" name="btw1_C_penyakit">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_C_penyakit" name="btw1_C_penyakit">
<input type="text" name="y_C_penyakit" id="y_C_penyakit" size="30" maxlength="100" value="<?php echo $master_siswa->C_penyakit->EditValue2 ?>"<?php echo $master_siswa->C_penyakit->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_C_jasmani"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->C_jasmani->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_C_jasmani" id="z_C_jasmani" onchange="ew_SrchOprChanged('z_C_jasmani')"><option value="="<?php echo ($master_siswa->C_jasmani->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->C_jasmani->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->C_jasmani->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->C_jasmani->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->C_jasmani->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->C_jasmani->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->C_jasmani->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->C_jasmani->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->C_jasmani->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->C_jasmani->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->C_jasmani->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_C_jasmani" id="x_C_jasmani" size="30" maxlength="100" value="<?php echo $master_siswa->C_jasmani->EditValue ?>"<?php echo $master_siswa->C_jasmani->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_C_jasmani" name="btw1_C_jasmani">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_C_jasmani" name="btw1_C_jasmani">
<input type="text" name="y_C_jasmani" id="y_C_jasmani" size="30" maxlength="100" value="<?php echo $master_siswa->C_jasmani->EditValue2 ?>"<?php echo $master_siswa->C_jasmani->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_C_tinggi"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->C_tinggi->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_C_tinggi" id="z_C_tinggi" onchange="ew_SrchOprChanged('z_C_tinggi')"><option value="="<?php echo ($master_siswa->C_tinggi->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->C_tinggi->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->C_tinggi->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->C_tinggi->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->C_tinggi->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->C_tinggi->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->C_tinggi->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->C_tinggi->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_C_tinggi" id="x_C_tinggi" size="30" value="<?php echo $master_siswa->C_tinggi->EditValue ?>"<?php echo $master_siswa->C_tinggi->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_C_tinggi" name="btw1_C_tinggi">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_C_tinggi" name="btw1_C_tinggi">
<input type="text" name="y_C_tinggi" id="y_C_tinggi" size="30" value="<?php echo $master_siswa->C_tinggi->EditValue2 ?>"<?php echo $master_siswa->C_tinggi->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_C_berat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->C_berat->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_C_berat" id="z_C_berat" onchange="ew_SrchOprChanged('z_C_berat')"><option value="="<?php echo ($master_siswa->C_berat->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->C_berat->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->C_berat->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->C_berat->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->C_berat->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->C_berat->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->C_berat->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->C_berat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_C_berat" id="x_C_berat" size="30" value="<?php echo $master_siswa->C_berat->EditValue ?>"<?php echo $master_siswa->C_berat->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_C_berat" name="btw1_C_berat">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_C_berat" name="btw1_C_berat">
<input type="text" name="y_C_berat" id="y_C_berat" size="30" value="<?php echo $master_siswa->C_berat->EditValue2 ?>"<?php echo $master_siswa->C_berat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_4">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_D_tamatan_dari"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_tamatan_dari->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_tamatan_dari" id="z_D_tamatan_dari" onchange="ew_SrchOprChanged('z_D_tamatan_dari')"><option value="="<?php echo ($master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_tamatan_dari->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_tamatan_dari" id="x_D_tamatan_dari" size="30" maxlength="30" value="<?php echo $master_siswa->D_tamatan_dari->EditValue ?>"<?php echo $master_siswa->D_tamatan_dari->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_tamatan_dari" name="btw1_D_tamatan_dari">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_tamatan_dari" name="btw1_D_tamatan_dari">
<input type="text" name="y_D_tamatan_dari" id="y_D_tamatan_dari" size="30" maxlength="30" value="<?php echo $master_siswa->D_tamatan_dari->EditValue2 ?>"<?php echo $master_siswa->D_tamatan_dari->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_sttb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_sttb->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_sttb" id="z_D_sttb" onchange="ew_SrchOprChanged('z_D_sttb')"><option value="="<?php echo ($master_siswa->D_sttb->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_sttb->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_sttb->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_sttb->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_sttb->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_sttb->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_sttb->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_sttb->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_sttb->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_sttb->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_sttb->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_sttb" id="x_D_sttb" size="30" maxlength="30" value="<?php echo $master_siswa->D_sttb->EditValue ?>"<?php echo $master_siswa->D_sttb->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_sttb" name="btw1_D_sttb">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_sttb" name="btw1_D_sttb">
<input type="text" name="y_D_sttb" id="y_D_sttb" size="30" maxlength="30" value="<?php echo $master_siswa->D_sttb->EditValue2 ?>"<?php echo $master_siswa->D_sttb->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_tanggal_sttb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_tanggal_sttb->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_tanggal_sttb" id="z_D_tanggal_sttb" onchange="ew_SrchOprChanged('z_D_tanggal_sttb')"><option value="="<?php echo ($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_tanggal_sttb->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_tanggal_sttb" id="x_D_tanggal_sttb" value="<?php echo $master_siswa->D_tanggal_sttb->EditValue ?>"<?php echo $master_siswa->D_tanggal_sttb->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_D_tanggal_sttb" name="cal_x_D_tanggal_sttb" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_D_tanggal_sttb", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_D_tanggal_sttb" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_tanggal_sttb" name="btw1_D_tanggal_sttb">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_tanggal_sttb" name="btw1_D_tanggal_sttb">
<input type="text" name="y_D_tanggal_sttb" id="y_D_tanggal_sttb" value="<?php echo $master_siswa->D_tanggal_sttb->EditValue2 ?>"<?php echo $master_siswa->D_tanggal_sttb->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_D_tanggal_sttb" name="cal_y_D_tanggal_sttb" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_D_tanggal_sttb", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_D_tanggal_sttb" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_danum"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_danum->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_danum" id="z_D_danum" onchange="ew_SrchOprChanged('z_D_danum')"><option value="="<?php echo ($master_siswa->D_danum->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_danum->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_danum->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_danum->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_danum->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_danum->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_danum->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_danum->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_danum->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_danum->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_danum->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_danum" id="x_D_danum" size="30" maxlength="30" value="<?php echo $master_siswa->D_danum->EditValue ?>"<?php echo $master_siswa->D_danum->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_danum" name="btw1_D_danum">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_danum" name="btw1_D_danum">
<input type="text" name="y_D_danum" id="y_D_danum" size="30" maxlength="30" value="<?php echo $master_siswa->D_danum->EditValue2 ?>"<?php echo $master_siswa->D_danum->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_tanggal_danum"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_tanggal_danum->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_tanggal_danum" id="z_D_tanggal_danum" onchange="ew_SrchOprChanged('z_D_tanggal_danum')"><option value="="<?php echo ($master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_tanggal_danum->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_tanggal_danum" id="x_D_tanggal_danum" value="<?php echo $master_siswa->D_tanggal_danum->EditValue ?>"<?php echo $master_siswa->D_tanggal_danum->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_D_tanggal_danum" name="cal_x_D_tanggal_danum" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_D_tanggal_danum", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_D_tanggal_danum" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_tanggal_danum" name="btw1_D_tanggal_danum">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_tanggal_danum" name="btw1_D_tanggal_danum">
<input type="text" name="y_D_tanggal_danum" id="y_D_tanggal_danum" value="<?php echo $master_siswa->D_tanggal_danum->EditValue2 ?>"<?php echo $master_siswa->D_tanggal_danum->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_D_tanggal_danum" name="cal_y_D_tanggal_danum" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_D_tanggal_danum", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_D_tanggal_danum" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_lama_belajar"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_lama_belajar->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_lama_belajar" id="z_D_lama_belajar" onchange="ew_SrchOprChanged('z_D_lama_belajar')"><option value="="<?php echo ($master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_lama_belajar->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_lama_belajar" id="x_D_lama_belajar" size="30" value="<?php echo $master_siswa->D_lama_belajar->EditValue ?>"<?php echo $master_siswa->D_lama_belajar->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_lama_belajar" name="btw1_D_lama_belajar">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_lama_belajar" name="btw1_D_lama_belajar">
<input type="text" name="y_D_lama_belajar" id="y_D_lama_belajar" size="30" value="<?php echo $master_siswa->D_lama_belajar->EditValue2 ?>"<?php echo $master_siswa->D_lama_belajar->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_dari_sekolah"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_dari_sekolah->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_dari_sekolah" id="z_D_dari_sekolah" onchange="ew_SrchOprChanged('z_D_dari_sekolah')"><option value="="<?php echo ($master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_dari_sekolah->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_dari_sekolah" id="x_D_dari_sekolah" size="30" maxlength="30" value="<?php echo $master_siswa->D_dari_sekolah->EditValue ?>"<?php echo $master_siswa->D_dari_sekolah->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_dari_sekolah" name="btw1_D_dari_sekolah">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_dari_sekolah" name="btw1_D_dari_sekolah">
<input type="text" name="y_D_dari_sekolah" id="y_D_dari_sekolah" size="30" maxlength="30" value="<?php echo $master_siswa->D_dari_sekolah->EditValue2 ?>"<?php echo $master_siswa->D_dari_sekolah->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_alasan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_alasan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_alasan" id="z_D_alasan" onchange="ew_SrchOprChanged('z_D_alasan')"><option value="="<?php echo ($master_siswa->D_alasan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_alasan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_alasan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_alasan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_alasan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_alasan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_alasan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_alasan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_alasan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_alasan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_alasan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_alasan" id="x_D_alasan" size="30" maxlength="50" value="<?php echo $master_siswa->D_alasan->EditValue ?>"<?php echo $master_siswa->D_alasan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_alasan" name="btw1_D_alasan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_alasan" name="btw1_D_alasan">
<input type="text" name="y_D_alasan" id="y_D_alasan" size="30" maxlength="50" value="<?php echo $master_siswa->D_alasan->EditValue2 ?>"<?php echo $master_siswa->D_alasan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_kelas"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_kelas->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_kelas" id="z_D_kelas" onchange="ew_SrchOprChanged('z_D_kelas')"><option value="="<?php echo ($master_siswa->D_kelas->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_kelas->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_kelas->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_kelas->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_kelas->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_kelas->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_kelas->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_kelas->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_kelas->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_kelas->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_kelas->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_kelas" id="x_D_kelas" size="30" maxlength="10" value="<?php echo $master_siswa->D_kelas->EditValue ?>"<?php echo $master_siswa->D_kelas->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_kelas" name="btw1_D_kelas">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_kelas" name="btw1_D_kelas">
<input type="text" name="y_D_kelas" id="y_D_kelas" size="30" maxlength="10" value="<?php echo $master_siswa->D_kelas->EditValue2 ?>"<?php echo $master_siswa->D_kelas->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_kelompok"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_kelompok->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_kelompok" id="z_D_kelompok" onchange="ew_SrchOprChanged('z_D_kelompok')"><option value="="<?php echo ($master_siswa->D_kelompok->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_kelompok->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_kelompok->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_kelompok->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_kelompok->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_kelompok->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_kelompok->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_kelompok->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_kelompok->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_kelompok->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_kelompok->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_kelompok" id="x_D_kelompok" size="30" maxlength="20" value="<?php echo $master_siswa->D_kelompok->EditValue ?>"<?php echo $master_siswa->D_kelompok->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_kelompok" name="btw1_D_kelompok">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_kelompok" name="btw1_D_kelompok">
<input type="text" name="y_D_kelompok" id="y_D_kelompok" size="30" maxlength="20" value="<?php echo $master_siswa->D_kelompok->EditValue2 ?>"<?php echo $master_siswa->D_kelompok->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_tanggal"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_tanggal->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_tanggal" id="z_D_tanggal" onchange="ew_SrchOprChanged('z_D_tanggal')"><option value="="<?php echo ($master_siswa->D_tanggal->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_tanggal->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_tanggal->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_tanggal->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_tanggal->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_tanggal->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_tanggal->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_tanggal->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_tanggal" id="x_D_tanggal" value="<?php echo $master_siswa->D_tanggal->EditValue ?>"<?php echo $master_siswa->D_tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_D_tanggal" name="cal_x_D_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_D_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_D_tanggal" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_tanggal" name="btw1_D_tanggal">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_tanggal" name="btw1_D_tanggal">
<input type="text" name="y_D_tanggal" id="y_D_tanggal" value="<?php echo $master_siswa->D_tanggal->EditValue2 ?>"<?php echo $master_siswa->D_tanggal->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_D_tanggal" name="cal_y_D_tanggal" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_D_tanggal", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_D_tanggal" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_saat_ini_tingkat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_saat_ini_tingkat->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_saat_ini_tingkat" id="z_D_saat_ini_tingkat" onchange="ew_SrchOprChanged('z_D_saat_ini_tingkat')"><option value="="<?php echo ($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_saat_ini_tingkat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_saat_ini_tingkat" id="x_D_saat_ini_tingkat" size="30" maxlength="50" value="<?php echo $master_siswa->D_saat_ini_tingkat->EditValue ?>"<?php echo $master_siswa->D_saat_ini_tingkat->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_saat_ini_tingkat" name="btw1_D_saat_ini_tingkat">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_saat_ini_tingkat" name="btw1_D_saat_ini_tingkat">
<input type="text" name="y_D_saat_ini_tingkat" id="y_D_saat_ini_tingkat" size="30" maxlength="50" value="<?php echo $master_siswa->D_saat_ini_tingkat->EditValue2 ?>"<?php echo $master_siswa->D_saat_ini_tingkat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_saat_ini_kelas"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_saat_ini_kelas->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_saat_ini_kelas" id="z_D_saat_ini_kelas" onchange="ew_SrchOprChanged('z_D_saat_ini_kelas')"><option value="="<?php echo ($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_saat_ini_kelas->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_saat_ini_kelas" id="x_D_saat_ini_kelas" size="30" maxlength="50" value="<?php echo $master_siswa->D_saat_ini_kelas->EditValue ?>"<?php echo $master_siswa->D_saat_ini_kelas->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_saat_ini_kelas" name="btw1_D_saat_ini_kelas">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_saat_ini_kelas" name="btw1_D_saat_ini_kelas">
<input type="text" name="y_D_saat_ini_kelas" id="y_D_saat_ini_kelas" size="30" maxlength="50" value="<?php echo $master_siswa->D_saat_ini_kelas->EditValue2 ?>"<?php echo $master_siswa->D_saat_ini_kelas->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_saat_ini_kelompok"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_saat_ini_kelompok->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_saat_ini_kelompok" id="z_D_saat_ini_kelompok" onchange="ew_SrchOprChanged('z_D_saat_ini_kelompok')"><option value="="<?php echo ($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_saat_ini_kelompok->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_saat_ini_kelompok" id="x_D_saat_ini_kelompok" size="30" maxlength="50" value="<?php echo $master_siswa->D_saat_ini_kelompok->EditValue ?>"<?php echo $master_siswa->D_saat_ini_kelompok->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_saat_ini_kelompok" name="btw1_D_saat_ini_kelompok">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_saat_ini_kelompok" name="btw1_D_saat_ini_kelompok">
<input type="text" name="y_D_saat_ini_kelompok" id="y_D_saat_ini_kelompok" size="30" maxlength="50" value="<?php echo $master_siswa->D_saat_ini_kelompok->EditValue2 ?>"<?php echo $master_siswa->D_saat_ini_kelompok->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_no_psb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_no_psb->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_no_psb" id="z_D_no_psb" onchange="ew_SrchOprChanged('z_D_no_psb')"><option value="="<?php echo ($master_siswa->D_no_psb->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_no_psb->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_no_psb->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_no_psb->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_no_psb->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_no_psb->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_no_psb->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_no_psb->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_no_psb->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_no_psb->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_no_psb->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_no_psb" id="x_D_no_psb" size="30" maxlength="20" value="<?php echo $master_siswa->D_no_psb->EditValue ?>"<?php echo $master_siswa->D_no_psb->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_no_psb" name="btw1_D_no_psb">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_no_psb" name="btw1_D_no_psb">
<input type="text" name="y_D_no_psb" id="y_D_no_psb" size="30" maxlength="20" value="<?php echo $master_siswa->D_no_psb->EditValue2 ?>"<?php echo $master_siswa->D_no_psb->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_nilai_danum_sd"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_nilai_danum_sd->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_nilai_danum_sd" id="z_D_nilai_danum_sd" onchange="ew_SrchOprChanged('z_D_nilai_danum_sd')"><option value="="<?php echo ($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_nilai_danum_sd->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_nilai_danum_sd" id="x_D_nilai_danum_sd" size="30" value="<?php echo $master_siswa->D_nilai_danum_sd->EditValue ?>"<?php echo $master_siswa->D_nilai_danum_sd->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_nilai_danum_sd" name="btw1_D_nilai_danum_sd">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_nilai_danum_sd" name="btw1_D_nilai_danum_sd">
<input type="text" name="y_D_nilai_danum_sd" id="y_D_nilai_danum_sd" size="30" value="<?php echo $master_siswa->D_nilai_danum_sd->EditValue2 ?>"<?php echo $master_siswa->D_nilai_danum_sd->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_jumlah_pelajaran_danum"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_jumlah_pelajaran_danum->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_jumlah_pelajaran_danum" id="z_D_jumlah_pelajaran_danum" onchange="ew_SrchOprChanged('z_D_jumlah_pelajaran_danum')"><option value="="<?php echo ($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_jumlah_pelajaran_danum->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_jumlah_pelajaran_danum" id="x_D_jumlah_pelajaran_danum" size="30" value="<?php echo $master_siswa->D_jumlah_pelajaran_danum->EditValue ?>"<?php echo $master_siswa->D_jumlah_pelajaran_danum->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_jumlah_pelajaran_danum" name="btw1_D_jumlah_pelajaran_danum">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_jumlah_pelajaran_danum" name="btw1_D_jumlah_pelajaran_danum">
<input type="text" name="y_D_jumlah_pelajaran_danum" id="y_D_jumlah_pelajaran_danum" size="30" value="<?php echo $master_siswa->D_jumlah_pelajaran_danum->EditValue2 ?>"<?php echo $master_siswa->D_jumlah_pelajaran_danum->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_nilai_ujian_psb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_nilai_ujian_psb->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_nilai_ujian_psb" id="z_D_nilai_ujian_psb" onchange="ew_SrchOprChanged('z_D_nilai_ujian_psb')"><option value="="<?php echo ($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_nilai_ujian_psb->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_nilai_ujian_psb" id="x_D_nilai_ujian_psb" size="30" value="<?php echo $master_siswa->D_nilai_ujian_psb->EditValue ?>"<?php echo $master_siswa->D_nilai_ujian_psb->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_nilai_ujian_psb" name="btw1_D_nilai_ujian_psb">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_nilai_ujian_psb" name="btw1_D_nilai_ujian_psb">
<input type="text" name="y_D_nilai_ujian_psb" id="y_D_nilai_ujian_psb" size="30" value="<?php echo $master_siswa->D_nilai_ujian_psb->EditValue2 ?>"<?php echo $master_siswa->D_nilai_ujian_psb->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_tahun_psb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_tahun_psb->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_tahun_psb" id="z_D_tahun_psb" onchange="ew_SrchOprChanged('z_D_tahun_psb')"><option value="="<?php echo ($master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_tahun_psb->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_tahun_psb" id="x_D_tahun_psb" size="30" maxlength="4" value="<?php echo $master_siswa->D_tahun_psb->EditValue ?>"<?php echo $master_siswa->D_tahun_psb->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_tahun_psb" name="btw1_D_tahun_psb">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_tahun_psb" name="btw1_D_tahun_psb">
<input type="text" name="y_D_tahun_psb" id="y_D_tahun_psb" size="30" maxlength="4" value="<?php echo $master_siswa->D_tahun_psb->EditValue2 ?>"<?php echo $master_siswa->D_tahun_psb->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_diterima"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_diterima->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_diterima" id="z_D_diterima" onchange="ew_SrchOprChanged('z_D_diterima')"><option value="="<?php echo ($master_siswa->D_diterima->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_diterima->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_diterima->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_diterima->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_diterima->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_diterima->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_diterima->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_diterima->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_diterima->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_diterima->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_diterima->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_diterima" id="x_D_diterima" size="30" maxlength="1" value="<?php echo $master_siswa->D_diterima->EditValue ?>"<?php echo $master_siswa->D_diterima->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_diterima" name="btw1_D_diterima">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_diterima" name="btw1_D_diterima">
<input type="text" name="y_D_diterima" id="y_D_diterima" size="30" maxlength="1" value="<?php echo $master_siswa->D_diterima->EditValue2 ?>"<?php echo $master_siswa->D_diterima->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_spp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_spp->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_spp" id="z_D_spp" onchange="ew_SrchOprChanged('z_D_spp')"><option value="="<?php echo ($master_siswa->D_spp->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_spp->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_spp->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_spp->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_spp->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_spp->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_spp->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_spp->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_spp" id="x_D_spp" size="30" value="<?php echo $master_siswa->D_spp->EditValue ?>"<?php echo $master_siswa->D_spp->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_spp" name="btw1_D_spp">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_spp" name="btw1_D_spp">
<input type="text" name="y_D_spp" id="y_D_spp" size="30" value="<?php echo $master_siswa->D_spp->EditValue2 ?>"<?php echo $master_siswa->D_spp->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_D_spp_potongan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_spp_potongan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_spp_potongan" id="z_D_spp_potongan" onchange="ew_SrchOprChanged('z_D_spp_potongan')"><option value="="<?php echo ($master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_spp_potongan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_spp_potongan" id="x_D_spp_potongan" size="30" value="<?php echo $master_siswa->D_spp_potongan->EditValue ?>"<?php echo $master_siswa->D_spp_potongan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_spp_potongan" name="btw1_D_spp_potongan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_spp_potongan" name="btw1_D_spp_potongan">
<input type="text" name="y_D_spp_potongan" id="y_D_spp_potongan" size="30" value="<?php echo $master_siswa->D_spp_potongan->EditValue2 ?>"<?php echo $master_siswa->D_spp_potongan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_5">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_D_status_lama_baru"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->D_status_lama_baru->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_D_status_lama_baru" id="z_D_status_lama_baru" onchange="ew_SrchOprChanged('z_D_status_lama_baru')"><option value="="<?php echo ($master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->D_status_lama_baru->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_D_status_lama_baru" id="x_D_status_lama_baru" size="30" maxlength="1" value="<?php echo $master_siswa->D_status_lama_baru->EditValue ?>"<?php echo $master_siswa->D_status_lama_baru->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_D_status_lama_baru" name="btw1_D_status_lama_baru">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_D_status_lama_baru" name="btw1_D_status_lama_baru">
<input type="text" name="y_D_status_lama_baru" id="y_D_status_lama_baru" size="30" maxlength="1" value="<?php echo $master_siswa->D_status_lama_baru->EditValue2 ?>"<?php echo $master_siswa->D_status_lama_baru->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_nama_ayah"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_nama_ayah->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_nama_ayah" id="z_E_nama_ayah" onchange="ew_SrchOprChanged('z_E_nama_ayah')"><option value="="<?php echo ($master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_nama_ayah->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_nama_ayah" id="x_E_nama_ayah" size="30" maxlength="50" value="<?php echo $master_siswa->E_nama_ayah->EditValue ?>"<?php echo $master_siswa->E_nama_ayah->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_nama_ayah" name="btw1_E_nama_ayah">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_nama_ayah" name="btw1_E_nama_ayah">
<input type="text" name="y_E_nama_ayah" id="y_E_nama_ayah" size="30" maxlength="50" value="<?php echo $master_siswa->E_nama_ayah->EditValue2 ?>"<?php echo $master_siswa->E_nama_ayah->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_tempat_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_tempat_lahir->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_tempat_lahir" id="z_E_tempat_lahir" onchange="ew_SrchOprChanged('z_E_tempat_lahir')"><option value="="<?php echo ($master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_tempat_lahir->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_tempat_lahir" id="x_E_tempat_lahir" size="30" maxlength="30" value="<?php echo $master_siswa->E_tempat_lahir->EditValue ?>"<?php echo $master_siswa->E_tempat_lahir->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_tempat_lahir" name="btw1_E_tempat_lahir">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_tempat_lahir" name="btw1_E_tempat_lahir">
<input type="text" name="y_E_tempat_lahir" id="y_E_tempat_lahir" size="30" maxlength="30" value="<?php echo $master_siswa->E_tempat_lahir->EditValue2 ?>"<?php echo $master_siswa->E_tempat_lahir->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_tanggal_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_tanggal_lahir->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_tanggal_lahir" id="z_E_tanggal_lahir" onchange="ew_SrchOprChanged('z_E_tanggal_lahir')"><option value="="<?php echo ($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_tanggal_lahir->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_tanggal_lahir" id="x_E_tanggal_lahir" value="<?php echo $master_siswa->E_tanggal_lahir->EditValue ?>"<?php echo $master_siswa->E_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_E_tanggal_lahir" name="cal_x_E_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_E_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_E_tanggal_lahir" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_tanggal_lahir" name="btw1_E_tanggal_lahir">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_tanggal_lahir" name="btw1_E_tanggal_lahir">
<input type="text" name="y_E_tanggal_lahir" id="y_E_tanggal_lahir" value="<?php echo $master_siswa->E_tanggal_lahir->EditValue2 ?>"<?php echo $master_siswa->E_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_E_tanggal_lahir" name="cal_y_E_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_E_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_E_tanggal_lahir" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_agama"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_agama->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_agama" id="z_E_agama" onchange="ew_SrchOprChanged('z_E_agama')"><option value="="<?php echo ($master_siswa->E_agama->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_agama->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_agama->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_agama->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_agama->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_agama->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->E_agama->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->E_agama->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->E_agama->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_agama->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_agama->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<select id="x_E_agama" name="x_E_agama"<?php echo $master_siswa->E_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->E_agama->EditValue)) {
	$arwrk = $master_siswa->E_agama->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->E_agama->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_agama" name="btw1_E_agama">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_agama" name="btw1_E_agama">
<select id="y_E_agama" name="y_E_agama"<?php echo $master_siswa->E_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->E_agama->EditValue2)) {
	$arwrk = $master_siswa->E_agama->EditValue2;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->E_agama->AdvancedSearch->SearchValue2) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_kewarganegaraan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_kewarganegaraan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_kewarganegaraan" id="z_E_kewarganegaraan" onchange="ew_SrchOprChanged('z_E_kewarganegaraan')"><option value="="<?php echo ($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_kewarganegaraan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_kewarganegaraan" id="x_E_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->E_kewarganegaraan->EditValue ?>"<?php echo $master_siswa->E_kewarganegaraan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_kewarganegaraan" name="btw1_E_kewarganegaraan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_kewarganegaraan" name="btw1_E_kewarganegaraan">
<input type="text" name="y_E_kewarganegaraan" id="y_E_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->E_kewarganegaraan->EditValue2 ?>"<?php echo $master_siswa->E_kewarganegaraan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_pendidikan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_pendidikan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_pendidikan" id="z_E_pendidikan" onchange="ew_SrchOprChanged('z_E_pendidikan')"><option value="="<?php echo ($master_siswa->E_pendidikan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_pendidikan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_pendidikan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_pendidikan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_pendidikan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_pendidikan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->E_pendidikan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->E_pendidikan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->E_pendidikan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_pendidikan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_pendidikan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_pendidikan" id="x_E_pendidikan" size="30" maxlength="20" value="<?php echo $master_siswa->E_pendidikan->EditValue ?>"<?php echo $master_siswa->E_pendidikan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_pendidikan" name="btw1_E_pendidikan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_pendidikan" name="btw1_E_pendidikan">
<input type="text" name="y_E_pendidikan" id="y_E_pendidikan" size="30" maxlength="20" value="<?php echo $master_siswa->E_pendidikan->EditValue2 ?>"<?php echo $master_siswa->E_pendidikan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_pekerjaan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_pekerjaan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_pekerjaan" id="z_E_pekerjaan" onchange="ew_SrchOprChanged('z_E_pekerjaan')"><option value="="<?php echo ($master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_pekerjaan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_pekerjaan" id="x_E_pekerjaan" size="30" maxlength="20" value="<?php echo $master_siswa->E_pekerjaan->EditValue ?>"<?php echo $master_siswa->E_pekerjaan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_pekerjaan" name="btw1_E_pekerjaan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_pekerjaan" name="btw1_E_pekerjaan">
<input type="text" name="y_E_pekerjaan" id="y_E_pekerjaan" size="30" maxlength="20" value="<?php echo $master_siswa->E_pekerjaan->EditValue2 ?>"<?php echo $master_siswa->E_pekerjaan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_pengeluaran"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_pengeluaran->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_pengeluaran" id="z_E_pengeluaran" onchange="ew_SrchOprChanged('z_E_pengeluaran')"><option value="="<?php echo ($master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_pengeluaran->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_pengeluaran" id="x_E_pengeluaran" size="30" value="<?php echo $master_siswa->E_pengeluaran->EditValue ?>"<?php echo $master_siswa->E_pengeluaran->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_pengeluaran" name="btw1_E_pengeluaran">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_pengeluaran" name="btw1_E_pengeluaran">
<input type="text" name="y_E_pengeluaran" id="y_E_pengeluaran" size="30" value="<?php echo $master_siswa->E_pengeluaran->EditValue2 ?>"<?php echo $master_siswa->E_pengeluaran->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_alamat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_alamat->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_alamat" id="z_E_alamat" onchange="ew_SrchOprChanged('z_E_alamat')"><option value="="<?php echo ($master_siswa->E_alamat->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_alamat->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_alamat->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_alamat->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_alamat->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_alamat->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->E_alamat->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->E_alamat->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->E_alamat->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_alamat->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_alamat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_alamat" id="x_E_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->E_alamat->EditValue ?>"<?php echo $master_siswa->E_alamat->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_alamat" name="btw1_E_alamat">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_alamat" name="btw1_E_alamat">
<input type="text" name="y_E_alamat" id="y_E_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->E_alamat->EditValue2 ?>"<?php echo $master_siswa->E_alamat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_telepon"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_telepon->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_telepon" id="z_E_telepon" onchange="ew_SrchOprChanged('z_E_telepon')"><option value="="<?php echo ($master_siswa->E_telepon->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_telepon->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_telepon->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_telepon->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_telepon->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_telepon->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->E_telepon->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->E_telepon->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->E_telepon->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_telepon->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_telepon->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_telepon" id="x_E_telepon" size="30" maxlength="30" value="<?php echo $master_siswa->E_telepon->EditValue ?>"<?php echo $master_siswa->E_telepon->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_telepon" name="btw1_E_telepon">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_telepon" name="btw1_E_telepon">
<input type="text" name="y_E_telepon" id="y_E_telepon" size="30" maxlength="30" value="<?php echo $master_siswa->E_telepon->EditValue2 ?>"<?php echo $master_siswa->E_telepon->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_hp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_hp->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_hp" id="z_E_hp" onchange="ew_SrchOprChanged('z_E_hp')"><option value="="<?php echo ($master_siswa->E_hp->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_hp->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_hp->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_hp->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_hp->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_hp->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->E_hp->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->E_hp->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->E_hp->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_hp->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_hp->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_hp" id="x_E_hp" size="30" maxlength="30" value="<?php echo $master_siswa->E_hp->EditValue ?>"<?php echo $master_siswa->E_hp->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_hp" name="btw1_E_hp">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_hp" name="btw1_E_hp">
<input type="text" name="y_E_hp" id="y_E_hp" size="30" maxlength="30" value="<?php echo $master_siswa->E_hp->EditValue2 ?>"<?php echo $master_siswa->E_hp->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_E_hidup"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->E_hidup->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_E_hidup" id="z_E_hidup" onchange="ew_SrchOprChanged('z_E_hidup')"><option value="="<?php echo ($master_siswa->E_hidup->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->E_hidup->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->E_hidup->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->E_hidup->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->E_hidup->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->E_hidup->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->E_hidup->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->E_hidup->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->E_hidup->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->E_hidup->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->E_hidup->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_E_hidup" id="x_E_hidup" size="30" maxlength="20" value="<?php echo $master_siswa->E_hidup->EditValue ?>"<?php echo $master_siswa->E_hidup->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_E_hidup" name="btw1_E_hidup">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_E_hidup" name="btw1_E_hidup">
<input type="text" name="y_E_hidup" id="y_E_hidup" size="30" maxlength="20" value="<?php echo $master_siswa->E_hidup->EditValue2 ?>"<?php echo $master_siswa->E_hidup->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_6">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_F_nama_ibu"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_nama_ibu->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_nama_ibu" id="z_F_nama_ibu" onchange="ew_SrchOprChanged('z_F_nama_ibu')"><option value="="<?php echo ($master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_nama_ibu->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_nama_ibu" id="x_F_nama_ibu" size="30" maxlength="50" value="<?php echo $master_siswa->F_nama_ibu->EditValue ?>"<?php echo $master_siswa->F_nama_ibu->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_nama_ibu" name="btw1_F_nama_ibu">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_nama_ibu" name="btw1_F_nama_ibu">
<input type="text" name="y_F_nama_ibu" id="y_F_nama_ibu" size="30" maxlength="50" value="<?php echo $master_siswa->F_nama_ibu->EditValue2 ?>"<?php echo $master_siswa->F_nama_ibu->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_tempat_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_tempat_lahir->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_tempat_lahir" id="z_F_tempat_lahir" onchange="ew_SrchOprChanged('z_F_tempat_lahir')"><option value="="<?php echo ($master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_tempat_lahir->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_tempat_lahir" id="x_F_tempat_lahir" size="30" maxlength="30" value="<?php echo $master_siswa->F_tempat_lahir->EditValue ?>"<?php echo $master_siswa->F_tempat_lahir->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_tempat_lahir" name="btw1_F_tempat_lahir">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_tempat_lahir" name="btw1_F_tempat_lahir">
<input type="text" name="y_F_tempat_lahir" id="y_F_tempat_lahir" size="30" maxlength="30" value="<?php echo $master_siswa->F_tempat_lahir->EditValue2 ?>"<?php echo $master_siswa->F_tempat_lahir->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_tanggal_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_tanggal_lahir->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_tanggal_lahir" id="z_F_tanggal_lahir" onchange="ew_SrchOprChanged('z_F_tanggal_lahir')"><option value="="<?php echo ($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_tanggal_lahir->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_tanggal_lahir" id="x_F_tanggal_lahir" value="<?php echo $master_siswa->F_tanggal_lahir->EditValue ?>"<?php echo $master_siswa->F_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_F_tanggal_lahir" name="cal_x_F_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_F_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_F_tanggal_lahir" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_tanggal_lahir" name="btw1_F_tanggal_lahir">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_tanggal_lahir" name="btw1_F_tanggal_lahir">
<input type="text" name="y_F_tanggal_lahir" id="y_F_tanggal_lahir" value="<?php echo $master_siswa->F_tanggal_lahir->EditValue2 ?>"<?php echo $master_siswa->F_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_F_tanggal_lahir" name="cal_y_F_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_F_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_F_tanggal_lahir" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_agama"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_agama->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_agama" id="z_F_agama" onchange="ew_SrchOprChanged('z_F_agama')"><option value="="<?php echo ($master_siswa->F_agama->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_agama->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_agama->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_agama->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_agama->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_agama->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->F_agama->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->F_agama->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->F_agama->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_agama->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_agama->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<select id="x_F_agama" name="x_F_agama"<?php echo $master_siswa->F_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->F_agama->EditValue)) {
	$arwrk = $master_siswa->F_agama->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->F_agama->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_agama" name="btw1_F_agama">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_agama" name="btw1_F_agama">
<select id="y_F_agama" name="y_F_agama"<?php echo $master_siswa->F_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->F_agama->EditValue2)) {
	$arwrk = $master_siswa->F_agama->EditValue2;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->F_agama->AdvancedSearch->SearchValue2) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_kewarganegaraan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_kewarganegaraan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_kewarganegaraan" id="z_F_kewarganegaraan" onchange="ew_SrchOprChanged('z_F_kewarganegaraan')"><option value="="<?php echo ($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_kewarganegaraan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_kewarganegaraan" id="x_F_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->F_kewarganegaraan->EditValue ?>"<?php echo $master_siswa->F_kewarganegaraan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_kewarganegaraan" name="btw1_F_kewarganegaraan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_kewarganegaraan" name="btw1_F_kewarganegaraan">
<input type="text" name="y_F_kewarganegaraan" id="y_F_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->F_kewarganegaraan->EditValue2 ?>"<?php echo $master_siswa->F_kewarganegaraan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_pendidikan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_pendidikan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_pendidikan" id="z_F_pendidikan" onchange="ew_SrchOprChanged('z_F_pendidikan')"><option value="="<?php echo ($master_siswa->F_pendidikan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_pendidikan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_pendidikan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_pendidikan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_pendidikan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_pendidikan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->F_pendidikan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->F_pendidikan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->F_pendidikan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_pendidikan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_pendidikan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_pendidikan" id="x_F_pendidikan" size="30" maxlength="20" value="<?php echo $master_siswa->F_pendidikan->EditValue ?>"<?php echo $master_siswa->F_pendidikan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_pendidikan" name="btw1_F_pendidikan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_pendidikan" name="btw1_F_pendidikan">
<input type="text" name="y_F_pendidikan" id="y_F_pendidikan" size="30" maxlength="20" value="<?php echo $master_siswa->F_pendidikan->EditValue2 ?>"<?php echo $master_siswa->F_pendidikan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_pekerjaan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_pekerjaan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_pekerjaan" id="z_F_pekerjaan" onchange="ew_SrchOprChanged('z_F_pekerjaan')"><option value="="<?php echo ($master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_pekerjaan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_pekerjaan" id="x_F_pekerjaan" size="30" maxlength="20" value="<?php echo $master_siswa->F_pekerjaan->EditValue ?>"<?php echo $master_siswa->F_pekerjaan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_pekerjaan" name="btw1_F_pekerjaan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_pekerjaan" name="btw1_F_pekerjaan">
<input type="text" name="y_F_pekerjaan" id="y_F_pekerjaan" size="30" maxlength="20" value="<?php echo $master_siswa->F_pekerjaan->EditValue2 ?>"<?php echo $master_siswa->F_pekerjaan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_pengeluaran"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_pengeluaran->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_pengeluaran" id="z_F_pengeluaran" onchange="ew_SrchOprChanged('z_F_pengeluaran')"><option value="="<?php echo ($master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_pengeluaran->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_pengeluaran" id="x_F_pengeluaran" size="30" value="<?php echo $master_siswa->F_pengeluaran->EditValue ?>"<?php echo $master_siswa->F_pengeluaran->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_pengeluaran" name="btw1_F_pengeluaran">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_pengeluaran" name="btw1_F_pengeluaran">
<input type="text" name="y_F_pengeluaran" id="y_F_pengeluaran" size="30" value="<?php echo $master_siswa->F_pengeluaran->EditValue2 ?>"<?php echo $master_siswa->F_pengeluaran->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_alamat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_alamat->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_alamat" id="z_F_alamat" onchange="ew_SrchOprChanged('z_F_alamat')"><option value="="<?php echo ($master_siswa->F_alamat->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_alamat->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_alamat->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_alamat->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_alamat->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_alamat->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->F_alamat->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->F_alamat->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->F_alamat->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_alamat->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_alamat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_alamat" id="x_F_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->F_alamat->EditValue ?>"<?php echo $master_siswa->F_alamat->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_alamat" name="btw1_F_alamat">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_alamat" name="btw1_F_alamat">
<input type="text" name="y_F_alamat" id="y_F_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->F_alamat->EditValue2 ?>"<?php echo $master_siswa->F_alamat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_telepon"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_telepon->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_telepon" id="z_F_telepon" onchange="ew_SrchOprChanged('z_F_telepon')"><option value="="<?php echo ($master_siswa->F_telepon->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_telepon->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_telepon->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_telepon->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_telepon->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_telepon->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->F_telepon->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->F_telepon->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->F_telepon->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_telepon->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_telepon->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_telepon" id="x_F_telepon" size="30" maxlength="30" value="<?php echo $master_siswa->F_telepon->EditValue ?>"<?php echo $master_siswa->F_telepon->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_telepon" name="btw1_F_telepon">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_telepon" name="btw1_F_telepon">
<input type="text" name="y_F_telepon" id="y_F_telepon" size="30" maxlength="30" value="<?php echo $master_siswa->F_telepon->EditValue2 ?>"<?php echo $master_siswa->F_telepon->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_hp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_hp->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_hp" id="z_F_hp" onchange="ew_SrchOprChanged('z_F_hp')"><option value="="<?php echo ($master_siswa->F_hp->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_hp->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_hp->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_hp->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_hp->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_hp->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->F_hp->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->F_hp->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->F_hp->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_hp->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_hp->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_hp" id="x_F_hp" size="30" maxlength="30" value="<?php echo $master_siswa->F_hp->EditValue ?>"<?php echo $master_siswa->F_hp->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_hp" name="btw1_F_hp">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_hp" name="btw1_F_hp">
<input type="text" name="y_F_hp" id="y_F_hp" size="30" maxlength="30" value="<?php echo $master_siswa->F_hp->EditValue2 ?>"<?php echo $master_siswa->F_hp->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_F_hidup"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->F_hidup->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_F_hidup" id="z_F_hidup" onchange="ew_SrchOprChanged('z_F_hidup')"><option value="="<?php echo ($master_siswa->F_hidup->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->F_hidup->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->F_hidup->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->F_hidup->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->F_hidup->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->F_hidup->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->F_hidup->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->F_hidup->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->F_hidup->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->F_hidup->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->F_hidup->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_F_hidup" id="x_F_hidup" size="30" maxlength="20" value="<?php echo $master_siswa->F_hidup->EditValue ?>"<?php echo $master_siswa->F_hidup->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_F_hidup" name="btw1_F_hidup">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_F_hidup" name="btw1_F_hidup">
<input type="text" name="y_F_hidup" id="y_F_hidup" size="30" maxlength="20" value="<?php echo $master_siswa->F_hidup->EditValue2 ?>"<?php echo $master_siswa->F_hidup->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_7">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_G_nama_wali"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_nama_wali->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_nama_wali" id="z_G_nama_wali" onchange="ew_SrchOprChanged('z_G_nama_wali')"><option value="="<?php echo ($master_siswa->G_nama_wali->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_nama_wali->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_nama_wali->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_nama_wali->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_nama_wali->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_nama_wali->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->G_nama_wali->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->G_nama_wali->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->G_nama_wali->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_nama_wali->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_nama_wali->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_G_nama_wali" id="x_G_nama_wali" size="30" maxlength="50" value="<?php echo $master_siswa->G_nama_wali->EditValue ?>"<?php echo $master_siswa->G_nama_wali->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_nama_wali" name="btw1_G_nama_wali">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_nama_wali" name="btw1_G_nama_wali">
<input type="text" name="y_G_nama_wali" id="y_G_nama_wali" size="30" maxlength="50" value="<?php echo $master_siswa->G_nama_wali->EditValue2 ?>"<?php echo $master_siswa->G_nama_wali->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_G_tempat_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_tempat_lahir->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_tempat_lahir" id="z_G_tempat_lahir" onchange="ew_SrchOprChanged('z_G_tempat_lahir')"><option value="="<?php echo ($master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_tempat_lahir->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_G_tempat_lahir" id="x_G_tempat_lahir" size="30" maxlength="30" value="<?php echo $master_siswa->G_tempat_lahir->EditValue ?>"<?php echo $master_siswa->G_tempat_lahir->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_tempat_lahir" name="btw1_G_tempat_lahir">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_tempat_lahir" name="btw1_G_tempat_lahir">
<input type="text" name="y_G_tempat_lahir" id="y_G_tempat_lahir" size="30" maxlength="30" value="<?php echo $master_siswa->G_tempat_lahir->EditValue2 ?>"<?php echo $master_siswa->G_tempat_lahir->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_G_tanggal_lahir"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_tanggal_lahir->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_tanggal_lahir" id="z_G_tanggal_lahir" onchange="ew_SrchOprChanged('z_G_tanggal_lahir')"><option value="="<?php echo ($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_tanggal_lahir->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_G_tanggal_lahir" id="x_G_tanggal_lahir" value="<?php echo $master_siswa->G_tanggal_lahir->EditValue ?>"<?php echo $master_siswa->G_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_G_tanggal_lahir" name="cal_x_G_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_G_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_G_tanggal_lahir" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_tanggal_lahir" name="btw1_G_tanggal_lahir">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_tanggal_lahir" name="btw1_G_tanggal_lahir">
<input type="text" name="y_G_tanggal_lahir" id="y_G_tanggal_lahir" value="<?php echo $master_siswa->G_tanggal_lahir->EditValue2 ?>"<?php echo $master_siswa->G_tanggal_lahir->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_G_tanggal_lahir" name="cal_y_G_tanggal_lahir" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_G_tanggal_lahir", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_G_tanggal_lahir" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_G_agama"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_agama->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_agama" id="z_G_agama" onchange="ew_SrchOprChanged('z_G_agama')"><option value="="<?php echo ($master_siswa->G_agama->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_agama->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_agama->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_agama->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_agama->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_agama->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->G_agama->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->G_agama->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->G_agama->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_agama->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_agama->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<select id="x_G_agama" name="x_G_agama"<?php echo $master_siswa->G_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->G_agama->EditValue)) {
	$arwrk = $master_siswa->G_agama->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->G_agama->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_agama" name="btw1_G_agama">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_agama" name="btw1_G_agama">
<select id="y_G_agama" name="y_G_agama"<?php echo $master_siswa->G_agama->EditAttributes() ?>>
<?php
if (is_array($master_siswa->G_agama->EditValue2)) {
	$arwrk = $master_siswa->G_agama->EditValue2;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($master_siswa->G_agama->AdvancedSearch->SearchValue2) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr id="r_G_kewarganegaraan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_kewarganegaraan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_kewarganegaraan" id="z_G_kewarganegaraan" onchange="ew_SrchOprChanged('z_G_kewarganegaraan')"><option value="="<?php echo ($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_kewarganegaraan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_G_kewarganegaraan" id="x_G_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->G_kewarganegaraan->EditValue ?>"<?php echo $master_siswa->G_kewarganegaraan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_kewarganegaraan" name="btw1_G_kewarganegaraan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_kewarganegaraan" name="btw1_G_kewarganegaraan">
<input type="text" name="y_G_kewarganegaraan" id="y_G_kewarganegaraan" size="30" maxlength="20" value="<?php echo $master_siswa->G_kewarganegaraan->EditValue2 ?>"<?php echo $master_siswa->G_kewarganegaraan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_G_pendidikan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_pendidikan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_pendidikan" id="z_G_pendidikan" onchange="ew_SrchOprChanged('z_G_pendidikan')"><option value="="<?php echo ($master_siswa->G_pendidikan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_pendidikan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_pendidikan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_pendidikan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_pendidikan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_pendidikan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->G_pendidikan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->G_pendidikan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->G_pendidikan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_pendidikan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_pendidikan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_G_pendidikan" id="x_G_pendidikan" size="30" maxlength="20" value="<?php echo $master_siswa->G_pendidikan->EditValue ?>"<?php echo $master_siswa->G_pendidikan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_pendidikan" name="btw1_G_pendidikan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_pendidikan" name="btw1_G_pendidikan">
<input type="text" name="y_G_pendidikan" id="y_G_pendidikan" size="30" maxlength="20" value="<?php echo $master_siswa->G_pendidikan->EditValue2 ?>"<?php echo $master_siswa->G_pendidikan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_G_pekerjaan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_pekerjaan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_pekerjaan" id="z_G_pekerjaan" onchange="ew_SrchOprChanged('z_G_pekerjaan')"><option value="="<?php echo ($master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_pekerjaan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_G_pekerjaan" id="x_G_pekerjaan" size="30" maxlength="20" value="<?php echo $master_siswa->G_pekerjaan->EditValue ?>"<?php echo $master_siswa->G_pekerjaan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_pekerjaan" name="btw1_G_pekerjaan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_pekerjaan" name="btw1_G_pekerjaan">
<input type="text" name="y_G_pekerjaan" id="y_G_pekerjaan" size="30" maxlength="20" value="<?php echo $master_siswa->G_pekerjaan->EditValue2 ?>"<?php echo $master_siswa->G_pekerjaan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_G_pengeluaran"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_pengeluaran->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_pengeluaran" id="z_G_pengeluaran" onchange="ew_SrchOprChanged('z_G_pengeluaran')"><option value="="<?php echo ($master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_pengeluaran->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_G_pengeluaran" id="x_G_pengeluaran" size="30" value="<?php echo $master_siswa->G_pengeluaran->EditValue ?>"<?php echo $master_siswa->G_pengeluaran->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_pengeluaran" name="btw1_G_pengeluaran">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_pengeluaran" name="btw1_G_pengeluaran">
<input type="text" name="y_G_pengeluaran" id="y_G_pengeluaran" size="30" value="<?php echo $master_siswa->G_pengeluaran->EditValue2 ?>"<?php echo $master_siswa->G_pengeluaran->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_G_alamat"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_alamat->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_alamat" id="z_G_alamat" onchange="ew_SrchOprChanged('z_G_alamat')"><option value="="<?php echo ($master_siswa->G_alamat->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_alamat->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_alamat->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_alamat->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_alamat->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_alamat->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->G_alamat->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->G_alamat->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->G_alamat->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_alamat->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_alamat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_G_alamat" id="x_G_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->G_alamat->EditValue ?>"<?php echo $master_siswa->G_alamat->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_alamat" name="btw1_G_alamat">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_alamat" name="btw1_G_alamat">
<input type="text" name="y_G_alamat" id="y_G_alamat" size="30" maxlength="50" value="<?php echo $master_siswa->G_alamat->EditValue2 ?>"<?php echo $master_siswa->G_alamat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_G_telepon"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_telepon->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_telepon" id="z_G_telepon" onchange="ew_SrchOprChanged('z_G_telepon')"><option value="="<?php echo ($master_siswa->G_telepon->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_telepon->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_telepon->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_telepon->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_telepon->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_telepon->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->G_telepon->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->G_telepon->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->G_telepon->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_telepon->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_telepon->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_G_telepon" id="x_G_telepon" size="30" maxlength="30" value="<?php echo $master_siswa->G_telepon->EditValue ?>"<?php echo $master_siswa->G_telepon->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_telepon" name="btw1_G_telepon">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_telepon" name="btw1_G_telepon">
<input type="text" name="y_G_telepon" id="y_G_telepon" size="30" maxlength="30" value="<?php echo $master_siswa->G_telepon->EditValue2 ?>"<?php echo $master_siswa->G_telepon->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_G_hp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->G_hp->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_G_hp" id="z_G_hp" onchange="ew_SrchOprChanged('z_G_hp')"><option value="="<?php echo ($master_siswa->G_hp->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->G_hp->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->G_hp->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->G_hp->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->G_hp->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->G_hp->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->G_hp->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->G_hp->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->G_hp->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->G_hp->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->G_hp->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_G_hp" id="x_G_hp" size="30" maxlength="30" value="<?php echo $master_siswa->G_hp->EditValue ?>"<?php echo $master_siswa->G_hp->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_G_hp" name="btw1_G_hp">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_G_hp" name="btw1_G_hp">
<input type="text" name="y_G_hp" id="y_G_hp" size="30" maxlength="30" value="<?php echo $master_siswa->G_hp->EditValue2 ?>"<?php echo $master_siswa->G_hp->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_8">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_H_kesenian"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->H_kesenian->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_H_kesenian" id="z_H_kesenian" onchange="ew_SrchOprChanged('z_H_kesenian')"><option value="="<?php echo ($master_siswa->H_kesenian->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->H_kesenian->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->H_kesenian->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->H_kesenian->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->H_kesenian->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->H_kesenian->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->H_kesenian->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->H_kesenian->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->H_kesenian->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->H_kesenian->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->H_kesenian->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_H_kesenian" id="x_H_kesenian" size="30" maxlength="50" value="<?php echo $master_siswa->H_kesenian->EditValue ?>"<?php echo $master_siswa->H_kesenian->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_H_kesenian" name="btw1_H_kesenian">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_H_kesenian" name="btw1_H_kesenian">
<input type="text" name="y_H_kesenian" id="y_H_kesenian" size="30" maxlength="50" value="<?php echo $master_siswa->H_kesenian->EditValue2 ?>"<?php echo $master_siswa->H_kesenian->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_H_olahraga"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->H_olahraga->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_H_olahraga" id="z_H_olahraga" onchange="ew_SrchOprChanged('z_H_olahraga')"><option value="="<?php echo ($master_siswa->H_olahraga->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->H_olahraga->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->H_olahraga->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->H_olahraga->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->H_olahraga->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->H_olahraga->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->H_olahraga->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->H_olahraga->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->H_olahraga->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->H_olahraga->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->H_olahraga->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_H_olahraga" id="x_H_olahraga" size="30" maxlength="50" value="<?php echo $master_siswa->H_olahraga->EditValue ?>"<?php echo $master_siswa->H_olahraga->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_H_olahraga" name="btw1_H_olahraga">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_H_olahraga" name="btw1_H_olahraga">
<input type="text" name="y_H_olahraga" id="y_H_olahraga" size="30" maxlength="50" value="<?php echo $master_siswa->H_olahraga->EditValue2 ?>"<?php echo $master_siswa->H_olahraga->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_H_kemasyarakatan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->H_kemasyarakatan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_H_kemasyarakatan" id="z_H_kemasyarakatan" onchange="ew_SrchOprChanged('z_H_kemasyarakatan')"><option value="="<?php echo ($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->H_kemasyarakatan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_H_kemasyarakatan" id="x_H_kemasyarakatan" size="30" maxlength="50" value="<?php echo $master_siswa->H_kemasyarakatan->EditValue ?>"<?php echo $master_siswa->H_kemasyarakatan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_H_kemasyarakatan" name="btw1_H_kemasyarakatan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_H_kemasyarakatan" name="btw1_H_kemasyarakatan">
<input type="text" name="y_H_kemasyarakatan" id="y_H_kemasyarakatan" size="30" maxlength="50" value="<?php echo $master_siswa->H_kemasyarakatan->EditValue2 ?>"<?php echo $master_siswa->H_kemasyarakatan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_H_lainlain"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->H_lainlain->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_H_lainlain" id="z_H_lainlain" onchange="ew_SrchOprChanged('z_H_lainlain')"><option value="="<?php echo ($master_siswa->H_lainlain->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->H_lainlain->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->H_lainlain->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->H_lainlain->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->H_lainlain->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->H_lainlain->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->H_lainlain->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->H_lainlain->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->H_lainlain->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->H_lainlain->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->H_lainlain->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_H_lainlain" id="x_H_lainlain" size="30" maxlength="50" value="<?php echo $master_siswa->H_lainlain->EditValue ?>"<?php echo $master_siswa->H_lainlain->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_H_lainlain" name="btw1_H_lainlain">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_H_lainlain" name="btw1_H_lainlain">
<input type="text" name="y_H_lainlain" id="y_H_lainlain" size="30" maxlength="50" value="<?php echo $master_siswa->H_lainlain->EditValue2 ?>"<?php echo $master_siswa->H_lainlain->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_9">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_I_tanggal_meninggalkan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tanggal_meninggalkan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_tanggal_meninggalkan" id="z_I_tanggal_meninggalkan" onchange="ew_SrchOprChanged('z_I_tanggal_meninggalkan')"><option value="="<?php echo ($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_tanggal_meninggalkan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_tanggal_meninggalkan" id="x_I_tanggal_meninggalkan" value="<?php echo $master_siswa->I_tanggal_meninggalkan->EditValue ?>"<?php echo $master_siswa->I_tanggal_meninggalkan->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_I_tanggal_meninggalkan" name="cal_x_I_tanggal_meninggalkan" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_I_tanggal_meninggalkan", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_I_tanggal_meninggalkan" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_tanggal_meninggalkan" name="btw1_I_tanggal_meninggalkan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_tanggal_meninggalkan" name="btw1_I_tanggal_meninggalkan">
<input type="text" name="y_I_tanggal_meninggalkan" id="y_I_tanggal_meninggalkan" value="<?php echo $master_siswa->I_tanggal_meninggalkan->EditValue2 ?>"<?php echo $master_siswa->I_tanggal_meninggalkan->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_I_tanggal_meninggalkan" name="cal_y_I_tanggal_meninggalkan" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_I_tanggal_meninggalkan", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_I_tanggal_meninggalkan" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_alasan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_alasan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_alasan" id="z_I_alasan" onchange="ew_SrchOprChanged('z_I_alasan')"><option value="="<?php echo ($master_siswa->I_alasan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_alasan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_alasan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_alasan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_alasan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_alasan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_alasan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_alasan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_alasan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_alasan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_alasan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_alasan" id="x_I_alasan" size="30" maxlength="50" value="<?php echo $master_siswa->I_alasan->EditValue ?>"<?php echo $master_siswa->I_alasan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_alasan" name="btw1_I_alasan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_alasan" name="btw1_I_alasan">
<input type="text" name="y_I_alasan" id="y_I_alasan" size="30" maxlength="50" value="<?php echo $master_siswa->I_alasan->EditValue2 ?>"<?php echo $master_siswa->I_alasan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_tanggal_lulus"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tanggal_lulus->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_tanggal_lulus" id="z_I_tanggal_lulus" onchange="ew_SrchOprChanged('z_I_tanggal_lulus')"><option value="="<?php echo ($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_tanggal_lulus->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_tanggal_lulus" id="x_I_tanggal_lulus" value="<?php echo $master_siswa->I_tanggal_lulus->EditValue ?>"<?php echo $master_siswa->I_tanggal_lulus->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_I_tanggal_lulus" name="cal_x_I_tanggal_lulus" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_I_tanggal_lulus", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_I_tanggal_lulus" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_tanggal_lulus" name="btw1_I_tanggal_lulus">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_tanggal_lulus" name="btw1_I_tanggal_lulus">
<input type="text" name="y_I_tanggal_lulus" id="y_I_tanggal_lulus" value="<?php echo $master_siswa->I_tanggal_lulus->EditValue2 ?>"<?php echo $master_siswa->I_tanggal_lulus->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_I_tanggal_lulus" name="cal_y_I_tanggal_lulus" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_I_tanggal_lulus", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_I_tanggal_lulus" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_sttb"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_sttb->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_sttb" id="z_I_sttb" onchange="ew_SrchOprChanged('z_I_sttb')"><option value="="<?php echo ($master_siswa->I_sttb->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_sttb->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_sttb->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_sttb->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_sttb->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_sttb->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_sttb->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_sttb->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_sttb->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_sttb->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_sttb->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_sttb" id="x_I_sttb" size="30" maxlength="30" value="<?php echo $master_siswa->I_sttb->EditValue ?>"<?php echo $master_siswa->I_sttb->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_sttb" name="btw1_I_sttb">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_sttb" name="btw1_I_sttb">
<input type="text" name="y_I_sttb" id="y_I_sttb" size="30" maxlength="30" value="<?php echo $master_siswa->I_sttb->EditValue2 ?>"<?php echo $master_siswa->I_sttb->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_danum"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_danum->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_danum" id="z_I_danum" onchange="ew_SrchOprChanged('z_I_danum')"><option value="="<?php echo ($master_siswa->I_danum->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_danum->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_danum->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_danum->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_danum->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_danum->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_danum->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_danum->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_danum->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_danum->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_danum->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_danum" id="x_I_danum" size="30" maxlength="30" value="<?php echo $master_siswa->I_danum->EditValue ?>"<?php echo $master_siswa->I_danum->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_danum" name="btw1_I_danum">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_danum" name="btw1_I_danum">
<input type="text" name="y_I_danum" id="y_I_danum" size="30" maxlength="30" value="<?php echo $master_siswa->I_danum->EditValue2 ?>"<?php echo $master_siswa->I_danum->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_nilai_danum_smp"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_nilai_danum_smp->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_nilai_danum_smp" id="z_I_nilai_danum_smp" onchange="ew_SrchOprChanged('z_I_nilai_danum_smp')"><option value="="<?php echo ($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_nilai_danum_smp->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_nilai_danum_smp" id="x_I_nilai_danum_smp" size="30" value="<?php echo $master_siswa->I_nilai_danum_smp->EditValue ?>"<?php echo $master_siswa->I_nilai_danum_smp->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_nilai_danum_smp" name="btw1_I_nilai_danum_smp">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_nilai_danum_smp" name="btw1_I_nilai_danum_smp">
<input type="text" name="y_I_nilai_danum_smp" id="y_I_nilai_danum_smp" size="30" value="<?php echo $master_siswa->I_nilai_danum_smp->EditValue2 ?>"<?php echo $master_siswa->I_nilai_danum_smp->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_tahun1"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tahun1->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_tahun1" id="z_I_tahun1" onchange="ew_SrchOprChanged('z_I_tahun1')"><option value="="<?php echo ($master_siswa->I_tahun1->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_tahun1->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_tahun1->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_tahun1->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_tahun1->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_tahun1->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_tahun1->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_tahun1->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_tahun1->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_tahun1->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_tahun1->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_tahun1" id="x_I_tahun1" size="30" maxlength="10" value="<?php echo $master_siswa->I_tahun1->EditValue ?>"<?php echo $master_siswa->I_tahun1->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_tahun1" name="btw1_I_tahun1">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_tahun1" name="btw1_I_tahun1">
<input type="text" name="y_I_tahun1" id="y_I_tahun1" size="30" maxlength="10" value="<?php echo $master_siswa->I_tahun1->EditValue2 ?>"<?php echo $master_siswa->I_tahun1->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_tahun2"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tahun2->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_tahun2" id="z_I_tahun2" onchange="ew_SrchOprChanged('z_I_tahun2')"><option value="="<?php echo ($master_siswa->I_tahun2->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_tahun2->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_tahun2->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_tahun2->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_tahun2->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_tahun2->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_tahun2->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_tahun2->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_tahun2->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_tahun2->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_tahun2->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_tahun2" id="x_I_tahun2" size="30" maxlength="10" value="<?php echo $master_siswa->I_tahun2->EditValue ?>"<?php echo $master_siswa->I_tahun2->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_tahun2" name="btw1_I_tahun2">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_tahun2" name="btw1_I_tahun2">
<input type="text" name="y_I_tahun2" id="y_I_tahun2" size="30" maxlength="10" value="<?php echo $master_siswa->I_tahun2->EditValue2 ?>"<?php echo $master_siswa->I_tahun2->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_tahun3"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tahun3->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_tahun3" id="z_I_tahun3" onchange="ew_SrchOprChanged('z_I_tahun3')"><option value="="<?php echo ($master_siswa->I_tahun3->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_tahun3->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_tahun3->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_tahun3->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_tahun3->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_tahun3->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_tahun3->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_tahun3->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_tahun3->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_tahun3->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_tahun3->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_tahun3" id="x_I_tahun3" size="30" maxlength="10" value="<?php echo $master_siswa->I_tahun3->EditValue ?>"<?php echo $master_siswa->I_tahun3->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_tahun3" name="btw1_I_tahun3">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_tahun3" name="btw1_I_tahun3">
<input type="text" name="y_I_tahun3" id="y_I_tahun3" size="30" maxlength="10" value="<?php echo $master_siswa->I_tahun3->EditValue2 ?>"<?php echo $master_siswa->I_tahun3->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_tk1"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tk1->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_tk1" id="z_I_tk1" onchange="ew_SrchOprChanged('z_I_tk1')"><option value="="<?php echo ($master_siswa->I_tk1->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_tk1->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_tk1->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_tk1->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_tk1->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_tk1->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_tk1->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_tk1->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_tk1->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_tk1->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_tk1->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_tk1" id="x_I_tk1" size="30" maxlength="10" value="<?php echo $master_siswa->I_tk1->EditValue ?>"<?php echo $master_siswa->I_tk1->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_tk1" name="btw1_I_tk1">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_tk1" name="btw1_I_tk1">
<input type="text" name="y_I_tk1" id="y_I_tk1" size="30" maxlength="10" value="<?php echo $master_siswa->I_tk1->EditValue2 ?>"<?php echo $master_siswa->I_tk1->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_tk2"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tk2->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_tk2" id="z_I_tk2" onchange="ew_SrchOprChanged('z_I_tk2')"><option value="="<?php echo ($master_siswa->I_tk2->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_tk2->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_tk2->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_tk2->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_tk2->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_tk2->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_tk2->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_tk2->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_tk2->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_tk2->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_tk2->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_tk2" id="x_I_tk2" size="30" maxlength="10" value="<?php echo $master_siswa->I_tk2->EditValue ?>"<?php echo $master_siswa->I_tk2->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_tk2" name="btw1_I_tk2">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_tk2" name="btw1_I_tk2">
<input type="text" name="y_I_tk2" id="y_I_tk2" size="30" maxlength="10" value="<?php echo $master_siswa->I_tk2->EditValue2 ?>"<?php echo $master_siswa->I_tk2->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_tk3"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_tk3->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_tk3" id="z_I_tk3" onchange="ew_SrchOprChanged('z_I_tk3')"><option value="="<?php echo ($master_siswa->I_tk3->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_tk3->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_tk3->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_tk3->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_tk3->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_tk3->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_tk3->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_tk3->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_tk3->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_tk3->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_tk3->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_tk3" id="x_I_tk3" size="30" maxlength="10" value="<?php echo $master_siswa->I_tk3->EditValue ?>"<?php echo $master_siswa->I_tk3->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_tk3" name="btw1_I_tk3">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_tk3" name="btw1_I_tk3">
<input type="text" name="y_I_tk3" id="y_I_tk3" size="30" maxlength="10" value="<?php echo $master_siswa->I_tk3->EditValue2 ?>"<?php echo $master_siswa->I_tk3->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_dari1"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_dari1->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_dari1" id="z_I_dari1" onchange="ew_SrchOprChanged('z_I_dari1')"><option value="="<?php echo ($master_siswa->I_dari1->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_dari1->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_dari1->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_dari1->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_dari1->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_dari1->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_dari1->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_dari1->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_dari1->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_dari1->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_dari1->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_dari1" id="x_I_dari1" size="30" maxlength="30" value="<?php echo $master_siswa->I_dari1->EditValue ?>"<?php echo $master_siswa->I_dari1->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_dari1" name="btw1_I_dari1">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_dari1" name="btw1_I_dari1">
<input type="text" name="y_I_dari1" id="y_I_dari1" size="30" maxlength="30" value="<?php echo $master_siswa->I_dari1->EditValue2 ?>"<?php echo $master_siswa->I_dari1->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_dari2"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_dari2->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_dari2" id="z_I_dari2" onchange="ew_SrchOprChanged('z_I_dari2')"><option value="="<?php echo ($master_siswa->I_dari2->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_dari2->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_dari2->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_dari2->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_dari2->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_dari2->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_dari2->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_dari2->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_dari2->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_dari2->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_dari2->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_dari2" id="x_I_dari2" size="30" maxlength="30" value="<?php echo $master_siswa->I_dari2->EditValue ?>"<?php echo $master_siswa->I_dari2->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_dari2" name="btw1_I_dari2">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_dari2" name="btw1_I_dari2">
<input type="text" name="y_I_dari2" id="y_I_dari2" size="30" maxlength="30" value="<?php echo $master_siswa->I_dari2->EditValue2 ?>"<?php echo $master_siswa->I_dari2->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_I_dari3"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->I_dari3->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_I_dari3" id="z_I_dari3" onchange="ew_SrchOprChanged('z_I_dari3')"><option value="="<?php echo ($master_siswa->I_dari3->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->I_dari3->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->I_dari3->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->I_dari3->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->I_dari3->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->I_dari3->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->I_dari3->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->I_dari3->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->I_dari3->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->I_dari3->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->I_dari3->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_I_dari3" id="x_I_dari3" size="30" maxlength="30" value="<?php echo $master_siswa->I_dari3->EditValue ?>"<?php echo $master_siswa->I_dari3->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_I_dari3" name="btw1_I_dari3">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_I_dari3" name="btw1_I_dari3">
<input type="text" name="y_I_dari3" id="y_I_dari3" size="30" maxlength="30" value="<?php echo $master_siswa->I_dari3->EditValue2 ?>"<?php echo $master_siswa->I_dari3->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
		</div>
		<div id="tab_master_siswa_10">
<table cellspacing="0" class="ewGrid" style="width: 100%"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_J_melanjutkan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->J_melanjutkan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_J_melanjutkan" id="z_J_melanjutkan" onchange="ew_SrchOprChanged('z_J_melanjutkan')"><option value="="<?php echo ($master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->J_melanjutkan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_J_melanjutkan" id="x_J_melanjutkan" size="30" maxlength="30" value="<?php echo $master_siswa->J_melanjutkan->EditValue ?>"<?php echo $master_siswa->J_melanjutkan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_J_melanjutkan" name="btw1_J_melanjutkan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_J_melanjutkan" name="btw1_J_melanjutkan">
<input type="text" name="y_J_melanjutkan" id="y_J_melanjutkan" size="30" maxlength="30" value="<?php echo $master_siswa->J_melanjutkan->EditValue2 ?>"<?php echo $master_siswa->J_melanjutkan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_J_tanggal_bekerja"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->J_tanggal_bekerja->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_J_tanggal_bekerja" id="z_J_tanggal_bekerja" onchange="ew_SrchOprChanged('z_J_tanggal_bekerja')"><option value="="<?php echo ($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->J_tanggal_bekerja->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_J_tanggal_bekerja" id="x_J_tanggal_bekerja" value="<?php echo $master_siswa->J_tanggal_bekerja->EditValue ?>"<?php echo $master_siswa->J_tanggal_bekerja->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_J_tanggal_bekerja" name="cal_x_J_tanggal_bekerja" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_J_tanggal_bekerja", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_J_tanggal_bekerja" // button id
});
</script>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_J_tanggal_bekerja" name="btw1_J_tanggal_bekerja">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_J_tanggal_bekerja" name="btw1_J_tanggal_bekerja">
<input type="text" name="y_J_tanggal_bekerja" id="y_J_tanggal_bekerja" value="<?php echo $master_siswa->J_tanggal_bekerja->EditValue2 ?>"<?php echo $master_siswa->J_tanggal_bekerja->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_y_J_tanggal_bekerja" name="cal_y_J_tanggal_bekerja" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_J_tanggal_bekerja", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_y_J_tanggal_bekerja" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_J_nama_perusahaan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->J_nama_perusahaan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_J_nama_perusahaan" id="z_J_nama_perusahaan" onchange="ew_SrchOprChanged('z_J_nama_perusahaan')"><option value="="<?php echo ($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->J_nama_perusahaan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_J_nama_perusahaan" id="x_J_nama_perusahaan" size="30" maxlength="30" value="<?php echo $master_siswa->J_nama_perusahaan->EditValue ?>"<?php echo $master_siswa->J_nama_perusahaan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_J_nama_perusahaan" name="btw1_J_nama_perusahaan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_J_nama_perusahaan" name="btw1_J_nama_perusahaan">
<input type="text" name="y_J_nama_perusahaan" id="y_J_nama_perusahaan" size="30" maxlength="30" value="<?php echo $master_siswa->J_nama_perusahaan->EditValue2 ?>"<?php echo $master_siswa->J_nama_perusahaan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_J_penghasilan"<?php echo $master_siswa->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $master_siswa->J_penghasilan->FldCaption() ?></td>
		<td class="ewSearchOprCell"><select name="z_J_penghasilan" id="z_J_penghasilan" onchange="ew_SrchOprChanged('z_J_penghasilan')"><option value="="<?php echo ($master_siswa->J_penghasilan->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($master_siswa->J_penghasilan->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($master_siswa->J_penghasilan->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($master_siswa->J_penghasilan->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($master_siswa->J_penghasilan->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($master_siswa->J_penghasilan->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($master_siswa->J_penghasilan->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></td>
		<td<?php echo $master_siswa->J_penghasilan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_J_penghasilan" id="x_J_penghasilan" size="30" value="<?php echo $master_siswa->J_penghasilan->EditValue ?>"<?php echo $master_siswa->J_penghasilan->EditAttributes() ?>>
</span>
				<span class="ewSearchCond" style="display: none" id="btw1_J_penghasilan" name="btw1_J_penghasilan">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="display: none" id="btw1_J_penghasilan" name="btw1_J_penghasilan">
<input type="text" name="y_J_penghasilan" id="y_J_penghasilan" size="30" value="<?php echo $master_siswa->J_penghasilan->EditValue2 ?>"<?php echo $master_siswa->J_penghasilan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
		</div>
	</div>
</div>
</td></tr></table>
<script type="text/javascript">
<!--
ew_TabView(master_siswa_search);

//-->
</script>	
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_SrchOprChanged('z_no_absen');
ew_SrchOprChanged('z_A_nis_nasional');
ew_SrchOprChanged('z_A_nama_Lengkap');
ew_SrchOprChanged('z_A_nama_panggilan');
ew_SrchOprChanged('z_A_jenis_kelamin');
ew_SrchOprChanged('z_A_tempat_lahir');
ew_SrchOprChanged('z_A_tanggal_lahir');
ew_SrchOprChanged('z_A_agama');
ew_SrchOprChanged('z_A_kewarganegaraan');
ew_SrchOprChanged('z_A_anak_keberapa');
ew_SrchOprChanged('z_A_jumlah_saudara_kandung');
ew_SrchOprChanged('z_A_jumlah_saudara_tiri');
ew_SrchOprChanged('z_A_jumlah_saudara_angkat');
ew_SrchOprChanged('z_A_status_yatim');
ew_SrchOprChanged('z_A_bahasa');
ew_SrchOprChanged('z_B_alamat');
ew_SrchOprChanged('z_B_telepon_rumah');
ew_SrchOprChanged('z_B_tinggal');
ew_SrchOprChanged('z_B_jarak');
ew_SrchOprChanged('z_B_hp');
ew_SrchOprChanged('z_C_golongan_darah');
ew_SrchOprChanged('z_C_penyakit');
ew_SrchOprChanged('z_C_jasmani');
ew_SrchOprChanged('z_C_tinggi');
ew_SrchOprChanged('z_C_berat');
ew_SrchOprChanged('z_D_tamatan_dari');
ew_SrchOprChanged('z_D_sttb');
ew_SrchOprChanged('z_D_tanggal_sttb');
ew_SrchOprChanged('z_D_danum');
ew_SrchOprChanged('z_D_tanggal_danum');
ew_SrchOprChanged('z_D_lama_belajar');
ew_SrchOprChanged('z_D_dari_sekolah');
ew_SrchOprChanged('z_D_alasan');
ew_SrchOprChanged('z_D_kelas');
ew_SrchOprChanged('z_D_kelompok');
ew_SrchOprChanged('z_D_tanggal');
ew_SrchOprChanged('z_D_saat_ini_tingkat');
ew_SrchOprChanged('z_D_saat_ini_kelas');
ew_SrchOprChanged('z_D_saat_ini_kelompok');
ew_SrchOprChanged('z_D_no_psb');
ew_SrchOprChanged('z_D_nilai_danum_sd');
ew_SrchOprChanged('z_D_jumlah_pelajaran_danum');
ew_SrchOprChanged('z_D_nilai_ujian_psb');
ew_SrchOprChanged('z_D_tahun_psb');
ew_SrchOprChanged('z_D_diterima');
ew_SrchOprChanged('z_D_spp');
ew_SrchOprChanged('z_D_spp_potongan');
ew_SrchOprChanged('z_D_status_lama_baru');
ew_SrchOprChanged('z_E_nama_ayah');
ew_SrchOprChanged('z_E_tempat_lahir');
ew_SrchOprChanged('z_E_tanggal_lahir');
ew_SrchOprChanged('z_E_agama');
ew_SrchOprChanged('z_E_kewarganegaraan');
ew_SrchOprChanged('z_E_pendidikan');
ew_SrchOprChanged('z_E_pekerjaan');
ew_SrchOprChanged('z_E_pengeluaran');
ew_SrchOprChanged('z_E_alamat');
ew_SrchOprChanged('z_E_telepon');
ew_SrchOprChanged('z_E_hp');
ew_SrchOprChanged('z_E_hidup');
ew_SrchOprChanged('z_F_nama_ibu');
ew_SrchOprChanged('z_F_tempat_lahir');
ew_SrchOprChanged('z_F_tanggal_lahir');
ew_SrchOprChanged('z_F_agama');
ew_SrchOprChanged('z_F_kewarganegaraan');
ew_SrchOprChanged('z_F_pendidikan');
ew_SrchOprChanged('z_F_pekerjaan');
ew_SrchOprChanged('z_F_pengeluaran');
ew_SrchOprChanged('z_F_alamat');
ew_SrchOprChanged('z_F_telepon');
ew_SrchOprChanged('z_F_hp');
ew_SrchOprChanged('z_F_hidup');
ew_SrchOprChanged('z_G_nama_wali');
ew_SrchOprChanged('z_G_tempat_lahir');
ew_SrchOprChanged('z_G_tanggal_lahir');
ew_SrchOprChanged('z_G_agama');
ew_SrchOprChanged('z_G_kewarganegaraan');
ew_SrchOprChanged('z_G_pendidikan');
ew_SrchOprChanged('z_G_pekerjaan');
ew_SrchOprChanged('z_G_pengeluaran');
ew_SrchOprChanged('z_G_alamat');
ew_SrchOprChanged('z_G_telepon');
ew_SrchOprChanged('z_G_hp');
ew_SrchOprChanged('z_H_kesenian');
ew_SrchOprChanged('z_H_olahraga');
ew_SrchOprChanged('z_H_kemasyarakatan');
ew_SrchOprChanged('z_H_lainlain');
ew_SrchOprChanged('z_I_tanggal_meninggalkan');
ew_SrchOprChanged('z_I_alasan');
ew_SrchOprChanged('z_I_tanggal_lulus');
ew_SrchOprChanged('z_I_sttb');
ew_SrchOprChanged('z_I_danum');
ew_SrchOprChanged('z_I_nilai_danum_smp');
ew_SrchOprChanged('z_I_tahun1');
ew_SrchOprChanged('z_I_tahun2');
ew_SrchOprChanged('z_I_tahun3');
ew_SrchOprChanged('z_I_tk1');
ew_SrchOprChanged('z_I_tk2');
ew_SrchOprChanged('z_I_tk3');
ew_SrchOprChanged('z_I_dari1');
ew_SrchOprChanged('z_I_dari2');
ew_SrchOprChanged('z_I_dari3');
ew_SrchOprChanged('z_J_melanjutkan');
ew_SrchOprChanged('z_J_tanggal_bekerja');
ew_SrchOprChanged('z_J_nama_perusahaan');
ew_SrchOprChanged('z_J_penghasilan');
ew_SrchOprChanged('z_kode_otomatis');
ew_SrchOprChanged('z_apakah_valid');

//-->
</script>
<?php
$master_siswa_search->ShowPageFooter();
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
$master_siswa_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cmaster_siswa_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'master_siswa';

	// Page object name
	var $PageObjName = 'master_siswa_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $master_siswa;
		if ($master_siswa->UseTokenInUrl) $PageUrl .= "t=" . $master_siswa->TableVar . "&"; // Add page token
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
		global $objForm, $master_siswa;
		if ($master_siswa->UseTokenInUrl) {
			if ($objForm)
				return ($master_siswa->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($master_siswa->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmaster_siswa_search() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (master_siswa)
		if (!isset($GLOBALS["master_siswa"])) {
			$GLOBALS["master_siswa"] = new cmaster_siswa();
			$GLOBALS["Table"] =& $GLOBALS["master_siswa"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'master_siswa', TRUE);

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
		global $master_siswa;

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
			$this->Page_Terminate("master_siswalist.php");
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
		global $objForm, $Language, $gsSearchError, $master_siswa;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$master_siswa->CurrentAction = $objForm->GetValue("a_search");
			switch ($master_siswa->CurrentAction) {
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
						$sSrchStr = $master_siswa->UrlParm($sSrchStr);
						$this->Page_Terminate("master_siswalist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$master_siswa->RowType = EW_ROWTYPE_SEARCH;
		$master_siswa->ResetAttrs();
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $master_siswa;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->no_absen); // no_absen
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_nis_nasional); // A_nis_nasional
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_nama_Lengkap); // A_nama_Lengkap
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_nama_panggilan); // A_nama_panggilan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_jenis_kelamin); // A_jenis_kelamin
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_tempat_lahir); // A_tempat_lahir
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_tanggal_lahir); // A_tanggal_lahir
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_agama); // A_agama
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_kewarganegaraan); // A_kewarganegaraan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_anak_keberapa); // A_anak_keberapa
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_jumlah_saudara_kandung); // A_jumlah_saudara_kandung
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_jumlah_saudara_tiri); // A_jumlah_saudara_tiri
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_jumlah_saudara_angkat); // A_jumlah_saudara_angkat
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_status_yatim); // A_status_yatim
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->A_bahasa); // A_bahasa
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->B_alamat); // B_alamat
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->B_telepon_rumah); // B_telepon_rumah
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->B_tinggal); // B_tinggal
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->B_jarak); // B_jarak
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->B_hp); // B_hp
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->C_golongan_darah); // C_golongan_darah
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->C_penyakit); // C_penyakit
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->C_jasmani); // C_jasmani
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->C_tinggi); // C_tinggi
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->C_berat); // C_berat
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_tamatan_dari); // D_tamatan_dari
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_sttb); // D_sttb
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_tanggal_sttb); // D_tanggal_sttb
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_danum); // D_danum
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_tanggal_danum); // D_tanggal_danum
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_lama_belajar); // D_lama_belajar
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_dari_sekolah); // D_dari_sekolah
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_alasan); // D_alasan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_kelas); // D_kelas
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_kelompok); // D_kelompok
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_tanggal); // D_tanggal
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_saat_ini_tingkat); // D_saat_ini_tingkat
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_saat_ini_kelas); // D_saat_ini_kelas
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_saat_ini_kelompok); // D_saat_ini_kelompok
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_no_psb); // D_no_psb
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_nilai_danum_sd); // D_nilai_danum_sd
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_jumlah_pelajaran_danum); // D_jumlah_pelajaran_danum
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_nilai_ujian_psb); // D_nilai_ujian_psb
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_tahun_psb); // D_tahun_psb
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_diterima); // D_diterima
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_spp); // D_spp
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_spp_potongan); // D_spp_potongan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->D_status_lama_baru); // D_status_lama_baru
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_nama_ayah); // E_nama_ayah
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_tempat_lahir); // E_tempat_lahir
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_tanggal_lahir); // E_tanggal_lahir
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_agama); // E_agama
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_kewarganegaraan); // E_kewarganegaraan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_pendidikan); // E_pendidikan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_pekerjaan); // E_pekerjaan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_pengeluaran); // E_pengeluaran
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_alamat); // E_alamat
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_telepon); // E_telepon
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_hp); // E_hp
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->E_hidup); // E_hidup
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_nama_ibu); // F_nama_ibu
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_tempat_lahir); // F_tempat_lahir
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_tanggal_lahir); // F_tanggal_lahir
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_agama); // F_agama
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_kewarganegaraan); // F_kewarganegaraan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_pendidikan); // F_pendidikan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_pekerjaan); // F_pekerjaan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_pengeluaran); // F_pengeluaran
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_alamat); // F_alamat
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_telepon); // F_telepon
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_hp); // F_hp
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->F_hidup); // F_hidup
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_nama_wali); // G_nama_wali
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_tempat_lahir); // G_tempat_lahir
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_tanggal_lahir); // G_tanggal_lahir
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_agama); // G_agama
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_kewarganegaraan); // G_kewarganegaraan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_pendidikan); // G_pendidikan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_pekerjaan); // G_pekerjaan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_pengeluaran); // G_pengeluaran
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_alamat); // G_alamat
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_telepon); // G_telepon
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->G_hp); // G_hp
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->H_kesenian); // H_kesenian
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->H_olahraga); // H_olahraga
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->H_kemasyarakatan); // H_kemasyarakatan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->H_lainlain); // H_lainlain
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_tanggal_meninggalkan); // I_tanggal_meninggalkan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_alasan); // I_alasan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_tanggal_lulus); // I_tanggal_lulus
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_sttb); // I_sttb
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_danum); // I_danum
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_nilai_danum_smp); // I_nilai_danum_smp
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_tahun1); // I_tahun1
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_tahun2); // I_tahun2
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_tahun3); // I_tahun3
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_tk1); // I_tk1
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_tk2); // I_tk2
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_tk3); // I_tk3
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_dari1); // I_dari1
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_dari2); // I_dari2
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->I_dari3); // I_dari3
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->J_melanjutkan); // J_melanjutkan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->J_tanggal_bekerja); // J_tanggal_bekerja
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->J_nama_perusahaan); // J_nama_perusahaan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->J_penghasilan); // J_penghasilan
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->kode_otomatis); // kode_otomatis
	$this->BuildSearchUrl($sSrchUrl, $master_siswa->apakah_valid); // apakah_valid
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
		global $objForm, $master_siswa;

		// Load search values
		// no_absen

		$master_siswa->no_absen->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_no_absen"));
		$master_siswa->no_absen->AdvancedSearch->SearchOperator = $objForm->GetValue("z_no_absen");
		$master_siswa->no_absen->AdvancedSearch->SearchCondition = $objForm->GetValue("v_no_absen");
		$master_siswa->no_absen->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_no_absen"));
		$master_siswa->no_absen->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_no_absen");

		// A_nis_nasional
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_nis_nasional"));
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_nis_nasional");
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_nis_nasional");
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_nis_nasional"));
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_nis_nasional");

		// A_nama_Lengkap
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_nama_Lengkap"));
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_nama_Lengkap");
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_nama_Lengkap");
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_nama_Lengkap"));
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_nama_Lengkap");

		// A_nama_panggilan
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_nama_panggilan"));
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_nama_panggilan");
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_nama_panggilan");
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_nama_panggilan"));
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_nama_panggilan");

		// A_jenis_kelamin
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_jenis_kelamin"));
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_jenis_kelamin");
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_jenis_kelamin");
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_jenis_kelamin"));
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_jenis_kelamin");

		// A_tempat_lahir
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_tempat_lahir"));
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_tempat_lahir");
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_tempat_lahir");
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_tempat_lahir"));
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_tempat_lahir");

		// A_tanggal_lahir
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_tanggal_lahir"));
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_tanggal_lahir");
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_tanggal_lahir");
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_tanggal_lahir"));
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_tanggal_lahir");

		// A_agama
		$master_siswa->A_agama->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_agama"));
		$master_siswa->A_agama->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_agama");
		$master_siswa->A_agama->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_agama");
		$master_siswa->A_agama->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_agama"));
		$master_siswa->A_agama->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_agama");

		// A_kewarganegaraan
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_kewarganegaraan"));
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_kewarganegaraan");
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_kewarganegaraan");
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_kewarganegaraan"));
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_kewarganegaraan");

		// A_anak_keberapa
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_anak_keberapa"));
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_anak_keberapa");
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_anak_keberapa");
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_anak_keberapa"));
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_anak_keberapa");

		// A_jumlah_saudara_kandung
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_jumlah_saudara_kandung"));
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_jumlah_saudara_kandung");
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_jumlah_saudara_kandung");
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_jumlah_saudara_kandung"));
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_jumlah_saudara_kandung");

		// A_jumlah_saudara_tiri
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_jumlah_saudara_tiri"));
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_jumlah_saudara_tiri");
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_jumlah_saudara_tiri");
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_jumlah_saudara_tiri"));
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_jumlah_saudara_tiri");

		// A_jumlah_saudara_angkat
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_jumlah_saudara_angkat"));
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_jumlah_saudara_angkat");
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_jumlah_saudara_angkat");
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_jumlah_saudara_angkat"));
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_jumlah_saudara_angkat");

		// A_status_yatim
		$master_siswa->A_status_yatim->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_status_yatim"));
		$master_siswa->A_status_yatim->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_status_yatim");
		$master_siswa->A_status_yatim->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_status_yatim");
		$master_siswa->A_status_yatim->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_status_yatim"));
		$master_siswa->A_status_yatim->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_status_yatim");

		// A_bahasa
		$master_siswa->A_bahasa->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_A_bahasa"));
		$master_siswa->A_bahasa->AdvancedSearch->SearchOperator = $objForm->GetValue("z_A_bahasa");
		$master_siswa->A_bahasa->AdvancedSearch->SearchCondition = $objForm->GetValue("v_A_bahasa");
		$master_siswa->A_bahasa->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_A_bahasa"));
		$master_siswa->A_bahasa->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_A_bahasa");

		// B_alamat
		$master_siswa->B_alamat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_B_alamat"));
		$master_siswa->B_alamat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_B_alamat");
		$master_siswa->B_alamat->AdvancedSearch->SearchCondition = $objForm->GetValue("v_B_alamat");
		$master_siswa->B_alamat->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_B_alamat"));
		$master_siswa->B_alamat->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_B_alamat");

		// B_telepon_rumah
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_B_telepon_rumah"));
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator = $objForm->GetValue("z_B_telepon_rumah");
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchCondition = $objForm->GetValue("v_B_telepon_rumah");
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_B_telepon_rumah"));
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_B_telepon_rumah");

		// B_tinggal
		$master_siswa->B_tinggal->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_B_tinggal"));
		$master_siswa->B_tinggal->AdvancedSearch->SearchOperator = $objForm->GetValue("z_B_tinggal");
		$master_siswa->B_tinggal->AdvancedSearch->SearchCondition = $objForm->GetValue("v_B_tinggal");
		$master_siswa->B_tinggal->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_B_tinggal"));
		$master_siswa->B_tinggal->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_B_tinggal");

		// B_jarak
		$master_siswa->B_jarak->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_B_jarak"));
		$master_siswa->B_jarak->AdvancedSearch->SearchOperator = $objForm->GetValue("z_B_jarak");
		$master_siswa->B_jarak->AdvancedSearch->SearchCondition = $objForm->GetValue("v_B_jarak");
		$master_siswa->B_jarak->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_B_jarak"));
		$master_siswa->B_jarak->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_B_jarak");

		// B_hp
		$master_siswa->B_hp->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_B_hp"));
		$master_siswa->B_hp->AdvancedSearch->SearchOperator = $objForm->GetValue("z_B_hp");
		$master_siswa->B_hp->AdvancedSearch->SearchCondition = $objForm->GetValue("v_B_hp");
		$master_siswa->B_hp->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_B_hp"));
		$master_siswa->B_hp->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_B_hp");

		// C_golongan_darah
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_C_golongan_darah"));
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator = $objForm->GetValue("z_C_golongan_darah");
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchCondition = $objForm->GetValue("v_C_golongan_darah");
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_C_golongan_darah"));
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_C_golongan_darah");

		// C_penyakit
		$master_siswa->C_penyakit->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_C_penyakit"));
		$master_siswa->C_penyakit->AdvancedSearch->SearchOperator = $objForm->GetValue("z_C_penyakit");
		$master_siswa->C_penyakit->AdvancedSearch->SearchCondition = $objForm->GetValue("v_C_penyakit");
		$master_siswa->C_penyakit->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_C_penyakit"));
		$master_siswa->C_penyakit->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_C_penyakit");

		// C_jasmani
		$master_siswa->C_jasmani->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_C_jasmani"));
		$master_siswa->C_jasmani->AdvancedSearch->SearchOperator = $objForm->GetValue("z_C_jasmani");
		$master_siswa->C_jasmani->AdvancedSearch->SearchCondition = $objForm->GetValue("v_C_jasmani");
		$master_siswa->C_jasmani->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_C_jasmani"));
		$master_siswa->C_jasmani->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_C_jasmani");

		// C_tinggi
		$master_siswa->C_tinggi->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_C_tinggi"));
		$master_siswa->C_tinggi->AdvancedSearch->SearchOperator = $objForm->GetValue("z_C_tinggi");
		$master_siswa->C_tinggi->AdvancedSearch->SearchCondition = $objForm->GetValue("v_C_tinggi");
		$master_siswa->C_tinggi->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_C_tinggi"));
		$master_siswa->C_tinggi->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_C_tinggi");

		// C_berat
		$master_siswa->C_berat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_C_berat"));
		$master_siswa->C_berat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_C_berat");
		$master_siswa->C_berat->AdvancedSearch->SearchCondition = $objForm->GetValue("v_C_berat");
		$master_siswa->C_berat->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_C_berat"));
		$master_siswa->C_berat->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_C_berat");

		// D_tamatan_dari
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_tamatan_dari"));
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_tamatan_dari");
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_tamatan_dari");
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_tamatan_dari"));
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_tamatan_dari");

		// D_sttb
		$master_siswa->D_sttb->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_sttb"));
		$master_siswa->D_sttb->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_sttb");
		$master_siswa->D_sttb->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_sttb");
		$master_siswa->D_sttb->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_sttb"));
		$master_siswa->D_sttb->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_sttb");

		// D_tanggal_sttb
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_tanggal_sttb"));
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_tanggal_sttb");
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_tanggal_sttb");
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_tanggal_sttb"));
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_tanggal_sttb");

		// D_danum
		$master_siswa->D_danum->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_danum"));
		$master_siswa->D_danum->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_danum");
		$master_siswa->D_danum->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_danum");
		$master_siswa->D_danum->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_danum"));
		$master_siswa->D_danum->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_danum");

		// D_tanggal_danum
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_tanggal_danum"));
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_tanggal_danum");
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_tanggal_danum");
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_tanggal_danum"));
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_tanggal_danum");

		// D_lama_belajar
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_lama_belajar"));
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_lama_belajar");
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_lama_belajar");
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_lama_belajar"));
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_lama_belajar");

		// D_dari_sekolah
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_dari_sekolah"));
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_dari_sekolah");
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_dari_sekolah");
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_dari_sekolah"));
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_dari_sekolah");

		// D_alasan
		$master_siswa->D_alasan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_alasan"));
		$master_siswa->D_alasan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_alasan");
		$master_siswa->D_alasan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_alasan");
		$master_siswa->D_alasan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_alasan"));
		$master_siswa->D_alasan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_alasan");

		// D_kelas
		$master_siswa->D_kelas->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_kelas"));
		$master_siswa->D_kelas->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_kelas");
		$master_siswa->D_kelas->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_kelas");
		$master_siswa->D_kelas->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_kelas"));
		$master_siswa->D_kelas->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_kelas");

		// D_kelompok
		$master_siswa->D_kelompok->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_kelompok"));
		$master_siswa->D_kelompok->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_kelompok");
		$master_siswa->D_kelompok->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_kelompok");
		$master_siswa->D_kelompok->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_kelompok"));
		$master_siswa->D_kelompok->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_kelompok");

		// D_tanggal
		$master_siswa->D_tanggal->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_tanggal"));
		$master_siswa->D_tanggal->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_tanggal");
		$master_siswa->D_tanggal->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_tanggal");
		$master_siswa->D_tanggal->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_tanggal"));
		$master_siswa->D_tanggal->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_tanggal");

		// D_saat_ini_tingkat
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_saat_ini_tingkat"));
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_saat_ini_tingkat");
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_saat_ini_tingkat");
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_saat_ini_tingkat"));
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_saat_ini_tingkat");

		// D_saat_ini_kelas
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_saat_ini_kelas"));
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_saat_ini_kelas");
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_saat_ini_kelas");
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_saat_ini_kelas"));
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_saat_ini_kelas");

		// D_saat_ini_kelompok
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_saat_ini_kelompok"));
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_saat_ini_kelompok");
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_saat_ini_kelompok");
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_saat_ini_kelompok"));
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_saat_ini_kelompok");

		// D_no_psb
		$master_siswa->D_no_psb->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_no_psb"));
		$master_siswa->D_no_psb->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_no_psb");
		$master_siswa->D_no_psb->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_no_psb");
		$master_siswa->D_no_psb->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_no_psb"));
		$master_siswa->D_no_psb->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_no_psb");

		// D_nilai_danum_sd
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_nilai_danum_sd"));
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_nilai_danum_sd");
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_nilai_danum_sd");
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_nilai_danum_sd"));
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_nilai_danum_sd");

		// D_jumlah_pelajaran_danum
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_jumlah_pelajaran_danum"));
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_jumlah_pelajaran_danum");
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_jumlah_pelajaran_danum");
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_jumlah_pelajaran_danum"));
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_jumlah_pelajaran_danum");

		// D_nilai_ujian_psb
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_nilai_ujian_psb"));
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_nilai_ujian_psb");
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_nilai_ujian_psb");
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_nilai_ujian_psb"));
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_nilai_ujian_psb");

		// D_tahun_psb
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_tahun_psb"));
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_tahun_psb");
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_tahun_psb");
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_tahun_psb"));
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_tahun_psb");

		// D_diterima
		$master_siswa->D_diterima->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_diterima"));
		$master_siswa->D_diterima->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_diterima");
		$master_siswa->D_diterima->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_diterima");
		$master_siswa->D_diterima->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_diterima"));
		$master_siswa->D_diterima->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_diterima");

		// D_spp
		$master_siswa->D_spp->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_spp"));
		$master_siswa->D_spp->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_spp");
		$master_siswa->D_spp->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_spp");
		$master_siswa->D_spp->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_spp"));
		$master_siswa->D_spp->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_spp");

		// D_spp_potongan
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_spp_potongan"));
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_spp_potongan");
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_spp_potongan");
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_spp_potongan"));
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_spp_potongan");

		// D_status_lama_baru
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_D_status_lama_baru"));
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator = $objForm->GetValue("z_D_status_lama_baru");
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchCondition = $objForm->GetValue("v_D_status_lama_baru");
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_D_status_lama_baru"));
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_D_status_lama_baru");

		// E_nama_ayah
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_nama_ayah"));
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_nama_ayah");
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_nama_ayah");
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_nama_ayah"));
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_nama_ayah");

		// E_tempat_lahir
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_tempat_lahir"));
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_tempat_lahir");
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_tempat_lahir");
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_tempat_lahir"));
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_tempat_lahir");

		// E_tanggal_lahir
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_tanggal_lahir"));
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_tanggal_lahir");
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_tanggal_lahir");
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_tanggal_lahir"));
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_tanggal_lahir");

		// E_agama
		$master_siswa->E_agama->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_agama"));
		$master_siswa->E_agama->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_agama");
		$master_siswa->E_agama->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_agama");
		$master_siswa->E_agama->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_agama"));
		$master_siswa->E_agama->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_agama");

		// E_kewarganegaraan
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_kewarganegaraan"));
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_kewarganegaraan");
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_kewarganegaraan");
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_kewarganegaraan"));
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_kewarganegaraan");

		// E_pendidikan
		$master_siswa->E_pendidikan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_pendidikan"));
		$master_siswa->E_pendidikan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_pendidikan");
		$master_siswa->E_pendidikan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_pendidikan");
		$master_siswa->E_pendidikan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_pendidikan"));
		$master_siswa->E_pendidikan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_pendidikan");

		// E_pekerjaan
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_pekerjaan"));
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_pekerjaan");
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_pekerjaan");
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_pekerjaan"));
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_pekerjaan");

		// E_pengeluaran
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_pengeluaran"));
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_pengeluaran");
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_pengeluaran");
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_pengeluaran"));
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_pengeluaran");

		// E_alamat
		$master_siswa->E_alamat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_alamat"));
		$master_siswa->E_alamat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_alamat");
		$master_siswa->E_alamat->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_alamat");
		$master_siswa->E_alamat->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_alamat"));
		$master_siswa->E_alamat->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_alamat");

		// E_telepon
		$master_siswa->E_telepon->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_telepon"));
		$master_siswa->E_telepon->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_telepon");
		$master_siswa->E_telepon->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_telepon");
		$master_siswa->E_telepon->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_telepon"));
		$master_siswa->E_telepon->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_telepon");

		// E_hp
		$master_siswa->E_hp->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_hp"));
		$master_siswa->E_hp->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_hp");
		$master_siswa->E_hp->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_hp");
		$master_siswa->E_hp->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_hp"));
		$master_siswa->E_hp->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_hp");

		// E_hidup
		$master_siswa->E_hidup->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_E_hidup"));
		$master_siswa->E_hidup->AdvancedSearch->SearchOperator = $objForm->GetValue("z_E_hidup");
		$master_siswa->E_hidup->AdvancedSearch->SearchCondition = $objForm->GetValue("v_E_hidup");
		$master_siswa->E_hidup->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_E_hidup"));
		$master_siswa->E_hidup->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_E_hidup");

		// F_nama_ibu
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_nama_ibu"));
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_nama_ibu");
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_nama_ibu");
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_nama_ibu"));
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_nama_ibu");

		// F_tempat_lahir
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_tempat_lahir"));
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_tempat_lahir");
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_tempat_lahir");
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_tempat_lahir"));
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_tempat_lahir");

		// F_tanggal_lahir
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_tanggal_lahir"));
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_tanggal_lahir");
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_tanggal_lahir");
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_tanggal_lahir"));
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_tanggal_lahir");

		// F_agama
		$master_siswa->F_agama->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_agama"));
		$master_siswa->F_agama->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_agama");
		$master_siswa->F_agama->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_agama");
		$master_siswa->F_agama->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_agama"));
		$master_siswa->F_agama->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_agama");

		// F_kewarganegaraan
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_kewarganegaraan"));
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_kewarganegaraan");
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_kewarganegaraan");
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_kewarganegaraan"));
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_kewarganegaraan");

		// F_pendidikan
		$master_siswa->F_pendidikan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_pendidikan"));
		$master_siswa->F_pendidikan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_pendidikan");
		$master_siswa->F_pendidikan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_pendidikan");
		$master_siswa->F_pendidikan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_pendidikan"));
		$master_siswa->F_pendidikan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_pendidikan");

		// F_pekerjaan
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_pekerjaan"));
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_pekerjaan");
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_pekerjaan");
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_pekerjaan"));
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_pekerjaan");

		// F_pengeluaran
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_pengeluaran"));
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_pengeluaran");
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_pengeluaran");
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_pengeluaran"));
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_pengeluaran");

		// F_alamat
		$master_siswa->F_alamat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_alamat"));
		$master_siswa->F_alamat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_alamat");
		$master_siswa->F_alamat->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_alamat");
		$master_siswa->F_alamat->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_alamat"));
		$master_siswa->F_alamat->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_alamat");

		// F_telepon
		$master_siswa->F_telepon->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_telepon"));
		$master_siswa->F_telepon->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_telepon");
		$master_siswa->F_telepon->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_telepon");
		$master_siswa->F_telepon->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_telepon"));
		$master_siswa->F_telepon->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_telepon");

		// F_hp
		$master_siswa->F_hp->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_hp"));
		$master_siswa->F_hp->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_hp");
		$master_siswa->F_hp->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_hp");
		$master_siswa->F_hp->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_hp"));
		$master_siswa->F_hp->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_hp");

		// F_hidup
		$master_siswa->F_hidup->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_F_hidup"));
		$master_siswa->F_hidup->AdvancedSearch->SearchOperator = $objForm->GetValue("z_F_hidup");
		$master_siswa->F_hidup->AdvancedSearch->SearchCondition = $objForm->GetValue("v_F_hidup");
		$master_siswa->F_hidup->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_F_hidup"));
		$master_siswa->F_hidup->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_F_hidup");

		// G_nama_wali
		$master_siswa->G_nama_wali->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_nama_wali"));
		$master_siswa->G_nama_wali->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_nama_wali");
		$master_siswa->G_nama_wali->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_nama_wali");
		$master_siswa->G_nama_wali->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_nama_wali"));
		$master_siswa->G_nama_wali->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_nama_wali");

		// G_tempat_lahir
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_tempat_lahir"));
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_tempat_lahir");
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_tempat_lahir");
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_tempat_lahir"));
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_tempat_lahir");

		// G_tanggal_lahir
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_tanggal_lahir"));
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_tanggal_lahir");
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_tanggal_lahir");
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_tanggal_lahir"));
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_tanggal_lahir");

		// G_agama
		$master_siswa->G_agama->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_agama"));
		$master_siswa->G_agama->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_agama");
		$master_siswa->G_agama->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_agama");
		$master_siswa->G_agama->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_agama"));
		$master_siswa->G_agama->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_agama");

		// G_kewarganegaraan
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_kewarganegaraan"));
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_kewarganegaraan");
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_kewarganegaraan");
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_kewarganegaraan"));
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_kewarganegaraan");

		// G_pendidikan
		$master_siswa->G_pendidikan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_pendidikan"));
		$master_siswa->G_pendidikan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_pendidikan");
		$master_siswa->G_pendidikan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_pendidikan");
		$master_siswa->G_pendidikan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_pendidikan"));
		$master_siswa->G_pendidikan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_pendidikan");

		// G_pekerjaan
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_pekerjaan"));
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_pekerjaan");
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_pekerjaan");
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_pekerjaan"));
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_pekerjaan");

		// G_pengeluaran
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_pengeluaran"));
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_pengeluaran");
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_pengeluaran");
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_pengeluaran"));
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_pengeluaran");

		// G_alamat
		$master_siswa->G_alamat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_alamat"));
		$master_siswa->G_alamat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_alamat");
		$master_siswa->G_alamat->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_alamat");
		$master_siswa->G_alamat->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_alamat"));
		$master_siswa->G_alamat->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_alamat");

		// G_telepon
		$master_siswa->G_telepon->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_telepon"));
		$master_siswa->G_telepon->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_telepon");
		$master_siswa->G_telepon->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_telepon");
		$master_siswa->G_telepon->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_telepon"));
		$master_siswa->G_telepon->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_telepon");

		// G_hp
		$master_siswa->G_hp->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_G_hp"));
		$master_siswa->G_hp->AdvancedSearch->SearchOperator = $objForm->GetValue("z_G_hp");
		$master_siswa->G_hp->AdvancedSearch->SearchCondition = $objForm->GetValue("v_G_hp");
		$master_siswa->G_hp->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_G_hp"));
		$master_siswa->G_hp->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_G_hp");

		// H_kesenian
		$master_siswa->H_kesenian->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_H_kesenian"));
		$master_siswa->H_kesenian->AdvancedSearch->SearchOperator = $objForm->GetValue("z_H_kesenian");
		$master_siswa->H_kesenian->AdvancedSearch->SearchCondition = $objForm->GetValue("v_H_kesenian");
		$master_siswa->H_kesenian->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_H_kesenian"));
		$master_siswa->H_kesenian->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_H_kesenian");

		// H_olahraga
		$master_siswa->H_olahraga->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_H_olahraga"));
		$master_siswa->H_olahraga->AdvancedSearch->SearchOperator = $objForm->GetValue("z_H_olahraga");
		$master_siswa->H_olahraga->AdvancedSearch->SearchCondition = $objForm->GetValue("v_H_olahraga");
		$master_siswa->H_olahraga->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_H_olahraga"));
		$master_siswa->H_olahraga->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_H_olahraga");

		// H_kemasyarakatan
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_H_kemasyarakatan"));
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_H_kemasyarakatan");
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_H_kemasyarakatan");
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_H_kemasyarakatan"));
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_H_kemasyarakatan");

		// H_lainlain
		$master_siswa->H_lainlain->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_H_lainlain"));
		$master_siswa->H_lainlain->AdvancedSearch->SearchOperator = $objForm->GetValue("z_H_lainlain");
		$master_siswa->H_lainlain->AdvancedSearch->SearchCondition = $objForm->GetValue("v_H_lainlain");
		$master_siswa->H_lainlain->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_H_lainlain"));
		$master_siswa->H_lainlain->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_H_lainlain");

		// I_tanggal_meninggalkan
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_tanggal_meninggalkan"));
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_tanggal_meninggalkan");
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_tanggal_meninggalkan");
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_tanggal_meninggalkan"));
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_tanggal_meninggalkan");

		// I_alasan
		$master_siswa->I_alasan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_alasan"));
		$master_siswa->I_alasan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_alasan");
		$master_siswa->I_alasan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_alasan");
		$master_siswa->I_alasan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_alasan"));
		$master_siswa->I_alasan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_alasan");

		// I_tanggal_lulus
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_tanggal_lulus"));
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_tanggal_lulus");
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_tanggal_lulus");
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_tanggal_lulus"));
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_tanggal_lulus");

		// I_sttb
		$master_siswa->I_sttb->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_sttb"));
		$master_siswa->I_sttb->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_sttb");
		$master_siswa->I_sttb->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_sttb");
		$master_siswa->I_sttb->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_sttb"));
		$master_siswa->I_sttb->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_sttb");

		// I_danum
		$master_siswa->I_danum->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_danum"));
		$master_siswa->I_danum->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_danum");
		$master_siswa->I_danum->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_danum");
		$master_siswa->I_danum->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_danum"));
		$master_siswa->I_danum->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_danum");

		// I_nilai_danum_smp
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_nilai_danum_smp"));
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_nilai_danum_smp");
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_nilai_danum_smp");
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_nilai_danum_smp"));
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_nilai_danum_smp");

		// I_tahun1
		$master_siswa->I_tahun1->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_tahun1"));
		$master_siswa->I_tahun1->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_tahun1");
		$master_siswa->I_tahun1->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_tahun1");
		$master_siswa->I_tahun1->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_tahun1"));
		$master_siswa->I_tahun1->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_tahun1");

		// I_tahun2
		$master_siswa->I_tahun2->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_tahun2"));
		$master_siswa->I_tahun2->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_tahun2");
		$master_siswa->I_tahun2->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_tahun2");
		$master_siswa->I_tahun2->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_tahun2"));
		$master_siswa->I_tahun2->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_tahun2");

		// I_tahun3
		$master_siswa->I_tahun3->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_tahun3"));
		$master_siswa->I_tahun3->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_tahun3");
		$master_siswa->I_tahun3->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_tahun3");
		$master_siswa->I_tahun3->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_tahun3"));
		$master_siswa->I_tahun3->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_tahun3");

		// I_tk1
		$master_siswa->I_tk1->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_tk1"));
		$master_siswa->I_tk1->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_tk1");
		$master_siswa->I_tk1->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_tk1");
		$master_siswa->I_tk1->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_tk1"));
		$master_siswa->I_tk1->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_tk1");

		// I_tk2
		$master_siswa->I_tk2->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_tk2"));
		$master_siswa->I_tk2->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_tk2");
		$master_siswa->I_tk2->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_tk2");
		$master_siswa->I_tk2->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_tk2"));
		$master_siswa->I_tk2->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_tk2");

		// I_tk3
		$master_siswa->I_tk3->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_tk3"));
		$master_siswa->I_tk3->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_tk3");
		$master_siswa->I_tk3->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_tk3");
		$master_siswa->I_tk3->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_tk3"));
		$master_siswa->I_tk3->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_tk3");

		// I_dari1
		$master_siswa->I_dari1->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_dari1"));
		$master_siswa->I_dari1->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_dari1");
		$master_siswa->I_dari1->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_dari1");
		$master_siswa->I_dari1->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_dari1"));
		$master_siswa->I_dari1->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_dari1");

		// I_dari2
		$master_siswa->I_dari2->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_dari2"));
		$master_siswa->I_dari2->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_dari2");
		$master_siswa->I_dari2->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_dari2");
		$master_siswa->I_dari2->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_dari2"));
		$master_siswa->I_dari2->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_dari2");

		// I_dari3
		$master_siswa->I_dari3->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_I_dari3"));
		$master_siswa->I_dari3->AdvancedSearch->SearchOperator = $objForm->GetValue("z_I_dari3");
		$master_siswa->I_dari3->AdvancedSearch->SearchCondition = $objForm->GetValue("v_I_dari3");
		$master_siswa->I_dari3->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_I_dari3"));
		$master_siswa->I_dari3->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_I_dari3");

		// J_melanjutkan
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_J_melanjutkan"));
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_J_melanjutkan");
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_J_melanjutkan");
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_J_melanjutkan"));
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_J_melanjutkan");

		// J_tanggal_bekerja
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_J_tanggal_bekerja"));
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator = $objForm->GetValue("z_J_tanggal_bekerja");
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchCondition = $objForm->GetValue("v_J_tanggal_bekerja");
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_J_tanggal_bekerja"));
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_J_tanggal_bekerja");

		// J_nama_perusahaan
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_J_nama_perusahaan"));
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_J_nama_perusahaan");
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_J_nama_perusahaan");
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_J_nama_perusahaan"));
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_J_nama_perusahaan");

		// J_penghasilan
		$master_siswa->J_penghasilan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_J_penghasilan"));
		$master_siswa->J_penghasilan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_J_penghasilan");
		$master_siswa->J_penghasilan->AdvancedSearch->SearchCondition = $objForm->GetValue("v_J_penghasilan");
		$master_siswa->J_penghasilan->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_J_penghasilan"));
		$master_siswa->J_penghasilan->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_J_penghasilan");

		// kode_otomatis
		$master_siswa->kode_otomatis->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_kode_otomatis"));
		$master_siswa->kode_otomatis->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode_otomatis");
		$master_siswa->kode_otomatis->AdvancedSearch->SearchCondition = $objForm->GetValue("v_kode_otomatis");
		$master_siswa->kode_otomatis->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_kode_otomatis"));
		$master_siswa->kode_otomatis->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_kode_otomatis");

		// apakah_valid
		$master_siswa->apakah_valid->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_apakah_valid"));
		$master_siswa->apakah_valid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_apakah_valid");
		$master_siswa->apakah_valid->AdvancedSearch->SearchCondition = $objForm->GetValue("v_apakah_valid");
		$master_siswa->apakah_valid->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_apakah_valid"));
		$master_siswa->apakah_valid->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_apakah_valid");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $master_siswa;

		// Initialize URLs
		// Call Row_Rendering event

		$master_siswa->Row_Rendering();

		// Common render codes for all row types
		// no_absen
		// A_nis_nasional
		// A_nama_Lengkap
		// A_nama_panggilan
		// A_jenis_kelamin
		// A_tempat_lahir
		// A_tanggal_lahir
		// A_agama
		// A_kewarganegaraan
		// A_anak_keberapa
		// A_jumlah_saudara_kandung
		// A_jumlah_saudara_tiri
		// A_jumlah_saudara_angkat
		// A_status_yatim
		// A_bahasa
		// B_alamat
		// B_telepon_rumah
		// B_tinggal
		// B_jarak
		// B_hp
		// C_golongan_darah
		// C_penyakit
		// C_jasmani
		// C_tinggi
		// C_berat
		// D_tamatan_dari
		// D_sttb
		// D_tanggal_sttb
		// D_danum
		// D_tanggal_danum
		// D_lama_belajar
		// D_dari_sekolah
		// D_alasan
		// D_kelas
		// D_kelompok
		// D_tanggal
		// D_saat_ini_tingkat
		// D_saat_ini_kelas
		// D_saat_ini_kelompok
		// D_no_psb
		// D_nilai_danum_sd
		// D_jumlah_pelajaran_danum
		// D_nilai_ujian_psb
		// D_tahun_psb
		// D_diterima
		// D_spp
		// D_spp_potongan
		// D_status_lama_baru
		// E_nama_ayah
		// E_tempat_lahir
		// E_tanggal_lahir
		// E_agama
		// E_kewarganegaraan
		// E_pendidikan
		// E_pekerjaan
		// E_pengeluaran
		// E_alamat
		// E_telepon
		// E_hp
		// E_hidup
		// F_nama_ibu
		// F_tempat_lahir
		// F_tanggal_lahir
		// F_agama
		// F_kewarganegaraan
		// F_pendidikan
		// F_pekerjaan
		// F_pengeluaran
		// F_alamat
		// F_telepon
		// F_hp
		// F_hidup
		// G_nama_wali
		// G_tempat_lahir
		// G_tanggal_lahir
		// G_agama
		// G_kewarganegaraan
		// G_pendidikan
		// G_pekerjaan
		// G_pengeluaran
		// G_alamat
		// G_telepon
		// G_hp
		// H_kesenian
		// H_olahraga
		// H_kemasyarakatan
		// H_lainlain
		// I_tanggal_meninggalkan
		// I_alasan
		// I_tanggal_lulus
		// I_sttb
		// I_danum
		// I_nilai_danum_smp
		// I_tahun1
		// I_tahun2
		// I_tahun3
		// I_tk1
		// I_tk2
		// I_tk3
		// I_dari1
		// I_dari2
		// I_dari3
		// J_melanjutkan
		// J_tanggal_bekerja
		// J_nama_perusahaan
		// J_penghasilan
		// kode_otomatis
		// apakah_valid

		if ($master_siswa->RowType == EW_ROWTYPE_VIEW) { // View row

			// no_absen
			$master_siswa->no_absen->ViewValue = $master_siswa->no_absen->CurrentValue;
			$master_siswa->no_absen->ViewCustomAttributes = "";

			// A_nis_nasional
			$master_siswa->A_nis_nasional->ViewValue = $master_siswa->A_nis_nasional->CurrentValue;
			$master_siswa->A_nis_nasional->ViewCustomAttributes = "";

			// A_nama_Lengkap
			$master_siswa->A_nama_Lengkap->ViewValue = $master_siswa->A_nama_Lengkap->CurrentValue;
			$master_siswa->A_nama_Lengkap->ViewCustomAttributes = "";

			// A_nama_panggilan
			$master_siswa->A_nama_panggilan->ViewValue = $master_siswa->A_nama_panggilan->CurrentValue;
			$master_siswa->A_nama_panggilan->ViewCustomAttributes = "";

			// A_jenis_kelamin
			$master_siswa->A_jenis_kelamin->ViewValue = $master_siswa->A_jenis_kelamin->CurrentValue;
			$master_siswa->A_jenis_kelamin->ViewCustomAttributes = "";

			// A_tempat_lahir
			$master_siswa->A_tempat_lahir->ViewValue = $master_siswa->A_tempat_lahir->CurrentValue;
			$master_siswa->A_tempat_lahir->ViewCustomAttributes = "";

			// A_tanggal_lahir
			$master_siswa->A_tanggal_lahir->ViewValue = $master_siswa->A_tanggal_lahir->CurrentValue;
			$master_siswa->A_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->A_tanggal_lahir->ViewValue, 7);
			$master_siswa->A_tanggal_lahir->ViewCustomAttributes = "";

			// A_agama
			if (strval($master_siswa->A_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->A_agama->CurrentValue) . "'";
			$sSqlWrk = "SELECT `agama` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$master_siswa->A_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->A_agama->ViewValue = $master_siswa->A_agama->CurrentValue;
				}
			} else {
				$master_siswa->A_agama->ViewValue = NULL;
			}
			$master_siswa->A_agama->ViewCustomAttributes = "";

			// A_kewarganegaraan
			$master_siswa->A_kewarganegaraan->ViewValue = $master_siswa->A_kewarganegaraan->CurrentValue;
			$master_siswa->A_kewarganegaraan->ViewCustomAttributes = "";

			// A_anak_keberapa
			$master_siswa->A_anak_keberapa->ViewValue = $master_siswa->A_anak_keberapa->CurrentValue;
			$master_siswa->A_anak_keberapa->ViewCustomAttributes = "";

			// A_jumlah_saudara_kandung
			$master_siswa->A_jumlah_saudara_kandung->ViewValue = $master_siswa->A_jumlah_saudara_kandung->CurrentValue;
			$master_siswa->A_jumlah_saudara_kandung->ViewCustomAttributes = "";

			// A_jumlah_saudara_tiri
			$master_siswa->A_jumlah_saudara_tiri->ViewValue = $master_siswa->A_jumlah_saudara_tiri->CurrentValue;
			$master_siswa->A_jumlah_saudara_tiri->ViewCustomAttributes = "";

			// A_jumlah_saudara_angkat
			$master_siswa->A_jumlah_saudara_angkat->ViewValue = $master_siswa->A_jumlah_saudara_angkat->CurrentValue;
			$master_siswa->A_jumlah_saudara_angkat->ViewCustomAttributes = "";

			// A_status_yatim
			$master_siswa->A_status_yatim->ViewValue = $master_siswa->A_status_yatim->CurrentValue;
			$master_siswa->A_status_yatim->ViewCustomAttributes = "";

			// A_bahasa
			$master_siswa->A_bahasa->ViewValue = $master_siswa->A_bahasa->CurrentValue;
			$master_siswa->A_bahasa->ViewCustomAttributes = "";

			// B_alamat
			$master_siswa->B_alamat->ViewValue = $master_siswa->B_alamat->CurrentValue;
			$master_siswa->B_alamat->ViewCustomAttributes = "";

			// B_telepon_rumah
			$master_siswa->B_telepon_rumah->ViewValue = $master_siswa->B_telepon_rumah->CurrentValue;
			$master_siswa->B_telepon_rumah->ViewCustomAttributes = "";

			// B_tinggal
			$master_siswa->B_tinggal->ViewValue = $master_siswa->B_tinggal->CurrentValue;
			$master_siswa->B_tinggal->ViewCustomAttributes = "";

			// B_jarak
			$master_siswa->B_jarak->ViewValue = $master_siswa->B_jarak->CurrentValue;
			$master_siswa->B_jarak->ViewCustomAttributes = "";

			// B_hp
			$master_siswa->B_hp->ViewValue = $master_siswa->B_hp->CurrentValue;
			$master_siswa->B_hp->ViewCustomAttributes = "";

			// C_golongan_darah
			$master_siswa->C_golongan_darah->ViewValue = $master_siswa->C_golongan_darah->CurrentValue;
			$master_siswa->C_golongan_darah->ViewCustomAttributes = "";

			// C_penyakit
			$master_siswa->C_penyakit->ViewValue = $master_siswa->C_penyakit->CurrentValue;
			$master_siswa->C_penyakit->ViewCustomAttributes = "";

			// C_jasmani
			$master_siswa->C_jasmani->ViewValue = $master_siswa->C_jasmani->CurrentValue;
			$master_siswa->C_jasmani->ViewCustomAttributes = "";

			// C_tinggi
			$master_siswa->C_tinggi->ViewValue = $master_siswa->C_tinggi->CurrentValue;
			$master_siswa->C_tinggi->ViewCustomAttributes = "";

			// C_berat
			$master_siswa->C_berat->ViewValue = $master_siswa->C_berat->CurrentValue;
			$master_siswa->C_berat->ViewCustomAttributes = "";

			// D_tamatan_dari
			$master_siswa->D_tamatan_dari->ViewValue = $master_siswa->D_tamatan_dari->CurrentValue;
			$master_siswa->D_tamatan_dari->ViewCustomAttributes = "";

			// D_sttb
			$master_siswa->D_sttb->ViewValue = $master_siswa->D_sttb->CurrentValue;
			$master_siswa->D_sttb->ViewCustomAttributes = "";

			// D_tanggal_sttb
			$master_siswa->D_tanggal_sttb->ViewValue = $master_siswa->D_tanggal_sttb->CurrentValue;
			$master_siswa->D_tanggal_sttb->ViewValue = ew_FormatDateTime($master_siswa->D_tanggal_sttb->ViewValue, 7);
			$master_siswa->D_tanggal_sttb->ViewCustomAttributes = "";

			// D_danum
			$master_siswa->D_danum->ViewValue = $master_siswa->D_danum->CurrentValue;
			$master_siswa->D_danum->ViewCustomAttributes = "";

			// D_tanggal_danum
			$master_siswa->D_tanggal_danum->ViewValue = $master_siswa->D_tanggal_danum->CurrentValue;
			$master_siswa->D_tanggal_danum->ViewValue = ew_FormatDateTime($master_siswa->D_tanggal_danum->ViewValue, 7);
			$master_siswa->D_tanggal_danum->ViewCustomAttributes = "";

			// D_lama_belajar
			$master_siswa->D_lama_belajar->ViewValue = $master_siswa->D_lama_belajar->CurrentValue;
			$master_siswa->D_lama_belajar->ViewCustomAttributes = "";

			// D_dari_sekolah
			$master_siswa->D_dari_sekolah->ViewValue = $master_siswa->D_dari_sekolah->CurrentValue;
			$master_siswa->D_dari_sekolah->ViewCustomAttributes = "";

			// D_alasan
			$master_siswa->D_alasan->ViewValue = $master_siswa->D_alasan->CurrentValue;
			$master_siswa->D_alasan->ViewCustomAttributes = "";

			// D_kelas
			$master_siswa->D_kelas->ViewValue = $master_siswa->D_kelas->CurrentValue;
			$master_siswa->D_kelas->ViewCustomAttributes = "";

			// D_kelompok
			$master_siswa->D_kelompok->ViewValue = $master_siswa->D_kelompok->CurrentValue;
			$master_siswa->D_kelompok->ViewCustomAttributes = "";

			// D_tanggal
			$master_siswa->D_tanggal->ViewValue = $master_siswa->D_tanggal->CurrentValue;
			$master_siswa->D_tanggal->ViewValue = ew_FormatDateTime($master_siswa->D_tanggal->ViewValue, 7);
			$master_siswa->D_tanggal->ViewCustomAttributes = "";

			// D_saat_ini_tingkat
			$master_siswa->D_saat_ini_tingkat->ViewValue = $master_siswa->D_saat_ini_tingkat->CurrentValue;
			$master_siswa->D_saat_ini_tingkat->ViewCustomAttributes = "";

			// D_saat_ini_kelas
			$master_siswa->D_saat_ini_kelas->ViewValue = $master_siswa->D_saat_ini_kelas->CurrentValue;
			$master_siswa->D_saat_ini_kelas->ViewCustomAttributes = "";

			// D_saat_ini_kelompok
			$master_siswa->D_saat_ini_kelompok->ViewValue = $master_siswa->D_saat_ini_kelompok->CurrentValue;
			$master_siswa->D_saat_ini_kelompok->ViewCustomAttributes = "";

			// D_no_psb
			$master_siswa->D_no_psb->ViewValue = $master_siswa->D_no_psb->CurrentValue;
			$master_siswa->D_no_psb->ViewCustomAttributes = "";

			// D_nilai_danum_sd
			$master_siswa->D_nilai_danum_sd->ViewValue = $master_siswa->D_nilai_danum_sd->CurrentValue;
			$master_siswa->D_nilai_danum_sd->ViewCustomAttributes = "";

			// D_jumlah_pelajaran_danum
			$master_siswa->D_jumlah_pelajaran_danum->ViewValue = $master_siswa->D_jumlah_pelajaran_danum->CurrentValue;
			$master_siswa->D_jumlah_pelajaran_danum->ViewCustomAttributes = "";

			// D_nilai_ujian_psb
			$master_siswa->D_nilai_ujian_psb->ViewValue = $master_siswa->D_nilai_ujian_psb->CurrentValue;
			$master_siswa->D_nilai_ujian_psb->ViewCustomAttributes = "";

			// D_tahun_psb
			$master_siswa->D_tahun_psb->ViewValue = $master_siswa->D_tahun_psb->CurrentValue;
			$master_siswa->D_tahun_psb->ViewCustomAttributes = "";

			// D_diterima
			$master_siswa->D_diterima->ViewValue = $master_siswa->D_diterima->CurrentValue;
			$master_siswa->D_diterima->ViewCustomAttributes = "";

			// D_spp
			$master_siswa->D_spp->ViewValue = $master_siswa->D_spp->CurrentValue;
			$master_siswa->D_spp->ViewCustomAttributes = "";

			// D_spp_potongan
			$master_siswa->D_spp_potongan->ViewValue = $master_siswa->D_spp_potongan->CurrentValue;
			$master_siswa->D_spp_potongan->ViewCustomAttributes = "";

			// D_status_lama_baru
			$master_siswa->D_status_lama_baru->ViewValue = $master_siswa->D_status_lama_baru->CurrentValue;
			$master_siswa->D_status_lama_baru->ViewCustomAttributes = "";

			// E_nama_ayah
			$master_siswa->E_nama_ayah->ViewValue = $master_siswa->E_nama_ayah->CurrentValue;
			$master_siswa->E_nama_ayah->ViewCustomAttributes = "";

			// E_tempat_lahir
			$master_siswa->E_tempat_lahir->ViewValue = $master_siswa->E_tempat_lahir->CurrentValue;
			$master_siswa->E_tempat_lahir->ViewCustomAttributes = "";

			// E_tanggal_lahir
			$master_siswa->E_tanggal_lahir->ViewValue = $master_siswa->E_tanggal_lahir->CurrentValue;
			$master_siswa->E_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->E_tanggal_lahir->ViewValue, 7);
			$master_siswa->E_tanggal_lahir->ViewCustomAttributes = "";

			// E_agama
			if (strval($master_siswa->E_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->E_agama->CurrentValue) . "'";
			$sSqlWrk = "SELECT `agama` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$master_siswa->E_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->E_agama->ViewValue = $master_siswa->E_agama->CurrentValue;
				}
			} else {
				$master_siswa->E_agama->ViewValue = NULL;
			}
			$master_siswa->E_agama->ViewCustomAttributes = "";

			// E_kewarganegaraan
			$master_siswa->E_kewarganegaraan->ViewValue = $master_siswa->E_kewarganegaraan->CurrentValue;
			$master_siswa->E_kewarganegaraan->ViewCustomAttributes = "";

			// E_pendidikan
			$master_siswa->E_pendidikan->ViewValue = $master_siswa->E_pendidikan->CurrentValue;
			$master_siswa->E_pendidikan->ViewCustomAttributes = "";

			// E_pekerjaan
			$master_siswa->E_pekerjaan->ViewValue = $master_siswa->E_pekerjaan->CurrentValue;
			$master_siswa->E_pekerjaan->ViewCustomAttributes = "";

			// E_pengeluaran
			$master_siswa->E_pengeluaran->ViewValue = $master_siswa->E_pengeluaran->CurrentValue;
			$master_siswa->E_pengeluaran->ViewCustomAttributes = "";

			// E_alamat
			$master_siswa->E_alamat->ViewValue = $master_siswa->E_alamat->CurrentValue;
			$master_siswa->E_alamat->ViewCustomAttributes = "";

			// E_telepon
			$master_siswa->E_telepon->ViewValue = $master_siswa->E_telepon->CurrentValue;
			$master_siswa->E_telepon->ViewCustomAttributes = "";

			// E_hp
			$master_siswa->E_hp->ViewValue = $master_siswa->E_hp->CurrentValue;
			$master_siswa->E_hp->ViewCustomAttributes = "";

			// E_hidup
			$master_siswa->E_hidup->ViewValue = $master_siswa->E_hidup->CurrentValue;
			$master_siswa->E_hidup->ViewCustomAttributes = "";

			// F_nama_ibu
			$master_siswa->F_nama_ibu->ViewValue = $master_siswa->F_nama_ibu->CurrentValue;
			$master_siswa->F_nama_ibu->ViewCustomAttributes = "";

			// F_tempat_lahir
			$master_siswa->F_tempat_lahir->ViewValue = $master_siswa->F_tempat_lahir->CurrentValue;
			$master_siswa->F_tempat_lahir->ViewCustomAttributes = "";

			// F_tanggal_lahir
			$master_siswa->F_tanggal_lahir->ViewValue = $master_siswa->F_tanggal_lahir->CurrentValue;
			$master_siswa->F_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->F_tanggal_lahir->ViewValue, 7);
			$master_siswa->F_tanggal_lahir->ViewCustomAttributes = "";

			// F_agama
			if (strval($master_siswa->F_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->F_agama->CurrentValue) . "'";
			$sSqlWrk = "SELECT `agama` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$master_siswa->F_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->F_agama->ViewValue = $master_siswa->F_agama->CurrentValue;
				}
			} else {
				$master_siswa->F_agama->ViewValue = NULL;
			}
			$master_siswa->F_agama->ViewCustomAttributes = "";

			// F_kewarganegaraan
			$master_siswa->F_kewarganegaraan->ViewValue = $master_siswa->F_kewarganegaraan->CurrentValue;
			$master_siswa->F_kewarganegaraan->ViewCustomAttributes = "";

			// F_pendidikan
			$master_siswa->F_pendidikan->ViewValue = $master_siswa->F_pendidikan->CurrentValue;
			$master_siswa->F_pendidikan->ViewCustomAttributes = "";

			// F_pekerjaan
			$master_siswa->F_pekerjaan->ViewValue = $master_siswa->F_pekerjaan->CurrentValue;
			$master_siswa->F_pekerjaan->ViewCustomAttributes = "";

			// F_pengeluaran
			$master_siswa->F_pengeluaran->ViewValue = $master_siswa->F_pengeluaran->CurrentValue;
			$master_siswa->F_pengeluaran->ViewCustomAttributes = "";

			// F_alamat
			$master_siswa->F_alamat->ViewValue = $master_siswa->F_alamat->CurrentValue;
			$master_siswa->F_alamat->ViewCustomAttributes = "";

			// F_telepon
			$master_siswa->F_telepon->ViewValue = $master_siswa->F_telepon->CurrentValue;
			$master_siswa->F_telepon->ViewCustomAttributes = "";

			// F_hp
			$master_siswa->F_hp->ViewValue = $master_siswa->F_hp->CurrentValue;
			$master_siswa->F_hp->ViewCustomAttributes = "";

			// F_hidup
			$master_siswa->F_hidup->ViewValue = $master_siswa->F_hidup->CurrentValue;
			$master_siswa->F_hidup->ViewCustomAttributes = "";

			// G_nama_wali
			$master_siswa->G_nama_wali->ViewValue = $master_siswa->G_nama_wali->CurrentValue;
			$master_siswa->G_nama_wali->ViewCustomAttributes = "";

			// G_tempat_lahir
			$master_siswa->G_tempat_lahir->ViewValue = $master_siswa->G_tempat_lahir->CurrentValue;
			$master_siswa->G_tempat_lahir->ViewCustomAttributes = "";

			// G_tanggal_lahir
			$master_siswa->G_tanggal_lahir->ViewValue = $master_siswa->G_tanggal_lahir->CurrentValue;
			$master_siswa->G_tanggal_lahir->ViewValue = ew_FormatDateTime($master_siswa->G_tanggal_lahir->ViewValue, 7);
			$master_siswa->G_tanggal_lahir->ViewCustomAttributes = "";

			// G_agama
			if (strval($master_siswa->G_agama->CurrentValue) <> "") {
				$sFilterWrk = "`agama` = '" . ew_AdjustSql($master_siswa->G_agama->CurrentValue) . "'";
			$sSqlWrk = "SELECT `agama` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$master_siswa->G_agama->ViewValue = $rswrk->fields('agama');
					$rswrk->Close();
				} else {
					$master_siswa->G_agama->ViewValue = $master_siswa->G_agama->CurrentValue;
				}
			} else {
				$master_siswa->G_agama->ViewValue = NULL;
			}
			$master_siswa->G_agama->ViewCustomAttributes = "";

			// G_kewarganegaraan
			$master_siswa->G_kewarganegaraan->ViewValue = $master_siswa->G_kewarganegaraan->CurrentValue;
			$master_siswa->G_kewarganegaraan->ViewCustomAttributes = "";

			// G_pendidikan
			$master_siswa->G_pendidikan->ViewValue = $master_siswa->G_pendidikan->CurrentValue;
			$master_siswa->G_pendidikan->ViewCustomAttributes = "";

			// G_pekerjaan
			$master_siswa->G_pekerjaan->ViewValue = $master_siswa->G_pekerjaan->CurrentValue;
			$master_siswa->G_pekerjaan->ViewCustomAttributes = "";

			// G_pengeluaran
			$master_siswa->G_pengeluaran->ViewValue = $master_siswa->G_pengeluaran->CurrentValue;
			$master_siswa->G_pengeluaran->ViewCustomAttributes = "";

			// G_alamat
			$master_siswa->G_alamat->ViewValue = $master_siswa->G_alamat->CurrentValue;
			$master_siswa->G_alamat->ViewCustomAttributes = "";

			// G_telepon
			$master_siswa->G_telepon->ViewValue = $master_siswa->G_telepon->CurrentValue;
			$master_siswa->G_telepon->ViewCustomAttributes = "";

			// G_hp
			$master_siswa->G_hp->ViewValue = $master_siswa->G_hp->CurrentValue;
			$master_siswa->G_hp->ViewCustomAttributes = "";

			// H_kesenian
			$master_siswa->H_kesenian->ViewValue = $master_siswa->H_kesenian->CurrentValue;
			$master_siswa->H_kesenian->ViewCustomAttributes = "";

			// H_olahraga
			$master_siswa->H_olahraga->ViewValue = $master_siswa->H_olahraga->CurrentValue;
			$master_siswa->H_olahraga->ViewCustomAttributes = "";

			// H_kemasyarakatan
			$master_siswa->H_kemasyarakatan->ViewValue = $master_siswa->H_kemasyarakatan->CurrentValue;
			$master_siswa->H_kemasyarakatan->ViewCustomAttributes = "";

			// H_lainlain
			$master_siswa->H_lainlain->ViewValue = $master_siswa->H_lainlain->CurrentValue;
			$master_siswa->H_lainlain->ViewCustomAttributes = "";

			// I_tanggal_meninggalkan
			$master_siswa->I_tanggal_meninggalkan->ViewValue = $master_siswa->I_tanggal_meninggalkan->CurrentValue;
			$master_siswa->I_tanggal_meninggalkan->ViewValue = ew_FormatDateTime($master_siswa->I_tanggal_meninggalkan->ViewValue, 7);
			$master_siswa->I_tanggal_meninggalkan->ViewCustomAttributes = "";

			// I_alasan
			$master_siswa->I_alasan->ViewValue = $master_siswa->I_alasan->CurrentValue;
			$master_siswa->I_alasan->ViewCustomAttributes = "";

			// I_tanggal_lulus
			$master_siswa->I_tanggal_lulus->ViewValue = $master_siswa->I_tanggal_lulus->CurrentValue;
			$master_siswa->I_tanggal_lulus->ViewValue = ew_FormatDateTime($master_siswa->I_tanggal_lulus->ViewValue, 7);
			$master_siswa->I_tanggal_lulus->ViewCustomAttributes = "";

			// I_sttb
			$master_siswa->I_sttb->ViewValue = $master_siswa->I_sttb->CurrentValue;
			$master_siswa->I_sttb->ViewCustomAttributes = "";

			// I_danum
			$master_siswa->I_danum->ViewValue = $master_siswa->I_danum->CurrentValue;
			$master_siswa->I_danum->ViewCustomAttributes = "";

			// I_nilai_danum_smp
			$master_siswa->I_nilai_danum_smp->ViewValue = $master_siswa->I_nilai_danum_smp->CurrentValue;
			$master_siswa->I_nilai_danum_smp->ViewCustomAttributes = "";

			// I_tahun1
			$master_siswa->I_tahun1->ViewValue = $master_siswa->I_tahun1->CurrentValue;
			$master_siswa->I_tahun1->ViewCustomAttributes = "";

			// I_tahun2
			$master_siswa->I_tahun2->ViewValue = $master_siswa->I_tahun2->CurrentValue;
			$master_siswa->I_tahun2->ViewCustomAttributes = "";

			// I_tahun3
			$master_siswa->I_tahun3->ViewValue = $master_siswa->I_tahun3->CurrentValue;
			$master_siswa->I_tahun3->ViewCustomAttributes = "";

			// I_tk1
			$master_siswa->I_tk1->ViewValue = $master_siswa->I_tk1->CurrentValue;
			$master_siswa->I_tk1->ViewCustomAttributes = "";

			// I_tk2
			$master_siswa->I_tk2->ViewValue = $master_siswa->I_tk2->CurrentValue;
			$master_siswa->I_tk2->ViewCustomAttributes = "";

			// I_tk3
			$master_siswa->I_tk3->ViewValue = $master_siswa->I_tk3->CurrentValue;
			$master_siswa->I_tk3->ViewCustomAttributes = "";

			// I_dari1
			$master_siswa->I_dari1->ViewValue = $master_siswa->I_dari1->CurrentValue;
			$master_siswa->I_dari1->ViewCustomAttributes = "";

			// I_dari2
			$master_siswa->I_dari2->ViewValue = $master_siswa->I_dari2->CurrentValue;
			$master_siswa->I_dari2->ViewCustomAttributes = "";

			// I_dari3
			$master_siswa->I_dari3->ViewValue = $master_siswa->I_dari3->CurrentValue;
			$master_siswa->I_dari3->ViewCustomAttributes = "";

			// J_melanjutkan
			$master_siswa->J_melanjutkan->ViewValue = $master_siswa->J_melanjutkan->CurrentValue;
			$master_siswa->J_melanjutkan->ViewCustomAttributes = "";

			// J_tanggal_bekerja
			$master_siswa->J_tanggal_bekerja->ViewValue = $master_siswa->J_tanggal_bekerja->CurrentValue;
			$master_siswa->J_tanggal_bekerja->ViewValue = ew_FormatDateTime($master_siswa->J_tanggal_bekerja->ViewValue, 7);
			$master_siswa->J_tanggal_bekerja->ViewCustomAttributes = "";

			// J_nama_perusahaan
			$master_siswa->J_nama_perusahaan->ViewValue = $master_siswa->J_nama_perusahaan->CurrentValue;
			$master_siswa->J_nama_perusahaan->ViewCustomAttributes = "";

			// J_penghasilan
			$master_siswa->J_penghasilan->ViewValue = $master_siswa->J_penghasilan->CurrentValue;
			$master_siswa->J_penghasilan->ViewCustomAttributes = "";

			// kode_otomatis
			$master_siswa->kode_otomatis->ViewValue = $master_siswa->kode_otomatis->CurrentValue;
			$master_siswa->kode_otomatis->ViewCustomAttributes = "";

			// apakah_valid
			if (strval($master_siswa->apakah_valid->CurrentValue) <> "") {
				switch ($master_siswa->apakah_valid->CurrentValue) {
					case "y":
						$master_siswa->apakah_valid->ViewValue = $master_siswa->apakah_valid->FldTagCaption(1) <> "" ? $master_siswa->apakah_valid->FldTagCaption(1) : $master_siswa->apakah_valid->CurrentValue;
						break;
					case "t":
						$master_siswa->apakah_valid->ViewValue = $master_siswa->apakah_valid->FldTagCaption(2) <> "" ? $master_siswa->apakah_valid->FldTagCaption(2) : $master_siswa->apakah_valid->CurrentValue;
						break;
					default:
						$master_siswa->apakah_valid->ViewValue = $master_siswa->apakah_valid->CurrentValue;
				}
			} else {
				$master_siswa->apakah_valid->ViewValue = NULL;
			}
			$master_siswa->apakah_valid->ViewCustomAttributes = "";

			// no_absen
			$master_siswa->no_absen->LinkCustomAttributes = "";
			$master_siswa->no_absen->HrefValue = "";
			$master_siswa->no_absen->TooltipValue = "";

			// A_nis_nasional
			$master_siswa->A_nis_nasional->LinkCustomAttributes = "";
			$master_siswa->A_nis_nasional->HrefValue = "";
			$master_siswa->A_nis_nasional->TooltipValue = "";

			// A_nama_Lengkap
			$master_siswa->A_nama_Lengkap->LinkCustomAttributes = "";
			$master_siswa->A_nama_Lengkap->HrefValue = "";
			$master_siswa->A_nama_Lengkap->TooltipValue = "";

			// A_nama_panggilan
			$master_siswa->A_nama_panggilan->LinkCustomAttributes = "";
			$master_siswa->A_nama_panggilan->HrefValue = "";
			$master_siswa->A_nama_panggilan->TooltipValue = "";

			// A_jenis_kelamin
			$master_siswa->A_jenis_kelamin->LinkCustomAttributes = "";
			$master_siswa->A_jenis_kelamin->HrefValue = "";
			$master_siswa->A_jenis_kelamin->TooltipValue = "";

			// A_tempat_lahir
			$master_siswa->A_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->A_tempat_lahir->HrefValue = "";
			$master_siswa->A_tempat_lahir->TooltipValue = "";

			// A_tanggal_lahir
			$master_siswa->A_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->A_tanggal_lahir->HrefValue = "";
			$master_siswa->A_tanggal_lahir->TooltipValue = "";

			// A_agama
			$master_siswa->A_agama->LinkCustomAttributes = "";
			$master_siswa->A_agama->HrefValue = "";
			$master_siswa->A_agama->TooltipValue = "";

			// A_kewarganegaraan
			$master_siswa->A_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->A_kewarganegaraan->HrefValue = "";
			$master_siswa->A_kewarganegaraan->TooltipValue = "";

			// A_anak_keberapa
			$master_siswa->A_anak_keberapa->LinkCustomAttributes = "";
			$master_siswa->A_anak_keberapa->HrefValue = "";
			$master_siswa->A_anak_keberapa->TooltipValue = "";

			// A_jumlah_saudara_kandung
			$master_siswa->A_jumlah_saudara_kandung->LinkCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_kandung->HrefValue = "";
			$master_siswa->A_jumlah_saudara_kandung->TooltipValue = "";

			// A_jumlah_saudara_tiri
			$master_siswa->A_jumlah_saudara_tiri->LinkCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_tiri->HrefValue = "";
			$master_siswa->A_jumlah_saudara_tiri->TooltipValue = "";

			// A_jumlah_saudara_angkat
			$master_siswa->A_jumlah_saudara_angkat->LinkCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_angkat->HrefValue = "";
			$master_siswa->A_jumlah_saudara_angkat->TooltipValue = "";

			// A_status_yatim
			$master_siswa->A_status_yatim->LinkCustomAttributes = "";
			$master_siswa->A_status_yatim->HrefValue = "";
			$master_siswa->A_status_yatim->TooltipValue = "";

			// A_bahasa
			$master_siswa->A_bahasa->LinkCustomAttributes = "";
			$master_siswa->A_bahasa->HrefValue = "";
			$master_siswa->A_bahasa->TooltipValue = "";

			// B_alamat
			$master_siswa->B_alamat->LinkCustomAttributes = "";
			$master_siswa->B_alamat->HrefValue = "";
			$master_siswa->B_alamat->TooltipValue = "";

			// B_telepon_rumah
			$master_siswa->B_telepon_rumah->LinkCustomAttributes = "";
			$master_siswa->B_telepon_rumah->HrefValue = "";
			$master_siswa->B_telepon_rumah->TooltipValue = "";

			// B_tinggal
			$master_siswa->B_tinggal->LinkCustomAttributes = "";
			$master_siswa->B_tinggal->HrefValue = "";
			$master_siswa->B_tinggal->TooltipValue = "";

			// B_jarak
			$master_siswa->B_jarak->LinkCustomAttributes = "";
			$master_siswa->B_jarak->HrefValue = "";
			$master_siswa->B_jarak->TooltipValue = "";

			// B_hp
			$master_siswa->B_hp->LinkCustomAttributes = "";
			$master_siswa->B_hp->HrefValue = "";
			$master_siswa->B_hp->TooltipValue = "";

			// C_golongan_darah
			$master_siswa->C_golongan_darah->LinkCustomAttributes = "";
			$master_siswa->C_golongan_darah->HrefValue = "";
			$master_siswa->C_golongan_darah->TooltipValue = "";

			// C_penyakit
			$master_siswa->C_penyakit->LinkCustomAttributes = "";
			$master_siswa->C_penyakit->HrefValue = "";
			$master_siswa->C_penyakit->TooltipValue = "";

			// C_jasmani
			$master_siswa->C_jasmani->LinkCustomAttributes = "";
			$master_siswa->C_jasmani->HrefValue = "";
			$master_siswa->C_jasmani->TooltipValue = "";

			// C_tinggi
			$master_siswa->C_tinggi->LinkCustomAttributes = "";
			$master_siswa->C_tinggi->HrefValue = "";
			$master_siswa->C_tinggi->TooltipValue = "";

			// C_berat
			$master_siswa->C_berat->LinkCustomAttributes = "";
			$master_siswa->C_berat->HrefValue = "";
			$master_siswa->C_berat->TooltipValue = "";

			// D_tamatan_dari
			$master_siswa->D_tamatan_dari->LinkCustomAttributes = "";
			$master_siswa->D_tamatan_dari->HrefValue = "";
			$master_siswa->D_tamatan_dari->TooltipValue = "";

			// D_sttb
			$master_siswa->D_sttb->LinkCustomAttributes = "";
			$master_siswa->D_sttb->HrefValue = "";
			$master_siswa->D_sttb->TooltipValue = "";

			// D_tanggal_sttb
			$master_siswa->D_tanggal_sttb->LinkCustomAttributes = "";
			$master_siswa->D_tanggal_sttb->HrefValue = "";
			$master_siswa->D_tanggal_sttb->TooltipValue = "";

			// D_danum
			$master_siswa->D_danum->LinkCustomAttributes = "";
			$master_siswa->D_danum->HrefValue = "";
			$master_siswa->D_danum->TooltipValue = "";

			// D_tanggal_danum
			$master_siswa->D_tanggal_danum->LinkCustomAttributes = "";
			$master_siswa->D_tanggal_danum->HrefValue = "";
			$master_siswa->D_tanggal_danum->TooltipValue = "";

			// D_lama_belajar
			$master_siswa->D_lama_belajar->LinkCustomAttributes = "";
			$master_siswa->D_lama_belajar->HrefValue = "";
			$master_siswa->D_lama_belajar->TooltipValue = "";

			// D_dari_sekolah
			$master_siswa->D_dari_sekolah->LinkCustomAttributes = "";
			$master_siswa->D_dari_sekolah->HrefValue = "";
			$master_siswa->D_dari_sekolah->TooltipValue = "";

			// D_alasan
			$master_siswa->D_alasan->LinkCustomAttributes = "";
			$master_siswa->D_alasan->HrefValue = "";
			$master_siswa->D_alasan->TooltipValue = "";

			// D_kelas
			$master_siswa->D_kelas->LinkCustomAttributes = "";
			$master_siswa->D_kelas->HrefValue = "";
			$master_siswa->D_kelas->TooltipValue = "";

			// D_kelompok
			$master_siswa->D_kelompok->LinkCustomAttributes = "";
			$master_siswa->D_kelompok->HrefValue = "";
			$master_siswa->D_kelompok->TooltipValue = "";

			// D_tanggal
			$master_siswa->D_tanggal->LinkCustomAttributes = "";
			$master_siswa->D_tanggal->HrefValue = "";
			$master_siswa->D_tanggal->TooltipValue = "";

			// D_saat_ini_tingkat
			$master_siswa->D_saat_ini_tingkat->LinkCustomAttributes = "";
			$master_siswa->D_saat_ini_tingkat->HrefValue = "";
			$master_siswa->D_saat_ini_tingkat->TooltipValue = "";

			// D_saat_ini_kelas
			$master_siswa->D_saat_ini_kelas->LinkCustomAttributes = "";
			$master_siswa->D_saat_ini_kelas->HrefValue = "";
			$master_siswa->D_saat_ini_kelas->TooltipValue = "";

			// D_saat_ini_kelompok
			$master_siswa->D_saat_ini_kelompok->LinkCustomAttributes = "";
			$master_siswa->D_saat_ini_kelompok->HrefValue = "";
			$master_siswa->D_saat_ini_kelompok->TooltipValue = "";

			// D_no_psb
			$master_siswa->D_no_psb->LinkCustomAttributes = "";
			$master_siswa->D_no_psb->HrefValue = "";
			$master_siswa->D_no_psb->TooltipValue = "";

			// D_nilai_danum_sd
			$master_siswa->D_nilai_danum_sd->LinkCustomAttributes = "";
			$master_siswa->D_nilai_danum_sd->HrefValue = "";
			$master_siswa->D_nilai_danum_sd->TooltipValue = "";

			// D_jumlah_pelajaran_danum
			$master_siswa->D_jumlah_pelajaran_danum->LinkCustomAttributes = "";
			$master_siswa->D_jumlah_pelajaran_danum->HrefValue = "";
			$master_siswa->D_jumlah_pelajaran_danum->TooltipValue = "";

			// D_nilai_ujian_psb
			$master_siswa->D_nilai_ujian_psb->LinkCustomAttributes = "";
			$master_siswa->D_nilai_ujian_psb->HrefValue = "";
			$master_siswa->D_nilai_ujian_psb->TooltipValue = "";

			// D_tahun_psb
			$master_siswa->D_tahun_psb->LinkCustomAttributes = "";
			$master_siswa->D_tahun_psb->HrefValue = "";
			$master_siswa->D_tahun_psb->TooltipValue = "";

			// D_diterima
			$master_siswa->D_diterima->LinkCustomAttributes = "";
			$master_siswa->D_diterima->HrefValue = "";
			$master_siswa->D_diterima->TooltipValue = "";

			// D_spp
			$master_siswa->D_spp->LinkCustomAttributes = "";
			$master_siswa->D_spp->HrefValue = "";
			$master_siswa->D_spp->TooltipValue = "";

			// D_spp_potongan
			$master_siswa->D_spp_potongan->LinkCustomAttributes = "";
			$master_siswa->D_spp_potongan->HrefValue = "";
			$master_siswa->D_spp_potongan->TooltipValue = "";

			// D_status_lama_baru
			$master_siswa->D_status_lama_baru->LinkCustomAttributes = "";
			$master_siswa->D_status_lama_baru->HrefValue = "";
			$master_siswa->D_status_lama_baru->TooltipValue = "";

			// E_nama_ayah
			$master_siswa->E_nama_ayah->LinkCustomAttributes = "";
			$master_siswa->E_nama_ayah->HrefValue = "";
			$master_siswa->E_nama_ayah->TooltipValue = "";

			// E_tempat_lahir
			$master_siswa->E_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->E_tempat_lahir->HrefValue = "";
			$master_siswa->E_tempat_lahir->TooltipValue = "";

			// E_tanggal_lahir
			$master_siswa->E_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->E_tanggal_lahir->HrefValue = "";
			$master_siswa->E_tanggal_lahir->TooltipValue = "";

			// E_agama
			$master_siswa->E_agama->LinkCustomAttributes = "";
			$master_siswa->E_agama->HrefValue = "";
			$master_siswa->E_agama->TooltipValue = "";

			// E_kewarganegaraan
			$master_siswa->E_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->E_kewarganegaraan->HrefValue = "";
			$master_siswa->E_kewarganegaraan->TooltipValue = "";

			// E_pendidikan
			$master_siswa->E_pendidikan->LinkCustomAttributes = "";
			$master_siswa->E_pendidikan->HrefValue = "";
			$master_siswa->E_pendidikan->TooltipValue = "";

			// E_pekerjaan
			$master_siswa->E_pekerjaan->LinkCustomAttributes = "";
			$master_siswa->E_pekerjaan->HrefValue = "";
			$master_siswa->E_pekerjaan->TooltipValue = "";

			// E_pengeluaran
			$master_siswa->E_pengeluaran->LinkCustomAttributes = "";
			$master_siswa->E_pengeluaran->HrefValue = "";
			$master_siswa->E_pengeluaran->TooltipValue = "";

			// E_alamat
			$master_siswa->E_alamat->LinkCustomAttributes = "";
			$master_siswa->E_alamat->HrefValue = "";
			$master_siswa->E_alamat->TooltipValue = "";

			// E_telepon
			$master_siswa->E_telepon->LinkCustomAttributes = "";
			$master_siswa->E_telepon->HrefValue = "";
			$master_siswa->E_telepon->TooltipValue = "";

			// E_hp
			$master_siswa->E_hp->LinkCustomAttributes = "";
			$master_siswa->E_hp->HrefValue = "";
			$master_siswa->E_hp->TooltipValue = "";

			// E_hidup
			$master_siswa->E_hidup->LinkCustomAttributes = "";
			$master_siswa->E_hidup->HrefValue = "";
			$master_siswa->E_hidup->TooltipValue = "";

			// F_nama_ibu
			$master_siswa->F_nama_ibu->LinkCustomAttributes = "";
			$master_siswa->F_nama_ibu->HrefValue = "";
			$master_siswa->F_nama_ibu->TooltipValue = "";

			// F_tempat_lahir
			$master_siswa->F_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->F_tempat_lahir->HrefValue = "";
			$master_siswa->F_tempat_lahir->TooltipValue = "";

			// F_tanggal_lahir
			$master_siswa->F_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->F_tanggal_lahir->HrefValue = "";
			$master_siswa->F_tanggal_lahir->TooltipValue = "";

			// F_agama
			$master_siswa->F_agama->LinkCustomAttributes = "";
			$master_siswa->F_agama->HrefValue = "";
			$master_siswa->F_agama->TooltipValue = "";

			// F_kewarganegaraan
			$master_siswa->F_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->F_kewarganegaraan->HrefValue = "";
			$master_siswa->F_kewarganegaraan->TooltipValue = "";

			// F_pendidikan
			$master_siswa->F_pendidikan->LinkCustomAttributes = "";
			$master_siswa->F_pendidikan->HrefValue = "";
			$master_siswa->F_pendidikan->TooltipValue = "";

			// F_pekerjaan
			$master_siswa->F_pekerjaan->LinkCustomAttributes = "";
			$master_siswa->F_pekerjaan->HrefValue = "";
			$master_siswa->F_pekerjaan->TooltipValue = "";

			// F_pengeluaran
			$master_siswa->F_pengeluaran->LinkCustomAttributes = "";
			$master_siswa->F_pengeluaran->HrefValue = "";
			$master_siswa->F_pengeluaran->TooltipValue = "";

			// F_alamat
			$master_siswa->F_alamat->LinkCustomAttributes = "";
			$master_siswa->F_alamat->HrefValue = "";
			$master_siswa->F_alamat->TooltipValue = "";

			// F_telepon
			$master_siswa->F_telepon->LinkCustomAttributes = "";
			$master_siswa->F_telepon->HrefValue = "";
			$master_siswa->F_telepon->TooltipValue = "";

			// F_hp
			$master_siswa->F_hp->LinkCustomAttributes = "";
			$master_siswa->F_hp->HrefValue = "";
			$master_siswa->F_hp->TooltipValue = "";

			// F_hidup
			$master_siswa->F_hidup->LinkCustomAttributes = "";
			$master_siswa->F_hidup->HrefValue = "";
			$master_siswa->F_hidup->TooltipValue = "";

			// G_nama_wali
			$master_siswa->G_nama_wali->LinkCustomAttributes = "";
			$master_siswa->G_nama_wali->HrefValue = "";
			$master_siswa->G_nama_wali->TooltipValue = "";

			// G_tempat_lahir
			$master_siswa->G_tempat_lahir->LinkCustomAttributes = "";
			$master_siswa->G_tempat_lahir->HrefValue = "";
			$master_siswa->G_tempat_lahir->TooltipValue = "";

			// G_tanggal_lahir
			$master_siswa->G_tanggal_lahir->LinkCustomAttributes = "";
			$master_siswa->G_tanggal_lahir->HrefValue = "";
			$master_siswa->G_tanggal_lahir->TooltipValue = "";

			// G_agama
			$master_siswa->G_agama->LinkCustomAttributes = "";
			$master_siswa->G_agama->HrefValue = "";
			$master_siswa->G_agama->TooltipValue = "";

			// G_kewarganegaraan
			$master_siswa->G_kewarganegaraan->LinkCustomAttributes = "";
			$master_siswa->G_kewarganegaraan->HrefValue = "";
			$master_siswa->G_kewarganegaraan->TooltipValue = "";

			// G_pendidikan
			$master_siswa->G_pendidikan->LinkCustomAttributes = "";
			$master_siswa->G_pendidikan->HrefValue = "";
			$master_siswa->G_pendidikan->TooltipValue = "";

			// G_pekerjaan
			$master_siswa->G_pekerjaan->LinkCustomAttributes = "";
			$master_siswa->G_pekerjaan->HrefValue = "";
			$master_siswa->G_pekerjaan->TooltipValue = "";

			// G_pengeluaran
			$master_siswa->G_pengeluaran->LinkCustomAttributes = "";
			$master_siswa->G_pengeluaran->HrefValue = "";
			$master_siswa->G_pengeluaran->TooltipValue = "";

			// G_alamat
			$master_siswa->G_alamat->LinkCustomAttributes = "";
			$master_siswa->G_alamat->HrefValue = "";
			$master_siswa->G_alamat->TooltipValue = "";

			// G_telepon
			$master_siswa->G_telepon->LinkCustomAttributes = "";
			$master_siswa->G_telepon->HrefValue = "";
			$master_siswa->G_telepon->TooltipValue = "";

			// G_hp
			$master_siswa->G_hp->LinkCustomAttributes = "";
			$master_siswa->G_hp->HrefValue = "";
			$master_siswa->G_hp->TooltipValue = "";

			// H_kesenian
			$master_siswa->H_kesenian->LinkCustomAttributes = "";
			$master_siswa->H_kesenian->HrefValue = "";
			$master_siswa->H_kesenian->TooltipValue = "";

			// H_olahraga
			$master_siswa->H_olahraga->LinkCustomAttributes = "";
			$master_siswa->H_olahraga->HrefValue = "";
			$master_siswa->H_olahraga->TooltipValue = "";

			// H_kemasyarakatan
			$master_siswa->H_kemasyarakatan->LinkCustomAttributes = "";
			$master_siswa->H_kemasyarakatan->HrefValue = "";
			$master_siswa->H_kemasyarakatan->TooltipValue = "";

			// H_lainlain
			$master_siswa->H_lainlain->LinkCustomAttributes = "";
			$master_siswa->H_lainlain->HrefValue = "";
			$master_siswa->H_lainlain->TooltipValue = "";

			// I_tanggal_meninggalkan
			$master_siswa->I_tanggal_meninggalkan->LinkCustomAttributes = "";
			$master_siswa->I_tanggal_meninggalkan->HrefValue = "";
			$master_siswa->I_tanggal_meninggalkan->TooltipValue = "";

			// I_alasan
			$master_siswa->I_alasan->LinkCustomAttributes = "";
			$master_siswa->I_alasan->HrefValue = "";
			$master_siswa->I_alasan->TooltipValue = "";

			// I_tanggal_lulus
			$master_siswa->I_tanggal_lulus->LinkCustomAttributes = "";
			$master_siswa->I_tanggal_lulus->HrefValue = "";
			$master_siswa->I_tanggal_lulus->TooltipValue = "";

			// I_sttb
			$master_siswa->I_sttb->LinkCustomAttributes = "";
			$master_siswa->I_sttb->HrefValue = "";
			$master_siswa->I_sttb->TooltipValue = "";

			// I_danum
			$master_siswa->I_danum->LinkCustomAttributes = "";
			$master_siswa->I_danum->HrefValue = "";
			$master_siswa->I_danum->TooltipValue = "";

			// I_nilai_danum_smp
			$master_siswa->I_nilai_danum_smp->LinkCustomAttributes = "";
			$master_siswa->I_nilai_danum_smp->HrefValue = "";
			$master_siswa->I_nilai_danum_smp->TooltipValue = "";

			// I_tahun1
			$master_siswa->I_tahun1->LinkCustomAttributes = "";
			$master_siswa->I_tahun1->HrefValue = "";
			$master_siswa->I_tahun1->TooltipValue = "";

			// I_tahun2
			$master_siswa->I_tahun2->LinkCustomAttributes = "";
			$master_siswa->I_tahun2->HrefValue = "";
			$master_siswa->I_tahun2->TooltipValue = "";

			// I_tahun3
			$master_siswa->I_tahun3->LinkCustomAttributes = "";
			$master_siswa->I_tahun3->HrefValue = "";
			$master_siswa->I_tahun3->TooltipValue = "";

			// I_tk1
			$master_siswa->I_tk1->LinkCustomAttributes = "";
			$master_siswa->I_tk1->HrefValue = "";
			$master_siswa->I_tk1->TooltipValue = "";

			// I_tk2
			$master_siswa->I_tk2->LinkCustomAttributes = "";
			$master_siswa->I_tk2->HrefValue = "";
			$master_siswa->I_tk2->TooltipValue = "";

			// I_tk3
			$master_siswa->I_tk3->LinkCustomAttributes = "";
			$master_siswa->I_tk3->HrefValue = "";
			$master_siswa->I_tk3->TooltipValue = "";

			// I_dari1
			$master_siswa->I_dari1->LinkCustomAttributes = "";
			$master_siswa->I_dari1->HrefValue = "";
			$master_siswa->I_dari1->TooltipValue = "";

			// I_dari2
			$master_siswa->I_dari2->LinkCustomAttributes = "";
			$master_siswa->I_dari2->HrefValue = "";
			$master_siswa->I_dari2->TooltipValue = "";

			// I_dari3
			$master_siswa->I_dari3->LinkCustomAttributes = "";
			$master_siswa->I_dari3->HrefValue = "";
			$master_siswa->I_dari3->TooltipValue = "";

			// J_melanjutkan
			$master_siswa->J_melanjutkan->LinkCustomAttributes = "";
			$master_siswa->J_melanjutkan->HrefValue = "";
			$master_siswa->J_melanjutkan->TooltipValue = "";

			// J_tanggal_bekerja
			$master_siswa->J_tanggal_bekerja->LinkCustomAttributes = "";
			$master_siswa->J_tanggal_bekerja->HrefValue = "";
			$master_siswa->J_tanggal_bekerja->TooltipValue = "";

			// J_nama_perusahaan
			$master_siswa->J_nama_perusahaan->LinkCustomAttributes = "";
			$master_siswa->J_nama_perusahaan->HrefValue = "";
			$master_siswa->J_nama_perusahaan->TooltipValue = "";

			// J_penghasilan
			$master_siswa->J_penghasilan->LinkCustomAttributes = "";
			$master_siswa->J_penghasilan->HrefValue = "";
			$master_siswa->J_penghasilan->TooltipValue = "";

			// kode_otomatis
			$master_siswa->kode_otomatis->LinkCustomAttributes = "";
			$master_siswa->kode_otomatis->HrefValue = "";
			$master_siswa->kode_otomatis->TooltipValue = "";

			// apakah_valid
			$master_siswa->apakah_valid->LinkCustomAttributes = "";
			$master_siswa->apakah_valid->HrefValue = "";
			$master_siswa->apakah_valid->TooltipValue = "";
		} elseif ($master_siswa->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// no_absen
			$master_siswa->no_absen->EditCustomAttributes = "";
			$master_siswa->no_absen->EditValue = ew_HtmlEncode($master_siswa->no_absen->AdvancedSearch->SearchValue);
			$master_siswa->no_absen->EditCustomAttributes = "";
			$master_siswa->no_absen->EditValue2 = ew_HtmlEncode($master_siswa->no_absen->AdvancedSearch->SearchValue2);

			// A_nis_nasional
			$master_siswa->A_nis_nasional->EditCustomAttributes = "";
			$master_siswa->A_nis_nasional->EditValue = ew_HtmlEncode($master_siswa->A_nis_nasional->AdvancedSearch->SearchValue);
			$master_siswa->A_nis_nasional->EditCustomAttributes = "";
			$master_siswa->A_nis_nasional->EditValue2 = ew_HtmlEncode($master_siswa->A_nis_nasional->AdvancedSearch->SearchValue2);

			// A_nama_Lengkap
			$master_siswa->A_nama_Lengkap->EditCustomAttributes = "";
			$master_siswa->A_nama_Lengkap->EditValue = ew_HtmlEncode($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchValue);
			$master_siswa->A_nama_Lengkap->EditCustomAttributes = "";
			$master_siswa->A_nama_Lengkap->EditValue2 = ew_HtmlEncode($master_siswa->A_nama_Lengkap->AdvancedSearch->SearchValue2);

			// A_nama_panggilan
			$master_siswa->A_nama_panggilan->EditCustomAttributes = "";
			$master_siswa->A_nama_panggilan->EditValue = ew_HtmlEncode($master_siswa->A_nama_panggilan->AdvancedSearch->SearchValue);
			$master_siswa->A_nama_panggilan->EditCustomAttributes = "";
			$master_siswa->A_nama_panggilan->EditValue2 = ew_HtmlEncode($master_siswa->A_nama_panggilan->AdvancedSearch->SearchValue2);

			// A_jenis_kelamin
			$master_siswa->A_jenis_kelamin->EditCustomAttributes = "";
			$master_siswa->A_jenis_kelamin->EditValue = ew_HtmlEncode($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchValue);
			$master_siswa->A_jenis_kelamin->EditCustomAttributes = "";
			$master_siswa->A_jenis_kelamin->EditValue2 = ew_HtmlEncode($master_siswa->A_jenis_kelamin->AdvancedSearch->SearchValue2);

			// A_tempat_lahir
			$master_siswa->A_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->A_tempat_lahir->EditValue = ew_HtmlEncode($master_siswa->A_tempat_lahir->AdvancedSearch->SearchValue);
			$master_siswa->A_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->A_tempat_lahir->EditValue2 = ew_HtmlEncode($master_siswa->A_tempat_lahir->AdvancedSearch->SearchValue2);

			// A_tanggal_lahir
			$master_siswa->A_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->A_tanggal_lahir->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue, 7), 7));
			$master_siswa->A_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->A_tanggal_lahir->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue2, 7), 7));

			// A_agama
			$master_siswa->A_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->A_agama->EditValue = $arwrk;
			$master_siswa->A_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->A_agama->EditValue2 = $arwrk;

			// A_kewarganegaraan
			$master_siswa->A_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->A_kewarganegaraan->EditValue = ew_HtmlEncode($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchValue);
			$master_siswa->A_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->A_kewarganegaraan->EditValue2 = ew_HtmlEncode($master_siswa->A_kewarganegaraan->AdvancedSearch->SearchValue2);

			// A_anak_keberapa
			$master_siswa->A_anak_keberapa->EditCustomAttributes = "";
			$master_siswa->A_anak_keberapa->EditValue = ew_HtmlEncode($master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue);
			$master_siswa->A_anak_keberapa->EditCustomAttributes = "";
			$master_siswa->A_anak_keberapa->EditValue2 = ew_HtmlEncode($master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue2);

			// A_jumlah_saudara_kandung
			$master_siswa->A_jumlah_saudara_kandung->EditCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_kandung->EditValue = ew_HtmlEncode($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue);
			$master_siswa->A_jumlah_saudara_kandung->EditCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_kandung->EditValue2 = ew_HtmlEncode($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue2);

			// A_jumlah_saudara_tiri
			$master_siswa->A_jumlah_saudara_tiri->EditCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_tiri->EditValue = ew_HtmlEncode($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue);
			$master_siswa->A_jumlah_saudara_tiri->EditCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_tiri->EditValue2 = ew_HtmlEncode($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue2);

			// A_jumlah_saudara_angkat
			$master_siswa->A_jumlah_saudara_angkat->EditCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_angkat->EditValue = ew_HtmlEncode($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue);
			$master_siswa->A_jumlah_saudara_angkat->EditCustomAttributes = "";
			$master_siswa->A_jumlah_saudara_angkat->EditValue2 = ew_HtmlEncode($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue2);

			// A_status_yatim
			$master_siswa->A_status_yatim->EditCustomAttributes = "";
			$master_siswa->A_status_yatim->EditValue = ew_HtmlEncode($master_siswa->A_status_yatim->AdvancedSearch->SearchValue);
			$master_siswa->A_status_yatim->EditCustomAttributes = "";
			$master_siswa->A_status_yatim->EditValue2 = ew_HtmlEncode($master_siswa->A_status_yatim->AdvancedSearch->SearchValue2);

			// A_bahasa
			$master_siswa->A_bahasa->EditCustomAttributes = "";
			$master_siswa->A_bahasa->EditValue = ew_HtmlEncode($master_siswa->A_bahasa->AdvancedSearch->SearchValue);
			$master_siswa->A_bahasa->EditCustomAttributes = "";
			$master_siswa->A_bahasa->EditValue2 = ew_HtmlEncode($master_siswa->A_bahasa->AdvancedSearch->SearchValue2);

			// B_alamat
			$master_siswa->B_alamat->EditCustomAttributes = "";
			$master_siswa->B_alamat->EditValue = ew_HtmlEncode($master_siswa->B_alamat->AdvancedSearch->SearchValue);
			$master_siswa->B_alamat->EditCustomAttributes = "";
			$master_siswa->B_alamat->EditValue2 = ew_HtmlEncode($master_siswa->B_alamat->AdvancedSearch->SearchValue2);

			// B_telepon_rumah
			$master_siswa->B_telepon_rumah->EditCustomAttributes = "";
			$master_siswa->B_telepon_rumah->EditValue = ew_HtmlEncode($master_siswa->B_telepon_rumah->AdvancedSearch->SearchValue);
			$master_siswa->B_telepon_rumah->EditCustomAttributes = "";
			$master_siswa->B_telepon_rumah->EditValue2 = ew_HtmlEncode($master_siswa->B_telepon_rumah->AdvancedSearch->SearchValue2);

			// B_tinggal
			$master_siswa->B_tinggal->EditCustomAttributes = "";
			$master_siswa->B_tinggal->EditValue = ew_HtmlEncode($master_siswa->B_tinggal->AdvancedSearch->SearchValue);
			$master_siswa->B_tinggal->EditCustomAttributes = "";
			$master_siswa->B_tinggal->EditValue2 = ew_HtmlEncode($master_siswa->B_tinggal->AdvancedSearch->SearchValue2);

			// B_jarak
			$master_siswa->B_jarak->EditCustomAttributes = "";
			$master_siswa->B_jarak->EditValue = ew_HtmlEncode($master_siswa->B_jarak->AdvancedSearch->SearchValue);
			$master_siswa->B_jarak->EditCustomAttributes = "";
			$master_siswa->B_jarak->EditValue2 = ew_HtmlEncode($master_siswa->B_jarak->AdvancedSearch->SearchValue2);

			// B_hp
			$master_siswa->B_hp->EditCustomAttributes = "";
			$master_siswa->B_hp->EditValue = ew_HtmlEncode($master_siswa->B_hp->AdvancedSearch->SearchValue);
			$master_siswa->B_hp->EditCustomAttributes = "";
			$master_siswa->B_hp->EditValue2 = ew_HtmlEncode($master_siswa->B_hp->AdvancedSearch->SearchValue2);

			// C_golongan_darah
			$master_siswa->C_golongan_darah->EditCustomAttributes = "";
			$master_siswa->C_golongan_darah->EditValue = ew_HtmlEncode($master_siswa->C_golongan_darah->AdvancedSearch->SearchValue);
			$master_siswa->C_golongan_darah->EditCustomAttributes = "";
			$master_siswa->C_golongan_darah->EditValue2 = ew_HtmlEncode($master_siswa->C_golongan_darah->AdvancedSearch->SearchValue2);

			// C_penyakit
			$master_siswa->C_penyakit->EditCustomAttributes = "";
			$master_siswa->C_penyakit->EditValue = ew_HtmlEncode($master_siswa->C_penyakit->AdvancedSearch->SearchValue);
			$master_siswa->C_penyakit->EditCustomAttributes = "";
			$master_siswa->C_penyakit->EditValue2 = ew_HtmlEncode($master_siswa->C_penyakit->AdvancedSearch->SearchValue2);

			// C_jasmani
			$master_siswa->C_jasmani->EditCustomAttributes = "";
			$master_siswa->C_jasmani->EditValue = ew_HtmlEncode($master_siswa->C_jasmani->AdvancedSearch->SearchValue);
			$master_siswa->C_jasmani->EditCustomAttributes = "";
			$master_siswa->C_jasmani->EditValue2 = ew_HtmlEncode($master_siswa->C_jasmani->AdvancedSearch->SearchValue2);

			// C_tinggi
			$master_siswa->C_tinggi->EditCustomAttributes = "";
			$master_siswa->C_tinggi->EditValue = ew_HtmlEncode($master_siswa->C_tinggi->AdvancedSearch->SearchValue);
			$master_siswa->C_tinggi->EditCustomAttributes = "";
			$master_siswa->C_tinggi->EditValue2 = ew_HtmlEncode($master_siswa->C_tinggi->AdvancedSearch->SearchValue2);

			// C_berat
			$master_siswa->C_berat->EditCustomAttributes = "";
			$master_siswa->C_berat->EditValue = ew_HtmlEncode($master_siswa->C_berat->AdvancedSearch->SearchValue);
			$master_siswa->C_berat->EditCustomAttributes = "";
			$master_siswa->C_berat->EditValue2 = ew_HtmlEncode($master_siswa->C_berat->AdvancedSearch->SearchValue2);

			// D_tamatan_dari
			$master_siswa->D_tamatan_dari->EditCustomAttributes = "";
			$master_siswa->D_tamatan_dari->EditValue = ew_HtmlEncode($master_siswa->D_tamatan_dari->AdvancedSearch->SearchValue);
			$master_siswa->D_tamatan_dari->EditCustomAttributes = "";
			$master_siswa->D_tamatan_dari->EditValue2 = ew_HtmlEncode($master_siswa->D_tamatan_dari->AdvancedSearch->SearchValue2);

			// D_sttb
			$master_siswa->D_sttb->EditCustomAttributes = "";
			$master_siswa->D_sttb->EditValue = ew_HtmlEncode($master_siswa->D_sttb->AdvancedSearch->SearchValue);
			$master_siswa->D_sttb->EditCustomAttributes = "";
			$master_siswa->D_sttb->EditValue2 = ew_HtmlEncode($master_siswa->D_sttb->AdvancedSearch->SearchValue2);

			// D_tanggal_sttb
			$master_siswa->D_tanggal_sttb->EditCustomAttributes = "";
			$master_siswa->D_tanggal_sttb->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue, 7), 7));
			$master_siswa->D_tanggal_sttb->EditCustomAttributes = "";
			$master_siswa->D_tanggal_sttb->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue2, 7), 7));

			// D_danum
			$master_siswa->D_danum->EditCustomAttributes = "";
			$master_siswa->D_danum->EditValue = ew_HtmlEncode($master_siswa->D_danum->AdvancedSearch->SearchValue);
			$master_siswa->D_danum->EditCustomAttributes = "";
			$master_siswa->D_danum->EditValue2 = ew_HtmlEncode($master_siswa->D_danum->AdvancedSearch->SearchValue2);

			// D_tanggal_danum
			$master_siswa->D_tanggal_danum->EditCustomAttributes = "";
			$master_siswa->D_tanggal_danum->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue, 7), 7));
			$master_siswa->D_tanggal_danum->EditCustomAttributes = "";
			$master_siswa->D_tanggal_danum->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue2, 7), 7));

			// D_lama_belajar
			$master_siswa->D_lama_belajar->EditCustomAttributes = "";
			$master_siswa->D_lama_belajar->EditValue = ew_HtmlEncode($master_siswa->D_lama_belajar->AdvancedSearch->SearchValue);
			$master_siswa->D_lama_belajar->EditCustomAttributes = "";
			$master_siswa->D_lama_belajar->EditValue2 = ew_HtmlEncode($master_siswa->D_lama_belajar->AdvancedSearch->SearchValue2);

			// D_dari_sekolah
			$master_siswa->D_dari_sekolah->EditCustomAttributes = "";
			$master_siswa->D_dari_sekolah->EditValue = ew_HtmlEncode($master_siswa->D_dari_sekolah->AdvancedSearch->SearchValue);
			$master_siswa->D_dari_sekolah->EditCustomAttributes = "";
			$master_siswa->D_dari_sekolah->EditValue2 = ew_HtmlEncode($master_siswa->D_dari_sekolah->AdvancedSearch->SearchValue2);

			// D_alasan
			$master_siswa->D_alasan->EditCustomAttributes = "";
			$master_siswa->D_alasan->EditValue = ew_HtmlEncode($master_siswa->D_alasan->AdvancedSearch->SearchValue);
			$master_siswa->D_alasan->EditCustomAttributes = "";
			$master_siswa->D_alasan->EditValue2 = ew_HtmlEncode($master_siswa->D_alasan->AdvancedSearch->SearchValue2);

			// D_kelas
			$master_siswa->D_kelas->EditCustomAttributes = "";
			$master_siswa->D_kelas->EditValue = ew_HtmlEncode($master_siswa->D_kelas->AdvancedSearch->SearchValue);
			$master_siswa->D_kelas->EditCustomAttributes = "";
			$master_siswa->D_kelas->EditValue2 = ew_HtmlEncode($master_siswa->D_kelas->AdvancedSearch->SearchValue2);

			// D_kelompok
			$master_siswa->D_kelompok->EditCustomAttributes = "";
			$master_siswa->D_kelompok->EditValue = ew_HtmlEncode($master_siswa->D_kelompok->AdvancedSearch->SearchValue);
			$master_siswa->D_kelompok->EditCustomAttributes = "";
			$master_siswa->D_kelompok->EditValue2 = ew_HtmlEncode($master_siswa->D_kelompok->AdvancedSearch->SearchValue2);

			// D_tanggal
			$master_siswa->D_tanggal->EditCustomAttributes = "";
			$master_siswa->D_tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->D_tanggal->AdvancedSearch->SearchValue, 7), 7));
			$master_siswa->D_tanggal->EditCustomAttributes = "";
			$master_siswa->D_tanggal->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->D_tanggal->AdvancedSearch->SearchValue2, 7), 7));

			// D_saat_ini_tingkat
			$master_siswa->D_saat_ini_tingkat->EditCustomAttributes = "";
			$master_siswa->D_saat_ini_tingkat->EditValue = ew_HtmlEncode($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchValue);
			$master_siswa->D_saat_ini_tingkat->EditCustomAttributes = "";
			$master_siswa->D_saat_ini_tingkat->EditValue2 = ew_HtmlEncode($master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchValue2);

			// D_saat_ini_kelas
			$master_siswa->D_saat_ini_kelas->EditCustomAttributes = "";
			$master_siswa->D_saat_ini_kelas->EditValue = ew_HtmlEncode($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchValue);
			$master_siswa->D_saat_ini_kelas->EditCustomAttributes = "";
			$master_siswa->D_saat_ini_kelas->EditValue2 = ew_HtmlEncode($master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchValue2);

			// D_saat_ini_kelompok
			$master_siswa->D_saat_ini_kelompok->EditCustomAttributes = "";
			$master_siswa->D_saat_ini_kelompok->EditValue = ew_HtmlEncode($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchValue);
			$master_siswa->D_saat_ini_kelompok->EditCustomAttributes = "";
			$master_siswa->D_saat_ini_kelompok->EditValue2 = ew_HtmlEncode($master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchValue2);

			// D_no_psb
			$master_siswa->D_no_psb->EditCustomAttributes = "";
			$master_siswa->D_no_psb->EditValue = ew_HtmlEncode($master_siswa->D_no_psb->AdvancedSearch->SearchValue);
			$master_siswa->D_no_psb->EditCustomAttributes = "";
			$master_siswa->D_no_psb->EditValue2 = ew_HtmlEncode($master_siswa->D_no_psb->AdvancedSearch->SearchValue2);

			// D_nilai_danum_sd
			$master_siswa->D_nilai_danum_sd->EditCustomAttributes = "";
			$master_siswa->D_nilai_danum_sd->EditValue = ew_HtmlEncode($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue);
			$master_siswa->D_nilai_danum_sd->EditCustomAttributes = "";
			$master_siswa->D_nilai_danum_sd->EditValue2 = ew_HtmlEncode($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue2);

			// D_jumlah_pelajaran_danum
			$master_siswa->D_jumlah_pelajaran_danum->EditCustomAttributes = "";
			$master_siswa->D_jumlah_pelajaran_danum->EditValue = ew_HtmlEncode($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue);
			$master_siswa->D_jumlah_pelajaran_danum->EditCustomAttributes = "";
			$master_siswa->D_jumlah_pelajaran_danum->EditValue2 = ew_HtmlEncode($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue2);

			// D_nilai_ujian_psb
			$master_siswa->D_nilai_ujian_psb->EditCustomAttributes = "";
			$master_siswa->D_nilai_ujian_psb->EditValue = ew_HtmlEncode($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue);
			$master_siswa->D_nilai_ujian_psb->EditCustomAttributes = "";
			$master_siswa->D_nilai_ujian_psb->EditValue2 = ew_HtmlEncode($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue2);

			// D_tahun_psb
			$master_siswa->D_tahun_psb->EditCustomAttributes = "";
			$master_siswa->D_tahun_psb->EditValue = ew_HtmlEncode($master_siswa->D_tahun_psb->AdvancedSearch->SearchValue);
			$master_siswa->D_tahun_psb->EditCustomAttributes = "";
			$master_siswa->D_tahun_psb->EditValue2 = ew_HtmlEncode($master_siswa->D_tahun_psb->AdvancedSearch->SearchValue2);

			// D_diterima
			$master_siswa->D_diterima->EditCustomAttributes = "";
			$master_siswa->D_diterima->EditValue = ew_HtmlEncode($master_siswa->D_diterima->AdvancedSearch->SearchValue);
			$master_siswa->D_diterima->EditCustomAttributes = "";
			$master_siswa->D_diterima->EditValue2 = ew_HtmlEncode($master_siswa->D_diterima->AdvancedSearch->SearchValue2);

			// D_spp
			$master_siswa->D_spp->EditCustomAttributes = "";
			$master_siswa->D_spp->EditValue = ew_HtmlEncode($master_siswa->D_spp->AdvancedSearch->SearchValue);
			$master_siswa->D_spp->EditCustomAttributes = "";
			$master_siswa->D_spp->EditValue2 = ew_HtmlEncode($master_siswa->D_spp->AdvancedSearch->SearchValue2);

			// D_spp_potongan
			$master_siswa->D_spp_potongan->EditCustomAttributes = "";
			$master_siswa->D_spp_potongan->EditValue = ew_HtmlEncode($master_siswa->D_spp_potongan->AdvancedSearch->SearchValue);
			$master_siswa->D_spp_potongan->EditCustomAttributes = "";
			$master_siswa->D_spp_potongan->EditValue2 = ew_HtmlEncode($master_siswa->D_spp_potongan->AdvancedSearch->SearchValue2);

			// D_status_lama_baru
			$master_siswa->D_status_lama_baru->EditCustomAttributes = "";
			$master_siswa->D_status_lama_baru->EditValue = ew_HtmlEncode($master_siswa->D_status_lama_baru->AdvancedSearch->SearchValue);
			$master_siswa->D_status_lama_baru->EditCustomAttributes = "";
			$master_siswa->D_status_lama_baru->EditValue2 = ew_HtmlEncode($master_siswa->D_status_lama_baru->AdvancedSearch->SearchValue2);

			// E_nama_ayah
			$master_siswa->E_nama_ayah->EditCustomAttributes = "";
			$master_siswa->E_nama_ayah->EditValue = ew_HtmlEncode($master_siswa->E_nama_ayah->AdvancedSearch->SearchValue);
			$master_siswa->E_nama_ayah->EditCustomAttributes = "";
			$master_siswa->E_nama_ayah->EditValue2 = ew_HtmlEncode($master_siswa->E_nama_ayah->AdvancedSearch->SearchValue2);

			// E_tempat_lahir
			$master_siswa->E_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->E_tempat_lahir->EditValue = ew_HtmlEncode($master_siswa->E_tempat_lahir->AdvancedSearch->SearchValue);
			$master_siswa->E_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->E_tempat_lahir->EditValue2 = ew_HtmlEncode($master_siswa->E_tempat_lahir->AdvancedSearch->SearchValue2);

			// E_tanggal_lahir
			$master_siswa->E_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->E_tanggal_lahir->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue, 7), 7));
			$master_siswa->E_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->E_tanggal_lahir->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue2, 7), 7));

			// E_agama
			$master_siswa->E_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->E_agama->EditValue = $arwrk;
			$master_siswa->E_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->E_agama->EditValue2 = $arwrk;

			// E_kewarganegaraan
			$master_siswa->E_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->E_kewarganegaraan->EditValue = ew_HtmlEncode($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchValue);
			$master_siswa->E_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->E_kewarganegaraan->EditValue2 = ew_HtmlEncode($master_siswa->E_kewarganegaraan->AdvancedSearch->SearchValue2);

			// E_pendidikan
			$master_siswa->E_pendidikan->EditCustomAttributes = "";
			$master_siswa->E_pendidikan->EditValue = ew_HtmlEncode($master_siswa->E_pendidikan->AdvancedSearch->SearchValue);
			$master_siswa->E_pendidikan->EditCustomAttributes = "";
			$master_siswa->E_pendidikan->EditValue2 = ew_HtmlEncode($master_siswa->E_pendidikan->AdvancedSearch->SearchValue2);

			// E_pekerjaan
			$master_siswa->E_pekerjaan->EditCustomAttributes = "";
			$master_siswa->E_pekerjaan->EditValue = ew_HtmlEncode($master_siswa->E_pekerjaan->AdvancedSearch->SearchValue);
			$master_siswa->E_pekerjaan->EditCustomAttributes = "";
			$master_siswa->E_pekerjaan->EditValue2 = ew_HtmlEncode($master_siswa->E_pekerjaan->AdvancedSearch->SearchValue2);

			// E_pengeluaran
			$master_siswa->E_pengeluaran->EditCustomAttributes = "";
			$master_siswa->E_pengeluaran->EditValue = ew_HtmlEncode($master_siswa->E_pengeluaran->AdvancedSearch->SearchValue);
			$master_siswa->E_pengeluaran->EditCustomAttributes = "";
			$master_siswa->E_pengeluaran->EditValue2 = ew_HtmlEncode($master_siswa->E_pengeluaran->AdvancedSearch->SearchValue2);

			// E_alamat
			$master_siswa->E_alamat->EditCustomAttributes = "";
			$master_siswa->E_alamat->EditValue = ew_HtmlEncode($master_siswa->E_alamat->AdvancedSearch->SearchValue);
			$master_siswa->E_alamat->EditCustomAttributes = "";
			$master_siswa->E_alamat->EditValue2 = ew_HtmlEncode($master_siswa->E_alamat->AdvancedSearch->SearchValue2);

			// E_telepon
			$master_siswa->E_telepon->EditCustomAttributes = "";
			$master_siswa->E_telepon->EditValue = ew_HtmlEncode($master_siswa->E_telepon->AdvancedSearch->SearchValue);
			$master_siswa->E_telepon->EditCustomAttributes = "";
			$master_siswa->E_telepon->EditValue2 = ew_HtmlEncode($master_siswa->E_telepon->AdvancedSearch->SearchValue2);

			// E_hp
			$master_siswa->E_hp->EditCustomAttributes = "";
			$master_siswa->E_hp->EditValue = ew_HtmlEncode($master_siswa->E_hp->AdvancedSearch->SearchValue);
			$master_siswa->E_hp->EditCustomAttributes = "";
			$master_siswa->E_hp->EditValue2 = ew_HtmlEncode($master_siswa->E_hp->AdvancedSearch->SearchValue2);

			// E_hidup
			$master_siswa->E_hidup->EditCustomAttributes = "";
			$master_siswa->E_hidup->EditValue = ew_HtmlEncode($master_siswa->E_hidup->AdvancedSearch->SearchValue);
			$master_siswa->E_hidup->EditCustomAttributes = "";
			$master_siswa->E_hidup->EditValue2 = ew_HtmlEncode($master_siswa->E_hidup->AdvancedSearch->SearchValue2);

			// F_nama_ibu
			$master_siswa->F_nama_ibu->EditCustomAttributes = "";
			$master_siswa->F_nama_ibu->EditValue = ew_HtmlEncode($master_siswa->F_nama_ibu->AdvancedSearch->SearchValue);
			$master_siswa->F_nama_ibu->EditCustomAttributes = "";
			$master_siswa->F_nama_ibu->EditValue2 = ew_HtmlEncode($master_siswa->F_nama_ibu->AdvancedSearch->SearchValue2);

			// F_tempat_lahir
			$master_siswa->F_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->F_tempat_lahir->EditValue = ew_HtmlEncode($master_siswa->F_tempat_lahir->AdvancedSearch->SearchValue);
			$master_siswa->F_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->F_tempat_lahir->EditValue2 = ew_HtmlEncode($master_siswa->F_tempat_lahir->AdvancedSearch->SearchValue2);

			// F_tanggal_lahir
			$master_siswa->F_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->F_tanggal_lahir->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue, 7), 7));
			$master_siswa->F_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->F_tanggal_lahir->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue2, 7), 7));

			// F_agama
			$master_siswa->F_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->F_agama->EditValue = $arwrk;
			$master_siswa->F_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->F_agama->EditValue2 = $arwrk;

			// F_kewarganegaraan
			$master_siswa->F_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->F_kewarganegaraan->EditValue = ew_HtmlEncode($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchValue);
			$master_siswa->F_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->F_kewarganegaraan->EditValue2 = ew_HtmlEncode($master_siswa->F_kewarganegaraan->AdvancedSearch->SearchValue2);

			// F_pendidikan
			$master_siswa->F_pendidikan->EditCustomAttributes = "";
			$master_siswa->F_pendidikan->EditValue = ew_HtmlEncode($master_siswa->F_pendidikan->AdvancedSearch->SearchValue);
			$master_siswa->F_pendidikan->EditCustomAttributes = "";
			$master_siswa->F_pendidikan->EditValue2 = ew_HtmlEncode($master_siswa->F_pendidikan->AdvancedSearch->SearchValue2);

			// F_pekerjaan
			$master_siswa->F_pekerjaan->EditCustomAttributes = "";
			$master_siswa->F_pekerjaan->EditValue = ew_HtmlEncode($master_siswa->F_pekerjaan->AdvancedSearch->SearchValue);
			$master_siswa->F_pekerjaan->EditCustomAttributes = "";
			$master_siswa->F_pekerjaan->EditValue2 = ew_HtmlEncode($master_siswa->F_pekerjaan->AdvancedSearch->SearchValue2);

			// F_pengeluaran
			$master_siswa->F_pengeluaran->EditCustomAttributes = "";
			$master_siswa->F_pengeluaran->EditValue = ew_HtmlEncode($master_siswa->F_pengeluaran->AdvancedSearch->SearchValue);
			$master_siswa->F_pengeluaran->EditCustomAttributes = "";
			$master_siswa->F_pengeluaran->EditValue2 = ew_HtmlEncode($master_siswa->F_pengeluaran->AdvancedSearch->SearchValue2);

			// F_alamat
			$master_siswa->F_alamat->EditCustomAttributes = "";
			$master_siswa->F_alamat->EditValue = ew_HtmlEncode($master_siswa->F_alamat->AdvancedSearch->SearchValue);
			$master_siswa->F_alamat->EditCustomAttributes = "";
			$master_siswa->F_alamat->EditValue2 = ew_HtmlEncode($master_siswa->F_alamat->AdvancedSearch->SearchValue2);

			// F_telepon
			$master_siswa->F_telepon->EditCustomAttributes = "";
			$master_siswa->F_telepon->EditValue = ew_HtmlEncode($master_siswa->F_telepon->AdvancedSearch->SearchValue);
			$master_siswa->F_telepon->EditCustomAttributes = "";
			$master_siswa->F_telepon->EditValue2 = ew_HtmlEncode($master_siswa->F_telepon->AdvancedSearch->SearchValue2);

			// F_hp
			$master_siswa->F_hp->EditCustomAttributes = "";
			$master_siswa->F_hp->EditValue = ew_HtmlEncode($master_siswa->F_hp->AdvancedSearch->SearchValue);
			$master_siswa->F_hp->EditCustomAttributes = "";
			$master_siswa->F_hp->EditValue2 = ew_HtmlEncode($master_siswa->F_hp->AdvancedSearch->SearchValue2);

			// F_hidup
			$master_siswa->F_hidup->EditCustomAttributes = "";
			$master_siswa->F_hidup->EditValue = ew_HtmlEncode($master_siswa->F_hidup->AdvancedSearch->SearchValue);
			$master_siswa->F_hidup->EditCustomAttributes = "";
			$master_siswa->F_hidup->EditValue2 = ew_HtmlEncode($master_siswa->F_hidup->AdvancedSearch->SearchValue2);

			// G_nama_wali
			$master_siswa->G_nama_wali->EditCustomAttributes = "";
			$master_siswa->G_nama_wali->EditValue = ew_HtmlEncode($master_siswa->G_nama_wali->AdvancedSearch->SearchValue);
			$master_siswa->G_nama_wali->EditCustomAttributes = "";
			$master_siswa->G_nama_wali->EditValue2 = ew_HtmlEncode($master_siswa->G_nama_wali->AdvancedSearch->SearchValue2);

			// G_tempat_lahir
			$master_siswa->G_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->G_tempat_lahir->EditValue = ew_HtmlEncode($master_siswa->G_tempat_lahir->AdvancedSearch->SearchValue);
			$master_siswa->G_tempat_lahir->EditCustomAttributes = "";
			$master_siswa->G_tempat_lahir->EditValue2 = ew_HtmlEncode($master_siswa->G_tempat_lahir->AdvancedSearch->SearchValue2);

			// G_tanggal_lahir
			$master_siswa->G_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->G_tanggal_lahir->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue, 7), 7));
			$master_siswa->G_tanggal_lahir->EditCustomAttributes = "";
			$master_siswa->G_tanggal_lahir->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue2, 7), 7));

			// G_agama
			$master_siswa->G_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->G_agama->EditValue = $arwrk;
			$master_siswa->G_agama->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `agama`, `agama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `master_agama`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `id` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->G_agama->EditValue2 = $arwrk;

			// G_kewarganegaraan
			$master_siswa->G_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->G_kewarganegaraan->EditValue = ew_HtmlEncode($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchValue);
			$master_siswa->G_kewarganegaraan->EditCustomAttributes = "";
			$master_siswa->G_kewarganegaraan->EditValue2 = ew_HtmlEncode($master_siswa->G_kewarganegaraan->AdvancedSearch->SearchValue2);

			// G_pendidikan
			$master_siswa->G_pendidikan->EditCustomAttributes = "";
			$master_siswa->G_pendidikan->EditValue = ew_HtmlEncode($master_siswa->G_pendidikan->AdvancedSearch->SearchValue);
			$master_siswa->G_pendidikan->EditCustomAttributes = "";
			$master_siswa->G_pendidikan->EditValue2 = ew_HtmlEncode($master_siswa->G_pendidikan->AdvancedSearch->SearchValue2);

			// G_pekerjaan
			$master_siswa->G_pekerjaan->EditCustomAttributes = "";
			$master_siswa->G_pekerjaan->EditValue = ew_HtmlEncode($master_siswa->G_pekerjaan->AdvancedSearch->SearchValue);
			$master_siswa->G_pekerjaan->EditCustomAttributes = "";
			$master_siswa->G_pekerjaan->EditValue2 = ew_HtmlEncode($master_siswa->G_pekerjaan->AdvancedSearch->SearchValue2);

			// G_pengeluaran
			$master_siswa->G_pengeluaran->EditCustomAttributes = "";
			$master_siswa->G_pengeluaran->EditValue = ew_HtmlEncode($master_siswa->G_pengeluaran->AdvancedSearch->SearchValue);
			$master_siswa->G_pengeluaran->EditCustomAttributes = "";
			$master_siswa->G_pengeluaran->EditValue2 = ew_HtmlEncode($master_siswa->G_pengeluaran->AdvancedSearch->SearchValue2);

			// G_alamat
			$master_siswa->G_alamat->EditCustomAttributes = "";
			$master_siswa->G_alamat->EditValue = ew_HtmlEncode($master_siswa->G_alamat->AdvancedSearch->SearchValue);
			$master_siswa->G_alamat->EditCustomAttributes = "";
			$master_siswa->G_alamat->EditValue2 = ew_HtmlEncode($master_siswa->G_alamat->AdvancedSearch->SearchValue2);

			// G_telepon
			$master_siswa->G_telepon->EditCustomAttributes = "";
			$master_siswa->G_telepon->EditValue = ew_HtmlEncode($master_siswa->G_telepon->AdvancedSearch->SearchValue);
			$master_siswa->G_telepon->EditCustomAttributes = "";
			$master_siswa->G_telepon->EditValue2 = ew_HtmlEncode($master_siswa->G_telepon->AdvancedSearch->SearchValue2);

			// G_hp
			$master_siswa->G_hp->EditCustomAttributes = "";
			$master_siswa->G_hp->EditValue = ew_HtmlEncode($master_siswa->G_hp->AdvancedSearch->SearchValue);
			$master_siswa->G_hp->EditCustomAttributes = "";
			$master_siswa->G_hp->EditValue2 = ew_HtmlEncode($master_siswa->G_hp->AdvancedSearch->SearchValue2);

			// H_kesenian
			$master_siswa->H_kesenian->EditCustomAttributes = "";
			$master_siswa->H_kesenian->EditValue = ew_HtmlEncode($master_siswa->H_kesenian->AdvancedSearch->SearchValue);
			$master_siswa->H_kesenian->EditCustomAttributes = "";
			$master_siswa->H_kesenian->EditValue2 = ew_HtmlEncode($master_siswa->H_kesenian->AdvancedSearch->SearchValue2);

			// H_olahraga
			$master_siswa->H_olahraga->EditCustomAttributes = "";
			$master_siswa->H_olahraga->EditValue = ew_HtmlEncode($master_siswa->H_olahraga->AdvancedSearch->SearchValue);
			$master_siswa->H_olahraga->EditCustomAttributes = "";
			$master_siswa->H_olahraga->EditValue2 = ew_HtmlEncode($master_siswa->H_olahraga->AdvancedSearch->SearchValue2);

			// H_kemasyarakatan
			$master_siswa->H_kemasyarakatan->EditCustomAttributes = "";
			$master_siswa->H_kemasyarakatan->EditValue = ew_HtmlEncode($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchValue);
			$master_siswa->H_kemasyarakatan->EditCustomAttributes = "";
			$master_siswa->H_kemasyarakatan->EditValue2 = ew_HtmlEncode($master_siswa->H_kemasyarakatan->AdvancedSearch->SearchValue2);

			// H_lainlain
			$master_siswa->H_lainlain->EditCustomAttributes = "";
			$master_siswa->H_lainlain->EditValue = ew_HtmlEncode($master_siswa->H_lainlain->AdvancedSearch->SearchValue);
			$master_siswa->H_lainlain->EditCustomAttributes = "";
			$master_siswa->H_lainlain->EditValue2 = ew_HtmlEncode($master_siswa->H_lainlain->AdvancedSearch->SearchValue2);

			// I_tanggal_meninggalkan
			$master_siswa->I_tanggal_meninggalkan->EditCustomAttributes = "";
			$master_siswa->I_tanggal_meninggalkan->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue, 7), 7));
			$master_siswa->I_tanggal_meninggalkan->EditCustomAttributes = "";
			$master_siswa->I_tanggal_meninggalkan->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue2, 7), 7));

			// I_alasan
			$master_siswa->I_alasan->EditCustomAttributes = "";
			$master_siswa->I_alasan->EditValue = ew_HtmlEncode($master_siswa->I_alasan->AdvancedSearch->SearchValue);
			$master_siswa->I_alasan->EditCustomAttributes = "";
			$master_siswa->I_alasan->EditValue2 = ew_HtmlEncode($master_siswa->I_alasan->AdvancedSearch->SearchValue2);

			// I_tanggal_lulus
			$master_siswa->I_tanggal_lulus->EditCustomAttributes = "";
			$master_siswa->I_tanggal_lulus->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue, 7), 7));
			$master_siswa->I_tanggal_lulus->EditCustomAttributes = "";
			$master_siswa->I_tanggal_lulus->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue2, 7), 7));

			// I_sttb
			$master_siswa->I_sttb->EditCustomAttributes = "";
			$master_siswa->I_sttb->EditValue = ew_HtmlEncode($master_siswa->I_sttb->AdvancedSearch->SearchValue);
			$master_siswa->I_sttb->EditCustomAttributes = "";
			$master_siswa->I_sttb->EditValue2 = ew_HtmlEncode($master_siswa->I_sttb->AdvancedSearch->SearchValue2);

			// I_danum
			$master_siswa->I_danum->EditCustomAttributes = "";
			$master_siswa->I_danum->EditValue = ew_HtmlEncode($master_siswa->I_danum->AdvancedSearch->SearchValue);
			$master_siswa->I_danum->EditCustomAttributes = "";
			$master_siswa->I_danum->EditValue2 = ew_HtmlEncode($master_siswa->I_danum->AdvancedSearch->SearchValue2);

			// I_nilai_danum_smp
			$master_siswa->I_nilai_danum_smp->EditCustomAttributes = "";
			$master_siswa->I_nilai_danum_smp->EditValue = ew_HtmlEncode($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue);
			$master_siswa->I_nilai_danum_smp->EditCustomAttributes = "";
			$master_siswa->I_nilai_danum_smp->EditValue2 = ew_HtmlEncode($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue2);

			// I_tahun1
			$master_siswa->I_tahun1->EditCustomAttributes = "";
			$master_siswa->I_tahun1->EditValue = ew_HtmlEncode($master_siswa->I_tahun1->AdvancedSearch->SearchValue);
			$master_siswa->I_tahun1->EditCustomAttributes = "";
			$master_siswa->I_tahun1->EditValue2 = ew_HtmlEncode($master_siswa->I_tahun1->AdvancedSearch->SearchValue2);

			// I_tahun2
			$master_siswa->I_tahun2->EditCustomAttributes = "";
			$master_siswa->I_tahun2->EditValue = ew_HtmlEncode($master_siswa->I_tahun2->AdvancedSearch->SearchValue);
			$master_siswa->I_tahun2->EditCustomAttributes = "";
			$master_siswa->I_tahun2->EditValue2 = ew_HtmlEncode($master_siswa->I_tahun2->AdvancedSearch->SearchValue2);

			// I_tahun3
			$master_siswa->I_tahun3->EditCustomAttributes = "";
			$master_siswa->I_tahun3->EditValue = ew_HtmlEncode($master_siswa->I_tahun3->AdvancedSearch->SearchValue);
			$master_siswa->I_tahun3->EditCustomAttributes = "";
			$master_siswa->I_tahun3->EditValue2 = ew_HtmlEncode($master_siswa->I_tahun3->AdvancedSearch->SearchValue2);

			// I_tk1
			$master_siswa->I_tk1->EditCustomAttributes = "";
			$master_siswa->I_tk1->EditValue = ew_HtmlEncode($master_siswa->I_tk1->AdvancedSearch->SearchValue);
			$master_siswa->I_tk1->EditCustomAttributes = "";
			$master_siswa->I_tk1->EditValue2 = ew_HtmlEncode($master_siswa->I_tk1->AdvancedSearch->SearchValue2);

			// I_tk2
			$master_siswa->I_tk2->EditCustomAttributes = "";
			$master_siswa->I_tk2->EditValue = ew_HtmlEncode($master_siswa->I_tk2->AdvancedSearch->SearchValue);
			$master_siswa->I_tk2->EditCustomAttributes = "";
			$master_siswa->I_tk2->EditValue2 = ew_HtmlEncode($master_siswa->I_tk2->AdvancedSearch->SearchValue2);

			// I_tk3
			$master_siswa->I_tk3->EditCustomAttributes = "";
			$master_siswa->I_tk3->EditValue = ew_HtmlEncode($master_siswa->I_tk3->AdvancedSearch->SearchValue);
			$master_siswa->I_tk3->EditCustomAttributes = "";
			$master_siswa->I_tk3->EditValue2 = ew_HtmlEncode($master_siswa->I_tk3->AdvancedSearch->SearchValue2);

			// I_dari1
			$master_siswa->I_dari1->EditCustomAttributes = "";
			$master_siswa->I_dari1->EditValue = ew_HtmlEncode($master_siswa->I_dari1->AdvancedSearch->SearchValue);
			$master_siswa->I_dari1->EditCustomAttributes = "";
			$master_siswa->I_dari1->EditValue2 = ew_HtmlEncode($master_siswa->I_dari1->AdvancedSearch->SearchValue2);

			// I_dari2
			$master_siswa->I_dari2->EditCustomAttributes = "";
			$master_siswa->I_dari2->EditValue = ew_HtmlEncode($master_siswa->I_dari2->AdvancedSearch->SearchValue);
			$master_siswa->I_dari2->EditCustomAttributes = "";
			$master_siswa->I_dari2->EditValue2 = ew_HtmlEncode($master_siswa->I_dari2->AdvancedSearch->SearchValue2);

			// I_dari3
			$master_siswa->I_dari3->EditCustomAttributes = "";
			$master_siswa->I_dari3->EditValue = ew_HtmlEncode($master_siswa->I_dari3->AdvancedSearch->SearchValue);
			$master_siswa->I_dari3->EditCustomAttributes = "";
			$master_siswa->I_dari3->EditValue2 = ew_HtmlEncode($master_siswa->I_dari3->AdvancedSearch->SearchValue2);

			// J_melanjutkan
			$master_siswa->J_melanjutkan->EditCustomAttributes = "";
			$master_siswa->J_melanjutkan->EditValue = ew_HtmlEncode($master_siswa->J_melanjutkan->AdvancedSearch->SearchValue);
			$master_siswa->J_melanjutkan->EditCustomAttributes = "";
			$master_siswa->J_melanjutkan->EditValue2 = ew_HtmlEncode($master_siswa->J_melanjutkan->AdvancedSearch->SearchValue2);

			// J_tanggal_bekerja
			$master_siswa->J_tanggal_bekerja->EditCustomAttributes = "";
			$master_siswa->J_tanggal_bekerja->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue, 7), 7));
			$master_siswa->J_tanggal_bekerja->EditCustomAttributes = "";
			$master_siswa->J_tanggal_bekerja->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue2, 7), 7));

			// J_nama_perusahaan
			$master_siswa->J_nama_perusahaan->EditCustomAttributes = "";
			$master_siswa->J_nama_perusahaan->EditValue = ew_HtmlEncode($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchValue);
			$master_siswa->J_nama_perusahaan->EditCustomAttributes = "";
			$master_siswa->J_nama_perusahaan->EditValue2 = ew_HtmlEncode($master_siswa->J_nama_perusahaan->AdvancedSearch->SearchValue2);

			// J_penghasilan
			$master_siswa->J_penghasilan->EditCustomAttributes = "";
			$master_siswa->J_penghasilan->EditValue = ew_HtmlEncode($master_siswa->J_penghasilan->AdvancedSearch->SearchValue);
			$master_siswa->J_penghasilan->EditCustomAttributes = "";
			$master_siswa->J_penghasilan->EditValue2 = ew_HtmlEncode($master_siswa->J_penghasilan->AdvancedSearch->SearchValue2);

			// kode_otomatis
			$master_siswa->kode_otomatis->EditCustomAttributes = "";
			$master_siswa->kode_otomatis->EditValue = ew_HtmlEncode($master_siswa->kode_otomatis->AdvancedSearch->SearchValue);
			$master_siswa->kode_otomatis->EditCustomAttributes = "";
			$master_siswa->kode_otomatis->EditValue2 = ew_HtmlEncode($master_siswa->kode_otomatis->AdvancedSearch->SearchValue2);

			// apakah_valid
			$master_siswa->apakah_valid->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("y", $master_siswa->apakah_valid->FldTagCaption(1) <> "" ? $master_siswa->apakah_valid->FldTagCaption(1) : "y");
			$arwrk[] = array("t", $master_siswa->apakah_valid->FldTagCaption(2) <> "" ? $master_siswa->apakah_valid->FldTagCaption(2) : "t");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->apakah_valid->EditValue = $arwrk;
			$master_siswa->apakah_valid->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("y", $master_siswa->apakah_valid->FldTagCaption(1) <> "" ? $master_siswa->apakah_valid->FldTagCaption(1) : "y");
			$arwrk[] = array("t", $master_siswa->apakah_valid->FldTagCaption(2) <> "" ? $master_siswa->apakah_valid->FldTagCaption(2) : "t");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$master_siswa->apakah_valid->EditValue2 = $arwrk;
		}
		if ($master_siswa->RowType == EW_ROWTYPE_ADD ||
			$master_siswa->RowType == EW_ROWTYPE_EDIT ||
			$master_siswa->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$master_siswa->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($master_siswa->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$master_siswa->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $master_siswa;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($master_siswa->no_absen->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->no_absen->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->no_absen->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->no_absen->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->A_tanggal_lahir->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->A_tanggal_lahir->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->A_anak_keberapa->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->A_anak_keberapa->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->A_jumlah_saudara_kandung->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->A_jumlah_saudara_kandung->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->A_jumlah_saudara_tiri->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->A_jumlah_saudara_tiri->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->A_jumlah_saudara_angkat->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->A_jumlah_saudara_angkat->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->B_jarak->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->B_jarak->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->B_jarak->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->B_jarak->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->C_tinggi->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->C_tinggi->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->C_tinggi->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->C_tinggi->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->C_berat->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->C_berat->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->C_berat->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->C_berat->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_tanggal_sttb->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_tanggal_sttb->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_tanggal_danum->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_tanggal_danum->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->D_lama_belajar->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_lama_belajar->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->D_lama_belajar->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_lama_belajar->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->D_tanggal->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_tanggal->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->D_tanggal->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_tanggal->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_nilai_danum_sd->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_nilai_danum_sd->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_jumlah_pelajaran_danum->FldErrMsg());
		}
		if (!ew_CheckInteger($master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_jumlah_pelajaran_danum->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_nilai_ujian_psb->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_nilai_ujian_psb->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->D_spp->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_spp->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->D_spp->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_spp->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->D_spp_potongan->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_spp_potongan->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->D_spp_potongan->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->D_spp_potongan->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->E_tanggal_lahir->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->E_tanggal_lahir->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->E_pengeluaran->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->E_pengeluaran->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->E_pengeluaran->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->E_pengeluaran->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->F_tanggal_lahir->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->F_tanggal_lahir->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->F_pengeluaran->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->F_pengeluaran->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->F_pengeluaran->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->F_pengeluaran->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->G_tanggal_lahir->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->G_tanggal_lahir->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->G_pengeluaran->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->G_pengeluaran->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->G_pengeluaran->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->G_pengeluaran->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->I_tanggal_meninggalkan->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->I_tanggal_meninggalkan->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->I_tanggal_lulus->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->I_tanggal_lulus->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->I_nilai_danum_smp->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->I_nilai_danum_smp->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->J_tanggal_bekerja->FldErrMsg());
		}
		if (!ew_CheckEuroDate($master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->J_tanggal_bekerja->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->J_penghasilan->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $master_siswa->J_penghasilan->FldErrMsg());
		}
		if (!ew_CheckNumber($master_siswa->J_penghasilan->AdvancedSearch->SearchValue2)) {
			ew_AddMessage($gsSearchError, $master_siswa->J_penghasilan->FldErrMsg());
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
		global $master_siswa;
		$master_siswa->no_absen->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_no_absen");
		$master_siswa->no_absen->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_no_absen");
		$master_siswa->no_absen->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_no_absen");
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_nis_nasional");
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_nis_nasional");
		$master_siswa->A_nis_nasional->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_nis_nasional");
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_nama_Lengkap");
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_nama_Lengkap");
		$master_siswa->A_nama_Lengkap->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_nama_Lengkap");
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_nama_panggilan");
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_nama_panggilan");
		$master_siswa->A_nama_panggilan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_nama_panggilan");
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_jenis_kelamin");
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_jenis_kelamin");
		$master_siswa->A_jenis_kelamin->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_jenis_kelamin");
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_tempat_lahir");
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_tempat_lahir");
		$master_siswa->A_tempat_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_tempat_lahir");
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_tanggal_lahir");
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_tanggal_lahir");
		$master_siswa->A_tanggal_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_tanggal_lahir");
		$master_siswa->A_agama->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_agama");
		$master_siswa->A_agama->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_agama");
		$master_siswa->A_agama->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_agama");
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_kewarganegaraan");
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_kewarganegaraan");
		$master_siswa->A_kewarganegaraan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_kewarganegaraan");
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_anak_keberapa");
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_anak_keberapa");
		$master_siswa->A_anak_keberapa->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_anak_keberapa");
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_jumlah_saudara_kandung");
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_jumlah_saudara_kandung");
		$master_siswa->A_jumlah_saudara_kandung->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_jumlah_saudara_kandung");
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_jumlah_saudara_tiri");
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_jumlah_saudara_tiri");
		$master_siswa->A_jumlah_saudara_tiri->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_jumlah_saudara_tiri");
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_jumlah_saudara_angkat");
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_jumlah_saudara_angkat");
		$master_siswa->A_jumlah_saudara_angkat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_jumlah_saudara_angkat");
		$master_siswa->A_status_yatim->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_status_yatim");
		$master_siswa->A_status_yatim->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_status_yatim");
		$master_siswa->A_status_yatim->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_status_yatim");
		$master_siswa->A_bahasa->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_A_bahasa");
		$master_siswa->A_bahasa->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_A_bahasa");
		$master_siswa->A_bahasa->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_A_bahasa");
		$master_siswa->B_alamat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_B_alamat");
		$master_siswa->B_alamat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_B_alamat");
		$master_siswa->B_alamat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_B_alamat");
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_B_telepon_rumah");
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_B_telepon_rumah");
		$master_siswa->B_telepon_rumah->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_B_telepon_rumah");
		$master_siswa->B_tinggal->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_B_tinggal");
		$master_siswa->B_tinggal->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_B_tinggal");
		$master_siswa->B_tinggal->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_B_tinggal");
		$master_siswa->B_jarak->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_B_jarak");
		$master_siswa->B_jarak->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_B_jarak");
		$master_siswa->B_jarak->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_B_jarak");
		$master_siswa->B_hp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_B_hp");
		$master_siswa->B_hp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_B_hp");
		$master_siswa->B_hp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_B_hp");
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_C_golongan_darah");
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_C_golongan_darah");
		$master_siswa->C_golongan_darah->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_C_golongan_darah");
		$master_siswa->C_penyakit->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_C_penyakit");
		$master_siswa->C_penyakit->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_C_penyakit");
		$master_siswa->C_penyakit->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_C_penyakit");
		$master_siswa->C_jasmani->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_C_jasmani");
		$master_siswa->C_jasmani->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_C_jasmani");
		$master_siswa->C_jasmani->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_C_jasmani");
		$master_siswa->C_tinggi->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_C_tinggi");
		$master_siswa->C_tinggi->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_C_tinggi");
		$master_siswa->C_tinggi->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_C_tinggi");
		$master_siswa->C_berat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_C_berat");
		$master_siswa->C_berat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_C_berat");
		$master_siswa->C_berat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_C_berat");
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_tamatan_dari");
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_tamatan_dari");
		$master_siswa->D_tamatan_dari->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_tamatan_dari");
		$master_siswa->D_sttb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_sttb");
		$master_siswa->D_sttb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_sttb");
		$master_siswa->D_sttb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_sttb");
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_tanggal_sttb");
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_tanggal_sttb");
		$master_siswa->D_tanggal_sttb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_tanggal_sttb");
		$master_siswa->D_danum->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_danum");
		$master_siswa->D_danum->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_danum");
		$master_siswa->D_danum->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_danum");
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_tanggal_danum");
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_tanggal_danum");
		$master_siswa->D_tanggal_danum->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_tanggal_danum");
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_lama_belajar");
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_lama_belajar");
		$master_siswa->D_lama_belajar->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_lama_belajar");
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_dari_sekolah");
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_dari_sekolah");
		$master_siswa->D_dari_sekolah->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_dari_sekolah");
		$master_siswa->D_alasan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_alasan");
		$master_siswa->D_alasan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_alasan");
		$master_siswa->D_alasan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_alasan");
		$master_siswa->D_kelas->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_kelas");
		$master_siswa->D_kelas->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_kelas");
		$master_siswa->D_kelas->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_kelas");
		$master_siswa->D_kelompok->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_kelompok");
		$master_siswa->D_kelompok->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_kelompok");
		$master_siswa->D_kelompok->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_kelompok");
		$master_siswa->D_tanggal->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_tanggal");
		$master_siswa->D_tanggal->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_tanggal");
		$master_siswa->D_tanggal->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_tanggal");
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_saat_ini_tingkat");
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_saat_ini_tingkat");
		$master_siswa->D_saat_ini_tingkat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_saat_ini_tingkat");
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_saat_ini_kelas");
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_saat_ini_kelas");
		$master_siswa->D_saat_ini_kelas->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_saat_ini_kelas");
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_saat_ini_kelompok");
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_saat_ini_kelompok");
		$master_siswa->D_saat_ini_kelompok->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_saat_ini_kelompok");
		$master_siswa->D_no_psb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_no_psb");
		$master_siswa->D_no_psb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_no_psb");
		$master_siswa->D_no_psb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_no_psb");
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_nilai_danum_sd");
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_nilai_danum_sd");
		$master_siswa->D_nilai_danum_sd->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_nilai_danum_sd");
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_jumlah_pelajaran_danum");
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_jumlah_pelajaran_danum");
		$master_siswa->D_jumlah_pelajaran_danum->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_jumlah_pelajaran_danum");
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_nilai_ujian_psb");
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_nilai_ujian_psb");
		$master_siswa->D_nilai_ujian_psb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_nilai_ujian_psb");
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_tahun_psb");
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_tahun_psb");
		$master_siswa->D_tahun_psb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_tahun_psb");
		$master_siswa->D_diterima->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_diterima");
		$master_siswa->D_diterima->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_diterima");
		$master_siswa->D_diterima->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_diterima");
		$master_siswa->D_spp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_spp");
		$master_siswa->D_spp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_spp");
		$master_siswa->D_spp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_spp");
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_spp_potongan");
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_spp_potongan");
		$master_siswa->D_spp_potongan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_spp_potongan");
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_D_status_lama_baru");
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_D_status_lama_baru");
		$master_siswa->D_status_lama_baru->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_D_status_lama_baru");
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_nama_ayah");
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_nama_ayah");
		$master_siswa->E_nama_ayah->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_nama_ayah");
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_tempat_lahir");
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_tempat_lahir");
		$master_siswa->E_tempat_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_tempat_lahir");
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_tanggal_lahir");
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_tanggal_lahir");
		$master_siswa->E_tanggal_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_tanggal_lahir");
		$master_siswa->E_agama->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_agama");
		$master_siswa->E_agama->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_agama");
		$master_siswa->E_agama->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_agama");
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_kewarganegaraan");
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_kewarganegaraan");
		$master_siswa->E_kewarganegaraan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_kewarganegaraan");
		$master_siswa->E_pendidikan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_pendidikan");
		$master_siswa->E_pendidikan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_pendidikan");
		$master_siswa->E_pendidikan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_pendidikan");
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_pekerjaan");
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_pekerjaan");
		$master_siswa->E_pekerjaan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_pekerjaan");
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_pengeluaran");
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_pengeluaran");
		$master_siswa->E_pengeluaran->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_pengeluaran");
		$master_siswa->E_alamat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_alamat");
		$master_siswa->E_alamat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_alamat");
		$master_siswa->E_alamat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_alamat");
		$master_siswa->E_telepon->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_telepon");
		$master_siswa->E_telepon->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_telepon");
		$master_siswa->E_telepon->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_telepon");
		$master_siswa->E_hp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_hp");
		$master_siswa->E_hp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_hp");
		$master_siswa->E_hp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_hp");
		$master_siswa->E_hidup->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_E_hidup");
		$master_siswa->E_hidup->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_E_hidup");
		$master_siswa->E_hidup->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_E_hidup");
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_nama_ibu");
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_nama_ibu");
		$master_siswa->F_nama_ibu->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_nama_ibu");
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_tempat_lahir");
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_tempat_lahir");
		$master_siswa->F_tempat_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_tempat_lahir");
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_tanggal_lahir");
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_tanggal_lahir");
		$master_siswa->F_tanggal_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_tanggal_lahir");
		$master_siswa->F_agama->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_agama");
		$master_siswa->F_agama->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_agama");
		$master_siswa->F_agama->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_agama");
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_kewarganegaraan");
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_kewarganegaraan");
		$master_siswa->F_kewarganegaraan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_kewarganegaraan");
		$master_siswa->F_pendidikan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_pendidikan");
		$master_siswa->F_pendidikan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_pendidikan");
		$master_siswa->F_pendidikan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_pendidikan");
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_pekerjaan");
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_pekerjaan");
		$master_siswa->F_pekerjaan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_pekerjaan");
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_pengeluaran");
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_pengeluaran");
		$master_siswa->F_pengeluaran->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_pengeluaran");
		$master_siswa->F_alamat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_alamat");
		$master_siswa->F_alamat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_alamat");
		$master_siswa->F_alamat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_alamat");
		$master_siswa->F_telepon->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_telepon");
		$master_siswa->F_telepon->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_telepon");
		$master_siswa->F_telepon->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_telepon");
		$master_siswa->F_hp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_hp");
		$master_siswa->F_hp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_hp");
		$master_siswa->F_hp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_hp");
		$master_siswa->F_hidup->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_F_hidup");
		$master_siswa->F_hidup->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_F_hidup");
		$master_siswa->F_hidup->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_F_hidup");
		$master_siswa->G_nama_wali->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_nama_wali");
		$master_siswa->G_nama_wali->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_nama_wali");
		$master_siswa->G_nama_wali->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_nama_wali");
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_tempat_lahir");
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_tempat_lahir");
		$master_siswa->G_tempat_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_tempat_lahir");
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_tanggal_lahir");
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_tanggal_lahir");
		$master_siswa->G_tanggal_lahir->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_tanggal_lahir");
		$master_siswa->G_agama->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_agama");
		$master_siswa->G_agama->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_agama");
		$master_siswa->G_agama->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_agama");
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_kewarganegaraan");
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_kewarganegaraan");
		$master_siswa->G_kewarganegaraan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_kewarganegaraan");
		$master_siswa->G_pendidikan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_pendidikan");
		$master_siswa->G_pendidikan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_pendidikan");
		$master_siswa->G_pendidikan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_pendidikan");
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_pekerjaan");
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_pekerjaan");
		$master_siswa->G_pekerjaan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_pekerjaan");
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_pengeluaran");
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_pengeluaran");
		$master_siswa->G_pengeluaran->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_pengeluaran");
		$master_siswa->G_alamat->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_alamat");
		$master_siswa->G_alamat->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_alamat");
		$master_siswa->G_alamat->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_alamat");
		$master_siswa->G_telepon->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_telepon");
		$master_siswa->G_telepon->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_telepon");
		$master_siswa->G_telepon->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_telepon");
		$master_siswa->G_hp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_G_hp");
		$master_siswa->G_hp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_G_hp");
		$master_siswa->G_hp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_G_hp");
		$master_siswa->H_kesenian->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_H_kesenian");
		$master_siswa->H_kesenian->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_H_kesenian");
		$master_siswa->H_kesenian->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_H_kesenian");
		$master_siswa->H_olahraga->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_H_olahraga");
		$master_siswa->H_olahraga->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_H_olahraga");
		$master_siswa->H_olahraga->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_H_olahraga");
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_H_kemasyarakatan");
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_H_kemasyarakatan");
		$master_siswa->H_kemasyarakatan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_H_kemasyarakatan");
		$master_siswa->H_lainlain->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_H_lainlain");
		$master_siswa->H_lainlain->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_H_lainlain");
		$master_siswa->H_lainlain->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_H_lainlain");
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tanggal_meninggalkan");
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tanggal_meninggalkan");
		$master_siswa->I_tanggal_meninggalkan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tanggal_meninggalkan");
		$master_siswa->I_alasan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_alasan");
		$master_siswa->I_alasan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_alasan");
		$master_siswa->I_alasan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_alasan");
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tanggal_lulus");
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tanggal_lulus");
		$master_siswa->I_tanggal_lulus->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tanggal_lulus");
		$master_siswa->I_sttb->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_sttb");
		$master_siswa->I_sttb->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_sttb");
		$master_siswa->I_sttb->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_sttb");
		$master_siswa->I_danum->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_danum");
		$master_siswa->I_danum->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_danum");
		$master_siswa->I_danum->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_danum");
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_nilai_danum_smp");
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_nilai_danum_smp");
		$master_siswa->I_nilai_danum_smp->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_nilai_danum_smp");
		$master_siswa->I_tahun1->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tahun1");
		$master_siswa->I_tahun1->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tahun1");
		$master_siswa->I_tahun1->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tahun1");
		$master_siswa->I_tahun2->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tahun2");
		$master_siswa->I_tahun2->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tahun2");
		$master_siswa->I_tahun2->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tahun2");
		$master_siswa->I_tahun3->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tahun3");
		$master_siswa->I_tahun3->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tahun3");
		$master_siswa->I_tahun3->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tahun3");
		$master_siswa->I_tk1->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tk1");
		$master_siswa->I_tk1->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tk1");
		$master_siswa->I_tk1->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tk1");
		$master_siswa->I_tk2->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tk2");
		$master_siswa->I_tk2->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tk2");
		$master_siswa->I_tk2->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tk2");
		$master_siswa->I_tk3->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_tk3");
		$master_siswa->I_tk3->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_tk3");
		$master_siswa->I_tk3->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_tk3");
		$master_siswa->I_dari1->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_dari1");
		$master_siswa->I_dari1->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_dari1");
		$master_siswa->I_dari1->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_dari1");
		$master_siswa->I_dari2->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_dari2");
		$master_siswa->I_dari2->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_dari2");
		$master_siswa->I_dari2->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_dari2");
		$master_siswa->I_dari3->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_I_dari3");
		$master_siswa->I_dari3->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_I_dari3");
		$master_siswa->I_dari3->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_I_dari3");
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_J_melanjutkan");
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_J_melanjutkan");
		$master_siswa->J_melanjutkan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_J_melanjutkan");
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_J_tanggal_bekerja");
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_J_tanggal_bekerja");
		$master_siswa->J_tanggal_bekerja->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_J_tanggal_bekerja");
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_J_nama_perusahaan");
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_J_nama_perusahaan");
		$master_siswa->J_nama_perusahaan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_J_nama_perusahaan");
		$master_siswa->J_penghasilan->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_J_penghasilan");
		$master_siswa->J_penghasilan->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_J_penghasilan");
		$master_siswa->J_penghasilan->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_J_penghasilan");
		$master_siswa->kode_otomatis->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_kode_otomatis");
		$master_siswa->kode_otomatis->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_kode_otomatis");
		$master_siswa->kode_otomatis->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_kode_otomatis");
		$master_siswa->apakah_valid->AdvancedSearch->SearchValue = $master_siswa->getAdvancedSearch("x_apakah_valid");
		$master_siswa->apakah_valid->AdvancedSearch->SearchOperator = $master_siswa->getAdvancedSearch("z_apakah_valid");
		$master_siswa->apakah_valid->AdvancedSearch->SearchValue2 = $master_siswa->getAdvancedSearch("y_apakah_valid");
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

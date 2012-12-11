<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_laporan_keuanganinfo.php" ?>
<?php include_once "keu_cicilaninfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "keu_cicilangridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_laporan_keuangan_edit = new ckeu_laporan_keuangan_edit();
$Page =& $keu_laporan_keuangan_edit;

// Page init
$keu_laporan_keuangan_edit->Page_Init();

// Page main
$keu_laporan_keuangan_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var keu_laporan_keuangan_edit = new ew_Page("keu_laporan_keuangan_edit");

// page properties
keu_laporan_keuangan_edit.PageID = "edit"; // page ID
keu_laporan_keuangan_edit.FormID = "fkeu_laporan_keuanganedit"; // form ID
var EW_PAGE_ID = keu_laporan_keuangan_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
keu_laporan_keuangan_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_nilai_tanggungan_bruto"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_laporan_keuangan->nilai_tanggungan_bruto->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nilai_tanggungan_bruto"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->nilai_tanggungan_bruto->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_rencana_bayar"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_laporan_keuangan->tanggal_rencana_bayar->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_rencana_bayar"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->tanggal_rencana_bayar->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_sosial"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_sosial->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_sosial"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_sosial->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_waktu"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_waktu->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_waktu"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_waktu->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_prestasi"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_prestasi->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_prestasi"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_prestasi->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_internal"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_internal->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_internal"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_internal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_lain_lain"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_lain_lain->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_lain_lain"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_laporan_keuangan->diskon_lain_lain->FldErrMsg()) ?>");

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
keu_laporan_keuangan_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_laporan_keuangan_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_laporan_keuangan_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
keu_laporan_keuangan_edit.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
keu_laporan_keuangan_edit.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $keu_laporan_keuangan->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $keu_laporan_keuangan->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $keu_laporan_keuangan_edit->ShowPageHeader(); ?>
<?php
$keu_laporan_keuangan_edit->ShowMessage();
?>
<form name="fkeu_laporan_keuanganedit" id="fkeu_laporan_keuanganedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return keu_laporan_keuangan_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="keu_laporan_keuangan">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($keu_laporan_keuangan->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($keu_laporan_keuangan->identitas->Visible) { // identitas ?>
	<tr id="r_identitas"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->identitas->FldCaption() ?></td>
		<td<?php echo $keu_laporan_keuangan->identitas->CellAttributes() ?>><span id="el_identitas">
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { ?>
<div<?php echo $keu_laporan_keuangan->identitas->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->identitas->EditValue ?></div>
<input type="hidden" name="x_identitas" id="x_identitas" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->identitas->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $keu_laporan_keuangan->identitas->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->identitas->ViewValue ?></div>
<input type="hidden" name="x_identitas" id="x_identitas" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->identitas->FormValue) ?>">
<?php } ?>
</span><?php echo $keu_laporan_keuangan->identitas->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_laporan_keuangan->A_nama_lengkap->Visible) { // A_nama_lengkap ?>
	<tr id="r_A_nama_lengkap"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->A_nama_lengkap->FldCaption() ?></td>
		<td<?php echo $keu_laporan_keuangan->A_nama_lengkap->CellAttributes() ?>><span id="el_A_nama_lengkap">
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { ?>
<div<?php echo $keu_laporan_keuangan->A_nama_lengkap->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->A_nama_lengkap->EditValue ?></div>
<input type="hidden" name="x_A_nama_lengkap" id="x_A_nama_lengkap" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->A_nama_lengkap->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $keu_laporan_keuangan->A_nama_lengkap->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->A_nama_lengkap->ViewValue ?></div>
<input type="hidden" name="x_A_nama_lengkap" id="x_A_nama_lengkap" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->A_nama_lengkap->FormValue) ?>">
<?php } ?>
</span><?php echo $keu_laporan_keuangan->A_nama_lengkap->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_laporan_keuangan->nilai_tanggungan_bruto->Visible) { // nilai_tanggungan_bruto ?>
	<tr id="r_nilai_tanggungan_bruto"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->CellAttributes() ?>><span id="el_nilai_tanggungan_bruto">
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { ?>
<input type="text" name="x_nilai_tanggungan_bruto" id="x_nilai_tanggungan_bruto" size="30" value="<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->EditValue ?>"<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->ViewValue ?></div>
<input type="hidden" name="x_nilai_tanggungan_bruto" id="x_nilai_tanggungan_bruto" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->nilai_tanggungan_bruto->FormValue) ?>">
<?php } ?>
</span><?php echo $keu_laporan_keuangan->nilai_tanggungan_bruto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_laporan_keuangan->tanggal_rencana_bayar->Visible) { // tanggal_rencana_bayar ?>
	<tr id="r_tanggal_rencana_bayar"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->CellAttributes() ?>><span id="el_tanggal_rencana_bayar">
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { ?>
<input type="text" name="x_tanggal_rencana_bayar" id="x_tanggal_rencana_bayar" value="<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->EditValue ?>"<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_tanggal_rencana_bayar" name="cal_x_tanggal_rencana_bayar" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_tanggal_rencana_bayar", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_tanggal_rencana_bayar" // button id
});
</script>
<?php } else { ?>
<div<?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->ViewValue ?></div>
<input type="hidden" name="x_tanggal_rencana_bayar" id="x_tanggal_rencana_bayar" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->tanggal_rencana_bayar->FormValue) ?>">
<?php } ?>
</span><?php echo $keu_laporan_keuangan->tanggal_rencana_bayar->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_laporan_keuangan->diskon_sosial->Visible) { // diskon_sosial ?>
	<tr id="r_diskon_sosial"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_sosial->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_laporan_keuangan->diskon_sosial->CellAttributes() ?>><span id="el_diskon_sosial">
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { ?>
<input type="text" name="x_diskon_sosial" id="x_diskon_sosial" size="30" value="<?php echo $keu_laporan_keuangan->diskon_sosial->EditValue ?>"<?php echo $keu_laporan_keuangan->diskon_sosial->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $keu_laporan_keuangan->diskon_sosial->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_sosial->ViewValue ?></div>
<input type="hidden" name="x_diskon_sosial" id="x_diskon_sosial" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->diskon_sosial->FormValue) ?>">
<?php } ?>
</span><?php echo $keu_laporan_keuangan->diskon_sosial->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_laporan_keuangan->diskon_waktu->Visible) { // diskon_waktu ?>
	<tr id="r_diskon_waktu"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_waktu->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_laporan_keuangan->diskon_waktu->CellAttributes() ?>><span id="el_diskon_waktu">
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { ?>
<input type="text" name="x_diskon_waktu" id="x_diskon_waktu" size="30" value="<?php echo $keu_laporan_keuangan->diskon_waktu->EditValue ?>"<?php echo $keu_laporan_keuangan->diskon_waktu->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $keu_laporan_keuangan->diskon_waktu->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_waktu->ViewValue ?></div>
<input type="hidden" name="x_diskon_waktu" id="x_diskon_waktu" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->diskon_waktu->FormValue) ?>">
<?php } ?>
</span><?php echo $keu_laporan_keuangan->diskon_waktu->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_laporan_keuangan->diskon_prestasi->Visible) { // diskon_prestasi ?>
	<tr id="r_diskon_prestasi"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_prestasi->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_laporan_keuangan->diskon_prestasi->CellAttributes() ?>><span id="el_diskon_prestasi">
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { ?>
<input type="text" name="x_diskon_prestasi" id="x_diskon_prestasi" size="30" value="<?php echo $keu_laporan_keuangan->diskon_prestasi->EditValue ?>"<?php echo $keu_laporan_keuangan->diskon_prestasi->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $keu_laporan_keuangan->diskon_prestasi->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_prestasi->ViewValue ?></div>
<input type="hidden" name="x_diskon_prestasi" id="x_diskon_prestasi" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->diskon_prestasi->FormValue) ?>">
<?php } ?>
</span><?php echo $keu_laporan_keuangan->diskon_prestasi->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_laporan_keuangan->diskon_internal->Visible) { // diskon_internal ?>
	<tr id="r_diskon_internal"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_internal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_laporan_keuangan->diskon_internal->CellAttributes() ?>><span id="el_diskon_internal">
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { ?>
<input type="text" name="x_diskon_internal" id="x_diskon_internal" size="30" value="<?php echo $keu_laporan_keuangan->diskon_internal->EditValue ?>"<?php echo $keu_laporan_keuangan->diskon_internal->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $keu_laporan_keuangan->diskon_internal->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_internal->ViewValue ?></div>
<input type="hidden" name="x_diskon_internal" id="x_diskon_internal" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->diskon_internal->FormValue) ?>">
<?php } ?>
</span><?php echo $keu_laporan_keuangan->diskon_internal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_laporan_keuangan->diskon_lain_lain->Visible) { // diskon_lain_lain ?>
	<tr id="r_diskon_lain_lain"<?php echo $keu_laporan_keuangan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_laporan_keuangan->diskon_lain_lain->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_laporan_keuangan->diskon_lain_lain->CellAttributes() ?>><span id="el_diskon_lain_lain">
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { ?>
<input type="text" name="x_diskon_lain_lain" id="x_diskon_lain_lain" size="30" value="<?php echo $keu_laporan_keuangan->diskon_lain_lain->EditValue ?>"<?php echo $keu_laporan_keuangan->diskon_lain_lain->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $keu_laporan_keuangan->diskon_lain_lain->ViewAttributes() ?>><?php echo $keu_laporan_keuangan->diskon_lain_lain->ViewValue ?></div>
<input type="hidden" name="x_diskon_lain_lain" id="x_diskon_lain_lain" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->diskon_lain_lain->FormValue) ?>">
<?php } ?>
</span><?php echo $keu_laporan_keuangan->diskon_lain_lain->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_kode_otomatis" id="x_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_laporan_keuangan->kode_otomatis->CurrentValue) ?>">
<p>
<?php if ($keu_laporan_keuangan->getCurrentDetailTable() == "keu_cicilan" && $keu_cicilan->DetailEdit) { ?>
<br>
<?php include_once "keu_cicilangrid.php" ?>
<br>
<?php } ?>
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { // Confirm page ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>" onclick="this.form.a_edit.value='F';">
<?php } else { ?>
<input type="submit" name="btnCancel" id="btnCancel" value="<?php echo ew_BtnCaption($Language->Phrase("CancelBtn")) ?>" onclick="this.form.a_edit.value='X';">
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("ConfirmBtn")) ?>">
<?php } ?>
</form>
<?php if ($keu_laporan_keuangan->CurrentAction <> "F") { ?>
<?php } ?>
<?php
$keu_laporan_keuangan_edit->ShowPageFooter();
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
$keu_laporan_keuangan_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_laporan_keuangan_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'keu_laporan_keuangan';

	// Page object name
	var $PageObjName = 'keu_laporan_keuangan_edit';

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
	function ckeu_laporan_keuangan_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_laporan_keuangan)
		if (!isset($GLOBALS["keu_laporan_keuangan"])) {
			$GLOBALS["keu_laporan_keuangan"] = new ckeu_laporan_keuangan();
			$GLOBALS["Table"] =& $GLOBALS["keu_laporan_keuangan"];
		}

		// Table object (keu_cicilan)
		if (!isset($GLOBALS['keu_cicilan'])) $GLOBALS['keu_cicilan'] = new ckeu_cicilan();

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		if (!$Security->CanEdit()) {
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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $keu_laporan_keuangan;

		// Load key from QueryString
		if (@$_GET["kode_otomatis"] <> "")
			$keu_laporan_keuangan->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
		if (@$_POST["a_edit"] <> "") {
			$keu_laporan_keuangan->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$keu_laporan_keuangan->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$keu_laporan_keuangan->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$keu_laporan_keuangan->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($keu_laporan_keuangan->kode_otomatis->CurrentValue == "")
			$this->Page_Terminate("keu_laporan_keuanganlist.php"); // Invalid key, return to list

		// Set up detail parameters
		$this->SetUpDetailParms();
		switch ($keu_laporan_keuangan->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("keu_laporan_keuanganlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$keu_laporan_keuangan->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					if ($keu_laporan_keuangan->getCurrentDetailTable() <> "") // Master/detail edit
						$sReturnUrl = $keu_laporan_keuangan->getDetailUrl();
					else
						$sReturnUrl = $keu_laporan_keuangan->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$keu_laporan_keuangan->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		if ($keu_laporan_keuangan->CurrentAction == "F") { // Confirm page
			$keu_laporan_keuangan->RowType = EW_ROWTYPE_VIEW; // Render as View
		} else {
			$keu_laporan_keuangan->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		}
		$keu_laporan_keuangan->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $keu_laporan_keuangan;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $keu_laporan_keuangan;
		if (!$keu_laporan_keuangan->identitas->FldIsDetailKey) {
			$keu_laporan_keuangan->identitas->setFormValue($objForm->GetValue("x_identitas"));
		}
		if (!$keu_laporan_keuangan->A_nama_lengkap->FldIsDetailKey) {
			$keu_laporan_keuangan->A_nama_lengkap->setFormValue($objForm->GetValue("x_A_nama_lengkap"));
		}
		if (!$keu_laporan_keuangan->nilai_tanggungan_bruto->FldIsDetailKey) {
			$keu_laporan_keuangan->nilai_tanggungan_bruto->setFormValue($objForm->GetValue("x_nilai_tanggungan_bruto"));
		}
		if (!$keu_laporan_keuangan->tanggal_rencana_bayar->FldIsDetailKey) {
			$keu_laporan_keuangan->tanggal_rencana_bayar->setFormValue($objForm->GetValue("x_tanggal_rencana_bayar"));
			$keu_laporan_keuangan->tanggal_rencana_bayar->CurrentValue = ew_UnFormatDateTime($keu_laporan_keuangan->tanggal_rencana_bayar->CurrentValue, 7);
		}
		if (!$keu_laporan_keuangan->diskon_sosial->FldIsDetailKey) {
			$keu_laporan_keuangan->diskon_sosial->setFormValue($objForm->GetValue("x_diskon_sosial"));
		}
		if (!$keu_laporan_keuangan->diskon_waktu->FldIsDetailKey) {
			$keu_laporan_keuangan->diskon_waktu->setFormValue($objForm->GetValue("x_diskon_waktu"));
		}
		if (!$keu_laporan_keuangan->diskon_prestasi->FldIsDetailKey) {
			$keu_laporan_keuangan->diskon_prestasi->setFormValue($objForm->GetValue("x_diskon_prestasi"));
		}
		if (!$keu_laporan_keuangan->diskon_internal->FldIsDetailKey) {
			$keu_laporan_keuangan->diskon_internal->setFormValue($objForm->GetValue("x_diskon_internal"));
		}
		if (!$keu_laporan_keuangan->diskon_lain_lain->FldIsDetailKey) {
			$keu_laporan_keuangan->diskon_lain_lain->setFormValue($objForm->GetValue("x_diskon_lain_lain"));
		}
		if (!$keu_laporan_keuangan->kode_otomatis->FldIsDetailKey)
			$keu_laporan_keuangan->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $keu_laporan_keuangan;
		$this->LoadRow();
		$keu_laporan_keuangan->kode_otomatis->CurrentValue = $keu_laporan_keuangan->kode_otomatis->FormValue;
		$keu_laporan_keuangan->identitas->CurrentValue = $keu_laporan_keuangan->identitas->FormValue;
		$keu_laporan_keuangan->A_nama_lengkap->CurrentValue = $keu_laporan_keuangan->A_nama_lengkap->FormValue;
		$keu_laporan_keuangan->nilai_tanggungan_bruto->CurrentValue = $keu_laporan_keuangan->nilai_tanggungan_bruto->FormValue;
		$keu_laporan_keuangan->tanggal_rencana_bayar->CurrentValue = $keu_laporan_keuangan->tanggal_rencana_bayar->FormValue;
		$keu_laporan_keuangan->tanggal_rencana_bayar->CurrentValue = ew_UnFormatDateTime($keu_laporan_keuangan->tanggal_rencana_bayar->CurrentValue, 7);
		$keu_laporan_keuangan->diskon_sosial->CurrentValue = $keu_laporan_keuangan->diskon_sosial->FormValue;
		$keu_laporan_keuangan->diskon_waktu->CurrentValue = $keu_laporan_keuangan->diskon_waktu->FormValue;
		$keu_laporan_keuangan->diskon_prestasi->CurrentValue = $keu_laporan_keuangan->diskon_prestasi->FormValue;
		$keu_laporan_keuangan->diskon_internal->CurrentValue = $keu_laporan_keuangan->diskon_internal->FormValue;
		$keu_laporan_keuangan->diskon_lain_lain->CurrentValue = $keu_laporan_keuangan->diskon_lain_lain->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_laporan_keuangan;
		$sFilter = $keu_laporan_keuangan->KeyFilter();

		// Call Row Selecting event
		$keu_laporan_keuangan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_laporan_keuangan->CurrentFilter = $sFilter;
		$sSql = $keu_laporan_keuangan->SQL();
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
		global $conn, $keu_laporan_keuangan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_laporan_keuangan->Row_Selected($row);
		$keu_laporan_keuangan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_laporan_keuangan->identitas->setDbValue($rs->fields('identitas'));
		$keu_laporan_keuangan->A_nama_lengkap->setDbValue($rs->fields('A_nama_lengkap'));
		$keu_laporan_keuangan->nama_biaya->setDbValue($rs->fields('nama_biaya'));
		$keu_laporan_keuangan->nilai_tanggungan_bruto->setDbValue($rs->fields('nilai_tanggungan_bruto'));
		$keu_laporan_keuangan->tanggal_rencana_bayar->setDbValue($rs->fields('tanggal_rencana_bayar'));
		$keu_laporan_keuangan->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$keu_laporan_keuangan->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$keu_laporan_keuangan->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$keu_laporan_keuangan->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$keu_laporan_keuangan->diskon_lain_lain->setDbValue($rs->fields('diskon_lain_lain'));
		$keu_laporan_keuangan->nilai_tanggungan_netto->setDbValue($rs->fields('nilai_tanggungan_netto'));
		$keu_laporan_keuangan->jum_cicilan->setDbValue($rs->fields('jum_cicilan'));
		$keu_laporan_keuangan->kekurangan_pembayaran->setDbValue($rs->fields('kekurangan_pembayaran'));
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
		} elseif ($keu_laporan_keuangan->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// identitas
			$keu_laporan_keuangan->identitas->EditCustomAttributes = "";
			$keu_laporan_keuangan->identitas->EditValue = $keu_laporan_keuangan->identitas->CurrentValue;
			$keu_laporan_keuangan->identitas->ViewCustomAttributes = "";

			// A_nama_lengkap
			$keu_laporan_keuangan->A_nama_lengkap->EditCustomAttributes = "";
			$keu_laporan_keuangan->A_nama_lengkap->EditValue = $keu_laporan_keuangan->A_nama_lengkap->CurrentValue;
			$keu_laporan_keuangan->A_nama_lengkap->ViewCustomAttributes = "";

			// nilai_tanggungan_bruto
			$keu_laporan_keuangan->nilai_tanggungan_bruto->EditCustomAttributes = "";
			$keu_laporan_keuangan->nilai_tanggungan_bruto->EditValue = ew_HtmlEncode($keu_laporan_keuangan->nilai_tanggungan_bruto->CurrentValue);

			// tanggal_rencana_bayar
			$keu_laporan_keuangan->tanggal_rencana_bayar->EditCustomAttributes = "";
			$keu_laporan_keuangan->tanggal_rencana_bayar->EditValue = ew_HtmlEncode(ew_FormatDateTime($keu_laporan_keuangan->tanggal_rencana_bayar->CurrentValue, 7));

			// diskon_sosial
			$keu_laporan_keuangan->diskon_sosial->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_sosial->EditValue = ew_HtmlEncode($keu_laporan_keuangan->diskon_sosial->CurrentValue);

			// diskon_waktu
			$keu_laporan_keuangan->diskon_waktu->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_waktu->EditValue = ew_HtmlEncode($keu_laporan_keuangan->diskon_waktu->CurrentValue);

			// diskon_prestasi
			$keu_laporan_keuangan->diskon_prestasi->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_prestasi->EditValue = ew_HtmlEncode($keu_laporan_keuangan->diskon_prestasi->CurrentValue);

			// diskon_internal
			$keu_laporan_keuangan->diskon_internal->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_internal->EditValue = ew_HtmlEncode($keu_laporan_keuangan->diskon_internal->CurrentValue);

			// diskon_lain_lain
			$keu_laporan_keuangan->diskon_lain_lain->EditCustomAttributes = "";
			$keu_laporan_keuangan->diskon_lain_lain->EditValue = ew_HtmlEncode($keu_laporan_keuangan->diskon_lain_lain->CurrentValue);

			// Edit refer script
			// identitas

			$keu_laporan_keuangan->identitas->HrefValue = "";

			// A_nama_lengkap
			$keu_laporan_keuangan->A_nama_lengkap->HrefValue = "";

			// nilai_tanggungan_bruto
			$keu_laporan_keuangan->nilai_tanggungan_bruto->HrefValue = "";

			// tanggal_rencana_bayar
			$keu_laporan_keuangan->tanggal_rencana_bayar->HrefValue = "";

			// diskon_sosial
			$keu_laporan_keuangan->diskon_sosial->HrefValue = "";

			// diskon_waktu
			$keu_laporan_keuangan->diskon_waktu->HrefValue = "";

			// diskon_prestasi
			$keu_laporan_keuangan->diskon_prestasi->HrefValue = "";

			// diskon_internal
			$keu_laporan_keuangan->diskon_internal->HrefValue = "";

			// diskon_lain_lain
			$keu_laporan_keuangan->diskon_lain_lain->HrefValue = "";
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

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $keu_laporan_keuangan;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($keu_laporan_keuangan->nilai_tanggungan_bruto->FormValue) && $keu_laporan_keuangan->nilai_tanggungan_bruto->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_laporan_keuangan->nilai_tanggungan_bruto->FldCaption());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->nilai_tanggungan_bruto->FormValue)) {
			ew_AddMessage($gsFormError, $keu_laporan_keuangan->nilai_tanggungan_bruto->FldErrMsg());
		}
		if (!is_null($keu_laporan_keuangan->tanggal_rencana_bayar->FormValue) && $keu_laporan_keuangan->tanggal_rencana_bayar->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_laporan_keuangan->tanggal_rencana_bayar->FldCaption());
		}
		if (!ew_CheckEuroDate($keu_laporan_keuangan->tanggal_rencana_bayar->FormValue)) {
			ew_AddMessage($gsFormError, $keu_laporan_keuangan->tanggal_rencana_bayar->FldErrMsg());
		}
		if (!is_null($keu_laporan_keuangan->diskon_sosial->FormValue) && $keu_laporan_keuangan->diskon_sosial->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_laporan_keuangan->diskon_sosial->FldCaption());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_sosial->FormValue)) {
			ew_AddMessage($gsFormError, $keu_laporan_keuangan->diskon_sosial->FldErrMsg());
		}
		if (!is_null($keu_laporan_keuangan->diskon_waktu->FormValue) && $keu_laporan_keuangan->diskon_waktu->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_laporan_keuangan->diskon_waktu->FldCaption());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_waktu->FormValue)) {
			ew_AddMessage($gsFormError, $keu_laporan_keuangan->diskon_waktu->FldErrMsg());
		}
		if (!is_null($keu_laporan_keuangan->diskon_prestasi->FormValue) && $keu_laporan_keuangan->diskon_prestasi->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_laporan_keuangan->diskon_prestasi->FldCaption());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_prestasi->FormValue)) {
			ew_AddMessage($gsFormError, $keu_laporan_keuangan->diskon_prestasi->FldErrMsg());
		}
		if (!is_null($keu_laporan_keuangan->diskon_internal->FormValue) && $keu_laporan_keuangan->diskon_internal->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_laporan_keuangan->diskon_internal->FldCaption());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_internal->FormValue)) {
			ew_AddMessage($gsFormError, $keu_laporan_keuangan->diskon_internal->FldErrMsg());
		}
		if (!is_null($keu_laporan_keuangan->diskon_lain_lain->FormValue) && $keu_laporan_keuangan->diskon_lain_lain->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_laporan_keuangan->diskon_lain_lain->FldCaption());
		}
		if (!ew_CheckNumber($keu_laporan_keuangan->diskon_lain_lain->FormValue)) {
			ew_AddMessage($gsFormError, $keu_laporan_keuangan->diskon_lain_lain->FldErrMsg());
		}

		// Validate detail grid
		if ($keu_laporan_keuangan->getCurrentDetailTable() == "keu_cicilan" && $GLOBALS["keu_cicilan"]->DetailEdit) {
			$keu_cicilan_grid = new ckeu_cicilan_grid(); // get detail page object
			$keu_cicilan_grid->ValidateGridForm();
			$keu_cicilan_grid = NULL;
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $keu_laporan_keuangan;
		$sFilter = $keu_laporan_keuangan->KeyFilter();
			if ($keu_laporan_keuangan->nama_biaya->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`nama_biaya` = '" . ew_AdjustSql($keu_laporan_keuangan->nama_biaya->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$keu_laporan_keuangan->CurrentFilter = $sFilterChk;
			$sSqlChk = $keu_laporan_keuangan->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'nama_biaya', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $keu_laporan_keuangan->nama_biaya->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$keu_laporan_keuangan->CurrentFilter = $sFilter;
		$sSql = $keu_laporan_keuangan->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($keu_laporan_keuangan->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// nilai_tanggungan_bruto
			$keu_laporan_keuangan->nilai_tanggungan_bruto->SetDbValueDef($rsnew, $keu_laporan_keuangan->nilai_tanggungan_bruto->CurrentValue, 0, $keu_laporan_keuangan->nilai_tanggungan_bruto->ReadOnly);

			// tanggal_rencana_bayar
			$keu_laporan_keuangan->tanggal_rencana_bayar->SetDbValueDef($rsnew, ew_UnFormatDateTime($keu_laporan_keuangan->tanggal_rencana_bayar->CurrentValue, 7), ew_CurrentDate(), $keu_laporan_keuangan->tanggal_rencana_bayar->ReadOnly);

			// diskon_sosial
			$keu_laporan_keuangan->diskon_sosial->SetDbValueDef($rsnew, $keu_laporan_keuangan->diskon_sosial->CurrentValue, 0, $keu_laporan_keuangan->diskon_sosial->ReadOnly);

			// diskon_waktu
			$keu_laporan_keuangan->diskon_waktu->SetDbValueDef($rsnew, $keu_laporan_keuangan->diskon_waktu->CurrentValue, 0, $keu_laporan_keuangan->diskon_waktu->ReadOnly);

			// diskon_prestasi
			$keu_laporan_keuangan->diskon_prestasi->SetDbValueDef($rsnew, $keu_laporan_keuangan->diskon_prestasi->CurrentValue, 0, $keu_laporan_keuangan->diskon_prestasi->ReadOnly);

			// diskon_internal
			$keu_laporan_keuangan->diskon_internal->SetDbValueDef($rsnew, $keu_laporan_keuangan->diskon_internal->CurrentValue, 0, $keu_laporan_keuangan->diskon_internal->ReadOnly);

			// diskon_lain_lain
			$keu_laporan_keuangan->diskon_lain_lain->SetDbValueDef($rsnew, $keu_laporan_keuangan->diskon_lain_lain->CurrentValue, 0, $keu_laporan_keuangan->diskon_lain_lain->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $keu_laporan_keuangan->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($keu_laporan_keuangan->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';

				// Update detail records
				if ($EditRow) {
					if ($keu_laporan_keuangan->getCurrentDetailTable() == "keu_cicilan" && $GLOBALS["keu_cicilan"]->DetailEdit) {
						$keu_cicilan_grid = new ckeu_cicilan_grid(); // get detail page object
						$EditRow = $keu_cicilan_grid->GridUpdate();
						$keu_cicilan_grid = NULL;
					}
				}

				// Commit/Rollback transaction
				if ($keu_laporan_keuangan->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($keu_laporan_keuangan->CancelMessage <> "") {
					$this->setFailureMessage($keu_laporan_keuangan->CancelMessage);
					$keu_laporan_keuangan->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$keu_laporan_keuangan->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $keu_laporan_keuangan;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$keu_laporan_keuangan->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $keu_laporan_keuangan->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "keu_cicilan") {
				if (!isset($GLOBALS["keu_cicilan"]))
					$GLOBALS["keu_cicilan"] = new ckeu_cicilan;
				if ($GLOBALS["keu_cicilan"]->DetailEdit) {
					$GLOBALS["keu_cicilan"]->CurrentMode = "edit";
					if ($keu_laporan_keuangan->CurrentAction == "F")
						$GLOBALS["keu_cicilan"]->CurrentAction = "F";
					else
						$GLOBALS["keu_cicilan"]->CurrentAction = "gridedit";
					if ($keu_laporan_keuangan->CurrentAction == "X")
						$GLOBALS["keu_cicilan"]->EventCancelled = TRUE;

					// Save current master table to detail table
					$GLOBALS["keu_cicilan"]->setCurrentMasterTable($keu_laporan_keuangan->TableVar);
					$GLOBALS["keu_cicilan"]->setStartRecordNumber(1);
					$GLOBALS["keu_cicilan"]->kode_otomatis_tanggungan->FldIsDetailKey = TRUE;
					$GLOBALS["keu_cicilan"]->kode_otomatis_tanggungan->CurrentValue = $keu_laporan_keuangan->kode_otomatis->CurrentValue;
					$GLOBALS["keu_cicilan"]->kode_otomatis_tanggungan->setSessionValue($GLOBALS["keu_cicilan"]->kode_otomatis_tanggungan->CurrentValue);
				}
			}
		}
	}

		// Page Load event
function Page_Load() {
	global $Language;
		
	$Language->setPhrase("TblTypeVIEW","");
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

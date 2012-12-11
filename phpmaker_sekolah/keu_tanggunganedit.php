<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_tanggunganinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_tanggungan_edit = new ckeu_tanggungan_edit();
$Page =& $keu_tanggungan_edit;

// Page init
$keu_tanggungan_edit->Page_Init();

// Page main
$keu_tanggungan_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var keu_tanggungan_edit = new ew_Page("keu_tanggungan_edit");

// page properties
keu_tanggungan_edit.PageID = "edit"; // page ID
keu_tanggungan_edit.FormID = "fkeu_tanggunganedit"; // form ID
var EW_PAGE_ID = keu_tanggungan_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
keu_tanggungan_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_kode_otomatis"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_tanggungan->kode_otomatis->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_kode_otomatis_master_tanggungan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_tanggungan->kode_otomatis_master_tanggungan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_identitas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_tanggungan->identitas->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_sosial"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_tanggungan->diskon_sosial->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_sosial"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_tanggungan->diskon_sosial->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_waktu"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_tanggungan->diskon_waktu->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_waktu"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_tanggungan->diskon_waktu->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_prestasi"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_tanggungan->diskon_prestasi->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_prestasi"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_tanggungan->diskon_prestasi->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_internal"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_tanggungan->diskon_internal->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_internal"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_tanggungan->diskon_internal->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_lain_lain"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_tanggungan->diskon_lain_lain->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_diskon_lain_lain"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_tanggungan->diskon_lain_lain->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_nilai_tanggungan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_tanggungan->nilai_tanggungan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nilai_tanggungan"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_tanggungan->nilai_tanggungan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_rencana_bayar"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_tanggungan->tanggal_rencana_bayar->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tanggal_rencana_bayar"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($keu_tanggungan->tanggal_rencana_bayar->FldErrMsg()) ?>");

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
keu_tanggungan_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_tanggungan_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_tanggungan_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_tanggungan->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $keu_tanggungan->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $keu_tanggungan_edit->ShowPageHeader(); ?>
<?php
$keu_tanggungan_edit->ShowMessage();
?>
<form name="fkeu_tanggunganedit" id="fkeu_tanggunganedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return keu_tanggungan_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="keu_tanggungan">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($keu_tanggungan->kode_otomatis->Visible) { // kode_otomatis ?>
	<tr id="r_kode_otomatis"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->kode_otomatis->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_tanggungan->kode_otomatis->CellAttributes() ?>><span id="el_kode_otomatis">
<div<?php echo $keu_tanggungan->kode_otomatis->ViewAttributes() ?>><?php echo $keu_tanggungan->kode_otomatis->EditValue ?></div>
<input type="hidden" name="x_kode_otomatis" id="x_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_tanggungan->kode_otomatis->CurrentValue) ?>">
</span><?php echo $keu_tanggungan->kode_otomatis->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->kode_otomatis_master_tanggungan->Visible) { // kode_otomatis_master_tanggungan ?>
	<tr id="r_kode_otomatis_master_tanggungan"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->CellAttributes() ?>><span id="el_kode_otomatis_master_tanggungan">
<input type="text" name="x_kode_otomatis_master_tanggungan" id="x_kode_otomatis_master_tanggungan" size="30" maxlength="50" value="<?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->EditValue ?>"<?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->EditAttributes() ?>>
</span><?php echo $keu_tanggungan->kode_otomatis_master_tanggungan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->identitas->Visible) { // identitas ?>
	<tr id="r_identitas"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->identitas->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_tanggungan->identitas->CellAttributes() ?>><span id="el_identitas">
<input type="text" name="x_identitas" id="x_identitas" size="30" maxlength="50" value="<?php echo $keu_tanggungan->identitas->EditValue ?>"<?php echo $keu_tanggungan->identitas->EditAttributes() ?>>
</span><?php echo $keu_tanggungan->identitas->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->diskon_sosial->Visible) { // diskon_sosial ?>
	<tr id="r_diskon_sosial"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->diskon_sosial->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_tanggungan->diskon_sosial->CellAttributes() ?>><span id="el_diskon_sosial">
<input type="text" name="x_diskon_sosial" id="x_diskon_sosial" size="30" value="<?php echo $keu_tanggungan->diskon_sosial->EditValue ?>"<?php echo $keu_tanggungan->diskon_sosial->EditAttributes() ?>>
</span><?php echo $keu_tanggungan->diskon_sosial->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->diskon_waktu->Visible) { // diskon_waktu ?>
	<tr id="r_diskon_waktu"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->diskon_waktu->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_tanggungan->diskon_waktu->CellAttributes() ?>><span id="el_diskon_waktu">
<input type="text" name="x_diskon_waktu" id="x_diskon_waktu" size="30" value="<?php echo $keu_tanggungan->diskon_waktu->EditValue ?>"<?php echo $keu_tanggungan->diskon_waktu->EditAttributes() ?>>
</span><?php echo $keu_tanggungan->diskon_waktu->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->diskon_prestasi->Visible) { // diskon_prestasi ?>
	<tr id="r_diskon_prestasi"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->diskon_prestasi->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_tanggungan->diskon_prestasi->CellAttributes() ?>><span id="el_diskon_prestasi">
<input type="text" name="x_diskon_prestasi" id="x_diskon_prestasi" size="30" value="<?php echo $keu_tanggungan->diskon_prestasi->EditValue ?>"<?php echo $keu_tanggungan->diskon_prestasi->EditAttributes() ?>>
</span><?php echo $keu_tanggungan->diskon_prestasi->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->diskon_internal->Visible) { // diskon_internal ?>
	<tr id="r_diskon_internal"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->diskon_internal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_tanggungan->diskon_internal->CellAttributes() ?>><span id="el_diskon_internal">
<input type="text" name="x_diskon_internal" id="x_diskon_internal" size="30" value="<?php echo $keu_tanggungan->diskon_internal->EditValue ?>"<?php echo $keu_tanggungan->diskon_internal->EditAttributes() ?>>
</span><?php echo $keu_tanggungan->diskon_internal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->diskon_lain_lain->Visible) { // diskon_lain_lain ?>
	<tr id="r_diskon_lain_lain"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->diskon_lain_lain->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_tanggungan->diskon_lain_lain->CellAttributes() ?>><span id="el_diskon_lain_lain">
<input type="text" name="x_diskon_lain_lain" id="x_diskon_lain_lain" size="30" value="<?php echo $keu_tanggungan->diskon_lain_lain->EditValue ?>"<?php echo $keu_tanggungan->diskon_lain_lain->EditAttributes() ?>>
</span><?php echo $keu_tanggungan->diskon_lain_lain->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->nilai_tanggungan->Visible) { // nilai_tanggungan ?>
	<tr id="r_nilai_tanggungan"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->nilai_tanggungan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_tanggungan->nilai_tanggungan->CellAttributes() ?>><span id="el_nilai_tanggungan">
<input type="text" name="x_nilai_tanggungan" id="x_nilai_tanggungan" size="30" value="<?php echo $keu_tanggungan->nilai_tanggungan->EditValue ?>"<?php echo $keu_tanggungan->nilai_tanggungan->EditAttributes() ?>>
</span><?php echo $keu_tanggungan->nilai_tanggungan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_tanggungan->tanggal_rencana_bayar->Visible) { // tanggal_rencana_bayar ?>
	<tr id="r_tanggal_rencana_bayar"<?php echo $keu_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_tanggungan->tanggal_rencana_bayar->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_tanggungan->tanggal_rencana_bayar->CellAttributes() ?>><span id="el_tanggal_rencana_bayar">
<input type="text" name="x_tanggal_rencana_bayar" id="x_tanggal_rencana_bayar" value="<?php echo $keu_tanggungan->tanggal_rencana_bayar->EditValue ?>"<?php echo $keu_tanggungan->tanggal_rencana_bayar->EditAttributes() ?>>
</span><?php echo $keu_tanggungan->tanggal_rencana_bayar->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$keu_tanggungan_edit->ShowPageFooter();
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
$keu_tanggungan_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_tanggungan_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'keu_tanggungan';

	// Page object name
	var $PageObjName = 'keu_tanggungan_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_tanggungan;
		if ($keu_tanggungan->UseTokenInUrl) $PageUrl .= "t=" . $keu_tanggungan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_tanggungan;
		if ($keu_tanggungan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_tanggungan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_tanggungan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_tanggungan_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_tanggungan)
		if (!isset($GLOBALS["keu_tanggungan"])) {
			$GLOBALS["keu_tanggungan"] = new ckeu_tanggungan();
			$GLOBALS["Table"] =& $GLOBALS["keu_tanggungan"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_tanggungan', TRUE);

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
		global $keu_tanggungan;

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
			$this->Page_Terminate("keu_tanggunganlist.php");
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
		global $objForm, $Language, $gsFormError, $keu_tanggungan;

		// Load key from QueryString
		if (@$_GET["kode_otomatis"] <> "")
			$keu_tanggungan->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
		if (@$_POST["a_edit"] <> "") {
			$keu_tanggungan->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$keu_tanggungan->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$keu_tanggungan->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$keu_tanggungan->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($keu_tanggungan->kode_otomatis->CurrentValue == "")
			$this->Page_Terminate("keu_tanggunganlist.php"); // Invalid key, return to list
		switch ($keu_tanggungan->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("keu_tanggunganlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$keu_tanggungan->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $keu_tanggungan->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$keu_tanggungan->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$keu_tanggungan->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$keu_tanggungan->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $keu_tanggungan;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $keu_tanggungan;
		if (!$keu_tanggungan->kode_otomatis->FldIsDetailKey) {
			$keu_tanggungan->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		if (!$keu_tanggungan->kode_otomatis_master_tanggungan->FldIsDetailKey) {
			$keu_tanggungan->kode_otomatis_master_tanggungan->setFormValue($objForm->GetValue("x_kode_otomatis_master_tanggungan"));
		}
		if (!$keu_tanggungan->identitas->FldIsDetailKey) {
			$keu_tanggungan->identitas->setFormValue($objForm->GetValue("x_identitas"));
		}
		if (!$keu_tanggungan->diskon_sosial->FldIsDetailKey) {
			$keu_tanggungan->diskon_sosial->setFormValue($objForm->GetValue("x_diskon_sosial"));
		}
		if (!$keu_tanggungan->diskon_waktu->FldIsDetailKey) {
			$keu_tanggungan->diskon_waktu->setFormValue($objForm->GetValue("x_diskon_waktu"));
		}
		if (!$keu_tanggungan->diskon_prestasi->FldIsDetailKey) {
			$keu_tanggungan->diskon_prestasi->setFormValue($objForm->GetValue("x_diskon_prestasi"));
		}
		if (!$keu_tanggungan->diskon_internal->FldIsDetailKey) {
			$keu_tanggungan->diskon_internal->setFormValue($objForm->GetValue("x_diskon_internal"));
		}
		if (!$keu_tanggungan->diskon_lain_lain->FldIsDetailKey) {
			$keu_tanggungan->diskon_lain_lain->setFormValue($objForm->GetValue("x_diskon_lain_lain"));
		}
		if (!$keu_tanggungan->nilai_tanggungan->FldIsDetailKey) {
			$keu_tanggungan->nilai_tanggungan->setFormValue($objForm->GetValue("x_nilai_tanggungan"));
		}
		if (!$keu_tanggungan->tanggal_rencana_bayar->FldIsDetailKey) {
			$keu_tanggungan->tanggal_rencana_bayar->setFormValue($objForm->GetValue("x_tanggal_rencana_bayar"));
			$keu_tanggungan->tanggal_rencana_bayar->CurrentValue = ew_UnFormatDateTime($keu_tanggungan->tanggal_rencana_bayar->CurrentValue, 7);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $keu_tanggungan;
		$this->LoadRow();
		$keu_tanggungan->kode_otomatis->CurrentValue = $keu_tanggungan->kode_otomatis->FormValue;
		$keu_tanggungan->kode_otomatis_master_tanggungan->CurrentValue = $keu_tanggungan->kode_otomatis_master_tanggungan->FormValue;
		$keu_tanggungan->identitas->CurrentValue = $keu_tanggungan->identitas->FormValue;
		$keu_tanggungan->diskon_sosial->CurrentValue = $keu_tanggungan->diskon_sosial->FormValue;
		$keu_tanggungan->diskon_waktu->CurrentValue = $keu_tanggungan->diskon_waktu->FormValue;
		$keu_tanggungan->diskon_prestasi->CurrentValue = $keu_tanggungan->diskon_prestasi->FormValue;
		$keu_tanggungan->diskon_internal->CurrentValue = $keu_tanggungan->diskon_internal->FormValue;
		$keu_tanggungan->diskon_lain_lain->CurrentValue = $keu_tanggungan->diskon_lain_lain->FormValue;
		$keu_tanggungan->nilai_tanggungan->CurrentValue = $keu_tanggungan->nilai_tanggungan->FormValue;
		$keu_tanggungan->tanggal_rencana_bayar->CurrentValue = $keu_tanggungan->tanggal_rencana_bayar->FormValue;
		$keu_tanggungan->tanggal_rencana_bayar->CurrentValue = ew_UnFormatDateTime($keu_tanggungan->tanggal_rencana_bayar->CurrentValue, 7);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_tanggungan;
		$sFilter = $keu_tanggungan->KeyFilter();

		// Call Row Selecting event
		$keu_tanggungan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_tanggungan->CurrentFilter = $sFilter;
		$sSql = $keu_tanggungan->SQL();
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
		global $conn, $keu_tanggungan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_tanggungan->Row_Selected($row);
		$keu_tanggungan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_tanggungan->kode_otomatis_master_tanggungan->setDbValue($rs->fields('kode_otomatis_master_tanggungan'));
		$keu_tanggungan->identitas->setDbValue($rs->fields('identitas'));
		$keu_tanggungan->diskon_sosial->setDbValue($rs->fields('diskon_sosial'));
		$keu_tanggungan->diskon_waktu->setDbValue($rs->fields('diskon_waktu'));
		$keu_tanggungan->diskon_prestasi->setDbValue($rs->fields('diskon_prestasi'));
		$keu_tanggungan->diskon_internal->setDbValue($rs->fields('diskon_internal'));
		$keu_tanggungan->diskon_lain_lain->setDbValue($rs->fields('diskon_lain_lain'));
		$keu_tanggungan->nilai_tanggungan->setDbValue($rs->fields('nilai_tanggungan'));
		$keu_tanggungan->tanggal_rencana_bayar->setDbValue($rs->fields('tanggal_rencana_bayar'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_tanggungan;

		// Initialize URLs
		// Call Row_Rendering event

		$keu_tanggungan->Row_Rendering();

		// Common render codes for all row types
		// kode_otomatis
		// kode_otomatis_master_tanggungan
		// identitas
		// diskon_sosial
		// diskon_waktu
		// diskon_prestasi
		// diskon_internal
		// diskon_lain_lain
		// nilai_tanggungan
		// tanggal_rencana_bayar

		if ($keu_tanggungan->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode_otomatis
			$keu_tanggungan->kode_otomatis->ViewValue = $keu_tanggungan->kode_otomatis->CurrentValue;
			$keu_tanggungan->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_master_tanggungan
			$keu_tanggungan->kode_otomatis_master_tanggungan->ViewValue = $keu_tanggungan->kode_otomatis_master_tanggungan->CurrentValue;
			$keu_tanggungan->kode_otomatis_master_tanggungan->ViewCustomAttributes = "";

			// identitas
			$keu_tanggungan->identitas->ViewValue = $keu_tanggungan->identitas->CurrentValue;
			$keu_tanggungan->identitas->ViewCustomAttributes = "";

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->ViewValue = $keu_tanggungan->diskon_sosial->CurrentValue;
			$keu_tanggungan->diskon_sosial->ViewCustomAttributes = "";

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->ViewValue = $keu_tanggungan->diskon_waktu->CurrentValue;
			$keu_tanggungan->diskon_waktu->ViewCustomAttributes = "";

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->ViewValue = $keu_tanggungan->diskon_prestasi->CurrentValue;
			$keu_tanggungan->diskon_prestasi->ViewCustomAttributes = "";

			// diskon_internal
			$keu_tanggungan->diskon_internal->ViewValue = $keu_tanggungan->diskon_internal->CurrentValue;
			$keu_tanggungan->diskon_internal->ViewCustomAttributes = "";

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->ViewValue = $keu_tanggungan->diskon_lain_lain->CurrentValue;
			$keu_tanggungan->diskon_lain_lain->ViewCustomAttributes = "";

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->ViewValue = $keu_tanggungan->nilai_tanggungan->CurrentValue;
			$keu_tanggungan->nilai_tanggungan->ViewCustomAttributes = "";

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->ViewValue = $keu_tanggungan->tanggal_rencana_bayar->CurrentValue;
			$keu_tanggungan->tanggal_rencana_bayar->ViewValue = ew_FormatDateTime($keu_tanggungan->tanggal_rencana_bayar->ViewValue, 7);
			$keu_tanggungan->tanggal_rencana_bayar->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_tanggungan->kode_otomatis->LinkCustomAttributes = "";
			$keu_tanggungan->kode_otomatis->HrefValue = "";
			$keu_tanggungan->kode_otomatis->TooltipValue = "";

			// kode_otomatis_master_tanggungan
			$keu_tanggungan->kode_otomatis_master_tanggungan->LinkCustomAttributes = "";
			$keu_tanggungan->kode_otomatis_master_tanggungan->HrefValue = "";
			$keu_tanggungan->kode_otomatis_master_tanggungan->TooltipValue = "";

			// identitas
			$keu_tanggungan->identitas->LinkCustomAttributes = "";
			$keu_tanggungan->identitas->HrefValue = "";
			$keu_tanggungan->identitas->TooltipValue = "";

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_sosial->HrefValue = "";
			$keu_tanggungan->diskon_sosial->TooltipValue = "";

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_waktu->HrefValue = "";
			$keu_tanggungan->diskon_waktu->TooltipValue = "";

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_prestasi->HrefValue = "";
			$keu_tanggungan->diskon_prestasi->TooltipValue = "";

			// diskon_internal
			$keu_tanggungan->diskon_internal->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_internal->HrefValue = "";
			$keu_tanggungan->diskon_internal->TooltipValue = "";

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->LinkCustomAttributes = "";
			$keu_tanggungan->diskon_lain_lain->HrefValue = "";
			$keu_tanggungan->diskon_lain_lain->TooltipValue = "";

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->LinkCustomAttributes = "";
			$keu_tanggungan->nilai_tanggungan->HrefValue = "";
			$keu_tanggungan->nilai_tanggungan->TooltipValue = "";

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->LinkCustomAttributes = "";
			$keu_tanggungan->tanggal_rencana_bayar->HrefValue = "";
			$keu_tanggungan->tanggal_rencana_bayar->TooltipValue = "";
		} elseif ($keu_tanggungan->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode_otomatis
			$keu_tanggungan->kode_otomatis->EditCustomAttributes = "";
			$keu_tanggungan->kode_otomatis->EditValue = $keu_tanggungan->kode_otomatis->CurrentValue;
			$keu_tanggungan->kode_otomatis->ViewCustomAttributes = "";

			// kode_otomatis_master_tanggungan
			$keu_tanggungan->kode_otomatis_master_tanggungan->EditCustomAttributes = "";
			$keu_tanggungan->kode_otomatis_master_tanggungan->EditValue = ew_HtmlEncode($keu_tanggungan->kode_otomatis_master_tanggungan->CurrentValue);

			// identitas
			$keu_tanggungan->identitas->EditCustomAttributes = "";
			$keu_tanggungan->identitas->EditValue = ew_HtmlEncode($keu_tanggungan->identitas->CurrentValue);

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->EditCustomAttributes = "";
			$keu_tanggungan->diskon_sosial->EditValue = ew_HtmlEncode($keu_tanggungan->diskon_sosial->CurrentValue);

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->EditCustomAttributes = "";
			$keu_tanggungan->diskon_waktu->EditValue = ew_HtmlEncode($keu_tanggungan->diskon_waktu->CurrentValue);

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->EditCustomAttributes = "";
			$keu_tanggungan->diskon_prestasi->EditValue = ew_HtmlEncode($keu_tanggungan->diskon_prestasi->CurrentValue);

			// diskon_internal
			$keu_tanggungan->diskon_internal->EditCustomAttributes = "";
			$keu_tanggungan->diskon_internal->EditValue = ew_HtmlEncode($keu_tanggungan->diskon_internal->CurrentValue);

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->EditCustomAttributes = "";
			$keu_tanggungan->diskon_lain_lain->EditValue = ew_HtmlEncode($keu_tanggungan->diskon_lain_lain->CurrentValue);

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->EditCustomAttributes = "";
			$keu_tanggungan->nilai_tanggungan->EditValue = ew_HtmlEncode($keu_tanggungan->nilai_tanggungan->CurrentValue);

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->EditCustomAttributes = "";
			$keu_tanggungan->tanggal_rencana_bayar->EditValue = ew_HtmlEncode(ew_FormatDateTime($keu_tanggungan->tanggal_rencana_bayar->CurrentValue, 7));

			// Edit refer script
			// kode_otomatis

			$keu_tanggungan->kode_otomatis->HrefValue = "";

			// kode_otomatis_master_tanggungan
			$keu_tanggungan->kode_otomatis_master_tanggungan->HrefValue = "";

			// identitas
			$keu_tanggungan->identitas->HrefValue = "";

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->HrefValue = "";

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->HrefValue = "";

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->HrefValue = "";

			// diskon_internal
			$keu_tanggungan->diskon_internal->HrefValue = "";

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->HrefValue = "";

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->HrefValue = "";

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->HrefValue = "";
		}
		if ($keu_tanggungan->RowType == EW_ROWTYPE_ADD ||
			$keu_tanggungan->RowType == EW_ROWTYPE_EDIT ||
			$keu_tanggungan->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$keu_tanggungan->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($keu_tanggungan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_tanggungan->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $keu_tanggungan;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($keu_tanggungan->kode_otomatis->FormValue) && $keu_tanggungan->kode_otomatis->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_tanggungan->kode_otomatis->FldCaption());
		}
		if (!is_null($keu_tanggungan->kode_otomatis_master_tanggungan->FormValue) && $keu_tanggungan->kode_otomatis_master_tanggungan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_tanggungan->kode_otomatis_master_tanggungan->FldCaption());
		}
		if (!is_null($keu_tanggungan->identitas->FormValue) && $keu_tanggungan->identitas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_tanggungan->identitas->FldCaption());
		}
		if (!is_null($keu_tanggungan->diskon_sosial->FormValue) && $keu_tanggungan->diskon_sosial->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_tanggungan->diskon_sosial->FldCaption());
		}
		if (!ew_CheckNumber($keu_tanggungan->diskon_sosial->FormValue)) {
			ew_AddMessage($gsFormError, $keu_tanggungan->diskon_sosial->FldErrMsg());
		}
		if (!is_null($keu_tanggungan->diskon_waktu->FormValue) && $keu_tanggungan->diskon_waktu->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_tanggungan->diskon_waktu->FldCaption());
		}
		if (!ew_CheckNumber($keu_tanggungan->diskon_waktu->FormValue)) {
			ew_AddMessage($gsFormError, $keu_tanggungan->diskon_waktu->FldErrMsg());
		}
		if (!is_null($keu_tanggungan->diskon_prestasi->FormValue) && $keu_tanggungan->diskon_prestasi->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_tanggungan->diskon_prestasi->FldCaption());
		}
		if (!ew_CheckNumber($keu_tanggungan->diskon_prestasi->FormValue)) {
			ew_AddMessage($gsFormError, $keu_tanggungan->diskon_prestasi->FldErrMsg());
		}
		if (!is_null($keu_tanggungan->diskon_internal->FormValue) && $keu_tanggungan->diskon_internal->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_tanggungan->diskon_internal->FldCaption());
		}
		if (!ew_CheckNumber($keu_tanggungan->diskon_internal->FormValue)) {
			ew_AddMessage($gsFormError, $keu_tanggungan->diskon_internal->FldErrMsg());
		}
		if (!is_null($keu_tanggungan->diskon_lain_lain->FormValue) && $keu_tanggungan->diskon_lain_lain->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_tanggungan->diskon_lain_lain->FldCaption());
		}
		if (!ew_CheckNumber($keu_tanggungan->diskon_lain_lain->FormValue)) {
			ew_AddMessage($gsFormError, $keu_tanggungan->diskon_lain_lain->FldErrMsg());
		}
		if (!is_null($keu_tanggungan->nilai_tanggungan->FormValue) && $keu_tanggungan->nilai_tanggungan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_tanggungan->nilai_tanggungan->FldCaption());
		}
		if (!ew_CheckNumber($keu_tanggungan->nilai_tanggungan->FormValue)) {
			ew_AddMessage($gsFormError, $keu_tanggungan->nilai_tanggungan->FldErrMsg());
		}
		if (!is_null($keu_tanggungan->tanggal_rencana_bayar->FormValue) && $keu_tanggungan->tanggal_rencana_bayar->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_tanggungan->tanggal_rencana_bayar->FldCaption());
		}
		if (!ew_CheckEuroDate($keu_tanggungan->tanggal_rencana_bayar->FormValue)) {
			ew_AddMessage($gsFormError, $keu_tanggungan->tanggal_rencana_bayar->FldErrMsg());
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
		global $conn, $Security, $Language, $keu_tanggungan;
		$sFilter = $keu_tanggungan->KeyFilter();
		$keu_tanggungan->CurrentFilter = $sFilter;
		$sSql = $keu_tanggungan->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// kode_otomatis
			// kode_otomatis_master_tanggungan

			$keu_tanggungan->kode_otomatis_master_tanggungan->SetDbValueDef($rsnew, $keu_tanggungan->kode_otomatis_master_tanggungan->CurrentValue, "", $keu_tanggungan->kode_otomatis_master_tanggungan->ReadOnly);

			// identitas
			$keu_tanggungan->identitas->SetDbValueDef($rsnew, $keu_tanggungan->identitas->CurrentValue, "", $keu_tanggungan->identitas->ReadOnly);

			// diskon_sosial
			$keu_tanggungan->diskon_sosial->SetDbValueDef($rsnew, $keu_tanggungan->diskon_sosial->CurrentValue, 0, $keu_tanggungan->diskon_sosial->ReadOnly);

			// diskon_waktu
			$keu_tanggungan->diskon_waktu->SetDbValueDef($rsnew, $keu_tanggungan->diskon_waktu->CurrentValue, 0, $keu_tanggungan->diskon_waktu->ReadOnly);

			// diskon_prestasi
			$keu_tanggungan->diskon_prestasi->SetDbValueDef($rsnew, $keu_tanggungan->diskon_prestasi->CurrentValue, 0, $keu_tanggungan->diskon_prestasi->ReadOnly);

			// diskon_internal
			$keu_tanggungan->diskon_internal->SetDbValueDef($rsnew, $keu_tanggungan->diskon_internal->CurrentValue, 0, $keu_tanggungan->diskon_internal->ReadOnly);

			// diskon_lain_lain
			$keu_tanggungan->diskon_lain_lain->SetDbValueDef($rsnew, $keu_tanggungan->diskon_lain_lain->CurrentValue, 0, $keu_tanggungan->diskon_lain_lain->ReadOnly);

			// nilai_tanggungan
			$keu_tanggungan->nilai_tanggungan->SetDbValueDef($rsnew, $keu_tanggungan->nilai_tanggungan->CurrentValue, 0, $keu_tanggungan->nilai_tanggungan->ReadOnly);

			// tanggal_rencana_bayar
			$keu_tanggungan->tanggal_rencana_bayar->SetDbValueDef($rsnew, ew_UnFormatDateTime($keu_tanggungan->tanggal_rencana_bayar->CurrentValue, 7), ew_CurrentDate(), $keu_tanggungan->tanggal_rencana_bayar->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $keu_tanggungan->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($keu_tanggungan->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($keu_tanggungan->CancelMessage <> "") {
					$this->setFailureMessage($keu_tanggungan->CancelMessage);
					$keu_tanggungan->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$keu_tanggungan->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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

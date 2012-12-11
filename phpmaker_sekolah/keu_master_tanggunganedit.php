<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "keu_master_tanggunganinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$keu_master_tanggungan_edit = new ckeu_master_tanggungan_edit();
$Page =& $keu_master_tanggungan_edit;

// Page init
$keu_master_tanggungan_edit->Page_Init();

// Page main
$keu_master_tanggungan_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var keu_master_tanggungan_edit = new ew_Page("keu_master_tanggungan_edit");

// page properties
keu_master_tanggungan_edit.PageID = "edit"; // page ID
keu_master_tanggungan_edit.FormID = "fkeu_master_tanggunganedit"; // form ID
var EW_PAGE_ID = keu_master_tanggungan_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
keu_master_tanggungan_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_nama_biaya"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_master_tanggungan->nama_biaya->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_apakah_disembunyikan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_master_tanggungan->apakah_disembunyikan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_rek_pendapatan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_master_tanggungan->rek_pendapatan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_rek_kas"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($keu_master_tanggungan->rek_kas->FldCaption()) ?>");

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
keu_master_tanggungan_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
keu_master_tanggungan_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
keu_master_tanggungan_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $keu_master_tanggungan->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $keu_master_tanggungan->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $keu_master_tanggungan_edit->ShowPageHeader(); ?>
<?php
$keu_master_tanggungan_edit->ShowMessage();
?>
<form name="fkeu_master_tanggunganedit" id="fkeu_master_tanggunganedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return keu_master_tanggungan_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="keu_master_tanggungan">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($keu_master_tanggungan->nama_biaya->Visible) { // nama_biaya ?>
	<tr id="r_nama_biaya"<?php echo $keu_master_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_master_tanggungan->nama_biaya->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_master_tanggungan->nama_biaya->CellAttributes() ?>><span id="el_nama_biaya">
<input type="text" name="x_nama_biaya" id="x_nama_biaya" size="30" maxlength="50" value="<?php echo $keu_master_tanggungan->nama_biaya->EditValue ?>"<?php echo $keu_master_tanggungan->nama_biaya->EditAttributes() ?>>
</span><?php echo $keu_master_tanggungan->nama_biaya->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_master_tanggungan->apakah_disembunyikan->Visible) { // apakah_disembunyikan ?>
	<tr id="r_apakah_disembunyikan"<?php echo $keu_master_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_master_tanggungan->apakah_disembunyikan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_master_tanggungan->apakah_disembunyikan->CellAttributes() ?>><span id="el_apakah_disembunyikan">
<select id="x_apakah_disembunyikan" name="x_apakah_disembunyikan"<?php echo $keu_master_tanggungan->apakah_disembunyikan->EditAttributes() ?>>
<?php
if (is_array($keu_master_tanggungan->apakah_disembunyikan->EditValue)) {
	$arwrk = $keu_master_tanggungan->apakah_disembunyikan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_master_tanggungan->apakah_disembunyikan->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $keu_master_tanggungan->apakah_disembunyikan->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kode_otomatis" id="x_kode_otomatis" value="<?php echo ew_HtmlEncode($keu_master_tanggungan->kode_otomatis->CurrentValue) ?>">
<?php if ($keu_master_tanggungan->rek_pendapatan->Visible) { // rek_pendapatan ?>
	<tr id="r_rek_pendapatan"<?php echo $keu_master_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_master_tanggungan->rek_pendapatan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_master_tanggungan->rek_pendapatan->CellAttributes() ?>><span id="el_rek_pendapatan">
<select id="x_rek_pendapatan" name="x_rek_pendapatan"<?php echo $keu_master_tanggungan->rek_pendapatan->EditAttributes() ?>>
<?php
if (is_array($keu_master_tanggungan->rek_pendapatan->EditValue)) {
	$arwrk = $keu_master_tanggungan->rek_pendapatan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_master_tanggungan->rek_pendapatan->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$keu_master_tanggungan->rek_pendapatan) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
<?php if ($arwrk[$rowcntwrk][3] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,2,$keu_master_tanggungan->rek_pendapatan) ?><?php echo $arwrk[$rowcntwrk][3] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $keu_master_tanggungan->rek_pendapatan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($keu_master_tanggungan->rek_kas->Visible) { // rek_kas ?>
	<tr id="r_rek_kas"<?php echo $keu_master_tanggungan->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $keu_master_tanggungan->rek_kas->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $keu_master_tanggungan->rek_kas->CellAttributes() ?>><span id="el_rek_kas">
<select id="x_rek_kas" name="x_rek_kas"<?php echo $keu_master_tanggungan->rek_kas->EditAttributes() ?>>
<?php
if (is_array($keu_master_tanggungan->rek_kas->EditValue)) {
	$arwrk = $keu_master_tanggungan->rek_kas->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($keu_master_tanggungan->rek_kas->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$keu_master_tanggungan->rek_kas) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
<?php if ($arwrk[$rowcntwrk][3] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,2,$keu_master_tanggungan->rek_kas) ?><?php echo $arwrk[$rowcntwrk][3] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $keu_master_tanggungan->rek_kas->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$keu_master_tanggungan_edit->ShowPageFooter();
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
$keu_master_tanggungan_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ckeu_master_tanggungan_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'keu_master_tanggungan';

	// Page object name
	var $PageObjName = 'keu_master_tanggungan_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $keu_master_tanggungan;
		if ($keu_master_tanggungan->UseTokenInUrl) $PageUrl .= "t=" . $keu_master_tanggungan->TableVar . "&"; // Add page token
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
		global $objForm, $keu_master_tanggungan;
		if ($keu_master_tanggungan->UseTokenInUrl) {
			if ($objForm)
				return ($keu_master_tanggungan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($keu_master_tanggungan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ckeu_master_tanggungan_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (keu_master_tanggungan)
		if (!isset($GLOBALS["keu_master_tanggungan"])) {
			$GLOBALS["keu_master_tanggungan"] = new ckeu_master_tanggungan();
			$GLOBALS["Table"] =& $GLOBALS["keu_master_tanggungan"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'keu_master_tanggungan', TRUE);

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
		global $keu_master_tanggungan;

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
			$this->Page_Terminate("keu_master_tanggunganlist.php");
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
		global $objForm, $Language, $gsFormError, $keu_master_tanggungan;

		// Load key from QueryString
		if (@$_GET["kode_otomatis"] <> "")
			$keu_master_tanggungan->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
		if (@$_POST["a_edit"] <> "") {
			$keu_master_tanggungan->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$keu_master_tanggungan->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$keu_master_tanggungan->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$keu_master_tanggungan->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($keu_master_tanggungan->kode_otomatis->CurrentValue == "")
			$this->Page_Terminate("keu_master_tanggunganlist.php"); // Invalid key, return to list
		switch ($keu_master_tanggungan->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("keu_master_tanggunganlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$keu_master_tanggungan->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $keu_master_tanggungan->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$keu_master_tanggungan->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$keu_master_tanggungan->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$keu_master_tanggungan->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $keu_master_tanggungan;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $keu_master_tanggungan;
		if (!$keu_master_tanggungan->nama_biaya->FldIsDetailKey) {
			$keu_master_tanggungan->nama_biaya->setFormValue($objForm->GetValue("x_nama_biaya"));
		}
		if (!$keu_master_tanggungan->apakah_disembunyikan->FldIsDetailKey) {
			$keu_master_tanggungan->apakah_disembunyikan->setFormValue($objForm->GetValue("x_apakah_disembunyikan"));
		}
		if (!$keu_master_tanggungan->kode_otomatis->FldIsDetailKey) {
			$keu_master_tanggungan->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
		if (!$keu_master_tanggungan->rek_pendapatan->FldIsDetailKey) {
			$keu_master_tanggungan->rek_pendapatan->setFormValue($objForm->GetValue("x_rek_pendapatan"));
		}
		if (!$keu_master_tanggungan->rek_kas->FldIsDetailKey) {
			$keu_master_tanggungan->rek_kas->setFormValue($objForm->GetValue("x_rek_kas"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $keu_master_tanggungan;
		$this->LoadRow();
		$keu_master_tanggungan->nama_biaya->CurrentValue = $keu_master_tanggungan->nama_biaya->FormValue;
		$keu_master_tanggungan->apakah_disembunyikan->CurrentValue = $keu_master_tanggungan->apakah_disembunyikan->FormValue;
		$keu_master_tanggungan->kode_otomatis->CurrentValue = $keu_master_tanggungan->kode_otomatis->FormValue;
		$keu_master_tanggungan->rek_pendapatan->CurrentValue = $keu_master_tanggungan->rek_pendapatan->FormValue;
		$keu_master_tanggungan->rek_kas->CurrentValue = $keu_master_tanggungan->rek_kas->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $keu_master_tanggungan;
		$sFilter = $keu_master_tanggungan->KeyFilter();

		// Call Row Selecting event
		$keu_master_tanggungan->Row_Selecting($sFilter);

		// Load SQL based on filter
		$keu_master_tanggungan->CurrentFilter = $sFilter;
		$sSql = $keu_master_tanggungan->SQL();
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
		global $conn, $keu_master_tanggungan;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$keu_master_tanggungan->Row_Selected($row);
		$keu_master_tanggungan->nama_biaya->setDbValue($rs->fields('nama_biaya'));
		$keu_master_tanggungan->apakah_disembunyikan->setDbValue($rs->fields('apakah_disembunyikan'));
		$keu_master_tanggungan->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$keu_master_tanggungan->rek_pendapatan->setDbValue($rs->fields('rek_pendapatan'));
		$keu_master_tanggungan->rek_kas->setDbValue($rs->fields('rek_kas'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $keu_master_tanggungan;

		// Initialize URLs
		// Call Row_Rendering event

		$keu_master_tanggungan->Row_Rendering();

		// Common render codes for all row types
		// nama_biaya
		// apakah_disembunyikan
		// kode_otomatis
		// rek_pendapatan
		// rek_kas

		if ($keu_master_tanggungan->RowType == EW_ROWTYPE_VIEW) { // View row

			// nama_biaya
			$keu_master_tanggungan->nama_biaya->ViewValue = $keu_master_tanggungan->nama_biaya->CurrentValue;
			$keu_master_tanggungan->nama_biaya->ViewCustomAttributes = "";

			// apakah_disembunyikan
			if (strval($keu_master_tanggungan->apakah_disembunyikan->CurrentValue) <> "") {
				switch ($keu_master_tanggungan->apakah_disembunyikan->CurrentValue) {
					case "y":
						$keu_master_tanggungan->apakah_disembunyikan->ViewValue = $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(1) <> "" ? $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(1) : $keu_master_tanggungan->apakah_disembunyikan->CurrentValue;
						break;
					case "t":
						$keu_master_tanggungan->apakah_disembunyikan->ViewValue = $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(2) <> "" ? $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(2) : $keu_master_tanggungan->apakah_disembunyikan->CurrentValue;
						break;
					default:
						$keu_master_tanggungan->apakah_disembunyikan->ViewValue = $keu_master_tanggungan->apakah_disembunyikan->CurrentValue;
				}
			} else {
				$keu_master_tanggungan->apakah_disembunyikan->ViewValue = NULL;
			}
			$keu_master_tanggungan->apakah_disembunyikan->ViewCustomAttributes = "";

			// kode_otomatis
			$keu_master_tanggungan->kode_otomatis->ViewValue = $keu_master_tanggungan->kode_otomatis->CurrentValue;
			$keu_master_tanggungan->kode_otomatis->ViewCustomAttributes = "";

			// rek_pendapatan
			if (strval($keu_master_tanggungan->rek_pendapatan->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_master_tanggungan->rek_pendapatan->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan`, `D/K` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_master_tanggungan->rek_pendapatan->ViewValue = $rswrk->fields('Norek');
					$keu_master_tanggungan->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,1,$keu_master_tanggungan->rek_pendapatan) . $rswrk->fields('Keterangan');
					$keu_master_tanggungan->rek_pendapatan->ViewValue .= ew_ValueSeparator(0,2,$keu_master_tanggungan->rek_pendapatan) . $rswrk->fields('D/K');
					$rswrk->Close();
				} else {
					$keu_master_tanggungan->rek_pendapatan->ViewValue = $keu_master_tanggungan->rek_pendapatan->CurrentValue;
				}
			} else {
				$keu_master_tanggungan->rek_pendapatan->ViewValue = NULL;
			}
			$keu_master_tanggungan->rek_pendapatan->ViewCustomAttributes = "";

			// rek_kas
			if (strval($keu_master_tanggungan->rek_kas->CurrentValue) <> "") {
				$sFilterWrk = "`Norek` = '" . ew_AdjustSql($keu_master_tanggungan->rek_kas->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Norek`, `Keterangan`, `D/K` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$keu_master_tanggungan->rek_kas->ViewValue = $rswrk->fields('Norek');
					$keu_master_tanggungan->rek_kas->ViewValue .= ew_ValueSeparator(0,1,$keu_master_tanggungan->rek_kas) . $rswrk->fields('Keterangan');
					$keu_master_tanggungan->rek_kas->ViewValue .= ew_ValueSeparator(0,2,$keu_master_tanggungan->rek_kas) . $rswrk->fields('D/K');
					$rswrk->Close();
				} else {
					$keu_master_tanggungan->rek_kas->ViewValue = $keu_master_tanggungan->rek_kas->CurrentValue;
				}
			} else {
				$keu_master_tanggungan->rek_kas->ViewValue = NULL;
			}
			$keu_master_tanggungan->rek_kas->ViewCustomAttributes = "";

			// nama_biaya
			$keu_master_tanggungan->nama_biaya->LinkCustomAttributes = "";
			$keu_master_tanggungan->nama_biaya->HrefValue = "";
			$keu_master_tanggungan->nama_biaya->TooltipValue = "";

			// apakah_disembunyikan
			$keu_master_tanggungan->apakah_disembunyikan->LinkCustomAttributes = "";
			$keu_master_tanggungan->apakah_disembunyikan->HrefValue = "";
			$keu_master_tanggungan->apakah_disembunyikan->TooltipValue = "";

			// kode_otomatis
			$keu_master_tanggungan->kode_otomatis->LinkCustomAttributes = "";
			$keu_master_tanggungan->kode_otomatis->HrefValue = "";
			$keu_master_tanggungan->kode_otomatis->TooltipValue = "";

			// rek_pendapatan
			$keu_master_tanggungan->rek_pendapatan->LinkCustomAttributes = "";
			$keu_master_tanggungan->rek_pendapatan->HrefValue = "";
			$keu_master_tanggungan->rek_pendapatan->TooltipValue = "";

			// rek_kas
			$keu_master_tanggungan->rek_kas->LinkCustomAttributes = "";
			$keu_master_tanggungan->rek_kas->HrefValue = "";
			$keu_master_tanggungan->rek_kas->TooltipValue = "";
		} elseif ($keu_master_tanggungan->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nama_biaya
			$keu_master_tanggungan->nama_biaya->EditCustomAttributes = "";
			$keu_master_tanggungan->nama_biaya->EditValue = ew_HtmlEncode($keu_master_tanggungan->nama_biaya->CurrentValue);

			// apakah_disembunyikan
			$keu_master_tanggungan->apakah_disembunyikan->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("y", $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(1) <> "" ? $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(1) : "y");
			$arwrk[] = array("t", $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(2) <> "" ? $keu_master_tanggungan->apakah_disembunyikan->FldTagCaption(2) : "t");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$keu_master_tanggungan->apakah_disembunyikan->EditValue = $arwrk;

			// kode_otomatis
			$keu_master_tanggungan->kode_otomatis->EditCustomAttributes = "";

			// rek_pendapatan
			$keu_master_tanggungan->rek_pendapatan->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Norek`, `Norek` AS `DispFld`, `Keterangan` AS `Disp2Fld`, `D/K` AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", ""));
			$keu_master_tanggungan->rek_pendapatan->EditValue = $arwrk;

			// rek_kas
			$keu_master_tanggungan->rek_kas->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Norek`, `Norek` AS `DispFld`, `Keterangan` AS `Disp2Fld`, `D/K` AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `rekening2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", ""));
			$keu_master_tanggungan->rek_kas->EditValue = $arwrk;

			// Edit refer script
			// nama_biaya

			$keu_master_tanggungan->nama_biaya->HrefValue = "";

			// apakah_disembunyikan
			$keu_master_tanggungan->apakah_disembunyikan->HrefValue = "";

			// kode_otomatis
			$keu_master_tanggungan->kode_otomatis->HrefValue = "";

			// rek_pendapatan
			$keu_master_tanggungan->rek_pendapatan->HrefValue = "";

			// rek_kas
			$keu_master_tanggungan->rek_kas->HrefValue = "";
		}
		if ($keu_master_tanggungan->RowType == EW_ROWTYPE_ADD ||
			$keu_master_tanggungan->RowType == EW_ROWTYPE_EDIT ||
			$keu_master_tanggungan->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$keu_master_tanggungan->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($keu_master_tanggungan->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$keu_master_tanggungan->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $keu_master_tanggungan;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($keu_master_tanggungan->nama_biaya->FormValue) && $keu_master_tanggungan->nama_biaya->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_master_tanggungan->nama_biaya->FldCaption());
		}
		if (!is_null($keu_master_tanggungan->apakah_disembunyikan->FormValue) && $keu_master_tanggungan->apakah_disembunyikan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_master_tanggungan->apakah_disembunyikan->FldCaption());
		}
		if (!is_null($keu_master_tanggungan->rek_pendapatan->FormValue) && $keu_master_tanggungan->rek_pendapatan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_master_tanggungan->rek_pendapatan->FldCaption());
		}
		if (!is_null($keu_master_tanggungan->rek_kas->FormValue) && $keu_master_tanggungan->rek_kas->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $keu_master_tanggungan->rek_kas->FldCaption());
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
		global $conn, $Security, $Language, $keu_master_tanggungan;
		$sFilter = $keu_master_tanggungan->KeyFilter();
			if ($keu_master_tanggungan->nama_biaya->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`nama_biaya` = '" . ew_AdjustSql($keu_master_tanggungan->nama_biaya->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$keu_master_tanggungan->CurrentFilter = $sFilterChk;
			$sSqlChk = $keu_master_tanggungan->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'nama_biaya', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $keu_master_tanggungan->nama_biaya->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$keu_master_tanggungan->CurrentFilter = $sFilter;
		$sSql = $keu_master_tanggungan->SQL();
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

			// nama_biaya
			$keu_master_tanggungan->nama_biaya->SetDbValueDef($rsnew, $keu_master_tanggungan->nama_biaya->CurrentValue, "", $keu_master_tanggungan->nama_biaya->ReadOnly);

			// apakah_disembunyikan
			$keu_master_tanggungan->apakah_disembunyikan->SetDbValueDef($rsnew, $keu_master_tanggungan->apakah_disembunyikan->CurrentValue, "", $keu_master_tanggungan->apakah_disembunyikan->ReadOnly);

			// kode_otomatis
			// rek_pendapatan

			$keu_master_tanggungan->rek_pendapatan->SetDbValueDef($rsnew, $keu_master_tanggungan->rek_pendapatan->CurrentValue, "", $keu_master_tanggungan->rek_pendapatan->ReadOnly);

			// rek_kas
			$keu_master_tanggungan->rek_kas->SetDbValueDef($rsnew, $keu_master_tanggungan->rek_kas->CurrentValue, "", $keu_master_tanggungan->rek_kas->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $keu_master_tanggungan->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($keu_master_tanggungan->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($keu_master_tanggungan->CancelMessage <> "") {
					$this->setFailureMessage($keu_master_tanggungan->CancelMessage);
					$keu_master_tanggungan->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$keu_master_tanggungan->Row_Updated($rsold, $rsnew);
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
